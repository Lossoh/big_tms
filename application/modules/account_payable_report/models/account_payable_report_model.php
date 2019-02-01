<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Account_payable_report_model extends CI_Model
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
    
    function get_all_records_list($start_date, $end_date)
    {
        $this->db->select('a.*, b.creditor_name');
        $this->db->from('ap_trx_hdr AS a');
        $this->db->join('sa_creditor AS b','a.creditor_rowID = b.rowID','left');
        $this->db->where("a.ap_kb_type",'ap');
        $this->db->where("a.deleted",0);
        $this->db->where("a.trx_date BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->db->order_by('a.trx_no', 'asc');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
        
    }
    
    function get_all_records_list_by_creditor($start_date, $end_date, $creditor_id)
    {
        $this->db->select('a.*, b.creditor_name');
        $this->db->from('ap_trx_hdr AS a');
        $this->db->join('sa_creditor AS b','a.creditor_rowID = b.rowID','left');
        $this->db->where("a.ap_kb_type",'ap');
        $this->db->where("a.deleted",0);
        $this->db->where("a.creditor_rowID",$creditor_id);
        $this->db->where("a.trx_date BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->db->order_by('a.trx_no', 'asc');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
        
    }
    
    function get_data_cash_bank_by_account_payable_no($trx_no)
    {
        $this->db->select('a.trx_no, a.trx_date, a.advance_invoice_amount, b.cg_date, b.cg_amt, c.acc_name');
        $this->db->from('cb_trx_dtl as a');
        $this->db->join('cb_trx_cg as b','a.trx_no = b.trx_no','left');
        $this->db->join('gl_coa as c','b.cash_bank = c.rowID','left');
        $this->db->where('a.advance_invoice_no', $trx_no);
        $this->db->where('a.deleted', 0);
        $this->db->where('b.deleted', 0);
        $query = $this->db->get();
        return $query->result();
    }
    
    function get_data_cash_bank_by_trx_no($trx_no)
    {
        $this->db->select('*');
        $this->db->from('cb_trx_dtl');
        $this->db->where('trx_no', $trx_no);
        $this->db->where('deleted', 0);
        $query = $this->db->get();
        return $query->result();
    }
    
    function get_data_company()
    {
        $this->db->select('*');
        $this->db->from('sa_creditor');
        $this->db->where('deleted', 0);
        $this->db->order_by('creditor_name', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    
    function get_data_creditor_by_id($rowID)
    {
        $this->db->select('*');
        $this->db->from('sa_creditor');
        $this->db->where('rowID', $rowID);
        $query = $this->db->get();
        return $query->row();
    }
    
}

/* End of file model.php */