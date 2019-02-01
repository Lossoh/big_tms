<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class order_type_model extends CI_Model
{
	
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
	
	function order_type_details($order_type)
	{
		$query = $this->db->where('rowID',$order_type)->get('sa_order_type');
		if ($query->num_rows() > 0){
			return $query->result();
		} 
	}
	
    function get_by_id($tabel,$id)
	{  

		$this->db->from($tabel);
		$this->db->where('rowID',$id);
		$query = $this->db->get();
		return $query->row();
	}
    
    function delete_data($id){
        
        $this->db->set('deleted',1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));
        $this->db->where('rowID',$id);
        $result = $this->db->update('sa_order_type');
	
    }
}

/* End of file model.php */