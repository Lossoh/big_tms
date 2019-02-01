<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Comment_model extends CI_Model
{
	function get_value($table,$where,$field)
   	{
		$this->db->where($where);
		$this->db->select($field);
		$query = $this->db->get($table);
			if ($query->num_rows() > 0)
			{
				 $row = $query->row();
				 return $row->$field;
			}
	}	
	function case_comments($case_rowID)
	{
		$query = $this->db->where('comment_rowID',$case_rowID)->order_by('date_created','desc')->order_by('time_created','desc')->limit(5, 0)->get('lg_comment_replies');
		if ($query->num_rows() > 0){
			return $query->result();
		} 
	}
	function case_comments_more($case_rowID,$rowID)
	{
		$query = $this->db->where('comment_rowID',$case_rowID)->where('rowID <',$rowID)->order_by('date_created','desc')->order_by('time_created','desc')->limit(5, 0)->get('lg_comment_replies');
		if ($query->num_rows() > 1){
			return $query->result();
		}else{
			return NULL;
		}  
	}
	
	function get_all_records($table,$where,$join_table,$join_criteria,$order)
	{
		$this->db->where($where);
		if($join_table){
			$this->db->join($join_table,$join_criteria,'LEFT');
		}
		$query = $this->db->order_by($order,'asc')->get($table);
		if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		} 
	}

	
	
}

/* End of file bugs_model.php */