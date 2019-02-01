<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('delivery_order_model','delivery_order');
	}
	
	function update()
	{
		if ($this->input->post()) {
				
				$years=$this->input->post('year');
				$months=$this->input->post('month');
				$codes=$this->input->post('code');
				$job_no=$this->input->post('job_order_no');
				
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
				$this->form_validation->set_rules('job_order_from', 'From', 'required|xss_clean');
				$this->form_validation->set_rules('job_order_to', 'To', 'required|xss_clean');
				$this->form_validation->set_rules('job_order_item', 'Item', 'required|xss_clean');
				$this->form_validation->set_rules('job_order_desc', 'Description', 'required|xss_clean');
		
				if ($this->form_validation->run() == FALSE)
				{
						$this->session->set_flashdata('response_status', 'error');
						$this->session->set_flashdata('message', lang('error_in_form'));
						redirect('job_order/view/update/'.$years.'/'.$months.'/'.$codes);
				}else{	
						$job_order_data = array(
								'destination_from_rowID'=>$this->input->post('job_order_from'),
								'destination_to_rowID'=>$this->input->post('job_order_to'),
								'item_rowID'=>$this->input->post('job_order_item'),
								'wholesale'=>$this->input->post('job_order_wholesale'),
								'price_amount'=>$this->input->post('job_order_price_amount'),
								'weight'=>$this->input->post('job_order_weight'),
								'descs'=>$this->input->post('job_order_desc'),
								'price_20ft'=>$this->input->post('job_order_container_size_20ft'),
								'price_40ft'=>$this->input->post('job_order_container_size_40ft'),
								'price_45ftde'=>$this->input->post('job_order_container_size_45ft'),
								'user_modified'=>$this->session->userdata('user_id'),
								'date_modified'=>date('Y-m-d'),
								'time_modified'=>date('H:i:s')							
							);
							
							
						$this->db->where('year',$years);
						$this->db->where('month',$months);
						$this->db->where('code',$codes);
						$this->db->update('tr_jo_trx_hdr', $job_order_data);
						
							
						$params['user_rowID'] = $this->tank_auth->get_user_id();
						$params['module'] = 'Job Order';
						$params['module_field_id'] = $job_no;
						$params['activity'] = ucfirst('Updated System Job Order: '.$job_no);
						$params['icon'] = 'fa-edit';
						modules::run('activitylog/log',$params); //log activity

					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', lang('debtor_edited_successfully'));
					redirect('job_order'); 
				}
				}else{

				$this->load->module('layouts');
				$this->load->library('template');
				$this->template->title(lang(job_orders).' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
				$data['page'] = lang('job_orders');
				$data['datatables'] = TRUE;
				$data['form'] = TRUE;
				
				$year=$this->uri->segment(4);
				$month=$this->uri->segment(5);
				$code=$this->uri->segment(6);
				
				$data['job_orders'] = $this->job_order->get_all_records_update($year,$month,$code);
				
				$data['destination_froms'] = $this->job_order->get_all_records($table = 'sa_destination_from', $array = array(
				'rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','rowID','desc');
				
				$data['destination_tos'] = $this->job_order->get_all_records($table = 'sa_destination_to', $array = array(
				'rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','rowID','desc');
				
				$data['items'] = $this->job_order->get_all_records($table = 'sa_item', $array = array(
				'rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','rowID','desc');
				
				$this->template
				->set_layout('users')
				->build('modal/edit_job_order',isset($data) ? $data : NULL);	
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

			$year = $this->input->post('year');
			$month = $this->input->post('month');
			$code = $this->input->post('code');
			$delivery_order_data = array(
							'deleted'=>1,
							'user_deleted'=>$this->session->userdata('user_id'),
							'date_deleted'=>date('Y-m-d'),
							'time_deleted'=>date('H:i:s')							
			            );

			$this->db->where('year',$year);
			$this->db->where('month',$month);
			$this->db->where('code',$code);
			$this->db->update('tr_do_trx',$delivery_order_data); 

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('delivery_order_deleted_successfully'));
			redirect('delivery_order');
		}else{
			
			$data['delivery_order_details'] = $this->delivery_order->get_all_records_update($this->uri->segment(4),$this->uri->segment(5),$this->uri->segment(6)); 
			
			$this->load->view('modal/delete_delivery_order',$data);

		}
	}
}

/* End of file view.php */