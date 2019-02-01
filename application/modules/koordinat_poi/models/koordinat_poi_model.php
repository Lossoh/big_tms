<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Koordinat_poi_model extends CI_Model
{
	
	function get_all_records()
	{
        $this->db->select('*');
		$this->db->from('sa_koordinat_poi');
        $this->db->where('deleted',0);
        $this->db->order_by('rowID','desc');
		$query = $this->db->get();
        
		if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
	}
	
    function get_by_id($tabel, $id)
    {
        $this->db->from($tabel);
        $this->db->where('rowID', $id);
        $query = $this->db->get();
        return $query->row();
    }
    
    function delete_data($tabel,$id)
    {
        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));
        $this->db->where('rowID', $id);
        return $this->db->update($tabel);
    }

}

/* End of file model.php */