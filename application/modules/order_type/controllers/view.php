<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('order_type_model','order_type');
	}
	
	function update()
	{
		if ($this->input->post()) {
		
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('order_type_name', 'Name', 'required|xss_clean|max_length[40]');
			
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('error_in_form'));
				redirect('expense');
		}else{	
			$order_type_id =  $this->input->post('row_id');
			$data_order_type = array(
							'descs'=>strtoupper($this->input->post('order_type_name')),
							'user_modified'=>$this->session->userdata('user_id'),
							'date_modified'=>date('Y-m-d'),
							'time_modified'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$order_type_id)->update('sa_order_type', $data_order_type); 

					$params['user_rowID'] = $this->tank_auth->get_user_id();
					$params['module'] = 'Order Type';
					$params['module_field_id'] = $order_type_id;
					$params['activity'] = ucfirst('Updated System Order Type: '.$this->input->post('order_type_name'));
					$params['icon'] = 'fa-edit';
					modules::run('activitylog/log',$params); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('order_type_edited_successfully'));
			redirect('order_type');
		}
		}else{

		$data['order_type_details'] = $this->order_type->order_type_details($this->uri->segment(4));
		$this->load->view('modal/edit_order_type',$data);
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

			$order_type_id = $this->input->post('row_id', TRUE);
			$order_type_data = array(
							'deleted'=>1,
							'user_deleted'=>$this->session->userdata('user_id'),
							'date_deleted'=>date('Y-m-d'),
							'time_deleted'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$order_type_id)->update('sa_order_type', $order_type_data); 

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('order_type_deleted_successfully'));
			redirect('order_type');
		}else{
			$data['order_type_id'] = $this->uri->segment(4);
			$data['order_type_details'] = $this->order_type->order_type_details($this->uri->segment(4));
			$this->load->view('modal/delete_order_type',$data);

		}
	}
}

/* End of file view.php */