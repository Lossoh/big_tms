<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Destination_to extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('destination_to_model');
	}

	function index()
	{
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('destination_tos').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('destination_tos');
		$this->session->set_userdata('page_header', 'master');		
		$this->session->set_userdata('page_detail', 'destination_tos');
		$data['datatables'] = TRUE;
		$data['form'] = TRUE;
		$data['destination_tos'] = $this->destination_to_model->get_all_records($table = 'sa_destination_to', $array = array(
			'rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '','to_cd','asc');
		$this->template
		->set_layout('users')
		->build('destination_tos',isset($data) ? $data : NULL);
	}
	
	
	function create()
	{
		if ($this->input->post()) {
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
				$this->form_validation->set_rules('destination_to_code', 'Destination To Code', 'required|xss_clean|is_unique[sa_destination_to.to_cd]');
				$this->form_validation->set_rules('destination_to_name', 'Destination To Name', 'required|xss_clean');
										
				if ($this->form_validation->run() == FALSE)
				{
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('error_in_form'));
					$_POST = '';
					$this->index();
				}else{		
					$data_destination_to = array(
							'to_cd'=>$this->input->post('destination_to_code'),
							'descs'=>strtoupper($this->input->post('destination_to_name')),
							'address1'=>ucwords($this->input->post('destination_to_address1')),
							'address2'=>ucwords($this->input->post('destination_to_address2')),
							'address3'=>ucwords($this->input->post('destination_to_address3')),
							'post_cd'=>$this->input->post('destination_to_address3'),
							'telp_no'=>$this->input->post('destination_to_tlp'),
							'contact_prs'=>$this->input->post('destination_to_contact_person'),
							'user_created'=>$this->session->userdata('user_id'),
							'date_created'=>date('Y-m-d'),
							'time_created'=>date('H:i:s')							
			         );
					$this->db->insert('sa_destination_to', $data_destination_to); 
					$destination_to_id = $this->db->insert_id();

					$params['user_rowID'] = $this->tank_auth->get_user_id();
					$params['module'] = 'destination_tos';
					$params['module_field_id'] = $destination_to_id;
					$params['activity'] = ucfirst('Added a new Destination To '.$this->input->post('destination_to_name'));
					$params['icon'] = 'fa-user';
					modules::run('activitylog/log',$params); //log activity

					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', lang('destination_to_registered_successfully'));
					redirect('destination_to');
				}
		}else{
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message', lang('error_in_form'));
			redirect('destination_to');
		}
	}

}

/* End of file contacts.php */