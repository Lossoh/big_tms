<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Balance_sheet_report_model extends CI_Model
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
    
    function get_account()
    {
        $this->db->select('*');
        $this->db->from('gl_coa');
        $this->db->where('deleted', 0);
        $this->db->where('acc_cd LIKE', '1%');
        $this->db->or_where('acc_cd LIKE', '2%');
        $this->db->or_where('acc_cd LIKE', '3%');
        $this->db->order_by('acc_cd', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    
    function get_account_capital()
    {
        $this->db->select('*');
        $this->db->from('gl_coa');
        $this->db->where('deleted', 0);
        $this->db->where('acc_type', 'D');
        $this->db->where('acc_cd LIKE', '3%');
        $this->db->order_by('acc_cd', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    
    function get_account_profit_loss_by_code($code)
    {
        $this->db->select('*');
        $this->db->from('gl_coa');
        $this->db->where('deleted', 0);
        $this->db->where("acc_cd LIKE '$code%'");
        $this->db->order_by('acc_cd', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    
    function get_data_saldo_gl_by_coa($coa_rowID,$start_date,$end_date)
    {
        $this->db->select('SUM(b.trx_amt) as total_saldo, b.coa_rowID, b.date_created, b.deleted, a.deleted');
        $this->db->from('gl_trx_hdr AS a');
        $this->db->join('gl_trx_dtl AS b', 'a.journal_no=b.gl_trx_hdr_journal_no', 'LEFT');
        //$this->db->group_by('b.coa_rowID, b.deleted, a.deleted');
        $this->db->where("b.coa_rowID = ".$coa_rowID." AND b.date_created BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->db->where("a.deleted",0);
        $this->db->where("b.deleted",0);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return 0;
        } 
    }
    
    function get_data_debit_gl_by_coa($coa_rowID,$start_date,$end_date)
    {
        $this->db->select('SUM(b.trx_amt) as total_debit, b.row_no, b.coa_rowID, b.date_created, b.deleted, a.deleted');
        $this->db->from('gl_trx_hdr AS a');
        $this->db->join('gl_trx_dtl AS b', 'a.journal_no=b.gl_trx_hdr_journal_no', 'LEFT');
        //$this->db->group_by('b.row_no, b.coa_rowID, b.deleted, a.deleted');
        $this->db->where("b.coa_rowID = ".$coa_rowID." AND b.date_created BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->db->where("a.deleted",0);
        $this->db->where("b.deleted",0);
        $this->db->where("b.row_no",1);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return 0;
        }
    }
    
    function get_data_credit_gl_by_coa($coa_rowID,$start_date,$end_date)
    {
        $this->db->select('SUM(b.trx_amt) as total_credit, b.row_no, b.coa_rowID, b.date_created, b.deleted, a.deleted');
        $this->db->from('gl_trx_hdr AS a');
        $this->db->join('gl_trx_dtl AS b', 'a.journal_no=b.gl_trx_hdr_journal_no', 'LEFT');
        //$this->db->group_by('b.row_no, b.coa_rowID, b.deleted, a.deleted');
        $this->db->where("b.coa_rowID = ".$coa_rowID." AND b.date_created BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->db->where("a.deleted",0);
        $this->db->where("b.deleted",0);
        $this->db->where("b.row_no",2);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return 0;
        }
    }
    
    function get_data_total_profit_loss_by_coa($coa_rowID,$start_date,$end_date)
    {
        $this->db->select('SUM(b.trx_amt) as total, b.coa_rowID, b.date_created, b.deleted, a.deleted');
        $this->db->from('gl_trx_hdr AS a');
        $this->db->join('gl_trx_dtl AS b', 'a.journal_no=b.gl_trx_hdr_journal_no', 'LEFT');
        $this->db->join('gl_coa AS c', 'b.coa_rowID=c.rowID', 'LEFT');
        //$this->db->group_by('b.coa_rowID, b.deleted, a.deleted');
        $this->db->where("b.coa_rowID = ".$coa_rowID." AND b.date_created BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->db->where("a.deleted",0);
        $this->db->where("b.deleted",0);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return 0;
        } 
    }
    
    
    function get_data_profit_loss_gl_by_coa($coa_rowID,$start_date,$end_date)
    {
        $this->db->select('SUM(b.trx_amt) as total, b.coa_rowID, b.date_created, b.deleted, a.deleted');
        $this->db->from('gl_trx_hdr AS a');
        $this->db->join('gl_trx_dtl AS b', 'a.journal_no=b.gl_trx_hdr_journal_no', 'LEFT');
        //$this->db->group_by('b.coa_rowID, b.deleted, a.deleted');
        $this->db->where("b.coa_rowID = ".$coa_rowID." AND b.date_created BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->db->where("a.deleted",0);
        $this->db->where("b.deleted",0);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return 0;
        } 
    }
    
    function get_data_profit_loss()
    {
        $this->db->select('*');
        $this->db->from('gl_profit_loss');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return 0;
        } 
    }
    
    function get_data_total_by_profit_loss($acc_profit_loss,$start_date,$end_date)
    {
        $this->db->select('SUM(b.trx_amt) as total, b.coa_rowID, b.date_created, b.deleted, a.deleted');
        $this->db->from('gl_trx_hdr AS a');
        $this->db->join('gl_trx_dtl AS b', 'a.journal_no=b.gl_trx_hdr_journal_no', 'LEFT');
        $this->db->join('gl_coa AS c', 'b.coa_rowID=c.rowID', 'LEFT');
        //$this->db->group_by('b.coa_rowID, b.deleted, a.deleted');
        $this->db->where("c.acc_profit_loss = ".$acc_profit_loss." AND b.date_created BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->db->where("a.deleted",0);
        $this->db->where("b.deleted",0);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return 0;
        } 
    }
    
}

/* End of file model.php */