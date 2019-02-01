<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('client_model','userxx');
	}
	function details()
	{		
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('clients').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('clients');
		$data['datatables'] = TRUE;
		$data['form'] = TRUE;
		$data['client_details'] = $this->userxx->client_details($this->uri->segment(4));
		$data['client_invoices'] = $this->userxx->client_invoices($this->uri->segment(4));
		$data['client_projects'] = $this->userxx->client_projects($this->uri->segment(4));
		$data['client_contacts'] = $this->userxx->client_contacts($this->uri->segment(4));
		$data['countries'] = $this->AppModel->get_all_records($table = 'countries',
		$array = array(
			'id >' => '0'),$join_table = '',$join_criteria = '','id');
		$this->template
		->set_layout('users')
		->build('client_details',isset($data) ? $data : NULL);
	}
	function clientinvoices()
	{		
		$data['userxx_invoices'] = $this->userxx->userxx_invoices($this->uri->segment(4));
		$this->load->view('client_invoices',isset($data) ? $data : NULL);
	}
	function clientprojects()
	{	
		$data['userxx_projects'] = $this->userxx->userxx_projects($this->uri->segment(4));
		$this->load->view('client_projects',isset($data) ? $data : NULL);
	}
	function payments()
	{		
		$data['userxx_payments'] = $this->userxx->userxx_payments($this->uri->segment(4));
		$this->load->view('client_payments',isset($data) ? $data : NULL);
	}
	function activities()
	{		
		$data['userxx_activities'] = $this->userxx->userxx_activities($this->uri->segment(4),$limit = 10);
		$this->load->view('client_activities',isset($data) ? $data : NULL);
	}
	function delete()
	{
		if ($this->input->post()) {

			$company = $this->input->post('company', TRUE);
			$company_invoices = $this->AppModel->get_all_records($table = 'invoices',
								$array = array(
								'client' => $company),$join_table = '',$join_criteria = '','date_saved');
			if (!empty($company_invoices)) {
				foreach ($company_invoices as $invoice) {
					$this->db->where('invoice_id',$invoice->inv_id)->delete('items'); //delete invoice items
				}
			}

			$this->db->where('client',$company)->delete('invoices'); //delete invoices

			$this->db->where('paid_by',$company)->delete('payments'); //delete invoice payments

			$this->db->where(array('module'=>'Clients', 'module_field_id' => $company))->delete('activities'); //clear invoice activities
			$this->db->where('co_id',$company)->delete('companies'); //delete invoice items
			$company_contacts = $this->AppModel->get_all_records($table = 'account_details',
								$array = array(
								'company' => $company),$join_table = '',$join_criteria = '','id');
			if (!empty($company_contacts)) {
				foreach ($company_contacts as $contact) {
					$this->db->set('company','-');
					$this->db->where('company',$company)->update('account_details'); //set contacts to blank
				}
			}

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('company_deleted_successfully'));
			redirect('companies');
		}else{
			$data['company_id'] = $this->uri->segment(4);
			$this->load->view('modal/delete',$data);

		}
	}
}

/* End of file view.php */