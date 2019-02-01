<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Employee extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('employee_model');
		
	}

	function index()
	{
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('employees').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('employees');
		$this->session->set_userdata('page_header', 'master');		
		$this->session->set_userdata('page_detail', 'employees');
		$data['datatables'] = TRUE;
		$data['form'] = TRUE;
		$data['employees'] = $this->employee_model->get_all_records($table = 'sa_debtor', $array = array(
			'type =' => 'E','rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','debtor_cd');
		
		$this->template
		->set_layout('users')
		->build('employees',isset($data) ? $data : NULL);
	}
	
	function create()
	{
		
		if ($this->input->post()) {
				
				$year=date('Y');
				$hasil= ((int)$this->employee_model->select_max_id('sa_debtor',$array = array(
					'year' => $year,'type' => 'E'),'code'))+1;
					
				//$row_id=(int)substr($hasil,0,4);
				$code=sprintf("%04s",$hasil);
				$employee_code=$year.sprintf("%04s",$hasil);
				
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
				$this->form_validation->set_rules('employee_id_type', 'ID Type', 'required|xss_clean');
				$this->form_validation->set_rules('employee_id_number', 'ID Number', 'required|xss_clean|numeric');
				$this->form_validation->set_rules('employee_name', 'Name', 'required|xss_clean');
				
				if ($this->form_validation->run() == FALSE)
				{
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('error_in_form'));
					redirect('employee/create');
				}else{		
					$employee_data = array(
							'code' => $code,
							'year'=>$year,
							'type'=>'E',
							'debtor_cd'=>$employee_code,
							'debtor_name'=>strtoupper($this->input->post('employee_name')),
							'class'=>'I',
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
							'user_created'=>$this->session->userdata('user_id'),
							'date_created'=>date('Y-m-d'),
							'time_created'=>date('H:i:s')							
			         );
					 
					
					$this->db->insert('sa_debtor', $employee_data); 
					$employee_id = $this->db->insert_id();

					$params['user_rowID'] = $this->tank_auth->get_user_id();
					$params['module'] = 'Employees';
					$params['module_field_id'] = $employee_id;
					$params['activity'] = ucfirst('Added a new Employee '.$this->input->post('employee_name'));
					$params['icon'] = 'fa-user';
					modules::run('activitylog/log',$params); //log activity

					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', lang('employee_registered_successfully'));
					redirect('employee');
				}
		}else{
			$this->load->module('layouts');
			$this->load->library('template');
			$data['datatables'] = TRUE;
			$data['form'] = TRUE;
			
			$data['debtors'] = $this->employee_model->get_all_records($table = 'sa_debtor_type', $array = array(
				'rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','rowID','desc');
				
			$this->template
			->set_layout('users')
			->build('create_employee',isset($data) ? $data : NULL);
		}
	}



}

/* End of file contacts.php */