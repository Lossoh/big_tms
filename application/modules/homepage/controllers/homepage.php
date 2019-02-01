<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Homepage extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('homepage_model');
        
	}

	function index()
	{
        $this->session->set_userdata(array('role_rowID'	=> $this->session->userdata('role_rowID_verify')));
        
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('welcome_to').'  '.$this->config->item('website_name'));
		$data['page'] = lang('home');
        $data['jo_total'] = count($this->homepage_model->get_data_jo());
        $data['ca_total'] = count($this->homepage_model->get_data_ca());
        $data['realization_total'] = count($this->homepage_model->get_data_realization_ca());
        $data['unverified_total'] = count($this->homepage_model->get_data_document_unverified());
		
    	$this->session->unset_userdata('page_header');		
    	$this->session->unset_userdata('page_detail');
   		
        $this->template->set_layout('users')->build('homepage',isset($data) ? $data : NULL);
        
	}
    
}
