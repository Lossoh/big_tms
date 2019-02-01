<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Cash_advance_pending_model extends CI_Model
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
    
    function get_data_departement(){
        $this->db->select('*');
        $this->db->from('sa_dep');
        $this->db->where('deleted',0);
        $this->db->where('pool','yes');
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
        
    }
    
    function get_all_records_list($dep_rowID, $start_date, $end_date)
    {
        $this->db->select('a.*,
							b.by_jo as by_jo,
							b.only_driver as only_driver,
							b.fare_trip as fare_trip,
							b.advance_name,
							c.debtor_cd as debtor_code,
							c.debtor_name as debtor_name,
							d.police_no as police_no,
							d.vehicle_photo as vehicle_photo,
							e.type_cd as type_code,
							e.type_name as type_name,
							f.fare_trip_cd as fare_trip_no,
							g.destination_no as destination_from_no,
							g.destination_name as destination_from_name,
							h.destination_no as destination_to_no,
							h.destination_name as destination_to_name');
        $this->db->from('cb_cash_adv AS a');
        $this->db->join('sa_advance_type AS b', 'b.rowID=a.advance_type_rowID', 'LEFT');
        $this->db->join('sa_debtor AS c', 'c.rowID=a.employee_driver_rowID', 'LEFT');
        $this->db->join('sa_vehicle AS d', 'd.rowID=a.vehicle_rowID', 'LEFT');
        $this->db->join('sa_vehicle_type AS e', 'e.rowID=a.vehicle_type_rowID', 'LEFT');
        $this->db->join('sa_fare_trip_hdr AS f', 'f.rowID = a.fare_trip_rowID', 'LEFT');
        $this->db->join('sa_destination AS g', 'g.rowID=f.destination_from_rowID',
            'LEFT');
        $this->db->join('sa_destination AS h', 'h.rowID=f.destination_to_rowID', 'LEFT');
        $this->db->join('sa_users AS i', 'i.rowID=a.user_created', 'LEFT');
        $this->db->where('a.deleted =', 0);
        $this->db->where('a.advance_balance !=', 0);
        $this->db->where('a.advance_type_rowID !=', 4);
        $this->db->where("a.advance_date BETWEEN '".$start_date."' AND '".$end_date."'");
        if ($dep_rowID != 'all')
        {
            $this->db->where('i.dep_rowID =', $dep_rowID);
        }
        $this->db->order_by('a.advance_no', 'asc');
        //echo $this->db->last_query();exit();
        return $this->db->get()->result();
        //return $this->db->get()->result_array(); //if($partial_data>0){$this->db->where('i.dep_rowID =',$dep_rowID)};

    }
    
    function get_data_memo_by_advance_no($advance_no){
        $this->db->select('*');
        $this->db->from('cb_memo');
        $this->db->where('advance_no',$advance_no);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
        
    }
    
}

/* End of file model.php */