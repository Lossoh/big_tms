<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class invoice_model extends CI_Model
{
    
    function simpan_data_header_invoice($sa_spec_prefix,$alloc_code,$alloc_no,$sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$dataPost){
        
        if($dataPost['invoice_no'] == ''){
            /*
            if(date('Y-m-d',strtotime($dataPost['invoice_date'])) != date('Y-m-d')){
                $invoice_date = date('Y-m-d');
            }
            else{
                $invoice_date = date('Y-m-d',strtotime($dataPost['invoice_date']));
            }
            */
                
            if(isset($dataPost['cekDa'])){
                $cekDa = 1;
                $base_amt = str_replace('.','',$dataPost['TotalBase']);
                $tax_amt = 0;
                $total_amt = str_replace('.','',$dataPost['TotalBase']);
                $bal_amt = str_replace('.','',$dataPost['TotalBase']);
            }
            else{
                $cekDa = 0;
                $base_amt = str_replace('.','',$dataPost['TotalBase']);
                $tax_amt = str_replace('.','',$dataPost['TotalVat']);
                $total_amt = str_replace('.','',$dataPost['GrandTotal']);
                $bal_amt = str_replace('.','',$dataPost['GrandTotal']);
            }

            $invoice_date = date('Y-m-d',strtotime($dataPost['invoice_date']));
            
            $year = date('Y',strtotime($invoice_date));
            $month = date('m',strtotime($invoice_date));
    
            $data= array(
                'prefix' =>$sa_spec_prefix,
                'year'   =>$year,
                'month'  =>$month,
                'code'   =>$alloc_code,
                'trx_no' =>$alloc_no,
                'trx_date'=>$invoice_date,
                'debtor_rowID' =>$dataPost['debtor_id'],
                'base_amt'     =>$base_amt, 
                'tax_amt'      =>$tax_amt,
                'wth_amt'      =>0,//str_replace('.','',$dataPost['TotalWth']),
                'total_amt'    =>$total_amt,
                'alloc_amt'    =>0,
                'bal_amt'      =>$bal_amt,
                'invoice_type' =>$dataPost['invoice_type'],
                'descs'        => ucfirst($dataPost['invoice_remark_header']),
                'wholesale'    => (isset($dataPost['wholesale'])) ? $dataPost['wholesale'] : 0,
                'tax'          => $cekDa,
                'tr_jo_trx_hdr_year' => (isset($dataPost['jo_year'])) ? $dataPost['jo_year'] : 0,
                'tr_jo_trx_hdr_month' => (isset($dataPost['jo_month'])) ? $dataPost['jo_month'] : 0,
                'tr_jo_trx_hdr_code'  => (isset($dataPost['jo_code'])) ? $dataPost['jo_code'] : 0,
                'jo_no'         =>$dataPost['jo_no'],
                'gl_trx_hdr_prefix' =>$sa_spec_prefix_gl,
                'gl_trx_hdr_year' => $year,
                'gl_trx_hdr_month' => $month,
                'gl_trx_hdr_code' =>$new_gl_coa_code,
                'gl_trx_hdr_trx_no' =>$gl_coa_no,
                'user_created' =>$this->session->userdata('user_rowID'),
                'date_created' =>$invoice_date,
                'time_created' =>date('H:i:s')
            );
    	    $result = $this->db->insert('ar_trx_hdr', $data);
        }
        else{
                
            if(isset($dataPost['cekDa'])){
                $cekDa = 1;
                $base_amt = str_replace('.','',$dataPost['TotalBaseTmp']);
                $tax_amt = 0;
                $total_amt = str_replace('.','',$dataPost['TotalBaseTmp']);
                $bal_amt = str_replace('.','',$dataPost['TotalBaseTmp']);
            }
            else{
                $cekDa = 0;
                $base_amt = str_replace('.','',$dataPost['TotalBaseTmp']);
                $tax_amt = ($base_amt * 10) / 100;
                $total_amt = $base_amt + $tax_amt;
                $bal_amt = $base_amt + $tax_amt;
            }

            $invoice_date = date('Y-m-d',strtotime($dataPost['invoice_date']));
            $year = date('Y',strtotime($invoice_date));
            $month = date('m',strtotime($invoice_date));

            $data= array(
                'prefix' =>$sa_spec_prefix,
                'year'   =>$year,
                'month'  =>$month,
                'code'   =>$alloc_code,
                'trx_no' =>$alloc_no,
                'trx_date'=>$invoice_date,
                'debtor_rowID' =>$dataPost['debtor_id'],
                'base_amt'     =>$base_amt, 
                'tax_amt'      =>$tax_amt,
                'wth_amt'      =>0,//str_replace('.','',$dataPost['TotalWth']),
                'total_amt'    =>$total_amt,
                'alloc_amt'    =>0,
                'bal_amt'      =>$bal_amt,
                'invoice_type' =>$dataPost['invoice_type'],
                'descs'        => ucfirst($dataPost['invoice_remark_header']),
                'wholesale'    => (isset($dataPost['wholesale'])) ? $dataPost['wholesale'] : 0,
                'tax'          => $cekDa,
                'tr_jo_trx_hdr_year' => (isset($dataPost['jo_year'])) ? $dataPost['jo_year'] : 0,
                'tr_jo_trx_hdr_month' => (isset($dataPost['jo_month'])) ? $dataPost['jo_month'] : 0,
                'tr_jo_trx_hdr_code'  => (isset($dataPost['jo_code'])) ? $dataPost['jo_code'] : 0,
                'jo_no'         =>$dataPost['jo_no'],
                'gl_trx_hdr_prefix' =>$sa_spec_prefix_gl,
                'gl_trx_hdr_year' => $year,
                'gl_trx_hdr_month' => $month,
                'gl_trx_hdr_code' =>$new_gl_coa_code,
                'gl_trx_hdr_trx_no' =>$gl_coa_no,
                'received_date' => date('Y-m-d',strtotime($dataPost['received_date_val'])),
                'received_no' => $dataPost['received_no_val'],
                'due_date' => date('Y-m-d',strtotime($dataPost['due_date_val'])),
                'user_created'=>$dataPost['user_created'],
                'date_created'=>$dataPost['date_created'],
                'time_created'=>$dataPost['time_created'],
				'user_modified'=>$this->session->userdata('user_rowID'),
				'date_modified'=>date('Y-m-d'),
				'time_modified'=>date('H:i:s')
            );
    	    $result = $this->db->insert('ar_trx_hdr', $data);
        }        
        
        
         if ($result){
            return true;
         }else{
            return false;
         }
    }
    
    
    function simpan_data_detail_invoice($sa_spec_prefix,$alloc_code,$alloc_no,$x,$dataPost,$detInvo=array()){
        
        if($dataPost['invoice_no'] == ''){
            /*
            if(date('Y-m-d',strtotime($dataPost['invoice_date'])) != date('Y-m-d')){
                $invoice_date = date('Y-m-d');
            }
            else{
                $invoice_date = date('Y-m-d',strtotime($dataPost['invoice_date']));
            }
            */
            
            $invoice_date = date('Y-m-d',strtotime($dataPost['invoice_date']));
            
            $year = date('Y',strtotime($invoice_date));
            $month = date('m',strtotime($invoice_date));
    
            $data = array(
                'ar_trx_hdr_prefix' =>$sa_spec_prefix,
                'ar_trx_hdr_year'   =>$year,
                'ar_trx_hdr_month'  =>$month,
                'ar_trx_hdr_code'   =>$alloc_code,
                'ar_trx_no'         =>$alloc_no,
                'row_no'            =>$x,
                'income_rowID'      =>$detInvo['income_rowId'],
                'input_amt'         =>str_replace('.','',$detInvo['amount_invo']),
                'base_amt'          =>str_replace('.','',$detInvo['amount_base']),
                'include_vat'       =>(isset($detInvo['cekTax'])) ? $detInvo['cekTax'] : 0,  
                'tax_amt'           =>str_replace('.','',$detInvo['amount_vat']),
                'wth_rate_rowID'    =>(isset($detInvo['cmbWth'])) ? $detInvo['cmbWth'] : 0,
                'wth_amt'           =>0,//str_replace('.','',$detInvo['amountWth']),
                'total_amt'         =>str_replace('.','',$detInvo['SubTotal']),
                'descs'             =>strtoupper($detInvo['invoice_remark']),
                'user_created'      =>$this->session->userdata('user_rowID'),
                'date_created'      =>$invoice_date,
                'time_created'      =>date('H:i:s')
            );
            
            $result=$this->db->insert('ar_trx_dtl', $data);
        }
        else{
            $invoice_date = date('Y-m-d',strtotime($dataPost['invoice_date']));
            $year = date('Y',strtotime($invoice_date));
            $month = date('m',strtotime($invoice_date));
    
            $data = array(
                'ar_trx_hdr_prefix' =>$sa_spec_prefix,
                'ar_trx_hdr_year'   =>$year,
                'ar_trx_hdr_month'  =>$month,
                'ar_trx_hdr_code'   =>$alloc_code,
                'ar_trx_no'         =>$alloc_no,
                'row_no'            =>$x,
                'income_rowID'      =>$detInvo['income_rowId'],
                'input_amt'         =>str_replace('.','',$detInvo['amount_invo']),
                'base_amt'          =>str_replace('.','',$detInvo['amount_base']),
                'include_vat'       =>(isset($detInvo['cekTax'])) ? $detInvo['cekTax'] : 0,  
                'tax_amt'           =>str_replace('.','',$detInvo['amount_vat']),
                'wth_rate_rowID'    =>(isset($detInvo['cmbWth'])) ? $detInvo['cmbWth'] : 0,
                'wth_amt'           =>0,//str_replace('.','',$detInvo['amountWth']),
                'total_amt'         =>str_replace('.','',$detInvo['SubTotal']),
                'descs'             =>strtoupper($detInvo['invoice_remark']),
                'user_created'      =>$dataPost['user_created'],
                'date_created'      =>$dataPost['date_created'],
                'time_created'      =>$dataPost['time_created'],
				'user_modified'     =>$this->session->userdata('user_rowID'),
				'date_modified'     =>date('Y-m-d'),
				'time_modified'     =>date('H:i:s')
            );
            
            $result=$this->db->insert('ar_trx_dtl', $data);
        }        
        
        
        if ($result){
            return true;
        }
        else{
            return false;
        }
    }
    
    function simpan_data_detail_job_order($trx_no,$do_id,$price){
        $data = array(
            'trx_no' => $trx_no,
            'do_id'   => $do_id,
            'price'   => $price
        );
        
        $result=$this->db->insert('ar_trx_dtl_do', $data);
        if ($result){
            return true;
        }
        else{
            return false;
        }
    }

    function simpan_data_detail_job_order_ap($trx_no,$ap_dtl_id,$price){
        $data = array(
            'trx_no' => $trx_no,
            'ap_id'   => $ap_dtl_id,
            'price'   => $price
        );
        
        $result=$this->db->insert('ar_trx_dtl_do', $data);
        if ($result){
            return true;
        }
        else{
            return false;
        }
    }
    
    function simpan_data_detail_do($sa_spec_prefix, $alloc_code, $alloc_no, $dataPost, $detDO = array())
    {
        
        if($dataPost['invoice_no'] == ''){
            /*
            if(date('Y-m-d',strtotime($dataPost['invoice_date'])) != date('Y-m-d')){
                $invoice_date = date('Y-m-d');
            }
            else{
                $invoice_date = date('Y-m-d',strtotime($dataPost['invoice_date']));
            }
            */
            
            $invoice_date = date('Y-m-d',strtotime($dataPost['invoice_date']));
            
            $year = date('Y',strtotime($invoice_date));
            $month = date('m',strtotime($invoice_date));
    
            $data = array(
                'prefix' => $sa_spec_prefix,
                'year' => $year,
                'month' => $month,
                'code' => $alloc_code,
                'trx_no' => $alloc_no,
                'jo_no' => $detDO['do_jo_no'],
                'tr_jo_trx_hdr_year' => $detDO['jo_year'],
                'tr_jo_trx_hdr_month' => $detDO['jo_month'],
                'tr_jo_trx_hdr_code' => $detDO['jo_code'],
                'do_no' => $detDO['do_no'],
                'count_container' => empty($detDO['ContType']) ? 0 : 1,
                'container_size' => empty($detDO['ContType']) ? '' : $detDO['ContType'],
                'container_no' => empty($detDO['container_no']) ? '' : $detDO['container_no'],
                'police_no' => strtoupper($detDO['police_no']),
                'do_date' => date('Y-m-d', strtotime($detDO['do_date'])),
                'deliver_date' => date('Y-m-d', strtotime($detDO['do_date'])),
                'deliver_weight' => str_replace('.','',$detDO['do_weight']),
                'received_date' => date('Y-m-d', strtotime($detDO['received_date'])),
                'received_weight' => str_replace('.','',$detDO['received_weight']),
                'amount'   =>str_replace('.','',$detDO['amount']),
                'status' => 0,
                'user_created' => $this->session->userdata('user_rowID'),
                'date_created' => $invoice_date,
                'time_created' => date('H:i:s'));
            $result = $this->db->insert('ar_trx_dtl_do_manual', $data);
        }
        else{
            $invoice_date = date('Y-m-d',strtotime($dataPost['invoice_date']));
            $year = date('Y',strtotime($invoice_date));
            $month = date('m',strtotime($invoice_date));
    
            $data = array(
                'prefix' => $sa_spec_prefix,
                'year' => $year,
                'month' => $month,
                'code' => $alloc_code,
                'trx_no' => $alloc_no,
                'jo_no' => $detDO['do_jo_no'],
                'tr_jo_trx_hdr_year' => $detDO['jo_year'],
                'tr_jo_trx_hdr_month' => $detDO['jo_month'],
                'tr_jo_trx_hdr_code' => $detDO['jo_code'],
                'do_no' => $detDO['do_no'],
                'count_container' => empty($detDO['ContType']) ? 0 : 1,
                'container_size' => empty($detDO['ContType']) ? '' : $detDO['ContType'],
                'container_no' => empty($detDO['container_no']) ? '' : $detDO['container_no'],
                'police_no' => strtoupper($detDO['police_no']),
                'do_date' => date('Y-m-d', strtotime($detDO['do_date'])),
                'deliver_date' => date('Y-m-d', strtotime($detDO['do_date'])),
                'deliver_weight' => str_replace('.','',$detDO['do_weight']),
                'received_date' => date('Y-m-d', strtotime($detDO['received_date'])),
                'received_weight' => str_replace('.','',$detDO['received_weight']),
                'amount'   =>str_replace('.','',$detDO['amount']),
                'status' => 0,
                'user_created'      =>$dataPost['user_created'],
                'date_created'      =>$dataPost['date_created'],
                'time_created'      =>$dataPost['time_created'],
				'user_modified'     =>$this->session->userdata('user_rowID'),
				'date_modified'     =>date('Y-m-d'),
				'time_modified'     =>date('H:i:s')
            );
            $result = $this->db->insert('ar_trx_dtl_do_manual', $data);
        }        
        
        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }
    
    function update_data_jo($alloc_no,$alloc_date,$jo_no){
        $this->db->set('invoice_no',$alloc_no);
        $this->db->set('invoice_date',$alloc_date);
        $this->db->set('user_modified',$this->session->userdata('user_rowID'));
        $this->db->set('date_modified',date('Y-m-d'));
        $this->db->set('time_modified',date('H:i:s'));
        $this->db->where('deleted',0);
        $this->db->where('jo_no',$jo_no);
        $result=$this->db->update('tr_jo_trx_hdr');
        
        if ($result){
            return true;
        }else{
            return false;
        } 
    } 
    
    function update_data_ap_detail_invoice($alloc_no,$alloc_date,$ap_dtl_id){
        $this->db->set('invoice_no',$alloc_no);
        $this->db->set('invoice_date',$alloc_date);
        $this->db->set('user_modified',$this->session->userdata('user_rowID'));
        $this->db->set('date_modified',date('Y-m-d'));
        $this->db->set('time_modified',date('H:i:s'));
        $this->db->where('rowID',$ap_dtl_id);
        $result=$this->db->update('ap_trx_dtl_do');
        
        if ($result){
            return true;
        }else{
            return false;
        } 
    } 
    
    function update_data_ap_by_invoice_jo($alloc_no,$jo_ap_no){
        $this->db->set('invoice_no','');
        $this->db->set('invoice_date','');
        $this->db->set('user_modified',$this->session->userdata('user_rowID'));
        $this->db->set('date_modified',date('Y-m-d'));
        $this->db->set('time_modified',date('H:i:s'));
        $this->db->where('invoice_no',$alloc_no);
        $this->db->where('jo_no',$jo_ap_no);
        $result=$this->db->update('ap_trx_dtl_do');
        
        if ($result){
            return true;
        }else{
            return false;
        } 
    } 
    
    function update_data_do_detail_invoice($alloc_no,$alloc_date,$do_id){
        $this->db->set('invoice_no',$alloc_no);
        $this->db->set('invoice_date',$alloc_date);
        $this->db->set('user_modified',$this->session->userdata('user_rowID'));
        $this->db->set('date_modified',date('Y-m-d'));
        $this->db->set('time_modified',date('H:i:s'));
        $this->db->where('rowID',$do_id);
        $result=$this->db->update('tr_do_trx');
        
        if ($result){
            return true;
        }else{
            return false;
        } 
    } 
    
    function update_data_do_by_invoice_jo($alloc_no,$jo_no){
        $this->db->set('invoice_no','');
        $this->db->set('invoice_date','');
        $this->db->set('user_modified',$this->session->userdata('user_rowID'));
        $this->db->set('date_modified',date('Y-m-d'));
        $this->db->set('time_modified',date('H:i:s'));
        $this->db->where('invoice_no',$alloc_no);
        $this->db->where('jo_no',$jo_no);
        $result=$this->db->update('tr_do_trx');
        
        if ($result){
            return true;
        }else{
            return false;
        } 
    } 
    
    function update_data_jo_by_invoice($invoice_no){
        $this->db->set('invoice_no','');
        $this->db->set('user_modified',$this->session->userdata('user_rowID'));
        $this->db->set('date_modified',date('Y-m-d'));
        $this->db->set('time_modified',date('H:i:s'));
        $this->db->where('invoice_no',$invoice_no);
        $this->db->where('deleted',0);
        $result=$this->db->update('tr_jo_trx_hdr');
        
        if ($result){
            return true;
        }else{
            return false;
        } 
    } 
    
    function simpanGlHeader($sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$sa_spec_prefix,$alloc_code,$alloc_no,$dataPost){
        
        if($dataPost['invoice_no'] == ''){
            /*
            if(date('Y-m-d',strtotime($dataPost['invoice_date'])) != date('Y-m-d')){
                $invoice_date = date('Y-m-d');
            }
            else{
                $invoice_date = date('Y-m-d',strtotime($dataPost['invoice_date']));
            }
            */
            
            $invoice_date = date('Y-m-d',strtotime($dataPost['invoice_date']));
            
            $year = date('Y',strtotime($invoice_date));
            $month = date('m',strtotime($invoice_date));
    
    	    $data = array(
                'prefix' =>$sa_spec_prefix_gl,
                'year'   =>$year,
                'month'  =>$month,
                'code'   =>$new_gl_coa_code,
                'journal_no' =>$gl_coa_no,
                'journal_date' => $invoice_date,
                'journal_type' => 'invoice',
                'descs'        => ucfirst($dataPost['invoice_remark_header']),
                'trx_amt' => 0 + str_replace('.','',$dataPost['GrandTotal']),//str_replace('.','',$dataPost['TotalWth']) + str_replace('.','',$dataPost['GrandTotal']),
                'ref_prefix' => $sa_spec_prefix,
                'ref_year'   =>$year,
                'ref_month'  =>$month,
                'ref_code'   =>$alloc_code,
                'ref_no'     =>$alloc_no,
                'ref_date'   =>$invoice_date,
                'user_created' =>$this->session->userdata('user_rowID'),
                'date_created' =>$invoice_date,
                'time_created' =>date('H:i:s')
            );  
            $result=$this->db->insert('gl_trx_hdr',$data);
        }
        else{
            $invoice_date = date('Y-m-d',strtotime($dataPost['invoice_date']));
            $year = date('Y',strtotime($invoice_date));
            $month = date('m',strtotime($invoice_date));
    
    	    $data = array(
                'prefix' =>$sa_spec_prefix_gl,
                'year'   =>$year,
                'month'  =>$month,
                'code'   =>$new_gl_coa_code,
                'journal_no' =>$gl_coa_no,
                'journal_date' => $invoice_date,
                'journal_type' => 'invoice',
                'descs'        => ucfirst($dataPost['invoice_remark_header']),
                'trx_amt' => 0 + str_replace('.','',$dataPost['GrandTotal']),//str_replace('.','',$dataPost['TotalWth']) + str_replace('.','',$dataPost['GrandTotal']),
                'ref_prefix' => $sa_spec_prefix,
                'ref_year'   =>$year,
                'ref_month'  =>$month,
                'ref_code'   =>$alloc_code,
                'ref_no'     =>$alloc_no,
                'ref_date'   =>$invoice_date,
                'user_created'      =>$dataPost['user_created'],
                'date_created'      =>$dataPost['date_created'],
                'time_created'      =>$dataPost['time_created'],
				'user_modified'     =>$this->session->userdata('user_rowID'),
				'date_modified'     =>date('Y-m-d'),
				'time_modified'     =>date('H:i:s')
            );  
            $result=$this->db->insert('gl_trx_hdr',$data);
        }        
        
         if ($result){
            return true;
         }else{
            return false;
         } 
    }
    
    function simpanGlDetailPiutang($sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$sa_spec_prefix,$alloc_code,$alloc_no,$coa_receivable_RowID,$dataPost){
        
        if($dataPost['invoice_no'] == ''){
            /*
            if(date('Y-m-d',strtotime($dataPost['invoice_date'])) != date('Y-m-d')){
                $invoice_date = date('Y-m-d');
            }
            else{
                $invoice_date = date('Y-m-d',strtotime($dataPost['invoice_date']));
            }
            */
            
            $invoice_date = date('Y-m-d',strtotime($dataPost['invoice_date']));
            
            $year = date('Y',strtotime($invoice_date));
            $month = date('m',strtotime($invoice_date));
    
            $data = array(
                'gl_trx_hdr_prefix' =>$sa_spec_prefix_gl,
                'gl_trx_hdr_year'   =>$year,
                'gl_trx_hdr_month'  =>$month,
                'gl_trx_hdr_code'   =>$new_gl_coa_code,
                'row_no'            =>1,
                'gl_trx_hdr_journal_no' =>$gl_coa_no,
                'gl_trx_hdr_journal_date' =>$invoice_date,
                'coa_rowID'         =>$coa_receivable_RowID,
                'trx_amt'           => str_replace('.','',$dataPost['GrandTotal']),
                'descs'             => '',
                'dep_rowID'         => $this->session->userdata('dep_rowID'),
                'debtor_creditor_rowID' =>$dataPost['debtor_id'],
                'gl_trx_hdr_ref_prefix' =>$sa_spec_prefix,
                'gl_trx_hdr_ref_year' =>$year,
                'gl_trx_hdr_ref_month' =>$month,
                'gl_trx_hdr_ref_code'  =>$alloc_code,
                'gl_trx_hdr_ref_no'    =>$alloc_no,
                'gl_trx_hdr_ref_date'  =>$invoice_date,
                'modul'                =>'AR',
                'user_created'         =>$this->session->userdata('user_rowID'),
                'date_created'         =>$invoice_date,
                'time_created'         =>date('H:i:s')
                
            );
            $result=$this->db->insert('gl_trx_dtl',$data);
        }
        else{
            $invoice_date = date('Y-m-d',strtotime($dataPost['invoice_date']));
            $year = date('Y',strtotime($invoice_date));
            $month = date('m',strtotime($invoice_date));
    
            $data = array(
                'gl_trx_hdr_prefix' =>$sa_spec_prefix_gl,
                'gl_trx_hdr_year'   =>$year,
                'gl_trx_hdr_month'  =>$month,
                'gl_trx_hdr_code'   =>$new_gl_coa_code,
                'row_no'            =>1,
                'gl_trx_hdr_journal_no' =>$gl_coa_no,
                'gl_trx_hdr_journal_date' =>$invoice_date,
                'coa_rowID'         =>$coa_receivable_RowID,
                'trx_amt'           => str_replace('.','',$dataPost['GrandTotal']),
                'descs'             => '',
                'dep_rowID'         => $this->session->userdata('dep_rowID'),
                'debtor_creditor_rowID' =>$dataPost['debtor_id'],
                'gl_trx_hdr_ref_prefix' =>$sa_spec_prefix,
                'gl_trx_hdr_ref_year' =>$year,
                'gl_trx_hdr_ref_month' =>$month,
                'gl_trx_hdr_ref_code'  =>$alloc_code,
                'gl_trx_hdr_ref_no'    =>$alloc_no,
                'gl_trx_hdr_ref_date'  =>$invoice_date,
                'modul'                =>'AR',
                'user_created'      =>$dataPost['user_created'],
                'date_created'      =>$dataPost['date_created'],
                'time_created'      =>$dataPost['time_created'],
				'user_modified'     =>$this->session->userdata('user_rowID'),
				'date_modified'     =>date('Y-m-d'),
				'time_modified'     =>date('H:i:s')
                
            );
            $result=$this->db->insert('gl_trx_dtl',$data);
         }        
        
         if ($result){
            return true;
         }else{
            return false;
         } 
    }
    
    function simpanGlDetailPPH($sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$sa_spec_prefix,$alloc_code,$alloc_no,$coa_wth_rowID,$x,$dataPost,$detailPPH=array()){
	   
        if($dataPost['invoice_no'] == ''){
            /*
            if(date('Y-m-d',strtotime($dataPost['invoice_date'])) != date('Y-m-d')){
                $invoice_date = date('Y-m-d');
            }
            else{
                $invoice_date = date('Y-m-d',strtotime($dataPost['invoice_date']));
            }
            */
            
            $invoice_date = date('Y-m-d',strtotime($dataPost['invoice_date']));
            
            $year = date('Y',strtotime($invoice_date));
            $month = date('m',strtotime($invoice_date));
    
            $data = array(
                'gl_trx_hdr_prefix' =>$sa_spec_prefix_gl,
                'gl_trx_hdr_year'   =>$year,
                'gl_trx_hdr_month'  =>$month,
                'gl_trx_hdr_code'   =>$new_gl_coa_code,
                'row_no'            =>$x,
                'gl_trx_hdr_journal_no' =>$gl_coa_no,
                'gl_trx_hdr_journal_date' =>$invoice_date,
                'coa_rowID'         =>$coa_wth_rowID, 
                'trx_amt'           => str_replace('.','',$detailPPH['amountWth']),
                'descs'             => strtoupper($detailPPH['invoice_remark']),
                'dep_rowID'         => $this->session->userdata('dep_rowID'),
                'debtor_creditor_rowID' =>$dataPost['debtor_id'],
                'gl_trx_hdr_ref_prefix' =>$sa_spec_prefix,
                'gl_trx_hdr_ref_year' =>$year,
                'gl_trx_hdr_ref_month' =>$month,
                'gl_trx_hdr_ref_code'  =>$alloc_code,
                'gl_trx_hdr_ref_no'    =>$alloc_no,
                'gl_trx_hdr_ref_date'  =>$invoice_date,
                'modul'                =>'AR',
                'user_created'         =>$this->session->userdata('user_rowID'),
                'date_created'         =>$invoice_date,
                'time_created'         =>date('H:i:s')
                
            );
             $result=$this->db->insert('gl_trx_dtl',$data);
        }
        else{
            $invoice_date = date('Y-m-d',strtotime($dataPost['invoice_date']));
            $year = date('Y',strtotime($invoice_date));
            $month = date('m',strtotime($invoice_date));
    
            $data = array(
                'gl_trx_hdr_prefix' =>$sa_spec_prefix_gl,
                'gl_trx_hdr_year'   =>$year,
                'gl_trx_hdr_month'  =>$month,
                'gl_trx_hdr_code'   =>$new_gl_coa_code,
                'row_no'            =>$x,
                'gl_trx_hdr_journal_no' =>$gl_coa_no,
                'gl_trx_hdr_journal_date' =>$invoice_date,
                'coa_rowID'         =>$coa_wth_rowID, 
                'trx_amt'           => str_replace('.','',$detailPPH['amountWth']),
                'descs'             => strtoupper($detailPPH['invoice_remark']),
                'dep_rowID'         => $this->session->userdata('dep_rowID'),
                'debtor_creditor_rowID' =>$dataPost['debtor_id'],
                'gl_trx_hdr_ref_prefix' =>$sa_spec_prefix,
                'gl_trx_hdr_ref_year' =>$year,
                'gl_trx_hdr_ref_month' =>$month,
                'gl_trx_hdr_ref_code'  =>$alloc_code,
                'gl_trx_hdr_ref_no'    =>$alloc_no,
                'gl_trx_hdr_ref_date'  =>$invoice_date,
                'modul'                =>'AR',
                'user_created'      =>$dataPost['user_created'],
                'date_created'      =>$dataPost['date_created'],
                'time_created'      =>$dataPost['time_created'],
				'user_modified'     =>$this->session->userdata('user_rowID'),
				'date_modified'     =>date('Y-m-d'),
				'time_modified'     =>date('H:i:s')
            );
             $result=$this->db->insert('gl_trx_dtl',$data);
        }        
        
         if ($result){
            return true;
         }else{
            return false;
         } 
    }
    
    function simpanGlDetailIncome($sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$sa_spec_prefix,$alloc_code,$alloc_no,$income_coa_rowID,$x,$dataPost,$detK_income=array()){
	   
        if($dataPost['invoice_no'] == ''){
            /*
            if(date('Y-m-d',strtotime($dataPost['invoice_date'])) != date('Y-m-d')){
                $invoice_date = date('Y-m-d');
            }
            else{
                $invoice_date = date('Y-m-d',strtotime($dataPost['invoice_date']));
            }
            */
            
            $invoice_date = date('Y-m-d',strtotime($dataPost['invoice_date']));
            
            $year = date('Y',strtotime($invoice_date));
            $month = date('m',strtotime($invoice_date));
    
            $data = array(
                'gl_trx_hdr_prefix' =>$sa_spec_prefix_gl,
                'gl_trx_hdr_year'   =>$year,
                'gl_trx_hdr_month'  =>$month,
                'gl_trx_hdr_code'   =>$new_gl_coa_code,
                'row_no'            =>$x,
                'gl_trx_hdr_journal_no' =>$gl_coa_no,
                'gl_trx_hdr_journal_date' =>$invoice_date,
                'coa_rowID'         =>$income_coa_rowID,
                'trx_amt'           => str_replace('.','',$detK_income['amount_base'])*-1,
                'descs'             => strtoupper($detK_income['invoice_remark']),
                'dep_rowID'         => $this->session->userdata('dep_rowID'),
                'debtor_creditor_rowID' =>$dataPost['debtor_id'],
                'gl_trx_hdr_ref_prefix' =>$sa_spec_prefix,
                'gl_trx_hdr_ref_year' =>$year,
                'gl_trx_hdr_ref_month' =>$month,
                'gl_trx_hdr_ref_code'  =>$alloc_code,
                'gl_trx_hdr_ref_no'    =>$alloc_no,
                'gl_trx_hdr_ref_date'  =>$invoice_date,
                'modul'                =>'AR',
                'user_created'         =>$this->session->userdata('user_rowID'),
                'date_created'         =>$invoice_date,
                'time_created'         =>date('H:i:s')
            );
             $result=$this->db->insert('gl_trx_dtl',$data);
        }
        else{
            $invoice_date = date('Y-m-d',strtotime($dataPost['invoice_date']));
            $year = date('Y',strtotime($invoice_date));
            $month = date('m',strtotime($invoice_date));
    
            $data = array(
                'gl_trx_hdr_prefix' =>$sa_spec_prefix_gl,
                'gl_trx_hdr_year'   =>$year,
                'gl_trx_hdr_month'  =>$month,
                'gl_trx_hdr_code'   =>$new_gl_coa_code,
                'row_no'            =>$x,
                'gl_trx_hdr_journal_no' =>$gl_coa_no,
                'gl_trx_hdr_journal_date' =>$invoice_date,
                'coa_rowID'         =>$income_coa_rowID,
                'trx_amt'           => str_replace('.','',$detK_income['amount_base'])*-1,
                'descs'             => strtoupper($detK_income['invoice_remark']),
                'dep_rowID'         => $this->session->userdata('dep_rowID'),
                'debtor_creditor_rowID' =>$dataPost['debtor_id'],
                'gl_trx_hdr_ref_prefix' =>$sa_spec_prefix,
                'gl_trx_hdr_ref_year' =>$year,
                'gl_trx_hdr_ref_month' =>$month,
                'gl_trx_hdr_ref_code'  =>$alloc_code,
                'gl_trx_hdr_ref_no'    =>$alloc_no,
                'gl_trx_hdr_ref_date'  =>$invoice_date,
                'modul'                =>'AR',
                'user_created'      =>$dataPost['user_created'],
                'date_created'      =>$dataPost['date_created'],
                'time_created'      =>$dataPost['time_created'],
				'user_modified'     =>$this->session->userdata('user_rowID'),
				'date_modified'     =>date('Y-m-d'),
				'time_modified'     =>date('H:i:s')
            );
             $result=$this->db->insert('gl_trx_dtl',$data);
        }        
        
         if ($result){
            return true;
         }else{
            return false;
         } 
    }
    
    function simpanGlDetailPPN($sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$sa_spec_prefix,$alloc_code,$alloc_no,$ppn_coa_rowID,$z,$dataPost,$detK_PPN=array()){
	   
        if($dataPost['invoice_no'] == ''){
            /*
            if(date('Y-m-d',strtotime($dataPost['invoice_date'])) != date('Y-m-d')){
                $invoice_date = date('Y-m-d');
            }
            else{
                $invoice_date = date('Y-m-d',strtotime($dataPost['invoice_date']));
            }
            */
            
            $invoice_date = date('Y-m-d',strtotime($dataPost['invoice_date']));
            
            $year = date('Y',strtotime($invoice_date));
            $month = date('m',strtotime($invoice_date));
    
           $data = array(
                'gl_trx_hdr_prefix' =>$sa_spec_prefix_gl,
                'gl_trx_hdr_year'   =>$year,
                'gl_trx_hdr_month'  =>$month,
                'gl_trx_hdr_code'   =>$new_gl_coa_code,
                'row_no'            =>$z,
                'gl_trx_hdr_journal_no' =>$gl_coa_no,
                'gl_trx_hdr_journal_date' =>$invoice_date,
                'coa_rowID'         =>$ppn_coa_rowID,
                'trx_amt'           => str_replace('.','',$detK_PPN['amount_vat'])*-1,
                'descs'             => strtoupper($detK_PPN['invoice_remark']),
                'dep_rowID'         => $this->session->userdata('dep_rowID'),
                'debtor_creditor_rowID' =>$dataPost['debtor_id'],
                'gl_trx_hdr_ref_prefix' =>$sa_spec_prefix,
                'gl_trx_hdr_ref_year' =>$year,
                'gl_trx_hdr_ref_month' =>$month,
                'gl_trx_hdr_ref_code'  =>$alloc_code,
                'gl_trx_hdr_ref_no'    =>$alloc_no,
                'gl_trx_hdr_ref_date'  =>$invoice_date,
                'modul'                =>'AR',
                'user_created'         =>$this->session->userdata('user_rowID'),
                'date_created'         =>$invoice_date,
                'time_created'         =>date('H:i:s')
                
           );
             $result=$this->db->insert('gl_trx_dtl',$data);
        }
        else{
            $invoice_date = date('Y-m-d',strtotime($dataPost['invoice_date']));
            $year = date('Y',strtotime($invoice_date));
            $month = date('m',strtotime($invoice_date));
    
           $data = array(
                'gl_trx_hdr_prefix' =>$sa_spec_prefix_gl,
                'gl_trx_hdr_year'   =>$year,
                'gl_trx_hdr_month'  =>$month,
                'gl_trx_hdr_code'   =>$new_gl_coa_code,
                'row_no'            =>$z,
                'gl_trx_hdr_journal_no' =>$gl_coa_no,
                'gl_trx_hdr_journal_date' =>$invoice_date,
                'coa_rowID'         =>$ppn_coa_rowID,
                'trx_amt'           => str_replace('.','',$detK_PPN['amount_vat'])*-1,
                'descs'             => strtoupper($detK_PPN['invoice_remark']),
                'dep_rowID'         => $this->session->userdata('dep_rowID'),
                'debtor_creditor_rowID' =>$dataPost['debtor_id'],
                'gl_trx_hdr_ref_prefix' =>$sa_spec_prefix,
                'gl_trx_hdr_ref_year' =>$year,
                'gl_trx_hdr_ref_month' =>$month,
                'gl_trx_hdr_ref_code'  =>$alloc_code,
                'gl_trx_hdr_ref_no'    =>$alloc_no,
                'gl_trx_hdr_ref_date'  =>$invoice_date,
                'modul'                =>'AR',
                'user_created'      =>$dataPost['user_created'],
                'date_created'      =>$dataPost['date_created'],
                'time_created'      =>$dataPost['time_created'],
				'user_modified'     =>$this->session->userdata('user_rowID'),
				'date_modified'     =>date('Y-m-d'),
				'time_modified'     =>date('H:i:s')
           );
             $result=$this->db->insert('gl_trx_dtl',$data);
        }        
        
         if ($result){
            return true;
         }else{
            return false;
         } 
    }    
    
    function updateHeaderInvoice($dataPost){
 			$this->db->set('deleted',1);
            $this->db->set('user_deleted',$this->session->userdata('user_rowID'));
            $this->db->set('date_deleted',date('Y-m-d'));
            $this->db->set('time_deleted',date('H:i:s'));
 			$this->db->where('deleted',0);
			$this->db->where('trx_no',$dataPost['invoice_no']);
			$result=$this->db->update('ar_trx_hdr');
         if ($result){
            return true;
         }else{
            return false;
         } 
    }  
    
    function deleteHeaderGL($journal_no){
 			$this->db->set('deleted',1);
            $this->db->set('user_deleted',$this->session->userdata('user_rowID'));
            $this->db->set('date_deleted',date('Y-m-d'));
            $this->db->set('time_deleted',date('H:i:s'));
			$this->db->where('deleted',0);
			$this->db->where('journal_no',$journal_no);
			$result=$this->db->update('gl_trx_hdr');
         if ($result){
            return true;
         }else{
            return false;
         } 
    }  
    
    function deleteDetailGL($journal_no){
 			$this->db->set('deleted',1);
            $this->db->set('user_deleted',$this->session->userdata('user_rowID'));
            $this->db->set('date_deleted',date('Y-m-d'));
            $this->db->set('time_deleted',date('H:i:s'));
			$this->db->where('deleted',0);
			$this->db->where('gl_trx_hdr_journal_no',$journal_no);
			$result=$this->db->update('gl_trx_dtl');
         if ($result){
            return true;
         }else{
            return false;
         } 
    }  
    
    function deleteUpdateHeaderInvoice($dataPost){
        $this->db->where('trx_no',$dataPost['invoice_no']);
		$result=$this->db->delete('ar_trx_hdr');

        if ($result){
            return true;
        }else{
            return false;
        } 
    }  
    
    function updateDetailInvoice($dataPost){
 			$this->db->set('deleted',1);
            $this->db->set('user_deleted',$this->session->userdata('user_rowID'));
            $this->db->set('date_deleted',date('Y-m-d'));
            $this->db->set('time_deleted',date('H:i:s'));
			$this->db->where('deleted',0);
			$this->db->where('ar_trx_hdr_prefix',$dataPost['prefix']);
			$this->db->where('ar_trx_hdr_year',$dataPost['year']);
			$this->db->where('ar_trx_hdr_month',$dataPost['month']);
			$this->db->where('ar_trx_hdr_code',$dataPost['code']);
			$result=$this->db->update('ar_trx_dtl');
         if ($result){
            return true;
         }else{
            return false;
         } 
    } 
    
    function updateDetailDeliveryOrder($dataPost){
        $this->db->set('deleted',1);
        $this->db->where('trx_no',$dataPost['invoice_no']);
        $result=$this->db->update('ar_trx_dtl_do');
        if ($result){
            return true;
        }else{
            return false;
        } 
    }
    
    function updateDetailDeliveryOrder_by_invoice_no($invoice_no){
        $this->db->set('deleted',1);
        $this->db->where('trx_no',$invoice_no);
        $result=$this->db->update('ar_trx_dtl_do');
        if ($result){
            return true;
        }else{
            return false;
        } 
    }

    function updateAPDetailDeliveryOrder_by_invoice_no($invoice_no){
        $this->db->set('invoice_no','');
        $this->db->set('user_modified',$this->session->userdata('user_rowID'));
        $this->db->set('date_modified',date("Y-m-d"));
        $this->db->set('time_modified',date("H:i:s"));
        $this->db->where('invoice_no',$invoice_no);
        $result=$this->db->update('ap_trx_dtl_do');
        if ($result){
            return true;
        }else{
            return false;
        } 
    }

    function updateDetailDeliveryOrderManual($dataPost){
        $this->db->set('deleted',1);
        $this->db->set('user_deleted',$this->session->userdata('user_rowID'));
        $this->db->set('date_deleted',date('Y-m-d'));
        $this->db->set('time_deleted',date('H:i:s'));
        $this->db->where('deleted',0);
        $this->db->where('trx_no',$dataPost['invoice_no']);
        $result=$this->db->update('ar_trx_dtl_do_manual');
        if ($result){
            return true;
        }else{
            return false;
        } 
    }
    
    function simpanGlHeaderDel($sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$dataPost){
	   $data = array(
            'prefix' =>$sa_spec_prefix_gl,
            'year'   =>date('Y',strtotime($dataPost['invoice_date'])),
            'month'  =>date('m',strtotime($dataPost['invoice_date'])),
            'code'   =>$new_gl_coa_code,
            'journal_no' =>$gl_coa_no,
            'journal_date' =>date('Y-m-d',strtotime($dataPost['invoice_date'])),
            'journal_type' => 'invoice',
            'descs'        => ucfirst($dataPost['invoice_remark_header']),
            'trx_amt'   => 0 + str_replace('.','',$dataPost['GrandTotal']),//str_replace('.','',$dataPost['TotalWth']) + str_replace('.','',$dataPost['GrandTotal']),
            'ref_prefix' => $dataPost['gl_trx_hdr_prefix'],
            'ref_year'   =>$dataPost['gl_trx_hdr_year'],
            'ref_month'  =>$dataPost['gl_trx_hdr_month'],
            'ref_code'   =>$dataPost['gl_trx_hdr_code'],
            'ref_no'     =>$dataPost['gl_trx_hdr_trx_no'],
            'ref_date'   =>date('Y-m-d',strtotime($dataPost['invoice_date'])),
            'user_created' =>$this->session->userdata('user_rowID'),
            'date_created' =>date('Y-m-d'),
            'time_created' =>date('H:i:s')
        );  
        $result=$this->db->insert('gl_trx_hdr',$data);
         if ($result){
            return true;
         }else{
            return false;
         } 
    }
    
    function simpanGlDetailPiutangDel($sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$coa_receivable_RowID,$dataPost){
	   $data = array(
            'gl_trx_hdr_prefix' =>$sa_spec_prefix_gl,
            'gl_trx_hdr_year'   =>date('Y',strtotime($dataPost['invoice_date'])),
            'gl_trx_hdr_month'  =>date('m',strtotime($dataPost['invoice_date'])),
            'gl_trx_hdr_code'   =>$new_gl_coa_code,
            'row_no'            =>1,
            'gl_trx_hdr_journal_no' =>$gl_coa_no,
            'gl_trx_hdr_journal_date' =>date('Y-m-d',strtotime($dataPost['invoice_date'])),
            'coa_rowID'         =>$coa_receivable_RowID,
            'trx_amt'           => str_replace('.','',$dataPost['GrandTotal'])*-1,
            'descs'             => '',
            'dep_rowID'         => $this->session->userdata('dep_rowID'),
            'debtor_creditor_rowID' =>$dataPost['debtor_id_tmp'],
            'gl_trx_hdr_ref_prefix' =>$dataPost['gl_trx_hdr_prefix'],
            'gl_trx_hdr_ref_year' =>$dataPost['gl_trx_hdr_year'],
            'gl_trx_hdr_ref_month' =>$dataPost['gl_trx_hdr_month'],
            'gl_trx_hdr_ref_code'  =>$dataPost['gl_trx_hdr_code'],
            'gl_trx_hdr_ref_no'    =>$dataPost['gl_trx_hdr_trx_no'],
            'gl_trx_hdr_ref_date'  =>date('Y-m-d',strtotime($dataPost['invoice_date'])),
            'modul'                =>'AR',
            'user_created'         =>$this->session->userdata('user_rowID'),
            'date_created'         =>date('Y-m-d'),
            'time_created'         =>date('H:i:s')
            
       );
        $result=$this->db->insert('gl_trx_dtl',$data);
         if ($result){
            return true;
         }else{
            return false;
         } 
    }
    
    function simpanGlDetailPPHDeleted($sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$coa_wth_rowID,$x,$dataPost,$detailPPH=array()){
	   $data = array(
            'gl_trx_hdr_prefix' =>$sa_spec_prefix_gl,
            'gl_trx_hdr_year'   =>date('Y',strtotime($dataPost['invoice_date'])),
            'gl_trx_hdr_month'  =>date('m',strtotime($dataPost['invoice_date'])),
            'gl_trx_hdr_code'   =>$new_gl_coa_code,
            'row_no'            =>$x,
            'gl_trx_hdr_journal_no' =>$gl_coa_no,
            'gl_trx_hdr_journal_date' =>date('Y-m-d',strtotime($dataPost['invoice_date'])),
            'coa_rowID'         =>$coa_wth_rowID,
            'trx_amt'           => 0,//str_replace('.','',$detailPPH['amountWth'])*-1,
            'descs'             => strtoupper($detailPPH['invoice_remark']),
            'dep_rowID'         => $this->session->userdata('dep_rowID'),
            'debtor_creditor_rowID' =>$dataPost['debtor_id_tmp'],
            'gl_trx_hdr_ref_prefix' =>$dataPost['gl_trx_hdr_prefix'],
            'gl_trx_hdr_ref_year' =>$dataPost['gl_trx_hdr_year'],
            'gl_trx_hdr_ref_month' =>$dataPost['gl_trx_hdr_month'],
            'gl_trx_hdr_ref_code'  =>$dataPost['gl_trx_hdr_code'],
            'gl_trx_hdr_ref_no'    =>$dataPost['gl_trx_hdr_trx_no'],
            'gl_trx_hdr_ref_date'  =>date('Y-m-d',strtotime($dataPost['invoice_date'])),
            'modul'                =>'AR',
            'user_created'         =>$this->session->userdata('user_rowID'),
            'date_created'         =>date('Y-m-d'),
            'time_created'         =>date('H:i:s')
            
       );
         $result=$this->db->insert('gl_trx_dtl',$data);
         if ($result){
            return true;
         }else{
            return false;
         } 
    }
    
    function simpanGlDetailIncomeDeleted($sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$income_coa_rowID,$y,$dataPost,$detK_income=array()){
	   $data = array(
            'gl_trx_hdr_prefix' =>$sa_spec_prefix_gl,
            'gl_trx_hdr_year'   =>date('Y',strtotime($dataPost['invoice_date'])),
            'gl_trx_hdr_month'  =>date('m',strtotime($dataPost['invoice_date'])),
            'gl_trx_hdr_code'   =>$new_gl_coa_code,
            'row_no'            =>$y,
            'gl_trx_hdr_journal_no' =>$gl_coa_no,
            'gl_trx_hdr_journal_date' =>date('Y-m-d',strtotime($dataPost['invoice_date'])),
            'coa_rowID'         =>$income_coa_rowID,
            'trx_amt'           => str_replace('.','',$detK_income['amount_base']),
            'descs'             => strtoupper($detK_income['invoice_remark']),
            'dep_rowID'         => $this->session->userdata('dep_rowID'),
            'debtor_creditor_rowID' =>$dataPost['debtor_id_tmp'],
            'gl_trx_hdr_ref_prefix' =>$dataPost['gl_trx_hdr_prefix'],
            'gl_trx_hdr_ref_year' =>$dataPost['gl_trx_hdr_year'],
            'gl_trx_hdr_ref_month' =>$dataPost['gl_trx_hdr_month'],
            'gl_trx_hdr_ref_code'  =>$dataPost['gl_trx_hdr_code'],
            'gl_trx_hdr_ref_no'    =>$dataPost['gl_trx_hdr_trx_no'],
            'gl_trx_hdr_ref_date'  =>date('Y-m-d',strtotime($dataPost['invoice_date'])),
            'modul'                =>'AR',
            'user_created'         =>$this->session->userdata('user_rowID'),
            'date_created'         =>date('Y-m-d'),
            'time_created'         =>date('H:i:s')
            
       );
         $result=$this->db->insert('gl_trx_dtl',$data);
         if ($result){
            return true;
         }else{
            return false;
         } 
    }

    function simpanGlDetailPPNDeleted($sa_spec_prefix_gl,$new_gl_coa_code,$gl_coa_no,$ppn_coa_rowID,$z,$dataPost,$detK_PPN=Array()){
    	$data = array(
            'gl_trx_hdr_prefix' =>$sa_spec_prefix_gl,
            'gl_trx_hdr_year'   =>date('Y',strtotime($dataPost['invoice_date'])),
            'gl_trx_hdr_month'  =>date('m',strtotime($dataPost['invoice_date'])),
            'gl_trx_hdr_code'   =>$new_gl_coa_code,
            'row_no'            =>$z,
            'gl_trx_hdr_journal_no' =>$gl_coa_no,
            'gl_trx_hdr_journal_date' =>date('Y-m-d',strtotime($dataPost['invoice_date'])),
            'coa_rowID'         =>$ppn_coa_rowID,
            'trx_amt'           => str_replace('.','',$detK_PPN['amount_vat']),
            'descs'             => strtoupper($detK_PPN['invoice_remark']),
            'dep_rowID'         => $this->session->userdata('dep_rowID'),
            'debtor_creditor_rowID' =>$dataPost['debtor_id_tmp'],
            'gl_trx_hdr_ref_prefix' =>$dataPost['gl_trx_hdr_prefix'],
            'gl_trx_hdr_ref_year' =>$dataPost['gl_trx_hdr_year'],
            'gl_trx_hdr_ref_month' =>$dataPost['gl_trx_hdr_month'],
            'gl_trx_hdr_ref_code'  =>$dataPost['gl_trx_hdr_code'],
            'gl_trx_hdr_ref_no'    =>$dataPost['gl_trx_hdr_trx_no'],
            'gl_trx_hdr_ref_date'  =>date('Y-m-d',strtotime($dataPost['invoice_date'])),
            'modul'                =>'AR',
            'user_created'         =>$this->session->userdata('user_rowID'),
            'date_created'         =>date('Y-m-d'),
            'time_created'         =>date('H:i:s')
            
       );
         $result=$this->db->insert('gl_trx_dtl',$data);
         if ($result){
            return true;
         }else{
            return false;
         } 
    }
    


    
    function delete_header($id,$tabel){
  		$this->db->where('rowID', $id);
		$this->db->delete($tabel);
    }
    


    function get_data_cash_advance_jo()
    {

        $this->db->select('a.year,a.month,a.code,a.jo_no,a.jo_date,b.debtor_name as debtor,a.po_spk_no,a.so_no,a.vessel_no,a.jo_type,
                a.price_20ft,a.price_40ft,a.price_45ft,a.wholesale,a.price_amount,a.vessel_name,c.port_name,a.fare_trip_rowID,
                d.destination_from_rowID,d.destination_to_rowID,e.destination_name as from_name, f.destination_name as to_name, g.item_name', false);
        $this->db->from('tr_jo_trx_hdr as a');
        $this->db->join('sa_debtor as b', 'a.debtor_rowID=b.rowID', 'left');
        $this->db->join('sa_port as c', 'a.port_rowID=c.rowID', 'left');
        $this->db->join('sa_fare_trip_hdr as d', 'a.fare_trip_rowID=d.rowID', 'left');
        $this->db->join('sa_destination as e', 'd.destination_from_rowID=e.rowID', 'left');
        $this->db->join('sa_destination as f', 'd.destination_to_rowID=f.rowID', 'left');
        $this->db->join('sa_item as g', 'a.item_rowID=g.rowID', 'left');
        $this->db->where('a.deleted =', 0);
        $this->db->where('a.status <>', 2);
        $this->db->order_by('a.jo_no', 'desc');

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }

    }
    
   	function get_by_id_wthholding($tabel,$rowID)
	{
		$this->db->from($tabel);
		$this->db->where('rowID',$rowID);
		$query = $this->db->get();
		return $query->row();
	}

    function get_by_id($cb_prefix,$cb_year,$cb_month,$cb_code)
    {
        $this->db->select("a.*,CONCAT(b.debtor_cd,' - ',b.debtor_name) AS debtor_name", false);
        $this->db->from('ar_trx_hdr as a');
        $this->db->join('sa_debtor as b', 'b.rowID = a.debtor_rowID','left');
        $this->db->where('a.deleted', 0);
        $this->db->where('a.prefix', $cb_prefix);
        $this->db->where('a.year', $cb_year);
        $this->db->where('a.month', $cb_month);
        $this->db->where('a.code', $cb_code);
        $this->db->order_by('a.trx_no', 'desc');
        $query = $this->db->get();
        return $query->row();
    }
    
    function get_data_header_by_trx_no($trx_no)
    {
        $this->db->select("*");
        $this->db->from('ar_trx_hdr');
        $this->db->where('deleted', 0);
        $this->db->where('trx_no', $trx_no);
        $query = $this->db->get();
        return $query->row();
    }
    
    function delete_data($tabel, $id)
    {

        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));
        $this->db->where('rowID', $id);
        return $this->db->update($tabel);

    }
    
    function get_data_jo($jo_no){
        $this->db->select('*');
        $this->db->from('tr_jo_trx_hdr');
        $this->db->where('jo_no', $jo_no);
        $this->db->where('deleted', 0);

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->row();
        } else
        {
            return null;
        }
    }
    
    function get_data_detail_do_manual($trx_no){
        $this->db->select('a.*,b.jo_type,b.price_amount,b.wholesale,b.price_20ft,b.price_40ft,b.price_45ft');
        $this->db->from('ar_trx_dtl_do_manual as a');
        $this->db->join('tr_jo_trx_hdr as b', 'a.jo_no=b.jo_no','left');        
        $this->db->where('a.trx_no', $trx_no);
        $this->db->where('a.deleted', 0);
        $this->db->where('b.deleted', 0);
        $this->db->order_by('a.do_no','asc');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }
    }
    
    function get_all_record_data($start_date,$end_date)
    {

        $this->db->select("a.*,
                CONCAT(b.debtor_cd,' - ',b.debtor_name) AS debtor_name", false);
        $this->db->from('ar_trx_hdr as a');
        $this->db->join('sa_debtor as b', 'b.rowID = a.debtor_rowID',
            'left');
        $this->db->where('a.deleted', 0);
        $this->db->where("a.trx_date BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->db->order_by('a.trx_no', 'desc');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }

    }
    
    function get_all_record_data_by_trx_no($trx_no)
    {

        $this->db->select("a.*,b.*,c.jo_type,c.po_spk_no,c.vessel_name,d.destination_name as to_destination,e.port_name,f.item_name,g.destination_name as from_destination");
        $this->db->from('ar_trx_hdr as a');
        $this->db->join('sa_debtor as b', 'b.rowID = a.debtor_rowID');
        $this->db->join('tr_jo_trx_hdr as c', 'c.jo_no = a.jo_no','left');
        $this->db->join('sa_destination as d', 'd.rowID = c.destination_to_rowID','left');
        $this->db->join('sa_port as e', 'e.rowID = c.port_rowID','left');
        $this->db->join('sa_item as f', 'f.rowID = c.item_rowID','left');
        $this->db->join('sa_destination as g', 'g.rowID = c.destination_from_rowID','left');
        $this->db->where('a.deleted', 0);
        $this->db->where('c.deleted', 0);
        $this->db->where('a.trx_no', $trx_no);
        
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }

    }
    
    function get_all_records($table, $where, $join_table, $join_criteria, $order, $sort)
    {
        $this->db->where($where);
        if ($join_table) {
            $this->db->join($join_table, $join_criteria);
        }
        $query = $this->db->order_by($order, $sort)->get($table);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }

    }
    
    function get_data_do($do_no){
        $this->db->select('*');
        $this->db->from('ar_trx_dtl_do_manual');
        $this->db->where('do_no', $do_no);
        $this->db->where('deleted', 0);

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->row();
        } else
        {
            return array();
        }
    }
    
    function get_data_do_by_jo_no($jo_no)
    {
        $this->db->select("a.rowID,a.trx_no,a.do_no,a.jo_no,a.count_container,a.container_no,a.container_size,a.received_weight,
                            b.jo_type,b.wholesale,b.price_amount,b.price_20ft,b.price_40ft,b.price_45ft");
        $this->db->from('tr_do_trx as a');
        $this->db->join('tr_jo_trx_hdr as b', 'b.jo_no = a.jo_no','left');
        $this->db->where('a.deleted', 0);
        $this->db->where('b.deleted', 0);
        $this->db->where('a.invoice_no =', '');
        $this->db->where('a.status != ', 0);
        $this->db->where('a.jo_no', $jo_no);
        $this->db->order_by('a.do_no', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    
    function get_data_use_do_by_trx_no($trx_no)
    {
        $this->db->select("do.price,a.rowID,a.trx_no,a.do_no,a.jo_no,a.count_container,a.container_no,a.container_size,a.received_weight,
                            b.jo_type,b.wholesale,b.price_amount,b.price_20ft,b.price_40ft,b.price_45ft");
        $this->db->from('ar_trx_dtl_do as do');
        $this->db->join('tr_do_trx as a', 'a.rowID = do.do_id');
        $this->db->join('tr_jo_trx_hdr as b', 'b.jo_no = a.jo_no');
        $this->db->where('a.deleted', 0);
        $this->db->where('b.deleted', 0);
        $this->db->where('do.deleted', 0);
        $this->db->where('a.status', 1);
        $this->db->where('do.trx_no', $trx_no);
        $this->db->order_by('a.trx_no', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    
    function get_data_do_by_row_id($row_id)
    {
        $this->db->select("a.rowID,a.trx_no,a.do_no,a.do_date,a.jo_no,a.container_row_no,a.count_container,a.container_no,a.container_size,a.received_weight,
                            b.jo_type,b.wholesale,b.price_amount,b.price_20ft,b.price_40ft,b.price_45ft,d.debtor_name,e.police_no");
        $this->db->from('tr_do_trx as a');
        $this->db->join('tr_jo_trx_hdr as b', 'b.jo_no = a.jo_no','left');
        $this->db->join('cb_cash_adv as c','c.trx_no = a.trx_no');
        $this->db->join('sa_debtor as d','d.rowID = c.employee_driver_rowID');
        $this->db->join('sa_vehicle as e','e.rowID = c.vehicle_rowID');
        $this->db->where('a.deleted', 0);
        $this->db->where('b.deleted', 0);
        $this->db->where('a.status', 1);
        $this->db->where('a.rowID', $row_id);
        $this->db->order_by('a.do_no', 'asc');
        $query = $this->db->get();
        return $query->row();
    }
    
    function get_data_delivery_order_by_do_id($do_id)
    {

        $this->db->select('*', false);
        $this->db->from('ar_trx_dtl_do');
        $this->db->where('deleted =', 0);
        $this->db->where('do_id =', $do_id);
        $this->db->order_by('rowID', 'asc');

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->row();
        } else
        {
            return null;
        }

    }
    
    function get_data_do_by_jo($jo_no)
    {
        $this->db->select("a.rowID,a.trx_no,a.do_no,a.do_date,a.jo_no,a.count_container,a.container_no,a.container_size,a.received_weight");
        $this->db->from('tr_do_trx as a');
        $this->db->where('a.deleted', 0);
        $this->db->where('a.status', 1);
        $this->db->where('a.jo_no', $jo_no);
        $this->db->order_by('a.trx_no', 'asc');
        $query = $this->db->get();
        return $query->row();
    }
    
    function get_all_data_by_trx_no($trx_no){
        $this->db->select("a.jo_no,b.*,c.descs as invoice_name,d.jo_type", false);
        $this->db->from('ar_trx_hdr as a');
        $this->db->join('ar_trx_dtl as b', 'b.ar_trx_no = a.trx_no','left');
        $this->db->join('sa_income as c', 'c.rowID = b.income_rowID','left');
        $this->db->join('tr_jo_trx_hdr as d', 'd.jo_no = a.jo_no','left');
        $this->db->where('a.deleted', 0);
        $this->db->where('b.deleted', 0);
        $this->db->where('d.deleted', 0);
        $this->db->where('a.trx_no', $trx_no);
        
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }

    }
    
    function get_data_delivery_order_by_trx_no($trx_no)
    {

        $this->db->select('*', false);
        $this->db->from('ar_trx_dtl_do');
        $this->db->where('deleted =', 0);
        $this->db->where('trx_no =', $trx_no);
        $this->db->order_by('rowID', 'asc');

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }

    }
    
    function get_data_delivery_order_by_jo_trx_no($trx_no)
    {
        $this->db->select('*', false);
        $this->db->from('ar_trx_dtl_do as a');
        $this->db->join('tr_do_trx as b','a.do_id = b.rowID');
        $this->db->where('a.deleted =', 0);
        $this->db->where('b.deleted =', 0);
        $this->db->where('a.trx_no =', $trx_no);
        $this->db->order_by('b.do_no', 'asc');

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }

    }
    
    function get_data_delivery_order_by_ap_trx_no($trx_no)
    {
        $this->db->select('*', false);
        $this->db->from('ar_trx_dtl_do as a');
        $this->db->join('ap_trx_dtl_do as b','a.ap_id = b.rowID');
        $this->db->where('a.deleted =', 0);
        $this->db->where('b.deleted =', 0);
        $this->db->where('a.trx_no =', $trx_no);
        $this->db->order_by('b.do_no', 'asc');

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }

    }
    
    function get_data_ap(){
        $this->db->select("a.*,b.creditor_name");
        $this->db->from('ap_trx_hdr as a');
        $this->db->join('sa_creditor as b', 'b.rowID=a.creditor_rowID');
        $this->db->where('a.deleted', 0);
        $this->db->order_by('a.trx_no', 'desc');
        $query = $this->db->get();
        return $query->result();
        
    }
    
    function get_data_ap_by_ap_no($ap_no)
    {
        $this->db->select("*");
        $this->db->from('ap_trx_hdr');
        $this->db->where('deleted', 0);
        $this->db->where('trx_no', $ap_no);
        $query = $this->db->get();
        return $query->row();
    }
    
    function get_data_ap_by_jo_ap_no($jo_ap_no)
    {
        $this->db->select("a.rowID,a.trx_no,a.do_no,a.do_date,a.jo_no,a.count_container,a.container_no,a.container_size,a.received_weight,a.police_no,
                            b.jo_type,b.wholesale,b.price_amount,b.price_20ft,b.price_40ft,b.price_45ft");
        $this->db->from('ap_trx_dtl_do as a');
        $this->db->join('tr_jo_trx_hdr as b', 'b.jo_no = a.jo_no','left');
        $this->db->where('a.invoice_no', '');
        $this->db->where('a.deleted', 0);
        $this->db->where('b.deleted', 0);
        $this->db->where('a.jo_no', $jo_ap_no);
        $this->db->order_by('a.trx_no', 'asc');
        $this->db->order_by('a.do_date', 'asc');
        $this->db->order_by('a.do_no', 'asc');
        $query = $this->db->get();
        return $query->result();
    }    
    
    function get_data_use_ap_by_jo_ap_no($trx_no)
    {
        $this->db->select("a.rowID,a.trx_no,a.do_no,a.do_date,a.jo_no,a.count_container,a.container_no,a.container_size,a.received_weight,a.police_no,
                            b.jo_type,b.wholesale,b.price_amount,b.price_20ft,b.price_40ft,b.price_45ft");
        $this->db->from('ap_trx_dtl_do as a');
        $this->db->join('tr_jo_trx_hdr as b', 'b.jo_no = a.jo_no','left');
        $this->db->where('a.invoice_no', $trx_no);
        $this->db->where('a.deleted', 0);
        $this->db->where('b.deleted', 0);
        $this->db->order_by('a.trx_no', 'asc');
        $this->db->order_by('a.do_date', 'asc');
        $this->db->order_by('a.do_no', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    
    function get_data_ap_do_by_row_id($row_id)
    {
        $this->db->select("a.rowID,a.trx_no,a.do_no,a.do_date,a.jo_no,a.container_row_no,a.count_container,a.container_no,a.container_size,a.received_weight,a.police_no,
                            b.jo_type,b.wholesale,b.price_amount,b.price_20ft,b.price_40ft,b.price_45ft");
        $this->db->from('ap_trx_dtl_do as a');
        $this->db->join('tr_jo_trx_hdr as b', 'b.jo_no = a.jo_no','left');
        $this->db->where('a.deleted', 0);
        $this->db->where('b.deleted', 0);
        $this->db->where('a.rowID', $row_id);
        $this->db->order_by('a.do_no', 'asc');
        $query = $this->db->get();
        return $query->row();
    }
    
    function get_data_do_manual_by_trx_no($trx_no)
    {
        $this->db->select("a.rowID,a.trx_no,a.do_no,a.do_date,a.jo_no,a.container_row_no,a.count_container,a.container_no,a.container_size,a.received_weight,a.police_no,
                            b.jo_type,b.wholesale,b.price_amount,b.price_20ft,b.price_40ft,b.price_45ft");
        $this->db->from('ar_trx_dtl_do_manual as a');
        $this->db->join('tr_jo_trx_hdr as b', 'b.jo_no = a.jo_no','left');
        $this->db->where('a.deleted', 0);
        $this->db->where('b.deleted', 0);
        $this->db->where('a.trx_no', $trx_no);
        $this->db->order_by('a.do_no', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    
    function get_data_ap_by_ap_id($ap_id)
    {

        $this->db->select('*', false);
        $this->db->from('ar_trx_dtl_do');
        $this->db->where('deleted =', 0);
        $this->db->where('ap_id =', $ap_id);
        $this->db->order_by('rowID', 'asc');

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->row();
        } else
        {
            return null;
        }

    }
    
    function update_verified_by_row_id($row_id,$verified){
        
        $this->db->set('verified',$verified);
        $this->db->set('user_verified',$this->session->userdata('user_rowID'));
        $this->db->set('date_verified',date("Y-m-d"));
        $this->db->set('time_verified',date("H:i:s"));
        $this->db->set('user_modified',$this->session->userdata('user_rowID'));
        $this->db->set('date_modified',date("Y-m-d"));
        $this->db->set('time_modified',date("H:i:s"));
        $this->db->where('rowID',$row_id);
        $result = $this->db->update('ar_trx_hdr');
	
    }
    
    function update_unverified_by_row_id($row_id){
        
        $this->db->set('verified',0);
        $this->db->set('user_verified',0);
        $this->db->set('date_verified','');
        $this->db->set('time_verified','');
        $this->db->set('user_modified',$this->session->userdata('user_rowID'));
        $this->db->set('date_modified',date("Y-m-d"));
        $this->db->set('time_modified',date("H:i:s"));
        $this->db->where('rowID',$row_id);
        $result = $this->db->update('ar_trx_hdr');
	
    }
    
}

/* End of file model.php */
