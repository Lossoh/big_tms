<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Refunds extends MX_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('refunds_model');
        
        $this->load->library('pdf_generator');
         
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('refund_list') . ' - ' . $this->config->item('website_name') .
            ' - ' . $this->config->item('comp_name') . ' ' . $this->config->item('version'));
        $data['page'] = lang('refund_list');
        $this->session->set_userdata('page_header', 'monitoring');
        $this->session->set_userdata('page_detail', 'refunds');
        $data['datatables'] = true;
        $data['form'] = true;
        
        if($this->session->userdata('start_date') == '' && $this->session->userdata('end_date') == ''){
            $start_date = date("Y-m-d",strtotime("yesterday"));
            $end_date = date("Y-m-d");
        }
        else{
            $start_date = $this->session->userdata('start_date');
            $end_date = $this->session->userdata('end_date');
        }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        
        $data['refund_lists'] = $this->refunds_model->get_all_records_list($this->
            session->userdata('partial_data'), $this->session->userdata('dep_rowID'),$start_date,$end_date);
            
        $this->template->set_layout('users')->build('refund_list', isset($data) ?
            $data : null);
    }
    
    function set_filter(){
       $this->session->set_userdata('start_date',date("Y-m-d",strtotime($this->input->post('start_date'))));
       $this->session->set_userdata('end_date',date("Y-m-d",strtotime($this->input->post('end_date'))));    
       
       redirect(base_url().'refunds');
    }

}
