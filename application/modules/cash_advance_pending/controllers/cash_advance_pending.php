<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Cash_advance_pending extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('cash_advance_pending_model');
        $this->load->library('pdf_generator');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('cash_advance_pending') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('cash_advance_pending');
        $this->session->set_userdata('page_header', 'reports');
        $this->session->set_userdata('page_detail', 'cash_advance_pending');
        $data['datatables'] = true;
        $data['form'] = true;
        
        $data['departements'] = $this->cash_advance_pending_model->get_data_departement();

        $this->template->set_layout('users')->build('cash_advance_pendings', isset($data) ? $data : null);
    }
    
    function print_report(){
        if($this->input->post('start_date') != ''){
            $start_date = date('Y-m-d',strtotime($this->input->post('start_date')));
            $end_date = date('Y-m-d',strtotime($this->input->post('end_date')));
            $dep_id = $this->input->post('dep_id');
            $print_type = $this->input->post('print_type');
                  
            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
            $data['str_start_date'] = date('d-m-Y',strtotime($start_date));
            $data['str_end_date'] = date('d-m-Y',strtotime($end_date));
            
            if($dep_id == 'all'){
                $data['dep_name'] = 'ALL';
            }
            else{
                $get_departement = $this->cash_advance_pending_model->get_data_by_row_id('sa_dep',$dep_id);
                $data['dep_name'] = $get_departement->dep_name;
            }
            
            $data['cash_advance_lists'] = $this->cash_advance_pending_model->get_all_records_list($dep_id,$start_date,$end_date);
            
            if($print_type == 'pdf'){
                $html = $this->load->view('cash_advance_pending_pdf', $data, true);
                $this->pdf_generator->generate($html, lang('cash_advance_pending').' pdf',$orientation='Landscape');
            }
            else{
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment; filename=report_cash_advance_pending.xls");
                
                $this->load->view("cash_advance_pending_pdf", $data);
            }
        }
        else{
            redirect(base_url('cash_advance_pending'));
        }
        
    }
    
}

/* End of file contacts.php */
