<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Order_description extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('order_description_model');
	}

	function index()
	{
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('order_descriptions').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('order_descriptions');
		$this->session->set_userdata('page_header', 'master');		
		$this->session->set_userdata('page_detail', 'order_descriptions');
		$data['datatables'] = TRUE;
		$data['form'] = TRUE;
		$data['order_descriptions'] = $this->order_description_model->get_all_records($table = 'sa_order_descs', $array = array(
			'rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '','descs_cd','asc');
		$this->template
		->set_layout('users')
		->build('order_descriptions',isset($data) ? $data : NULL);
	}
	
	
	function create()
	{
		if ($this->input->post()) {
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
				$this->form_validation->set_rules('order_description_code', 'Code', 'required|xss_clean|is_unique[sa_port.port_cd]');
				$this->form_validation->set_rules('order_description_name', 'Name', 'required|xss_clean');
										
				if ($this->form_validation->run() == FALSE)
				{
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('error_in_form'));
					$_POST = '';
					$this->index();
				}else{		
					$data_order_description = array(
							'descs_cd'=>$this->input->post('order_description_code'),
							'descs'=>strtoupper($this->input->post('order_description_name')),
							'user_created'=>$this->session->userdata('user_id'),
							'date_created'=>date('Y-m-d'),
							'time_created'=>date('H:i:s')							
			         );
					$this->db->insert('sa_order_descs', $data_order_description); 
					$order_description_id = $this->db->insert_id();

					$params['user_rowID'] = $this->tank_auth->get_user_id();
					$params['module'] = 'order_descriptions';
					$params['module_field_id'] = $order_description_id;
					$params['activity'] = ucfirst('Added a new Order Description '.$this->input->post('order_description_name'));
					$params['icon'] = 'fa-user';
					modules::run('activitylog/log',$params); //log activity

					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', lang('order_description_registered_successfully'));
					redirect('order_description');
				}
		}else{
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message', lang('error_in_form'));
			redirect('order_description');
		}
	}

}

/* End of file contacts.php */