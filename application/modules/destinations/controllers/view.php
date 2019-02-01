<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('destination_model','destination');
	}
	function details()
	{		
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('destinations').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('destinations');
		$data['datatables'] = TRUE;
		$data['form'] = TRUE;
		$data['destination_details'] = $this->destination->destination_details($this->uri->segment(4));

		$this->template
		->set_layout('users')
		->build('destination_details',isset($data) ? $data : NULL);
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
				$this->form_validation->set_rules('destination_ref', 'Destination Reference', 'required|xss_clean|max_length[3]');
				$this->form_validation->set_rules('destination_name', 'Destination Name', 'required|xss_clean|max_length[40]');
				$this->form_validation->set_rules('address_1', 'Adddress Line One', 'required|xss_clean|max_length[40]');
				$this->form_validation->set_rules('address_2', 'Adddress Line Two', 'xss_clean|max_length[40]');
				$this->form_validation->set_rules('address_3', 'Adddress Line Three', 'xss_clean|max_length[40]');
				$this->form_validation->set_rules('city', 'City Name', 'xss_clean|max_length[30]');
				$this->form_validation->set_rules('destination_flag', 'Destination Status', 'required|xss_clean|min_length[1]|max_length[1]|numeric');
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('error_in_form'));
				redirect('destinations');
		}else{	
		$destination_id =  $this->input->post('destination_id');
			$destination_data = array(
							'destination_ref'=>strtoupper($this->input->post('destination_ref')),
							'destination_name'=>strtoupper($this->input->post('destination_name')),
							'address_1'=>strtoupper($this->input->post('address_1')),
							'address_2'=>strtoupper($this->input->post('address_2')),
							'address_3'=>strtoupper($this->input->post('address_3')),
							'city'=>strtoupper($this->input->post('city')),
							'destination_flag'=>$this->input->post('destination_flag'),
							'user_modified'=>$this->session->userdata('user_id'),
							'date_modified'=>date('Y-m-d'),
							'time_modified'=>date('H:i:s')							
			            );

			$this->db->where('destination_id',$destination_id)->update('mst_destinations', $destination_data); 

					$params['user'] = $this->tank_auth->get_user_id();
					$params['module'] = 'Destinations';
					$params['module_field_id'] = $destination_id;
					$params['activity'] = ucfirst('Updated System User : '.$this->input->post('fullname'));
					$params['icon'] = 'fa-edit';
					modules::run('activitylog/log',$params); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('destination_edited_successfully'));
			redirect('destinations');
		}
		}else{
		$data['destination_details'] = $this->destination->destination_details($this->uri->segment(4));
		$data['roles'] = $this->destination->roles();
		$data['destinations'] = $this->AppModel->get_all_records($table = 'mst_destinations',
		$array = array(
			'destination_id >' => '0'),$join_table = '',$join_criteria = '','destination_name');
		$this->load->view('modal/edit_destination',$data);
		}
	}
	
	function activities()
	{		
		$data['user_activities'] = $this->destination->user_activities($this->uri->segment(4),$limit = 10);
		$this->load->view('client_activities',isset($data) ? $data : NULL);
	}
	function delete()
	{
		if ($this->input->post()) {

			$destination_id = $this->input->post('destination_id', TRUE);
			$destination_data = array(
							'deleted'=>1,
							'user_deleted'=>$this->session->userdata('user_id'),
							'date_deleted'=>date('Y-m-d'),
							'time_deleted'=>date('H:i:s')							
			            );

			$this->db->where('destination_id',$destination_id)->update('mst_destinations', $destination_data); 

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('destination_deleted_successfully'));
			redirect('destinations');
		}else{
			$data['destination_id'] = $this->uri->segment(4);
			$data['destination_details'] = $this->destination->destination_details($this->uri->segment(4));
			$this->load->view('modal/delete_destination',$data);

		}
	}
}

/* End of file view.php */