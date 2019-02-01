<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Generate_commission extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('generate_commission_model');
        $this->load->model('appmodel');
        $this->load->library('pdf_generator');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('generate_commissions') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('generate_commissions');
        $this->session->set_userdata('page_header', 'transaction');
        $this->session->set_userdata('page_detail', 'generate_commission');
        $data['datatables'] = true;
        $data['form'] = true;
        
        // if($this->session->userdata('start_date_gc') == '' && $this->session->userdata('end_date_gc') == ''){
        //     $start_date = date("Y-m-d",strtotime("yesterday"));
        //     $end_date = date("Y-m-d");
        // }
        // else{
        //     $start_date = $this->session->userdata('start_date_gc');
        //     $end_date = $this->session->userdata('end_date_gc');
        // }

        if($this->session->userdata('start_date_gc') == '' ){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_gc')));
        }

        if($this->session->userdata('end_date_gc') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_gc')));
        }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        
        // $data['commissions'] = $this->generate_commission_model->get_all_commissions($start_date,$end_date);
        
        $this->template->set_layout('users')->build('lists', isset($data) ? $data : null);
    }
    
    function set_filter(){
       $this->session->set_userdata('start_date_gc',date("Y-m-d",strtotime($this->input->post('start_date'))));
       $this->session->set_userdata('end_date_gc',date("Y-m-d",strtotime($this->input->post('end_date'))));    
       
       redirect(base_url().'generate_commission');
    }

    function view_generate()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('generate_commissions') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('generate_commissions');
        $this->session->set_userdata('page_header', 'transaction');
        $this->session->set_userdata('page_detail', 'generate_commission');
        $data['datatables'] = true;
        $data['form'] = true;
       
        $this->template->set_layout('users')->build('generate_commissions', isset($data) ? $data : null);
    }
    
    function view_commission($comm_id)
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('generate_commissions') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('generate_commissions');
        $this->session->set_userdata('page_header', 'transaction');
        $this->session->set_userdata('page_detail', 'generate_commission');
        $data['datatables'] = true;
        $data['form'] = true;
        $data['commission'] = $this->generate_commission_model->get_all_commission_by_comm_id($comm_id);
        $data['commission_details'] = $this->generate_commission_model->get_all_commission_detail_by_comm_id($comm_id);
       
        $this->template->set_layout('users')->build('view_commissions', isset($data) ? $data : null);
    }
    
    function download_detail_do($comm_no){
        $get_comm = $this->generate_commission_model->get_all_commission_by_comm_no($comm_no);
        $data['do_details'] = $this->generate_commission_model->get_all_do_detail_by_comm_no($comm_no);
        $data['commission']   = $get_comm;
            
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=detail_delivery_orders.xls");
        
        $this->load->view('print_detail_data_do', $data);
    }

    function print_commission($comm_no)
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('generate_commissions') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('generate_commissions');
        $this->session->set_userdata('page_header', 'transaction');
        $this->session->set_userdata('page_detail', 'generate_commission');
        $data['datatables'] = true;
        $data['form'] = true;

        $data['drivers'] = $this->generate_commission_model->get_all_driver();
        $data['departements'] = $this->generate_commission_model->get_all_departement();
        $data['comm_no'] = $comm_no;
        
        $this->template->set_layout('users')->build('print_commissions', isset($data) ? $data : null);
    }
    
    function print_data_commission(){
        $comm_no = $this->input->post('comm_no');
        $type = $this->input->post('type');
        $departement_id = $this->input->post('departement_id');
        $driver_id = $this->input->post('driver_id');
        $part = $this->input->post('part');
        $print_type = $this->input->post('print_type');
        
        $get_comm = $this->generate_commission_model->get_all_commission_by_comm_no($comm_no);
        
        if($type == 'summary'){
            $data['commission'] = $this->generate_commission_model->get_all_commission_by_comm_id($get_comm->rowID);
            $data['commission_details'] = $this->generate_commission_model->get_all_commission_detail_by_comm_id($get_comm->rowID);
            $data['get_comm']   = $get_comm;
            $data['comm_no']    = $comm_no;
           
            if($print_type == 'pdf'){
                $html = $this->load->view('print_summary', $data, true);
                $this->pdf_generator->generate($html, lang('generate_commissions').' pdf',$orientation='Portrait');
            }
            else{
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment; filename=generate_commission_report.xls");
                
                $this->load->view('print_summary', $data);
            }
            
        }
        else if($type == 'detail_driver'){
            if($driver_id != 'all'){
                $data['get_comm']   = $get_comm;
                $data['commission'] = $this->generate_commission_model->get_all_commission_by_comm_id($get_comm->rowID);
                $data['driver'] = $this->generate_commission_model->get_debtor_by_debtor_id($driver_id);
                $data['deliveries'] = $this->generate_commission_model->get_all_do_by_comm_debtor_id($comm_no,$driver_id,$get_comm->until_date);
                $data['cash_advances'] = $this->generate_commission_model->get_cash_advance_by_comm_debtor_id($comm_no,$driver_id);
                $data['cash_advance_loans'] = $this->generate_commission_model->get_data_advance_loan_by_debtor_id($driver_id);
                
                if($print_type == 'pdf'){
                    $html = $this->load->view('print_detail', $data, true);
                    $this->pdf_generator->generate($html, lang('generate_commissions').' pdf',$orientation='Portrait');
                }
                else{
                    header("Content-type: application/octet-stream");
                    header("Content-Disposition: attachment; filename=generate_commission_report.xls");
                    
                    $this->load->view('print_detail', $data);
                }
            }
            else{ // All Driver
                $data['get_comm']   = $get_comm;
                $data['comm_no']    = $comm_no;
                $limit = 30;
                if($part == '1'){
                    $start = 0;
                }
                else if($part == '2'){
                    $start = 30;
                }
                else if($part == '3'){
                    $start = 60;
                }
                else if($part == '4'){
                    $start = 90;
                }
                else if($part == '5'){
                    $start = 120;
                }
                else if($part == '6'){
                    $start = 150;
                }
                else if($part == '7'){
                    $start = 180;
                }
                else if($part == '8'){
                    $start = 210;
                }
                else if($part == '9'){
                    $start = 240;
                }
                else if($part == '10'){
                    $start = 270;
                }
                
                $data['drivers']    = $this->generate_commission_model->get_all_driver_by_limit($limit,$start);
                
                if($print_type == 'pdf'){
                    $html = $this->load->view('print_all_detail', $data, true);
                    $this->pdf_generator->generate($html, lang('generate_commissions').' pdf',$orientation='Portrait');
                }
                else{
                    header("Content-type: application/octet-stream");
                    header("Content-Disposition: attachment; filename=generate_commission_report.xls");
                    
                    $this->load->view('print_all_detail', $data);
                }
            }
            
        }
        else if($type == 'detail_vehicle'){
            $data['get_comm']   = $get_comm;
            $data['commission'] = $this->generate_commission_model->get_all_commission_by_comm_id($get_comm->rowID);
            $data['vehicles']   = $this->generate_commission_model->get_all_commission_by_vehicle($comm_no,$get_comm->until_date);
            
            if($print_type == 'pdf'){
                $html = $this->load->view('print_detail_vehicle', $data, true);
                $this->pdf_generator->generate($html, lang('generate_commissions').' pdf',$orientation='Portrait');
            }
            else{
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment; filename=generate_commission_report.xls");
                
                $this->load->view('print_detail_vehicle', $data);
            }
            
        }
        else if($type == 'detail_do'){
            $data['get_comm']   = $get_comm;
            $data['comm_no']    = $comm_no;
            $data['until_date'] = $get_comm->until_date;
            $data['commission'] = $this->generate_commission_model->get_all_commission_by_comm_id($get_comm->rowID);
            
            $from_date = date('Y-m-d',strtotime($get_comm->until_date.' -14 days'));
            $to_date = $get_comm->until_date;
            
            if($departement_id == 'all'){            
                $data['departement'] = 'All Departement';
                $data['deliveries'] = $this->generate_commission_model->get_do_by_comm($comm_no,$get_comm->until_date);
                $data['field_cost_do'] = $this->generate_commission_model->get_field_cost_by_comm($comm_no,$get_comm->until_date); 
                $data['field_cost_cb_driver'] = $this->generate_commission_model->get_field_cost_cb_driver($from_date,$to_date)->field_cost;               
                $data['field_cost_cb_other'] = $this->generate_commission_model->get_field_cost_cb_other($from_date,$to_date)->field_cost;               
            }
            else{
                $get_departement = $this->generate_commission_model->get_by_id('sa_dep',$departement_id);
                $data['get_departement'] = $get_departement;
                $data['departement'] = $get_departement->dep_name;
                $data['deliveries'] = $this->generate_commission_model->get_do_by_comm_departement($comm_no,$get_comm->until_date,$departement_id);                
                $data['field_cost_do'] = $this->generate_commission_model->get_field_cost_by_comm_departement($comm_no,$get_comm->until_date,$departement_id);                
                $data['field_cost_cb_driver'] = $this->generate_commission_model->get_field_cost_cb_driver_departement($from_date,$to_date,$departement_id)->field_cost;               
                $data['field_cost_cb_other'] = $this->generate_commission_model->get_field_cost_cb_other_departement($from_date,$to_date,$departement_id)->field_cost;            
            }
            
            if($print_type == 'pdf'){
                $html = $this->load->view('print_detail_do', $data, true);
                $this->pdf_generator->generate($html, lang('generate_commissions').' pdf',$orientation='Portrait');
            }
            else{
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment; filename=generate_commission_report.xls");
                
                $this->load->view('print_detail_do', $data);
            }
            
        }
        else if($type == 'detail_field_cost'){
            $data['get_comm']   = $get_comm;
            $data['comm_no']    = $comm_no;
            $data['until_date'] = $get_comm->until_date;
            $data['commission'] = $this->generate_commission_model->get_all_commission_by_comm_id($get_comm->rowID);
            
            $from_date = date('Y-m-d',strtotime($get_comm->until_date.' -14 days'));
            $to_date = $get_comm->until_date;
            
            if($departement_id == 'all'){            
                $data['departement'] = 'All Departement';
                $data['deliveries'] = $this->generate_commission_model->get_do_by_comm($comm_no,$get_comm->until_date);
                $data['field_cost_do'] = $this->generate_commission_model->get_field_cost_by_comm_detail($comm_no,$get_comm->until_date); 
                $data['field_cost_cb_driver'] = $this->generate_commission_model->get_field_cost_cb_driver_detail($from_date,$to_date);               
                $data['field_cost_cb_other'] = $this->generate_commission_model->get_field_cost_cb_other_detail($from_date,$to_date);               
            }
            else{
                $get_departement = $this->generate_commission_model->get_by_id('sa_dep',$departement_id);
                $data['get_departement'] = $get_departement;
                $data['departement'] = $get_departement->dep_name;
                $data['deliveries'] = $this->generate_commission_model->get_do_by_comm_departement($comm_no,$get_comm->until_date,$departement_id);                
                $data['field_cost_do'] = $this->generate_commission_model->get_field_cost_by_comm_detail_departement($comm_no,$get_comm->until_date,$departement_id);                
                $data['field_cost_cb_driver'] = $this->generate_commission_model->get_field_cost_cb_driver_detail_departement($from_date,$to_date,$departement_id);               
                $data['field_cost_cb_other'] = $this->generate_commission_model->get_field_cost_cb_other_detail_departement($from_date,$to_date,$departement_id);            
            }
            
            if($print_type == 'pdf'){
                $html = $this->load->view('print_detail_field_cost', $data, true);
                $this->pdf_generator->generate($html, lang('generate_commissions').' pdf',$orientation='Portrait');
            }
            else{
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment; filename=generate_commission_report.xls");
                
                $this->load->view('print_detail_field_cost', $data);
            }
            
        }
        else{
            redirect(base_url().'generate_commission');
        }
        
        $params['user_rowID'] = $this->tank_auth->get_user_id();
		$params['module'] = 'Generate Commission';
		$params['module_field_id'] = $get_comm->rowID;
		$params['activity'] = ucfirst('Print a Commission No. '.$comm_no.' with type '.ucwords(str_replace('_',' ',$type)));
		$params['icon'] = 'fa-print';
		modules::run('activitylog/log',$params); //log activity	

    }
    
    function generate(){
        $this->db->trans_begin(); # Starting Transaction
        
        $this->generate_commission_model->create_table('temp_commission');
        $this->generate_commission_model->create_table('temp_loan');
        
        $until_date = date('Y-m-d',strtotime($this->input->post('until_date')));
        $get_data_do = $this->generate_commission_model->get_data_do_by_date($until_date);
        
        foreach($get_data_do as $row_do){
            $data_commission = array(
                'do_trx_rowID'  => $row_do->rowID,
                'debtor_rowID'  => $row_do->employee_driver_rowID,
                'debtor_name'   => $row_do->debtor_name,
                'komisi_supir'  => $row_do->komisi_supir,
                'komisi_kernet' => $row_do->komisi_kernet,
                'jo_no'         => $row_do->jo_no,
                'do_no'         => $row_do->do_no,
                'amount_deposit'=> $row_do->deposit,
                'amount_loan'    => 0
            );
            
            $this->generate_commission_model->insert_data($this->session->userdata('temp_commission'),$data_commission);
        }
        
        $data['get_data_temp'] = $this->generate_commission_model->get_group_temp_commission($this->session->userdata('temp_commission'));
        $data['get_data_do_verified'] = $this->generate_commission_model->get_data_do_verified($until_date);
            
        $status = $this->db->trans_status();
        if ($status === false)
        {
            $this->db->trans_rollback();
            echo 'Generate Failed';
        } 
        else
        {
            $this->db->trans_commit();
            $this->load->view('ajax_data_commission',$data);
        }

    }
    
    function get_detail_commission(){
        $get_data_commission = $this->generate_commission_model->get_temp_commission($this->session->userdata('temp_commission'),$this->input->post('debtor_id'));
        
        echo json_encode($get_data_commission);
        exit;
    }
    
    function cancel_loan(){
        if($this->session->userdata('temp_commission') != '' && $this->session->userdata('temp_loan') != ''){
            $this->generate_commission_model->drop_table($this->session->userdata('temp_commission'));
            $this->generate_commission_model->drop_table($this->session->userdata('temp_loan'));
        }
        
        redirect(base_url('generate_commission'));
    }
    
    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->generate_commission_model->get_by_id($tabel = 'tr_generate_commission_trx', $id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }      
    
    function get_data_cash_advance($debtor_id){
        $cek_temp_loan = $this->generate_commission_model->get_data_temp_loan_by_debtor_id($this->session->userdata('temp_loan'),$debtor_id);
        if(count($cek_temp_loan) == 0){
            $get_data_advance_loan = $this->generate_commission_model->get_data_advance_loan($debtor_id);
            $get_data_advance = $this->generate_commission_model->get_data_advance($debtor_id);
            $data['get_data_advance_loan'] = $get_data_advance_loan; 
            $data['get_data_advance'] = $get_data_advance; 
            $data['jumlah_data_advance'] = (count($get_data_advance_loan) + count($get_data_advance));
            $this->load->view('ajax_data_advance',$data);
        }
        else{
            $get_data_advance = $cek_temp_loan;
            $data['get_data_advance'] = $get_data_advance; 
            $this->load->view('ajax_data_advance_temp',$data);
        }   
         
    }
    
    function save_loan(){
        $this->db->trans_begin(); # Starting Transaction
        $error = false;
        $sa_spec= $this->db->get_where('sa_spec', array('deleted' => 0,'rowID' => 1))->row_array();
        $commission_prefix = $sa_spec['commission_prefix'];
        $deposit_prefix = $sa_spec['deposit_prefix'];
        $sa_spec_prefix = $sa_spec['general_jrn'];
        
        $until_date = date('Y-m-d',strtotime($this->input->post('until_date')));
        $year = date('Y',strtotime($until_date));
        $month = date('m',strtotime($until_date));
        
        $max_commission_number = ((int)$this->appmodel->select_max_id('tr_commission_trx', $array = array('year' => $year,'month' => $month, 'deleted' => 0), 'code')) + 1;
           
        $commission_no = sprintf("%04s",$year).sprintf("%02s",$month).sprintf("%02s",$max_commission_number);
        $period = $this->input->post('period');
        $total_driver_commission = str_replace('.','',$this->input->post('total_driver_commission'));
        $total_co_driver_commission = str_replace('.','',$this->input->post('total_co_driver_commission'));
        $total_deposit = str_replace('.','',$this->input->post('total_deposit'));
        $total_loan = str_replace('.','',$this->input->post('total_loan'));
        
        // Array
        $debtor_rowid = $this->input->post('debtor_rowid');
        $komisi_supir = $this->input->post('komisi_supir');
        $komisi_kernet = $this->input->post('komisi_kernet');
        $amount_deposit = $this->input->post('amount_deposit');
        $max_saldo_loan = $this->input->post('max_saldo_loan');
        $jumlah_loan = $this->input->post('amount_loan');
        
        // INSERT ke Commission Header
        $data_comm_trx = array(
            'year' => $year,
            'month' => $month,
            'code' => $max_commission_number,
            'commission_no' => $commission_no,
            'until_date'    => $until_date,
            'period' => $period,
            'total_driver_commission'   => $total_driver_commission,
            'total_co_driver_commission' => $total_co_driver_commission,
            'total_deposit' => $total_deposit,
            'total_loan'    => $total_loan,
            'user_created' => $this->session->userdata('user_rowID'),
            'date_created' => date('Y-m-d'),
            'time_created' => date('H:i:s')
        );
        
        $result = $this->db->insert('tr_commission_trx',$data_comm_trx);
        if($result){
            $commission_rowID = $this->db->insert_id();        
        
            if(!empty($debtor_rowid)){
                $n = count($debtor_rowid);
                for($i=0;$i<$n;$i++){
                    // INSERT ke Commission Detail
                    $amount_loan = str_replace('.','',$jumlah_loan[$i]);
                    $data_comm_detail = array(
                        'debtor_rowID' => $debtor_rowid[$i],
                        'commission_rowID' => $commission_rowID,
                        'driver_commission' => $komisi_supir[$i],
                        'co_driver_commission' => $komisi_kernet[$i],
                        'amount_deposit'   => $amount_deposit[$i],
                        'max_saldo_loan' => $max_saldo_loan[$i],
                        'amount_loan'   => $amount_loan,
                        'user_created' => $this->session->userdata('user_rowID'),
                        'date_created' => date('Y-m-d'),
                        'time_created' => date('H:i:s')
                    );
                    
                    $result = $this->generate_commission_model->insert_data('tr_commission_trx_dtl',$data_comm_detail);
                    if(!$result){
                        $error = true;
                        break;
                    }
                    
                    /*
                    // INSERT ke Deposit
                    //$max_deposit_number  = ((int)$this->generate_commission_model->select_max_deposit_by_field('rowID'))+1;
                    $max_deposit_number  = ((int)$this->appmodel->select_max_id('tr_deposit_trx', $array =
                        array(
                        'prefix' => $deposit_prefix,
                        'year' => date('Y'),
                        'month' => date('m'),
                        'deleted' => 0), 'code')) + 1;
                       
                    $deposit_number      = $deposit_prefix.sprintf("%04s",date('Y')).sprintf("%02s",date('m')).sprintf("%05s",$max_deposit_number);
                    
                    $new_gl_coa_code = ((int)$this->appmodel->select_max_id('gl_trx_hdr', $array =
                        array(
                        'prefix' => $sa_spec_prefix,
                        'year' => date('Y'),
                        'month' => date('m'),
                        'deleted' => 0), 'code')) + 1;
                    $gl_coa_no = $sa_spec_prefix . sprintf("%04s", date('Y')) . sprintf("%02s", date('m')) . sprintf("%05s", $new_gl_coa_code);
                    
                    $data_deposit = array(
                        'prefix' => $deposit_prefix,
                        'year' => date('Y'),
                        'month' => date('m'),
                        'code' => $max_deposit_number,
                        'deposit_number' => $deposit_number,
                        'date' => date('Y-m-d'),
                        'debtor_rowID' => $debtor_rowid[$i],
                        'amount' => $amount_deposit[$i],
                        'remark' => 'Commission',
                        'commission_no' => $commission_no,
                        'user_created' => $this->session->userdata('user_id'),
                        'date_created' => date('Y-m-d H:i:s')
                    );
                    
                    $result = $this->db->insert('tr_deposit_trx', $data_deposit);
                    if($result){
                        $get_debtor = $this->generate_commission_model->get_by_id('sa_debtor',$debtor_rowid[$i]);
                        $description = 'DEPOSIT A/N '.$get_debtor->debtor_name.' NO '.$deposit_number.' FROM COMMISSION NO '.$commission_no;
                        
                        $gl_trx_hdr_data = array(
                            'prefix' => $sa_spec_prefix,
                            'year' => date('Y'),
                            'month' => date('m'),
                            'code' => $new_gl_coa_code,
                            'journal_no' => $gl_coa_no,
                            'journal_date' => date('Y-m-d'),
                            'journal_type' => 'deposit',
                            'descs' => $description,
                            'trx_amt' => $amount_deposit[$i],
                            'ref_no' => $commission_no,
                            'ref_date' => date('Y-m-d'),
                            'user_created' => $this->session->userdata('user_rowID'),
                            'date_created' => date('Y-m-d'),
                            'time_created' => date('H:i:s')
                        );
                            
                        $result = $this->db->insert('gl_trx_hdr', $gl_trx_hdr_data);
                        if($result){
                            $data_debit = array(
                                'gl_trx_hdr_prefix' => $sa_spec_prefix,
                                'gl_trx_hdr_year' => date('Y'),
                                'gl_trx_hdr_month' => date('m'),
                                'gl_trx_hdr_code' => $new_gl_coa_code,
                                'row_no' => 1,
                                'gl_trx_hdr_journal_no' => $gl_coa_no,
                                'gl_trx_hdr_journal_date' => date('Y-m-d'),
                                'coa_rowID' => 6, // 1.01.01.01.02 - KAS KECIL PST
                                'descs' => $description,
                                'trx_amt' => $amount_deposit[$i],
                                'dep_rowID' => $this->session->userdata('dep_rowID'),
                                'debtor_creditor_type' => 'D',
                                'debtor_creditor_rowID' => $debtor_rowid[$i],
                                'gl_trx_hdr_ref_no' => $commission_no,
                                'gl_trx_hdr_ref_date' => date('Y-m-d'),
                                'modul' => 'CB',
                                'cash_flow' => 'Y',
                                'base_amt' => 0,
                                'tax_no' => '',
                                'user_created' => $this->session->userdata('user_rowID'),
                                'date_created' => date('Y-m-d'),
                                'time_created' => date('H:i:s')
                            );
                            
                            $result = $this->db->insert('gl_trx_dtl', $data_debit);
                            if($result){
                                $data_credit = array(
                                    'gl_trx_hdr_prefix' => $sa_spec_prefix,
                                    'gl_trx_hdr_year' => date('Y'),
                                    'gl_trx_hdr_month' => date('m'),
                                    'gl_trx_hdr_code' => $new_gl_coa_code,
                                    'row_no' => 2,
                                    'gl_trx_hdr_journal_no' => $gl_coa_no,
                                    'gl_trx_hdr_journal_date' => date('Y-m-d'),
                                    'coa_rowID' => 194, // 2.03.02.01 - DEPOSIT SUPIR
                                    'descs' => $description,
                                    'trx_amt' => $amount_deposit[$i] * -1,
                                    'dep_rowID' => $this->session->userdata('dep_rowID'),
                                    'debtor_creditor_type' => 'D',
                                    'debtor_creditor_rowID' => $debtor_rowid[$i],
                                    'gl_trx_hdr_ref_no' => $commission_no,
                                    'gl_trx_hdr_ref_date' => date('Y-m-d'),
                                    'modul' => 'CB',
                                    'cash_flow' => 'Y',
                                    'base_amt' => 0,
                                    'tax_no' => '',
                                    'user_created' => $this->session->userdata('user_rowID'),
                                    'date_created' => date('Y-m-d'),
                                    'time_created' => date('H:i:s')
                                );
                                
                                $result = $this->db->insert('gl_trx_dtl', $data_credit);
                                if(!$result){
                                    $error = true;
                                    break;
                                }
                            }
                            else{
                                $error = true;
                                break;
                            } 
                        }
                        else{
                            $error = true;
                            break;
                        }
                    }  
                    else{
                        $error = true;
                        break;
                    }
                    */  
                }
            }
        }
        else{
            $error = true;
        }
            
        // UPDATE Data DO 
        $get_data_temp_comm = $this->generate_commission_model->get_data_table($this->session->userdata('temp_commission'));
        foreach($get_data_temp_comm as $row_do){
            $data_update_do = array(
                'commission_no' => $commission_no
            );
            
            $result = $this->generate_commission_model->update_data('tr_do_trx',$data_update_do,$row_do->do_trx_rowID);
            if(!$result){
                $error = true;
                break;
            }
        }
        
        // INSERT ke cb_cash_adv_alloc Dan Update cb_cash_adv
        $sa_spec_prefix = $this->appmodel->get_id($table = 'sa_dep', $array = array('deleted' =>
                0, 'rowID' => 1), 'cash_in_prefix');
                    
        $refund_code = ((int)$this->appmodel->select_max_id('cb_trx_hdr', $array =
            array(
            'prefix' => $sa_spec_prefix,
            'year' => date('Y'),
            'month' => date('m'),
            'deleted' => 0), 'code')) + 1;

        $refund_no = $sa_spec_prefix . sprintf("%04s", date('Y')) . sprintf("%02s", date('m')) . sprintf("%05s", $refund_code);
                    
        $check_trx_no = $this->generate_commission_model->get_data_header_cb($refund_no);
        if(count($check_trx_no) > 0){
            $refund_code = ((int)$this->appmodel->select_max_id('cb_trx_hdr', $array =
                array(
                'prefix' => $sa_spec_prefix,
                'year' => date('Y'),
                'month' => date('m'),
                'deleted' => 0), 'code')) + 1;

            $refund_no = $sa_spec_prefix . sprintf("%04s", date('Y')) . sprintf("%02s", date('m')) . sprintf("%05s", $refund_code);
            
        }
           
        $get_data_temp_loan = $this->generate_commission_model->get_data_table($this->session->userdata('temp_loan'));  
        $row_no_alloc = 1;
        foreach($get_data_temp_loan as $row_loan){
            if($row_loan->amount_payment > 0){
                $refund_hdr_data = array(
                    'prefix' => $sa_spec_prefix,
                    'year' => date('Y'),
                    'month' => date('m'),
                    'code' => $refund_code,
                    'row_no' => $row_no_alloc++,
                    'alloc_no' => $refund_no,
                    'alloc_date' => date('Y-m-d'),
                    'descs' => 'COMMISSION NO. ' . $commission_no,
                    'commission_no' => $commission_no,
                    'cb_cash_adv_no' => $row_loan->advance_no,
                    'alloc_amt' => $row_loan->amount_payment,
                    'alloc_mode' => 'C',
                    'user_created' => $this->session->userdata('user_rowID'),
                    'date_created' => date('Y-m-d'),
                    'time_created' => date('H:i:s')
                );
                
                $result = $this->db->insert('cb_cash_adv_alloc', $refund_hdr_data);
                if($result){
                    $sql_update = "UPDATE cb_cash_adv 
                                    SET advance_allocation = advance_allocation + ".$row_loan->amount_payment.", 
                                        advance_balance = advance_balance - ".$row_loan->amount_payment."
                                    WHERE advance_no = '".$row_loan->advance_no."' AND deleted = 0";
                    
                    $result = $this->db->query($sql_update);
                    if(!$result){
                        $error = true;
                        break;
                    }
                }
                else{
                    $error = true;
                    break;
                }
            }
        }
        
        // Drop Table Temporary
        $this->generate_commission_model->drop_table($this->session->userdata('temp_commission'));
        $this->generate_commission_model->drop_table($this->session->userdata('temp_loan'));
        
        Header('Content-Type: application/json; charset=UTF8');
        $status = $this->db->trans_status();
        if ($status === false || $error == true)
        {
            $this->db->trans_rollback();
            $params['user_rowID'] = $this->tank_auth->get_user_id();
			$params['module'] = 'ERROR ROLLBACK COMMISSION';
			$params['module_field_id'] = $dataPost['rowID'];
			$params['activity'] = ucfirst('Deleted a Commission No '.$commission_no);
			$params['icon'] = 'fa-exclamation-triangle';
			modules::run('activitylog/log',$params);
            
            echo json_encode(array('success' => false, 'msg' => "Failed Data RollBack"));
            exit();
        } 
        else
        {
            $this->db->trans_commit();
            
            $this->session->unset_userdata('temp_commission');
            $this->session->unset_userdata('temp_loan');
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Commission';
            $params['module_field_id'] = $commission_rowID;
            $params['activity'] = ucfirst('Added a new Commission No ' . $commission_no);
            $params['icon'] = 'fa-plus';
            modules::run('activitylog/log', $params); //log activity
            
            echo json_encode(array("success" => true, 'msg' => lang('created_succesfully')));
            exit();            
        }
        return $status;
    }
    
    function delete_commission($commission_no){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $error = false;
        $this->db->trans_begin();
        
        $get_data = $this->generate_commission_model->get_all_commission_by_comm_no($commission_no);
        
        $data_commission = array(
            'deleted'       => 1,
            'user_deleted' => $this->session->userdata('user_rowID'),
            'date_deleted' => date('Y-m-d'),
            'time_deleted' => date('H:i:s')
        );
        $this->db->where('deleted',0);
        $this->db->where('commission_no',$commission_no);
        $result = $this->db->update('tr_commission_trx', $data_commission);   
        if($result){
            $data_commission_detail = array(
                'deleted'       => 1,
                'user_deleted' => $this->session->userdata('user_rowID'),
                'date_deleted' => date('Y-m-d'),
                'time_deleted' => date('H:i:s')
            );
            $this->db->where('deleted',0);
            $this->db->where('commission_rowID',$get_data->rowID);
            $result = $this->db->update('tr_commission_trx_dtl', $data_commission_detail);
            if($result){
                $data_commission_alloc = array(
                    'deleted'       => 1,
                    'user_deleted' => $this->session->userdata('user_rowID'),
                    'date_deleted' => date('Y-m-d'),
                    'time_deleted' => date('H:i:s')
                );
                $this->db->where('deleted',0);
                $this->db->where('commission_no',$commission_no);
                $result = $this->db->update('tr_commission_trx_alloc', $data_commission_alloc);   
                if($result){
                    $data_deposit = array(
                        'deleted'       => 1,
                        'user_deleted'  => $this->session->userdata('user_id'),
                        'date_deleted'  => date('Y-m-d H:i:s'),
                    );
                    $this->db->where('deleted',0);
                    $this->db->where('commission_no',$commission_no);
                    $result = $this->db->update('tr_deposit_trx', $data_deposit);
                    if($result){
                        $data_update_do = array(
                            'commission_no' => ''
                        );
                        $this->db->where('deleted',0);
                        $this->db->where('commission_no',$commission_no);
                        $result = $this->db->update('tr_do_trx', $data_update_do);
                        if($result){
                            $get_alloc = $this->generate_commission_model->get_cash_advance_by_comm($commission_no);
                            if(count($get_alloc) > 0){
                                foreach($get_alloc as $row_alloc){
                                    $refund_hdr_data = array(
                                        'deleted' => 1,
                                        'user_deleted' => $this->session->userdata('user_rowID'),
                                        'date_deleted' => date('Y-m-d'),
                                        'time_deleted' => date('H:i:s')
                                    );
                                    $this->db->where('deleted',0);
                                    $this->db->where('commission_no',$commission_no);
                                    $result = $this->db->update('cb_cash_adv_alloc', $refund_hdr_data);
                                    if($result){
                                        $sql_update = "UPDATE cb_cash_adv 
                                                        SET advance_allocation = advance_allocation - ".$row_alloc->alloc_amt.", 
                                                            advance_balance = advance_balance + ".$row_alloc->alloc_amt."
                                                        WHERE advance_no = '".$row_alloc->cb_cash_adv_no."' AND deleted = 0";
                                        $result = $this->db->query($sql_update);
                                        if(!$result){
                                            $error = true;                            
                                            break;
                                        }
                                    }
                                    else{
                                        $error = true;
                                        break;
                                    }                        
                                }
                            }
                            
                            /*
                            $data_update_gl_header = array(
                                'deleted' => 1,
                                'user_deleted' => $this->session->userdata('user_rowID'),
                                'date_deleted' => date('Y-m-d'),
                                'time_deleted' => date('H:i:s')
                            );
                            $this->db->where('deleted',0);
                            $this->db->where('ref_no',$commission_no);
                            $result = $this->db->update('gl_trx_hdr', $data_update_gl_header);
                            if($result){
                                $data_update_gl_detail = array(
                                    'deleted' => 1,
                                    'user_deleted' => $this->session->userdata('user_rowID'),
                                    'date_deleted' => date('Y-m-d'),
                                    'time_deleted' => date('H:i:s')
                                );
                                $this->db->where('deleted',0);
                                $this->db->where('gl_trx_hdr_ref_no',$commission_no);
                                $result = $this->db->update('gl_trx_dtl', $data_update_gl_detail);
                                if($result){
                                    $get_alloc = $this->generate_commission_model->get_cash_advance_by_comm($commission_no);
                                    if(count($get_alloc) > 0){
                                        foreach($get_alloc as $row_alloc){
                                            $refund_hdr_data = array(
                                                'deleted' => 1,
                                                'user_deleted' => $this->session->userdata('user_rowID'),
                                                'date_deleted' => date('Y-m-d'),
                                                'time_deleted' => date('H:i:s')
                                            );
                                            $this->db->where('deleted',0);
                                            $this->db->where('commission_no',$commission_no);
                                            $result = $this->db->update('cb_cash_adv_alloc', $refund_hdr_data);
                                            if($result){
                                                $sql_update = "UPDATE cb_cash_adv 
                                                                SET advance_allocation = advance_allocation - ".$row_alloc->alloc_amt.", 
                                                                    advance_balance = advance_balance + ".$row_alloc->alloc_amt."
                                                                WHERE advance_no = '".$row_alloc->cb_cash_adv_no."' AND deleted = 0";
                                                $result = $this->db->query($sql_update);
                                                if(!$result){
                                                    $error = true;                            
                                                    break;
                                                }
                                            }
                                            else{
                                                $error = true;
                                                break;
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
                            */
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
        if ($status === false || $error == true){
            $this->db->trans_rollback();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
			$params['module'] = 'ERROR ROLLBACK COMMISSION';
			$params['module_field_id'] = $get_data->rowID;
			$params['activity'] = ucfirst('Deleted a Commission No '.$commission_no);
			$params['icon'] = 'fa-exclamation-triangle';
			modules::run('activitylog/log',$params);
            
            echo json_encode(array('success' => false, 'msg' => "Failed Data RollBack"));
            exit();
        }
        else{
            $this->db->trans_commit();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Commission';
            $params['module_field_id'] = $get_data->rowID;
            $params['activity'] = ucfirst('Deleted a Commission No ' . $commission_no);
            $params['icon'] = 'fa-times';
            modules::run('activitylog/log', $params); //log activity
            
            echo json_encode(array("success" => true, 'msg' => lang('deleted_succesfully')));
            exit();
        }
        
    }
    
    function save_advance_loan(){
        $this->db->trans_begin(); # Starting Transaction
        
        $advance_no = $this->input->post('advance_no');
        $advance_balance = $this->input->post('advance_balance');
        $jumlah_loan = $this->input->post('jumlah_loan');
        
        $n = count($jumlah_loan);
        $total_loan = 0;
        for($i=0;$i<$n;$i++){
            $jumlah = str_replace('.','',$jumlah_loan[$i]);
            
            $cek_data = $this->generate_commission_model->get_data_temp_loan($this->session->userdata('temp_loan'),$this->input->post('loan_debtorID'),$advance_no[$i]);
            
            if(count($cek_data) > 0){
                $data_loan = array(
                    'debtor_rowID' => $this->input->post('loan_debtorID'),
                    'max_saldo_loan' => $this->input->post('max_loan_debtor'),
                    'advance_no'    => $advance_no[$i],
                    'amount_loan'   => $advance_balance[$i],
                    'amount_payment' => $jumlah,
                );
                
                $total_loan += $jumlah;
                
                $this->db->where('debtor_rowID', $this->input->post('loan_debtorID'));
                $this->db->where('advance_no', $advance_no[$i]);
                $this->db->update($this->session->userdata('temp_loan'), $data_loan);
            }
            else{
                $data_loan = array(
                    'debtor_rowID' => $this->input->post('loan_debtorID'),
                    'max_saldo_loan' => $this->input->post('max_loan_debtor'),
                    'advance_no'    => $advance_no[$i],
                    'amount_loan'   => $advance_balance[$i],
                    'amount_payment' => $jumlah,
                );
                
                $total_loan += $jumlah;
                
                $this->generate_commission_model->insert_data($this->session->userdata('temp_loan'),$data_loan);
            }
            
        }
        
        Header('Content-Type: application/json; charset=UTF8');
        $status = $this->db->trans_status();
        if ($status === false)
        {
            $this->db->trans_rollback();
            echo json_encode(array('success' => false, 'msg' => " Failed", 'total_loan' => 0, 'row' => $this->input->post('row')));
            exit();
        } 
        else
        {
            $this->db->trans_commit();
            $info = 'Select loan successfully';
            echo json_encode(array('success' => true, 'msg' => $info, 'total_loan' => $total_loan, 'row' => $this->input->post('row')));
            exit();
        }
        return $status;
    }

    function fetch_data() { 
        if ($this->input->is_ajax_request()) {
            $dt = $_POST;

            if($this->session->userdata('start_date_gc') == '' ){
                $start_date = date("Y-m-d", strtotime('-6 day'));
            }else{
                $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_gc')));
            }

            if($this->session->userdata('end_date_gc') == ''){
                $end_date = date("Y-m-d");
            }else{
                $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_gc')));
            }
            $str_between = " AND until_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";
        
            $dt['table'] = 'tr_commission_trx';
            $dt['id'] = 'rowID';

            $aColumnTable = array(
                'rowID', 'commission_no', 'until_date', 'total_driver_commission', 'total_co_driver_commission', 'total_deposit', 'total_loan', 'period'
            );

            $aColumns = array(
               'rowID', 'commission_no', 'until_date', 'total_driver_commission', 'total_co_driver_commission', 'total_deposit', 'total_loan', 'period'
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
                $sOrder .= "rowID DESC";
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
                $this->session->set_userdata('start_date_gc',date("Y-m-d",strtotime($start_date)));

                if($this->session->userdata('end_date_gc') == ''){
                    $end_date = date("Y-m-d");
                }else{
                    $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_gc')));
                }
                $str_between = " AND until_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";

                $sWhere.= ' deleted = 0 ' . $str_between; 
            }

            if (!empty($dt['columns'][8]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $end_date = date('Y-m-d', strtotime($dt['columns'][8]['search']['value']));
                $this->session->set_userdata('end_date_gc', date("Y-m-d",strtotime($end_date)));

                if($this->session->userdata('start_date_gc') == ''){
                    $start_date = date("Y-m-d", strtotime('-6 day'));
                }else{
                    $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_gc')));
                }
                $str_between = " AND until_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";
                
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

            $join_table = ' ';

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
                    if($this->get_user_access('Viewed') == 1){
                        $dropdown_option .= '<li><a  href="javascript:void()" title="View" onclick="view_commission(\'' . $aRow['rowID'] . '\')"><i class="fa fa-list-alt"></i> View</a></li>';
                    }
                                
                    if($this->get_user_access('PrintLimited') == 1 || $this->get_user_access('PrintUnlimited') == 1 || $this->get_user_access('PrintOne') == 1 || $this->get_user_access('PrintTwo') == 1){
                        if($this->get_user_access('PrintLimited') == 1){
                            if($this->user_profile->get_log_limited_printed($aRow['commission_no'],'Generate Commission') == 0){
                                $dropdown_option .= '<li><a  href="javascript:void()" title="Download Detail DO" onclick="download_detail_do(\'' . $aRow['commission_no'] . '\')"><i class="fa fa-download"></i> Detail DO</a></li>';
                                $dropdown_option .= '<li><a  href="javascript:void()" title="Print" onclick="print_commission(\'' . $aRow['commission_no'] . '\')"><i class="fa fa-print"></i> Print</a></li>';
                            }
                        }else{
                            $dropdown_option .= '<li><a  href="javascript:void()" title="Download Detail DO" onclick="download_detail_do(\'' . $aRow['commission_no'] . '\')"><i class="fa fa-download"></i> Detail DO</a></li>';                      
                            $dropdown_option .= '<li><a  href="javascript:void()" title="Print" onclick="print_commission(\'' . $aRow['commission_no'] . '\')"><i class="fa fa-print"></i> Print</a></li>';
                        }
                    }
                                
                    if($this->get_user_access('Deleted') == 1){
                        $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('delete_option') . '" onclick="delete_commission(\'' . $aRow['commission_no'] . '\')"><i class="fa fa-trash-o"></i> ' . lang('delete_option') . '</a></li>';
                    }
                    $dropdown_option .= '</ul></div>';
              
                    $row['dropdown_option'] = $dropdown_option;
                    $row['commission_no'] = $aRow['commission_no'] . '[' . $aRow['period'] . ']';
                    $row['until_date'] = date("d F Y",strtotime($aRow['until_date']));
                    $row['total_driver_commission'] = number_format($aRow['total_driver_commission'],0,',','.');
                    $row['total_co_driver_commission'] = number_format($aRow['total_co_driver_commission'],0,',','.');
                    $row['total_deposit'] = number_format($aRow['total_deposit'],0,',','.');
                    $row['total_loan'] = number_format($aRow['total_loan'],0,',','.');

                    $row['start_date'] = $aRow['until_date'];
                    $row['end_date'] = $aRow['until_date'];
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
        $this->db->where('Link_Menu', 'generate_commission');
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

/* End of file generate_commission.php */
