<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Driver_attendance_model extends CI_Model
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
        $this->db->select('a.*,b.debtor_cd, b.debtor_name');
        $this->db->from('tr_log_attendance AS a');
        $this->db->join('sa_debtor AS b', 'b.rowID=a.debtor_id', 'LEFT');
        $this->db->where("DATE(a.date_created) BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->db->order_by('a.date_created, b.debtor_name', 'asc');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
        
    }
    
}

/* End of file model.php */