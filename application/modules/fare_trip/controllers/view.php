<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('fare_trip_model','fare_trip');
	}
	
	function details()
	{		
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('fare_trips').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('fare_trips');
		$data['datatables'] = TRUE;
		$data['form'] = TRUE;
		$data['fare_trip_details'] = $this->fare_trip->fare_trip_details($this->uri->segment(4));

		$this->load->view('fare_trip_details',$data);
	}
	
	function update()
	{
		if ($this->input->post()) {
		
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('fare_trip_effective_date', 'Vehicle Type', 'required|xss_clean');
		$this->form_validation->set_rules('fare_trip_vehicle_type', 'Vehicle Type', 'required|xss_clean');
		$this->form_validation->set_rules('fare_trip_destination_from', 'From', 'required|xss_clean');
		$this->form_validation->set_rules('fare_trip_destination_to', 'To', 'required|xss_clean');
		$this->form_validation->set_rules('fare_trip_distance', 'Distance', 'required|xss_clean');
			
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('error_in_form'));
				redirect('fare_trip');
		}else{	
			$fare_trip_id =  $this->input->post('row_id');
			$data_fare_trip = array(
							'effective_date'=>$this->input->post('fare_trip_effective_date'),
							'vehicle_type_rowID'=>$this->input->post('fare_trip_vehicle_type'),
							'destination_from_rowID'=>$this->input->post('fare_trip_destination_from'),
							'destination_to_rowID'=>$this->input->post('fare_trip_destination_to'),
							'distance'=>$this->input->post('fare_trip_distance'),
							'fare_trip_rate'=>$this->input->post('fare_trip_rate'),
							'fuel_rate'=>$this->input->post('fare_trip_fuel_rate'),
							'tol_rate'=>$this->input->post('fare_trip_tol_rate'),
							'load_rate'=>$this->input->post('fare_trip_load_rate'),
							'unload_rate'=>$this->input->post('fare_trip_unload_rate'),
							'other_rate'=>$this->input->post('fare_trip_others_rate'),
							'user_modified'=>$this->session->userdata('user_id'),
							'date_modified'=>date('Y-m-d'),
							'time_modified'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$fare_trip_id)->update('sa_fare_trip', $data_fare_trip);
			
			$params['user_rowID'] = $this->tank_auth->get_user_id();
			$params['module'] = 'fare_trip';
			$params['module_field_id'] = $fare_trip_id;
			$params['activity'] = ucfirst('Updated System fare_trip category : '.$this->input->post('fare_trip_name'));
			$params['icon'] = 'fa-edit';
			modules::run('activitylog/log',$params); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('fare_trip_edited_successfully'));
			redirect('fare_trip');
		}
		}else{

			$data['fare_trip_details'] = $this->fare_trip->fare_trip_details($this->uri->segment(4));
			$data['vehicle_types'] = $this->fare_trip->get_all_records($table = 'sa_vehicle_type', $array = array(
				'rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '','type_cd','asc');
				
			$data['destination_froms'] = $this->fare_trip->get_all_records($table = 'sa_destination_from', $array = array(
				'rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '','from_cd','asc'); 
			
			$data['destination_tos'] = $this->fare_trip->get_all_records($table = 'sa_destination_to', $array = array(
				'rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '','to_cd','asc'); 
			
			$this->load->view('modal/edit_fare_trip',$data);
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

			$fare_trip_id = $this->input->post('row_id', TRUE);
			$fare_trip_data = array(
							'deleted'=>1,
							'user_deleted'=>$this->session->userdata('user_id'),
							'date_deleted'=>date('Y-m-d'),
							'time_deleted'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$fare_trip_id)->update('sa_fare_trip',$fare_trip_data); 

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('fare_trip_deleted_successfully'));
			redirect('fare_trip');
		}else{
			$data['fare_trip_id'] = $this->uri->segment(4);
			$data['fare_trip_details'] = $this->fare_trip->fare_trip_details($this->uri->segment(4));
			$this->load->view('modal/delete_fare_trip',$data);

		}
	}
	

}

/* End of file view.php */