<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('employee_model','employee');
	}
	
		
	function update()
	{
		if ($this->input->post()) {
			
		$employee_id =  $this->input->post('row_id');
		$this->load->library('form_validation');

			$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
				$this->form_validation->set_rules('employee_id_type', 'ID Type', 'required|xss_clean');
				$this->form_validation->set_rules('employee_id_number', 'ID Number', 'required|xss_clean|numeric');
				$this->form_validation->set_rules('employee_name', 'Name', 'required|xss_clean');
					
			if ($this->form_validation->run() == FALSE)
			{
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('error_in_form'));
					redirect('employee/view/update/'.$employee_id);
			}else{	
				
				$employee_data = array(
							'debtor_name'=>strtoupper($this->input->post('employee_name')),
							'id_type'=>strtoupper($this->input->post('employee_id_type')),
							'id_no'=>strtoupper($this->input->post('employee_id_number')),
							'address1'=>ucwords($this->input->post('employee_address1')),
							'address2'=>ucwords($this->input->post('employee_address2')),
							'address3'=>ucwords($this->input->post('employee_address3')),
							'post_cd'=>$this->input->post('employee_postal_code'),
							'hp_no1'=>$this->input->post('employee_hp1'),
							'hp_no2'=>$this->input->post('employee_hp2'),
							'telp_no1'=>$this->input->post('employee_phone1'),
							'telp_no2'=>$this->input->post('employee_phone2'),
							'email'=>$this->input->post('employee_email'),
							'sex'=>$this->input->post('employee_gender'),
							'pob'=>ucwords($this->input->post('employee_pob')),
							'dob'=>$this->input->post('employee_dob'),
							'npwp_no'=>$this->input->post('employee_npwp'),
							'npwp_name'=>$this->input->post('employee_npwp_name'),
							'reg_date'=>$this->input->post('employee_npwp_registered'),
							'npwp_address1'=>ucwords($this->input->post('employee_npwp_address1')),
							'npwp_address2'=>ucwords($this->input->post('employee_npwp_address2')),
							'npwp_address3'=>ucwords($this->input->post('employee_npwp_address3')),
							'bank_acc1'=>$this->input->post('employee_bank_account_no1'),
							'bank_acc_name1'=>ucwords($this->input->post('employee_bank_account_name1')),
							'bank_name1'=>ucwords($this->input->post('employee_bank_account_bank1')),
							'debtor_type_rowID'=>$this->input->post('employee_code'),
							'user_modified'=>$this->session->userdata('user_id'),
							'date_modified'=>date('Y-m-d'),
							'time_modified'=>date('H:i:s')							
							);
							
				$this->db->where('rowID',$employee_id)->update('sa_debtor', $employee_data); 

						$params['user_rowID'] = $this->tank_auth->get_user_id();
						$params['module'] = 'Employee';
						$params['module_field_id'] = $employee_id;
						$params['activity'] = ucfirst('Updated System User : '.$this->input->post('employee_name'));
						$params['icon'] = 'fa-edit';
						modules::run('activitylog/log',$params); //log activity

				$this->session->set_flashdata('response_status', 'success');
				$this->session->set_flashdata('message', lang('employee_edited_successfully'));
				redirect('employee'); 
			}
		}else{

		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang(employees).' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('employees');
		$data['datatables'] = TRUE;
		$data['form'] = TRUE;
		$data['employee_details'] = $this->employee->employee_details($this->uri->segment(4));
		$data['debtors'] = $this->employee->get_all_records($table = 'sa_debtor_type', $array = array(
		'rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','rowID','desc');
		$this->template
		->set_layout('users')
		->build('edit_employee',isset($data) ? $data : NULL);	
		
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

			$employee_id = $this->input->post('row_id', TRUE);
			$employee_data = array(
							'deleted'=>1,
							'user_deleted'=>$this->session->userdata('user_id'),
							'date_deleted'=>date('Y-m-d'),
							'time_deleted'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$employee_id)->update('sa_debtor', $employee_data); 

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('employee_deleted_successfully'));
			redirect('employee');
		}else{
			$data['employee_id'] = $this->uri->segment(4);
			$data['employee_details'] = $this->employee->employee_details($this->uri->segment(4));
			
			$this->load->view('modal/delete_employee',$data);

		}
	}
}

/* End of file view.php */