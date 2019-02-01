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
        
        // JAM 08.00 - 10.00
        if($this->session->userdata('start_date_da_1') == '' && $this->session->userdata('end_date_da_1') == ''){
            $start_date_da_1 = date("Y-m-d",strtotime("yesterday"));
            $end_date_da_1 = date("Y-m-d");
        }
        else{
            $start_date_da_1 = $this->session->userdata('start_date');
            $end_date_da_1 = $this->session->userdata('end_date');
        }
        
        $data['start_date_da_1'] = $start_date_da_1;
        $data['end_date_da_1'] = $end_date_da_1;
        
        $data['driver_attendance_1'] = $this->driver_attendance_model->get_all_record_data($start_date_da_1,$end_date_da_1);
        
        // JAM 10.01 - 13.00
        if($this->session->userdata('start_date_da_2') == '' && $this->session->userdata('end_date_da_2') == ''){
            $start_date_da_2 = date("Y-m-d",strtotime("yesterday"));
            $end_date_da_2 = date("Y-m-d");
        }
        else{
            $start_date_da_2 = $this->session->userdata('start_date');
            $end_date_da_2 = $this->session->userdata('end_date');
        }
        
        $data['start_date_da_2'] = $start_date_da_2;
        $data['end_date_da_2'] = $end_date_da_2;
        
        $data['driver_attendance_2'] = $this->driver_attendance_model->get_all_record_data($start_date_da_2,$end_date_da_2);
        
        $this->template->set_layout('users')->build('driver_attendances', isset($data) ? $data : null);
    }
    
    function set_filter_1(){
       $this->session->set_userdata('start_date_1',date("Y-m-d",strtotime($this->input->post('start_date_1'))));
       $this->session->set_userdata('end_date_1',date("Y-m-d",strtotime($this->input->post('end_date_1'))));    
       
       redirect(base_url().'driver_attendance');
    }
    
    function set_filter_2(){
       $this->session->set_userdata('start_date_2',date("Y-m-d",strtotime($this->input->post('start_date_2'))));
       $this->session->set_userdata('end_date_2',date("Y-m-d",strtotime($this->input->post('end_date_2'))));    
       
       redirect(base_url().'driver_attendance');
    }

}

/* End of file contacts.php */
