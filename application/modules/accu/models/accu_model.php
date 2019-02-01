<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Accu_model extends CI_Model
{
	
	function get_all_records()
	{
        $this->db->select('a.*,b.police_no,c.debtor_name,d.rowID as dtl_rowID');
		$this->db->from('tr_accu_hdr as a');
        $this->db->join('sa_vehicle as b','b.rowID = a.vehicle_rowID');
        $this->db->join('sa_debtor as c','c.rowID = a.debtor_rowID');
        $this->db->join('tr_accu_dtl as d','d.accu_rowID = a.rowID','left');
		$this->db->where('a.deleted',0);
        $this->db->order_by('a.rowID','desc');
		$query = $this->db->get();
        
		if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
		
	}
	
    function get_all_vehicle_data(){
        $sql = "SELECT * FROM sa_vehicle WHERE deleted = 0 ORDER BY police_no";
        $query=$this->db->query($sql);
        
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_all_debtor_data(){
        $sql = "SELECT * FROM sa_debtor WHERE deleted = 0 AND type = 'D' ORDER BY type, debtor_name";
        $query=$this->db->query($sql);
        
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
    
	function get_detail_by_id($id)
	{
		$query = $this->db->where('rowID',$id)->get('tr_accu_dtl');
		if ($query->num_rows() > 0){
			return $query->row();
		} 
	}
    
    function delete_data($tabel,$id)
    {

        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('datetime_deleted', date('Y-m-d H:i:s'));
        $this->db->where('rowID', $id);
        return $this->db->update($tabel);

    }

}

/* End of file model.php */