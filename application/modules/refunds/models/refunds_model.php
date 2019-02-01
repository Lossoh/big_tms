<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Refunds_model extends CI_Model
{
   
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function get_all_records_list($partial_data, $dep_rowID, $start_date, $end_date)
    {
        $this->db->select('a.alloc_no, a.alloc_date, a.descs, a.alloc_amt,  
                            b.prefix, b.year, b.month, b.code, b.advance_no, b.advance_amount, b.advance_extra_amount, b.pay_over_allocation,
                            c.debtor_cd, c.debtor_name, d.police_no, e.username');
        $this->db->from('cb_cash_adv_alloc as a');
        $this->db->join('cb_cash_adv AS b', 'b.advance_no=a.cb_cash_adv_no', 'LEFT');
        $this->db->join('sa_debtor AS c', 'c.rowID=b.employee_driver_rowID', 'LEFT');
        $this->db->join('sa_vehicle AS d', 'd.rowID=b.vehicle_rowID', 'LEFT');
        $this->db->join('sa_users AS e', 'a.user_created=e.rowID', 'LEFT');
        $this->db->where('a.deleted', 0);
        $this->db->where('b.deleted', 0);
        $this->db->where('a.alloc_mode', 'F');
        $this->db->where("a.alloc_date BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->db->order_by('a.alloc_no', 'desc');
        
        return $this->db->get()->result();
    }
    
}

/* End of file model.php */
