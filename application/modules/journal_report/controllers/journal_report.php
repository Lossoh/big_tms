<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Journal_report extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('journal_report_model');
        $this->load->library('pdf_generator');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('journal_report') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('journal_report');
        $this->session->set_userdata('page_header', 'reports');
        $this->session->set_userdata('page_detail', 'journal_report');
        $data['datatables'] = true;
        $data['form'] = true;
                
        $this->template->set_layout('users')->build('journal_reports', isset($data) ? $data : null);
    }
    
    function print_report(){
        if($this->input->post('period') != ''){
            $start_date = date('Y-m-01',strtotime(date('01').'-'.$this->input->post('period')));
            $end_date = date('Y-m-t',strtotime('28-'.$this->input->post('period')));
            $print_type = $this->input->post('print_type');
            
            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
            $data['str_start_date'] = date('01-m-Y',strtotime($start_date));
            $data['str_end_date'] = date('t-m-Y',strtotime($end_date));
            
            $data['general_ledgers'] = $this->journal_report_model->get_all_records_list($start_date,$end_date);
            
            if($print_type == 'pdf'){
                $html = $this->load->view('journal_report_pdf', $data, true);
                $this->pdf_generator->generate($html, lang('journal_report').' pdf',$orientation='Portrait');
            }
            else{
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment; filename=journal_report.xls");
                
                $this->load->view("journal_report_pdf", $data);
            }
        }
        else{
            redirect(base_url('journal_report'));
        }
        
    }
    
}

/* End of file contacts.php */
