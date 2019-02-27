<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class job_order extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('job_order_model');
		$this->load->model('fare_trip/fare_trip_model');
	}

	function index()
	{
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('job_orders').' - '.$this->config->item('website_name').' - '.$this->config->item('comp_name').' '. $this->config->item('version'));
		$data['page'] = lang('job_orders');
		$this->session->set_userdata('page_header', 'transaction');		
		$this->session->set_userdata('page_detail', 'job_orders');
		$data['form'] = TRUE;
		$data['datatables'] = TRUE;
		
		if($this->session->userdata('start_date_job_order') == '' ){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_job_order')));
        }

        if($this->session->userdata('end_date_job_order') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_job_order')));
        }

        // if($this->session->userdata('start_date') == '' && $this->session->userdata('end_date') == ''){
        //     $start_date = date("Y-01-01");
        //     $end_date = date("Y-m-d");
        // }
        // else{
        //     $start_date = $this->session->userdata('start_date');
        //     $end_date = $this->session->userdata('end_date');
        // }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        
		// $data['job_orders'] = $this->job_order_model->get_all_records_list($start_date,$end_date);
		
		$this->template
		->set_layout('users')
		->build('job_orders',isset($data) ? $data : NULL);
	}
	
    function set_filter(){
       $this->session->set_userdata('start_date_job_order',date("Y-m-d",strtotime($this->input->post('start_date'))));
       $this->session->set_userdata('end_date_job_order',date("Y-m-d",strtotime($this->input->post('end_date'))));    
       
       redirect(base_url().'job_order');
    }

    function update_status_jo($year,$month,$code,$status){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $error = false;
        $this->db->trans_begin();
        
        $get_data = $this->job_order_model->get_job_order_by_jo($year,$month,$code);
        
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
        $result = $this->db->update('tr_jo_trx_hdr', $data_jo);
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
			$params['activity'] = ucfirst('Deleted status '.$status_tmp.' at Job Order No '.$get_data->jo_no);
			$params['icon'] = 'fa-exclamation-triangle';
			modules::run('activitylog/log',$params);
            
            echo json_encode(array('success' => false, 'msg' => "Failed Data RollBack"));
            exit();
        }
        else{
            $this->db->trans_commit();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Job Order';
            $params['module_field_id'] = $code;
            $params['activity'] = ucfirst('Updated status '.$status_tmp.' at Job Order No ' . $get_data->jo_no);
            $params['icon'] = 'fa-times';
            modules::run('activitylog/log', $params); //log activity

            echo json_encode(array("success" => true, 'msg' => lang('updated_succesfully')));
            exit();
        }
    }
    
    function get_data_port_warehouse(){
        $port_warehouse = $this->input->post('port_warehouse');
        
        if($port_warehouse == 'POK'){
            $port = $this->job_order_model->get_all_records('sa_port', $array =
                array('rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '', 'port_name', 'asc');	   
        }
        else{
            $port = $this->job_order_model->get_all_records('sa_port', $array =
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
        
        $vessels = $this->job_order_model->get_data_vessel_by_date($start_date,$end_date);
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
    
	function create_job_order()
	{
		
		if ($this->input->post()) {	
				
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
				$this->form_validation->set_rules('job_order_date', 'Job Order Date', 'required');
				$this->form_validation->set_rules('job_order_type', 'Type', 'required|numeric');
				$this->form_validation->set_rules('debtor', 'Debtor', 'required|numeric');
				$this->form_validation->set_rules('po_spk_no', 'PO/SPK No', 'required');
				$this->form_validation->set_rules('port', 'Port', 'required|numeric');
				$this->form_validation->set_rules('item', 'Item', 'required|numeric');
				$this->form_validation->set_rules('weight_item', 'Weight Item', 'required|numeric');
				$this->form_validation->set_rules('fare_trip', 'Fare Trip', 'required|numeric');
				//$this->form_validation->set_rules('job_order_price', 'Price', 'required|numeric');

				if ($this->form_validation->run() == FALSE)
				{
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('error_in_form'));
					redirect('job_order/create_job_order');
				}else{	

					if($this->input->post('job_order_type')==2){
						$cek_container_filled_20ft=true;
						$cek_container_filled_40ft=true;
						$cek_container_filled_45ft=true;
						if($this->input->post('job_order_total_20ft')!=0){ 
							if(!$this->input->post('job_order_price_20ft')!=0){
								$cek_container_filled_20ft=false;	
							}
						}
						if($this->input->post('job_order_total_40ft')!=0){
							if(!$this->input->post('job_order_price_40ft')!=0){
								$cek_container_filled_40ft=false;
							}
						}
						if($this->input->post('job_order_total_45ft')!=0) {
							if(!$this->input->post('job_order_price_45ft')!=0){
								$cek_container_filled_45ft=false;
							}
						}

					   /*
    					if(!$cek_container_filled_20ft){
    						$this->session->set_flashdata('response_status', 'error');
    						$this->session->set_flashdata('message', lang('error_in_container_filled').'20');
    						redirect('job_order/create_job_order');					
    					}
    					if(!$cek_container_filled_40ft){
    						$this->session->set_flashdata('response_status', 'error');
    						$this->session->set_flashdata('message', lang('error_in_container_filled').'40');
    						redirect('job_order/create_job_order');					
    					}
    					if(!$cek_container_filled_45ft){
    						$this->session->set_flashdata('response_status', 'error');
    						$this->session->set_flashdata('message', lang('error_in_container_filled').'45');
    						redirect('job_order/create_job_order');					
    					}
                        */					
					}
				    
                    if(date('Y-m-d',strtotime($this->input->post('job_order_date'))) != date('Y-m-d')){
                        $trx_date = date('Y-m-d');
                    }
                    else{
                        $trx_date = date('Y-m-d',strtotime($this->input->post('job_order_date')));
                    }
                    
                    $year = date('Y',strtotime($trx_date));
                    $month = date('m',strtotime($trx_date));
                    
					$new_job_order_code= ((int)$this->AppModel->select_max_id('tr_jo_trx_hdr',$array = array('year' =>$year,'month' =>$month),'code'))+1;					

					$job_order_no='JO'.sprintf("%04s",$year).sprintf("%02s",$month).sprintf("%04s",$new_job_order_code);
				
					$job_order_data = array(
							'year' =>$year,
							'month'=>$month,
							'code' => $new_job_order_code,
							'jo_no'=>$job_order_no,
							'jo_date'=>$trx_date,
							'jo_type'=>$this->input->post('job_order_type'),
							'debtor_rowID'=>$this->input->post('debtor'),
							'po_spk_no'=>strtoupper(trim($this->input->post('po_spk_no'))),
							'so_no'=>strtoupper(trim($this->input->post('so_no'))),
                            'port_jo_type'=>$this->input->post('port_jo_type'),
                            'port_rowID'=>$this->input->post('port'),
							'vessel_rowID'=>$this->input->post('vessel_rowID'),
							'vessel_no'=>strtoupper(trim($this->input->post('vessel_no'))),
							'vessel_name'=>strtoupper(trim($this->input->post('vessel_name'))),
							'item_rowID'=>$this->input->post('item'),
							'weight'=>$this->input->post('weight_item'),
							'fare_trip_rowID'=>$this->input->post('fare_trip'),
							'destination_from_rowID'=>$this->input->post('destination_from_id'),
							'destination_to_rowID'=>$this->input->post('destination_to_id'),
							'wholesale'=>($this->input->post('job_order_wholesale_yes_no') == 'on') ? 1 : 0,
							'regular_type'=>($this->input->post('regular_type') == 'on') ? 1 : 0,
							'price_amount'=>str_replace(',','.',$this->input->post('job_order_price')),
							'description'=>$this->input->post('job_order_desc'),
							'container_20ft'=>$this->input->post('job_order_total_20ft'),
							'container_40ft'=>$this->input->post('job_order_total_40ft'),
							'container_45ft'=>$this->input->post('job_order_total_45ft'),
							'price_20ft'=>$this->input->post('job_order_price_20ft'),
							'price_40ft'=>$this->input->post('job_order_price_40ft'),
							'price_45ft'=>$this->input->post('job_order_price_45ft'),
							'user_created'=>$this->session->userdata('user_rowID'),
							'date_created'=>date('Y-m-d'),
							'time_created'=>date('H:i:s')							
			         );
					 
					$this->db->insert('tr_jo_trx_hdr', $job_order_data); 
					//$job_order_code = $this->db->insert_id();

					$params['user_rowID'] = $this->tank_auth->get_user_id();
					$params['module'] = 'Job Order';
					$params['module_field_id'] = $new_job_order_code;
					$params['activity'] = ucfirst('Added a new Job Order No '.$job_order_no);
					$params['icon'] = 'fa-plus';
					modules::run('activitylog/log',$params); //log activity

					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', lang('job_order').' '.lang('created_succesfully'));
					redirect('job_order');
				}
		}else{
			$this->load->module('layouts');
			$this->load->library('template');
            $data['page'] = lang('job_orders');
            $data['datatables'] = true;
            $data['form'] = true;

			$data['jo_type'] = $this->job_order_model->get_all_records($table = 'sa_reference', $array = array(
			'type_ref' => 'jo_type'), $join_table = '', $join_criteria = '','type_no','ASC');			
			
			$data['debtors'] = $this->job_order_model->get_all_records($table = 'sa_debtor', $array = array(
			'type' => 'C','rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','debtor_name','ASC');
			
			$data['ports'] = $this->job_order_model->get_all_records($table = 'sa_port', $array = array(
			'rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','port_name','ASC');	
			
			$data['fare_trips'] = $this->fare_trip_model->get_all_record_data_active();

			$data['items'] = $this->job_order_model->get_all_records($table = 'sa_item', $array = array(
			'rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','item_name','ASC');
			
			$this->template
			->set_layout('users')
			->build('create_job_order',isset($data) ? $data : NULL);
		}
	}
	
	function copy_job_order()
	{
		
		if ($this->input->post()) {	
				$yers=$this->uri->segment(3);
				$month=$this->uri->segment(4);
				$code=$this->uri->segment(5);
				
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
				$this->form_validation->set_rules('job_order_date', 'Job Order Date', 'required');
				$this->form_validation->set_rules('job_order_type', 'Type', 'required|numeric');
				$this->form_validation->set_rules('debtor', 'Debtor', 'required|numeric');
				$this->form_validation->set_rules('po_spk_no', 'PO/SPK No', 'required');
				$this->form_validation->set_rules('port', 'Port', 'required|numeric');
				$this->form_validation->set_rules('item', 'Item', 'required|numeric');
				$this->form_validation->set_rules('weight_item', 'Weight Item', 'required|numeric');
				$this->form_validation->set_rules('fare_trip', 'Fare Trip', 'required|numeric');
				//$this->form_validation->set_rules('job_order_price', 'Price', 'required|numeric');

				if ($this->form_validation->run() == FALSE)
				{
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('error_in_form'));
					redirect('job_order/copy_job_order/'.$year.'/'.$month.'/'.$code);
				}else{	

					if($this->input->post('job_order_type')==2){
						$cek_container_filled_20ft=true;
						$cek_container_filled_40ft=true;
						$cek_container_filled_45ft=true;
						if($this->input->post('job_order_total_20ft')!=0){ 
							if(!$this->input->post('job_order_price_20ft')!=0){
								$cek_container_filled_20ft=false;	
							}
						}
						if($this->input->post('job_order_total_40ft')!=0){
							if(!$this->input->post('job_order_price_40ft')!=0){
								$cek_container_filled_40ft=false;
							}
						}
						if($this->input->post('job_order_total_45ft')!=0) {
							if(!$this->input->post('job_order_price_45ft')!=0){
								$cek_container_filled_45ft=false;
							}
						}

					   /*
    					if(!$cek_container_filled_20ft){
    						$this->session->set_flashdata('response_status', 'error');
    						$this->session->set_flashdata('message', lang('error_in_container_filled').'20');
    						redirect('job_order/copy_job_order/'.$year.'/'.$month.'/'.$code);				
    					}
    					if(!$cek_container_filled_40ft){
    						$this->session->set_flashdata('response_status', 'error');
    						$this->session->set_flashdata('message', lang('error_in_container_filled').'40');
    						redirect('job_order/copy_job_order/'.$year.'/'.$month.'/'.$code);					
    					}
    					if(!$cek_container_filled_45ft){
    						$this->session->set_flashdata('response_status', 'error');
    						$this->session->set_flashdata('message', lang('error_in_container_filled').'45');
    						redirect('job_order/copy_job_order/'.$year.'/'.$month.'/'.$code);				
    					}					
				        */
					}
                    
                    if(date('Y-m-d',strtotime($this->input->post('job_order_date'))) != date('Y-m-d')){
                        $trx_date = date('Y-m-d');
                    }
                    else{
                        $trx_date = date('Y-m-d',strtotime($this->input->post('job_order_date')));
                    }
                    
                    $year = date('Y',strtotime($trx_date));
                    $month = date('m',strtotime($trx_date));
                    
					$new_job_order_code= ((int)$this->AppModel->select_max_id('tr_jo_trx_hdr',$array = array('year' =>$year,'month' =>$month),'code'))+1;					

					$job_order_no='JO'.sprintf("%04s",$year).sprintf("%02s",$month).sprintf("%04s",$new_job_order_code);
				
					$job_order_data = array(
							'year' =>$year,
							'month'=>$month,
							'code' => $new_job_order_code,
							'jo_no'=>$job_order_no,
							'jo_date'=>$trx_date,
							'jo_type'=>$this->input->post('job_order_type'),
							'debtor_rowID'=>$this->input->post('debtor'),
							'po_spk_no'=>strtoupper(trim($this->input->post('po_spk_no'))),
							'so_no'=>strtoupper(trim($this->input->post('so_no'))),
							'port_jo_type'=>$this->input->post('port_jo_type'),
                            'port_rowID'=>$this->input->post('port'),
							'vessel_rowID'=>$this->input->post('vessel_rowID'),
							'vessel_no'=>strtoupper(trim($this->input->post('vessel_no'))),
							'vessel_name'=>strtoupper(trim($this->input->post('vessel_name'))),
							'item_rowID'=>$this->input->post('item'),
							'weight'=>$this->input->post('weight_item'),
							'fare_trip_rowID'=>$this->input->post('fare_trip'),
							'destination_from_rowID'=>$this->input->post('destination_from_id'),
							'destination_to_rowID'=>$this->input->post('destination_to_id'),
							'wholesale'=>($this->input->post('job_order_wholesale_yes_no') == 'on') ? 1 : 0,
							'regular_type'=>($this->input->post('regular_type') == 'on') ? 1 : 0,
							'price_amount'=>str_replace(',','.',$this->input->post('job_order_price')),
							'description'=>$this->input->post('job_order_desc'),
							'container_20ft'=>$this->input->post('job_order_total_20ft'),
							'container_40ft'=>$this->input->post('job_order_total_40ft'),
							'container_45ft'=>$this->input->post('job_order_total_45ft'),
							'price_20ft'=>$this->input->post('job_order_price_20ft'),
							'price_40ft'=>$this->input->post('job_order_price_40ft'),
							'price_45ft'=>$this->input->post('job_order_price_45ft'),
							'user_created'=>$this->session->userdata('user_rowID'),
							'date_created'=>date('Y-m-d'),
							'time_created'=>date('H:i:s')							
			         );
					 
					$this->db->insert('tr_jo_trx_hdr', $job_order_data); 
					//$job_order_code = $this->db->insert_id();

					$params['user_rowID'] = $this->tank_auth->get_user_id();
					$params['module'] = 'Job Order';
					$params['module_field_id'] = $new_job_order_code;
					$params['activity'] = ucfirst('Added a new Job Order No '.$job_order_no);
					$params['icon'] = 'fa-plus';
					modules::run('activitylog/log',$params); //log activity

					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', lang('job_order').' '.lang('created_succesfully'));
					redirect('job_order');
				}
		}else{
			$this->load->module('layouts');
			$this->load->library('template');
            $data['page'] = lang('job_orders');
            $data['datatables'] = true;
            $data['form'] = true;
			
			$data['job_orders'] = $this->job_order_model->get_records_details($this->uri->segment(3),$this->uri->segment(4),$this->uri->segment(5));

			$data['jo_type'] = $this->job_order_model->get_all_records($table = 'sa_reference', $array = array(
			'type_ref' => 'jo_type'), $join_table = '', $join_criteria = '','type_no','ASC');			
			
			$data['debtors'] = $this->job_order_model->get_all_records($table = 'sa_debtor', $array = array(
			'type' => 'C','rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','debtor_name','ASC');
			
			$data['fare_trips'] = $this->fare_trip_model->get_all_record_data_active();

			$data['items'] = $this->job_order_model->get_all_records($table = 'sa_item', $array = array(
			'rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','item_name','ASC');
			
			$this->template
			->set_layout('users')
			->build('copy_job_order',isset($data) ? $data : NULL);
		}
	}	

	function update_job_order()
	{
		
		if ($this->input->post()) {	
		
				$year=$this->input->post('job_order_year');
				$month=$this->input->post('job_order_month');
				$code=$this->input->post('job_order_code');
				$job_order_no=$this->input->post('job_order_no');
				
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
				//$this->form_validation->set_rules('job_order_type', 'Type', 'required|numeric');
				$this->form_validation->set_rules('debtor', 'Debtor', 'required|numeric');
				$this->form_validation->set_rules('po_spk_no', 'PO/SPK No', 'required');
				$this->form_validation->set_rules('port', 'Port', 'required|numeric');
				$this->form_validation->set_rules('item', 'Item', 'required|numeric');
				$this->form_validation->set_rules('weight_item', 'Weight Item', 'required|numeric');
				$this->form_validation->set_rules('fare_trip', 'Fare Trip', 'required|numeric');
				//$this->form_validation->set_rules('job_order_price', 'Price', 'required|numeric');

				if ($this->form_validation->run() == FALSE)
				{
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('error_in_form'));
					redirect('job_order/update_job_order/'.$year.'/'.$month.'/'.$code);	
				}else{	
                    /*
					if($this->input->post('job_order_type')==2){
						$cek_container_filled_20ft=true;
						$cek_container_filled_40ft=true;
						$cek_container_filled_45ft=true;
						if($this->input->post('job_order_total_20ft')!=0){ 
							if(!$this->input->post('job_order_price_20ft')!=0){
								$cek_container_filled_20ft=false;	
							}
						}
						if($this->input->post('job_order_total_40ft')!=0){
							if(!$this->input->post('job_order_price_40ft')!=0){
								$cek_container_filled_40ft=false;
							}
						}
						if($this->input->post('job_order_total_45ft')!=0) {
							if(!$this->input->post('job_order_price_45ft')!=0){
								$cek_container_filled_45ft=false;
							}
						}

    					if(!$cek_container_filled_20ft){
    						$this->session->set_flashdata('response_status', 'error');
    						$this->session->set_flashdata('message', lang('error_in_container_filled').'20');
    						redirect('job_order/update_job_order/'.$year.'/'.$month.'/'.$code);					
    					}
    					if(!$cek_container_filled_40ft){
    						$this->session->set_flashdata('response_status', 'error');
    						$this->session->set_flashdata('message', lang('error_in_container_filled').'40');
    						redirect('job_order/update_job_order/'.$year.'/'.$month.'/'.$code);					
    					}
    					if(!$cek_container_filled_45ft){
    						$this->session->set_flashdata('response_status', 'error');
    						$this->session->set_flashdata('message', lang('error_in_container_filled').'45');
    						redirect('job_order/update_job_order/'.$year.'/'.$month.'/'.$code);				
    					}					
                        
					}
                    */
                    
                    if($this->input->post('already_do') == 0){
                        $job_order_data = array(
							'jo_type'=>$this->input->post('job_order_type'),
							'debtor_rowID'=>$this->input->post('debtor'),
							'po_spk_no'=>strtoupper(trim($this->input->post('po_spk_no'))),
							'so_no'=>strtoupper(trim($this->input->post('so_no'))),
							'port_jo_type'=>$this->input->post('port_jo_type'),
                            'port_rowID'=>$this->input->post('port'),
							'vessel_rowID'=>$this->input->post('vessel_rowID'),
							'vessel_no'=>strtoupper(trim($this->input->post('vessel_no'))),
							'vessel_name'=>strtoupper(trim($this->input->post('vessel_name'))),
							'item_rowID'=>$this->input->post('item'),
							'weight'=>$this->input->post('weight_item'),
							'fare_trip_rowID'=>$this->input->post('fare_trip'),
							'destination_from_rowID'=>$this->input->post('destination_from_id'),
							'destination_to_rowID'=>$this->input->post('destination_to_id'),
							'wholesale'=>($this->input->post('job_order_wholesale_yes_no') == 'on') ? 1 : 0,
							'regular_type'=>($this->input->post('regular_type') == 'on') ? 1 : 0,
							'price_amount'=>str_replace(',','.',$this->input->post('job_order_price')),
							'description'=>$this->input->post('job_order_desc'),
							'container_20ft'=>$this->input->post('job_order_total_20ft'),
							'container_40ft'=>$this->input->post('job_order_total_40ft'),
							'container_45ft'=>$this->input->post('job_order_total_45ft'),
							'price_20ft'=>$this->input->post('job_order_price_20ft'),
							'price_40ft'=>$this->input->post('job_order_price_40ft'),
							'price_45ft'=>$this->input->post('job_order_price_45ft'),
							'user_modified'=>$this->session->userdata('user_rowID'),
							'date_modified'=>date('Y-m-d'),
							'time_modified'=>date('H:i:s')							
                        );
                    }
                    else{
                        $job_order_data = array(
							//'jo_type'=>$this->input->post('job_order_type'),
							'debtor_rowID'=>$this->input->post('debtor'),
							'po_spk_no'=>strtoupper(trim($this->input->post('po_spk_no'))),
							'so_no'=>strtoupper(trim($this->input->post('so_no'))),
							'port_jo_type'=>$this->input->post('port_jo_type'),
                            'port_rowID'=>$this->input->post('port'),
							'vessel_rowID'=>$this->input->post('vessel_rowID'),
							'vessel_no'=>strtoupper(trim($this->input->post('vessel_no'))),
							'vessel_name'=>strtoupper(trim($this->input->post('vessel_name'))),
							'item_rowID'=>$this->input->post('item'),
							'weight'=>$this->input->post('weight_item'),
							//'fare_trip_rowID'=>$this->input->post('fare_trip'),
							//'destination_from_rowID'=>$this->input->post('destination_from_id'),
							//'destination_to_rowID'=>$this->input->post('destination_to_id'),
							'wholesale'=>($this->input->post('job_order_wholesale_yes_no') == 'on') ? 1 : 0,
							'regular_type'=>($this->input->post('regular_type') == 'on') ? 1 : 0,
							'price_amount'=>str_replace(',','.',$this->input->post('job_order_price')),
							'description'=>$this->input->post('job_order_desc'),
							'container_20ft'=>$this->input->post('job_order_total_20ft'),
							'container_40ft'=>$this->input->post('job_order_total_40ft'),
							'container_45ft'=>$this->input->post('job_order_total_45ft'),
							'price_20ft'=>$this->input->post('job_order_price_20ft'),
							'price_40ft'=>$this->input->post('job_order_price_40ft'),
							'price_45ft'=>$this->input->post('job_order_price_45ft'),
							'user_modified'=>$this->session->userdata('user_rowID'),
							'date_modified'=>date('Y-m-d'),
							'time_modified'=>date('H:i:s')							
                        );                        
                    }
					 
					//$this->db->where(array('year' => $this->input->post('vessel_id'), 'vessel_status' => 1))->update('trx_sj', $form_data);	 
					$this->db->where('year',$year);
					$this->db->where('month',$month);
					$this->db->where('code',$code);
					$this->db->update('tr_jo_trx_hdr', $job_order_data);					 


					$params['user_rowID'] = $this->tank_auth->get_user_id();
					$params['module'] = 'Job Order';
					$params['module_field_id'] = $code;
					$params['activity'] = ucfirst('Updated a Job Order No : '.$job_order_no);
					$params['icon'] = 'fa-edit';
					modules::run('activitylog/log',$params); //log activity

					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', lang('job_order').' '.lang('updated_succesfully'));
					redirect('job_order');	
                    //redirect('job_order/update_job_order/'.$year.'/'.$month.'/'.$code);	
				}
		}else{
			$this->load->module('layouts');
			$this->load->library('template');
            $data['page'] = lang('job_orders');
            $data['datatables'] = true;
            $data['form'] = true;
			
			$data['job_orders'] = $this->job_order_model->get_records_details($this->uri->segment(3),$this->uri->segment(4),$this->uri->segment(5));

			$data['jo_type'] = $this->job_order_model->get_all_records($table = 'sa_reference', $array = array(
			'type_ref' => 'jo_type'), $join_table = '', $join_criteria = '','type_no','ASC');			
			
			$data['debtors'] = $this->job_order_model->get_all_records($table = 'sa_debtor', $array = array(
			'type' => 'C','rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','debtor_name','ASC');
			
			$data['fare_trips'] = $this->fare_trip_model->get_all_record_data_active();

			$data['items'] = $this->job_order_model->get_all_records($table = 'sa_item', $array = array(
			'rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','item_name','ASC');
			
			$this->template
			->set_layout('users')
			->build('update_job_order',isset($data) ? $data : NULL);
		}
	}
	
	public function get_fair_trip() {
		$term = $this->input->get('term');
		// variable lain bisa dipake dari view yang diset
		// $datalain = $this->input->get('datalain');

		// load data ke model
		$data_sparepart = $this->job_order_model->get_fare_trip_by($term);

		// keluarkan dalam bentuk json
		echo json_encode($data_sparepart);   
	}

		
	function get_wo_debtor(){
        $debtor_rowID=$this->input->post('debtor_rowID');
        $data=array(
            'wo_lists'=> $this->job_order_model->get_all_record_debtor_wo($debtor_rowID)
        );

		$this->load->view('ajax_wo_type',$data);
    }
	
	function get_wo(){
        $wo_no=$this->input->post('wo_no');
        $data=array(
            'wo_lists'=> $this->job_order_model->get_all_record_wo($wo_no)
        ); 	
		$this->load->view('ajax_jo_type',$data);
    }

	

	
	function delete_job_order()
	{
		if ($this->input->post()) {
			$year = $this->input->post('year');
			$month = $this->input->post('month');
			$code = $this->input->post('code');			
			$jo_no = $this->input->post('jo_no');	
			
			$job_order_data = array(
							'deleted'=>1,
							'user_deleted'=>$this->session->userdata('user_rowID'),
							'date_deleted'=>date('Y-m-d'),
							'time_deleted'=>date('H:i:s')							
			            );
			$this->db->where('year',$year);
			$this->db->where('month',$month);
			$this->db->where('code',$code);
			$this->db->update('tr_jo_trx_hdr',$job_order_data);
			

			
			$params['user_rowID'] = $this->tank_auth->get_user_id();
			$params['module'] = 'Job Order';
			$params['module_field_id'] = $code;
			$params['activity'] = ucfirst('Deleted a Job Order No : '.$jo_no);
			$params['icon'] = 'fa-trash-o';
			modules::run('activitylog/log',$params); //log activity	
			
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('job_order').' '.lang('deleted_successfully'));
			redirect('job_order');
		}else{
			
			$data['job_orders'] = $this->job_order_model->get_records_details($this->uri->segment(3),$this->uri->segment(4),$this->uri->segment(5));
			$this->load->view('modal/delete_job_order',$data);

		}
	}
	
	 function fetch_data() { 
        if ($this->input->is_ajax_request()) {
            $dt = $_POST;

            if($this->session->userdata('start_date_job_order') == '' ){
                $start_date = date("Y-m-d", strtotime('-6 day'));
            }else{
                $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_job_order')));
            }

            if($this->session->userdata('end_date_job_order') == ''){
                $end_date = date("Y-m-d");
            }else{
                $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_job_order')));
            }
            $str_between = " AND tr_jo_trx_hdr.jo_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";
        
            $dt['table'] = 'tr_jo_trx_hdr';
            $dt['id'] = 'year';

            $aColumnTable = array(
                'tr_jo_trx_hdr.year', 'tr_jo_trx_hdr.jo_no', 'tr_jo_trx_hdr.jo_date', 'sa_debtor.debtor_cd', 'tr_jo_trx_hdr.po_spk_no', 'tr_jo_trx_hdr.so_no', 'tr_jo_trx_hdr.vessel_no', 'sa_port.port_cd', 'sa_fare_trip_hdr.fare_trip_cd', 'sa_fare_trip_hdr.fare_trip_cd', 'sa_item.item_name', 'tr_jo_trx_hdr.status', 'sa_debtor.debtor_name', 'tr_jo_trx_hdr.vessel_name', 'sa_port.port_name', 'tr_jo_trx_hdr.invoice_no', 'tr_jo_trx_hdr.code', 'tr_jo_trx_hdr.month', 'tr_jo_trx_hdr.price_amount'
            );

            $aColumns = array(
                'tr_jo_trx_hdr.year', 'tr_jo_trx_hdr.jo_no', 'tr_jo_trx_hdr.jo_date', 'sa_debtor.debtor_cd', 'tr_jo_trx_hdr.po_spk_no', 'tr_jo_trx_hdr.so_no', 'tr_jo_trx_hdr.vessel_no', 'sa_port.port_cd', 'sa_fare_trip_hdr.fare_trip_cd', 'sa_fare_trip_hdr.fare_trip_cd', 'sa_item.item_name', 'tr_jo_trx_hdr.status', 'sa_debtor.debtor_name', 'tr_jo_trx_hdr.vessel_name', 'sa_port.port_name', 'tr_jo_trx_hdr.invoice_no', 'tr_jo_trx_hdr.code', 'tr_jo_trx_hdr.month', 'tr_jo_trx_hdr.price_amount'
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
                $sOrder .= "tr_jo_trx_hdr.jo_no DESC";
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

            if (!empty($dt['columns'][12]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $start_date = date('Y-m-d', strtotime($dt['columns'][12]['search']['value']));
                $this->session->set_userdata('start_date_job_order',date("Y-m-d",strtotime($start_date)));

                if($this->session->userdata('end_date_job_order') == ''){
                    $end_date = date("Y-m-d");
                }else{
                    $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_job_order')));
                }
                $str_between = " AND tr_jo_trx_hdr.jo_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";

                $sWhere.= ' tr_jo_trx_hdr.deleted = 0 ' . $str_between; 
            }

            if (!empty($dt['columns'][13]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $end_date = date('Y-m-d', strtotime($dt['columns'][13]['search']['value']));
                $this->session->set_userdata('end_date_job_order', date("Y-m-d",strtotime($end_date)));

                if($this->session->userdata('start_date_job_order') == ''){
                    $start_date = date("Y-m-d", strtotime('-6 day'));
                }else{
                    $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_job_order')));
                }
                $str_between = " AND tr_jo_trx_hdr.jo_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";
                
                $sWhere.= ' tr_jo_trx_hdr.deleted = 0 ' . $str_between; 
            }

            /** Filtering * */
            $sWhere = "";
            $sSearchVal = $dt['search']['value'];
            if (isset($sSearchVal) && $sSearchVal != '') {
                $sWhere = " WHERE (";
                for ($i = 0; $i < count($aColumns); $i++) {
                    $sWhere .= $aColumns[$i] . " LIKE '%" . $this->db->escape_like_str($sSearchVal) . "%' OR ";

                }

                $sWhere = substr_replace($sWhere, "", -3);
                $sWhere .= ') AND tr_jo_trx_hdr.deleted = 0 ' . $str_between;
            } 

            /** Total Data Set Length * */
            $sQuery = 'SELECT * FROM ' . $dt['table'] . ' LEFT JOIN sa_reference ON sa_reference.type_no = tr_jo_trx_hdr.jo_type AND sa_reference.type_ref="jo_type" LEFT JOIN sa_debtor ON sa_debtor.rowID = tr_jo_trx_hdr.debtor_rowID LEFT JOIN sa_port ON sa_port.rowID = tr_jo_trx_hdr.port_rowID LEFT JOIN sa_fare_trip_hdr ON sa_fare_trip_hdr.rowID = tr_jo_trx_hdr.fare_trip_rowID LEFT JOIN sa_destination as destination_from ON destination_from.rowID = sa_fare_trip_hdr.destination_from_rowID LEFT JOIN sa_destination as destination_to ON destination_to.rowID = sa_fare_trip_hdr.destination_to_rowID LEFT JOIN sa_item ON sa_item.rowID = tr_jo_trx_hdr.item_rowID WHERE tr_jo_trx_hdr.deleted = 0 ' . $str_between;
            $rResultTotal = $this->db->query($sQuery);
            $aResultTotal = $rResultTotal->num_rows();
            $iTotal = $aResultTotal;
            
            /* Get Data To Display */
            if ($sWhere != "") {
                $where = $sWhere;
            } else {
                $where = " WHERE tr_jo_trx_hdr.deleted = 0 " . $str_between;
            }

            $join_table = '  LEFT JOIN sa_reference ON sa_reference.type_no = tr_jo_trx_hdr.jo_type AND sa_reference.type_ref="jo_type" LEFT JOIN sa_debtor ON sa_debtor.rowID = tr_jo_trx_hdr.debtor_rowID LEFT JOIN sa_port ON sa_port.rowID = tr_jo_trx_hdr.port_rowID LEFT JOIN sa_fare_trip_hdr ON sa_fare_trip_hdr.rowID = tr_jo_trx_hdr.fare_trip_rowID LEFT JOIN sa_destination as destination_from ON destination_from.rowID = sa_fare_trip_hdr.destination_from_rowID LEFT JOIN sa_destination as destination_to ON destination_to.rowID = sa_fare_trip_hdr.destination_to_rowID LEFT JOIN sa_item ON sa_item.rowID = tr_jo_trx_hdr.item_rowID ';

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
						$dropdown_option .= '<li><a href="' . base_url() . 'job_order/copy_job_order/' . $aRow['year'] . '/' . $aRow['month'] . '/' . $aRow['code'] . '"><i class="fa fa-copy"></i>  ' . lang('copy_option') . '</a></li>';
                    }

                    if($aRow['invoice_no'] == ''){
                        if($this->get_user_access('Updated') == 1){
                            $dropdown_option .= '<li><a href="' . base_url() . 'job_order/update_job_order/' . $aRow['year'] . '/' . $aRow['month'] . '/' . $aRow['code'] . '"><i class="fa fa-pencil"></i>  ' . lang('update_option') . '</a></li>';
                        }
                        
                        if($this->get_user_access('Deleted') == 1){
							$dropdown_option .= '<li><a href="' . base_url() . 'job_order/delete_job_order/' . $aRow['year'] . '/' . $aRow['month'] . '/' . $aRow['code'] . '" data-toggle="ajaxModal"><i class="fa fa-trash-o"></i>  ' . lang('delete_option'). '</a></li>';
                        }
                    }
					$dropdown_option .= '</ul></div>';

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
                        $dropdown_status .= '<li><a href="javascript:void()" class="active" title="Open" onclick="edit_status_jo(\'' . $aRow['year'] . '\',\'' . $aRow['month'] . '\',\'' . $aRow['code'] . '\',\'' . '0' . '\')">Open</a></li>';
                        $dropdown_status .= '<li><a href="javascript:void()" title="Admin" onclick="edit_status_jo(\'' . $aRow['year'] . '\',\'' . $aRow['month'] . '\',\'' . $aRow['code'] . '\',\'' . '1' . '\')">Admin</a></li>';
                        $dropdown_status .= '<li><a href="javascript:void()" title="Close" onclick="edit_status_jo(\'' . $aRow['year'] . '\',\'' . $aRow['month'] . '\',\'' . $aRow['code'] . '\',\'' . '2' . '\')">Close</a></li>';
                    }
                    $dropdown_status .= '</ul></div>';
              
                    $row['dropdown_option'] = $dropdown_option;
                    $row['jo_no'] = $aRow['jo_no'];
                    $row['jo_date'] = date("d F Y",strtotime($aRow['jo_date']));
                    $row['debtor'] = $aRow['debtor_cd'] . ' - ' . $aRow['debtor_name'];
                    $row['po_spk_no'] = $aRow['po_spk_no'];
                    $row['so_no'] = $aRow['so_no'];
                    $row['vessel'] = $aRow['vessel_no'] . ' - ' . $aRow['vessel_name'];
                    $row['port'] = $aRow['port_cd'] . ' - ' . $aRow['port_name'];
                    $row['fare_trip_cd'] = $aRow['fare_trip_cd'];
                    $row['item_name'] = $aRow['item_name'];
                    $row['price_amount'] = number_format($aRow['price_amount'],0);
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
        $this->db->where('Link_Menu', 'job_order');
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