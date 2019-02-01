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


class Tasks extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('project_model','project');
	}
	function edit()
	{		
		if ($this->input->post()) {
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('task_name', 'Task Name', 'required');
		$this->form_validation->set_rules('project', 'Project', 'required');
		$this->form_validation->set_rules('progress', 'Progress', 'required');
		$this->form_validation->set_rules('assigned_to', 'Assigned to', 'required');

		$project = $this->input->post('project', TRUE);
		$task_id = $this->input->post('task_id', TRUE);
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('task_update_failed'));
				redirect('projects/view/details/'.$project);
		}else{
		if ($this->input->post('visible') == 'on') { $visible = 'Yes'; } else { $visible = 'No'; }
		$assign = $this->input->post('assigned_to');
		$this->db->where('task_assigned',$task_id)->delete('assign_tasks');
		foreach ($assign as $key => $value) {				
				$this->db->set('assigned_user',$value);
				$this->db->set('project_assigned',$project);
				$this->db->set('task_assigned',$task_id);
				$this->db->insert('assign_tasks');				
			}
			$assigned_to = serialize($this->input->post('assigned_to'));
			$form_data = array(
			                'task_name' => $this->input->post('task_name'),
			                'project' => $this->input->post('project'),
			                'assigned_to' => $assigned_to,
			                'visible' => $visible,
			                'task_progress' => $this->input->post('progress'),
			                'description' => $this->input->post('description'),
			                'estimated_hours' => $this->input->post('estimate'),
			            );
			$this->db->where('t_id',$task_id)->update('tasks', $form_data); 
			
			$this->_assigned_notification($project,$this->input->post('task_name'),$assigned_to); 
			//send notification to assigned user

			$activity = 'Edited a task '.$this->input->post('task_name');
			$this->_log_activity($project,$activity,$icon='fa-tasks'); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('task_update_success'));
			redirect('projects/view/details/'.$project);
		}
	}else{
		$data['assign_to'] = $this->applib->get_project_details($this->uri->segment(5),'assign_to');
		$data['task_details'] = $this->project->task_details($this->uri->segment(4));
		$this->load->view('modal/edit_task',isset($data) ? $data : NULL);
	}
}
	function add()
	{		
		if ($this->input->post()) {
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('task_name', 'Task Name', 'required');
		$this->form_validation->set_rules('project', 'Project', 'required');
		$this->form_validation->set_rules('progress', 'progress', 'required');

		$project = $this->input->post('project', TRUE);
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('task_add_failed'));
				redirect('projects/view/details/'.$project);
		}else{
		if ($this->input->post('visible') == 'on') { $visible = 'Yes'; } else { $visible = 'No'; }	
		$assign = $this->input->post('assigned_to');	
		$assigned_to = 	serialize($this->input->post('assigned_to'));
			$form_data = array(
			                'task_name' => $this->input->post('task_name'),
			                'project' => $this->input->post('project'),
			                'assigned_to' => $assigned_to,
			                'visible' => $visible,
			                'task_progress' => $this->input->post('progress'),
			                'description' => $this->input->post('description'),
			                'estimated_hours' => $this->input->post('estimate'),
			                'added_by' => $this->tank_auth->get_user_id(),
			            );
			$task_id = $this->db->insert('tasks', $form_data); 
					
			foreach ($assign as $key => $value) {				
				$this->db->set('assigned_user',$value);
				$this->db->set('project_assigned',$project);
				$this->db->set('task_assigned',$task_id);
				$this->db->insert('assign_tasks');				
			}

			$this->_assigned_notification($project,$this->input->post('task_name'),$assigned_to); 
			//send notification to assigned user

			$activity = 'Added a task '.$this->input->post('task_name');
			$this->_log_activity($project,$activity,$icon='fa-tasks'); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('task_add_success'));
			redirect('projects/view/details/'.$project);
		}
	}else{
		$data['assign_to'] = $this->applib->get_project_details($this->uri->segment(4),'assign_to');
		$this->load->view('modal/add_task',isset($data) ? $data : NULL);
	}
}
	function add_from_template()
	{		
		if ($this->input->post()) {
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('project', 'Project', 'required');

		$project = $this->input->post('project', TRUE);
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('task_add_failed'));
				redirect('projects/view/details/'.$project);
		}else{
			$template_id = $this->input->post('template_id', TRUE);
			$template_details = $this->project->get_template_details($template_id);
			foreach ($template_details as $key => $task) {
				$task_name = $task->task_name;
				$task_desc = $task->task_desc;
				$visible = $task->visible;
				$estimate = $task->estimate_hours?$task->estimate_hours:0;
			}
			$assigned_to = $this->user_profile->get_project_details($project,'assign_to');
			$form_data = array(
			                'task_name' => $task_name,
			                'project' => $project,
			                'assigned_to' => $assigned_to,
			                'visible' => $visible,
			                'task_progress' => 0,
			                'description' => $task_desc,
			                'estimated_hours' => $estimate,
			                'added_by' => $this->tank_auth->get_user_id(),
			            );
			$this->db->insert('tasks', $form_data); 

			$this->_assigned_notification($project,$this->input->post('task_name'),$assigned_to); 
			//send notification to assigned user

			$activity = 'Added a task '.$this->input->post('task_name');
			$this->_log_activity($project,$activity,$icon='fa-tasks'); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('task_add_success'));
			redirect('projects/view/details/'.$project);
		}
	}else{
		$data['saved_tasks'] = $this->project->saved_tasks();
		$this->load->view('modal/task_from_templates',isset($data) ? $data : NULL);
	}
	}
	function tracking()
	{
		$action = ucfirst($this->uri->segment(4));
		$project = $this->uri->segment(5);
		$task = $this->uri->segment(6);
		if ($action == 'Off') {			
			$task_start =  $this->project->get_task_start($task); //task start time
			$task_logged_time =  $this->project->get_task_logged_time($task); 
			$time_logged = (time() - $task_start) + $task_logged_time; //time already logged

			$this->db->set('timer_status', $action);
			$this->db->set('logged_time', $time_logged);
			$this->db->set('start_time', '');
			$this->db->where('t_id',$task)->update('tasks');
			$this->_log_timesheet($project,$task,$task_start,time()); //log activity

		}else{
			$this->db->set('timer_status', $action);
			$this->db->set('start_time', time());
			$this->db->where('t_id',$task)->update('tasks');
		}
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('operation_successful'));
			redirect('projects/view/details/'.$project);
	}
	function timesheet()
	{		
		$data['timesheets'] = $this->project->timesheets($this->uri->segment(4));
		$this->load->view('tabs/timesheets',isset($data) ? $data : NULL);
	}
	function tasks()
	{		
		$data['project_tasks'] = $this->project->project_tasks($this->uri->segment(4));
		$this->load->view('tabs/tasks',isset($data) ? $data : NULL);
	}
	function delete()
	{
		if ($this->input->post()) {
			$project = $this->input->post('project', TRUE);
		$this->load->library('form_validation');
		$this->form_validation->set_rules('task_id', 'Task ID', 'required');
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('projects/view/details/'.$project);
		}else{	
		$task = $this->input->post('task_id');

			$this->db->delete('tasks', array('t_id' => $task)); 
			$this->db->delete('tasks_timer', array('task' => $task)); 

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('operation_successful'));
			redirect('projects/view/details/'.$project);
		}
		}else{
			$data['task_id'] = $this->uri->segment(4);
			$data['project'] = $this->uri->segment(5);
			$this->load->view('modal/delete_task',$data);
		}
	}
	function pilot(){
		if ($this->uri->segment(4) == 'on') {
			$status = 'TRUE';
		}else{
			$status = 'FALSE';
		}
			$task = $this->uri->segment(5);
			$project = $this->uri->segment(6)/8600;

			$this->db->set('auto_progress', $status);
			$this->db->where('t_id',$task)->update('tasks');

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('progress_auto_calculated'));
			redirect('projects/view/details/'.$project);
	}

	function _assigned_notification($project,$task_name,$assigned_to){
			$project_title = $this->user_profile->get_project_details($project,'project_title');

			$assigned_by = $this->tank_auth->get_username();

			$data['project_title'] = $project_title;
			$data['assigned_by'] = $assigned_by;
			$data['task_name'] = $task_name;
			if (!empty($assigned_to)) {
				 foreach (unserialize($assigned_to) as $value) { 
			$params['recipient'] = $this->user_profile->get_user_details($value,'email');

			$params['subject'] = '[ '.$this->config->item('company_name').' ]'.' New task assigned by '.$assigned_by;
			$params['message'] = $this->load->view('email/assigned_notification',$data,TRUE);

			$params['attached_file'] = '';

			modules::run('fomailer/send_email',$params);
		} }
	}
	function _log_timesheet($project,$task,$start_time,$end_time){
			$this->db->set('pro_id', $project);
			$this->db->set('task', $task);
			$this->db->set('start_time', $start_time);
			$this->db->set('end_time', $end_time);
			$this->db->insert('tasks_timer'); 
	}

	function _log_activity($project,$activity,$icon){
			$this->db->set('module', 'projects');
			$this->db->set('module_field_id', $project);
			$this->db->set('user', $this->tank_auth->get_user_id());
			$this->db->set('activity', $activity);
			$this->db->set('icon', $icon);
			$this->db->insert('activities'); 
	}
}

/* End of file tasks.php */