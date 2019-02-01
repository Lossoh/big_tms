<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Part_service_model extends CI_Model
{
	
	function get_all_records_by_type($type)
	{
        $this->db->select('a.*, b.brand_name, c.uom_cd');
		$this->db->from('sa_part_service_hdr as a');
		$this->db->join('sa_brand as b','a.brand_rowID = b.rowID','left');
		$this->db->join('sa_uom as c','a.uom_rowID = c.rowID','left');
        $this->db->where('a.type',$type);
        $this->db->where('a.deleted',0);
        $this->db->order_by('a.rowID','desc');
		$query = $this->db->get();
        
		if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
	}
	
    function get_data_template($code)
    {
        $this->db->from('sa_template_service');
        $this->db->where('deleted',0);
        $this->db->where('code',$code);
        $query = $this->db->get();
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_data_service_by_code($code)
    {
        $this->db->from('sa_part_service_hdr');
        $this->db->where('deleted',0);
        $this->db->where('code',$code);
        $query = $this->db->get();
        if ($query->num_rows() > 0){
			return $query->row();
		} else{
			return NULL;
		}
    }
    
    function get_data_table($tabel,$order_by,$order_type)
    {
        $this->db->from($tabel);
        $this->db->order_by($order_by, $order_type);
        $this->db->where('deleted',0);
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

    function delete_data_template($code)
    {
        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));
        $this->db->where('deleted', 0);
        $this->db->where('code', $code);
        return $this->db->update('sa_template_service');
    }

}

/* End of file model.php */