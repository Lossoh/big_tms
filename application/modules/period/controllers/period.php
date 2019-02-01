<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Period extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('period_model');
	}

	function index()
	{
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('periods').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('periods');
		$this->session->set_userdata('page_header', 'master');		
		$this->session->set_userdata('page_detail', 'periods');
		$data['datatables'] = TRUE;
		$data['form'] = TRUE;
		$data['periods'] = $this->period_model->get_all_records($table = 'gl_period', $array = array(
			'rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','year,rowID','asc');				

		$this->template
		->set_layout('users')
		->build('periods',isset($data) ? $data : NULL);
	}
	
	 function save_periode(){
		/* $period_id=$this->input->post('period_id');
		$period_status=$this->input->post('period_status');
		
		$periode_status= array(
							   'period_status' => 'Y'
							);
		
        $this->db->where('rowID',$period_id)->update('gl_period', $periode_status); */
		
		//redirect('period');
		
		$periode_id=trim($this->input->post('periode_id'));
		$close_status=trim($this->input->post('close_status'));
		//if($this->input->post('close_status')==true){$close_status=='Y';} else {echo $close_status=='N';}
		//$close_status='X';
		

		$period_data = array(
						'close_status' =>	$close_status,
						'user_modified'	=>	$this->session->userdata('user_id'),
						'date_modified'	=>	date('Y-m-d'),
						'time_modified'	=>	date('H:i:s'),
					);
					
		$this->db->where('rowID',$periode_id)->update('gl_period', $period_data);
		redirect("period");
				
    }
	
	function create()
	{
		if ($this->input->post()) {
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
				$this->form_validation->set_rules('department_code', 'Department Code', 'required|xss_clean|max_length[2]|is_unique[sa_dep.dep_cd]');
				$this->form_validation->set_rules('department_name', 'Department Name', 'required|xss_clean|max_length[40]');
				if ($this->form_validation->run() == FALSE)
				{
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('error_in_form'));
					$_POST = '';
					$this->index();
				}else{		
					$department_data = array(
							'dep_cd'=>strtoupper($this->input->post('department_code')),
							'dep_name'=>strtoupper($this->input->post('department_name')),
							'user_created'=>$this->session->userdata('user_id'),
							'date_created'=>date('Y-m-d'),
							'time_created'=>date('H:i:s')							
			         );
					$this->db->insert('sa_dep', $department_data); 
					$department_id = $this->db->insert_id();

					$params['user_rowID'] = $this->tank_auth->get_user_id();
					$params['module'] = 'Departments';
					$params['module_field_id'] = $department_id;
					$params['activity'] = ucfirst('Added a new item '.$this->input->post('department_name'));
					$params['icon'] = 'fa-user';
					modules::run('activitylog/log',$params); //log activity

					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', lang('department_registered_successfully'));
					redirect('department');
				}
		}else{
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message', lang('error_in_form'));
			redirect('department');
		}
	}


}

/* End of file contacts.php */