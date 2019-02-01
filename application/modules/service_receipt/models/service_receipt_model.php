<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Service_receipt_model extends CI_Model
{
	function get_by_id($tabel, $id)
    {
        $this->db->from($tabel);
        $this->db->where('rowID', $id);
        $query = $this->db->get();
        return $query->row();
    }
    
    function get_all_record_data($start_date,$end_date){

		$this->db->select("a.*, b.type, b.debtor_cd, b.debtor_name",false);
		$this->db->from('tr_service_receipt_hdr as a');
		$this->db->join('sa_debtor as b', 'b.rowID = a.debtor_rowID');
        $this->db->where('a.deleted', 0);
        $this->db->where('b.deleted', 0);
        $this->db->where("a.trx_date BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->db->order_by('a.trx_no','desc');

        $query=$this->db->get();
        
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}

    }
   	
    function get_all_spk_data(){
        $sql = "SELECT * FROM tr_spk_service_history WHERE deleted = 0 ORDER BY trx_no DESC";
        $query=$this->db->query($sql);
        
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}

    }

    function get_all_spk_not_receipt_data(){
        $sql = "SELECT * FROM tr_spk_service_history WHERE deleted = 0 AND receipt_no = '' ORDER BY trx_no DESC";
        $query=$this->db->query($sql);
        
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}

    }
    
    function get_spk_by_no($spk_no){
        $sql = "SELECT a.*, c.police_no, d.debtor_name
                FROM tr_spk_service_history as a INNER JOIN tr_service_history_hdr as b ON a.complaint_no = b.trx_no
                                                INNER JOIN sa_vehicle as c ON b.vehicle_rowID = c.rowID
                                                INNER JOIN sa_debtor as d ON b.debtor_rowID = d.rowID
                WHERE a.deleted = 0 AND b.deleted = 0 AND a.trx_no = '".$spk_no."'";
        $query=$this->db->query($sql);
        
        if ($query->num_rows() > 0){
			return $query->row();
		} else{
			return NULL;
		}

    }
    
    function get_all_debtor_data(){
        $sql = "SELECT * FROM sa_debtor WHERE deleted = 0 ORDER BY type, debtor_name";
        $query=$this->db->query($sql);
        
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}

    }
    
    function get_service_receipt_hdr_by_trx_no($trx_no){
        $sql = "SELECT a.*, b.debtor_name 
                FROM tr_service_receipt_hdr as a INNER JOIN sa_debtor as b ON a.debtor_rowID = b.rowID
                WHERE a.deleted = 0 AND a.trx_no = '".$trx_no."'";
        $query=$this->db->query($sql);
        
        if ($query->num_rows() > 0){
			return $query->row();
		} else{
			return NULL;
		}

    }
    
    function get_service_receipt_dtl_by_trx_no($trx_no){
        $sql = "SELECT * FROM tr_service_receipt_dtl WHERE deleted = 0 AND trx_no = '".$trx_no."'";
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
        $this->db->where('rowID', $id);
        return $this->db->update($tabel);
    }

    function delete_detail_data($trx_no)
    {
        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));
        $this->db->where('trx_no', $trx_no);
        return $this->db->update('tr_service_receipt_dtl');
    }

}

/* End of file model.php */