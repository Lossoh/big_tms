<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Utility_vehicles_model extends CI_Model
{
    function get_all_records($table, $where, $join_table, $join_criteria, $order, $sort)
    {
        $this->db->where($where);
        if ($join_table) {
            $this->db->join($join_table, $join_criteria);
        }
        $query = $this->db->order_by($order, $sort)->get($table);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
        
    }

    function get_data_department(){
        $this->db->select('*');
        $this->db->from('sa_dep');
        $this->db->where('pool','yes');
        $this->db->where('deleted',0);
        $this->db->order_by('dep_name','asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
        
    }
        
    function get_data_by_row_id($table,$rowID){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('rowID',$rowID);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
        
    }
    
    function get_data_police_no_table_temp($table){
        $sql = "SELECT police_no, vehicle_type FROM ".$table." GROUP BY police_no ORDER BY rowID asc";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    
    function insert_data($table,$data){
        $result=$this->db->insert($table, $data);
        if ($result){
            return true;
        }
        else{
            return false;
        }
    }
    
    function get_data_utility($department_id, $start_date, $end_date){
        $sql = "SELECT DISTINCT `f`.`police_no`, `f`.`vehicle_type`, `b`.`weight`, `d`.`trip_condition`, (e.advance_amount + e.advance_extra_amount) as uang_jalan, 
                `c`.`komisi_supir`, `c`.`komisi_kernet`, `a`.`total_amt`, a.trx_no, b.jo_no, e.advance_no
                FROM (`ar_trx_hdr` as a) 
                	JOIN `tr_jo_trx_hdr` as b ON `a`.`jo_no` = `b`.`jo_no` 
                	JOIN `tr_do_trx` as c ON `b`.`jo_no` = `c`.`jo_no` 
                	JOIN `sa_fare_trip_hdr` as d ON `b`.`fare_trip_rowID` = `d`.`rowID` 
                	JOIN `cb_cash_adv` as e ON `e`.`fare_trip_rowID` = `b`.`fare_trip_rowID` 
                	JOIN `sa_vehicle` as f ON `e`.`vehicle_rowID` = `f`.`rowID` 
                WHERE e.dep_rowID = ".$department_id." AND a.deleted = 0 AND b.deleted = 0 AND c.deleted = 0 AND e.deleted = 0
                       AND a.trx_date BETWEEN '".$start_date."' AND '".$end_date."' 
                ORDER BY `f`.`police_no`, a.trx_no, b.jo_no, e.advance_no asc
                ";
        $query = $this->db->query($sql);
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
        
    }
    
    function get_total_temp($police_no,$table){
        $sql = "SELECT police_no, SUM(weight) as jumlah_ton, COUNT(police_no) as jumlah_rit, SUM(uang_jalan) as jumlah_uang_jalan,
                SUM(komisi_supir) as jumlah_komisi_supir, SUM(komisi_kernet) as jumlah_komisi_kernet, SUM(total_amt) as jumlah_tarif
                FROM ".$table." 
                GROUP BY police_no
                HAVING police_no = '".$police_no."'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

    function get_total_pok($police_no,$table){
        $sql = "SELECT COUNT(trip_condition) as jumlah_pok 
                FROM ".$table." 
                WHERE police_no = '".$police_no."' AND trip_condition = 'pok'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }
    
    function drop_table($table){
        $sql = 'DROP TABLE '.$table;

        $query=$this->db->query($sql);    

        return $query;
    }
    
}

/* End of file model.php */