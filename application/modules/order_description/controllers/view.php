<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('order_description_model','order_description');
	}
	
	function update()
	{
		if ($this->input->post()) {
		
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('order_description_name', 'Name', 'required|xss_clean');
			
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('error_in_form'));
				redirect('order_description');
		}else{	
			$order_description_id =  $this->input->post('row_id');
			$data_order_description = array(
							'descs'=>strtoupper($this->input->post('order_description_name')),
							'user_modified'=>$this->session->userdata('user_id'),
							'date_modified'=>date('Y-m-d'),
							'time_modified'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$order_description_id)->update('sa_order_descs', $data_order_description); 

			$params['user_rowID'] = $this->tank_auth->get_user_id();
			$params['module'] = 'Order Description';
			$params['module_field_id'] = $order_description_id;
			$params['activity'] = ucfirst('Updated System Order Description : '.$this->input->post('order_description_name'));
			$params['icon'] = 'fa-edit';
			modules::run('activitylog/log',$params); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('order_description_edited_successfully'));
			redirect('order_description');
		}
		}else{

		$data['order_description_details'] = $this->order_description->order_description_details($this->uri->segment(4));
		$this->load->view('modal/edit_order_description',$data);
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

			$order_description_id = $this->input->post('row_id', TRUE);
			$order_description_data = array(
							'deleted'=>1,
							'user_deleted'=>$this->session->userdata('user_id'),
							'date_deleted'=>date('Y-m-d'),
							'time_deleted'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$order_description_id)->update('sa_order_descs',$order_description_data); 

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('order_description_deleted_successfully'));
			redirect('order_description');
		}else{
			$data['order_description_id'] = $this->uri->segment(4);
			$data['order_description_details'] = $this->order_description->order_description_details($this->uri->segment(4));
			$this->load->view('modal/delete_order_description',$data);

		}
	}
}

/* End of file view.php */