<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Service_receipt extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('service_receipt_model');
        $this->load->model('appmodel');
        $this->load->library('pdf_generator');
        $this->load->library('MoneyFormat');
    }
 
    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('service_receipt') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('service_receipt');
        $this->session->set_userdata('page_header', 'workshop');
        $this->session->set_userdata('page_detail', 'service_receipt');
        $data['datatables'] = true;
        $data['form'] = true;
        
        if($this->session->userdata('start_date_sr') == '' && $this->session->userdata('end_date_sr') == ''){
            $start_date = date("Y-m-d",strtotime("yesterday"));
            $end_date = date("Y-m-d");
        }
        else{
            $start_date = $this->session->userdata('start_date_sr');
            $end_date = $this->session->userdata('end_date_sr');
        }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        
        $data['service_receipts'] = $this->service_receipt_model->get_all_record_data($start_date,$end_date);

        $data['spk_data'] = $this->service_receipt_model->get_all_spk_data();
        $data['spk_not_receipt_data'] = $this->service_receipt_model->get_all_spk_not_receipt_data();
        
        $data['debtors'] = $this->service_receipt_model->get_all_debtor_data();
        
        $this->template->set_layout('users')->build('service_receipts', isset($data) ? $data : null);
    }

    function set_filter(){
       $this->session->set_userdata('start_date_sr',date("Y-m-d",strtotime($this->input->post('start_date'))));
       $this->session->set_userdata('end_date_sr',date("Y-m-d",strtotime($this->input->post('end_date'))));    
       
       redirect(base_url().'service_receipt');
    }

    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->service_receipt_model->get_by_id($tabel = 'tr_service_receipt_hdr', $id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function get_data_detail($trx_no)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->service_receipt_model->get_service_receipt_dtl_by_trx_no($trx_no);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function get_data_spk()
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $spk_no = $this->input->post('spk_no');
        $row = $this->input->post('row');
        if($spk_no == "OTHERS"){
            $total = 0;
            $descriptions = "";
        }
        else{
            $hasil = $this->service_receipt_model->get_spk_by_no($spk_no);
            $total = $hasil->cost_total;
            $descriptions = 'NAMA SUPIR : '.$hasil->debtor_name.', NO POLISI : '.$hasil->police_no;
        }
        
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode(array('spk_no' => $spk_no, 'row' => $row, 'total' => $total, 'descriptions' => $descriptions));
        exit;
    }
    
    function print_service_receipt($trx_no){
        $get_data = $this->service_receipt_model->get_service_receipt_hdr_by_trx_no($trx_no);
        $get_data_detail = $this->service_receipt_model->get_service_receipt_dtl_by_trx_no($trx_no);
        $data['get_data'] = $get_data;
        $data['get_data_detail'] = $get_data_detail;
         
        $sql_update = "UPDATE tr_service_receipt_hdr 
                        SET printed = printed + 1, user_printed = ".$this->session->userdata('user_rowID').",
                            date_printed = '".date('Y-m-d')."', time_printed = '".date('H:i:s')."'
                        WHERE trx_no = '".$trx_no."' AND deleted = 0";
        
        $this->db->query($sql_update);
        
        $params['user_rowID'] = $this->tank_auth->get_user_id();
		$params['module'] = 'Service Receipt';
		$params['module_field_id'] = $get_data->rowID;
		$params['activity'] = ucfirst('Print a Service Receipt No '.$trx_no);
		$params['icon'] = 'fa-print';
		modules::run('activitylog/log',$params); //log activity	
        
        $html = $this->load->view('print_service_receipt_pdf', $data, true);
        
        $this->pdf_generator->generate($html, 'Service Receipt pdf',$orientation='Portrait');
    }
    
    function pdf()
    {
        if($this->session->userdata('start_date_sr') == '' && $this->session->userdata('end_date_sr') == ''){
            $start_date = date("Y-m-d",strtotime("yesterday"));
            $end_date = date("Y-m-d");
        }
        else{
            $start_date = $this->session->userdata('start_date_sr');
            $end_date = $this->session->userdata('end_date_sr');
        }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        
        $data['service_receipts'] = $this->service_receipt_model->get_all_record_data($start_date,$end_date);
        
        $html = $this->load->view('service_receipt_pdf', $data, true);
        $this->pdf_generator->generate($html, 'service_receipt pdf',$orientation='Portrait');
    }
    
    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=service_receipt.xls");
        
        if($this->session->userdata('start_date_sr') == '' && $this->session->userdata('end_date_sr') == ''){
            $start_date = date("Y-m-d",strtotime("yesterday"));
            $end_date = date("Y-m-d");
        }
        else{
            $start_date = $this->session->userdata('start_date_sr');
            $end_date = $this->session->userdata('end_date_sr');
        }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        
        $data['service_receipts'] = $this->service_receipt_model->get_all_record_data($start_date,$end_date);
        
        $this->load->view("service_receipt_pdf", $data);

    }

    function create()
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $error = false;
        $this->db->trans_begin();
        $dataPost = $this->input->post();            

        if (empty($dataPost['rowID'])) {
            if(date('Y-m-d',strtotime($dataPost['trx_date'])) != date('Y-m-d')){
                $trx_date = date('Y-m-d');
            }
            else{
                $trx_date = date('Y-m-d',strtotime($dataPost['trx_date']));
            }
            
            $trx_date_year = date('Y',strtotime($trx_date));
            $trx_date_month = date('m',strtotime($trx_date));
            $sa_spec_prefix = 'SR';
            
            $trx_code = ((int)$this->appmodel->select_max_id('tr_service_receipt_hdr', $array =
                array(
                'prefix' => $sa_spec_prefix,
                'year' => $trx_date_year,
                'month' => $trx_date_month,
                'deleted' => 0), 'code')) + 1;
            $trx_no = $sa_spec_prefix . sprintf("%04s", $trx_date_year) . sprintf("%02s",
                $trx_date_month) . sprintf("%05s", $trx_code);
            
            $check_trx_no = $this->service_receipt_model->get_service_receipt_hdr_by_trx_no($trx_no);
            if(count($check_trx_no) > 0){
                $trx_code = ((int)$this->appmodel->select_max_id('tr_service_receipt_hdr', $array =
                    array(
                    'prefix' => $sa_spec_prefix,
                    'year' => $trx_date_year,
                    'month' => $trx_date_month,
                    'deleted' => 0), 'code')) + 1;
                $trx_no = $sa_spec_prefix . sprintf("%04s", $trx_date_year) . sprintf("%02s",
                    $trx_date_month) . sprintf("%05s", $trx_code);
                
            }
            
            $data_service_receipt_hdr = array(
                'prefix' => $sa_spec_prefix,
                'year' => $trx_date_year,
                'month' => $trx_date_month,
                'code' => $trx_code,
                'trx_no' => $trx_no,
                'trx_date' => $trx_date,
                'debtor_rowID' => $dataPost['debtor_rowID'],
                'remark' => $dataPost['remark'],
                'total' => str_replace('.','',$dataPost['total']),
                'user_created' => $this->session->userdata('user_id'),
                'date_created' => $trx_date,
                'time_created' => date('H:i:s')
            );
            
            $result = $this->db->insert('tr_service_receipt_hdr', $data_service_receipt_hdr);
            $service_receipt_id = 0;
            if($result){
                $service_receipt_id = $this->db->insert_id();
                $spk_no = $dataPost['spk_no'];
                $descriptions = $dataPost['descriptions'];
                $amount = $dataPost['amount'];
                
                for($i=0;$i<count($amount);$i++){
                    $data_service_receipt_dtl = array(
                        'trx_no' => $trx_no,
                        'spk_no' => $spk_no[$i],
                        'descriptions' => $descriptions[$i],
                        'amount' => str_replace('.','',$amount[$i]),
                        'user_created' => $this->session->userdata('user_id'),
                        'date_created' => $trx_date,
                        'time_created' => date('H:i:s')
                    );
                    
                    $result = $this->db->insert('tr_service_receipt_dtl', $data_service_receipt_dtl);
                    if($result){
                        $data_spk = array(
                            'receipt_no' => $trx_no,
                            'user_modified' => $this->session->userdata('user_id'),
                            'date_modified' => $trx_date,
                            'time_modified' => date('H:i:s')
                        );
                        $this->db->where('deleted',0);
                        $this->db->where('trx_no',$spk_no[$i]);
                        $result = $this->db->update('tr_spk_service_history', $data_spk);
                        if(!$result){
                            $error = true;
                            break;
                        } 
                        else{
                            $error = false;
                        }
                    }
                    else{
                        $error = true;
                    }
                }
                
            }
            else{
                $error = true;
            }
            
            $status = $this->db->trans_status();
            if ($status === false || $error == true)
            {
                $this->db->trans_rollback();
                
                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'ERROR ROLLBACK SERVICE RECEIPT';
                $params['module_field_id'] = $trx_code;
                $params['activity'] = ucfirst('Deleted a Service Receipt No ' . $trx_no);
                $params['icon'] = 'fa-exclamation-triangle';
                modules::run('activitylog/log', $params);
                echo json_encode(array('success' => false, 'msg' => "Failed"));
                exit();
            } else
            {
                $this->db->trans_commit();
                
                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'Service Receipt';
                $params['module_field_id'] = $service_receipt_id;
                $params['activity'] = 'Added a new Service Receipt No ' . $trx_no;
                $params['icon'] = 'fa-plus';
                modules::run('activitylog/log', $params); //log activity
    
                Header('Content-Type: application/json; charset=UTF8');
                echo json_encode(array("success" => true, 'msg' => lang('saving_service_receipt_successfully')));
                exit();
            }
        } 
        else {
            $get_data_header = $this->service_receipt_model->get_by_id('tr_service_receipt_hdr',$dataPost['rowID']);
                        
            $result = $this->service_receipt_model->delete_data('tr_service_receipt_hdr',$dataPost['rowID']);
            if($result){
                $result = $this->service_receipt_model->delete_detail_data($get_data_header->trx_no);
                if($result){
                    $data_spk = array(
                        'receipt_no' => '',
                        'user_modified' => $this->session->userdata('user_id'),
                        'date_modified' => date('Y-m-d'),
                        'time_modified' => date('H:i:s')
                    );
                    $this->db->where('deleted',0);
                    $this->db->where('receipt_no',$get_data_header->trx_no);
                    $result = $this->db->update('tr_spk_service_history', $data_spk);                    
                    if(!$result){
                        $error = true;                        
                    }
                    else{
                        $error = false;
                    }
                }
                else{
                    $error = true;
                }
            }
            else{
                $error = true;
            }
            
            if($result){
                $data_service_receipt_hdr = array(
                    'prefix' => $get_data_header->prefix,
                    'year' => $get_data_header->year,
                    'month' => $get_data_header->month,
                    'code' => $get_data_header->code,
                    'trx_no' => $get_data_header->trx_no,
                    'trx_date' => $get_data_header->trx_date,
                    'debtor_rowID' => $dataPost['debtor_rowID'],
                    'remark' => $dataPost['remark'],
                    'total' => str_replace('.','',$dataPost['total']),
                    'user_created' => $get_data_header->user_created,
                    'date_created' => $get_data_header->date_created,
                    'time_created' => $get_data_header->time_created,
                    'user_modified' => $this->session->userdata('user_id'),
                    'date_modified' => date('Y-m-d'),
                    'time_modified' => date('H:i:s')
                );
                
                $result = $this->db->insert('tr_service_receipt_hdr', $data_service_receipt_hdr);
                $service_receipt_id = 0;
                if($result){
                    $service_receipt_id = $this->db->insert_id();
                    $spk_no = $dataPost['spk_no'];
                    $descriptions = $dataPost['descriptions'];
                    $amount = $dataPost['amount'];
                    
                    for($i=0;$i<count($amount);$i++){
                        $data_service_receipt_dtl = array(
                            'trx_no' => $get_data_header->trx_no,
                            'spk_no' => $spk_no[$i],
                            'descriptions' => $descriptions[$i],
                            'amount' => str_replace('.','',$amount[$i]),
                            'user_created' => $get_data_header->user_created,
                            'date_created' => $get_data_header->date_created,
                            'time_created' => $get_data_header->time_created,
                            'user_modified' => $this->session->userdata('user_id'),
                            'date_modified' => date('Y-m-d'),
                            'time_modified' => date('H:i:s')
                        );
                        
                        $result = $this->db->insert('tr_service_receipt_dtl', $data_service_receipt_dtl);
                        if($result){
                            $data_spk = array(
                                'receipt_no' => $get_data_header->trx_no,
                                'user_modified' => $this->session->userdata('user_id'),
                                'date_modified' => date('Y-m-d'),
                                'time_modified' => date('H:i:s')
                            );
                            $this->db->where('deleted',0);
                            $this->db->where('trx_no',$spk_no[$i]);
                            $result = $this->db->update('tr_spk_service_history', $data_spk);
                            if(!$result){
                                $error = true;
                                break;
                            } 
                            else{
                                $error = false;
                            }
                        }
                        else{
                            $error = true;
                        }
                    }
                }
                else{
                    $error = true;
                }
            }
            else{
                $error = true;
            }
            
            $status = $this->db->trans_status();
            if ($status === false || $error == true)
            {
                $this->db->trans_rollback();
                
                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'ERROR ROLLBACK SERVICE RECEIPT';
                $params['module_field_id'] = $dataPost['rowID'];
                $params['activity'] = ucfirst('Deleted a Service Receipt No ' . $get_data_header->trx_no);
                $params['icon'] = 'fa-exclamation-triangle';
                modules::run('activitylog/log', $params);
                echo json_encode(array('success' => false, 'msg' => "Failed"));
                exit();
            } else
            {
                $this->db->trans_commit();
                
                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'Service Receipt';
                $params['module_field_id'] = $dataPost['rowID'];
                $params['activity'] = 'Updated a Service Receipt No ' . $get_data_header->trx_no;
                $params['icon'] = 'fa-plus';
                modules::run('activitylog/log', $params); //log activity
    
                Header('Content-Type: application/json; charset=UTF8');
                echo json_encode(array("success" => true, 'msg' => lang('saving_service_receipt_successfully')));
                exit();
            }

        }
        
        return $status;
    }
    
    function delete_data($id)
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $error = false;
        $this->db->trans_begin();
        
        $get_data_header = $this->service_receipt_model->get_by_id('tr_service_receipt_hdr',$id);
           
        $result = $this->service_receipt_model->delete_data('tr_service_receipt_hdr',$id);
        if($result){
            $result = $this->service_receipt_model->delete_detail_data($get_data_header->trx_no);
            if($result){
                $data_spk = array(
                        'receipt_no' => '',
                        'user_modified' => $this->session->userdata('user_id'),
                        'date_modified' => date('Y-m-d'),
                        'time_modified' => date('H:i:s')
                    );
                $this->db->where('deleted',0);
                $this->db->where('receipt_no',$get_data_header->trx_no);
                $result = $this->db->update('tr_spk_service_history', $data_spk);                    
                if(!$result){
                    $error = true;                        
                }
            }
            else{
                $error = true;
            }
        }
        else{
            $error = true;
        }
        
        $status = $this->db->trans_status();
        if ($status === false || $error == true)
        {
            $this->db->trans_rollback();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'ERROR ROLLBACK SERVICE RECEIPT';
            $params['module_field_id'] = $id;
            $params['activity'] = ucfirst('Deleted a Service Receipt No ' . $get_data_header->trx_no);
            $params['icon'] = 'fa-exclamation-triangle';
            modules::run('activitylog/log', $params);
            
            echo json_encode(array('success' => false, 'msg' => "Failed"));
            exit();
        } else
        {
            $this->db->trans_commit();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Service Receipt';
            $params['module_field_id'] = $id;
            $params['activity'] = ucfirst('Delete a Service Receipt No ' . $get_data_header->trx_no);
            $params['icon'] = 'fa-times';
            modules::run('activitylog/log', $params); //log activity

            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array('success' => true, 'msg' => 'Successfully'));
            exit();
        }
        
        return $status;
    }

}

/* End of file contacts.php */
