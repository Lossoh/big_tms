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


class Files extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('tank_auth');
		
		$this->load->model('projects/c_model','project');
	}
	function add()
	{		
		if ($this->input->post()) {
			$project = $this->input->post('project', TRUE);
			$description = $this->input->post('description', TRUE);
						$this->load->library('form_validation');
						$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
						$this->form_validation->set_rules('description', 'Description', 'required');

						if ($this->form_validation->run() == FALSE)
						{
								$this->session->set_flashdata('response_status', 'error');
								$this->session->set_flashdata('message', lang('error_in_form'));
								redirect('collaborator/projects/details/'.$project);
						}else{

								if ($this->config->item('demo_mode') == 'FALSE') {
								$config['upload_path'] = './resource/project-files/';
									$config['allowed_types'] = $this->config->item('allowed_files');
									$config['max_size']	= $this->config->item('file_max_size');
									$config['file_name'] = 'PROJECT-'.$this->input->post('project_code', TRUE).'-0';
									$config['overwrite'] = FALSE;

									$this->load->library('upload', $config);

									if ( ! $this->upload->do_upload())
									{
										$this->session->set_flashdata('response_status', 'error');
										$this->session->set_flashdata('message',$this->lang->line('operation_failed'));
										redirect('collaborator/projects/details/'.$project);
									}
									else
									{
										$data = $this->upload->data();
										$file_id = $this->project->insert_file($data['file_name'],$project,$description);
										$filelink = '<a href="'.base_url().'resource/project-files/'.$data['file_name'].'" target="_blank">'.$data['file_name'].'</a>';
										
										$activity = ucfirst($this->tank_auth->get_username())." added a file ".$filelink;
										$this->_log_activity($project,$activity,$icon='fa-file'); //log activity
			

										$this->_upload_notification($project);

										$this->session->set_flashdata('response_status', 'success');
										$this->session->set_flashdata('message',$this->lang->line('file_uploaded_successfully'));
										redirect('collaborator/projects/details/'.$project);
									}
								} else {
									$this->session->set_flashdata('response_status', 'error');
									$this->session->set_flashdata('message',$this->lang->line('demo_warning'));
										redirect('collaborator/projects/details/'.$project);
								}
					}
		}else{
			$project = $this->uri->segment(4)/1200;
			$project_details = $this->project->project_details($project);
			foreach ($project_details as $key => $p) {
				$project_code = $p->project_code;
			}
		$data['project_code'] = $project_code;
		$data['project'] = $project;
		$this->load->view('modal/add_file',isset($data) ? $data : NULL);
	}
}
	function download()
	{
	$this->load->helper('download');
	$file_id = $this->uri->segment(4)/1800;
	$project_id = $this->uri->segment(5)/1200;
		if ($this->project->get_file($file_id))
			{
			$file = $this->project->get_file($file_id);
			if(file_exists('./resource/project-files/'.$file->file_name)){
			$data = file_get_contents('./resource/project-files/'.$file->file_name); // Read the file's contents
			force_download($file->file_name, $data);
		}else{
			$this->session->set_flashdata('message',$this->lang->line('operation_failed'));
				redirect('projects/view/details/'.$project_id);
			}
		}
		else
		{
			$this->session->set_flashdata('message',$this->lang->line('operation_failed'));
				redirect('projects/view/details/'.$project_id);
		}
	}
	function delete()
	{
		if ($this->input->post()) {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('file', 'File ID', 'required');
		$this->form_validation->set_rules('project', 'Project ID', 'required');
		$project_id = $this->input->post('project', TRUE);
		$file_id = $this->input->post('file', TRUE);

		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('delete_failed'));
				redirect('collaborator/projects/details/'.$project_id);
		}else{			
			$file = $this->project->get_file($file_id);
			unlink('./resource/project-files/'.$file->file_name);
			$this->db->delete('files', array('file_id' => $file_id)); 

			$activity = ucfirst($this->tank_auth->get_username())." deleted a file ".$file->file_name;
			$this->_log_activity($project_id,$activity,$icon='fa-times'); //log activity
			
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('file_deleted'));
			redirect('collaborator/projects/details/'.$project_id);
			}
		}else{
			$data['file_id'] = $this->uri->segment(4)/1800;
			$data['project_id'] = $this->uri->segment(5)/1200;
			$this->load->view('modal/delete_file',$data);
		}
	}
	function _upload_notification($project){
			$project_title = $this->user_profile->get_project_details($project,'project_title');
			$client = $this->user_profile->get_project_details($project,'client');

			$upload_user = $this->user_profile->get_user_details($this->tank_auth->get_user_id(),'username');
			$data['project_title'] = $project_title;
			$data['upload_user'] = $upload_user;

			$params['recipient'] = $this->user_profile->get_user_details($client,'email');

			$params['subject'] = '[ '.$this->config->item('company_name').' ]'.' New Project File Uploaded';
			$params['message'] = $this->load->view('emails/upload_notification',$data,TRUE);

			$params['attached_file'] = '';

			modules::run('fomailer/send_email',$params);
	}
	function _log_activity($project_id,$activity,$icon){
			$this->db->set('module', 'projects');
			$this->db->set('module_field_id', $project_id);
			$this->db->set('user', $this->tank_auth->get_user_id());
			$this->db->set('activity', $activity);
			$this->db->set('icon', $icon);
			$this->db->insert('activities'); 
	}
}

/* End of file files.php */