<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Destination_from extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('destination_from_model');
	}

	function index()
	{
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('destination_froms').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('destination_froms');
		$this->session->set_userdata('page_header', 'master');		
		$this->session->set_userdata('page_detail', 'destination_froms');
		$data['datatables'] = TRUE;
		$data['form'] = TRUE;
		$data['destination_froms'] = $this->destination_from_model->get_all_records($table = 'sa_destination_from', $array = array(
			'rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '','from_cd','asc');
		$this->template
		->set_layout('users')
		->build('destination_froms',isset($data) ? $data : NULL);
	}
	
	
	function create()
	{
		if ($this->input->post()) {
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
				$this->form_validation->set_rules('destination_from_code', 'Destination From Code', 'required|xss_clean|is_unique[sa_destination_from.from_cd]');
				$this->form_validation->set_rules('destination_from_name', 'Destination From Name', 'required|xss_clean');
										
				if ($this->form_validation->run() == FALSE)
				{
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('error_in_form'));
					$_POST = '';
					$this->index();
				}else{		
					$data_destination_from = array(
							'from_cd'=>$this->input->post('destination_from_code'),
							'decs'=>strtoupper($this->input->post('destination_from_name')),
							'address1'=>ucwords($this->input->post('destination_from_address1')),
							'address2'=>ucwords($this->input->post('destination_from_address2')),
							'address3'=>ucwords($this->input->post('destination_from_address3')),
							'post_cd'=>$this->input->post('destination_from_address3'),
							'telp_no'=>$this->input->post('destination_from_tlp'),
							'contact_prs'=>$this->input->post('destination_from_contact_person'),
							'user_created'=>$this->session->userdata('user_id'),
							'date_created'=>date('Y-m-d'),
							'time_created'=>date('H:i:s')							
			         );
					$this->db->insert('sa_destination_from', $data_destination_from); 
					$destination_from_id = $this->db->insert_id();

					$params['user_rowID'] = $this->tank_auth->get_user_id();
					$params['module'] = 'destination_froms';
					$params['module_field_id'] = $destination_from_id;
					$params['activity'] = ucfirst('Added a new Destination From '.$this->input->post('destination_from_name'));
					$params['icon'] = 'fa-user';
					modules::run('activitylog/log',$params); //log activity

					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', lang('destination_from_registered_successfully'));
					redirect('destination_from');
				}
		}else{
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message', lang('error_in_form'));
			redirect('destination_from');
		}
	}

}

/* End of file contacts.php */