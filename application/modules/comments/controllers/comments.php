<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Comments extends MX_Controller {

	function __construct()
	{
		parent::__construct();

		$menu_code=
		$this->load->model('comment_model', 'comments');
	}

	function index()
	{
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('comments').' - '.$this->config->item('comp_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('comments');
		$data['form'] = TRUE;
		$data['datatables'] = TRUE;	
		$data['case_lists'] = $this->comments->get_all_records($table = 'lg_comments', $array = array('deleted' => 0, 'activated' => 1), $join_table = '',$join_criteria = '','case_description');
		
		$data['case_all_lists'] = $this->comments->get_all_records($table = 'lg_comments', $array = array('deleted' => 0),'', '','case_description');
		$data['comment_created'] = $this->session->userdata('comment_created');
		$data['comment_updated'] = $this->session->userdata('comment_updated');
		$data['comment_deleted'] = $this->session->userdata('comment_deleted');
		$data['comment_viewed'] = $this->session->userdata('comment_viewed');
		$data['comment_activated'] = $this->session->userdata('comment_activated');

		$this->template
		->set_layout('users')
		->build('comments',isset($data) ? $data : NULL);
	}


	function comment()
	{
		if ($this->input->post()) {
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('comment', 'Comment', 'required');
		$case_rowID=$this->input->post('comments_rowID');
		
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('comment').lang('failed'));
				redirect('comments/view/details/'.$this->input->get('lg_comments',TRUE));
		}else{			
			$form_data = array(
			                'comment_rowID' => $case_rowID,
			                'user_created' => $this->tank_auth->get_user_id(),
			                'reply_message' => $this->input->post('comment'),
							'user_created'	=>	$this->session->userdata('user_rowID'),
							'date_created'	=>	date('Y-m-d'),
							'time_created'	=>	date('H:i:s'),	
			            );
			$this->db->insert('lg_comment_replies', $form_data);
			$rowID = $this->db->insert_id();			
			$activity = "Added a comment to a case ". $rowID;
			$this->_log_case_activity($case_rowID,$activity,$icon = 'fa-comment'); //log activity
			///$this->_comment_notification($this->uri->segment(4));

			
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('comment').lang('submitted_successfully'));
			redirect('comments/view/details/'.$case_rowID);
			}
		}else{
		redirect('comments');
		}
	}


	function _log_case_activity($comment_rowID,$activity,$icon){
			$this->db->set('module', 'case');
			$this->db->set('module_field_id', $comment_rowID);
			$this->db->set('user_rowID', $this->tank_auth->get_user_id());
			$this->db->set('activity', $activity);
			$this->db->set('icon', $icon);
			$this->db->insert('activities'); 
	}
}

/* End of file bugs.php */