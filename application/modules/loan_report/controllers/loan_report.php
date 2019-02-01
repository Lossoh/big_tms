<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Loan_report extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('loan_report_model');
        $this->load->library('pdf_generator');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('loan_report') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('loan_report');
        $this->session->set_userdata('page_header', 'reports');
        $this->session->set_userdata('page_detail', 'loan_report');
        $data['datatables'] = true;
        $data['form'] = true;
        
        $data['debtors'] = $this->loan_report_model->get_data_debtor();
        
        $this->template->set_layout('users')->build('loan_reports', isset($data) ? $data : null);
    }
    
    function print_report(){
        if($this->input->post('year') != ''){
            $start_date = date('Y-m-d',strtotime('01-01-'.$this->input->post('year')));
            $end_date = date('Y-m-t',strtotime('01-12-'.$this->input->post('year')));
            $debtor_id = $this->input->post('debtor_id');
            $balance_status = $this->input->post('balance_status');
            $print_type = $this->input->post('print_type');
            
            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
            $data['str_start_date'] = date('d-m-Y',strtotime($start_date));
            $data['str_end_date'] = date('d-m-Y',strtotime($end_date));
            $data['balance_status'] = $balance_status;
            
            if($debtor_id == 'all'){
                $data['debtor_name'] = 'All';                
            }
            else{
                $get_debtor = $this->loan_report_model->get_data_debtor_by_id($debtor_id);
                $data['debtor_name'] = $get_debtor->type.$get_debtor->debtor_cd.' - '.$get_debtor->debtor_name;                
            }
            
            if($balance_status == 'all'){
                $data['loan_list'] = $this->loan_report_model->get_all_records_list($start_date,$end_date,$debtor_id);                
            }
            else if($balance_status == 'balance'){
                $data['loan_list'] = $this->loan_report_model->get_all_balance_records_list($start_date,$end_date,$debtor_id);                
            }
            else{
                $data['loan_list'] = $this->loan_report_model->get_all_unbalance_records_list($start_date,$end_date,$debtor_id);
            }
            
            if($print_type == 'pdf'){
                $html = $this->load->view('loan_report_pdf', $data, true);
                $this->pdf_generator->generate($html, lang('loan_report').' pdf',$orientation='Landscape');
            }
            else{
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment; filename=loan_report.xls");
                
                $this->load->view("loan_report_pdf", $data);
            }       
        }
        else{
            redirect(base_url('loan_report'));
        }
        
    }
    
}

/* End of file contacts.php */
