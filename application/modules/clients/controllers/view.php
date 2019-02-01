<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('tank_auth');

		$this->load->model('client_model','client');
	}
	function details()
	{		
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('clients').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('clients');
		$data['datatables'] = TRUE;
		$data['form'] = TRUE;
		$data['client_details'] = $this->client->client_details($this->uri->segment(4));
		$data['destinations'] = $this->AppModel->get_all_records($table = 'mst_destinations', $array = array(
			'destination_id >' => 0, 'deleted =' => 0), $join_table = '', $join_criteria = '','destination_name');				

		$this->template
		->set_layout('users')
		->build('client_details',isset($data) ? $data : NULL);
	}

	function update()
	{
		if ($this->input->post()) {
/* 			if ($this->config->item('demo_mode') == 'TRUE') {
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message', lang('demo_warning'));
			redirect('items');
		} */
		
		$this->load->library('form_validation');		
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('client_ref', 'Client Reference', 'required|xss_clean|max_length[20]');
		$this->form_validation->set_rules('client_name', 'Client Name', 'required|xss_clean|max_length[40]');
		$this->form_validation->set_rules('address_1', 'Adddress Line One', 'required|xss_clean|max_length[40]');
		$this->form_validation->set_rules('address_2', 'Adddress Line Two', 'xss_clean|max_length[40]');
		$this->form_validation->set_rules('address_3', 'Adddress Line Three', 'xss_clean|max_length[40]');
		$this->form_validation->set_rules('city', 'City Name', 'xss_clean|max_length[30]');
		$this->form_validation->set_rules('pic_1', 'PIC One', 'required|xss_clean|max_length[30]');
		$this->form_validation->set_rules('pic_2', 'PIC Two', 'xss_clean|max_length[30]');
		$this->form_validation->set_rules('pic_3', 'PIC Three', 'xss_clean|max_length[30]');
		$this->form_validation->set_rules('destination_id', 'Destination Id', 'required|xss_clean|min_length[1]|numeric');
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('error_in_form'));
				redirect('clients');
		}else{	
			$client_id =  $this->input->post('client_id');
			$client_data = array(
							'client_ref'=>strtoupper($this->input->post('client_ref')),
							'client_name'=>strtoupper($this->input->post('client_name')),
							'address_1'=>strtoupper($this->input->post('address_1')),
							'address_2'=>strtoupper($this->input->post('address_2')),
							'address_3'=>strtoupper($this->input->post('address_3')),
							'city'=>strtoupper($this->input->post('city')),
							'pic_1'=>strtoupper($this->input->post('pic_1')),
							'pic_2'=>strtoupper($this->input->post('pic_2')),
							'pic_3'=>strtoupper($this->input->post('pic_3')),
							'destination_id'=>$this->input->post('destination_id'),
							'user_modified'=>$this->session->userdata('user_id'),
							'date_modified'=>date('Y-m-d'),
							'time_modified'=>date('H:i:s')							
			            );

			$this->db->where('client_id',$client_id)->update('mst_clients', $client_data); 

					$params['user'] = $this->tank_auth->get_user_id();
					$params['module'] = 'Clients';
					$params['module_field_id'] = $client_id;
					$params['activity'] = ucfirst('Updated System User : '.$this->input->post('fullname'));
					$params['icon'] = 'fa-edit';
					modules::run('activitylog/log',$params); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('client_edited_successfully'));
			redirect('clients');
		}
		}else{
		$data['client_details'] = $this->client->client_details($this->uri->segment(4));
		$data['roles'] = $this->client->roles();
		$data['destinations'] = $this->AppModel->get_all_records($table = 'mst_destinations', $array = array(
			'destination_id >' => 0, 'deleted =' => 0), $join_table = '', $join_criteria = '','destination_name');				
		
		$this->load->view('modal/edit_client',$data);
		}
	}
	
	function activities()
	{		
		$data['user_activities'] = $this->client->user_activities($this->uri->segment(4),$limit = 10);
		$this->load->view('client_activities',isset($data) ? $data : NULL);
	}
	function delete()
	{
		if ($this->input->post()) {

			$client_id = $this->input->post('client_id', TRUE);
			$client_data = array(
							'deleted'=>1,
							'user_deleted'=>$this->session->userdata('user_id'),
							'date_deleted'=>date('Y-m-d'),
							'time_deleted'=>date('H:i:s')							
			            );

			$this->db->where('client_id',$client_id)->update('mst_clients', $client_data); 

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('client_deleted_successfully'));
			redirect('clients');
		}else{
			$data['client_id'] = $this->uri->segment(4);
			$data['client_details'] = $this->client->client_details($this->uri->segment(4));
			$this->load->view('modal/delete_client',$data);

		}
	}
}

/* End of file view.php */