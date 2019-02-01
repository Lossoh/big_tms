<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Verify_driver_model extends CI_Model
{
    function get_all_record_data_debtor(){
   			$this->db->select("rowID, type, debtor_cd, debtor_name",false);
			$this->db->from('sa_debtor');
            $this->db->where('deleted', 0);
            $this->db->where('type', 'D');
            $this->db->order_by('debtor_name','asc');

            $query=$this->db->get();
            
            if ($query->num_rows() > 0){
    			return $query->result();
    		} else{
    			return NULL;
    		}

    }

    function get_queue_by_debtor($debtor_id){
   			$this->db->select("*",false);
			$this->db->from('tr_queue');
            $this->db->where('debtor_id', $debtor_id);

            $query=$this->db->get();
            
            if ($query->num_rows() > 0){
    			return $query->row();
    		} else{
    			return NULL;
    		}

    }
    
    function get_attendance_by_debtor($debtor_id){
   			$this->db->select("*");
			$this->db->from('tr_log_attendance');
            $this->db->where('debtor_id', $debtor_id);
            $this->db->order_by('rowID', 'desc');
            $query=$this->db->get();
            
            if ($query->num_rows() > 0){
    			return $query->row();
    		} else{
    			return NULL;
    		}

    }
    
    function get_queue_by_verify_user($user_id){
		$this->db->select("fullname");
		$this->db->from('sa_user_details');
        $this->db->where('user_rowID', $user_id);

        $query=$this->db->get();
        
        if ($query->num_rows() > 0){
			return $query->row();
		} else{
			return NULL;
		}

    }
    
    function get_attendance_daily_by_debtor($debtor_id){
		$this->db->select("*");
		$this->db->from('tr_log_attendance');
        $this->db->where('DATE(date_created)', date('Y-m-d'));
        $this->db->where('debtor_id', $debtor_id);

        $query=$this->db->get();
        
        if ($query->num_rows() > 0){
			return $query->row();
		} else{
			return NULL;
		}

    }
    
    function get_attendance_by_absen($absent_code){
        $this->db->select("*");
        $this->db->from('tr_log_attendance');
        $this->db->where('absent_code', $absent_code);
        // $this->db->order_by('rowID', 'desc');
        // $this->db->group_by('debtor_id');
        $query=$this->db->get();
        if ($query->num_rows() > 0){
            return $query->result();
        } else{
            return NULL;
        }
    }
    
}

/* End of file model.php */