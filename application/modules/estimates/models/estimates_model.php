<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
**********************************************************************************
* Copyright: gitbench 2014
* Licence: Please check CodeCanyon.net for licence details. 
* More licence clarification available here: htttp://codecanyon.net/wiki/support/legal-terms/licensing-terms/ 
* CodeCanyon User: http://codecanyon.net/user/gitbench
* CodeCanyon Project: http://codecanyon.net/item/freelancer-office/8870728
* Package Date: 2014-09-24 09:33:11 
***********************************************************************************
*/
class Estimates_model extends CI_Model
{
	
	function get_all_records($table,$where,$join_table,$join_criteria,$order)
	{
		$this->db->where($where);
		if($join_table){
		$this->db->join($join_table,$join_criteria);
		}
		$query = $this->db->order_by($order,'desc')->get($table);
		if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
	}
	
    function clients()
	{
		$query = $this->db->where('role_id !=',1)->get('users');
		if ($query->num_rows() > 0){
			return $query->result();
		} 
	}

	function search_estimate($keyword)
	{
		$this->db->join('companies','companies.co_id = estimates.client');
		return $this->db->like('reference_no', $keyword)->order_by("date_saved","desc")->get('estimates')->result();
	}

    function payment_methods()
	{
			return $this->db->get('payment_methods')->result();
	}
	function estimate_details($est_id)
	{
		//$this->db->join('users','users.id = estimates.client');
		$query = $this->db->where('est_id',$est_id)->get('estimates');
		if ($query->num_rows() > 0){
			return $query->result();
		} 
	}
	function estimate_activities($est_id)
	{
		$this->db->join('users','users.id = activities.user');
		$this->db->where('module', 'estimates');
		return $this->db->where('module_field_id',$est_id)->order_by('activity_date','desc')->get('activities')->result();
	}
	function estimate_items($est_id)
	{
		$this->db->join('estimates','estimates.est_id = estimate_items.estimate_id');
		$query = $this->db->where('estimate_id',$est_id)->get('estimate_items');
		if ($query->num_rows() > 0){
			return $query->result();
		} 
	}
	function get_client($estimate){
	$query = $this->db->select('client')->where('est_id',$estimate)->get('estimates');
		if ($query->num_rows() > 0)
			{
  		 $row = $query->row();
  		 return $row->client;
  		}
	}
}

/* End of file model.php */