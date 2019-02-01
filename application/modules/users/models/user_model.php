<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * @package	Freelancer Office
 * @author	William M
 */
class User_model extends CI_Model
{
	
	function users()
	{
		$this->db->join('sa_user_details','sa_user_details.user_rowID = sa_users.rowID');
		return $this->db->where(array('activated'=>'1'))->order_by('created','desc')->get('sa_users')->result();
	}
    function users_by_id($user_id)
	{
		$this->db->join('sa_user_details','sa_user_details.user_rowID = sa_users.rowID');
		return $this->db->where(array('activated'=>'1','sa_users.rowID' => $user_id))->order_by('created','desc')->get('sa_users')->row();
	}
	function user_details($user_id)
	{
		$this->db->join('sa_user_details','sa_user_details.user_rowID = sa_users.rowID');
		$query = $this->db->where('sa_user_details.rowID',$user_id)->get('sa_users');
		if ($query->num_rows() > 0){
			return $query->result();
		} 
	}
	function get_departement($dep_id)
	{
		$this->db->select('dep_name');
        $this->db->from('sa_dep');
        $this->db->where('rowID',$dep_id);
        $this->db->where('deleted',0);
        $query = $this->db->get();
		if ($query->num_rows() > 0){
			return $query->row();
		} 
	}
	function user_project_files($user)
	{
		$this->db->join('sa_users','sa_users.id = files.uploaded_by');
		return $this->db->where('uploaded_by',$user)->get('files')->result();
	}
	function user_bug_files($user)
	{
		$this->db->join('sa_users','sa_users.id = bug_files.uploaded_by');
		return $this->db->where('uploaded_by',$user)->get('bug_files')->result();
	}
	function roles()
	{
		$query = $this->db->get('sa_roles');
		if ($query->num_rows() > 0){
			return $query->result();
		} 
	}
	
}

/* End of file model.php */