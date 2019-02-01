<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('cost_code_model','cost_code');
	}
	
	function update()
	{
		if ($this->input->post()) {
		
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('cost_code_name', 'Cost Code Name', 'required|xss_clean|max_length[40]');
			
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('error_in_form'));
				redirect('cost_code');
		}else{	
			$cost_code_id =  $this->input->post('row_id');
			$data_cost_code = array(
							'descs'=>strtoupper($this->input->post('cost_code_name')),
							'user_modified'=>$this->session->userdata('user_id'),
							'date_modified'=>date('Y-m-d'),
							'time_modified'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$cost_code_id)->update('sa_cost', $data_cost_code); 

					$params['user_rowID'] = $this->tank_auth->get_user_id();
					$params['module'] = 'Cost Code';
					$params['module_field_id'] = $cost_code_id;
					$params['activity'] = ucfirst('Updated System User : '.$this->input->post('cost_code_name'));
					$params['icon'] = 'fa-edit';
					modules::run('activitylog/log',$params); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('cost_code_edited_successfully'));
			redirect('cost_code');
		}
		}else{

		$data['cost_code_details'] = $this->cost_code->cost_code_details($this->uri->segment(4));
		$this->load->view('modal/edit_cost_code',$data);
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

			$cost_code_id = $this->input->post('row_id', TRUE);
			$cost_code_data = array(
							'deleted'=>1,
							'user_deleted'=>$this->session->userdata('user_id'),
							'date_deleted'=>date('Y-m-d'),
							'time_deleted'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$cost_code_id)->update('sa_cost', $cost_code_data); 

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('cost_code_deleted_successfully'));
			redirect('cost_code');
		}else{
			$data['cost_code_id'] = $this->uri->segment(4);
			$data['cost_code_details'] = $this->cost_code->cost_code_details($this->uri->segment(4));
			$this->load->view('modal/delete_cost_code',$data);

		}
	}
}

/* End of file view.php */