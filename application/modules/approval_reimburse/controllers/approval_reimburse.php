<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Approval_reimburse extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('approval_reimburse_model');
        $this->load->library('pdf_generator');
        
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('approval_reimburse') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('approval_reimburse');
        $this->session->set_userdata('page_header', 'transaction');
        $this->session->set_userdata('page_detail', 'approval_reimburse');
        $data['datatables'] = true;
        $data['form'] = true;
        
        if($this->session->userdata('start_date_ar') == '' ){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_ar')));
        }

        if($this->session->userdata('end_date_ar') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_ar')));
        }

        // if($this->session->userdata('start_date_ar') == '' && $this->session->userdata('end_date_ar') == ''){
        //     $start_date = date("Y-m-d",strtotime("yesterday"));
        //     $end_date = date("Y-m-d");
        // }
        // else{
        //     $start_date = $this->session->userdata('start_date_ar');
        //     $end_date = $this->session->userdata('end_date_ar');
        // }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
            
        
        $this->template->set_layout('users')->build('approval_reimburses', isset($data) ? $data : null);
    }
    
    function set_filter(){
       $this->session->set_userdata('start_date_ar',date("Y-m-d",strtotime($this->input->post('start_date'))));
       $this->session->set_userdata('end_date_ar',date("Y-m-d",strtotime($this->input->post('end_date'))));    
       
       redirect(base_url().'approval_reimburse');
    }
    
    function check_data_reimburse($reimburse_no){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $get_data = $this->approval_reimburse_model->get_data_reimburse_by_reimburse_no($reimburse_no);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode(array('count_data' => count($get_data)));
        exit;
    }
    
    function save_approval(){
        $dataPost = $this->input->post();
        //echo "<pre>"; print_r($dataPost); echo "</pre>"; exit();
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $error = false;
        $this->db->trans_begin();

        $data_approval_reimburse = array(
            'reimburse_no' => $dataPost['reimburse_no'],
            'reimburse_date' => date('Y-m-d',strtotime($dataPost['reimburse_date'])),
            'reimburse_total' => str_replace('.','',$dataPost['reimburse_total']),
            'user_approved' => $this->session->userdata('user_id'),
            'date_approved' => date('Y-m-d'),
            'time_approved' => date('H:i:s'),
            'user_created' => $this->session->userdata('user_id'),
            'date_created' => date('Y-m-d'),
            'time_created' => date('H:i:s')
        );
        
        $result = $this->db->insert('tr_approval_reimburse', $data_approval_reimburse);
        $insert_id = 0;
        if($result){
            $insert_id = $this->db->insert_id();            
        }
        else{
            $error = true;
        }
        
        Header('Content-Type: application/json; charset=UTF8');
        $status = $this->db->trans_status();
        if ($status === false || $error == true){
            $this->db->trans_rollback();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
			$params['module'] = 'ERROR ROLLBACK Invoice';
			$params['module_field_id'] = $insert_id;
			$params['activity'] = ucfirst('Deleted a Approval Reimburse No '.$dataPost['reimburse_no']);
			$params['icon'] = 'fa-exclamation-triangle';
			modules::run('activitylog/log',$params);
            
            echo json_encode(array('success' => false, 'msg' => "Failed Data RollBack"));
            exit();
        }
        else{
            $this->db->trans_commit();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Approval Reimburse';
            $params['module_field_id'] = $insert_id;
            $params['activity'] = ucfirst('Added a new Approval Reimburse No ' . $dataPost['reimburse_no']);
            $params['icon'] = 'fa-plus';
            modules::run('activitylog/log', $params); //log activity

            echo json_encode(array("success" => true, 'msg' => 'Approval succesfully'));
            exit();
        }
        
    }
    
    function save_disapproval(){
        $dataPost = $this->input->post();
        //echo "<pre>"; print_r($dataPost); echo "</pre>"; exit();
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $error = false;
        $this->db->trans_begin();

        $data_disapproval_reimburse = array(
            'deleted' => 1,
            'user_deleted' => $this->session->userdata('user_id'),
            'date_deleted' => date('Y-m-d'),
            'time_deleted' => date('H:i:s')
        );
        $this->db->where('deleted',0);
        $this->db->where('reimburse_no',$dataPost['reimburse_no']);
        
        $result = $this->db->update('tr_approval_reimburse', $data_disapproval_reimburse);
        if(!$result){
            $error = true;
        }
        
        Header('Content-Type: application/json; charset=UTF8');
        $status = $this->db->trans_status();
        if ($status === false || $error == true){
            $this->db->trans_rollback();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
			$params['module'] = 'ERROR ROLLBACK Invoice';
			$params['module_field_id'] = 0;
			$params['activity'] = ucfirst('Deleted a Disapproval Reimburse No '.$dataPost['reimburse_no']);
			$params['icon'] = 'fa-exclamation-triangle';
			modules::run('activitylog/log',$params);
            
            echo json_encode(array('success' => false, 'msg' => "Failed Data RollBack"));
            exit();
        }
        else{
            $this->db->trans_commit();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Approval Reimburse';
            $params['module_field_id'] = 0;
            $params['activity'] = ucfirst('Disapproval Reimburse No ' . $dataPost['reimburse_no']);
            $params['icon'] = 'fa-times';
            modules::run('activitylog/log', $params); //log activity

            echo json_encode(array("success" => true, 'msg' => 'Disapproval succesfully'));
            exit();
        }
        
    }
    
    function pdf()
    {
        if($this->session->userdata('start_date_ar') == '' ){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_ar')));
        }

        if($this->session->userdata('end_date_ar') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_ar')));
        }

        // if($this->session->userdata('start_date_ar') == '' && $this->session->userdata('end_date_ar') == ''){
        //     $start_date = date("Y-m-d",strtotime("yesterday"));
        //     $end_date = date("Y-m-d");
        // }
        // else{
        //     $start_date = $this->session->userdata('start_date_ar');
        //     $end_date = $this->session->userdata('end_date_ar');
        // }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['periode'] = date("d F Y",strtotime($start_date)).' - '.date("d F Y",strtotime($end_date));
        
        $data['approvals'] = $this->approval_reimburse_model->get_data_approval($start_date,$end_date);
           
        $html = $this->load->view('approval_reimburse_pdf', $data, true);
        $this->pdf_generator->generate($html, 'Approval Reimburse',$orientation='Potrait');
    }
    
    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=approval_reimburses.xls");

        if($this->session->userdata('start_date_ar') == '' ){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_ar')));
        }

        if($this->session->userdata('end_date_ar') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_ar')));
        }
        // if($this->session->userdata('start_date_ar') == '' && $this->session->userdata('end_date_ar') == ''){
        //     $start_date = date("Y-m-d",strtotime("yesterday"));
        //     $end_date = date("Y-m-d");
        // }
        // else{
        //     $start_date = $this->session->userdata('start_date_ar');
        //     $end_date = $this->session->userdata('end_date_ar');
        // }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['periode'] = date("d F Y",strtotime($start_date)).' - '.date("d F Y",strtotime($end_date));
        
        $data['approvals'] = $this->approval_reimburse_model->get_data_approval($start_date,$end_date);
         
        $this->load->view("approval_reimburse_pdf", $data);
    }
    
}

/* End of file contacts.php */
