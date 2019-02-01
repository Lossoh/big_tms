<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * @package	Freelancer Office
 * @author	William M
 */
class Profile_model extends CI_Model
{
	
	function activities($user,$limit)
	{
		return $this->db->where('deleted',0)->where('user_rowID',$user)->order_by('activity_date','DESC')->get('activities',$limit,$this->uri->segment(3))->result();
	}
	function get_all($table)
	{
		$query = $this->db->get($table);
		if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
	}
	function get_all_records($table,$where,$join_table,$join_criteria)
	{
		$this->db->where($where);
		if($join_table){
		$this->db->join($join_table,$join_criteria);
		}
		$query = $this->db->get($table);
		if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
	}
	function update_avatar($filename)
	{
		$data = array(
			'avatar'	=> $filename,
		);
		$this->db->where('user_rowID',$this->tank_auth->get_user_id())->update('sa_user_details', $data);
		return TRUE;
	}
	
}

/* End of file model.php */