<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Schedule_event extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('schedule_event_model');
        $this->load->library('pdf_generator');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('schedule_events') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('schedule_events');
        $this->session->set_userdata('page_header', 'monitoring');
        $this->session->set_userdata('page_detail', 'schedule_event');
        $data['datatables'] = true;
        $data['form'] = true;
        
        $get_data_jo_emkl = $this->schedule_event_model->get_all_data_jo();
        $data_jo = array();
        
        if(count($get_data_jo_emkl) > 0){
            $no = 1;
            foreach($get_data_jo_emkl as $row){
                $get_etb_date = $this->schedule_event_model->get_etb_by_trx_no($row->trx_no);
                
                if(strtotime($get_etb_date->eta_date) < strtotime($get_etb_date->etb_date_vessel)){
                    $start_date = $get_etb_date->eta_date;
                    $end_date = $get_etb_date->etb_date_vessel;
                }
                else{
                    $start_date = $get_etb_date->etb_date_vessel;
                    $end_date = $get_etb_date->eta_date;
                }
                
                if(strtotime($get_etb_date->eta_date) == strtotime($get_etb_date->etb_date_vessel))
                    $color = "#0E64A0";
                else
                    $color = "#fff";
                
                $jo_no = $row->jo_no;
                $vessel_name = empty($get_etb_date->vessel_name) ? '-' : $get_etb_date->vessel_name;
                $eta_date = $get_etb_date->eta_date == '' ? '-' : date('d F Y',strtotime($get_etb_date->eta_date));
                $etb_date = $get_etb_date->etb_date_vessel == '' ? '-' : date('d F Y',strtotime($get_etb_date->etb_date_vessel));
                
                $data_jo_tmp = array(
                    'id' => $no,
                    'text' => "<a onclick='showDescription(\"".$jo_no."\",\"".$vessel_name."\",\"".$eta_date."\",\"".$etb_date."\")' style='color: ".$color."'>".$jo_no."</a>",
                    'start_date' => date('m/d/Y H:i:s',strtotime($start_date.' 00:00:00')),
                    'end_date' => date('m/d/Y H:i:s',strtotime($end_date.' 23:59:59'))
                );
                
                $no++;

                array_push($data_jo,$data_jo_tmp);
                
            }
        }

        $data['get_data_jo'] = json_encode($data_jo);
        
        $this->load->view('schedule_events',$data);        

    }
    
}

/* End of file contacts.php */
