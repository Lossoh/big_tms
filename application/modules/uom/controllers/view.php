<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('uom_model','uom');
	}
	
	function update()
	{
		if ($this->input->post()) {
		
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('uom_name', 'Unit of Measure Name', 'required|xss_clean');
			
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('error_in_form'));
				redirect('uom');
		}else{	
			$uom_id =  $this->input->post('row_id');
			$data_uom = array(
							'descs'=>strtoupper($this->input->post('uom_name')),
							'user_modified'=>$this->session->userdata('user_id'),
							'date_modified'=>date('Y-m-d'),
							'time_modified'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$uom_id)->update('sa_uom', $data_uom); 

					$params['user_rowID'] = $this->tank_auth->get_user_id();
					$params['module'] = 'Uom';
					$params['module_field_id'] = $uom_id;
					$params['activity'] = ucfirst('Updated System Unit of Measure : '.$this->input->post('uom_name'));
					$params['icon'] = 'fa-edit';
					modules::run('activitylog/log',$params); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('uom_edited_successfully'));
			redirect('uom');
		}
		}else{

		$data['uom_details'] = $this->uom->uom_details($this->uri->segment(4));
		$this->load->view('modal/edit_uom',$data);
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

			$uom_id = $this->input->post('row_id', TRUE);
			$uom_data = array(
							'deleted'=>1,
							'user_deleted'=>$this->session->userdata('user_id'),
							'date_deleted'=>date('Y-m-d'),
							'time_deleted'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$uom_id)->update('sa_uom',$uom_data); 

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('uom_deleted_successfully'));
			redirect('uom');
		}else{
			$data['uom_id'] = $this->uri->segment(4);
			$data['uom_details'] = $this->uom->uom_details($this->uri->segment(4));
			$this->load->view('modal/delete_uom',$data);

		}
	}
}

/* End of file view.php */