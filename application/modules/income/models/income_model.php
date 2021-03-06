<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Income_model extends CI_Model
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

   			$this->db->select("a.*,
                CONCAT(b.acc_cd,' - ',b.acc_name) AS income_accrued,
                concat(c.acc_cd,' - ',c.acc_name) as income_account ",false);
			$this->db->from('sa_income as a');
			$this->db->join('gl_coa as b', 'b.rowID = a.accrued_coa_rowID','left');
            $this->db->join('gl_coa as c', 'c.rowID = a.income_coa_rowID','left');
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
    
    function delete_data($tabel,$id)
    {

        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));
        $this->db->where('rowID', $id);
        return $this->db->update($tabel);

    }
	
	function cost_code_details($cost_code)
	{
		$query = $this->db->where('rowID',$cost_code)->get('sa_cost');
		if ($query->num_rows() > 0){
			return $query->result();
		} 
	}
    
        function get_pdf()
    {
        # get data
        
        $this->db->select("a.*,
                CONCAT(b.acc_cd,' - ',b.acc_name) AS accrued_coa,
                CONCAT(c.acc_cd,' - ',c.acc_name) AS income_coa", false);
        $this->db->from('sa_income as a');
        $this->db->join('gl_coa as b', 'b.rowID = a.accrued_coa_rowID', 'left');
        $this->db->join('gl_coa as c', 'c.rowID = a.income_coa_rowID', 'left');
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