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


class Contacts extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('client_model');
	}

	function index()
	{
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title(lang('clients').' - '.$this->config->item('company_name'). ' '. $this->config->item('version'));
	$data['page'] = lang('clients');
	$data['datatables'] = TRUE;
	$data['users'] = $this->client_model->get_all_records($table = 'users',
		$array = array(
			'activated' => '1'),$join_table = 'account_details',$join_criteria = 'account_details.user_id = users.id','created');
	$data['roles'] = $this->AppModel->get_all_records($table = 'roles',
		$array = array(
			'r_id >' => '0'),$join_table = '',$join_criteria = '','r_id');
	$this->template
	->set_layout('users')
	->build('clients',isset($data) ? $data : NULL);
	}
	function add()
	{
		if ($this->input->post()) {
			redirect('contacts');
		}else{
		$data['company'] = $this->uri->segment(3);
		$this->load->view('modal/add_client',$data);
		}
	}
}

/* End of file contacts.php */