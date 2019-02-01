<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('tank_auth');
		
		$this->load->model('ap_type_model','ap_type');
	}
	
	function update()
	{
		if ($this->input->post()) {
		
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
				$this->form_validation->set_rules('ap_type_name', 'Name', 'required|xss_clean');
			
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('error_in_form'));
				redirect('ap_type');
		}else{	
			$ap_type_id =  $this->input->post('row_id');
			$data_ap_type = array(
							'ap_type_name'=>strtoupper($this->input->post('ap_type_name')),
							'user_modified'=>$this->session->userdata('user_id'),
							'date_modified'=>date('Y-m-d'),
							'time_modified'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$ap_type_id)->update('sa_ap_type', $data_ap_type); 

					$params['user_rowID'] = $this->tank_auth->get_user_id();
					$params['module'] = 'ap Type';
					$params['module_field_id'] = $ap_type_id;
					$params['activity'] = ucfirst('Updated System ap Type : '.$this->input->post('ap_type_name'));
					$params['icon'] = 'fa-edit';
					modules::run('activitylog/log',$params); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('ap_type_edited_successfully'));
			redirect('ap_type');
		}
		}else{

		$data['ap_type_details'] = $this->ap_type->ap_type_details($this->uri->segment(4));
		$this->load->view('modal/edit_ap_type',$data);
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

			$ap_type_id = $this->input->post('row_id', TRUE);
			$ap_type_data = array(
							'deleted'=>1,
							'user_deleted'=>$this->session->userdata('user_id'),
							'date_deleted'=>date('Y-m-d'),
							'time_deleted'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$ap_type_id)->update('sa_ap_type',$ap_type_data); 

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('ap_type_deleted_successfully'));
			redirect('ap_type');
		}else{
			$data['ap_type_id'] = $this->uri->segment(4);
			$data['ap_type_details'] = $this->ap_type->ap_type_details($this->uri->segment(4));
			$this->load->view('modal/delete_ap_type',$data);

		}
	}
}

/* End of file view.php */