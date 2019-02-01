<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Planning_order_monitor extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('planning_order_monitor_model');
        $this->load->model('appmodel');        
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('planning_order_monitor') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('planning_order_monitor');
        $this->session->set_userdata('page_header', 'monitoring');
        $this->session->set_userdata('page_detail', 'planning_order_monitor');
        $data['datatables'] = true;
        $data['form'] = true;
        
        $data['vehicles'] = $this->planning_order_monitor_model->get_all_vehicle();
        if($this->session->userdata('date_monitor') != ''){
            $data['date_monitor'] = $this->session->userdata('date_monitor');
        }
        else{
            $data['date_monitor'] = date('Y-m-d');            
        }
        
        if($this->session->userdata('start_date_pog') != '' || $this->session->userdata('end_date_pog') != ''){
            $data['start_date'] = $this->session->userdata('start_date_pog');
            $data['end_date'] = $this->session->userdata('end_date_pog');
        }
        else{
            $data['start_date'] = date('01-m-Y');
            $data['end_date'] = date('t-m-Y');
        }
        
        if($this->session->userdata('categories') != '' || $this->session->userdata('ritase_total') != '' || $this->session->userdata('spk_total') != '' || $this->session->userdata('realization_total') != ''){
            $categories = $this->session->userdata('categories');
            $ritase_total = $this->session->userdata('ritase_total');
            $spk_total = $this->session->userdata('spk_total');
            $realization_total = $this->session->userdata('realization_total');
        }
        else{
            $startTime = strtotime(date('01-m-Y'));
            $endTime = strtotime(date('t-m-Y'));
            $categories = '';
            for($i=$startTime;$i<=$endTime;$i=$i+86400){
                $date_monitor = date('Y-m-d', $i);
                
                $get_ritase_total = $this->planning_order_monitor_model->check_ritase_by_period($date_monitor);
                $get_spk_total = $this->planning_order_monitor_model->check_spk_by_period($date_monitor);
                $get_realization_total = $this->planning_order_monitor_model->check_realization_by_period($date_monitor);
                
                if(count($get_ritase_total) > 0){
                    $ritase = $get_ritase_total->ritase_total;
                }
                else{
                    $ritase = 0;
                }
                
                if(count($get_spk_total) > 0){
                    $spk = $get_spk_total->spk_total;
                }
                else{
                    $spk = 0;
                }
                
                if(count($get_realization_total) > 0){
                    $realization = $get_realization_total->realization_total;                
                }
                else{
                    $realization = 0;
                }
                
                $categories .= "'".date('d-m-Y', $i)."',";
                $ritase_total .= $ritase.",";
                $spk_total .= $spk.",";
                $realization_total .= $realization.",";
                
            }
            
        }
        
        $data['categories'] = substr($categories,0,-1);
        $data['ritase_total'] = substr($ritase_total,0,-1);
        $data['spk_total'] = substr($spk_total,0,-1);
        $data['realization_total'] = substr($realization_total,0,-1);
        
        $this->template->set_layout('users')->build('planning_order_monitors', isset($data) ? $data : null);
    }
    
    function set_date_monitor(){
        $this->session->set_userdata('date_monitor', date('Y-m-d',strtotime($this->input->post('date_monitor'))));
        
        redirect(base_url().'planning_order_monitor');
    }
    
    function view_graph(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        
        $startTime = strtotime($this->input->post('start_date'));
        $endTime = strtotime($this->input->post('end_date'));
        $categories = "";
        $ritase_total = "";
        $spk_total = "";
        $realization_total = "";
        
        // Loop between timestamps, 24 hours at a time
        for($i=$startTime;$i<=$endTime;$i=$i+86400){
            $date_monitor = date('Y-m-d', $i);
            
            $get_ritase_total = $this->planning_order_monitor_model->check_ritase_by_period($date_monitor);
            $get_spk_total = $this->planning_order_monitor_model->check_spk_by_period($date_monitor);
            $get_realization_total = $this->planning_order_monitor_model->check_realization_by_period($date_monitor);
            
            if(count($get_ritase_total) > 0){
                $ritase = $get_ritase_total->ritase_total;
            }
            else{
                $ritase = 0;
            }
            
            if(count($get_spk_total) > 0){
                $spk = $get_spk_total->spk_total;
            }
            else{
                $spk = 0;
            }
            
            if(count($get_realization_total) > 0){
                $realization = $get_realization_total->realization_total;                
            }
            else{
                $realization = 0;
            }
            
            $categories .= "'".date('d-m-Y', $i)."',";
            $ritase_total .= $ritase.",";
            $spk_total .= $spk.",";
            $realization_total .= $realization.",";
            
        }
        
        $this->session->set_userdata('start_date_pog',$this->input->post('start_date'));
        $this->session->set_userdata('end_date_pog',$this->input->post('end_date'));
        $this->session->set_userdata('categories',$categories);
        $this->session->set_userdata('ritase_total',$ritase_total);
        $this->session->set_userdata('spk_total',$spk_total);
        $this->session->set_userdata('realization_total',$realization_total);

        redirect(base_url().'planning_order_monitor');
        
    }
    
}

/* End of file contacts.php */
