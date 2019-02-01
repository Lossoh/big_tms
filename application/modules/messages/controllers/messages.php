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


class Messages extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('msg_model');
	}

	function index()
	{
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title(lang('messages').' - '.$this->config->item('company_name'). ' '. $this->config->item('version'));
	$data['page'] = lang('messages');
	$data['messages'] = $this->msg_model->get_all_records($table = 'messages',
		$array = array(
			'user_to'=>$this->tank_auth->get_user_id(),'deleted' => 'No'),$join_table = 'users',$join_criteria = 'users.id = messages.user_from','date_received');
	$data['users'] = $this->msg_model->group_messages_by_users($this->tank_auth->get_user_id());
	$this->template
	->set_layout('users')
	->build('messages',isset($data) ? $data : NULL);
	}
	function search()
	{
		if ($this->input->post()) {
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title(lang('messages').' - '.$this->config->item('company_name'). ' '. $this->config->item('version'));
	$data['page'] = lang('messages');
	$keyword = $this->input->post('keyword', TRUE);
	$data['messages'] = $this->msg_model->search_message($keyword);
	$data['users'] = $this->msg_model->group_messages_by_users($this->tank_auth->get_user_id());
	$this->template
	->set_layout('users')
	->build('messages',isset($data) ? $data : NULL);
			
		}else{
			redirect('messages');
		}
	
	}
}

/* End of file messages.php */