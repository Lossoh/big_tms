<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Manage extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('vessels_model','vessel');
		
	}
	
	function add()
	{
		if ($this->input->post()) {
		//$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('vessel_name', 'Vessel Name', 'required');

		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('vessels');
		}else{		
			
			$year_period = date('Y');
			$max_no= ((int)$this->AppModel->select_max_id('mst_vessels',$array = array(
			'year_period' => $year_period, 'deleted'=> 0),'vessel_no'))+1;
			
         
			$vessel_ref = 'R'.substr((string)$year_period,2).sprintf("%03s", $max_no);;
			$form_data = array(
							'company_id'=> 1,
							'site_id'=> 1,
							'vessel_ref' => $vessel_ref,
			                'vessel_name' => $this->input->post('vessel_name'),
							'year_period' => date('Y'),
							'vessel_no' => $max_no,
							'vessel_init' =>substr($vessel_ref,1),
							'vessel_status' =>1,							
							'user_created'=>$this->session->userdata('user_id'),
							'date_created'=>date('Y-m-d'),
							'time_created'=>date('H:i:s'),							
			            );
			$this->db->insert('mst_vessels', $form_data); 
			$vessel_id = $this->db->insert_id();
			$activity = ucfirst('Vessel #'.$vessel_ref.' created.');
			$this->_log_activity($vessel_id,$activity,$icon = 'fa-plus'); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('vessel_created_successfully'));
			redirect('vessels/manage/details/'.$vessel_id );//.$vessel_id
		}

		}else{


	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title(lang('vessels').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
	$data['page'] = lang('vessels');
	$data['form'] = TRUE;
	$data['vessels'] = $this->AppModel->get_all_records_limit($table = 'mst_vessels',
		$array = array(
			'vessel_id >' => 0, 'vessel_status <' => 2, 'deleted' => 0
			),
		$join_table = 'mst_reference',$join_criteria = 'mst_reference.No_Urut_Ref = mst_vessels.vessel_status AND fx_mst_reference.Type_Ref="vessel_status"','vessel_ref', 10);
		
	$this->template
	->set_layout('users')
	->build('create_vessel',isset($data) ? $data : NULL);

		}
	}

	function edit()
	{
		if ($this->input->post()) {
		//$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('vessel_name', 'Vessel Name', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('vessels');
		}else{	
		$vessel_id = $this->input->post('vessel_id', TRUE);	
			//cek data
			$form_data = array(
			                'vessel_name' => $this->input->post('vessel_name'),
			                
			            );
			$this->db->where('vessel_id',$vessel_id)->update('mst_vessels', $form_data);

			$activity = ucfirst($this->tank_auth->get_username().' edited VESSEL #'.$this->input->post('vessel_ref'));
			$this->_log_activity($vessel_id,$activity,$icon = 'fa-pencil'); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('vessel_edited_successfully'));
			redirect('vessels/manage/details/'.$vessel_id);
		}

		}else{


			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title(lang('vessels').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
			$data['page'] = lang('vessels');
			$data['form'] = TRUE;
			
			$data['vessel_status'] = $this->AppModel->get_all_record_reference($table = 'mst_reference',
				$array = array('Type_Ref' => 'vessel_status'),'No_Urut_Ref');
					
			$data['vessels'] = $this->AppModel->get_all_records_limit($table = 'mst_vessels',
			$array = array(
			'vessel_id >' => 0, 'vessel_status <' => 2, 'deleted' => 0
			),
			$join_table = 'mst_reference',$join_criteria = 'mst_reference.No_Urut_Ref = mst_vessels.vessel_status AND fx_mst_reference.Type_Ref="vessel_status"','vessel_ref', 10);
			
			$data['vessel_details'] = $this->AppModel->get_all_records($table = 'mst_vessels',
			$array = array('vessel_id' => $this->uri->segment(4), 'deleted' => 0),
			$join_table = '',$join_criteria = '','vessel_id');


			$this->template
			->set_layout('users')
			->build('edit_vessel',isset($data) ? $data : NULL);

		}
	}
	
	function delete()
	{
		if ($this->input->post()) {
		//$this->load->library('form_validation');
		$this->form_validation->set_rules('vessel_id', 'Vessel ID', 'required');
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('delete_failed'));
				redirect('vessels');
		}else{			

		
		
			$this->db->where(array('vessel_id' => $this->input->post('vessel_id'), 'vessel_status' => 1))->update('mst_vessels', array('deleted' => 1));


			$activity = $this->tank_auth->get_username()." deleted a vessel";
			$this->_log_activity($this->input->post('vessel_id'),$activity,$icon = 'fa-times'); //log activity
			
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('issue_deleted_successfully'));
			redirect('vessels');
		}
		}else{
			//$data['vessel_id'] = $this->uri->segment(3);
			
			$data['vessels'] = $this->AppModel->get_all_records($table = 'mst_vessels',
			$array = array(
			'vessel_id' => $this->uri->segment(4), 'deleted' => 0
			),
			$join_table = '',$join_criteria = '','vessel_ref');
			
			
			$this->load->view('modal/delete_vessel',$data);
	

		}
	}
	
	function add_unload_receipt()
	{
		if ($this->input->post()) {
			$vessel_id = trim($this->input->post('vessel_id'));	
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
			$this->form_validation->set_rules('vessel_id', 'Vessel ID', 'required');
			$this->form_validation->set_rules('vessel_init', 'Vessel Init', 'required');
			$this->form_validation->set_rules('truck_id', 'Truck ID', 'required');
			$this->form_validation->set_rules('transporter_id', 'Transporter ID', 'required');
			$this->form_validation->set_rules('truck_type_id', 'Truck Type ID', 'required');
			$this->form_validation->set_rules('driver_name', 'Driver Name', 'required|max_length[30]');
			$this->form_validation->set_rules('description', 'Description', 'max_length[255]');
			$this->form_validation->set_rules('no_bon_muat', 'No.Bon Muat Manual', 'numeric|max_length[8]');
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('add_unload_receipt_failed'));
				$this->session->set_flashdata('form_errors', validation_errors('<span style="color:red">', '</span><br>'));
				redirect('vessels/manage/unload_receipt_list/'.$vessel_id);
			}else{
				$year_period = date('Y');
				$month_period = date('m');
							
				$vessel_init = trim($this->input->post('vessel_init'));				
				$truck_id = trim($this->input->post('truck_id'));
				$transporter_id = trim($this->input->post('transporter_id'));
				$truck_type_id = trim($this->input->post('truck_type_id'));
				$no_bon_muat = trim($this->input->post('no_bon_muat'));
				$driver_name = trim($this->input->post('driver_name'));	
				$description = trim($this->input->post('description'));	
				$max_no= ((int)$this->AppModel->select_max_id('trx_unload_receipt',$array = array(
				'vessel_id' => $vessel_id, 'deleted' => 0),'unload_receipt_no'))+1;
				//14001UR00001
				$ur_ref = substr($vessel_init,-5)."UR".sprintf("%05s", $max_no);
				
				$form_data = array(				
							'company_id' 			=> 	1,
							'site_id' 				=>	1,							
							'vessel_id' 			=> 	$vessel_id,
			                'unload_receipt_no' 	=> 	$max_no,	
							'unload_receipt_ref' 	=> 	$ur_ref,
							'unload_receipt_date' 	=> 	date('Y-m-d'),
							'unload_receipt_time' 	=> 	date('H:i:s'),
							'unload_receipt_month'	=>	$month_period, 		
							'unload_receipt_year'	=> 	$year_period,
							'no_bon_muat'			=> 	$no_bon_muat,							
							'truck_id'				=> 	$truck_id,							
							'truck_type_id' 		=> 	$truck_type_id,
							'transporter_id' 		=> 	$transporter_id,
							'driver_name' 			=> 	strtoupper($driver_name),
							'description' 			=> 	strtoupper($description),
							'user_created'			=>	$this->session->userdata('user_id'),
							'date_created'			=>	date('Y-m-d'),
							'time_created'			=>	date('H:i:s'),
							'expired_date'			=>	date('Y-m-d', strtotime('+3 days', strtotime(date('Y-m-d')))),
			            );
			$this->db->insert('trx_unload_receipt', $form_data); 
			$ur_id = $this->db->insert_id();

			
/* 			$ur_details= $this->vessel->unload_receipt_details($ur_id);
		
			if(!empty($ur_details)){
				foreach($ur_details as $ur_detail){
					
			$tmpdir = sys_get_temp_dir();   # ambil direktori temporary untuk simpan file.
			$file =  tempnam($tmpdir, 'ctkur'.$ur_detail->unload_receipt_ref.$this->session->userdata('user_id'));  # nama file temporary yang akan dicetak
			$handle = fopen($file, 'w');
			$condensed = Chr(27) . Chr(33) . Chr(4);
			$bold1 = Chr(27) . Chr(69);
			$font1 = Chr(27) . Chr(33) . Chr(16);
			$font0 = Chr(27) . Chr(33) . Chr(8);
			$bold0 = Chr(27) . Chr(70);
			$initialized = chr(27).chr(64);
			$condensed1 = chr(15);
			$condensed0 = chr(18);
			$Data  = $initialized;
			$Data .= $condensed1;
			$Data .= "\n\n\n";
			$Data .= "\t\t\t\t\t\t\t\t\t\t\t\t\t\t".$font1.$bold1.$ur_detail->unload_receipt_ref.$bold0.$font0."\n\n\n\n";
			$Data .= "      ".$font1.$bold1.$ur_detail->truck_name.chr(9).chr(9).$ur_detail->transporter_ref."\t".$ur_detail->Nm_Ref."  ".strftime("%d %b %Y", strtotime($ur_detail->unload_receipt_date))."\t".$ur_detail->vessel_name.$bold0.$font0."\n\n\n\n";
			$Data .= "".chr(9).$font1.$bold1.$ur_detail->username."\t\t".$ur_detail->driver_name.$bold0.$font0."\n\n";
			$Data .= "   ".$font0.strftime("%d %b %Y", strtotime($ur_detail->date_created))." ".$ur_detail->time_created."\t\t Berlaku sampai : ".strftime("%d %b %Y", strtotime($ur_detail->expired_date))."\n\n";
			$Data .= "   Keterangan\t: ".$font0.$ur_detail->description."\n\n";
			fwrite($handle, $Data);
			fclose($handle);
			copy($file, "//200.10.10.180/EPS310");  # Lakukan cetak 
			unlink($file);				
			}} */
			$activity = ucfirst('UR #'.$ur_ref.' created.');
			$this->_log_activity($ur_id,$activity,$icon = 'fa-plus'); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('unload_receipt_created_successfully'));
			redirect('vessels/manage/unload_receipt_list/'.$vessel_id);
			}
				
		}else{		
		

			
			$data['trucks'] = $this->AppModel->get_all_records($table = 'mst_trucks', $array = array('truck_id >' => 0, 'deleted' => 0), '','','truck_ref');
			
			$data['vessel'] = $this->vessel->get_all_records($table = 'mst_vessels', $array = array('vessel_id' => $this->uri->segment(4), 'deleted' => 0), '','','vessel_ref');
			
			$this->load->view('modal/add_unload_receipt',$data);
		}
	}
	
	function edit_unload_receipt()
	{
		if ($this->input->post() ){
					
			$unload_receipt_id = $this->input->post('unload_receipt_id', TRUE);
			$vessel_id = $this->input->post('vessel_id', TRUE);
			$unload_receipt_ref= $this->input->post('unload_receipt_ref', TRUE);
			$description = trim($this->input->post('description'));
			
			$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
			$this->form_validation->set_rules('vessel_id', 'Vessel ID', 'required');
			$this->form_validation->set_rules('unload_receipt_id', 'Unload Receipt ID', 'required');
			$this->form_validation->set_rules('unload_receipt_ref', 'Unload Receipt Reference', 'required');
			$this->form_validation->set_rules('description', 'Description', 'max_length[255]');
			
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('vessels/manage/unload_receipt_list/'.$vessel_id);
			}else if ($this->vessel->check_key('trx_sj',$array=array('deleted' => 0, 'unload_receipt_id' => $unload_receipt_id))){
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('unload_receipt_used'));
				redirect('vessels/manage/unload_receipt_list/'.$vessel_id);
			}else{		
			
				$form_data = array(
							'description'			=>	strtoupper($description),
			                'expired_date' => date('Y-m-d', strtotime('+3 days', strtotime(date('Y-m-d')))),
			                'user_modified'			=>	$this->session->userdata('user_id'),
							'date_modified'			=>	date('Y-m-d'),
							'time_modified'			=>	date('H:i:s'),
			    );
				$this->db->where('unload_receipt_id',$unload_receipt_id)->update('trx_unload_receipt', $form_data);

				$activity = ucfirst($this->tank_auth->get_username().' edited UR #'.$unload_receipt_ref);
				$this->_log_activity($unload_receipt_id,$activity,$icon = 'fa-pencil'); //log activity

				
				$this->session->set_flashdata('response_status', 'success');
				$this->session->set_flashdata('message', lang('unload_receipt_updated_successfully'));
				redirect('vessels/manage/unload_receipt_list/'.$vessel_id);
			}	
		}else{

			$data['unload_receipt_details'] = $this->vessel->unload_receipt_details($this->uri->segment(4));
			$this->load->view('modal/edit_unload_receipt',$data);
		}
	}

	function delete_unload_receipt(){
		if ($this->input->post() ){
					
			$unload_receipt_id = $this->input->post('unload_receipt_id', TRUE);
			$vessel_id = $this->input->post('vessel_id', TRUE);
			
			
			$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
			$this->form_validation->set_rules('vessel_id', 'Vessel ID', 'required');
			$this->form_validation->set_rules('unload_receipt_id', 'Unload Receipt ID', 'required');


			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('vessels/manage/unload_receipt_list/'.$vessel_id);
			}else if ($this->vessel->check_key('trx_sj',$array=array('deleted' => 0, 'unload_receipt_id' => $unload_receipt_id))){
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('unload_receipt_used'));
				redirect('vessels/manage/unload_receipt_list/'.$vessel_id);
			}else{	
				$form_data = array(
			                'deleted' => 1,
			                'user_deleted'			=>	$this->session->userdata('user_id'),
							'date_deleted'			=>	date('Y-m-d'),
							'time_deleted'			=>	date('H:i:s'),
			    );
				$this->db->where('unload_receipt_id',$unload_receipt_id)->update('trx_unload_receipt', $form_data);

				$activity = ucfirst($this->tank_auth->get_username().' deleted UR #'.$unload_receipt_ref);
				$this->_log_activity($unload_receipt_id,$activity,$icon = 'fa-pencil'); //log activity

				$this->session->set_flashdata('response_status', 'success');
				$this->session->set_flashdata('message', lang('unload_receipt_deleted_successfully'));
				redirect('vessels/manage/unload_receipt_list/'.$vessel_id);
			}	
		}else{

			$data['unload_receipt_details'] = $this->vessel->unload_receipt_details($this->uri->segment(4));
			$this->load->view('modal/delete_unload_receipt',$data);
		}
		
	}

	function reprint_unload_receipt()
	{

		if (trim($this->uri->segment(4))!= ""){		
				$form_data = array(			

							'user_print'			=>	$this->session->userdata('user_id'),
							'date_print'			=>	date('Y-m-d'),
							'time_print'			=>	date('H:i:s'),

			            );
			$this->db->where('unload_receipt_id',$this->uri->segment(4))->update('trx_unload_receipt', $form_data);


			
			$ur_details= $this->vessel->unload_receipt_details($this->uri->segment(4));
		
			if(!empty($ur_details)){
				foreach($ur_details as $ur_detail){
					
			$tmpdir = sys_get_temp_dir();   # ambil direktori temporary untuk simpan file.
			$file =  tempnam($tmpdir, 'ctkur'.$ur_detail->unload_receipt_ref.$this->session->userdata('user_id'));  # nama file temporary yang akan dicetak
			$handle = fopen($file, 'w');
			$condensed = Chr(27) . Chr(33) . Chr(4);
			$bold1 = Chr(27) . Chr(69);
			$font1 = Chr(27) . Chr(33) . Chr(16);
			$font0 = Chr(27) . Chr(33) . Chr(8);
			$bold0 = Chr(27) . Chr(70);
			$initialized = chr(27).chr(64);
			$condensed1 = chr(15);
			$condensed0 = chr(18);
			$Data  = $initialized;
			$Data .= $condensed1;
			$Data .= "\n\n\n";
			$Data .= "\t\t\t\t\t\t\t\t\t\t\t\t\t\t".$font1.$bold1.$ur_detail->unload_receipt_ref.$bold0.$font0."\n\n\n\n";
			$Data .= "      ".$font1.$bold1.$ur_detail->truck_name.chr(9).chr(9).$ur_detail->transporter_ref."\t".$ur_detail->Nm_Ref."  ".strftime("%d %b %Y", strtotime($ur_detail->unload_receipt_date))."\t".$ur_detail->vessel_name.$bold0.$font0."\n\n\n\n";
			$Data .= "".chr(9).$font1.$bold1.$ur_detail->username."\t\t".$ur_detail->driver_name.$bold0.$font0."\n\n";
			$Data .= "   ".$font0.strftime("%d %b %Y", strtotime($ur_detail->date_created))." ".$ur_detail->time_created."\t\t Berlaku sampai : ".strftime("%d %b %Y", strtotime($ur_detail->expired_date))."\n\n";
			$Data .= "   Keterangan\t: ".$font0.$ur_detail->description."\n\n";
			fwrite($handle, $Data);
			fclose($handle);
			copy($file, "//200.10.10.180/EPS310");  # Lakukan cetak 
			unlink($file);				
			
			$activity = ucfirst('UR #'.$ur_detail->unload_receipt_ref.' printed.');
			$this->_log_activity($ur_detail->unload_receipt_id,$activity,$icon = 'fa-plus'); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('unload_receipt_created_successfully'));
			redirect('vessels/manage/unload_receipt_list/'.$ur_detail->vessel_id);
			}}
				
		}else{		
		
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				//redirect('vessels/manage/unload_receipt_list/'.$vessel_id);
		}
	}

	
	function get_truck_detail(){
        $id['truck_id']=$this->input->post('truckid');
        $data=array(
            'truck_details'=>$this->AppModel->getTransporter($array = array('a.truck_id' => $this->input->post('truckid'), 'a.deleted' => 0))->result(),
        ); 
		
       $this->load->view('ajax_truck_detail',$data);
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
							'company_id'=> 1,
							'site_id'=> 1,
							'vessel_id'=>$vessel_id,
							'party_id'=>$party_id,
							'po_ref' => $this->input->post('po_ref'),
			                'po_date' => date("Y-m-d",strtotime($this->input->post('po_date'))),
							'client_id' => $this->input->post('client_id'),
							'item_id' => $this->input->post('item_id'),
							'item_type' =>$this->input->post('item_type_id'),
							'qty_po' =>$this->input->post('qty_po'),							
							'tolerence' =>$this->input->post('tolerence'),	
							'port_id' =>$this->input->post('port_id'),	
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
			$data['port_id'] = $this->session->userdata('site_id');
			$data['port_name'] = $this->vessel->get_id('mst_reference',$array=array('Type_Ref' => 'sites', 'No_Urut_Ref' => $this->session->userdata('site_id')),'Kondisi_Ref_Char_01');
			//$this->AppModel->get_all_record_reference($table = 'mst_reference',
			//	$array = array('Type_Ref' => 'party'),'No_Urut_Ref');

			$data['items'] = $this->AppModel->get_all_records($table = 'mst_items',
			$array = array('item_id >' => 0, 'deleted' => 0),
			$join_table = '',$join_criteria = '','item_id');
			

			$data['clients'] = $this->AppModel->get_all_records($table = 'mst_clients',
			$array = array('client_id >' => 0, 'deleted' => 0),
			$join_table = '',$join_criteria = '','client_id');

					

			
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
			'vessel_id >' => 0, 'vessel_status <' => 2,  'deleted' => 0
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
		
		
		$data['total_item_destination']=$this->vessel->sum_item($table='trx_document_separate',$array = array('document_id' => $this->uri->segment(4)),'qty_destination');	
			
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
/* 		}else if ($this->vessel->sum_item($table='trx_document_separate',$array = array('document_id' => $document_id),'qty_destination')+$this->input->post('destination_qty')>$this->vessel->sum_item($table='fx_trx_vessel_document',$array = array('document_id' => $document_id),'qty_po')){
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('vessels/manage/document_vessel_separate/'.$document_id);	 */				
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
			
			//$this->load->library('form_validation');

			$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
			$this->form_validation->set_rules('document_id', 'Document ID', 'required');
			$this->form_validation->set_rules('document_separate_id', 'Document Separate ID', 'required');
			//$this->form_validation->set_rules('destination_id', 'Destination ID', 'required');
			//$this->form_validation->set_rules('destination_description', 'Desctination Description', 'required');
			$this->form_validation->set_rules('qty_destination', 'Total Item', 'required|min_length[1]|max_length[12]|numeric');
			$this->form_validation->set_rules('remarks', 'Remarks', 'required');
//else if (($this->vessel->sum_item($table='trx_document_separate',$array = array('document_id' => $document_id),'qty_destination')+$this->input->post('qty_destination')) - $this->input->post('qty_destination_temp')>$this->vessel->sum_item($table='fx_trx_vessel_document',$array = array('document_id' => $document_id),'qty_po')){
//				$this->session->set_flashdata('response_status', 'error');
//				$this->session->set_flashdata('message', lang('operation_failed'));
//				redirect('vessels/manage/document_vessel_separate/'.$document_id);					
//			}
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('vessels/manage/document_vessel_separate/'.$document_id);
			}else{			
		
			$form_data = array(
			                //'destination_id' => $this->input->post('destination_id'),
			                //'destination_description' => $this->input->post('destination_description'),
			                'qty_destination' => $this->input->post('qty_destination'),
							//'remarks' => $this->input->post('remarks'),
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
			
			
			$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
			$this->form_validation->set_rules('document_id', 'Document ID', 'required');
			$this->form_validation->set_rules('document_separate_id', 'Document Separate ID', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('vessels/manage/document_vessel_separate/'.$document_id);
			}else if ($this->vessel->check_key('trx_sj',$array=array('deleted' => 0, 'document_separate_id' => $document_separate_id))){
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('vessels/manage/document_vessel_separate/'.$document_id);
			}else{					
				$this->db->where($array = array(
				'document_separate_id' => $document_separate_id))->delete('trx_document_separate');
				$this->session->set_flashdata('response_status', 'success');
				$this->session->set_flashdata('message', lang('destination_deleted_successfully'));
				redirect('vessels/manage/document_vessel_separate/'.$document_id);
			}	
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

		
		$data['vessel_details'] = $this->vessel->get_all_records($table = 'mst_vessels',
		$array = array('vessel_id' => $this->uri->segment(4), 'deleted' => 0),'','','vessel_init');	
		


		//TRX DOCUMENT DETAILS		
		$data['document_details'] = $this->vessel->document_vessel($this->uri->segment(4));	
		//$data['options_status'] = $this->vessel->check_key($table='trx_document_separate',$array = array('document_id' => $document_id, 'destination_id' =>  $this->input->post('destination_id')));
		

		//TRX DOCUMENT DETAILS		
		//$data['document_details'] = $this->vessel->document_vessel($this->uri->segment(4));
		//$data['vessel_id'] =$this->uri->segment(4);		
		
		$this->template
		->set_layout('users')
		->build('document_vessel_list',isset($data) ? $data : NULL);
	
	}
	
	function memo_list(){
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('memo_list').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		
		//$vessel_id = $this->encrypt->decode($this->uri->segment(4));
		$data['page'] = lang('memo_list');
		$data['form'] = TRUE;
		$data['datatables'] = TRUE;

		$data['vessel_details'] =$this->vessel->get_all_records($table = 'mst_vessels',
		$array = array('vessel_id' => $this->uri->segment(4), 'deleted' => 0),'','','vessel_init');	

		//TRX DOCUMENT DETAILS		
		$data['memo_lists'] = $this->vessel->memo_list($this->uri->segment(4));	
		
		$this->template
		->set_layout('users')
		->build('memo_list',isset($data) ? $data : NULL);
	
	}

	function add_memo()
	{
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
			$this->form_validation->set_rules('vessel_id', 'Vessel ID', 'required');
			$this->form_validation->set_rules('vessel_init', 'Vessel Init', 'required');
			$this->form_validation->set_rules('description', 'Description', 'max_length[255]');
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('add_memo_failed'));
				$this->session->set_flashdata('form_errors', validation_errors('<span style="color:red">', '</span><br>'));
				redirect('vessels/manage/memo_list/'.$vessel_id);
			}else{
				$vessel_id = trim($this->input->post('vessel_id'));				
				$vessel_init = trim($this->input->post('vessel_init'));				
				$description = trim($this->input->post('description'));
				
				$form_data = array(				
							'company_id' 			=> 	1,
							'site_id' 				=>	1,							
							'vessel_id' 			=> 	$vessel_id,
							'memo_date' 			=> 	date('Y-m-d'),
							'memo_time' 			=> 	date('H:i:s'),
							'description' 			=> 	strtoupper($description),
							'user_created'			=>	$this->session->userdata('user_id'),
							'date_created'			=>	date('Y-m-d'),
							'time_created'			=>	date('H:i:s'),

			            );
			$this->db->insert('trx_memo', $form_data); 
			$memo_id = $this->db->insert_id();

			$activity = ucfirst('MM #'.$memo_id.' created.');
			$this->_log_activity($memo_id,$activity,$icon = 'fa-plus'); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('memo_created_successfully'));
			redirect('vessels/manage/memo_list/'.$vessel_id);
			}
				
		}else{		
			
			$data['vessel'] = $this->vessel->get_all_records($table = 'mst_vessels', $array = array('vessel_id' => $this->uri->segment(4), 'deleted' => 0), '','','vessel_ref');
			
			$this->load->view('modal/add_memo',$data);
		}
	}

	function edit_memo()
	{
		if ($this->input->post() ){
					
			$memo_id = $this->input->post('memo_id', TRUE);
			$vessel_id = $this->input->post('vessel_id', TRUE);
			$description = trim($this->input->post('description'));
			
			$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
			$this->form_validation->set_rules('vessel_id', 'Vessel ID', 'required');
			$this->form_validation->set_rules('memo_id', 'Memo ID', 'required');
			$this->form_validation->set_rules('description', 'Description', 'max_length[255]');
			
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('vessels/manage/memo_list/'.$vessel_id);
			}else{		
			
				$form_data = array(
							'description'			=>	strtoupper($description),
			                'user_modified'			=>	$this->session->userdata('user_id'),
							'date_modified'			=>	date('Y-m-d'),
							'time_modified'			=>	date('H:i:s'),
			    );
				$this->db->where('memo_id',$memo_id)->update('trx_memo', $form_data);

				$activity = ucfirst($this->tank_auth->get_username().' edited MM #'.$memo_id);
				$this->_log_activity($memo_id,$activity,$icon = 'fa-pencil'); //log activity

				
				$this->session->set_flashdata('response_status', 'success');
				$this->session->set_flashdata('message', lang('memo_updated_successfully'));
				redirect('vessels/manage/memo_list/'.$vessel_id);
			}	
		}else{

			$data['memo_details'] = $this->vessel->memo_details($this->uri->segment(4));
			$this->load->view('modal/edit_memo',$data);
		}
	}

	function delete_memo(){
		if ($this->input->post() ){

			$vessel_id = $this->input->post('vessel_id', TRUE);					
			$memo_id = $this->input->post('memo_id', TRUE);			
			
			$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
			$this->form_validation->set_rules('vessel_id', 'Vessel ID', 'required');
			$this->form_validation->set_rules('memo_id', 'Memo ID', 'required');


			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('vessels/manage/memo_list/'.$vessel_id);
			}else{	
				$form_data = array(
			                'deleted' => 1,
			                'user_deleted'			=>	$this->session->userdata('user_id'),
							'date_deleted'			=>	date('Y-m-d'),
							'time_deleted'			=>	date('H:i:s'),
			    );
				$this->db->where('memo_id',$memo_id)->update('trx_memo', $form_data);

				$activity = ucfirst($this->tank_auth->get_username().' deleted MM #'.$memo_id);
				$this->_log_activity($memo_id,$activity,$icon = 'fa-pencil'); //log activity

				$this->session->set_flashdata('response_status', 'success');
				$this->session->set_flashdata('message', lang('memo_deleted_successfully'));
				redirect('vessels/manage/memo_list/'.$vessel_id);
			}	
		}else{

			$data['memo_details'] = $this->vessel->memo_details($this->uri->segment(4));
			$this->load->view('modal/delete_memo',$data);
		}
		
	}


	function delete_party(){
		if ($this->input->post() ){

			$vessel_id = $this->input->post('vessel_id', TRUE);					
			$document_id = $this->input->post('document_id', TRUE);			
			
			$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
			$this->form_validation->set_rules('vessel_id', 'Vessel ID', 'required');
			$this->form_validation->set_rules('document_id', 'Document ID', 'required');


			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('vessels/manage/document_vessel_list/'.$vessel_id);
			}else{	
				$form_data = array(
			                'deleted' => 1,
			                'user_deleted'			=>	$this->session->userdata('user_id'),
							'date_deleted'			=>	date('Y-m-d'),
							'time_deleted'			=>	date('H:i:s'),
			    );
				$this->db->where('document_id',$document_id)->update('trx_vessel_document', $form_data);

				$activity = ucfirst($this->tank_auth->get_username().' deleted VD #'.$document_id);
				$this->_log_activity($document_id,$activity,$icon = 'fa-pencil'); //log activity

				$this->session->set_flashdata('response_status', 'success');
				$this->session->set_flashdata('message', lang('document_deleted_successfully'));
				redirect('vessels/manage/document_vessel_list/'.$vessel_id);
			}	
		}else{

			$data['document_details'] = $this->vessel->document_detail($this->uri->segment(4));	
			$this->load->view('modal/delete_party',$data);
		}
		
	}

	
	function unload_receipt_list(){
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('unload_receipt_list').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		
		//$vessel_id = $this->encrypt->decode($this->uri->segment(4));
		$data['page'] = lang('unload_receipt_list');
		$data['form'] = TRUE;
		$data['datatables'] = TRUE;
		
		//VESSEL ALL 10ROWS LEFT SIDE	
		$data['vessels'] = $this->AppModel->get_all_records_limit($table = 'mst_vessels',
		$array = array(
			'vessel_id >' => 0, 'vessel_status <' => 2,  'deleted' => 0
			),
		$join_table = 'mst_reference',$join_criteria = 'mst_reference.No_Urut_Ref = mst_vessels.vessel_status AND fx_mst_reference.Type_Ref="vessel_status"','vessel_ref', 10);
		
		//MASTER STATUS VESSEL
		$data['trucks'] = $this->AppModel->get_all_record_reference($table = 'mst_trucks',
		$array = array('truck_id >' => 0, 'deleted' => 0),'truck_ref');

		//TRX DOCUMENT DETAILS		
		$data['unload_receipt_lists'] = $this->vessel->unload_receipt_list($this->uri->segment(4));	


		//TRX DOCUMENT DETAILS		
		//$data['document_details'] = $this->vessel->document_vessel($this->uri->segment(4));
		$data['vessel_details'] =$this->vessel->get_all_records($table = 'mst_vessels',
		$array = array('vessel_id' => $this->uri->segment(4), 'deleted' => 0),'','','vessel_init');	
		
		$this->template
		->set_layout('users')
		->build('unload_receipt_list',isset($data) ? $data : NULL);
	
	}	
	
	function document_vessel_edit(){
	if ($this->input->post()) {

		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('vessel_id', 'Vessel ID', 'trim|required|xss_clean');
		$this->form_validation->set_rules('party_id', 'Party ID', 'trim|required|xss_clean');
		$this->form_validation->set_rules('po_ref', 'PO Reference', 'trim|required|min_length[1]|max_length[25]|xss_clean');
		$this->form_validation->set_rules('item_id', 'Item ID', 'trim|required|xss_clean');
		$this->form_validation->set_rules('item_type_id', 'Item Type', 'trim|required|min_length[1]|max_length[1]|xss_clean');
		$this->form_validation->set_rules('qty_po', 'Qty PO', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('client_id', 'Client ID', 'trim|required|xss_clean');
		
		$document_id = $this->input->post('document_id', TRUE);
		$vessel_id = $this->input->post('vessel_id', TRUE);	
		$party_id = $this->input->post('party_id', TRUE);
		
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('vessels/manage/document_vessel_edit/'.$document_id);
		}else{
			$form_data = array(
							'company_id'=> 1,
							'site_id'=> 1,
							'vessel_id'=>$vessel_id,
							'party_id'=>$party_id,
							'po_ref' => $this->input->post('po_ref'),
			                'po_date' =>  date("Y-m-d",strtotime($this->input->post('po_date'))),
							'client_id' => $this->input->post('client_id'),
							'item_id' => $this->input->post('item_id'),
							'item_type' =>$this->input->post('item_type_id'),
							'qty_po' =>$this->input->post('qty_po'),							
							'tolerence' =>$this->input->post('tolerence'),	
							'port_id' =>$this->input->post('port_id'),	
							'shipping_name' =>$this->input->post('shipping_name'),	
							'stevedore_name' =>$this->input->post('stevedore_name'),	
							'bl_doc' =>$this->input->post('bl_doc'),								
							'user_modified'=>$this->session->userdata('user_id'),
							'date_modified'=>date('Y-m-d'),
							'time_modified'=>date('H:i:s'),							
			            );
			$this->db->where('document_id', $document_id)->update('trx_vessel_document', $form_data); 
			//$document_id = $this->db->insert_id();

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
			
			$vessel_id = $this->vessel->get_id($table = 'trx_vessel_document',$array = array('document_id' => $this->uri->segment(4), 'deleted' => 0),'vessel_id' );
			

			


			$data['items'] = $this->AppModel->get_all_records($table = 'mst_items',
			$array = array('item_id >' => 0, 'deleted' => 0),
			$join_table = '',$join_criteria = '','item_id');
			

			$data['clients'] = $this->AppModel->get_all_records($table = 'mst_clients',
			$array = array('client_id >' => 0, 'deleted' => 0),
			$join_table = '',$join_criteria = '','client_id');					

			
			$data['vessel_details'] = $this->AppModel->get_all_records($table = 'mst_vessels',
			$array = array('vessel_id' => $vessel_id, 'deleted' => 0),
			$join_table = '',$join_criteria = '','vessel_id');

			//TRX DOCUMENT DETAILS		
			$data['document_details'] = $this->vessel->document_detail($this->uri->segment(4));	
		
			$this->template
			->set_layout('users')
			->build('document_vessel_edit',isset($data) ? $data : NULL);
		}
	
	}	
	
	
	
	function item()
	{
		if ($this->input->post()) {
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
		}else if ($this->vessel->check_key($table='mst_vessel_palka',$array = array('vessel_id' => $vessel_id, 'palka_id' =>  $this->input->post('palka_id'))))
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
		$array = array('vessel_id >' => 0, 'vessel_status <' => 2, 'deleted' => 0),
		$join_table = 'mst_reference',$join_criteria = 'mst_reference.No_Urut_Ref = mst_vessels.vessel_status AND fx_mst_reference.Type_Ref="vessel_status"','vessel_ref', 10);

		
/* 		$data['vessels'] = $this->AppModel->get_all_records($table = 'mst_vessels',
		$array = array('vessel_id >' => 0, 'deleted' => 0),
		$join_table = 'mst_reference',$join_criteria = 'mst_reference.No_Urut_Ref = mst_vessels.vessel_status AND fx_mst_reference.Type_Ref="vessel_status"','vessel_ref'); */
		
		$data['vessel_details'] = $this->AppModel->get_all_records($table = 'mst_vessels',
		$array = array('vessel_id' => $this->uri->segment(4), 'deleted' => 0),
		$join_table = '',$join_criteria = '','vessel_id');
		
		$data['vessel_status'] = $this->AppModel->get_all_record_reference($table = 'mst_reference',
		$array = array('Type_Ref' => 'vessel_status'),'No_Urut_Ref');

		$data['total_item_vessel']=$this->vessel->sum_item($table='trx_sj',$array = array('vessel_id' => $this->uri->segment(4), 'deleted' => 0),'qty_bulk_delivery_netto');	
		
		$this->template
		->set_layout('users')
		->build('vessel_details',isset($data) ? $data : NULL);
	}

	function get_vessel_active_list(){
		$data['pathArray'] = $this->input->post('pathArray');
		$data['vessels'] = $this->AppModel->get_all_records_limit($table = 'mst_vessels',
		$array = array('vessel_id >' => 0, 'vessel_status <' => 2, 'deleted' => 0),
		$join_table = 'mst_reference',$join_criteria = 'mst_reference.No_Urut_Ref = mst_vessels.vessel_status AND fx_mst_reference.Type_Ref="vessel_status"','vessel_ref', 10);

		
        $this->load->view('ajax_vessel_active_list',$data);
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


	function change_status(){
		if ($this->input->post() ){

			$vessel_id = $this->input->post('vessel_id', TRUE);					
			$vessel_status = $this->input->post('vessel_status_id', TRUE);			
			
			$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
			$this->form_validation->set_rules('vessel_id', 'Vessel ID', 'required');


			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('vessels');
			}else{	
				$form_data = array(
			                'vessel_status' => $vessel_status,
			                'user_modified'			=>	$this->session->userdata('user_id'),
							'date_modified'			=>	date('Y-m-d'),
							'time_modified'			=>	date('H:i:s'),
			    );
				$this->db->where('vessel_id',$vessel_id)->update('mst_vessels', $form_data);

				$activity = ucfirst($this->tank_auth->get_username().' change status CS #'.$vessel_id.'-'.$vessel_status);
				$this->_log_activity($vessel_id,$activity,$icon = 'fa-pencil'); //log activity

				$this->session->set_flashdata('response_status', 'success');
				$this->session->set_flashdata('message', lang('vessel_change_status_successfully'));
				redirect('vessels');
			}	
		}else{

		$data['vessel_details'] = $this->AppModel->get_all_records($table = 'mst_vessels',
		$array = array('vessel_id' => $this->uri->segment(4),  'deleted' => 0),
		$join_table = 'mst_reference',$join_criteria = 'mst_reference.No_Urut_Ref = mst_vessels.vessel_status AND fx_mst_reference.Type_Ref="vessel_status"','vessel_ref');
		
		$data['vessel_status'] = $this->AppModel->get_all_records($table = 'mst_reference',$array = array('Type_Ref' =>'vessel_status'),'','','No_Urut_Ref');
		
		$this->load->view('modal/change_status',$data);
		
		}
		
	}	
	
	function change_status_destination(){
		if ($this->input->post() ){

			$document_id = $this->input->post('document_id', TRUE);					
			$document_separate_id = $this->input->post('document_separate_id', TRUE);			
			$destination_id_status= $this->input->post('destination_id_status', TRUE);	
			
			$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
			$this->form_validation->set_rules('document_id', 'Document ID', 'required');
			$this->form_validation->set_rules('document_separate_id', 'Document Separate ID', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('operation_failed'));
				redirect('vessels');
			}else{	
				$form_data = array(
			                'document_separate_status' => $destination_id_status,
			              
			    );
				$this->db->where($array = array(
						'document_separate_id' => $document_separate_id))->update('trx_document_separate', $form_data);

				$this->session->set_flashdata('response_status', 'success');
				$this->session->set_flashdata('message', lang('destination_changed_status_successfully'));
				redirect('vessels/manage/document_vessel_separate/'.$document_id);
			}	
		}else{

			$data['destination_details'] = $this->AppModel->get_all_records($table = 'trx_document_separate', $array = array(
			'document_separate_id' => $this->uri->segment(4)), $join_table = 'mst_destinations', $join_criteria = 'mst_destinations.destination_id=trx_document_separate.destination_id','document_separate_id');
			

		
		$this->load->view('modal/change_status_destination',$data);
		
		}
		
	}
	function _log_activity($vessel_id,$activity,$icon){
			$this->db->set('module', 'vessels');
			$this->db->set('module_field_id', $vessel_id);
			$this->db->set('user', $this->tank_auth->get_user_id());
			$this->db->set('activity', $activity);
			$this->db->set('icon', $icon);
			$this->db->insert('activities'); 
	}

}

/* End of file manage.php */