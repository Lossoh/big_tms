<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Cash_advance_destination extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('cash_advance_destination_model');
        $this->load->library('pdf_generator');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('cash_advance_destination') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('cash_advance_destination');
        $this->session->set_userdata('page_header', 'reports');
        $this->session->set_userdata('page_detail', 'cash_advance_destination');
        $data['datatables'] = true;
        $data['form'] = true;
        
        $data['destinations'] = $this->cash_advance_destination_model->get_all_destination();
        
        $this->template->set_layout('users')->build('cash_advance_destinations', isset($data) ? $data : null);
    }
    
    function print_report(){
        if($this->input->post('start_date') != ''){
            $start_date = date('Y-m-d',strtotime($this->input->post('start_date')));
            $end_date = date('Y-m-d',strtotime($this->input->post('end_date')));
            $from_id = $this->input->post('from_id');
            $to_id = $this->input->post('to_id');
            $print_type = $this->input->post('print_type');
                  
            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
            $data['str_start_date'] = date('d-m-Y',strtotime($start_date));
            $data['str_end_date'] = date('d-m-Y',strtotime($end_date));
            
                   
            $data['cash_advance_lists'] = $this->cash_advance_destination_model->get_all_records_list($this->session->userdata('partial_data'), 
                                            $this->session->userdata('dep_rowID'),$from_id,$to_id,$start_date,$end_date);
            
            if($print_type == 'pdf'){
                $html = $this->load->view('cash_advance_destination_pdf', $data, true);
                $this->pdf_generator->generate($html, lang('cash_advance_destination').' pdf',$orientation='Landscape');
            }
            else{
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment; filename=report_cash_advance_destination.xls");
                
                $this->load->view("cash_advance_destination_pdf", $data);
            }
        }
        else{
            redirect(base_url('cash_advance_destination'));
        }
        
    }
    
}

/* End of file contacts.php */
