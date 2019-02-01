<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('driver_model','driver');
	}
	
		
	function update()
	{
		if ($this->input->post()) {
			
		$driver_id =  $this->input->post('row_id');
		$this->load->library('form_validation');

			$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
				$this->form_validation->set_rules('driver_id_type', 'ID Type', 'required|xss_clean');
				$this->form_validation->set_rules('driver_id_number', 'ID Number', 'required|xss_clean|numeric');
				$this->form_validation->set_rules('driver_name', 'Name', 'required|xss_clean');
					
			if ($this->form_validation->run() == FALSE)
			{
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('error_in_form'));
					redirect('driver/view/update/'.$driver_id);
			}else{	
				
				$driver_data = array(
							'debtor_name'=>strtoupper($this->input->post('driver_name')),
							'id_type'=>strtoupper($this->input->post('driver_id_type')),
							'id_no'=>strtoupper($this->input->post('driver_id_number')),
							'address1'=>ucwords($this->input->post('driver_address1')),
							'address2'=>ucwords($this->input->post('driver_address2')),
							'address3'=>ucwords($this->input->post('driver_address3')),
							'post_cd'=>$this->input->post('driver_postal_code'),
							'hp_no1'=>$this->input->post('driver_hp1'),
							'hp_no2'=>$this->input->post('driver_hp2'),
							'telp_no1'=>$this->input->post('driver_phone1'),
							'telp_no2'=>$this->input->post('driver_phone2'),
							'email'=>$this->input->post('driver_email'),
							'sex'=>$this->input->post('driver_gender'),
							'pob'=>ucwords($this->input->post('driver_pob')),
							'dob'=>$this->input->post('driver_dob'),
							'npwp_no'=>$this->input->post('driver_npwp'),
							'npwp_name'=>$this->input->post('driver_npwp_name'),
							'reg_date'=>$this->input->post('driver_npwp_registered'),
							'npwp_address1'=>ucwords($this->input->post('driver_npwp_address1')),
							'npwp_address2'=>ucwords($this->input->post('driver_npwp_address2')),
							'npwp_address3'=>ucwords($this->input->post('driver_npwp_address3')),
							'bank_acc1'=>$this->input->post('driver_bank_account_no1'),
							'bank_acc_name1'=>ucwords($this->input->post('driver_bank_account_name1')),
							'bank_name1'=>ucwords($this->input->post('driver_bank_account_bank1')),
							'debtor_type_rowID'=>$this->input->post('driver_code'),
							'driving_license'=>$this->input->post('driver_driving_license'),
							'driving_license_no'=>ucwords($this->input->post('driver_driving_license_no')),
							'driving_license_expired'=>$this->input->post('driver_driving_license_expired'),
							'user_modified'=>$this->session->userdata('user_id'),
							'date_modified'=>date('Y-m-d'),
							'time_modified'=>date('H:i:s')							
							);
							
				$this->db->where('rowID',$driver_id)->update('sa_debtor', $driver_data); 

				$params['user_rowID'] = $this->tank_auth->get_user_id();
				$params['module'] = 'Debtor';
				$params['module_field_id'] = $driver_id;
				$params['activity'] = ucfirst('Updated System User : '.$this->input->post('driver_name'));
				$params['icon'] = 'fa-edit';
				modules::run('activitylog/log',$params); //log activity

				$this->session->set_flashdata('response_status', 'success');
				$this->session->set_flashdata('message', lang('driver_edited_successfully'));
				redirect('driver'); 
			}
		}else{

		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang(drivers).' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('drivers');
		$data['datatables'] = TRUE;
		$data['form'] = TRUE;
		$data['driver_details'] = $this->driver->driver_details($this->uri->segment(4));
		$data['debtors'] = $this->driver->get_all_records($table = 'sa_debtor_type', $array = array(
		'rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','rowID','desc');
		$this->template
		->set_layout('users')
		->build('edit_driver',isset($data) ? $data : NULL);	
		
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

			$driver_id = $this->input->post('row_id', TRUE);
			$driver_data = array(
							'deleted'=>1,
							'user_deleted'=>$this->session->userdata('user_id'),
							'date_deleted'=>date('Y-m-d'),
							'time_deleted'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$driver_id)->update('sa_debtor', $driver_data); 

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('driver_deleted_successfully'));
			redirect('driver');
		}else{
			$data['driver_id'] = $this->uri->segment(4);
			$data['driver_details'] = $this->driver->driver_details($this->uri->segment(4));
			
			$this->load->view('modal/delete_driver',$data);

		}
	}
}

/* End of file view.php */