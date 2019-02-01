<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Deposit extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('deposit_model');
        $this->load->model('appmodel');
        $this->load->library('pdf_generator');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('deposits') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('deposits');
        $this->session->set_userdata('page_header', 'transaction');
        $this->session->set_userdata('page_detail', 'deposit');
        $data['datatables'] = true;
        $data['form'] = true;
        
        if($this->session->userdata('start_date_dp') == '' ){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_dp')));
        }

        if($this->session->userdata('end_date_dp') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_dp')));
        }

        // if($this->session->userdata('start_date_dp') == '' && $this->session->userdata('end_date_dp') == ''){
        //     $start_date = date("Y-m-d",strtotime("yesterday"));
        //     $end_date = date("Y-m-d");
        // }
        // else{
        //     $start_date = $this->session->userdata('start_date_dp');
        //     $end_date = $this->session->userdata('end_date_dp');
        // }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        
        $data['deposits'] = $this->deposit_model->get_all_record_data($start_date,$end_date);

        $data['debtors'] = $this->deposit_model->get_all_debtor_data();
        $this->template->set_layout('users')->build('deposits', isset($data) ? $data : null);
    }
    
    function set_filter(){
       $this->session->set_userdata('start_date_dp',date("Y-m-d",strtotime($this->input->post('start_date'))));
       $this->session->set_userdata('end_date_dp',date("Y-m-d",strtotime($this->input->post('end_date'))));    
       
       redirect(base_url().'deposit');
    }

    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->deposit_model->get_by_id($tabel = 'tr_deposit_trx', $id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }

    function delete_data($id)
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $error = false;
        $this->db->trans_begin();
        
        $get_data = $this->deposit_model->get_by_id('tr_deposit_trx', $id);
        
        $result = $this->deposit_model->delete_data($tabel = 'tr_deposit_trx', $id);
        if($result){
            $get_data_gl = $this->deposit_model->get_data_gl_header_by_ref_no($get_data->deposit_number);
            $gl_coa_no = $get_data_gl->journal_no;
            
            $result = $this->deposit_model->delete_data($tabel = 'tr_deposit_trx', $id);
            if($result){
                $result = $this->deposit_model->delete_data_gl_header($gl_coa_no);
                if($result){
                    $result = $this->deposit_model->delete_data_gl_detail($gl_coa_no);
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
        }
        else{
            $error = true;
        }
        
        Header('Content-Type: application/json; charset=UTF8');
        $status = $this->db->trans_status();
        if ($status === false || $error == true){
            $this->db->trans_rollback();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
			$params['module'] = 'ERROR ROLLBACK DEPOSIT';
			$params['module_field_id'] = $id;
			$params['activity'] = ucfirst('Deleted a Deposit No '.$get_data->deposit_number);
			$params['icon'] = 'fa-exclamation-triangle';
			modules::run('activitylog/log',$params);
            
            echo json_encode(array('success' => false, 'msg' => "Failed Data RollBack"));
            exit();
        }
        else{
            $this->db->trans_commit();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Deposit';
            $params['module_field_id'] = $id;
            $params['activity'] = ucfirst('Deleted a Deposit No ' . $get_data->deposit_number);
            $params['icon'] = 'fa-times';
            modules::run('activitylog/log', $params); //log activity

            echo json_encode(array("success" => true, 'msg' => lang('deleted_succesfully')));
            exit();
        }
    }

    function create()
    {
        $dataPost = $this->input->post();
        //echo "<pre>"; print_r($dataPost); echo "</pre>"; exit();
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $error = false;
        $this->db->trans_begin();
      
        if (empty($dataPost['rowID'])) {
           
           if(date('Y-m-d',strtotime($dataPost['date'])) != date('Y-m-d')){
                $deposit_date = date('Y-m-d');
           }
           else{
                $deposit_date = date('Y-m-d',strtotime($dataPost['date']));
           }
            
           $year = date('Y',strtotime($deposit_date));
           $month = date('m',strtotime($deposit_date));

           $sa_spec = $this->db->get_where('sa_spec', array('deleted' => 0,'rowID' => 1))->row_array();

           $deposit_prefix = $sa_spec['deposit_prefix'];
           //$max_deposit_number  = ((int)$this->deposit_model->select_max_by_field('rowID'))+1;
           $max_deposit_number  = ((int)$this->appmodel->select_max_id('tr_deposit_trx', $array =
                array(
                'prefix' => $deposit_prefix,
                'year' => $year,
                'month' => $month,
                'deleted' => 0), 'code')) + 1;
                
           $sa_spec_prefix = $sa_spec['general_jrn'];        
           $new_gl_coa_code = ((int)$this->appmodel->select_max_id('gl_trx_hdr', $array =
                array(
                'prefix' => $sa_spec_prefix,
                'year' => $year,
                'month' => $month,
                'deleted' => 0), 'code')) + 1;
           $gl_coa_no = $sa_spec_prefix . sprintf("%04s", $year) . sprintf("%02s",
                $month) . sprintf("%05s", $new_gl_coa_code);
                
           $deposit_number      = $deposit_prefix.sprintf("%04s",$year).sprintf("%02s",$month).sprintf("%05s",$max_deposit_number);
           $amount = str_replace('.','',$dataPost['amount']);
           
           $data_deposit = array(
                'prefix' => $deposit_prefix,
                'year' => $year,
                'month' => $month,
                'code' => $max_deposit_number,
                'deposit_number' => $deposit_number,
                'date' => $deposit_date,
                'debtor_rowID' => $dataPost['debtor_rowID'],
                'amount' => $amount,
                'remark' => ucfirst($dataPost['remark']),
                'user_created' => $this->session->userdata('user_id'),
                'date_created' => $deposit_date.' '.date('H:i:s')
            );
            
            $result = $this->db->insert('tr_deposit_trx', $data_deposit);
            if($result){
                $deposit_id = $this->db->insert_id();
                
                $get_debtor = $this->deposit_model->get_by_id('sa_debtor',$dataPost['debtor_rowID']);
                $description = 'DEPOSIT A/N '.$get_debtor->debtor_name.' NO '.$deposit_number;
                
                $gl_trx_hdr_data = array(
                    'prefix' => $sa_spec_prefix,
                    'year' => $year,
                    'month' => $month,
                    'code' => $new_gl_coa_code,
                    'journal_no' => $gl_coa_no,
                    'journal_date' => $deposit_date,
                    'journal_type' => 'deposit',
                    'descs' => $description,
                    'trx_amt' => $amount,
                    'ref_no' => $deposit_number,
                    'ref_date' => $deposit_date,
                    'user_created' => $this->session->userdata('user_rowID'),
                    'date_created' => $deposit_date,
                    'time_created' => date('H:i:s')
                );
                    
                $result = $this->db->insert('gl_trx_hdr', $gl_trx_hdr_data);
                if($result){
                    $data_debit = array(
                        'gl_trx_hdr_prefix' => $sa_spec_prefix,
                        'gl_trx_hdr_year' => $year,
                        'gl_trx_hdr_month' => $month,
                        'gl_trx_hdr_code' => $new_gl_coa_code,
                        'row_no' => 1,
                        'gl_trx_hdr_journal_no' => $gl_coa_no,
                        'gl_trx_hdr_journal_date' => $deposit_date,
                        'coa_rowID' => 6, // 1.01.01.01.02 - KAS KECIL PST
                        'descs' => $description,
                        'trx_amt' => $amount,
                        'dep_rowID' => $this->session->userdata('dep_rowID'),
                        'debtor_creditor_type' => 'D',
                        'debtor_creditor_rowID' => $dataPost['debtor_rowID'],
                        'gl_trx_hdr_ref_no' => $deposit_number,
                        'gl_trx_hdr_ref_date' => $deposit_date,
                        'modul' => 'CB',
                        'cash_flow' => 'Y',
                        'base_amt' => 0,
                        'tax_no' => '',
                        'user_created' => $this->session->userdata('user_rowID'),
                        'date_created' => $deposit_date,
                        'time_created' => date('H:i:s')
                    );
                    
                    $result = $this->db->insert('gl_trx_dtl', $data_debit);
                    if($result){
                        $data_credit = array(
                            'gl_trx_hdr_prefix' => $sa_spec_prefix,
                            'gl_trx_hdr_year' => $year,
                            'gl_trx_hdr_month' => $month,
                            'gl_trx_hdr_code' => $new_gl_coa_code,
                            'row_no' => 2,
                            'gl_trx_hdr_journal_no' => $gl_coa_no,
                            'gl_trx_hdr_journal_date' => $deposit_date,
                            'coa_rowID' => 194, // 2.03.02.01 - DEPOSIT SUPIR
                            'descs' => $description,
                            'trx_amt' => $amount * -1,
                            'dep_rowID' => $this->session->userdata('dep_rowID'),
                            'debtor_creditor_type' => 'D',
                            'debtor_creditor_rowID' => $dataPost['debtor_rowID'],
                            'gl_trx_hdr_ref_no' => $deposit_number,
                            'gl_trx_hdr_ref_date' => $deposit_date,
                            'modul' => 'CB',
                            'cash_flow' => 'Y',
                            'base_amt' => 0,
                            'tax_no' => '',
                            'user_created' => $this->session->userdata('user_rowID'),
                            'date_created' => $deposit_date,
                            'time_created' => date('H:i:s')
                        );
                        
                        $result = $this->db->insert('gl_trx_dtl', $data_credit);
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
            }
            else{
                $error = true;
            }
            
            Header('Content-Type: application/json; charset=UTF8');
            $status = $this->db->trans_status();
            if ($status === false || $error == true){
                $this->db->trans_rollback();
                
                $params['user_rowID'] = $this->tank_auth->get_user_id();
				$params['module'] = 'ERROR ROLLBACK DEPOSIT';
				$params['module_field_id'] = $deposit_id;
				$params['activity'] = ucfirst('Deleted a Deposit No '.$deposit_number);
				$params['icon'] = 'fa-exclamation-triangle';
				modules::run('activitylog/log',$params);
                
                echo json_encode(array('success' => false, 'msg' => "Failed Data RollBack"));
                exit();
            }
            else{
                $this->db->trans_commit();
                
                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'Deposit';
                $params['module_field_id'] = $deposit_id;
                $params['activity'] = ucfirst('Added a new Deposit No ' . $deposit_number);
                $params['icon'] = 'fa-plus';
                modules::run('activitylog/log', $params); //log activity
                
                echo json_encode(array("success" => true, 'msg' => lang('created_succesfully')));
                exit();
            }

        } else {
            $get_data = $this->deposit_model->get_by_id('tr_deposit_trx', $dataPost['rowID']);
            
            $deposit_prefix = $get_data->prefix;
            $year = $get_data->year;
            $month = $get_data->month;
            $max_deposit_number = $get_data->code;
            $deposit_number = $get_data->deposit_number;
            $deposit_date = $get_data->date;
            
            $get_data_gl = $this->deposit_model->get_data_gl_header_by_ref_no($deposit_number);
            $sa_spec_prefix = $get_data_gl->prefix;
            $new_gl_coa_code = $get_data_gl->code;
            $gl_coa_no = $get_data_gl->journal_no;
            
            $result = $this->deposit_model->delete_data($tabel = 'tr_deposit_trx', $dataPost['rowID']);
            if($result){
                $result = $this->deposit_model->delete_data_gl_header($gl_coa_no);
                if($result){
                    $result = $this->deposit_model->delete_data_gl_detail($gl_coa_no);
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
            
            $amount = str_replace('.','',$dataPost['amount']);
           
            $data_deposit = array(
                'prefix' => $deposit_prefix,
                'year' => $year,
                'month' => $month,
                'code' => $max_deposit_number,
                'deposit_number' => $deposit_number,
                'date' => $deposit_date,
                'debtor_rowID' => $dataPost['debtor_rowID'],
                'amount' => $amount,
                'remark' => ucfirst($dataPost['remark']),
                'user_created' => $get_data->user_created,
                'date_created' => $get_data->date_created,
                'user_modified' => $this->session->userdata('user_id'),
                'date_modified' => date('Y-m-d').' '.date('H:i:s')
            );
            
            $result = $this->db->insert('tr_deposit_trx', $data_deposit);
            if($result){
                $deposit_id = $this->db->insert_id();
                
                $get_debtor = $this->deposit_model->get_by_id('sa_debtor',$dataPost['debtor_rowID']);
                $description = 'DEPOSIT A/N '.$get_debtor->debtor_name.' NO '.$deposit_number;
                
                $gl_trx_hdr_data = array(
                    'prefix' => $sa_spec_prefix,
                    'year' => $year,
                    'month' => $month,
                    'code' => $new_gl_coa_code,
                    'journal_no' => $gl_coa_no,
                    'journal_date' => $deposit_date,
                    'journal_type' => 'deposit',
                    'descs' => $description,
                    'trx_amt' => $amount,
                    'ref_no' => $deposit_number,
                    'ref_date' => $deposit_date,
                    'user_created'      =>$get_data_gl->user_created,
                    'date_created'      =>$get_data_gl->date_created,
                    'time_created'      =>$get_data_gl->time_created,
    				'user_modified'     =>$this->session->userdata('user_rowID'),
    				'date_modified'     =>date('Y-m-d'),
    				'time_modified'     =>date('H:i:s')
                );
                    
                $result = $this->db->insert('gl_trx_hdr', $gl_trx_hdr_data);
                if($result){
                    $data_debit = array(
                        'gl_trx_hdr_prefix' => $sa_spec_prefix,
                        'gl_trx_hdr_year' => $year,
                        'gl_trx_hdr_month' => $month,
                        'gl_trx_hdr_code' => $new_gl_coa_code,
                        'row_no' => 1,
                        'gl_trx_hdr_journal_no' => $gl_coa_no,
                        'gl_trx_hdr_journal_date' => $deposit_date,
                        'coa_rowID' => 6, // 1.01.01.01.02 - KAS KECIL PST
                        'descs' => $description,
                        'trx_amt' => $amount,
                        'dep_rowID' => $this->session->userdata('dep_rowID'),
                        'debtor_creditor_type' => 'D',
                        'debtor_creditor_rowID' => $dataPost['debtor_rowID'],
                        'gl_trx_hdr_ref_no' => $deposit_number,
                        'gl_trx_hdr_ref_date' => $deposit_date,
                        'modul' => 'CB',
                        'cash_flow' => 'Y',
                        'base_amt' => 0,
                        'tax_no' => '',
                        'user_created'      =>$get_data_gl->user_created,
                        'date_created'      =>$get_data_gl->date_created,
                        'time_created'      =>$get_data_gl->time_created,
        				'user_modified'     =>$this->session->userdata('user_rowID'),
        				'date_modified'     =>date('Y-m-d'),
        				'time_modified'     =>date('H:i:s')
                    );
                    
                    $result = $this->db->insert('gl_trx_dtl', $data_debit);
                    if($result){
                        $data_credit = array(
                            'gl_trx_hdr_prefix' => $sa_spec_prefix,
                            'gl_trx_hdr_year' => $year,
                            'gl_trx_hdr_month' => $month,
                            'gl_trx_hdr_code' => $new_gl_coa_code,
                            'row_no' => 2,
                            'gl_trx_hdr_journal_no' => $gl_coa_no,
                            'gl_trx_hdr_journal_date' => $deposit_date,
                            'coa_rowID' => 194, // 2.03.02.01 - DEPOSIT SUPIR
                            'descs' => $description,
                            'trx_amt' => $amount * -1,
                            'dep_rowID' => $this->session->userdata('dep_rowID'),
                            'debtor_creditor_type' => 'D',
                            'debtor_creditor_rowID' => $dataPost['debtor_rowID'],
                            'gl_trx_hdr_ref_no' => $deposit_number,
                            'gl_trx_hdr_ref_date' => $deposit_date,
                            'modul' => 'CB',
                            'cash_flow' => 'Y',
                            'base_amt' => 0,
                            'tax_no' => '',
                            'user_created'      =>$get_data_gl->user_created,
                            'date_created'      =>$get_data_gl->date_created,
                            'time_created'      =>$get_data_gl->time_created,
            				'user_modified'     =>$this->session->userdata('user_rowID'),
            				'date_modified'     =>date('Y-m-d'),
            				'time_modified'     =>date('H:i:s')
                        );
                        
                        $result = $this->db->insert('gl_trx_dtl', $data_credit);
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
            }
            else{
                $error = true;
            }
            
            Header('Content-Type: application/json; charset=UTF8');
            $status = $this->db->trans_status();
            if ($status === false || $error == true){
                $this->db->trans_rollback();
                
                $params['user_rowID'] = $this->tank_auth->get_user_id();
				$params['module'] = 'ERROR ROLLBACK DEPOSIT';
				$params['module_field_id'] = $dataPost['rowID'];
				$params['activity'] = ucfirst('Deleted a Deposit No '.$deposit_number);
				$params['icon'] = 'fa-exclamation-triangle';
				modules::run('activitylog/log',$params);
                
                echo json_encode(array('success' => false, 'msg' => "Failed Data RollBack"));
                exit();
            }
            else{
                $this->db->trans_commit();
                
                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'Deposit';
                $params['module_field_id'] = $dataPost['rowID'];
                $params['activity'] = ucfirst('Updated a Deposit No ' . $deposit_number);
                $params['icon'] = 'fa-plus';
                modules::run('activitylog/log', $params); //log activity

                echo json_encode(array("success" => true,  'msg' => lang('updated_succesfully')));
                exit();
            }            
        }

    }
    
    function pdf()
    {
        if($this->session->userdata('start_date_dp') == '' ){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_dp')));
        }

        if($this->session->userdata('end_date_dp') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_dp')));
        }

        // if($this->session->userdata('start_date_dp') == '' && $this->session->userdata('end_date_dp') == ''){
        //     $start_date = date("Y-m-d",strtotime("yesterday"));
        //     $end_date = date("Y-m-d");
        // }
        // else{
        //     $start_date = $this->session->userdata('start_date_dp');
        //     $end_date = $this->session->userdata('end_date_dp');
        // }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['periode'] = date("d F Y",strtotime($start_date)).' - '.date("d F Y",strtotime($end_date));
        
        $data['deposit'] = $this->deposit_model->get_pdf($start_date,$end_date);
        
        $html = $this->load->view('deposit_pdf', $data, true);
        $this->pdf_generator->generate($html, 'deposit pdf',$orientation='Portrait');
    }
    
    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=deposit.xls");
        
        if($this->session->userdata('start_date_dp') == '' ){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_dp')));
        }

        if($this->session->userdata('end_date_dp') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_dp')));
        }

        // if($this->session->userdata('start_date_dp') == '' && $this->session->userdata('end_date_dp') == ''){
        //     $start_date = date("Y-m-d",strtotime("yesterday"));
        //     $end_date = date("Y-m-d");
        // }
        // else{
        //     $start_date = $this->session->userdata('start_date_dp');
        //     $end_date = $this->session->userdata('end_date_dp');
        // }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['periode'] = date("d F Y",strtotime($start_date)).' - '.date("d F Y",strtotime($end_date));
        
        $data['deposit'] = $this->deposit_model->get_pdf($start_date,$end_date);
        
        $this->load->view("deposit_pdf", $data);

    }

    function fetch_data() { 
        if ($this->input->is_ajax_request()) {
            $dt = $_POST;

            if($this->session->userdata('start_date_dp') == '' ){
                $start_date = date("Y-m-d", strtotime('-6 day'));
            }else{
                $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_dp')));
            }

            if($this->session->userdata('end_date_dp') == ''){
                $end_date = date("Y-m-d");
            }else{
                $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_dp')));
            }
            $str_between = " AND tr_deposit_trx.date BETWEEN '" . $start_date . "' and '" . $end_date ."'";
        
            $dt['table'] = 'tr_deposit_trx';
            $dt['id'] = 'rowID';

            $aColumnTable = array(
                'tr_deposit_trx.rowID', 'tr_deposit_trx.deposit_number',  'tr_deposit_trx.date', 'sa_debtor.debtor_cd', 'sa_debtor.type', 'tr_deposit_trx.remark', 'tr_deposit_trx.amount', 'sa_debtor.debtor_name'
            );

            $aColumns = array(
               'tr_deposit_trx.rowID', 'tr_deposit_trx.deposit_number',  'tr_deposit_trx.date', 'sa_debtor.debtor_cd', 'sa_debtor.type', 'tr_deposit_trx.remark', 'tr_deposit_trx.amount', 'sa_debtor.debtor_name'
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
                $sOrder .= "tr_deposit_trx.rowID DESC";
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
                $this->session->set_userdata('start_date_dp',date("Y-m-d",strtotime($start_date)));

                if($this->session->userdata('end_date_dp') == ''){
                    $end_date = date("Y-m-d");
                }else{
                    $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_dp')));
                }
                $str_between = " AND tr_deposit_trx.date BETWEEN '" . $start_date . "' and '" . $end_date ."'";

                $sWhere.= ' tr_deposit_trx.deleted = 0 AND sa_debtor.deleted = 0 ' . $str_between; 
            }

            if (!empty($dt['columns'][8]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $end_date = date('Y-m-d', strtotime($dt['columns'][8]['search']['value']));
                $this->session->set_userdata('end_date_dp', date("Y-m-d",strtotime($end_date)));

                if($this->session->userdata('start_date_dp') == ''){
                    $start_date = date("Y-m-d", strtotime('-6 day'));
                }else{
                    $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_dp')));
                }
                $str_between = " AND tr_deposit_trx.date BETWEEN '" . $start_date . "' and '" . $end_date ."'";
                
                $sWhere.= ' tr_deposit_trx.deleted = 0 AND sa_debtor.deleted = 0 ' . $str_between; 
            }

            /** Filtering * */
            $sWhere = "";
            $sSearchVal = $dt['search']['value'];
            if (isset($sSearchVal) && $sSearchVal != '') {
                $sWhere = " WHERE (";
                for ($i = 0; $i < count($aColumns); $i++) {
                    $sWhere .= $aColumns[$i] . " LIKE '%" . $this->db->escape_like_str($sSearchVal) . "%' OR ";

                }

                $mystring = 'COMPANY, Company, company';
                $pos = strpos($mystring, $sSearchVal);
                if ($pos !== false) {
                    $sWhere .= $aColumns[4] . " LIKE '%" . $this->db->escape_like_str('C') . "%' OR ";
                }

                $mystring_2 = 'EMPLOYEE, Employee, employee';
                $pos_2 = strpos($mystring_2, $sSearchVal);
                if ($pos_2 !== false) {
                    $sWhere .= $aColumns[4] . " LIKE '%" . $this->db->escape_like_str('E') . "%' OR ";
                }

                $mystring_3 = 'DRIVER, Driver, driver';
                $pos_3 = strpos($mystring_3, $sSearchVal);
                if ($pos_3 !== false) {
                    $sWhere .= $aColumns[4] . " LIKE '%" . $this->db->escape_like_str('D') . "%' OR ";
                }

                $sWhere = substr_replace($sWhere, "", -3);
                $sWhere .= ') AND tr_deposit_trx.deleted = 0 AND sa_debtor.deleted = 0 ' . $str_between;
            } 

            /** Total Data Set Length * */
            $sQuery = 'SELECT * FROM ' . $dt['table'] . ' LEFT JOIN sa_debtor ON sa_debtor.rowID = tr_deposit_trx.debtor_rowID WHERE tr_deposit_trx.deleted = 0 AND sa_debtor.deleted = 0 ' . $str_between;
            $rResultTotal = $this->db->query($sQuery);
            $aResultTotal = $rResultTotal->num_rows();
            $iTotal = $aResultTotal;
            
            /* Get Data To Display */
            if ($sWhere != "") {
                $where = $sWhere;
            } else {
                $where = " WHERE tr_deposit_trx.deleted = 0 AND sa_debtor.deleted = 0 " . $str_between;
            }

            $join_table = ' LEFT JOIN sa_debtor ON sa_debtor.rowID = tr_deposit_trx.debtor_rowID ';

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
                    if($this->get_user_access('Updated') == 1){
                        $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('update_option') . '" onclick="edit_deposit(\'' . $aRow['rowID'] . '\')"><i class="fa fa-pencil"></i> ' . lang('update_option') . '</a></li>';
                    }
                                
                    if($this->get_user_access('Deleted') == 1){
                        $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('delete_option') . '" onclick="delete_deposit(\'' . $aRow['rowID'] . '\')"><i class="fa fa-trash-o"></i> ' . lang('delete_option') . '</a></li>';
                    }
                    $dropdown_option .= '</ul></div>';

                    $type = '-';
                    if($aRow['type'] == 'C'){
                        $type = 'Company';
                    }else if($aRow['type'] == 'E'){
                        $type = 'Employee';
                    }else if($aRow['type'] == 'D'){
                        $type = 'Driver';
                    }
              
                    $row['dropdown_option'] = $dropdown_option;
                    $row['deposit_number'] = $aRow['deposit_number'];
                    $row['date'] = date("d F Y",strtotime($aRow['date']));
                    $row['debtor'] = $aRow['debtor_cd'] . ' - ' . $aRow['debtor_name'];
                    $row['type'] = $type;
                    $row['remark'] = $aRow['remark'];
                    $row['amount'] = number_format($aRow['amount'],0,',','.');

                    $row['start_date'] = $aRow['date'];
                    $row['end_date'] = $aRow['date'];
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
        $this->db->where('Link_Menu', 'deposit');
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

/* End of file contacts.php */
