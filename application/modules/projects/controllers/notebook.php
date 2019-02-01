<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
**********************************************************************************
* Copyright: gitbench 2014
* Licence: Please check CodeCanyon.net for licence details. 
* More licence clarification available here: htttp://codecanyon.net/wiki/support/legal-terms/licensing-terms/ 
* CodeCanyon User: http://codecanyon.net/user/gitbench
* CodeCanyon Project: http://codecanyon.net/item/freelancer-office/8870728
* Package Date: 2014-09-24 09:33:11 
***********************************************************************************
*/


class Notebook extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('project_model','project');
	}

	function notes()
	{
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title(lang('notes').' - '.$this->config->item('company_name'). ' '. $this->config->item('version'));
	$data['page'] = lang('projects');
	$data['projects'] = $this->project->get_all_records($table = 'projects',
		$array = array(
			'proj_deleted' => 'No'),$join_table = 'account_details',$join_criteria = 'account_details.user_id = projects.client','date_created');
	$this->template
	->set_layout('users')
	->build('notes',isset($data) ? $data : NULL);
	}
	function savenote()
	{
		if ($this->input->post()) {
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('project', 'Project', 'required');
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('error_in_form'));
				redirect($this->input->post('r_url', TRUE));
		}else{		
			$project = $this->input->post('project', TRUE);	
			$form_data = array(
			                'notes' => $this->input->post('notes')						
			            );
			$this->db->where('project_id',$project)->update('projects', $form_data); 
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('note_saved_successfully'));
			redirect($this->input->post('r_url', TRUE));
			}
		}else{
			redirect('projects/notebook/notes');
		}
	}
}

/* End of file project_home.php */