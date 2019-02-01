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


class Bugs extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('tank_auth');
		
		$this->load->model('bugs_model');
	}

	function index()
	{
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title(lang('bug_tracking').' - '.$this->config->item('company_name'). ' '. $this->config->item('version'));
	$data['page'] = lang('bug_tracking');
	$data['bugs'] = $this->bugs_model->bugs();
	$this->template
	->set_layout('users')
	->build('bugs',isset($data) ? $data : NULL);
	}
	function view_by_status($status)
	{
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title(lang('bug_tracking').' - '.$this->config->item('company_name'). ' '. $this->config->item('version'));
	$data['page'] = lang('bug_tracking');
		if ($this->uri->segment(3) == 'unconfirmed') { 
		$status = lang('unconfirmed'); }elseif ($this->uri->segment(3) == 'confirmed') {
		$status = lang('confirmed');  }elseif ($this->uri->segment(3) == 'progress') { 
		$status = lang('in_progress'); }elseif ($this->uri->segment(3) == 'resolved') {
		$status = lang('resolved'); }elseif ($this->uri->segment(3) == 'verified') { 
		$status = lang('verified');  }else{ $status = 'all'; }

	$data['bugs'] = $this->bugs_model->bugs_by_status($status,25,$this->uri->segment(4));
	$this->template
	->set_layout('users')
	->build('bugs',isset($data) ? $data : NULL);
	}
	function search()
	{
		if($this->input->post()){
			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title(lang('bug_tracking').' - '.$this->config->item('company_name'). ' '. $this->config->item('version'));
			$data['page'] = lang('bug_tracking');
			$keyword = $_POST['keyword'];
			$data['bugs'] = $this->bugs_model->bugs_search($keyword,$limit = 20);
			$this->template
			->set_layout('users')
			->build('bugs',isset($data) ? $data : NULL);
		}else{
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message', lang('enter_search_keyword'));
			redirect('bugs');
		}	
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
				redirect('bugs/view/details/'.$this->input->get('bug',TRUE));
		}else{			
			$form_data = array(
			                'bug_id' => $this->input->post('bug'),
			                'comment_by' => $this->tank_auth->get_user_id(),
			                'comment' => $this->input->post('comment')
			            );
			$this->db->insert('bug_comments', $form_data); 
			$activity = "Added a comment to a bug";
			$this->_log_bug_activity($this->input->post('bug'),$activity,$icon = 'fa-comment'); //log activity
			$this->_comment_notification($this->input->post('bug'));

			
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('comment_successful'));
			redirect('bugs/view/details/'.$this->input->get('bug',TRUE));
			}
		}else{
		redirect('bugs/view_by_status/all');
		}
	}
	function mark_status()
	{
		if ($this->input->get('b', TRUE)) {
		$bug = $this->input->get('b');
		$status = $this->input->get('s', TRUE);
		if ($status == 'unconfirmed') {
			$bug_status = 'Unconfirmed'; }elseif ($status == 'confirmed') {
			$bug_status = 'Confirmed';	}elseif ($status == 'progress') {
			$bug_status = 'In Progress'; }elseif ($status == 'resolved') {
			$bug_status = 'Resolved';	}else{
			$bug_status = 'Verified';
		}
			$form_data = array(
			                'bug_status' => $bug_status
			            );
			$this->db->where('bug_id',$bug)->update('bugs', $form_data); 

			$activity = 'Marked Issue #'.$this->input->get('ref').' as '.$bug_status;
			$this->_log_bug_activity($bug,$activity,$icon = 'fa-info'); //log activity
			//send email to the reporter
			$this->_bug_status($bug,$bug_status);

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('issue_marked_successfully'));
			redirect('bugs/view/details/'.$bug);
			}else{
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message', lang('operation_failed'));
			redirect('bugs/view_by_status/all');
		}
	}
	function download(){
		$file_id = $this->input->get('f',TRUE);
		$this->load->helper('download');
		$file = $this->bugs_model->bug_file_name($file_id,$limit = 1);
		$data = file_get_contents('./resource/bug_files/'.$file); // Read the file's contents
		force_download($file, $data);
	}
	function delete()
	{
		if ($this->input->post()) {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('bug_id', 'Bug ID', 'required');
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('delete_failed'));
				redirect('bugs');
		}else{			
			$this->db->delete('bugs', array('bug_id' => $this->input->post('bug_id'))); 
			$this->db->delete('bug_comments', array('bug_id' => $this->input->post('bug_id')));
			$this->db->delete('activities', array('module' => 'bugs','module_field_id' => $this->input->post('bug_id')));
			//delete the files here
			$files = $this->bugs_model->bug_files($this->input->post('bug_id'));
			foreach ($files as $key => $f) {
				unlink('./resource/bug-files/'.$f->file_name);
			}
			$this->db->delete('bug_files', array('bug' => $this->input->post('bug_id'))); 

			$activity = $this->tank_auth->get_username()." deleted a bug";
			$this->_log_bug_activity($this->input->post('bug_id'),$activity,$icon = 'fa-times'); //log activity
			
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('issue_deleted_successfully'));
			redirect('bugs');
		}
		}else{
			$data['bug_id'] = $this->uri->segment(3);
			$this->load->view('modal/delete',$data);
		}
	}

	function _bug_status($bug,$status){

			$bug_details = $this->bugs_model->bug_details($bug);
			foreach ($bug_details as $key => $b) {
				$issue_ref = $b->issue_ref;
				$reporter = $b->reporter;
			}

			$marked_by = $this->user_profile->get_user_details($this->tank_auth->get_user_id(),'username');
			$data['issue_ref'] = $issue_ref;
			$data['status'] = $status;
			$data['marked_by'] = $marked_by;

			$params['recipient'] = $this->user_profile->get_user_details($reporter,'email');

			$params['subject'] = '[ '.$this->config->item('company_name').' ]'.' Bug '.$issue_ref.' marked as '.$status;
			$params['message'] = $this->load->view('emails/bug_status',$data,TRUE);

			$params['attached_file'] = '';

			modules::run('fomailer/send_email',$params);
	}
	

	function _comment_notification($bug){
			$bug_details = $this->bugs_model->bug_details($bug);
			foreach ($bug_details as $key => $b) {
				$issue_ref = $b->issue_ref;
				$reporter = $b->reporter;
			}

			$posted_by = $this->user_profile->get_user_details($this->tank_auth->get_user_id(),'username');
			$data['issue_ref'] = $issue_ref;
			$data['posted_by'] = $posted_by;

			$params['recipient'] = $this->user_profile->get_user_details($reporter,'email');

			$params['subject'] = '[ '.$this->config->item('company_name').' ]'.' New comment received from '.$posted_by;
			$params['message'] = $this->load->view('emails/comment_notification',$data,TRUE); 

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

/* End of file bugs.php */