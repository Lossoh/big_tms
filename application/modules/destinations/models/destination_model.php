<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * @package	Freelancer Office
 */
class Destination_model extends CI_Model
{
	function destination_details($destination_id)
	{
/* 		$this->db->select('a.*, b.*, b.Nm_Ref AS bNm_Ref');
		$this->db->from('mst_destinations AS a');	 */	
 		$this->db->join('mst_reference AS b','b.No_Urut_Ref = mst_destinations.destination_flag AND b.Type_Ref = "destination_flag"', 'LEFT'); 
		$query = $this->db->where('destination_id',$destination_id)->get('mst_destinations');
		if ($query->num_rows() > 0){
			return $query->result();
		} 
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
	
	function user_activities($user_id,$limit)
	{
		$this->db->join('users','users.id = activities.user');
		return $this->db->where('user',$user_id)
							->order_by('activity_date','DESC')
							->get('activities',$limit,$this->uri->segment(5))->result();
	}
	
	function roles()
	{
		$query = $this->db->get('roles');
		if ($query->num_rows() > 0){
			return $query->result();
		} 
	}	
}

/* End of file model.php */