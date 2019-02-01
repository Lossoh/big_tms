<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Verification_document extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('verification_document_model');
        $this->load->library('pdf_generator');
    }
    
    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('verification_documents') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('verification_documents');
        $this->session->set_userdata('page_header', 'transaction');
        $this->session->set_userdata('page_detail', 'verification_document');
        $data['datatables'] = true;
        $data['form'] = true;
        
        if($this->session->userdata('start_date') == '' && $this->session->userdata('end_date') == ''){
            $str_between = "AND `b`.`advance_date` BETWEEN '".date('Y-m-d',strtotime("-1 days"))."' and '".date("Y-m-d")."'";
            $start_date = date("d-m-Y",strtotime("-1 days"));
            $end_date = date("d-m-Y");
        }
        else{
            $str_between = "AND `b`.`advance_date` BETWEEN '".$this->session->userdata('start_date')."' and '".$this->session->userdata('end_date')."'";
            $start_date = date("d-m-Y",strtotime($this->session->userdata('start_date')));
            $end_date = date("d-m-Y",strtotime($this->session->userdata('end_date')));
        }
        
        $sql = "SELECT `a`.`rowID`, `a`.`trx_no`, `a`.`do_no`, a.deliver_weight, a.received_weight, a.deliver_date, a.received_date, `a`.`status`, `a`.`deleted`, `a`.`invoice_no`, `a`.`commission_no`,
                        `b`.`advance_no`, `b`.`advance_date`, `b`.`advance_allocation`, `c`.`debtor_name`, `d`.`police_no`, e.alloc_date 
                FROM (`tr_do_trx` as a) 
                    JOIN `cb_cash_adv` as b ON `a`.`trx_no` = `b`.`trx_no` 
                    JOIN `sa_debtor` as c ON `b`.`employee_driver_rowID` = `c`.`rowID` 
                    JOIN `sa_vehicle` as d ON `b`.`vehicle_rowID` = `d`.`rowID` 
                    JOIN `cb_cash_adv_alloc` as e ON `a`.`trx_no` = `e`.`alloc_no` 
                GROUP BY `a`.`trx_no`, `a`.`status`, `b`.`advance_no`, `b`.`advance_date`, 
                    `b`.`advance_allocation`, `c`.`debtor_name`, `d`.`police_no` 
                HAVING `a`.`deleted` = 0 AND `a`.`status` <> 2 ".$str_between." 
                ORDER BY `b`.`advance_date`, `b`.`advance_no` desc";
        
        
        $data['verification_documents'] = $this->db->query($sql)->result();
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        
        $this->template->set_layout('users')->build('verification_documents', isset($data) ? $data : null);
    }
    
    function set_filter(){
       $this->session->set_userdata('start_date',date("Y-m-d",strtotime($this->input->post('start_date'))));
       $this->session->set_userdata('end_date',date("Y-m-d",strtotime($this->input->post('end_date'))));    
       
       redirect(base_url().'verification_document');
    }
    
    function verify_password()
    {

        $this->load->model('tank_auth/users');
        $user_id = $this->session->userdata('user_id');

        if (!is_null($user = $this->users->get_user_by_id($user_id, true)))
        {

            // Check if password correct
            $password = $this->input->post('password');
            $hasher = new PasswordHash($this->config->item('phpass_hash_strength',
                'tank_auth'), $this->config->item('phpass_hash_portable', 'tank_auth'));
            if ($hasher->CheckPassword($password, $user->password))
            { // success
                $trx_no = $this->input->post('trx_no');
                
                Header('Content-Type: application/json; charset=UTF8');
                $check_verification_document = $this->db->get_where('tr_do_trx', array('trx_no' =>$trx_no))->row_array();
                                
                if (empty($check_verification_document['trx_no'])) {
                    echo json_encode(array("success" => false, 'msg' => lang('no_data_transaction')));
                    exit();
                } 
                else { 
                    // edit Data
                    if($check_verification_document['status'] == 0){
                        $status = 1;
                    }
                    else{
                        $status = 0;
                    }
                    $this->verification_document_model->update_data_by_trx_no($trx_no,$status);
                    Header('Content-Type: application/json; charset=UTF8');
                    echo json_encode(array("success" => true, 'msg' => lang('your_password_correct').' and '.lang('status_changed')));
                    exit();
        
                }
                
            } 
            else
            { // fail
                echo json_encode(array('success' => false, 'msg' => lang('your_password_incorrect')));
                exit();
            }
        } else
        {
            echo json_encode(array('success' => false, 'msg' => "Failed"));
            exit();
        }
    }
    
    function update($trx_no)
    {
        
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $check_verification_document = $this->db->get_where('tr_do_trx', array('trx_no' =>$trx_no))->row_array();
                        
        if (empty($check_verification_document['trx_no'])) {
            echo json_encode(array("success" => false, 'msg' => lang('no_data_transaction')));
            exit();
        } 
        else { 
            // edit Data
            if($check_verification_document['status'] == 0){
                $status = 1;
            }
            else{
                $status = 0;
            }
            $this->verification_document_model->update_data_by_trx_no($trx_no,$status);
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('status_changed')));
            exit();

        }

    }
    
    function pdf()
    {
        if($this->session->userdata('start_date') == '' && $this->session->userdata('end_date') == ''){
            $str_between = "AND `b`.`advance_date` BETWEEN '".date('Y-m-d',strtotime("-1 days"))."' and '".date("Y-m-d")."'";
            $start_date = date("d-m-Y",strtotime("-1 days"));
            $end_date = date("d-m-Y");
        }
        else{
            $str_between = "AND `b`.`advance_date` BETWEEN '".$this->session->userdata('start_date')."' and '".$this->session->userdata('end_date')."'";
            $start_date = date("d-m-Y",strtotime($this->session->userdata('start_date')));
            $end_date = date("d-m-Y",strtotime($this->session->userdata('end_date')));
        }
        
        $sql = "SELECT `a`.`rowID`, `a`.`trx_no`, `a`.`do_no`, a.deliver_weight, a.received_weight, a.deliver_date, a.received_date, `a`.`status`, `a`.`deleted`,
                        `b`.`advance_no`, `b`.`advance_date`, `b`.`advance_allocation`, `c`.`debtor_name`, `d`.`police_no`, e.alloc_date 
                FROM (`tr_do_trx` as a) 
                    JOIN `cb_cash_adv` as b ON `a`.`trx_no` = `b`.`trx_no` 
                    JOIN `sa_debtor` as c ON `b`.`employee_driver_rowID` = `c`.`rowID` 
                    JOIN `sa_vehicle` as d ON `b`.`vehicle_rowID` = `d`.`rowID` 
                    JOIN `cb_cash_adv_alloc` as e ON `a`.`trx_no` = `e`.`alloc_no`
                GROUP BY `a`.`trx_no`, `a`.`status`, `b`.`advance_no`, `b`.`advance_date`, 
                    `b`.`advance_allocation`, `c`.`debtor_name`, `d`.`police_no` 
                HAVING `a`.`deleted` = 0 AND `a`.`status` = 1 ".$str_between." 
                ORDER BY `a`.`date_modified`, `a`.`time_modified` asc";
        
        
        $data['verification_documents'] = $this->db->query($sql)->result();
        $data['periode'] = date("d F Y",strtotime($start_date)).' - '.date("d F Y",strtotime($end_date));
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        
        $html = $this->load->view('verification_documents_pdf', $data, true);
        $this->pdf_generator->generate($html, 'Verification Document',$orientation='Portrait');
    }
    
}

/* End of file contacts.php */
