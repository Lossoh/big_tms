<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Job_order_emkl extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('job_order_emkl_model');
	}

	function index()
	{
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('job_order_emkl').' - '.$this->config->item('website_name').' - '.$this->config->item('comp_name').' '. $this->config->item('version'));
		$data['page'] = lang('job_order_emkl');
		$this->session->set_userdata('page_header', 'transaction');		
		$this->session->set_userdata('page_detail', 'job_order_emkl');
		$data['form'] = TRUE;
		$data['datatables'] = TRUE;
		
        if($this->session->userdata('start_date_jo_emkl') == '' ){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_jo_emkl')));
        }

        if($this->session->userdata('end_date_jo_emkl') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_jo_emkl')));
        }

        // if($this->session->userdata('start_date') == '' && $this->session->userdata('end_date') == ''){
        //     $start_date = date("Y-m-01");
        //     $end_date = date("Y-m-d");
        // }
        // else{
        //     $start_date = $this->session->userdata('start_date');
        //     $end_date = $this->session->userdata('end_date');
        // }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        
		// $data['job_order_emkls'] = $this->job_order_emkl_model->get_all_records_list($start_date,$end_date);
		
		$this->template
		->set_layout('users')
		->build('job_order_emkls',isset($data) ? $data : NULL);
	}
	
    function set_filter(){
       $this->session->set_userdata('start_date',date("Y-m-d",strtotime($this->input->post('start_date'))));
       $this->session->set_userdata('end_date',date("Y-m-d",strtotime($this->input->post('end_date'))));    
       
       redirect(base_url().'job_order_emkl');
    }

    function update_status_jo_emkl($year,$month,$code,$status){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $error = false;
        $this->db->trans_begin();
        
        $get_data = $this->job_order_emkl_model->get_job_order_emkl_by_jo($year,$month,$code);
        
        if($status == 0)
            $status_tmp = 'Open';
        else if($status == 1)
            $status_tmp = 'Admin';
        else
            $status_tmp = 'Close';
            
        $data_jo = array(
            'status' => $status,
            'user_modified' => $this->session->userdata('user_id'),
            'date_modified' => date('Y-m-d'),
            'time_modified' => date('H:i:s')
        );
        $this->db->where('year',$year);
		$this->db->where('month',$month);
		$this->db->where('code',$code);
		$this->db->where('deleted',0);        
        $result = $this->db->update('tr_jo_emkl_trx_hdr', $data_jo);
        if(!$result){
            $error = true;
        }
        
        Header('Content-Type: application/json; charset=UTF8');
        $status = $this->db->trans_status();
        if ($status === false || $error == true){
            $this->db->trans_rollback();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
			$params['module'] = 'ERROR ROLLBACK Invoice';
			$params['module_field_id'] = $code;
			$params['activity'] = ucfirst('Deleted status '.$status_tmp.' at Job Order EMKL No '.$get_data->jo_no);
			$params['icon'] = 'fa-exclamation-triangle';
			modules::run('activitylog/log',$params);
            
            echo json_encode(array('success' => false, 'msg' => "Failed Data RollBack"));
            exit();
        }
        else{
            $this->db->trans_commit();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Job Order EMKL';
            $params['module_field_id'] = $code;
            $params['activity'] = ucfirst('Updated status '.$status_tmp.' at Job Order EMKL No ' . $get_data->jo_no);
            $params['icon'] = 'fa-times';
            modules::run('activitylog/log', $params); //log activity

            echo json_encode(array("success" => true, 'msg' => lang('updated_succesfully')));
            exit();
        }
    }
    
    function get_data_port_warehouse(){
        $port_warehouse = $this->input->post('port_warehouse');
        
        if($port_warehouse == 'POK'){
            $port = $this->job_order_emkl_model->get_all_records('sa_port', $array =
                array('rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '', 'port_name', 'asc');	   
        }
        else{
            $port = $this->job_order_emkl_model->get_all_records('sa_port', $array =
                array('rowID >' => 0, 'deleted' => 0, 'port_type' => $port_warehouse), $join_table = '', $join_criteria = '', 'port_name', 'asc');
        }
        
        if (!empty($port)) {
            echo "<option value=''>".lang('select_your_option')."</option>";
            foreach ($port as $rs) {
		      echo '<option value="'.$rs->rowID.'">'.$rs->port_cd.' - '.$rs->port_name.'</option>';
            }
        }
        
        exit;
    }
		
    function get_data_vessel(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        if($this->input->post('start_date') == '' && $this->input->post('end_date') == ''){
            $start_date = date("Y-m-d");
            $end_date = date("Y-m-d");
        }
        else{
            $start_date = date("Y-m-d",strtotime($this->input->post('start_date')));
            $end_date = date("Y-m-d",strtotime($this->input->post('end_date')));
        }
        
        $vessels = $this->job_order_emkl_model->get_data_vessel_by_date($start_date,$end_date);
        if (count($vessels) > 0)
        {
            foreach ($vessels as $vessel) { 
                $original_copy = '-';
                if($vessel->original == 1 && $vessel->copy == 1)
                    $original_copy = 'Original & Copy';
                else if($vessel->original == 1)
                    $original_copy = 'Original';
                else if($vessel->copy == 1)
                    $original_copy = 'Copy';
                
                $data[] = array(
                    'rowID' => $vessel->rowID,
                    'trx_no' => $vessel->trx_no,
                    'eta_date' => date("d F Y",strtotime($vessel->eta_date)),
                    'vessel_name' => $vessel->vessel_name,
                    'port_name' => $vessel->port_name,
                    'agent' => $vessel->agent,
                    'original_copy' => $original_copy,
                    'status' => $vessel->status == 0 ? 'Unfinished' : 'Finished',
                );
            }
            
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode($data);
        }
        else{
            echo json_encode(array());            
        }
        
        exit;
    }
    
	function create_job_order_emkl()
	{
		
		if ($this->input->post()) {	
				$error = false;
                $result = true;
                $this->db->trans_begin();
                $dataPost = $this->input->post();
                 
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
				$this->form_validation->set_rules('job_order_emkl_date', 'Job Order EMKL Date', 'required');
				$this->form_validation->set_rules('job_order_emkl_type', 'Type', 'required|numeric');
				$this->form_validation->set_rules('debtor', 'Debtor', 'required|numeric');
				$this->form_validation->set_rules('po_spk_no', 'PO/SPK No', 'required');
				$this->form_validation->set_rules('port', 'Port', 'required|numeric');
				
				if ($this->form_validation->run() == FALSE)
				{
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('error_in_form'));
					redirect('job_order_emkl/create_job_order_emkl');
				}else{	
                    if ($result){
                        if(date('Y-m-d',strtotime($this->input->post('job_order_emkl_date'))) != date('Y-m-d')){
                            $trx_date = date('Y-m-d');
                        }
                        else{
                            $trx_date = date('Y-m-d',strtotime($this->input->post('job_order_emkl_date')));
                        }
                        
    					$new_job_order_emkl_code= ((int)$this->AppModel->select_max_id('tr_jo_emkl_trx_hdr',$array = array('year' =>date('Y',strtotime($trx_date)),'month' =>date('m',strtotime($trx_date))),'code'))+1;					
    
    					$job_order_emkl_no='JOE'.sprintf("%04s",date('Y',strtotime($trx_date))).sprintf("%02s",date('m',strtotime($trx_date))).sprintf("%04s",$new_job_order_emkl_code);
    				
    					$job_order_emkl_data = array(
    							'year' =>date('Y',strtotime($trx_date)),
    							'month'=>date('m',strtotime($trx_date)),
    							'code' => $new_job_order_emkl_code,
    							'jo_no'=>$job_order_emkl_no,
    							'jo_date'=>$trx_date,
    							'jo_type'=>$this->input->post('job_order_emkl_type'),
    							'debtor_rowID'=>$this->input->post('debtor'),
    							'po_spk_no'=>strtoupper(trim($this->input->post('po_spk_no'))),
    							'so_no'=>strtoupper(trim($this->input->post('so_no'))),
                                'bl_no'=>strtoupper(trim($this->input->post('bl_no'))),
                                'port_jo_type'=>$this->input->post('port_jo_type'),
                                'port_rowID'=>$this->input->post('port'),
    							'vessel_rowID'=>$this->input->post('vessel_rowID'),
    							'vessel_no'=>strtoupper(trim($this->input->post('vessel_no'))),
    							'vessel_name'=>strtoupper(trim($this->input->post('vessel_name'))),
    							'description'=>ucfirst($this->input->post('job_order_emkl_desc')),
    							'user_created'=>$this->session->userdata('user_rowID'),
    							'date_created'=>date('Y-m-d'),
    							'time_created'=>date('H:i:s')							
                        );
    					  
    					$result = $this->db->insert('tr_jo_emkl_trx_hdr', $job_order_emkl_data);
                        if (!$result){
                            $error = true;
                        }
                    }
                    else{
                        $error = true;
                    }
                    
                    if ($result){
                        if(count($this->input->post('cargo'))){
                            $total_detail = count($this->input->post('cargo'));
                            $cargo = $this->input->post('cargo');
                            $destination = $this->input->post('destination');
                            $weight = $this->input->post('weight');
                            $container_type = $this->input->post('container_type');
                            
                            if($this->input->post('cargo') != ''){
                                for($i=0;$i<$total_detail;$i++){
                                    $job_order_emkl_detail_data = array(
            							'jo_no'=>$job_order_emkl_no,
            							'item_rowID'=>$cargo[$i],
            							'fare_trip_rowID'=>$destination[$i],
            							'weight'=>str_replace('.','',$weight[$i]),
            							'container_type'=>$container_type[$i],
            							'user_created'=>$this->session->userdata('user_rowID'),
            							'date_created'=>date('Y-m-d'),
            							'time_created'=>date('H:i:s')							
                                    );
            					 
                                   $result = $this->db->insert('tr_jo_emkl_trx_dtl', $job_order_emkl_detail_data);
                                   if (!$result){
                                        $error = true;
                                        break;
                                   }
                                }
                            }
                        }
                    }
                    else{
                        $error = true;
                    }           
                    
                    if(empty($dataPost['container_no_20ft'])){
                        $countDetail20ft = 0;                
                    }
                    else{
                        $countDetail20ft = count($dataPost['container_no_20ft']);
                        $container_no_20ft = $dataPost['container_no_20ft'];
                        $seal_no_20ft = $dataPost['seal_no_20ft'];
                        $replacement_seal_no_20ft = $dataPost['replacement_seal_no_20ft'];
                        $weight_20ft = $dataPost['weight_20ft'];
                    }
        
                    if(empty($dataPost['container_no_40ft'])){
                        $countDetail40ft = 0;                
                    }
                    else{
                        $countDetail40ft = count($dataPost['container_no_40ft']);
                        $container_no_40ft = $dataPost['container_no_40ft'];
                        $seal_no_40ft = $dataPost['seal_no_40ft'];
                        $replacement_seal_no_40ft = $dataPost['replacement_seal_no_40ft'];
                        $weight_40ft = $dataPost['weight_40ft'];
                    }
                    
                    if(empty($dataPost['container_no_45ft'])){
                        $countDetail45ft = 0;                
                    }
                    else{
                        $countDetail45ft = count($dataPost['container_no_45ft']);
                        $container_no_45ft = $dataPost['container_no_45ft'];
                        $seal_no_45ft = $dataPost['seal_no_45ft'];
                        $replacement_seal_no_45ft = $dataPost['replacement_seal_no_45ft'];
                        $weight_45ft = $dataPost['weight_45ft'];
                    }
                    
                    if ($result){
                        for($i=0;$i<$countDetail20ft;$i++){
                            $data_container20ft = array(
                                'jo_no' => $job_order_emkl_no,
                                'container_type' => '20ft',
                                'container_no' => $container_no_20ft[$i],
                                'seal_no' => $seal_no_20ft[$i],
                                'replacement_seal_no' => $replacement_seal_no_20ft[$i],
                                'weight' => str_replace('.','',$weight_20ft[$i]),
                                'user_created' => $this->session->userdata('user_id'),
                                'date_created' => date('Y-m-d'),
                                'time_created' => date('H:i:s')
                            );
                            
                            $result = $this->db->insert('tr_container_trx', $data_container20ft);
                            if (!$result){
                                $error = true;
                                break;
                            }
                                           
                        }
                    }
                    else{
                        $error = true;
                    }
                    
                    if ($result){
                        for($i=0;$i<$countDetail40ft;$i++){
                            $data_container40ft = array(
                                'jo_no' => $job_order_emkl_no,
                                'container_type' => '40ft',
                                'container_no' => $container_no_40ft[$i],
                                'seal_no' => $seal_no_40ft[$i],
                                'replacement_seal_no' => $replacement_seal_no_40ft[$i],
                                'weight' => str_replace('.','',$weight_40ft[$i]),
                                'user_created' => $this->session->userdata('user_id'),
                                'date_created' => date('Y-m-d'),
                                'time_created' => date('H:i:s')
                            );
                            
                            $result = $this->db->insert('tr_container_trx', $data_container40ft);
                            if (!$result){
                                $error = true;
                                break;
                            }
                                           
                        }
                    }
                    else{
                        $error = true;
                    }
                    
                    if ($result){
                        for($i=0;$i<$countDetail45ft;$i++){
                            $data_container45ft = array(
                                'jo_no' => $job_order_emkl_no,
                                'container_type' => '45ft',
                                'container_no' => $container_no_45ft[$i],
                                'seal_no' => $seal_no_45ft[$i],
                                'replacement_seal_no' => $replacement_seal_no_45ft[$i],
                                'weight' => str_replace('.','',$weight_45ft[$i]),
                                'user_created' => $this->session->userdata('user_id'),
                                'date_created' => date('Y-m-d'),
                                'time_created' => date('H:i:s')
                            );
                            
                            $result = $this->db->insert('tr_container_trx', $data_container45ft);
                            if (!$result){
                                $error = true;
                                break;
                            }
                                           
                        }
                    }
                    else{
                        $error = true;
                    }
                    
                    $status = $this->db->trans_status();
                    if ($status === false || $error == true){
                        $this->db->trans_rollback();
                        
                        $params['user_rowID'] = $this->tank_auth->get_user_id();
        				$params['module'] = 'ERROR ROLLBACK Invoice';
        				$params['module_field_id'] = 0;
        				$params['activity'] = ucfirst('Deleted a Job Order EMKL No '.$job_order_emkl_no);
        				$params['icon'] = 'fa-exclamation-triangle';
        				modules::run('activitylog/log',$params);
                        
                        $this->session->set_flashdata('response_status', 'error');
    					$this->session->set_flashdata('message', "Failed Data RollBack");
                        
                    }
                    else{
                        $this->db->trans_commit();
                                           
    					$params['user_rowID'] = $this->tank_auth->get_user_id();
    					$params['module'] = 'Job Order EMKL';
    					$params['module_field_id'] = $new_job_order_emkl_code;
    					$params['activity'] = ucfirst('Added a new Job Order EMKL No '.$job_order_emkl_no);
    					$params['icon'] = 'fa-plus';
    					modules::run('activitylog/log',$params); //log activity
    
    					$this->session->set_flashdata('response_status', 'success');
    					$this->session->set_flashdata('message', lang('job_order_emkl').' '.lang('created_succesfully'));
					}
                    
                    redirect('job_order_emkl');
				}
		}else{
			$this->load->module('layouts');
			$this->load->library('template');
            $data['page'] = lang('job_order_emkl');
            $data['datatables'] = true;
            $data['form'] = true;

			$data['jo_type'] = $this->job_order_emkl_model->get_all_records($table = 'sa_reference', $array = array(
			'type_ref' => 'jo_type'), $join_table = '', $join_criteria = '','type_no','ASC');			
			
			$data['debtors'] = $this->job_order_emkl_model->get_all_records($table = 'sa_debtor', $array = array(
			'type' => 'C','rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','debtor_name','ASC');
			
			$data['ports'] = $this->job_order_emkl_model->get_all_records($table = 'sa_port', $array = array(
			'rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','port_name','ASC');	
			
			$data['fare_trips'] = $this->job_order_emkl_model->get_all_record_data_active();

			$data['items'] = $this->job_order_emkl_model->get_all_records($table = 'sa_item', $array = array(
			'rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','item_name','ASC');
			
			$this->template
			->set_layout('users')
			->build('create_job_order_emkl',isset($data) ? $data : NULL);
		}
	}

	function update_job_order_emkl()
	{
		if ($this->input->post()) {	
                $error = false;
                $result = true;
                $this->db->trans_begin();
                $dataPost = $this->input->post();
                
				$year=$this->input->post('job_order_emkl_year');
				$month=$this->input->post('job_order_emkl_month');
				$code=$this->input->post('job_order_emkl_code');
				$job_order_emkl_no=$this->input->post('job_order_emkl_no');
				
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
				$this->form_validation->set_rules('job_order_emkl_type', 'Type', 'required|numeric');
				$this->form_validation->set_rules('debtor', 'Debtor', 'required|numeric');
				$this->form_validation->set_rules('po_spk_no', 'PO/SPK No', 'required');
				$this->form_validation->set_rules('port', 'Port', 'required|numeric');
				
				if ($this->form_validation->run() == FALSE)
				{
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('error_in_form'));
					redirect('job_order_emkl/update_job_order_emkl/'.$year.'/'.$month.'/'.$code);	
				}else{	
                    if ($result){
    					$job_order_emkl_data = array(
    						'jo_type'=>$this->input->post('job_order_emkl_type'),
    						'debtor_rowID'=>$this->input->post('debtor'),
    						'po_spk_no'=>strtoupper(trim($this->input->post('po_spk_no'))),
    						'so_no'=>strtoupper(trim($this->input->post('so_no'))),
    						'bl_no'=>strtoupper(trim($this->input->post('bl_no'))),
                            'port_jo_type'=>$this->input->post('port_jo_type'),
                            'port_rowID'=>$this->input->post('port'),
    						'vessel_rowID'=>$this->input->post('vessel_rowID'),
    						'vessel_no'=>strtoupper(trim($this->input->post('vessel_no'))),
    						'vessel_name'=>strtoupper(trim($this->input->post('vessel_name'))),
    						'description'=>ucfirst($this->input->post('job_order_emkl_desc')),
    						'user_modified'=>$this->session->userdata('user_rowID'),
    						'date_modified'=>date('Y-m-d'),
    						'time_modified'=>date('H:i:s')
                        );
    					 
    					$this->db->where('year',$year);
    					$this->db->where('month',$month);
    					$this->db->where('code',$code);
                        
                        $result = $this->db->update('tr_jo_emkl_trx_hdr', $job_order_emkl_data);
                        if (!$result){
                            $error = true;
                        }
                    }
                    else{
                        $error = true;
                    }
                    
                    /*
                    if ($result){
                        $result = $this->job_order_emkl_model->delete_detail_jo($job_order_emkl_no);
                        if ($result){
                            $result = $this->job_order_emkl_model->delete_detail_container_jo($job_order_emkl_no);
                            if ($result){
                                $result = $this->job_order_emkl_model->delete_do_container_jo($job_order_emkl_no);
                                if (!$result){
                                    $error = true;
                                }
                            }
                        }
                        else{
                            $error = true;                            
                        }
                    }
                    else{
                        $error = true;
                    }
                    */
                    
                    if ($result){
                        if(count($this->input->post('cargo')) > 0){
                            $total_detail = count($this->input->post('cargo'));
                            $dtl_rowID = $this->input->post('dtl_rowID');
                            $cargo = $this->input->post('cargo');
                            $destination = $this->input->post('destination');
                            $weight = $this->input->post('weight');
                            $container_type = $this->input->post('container_type');
                            
                            if($this->input->post('cargo') != ''){
                                for($i=0;$i<$total_detail;$i++){
                                    $job_order_emkl_detail_data = array(
            							'jo_no'=>$job_order_emkl_no,
            							'item_rowID'=>$cargo[$i],
            							'fare_trip_rowID'=>$destination[$i],
            							'weight'=>str_replace('.','',$weight[$i]),
            							'container_type'=>$container_type[$i],
                                        'user_created'=>$this->input->post('user_created'),
                                        'date_created'=>$this->input->post('date_created'),
                                        'time_created'=>$this->input->post('time_created'),
            							'user_modified'=>$this->session->userdata('user_rowID'),
            							'date_modified'=>date('Y-m-d'),
            							'time_modified'=>date('H:i:s'),
						
                                    );
            					 
                                   //$result = $this->db->insert('tr_jo_emkl_trx_dtl', $job_order_emkl_detail_data);
                                   $this->db->where('rowID',$dtl_rowID[$i]);
                                   $result = $this->db->update('tr_jo_emkl_trx_dtl', $job_order_emkl_detail_data);
                                   if (!$result){
                                        $error = true;
                                        break;
                                   }
                                }
                            }
                        }
                    }
                    else{
                        $error = true;
                    }
                    
                    
                    if(empty($dataPost['container_no_20ft'])){
                        $countDetail20ft = 0;                
                    }
                    else{
                        $countDetail20ft = count($dataPost['container_no_20ft']);
                        $rowID_20ft = $dataPost['rowID_20ft'];
                        $container_no_20ft = $dataPost['container_no_20ft'];
                        $seal_no_20ft = $dataPost['seal_no_20ft'];
                        $replacement_seal_no_20ft = $dataPost['replacement_seal_no_20ft'];
                        $weight_20ft = $dataPost['weight_20ft'];
                    }
        
                    if(empty($dataPost['container_no_40ft'])){
                        $countDetail40ft = 0;                
                    }
                    else{
                        $countDetail40ft = count($dataPost['container_no_40ft']);
                        $rowID_40ft = $dataPost['rowID_40ft'];
                        $container_no_40ft = $dataPost['container_no_40ft'];
                        $seal_no_40ft = $dataPost['seal_no_40ft'];
                        $replacement_seal_no_40ft = $dataPost['replacement_seal_no_40ft'];
                        $weight_40ft = $dataPost['weight_40ft'];
                    }
                    
                    if(empty($dataPost['container_no_45ft'])){
                        $countDetail45ft = 0;                
                    }
                    else{
                        $countDetail45ft = count($dataPost['container_no_45ft']);
                        $rowID_45ft = $dataPost['rowID_45ft'];
                        $container_no_45ft = $dataPost['container_no_45ft'];
                        $seal_no_45ft = $dataPost['seal_no_45ft'];
                        $replacement_seal_no_45ft = $dataPost['replacement_seal_no_45ft'];
                        $weight_45ft = $dataPost['weight_45ft'];
                    }
                    
                    if ($result){
                        for($i=0;$i<$countDetail20ft;$i++){
                            $data_container20ft = array(
                                'jo_no' => $job_order_emkl_no,
                                'container_type' => '20ft',
                                'container_no' => $container_no_20ft[$i],
                                'seal_no' => $seal_no_20ft[$i],
                                'replacement_seal_no' => $replacement_seal_no_20ft[$i],
                                'weight' => str_replace('.','',$weight_20ft[$i]),
                                'user_created'=>$this->input->post('user_created'),
                                'date_created'=>$this->input->post('date_created'),
                                'time_created'=>$this->input->post('time_created'),
    							'user_modified'=>$this->session->userdata('user_rowID'),
    							'date_modified'=>date('Y-m-d'),
    							'time_modified'=>date('H:i:s'),
                            );
                            
                            //$result = $this->db->insert('tr_container_trx', $data_container20ft);
                            $this->db->where('rowID',$rowID_20ft[$i]);
                            $result = $this->db->update('tr_container_trx', $data_container20ft);       
                            if (!$result){
                                $error = true;
                                break;
                            }
                                           
                        }
                    }
                    else{
                        $error = true;
                    }
                    
                    if ($result){
                        for($i=0;$i<$countDetail40ft;$i++){
                            $data_container40ft = array(
                                'jo_no' => $job_order_emkl_no,
                                'container_type' => '40ft',
                                'container_no' => $container_no_40ft[$i],
                                'seal_no' => $seal_no_40ft[$i],
                                'replacement_seal_no' => $replacement_seal_no_40ft[$i],
                                'weight' => str_replace('.','',$weight_40ft[$i]),
                                'user_created'=>$this->input->post('user_created'),
                                'date_created'=>$this->input->post('date_created'),
                                'time_created'=>$this->input->post('time_created'),
    							'user_modified'=>$this->session->userdata('user_rowID'),
    							'date_modified'=>date('Y-m-d'),
    							'time_modified'=>date('H:i:s'),
                            );
                            
                            //$result = $this->db->insert('tr_container_trx', $data_container40ft);
                            $this->db->where('rowID',$rowID_40ft[$i]);
                            $result = $this->db->update('tr_container_trx', $data_container40ft);       
                            if (!$result){
                                $error = true;
                                break;
                            }
                                           
                        }
                    }
                    else{
                        $error = true;
                    }
                    
                    if ($result){
                        for($i=0;$i<$countDetail45ft;$i++){
                            $data_container45ft = array(
                                'jo_no' => $job_order_emkl_no,
                                'container_type' => '45ft',
                                'container_no' => $container_no_45ft[$i],
                                'seal_no' => $seal_no_45ft[$i],
                                'replacement_seal_no' => $replacement_seal_no_45ft[$i],
                                'weight' => str_replace('.','',$weight_45ft[$i]),
                                'user_created'=>$this->input->post('user_created'),
                                'date_created'=>$this->input->post('date_created'),
                                'time_created'=>$this->input->post('time_created'),
    							'user_modified'=>$this->session->userdata('user_rowID'),
    							'date_modified'=>date('Y-m-d'),
    							'time_modified'=>date('H:i:s'),
                            );
                            
                            //$result = $this->db->insert('tr_container_trx', $data_container45ft);
                            $this->db->where('rowID',$rowID_45ft[$i]);
                            $result = $this->db->update('tr_container_trx', $data_container45ft);       
                            if (!$result){
                                $error = true;
                                break;
                            }
                                           
                        }
                    }
                    else{
                        $error = true;
                    }
                    
                    $status = $this->db->trans_status();
                    if ($status === false || $error == true){
                        $this->db->trans_rollback();
                        
                        $params['user_rowID'] = $this->tank_auth->get_user_id();
        				$params['module'] = 'ERROR ROLLBACK Invoice';
        				$params['module_field_id'] = 0;
        				$params['activity'] = ucfirst('Deleted a Job Order EMKL No '.$job_order_emkl_no);
        				$params['icon'] = 'fa-exclamation-triangle';
        				modules::run('activitylog/log',$params);
                        
                        $this->session->set_flashdata('response_status', 'error');
    					$this->session->set_flashdata('message', "Failed Data RollBack");
                        
                    }
                    else{
                        $this->db->trans_commit();
                                           
    					$params['user_rowID'] = $this->tank_auth->get_user_id();
    					$params['module'] = 'Job Order EMKL';
    					$params['module_field_id'] = $code;
    					$params['activity'] = ucfirst('Updated a Job Order EMKL No : '.$job_order_emkl_no);
    					$params['icon'] = 'fa-edit';
    					modules::run('activitylog/log',$params); //log activity
    
    					$this->session->set_flashdata('response_status', 'success');
					   $this->session->set_flashdata('message', lang('job_order_emkl').' '.lang('updated_succesfully'));
					}
                    
                    redirect('job_order_emkl');
                    
				}
		}else{
			$this->load->module('layouts');
			$this->load->library('template');
            $data['page'] = lang('job_order_emkl');
            $data['datatables'] = true;
            $data['form'] = true;
			
			$data['job_order_emkls'] = $this->job_order_emkl_model->get_records_details($this->uri->segment(3),$this->uri->segment(4),$this->uri->segment(5));
            
            $get_data = $this->job_order_emkl_model->get_data_jo_header_by_jo($this->uri->segment(3),$this->uri->segment(4),$this->uri->segment(5));
            $get_data_detail = $this->job_order_emkl_model->get_data_jo_detail_by_jo_no($get_data->jo_no);
            $data['get_data_detail'] = $get_data_detail;
            $data['count_data_detail_jo'] = count($get_data_detail);

            $get_data_container_20ft_detail = $this->job_order_emkl_model->get_data_container_detail_by_jo_no('20ft',$get_data->jo_no);
            $data['get_data_container_20ft_detail'] = $get_data_container_20ft_detail;
            $data['count_data_container_20ft_detail'] = count($get_data_container_20ft_detail);

            $get_data_container_40ft_detail = $this->job_order_emkl_model->get_data_container_detail_by_jo_no('40ft',$get_data->jo_no);
            $data['get_data_container_40ft_detail'] = $get_data_container_40ft_detail;
            $data['count_data_container_40ft_detail'] = count($get_data_container_40ft_detail);

            $get_data_container_45ft_detail = $this->job_order_emkl_model->get_data_container_detail_by_jo_no('45ft',$get_data->jo_no);
            $data['get_data_container_45ft_detail'] = $get_data_container_45ft_detail;
            $data['count_data_container_45ft_detail'] = count($get_data_container_45ft_detail);

			$data['jo_type'] = $this->job_order_emkl_model->get_all_records($table = 'sa_reference', $array = array(
			'type_ref' => 'jo_type'), $join_table = '', $join_criteria = '','type_no','ASC');			
			
			$data['debtors'] = $this->job_order_emkl_model->get_all_records($table = 'sa_debtor', $array = array(
			'type' => 'C','rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','debtor_name','ASC');
			
            $data['fare_trips'] = $this->job_order_emkl_model->get_all_record_data_active();

			$data['items'] = $this->job_order_emkl_model->get_all_records($table = 'sa_item', $array = array(
			'rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','item_name','ASC');
			
			$this->template
			->set_layout('users')
			->build('update_job_order_emkl',isset($data) ? $data : NULL);
		}
	}
	
    function document_detail()
	{
		
		if ($this->input->post()) {	
				$error = false;
                $result = true;
                $this->db->trans_begin();
                $dataPost = $this->input->post();
                 
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
				$this->form_validation->set_rules('jo_no', lang('job_order_emkl_no'), 'required');
				
				if ($this->form_validation->run() == FALSE)
				{
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('error_in_form'));
					redirect('job_order_emkl');
				}else{
				    if(empty($dataPost['rowID'])){
                        if ($result){
                            $document_job_order_emkl_data = array(
        						'jo_no'=>$dataPost['jo_no'],
        						'po_no'=>$dataPost['jo_no'],
        						'bl_no'=>$dataPost['bl_no'],
                                'eta_date'=>date('Y-m-d',strtotime($dataPost['eta_date'])),
                                'start_demurage'=>date('Y-m-d',strtotime($dataPost['start_demurage'])),
        						'free_time'=>$dataPost['free_time'],
        						'sppb_date'=>date('Y-m-d',strtotime($dataPost['sppb_date'])),
        						'po_check'=>empty($dataPost['po_check']) ? 0 : $dataPost['po_check'],
        						'po_date'=>date('Y-m-d',strtotime($dataPost['po_date'])),
        						'po_original'=>empty($dataPost['po_original']) ? 0 : $dataPost['po_original'],
        						'po_copy'=>empty($dataPost['po_copy']) ? 0 : $dataPost['po_copy'],
        						'bl_check'=>empty($dataPost['bl_check']) ? 0 : $dataPost['bl_check'],
        						'bl_date'=>date('Y-m-d',strtotime($dataPost['bl_date'])),
        						'bl_original'=>empty($dataPost['bl_original']) ? 0 :$dataPost['bl_original'] ,
        						'bl_copy'=>empty($dataPost['bl_copy']) ? 0 : $dataPost['bl_copy'],
        						'complete_date'=>date('Y-m-d',strtotime($dataPost['complete_date'])),
        						'quarantine_officer_name'=>ucwords($dataPost['quarantine_officer_name']),                                
        						'quarantine_process_date'=>date('Y-m-d',strtotime($dataPost['quarantine_process_date'])),
        						'quarantine_finish_date'=>date('Y-m-d',strtotime($dataPost['quarantine_finish_date'])),
        						'quarantine_type'=>ucwords($dataPost['quarantine_type']),
        						'tila_officer_name'=>ucwords($dataPost['tila_officer_name']),
        						'tila_date'=>date('Y-m-d',strtotime($dataPost['tila_date'])),
        						'reimburse_date'=>date('Y-m-d',strtotime($dataPost['reimburse_date'])),
        						'survey_date'=>date('Y-m-d',strtotime($dataPost['survey_date'])),
        						'guarantee_officer_name'=>ucwords($dataPost['guarantee_officer_name']),
        						'guarantee_date'=>date('Y-m-d',strtotime($dataPost['guarantee_date'])),
        						'back_guarantee_date'=>date('Y-m-d',strtotime($dataPost['back_guarantee_date'])),
        						'finish_guarantee_date'=>date('Y-m-d',strtotime($dataPost['finish_guarantee_date'])),
        						'user_created'=>$this->session->userdata('user_rowID'),
        						'date_created'=>date('Y-m-d'),
        						'time_created'=>date('H:i:s')							
                            );
        					  
        					$result = $this->db->insert('tr_jo_emkl_trx_doc', $document_job_order_emkl_data);
                            $insert_id = $this->db->insert_id(); 
                            if($result){
                                if(count($this->input->post('officer_name')) > 0){
                                    $total_detail = count($this->input->post('officer_name'));
                                    $officer_name = $this->input->post('officer_name');
                                    $collection_date = $this->input->post('collection_date');
                                    $remark = $this->input->post('remark');
                                    
                                    if($this->input->post('officer_name') != ''){
                                        for($i=0;$i<$total_detail;$i++){
                                            $do_proccess_detail_data = array(
                    							'jo_no'=>$dataPost['jo_no'],
                    							'officer_name'=>$officer_name[$i],
                    							'collection_date'=>date('Y-m-d',strtotime($collection_date[$i])),
                    							'remark'=>$remark[$i],
                    							'user_created'=>$this->session->userdata('user_rowID'),
                    							'date_created'=>date('Y-m-d'),
                    							'time_created'=>date('H:i:s')
                                            );
                    					 
                                           $result = $this->db->insert('tr_jo_emkl_trx_do_process', $do_proccess_detail_data);
                                           if (!$result){
                                                $error = true;
                                                break;
                                           }
                                        }
                                    }
                                }
                            }
                            else{
                                $error = true;
                            }
                        }
                        else{
                            $error = true;
                        }
                        
                        $status = $this->db->trans_status();
                        if ($status === false || $error == true){
                            $this->db->trans_rollback();
                            
                            $params['user_rowID'] = $this->tank_auth->get_user_id();
            				$params['module'] = 'ERROR ROLLBACK Invoice';
            				$params['module_field_id'] = $insert_id;
            				$params['activity'] = ucfirst('Deleted a Document Job Order EMKL No '.$dataPost['jo_no']);
            				$params['icon'] = 'fa-exclamation-triangle';
            				modules::run('activitylog/log',$params);
                            
                            $this->session->set_flashdata('response_status', 'error');
        					$this->session->set_flashdata('message', "Failed Data RollBack");
                            
                        }
                        else{
                            $this->db->trans_commit();
                                               
        					$params['user_rowID'] = $this->tank_auth->get_user_id();
        					$params['module'] = 'Job Order EMKL';
        					$params['module_field_id'] = $insert_id;
        					$params['activity'] = ucfirst('Added a new Document Job Order EMKL No '.$dataPost['jo_no']);
        					$params['icon'] = 'fa-plus';
        					modules::run('activitylog/log',$params); //log activity
        
        					$this->session->set_flashdata('response_status', 'success');
        					$this->session->set_flashdata('message', 'Document '. lang('job_order_emkl').' '.lang('created_succesfully'));
    					}
                    }
                    else{
                        if ($result){
                            $document_job_order_emkl_data = array(
        						'jo_no'=>$dataPost['jo_no'],
        						'po_no'=>$dataPost['jo_no'],
        						'bl_no'=>$dataPost['bl_no'],
                                'eta_date'=>date('Y-m-d',strtotime($dataPost['eta_date'])),
                                'start_demurage'=>date('Y-m-d',strtotime($dataPost['start_demurage'])),
        						'free_time'=>$dataPost['free_time'],
        						'sppb_date'=>date('Y-m-d',strtotime($dataPost['sppb_date'])),
        						'po_check'=>empty($dataPost['po_check']) ? 0 : $dataPost['po_check'],
        						'po_date'=>date('Y-m-d',strtotime($dataPost['po_date'])),
        						'po_original'=>empty($dataPost['po_original']) ? 0 : $dataPost['po_original'],
        						'po_copy'=>empty($dataPost['po_copy']) ? 0 : $dataPost['po_copy'],
        						'bl_check'=>empty($dataPost['bl_check']) ? 0 : $dataPost['bl_check'],
        						'bl_date'=>date('Y-m-d',strtotime($dataPost['bl_date'])),
        						'bl_original'=>empty($dataPost['bl_original']) ? 0 :$dataPost['bl_original'] ,
        						'bl_copy'=>empty($dataPost['bl_copy']) ? 0 : $dataPost['bl_copy'],
        						'complete_date'=>date('Y-m-d',strtotime($dataPost['complete_date'])),
        						'quarantine_officer_name'=>ucwords($dataPost['quarantine_officer_name']),                                
        						'quarantine_process_date'=>date('Y-m-d',strtotime($dataPost['quarantine_process_date'])),
        						'quarantine_finish_date'=>date('Y-m-d',strtotime($dataPost['quarantine_finish_date'])),
        						'quarantine_type'=>ucwords($dataPost['quarantine_type']),
        						'tila_officer_name'=>ucwords($dataPost['tila_officer_name']),
        						'tila_date'=>date('Y-m-d',strtotime($dataPost['tila_date'])),
        						'reimburse_date'=>date('Y-m-d',strtotime($dataPost['reimburse_date'])),
        						'survey_date'=>date('Y-m-d',strtotime($dataPost['survey_date'])),
        						'guarantee_officer_name'=>ucwords($dataPost['guarantee_officer_name']),
        						'guarantee_date'=>date('Y-m-d',strtotime($dataPost['guarantee_date'])),
        						'back_guarantee_date'=>date('Y-m-d',strtotime($dataPost['back_guarantee_date'])),
        						'finish_guarantee_date'=>date('Y-m-d',strtotime($dataPost['finish_guarantee_date'])),
        						'user_modified'=>$this->session->userdata('user_rowID'),
        						'date_modified'=>date('Y-m-d'),
        						'time_modified'=>date('H:i:s')							
                            );
       					    $this->db->where('rowID',$dataPost['rowID']);
        					$result = $this->db->update('tr_jo_emkl_trx_doc', $document_job_order_emkl_data);
                            if ($result){
                                $result = $this->job_order_emkl_model->delete_detail_doc_jo($dataPost['jo_no']);
                                if ($result){
                                    if(count($this->input->post('officer_name')) > 0){
                                        $total_detail = count($this->input->post('officer_name'));
                                        $officer_name = $this->input->post('officer_name');
                                        $collection_date = $this->input->post('collection_date');
                                        $remark = $this->input->post('remark');
                                        
                                        if($this->input->post('officer_name') != ''){
                                            for($i=0;$i<$total_detail;$i++){
                                                $do_proccess_detail_data = array(
                        							'jo_no'=>$dataPost['jo_no'],
                        							'officer_name'=>$officer_name[$i],
                        							'collection_date'=>date('Y-m-d',strtotime($collection_date[$i])),
                        							'remark'=>$remark[$i],
                        							'user_created'=>$dataPost['user_created'],
                        							'date_created'=>$dataPost['date_created'],
                        							'time_created'=>$dataPost['time_created'],
                                                    'user_modified'=>$this->session->userdata('user_rowID'),
                            						'date_modified'=>date('Y-m-d'),
                            						'time_modified'=>date('H:i:s')
                                                );
                        					 
                                                $result = $this->db->insert('tr_jo_emkl_trx_do_process', $do_proccess_detail_data);
                                                
                                                if (!$result){
                                                    $error = true;
                                                    break;
                                                }
                                            }
                                        }
                                    }
                                }
                                else{
                                    $error = true;                                    
                                }
                            }
                            else{
                                $error = true;
                            }
                        }
                        else{
                            $error = true;
                        }
                        
                        $status = $this->db->trans_status();
                        if ($status === false || $error == true){
                            $this->db->trans_rollback();
                            
                            $params['user_rowID'] = $this->tank_auth->get_user_id();
            				$params['module'] = 'ERROR ROLLBACK Invoice';
            				$params['module_field_id'] = $dataPost['rowID'];
            				$params['activity'] = ucfirst('Deleted a Document Job Order EMKL No '.$dataPost['jo_no']);
            				$params['icon'] = 'fa-exclamation-triangle';
            				modules::run('activitylog/log',$params);
                            
                            $this->session->set_flashdata('response_status', 'error');
        					$this->session->set_flashdata('message', "Failed Data RollBack");
                            
                        }
                        else{
                            $this->db->trans_commit();
                                               
        					$params['user_rowID'] = $this->tank_auth->get_user_id();
        					$params['module'] = 'Job Order EMKL';
        					$params['module_field_id'] = $dataPost['rowID'];
        					$params['activity'] = ucfirst('Updated a Document Job Order EMKL No '.$dataPost['jo_no']);
        					$params['icon'] = 'fa-edit';
        					modules::run('activitylog/log',$params); //log activity
        
        					$this->session->set_flashdata('response_status', 'success');
        					$this->session->set_flashdata('message', 'Document '. lang('job_order_emkl').' '.lang('updated_succesfully'));
    					}
                    }
                    
                    redirect('job_order_emkl');
				}
		}else{
			$this->load->module('layouts');
			$this->load->library('template');
            $data['page'] = lang('job_order_emkl');
            $data['datatables'] = true;
            $data['form'] = true;

            $get_data = $this->job_order_emkl_model->get_data_jo_header_by_jo($this->uri->segment(3),$this->uri->segment(4),$this->uri->segment(5));
            $get_document_data = $this->job_order_emkl_model->get_data_jo_document_by_jo($get_data->jo_no);
            $get_document_process_data = $this->job_order_emkl_model->get_data_document_process_by_jo($get_data->jo_no);
            
            $data['job_order_emkl'] = $get_data;
            $data['document_detail'] = $get_document_data;
            $data['document_process_data'] = $get_document_process_data;
            $data['count_data_detail_do_process'] = count($get_document_process_data);
            
			$this->template
			->set_layout('users')
			->build('create_document_detail',isset($data) ? $data : NULL);
		}
	}
    
	public function get_fair_trip() {
		$term = $this->input->get('term');
		// variable lain bisa dipake dari view yang diset
		// $datalain = $this->input->get('datalain');

		// load data ke model
		$data_sparepart = $this->job_order_emkl_model->get_fare_trip_by($term);

		// keluarkan dalam bentuk json
		echo json_encode($data_sparepart);   
	}

		
	function get_wo_debtor(){
        $debtor_rowID=$this->input->post('debtor_rowID');
        $data=array(
            'wo_lists'=> $this->job_order_emkl_model->get_all_record_debtor_wo($debtor_rowID)
        );

		$this->load->view('ajax_wo_type',$data);
    }
	
	function get_wo(){
        $wo_no=$this->input->post('wo_no');
        $data=array(
            'wo_lists'=> $this->job_order_emkl_model->get_all_record_wo($wo_no)
        ); 	
		$this->load->view('ajax_jo_type',$data);
    }

	

	
	function delete_job_order_emkl()
	{
		if ($this->input->post()) {
			$year = $this->input->post('year');
			$month = $this->input->post('month');
			$code = $this->input->post('code');			
			$jo_no = $this->input->post('jo_no');	
			
            $job_order_emkl_data = array(
							'deleted'=>1,
							'user_deleted'=>$this->session->userdata('user_rowID'),
							'date_deleted'=>date('Y-m-d'),
							'time_deleted'=>date('H:i:s')							
			            );
			$this->db->where('year',$year);
			$this->db->where('month',$month);
			$this->db->where('code',$code);
			$this->db->where('deleted',0);
			$this->db->update('tr_jo_emkl_trx_hdr',$job_order_emkl_data);
			
            $this->job_order_emkl_model->delete_detail_jo($jo_no);
            $this->job_order_emkl_model->delete_document_detail_jo($jo_no);
            $this->job_order_emkl_model->delete_container_jo($jo_no);
            $this->job_order_emkl_model->delete_do_process_jo($jo_no);
            
			$params['user_rowID'] = $this->tank_auth->get_user_id();
			$params['module'] = 'Job Order EMKL';
			$params['module_field_id'] = $code;
			$params['activity'] = ucfirst('Deleted a Job Order EMKL No : '.$jo_no);
			$params['icon'] = 'fa-trash-o';
			modules::run('activitylog/log',$params); //log activity	
			
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('job_order_emkl').' '.lang('deleted_successfully'));
			redirect('job_order_emkl');
		}else{
			
			$data['job_order_emkls'] = $this->job_order_emkl_model->get_records_details($this->uri->segment(3),$this->uri->segment(4),$this->uri->segment(5));
			$this->load->view('modal/delete_job_order_emkl',$data);

		}
	}

    function fetch_data() { 
        if ($this->input->is_ajax_request()) {
            $dt = $_POST;

            if($this->session->userdata('start_date_jo_emkl') == '' ){
                $start_date = date("Y-m-d", strtotime('-6 day'));
            }else{
                $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_jo_emkl')));
            }

            if($this->session->userdata('end_date_jo_emkl') == ''){
                $end_date = date("Y-m-d");
            }else{
                $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_jo_emkl')));
            }
            $str_between = " AND tr_jo_emkl_trx_hdr.jo_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";
        
            $dt['table'] = 'tr_jo_emkl_trx_hdr';
            $dt['id'] = 'year';

            $aColumnTable = array(
                'tr_jo_emkl_trx_hdr.year', 'tr_jo_emkl_trx_hdr.jo_no', 'tr_jo_emkl_trx_hdr.jo_date', 'tr_jo_emkl_trx_hdr.jo_type', 'sa_debtor.debtor_cd', 'tr_jo_emkl_trx_hdr.po_spk_no', 'tr_jo_emkl_trx_hdr.so_no', 'tr_jo_emkl_trx_hdr.vessel_no', 'sa_port.port_cd', 'tr_jo_emkl_trx_hdr.status', 'sa_debtor.debtor_name', 'tr_jo_emkl_trx_hdr.vessel_name', 'sa_port.port_name', 'tr_jo_emkl_trx_hdr.month', 'tr_jo_emkl_trx_hdr.invoice_no', 'tr_jo_emkl_trx_hdr.code'
            );

            $aColumns = array(
                'tr_jo_emkl_trx_hdr.year', 'tr_jo_emkl_trx_hdr.jo_no', 'tr_jo_emkl_trx_hdr.jo_date', 'tr_jo_emkl_trx_hdr.jo_type', 'sa_debtor.debtor_cd', 'tr_jo_emkl_trx_hdr.po_spk_no', 'tr_jo_emkl_trx_hdr.so_no', 'tr_jo_emkl_trx_hdr.vessel_no', 'sa_port.port_cd', 'tr_jo_emkl_trx_hdr.status', 'sa_debtor.debtor_name', 'tr_jo_emkl_trx_hdr.vessel_name', 'sa_port.port_name', 'tr_jo_emkl_trx_hdr.month', 'tr_jo_emkl_trx_hdr.invoice_no', 'tr_jo_emkl_trx_hdr.code'
            );

            $groupBy = '';

            /** Paging * */
            $sLimit = "";
            if (isset($dt['start']) && $dt['length'] != '-1') {
                $sLimit = " LIMIT " . intval($dt['start']) . ", " . intval($dt['length']);
            }

            /** Ordering * */
            $sOrder = " ORDER BY ";
            $sOrderIndex = $dt['order'][0]['column'];
            $sOrderDir = $dt['order'][0]['dir'];
            $bSortable_ = $dt['columns'][$sOrderIndex]['orderable'];
            if ($bSortable_ == "true") {
                $sOrder .= $aColumnTable[$sOrderIndex] . ($sOrderDir === 'asc' ? ' asc' : ' desc');
            } else {
                $sOrder .= "tr_jo_emkl_trx_hdr.jo_no DESC";
            }

            /* Individual column filtering */
            $sSearchReg = $dt['search']['regex'];
            for ($i = 0; $i < count($aColumns); $i++) {
                $bSearchable_ = $dt['columns'][$i]['searchable'];
                if (isset($bSearchable_) && $bSearchable_ == "true" && $sSearchReg != 'false') {
                    $search_val = $dt['columns'][$i]['search']['value'];
                    if ($sWhere == "") {
                        $sWhere = " WHERE ";
                    } else {
                        $sWhere .= " AND ";
                    }
                    $sWhere .= $aColumns[$i] . " LIKE '%" . $this->db->escape_like_str($search_val) . "%' ";
                }
            }

            if (!empty($dt['columns'][10]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $start_date = date('Y-m-d', strtotime($dt['columns'][10]['search']['value']));
                $this->session->set_userdata('start_date_jo_emkl',date("Y-m-d",strtotime($start_date)));

                if($this->session->userdata('end_date_jo_emkl') == ''){
                    $end_date = date("Y-m-d");
                }else{
                    $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_jo_emkl')));
                }
                $str_between = " AND tr_jo_emkl_trx_hdr.jo_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";

                $sWhere.= ' tr_jo_emkl_trx_hdr.deleted = 0 ' . $str_between; 
            }

            if (!empty($dt['columns'][11]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $end_date = date('Y-m-d', strtotime($dt['columns'][11]['search']['value']));
                $this->session->set_userdata('end_date_jo_emkl', date("Y-m-d",strtotime($end_date)));

                if($this->session->userdata('start_date_jo_emkl') == ''){
                    $start_date = date("Y-m-d", strtotime('-6 day'));
                }else{
                    $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_jo_emkl')));
                }
                $str_between = " AND tr_jo_emkl_trx_hdr.jo_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";
                
                $sWhere.= ' tr_jo_emkl_trx_hdr.deleted = 0 ' . $str_between; 
            }

            /** Filtering * */
            $sWhere = "";
            $sSearchVal = $dt['search']['value'];
            if (isset($sSearchVal) && $sSearchVal != '') {
                $sWhere = " WHERE (";
                for ($i = 0; $i < count($aColumns); $i++) {
                    $sWhere .= $aColumns[$i] . " LIKE '%" . $this->db->escape_like_str($sSearchVal) . "%' OR ";

                }

                $mystring = 'BULK, Bulk, bulk';
                $pos = strpos($mystring, $sSearchVal);
                if ($pos !== false) {
                    $sWhere .= $aColumns[3] . " LIKE '%" . $this->db->escape_like_str(1) . "%' OR ";
                }

                $mystring_2 = 'CONTAINER, Container, container';
                $pos_2 = strpos($mystring_2, $sSearchVal);
                if ($pos_2 !== false) {
                    $sWhere .= $aColumns[3] . " LIKE '%" . $this->db->escape_like_str(2) . "%' OR ";
                }

                $mystring_3 = 'OTHER, Other, other';
                $pos_3 = strpos($mystring_3, $sSearchVal);
                if ($pos_3 !== false) {
                    $sWhere .= $aColumns[3] . " LIKE '%" . $this->db->escape_like_str(3) . "%' OR ";
                }

                $sWhere = substr_replace($sWhere, "", -3);
                $sWhere .= ') AND tr_jo_emkl_trx_hdr.deleted = 0 ' . $str_between;
            }

            /** Total Data Set Length * */
            $sQuery = 'SELECT * FROM ' . $dt['table'] . ' LEFT JOIN sa_reference ON sa_reference.type_no = tr_jo_emkl_trx_hdr.jo_type AND sa_reference.type_ref="jo_type"  LEFT JOIN sa_debtor ON sa_debtor.rowID = tr_jo_emkl_trx_hdr.debtor_rowID LEFT JOIN sa_port ON sa_port.rowID = tr_jo_emkl_trx_hdr.port_rowID WHERE tr_jo_emkl_trx_hdr.deleted = 0 ' . $str_between;
            $rResultTotal = $this->db->query($sQuery);
            $aResultTotal = $rResultTotal->num_rows();
            $iTotal = $aResultTotal;
            
            /* Get Data To Display */
            if ($sWhere != "") {
                $where = $sWhere;
            } else {
                $where = " WHERE tr_jo_emkl_trx_hdr.deleted = 0 " . $str_between;
            }

            $join_table = ' LEFT JOIN sa_reference ON sa_reference.type_no = tr_jo_emkl_trx_hdr.jo_type AND sa_reference.type_ref="jo_type"  LEFT JOIN sa_debtor ON sa_debtor.rowID = tr_jo_emkl_trx_hdr.debtor_rowID LEFT JOIN sa_port ON sa_port.rowID = tr_jo_emkl_trx_hdr.port_rowID ';

            $sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) .
                    " FROM " . $dt['table'] . $join_table . $where . $groupBy . $sOrder . $sLimit;
            $rResult = $this->db->query($sQuery);

            /* Data set length after filtering */
            $sQuery = "SELECT FOUND_ROWS() AS length_count";
            $rResultFilterTotal = $this->db->query($sQuery);
            $aResultFilterTotal = $rResultFilterTotal->row();
            $iFilteredTotal = $aResultFilterTotal->length_count;

            /** Output */
            $draw = $dt['draw'];
            $data = array();
            if (!empty($rResult)) {
                foreach ($rResult->result_array() as $aRow) {
                    $dt['start'] ++;
                    $row = array();

                    $dropdown_option = "";
                    $dropdown_option .= '<div class="btn-group">';
                    $dropdown_option .= '<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">';
                    $dropdown_option .= lang('options');
                    $dropdown_option .= '<span class="caret"></span>';
                    $dropdown_option .= '</button>';
                    $dropdown_option .= '<ul class="dropdown-menu">';
                    if($this->get_user_access('Created') == 1){
                        $dropdown_option .= '<li><a href="' . base_url() . 'job_order_emkl/document_detail/' . $aRow['year'] . '/' . $aRow['month'] . '/' . $aRow['code'] . '"><i class="fa fa-list-alt"></i> ' . lang('document_detail') . '</a></li>';
                    }
                    if($aRow['invoice_no'] == ''){
                        if($this->get_user_access('Updated') == 1){
                            $dropdown_option .= '<li><a href="' . base_url() . 'job_order_emkl/update_job_order_emkl/' . $aRow['year'] . '/' . $aRow['month'] . '/' . $aRow['code'] . '"><i class="fa fa-pencil"></i>  '. lang('update_option') . '</a></li>';
                        }      
                        if($this->get_user_access('Deleted') == 1){
                            $dropdown_option .= '<li><a href="' . base_url() . 'job_order_emkl/delete_job_order_emkl/' . $aRow['year'] . '/' . $aRow['month'] . '/' . $aRow['code'] . '" data-toggle="ajaxModal"><i class="fa fa-trash-o"></i>  ' . lang('delete_option') . '</a></li>';
                        }
                    }
                    $dropdown_option .= '</ul></div>';

                    $jo_type = '-';
                    if($aRow['jo_type'] == 1){
                        $jo_type = 'BULK';                            
                    }else if($aRow['jo_type'] == 2){
                        $jo_type = 'CONTAINER';
                    }else if($aRow['jo_type'] == 3){
                        $jo_type = 'OTHER';
                    }

                    $dropdown_status = "";
                    $dropdown_status .= '<div class="btn-group">';
                    $dropdown_status .= '<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">';
                    if($aRow['status'] == 0){
                        $status = 'Open';
                    }else if($aRow['status'] == 1){
                        $status = 'Admin';
                    }else{
                        $status = 'Close';
                    }
                    $dropdown_status .= $status;
                    $dropdown_status .= '<span class="caret"></span>';
                    $dropdown_status .= '</button>';
                    $dropdown_status .= '<ul class="dropdown-menu">';
                    if($this->get_user_access('Updated') == 1){
                        $dropdown_status .= '<li><a href="javascript:void()" class="active" title="Open" onclick="edit_status_jo_emkl(\'' . $aRow['year'] . '\',\'' . $aRow['month'] . '\',\'' . $aRow['code'] . '\',\'' . '0' . '\')">Open</a></li>';
                        $dropdown_status .= '<li><a href="javascript:void()" title="Admin" onclick="edit_status_jo_emkl(\'' . $aRow['year'] . '\',\'' . $aRow['month'] . '\',\'' . $aRow['code'] . '\',\'' . '1' . '\')">Admin</a></li>';
                        $dropdown_status .= '<li><a href="javascript:void()" title="Close" onclick="edit_status_jo_emkl(\'' . $aRow['year'] . '\',\'' . $aRow['month'] . '\',\'' . $aRow['code'] . '\',\'' . '2' . '\')">Close</a></li>';
                    }
                    $dropdown_status .= '</ul></div>';
              
                    $row['dropdown_option'] = $dropdown_option;
                    $row['jo_no'] = $aRow['jo_no'];
                    $row['jo_date'] = date("d F Y",strtotime($aRow['jo_date']));
                    $row['jo_type'] = $jo_type;
                    $row['debtor'] = $aRow['debtor_cd'] . ' - ' . $aRow['debtor_name'];
                    $row['po_spk_no'] = $aRow['po_spk_no'];
                    $row['so_no'] = $aRow['so_no'];
                    $row['vessel'] = $aRow['vessel_no'] . ' - ' . $aRow['vessel_name'];
                    $row['port'] = $aRow['port_cd'] . ' - ' . $aRow['port_name'];
                    $row['dropdown_status'] = $dropdown_status;

                    $row['start_date'] = $aRow['jo_date'];
                    $row['end_date'] = $aRow['jo_date'];
                    $data[] = $row;
                }
            }

            $output = array(
                "draw" => intval($draw),
                "recordsTotal" => $iTotal,
                "recordsFiltered" => $iFilteredTotal,
                "data" => $data
            );
            echo json_encode($output);
        } else {
            show_404();
        }
    }

    function get_user_access($field){
        $this->db->where('status','1');
        $this->db->where('Link_Menu', 'job_order_emkl');
        $query_menu = $this->db->get('sa_menu');        
        $get_menu = $query_menu->row();
        $menu_id = $get_menu->Seq_Menu;

        if($menu_id > 0){
            $this->db->where('user_rowID',$this->session->userdata('user_id'));
            $this->db->where('StatusUsermenu','1');
            $this->db->where('Kd_Menu',$menu_id);
            $query = $this->db->get('sa_usermenu');
            if ($query->num_rows() > 0){
                $row = $query->row();
                return $row->$field;
            } else{
                return 0;
            }
        } else{
           return 0;
        }
        
    }
	
}

/* End of file contacts.php */