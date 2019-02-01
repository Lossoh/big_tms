<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Work_order_model extends CI_Model
{
	function get_all_records_list()
	{
		$this->db->select('a.*,
							b.debtor_cd as debtor_code, 
							b.debtor_name as debtor_name, 
							c.port_cd as port_code,
							c.descs as port_name');
		$this->db->from('tr_wo_trx_hdr AS a');
		$this->db->join('sa_debtor AS b','a.debtor_rowID = b.rowID', 'LEFT');
		$this->db->join('sa_port AS c','a.port_rowID = c.rowID', 'LEFT');
		$this->db->where('a.wo_no !=','0');
		$this->db->where('a.deleted =','0');
		$this->db->order_by('a.wo_no','asc');
		return $this->db->get()->result_array(); 
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
	
	
	
	function work_order_details($work_order)
	{
		$this->db->select('a.*,
							b.debtor_cd as debtor_code, 
							b.debtor_name as debtor_name, 
							c.port_cd as port_code,
							c.descs as port_name');
		$this->db->from('tr_wo_trx_hdr AS a');
		$this->db->join('sa_debtor AS b','a.debtor_rowID = b.rowID', 'LEFT');
		$this->db->join('sa_port AS c','a.port_rowID = c.rowID', 'LEFT');
		$this->db->where('a.wo_no',$work_order);
		return $this->db->get()->result_array(); 
	}
	
	function get_wo()
	{
		$this->db->select('wo');
		$this->db->from('sa_spec');
		return $this->db->get()->result_array(); 
	}
	

}

/* End of file model.php */