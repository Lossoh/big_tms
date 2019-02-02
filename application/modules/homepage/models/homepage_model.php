<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Homepage_model extends CI_Model
{
    function get_data_jo(){
        $this->db->select("*");
        $this->db->from('tr_jo_trx_hdr');
        $this->db->where('deleted', 0);
        $this->db->order_by('jo_no', 'desc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function get_data_ca(){
        $this->db->select("*");
        $this->db->from('cb_cash_adv');
        $this->db->where('trx_no', '');
        $this->db->where('deleted', 0);
        $this->db->order_by('advance_no', 'desc');
        $query = $this->db->get();
        
        return $query->result();
    }
    
    function get_data_realization_ca(){
        $this->db->select("*");
        $this->db->from('cb_cash_adv');
        $this->db->where('trx_no <>', '');
        $this->db->where('deleted', 0);
        $this->db->order_by('advance_no', 'desc');
        $query = $this->db->get();
        
        return $query->result();
    }
 
    function get_data_document_unverified(){
        $this->db->select("*");
        $this->db->from('tr_do_trx');
        $this->db->where('status', 0);
        $this->db->where('deleted', 0);
        $this->db->order_by('trx_no', 'desc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function get_all_records()
	{
        $this->db->select('*');
        $this->db->from('tr_log_balance');
        $this->db->where('deleted', 0);
        $this->db->order_by('rowID','desc');
        $query=$this->db->get();
        
        if ($query->num_rows() > 0){
            return $query->result();
        } else{
            return NULL;
        }
    }

    function get_all_records_by_period($start_date, $end_date)
	{
        $this->db->select('*');
        $this->db->from('tr_log_balance');
        $this->db->where('date_created >=', $start_date);
        $this->db->where('date_created <=', $end_date);
        $this->db->where('deleted', 0);
        $this->db->order_by('rowID','desc');
        $query=$this->db->get();
        
        if ($query->num_rows() > 0){
            return $query->result();
        } else{
            return NULL;
        }
    }

    function get_by_id($tabel,$id)
	{  
		$this->db->from($tabel);
		$this->db->where('rowID',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
    function get_balance_get_by_date($date)
	{  
		$this->db->from('tr_log_balance');
		$this->db->where('date_created',$date);
		$query = $this->db->get();
		return $query->row();
	}
	
    function get_use_balance($date)
	{  
		$this->db->select_sum('trx_amt');
		$this->db->from('cb_trx_hdr');
		$this->db->where('date_created',$date);
		$query = $this->db->get();
		return $query->row()->trx_amt;
	}
	
}

