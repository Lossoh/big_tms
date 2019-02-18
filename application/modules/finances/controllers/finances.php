<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class finances extends MX_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('finances_model');
        $this->load->model('appmodel');
        $this->load->model('fare_trip/fare_trip_model');
        $this->load->model('vehicle/vehicle_model');
        $this->load->model('vehicle_category/vehicle_category_model');
        $this->load->model('cost_code/cost_code_model');
        $this->load->model('debtor/debtor_model');
        
        $this->load->library('pdf_generator');
        
    }

    function cash_advance_list()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('cash_advance_list') . ' - ' . $this->config->item('website_name') .
            ' - ' . $this->config->item('comp_name') . ' ' . $this->config->item('version'));
        $data['page'] = lang('cash_advance_list');
        $this->session->set_userdata('page_header', 'transaction');
        $this->session->set_userdata('page_detail', 'cash_advance_list');
        $data['datatables'] = true;
        $data['form'] = true;

        if($this->session->userdata('start_date_ca') == ''){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = $this->session->userdata('start_date_ca');
        }

        if($this->session->userdata('end_date_ca') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = $this->session->userdata('end_date_ca');
        }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
            
        // $data['cash_advance_lists'] = $this->finances_model->get_all_records_list(false, $this->session->userdata('dep_rowID'),$start_date,$end_date);
        // $data['loan_lists'] = $this->finances_model->get_all_records_loan_list(false, $this->session->userdata('dep_rowID'),$start_date,$end_date);    
        // $data['cash_advance_lists_bonus_nol'] = $this->finances_model->get_all_records_list_bonus_nol(false, $this->session->userdata('dep_rowID'),$start_date,$end_date);
        $data['realisasi_has_not_cb'] = $this->finances_model->get_all_records_has_not_cb(false, $this->session->userdata('dep_rowID'),$start_date,$end_date);

        $data['cash_advance_types'] = $this->appmodel->get_all_records($table =
            'sa_advance_type', $array = array('deleted' => 0), $join_table = '', $join_criteria =
            '', 'rowID', 'ASC');

        $data['drivers'] = $this->finances_model->get_all_antrian_today();
        $data['debtors'] = $this->debtor_model->get_all_records($table = 'sa_debtor', $array =
            array('rowID >' => '0', 'deleted' => '0'), $join_table = '', $join_criteria = '',
            'debtor_name', 'asc');
        $data['items'] = $this->appmodel->get_all_records($table =
            'sa_item', $array = array('deleted' => 0), $join_table = '', $join_criteria =
            '', 'item_name', 'ASC');

        $data['vehicles'] = $this->appmodel->get_all_records($table = 'sa_vehicle', $array =
            array('deleted' => 0, 'status' => 0), $join_table = '', $join_criteria = '',
            'police_no', 'ASC');

        $data['ca_poks'] = $this->finances_model->get_all_ca_pok($this->session->userdata('dep_rowID'));
        
        $dept = $this->db->get_where('sa_dep', array('deleted' => 0, 'rowID' => $this->
                session->userdata('dep_rowID')))->row_array();

        $data['cost'] = $this->fare_trip_model->get_all_records($table = 'sa_cost', $array =
            array(
            'rowID >' => 0,
            'deleted' => 0,
            'fare_trip_comp' => 'Y',
            'site_flag' => $dept['site_flag']), $join_table = '', $join_criteria = '',
            'rowID', 'asc');


        $this->template->set_layout('users')->build('cash_advance_list', isset($data) ?
            $data : null);
    }
    
    function cash_advance_list_branch()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('cash_advance_list_branch') . ' - ' . $this->config->item('website_name') .
            ' - ' . $this->config->item('comp_name') . ' ' . $this->config->item('version'));
        $data['page'] = lang('cash_advance_list_branch');
        $this->session->set_userdata('page_header', 'transaction');
        $this->session->set_userdata('page_detail', 'cash_advance_list_branch');
        $data['datatables'] = true;
        $data['form'] = true;
        
        if($this->session->userdata('start_date_ca') == ''){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = $this->session->userdata('start_date_ca');
        }

        if($this->session->userdata('end_date_ca') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = $this->session->userdata('end_date_ca');
        }

        // if($this->session->userdata('start_date_ca') == '' && $this->session->userdata('end_date_ca') == ''){
        //     $start_date = date("Y-m-d",strtotime("yesterday"));
        //     $end_date = date("Y-m-d");
        // }
        // else{
        //     $start_date = $this->session->userdata('start_date_ca');
        //     $end_date = $this->session->userdata('end_date_ca');
        // }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
            
        // $data['cash_advance_lists'] = $this->finances_model->get_all_records_list(true, $this->session->userdata('dep_rowID'),$start_date,$end_date);
        // $data['loan_lists'] = $this->finances_model->get_all_records_loan_list(true, $this->session->userdata('dep_rowID'),$start_date,$end_date);    
        // $data['cash_advance_lists_bonus_nol'] = $this->finances_model->get_all_records_list_bonus_nol(true, $this->session->userdata('dep_rowID'),$start_date,$end_date);
        $data['realisasi_has_not_cb'] = $this->finances_model->get_all_records_has_not_cb(true, $this->session->userdata('dep_rowID'),$start_date,$end_date);
        
        $data['cash_advance_types'] = $this->appmodel->get_all_records($table =
            'sa_advance_type', $array = array('deleted' => 0), $join_table = '', $join_criteria =
            '', 'rowID', 'ASC');

        $data['drivers'] = $this->finances_model->get_all_antrian_today();
        $data['debtors'] = $this->debtor_model->get_all_records($table = 'sa_debtor', $array =
            array('rowID >' => '0', 'deleted' => '0'), $join_table = '', $join_criteria = '',
            'debtor_name', 'asc');
        $data['items'] = $this->appmodel->get_all_records($table =
            'sa_item', $array = array('deleted' => 0), $join_table = '', $join_criteria =
            '', 'item_name', 'ASC');

        $data['vehicles'] = $this->appmodel->get_all_records($table = 'sa_vehicle', $array =
            array('deleted' => 0, 'status' => 0), $join_table = '', $join_criteria = '',
            'police_no', 'ASC');

        $data['ca_poks'] = $this->finances_model->get_all_ca_pok($this->session->userdata('dep_rowID'));
        
        $dept = $this->db->get_where('sa_dep', array('deleted' => 0, 'rowID' => $this->
                session->userdata('dep_rowID')))->row_array();

        $data['cost'] = $this->fare_trip_model->get_all_records($table = 'sa_cost', $array =
            array(
            'rowID >' => 0,
            'deleted' => 0,
            'fare_trip_comp' => 'Y',
            'site_flag' => $dept['site_flag']), $join_table = '', $join_criteria = '',
            'rowID', 'asc');


        $this->template->set_layout('users')->build('cash_advance_list_branch', isset($data) ?
            $data : null);
    }
    
    function set_filter(){
       $this->session->set_userdata('start_date_ca',date("Y-m-d",strtotime($this->input->post('start_date'))));
       $this->session->set_userdata('end_date_ca',date("Y-m-d",strtotime($this->input->post('end_date'))));    
       
       redirect(base_url().'finances/'.$this->session->userdata('page_detail'));
    }
    
    function view_cash_advance($rowID)
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('cash_advance_list') . ' - ' . $this->config->item('website_name') .
            ' - ' . $this->config->item('comp_name') . ' ' . $this->config->item('version'));
        $data['page'] = lang('cash_advance_list');
        $this->session->set_userdata('page_header', 'transaction');
        $this->session->set_userdata('page_detail', $this->session->userdata('page_detail'));
        
        $get_data = $this->finances_model->get_all_records_list_by_id($rowID);
        $data['all_data'] = $get_data;

        $this->template->set_layout('users')->build('view_detail', isset($data) ? $data : null);
    }

    function view_realization($value)
    {
        $trx_no = $this->encrypt->decode($value);
        $data['cash_advance'] = $this->finances_model->get_cash_advance_by_trx_no($trx_no);
        $data['cash_advance_refund'] = $this->finances_model->get_cash_advance_refund_by_trx_no($trx_no);
        $data['documents'] = $this->finances_model->get_document_by_trx_no($trx_no);
        $data['costs'] = $this->finances_model->get_cost_by_trx_no($trx_no);
        
        $jo_type = "-";
        
        foreach($data['documents'] as $row_do){
            $get_data = $this->finances_model->get_jo_by_jo_no($row_do->jo_no);
            if($get_data->jo_type == 1){                
                $jo_type = "Bulk";
            }
            else if($get_data->jo_type == 2){                
                $jo_type = "Container";
            }
            else{
                $jo_type = "Other";
            }
        }
        
        $data['jo_type'] = $jo_type;
        
        if($data['cash_advance']->advance_type_rowID == '1'){
            $html = $this->load->view('realization_pdf', $data, true);
        }
        else{
            $html = $this->load->view('realization_others_pdf', $data, true);
        }

        $params['user_rowID'] = $this->tank_auth->get_user_id();
        $params['module'] = 'Finances->Print Realization';
        $params['module_field_id'] = $trx_no;
        $params['activity'] = ucfirst('Print Realization No ' . $trx_no.' with Cash Advance No '.$data['cash_advance']->advance_no);
        $params['icon'] = 'fa-print';
        modules::run('activitylog/log', $params); //log activity

        $this->pdf_generator->generate($html, 'realization pdf',$orientation='Portrait');
    }

    function get_data_realization()
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $ca_prefix = $_GET['prefix'];
        $ca_year = $_GET['year'];
        $ca_month = $_GET['month'];
        $ca_code = $_GET['code'];
        
        $sql = "SELECT UNIX_TIMESTAMP() as unix_time";
        $unix_time = $this->db->query($sql)->row();
        
        $this->db->set('on_process',$unix_time->unix_time);
        $this->db->where('prefix',$ca_prefix);
        $this->db->where('year',$ca_year);
        $this->db->where('month',$ca_month);
        $this->db->where('code',$ca_code);
        $this->db->update('cb_cash_adv');
        
        $hasil = $this->finances_model->get_all_records_ca_details_row($ca_prefix, $ca_year,
            $ca_month, $ca_code);
        
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }

    function getAmountCost()
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $from_id = $this->input->post('from_id');
        $to_id = $this->input->post('to_id');
        $jo_type = $this->input->post('jo_type');
        $vehicle_type = $this->input->post('vehicle_type');
        
        $hasil = $this->finances_model->getAmountCost($from_id, $to_id, $jo_type, $vehicle_type);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }

    function getAmountCost2()
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');

        $gabung = (empty($_POST['gabung'])) ? $_POST['gabung'] : 0;
        $fareTrip = substr_replace($gabung, '', -1);
        echo $fareTrip; //exit();

        if (!empty($_POST['gabung']))
        {
            $data = $_POST['gabung'];
        } 
        else
        {
            $fareTrip = 0;
        }


        $hasil = $this->db->query("select a.* from sa_fare_trip_dtl as a
         where a.fare_trip_hdr_rowID  in (" . $fareTrip . ") 
         and a.vehicle_type_rowID='1'
         and a.deleted = 0 and a.cost_rowID=2 ");
        //print_r($hasil->result());exit;

        header('Content-Type: application/json');
        $arr = array();
        if (!empty($hasil))
        {

            foreach ($hasil->result() as $rs)
            {

                $arr[] = array(
                    'cost_rowID' => $rs->cost_rowID,
                    'fare_trip_amt' => $rs->fare_trip_amt,
                    );
            }

        }
        header('Content-Type: application/json');
        echo json_encode($arr);
        exit();
    }


    function get_data_job_order()
    {
        $list = $this->finances_model->get_data_cash_advance_jo();
        $arr = array();
        if (!empty($list))
        {
            header('Content-Type: application/json');
            foreach ($list as $rs)
            {

                $arr[] = array(
                    'jo_no' => $rs->jo_no,
                    'jo_date' => $rs->jo_date,
                    'debtor' => $rs->debtor,
                    'po_spk_no' => $rs->po_spk_no,
                    'so_no' => $rs->so_no,
                    'vessel_no' => $rs->vessel_no,
                    'vessel_name' => $rs->vessel_name,
                    'port_name' => $rs->port_name,
                    'fare_trip_cd' => $rs->fare_trip_cd,
                    'year' => $rs->year,
                    'month' => $rs->month,
                    'code' => $rs->code);
            }
            header('Content-Type: application/json');
            echo json_encode($arr);
        }
        exit();
    }
    
    function get_data_jo_by_type(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $from_id = $this->input->post('from_id');
        $to_id = $this->input->post('to_id');
        $type = $this->input->post('type');
        
        $hasil = $this->finances_model->get_data_cash_advance_jo_by_from_to_type($from_id,$to_id,$type);
        
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function check_data_do(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $do_no = $this->input->post('do_no');
        $x = $this->input->post('x');

        $get_data = $this->finances_model->get_document_by_do_no($do_no);
        $hasil = array('total' => count($get_data), 'x' => $x, 'do_no' => $do_no);
        
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }

    function simpan_cash_advance()
    {
        $dataPost = $this->input->post();

        //echo "<pre>";print_r($dataPost);echo "</pre>";exit();

        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');

        $dept = $this->db->get_where('sa_dep', array('deleted' => 0, 'rowID' => $this->
                session->userdata('dep_rowID')))->row_array();

        if ($dept['ho_trx'] == 'Y')
        {
            $cash_out_prefix_cd = $this->appmodel->get_id($table = 'sa_dep', $array = array
                ('deleted' => 0, 'rowID' => $this->session->userdata('dep_rowID')),
                'cash_out_prefix');
        } else
        {
            $cash_out_prefix_cd = $dept['cash_out_prefix'];
        }
        
        if(date('Y-m-d',strtotime($dataPost['date_ca'])) != date('Y-m-d')){
            $cash_advance_date = date('Y-m-d');
        }
        else{
            $cash_advance_date = date('Y-m-d',strtotime($dataPost['date_ca']));
        }
        
        $year = date('Y',strtotime($cash_advance_date));
        $month = date('m',strtotime($cash_advance_date));
        
        $cash_advance_rowID = $dataPost['cash_advance_type2'];
        $cash_out_prefix_cd = $this->appmodel->get_id($table = 'sa_dep', $array = array
            ('deleted' => 0, 'rowID' => $this->session->userdata('dep_rowID')),
            'cash_out_prefix');
        $cash_out_year = date('Y', strtotime($cash_advance_date));//date('Y');
        $cash_out_month = date('m', strtotime($cash_advance_date));//date('m');
        $cash_gl_rowID = $this->appmodel->get_id($table = 'sa_dep', $array = array('deleted' =>
                0, 'rowID' => $this->session->userdata('dep_rowID')), 'cash_gl_rowID');
        $advance_name = $this->appmodel->get_id($table = 'sa_advance_type', $array =
            array('deleted' => 0, 'rowID' => $cash_advance_rowID), 'advance_name');
        $debtor_name = $this->appmodel->get_id($table = 'sa_debtor', $array = array('deleted' =>
                0, 'rowID' => $this->input->post('driver2')), 'debtor_name');
        $sa_spec_prefix = $this->appmodel->get_id($table = 'sa_spec', $array = array('deleted' =>
                0, 'rowID' => 1), 'general_jrn');
        $debtor_type_rowID = $this->appmodel->get_id($table = 'sa_debtor', $array =
            array('deleted' => 0, 'rowID' => $this->input->post('driver2')),
            'debtor_type_rowID');
        $receiveable_rowID = $this->appmodel->get_id($table = 'sa_debtor_type', $array =
            array('deleted' => 0, 'rowID' => $debtor_type_rowID), 'receiveable_coa_rowID');

        $new_cash_advance_code = ((int)$this->appmodel->select_max_id('cb_cash_adv', $array =
            array(
            'prefix' => $cash_out_prefix_cd,
            'year' => $cash_out_year,
            'month' => $cash_out_month,
            'deleted' => 0), 'code')) + 1;

        $cash_advance_no = 'CA'.$cash_out_prefix_cd . sprintf("%04s", $cash_out_year) .
            sprintf("%02s", $cash_out_month) . sprintf("%05s", $new_cash_advance_code);
        $new_gl_coa_code = ((int)$this->appmodel->select_max_id('gl_trx_hdr', $array =
            array(
            'prefix' => $sa_spec_prefix,
            'year' => $cash_out_year,
            'month' => $cash_out_month,
            'deleted' => 0), 'code')) + 1;
        $gl_coa_no = $sa_spec_prefix . sprintf("%04s", $cash_out_year) . sprintf("%02s",
            $cash_out_month) . sprintf("%05s", $new_gl_coa_code);
        
        
        $sa_spec_cb = $this->db->get_where('sa_spec', array('deleted' => 0, 'rowID' => 1))->
                row_array();
        $sa_spec_prefix_cb = $sa_spec_cb['cash_out_prefix'];
        
        $alloc_code_cb = ((int)$this->appmodel->select_max_id('cb_trx_hdr', $array = array
            (
            'prefix' => $sa_spec_prefix_cb,
            'year' => $year,
            'month' => $month,
            'deleted' => 0), 'code')) + 1;
            
        $trx_no_cb = $sa_spec_prefix_cb . sprintf("%04s", $year) . sprintf("%02s", $month) . sprintf("%05s", $alloc_code_cb);
               
        $check_trx_no = $this->finances_model->get_data_header_cb($trx_no_cb);
        if(count($check_trx_no) > 0){
            $alloc_code_cb = ((int)$this->appmodel->select_max_id('cb_trx_hdr', $array = array
                (
                'prefix' => $sa_spec_prefix_cb,
                'year' => $year,
                'month' => $month,
                'deleted' => 0), 'code')) + 1;
                
            $trx_no_cb = $sa_spec_prefix_cb . sprintf("%04s", $year) . sprintf("%02s", $month) . sprintf("%05s", $alloc_code_cb);
                 
        }
        
        $this->db->trans_begin(); # Starting Transaction
        
        if (empty($dataPost['advance_no']))
        {
            $this->finances_model->simpanCashAdvance($cash_out_prefix_cd, $new_cash_advance_code,
                $cash_advance_no, $dataPost);
            $this->finances_model->simpanCashBankHeader($sa_spec_prefix_cb, $alloc_code_cb,
                $cash_advance_no, $cash_gl_rowID, $advance_name, $debtor_name, $trx_no_cb, $dataPost);            
            $this->finances_model->simpanCashBankDetail($sa_spec_prefix_cb, $alloc_code_cb,
                $cash_advance_no, $cash_gl_rowID, $advance_name, $debtor_name, $trx_no_cb, $dataPost);            
            /*
            $this->finances_model->simpan_gl_header_doc($sa_spec_prefix, $new_gl_coa_code, $gl_coa_no, $cash_out_prefix_cd, 
                $cash_advance_no, $advance_name, $debtor_name, $new_cash_advance_code, $dataPost);    
            $this->finances_model->simpan_gl_detail_doc_debet($sa_spec_prefix, $new_gl_coa_code, $gl_coa_no, $cash_out_prefix_cd, 
                $receiveable_rowID, $advance_name, $debtor_name, $new_cash_advance_code, $cash_advance_no, $dataPost);
            $this->finances_model->simpan_gl_detail_doc_kredit($sa_spec_prefix, $new_gl_coa_code, $gl_coa_no, $cash_gl_rowID, 
                $advance_name, $debtor_name, $cash_out_prefix_cd, $new_cash_advance_code, $cash_advance_no, $dataPost);
            */
            $this->finances_model->simpan_data_order($cash_advance_no, $dataPost);

            if(!empty($dataPost['queue_id'])){
                $this->finances_model->updateQueue($dataPost['queue_id'], date('Y-m-d H:i:s'), $this->session->userdata('user_id'));
            }

        }

        Header('Content-Type: application/json; charset=UTF8');
        $status = $this->db->trans_status();
        if ($status === false)
        {
            $this->db->trans_rollback();
            //$params['user_rowID'] = $this->tank_auth->get_user_id();
            //				$params['module'] = 'ERROR ROLLBACK Finances->Realization';
            //				$params['module_field_id'] = $alloc_code;
            //				$params['activity'] = ucfirst('Deleted a Realization No. '.$alloc_no);
            //				$params['icon'] = 'fa-exclamation-triangle';
            //				modules::run('activitylog/log',$params);
            echo json_encode(array('success' => false, 'msg' => " Failed"));
            exit();
        } else
        {
            $this->db->trans_commit();
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Finances->Cash Advance';
            $params['module_field_id'] = $cash_advance_no;
            $params['activity'] = ucfirst('Added a new cash advance no. ' . $cash_advance_no);
            $params['icon'] = 'fa-plus';
            modules::run('activitylog/log', $params); //log activity

            $info = lang('add_cash_advance_successfully');
            echo json_encode(array('success' => true, 'msg' => $info));
            exit();
        }
        return $status;

    }

    function second_payment($cash_advance_no){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        
        $get_data = $this->finances_model->get_ca_fare_trip_by_advance_no($cash_advance_no);
        $year = date('Y');
        $month = date('m');
        if($get_data->split_status == 1){
        
            $cash_gl_rowID = $this->appmodel->get_id($table = 'sa_dep', $array = array('deleted' =>
                    0, 'rowID' => $this->session->userdata('dep_rowID')), 'cash_gl_rowID');
            $advance_name = $this->appmodel->get_id($table = 'sa_advance_type', $array =
                array('deleted' => 0, 'rowID' => $get_data->advance_type_rowID), 'advance_name');
            $debtor_name = $this->appmodel->get_id($table = 'sa_debtor', $array = array('deleted' =>
                    0, 'rowID' => $get_data->employee_driver_rowID), 'debtor_name');
            $sa_spec_cb = $this->db->get_where('sa_spec', array('deleted' => 0, 'rowID' => 1))->
                    row_array();
            $sa_spec_prefix_cb = $sa_spec_cb['cash_out_prefix'];
            
            $alloc_code_cb = ((int)$this->appmodel->select_max_id('cb_trx_hdr', $array = array
                (
                'prefix' => $sa_spec_prefix_cb,
                'year' => $year,
                'month' => $month,
                'deleted' => 0), 'code')) + 1;
                
            $trx_no_cb = $sa_spec_prefix_cb . sprintf("%04s", $year) . sprintf("%02s", $month) . sprintf("%05s", $alloc_code_cb);
                   
            $check_trx_no = $this->finances_model->get_data_header_cb($trx_no_cb);
            if(count($check_trx_no) > 0){
                $alloc_code_cb = ((int)$this->appmodel->select_max_id('cb_trx_hdr', $array = array
                    (
                    'prefix' => $sa_spec_prefix_cb,
                    'year' => $year,
                    'month' => $month,
                    'deleted' => 0), 'code')) + 1;
                    
                $trx_no_cb = $sa_spec_prefix_cb . sprintf("%04s", $year) . sprintf("%02s", $month) . sprintf("%05s", $alloc_code_cb);
                     
            }
            
            $this->db->trans_begin(); # Starting Transaction
            
            $sql = "UPDATE cb_cash_adv 
                    SET split_status = 2, advance_amount = advance_amount + ".$get_data->os_amount.", advance_balance = advance_balance + ".$get_data->os_amount.",
                        user_modified = ".$this->session->userdata('user_id').", date_modified = '".date('Y-m-d')."', time_modified = '".date('H:i:s')."'
                    WHERE advance_no = '".$cash_advance_no."' AND deleted = 0";
            $this->db->query($sql);
            
            $this->finances_model->simpanCashBankHeaderSecond($sa_spec_prefix_cb, $alloc_code_cb,
                $cash_advance_no, $cash_gl_rowID, $advance_name, $debtor_name, $trx_no_cb, $get_data);            
            $this->finances_model->simpanCashBankDetailSecond($sa_spec_prefix_cb, $alloc_code_cb,
                $cash_advance_no, $cash_gl_rowID, $advance_name, $debtor_name, $trx_no_cb, $get_data);
                
            Header('Content-Type: application/json; charset=UTF8');
            $status = $this->db->trans_status();
            if ($status === false)
            {
                $this->db->trans_rollback();
                //$params['user_rowID'] = $this->tank_auth->get_user_id();
                //				$params['module'] = 'ERROR ROLLBACK Finances->Realization';
                //				$params['module_field_id'] = $alloc_code;
                //				$params['activity'] = ucfirst('Deleted a Realization No. '.$alloc_no);
                //				$params['icon'] = 'fa-exclamation-triangle';
                //				modules::run('activitylog/log',$params);
                echo json_encode(array('success' => false, 'msg' => " Failed"));
                exit();
            } else
            {
                $this->db->trans_commit();
                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'Finances->Cash Advance';
                $params['module_field_id'] = $cash_advance_no;
                $params['activity'] = ucfirst('Added a second payment no. ' . $cash_advance_no);
                $params['icon'] = 'fa-plus';
                modules::run('activitylog/log', $params); //log activity
    
                $info = 'Create second payment successfully';
                echo json_encode(array('success' => true, 'msg' => $info));
                exit();
            }
        }
        else{
            echo json_encode(array('success' => false, 'msg' => 'Second payment already exists'));
            exit();
        }
        return $status;
    }
    
    function create_cash_advance() // Tidak dipakai
    {

        if ($this->input->post())
        {

            //$this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<span style="color:red">',
                '</span><br>');
            //$this->form_validation->set_rules('csrf_key', 'CSRF Key', 'required');
            //$this->form_validation->set_rules('csrf_token', 'CSRF Token', 'required');
            $this->form_validation->set_rules('cash_advance_type', 'Cash Advance Type',
                'required');

            //$key   = $this->input->post('csrf_key');
            //$token = $this->input->post('csrf_token');


            if ($this->form_validation->run() == false)
            {
                $this->session->set_flashdata('response_status', 'error');
                $this->session->set_flashdata('message', 'Please Choose Advance Type First!!!');
                redirect('finances/create_cash_advance');
                /*}else if (!isset($_POST['csrf_key']) or ! isset($_POST['csrf_token'])) {
                $this->session->set_flashdata('response_status', 'error');
                $this->session->set_flashdata('message','No CSRF token found, invalid request.');
                $this->session->set_flashdata('form_errors', validation_errors('<span style="color:red">', '</span><br>'));
                redirect('finances/create_cash_advance');
                }else if ($token !== $this->session->userdata($key)) {
                $this->session->set_flashdata('response_status', 'error');
                $this->session->set_flashdata('message','Invalid CSRF token, access denied.');
                $this->session->set_flashdata('form_errors', validation_errors('<span style="color:red">', '</span><br>'));
                redirect('finances/create_cash_advance');*/
            } else
            {

                if ($this->input->post('cash_advance_type') != 0)
                {
                    if (substr($this->input->post('cash_advance_type'), -1) == 'Y')
                    {
                        $this->form_validation->set_rules('fare_trip', 'Fare Trip',
                            'required|is_natural_no_zero');
                        $this->form_validation->set_rules('vehicle', 'Vehicle',
                            'required|is_natural_no_zero');
                        $this->form_validation->set_rules('vehicle_category', 'Vehicle Category',
                            'required|is_natural_no_zero');
                        $this->form_validation->set_rules('driver', 'Driver',
                            'required|is_natural_no_zero');
                        $this->form_validation->set_rules('amount', 'Amount',
                            'required|numeric|is_natural_no_zero');

                        if ($this->form_validation->run() == false)
                        {
                            $this->session->set_flashdata('response_status', 'error');
                            $this->session->set_flashdata('message',
                                'Please choose fare trip, vehicle, vehicle category, driver First!!! OR Check Value Of Amount was not ZERO');
                            redirect('finances/create_cash_advance');
                        }
                    } else
                    {
                        $this->form_validation->set_rules('driver', 'Driver',
                            'required|is_natural_no_zero');
                        $this->form_validation->set_rules('amount', 'Amount',
                            'required|numeric|is_natural_no_zero');

                        if ($this->form_validation->run() == false)
                        {
                            $this->session->set_flashdata('response_status', 'error');
                            $this->session->set_flashdata('message',
                                'Please choose Employee First!!! OR Check Value Of Amount was not ZERO');
                            redirect('finances/create_cash_advance');
                        }
                    }

                    $cash_advance_rowID = $this->input->post('cash_advance_type');
                    $cash_advance_rowID = substr($cash_advance_rowID, 0, strlen($cash_advance_rowID) -
                        1);

                    $cash_advance_date = date('Y-m-d');
                    $cash_out_prefix_cd = $this->appmodel->get_id($table = 'sa_dep', $array = array
                        ('deleted' => 0, 'rowID' => $this->session->userdata('dep_rowID')),
                        'cash_out_prefix');
                    $cash_out_year = date('Y');
                    $cash_out_month = date('m');
                    $cash_gl_rowID = $this->appmodel->get_id($table = 'sa_dep', $array = array('deleted' =>
                            0, 'rowID' => $this->session->userdata('dep_rowID')), 'cash_gl_rowID');
                    $advance_name = $this->appmodel->get_id($table = 'sa_advance_type', $array =
                        array('deleted' => 0, 'rowID' => $cash_advance_rowID), 'advance_name');
                    $debtor_name = $this->appmodel->get_id($table = 'sa_debtor', $array = array('deleted' =>
                            0, 'rowID' => $this->input->post('driver')), 'debtor_name');
                    $sa_spec_prefix = $this->appmodel->get_id($table = 'sa_spec', $array = array('deleted' =>
                            0, 'rowID' => 1), 'general_jrn');
                    $debtor_type_rowID = $this->appmodel->get_id($table = 'sa_debtor', $array =
                        array('deleted' => 0, 'rowID' => $this->input->post('driver')),
                        'debtor_type_rowID');
                    $receiveable_rowID = $this->appmodel->get_id($table = 'sa_debtor_type', $array =
                        array('deleted' => 0, 'rowID' => $debtor_type_rowID), 'receiveable_coa_rowID');

                    $new_cash_advance_code = ((int)$this->appmodel->select_max_id('cb_cash_adv', $array =
                        array(
                        'prefix' => $cash_out_prefix_cd,
                        'year' => $cash_out_year,
                        'month' => $cash_out_month,
                        'deleted' => 0), 'code')) + 1;

                    $cash_advance_no = $cash_out_prefix_cd . sprintf("%04s", $cash_out_year) .
                        sprintf("%02s", $cash_out_month) . sprintf("%05s", $new_cash_advance_code);

                    $cash_advance_data = array(
                        'prefix' => $cash_out_prefix_cd,
                        'year' => $cash_out_year,
                        'month' => $cash_out_month,
                        'code' => $new_cash_advance_code,
                        'advance_no' => $cash_advance_no,
                        'advance_date' => $cash_advance_date,
                        'advance_type_rowID' => $this->input->post('cash_advance_type'),
                        'employee_driver_rowID' => $this->input->post('driver'),
                        'vehicle_rowID' => $this->input->post('vehicle'),
                        'vehicle_type_rowID' => $this->input->post('vehicle_category'),
                        'fare_trip_rowID' => $this->input->post('fare_trip'),
                        'dep_rowID' => $this->session->userdata('dep_rowID'),
                        'advance_amount' => $this->input->post('amount'),
                        'advance_allocation' => 0,
                        'advance_balance' => $this->input->post('amount'),
                        'description' => $this->input->post('cash_advance_desc'),
                        'user_created' => $this->session->userdata('user_rowID'),
                        'date_created' => date('Y-m-d'),
                        'time_created' => date('H:i:s'));


                    $cb_trx_data = array(
                        'prefix' => $cash_out_prefix_cd,
                        'year' => $cash_out_year,
                        'month' => $cash_out_month,
                        'code' => $new_cash_advance_code,
                        'trx_no' => $cash_advance_no,
                        'trx_date' => $cash_advance_date,
                        'payment_type' => 'P',
                        'transaction_type' => 'cash_advance',
                        'debtor_creditor_type' => 'D',
                        'coa_rowID' => $cash_gl_rowID,
                        'descs' => ($this->input->post('cash_advance_desc') == "") ? strtoupper($advance_name .
                            ' A/N ' . $debtor_name) : strtoupper($advance_name . ' A/N ' . $debtor_name .
                            ', ' . $this->input->post('cash_advance_desc')),
                        'trx_amt' => $this->input->post('amount') * -1,
                        'debtor_creditor_rowID' => $this->input->post('driver'),
                        'recon_status' => 'N',
                        'recon_date' => '1901-01-01',
                        'cg_void_status' => 'A',
                        'user_created' => $this->session->userdata('user_rowID'),
                        'date_created' => date('Y-m-d'),
                        'time_created' => date('H:i:s'));


                    $new_gl_coa_code = ((int)$this->appmodel->select_max_id('gl_trx_hdr', $array =
                        array(
                        'prefix' => $sa_spec_prefix,
                        'year' => $cash_out_year,
                        'month' => $cash_out_month,
                        'deleted' => 0), 'code')) + 1;

                    $gl_coa_no = $sa_spec_prefix . sprintf("%04s", $cash_out_year) . sprintf("%02s",
                        $cash_out_month) . sprintf("%05s", $new_gl_coa_code);


                    $gl_trx_hdr_data = array(
                        'prefix' => $sa_spec_prefix,
                        'year' => $cash_out_year,
                        'month' => $cash_out_month,
                        'code' => $new_gl_coa_code,
                        'journal_no' => $gl_coa_no,
                        'journal_date' => $cash_advance_date,
                        'descs' => ($this->input->post('cash_advance_desc') == "") ? strtoupper($advance_name .
                            ' A/N ' . $debtor_name) : strtoupper($advance_name . ' A/N ' . $debtor_name .
                            ', ' . $this->input->post('cash_advance_desc')),
                        'trx_amt' => $this->input->post('amount'),
                        'ref_prefix' => $cash_out_prefix_cd,
                        'ref_year' => $cash_out_year,
                        'ref_month' => $cash_out_month,
                        'ref_code' => $new_cash_advance_code,
                        'ref_no' => $cash_advance_no,
                        'ref_date' => $cash_advance_date,
                        'user_created' => $this->session->userdata('user_rowID'),
                        'date_created' => date('Y-m-d'),
                        'time_created' => date('H:i:s'));

                    $gl_trx_dtl_d_data = array(
                        'gl_trx_hdr_prefix' => $sa_spec_prefix,
                        'gl_trx_hdr_year' => $cash_out_year,
                        'gl_trx_hdr_month' => $cash_out_month,
                        'gl_trx_hdr_code' => $new_gl_coa_code,
                        'row_no' => 1,
                        'gl_trx_hdr_journal_no' => $gl_coa_no,
                        'gl_trx_hdr_journal_date' => $cash_advance_date,
                        'coa_rowID' => $receiveable_rowID,
                        'descs' => ($this->input->post('cash_advance_desc') == "") ? strtoupper($advance_name .
                            ' A/N ' . $debtor_name) : strtoupper($advance_name . ' A/N ' . $debtor_name .
                            ', ' . $this->input->post('cash_advance_desc')),
                        'trx_amt' => $this->input->post('amount'),
                        'dep_rowID' => $this->session->userdata('dep_rowID'),
                        'debtor_creditor_rowID' => $this->input->post('driver'),
                        'gl_trx_hdr_ref_prefix' => $cash_out_prefix_cd,
                        'gl_trx_hdr_ref_year' => $cash_out_year,
                        'gl_trx_hdr_ref_month' => $cash_out_month,
                        'gl_trx_hdr_ref_code' => $new_cash_advance_code,
                        'gl_trx_hdr_ref_no' => $cash_advance_no,
                        'gl_trx_hdr_ref_date' => $cash_advance_date,
                        'modul' => 'CB',
                        'cash_flow' => 'Y',
                        'base_amt' => 0,
                        'tax_no' => '',
                        'user_created' => $this->session->userdata('user_rowID'),
                        'date_created' => date('Y-m-d'),
                        'time_created' => date('H:i:s'));


                    $gl_trx_dtl_k_data = array(
                        'gl_trx_hdr_prefix' => $sa_spec_prefix,
                        'gl_trx_hdr_year' => $cash_out_year,
                        'gl_trx_hdr_month' => $cash_out_month,
                        'gl_trx_hdr_code' => $new_gl_coa_code,
                        'row_no' => 2,
                        'gl_trx_hdr_journal_no' => $gl_coa_no,
                        'gl_trx_hdr_journal_date' => $cash_advance_date,
                        'coa_rowID' => $cash_gl_rowID,
                        'descs' => ($this->input->post('cash_advance_desc') == "") ? strtoupper($advance_name .
                            ' A/N ' . $debtor_name) : strtoupper($advance_name . ' A/N ' . $debtor_name .
                            ', ' . $this->input->post('cash_advance_desc')),
                        'trx_amt' => $this->input->post('amount') * -1,
                        'dep_rowID' => $this->session->userdata('dep_rowID'),
                        'debtor_creditor_rowID' => $this->input->post('driver'),
                        'gl_trx_hdr_ref_prefix' => $cash_out_prefix_cd,
                        'gl_trx_hdr_ref_year' => $cash_out_year,
                        'gl_trx_hdr_ref_month' => $cash_out_month,
                        'gl_trx_hdr_ref_code' => $new_cash_advance_code,
                        'gl_trx_hdr_ref_no' => $cash_advance_no,
                        'gl_trx_hdr_ref_date' => $cash_advance_date,
                        'modul' => 'CB',
                        'cash_flow' => 'Y',
                        'base_amt' => 0,
                        'tax_no' => '',
                        'user_created' => $this->session->userdata('user_rowID'),
                        'date_created' => date('Y-m-d'),
                        'time_created' => date('H:i:s'));


                    //$this->db->trans_off();
                    $this->db->trans_begin(); # Starting Transaction
                    //$this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well

                    $this->db->insert('cb_cash_adv', $cash_advance_data);
                    $this->db->insert('cb_trx_hdr', $cb_trx_data);
                    $this->db->insert('gl_trx_hdr', $gl_trx_hdr_data);
                    $this->db->insert('gl_trx_dtl', $gl_trx_dtl_d_data);
                    $this->db->insert('gl_trx_dtl', $gl_trx_dtl_k_data);


                    if ($this->db->trans_status() === false)
                    {
                        # Something went wrong.
                        $this->db->trans_rollback();

                        $params['user_rowID'] = $this->tank_auth->get_user_id();
                        $params['module'] = 'ERROR ROLLBACK Finances->Cash Advance';
                        $params['module_field_id'] = $new_cash_advance_code;
                        $params['activity'] = ucfirst('Added a new cash advance no. ' . $cash_advance_no);
                        $params['icon'] = 'fa-exclamation-triangle';
                        modules::run('activitylog/log', $params); //log activity
                        $this->session->set_flashdata('response_status', 'error');
                        $this->session->set_flashdata('message',
                            'Please Input Again, The DATA was ROLLBACK!!!');
                        redirect('finances/create_cash_advance');
                        //return FALSE;
                    } else
                    {
                        # Everything is Perfect.
                        # Committing data to the database.


                        $this->db->trans_commit();

                        $params['user_rowID'] = $this->tank_auth->get_user_id();
                        $params['module'] = 'Finances->Cash Advance';
                        $params['module_field_id'] = $new_cash_advance_code;
                        $params['activity'] = ucfirst('Added a new cash advance no. ' . $cash_advance_no);
                        $params['icon'] = 'fa-plus';
                        modules::run('activitylog/log', $params); //log activity

                        $params['user_rowID'] = $this->tank_auth->get_user_id();
                        $params['module'] = 'Finances->Cash Book';
                        $params['module_field_id'] = $new_cash_advance_code;
                        $params['activity'] = ucfirst('Added a new cash book no. ' . $cash_advance_no);
                        $params['icon'] = 'fa-plus';
                        modules::run('activitylog/log', $params); //log activity

                        $params['user_rowID'] = $this->tank_auth->get_user_id();
                        $params['module'] = 'Finances->General Ledger';
                        $params['module_field_id'] = $new_gl_coa_code;
                        $params['activity'] = ucfirst('Added a new gl coa no. ' . $gl_coa_no);
                        $params['icon'] = 'fa-plus';
                        modules::run('activitylog/log', $params); //log activity

                        //printing .................
                        //if(trim($this->session->userdata('printer_default'))!='NO PRINT'){
                        //$sjk_detail= $this->finances->sjk_details($sj_id);

                        //if(!empty($sjk_detail)){
                        //foreach($sjk_detail as $row){


                        /*
                        $form_data = array(
                        'printed'	=>	1,
                        'user_print'=>	$this->session->userdata('user_id'),
                        'print_date'=>	date('Y-m-d'),
                        'print_time'=>	date('H:i:s'),							
                        );
                        
                        $this->db->where('sj_id',$sj_id)->update('trx_sj', $form_data);	
                        }}}	 */

                        //return TRUE;
                        $this->session->set_flashdata('response_status', 'success');
                        $this->session->set_flashdata('message', lang('cash_advance') . ' ' . lang('created_succesfully') .
                            '. Cash Advance No.  ' . $cash_advance_no);
                        redirect('finances/cash_advance_list');
                    }

                } else
                {
                    $this->session->set_flashdata('response_status', 'error');
                    $this->session->set_flashdata('message', 'Please Choose the Advance Type First');
                    redirect('finances/create_cash_advance');
                }

            }
        } else
        {
            $this->load->module('layouts');
            $this->load->library('template');
            $data['page'] = lang('cash_advance');
            $this->session->set_userdata('page_header', 'transaction');
            $this->session->set_userdata('page_detail', 'cash_advance');
            $data['form'] = true;

            $data['cash_advance_types'] = $this->appmodel->get_all_records($table =
                'sa_advance_type', $array = array('deleted' => 0), $join_table = '', $join_criteria =
                '', 'rowID', 'ASC');

            $this->template->set_layout('users')->build('create_cash_advance', isset($data) ?
                $data : null);
        }
    }
    
    function print_ca($rowID)
    {
        $all_data = $this->finances_model->get_all_records_list_by_id($rowID);
        $print = false;
        
        if($this->user_profile->get_user_access_alternative('finances/cash_advance_list','PrintLimited') == 1 || $this->user_profile->get_user_access_alternative('finances/cash_advance_list','PrintUnlimited') == 1 || 
                $this->user_profile->get_user_access_alternative('finances/cash_advance_list','PrintOne') == 1 || $this->user_profile->get_user_access_alternative('finances/cash_advance_list','PrintTwo') == 1 || 
                $this->user_profile->get_user_access_alternative('finances/cash_advance_list_branch','PrintLimited') == 1 || $this->user_profile->get_user_access_alternative('finances/cash_advance_list_branch','PrintUnlimited') == 1 || 
                $this->user_profile->get_user_access_alternative('finances/cash_advance_list_branch','PrintOne') == 1 || $this->user_profile->get_user_access_alternative('finances/cash_advance_list_branch','PrintTwo') == 1){
                    if($this->user_profile->get_user_access_alternative('finances/cash_advance_list','PrintLimited') == 1 || $this->user_profile->get_user_access_alternative('finances/cash_advance_list_branch','PrintLimited') == 1){
                        if($this->user_profile->get_log_limited_printed($all_data->advance_no,'Print Cash Advance') == 0){
                            $print = true;
                        }
                    }
                    else{
                        $print = true;
                    }
        }
        
        if($print == true){

            // Update data printed
            $this->finances_model->update_cash_advance_printed($rowID);
            
            // Insert to log
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Print Cash Advance';
            $params['module_field_id'] = $all_data->rowID;
            $params['activity'] = ucfirst('Print cash advance no. ' . $all_data->advance_no);
            $params['icon'] = 'fa-print';
            modules::run('activitylog/log', $params); //log activity        
    
            $data['all_data'] = $all_data;
            
            //$this->load->view('view_detail_pdf', $data);
            $html = $this->load->view('view_detail_pdf', $data, true);
                
            $this->pdf_generator->generate($html, 'cash advance pdf',$orientation='Portrait');  
        }
        else{
            $this->session->set_flashdata('error',lang('not_have_access'));
            redirect(base_url().'finances/view_cash_advance/'.$rowID);
        }
        
    }
    
    /* 
    //Print langsung kodingan
    function print_ca($rowID)
    {
        $all_data = $this->finances_model->get_all_records_list_by_id($rowID);
        
        // Update data printed
        $this->finances_model->update_cash_advance_printed($rowID);
        
        // Insert to log
        $params['user_rowID'] = $this->tank_auth->get_user_id();
        $params['module'] = 'Print Cash Advance';
        $params['module_field_id'] = $all_data->code;
        $params['activity'] = ucfirst('Print cash advance no. ' . $all_data->advance_no);
        $params['icon'] = 'fa-print';
        modules::run('activitylog/log', $params); //log activity        
                        
        $tmpdir = sys_get_temp_dir(); # ambil direktori temporary untuk simpan file.
        $file = tempnam($tmpdir, 'sj' . 'print_cash_advance'); # nama file temporary yang akan dicetak
        $handle = fopen($file, 'w');
        $condensed = Chr(27) . Chr(33) . Chr(4);
        $font0 = Chr(27) . Chr(33) . Chr(4);
        $font1 = Chr(27) . Chr(33) . Chr(16);
        $font2 = Chr(27) . Chr(33) . Chr(32);
        $bold1 = Chr(27) . Chr(69);
        $bold0 = Chr(27) . Chr(70);
        $font2 = Chr(27) . Chr(119) . Chr(1);
        $font3 = Chr(27) . Chr(119) . Chr(0);

        $initialized = chr(27) . chr(64);
        $condensed1 = chr(15);
        $condensed0 = chr(18);
        $Data = $initialized;
        //$Data .= '1234567890123456789012345678901234567890' . "\n\n";
        //$Data .= $condensed1;
        //$Data .= $font1.$bold1.'1234567890123456789012345678901234567890'.$bold0.$font0."\n\n";
        //$Data .= $font0.$bold0.'12345678901234567890123456789012345678901234567890123456789012345678901234567890'.$bold0.$font0."\n\n";
        if($all_data->advance_type_rowID == '1'){
            $Data .= $font1.$bold1.sprintf("%-43s",lang('bukti_pengeluaran_kas')).sprintf("%-37s",lang('surat_perintah_kerja')).$bold0."\n\n\n";
            $Data .= sprintf("%-18s",lang('kas')).sprintf("%-2s",":").sprintf("%-23s",$all_data->dep_name).sprintf("%-16s",lang('site')).sprintf("%-2s",":").sprintf("%-19s",$all_data->dep_name)."\n\n";
            $Data .= sprintf("%-18s",lang('tipe_transaksi')).sprintf("%-2s",":").sprintf("%-23s",$all_data->advance_name)."\n";
            $Data .= sprintf("%-18s",lang('no_ref')).sprintf("%-2s",":").sprintf("%-23s",$all_data->advance_no).sprintf("%-16s",lang('no_ref')).sprintf("%-2s",":").sprintf("%-19s",$all_data->advance_no)."\n";
            $Data .= sprintf("%-18s",lang('dari_ke')).sprintf("%-2s",":").sprintf("%-23s",$all_data->destination_from_name.' - '.$all_data->destination_to_name).sprintf("%-16s",lang('dari_ke')).sprintf("%-2s",":").sprintf("%-19s",$all_data->destination_from_name.' - '.$all_data->destination_to_name)."\n";
            $Data .= sprintf("%-18s",lang('no_pol')).sprintf("%-2s",":").sprintf("%-23s",$all_data->police_no != '' ? $all_data->police_no : '-').sprintf("%-16s",lang('no_pol')).sprintf("%-2s",":").sprintf("%-19s",$all_data->police_no != '' ? $all_data->police_no : '-')."\n";
            $Data .= sprintf("%-18s",lang('tipe_kendaraan')).sprintf("%-2s",":").sprintf("%-23s",$all_data->type_name != '' ? $all_data->type_name : '-').sprintf("%-16s",lang('tipe_kendaraan')).sprintf("%-2s",":").sprintf("%-19s",$all_data->type_name != '' ? $all_data->type_name : '-')."\n\n\n";
            $Data .= sprintf("%-18s",lang('dibayarkan_kepada')).sprintf("%-2s",":").sprintf("%-23s",strtoupper($all_data->debtor_name)).sprintf("%-16s",lang('nama_supir')).sprintf("%-2s",":").sprintf("%-19s",strtoupper($all_data->debtor_name))."\n";
            $Data .= sprintf("%-18s",lang('sejumlah_uang')).sprintf("%-2s",":").sprintf("%-23s","Rp ".number_format($all_data->advance_amount + $all_data->advance_extra_amount,0,',','.'))."\n\n\n";
            $Data .= sprintf("%-18s",lang('keterangan')).sprintf("%-2s",":").sprintf("%-23s",$all_data->description != '' ? $all_data->description : '-')."\n\n\n";
            $Data .= sprintf("%-24s",lang('pemegang_kas').",").sprintf("%-16s",lang('penerima').",").sprintf("%-24s"," ").sprintf("%-16s",lang('petugas').",")."\n\n\n\n\n";
            $Data .= sprintf("%-24s",strtoupper($this->tank_auth->get_username())).sprintf("%-16s",strtoupper($all_data->debtor_name)).sprintf("%-24s"," ").sprintf("%-16s",strtoupper($this->tank_auth->get_username()))."\n\n";
            $Data .= sprintf("%40s",$all_data->advance_no."-".date("d/m/Y")).sprintf("%40s",$all_data->advance_no."-".date("d/m/Y")).$font0."\n\n";
            $Data .= sprintf("%67s",lang('dicetak_oleh')." : ".strtoupper($this->tank_auth->get_username()).", ".lang('tanggal')." : ".date("d/m/Y H:i:s")).sprintf("%69s",lang('dicetak_oleh')." : ".strtoupper($this->tank_auth->get_username()).", ".lang('tanggal')." : ".date("d/m/Y H:i:s"))."\n\n";
        }
        else{
            $Data .= $font1.$bold1.sprintf("%-43s",lang('bukti_pengeluaran_kas')).sprintf("%-37s",'').$bold0."\n\n\n";
            $Data .= sprintf("%-18s",lang('kas')).sprintf("%-2s",":").sprintf("%-23s",$all_data->dep_name).sprintf("%-16s",'').sprintf("%-2s","").sprintf("%-19s",'')."\n\n";
            $Data .= sprintf("%-18s",lang('tipe_transaksi')).sprintf("%-2s",":").sprintf("%-23s",$all_data->advance_name)."\n";
            $Data .= sprintf("%-18s",lang('no_ref')).sprintf("%-2s",":").sprintf("%-23s",$all_data->advance_no).sprintf("%-16s",'').sprintf("%-2s","").sprintf("%-19s",'')."\n";
            $Data .= sprintf("%-18s",lang('dari_ke')).sprintf("%-2s",":").sprintf("%-23s",$all_data->destination_from_name.' - '.$all_data->destination_to_name).sprintf("%-16s",'').sprintf("%-2s","").sprintf("%-19s",'')."\n";
            $Data .= sprintf("%-18s",lang('no_pol')).sprintf("%-2s",":").sprintf("%-23s",$all_data->police_no != '' ? $all_data->police_no : '-').sprintf("%-16s",'').sprintf("%-2s","").sprintf("%-19s",'')."\n";
            $Data .= sprintf("%-18s",lang('tipe_kendaraan')).sprintf("%-2s",":").sprintf("%-23s",$all_data->type_name != '' ? $all_data->type_name : '-').sprintf("%-16s",'').sprintf("%-2s","").sprintf("%-19s",'')."\n\n\n";
            $Data .= sprintf("%-18s",lang('dibayarkan_kepada')).sprintf("%-2s",":").sprintf("%-23s",strtoupper($all_data->debtor_name)).sprintf("%-16s",'').sprintf("%-2s","").sprintf("%-19s",'')."\n";
            $Data .= sprintf("%-18s",lang('sejumlah_uang')).sprintf("%-2s",":").sprintf("%-23s","Rp ".number_format($all_data->advance_amount + $all_data->advance_extra_amount,0,',','.'))."\n\n\n";
            $Data .= sprintf("%-18s",lang('keterangan')).sprintf("%-2s",":").sprintf("%-23s",$all_data->description != '' ? $all_data->description : '-')."\n\n\n";
            $Data .= sprintf("%-24s",lang('pemegang_kas').",").sprintf("%-16s",lang('penerima').",").sprintf("%-24s"," ").sprintf("%-16s",'')."\n\n\n\n\n";
            $Data .= sprintf("%-24s",strtoupper($this->tank_auth->get_username())).sprintf("%-16s",strtoupper($all_data->debtor_name)).sprintf("%-24s"," ").sprintf("%-16s",'')."\n\n";
            $Data .= sprintf("%40s",$all_data->advance_no."-".date("d/m/Y")).sprintf("%40s",$all_data->advance_no."-".date("d/m/Y")).$font0."\n\n";
            $Data .= sprintf("%67s",lang('dicetak_oleh')." : ".strtoupper($this->tank_auth->get_username()).", ".lang('tanggal')." : ".date("d/m/Y H:i:s")).sprintf("%69s",lang('dicetak_oleh')." : ".strtoupper($this->tank_auth->get_username()).", ".lang('tanggal')." : ".date("d/m/Y H:i:s"))."\n\n";            
        }
        //$Data .= sprintf("%80s","12345678901234567890123456789012345678901234567890123456789012345678901234567890").sprintf("%80s",lang('dicetak_oleh')." : ".strtoupper($this->tank_auth->get_username()).", ".lang('tanggal')." : ".date("d/m/Y H:i:s"))."\n\n";
        fwrite($handle, $Data);
        fclose($handle);
        copy($file, "//200.10.10.233/EPS-LQ-310"); # Lakukan cetak   Printer -> EPS-LX310
        unlink($file);
        redirect('finances/cash_advance_list');
    }
    */
    
    function get_detail_all_faretrip()
    {
        $fare_trips = $this->fare_trip_model->get_all_record_data_active();

        if (count($fare_trips) > 0)
        {
            header('Content-Type: application/json');
            foreach ($fare_trips as $fare_trip)
            {
                if ($fare_trip->trip_type == '1')
                    $trip_type = "BULK";
                else
                    if ($fare_trip->trip_type == '2')
                        $trip_type = "CONTAINER";
                    else
                        $trip_type = "OTHERS";

                $get_vehicle = $this->vehicle_category_model->get_by_id('sa_vehicle_type', $fare_trip->
                    vehicle_id);
                $get_cost_code = $this->cost_code_model->get_by_id('sa_cost', $fare_trip->
                    cost_id);


                $arr[] = array(
                    'fare_trip_id' => $fare_trip->rowID,
                    'fare_trip_cd' => $fare_trip->fare_trip_cd,
                    'vehicle_type_id' => $fare_trip->vehicle_id,
                    'type_name' => strtoupper($get_vehicle->type_name),
                    'vehicle_type' => strtoupper($get_vehicle->vehicle_type),
                    'fare_trip_desc' => $fare_trip->destination_from . ' ' . lang('to') . ' ' . $fare_trip->
                        destination_to,
                    'destination_from' => $fare_trip->destination_from,
                    'destination_to' => $fare_trip->destination_to,
                    'trip_type' => $trip_type,
                    'split' => $fare_trip->split,
                    'trip_condition' => strtoupper($fare_trip->trip_condition),
                    'total' => number_format($fare_trip->total, 0, ',', '.'),
                    'descs' => strtoupper($get_cost_code->descs),
                    'distance' => number_format($fare_trip->distance, 0, ',', '.'),
                    'min_amount' => number_format($fare_trip->min_amount, 0, ',', '.'),
                    'os_amount' => number_format($fare_trip->os_amount, 0, ',', '.')
                );
            }
            header('Content-type: application/json');
            echo json_encode($arr);

        }
        else{
            header('Content-type: application/json');
            echo json_encode(array());
        }

        exit;
    }
    
    function get_data_vehicle_position(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        
        $vehicle_id = $this->input->post('vehicle_id');
        $vehicle_position = $this->finances_model->get_position_vehicle_by_row_id($vehicle_id);
        $status = '';
        $color = '';
        if($vehicle_position->status == '11' && $vehicle_position->speed > 0 ){
            $status = 'Jalan';
            $color = "background-color:#5cb85c;";
        }
        else if($vehicle_position->status == '11' && $vehicle_position->speed <= 0 ){
            $status = 'Macet/Antri/Parkir';
            $color = "background-color:#eac545;";
        }
        else if($vehicle_position->status == '01' && $vehicle_position->speed <= 0 ){
            $status = 'Makan AKI';
            $color = "background-color:#57b9f8;";
        }
        else if($vehicle_position->status == '00' && $vehicle_position->speed <= 0 ){
            $status = 'Berhenti';
            $color = "background-color:#f94c4c;";
        }
        else if($vehicle_position->status == '10' && $vehicle_position->speed > 0 ){
            $status = 'Check Instalasi ACC & Engine';
            $color = "background-color:#000;";
        }
        else if($vehicle_position->status == '10' && $vehicle_position->speed <= 0 ){
            $status = 'Mohon diperiksa';
            $color = "background-color:#1BDAC5;";
        }
        else{
            $status = 'Data Tidak Tersedia';
            $color = "background-color:#B0B0B0;";
        }

        $data_vehicle = array(
            'police_no' => $vehicle_position->police_no,
            'status' => $status,
            'position' => $vehicle_position->latitude.",".$vehicle_position->longitude,
            'latitude' => $vehicle_position->latitude,
            'longitude' => $vehicle_position->longitude,
            'time_gps' => $vehicle_position->time_gps,            
        );
        
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($data_vehicle);
        exit;
    }
    
    function get_data_vehicle(){
        $vehicle_type = $this->input->post('vehicle_type');
        
        $vehicle = $this->finances_model->get_all_records('sa_vehicle', $array =
            array('rowID >' => 0, 'deleted' => 0, 'vehicle_type' => $vehicle_type), $join_table = '', $join_criteria = '', 'police_no', 'asc');
        
        echo '<option value="">'.lang('select').' '.lang('vehicle').'</option>';
        if (!empty($vehicle)) {
            foreach ($vehicle as $row) {
		      echo '<option value="'.$row->rowID.'">'.$row->police_no.' - '.$row->vehicle_type.'</option>';
            }
        }

        exit;
    }
    
    function get_detail_faretrip()
    {
        error_reporting(E_ALL);
        $fare_trips = $this->fare_trip_model->get_all_fare_trip();

        if (!empty($fare_trips))
        {
            header('Content-Type: application/json');
            foreach ($fare_trips as $fare_trip)
            {
                $arr[] = array('rowID' => $fare_trip->rowID, 'fare_trip_no' => $fare_trip->
                        fare_trip_cd);
            }
            header('Content-type: application/json');
            echo json_encode($arr);
        }

        exit; // no need to render the template
    }

    function get_detail_vehicle()
    {
        error_reporting(E_ALL);
        $vehicles = $this->appmodel->get_all_records($table = 'sa_vehicle', $array =
            array(
            'rowID >' => 0,
            'deleted' => 0,
            'status' => 0), $join_table = '', $join_criteria = '', 'police_no', 'ASC');

        if (!empty($vehicles))
        {
            header('Content-Type: application/json');
            foreach ($vehicles as $vehicle)
            {
                $arr[] = array('rowID' => $vehicle->rowID, 'police_no' => $vehicle->police_no);
            }
        } else
        {
            $arr[] = '';
        }
        header('Content-type: application/json');
        echo json_encode($arr);
        exit; // no need to render the template
    }

    function get_detail_vehicle_category()
    {
        error_reporting(E_ALL);
        $vehicle_categories = $this->appmodel->get_all_records($table =
            'sa_vehicle_type', $array = array('rowID >' => 0, 'deleted' => 0), $join_table =
            '', $join_criteria = '', 'type_name', 'ASC');

        if (!empty($vehicle_categories))
        {
            header('Content-Type: application/json');
            foreach ($vehicle_categories as $vehicle_category)
            {
                $arr[] = array(
                    'rowID' => $vehicle_category->rowID,
                    'type_cd' => $vehicle_category->type_cd,
                    'type_name' => $vehicle_category->type_name);
            }
        } else
        {
            $arr[] = '';
        }
        header('Content-type: application/json');
        echo json_encode($arr);
        exit; // no need to render the template
    }

    function get_detail_driver()
    {
        error_reporting(E_ALL);
        $drivers = $this->appmodel->get_all_records($table = 'sa_debtor', $array = array
            (
            'rowID >' => 0,
            'deleted' => 0,
            'type' => 'D'), $join_table = '', $join_criteria = '', 'debtor_name', 'ASC');

        if (!empty($drivers))
        {
            header('Content-Type: application/json');
            foreach ($drivers as $driver)
            {
                $arr[] = array('rowID' => $driver->rowID, 'name' => $driver->debtor_name);
            }
        } else
        {
            $arr[] = '';
        }
        header('Content-type: application/json');
        echo json_encode($arr);
        exit; // no need to render the template
    }

    function get_detail_employee()
    {
        error_reporting(E_ALL);
        $employees = $this->appmodel->get_all_records($table = 'sa_debtor', $array =
            array(
            'rowID >' => 0,
            'deleted' => 0,
            'type' => 'E'), $join_table = '', $join_criteria = '', 'debtor_name', 'ASC');

        if (!empty($employees))
        {
            header('Content-Type: application/json');
            foreach ($employees as $employee)
            {
                $arr[] = array('rowID' => $employee->rowID, 'name' => $employee->debtor_name);
            }
        } else
        {
            $arr[] = '';
        }
        header('Content-type: application/json');
        echo json_encode($arr);
        exit; // no need to render the template
    }

    function verify_password()
    {

        $this->load->model('tank_auth/users');
        $user_id = $this->session->userdata('user_id');

        if (!is_null($user = $this->users->get_user_by_id($user_id, true)))
        {
            // Cek usermenu by user
            $get_user = $this->finances_model->get_verify_user();
            $status_password = false;
            
            foreach($get_user as $row_user){
                // Check if password correct
                $password = $this->input->post('password');
                $hasher = new PasswordHash($this->config->item('phpass_hash_strength',
                    'tank_auth'), $this->config->item('phpass_hash_portable', 'tank_auth'));
                if ($hasher->CheckPassword($password, $row_user->password))
                { // success
                    $this->finances_model->updateQueue($this->input->post('queue_id_verify'), null, null);
                    
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
    
    function get_memo($advance_no)
    {
        $memos = $this->finances_model->get_memo_by_advance_no($advance_no);

        if (count($memos) > 0)
        {
            header('Content-Type: application/json');
            foreach ($memos as $memo)
            {
                $arr[] = array(
                    'memo_date' => date('d-m-Y H:i:s',strtotime($memo->date_created)),
                    'memo_description' => $memo->memo_description
                );
            }
            header('Content-type: application/json');
            echo json_encode($arr);

        }
        else{
            header('Content-type: application/json');
            echo json_encode(array());
        }

        exit;
    }
    
    function save_memo(){
        $dataPost = $this->input->post();
        //echo "<pre>"; print_r($dataPost); echo "</pre>"; exit();
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');

        $data_memo = array(
            'advance_no' => $dataPost['memo_advance_no'],
            'memo_description' => ucfirst($dataPost['memo_description']),
            'user_created' => $this->session->userdata('user_id'),
            'date_created' => date('Y-m-d H:i:s')
        );
        $this->db->insert('cb_memo', $data_memo);
        $memo_id = $this->db->insert_id();

        $params['user_rowID'] = $this->tank_auth->get_user_id();
        $params['module'] = 'Cash Advance - Memo';
        $params['module_field_id'] = $memo_id;
        $params['activity'] = ucfirst('Added a memo Cash Advance No ' . $dataPost['memo_advance_no']);
        $params['icon'] = 'fa-plus';
        modules::run('activitylog/log', $params); //log activity
        
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode(array("success" => true, 'msg' => lang('created_succesfully')));
        exit();

        
    }
    
    function update_job_order()
    {

        if ($this->input->post())
        {

            $year = $this->input->post('job_order_year');
            $month = $this->input->post('job_order_month');
            $code = $this->input->post('job_order_code');
            $job_order_no = $this->input->post('job_order_no');

            //$this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<span style="color:red">',
                '</span><br>');
            $this->form_validation->set_rules('job_order_type', 'Type', 'required|numeric');
            $this->form_validation->set_rules('debtor', 'Debtor', 'required|numeric');
            $this->form_validation->set_rules('po_spk_no', 'PO/SPK No', 'required');
            $this->form_validation->set_rules('port', 'Port', 'required|numeric');
            $this->form_validation->set_rules('item', 'Item', 'required|numeric');
            $this->form_validation->set_rules('weight_item', 'Weight Item',
                'required|numeric');
            $this->form_validation->set_rules('fare_trip', 'Fare Trip', 'required|numeric');
            $this->form_validation->set_rules('job_order_price', 'Price', 'required|numeric');


            if ($this->form_validation->run() == false)
            {
                $this->session->set_flashdata('response_status', 'error');
                $this->session->set_flashdata('message', lang('error_in_form'));
                redirect('job_order/update_job_order/' . $year . '/' . $month . '/' . $code);
            } else
            {

                if ($this->input->post('job_order_type') == 2)
                {
                    $cek_container_filled_20ft = true;
                    $cek_container_filled_40ft = true;
                    $cek_container_filled_45ft = true;
                    if ($this->input->post('job_order_total_20ft') != 0)
                    {
                        if (!$this->input->post('job_order_price_20ft') != 0)
                        {
                            $cek_container_filled_20ft = false;
                        }
                    }
                    if ($this->input->post('job_order_total_40ft') != 0)
                    {
                        if (!$this->input->post('job_order_price_40ft') != 0)
                        {
                            $cek_container_filled_40ft = false;
                        }
                    }
                    if ($this->input->post('job_order_total_45ft') != 0)
                    {
                        if (!$this->input->post('job_order_price_45ft') != 0)
                        {
                            $cek_container_filled_45ft = false;
                        }
                    }


                    if (!$cek_container_filled_20ft)
                    {
                        $this->session->set_flashdata('response_status', 'error');
                        $this->session->set_flashdata('message', lang('error_in_container_filled') .
                            '20');
                        redirect('job_order/update_job_order/' . $year . '/' . $month . '/' . $code);
                    }
                    if (!$cek_container_filled_40ft)
                    {
                        $this->session->set_flashdata('response_status', 'error');
                        $this->session->set_flashdata('message', lang('error_in_container_filled') .
                            '40');
                        redirect('job_order/update_job_order/' . $year . '/' . $month . '/' . $code);
                    }
                    if (!$cek_container_filled_45ft)
                    {
                        $this->session->set_flashdata('response_status', 'error');
                        $this->session->set_flashdata('message', lang('error_in_container_filled') .
                            '45');
                        redirect('job_order/update_job_order/' . $year . '/' . $month . '/' . $code);
                    }
                }
                $job_order_data = array(
                    'jo_type' => $this->input->post('job_order_type'),
                    'debtor_rowID' => $this->input->post('debtor'),
                    'po_spk_no' => strtoupper(trim($this->input->post('po_spk_no'))),
                    'so_no' => strtoupper(trim($this->input->post('so_no'))),
                    'port_rowID' => $this->input->post('port'),
                    'vessel_rowID' => 0,
                    'vessel_no' => strtoupper(trim($this->input->post('vessel_no'))),
                    'vessel_name' => strtoupper(trim($this->input->post('vessel_name'))),
                    'item_rowID' => $this->input->post('item'),
                    'weight' => $this->input->post('weight_item'),
                    'fare_trip_rowID' => $this->input->post('fare_trip'),
                    'wholesale' => ($this->input->post('job_order_wholesale_yes_no') == 'on') ? 1 :
                        0,
                    'price_amount' => $this->input->post('job_order_price'),
                    'description' => $this->input->post('job_order_desc'),
                    'container_20ft' => $this->input->post('job_order_total_20ft'),
                    'container_40ft' => $this->input->post('job_order_total_40ft'),
                    'container_45ft' => $this->input->post('job_order_total_45ft'),
                    'price_20ft' => $this->input->post('job_order_price_20ft'),
                    'price_40ft' => $this->input->post('job_order_price_40ft'),
                    'price_45ft' => $this->input->post('job_order_price_45ft'),
                    'user_modified' => $this->session->userdata('user_rowID'),
                    'date_modified' => date('Y-m-d'),
                    'time_modified' => date('H:i:s'));

                //$this->db->where(array('year' => $this->input->post('vessel_id'), 'vessel_status' => 1))->update('trx_sj', $form_data);
                $this->db->where('year', $year);
                $this->db->where('month', $month);
                $this->db->where('code', $code);
                $this->db->update('tr_jo_trx_hdr', $job_order_data);


                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'Job Order';
                $params['module_field_id'] = $code;
                $params['activity'] = ucfirst('Updated a job_order no : ' . $job_order_no);
                $params['icon'] = 'fa-pencil';
                modules::run('activitylog/log', $params); //log activity

                $this->session->set_flashdata('response_status', 'success');
                $this->session->set_flashdata('message', lang('job_order') . ' ' . lang('updated_succesfully'));
                redirect('job_order/update_job_order/' . $year . '/' . $month . '/' . $code);
            }
        } else
        {
            $this->load->module('layouts');
            $this->load->library('template');
            $data['form'] = true;

            $data['job_orders'] = $this->job_order_model->get_records_details($this->uri->
                segment(3), $this->uri->segment(4), $this->uri->segment(5));

            $data['jo_type'] = $this->job_order_model->get_all_records($table =
                'sa_reference', $array = array('type_ref' => 'jo_type'), $join_table = '', $join_criteria =
                '', 'type_no', 'ASC');

            $data['debtors'] = $this->job_order_model->get_all_records($table = 'sa_debtor',
                $array = array(
                'type' => 'C',
                'rowID >' => '0',
                'deleted' => '0'), $join_table = '', $join_criteria = '', 'debtor_name', 'ASC');

            $data['ports'] = $this->job_order_model->get_all_records($table = 'sa_port', $array =
                array('rowID >' => '0', 'deleted' => '0'), $join_table = '', $join_criteria = '',
                'port_name', 'ASC');

            $data['fare_trips'] = $this->job_order_model->get_all_fare_trip();

            $data['items'] = $this->job_order_model->get_all_records($table = 'sa_item', $array =
                array('rowID >' => '0', 'deleted' => '0'), $join_table = '', $join_criteria = '',
                'item_name', 'ASC');

            $this->template->set_layout('users')->build('update_job_order', isset($data) ? $data : null);
        }
    }

    function delete_cash_advance()
    {
        error_reporting(E_ALL);
        $ca_prefix = $this->encrypt->decode($this->uri->segment(3));
        $ca_year = $this->encrypt->decode($this->uri->segment(4));
        $ca_month = $this->encrypt->decode($this->uri->segment(5));
        $ca_code = $this->encrypt->decode($this->uri->segment(6));

//        print_r($ca_year);exit;
        
        if ($this->input->post())
        {

            $ca_prefix = $this->input->post('prefix');
            $ca_year = $this->input->post('year');
            $ca_month = $this->input->post('month');
            $ca_code = $this->input->post('code');
            $remark_deleted = ucfirst($this->input->post('remark_deleted'));

            $ca_no = $this->appmodel->get_id($table = 'cb_cash_adv', $array = array(
                'deleted' => 0,
                'prefix' => $ca_prefix,
                'year' => $ca_year,
                'month' => $ca_month,
                'code' => $ca_code), 'advance_no');
            $ca_desc = $this->appmodel->get_id($table = 'cb_cash_adv', $array = array(
                'deleted' => 0,
                'prefix' => $ca_prefix,
                'year' => $ca_year,
                'month' => $ca_month,
                'code' => $ca_code), 'description');
            $debtor_id = $this->appmodel->get_id($table = 'cb_cash_adv', $array = array(
                'deleted' => 0,
                'prefix' => $ca_prefix,
                'year' => $ca_year,
                'month' => $ca_month,
                'code' => $ca_code), 'employee_driver_rowID');
            $cash_advance_data = array(
                'remark_deleted' => $remark_deleted,
                'deleted' => 1,
                'user_deleted' => $this->session->userdata('user_rowID'),
                'date_deleted' => date('Y-m-d'),
                'time_deleted' => date('H:i:s'));

            $cash_book_data = array(
                'remark_deleted' => $remark_deleted,
                'deleted' => 1,
                'user_deleted' => $this->session->userdata('user_rowID'),
                'date_deleted' => date('Y-m-d'),
                'time_deleted' => date('H:i:s'));

            /*
            $sa_spec_prefix = $this->appmodel->get_id($table = 'sa_spec', $array = array('deleted' =>
                    0, 'rowID' => 1), 'memorial_jrn');

            $cash_gl_prefix = $this->appmodel->get_id($table = 'gl_trx_hdr', $array = array
                (
                'deleted' => 0,
                'ref_prefix' => $ca_prefix,
                'ref_year' => $ca_year,
                'ref_month' => $ca_month,
                'ref_code' => $ca_code), 'prefix');
            $cash_gl_year = $this->appmodel->get_id($table = 'gl_trx_hdr', $array = array(
                'deleted' => 0,
                'ref_prefix' => $ca_prefix,
                'ref_year' => $ca_year,
                'ref_month' => $ca_month,
                'ref_code' => $ca_code), 'year');
            $cash_gl_month = $this->appmodel->get_id($table = 'gl_trx_hdr', $array = array(
                'deleted' => 0,
                'ref_prefix' => $ca_prefix,
                'ref_year' => $ca_year,
                'ref_month' => $ca_month,
                'ref_code' => $ca_code), 'month');
            $cash_gl_code = $this->appmodel->get_id($table = 'gl_trx_hdr', $array = array(
                'deleted' => 0,
                'ref_prefix' => $ca_prefix,
                'ref_year' => $ca_year,
                'ref_month' => $ca_month,
                'ref_code' => $ca_code), 'code');

            $cash_gl_no = $this->appmodel->get_id($table = 'gl_trx_hdr', $array = array(
                'deleted' => 0,
                'prefix' => $cash_gl_prefix,
                'year' => $cash_gl_year,
                'month' => $cash_gl_month,
                'code' => $cash_gl_code), 'journal_no');
            $cash_gl_date = $this->appmodel->get_id($table = 'gl_trx_hdr', $array = array(
                'deleted' => 0,
                'prefix' => $cash_gl_prefix,
                'year' => $cash_gl_year,
                'month' => $cash_gl_month,
                'code' => $cash_gl_code), 'journal_date');
            
            $gl_year = date('Y');
            $gl_month = date('m');
            $gl_date = date('Y-m-d');

            $new_gl_coa_code = ((int)$this->appmodel->select_max_id('gl_trx_hdr', $array =
                array(
                'prefix' => $sa_spec_prefix,
                'year' => $gl_year,
                'month' => $gl_month,
                'deleted' => 0), 'code')) + 1;

            $gl_coa_no = $sa_spec_prefix . sprintf("%04s", $gl_year) . sprintf("%02s", $gl_month) .
                sprintf("%05s", $new_gl_coa_code);

            $gl_trx_hdr_data = array(
                'prefix' => $sa_spec_prefix,
                'year' => $gl_year,
                'month' => $gl_month,
                'code' => $new_gl_coa_code,
                'journal_no' => $gl_coa_no,
                'journal_date' => $gl_date,
                'descs' => $this->appmodel->get_id('gl_trx_hdr', $array = array(
                    'prefix' => $cash_gl_prefix,
                    'year' => $cash_gl_year,
                    'month' => $cash_gl_month,
                    'code' => $cash_gl_code), 'descs'),
                'trx_amt' => $this->appmodel->get_id('gl_trx_hdr', $array = array(
                    'prefix' => $cash_gl_prefix,
                    'year' => $cash_gl_year,
                    'month' => $cash_gl_month,
                    'code' => $cash_gl_code), 'trx_amt'),
                'ref_prefix' => $cash_gl_prefix,
                'ref_year' => $cash_gl_year,
                'ref_month' => $cash_gl_month,
                'ref_code' => $cash_gl_code,
                'ref_no' => $cash_gl_no,
                'ref_date' => $cash_gl_date,
                'user_created' => $this->session->userdata('user_rowID'),
                'date_created' => date('Y-m-d'),
                'time_created' => date('H:i:s'));

            $gl_details = $this->appmodel->get_all_records($table = 'gl_trx_dtl', $array =
                array(
                'gl_trx_hdr_prefix ' => $cash_gl_prefix,
                'gl_trx_hdr_year' => $cash_gl_year,
                'gl_trx_hdr_month' => $cash_gl_month,
                'gl_trx_hdr_code' => $cash_gl_code), $join_table = '', $join_criteria = '',
                'row_no', 'ASC');

            if (!empty($gl_details))
            {
                foreach ($gl_details as $gl_detail)
                {

                    $gl_dtl_data[] = array(

                        'gl_trx_hdr_prefix' => $sa_spec_prefix,
                        'gl_trx_hdr_year' => $gl_year,
                        'gl_trx_hdr_month' => $gl_month,
                        'gl_trx_hdr_code' => $new_gl_coa_code,
                        'row_no' => $gl_detail->row_no,
                        'gl_trx_hdr_journal_no' => $gl_coa_no,
                        'gl_trx_hdr_journal_date' => $gl_date,
                        'coa_rowID' => $gl_detail->coa_rowID,
                        'descs' => $gl_detail->descs,
                        'trx_amt' => ($gl_detail->trx_amt * -1),
                        'dep_rowID' => $gl_detail->dep_rowID,
                        'debtor_creditor_rowID' => $gl_detail->debtor_creditor_rowID,
                        'gl_trx_hdr_ref_prefix' => $cash_gl_prefix,
                        'gl_trx_hdr_ref_year' => $cash_gl_year,
                        'gl_trx_hdr_ref_month' => $cash_gl_month,
                        'gl_trx_hdr_ref_code' => $cash_gl_code,
                        'gl_trx_hdr_ref_no' => $cash_gl_no,
                        'gl_trx_hdr_ref_date' => $cash_gl_date,
                        'modul' => $gl_detail->modul,
                        'cash_flow' => $gl_detail->cash_flow,
                        'base_amt' => $gl_detail->base_amt,
                        'tax_no' => $gl_detail->tax_no,
                        'user_created' => $this->session->userdata('user_rowID'),
                        'date_created' => date('Y-m-d'),
                        'time_created' => date('H:i:s'));
                }
            }
            */
            
            $this->db->trans_begin();
            
            $get_ca = $this->finances_model->get_row_ca_by_no($ca_prefix, $ca_year, $ca_month, $ca_code);            
            
            $this->db->where('prefix', $ca_prefix);
            $this->db->where('year', $ca_year);
            $this->db->where('month', $ca_month);
            $this->db->where('code', $ca_code);
            $this->db->where('deleted', 0);
            $this->db->update('cb_cash_adv', $cash_advance_data);
            
            if(count($get_ca) > 0){
                $this->db->where('advance_invoice_trx_no', $get_ca->advance_no);
                $this->db->where('deleted', 0);
                $this->db->update('cb_trx_hdr', $cash_book_data);
            }
            
            /*
            $this->db->insert('gl_trx_hdr', $gl_trx_hdr_data);
            $this->db->insert_batch('gl_trx_dtl', $gl_dtl_data);
            */
            
            // Delete Memo
            $this->db->where('advance_no',$get_ca->advance_no);
            $this->db->delete('cb_memo');
            
            // Delete Queue
            $get_data_cash_adv = $this->finances_model->get_cash_advance_by_debtor_rowID($debtor_id);
            $total_balance = 0;
            if(count($get_data_cash_adv) > 0){
                foreach($get_data_cash_adv as $row_cash){
                    $total_balance += $row_cash->advance_balance;
                }
            }
                    
            if($total_balance == 0){
                $get_queue = $this->finances_model->get_queue($debtor_id);
                if(count($get_queue) > 0){
                    foreach($get_queue as $row_queue){
                        $data_log_queue = array(
                            'debtor_id' => $row_queue->debtor_id,
                            'absent_code' => 'R',
                            'note' => 'Register from Delete Cash Advance',
                            'date_modified' => $row_queue->date_modified,
                            'user_modified' => $row_queue->user_modified,
                            'date_created' => $row_queue->date_created,
                            'date_transfer' => date('Y-m-d H:i:s')
                        );
                        
                        $this->finances_model->insert_log($data_log_queue);
                    }
                    
                    $this->finances_model->delete_queue($debtor_id);
                }
            }
            
            if ($this->db->trans_status() === false)
            {
                # Something went wrong.
                $this->db->trans_rollback();

                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'ERROR ROLLBACK Finances->Cash Advance';
                $params['module_field_id'] = $ca_code;
                $params['activity'] = ucfirst('Deleted a Cash Advance No. ' . $ca_no);
                $params['icon'] = 'fa-exclamation-triangle';
                modules::run('activitylog/log', $params); //log activity
                $this->session->set_flashdata('response_status', 'error');
                $this->session->set_flashdata('message',
                    'Please Delete Again, The DATA was ROLLBACK!!!');
                redirect('finances/'.$this->session->userdata('page_detail'));
                //return FALSE;
            } else
            {
                # Everything is Perfect.
                # Committing data to the database.
                $this->db->trans_commit();
                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'Cash Advance List';
                $params['module_field_id'] = $ca_code;
                $params['activity'] = ucfirst('Deleted a Cash Advance No. ' . $ca_no);
                $params['icon'] = 'fa-trash-o';
                modules::run('activitylog/log', $params); //log activity

                //return TRUE;
                $this->session->set_flashdata('response_status', 'success');
                $this->session->set_flashdata('message', lang('cash_advance') . ' ' . lang('deleted_succesfully') .
                    '. Cash Advance No.  ' . $ca_no);
                redirect('finances/'.$this->session->userdata('page_detail'));
            }

        } else
        {


            $data['ca_list'] = $this->appmodel->get_all_records($table = 'cb_cash_adv', $array =
                array(
                'deleted' => 0,
                'prefix' => $ca_prefix,
                'year' => $ca_year,
                'month' => $ca_month,
                'code' => $ca_code), $join_table = '', $join_criteria = '', 'advance_no', 'ASC');

            $this->load->view('modal/delete_cash_advance', $data);

        }
    }
    
    function cancel_load($advance_no){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $error = false;
        $this->db->trans_begin();
        
        $get_data = $this->finances_model->get_ca_by_advance_no($advance_no);

        $alloc_date = date('Y-m-d');
        $alloc_date_year = date('Y');
        $alloc_date_month = date('m');

        $sa_spec = $this->db->get_where('sa_spec', array('deleted' => 0, 'rowID' => 1))->
            row_array();
        $sa_spec_prefix = $sa_spec['memorial_jrn'];
        $alloc_code = ((int)$this->appmodel->select_max_id('cb_cash_adv_alloc', $array =
            array(
            'prefix' => $sa_spec_prefix,
            'year' => $alloc_date_year,
            'month' => $alloc_date_month,
            'deleted' => 0), 'code')) + 1;
        $alloc_no = $sa_spec_prefix . sprintf("%04s", $alloc_date_year) . sprintf("%02s",
            $alloc_date_month) . sprintf("%05s", $alloc_code);
        
        $result = $this->finances_model->save_cancel_load($sa_spec_prefix, $alloc_code, $alloc_no, $get_data);
        if ($result){
            $sql = "UPDATE cb_cash_adv SET trx_no = '".$alloc_no."', advance_allocation = advance_allocation+".$get_data->advance_balance.", advance_balance = 0
                    WHERE advance_no = '".$advance_no."' AND deleted = 0";
            
            $result = $this->db->query($sql);
            if(!$result){                
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
            $params['module'] = 'ERROR ROLLBACK Finances->Cancel Load';
            $params['module_field_id'] = $alloc_code;
            $params['activity'] = ucfirst('Deleted a Cancel Load No ' . $alloc_no);
            $params['icon'] = 'fa-exclamation-triangle';
            modules::run('activitylog/log', $params);
            
            echo json_encode(array('success' => false, 'msg' => " Failed"));
            exit();
        } else
        {
            $this->db->trans_commit();
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Finances->Cancel Load';
            $params['module_field_id'] = $alloc_code;
            $params['activity'] = ucfirst('Added a new cancel load no ' . $alloc_no);
            $params['icon'] = 'fa-times';
            modules::run('activitylog/log', $params); //log activity

            $info = 'Add data cancel load successfully';
            echo json_encode(array('success' => true, 'msg' => $info));
            exit();
        }
        
        return $status;
    }

    function simpan_ca_realization()
    {
        $dataPost = $this->input->post();
        //echo "<pre>";print_r($dataPost);echo "</pre>";exit();
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $error = false;
        
        $this->db->trans_begin();
        
        if(date('Y-m-d',strtotime($dataPost['date'])) != date('Y-m-d')){
            $alloc_date = date('Y-m-d');
        }
        else{
            $alloc_date = date('Y-m-d',strtotime($dataPost['date']));
        }
        
        $alloc_date_year = date('Y',strtotime($alloc_date));
        $alloc_date_month = date('m',strtotime($alloc_date));

        $sa_spec = $this->db->get_where('sa_spec', array('deleted' => 0, 'rowID' => 1))->
            row_array();
        $sa_spec_prefix = $sa_spec['memorial_jrn'];
        $alloc_code = ((int)$this->appmodel->select_max_id('cb_cash_adv_alloc', $array =
            array(
            'prefix' => $sa_spec_prefix,
            'year' => $alloc_date_year,
            'month' => $alloc_date_month,
            'deleted' => 0), 'code')) + 1;
        $alloc_no = $sa_spec_prefix . sprintf("%04s", $alloc_date_year) . sprintf("%02s",
            $alloc_date_month) . sprintf("%05s", $alloc_code);
        $new_gl_coa_code = ((int)$this->appmodel->select_max_id('gl_trx_hdr', $array =
            array(
            'prefix' => $sa_spec_prefix,
            'year' => $alloc_date_year,
            'month' => $alloc_date_month,
            'deleted' => 0), 'code')) + 1;
        $gl_coa_no = $sa_spec_prefix . sprintf("%04s", $alloc_date_year) . sprintf("%02s",
            $alloc_date_month) . sprintf("%05s", $new_gl_coa_code);

        $sa_spec = $this->db->get_where('sa_spec', array('deleted' => 0, 'rowID' => 1))->
            row_array();
        $debtor_type_rowID = $this->appmodel->get_id($table = 'sa_debtor', $array =
            array('deleted' => 0, 'rowID' => $dataPost['driver']), 'debtor_type_rowID');
        $receiveable_rowID = $this->appmodel->get_id($table = 'sa_debtor_type', $array =
            array('deleted' => 0, 'rowID' => $debtor_type_rowID), 'receiveable_coa_rowID');
        $advance_coa_rowID = $this->appmodel->get_id($table = 'sa_debtor_type', $array =
            array('deleted' => 0, 'rowID' => $debtor_type_rowID), 'advance_coa_rowID');
        $cash_gl_rowID = $this->appmodel->get_id($table = 'sa_dep', $array = array('deleted' =>
                0, 'rowID' => $this->session->userdata('dep_rowID')), 'cash_gl_rowID');
                            
        $cash_advance_rowID = $dataPost['cash_advance_type_id'];
        $cash_advance_rowID = substr($cash_advance_rowID, 0, strlen($cash_advance_rowID) - 1);

        $cash_out_prefix_cd = $this->appmodel->get_id($table = 'sa_dep', $array = array
            ('deleted' => 0, 'rowID' => $this->session->userdata('dep_rowID')),
            'cash_out_prefix');
        $cash_out_year = $dataPost['year'];
        $cash_out_month = $dataPost['month'];
        $advance_name = $this->appmodel->get_id($table = 'sa_advance_type', $array =
            array('deleted' => 0, 'rowID' => $cash_advance_rowID), 'advance_name');
        $debtor_name = $this->appmodel->get_id($table = 'sa_debtor', $array = array('deleted' =>
                0, 'rowID' => $dataPost['driver']), 'debtor_name');
        
        $new_cash_advance_code = ((int)$this->appmodel->select_max_id('cb_cash_adv', $array =
            array(
            'prefix' => $cash_out_prefix_cd,
            'year' => $cash_out_year,
            'month' => $cash_out_month,
            'deleted' => 0), 'code')) + 1;

        //$cash_advance_no = $cash_out_prefix_cd . sprintf("%04s", $cash_out_year) . sprintf("%02s", $cash_out_month) . sprintf("%05s", $new_cash_advance_code);
        $cash_advance_no = $dataPost['cash_advance_no'];
        
        $sql = "SELECT * FROM cb_cash_adv WHERE deleted = 0 AND advance_no = '".$cash_advance_no."' AND on_process = ".$dataPost['on_process'];
        $cek_on_process = $this->db->query($sql)->num_rows();
        
        if($cek_on_process == 1){
            $cash_advance_amt = str_replace('.','',$dataPost['cash_advance_amt']);
            $cash_advance_alloc = str_replace('.','',$dataPost['cash_advance_alloc']);
            $max_percent_realization = $this->config->item('max_percent_realization') / 100;
            $max_cash_advance_alloc = $cash_advance_amt + ($cash_advance_amt * $max_percent_realization);
            
            // if($cash_advance_alloc > $max_cash_advance_alloc){
            //     echo json_encode(array('success' => false, 'msg' => "Realization total exceeds maximum [Rp ".number_format($max_cash_advance_alloc,0,',','.')."] !"));
            //     exit();
            // }
            // else{
                // simpan data header realisasi
                $result = $this->finances_model->simpan_realization_hdr($sa_spec_prefix, $alloc_code,
                    $alloc_no, $dataPost); //cb_cash_adv_alloc
                if ($result)
                {
                    if (!empty($dataPost['detailCost']))
                    {
                        $x = 0;
                        //simpan data detail cost
                        foreach ($dataPost['detailCost'] as $detailCost)
                        {
                            $x++;
                            $result = $this->finances_model->simpan_realization_detail_cost($sa_spec_prefix,
                                $alloc_code, $x, $alloc_no, $dataPost, $detailCost);
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
                
                /*  
                if ($error == false)
                {
                    // simpan data header GL Doc
                    $result = $this->finances_model->
                    simpan_gl_header_doc_realization($sa_spec_prefix, $new_gl_coa_code, $alloc_no, $cash_out_prefix_cd, $cash_advance_no, 
                                                    $advance_name, $debtor_name, $new_cash_advance_code, $dataPost);
                    if ($result)
                    {
                        if (!empty($dataPost['detailCost']))
                        {
                            $i = 1;
                            //simpan data gl detail debet
                            foreach ($dataPost['detailCost'] as $detailDebet)
                            {
                                $i++;
                                $coaRowIDDebet = $this->appmodel->get_id($table = 'sa_cost', $array = array('deleted' =>
                                        0, 'rowID' => $detailDebet['cost_rowID']), 'wip_acc_rowID');
                                        
                                $result = $this->finances_model->simpan_gl_detail_doc_debet_realization($sa_spec_prefix, $new_gl_coa_code, 
                                    $alloc_no, $cash_out_prefix_cd, $coaRowIDDebet, $advance_name, $debtor_name, $new_cash_advance_code, 
                                    $cash_advance_no, $detailDebet, $dataPost);
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
                    
                } else
                {
                    $error = true;
                }
                */
                
                if ($error == false)
                {
                    /*
                    if($dataPost['cash_advance_alloc'] <= $dataPost['cash_advance_amt']){
                        $result = $this->finances_model->simpan_gl_detail_doc_kredit_realization($sa_spec_prefix, $new_gl_coa_code, $alloc_no, 
                                    $receiveable_rowID, $advance_name, $debtor_name, $cash_out_prefix_cd, $new_cash_advance_code, 
                                    $cash_advance_no, $dataPost);
                    }
                    else{
                        $total_amount = str_replace('.', '', $dataPost['cash_advance_amt']);
                        $sisa_amount = str_replace('.', '', $dataPost['cash_advance_alloc']) - str_replace('.', '', $dataPost['cash_advance_amt']);
                        
                        $this->finances_model->simpan_gl_detail_doc_kredit_sisa_realization($sa_spec_prefix, $new_gl_coa_code, $alloc_no, 
                                    $receiveable_rowID, $advance_name, $debtor_name, $cash_out_prefix_cd, $new_cash_advance_code, 
                                    $cash_advance_no, $total_amount, $dataPost);
                        $this->finances_model->simpan_gl_detail_doc_kredit_sisa_realization($sa_spec_prefix, $new_gl_coa_code, $alloc_no, 
                                    $cash_gl_rowID, $advance_name, $debtor_name, $cash_out_prefix_cd, $new_cash_advance_code, 
                                    $cash_advance_no, $sisa_amount, $dataPost);
                    }
                    */
                    
                    if ($result)
                    {
                        $result = $this->finances_model->update_cash_advance($alloc_no,$dataPost);
                        if ($result)
                        {
                            if (!empty($dataPost['detailDO']))
                            {
                                $count_container = 0;
                                foreach ($dataPost['detailDO'] as $detDO)
                                {
                                    if(!empty($detDO['ContType'])){
                                        if($detDO['ContType'] == '20'){
                                            $count_container++;
                                        }
                                    }
                                }
                                
                                foreach ($dataPost['detailDO'] as $detDO)
                                {
                                    $result = $this->finances_model->simpan_data_do($sa_spec_prefix, $alloc_code, $alloc_no,
                                        $dataPost, $detDO, $count_container);
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
        
                    } else
                    {
                        $error = true;
                    }
                } else
                {
                    $error = true;
                }
                
                // Delete Queue
                $get_data_cash_adv = $this->finances_model->get_cash_advance_by_debtor_rowID($dataPost['driver']);
                $total_balance = 0;
                if(count($get_data_cash_adv) > 0){
                    foreach($get_data_cash_adv as $row_cash){
                        $total_balance += $row_cash->advance_balance;
                    }
                }
                        
                if($total_balance == 0){
                    $get_queue = $this->finances_model->get_queue($dataPost['driver']);
                    if(count($get_queue) > 0){
                        foreach($get_queue as $row_queue){
                            $data_log_queue = array(
                                'debtor_id' => $row_queue->debtor_id,
                                'absent_code' => 'R',
                                'note' => 'Register from Realization Cash Advance',
                                'date_modified' => $row_queue->date_modified,
                                'user_modified' => $row_queue->user_modified,
                                'date_created' => $row_queue->date_created,
                                'date_transfer' => date('Y-m-d H:i:s')
                            );
                            
                            $this->finances_model->insert_log($data_log_queue);
                        }
                        
                        $this->finances_model->delete_queue($dataPost['driver']);
                    }
                }
                
                Header('Content-Type: application/json; charset=UTF8');
                $status = $this->db->trans_status();
                if ($status === false || $error == true)
                {
                    $this->db->trans_rollback();
                    
                    $params['user_rowID'] = $this->tank_auth->get_user_id();
                    $params['module'] = 'ERROR ROLLBACK Finances->Realization';
                    $params['module_field_id'] = $alloc_code;
                    $params['activity'] = ucfirst('Deleted a Realization No. ' . $alloc_no);
                    $params['icon'] = 'fa-exclamation-triangle';
                    modules::run('activitylog/log', $params);
                    
                    echo json_encode(array('success' => false, 'msg' => " Failed"));
                    exit();
                } else
                {
                    $this->db->trans_commit();
                    $params['user_rowID'] = $this->tank_auth->get_user_id();
                    $params['module'] = 'Finances->Realization';
                    $params['module_field_id'] = $alloc_code;
                    $params['activity'] = ucfirst('Added a new realization cash advance no. ' . $alloc_no);
                    $params['icon'] = 'fa-plus';
                    modules::run('activitylog/log', $params); //log activity
        
                    $info = lang('add_realization_successfully');
                    echo json_encode(array('success' => true, 'msg' => $info));
                    exit();
                }
                
                return $status;
            // }
        }
        else{
            echo json_encode(array('success' => false, 'msg' => "Data in other realization process!"));
            exit();
        }

    }

    /*
    function create_realization_hdr() // Tidak dipakai
    {
        $ca_prefix = $this->encrypt->decode($this->uri->segment(3));
        $ca_year = $this->encrypt->decode($this->uri->segment(4));
        $ca_month = $this->encrypt->decode($this->uri->segment(5));
        $ca_code = $this->encrypt->decode($this->uri->segment(6));

        if ($this->input->post())
        {
            $ca_prefix = $this->input->post('prefix');
            $ca_year = $this->input->post('year');
            $ca_month = $this->input->post('month');
            $ca_code = $this->input->post('code');

            $alloc_date = date('Y-m-d', strtotime($this->input->post('date')));
            $alloc_date_year = date('Y', strtotime($this->input->post('date')));
            $alloc_date_month = date('m', strtotime($this->input->post('date')));

            $ca_no = $this->input->post('cash_advance_no'); //$this->appmodel->get_id($table = 'cb_cash_adv', $array = array('deleted' => 0, 'prefix'=>$ca_prefix,'year'=>$ca_year,'month'=>$ca_month,'code'=>$ca_code), 'advance_no');
            $ca_type = $this->input->post('advance_name'); //$this->appmodel->get_id($table = 'sa_advance_type', $array = array('deleted' => 0, 'rowID'=>$this->input->post('cash_advance_type')), 'advance_name');
            $ca_date = $this->appmodel->get_id($table = 'cb_cash_adv', $array = array(
                'deleted' => 0,
                'prefix' => $ca_prefix,
                'year' => $ca_year,
                'month' => $ca_month,
                'code' => $ca_code), 'advance_date');
            $counter_costcode = $this->input->post('counter_costcode');
            $cost_code_id = $this->input->post('cost_code_id');
            $cost_code = $this->input->post('cost_code');
            $cost_code_desc = $this->input->post('cost_code_desc');
            $cost_code_amount = $this->input->post('cost_code_amount');


            $sa_spec_prefix = $this->appmodel->get_id($table = 'sa_spec', $array = array('deleted' =>
                    0, 'rowID' => 1), 'memorial_jrn');

            $alloc_code = ((int)$this->appmodel->select_max_id('cb_cash_adv_alloc', $array =
                array(
                'prefix' => $sa_spec_prefix,
                'year' => $alloc_date_year,
                'month' => $alloc_date_month), 'code')) + 1;

            $alloc_no = $sa_spec_prefix . sprintf("%04s", $alloc_date_year) . sprintf("%02s",
                $alloc_date_month) . sprintf("%05s", $alloc_code);

            $i = 0;
            $ttl_cost_amount = 0;
            foreach ($cost_code_id as $cost_code_id_)
            {
                if (!empty($cost_code_id_))
                {

                    $cost_data[] = array(
                        'prefix' => $sa_spec_prefix,
                        'year' => $alloc_date_year,
                        'month' => $alloc_date_month,
                        'code' => $alloc_code,
                        'row_no' => $i + 1,
                        'trx_no' => $alloc_no,
                        'trx_date' => $alloc_date,
                        'cost_rowID' => $cost_code_id[$i],
                        'trx_amt' => $cost_code_amount[$i],
                        'descs' => $cost_code_desc[$i],
                        'user_created' => $this->session->userdata('user_rowID'),
                        'date_created' => date('Y-m-d'),
                        'time_created' => date('H:i:s'));
                    $ttl_cost_amount += $cost_code_amount[$i];
                    $i++;

                }
            }


            $realization_hdr_data = array(
                'prefix' => $sa_spec_prefix,
                'year' => $alloc_date_year,
                'month' => $alloc_date_month,
                'code' => $alloc_code,
                'row_no' => 1,
                'alloc_no' => $alloc_no,
                'alloc_date' => $alloc_date,
                'descs' => 'Realisasi atas ' . $ca_type . ' No: ' . $ca_no,
                'alloc_amt' => $ttl_cost_amount,
                'alloc_mode' => 'R',
                'cb_cash_adv_prefix' => $ca_prefix,
                'cb_cash_adv_year' => $ca_year,
                'cb_cash_adv_month' => $ca_month,
                'cb_cash_adv_code' => $ca_code,
                'user_created' => $this->session->userdata('user_rowID'),
                'date_created' => date('Y-m-d'),
                'time_created' => date('H:i:s'));

            $new_gl_coa_code = ((int)$this->appmodel->select_max_id('gl_trx_hdr', $array =
                array(
                'prefix' => $sa_spec_prefix,
                'year' => $alloc_date_year,
                'month' => $alloc_date_month), 'code')) + 1;

            $gl_coa_no = $sa_spec_prefix . sprintf("%04s", $alloc_date_year) . sprintf("%02s",
                $alloc_date_month) . sprintf("%05s", $new_gl_coa_code);

            //$wip_gl = $this->appmodel->get_id($table = 'sa_cost', $array = array('deleted' => 0, 'rowID'=>$debtor_type_rowID), 'receiveable_coa_rowID');
            $debtor_type_rowID = $this->appmodel->get_id($table = 'sa_debtor', $array =
                array('deleted' => 0, 'rowID' => $this->input->post('driver')),
                'debtor_type_rowID');
            $receiveable_rowID = $this->appmodel->get_id($table = 'sa_debtor_type', $array =
                array('deleted' => 0, 'rowID' => $debtor_type_rowID), 'receiveable_coa_rowID');


            $gl_trx_hdr_data = array(
                'prefix' => $sa_spec_prefix,
                'year' => $alloc_date_year,
                'month' => $alloc_date_month,
                'code' => $new_gl_coa_code,
                'journal_no' => $gl_coa_no,
                'journal_date' => $alloc_date,
                'descs' => 'Realisasi atas ' . $ca_type . ' No: ' . $ca_no,
                'trx_amt' => $ttl_cost_amount,
                'ref_prefix' => $ca_prefix,
                'ref_year' => $ca_year,
                'ref_month' => $ca_month,
                'ref_code' => $ca_code,
                'ref_no' => $ca_no,
                'ref_date' => $ca_date,
                'user_created' => $this->session->userdata('user_rowID'),
                'date_created' => date('Y-m-d'),
                'time_created' => date('H:i:s'));

            $i = 0;
            $ttl_cost_amount = 0;
            foreach ($cost_code_id as $cost_code_id_)
            {
                if (!empty($cost_code_id_))
                {

                    $gl_trx_dtl_d_data[] = array(
                        'gl_trx_hdr_prefix' => $sa_spec_prefix,
                        'gl_trx_hdr_year' => $alloc_date_year,
                        'gl_trx_hdr_month' => $alloc_date_month,
                        'gl_trx_hdr_code' => $new_gl_coa_code,
                        'row_no' => $i + 1,
                        'gl_trx_hdr_journal_no' => $gl_coa_no,
                        'gl_trx_hdr_journal_date' => $alloc_date,
                        'coa_rowID' => $this->appmodel->get_id($table = 'sa_cost', $array = array('deleted' =>
                                0, 'rowID' => $cost_code_id[$i]), 'wip_acc_rowID'),
                        'descs' => $cost_code_desc[$i],
                        'trx_amt' => $cost_code_amount[$i],
                        'dep_rowID' => $this->session->userdata('dep_rowID'),
                        'debtor_creditor_rowID' => $this->input->post('driver'),
                        'gl_trx_hdr_ref_prefix' => $ca_prefix,
                        'gl_trx_hdr_ref_year' => $ca_year,
                        'gl_trx_hdr_ref_month' => $ca_month,
                        'gl_trx_hdr_ref_code' => $ca_code,
                        'gl_trx_hdr_ref_no' => $ca_no,
                        'gl_trx_hdr_ref_date' => $ca_date,
                        'modul' => 'GL',
                        'cash_flow' => 'N',
                        'base_amt' => 0,
                        'tax_no' => '',
                        'user_created' => $this->session->userdata('user_rowID'),
                        'date_created' => date('Y-m-d'),
                        'time_created' => date('H:i:s'));
                    $ttl_cost_amount += $cost_code_amount[$i];
                    $i++;

                }
            }
            $gl_trx_dtl_k_data = array(
                'gl_trx_hdr_prefix' => $sa_spec_prefix,
                'gl_trx_hdr_year' => $alloc_date_year,
                'gl_trx_hdr_month' => $alloc_date_month,
                'gl_trx_hdr_code' => $new_gl_coa_code,
                'row_no' => $i + 1,
                'gl_trx_hdr_journal_no' => $gl_coa_no,
                'gl_trx_hdr_journal_date' => $alloc_date,
                'coa_rowID' => $receiveable_rowID,
                'descs' => 'Realisasi atas ' . $ca_type . ' No: ' . $ca_no,
                'trx_amt' => $ttl_cost_amount * -1,
                'dep_rowID' => $this->session->userdata('dep_rowID'),
                'debtor_creditor_rowID' => $this->input->post('driver'),
                'gl_trx_hdr_ref_prefix' => $ca_prefix,
                'gl_trx_hdr_ref_year' => $ca_year,
                'gl_trx_hdr_ref_month' => $ca_month,
                'gl_trx_hdr_ref_code' => $ca_code,
                'gl_trx_hdr_ref_no' => $ca_no,
                'gl_trx_hdr_ref_date' => $ca_date,
                'modul' => 'GL',
                'cash_flow' => 'N',
                'base_amt' => 0,
                'tax_no' => '',
                'user_created' => $this->session->userdata('user_rowID'),
                'date_created' => date('Y-m-d'),
                'time_created' => date('H:i:s'));


            $this->db->trans_begin();

            $this->db->insert_batch('tr_cost_trx', $cost_data);
            $this->db->insert_batch('gl_trx_dtl', $gl_trx_dtl_d_data);
            $this->db->insert('gl_trx_dtl', $gl_trx_dtl_k_data);
            $this->db->insert('gl_trx_hdr', $gl_trx_hdr_data);
            $this->db->insert('cb_cash_adv_alloc', $realization_hdr_data);

            $this->db->set('advance_allocation', 'advance_allocation+' . $ttl_cost_amount, false);
            $this->db->set('advance_balance', 'advance_amount - advance_allocation', false);
            $this->db->set('user_modified', $this->session->userdata('user_rowID'), false);
            $this->db->set('date_modified', 'NOW()', false);
            $this->db->set('time_modified', 'NOW()', false);
            $this->db->where('prefix', $ca_prefix);
            $this->db->where('year', $ca_year);
            $this->db->where('month', $ca_month);
            $this->db->where('code', $ca_code);
            $this->db->update('cb_cash_adv');

            if ($this->db->trans_status() === false)
            {
                # Something went wrong.
                $this->db->trans_rollback();

                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'ERROR ROLLBACK Finances->Realization';
                $params['module_field_id'] = $alloc_code;
                $params['activity'] = ucfirst('Deleted a Realization No. ' . $alloc_no);
                $params['icon'] = 'fa-exclamation-triangle';
                modules::run('activitylog/log', $params); //log activity
                $this->session->set_flashdata('response_status', 'error');
                $this->session->set_flashdata('message',
                    'Please Delete Again, The DATA was ROLLBACK!!!');
                redirect('finances/create_realization_hdr/' . $this->uri->segment(3) . '/' . $this->
                    uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6));
                //return FALSE;
            } else
            {
                # Everything is Perfect.
                # Committing data to the database.
                $this->db->trans_commit();
                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'Realization';
                $params['module_field_id'] = $alloc_code;
                $params['activity'] = ucfirst('Deleted a Realization No. ' . $alloc_no);
                $params['icon'] = 'fa-trash-o';
                modules::run('activitylog/log', $params); //log activity

                //return TRUE;
                $this->session->set_flashdata('response_status', 'success');
                $this->session->set_flashdata('message', lang('realization') . ' ' . lang('deleted_succesfully') .
                    '. Realization No.  ' . $alloc_no);
                //redirect('finances/cash_advance_list');
                redirect('finances/create_realization_dtl/' . $this->encrypt->encode($sa_spec_prefix) .
                    '/' . $this->encrypt->encode($alloc_date_year) . '/' . $this->encrypt->encode($alloc_date_month) .
                    '/' . $this->encrypt->encode($alloc_code));
            }
        } else
        {
            $this->load->module('layouts');
            $this->load->library('template');

            $this->template->title(lang('realization') . ' - ' . $this->config->item('website_name') .
                ' - ' . $this->config->item('comp_name') . ' ' . $this->config->item('version'));
            $data['page'] = lang('realization');
            $this->session->set_userdata('page_header', 'transaction');
            $this->session->set_userdata('page_detail', 'realization');
            $data['form'] = true;
            $data['datatables'] = true;
            $data['cash_advance_details'] = $this->finances_model->
                get_all_records_ca_details($ca_prefix, $ca_year, $ca_month, $ca_code);
            //$data['cash_advance_jo'] =$this->finances_model->get_data_cash_advance_jo();
            //$data['cost_code_lists']  = $this->appmodel->get_all_records($table = 'sa_cost', $array = array('deleted' => 0), $join_table = '', $join_criteria = '','descs','ASC');

            $this->template->set_layout('users')->build('create_realization_hdr', isset($data) ?
                $data : null);
        }
    }
    
    */
    
    function returnCostCodesAjax()
    {
        $term = $this->input->get('term');
        echo json_encode($this->finances_model->getCostCode($term, 'rowID,cost_cd,descs'));
    }
    
    /*
    function create_realization_dtl() // Tidak dipakai
    {
        $alloc_prefix = $this->encrypt->decode($this->uri->segment(3));
        $alloc_year = $this->encrypt->decode($this->uri->segment(4));
        $alloc_month = $this->encrypt->decode($this->uri->segment(5));
        $alloc_code = $this->encrypt->decode($this->uri->segment(6));

        if ($this->input->post())
        {
            $ca_prefix = $this->input->post('prefix');
            $ca_year = $this->input->post('year');
            $ca_month = $this->input->post('month');
            $ca_code = $this->input->post('code');
            $alloc_date = $this->input->post('date');
            $alloc_date_year = date('Y', $this->input->post('date'));
            $alloc_date_month = date('m', $this->input->post('date'));
            $alloc_descs = $this->input->post('description');
            $ca_no = $this->appmodel->get_id($table = 'cb_cash_adv', $array = array(
                'deleted' => 0,
                'prefix' => $ca_prefix,
                'year' => $ca_year,
                'month' => $ca_month,
                'code' => $ca_code), 'advance_no');
            $ca_type = $this->appmodel->get_id($table = 'sa_advance_type', $array = array('deleted' =>
                    0, 'rowID' => $this->input->post('cash_advance_type')), 'advance_name');


            $sa_spec_prefix = $this->appmodel->get_id($table = 'sa_spec', $array = array('deleted' =>
                    0, 'rowID' => 1), 'memorial_jrn');

            $alloc_code = ((int)$this->appmodel->select_max_id('cb_cash_adv_alloc', $array =
                array(
                'prefix' => $sa_spec_prefix,
                'year' => $alloc_date_year,
                'month' => $alloc_date_month), 'code')) + 1;

            $alloc_no = $sa_spec_prefix . sprintf("%04s", $alloc_date_year) . sprintf("%02s",
                $alloc_date_month) . sprintf("%05s", $alloc_code);


            $realization_hdr_data = array(
                'prefix' => $sa_spec_prefix,
                'year' => $alloc_date_year,
                'month' => $alloc_date_month,
                'code' => $alloc_code,
                'alloc_no' => $alloc_no,
                'alloc_date' => $alloc_date,
                'descs' => 'Realisasi atas ' . $ca_type . ' No: ' . $ca_no,
                'alloc_amt' => 0,
                'alloc_mode' => 'R',
                'cb_cash_adv_prefix' => $caprefix,
                'cb_cash_adv_year' => $cayear,
                'cb_cash_adv_month' => $ca_month,
                'cb_cash_adv_code' => $ca_code,
                'user_created' => $this->session->userdata('user_rowID'),
                'date_created' => date('Y-m-d'),
                'time_created' => date('H:i:s'));

            $this->db->trans_begin();

            $this->db->insert('cb_cash_adv_alloc', $realization_hdr_data);

            if ($this->db->trans_status() === false)
            {
                # Something went wrong.
                $this->db->trans_rollback();

                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'ERROR ROLLBACK Finances->Realization';
                $params['module_field_id'] = $alloc_code;
                $params['activity'] = ucfirst('Deleted a Realization No. ' . $alloc_no);
                $params['icon'] = 'fa-exclamation-triangle';
                modules::run('activitylog/log', $params); //log activity
                $this->session->set_flashdata('response_status', 'error');
                $this->session->set_flashdata('message',
                    'Please Delete Again, The DATA was ROLLBACK!!!');
                redirect('finances/create_realization_hdr/' . $this->uri->segment(3) . '/' . $this->
                    uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6));
                //return FALSE;
            } else
            {
                # Everything is Perfect.
                # Committing data to the database.
                $this->db->trans_commit();
                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'Realization';
                $params['module_field_id'] = $alloc_code;
                $params['activity'] = ucfirst('Deleted a Realization No. ' . $alloc_no);
                $params['icon'] = 'fa-trash-o';
                modules::run('activitylog/log', $params); //log activity

                //return TRUE;
                $this->session->set_flashdata('response_status', 'success');
                $this->session->set_flashdata('message', lang('realization') . ' ' . lang('deleted_succesfully') .
                    '. Realization No.  ' . $alloc_no);
                redirect('finances/create_realization_details/' . $this->encrypt->encode($sa_spec_prefix) .
                    '/' . $this->encrypt->encode($alloc_date_year) . '/' . $this->encrypt->encode($alloc_date_month) .
                    '/' . $this->encrypt->encode($alloc_code));
            }
        } else
        {
            $this->load->module('layouts');
            $this->load->library('template');

            $this->template->title(lang('realization') . ' - ' . $this->config->item('website_name') .
                ' - ' . $this->config->item('comp_name') . ' ' . $this->config->item('version'));
            $data['page'] = lang('realization');
            $this->session->set_userdata('page_header', 'transaction');
            $this->session->set_userdata('page_detail', 'realization');
            $data['form'] = true;
            $data['datatables'] = true;
            $data['realization_details'] = $this->finances_model->
                get_all_records_alloc_details($alloc_prefix, $alloc_year, $alloc_month, $alloc_code);

            $this->template->set_layout('users')->build('create_realization_dtl', isset($data) ?
                $data : null);
        }
    }
    
    */

    function create_refund_hdr()
    {

        if ($this->input->post())
        {
            $this->db->trans_begin();
            $error = false;
            
            if(date('Y-m-d',strtotime($this->input->post('date'))) != date('Y-m-d')){
                $refund_date = date('Y-m-d');
            }
            else{
                $refund_date = date('Y-m-d',strtotime($this->input->post('date')));
            }
            
            $refund_year = date('Y',strtotime($refund_date));
            $refund_month = date('m',strtotime($refund_date));

            $driver_refund = $this->input->post('driver_refund');
            $paid_amount = str_replace('.','',$this->input->post('paid_amount'));
            $refund_desc = strtoupper($this->input->post('refund_desc'));

            $prefix = $this->input->post('prefix');
            $year = $this->input->post('year');
            $month = $this->input->post('month');
            $code = $this->input->post('code');
            $advance_no = $this->input->post('advance_no');
            $advance_date = $this->input->post('advance_date');
            $advance_amount = $this->input->post('advance_amount');
            $refund_amount = $this->input->post('refund_amount');

            $sa_spec_prefix = $this->appmodel->get_id($table = 'sa_dep', $array = array('deleted' =>
                    0, 'rowID' => 1), 'cash_in_prefix');

            $refund_code = ((int)$this->appmodel->select_max_id('cb_cash_adv_alloc', $array =
                array(
                'prefix' => $sa_spec_prefix,
                'year' => $refund_year,
                'month' => $refund_month,
                'deleted' => 0), 'code')) + 1;
            
            $refund_code_cb = 0;
            
            $refund_no = 'RF'.$sa_spec_prefix . sprintf("%04s", $refund_year) . sprintf("%02s", $refund_month) . sprintf("%05s", $refund_code);
            
            $cash_gl_rowID = $this->appmodel->get_id($table = 'sa_dep', $array = array('deleted' =>
                    0, 'rowID' => $this->session->userdata('dep_rowID')), 'cash_gl_rowID');
            
            $refund_gl_rowID = $this->appmodel->get_id($table = 'sa_dep', $array = array('deleted' =>
                    0, 'rowID' => $this->session->userdata('dep_rowID')), 'cash_gl_rowID');

            $gl_sa_spec_prefix = $this->appmodel->get_id($table = 'sa_spec', $array = array
                ('deleted' => 0, 'rowID' => 1), 'general_jrn');
            
            $debtor_type_rowID = $this->appmodel->get_id($table = 'sa_debtor', $array =
                array('deleted' => 0, 'rowID' => $driver_refund), 'debtor_type_rowID');
            $receiveable_rowID = $this->appmodel->get_id($table = 'sa_debtor_type', $array =
                array('deleted' => 0, 'rowID' => $debtor_type_rowID), 'receiveable_coa_rowID');

            $i = 0;
            $ttl_refund_amount = 0;
            foreach ($advance_no as $advance_no_)
            {
                if (!empty($advance_no_))
                {
                    $jumlah_refund = str_replace('.','',$refund_amount[$i]);
                    if ($jumlah_refund > 0)
                    {
                        $refund_code_cb = ((int)$this->appmodel->select_max_id('cb_trx_hdr', $array =
                            array(
                            'prefix' => $sa_spec_prefix,
                            'year' => $refund_year,
                            'month' => $refund_month,
                            'deleted' => 0), 'code')) + 1;
            
                        $refund_no_cb = $sa_spec_prefix . sprintf("%04s", $refund_year) . sprintf("%02s", $refund_month) . sprintf("%05s", $refund_code_cb);
                                    
                        $check_trx_no = $this->finances_model->get_data_header_cb($refund_no_cb);
                        if(count($check_trx_no) > 0){
                            $refund_code_cb = ((int)$this->appmodel->select_max_id('cb_trx_hdr', $array =
                                array(
                                'prefix' => $sa_spec_prefix,
                                'year' => $refund_year,
                                'month' => $refund_month,
                                'deleted' => 0), 'code')) + 1;
            
                            $refund_no_cb = $sa_spec_prefix . sprintf("%04s", $refund_year) . sprintf("%02s", $refund_month) . sprintf("%05s", $refund_code_cb);
                            
                        }
                        
                        $refund_hdr_data = array(
                            'prefix' => $sa_spec_prefix,
                            'year' => $refund_year,
                            'month' => $refund_month,
                            'code' => $refund_code_cb,
                            'row_no' => $i + 1,
                            'alloc_no' => $refund_no_cb,
                            'alloc_date' => $refund_date,
                            'descs' => 'REFUND ' . $refund_desc . ' NO. ' . $advance_no[$i],
                            'alloc_amt' => $jumlah_refund,
                            'alloc_mode' => 'F',
                            'cb_cash_adv_no' => $advance_no[$i],
                            'cb_cash_adv_prefix' => $prefix[$i],
                            'cb_cash_adv_year' => $year[$i],
                            'cb_cash_adv_month' => $month[$i],
                            'cb_cash_adv_code' => $code[$i],
                            'user_created' => $this->session->userdata('user_rowID'),
                            'date_created' => $refund_date,
                            'time_created' => date('H:i:s'));
                        
                        $cb_trx_data = array(
                            'prefix' => $sa_spec_prefix,
                            'year' => $refund_year,
                            'month' => $refund_month,
                            'code' => $refund_code_cb,
                            'trx_no' => $refund_no_cb,
                            'advance_invoice_trx_no' => $advance_no[$i],
                            'trx_date' => $refund_date,
                            'payment_type' => 'R',
                            'transaction_type' => 'refund',
                            'debtor_creditor_type' => 'D',
                            'coa_rowID' => $cash_gl_rowID,
                            'descs' => 'REFUND ' . $refund_desc,
                            'trx_amt' => $jumlah_refund,
                            'debtor_creditor_rowID' => $driver_refund,
                            'recon_status' => 'N',
                            'recon_date' => '1901-01-01',
                            'cg_void_status' => 'A',
                            'user_created' => $this->session->userdata('user_rowID'),
                            'date_created' => $refund_date,
                            'time_created' => date('H:i:s')
                        );
                        
                        $cb_trx_cg_data = array(
                            'cb_trx_hdr_prefix' => $sa_spec_prefix,
                            'cb_trx_hdr_year' => $refund_year,
                            'cb_trx_hdr_month' => $refund_month,
                            'cb_trx_hdr_code'  => $refund_code_cb,
                            'trx_no' => $refund_no_cb,
                            'row_no' => $i + 1,     
                            'payment_method' => 'cash',
                            'cash_bank' => $cash_gl_rowID,
                            'cg_no' => '',
                            'cg_date' => '',            
                            'cg_amt' => $jumlah_refund,
                            'status' => 1,
                            'user_created' => $this->session->userdata('user_id'),
                            'date_created' => $refund_date,
                            'time_created' => date('H:i:s')
                        );
                                                 
                        $cb_trx_data_dtl = array(
                            'cb_trx_hdr_prefix' => $sa_spec_prefix,
                            'cb_trx_hdr_year' => $refund_year,
                            'cb_trx_hdr_month' => $refund_month,
                            'cb_trx_hdr_code'  => $refund_code_cb,
                            'row_no' => $i+1,
                            'trx_no' => $refund_no_cb,
                            'trx_date' => $refund_date,            
                            'advance_invoice_no' => $advance_no[$i],
                            'advance_invoice_type' => 'refund',
                            'advance_invoice_amount' => $advance_amount[$i],
                            'descs' =>'REFUND ' . $refund_desc,
                            'trx_amt' => $jumlah_refund,
                            'user_created' => $this->session->userdata('user_id'),
                            'date_created' => $refund_date,
                            'time_created' => date('H:i:s')
                        );
                            
                        /*
                        $new_gl_coa_code = ((int)$this->appmodel->select_max_id('gl_trx_hdr', $array =
                            array(
                            'prefix' => $gl_sa_spec_prefix,
                            'year' => $refund_year,
                            'month' => $refund_month,
                            'deleted' => 0), 'code')) + 1;
            
                        $gl_coa_no = $gl_sa_spec_prefix . sprintf("%04s", $refund_year) . sprintf("%02s", $refund_month) . sprintf("%05s", $new_gl_coa_code);
                        
                        $gl_trx_hdr_data = array(
                            'prefix' => $gl_sa_spec_prefix,
                            'year' => $refund_year,
                            'month' => $refund_month,
                            'code' => $new_gl_coa_code,
                            'journal_no' => $gl_coa_no,
                            'journal_date' => $refund_date,
                            'journal_type' => 'refund',
                            'descs' => 'REFUND ' . $refund_desc,
                            'trx_amt' => $paid_amount,
                            'ref_prefix' => $sa_spec_prefix,
                            'ref_year' => $refund_year,
                            'ref_month' => $refund_month,
                            'ref_code' => $refund_code_cb,
                            'ref_no' => $refund_no_cb,
                            'ref_date' => $refund_date,
                            'user_created' => $this->session->userdata('user_rowID'),
                            'date_created' => $refund_date,
                            'time_created' => date('H:i:s'));
            
            
                        $gl_trx_dtl_d_data = array(
                            'gl_trx_hdr_prefix' => $gl_sa_spec_prefix,
                            'gl_trx_hdr_year' => $refund_year,
                            'gl_trx_hdr_month' => $refund_month,
                            'gl_trx_hdr_code' => $new_gl_coa_code,
                            'row_no' => 1,
                            'gl_trx_hdr_journal_no' => $gl_coa_no,
                            'gl_trx_hdr_journal_date' => $refund_date,
                            'coa_rowID' => $cash_gl_rowID,
                            'descs' => 'REFUND ' . $refund_desc,
                            'trx_amt' => $paid_amount,
                            'dep_rowID' => $this->session->userdata('dep_rowID'),
                            'debtor_creditor_rowID' => $driver_refund,
                            'gl_trx_hdr_ref_prefix' => $sa_spec_prefix,
                            'gl_trx_hdr_ref_year' => $refund_year,
                            'gl_trx_hdr_ref_month' => $refund_month,
                            'gl_trx_hdr_ref_code' => $refund_code_cb,
                            'gl_trx_hdr_ref_no' => $refund_no_cb,
                            'gl_trx_hdr_ref_date' => $refund_date,
                            'modul' => 'GL',
                            'cash_flow' => 'N',
                            'base_amt' => 0,
                            'tax_no' => '',
                            'user_created' => $this->session->userdata('user_rowID'),
                            'date_created' => $refund_date,
                            'time_created' => date('H:i:s'));
                        
                        
                        $gl_trx_dtl_k_data = array(
                            'gl_trx_hdr_prefix' => $gl_sa_spec_prefix,
                            'gl_trx_hdr_year' => $refund_year,
                            'gl_trx_hdr_month' => $refund_month,
                            'gl_trx_hdr_code' => $new_gl_coa_code,
                            'row_no' => 2,
                            'gl_trx_hdr_journal_no' => $gl_coa_no,
                            'gl_trx_hdr_journal_date' => $refund_date,
                            'coa_rowID' => $receiveable_rowID,
                            'descs' => 'PIUTANG EMPLOYEE/DRIVER CA NO : ' . $advance_no[$i].' WITH REFUND NO '.$refund_no_cb,
                            'trx_amt' => $jumlah_refund * -1,
                            'dep_rowID' => $this->session->userdata('dep_rowID'),
                            'debtor_creditor_rowID' => $driver_refund,
                            'gl_trx_hdr_ref_prefix' => $prefix[$i],
                            'gl_trx_hdr_ref_year' => $year[$i],
                            'gl_trx_hdr_ref_month' => $month[$i],
                            'gl_trx_hdr_ref_code' => $code[$i],
                            'gl_trx_hdr_ref_no' => $advance_no[$i],
                            'gl_trx_hdr_ref_date' => $advance_date[$i],
                            'modul' => 'GL',
                            'cash_flow' => 'N',
                            'base_amt' => 0,
                            'tax_no' => '',
                            'user_created' => $this->session->userdata('user_rowID'),
                            'date_created' => $refund_date,
                            'time_created' => date('H:i:s'));
                        */
                        
                        $ttl_refund_amount += $jumlah_refund;
                    
                        $result = $this->db->insert('cb_cash_adv_alloc', $refund_hdr_data);
                        if($result){
                            $result = $this->db->insert('cb_trx_hdr', $cb_trx_data);
                            if($result){
                                $result = $this->db->insert('cb_trx_cg', $cb_trx_cg_data); 
                                if($result){
                                    $result = $this->db->insert('cb_trx_dtl', $cb_trx_data_dtl);
                                    if($result){
                                        /*
                                        $result = $this->db->insert('gl_trx_hdr', $gl_trx_hdr_data);
                                        if($result){
                                            $result = $this->db->insert('gl_trx_dtl', $gl_trx_dtl_d_data);
                                            if($result){
                                                $result = $this->db->insert('gl_trx_dtl', $gl_trx_dtl_k_data);
                                                if($result){
                                        */            
                                                    $this->db->set('advance_allocation', 'advance_allocation+' . $jumlah_refund, false);
                                                    $this->db->set('advance_balance', 'advance_balance - '.$jumlah_refund, false);
                                                    $this->db->set('user_modified', $this->session->userdata('user_rowID'), false);
                                                    $this->db->set('date_modified', $refund_date);
                                                    $this->db->set('time_modified', date('H:i:s'));
                                                    $this->db->where('prefix', $prefix[$i]);
                                                    $this->db->where('year', $year[$i]);
                                                    $this->db->where('month', $month[$i]);
                                                    $this->db->where('code', $code[$i]);
                                                    $this->db->where('deleted',0);
                                                    $this->db->update('cb_cash_adv');
                                        /*
                                                }
                                                else{
                                                    $error = true;
                                                }
                                            }
                                            else
                                                $error = true;
                                        }
                                        else
                                            $error = true;
                                        */
                                    }
                                    else
                                        $error = true;
                                }
                                else
                                    $error = true;
                            }
                            else
                                $error = true;                                                
                        }
                        else
                            $error = true;
                        
                    }                           
                
                    $i++;
                }
            }
            
            $this->finances_model->updateQueue_by_debtor($driver_refund, null, null);
            
            Header('Content-Type: application/json; charset=UTF8');
            $status = $this->db->trans_status();
            if ($status === false || $error == true)
            {
                # Something went wrong.
                $this->db->trans_rollback();

                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'ERROR ROLLBACK Finances->Realization';
                $params['module_field_id'] = $refund_code_cb;
                $params['activity'] = ucfirst('Delete Refund No. ' . $refund_no_cb);
                $params['icon'] = 'fa-exclamation-triangle';
                modules::run('activitylog/log', $params); //log activity
                $this->session->set_flashdata('response_status', 'error');
                $this->session->set_flashdata('message',
                    'Please Delete Again, The DATA was ROLLBACK!!!');
                redirect('finances/create_refund_hdr/' . $this->uri->segment(3) . '/' . $this->
                    uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6));
                //return FALSE;
            } else
            {
                # Everything is Perfect.
                # Committing data to the database.
                $this->db->trans_commit();
                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'Finance->Refund';
                $params['module_field_id'] = $refund_code_cb;
                $params['activity'] = ucfirst('Add a new Refund No. ' . $refund_no_cb);
                $params['icon'] = 'fa-plus';
                modules::run('activitylog/log', $params); //log activity

                //return TRUE;
                $this->session->set_flashdata('response_status', 'success');
                $this->session->set_flashdata('message', lang('refund') . ' ' . lang('created_succesfully') .
                    '. Refund No.  ' . $refund_no_cb);
                redirect('finances/'.$this->session->userdata('page_detail'));
                //redirect('finances/create_settlement_details/'.$this->encrypt->encode($sa_spec_prefix).'/'.$this->encrypt->encode($alloc_date_year).'/'.$this->encrypt->encode($alloc_date_month).'/'.$this->encrypt->encode($alloc_code));
            }
        } else
        {
            $this->load->module('layouts');
            $this->load->library('template');

            $this->template->title(lang('refund') . ' - ' . $this->config->item('website_name') .
                ' - ' . $this->config->item('comp_name') . ' ' . $this->config->item('version'));
            $data['page'] = lang('refund');
            $this->session->set_userdata('page_header', 'transaction');
            $this->session->set_userdata('page_detail', $this->session->userdata('page_detail'));
            $data['form'] = true;
            $data['datatables'] = true;


            $data['drivers'] = $this->appmodel->get_all_records($table = 'sa_debtor', $array =
                array('deleted' => 0, 'type <>' => 'C'), $join_table = '', $join_criteria = '',
                'type,debtor_cd', 'ASC');

            $this->template->set_layout('users')->build('create_refund_hdr', isset($data) ?
                $data : null);
        }
    }

    function get_ca_lists()
    {
        error_reporting(E_ALL);
        $data['form'] = true;
        $data['datatables'] = true;
        $driver = $this->input->post('driver');
        $data['refund_amount'] = $this->input->post('refund_amount');

        $data['ca_lists'] = $this->appmodel->get_all_records($table = 'cb_cash_adv', $array =
            array(
            'deleted' => 0,
            'employee_driver_rowID' => $driver,
            'advance_balance >' => 0), $join_table = '', $join_criteria = '', 'advance_no',
            'ASC');
        $this->load->view('ajax_ca_lists', $data);
    }

    function job_order_list()
    {
        $data['form'] = true;
        $data['datatables'] = true;

        $data['cash_advance_jo'] = $this->finances_model->get_data_cash_advance_jo();

        $this->load->view('modal/job_order_list', $data);
        //$this->template->set_layout('users')->build('modal/job_order_list',isset($data) ? $data : NULL);

    }


    function fare_trip_list()
    {
        $data['form'] = true;
        $data['datatables'] = true;

        $data['fare_trip_lists'] = $this->fare_trip_model->get_all_fare_trip_cost();

        $this->load->view('modal/fare_trip_list', $data);


    }
    function create_delivery_order()
    {

        $data['prefix'] = $this->encrypt->decode($this->uri->segment(3));
        $data['year'] = $this->encrypt->decode($this->uri->segment(4));
        $data['month'] = $this->encrypt->decode($this->uri->segment(5));
        $data['code'] = $this->encrypt->decode($this->uri->segment(6));
        $data['job_orders'] = $this->job_order_model->get_all_records_list();
        $this->load->view('modal/new_delivery_order', $data);


    }
    function ajax_list()
    {
        $list = $this->finances_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person)
        {
            $no++;
            $row = array();
            $row[] = $person->firstName;
            $row[] = $person->lastName;
            $row[] = $person->gender;
            $row[] = $person->address;
            $row[] = $person->dob;

            //add html for action
            //$row[] = '<a class="btn btn-sm green" href="javascript:void()" title="Edit" onclick="edit_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
            //	  <a class="btn btn-sm red" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->finances_model->count_all(),
            "recordsFiltered" => $this->finances_model->count_filtered(),
            "data" => $data,
            );
        //output to json format
        echo json_encode($output);
    }


    function get_user_access($field){
        $this->db->where('status','1');
        $this->db->where('Link_Menu', 'finances/cash_advance_list');
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
    
    function get_user_access_branch($field){
        $this->db->where('status','1');
        $this->db->where('Link_Menu', 'finances/cash_advance_list_branch');
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
    
    function fetch_data($param) { 
        if ($this->input->is_ajax_request()) {
            $dt = $_POST;

            if($this->session->userdata('start_date_ca') == '' ){
                $start_date = date("Y-m-d", strtotime('-6 day'));
            }else{
                $start_date = $this->session->userdata('start_date_ca');
            }

            if($this->session->userdata('end_date_ca') == ''){
                $end_date = date("Y-m-d");
            }else{
                $end_date = $this->session->userdata('end_date_ca');
            }

            $dt['table'] = 'cb_cash_adv';
            $dt['id'] = 'rowID';

            $aColumnTable = array(
                'cb_cash_adv.rowID', 'cb_cash_adv.advance_no', 'cb_cash_adv.advance_date', 'cb_cash_adv.advance_date', 'sa_debtor.debtor_cd', 'sa_debtor.debtor_name', 'sa_fare_trip_hdr.fare_trip_cd', 'cb_cash_adv.vehicle_rowID', 'cb_cash_adv.advance_amount', 'cb_cash_adv.advance_extra_amount', 'cb_cash_adv.pay_over_allocation', 'cb_cash_adv.advance_allocation', 'cb_cash_adv.time_created', 'cb_cash_adv.split_status', 'cb_cash_adv.trx_no', 'cb_cash_adv.prefix', 'cb_cash_adv.year', 'cb_cash_adv.month', 'cb_cash_adv.code', 'sa_vehicle.vehicle_photo', 'sa_vehicle.vehicle_type', 'sa_vehicle.police_no'
            );

            $aColumns = array(
               'cb_cash_adv.rowID', 'cb_cash_adv.advance_no', 'cb_cash_adv.advance_date', 'cb_cash_adv.advance_date', 'sa_debtor.debtor_cd', 'sa_debtor.debtor_name', 'sa_fare_trip_hdr.fare_trip_cd', 'cb_cash_adv.vehicle_rowID', 'cb_cash_adv.advance_amount', 'cb_cash_adv.advance_extra_amount', 'cb_cash_adv.pay_over_allocation', 'cb_cash_adv.advance_allocation', 'cb_cash_adv.time_created', 'cb_cash_adv.split_status', 'cb_cash_adv.trx_no', 'cb_cash_adv.prefix', 'cb_cash_adv.year', 'cb_cash_adv.month', 'cb_cash_adv.code', 'sa_vehicle.vehicle_photo', 'sa_vehicle.vehicle_type', 'sa_vehicle.police_no'
            );

            $groupBy = '';
          

            if($param == 'pending'){
                $where_param = " cb_cash_adv.deleted = 0 AND cb_cash_adv.advance_balance != 0 AND cb_cash_adv.advance_type_rowID != 4 AND cb_cash_adv.advance_date BETWEEN '" . $start_date . "' AND '" . $end_date . "' ";
            }elseif($param == 'loan'){
                $where_param = " cb_cash_adv.deleted = 0 AND cb_cash_adv.advance_balance != 0 AND cb_cash_adv.advance_type_rowID = 4 AND cb_cash_adv.advance_date BETWEEN '" . $start_date . "' AND '" . $end_date . "' ";
            }elseif($param == 'done'){
                $where_param = " cb_cash_adv.deleted = 0 AND cb_cash_adv.advance_balance = 0 AND cb_cash_adv.advance_date BETWEEN '" . $start_date . "' AND '" . $end_date . "' ";
            }

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
                $sOrder .= " cb_cash_adv.advance_date DESC";
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
            
            if (!empty($dt['columns'][2]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }
                $start_date = date('Y-m-d', strtotime($dt['columns'][2]['search']['value']));
                $this->session->set_userdata('start_date_ca',date("Y-m-d",strtotime($start_date)));   

                if($this->session->userdata('end_date_ca') == ''){
                    $end_date = date("Y-m-d");
                }else{
                    $end_date = $this->session->userdata('end_date_ca');
                }
               
                if($param == 'pending'){
                    $where_param = " cb_cash_adv.deleted = 0 AND cb_cash_adv.advance_balance != 0 AND cb_cash_adv.advance_type_rowID != 4 AND cb_cash_adv.advance_date BETWEEN '" . $start_date . "' AND '" . $end_date . "' ";
                }elseif($param == 'loan'){
                    $where_param = " cb_cash_adv.deleted = 0 AND cb_cash_adv.advance_balance != 0 AND cb_cash_adv.advance_type_rowID = 4 AND cb_cash_adv.advance_date BETWEEN '" . $start_date . "' AND '" . $end_date . "' ";
                }elseif($param == 'done'){
                    $where_param = " cb_cash_adv.deleted = 0 AND cb_cash_adv.advance_balance = 0 AND cb_cash_adv.advance_date BETWEEN '" . $start_date . "' AND '" . $end_date . "' ";
                } 
            }
            if (!empty($dt['columns'][3]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }
                $end_date = date('Y-m-d', strtotime($dt['columns'][3]['search']['value']));
                $this->session->set_userdata('end_date_ca',date("Y-m-d",strtotime($end_date)));

                 if($this->session->userdata('start_date_ca') == ''){
                   $start_date = date("Y-m-d", strtotime('-6 day'));
                }else{
                    $start_date = $this->session->userdata('start_date_ca');
                } 
               
                if($param == 'pending'){
                    $where_param = " cb_cash_adv.deleted = 0 AND cb_cash_adv.advance_balance != 0 AND cb_cash_adv.advance_type_rowID != 4 AND cb_cash_adv.advance_date BETWEEN '" . $start_date . "' AND '" . $end_date . "' ";
                }elseif($param == 'loan'){
                    $where_param = " cb_cash_adv.deleted = 0 AND cb_cash_adv.advance_balance != 0 AND cb_cash_adv.advance_type_rowID = 4 AND cb_cash_adv.advance_date BETWEEN '" . $start_date . "' AND '" . $end_date . "' ";
                }elseif($param == 'done'){
                    $where_param = " cb_cash_adv.deleted = 0 AND cb_cash_adv.advance_balance = 0 AND cb_cash_adv.advance_date BETWEEN '" . $start_date . "' AND '" . $end_date . "' ";
                } 
            }

             /** Total Data Set Length * */
            $sQuery = "SELECT * FROM " . $dt['table'] . " LEFT JOIN sa_advance_type ON sa_advance_type.rowID = cb_cash_adv.advance_type_rowID LEFT JOIN sa_debtor ON sa_debtor.rowID = cb_cash_adv.employee_driver_rowID LEFT JOIN sa_vehicle ON sa_vehicle.rowID = cb_cash_adv.vehicle_rowID LEFT JOIN sa_vehicle_type ON sa_vehicle_type.rowID = cb_cash_adv.vehicle_type_rowID LEFT JOIN sa_fare_trip_hdr ON sa_fare_trip_hdr.rowID = cb_cash_adv.fare_trip_rowID LEFT JOIN sa_destination as destination_from ON destination_from.rowID = sa_fare_trip_hdr.destination_from_rowID LEFT JOIN sa_destination as destination_to ON destination_to.rowID = sa_fare_trip_hdr.destination_to_rowID LEFT JOIN sa_users ON sa_users.rowID = cb_cash_adv.user_created LEFT JOIN sa_koordinat_poi as koordinat_poi_from ON koordinat_poi_from.rowID = destination_from.coordinate_rowID LEFT JOIN sa_koordinat_poi as koordinat_poi_to ON koordinat_poi_to.rowID = destination_to.coordinate_rowID WHERE " . $where_param;

            $rResultTotal = $this->db->query($sQuery);
            $aResultTotal = $rResultTotal->num_rows();
            $iTotal = $aResultTotal;

             /** Filtering * */
            $sWhere = "";
            $sSearchVal = $dt['search']['value'];
            if (isset($sSearchVal) && $sSearchVal != '') {
                $sWhere = " WHERE (";
                for ($i = 0; $i < count($aColumns); $i++) {
                    $sWhere .= $aColumnTable [$i] . " LIKE '%" . $this->db->escape_like_str($sSearchVal) . "%' OR ";
                }
                $sWhere = substr_replace($sWhere, "", -3);
                $sWhere .= ') AND  ' . $where_param;
            }

            /* Get Data To Display */
            if ($sWhere != "") {
                $where = $sWhere;
            } else {
                $where = " WHERE " . $where_param;
            }

            $join_table = ' LEFT JOIN sa_advance_type ON sa_advance_type.rowID = cb_cash_adv.advance_type_rowID LEFT JOIN sa_debtor ON sa_debtor.rowID = cb_cash_adv.employee_driver_rowID LEFT JOIN sa_vehicle ON sa_vehicle.rowID = cb_cash_adv.vehicle_rowID LEFT JOIN sa_vehicle_type ON sa_vehicle_type.rowID = cb_cash_adv.vehicle_type_rowID LEFT JOIN sa_fare_trip_hdr ON sa_fare_trip_hdr.rowID = cb_cash_adv.fare_trip_rowID LEFT JOIN sa_destination as destination_from ON destination_from.rowID = sa_fare_trip_hdr.destination_from_rowID LEFT JOIN sa_destination as destination_to ON destination_to.rowID = sa_fare_trip_hdr.destination_to_rowID LEFT JOIN sa_users ON sa_users.rowID = cb_cash_adv.user_created LEFT JOIN sa_koordinat_poi as koordinat_poi_from ON koordinat_poi_from.rowID = destination_from.coordinate_rowID LEFT JOIN sa_koordinat_poi as koordinat_poi_to ON koordinat_poi_to.rowID = destination_to.coordinate_rowID ';

            $sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) .
                    " FROM " . $dt['table'] . $join_table .  $where . $groupBy . $sOrder . $sLimit;
            $rResult = $this->db->query($sQuery);

            /* Data set length after filtering */
            $sQuery = "SELECT FOUND_ROWS() AS length_count ";
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

                    $total_balance = ($aRow['advance_amount'] + $aRow['advance_extra_amount'] + $aRow['pay_over_allocation']) - $aRow['advance_allocation'];
                    $get_memo = $this->finances_model->get_memo_by_advance_no($aRow['advance_no']);


                    $tag_no_do = '';
                    if($param == 'done'){
                        $check_no_do = $this->finances_model->check_no_do_by_trx_no($aRow['trx_no']);
                        if(count($check_no_do) > 0){
                            $tag_no_do = '<span style="color: #c00">#</span>';
                        }
                    }
                   

                    $dropdown_option = '<div class="btn-group">';
                    $dropdown_option .= '<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">';
                    $dropdown_option .= lang('options');
                    $dropdown_option .= '<span class="caret"></span>';
                    $dropdown_option .= '</button>';
                    $dropdown_option .= '<ul class="dropdown-menu">';
                    if($this->get_user_access('Viewed') == 1){
                        $dropdown_option .= '<li><a href="' . base_url() .'finances/view_cash_advance/' . $aRow['rowID'] .'" title="' .lang('view_cashadvance_option') . '" ><i class="fa fa-eye"></i> ' . lang('view_cashadvance_option') . '</a></li>';
                    }
                    $dropdown_option .= '<li><a href="javascript:void()" title="Memo" onclick="memo_ca(\''. $aRow['advance_no'] .'\')"><i class="fa fa-sticky-note"></i> Memo</a></li>';  

                    if($param != 'done'){
                        if($total_balance > 0){
                            if($aRow['trx_no'] == ''){
                                if($this->get_user_access('Created') == 1){
                                    if($aRow['split_status'] == 0 || $aRow['split_status'] == 2){
                                        $dropdown_option .= '<li><a href="javascript:void()" title="' . lang('realization_option') . '" onclick="edit_realization(\'' . $aRow['prefix'] . '\',\''. $aRow['year'] . '\',\'' . $aRow['month']. '\',\'' . $aRow['code'] . '\')"><i class="fa fa-usd"></i> ' . lang('realization_option') . '</a></li>';
                                    }else{
                                        $dropdown_option .= '<li><a href="javascript:void()" title="Second Payment" onclick="second_payment(\'' . $aRow['advance_no'] .'\')"><i class="fa fa-usd"></i> Second Payment</a></li>';
                             
                                    }
                                }
                            }else{
                                if($this->get_user_access('PrintLimited') == 1 || $this->get_user_access('PrintUnlimited') == 1 || $this->get_user_access('PrintOne') == 1 || $this->get_user_access('PrintTwo') == 1){

                                    if($this->get_user_access('PrintLimited') == 1){
                                        if($this->user_profile->get_log_limited_printed($aRow['trx_no'],'Finances->Print Realization') == 0){
                                            $dropdown_option .= '<li><a title="' . lang('view_realization_option') . '" href="' . base_url() . 'finances/view_realization/' . $this->encrypt->encode($aRow['trx_no']) . '" target="_blank"><i class="fa fa-eye"></i> ' . lang('view_realization_option') . '</a></li>';
                                        }
                                    }else{
                                         $dropdown_option .= '<li><a title="' . lang('view_realization_option') . '" href="' . base_url() .'finances/view_realization/' . $this->encrypt->encode($aRow['trx_no']) . '" target="_blank"><i class="fa fa-eye"></i> ' . lang('view_realization_option') . '</a></li>';
                                    }
                                }
                            }
                        }else{
                            if($this->get_user_access('PrintLimited') == 1 || $this->get_user_access('PrintUnlimited') == 1 || $this->get_user_access('PrintOne') == 1 || $this->get_user_access('PrintTwo') == 1){

                                if($this->get_user_access('PrintLimited') == 1){
                                    if($this->user_profile->get_log_limited_printed($aRow['trx_no'],'Finances->Print Realization') == 0){
                                        $dropdown_option .= '<li><a title="' . lang('view_realization_option') .'" href="' . base_url() . 'finances/view_realization/' . $this->encrypt->encode($aRow['trx_no']) . '" target="_blank"><i class="fa fa-eye"></i> ' . lang('view_realization_option') . '</a></li>';
                                    }
                                } else{
                                    $dropdown_option .= '<li><a title="' . lang('view_realization_option') . '" href="' . base_url() . 'finances/view_realization/' . $this->encrypt->encode($aRow['trx_no']) . '" target="_blank"><i class="fa fa-eye"></i> '.lang('view_realization_option') . '</a></li>';
                                }
                            }
                        }

                        $advance_allocation = $aRow['advance_allocation'];
                        if($advance_allocation == 0){
                            if($this->get_user_access('Deleted') == 1){
                                $get_data_cash_bank = $this->finances_model->get_cash_bank_by_advance_no($aRow['advance_no']);
                                if(count($get_data_cash_bank) == 0){
                                    $dropdown_option .= '<li><a title="' . lang('delete_option') .'" href="' . base_url() . 'finances/delete_cash_advance/' . $this->encrypt->encode($aRow['prefix']) . '/' . $this->encrypt->encode($aRow['year']) . '/' . $this->encrypt->encode($aRow['month']) . '/' . $this->encrypt->encode($aRow['code']) . '" data-toggle="ajaxModal"><i class="fa fa-trash-o"></i> ' . lang('delete_option') . '</a></li>';
                                }
                            }
                        }    
                    }else{
                        $advance_allocation = $aRow['advance_allocation'];
                        if($advance_allocation == 0){
                            if($this->get_user_access('Deleted') == 1){
                                $get_data_cash_bank = $this->finances_model->get_cash_bank_by_advance_no($aRow['advance_no']);
                                if(count($get_data_cash_bank) == 0){
                                    $dropdown_option .= '<li><a title="' . lang('delete_option') .'" href="' . base_url() . 'finances/delete_cash_advance/' . $this->encrypt->encode($aRow['prefix']) . '/' . $this->encrypt->encode($aRow['year']) . '/' . $this->encrypt->encode($aRow['month']) . '/' . $this->encrypt->encode($aRow['code']) . '" data-toggle="ajaxModal"><i class="fa fa-trash-o"></i> ' . lang('delete_option') . '</a></li>';
                                }
                            }
                        }  

                        if($this->get_user_access('PrintLimited') == 1 || $this->get_user_access('PrintUnlimited') == 1 || $this->get_user_access('PrintOne') == 1 || $this->get_user_access('PrintTwo') == 1){

                            if($this->get_user_access('PrintLimited') == 1){
                                if($this->user_profile->get_log_limited_printed($aRow['trx_no'],'Finances->Print Realization') == 0){
                                    $dropdown_option .= '<li><a title="' . lang('view_realization_option') . '" href="' . base_url() . 'finances/view_realization/' . $this->encrypt->encode($aRow['trx_no']) . '" target="_blank"><i class="fa fa-eye"></i> ' . lang('view_realization_option') . '</a></li>';
                                }
                            }else{
                                 $dropdown_option .= '<li><a title="' . lang('view_realization_option') . '" href="' . base_url() .'finances/view_realization/' . $this->encrypt->encode($aRow['trx_no']) . '" target="_blank"><i class="fa fa-eye"></i> ' . lang('view_realization_option') . '</a></li>';
                            }
                        }  
                    }
                    
                           
                   
                    $dropdown_option .= '</ul></div>';

                    $row['options'] = $dropdown_option;
                    $row['advance_no'] = $aRow['advance_no'] . $tag_no_do;
                    $row['advance_date'] = date("d-m-Y H:i:s",strtotime($aRow['advance_date'] .' '. $aRow['time_created']));
                    $row['end_date'] = date("d-m-Y",strtotime($aRow['advance_date']));
                    $row['debtor'] = $aRow['debtor_cd'] . ' - ' . $aRow['debtor_name'];
                    if($param != 'loan'){
                        $row['fare_trip_cd'] = ($aRow['fare_trip_cd'] == '' ) ? '-' : str_replace('-',' - ', $aRow['fare_trip_cd']);
                    }

                    $vehicle = $this->finances_model->get_position_vehicle_by_row_id($aRow['vehicle_rowID']);
                    $status = '';
                    $color = '';
                    if($vehicle->status == '11' && $vehicle->speed > 0 ){
                        $status = 'Jalan';
                        $color = "background-color:#5cb85c;";
                    }
                    else if($vehicle->status == '11' && $vehicle->speed <= 0 ){
                        $status = 'Macet/Antri/Parkir';
                        $color = "background-color:#eac545;";
                    }
                    else if($vehicle->status == '01' && $vehicle->speed <= 0 ){
                        $status = 'Makan AKI';
                        $color = "background-color:#57b9f8;";
                    }
                    else if($vehicle->status == '00' && $vehicle->speed <= 0 ){
                        $status = 'Berhenti';
                        $color = "background-color:#f94c4c;";
                    }
                    else if($vehicle->status == '10' && $vehicle->speed > 0 ){
                        $status = 'Check Instalasi ACC & Engine';
                        $color = "background-color:#000;";
                    }
                    else if($vehicle->status == '10' && $vehicle->speed <= 0 ){
                        $status = 'Mohon diperiksa';
                        $color = "background-color:#1BDAC5;";
                    }
                    else{
                        $status = 'Data Tidak Tersedia';
                        $color = "background-color:#B0B0B0;";
                    }
                    
                    if($status != 'Data Tidak Tersedia'){
                        if(date('Y-m-d',strtotime($vehicle->datetime_gps)) != date('Y-m-d')){
                            $status = 'Out Of The Date';
                            $color = "background-color:#B0B0B0;";
                        }
                    }
                    
                    $star = '';
                    if($aRow['vehicle_photo'] == ''){
                        $star = '*';
                    }
                    
                    $speed = empty($vehicle->speed) ? 0 : $vehicle->speed;
                    $vehicle_type = $aRow['vehicle_type'] == '' ? '-' : $aRow['vehicle_type'];
                    $row['police_no'] = "<a href='javascript:void()' title='" . $status . "' onclick=\"showDetailPositionVehicle('". $aRow['vehicle_rowID'] ."')\"> <span class='badge' style='".$color."'>". $aRow['police_no'] . ' '. $star ."</span></a> <br>" . $vehicle_type . "<br>" . $speed . " km/h";
                    $row['advance_amount'] = number_format($aRow['advance_amount'],0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));
                    $row['advance_extra_amount'] = number_format($aRow['advance_extra_amount'],0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));
                    $row['pay_over_allocation'] = number_format($aRow['pay_over_allocation'] ,0,',','.');
                    $row['advance_allocation'] =  number_format($aRow['advance_allocation'],0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));
                    $row['total_balance'] = number_format($total_balance,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));
                    $row['total_memo'] = count($get_memo);
                    
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

    function fetch_data_branch($param) { 
        if ($this->input->is_ajax_request()) {
            $dt = $_POST;

            $dep_rowID = $this->session->userdata('dep_rowID');
            if($this->session->userdata('start_date_ca') == '' ){
                $start_date = date("Y-m-d", strtotime('-6 day'));
            }else{
                $start_date = $this->session->userdata('start_date_ca');
            }

            if($this->session->userdata('end_date_ca') == ''){
                $end_date = date("Y-m-d");
            }else{
                $end_date = $this->session->userdata('end_date_ca');
            }

            $dt['table'] = 'cb_cash_adv';
            $dt['id'] = 'rowID';

            $aColumnTable = array(
                'cb_cash_adv.rowID', 'cb_cash_adv.advance_no', 'cb_cash_adv.advance_date', 'cb_cash_adv.advance_date', 'sa_debtor.debtor_cd', 'sa_debtor.debtor_name', 'sa_fare_trip_hdr.fare_trip_cd', 'cb_cash_adv.vehicle_rowID', 'cb_cash_adv.advance_amount', 'cb_cash_adv.advance_extra_amount', 'cb_cash_adv.pay_over_allocation', 'cb_cash_adv.advance_allocation', 'cb_cash_adv.time_created', 'cb_cash_adv.split_status', 'cb_cash_adv.trx_no', 'cb_cash_adv.prefix', 'cb_cash_adv.year', 'cb_cash_adv.month', 'cb_cash_adv.code', 'sa_vehicle.vehicle_photo', 'sa_vehicle.vehicle_type', 'sa_vehicle.police_no', 'cb_cash_adv.spk_container_no'
            );

            $aColumns = array(
               'cb_cash_adv.rowID', 'cb_cash_adv.advance_no', 'cb_cash_adv.advance_date', 'cb_cash_adv.advance_date', 'sa_debtor.debtor_cd', 'sa_debtor.debtor_name', 'sa_fare_trip_hdr.fare_trip_cd', 'cb_cash_adv.vehicle_rowID', 'cb_cash_adv.advance_amount', 'cb_cash_adv.advance_extra_amount', 'cb_cash_adv.pay_over_allocation', 'cb_cash_adv.advance_allocation', 'cb_cash_adv.time_created', 'cb_cash_adv.split_status', 'cb_cash_adv.trx_no', 'cb_cash_adv.prefix', 'cb_cash_adv.year', 'cb_cash_adv.month', 'cb_cash_adv.code', 'sa_vehicle.vehicle_photo', 'sa_vehicle.vehicle_type', 'sa_vehicle.police_no', 'cb_cash_adv.spk_container_no'
            );

            $groupBy = '';
            if($param == 'pending'){
                $where_param = " cb_cash_adv.deleted = 0 AND cb_cash_adv.advance_balance != 0 AND cb_cash_adv.advance_type_rowID != 4 AND cb_cash_adv.advance_date BETWEEN '" . $start_date . "' AND '" . $end_date . "' AND sa_users.dep_rowID = " . $dep_rowID . "";
            }elseif($param == 'loan'){
                $where_param = " cb_cash_adv.deleted = 0 AND cb_cash_adv.advance_balance != 0 AND cb_cash_adv.advance_type_rowID = 4 AND sa_users.dep_rowID = " . $dep_rowID . " AND cb_cash_adv.advance_date BETWEEN '" . $start_date . "' AND '" . $end_date . "' ";
            }elseif($param == 'done'){
                $where_param = " cb_cash_adv.deleted = 0 AND cb_cash_adv.advance_balance = 0 AND sa_users.dep_rowID = " . $dep_rowID . " AND cb_cash_adv.advance_date BETWEEN '" . $start_date . "' AND '" . $end_date . "' ";
            }

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
                $sOrder .= " cb_cash_adv.advance_date DESC";
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
            
            if (!empty($dt['columns'][2]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }
                $start_date = date('Y-m-d', strtotime($dt['columns'][2]['search']['value']));
                $this->session->set_userdata('start_date_ca',date("Y-m-d",strtotime($start_date)));   

                if($this->session->userdata('end_date_ca') == ''){
                    $end_date = date("Y-m-d");
                }else{
                    $end_date = $this->session->userdata('end_date_ca');
                }
               
                if($param == 'pending'){
                    $where_param = " cb_cash_adv.deleted = 0 AND cb_cash_adv.advance_balance != 0 AND cb_cash_adv.advance_type_rowID != 4 AND sa_users.dep_rowID = " . $dep_rowID . " AND cb_cash_adv.advance_date BETWEEN '" . $start_date . "' AND '" . $end_date . "' ";
                }elseif($param == 'loan'){
                    $where_param = " cb_cash_adv.deleted = 0 AND cb_cash_adv.advance_balance != 0 AND cb_cash_adv.advance_type_rowID = 4 AND sa_users.dep_rowID = " . $dep_rowID . " AND cb_cash_adv.advance_date BETWEEN '" . $start_date . "' AND '" . $end_date . "' ";
                }elseif($param == 'done'){
                    $where_param = " cb_cash_adv.deleted = 0 AND cb_cash_adv.advance_balance = 0 AND sa_users.dep_rowID = " . $dep_rowID . " AND cb_cash_adv.advance_date BETWEEN '" . $start_date . "' AND '" . $end_date . "' ";
                } 
            }
            if (!empty($dt['columns'][3]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }
                $end_date = date('Y-m-d', strtotime($dt['columns'][3]['search']['value']));
                $this->session->set_userdata('end_date_ca',date("Y-m-d",strtotime($end_date)));

                 if($this->session->userdata('start_date_ca') == ''){
                    $start_date = date("Y-m-d", strtotime('-6 day'));
                }else{
                    $start_date = $this->session->userdata('start_date_ca');
                } 
               
                if($param == 'pending'){
                    $where_param = " cb_cash_adv.deleted = 0 AND cb_cash_adv.advance_balance != 0 AND cb_cash_adv.advance_type_rowID != 4 AND sa_users.dep_rowID = " . $dep_rowID . " AND cb_cash_adv.advance_date BETWEEN '" . $start_date . "' AND '" . $end_date . "' ";
                }elseif($param == 'loan'){
                    $where_param = " cb_cash_adv.deleted = 0 AND cb_cash_adv.advance_balance != 0 AND cb_cash_adv.advance_type_rowID = 4 AND sa_users.dep_rowID = " . $dep_rowID . " AND cb_cash_adv.advance_date BETWEEN '" . $start_date . "' AND '" . $end_date . "' ";
                }elseif($param == 'done'){
                    $where_param = " cb_cash_adv.deleted = 0 AND cb_cash_adv.advance_balance = 0 AND sa_users.dep_rowID = " . $dep_rowID . " AND cb_cash_adv.advance_date BETWEEN '" . $start_date . "' AND '" . $end_date . "' ";
                } 
            }

             /** Total Data Set Length * */
            $sQuery = "SELECT * FROM " . $dt['table'] . " LEFT JOIN sa_advance_type ON sa_advance_type.rowID = cb_cash_adv.advance_type_rowID 
            LEFT JOIN sa_debtor ON sa_debtor.rowID = cb_cash_adv.employee_driver_rowID LEFT JOIN sa_vehicle ON sa_vehicle.rowID = cb_cash_adv.vehicle_rowID LEFT JOIN sa_vehicle_type ON sa_vehicle_type.rowID = cb_cash_adv.vehicle_type_rowID LEFT JOIN sa_fare_trip_hdr ON sa_fare_trip_hdr.rowID = cb_cash_adv.fare_trip_rowID LEFT JOIN sa_destination as destination_from ON destination_from.rowID = sa_fare_trip_hdr.destination_from_rowID LEFT JOIN sa_destination as destination_to ON destination_to.rowID = sa_fare_trip_hdr.destination_to_rowID LEFT JOIN sa_users ON sa_users.rowID = cb_cash_adv.user_created LEFT JOIN sa_koordinat_poi as koordinat_poi_from ON koordinat_poi_from.rowID = destination_from.coordinate_rowID LEFT JOIN sa_koordinat_poi as koordinat_poi_to ON koordinat_poi_to.rowID = destination_to.coordinate_rowID WHERE " . $where_param;

            $rResultTotal = $this->db->query($sQuery);
            $aResultTotal = $rResultTotal->num_rows();
            $iTotal = $aResultTotal;

             /** Filtering * */
            $sWhere = "";
            $sSearchVal = $dt['search']['value'];
            if (isset($sSearchVal) && $sSearchVal != '') {
                $sWhere = " WHERE (";
                for ($i = 0; $i < count($aColumns); $i++) {
                    $sWhere .= $aColumnTable [$i] . " LIKE '%" . $this->db->escape_like_str($sSearchVal) . "%' OR ";
                }
                $sWhere = substr_replace($sWhere, "", -3);
                $sWhere .= ') AND  ' . $where_param;
            }

            /* Get Data To Display */
            if ($sWhere != "") {
                $where = $sWhere;
            } else {
                $where = " WHERE " . $where_param;
            }

            $join_table = ' LEFT JOIN sa_advance_type ON sa_advance_type.rowID = cb_cash_adv.advance_type_rowID LEFT JOIN sa_debtor ON sa_debtor.rowID = cb_cash_adv.employee_driver_rowID LEFT JOIN sa_vehicle ON sa_vehicle.rowID = cb_cash_adv.vehicle_rowID LEFT JOIN sa_vehicle_type ON sa_vehicle_type.rowID = cb_cash_adv.vehicle_type_rowID LEFT JOIN sa_fare_trip_hdr ON sa_fare_trip_hdr.rowID = cb_cash_adv.fare_trip_rowID LEFT JOIN sa_destination as destination_from ON destination_from.rowID = sa_fare_trip_hdr.destination_from_rowID LEFT JOIN sa_destination as destination_to ON destination_to.rowID = sa_fare_trip_hdr.destination_to_rowID LEFT JOIN sa_users ON sa_users.rowID = cb_cash_adv.user_created LEFT JOIN sa_koordinat_poi as koordinat_poi_from ON koordinat_poi_from.rowID = destination_from.coordinate_rowID LEFT JOIN sa_koordinat_poi as koordinat_poi_to ON koordinat_poi_to.rowID = destination_to.coordinate_rowID ';

            $sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) .
                    " FROM " . $dt['table'] . $join_table .  $where . $groupBy . $sOrder . $sLimit;
            $rResult = $this->db->query($sQuery);

            /* Data set length after filtering */
            $sQuery = "SELECT FOUND_ROWS() AS length_count ";
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

                    $total_balance = ($aRow['advance_amount'] + $aRow['advance_extra_amount'] + $aRow['pay_over_allocation']) - $aRow['advance_allocation'];
                    $get_memo = $this->finances_model->get_memo_by_advance_no($aRow['advance_no']);


                    $tag_no_do = '';
                    if($param == 'done'){
                        $check_no_do = $this->finances_model->check_no_do_by_trx_no($aRow['trx_no']);
                        if(count($check_no_do) > 0){
                            $tag_no_do = '<span style="color: #c00">#</span>';
                        }
                    }
                   

                    $dropdown_option = '<div class="btn-group">';
                    $dropdown_option .= '<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">';
                    $dropdown_option .= lang('options');
                    $dropdown_option .= '<span class="caret"></span>';
                    $dropdown_option .= '</button>';
                    $dropdown_option .= '<ul class="dropdown-menu">';
                    if($this->get_user_access_branch('Viewed') == 1){
                        $dropdown_option .= '<li><a href="' . base_url() .'finances/view_cash_advance/' . $aRow['rowID'] .'" title="' .lang('view_cashadvance_option') . '" ><i class="fa fa-eye"></i> ' . lang('view_cashadvance_option') . '</a></li>';
                    }
                    $dropdown_option .= '<li><a href="javascript:void()" title="Memo" onclick="memo_ca(\''. $aRow['advance_no'] .'\')"><i class="fa fa-sticky-note"></i> Memo</a></li>';  

                    if($param != 'done'){
                        if($total_balance > 0){
                            if($aRow['trx_no'] == ''){
                                if($this->get_user_access_branch('Created') == 1){
                                    if($aRow['split_status'] == 0 || $aRow['split_status'] == 2){
                                        $dropdown_option .= '<li><a href="javascript:void()" title="' . lang('realization_option') . '" onclick="edit_realization(\'' . $aRow['prefix'] . '\',\''. $aRow['year'] . '\',\'' . $aRow['month']. '\',\'' . $aRow['code'] . '\')"><i class="fa fa-usd"></i> ' . lang('realization_option') . '</a></li>';
                                    }else{
                                        $dropdown_option .= '<li><a href="javascript:void()" title="Second Payment" onclick="second_payment(\'' . $aRow['advance_no'] .'\')"><i class="fa fa-usd"></i> Second Payment</a></li>';
                             
                                    }
                                }
                            }else{
                                if($this->get_user_access_branch('PrintLimited') == 1 || $this->get_user_access_branch('PrintUnlimited') == 1 || $this->get_user_access_branch('PrintOne') == 1 || $this->get_user_access_branch('PrintTwo') == 1){

                                    if($this->get_user_access_branch('PrintLimited') == 1){
                                        if($this->user_profile->get_log_limited_printed($aRow['trx_no'],'Finances->Print Realization') == 0){
                                            $dropdown_option .= '<li><a title="' . lang('view_realization_option') . '" href="' . base_url() . 'finances/view_realization/' . $this->encrypt->encode($aRow['trx_no']) . '" target="_blank"><i class="fa fa-eye"></i> ' . lang('view_realization_option') . '</a></li>';
                                        }
                                    }else{
                                         $dropdown_option .= '<li><a title="' . lang('view_realization_option') . '" href="' . base_url() .'finances/view_realization/' . $this->encrypt->encode($aRow['trx_no']) . '" target="_blank"><i class="fa fa-eye"></i> ' . lang('view_realization_option') . '</a></li>';
                                    }
                                }
                            }
                        }else{
                            if($this->get_user_access_branch('PrintLimited') == 1 || $this->get_user_access_branch('PrintUnlimited') == 1 || $this->get_user_access_branch('PrintOne') == 1 || $this->get_user_access_branch('PrintTwo') == 1){

                                if($this->get_user_access('PrintLimited') == 1){
                                    if($this->user_profile->get_log_limited_printed($aRow['trx_no'],'Finances->Print Realization') == 0){
                                        $dropdown_option .= '<li><a title="' . lang('view_realization_option') .'" href="' . base_url() . 'finances/view_realization/' . $this->encrypt->encode($aRow['trx_no']) . '" target="_blank"><i class="fa fa-eye"></i> ' . lang('view_realization_option') . '</a></li>';
                                    }
                                } else{
                                    $dropdown_option .= '<li><a title="' . lang('view_realization_option') . '" href="' . base_url() . 'finances/view_realization/' . $this->encrypt->encode($aRow['trx_no']) . '" target="_blank"><i class="fa fa-eye"></i> '.lang('view_realization_option') . '</a></li>';
                                }
                            }
                        }

                        $advance_allocation = $aRow['advance_allocation'];
                        if($advance_allocation == 0){
                            if($this->get_user_access_branch('Deleted') == 1){
                                $get_data_cash_bank = $this->finances_model->get_cash_bank_by_advance_no($aRow['advance_no']);
                                if(count($get_data_cash_bank) == 0){
                                    $dropdown_option .= '<li><a title="' . lang('delete_option') .'" href="' . base_url() . 'finances/delete_cash_advance/' . $this->encrypt->encode($aRow['prefix']) . '/' . $this->encrypt->encode($aRow['year']) . '/' . $this->encrypt->encode($aRow['month']) . '/' . $this->encrypt->encode($aRow['code']) . '" data-toggle="ajaxModal"><i class="fa fa-trash-o"></i> ' . lang('delete_option') . '</a></li>';
                                }
                            }
                        }    
                    }else{
                        $advance_allocation = $aRow['advance_allocation'];
                        if($advance_allocation == 0){
                            if($this->get_user_access_branch('Deleted') == 1){
                                $get_data_cash_bank = $this->finances_model->get_cash_bank_by_advance_no($aRow['advance_no']);
                                if(count($get_data_cash_bank) == 0){
                                    $dropdown_option .= '<li><a title="' . lang('delete_option') .'" href="' . base_url() . 'finances/delete_cash_advance/' . $this->encrypt->encode($aRow['prefix']) . '/' . $this->encrypt->encode($aRow['year']) . '/' . $this->encrypt->encode($aRow['month']) . '/' . $this->encrypt->encode($aRow['code']) . '" data-toggle="ajaxModal"><i class="fa fa-trash-o"></i> ' . lang('delete_option') . '</a></li>';
                                }
                            }
                        }  

                        if($this->get_user_access_branch('PrintLimited') == 1 || $this->get_user_access_branch('PrintUnlimited') == 1 || $this->get_user_access_branch('PrintOne') == 1 || $this->get_user_access_branch('PrintTwo') == 1){

                            if($this->get_user_access_branch('PrintLimited') == 1){
                                if($this->user_profile->get_log_limited_printed($aRow['trx_no'],'Finances->Print Realization') == 0){
                                    $dropdown_option .= '<li><a title="' . lang('view_realization_option') . '" href="' . base_url() . 'finances/view_realization/' . $this->encrypt->encode($aRow['trx_no']) . '" target="_blank"><i class="fa fa-eye"></i> ' . lang('view_realization_option') . '</a></li>';
                                }
                            }else{
                                 $dropdown_option .= '<li><a title="' . lang('view_realization_option') . '" href="' . base_url() .'finances/view_realization/' . $this->encrypt->encode($aRow['trx_no']) . '" target="_blank"><i class="fa fa-eye"></i> ' . lang('view_realization_option') . '</a></li>';
                            }
                        }  
                    }
                    
                           
                   
                    $dropdown_option .= '</ul></div>';

                    $row['options'] = $dropdown_option;
                    $row['advance_no'] = $aRow['advance_no'] . $tag_no_do;
                    $row['advance_date'] = date("d-m-Y H:i:s",strtotime($aRow['advance_date'] .' '. $aRow['time_created']));
                    $row['end_date'] = date("d-m-Y",strtotime($aRow['advance_date']));
                    $row['debtor'] = $aRow['debtor_cd'] . ' - ' . $aRow['debtor_name'];
                    if($param != 'loan'){
                        $row['fare_trip_cd'] = ($aRow['fare_trip_cd'] == '' ) ? '-' : str_replace('-',' - ', $aRow['fare_trip_cd']);
                    }

                    $vehicle = $this->finances_model->get_position_vehicle_by_row_id($aRow['vehicle_rowID']);
                    $status = '';
                    $color = '';
                    if($vehicle->status == '11' && $vehicle->speed > 0 ){
                        $status = 'Jalan';
                        $color = "background-color:#5cb85c;";
                    }
                    else if($vehicle->status == '11' && $vehicle->speed <= 0 ){
                        $status = 'Macet/Antri/Parkir';
                        $color = "background-color:#eac545;";
                    }
                    else if($vehicle->status == '01' && $vehicle->speed <= 0 ){
                        $status = 'Makan AKI';
                        $color = "background-color:#57b9f8;";
                    }
                    else if($vehicle->status == '00' && $vehicle->speed <= 0 ){
                        $status = 'Berhenti';
                        $color = "background-color:#f94c4c;";
                    }
                    else if($vehicle->status == '10' && $vehicle->speed > 0 ){
                        $status = 'Check Instalasi ACC & Engine';
                        $color = "background-color:#000;";
                    }
                    else if($vehicle->status == '10' && $vehicle->speed <= 0 ){
                        $status = 'Mohon diperiksa';
                        $color = "background-color:#1BDAC5;";
                    }
                    else{
                        $status = 'Data Tidak Tersedia';
                        $color = "background-color:#B0B0B0;";
                    }
                    
                    if($status != 'Data Tidak Tersedia'){
                        if(date('Y-m-d',strtotime($vehicle->datetime_gps)) != date('Y-m-d')){
                            $status = 'Out Of The Date';
                            $color = "background-color:#B0B0B0;";
                        }
                    }
                    
                    $star = '';
                    if($aRow['vehicle_photo'] == ''){
                        $star = '*';
                    }
                    
                    $speed = empty($vehicle->speed) ? 0 : $vehicle->speed;
                    $vehicle_type = $aRow['vehicle_type'] == '' ? '-' : $aRow['vehicle_type'];
                    $row['police_no'] = "<a href='javascript:void()' title='" . $status . "' onclick=\"showDetailPositionVehicle('". $aRow['vehicle_rowID'] ."')\"> <span class='badge' style='".$color."'>". $aRow['police_no'] . ' '. $star ."</span></a> <br>" . $vehicle_type . "<br>" . $speed . " km/h";
                    $row['advance_amount'] = number_format($aRow['advance_amount'],0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));
                    $row['advance_extra_amount'] = number_format($aRow['advance_extra_amount'],0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));
                    $row['pay_over_allocation'] = number_format($aRow['pay_over_allocation'] ,0,',','.');
                    $row['advance_allocation'] =  number_format($aRow['advance_allocation'],0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));
                    $row['total_balance'] = number_format($total_balance,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));
                    $row['total_memo'] = count($get_memo);
                    $row['container_no'] = $aRow['spk_container_no'];
                    
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

    function fetch_data_detail_all_faretrip() { 
        if ($this->input->is_ajax_request()) {
            $dt = $_POST;

            $dt['table'] = 'sa_fare_trip_hdr';
            $dt['id'] = 'rowID';

            $aColumnTable = array(
                'sa_fare_trip_hdr.rowID', 'fare_trip_cd', 'destination_from.destination_no', 'destination_from.destination_name', 'destination_to.destination_no', 'destination_to.destination_name', 'trip_condition', 'distance', 'trip_type', 'sa_vehicle_type.type_name', 'sa_cost.descs', 'split', 'total', 'vehicle_id', 'vehicle_type', 'min_amount','os_amount'
            );

            $aColumns = array(
              'sa_fare_trip_hdr.rowID', 'fare_trip_cd', 'destination_from.destination_no as destination_no_from', 'destination_from.destination_name as destination_name_from', 'destination_to.destination_no as destination_no_to', 'destination_to.destination_name as destination_name_to', 'trip_condition', 'distance', 'trip_type', 'sa_vehicle_type.type_name', 'sa_cost.descs', 'split', 'total', 'vehicle_id', 'vehicle_type', 'min_amount','os_amount'
            );

            $groupBy = '';
            /** Total Data Set Length * */
            $sQuery = "SELECT * FROM " . $dt['table'] . " INNER JOIN sa_vehicle_type ON sa_vehicle_type.rowID = sa_fare_trip_hdr.vehicle_id INNER JOIN sa_cost ON sa_cost.rowID = sa_fare_trip_hdr.cost_id LEFT JOIN sa_destination as destination_from ON destination_from.rowID = sa_fare_trip_hdr.destination_from_rowID LEFT JOIN sa_destination as destination_to ON destination_to.rowID = sa_fare_trip_hdr.destination_to_rowID LEFT JOIN sa_koordinat_poi as koordinat_from ON koordinat_from.rowID = destination_from.coordinate_rowID LEFT JOIN sa_koordinat_poi as koordinat_to ON koordinat_to.rowID = destination_to.coordinate_rowID WHERE sa_fare_trip_hdr.deleted = 0 AND sa_fare_trip_hdr.status = 1 ";
            $rResultTotal = $this->db->query($sQuery);
            $aResultTotal = $rResultTotal->num_rows();
            $iTotal = $aResultTotal;

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
                $sOrder .= "fare_trip_cd ASC, sa_fare_trip_hdr.rowID DESC";
            }

            /** Filtering * */
            $sWhere = "";
            $sSearchVal = $dt['search']['value'];
            if (isset($sSearchVal) && $sSearchVal != '') {
                $sWhere = " WHERE (";
                for ($i = 0; $i < count($aColumns); $i++) {
                    $sWhere .= $aColumnTable [$i] . " LIKE '%" . $this->db->escape_like_str($sSearchVal) . "%' OR ";

                    // Seacrh trip type
                    if ($sSearchVal == 'bulk' || $sSearchVal == 'BULK' || $sSearchVal == 'Bulk'){
                        $sWhere .= $aColumnTable [8] . " LIKE '%" . $this->db->escape_like_str(1) . "%' OR ";
                    }else{
                        if ($sSearchVal == 'CONTAINER' || $sSearchVal == 'container' || $sSearchVal == 'Container'){
                            $sWhere .= $aColumnTable [8] . " LIKE '%" . $this->db->escape_like_str(2) . "%' OR ";
                        }elseif ($sSearchVal == 'OTHERS' || $sSearchVal == 'others' || $sSearchVal == 'Others'){
                            $sWhere .= $aColumnTable [8] . " LIKE '%" . $this->db->escape_like_str(3) . "%' OR ";
                        }
                    }

                    // Seacrh split
                    if ($sSearchVal == 'yes' || $sSearchVal == 'YES' || $sSearchVal == 'Yes'){
                        $sWhere .= $aColumnTable [11] . " LIKE '%" . $this->db->escape_like_str(1) . "%' OR ";
                    }elseif ($sSearchVal == 'no' || $sSearchVal == 'NO' || $sSearchVal == 'No'){
                        $sWhere .= $aColumnTable [11] . " LIKE '%" . $this->db->escape_like_str(0) . "%' OR ";
                    }
                }
                $sWhere = substr_replace($sWhere, "", -3);
                $sWhere .= ') AND sa_fare_trip_hdr.deleted = 0 AND sa_fare_trip_hdr.status = 1 ';
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
            
            /* Get Data To Display */
            if ($sWhere != "") {
                $where = $sWhere;
            } else {
                $where = " WHERE sa_fare_trip_hdr.deleted = 0 AND sa_fare_trip_hdr.status = 1 ";
            }

            $join_table = ' INNER JOIN sa_vehicle_type ON sa_vehicle_type.rowID = sa_fare_trip_hdr.vehicle_id INNER JOIN sa_cost ON sa_cost.rowID = sa_fare_trip_hdr.cost_id LEFT JOIN sa_destination as destination_from ON destination_from.rowID = sa_fare_trip_hdr.destination_from_rowID LEFT JOIN sa_destination as destination_to ON destination_to.rowID = sa_fare_trip_hdr.destination_to_rowID LEFT JOIN sa_koordinat_poi as koordinat_from ON koordinat_from.rowID = destination_from.coordinate_rowID LEFT JOIN sa_koordinat_poi as koordinat_to ON koordinat_to.rowID = destination_to.coordinate_rowID ';

            $sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) .
                    " FROM " . $dt['table'] . $join_table .  $where . $groupBy . $sOrder . $sLimit;
            $rResult = $this->db->query($sQuery);

            /* Data set length after filtering */
            $sQuery = "SELECT FOUND_ROWS() AS length_count ";
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

                    $trip_type = '-';
                    if ($aRow['trip_type'] == '1'){
                        $trip_type = "BULK";
                    }else{
                        if ($aRow['trip_type'] == '2'){
                            $trip_type = "CONTAINER";
                        }else{
                            $trip_type = "OTHERS";
                        }
                    }

                    $split = '-';
                    if ($aRow['split'] == '1'){
                        $split = "Yes";
                    }else{
                        $split = "No";
                    }

                    $row['fare_trip_cd'] = $aRow['fare_trip_cd'];
                    $row['destination_from'] = $aRow['destination_no_from'] . ' - ' . $aRow['destination_name_from'];
                    $row['destination_from_name'] = $aRow['destination_name_from'];
                    $row['destination_to'] = $aRow['destination_no_to'] . ' - ' . $aRow['destination_name_to'];
                    $row['destination_to_name'] = $aRow['destination_name_to'];
                    $row['trip_condition'] = strtoupper($aRow['trip_condition']);
                    $row['distance'] = number_format($aRow['distance'], 0, ',', '.');
                    $row['trip_type'] = $trip_type;
                    $row['type_name'] = strtoupper($aRow['type_name']);
                    $row['descs'] = strtoupper($aRow['descs']);
                    $row['split'] = $split;
                    $row['total'] = number_format($aRow['total'], 0, ',', '.');

                    // Hide by Ajax Server Side
                    $row['fare_trip_id'] = $aRow['rowID'];
                    $row['fare_trip_desc'] = $row['destination_from'] . ' ' . lang('to') . ' ' . $row['destination_to'];
                    $row['vehicle_type_id'] = $aRow['vehicle_id'];
                    $row['vehicle_type'] = strtoupper($aRow['vehicle_type']);
                    $row['min_amount'] = number_format($aRow['min_amount'], 0, ',', '.');
                    $row['os_amount'] = number_format($aRow['os_amount'], 0, ',', '.');
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
}
