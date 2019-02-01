<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Verification_document_report extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('verification_document_report_model');
        $this->load->library('pdf_generator');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('verification_documents_verified') . ' Report - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('verification_document_report');
        $this->session->set_userdata('page_header', 'reports');
        $this->session->set_userdata('page_detail', 'verification_document_report');
        $data['datatables'] = true;
        $data['form'] = true;
        
        $this->template->set_layout('users')->build('verification_document_reports', isset($data) ? $data : null);
    }
    
    function print_report(){
        if($this->input->post('start_date') != ''){
            $start_date = date('Y-m-d',strtotime($this->input->post('start_date')));
            $end_date = date('Y-m-d',strtotime($this->input->post('end_date')));
            $user_type = $this->input->post('user_type');
            $print_type = $this->input->post('print_type');
                  
            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
            $data['str_start_date'] = date('d-m-Y',strtotime($start_date));
            $data['str_end_date'] = date('d-m-Y',strtotime($end_date));
            $data['user_type'] = $user_type;
            
            if($user_type == 'mine'){
                $str_user_rowID = "AND `a`.`user_verified` = ".$this->session->userdata('user_rowID');    
            }
            
            $str_between = "AND `a`.`date_verified` BETWEEN '".$start_date."' and '".$end_date."'";
            
            $sql = "SELECT `a`.`rowID`, `a`.`trx_no`, `a`.`jo_no`, `a`.`container_no`, `a`.`do_no`, a.deliver_weight, a.received_weight, a.deliver_date, a.received_date, `a`.`status`, `a`.`deleted`, `a`.`invoice_no`, `a`.`commission_no`, `a`.`komisi_supir`, `a`.`komisi_kernet`,
                            `b`.`advance_no`, `b`.`advance_date`, `b`.`advance_allocation`, `c`.`debtor_name`, `d`.`police_no`, e.alloc_date, e.alloc_amt, e.doc_sj, e.doc_st, e.doc_sm, e.doc_sr, 
                            `f`.`vessel_name`, g.destination_name as from_name, h.destination_name as to_name, i.item_name, k.type_name
                    FROM (`tr_do_trx` as a) 
                        LEFT JOIN `cb_cash_adv` as b ON `a`.`trx_no` = `b`.`trx_no` 
                        LEFT JOIN `sa_debtor` as c ON `b`.`employee_driver_rowID` = `c`.`rowID` 
                        LEFT JOIN `sa_vehicle` as d ON `b`.`vehicle_rowID` = `d`.`rowID` 
                        LEFT JOIN `cb_cash_adv_alloc` as e ON `a`.`trx_no` = `e`.`alloc_no` 
                        LEFT JOIN `tr_jo_trx_hdr` as f ON `a`.`jo_no` = `f`.`jo_no`
                        LEFT JOIN `sa_destination` as g ON `f`.`destination_from_rowID` = `g`.`rowID`
                        LEFT JOIN `sa_destination` as h ON `f`.`destination_to_rowID` = `h`.`rowID`
                        LEFT JOIN `sa_item` as i ON `f`.`item_rowID` = `i`.`rowID`
                        LEFT JOIN `sa_fare_trip_hdr` as j ON `b`.`fare_trip_rowID` = `j`.`rowID`
                        LEFT JOIN `sa_vehicle_type` as k ON `j`.`vehicle_id` = `k`.`rowID`
                    WHERE `a`.`deleted` = 0 AND `b`.`deleted` = 0 AND `e`.`deleted` = 0 AND `f`.`deleted` = 0 AND `a`.`status` = 1 ".$str_user_rowID." ".$str_between." 
                    ORDER BY a.trx_no, `a`.`date_verified` desc, `c`.`debtor_name` asc, a.received_date, `a`.`do_no` asc";
            
            $data['verification_documents'] = $this->db->query($sql)->result();
            
            if($print_type == 'pdf'){
                $html = $this->load->view('verification_document_report_pdf', $data, true);
                $this->pdf_generator->generate($html, lang('verification_document_report').' pdf',$orientation='Landscape');
            }
            else{
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment; filename=report_verification_document_report.xls");
                
                $this->load->view("verification_document_report_pdf", $data);
            }
        }
        else{
            redirect(base_url('verification_document_report'));
        }
        
    }
    
}

/* End of file contacts.php */
