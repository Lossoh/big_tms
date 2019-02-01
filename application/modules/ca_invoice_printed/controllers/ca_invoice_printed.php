<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Ca_invoice_printed extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('ca_invoice_printed_model');
        $this->load->model('finances/finances_model');
        $this->load->library('pdf_generator');
        
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('ca_invoice_printed') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('ca_invoice_printed');
        $this->session->set_userdata('page_header', 'monitoring');
        $this->session->set_userdata('page_detail', 'ca_invoice_printed');
        $data['datatables'] = true;
        $data['form'] = true;
        
        if($this->session->userdata('start_date') == '' && $this->session->userdata('end_date') == ''){
            $start_date = date("Y-m-d",strtotime("yesterday"));
            $end_date = date("Y-m-d");
        }
        else{
            $start_date = $this->session->userdata('start_date');
            $end_date = $this->session->userdata('end_date');
        }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
            
        $data['ca_invoice_printeds'] = $this->ca_invoice_printed_model->get_all_records_list($start_date,$end_date);
             
        $this->template->set_layout('users')->build('ca_invoice_printeds', isset($data) ? $data : null);
    }
    
    function set_filter(){
       $this->session->set_userdata('start_date',date("Y-m-d",strtotime($this->input->post('start_date'))));
       $this->session->set_userdata('end_date',date("Y-m-d",strtotime($this->input->post('end_date'))));    
       
       redirect(base_url().'ca_invoice_printed');
    }
    
    function delete_activity(){
        $row_id = $this->input->post('rowID');
        $remark = $this->input->post('remark');
        $result = false;
        
        $data = array(
            'activity_rowID' => $row_id,
            'remark' => $remark
        );
        $result = $this->db->insert('activities_cancel_printed',$data);
        if($result){        
            $this->db->set('deleted', 1);
            $this->db->where('activity_id', $row_id);
            $result = $this->db->update('activities');
            
            if($result){
                $params['user_rowID'] = $this->tank_auth->get_user_id();
        		$params['module'] = 'Activity';
        		$params['module_field_id'] = $row_id;
        		$params['activity'] = ucfirst('Deleted Activity with ID '.$row_id);
        		$params['icon'] = 'fa-times';
        		modules::run('activitylog/log',$params); //log activity	
            
                $info = 'Delete activity successfully';
                echo json_encode(array('success' => true, 'msg' => $info));
            }
            else{
                $info = 'Error deleting activity';
                echo json_encode(array('success' => false, 'msg' => $info));
            }    
        }
        else{
            $info = 'Error deleting activity';
            echo json_encode(array('success' => false, 'msg' => $info));
        }    
         
        exit();
    }
    
}

/* End of file contacts.php */
