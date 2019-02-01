<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Account_payable_model extends CI_Model
{
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
    
    function get_by_id($tabel, $id)
    {

        $this->db->from($tabel);
        $this->db->where('rowID', $id);
        $query = $this->db->get();
        return $query->row();
    }
    
    function get_all_record_data($start_date,$end_date)
    {

        $this->db->select("a.*,
                CONCAT(b.creditor_cd,' - ',b.creditor_name) AS creditor_name, c.descs AS creditor_type", false);
        $this->db->from('ap_trx_hdr as a');
        $this->db->join('sa_creditor as b', 'b.rowID = a.creditor_rowID',
            'left');
        $this->db->join('sa_creditor_type as c', 'c.rowID = a.ap_type',
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
    
    function get_detail_header($trx_no)
    {

        $this->db->select("a.*, b.creditor_name", false);
        $this->db->from('ap_trx_hdr as a');
        $this->db->join('sa_creditor as b', 'b.rowID = a.creditor_rowID', 'left');
        $this->db->where('a.deleted', 0);
        $this->db->where('a.trx_no', $trx_no);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }

    }
    
    function get_data_header($trx_no){
        $this->db->select('*');
        $this->db->from('ap_trx_hdr');
        $this->db->where('trx_no', $trx_no);
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
    
    function get_data_detail($trx_no){
        $this->db->select('a.*,b.jo_type,b.price_amount,b.wholesale,b.price_20ft,b.price_40ft,b.price_45ft');
        $this->db->from('ap_trx_dtl_do as a');
        $this->db->join('tr_jo_trx_hdr as b', 'a.jo_no=b.jo_no');        
        $this->db->where('a.trx_no', $trx_no);
        $this->db->where('a.deleted', 0);
        $this->db->order_by('a.rowID','asc');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }
    }

    function check_invoice($trx_no){
        $this->db->select('*');
        $this->db->from('ap_trx_dtl_do');
        $this->db->where('trx_no', $trx_no);
        $this->db->where('deleted', 0);
        $this->db->where('invoice_no !=', '');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }
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
    
    function get_data_do($do_no){
        $this->db->select('*');
        $this->db->from('ap_trx_dtl_do');
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
        $this->db->where('a.status <>', 1);
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
    
    function simpan_ap_hdr($sa_spec_prefix, $alloc_code,$alloc_no, $dataPost){
        if($dataPost['user_created'] == '' && $dataPost['date_created'] == ''){
            /*
            if(date('Y-m-d',strtotime($dataPost['ap_date'])) != date('Y-m-d')){
                $ap_date = date('Y-m-d');
            }
            else{
                $ap_date = date('Y-m-d',strtotime($dataPost['ap_date']));
            }
            */
            $ap_date = date('Y-m-d',strtotime($dataPost['ap_date']));
            
            $year = date('Y',strtotime($ap_date));
            $month = date('m',strtotime($ap_date));
    
            $data= array(
                'prefix' =>$sa_spec_prefix,
                'year'   =>$year,
                'month'  =>$month,
                'code'   =>$alloc_code,
                'ap_kb_type' => 'ap',
                'trx_no' =>$alloc_no,
                'trx_date'=>$ap_date,
                'come_back'=>date('Y-m-d',strtotime($dataPost['come_back'])),
                'ap_type' =>$dataPost['ap_type'],
                'creditor_rowID' =>$dataPost['creditor_id'],
                'ref_no' =>$dataPost['ref_no'],
                'po_no' =>$dataPost['po_no'],
                'jo_no' =>$dataPost['do_jo_no'],
                'base_amt'     =>str_replace('.','',$dataPost['base_amt']), 
                'tax_amt'      =>str_replace('.','',$dataPost['tax_amt']),
                'wth_amt'      =>0,//str_replace('.','',$dataPost['TotalWth']),
                'total_amt'    =>str_replace('.','',$dataPost['total_amt']),
                'total_ap'    =>str_replace('.','',$dataPost['total_ap']),
                'total_diff'    =>str_replace('.','',$dataPost['total_diff']),
                'alloc_amt'    =>0,
                'bal_amt'      =>0,//str_replace(',','',$dataPost['GrandTotal']),
                'without_tax'  => (isset($dataPost['cekDa'])) ? $dataPost['cekDa'] : 0,
                'category'     => '',
                'descs'        => $dataPost['remark'],
                'user_created' =>$this->session->userdata('user_rowID'),
                'date_created' =>$ap_date,
                'time_created' =>date('H:i:s'),
            );
            $result=$this->db->insert('ap_trx_hdr', $data);
        }
        else{
            $ap_date = date('Y-m-d',strtotime($dataPost['ap_date']));
            $year = date('Y',strtotime($ap_date));
            $month = date('m',strtotime($ap_date));
            
            $data= array(
                'prefix' =>$sa_spec_prefix,
                'year'   =>$year,
                'month'  =>$month,
                'code'   =>$alloc_code,
                'ap_kb_type' => 'ap',
                'trx_no' =>$alloc_no,
                'trx_date'=>$ap_date,
                'come_back'=>date('Y-m-d',strtotime($dataPost['come_back'])),
                'ap_type' =>$dataPost['ap_type'],
                'creditor_rowID' =>$dataPost['creditor_id'],
                'ref_no' =>$dataPost['ref_no'],
                'po_no' =>$dataPost['po_no'],
                'jo_no' =>$dataPost['do_jo_no'],
                'base_amt'     =>str_replace('.','',$dataPost['base_amt']), 
                'tax_amt'      =>str_replace('.','',$dataPost['tax_amt']),
                'wth_amt'      =>0,//str_replace('.','',$dataPost['TotalWth']),
                'total_amt'    =>str_replace('.','',$dataPost['total_amt']),
                'total_ap'    =>str_replace('.','',$dataPost['total_ap']),
                'total_diff'    =>str_replace('.','',$dataPost['total_diff']),
                'alloc_amt'    =>0,
                'bal_amt'      =>0,//str_replace(',','',$dataPost['GrandTotal']),
                'without_tax'  => (isset($dataPost['cekDa'])) ? $dataPost['cekDa'] : 0,
                'category'     => '',
                'descs'        => $dataPost['remark'],
                'user_created'      =>$dataPost['user_created'],
                'date_created'      =>$dataPost['date_created'],
                'time_created'      =>$dataPost['time_created'],
				'user_modified'     =>$this->session->userdata('user_rowID'),
				'date_modified'     =>date('Y-m-d'),
				'time_modified'     =>date('H:i:s')
            );
            $result=$this->db->insert('ap_trx_hdr', $data);
        }    
        if ($result){
            return true;
        }else{
            return false;
        }
    }
    
    function simpan_data_detail_do($sa_spec_prefix, $alloc_code, $alloc_no, $dataPost, $detDO = array())
    {
        if($dataPost['user_created'] == '' && $dataPost['date_created'] == ''){
            /*
            if(date('Y-m-d',strtotime($dataPost['ap_date'])) != date('Y-m-d')){
                $ap_date = date('Y-m-d');
            }
            else{
                $ap_date = date('Y-m-d',strtotime($dataPost['ap_date']));
            }
            */
            $ap_date = date('Y-m-d',strtotime($dataPost['ap_date']));
            
            $year = date('Y',strtotime($ap_date));
            $month = date('m',strtotime($ap_date));
            
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
                'deliver_weight' => $detDO['do_weight'],
                'received_date' => date('Y-m-d', strtotime($detDO['received_date'])),
                'received_weight' => $detDO['received_weight'],
                'amount_ap'   =>str_replace('.','',$detDO['amount_ap']),
                'status' => 0,
                'user_created' => $this->session->userdata('user_rowID'),
                'date_created' => $ap_date,
                'time_created' => date('H:i:s'));
            $result = $this->db->insert('ap_trx_dtl_do', $data);
        }
        else{
            $ap_date = date('Y-m-d',strtotime($dataPost['ap_date']));
            $year = date('Y',strtotime($ap_date));
            $month = date('m',strtotime($ap_date));
            
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
                'deliver_weight' => $detDO['do_weight'],
                'received_date' => date('Y-m-d', strtotime($detDO['received_date'])),
                'received_weight' => $detDO['received_weight'],
                'amount_ap'   =>str_replace('.','',$detDO['amount_ap']),
                'status' => 0,
                'user_created'      =>$dataPost['user_created'],
                'date_created'      =>$dataPost['date_created'],
                'time_created'      =>$dataPost['time_created'],
				'user_modified'     =>$this->session->userdata('user_rowID'),
				'date_modified'     =>date('Y-m-d'),
				'time_modified'     =>date('H:i:s')
            );
            $result = $this->db->insert('ap_trx_dtl_do', $data);
        }
        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }
    
    function save_gl_header($sa_spec_prefix, $new_gl_coa_code, $gl_coa_no, $reference_no, $reference_date, $dataPost)
    {
        
        $total_debit = str_replace('.','',$dataPost['total_amt']);
        $amount = str_replace(',','.',$total_debit);
        
        if($dataPost['user_created'] == '' && $dataPost['date_created'] == ''){
            /*
            if(date('Y-m-d',strtotime($dataPost['ap_date'])) != date('Y-m-d')){
                $gl_date = date('Y-m-d');
            }
            else{
                $gl_date = date('Y-m-d',strtotime($dataPost['ap_date']));
            }
            */
            
            $gl_date = date('Y-m-d',strtotime($dataPost['ap_date']));
            
            $year = date('Y',strtotime($gl_date));
            $month = date('m',strtotime($gl_date));
           
            $gl_trx_hdr_data = array(
                'prefix' => $sa_spec_prefix,
                'year' => $year,
                'month' => $month,
                'code' => $new_gl_coa_code,
                'journal_no' => $gl_coa_no,
                'journal_date' => $gl_date,
                'journal_type' => 'account payable',
                'descs' => empty($dataPost['remark']) ? strtoupper($dataPost['ref_no']) : strtoupper($dataPost['remark'].', REFERENCE NO : '.$dataPost['ref_no']),
                'trx_amt' => $amount,
                'ref_no' => $reference_no,
                'ref_date' => $reference_date,
                'user_created' => $this->session->userdata('user_rowID'),
                'date_created' => $gl_date,
                'time_created' => date('H:i:s')
            );
                
            $result = $this->db->insert('gl_trx_hdr', $gl_trx_hdr_data);
        }
        else{
            $gl_date = date('Y-m-d',strtotime($dataPost['ap_date']));
            $year = date('Y',strtotime($gl_date));
            $month = date('m',strtotime($gl_date));
            
            $gl_trx_hdr_data = array(
                'prefix' => $sa_spec_prefix,
                'year' => $year,
                'month' => $month,
                'code' => $new_gl_coa_code,
                'journal_no' => $gl_coa_no,
                'journal_date' => $gl_date,
                'journal_type' => 'account payable',
                'descs' => empty($dataPost['remark']) ? strtoupper($dataPost['ref_no']) : strtoupper($dataPost['remark'].', REFERENCE NO : '.$dataPost['ref_no']),
                'trx_amt' => $amount,
                'ref_no' => $reference_no,
                'ref_date' => $reference_date,
                'user_created'      =>$dataPost['user_created'],
                'date_created'      =>$dataPost['date_created'],
                'time_created'      =>$dataPost['time_created'],
				'user_modified'     =>$this->session->userdata('user_rowID'),
				'date_modified'     =>date('Y-m-d'),
				'time_modified'     =>date('H:i:s')
            );
                
            $result = $this->db->insert('gl_trx_hdr', $gl_trx_hdr_data);
        }
        
        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }
    
    function save_gl_detail_debit($sa_spec_prefix, $new_gl_coa_code, $gl_coa_no, $coa_rowID, $descs, $trx_amt, $debtor_creditor_type, $reference_debtor_creditor_id, $reference_no, 
            $reference_date, $dataPost)
    {   
        
        $trx_amt_tmp = str_replace('.','',$trx_amt);
        $amount = str_replace(',','.',$trx_amt_tmp);
        
        if($dataPost['user_created'] == '' && $dataPost['date_created'] == ''){
            /*
            if(date('Y-m-d',strtotime($dataPost['ap_date'])) != date('Y-m-d')){
                $gl_date = date('Y-m-d');
            }
            else{
                $gl_date = date('Y-m-d',strtotime($dataPost['ap_date']));
            }
            */
            
            $gl_date = date('Y-m-d',strtotime($dataPost['ap_date']));
            
            $year = date('Y',strtotime($gl_date));
            $month = date('m',strtotime($gl_date));
            
            $gl_trx_dtl_d_data = array(
                'gl_trx_hdr_prefix' => $sa_spec_prefix,
                'gl_trx_hdr_year' => $year,
                'gl_trx_hdr_month' => $month,
                'gl_trx_hdr_code' => $new_gl_coa_code,
                'row_no' => 1,
                'gl_trx_hdr_journal_no' => $gl_coa_no,
                'gl_trx_hdr_journal_date' => $gl_date,
                'coa_rowID' => $coa_rowID,
                'descs' => '',
                'trx_amt' => $amount,
                'dep_rowID' => $this->session->userdata('dep_rowID'),
                'debtor_creditor_type' => $debtor_creditor_type,
                'debtor_creditor_rowID' => $reference_debtor_creditor_id,
                'gl_trx_hdr_ref_no' => $reference_no,
                'gl_trx_hdr_ref_date' => $reference_date,
                'modul' => 'CB',
                'cash_flow' => 'Y',
                'base_amt' => 0,
                'tax_no' => '',
                'user_created' => $this->session->userdata('user_rowID'),
                'date_created' => $gl_date,
                'time_created' => date('H:i:s')
            );
            
            $result = $this->db->insert('gl_trx_dtl', $gl_trx_dtl_d_data);
        }
        else{
            $gl_date = date('Y-m-d',strtotime($dataPost['ap_date']));
            $year = date('Y',strtotime($gl_date));
            $month = date('m',strtotime($gl_date));
            
            $gl_trx_dtl_d_data = array(
                'gl_trx_hdr_prefix' => $sa_spec_prefix,
                'gl_trx_hdr_year' => $year,
                'gl_trx_hdr_month' => $month,
                'gl_trx_hdr_code' => $new_gl_coa_code,
                'row_no' => 1,
                'gl_trx_hdr_journal_no' => $gl_coa_no,
                'gl_trx_hdr_journal_date' => $gl_date,
                'coa_rowID' => $coa_rowID,
                'descs' => '',
                'trx_amt' => $amount,
                'dep_rowID' => $this->session->userdata('dep_rowID'),
                'debtor_creditor_type' => $debtor_creditor_type,
                'debtor_creditor_rowID' => $reference_debtor_creditor_id,
                'gl_trx_hdr_ref_no' => $reference_no,
                'gl_trx_hdr_ref_date' => $reference_date,
                'modul' => 'CB',
                'cash_flow' => 'Y',
                'base_amt' => 0,
                'tax_no' => '',
                'user_created'      =>$dataPost['user_created'],
                'date_created'      =>$dataPost['date_created'],
                'time_created'      =>$dataPost['time_created'],
				'user_modified'     =>$this->session->userdata('user_rowID'),
				'date_modified'     =>date('Y-m-d'),
				'time_modified'     =>date('H:i:s')
            );
            
            $result = $this->db->insert('gl_trx_dtl', $gl_trx_dtl_d_data);
        }
        
        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
        
    }
    
    function save_gl_detail_credit($sa_spec_prefix, $new_gl_coa_code, $gl_coa_no, $coa_rowID, $descs, $trx_amt, $debtor_creditor_type, $reference_debtor_creditor_id, $reference_no, 
            $reference_date, $dataPost)
    {   
        $trx_amt_tmp = str_replace('.','',$trx_amt);
        $amount = str_replace(',','.',$trx_amt_tmp);
        
        if($dataPost['user_created'] == '' && $dataPost['date_created'] == ''){
            /*
            if(date('Y-m-d',strtotime($dataPost['ap_date'])) != date('Y-m-d')){
                $gl_date = date('Y-m-d');
            }
            else{
                $gl_date = date('Y-m-d',strtotime($dataPost['ap_date']));
            }
            */
            
            $gl_date = date('Y-m-d',strtotime($dataPost['ap_date']));
            
            $year = date('Y',strtotime($gl_date));
            $month = date('m',strtotime($gl_date));
            
            $gl_trx_dtl_d_data = array(
                'gl_trx_hdr_prefix' => $sa_spec_prefix,
                'gl_trx_hdr_year' => $year,
                'gl_trx_hdr_month' => $month,
                'gl_trx_hdr_code' => $new_gl_coa_code,
                'row_no' => 2,
                'gl_trx_hdr_journal_no' => $gl_coa_no,
                'gl_trx_hdr_journal_date' => $gl_date,
                'coa_rowID' => $coa_rowID,
                'descs' => empty($dataPost['remark']) ? strtoupper($dataPost['ref_no']) : strtoupper($dataPost['remark'].', REFERENCE NO : '.$dataPost['ref_no']),
                'trx_amt' => $amount * -1,
                'dep_rowID' => $this->session->userdata('dep_rowID'),
                'debtor_creditor_type' => $debtor_creditor_type,
                'debtor_creditor_rowID' => $reference_debtor_creditor_id,
                'gl_trx_hdr_ref_no' => $reference_no,
                'gl_trx_hdr_ref_date' => $reference_date,
                'modul' => 'CB',
                'cash_flow' => 'Y',
                'base_amt' => 0,
                'tax_no' => '',
                'user_created' => $this->session->userdata('user_rowID'),
                'date_created' => $gl_date,
                'time_created' => date('H:i:s')
            );
            
            $result = $this->db->insert('gl_trx_dtl', $gl_trx_dtl_d_data);
        }
        else{
            $gl_date = date('Y-m-d',strtotime($dataPost['ap_date']));
            $year = date('Y',strtotime($gl_date));
            $month = date('m',strtotime($gl_date));
    
            $gl_trx_dtl_d_data = array(
                'gl_trx_hdr_prefix' => $sa_spec_prefix,
                'gl_trx_hdr_year' => $year,
                'gl_trx_hdr_month' => $month,
                'gl_trx_hdr_code' => $new_gl_coa_code,
                'row_no' => 2,
                'gl_trx_hdr_journal_no' => $gl_coa_no,
                'gl_trx_hdr_journal_date' => $gl_date,
                'coa_rowID' => $coa_rowID,
                'descs' => empty($dataPost['remark']) ? strtoupper($dataPost['ref_no']) : strtoupper($dataPost['remark'].', REFERENCE NO : '.$dataPost['ref_no']),
                'trx_amt' => $amount * -1,
                'dep_rowID' => $this->session->userdata('dep_rowID'),
                'debtor_creditor_type' => $debtor_creditor_type,
                'debtor_creditor_rowID' => $reference_debtor_creditor_id,
                'gl_trx_hdr_ref_no' => $reference_no,
                'gl_trx_hdr_ref_date' => $reference_date,
                'modul' => 'CB',
                'cash_flow' => 'Y',
                'base_amt' => 0,
                'tax_no' => '',
                'user_created'      =>$dataPost['user_created'],
                'date_created'      =>$dataPost['date_created'],
                'time_created'      =>$dataPost['time_created'],
				'user_modified'     =>$this->session->userdata('user_rowID'),
				'date_modified'     =>date('Y-m-d'),
				'time_modified'     =>date('H:i:s')
            );
            
            $result = $this->db->insert('gl_trx_dtl', $gl_trx_dtl_d_data);
        }
        
        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
        
    }
    
    function delete_ap_hdr($trx_no){
        $this->db->set('deleted',1);
        $this->db->set('user_deleted',$this->session->userdata('user_rowID'));
        $this->db->set('date_deleted',date('Y-m-d'));
        $this->db->set('time_deleted',date('H:i:s'));
        $this->db->where('deleted',0);
        $this->db->where('trx_no',$trx_no);
        $result=$this->db->update('ap_trx_hdr');
        if ($result){
            return true;
        }else{
            return false;
        } 
         
    }
    
    function delete_ap_trx_dtl_do($trx_no){
        $this->db->set('deleted',1);
        $this->db->set('user_deleted',$this->session->userdata('user_rowID'));
        $this->db->set('date_deleted',date('Y-m-d'));
        $this->db->set('time_deleted',date('H:i:s'));
        $this->db->where('deleted',0);
        $this->db->where('trx_no',$trx_no);
        $result=$this->db->update('ap_trx_dtl_do');
        if ($result){
            return true;
        }else{
            return false;
        } 
        
    }
    
    function delete_gl_header($trx_no)
    {

        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));
        $this->db->where('deleted', 0);
        $this->db->where('ref_no', $trx_no);
        return $this->db->update('gl_trx_hdr');

    }
    
    function delete_gl_detail($trx_no)
    {

        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));
        $this->db->where('deleted', 0);
        $this->db->where('gl_trx_hdr_ref_no', $trx_no);
        return $this->db->update('gl_trx_dtl');

    }

}

/* End of file model.php */
