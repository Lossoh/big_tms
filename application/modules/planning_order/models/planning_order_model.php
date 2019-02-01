<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Planning_order_model extends CI_Model
{
	function get_all_records_list($start_date,$end_date)
	{
	    $this->db->select('a.*,b.jo_no');
		$this->db->from('tr_planning_order_hdr as a');
		$this->db->join('tr_jo_trx_hdr as b','a.jo_no = b.jo_no', 'left');
		$this->db->where('a.deleted',0);
		$this->db->where('b.deleted',0);
        $this->db->where("a.trx_date BETWEEN '".$start_date."' AND '".$end_date."'");
        $query = $this->db->order_by('a.trx_date desc, a.trx_no desc')->get();

		return $query->result();
		
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
    
   	function get_by_id($tabel,$id)
	{  

		$this->db->from($tabel);
		$this->db->where('rowID',$id);
		$query = $this->db->get();
		return $query->row();
	}
    
    function get_detail_jo($jo_no)
	{
	    $this->db->select('a.*, b.destination_name as from_name, c.destination_name as to_name, d.port_name');
		$this->db->from('tr_jo_trx_hdr as a');
		$this->db->join('sa_destination as b','a.destination_from_rowID = b.rowID', 'left');
		$this->db->join('sa_destination as c','a.destination_to_rowID = c.rowID', 'left');
		$this->db->join('sa_port as d','a.port_rowID = d.rowID', 'left');
		$this->db->where('a.jo_no',$jo_no);
		$this->db->where('a.deleted',0);
		$query = $this->db->get();

		return $query->row();
	}
	
    function get_all_vehicle()
	{
	    $this->db->select('*');
		$this->db->from('sa_vehicle');
        $this->db->where('deleted',0);
        $query = $this->db->order_by('police_no','ASC')->get();

		return $query->result();
	}
    
    function check_condition($vehicle_id)
	{
	    $this->db->select('*');
		$this->db->from('mo_vehicle_condition');
		$this->db->where('deleted',0);
		$this->db->where('vehicle_id',$vehicle_id);
		$query = $this->db->order_by('rowID','DESC')->get();

		return $query->row();
	}
    
    function check_po_by_vehicle($vehicle_rowID,$date)
	{
	    $this->db->select('a.*, b.jo_no, c.vessel_name, d.destination_name as from_name, e.destination_name as to_name');
		$this->db->from('tr_planning_order_dtl as a');
		$this->db->join('tr_planning_order_hdr as b', 'a.trx_no = b.trx_no', 'left');
		$this->db->join('tr_jo_trx_hdr as c','b.jo_no = c.jo_no', 'left');
		$this->db->join('sa_destination as d','c.destination_from_rowID = d.rowID', 'left');
		$this->db->join('sa_destination as e','c.destination_to_rowID = e.rowID', 'left');
		$this->db->where('b.trx_date',$date);
		$this->db->where('a.vehicle_rowID',$vehicle_rowID);
		$this->db->where('a.deleted',0);
		$this->db->where('b.deleted',0);
		$this->db->order_by('b.jo_no','DESC');
		$query = $this->db->get();

		return $query->result();
	}
    
    function check_edit_po_by_vehicle($trx_no,$jo_no,$vehicle_rowID,$date)
	{
	    $this->db->select('a.*, b.jo_no, c.vessel_name, d.destination_name as from_name, e.destination_name as to_name');
		$this->db->from('tr_planning_order_dtl as a');
		$this->db->join('tr_planning_order_hdr as b', 'a.trx_no = b.trx_no', 'left');
		$this->db->join('tr_jo_trx_hdr as c','b.jo_no = c.jo_no', 'left');
		$this->db->join('sa_destination as d','c.destination_from_rowID = d.rowID', 'left');
		$this->db->join('sa_destination as e','c.destination_to_rowID = e.rowID', 'left');
        $this->db->where('a.trx_no',$trx_no);
		$this->db->where('b.trx_date',$date);
		$this->db->where('b.jo_no',$jo_no);
		$this->db->where('a.vehicle_rowID',$vehicle_rowID);
		$this->db->where('a.deleted',0);
		$this->db->where('b.deleted',0);
		$this->db->order_by('b.jo_no','DESC');
		$query = $this->db->get();

		return $query->row();
	}
    
    function check_po_by_trx_no($trx_no){
        $this->db->select('*');
		$this->db->from('tr_planning_order_hdr');
		$this->db->where('deleted',0);
		$this->db->where('trx_no',$trx_no);
		$query = $this->db->get();

		return $query->row();
    }
    
    function check_po_by_jo($jo_no, $trx_date){
        $this->db->select('*');
		$this->db->from('tr_planning_order_hdr');
		$this->db->where('deleted',0);
		$this->db->where('trx_date',$trx_date);
		$this->db->where('jo_no',$jo_no);
		$query = $this->db->get();

		return $query->row();
    }
    
    function delete_data($id){    
        $this->db->set('deleted',1);
        $this->db->set('user_deleted',$this->session->userdata('user_id'));
        $this->db->set('date_deleted',date("Y-m-d"));
        $this->db->set('time_deleted',date("H:i:s"));
        $this->db->where('deleted',0);
        $this->db->where('rowID',$id);
        $result = $this->db->update('tr_planning_order_hdr');
        return $result;
    }
    
    function delete_detail_data($trx_no){    
        $this->db->set('deleted',1);
        $this->db->set('user_deleted',$this->session->userdata('user_id'));
        $this->db->set('date_deleted',date("Y-m-d"));
        $this->db->set('time_deleted',date("H:i:s"));
        $this->db->where('deleted',0);
        $this->db->where('trx_no',$trx_no);
        $result = $this->db->update('tr_planning_order_dtl');
        return $result;
    }
	
}

/* End of file model.php */