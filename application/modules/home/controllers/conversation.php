<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Conversation extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('messages/msg_model');
	}

	function view()
	{
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title(lang('messages').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
	$data['page'] = lang('messages');
	$recipient = $this->uri->segment(4)/1200;

	$this->_set_read($recipient);
	$data['conversations'] = $this->msg_model->get_conversations($recipient);
	$data['users'] = $this->msg_model->group_messages_by_users($this->tank_auth->get_user_id());
	$this->template
	->set_layout('users')
	->build('messages/conversations',isset($data) ? $data : NULL);
	}
	
	function send()
	{
		if ($this->input->post()) {
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('user_to', 'User To', 'required');
		$this->form_validation->set_rules('message', 'Message', 'required');
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('message_not_sent'));
				redirect($this->input->post('r_url'));
		}else{	
			$message = $this->input->post('message', TRUE);
			$user_to = $this->input->post('user_to', TRUE);

			$form_data = array(
			                'user_to' => $this->input->post('user_to', TRUE),
			                'user_from' => $this->tank_auth->get_user_id(),
			                'message' => $this->input->post('message'),
			            );
			$this->db->insert('messages', $form_data);

			$this->_message_notification($user_to,$message);

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message',lang('message_sent'));

			redirect($this->input->post('r_url'));
			}
		}else{
				$this->load->module('layouts');
				$this->load->library('template');
				$this->template->title(lang('messages').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
				$data['form'] = TRUE;
				$data['page'] = lang('messages');
				$data['admins'] = $this->msg_model->get_all_records($table = 'users',
							$array = array('activated' => 1),$join_table = '',$join_criteria = '','created');
				$data['users'] = $this->msg_model->group_messages_by_users($this->tank_auth->get_user_id());
				$this->template
				->set_layout('users')
				->build('messages/send_message',isset($data) ? $data : NULL);
		}
	}

	function delete()
	{
		if ($this->input->post()) {
				$this->load->library('form_validation');
				$this->form_validation->set_rules('msg_id', 'Msg ID', 'required');

				$r_url = $this->input->post('r_url', TRUE);
				$msg_id = $this->input->post('msg_id', TRUE);

				if ($this->form_validation->run() == FALSE)
				{
						$this->session->set_flashdata('response_status', 'error');
						$this->session->set_flashdata('message', lang('delete_failed'));
						redirect('staffs/conversation/view/'.$r_url);
				}else{
					$this->db->set('deleted', 'Yes');
					$this->db->where('msg_id',$msg_id)->update('messages');

					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', lang('message_deleted_successfully'));
					redirect('staffs/conversation/view/'.$r_url);
					}
		}else{
			$data['msg_id'] = $this->uri->segment(4)/1200;
			$data['r_url'] = $this->uri->segment(5);
			$this->load->view('modal/delete_message',$data);
		}
	}
	function _set_read($user_from){
			$this->db->set('status', 'Read');
			$this->db->where('user_to',$this->tank_auth->get_user_id());
			$this->db->where('user_from',$user_from)->update('messages'); 
	}

	function _message_notification($user_to,$message){

			$recipient_email = $this->user_profile->get_user_details($user_to,'email');
			$data['recipient_username'] = $this->user_profile->get_user_details($user_to,'username');
			$data['message'] = $message;

			$params['recipient'] = $recipient_email;

			$params['subject'] = '[ '.$this->config->item('company_name').' ]'.' New Message Received';

			$params['message'] = $this->load->view('emails/message_notification',$data,TRUE);

			$params['attached_file'] = '';

			modules::run('fomailer/send_email',$params);
	}
}

/* End of file conversation.php */