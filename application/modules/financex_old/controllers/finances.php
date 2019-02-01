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
        
        if($this->session->userdata('start_date') == '' && $this->session->userdata('end_date') == ''){
            $start_date = date("Y-m-d");
            $end_date = date("Y-m-d");
        }
        else{
            $start_date = $this->session->userdata('start_date');
            $end_date = $this->session->userdata('end_date');
        }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
            
        $data['cash_advance_lists'] = $this->finances_model->get_all_records_list($this->
            session->userdata('partial_data'), $this->session->userdata('dep_rowID'),$start_date,$end_date);
            
        $data['cash_advance_lists_bonus_nol'] = $this->finances_model->get_all_records_list_bonus_nol($this->
            session->userdata('partial_data'), $this->session->userdata('dep_rowID'),$start_date,$end_date);

        $data['cash_advance_types'] = $this->appmodel->get_all_records($table =
            'sa_advance_type', $array = array('deleted' => 0), $join_table = '', $join_criteria =
            '', 'rowID', 'ASC');

        $data['drivers'] = $this->finances_model->get_all_antrian_today();
        $data['debtors'] = $this->debtor_model->get_all_records($table = 'sa_debtor', $array =
            array('rowID >' => '0', 'deleted' => '0'), $join_table = '', $join_criteria = '',
            'debtor_name', 'asc');

        $data['vehicles'] = $this->appmodel->get_all_records($table = 'sa_vehicle', $array =
            array('deleted' => 0, 'status' => 0), $join_table = '', $join_criteria = '',
            'police_no', 'ASC');

        $data['cash_advance_jo'] = $this->finances_model->get_data_cash_advance_jo();

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
    
    function set_filter(){
       $this->session->set_userdata('start_date',date("Y-m-d",strtotime($this->input->post('start_date'))));
       $this->session->set_userdata('end_date',date("Y-m-d",strtotime($this->input->post('end_date'))));    
       
       redirect(base_url().'finances/cash_advance_list');
    }
    
    function view_cash_advance($rowID)
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('cash_advance_list') . ' - ' . $this->config->item('website_name') .
            ' - ' . $this->config->item('comp_name') . ' ' . $this->config->item('version'));
        $data['page'] = lang('cash_advance_list');
        $this->session->set_userdata('page_header', 'transaction');
        $this->session->set_userdata('page_detail', 'cash_advance_list');
        
        $get_data = $this->finances_model->get_all_records_list_by_id($rowID);
        $data['all_data'] = $get_data;

        $this->template->set_layout('users')->build('view_detail', isset($data) ? $data : null);
    }

    function view_realization($value)
    {
        $trx_no = $this->encrypt->decode($value);
        $data['cash_advance'] = $this->finances_model->get_cash_advance_by_trx_no($trx_no);
        $data['documents'] = $this->finances_model->get_document_by_trx_no($trx_no);
        $data['costs'] = $this->finances_model->get_cost_by_trx_no($trx_no);
        
        if($data['cash_advance']->advance_type_rowID == '1'){
            $html = $this->load->view('realization_pdf', $data, true);
        }
        else{
            $html = $this->load->view('realization_others_pdf', $data, true);
        }

        $params['user_rowID'] = $this->tank_auth->get_user_id();
        $params['module'] = 'Finances->Print Realization';
        $params['module_field_id'] = $trx_no;
        $params['activity'] = ucfirst('Print realization trx no. ' . $trx_no);
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

        $cash_advance_rowID = $dataPost['cash_advance_type2'];
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
            'month' => $cash_out_month), 'code')) + 1;

        $cash_advance_no = $cash_out_prefix_cd . sprintf("%04s", $cash_out_year) .
            sprintf("%02s", $cash_out_month) . sprintf("%05s", $new_cash_advance_code);
        $new_gl_coa_code = ((int)$this->appmodel->select_max_id('gl_trx_hdr', $array =
            array(
            'prefix' => $sa_spec_prefix,
            'year' => $cash_out_year,
            'month' => $cash_out_month), 'code')) + 1;
        $gl_coa_no = $sa_spec_prefix . sprintf("%04s", $cash_out_year) . sprintf("%02s",
            $cash_out_month) . sprintf("%05s", $new_gl_coa_code);
        
        
        $sa_spec_cb = $this->db->get_where('sa_spec', array('deleted' => 0, 'rowID' => 1))->
                row_array();
        $sa_spec_prefix_cb = $sa_spec_cb['cash_out_prefix'];
        
        $alloc_code_cb = ((int)$this->appmodel->select_max_id('cb_trx_hdr', $array = array
            (
            'prefix' => $sa_spec_prefix_cb,
            'year' => date('Y', strtotime($dataPost['date_ca'])),
            'month' => date('m', strtotime($dataPost['date_ca']))), 'code')) + 1;
            
        $trx_no_cb = $sa_spec_prefix_cb . sprintf("%04s", date('Y', strtotime($dataPost['date_ca']))) . sprintf("%02s",
            date('m', strtotime($dataPost['date_ca']))) . sprintf("%05s", $alloc_code_cb);
        
        $this->db->trans_begin(); # Starting Transaction
        
        if (empty($dataPost['advance_no']))
        {
            $this->finances_model->simpanCashAdvance($cash_out_prefix_cd, $new_cash_advance_code,
                $cash_advance_no, $dataPost);
            $this->finances_model->simpanCashBankHeader($sa_spec_prefix_cb, $alloc_code_cb,
                $cash_advance_no, $cash_gl_rowID, $advance_name, $debtor_name, $trx_no_cb, $dataPost);            
            $this->finances_model->simpan_gl_header_doc($sa_spec_prefix, $new_gl_coa_code, $gl_coa_no, $cash_out_prefix_cd, 
                $cash_advance_no, $advance_name, $debtor_name, $new_cash_advance_code, $dataPost);    
            $this->finances_model->simpan_gl_detail_doc_debet($sa_spec_prefix, $new_gl_coa_code, $gl_coa_no, $cash_out_prefix_cd, 
                $receiveable_rowID, $advance_name, $debtor_name, $new_cash_advance_code, $cash_advance_no, $dataPost);
            $this->finances_model->simpan_gl_detail_doc_kredit($sa_spec_prefix, $new_gl_coa_code, $gl_coa_no, $cash_gl_rowID, 
                $advance_name, $debtor_name, $cash_out_prefix_cd, $new_cash_advance_code, $cash_advance_no, $dataPost);
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

            $info = lang('cash_advance_realixation_registered_successfully');
            echo json_encode(array('success' => true, 'msg' => $info));
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
                        'month' => $cash_out_month), 'code')) + 1;

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
                        'month' => $cash_out_month), 'code')) + 1;

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

        $get_access = $this->appmodel->get_data_access_by_user($this->tank_auth->get_user_id(), 52, 'PrintUnlimited');
        if(count($get_access) > 0){
            
            // Update data printed
            $this->finances_model->update_cash_advance_printed($rowID);
            
            // Insert to log
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Print Cash Advance';
            $params['module_field_id'] = $all_data->rowID;
            $params['activity'] = ucfirst('Print a cash advance no. ' . $all_data->advance_no);
            $params['icon'] = 'fa-print';
            modules::run('activitylog/log', $params); //log activity        
    
            $data['all_data'] = $all_data;
                            
            $html = $this->load->view('view_detail_pdf', $data, true);
            
            $this->pdf_generator->generate($html, 'cash advance pdf',$orientation='Portrait');
            
        }
        else{
            $get_access = $this->appmodel->get_data_access_by_user($this->tank_auth->get_user_id(), 52, 'PrintLimited');
            if(count($get_access) > 0){
                $get_activities = $this->appmodel->get_data_activities_by_user($this->tank_auth->get_user_id(), 'Print Cash Advance', $all_data->rowID);        
                if(count($get_activities) == 0){
    
                    // Update data printed
                    $this->finances_model->update_cash_advance_printed($rowID);
                    
                    // Insert to log
                    $params['user_rowID'] = $this->tank_auth->get_user_id();
                    $params['module'] = 'Print Cash Advance';
                    $params['module_field_id'] = $all_data->rowID;
                    $params['activity'] = ucfirst('Print a cash advance no. ' . $all_data->advance_no);
                    $params['icon'] = 'fa-print';
                    modules::run('activitylog/log', $params); //log activity        
            
                    $data['all_data'] = $all_data;
                                    
                    $html = $this->load->view('view_detail_pdf', $data, true);
                    
                    $this->pdf_generator->generate($html, 'cash advance pdf',$orientation='Portrait');
    
                }
                else{
                    $this->session->set_flashdata('error',lang('not_have_access'));
                    redirect(base_url().'finances/view_cash_advance/'.$rowID);
                }
            }
            else{
                $this->session->set_flashdata('error',lang('not_have_access'));
                redirect(base_url().'finances/view_cash_advance/'.$rowID);        
            }
        }        
        
        
    }
    
    /* Print langsung kodingan
    function print_ca($rowID)
    {
        $all_data = $this->finances_model->get_all_records_list_by_id($rowID);
        
        // Update data printed
        $this->finances_model->update_cash_advance_printed($rowID);
        
        // Insert to log
        $params['user_rowID'] = $this->tank_auth->get_user_id();
        $params['module'] = 'Print Cash Advance';
        $params['module_field_id'] = $all_data->code;
        $params['activity'] = ucfirst('Print a cash advance no. ' . $all_data->advance_no);
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
        $fare_trips = $this->fare_trip_model->get_all_record_data();

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
                    'trip_condition' => ucwords(strtolower($fare_trip->trip_condition)),
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
                if ($hasher->CheckPassword($password, $user->password))
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

            $gl_year = date('Y');
            $gl_month = date('m');
            $gl_date = date('Y-m-d');


            $sa_spec_prefix = $this->appmodel->get_id($table = 'sa_spec', $array = array('deleted' =>
                    0, 'rowID' => 1), 'memorial_jrn');

            $new_gl_coa_code = ((int)$this->appmodel->select_max_id('gl_trx_hdr', $array =
                array(
                'prefix' => $sa_spec_prefix,
                'year' => $gl_year,
                'month' => $gl_month), 'code')) + 1;

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


            $this->db->trans_begin();

            $this->db->where('prefix', $ca_prefix);
            $this->db->where('year', $ca_year);
            $this->db->where('month', $ca_month);
            $this->db->where('code', $ca_code);
            $this->db->update('cb_cash_adv', $cash_advance_data);

            $get_ca = $this->finances_model->get_row_ca_by_no($ca_prefix, $ca_year, $ca_month, $ca_code);            
            $this->db->where('advance_invoice_trx_no', $get_ca->advance_no);
            $this->db->update('cb_trx_hdr', $cash_book_data);

            $this->db->insert('gl_trx_hdr', $gl_trx_hdr_data);
            $this->db->insert_batch('gl_trx_dtl', $gl_dtl_data);

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
                redirect('finances/cash_advance_list');
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
                redirect('finances/cash_advance_list');
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
            'month' => $alloc_date_month), 'code')) + 1;
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

        $alloc_date = date('Y-m-d', strtotime($dataPost['date']));
        $alloc_date_year = date('Y', strtotime($dataPost['date']));
        $alloc_date_month = date('m', strtotime($dataPost['date']));

        $sa_spec = $this->db->get_where('sa_spec', array('deleted' => 0, 'rowID' => 1))->
            row_array();
        $sa_spec_prefix = $sa_spec['memorial_jrn'];
        $alloc_code = ((int)$this->appmodel->select_max_id('cb_cash_adv_alloc', $array =
            array(
            'prefix' => $sa_spec_prefix,
            'year' => $alloc_date_year,
            'month' => $alloc_date_month), 'code')) + 1;
        $alloc_no = $sa_spec_prefix . sprintf("%04s", $alloc_date_year) . sprintf("%02s",
            $alloc_date_month) . sprintf("%05s", $alloc_code);
        $new_gl_coa_code = ((int)$this->appmodel->select_max_id('gl_trx_hdr', $array =
            array(
            'prefix' => $sa_spec_prefix,
            'year' => $alloc_date_year,
            'month' => $alloc_date_month), 'code')) + 1;
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
            'month' => $cash_out_month), 'code')) + 1;

        //$cash_advance_no = $cash_out_prefix_cd . sprintf("%04s", $cash_out_year) . sprintf("%02s", $cash_out_month) . sprintf("%05s", $new_cash_advance_code);
        $cash_advance_no = $dataPost['cash_advance_no'];
        
        $sql = "SELECT * FROM cb_cash_adv WHERE advance_no = '".$cash_advance_no."' AND on_process = ".$dataPost['on_process'];
        $cek_on_process = $this->db->query($sql)->num_rows();
        
        if($cek_on_process == 1){
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
    
            if ($error == false)
            {
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
                if ($result)
                {
                    $result = $this->finances_model->update_cash_advance($alloc_no,$dataPost);
                    if ($result)
                    {
                        if (!empty($dataPost['detailDO']))
                        {
                            foreach ($dataPost['detailDO'] as $detDO)
                            {
                                $result = $this->finances_model->simpan_data_do($sa_spec_prefix, $alloc_code, $alloc_no,
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
    
                $info = lang('cash_advance_realixation_registered_successfully');
                echo json_encode(array('success' => true, 'msg' => $info));
                exit();
            }
            
            return $status;
        }
        else{
            echo json_encode(array('success' => false, 'msg' => "Data in other realization process!"));
            exit();
        }

    }


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

    function returnCostCodesAjax()
    {
        $term = $this->input->get('term');
        echo json_encode($this->finances_model->getCostCode($term, 'rowID,cost_cd,descs'));
    }

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

    function create_refund_hdr()
    {

        if ($this->input->post())
        {

            $refund_date = date('Y-m-d', strtotime($this->input->post('date')));
            $refund_year = date('Y', strtotime($this->input->post('date')));
            $refund_month = date('m', strtotime($this->input->post('date')));
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
                'month' => $refund_month), 'code')) + 1;

            $refund_no = $sa_spec_prefix . sprintf("%04s", $refund_year) . sprintf("%02s", $refund_month) .
                sprintf("%05s", $refund_code);
            
            $cash_gl_rowID = $this->appmodel->get_id($table = 'sa_dep', $array = array('deleted' =>
                    0, 'rowID' => $this->session->userdata('dep_rowID')), 'cash_gl_rowID');

            $i = 0;
            $ttl_refund_amount = 0;
            foreach ($advance_no as $advance_no_)
            {
                if (!empty($advance_no_))
                {
                    $jumlah_refund = str_replace('.','',$refund_amount[$i]);
                    if ($jumlah_refund > 0)
                    {
                        $refund_hdr_data[] = array(
                            'prefix' => $sa_spec_prefix,
                            'year' => $refund_year,
                            'month' => $refund_month,
                            'code' => $refund_code,
                            'row_no' => $i + 1,
                            'alloc_no' => $refund_no,
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
                            'date_created' => date('Y-m-d'),
                            'time_created' => date('H:i:s'));
                        
                        $refund_code_cb = ((int)$this->appmodel->select_max_id('cb_trx_hdr', $array =
                            array(
                            'prefix' => $sa_spec_prefix,
                            'year' => $refund_year,
                            'month' => $refund_month), 'code')) + 1;
            
                        $refund_no_cb = $sa_spec_prefix . sprintf("%04s", $refund_year) . sprintf("%02s", $refund_month) .
                            sprintf("%05s", $refund_code_cb);

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
                            'date_created' => date('Y-m-d'),
                            'time_created' => date('H:i:s')
                        );
                        
                        $this->db->insert('cb_trx_hdr', $cb_trx_data);
                        
                        $data = array(
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
                            'date_created' => date('Y-m-d'),
                            'time_created' => date('H:i:s')
                        );
                        $this->db->insert('cb_trx_dtl', $data);
                            
                        $ttl_refund_amount += $jumlah_refund;

                    }
                    $i++;
                }
            }

            $refund_gl_rowID = $this->appmodel->get_id($table = 'sa_dep', $array = array('deleted' =>
                    0, 'rowID' => $this->session->userdata('dep_rowID')), 'cash_gl_rowID');

            $gl_sa_spec_prefix = $this->appmodel->get_id($table = 'sa_spec', $array = array
                ('deleted' => 0, 'rowID' => 1), 'general_jrn');

            $new_gl_coa_code = ((int)$this->appmodel->select_max_id('gl_trx_hdr', $array =
                array(
                'prefix' => $gl_sa_spec_prefix,
                'year' => $refund_year,
                'month' => $refund_month), 'code')) + 1;

            $gl_coa_no = $gl_sa_spec_prefix . sprintf("%04s", $refund_year) . sprintf("%02s",
                $refund_month) . sprintf("%05s", $new_gl_coa_code);


            $debtor_type_rowID = $this->appmodel->get_id($table = 'sa_debtor', $array =
                array('deleted' => 0, 'rowID' => $driver_refund), 'debtor_type_rowID');
            $receiveable_rowID = $this->appmodel->get_id($table = 'sa_debtor_type', $array =
                array('deleted' => 0, 'rowID' => $debtor_type_rowID), 'receiveable_coa_rowID');


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
                'ref_code' => $refund_code,
                'ref_no' => $refund_no,
                'ref_date' => $refund_date,
                'user_created' => $this->session->userdata('user_rowID'),
                'date_created' => date('Y-m-d'),
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
                'gl_trx_hdr_ref_code' => $refund_code,
                'gl_trx_hdr_ref_no' => $refund_no,
                'gl_trx_hdr_ref_date' => $refund_date,
                'modul' => 'GL',
                'cash_flow' => 'N',
                'base_amt' => 0,
                'tax_no' => '',
                'user_created' => $this->session->userdata('user_rowID'),
                'date_created' => date('Y-m-d'),
                'time_created' => date('H:i:s'));
            $i = 0;
            $row = 1;
            foreach ($advance_no as $advance_no_)
            {
                if (!empty($advance_no_))
                {
                    $jumlah_refund = str_replace('.','',$refund_amount[$i]);
                    if ($jumlah_refund > 0)
                    {

                        $gl_trx_dtl_k_data[] = array(
                            'gl_trx_hdr_prefix' => $gl_sa_spec_prefix,
                            'gl_trx_hdr_year' => $refund_year,
                            'gl_trx_hdr_month' => $refund_month,
                            'gl_trx_hdr_code' => $new_gl_coa_code,
                            'row_no' => $row + 1,
                            'gl_trx_hdr_journal_no' => $gl_coa_no,
                            'gl_trx_hdr_journal_date' => $refund_date,
                            'coa_rowID' => $receiveable_rowID,
                            'descs' => 'PIUTANG EMPLOYEE/DRIVER NO CA : ' . $advance_no[$i],
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
                            'date_created' => date('Y-m-d'),
                            'time_created' => date('H:i:s'));

                    }
                    $i++;
                    $row++;

                }
            }


            $this->db->trans_begin();
            $this->db->insert_batch('cb_cash_adv_alloc', $refund_hdr_data);
            $this->db->insert('gl_trx_dtl', $gl_trx_dtl_d_data);
            $this->db->insert_batch('gl_trx_dtl', $gl_trx_dtl_k_data);
            $this->db->insert('gl_trx_hdr', $gl_trx_hdr_data);

            $i = 0;
            foreach ($advance_no as $advance_no_)
            {
                if (!empty($advance_no_))
                {
                    $jumlah_refund = str_replace('.','',$refund_amount[$i]);
                    if ($jumlah_refund > 0)
                    {
                        $this->db->set('advance_allocation', 'advance_allocation+' . $jumlah_refund, false);
                        $this->db->set('advance_balance', 'advance_balance - '.$jumlah_refund, false);
                        $this->db->set('user_modified', $this->session->userdata('user_rowID'), false);
                        $this->db->set('date_modified', 'NOW()', false);
                        $this->db->set('time_modified', 'NOW()', false);
                        $this->db->where('prefix', $prefix[$i]);
                        $this->db->where('year', $year[$i]);
                        $this->db->where('month', $month[$i]);
                        $this->db->where('code', $code[$i]);
                        $this->db->update('cb_cash_adv');
                    }
                }
                $i++;
            }
            if ($this->db->trans_status() === false)
            {
                # Something went wrong.
                $this->db->trans_rollback();

                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'ERROR ROLLBACK Finances->Realization';
                $params['module_field_id'] = $refund_code;
                $params['activity'] = ucfirst('Delete Refund No. ' . $refund_no);
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
                $params['module_field_id'] = $refund_code;
                $params['activity'] = ucfirst('Add a new Refund No. ' . $refund_no);
                $params['icon'] = 'fa-plus';
                modules::run('activitylog/log', $params); //log activity

                //return TRUE;
                $this->session->set_flashdata('response_status', 'success');
                $this->session->set_flashdata('message', lang('refund') . ' ' . lang('created_succesfully') .
                    '. Refund No.  ' . $refund_no);
                redirect('finances/cash_advance_list');
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
            $this->session->set_userdata('page_detail', 'cash_advance_list');
            $data['form'] = true;
            $data['datatables'] = true;


            $data['drivers'] = $this->appmodel->get_all_records($table = 'sa_debtor', $array =
                array('deleted' => 0, 'type <>' => 'C'), $join_table = '', $join_criteria = '',
                'debtor_name', 'ASC');

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
    
}
