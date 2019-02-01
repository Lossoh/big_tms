<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Menu_model extends CI_Model
{
	
	function get_all_records($select,$where,$join_table,$join_criteria,$order,$sort)
	{
        
        $this->db->select('*');
        $this->db->from('sa_menu');
        $this->db->order_by('kd_menu','asc');
        $query=$this->db->get();
            
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
	}
	
	function get_all_records_menu($table,$where,$join_table,$join_criteria,$order, $sort)
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

   	function get_by_id($tabel,$id)
	{  

		$this->db->from($tabel);
		$this->db->where('seq_menu',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
    function delete_data($id){        
        $this->db->set('status','0');
        $this->db->where('seq_menu',$id);
        $result = $this->db->update('sa_menu');
	
    }

}

/* End of file model.php */