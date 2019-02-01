<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Manage extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('orders_model','order');
		
	}
  
	function addsjk()
	{
		if ($this->input->post()) {
		//$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('vessel_id', 'Vessel ID', 'required');
		$this->form_validation->set_rules('truck_id', 'Truck ID', 'required');
		$this->form_validation->set_rules('qty_bulk_delivery_bruto', 'Bruto', 'required|numeric');
		$this->form_validation->set_rules('qty_bulk_delivery_tarra', 'Tarra', 'required|numeric');
		$this->form_validation->set_rules('qty_bulk_delivery_netto', 'Netto', 'required|numeric');
		$this->form_validation->set_rules('driver_name', 'Driver Name', 'required|max_length[20]');
		$this->form_validation->set_rules('palka_id', 'Palka ID', 'required');

		if ($this->form_validation->run() == FALSE)
		{		
				$document_separate_id=trim($this->input->post('document_separate_id'));
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('orders/manage/addsjk/'.$document_separate_id);
		}else if($this->input->post('qty_bulk_delivery_netto')<=0) {
				
				$document_separate_id=trim($this->input->post('document_separate_id'));
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('orders/manage/addsjk/'.$document_separate_id);
		
		}else{	
			$year_period = date('Y');		
			$document_id=trim($this->input->post('document_id'));
			$document_separate_id=trim($this->input->post('document_separate_id'));			
			$vessel_id=trim($this->input->post('vessel_id'));
			$vessel_ref=trim($this->input->post('vessel_ref'));
			$destination_from=trim($this->input->post('destination_from'));
			$destination_to=trim($this->input->post('destination_to'));
			$destination_ref=trim($this->input->post('destination_ref'));
			$item_id=trim($this->input->post('item_id'));
			$item_type=trim($this->input->post('item_type'));
			$party_id=trim($this->input->post('party_id'));
			$party_name=trim($this->input->post('party_ref'));
			$po_ref=trim($this->input->post('po_ref'));
			$po_client=trim($this->input->post('po_ref'));
			$po_date=trim($this->input->post('po_date'));
			$qty_po=trim($this->input->post('qty_po'));
			$palka_id=trim($this->input->post('palka_id'));
			$truck_id=trim($this->input->post('truck_id'));
			$truck_type_id=trim($this->input->post('truck_type_id'));
			$transporter_id=trim($this->input->post('transporter_id'));
			$shipping_name=trim($this->input->post('shipping_name'));
			$stevedore_name=trim($this->input->post('stevedore_name'));
			$bl_doc=trim($this->input->post('bl_doc'));
			$client_id=trim($this->input->post('client_id'));
			$qty_bulk_delivery_bruto=trim($this->input->post('qty_bulk_delivery_bruto'));	
			$qty_bulk_delivery_tarra=trim($this->input->post('qty_bulk_delivery_tarra'));
			$qty_bulk_delivery_netto=trim($this->input->post('qty_bulk_delivery_netto'));
			$driver_name=trim($this->input->post('driver_name'));	
			$destination_description=trim($this->input->post('destination_description'));
			$remarks=trim($this->input->post('remarks'));	
			
			
			$max_no= ((int)$this->AppModel->select_max_id('trx_sj',$array = array(
			'vessel_id' => $vessel_id, 'party_id' => $party_id, 'document_separate_id' => $document_separate_id, 'destination_to' => $destination_to, 'deleted' => 0),'sj_no'))+1;
			
					
			$sj_ref = substr($vessel_ref,-5).$party_name."-".$destination_ref."-".sprintf("%04s", $max_no);
			$form_data = array(
							'sj_period'				=> 	$year_period,
							'document_id'			=>	$document_id,
							'document_separate_id'	=>	$document_separate_id,
							'company_id' 			=> 	$this->session->userdata('company_id'),
							'site_id' 				=>	$this->session->userdata('site_id'),							
							'vessel_id' 			=> 	$vessel_id,
			                'sj_no' 				=> 	$max_no,	
							'sj_ref' 				=> 	$sj_ref,
							'sj_date' 				=> 	date('Y-m-d'),
							'sj_time' 				=> 	date('H:i:s'),
							'destination_from'		=>	$destination_from, 		
							'destination_to'		=> 	$destination_to,							
							'item_id'				=>	$item_id, 		
							'item_type'				=> 	$item_type,							
							'party_id' 				=> 	$party_id,
							'po_ref'				=>	$po_ref, 		
							'po_client'				=> 	$po_ref,							
							'po_date' 				=> 	$po_date,
							'qty_po'				=>	$qty_po,
							'palka_id'				=>	$palka_id, 		
							'truck_id'				=> 	$truck_id,							
							'truck_type_id' 		=> 	$truck_type_id,
							'transporter_id' 		=> 	$transporter_id,
							'shipping_name'			=>	strtoupper($shipping_name),
							'stevedore_name'		=>	strtoupper($stevedore_name),
							'bl_doc'				=>	strtoupper($bl_doc),
							'client_id'				=> 	$client_id,							
							'qty_bulk_delivery_bruto' => 	$qty_bulk_delivery_bruto,
							'qty_bulk_delivery_tarra' => 	$qty_bulk_delivery_tarra,
							'qty_bulk_delivery_netto' =>	$qty_bulk_delivery_netto,
							'driver_name' 			=> 	strtoupper($driver_name),
							'destination_description'=>	$destination_description, 		
							'remarks'				=> 	strtoupper($remarks),							
							'user_created'			=>	$this->session->userdata('user_id'),
							'date_created'			=>	date('Y-m-d'),
							'time_created'			=>	date('H:i:s'),							
			            );
			$this->db->insert('trx_sj', $form_data); 
			$sj_id = $this->db->insert_id();

			$activity = ucfirst('Order #'.$sj_ref.' created.');
			$this->_log_activity($sj_id,$activity,$icon = 'fa-plus'); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('order_created_successfully'));
			redirect('orders/manage/preview_sjk/'.$sj_id);//.$sj_id
		}

		}else{


			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title(lang('orders').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
			$data['page'] = lang('orders');
			$data['form'] = TRUE;
			
			
			$data['destinantion_sources'] = $this->AppModel->get_all_records($table = 'users', $array = array(
				'id' => $this->session->userdata('user_id')), $join_table = 'mst_destinations', $join_criteria = 'mst_destinations.destination_id=users.destination_id','id');
			
			$data['vessel_defaults'] = $this->AppModel->get_all_records($table = 'users', $array = array(
				'id' => $this->session->userdata('user_id')), $join_table = 'mst_vessels', $join_criteria = 'mst_vessels.vessel_id=users.vessel_id','id');
			
				
			//$data['trucks'] = $this->AppModel->get_all_records($table = 'mst_trucks', $array = array(
			//'truck_id >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '','truck_name');
			
			$data['trucks'] = $this->order->get_all_records($table = 'mst_trucks', $array = array(
			'truck_id >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '','truck_name');
			
			$data['palkas'] = $this->AppModel->get_all_records_asc($table = 'mst_reference', $array = array(
			'No_Urut_Ref >' => 0, 'Type_Ref' => 'vessel_palka'), $join_table = '', $join_criteria = '','No_Urut_Ref');
			
			$data['total_sjkorder']=$this->order->sum_item($table='trx_sj',$array = array('document_separate_id' => $this->uri->segment(4), 'deleted' => 0),'qty_bulk_delivery_netto');
			
			$data['difference_destination']=$this->order->sum_item($table='trx_document_separate',$array = array('document_separate_id' => $this->uri->segment(4)),'qty_destination')-$this->order->sum_item($table='trx_sj',$array = array('document_separate_id' => $this->uri->segment(4), 'deleted' => 0),'qty_bulk_delivery_netto');
			
			$data['document_destination_vessel'] = $this->order->document_destination_vessel($this->session->userdata('vessel_active'),$this->session->userdata('filter_client_id'));
			
			$data['document_destination_details'] = $this->order->document_destination_details($this->uri->segment(4));
			
			$data['filter_by_clients']=$this->order->filter_by_client($this->session->userdata('vessel_active'));
			
			$data['unload_receipts']=$this->order->unload_receipt_list($this->session->userdata('vessel_active'));
			
			$this->template
			->set_layout('users')
			->build('create_sjk',isset($data) ? $data : NULL);

		}
	}
	
	function preview_sjk()
	{
		
		if ($this->input->post()) {
		
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('sj_id', 'Delivery Order ID', 'required');
		$this->form_validation->set_rules('sj_ref', 'Delivery Order Reference', 'required');
		$this->form_validation->set_rules('document_separate_id', 'Document Separate ID', 'required');
		
		$sj_id=trim($this->input->post('sj_id'));
		$sj_ref=substr(trim($this->input->post('sj_ref')),-13);
		$party=trim($this->input->post('party_ref'));
		
		$document_separate_id=trim($this->input->post('document_separate_id'));
		
		
		if ($this->form_validation->run() == FALSE)
		{				
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('orders/manage/preview_sjk/'.$sj_id);
				

		}else if($this->order->check_print($array = array('sj_id' => $sj_id, 'printed' => 1))) {
				
				
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('print_operation_failed'));
				redirect('orders/manage/preview_sjk/'.$sj_id);
		
		}else{	
		
			$sjk_detail= $this->order->sjk_details($sj_id);
		
			if(!empty($sjk_detail)){
				foreach($sjk_detail as $row){
					
			$tmpdir = sys_get_temp_dir();   # ambil direktori temporary untuk simpan file.
			$file =  tempnam($tmpdir, 'ctk'.$sj_ref.$this->session->userdata('user_id'));  # nama file temporary yang akan dicetak
			$handle = fopen($file, 'w');
			$ht=Chr(9);
			$condensed  = Chr (27). Chr (33). Chr (4);
			$font0  = Chr (27). Chr (33). Chr (16);
			$font1  = Chr (27). Chr (33). Chr (32);
			$fontoff  = Chr (27). Chr (33). Chr (0);
			$bold1  = Chr (27). Chr (69);
			$bold0  = Chr (27). Chr (70);
			$font2  = Chr (27). Chr (119) . Chr(1);
			$font3  = Chr (27). Chr (119) . Chr(0);
			
			$initialized = chr(27).chr(64);			
			$condensed1 = chr(15);
			$condensed0 = chr(18);
			$Data  = $initialized;
			$Data .= $condensed1;
			$Data .= "\n";
			$Data .= "\n";
			$Data .= "";
			$Data .= "";
			$Data .= "											".$bold1.$font1.$sj_ref.$font0."\n\n\n";
			$Data .= "		".$row->destination_name_from."\n";
			$Data .= "		".$row->vessel_name."/".$row->palka_name."\t\t  ".$font1.trim($row->destination_name_to).$fontoff."\n";
			$Data .= "		".$row->po_ref."\t\t\t ".trim($row->address_1)."\n";
			$Data .= "		".$row->truck_name."\t\t\t\n";
			$Data .= "		".$row->truck_type."\t\t\t\t ".trim($row->address_2)."\n";
			$Data .= "		".$row->transporter_name."\n";
			$Data .= "\n";
			$Data .= "\n";
			$Data .= "\n\n";
			$Data .= " ".$font1.$row->item_name."\t\t\t ".number_format($row->qty_bulk_delivery_netto,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))."\n";
			$Data .= "\n\n";
			$Data .= "\t***".$row->remarks."***\n";
			$Data .= "\t\t".$row->destination_description."\n";			
			$Data .= "\n\n";
			$Data .= "\t   ".$ht.$ht.$font0." \t  PERIKSA! TARRA KIRIM"."\n";
			$Data .= "\t\t\t\t\t\t".$ht.$ht."TARRA TERIMA"."\n";
			$Data .= "\t\t\t\t\t\t".$ht.$ht."JUMLAH SEGEL".$fontoff.$bold0."";			
			$Data .= "\n ".strtoupper($row->username)."				".$row->driver_name."\n";
			$Data .= "\n\n";
			$Data .= "\t   ".strftime("%d %b %Y", strtotime($row->sj_date))."\t".$row->sj_time."\n";
			fwrite($handle, $Data);
			fclose($handle);
			copy($file, "//200.10.10.180/EPS310");  # Lakukan cetak 
			unlink($file);	
		
		
		

				$form_data = array(
							'printed'	=>	1,
							'user_print'=>	$this->session->userdata('user_id'),
							'print_date'=>	date('Y-m-d'),
							'print_time'=>	date('H:i:s'),							
			            );
						
				$this->db->where('sj_id',$sj_id)->update('trx_sj', $form_data);		
			
				$activity = ucfirst($this->tank_auth->get_username().' printed Order ID #'.$this->input->post('sj_ref'));
				$this->_log_activity($sj_id,$activity,$icon = 'fa-pencil'); //log activity

				$this->session->set_flashdata('response_status', 'success');
				$this->session->set_flashdata('message', lang('do_print_successfully'));
				redirect('orders/manage/addsjk/'.$document_separate_id);		

				}
			}

		}

		}else{


			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title(lang('orders').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
			$data['page'] = lang('orders');
			$data['form'] = TRUE;
			
			$data['document_destination_vessel'] = $this->order->document_destination_vessel($this->session->userdata('vessel_active'),$this->session->userdata('filter_client_id'));
			$data['sjk_details'] = $this->order->sjk_details($this->uri->segment(4));
			$data['filter_by_clients']=$this->order->filter_by_client($this->session->userdata('vessel_active'));
			
			$this->template
			->set_layout('users')
			->build('preview_sjk',isset($data) ? $data : NULL);
	
			
			
		}
	}
	
	
	
	function get_client_order_list(){
	    $client_id=$this->input->post('clientid');
		$linkdata=$this->input->post('linkdata');
		$data['document_destination_vessel'] = $this->order->document_destination_vessel($this->session->userdata('vessel_active'),$client_id); 
		
		$data['linkdata']=$linkdata;
		
		$this->session->set_userdata('filter_client_id', $client_id);
		
        $this->load->view('ajax_detail_client_order_list',$data);
	}
	
	function delivery_order_list(){
	
			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title(lang('orders').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
			$data['page'] = lang('orders');
			$data['form'] = TRUE;
			$data['datatables'] = TRUE;
			
			$data['document_destination_vessel'] = $this->order->document_destination_vessel($this->session->userdata('vessel_active'),$this->session->userdata('filter_client_id'));
			$data['sjk_order_lists'] = $this->order->sjk_order_list($this->uri->segment(4));
			$data['filter_by_clients']=$this->order->filter_by_client($this->session->userdata('vessel_active'));
			
			$this->template
			->set_layout('users')
			->build('delivery_order_list',isset($data) ? $data : NULL);
	
	}
	
	function delete_delivery_order_list(){
	
			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title(lang('orders').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
			$data['page'] = lang('orders');
			$data['form'] = TRUE;
			$data['datatables'] = TRUE;
			
			$data['document_destination_vessel'] = $this->order->document_destination_vessel($this->session->userdata('vessel_active'),$this->session->userdata('filter_client_id'));
			$data['sjk_order_lists'] = $this->order->delete_sjk_order_list($this->uri->segment(4));
			$data['filter_by_clients']=$this->order->filter_by_client($this->session->userdata('vessel_active'));
			
			$this->template
			->set_layout('users')
			->build('delete_delivery_order_list',isset($data) ? $data : NULL);
	
	}	
	
	
    function get_detail_pelanggan(){
        $id['truck_id']=$this->input->post('truckid');
        $data=array(
            'detail_pelanggan'=>$this->AppModel->getTransporter($array = array('a.truck_id' => $this->input->post('truckid'), 'a.deleted' => 0))->result(),
        ); 
		
       $this->load->view('ajax_detail_trucks',$data);
    }
	
     function get_detail_unloadreceipt(){		

			$details_unloadreceipt = $this->AppModel->unload_receipt_details($this->input->post('truckid'));
			
			if(!empty($details_unloadreceipt)){
				header('Content-Type: application/json');
				foreach($details_unloadreceipt as $detail_unloadreceipt){
					$arr = array('driver_name' =>$detail_unloadreceipt->driver_name, 'unload_receipt_ref' =>$detail_unloadreceipt->unload_receipt_ref);					
				}				
				header('Content-type: application/json');
				echo json_encode($arr);
			}

			exit; // no need to render the template
    }

	
	function editsjk()
	{
		if ($this->input->post()) {
		//$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');

		$this->form_validation->set_rules('sj_id', 'Delivery Order ID', 'required');
		$this->form_validation->set_rules('truck_id', 'Truck ID', 'required');
		$this->form_validation->set_rules('qty_bulk_delivery_bruto', 'Bruto', 'required|numeric');
		$this->form_validation->set_rules('qty_bulk_delivery_tarra', 'Tarra', 'required|numeric');
		$this->form_validation->set_rules('qty_bulk_delivery_netto', 'Netto', 'required|numeric');
		$this->form_validation->set_rules('driver_name', 'Driver Name', 'required|max_length[20]');
		$this->form_validation->set_rules('palka_id', 'Palka ID', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('orders');
				
		}else if($this->input->post('qty_bulk_delivery_netto')<=0) {
				
				$sj_id=trim($this->input->post('sj_id'));
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('orders/manage/editsjk/'.$sj_id);		
		}else{	
			$sj_id = $this->input->post('sj_id', TRUE);	
			//cek data
			$truck_id=trim($this->input->post('truck_id'));
			$palka_id=trim($this->input->post('palka_id'));
			$qty_bulk_delivery_bruto=trim($this->input->post('qty_bulk_delivery_bruto'));	
			$qty_bulk_delivery_tarra=trim($this->input->post('qty_bulk_delivery_tarra'));
			$qty_bulk_delivery_netto=trim($this->input->post('qty_bulk_delivery_netto'));
			$driver_name=strtoupper(trim($this->input->post('driver_name')));	
			
			$form_data = array(
			                'truck_id' => $truck_id,
							'qty_bulk_delivery_bruto' => $qty_bulk_delivery_bruto,
							'qty_bulk_delivery_tarra' => $qty_bulk_delivery_tarra,
							'qty_bulk_delivery_netto' => $qty_bulk_delivery_netto,
							'driver_name' 			=> $driver_name,
							'palka_id'				=>	$palka_id,
							'user_modified'			=>	$this->session->userdata('user_id'),
							'date_modified'			=>	date('Y-m-d'),
							'time_modified'			=>	date('H:i:s'),
			            );
						
			$this->db->where('sj_id',$sj_id)->update('trx_sj', $form_data);

			$activity = ucfirst($this->tank_auth->get_username().' edited DO NO #'.$this->input->post('sj_ref'));
			$this->_log_activity($sj_id,$activity,$icon = 'fa-pencil'); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('order_edited_successfully'));
			redirect('orders/manage/preview_sjk/'.$sj_id);
		}

		}else{


			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title(lang('orders').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
			$data['page'] = lang('orders');
			$data['form'] = TRUE;
			
			$data['trucks'] = $this->order->get_all_records($table = 'mst_trucks', $array = array(
			'truck_id >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '','truck_name');
			
			$data['palkas'] = $this->AppModel->get_all_records_asc($table = 'mst_reference', $array = array(
			'No_Urut_Ref >' => 0, 'Type_Ref' => 'vessel_palka'), $join_table = '', $join_criteria = '','No_Urut_Ref');
			
			$data['document_destination_vessel'] = $this->order->document_destination_vessel($this->session->userdata('vessel_active'),$this->session->userdata('filter_client_id'));
			
			$data['sjk_details'] = $this->order->sjk_details($this->uri->segment(4));
			
			$data['filter_by_clients']=$this->order->filter_by_client($this->session->userdata('vessel_active'));
			
			$this->template
			->set_layout('users')
			->build('edit_sjk',isset($data) ? $data : NULL);

		}
	}
	
	function deletesjk()
	{
		if ($this->input->post()) {
		//$this->load->library('form_validation');
		$this->form_validation->set_rules('sj_id', 'Delivery Order ID', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('delete_failed'));
				redirect('orders');
		}else{			

			$form_data = array(
			                'deleted' => 1,
							'barcode_id' => 0,
							'deleted_remark' => $this->input->post('deleted_remark').'bc'.$this->input->post('barcode_id'),
							'user_deleted'	=>	$this->session->userdata('user_id'),
							'date_deleted'	=>	date('Y-m-d'),
							'time_deleted'	=>	date('H:i:s'),
			            );
		
			$this->db->where(array('sj_id' => $this->input->post('sj_id'), 'deleted' => 0))->update('trx_sj', $form_data);


			$activity = $this->tank_auth->get_username()." deleted delivery order No. # ".$this->input->post('sj_ref') ;
			$this->_log_activity($this->input->post('sj_id'),$activity,$icon = 'fa-times'); //log activity
			
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('issue_deleted_successfully'));
			redirect('orders/manage/delivery_order_list/'.$this->input->post('document_separate_id'));
		}
		}else{
	
			
			$data['sjk_details'] = $this->order->get_all_records($table = 'trx_sj',
			$array = array('sj_id' => $this->uri->segment(4), 'deleted' => 0),
			$join_table = '',$join_criteria = '','sj_id');
			
			
			$this->load->view('modal/delete_sjk',$data);
	

		}
	}


	
	function document_vessel()
	{
		if ($this->input->post()) {
		//$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('vessel_id', 'Vessel ID', 'trim|required|xss_clean');
		$this->form_validation->set_rules('party_id', 'Party ID', 'trim|required|xss_clean');
		$this->form_validation->set_rules('po_ref', 'PO Reference', 'trim|required|min_length[1]|max_length[25]|xss_clean');
		$this->form_validation->set_rules('item_id', 'Item ID', 'trim|required|xss_clean');
		$this->form_validation->set_rules('item_type_id', 'Item Type', 'trim|required|min_length[1]|max_length[1]|xss_clean');
		$this->form_validation->set_rules('qty_po', 'Qty PO', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('client_id', 'Client ID', 'trim|required|xss_clean');
		
		
		$vessel_id = $this->input->post('vessel_id', TRUE);	
		$party_id = $this->input->post('party_id', TRUE);
		
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('vessels/manage/document_vessel/'.$vessel_id);
		}else if ($this->vessel->check_vessel($array = array('vessel_id' => $vessel_id, 'party_id' => $party_id, 'deleted' => 0))){
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('vessels/manage/document_vessel/'.$vessel_id);
		}else{
			$form_data = array(
							'company_id' 			=> 	$this->session->userdata('company_id'),
							'site_id' 				=>	$this->session->userdata('site_id'),
							'vessel_id'=>$vessel_id,
							'party_id'=>$party_id,
							'po_ref' => $this->input->post('po_ref'),
			                'po_date' => date ("Y-m-d", $this->input->post('po_date')),
							'client_id' => $this->input->post('client_id'),
							'item_id' => $this->input->post('item_id'),
							'item_type' =>$this->input->post('item_type_id'),
							'qty_po' =>$this->input->post('qty_po'),							
							'tolerence' =>$this->input->post('tolerence'),	
							'port_id' =>$this->input->post('port_name'),	
							'shipping_name' =>$this->input->post('shipping_name'),	
							'stevedore_name' =>$this->input->post('stevedore_name'),	
							'bl_doc' =>$this->input->post('bl_doc'),								
							'user_created'=>$this->session->userdata('user_id'),
							'date_created'=>date('Y-m-d'),
							'time_created'=>date('H:i:s'),							
			            );
			$this->db->insert('trx_vessel_document', $form_data); 
			$document_id = $this->db->insert_id();

			$activity = ucfirst('Vessel #'.$document_id.' created.');
			$this->_log_activity($document_id,$activity,$icon = 'fa-plus'); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('document_vessel_created_successfully'));
			redirect('vessels/manage/document_vessel_separate/'.$document_id );//.$vessel_id
		}

		}else{


			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title(lang('vessels').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
			$data['page'] = lang('vessels');
			$data['form'] = TRUE;
			
			$data['parties'] =$this->vessel->parties_select($this->uri->segment(4));		
			//$this->AppModel->get_all_record_reference($table = 'mst_reference',
			//	$array = array('Type_Ref' => 'party'),'No_Urut_Ref');

			$data['items'] = $this->AppModel->get_all_records($table = 'mst_items',
			$array = array('item_id >' => 0, 'deleted' => 0),
			$join_table = '',$join_criteria = '','item_id');
			

			$data['clients'] = $this->AppModel->get_all_records($table = 'mst_clients',
			$array = array('client_id >' => 0, 'deleted' => 0),
			$join_table = '',$join_criteria = '','client_id');

			$data['vessel_status'] = $this->AppModel->get_all_record_reference($table = 'mst_reference',
				$array = array('Type_Ref' => 'vessel_status'),'No_Urut_Ref');
					
			$data['vessels'] = $this->AppModel->get_all_records_limit($table = 'mst_vessels',
			$array = array(
			'vessel_id >' => 0, 'deleted' => 0
			),
			$join_table = 'mst_reference',$join_criteria = 'mst_reference.No_Urut_Ref = mst_vessels.vessel_status AND fx_mst_reference.Type_Ref="vessel_status"','vessel_ref', 10);
			
			$data['vessel_details'] = $this->AppModel->get_all_records($table = 'mst_vessels',
			$array = array('vessel_id' => $this->uri->segment(4), 'deleted' => 0),
			$join_table = '',$join_criteria = '','vessel_id');


			$this->template
			->set_layout('users')
			->build('document_vessel',isset($data) ? $data : NULL);

		}
	}	
	
	function _check_vessel()
	{
		$vessel_id=$this->input->post('vessel_id');
		$party_id=$this->input->post('party_id');
        $result=$this->vessel->check_vessel($array = array('vessel_id' => $vessel_id, 'party_id' => $party_id, 'deleted' => 0));
        if($result)
		{
			//$this->form_validation->set_message('_check_vessel', 'Party have already input');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	

	function document_vessel_separate()
	{		
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('vessels').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		
		//$vessel_id = $this->encrypt->decode($this->uri->segment(4));
		$data['page'] = lang('vessels');
		$data['form'] = TRUE;
		
		//VESSEL ALL 10ROWS LEFT SIDE	
		$data['vessels'] = $this->AppModel->get_all_records_limit($table = 'mst_vessels',
		$array = array(
			'vessel_id >' => 0, 'deleted' => 0
			),
		$join_table = 'mst_reference',$join_criteria = 'mst_reference.No_Urut_Ref = mst_vessels.vessel_status AND fx_mst_reference.Type_Ref="vessel_status"','vessel_ref', 10);
		
		//MASTER STATUS VESSEL
		$data['vessel_status'] = $this->AppModel->get_all_record_reference($table = 'mst_reference',
		$array = array('Type_Ref' => 'vessel_status'),'No_Urut_Ref');	

		//MASTER DESTINATION
 		$data['destinations'] = $this->AppModel->get_all_records($table = 'mst_destinations', $array = array(
			'destination_id >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '','destination_name');			
		


		//TRX DOCUMENT DETAILS		
		$data['document_details'] = $this->vessel->document_detail($this->uri->segment(4));		

		//
		$data['destination_items'] = $this->AppModel->get_all_records_asc($table = 'trx_document_separate', $array = array(
		'document_id =' =>  $this->uri->segment(4)), $join_table = 'mst_destinations', $join_criteria = 'mst_destinations.destination_id=trx_document_separate.destination_id','destination_name');
		

			
			
		$this->template
		->set_layout('users')
		->build('document_vessel_separate',isset($data) ? $data : NULL);
	}

	function destination_details()
	{
		if ($this->input->post()) {
		$document_id = $this->input->post('document_id');
		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('document_id', 'Document ID', 'required');
		$this->form_validation->set_rules('destination_id', 'Destination ID', 'required');
		$this->form_validation->set_rules('dest_desc', 'Destination Description', 'required');
		$this->form_validation->set_rules('destination_qty', 'Destination Quantity', 'required|numeric');

		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('vessels/manage/document_vessel_separate/'.$document_id);
		}else if ($this->vessel->check_key($table='trx_document_separate',$array = array('document_id' => $document_id, 'destination_id' =>  $this->input->post('destination_id')))){
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('vessels/manage/document_vessel_separate/'.$document_id);
		}else if ($this->vessel->sum_item($table='trx_document_separate',$array = array('document_id' => $document_id),'qty_destination')+$this->input->post('destination_qty')>$this->vessel->sum_item($table='fx_trx_vessel_document',$array = array('document_id' => $document_id),'qty_po')){
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('vessels/manage/document_vessel_separate/'.$document_id);					
		}else{			
			$form_data = array(
							'document_id' => $this->input->post('document_id'),
			                'destination_id' => $this->input->post('destination_id'),
			                'destination_description' => $this->input->post('dest_desc'),
			                'qty_destination' => $this->input->post('destination_qty'),
			                'remarks' => $this->input->post('remarks')
			            );
			$this->db->insert('trx_document_separate', $form_data); 
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('destination_added_successfully'));
			
			
			redirect('vessels/manage/document_vessel_separate/'.$document_id);
		}

		}else{

			redirect('vessels');

		}
	}

	function edit_destination(){
	
		if ($this->input->post() ){
			$document_id = $this->input->post('document_id');
			$document_separate_id = $this->input->post('document_separate_id');
			
			$this->load->library('form_validation');

			$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
			$this->form_validation->set_rules('document_id', 'Document ID', 'required');
			$this->form_validation->set_rules('document_separate_id', 'Document Separate ID', 'required');
			$this->form_validation->set_rules('destination_description', 'Desctination Description', 'required');
			$this->form_validation->set_rules('qty_destination', 'Total Item', 'required|min_length[1]|max_length[12]|numeric');
			$this->form_validation->set_rules('remarks', 'Remarks', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('vessels/manage/document_vessel_separate/'.$document_id);
			}else if (($this->vessel->sum_item($table='trx_document_separate',$array = array('document_id' => $document_id),'qty_destination')+$this->input->post('qty_destination')) - $this->input->post('qty_destination_temp')>$this->vessel->sum_item($table='fx_trx_vessel_document',$array = array('document_id' => $document_id),'qty_po')){
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('vessels/manage/document_vessel_separate/'.$document_id);					
			}else{			
		
			$form_data = array(
			                'destination_id' => $this->input->post('destination_id'),
			                'destination_description' => $this->input->post('destination_description'),
			                'qty_destination' => $this->input->post('qty_destination'),
							'remarks' => $this->input->post('remarks'),
			                );
			
			$this->db->where($array = array(
					'document_separate_id' => $document_separate_id))->update('trx_document_separate', $form_data);

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('destination_edited_successfully'));
			redirect('vessels/manage/document_vessel_separate/'.$document_id);
			
			}
		}else{

			$data['destinations'] = $this->AppModel->get_all_records($table = 'mst_destinations', $array = array(
			'destination_id >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '','destination_name');
			
			$data['destination_details'] = $this->AppModel->get_all_records($table = 'trx_document_separate', $array = array(
			'document_separate_id' => $this->uri->segment(4)), $join_table = 'mst_destinations', $join_criteria = 'mst_destinations.destination_id=trx_document_separate.destination_id','document_separate_id');
			
			$this->load->view('modal/edit_destination',$data);
		}
		
	}
	function delete_destination(){
		if ($this->input->post() ){
					$document_separate_id = $this->input->post('document_separate_id', TRUE);
					$document_id = $this->input->post('document_id', TRUE);
					$this->db->where($array = array(
					'document_separate_id' => $document_separate_id))->delete('trx_document_separate');
					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', lang('destination_deleted_successfully'));
					redirect('vessels/manage/document_vessel_separate/'.$document_id);
		}else{
			$data['document_separate_id'] = $this->uri->segment(4);
			//tambahkan informasi tambahan
			$data['document_id'] = $this->vessel->get_id($table = 'trx_document_separate',
			$array = array('document_separate_id' => $this->uri->segment(4)),'document_id');
			$this->load->view('modal/delete_destination',$data);
		}
		
	}
	
	function document_vessel_list(){
	
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('vessels').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		
		//$vessel_id = $this->encrypt->decode($this->uri->segment(4));
		$data['page'] = lang('vessels');
		$data['form'] = TRUE;
		$data['datatables'] = TRUE;
		
		//VESSEL ALL 10ROWS LEFT SIDE	
		$data['vessels'] = $this->AppModel->get_all_records_limit($table = 'mst_vessels',
		$array = array(
			'vessel_id >' => 0, 'deleted' => 0
			),
		$join_table = 'mst_reference',$join_criteria = 'mst_reference.No_Urut_Ref = mst_vessels.vessel_status AND fx_mst_reference.Type_Ref="vessel_status"','vessel_ref', 10);
		
		//MASTER STATUS VESSEL
		$data['vessel_status'] = $this->AppModel->get_all_record_reference($table = 'mst_reference',
		$array = array('Type_Ref' => 'vessel_status'),'No_Urut_Ref');	

		//TRX DOCUMENT DETAILS		
		$data['document_details'] = $this->vessel->document_vessel($this->uri->segment(4));		

		//TRX DOCUMENT DETAILS		
		$data['document_details'] = $this->vessel->document_vessel($this->uri->segment(4));
		$data['vessel_id'] =$this->uri->segment(4);		
		
		$this->template
		->set_layout('users')
		->build('document_vessel_list',isset($data) ? $data : NULL);
	
	}
	function item()
	{
		if ($this->input->post()) {
		$vessel_id = $this->input->post('vessel_id');
		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('palka_id', 'Palka ID', 'required|is_unique[mst_vessel_palka.palka_id]');
		$this->form_validation->set_rules('item_id', 'Item ID', 'required');
		$this->form_validation->set_rules('ttl_item', 'Total Item', 'required|min_length[1]|max_length[12]|numeric');
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('vessels/manage/details/'.$vessel_id);
		}else{			
			$form_data = array(
							'vessel_id' => $this->input->post('vessel_id'),
			                'palka_id' => $this->input->post('palka_id'),
			                'item_id' => $this->input->post('item_id'),
			                'ttl_item' => $this->input->post('ttl_item'),
			                'ttl_unload_item' => 0
			            );
			$this->db->insert('mst_vessel_palka', $form_data); 
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('item_added_successfully'));
			
			redirect('vessels/manage/details/'.$vessel_id);
		}

		}else{

	redirect('vessels/manage/view/all');

		}
	}
	function details()
	{		
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('vessels').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		
		//$vessel_id = $this->encrypt->decode($this->uri->segment(4));
		$data['page'] = lang('vessels');
		$data['form'] = TRUE;
 		$data['items'] = $this->AppModel->get_all_records($table = 'mst_items', $array = array(
			'item_id >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '','item_name');
		$data['vessel_items'] = $this->AppModel->get_all_records_asc($table = 'mst_vessel_palka', $array = array(
			'vessel_id =' =>  $this->uri->segment(4)), $join_table = 'mst_items', $join_criteria = 'mst_items.item_id=mst_vessel_palka.item_id','palka_id');
		
		$data['item_sum'] = $this->vessel->sum_item_palka($table = 'mst_vessel_palka',
		$array = array('vessel_id' => $this->uri->segment(4)));
				
		$data['unload_item_sum'] = $this->vessel->sum_unload_item_palka($table = 'mst_vessel_palka',
		$array = array('vessel_id' => $this->uri->segment(4)));

		$data['vessels'] = $this->AppModel->get_all_records_limit($table = 'mst_vessels',
		$array = array(
			'vessel_id >' => 0, 'deleted' => 0
			),
		$join_table = 'mst_reference',$join_criteria = 'mst_reference.No_Urut_Ref = mst_vessels.vessel_status AND fx_mst_reference.Type_Ref="vessel_status"','vessel_ref', 10);
		
/* 		$data['vessels'] = $this->AppModel->get_all_records($table = 'mst_vessels',
		$array = array('vessel_id >' => 0, 'deleted' => 0),
		$join_table = 'mst_reference',$join_criteria = 'mst_reference.No_Urut_Ref = mst_vessels.vessel_status AND fx_mst_reference.Type_Ref="vessel_status"','vessel_ref'); */
		
		$data['vessel_details'] = $this->AppModel->get_all_records($table = 'mst_vessels',
		$array = array('vessel_id' => $this->uri->segment(4), 'deleted' => 0),
		$join_table = '',$join_criteria = '','vessel_id');
		
		$data['vessel_status'] = $this->AppModel->get_all_record_reference($table = 'mst_reference',
		$array = array('Type_Ref' => 'vessel_status'),'No_Urut_Ref');		 
		$this->template
		->set_layout('users')
		->build('vessel_details',isset($data) ? $data : NULL);
	}
	function timeline()
	{		
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('estimates').' - '.$this->config->item('company_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('estimates');
		$data['estimate_details'] = $this->estimate->estimate_details($this->uri->segment(4));
		$data['activities'] = $this->estimate->estimate_activities($this->uri->segment(4));
		$data['estimates'] = $this->AppModel->get_all_records($table = 'estimates',$array = array(
			'est_deleted' => 'No',
			),$join_table = '',$join_criteria = '','date_saved');
		$this->template
		->set_layout('users')
		->build('timeline',isset($data) ? $data : NULL);
	}

	function delete_palka(){
		if ($this->input->post() ){
					$palka_id = $this->input->post('palka_id', TRUE);
					$vessel_id = $this->input->post('vessel_id', TRUE);
					$this->db->where($array = array(
					'vessel_id' => $vessel_id, 'palka_id' => $palka_id))->delete('mst_vessel_palka');
					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', lang('item_deleted_successfully'));
					redirect('vessels/manage/details/'.$vessel_id);
		}else{
			$data['palka_id'] = $this->uri->segment(4);
			$data['vessel_id'] = $this->uri->segment(5);
			$this->load->view('modal/delete_palka',$data);
		}
		
	}

	function edit_palka(){
		if ($this->input->post() ){
			$vessel_id = $this->input->post('vessel_id');
			
			$this->load->library('form_validation');

			$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
			$this->form_validation->set_rules('palka_id', 'Palka ID', 'required');
			$this->form_validation->set_rules('item_id', 'Item ID', 'required');
			$this->form_validation->set_rules('ttl_item', 'Total Item', 'required|min_length[1]|max_length[12]|numeric');
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('vessels/manage/details/'.$vessel_id);
			}else{			
		

			$palka_id = $this->input->post('palka_id');
			
			$form_data = array(
			                'palka_id' => $this->input->post('palka_id'),
			                'vessel_id' => $this->input->post('vessel_id'),
			                'item_id' => $this->input->post('item_id'),
			                'ttl_item' => $this->input->post('ttl_item'),
			            );
			
			$this->db->where($array = array(
					'vessel_id' => $vessel_id, 'palka_id' => $palka_id))->update('mst_vessel_palka', $form_data);

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('palka_edited_successfully'));
			redirect('vessels/manage/details/'.$vessel_id);
			
			}
		}else{
			$data['form'] = TRUE;
			//$data['palka_id'] = $this->uri->segment(4);
			//$data['vessel_id'] = $this->uri->segment(5);
			$data['items'] = $this->AppModel->get_all_records($table = 'mst_items', $array = array(
			'item_id >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '','item_name');
			
			$data['palka_details'] = $this->vessel->palka_details($this->uri->segment(5), $this->uri->segment(4))->result();			
			$this->load->view('modal/edit_palka',$data);
		}
		
	}
	
	//add recap document
	
	function add_recap_document()
	{
		if ($this->input->post()) {
		//$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('vessel_id', 'Vessel ID', 'required|numeric');
		$this->form_validation->set_rules('recap_no', 'Recap No', 'required|numeric');
		$this->form_validation->set_rules('transporter_id', 'Transporter ID', 'required|numeric');
		$this->form_validation->set_rules('receipt_date', 'receipt_date', 'required');
		$this->form_validation->set_rules('due_date', 'due_date', 'required');
		$this->form_validation->set_rules('currency', 'Currency', 'required');

		if ($this->form_validation->run() == FALSE)
		{		
				$document_separate_id=trim($this->input->post('document_separate_id'));
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('orders/manage/add_recap_document');
		}else{	
	
	
			$vessel_id=trim($this->input->post('vessel_id'));
			$recap_no=trim($this->input->post('recap_no'));
			$transporter_id=trim($this->input->post('transporter_id'));
			$receipt_date=date('Y-m-d',strtotime($this->input->post('receipt_date')));
			$due_date=date('Y-m-d',strtotime($this->input->post('due_date')));
			$currency=$this->input->post('currency');
			$notes=trim($this->input->post('notes'));

			$form_data = array(
							'vessel_id'			=> 	$vessel_id,
							'recap_no'			=>	$recap_no,
							'transporter_id'	=>	$transporter_id,
							'company_id' 		=> 	$this->session->userdata('company_id'),
							'site_id' 			=>	$this->session->userdata('site_id'),							
							'recap_receipt_date'=> 	$receipt_date,
			                'recap_due_date' 	=> 	$due_date,	
							'recap_payable' 	=> 	$currency,
							'remarks'			=>	$notes,							
							'user_created'			=>	$this->session->userdata('user_id'),
							'date_created'			=>	date('Y-m-d'),
							'time_created'			=>	date('H:i:s'),							
			            );
			$this->db->insert('trx_recap_document_h', $form_data); 
			$recap_id = $this->db->insert_id();

			$activity = ucfirst('Recap Document #'.$recap_no.' created.');
			$this->_log_activity($recap_id,$activity,$icon = 'fa-plus'); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('recap_document_created_successfully'));
			redirect('orders/manage/recap_document_details/'.$recap_id);//.$sj_id
		}

		}else{


			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title(lang('recap_document').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
			$data['page'] = lang('orders');
			$data['form'] = TRUE;
			
			$data['vessel_defaults'] = $this->AppModel->get_all_records($table = 'users', $array = array(
			'id' => $this->session->userdata('user_id')), $join_table = 'mst_vessels', $join_criteria = 'mst_vessels.vessel_id=users.vessel_id','id');
			

			
			$data['transporters'] = $this->AppModel->get_all_records($table = 'mst_transporters', $array = array(
			'deleted' => 0), $join_table = '', $join_criteria = '','transporter_id');			
			
			$data['recap_documents'] = $this->AppModel->get_all_records($table = 'trx_recap_document_h', $array = array(
			'vessel_id' => $this->order->get_id($table = 'users',
			$array = array('id' => $this->session->userdata('user_id'), 'activated' => 1),'vessel_id'), 'deleted' => 0), $join_table = '', $join_criteria = '','recap_id');			
			
		
			$this->template
			->set_layout('users')
			->build('create_recap_document',isset($data) ? $data : NULL);

		}
	}
	
	
// recap_document_details

	function recap_document_details()
	{
		if ($this->input->post()) {
		//$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('vessel_id', 'Vessel ID', 'required|numeric');
		$this->form_validation->set_rules('recap_no', 'Recap No', 'required|numeric');
		$this->form_validation->set_rules('transporter_id', 'Transporter ID', 'required|numeric');
		$this->form_validation->set_rules('receipt_date', 'receipt_date', 'required');
		$this->form_validation->set_rules('due_date', 'due_date', 'required');
		$this->form_validation->set_rules('currency', 'Currency', 'required');

		if ($this->form_validation->run() == FALSE)
		{		
				$document_separate_id=trim($this->input->post('document_separate_id'));
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('orders/manage/add_recap_document');
		}else{	
	
	
			$vessel_id=trim($this->input->post('vessel_id'));
			$recap_no=trim($this->input->post('recap_no'));
			$transporter_id=trim($this->input->post('transporter_id'));
			$receipt_date=trim($this->input->post('receipt_date'));
			$due_date=trim($this->input->post('due_date'));
			$currency=trim($this->input->post('currency'));
			$notes=trim($this->input->post('notes'));

			$form_data = array(
							'vessel_ida'		=> 	$vessel_id,
							'recap_no'		=>	$recap_no,
							'transporter_id'	=>	$transporter_id,
							'company_id' 			=> 	$this->session->userdata('company_id'),
							'site_id' 				=>	$this->session->userdata('site_id'),							
							'receipt_date' 			=> 	strtotime($receipt_date),
			                'due_date' 				=> 	date('Y-m-d',strtodate($due_date)),	
							'currency' 				=> 	$currency,
							'notes'			=>	$notes,							
							'user_created'			=>	$this->session->userdata('user_id'),
							'date_created'			=>	date('Y-m-d'),
							'time_created'			=>	date('H:i:s'),							
			            );
			$this->db->insert('trx_recap_document_h', $form_data); 
			$recap_id = $this->db->insert_id();

			$activity = ucfirst('Recap Document #'.$recap_no.' created.');
			$this->_log_activity($recap_id,$activity,$icon = 'fa-plus'); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('recap_document_created_successfully'));
			redirect('orders/manage/recap_document_details/'.$recap_id);//.$sj_id
		}

		}else{


			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title(lang('recap_document_details').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
			$data['page'] = lang('recap_document_details');
			$data['form'] = TRUE;
			$data['datatables'] = TRUE;
			$data['vessel_defaults'] = $this->AppModel->get_all_records($table = 'users', $array = array(
			'id' => $this->session->userdata('user_id')), $join_table = 'mst_vessels', $join_criteria = 'mst_vessels.vessel_id=users.vessel_id','id');

			$data['transporters'] = $this->AppModel->get_all_records($table = 'mst_transporters', $array = array(
			'deleted' => 0), $join_table = '', $join_criteria = '','transporter_id');			
			
			$data['recap_document_headers'] = $this->order->recap_document_h($this->uri->segment(4));		
			 $data['listsjrecap']=$this->AppModel->getRecapDocumentDetails($array = array('a.recap_id' => $this->uri->segment(4)))->result();
		
			$this->template
			->set_layout('users')
			->build('recap_document_details',isset($data) ? $data : NULL);

		}
	}	
    function get_detail_sj(){
        $id['sj_ref']=$this->input->post('sj_ref');
		
        $data['detail_sj']=$this->AppModel->getSJDetail(trim($this->input->post('sj_ref')))->result();

       $this->load->view('ajax_detail_do',isset($data) ? $data : NULL);
	
    }
	
	function list_sj_recap(){
        $sj_id=$this->input->post('sj_id');		
		$recap_id=$this->input->post('recap_id');
		$recap_ref=trim($this->input->post('recap_no'));
		
		if ($this->order->check_key($table='trx_recap_document_d',$array = array('sj_id' => $sj_id))){
				
				
		}else{
		
		
		
		$insert_ok= $this->AppModel->addtolistrecapsj($sj_id,1,1,$recap_id,$recap_ref);
		}
		$data['datatables'] = TRUE;
		$data['form'] = TRUE;
        $data=array(
            'listsjrecap'=>$this->AppModel->getRecapDocumentDetails($array = array('a.recap_id' => $this->input->post('recap_id')))->result(),'error'=>'error','qty_bulk_delivery_netto'=>$this->order->sum_item($table='trx_recap_document_d',$array = array('recap_id' => $this->input->post('recap_id')),'qty_bulk_delivery_netto'),'qty_bulk_receipt_netto'=>$this->order->sum_item($table='trx_recap_document_d',$array = array('recap_id' => $this->input->post('recap_id')),'qty_bulk_receipt_netto')
        );
				$this->load->view('ajax_listsjrecap',$data);
	   
    }
	
	function view_recaplistsj(){

		$data['datatables'] = TRUE;
		$data['form'] = TRUE;
        $data=array(
            'listsjrecap'=>$this->AppModel->getRecapDocumentDetails($array = array('a.recap_id' => $this->input->post('recap_id')))->result(),'datatables'=>TRUE
        ); 
		
       $this->load->view('ajax_listsjrecap',$data);
    }	
	function _log_activity($vessel_id,$activity,$icon){
			$this->db->set('module', 'orders');
			$this->db->set('module_field_id', $vessel_id);
			$this->db->set('user', $this->tank_auth->get_user_id());
			$this->db->set('activity', $activity);
			$this->db->set('icon', $icon);
			$this->db->insert('activities'); 
	}

}

/* End of file manage.php */