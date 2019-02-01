<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Vehicle_position_model extends CI_Model
{
	function get_all_records_list()
	{
	    $sql = "SELECT `a`.rowID, a.type, a.vehicle_id, a.position, a.speed, SUBSTRING(TRIM(CONV(a.status,16,2)),-2) as status, a.note, (a.latitude*0.000001) as latitude, (a.longitude*0.000001) as longitude,
                        a.gps_time, a.date_modified, `b`.`police_no`, DATE_FORMAT(DATE_ADD(DATE_ADD('2008-08-08 08:08:08', INTERVAL a.gps_time SECOND),INTERVAL 7 hour),'%d %b %Y %T') as time_gps
            FROM (`mo_vehicle_position` as a) JOIN `sa_vehicle` as b ON `a`.`vehicle_id` = `b`.`rowID` 
            WHERE `a`.`deleted` = 0 AND `b`.`deleted` = 0 
            ORDER BY `a`.`date_modified` DESC";

        $query = $this->db->query($sql);

		return $query->result();
		
	}
	
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
    
   	function get_by_id($tabel,$id)
	{  

		$this->db->from($tabel);
		$this->db->where('rowID',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
      function delete_data($id){
        
        $this->db->set('deleted',1);
        $this->db->where('rowID',$id);
        $result = $this->db->update('mo_vehicle_position');
	
    }

}

/* End of file model.php */