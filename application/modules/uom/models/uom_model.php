<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Uom_model extends CI_Model
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

    function uom_details($uom)
    {
        $query = $this->db->where('rowID', $uom)->get('sa_uom');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_by_id($tabel, $id)
    {

        $this->db->from($tabel);
        $this->db->where('rowID', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function delete_data($id)
    {

        $this->db->set('deleted', 1);
        $this->db->where('rowID', $id);
        return $this->db->update('sa_uom');

    }


}


/* End of file model.php */
