<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Job_order_vessel extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('job_order_vessel_model');
		$this->load->model('fare_trip/fare_trip_model');
	}

	function index()
	{
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('job_order_vessel').' - '.$this->config->item('website_name').' - '.$this->config->item('comp_name').' '. $this->config->item('version'));
		$data['page'] = lang('job_order_vessel');
		$this->session->set_userdata('page_header', 'transaction');		
		$this->session->set_userdata('page_detail', 'job_order_vessel');
		$data['form'] = TRUE;
		$data['datatables'] = TRUE;
		
		$data['job_orders'] = $this->job_order_vessel_model->get_all_records_list();
		
		$this->template
		->set_layout('users')
		->build('job_order_vessels',isset($data) ? $data : NULL);
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
				$this->form_validation->set_rules('job_order_price', 'Price', 'required|numeric');


				
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
				
					$new_job_order_code= ((int)$this->AppModel->select_max_id('tr_jo_trx_hdr',$array = array('year' =>date('Y'),'month' =>date('m')),'code'))+1;					

					$job_order_no='JO'.sprintf("%04s",date('Y')).sprintf("%02s",date('m')).sprintf("%04s",$new_job_order_code);
				
					$job_order_data = array(
							'year' =>date('Y'),
							'month'=>date('m'),
							'code' => $new_job_order_code,
							'jo_no'=>$job_order_no,
							'jo_date'=>date('Y-m-d'),
							'jo_type'=>$this->input->post('job_order_type'),
							'debtor_rowID'=>$this->input->post('debtor'),
							'po_spk_no'=>strtoupper(trim($this->input->post('po_spk_no'))),
							'so_no'=>strtoupper(trim($this->input->post('so_no'))),
							'port_rowID'=>$this->input->post('port'),
							'vessel_rowID'=>0,
							'vessel_no'=>strtoupper(trim($this->input->post('vessel_no'))),
							'vessel_name'=>strtoupper(trim($this->input->post('vessel_name'))),
							'item_rowID'=>$this->input->post('item'),
							'weight'=>$this->input->post('weight_item'),
							'fare_trip_rowID'=>$this->input->post('fare_trip'),
							'destination_from_rowID'=>$this->input->post('destination_from_id'),
							'destination_to_rowID'=>$this->input->post('destination_to_id'),
							'wholesale'=>($this->input->post('job_order_wholesale_yes_no') == 'on') ? 1 : 0,
							'price_amount'=>$this->input->post('job_order_price'),
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
					$params['activity'] = ucfirst('Added a new job_order '.$job_order_no);
					$params['icon'] = 'fa-plus';
					modules::run('activitylog/log',$params); //log activity

					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', lang('job_order').' '.lang('created_succesfully'));
					redirect('job_order');
				}
		}else{
			$this->load->module('layouts');
			$this->load->library('template');
			$data['form'] = TRUE;
			//$data['datatables'] = TRUE;

			$data['jo_type'] = $this->job_order_vessel_model->get_all_records($table = 'sa_reference', $array = array(
			'type_ref' => 'jo_type'), $join_table = '', $join_criteria = '','type_no','ASC');			
			
			$data['debtors'] = $this->job_order_vessel_model->get_all_records($table = 'sa_debtor', $array = array(
			'type' => 'C','rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','debtor_name','ASC');
			
			$data['ports'] = $this->job_order_vessel_model->get_all_records($table = 'sa_port', $array = array(
			'rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','port_name','ASC');	
			
			$data['fare_trips'] = $this->fare_trip_model->get_all_fare_trip();

			$data['items'] = $this->job_order_vessel_model->get_all_records($table = 'sa_item', $array = array(
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
				$this->form_validation->set_rules('job_order_price', 'Price', 'required|numeric');


				
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
					$new_job_order_code= ((int)$this->AppModel->select_max_id('tr_jo_trx_hdr',$array = array('year' =>date('Y'),'month' =>date('m')),'code'))+1;					

					$job_order_no='JO'.sprintf("%04s",date('Y')).sprintf("%02s",date('m')).sprintf("%04s",$new_job_order_code);
				
					$job_order_data = array(
							'year' =>date('Y'),
							'month'=>date('m'),
							'code' => $new_job_order_code,
							'jo_no'=>$job_order_no,
							'jo_date'=>date('Y-m-d'),
							'jo_type'=>$this->input->post('job_order_type'),
							'debtor_rowID'=>$this->input->post('debtor'),
							'po_spk_no'=>strtoupper(trim($this->input->post('po_spk_no'))),
							'so_no'=>strtoupper(trim($this->input->post('so_no'))),
							'port_rowID'=>$this->input->post('port'),
							'vessel_rowID'=>0,
							'vessel_no'=>strtoupper(trim($this->input->post('vessel_no'))),
							'vessel_name'=>strtoupper(trim($this->input->post('vessel_name'))),
							'item_rowID'=>$this->input->post('item'),
							'weight'=>$this->input->post('weight_item'),
							'fare_trip_rowID'=>$this->input->post('fare_trip'),
							'destination_from_rowID'=>$this->input->post('destination_from_id'),
							'destination_to_rowID'=>$this->input->post('destination_to_id'),
							'wholesale'=>($this->input->post('job_order_wholesale_yes_no') == 'on') ? 1 : 0,
							'price_amount'=>$this->input->post('job_order_price'),
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
					$params['activity'] = ucfirst('Added a Copy new job_order '.$job_order_no);
					$params['icon'] = 'fa-copy';
					modules::run('activitylog/log',$params); //log activity

					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', lang('job_order').' '.lang('created_succesfully'));
					redirect('job_order');
				}
		}else{
			$this->load->module('layouts');
			$this->load->library('template');
			$data['form'] = TRUE;
			
			$data['job_orders'] = $this->job_order_vessel_model->get_records_details($this->uri->segment(3),$this->uri->segment(4),$this->uri->segment(5));

			$data['jo_type'] = $this->job_order_vessel_model->get_all_records($table = 'sa_reference', $array = array(
			'type_ref' => 'jo_type'), $join_table = '', $join_criteria = '','type_no','ASC');			
			
			$data['debtors'] = $this->job_order_vessel_model->get_all_records($table = 'sa_debtor', $array = array(
			'type' => 'C','rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','debtor_name','ASC');
			
			$data['ports'] = $this->job_order_vessel_model->get_all_records($table = 'sa_port', $array = array(
			'rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','port_name','ASC');	
			
			$data['fare_trips'] = $this->fare_trip_model->get_all_fare_trip();

			$data['items'] = $this->job_order_vessel_model->get_all_records($table = 'sa_item', $array = array(
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
				$this->form_validation->set_rules('job_order_type', 'Type', 'required|numeric');
				$this->form_validation->set_rules('debtor', 'Debtor', 'required|numeric');
				$this->form_validation->set_rules('po_spk_no', 'PO/SPK No', 'required');
				$this->form_validation->set_rules('port', 'Port', 'required|numeric');
				$this->form_validation->set_rules('item', 'Item', 'required|numeric');
				$this->form_validation->set_rules('weight_item', 'Weight Item', 'required|numeric');
				$this->form_validation->set_rules('fare_trip', 'Fare Trip', 'required|numeric');
				$this->form_validation->set_rules('job_order_price', 'Price', 'required|numeric');


				
				if ($this->form_validation->run() == FALSE)
				{
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('error_in_form'));
					redirect('job_order/update_job_order/'.$year.'/'.$month.'/'.$code);	
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
                        */
					}
                    
					$job_order_data = array(
							'jo_type'=>$this->input->post('job_order_type'),
							'debtor_rowID'=>$this->input->post('debtor'),
							'po_spk_no'=>strtoupper(trim($this->input->post('po_spk_no'))),
							'so_no'=>strtoupper(trim($this->input->post('so_no'))),
							'port_rowID'=>$this->input->post('port'),
							'vessel_rowID'=>0,
							'vessel_no'=>strtoupper(trim($this->input->post('vessel_no'))),
							'vessel_name'=>strtoupper(trim($this->input->post('vessel_name'))),
							'item_rowID'=>$this->input->post('item'),
							'weight'=>$this->input->post('weight_item'),
							'fare_trip_rowID'=>$this->input->post('fare_trip'),
							'destination_from_rowID'=>$this->input->post('destination_from_id'),
							'destination_to_rowID'=>$this->input->post('destination_to_id'),
							'wholesale'=>($this->input->post('job_order_wholesale_yes_no') == 'on') ? 1 : 0,
							'price_amount'=>$this->input->post('job_order_price'),
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
					 
					//$this->db->where(array('year' => $this->input->post('vessel_id'), 'vessel_status' => 1))->update('trx_sj', $form_data);	 
					$this->db->where('year',$year);
					$this->db->where('month',$month);
					$this->db->where('code',$code);
					$this->db->update('tr_jo_trx_hdr', $job_order_data);					 


					$params['user_rowID'] = $this->tank_auth->get_user_id();
					$params['module'] = 'Job Order';
					$params['module_field_id'] = $code;
					$params['activity'] = ucfirst('Updated a job_order no : '.$job_order_no);
					$params['icon'] = 'fa-pencil';
					modules::run('activitylog/log',$params); //log activity

					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', lang('job_order').' '.lang('updated_succesfully'));
					redirect('job_order');	
                    //redirect('job_order/update_job_order/'.$year.'/'.$month.'/'.$code);	
				}
		}else{
			$this->load->module('layouts');
			$this->load->library('template');
			$data['form'] = TRUE;
			
			$data['job_orders'] = $this->job_order_vessel_model->get_records_details($this->uri->segment(3),$this->uri->segment(4),$this->uri->segment(5));

			$data['jo_type'] = $this->job_order_vessel_model->get_all_records($table = 'sa_reference', $array = array(
			'type_ref' => 'jo_type'), $join_table = '', $join_criteria = '','type_no','ASC');			
			
			$data['debtors'] = $this->job_order_vessel_model->get_all_records($table = 'sa_debtor', $array = array(
			'type' => 'C','rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','debtor_name','ASC');
			
			$data['ports'] = $this->job_order_vessel_model->get_all_records($table = 'sa_port', $array = array(
			'rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','port_name','ASC');	
			
			$data['fare_trips'] = $this->fare_trip_model->get_all_fare_trip();

			$data['items'] = $this->job_order_vessel_model->get_all_records($table = 'sa_item', $array = array(
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
		$data_sparepart = $this->job_order_vessel_model->get_fare_trip_by($term);

		// keluarkan dalam bentuk json
		echo json_encode($data_sparepart);   
	}

		
	function get_wo_debtor(){
        $debtor_rowID=$this->input->post('debtor_rowID');
        $data=array(
            'wo_lists'=> $this->job_order_vessel_model->get_all_record_debtor_wo($debtor_rowID)
        );

		$this->load->view('ajax_wo_type',$data);
    }
	
	function get_wo(){
        $wo_no=$this->input->post('wo_no');
        $data=array(
            'wo_lists'=> $this->job_order_vessel_model->get_all_record_wo($wo_no)
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
			$params['activity'] = ucfirst('Deleted a job_order no : '.$jo_no);
			$params['icon'] = 'fa-trash-o';
			modules::run('activitylog/log',$params); //log activity	
			
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('job_order').' '.lang('deleted_successfully'));
			redirect('job_order');
		}else{
			
			$data['job_orders'] = $this->job_order_vessel_model->get_records_details($this->uri->segment(3),$this->uri->segment(4),$this->uri->segment(5));
			$this->load->view('modal/delete_job_order',$data);

		}
	}
	
}

/* End of file contacts.php */