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


class View extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('project_model','project');
	}
	function details()
	{		
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('projects').' - '.$this->config->item('company_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('projects');
		$data['project_details'] = $this->project->project_details($this->uri->segment(4));
		$data['project_comments'] = $this->project->project_comments($this->uri->segment(4));
		$this->template
		->set_layout('users')
		->build('project_details',isset($data) ? $data : NULL);
	}
	function add()
	{
		if ($this->input->post()) {
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('project_code', 'Project Code', 'required');
		$this->form_validation->set_rules('project_title', 'Project Title', 'required');
		$this->form_validation->set_rules('client', 'Client', 'required');
		$this->form_validation->set_rules('start_date', 'Start Date', 'required');
		$this->form_validation->set_rules('due_date', 'Due Date', 'required');
		$this->form_validation->set_rules('assign_to', 'Assigned To', 'required');
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				$_POST = '';
				$this->add('add');
		}else{		
		if ($this->input->post('fixed_rate') == 'on') { $fixed_rate = 'Yes'; } else { $fixed_rate = 'No'; }
			$_POST['assign_to'] = serialize($this->input->post('assign_to'));
			$project_id = $this->AppModel->insert('projects',$_POST);
			// Set Fixed Rate
			$data = array('fixed_rate' => $fixed_rate); 
			$this->db->where('project_id', $project_id)->update('projects', $data);

			$activity = ucfirst($this->tank_auth->get_username()).' created a project #'.$this->input->post('project_code');
			$this->_log_activity($project_id,$activity); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('project_added_successfully'));
			redirect('projects/view/details/'.$project_id);
		}
		}else{
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('projects').' - '.$this->config->item('company_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('projects');
		$data['form'] = TRUE;
		$data['projects'] = $this->project->get_all_records($table = 'projects',
		$array = array(
			'proj_deleted' => 'No'),$join_table = 'companies',$join_criteria = 'companies.co_id = projects.client','date_created');
		$data['assign_to'] = $this->project->assign_to();
		$data['clients'] = $this->AppModel->get_all_records($table = 'companies',
		$array = array(
			'co_id >' => '0'),$join_table = '',$join_criteria = '','date_added');
		$this->template
		->set_layout('users')
		->build('create_project',isset($data) ? $data : NULL);
		}
	}
	function edit()
	{
		if ($this->input->post()) {
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('project_code', 'Project Code', 'required');
		$this->form_validation->set_rules('project_title', 'Project Title', 'required');
		$this->form_validation->set_rules('client', 'Client', 'required');
		$this->form_validation->set_rules('start_date', 'Start Date', 'required');
		$this->form_validation->set_rules('due_date', 'Due Date', 'required');
		$this->form_validation->set_rules('assign_to', 'Assigned To', 'required');
		$project_id = $this->input->post('project_id');	
		
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				$_POST = '';
				$this->edit($project_id);
		}else{	
			if ($this->input->post('fixed_rate') == 'on') { $fixed_rate = 'Yes'; } else { $fixed_rate = 'No'; }	
			$assign = $this->input->post('assign_to');
			$this->db->where('project_assigned',$project_id)->delete('assign_projects');
			foreach ($assign as $key => $value) {
				
				$this->db->set('assigned_user',$value);
				$this->db->set('project_assigned',$project_id);
				$this->db->insert('assign_projects');				
			}
			$_POST['assign_to'] = serialize($this->input->post('assign_to'));
			$this->AppModel->update('projects',$_POST,$where = array('project_id' => $project_id));
			// Set Fixed Rate
			$data = array('fixed_rate' => $fixed_rate); 
			$this->db->where('project_id', $project_id)->update('projects', $data);

			$activity = ucfirst($this->tank_auth->get_username()).' edited a project #'.$this->input->post('project_code');
			$this->_log_activity($project_id,$activity); //log activity

			if ($this->input->post('progress') == '100') {
				$this->_project_complete($project_id);
			}
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('project_edited_successfully'));
			redirect('projects/view/details/'.$project_id);
		}
		}else{
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('projects').' - '.$this->config->item('company_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('projects');
		$data['form'] = TRUE;
		$data['assign_to'] = $this->project->assign_to();
		$data['clients'] = $this->AppModel->get_all_records($table = 'companies',
		$array = array(
			'co_id >' => '0'),$join_table = '',$join_criteria = '','date_added');
		$data['project_details'] = $this->project->project_details($this->uri->segment(4));
		$data['projects'] = $this->project->get_all_records($table = 'projects',
		$array = array(
			'proj_deleted' => 'No'),$join_table = 'companies',$join_criteria = 'companies.co_id = projects.client','date_created');
		$this->template
		->set_layout('users')
		->build('edit_project',isset($data) ? $data : NULL);
		}
	}

	function _project_complete($project) {
			$client = $this->user_profile->get_project_details($project,'client');
			$client_email = $this->applib->company_details($client,'company_email');
			$data['project_title'] = $this->user_profile->get_project_details($project,'project_title');
			$data['project_code'] = $this->user_profile->get_project_details($project,'project_code');

			$task_time = $this->applib->get_sum('tasks','logged_time',array('project'=>$project));
			$project_time = $this->applib->get_sum('projects','time_logged',array('project_id'=>$project));
			$logged_time = ($task_time + $project_time)/3600;
			$project_hours = round($logged_time, 1);


			$data['project_hours'] = $project_hours;
			$data['client'] = $client_email;
			
			$params['recipient'] = $client_email;

			$params['subject'] = '[ '.$this->config->item('company_name').' ] New Project Submission Received';	
			$params['message'] = $this->load->view('email/project_complete',$data,TRUE);
			
			
			$params['attached_file'] = '';

			modules::run('fomailer/send_email',$params);

	}

	function _log_activity($project_id,$activity){
			$this->db->set('module', 'projects');
			$this->db->set('module_field_id', $project_id);
			$this->db->set('user', $this->tank_auth->get_user_id());
			$this->db->set('activity', $activity);
			$this->db->set('icon', 'fa-coffee');
			$this->db->insert('activities'); 
	}
}

/* End of file view.php */