<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Service_history_report extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('service_history_report_model');
        $this->load->library('pdf_generator');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('service_history_report') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('service_history_report');
        $this->session->set_userdata('page_header', 'reports');
        $this->session->set_userdata('page_detail', 'service_history_report');
        $data['datatables'] = true;
        $data['form'] = true;
        
		$data['vehicles'] = $this->service_history_report_model->get_all_data_vehicle();
		
        $this->template->set_layout('users')->build('service_history_reports', isset($data) ? $data : null);
    }
    
    function print_report(){
        if($this->input->post('start_date') != ''){
            $start_date = date('Y-m-d',strtotime($this->input->post('start_date')));
            $end_date = date('Y-m-d',strtotime($this->input->post('end_date')));
            $print_type = $this->input->post('print_type');
            
            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
            $data['per_end_date'] = '<b>'.date('d-m-Y',strtotime($start_date)).'</b> to <b>'.date('d-m-Y',strtotime($end_date)).'</b>';
            
            $data['data_gl'] = $this->service_history_report_model->get_all_records_list($start_date, $end_date);
            
            if($print_type == 'pdf'){
                $html = $this->load->view('service_history_report_pdf', $data, true);
                $this->pdf_generator->generate($html, lang('service_history_report').' pdf',$orientation='Portrait');
            }
            else{
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment; filename=service_history_report.xls");
                
                $this->load->view("service_history_report_pdf", $data);
            }
        }
        else{
            redirect(base_url('service_history_report'));
        }
        
    }
    
}

/* End of file contacts.php */
