<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Files extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('bugs_model','bug');
	}
	function add()
	{		
		if ($this->input->post()) {
			$bug = $this->input->post('bug', TRUE);
			$description = $this->input->post('description', TRUE);
			$assigned_to = $this->input->post('assigned_to', TRUE);
						$this->load->library('form_validation');
						$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
						$this->form_validation->set_rules('description', 'Description', 'required');

						if ($this->form_validation->run() == FALSE)
						{
								$this->session->set_flashdata('response_status', 'error');
								$this->session->set_flashdata('message', lang('error_in_form'));
								redirect('bugs/view/details/'.$bug);
						}else{

								if ($this->config->item('demo_mode') == 'FALSE') {
								$config['upload_path'] = './resource/bug-files/';
									$config['allowed_types'] = $this->config->item('allowed_files');
									$config['max_size']	= $this->config->item('file_max_size');
									$config['file_name'] = 'PROJECT-BUG-'.$this->input->post('issue_ref', TRUE).'-0';
									$config['overwrite'] = FALSE;

									$this->load->library('upload', $config);

									if ( ! $this->upload->do_upload())
									{
										$this->session->set_flashdata('response_status', 'error');
										$this->session->set_flashdata('message',$this->lang->line('operation_failed'));
										redirect('bugs/view/details/'.$bug);
									}
									else
									{
										$data = $this->upload->data();
										$file_id = $this->bug->insert_file($data['file_name'],$bug,$description);
										$filelink = '<a href="'.base_url().'resource/bug-files/'.$data['file_name'].'" target="_blank">'.$data['file_name'].'</a>';
										
										$activity = ucfirst($this->tank_auth->get_username())." added a file ".$filelink;
										$this->_log_activity($bug,$activity,$icon='fa-file'); //log activity
			

										$this->_upload_notification($bug,$assigned_to);

										$this->session->set_flashdata('response_status', 'success');
										$this->session->set_flashdata('message',$this->lang->line('file_uploaded_successfully'));
										redirect('bugs/view/details/'.$bug);
									}
								} else {
									$this->session->set_flashdata('response_status', 'error');
									$this->session->set_flashdata('message',$this->lang->line('demo_warning'));
										redirect('bugs/view/details/'.$bug);
								}
					}
		}else{
			$bug = $this->uri->segment(4)/1200;
			$bug_details = $this->bug->bug_details($bug);
			foreach ($bug_details as $key => $p) {
				$issue_ref = $p->issue_ref;
				$assigned_to = $p->assigned_to;
			}
		$data['issue_ref'] = $issue_ref;
		$data['bug'] = $bug;
		$data['assigned_to'] = $assigned_to;
		$this->load->view('modal/add_file',isset($data) ? $data : NULL);
	}
}
	function download()
	{
	$this->load->helper('download');
	$file_id = $this->uri->segment(4)/1800;
	$bug = $this->uri->segment(5)/1200;
		if ($this->bug->get_file($file_id))
			{
			$file = $this->bug->get_file($file_id);
			if(file_exists('./resource/bug-files/'.$file->file_name)){
			$data = file_get_contents('./resource/bug-files/'.$file->file_name); // Read the file's contents
			force_download($file->file_name, $data);
		}else{
			$this->session->set_flashdata('message',$this->lang->line('operation_failed'));
				redirect('bugs/view/details/'.$bug);
			}
		}
		else
		{
			$this->session->set_flashdata('message',$this->lang->line('operation_failed'));
				redirect('bugs/view/details/'.$bug);
		}
	}
	function delete()
	{
		if ($this->input->post()) {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('file', 'File ID', 'required');
		$this->form_validation->set_rules('bug', 'Bug ID', 'required');

		$bug = $this->input->post('bug', TRUE);
		$file_id = $this->input->post('file', TRUE);

		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('delete_failed'));
				redirect('bugs/view/details/'.$bug);
		}else{			
			$file = $this->bug->get_file($file_id);
			unlink('./resource/bug-files/'.$file->file_name);
			$this->db->delete('bug_files', array('file_id' => $file_id)); 

			$activity = ucfirst($this->tank_auth->get_username())." deleted a file ".$file->file_name;
			$this->_log_activity($bug,$activity,$icon='fa-times'); //log activity
			
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('file_deleted'));
			redirect('bugs/view/details/'.$bug);
			}
		}else{
			$data['file_id'] = $this->uri->segment(4)/1800;
			$data['bug'] = $this->uri->segment(5)/1200;
			$this->load->view('modal/delete_file',$data);
		}
	}
	function _upload_notification($bug,$assigned_to){

			$bug_details = $this->bug->bug_details($bug);
			foreach ($bug_details as $key => $p) {
				$issue_ref = $p->issue_ref;
				$reporter = $p->reporter;
			}

			$upload_user = $this->user_profile->get_user_details($this->tank_auth->get_user_id(),'username');
			$data['upload_user'] = $upload_user;
			$data['bug'] = $bug;
			$data['issue_ref'] = $issue_ref;

			$params['recipient'] = $this->user_profile->get_user_details($reporter,'email');

			$params['subject'] = '[ '.$this->config->item('company_name').' ]'.' New File Uploaded';
			$params['message'] = $this->load->view('emails/upload_notification',$data,TRUE);

			$params['attached_file'] = '';

			modules::run('fomailer/send_email',$params);
	}
	function _log_activity($bug,$activity,$icon){
			$this->db->set('module', 'bugs');
			$this->db->set('module_field_id', $bug);
			$this->db->set('user', $this->tank_auth->get_user_id());
			$this->db->set('activity', $activity);
			$this->db->set('icon', $icon);
			$this->db->insert('activities'); 
	}
}

/* End of file files.php */