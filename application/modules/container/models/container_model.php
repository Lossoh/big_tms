<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Container_model extends CI_Model
{
	
	function get_all_records_list($start_date,$end_date)
	{
		$this->db->select('a.*,b.jo_date,
							c.debtor_cd as debtor_code, 
							c.debtor_name as debtor_name
                        ');
		$this->db->from('tr_container_trx AS a');
		$this->db->join('tr_jo_emkl_trx_hdr AS b','b.jo_no=a.jo_no', 'LEFT');
		$this->db->join('sa_debtor AS c','c.rowID=b.debtor_rowID', 'LEFT');
		$this->db->where('a.deleted','0');
		$this->db->where('b.deleted','0');
        $this->db->where("b.jo_date BETWEEN '".$start_date."' AND '".$end_date."'");
		$this->db->order_by('a.jo_no','DESC');
		$this->db->order_by('a.container_no','ASC');
		$this->db->order_by('a.container_type','ASC');
		return $this->db->get()->result(); 
	}
    
    function get_data_do_by_do_no($do_no){

		$this->db->select("a.*, b.police_no, b.vehicle_type, d.debtor_name",false);
		$this->db->from('tr_jo_emkl_trx_do as a');
		$this->db->join('sa_vehicle AS b','b.rowID=a.vehicle_rowID', 'LEFT');        
		$this->db->join('tr_jo_emkl_trx_hdr AS c','c.jo_no=a.jo_no', 'LEFT');
		$this->db->join('sa_debtor AS d','d.rowID=c.debtor_rowID', 'LEFT');
		$this->db->where('a.deleted', 0);
		$this->db->where('c.deleted', 0);
        $this->db->where('a.do_no', $do_no);
        $query = $this->db->get();
        
        if($query->num_rows() > 0){
			return $query->row();
		} else{
			return NULL;
		}
    }
    
    function get_data_detail_by_rowID($container_rowID){

		$this->db->select("a.rowID as container_rowID, a.container_no, b.*, c.do_no, c.revisi, c.jo_detail_rowID, c.vehicle_rowID, c.from_rowID, c.to_rowID, c.port_warehouse,
                            c.sent_to, c.user_created as created_user, c.date_created as created_date, c.time_created as created_time",false);
		$this->db->from('tr_container_trx as a');
		$this->db->join('tr_jo_emkl_trx_hdr as b','a.jo_no = b.jo_no','left');
		$this->db->join('tr_jo_emkl_trx_do as c','a.rowID = c.container_rowID','left');
        $this->db->where('a.deleted', 0);
        $this->db->where('b.deleted', 0);
        $this->db->where('a.rowID', $container_rowID);
        $this->db->order_by('c.deleted','asc');

        $query=$this->db->get();
        
        if ($query->num_rows() > 0){
			return $query->row();
		} else{
			return NULL;
		}
    }
    
    function get_cargo_by_jo($jo_no){

		$this->db->select("a.rowID, b.item_name",false);
		$this->db->from('tr_jo_emkl_trx_dtl as a');
		$this->db->join('sa_item as b','a.item_rowID = b.rowID','left');
		$this->db->where('a.deleted', 0);
        $this->db->where('a.jo_no', $jo_no);
        $this->db->order_by('b.item_name','asc');

        $query=$this->db->get();
        
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_data_vehicle(){

		$this->db->select("*");
		$this->db->from('sa_vehicle');
		$this->db->where('deleted', 0);
        $this->db->order_by('police_no','asc');

        $query=$this->db->get();
        
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_destination_by_container_rowID($container_rowID){

		$this->db->select("b.destination_from_rowID as from_rowID, c.destination_name as from_name, b.destination_to_rowID as to_rowID, d.address1, d.address2, d.address3",false);
		$this->db->from('tr_jo_emkl_trx_dtl as a');
		$this->db->join('sa_fare_trip_hdr as b','a.fare_trip_rowID = b.rowID','left');
		$this->db->join('sa_destination as c','b.destination_from_rowID = c.rowID','left');
		$this->db->join('sa_destination as d','b.destination_to_rowID = d.rowID','left');
        $this->db->where('a.deleted', 0);
        $this->db->where('a.rowID', $container_rowID);
        $this->db->order_by('c.deleted','asc');

        $query=$this->db->get();
        
        if ($query->num_rows() > 0){
			return $query->row();
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