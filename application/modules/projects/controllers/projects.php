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


class Projects extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('project_model');
	}

	function index()
	{
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title(lang('projects').' - '.$this->config->item('company_name'). ' '. $this->config->item('version'));
	$data['page'] = lang('projects');
	$data['projects'] = $this->project_model->get_all_records($table = 'projects',
		$array = array(
			'proj_deleted' => 'No'),$join_table = 'companies',$join_criteria = 'companies.co_id = projects.client','date_created');
	$this->template
	->set_layout('users')
	->build('projects',isset($data) ? $data : NULL);
	}

	function search()
	{
	if ($this->input->post()) {
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title(lang('projects').' - '.$this->config->item('company_name'). ' '. $this->config->item('version'));
	$data['page'] = lang('projects');
	$keyword = $this->input->post('keyword', TRUE);
	$data['projects'] = $this->project_model->search_project($keyword);
	$this->template
	->set_layout('users')
	->build('projects',isset($data) ? $data : NULL);
	}else{
			redirect('projects/view_projects/all');
		}
	}

	function view_projects()
	{
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title(lang('projects').' - '.$this->config->item('company_name'). ' '. $this->config->item('version'));
	$data['page'] = lang('projects');
	$data['projects'] = $this->project_model->get_all_records($table = 'projects',
		$array = array(
			'proj_deleted' => 'No'),$join_table = 'companies',$join_criteria = 'companies.co_id = projects.client','date_created');
	$this->template
	->set_layout('users')
	->build('projects',isset($data) ? $data : NULL);
	}
	function comment()
	{
		if ($this->input->post()) {
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('comment', 'Comment', 'required');
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('comment_failed'));
				redirect('projects/view/details/'.$this->input->get('project',TRUE));
		}else{		
		$project_id = $this->input->post('project_id');	
			$form_data = array(
			                'project' => $project_id,
			                'posted_by' => $this->tank_auth->get_user_id(),
			                'message' => $this->input->post('comment')
			            );
			$this->db->insert('comments', $form_data); 
			$activity = 'Added a comment to Project #'.$this->input->post('project_code');
			$this->_log_activity($project_id,$activity,$icon='fa-comment'); //log activity

			$this->_comment_notification($project_id); //send notification to the administrator

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('comment_successful'));
			redirect('projects/view/details/'.$this->input->get('project',TRUE));
			}
		}else{
		redirect('projects/view_projects/all');
		}
	}
	function replies()
	{
		if ($this->input->post()) {
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('message', 'Message', 'required');
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('comment_failed'));
				redirect('projects/view/details/'.$this->input->post('project',TRUE));
		}else{		
		$project_id = $this->input->post('project');	
			$form_data = array(
			                'parent_comment' => $this->input->post('comment', TRUE),
			                'reply_msg' => $this->input->post('message'),
			                'replied_by' => $this->tank_auth->get_user_id()
			            );
			$this->db->insert('comment_replies', $form_data); 

			$this->_comment_notification($project_id); //send notification to the administrator

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('comment_replied_successful'));
			redirect('projects/view/details/'.$this->input->post('project',TRUE));
			}
		}else{
		$data['comment'] = $this->input->get('c', TRUE);
		$data['project'] = $this->input->get('p', TRUE);
		$this->load->view('modal/comment_reply',isset($data) ? $data : NULL);
		}
	}
	function tracking()
	{
		$action = ucfirst($this->uri->segment(3));
		$project = $this->uri->segment(4);
		$timer_msg = '';
		if ($action == 'Off') {			
			$project_start =  $this->project_model->get_project_start($project); //project start time
			$project_logged_time =  $this->project_model->get_project_logged_time($project); 
			$time_logged = (time() - $project_start) + $project_logged_time; //time already logged

			$this->db->set('timer', $action);
			$this->db->set('time_logged', $time_logged);
			$this->db->set('timer_start', '');
			$this->db->where('project_id',$project)->update('projects');
			$this->_log_timesheet($project,$project_start,time()); //log activity
			$timer_msg = 'timer_stopped_success';

		}else{
			$this->db->set('timer', $action);
			$this->db->set('timer_start', time());
			$this->db->where('project_id',$project)->update('projects');
			$timer_msg = 'timer_started_success';
		}
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang($timer_msg));
			redirect('projects/view/details/'.$project);
	}
	function delete()
	{
		if ($this->input->post()) {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('project_id', 'Project ID', 'required');
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('delete_failed'));
				redirect('projects/view_projects/all');
		}else{	
		$project_id = $this->input->post('project_id');

			$this->db->delete('projects', array('project_id' => $this->input->post('project_id'))); 
			$this->db->delete('comments', array('project' => $this->input->post('project_id'))); 
			$this->db->delete('activities', array('module' => 'projects','module_field_id' => $this->input->post('project_id'))); 
			$this->db->delete('project_timer', array('project' => $this->input->post('project_id'))); 
			$this->db->delete('tasks', array('project' => $this->input->post('project_id'))); 
			$this->db->delete('tasks_timer', array('pro_id' => $this->input->post('project_id'))); 
			$this->db->delete('bugs', array('project' => $this->input->post('project_id'))); 
			// Delete project files
			$files = $this->project_model->project_files($this->input->post('project_id'));
			foreach ($files as $key => $f) {
				unlink('./resource/project-files/'.$f->file_name);
			}

			$this->db->delete('files', array('project' => $project_id)); 
			// Log Activity
			$activity = 'Deleted Project #'.$this->input->post('project_id').' from the system';
			$this->_log_activity($project_id,$activity,$icon = 'fa-times'); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('project_deleted_successfully'));
			redirect('projects/view_projects/all');
		}
		}else{
			$data['project_id'] = $this->uri->segment(3);
			$this->load->view('modal/delete_project',$data);
		}
	}
	function delcomment()
	{
		if ($this->input->post()) {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('comment', 'Comment ID', 'required');
		$this->form_validation->set_rules('project', 'Project ID', 'required');
		$project_id = $this->input->post('project', TRUE);
		$comment_id = $this->input->post('comment', TRUE);

		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('comment_delete_failed'));
				redirect('projects/view/details/'.$project_id);
		}else{	
		$this->db->delete('comments', array('comment_id' => $comment_id)); 		
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('comment_deleted'));
			redirect('projects/view/details/'.$project_id);
			}
		}else{
			$data['comment_id'] = $this->input->get('c', TRUE);
			$data['project_id'] = $this->input->get('p', TRUE);
			$this->load->view('modal/delete_comment',$data);
		}
	}
	function timelog()
	{		
		if ($this->input->post()) {
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('logged_time', 'Logged Time', 'required');

		$project = $this->input->post('project', TRUE);

		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('time_entered_failed'));
				redirect('projects/view/details/'.$project);
		}else{	
			$project_logged_time =  $this->project_model->get_project_logged_time($project); 
			$time_logged = $project_logged_time + ($this->input->post('logged_time', TRUE) *3600); //time already logged

			$this->db->set('time_logged', $time_logged);
			$this->db->where('project_id',$project)->update('projects'); 
		}

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('time_entered_success'));
			redirect('projects/view/details/'.$project);
	}else{
		$data['logged_time'] =  $this->project_model->get_project_logged_time($this->uri->segment(3)/8600); 
		$data['project_details'] = $this->project_model->project_details($this->uri->segment(3)/8600);
		$this->load->view('modal/time_entry',isset($data) ? $data : NULL);
		}
	}

	function _comment_notification($project){
			$project_title = $this->user_profile->get_project_details($project,'project_title');
			$project_manager = $this->user_profile->get_project_details($project,'assign_to');

			$posted_by = $this->user_profile->get_user_details($this->tank_auth->get_user_id(),'username');
			$data['project_title'] = $project_title;
			$data['posted_by'] = $posted_by;

			$params['recipient'] = $this->user_profile->get_user_details($project_manager,'email');

			$params['subject'] = '[ '.$this->config->item('company_name').' ]'.' New comment received from '.$posted_by;
			$params['message'] = $this->load->view('email/comment_notification',$data,TRUE); 

			$params['attached_file'] = '';

			modules::run('fomailer/send_email',$params);
	}

	function pilot(){
		if ($this->uri->segment(3) == 'on') {
			$status = 'TRUE';
		}else{
			$status = 'FALSE';
		}
			$project = $this->uri->segment(4)/8600;

			$this->db->set('auto_progress', $status);
			$this->db->where('project_id',$project)->update('projects');

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('progress_auto_calculated'));
			redirect('projects/view/details/'.$project);
	}

	function _log_activity($project_id,$activity,$icon){
			$this->db->set('module', 'projects');
			$this->db->set('module_field_id', $project_id);
			$this->db->set('user', $this->tank_auth->get_user_id());
			$this->db->set('activity', $activity);
			$this->db->set('icon', $icon);
			$this->db->insert('activities'); 
	}
	function _log_timesheet($project,$start_time,$end_time){
			$this->db->set('project', $project);
			$this->db->set('start_time', $start_time);
			$this->db->set('end_time', $end_time);
			$this->db->insert('project_timer'); 
	}
}

/* End of file projects.php */