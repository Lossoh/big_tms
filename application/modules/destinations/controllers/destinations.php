<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Destinations extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('destination_model');
	}

	function index()
	{
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('destinations').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('destinations');
		$data['datatables'] = TRUE;
		$data['form'] = TRUE;
		$data['destinations'] = $this->destination_model->get_all_records($table = 'mst_destinations', $array = array(
			'destination_id >' => '0', 'deleted' => 0), $join_table = 'mst_reference', $join_criteria = 'mst_reference.No_Urut_Ref = mst_destinations.destination_flag AND fx_mst_reference.Type_Ref = "destination_flag"','destination_name');				

		$this->template
		->set_layout('users')
		->build('destinations',isset($data) ? $data : NULL);
	}
	function create()
	{
		if ($this->input->post()) {
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
				$this->form_validation->set_rules('destination_ref', 'Destination Reference', 'required|xss_clean|max_length[3]|is_unique[mst_destinations.destination_ref]');
				$this->form_validation->set_rules('destination_name', 'Destination Name', 'required|xss_clean|max_length[40]');
				$this->form_validation->set_rules('address_1', 'Adddress Line One', 'required|xss_clean|max_length[40]');
				$this->form_validation->set_rules('destination_flag', 'Destination Status', 'required|xss_clean|min_length[1]|max_length[1]|numeric');
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
					$destination_data = array(
							'destination_ref'=>strtoupper($this->input->post('destination_ref')),
							'destination_name'=>strtoupper($this->input->post('destination_name')),
							'address_1'=>strtoupper($this->input->post('address_1')),
							'address_2'=>strtoupper($this->input->post('address_2')),
							'address_3'=>strtoupper($this->input->post('address_3')),
							'city'=>strtoupper($this->input->post('city')),
							'destination_flag'=>$this->input->post('destination_flag'),
							'user_created'=>$this->session->userdata('user_id'),
							'date_created'=>date('Y-m-d'),
							'time_created'=>date('H:i:s')							
			         );
					$this->db->insert('mst_destinations', $destination_data); 
					$destination_id = $this->db->insert_id();

					$params['user'] = $this->tank_auth->get_user_id();
					$params['module'] = 'Destinations';
					$params['module_field_id'] = $destination_id;
					$params['activity'] = ucfirst('Added a new destination '.$this->input->post('destination_name'));
					$params['icon'] = 'fa-user';
					modules::run('activitylog/log',$params); //log activity

					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', lang('destination_registered_successfully'));
					redirect('destinations');
					//redirect($this->input->post('r_urla'));	
				}
		}else{
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message', lang('error_in_form'));
			redirect('destinations');
			//$this->session->set_flashdata('form_errors', validation_errors('<span style="color:red">', '</span><br>'));
			//redirect($this->input->post('r_urla'));				
		}
	}


}

/* End of file contacts.php */