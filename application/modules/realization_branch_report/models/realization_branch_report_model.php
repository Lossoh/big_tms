<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Realization_branch_report_model extends CI_Model
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
    
    function get_data_realization_by_date($start_date,$end_date){
        $sql = "SELECT `a`.*, `alloc`.`alloc_amt`, `b`.`debtor_name`, `c`.`advance_name`, `d`.`police_no`, `e`.`type_name` 
                FROM (`cb_cash_adv` as a) LEFT JOIN `cb_cash_adv_alloc` as alloc ON `a`.`advance_no` = `alloc`.`cb_cash_adv_no` 
                    LEFT JOIN `sa_debtor` as b ON `a`.`employee_driver_rowID` = `b`.`rowID` 
                    LEFT JOIN `sa_advance_type` as c ON `a`.`advance_type_rowID` = `c`.`rowID` 
                    LEFT JOIN `sa_vehicle` as d ON `a`.`vehicle_rowID` = `d`.`rowID` 
                    LEFT JOIN `sa_vehicle_type` as e ON `a`.`vehicle_type_rowID` = `e`.`rowID` 
                    LEFT JOIN `sa_users` as f ON `alloc`.`user_created` = `f`.`rowID` 
                WHERE `a`.`deleted` = 0 AND `alloc`.`deleted` = 0 AND `alloc`.`alloc_mode` = 'R' 
                    AND CONCAT(`alloc`.`date_created`,' ',`alloc`.`time_created`) BETWEEN '".$start_date."' and '".$end_date."'
                    AND f.dep_rowID = ".$this->session->userdata('dep_rowID')."
                ORDER BY `a`.`trx_no` asc";

        $query = $this->db->query($sql);
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
    
}

/* End of file model.php */