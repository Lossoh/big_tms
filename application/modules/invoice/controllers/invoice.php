<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Invoice extends MX_Controller
{

    function __construct(){
        parent::__construct();
        
        $this->load->model('invoice_model');
        $this->load->model('appmodel');
        $this->load->model('finances/finances_model');
        $this->load->library('pdf_generator');
        $this->load->library('MoneyFormat');
    }
    
    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('invoices') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('invoices');
        $this->session->set_userdata('page_header', 'transaction');
        $this->session->set_userdata('page_detail', 'invoices');
        $data['datatables'] = true;
        $data['form'] = true;

        if($this->session->userdata('start_date_invoice') == '' ){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_invoice')));
        }

        if($this->session->userdata('end_date_invoice') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_invoice')));
        }

        
        // if($this->session->userdata('start_date') == '' && $this->session->userdata('end_date') == ''){
        //     $start_date = date("Y-m-d",strtotime("yesterday"));
        //     $end_date = date("Y-m-d");
        // }
        // else{
        //     $start_date = $this->session->userdata('start_date');
        //     $end_date = $this->session->userdata('end_date');
        // }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        
        $data['cash_advance_jo'] =$this->invoice_model->get_data_cash_advance_jo();
        $data['data_ap'] = $this->invoice_model->get_data_ap();
        $data['debtor'] = $this->invoice_model->get_all_records('sa_debtor', $array =
            array('rowID >' => 0, 'deleted' => 0, 'type'=>'C'), $join_table = '', $join_criteria = '', 'rowID', 'asc');
        $data['income'] = $this->invoice_model->get_all_records('sa_income', $array =
            array('rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '', 'rowID', 'asc');
        $data['wthHolding'] = $this->invoice_model->get_all_records('sa_wth_rate', $array =
            array('rowID >' => 0), $join_table = '', $join_criteria = '', 'rowID', 'asc');      
        // $data['invoices'] = $this->invoice_model->get_all_record_data($start_date,$end_date);
        
        $this->template->set_layout('users')->build('invoices', isset($data) ? $data : null);
    }
    
    function set_filter(){
       $this->session->set_userdata('start_date_invoice',date("Y-m-d",strtotime($this->input->post('start_date'))));
       $this->session->set_userdata('end_date_invoice',date("Y-m-d",strtotime($this->input->post('end_date'))));    
       
       redirect(base_url().'invoice');
    }
    
    function print_invoice($trx_no){
        $data['get_data'] = $this->invoice_model->get_all_record_data_by_trx_no($trx_no);
        $data['get_data_detail'] = $this->invoice_model->get_all_data_by_trx_no($trx_no);
       
        $sql_update = "UPDATE ar_trx_hdr 
                        SET printed = printed + 1, user_printed = ".$this->session->userdata('user_rowID').",
                            date_printed = '".date('Y-m-d')."', time_printed = '".date('H:i:s')."'
                        WHERE trx_no = '".$trx_no."'";
        
        $this->db->query($sql_update);
        
        $get_data = $this->invoice_model->get_data_header_by_trx_no($trx_no);
        
        $params['user_rowID'] = $this->tank_auth->get_user_id();
		$params['module'] = 'Invoice';
		$params['module_field_id'] = $get_data->rowID;
		$params['activity'] = ucfirst('Print a Invoice No. '.$trx_no);
		$params['icon'] = 'fa-print';
		modules::run('activitylog/log',$params); //log activity	
        
        if($data['get_data']->invoice_type == 'M'){
            $data['data_do'] = $this->invoice_model->get_data_do_manual_by_trx_no($trx_no);   
            $html = $this->load->view('invoice_manual_pdf', $data, true);            
        } 
        else if($data['get_data']->invoice_type == 'J'){
            $data['data_do'] = $this->invoice_model->get_data_delivery_order_by_jo_trx_no($trx_no);
            $html = $this->load->view('invoice_pdf', $data, true);
        } 
        else if($data['get_data']->invoice_type == 'A'){
            $data['data_do'] = $this->invoice_model->get_data_delivery_order_by_ap_trx_no($trx_no);
            $html = $this->load->view('invoice_pdf', $data, true);
        } 
        
        $this->pdf_generator->generate($html, 'invoice pdf',$orientation='Portrait');
    }
    
    function get_wth(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $rowID = $this->input->post('rowID');
        $hasil = $this->invoice_model->get_by_id_wthholding($tabel='sa_wth_rate',$rowID);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }


    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->fare_trip_model->get_by_id($id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }

    function delete_data($id)
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $data = $this->fare_trip_model->delete_data($tabel = 'sa_fare_trip_hdr', $id);
        $data = $this->fare_trip_model->delete_data_detail($tabel='sa_fare_trip_dtl',$id);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }

    function get_data_invoice()
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $cb_prefix = $_GET['prefix'];
        $cb_year   = $_GET['year'];
        $cb_month  = $_GET['month'];
        $cb_code   = $_GET['code'];
        $hasil = $this->invoice_model->get_by_id($cb_prefix,$cb_year,$cb_month,$cb_code);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function get_data_jo(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $jo_no = $this->input->post('jo_no');
        $data = $this->invoice_model->get_data_jo($jo_no);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($data);
        exit;
        
    }
    
    function get_data_detail_do_manual(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $trx_no = $this->input->get('trx_no');
        $data = $this->invoice_model->get_data_detail_do_manual($trx_no);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($data);
        exit;
        
    }
    
    function check_data_do(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $do_no = $this->input->post('do_no');
        $data = $this->invoice_model->get_data_do($do_no);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($data);
        exit;
        
    }
    
    function verify_invoice($row_id)
    {
        
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $check_verification = $this->db->get_where('ar_trx_hdr', array('rowID' =>$row_id))->row_array();
                        
        if (empty($check_verification['rowID'])) {
            echo json_encode(array("success" => false, 'msg' => lang('no_data_transaction')));
            exit();
        } 
        else { 
            // edit Data
            $verified = 1;
            
            $this->invoice_model->update_verified_by_row_id($row_id,$verified);

            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Verify Invoice';
            $params['module_field_id'] = $row_id;
            $params['activity'] = ucfirst('Verify invoice with Transaction No : '.$check_verification['trx_no'].' and ID : ' . $row_id);
            $params['icon'] = 'fa-check';
            modules::run('activitylog/log', $params); //log activity

            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => 'Invoice Verified'));
            exit();
                        
        }

    }
    
    function unverify_invoice($row_id){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $check_verification = $this->db->get_where('ar_trx_hdr', array('rowID' =>$row_id))->row_array();
                        
        if (empty($check_verification['rowID'])) {
            echo json_encode(array("success" => false, 'msg' => lang('no_data_transaction')));
            exit();
        } else { 
            
            $verified = 0;

            $this->invoice_model->update_unverified_by_row_id($row_id,$verified);

            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Unverify Invoice';
            $params['module_field_id'] = $row_id;
            $params['activity'] = ucfirst('Unverify invoice with Transaction No : '.$check_verification['trx_no'].' and ID : ' . $row_id);
            $params['icon'] = 'fa-check';
            modules::run('activitylog/log', $params); //log activity

            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => 'Invoice Unverified'));
            exit();
            
        }

    }
    
    function showDetailInvoice(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $prefix = $_GET['prefix'];
        $year   = $_GET['year'];
        $month  = $_GET['month'];
        $code   = $_GET['code'];
             
        $hasil = $this->db->query("select a.*, b.descs as income_name from ar_trx_dtl as a inner join sa_income as b ON a.income_rowID = b.rowID
         where a.ar_trx_hdr_prefix ='$prefix' and a.ar_trx_hdr_year='$year' and a.ar_trx_hdr_month='$month' and a.ar_trx_hdr_code='$code' and a.deleted = 0 
            and b.deleted = 0 
         order by a.row_detail_ID asc");
         
        $arr = array();
        if (!empty($hasil)) {
            header('Content-Type: application/json');
            foreach ($hasil->result() as $rs) {
                
                $arr[] = array(
                    'income_rowID' => $rs->income_rowID,
                    'income_name' => $rs->income_name,
                    'input_amt' => $rs->input_amt,
                    'base_amt' => $rs->base_amt,
                    'include_vat' => $rs->include_vat,
                    'tax_amt'     => $rs->tax_amt,
                    'wth_rate_rowID' =>$rs->wth_rate_rowID,
                    'wth_amt' =>$rs->wth_amt,
                    'total_amt'=>$rs->total_amt,
                    'descs'=>$rs->descs);
            }
           
            header('Content-Type: application/json');
            echo json_encode($arr);
        }
        exit();
    }
    
    function save_invoice_receipt()
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $dataPost = $this->input->post();
        
        $get_data = $this->invoice_model->get_data_header_by_trx_no($dataPost['invoice_receipt_no']);
        
        $data_update = array(
            'received_date' => date('Y-m-d',strtotime($dataPost['received_date'])),
            'received_no' => $dataPost['received_no'],
            'due_date' => date('Y-m-d',strtotime($dataPost['due_date'])),
			'user_modified'=>$this->session->userdata('user_rowID'),
			'date_modified'=>date('Y-m-d'),
			'time_modified'=>date('H:i:s')
        );
        $this->db->where('trx_no',$dataPost['invoice_receipt_no']);
        $this->db->where('deleted',0);
        $result = $this->db->update('ar_trx_hdr',$data_update);
        
        if($result){
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Invoice';
            $params['module_field_id'] = $get_data->rowID;
            $params['activity'] = ucfirst('Invoice Receipt with No : '.$dataPost['invoice_receipt_no']);
            $params['icon'] = 'fa-edit';
            modules::run('activitylog/log', $params); //log activity
    
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => 'Successfully saved'));
            exit();
        }
        else{
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => false, 'msg' => 'Failed saved'));
            exit();
        }
    }
    
    function save_invoice(){
            $dataPost = $this->input->post();
            //echo "<pre>";print_r($dataPost);echo "</pre>";exit();
            error_reporting(E_ALL);
            Header('Content-Type: application/json; charset=UTF8');
            $error = false;
            $this->db->trans_begin();            
            
            /*
            if(date('Y-m-d',strtotime($dataPost['invoice_date'])) != date('Y-m-d')){
                $alloc_date = date('Y-m-d');
            }
            else{
                $alloc_date = date('Y-m-d',strtotime($dataPost['invoice_date']));
            }
            */
            
            $alloc_date = date('Y-m-d',strtotime($dataPost['invoice_date']));
            
            $alloc_date_year = date('Y',strtotime($alloc_date));
            $alloc_date_month = date('m',strtotime($alloc_date));

            $sa_spec= $this->db->get_where('sa_spec', array('deleted' => 0,'rowID' => 1))->row_array();
            $sa_spec_prefix = $sa_spec['ar_inv'];
            $alloc_code= ((int)$this->appmodel->select_max_id('ar_trx_hdr',$array = array('prefix'=>$sa_spec_prefix,'year' =>$alloc_date_year,'month' =>$alloc_date_month,'deleted' =>0),'code'))+1;
            $alloc_no=$sa_spec_prefix.sprintf("%04s",$alloc_date_year).sprintf("%02s",$alloc_date_month).sprintf("%05s",$alloc_code);
           
            $sa_debtor= $this->db->get_where('sa_debtor', array('deleted' => 0,'rowID' => $dataPost['debtor_id']))->row_array();
            $sa_debtor_category = $sa_debtor['type'];
            $coa_receivable_RowID=$this->appmodel->get_id($table = 'sa_debtor_type', $array = array('deleted' => 0, 'category'=>$sa_debtor_category), 'receiveable_coa_rowID');
                        
            $sa_spec_gl= $this->db->get_where('sa_spec', array('deleted' => 0,'rowID' => 1))->row_array();
            $sa_spec_prefix_gl = $sa_spec_gl['general_jrn'];
            $new_gl_coa_code= ((int)$this->appmodel->select_max_id('gl_trx_hdr',$array = array('prefix'=>$sa_spec_prefix_gl,'year' =>$alloc_date_year,'month' =>$alloc_date_month),'code'))+1;					
            $gl_coa_no=$sa_spec_prefix_gl.sprintf("%04s",$alloc_date_year).sprintf("%02s",$alloc_date_month).sprintf("%05s",$new_gl_coa_code);
            
            $result = $this->invoice_model->simpan_data_header_invoice($sa_spec_prefix,$alloc_code,$alloc_no,$sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$dataPost);
            $rowID = $this->db->insert_id();
            if ($result){
                // if (!empty($dataPost['detailInvoice'])){
                //     $x=0;
                //     foreach ($dataPost['detailInvoice'] as $detInvo){
                //         $x++;
                //         $result= $this->invoice_model->simpan_data_detail_invoice($sa_spec_prefix,$alloc_code,$alloc_no,$x,$dataPost,$detInvo);
                //         if (!$result){
                //             $error = true;
                //             break;
                //         }else{
                //             $error = false;
                //         }
                //     }
                // }
                
                if ($error == false)
                {  
                    $jo_no = $dataPost['jo_no'];
                    
                    $result = $this->invoice_model->update_data_jo($alloc_no,$alloc_date,$jo_no); // Mengupdate nomor invoice di JO
                    if (!$result){
                        $error = true;
                        break;
                    }
                    else{
                        $error = false;
                    }
                }
                
                if ($error == false)
                {  
                    if (!empty($dataPost['do_id'])){
                        $n = count($dataPost['do_id']);
                        $do_id = $dataPost['do_id'];
                        $price = $dataPost['price'];
                        
                        for($i=0;$i<$n;$i++){
                            $result = $this->invoice_model->simpan_data_detail_job_order($alloc_no,$do_id[$i],$price[$i]);
                            if (!$result){
                                $error = true;
                                break;
                            }
                            else{
                                $error = false;
                                $result = $this->invoice_model->update_data_do_detail_invoice($alloc_no,$alloc_date,$do_id[$i]);
                                if (!$result){
                                    $error = true;
                                    break;
                                }
                                else{
                                    $error = false;
                                }
                            }
                        }
                    }
                }
                
                if ($error == false)
                {  
                    if (!empty($dataPost['ap_no'])){
                        $n = count($dataPost['ap_no']);
                        $ap_no = $dataPost['ap_no'];
                        $ap_dtl_id = $dataPost['ap_dtl_id'];
                        $price = $dataPost['price'];
                        
                        for($i=0;$i<$n;$i++){
                            $result = $this->invoice_model->simpan_data_detail_job_order_ap($alloc_no,$ap_dtl_id[$i],$price[$i]);
                            if (!$result){
                                $error = true;
                                break;
                            }
                            else{
                                $error = false;
                                $result = $this->invoice_model->update_data_ap_detail_invoice($alloc_no,$alloc_date,$ap_dtl_id[$i]);
                                if (!$result){
                                    $error = true;
                                    break;
                                }
                                else{
                                    $error = false;
                                }
                            }
                        }
                    }
                }
                
                if ($error == false)
                {    
                    if (!empty($dataPost['detailDO']))
                    {
                        foreach ($dataPost['detailDO'] as $detDO)
                        {
                            $result = $this->invoice_model->simpan_data_detail_do($sa_spec_prefix, $alloc_code, $alloc_no,
                                $dataPost, $detDO);
                            if (!$result)
                            {
                                $error = true;
                                break;
                            } else
                            {
                                $error = false;
                            }
                        }
                    }
                
                } else
                {
                    $error = true;
                }
                
            }
            else{
                $error = true;
            }
  
            if ($error == false){

                    // insert gl header
                    $result = $this->invoice_model->simpanGlHeader($sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$sa_spec_prefix,$alloc_code,$alloc_no,$dataPost);
                    if ($result){
                        $i= 1;
                        // insert GL Detail Piutang
                        $result = $this->invoice_model->simpanGlDetailPiutang($sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$sa_spec_prefix,$alloc_code,$alloc_no,$coa_receivable_RowID,$dataPost);
                         if ($result){
                            $x = 1;
                            // if (!empty($dataPost['detailInvoice']['amountWth'])){
                            //     foreach($dataPost['detailInvoice'] as $detailPPH){
                            //     $x++;
                            //     $coa_wth_rowID=$this->appmodel->get_id($table = 'sa_wth_rate', $array = array('deleted' => 0, 'rowID'=>(isset($detailPPH['cmbWth'])) ? $detailPPH['cmbWth'] : 0), 'wth_coa_rowID'); 
                            //     $result = $this->invoice_model->simpanGlDetailPPH($sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$sa_spec_prefix,$alloc_code,$alloc_no,$coa_wth_rowID,$x,$dataPost,$detailPPH);
                                
                            //     if(!$result){
                            //         $error = true;
                            //         break;
                            //     }else{
                            //         $error = false;
                            //     }
                            //     }
                            // }
                         }else{
                            $error = true;  
                         }
                    }else{
                      $error = true;        
                    }
            }else{
                $error = true;
            }
            
            
            if ($error == false){
                $y = $x;
                // foreach($dataPost['detailInvoice'] as $detK_income){
                //     $y++;
                //     $income_coa_rowID=$this->appmodel->get_id($table = 'sa_income', $array = array('deleted' => 0, 'rowID'=>$detK_income['income_rowId']), 'income_coa_rowID');
                //     $result = $this->invoice_model->simpanGlDetailIncome($sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$sa_spec_prefix,$alloc_code,$alloc_no,$income_coa_rowID,$y,$dataPost,$detK_income);
                //     if (!$result){
                //         $error = true;
                //         break;  
                //     }else{
                //         $error = false;
                //     }    
                // }
                
            }else{
                $error = true;
            }
            
            if ($error == false){
                $z = $y;
                
                // foreach ( $dataPost['detailInvoice'] as $detK_PPN ){
                //     $z++;
                //     $income_coa_rowID=$this->appmodel->get_id($table = 'sa_income', $array = array('deleted' => 0, 'rowID'=>$detK_income['income_rowId']), 'income_coa_rowID');
                //     $ppn_coa_rowID=$this->appmodel->get_id($table = 'sa_income', $array = array('deleted' => 0, 'rowID'=>$detK_PPN['income_rowId']), 'vat_coa_rowID');
                //     if(empty($detK_PPN['cekTax'])){
                //         $result = $this->invoice_model->simpanGlDetailPPN($sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$sa_spec_prefix,$alloc_code,$alloc_no,$income_coa_rowID,$z,$dataPost,$detK_PPN);
                //     }
                //     else{
                //         $result = $this->invoice_model->simpanGlDetailPPN($sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$sa_spec_prefix,$alloc_code,$alloc_no,$ppn_coa_rowID,$z,$dataPost,$detK_PPN);
                //     }
                    
                //     if (!$result) {
                //         $error = true;
                //         break;
                //     }else{
                //         $error = false;
                //     }   
                // }
                
            }else{
                $error = true;
            }
            
            Header('Content-Type: application/json; charset=UTF8');
            $status = $this->db->trans_status();
            if ($status === false || $error == true)
            {
                $this->db->trans_rollback();
                $params['user_rowID'] = $this->tank_auth->get_user_id();
				$params['module'] = 'ERROR ROLLBACK Invoice';
				$params['module_field_id'] = $rowID;
				$params['activity'] = ucfirst('Deleted a Invoice No. '.$alloc_no);
				$params['icon'] = 'fa-exclamation-triangle';
				modules::run('activitylog/log',$params);
                echo json_encode(array('success' => false, 'msg' => " Failed Data RollBack"));
                exit();
            } else
            {
                $this->db->trans_commit();
                
                $params['user_rowID'] = $this->tank_auth->get_user_id();
				$params['module'] = 'Invoice';
				$params['module_field_id'] = $rowID;
				$params['activity'] = ucfirst('Add a new Invoice No '.$alloc_no);
				$params['icon'] = 'fa-plus';
				modules::run('activitylog/log',$params); //log activity	
                
                $info = lang('invoice_created_successfully').' No '.$alloc_no;
                echo json_encode(array('success' => true, 'msg' => $info, 'trx_no' => $alloc_no));
                exit();
            }
            return $status;
    }
    
    function empty_do(){
        $invoice_no = $this->input->post('invoice_no');
        $jo_no = $this->input->post('jo_no');
        
        $get_data = $this->invoice_model->get_data_header_by_trx_no($invoice_no);
        
        $this->invoice_model->update_data_jo_by_invoice($invoice_no);
        $this->invoice_model->update_data_do_by_invoice_jo($invoice_no,$jo_no);
        $this->invoice_model->updateDetailDeliveryOrder_by_invoice_no($invoice_no);
        $this->invoice_model->updateAPDetailDeliveryOrder_by_invoice_no($invoice_no);
        
        $params['user_rowID'] = $this->tank_auth->get_user_id();
		$params['module'] = 'Invoice';
		$params['module_field_id'] = $get_data->rowID;
		$params['activity'] = ucfirst('Empty data DO Invoice No '.$invoice_no.' and JO No '.$jo_no);
		$params['icon'] = 'fa-times';
		modules::run('activitylog/log',$params); //log activity	
        
        $info = 'Empty data DO Successfully';
        echo json_encode(array('success' => true, 'msg' => $info));
        exit();
    }
    
    function update_invoice(){
        $dataPost = $this->input->post();
                
        // Proses input sesuai data sebelumnya
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $error = false;
        $this->db->trans_begin();
        
        $get_data = $this->invoice_model->get_data_header_by_trx_no($dataPost['invoice_no']);
        
        // Proses delete data sebelumnya
        $result = $this->delete_edit_invoice($dataPost);
            
        $alloc_date= date('Y-m-d',strtotime($dataPost['invoice_date']));
        $alloc_date_year= date('Y',strtotime($dataPost['invoice_date']));
        $alloc_date_month= date('m',strtotime($dataPost['invoice_date']));

        $sa_spec_prefix = $dataPost['prefix'];
        $alloc_code= $dataPost['code'];
        $alloc_no= $dataPost['invoice_no'];
        
        $sa_debtor= $this->db->get_where('sa_debtor', array('deleted' => 0,'rowID' => $dataPost['debtor_id']))->row_array();
        $sa_debtor_category = $sa_debtor['type'];
        $coa_receivable_RowID=$this->appmodel->get_id($table = 'sa_debtor_type', $array = array('deleted' => 0, 'category'=>$sa_debtor_category), 'receiveable_coa_rowID');
                    
        $sa_spec_prefix_gl = $dataPost['gl_trx_hdr_prefix'];
        $new_gl_coa_code= $dataPost['gl_trx_hdr_code'];					
        $gl_coa_no= $dataPost['gl_trx_hdr_trx_no'];
        
        if ($result){
            $result = $this->invoice_model->simpan_data_header_invoice($sa_spec_prefix,$alloc_code,$alloc_no,$sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$dataPost);
            $rowID = $this->db->insert_id();
            if ($result){
                // if (!empty($dataPost['detailInvoice'])){
                //     $x=0;
                //     foreach ($dataPost['detailInvoice'] as $detInvo){
                //         $x++;
                //         $result= $this->invoice_model->simpan_data_detail_invoice($sa_spec_prefix,$alloc_code,$alloc_no,$x,$dataPost,$detInvo);
                //         if (!$result){
                //             $error = true;
                //             break;
                //         }else{
                //             $error = false;
                //         }
                //     }
                // }
                
                if ($error == false)
                {  
                    $jo_no_old = $get_data->jo_no;
                    $result = $this->invoice_model->update_data_jo('','',$jo_no_old); // Menghilangkan nomor invoice di JO
                    if (!$result){
                        $error = true;
                        break;
                    }
                    else{
                        $jo_no = $dataPost['jo_no'];
                        
                        $result = $this->invoice_model->update_data_jo($alloc_no,$alloc_date,$jo_no); // Mengupdate nomor invoice di JO
                        if (!$result){
                            $error = true;
                            break;
                        }
                        else{
                            $error = false;
                        }
                    }
                    
                }
                
                if ($error == false)
                {   
                    if (!empty($dataPost['do_id'])){
                        $n = count($dataPost['do_id']);
                        $do_id = $dataPost['do_id'];
                        $price = $dataPost['price'];
                        $jo_no = $get_data->jo_no;
    
                        $result = $this->invoice_model->update_data_do_by_invoice_jo($alloc_no,$jo_no); // Menghapus nomor invoice seluruh nya per JO
                        if (!$result){
                            $error = true;
                            break;
                        }
                        else{
                            $error = false;
                        
                            for($i=0;$i<$n;$i++){
                                $result = $this->invoice_model->simpan_data_detail_job_order($alloc_no,$do_id[$i],$price[$i]);
                                if (!$result){
                                    $error = true;
                                    break;
                                }
                                else{
                                    $error = false;
                                    $result = $this->invoice_model->update_data_do_detail_invoice($alloc_no,$alloc_date,$do_id[$i]);
                                    if (!$result){
                                        $error = true;
                                        break;
                                    }
                                    else{
                                        $error = false;
                                    }
                                }
                            }
                        }
                    }
                }
                
                if ($error == false)
                {   
                    if (!empty($dataPost['ap_no'])){
                        $n = count($dataPost['ap_no']);
                        $ap_no = $dataPost['ap_no'];
                        $ap_dtl_id = $dataPost['ap_dtl_id'];
                        $price = $dataPost['price'];
                        $jo_ap_no = $dataPost['jo_no'];
    
                        $result = $this->invoice_model->update_data_ap_by_invoice_jo($alloc_no,$jo_ap_no); // Menghapus nomor invoice seluruh nya per JO
                        if (!$result){
                            $error = true;
                            break;
                        }
                        else{
                            $error = false;
                        
                            for($i=0;$i<$n;$i++){
                                $result = $this->invoice_model->simpan_data_detail_job_order_ap($alloc_no,$ap_dtl_id[$i],$price[$i]);
                                if (!$result){
                                    $error = true;
                                    break;
                                }
                                else{
                                    $error = false;
                                    $result = $this->invoice_model->update_data_ap_detail_invoice($alloc_no,$alloc_date,$ap_dtl_id[$i]);
                                    if (!$result){
                                        $error = true;
                                        break;
                                    }
                                    else{
                                        $error = false;
                                    }
                                }
                            }
                        }
                        
                    }
                }
                
                if ($error == false)
                {    
                    if (!empty($dataPost['detailDO']))
                    {
                        foreach ($dataPost['detailDO'] as $detDO)
                        {
                            $result = $this->invoice_model->simpan_data_detail_do($sa_spec_prefix, $alloc_code, $alloc_no,
                                $dataPost, $detDO);
                            if (!$result)
                            {
                                $error = true;
                                break;
                            } else
                            {
                                $error = false;
                            }
                        }
                    }
                
                } 
                else{
                    $error = true;
                }
                            
            }
            else{
                $error = true;
            }
        }
        else{
            $error = true;
        }

        if ($error == false){

                // insert gl header
                $result = $this->invoice_model->simpanGlHeader($sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$sa_spec_prefix,$alloc_code,$alloc_no,$dataPost);
                if ($result){
                    $i= 1;
                    // insert GL Detail Piutang
                    $result = $this->invoice_model->simpanGlDetailPiutang($sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$sa_spec_prefix,$alloc_code,$alloc_no,$coa_receivable_RowID,$dataPost);
                     if ($result){
                        $x = 1;
                        // if (!empty($dataPost['detailInvoice']['amountWth'])){
                        //     foreach($dataPost['detailInvoice'] as $detailPPH){
                        //     $x++;
                        //     $coa_wth_rowID=$this->appmodel->get_id($table = 'sa_wth_rate', $array = array('deleted' => 0, 'rowID'=>(isset($detailPPH['cmbWth'])) ? $detailPPH['cmbWth'] : 0), 'wth_coa_rowID'); 
                        //     $result = $this->invoice_model->simpanGlDetailPPH($sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$sa_spec_prefix,$alloc_code,$alloc_no,$coa_wth_rowID,$x,$dataPost,$detailPPH);
                            
                        //     if(!$result){
                        //         $error = true;
                        //         break;
                        //     }else{
                        //         $error = false;
                        //     }
                        //     }
                        // }
                     }else{
                        $error = true;  
                     }
                }else{
                  $error = true;        
                }
        }else{
            $error = true;
        }
        
        
        if ($error == false){
            $y = $x;
            // foreach($dataPost['detailInvoice'] as $detK_income){
            //     $y++;
            //     $income_coa_rowID=$this->appmodel->get_id($table = 'sa_income', $array = array('deleted' => 0, 'rowID'=>$detK_income['income_rowId']), 'income_coa_rowID');
            //     $result = $this->invoice_model->simpanGlDetailIncome($sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$sa_spec_prefix,$alloc_code,$alloc_no,$income_coa_rowID,$y,$dataPost,$detK_income);
            //     if (!$result){
            //         $error = true;
            //         break;  
            //     }else{
            //         $error = false;
            //     }    
            // }
            
        }else{
            $error = true;
        }
        
        if ($error == false){
            $z = $y;
            
            // foreach ( $dataPost['detailInvoice'] as $detK_PPN ){
            //     $z++;
            //     $income_coa_rowID=$this->appmodel->get_id($table = 'sa_income', $array = array('deleted' => 0, 'rowID'=>$detK_income['income_rowId']), 'income_coa_rowID');
            //     $ppn_coa_rowID=$this->appmodel->get_id($table = 'sa_income', $array = array('deleted' => 0, 'rowID'=>$detK_PPN['income_rowId']), 'vat_coa_rowID');
            //     if(empty($detK_PPN['cekTax'])){
            //         $result = $this->invoice_model->simpanGlDetailPPN($sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$sa_spec_prefix,$alloc_code,$alloc_no,$income_coa_rowID,$z,$dataPost,$detK_PPN);
            //     }
            //     else{
            //         $result = $this->invoice_model->simpanGlDetailPPN($sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$sa_spec_prefix,$alloc_code,$alloc_no,$ppn_coa_rowID,$z,$dataPost,$detK_PPN);
            //     }
                
            //     if (!$result) {
            //         $error = true;
            //         break;
            //     }else{
            //         $error = false;
            //     }   
            // }
            
        }else{
            $error = true;
        }
        
        Header('Content-Type: application/json; charset=UTF8');
        $status = $this->db->trans_status();
        if ($status === false || $error == true)
        {
            $this->db->trans_rollback();
            $params['user_rowID'] = $this->tank_auth->get_user_id();
			$params['module'] = 'ERROR ROLLBACK Invoice';
			$params['module_field_id'] = $dataPost['row_id'];
			$params['activity'] = ucfirst('Deleted an Invoice No. '.$alloc_no);
			$params['icon'] = 'fa-exclamation-triangle';
			modules::run('activitylog/log',$params);
            echo json_encode(array('success' => false, 'msg' => " Failed Data RollBack"));
            exit();
        } else
        {
            $this->db->trans_commit();
            $params['user_rowID'] = $this->tank_auth->get_user_id();
			$params['module'] = 'Invoice';
			$params['module_field_id'] = $dataPost['row_id'];
			$params['activity'] = ucfirst('Update an Invoice No '.$alloc_no);
			$params['icon'] = 'fa-edit';
			modules::run('activitylog/log',$params); //log activity	
            
            $info = lang('invoice_edited_successfully').' No '.$alloc_no;
            echo json_encode(array('success' => true, 'msg' => $info, 'trx_no' => $alloc_no));
            exit();
        }
        return $status;
    }
    
    function delete_edit_invoice($parameter){

    	 $dataPost = $parameter;

         error_reporting(E_ALL);
         Header('Content-Type: application/json; charset=UTF8');
         $error = false;
         $this->db->trans_begin();
         
         $alloc_date= date('Y-m-d',strtotime($dataPost['invoice_date']));
         $alloc_date_year= date('Y',strtotime($dataPost['invoice_date']));
         $alloc_date_month= date('m',strtotime($dataPost['invoice_date']));
         
         $sa_debtor= $this->db->get_where('sa_debtor', array('deleted' => 0,'rowID' => $dataPost['debtor_id_tmp']))->row_array();
         $sa_debtor_category = $sa_debtor['type'];
         $coa_receivable_RowID=$this->appmodel->get_id($table = 'sa_debtor_type', $array = array('deleted' => 0, 'category'=>$sa_debtor_category), 'receiveable_coa_rowID');
               
         $sa_spec_gl= $this->db->get_where('sa_spec', array('deleted' => 0,'rowID' => 1))->row_array();
         $sa_spec_prefix_gl = $sa_spec_gl['memorial_jrn'];
         $new_gl_coa_code= ((int)$this->appmodel->select_max_id('gl_trx_hdr',$array = array('prefix'=>$sa_spec_prefix_gl,'year' =>$alloc_date_year,'month' =>$alloc_date_month),'code'))+1;					
         $gl_coa_no=$sa_spec_prefix_gl.sprintf("%04s",$alloc_date_year).sprintf("%02s",$alloc_date_month).sprintf("%05s",$new_gl_coa_code);
         
         $get_data = $this->invoice_model->get_data_header_by_trx_no($dataPost['invoice_no']);

         $result = $this->invoice_model->updateHeaderInvoice($dataPost);
         if ($result){
                $result = $this->invoice_model->updateDetailInvoice($dataPost);
                if (!$result){
                    $error = true;    
                }else{
                    $result = $this->invoice_model->updateDetailDeliveryOrder($dataPost);
                    if (!$result){
                        $error = true;    
                    }else{
                        if($get_data->invoice_type == 'M'){
                            $result = $this->invoice_model->updateDetailDeliveryOrderManual($dataPost);
                            if (!$result){
                                $error = true;    
                            }else{
                                $error = false;
                            }
                        }
                        
                    }
                }
         }else{
            $error = true;
         }
         
         if ($error == false){
            $jo_no_old = $get_data->jo_no;
            $result = $this->invoice_model->update_data_jo('','',$jo_no_old); // Menghilangkan nomor invoice di JO
            if (!$result){
                $error = true;
                break;
            }
            else{
                $error = false;
            }
         }
         
         if ($error == false){
            $result = $this->invoice_model->deleteHeaderGL($get_data->gl_trx_hdr_trx_no);
            if ($result){
                $result = $this->invoice_model->deleteDetailGL($get_data->gl_trx_hdr_trx_no);
                if (!$result){
                    $error = true;                    
                }   
            }
            else{
                $error = true;
            }
         }
         
         /*
         if ($error == false){
            $result = $this->invoice_model->simpanGlHeaderDel($sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$dataPost);
            if ($result){
                $i= 1;
                 $result = $this->invoice_model->simpanGlDetailPiutangDel($sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$coa_receivable_RowID,$dataPost);
                 if ($result){
                     $x = 1;
                     foreach($dataPost['detailInvoice'] as $detailPPH){
                        $x++;
                        //$coa_wth_rowID=$this->appmodel->get_id($table = 'sa_wth_rate', $array = array('deleted' => 0, 'rowID'=>$detailPPH['cmbWth']), 'wth_coa_rowID');
                        $coa_wth_rowID=0;
                        $result = $this->invoice_model->simpanGlDetailPPHDeleted($sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$coa_wth_rowID,$x,$dataPost,$detailPPH);
                        
                        if(!$result){
                            $error = true;
                            break;
                        }else{
                            $error = false;
                        }
                     }
                 }else{
                    $error = true;
                 }
            }else{
                 $error = true;
            }
         }else{
            $error = true;
         }
         
         if ($error == false){
            $y = $x;
            foreach($dataPost['detailInvoice'] as $detK_income){
                $y++;
                $income_coa_rowID=$this->appmodel->get_id($table = 'sa_income', $array = array('deleted' => 0, 'rowID'=>$detailPPH['income_rowId']), 'income_coa_rowID');
                $result = $this->invoice_model->simpanGlDetailIncomeDeleted($sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$income_coa_rowID,$y,$dataPost,$detK_income);
                if (!$result){
                    $error = true;
                    break;  
                }else{
                    $error = false;
                }    
            }
            
        }else{
            $error = true;
        }
        
        if ($error == false){
            $z = $y;
            $ppn_coa_rowID=$this->appmodel->get_id($table = 'sa_income', $array = array('deleted' => 0, 'rowID'=>$detailPPH['income_rowId']), 'vat_coa_rowID');
            foreach ( $dataPost['detailInvoice'] as $detK_PPN ){
                $z++;
                $result = $this->invoice_model->simpanGlDetailPPNDeleted($sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$ppn_coa_rowID,$z,$dataPost,$detK_PPN);
                
                if (!$result) {
                    $error = true;
                    break;
                }else{
                    $error = false;
                }   
            }
            
        }else{
            $error = true;
        }
        
        */
    
        Header('Content-Type: application/json; charset=UTF8');
        $status = $this->db->trans_status();
        if ($status === false || $error == true)
        {
            $this->db->trans_rollback();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
			$params['module'] = 'ERROR ROLLBACK Invoice';
			$params['module_field_id'] = $get_data->rowID;
			$params['activity'] = ucfirst('Deleted an Invoice No '.$alloc_no);
			$params['icon'] = 'fa-exclamation-triangle';
			modules::run('activitylog/log',$params);
            echo json_encode(array('success' => false, 'msg' => " Failed Data RollBack"));
            exit();
        } else
        {
            $this->db->trans_commit();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
			$params['module'] = 'Invoice';
			$params['module_field_id'] = $get_data->rowID;
			$params['activity'] = ucfirst('Deleted Invoice No '.$dataPost['invoice_no'].' for update process');
			$params['icon'] = 'fa-times';
			modules::run('activitylog/log',$params); //log activity	
            
            /* Di-comment karena langsung kembali ke proses edit
            $info = lang('invoice_deleted_successfully').' No.'.$dataPost['invoice_no'];
            echo json_encode(array('success' => true, 'msg' => $info));
            exit();
            */
        }
        return $status;
 
     
    }
    
    function delete_invoice(){
    	 $dataPost = $this->input->post();
         //echo "<pre>";print_r($dataPost);echo "</pre>";exit();
         error_reporting(E_ALL);
         Header('Content-Type: application/json; charset=UTF8');
         $error = false;
         $this->db->trans_begin();
         $alloc_date= date('Y-m-d',strtotime($dataPost['invoice_date']));
         $alloc_date_year= date('Y',strtotime($dataPost['invoice_date']));
         $alloc_date_month= date('m',strtotime($dataPost['invoice_date']));
         
         $sa_debtor= $this->db->get_where('sa_debtor', array('deleted' => 0,'rowID' => $dataPost['debtor_id_tmp']))->row_array();
         $sa_debtor_category = $sa_debtor['type'];
         $coa_receivable_RowID=$this->appmodel->get_id($table = 'sa_debtor_type', $array = array('deleted' => 0, 'category'=>$sa_debtor_category), 'receiveable_coa_rowID');
               
         $sa_spec_gl= $this->db->get_where('sa_spec', array('deleted' => 0,'rowID' => 1))->row_array();
         $sa_spec_prefix_gl = $sa_spec_gl['memorial_jrn'];
         $new_gl_coa_code= ((int)$this->appmodel->select_max_id('gl_trx_hdr',$array = array('prefix'=>$sa_spec_prefix_gl,'year' =>$alloc_date_year,'month' =>$alloc_date_month),'code'))+1;					
         $gl_coa_no=$sa_spec_prefix_gl.sprintf("%04s",$alloc_date_year).sprintf("%02s",$alloc_date_month).sprintf("%05s",$new_gl_coa_code);
         
         $get_data = $this->invoice_model->get_data_header_by_trx_no($dataPost['invoice_no']);

         $result = $this->invoice_model->updateHeaderInvoice($dataPost);
         if ($result){
                $result = $this->invoice_model->updateDetailInvoice($dataPost);
                if (!$result){
                    $error = true;    
                }else{
                    $error = false;
                    $result = $this->invoice_model->updateDetailDeliveryOrder($dataPost);                
                    if (!$result){
                        $error = true;    
                    }else{
                        $error = false;
                        $result = $this->invoice_model->update_data_do_by_invoice_jo($dataPost['invoice_no'],$dataPost['jo_no']); // Menghapus nomor invoice seluruh nya per JO di DO
                        if (!$result){
                            $error = true;
                            break;
                        }
                        else{
                            $error = false;
                            
                            $result = $this->invoice_model->update_data_ap_by_invoice_jo($dataPost['invoice_no'],$dataPost['jo_no']); // Menghapus nomor invoice seluruh nya per JO di AP
                            if (!$result){
                                $error = true;
                                break;
                            }
                            else{
                                if($get_data->invoice_type == 'M'){
                                    $result = $this->invoice_model->updateDetailDeliveryOrderManual($dataPost);
                                    if (!$result){
                                        $error = true;    
                                    }else{
                                        $error = false;
                                    }
                                }
                            }
                        }
                    }
                }
         }else{
            $error = true;
         }
         
         if ($error == false){
            $jo_no_old = $get_data->jo_no;
            $result = $this->invoice_model->update_data_jo('','',$jo_no_old); // Menghilangkan nomor invoice di JO
            if (!$result){
                $error = true;
                break;
            }
            else{
                $error = false;
            }
         }
         
         if ($error == false){
            $result = $this->invoice_model->deleteHeaderGL($get_data->gl_trx_hdr_trx_no);
            if ($result){
                $result = $this->invoice_model->deleteDetailGL($get_data->gl_trx_hdr_trx_no);
                if (!$result){
                    $error = true;                    
                }   
            }
            else{
                $error = true;
            }
         }
         
         /*
         if ($error == false){
            $result = $this->invoice_model->simpanGlHeaderDel($sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$dataPost);
            if ($result){
                $i= 1;
                 $result = $this->invoice_model->simpanGlDetailPiutangDel($sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$coa_receivable_RowID,$dataPost);
                 if ($result){
                     $x = 1;
                     foreach($dataPost['detailInvoice'] as $detailPPH){
                        $x++;
                        //$coa_wth_rowID=$this->appmodel->get_id($table = 'sa_wth_rate', $array = array('deleted' => 0, 'rowID'=>$detailPPH['cmbWth']), 'wth_coa_rowID');
                        $coa_wth_rowID=0;
                        $result = $this->invoice_model->simpanGlDetailPPHDeleted($sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$coa_wth_rowID,$x,$dataPost,$detailPPH);
                        
                        if(!$result){
                            $error = true;
                            break;
                        }else{
                            $error = false;
                        }
                     }
                 }else{
                    $error = true;
                 }
            }else{
                 $error = true;
            }
         }else{
            $error = true;
         }
         
         if ($error == false){
            $y = $x;
            foreach($dataPost['detailInvoice'] as $detK_income){
                $y++;
                $income_coa_rowID=$this->appmodel->get_id($table = 'sa_income', $array = array('deleted' => 0, 'rowID'=>$detailPPH['income_rowId']), 'income_coa_rowID');
                $result = $this->invoice_model->simpanGlDetailIncomeDeleted($sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$income_coa_rowID,$y,$dataPost,$detK_income);
                if (!$result){
                    $error = true;
                    break;  
                }else{
                    $error = false;
                }    
            }
            
        }else{
            $error = true;
        }
        
        if ($error == false){
            $z = $y;
            $ppn_coa_rowID=$this->appmodel->get_id($table = 'sa_income', $array = array('deleted' => 0, 'rowID'=>$detailPPH['income_rowId']), 'vat_coa_rowID');
            foreach ( $dataPost['detailInvoice'] as $detK_PPN ){
                $z++;
                $result = $this->invoice_model->simpanGlDetailPPNDeleted($sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$ppn_coa_rowID,$z,$dataPost,$detK_PPN);
                
                if (!$result) {
                    $error = true;
                    break;
                }else{
                    $error = false;
                }   
            }
            
        }else{
            $error = true;
        }
        */
        
        Header('Content-Type: application/json; charset=UTF8');
        $status = $this->db->trans_status();
        if ($status === false || $error == true)
        {
            $this->db->trans_rollback();
            $params['user_rowID'] = $this->tank_auth->get_user_id();
			$params['module'] = 'ERROR ROLLBACK Invoice';
			$params['module_field_id'] = $get_data->rowID;
			$params['activity'] = ucfirst('Deleted an Invoice No '.$alloc_no);
			$params['icon'] = 'fa-exclamation-triangle';
			modules::run('activitylog/log',$params);
            echo json_encode(array('success' => false, 'msg' => " Failed Data RollBack"));
            exit();
        } else
        {
            $this->db->trans_commit();
            $params['user_rowID'] = $this->tank_auth->get_user_id();
			$params['module'] = 'Invoice';
			$params['module_field_id'] = $get_data->rowID;
			$params['activity'] = ucfirst('Deleted Invoice No '.$dataPost['invoice_no']);
			$params['icon'] = 'fa-times';
			modules::run('activitylog/log',$params); //log activity	
            
            $info = lang('invoice_deleted_successfully').' No '.$dataPost['invoice_no'];
            echo json_encode(array('success' => true, 'msg' => $info));
            exit();
        }
        return $status;
 
    }
    
    function get_data_do(){
        error_reporting(E_ALL);
        $data['form'] = true;
        $data['datatables'] = true;
        $jo_no = $this->input->post('jo_no');

        $data['data_do'] = $this->invoice_model->get_data_do_by_jo_no($jo_no);
        $this->load->view('ajax_data_do', $data);
    }
    
    function get_data_jo_ap_no(){
        error_reporting(E_ALL);
        $data['form'] = true;
        $data['datatables'] = true;
        $jo_ap_no = $this->input->post('jo_ap_no');

        $data['data_do'] = $this->invoice_model->get_data_ap_by_jo_ap_no($jo_ap_no);
        $this->load->view('ajax_data_ap', $data);
    }
    
    function get_data_ap(){
        error_reporting(E_ALL);
        header('Content-Type: application/json');

        $ap_no = $this->input->post('ap_no');
        $data_ap = $this->invoice_model->get_data_ap_by_ap_no($ap_no);

        $arr = array('total_ap' => $data_ap->total_ap);

        header('Content-Type: application/json');
        echo json_encode($arr);
        exit;
    }

    function get_data_use_do(){
        error_reporting(E_ALL);
        $data['form'] = true;
        $data['datatables'] = true;
        $trx_no = $this->input->post('trx_no');

        $data['data_do'] = $this->invoice_model->get_data_use_do_by_trx_no($trx_no);
        $this->load->view('ajax_data_use_do', $data);
    }
    
    function get_data_use_jo_ap_no(){
        error_reporting(E_ALL);
        $data['form'] = true;
        $data['datatables'] = true;
        $trx_no = $this->input->post('trx_no');

        $data['data_do'] = $this->invoice_model->get_data_use_ap_by_jo_ap_no($trx_no);
        $this->load->view('ajax_data_use_ap', $data);
    }

    function fetch_data() { 
        if ($this->input->is_ajax_request()) {
            $dt = $_POST;

            if($this->session->userdata('start_date_invoice') == '' ){
                $start_date = date("Y-m-d", strtotime('-6 day'));
            }else{
                $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_invoice')));
            }

            if($this->session->userdata('end_date_invoice') == ''){
                $end_date = date("Y-m-d");
            }else{
                $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_invoice')));
            }
            $str_between = " AND ar_trx_hdr.trx_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";
        
            $dt['table'] = 'ar_trx_hdr';
            $dt['id'] = 'rowID';

            $aColumnTable = array(
                'ar_trx_hdr.rowID', 'ar_trx_hdr.trx_no', 'ar_trx_hdr.trx_date', 'sa_debtor.debtor_name', 'ar_trx_hdr.descs', 'ar_trx_hdr.base_amt', 'ar_trx_hdr.tax_amt', 'ar_trx_hdr.total_amt', 'ar_trx_hdr.verified', 'ar_trx_hdr.prefix', 'ar_trx_hdr.year', 'ar_trx_hdr.month', 'ar_trx_hdr.code', 'sa_debtor.debtor_cd'
            );

            $aColumns = array(
                'ar_trx_hdr.rowID', 'ar_trx_hdr.trx_no', 'ar_trx_hdr.trx_date', 'sa_debtor.debtor_name', 'ar_trx_hdr.descs', 'ar_trx_hdr.base_amt', 'ar_trx_hdr.tax_amt', 'ar_trx_hdr.total_amt', 'ar_trx_hdr.verified', 'ar_trx_hdr.prefix', 'ar_trx_hdr.year', 'ar_trx_hdr.month', 'ar_trx_hdr.code', 'sa_debtor.debtor_cd'
            );

            $groupBy = '';

            /** Paging * */
            $sLimit = "";
            if (isset($dt['start']) && $dt['length'] != '-1') {
                $sLimit = " LIMIT " . intval($dt['start']) . ", " . intval($dt['length']);
            }

            /** Ordering * */
            $sOrder = " ORDER BY ";
            $sOrderIndex = $dt['order'][0]['column'];
            $sOrderDir = $dt['order'][0]['dir'];
            $bSortable_ = $dt['columns'][$sOrderIndex]['orderable'];
            if ($bSortable_ == "true") {
                $sOrder .= $aColumnTable[$sOrderIndex] . ($sOrderDir === 'asc' ? ' asc' : ' desc');
            } else {
                $sOrder .= " ar_trx_hdr.trx_no DESC";
            }

            /* Individual column filtering */
            $sSearchReg = $dt['search']['regex'];
            for ($i = 0; $i < count($aColumns); $i++) {
                $bSearchable_ = $dt['columns'][$i]['searchable'];
                if (isset($bSearchable_) && $bSearchable_ == "true" && $sSearchReg != 'false') {
                    $search_val = $dt['columns'][$i]['search']['value'];
                    if ($sWhere == "") {
                        $sWhere = " WHERE ";
                    } else {
                        $sWhere .= " AND ";
                    }
                    $sWhere .= $aColumns[$i] . " LIKE '%" . $this->db->escape_like_str($search_val) . "%' ";
                }
            }

            if (!empty($dt['columns'][8]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $start_date = date('Y-m-d', strtotime($dt['columns'][8]['search']['value']));
                $this->session->set_userdata('start_date_invoice',date("Y-m-d",strtotime($start_date)));

                if($this->session->userdata('end_date_invoice') == ''){
                    $end_date = date("Y-m-d");
                }else{
                    $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_invoice')));
                }
                $str_between = " AND ar_trx_hdr.trx_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";

                $sWhere.= ' ar_trx_hdr.deleted = 0 ' . $str_between; 
            }

            if (!empty($dt['columns'][9]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $end_date = date('Y-m-d', strtotime($dt['columns'][9]['search']['value']));
                $this->session->set_userdata('end_date_invoice', date("Y-m-d",strtotime($end_date)));

                if($this->session->userdata('start_date_invoice') == ''){
                    $start_date = date("Y-01-01");
                }else{
                    $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_invoice')));
                }
                $str_between = " AND ar_trx_hdr.trx_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";
                
                $sWhere.= ' ar_trx_hdr.deleted = 0 ' . $str_between; 
            }

            /** Filtering * */
            $sWhere = "";
            $sSearchVal = $dt['search']['value'];
            if (isset($sSearchVal) && $sSearchVal != '') {
                $sWhere = " WHERE (";
                for ($i = 0; $i < count($aColumns); $i++) {
                    $sWhere .= $aColumns[$i] . " LIKE '%" . $this->db->escape_like_str($sSearchVal) . "%' OR ";

                }

                $sWhere = substr_replace($sWhere, "", -3);
                $sWhere .= ') AND ar_trx_hdr.deleted = 0 ' . $str_between;
            } 

            /** Total Data Set Length * */
            $sQuery = 'SELECT * FROM ' . $dt['table'] . ' LEFT JOIN sa_debtor ON sa_debtor.rowID = ar_trx_hdr.debtor_rowID WHERE ar_trx_hdr.deleted = 0 ' . $str_between;
            $rResultTotal = $this->db->query($sQuery);
            $aResultTotal = $rResultTotal->num_rows();
            $iTotal = $aResultTotal;
            
            /* Get Data To Display */
            if ($sWhere != "") {
                $where = $sWhere;
            } else {
                $where = " WHERE ar_trx_hdr.deleted = 0 " . $str_between;
            }

            $join_table = ' LEFT JOIN sa_debtor ON sa_debtor.rowID = ar_trx_hdr.debtor_rowID ';

            $sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) .
                    " FROM " . $dt['table'] . $join_table . $where . $groupBy . $sOrder . $sLimit;
            $rResult = $this->db->query($sQuery);

            /* Data set length after filtering */
            $sQuery = "SELECT FOUND_ROWS() AS length_count";
            $rResultFilterTotal = $this->db->query($sQuery);
            $aResultFilterTotal = $rResultFilterTotal->row();
            $iFilteredTotal = $aResultFilterTotal->length_count;

            /** Output */
            $draw = $dt['draw'];
            $data = array();
            if (!empty($rResult)) {
                foreach ($rResult->result_array() as $aRow) {
                    $dt['start'] ++;
                    $row = array();

                    $dropdown_option = "";
                    $dropdown_option .= '<div class="btn-group">';
                    $dropdown_option .= '<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">';
                    $dropdown_option .= lang('options');
                    $dropdown_option .= '<span class="caret"></span>';
                    $dropdown_option .= '</button>';
                    $dropdown_option .= '<ul class="dropdown-menu">';
                    if($this->get_user_access('PrintLimited') == 1 || $this->get_user_access('PrintUnlimited') == 1 || $this->get_user_access('PrintOne') == 1 || $this->get_user_access('PrintTwo') == 1){
                        if($this->get_user_access('PrintLimited') == 1){
                            if($this->get_log_limited_printed($aRow['trx_no'],'invoice') == 0){
                                $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('reprint') . '" onclick="reprint_invoice(\'' . $aRow['trx_no'] . '\')"><i class="fa fa-print"></i> ' . lang('reprint') . '</a></li>';
                            }
                        }else{
                            $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('reprint') . '" onclick="reprint_invoice(\'' . $aRow['trx_no'] . '\')"><i class="fa fa-print"></i> ' . lang('reprint') . '</a></li>';
                        }
                    }
                                    
                    if($aRow['verified'] == 0){
                        if($this->get_user_access('Verified') == 1){
                            $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('verify') . '" onclick="verify_invoice(\'' . $aRow['trx_no'] . '\',\'' . $aRow['rowID'] . '\')"><i class="fa fa-check"></i> ' . lang('verify') . '</a></li>';
                        }
                        if($this->get_user_access('Updated') == 1){
                            $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('update_option') . '" onclick="edit_invoice(\'' .$aRow['prefix'] . '\',\'' . $aRow['year'] . '\',\'' . $aRow['month'] . '\',\'' . $aRow['code'] . '\')"><i class="fa fa-pencil"></i> ' . lang('update_option') . '</a></li>';
                        }
                        if($this->get_user_access('Deleted') == 1){
                            $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('delete_option') . '" onclick="delete_invoice(\'' . $aRow['prefix'] . '\',\'' . $aRow['year'] . '\',\'' . $aRow['month'] . '\',\'' . $aRow['code'] . '\')"><i class="fa fa-trash-o"></i> ' . lang('delete_option') . '</a></li>';
                        }
                    }else{
                        if($this->get_user_access('Verified') == 1){
                            $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('unverify') . '" onclick="unverify_invoice(\'' . $aRow['trx_no'] . '\',\'' . $aRow['rowID'] . '\')"><i class="fa fa-times"></i> ' . lang('unverify') . '</a></li>';
                        }
                        if($this->get_user_access('Updated') == 1){
                            $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('receipt') . '" onclick="receipt_invoice(\'' .$aRow['prefix'] . '\',\'' . $aRow['year'] . '\',\'' . $aRow['month'] . '\',\'' . $aRow['code'] . '\')"><i class="fa fa-file-text-o"></i> ' . lang('receipt') . '</a></li>';
                        }
                    }
                    $dropdown_option .= '</ul></div>';
              
                    $row['dropdown_option'] = $dropdown_option;
                    $row['trx_no'] = $aRow['trx_no'];
                    $row['trx_date'] = date("d F Y",strtotime($aRow['trx_date']));
                    $row['debtor'] = $aRow['debtor_cd'] . ' - ' . $aRow['debtor_name'];
                    $row['descs'] = $aRow['descs'];
                    $row['base_amt'] = number_format($aRow['base_amt'],2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));
                    $row['tax_amt'] = number_format($aRow['tax_amt'],2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));
                    $row['total_amt'] = number_format($aRow['total_amt'],2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));

                    $row['start_date'] = $aRow['trx_date'];
                    $row['end_date'] = $aRow['trx_date'];
                    $data[] = $row;
                }
            }

            $output = array(
                "draw" => intval($draw),
                "recordsTotal" => $iTotal,
                "recordsFiltered" => $iFilteredTotal,
                "data" => $data
            );
            echo json_encode($output);
        } else {
            show_404();
        }
    }

    function get_user_access($field){
        $this->db->where('status','1');
        $this->db->where('Link_Menu', 'invoice');
        $query_menu = $this->db->get('sa_menu');        
        $get_menu = $query_menu->row();
        $menu_id = $get_menu->Seq_Menu;

        if($menu_id > 0){
            $this->db->where('user_rowID',$this->session->userdata('user_id'));
            $this->db->where('StatusUsermenu','1');
            $this->db->where('Kd_Menu',$menu_id);
            $query = $this->db->get('sa_usermenu');
            if ($query->num_rows() > 0){
                $row = $query->row();
                return $row->$field;
            } else{
                return 0;
            }
        } else{
           return 0;
        }
        
    }
    
    function get_log_limited_printed($trx_no,$module)
	{
        $sql = "SELECT * FROM activities 
                WHERE user_rowID = ".$this->session->userdata('user_id')." AND activity LIKE '%".$trx_no."%' AND module = '".$module."' 
                        AND icon = 'fa-print' AND deleted = 0";
        $query = $this->db->query($sql);
		if ($query->num_rows() > 0){
            return $query->num_rows();
		} else{
			return 0;
		}	   
    }
    
}

/* End of file contacts.php */
