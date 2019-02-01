<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Loan_report_model extends CI_Model
{
    function get_data_debtor()
    {
        $sql = "SELECT * FROM (`sa_debtor`) WHERE `deleted` = 0 AND (`type` = 'D' OR `type` = 'E') ORDER BY `type` asc";
                        
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }
        
    }
    
    function get_data_debtor_by_id($debtor_id)
    {
        $this->db->select('*');
        $this->db->from('sa_debtor');
        $this->db->where('rowID', $debtor_id);
        $this->db->order_by('type', 'asc');
        $query = $this->db->get();
        return $query->row();
    }
    
    function get_all_records_list($start_date, $end_date, $debtor_id)
    {
        if ($debtor_id != 'all')
        {
            $str_partial_data = ' AND `a`.`employee_driver_rowID` = '.$debtor_id;
        }
        
        $sql = "SELECT `a`.*, `b`.`by_jo` as by_jo, `b`.`only_driver` as only_driver, `b`.`fare_trip` as fare_trip, `b`.`advance_name`, c.type as debtor_type, `c`.`debtor_cd` as debtor_code, 
                        `c`.`debtor_name` as debtor_name, `d`.`police_no` as police_no, `d`.`vehicle_photo` as vehicle_photo, `d`.`vehicle_type`, `e`.`type_cd` as type_code, `e`.`type_name` as type_name, 
                        `f`.`fare_trip_cd` as fare_trip_no, `g`.`destination_no` as destination_from_no, `g`.`destination_name` as destination_from_name, 
                        `h`.`destination_no` as destination_to_no, `h`.`destination_name` as destination_to_name, 
                        CONCAT(j.latitude, ',', j.longitude) as origin_coordinate, 
                        CONCAT(k.latitude, ',', k.longitude) as destination_coordinate 
                FROM (`cb_cash_adv` AS a) LEFT JOIN `sa_advance_type` AS b ON `b`.`rowID`=`a`.`advance_type_rowID` 
											LEFT JOIN `sa_debtor` AS c ON `c`.`rowID`=`a`.`employee_driver_rowID` 
											LEFT JOIN `sa_vehicle` AS d ON `d`.`rowID`=`a`.`vehicle_rowID` LEFT JOIN `sa_vehicle_type` AS e ON `e`.`rowID`=`a`.`vehicle_type_rowID` 
											LEFT JOIN `sa_fare_trip_hdr` AS f ON `f`.`rowID` = `a`.`fare_trip_rowID` 
											LEFT JOIN `sa_destination` AS g ON `g`.`rowID`=`f`.`destination_from_rowID` 
											LEFT JOIN `sa_destination` AS h ON `h`.`rowID`=`f`.`destination_to_rowID` 
											LEFT JOIN `sa_users` AS i ON `i`.`rowID`=`a`.`user_created` 
											LEFT JOIN `sa_koordinat_poi` AS j ON `j`.`rowID`=`g`.`coordinate_rowID` 
											LEFT JOIN `sa_koordinat_poi` AS k ON `k`.`rowID`=`h`.`coordinate_rowID`                 
                WHERE `a`.`deleted` = 0 AND a.advance_type_rowID = 4 AND `a`.`advance_date` BETWEEN '".$start_date."' AND '".$end_date."' ".$str_partial_data."
                ORDER BY `a`.`advance_date`, `a`.`advance_no` asc";
        
        $query = $this->db->query($sql);
        
        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }
        
    }
    
    function get_all_balance_records_list($start_date, $end_date, $debtor_id)
    {
        if ($debtor_id != 'all')
        {
            $str_partial_data = ' AND `a`.`employee_driver_rowID` = '.$debtor_id;
        }
        
        $sql = "SELECT `a`.*, `b`.`by_jo` as by_jo, `b`.`only_driver` as only_driver, `b`.`fare_trip` as fare_trip, `b`.`advance_name`, c.type as debtor_type, `c`.`debtor_cd` as debtor_code, 
                        `c`.`debtor_name` as debtor_name, `d`.`police_no` as police_no, `d`.`vehicle_photo` as vehicle_photo, `d`.`vehicle_type`, `e`.`type_cd` as type_code, `e`.`type_name` as type_name, 
                        `f`.`fare_trip_cd` as fare_trip_no, `g`.`destination_no` as destination_from_no, `g`.`destination_name` as destination_from_name, 
                        `h`.`destination_no` as destination_to_no, `h`.`destination_name` as destination_to_name, 
                        CONCAT(j.latitude, ',', j.longitude) as origin_coordinate, 
                        CONCAT(k.latitude, ',', k.longitude) as destination_coordinate 
                FROM (`cb_cash_adv` AS a) LEFT JOIN `sa_advance_type` AS b ON `b`.`rowID`=`a`.`advance_type_rowID` 
											LEFT JOIN `sa_debtor` AS c ON `c`.`rowID`=`a`.`employee_driver_rowID` 
											LEFT JOIN `sa_vehicle` AS d ON `d`.`rowID`=`a`.`vehicle_rowID` LEFT JOIN `sa_vehicle_type` AS e ON `e`.`rowID`=`a`.`vehicle_type_rowID` 
											LEFT JOIN `sa_fare_trip_hdr` AS f ON `f`.`rowID` = `a`.`fare_trip_rowID` 
											LEFT JOIN `sa_destination` AS g ON `g`.`rowID`=`f`.`destination_from_rowID` 
											LEFT JOIN `sa_destination` AS h ON `h`.`rowID`=`f`.`destination_to_rowID` 
											LEFT JOIN `sa_users` AS i ON `i`.`rowID`=`a`.`user_created` 
											LEFT JOIN `sa_koordinat_poi` AS j ON `j`.`rowID`=`g`.`coordinate_rowID` 
											LEFT JOIN `sa_koordinat_poi` AS k ON `k`.`rowID`=`h`.`coordinate_rowID`                 
                WHERE `a`.`deleted` = 0 AND `a`.`advance_balance` = 0 AND a.advance_type_rowID = 4 AND `a`.`advance_date` BETWEEN '".$start_date."' AND '".$end_date."' ".$str_partial_data."
                ORDER BY `a`.`advance_date`, `a`.`advance_no` asc";
        
        $query = $this->db->query($sql);
        
        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }
        
    }
    
    function get_all_unbalance_records_list($start_date, $end_date, $debtor_id)
    {
        if ($debtor_id != 'all')
        {
            $str_partial_data = ' AND `a`.`employee_driver_rowID` = '.$debtor_id;
        }
        
        $sql = "SELECT `a`.*, `b`.`by_jo` as by_jo, `b`.`only_driver` as only_driver, `b`.`fare_trip` as fare_trip, `b`.`advance_name`, c.type as debtor_type, `c`.`debtor_cd` as debtor_code, 
                        `c`.`debtor_name` as debtor_name, `d`.`police_no` as police_no, `d`.`vehicle_photo` as vehicle_photo, `d`.`vehicle_type`, `e`.`type_cd` as type_code, `e`.`type_name` as type_name, 
                        `f`.`fare_trip_cd` as fare_trip_no, `g`.`destination_no` as destination_from_no, `g`.`destination_name` as destination_from_name, 
                        `h`.`destination_no` as destination_to_no, `h`.`destination_name` as destination_to_name, 
                        CONCAT(j.latitude, ',', j.longitude) as origin_coordinate, 
                        CONCAT(k.latitude, ',', k.longitude) as destination_coordinate 
                FROM (`cb_cash_adv` AS a) LEFT JOIN `sa_advance_type` AS b ON `b`.`rowID`=`a`.`advance_type_rowID` 
											LEFT JOIN `sa_debtor` AS c ON `c`.`rowID`=`a`.`employee_driver_rowID` 
											LEFT JOIN `sa_vehicle` AS d ON `d`.`rowID`=`a`.`vehicle_rowID` LEFT JOIN `sa_vehicle_type` AS e ON `e`.`rowID`=`a`.`vehicle_type_rowID` 
											LEFT JOIN `sa_fare_trip_hdr` AS f ON `f`.`rowID` = `a`.`fare_trip_rowID` 
											LEFT JOIN `sa_destination` AS g ON `g`.`rowID`=`f`.`destination_from_rowID` 
											LEFT JOIN `sa_destination` AS h ON `h`.`rowID`=`f`.`destination_to_rowID` 
											LEFT JOIN `sa_users` AS i ON `i`.`rowID`=`a`.`user_created` 
											LEFT JOIN `sa_koordinat_poi` AS j ON `j`.`rowID`=`g`.`coordinate_rowID` 
											LEFT JOIN `sa_koordinat_poi` AS k ON `k`.`rowID`=`h`.`coordinate_rowID`                 
                WHERE `a`.`deleted` = 0 AND `a`.`advance_balance` != 0 AND a.advance_type_rowID = 4 AND `a`.`advance_date` BETWEEN '".$start_date."' AND '".$end_date."' ".$str_partial_data."
                ORDER BY `a`.`advance_date`, `a`.`advance_no` asc";
        
        $query = $this->db->query($sql);
        
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