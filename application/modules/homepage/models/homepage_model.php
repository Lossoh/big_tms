<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Homepage_model extends CI_Model
{
    function get_data_jo(){
        $this->db->select("*");
        $this->db->from('tr_jo_trx_hdr');
        $this->db->where('deleted', 0);
        $this->db->order_by('jo_no', 'desc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function get_data_ca(){
        $this->db->select("*");
        $this->db->from('cb_cash_adv');
        $this->db->where('trx_no', '');
        $this->db->where('deleted', 0);
        $this->db->order_by('advance_no', 'desc');
        $query = $this->db->get();
        
        return $query->result();
    }
    
    function get_data_realization_ca(){
        $this->db->select("*");
        $this->db->from('cb_cash_adv');
        $this->db->where('trx_no <>', '');
        $this->db->where('deleted', 0);
        $this->db->order_by('advance_no', 'desc');
        $query = $this->db->get();
        
        return $query->result();
    }
 
    function get_data_document_unverified(){
        $this->db->select("*");
        $this->db->from('tr_do_trx');
        $this->db->where('status', 0);
        $this->db->where('deleted', 0);
        $this->db->order_by('trx_no', 'desc');
        $query = $this->db->get();
        
        return $query->result();
    }
    
}

