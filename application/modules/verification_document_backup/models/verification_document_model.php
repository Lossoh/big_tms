<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Verification_document_model extends CI_Model
{
	
	function get_all_records()
	{
        $this->db->select('a.rowID,a.trx_no,a.status,b.advance_no,b.advance_date,b.advance_allocation,c.debtor_name,d.police_no');
        $this->db->from('tr_do_trx as a');
        $this->db->join('cb_cash_adv as b','a.trx_no = b.trx_no');
        $this->db->join('sa_debtor as c','b.employee_driver_rowID = c.rowID');
        $this->db->join('sa_vehicle as d', 'b.vehicle_rowID = d.rowID');
        $this->db->group_by('a.trx_no,a.status,b.advance_no,b.advance_date,b.advance_allocation,c.debtor_name,d.police_no');
        $this->db->where('a.deleted', 0);
        $this->db->order_by('b.advance_no','desc');
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
	
    function update_data_by_trx_no($trx_no,$status){
        
        $this->db->set('status',$status);
        $this->db->set('date_verified',date("Y-m-d"));
        $this->db->set('time_verified',date("H:i:s"));
        $this->db->where('trx_no',$trx_no);
        $result = $this->db->update('tr_do_trx');
	
    }

}

/* End of file model.php */