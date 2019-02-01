<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Account_payable_report extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('account_payable_report_model');
        $this->load->library('pdf_generator');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('account_payable_report') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('account_payable_report');
        $this->session->set_userdata('page_header', 'reports');
        $this->session->set_userdata('page_detail', 'account_payable_report');
        $data['datatables'] = true;
        $data['form'] = true;
        
        $data['creditors'] = $this->account_payable_report_model->get_data_company();
        
        $this->template->set_layout('users')->build('account_payable_reports', isset($data) ? $data : null);
    }
    
    function print_report(){
        if($this->input->post('start_date') != ''){
            $start_date = date('Y-m-d',strtotime($this->input->post('start_date')));
            $end_date = date('Y-m-d',strtotime($this->input->post('end_date')));
            $creditor_id = $this->input->post('creditor_id');
            $status_paid = $this->input->post('status_paid');
            $print_type = $this->input->post('print_type');
                  
            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
            $data['str_start_date'] = date('d-m-Y',strtotime($start_date));
            $data['str_end_date'] = date('d-m-Y',strtotime($end_date));
            $data['status_paid'] = $status_paid;
            
            if($creditor_id == "All"){
                $data['account_payables'] = $this->account_payable_report_model->get_all_records_list($start_date,$end_date);
            }
            else{
                $data['creditor'] = $this->account_payable_report_model->get_data_creditor_by_id($creditor_id);
                $data['account_payables'] = $this->account_payable_report_model->get_all_records_list_by_creditor($start_date,$end_date,$creditor_id);                
            }
            
            if($print_type == 'pdf'){
                if($status_paid == 'not_yet'){
                    $html = $this->load->view('account_payable_not_paid_report_pdf', $data, true);                    
                }
                else{
                    $html = $this->load->view('account_payable_report_pdf', $data, true);
                }
                
                $this->pdf_generator->generate($html, lang('account_payable_report').' pdf',$orientation='Landscape');
            }
            else{
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment; filename=account_payable_report.xls");
                
                if($status_paid == 'not_yet'){
                    $this->load->view("account_payable_not_paid_report_pdf", $data);                    
                }
                else{
                    $this->load->view("account_payable_report_pdf", $data);
                }
                
            }
                        
        }
        else{
            redirect(base_url('account_payable_report'));
        }
        
    }
    
}

/* End of file contacts.php */
