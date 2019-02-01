<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('debtor_type_model','debtor_type');
	}
	
	function details()
	{		
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang(debtor_types).' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('debtor_types');
		$data['datatables'] = TRUE;
		$data['form'] = TRUE;
		$data['debtor_type'] = $this->debtor_type->debtor_type_details($this->uri->segment(4));

		$this->template
		->set_layout('users')
		->build('debtor_types',isset($data) ? $data : NULL);
	}

	function update()
	{
		if ($this->input->post()) {
		
		$this->load->library('form_validation');		
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('debtortype_type_cd', 'Type Code', 'required|xss_clean|max_length[6]');
		$this->form_validation->set_rules('debtortype_name', 'Type Name', 'required|xss_clean');
		$this->form_validation->set_rules('debtortype_receivable_acc', 'Receivable account', 'required|xss_clean');
		$this->form_validation->set_rules('debtortype_advance_acc', 'Advance account', 'required|xss_clean');
		$this->form_validation->set_rules('debtortype_deposit_acc', 'Deposit account', 'required|xss_clean');
		
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('error_in_form'));
				redirect('debtor_type');
		}else{	
			$debtor_type_id =  $this->input->post('row_id');
			$debtor_type_data = array(
							'type_cd'=>strtoupper($this->input->post('debtortype_type_cd')),
							'name'=>strtoupper($this->input->post('debtortype_name')),
							'receivable_acc'=>strtoupper($this->input->post('debtortype_receivable_acc')),
							'advance_acc'=>strtoupper($this->input->post('debtortype_advance_acc')),
							'deposit_acc'=>strtoupper($this->input->post('debtortype_deposit_acc')),
							'rounding_acc'=>strtoupper($this->input->post('debtortype_rounding_acc')),
							'adm_acc'=>strtoupper($this->input->post('debtortype_adm_acc')),
							'user_modified'=>$this->session->userdata('user_id'),
							'date_modified'=>date('Y-m-d'),
							'time_modified'=>date('H:i:s')							
						);

			$this->db->where('rowID',$debtor_type_id)->update('sa_debtor_type', $debtor_type_data); 

					$params['user_rowID'] = $this->tank_auth->get_user_id();
					$params['module'] = 'Debtor_type';
					$params['module_field_id'] = $debtor_type_id;
					$params['activity'] = ucfirst('Updated System User : '.$this->input->post('debtortype_name'));
					$params['icon'] = 'fa-edit';
					modules::run('activitylog/log',$params); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('debtortype_edited_successfully'));
			redirect('debtor_type');
		}
		}else{

		$data['coas'] = $this->debtor_type->get_coa($table = 'gl_coa', $array = array(
			'rowID >' => '0', 'deleted'=>'0', 'acc_transition'=>'Y'), $join_table = '', $join_criteria = '','acc_cd');	
		$data['debtor_type_details'] = $this->debtor_type->debtor_type_details($this->uri->segment(4));
		$this->load->view('modal/edit_debtor_type',$data);
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

			$debtor_type_id = $this->input->post('row_id', TRUE);
			$debtor_type_data = array(
							'deleted'=>1,
							'user_deleted'=>$this->session->userdata('user_id'),
							'date_deleted'=>date('Y-m-d'),
							'time_deleted'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$debtor_type_id)->update('sa_debtor_type', $debtor_type_data); 

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('debtortype_deleted_successfully'));
			redirect('debtor_type');
		}else{
			$data['debtor_type_id'] = $this->uri->segment(4);
			$data['debtor_type_details'] = $this->debtor_type->debtor_type_details($this->uri->segment(4));
			$this->load->view('modal/delete_debtor_type',$data);

		}
	}
}

/* End of file view.php */