<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Cb_payment_receive extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('cb_payment_receive_model');
        $this->load->library('pdf_generator');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('cb_payment_receive') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('cb_payment_receive');
        $this->session->set_userdata('page_header', 'reports');
        $this->session->set_userdata('page_detail', 'cb_payment_receive');
        $data['datatables'] = true;
        $data['form'] = true;
        
        $data['coas'] = $this->cb_payment_receive_model->get_account();
        
        $this->template->set_layout('users')->build('cb_payment_receives', isset($data) ? $data : null);
    }
    
    function print_report(){
        $start_date = date('Y-m-d',strtotime($this->input->post('start_date')));
        $end_date = date('Y-m-d',strtotime($this->input->post('end_date')));
        $start_time = date('H:i:s',strtotime($this->input->post('start_date')));
        $end_time = date('H:i:s',strtotime($this->input->post('end_date')));
        $coa_id = $this->input->post('coa_id');
        $print_type = $this->input->post('print_type');
              
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['start_time'] = $start_time;
        $data['end_time'] = $end_time;
        $data['str_start_date'] = date('d-m-Y',strtotime($start_date));
        $data['str_end_date'] = date('d-m-Y',strtotime($end_date));
        $data['coa_id'] = $coa_id;
        
        if($coa_id == 'All'){    
            $data['coas'] = $this->cb_payment_receive_model->get_account();
            
            if($print_type == 'pdf'){
                $html = $this->load->view('cb_all_payment_receive_pdf', $data, true);
                $this->pdf_generator->generate($html, 'all cash bank payment and receive pdf',$orientation='Portrait');
            }
            else{
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment; filename=report_all_cash_bank.xls");
                
                $this->load->view("cb_all_payment_receive_pdf", $data);
            }
        }
        else if($coa_id > 0){            
            $data_cb_trx = $this->cb_payment_receive_model->get_data_cb_trx_hdr_by_date($coa_id,$start_date,$end_date,$start_time,$end_time);
            $data_cb_trx2 = $this->cb_payment_receive_model->get_data_cb_trx_hdr_by_date2($coa_id,$start_date,$end_date,$start_time,$end_time);
            $data['data_cb_trx'] = $data_cb_trx;
            $data['data_cb_trx2'] = $data_cb_trx2;
            
            if($print_type == 'pdf'){
                $html = $this->load->view('cb_payment_receive_pdf', $data, true);
                $this->pdf_generator->generate($html, 'cash bank payment and receive pdf',$orientation='Portrait');
            }
            else{
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment; filename=report_cash_bank.xls");
                
                $this->load->view("cb_payment_receive_pdf", $data);
            }
        }
        else{
            redirect(base_url('cb_payment_receive'));
        }
        
    }
    
}

/* End of file contacts.php */
