<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('tank_auth');
		
		$this->load->model('advance_type_model','advance_type');
	}
	
	function update()
	{
		if ($this->input->post()) {
		
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
				$this->form_validation->set_rules('advance_type_name', 'Name', 'required|xss_clean');
				$this->form_validation->set_rules('advance_by_jo', 'Job Order', 'required|xss_clean');
				$this->form_validation->set_rules('advance_only_driver', 'Driver', 'required|xss_clean');
				$this->form_validation->set_rules('advance_fare_trip', 'Fare Trip', 'required|xss_clean');
				if ($this->form_validation->run() == FALSE)
				{
						$this->session->set_flashdata('response_status', 'error');
						$this->session->set_flashdata('message', lang('error_in_form'));
						redirect('advance_type');
				}else{	
					$advance_type_id =  $this->input->post('row_id');
					$data_advance_type = array(
									'advance_name'=>strtoupper($this->input->post('advance_type_name')),
									'by_jo'=>$this->input->post('advance_by_jo'),
									'only_driver'=>$this->input->post('advance_only_driver'),
									'fare_trip'=>$this->input->post('advance_fare_trip'),
									'user_modified'=>$this->session->userdata('user_id'),
									'date_modified'=>date('Y-m-d'),
									'time_modified'=>date('H:i:s')							
								);

					$this->db->where('rowID',$advance_type_id)->update('sa_advance_type', $data_advance_type); 

							$params['user_rowID'] = $this->tank_auth->get_user_id();
							$params['module'] = 'Advance Type';
							$params['module_field_id'] = $advance_type_id;
							$params['activity'] = ucfirst('Updated System Advance Type : '.$this->input->post('advance_type_name'));
							$params['icon'] = 'fa-edit';
							modules::run('activitylog/log',$params); //log activity

					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', lang('advance_type_edited_successfully'));
					redirect('advance_type');
		}
		}else{

		$data['advance_type_details'] = $this->advance_type->advance_type_details($this->uri->segment(4));
		$this->load->view('modal/edit_advance_type',$data);
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

			$advance_type_id = $this->input->post('row_id', TRUE);
			$advance_type_data = array(
							'deleted'=>1,
							'user_deleted'=>$this->session->userdata('user_id'),
							'date_deleted'=>date('Y-m-d'),
							'time_deleted'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$advance_type_id)->update('sa_advance_type',$advance_type_data); 

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('advance_type_deleted_successfully'));
			redirect('advance_type');
		}else{
			$data['advance_type_id'] = $this->uri->segment(4);
			$data['advance_type_details'] = $this->advance_type->advance_type_details($this->uri->segment(4));
			$this->load->view('modal/delete_advance_type',$data);

		}
	}
}

/* End of file view.php */