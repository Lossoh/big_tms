<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ticket_model extends CI_Model
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

	function ticket_lists($company_rowID, $dep_rowID, $user_rowID, $deleted)
	{
		
		$query = $this->db->query("
		SELECT  a.rowID, a.datetime, b.type_name AS category, c.type_name AS priority, a.subject, d.type_name AS status, a.attachment
		FROM lg_tickets a 
		LEFT JOIN sa_reference b ON b.type_ref='ticket_category' AND a.category_rowID=b.type_no 
		LEFT JOIN sa_reference c ON c.type_ref='priority' AND a.priority_rowID=c.type_no
		LEFT JOIN sa_reference d ON d.type_ref='ticket_status' AND a.status_rowID=d.type_no
		WHERE a.company_rowID=$company_rowID AND dep_rowID=$dep_rowID AND user_rowID=$user_rowID AND deleted=$deleted
		")->result();
		
		return $query;
	
	}

	function get_file($rowID)
		{
			return $this->db->select()
					->from('lg_tickets')
					->where('rowID', $rowID)
					->get()
					->row();
		}
	
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

/* End of file bugs_model.php */