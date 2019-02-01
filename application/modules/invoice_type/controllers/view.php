<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('invoice_type_model','invoice_type');
	}
	
	function update()
	{
		if ($this->input->post()) {
		
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
				$this->form_validation->set_rules('invoice_type_name', 'Name', 'required|xss_clean');
			
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('error_in_form'));
				redirect('invoice_type');
		}else{	
			$invoice_type_id =  $this->input->post('row_id');
			$data_invoice_type = array(
							'inv_type_name'=>strtoupper($this->input->post('invoice_type_name')),
							'user_modified'=>$this->session->userdata('user_id'),
							'date_modified'=>date('Y-m-d'),
							'time_modified'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$invoice_type_id)->update('sa_invoice_type', $data_invoice_type); 

					$params['user_rowID'] = $this->tank_auth->get_user_id();
					$params['module'] = 'Invoice Type';
					$params['module_field_id'] = $invoice_type_id;
					$params['activity'] = ucfirst('Updated System Invoice Type : '.$this->input->post('invoice_type_name'));
					$params['icon'] = 'fa-edit';
					modules::run('activitylog/log',$params); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('invoice_type_edited_successfully'));
			redirect('invoice_type');
		}
		}else{

		$data['invoice_type_details'] = $this->invoice_type->invoice_type_details($this->uri->segment(4));
		$this->load->view('modal/edit_invoice_type',$data);
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

			$invoice_type_id = $this->input->post('row_id', TRUE);
			$invoice_type_data = array(
							'deleted'=>1,
							'user_deleted'=>$this->session->userdata('user_id'),
							'date_deleted'=>date('Y-m-d'),
							'time_deleted'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$invoice_type_id)->update('sa_invoice_type',$invoice_type_data); 

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('invoice_type_deleted_successfully'));
			redirect('invoice_type');
		}else{
			$data['invoice_type_id'] = $this->uri->segment(4);
			$data['invoice_type_details'] = $this->invoice_type->invoice_type_details($this->uri->segment(4));
			$this->load->view('modal/delete_invoice_type',$data);

		}
	}
}

/* End of file view.php */