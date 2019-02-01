<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('tank_auth');
		
		$this->load->model('coa_model','coa');
	}
	function details()
	{		
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('coas').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('coas');
		$data['datatables'] = TRUE;
		$data['form'] = TRUE;
		$data['coa_details'] = $this->coa->coa_details($this->uri->segment(4));

		$this->template
		->set_layout('users')
		->build('department_details',isset($data) ? $data : NULL);
	}

	function update()
	{
		if ($this->input->post()) {
		
		$this->load->library('form_validation');		
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('coa_type', 'Coa Type', 'required|xss_clean');
		$this->form_validation->set_rules('coa_code', 'Coa Code', 'required|xss_clean|is_unique[gl_coa.acc_cd]');
		$this->form_validation->set_rules('coa_name', 'Coa Name', 'required|xss_clean|max_length[40]');
		$this->form_validation->set_rules('coa_class', 'Coa Class', 'required|xss_clean');
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('error_in_form'));
				redirect('coa');
		}else{	
		$coa_id =  $this->input->post('row_id');
			$coa_data = array(
							'acc_type'=>strtoupper($this->input->post('coa_type')),
							'acc_cd'=>strtoupper($this->input->post('coa_code')),
							'acc_name'=>strtoupper($this->input->post('coa_name')),
							'acc_level'=>strtoupper($this->input->post('coa_level')),
							'acc_sub_of'=>strtoupper($this->input->post('coa_sub')),
							'is_cb'=>strtoupper($this->input->post('coa_cb')),
							'is_vat_in'=>strtoupper($this->input->post('coa_vatin')),
							'is_vat_in'=>strtoupper($this->input->post('coa_vatout')),
							'active'=>strtoupper($this->input->post('coa_active')),
							'user_modified'=>$this->session->userdata('user_id'),
							'date_modified'=>date('Y-m-d'),
							'time_modified'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$coa_id)->update('gl_coa', $coa_data); 

					$params['user_rowID'] = $this->tank_auth->get_user_id();
					$params['module'] = 'Coa';
					$params['module_field_id'] = $coa_id;
					$params['activity'] = ucfirst('Updated System User : '.$this->input->post('coa_name'));
					$params['icon'] = 'fa-edit';
					modules::run('activitylog/log',$params); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('coa_edited_successfully'));
			redirect('coa');
		}
		}else{

		$data['coa_details'] = $this->coa->coa_details($this->uri->segment(4));
		$this->load->view('modal/edit_coa',$data);
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

			$coa_id = $this->input->post('row_id', TRUE);
			$coa_data = array(
							'deleted'=>1,
							'user_deleted'=>$this->session->userdata('user_id'),
							'date_deleted'=>date('Y-m-d'),
							'time_deleted'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$coa_id)->update('gl_coa', $coa_data); 

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('coa_deleted_successfully'));
			redirect('coa');
		}else{
			$data['coa_id'] = $this->uri->segment(4);
			$data['coa_details'] = $this->coa->coa_details($this->uri->segment(4));
			$this->load->view('modal/delete_coa',$data);

		}
	}
}

/* End of file view.php */