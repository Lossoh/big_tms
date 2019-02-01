<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('vehicle_category_model','vehicle_category');
	}
	
	function update()
	{
		if ($this->input->post()) {
		
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
				$this->form_validation->set_rules('vehicle_category_name', 'Vehicle Category Name', 'required|xss_clean');
			
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('error_in_form'));
				redirect('vehicle_category');
		}else{	
			$vehicle_category_id =  $this->input->post('row_id');
			$data_vehicle_category = array(
							'type_name'=>strtoupper($this->input->post('vehicle_category_name')),
							'weight'=>$this->input->post('vehicle_category_weight'),
							'max_weight'=>$this->input->post('vehicle_category_max_weight'),
							'min_weight'=>$this->input->post('vehicle_category_min_weight'),
							'user_modified'=>$this->session->userdata('user_id'),
							'date_modified'=>date('Y-m-d'),
							'time_modified'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$vehicle_category_id)->update('sa_vehicle_type', $data_vehicle_category); 

					$params['user_rowID'] = $this->tank_auth->get_user_id();
					$params['module'] = 'Vehicle_category';
					$params['module_field_id'] = $vehicle_category_id;
					$params['activity'] = ucfirst('Updated System Vehicle category : '.$this->input->post('vehicle_category_name'));
					$params['icon'] = 'fa-edit';
					modules::run('activitylog/log',$params); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('vehicle_category_edited_successfully'));
			redirect('vehicle_category');
		}
		}else{

		$data['vehicle_category_details'] = $this->vehicle_category->vehicle_category_details($this->uri->segment(4));
		$this->load->view('modal/edit_vehicle_category',$data);
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

			$vehicle_category_id = $this->input->post('row_id', TRUE);
			$vehicle_category_data = array(
							'deleted'=>1,
							'user_deleted'=>$this->session->userdata('user_id'),
							'date_deleted'=>date('Y-m-d'),
							'time_deleted'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$vehicle_category_id)->update('sa_vehicle_type',$vehicle_category_data); 

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('vehicle_category_deleted_successfully'));
			redirect('port');
		}else{
			$data['vehicle_category_id'] = $this->uri->segment(4);
			$data['vehicle_category_details'] = $this->vehicle_category->vehicle_category_details($this->uri->segment(4));
			$this->load->view('modal/delete_vehicle_category',$data);

		}
	}
}

/* End of file view.php */