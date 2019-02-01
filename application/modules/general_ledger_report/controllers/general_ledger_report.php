<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class General_ledger_report extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('general_ledger_report_model');
        $this->load->library('pdf_generator');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('general_ledger_report') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('general_ledger_report');
        $this->session->set_userdata('page_header', 'reports');
        $this->session->set_userdata('page_detail', 'general_ledger_report');
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
            
        $data['coas'] = $this->general_ledger_report_model->get_account();
        $data['debtors'] = $this->general_ledger_report_model->get_debtor();
        $data['creditors'] = $this->general_ledger_report_model->get_creditor();
        
        $this->template->set_layout('users')->build('general_ledger_reports', isset($data) ? $data : null);
    }
    
    function print_report(){
        if($this->input->post('start_date') != ''){
            $start_date = date('Y-m-01',strtotime(date('01').'-'.$this->input->post('start_date')));
            $end_date = date('Y-m-t',strtotime('28-'.$this->input->post('end_date')));
            $coa_id = $this->input->post('coa_id');
            $debtor_creditor_type = $this->input->post('debtor_creditor_type');
            $debtor_creditor_id = $this->input->post('debtor_creditor_id');
            $print_type = $this->input->post('print_type');
            
            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
            $data['debtor_creditor_type'] = $debtor_creditor_type;
            $data['debtor_creditor_id'] = $debtor_creditor_id;
            
            if($coa_id == 'All'){
                $data['coas'] = $this->general_ledger_report_model->get_account();
                
                if($print_type == 'pdf'){
                    $html = $this->load->view('general_ledger_all_report_pdf', $data, true);
                    $this->pdf_generator->generate($html, lang('general_ledger_report').' pdf',$orientation='Landscape');
                }
                else{
                    header("Content-type: application/octet-stream");
                    header("Content-Disposition: attachment; filename=general_ledger_report.xls");
                    
                    $this->load->view("general_ledger_all_report_pdf", $data);
                }
            }
            else{
                $get_data_coa = $this->general_ledger_report_model->get_data_by_row_id('gl_coa',$coa_id);
                $data['get_data_coa'] = $get_data_coa;
                
                //if($coa_id == '204' || $coa_id == '205' || $coa_id == '206' || $coa_id == '207' || $coa_id == '208'){ // Laba
                if($get_data_coa->acc_profit_loss != 0){ // Laba
                    $sum_balance = true;
                        
                    // Balance
                    $first_date = date('Y-m-d',strtotime($start_date.' first day of last month'));
                    if($first_date == '2016-12-01'){
                        $start_date = date('Y-m-d',strtotime($start_date.' +1 days'));
                        $sum_balance = false;
                    }
                    else{
                        if(date('m',strtotime($first_date)) == 12){
                            $sum_balance = false;
                        }
                        else{
                            $first_date = date('Y-01-01',strtotime($first_date));
                        }                                                   
                    }

                    if($sum_balance == true){
                        $last_date = date('Y-m-t',strtotime($start_date.' last day of last month'));
                        
                        $get_balance = $this->general_ledger_report_model->get_balanced($coa_id,$debtor_creditor_type,$debtor_creditor_id,$first_date,$last_date);
                        $balance = 0;
                        foreach($get_balance as $row_balance){
                            //$balance += $row_balance->trx_amt;
                            $debit = 0;
                            $credit = 0;
                            
                            if($row_balance->trx_amt > 0){
                                $debit = $row_balance->trx_amt;                                                      
                                $coa_cd = substr($get_data_coa->acc_cd,0,1);
                                if($coa_cd == '2' || $coa_cd == '3' || $coa_cd == '4'){
                                    if(substr($get_data_coa->acc_cd,0,7) == '4.01.02' || substr($get_data_coa->acc_cd,0,7) == '5.01.02'){
                                        $balance += $debit; 
                                    }
                                    else{
                                        $balance -= $debit;
                                    }                    
                                }
                                else{
                                    $balance += $debit;
                                }
                                
                            }
                            else{
                                $credit = $row_balance->trx_amt * -1;             
                                $coa_cd = substr($get_data_coa->acc_cd,0,1);
                                if($coa_cd == '2' || $coa_cd == '3' || $coa_cd == '4'){
                                    if(substr($get_data_coa->acc_cd,0,7) == '4.01.02' || substr($get_data_coa->acc_cd,0,7) == '5.01.02'){
                                        $balance -= $credit;   
                                    }
                                    else{
                                        $balance += $credit;
                                    }                    
                                }
                                else{
                                    $balance -= $credit;
                                }
                                      
                            }
                                                       
                        }
                    }
                    else{
                        $balance = 0;
                    }
                    
                }
                else{                    
                    // Balance
                    $first_date = date('Y-m-d',strtotime($start_date.' first day of last month'));
                    if($first_date == '2016-12-01'){
                        $start_date = date('Y-m-d',strtotime($start_date.' +1 days'));
                        $first_date = date('Y-m-d',strtotime('2017-01-01'));
                        $last_date = date('Y-m-d',strtotime('2017-01-01'));
                    }
                    else{
                        $first_date = date('Y-01-01',strtotime($first_date));
                        $last_date = date('Y-m-t',strtotime($start_date.' last day of last month'));
                    }
                    
                    $get_balance = $this->general_ledger_report_model->get_balanced($coa_id,$debtor_creditor_type,$debtor_creditor_id,$first_date,$last_date);
                    $balance = 0;
                    foreach($get_balance as $row_balance){
                        //$balance += $row_balance->trx_amt;
                        $debit = 0;
                        $credit = 0;
                        
                        if($row_balance->trx_amt > 0){
                            $debit = $row_balance->trx_amt;        
                            $coa_cd = substr($get_data_coa->acc_cd,0,1);
                            if($coa_cd == '2' || $coa_cd == '3' || $coa_cd == '4'){
                                if(substr($get_data_coa->acc_cd,0,7) == '4.01.02' || substr($get_data_coa->acc_cd,0,7) == '5.01.02'){
                                    $balance += $debit; 
                                }
                                else{
                                    $balance -= $debit;
                                }                    
                            }
                            else{
                                $balance += $debit;
                            }
                                                                                    
                        }
                        else{
                            $credit = $row_balance->trx_amt * -1;             
                            $coa_cd = substr($get_data_coa->acc_cd,0,1);
                            if($coa_cd == '2' || $coa_cd == '3' || $coa_cd == '4'){
                                if(substr($get_data_coa->acc_cd,0,7) == '4.01.02' || substr($get_data_coa->acc_cd,0,7) == '5.01.02'){
                                    $balance -= $credit;   
                                }
                                else{
                                    $balance += $credit;
                                }                    
                            }
                            else{
                                $balance -= $credit;
                            }
                                
                        }
                        
                    }
                }
                
                $data['balance'] = $balance;
                $data['general_ledgers'] = $this->general_ledger_report_model->get_all_records_list($coa_id,$debtor_creditor_type,$debtor_creditor_id,$start_date,$end_date);
                
                $data['str_start_date'] = date('d-m-Y',strtotime($start_date));
                $data['str_end_date'] = date('t-m-Y',strtotime($end_date));

                if($print_type == 'pdf'){
                    $html = $this->load->view('general_ledger_report_pdf', $data, true);
                    $this->pdf_generator->generate($html, lang('general_ledger_report').' pdf',$orientation='Landscape');
                }
                else{
                    header("Content-type: application/octet-stream");
                    header("Content-Disposition: attachment; filename=general_ledger_report.xls");
                    
                    $this->load->view("general_ledger_report_pdf", $data);
                }
            }
        }
        else{
            redirect(base_url('general_ledger_report'));
        }
        
    }
    
}

/* End of file contacts.php */
