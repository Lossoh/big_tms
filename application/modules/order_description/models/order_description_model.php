<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Order_description_model extends CI_Model
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
	
	function order_description_details($order_descs)
	{
		$query = $this->db->where('rowID',$order_descs)->get('sa_order_descs');
		if ($query->num_rows() > 0){
			return $query->result();
		} 
	}
	

}

/* End of file model.php */