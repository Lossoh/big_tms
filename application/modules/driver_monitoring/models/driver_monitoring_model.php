<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Driver_monitoring_model extends CI_Model
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
    
    function get_all_record_debtor()
    {
        $this->db->select('*');
        $this->db->from('sa_debtor');
        $this->db->where('type','D');
        $this->db->order_by('debtor_name');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    
    function get_monitoring_data_alloc_by_date_debtor($debtor_id,$date){
        $sql = "SELECT b.alloc_no, CONCAT(a.date_created,' ',a.time_created) as date_ca, CONCAT(b.date_created,' ',b.time_created) as date_rea
                FROM cb_cash_adv as a INNER JOIN cb_cash_adv_alloc as b ON a.advance_no = b.cb_cash_adv_no
                WHERE a.employee_driver_rowID = ".$debtor_id." AND b.alloc_mode = 'R' AND b.alloc_date = '".$date."'
                ORDER BY b.date_created, b.time_created";

        $query = $this->db->query($sql);
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
            
    }
    
    function get_by_id($tabel, $id)
    {

        $this->db->from($tabel);
        $this->db->where('rowID', $id);
        $query = $this->db->get();
        return $query->row();
    }
    
    
}

/* End of file model.php */
