<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Do_commission_report extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('do_commission_report_model');
        $this->load->library('pdf_generator');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('do_commission_report') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('do_commission_report');
        $this->session->set_userdata('page_header', 'reports');
        $this->session->set_userdata('page_detail', 'do_commission_report');
        $data['datatables'] = true;
        $data['form'] = true;
        
        $data['drivers'] = $this->do_commission_report_model->get_all_driver();
         
        $this->template->set_layout('users')->build('do_commission_reports', isset($data) ? $data : null);
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
            
            if($debtor_id == 'all'){
                $data['driver_name'] = 'All';   
                $data['list_do'] = $this->do_commission_report_model->get_all_records_list($start_date,$end_date,'');

                if($print_type == 'pdf'){
                    $html = $this->load->view('all_do_commission_report_pdf', $data, true);
                    $this->pdf_generator->generate($html, 'All '.lang('do_commission_report').' pdf',$orientation='Landscape');
                }
                else{
                    header("Content-type: application/octet-stream");
                    header("Content-Disposition: attachment; filename=all_do_commission_report.xls");
                    
                    $this->load->view("all_do_commission_report_pdf", $data);
                }
            }
            else{
                $get_data_driver = $this->do_commission_report_model->get_driver_by_id($debtor_id);
                $data['driver_name'] = $get_data_driver->debtor_name;
                $data['list_do'] = $this->do_commission_report_model->get_all_records_list($start_date,$end_date,$debtor_id);
            
                if($print_type == 'pdf'){
                    $html = $this->load->view('do_commission_report_pdf', $data, true);
                    $this->pdf_generator->generate($html, lang('do_commission_report').' pdf',$orientation='Landscape');
                }
                else{
                    header("Content-type: application/octet-stream");
                    header("Content-Disposition: attachment; filename=do_commission_report.xls");
                    
                    $this->load->view("do_commission_report_pdf", $data);
                }
            }       
        }
        else{
            redirect(base_url('do_commission_report'));
        }
        
    }
    
}

/* End of file contacts.php */
