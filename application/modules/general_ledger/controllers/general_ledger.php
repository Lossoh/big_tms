<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class general_ledger extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('tank_auth');
        
        $this->load->model('general_ledger_model');
        $this->load->model('appmodel');
        $this->load->library('pdf_generator');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('general_ledger') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('general_ledger');
        $this->session->set_userdata('page_header', 'transaction');
        $this->session->set_userdata('page_detail', 'general_ledger');
        $data['datatables'] = true;
        $data['form'] = true;
                
        if($this->session->userdata('start_date_gl') == '' ){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_gl')));
        }

        if($this->session->userdata('end_date_gl') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_gl')));
        }

        // if($this->session->userdata('start_date_gl') == '' && $this->session->userdata('end_date_gl') == ''){
        //     $start_date = date("Y-m-d",strtotime("yesterday"));
        //     $end_date = date("Y-m-d");
        // }
        // else{
        //     $start_date = $this->session->userdata('start_date_gl');
        //     $end_date = $this->session->userdata('end_date_gl');
        // }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
          
        // $data['general_ledgers'] = $this->general_ledger_model->get_all_record_data($start_date,$end_date);
        $data['coas'] = $this->general_ledger_model->get_account();
        $data['debtors'] = $this->general_ledger_model->get_debtors();
        $data['creditors'] = $this->general_ledger_model->get_creditors();
        $data['creditor_types'] = $this->general_ledger_model->get_all_records($table =
            'sa_creditor_type', $array = array('rowID >' => '0', 'deleted' => '0'), $join_table =
            '', $join_criteria = '', 'type_cd', 'asc');
        $data['cash_advance_jo'] =$this->general_ledger_model->get_data_cash_advance_jo();
        
        $this->template->set_layout('users')->build('general_ledger', isset($data) ?
            $data : null);
    }
    
    function set_filter(){
       $this->session->set_userdata('start_date_gl',date("Y-m-d",strtotime($this->input->post('start_date'))));
       $this->session->set_userdata('end_date_gl',date("Y-m-d",strtotime($this->input->post('end_date'))));    
       
       redirect(base_url().'general_ledger');
    }
    
    function get_data_header()
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $journal_no = $this->input->post('journal_no');
        
        $get_data = $this->general_ledger_model->get_data_header_by_trx_no($journal_no);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($get_data);
        exit;
    }
    
    function get_data_detail(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $journal_no = $this->input->post('journal_no');
        
        $get_data = $this->general_ledger_model->get_data_detail_by_trx_no($journal_no);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($get_data);
        exit;
    }
    
    function get_data_detail_advance(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $trx_no = $this->input->post('trx_no');
        
        $get_data = $this->general_ledger_model->get_data_advance_by_trx_no($trx_no);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($get_data);
        exit;
    }

    function get_data_detail_cg(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $trx_no = $this->input->post('trx_no');
        
        $get_data = $this->general_ledger_model->get_data_cash_bank_by_trx_no($trx_no);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($get_data);
        exit;
    }
    
    function get_data_detail_cb_detail(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $trx_no = $this->input->post('trx_no');
        
        $get_data = $this->general_ledger_model->get_data_cash_bank_detail_by_trx_no($trx_no);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($get_data);
        exit;
    }
    
    function get_data_detail_journal(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $gl_type = $this->input->post('gl_type');
        $reference_no = $this->input->post('reference_no');
        
        $get_data = $this->general_ledger_model->get_data_header_by_type_ref_no($gl_type,$reference_no);
        $get_data_detail = array();
        $journal_no = '';
        
        if(count($get_data) > 0){
            $journal_no = $get_data->journal_no;
            $get_data_detail = $this->general_ledger_model->get_data_detail_by_trx_no($journal_no);
        }
        
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode(array('count_detail' => count($get_data_detail), 'journal_no' => $journal_no));
        exit;
    }
    
    
    function get_data_reference(){
        error_reporting(E_ALL);
        $gl_type = $this->input->post('gl_type');
        
        if($gl_type == 'cash advance'){
            $get_data = $this->general_ledger_model->get_all_cash_advance_list();
        }
        else if($gl_type == 'realization'){
            $get_data = $this->general_ledger_model->get_all_realization_list();
        }
        else if($gl_type == 'refund'){
            $get_data = $this->general_ledger_model->get_all_refund_list();
        }
        else if($gl_type == "invoice"){
            $get_data = $this->general_ledger_model->get_all_invoice_list();
        }
        else if($gl_type == "account receivable"){
            $get_data = $this->general_ledger_model->get_all_ar_list();
        }
        else if($gl_type == "account payable"){
            $get_data = $this->general_ledger_model->get_all_ap_list();
        }
        else if($gl_type == "kontra bon"){
            $get_data = $this->general_ledger_model->get_all_kb_list();
        }
        else if($gl_type == 'advance'){
            $get_data = $this->general_ledger_model->get_all_advance_list();
        }
        else if($gl_type == 'reimburse'){
            $get_data = $this->general_ledger_model->get_all_reimburse_list();
        }
        else if($gl_type == "deposit"){
            $get_data = $this->general_ledger_model->get_all_deposit_list();
        }
        else if($gl_type == 'commission'){
            $get_data = $this->general_ledger_model->get_all_commission_list();
        }
        else if($gl_type == 'cash in'){
            $get_data = $this->general_ledger_model->get_all_cash_in_list();
        }
        else if($gl_type == 'cash out'){
            $get_data = $this->general_ledger_model->get_all_cash_out_list();
        }
        else if($gl_type == 'bank in'){
            $get_data = $this->general_ledger_model->get_all_bank_in_list();
        }
        else if($gl_type == 'bank out'){
            $get_data = $this->general_ledger_model->get_all_bank_out_list();
        }
        else if($gl_type == 'outstanding bank in'){
            $get_data = $this->general_ledger_model->get_all_outstanding_bank_in_list();
        }
        else if($gl_type == 'outstanding bank out'){
            $get_data = $this->general_ledger_model->get_all_outstanding_bank_out_list();
        }
        else{
            $get_data = array();
        }
        
        $data['get_data'] = $get_data;
        $data['gl_type'] = $gl_type;
        
        $this->load->view('reference_data',$data);
    }
    
    function verify_password()
    {

        $this->load->model('tank_auth/users');
        $user_id = $this->session->userdata('user_id');

        if (!is_null($user = $this->users->get_user_by_id($user_id, true)))
        {
            $verified_status = $this->input->post('verified_status_second');

            // Cek usermenu by user
            $get_user = $this->general_ledger_model->get_verify_user_by_status($verified_status);
            $status_password = false;
            
            foreach($get_user as $row_user){
                // Check if password correct
                $password = $this->input->post('password');
                $hasher = new PasswordHash($this->config->item('phpass_hash_strength',
                    'tank_auth'), $this->config->item('phpass_hash_portable', 'tank_auth'));
                if ($hasher->CheckPassword($password, $row_user->password))
                { // success                    
                    $status_password = true;
                    break;
                } else
                { // fail
                    $status_password = false;
                }
            }
            
            if($status_password){
                echo json_encode(array('success' => true, 'msg' => lang('your_password_correct')));
                exit();
            }
            else{
                echo json_encode(array('success' => false, 'msg' => lang('your_password_incorrect')));
                exit();
            }
            
        } else
        {
            echo json_encode(array('success' => false, 'msg' => "Failed"));
            exit();
        }
    }
    
    function save_general_ledger(){
        $dataPost = $this->input->post();
        //echo "<pre>";print_r($dataPost);echo "</pre>";exit();
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $error = false;
        $this->db->trans_begin();
        
        if(empty($dataPost['rowID']) && empty($dataPost['journal_no'])){
            /*
            if(date('Y-m-d',strtotime($dataPost['gl_date'])) != date('Y-m-d')){
                $alloc_date = date('Y-m-d');
            }
            else{
                $alloc_date = date('Y-m-d',strtotime($dataPost['gl_date']));
            }
            */
            
            $alloc_date = date('Y-m-d',strtotime($dataPost['gl_date']));
            
            $alloc_date_year = date('Y',strtotime($alloc_date));
            $alloc_date_month = date('m',strtotime($alloc_date));

            $sa_spec = $this->db->get_where('sa_spec', array('deleted' => 0, 'rowID' => 1))->
                row_array();
            $sa_spec_prefix = $sa_spec['general_jrn'];
                        
            $new_gl_coa_code = ((int)$this->appmodel->select_max_id('gl_trx_hdr', $array =
                array(
                'prefix' => $sa_spec_prefix,
                'year' => $alloc_date_year,
                'month' => $alloc_date_month,
                'deleted' => 0), 'code')) + 1;
            $gl_coa_no = $sa_spec_prefix . sprintf("%04s", $alloc_date_year) . sprintf("%02s",
                $alloc_date_month) . sprintf("%05s", $new_gl_coa_code);
                
            $reference_debtor_creditor_id = $dataPost['reference_debtor_creditor_id'];
            $reference_no = $dataPost['reference_no'];
            $reference_date = $dataPost['reference_date'];
            
            $data_debit = array();
            $data_credit = array();
                    
            if ($error == false)
            {
                // simpan data header GL Doc
                $result = $this->general_ledger_model->save_gl_header($sa_spec_prefix, $new_gl_coa_code, $gl_coa_no, $reference_no, $reference_date, $dataPost);
                            
                if ($result){
                    $countDetail = count($dataPost['cash_bank']);
                    
                    $gl_date = date('Y-m-d',strtotime($dataPost['gl_date']));
                    $year = date('Y',strtotime($gl_date));
                    $month = date('m',strtotime($gl_date));
                    
                    for($i=0;$i<$countDetail;$i++){
                        if($dataPost['amount_debit'][$i] != 0){
                            
                            $trx_amt_tmp = str_replace('.','',$dataPost['amount_debit'][$i]);
                            $amount = str_replace(',','.',$trx_amt_tmp);
                            
                            $data_debit[] = array(
                                'gl_trx_hdr_prefix' => $sa_spec_prefix,
                                'gl_trx_hdr_year' => $year,
                                'gl_trx_hdr_month' => $month,
                                'gl_trx_hdr_code' => $new_gl_coa_code,
                                'row_no' => 1,
                                'gl_trx_hdr_journal_no' => $gl_coa_no,
                                'gl_trx_hdr_journal_date' => $gl_date,
                                'coa_rowID' => $dataPost['cash_bank'][$i],
                                'descs' => $dataPost['descs'][$i],
                                'trx_amt' => $amount,
                                'dep_rowID' => $this->session->userdata('dep_rowID'),
                                'debtor_creditor_type' => $dataPost['debtor_creditor_type'][$i],
                                'debtor_creditor_rowID' => $dataPost['debtor_creditor_rowID'][$i],
                                'gl_trx_hdr_ref_no' => $reference_no,
                                'gl_trx_hdr_ref_date' => $reference_date,
                                'modul' => 'CB',
                                'cash_flow' => 'Y',
                                'base_amt' => 0,
                                'tax_no' => '',
                                'user_created' => $this->session->userdata('user_rowID'),
                                'date_created' => $gl_date,
                                'time_created' => date('H:i:s')
                            );
                                            
                        }
                        else if($dataPost['amount_credit'][$i] != 0){
                            
                            $trx_amt_tmp = str_replace('.','',$dataPost['amount_credit'][$i]);
                            $amount = str_replace(',','.',$trx_amt_tmp);
                            
                            $data_credit[] = array(
                                'gl_trx_hdr_prefix' => $sa_spec_prefix,
                                'gl_trx_hdr_year' => $year,
                                'gl_trx_hdr_month' => $month,
                                'gl_trx_hdr_code' => $new_gl_coa_code,
                                'row_no' => 2,
                                'gl_trx_hdr_journal_no' => $gl_coa_no,
                                'gl_trx_hdr_journal_date' => $gl_date,
                                'coa_rowID' => $dataPost['cash_bank'][$i],
                                'descs' => $dataPost['descs'][$i],
                                'trx_amt' => $amount * -1,
                                'dep_rowID' => $this->session->userdata('dep_rowID'),
                                'debtor_creditor_type' => $dataPost['debtor_creditor_type'][$i],
                                'debtor_creditor_rowID' => $dataPost['debtor_creditor_rowID'][$i],
                                'gl_trx_hdr_ref_no' => $reference_no,
                                'gl_trx_hdr_ref_date' => $reference_date,
                                'modul' => 'CB',
                                'cash_flow' => 'Y',
                                'base_amt' => 0,
                                'tax_no' => '',
                                'user_created' => $this->session->userdata('user_rowID'),
                                'date_created' => $gl_date,
                                'time_created' => date('H:i:s')
                            );
                                            
                        }
                        
                    }
                    
                } 
                else{
                    $error = true;
                }
            } else
            {
                $error = true;
            }
            
            $result = $this->db->insert_batch('gl_trx_dtl', $data_debit);
            if (!$result){
                $error = true;
            } 
            else{
                $error = false;
            } 
            
            $result = $this->db->insert_batch('gl_trx_dtl', $data_credit);                
            if (!$result){
                $error = true;
            } 
            else{
                $error = false;
            } 
            
            if ($result){
                if (!empty($dataPost['detailDO']))
                {
                    $get_data_header_kb = $this->general_ledger_model->get_data_header_kb($reference_no);
                    //$this->general_ledger_model->delete_ap_trx_dtl_do($reference_no); 
            
                    foreach ($dataPost['detailDO'] as $detDO)
                    {
                        $result = $this->general_ledger_model->simpan_data_detail_do($get_data_header_kb->prefix, $get_data_header_kb->code, $get_data_header_kb->trx_no,
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
            
            Header('Content-Type: application/json; charset=UTF8');
            $status = $this->db->trans_status();
            if ($status === false || $error == true)
            {
                $this->db->trans_rollback();
                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'ERROR ROLLBACK General Ledger';
                $params['module_field_id'] = $new_gl_coa_code;
                $params['activity'] = ucfirst('Deleted a General Ledger ' . $gl_coa_no);
                $params['icon'] = 'fa-exclamation-triangle';
                modules::run('activitylog/log', $params);
                echo json_encode(array('success' => false, 'msg' => " Failed"));
                exit();
            } else
            {
                $this->db->trans_commit();
                
                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'General Ledger';
                $params['module_field_id'] = $new_gl_coa_code;
                $params['activity'] = ucfirst('Added a new General Ledger No ' . $gl_coa_no);
                $params['icon'] = 'fa-plus';
                modules::run('activitylog/log', $params); //log activity
    
                $info = lang('general_ledger_registered_successfully');
                echo json_encode(array('success' => true, 'msg' => $info));
                exit();
            }
        }
        else{
            $data_debit = array();
            $data_credit = array();
                  
            $alloc_date = date('Y-m-d',strtotime($dataPost['gl_date']));
            $alloc_date_year = date('Y',strtotime($alloc_date));
            $alloc_date_month = date('m',strtotime($alloc_date));
            
            $gl_coa_no  = $dataPost['journal_no'];

            $get_data_header = $this->general_ledger_model->get_data_header_by_trx_no($gl_coa_no);
            $sa_spec_prefix = $get_data_header->prefix;
            $new_gl_coa_code = $get_data_header->code;
            
            $reference_debtor_creditor_id = $dataPost['reference_debtor_creditor_id'];
            $reference_no = $dataPost['reference_no'];
            $reference_date = $dataPost['reference_date'];
            
            if ($error == false)
            {
                $result = $this->general_ledger_model->delete_data_header($gl_coa_no);
                if($result){
                    $result = $this->general_ledger_model->delete_data_detail($gl_coa_no);
                    if($result){
                        $result = $this->general_ledger_model->delete_ap_trx_dtl_do($get_data_header->ref_no); 
                        if(!$result){
                            $error = true;
                        }  
                    }
                }
                else{
                    $error = true;
                }
            } 
                   
            if ($error == false)
            {
                // simpan data header GL Doc
                $result = $this->general_ledger_model->save_gl_header($sa_spec_prefix, $new_gl_coa_code, $gl_coa_no, $reference_no, $reference_date, $dataPost);
                          
                if ($result){
                    $countDetail = count($dataPost['cash_bank']);
                    
                    $gl_date = date('Y-m-d',strtotime($dataPost['gl_date']));
                    $year = date('Y',strtotime($gl_date));
                    $month = date('m',strtotime($gl_date));
                    
                    for($i=0;$i<$countDetail;$i++){
                        if($dataPost['amount_debit'][$i] != 0){
                            $trx_amt_tmp = str_replace('.','',$dataPost['amount_debit'][$i]);
                            $amount = str_replace(',','.',$trx_amt_tmp);
                            
                            $data_debit[] = array(
                                'gl_trx_hdr_prefix' => $sa_spec_prefix,
                                'gl_trx_hdr_year' => $year,
                                'gl_trx_hdr_month' => $month,
                                'gl_trx_hdr_code' => $new_gl_coa_code,
                                'row_no' => 1,
                                'gl_trx_hdr_journal_no' => $gl_coa_no,
                                'gl_trx_hdr_journal_date' => $gl_date,
                                'coa_rowID' => $dataPost['cash_bank'][$i],
                                'descs' => $dataPost['descs'][$i],
                                'trx_amt' => $amount,
                                'dep_rowID' => $this->session->userdata('dep_rowID'),
                                'debtor_creditor_type' => $dataPost['debtor_creditor_type'][$i],
                                'debtor_creditor_rowID' => $dataPost['debtor_creditor_rowID'][$i],
                                'gl_trx_hdr_ref_no' => $reference_no,
                                'gl_trx_hdr_ref_date' => $reference_date,
                                'modul' => 'CB',
                                'cash_flow' => 'Y',
                                'base_amt' => 0,
                                'tax_no' => '', 
                                'user_created'      =>$dataPost['user_created'],
                                'date_created'      =>$dataPost['date_created'],
                                'time_created'      =>$dataPost['time_created'],
                				'user_modified'     =>$this->session->userdata('user_rowID'),
                				'date_modified'     =>date('Y-m-d'),
                				'time_modified'     =>date('H:i:s')
                            );
                                             
                        }
                        else if($dataPost['amount_credit'][$i] != 0){
                            
                            $trx_amt_tmp = str_replace('.','',$dataPost['amount_credit'][$i]);
                            $amount = str_replace(',','.',$trx_amt_tmp);
                            
                            $data_credit[] = array(
                                'gl_trx_hdr_prefix' => $sa_spec_prefix,
                                'gl_trx_hdr_year' => $year,
                                'gl_trx_hdr_month' => $month,
                                'gl_trx_hdr_code' => $new_gl_coa_code,
                                'row_no' => 2,
                                'gl_trx_hdr_journal_no' => $gl_coa_no,
                                'gl_trx_hdr_journal_date' => $gl_date,
                                'coa_rowID' => $dataPost['cash_bank'][$i],
                                'descs' => $dataPost['descs'][$i],
                                'trx_amt' => $amount * -1,
                                'dep_rowID' => $this->session->userdata('dep_rowID'),
                                'debtor_creditor_type' => $dataPost['debtor_creditor_type'][$i],
                                'debtor_creditor_rowID' => $dataPost['debtor_creditor_rowID'][$i],
                                'gl_trx_hdr_ref_no' => $reference_no,
                                'gl_trx_hdr_ref_date' => $reference_date,
                                'modul' => 'CB',
                                'cash_flow' => 'Y',
                                'base_amt' => 0,
                                'tax_no' => '',
                                'user_created'      =>$dataPost['user_created'],
                                'date_created'      =>$dataPost['date_created'],
                                'time_created'      =>$dataPost['time_created'],
                				'user_modified'     =>$this->session->userdata('user_rowID'),
                				'date_modified'     =>date('Y-m-d'),
                				'time_modified'     =>date('H:i:s')
                            );
                                                 
                        }
                        
                    }
                    
                } 
                else{
                    $error = true;
                }
            } else
            {
                $error = true;
            }
            
            $result = $this->db->insert_batch('gl_trx_dtl', $data_debit);
            if (!$result){
                $error = true;
            } 
            else{
                $error = false;
            } 
            
            $result = $this->db->insert_batch('gl_trx_dtl', $data_credit);                
            if (!$result){
                $error = true;
            } 
            else{
                $error = false;
            } 
            
            if ($result){
                if (!empty($dataPost['detailDO']))
                {
                    $get_data_header_kb = $this->general_ledger_model->get_data_header_kb($reference_no);
            
                    foreach ($dataPost['detailDO'] as $detDO)
                    {
                        $result = $this->general_ledger_model->simpan_data_detail_do($get_data_header_kb->prefix, $get_data_header_kb->code, $get_data_header_kb->trx_no,
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
            
            Header('Content-Type: application/json; charset=UTF8');
            $status = $this->db->trans_status();
            if ($status === false || $error == true)
            {
                $this->db->trans_rollback();
                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'ERROR ROLLBACK General Ledger';
                $params['module_field_id'] = $new_gl_coa_code;
                $params['activity'] = ucfirst('Deleted a General Ledger ' . $gl_coa_no);
                $params['icon'] = 'fa-exclamation-triangle';
                modules::run('activitylog/log', $params);
                echo json_encode(array('success' => false, 'msg' => " Failed"));
                exit();
            } else
            {
                $this->db->trans_commit();
                
                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'General Ledger';
                $params['module_field_id'] = $new_gl_coa_code;
                $params['activity'] = ucfirst('Updated a General Ledger No ' . $gl_coa_no);
                $params['icon'] = 'fa-edit';
                modules::run('activitylog/log', $params); //log activity
    
                $info = lang('general_ledger_registered_successfully');
                echo json_encode(array('success' => true, 'msg' => $info));
                exit();
            }
        }
        
        return $status;
  
    }
    
    function delete_data()
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $gl_no = $this->input->post('gl_no');

        $get_data = $this->general_ledger_model->get_data_header_by_trx_no($gl_no);
        
        $data = $this->general_ledger_model->delete_data_header($gl_no);
        $data = $this->general_ledger_model->delete_data_detail($gl_no);
                
        $params['user_rowID'] = $this->tank_auth->get_user_id();
        $params['module'] = 'General Ledger';
        $params['module_field_id'] = $get_data->rowID;
        $params['activity'] = ucfirst('Deleted a General Ledger No ' . $gl_no);
        $params['icon'] = 'fa-plus';
        modules::run('activitylog/log', $params); //log activity

        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }

    function verify_data()
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $gl_no = $this->input->post('gl_no');

        $get_data = $this->general_ledger_model->get_data_header_by_trx_no($gl_no);        
        $data = $this->general_ledger_model->verify_data($gl_no);
        
        $params['user_rowID'] = $this->tank_auth->get_user_id();
        $params['module'] = 'General Ledger';
        $params['module_field_id'] = $get_data->rowID;
        $params['activity'] = ucfirst('Verify a General Ledger No ' . $gl_no);
        $params['icon'] = 'fa-check';
        modules::run('activitylog/log', $params); //log activity

        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }

    function print_general_ledger($gl_no){
        $get_data = $this->general_ledger_model->get_data_header_by_trx_no($gl_no);
        $get_data_detail = $this->general_ledger_model->get_data_detail_by_trx_no($gl_no);
        
        $data['get_data'] = $get_data;
        $data['get_data_detail'] = $get_data_detail;
         
        $sql_update = "UPDATE gl_trx_hdr 
                        SET printed = printed + 1, user_printed = ".$this->session->userdata('user_rowID').",
                            date_printed = '".date('Y-m-d')."', time_printed = '".date('H:i:s')."'
                        WHERE journal_no = '".$gl_no."' AND deleted = 0";
        
        $this->db->query($sql_update);
        
        $params['user_rowID'] = $this->tank_auth->get_user_id();
		$params['module'] = 'General Ledger';
		$params['module_field_id'] = $get_data->rowID;
		$params['activity'] = ucfirst('Print a General Ledger No. '.$gl_no);
		$params['icon'] = 'fa-print';
		modules::run('activitylog/log',$params); //log activity	
        
        $html = $this->load->view('general_ledger_print_pdf', $data, true);
        
        $this->pdf_generator->generate($html, 'Print General Ledger pdf',$orientation='Portrait');    
    }
    
    function fetch_data() { 
        if ($this->input->is_ajax_request()) {
            $dt = $_POST;

            if($this->session->userdata('start_date_gl') == '' ){
                $start_date = date("Y-m-d", strtotime('-6 day'));
            }else{
                $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_gl')));
            }

            if($this->session->userdata('end_date_gl') == ''){
                $end_date = date("Y-m-d");
            }else{
                $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_gl')));
            }
            $str_between = " AND journal_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";
        
            $dt['table'] = 'gl_trx_hdr';
            $dt['id'] = 'rowID';

            $aColumnTable = array(
                'rowID', 'journal_no', 'journal_date', 'journal_type', 'ref_no', 'descs', 'trx_amt', 'verified'
            );

            $aColumns = array(
               'rowID', 'journal_no', 'journal_date', 'journal_type', 'ref_no', 'descs', 'trx_amt', 'verified'
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
                $sOrder .= " journal_date DESC, journal_no DESC";
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

            if (!empty($dt['columns'][7]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $start_date = date('Y-m-d', strtotime($dt['columns'][7]['search']['value']));
                $this->session->set_userdata('start_date_gl',date("Y-m-d",strtotime($start_date)));

                if($this->session->userdata('end_date_gl') == ''){
                    $end_date = date("Y-m-d");
                }else{
                    $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_gl')));
                }
                $str_between = " AND journal_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";

                $sWhere.= ' deleted = 0 ' . $str_between; 
            }

            if (!empty($dt['columns'][8]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $end_date = date('Y-m-d', strtotime($dt['columns'][8]['search']['value']));
                $this->session->set_userdata('end_date_gl', date("Y-m-d",strtotime($end_date)));

                if($this->session->userdata('start_date_gl') == ''){
                    $start_date = date("Y-m-d", strtotime('-6 day'));
                }else{
                    $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_dp')));
                }
                $str_between = " AND journal_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";
                
                $sWhere.= ' deleted = 0 ' . $str_between; 
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
                $sWhere .= ') AND deleted = 0 ' . $str_between;
            } 

            /** Total Data Set Length * */
            $sQuery = 'SELECT * FROM ' . $dt['table'] . ' WHERE deleted = 0 ' . $str_between;
            $rResultTotal = $this->db->query($sQuery);
            $aResultTotal = $rResultTotal->num_rows();
            $iTotal = $aResultTotal;
            
            /* Get Data To Display */
            if ($sWhere != "") {
                $where = $sWhere;
            } else {
                $where = " WHERE deleted = 0 " . $str_between;
            }

            $join_table = '';

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
                    if($aRow['verified'] != 2){
                        if($this->get_user_access('PrintLimited') == 1 || $this->get_user_access('PrintUnlimited') == 1){
                            $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('print_option') . '" onclick="print_general_ledger(\'' . $aRow['journal_no'] . '\')"><i class="fa fa-print"></i> ' . lang('print_option') . '</a></li>';
                        }
                        if($this->get_user_access('Updated') == 1){
                            $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('update_option') . '" onclick="edit_general_ledger(\'' . $aRow['journal_no'] . '\')"><i class="fa fa-edit"></i> ' . lang('update_option') . '</a></li>';
                        }
                        if($this->get_user_access('Deleted') == 1){
                            $dropdown_option .= '<li><a href="javascript:void()" title="' . lang('delete_option') . '" onclick="delete_general_ledger(\'' . $aRow['journal_no'] . '\')"><i class="fa fa-trash-o"></i> ' . lang('delete_option') . '</a></li>';
                        }
                    }
                    /*
                    else{
                        if($this->get_user_access('Verified') == 1){
                            $dropdown_option .= '<li><a href="javascript:void()" title="' . lang('verify') . '" onclick="verified_general_ledger(\'' . $aRow['journal_no'] . '\')"><i class="fa fa-check"></i> ' . lang('verify') . '</a></li>';
                        }
                    }
                    */
                    $dropdown_option .= '</ul></div>';
              
                    $row['dropdown_option'] = $dropdown_option;
                    $row['journal_no'] = $aRow['journal_no'];
                    $row['journal_date'] = date("d F Y",strtotime($aRow['journal_date']));
                    $row['journal_type'] = ucwords($aRow['journal_type']);
                    $row['ref_no'] = $aRow['ref_no'];
                    $row['descs'] = ($aRow['descs'] == '') ? '-' : $aRow['descs'];
                    $row['trx_amt'] = number_format($aRow['trx_amt'],2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));

                    $row['start_date'] = $aRow['journal_date'];
                    $row['end_date'] = $aRow['journal_date'];
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
    
    function fetch_data_not_active() { 
        if ($this->input->is_ajax_request()) {
            $dt = $_POST;

            if($this->session->userdata('start_date_gl') == '' ){
                $start_date = date("Y-m-d", strtotime('-6 day'));
            }else{
                $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_gl')));
            }

            if($this->session->userdata('end_date_gl') == ''){
                $end_date = date("Y-m-d");
            }else{
                $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_gl')));
            }
            $str_between = " AND journal_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";
        
            $dt['table'] = 'gl_trx_hdr';
            $dt['id'] = 'rowID';

            $aColumnTable = array(
                'rowID', 'journal_no', 'journal_date', 'journal_type', 'ref_no', 'descs', 'trx_amt', 'verified'
            );

            $aColumns = array(
               'rowID', 'journal_no', 'journal_date', 'journal_type', 'ref_no', 'descs', 'trx_amt', 'verified'
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
                $sOrder .= " journal_date DESC, journal_no DESC";
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

            if (!empty($dt['columns'][7]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $start_date = date('Y-m-d', strtotime($dt['columns'][7]['search']['value']));
                $this->session->set_userdata('start_date_gl',date("Y-m-d",strtotime($start_date)));

                if($this->session->userdata('end_date_gl') == ''){
                    $end_date = date("Y-m-d");
                }else{
                    $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_gl')));
                }
                $str_between = " AND journal_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";

                $sWhere.= ' deleted = 1 ' . $str_between; 
            }

            if (!empty($dt['columns'][8]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $end_date = date('Y-m-d', strtotime($dt['columns'][8]['search']['value']));
                $this->session->set_userdata('end_date_gl', date("Y-m-d",strtotime($end_date)));

                if($this->session->userdata('start_date_gl') == ''){
                    $start_date = date("Y-m-d", strtotime('-6 day'));
                }else{
                    $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_dp')));
                }
                $str_between = " AND journal_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";
                
                $sWhere.= ' deleted = 1 ' . $str_between; 
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
                $sWhere .= ') AND deleted = 1 ' . $str_between;
            } 

            /** Total Data Set Length * */
            $sQuery = 'SELECT * FROM ' . $dt['table'] . ' WHERE deleted = 1 ' . $str_between;
            $rResultTotal = $this->db->query($sQuery);
            $aResultTotal = $rResultTotal->num_rows();
            $iTotal = $aResultTotal;
            
            /* Get Data To Display */
            if ($sWhere != "") {
                $where = $sWhere;
            } else {
                $where = " WHERE deleted = 1 " . $str_between;
            }

            $join_table = '';

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
                $no = 1;
                foreach ($rResult->result_array() as $aRow) {
                    $dt['start'] ++;
                    $row = array();

                    $row['no'] = $no++;
                    $row['journal_no'] = $aRow['journal_no'];
                    $row['journal_date'] = date("d F Y",strtotime($aRow['journal_date']));
                    $row['journal_type'] = ucwords($aRow['journal_type']);
                    $row['ref_no'] = $aRow['ref_no'];
                    $row['descs'] = ($aRow['descs'] == '') ? '-' : $aRow['descs'];
                    $row['trx_amt'] = number_format($aRow['trx_amt'],2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));

                    $row['start_date'] = $aRow['journal_date'];
                    $row['end_date'] = $aRow['journal_date'];
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
        $this->db->where('Link_Menu', 'journal');
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
}

/* End of file general_ledger.php */
