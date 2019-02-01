<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Deposit_report extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('deposit_report_model');
        $this->load->library('pdf_generator');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('deposit_report') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('deposit_report');
        $this->session->set_userdata('page_header', 'reports');
        $this->session->set_userdata('page_detail', 'deposit_report');
        $data['datatables'] = true;
        $data['form'] = true;
                
        $this->template->set_layout('users')->build('deposit_reports', isset($data) ? $data : null);
    }
    
    function print_report(){
        if($this->input->post('start_period') != ''){
            $start_period = $this->input->post('start_period');
            $end_period = $this->input->post('end_period');
            $year = $this->input->post('year');
            $print_type = $this->input->post('print_type');
                  
            $data['start_period'] = $start_period;
            $data['end_period'] = $end_period;
            $data['year'] = $year;
            
            if($start_period == $end_period)
                $data['deposit_list'] = $this->deposit_report_model->get_all_records_list_same_period($start_period,$year);
            else
                $data['deposit_list'] = $this->deposit_report_model->get_all_records_list($start_period,$end_period,$year);
                
            if($print_type == 'pdf'){
                $html = $this->load->view('deposit_report_pdf', $data, true);
                $this->pdf_generator->generate($html, lang('deposit_report').' pdf',$orientation='Landscape');
            }
            else{
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment; filename=deposit_report.xls");
                
                $this->load->view("deposit_report_pdf", $data);
            }       
        }
        else{
            redirect(base_url('deposit_report'));
        }
        
    }
    
}

/* End of file contacts.php */
