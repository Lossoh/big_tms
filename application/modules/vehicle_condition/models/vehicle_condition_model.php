<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Vehicle_condition_model extends CI_Model
{
	function get_all_records_list($start_date,$end_date)
	{
	    $this->db->select('a.*,b.police_no,b.no_stnk,b.no_kir,b.no_bpkb,b.no_insurance,b.no_kiu');
		$this->db->from('mo_vehicle_condition as a');
		$this->db->join('sa_vehicle as b','a.vehicle_id = b.rowID');
		$this->db->where('a.deleted',0);
		$this->db->where('b.deleted',0);
        $this->db->where("a.date_created BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->db->order_by('a.date_created','DESC');
        $query = $this->db->order_by('b.police_no','ASC')->get();

		return $query->result();
		
	}
    
    function get_history_condition($vehicle_id)
	{
	    $this->db->select('a.*,b.police_no,b.no_stnk,b.no_kir,b.no_bpkb,b.no_insurance,b.no_kiu');
		$this->db->from('mo_vehicle_condition as a');
		$this->db->join('sa_vehicle as b','a.vehicle_id = b.rowID');
		$this->db->where('a.deleted',0);
		$this->db->where('b.deleted',0);
		$this->db->where('a.vehicle_id',$vehicle_id);
        $this->db->order_by('a.date_created','DESC');
        $query = $this->db->order_by('b.police_no','ASC')->get();

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
	
      function delete_data($id){
        
        $this->db->set('deleted',1);
        $this->db->where('rowID',$id);
        $result = $this->db->update('mo_vehicle_condition');
	
    }
	
}

/* End of file model.php */