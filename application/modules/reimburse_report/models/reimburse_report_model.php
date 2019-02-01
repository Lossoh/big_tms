<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Reimburse_report_model extends CI_Model
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
        $this->db->select("a.*, b.advance_name",false);
		$this->db->from('tr_reimburse_trx_hdr as a');
		$this->db->join('sa_advance_category as b', 'b.rowID = a.advance_type_rowID');
        $this->db->where('a.deleted', 0);
        $this->db->where("a.reimburse_date BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->db->order_by('a.reimburse_number','asc');

        $query=$this->db->get();
        
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_advance_detail_by_reimburse_number($reimburse_number)
    {
        $this->db->select('a.*, b.advance_date');
        $this->db->from('tr_reimburse_trx_adv_dtl as a');
        $this->db->join('tr_advance_trx_hdr as b', 'a.advance_number = b.advance_number');
        $this->db->where('a.deleted', 0);
        $this->db->where('b.deleted', 0);
        $this->db->where('a.reimburse_number', $reimburse_number);
        $query = $this->db->get();
        return $query->result();
    }
    
}

/* End of file model.php */