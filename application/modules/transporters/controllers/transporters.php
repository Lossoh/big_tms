<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Transporters extends MX_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('transporter_model');
		
	}

	function index()
	{
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('transporters').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('transporters');
		$data['datatables'] = TRUE;
		$data['form'] = TRUE;
		$data['transporters'] = $this->AppModel->get_all_records($table = 'mst_transporters', $array = array(
			'transporter_id >' => 0, 'deleted =' => 0), $join_table = '', $join_criteria = '','transporter_name');			
		$this->template
		->set_layout('users')
		->build('transporters',isset($data) ? $data : NULL);
	}
	function create()
	{
		if ($this->input->post()) {
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
				$this->form_validation->set_rules('transporter_ref', 'Transporter Reference', 'required|xss_clean|max_length[20]|is_unique[mst_transporters.transporter_ref]');
				$this->form_validation->set_rules('transporter_name', 'Transporter Name', 'required|xss_clean|max_length[40]');
				$this->form_validation->set_rules('address_1', 'Adddress Line One', 'required|xss_clean|max_length[40]');
				$this->form_validation->set_rules('address_2', 'Adddress Line Two', 'xss_clean|max_length[40]');
				$this->form_validation->set_rules('address_3', 'Adddress Line Three', 'xss_clean|max_length[40]');
				$this->form_validation->set_rules('city', 'City Name', 'xss_clean|max_length[30]');
				$this->form_validation->set_rules('pic_1', 'PIC One', 'required|xss_clean|max_length[30]');
				$this->form_validation->set_rules('pic_2', 'PIC Two', 'xss_clean|max_length[30]');
				$this->form_validation->set_rules('pic_3', 'PIC Three', 'xss_clean|max_length[30]');
				if ($this->form_validation->run() == FALSE)
				{
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('error_in_form'));
					$_POST = '';
					$this->index();
					//$this->session->set_flashdata('form_errors', validation_errors('<span style="color:red">', '</span><br>'));
					//redirect($this->input->post('r_urla'));						
						//redirect('invoices/manage/add');
				}else{		
					//$form_data = $_POST;
					$transporter_data = array(
							'transporter_ref'=>strtoupper($this->input->post('transporter_ref')),
							'transporter_name'=>strtoupper($this->input->post('transporter_name')),
							'address_1'=>strtoupper($this->input->post('address_1')),
							'address_2'=>strtoupper($this->input->post('address_2')),
							'address_3'=>strtoupper($this->input->post('address_3')),
							'city'=>strtoupper($this->input->post('city')),
							'pic_1'=>strtoupper($this->input->post('pic_1')),
							'pic_2'=>strtoupper($this->input->post('pic_2')),
							'pic_3'=>strtoupper($this->input->post('pic_3')),
							'user_created'=>$this->session->userdata('user_id'),
							'date_created'=>date('Y-m-d'),
							'time_created'=>date('H:i:s')							
			         );
					$this->db->insert('mst_transporters', $transporter_data); 
					$transporter_id = $this->db->insert_id();

					$params['user'] = $this->tank_auth->get_user_id();
					$params['module'] = 'Transporters';
					$params['module_field_id'] = $transporter_id;
					$params['activity'] = ucfirst('Added a new item '.$this->input->post('transporter_name'));
					$params['icon'] = 'fa-user';
					modules::run('activitylog/log',$params); //log activity

					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', lang('transporter_registered_successfully'));
					redirect('transporters');
					//redirect($this->input->post('r_urla'));	
				}
		}else{
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message', lang('error_in_form'));
			redirect('transporters');
			//$this->session->set_flashdata('form_errors', validation_errors('<span style="color:red">', '</span><br>'));
			//redirect($this->input->post('r_urla'));				
		}
	}


}

/* End of file contacts.php */