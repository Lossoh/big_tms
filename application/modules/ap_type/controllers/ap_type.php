<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Ap_type extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('tank_auth');
		
		$this->load->model('ap_type_model');
	}

	function index()
	{
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('ap_types').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('ap_types');
		$this->session->set_userdata('page_header', 'master');		
		$this->session->set_userdata('page_detail', 'ap_types');
		$data['datatables'] = TRUE;
		$data['form'] = TRUE;
		$data['ap_types'] = $this->ap_type_model->get_all_records($table = 'sa_ap_type', $array = array(
			'rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '','ap_type_cd','asc');
			
		$this->template
		->set_layout('users')
		->build('ap_types',isset($data) ? $data : NULL);
	}
	
	
	function create()
	{
		if ($this->input->post()) {
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
				$this->form_validation->set_rules('ap_type_code', 'Code', 'required|xss_clean|is_unique[sa_ap_type.ap_type_cd]');
				$this->form_validation->set_rules('ap_type_name', 'Name', 'required|xss_clean');
										
				if ($this->form_validation->run() == FALSE)
				{
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('error_in_form'));
					$_POST = '';
					$this->index();
				}else{		
					$data_ap_type = array(
							'ap_type_cd'=>$this->input->post('ap_type_code'),
							'ap_type_name'=>strtoupper($this->input->post('ap_type_name')),
							'user_created'=>$this->session->userdata('user_id'),
							'date_created'=>date('Y-m-d'),
							'time_created'=>date('H:i:s')							
			         );
					$this->db->insert('sa_ap_type', $data_ap_type); 
					$ap_type_id = $this->db->insert_id();

					$params['user_rowID'] = $this->tank_auth->get_user_id();
					$params['module'] = 'ap_types';
					$params['module_field_id'] = $ap_type_id;
					$params['activity'] = ucfirst('Added a new ap Type '.$this->input->post('ap_type_name'));
					$params['icon'] = 'fa-user';
					modules::run('activitylog/log',$params); //log activity

					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', lang('ap_type_registered_successfully'));
					redirect('ap_type');
				}
		}else{
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message', lang('error_in_form'));
			redirect('ap_type');
		}
	}

}

/* End of file contacts.php */