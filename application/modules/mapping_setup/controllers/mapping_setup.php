<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mapping_setup extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mapping_setup_model');
	}

	function index()
	{
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('mapping_setups').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('mapping_setups');
		$data['mapping_setups'] = $this->mapping_setup_model->get_all_records_list();
		
		$this->template
		->set_layout('users')
		->build('mapping_setups',isset($data) ? $data : NULL);
	}
	
	function update()
	{
		if ($this->input->post()) {
			
			$mapping_setup_id =  $this->input->post('row_id');
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
			$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
			$this->form_validation->set_rules('mapping_setup_trans_acc', 'Transitory Cash/Bank Account', 'required|xss_clean');
			$this->form_validation->set_rules('mapping_setup_cash_opr_acc', 'Cash for Operational', 'required|xss_clean');
			$this->form_validation->set_rules('mapping_setup_bank_receipt_acc', 'Default Bank Receipt', 'required|xss_clean');
			$this->form_validation->set_rules('mapping_setup_bank_payment_acc', 'Default Bank Payment', 'required|xss_clean');
			$this->form_validation->set_rules('mapping_setup_cash_adv', 'Debtor for Cash advance', 'required|xss_clean');
			$this->form_validation->set_rules('mapping_setup_default_uom', 'Default UOM', 'required|xss_clean');
			$this->form_validation->set_rules('mapping_setup_cogs_journal_to', 'Cogs Journal To', 'required|xss_clean');
			
			if ($this->form_validation->run() == FALSE)
			{
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('error_in_form'));
					redirect('mapping_setup/update/'.$mapping_setup_id);
			}else{	
				
				$mapping_setup_data = array(
								'gl_coaID_trans_acc'=>$this->input->post('mapping_setup_trans_acc'),
								'gl_coaID_cash_opr_acc'=>$this->input->post('mapping_setup_cash_opr_acc'),
								'gl_coaID_bank_receipt_acc'=>$this->input->post('mapping_setup_bank_receipt_acc'),
								'gl_coaID_bank_payment_acc'=>$this->input->post('mapping_setup_bank_payment_acc'),
								'employeeID_cash_adv'=>$this->input->post('mapping_setup_cash_adv'),
								'uomID_uom'=>$this->input->post('mapping_setup_default_uom'),
								'cogs_journal_to'=>$this->input->post('mapping_setup_cogs_journal_to'),
								'general_jrn'=>strtoupper($this->input->post('mapping_setup_general_journal')),
								'memorial_jrn'=>strtoupper($this->input->post('mapping_setup_memorial_journal')),
								'bank_rcp'=>strtoupper($this->input->post('mapping_setup_bank_receipt')),
								'bank_pay'=>strtoupper($this->input->post('mapping_setup_bank_payment')),
								'cash_rcp'=>strtoupper($this->input->post('mapping_setup_cash_receipt')),
								'cash_pay'=>strtoupper($this->input->post('mapping_setup_cash_payment')),
								'wo'=>strtoupper($this->input->post('mapping_setup_wo')),
								'po'=>strtoupper($this->input->post('mapping_setup_po')),
								'co'=>strtoupper($this->input->post('mapping_setup_co')),
								'jo'=>strtoupper($this->input->post('mapping_setup_jo')),
								'do'=>strtoupper($this->input->post('mapping_setup_do')),
								'pod'=>strtoupper($this->input->post('mapping_setup_pod')),
								'cash_adv_bgt'=>strtoupper($this->input->post('mapping_setup_cab')),
								'cash_adv_apv'=>strtoupper($this->input->post('mapping_setup_caa')),
								'cash_adv_stl'=>strtoupper($this->input->post('mapping_setup_cass')),
								'closing_jo'=>strtoupper($this->input->post('mapping_setup_cjo')),
								'cst_adv'=>strtoupper($this->input->post('mapping_setup_ca')),
								'ar_inv'=>strtoupper($this->input->post('mapping_setup_ai')),
								'ap_inv'=>strtoupper($this->input->post('mapping_setup_api')),
								'user_modified'=>$this->session->userdata('user_id'),
								'date_modified'=>date('Y-m-d'),
								'time_modified'=>date('H:i:s')							
							);
							
				$this->db->where('rowID',$mapping_setup_id)->update('sa_spec', $mapping_setup_data); 

				$params['user_rowID'] = $this->tank_auth->get_user_id();
				$params['module'] = 'Mapping Setup';
				$params['module_field_id'] = $mapping_setup_id;
				$params['activity'] = ucfirst('Updated System Mapping Setup : '.$this->input->post('mapping_setup_trans_acc'));
				$params['icon'] = 'fa-edit';
				modules::run('activitylog/log',$params); //log activity

				$this->session->set_flashdata('response_status', 'success');
				$this->session->set_flashdata('message', lang('mapping_setup_edited_successfully'));
				redirect('mapping_setup'); 
			}
		}else{

		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang(mapping_setups).' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('mapping_setups');
		$data['datatables'] = TRUE;
		$data['form'] = TRUE;
		$data['mapping_setup_details'] = $this->mapping_setup_model->mapping_setup_details($this->uri->segment(3));
				
		$data['gl_coas'] = $this->mapping_setup_model->get_all_records($table = 'gl_coa', $array = array(
			'rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','acc_cd','asc');
			
		$data['employees'] = $this->mapping_setup_model->get_all_records($table = 'sa_employee', $array = array(
			'rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','employee_cd','asc');

		$data['uoms'] = $this->mapping_setup_model->get_all_records($table = 'sa_uom', $array = array(
			'rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','uom_cd','asc');

		$this->template
		->set_layout('users')
		->build('edit_mapping_setup',isset($data) ? $data : NULL);	
		
		}
	}
	
}

/* End of file contacts.php */