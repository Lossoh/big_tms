<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Transporter_tarif_model extends CI_Model
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
    
    function get_all_record_data(){

		$this->db->select("a.*, b.creditor_name, c.item_name, d.destination_name, d.destination_no",false);
		$this->db->from('sa_transporter_tarif_hdr as a');
		$this->db->join('sa_creditor as b', 'b.rowID = a.creditor_rowID','left');
		$this->db->join('sa_item as c', 'c.rowID = a.cargo_rowID','left');
		$this->db->join('sa_destination as d', 'd.rowID = a.from_rowID','left');
        $this->db->where('a.deleted', 0);
        $this->db->order_by('a.rowID','desc');

        $query=$this->db->get();
        
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}

    }

    function get_all_record_detail_data(){

		$this->db->select("a.*, b.jo_type, c.creditor_name, d.item_name, e.destination_no as from_no_name, e.destination_name as from_name, 
                            f.destination_name as to_name, f.destination_no as to_no_name",false);
		$this->db->from('sa_transporter_tarif_dtl as a');
		$this->db->join('sa_transporter_tarif_hdr as b', 'b.rowID = a.transporter_tarif_rowID','left');
		$this->db->join('sa_creditor as c', 'c.rowID = b.creditor_rowID','left');
		$this->db->join('sa_item as d', 'd.rowID = b.cargo_rowID','left');
		$this->db->join('sa_destination as e', 'e.rowID = b.from_rowID','left');
        $this->db->join('sa_destination as f', 'f.rowID = a.to_rowID','left');
        $this->db->where('a.deleted', 0);
        $this->db->where('b.deleted', 0);
        $this->db->order_by('c.creditor_name','asc');

        $query=$this->db->get();
        
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
    
    function get_data_detail_by_hdr_id($rowID)
    {
        $this->db->from('sa_transporter_tarif_dtl');
        $this->db->where('deleted', 0);
        $this->db->where('transporter_tarif_rowID', $rowID);
        $this->db->order_by('rowID', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
	
    function get_data_vehicle_category(){
        $sql = "SELECT * FROM sa_vehicle_type 
                WHERE deleted = '0' 
                ORDER BY type_cd ASC";
        $query=$this->db->query($sql);
		if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
		 
    }
    
    function delete_data($tabel,$id)
    {

        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));
        $this->db->where('deleted', 0);
        $this->db->where('rowID', $id);
        return $this->db->update($tabel);

    }
    
    function delete_detail_data($rowID)
    {
        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));
        $this->db->where('deleted', 0);
        $this->db->where('transporter_tarif_rowID', $rowID);
        return $this->db->update('sa_transporter_tarif_dtl');

    }

}

/* End of file model.php */