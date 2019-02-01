<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Items extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('item_model');
	}

	function index()
	{
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('items').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('items');
		$this->session->set_userdata('page_header', 'master');		
		$this->session->set_userdata('page_detail', 'items');
		$data['datatables'] = TRUE;
		$data['form'] = TRUE;
		$data['items'] = $this->AppModel->get_all_records($table = 'mst_items', $array = array(
			'item_id >' => '0'), $join_table = '', $join_criteria = '','item_name');				

		$this->template
		->set_layout('users')
		->build('items',isset($data) ? $data : NULL);
	}
	function create()
	{
		if ($this->input->post()) {
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
				$this->form_validation->set_rules('item_ref', 'Item Reference', 'required|xss_clean|max_length[10]|is_unique[mst_items.item_ref]');
				$this->form_validation->set_rules('item_name', 'Item Name', 'required|xss_clean|max_length[40]');
				$this->form_validation->set_rules('tolerance', 'Tolerance', 'required|xss_clean|min_length[1]|max_length[3]|numeric');
				if ($this->form_validation->run() == FALSE)
				{
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('error_in_form'));
					$_POST = '';
					$this->index();
					//$this->session->set_flashdata('form_errors', validation_errors('<span style="color:red">', '</span><br>'));
					//redirect($this->input->post('r_urla'));						
						//redirect('invoices/manage/add');
				}else{		
					//$form_data = $_POST;
					$item_data = array(
							'item_ref'=>strtoupper($this->input->post('item_ref')),
							'item_name'=>strtoupper($this->input->post('item_name')),
							'tolerance'=>$this->input->post('tolerance'),
							'user_created'=>$this->session->userdata('user_id'),
							'date_created'=>date('Y-m-d'),
							'time_created'=>date('H:i:s')							
			         );
					$this->db->insert('mst_items', $item_data); 
					$item_id = $this->db->insert_id();

					$params['user'] = $this->tank_auth->get_user_id();
					$params['module'] = 'Items';
					$params['module_field_id'] = $item_id;
					$params['activity'] = ucfirst('Added a new item '.$this->input->post('item_name'));
					$params['icon'] = 'fa-user';
					modules::run('activitylog/log',$params); //log activity

					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', lang('item_registered_successfully'));
					redirect('items');
					//redirect($this->input->post('r_urla'));	
				}
		}else{
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message', lang('error_in_form'));
			redirect('items');
			//$this->session->set_flashdata('form_errors', validation_errors('<span style="color:red">', '</span><br>'));
			//redirect($this->input->post('r_urla'));				
		}
	}


}

/* End of file contacts.php */