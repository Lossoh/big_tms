<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Schedule_event_model extends CI_Model
{
    
    function get_all_data_jo(){
        $sql = "SELECT a.jo_no, b.trx_no, b.eta_date
                FROM tr_jo_trx_hdr as a LEFT JOIN tr_vessel_trx as b ON a.vessel_rowID = b.rowID
                WHERE a.deleted = 0 AND b.deleted = 0
                ORDER BY b.eta_date";

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    
    function get_etb_by_trx_no($trx_no){
        $sql = "SELECT a.trx_no, a.vessel_name, a.eta_date, b.etb_date_vessel
                FROM tr_vessel_trx as a LEFT JOIN tr_vessel_trx_dtl as b ON a.trx_no = b.trx_no
                WHERE a.deleted = 0 AND b.deleted = 0 AND a.trx_no = '".$trx_no."'
                ORDER BY b.etb_date_vessel DESC, a.trx_no ASC
                LIMIT 1";

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }
    
}

/* End of file model.php */