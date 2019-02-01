<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Vehicle_Document extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Vehicle_document_model','vehicle_model');
        $this->load->library('pdf_generator');

    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('vehicle_documents') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('vehicle_documents');
        $this->session->set_userdata('page_header', 'monitoring');
        $this->session->set_userdata('page_detail', 'vehicle_documents');
        $data['datatables'] = true;
        $data['form'] = true;
        
        if($this->session->userdata('expired_start_date') == '' && $this->session->userdata('expired_end_date') == ''){
            $str_between_stnk = "";       
            $str_between_kir = "";     
            $start_date = date("d-m-Y");
            $end_date = date("d-m-Y");
            $periode = "All";  
        }
        else{
            $str_between_stnk = "AND `sa_vehicle`.`expired_stnk` between '".$this->session->userdata('expired_start_date')."' and '".$this->session->userdata('expired_end_date')."'";
            $str_between_kir = "AND `sa_vehicle`.`expired_kir` between '".$this->session->userdata('expired_start_date')."' and '".$this->session->userdata('expired_end_date')."'";
            $start_date = date("d-m-Y",strtotime($this->session->userdata('expired_start_date')));
            $end_date = date("d-m-Y",strtotime($this->session->userdata('expired_end_date')));
            $periode = date("d F Y", strtotime($start_date))." ".lang('to')." ".date("d F Y", strtotime($end_date));  
        }
        
        $sql_stnk = "SELECT `sa_vehicle`.*, 
                    `sa_debtor`.`debtor_cd` AS driver_code, `sa_debtor`.`debtor_name` AS driver_name 
                    FROM (`sa_vehicle`) LEFT JOIN `sa_debtor` ON `sa_vehicle`.`debtor_rowID`=`sa_debtor`.`rowID` 
                    WHERE `sa_vehicle`.`rowID` > 0 AND `sa_vehicle`.`deleted` = 0 
                            ".$str_between_stnk." 
                    ORDER BY `sa_vehicle`.`rowID` desc";

        $sql_kir = "SELECT `sa_vehicle`.*, 
                    `sa_debtor`.`debtor_cd` AS driver_code, `sa_debtor`.`debtor_name` AS driver_name 
                    FROM (`sa_vehicle`) LEFT JOIN `sa_debtor` ON `sa_vehicle`.`debtor_rowID`=`sa_debtor`.`rowID` 
                    WHERE `sa_vehicle`.`rowID` > 0 AND `sa_vehicle`.`deleted` = 0 
                            ".$str_between_kir." 
                    ORDER BY `sa_vehicle`.`rowID` desc";
                    
        $data['vehicles_stnk'] = $this->db->query($sql_stnk)->result();
        $data['vehicles_kir'] = $this->db->query($sql_kir)->result();
        $data['periode'] = $periode;
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        
        $this->template->set_layout('users')->build('vehicles', isset($data) ? $data : null);
    }
    
    function set_filter(){
	   if($this->input->post('filter_type') == "All"){
	       $this->session->unset_userdata('expired_start_date');
           $this->session->unset_userdata('expired_end_date');
	   }
       else{
	       $this->session->set_userdata('expired_start_date',date("Y-m-d",strtotime($this->input->post('start_date'))));
           $this->session->set_userdata('expired_end_date',date("Y-m-d",strtotime($this->input->post('end_date'))));    
       }
       
       redirect(base_url().'vehicle_document');
    }
    
    function pdf()
    {
        if($this->session->userdata('expired_start_date') == '' && $this->session->userdata('expired_end_date') == ''){
            $str_between_stnk = "";       
            $str_between_kir = "";     
            $start_date = date("d-m-Y");
            $end_date = date("d-m-Y");
            $periode = "All";  
        }
        else{
            $str_between_stnk = "AND `sa_vehicle`.`expired_stnk` between '".$this->session->userdata('expired_start_date')."' and '".$this->session->userdata('expired_end_date')."'";
            $str_between_kir = "AND `sa_vehicle`.`expired_kir` between '".$this->session->userdata('expired_start_date')."' and '".$this->session->userdata('expired_end_date')."'";
            $start_date = date("d-m-Y",strtotime($this->session->userdata('expired_start_date')));
            $end_date = date("d-m-Y",strtotime($this->session->userdata('expired_end_date')));
            $periode = date("d F Y", strtotime($start_date))." ".lang('to')." ".date("d F Y", strtotime($end_date));  
        }
        
        $sql_stnk = "SELECT `sa_vehicle`.*, 
                    `sa_debtor`.`debtor_cd` AS driver_code, `sa_debtor`.`debtor_name` AS driver_name 
                    FROM (`sa_vehicle`) LEFT JOIN `sa_debtor` ON `sa_vehicle`.`debtor_rowID`=`sa_debtor`.`rowID` 
                    WHERE `sa_vehicle`.`rowID` > 0 AND `sa_vehicle`.`deleted` = 0 
                            ".$str_between_stnk." 
                    ORDER BY `sa_vehicle`.`police_no` asc";

        $sql_kir = "SELECT `sa_vehicle`.*, 
                    `sa_debtor`.`debtor_cd` AS driver_code, `sa_debtor`.`debtor_name` AS driver_name 
                    FROM (`sa_vehicle`) LEFT JOIN `sa_debtor` ON `sa_vehicle`.`debtor_rowID`=`sa_debtor`.`rowID` 
                    WHERE `sa_vehicle`.`rowID` > 0 AND `sa_vehicle`.`deleted` = 0 
                            ".$str_between_kir." 
                    ORDER BY `sa_vehicle`.`police_no` asc";

        $data['vehicles_stnk'] = $this->db->query($sql_stnk)->result();
        $data['vehicles_kir'] = $this->db->query($sql_kir)->result();
        $data['periode'] = $periode;
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;

        $html = $this->load->view('vehicle_pdf', $data, true);
        $this->pdf_generator->generate($html, 'Vehicle Document',$orientation='Landscape');
    }
    
    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=vehicle_documents.xls");
        
        if($this->session->userdata('expired_start_date') == '' && $this->session->userdata('expired_end_date') == ''){
            $str_between_stnk = "";       
            $str_between_kir = "";     
            $start_date = date("d-m-Y");
            $end_date = date("d-m-Y");
            $periode = "All";  
        }
        else{
            $str_between_stnk = "AND `sa_vehicle`.`expired_stnk` between '".$this->session->userdata('expired_start_date')."' and '".$this->session->userdata('expired_end_date')."'";
            $str_between_kir = "AND `sa_vehicle`.`expired_kir` between '".$this->session->userdata('expired_start_date')."' and '".$this->session->userdata('expired_end_date')."'";
            $start_date = date("d-m-Y",strtotime($this->session->userdata('expired_start_date')));
            $end_date = date("d-m-Y",strtotime($this->session->userdata('expired_end_date')));
            $periode = date("d F Y", strtotime($start_date))." ".lang('to')." ".date("d F Y", strtotime($end_date));  
        }
        
        $sql_stnk = "SELECT `sa_vehicle`.*, 
                    `sa_debtor`.`debtor_cd` AS driver_code, `sa_debtor`.`debtor_name` AS driver_name 
                    FROM (`sa_vehicle`) LEFT JOIN `sa_debtor` ON `sa_vehicle`.`debtor_rowID`=`sa_debtor`.`rowID` 
                    WHERE `sa_vehicle`.`rowID` > 0 AND `sa_vehicle`.`deleted` = 0 
                            ".$str_between_stnk." 
                    ORDER BY `sa_vehicle`.`police_no` asc";

        $sql_kir = "SELECT `sa_vehicle`.*, 
                    `sa_debtor`.`debtor_cd` AS driver_code, `sa_debtor`.`debtor_name` AS driver_name 
                    FROM (`sa_vehicle`) LEFT JOIN `sa_debtor` ON `sa_vehicle`.`debtor_rowID`=`sa_debtor`.`rowID` 
                    WHERE `sa_vehicle`.`rowID` > 0 AND `sa_vehicle`.`deleted` = 0 
                            ".$str_between_kir." 
                    ORDER BY `sa_vehicle`.`police_no` asc";

        $data['vehicles_stnk'] = $this->db->query($sql_stnk)->result();
        $data['vehicles_kir'] = $this->db->query($sql_kir)->result();
        $data['periode'] = $periode;
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;

        $this->load->view("vehicle_pdf", $data);

    }
}

/* End of file contacts.php */
