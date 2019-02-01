<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Work_order extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('work_order_model');
	}

	function index()
	{
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('work_orders').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('work_orders');
		$this->session->set_userdata('page_header', 'transaction');		
		$this->session->set_userdata('page_detail', 'work_orders');
		$data['datatables'] = TRUE;
		$data['form'] = TRUE;
		
		$data['work_orders'] = $this->work_order_model->get_all_records_list();
		
		$data['debtors'] = $this->work_order_model->get_all_records($table = 'sa_debtor', $array = array(
			'type =' => 'C','rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '','debtor_cd','asc'); 
		
		$data['ports'] = $this->work_order_model->get_all_records($table = 'sa_port', $array = array(
			'rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '','port_cd','asc');
		
		$this->template
		->set_layout('users')
		->build('work_orders',isset($data) ? $data : NULL);
	}
	
	
	function create()
	{
		if ($this->input->post()) {
				$hasil_wo=$this->work_order_model->get_wo();
				$wo=$hasil_wo['0']['wo'];
				
				$year=date('Y');
				$hasil= ((int)$this->AppModel->select_max_id('tr_wo_trx_hdr',$array = array(
					'year' => $year),'code'))+1;
					
				//$row_id=(int)substr($hasil,0,4);
				$code=sprintf("%06s",$hasil);
				$wo_no=$wo.$year.sprintf("%06s",$hasil);
				
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
				$this->form_validation->set_rules('work_order_date', 'WO Date', 'required|xss_clean');
				$this->form_validation->set_rules('work_order_ref_no', 'Ref No', 'required|xss_clean|is_unique[tr_wo_trx_hdr.ref_no');
				$this->form_validation->set_rules('work_order_debtor', 'Debtor', 'required|xss_clean');
				$this->form_validation->set_rules('work_order_ex_vessel', 'Ex. Vessel', 'required|xss_clean');
				$this->form_validation->set_rules('work_order_port', 'Port', 'required|xss_clean');
										
				if ($this->form_validation->run() == FALSE)
				{
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('error_in_form'));
					$_POST = '';
					$this->index();
				}else{		
					$data_work_order = array(
							'code'=>$code,
							'year'=>$year,
							'wo_no'=>$wo_no,
							'ref_no'=>$this->input->post('work_order_ref_no'),
							'wo_date'=>$this->input->post('work_order_date'),
							'debtor_rowID'=>$this->input->post('work_order_debtor'),
							'vessel_no'=>$this->input->post('work_order_vessel_no'),
							'vessel_name'=>strtoupper($this->input->post('work_order_ex_vessel')),
							'port_rowID'=>$this->input->post('work_order_port'),
							'user_created'=>$this->session->userdata('user_id'),
							'date_created'=>date('Y-m-d'),
							'time_created'=>date('H:i:s')							
			         );
					$this->db->insert('tr_wo_trx_hdr', $data_work_order); 
					$work_order_id = $this->db->insert_id();

					$params['user_rowID'] = $this->tank_auth->get_user_id();
					$params['module'] = 'work_orders';
					$params['module_field_id'] = $work_order_id;
					$params['activity'] = ucfirst('Added a new Work Order'.$this->input->post('work_order_police_no'));
					$params['icon'] = 'fa-user';
					modules::run('activitylog/log',$params); //log activity

					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', lang('work_order_registered_successfully'));
					redirect('work_order');
				}
		}else{
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message', lang('error_in_form'));
			redirect('work_order');
		}
	} 

}

/* End of file contacts.php */