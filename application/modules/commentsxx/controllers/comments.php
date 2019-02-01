<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comments extends MX_Controller {

	function __construct()
	{
		parent::__construct();
				
	}

	function index()
	{
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('welcome_to').'  '.$this->config->item('website_name'));
		$data['page'] = lang('comments');

		$data['case_lists'] =$this->AppModel->get_all_records($table = 'lg_comments',$array = array('deleted' => 0),$join_table = '',$join_criteria = '','case_description');	
		
		$this->template
		->set_layout('users')
		->build('comments',isset($data) ? $data : NULL);
	}

	
	

}
