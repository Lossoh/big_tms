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
        $start_time = '00:00:00'; //date('H:i:s',strtotime($this->input->post('start_date')));
        $end_time = '23:59:59'; //date('H:i:s',strtotime($this->input->post('end_date')));
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
                $this->pdf_generator->generate($html, 'all cash bank payment and receive pdf',$orientation='Landscape');
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
            
            // Starting Balance
            $year1 = date('Y',strtotime($start_date));
            $first_date = $year1.'-01-01';
            $last_date = date('Y-m-d',strtotime($start_date.' yesterday'));
            $year2 = date('Y',strtotime($last_date));
            if($year1 > $year2){
                $last_date = $first_date;
            }
            
            $data['first_date'] = $first_date;
            $data['last_date'] = $last_date;
            
            $data_cb_trx_balance = $this->cb_payment_receive_model->get_data_cb_trx_hdr_by_date($coa_id,$first_date,$last_date,'00:00:00','23:59:59');
            $data_cb_trx2_balance = $this->cb_payment_receive_model->get_data_cb_trx_hdr_by_date2($coa_id,$first_date,$last_date,'00:00:00','23:59:59');
            
            $total_debit_tunai = 0;
            $total_debit_cg = 0;
            $total_kredit_tunai = 0;
            $total_kredit_cg = 0;
            
            if(count($data_cb_trx_balance) > 0){
                foreach($data_cb_trx_balance as $row){
                    if(($row->status == 1 && $row->reference_release_no == '') || $row->status == null){
                       $amount_kredit_tunai = 0;
                	   $amount_kredit_cg = 0;
                	   $amount_debit_tunai = 0;
                	   $amount_debit_cg = 0;
                        
                       if($row->payment_type == 'P'){
            	           if($row->payment_method != ""){
                        	   if($row->payment_method == 'cash'){
                        	        if($row->cg_amt > 0){
                     	                $amount_kredit_tunai = $row->cg_amt;
                        	        }
                                    else{
                                        $amount_kredit_tunai = $row->cg_amt * -1;
                                    }
                                    $total_kredit_tunai += $amount_kredit_tunai;
                        	   }
                               else{
                                    if($row->cg_amt > 0)
                                        $amount_kredit_cg = $row->cg_amt;
                                    else
                                        $amount_kredit_cg = $row->cg_amt * -1;
                                        
                                    $total_kredit_cg += $amount_kredit_cg;
                               }
                           }
                           else{
                                if($row->cg_amt > 0){
                 	                $amount_kredit_tunai = $row->cg_amt;
                    	        }
                                else{
                                    if($row->cg_amt != ''){
                                        $amount_kredit_tunai = $row->cg_amt * -1;
                                    }
                                    else{
                                        if($row->trx_amt > 0){
                         	                $amount_kredit_tunai = $row->trx_amt;
                            	        }
                                        else{
                                            $amount_kredit_tunai = $row->trx_amt * -1;
                                        }
                                    }
                                }
                                
                                $total_kredit_tunai += $amount_kredit_tunai;
                           }
                	   }
                       else{
                            if($row->payment_method == 'cash'){
                    	        if($row->cg_amt > 0){
                                    $amount_debit_tunai = $row->cg_amt;
                                }
                                else{
                                    if($row->cg_amt != ''){
                                        $amount_debit_tunai = $row->cg_amt * -1;
                                    }
                                    else{
                                        if($row->trx_amt > 0){
                         	                $amount_debit_tunai = $row->trx_amt;
                            	        }
                                        else{
                                            $amount_debit_tunai = $row->trx_amt * -1;
                                        }
                                    }
                                    
                                }
                                                        
                                $total_debit_tunai += $amount_debit_tunai;        	       
                                
                    	    }
                            else{
                                if($row->cg_amt > 0)
                                    $amount_debit_cg = $row->cg_amt;
                                else
                                    $amount_debit_cg = $row->cg_amt * -1;
                                    
                                $total_debit_cg += $amount_debit_cg;
                            }
                                                   
                       }
                       
                    }
                }
            }
            if(count($data_cb_trx2_balance) > 0){
                foreach($data_cb_trx2_balance as $row){
                    $show = true;
                    
                    foreach($data_cb_trx_balance as $row_hdr){
                        if($row->trx_no == $row_hdr->trx_no){
                            $show = false;
                            break;
                        }
                    }
                    
                    if($show == true){
                    
                        if(($row->status == 1 && $row->reference_release_no == '') || $row->status == null){
                           $amount_kredit_tunai = 0;
                    	   $amount_kredit_cg = 0;
                    	   $amount_debit_tunai = 0;
                    	   $amount_debit_cg = 0;
                           
                           if($row->payment_type == 'P'){
                	           if($row->payment_method != ""){
                            	   if($row->payment_method == 'cash'){
                            	        if($row->trx_amt > 0){
                         	                $amount_kredit_tunai = $row->trx_amt;
                            	        }
                                        else{
                                            $amount_kredit_tunai = $row->trx_amt * -1;
                                        }
                                        $total_kredit_tunai += $amount_kredit_tunai;
                            	   }
                                   else{
                                        if($row->trx_amt > 0)
                                            $amount_kredit_cg = $row->trx_amt;
                                        else
                                            $amount_kredit_cg = $row->trx_amt * -1;
                                            
                                        $total_kredit_cg += $amount_kredit_cg;
                                   }
                               }
                               else{
                                    if($row->trx_amt > 0){
                     	                $amount_kredit_tunai = $row->trx_amt;
                        	        }
                                    else{
                                        if($row->trx_amt != ''){
                                            $amount_kredit_tunai = $row->trx_amt * -1;
                                        }
                                        else{
                                            if($row->trx_amt > 0){
                             	                $amount_kredit_tunai = $row->trx_amt;
                                	        }
                                            else{
                                                $amount_kredit_tunai = $row->trx_amt * -1;
                                            }
                                        }
                                    }
                                    
                                    $total_kredit_tunai += $amount_kredit_tunai;
                               }
                    	   }
                           else{
                                if($row->payment_method == 'cash'){
                        	        if($row->trx_amt > 0){
                                        $amount_debit_tunai = $row->trx_amt;
                                    }
                                    else{
                                        if($row->trx_amt != ''){
                                            $amount_debit_tunai = $row->trx_amt * -1;
                                        }
                                        else{
                                            if($row->trx_amt > 0){
                             	                $amount_debit_tunai = $row->trx_amt;
                                	        }
                                            else{
                                                $amount_debit_tunai = $row->trx_amt * -1;
                                            }
                                        }
                                        
                                    }
                                                            
                                    $total_debit_tunai += $amount_debit_tunai;        	       
                                    
                        	    }
                                else{
                                    if($row->trx_amt > 0)
                                        $amount_debit_cg = $row->trx_amt;
                                    else
                                        $amount_debit_cg = $row->trx_amt * -1;
                                        
                                    $total_debit_cg += $amount_debit_cg;
                                }
                                                       
                           }
                           
                        }
                    }
                }
            }
            
            $starting_balance = ($total_debit_tunai + $total_debit_cg) - ($total_kredit_tunai + $total_kredit_cg);
            $data['starting_balance'] = $starting_balance;
            
            // END Starting Balance
            
            if($print_type == 'pdf'){
                $html = $this->load->view('cb_payment_receive_pdf', $data, true);
                $this->pdf_generator->generate($html, 'cash bank payment and receive pdf',$orientation='Landscape');
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
