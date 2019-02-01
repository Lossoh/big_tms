<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Debtor_model extends CI_Model
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

    function get_by_id($tabel, $id)
    {

        $this->db->from($tabel);
        $this->db->where('rowID', $id);
        $query = $this->db->get();
        return $query->row();
    }
    
    function get_by_name($debtor_name)
    {

        $this->db->from('sa_debtor');
        $this->db->where('debtor_name', $debtor_name);
        $query = $this->db->get();
        return $query->result();
    }
    
    function get_by_finger_id($finger_rowID)
    {

        $this->db->from('sa_debtor');
        $this->db->where('finger_rowID', $finger_rowID);
        $query = $this->db->get();
        return $query->row();
    }
    
    function delete_data($tabel,$id)
    {

        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));
        $this->db->where('rowID', $id);
        return $this->db->update($tabel);

    }
    
    /* 	function get_all_records_debtor($table,$where,$join_table,$join_criteria)
    {
    $this->db->where($where);
    if($join_table){
    $this->db->join($join_table,$join_criteria);
    }
    $query = $this->db->get($table);
    if ($query->num_rows() > 0){
    return $query->result();
    } else{
    return NULL;
    }
    
    } */

    public function select_max_id($table, $where, $field)
    {
        $this->db->select_max($field);
        $query = $this->db->where($where)->get($table);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $q) {
                return ((int)$q->$field);
            }
        }

    }

    function get_all_record_debtor($debtor_id)
    {
        $query = $this->db->query("SELECT name,category FROM sa_debtor_type  WHERE  rowID = $debtor_id AND deleted=0")->
            result();

        return $query;

    }

    function get_max_debtor($table, $where, $join_table, $join_criteria, $max)
    {
        $this->db->where($where);
        if ($join_table) {
            $this->db->join($join_table, $join_criteria);
        }
        $this->db->select_max($max);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }

    }

    function get_coa($table, $where, $join_table, $join_criteria, $order)
    {
        $this->db->where($where);
        if ($join_table) {
            $this->db->join($join_table, $join_criteria);
        }
        $query = $this->db->order_by($order, 'desc')->get($table);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }

    }

    function debtor_details($debtor_type)
    {
        $query = $this->db->where('rowID', $debtor_type)->get('sa_debtor');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }


}

/* End of file model.php */
