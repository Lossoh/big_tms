<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Driver_attendance_monitor extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('driver_attendance_monitor_model');
        $this->load->model('appmodel');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('driver_attendance_monitor') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('driver_attendance_monitor');
        $this->session->set_userdata('page_header', 'monitoring');
        $this->session->set_userdata('page_detail', 'driver_attendance_monitor');
        $data['datatables'] = true;
        $data['form'] = true;
        
        // JAM 08.00 - 10.00
        if($this->session->userdata('start_date_da') == '' && $this->session->userdata('end_date_da') == ''){
            $start_date = date("Y-m-d",strtotime("yesterday"));
            $end_date = date("Y-m-d");
        }
        else{
            $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_da')));
            $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_da')));
        }
        
        $data['driver_attendance_monitors_1'] = $this->driver_attendance_monitor_model->get_all_records_list_1($start_date,$end_date);
                        
        $data['driver_attendance_monitor_2'] = $this->driver_attendance_monitor_model->get_all_records_list_2($start_date,$end_date);

        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;

        $this->template->set_layout('users')->build('driver_attendance_monitors', isset($data) ? $data : null);
    }
    
    function set_filter(){
       $this->session->set_userdata('start_date_da',date("Y-m-d",strtotime($this->input->post('start_date'))));
       $this->session->set_userdata('end_date_da',date("Y-m-d",strtotime($this->input->post('end_date'))));    
       
       redirect(base_url().'driver_attendance_monitor');
    }
    
    function update_note_driver_attendance(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $dataPost = $this->input->post();            
        
        $data_attendance = array(
            'note' => $dataPost['note'],
            'user_modified' => $this->session->userdata('user_id'),
            'date_modified' => date('Y-m-d'),
            'time_modified' => date('H:i:s')
        );
        $this->db->where('rowID', $dataPost['rowID']);
        $this->db->update('tr_log_driver_attendance', $data_attendance);
        
        $params['user_rowID'] = $this->tank_auth->get_user_id();
        $params['module'] = 'driver_attendance_monitor';
        $params['module_field_id'] = $dataPost['rowID'];
        $params['activity'] = ucfirst('Update a driver attendance with ID = '.$dataPost['rowID']);
        $params['icon'] = 'fa-edit';
        modules::run('activitylog/log', $params); //log activity
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode(array('success' => true, 'msg' => lang('updated_succesfully')));
        exit();
    }
    
    function add_uang_makan_stand_by_supir(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $this->db->trans_begin();
        $error = false;
        
        $dataPost = $this->input->post();            
        
        $get_data = $this->driver_attendance_monitor_model->get_data_attendance($dataPost['rowID']);
        
        $transaction_type = $dataPost['transaction_type'];

        if($transaction_type == 'uang_makan'){
            $amount = $this->config->item('biaya_uang_makan');
            
            $data_attendance = array(
                'uang_makan' => 1,
                'user_modified' => $this->session->userdata('user_id'),
                'date_modified' => date('Y-m-d'),
                'time_modified' => date('H:i:s')
            );
            
        }
        else if($transaction_type == 'stand_by'){
            $amount = $this->config->item('biaya_stand_by');
            
            $data_attendance = array(
                'stand_by' => 1,
                'user_modified' => $this->session->userdata('user_id'),
                'date_modified' => date('Y-m-d'),
                'time_modified' => date('H:i:s')
            );
            
        }
        
        $remark = $get_data->note == '' ? ucwords(str_replace('_',' ',$transaction_type)).' Rp '.number_format($amount,0,',','.') : $get_data->note.', '.ucwords(str_replace('_',' ',$transaction_type)).' Rp '.number_format($amount,0,',','.');
        
        $alloc_date = date('Y-m-d',strtotime($get_data->attendance_time));    
        $alloc_date_year = date('Y',strtotime($alloc_date));
        $alloc_date_month = date('m',strtotime($alloc_date));
        
        $dept_rowID = $this->session->userdata('dep_rowID');
        $dept = $this->db->get_where('sa_dep', array('deleted' => 0, 'rowID' => $dept_rowID))->
            row_array();

        if ($dept['ho_trx'] == 'Y') {
            $sa_spec = $this->db->get_where('sa_spec', array('deleted' => 0, 'rowID' => 1))->
                row_array();
            $sa_spec_prefix = $sa_spec['cash_out_prefix'];        
        } else {
            $sa_spec_prefix = $dept['cash_out_prefix'];
        }

        $alloc_code = ((int)$this->appmodel->select_max_id('cb_trx_hdr', $array = array
            (
            'prefix' => $sa_spec_prefix,
            'year' => $alloc_date_year,
            'month' => $alloc_date_month,
            'deleted' => 0), 'code')) + 1;
        
        $trx_no = $sa_spec_prefix . sprintf("%04s", $alloc_date_year) . sprintf("%02s",
            $alloc_date_month) . sprintf("%05s", $alloc_code);
        
        $check_trx_no = $this->driver_attendance_monitor_model->get_data_cb_header($trx_no);
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
        
        $this->db->where('rowID', $dataPost['rowID']);
        $result = $this->db->update('tr_log_driver_attendance', $data_attendance);
        
        $data_cb_header = array(
            'prefix' => $sa_spec_prefix,
            'year' => $alloc_date_year,
            'month' => $alloc_date_month,
            'code'  => $alloc_code,
            'trx_no' => $trx_no,
            'advance_invoice_trx_no' => '',
            'trx_date' => $alloc_date,
            'payment_type' => 'P',
            'transaction_type' => $transaction_type,
            'coa_rowID' => $dept['cash_gl_rowID'],
            'descs' => strtoupper($remark),
            'trx_amt' => $amount * -1,
            'fund_trf_coa_rowID' => 0,//(isset($dataPost['cb_pay_to'])) ? $dataPost['cb_pay_to'] : 0,
            'debtor_creditor_rowID' => $get_data->debtor_id,
            'debtor_creditor_type' => 'G',
            'manual_debtor_creditor' => '',
            'manual_debtor_creditor_type' => 'D',
            'branch'=>$this->session->userdata('dep_rowID'),
            'user_created' => $this->session->userdata('user_id'),
            'date_created' => $alloc_date,
            'time_created' => date('H:i:s')
        );    
        
        $data_cb_cg = array(
            'cb_trx_hdr_prefix' => $sa_spec_prefix,
            'cb_trx_hdr_year' => $alloc_date_year,
            'cb_trx_hdr_month' => $alloc_date_month,
            'cb_trx_hdr_code'  => $alloc_code,
            'trx_no' => $trx_no,
            'row_no' => 1,     
            'payment_method' => 'cash',
            'cash_bank' => $dept['cash_gl_rowID'],
            'cg_no' => '',
            'cg_date' => $alloc_date,            
            'cg_amt' => $amount,
            'status' => 1,
            'user_created' => $this->session->userdata('user_id'),
            'date_created' => $alloc_date,
            'time_created' => date('H:i:s')
        );
        
        if($result){
            $result=$this->db->insert('cb_trx_hdr', $data_cb_header);
            if($result){
                $result=$this->db->insert('cb_trx_cg', $data_cb_cg);
                if(!$result){
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
        
        Header('Content-Type: application/json; charset=UTF8');
        $status = $this->db->trans_status();
        if ($status === false || $error == true)
        {
            $this->db->trans_rollback();
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'ERROR ROLLBACK DRIVER ATTENDANCE MONITOR';
            $params['module_field_id'] = $dataPost['rowID'];
            $params['activity'] = ucfirst('Deleted a process Driver Attendance Monitor ' . $dataPost['rowID']);
            $params['icon'] = 'fa-exclamation-triangle';
            modules::run('activitylog/log', $params);
            echo json_encode(array('success' => false, 'msg' => 'Saving data '.ucwords(str_replace('_',' ',$transaction_type)).' failed'));
            exit();
        } else
        {
            $this->db->trans_commit();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'driver_attendance_monitor';
            $params['module_field_id'] = $dataPost['rowID'];
            $params['activity'] = ucfirst('Add a '.ucwords(str_replace('_',' ',$transaction_type)).' with ID = '.$dataPost['rowID']);
            $params['icon'] = 'fa-edit';
            modules::run('activitylog/log', $params); //log activity
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array('success' => true, 'msg' => 'Saving data '.ucwords(str_replace('_',' ',$transaction_type)).' succesfully'));
            exit();
        }
    }
}

/* End of file contacts.php */
