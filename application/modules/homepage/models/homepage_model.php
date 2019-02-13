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

    function get_all_department()
	{
        $this->db->select('*');
        $this->db->from('sa_dep');
        $this->db->where('deleted', 0);
        $this->db->order_by('dep_cd','asc');
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
	
    function get_balance_get_by_date($dep_rowID, $date)
	{  
		$this->db->from('tr_log_balance');
		$this->db->where('dep_rowID',$dep_rowID);
		$this->db->where('date_created',$date);
		$this->db->where('deleted',0);
		$query = $this->db->get();
		return $query->row();
	}
	
    function get_use_balance($coa_rowID, $date)
	{  
		$this->db->select_sum('trx_amt');
		$this->db->from('cb_trx_hdr');
		$this->db->where('coa_rowID',$coa_rowID);
		$this->db->where('date_created',$date);
		$this->db->where('deleted',0);
		$query = $this->db->get();
		return $query->row()->trx_amt;
	}
	
    function get_log_balance_department()
	{  
        $sql = "SELECT a.dep_rowID as id, a.deleted, b.dep_cd as code, b.dep_name as name, b.cash_gl_rowID as gl_rowID, SUM(a.balance) as balance_total 
                FROM tr_log_balance as a INNER JOIN sa_dep as b ON a.dep_rowID = b.rowID
                GROUP BY id, a.deleted, code, name, gl_rowID
                HAVING a.deleted = 0 ORDER BY name";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
        }
    }

    function get_log_use_balance_department_by_coa_id($coa_rowID)
	{  
		$this->db->select_sum('trx_amt');
		$this->db->from('cb_trx_hdr');
		$this->db->where('coa_rowID',$coa_rowID);
		$this->db->where('deleted',0);
		$query = $this->db->get();
		return $query->row()->trx_amt;
	}
	
}
