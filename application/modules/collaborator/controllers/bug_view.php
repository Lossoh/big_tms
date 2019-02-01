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


class Bug_view extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('tank_auth');
		
		$this->load->model('bugs/bugs_model');
	}
	function details()
	{		
		if($this->_bug_access($this->uri->segment(4))){
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('bug_tracking').' - '.$this->config->item('company_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('bug_tracking');
		$data['bugs'] = $this->bugs_model->bugs();
		$data['bug_details'] = $this->bugs_model->bug_details($this->uri->segment(4));
		$data['bug_activities'] = $this->bugs_model->bug_activities($this->uri->segment(4));
		$data['bug_comments'] = $this->bugs_model->bug_comments($this->uri->segment(4));
		$this->template
		->set_layout('users')
		->build('bugs/bug_details',isset($data) ? $data : NULL);
		}else{
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message', lang('project_access_denied'));
			redirect('collaborator/bugs');
		}
	}
	function add()
	{
		if ($this->input->post()) {
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('issue_ref', 'Issue Ref', 'required');
		$this->form_validation->set_rules('project', 'Project', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('issue_not_submitted'));
				redirect('collaborator/bugs');
		}else{			
			$form_data = array(
			                'issue_ref' => $this->input->post('issue_ref'),
			                'project' => $this->input->post('project'),
			                'reporter' => $this->tank_auth->get_user_id(),
			                'assigned_to' => $this->tank_auth->get_user_id(),
			                'bug_status' => 'Unconfirmed',
			                'priority' => $this->input->post('priority'),
			                'bug_description' => $this->input->post('description'),
			                'last_modified' => date("Y-m-d H:i:s"),
			            );
			$this->db->insert('bugs', $form_data); 
			$bug_id = $this->db->insert_id();
			$activity = 'Created an Issue #'.$this->input->post('issue_ref');
			$this->_log_bug_activity($bug_id,$activity,$icon = 'fa-plus'); //log activity

			$this->_bug_notification($assigned_to);
			
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('issue_submitted_successfully'));
			redirect('collaborator/bugs');
		}
		}else{
			$data['projects'] = $this->bugs_model->projects();
		$this->load->view('bugs/add_bug',$data);
		}
	}
	function edit()
	{
		if ($this->input->post()) {
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('issue_ref', 'Issue Ref', 'required');
		$this->form_validation->set_rules('project', 'Project', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('issue_not_edited'));
				redirect('collaborator/bugs');
		}else{	
		$bug_id	 =  $this->input->post('bug_id');
			$form_data = array(
			                'issue_ref' => $this->input->post('issue_ref'),
			                'project' => $this->input->post('project'),
			                'priority' => $this->input->post('priority'),
			                'bug_description' => $this->input->post('description'),
			                'last_modified' => date("Y-m-d H:i:s"),
			            );
			$this->db->where('bug_id',$bug_id)->update('bugs', $form_data); 
			$activity = 'Edited an Issue #'.$this->input->post('issue_ref');
			$this->_log_bug_activity($bug_id,$activity,$icon = 'fa-edit'); //log activity
			$this->_bug_notification($this->tank_auth->get_user_id());

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('issue_edited_successfully'));
			redirect('collaborator/bug_view/details/'.$bug_id);
		}
		}else{
		$data['projects'] = $this->bugs_model->projects();
		$data['bug_details'] = $this->bugs_model->bug_details($this->uri->segment(4));
		$this->load->view('bugs/edit_bug',$data);
		}
	}

	function _bug_access($bug){
		$bug_details = $this->bugs_model->bug_details($bug);
		foreach ($bug_details as $key => $bug) {
			$bug_project = $bug->project;
			$bug_assigned = $bug->assigned_to;
		}
		$user = $this->tank_auth->get_user_id();
		if ($bug_assigned == $user) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function _bug_notification($assigned_to){
			
			$added_by = $this->tank_auth->get_username();
			$data['project_manager'] = $this->user_profile->get_user_details($assigned_to,'username');
			$data['added_by'] = $added_by;

			$params['recipient'] = $this->user_profile->get_user_details($assigned_to,'email');

			$params['subject'] = '[ '.$this->config->item('company_name').' ]'.' New Bug Reported';
			$params['message'] = $this->load->view('emails/bug_notification',$data,TRUE);

			$params['attached_file'] = '';

			modules::run('fomailer/send_email',$params);
	}

	function _log_bug_activity($bug_id,$activity,$icon){
			$this->db->set('module', 'bugs');
			$this->db->set('module_field_id', $bug_id);
			$this->db->set('user', $this->tank_auth->get_user_id());
			$this->db->set('activity', $activity);
			$this->db->set('icon', $icon);
			$this->db->insert('activities'); 
	}
}

/* End of file bug_view.php */