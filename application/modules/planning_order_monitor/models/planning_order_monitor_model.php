<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Planning_order_monitor_model extends CI_Model
{
	function get_all_records($table,$where,$join_table,$join_criteria,$order, $sort)
	{
		$this->db->where($where);
		if($join_table){
		$this->db->join($join_table,$join_criteria);
		}
		$query = $this->db->order_by($order,$sort)->get($table);
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
	
    function get_all_vehicle()
	{
	    $this->db->select('*');
		$this->db->from('sa_vehicle');
        $this->db->where('deleted',0);
        $query = $this->db->order_by('police_no','ASC')->get();

		return $query->result();
	}
    
    function check_condition($vehicle_id)
	{
	    $this->db->select('*');
		$this->db->from('mo_vehicle_condition');
		$this->db->where('deleted',0);
		$this->db->where('vehicle_id',$vehicle_id);
		$query = $this->db->order_by('rowID','DESC')->get();

		return $query->row();
	}
    
    function check_po_by_vehicle($vehicle_rowID,$date)
	{
	    $this->db->select('a.*, b.jo_no, c.vessel_name, d.destination_name as from_name, e.destination_name as to_name');
		$this->db->from('tr_planning_order_dtl as a');
		$this->db->join('tr_planning_order_hdr as b', 'a.trx_no = b.trx_no', 'left');
		$this->db->join('tr_jo_trx_hdr as c','b.jo_no = c.jo_no', 'left');
		$this->db->join('sa_destination as d','c.destination_from_rowID = d.rowID', 'left');
		$this->db->join('sa_destination as e','c.destination_to_rowID = e.rowID', 'left');
		$this->db->where('b.trx_date',$date);
		$this->db->where('a.deleted',0);
		$this->db->where('b.deleted',0);
		$this->db->where('a.vehicle_rowID',$vehicle_rowID);
		$this->db->order_by('b.jo_no','DESC');
		$query = $this->db->get();

		return $query->result();
	}
    
    function check_ritase_by_period($date)
	{
	    $sql = "SELECT SUM(a.ritase) as ritase_total, a.deleted, b.deleted, b.trx_date 
                FROM tr_planning_order_dtl as a LEFT JOIN tr_planning_order_hdr as b ON a.trx_no = b.trx_no 
                GROUP BY a.deleted, b.deleted, b.trx_date
                HAVING a.deleted = 0 AND b.deleted = 0 AND b.trx_date = '".$date."'";                    
		$query = $this->db->query($sql);

		return $query->row();        
	}
    
    function check_spk_by_vehicle($vehicle_rowID,$date)
	{
	    $sql = "SELECT COUNT(advance_no) as spk_total, advance_date, vehicle_rowID, deleted 
                FROM cb_cash_adv 
                GROUP BY advance_date, vehicle_rowID, deleted
                HAVING deleted = 0 AND advance_date = '".$date."' AND vehicle_rowID = ".$vehicle_rowID;                    
		$query = $this->db->query($sql);

		return $query->row();
	}

    function check_spk_by_period($date)
	{
	    $sql = "SELECT COUNT(a.advance_no) as spk_total, a.deleted, b.deleted, a.advance_date
                FROM cb_cash_adv as a LEFT JOIN sa_vehicle as b ON a.vehicle_rowID = b.rowID
                GROUP BY a.deleted, b.deleted, a.advance_date
                HAVING a.deleted = 0 AND b.deleted = 0 AND a.advance_date = '".$date."'";                    
		$query = $this->db->query($sql);

		return $query->row();
	}
    
    function check_realization_by_vehicle($vehicle_rowID,$date)
	{
	    $sql = "SELECT COUNT(a.alloc_no) as realization_total, a.alloc_no, a.alloc_date, b.vehicle_rowID, a.deleted, b.deleted
                FROM cb_cash_adv_alloc as a LEFT JOIN cb_cash_adv as b ON a.alloc_no = b.trx_no 
                GROUP BY a.alloc_date, b.vehicle_rowID, a.deleted, b.deleted
                HAVING a.deleted = 0 AND b.deleted = 0 AND a.alloc_no != '' AND a.alloc_date = '".$date."' AND b.vehicle_rowID = ".$vehicle_rowID;                    
		$query = $this->db->query($sql);

		return $query->row();
	}
    
    function check_realization_by_period($date)
	{
	    $sql = "SELECT COUNT(a.alloc_no) as realization_total, a.alloc_no, a.alloc_date, a.deleted, b.deleted, c.deleted
                FROM cb_cash_adv_alloc as a LEFT JOIN cb_cash_adv as b ON a.alloc_no = b.trx_no
                                            LEFT JOIN sa_vehicle as c ON b.vehicle_rowID = c.rowID
                GROUP BY a.alloc_date, a.deleted, b.deleted, c.deleted
                HAVING a.deleted = 0 AND b.deleted = 0 AND c.deleted = 0 AND a.alloc_no != '' AND a.alloc_date = '".$date."'";                    
		$query = $this->db->query($sql);

		return $query->row();
	}
    
}

/* End of file model.php */