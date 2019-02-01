<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Department_model extends CI_Model
{
	
	function get_all_records($table,$where,$join_table,$join_criteria,$order)
	{
		$this->db->where($where);
		if($join_table){
		$this->db->join($join_table,$join_criteria);
		}
		$query = $this->db->order_by($order,'desc')->get($table);
		if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
		
	}
    
     function get_all_record_data(){

   			$this->db->select("a.*,
                CONCAT(c.acc_cd,' - ',c.acc_name) as cash_gl_coa",false);
			$this->db->from('sa_dep as a');
			$this->db->join('gl_coa as c', 'c.rowID = a.cash_gl_rowID','left');
            $this->db->where('a.deleted', 0);
            $this->db->order_by('a.rowID','desc');

            $query=$this->db->get();
            
            if ($query->num_rows() > 0){
    			return $query->result();
    		} else{
    			return NULL;
    		}

    }
	
	function department_details($department)
	{
		$query = $this->db->where('rowID',$department)->get('sa_dep');
		if ($query->num_rows() > 0){
			return $query->result();
		} 
	}
    
    function get_account()
    {
        $this->db->select('g.*');
        $this->db->from('gl_coa as g ');
        $this->db->where('g.deleted', 0);
        $this->db->where('g.is_cash', 'Y');
        $this->db->order_by('g.acc_cd', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }

    }
    
    function delete_data($id){
        
        $this->db->set('deleted',1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));
        $this->db->where('rowID',$id);
        $result = $this->db->update('sa_dep');
	
    }
    
    
   	function get_by_id($tabel,$id)
	{  

		$this->db->from($tabel);
		$this->db->where('rowID',$id);
		$query = $this->db->get();
		return $query->row();
	}
	

}

/* End of file model.php */