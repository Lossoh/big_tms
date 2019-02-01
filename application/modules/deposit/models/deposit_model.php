<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Deposit_model extends CI_Model
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

		$this->db->select("a.*, b.type, b.debtor_cd, b.debtor_name",false);
		$this->db->from('tr_deposit_trx as a');
		$this->db->join('sa_debtor as b', 'b.rowID = a.debtor_rowID');
        $this->db->where('a.deleted', 0);
        $this->db->where('b.deleted', 0);
        $this->db->where("a.date BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->db->order_by('a.rowID','desc');

        $query=$this->db->get();
        
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
    
    public function select_max_by_field($field)
	{
		$this->db->select_max($field);
		$query = $this->db->get('tr_deposit_trx');
		if($query->num_rows()>0){
            foreach($query->result() as $q){
				return ((int)$q->$field);
			}
		}

	}
    
    function get_by_id($tabel, $id)
    {

        $this->db->from($tabel);
        $this->db->where('rowID', $id);
        $query = $this->db->get();
        return $query->row();
    }
    
    function get_data_gl_header_by_trx_no($trx_no)
    {
        $this->db->select('*');
        $this->db->from('gl_trx_hdr');
        $this->db->where('deleted', 0);
        $this->db->where('journal_no', $trx_no);
        $query = $this->db->get();
        return $query->row();
    }
    
    function get_data_gl_header_by_ref_no($ref_no)
    {
        $this->db->select('*');
        $this->db->from('gl_trx_hdr');
        $this->db->where('deleted', 0);
        $this->db->where('ref_no', $ref_no);
        $query = $this->db->get();
        return $query->row();
    }
    
    function delete_data($tabel,$id)
    {

        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d H:i:s'));
        $this->db->where('rowID', $id);
        return $this->db->update($tabel);

    }
    
    function delete_data_gl_header($gl_no)
    {

        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));
        $this->db->where('deleted', 0);
        $this->db->where('journal_no', $gl_no);
        return $this->db->update('gl_trx_hdr');

    }
    
    function delete_data_gl_detail($gl_no)
    {

        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));
        $this->db->where('deleted', 0);
        $this->db->where('gl_trx_hdr_journal_no', $gl_no);
        return $this->db->update('gl_trx_dtl');

    }
    
    function get_pdf($start_date,$end_date)
    {
        # get data
        
        $this->db->select("a.*, b.type, b.debtor_cd, b.debtor_name",false);
		$this->db->from('tr_deposit_trx as a');
		$this->db->join('sa_debtor as b', 'b.rowID = a.debtor_rowID');
        $this->db->where('a.deleted', 0);
        $this->db->where('b.deleted', 0);
        $this->db->where("a.date BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->db->order_by('a.rowID','desc');
        
        $query=$this->db->get();
        
        //echo $this->db->last_query();exit();
        $data = array();
        if ($query->num_rows() > 0) {
            $data = $query->result();
        }

        $query->free_result();

        return $data;


    }
	

}

/* End of file model.php */