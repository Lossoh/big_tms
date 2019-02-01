<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('department_model','department');
	}
	function details()
	{		
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('departments').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('departments');
		$data['datatables'] = TRUE;
		$data['form'] = TRUE;
		$data['department_details'] = $this->department->departments_details($this->uri->segment(4));

		$this->template
		->set_layout('users')
		->build('department_details',isset($data) ? $data : NULL);
	}

	function update()
	{
		if ($this->input->post()) {
		
		$this->load->library('form_validation');		
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('department_code', 'Department Code', 'required|xss_clean|max_length[2]');
		$this->form_validation->set_rules('department_name', 'Department Name', 'required|xss_clean|max_length[40]|is_unique[sa_dep.dep_name]');
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('error_in_form'));
				redirect('department');
		}else{	
		$department_id =  $this->input->post('row_id');
			$department_data = array(
							'dep_cd'=>strtoupper($this->input->post('department_code')),
							'dep_name'=>strtoupper($this->input->post('department_name')),
							'user_modified'=>$this->session->userdata('user_id'),
							'date_modified'=>date('Y-m-d'),
							'time_modified'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$department_id)->update('sa_dep', $department_data); 

					$params['user_rowID'] = $this->tank_auth->get_user_id();
					$params['module'] = 'Department';
					$params['module_field_id'] = $department_id;
					$params['activity'] = ucfirst('Updated System User : '.$this->input->post('department_name'));
					$params['icon'] = 'fa-edit';
					modules::run('activitylog/log',$params); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('department_edited_successfully'));
			redirect('department');
		}
		}else{

		 $data['department_details'] = $this->department->department_details($this->uri->segment(4));
		$this->load->view('modal/edit_department',$data);
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

			$department_id = $this->input->post('row_id', TRUE);
			$department_data = array(
							'deleted'=>1,
							'user_deleted'=>$this->session->userdata('user_id'),
							'date_deleted'=>date('Y-m-d'),
							'time_deleted'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$department_id)->update('sa_dep', $department_data); 

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('department_deleted_successfully'));
			redirect('department');
		}else{
			$data['department_id'] = $this->uri->segment(4);
			$data['department_details'] = $this->department->department_details($this->uri->segment(4));
			$this->load->view('modal/delete_department',$data);

		}
	}
}

/* End of file view.php */