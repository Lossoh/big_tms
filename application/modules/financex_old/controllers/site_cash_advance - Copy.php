<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class site_cash_advance extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('site_cash_advance_model');
		$this->session->set_userdata('page_header', 'transaction');	
	}

	function index()
	{
		//echo"tralalalal";echo"<pre>";print_r($this->session->userdata);die();
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('site_cash_advances').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('site_cash_advances');
	
		$this->session->set_userdata('page_detail', 'site_cash_advances');
		$data['datatables'] = TRUE;
		$data['form'] = TRUE;
		$data['site_cash_advances'] = $this->site_cash_advance_model->get_all_records_list();
		
		$this->template
		->set_layout('users')
		->build('site_cash_advances',isset($data) ? $data : NULL);
	}
	
	function get_by_jo(){
        $advance_type_rowID=$this->input->post('advance_type_rowID');
		$data_advance_type=$this->site_cash_advance_model->get_advance_type_by_jo($advance_type_rowID);

		echo $data_advance_type;
		
    }
	
	
	function get_wo_debtor(){
        $debtor_rowID=$this->input->post('debtor_rowID');
        $data=array(
            'wo_lists'=> $this->job_order_model->get_all_record_debtor_wo($debtor_rowID)
        );

		$this->load->view('ajax_wo_type',$data);
    }
	
	/* function get_wo(){
        $wo_no=$this->input->post('wo_no');
        $data=array(
            'wo_lists'=> $this->job_order_model->get_all_record_wo($wo_no)
        ); 	
		$this->load->view('ajax_jo_type',$data);
    } */
	
	function get_wo(){
        $jo_no=$this->input->post('jo_no');
        $data=array(
            'jo_lists'=> $this->site_cash_advance_model->get_all_record_jo($jo_no)
        ); 	
		$this->load->view('ajax_wo_type',$data);
    }
	
	function get_driver_vehicle(){
        $debtor_rowID=$this->input->post('debtor_rowID');
        $data=array(
            'driver_lists'=> $this->site_cash_advance_model->get_all_record_driver_truck($debtor_rowID)
        ); 
		
		$this->load->view('ajax_vehicle_type',$data);
		
    }

		
	function create()
	{
		
		if ($this->input->post()) {
				$month=date('m');
				$year=date('Y');
				
				# mengambil maksimal no automatis tabel cb_cash_adv,cb_trx_hdr,cb_trx_dtl #
				
					$hasil_cash_pay=$this->site_cash_advance_model->get_cash_pay();
					$cash_pay=$hasil_cash_pay['0']['cash_pay'];
						
						# mengambil nilai gl_rowID tabel gl_trx_dtl baris ke-1#
						
							$gl_coa_rowID=$hasil_cash_pay['0']['gl_coaID_trans_acc'];
						
						# end nilai gl_rowID #
						
						# mengambil nilai gl_rowID untuk tabel gl_trx_dtl baris ke-2 #
						
							$gl_coa_rowID1=$hasil_cash_pay['0']['gl_coaID_cash_opr_acc'];
						
						# end nilai gl_rowID #
					
									
					$hasil= ((int)$this->AppModel->select_max_id('cb_cash_adv',$array = array(
						'year' => $year,'month' =>$month),'code'))+1;
						
					$code=sprintf("%06s",$hasil);
					$adv_no=$cash_pay.$year.$month.sprintf("%06s",$hasil);
				
				# end mengambil maksimal no automatis tabel cb_cash_adv #
				
				# mengambil maksimal no automatis tabel gl_trx_hdr,gl_trx_hdr #
				
					$hasil_journal_header=$this->site_cash_advance_model->get_journal_header();
					$journal=$hasil_journal_header['0']['general_jrn'];
					
					$hasil1= ((int)$this->AppModel->select_max_id('gl_trx_hdr',$array = array(
						'year' => $year,'month' =>$month),'code'))+1;
						
					$code1=sprintf("%06s", $hasil1);
					$journal_no=$journal.$year.$month.sprintf("%06s",$hasil);
					
				# mengambil maksimal no automatis tabel gl_trx_hdr #
								
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
				$this->form_validation->set_rules('site_cash_advance_date', 'Date', 'required|xss_clean');
				$this->form_validation->set_rules('site_cash_advance_cat', 'Cash Advance Type', 'required|xss_clean');
				$this->form_validation->set_rules('site_cash_advance_driveremployee', 'Driver / Employee', 'required|xss_clean');
				$this->form_validation->set_rules('site_cash_advance_description', 'Description', 'required|xss_clean');
				
				if ($this->form_validation->run() == FALSE)
				{
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('error_in_form'));
					redirect('site_cash_advance/create');
				}else{
					$vehicle_type_id=$this->input->post('site_cash_advance_vehicle_type_id');
					$from=$this->input->post('site_cash_advance_from_id');
					$to=$this->input->post('site_cash_advance_to_id');
				 
					
					$query_amount=$this->site_cash_advance_model->get_amount($vehicle_type_id,$from,$to);
					
					$distance=$query_amount['0']['distance'];
					$fuel_rate=$query_amount['0']['fuel_rate'];
					$fare_trip_rate=$query_amount['0']['fare_trip_rate'];
					$tol_rate=$query_amount['0']['tol_rate'];
					$load_rate=$query_amount['0']['load_rate'];
					$unload_rate=$query_amount['0']['unload_rate'];
					$other_rate=$query_amount['0']['other_rate'];
					
					if(empty($this->input->post('site_cash_advance_amount'))){
							$amount_site_cash_advance = ($distance*$fuel_rate) + $fare_trip_rate + $tol_rate + $load_rate + $unload_rate + $other_rate;
						}else{
							$amount_site_cash_advance = $this->input->post('site_cash_advance_amount');
						} 
					
					$debtor_id=$this->input->post('site_cash_advance_debtor_id');
					
					$hasil_gl_row_id=$this->site_cash_advance_model->get_rowID_gl($debtor_id);
					$gl_rowID=$hasil_gl_row_id['0']['gl_coa_id'];
					
					$hasil_gl_row_id1=$this->site_cash_advance_model->get_rowID_gl_advance_acc($debtor_id);
					$gl_rowID1=$hasil_gl_row_id1['0']['gl_coa_id'];
					
					$hasil_gl_balance=$this->site_cash_advance_model->get_gl_balance($year,$month,$hasil_gl_row_id);
					
					$site_cash_advance_data = array(
							'year' => $year,
							'month'=>$month,
							'code' => $code,
							'advance_no'=>$adv_no,
							'advance_date'=>$this->input->post('site_cash_advance_date'),
							'advance_type_rowID'=>$this->input->post('site_cash_advance_cat'),
							'employee_driver_rowID'=>$this->input->post('site_cash_advance_driveremployee'),
							'vehicle_rowID'=>$this->input->post('site_cash_advance_vehicle_id'),
							'vehicle_type_rowID'=>$this->input->post('site_cash_advance_vehicle_type_id'),
							'destination_from_rowID'=>$this->input->post('site_cash_advance_from_id'),
							'destination_to_rowID'=>$this->input->post('site_cash_advance_to_id'),
							'tr_jo_trx_hdr_year'=>$this->input->post('site_cash_advance_jo_year'),
							'tr_jo_trx_hdr_month'=>$this->input->post('site_cash_advance_jo_month'),
							'tr_jo_trx_hdr_code'=>$this->input->post('site_cash_advance_jo_code'),
							'debtor_rowID'=>$this->input->post('site_cash_advance_debtor_id'),
							'item_rowID'=>$this->input->post('site_cash_advance_item_id'),
							'advance_amt'=>$amount_site_cash_advance,
							'balance_amt'=>$amount_site_cash_advance,
							'description'=>ucfirst($this->input->post('site_cash_advance_description')),
							'user_created'=>$this->session->userdata('user_id'),
							'date_created'=>date('Y-m-d'),
							'time_created'=>date('H:i:s')							
			         );
					 
					 $transaksi_header_data = array(
							'year' => $year,
							'month'=>$month,
							'code' => $code,
							'trx_no'=>$adv_no,
							'trx_date'=>$this->input->post('site_cash_advance_date'),
							'gl_coa_rowID'=>$gl_coa_rowID1,
							'descs'=>ucfirst($this->input->post('site_cash_advance_description')),
							'trx_amt'=>$amount_site_cash_advance * -1,
							'debtor_rowID'=>$this->input->post('site_cash_advance_debtor_id'),
							'recon_status'=>'N',
							'user_created'=>$this->session->userdata('user_id'),
							'date_created'=>date('Y-m-d'),
							'time_created'=>date('H:i:s')							
			         );
					 
					 $transaksi_detail_data = array(
							'cb_trx_hdr_year' => $year,
							'cb_trx_hdr_month'=>$month,
							'cb_trx_hdr_code' => $code,
							'row_no' => '1',
							'trx_no'=>$adv_no,
							'trx_date'=>$this->input->post('site_cash_advance_date'),
							'gl_coa_rowID'=>$gl_rowID,
							'trx_amt'=>$amount_site_cash_advance,
							'descs'=>ucfirst($this->input->post('site_cash_advance_description')),
							'user_created'=>$this->session->userdata('user_id'),
							'date_created'=>date('Y-m-d'),
							'time_created'=>date('H:i:s')							
			         );
					 
					 $journal_header_data = array(
							'year' => $year,
							'month'=>$month,
							'code' => $code,
							'journal_no'=>$journal_no,
							'ref_no'=>$adv_no,
							'journal_date'=>$this->input->post('site_cash_advance_date'),
							'descs'=>ucfirst($this->input->post('site_cash_advance_description')),
							'trx_amt'=>$amount_site_cash_advance,
							'user_created'=>$this->session->userdata('user_id'),
							'date_created'=>date('Y-m-d'),
							'time_created'=>date('H:i:s')							
			         );
					 
					 $journal_detail_data1 = array(
							'gl_trx_hdr_year' => $year,
							'gl_trx_hdr_month'=>$month,
							'gl_trx_hdr_code' => $code,
							'gl_trx_hdr_journal_no'=>$journal_no,
							'ref_no'=>$adv_no,
							'row_no'=>$journal_no,
							'journal_date'=>$this->input->post('site_cash_advance_date'),
							'descs'=>ucfirst($this->input->post('site_cash_advance_description')),
							'trx_amt'=>$amount_site_cash_advance,
							'gl_coa_rowID'=>$gl_rowID,
							'ref_trx_date'=>$this->input->post('site_cash_advance_date'),
							'debtor_rowID'=>$this->input->post('site_cash_advance_debtor_id'),
							'employee_driver_rowID'=>$this->input->post('site_cash_advance_driveremployee'),
							'modul'=>'CB',
							'cash_flow'=>'Y',
							'user_created'=>$this->session->userdata('user_id'),
							'date_created'=>date('Y-m-d'),
							'time_created'=>date('H:i:s')							
			         );
					 
					 $journal_detail_data2 = array(
							'gl_trx_hdr_year' => $year,
							'gl_trx_hdr_month'=>$month,
							'gl_trx_hdr_code' => $code,
							'gl_trx_hdr_journal_no'=>$journal_no,
							'ref_no'=>$adv_no,
							'row_no'=>$journal_no,
							'journal_date'=>$this->input->post('site_cash_advance_date'),
							'descs'=>ucfirst($this->input->post('site_cash_advance_description')),
							'trx_amt'=>$amount_site_cash_advance * -1,
							'gl_coa_rowID'=>$gl_coa_rowID1,
							'ref_trx_date'=>$this->input->post('site_cash_advance_date'),
							'debtor_rowID'=>$this->input->post('site_cash_advance_debtor_id'),
							'employee_driver_rowID'=>$this->input->post('site_cash_advance_driveremployee'),
							'modul'=>'CB',
							'cash_flow'=>'Y',
							'user_created'=>$this->session->userdata('user_id'),
							'date_created'=>date('Y-m-d'),
							'time_created'=>date('H:i:s')							
			         );
					 
					$this->db->insert('cb_cash_adv', $site_cash_advance_data);
					$this->db->insert('cb_trx_hdr', $transaksi_header_data);
					$this->db->insert('cb_trx_dtl', $transaksi_detail_data);
					$this->db->insert('gl_trx_hdr', $journal_header_data);
					$this->db->insert('gl_trx_dtl', $journal_detail_data1);
					$this->db->insert('gl_trx_dtl', $journal_detail_data2);
					$this->db->insert('gl_balance', $journal_detail_data2);
					$this->db->insert('cb_balance', $journal_detail_data2);
					
					$site_cash_advance_id = $this->db->insert_id();

					$params['user_rowID'] = $this->tank_auth->get_user_id();
					$params['module'] = 'site_cash_advances';
					$params['module_field_id'] = $site_cash_advance_id;
					$params['activity'] = ucfirst('Added a new Site Cash Advance '.$adv_no);
					$params['icon'] = 'fa-user';
					modules::run('activitylog/log',$params); //log activity

					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', lang('site_cash_advance_registered_successfully'));
					redirect('site_cash_advance/view_sca/'.$year.'/'.$month.'/'.$hasil);
				}
		}else{
			$this->load->module('layouts');
			$this->load->library('template');
			$data['datatables'] = TRUE;
			$data['form'] = TRUE;
						
			
			$data['advance_types'] = $this->site_cash_advance_model->get_all_records($table = 'sa_advance_type', $array = array(
			'rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','rowID','desc');
			
			$data['driveremployees'] = $this->site_cash_advance_model->get_all_records_driveremployee();
		
			$this->template
			->set_layout('users')
			->build('create_site_cash_advance',isset($data) ? $data : NULL);
		}
	}
	
	function view_sca()
	{
			
			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title('edit_job_orders '.' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
			$data['page'] = 'edit_job_orders';
			$this->session->set_userdata('page_header', 'master');		
			$this->session->set_userdata('page_detail', 'edit_job_order');
			$data['form'] = TRUE;
			$data['datatables'] = TRUE;
			
			
			$year=$this->uri->segment(3);
			$month=$this->uri->segment(4);
			$code=$this->uri->segment(5);
			
			$data['site_cash_advances'] = $this->site_cash_advance_model->get_all_records_cash_adv($year,$month,$code);
			
			$this->template
			->set_layout('users')
			->build('view_site_cash_advances',isset($data) ? $data : NULL);
			
			
	}
	
function delete()
	{
		if ($this->input->post()) {

			$year = $this->input->post('year');
			$month = $this->input->post('month');
			$code = $this->input->post('code');
			$site_cash_advance_data = array(
							'deleted'=>1,
							'user_deleted'=>$this->session->userdata('user_id'),
							'date_deleted'=>date('Y-m-d'),
							'time_deleted'=>date('H:i:s')							
			            );

			$this->db->where('year',$year);
			$this->db->where('month',$month);
			$this->db->where('code',$code);
			$this->db->update('cb_cash_adv',$site_cash_advance_data); 

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('site_cash_advance_deleted_successfully'));
			redirect('site_cash_advance');
		}else{
			
			$data['site_cash_advance_details'] = $this->site_cash_advance_model->get_all_records_update($this->uri->segment(3),$this->uri->segment(4),$this->uri->segment(5)); 
			
			$this->load->view('modal/delete_site_cash_advance',$data);

		}
	}
	
	function add_job_order()
	{
			$tahun = $this->input->get('tahun');
			$no_jo = $this->input->get('no_jo');
			
			if($tahun!=""){
				$tahun=$tahun;
			}else{
				$tahun=date('Y');
			}
			
            $per_page = abs($this->input->get('per_page'));
            $limit = 5;
			
            $tot = $this->site_cash_advance_model->all_jo($tahun,$no_jo);
            $data['job_orders']   = $this->site_cash_advance_model->limit_jo($tahun,$no_jo,$limit,$per_page);
			
            $pagination['page_query_string']  	= TRUE;    
            $pagination['base_url']          	= site_url().'/site_cash_advance/add_job_order?';
            $pagination['total_rows'] 			= $tot->num_rows();
            $pagination['per_page']           	= $limit;
            $pagination['uri_segment']        	= $per_page;
            $pagination['num_links']          	= 2;


            $pagination['full_tag_open'] = '<ul class="pagination">';
            $pagination['full_tag_close'] = '</ul>';

            $pagination['first_link'] = '<<';
            $pagination['first_tag_open'] = '<li class="prev page">';
            $pagination['first_tag_close'] = '</li>';

            $pagination['last_link'] = '>>';
            $pagination['last_tag_open'] = '<li class="next page">';
            $pagination['last_tag_close'] = '</li>';

            $pagination['next_link'] = '>';
            $pagination['next_tag_open'] = '<li class="next page">';
            $pagination['next_tag_close'] = '</li>';

            $pagination['prev_link'] = '<';
            $pagination['prev_tag_open'] = '<li class="prev page">';
            $pagination['prev_tag_close'] = '</li>';

            $pagination['cur_tag_open'] = '<li class="active"><a href="">';
            $pagination['cur_tag_close'] = '</a></li>';

            $pagination['num_tag_open'] = '<li class="page">';
            $pagination['num_tag_close'] = '</li>'; 
			
			
			
			$this->pagination->initialize($pagination); 
			$data['years']= $this->site_cash_advance_model->get_year();
			$this->load->view('add_job_orders',$data);
	}
	
	
}

/* End of file contacts.php */