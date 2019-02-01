<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model
{
    function get_data_cb_adv_by_date($until_date){
        $this->db->select('a.*, b.debtor_name, c.advance_name, d.police_no, e.type_name');
        $this->db->from('cb_cash_adv as a');
        $this->db->join('sa_debtor as b', 'a.employee_driver_rowID = b.rowID','left');
        $this->db->join('sa_advance_type as c', 'a.advance_type_rowID = c.rowID','left');
        $this->db->join('sa_vehicle as d', 'a.vehicle_rowID = d.rowID','left');
        $this->db->join('sa_vehicle_type as e', 'a.vehicle_type_rowID = e.rowID','left');
        $this->db->where('a.deleted =', 0);
        $this->db->where('a.advance_date =',$until_date);
        $this->db->order_by('a.advance_no', 'asc');

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }
    }

    function get_data_realization_by_date($until_date){
        $this->db->select('a.*, alloc.alloc_amt, b.debtor_name, c.advance_name, d.police_no, e.type_name');
        $this->db->from('cb_cash_adv as a');
        $this->db->join('cb_cash_adv_alloc as alloc', 'a.advance_no = alloc.cb_cash_adv_no','left');
        $this->db->join('sa_debtor as b', 'a.employee_driver_rowID = b.rowID','left');
        $this->db->join('sa_advance_type as c', 'a.advance_type_rowID = c.rowID','left');
        $this->db->join('sa_vehicle as d', 'a.vehicle_rowID = d.rowID','left');
        $this->db->join('sa_vehicle_type as e', 'a.vehicle_type_rowID = e.rowID','left');
        $this->db->where('a.deleted =', 0);
        $this->db->where('alloc.deleted =', 0);
        $this->db->where('alloc.alloc_mode =', 'R');
        $this->db->where('alloc.alloc_date =',$until_date);
        $this->db->order_by('a.trx_no', 'asc');

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }
    }
    
    function get_data_cb_adv_vehicle_by_date($start_date,$end_date){
        $sql = "SELECT `a`.`deleted`, `a`.`advance_date`, `a`.`vehicle_type_rowID`, `b`.`type_name`, count(a.vehicle_type_rowID) as jumlah_vehicle 
                FROM (`cb_cash_adv` as a) JOIN `sa_vehicle_type` as b ON `a`.`vehicle_type_rowID` = `b`.`rowID` 
                GROUP BY `a`.`vehicle_type_rowID`, `b`.`type_name` 
                HAVING `a`.`deleted` = 0 AND `a`.`advance_date` BETWEEN '".$start_date."' and '".$end_date."'
                ORDER BY `b`.`type_name` asc";
                
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
        
    }
    
    function get_data_cb_adv_realization_by_date($start_date,$end_date){
        $sql = "SELECT `a`.`deleted`, `b`.`deleted`, `c`.`deleted`, `b`.`advance_date`, `b`.`employee_driver_rowID`, `d`.`debtor_name`, `d`.`type`, SUM(c.received_weight) as total_tonase 
                FROM `cb_cash_adv_alloc` as a LEFT JOIN `cb_cash_adv` as b ON `a`.`alloc_no` = `b`.`trx_no` 
    				LEFT JOIN `tr_do_trx` as c ON `a`.`alloc_no` = `c`.`trx_no` 
    				LEFT JOIN `sa_debtor` as d ON `b`.`employee_driver_rowID` = `d`.`rowID` 
                GROUP BY `a`.`deleted`, `b`.`deleted`, `c`.`deleted`, `b`.`employee_driver_rowID`, `d`.`debtor_name`, `d`.`type` 
                HAVING `a`.`deleted` = 0 AND `b`.`deleted` = 0 AND `c`.`deleted` = 0 AND `d`.`type` = 'D' AND `b`.`advance_date` BETWEEN '".$start_date."' and '".$end_date."' 
                ORDER BY `total_tonase` desc, `d`.`debtor_name` asc
                LIMIT 0,10";
                
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
        
    }
    
    function get_data_cb_adv_pending_by_driver_date($driver_id,$start_date,$end_date){
        $sql = "SELECT `employee_driver_rowID`, `deleted`, `trx_no`, `advance_date`, COUNT(`trx_no`) as total_pending 
                FROM `cb_cash_adv` 
                GROUP BY `employee_driver_rowID`, `deleted`, `trx_no`
                HAVING `deleted` = 0 AND `trx_no` = '' AND `employee_driver_rowID` = ".$driver_id." AND `advance_date` BETWEEN '".$start_date."' and '".$end_date."'";
                
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
        
    }
    
    function get_sum_data_cb_adv_by_debtor($debtor_id,$until_date){
        $this->db->select('employee_driver_rowID, deleted, advance_date, SUM(advance_amount + advance_extra_amount) as total_amount');
        $this->db->from('cb_cash_adv');
        $this->db->group_by('employee_driver_rowID, deleted, advance_date');
        $this->db->having('deleted =', 0);
        $this->db->having('advance_date =',$until_date);
        $this->db->having('employee_driver_rowID', $debtor_id);
        $this->db->order_by('advance_no', 'asc');

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->row();
        } else
        {
            return null;
        }
    }
    
    function get_sum_data_realization_by_debtor($debtor_id,$until_date){
        $this->db->select('b.employee_driver_rowID, b.deleted, a.deleted, a.alloc_mode, a.alloc_date, SUM(a.alloc_amt) as total_amount');
        $this->db->from('cb_cash_adv_alloc as a');
        $this->db->join('cb_cash_adv as b','a.cb_cash_adv_no = b.advance_no');
        $this->db->group_by('b.employee_driver_rowID, a.alloc_mode, a.alloc_date, a.deleted, b.deleted');
        $this->db->having('a.deleted =', 0);
        $this->db->having('b.deleted =', 0);
        $this->db->having('a.alloc_mode =', 'R');
        $this->db->having('a.alloc_date =',$until_date);
        $this->db->having('b.employee_driver_rowID', $debtor_id);
        $this->db->order_by('a.alloc_no', 'asc');

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->row();
        } else
        {
            return null;
        }
    }
    
}

