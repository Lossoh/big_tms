<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Tickets extends MX_Controller {

	function __construct()
	{
		parent::__construct();

		$menu_code = $this->load->model('ticket_model', 'tickets');
	}

	function index()
	{
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('tickets').' - '.$this->config->item('comp_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('tickets');
		$data['form'] = TRUE;
		$data['datatables'] = TRUE;
		

		$data['all_event_lists'] = $this->tickets->ticket_lists($this->session->userdata('company_rowID'),$this->session->userdata('dep_rowID'), $this->session->userdata('user_rowID'), 0);
		
		$data['ticket_created'] = $this->session->userdata('ticket_created');
		$data['ticket_updated'] = $this->session->userdata('ticket_updated');
		$data['ticket_deleted'] = $this->session->userdata('ticket_deleted');
		$data['ticket_viewed'] = $this->session->userdata('ticket_viewed');
		$data['ticket_replied'] = $this->session->userdata('ticket_replied');

		$this->template
		->set_layout('users')
		->build('tickets',isset($data) ? $data : NULL);
	}

	function download()
	{
		$this->load->helper('download');
		$rowID = $this->uri->segment(3);
		
		if ($this->tickets->get_file($rowID))
			{
			$file = $this->tickets->get_file($rowID);
			if(file_exists('.'.$this->config->item('ticket_files').$file->attachment)){
			$data = file_get_contents('.'.$this->config->item('ticket_files').$file->attachment); // Read the file's contents
			force_download($file->attachment, $data);
		}else{
			$this->session->set_flashdata('message',$this->lang->line('operation_failed'));
				redirect('tickets');
			}
		}
		else
		{
			$this->session->set_flashdata('message',$this->lang->line('operation_failed'));
				redirect('tickets');
		}
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
			$data['categories'] = $this->tickets->get_all_records($table = 'sa_reference',$array = array('type_ref' => 'ticket_category'),'', '','type_no');
			
			$data['priorities'] = $this->tickets->get_all_records($table = 'sa_reference',$array = array('type_ref' => 'priority'),'', '','type_no');

			$this->load->view('modal/add_ticket',isset($data) ? $data : NULL);
		}
	}	
	

	function comment()
	{
		if ($this->input->post()) {
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('comment', 'Comment', 'required');
		$case_rowID=$this->input->post('tickets_rowID');
		
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('comment').lang('failed'));
				redirect('tickets/view/details/'.$this->input->get('lg_tickets',TRUE));
		}else{			
			$form_data = array(
			                'comment_rowID' => $case_rowID,
			                'user_created' => $this->tank_auth->get_user_id(),
			                'reply_message' => $this->input->post('comment'),
							'user_created'	=>	$this->session->userdata('user_rowID'),
							'date_created'	=>	date('Y-m-d'),
							'time_created'	=>	date('H:i:s'),	
			            );
			$this->db->insert('lg_comment_replies', $form_data);
			$rowID = $this->db->insert_id();			
			$activity = "Added a comment to a case ". $rowID;
			$this->_log_case_activity($case_rowID,$activity,$icon = 'fa-comment'); //log activity
			///$this->_comment_notification($this->uri->segment(4));

			
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('comment').lang('submitted_successfully'));
			redirect('tickets/view/details/'.$case_rowID);
			}
		}else{
		redirect('tickets');
		}
	}


	function _log_case_activity($comment_rowID,$activity,$icon){
			$this->db->set('module', 'case');
			$this->db->set('module_field_id', $comment_rowID);
			$this->db->set('user_rowID', $this->tank_auth->get_user_id());
			$this->db->set('activity', $activity);
			$this->db->set('icon', $icon);
			$this->db->insert('activities'); 
	}
}

/* End of file bugs.php */