<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * @package	Freelancer Office
 */
class Transporter_model extends CI_Model
{
	function client_details($transporter)
	{
		$query = $this->db->where('transporter_id',$transporter)->get('mst_transporters');
		if ($query->num_rows() > 0){
			return $query->result();
		} 
	}
	function client_invoices($company)
	{
		$query = $this->db->where('client',$company)->get('invoices');
		if ($query->num_rows() > 0){
			return $query->result();
		} 
	}
	function client_projects($company)
	{
		$query = $this->db->where('client',$company)->get('projects');
		if ($query->num_rows() > 0){
			return $query->result();
		} 
	}
	function client_contacts($company)
	{
		$this->db->join('companies','companies.co_id = user_details.company');
		$this->db->join('users','users.id = user_details.user_id');
		$query = $this->db->where('company',$company)->get('user_details');
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
}

/* End of file model.php */