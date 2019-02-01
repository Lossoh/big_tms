<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Delivery_order extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('delivery_order_model');
		
	}

	function index()
	{
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('delivery_orders').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('delivery_orders');
		$this->session->set_userdata('page_header', 'transaction');		
		$this->session->set_userdata('page_detail', 'delivery_orders');
		$data['datatables'] = TRUE;
		$data['form'] = TRUE;
		$data['delivery_orders'] = $this->delivery_order_model->get_all_records_list();
		
		$this->template
		->set_layout('users')
		->build('delivery_orders',isset($data) ? $data : NULL);
	}
	
		
	function get_jo_debtor(){
        $debtor_rowID=$this->input->post('debtor_rowID');
        $data=array(
            'jo_lists'=> $this->delivery_order_model->get_all_record_debtor_jo($debtor_rowID)
        );
		
		$this->load->view('ajax_jo_type',$data);
    }
	
	function get_wo(){
        $jo_no=$this->input->post('jo_no');
        $data=array(
            'wo_lists'=> $this->delivery_order_model->get_all_record_wo($jo_no)
        ); 	
		$this->load->view('ajax_wo_type',$data);
    }
	
	function get_driver_vehicle(){
        $debtor_rowID=$this->input->post('debtor_rowID');
        $data=array(
            'driver_lists'=> $this->delivery_order_model->get_all_record_driver_truck($debtor_rowID)
        ); 	
		$this->load->view('ajax_vehicle_type',$data);
    }

		
	function create()
	{
		
		if ($this->input->post()) {
				
				$hasil_do=$this->delivery_order_model->get_do();
				$do=$hasil_do['0']['do'];
			
				$month=date('m');
				$year=date('Y');
				$hasil= ((int)$this->AppModel->select_max_id('tr_do_trx',$array = array(
					'year' => $year,'month' =>$month),'code'))+1;
					
				$code=sprintf("%06s",$hasil);
				$do_no=$do.$year.$month.sprintf("%06s",$hasil);
				
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
				$this->form_validation->set_rules('delivery_order_no', 'DO No', 'required|xss_clean|is_unique[tr_do_trx.do_no]');
				$this->form_validation->set_rules('delivery_order_reg_no', 'Reg. No', 'required|xss_clean|is_unique[tr_do_trx.reg_no]');
				$this->form_validation->set_rules('delivery_order_date', 'DO Date', 'required|xss_clean');
				$this->form_validation->set_rules('delivery_order_debtor', 'Debtor', 'required|xss_clean');
				$this->form_validation->set_rules('delivery_order_jo_no', 'JO No.', 'required|xss_clean');
				$this->form_validation->set_rules('delivery_order_driver', 'Driver', 'required|xss_clean');
				$this->form_validation->set_rules('delivery_order_delivered_weight', 'Delivered Weight', 'required|xss_clean');
				
				if ($this->form_validation->run() == FALSE)
				{
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('error_in_form'));
					redirect('delivery_order/create');
				}else{		
					$delivery_order_data = array(
							'year' => $year,
							'month'=>$month,
							'code' => $code,
							'do_no'=>$this->input->post('delivery_order_no'),
							'reg_no'=>$this->input->post('delivery_order_reg_no'),
							'deliver_date'=>$this->input->post('delivery_order_date'),
							'debtor_rowID'=>$this->input->post('delivery_order_debtor'),
							'tr_jo_trx_hdr_year'=>$this->input->post('delivery_order_jo_year'),
							'tr_jo_trx_hdr_month'=>$this->input->post('delivery_order_jo_month'),
							'tr_jo_trx_hdr_code'=>$this->input->post('delivery_order_jo_code'),
							'tr_jo_trx_hdr_jo_no'=>$this->input->post('delivery_order_jo_no'),
							'driver_rowID'=>$this->input->post('delivery_order_driver'),
							'vehicle_rowID'=>$this->input->post('delivery_order_vehicle_id'),
							'vehicle_type_rowID'=>$this->input->post('delivery_order_vehicle_type_id'),
							'destination_from_rowID'=>$this->input->post('delivery_order_jo_from'),
							'destination_to_rowID'=>$this->input->post('delivery_order_jo_to'),
							'item_rowID'=>$this->input->post('delivery_order_item_rowID'),
							'tr_jo_trx_cnt_rowID'=>$this->input->post('delivery_order_container'),
							'delivered_weight'=>$this->input->post('delivery_order_delivered_weight'),
							'pod_weight'=>$this->input->post('delivery_order_pod_weight'),
							'pod_date'=>$this->input->post('delivery_order_pod_date'),
							'user_created'=>$this->session->userdata('user_id'),
							'date_created'=>date('Y-m-d'),
							'time_created'=>date('H:i:s')							
			         );
					 
					$this->db->insert('tr_do_trx', $delivery_order_data); 
					$delivery_order_id = $this->db->insert_id();

					$params['user_rowID'] = $this->tank_auth->get_user_id();
					$params['module'] = 'delivery_orders';
					$params['module_field_id'] = $delivery_order_id;
					$params['activity'] = ucfirst('Added a new Delivery Order '.$this->input->post('delivery_order_no'));
					$params['icon'] = 'fa-user';
					modules::run('activitylog/log',$params); //log activity

					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', lang('delivery_order_registered_successfully'));
					redirect('delivery_order');
				}
		}else{
			$this->load->module('layouts');
			$this->load->library('template');
			$data['datatables'] = TRUE;
			$data['form'] = TRUE;
			
			$data['work_orders'] = $this->delivery_order_model->get_all_records($table = 'tr_wo_trx_hdr', $array = array(
			'deleted'=>'0'), $join_table = '', $join_criteria = '','wo_no','desc');
			
			$data['debtors'] = $this->delivery_order_model->get_all_records($table = 'sa_debtor', $array = array(
			'type =' => 'C','rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','rowID','desc');
			
			$data['drivers'] = $this->delivery_order_model->get_all_records($table = 'sa_debtor', $array = array(
			'type =' => 'D','rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','rowID','desc');
			
		
			$data['containers'] = $this->delivery_order_model->get_all_records($table = 'tr_jo_trx_cnt', $array = array(
			'rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','rowID','desc');
			
			$this->template
			->set_layout('users')
			->build('create_delivery_order',isset($data) ? $data : NULL);
		}
	}
	
	function update()
	{
		if ($this->input->post()) {
				
				$years=$this->input->post('year');
				$months=$this->input->post('month');
				$codes=$this->input->post('code');
				$do_no=$this->input->post('delivery_order_no');
			
				$this->load->library('form_validation');
				$this->form_validation->set_rules('delivery_order_no', 'DO No', 'required|xss_clean|is_unique[tr_do_trx.do_no]');
				$this->form_validation->set_rules('delivery_order_reg_no', 'Reg. No', 'required|xss_clean|is_unique[tr_do_trx.reg_no]');
				$this->form_validation->set_rules('delivery_order_date', 'DO Date', 'required|xss_clean');
				$this->form_validation->set_rules('delivery_order_delivered_weight', 'Delivered Weight', 'required|xss_clean');
		
					if ($this->form_validation->run() == FALSE)
					{
							$this->session->set_flashdata('response_status', 'error');
							$this->session->set_flashdata('message', lang('error_in_form'));
							redirect('delivery_order/update/'.$years.'/'.$months.'/'.$codes);
					}else{	
						
							$delivery_order_data = array(
									'do_no'=>$this->input->post('delivery_order_no'),
									'reg_no'=>$this->input->post('delivery_order_reg_no'),
									'deliver_date'=>$this->input->post('delivery_order_date'),
									'tr_jo_trx_cnt_rowID'=>$this->input->post('delivery_order_container'),
									'delivered_weight'=>$this->input->post('delivery_order_delivered_weight'),
									'pod_weight'=>$this->input->post('delivery_order_pod_weight'),
									'pod_date'=>$this->input->post('delivery_order_pod_date'),
									'user_modified'=>$this->session->userdata('user_id'),
									'date_modified'=>date('Y-m-d'),
									'time_modified'=>date('H:i:s')							
							 );
							 
							$this->db->where('year',$years);
							$this->db->where('month',$months);
							$this->db->where('code',$codes);
							$this->db->update('tr_do_trx', $delivery_order_data);
							
							$params['user_rowID'] = $this->tank_auth->get_user_id();
							$params['module'] = 'Delivery Order';
							$params['module_field_id'] = $do_no;
							$params['activity'] = ucfirst('Updated System Delivery Order: '.$this->input->post('delivery_order_no'));
							$params['icon'] = 'fa-edit';
							modules::run('activitylog/log',$params); //log activity

						$this->session->set_flashdata('response_status', 'success');
						$this->session->set_flashdata('message', lang('delivery_order_edited_successfully'));
						redirect('delivery_order'); 
					}
				}else{
					
			
			$this->load->module('layouts');
			$this->load->library('template');
			$data['datatables'] = TRUE;
			$data['form'] = TRUE;
			
			
			$year=$this->uri->segment(3);
			$month=$this->uri->segment(4);
			$code=$this->uri->segment(5);
			
			$data['delivery_orders'] = $this->delivery_order_model->get_all_records_update($year,$month,$code);
			
			$data['debtors'] = $this->delivery_order_model->get_all_records($table = 'sa_debtor', $array = array(
			'type =' => 'C','rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','rowID','desc');
			
			$data['drivers'] = $this->delivery_order_model->get_all_records($table = 'sa_debtor', $array = array(
			'type =' => 'D','rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','rowID','desc');
			
		
			$data['containers'] = $this->delivery_order_model->get_all_records($table = 'tr_jo_trx_cnt', $array = array(
			'rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','rowID','desc');

			
			$this->template
			->set_layout('users')
			->build('edit_delivery_order',isset($data) ? $data : NULL);	
		
		}
	}
	
	
}

/* End of file contacts.php */