<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Cash_advance_deleted extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('cash_advance_deleted_model');
        $this->load->model('finances/finances_model');
        $this->load->library('pdf_generator');
        
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('cash_advance_deleted') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('cash_advance_deleted');
        $this->session->set_userdata('page_header', 'monitoring');
        $this->session->set_userdata('page_detail', 'cash_advance_deleted');
        $data['datatables'] = true;
        $data['form'] = true;
        
        if($this->session->userdata('start_date_cd') == '' && $this->session->userdata('end_date_cd') == ''){
            $start_date = date("Y-m-d",strtotime("yesterday"));
            $end_date = date("Y-m-d");
        }
        else{
            $start_date = $this->session->userdata('start_date_cd');
            $end_date = $this->session->userdata('end_date_cd');
        }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
            
        $data['cash_advance_lists'] = $this->cash_advance_deleted_model->get_all_records_list($this->
            session->userdata('partial_data'), $this->session->userdata('dep_rowID'),$start_date,$end_date);
             
        $this->template->set_layout('users')->build('cash_advance_deleteds', isset($data) ? $data : null);
    }
    
    function set_filter(){
       $this->session->set_userdata('start_date_cd',date("Y-m-d",strtotime($this->input->post('start_date'))));
       $this->session->set_userdata('end_date_cd',date("Y-m-d",strtotime($this->input->post('end_date'))));    
       
       redirect(base_url().'cash_advance_deleted');
    }
    
    function pdf()
    {
        if($this->session->userdata('start_date_cd') == '' && $this->session->userdata('end_date_cd') == ''){
            $start_date = date("Y-m-d",strtotime("yesterday"));
            $end_date = date("Y-m-d");
        }
        else{
            $start_date = $this->session->userdata('start_date_cd');
            $end_date = $this->session->userdata('end_date_cd');
        }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['periode'] = date("d F Y",strtotime($start_date)).' - '.date("d F Y",strtotime($end_date));
        
        $data['cash_advance_lists'] = $this->cash_advance_deleted_model->get_all_records_list($this->
            session->userdata('partial_data'), $this->session->userdata('dep_rowID'),$start_date,$end_date);
           
        $html = $this->load->view('cash_advance_deleted_pdf', $data, true);
        $this->pdf_generator->generate($html, 'Csh Advance Deleted Document',$orientation='Potrait');
    }
    
    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=cash_advance_deleted.xls");
        if($this->session->userdata('start_date_cd') == '' && $this->session->userdata('end_date_cd') == ''){
            $start_date = date("Y-m-d",strtotime("yesterday"));
            $end_date = date("Y-m-d");
        }
        else{
            $start_date = $this->session->userdata('start_date_cd');
            $end_date = $this->session->userdata('end_date_cd');
        }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['periode'] = date("d F Y",strtotime($start_date)).' - '.date("d F Y",strtotime($end_date));
        
        $data['cash_advance_lists'] = $this->cash_advance_deleted_model->get_all_records_list($this->
            session->userdata('partial_data'), $this->session->userdata('dep_rowID'),$start_date,$end_date);
         
        $this->load->view("cash_advance_deleted_pdf", $data);
    }
    
}

/* End of file contacts.php */
