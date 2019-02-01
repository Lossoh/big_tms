<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * @package	Freelancer Office
 */
class Client_model extends CI_Model
{
	function client_details($client_id)
	{
 		$this->db->select('a.*, b.*, b.destination_id AS bDestinationID, b.destination_name AS bDestinationName');
		$this->db->from('mst_clients AS a');	
 		$this->db->join('mst_destinations AS b','b.destination_id = a.destination_id', 'LEFT'); 
		$query = $this->db->where('client_id',$client_id)->get();
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