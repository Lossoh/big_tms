<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Trial_balance_report extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('trial_balance_report_model');
        $this->load->library('pdf_generator');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('trial_balance_report') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('trial_balance_report');
        $this->session->set_userdata('page_header', 'reports');
        $this->session->set_userdata('page_detail', 'trial_balance_report');
        $data['datatables'] = true;
        $data['form'] = true;
        
        $this->template->set_layout('users')->build('trial_balance_reports', isset($data) ? $data : null);
    }
    
    function print_report(){
        if($this->input->post('time_type') == 'monthly'){
            $start_date = date('Y-m-01',strtotime(date('01').'-'.$this->input->post('period')));
            $end_date = date('Y-m-t',strtotime('28-'.$this->input->post('period')));
            $print_type = $this->input->post('print_type');
            
            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
            $data['per_end_date'] = 'Per '.date('d F Y',strtotime($end_date));
            
            $data['coas'] = $this->trial_balance_report_model->get_account();
            
            if($print_type == 'pdf'){
                $html = $this->load->view('trial_balance_report_pdf', $data, true);
                $this->pdf_generator->generate($html, lang('trial_balance_report').' pdf',$orientation='Landscape');
            }
            else{
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment; filename=trial_balance_report.xls");
                
                $this->load->view("trial_balance_report_pdf", $data);
            }
        }
        else if($this->input->post('time_type') == 'yearly'){
            $start_date = date('Y-m-01',strtotime(date('01').'-'.$this->input->post('start_date')));
            $end_date = date('Y-m-t',strtotime('28-'.$this->input->post('end_date')));
            $print_type = $this->input->post('print_type');
            
            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
            $data['per_end_date'] = date('F',strtotime($start_date)).' - '.date('F Y',strtotime($end_date));
            
            $data['coas'] = $this->trial_balance_report_model->get_account();
            
            if($print_type == 'pdf'){
                $html = $this->load->view('trial_balance_yearly_report_pdf', $data, true);
                $this->pdf_generator->generate($html, lang('trial_balance_report').' pdf',$orientation='Landscape');
            }
            else{
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment; filename=trial_balance_yearly_report.xls");
                
                $this->load->view("trial_balance_yearly_report_pdf", $data);
            }
        }
        else{
            redirect(base_url('trial_balance_report'));
        }
        
    }
    
}

/* End of file contacts.php */
