<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * @package	Freelancer Office
 */
class Item_model extends CI_Model
{
	function item_details($item)
	{
		$query = $this->db->where('item_id',$item)->get('mst_items');
		if ($query->num_rows() > 0){
			return $query->result();
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