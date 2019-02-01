<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('destination_to_model','destination_to');
	}
	
	function update()
	{
		if ($this->input->post()) {
		
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('destination_to_name', 'Destination To Name', 'required|xss_clean');
			
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('error_in_form'));
				redirect('destination_to');
		}else{	
			$destination_to_id =  $this->input->post('row_id');
			$data_destination_to = array(
							'descs'=>strtoupper($this->input->post('destination_to_name')),
							'address1'=>ucwords($this->input->post('destination_to_address1')),
							'address2'=>ucwords($this->input->post('destination_to_address2')),
							'address3'=>ucwords($this->input->post('destination_to_address3')),
							'post_cd'=>$this->input->post('destination_to_address3'),
							'telp_no'=>$this->input->post('destination_to_tlp'),
							'contact_prs'=>$this->input->post('destination_to_contact_person'),
							'user_modified'=>$this->session->userdata('user_id'),
							'date_modified'=>date('Y-m-d'),
							'time_modified'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$destination_to_id)->update('sa_destination_to', $data_destination_to); 

					$params['user_rowID'] = $this->tank_auth->get_user_id();
					$params['module'] = 'Destination_to';
					$params['module_field_id'] = $destination_to_id;
					$params['activity'] = ucfirst('Updated System Destination To : '.$this->input->post('destination_to_name'));
					$params['icon'] = 'fa-edit';
					modules::run('activitylog/log',$params); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('destination_to_edited_successfully'));
			redirect('destination_to');
		}
		}else{

		$data['destination_to_details'] = $this->destination_to->destination_to_details($this->uri->segment(4));
		$this->load->view('modal/edit_destination_to',$data);
		}
	}
	
	function activities()
	{		
		$data['user_activities'] = $this->user->user_activities($this->uri->segment(4),$limit = 10);
		$this->load->view('client_activities',isset($data) ? $data : NULL);
	}
	
	function delete()
	{
		if ($this->input->post()) {

			$destination_to_id = $this->input->post('row_id', TRUE);
			$destination_to_data = array(
							'deleted'=>1,
							'user_deleted'=>$this->session->userdata('user_id'),
							'date_deleted'=>date('Y-m-d'),
							'time_deleted'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$destination_to_id)->update('sa_destination_to',$destination_to_data); 

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('destination_to_deleted_successfully'));
			redirect('destination_to');
		}else{
			$data['destination_to_id'] = $this->uri->segment(4);
			$data['destination_to_details'] = $this->destination_to->destination_to_details($this->uri->segment(4));
			$this->load->view('modal/delete_destination_to',$data);

		}
	}
}

/* End of file view.php */