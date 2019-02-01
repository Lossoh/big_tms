<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('vehicle_model','vehicle');
	}
	
	function update()
	{
		if ($this->input->post()) {
		
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('vehicle_code', 'Code', 'required|xss_clean');
		$this->form_validation->set_rules('vehicle_head_truck', 'Head Truck', 'required|xss_clean');
			
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('error_in_form'));
				redirect('vehicle');
		}else{	
			$vehicle_id =  $this->input->post('row_id');
			$data_vehicle = array(
							'head_truck'=>strtoupper($this->input->post('vehicle_head_truck')),
							'gps_no'=>$this->input->post('vehicle_gps'),
							'vehicle_type_rowID'=>$this->input->post('vehicle_code'),
							'debtor_rowID'=>$this->input->post('vehicle_driver'),
							'user_modified'=>$this->session->userdata('user_id'),
							'date_modified'=>date('Y-m-d'),
							'time_modified'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$vehicle_id)->update('sa_vehicle', $data_vehicle); 

					$params['user_rowID'] = $this->tank_auth->get_user_id();
					$params['module'] = 'vehicle';
					$params['module_field_id'] = $vehicle_id;
					$params['activity'] = ucfirst('Updated System Vehicle category : '.$this->input->post('vehicle_name'));
					$params['icon'] = 'fa-edit';
					modules::run('activitylog/log',$params); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('vehicle_edited_successfully'));
			redirect('vehicle');
		}
		}else{

		$data['vehicle_details'] = $this->vehicle->vehicle_details($this->uri->segment(4));
		$data['vehicle_types'] = $this->vehicle->get_all_records($table = 'sa_vehicle_type', $array = array(
			'rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '','type_cd','asc');
		$data['drivers'] = $this->vehicle->get_all_records($table = 'sa_debtor', $array = array(
			'type =' => 'D','rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '','debtor_cd','asc');
			
		$this->load->view('modal/edit_vehicle',$data);
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

			$vehicle_id = $this->input->post('row_id', TRUE);
			$vehicle_data = array(
							'deleted'=>1,
							'user_deleted'=>$this->session->userdata('user_id'),
							'date_deleted'=>date('Y-m-d'),
							'time_deleted'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$vehicle_id)->update('sa_vehicle',$vehicle_data); 

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('vehicle_deleted_successfully'));
			redirect('vehicle');
		}else{
			$data['vehicle_id'] = $this->uri->segment(4);
			$data['vehicle_details'] = $this->vehicle->vehicle_details($this->uri->segment(4));
			$this->load->view('modal/delete_vehicle',$data);

		}
	}
}

/* End of file view.php */