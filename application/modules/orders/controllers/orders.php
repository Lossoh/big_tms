<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Orders extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('orders_model','order');
			
	}

	function index()
	{
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title(lang('orders').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
	$data['page'] = lang('orders');
	$this->session->set_userdata('page_header', 'transaction');		
	$this->session->set_userdata('page_detail', 'orders');
	$this->session->set_userdata('filter_client_id', 0);
	/* $data['vessel_status'] = $this->AppModel->get_all_record_reference($table = 'mst_reference',
				$array = array('Type_Ref' => 'vessel_status'),'No_Urut_Ref'); */
				
	$data['document_destination_vessel'] = $this->order->document_destination_vessel($this->session->userdata('vessel_active'),0);
	//$data['filter_by_vessels']=$this->order->filter_by_vessel();

		
	$this->template
	->set_layout('users')
	->build('orders',isset($data) ? $data : NULL);
	}

	function search()
	{
		if ($this->input->post()) {
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title(lang('vessels').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
	$data['page'] = lang('vessels');
	$keyword = $this->input->post('keyword', TRUE);
	$data['vessels'] = $this->vessel->search_estimate($keyword);
	$this->template
	->set_layout('users')
	->build('vessels',isset($data) ? $data : NULL);
		}else{
			redirect('vessels');
		}
	}
	
	function view_by_status()
	{
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title(lang('vessels').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
	$data['page'] = lang('vessels');
	$data['form'] = TRUE;
	$data['vessel_status'] = $this->AppModel->get_all_record_reference($table = 'mst_reference',
				$array = array('Type_Ref' => 'vessel_status'),'No_Urut_Ref');
	if($this->uri->segment(3)==''){	
		$data['vessels'] = $this->AppModel->get_all_records_limit($table = 'mst_vessels',
		$array = array(
			'vessel_id >' => 0, 'deleted' => 0
			),
		$join_table = 'mst_reference',$join_criteria = 'mst_reference.No_Urut_Ref = mst_vessels.vessel_status AND fx_mst_reference.Type_Ref="vessel_status"','vessel_ref', 10);
	}else{
	$data['vessels'] = $this->AppModel->get_all_records_limit($table = 'mst_vessels',
		$array = array(
			'vessel_id >' => 0, 'vessel_status' => $this->uri->segment(3) , 'deleted' => 0
			),
		$join_table = 'mst_reference',$join_criteria = 'mst_reference.No_Urut_Ref = mst_vessels.vessel_status AND fx_mst_reference.Type_Ref="vessel_status"','vessel_ref',10);
		}
	$this->template
	->set_layout('users')
	->build('vessels',isset($data) ? $data : NULL);
	}


	function get_vessel_details(){

	    $vessel_id=$this->input->post('vesselid');

		$data['total_document_vessel']=$this->order->sum_item($table='trx_vessel_document',$array=array('deleted' => 0,'vessel_id' => $vessel_id), 'qty_po');
		
		$data['total_do_vessel']=$this->order->sum_item($table='trx_sj',$array=array('deleted' => 0, 'vessel_id' => $vessel_id), 'qty_bulk_delivery_netto');

		$data['vessels'] = $this->AppModel->get_all_records($table = 'mst_vessels',
		$array = array('vessel_id' => $vessel_id),
		$join_table = 'mst_reference',$join_criteria = 'mst_reference.No_Urut_Ref = mst_vessels.vessel_status AND fx_mst_reference.Type_Ref="vessel_status"','vessel_ref');		

        $this->load->view('ajax_detail_vessel',$data);
	}

	function barcode_lists(){
	
	


			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title(lang('orders').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
			$data['page'] = lang('orders');
			$data['form'] = TRUE;
			$data['datatables'] = TRUE;				
			$data['timer_interval']=TRUE;
			$data['set_timer']=300;
			$data['delivery_order_barcodes'] = $this->order->get_all_delivery_order();

			
			$this->template
			->set_layout('users')
			->build('barcode_list',isset($data) ? $data : NULL);
	
			
			
		
	
	}
	
	function verify_barcode(){
	
	
		if ($this->input->post()) {
		
			$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
			$this->form_validation->set_rules('sj_id', 'Delivery Order ID', 'required|numeric');
			$this->form_validation->set_rules('barcode_id_verify', 'Barcode ID', 'required|numeric');
			$this->form_validation->set_rules('sj_ref', 'Delivery Order Reference', 'required');
			$this->form_validation->set_rules('document_separate_id', 'Document Separate ID', 'required|numeric');
			
			$sj_id=trim($this->input->post('sj_id'));
			$barcode_id=trim($this->input->post('barcode_id_verify'));
			$sj_ref=trim($this->input->post('sj_ref'));			
			$document_separate_id=trim($this->input->post('document_separate_id'));
		
		
			if ($this->form_validation->run() == FALSE)
			{				
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('operation_failed'));
					redirect('orders/verify_barcode');
					
			}else if($this->order->check_barcode_verify($array = array('destination_flag' => 1, 'destination_flag' => 3,'barcode_id' => $barcode_id, 'user_gateout >' => 0),'mst_destinations', 'mst_destinations.destination_id=trx_sj.destination_to')) {
					
					
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('barcode_id_not_gateout'));
					redirect('orders/verify_barcode');
			
			
			}else{			

					$form_data = array(
								'user_gateout'	=>	$this->session->userdata('user_id'),
								'gateout_date'	=>	date('Y-m-d'),
								'gateout_time'	=>	date('H:i:s'),
								'gateout_datetime'	=>	date('Y-m-d H:i:s'),
							);
							
					$this->db->where('sj_id',$sj_id)->update('trx_sj', $form_data);		
				
					$activity = ucfirst($this->tank_auth->get_username().' Barcode ID #'.$barcode_id.' - '.$sj_ref);
					
					$this->_log_activity($sj_id,$activity,$icon = 'fa-pencil'); //log activity

					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', lang('barcode_verify_successfully'));
					redirect('orders/verify_barcode');		



			}

		}else{

			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title(lang('orders').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
			$data['page'] = lang('orders');
			$data['form'] = TRUE;
			$data['set_timer']=60;
			$data['timer_interval']=TRUE;
			

			$this->template
			->set_layout('users')
			->build('verify_barcode',isset($data) ? $data : NULL);
	
			
		}	
		
	
	}
	function get_barcode_details(){
	    $barcode_id=$this->input->post('barcode_id');

		$data['barcode_details'] = $this->order->barcode_details($barcode_id); 
		
        $this->load->view('barcode_details',$data);
	}
	
	
	function receipt_document(){
	
	
		if ($this->input->post()) {
		
			$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
			$this->form_validation->set_rules('sj_id', 'Delivery Order ID', 'required|numeric');
			$this->form_validation->set_rules('barcode_id_receipt', 'Barcode ID', 'required|numeric');
			$this->form_validation->set_rules('sj_ref', 'Delivery Order Reference', 'required');
			$this->form_validation->set_rules('document_separate_id', 'Document Separate ID', 'required|numeric');
			$this->form_validation->set_rules('qty_bulk_receipt_netto', 'Qty Bulk Netto', 'required|numeric');
			$sj_id=trim($this->input->post('sj_id'));
			$barcode_id=trim($this->input->post('barcode_id_receipt'));
			$sj_ref=trim($this->input->post('sj_ref'));			
			$document_separate_id=trim($this->input->post('document_separate_id'));
			//$qty_bulk_receipt_bruto=trim($this->input->post('qty_bulk_receipt_bruto'));	
			//$qty_bulk_receipt_tarra=trim($this->input->post('qty_bulk_receipt_tarra'));
			$qty_bulk_receipt_netto=trim($this->input->post('qty_bulk_receipt_netto'));
		
			if ($this->form_validation->run() == FALSE)
			{				
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('operation_failed'));
					redirect('orders/receipt_document');
					
			}else if($this->order->check_barcode_verify($array = array('barcode_id' => $barcode_id, 'deleted' =>1),'', '')) {
					
					
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('barcode_id_is_deleted'));
					redirect('orders/receipt_document');
			
			
			}else{			

					$form_data = array(
								//'qty_bulk_receipt_bruto' => $qty_bulk_receipt_bruto,
								//'qty_bulk_receipt_tarra' => $qty_bulk_receipt_tarra,
								'qty_bulk_receipt_netto' =>	$qty_bulk_receipt_netto,
								'user_receipt'	=>	$this->session->userdata('user_id'),
								'receipt_date'	=>	date('Y-m-d'),
								'receipt_time'	=>	date('H:i:s'),
								'receipt_datetime'	=>	date('Y-m-d H:i:s'),
							);
							
					$this->db->where('sj_id',$sj_id)->update('trx_sj', $form_data);		
				
					$activity = ucfirst($this->tank_auth->get_username().' Barcode ID #'.$barcode_id.' - '.$sj_ref);
					
					$this->_log_activity($sj_id,$activity,$icon = 'fa-pencil'); //log activity

					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', lang('barcode_receipt_successfully'));
					redirect('orders/receipt_document');		



			}

		}else{
			$this->session->set_userdata('page_header', 'transaction');		
			$this->session->set_userdata('page_detail', 'receipt_document');
			$this->load->module('layouts');
			$this->load->library('template');
			
			$this->template->title(lang('orders').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
			$data['page'] = lang('orders');
			$data['form'] = TRUE;
			$data['set_timer']=120;
			$data['timer_interval']=TRUE;
			

			$this->template
			->set_layout('users')
			->build('receipt_document',isset($data) ? $data : NULL);
	
			
		}	
		
	
	}	

	function get_barcode_receipt_details(){
	    $barcode_id=$this->input->post('barcode_id');

		$data['barcode_details'] = $this->order->barcode_details_receipt($barcode_id); 
		
        $this->load->view('receipt_details',$data);
	}
	
	function addbarcode(){
	
		if ($this->input->post()) {
		
			$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
			$this->form_validation->set_rules('sj_id', 'Delivery Order ID', 'required');
			$this->form_validation->set_rules('barcode_id_add', 'Barcode ID', 'required');
			$this->form_validation->set_rules('sj_ref', 'Delivery Order Reference', 'required');
			$this->form_validation->set_rules('document_separate_id', 'Document Separate ID', 'required');
			
			$sj_id=trim($this->input->post('sj_id'));
			$barcode_id=trim($this->input->post('barcode_id_add'));
			$sj_ref=trim($this->input->post('sj_ref'));
			
			$document_separate_id=trim($this->input->post('document_separate_id'));
		
		
			if ($this->form_validation->run() == FALSE)
			{				
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('operation_failed'));
					redirect('orders/addbarcode/'.$sj_id);
					
			}else if($this->order->check_barcode_list($array = array('Barcode_ID' => $barcode_id, 'deleted' => 1))) {
					
					
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('barcode_id_was_deleted'));
					redirect('orders/addbarcode/'.$sj_id);
			
			
			}else if($this->order->check_barcode($array = array('barcode_id' => $barcode_id))) {
					
					
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('barcode_id_used'));
					redirect('orders/addbarcode/'.$sj_id);
			
			
			}else if(!$this->order->check_barcode_list($array = array('Barcode_ID' => $barcode_id))) {
					
					
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('barcode_id_was_not_registered'));
					redirect('orders/addbarcode/'.$sj_id);
			
			
			}else{			

					$form_data = array(
								'barcode_id'	=>	$barcode_id,
								'user_barcode'	=>	$this->session->userdata('user_id'),
								'barcode_date'	=>	date('Y-m-d'),
								'barcode_time'	=>	date('H:i:s'),
								
							);
							
					$this->db->where('sj_id',$sj_id)->update('trx_sj', $form_data);		
				
					$activity = ucfirst($this->tank_auth->get_username().' Barcode ID #'.$barcode_id.' - '.$sj_ref);
					
					$this->_log_activity($sj_id,$activity,$icon = 'fa-pencil'); //log activity

					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', lang('barcode_add_successfully'));
					redirect('orders/barcode_lists');		



			}

		}else{


			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title(lang('orders').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
			$data['page'] = lang('orders');
			$data['form'] = TRUE;
			$data['datatables'] = TRUE;				
			
			
			$data['sjk_details'] = $this->order->sjk_details($this->uri->segment(3));

			
			$this->template
			->set_layout('users')
			->build('add_barcode',isset($data) ? $data : NULL);
	
			
			
		}	
	
	
	}

	function recap_document(){
	
	
		if ($this->input->post()) {
		
			$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
			$this->form_validation->set_rules('sj_id', 'Delivery Order ID', 'required|numeric');
			$this->form_validation->set_rules('barcode_id_receipt', 'Barcode ID', 'required|numeric');
			$this->form_validation->set_rules('sj_ref', 'Delivery Order Reference', 'required');
			$this->form_validation->set_rules('document_separate_id', 'Document Separate ID', 'required|numeric');
			$this->form_validation->set_rules('qty_bulk_receipt_netto', 'Qty Bulk Netto', 'required|numeric');
			$sj_id=trim($this->input->post('sj_id'));
			$barcode_id=trim($this->input->post('barcode_id_receipt'));
			$sj_ref=trim($this->input->post('sj_ref'));			
			$document_separate_id=trim($this->input->post('document_separate_id'));
			//$qty_bulk_receipt_bruto=trim($this->input->post('qty_bulk_receipt_bruto'));	
			//$qty_bulk_receipt_tarra=trim($this->input->post('qty_bulk_receipt_tarra'));
			$qty_bulk_receipt_netto=trim($this->input->post('qty_bulk_receipt_netto'));
		
			if ($this->form_validation->run() == FALSE)
			{				
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('operation_failed'));
					redirect('orders/receipt_document');
					
			}else if($this->order->check_barcode_verify($array = array('barcode_id' => $barcode_id, 'deleted' =>1),'', '')) {
					
					
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('barcode_id_is_deleted'));
					redirect('orders/receipt_document');
			
			
			}else{			

					$form_data = array(
								//'qty_bulk_receipt_bruto' => $qty_bulk_receipt_bruto,
								//'qty_bulk_receipt_tarra' => $qty_bulk_receipt_tarra,
								'qty_bulk_receipt_netto' =>	$qty_bulk_receipt_netto,
								'user_receipt'	=>	$this->session->userdata('user_id'),
								'receipt_date'	=>	date('Y-m-d'),
								'receipt_time'	=>	date('H:i:s'),
								'receipt_datetime'	=>	date('Y-m-d H:i:s'),
							);
							
					$this->db->where('sj_id',$sj_id)->update('trx_sj', $form_data);		
				
					$activity = ucfirst($this->tank_auth->get_username().' Barcode ID #'.$barcode_id.' - '.$sj_ref);
					
					$this->_log_activity($sj_id,$activity,$icon = 'fa-pencil'); //log activity

					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', lang('barcode_receipt_successfully'));
					redirect('orders/receipt_document');		



			}

		}else{

			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title(lang('orders').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
			$data['page'] = lang('recap_document');
			$this->session->set_userdata('page_header', 'transaction');		
			$this->session->set_userdata('page_detail', 'recap_document');
			
			$data['form'] = TRUE;
			
			$data['vessel_defaults'] = $this->AppModel->get_all_records($table = 'users', $array = array(
			'id' => $this->session->userdata('user_id')), $join_table = 'mst_vessels', $join_criteria = 'mst_vessels.vessel_id=users.vessel_id','id');
			
			$data['recap_documents'] = $this->AppModel->get_all_records($table = 'trx_recap_document_h', $array = array(
			'vessel_id' => $this->order->get_id($table = 'users',
			$array = array('id' => $this->session->userdata('user_id'), 'activated' => 1),'vessel_id'), 'deleted' => 0), $join_table = '', $join_criteria = '','recap_id');

			$this->template
			->set_layout('users')
			->build('recap_document',isset($data) ? $data : NULL);
	
			
		}	
		
	
	}


	function documentmon(){
	
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('trucks').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('trucks');
		$data['datatables'] = TRUE;
		$data['form'] = TRUE;
		
		$data['unload_receipt_lists'] =$this->order->unload_receipt();		
		$data['sj_lists'] = $this->order->sj();	
		$data['barcode_lists'] = $this->order->barcode();
		$data['verify_lists'] = $this->order->verify();
		
		$this->template
		->set_layout('users')
		->build('documentmon',isset($data) ? $data : NULL);	
		
	
	}

	
	function _log_activity($sj_id,$activity,$icon){
			$this->db->set('module', 'orders');
			$this->db->set('module_field_id', $sj_id);
			$this->db->set('user', $this->tank_auth->get_user_id());
			$this->db->set('activity', $activity);
			$this->db->set('icon', $icon);
			$this->db->insert('activities'); 
	}	
	
	
}
