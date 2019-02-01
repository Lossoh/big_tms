<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Expense_model extends CI_Model
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

		$this->db->select("a.*, CONCAT(b.acc_cd,' - ',b.acc_name) AS expense_acc, CONCAT(c.acc_cd,' - ',c.acc_name) AS ap_acc,
                            CONCAT(d.acc_cd,' - ',d.acc_name) AS reimburse_acc, CONCAT(e.acc_cd,' - ',e.acc_name) AS advance_acc,
                            f.advance_name",false);
		$this->db->from('sa_expense as a');
		$this->db->join('gl_coa as b', 'b.rowID = a.expense_acc_rowID','left');
		$this->db->join('gl_coa as c', 'c.rowID = a.ap_acc_rowID','left');
		$this->db->join('gl_coa as d', 'd.rowID = a.reimburse_acc_rowID','left');
		$this->db->join('gl_coa as e', 'e.rowID = a.advance_acc_rowID','left');
        $this->db->join('sa_advance_category as f', 'f.rowID = a.advance_category_rowID', 'left');	
        $this->db->where('a.deleted', 0);
        $this->db->order_by('a.rowID','desc');

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
	
	function expense_details($expense)
	{
		$query = $this->db->where('rowID',$expense)->get('sa_expense');
		if ($query->num_rows() > 0){
			return $query->result();
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
    
    function get_pdf()
    {
        # get data
        
       	$this->db->select("a.*, CONCAT(b.acc_cd,' - ',b.acc_name) AS expense_acc, CONCAT(c.acc_cd,' - ',c.acc_name) AS ap_acc,
                            CONCAT(d.acc_cd,' - ',d.acc_name) AS reimburse_acc, CONCAT(e.acc_cd,' - ',e.acc_name) AS advance_acc,
                            f.advance_name",false);
		$this->db->from('sa_expense as a');
		$this->db->join('gl_coa as b', 'b.rowID = a.expense_acc_rowID','left');
		$this->db->join('gl_coa as c', 'c.rowID = a.ap_acc_rowID','left');
		$this->db->join('gl_coa as d', 'd.rowID = a.reimburse_acc_rowID','left');
		$this->db->join('gl_coa as e', 'e.rowID = a.advance_acc_rowID','left');
        $this->db->join('sa_advance_category as f', 'f.rowID = a.advance_category_rowID', 'left');	
        $this->db->where('a.deleted', 0);
        $this->db->order_by('a.rowID', 'desc');
        $hasil = $this->db->get();

        //echo $this->db->last_query();exit();
        $data = array();
        if ($hasil->num_rows() > 0) {
            $data = $hasil->result();
        }

        $hasil->free_result();

        return $data;


    }
	

}

/* End of file model.php */