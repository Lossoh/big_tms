<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
**********************************************************************************
* Copyright: gitbench 2014
* Licence: Please check CodeCanyon.net for licence details. 
* More licence clarification available here: htttp://codecanyon.net/wiki/support/legal-terms/licensing-terms/ 
* CodeCanyon User: http://codecanyon.net/user/gitbench
* CodeCanyon Project: http://codecanyon.net/item/freelancer-office/8870728
* Package Date: 2014-09-24 09:33:11 
***********************************************************************************
*/

class Manage extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('estimates_model','estimate');
	}
	
	function add()
	{
		if ($this->input->post()) {
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('reference_no', 'Reference No', 'required');
		$this->form_validation->set_rules('client', 'Client', 'required');
		$this->form_validation->set_rules('due_date', 'Due Date', 'required');

		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('estimates');
		}else{			
			$form_data = array(
			                'reference_no' => $this->input->post('reference_no'),
			                'client' => $this->input->post('client'),
			                'due_date' => $this->input->post('due_date'),
			                'tax' => $this->input->post('tax'),
			                'notes' => $this->input->post('notes'),
			            );
			$this->db->insert('estimates', $form_data); 
			$estimate_id = $this->db->insert_id();

			$activity = ucfirst('Estimate #'.$this->input->post('reference_no').' created.');
			$this->_log_activity($estimate_id,$activity,$icon = 'fa-plus'); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('estimate_created_successfully'));
			redirect('estimates/manage/details/'.$estimate_id);
		}

		}else{


	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title(lang('estimates').' - '.$this->config->item('company_name'). ' '. $this->config->item('version'));
	$data['page'] = lang('estimates');
	$data['form'] = TRUE;
	$data['clients'] = $this->AppModel->get_all_records($table = 'companies',
		$array = array(
			'co_id >' => '0'),$join_table = '',$join_criteria = '','date_added');
	$data['estimates'] = $this->AppModel->get_all_records($table = 'estimates',
		$array = array(
			'est_deleted' => 'No',
			),
		$join_table = '',$join_criteria = '','date_saved');
	$this->template
	->set_layout('users')
	->build('create_estimate',isset($data) ? $data : NULL);

		}
	}

	function edit()
	{
		if ($this->input->post()) {
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('reference_no', 'Reference No', 'required');
		$this->form_validation->set_rules('client', 'Client', 'required');
		$this->form_validation->set_rules('due_date', 'Due Date', 'required');
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('estimates');
		}else{	
		$estimate_id = $this->input->post('estimate', TRUE);	

			$form_data = array(
			                'client' => $this->input->post('client'),
			                'due_date' => $this->input->post('due_date'),
			                'notes' => $this->input->post('notes'),
			                'tax' => $this->input->post('tax'),
			            );
			$this->db->where('est_id',$estimate_id)->update('estimates', $form_data);

			$activity = ucfirst($this->tank_auth->get_username().' edited ESTIMATE #'.$this->input->post('reference_no'));
			$this->_log_activity($estimate_id,$activity,$icon = 'fa-pencil'); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('estimate_edited_successfully'));
			redirect('estimates/manage/details/'.$estimate_id);
		}

		}else{


	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title(lang('estimates').' - '.$this->config->item('company_name'). ' '. $this->config->item('version'));
	$data['page'] = lang('estimates');
	$data['form'] = TRUE;
	$data['clients'] = $this->AppModel->get_all_records($table = 'companies',
		$array = array(
			'co_id >' => '0'),$join_table = '',$join_criteria = '','date_added');
	$data['estimates'] = $this->AppModel->get_all_records($table = 'estimates',
		$array = array(
			'est_deleted' => 'No',
			),
		$join_table = '',$join_criteria = '','date_saved');
	$data['estimate_details'] =  $this->estimate->estimate_details($this->uri->segment(4));
	$this->template
	->set_layout('users')
	->build('edit_estimate',isset($data) ? $data : NULL);

		}
	}


	function item()
	{
		if ($this->input->post()) {
		$est_id = $this->input->post('estimate_id');
		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('quantity', 'Quantity', 'required');
		$this->form_validation->set_rules('unit_cost', 'Unit Cost', 'required');
		$this->form_validation->set_rules('item_desc', 'Item Description', 'required');
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('estimates/manage/details/'.$est_id);
		}else{			
			$form_data = array(
			                'estimate_id' => $this->input->post('estimate_id'),
			                'item_desc' => $this->input->post('item_desc'),
			                'unit_cost' => $this->input->post('unit_cost'),
			                'quantity' => $this->input->post('quantity'),
			                'total_cost' => $this->input->post('unit_cost') * $this->input->post('quantity')
			            );
			$this->db->insert('estimate_items', $form_data); 
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('item_added_successfully'));
			redirect('estimates/manage/details/'.$est_id);
		}

		}else{

	redirect('estimates/manage/view/all');

		}
	}
	function details()
	{		
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('estimates').' - '.$this->config->item('company_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('estimates');
		$data['estimate_details'] = $this->estimate->estimate_details($this->uri->segment(4));
		$data['estimate_activities'] = $this->estimate->estimate_activities($this->uri->segment(4));
		$data['estimate_items'] = $this->estimate->estimate_items($this->uri->segment(4));
		$data['estimates'] = $this->AppModel->get_all_records($table = 'estimates',$array = array(
			'est_deleted' => 'No',
			),$join_table = '',$join_criteria = '','date_saved');
		$this->template
		->set_layout('users')
		->build('estimate_details',isset($data) ? $data : NULL);
	}
	function timeline()
	{		
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('estimates').' - '.$this->config->item('company_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('estimates');
		$data['estimate_details'] = $this->estimate->estimate_details($this->uri->segment(4));
		$data['activities'] = $this->estimate->estimate_activities($this->uri->segment(4));
		$data['estimates'] = $this->AppModel->get_all_records($table = 'estimates',$array = array(
			'est_deleted' => 'No',
			),$join_table = '',$join_criteria = '','date_saved');
		$this->template
		->set_layout('users')
		->build('timeline',isset($data) ? $data : NULL);
	}

	function delete_item(){
		if ($this->input->post() ){
					$item_id = $this->input->post('item', TRUE);
					$estimate = $this->input->post('estimate', TRUE);
					$this->db->where('item_id',$item_id)->delete('estimate_items');

					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', lang('item_deleted_successfully'));
					redirect('estimates/manage/details/'.$estimate);
		}else{
			$data['item_id'] = $this->uri->segment(4);
			$data['estimate'] = $this->uri->segment(5);
			$this->load->view('modal/delete_item',$data);
		}
		
	}

	function _log_activity($est_id,$activity,$icon){
			$this->db->set('module', 'estimates');
			$this->db->set('module_field_id', $est_id);
			$this->db->set('user', $this->tank_auth->get_user_id());
			$this->db->set('activity', $activity);
			$this->db->set('icon', $icon);
			$this->db->insert('activities'); 
	}

}

/* End of file manage.php */