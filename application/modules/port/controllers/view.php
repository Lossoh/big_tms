<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('port_model','port');
	}
	
	function update()
	{
		if ($this->input->post()) {
		
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('port_name', 'Port Name', 'required|xss_clean|max_length[40]');
			
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('error_in_form'));
				redirect('port');
		}else{	
			$port_id =  $this->input->post('row_id');
			$data_port = array(
							'descs'=>strtoupper($this->input->post('port_name')),
							'user_modified'=>$this->session->userdata('user_id'),
							'date_modified'=>date('Y-m-d'),
							'time_modified'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$port_id)->update('sa_port', $data_port); 

					$params['user_rowID'] = $this->tank_auth->get_user_id();
					$params['module'] = 'Port';
					$params['module_field_id'] = $port_id;
					$params['activity'] = ucfirst('Updated System User : '.$this->input->post('port_name'));
					$params['icon'] = 'fa-edit';
					modules::run('activitylog/log',$params); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('port_edited_successfully'));
			redirect('port');
		}
		}else{

		$data['port_details'] = $this->port->port_details($this->uri->segment(4));
		$this->load->view('modal/edit_port',$data);
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

			$port_id = $this->input->post('row_id', TRUE);
			$port_data = array(
							'deleted'=>1,
							'user_deleted'=>$this->session->userdata('user_id'),
							'date_deleted'=>date('Y-m-d'),
							'time_deleted'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$port_id)->update('sa_port',$port_data); 

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('port_deleted_successfully'));
			redirect('port');
		}else{
			$data['port_id'] = $this->uri->segment(4);
			$data['port_details'] = $this->port->port_details($this->uri->segment(4));
			$this->load->view('modal/delete_port',$data);

		}
	}
}

/* End of file view.php */