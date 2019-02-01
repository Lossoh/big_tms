<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('work_order_model','work_order');
	}
	
	function update()
	{
		if ($this->input->post()) {
		
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('work_order_date', 'WO Date', 'required|xss_clean');
		$this->form_validation->set_rules('work_order_ref_no', 'Ref No', 'required|xss_clean|numeric');
		$this->form_validation->set_rules('work_order_debtor', 'Debtor', 'required|xss_clean');
		$this->form_validation->set_rules('work_order_ex_vessel', 'Ex. Vessel', 'required|xss_clean');
		$this->form_validation->set_rules('work_order_port', 'Port', 'required|xss_clean');
			
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('error_in_form'));
				redirect('work_order');
		}else{	
			$work_order_id =  $this->input->post('row_id');
			$data_work_order = array(
							'ref_no'=>$this->input->post('work_order_ref_no'),
							'wo_date'=>$this->input->post('work_order_date'),
							'debtor_rowID'=>$this->input->post('work_order_debtor'),
							'vessel_no'=>$this->input->post('work_order_vessel_no'),
							'vessel_name'=>strtoupper($this->input->post('work_order_ex_vessel')),
							'port_rowID'=>$this->input->post('work_order_port'),
							'user_modified'=>$this->session->userdata('user_id'),
							'date_modified'=>date('Y-m-d'),
							'time_modified'=>date('H:i:s')							
			            );

			$this->db->where('wo_no',$work_order_id)->update('tr_wo_trx_hdr', $data_work_order);
			
			$params['user_rowID'] = $this->tank_auth->get_user_id();
			$params['module'] = 'Work Order';
			$params['module_field_id'] = $work_order_id;
			$params['activity'] = ucfirst('Updated System Work Order category : '.$work_order_id);
			$params['icon'] = 'fa-edit';
			modules::run('activitylog/log',$params); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('work_order_edited_successfully'));
			redirect('work_order');
		}
		}else{

			$data['work_order_details'] = $this->work_order->work_order_details($this->uri->segment(4));
			
			$data['debtors'] = $this->work_order->get_all_records($table = 'sa_debtor', $array = array(
			'rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '','debtor_cd','asc'); 
		
			$data['ports'] = $this->work_order->get_all_records($table = 'sa_port', $array = array(
			'rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '','port_cd','asc');
			
			$this->load->view('modal/edit_work_order',$data);
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

			$work_order_id = $this->input->post('row_id', TRUE);
			$work_order_data = array(
							'deleted'=>1,
							'user_deleted'=>$this->session->userdata('user_id'),
							'date_deleted'=>date('Y-m-d'),
							'time_deleted'=>date('H:i:s')							
			            );

			$this->db->where('wo_no',$work_order_id)->update('tr_wo_trx_hdr',$work_order_data); 

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('work_order_deleted_successfully'));
			redirect('work_order');
		}else{
			$data['work_order_id'] = $this->uri->segment(4);
			$data['work_order_details'] = $this->work_order->work_order_details($this->uri->segment(4));
			$this->load->view('modal/delete_work_order',$data);

		}
	}
}

/* End of file view.php */