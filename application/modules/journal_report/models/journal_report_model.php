<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Journal_report_model extends CI_Model
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
    
    function get_all_records_list($start_date, $end_date)
    {
        $this->db->select('a.descs as description, b.*, c.acc_cd, c.acc_name');
        $this->db->from('gl_trx_hdr AS a');
        $this->db->join('gl_trx_dtl AS b', 'a.journal_no=b.gl_trx_hdr_journal_no', 'LEFT');
        $this->db->join('gl_coa AS c', 'b.coa_rowID=c.rowID', 'LEFT');
        $this->db->where("a.date_created BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->db->where("a.deleted",0);
        $this->db->where("b.deleted",0);
        $this->db->order_by('a.date_created, b.rowID', 'asc');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
        
    }
        
}

/* End of file model.php */