<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('comment_model','comments');
	}
	
	function details()
	{		
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('case_tracking').' - '.$this->config->item('comp_name'). ' '. $this->config->item('version'));		
		$data['page'] = lang('case_tracking');		
		$data['case_lists'] = $this->comments->get_all_records($table = 'lg_comments', $array = array('deleted' => 0, 'activated' => 1),$join_table = '',$join_criteria = '','case_description');
		$data['case_comments'] = $this->uri->segment(4);	
		$data['comments_messages'] = $this->comments->case_comments($this->uri->segment(4));
		$data['active'] = $this->comments->get_value($table = 'lg_comments',$array = array('rowID' => $this->uri->segment(4) ),'activated');

		$data['comment_viewed'] = $this->session->userdata('comment_viewed');	
		$data['comment_replied'] = $this->session->userdata('comment_replied');
		
		$this->template
		->set_layout('users')
		->build('comment_details',isset($data) ? $data : NULL);
	}		
	
	function get_comments_more(){
	    $comment_rowID=$this->input->post('comment_rowID');
		$rowID=$this->input->post('rowID');
		
		$data['case_comments_more'] = $this->comments->case_comments_more($comment_rowID,$rowID); 
		
		if($data['case_comments_more']){
			$this->load->view('ajax_comments_more',isset($data) ? $data : NULL);
		}
		 
	}
	
	function add()
	{
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
			$this->form_validation->set_rules('case_description', 'Case Description', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('case').lang('not_submitted_successfully'));
				redirect('comments');
			}else{			
				$form_data = array(
								'case_description' => $this->input->post('case_description'),
								'activated' => 1,
								'user_created'	=>	$this->session->userdata('user_rowID'),
								'date_created'	=>	date('Y-m-d'),
								'time_created'	=>	date('H:i:s'),							
							);
				$this->db->insert('lg_comments', $form_data); 
				$rowID = $this->db->insert_id();
				$activity = 'Created an Case #'.$this->input->post('case_description');
				$this->_log_case_activity($rowID,$activity,$icon = 'fa-plus'); //log activity

				$this->session->set_flashdata('response_status', 'success');
				$this->session->set_flashdata('message', lang('case').lang('submitted_successfully'));
				redirect('comments/view/details/'.$rowID);
			}
		}else{

			$this->load->view('modal/add_case');
		}
	}
	
	function inactivated()
	{	
		
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
			$this->form_validation->set_rules('rowID', 'Case Row ID', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('inactivated').lang('not_submitted_successfully'));
				redirect('comments');
			}else{		
				$rowID=$this->input->post('rowID');
				$form_data = array(
								'activated' => 0,
								'user_modified'	=>	$this->session->userdata('user_rowID'),
								'date_modified'	=>	date('Y-m-d'),
								'time_modified'	=>	date('H:i:s'),							
							);
				$this->db->where('rowID',$rowID)->update('lg_comments', $form_data); 
				$activity = 'Modified an In-Activated #'.$rowID;
				$this->_log_case_activity($rowID,$activity,$icon = 'fa fa-eye-slash'); //log activity

				$this->session->set_flashdata('response_status', 'success');
				$this->session->set_flashdata('message', lang('inactivated').lang('submitted_successfully'));
				redirect('comments');
			}
		}else{
			$data['rowID'] = $this->uri->segment(4);
			$this->load->view('modal/inactivated', $data);
		}
	}

	function activated()
	{	
		
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
			$this->form_validation->set_rules('rowID', 'Case Row ID', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('activated').lang('not_submitted_successfully'));
				redirect('comments');
			}else{		
				$rowID=$this->input->post('rowID');
				$form_data = array(
								'activated' => 1,
								'user_modified'	=>	$this->session->userdata('user_rowID'),
								'date_modified'	=>	date('Y-m-d'),
								'time_modified'	=>	date('H:i:s'),							
							);
				$this->db->where('rowID',$rowID)->update('lg_comments', $form_data); 
				$activity = 'Modified an Activated #'.$rowID;
				$this->_log_case_activity($rowID,$activity,$icon = 'fa fa-eye'); //log activity

				$this->session->set_flashdata('response_status', 'success');
				$this->session->set_flashdata('message', lang('activated').lang('submitted_successfully'));
				redirect('comments/view/details/'.$rowID);
			}
		}else{
			$data['rowID'] = $this->uri->segment(4);
			$this->load->view('modal/activated', $data);
		}
	}

	function delete()
	{	
		
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
			$this->form_validation->set_rules('rowID', 'Case Row ID', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('case').lang('not_deleted_successfully'));
				redirect('comments');
			}else{		
				$rowID=$this->input->post('rowID');
				$form_data = array(
								'deleted' => 1,
								'user_deleted'	=>	$this->session->userdata('user_rowID'),
								'date_deleted'	=>	date('Y-m-d'),
								'time_deleted'	=>	date('H:i:s'),							
							);
				$this->db->where('rowID',$rowID)->update('lg_comments', $form_data); 
				$activity = 'Deleted an Case #'.$rowID;
				$this->_log_case_activity($rowID,$activity,$icon = 'fa fa-trash-o'); //log activity

				$this->session->set_flashdata('response_status', 'success');
				$this->session->set_flashdata('message', lang('case').lang('deleted_successfully'));
				redirect('comments');
			}
		}else{
			
			$data['case_details'] = $this->comments->get_all_records($table = 'lg_comments', $array = array('deleted' => 0, 'rowID' => $this->uri->segment(4)),$join_table = '',$join_criteria = '','rowID');
			$this->load->view('modal/delete', $data);
		}
	}	
	
	function edit()
	{	
		
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
			$this->form_validation->set_rules('rowID', 'Case Row ID', 'required');
			$this->form_validation->set_rules('case_description', 'Case Description', 'required');
			
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('case').lang('not_edited_successfully'));
				redirect('comments');
			}else{		
				$rowID=$this->input->post('rowID');
				
				$form_data = array(
								'case_description' => $this->input->post('case_description'),
								'user_modified'	=>	$this->session->userdata('user_rowID'),
								'date_modified'	=>	date('Y-m-d'),
								'time_modified'	=>	date('H:i:s'),						
							);
				$this->db->where('rowID',$rowID)->update('lg_comments', $form_data); 
				$activity = 'Edited an Case #'.$rowID;
				$this->_log_case_activity($rowID,$activity,$icon = 'fa fa-pencil-square-o'); //log activity

				$this->session->set_flashdata('response_status', 'success');
				$this->session->set_flashdata('message', lang('case').lang('edited_successfully'));
				redirect('comments');
			}
		}else{
			
			$data['case_details'] = $this->comments->get_all_records($table = 'lg_comments', $array = array('deleted' => 0, 'rowID' => $this->uri->segment(4)),$join_table = '',$join_criteria = '','rowID');
			$this->load->view('modal/edit', $data);
		}
	}

	function _log_case_activity($rowID,$activity,$icon){
			$this->db->set('module', 'case');
			$this->db->set('module_field_id', $rowID);
			$this->db->set('user_rowID', $this->tank_auth->get_user_id());
			$this->db->set('icon', $icon);
			$this->db->set('activity', $activity);
			$this->db->insert('activities'); 
	}
}

/* End of file view.php */