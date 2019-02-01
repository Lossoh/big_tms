<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('item_model','user');
	}
	function details()
	{		
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('items').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('items');
		$data['datatables'] = TRUE;
		$data['form'] = TRUE;
		$data['item_details'] = $this->user->item_details($this->uri->segment(4));

		$this->template
		->set_layout('users')
		->build('item_details',isset($data) ? $data : NULL);
	}

	function update()
	{
		if ($this->input->post()) {
/* 			if ($this->config->item('demo_mode') == 'TRUE') {
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message', lang('demo_warning'));
			redirect('items');
		} */
		
		$this->load->library('form_validation');		
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('item_ref', 'Item Reference', 'required|xss_clean|max_length[5]');
		$this->form_validation->set_rules('item_name', 'Item Name', 'required|xss_clean|max_length[30]');
		$this->form_validation->set_rules('tolerance', 'Tolerance', 'required|xss_clean|min_length[1]|max_length[3]|numeric');
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('error_in_form'));
				redirect('items');
		}else{	
		$item_id =  $this->input->post('item_id');
			$item_data = array(
							'item_ref'=>strtoupper($this->input->post('item_ref')),
							'item_name'=>strtoupper($this->input->post('item_name')),
							'tolerance'=>$this->input->post('tolerance'),
							'user_modified'=>$this->session->userdata('user_id'),
							'date_modified'=>date('Y-m-d'),
							'time_modified'=>date('H:i:s')							
			            );

			$this->db->where('item_id',$item_id)->update('mst_items', $item_data); 

					$params['user'] = $this->tank_auth->get_user_id();
					$params['module'] = 'Items';
					$params['module_field_id'] = $item_id;
					$params['activity'] = ucfirst('Updated System User : '.$this->input->post('fullname'));
					$params['icon'] = 'fa-edit';
					modules::run('activitylog/log',$params); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('item_edited_successfully'));
			redirect('items');
		}
		}else{
		$data['item_details'] = $this->user->item_details($this->uri->segment(4));
		$data['roles'] = $this->user->roles();
		$data['items'] = $this->AppModel->get_all_records($table = 'mst_items',
		$array = array(
			'item_id >' => '0'),$join_table = '',$join_criteria = '','item_name');
		$this->load->view('modal/edit_item',$data);
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

			$item_id = $this->input->post('item_id', TRUE);
			$item_data = array(
							'deleted'=>1,
							'user_deleted'=>$this->session->userdata('user_id'),
							'date_deleted'=>date('Y-m-d'),
							'time_deleted'=>date('H:i:s')							
			            );

			$this->db->where('item_id',$item_id)->update('mst_items', $item_data); 

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('item_deleted_successfully'));
			redirect('items');
		}else{
			$data['item_id'] = $this->uri->segment(4);
			$data['item_details'] = $this->user->item_details($this->uri->segment(4));
			$this->load->view('modal/delete_item',$data);

		}
	}
}

/* End of file view.php */