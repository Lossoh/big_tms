<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Transporter_model extends CI_Model
{
	function transporter_details($transporter_id)
	{
		$query = $this->db->where('transporter_id',$transporter_id)->get('mst_transporters');
		if ($query->num_rows() > 0){
			return $query->result();
		} 
	}
	function truck_details($transporter_id, $join_criteria)
	{
		$this->db->join('mst_reference','mst_reference.no_urut_ref = mst_trucks.truck_type_id');
		$query = $this->db->where('transporter_id',$transporter_id)->get('mst_trucks');
		if ($query->num_rows() > 0){
			return $query->result();
		} 
	}	
	function transpoter_truck_total($transporter_id)
	{
 		$this->db->select('COUNT(*) AS Truck_Total');
		$this->db->from('mst_trucks');	
 		$query = $this->db->where($array=array('transporter_id' => $transporter_id, 'deleted' => 0))->get();
		if ($query->num_rows() > 0){
			foreach ($query->result_array() as $row)
			{
			
   				return $row['Truck_Total'];;
			}
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