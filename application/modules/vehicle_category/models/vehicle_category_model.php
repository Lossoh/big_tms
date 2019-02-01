<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Vehicle_category_model extends CI_Model
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
	
	function vehicle_category_details($vehicle_category)
	{
		$query = $this->db->where('rowID',$vehicle_category)->get('sa_vehicle_type');
		if ($query->num_rows() > 0){
			return $query->result();
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
    
    
    
    
    function get_pdf()
    {
        # get data
        $this->db->flush_cache();
        $this->db->select('*');
        $this->db->from('sa_vehicle_type');
        $this->db->where('deleted',0);
        $hasil = $this->db->get();  
        $data = array();
        if ($hasil->num_rows() > 0)
        {
            $data = $hasil->result();
        }

        $hasil->free_result();

        return $data;
        

    }
	

}

/* End of file model.php */