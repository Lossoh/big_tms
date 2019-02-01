<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('settings_model');
	}

	function update()
	{
		if ($this->input->post()) {
			if ($this->uri->segment(3) == 'default') {
				$this->_update_default_settings('default');
			}elseif($this->uri->segment(3) == 'system'){
				$this->_update_system_settings('system');
			}else{
				$this->_update_email_settings('email');
			}
		}else{
			$this->load->module('layouts');
			$this->load->library('template');
			$data['form'] = TRUE;
			$this->template->title(lang('settings').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));			
			if($this->uri->segment(3) == 'default'){
				$data['page'] = lang('default_settings');
				
				$data['destination_defaults'] = $this->settings_model->get_all_records($table = 'users', $array = array(
				'id' => $this->session->userdata('user_id')), $join_table = 'mst_destinations', $join_criteria = 'mst_destinations.destination_id=users.destination_id','id');
				
				$data['vessel_defaults'] = $this->settings_model->get_all_records($table = 'users', $array = array(
				'id' => $this->session->userdata('user_id')), $join_table = 'mst_vessels', $join_criteria = 'mst_vessels.vessel_id=users.vessel_id','id');
			
			
				$data['destinations'] = $this->settings_model->get_all_records($table = 'mst_destinations', $array = array(
				'destination_id >' => '0', 'deleted' => 0), $join_table = '', $join_criteria = '','destination_name');
				
				$data['vessels'] = $this->settings_model->get_all_records($table = 'mst_vessels', $array = array(
				'vessel_id >' => '0', 'vessel_status <' => 2, 'deleted' => 0), $join_table = '', $join_criteria = '','vessel_name');
				
				$setting = 'default';
			}elseif ($this->uri->segment(3) == 'system') {
				$data['page'] = lang('system_settings');
				$setting = 'system';
			}else{
				$data['page'] = lang('email_settings');
				$setting = 'email';
			}
			$this->template
			->set_layout('users')
			->build($setting,isset($data) ? $data : NULL);
		}
	}
	
	private function _update_default_settings($setting){
			$this->_demo_mode('settings/update/'.$setting);

		$this->load->library('form_validation');
		$this->form_validation->set_rules('destination_id', 'Destination ID', 'required');
		$this->form_validation->set_rules('vessel_id', 'Vessel ID', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message', lang('settings_update_failed'));
			redirect('settings/update/'.$setting);
		}else{

			$form_data = array(
			                'destination_id' => $this->input->post('destination_id'),
			                'vessel_id' => $this->input->post('vessel_id')

			                );
			
			$this->db->where('id', $this->session->userdata('user_id'))->update('users', $form_data); 
			$this->session->set_userdata('vessel_active', $this->input->post('vessel_id'));
			$this->session->set_userdata('destination_from_active', $this->input->post('destination_id'));
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('settings_updated_successfully'));
			redirect('settings/update/'.$setting);
		}
		
	}
	
	
	
	private function _update_general_settings($setting){
			$this->_demo_mode('settings/update/'.$setting);

		$this->load->library('form_validation');
		$this->form_validation->set_rules('company_name', 'Company Name', 'required');
		$this->form_validation->set_rules('company_address', 'Company Address', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message', lang('settings_update_failed'));
			redirect('settings/update/'.$setting);
		}else{
			foreach ($_POST as $key => $value) {
				$data = array('value' => $value); 
				$this->db->where('config_key', $key)->update('config', $data); 
			}
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('settings_updated_successfully'));
			redirect('settings/update/'.$setting);
		}
		
	}
	private function _update_system_settings($setting){
		$this->_demo_mode('settings/update/'.$setting);

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('base_url', 'Base URL', 'required');
		$this->form_validation->set_rules('language', 'Default Language', 'required');
		$this->form_validation->set_rules('file_max_size', 'File Max Size', 'required');		
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message', lang('settings_update_failed'));
			$_POST = '';
			$this->update('system');
		}else{
		foreach ($_POST as $key => $value) {
				$data = array('value' => $value); 
				$this->db->where('config_key', $key)->update('config', $data); 
			}

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('settings_updated_successfully'));
			redirect('settings/update/'.$setting);
		}
		
	}
	private function _update_email_settings($setting){
		$this->_demo_mode('settings/update/'.$setting);

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('company_email', 'Company Email', 'required');
		$this->form_validation->set_rules('protocol', 'Email Protocol', 'required');		
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message', lang('settings_update_failed'));
			$_POST = '';
			$this->update('email');
		}else{
			$this->load->library('encrypt');
			$raw_smtp_pass =  $this->input->post('smtp_pass');
			$smtp_pass = $this->encrypt->encode($raw_smtp_pass);
			foreach ($_POST as $key => $value) {
				$data = array('value' => $value); 
				$this->db->where('config_key', $key)->update('config', $data); 
			}
		$data = array('value' => $smtp_pass); $this->db->where('config_key', 'smtp_pass')->update('config', $data); 
		

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('settings_updated_successfully'));
			redirect('settings/update/'.$setting);
		}
		
	}
	function update_payment_settings(){
		if ($this->input->post()) {
			$this->_demo_mode('settings/update/general');

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('default_currency', 'Default Currency', 'required');
		$this->form_validation->set_rules('default_currency_symbol', 'Default Currency Symbol', 'required');	
		$this->form_validation->set_rules('paypal_email', 'Paypal Email', 'required');		
		$this->form_validation->set_rules('paypal_cancel_url', 'Paypal Cancel', 'required');	
		$this->form_validation->set_rules('paypal_ipn_url', 'Paypal IPN', 'required');	
		$this->form_validation->set_rules('paypal_success_url', 'Paypal Success', 'required');	
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message', lang('settings_update_failed'));
			$_POST = '';
			$this->update('general');
		}else{
			foreach ($_POST as $key => $value) {
				$data = array('value' => $value); 
				$this->db->where('config_key', $key)->update('config', $data); 
			}


			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('settings_updated_successfully'));
			redirect('settings/update/general');
		}
	}else{
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message', lang('settings_update_failed'));
			redirect('settings/update/general');
	}
		
	}

	function update_email_templates(){
		if ($this->input->post()) {
			$this->_demo_mode('settings/update/email');

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('email_estimate_message', 'Estimate Message', 'required');
		$this->form_validation->set_rules('email_invoice_message', 'Invoice Message', 'required');	
		$this->form_validation->set_rules('reminder_message', 'Reminder Message', 'required');	
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message', lang('settings_update_failed'));
			$_POST = '';
			$this->update('email');
		}else{
			foreach ($_POST as $key => $value) {
				$data = array('value' => $value); 
				$this->db->where('config_key', $key)->update('config', $data); 
			}

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('settings_updated_successfully'));
			redirect('settings/update/email');
		}
	}else{
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message', lang('settings_update_failed'));
			redirect('settings/update/email');
	}
		
	}
	function upload_logo(){
		$this->_demo_mode('settings/update/general');

		if ($_FILES['userfile'] != "") {
				$config['upload_path']   = './resource/images/';
            			$config['allowed_types'] = 'jpg|jpeg|png';
            			$config['max_width']  = '300';
            			$config['max_height']  = '300';
            			$config['remove_spaces'] = TRUE;
            			$config['file_name']  = 'logo';
            			$config['overwrite']  = TRUE;
            			$config['max_size']      = '300';
            			$this->load->library('upload', $config);
						if ($this->upload->do_upload())
						{
							$data = $this->upload->data();
							$file_name = $data['file_name'];
							$data = array(
								'value' => $file_name);
							$this->db->where('config_key', 'company_logo')->update('config', $data); 
							$this->session->set_flashdata('response_status', 'success');
							$this->session->set_flashdata('message', lang('logo_changed'));
							redirect('settings/update/general');
						}else{
							$this->session->set_flashdata('response_status', 'error');
							$this->session->set_flashdata('message', lang('logo_upload_error'));
							redirect('settings/update/general');
						}
			}else{
							$this->session->set_flashdata('response_status', 'error');
							$this->session->set_flashdata('message', lang('file_upload_failed'));
							redirect('settings/update/general');
			}
	}
	function invoice_logo(){
		$this->_demo_mode('settings/update/general');

		if ($_FILES['userfile'] != "") {
				$config['upload_path']   = './resource/images/logos/';
            			$config['allowed_types'] = 'jpg|jpeg|png';
            			$config['remove_spaces'] = TRUE;
            			$config['file_name']  = 'invoice_logo';
            			$config['overwrite']  = TRUE;
            			$this->load->library('upload', $config);
						if ($this->upload->do_upload())
						{
							$data = $this->upload->data();
							$file_name = $data['file_name'];
							$data = array(
								'value' => $file_name);
							$this->db->where('config_key', 'invoice_logo')->update('config', $data); 
							$this->session->set_flashdata('response_status', 'success');
							$this->session->set_flashdata('message', lang('logo_changed'));
							redirect('settings/update/general');
						}else{
							$this->session->set_flashdata('response_status', 'error');
							$this->session->set_flashdata('message', lang('logo_upload_error'));
							redirect('settings/update/general');
						}
			}else{
							$this->session->set_flashdata('response_status', 'error');
							$this->session->set_flashdata('message', lang('file_upload_failed'));
							redirect('settings/update/general');
			}
	}
	function database()
	{
		if ($this->config->item('demo_mode') == 'FALSE') { 
		$this->load->dbutil();
		$prefs = array(
                'format'      => 'txt',             // gzip, zip, txt
                'filename'    => 'latest-freelancerbackup.sql',    // File name - NEEDED ONLY WITH ZIP FILES
                'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
                'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
                'newline'     => "\n"               // Newline character used in backup file
              );
			$backup =& $this->dbutil->backup($prefs);
			$this->load->helper('file');
			write_file('resource/database.backup/latest-freelancerbackup.sql', $backup); 
			$this->load->helper('download');
			force_download('latest-freelancerbackup.sql', $backup);
		}else{
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message',lang('demo_warning'));
			redirect('settings/update/general');
		}
	}
	function _demo_mode($redirect_url){
		if ($this->config->item('demo_mode') == 'TRUE') {
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message', lang('demo_warning'));
			redirect($redirect_url);
		}
	}
	
}

/* End of file settings.php */