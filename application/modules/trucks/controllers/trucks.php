<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trucks extends MX_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('truck_model');
	}

	function index()
	{
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title(lang('trucks').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
	$data['page'] = lang('trucks');
	$data['datatables'] = TRUE;
	$data['trucks'] = $this->truck_model->get_all_records($table = 'mst_trucks',
		$array = array(
			'truck_id >' => 0),$join_table = '',$join_criteria = '','truck_name');
	$data['roles'] = $this->AppModel->get_all_records($table = 'roles',
		$array = array(
			'r_id >' => '0'),$join_table = '',$join_criteria = '','r_id');
	$this->template
	->set_layout('users')
	->build('trucks',isset($data) ? $data : NULL);
	}

	function create()
	{
		if ($this->input->post()) {
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
				$this->form_validation->set_rules('truck_ref', 'Truck Reference', 'required|xss_clean|max_length[20]');
				$this->form_validation->set_rules('truck_name', 'Truck Name', 'required|xss_clean|max_length[40]');
				$this->form_validation->set_rules('transporter_id', 'Transporter ID', 'xss_clean|max_length[5]');
				$this->form_validation->set_rules('truck_type_id', 'Type Of Truck ID', 'xss_clean|max_length[5]');
				if ($this->form_validation->run() == FALSE)
				{
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('truck_registration_failed'));
					$this->session->set_flashdata('form_errors', validation_errors('<span style="color:red">', '</span><br>'));
					redirect($this->input->post('r_url'));
				}else if ($this->truck_model->check_key('mst_trucks',$array=array('deleted' => 0, 'truck_ref' =>trim($this->input->post('truck_ref'))))){
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('truck_used'));
				redirect('transporters/view/details/'.$this->input->post('transporter_id'));
				}else{		
					//$form_data = $_POST;
					$truck_data = array(
							'truck_ref'=>strtoupper($this->input->post('truck_ref')),
							'truck_name'=>strtoupper($this->input->post('truck_name')),
							'gps_id'=>strtoupper($this->input->post('gps_id')),
							'transporter_id'=>$this->input->post('transporter_id'),
							'truck_type_id'=>$this->input->post('truck_type_id'),
							'asset_id'=>'',
							'truck_condition'=>0,
							'truck_documentation'=>0,
							'truck_tools'=>0,
							'truck_tire'=>0,
							'deleted'=>0,
							'user_created'=>$this->session->userdata('user_id'),
							'date_created'=>date('Y-m-d'),
							'time_created'=>date('H:i:s')							
			         );
					$this->db->insert('mst_trucks', $truck_data); 
					$truck_id = $this->db->insert_id();

					$params['user'] = $this->tank_auth->get_user_id();
					$params['module'] = 'Trucks';
					$params['module_field_id'] = $truck_id;
					$params['activity'] = ucfirst('Added a new item '.$this->input->post('truck_name'));
					$params['icon'] = 'fa-user';
					modules::run('activitylog/log',$params); //log activity

					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', lang('truck_registered_successfully'));
					redirect($this->input->post('r_url'));	
				}
		}else{
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message', lang('error_in_form'));
			redirect('transporters');
			//$this->session->set_flashdata('form_errors', validation_errors('<span style="color:red">', '</span><br>'));
			//redirect($this->input->post('r_urla'));				
		}
	}	
	
	
	
	
	function add()
	{
		if ($this->input->post()) {
			redirect('trucks');
		}else{
		$data['transporter'] = $this->uri->segment(3);
		$data['truck_types'] = $this->AppModel->get_all_record_reference($table = 'mst_reference', $array = array('Type_Ref' => 'truck_type'), 'No_Urut_Ref');
		$this->load->view('modal/add_truck',$data);
		}
	}

	function edit_truck()
	{
		if ($this->input->post() ){
					
			$transporter_id = $this->input->post('transporter_id', TRUE);
			$truck_id = $this->input->post('truck_id', TRUE);
			$gps_id = trim($this->input->post('gps_id', TRUE));
			$truck_type_id = trim($this->input->post('truck_type_id', TRUE));
			
			$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
			$this->form_validation->set_rules('transporter_id', 'Transporter ID', 'required');
			$this->form_validation->set_rules('truck_id', 'Truck ID', 'required');
			$this->form_validation->set_rules('truck_type_id', 'Truck Type', 'required');
			
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('transporters/view/details/'.$transporter_id);
			}else{		
			
				$form_data = array(
							'gps_id'				=>	$gps_id,
							'truck_type_id'			=>	$truck_type_id,
			                'user_modified'			=>	$this->session->userdata('user_id'),
							'date_modified'			=>	date('Y-m-d'),
							'time_modified'			=>	date('H:i:s'),
			    );
				$this->db->where('truck_id',$truck_id)->update('mst_trucks', $form_data);

				$activity = ucfirst($this->tank_auth->get_username().' edited TT #'.$truck_id);
				$this->_log_activity($truck_id,$activity,$icon = 'fa-pencil'); //log activity

				
				$this->session->set_flashdata('response_status', 'success');
				$this->session->set_flashdata('message', lang('truck_updated_successfully'));
				redirect('transporters/view/details/'.$transporter_id);
			}	
		}else{

			$data['truck_details'] = $this->truck_model->truck_details($this->uri->segment(3));
			$data['truck_types'] = $this->AppModel->get_all_record_reference($table = 'mst_reference', $array = array('Type_Ref' => 'truck_type'), 'No_Urut_Ref');
			$this->load->view('modal/edit_truck',$data);
		}
	}

	function delete_truck(){
		if ($this->input->post() ){

			$transporter_id = $this->input->post('transporter_id', TRUE);
			$truck_id = $this->input->post('truck_id', TRUE);

			
			$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
			$this->form_validation->set_rules('transporter_id', 'Transporter ID', 'required');
			$this->form_validation->set_rules('truck_id', 'Truck ID', 'required');


			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('transporters/view/details/'.$transporter_id);
			}else{	
				$form_data = array(
			                'deleted' => 1,
			                'user_deleted'			=>	$this->session->userdata('user_id'),
							'date_deleted'			=>	date('Y-m-d'),
							'time_deleted'			=>	date('H:i:s'),
			    );
				$this->db->where('truck_id',$truck_id)->update('mst_trucks', $form_data);

				$activity = ucfirst($this->tank_auth->get_username().' deleted TT #'.$truck_id);
				$this->_log_activity($truck_id,$activity,$icon = 'fa-pencil'); //log activity

				$this->session->set_flashdata('response_status', 'success');
				$this->session->set_flashdata('message', lang('truck_deleted_successfully'));
				redirect('transporters/view/details/'.$transporter_id);
			}	
		}else{

			$data['truck_details'] = $this->truck_model->truck_details($this->uri->segment(3));
			$data['truck_types'] = $this->AppModel->get_all_record_reference($table = 'mst_reference', $array = array('Type_Ref' => 'truck_type'), 'No_Urut_Ref');			
			$this->load->view('modal/delete_truck',$data);
		}
		
	}

	function _log_activity($truck_id,$activity,$icon){
			$this->db->set('module', 'trucks');
			$this->db->set('module_field_id', $truck_id);
			$this->db->set('user', $this->tank_auth->get_user_id());
			$this->db->set('activity', $activity);
			$this->db->set('icon', $icon);
			$this->db->insert('activities'); 
	}	
	
}
