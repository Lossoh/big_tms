<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    function get_all_records($table,$where,$join_table,$join_criteria,$order)
	{
		$this->db->where($where);
		
		if($join_table){
			$this->db->join($join_table,$join_criteria,'LEFT');
		}
		
		$query = $this->db->order_by($order,'desc')->get($table);
		
		if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
	}	
	
	


	
}
