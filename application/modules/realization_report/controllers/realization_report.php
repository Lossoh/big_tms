<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Realization_report extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('realization_report_model');
        $this->load->library('pdf_generator');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('realization_reports') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('realization_reports');
        $this->session->set_userdata('page_header', 'reports');
        $this->session->set_userdata('page_detail', 'realization_report');
        $data['datatables'] = true;
        $data['form'] = true;
        
        $data['departements'] = $this->realization_report_model->get_data_departement();
        
        $this->template->set_layout('users')->build('realization_reports', isset($data) ? $data : null);
    }
    
    function print_report(){
        $dep_id = $this->input->post('dep_id');
        $shift = $this->input->post('shift');
        $alloc_date = date('Y-m-d',strtotime($this->input->post('alloc_date')));
        
        $data['date'] = $alloc_date;
        
        if($shift == 'shift_1' || $shift == 'shift_2'){
            if($shift == 'shift_1'){
                $start_time = '08:00:00';
                $end_time   = '19:59:59';

                $start_date = $alloc_date.' '.$start_time;
                $end_date = $alloc_date.' '.$end_time;

                $data['shift'] = 'Shift 1';
            }
            else if($shift == 'shift_2'){
                $start_time = '20:00:00';
                $end_time   = '07:59:59';                

                $start_date = $alloc_date.' '.$start_time;
                $end_date_tmp = $alloc_date.' '.$end_time;
                
                $date_tmp = str_replace('-', '/', $end_date_tmp);
                $end_date = date('Y-m-d H:i:s',strtotime($date_tmp . "+1 days"));
                
                $data['shift'] = 'Shift 2';
            }            

            if($dep_id == 'all'){
                $data['dep_name'] = 'ALL';
                $data_realization = $this->realization_report_model->get_data_realization_by_date($start_date,$end_date);
            }
            else{
                $data_realization = $this->realization_report_model->get_data_realization_by_date_dep($start_date,$end_date,$dep_id);
                $get_departement = $this->realization_report_model->get_data_by_row_id('sa_dep',$dep_id);
                $data['dep_name'] = $get_departement->dep_name;
            }
            
            $data['data_realization'] = $data_realization;
            
            $html = $this->load->view('realization_report_pdf', $data, true);
            $this->pdf_generator->generate($html, 'realization pdf',$orientation='Portrait');
        }
        else{
            redirect(base_url('realization_report'));
        }
        
    }
    
}

/* End of file contacts.php */
