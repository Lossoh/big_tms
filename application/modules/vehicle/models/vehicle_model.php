<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Vehicle_model extends CI_Model
{
    function get_all_records_list($select, $where, $join_table1, $join_criteria1, $order,
        $sort)
    {
        $sql = "SELECT `sa_vehicle`.*, sa_dep.dep_name, `sa_debtor`.`debtor_cd` AS driver_code, `sa_debtor`.`debtor_name` AS driver_name 
        FROM (`sa_vehicle`) LEFT JOIN `sa_debtor` ON `sa_vehicle`.`debtor_rowID`=`sa_debtor`.`rowID` 
                            LEFT JOIN `sa_dep` ON `sa_vehicle`.`dep_rowID`=`sa_dep`.`rowID`
        WHERE `sa_vehicle`.`rowID` > 0 AND `sa_vehicle`.`deleted` = 0 
                ORDER BY `sa_vehicle`.`rowID` asc";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }

    }

    function get_all_records($table, $where, $join_table, $join_criteria, $order, $sort)
    {
        $this->db->where($where);
        if ($join_table)
        {
            $this->db->join($join_table, $join_criteria);
        }
        $query = $this->db->order_by($order, $sort)->get($table);
        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }

    }

    function get_by_id($tabel, $id)
    {
        $this->db->from($tabel);
        $this->db->where('rowID', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function get_by_id_debtor($id)
    {
        $this->db->from('sa_vehicle');
        $this->db->where('debtor_rowID', $id);
        $query = $this->db->get();
        return $query->row();
    }
    
    function get_position_vehicle_by_row_id($row_id)
	{
	    $sql = "SELECT a.vehicle_id, `b`.`police_no`, a.speed, SUBSTRING(TRIM(CONV(a.status,16,2)),-2) as status, (a.latitude*0.000001) as latitude, 
                    (a.longitude*0.000001) as longitude, a.gps_time, DATE_FORMAT(DATE_ADD(DATE_ADD('2008-08-08 08:08:08', INTERVAL a.gps_time SECOND),
                    INTERVAL 7 hour),'%d %b %Y %T') as time_gps, DATE_FORMAT(DATE_ADD(DATE_ADD('2008-08-08 08:08:08', INTERVAL a.gps_time SECOND),
                    INTERVAL 7 hour),'%Y-%m-%d %T') as datetime_gps
                FROM (`tr_monitoring_trx_last_position` as a) JOIN `sa_vehicle` as b ON `a`.`vehicle_id` = `b`.`rowID` 
                WHERE a.vehicle_id = ".$row_id."
                ORDER BY datetime_gps DESC";

        $query = $this->db->query($sql);

		return $query->row();
		
	}

    function delete_data($id)
    {

        $this->db->set('deleted', 1);
        $this->db->where('rowID', $id);
        $result = $this->db->update('sa_vehicle');

    }

    function vehicle_details($vehicle)
    {
        $query = $this->db->where('rowID', $vehicle)->get('sa_vehicle');
        if ($query->num_rows() > 0)
        {
            return $query->result();
        }
    }


    function get_pdf()
    {
        # get data
        $hasil = $this->db->query("select a.police_no, a.vehicle_type, a.gps_no, 
                            a.no_stnk, a.expired_stnk, a.status_stnk, a.no_kir, a.expired_kir, a.status_kir, a.no_bpkb, a.status_bpkb,
                            a.no_insurance, a.expired_insurance, a.status_insurance, a.no_kiu, a.expired_kiu, a.status_kiu,
                            Concat(c.debtor_cd,' - ',c.debtor_name) as Driver
                            from sa_vehicle a
                            left  join sa_debtor c on c.rowID = a.debtor_rowID where a.deleted =0");

        //echo $this->db->last_query();exit();
        $data = array();
        if ($hasil->num_rows() > 0)
        {
            $data = $hasil->result();
        }

        $hasil->free_result();

        return $data;


    }

}

/* End of file model.php */
