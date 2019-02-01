<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Vehicle_order_model extends CI_Model
{
	function get_all_records_list()
	{
	    $this->db->select('a.*,b.police_no,b.no_stnk,b.no_kir,b.no_bpkb,b.no_insurance,b.no_kiu,b.deleted');
		$this->db->from('mo_vehicle_order as a');
		$this->db->join('sa_vehicle as b','a.vehicle_id = b.rowID');
		$this->db->group_by('a.vehicle_id');
        $this->db->having('a.deleted',0);
		$this->db->having('b.deleted',0);
        $query = $this->db->get();

		return $query->result();
		
	}
	
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
    
   	function get_last_status_by_vehicle($vehicle_id)
	{  

		$this->db->from('mo_vehicle_order');
		$this->db->where('vehicle_id',$vehicle_id);
		$this->db->order_by('rowID','DESC');
		$query = $this->db->get();
		return $query->row();
	}

	
      function delete_data($id){
        
        $this->db->set('deleted',1);
        $this->db->where('rowID',$id);
        $result = $this->db->update('mo_vehicle_order');
	
    }
	
}

/* End of file model.php */