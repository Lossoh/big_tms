<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class General_ledger_report_model extends CI_Model
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
        $this->db->select('g.*');
        $this->db->from('gl_coa as g ');
        $this->db->where('g.deleted', 0);
        //$this->db->where('g.is_cash =', 'Y');
        //$this->db->or_where('g.is_bank =', 'Y');
        $this->db->order_by('g.acc_cd', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    
    function get_debtor()
    {
        $this->db->select('*');
        $this->db->from('sa_debtor');
        $this->db->where('deleted', 0);
        $this->db->order_by('type, debtor_name', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function get_creditor()
    {
        $this->db->select('*');
        $this->db->from('sa_creditor');
        $this->db->where('deleted', 0);
        $this->db->order_by('creditor_name', 'asc');
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
    
    function get_all_records_list($coa_rowID,$debtor_creditor_type,$debtor_creditor_id,$start_date, $end_date)
    {
        $this->db->select('b.*');
        $this->db->from('gl_trx_hdr AS a');
        $this->db->join('gl_trx_dtl AS b', 'a.journal_no=b.gl_trx_hdr_journal_no', 'LEFT');
        $this->db->where("b.coa_rowID = ".$coa_rowID." AND b.date_created BETWEEN '".$start_date."' AND '".$end_date."'");
        if($debtor_creditor_type != 'All'){
            $this->db->where("b.debtor_creditor_type",$debtor_creditor_type);     
            if($debtor_creditor_id != ""){       
                $this->db->where("b.debtor_creditor_rowID",$debtor_creditor_id);
            }            
        }
        $this->db->where("a.deleted",0);
        $this->db->where("b.deleted",0);
        $this->db->order_by('b.date_created, b.gl_trx_hdr_journal_no', 'asc');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
        
    }
    
    function get_balanced($coa_rowID,$debtor_creditor_type,$debtor_creditor_id,$start_date, $end_date)
    {
        $this->db->select('b.trx_amt, b.coa_rowID, b.debtor_creditor_type, b.debtor_creditor_rowID, b.date_created, a.deleted, b.deleted');
        $this->db->from('gl_trx_hdr AS a');
        $this->db->join('gl_trx_dtl AS b', 'a.journal_no=b.gl_trx_hdr_journal_no', 'LEFT');
        $this->db->where("b.coa_rowID = ".$coa_rowID." AND b.date_created BETWEEN '".$start_date."' AND '".$end_date."'");
        if($debtor_creditor_type != 'All'){
            $this->db->where("b.debtor_creditor_type",$debtor_creditor_type);     
            if($debtor_creditor_id != ""){       
                $this->db->where("b.debtor_creditor_rowID",$debtor_creditor_id);
            }            
        }
        $this->db->where("a.deleted",0);
        $this->db->where("b.deleted",0);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
        
    }
    
}

/* End of file model.php */