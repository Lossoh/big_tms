<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Cheque_giro_report_model extends CI_Model
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
    
    function get_all_records_list($start_date, $end_date, $status)
    {
        $this->db->select("a.trx_date, a.payment_type, a.transaction_type, a.descs, a.debtor_creditor_rowID, a.debtor_creditor_type, a.manual_debtor_creditor,
                            a.manual_debtor_creditor_type, b.*, c.acc_name");
        $this->db->from('cb_trx_hdr as a');
        $this->db->join('cb_trx_cg as b', 'b.trx_no = a.trx_no');
        $this->db->join('gl_coa as c', 'c.rowID = b.cash_bank');
        $this->db->where('a.deleted',0);
        $this->db->where('b.deleted',0);
        if($status == 'released'){
            $this->db->where('b.status', 1);
            $this->db->where('b.reference_release_no != ', '');            
        }
        else{
            $this->db->where('b.status != ', 1);
            $this->db->where('b.reference_release_no', '');
        }
        $this->db->where("a.trx_date BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->db->where("(b.payment_method = 'cheque' OR b.payment_method = 'giro')");
        $this->db->order_by('a.rowID', 'desc');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
           return $query->result();
        } else {
            return null;
        }
        
    }
    
}

/* End of file model.php */