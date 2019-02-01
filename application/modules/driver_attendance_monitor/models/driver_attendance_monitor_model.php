<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Driver_attendance_monitor_model extends CI_Model
{
    function get_all_records_list_1($start_date, $end_date)
    {
        $start_time = "08:00:00";
        $end_time = "10:00:00";
        
        $this->db->select('a.*, b.rowID as debtor_id, b.debtor_name');
        $this->db->from('tr_log_driver_attendance AS a');
        $this->db->join('sa_debtor AS b', 'b.finger_rowID = a.finger_id', 'LEFT');
        $this->db->where("DATE(a.attendance_time) BETWEEN '".$start_date."' AND '".$end_date."' AND 
                            TIME(a.attendance_time) BETWEEN '".$start_time."' AND '".$end_time."' AND
                            a.terminal_id = ".$this->session->userdata('dep_rowID'));
        $this->db->order_by('a.attendance_time, b.debtor_name', 'asc');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
        
    }
    
    function get_all_records_list_2($start_date, $end_date)
    {
        $start_time = "10:00:01";
        $end_time = "13:00:00";
        
        $this->db->select('a.*, b.rowID as debtor_id, b.debtor_name');
        $this->db->from('tr_log_driver_attendance AS a');
        $this->db->join('sa_debtor AS b', 'b.finger_rowID = a.finger_id', 'LEFT');
        $this->db->where("DATE(a.attendance_time) BETWEEN '".$start_date."' AND '".$end_date."' AND 
                            TIME(a.attendance_time) BETWEEN '".$start_time."' AND '".$end_time."' AND
                            a.terminal_id = ".$this->session->userdata('dep_rowID'));
        $this->db->order_by('a.attendance_time, b.debtor_name', 'asc');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
        
    }
    
    function get_data_attendance($rowID)
    {
        $sql = "SELECT a.*, b.rowID as debtor_id FROM tr_log_driver_attendance as a INNER JOIN sa_debtor AS b ON b.finger_rowID = a.finger_id
                WHERE a.rowID = ".$rowID;
        
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    function get_data_cb_header($trx_no)
    {
        $sql = "SELECT * FROM cb_trx_hdr
                WHERE deleted = 0 AND trx_no = '$trx_no'
                ORDER BY rowID";
        
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    function get_data_ca_by_debtor($debtor_rowID,$advance_date)
    {
        $sql = "SELECT * FROM cb_cash_adv
                WHERE deleted = 0 AND employee_driver_rowID = ".$debtor_rowID." AND advance_date = '".$advance_date."'";
        
        $query = $this->db->query($sql);
        return $query->row();
    }
    
}

/* End of file model.php */