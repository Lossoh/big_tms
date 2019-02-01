<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Driver_attendance_model extends CI_Model
{
    function get_all_records_list($start_date, $end_date)
    {
        $this->db->select('a.*,b.debtor_cd, b.debtor_name');
        $this->db->from('tr_log_driver_attendance AS a');
        $this->db->join('sa_debtor AS b', 'b.rowID=a.debtor_id', 'LEFT');
        $this->db->where("a.attendance_time BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->db->order_by('a.attendance_time, b.debtor_name', 'asc');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
        
    }
    
}

/* End of file model.php */