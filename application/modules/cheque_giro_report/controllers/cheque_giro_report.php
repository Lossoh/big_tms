<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Cheque_giro_report extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('cheque_giro_report_model');
        $this->load->library('pdf_generator');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('cheque_giro_report') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('cheque_giro_report');
        $this->session->set_userdata('page_header', 'reports');
        $this->session->set_userdata('page_detail', 'cheque_giro_report');
        $data['datatables'] = true;
        $data['form'] = true;
        
        $this->template->set_layout('users')->build('cheque_giro_reports', isset($data) ? $data : null);
    }
    
    function print_report(){
        if($this->input->post('start_date') != ''){
            $start_date = date('Y-m-d',strtotime($this->input->post('start_date')));
            $end_date = date('Y-m-d',strtotime($this->input->post('end_date')));
            $status = $this->input->post('status');
            $print_type = $this->input->post('print_type');
            
            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
            $data['status'] = $status;
            $data['per_end_date'] = '<b>'.date('d-m-Y',strtotime($start_date)).'</b> to <b>'.date('d-m-Y',strtotime($end_date)).'</b>';
            
            $data['data_cheque_giro'] = $this->cheque_giro_report_model->get_all_records_list($start_date, $end_date, $status);
            
            if($print_type == 'pdf'){
                $html = $this->load->view('cheque_giro_report_pdf', $data, true);
                $this->pdf_generator->generate($html, lang('cheque_giro_report').' pdf',$orientation='Landscape');
            }
            else{
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment; filename=cheque_giro_report.xls");
                
                $this->load->view("cheque_giro_report_pdf", $data);
            }
        }
        else{
            redirect(base_url('cheque_giro_report'));
        }
        
    }
    
}

/* End of file contacts.php */
