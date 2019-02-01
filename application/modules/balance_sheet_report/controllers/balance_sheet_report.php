<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Balance_sheet_report extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('balance_sheet_report_model');
        $this->load->library('pdf_generator');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('balance_sheet_report') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('balance_sheet_report');
        $this->session->set_userdata('page_header', 'reports');
        $this->session->set_userdata('page_detail', 'balance_sheet_report');
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
                
        $this->template->set_layout('users')->build('balance_sheet_reports', isset($data) ? $data : null);
    }
    
    function print_report(){
        if($this->input->post('period') != ''){
            $start_date = date('Y-m-01',strtotime(date('01').'-'.$this->input->post('period')));
            $end_date = date('Y-m-t',strtotime('28-'.$this->input->post('period')));
            $report_type = $this->input->post('report_type');
            $time_type = $this->input->post('time_type');
            $print_type = $this->input->post('print_type');
            
            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
            
            $first_date = date('Y-m-d',strtotime($start_date.' first day of last month'));
            $last_date = date('Y-m-t',strtotime($start_date.' last day of last month'));
            if(date('Y-m',strtotime($first_date)) == '2016-12'){
                $data['str_start_date'] = date('02-m-Y',strtotime($start_date));
            }
            else{
                $data['str_start_date'] = date('01-m-Y',strtotime($start_date));
            }
            
            $data['first_date'] = $first_date;
            $data['str_end_date'] = date('t-m-Y',strtotime($end_date));
            
            if($report_type == 'Neraca Scontro'){
                /*
                if($first_date == '2016-12-01'){                                        
                    $start_date_balance = '2017-01-01';
                    $end_date_balance = '2017-01-01';
                    $start_date_credit = '2017-01-02';
                    $end_date_credit = $end_date;
                }
                else{
                    if($first_date == '2017-01-01'){
                        $last_date = date('Y-m-t',strtotime($start_date.' last day of last month'));

                        $start_date_balance = '2017-01-02';
                        $end_date_balance = $last_date;
                        $start_date_credit = $start_date;
                        $end_date_credit = $end_date;
                    }
                    else{
                        if(date('m',strtotime($first_date)) == 12){
                            if($first_date == '2017-12-01'){
                                $first_date = date('Y-01-02',strtotime($first_date));                                    
                            }
                            else{
                                $first_date = date('Y-01-d',strtotime($first_date));
                            }
                        }
                        
                        $last_date = date('Y-m-t',strtotime($start_date.' last day of last month'));
                                                
                        $start_date_balance = $first_date;
                        $end_date_balance = $last_date;
                        $start_date_credit = $start_date;
                        $end_date_credit = $end_date;
                    }
                }
                */
                             
                $data['coas'] = $this->balance_sheet_report_model->get_account();
                
                if($time_type == 'monthly'){
                    if(date('m',strtotime($first_date)) == 12){
                        $starting_balance_profit = 0;
                    }
                    else{
                        $starting_balance_profit = $this->get_profit_and_loss(date('Y-01-d',strtotime($first_date)),$last_date);                    
                    }
    
                    $get_total_profit = $this->get_profit_and_loss($start_date,$end_date);
                    if($get_total_profit > 0){
                        $debit_profit = 0;
                        $credit_profit = $get_total_profit;                    
                    }
                    else{
                        $debit_profit = $get_total_profit * -1;
                        $credit_profit = 0;     
                    }
                
                    $data['starting_balance_profit'] = $starting_balance_profit;
                    $data['debit_profit'] = $debit_profit;
                    $data['credit_profit'] = $credit_profit;
                    
                    if($print_type == 'pdf'){
                        $html = $this->load->view('neraca_scontro_report_pdf', $data, true);
                        $this->pdf_generator->generate($html, 'Neraca Scontro',$orientation='Portrait');
                    }
                    else{
                        header("Content-type: application/octet-stream");
                        header("Content-Disposition: attachment; filename=neraca_scontro_monthly.xls");
                        
                        $this->load->view("neraca_scontro_report_pdf", $data);
                    }
                }
                else{
                    $start_date = date('Y-m-01',strtotime(date('01').'-'.$this->input->post('start_date')));
                    $end_date = date('Y-m-t',strtotime('28-'.$this->input->post('end_date')));
                    
                    $i_first = (int) date('m',strtotime($start_date)) - 1;
                    $i_end = (int) date('m',strtotime($end_date));
                    
                    $first_date = date('Y-m-d',strtotime($start_date.' first day of last month'));
                    
                    for($i=$i_first;$i<$i_end;$i++){
                        $first_date_tmp = date('Y-m-d',strtotime($first_date.' +'.$i.' months'));
                        $last_date_tmp = date('Y-m-t',strtotime($first_date_tmp));
                        
                        if(date('m',strtotime($first_date_tmp)) == 12){
                            $starting_balance_profit[$i] = 0;
                        }
                        else{
                            $starting_balance_profit[$i] = $this->get_profit_and_loss(date('Y-01-d',strtotime($first_date_tmp)),$last_date_tmp);                    
                        }                        
                    }
                    
                    for($i=$i_first;$i<$i_end;$i++){
                        $first_date_tmp = date('Y-m-d',strtotime($first_date.' +'.($i+1).' months'));
                        $last_date_tmp = date('Y-m-t',strtotime($first_date_tmp));
                                                
                        $get_total_profit = $this->get_profit_and_loss($first_date_tmp,$last_date_tmp);
                        if($get_total_profit > 0){
                            $debit_profit[$i] = 0;
                            $credit_profit[$i] = $get_total_profit;                    
                        }
                        else{
                            $debit_profit[$i] = $get_total_profit * -1;
                            $credit_profit[$i] = 0;     
                        }
                    }
                    
                    $data['starting_balance_profit'] = $starting_balance_profit;
                    $data['debit_profit'] = $debit_profit;
                    $data['credit_profit'] = $credit_profit;
                    
                    $data['start_date'] = $start_date;
                    $data['end_date'] = $end_date;
                    
                    if($print_type == 'excel'){
                        header("Content-type: application/octet-stream");
                        header("Content-Disposition: attachment; filename=neraca_scontro_yearly.xls");
                        
                        $this->load->view("neraca_scontro_report_yearly_pdf", $data);
                    }
                    else{
                        redirect(base_url('balance_sheet_report'));
                    }
                }
            }
            else if($report_type == 'Neraca T'){                 
                $data['coas'] = $this->balance_sheet_report_model->get_account();                
                
                if(date('m',strtotime($first_date)) == 12){
                    $starting_balance_profit = 0;
                }
                else{
                    $starting_balance_profit = $this->get_profit_and_loss(date('Y-01-d',strtotime($first_date)),$last_date);                    
                }

                $get_total_profit = $this->get_profit_and_loss($start_date,$end_date);
                if($get_total_profit > 0){
                    $debit_profit = 0;
                    $credit_profit = $get_total_profit;                    
                }
                else{
                    $debit_profit = $get_total_profit * -1;
                    $credit_profit = 0;     
                }
            
                $data['starting_balance_profit'] = $starting_balance_profit;
                $data['debit_profit'] = $debit_profit;
                $data['credit_profit'] = $credit_profit;
                
                if($print_type == 'pdf'){
                    $html = $this->load->view('neraca_t_report_pdf', $data, true);
                    $this->pdf_generator->generate($html, 'Neraca T',$orientation='Portrait');
                }
                else{
                    header("Content-type: application/octet-stream");
                    header("Content-Disposition: attachment; filename=neraca_t.xls");
                    
                    $this->load->view("neraca_t_report_pdf", $data);
                }                
            }
            else if($report_type == 'Profit and Loss'){
                if($time_type == 'monthly'){
                    if($print_type == 'pdf'){
                        $html = $this->load->view('profit_and_loss_report_pdf', $data, true);
                        $this->pdf_generator->generate($html, 'Profit and Loss (Monthly)',$orientation='Portrait');
                    }
                    else{
                        header("Content-type: application/octet-stream");
                        header("Content-Disposition: attachment; filename=profit_and_loss_monthly.xls");
                        
                        $this->load->view("profit_and_loss_report_pdf", $data);
                    }
                }
                else{                    
                    $start_date = date('Y-m-01',strtotime(date('01').'-'.$this->input->post('start_date')));
                    $end_date = date('Y-m-t',strtotime('28-'.$this->input->post('end_date')));
                    
                    $data['start_date'] = $start_date;
                    $data['end_date'] = $end_date;

                    if($print_type == 'excel'){
                        header("Content-type: application/octet-stream");
                        header("Content-Disposition: attachment; filename=profit_and_loss_yearly.xls");
                        
                        $this->load->view("profit_and_loss_report_yearly_pdf", $data);
                    }
                    else{
                        redirect(base_url('balance_sheet_report'));
                    }                    
                }
            }
            else if($report_type == 'Changes in Capital'){                 
                $data['coas'] = $this->balance_sheet_report_model->get_account_capital();                
                
                if(date('m',strtotime($first_date)) == 12){
                    $starting_balance_profit = 0;
                }
                else{
                    $starting_balance_profit = $this->get_profit_and_loss(date('Y-01-d',strtotime($first_date)),$last_date);                    
                }

                $get_total_profit = $this->get_profit_and_loss($start_date,$end_date);
                if($get_total_profit > 0){
                    $debit_profit = 0;
                    $credit_profit = $get_total_profit;                    
                }
                else{
                    $debit_profit = $get_total_profit * -1;
                    $credit_profit = 0;     
                }
            
                $data['starting_balance_profit'] = $starting_balance_profit;
                $data['debit_profit'] = $debit_profit;
                $data['credit_profit'] = $credit_profit;
                
                if($print_type == 'pdf'){
                    $html = $this->load->view('changes_in_capital_report_pdf', $data, true);
                    $this->pdf_generator->generate($html, 'Changes in Capital',$orientation='Portrait');
                }
                else{
                    header("Content-type: application/octet-stream");
                    header("Content-Disposition: attachment; filename=changes_in_capital.xls");
                    
                    $this->load->view("changes_in_capital_report_pdf", $data);
                }                
            }
            else{
                redirect(base_url('balance_sheet_report'));                
            }
        }
        else{
            redirect(base_url('balance_sheet_report'));
        }
        
    }
    
    function get_profit_and_loss($start_date,$end_date){
    
        $subtotal_pendapatan_jasa = 0;
        $subtotal_potongan_pendapatan_jasa = 0;
        $total_pendapatan_usaha = 0;
        
        $subtotal_biaya_ops = 0;
        $subtotal_potongan_biaya_ops = 0;
        $total_biaya_ops = 0;
        
        $total_biaya_non_ops = 0;
        $total_biaya_lain = 0;
        $total_biaya_penyusutan = 0;
        $total_biaya_pajak = 0;
        
        $total_biaya_usaha = 0;
        $total_laba_rugi_usaha = 0;
        
        $total_pendapatan_luar_usaha = 0;
        $total_biaya_luar_usaha = 0;
        $total_laba_rugi_bersih = 0;
        
        $subtotal = 0;
        $subtotal_tmp = 0;
    
        // PENDAPATAN JASA
        $get_data = $this->balance_sheet_report_model->get_account_profit_loss_by_code('4.01.01.');    
        foreach($get_data as $row){
            $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,$start_date,$end_date);
            
            $total = $get_total->total * -1;
            $subtotal_pendapatan_jasa += $total;        
        }
    
        // POTONGAN PENDAPATAN JASA
        $get_data = $this->balance_sheet_report_model->get_account_profit_loss_by_code('4.01.02.');
        foreach($get_data as $row){
            $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,$start_date,$end_date);
            
            $total = $get_total->total * -1;
            $subtotal_potongan_pendapatan_jasa += $total;
        }
    
        $total_pendapatan_usaha = $subtotal_pendapatan_jasa + $subtotal_potongan_pendapatan_jasa;
    
        // BIAYA OPERASIONAL
        $get_data = $this->balance_sheet_report_model->get_account_profit_loss_by_code('5.01.01.');
        foreach($get_data as $row){
            $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,$start_date,$end_date);
            
            $total = $get_total->total;
            $subtotal_biaya_ops += $total;
        }
    
        // POTONGAN BIAYA OPERASIONAL
        $get_data = $this->balance_sheet_report_model->get_account_profit_loss_by_code('5.01.02.');
        foreach($get_data as $row){
            $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,$start_date,$end_date);
            
            $total = $get_total->total;
            $subtotal_potongan_biaya_ops += $total;
        }
    
        $total_biaya_ops = $subtotal_biaya_ops + $subtotal_potongan_biaya_ops;
    
        // BIAYA NON OPERASIONAL
        $get_data = $this->balance_sheet_report_model->get_account_profit_loss_by_code('5.01.03.');
        foreach($get_data as $row){
            $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,$start_date,$end_date);
            
            $total = $get_total->total;
            $total_biaya_non_ops += $total;
        }
    
        // BIAYA LAIN-LAIN
        $get_data = $this->balance_sheet_report_model->get_account_profit_loss_by_code('5.01.04.01.');
        foreach($get_data as $row){
            $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,$start_date,$end_date);
            
            $total = $get_total->total;
            $total_biaya_lain += $total;
        }
        
        // BIAYA PENYUSUTAN
        $get_data = $this->balance_sheet_report_model->get_account_profit_loss_by_code('5.01.04.02.');
        foreach($get_data as $row){
            $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,$start_date,$end_date);
            
            $total = $get_total->total;
            $total_biaya_penyusutan += $total;
        }
    
        // BIAYA PAJAK
        $get_data = $this->balance_sheet_report_model->get_account_profit_loss_by_code('5.01.05.02');
        foreach($get_data as $row){
            $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,$start_date,$end_date);
            
            $total = $get_total->total;
            $total_biaya_pajak += $total;
        }
    
        $total_biaya_usaha = $total_biaya_ops + $total_biaya_non_ops + $total_biaya_lain + $total_biaya_penyusutan + $total_biaya_pajak; 
        $total_laba_rugi_usaha = $total_pendapatan_usaha - $total_biaya_usaha; 
    
        // PENDAPATAN LUAR USAHA
        $get_data = $this->balance_sheet_report_model->get_account_profit_loss_by_code('4.02.01.');
        foreach($get_data as $row){
            $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,$start_date,$end_date);
            
            $total = $get_total->total * -1;
            $total_pendapatan_luar_usaha += $total;
        }
    
        // PENDAPATAN LUAR USAHA
        $get_data = $this->balance_sheet_report_model->get_account_profit_loss_by_code('4.02.02.');
        foreach($get_data as $row){
            $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,$start_date,$end_date);
            
            $total = $get_total->total * -1;
            $total_pendapatan_luar_usaha += $total;
        }
        
        // BIAYA LUAR USAHA
        $get_data = $this->balance_sheet_report_model->get_account_profit_loss_by_code('5.02.01.');
        foreach($get_data as $row){
            $get_total = $this->balance_sheet_report_model->get_data_profit_loss_gl_by_coa($row->rowID,$start_date,$end_date);
            
            $total = $get_total->total;
            $total_biaya_luar_usaha += $total;        
        }
        
        $total_laba_rugi_bersih = $total_pendapatan_luar_usaha - $total_biaya_luar_usaha + $total_laba_rugi_usaha;
    
        return $total_laba_rugi_bersih;
    
    }

    
}

/* End of file contacts.php */
