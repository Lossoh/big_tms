<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Vessel_model extends CI_Model
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
    
    function get_all_record_data($start_date,$end_date){

		$this->db->select("a.*, b.port_type, b.port_name",false);
		$this->db->from('tr_vessel_trx as a');
		$this->db->join('sa_port as b', 'b.rowID = a.port_rowID','left');
        $this->db->where('a.deleted', 0);
        $this->db->where("a.eta_date BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->db->order_by('a.rowID','desc');

        $query=$this->db->get();
        
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}

    }
    
    function get_all_record_data_by_rowID($rowID){

   			$this->db->select("a.*, b.port_type, b.port_name",false);
			$this->db->from('tr_vessel_trx as a');
			$this->db->join('sa_port as b', 'b.rowID = a.port_rowID');
            $this->db->where('a.rowID', $rowID);
            $this->db->order_by('a.rowID','desc');

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
    
    function get_data_by_trx_no($trx_no)
    {
        $this->db->from('tr_vessel_trx');
        $this->db->where('deleted', 0);
        $this->db->where('trx_no', $trx_no);
        $query = $this->db->get();
        return $query->row();
    }
    
    function get_data_detail_by_trx_no($trx_no)
    {
        $this->db->from('tr_vessel_trx_dtl');
        $this->db->where('deleted', 0);
        $this->db->where('trx_no', $trx_no);
        $query = $this->db->get();
        return $query->result();
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
    
    function delete_detail_data($trx_no)
    {

        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));
        $this->db->where('deleted', 0);
        $this->db->where('trx_no', $trx_no);
        return $this->db->update('tr_vessel_trx_dtl');

    }

}

/* End of file model.php */