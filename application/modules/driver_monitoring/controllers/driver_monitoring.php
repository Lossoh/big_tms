<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Driver_monitoring extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('driver_monitoring_model');
        $this->load->library('pdf_generator');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('driver_monitoring') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('driver_monitoring');
        $this->session->set_userdata('page_header', 'monitoring');
        $this->session->set_userdata('page_detail', 'driver_monitoring');
        $data['datatables'] = true;
        $data['form'] = true;
        $data['debtors'] = $this->driver_monitoring_model->get_all_record_debtor();

        $this->template->set_layout('users')->build('driver_monitoring', isset($data) ? $data : null);
    }
    
    function pdf()
    {
        $data['debtor'] = $this->driver_monitoring_model->get_all_records($table = 'sa_debtor', $array =
            array('rowID >' => '0', 'deleted' => '0'), $join_table = '', $join_criteria = '',
            'debtor_cd,debtor_name', 'desc');
            
        $html = $this->load->view('debtor_pdf', $data, true);
        $this->pdf_generator->generate($html, 'debtor pdf',$orientation='landscape');//Portrait
    }
    
    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=debtor.xls");

        $data['debtor'] = $this->driver_monitoring_model->get_all_records($table = 'sa_debtor', $array =
            array('rowID >' => '0', 'deleted' => '0'), $join_table = '', $join_criteria = '',
            'debtor_cd,debtor_name', 'desc');
            
        $this->load->view("debtor_excel", $data);

    }

}

/* End of file contacts.php */
