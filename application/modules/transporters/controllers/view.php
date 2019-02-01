<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('transporter_model','transporter');

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
		$this->form_validation->set_rules('transporter_ref', 'Transporter Reference', 'required|xss_clean|max_length[20]');
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
				redirect('transporters');
		}else{	
			$transporter_id =  $this->input->post('transporter_id');
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
							'user_modified'=>$this->session->userdata('user_id'),
							'date_modified'=>date('Y-m-d'),
							'time_modified'=>date('H:i:s')							
			            );

			$this->db->where('transporter_id',$transporter_id)->update('mst_transporters', $transporter_data); 

					$params['user'] = $this->tank_auth->get_user_id();
					$params['module'] = 'Transporters';
					$params['module_field_id'] = $transporter_id;
					$params['activity'] = ucfirst('Updated System User : '.$this->input->post('fullname'));
					$params['icon'] = 'fa-edit';
					modules::run('activitylog/log',$params); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('transporter_edited_successfully'));
			redirect('transporters');
		}
		}else{
		$data['transporter_details'] = $this->transporter->transporter_details($this->uri->segment(4));
		$data['roles'] = $this->transporter->roles();
				
		
		$this->load->view('modal/edit_transporter',$data);
		}
	}
	
	function activities()
	{		
		$data['user_activities'] = $this->transporter->user_activities($this->uri->segment(4),$limit = 10);
		$this->load->view('transporter_activities',isset($data) ? $data : NULL);
	}
	function delete()
	{
		if ($this->input->post()) {

			$transporter_id = $this->input->post('transporter_id', TRUE);
			$transporter_data = array(
							'deleted'=>1,
							'user_deleted'=>$this->session->userdata('user_id'),
							'date_deleted'=>date('Y-m-d'),
							'time_deleted'=>date('H:i:s')							
			            );

			$this->db->where('transporter_id',$transporter_id)->update('mst_transporters', $transporter_data); 

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('transporter_deleted_successfully'));
			redirect('transporters');
		}else{
			$data['transporter_id'] = $this->uri->segment(4);
			$data['transporter_details'] = $this->transporter->transporter_details($this->uri->segment(4));
			$this->load->view('modal/delete_transporter',$data);

		}
	}
	
	function details()
	{		
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('trucks').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('trucks');
		$data['datatables'] = TRUE;
		$data['form'] = TRUE;
		$data['truck_details'] =$this->AppModel->get_all_records($table = 'mst_trucks',$array = array('deleted' => 0, 'transporter_id =' => $this->uri->segment(4)),
		$join_table = 'mst_reference', $join_criteria = 'mst_reference.no_urut_ref = mst_trucks.truck_type_id AND fx_mst_reference.Type_Ref = "truck_type"','truck_name');
		$data['transporters'] = $this->transporter->transporter_details($this->uri->segment(4));		
		$this->template
		->set_layout('users')
		->build('truck_details',isset($data) ? $data : NULL);

		
	}	
}

/* End of file view.php */