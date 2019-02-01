<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Vehicle_reference_model extends CI_Model
{
	
	function get_all_records($select,$where,$join_table,$join_criteria,$order,$sort)
	{

        $this->db->select('*');
        $this->db->from('sa_vehicle_reference');
        $this->db->where('deleted', 0);
        $this->db->order_by('rowID','desc');
        $query=$this->db->get();
            
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
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
        $this->db->set('user_deleted',$this->session->userdata('user_id'));
        $this->db->set('date_deleted',date('Y-m-d'));
        $this->db->set('time_deleted',date('H:i:s'));
        $this->db->where('rowID',$id);
        
        $result = $this->db->update('sa_vehicle_reference');
    }

}

/* End of file model.php */