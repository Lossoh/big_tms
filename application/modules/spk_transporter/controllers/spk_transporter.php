<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Spk_transporter extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('spk_transporter_model');
		$this->load->model('fare_trip/fare_trip_model');
	}

	function index()
	{
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('spk_transporter').' - '.$this->config->item('website_name').' - '.$this->config->item('comp_name').' '. $this->config->item('version'));
		$data['page'] = lang('spk_transporter');
		$this->session->set_userdata('page_header', 'transaction');		
		$this->session->set_userdata('page_detail', 'spk_transporter');
		$data['form'] = TRUE;
		$data['datatables'] = TRUE;


        if($this->session->userdata('start_date_spk_transporter') == '' ){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_spk_transporter')));
        }

        if($this->session->userdata('end_date_spk_transporter') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_spk_transporter')));
        }

		
        // if($this->session->userdata('start_date') == '' && $this->session->userdata('end_date') == ''){
        //     $start_date = date("Y-m-01");
        //     $end_date = date("Y-m-t");
        // }
        // else{
        //     $start_date = $this->session->userdata('start_date');
        //     $end_date = $this->session->userdata('end_date');
        // }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        
		// $data['spk_transporters'] = $this->spk_transporter_model->get_all_records_list($start_date,$end_date);
		
		$this->template
		->set_layout('users')
		->build('spk_transporters',isset($data) ? $data : NULL);
	}
	
    function set_filter(){
       $this->session->set_userdata('start_date',date("Y-m-d",strtotime($this->input->post('start_date'))));
       $this->session->set_userdata('end_date',date("Y-m-d",strtotime($this->input->post('end_date'))));    
       
       redirect(base_url().'spk_transporter');
    }

    function get_data_jo_emkl(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $jo_type = $this->input->post('jo_type');
        if($this->input->post('start_date') == '' && $this->input->post('end_date') == ''){
            $start_date = date("Y-m-d");
            $end_date = date("Y-m-d");
        }
        else{
            $start_date = date("Y-m-d",strtotime($this->input->post('start_date')));
            $end_date = date("Y-m-d",strtotime($this->input->post('end_date')));
        }
        
        $data = array();
        $jo_orders = $this->spk_transporter_model->get_data_jo_emkl_by_jo_type($jo_type,$start_date,$end_date);
        if (count($jo_orders) > 0)
        {
            foreach ($jo_orders as $jo_order) { 
                $check = $this->spk_transporter_model->check_data_header_by_jo_no($jo_order->jo_no);
                if(count($check) == 0){
                    $data[] = array(
                        'jo_no' => $jo_order->jo_no,
                        'jo_date' => date("d F Y",strtotime($jo_order->jo_date)),
                        'jo_type' => $jo_order->type_name,
                        'po_spk_no' => $jo_order->po_spk_no,
                        'so_no' => $jo_order->so_no,
                        'debtor_name' => $jo_order->debtor_code.' - '.$jo_order->debtor_name,
                        'vessel_name' => $jo_order->vessel_no.' - '.$jo_order->vessel_name,
                        'port_name' => $jo_order->port_code.' - '.$jo_order->port_name
                    );
                }
            }
            
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode($data);
        }
        else{
            echo json_encode(array());            
        }
        
        exit;
    }
    
    function get_data_detail_jo_emkl(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $jo_no = $this->input->post('jo_no');
        
        $get_data_detail_jo = $this->spk_transporter_model->get_data_jo_detail_by_jo_no($jo_no);
        if (count($get_data_detail_jo) > 0)
        {
            foreach ($get_data_detail_jo as $row) { 
                
                $data[] = array(
                    'rowID' => $row->rowID,
                    'item_name' => $row->item_name,
                    'destination' => $row->destination,
                    'weight' => number_format($row->weight,0,',','.'),
                    'container_type' => $row->container_type.' Feet'
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
    
    function get_data_detail_spk(){        
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $spk_no = $this->input->post('spk_no');
        $jo_emkl_detail_rowID = $this->input->post('jo_emkl_detail_rowID');
        
        $get_data = $this->spk_transporter_model->get_data_spk_detail_by_spk_no_jo_detail_id($spk_no,$jo_emkl_detail_rowID);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($get_data);
        exit;
    }

	function create_spk_transporter()
	{
		
		if ($this->input->post()) {	
				$error = false;
                $result = true;
                $this->db->trans_begin();
                $dataPost = $this->input->post();
                 
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
				$this->form_validation->set_rules('spk_date', 'SPK Date', 'required');
				$this->form_validation->set_rules('creditor_rowID', 'Creditor Name', 'required');
				$this->form_validation->set_rules('jo_type', 'JO Type', 'required|numeric');
				$this->form_validation->set_rules('jo_no', 'JO No', 'required');
				
				if ($this->form_validation->run() == FALSE)
				{
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('error_in_form'));
					redirect('spk_transporter/create_spk_transporter');
				}else{	
                    if ($result){
                        if(date('Y-m-d',strtotime($this->input->post('spk_date'))) != date('Y-m-d')){
                            $spk_date = date('Y-m-d');
                        }
                        else{
                            $spk_date = date('Y-m-d',strtotime($this->input->post('spk_date')));
                        }
                        
                        $year = date('Y',strtotime($spk_date));
                        $month = date('m',strtotime($spk_date));
                        
                        $sa_spec = $this->db->get_where('sa_spec', array('deleted' => 0,'rowID' => 1))->row();
                        $sa_spec_prefix = $sa_spec->spk_transporter;
            
    					$new_spk_transporter_code = ((int)$this->AppModel->select_max_id('tr_spk_transporter_hdr',$array = array('year' =>$year,'month' =>$month,'deleted'=>0),'code'))+1;
    
    					$spk_transporter_no = $sa_spec_prefix.sprintf("%04s",$year).sprintf("%02s",$month).sprintf("%05s",$new_spk_transporter_code);
           
    					$spk_transporter_data = array(
    							'year' =>$year,
    							'month'=>$month,
    							'code' => $new_spk_transporter_code,
    							'spk_no'=>$spk_transporter_no,
    							'spk_date'=>$spk_date,
    							'jo_type'=>$this->input->post('jo_type'),
    							'creditor_rowID'=>$this->input->post('creditor_rowID'),
    							'jo_no'=>$this->input->post('jo_no'),
                                'user_created'=>$this->session->userdata('user_rowID'),
    							'date_created'=>date('Y-m-d'),
    							'time_created'=>date('H:i:s')							
                        );
    					  
    					$result = $this->db->insert('tr_spk_transporter_hdr', $spk_transporter_data);
                        if (!$result){
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
        				$params['module_field_id'] = $new_spk_transporter_code;
        				$params['activity'] = ucfirst('Deleted a SPK Transporter No '.$spk_transporter_no);
        				$params['icon'] = 'fa-exclamation-triangle';
        				modules::run('activitylog/log',$params);
                        
                        $this->session->set_flashdata('response_status', 'error');
    					$this->session->set_flashdata('message', "Failed Data RollBack");
                        
                    }
                    else{
                        $this->db->trans_commit();
                                           
    					$params['user_rowID'] = $this->tank_auth->get_user_id();
    					$params['module'] = 'SPK Transporter';
    					$params['module_field_id'] = $new_spk_transporter_code;
    					$params['activity'] = ucfirst('Added a new SPK Transporter No '.$spk_transporter_no);
    					$params['icon'] = 'fa-plus';
    					modules::run('activitylog/log',$params); //log activity
    
    					$this->session->set_flashdata('response_status', 'success');
    					$this->session->set_flashdata('message', lang('spk_transporter').' '.lang('created_succesfully'));
					}
                    
                    redirect('spk_transporter');
				}
		}else{
			$this->load->module('layouts');
			$this->load->library('template');
            $data['page'] = lang('spk_transporter');
            $data['datatables'] = true;
            $data['form'] = true;

			$data['creditors'] = $this->spk_transporter_model->get_data_creditor();			
            
			$this->template->set_layout('users')->build('create_spk_transporter',isset($data) ? $data : NULL);
		}
	}

	function update_spk_transporter()
	{
		
		if ($this->input->post()) {	
                $error = false;
                $result = true;
                $this->db->trans_begin();
                $dataPost = $this->input->post();
                
				$year = $this->input->post('spk_transporter_year');
				$month = $this->input->post('spk_transporter_month');
				$code = $this->input->post('spk_transporter_code');
				$spk_transporter_date = $this->input->post('spk_transporter_date');
                $spk_transporter_no = $this->input->post('spk_transporter_no');
				$get_data_hdr = $this->spk_transporter_model->get_data_header_by_spk_number($spk_transporter_no);
                
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
				$this->form_validation->set_rules('creditor_rowID', 'Creditor Name', 'required');
				$this->form_validation->set_rules('jo_type', 'JO Type', 'required|numeric');
				$this->form_validation->set_rules('jo_no', 'JO No', 'required');
				
				if ($this->form_validation->run() == FALSE)
				{
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('error_in_form'));
					redirect('spk_transporter/update_spk_transporter/'.$year.'/'.$month.'/'.$code);	
				}else{	
				    if($this->input->post('jo_no') != $this->input->post('jo_no_tmp')){
				        $delete_spk_transporter_detail_data = array(
    							'deleted' => 1,
                                'user_deleted'=>$this->session->userdata('user_rowID'),
    							'date_deleted'=>date('Y-m-d'),
    							'time_deleted'=>date('H:i:s')							
                        );
    					$this->db->where('deleted',0);
    					$this->db->where('spk_no',$spk_transporter_no);
    					
                        $result = $this->db->update('tr_spk_transporter_dtl', $delete_spk_transporter_detail_data);
                        if (!$result){
                            $error = true;
                        }
				    }
                    
                    if ($result){
    					$delete_spk_transporter_data = array(
    						'deleted' => 1,
                            'user_deleted'=>$this->session->userdata('user_rowID'),
    						'date_deleted'=>date('Y-m-d'),
    						'time_deleted'=>date('H:i:s')							
                        );
    					$this->db->where('deleted',0);
    					$this->db->where('year',$year);
    					$this->db->where('month',$month);
    					$this->db->where('code',$code);
                        
                        $result = $this->db->update('tr_spk_transporter_hdr', $delete_spk_transporter_data);
                            if ($result){
                                $spk_transporter_data = array(
        							'year' =>$year,
        							'month'=>$month,
        							'code' => $code,
        							'spk_no'=>$spk_transporter_no,
        							'spk_date'=>$spk_transporter_date,
        							'jo_type'=>$this->input->post('jo_type'),
        							'creditor_rowID'=>$this->input->post('creditor_rowID'),
        							'jo_no'=>$this->input->post('jo_no'),
                                    'user_created'=>$get_data_hdr->user_created,
                                    'date_created'=>$get_data_hdr->date_created,
                                    'time_created'=>$get_data_hdr->time_created,
        							'user_modified'=>$this->session->userdata('user_rowID'),
        							'date_modified'=>date('Y-m-d'),
        							'time_modified'=>date('H:i:s')							
                            );
        					  
        					$result = $this->db->insert('tr_spk_transporter_hdr', $spk_transporter_data);
                            if (!$result){
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
        				$params['module_field_id'] = $code;
        				$params['activity'] = ucfirst('Deleted a SPK Transporter No '.$spk_transporter_no);
        				$params['icon'] = 'fa-exclamation-triangle';
        				modules::run('activitylog/log',$params);
                        
                        $this->session->set_flashdata('response_status', 'error');
    					$this->session->set_flashdata('message', "Failed Data RollBack");
                        
                    }
                    else{
                        $this->db->trans_commit();
                                           
    					$params['user_rowID'] = $this->tank_auth->get_user_id();
    					$params['module'] = 'SPK Transporter';
    					$params['module_field_id'] = $code;
    					$params['activity'] = ucfirst('Updated a SPK Transporter No : '.$spk_transporter_no);
    					$params['icon'] = 'fa-edit';
    					modules::run('activitylog/log',$params); //log activity
    
    					$this->session->set_flashdata('response_status', 'success');
					   $this->session->set_flashdata('message', lang('spk_transporter').' '.lang('updated_succesfully'));
					}
                    
                    redirect('spk_transporter');
                    
				}
		}else{
			$this->load->module('layouts');
			$this->load->library('template');
            $data['page'] = lang('spk_transporter');
            $data['datatables'] = true;
            $data['form'] = true;
			
            $data['creditors'] = $this->spk_transporter_model->get_data_creditor();			
 		    
            $get_data = $this->spk_transporter_model->get_data_header_by_spk_no($this->uri->segment(3),$this->uri->segment(4),$this->uri->segment(5));
            $data['get_data'] = $get_data;
            
            $get_data_detail_jo = $this->spk_transporter_model->get_data_jo_detail_by_jo_no($get_data->jo_no);
            $data['get_data_detail_jo'] = $get_data_detail_jo;
            
             
			$this->template
			->set_layout('users')
			->build('update_spk_transporter',isset($data) ? $data : NULL);
		}
	}
    
    function price_spk_transporter()
	{
		$this->load->module('layouts');
		$this->load->library('template');
        $data['page'] = lang('spk_transporter');
        $data['datatables'] = true;
        $data['form'] = true;
		
        $data['vehicle_categories'] = $this->spk_transporter_model->get_data_vehicle_category();			
	    
        $get_data = $this->spk_transporter_model->get_data_header_by_spk_no($this->uri->segment(3),$this->uri->segment(4),$this->uri->segment(5));
        $data['get_data'] = $get_data;
        
        $get_data_detail_jo = $this->spk_transporter_model->get_data_jo_detail_by_jo_no($get_data->jo_no);
        $data['get_data_detail_jo'] = $get_data_detail_jo;
        
         
		$this->template->set_layout('users')->build('price_spk_transporter',isset($data) ? $data : NULL);
	
	}	
    
    function get_tarif_transporter(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $creditor_rowID = $this->input->post('creditor_rowID');
        $jo_type = $this->input->post('jo_type');
        $item_rowID = $this->input->post('item_rowID');
        $destination_from_rowID = $this->input->post('destination_from_rowID');
        $destination_to_rowID = $this->input->post('destination_to_rowID');
        $vehicle_type_rowID = $this->input->post('vehicle_type_rowID');
        
        $get_data = $this->spk_transporter_model->get_data_tarif_transporter($creditor_rowID,$jo_type,$item_rowID,$destination_from_rowID,$destination_to_rowID,$vehicle_type_rowID);
        $price = 0;
        if(count($get_data) > 0){
            $price = $get_data->price;    
        }
        
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode(array('price' => $price));
        exit;
    }
    
    function create_set_price(){
        $dataPost = $this->input->post();
        //echo "<pre>"; print_r($dataPost); echo "</pre>"; exit();
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $result = true;
        $error = false;
        $this->db->trans_begin();
        
        $spk_no = $this->input->post('spk_transporter_no');
        $jo_emkl_detail_rowID = $this->input->post('rowID');
        
        $check_data = $this->spk_transporter_model->check_data_spk_detail_by_spk_no_jo_detail_id($spk_no,$jo_emkl_detail_rowID);
        if(count($check_data) > 0){
            $data_deleted = array(
                'deleted' => 1,
                'user_deleted' => $this->session->userdata('user_id'),
                'date_deleted' => date('Y-m-d'),
                'time_deleted' => date('H:i:s')
            );
            $this->db->where('deleted',0);
            $this->db->where('spk_no',$spk_no);
            $this->db->where('jo_emkl_detail_rowID',$jo_emkl_detail_rowID);
            
            $result = $this->db->update('tr_spk_transporter_dtl', $data_deleted);
            if (!$result){
                $error = true;
            }
            
            if($result){
                if(!empty($dataPost['price'])){
                    $countDetail = count($dataPost['price']);
                    $vehicle_type_rowID = $dataPost['vehicle_type_rowID'];
                    $price = $dataPost['price'];
                    
                    for($i=0;$i<$countDetail;$i++){
                        $data_spk_detail = array(
                            'spk_no' => $spk_no,
                            'jo_emkl_detail_rowID' => $jo_emkl_detail_rowID,
                            'vehicle_type_rowID' => empty($vehicle_type_rowID[$i]) ? '0' : $vehicle_type_rowID[$i],
                            'price' => str_replace('.','',$price[$i]),
                            'user_created' => $check_data->user_created,
                            'date_created' => $check_data->date_created,
                            'time_created' => $check_data->time_created,
                            'user_modified' => $this->session->userdata('user_id'),
                            'date_modified' => date('Y-m-d'),
                            'time_modified' => date('H:i:s')
                        );
                        
                        $result = $this->db->insert('tr_spk_transporter_dtl', $data_spk_detail);
                        if (!$result){
                            $error = true;
                            break;
                        }
                                 
                    }
                }            
            }
            else{
                $error = true;
            }
        }
        else{
            if($result){
                if(!empty($dataPost['price'])){
                    $countDetail = count($dataPost['price']);
                    $vehicle_type_rowID = $dataPost['vehicle_type_rowID'];
                    $price = $dataPost['price'];
                    
                    for($i=0;$i<$countDetail;$i++){
                        $data_spk_detail = array(
                            'spk_no' => $spk_no,
                            'jo_emkl_detail_rowID' => $jo_emkl_detail_rowID,
                            'vehicle_type_rowID' => empty($vehicle_type_rowID[$i]) ? '0' : $vehicle_type_rowID[$i],
                            'price' => str_replace('.','',$price[$i]),
                            'user_created' => $this->session->userdata('user_id'),
                            'date_created' => date('Y-m-d'),
                            'time_created' => date('H:i:s')
                        );
                        
                        $result = $this->db->insert('tr_spk_transporter_dtl', $data_spk_detail);
                        if (!$result){
                            $error = true;
                            break;
                        }
                                 
                    }
                }            
            }
            else{
                $error = true;
            }
        }
            
        Header('Content-Type: application/json; charset=UTF8');
        $status = $this->db->trans_status();
        if ($status === false || $error == true){
            $this->db->trans_rollback();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
			$params['module'] = 'ERROR ROLLBACK Invoice';
			$params['module_field_id'] = $jo_emkl_detail_rowID;
			$params['activity'] = ucfirst('Deleted a Detail SPK Transporter No '.$spk_no.' AND JO EMKL Detail ID '.$jo_emkl_detail_rowID);
			$params['icon'] = 'fa-exclamation-triangle';
			modules::run('activitylog/log',$params);
            
            echo json_encode(array('success' => false, 'msg' => "Failed Data RollBack"));
            exit();
        }
        else{
            $this->db->trans_commit();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'SPK Transporter';
            $params['module_field_id'] = $jo_emkl_detail_rowID;
            $params['activity'] = ucfirst('Added a new Detail SPK Transporter No '.$spk_no.' AND JO EMKL Detail ID '.$jo_emkl_detail_rowID);
            $params['icon'] = 'fa-plus';
            modules::run('activitylog/log', $params); //log activity

            echo json_encode(array("success" => true, 'msg' => 'Saving data succesfully'));
            exit();
        }
    
    }
 	
	function delete_spk_transporter($spk_no)
	{
		error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $error = false;
        $this->db->trans_begin();
        
        $get_data = $this->spk_transporter_model->get_data_header_by_spk_number($spk_no);
        
        $delete_spk_transporter_data = array(
				'deleted' => 1,
                'user_deleted'=>$this->session->userdata('user_rowID'),
				'date_deleted'=>date('Y-m-d'),
				'time_deleted'=>date('H:i:s')							
        );
		$this->db->where('deleted',0);
		$this->db->where('spk_no',$spk_no);
		
        $result = $this->db->update('tr_spk_transporter_hdr', $delete_spk_transporter_data);
        if($result){
            $delete_spk_transporter_detail_data = array(
    				'deleted' => 1,
                    'user_deleted'=>$this->session->userdata('user_rowID'),
    				'date_deleted'=>date('Y-m-d'),
    				'time_deleted'=>date('H:i:s')							
            );
    		$this->db->where('deleted',0);
    		$this->db->where('spk_no',$spk_no);
    		
            $result = $this->db->update('tr_spk_transporter_dtl', $delete_spk_transporter_detail_data);
            if (!$result){
                $error = true;
            }
        }
        else{
            $error = true;
        }
        
        Header('Content-Type: application/json; charset=UTF8');
        $status = $this->db->trans_status();
        if ($status === false || $error == true){
            $this->db->trans_rollback();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
			$params['module'] = 'ERROR ROLLBACK Invoice';
			$params['module_field_id'] = $get_data->code;
			$params['activity'] = ucfirst('Deleted a SPK Transporter No '.$get_data->spk_no);
			$params['icon'] = 'fa-exclamation-triangle';
			modules::run('activitylog/log',$params);
            
            echo json_encode(array('success' => false, 'msg' => "Failed Data RollBack"));
            exit();
        }
        else{
            $this->db->trans_commit();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'SPK Transporter';
            $params['module_field_id'] = $get_data->code;
            $params['activity'] = ucfirst('Deleted a SPK Transporter No ' . $get_data->spk_no);
            $params['icon'] = 'fa-times';
            modules::run('activitylog/log', $params); //log activity

            echo json_encode(array("success" => true, 'msg' => lang('deleted_succesfully')));
            exit();
        }
	}

    function fetch_data() { 
        if ($this->input->is_ajax_request()) {
            $dt = $_POST;

            if($this->session->userdata('start_date_spk_transporter') == '' ){
                $start_date = date("Y-m-d", strtotime('-6 day'));
            }else{
                $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_spk_transporter')));
            }

            if($this->session->userdata('end_date_spk_transporter') == ''){
                $end_date = date("Y-m-d");
            }else{
                $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_spk_transporter')));
            }
            $str_between = " AND tr_spk_transporter_hdr.spk_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";
        
            $dt['table'] = 'tr_spk_transporter_hdr';
            $dt['id'] = 'year';
            $aColumnTable = array(
                'tr_spk_transporter_hdr.year',  'tr_spk_transporter_hdr.spk_no', 'tr_spk_transporter_hdr.spk_date', 'sa_creditor.creditor_name', 'tr_spk_transporter_hdr.jo_type', 'tr_spk_transporter_hdr.jo_no', 'tr_spk_transporter_hdr.month', 'tr_spk_transporter_hdr.code'
            );

            $aColumns = array(
               'tr_spk_transporter_hdr.year',  'tr_spk_transporter_hdr.spk_no', 'tr_spk_transporter_hdr.spk_date', 'sa_creditor.creditor_name', 'tr_spk_transporter_hdr.jo_type', 'tr_spk_transporter_hdr.jo_no', 'tr_spk_transporter_hdr.month', 'tr_spk_transporter_hdr.code'
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
                $sOrder .= "tr_spk_transporter_hdr.spk_no DESC";
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

            if (!empty($dt['columns'][6]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $start_date = date('Y-m-d', strtotime($dt['columns'][6]['search']['value']));
                $this->session->set_userdata('start_date_spk_transporter',date("Y-m-d",strtotime($start_date)));

                if($this->session->userdata('end_date_spk_transporter') == ''){
                    $end_date = date("Y-m-d");
                }else{
                    $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_spk_transporter')));
                }
                $str_between = " AND tr_spk_transporter_hdr.spk_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";

                $sWhere.= ' tr_spk_transporter_hdr.deleted = 0 ' . $str_between; 
            }

            if (!empty($dt['columns'][7]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $end_date = date('Y-m-d', strtotime($dt['columns'][7]['search']['value']));
                $this->session->set_userdata('end_date_spk_transporter', date("Y-m-d",strtotime($end_date)));

                if($this->session->userdata('start_date_spk_transporter') == ''){
                    $start_date = date("Y-m-d", strtotime('-6 day'));
                }else{
                    $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_spk_transporter')));
                }
                $str_between = " AND tr_spk_transporter_hdr.spk_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";
                
                $sWhere.= ' tr_spk_transporter_hdr.deleted = 0 ' . $str_between; 
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
                    $sWhere .= $aColumns[4] . " LIKE '%" . $this->db->escape_like_str(1) . "%' OR ";
                }

                $mystring_2 = 'CONTAINER, Container, container';
                $pos_2 = strpos($mystring_2, $sSearchVal);
                if ($pos_2 !== false) {
                    $sWhere .= $aColumns[4] . " LIKE '%" . $this->db->escape_like_str(2) . "%' OR ";
                }

                $mystring_3 = 'OTHER, Other, other';
                $pos_3 = strpos($mystring_3, $sSearchVal);
                if ($pos_3 !== false) {
                    $sWhere .= $aColumns[4] . " LIKE '%" . $this->db->escape_like_str(3) . "%' OR ";
                }

                $sWhere = substr_replace($sWhere, "", -3);
                $sWhere .= ') AND tr_spk_transporter_hdr.deleted = 0 ' . $str_between;
            }

            /** Total Data Set Length * */
            $sQuery = "SELECT * FROM " . $dt['table'] . " LEFT JOIN sa_creditor ON sa_creditor.rowID = tr_spk_transporter_hdr.creditor_rowID WHERE tr_spk_transporter_hdr.deleted = 0 " . $str_between;
            $rResultTotal = $this->db->query($sQuery);
            $aResultTotal = $rResultTotal->num_rows();
            $iTotal = $aResultTotal;
            
            /* Get Data To Display */
            if ($sWhere != "") {
                $where = $sWhere;
            } else {
                $where = " WHERE tr_spk_transporter_hdr.deleted = 0  " . $str_between;
            }

            $join_table = " LEFT JOIN sa_creditor ON sa_creditor.rowID = tr_spk_transporter_hdr.creditor_rowID ";

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
                        $dropdown_option .= '<li><a href="' . base_url() . 'spk_transporter/price_spk_transporter/' . $aRow['year'] . '/' . $aRow['month'] . '/' . $aRow['code'] . '"><i class="fa fa-money"></i> '. lang('set_price') . '</a></li>';
                    }
                    if($this->get_user_access('Updated') == 1){
                        $dropdown_option .= '<li><a href="' . base_url() . 'spk_transporter/update_spk_transporter/' . $aRow['year'] . '/' . $aRow['month'] . '/' . $aRow['code'] . '"><i class="fa fa-pencil"></i> ' . lang('update_option') . '</a></li>';
                    }
                    if($this->user_profile->get_user_access('Deleted') == 1){
                        $dropdown_option .= '<li><a href="javascript:void()" title="' . lang('delete_option') . '" onclick="delete_spk_transporter(\'' . $aRow['spk_no'] . '\')"><i class="fa fa-trash-o"></i> ' . lang('delete_option') . '</a></li>';
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
              
                    $row['dropdown_option'] = $dropdown_option;
                    $row['spk_no'] = $aRow['spk_no'];
                    $row['spk_date'] = date("d F Y",strtotime($aRow['spk_date']));
                    $row['creditor_name'] = $aRow['creditor_name'];
                    $row['jo_type'] = $jo_type;
                    $row['jo_no'] = $aRow['jo_no'];

                    $row['start_date'] = $aRow['spk_date'];
                    $row['end_date'] = $aRow['spk_date'];
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
        $this->db->where('Link_Menu', 'spk_transporter');
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