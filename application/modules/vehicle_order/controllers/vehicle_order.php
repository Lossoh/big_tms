<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Vehicle_Order extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('vehicle_order_model');
        $this->load->model('vehicle/vehicle_model');
        $this->load->library('pdf_generator');
        
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('vehicle_orders') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('vehicle_orders');
        $this->session->set_userdata('page_header', 'monitoring');
        $this->session->set_userdata('page_detail', 'vehicle_orders');
        $data['datatables'] = true;
        $data['form'] = true;
        
        $data['vehicle_orders'] = $this->vehicle_order_model->get_all_records_list();
        
        $data['vehicles'] = $this->vehicle_model->get_all_records_list($table =
            'sa_vehicle', $array = array('sa_vehicle.rowID >' => 0, 'sa_vehicle.deleted' =>
                0), $join_table1 = 'sa_debtor', $join_criteria1 =
            'sa_vehicle.debtor_rowID=sa_debtor.rowID', 'sa_vehicle.rowID', 'asc');
            
        $this->template->set_layout('users')->build('vehicles', isset($data) ? $data : null);
    }
    
    function pdf()
    {
        $data['vehicle_orders'] = $this->vehicle_order_model->get_all_records_list();
        $html = $this->load->view('vehicle_pdf', $data, true);
        $this->pdf_generator->generate($html, 'Vehicle Document',$orientation='Potrait');
    }
    
    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=vehicle_orders.xls");
        $data['vehicle_orders'] = $this->vehicle_order_model->get_all_records_list();

        $this->load->view("vehicle_pdf", $data);
    }
    
}

/* End of file contacts.php */
