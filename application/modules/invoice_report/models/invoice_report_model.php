<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Invoice_report_model extends CI_Model
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
        $this->db->select('a.*,b.weight');
        $this->db->from('ar_trx_hdr AS a');
        $this->db->join('tr_jo_trx_hdr AS b', 'a.jo_no = b.jo_no', 'LEFT');
        $this->db->where("a.deleted",0);
        $this->db->where("b.deleted",0);
        $this->db->where("a.trx_date BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->db->order_by('a.trx_no', 'asc');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
        
    }
    
    function get_all_records_list_by_debtor($start_date, $end_date, $debtor_id)
    {
        $this->db->select('a.*,b.weight');
        $this->db->from('ar_trx_hdr AS a');
        $this->db->join('tr_jo_trx_hdr AS b', 'a.jo_no = b.jo_no', 'LEFT');
        $this->db->where("a.deleted",0);
        $this->db->where("b.deleted",0);
        $this->db->where("a.debtor_rowID",$debtor_id);
        $this->db->where("a.trx_date BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->db->order_by('a.trx_no', 'asc');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
        
    }
    
    function get_data_cash_bank_by_invoice_no_old($trx_no)
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
    
    function get_data_cash_bank_by_invoice_no($trx_no)
    {
        $this->db->select('a.trx_no, a.trx_date, a.advance_invoice_amount, c.acc_name');
        $this->db->from('cb_trx_dtl as a');
        $this->db->join('cb_trx_hdr as b','a.trx_no = b.trx_no','left');
        $this->db->join('gl_coa as c','b.coa_rowID = c.rowID','left');
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
        $this->db->from('sa_debtor');
        $this->db->where('type', 'C');
        $this->db->where('deleted', 0);
        $query = $this->db->get();
        return $query->result();
    }
    
    function get_data_debtor_by_id($rowID)
    {
        $this->db->select('*');
        $this->db->from('sa_debtor');
        $this->db->where('rowID', $rowID);
        $query = $this->db->get();
        return $query->row();
    }
    
}

/* End of file model.php */