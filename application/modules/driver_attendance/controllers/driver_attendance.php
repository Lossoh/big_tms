<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Driver_attendance extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('driver_attendance_model');
        $this->load->library('pdf_generator');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('driver_attendance') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('driver_attendance');
        $this->session->set_userdata('page_header', 'reports');
        $this->session->set_userdata('page_detail', 'driver_attendance');
        $data['datatables'] = true;
        $data['form'] = true;
        
        $this->template->set_layout('users')->build('driver_attendances', isset($data) ? $data : null);
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
            
            $data['attendances'] = $this->driver_attendance_model->get_all_records_list($start_date,$end_date);
            
            if($print_type == 'pdf'){
                $html = $this->load->view('driver_attendance_pdf', $data, true);
                $this->pdf_generator->generate($html, lang('driver_attendance').' pdf',$orientation='Portrait');
            }
            else{
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment; filename=report_driver_attendance.xls");
                
                $this->load->view("driver_attendance_pdf", $data);
            }
        }
        else{
            redirect(base_url('driver_attendance'));
        }
        
    }
    
}

/* End of file contacts.php */
