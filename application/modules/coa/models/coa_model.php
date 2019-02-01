<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Coa_model extends CI_Model
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
    
    function get_all_record_data()
    {

        $this->db->select("a.rowID,a.acc_cd,a.acc_name,a.acc_level,a.acc_sub_of_rowID,a.acc_debit_credit,
        case when a.acc_type='H' then 'HEADER' else 'DETAIL' end as acc_type,
        case when a.acc_class='A' then 'ASSETS'
         when a.acc_class='L' then 'LIABILITIES'
         when a.acc_class='C' then 'CAPITAL'
         when a.acc_class='I' then 'INCOME'
         when a.acc_class='E' then 'EXPENSE' end as acc_class,
         case when a.is_cash ='Y' then 'YES' else 'NO' end as is_cash,
         case when a.is_bank ='Y' then 'YES' else 'NO' end as is_bank,
         case when a.is_vat_in = 'Y' then 'YES' else 'NO' end as is_vat_in,
         case when a.is_vat_out = 'Y' then 'YES' else 'NO' end as is_vat_out,
         case when a.active = 'Y' then 'YES' else 'NO' end as active
           ", false);
        $this->db->from('gl_coa as a');
        $this->db->where('a.deleted', 0);
        $this->db->order_by('a.acc_cd', 'asc');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }

    }
    
    function get_by_id($tabel, $id)
    {
        $this->db->select("a.*,concat(b.acc_cd,'-',b.acc_name) as sub_acc ",false);
        $this->db->from('gl_coa a');
        $this->db->join('gl_coa b','a.acc_sub_of_rowID=b.rowID','left');
        $this->db->where('a.rowID', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function delete_data($tabel, $id)
    {

        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));
        $this->db->where('rowID', $id);
        return $this->db->update($tabel);

    }

    function get_all_record_coa($level_coa)
    {
        $query = $this->db->query("SELECT acc_cd FROM gl_coa  WHERE  acc_level = $level_coa AND deleted=0")->
            result();

        return $query;

    }
    function save($tabel,$coa_data)
    {
        $result=$this->db->insert($tabel, $coa_data);
        //$coa_id = $this->db->insert_id();
        
        if ($result){
            return true;
        }else{
            return false;
        }

    }

    function coa_details($coa)
    {
        $query = $this->db->where('rowID', $coa)->get('gl_coa');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }




}

/* End of file model.php */
