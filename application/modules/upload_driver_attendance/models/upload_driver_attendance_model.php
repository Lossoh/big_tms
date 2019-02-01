<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Upload_driver_attendance_model extends CI_Model
{
    function get_all_departement(){
        $this->db->select('*');
        $this->db->from('sa_dep');
        $this->db->where('pool','yes');
        $this->db->where('deleted',0);
        $this->db->order_by('dep_name','asc');
        $query=$this->db->get();
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function insert_file_content($lineArr,$terminal_id)
    {
        
        $data = array(
           'finger_id'          => $lineArr[0],
           'attendance_time'    => $lineArr[1],
           'terminal_id'        => $terminal_id,
           'user_created'       => $this->session->userdata('user_rowID'),
           'date_created'       => date('Y-m-d'),
           'time_created'       => date('H:i:s'),
       );
       
       $sql = "SELECT * FROM tr_log_driver_attendance WHERE finger_id = ".$lineArr[0]." AND attendance_time = '".$lineArr[1]."' AND terminal_id = ".$terminal_id;
       $check_exist_data = $this->db->query($sql)->result();
       
       if(count($check_exist_data) == 0){
            $this->db->insert('tr_log_driver_attendance', $data);
       }
       
    }
}

/* End of file model.php */