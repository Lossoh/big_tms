<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Yearly_bonus_report extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('yearly_bonus_report_model');
        $this->load->library('pdf_generator');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('yearly_bonus_report') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('yearly_bonus_report');
        $this->session->set_userdata('page_header', 'reports');
        $this->session->set_userdata('page_detail', 'yearly_bonus_report');
        $data['datatables'] = true;
        $data['form'] = true;
                 
        $this->template->set_layout('users')->build('yearly_bonus_reports', isset($data) ? $data : null);
    }
    
    function print_report(){
        if($this->input->post('start_date') != ''){
            $start_date = date('Y-m-d',strtotime($this->input->post('start_date')));
            $end_date = date('Y-m-d',strtotime($this->input->post('end_date')));
            $print_type = $this->input->post('print_type');
                  
            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
            $data['str_start_date'] = date('d-m-Y',strtotime($start_date));
            $data['str_end_date'] = date('d-m-Y',strtotime($end_date));
            
            $data['vehicles'] = $this->yearly_bonus_report_model->get_vehicles();
            
            if($print_type == 'pdf'){
                $html = $this->load->view('yearly_bonus_report_pdf', $data, true);
                $this->pdf_generator->generate($html, lang('yearly_bonus_report').' pdf',$orientation='Portrait');
            }
            else{
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment; filename=yearly_bonus_report.xls");
                
                $this->load->view("yearly_bonus_report_pdf", $data);
            }       
        }
        else{
            redirect(base_url('yearly_bonus_report'));
        }
        
    }
    
}

/* End of file contacts.php */
