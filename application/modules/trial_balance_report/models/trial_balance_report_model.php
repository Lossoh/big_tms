<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Trial_balance_report_model extends CI_Model
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
    
    function get_account()
    {
        $this->db->select('*');
        $this->db->from('gl_coa');
        $this->db->where('deleted', 0);
        $this->db->order_by('acc_cd', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    
    function get_data_by_row_id($table,$rowID){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('rowID',$rowID);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
        
    }
    
    function get_all_records_list($coa_rowID, $start_date, $end_date)
    {
        $sql = "SELECT `b`.* FROM (`gl_trx_hdr` AS a) JOIN `gl_trx_dtl` AS b ON `a`.`journal_no`=`b`.`gl_trx_hdr_journal_no` 
                WHERE `b`.`coa_rowID` = ".$coa_rowID." AND b.date_created BETWEEN '".$start_date."' AND '".$end_date."' AND `a`.`deleted` = 0 AND `b`.`deleted` = 0 
                ORDER BY `b`.`date_created`, `b`.`gl_trx_hdr_journal_no` asc";
        $query = $this->db->query($sql); 
        if ($query->num_rows() > 0) {
           return $query->result();
        } else {
            return null;
        }
        
    }

    function get_ending_balance_yearly($coa_rowID, $year)
    {
        $sql = "SELECT * FROM gl_ending_balance_yearly 
                WHERE coa_rowID = ".$coa_rowID." AND year = ".$year;
        $query = $this->db->query($sql); 
        if ($query->num_rows() > 0) {
           return $query->row();
        } else {
            return null;
        }
        
    }
    
    function get_sum_data_by_row_id($coa_rowID, $start_date, $end_date){
        $this->db->select_sum('b.trx_amt');
        $this->db->from('gl_trx_hdr AS a');
        $this->db->join('gl_trx_dtl AS b', 'a.journal_no=b.gl_trx_hdr_journal_no', 'LEFT');
        $this->db->where("b.coa_rowID = ".$coa_rowID." AND b.date_created BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->db->where("a.deleted",0);
        $this->db->where("b.deleted",0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
        
    }
    
    
    function get_sum_data_debit_by_row_id($coa_rowID, $start_date, $end_date){
        $this->db->select_sum('b.trx_amt');
        $this->db->from('gl_trx_hdr AS a');
        $this->db->join('gl_trx_dtl AS b', 'a.journal_no=b.gl_trx_hdr_journal_no', 'LEFT');
        $this->db->where("b.coa_rowID = ".$coa_rowID." AND b.date_created BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->db->where("a.deleted",0);
        $this->db->where("b.deleted",0);
        $this->db->where("b.row_no",1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
        
    }
    
    function get_sum_data_credit_by_row_id($coa_rowID, $start_date, $end_date){
        $this->db->select_sum('b.trx_amt');
        $this->db->from('gl_trx_hdr AS a');
        $this->db->join('gl_trx_dtl AS b', 'a.journal_no=b.gl_trx_hdr_journal_no', 'LEFT');
        $this->db->where("b.coa_rowID = ".$coa_rowID." AND b.date_created BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->db->where("a.deleted",0);
        $this->db->where("b.deleted",0);
        $this->db->where("b.row_no",2);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
        
    }
}

/* End of file model.php */