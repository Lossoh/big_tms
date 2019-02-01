<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Yearly_bonus_report_model extends CI_Model
{
    function get_vehicles(){
        $this->db->select('*');
        $this->db->from('sa_vehicle');
        $this->db->where('deleted',0);
        $this->db->order_by('police_no','asc');
        $query=$this->db->get();
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_all_records_list($police_no, $start_date, $end_date)
    {
        $sql = "SELECT a.deleted, b.deleted, d.deleted, a.status, a.commission_no, a.date_created, c.police_no, SUM(a.received_weight) as tonase, 
                        COUNT(a.do_no) as ritase, SUM(e.poin) as point, SUM(e.total) as amount
                FROM (`tr_do_trx` as a) LEFT JOIN `cb_cash_adv` as b ON `b`.`trx_no` = `a`.`trx_no` 
                                        LEFT JOIN `sa_vehicle` as c ON `c`.`rowID`=`b`.`vehicle_rowID` 
                                        LEFT JOIN `tr_jo_trx_hdr` as d ON `d`.`jo_no` = `a`.`jo_no`
                                        LEFT JOIN `sa_fare_trip_hdr` as e ON `e`.`rowID` = `d`.`fare_trip_rowID`
                GROUP BY a.deleted, b.deleted, d.deleted, a.status, a.commission_no, c.police_no
                HAVING `a`.`deleted` = 0 AND `b`.`deleted` = 0 AND `d`.`deleted` = 0 AND `a`.`status` = 1 AND `a`.`commission_no` <> '' 
                        AND `c`.`police_no` = '".$police_no."' AND (`a`.`date_created` BETWEEN '".$start_date."' and '".$end_date."') 
                ORDER BY `c`.`police_no` asc";
          
        $query=$this->db->query($sql);
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
        
    }

}

/* End of file model.php */