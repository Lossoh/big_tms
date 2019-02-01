<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Service_history_report_model extends CI_Model
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
    
	function get_all_data_vehicle(){
        $this->db->select('*');
        $this->db->from('sa_vehicle');
        $this->db->where('deleted',0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    
    function get_all_records_list($start_date, $end_date)
    {
        $sql = "SELECT `b`.* FROM (`gl_trx_hdr` AS a) JOIN `gl_trx_dtl` AS b ON `a`.`journal_no`=`b`.`gl_trx_hdr_journal_no` 
                WHERE  b.date_created BETWEEN '".$start_date."' AND '".$end_date."' AND `a`.`deleted` = 0 AND `b`.`deleted` = 0 
                ORDER BY `b`.`date_created`, `b`.`gl_trx_hdr_journal_no` asc";
        $query = $this->db->query($sql); 
        if ($query->num_rows() > 0) {
           return $query->result();
        } else {
            return null;
        }
        
    }
    
}

/* End of file model.php */