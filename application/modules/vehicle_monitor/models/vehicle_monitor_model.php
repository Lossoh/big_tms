<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Vehicle_monitor_model extends CI_Model
{
    function get_position_vehicle()
	{
	    $sql = "SELECT a.vehicle_id, `b`.`police_no`, `b`.`vehicle_photo`, a.speed, SUBSTRING(TRIM(CONV(a.status,16,2)),-2) as status, (a.latitude*0.000001) as latitude, 
                    (a.longitude*0.000001) as longitude, a.gps_time, DATE_FORMAT(DATE_ADD(DATE_ADD('2008-08-08 08:08:08', INTERVAL a.gps_time SECOND),
                    INTERVAL 7 hour),'%d %b %Y %T') as time_gps, DATE_FORMAT(DATE_ADD(DATE_ADD('2008-08-08 08:08:08', INTERVAL a.gps_time SECOND),
                    INTERVAL 7 hour),'%Y-%m-%d %T') as datetime_gps
                FROM (`tr_monitoring_trx_last_position` as a) JOIN `sa_vehicle` as b ON `a`.`vehicle_id` = `b`.`rowID` 
                ORDER BY datetime_gps DESC";

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }
        		
	}
    
    function get_destination_data($vehicle_id)
	{
	    $sql = "SELECT a.advance_date, b.fare_trip_cd
                FROM cb_cash_adv as a LEFT JOIN sa_fare_trip_hdr as b ON a.fare_trip_rowID = b.rowID
                WHERE a.vehicle_rowID = ".$vehicle_id." AND a.deleted = 0 AND b.deleted = 0
                ORDER BY a.advance_date DESC LIMIT 1";

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0)
        {
            return $query->row();
        } else
        {
            return null;
        }
        		
	}
    
    function get_coordinates(){
        $this->db->select('*');
        $this->db->from('sa_koordinat_poi');
        $this->db->where('deleted',0);
        $this->db->order_by('location_name','asc');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }
    }
       
}

/* End of file model.php */
