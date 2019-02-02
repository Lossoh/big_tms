<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class cash_bank_payment extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('tank_auth');
        
        $this->load->model('cash_bank_payment_model');
        $this->load->model('appmodel');
        $this->load->library('pdf_generator');
    }

    function pdf()
    {
        if($this->session->userdata('start_date_cb') == '' ){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_cb')));
        }

        if($this->session->userdata('end_date_cb') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_cb')));
        }

        // if($this->session->userdata('start_date_cb') == '' && $this->session->userdata('end_date_cb') == ''){
        //     $start_date = date("Y-m-d",strtotime("yesterday"));
        //     $end_date = date("Y-m-d");
        // }
        // else{
        //     $start_date = $this->session->userdata('start_date_cb');
        //     $end_date = $this->session->userdata('end_date_cb');
        // }
        
        $data['periode'] = date("d F Y",strtotime($start_date)).' - '.date("d F Y",strtotime($end_date));
                        
        $data['cash_banks'] = $this->cash_bank_payment_model->get_all_record_data($start_date,$end_date);
        
        $html = $this->load->view('cash_bank_payment_pdf', $data, true);
        $this->pdf_generator->generate($html, 'cash bank payment', $orientation = 'Portrait'); //Portrait
    }

    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=cash_bank_payment.xls");

        if($this->session->userdata('start_date_cb') == '' ){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_cb')));
        }

        if($this->session->userdata('end_date_cb') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_cb')));
        }
        
        // if($this->session->userdata('start_date_cb') == '' && $this->session->userdata('end_date_cb') == ''){
        //     $start_date = date("Y-m-d",strtotime("yesterday"));
        //     $end_date = date("Y-m-d");
        // }
        // else{
        //     $start_date = $this->session->userdata('start_date_cb');
        //     $end_date = $this->session->userdata('end_date_cb');
        // }
        
        $data['periode'] = date("d F Y",strtotime($start_date)).' - '.date("d F Y",strtotime($end_date));
        
        $data['cash_banks'] = $this->cash_bank_payment_model->get_all_record_data($start_date,$end_date);
        
        $this->load->view("cash_bank_payment_pdf", $data);

    }

    function print_cash_bank_payment()
    {
        $cb_prefix = $_GET['prefix'];
        $cb_year   = $_GET['year'];
        $cb_month  = $_GET['month'];
        $cb_code   = $_GET['code'];
        
        $get_data = $this->cash_bank_payment_model->get_cb_by_id($cb_prefix,$cb_year,$cb_month,$cb_code);
        if($get_data->debtor_creditor_type == 'C'){
            $get_data = $this->cash_bank_payment_model->get_cb_customer_by_id($cb_prefix,$cb_year,$cb_month,$cb_code);
        
            if($get_data->rowID == null){
                $rowID = 0;
            }
            else{
                $rowID = $get_data->rowID;
            }
        }
        else{
            if($get_data->rowID == null){
                $rowID = 0;
            }
            else{
                $rowID = $get_data->rowID;
            }            
        }
        
        $data['cash_bank'] = $get_data; 
        $data['payment_detail'] = $this->db->order_by('advance_invoice_no','asc')->get_where('cb_trx_dtl', array('cb_trx_hdr_prefix' =>
                $cb_prefix, 'cb_trx_hdr_year' => $cb_year,'cb_trx_hdr_month' =>$cb_month,'cb_trx_hdr_code'  =>$cb_code, 'deleted' => 0))->result();
        $data['giro_detail'] = $this->db->get_where('cb_trx_cg', array('cb_trx_hdr_prefix' =>
                $cb_prefix, 'cb_trx_hdr_year' => $cb_year,'cb_trx_hdr_month' =>$cb_month,'cb_trx_hdr_code'  =>$cb_code, 'deleted' => 0))->result();
                
        // Log Printed
        $sql_printed = "UPDATE cb_trx_hdr SET printed = printed+1, user_printed = ".$this->session->userdata('user_id').", date_printed = '".date('Y-m-d')."',
                        time_printed = '".date('H:i:s')."' WHERE trx_no = '".$get_data->trx_no."' AND deleted = 0";
        $this->db->query($sql_printed);

        $params['user_rowID'] = $this->tank_auth->get_user_id();
		$params['module'] = 'Cash Bank Payment';
		$params['module_field_id'] = $rowID;
		$params['activity'] = ucfirst('Print a Cash Bank Payment No. '.$get_data->trx_no);
		$params['icon'] = 'fa-print';
		modules::run('activitylog/log',$params); //log activity	
                
        $html = $this->load->view('cash_bank_payment_print_pdf', $data, true);

        $this->pdf_generator->generate($html, 'cash bank payment', $orientation = 'Portrait'); //Portrait
    }

    function print_release_bank_payment()
    {
        $cb_prefix = $_GET['prefix'];
        $cb_year   = $_GET['year'];
        $cb_month  = $_GET['month'];
        $cb_code   = $_GET['code'];
        
        $get_data = $this->cash_bank_payment_model->get_cb_by_id($cb_prefix,$cb_year,$cb_month,$cb_code);
        if($get_data->debtor_creditor_type == 'C'){
            $get_data = $this->cash_bank_payment_model->get_cb_customer_by_id($cb_prefix,$cb_year,$cb_month,$cb_code);
            
            if($get_data->rowID == null){
                $rowID = 0;
            }
            else{
                $rowID = $get_data->rowID;
            }
        }
        else{
            if($get_data->rowID == null){
                $rowID = 0;
            }
            else{
                $rowID = $get_data->rowID;
            }            
        }
        
        
        $data['cash_bank'] = $get_data; 
        $data['payment_detail'] = $this->cash_bank_payment_model->get_data_release_reference($get_data->trx_no);
        $data['giro_detail'] = $this->db->get_where('cb_trx_cg', array('cb_trx_hdr_prefix' =>
                $cb_prefix, 'cb_trx_hdr_year' => $cb_year,'cb_trx_hdr_month' =>$cb_month,'cb_trx_hdr_code'  =>$cb_code, 'deleted' => 0))->result();
                
        // Log Printed
        $sql_printed = "UPDATE cb_trx_hdr SET printed = printed+1, user_printed = ".$this->session->userdata('user_id').", date_printed = '".date('Y-m-d')."',
                        time_printed = '".date('H:i:s')."' WHERE trx_no = '".$get_data->trx_no."' AND deleted = 0";
        $this->db->query($sql_printed);

        $params['user_rowID'] = $this->tank_auth->get_user_id();
		$params['module'] = 'Cash Bank Payment';
		$params['module_field_id'] = $rowID;
		$params['activity'] = ucfirst('Print a Cash Bank Payment No. '.$get_data->trx_no);
		$params['icon'] = 'fa-print';
		modules::run('activitylog/log',$params); //log activity	
                
        $html = $this->load->view('release_bank_payment_print_pdf', $data, true);

        $this->pdf_generator->generate($html, 'cash bank payment', $orientation = 'Portrait'); //Portrait
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title('Cash Bank Payment' . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = 'Cash Bank Payment';
        $this->session->set_userdata('page_header', 'transaction');
        $this->session->set_userdata('page_detail', 'cash_bank_payment');
        $data['datatables'] = true;
        $data['form'] = true;

        if($this->session->userdata('start_date_cb') == '' ){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_cb')));
        }

        if($this->session->userdata('end_date_cb') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_cb')));
        }
        
        // if($this->session->userdata('start_date_cb') == '' && $this->session->userdata('end_date_cb') == ''){
        //     $start_date = date("Y-m-d",strtotime("yesterday"));
        //     $end_date = date("Y-m-d");
        // }
        // else{
        //     $start_date = $this->session->userdata('start_date_cb');
        //     $end_date = $this->session->userdata('end_date_cb');
        // }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        
        // $data['cash_bank_payments'] = $this->cash_bank_payment_model->get_all_record_data($start_date,$end_date);
        $data['coas'] = $this->cash_bank_payment_model->get_account();
        
        $this->template->set_layout('users')->build('cash_bank_payment', isset($data) ?
            $data : null);
    }
    
    function set_filter(){
       $this->session->set_userdata('start_date_cb',date("Y-m-d",strtotime($this->input->post('start_date'))));
       $this->session->set_userdata('end_date_cb',date("Y-m-d",strtotime($this->input->post('end_date'))));    
       
       redirect(base_url().'cash_bank_payment');
    }
    
    function get_data_debtor(){
        $employee_type = $this->input->post('employee_type');
        
        $debtor = $this->cash_bank_payment_model->get_all_records('sa_debtor', $array =
            array('rowID >' => 0, 'deleted' => 0, 'type' => $employee_type), $join_table = '', $join_criteria = '', 'type,debtor_cd', 'asc');
        
        if (!empty($debtor)) {
            echo "<option value=''>".lang('select_your_option')."</option>";
            foreach ($debtor as $rs) {
		      echo '<option value="'.$rs->rowID.'">'.$rs->type.$rs->debtor_cd.' - '.$rs->debtor_name.'</option>';
            }
        }
        
        exit;
    }
    
    function search_cheque_giro(){
        $cheque_giro_no = $this->input->post('cheque_giro_no');
        
        $sql = "SELECT * FROM cb_trx_cg
                WHERE deleted = 0 AND (payment_method = 'cheque' OR payment_method = 'giro') AND cg_no = '$cheque_giro_no'
                ORDER BY trx_no";
        
        $query = $this->db->query($sql);
        $get_data = $query->result();
                
        if (count($get_data) == 1) {
            foreach ($get_data as $row) {
		      echo 'Cash Bank No : '.$row->trx_no;
            }
        }
        else if (count($get_data) >= 2) {
            $no = 1;
            echo 'Cash Bank No : ';
            foreach ($get_data as $row) {
		      echo $no++.'. '.$row->trx_no.', ';
            }
        } 
        else{
            echo 'Cheque Number Not Found.';
        }
        
        exit;
    }
    
    function simpan_cash_bank_payment()
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $dataPost = $this->input->post();

        $this->db->trans_begin();
        $process = true;
        
        if (empty($dataPost['cb_payment_no'])) {
            /*
            if(date('Y-m-d',strtotime($dataPost['cb_payment_date'])) != date('Y-m-d')){
                $alloc_date = date('Y-m-d');
            }
            else{
                $alloc_date = date('Y-m-d',strtotime($dataPost['cb_payment_date']));
            }
            */
            $alloc_date = date('Y-m-d',strtotime($dataPost['cb_payment_date']));
        }
        else{
            $alloc_date = date('Y-m-d',strtotime($dataPost['cb_payment_date']));
        }
        
        if($process == true){
            $cek_string = stripos($dataPost['cb_remark'],'uang makan');
            if($cek_string !== FALSE){
                $check_data_exist = $this->cash_bank_payment_model->get_data_header_by_type_driver('uang_makan',$dataPost['debtor_creditor'],date('Y-m-d',strtotime($dataPost['cb_payment_date'])));
                if(count($check_data_exist) > 0){
                    echo json_encode(array('success' => false, 'msg' => "Data uang makan already exist!"));
                    exit();
                }
            }
            
            $cek_string = stripos($dataPost['cb_remark'],'stan');
            if($cek_string !== FALSE){
                $check_data_exist = $this->cash_bank_payment_model->get_data_header_by_type_driver('stand_by',$dataPost['debtor_creditor'],date('Y-m-d',strtotime($dataPost['cb_payment_date'])));
                if(count($check_data_exist) > 0){
                    echo json_encode(array('success' => false, 'msg' => "Data stand by already exist!"));
                    exit();
                }
            }
            
            foreach ($dataPost['detailPay'] as $detPay) {
                if($dataPost['cb_trx_type'] == 'cash_advance'){
                    $check_data_ca = $this->cash_bank_payment_model->get_data_detail_by_advance_invoice_type_no($dataPost['payment_type'],$dataPost['cb_trx_type'],$detPay['advance_invoice_no']);
                    if(count($check_data_ca) > 0){
                        echo json_encode(array('success' => false, 'msg' => "Data cash advance already exist!"));
                        exit();
                    }
                }
            }
            
            $alloc_date_year = date('Y',strtotime($alloc_date));
            $alloc_date_month = date('m',strtotime($alloc_date));
            
            $dept_rowID = $this->session->userdata('dep_rowID');
            $dept = $this->db->get_where('sa_dep', array('deleted' => 0, 'rowID' => $dept_rowID))->
                row_array();
    
            if ($dept['ho_trx'] == 'Y') {
                $sa_spec = $this->db->get_where('sa_spec', array('deleted' => 0, 'rowID' => 1))->
                    row_array();
                if($dataPost['payment_type'] == 'P')
                    $sa_spec_prefix = $sa_spec['cash_out_prefix'];
                else
                    $sa_spec_prefix = $sa_spec['cash_in_prefix'];
                    
            } else {
                if($dataPost['payment_type'] == 'P')
                    $sa_spec_prefix = $dept['cash_out_prefix'];
                else
                    $sa_spec_prefix = $dept['cash_in_prefix'];
            }
    
            $alloc_code = ((int)$this->appmodel->select_max_id('cb_trx_hdr', $array = array
                (
                'prefix' => $sa_spec_prefix,
                'year' => $alloc_date_year,
                'month' => $alloc_date_month,
                'deleted' => 0), 'code')) + 1;
            
            $trx_no = $sa_spec_prefix . sprintf("%04s", $alloc_date_year) . sprintf("%02s",
                $alloc_date_month) . sprintf("%05s", $alloc_code);
            
            $check_trx_no = $this->cash_bank_payment_model->get_data_header($trx_no);
            if(count($check_trx_no) > 0){
                $alloc_code = ((int)$this->appmodel->select_max_id('cb_trx_hdr', $array = array
                    (
                    'prefix' => $sa_spec_prefix,
                    'year' => $alloc_date_year,
                    'month' => $alloc_date_month,
                    'deleted' => 0), 'code')) + 1;
            
                $trx_no = $sa_spec_prefix . sprintf("%04s", $alloc_date_year) . sprintf("%02s",
                    $alloc_date_month) . sprintf("%05s", $alloc_code);
                
            }
            
            $edit = 0;
            $id_header = 0;
            if (empty($dataPost['cb_payment_no'])) {
                // simpan header
                $result = $this->cash_bank_payment_model->simpan_header($sa_spec_prefix, $alloc_code,$trx_no,$dataPost);
                $id_header = $result;
                $edit = 0;
    
            } else {
                $sa_spec_prefix = $dataPost['prefix'];
                $alloc_code = $dataPost['code'];
                $trx_no = $dataPost['cb_payment_no'];
                $result = $this->cash_bank_payment_model->edit_header($dataPost);
                $edit = 1;
    
                $result = $this->cash_bank_payment_model->deleteDetailChegue($sa_spec_prefix,$alloc_date_year,$alloc_date_month,$alloc_code);
                $result = $this->cash_bank_payment_model->deleteDetailPay($sa_spec_prefix,$alloc_date_year,$alloc_date_month,$alloc_code);
            }
    
            if (!empty($dataPost['detailgiro'])) {
                $i = 0;
                foreach ($dataPost['detailgiro'] as $detGiro) {
                    $i++;
                    $this->cash_bank_payment_model->simpanDetailGiro($sa_spec_prefix, $alloc_code,$i,$trx_no,$dataPost,$detGiro);
                }
            }
    
            if (!empty($dataPost['detailPay'])) {
                /*  
                *
                START. JIKA ALLOC TIDAK DIDELETE DARI DATABASE
                *
                $get_cb_alloc = $this->cash_bank_payment_model->get_data_alloc_by_alloc_no('cb_cash_adv_alloc',$trx_no);
                $jumlah_cb_alloc = count($get_cb_alloc);
                $get_dep_alloc = $this->cash_bank_payment_model->get_data_alloc_by_alloc_no('tr_deposit_trx_alloc',$trx_no);
                $jumlah_dep_alloc = count($get_dep_alloc);
                $get_ar_alloc = $this->cash_bank_payment_model->get_data_alloc_by_alloc_no('ar_trx_hdr_alloc',$trx_no);
                $jumlah_ar_alloc = count($get_ar_alloc);
                $get_ap_alloc = $this->cash_bank_payment_model->get_data_alloc_by_alloc_no('ap_trx_hdr_alloc',$trx_no);
                $jumlah_ap_alloc = count($get_ap_alloc);
                $get_commission_alloc = $this->cash_bank_payment_model->get_data_alloc_by_alloc_no('tr_commission_trx_alloc',$trx_no);
                $jumlah_commission_alloc = count($get_commission_alloc);
                *
                END. JIKA ALLOC TIDAK DIDELETE DARI DATABASE
                *
                */
                $x = 0;
                $del_cb_alloc = $this->cash_bank_payment_model->delete_data_alloc_by_alloc_no('cb_cash_adv_alloc',$trx_no);
                $del_dep_alloc = $this->cash_bank_payment_model->delete_data_alloc_by_alloc_no('tr_deposit_trx_alloc',$trx_no);
                $del_ar_alloc = $this->cash_bank_payment_model->delete_data_alloc_by_alloc_no('ar_trx_hdr_alloc',$trx_no);
                $del_ap_alloc = $this->cash_bank_payment_model->delete_data_alloc_by_alloc_no('ap_trx_hdr_alloc',$trx_no);
                $del_commission_alloc = $this->cash_bank_payment_model->delete_data_alloc_by_alloc_no('tr_commission_trx_alloc',$trx_no);
                            
                foreach ($dataPost['detailPay'] as $detPay) {
                    $x++;
                    $this->cash_bank_payment_model->simpanDetailPayment($sa_spec_prefix, $alloc_code, $x,
                        $trx_no, $dataPost, $detPay);
                    /*
                    *
                    JIKA DELETE TERLEBIH DAHULU DI DATABASE
                    *
                    */
                    if($dataPost['cb_trx_type'] == 'cash_advance'){
                        if($edit == 1){
                            // Update cash advance -> advance_balance dan pay_over_allocation
                            $this->cash_bank_payment_model->edit_cash_advance_update($dataPost,$detPay);                        
                        }
    
                        // Update cash advance -> advance_balance dan pay_over_allocation
                        $this->cash_bank_payment_model->edit_cash_advance($dataPost,$detPay);
                        
                        // Update cash advance alloc
                        $this->cash_bank_payment_model->simpan_realization_hdr($sa_spec_prefix, $alloc_code, $x,
                            $trx_no, $dataPost, $detPay);
                    }
                    else if($dataPost['cb_trx_type'] == 'deposit'){
                        $this->cash_bank_payment_model->simpan_deposit_alloc($sa_spec_prefix, $alloc_code, $x,
                            $trx_no, $dataPost, $detPay);
                    }
                    else if($dataPost['cb_trx_type'] == 'ar'){
                        $this->cash_bank_payment_model->simpan_ar_alloc($sa_spec_prefix, $alloc_code, $x,
                            $trx_no, $dataPost, $detPay);
                    }
                    else if($dataPost['cb_trx_type'] == 'ap'){
                        $this->cash_bank_payment_model->simpan_ap_alloc($sa_spec_prefix, $alloc_code, $x,
                            $trx_no, $dataPost, $detPay);
                    }
                    else if($dataPost['cb_trx_type'] == 'commission'){
                        $this->cash_bank_payment_model->simpan_commission_alloc($sa_spec_prefix, $alloc_code, $x,
                            $trx_no, $dataPost, $detPay);
                    }
                    
                    /*  
                    *
                    START. JIKA ALLOC TIDAK DIDELETE DARI DATABASE
                    *
                    if($edit == 0){
                        if($dataPost['cb_trx_type'] == 'cash_advance'){
                            $this->cash_bank_payment_model->simpan_realization_hdr($sa_spec_prefix, $alloc_code, $x,
                                $trx_no, $dataPost, $detPay);
                        }
                        else if($dataPost['cb_trx_type'] == 'deposit'){
                            $this->cash_bank_payment_model->simpan_deposit_alloc($sa_spec_prefix, $alloc_code, $x,
                                $trx_no, $dataPost, $detPay);
                        }
                        else if($dataPost['cb_trx_type'] == 'ar'){
                            $this->cash_bank_payment_model->simpan_ar_alloc($sa_spec_prefix, $alloc_code, $x,
                                $trx_no, $dataPost, $detPay);
                        }
                        else if($dataPost['cb_trx_type'] == 'ap'){
                            $this->cash_bank_payment_model->simpan_ap_alloc($sa_spec_prefix, $alloc_code, $x,
                                $trx_no, $dataPost, $detPay);
                        }
                        else if($dataPost['cb_trx_type'] == 'commission'){
                            $this->cash_bank_payment_model->simpan_commission_alloc($sa_spec_prefix, $alloc_code, $x,
                                $trx_no, $dataPost, $detPay);
                        }
                        
                    }
                    else{
                        if($dataPost['cb_trx_type'] == 'cash_advance'){
                            $this->cash_bank_payment_model->edit_realization_hdr($sa_spec_prefix, $alloc_code, $x,
                            $trx_no, $dataPost, $detPay);
                        
                            if($x > $jumlah_cb_alloc){
                                $this->cash_bank_payment_model->simpan_realization_hdr($sa_spec_prefix, $alloc_code, $x,
                                $trx_no, $dataPost, $detPay);                        
                            }
                        }
                        else if($dataPost['cb_trx_type'] == 'deposit'){
                            $this->cash_bank_payment_model->edit_deposit_alloc($sa_spec_prefix, $alloc_code, $x,
                            $trx_no, $dataPost, $detPay);
                        
                            if($x > $jumlah_dep_alloc){
                                $this->cash_bank_payment_model->simpan_deposit_alloc($sa_spec_prefix, $alloc_code, $x,
                                $trx_no, $dataPost, $detPay);                        
                            }
                        }
                        else if($dataPost['cb_trx_type'] == 'ar'){
                            $this->cash_bank_payment_model->edit_ar_alloc($sa_spec_prefix, $alloc_code, $x,
                            $trx_no, $dataPost, $detPay);
                        
                            if($x > $jumlah_ar_alloc){
                                $this->cash_bank_payment_model->simpan_ar_alloc($sa_spec_prefix, $alloc_code, $x,
                                $trx_no, $dataPost, $detPay);                        
                            }
                        }
                        else if($dataPost['cb_trx_type'] == 'ap'){
                            $this->cash_bank_payment_model->edit_ap_alloc($sa_spec_prefix, $alloc_code, $x,
                            $trx_no, $dataPost, $detPay);
                        
                            if($x > $jumlah_ap_alloc){
                                $this->cash_bank_payment_model->simpan_ap_alloc($sa_spec_prefix, $alloc_code, $x,
                                $trx_no, $dataPost, $detPay);                        
                            }
                        }
                        else if($dataPost['cb_trx_type'] == 'commission'){
                            $this->cash_bank_payment_model->edit_commission_alloc($sa_spec_prefix, $alloc_code, $x,
                            $trx_no, $dataPost, $detPay);
                        
                            if($x > $jumlah_commission_alloc){
                                $this->cash_bank_payment_model->simpan_commission_alloc($sa_spec_prefix, $alloc_code, $x,
                                $trx_no, $dataPost, $detPay);                        
                            }
                        }
                                          
                    }
                    *
                    END. JIKA ALLOC TIDAK DIDELETE DARI DATABASE
                    *
                    */
                }
                
            }
            
            Header('Content-Type: application/json; charset=UTF8');
            $status = $this->db->trans_status();
            if ($status === false) {
                $this->db->trans_rollback();
                echo json_encode(array('msg' => "Failed saving data"));
                exit();
            } else {
                $this->db->trans_commit();
                
                if($edit == 0){
                    $params['user_rowID'] = $this->tank_auth->get_user_id();
                    $params['module'] = 'Cash Bank Payment';
                    $params['module_field_id'] = $id_header;
                    $params['activity'] = ucfirst('Added a new cash bank payment no. ' . $trx_no);
                    $params['icon'] = 'fa-plus';
                    modules::run('activitylog/log', $params); //log activity
                }
                else{
                    $params['user_rowID'] = $this->tank_auth->get_user_id();
                    $params['module'] = 'Cash Bank Payment';
                    $params['module_field_id'] = $dataPost['rowID'];
                    $params['activity'] = ucfirst('Updated a cash bank payment no. ' . $trx_no);
                    $params['icon'] = 'fa-edit';
                    modules::run('activitylog/log', $params); //log activity
                }
                
                echo json_encode(array('success' => true, 'msg' => 'Cash Bank Payment Saved'));
                exit();
            }
        }
        else{
            echo json_encode(array('success' => false, 'msg' => "Data in other shift!"));
            exit();
        }

    }

    function simpan_cash_bank_payment_release(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $dataPost = $this->input->post();

        $this->db->trans_begin();
        
        $dept_rowID = $this->session->userdata('dep_rowID');
        $dept = $this->db->get_where('sa_dep', array('deleted' => 0, 'rowID' => $dept_rowID))->
            row_array();

        if ($dept['ho_trx'] == 'Y') {
            $sa_spec = $this->db->get_where('sa_spec', array('deleted' => 0, 'rowID' => 1))->
                row_array();
            if($dataPost['val_cb_payment_type'] == 'P')
                $sa_spec_prefix = $sa_spec['cash_out_prefix'];
            else
                $sa_spec_prefix = $sa_spec['cash_in_prefix'];
                
        } else {
            if($dataPost['val_cb_payment_type'] == 'P')
                $sa_spec_prefix = $dept['cash_out_prefix'];
            else
                $sa_spec_prefix = $dept['cash_in_prefix'];
        }    
        
        if (!empty($dataPost['detailgirorelease'])) {
            $i = 0;
            foreach ($dataPost['detailgirorelease'] as $detGiro) {
                if($detGiro['release_status'] != 0){
                    $i++;
                    // simpan header
                    $alloc_date = date('Y-m-d',strtotime($detGiro['cb_release_date']));
                    $alloc_date_year = date('Y',strtotime($alloc_date));
                    $alloc_date_month = date('m',strtotime($alloc_date));
                    
                     $alloc_code = ((int)$this->appmodel->select_max_id('cb_trx_hdr', $array = array
                                        (
                                        'prefix' => $sa_spec_prefix,
                                        'year' => $alloc_date_year,
                                        'month' => $alloc_date_month,
                                        'deleted' => 0), 'code')) + 1;                                
                    $trx_no = $sa_spec_prefix . sprintf("%04s", $alloc_date_year) . sprintf("%02s",
                        $alloc_date_month) . sprintf("%05s", $alloc_code);
                    
                    $result = $this->cash_bank_payment_model->simpan_header_release($sa_spec_prefix, $alloc_code,$trx_no,$dataPost,$detGiro);
                    if($result){
                        $result = $this->cash_bank_payment_model->simpanDetailGiroRelease($sa_spec_prefix, $alloc_code,$i,$trx_no,$dataPost,$detGiro);
                        if($result){
                            $this->cash_bank_payment_model->updateDetailGiro($detGiro,$trx_no);
                        }
                    }
                }
            }
        }
        
        Header('Content-Type: application/json; charset=UTF8');
        $status = $this->db->trans_status();
        if ($status === false) {
            $this->db->trans_rollback();
            echo json_encode(array('msg' => "Failed"));
            exit();
        } else {
            $this->db->trans_commit();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Cash Bank Payment';
            $params['module_field_id'] = $dataPost['val_cb_payment_id_release'];
            $params['activity'] = ucfirst('Released Cheque or Giro on Cash Bank Payment No ' . $dataPost['val_cb_payment_no_release']);
            $params['icon'] = 'fa-edit';
            modules::run('activitylog/log', $params); //log activity
            
            echo json_encode(array('success' => true, 'msg' => 'Cash Bank Payment Saved'));
            exit();
        }
        return $status;

    }
    
    function get_debtor(){
        error_reporting(E_ALL);
        $trx_type = $this->input->post('trx_type');
        $option = "";
        if($trx_type == 'cash_advance' || $trx_type == 'ar' || $trx_type == 'commission' || $trx_type == 'deposit' 
        || $trx_type == 'advance' || $trx_type == 'reimburse' || $trx_type == 'general'){
                        
            if($trx_type == 'cash_advance' || $trx_type == 'commission' || $trx_type == 'deposit' || $trx_type == 'advance' 
                || $trx_type == 'reimburse' || $trx_type == 'general'){
                
                $sql = "SELECT * FROM sa_debtor WHERE deleted = 0 AND type = 'D' OR type = 'E' ORDER BY type, debtor_cd";
                $des = $this->db->query($sql)->result();
            }
            else if($trx_type == "ar"){
                $sql = "SELECT * FROM sa_debtor WHERE deleted = 0 AND type = 'C' ORDER BY type, debtor_cd";
                $des = $this->db->query($sql)->result();
            }            
    
            if (count($des) > 0) {
                $option .= "<option value=''>".lang('select_your_option')."</option>";
                foreach ($des as $rs) {
                    if($rs->type == 'D')
                        $type = '(Driver)';
                    else if($rs->type == 'E')
                        $type = '(Employee)';
                    else
                        $type = '';
                        
                    $option .= "<option value='".$rs->rowID."'>".$rs->type.$rs->debtor_cd.' - '.$rs->debtor_name." ".$type."</option>";
                }
            }
            else{
                $option .= '<option value="">Debtor not available</option>';
            }
            
        }
        else if($trx_type == "ap"){
            $des = $this->cash_bank_payment_model->get_all_records($table = 'sa_creditor', $array =
                array('deleted' => 0), $join_table = '', $join_criteria = '', 'creditor_name', 'asc');

            if (count($des) > 0) {
                $option .= "<option value=''>".lang('select_your_option')."</option>";
                foreach ($des as $rs) {
                    $option .= "<option value='".$rs->rowID."'>".$rs->creditor_cd.' - '.$rs->creditor_name."</option>";
                }
            }
            else{
                $option .= '<option value="">Creditor not available</option>';
            }
        }
        
        echo $option;
        exit;
        
    }
    
    function get_data_advance_invoice(){
        error_reporting(E_ALL);
        $id = $this->input->post('id');
        $tipe = $this->input->post('tipe');
        $payment_type = $this->input->post('payment_type');
        
        if($tipe == 'cash_advance'){
            $get_data = $this->cash_bank_payment_model->get_all_advance_list_by_debtor_id($id);
        }
        else if($tipe == "invoice"){
            $get_data = $this->cash_bank_payment_model->get_all_invoice_list_by_debtor_id($id);
        }
        else if($tipe == "ap"){
            $get_data = $this->cash_bank_payment_model->get_all_ap_list_by_debtor_id($id);
        }
        else if($tipe == "deposit"){
            $get_data = $this->cash_bank_payment_model->get_all_deposit_list_by_debtor_id($id);
        }
        else if($tipe == 'commission'){
            $get_data = $this->cash_bank_payment_model->get_all_commission_list_by_debtor_id($id);
        }
        else if($tipe == 'advance'){
            $get_data = $this->cash_bank_payment_model->get_all_advance_by_debtor_id($id);
        }
        else if($tipe == 'reimburse'){
            $get_data = $this->cash_bank_payment_model->get_all_reimburse_list_by_debtor_id($id);
        }
        else{
            $get_data = array();
        }
        
        $data['get_data'] = $get_data;
        $data['tipe'] = $tipe;
        $data['payment_type'] = $payment_type;
        
        $this->load->view('data_advance_invoice',$data);
    }

    function get_data_advance_invoice_multiple(){
        error_reporting(E_ALL);
        $id = $this->input->post('id');
        $tipe = $this->input->post('tipe');
        $payment_type = $this->input->post('payment_type');
        
        if($tipe == 'cash_advance'){
            $get_data = $this->cash_bank_payment_model->get_all_advance_list_by_debtor_id($id);
        }
        else if($tipe == "invoice"){
            $get_data = $this->cash_bank_payment_model->get_all_invoice_list_by_debtor_id($id);
        }
        else if($tipe == "ap"){
            $get_data = $this->cash_bank_payment_model->get_all_ap_list_by_debtor_id($id);
        }
        else if($tipe == "deposit"){
            $get_data = $this->cash_bank_payment_model->get_all_deposit_list_by_debtor_id($id);
        }
        else if($tipe == 'commission'){
            $get_data = $this->cash_bank_payment_model->get_all_commission_list_by_debtor_id($id);
        }
        else if($tipe == 'advance'){
            $get_data = $this->cash_bank_payment_model->get_all_advance_by_debtor_id($id);
        }
        else if($tipe == 'reimburse'){
            $get_data = $this->cash_bank_payment_model->get_all_reimburse_list_by_debtor_id($id);
        }
        else{
            $get_data = array();
        }
        
        $data['get_data'] = $get_data;
        $data['tipe'] = $tipe;
        $data['payment_type'] = $payment_type;
        
        $this->load->view('data_advance_invoice_multiple',$data);
    }

    function get_data_cash_bank()
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $cb_prefix = $_GET['prefix'];
        $cb_year   = $_GET['year'];
        $cb_month  = $_GET['month'];
        $cb_code   = $_GET['code'];
        $hasil = $this->cash_bank_payment_model->get_by_id($cb_prefix,$cb_year,$cb_month,$cb_code);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }

    function delete_data()
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $cb_prefix = $_GET['prefix'];
        $cb_year   = $_GET['year'];
        $cb_month  = $_GET['month'];
        $cb_code   = $_GET['code'];
        
        $get_data = $this->cash_bank_payment_model->get_detail_by_reference($cb_prefix,$cb_year,$cb_month,$cb_code);
        
        $get_data_cb = $this->cash_bank_payment_model->get_data_by_id($cb_prefix,$cb_year,$cb_month,$cb_code);
        
        //$trx_no = $cb_prefix . sprintf("%04s", $cb_year) . sprintf("%02s",$cb_month) . sprintf("%05s", $cb_code);
        
        $trx_no = $get_data_cb->trx_no;
          
        $process = true;    
        if($this->session->userdata('page_detail') == 'cash_bank_payment_branch'){
            $shift = '';
            $data_shift = '-';
            $date_created_tmp = '';
			
            $get_data_header = $this->cash_bank_payment_model->get_data_header($trx_no);
            
            $date_created = date('Y-m-d H:i:s',strtotime($get_data_header->date_created.' '.$get_data_header->time_created));
            if(strtotime($date_created) >= strtotime(date('Y-m-d 08:00:00')) && strtotime($date_created) <= strtotime(date('Y-m-d 19:59:59'))){
                $data_shift = 'Shift 1';
            }
			else if(strtotime($date_created) <= strtotime(date('Y-m-d 07:59:59',strtotime($date_created.' +1 days')))){
                $data_shift = 'Shift 2';
            }
            $date_created_tmp = $date_created;
            
            $date_created = date('Y-m-d H:i:s');
			if(strtotime($date_created) >= strtotime(date('Y-m-d 08:00:00')) && strtotime($date_created) <= strtotime(date('Y-m-d 19:59:59'))){
                $shift = 'Shift 1';
            }
			else if(strtotime($date_created) <= strtotime(date('Y-m-d 07:59:59',strtotime($date_created_tmp.' +1 days')))){
                $shift = 'Shift 2';
            }                                  
            
            if($shift == $data_shift){
                $process = true;
            }
            else{
                $process = false;
            }
            
        }
        else{
            $process = true;            
        }
        
        if($process == true){
            // Update cb_trx_cg
            if($get_data_cb->trx_no != ''){
                $sql_update = "UPDATE cb_trx_cg SET status = 0, reference_release_no = '' WHERE reference_release_no = '".$get_data_cb->trx_no."'";
                $this->db->query($sql_update);
            }
            
            // Update Cash Advance
            foreach($get_data as $row){
                $ca_no = $row->advance_invoice_no;
                if($row->trx_amt > 0)
                    $cb_trx_amt = $row->trx_amt;
                else
                    $cb_trx_amt = $row->trx_amt * -1;
                
                if($row->advance_invoice_type == 'refund'){
                    $sql = "UPDATE cb_cash_adv SET advance_allocation = advance_allocation-".$cb_trx_amt.", advance_balance = advance_balance+".$cb_trx_amt."
                            WHERE advance_no = '".$ca_no."' AND deleted = 0";                
                }
                else{
                    $sql = "UPDATE cb_cash_adv SET pay_over_allocation = pay_over_allocation-".$cb_trx_amt.", advance_balance = advance_balance+".$row->trx_amt."
                            WHERE advance_no = '".$ca_no."' AND deleted = 0";
                }
                $this->db->query($sql);
            }        
            
            $data = $this->cash_bank_payment_model->delete_data_header($cb_prefix,$cb_year,$cb_month,$cb_code);
            $data = $this->cash_bank_payment_model->delete_data_detail_giro($cb_prefix,$cb_year,$cb_month,$cb_code);
            $data = $this->cash_bank_payment_model->delete_data_detail_Pay($cb_prefix,$cb_year,$cb_month,$cb_code);
            $data = $this->cash_bank_payment_model->delete_data_realization($cb_prefix,$cb_year,$cb_month,$cb_code);
              
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Cash Bank Payment';
            $params['module_field_id'] = $cb_code;
            $params['activity'] = ucfirst('Deleted a Cash Bank Payment No. ' . $trx_no);
            $params['icon'] = 'fa-times';
            modules::run('activitylog/log', $params);
            
            header('Content-Type: application/json');
            echo json_encode(array('success' => true, 'msg' => 'Delete successfully'));
            exit();
        }
        else{
            echo json_encode(array('success' => false, 'msg' => "Data in other shift!"));
            exit();
        }
    }

    function showDetailGiro(){
        error_reporting(E_ALL);
         header('Content-Type: application/json');
        $cb_prefix = $_GET['prefix'];
        $cb_year   = $_GET['year'];
        $cb_month  = $_GET['month'];
        $cb_code   = $_GET['code'];
        
        $detGiroData = $this->db->get_where('cb_trx_cg', array('cb_trx_hdr_prefix' =>
                $cb_prefix, 'cb_trx_hdr_year' => $cb_year,'cb_trx_hdr_month' =>$cb_month,'cb_trx_hdr_code'  =>$cb_code,'deleted'  => 0));
                
        $arr = array();
        if (!empty($detGiroData)) {
            header('Content-Type: application/json');
            foreach ($detGiroData->result() as $rs) {

                $arr[] = array(
                    'payment_method' => $rs->payment_method,
                    'cash_bank' => $rs->cash_bank,
                    'cg_no' => $rs->cg_no,
                    'cg_date' => date("d-m-Y",strtotime($rs->cg_date)),
                    'cg_amt' => $rs->cg_amt);
            }
            header('Content-Type: application/json');
            echo json_encode($arr);
        }
        exit();
    }
    
    function showDetailGiroRelease(){
        error_reporting(E_ALL);
         header('Content-Type: application/json');
        $cb_prefix = $_GET['prefix'];
        $cb_year   = $_GET['year'];
        $cb_month  = $_GET['month'];
        $cb_code   = $_GET['code'];
        
        $sql = "SELECT a.*, b.acc_name FROM cb_trx_cg as a LEFT JOIN gl_coa as b ON a.cash_bank = b.rowID
                WHERE a.cb_trx_hdr_prefix = '$cb_prefix' AND a.cb_trx_hdr_year = '$cb_year' AND a.cb_trx_hdr_month = '$cb_month' AND a.cb_trx_hdr_code='$cb_code' 
                        AND a.deleted = 0 AND (a.payment_method = 'cheque' OR a.payment_method = 'giro') AND a.status <> 1
                ORDER BY a.rowID";
        
        $detGiroData = $this->db->query($sql);
        
        $arr = array();
        if (!empty($detGiroData)) {
            header('Content-Type: application/json');
            foreach ($detGiroData->result() as $rs) {

                $arr[] = array(
                    'rowID' => $rs->rowID,
                    'payment_method' => ucwords($rs->payment_method),
                    'acc_name' => $rs->acc_name,
                    'cg_no' => $rs->cg_no,
                    'cg_date' => date("d-m-Y",strtotime($rs->cg_date)),
                    'cg_amt' => $rs->cg_amt,
                    'status' => $rs->status,
                    );
            }
            header('Content-Type: application/json');
            echo json_encode($arr);
        }
        exit();
    }

    function showDetailPayment()
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $cb_prefix = $_GET['prefix'];
        $cb_year   = $_GET['year'];
        $cb_month  = $_GET['month'];
        $cb_code   = $_GET['code'];

        $detPayData = $this->db->get_where('cb_trx_dtl', array('cb_trx_hdr_prefix' =>
                $cb_prefix, 'cb_trx_hdr_year' => $cb_year,'cb_trx_hdr_month' =>$cb_month,'cb_trx_hdr_code'  =>$cb_code,'deleted'  => 0));
        //$detPayData = $this->db->query("select a.* from cb_trx_dtl as a
        // where a.cb_trx_hdr_prefix ='$cb_prefix' and a.cb_trx_hdr_year='$cb_year' and a.cb_trx_hdr_month='$cb_month' and a.cb_trx_hdr_code='$cb_code'  and deleted = 0 ");

        $arr = array();
        if (!empty($detPayData)) {
            header('Content-Type: application/json');
            foreach ($detPayData->result() as $rs) {

                $arr[] = array(
                    'row_no' => $rs->row_no,
                    'advance_invoice_no' => $rs->advance_invoice_no,
                    'advance_invoice_type' => $rs->advance_invoice_type,
                    'advance_invoice_amount' => $rs->advance_invoice_amount,
                    'descs' => $rs->descs,
                    'trx_amt' => $rs->trx_amt);
            }
            header('Content-Type: application/json');
            echo json_encode($arr);
        }
        exit();
    }

    function insertHistoriesHeader($dataPost)
    {
        $data = $this->db->get_where('sa_fare_trip_hdr', array('rowID' => $dataPost['rowID']));
        $items = array();
        foreach ($data->result_array() as $row) {
            array_push($items, $row);
        }
        $dataHistorisHeader = json_encode($items);
        $this->fare_trip_model->save_header_histories($dataHistorisHeader);
    }

    function insertHistoriesDetail($dataPost)
    {
        $data = $this->db->get_where('sa_fare_trip_dtl', array('fare_trip_hdr_rowID' =>
                $dataPost['rowID']));

        $items = array();
        foreach ($data->result_array() as $row) {
            array_push($items, $row);
        }

        $dataHistorisDetail = json_encode($items);
        $this->fare_trip_model->save_detail_histories($dataHistorisDetail);

    }

    function fetch_data() { 
        if ($this->input->is_ajax_request()) {
            $dt = $_POST;

            if($this->session->userdata('start_date_cb') == '' ){
                $start_date = date("Y-m-d", strtotime('-6 day'));
            }else{
                $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_cb')));
            }

            if($this->session->userdata('end_date_cb') == ''){
                $end_date = date("Y-m-d");
            }else{
                $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_cb')));
            }
            $str_between = " AND cb_trx_hdr.trx_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";

            $dt['table'] = 'cb_trx_hdr';
            $dt['id'] = 'rowID';
            $aColumnTable = array(
                'cb_trx_hdr.rowID', 'cb_trx_hdr.trx_no', 'cb_trx_hdr.trx_date', 'cb_trx_hdr.payment_type', 'cb_trx_hdr.coa_rowID', 'cb_trx_hdr.advance_invoice_trx_no', 'cb_trx_hdr.descs', 'cb_trx_hdr.debtor_creditor_type', 'cb_trx_hdr.trx_amt', 'cb_trx_hdr.time_created', 'sa_debtor.debtor_name', 'sa_creditor.creditor_name', 'cb_trx_hdr.debtor_creditor_type', 'cb_trx_hdr.prefix', 'cb_trx_hdr.year', 'cb_trx_hdr.month', 'cb_trx_hdr.code', 'cb_trx_hdr.transaction_type', 'cb_trx_hdr.manual_debtor_creditor_type', 'cb_trx_hdr.manual_debtor_creditor', 'cash_bank.acc_cd' , 'cash_bank.acc_name'
            );

            $aColumns = array(
              'cb_trx_hdr.rowID', 'cb_trx_hdr.trx_no', 'cb_trx_hdr.trx_date', 'cb_trx_hdr.payment_type', 'cb_trx_hdr.coa_rowID', 'cb_trx_hdr.advance_invoice_trx_no', 'cb_trx_hdr.descs', 'cb_trx_hdr.debtor_creditor_type', 'cb_trx_hdr.trx_amt', 'cb_trx_hdr.time_created', 'sa_debtor.debtor_name', 'sa_creditor.creditor_name', 'cb_trx_hdr.debtor_creditor_type', 'cb_trx_hdr.prefix', 'cb_trx_hdr.year', 'cb_trx_hdr.month', 'cb_trx_hdr.code', 'cb_trx_hdr.transaction_type', 'cb_trx_hdr.manual_debtor_creditor_type', 'cb_trx_hdr.manual_debtor_creditor', 'cash_bank.acc_cd' , 'cash_bank.acc_name'
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
                $sOrder .= "cb_trx_hdr.rowID DESC";
            }

            /* Individual column filtering */
            $sSearchReg = $dt['search']['regex'];
            for ($i = 0; $i < count($aColumns); $i++) {
                if(isset($dt['columns'][$i]['searchable'])){
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
            }

            if (!empty($dt['columns'][10]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $start_date = date('Y-m-d', strtotime($dt['columns'][10]['search']['value']));
                $this->session->set_userdata('start_date_cb',date("Y-m-d",strtotime($start_date)));

                if($this->session->userdata('end_date_cb') == ''){
                    $end_date = date("Y-m-d");
                }else{
                    $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_cb')));
                }
                $str_between = " AND cb_trx_hdr.trx_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";

                $sWhere.= ' cb_trx_hdr.deleted = 0 ' . $str_between; 
            }

            if (!empty($dt['columns'][11]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $end_date = date('Y-m-d', strtotime($dt['columns'][11]['search']['value']));
                $this->session->set_userdata('end_date_cb', date("Y-m-d",strtotime($end_date)));

                if($this->session->userdata('start_date_cb') == ''){
                    $start_date = date("Y-m-d", strtotime('-6 day'));
                }else{
                    $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_cb')));
                }
                $str_between = " AND cb_trx_hdr.trx_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";

                $sWhere.= ' cb_trx_hdr.deleted = 0 ' . $str_between;
            }

            /** Filtering * */
            $sWhere = "";
            $sSearchVal = $dt['search']['value'];
            if (isset($sSearchVal) && $sSearchVal != '') {
                $sWhere = " WHERE (";
                for ($i = 0; $i < count($aColumns); $i++) {
                    $sWhere .= $aColumns[$i] . " LIKE '%" . $this->db->escape_like_str($sSearchVal) . "%' OR ";
                }

                $mystring = 'Payment, payment';
                $pos = strpos($mystring, $sSearchVal);
                if ($pos !== false) {
                    $sWhere .= $aColumns[3] . " LIKE '%" . $this->db->escape_like_str('P') . "%' OR ";
                }

                $mystring_2 = 'Receive, receive';
                $pos_2 = strpos($mystring_2, $sSearchVal);
                if ($pos_2 !== false) {
                    $sWhere .= $aColumns[3] . " LIKE '%" . $this->db->escape_like_str('R') . "%' OR ";
                }
                
                $sWhere = substr_replace($sWhere, "", -3);
                $sWhere .= ') AND cb_trx_hdr.deleted = 0 ' . $str_between;
            }

            /** Total Data Set Length * */
            $sQuery = "SELECT * FROM " . $dt['table'] . " LEFT JOIN gl_coa as cash_bank ON cash_bank.rowID = cb_trx_hdr.coa_rowID LEFT JOIN gl_coa as pay_to_cd ON pay_to_cd.rowID = cb_trx_hdr.fund_trf_coa_rowID LEFT JOIN sa_debtor ON sa_debtor.rowID = cb_trx_hdr.debtor_creditor_rowID LEFT JOIN sa_creditor ON sa_creditor.rowID = cb_trx_hdr.debtor_creditor_rowID WHERE cb_trx_hdr.deleted = 0 " . $str_between;
            $rResultTotal = $this->db->query($sQuery);
            $aResultTotal = $rResultTotal->num_rows();
            $iTotal = $aResultTotal;
            
            /* Get Data To Display */
            if ($sWhere != "") {
                $where = $sWhere;
            } else {
                $where = " WHERE cb_trx_hdr.deleted = 0 " . $str_between;
            }

            $join_table = " LEFT JOIN gl_coa as cash_bank ON cash_bank.rowID = cb_trx_hdr.coa_rowID LEFT JOIN gl_coa as pay_to_cd ON pay_to_cd.rowID = cb_trx_hdr.fund_trf_coa_rowID LEFT JOIN sa_debtor ON sa_debtor.rowID = cb_trx_hdr.debtor_creditor_rowID LEFT JOIN sa_creditor ON sa_creditor.rowID = cb_trx_hdr.debtor_creditor_rowID ";

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

                    $get_data = $this->cash_bank_payment_model->get_data_not_release($aRow['trx_no']);
                    $get_data_released = $this->cash_bank_payment_model->get_data_released($aRow['trx_no']);
                    $get_data_cheque = $this->cash_bank_payment_model->get_data_cheque($aRow['trx_no']);
                    $get_data_release = $this->cash_bank_payment_model->get_data_release_reference($aRow['trx_no']);

                    $dropdown_option = "";
                    $dropdown_option .= '<div class="btn-group">';
                    $dropdown_option .= '<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">';
                    $dropdown_option .= lang('options');
                    $dropdown_option .= '<span class="caret"></span>';
                    $dropdown_option .= '</button>';
                    $dropdown_option .= '<ul class="dropdown-menu">';
                    if($this->get_user_access('Updated') == 1){
                        if(count($get_data_released) == 0){
                            if($aRow['transaction_type'] != 'uang_makan' && $aRow['transaction_type'] != 'stand_by'){
                               $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('update_option') .'" onclick="edit_cash_bank_payment(\'' . $aRow['prefix'] . '\',\'' . $aRow['year'] . '\',\'' .$aRow['month'] . '\',\'' . $aRow['code'] . '\')"><i class="fa fa-pencil"></i> ' . lang('update_option') . '</a></li>';
                            }
                        }
                            
                        if(count($get_data) > 0){
                            $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('release_cheque_giro') .'" onclick="release_cash_bank_payment(\'' . $aRow['prefix'] . '\',\'' . $aRow['year'] . '\',\'' .$aRow['month'] . '\',\'' . $aRow['code'] . '\')"><i class="fa fa-check"></i> ' . lang('release_cheque_giro') . '</a></li>';
                        }
                    }
                        
                    if($this->get_user_access('PrintLimited') == 1 || $this->get_user_access('PrintUnlimited') == 1 || 
                        $this->get_user_access('PrintOne') == 1 || $this->get_user_access('PrintTwo') == 1){
                        if($this->get_user_access('PrintLimited') == 1){
                            if($this->get_log_limited_printed($aRow['trx_no'],'Cash Bank Payment') == 0){
                                if(count($get_data_release) > 0){
                                    $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('print_option') . ' Release" onclick="print_release_bank_payment(\'' . $aRow['prefix'] . '\',\'' . $aRow['year'] . '\',\'' .$aRow['month'] . '\',\'' . $aRow['code'] . '\')"><i class="fa fa-print"></i> ' . lang('print_option') . ' Release</a></li>';
                                }else{
                                    $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('print_option') . '" onclick="print_cash_bank_payment(\'' . $aRow['prefix'] . '\',\'' . $aRow['year'] . '\',\'' .$aRow['month'] . '\',\'' . $aRow['code'] . '\')"><i class="fa fa-print"></i> ' . lang('print_option') . '</a></li>';                                    
                                }
                            }
                        }else{
                            if(count($get_data_release) > 0){
                                $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('print_option') . ' Release" onclick="print_release_bank_payment(\'' . $aRow['prefix'] . '\',\'' . $aRow['year'] . '\',\'' .$aRow['month'] . '\',\'' . $aRow['code'] . '\')"><i class="fa fa-print"></i> ' . lang('print_option') . ' Release</a></li>';
                            }else{
                                 $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('print_option') . '" onclick="print_cash_bank_payment(\'' . $aRow['prefix'] . '\',\'' . $aRow['year'] . '\',\'' .$aRow['month'] . '\',\'' . $aRow['code'] . '\')"><i class="fa fa-print"></i> ' . lang('print_option') . '</a></li>';
                            }
                        }
                    }
                        
                    if($this->get_user_access('Deleted') == 1){
                        $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('delete_option') . '" onclick="delete_cash_bank_payment(\'' . $aRow['prefix'] . '\',\'' . $aRow['year'] . '\',\'' .$aRow['month'] . '\',\'' . $aRow['code'] . '\')"><i class="fa fa-trash-o"></i> ' . lang('delete_option') . '</a></li>';
                    }
                    $dropdown_option .= '</ul></div>';
              
                    if(count($get_data) > 0){
                        $star = "<span style='color: #c00'>*</span>";
                    }else{
                        $star = "";
                    }

                    if($aRow['payment_type'] == 'P'){
                        $payment_type = 'Payment';
                    }elseif($aRow['payment_type'] == 'R'){
                        $payment_type = 'Receive';
                    }else{
                        $payment_type = '-';
                    }

                    $data_cheque = '';
                    if(count($get_data_cheque) > 0){
                        $i_cheque = 1;
                        foreach($get_data_cheque as $row_cheque){
                            $data_cheque .= $i_cheque . '. ' . strtoupper($row_cheque->cg_no) . '<br>';
                            $i_cheque++;
                        }
                    }else{
                        $data_cheque = '-';
                    }

                    $nama_pay_to = '-';
                    if($aRow['debtor_creditor_type'] == 'D'){
                        $nama_pay_to = $aRow['debtor_name'] == '' ? '-' : $aRow['debtor_name'];
                    }else if($aRow['debtor_creditor_type'] == 'C'){
                        $nama_pay_to = $aRow['creditor_name'] == '' ? '-' : $aRow['creditor_name'];                            
                    }else if($aRow['debtor_creditor_type'] == 'G'){
                        if($aRow['manual_debtor_creditor_type'] == 'D' || $aRow['manual_debtor_creditor_type'] == 'E'){ 
                            $nama_pay_to = $aRow['debtor_name'] == '' ? '-' : ucwords(strtolower($aRow['debtor_name']));
                        } else{
                            $nama_pay_to = $aRow['manual_debtor_creditor'];                            
                        }
                    }

                    $row['dropdown_option'] = $dropdown_option;
                    $row['trx_no'] = $aRow['trx_no'] . $star;
                    $row['trx_date'] = date("d-m-Y H:i:s",strtotime($aRow['trx_date'] .' '. $aRow['time_created']));
                    $row['payment_type'] = $payment_type;
                    $cash_bank = $aRow['acc_cd'] . $aRow['acc_name'];
                    $row['cash_bank'] = ($cash_bank == '') ? '-' : $aRow['acc_cd'] . ' - ' . $aRow['acc_name'];
                    $row['advance_invoice_trx_no'] = ($aRow['advance_invoice_trx_no'] == '' ) ? '-' : $aRow['advance_invoice_trx_no'];
                    $row['data_cheque'] = $data_cheque;
                    $row['descs'] = ($aRow['descs'] == '') ? '-' : $aRow['descs'];
                    $row['nama_pay_to'] = $nama_pay_to;
                    $row['trx_amt'] = number_format($aRow['trx_amt'],2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));
                    
                    // For filter
                    $row['start_date'] = date("d-m-Y",strtotime($aRow['trx_date']));
                    $row['end_date'] = date("d-m-Y",strtotime($aRow['trx_date']));
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
        $this->db->where('Link_Menu', 'cash_bank_payment');
        $query_menu = $this->db->get('sa_menu');        
        if(count($query_menu) > 0){
            $get_menu = $query_menu->row();
            $menu_id = $get_menu->Seq_Menu;
        }
        else{
            $menu_id = 0;
        }
        
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
