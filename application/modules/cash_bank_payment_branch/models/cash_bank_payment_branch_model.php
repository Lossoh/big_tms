<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class cash_bank_payment_branch_model extends CI_Model
{

    function simpan_header($sa_spec_prefix,$alloc_code,$trx_no,$dataPost)
    {
        $debtor_creditor_type = '';
        $debtor_creditor_rowID = 0;            

        if($dataPost['cb_trx_type'] == 'cash_advance' || $dataPost['cb_trx_type'] == 'ar' || $dataPost['cb_trx_type'] == 'commission' || $dataPost['cb_trx_type'] == 'deposit' 
        || $dataPost['cb_trx_type'] == 'advance' || $dataPost['cb_trx_type'] == 'reimburse'){
            $debtor_creditor_type = 'D';
            $debtor_creditor_rowID = $dataPost['debtor_creditor'];
        }
        else if($dataPost['cb_trx_type'] == 'ap'){
            $debtor_creditor_type = 'C';            
            $debtor_creditor_rowID = $dataPost['debtor_creditor'];
        }
        else{
            $debtor_creditor_type = 'G';
            if($dataPost['employee_type'] == 'D' || $dataPost['employee_type'] == 'E' ){
                $debtor_creditor_rowID = $dataPost['debtor_creditor'];
            }
            else{
                $debtor_creditor_rowID = 0;            
            }
        }
        
        $advance_invoice_trx_no = '';
        if($dataPost['cb_trx_type'] == 'cash_advance' || $dataPost['cb_trx_type'] == 'ar'){
            foreach ($dataPost['detailPay'] as $detPay) {
                $advance_invoice_trx_no = $detPay['advance_invoice_no'];
                break;
            }
        }
        
        $coa_rowID = 0;
        $total_giro = str_replace('.','',$dataPost['TotalGiro']);
        
        if($dataPost['payment_type'] == 'P'){
            $amount = str_replace(',','.',$total_giro) * -1;
            $i = 1;
            foreach($dataPost['detailgiro'] as $detGiro) {
                $coa_rowID = $detGiro['cash_bank'];
                if($i == 1)
                    break;
            }
        }
        else{
            $amount = str_replace(',','.',$total_giro);         
            $i = 1;
            foreach($dataPost['detailgiro'] as $detGiro) {
                $coa_rowID = $detGiro['cash_bank'];
                if($i == 1)
                    break;
            }
            //$coa_rowID = isset($dataPost['cb_acc']) ? $dataPost['cb_acc'] : 0;
        }
        
        
        if(date('Y-m-d',strtotime($dataPost['cb_payment_date'])) != date('Y-m-d')){
            $alloc_date = date('Y-m-d');
        }
        else{
            $alloc_date = date('Y-m-d',strtotime($dataPost['cb_payment_date']));
        }
        
        //$alloc_date = date('Y-m-d',strtotime($dataPost['cb_payment_date']));
    
        $alloc_date_year = date('Y',strtotime($alloc_date));
        $alloc_date_month = date('m',strtotime($alloc_date));
        
        $data = array(
            'prefix' => $sa_spec_prefix,
            'year' => $alloc_date_year,
            'month' => $alloc_date_month,
            'code'  => $alloc_code,
            'trx_no' => $trx_no,
            'advance_invoice_trx_no' => $advance_invoice_trx_no,
            'trx_date' => $alloc_date,
            'payment_type' => $dataPost['payment_type'],
            'transaction_type' => $dataPost['cb_trx_type'],
            'coa_rowID' => $coa_rowID,
            'descs' => $dataPost['cb_remark'],
            'trx_amt' => $amount,
            'fund_trf_coa_rowID' => 0,//(isset($dataPost['cb_pay_to'])) ? $dataPost['cb_pay_to'] : 0,
            'debtor_creditor_rowID'=>$debtor_creditor_rowID,
            'debtor_creditor_type'=>$debtor_creditor_type,
            'manual_debtor_creditor'=>$dataPost['debtor_creditor_note'],
            'manual_debtor_creditor_type'=>$dataPost['employee_type'],
            'branch'=>$this->session->userdata('dep_rowID'),
            'user_created' => $this->session->userdata('user_id'),
            'date_created' => $alloc_date,
            'time_created' => date('H:i:s'));
        $result=$this->db->insert('cb_trx_hdr', $data);
        
        if($result){
            return $this->db->insert_id();;
        }else{
            return 0;
        }
        
    }
    
    function edit_header($dataPost){
        $debtor_creditor_type = '';
        $debtor_creditor_rowID = 0;            
        
        if($dataPost['cb_trx_type'] == 'cash_advance' || $dataPost['cb_trx_type'] == 'ar' || $dataPost['cb_trx_type'] == 'commission' || $dataPost['cb_trx_type'] == 'deposit' 
        || $dataPost['cb_trx_type'] == 'advance' || $dataPost['cb_trx_type'] == 'reimburse'){        
            $debtor_creditor_type = 'D';
            $debtor_creditor_rowID = $dataPost['debtor_creditor'];
        }
        else if($dataPost['cb_trx_type'] == 'ap'){
            $debtor_creditor_type = 'C';            
            $debtor_creditor_rowID = $dataPost['debtor_creditor'];
        }
        else{
            $debtor_creditor_type = 'G';
            if($dataPost['employee_type'] == 'D' || $dataPost['employee_type'] == 'E' ){
                $debtor_creditor_rowID = $dataPost['debtor_creditor'];
            }
            else{
                $debtor_creditor_rowID = 0;            
            }
        }
        
        $advance_invoice_trx_no = '';
        if($dataPost['cb_trx_type'] == 'cash_advance' || $dataPost['cb_trx_type'] == 'ar'){
            foreach ($dataPost['detailPay'] as $detPay) {
                $advance_invoice_trx_no = $detPay['advance_invoice_no'];
                break;
            }
        }
        
        $coa_rowID = 0;
        $total_giro = str_replace('.','',$dataPost['TotalGiro']);
        
        if($dataPost['payment_type'] == 'P'){
            if(str_replace(',','.',$total_giro) > 0){
                $amount = str_replace(',','.',$total_giro) * -1;
            }
            else{
                $amount = str_replace(',','.',$total_giro);
            }
            
            $i = 1;
            foreach($dataPost['detailgiro'] as $detGiro) {
                $coa_rowID = $detGiro['cash_bank'];
                if($i == 1)
                    break;
            }
        }
        else{
            $amount = str_replace(',','.',$total_giro);  
            $i = 1;
            foreach($dataPost['detailgiro'] as $detGiro) {
                $coa_rowID = $detGiro['cash_bank'];
                if($i == 1)
                    break;
            }       
            //$coa_rowID = isset($dataPost['cb_acc']) ? $dataPost['cb_acc'] : 0;
        }
        
        $data = array(
            'prefix' => $dataPost['prefix'],
            'year' => $dataPost['year'],
            'month' => $dataPost['month'],
            'code'  => $dataPost['code'],
            'trx_no' => $dataPost['cb_payment_no'],
            'advance_invoice_trx_no' => $advance_invoice_trx_no,
            'trx_date' => date('Y-m-d',strtotime($dataPost['cb_payment_date'])),
            'payment_type' => $dataPost['payment_type'],
            'transaction_type' => $dataPost['cb_trx_type'],
            'coa_rowID' => $coa_rowID,
            'descs' =>$dataPost['cb_remark'],
            'trx_amt' => $amount,
            'fund_trf_coa_rowID' => 0,//(isset($dataPost['cb_pay_to'])) ? $dataPost['cb_pay_to'] : 0,
            'debtor_creditor_rowID'=>$debtor_creditor_rowID,
            'debtor_creditor_type'=>$debtor_creditor_type,
            'manual_debtor_creditor'=>$dataPost['debtor_creditor_note'],
            'manual_debtor_creditor_type'=>$dataPost['employee_type'],
            'user_modified' => $this->session->userdata('user_id'),
            'date_modified' => date('Y-m-d'),
            'time_modified' => date('H:i:s')
        );
        $this->db->where('trx_no',$dataPost['cb_payment_no']);
        $this->db->where('prefix',$dataPost['prefix']);
        $this->db->where('year',$dataPost['year']);
        $this->db->where('code',$dataPost['code']);
        $this->db->where('deleted',0);
        $result=$this->db->update('cb_trx_hdr', $data);
	    if ($result){
	       return true;
	    }else{
	       return false;
	    }
    }
    
    function simpanDetailGiro($sa_spec_prefix, $alloc_code,$i,$trx_no,$dataPost,$detGiro=array()){
        if($dataPost['user_created'] == '' && $dataPost['date_created'] == ''){
            if(date('Y-m-d',strtotime($dataPost['cb_payment_date'])) != date('Y-m-d')){
                $cb_payment_date = date('Y-m-d');
            }
            else{
                $cb_payment_date = date('Y-m-d',strtotime($dataPost['cb_payment_date']));
            }
            
            //$cb_payment_date = date('Y-m-d',strtotime($dataPost['cb_payment_date']));
            
            $year = date('Y',strtotime($cb_payment_date));
            $month = date('m',strtotime($cb_payment_date));
            
            $status = 0;
            if($detGiro['payment_method'] == "cheque" || $detGiro['payment_method'] == "giro"){
                $status = 0;                
            }
            else{
                $status = 1;
            }
            
            $cb_giro_amount = str_replace('.','',$detGiro['cb_giro_amount']);
        
	        $data = array(
                'cb_trx_hdr_prefix' => $sa_spec_prefix,
                'cb_trx_hdr_year' => $year,
                'cb_trx_hdr_month' => $month,
                'cb_trx_hdr_code'  => $alloc_code,
                'trx_no' => $trx_no,
                'row_no' =>$i,     
                'payment_method' => $detGiro['payment_method'],
                'cash_bank' => $detGiro['cash_bank'],
                'cg_no' => $detGiro['cb_giro_no'],
                'cg_date' => date('Y-m-d',strtotime($detGiro['cb_giro_date'])),            
                'cg_amt' => str_replace(',','.',$cb_giro_amount),
                'status' => $status,
                'user_created' => $this->session->userdata('user_id'),
                'date_created' => $cb_payment_date,
                'time_created' => date('H:i:s')
            );
            $result=$this->db->insert('cb_trx_cg', $data);
        }
        else{
            $cb_payment_date = date('Y-m-d',strtotime($dataPost['cb_payment_date']));
            $year = date('Y',strtotime($cb_payment_date));
            $month = date('m',strtotime($cb_payment_date));
            
            $status = 0;
            if($detGiro['payment_method'] == "cheque" || $detGiro['payment_method'] == "giro"){
                $status = 0;                
            }
            else{
                $status = 1;
            }
            
            $cb_giro_amount = str_replace('.','',$detGiro['cb_giro_amount']);
        
            $data = array(
                'cb_trx_hdr_prefix' => $sa_spec_prefix,
                'cb_trx_hdr_year' => $year,
                'cb_trx_hdr_month' => $month,
                'cb_trx_hdr_code'  => $alloc_code,
                'trx_no' => $trx_no,
                'row_no' =>$i,     
                'payment_method' => $detGiro['payment_method'],
                'cash_bank' => $detGiro['cash_bank'],
                'cg_no' => $detGiro['cb_giro_no'],
                'cg_date' => date('Y-m-d',strtotime($detGiro['cb_giro_date'])),            
                'cg_amt' => str_replace(',','.',$cb_giro_amount),
                'status' => $status,
                'user_created'      =>$dataPost['user_created'],
                'date_created'      =>$dataPost['date_created'],
                'time_created'      =>$dataPost['time_created'],
				'user_modified'     =>$this->session->userdata('user_rowID'),
				'date_modified'     =>date('Y-m-d'),
				'time_modified'     =>date('H:i:s')
            );
            $result=$this->db->insert('cb_trx_cg', $data);
        }
        
        if($result){
            return true;
        }else{
            return false;
        }
    }
    
    function simpanDetailPayment($sa_spec_prefix,$alloc_code,$x,$trx_no,$dataPost,$detPay=array()){
        $cb_pay_amount = str_replace('.','',$detPay['cb_pay_amount']);
        
        if($dataPost['payment_type'] == 'P'){
            $amount = str_replace(',','.',$cb_pay_amount) * -1;
        }
        else{
            $amount = str_replace(',','.',$cb_pay_amount);            
        }
        
        $advance_invoice_amount_tmp = str_replace('.','',$detPay['advance_invoice_amount']);
        $advance_invoice_amount = str_replace(',','.',$advance_invoice_amount_tmp);            
    
        if($dataPost['user_created'] == '' && $dataPost['date_created'] == ''){
            
            if(date('Y-m-d',strtotime($dataPost['cb_payment_date'])) != date('Y-m-d')){
                $cb_payment_date = date('Y-m-d');
            }
            else{
                $cb_payment_date = date('Y-m-d',strtotime($dataPost['cb_payment_date']));
            }
            //$cb_payment_date = date('Y-m-d',strtotime($dataPost['cb_payment_date']));
            
            $year = date('Y',strtotime($cb_payment_date));
            $month = date('m',strtotime($cb_payment_date));
    
            $data = array(
                'cb_trx_hdr_prefix' => $sa_spec_prefix,
                'cb_trx_hdr_year' => $year,
                'cb_trx_hdr_month' => $month,
                'cb_trx_hdr_code'  => $alloc_code,
                'row_no' => $x,
                'trx_no' => $trx_no,
                'trx_date' => $cb_payment_date,            
                'advance_invoice_no' => $detPay['advance_invoice_no'],
                'advance_invoice_type' => $dataPost['advance_invoice_type'],
                'advance_invoice_amount' => $advance_invoice_amount,
                'descs' =>$detPay['cb_pay_remark'],
                'trx_amt' => $amount,
                'user_created' => $this->session->userdata('user_id'),
                'date_created' => $cb_payment_date,
                'time_created' => date('H:i:s')
            );
            $result=$this->db->insert('cb_trx_dtl', $data);
        }
        else{
            $cb_payment_date = date('Y-m-d',strtotime($dataPost['cb_payment_date']));
            $year = date('Y',strtotime($cb_payment_date));
            $month = date('m',strtotime($cb_payment_date));
            
            $data = array(
                'cb_trx_hdr_prefix' => $sa_spec_prefix,
                'cb_trx_hdr_year' => $year,
                'cb_trx_hdr_month' => $month,
                'cb_trx_hdr_code'  => $alloc_code,
                'row_no' => $x,
                'trx_no' => $trx_no,
                'trx_date' => $cb_payment_date,            
                'advance_invoice_no' => $detPay['advance_invoice_no'],
                'advance_invoice_type' => $dataPost['advance_invoice_type'],
                'advance_invoice_amount' => $advance_invoice_amount,
                'descs' =>$detPay['cb_pay_remark'],
                'trx_amt' => $amount,
                'user_created'      =>$dataPost['user_created'],
                'date_created'      =>$dataPost['date_created'],
                'time_created'      =>$dataPost['time_created'],
				'user_modified'     =>$this->session->userdata('user_rowID'),
				'date_modified'     =>date('Y-m-d'),
				'time_modified'     =>date('H:i:s')
            );
            $result=$this->db->insert('cb_trx_dtl', $data);
        }
        
        if($result){
            return true;
        }else{
            return false;
        }
    }
    
    function simpan_realization_hdr($sa_spec_prefix, $alloc_code, $x, $trx_no, $dataPost, $detPay)
    {
        $cb_pay_amount = str_replace('.','',$detPay['cb_pay_amount']);
        
        if($dataPost['payment_type'] == 'P'){
            $amount = str_replace(',','.',$cb_pay_amount) * -1;
        }
        else{
            $amount = str_replace(',','.',$cb_pay_amount);            
        }
        
        if(date('Y-m-d',strtotime($dataPost['cb_payment_date'])) != date('Y-m-d')){
            $cb_payment_date = date('Y-m-d');
        }
        else{
            $cb_payment_date = date('Y-m-d',strtotime($dataPost['cb_payment_date']));
        }
        
        $realization_hdr_data = array(
            'prefix' => $sa_spec_prefix,
            'year' => date('Y', strtotime($dataPost['cb_payment_date'])),
            'month' => date('m', strtotime($dataPost['cb_payment_date'])),
            'code' => $alloc_code,
            'row_no' => $x,
            'alloc_no' => $trx_no,
            'alloc_date' => $cb_payment_date,
            'descs' => $detPay['cb_pay_remark'],
            'alloc_amt' => $amount,
            'alloc_mode' => 'A',
            'cb_cash_adv_no' => $detPay['advance_invoice_no'],
            'user_created' => $this->session->userdata('user_rowID'),
            'date_created' => $cb_payment_date,
            'time_created' => date('H:i:s'));
        $result = $this->db->insert('cb_cash_adv_alloc', $realization_hdr_data);
        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }
    
    function edit_realization_hdr($sa_spec_prefix, $alloc_code, $x, $trx_no, $dataPost, $detPay)
    {
        if($dataPost['payment_type'] == 'P'){
            $amount = str_replace('.','',$detPay['cb_pay_amount']) * -1;
        }
        else{
            $amount = str_replace('.','',$detPay['cb_pay_amount']);            
        }
        
        $this->db->set('alloc_date', date('Y-m-d', strtotime($dataPost['cb_payment_date'])));
        $this->db->set('descs', $detPay['cb_pay_remark']);
        $this->db->set('alloc_amt', $amount);
        $this->db->set('user_modified', $this->session->userdata('user_id'));
        $this->db->set('date_modified', date('Y-m-d'));
        $this->db->set('time_modified', date('H:i:s'));
        $this->db->where('prefix', $sa_spec_prefix);
        $this->db->where('year', date('Y', strtotime($dataPost['cb_payment_date'])));
        $this->db->where('month', date('m', strtotime($dataPost['cb_payment_date'])));
        $this->db->where('code', $alloc_code);
        $this->db->where('row_no', $x);
        $this->db->where('alloc_no', $trx_no);
        $result = $this->db->update('cb_cash_adv_alloc');

        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }
    
    function edit_cash_advance($dataPost,$detPay)
    {
        $cb_pay_amount = str_replace('.','',$detPay['cb_pay_amount']);
        
        if($dataPost['payment_type'] == 'P'){
            $amount = str_replace(',','.',$cb_pay_amount) * -1;
        }
        else{
            $amount = str_replace(',','.',$cb_pay_amount);            
        }
                
        $cb_pay_amount_tmp = str_replace('.','',$detPay['cb_pay_amount']);
        $cb_amount = str_replace(',','.',$cb_pay_amount_tmp);
        if($cb_amount > 0){
            $cb_amount = $cb_amount;
        }
        else{
            $cb_amount = $cb_amount * -1;
        }
                
        if(date('Y-m-d',strtotime($dataPost['cb_payment_date'])) != date('Y-m-d')){
            $cb_payment_date = date('Y-m-d');
        }
        else{
            $cb_payment_date = date('Y-m-d',strtotime($dataPost['cb_payment_date']));
        }
        
        $sql = "UPDATE `cb_cash_adv` 
                SET `advance_balance` = advance_balance-(".$amount."), `pay_over_allocation` = pay_over_allocation+".$cb_amount.", 
                    `user_modified` = '".$this->session->userdata('user_id')."', `date_modified` = '".$cb_payment_date."', `time_modified` = '".date('H:i:s')."' 
                WHERE `advance_no` =  '".$detPay['advance_invoice_no']."' AND deleted = 0";
        
        $result = $this->db->query($sql);

        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }
    
    function edit_cash_advance_update($dataPost,$detPay)
    {
        $cb_pay_amount_tmp2 = str_replace('.','',$detPay['cb_pay_amount_tmp']);
        $cb_pay_amount_tmp = str_replace('.','',$detPay['cb_pay_amount_tmp']);
        
        if($dataPost['payment_type'] == 'P'){
            $amount = str_replace(',','.',$cb_pay_amount_tmp2) * -1;
        }
        else{
            $amount =str_replace(',','.',$cb_pay_amount_tmp2);            
        }
        
        $cb_pay_amount = 0;
        $cb_pay_amount_tmp = str_replace(',','.',$cb_pay_amount_tmp);
        if($cb_pay_amount_tmp > 0){
            $cb_pay_amount = $cb_pay_amount_tmp;
        }
        else{
            $cb_pay_amount = $cb_pay_amount_tmp * -1;
        }
        
        if(date('Y-m-d',strtotime($dataPost['cb_payment_date'])) != date('Y-m-d')){
            $cb_payment_date = date('Y-m-d');
        }
        else{
            $cb_payment_date = date('Y-m-d',strtotime($dataPost['cb_payment_date']));
        }
        
        $sql = "UPDATE `cb_cash_adv` 
                SET `advance_balance` = advance_balance+(".$amount."), `pay_over_allocation` = pay_over_allocation-".$cb_pay_amount.", 
                    `user_modified` = '".$this->session->userdata('user_id')."', `date_modified` = '".$cb_payment_date."', `time_modified` = '".date('H:i:s')."' 
                WHERE `advance_no` =  '".$detPay['advance_invoice_no']."' AND deleted = 0";
        
        $result = $this->db->query($sql);

        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }
    
    function get_data_alloc_by_alloc_no($table,$alloc_no)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('alloc_no', $alloc_no);
        $query = $this->db->get();
        return $query->result();
    }
    
    function delete_data_alloc_by_alloc_no($table,$alloc_no){
        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));        
        $this->db->where('deleted',0);
        $this->db->where('alloc_no',$alloc_no);
        $result=$this->db->update($table);	    
        if ($result){
	       return true;
	    }else{
	       return false;
	    } 	
    }
    
    function simpan_deposit_alloc($sa_spec_prefix, $alloc_code, $x, $trx_no, $dataPost, $detPay)
    {
        $cb_pay_amount_tmp = str_replace('.','',$detPay['cb_pay_amount']);
        
        if($dataPost['payment_type'] == 'P'){
            $amount = str_replace(',','.',$cb_pay_amount_tmp) * -1;
        }
        else{
            $amount =str_replace(',','.',$cb_pay_amount_tmp);            
        }
        
        if(date('Y-m-d',strtotime($dataPost['cb_payment_date'])) != date('Y-m-d')){
            $cb_payment_date = date('Y-m-d');
        }
        else{
            $cb_payment_date = date('Y-m-d',strtotime($dataPost['cb_payment_date']));
        }
        
        $alloc_data = array(
            'prefix' => $sa_spec_prefix,
            'year' => date('Y', strtotime($dataPost['cb_payment_date'])),
            'month' => date('m', strtotime($dataPost['cb_payment_date'])),
            'code' => $alloc_code,
            'row_no' => $x,
            'alloc_no' => $trx_no,
            'alloc_date' => $cb_payment_date,
            'descs' => $detPay['cb_pay_remark'],
            'alloc_amt' => $amount,
            'deposit_no' => $detPay['advance_invoice_no'],
            'user_created' => $this->session->userdata('user_rowID'),
            'date_created' => $cb_payment_date,
            'time_created' => date('H:i:s'));
        $result = $this->db->insert('tr_deposit_trx_alloc', $alloc_data);
        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }
    
    function edit_deposit_alloc($sa_spec_prefix, $alloc_code, $x, $trx_no, $dataPost, $detPay)
    {
        if($dataPost['payment_type'] == 'P'){
            $amount = str_replace('.','',$detPay['cb_pay_amount']) * -1;
        }
        else{
            $amount = str_replace('.','',$detPay['cb_pay_amount']);            
        }
        
        $this->db->set('alloc_date', date('Y-m-d', strtotime($dataPost['cb_payment_date'])));
        $this->db->set('descs', $detPay['cb_pay_remark']);
        $this->db->set('alloc_amt', $amount);
        $this->db->set('user_modified', $this->session->userdata('user_id'));
        $this->db->set('date_modified', date('Y-m-d'));
        $this->db->set('time_modified', date('H:i:s'));
        $this->db->where('prefix', $sa_spec_prefix);
        $this->db->where('year', date('Y', strtotime($dataPost['cb_payment_date'])));
        $this->db->where('month', date('m', strtotime($dataPost['cb_payment_date'])));
        $this->db->where('code', $alloc_code);
        $this->db->where('row_no', $x);
        $this->db->where('alloc_no', $trx_no);
        $result = $this->db->update('tr_deposit_trx_alloc');

        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }
    
    function simpan_ar_alloc($sa_spec_prefix, $alloc_code, $x, $trx_no, $dataPost, $detPay)
    {
        $cb_pay_amount_tmp = str_replace('.','',$detPay['cb_pay_amount']);
        
        if($dataPost['payment_type'] == 'P'){
            $amount = str_replace(',','.',$cb_pay_amount_tmp) * -1;
        }
        else{
            $amount = str_replace(',','.',$cb_pay_amount_tmp);            
        }
        
        if(date('Y-m-d',strtotime($dataPost['cb_payment_date'])) != date('Y-m-d')){
            $cb_payment_date = date('Y-m-d');
        }
        else{
            $cb_payment_date = date('Y-m-d',strtotime($dataPost['cb_payment_date']));
        }
        
        $alloc_data = array(
            'prefix' => $sa_spec_prefix,
            'year' => date('Y', strtotime($dataPost['cb_payment_date'])),
            'month' => date('m', strtotime($dataPost['cb_payment_date'])),
            'code' => $alloc_code,
            'row_no' => $x,
            'alloc_no' => $trx_no,
            'alloc_date' => $cb_payment_date,
            'descs' => $detPay['cb_pay_remark'],
            'alloc_amt' => $amount,
            'ar_no' => $detPay['advance_invoice_no'],
            'user_created' => $this->session->userdata('user_rowID'),
            'date_created' => $cb_payment_date,
            'time_created' => date('H:i:s'));
        $result = $this->db->insert('ar_trx_hdr_alloc', $alloc_data);
        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }
    
    function edit_ar_alloc($sa_spec_prefix, $alloc_code, $x, $trx_no, $dataPost, $detPay)
    {
        if($dataPost['payment_type'] == 'P'){
            $amount = str_replace('.','',$detPay['cb_pay_amount']) * -1;
        }
        else{
            $amount = str_replace('.','',$detPay['cb_pay_amount']);            
        }
        
        $this->db->set('alloc_date', date('Y-m-d', strtotime($dataPost['cb_payment_date'])));
        $this->db->set('descs', $detPay['cb_pay_remark']);
        $this->db->set('alloc_amt', $amount);
        $this->db->set('user_modified', $this->session->userdata('user_id'));
        $this->db->set('date_modified', date('Y-m-d'));
        $this->db->set('time_modified', date('H:i:s'));
        $this->db->where('prefix', $sa_spec_prefix);
        $this->db->where('year', date('Y', strtotime($dataPost['cb_payment_date'])));
        $this->db->where('month', date('m', strtotime($dataPost['cb_payment_date'])));
        $this->db->where('code', $alloc_code);
        $this->db->where('row_no', $x);
        $this->db->where('alloc_no', $trx_no);
        $result = $this->db->update('ar_trx_hdr_alloc');

        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }
    
    function simpan_ap_alloc($sa_spec_prefix, $alloc_code, $x, $trx_no, $dataPost, $detPay)
    {
        $cb_pay_amount_tmp = str_replace('.','',$detPay['cb_pay_amount']);
        
        if($dataPost['payment_type'] == 'P'){
            $amount = str_replace(',','.',$cb_pay_amount_tmp) * -1;
        }
        else{
            $amount = str_replace(',','.',$cb_pay_amount_tmp);            
        }            
        
        if(date('Y-m-d',strtotime($dataPost['cb_payment_date'])) != date('Y-m-d')){
            $cb_payment_date = date('Y-m-d');
        }
        else{
            $cb_payment_date = date('Y-m-d',strtotime($dataPost['cb_payment_date']));
        }
        
        $alloc_data = array(
            'prefix' => $sa_spec_prefix,
            'year' => date('Y', strtotime($dataPost['cb_payment_date'])),
            'month' => date('m', strtotime($dataPost['cb_payment_date'])),
            'code' => $alloc_code,
            'row_no' => $x,
            'alloc_no' => $trx_no,
            'alloc_date' => $cb_payment_date,
            'descs' => $detPay['cb_pay_remark'],
            'alloc_amt' => $amount,
            'ap_no' => $detPay['advance_invoice_no'],
            'user_created' => $this->session->userdata('user_rowID'),
            'date_created' => $cb_payment_date,
            'time_created' => date('H:i:s'));
        $result = $this->db->insert('ap_trx_hdr_alloc', $alloc_data);
        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }
    
    function edit_ap_alloc($sa_spec_prefix, $alloc_code, $x, $trx_no, $dataPost, $detPay)
    {
        if($dataPost['payment_type'] == 'P'){
            $amount = str_replace('.','',$detPay['cb_pay_amount']) * -1;
        }
        else{
            $amount = str_replace('.','',$detPay['cb_pay_amount']);            
        }
        
        $this->db->set('alloc_date', date('Y-m-d', strtotime($dataPost['cb_payment_date'])));
        $this->db->set('descs', $detPay['cb_pay_remark']);
        $this->db->set('alloc_amt', $amount);
        $this->db->set('user_modified', $this->session->userdata('user_id'));
        $this->db->set('date_modified', date('Y-m-d'));
        $this->db->set('time_modified', date('H:i:s'));
        $this->db->where('prefix', $sa_spec_prefix);
        $this->db->where('year', date('Y', strtotime($dataPost['cb_payment_date'])));
        $this->db->where('month', date('m', strtotime($dataPost['cb_payment_date'])));
        $this->db->where('code', $alloc_code);
        $this->db->where('row_no', $x);
        $this->db->where('alloc_no', $trx_no);
        $result = $this->db->update('ap_trx_hdr_alloc');

        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }
    
    function simpan_commission_alloc($sa_spec_prefix, $alloc_code, $x, $trx_no, $dataPost, $detPay)
    {
        $cb_pay_amount_tmp = str_replace('.','',$detPay['cb_pay_amount']);
        
        if($dataPost['payment_type'] == 'P'){
            $amount = str_replace(',','.',$cb_pay_amount_tmp) * -1;
        }
        else{
            $amount = str_replace(',','.',$cb_pay_amount_tmp);            
        }                                    
        
        if(date('Y-m-d',strtotime($dataPost['cb_payment_date'])) != date('Y-m-d')){
            $cb_payment_date = date('Y-m-d');
        }
        else{
            $cb_payment_date = date('Y-m-d',strtotime($dataPost['cb_payment_date']));
        }
        
        $alloc_data = array(
            'prefix' => $sa_spec_prefix,
            'year' => date('Y', strtotime($dataPost['cb_payment_date'])),
            'month' => date('m', strtotime($dataPost['cb_payment_date'])),
            'code' => $alloc_code,
            'row_no' => $x,
            'alloc_no' => $trx_no,
            'alloc_date' => $cb_payment_date,
            'descs' => $detPay['cb_pay_remark'],
            'alloc_amt' => $amount,
            'commission_no' => $detPay['advance_invoice_no'],
            'user_created' => $this->session->userdata('user_rowID'),
            'date_created' => $cb_payment_date,
            'time_created' => date('H:i:s'));
        $result = $this->db->insert('tr_commission_trx_alloc', $alloc_data);
        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }
    
    function edit_commission_alloc($sa_spec_prefix, $alloc_code, $x, $trx_no, $dataPost, $detPay)
    {
        if($dataPost['payment_type'] == 'P'){
            $amount = str_replace('.','',$detPay['cb_pay_amount']) * -1;
        }
        else{
            $amount = str_replace('.','',$detPay['cb_pay_amount']);            
        }
        
        $this->db->set('alloc_date', date('Y-m-d', strtotime($dataPost['cb_payment_date'])));
        $this->db->set('descs', $detPay['cb_pay_remark']);
        $this->db->set('alloc_amt', $amount);
        $this->db->set('user_modified', $this->session->userdata('user_id'));
        $this->db->set('date_modified', date('Y-m-d'));
        $this->db->set('time_modified', date('H:i:s'));
        $this->db->where('prefix', $sa_spec_prefix);
        $this->db->where('year', date('Y', strtotime($dataPost['cb_payment_date'])));
        $this->db->where('month', date('m', strtotime($dataPost['cb_payment_date'])));
        $this->db->where('code', $alloc_code);
        $this->db->where('row_no', $x);
        $this->db->where('alloc_no', $trx_no);
        $result = $this->db->update('tr_commission_trx_alloc');

        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }
    
    function deleteDetailChegue($sa_spec_prefix,$alloc_date_year,$alloc_date_month,$alloc_code){
        
        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));    
        $this->db->where('deleted', 0);    
        $this->db->where('cb_trx_hdr_prefix',$sa_spec_prefix);
        $this->db->where('cb_trx_hdr_year',$alloc_date_year);
        $this->db->where('cb_trx_hdr_month',$alloc_date_month);
        $this->db->where('cb_trx_hdr_code',$alloc_code);
        $result=$this->db->update('cb_trx_cg');
        if ($result){
	       return true;
	    }else{
	       return false;
	    } 	   
    }
    
    function deleteDetailPay($sa_spec_prefix,$alloc_date_year,$alloc_date_month,$alloc_code){
	    $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));        
        $this->db->where('deleted', 0);    
        $this->db->where('cb_trx_hdr_prefix',$sa_spec_prefix);
        $this->db->where('cb_trx_hdr_year',$alloc_date_year);
        $this->db->where('cb_trx_hdr_month',$alloc_date_month);
        $this->db->where('cb_trx_hdr_code',$alloc_code);
        $result=$this->db->update('cb_trx_dtl');
        if ($result){
	       return true;
	    }else{
	       return false;
	    } 	
    }
    
    public function delete_by_id($id,$tabel)
	{
		$this->db->where('kd_kec', $id);
		$this->db->delete($tabel);
	}
    

    function get_account()
    {
        $this->db->select('g.*');
        $this->db->from('gl_coa as g ');
        $this->db->where('g.deleted', 0);
        $this->db->where('g.is_cash =', 'Y');
        $this->db->or_where('g.is_bank =', 'Y');
        $this->db->order_by('g.rowID', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    
    function get_by_id($cb_prefix,$cb_year,$cb_month,$cb_code)
    {
        $this->db->select('*');
        $this->db->from('cb_trx_hdr as a');
        $this->db->join('gl_coa as b','b.rowID=a.coa_rowID','left');
        $this->db->join('gl_coa as c','c.rowID=a.fund_trf_coa_rowID','left');
        $this->db->where('a.prefix =', $cb_prefix);
        $this->db->where('a.year =', $cb_year);
        $this->db->where('a.month =', $cb_month);
        $this->db->where('a.code =', $cb_code);
        $query = $this->db->get();
        return $query->row();
        //,
        //CONCAT(b.acc_cd,' - ',b.acc_name) AS cash_bank,
        //concat(c.acc_cd,' - ',c.acc_name) as pay_to_cd
    }
    
    function get_data_by_id($cb_prefix,$cb_year,$cb_month,$cb_code)
    {
        $this->db->select('a.*');
        $this->db->from('cb_trx_hdr as a');
        $this->db->where('a.deleted =', 0);
        $this->db->where('a.prefix =', $cb_prefix);
        $this->db->where('a.year =', $cb_year);
        $this->db->where('a.month =', $cb_month);
        $this->db->where('a.code =', $cb_code);
        $query = $this->db->get();
        return $query->row();
        //,
        //CONCAT(b.acc_cd,' - ',b.acc_name) AS cash_bank,
        //concat(c.acc_cd,' - ',c.acc_name) as pay_to_cd
    }
    
    function get_cb_by_id($cb_prefix,$cb_year,$cb_month,$cb_code)
    {
        $this->db->select('*');
        $this->db->from('cb_trx_hdr as a');
        $this->db->join('gl_coa as b','b.rowID=a.coa_rowID','left');
        $this->db->join('sa_debtor as c','c.rowID=a.debtor_creditor_rowID','left');
        $this->db->where('a.deleted', 0);
        $this->db->where('a.prefix =', $cb_prefix);
        $this->db->where('a.year =', $cb_year);
        $this->db->where('a.month =', $cb_month);
        $this->db->where('a.code =', $cb_code);
        $query = $this->db->get();
        return $query->row();
        //,
        //CONCAT(b.acc_cd,' - ',b.acc_name) AS cash_bank,
        //concat(c.acc_cd,' - ',c.acc_name) as pay_to_cd
    }
    
    function get_cb_customer_by_id($cb_prefix,$cb_year,$cb_month,$cb_code)
    {
        $this->db->select('*');
        $this->db->from('cb_trx_hdr as a');
        $this->db->join('gl_coa as b','b.rowID=a.coa_rowID','left');
        $this->db->join('sa_creditor as c','c.rowID=a.debtor_creditor_rowID','left');
        $this->db->where('a.deleted =', 0);
        $this->db->where('a.prefix =', $cb_prefix);
        $this->db->where('a.year =', $cb_year);
        $this->db->where('a.month =', $cb_month);
        $this->db->where('a.code =', $cb_code);
        $query = $this->db->get();
        return $query->row();
        //,
        //CONCAT(b.acc_cd,' - ',b.acc_name) AS cash_bank,
        //concat(c.acc_cd,' - ',c.acc_name) as pay_to_cd
    }
    
    function get_by_id_table($table,$id)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('rowID =', $id);
        $query = $this->db->get();
        return $query->row();
    }
    
    function get_all_advance_list_by_debtor_id($debtor_id)
    {
        $this->db->select('a.*,
							b.by_jo as by_jo,
							b.only_driver as only_driver,
							b.fare_trip as fare_trip,
							b.advance_name,
							c.debtor_cd as debtor_code,
							c.debtor_name as debtor_name,
							d.police_no as police_no,
							e.type_cd as type_code,
							e.type_name as type_name,
							f.fare_trip_cd as fare_trip_no,
							g.destination_no as destination_from_no,
							g.destination_name as destination_from_name,
							h.destination_no as destination_to_no,
							h.destination_name as destination_to_name');
        $this->db->from('cb_cash_adv AS a');
        $this->db->join('sa_advance_type AS b', 'b.rowID=a.advance_type_rowID', 'LEFT');
        $this->db->join('sa_debtor AS c', 'c.rowID=a.employee_driver_rowID', 'LEFT');
        $this->db->join('sa_vehicle AS d', 'd.rowID=a.vehicle_rowID', 'LEFT');
        $this->db->join('sa_vehicle_type AS e', 'e.rowID=a.vehicle_type_rowID', 'LEFT');
        $this->db->join('sa_fare_trip_hdr AS f', 'f.rowID = a.fare_trip_rowID', 'LEFT');
        $this->db->join('sa_destination AS g', 'g.rowID=f.destination_from_rowID',
            'LEFT');
        $this->db->join('sa_destination AS h', 'h.rowID=f.destination_to_rowID', 'LEFT');
        $this->db->join('sa_users AS i', 'i.rowID=a.user_created', 'LEFT');
        $this->db->where('a.deleted =', 0);
        $this->db->where('a.employee_driver_rowID =', $debtor_id);

        $this->db->order_by('a.advance_no', 'desc');
        //echo $this->db->last_query();exit();
        return $this->db->get()->result();
        //return $this->db->get()->result_array(); //if($partial_data>0){$this->db->where('i.dep_rowID =',$dep_rowID)};

    }
    
    function get_all_invoice_list_by_debtor_id($id)
    {

        $this->db->select("a.*,
                CONCAT(b.debtor_cd,' - ',b.debtor_name) AS debtor_name", false);
        $this->db->from('ar_trx_hdr as a');
        $this->db->join('sa_debtor as b', 'b.rowID = a.debtor_rowID',
            'left');
        $this->db->where('a.deleted', 0);
        $this->db->where('a.debtor_rowID', $id);
        $this->db->order_by('a.trx_no', 'desc');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }

    }
    
    function get_all_ap_list_by_debtor_id($id)
    {

        $this->db->select("a.*,
                CONCAT(b.creditor_cd,' - ',b.creditor_name) AS creditor_name, c.descs as creditor_type", false);
        $this->db->from('ap_trx_hdr as a');
        $this->db->join('sa_creditor as b', 'b.rowID = a.creditor_rowID',
            'left');
        $this->db->join('sa_creditor_type as c', 'c.rowID = a.ap_type',
            'left');
        $this->db->where('a.deleted', 0);
        $this->db->where('a.creditor_rowID', $id);
        $this->db->order_by('a.trx_no', 'desc');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }

    }
    
    function get_all_deposit_list_by_debtor_id($id)
    {

        $this->db->select("a.*,
                CONCAT(b.debtor_cd,' - ',b.debtor_name) AS debtor_name, b.type", false);
        $this->db->from('tr_deposit_trx as a');
        $this->db->join('sa_debtor as b', 'b.rowID = a.debtor_rowID',
            'left');
        $this->db->where('a.deleted', 0);
        $this->db->where('a.debtor_rowID', $id);
        $this->db->order_by('a.deposit_number', 'desc');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }

    }
    
    function get_all_commission_list_by_debtor_id($id)
    {

        $this->db->select("a.*, b.commission_no, b.until_date,
                CONCAT(c.debtor_cd,' - ',c.debtor_name) AS debtor_name, c.type", false);
        $this->db->from('tr_commission_trx_dtl as a');
        $this->db->join('tr_commission_trx as b', 'b.rowID = a.commission_rowID',
            'left');
        $this->db->join('sa_debtor as c', 'c.rowID = a.debtor_rowID',
            'left');
        $this->db->where('a.debtor_rowID', $id);
        $this->db->order_by('b.commission_no', 'desc');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }

    }
    
    function delete_data_header($cb_prefix,$cb_year,$cb_month,$cb_code)
    {

        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));
        $this->db->where('prefix', $cb_prefix);
        $this->db->where('year', $cb_year);
        $this->db->where('month', $cb_month);
        $this->db->where('code', $cb_code);
        return $this->db->update('cb_trx_hdr');

    }
    
    function delete_data_detail_giro($cb_prefix,$cb_year,$cb_month,$cb_code)
    {

        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));
        $this->db->where('cb_trx_hdr_prefix', $cb_prefix);
        $this->db->where('cb_trx_hdr_year', $cb_year);
        $this->db->where('cb_trx_hdr_month', $cb_month);
        $this->db->where('cb_trx_hdr_code', $cb_code);
        return $this->db->update('cb_trx_cg');

    }
    
    
    function delete_data_detail_Pay($cb_prefix,$cb_year,$cb_month,$cb_code)
    {

        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));
        $this->db->where('cb_trx_hdr_prefix', $cb_prefix);
        $this->db->where('cb_trx_hdr_year', $cb_year);
        $this->db->where('cb_trx_hdr_month', $cb_month);
        $this->db->where('cb_trx_hdr_code', $cb_code);
        return $this->db->update('cb_trx_dtl');

    }
    
    function delete_data_realization($cb_prefix,$cb_year,$cb_month,$cb_code)
    {

        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));
        $this->db->where('prefix', $cb_prefix);
        $this->db->where('year', $cb_year);
        $this->db->where('month', $cb_month);
        $this->db->where('code', $cb_code);
        return $this->db->update('cb_cash_adv_alloc');

    }
    
    function get_all_record_data($start_date,$end_date)
    {

        $sql = "SELECT a.*, CONCAT(c.acc_cd, ' - ', c.acc_name) AS cash_bank, concat(d.acc_cd, ' - ', d.acc_name) as pay_to_cd 
        FROM (`cb_trx_hdr` as a) LEFT JOIN `gl_coa` as c ON `c`.`rowID` = `a`.`coa_rowID` 
                                LEFT JOIN `gl_coa` as d ON `d`.`rowID` = `a`.`fund_trf_coa_rowID`
                                 LEFT JOIN sa_users as e ON e.rowID = a.user_created
        WHERE `e`.`dep_rowID` = ".$this->session->userdata('dep_rowID')." AND `a`.`deleted` = 0 AND a.trx_date BETWEEN '".$start_date."' AND '".$end_date."' AND 
                    (`a`.`transaction_type` = 'cash_advance' OR `a`.`transaction_type` = 'general' OR `a`.`transaction_type` = 'uang_makan' OR `a`.`transaction_type` = 'stand_by') 
        ORDER BY `a`.`rowID` desc";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result();
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
    
    function get_data_not_release($trx_no)
    {
        $sql = "SELECT * FROM cb_trx_cg
                WHERE deleted = 0 AND (payment_method = 'cheque' OR payment_method = 'giro') AND trx_no = '$trx_no' AND status = 0 AND reference_release_no = '' 
                ORDER BY rowID";
        
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    function get_data_released($trx_no)
    {
        $sql = "SELECT * FROM cb_trx_cg
                WHERE deleted = 0 AND (payment_method = 'cheque' OR payment_method = 'giro') AND trx_no = '$trx_no' AND (status = 1 OR status = 2) AND reference_release_no != ''
                ORDER BY rowID";
        
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    function get_data_release_reference($trx_no)
    {
        $sql = "SELECT b.trx_no, b.descs, b.trx_amt 
                FROM cb_trx_cg as a INNER JOIN cb_trx_hdr as b ON a.trx_no = b.trx_no 
                WHERE a.deleted = 0 AND b.deleted = 0 AND a.reference_release_no = '$trx_no'
                ORDER BY b.trx_no ASC";
        
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    function get_data_header($trx_no)
    {
        $sql = "SELECT * FROM cb_trx_hdr
                WHERE deleted = 0 AND trx_no = '$trx_no'
                ORDER BY rowID";
        
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    function get_data_detail_by_advance_invoice_no($advance_invoice_no)
    {
        $sql = "SELECT * FROM cb_trx_dtl
                WHERE deleted = 0 AND advance_invoice_no = '$advance_invoice_no'";
        
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    function get_data_header_by_type_driver($transaction_type,$debtor_id,$trx_date)
    {
        $sql = "SELECT * FROM cb_trx_hdr
                WHERE deleted = 0 AND transaction_type = '$transaction_type' AND debtor_creditor_rowID = $debtor_id AND manual_debtor_creditor_type = 'D' AND trx_date = '$trx_date'
                ORDER BY rowID";
        
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    function get_data_detail_by_advance_invoice_type_no($payment_type, $advance_invoice_type, $advance_invoice_no)
    {
        $sql = "SELECT * FROM cb_trx_dtl as a INNER JOIN cb_trx_hdr as b ON a.trx_no = b.trx_no
                WHERE a.deleted = 0 AND b.deleted = 0 AND b.payment_type = '$payment_type' AND a.advance_invoice_type = '$advance_invoice_type' AND a.advance_invoice_no = '$advance_invoice_no'";
        
        $query = $this->db->query($sql);
        return $query->row();
    }
    
}

/* End of file model.php */
