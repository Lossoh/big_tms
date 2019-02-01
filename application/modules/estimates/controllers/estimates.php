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


class Estimates extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('estimates_model','estimate');
	}

	function index()
	{
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title(lang('estimates').' - '.$this->config->item('company_name'). ' '. $this->config->item('version'));
	$data['page'] = lang('estimates');
	$data['estimates'] = $this->AppModel->get_all_records($table = 'estimates',
		$array = array(
			'est_deleted' => 'No'
			),
		$join_table = '',$join_criteria = '','date_saved');
	$this->template
	->set_layout('users')
	->build('estimates',isset($data) ? $data : NULL);
	}

	function search()
	{
		if ($this->input->post()) {
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title(lang('estimates').' - '.$this->config->item('company_name'). ' '. $this->config->item('version'));
	$data['page'] = lang('estimates');
	$keyword = $this->input->post('keyword', TRUE);
	$data['estimates'] = $this->estimate->search_estimate($keyword);
	$this->template
	->set_layout('users')
	->build('estimates',isset($data) ? $data : NULL);
		}else{
			redirect('estimates');
		}
	}
}

/* End of file estimates.php */