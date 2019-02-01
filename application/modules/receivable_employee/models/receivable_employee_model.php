<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Receivable_employee_model extends CI_Model
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
    
    function get_debtor_by_id($debtor_id){
        $this->db->select('*');
        $this->db->from('sa_debtor');
        $this->db->where('rowID',$debtor_id);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
        
    }
    
    function get_data_cb_adv_by_debtor($debtor_id,$until_date){
        $this->db->select('a.*,b.advance_name');
        $this->db->from('cb_cash_adv as a');
        $this->db->join('sa_advance_type as b','a.advance_type_rowID=b.rowID');
        $this->db->where('a.deleted =', 0);
        $this->db->where('a.advance_date <=',$until_date);
        $this->db->where('a.employee_driver_rowID', $debtor_id);
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
    
    function get_sum_data_cb_adv_by_debtor($debtor_id,$until_date){
        $this->db->select('employee_driver_rowID, deleted, advance_date, SUM(advance_amount + advance_extra_amount) as total_amount');
        $this->db->from('cb_cash_adv');
        $this->db->group_by('employee_driver_rowID, deleted');
        $this->db->having('deleted =', 0);
        $this->db->having('advance_date <=',$until_date);
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
    
    function get_data_realization_by_debtor($debtor_id,$until_date){
        $this->db->select('a.*');
        $this->db->from('cb_cash_adv_alloc as a');
        $this->db->join('cb_cash_adv as b','a.cb_cash_adv_no = b.advance_no');
        $this->db->where('a.deleted =', 0);
        $this->db->where('b.deleted =', 0);
        $this->db->where('a.alloc_mode =', 'R');
        $this->db->where('a.alloc_date <=',$until_date);
        $this->db->where('b.employee_driver_rowID', $debtor_id);
        $this->db->order_by('a.alloc_no', 'asc');

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }
    }
    
    function get_data_do_realization_by_trx_no($trx_no){
        $this->db->select('jo_no');
        $this->db->from('tr_do_trx');
        $this->db->where('trx_no', $trx_no);
        $this->db->order_by('rowID', 'asc');

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }
    }
    
    function get_sum_data_realization_by_debtor($debtor_id,$until_date){
        $this->db->select('b.employee_driver_rowID, b.deleted, a.deleted, a.alloc_mode, a.alloc_date, SUM(a.alloc_amt) as total_amount');
        $this->db->from('cb_cash_adv_alloc as a');
        $this->db->join('cb_cash_adv as b','a.cb_cash_adv_no = b.advance_no');
        $this->db->group_by('b.employee_driver_rowID, a.alloc_mode, a.deleted, b.deleted');
        $this->db->having('a.deleted =', 0);
        $this->db->having('b.deleted =', 0);
        $this->db->having('a.alloc_mode =', 'R');
        $this->db->having('a.alloc_date <=',$until_date);
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
    
    function get_data_refund_by_debtor($debtor_id,$until_date){
        $this->db->select('a.*');
        $this->db->from('cb_cash_adv_alloc as a');
        $this->db->join('cb_cash_adv as b','a.cb_cash_adv_no = b.advance_no');
        $this->db->where('a.deleted =', 0);
        $this->db->where('b.deleted =', 0);
        $this->db->where('a.alloc_mode =', 'F');
        $this->db->where('a.alloc_date <=',$until_date);
        $this->db->where('b.employee_driver_rowID', $debtor_id);
        $this->db->order_by('a.alloc_no', 'asc');

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }
    }
    
    function get_sum_data_refund_by_debtor($debtor_id,$until_date){
        $this->db->select('b.employee_driver_rowID, b.deleted, a.deleted, a.alloc_mode, a.alloc_date, SUM(a.alloc_amt) as total_amount');
        $this->db->from('cb_cash_adv_alloc as a');
        $this->db->join('cb_cash_adv as b','a.cb_cash_adv_no = b.advance_no');
        $this->db->group_by('b.employee_driver_rowID, a.alloc_mode, a.deleted, b.deleted');
        $this->db->having('a.deleted =', 0);
        $this->db->having('b.deleted =', 0);
        $this->db->having('a.alloc_mode =', 'F');
        $this->db->having('a.alloc_date <=',$until_date);
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
    
    function get_data_addendum_by_debtor($debtor_id,$until_date){
        $this->db->select('a.*');
        $this->db->from('cb_cash_adv_alloc as a');
        $this->db->join('cb_cash_adv as b','a.cb_cash_adv_no = b.advance_no');
        $this->db->where('a.deleted =', 0);
        $this->db->where('b.deleted =', 0);
        $this->db->where('a.alloc_mode =', 'A');
        $this->db->where('a.alloc_date <=',$until_date);
        $this->db->where('b.employee_driver_rowID', $debtor_id);
        $this->db->order_by('a.alloc_no', 'asc');

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }
    }
    
    function get_sum_data_addendum_by_debtor($debtor_id,$until_date){
        $this->db->select('b.employee_driver_rowID, b.deleted, a.deleted, a.alloc_mode, a.alloc_date, SUM(a.alloc_amt) as total_amount');
        $this->db->from('cb_cash_adv_alloc as a');
        $this->db->join('cb_cash_adv as b','a.cb_cash_adv_no = b.advance_no');
        $this->db->group_by('b.employee_driver_rowID, a.alloc_mode, a.deleted, b.deleted');
        $this->db->having('a.deleted =', 0);
        $this->db->having('b.deleted =', 0);
        $this->db->having('a.alloc_mode =', 'A');
        $this->db->having('a.alloc_date <=',$until_date);
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
    
    function get_all_data_temp($table_temp){
        $this->db->select('*');
        $this->db->from($table_temp);
        $this->db->order_by('tanggal','asc');
        $this->db->order_by('rowID','asc');
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
        
    }
    
}

/* End of file model.php */