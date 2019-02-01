<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('expense_model','expense');
	}
	
	function update()
	{
		if ($this->input->post()) {
		
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('expenses_name', 'Expenses Name', 'required|xss_clean|max_length[40]');
			
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('error_in_form'));
				redirect('expense');
		}else{	
			$expense_id =  $this->input->post('row_id');
			$data_expense = array(
							'descs'=>strtoupper($this->input->post('expenses_name')),
							'user_modified'=>$this->session->userdata('user_id'),
							'date_modified'=>date('Y-m-d'),
							'time_modified'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$expense_id)->update('sa_expense', $data_expense); 

					$params['user_rowID'] = $this->tank_auth->get_user_id();
					$params['module'] = 'Expense';
					$params['module_field_id'] = $expense_id;
					$params['activity'] = ucfirst('Updated System User : '.$this->input->post('expenses_name'));
					$params['icon'] = 'fa-edit';
					modules::run('activitylog/log',$params); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('expenses_edited_successfully'));
			redirect('expense');
		}
		}else{

		$data['expense_details'] = $this->expense->expense_details($this->uri->segment(4));
		$this->load->view('modal/edit_expense',$data);
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

			$expense_id = $this->input->post('row_id', TRUE);
			$expense_data = array(
							'deleted'=>1,
							'user_deleted'=>$this->session->userdata('user_id'),
							'date_deleted'=>date('Y-m-d'),
							'time_deleted'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$expense_id)->update('sa_expense', $expense_data); 

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('expense_deleted_successfully'));
			redirect('expense');
		}else{
			$data['expense_id'] = $this->uri->segment(4);
			$data['expense_details'] = $this->expense->expense_details($this->uri->segment(4));
			$this->load->view('modal/delete_expense',$data);

		}
	}
}

/* End of file view.php */