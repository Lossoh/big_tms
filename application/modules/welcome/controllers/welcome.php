<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MX_Controller {

	function __construct()
	{
		parent::__construct();

	}

	function index()
	{
/* 		$this->load->model('home_model');
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('welcome_to') .'  '.$this->config->item('website_name'));
		$data['page'] = lang('home');
		$this->template
		->set_layout('users')
		->build('user_home',isset($data) ? $data : NULL); */
	}
	
	
}

/* End of file welcome.php */