<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Invoice_report extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('invoice_report_model');
        $this->load->library('pdf_generator');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('invoice_report') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('invoice_report');
        $this->session->set_userdata('page_header', 'reports');
        $this->session->set_userdata('page_detail', 'invoice_report');
        $data['datatables'] = true;
        $data['form'] = true;
        
        $data['debtors'] = $this->invoice_report_model->get_data_company();
        
        $this->template->set_layout('users')->build('invoice_reports', isset($data) ? $data : null);
    }
    
    function print_report(){
        if($this->input->post('start_date') != ''){
            $start_date = date('Y-m-d',strtotime($this->input->post('start_date')));
            $end_date = date('Y-m-d',strtotime($this->input->post('end_date')));
            $debtor_id = $this->input->post('debtor_id');
            $print_type = $this->input->post('print_type');
                  
            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
            $data['str_start_date'] = date('d-m-Y',strtotime($start_date));
            $data['str_end_date'] = date('d-m-Y',strtotime($end_date));
            
            if($debtor_id == "All"){
                $data['invoices'] = $this->invoice_report_model->get_all_records_list($start_date,$end_date);
            }
            else{
                $data['debtor'] = $this->invoice_report_model->get_data_debtor_by_id($debtor_id);
                $data['invoices'] = $this->invoice_report_model->get_all_records_list_by_debtor($start_date,$end_date,$debtor_id);                
            }
            
            if($print_type == 'pdf'){
                $html = $this->load->view('invoice_report_pdf', $data, true);
                $this->pdf_generator->generate($html, lang('invoice_report').' pdf',$orientation='Landscape');
            }
            else{
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment; filename=invoice_report.xls");
                
                $this->load->view("invoice_report_pdf", $data);
            }
                        
        }
        else{
            redirect(base_url('invoice_report'));
        }
        
    }
    
}

/* End of file contacts.php */
