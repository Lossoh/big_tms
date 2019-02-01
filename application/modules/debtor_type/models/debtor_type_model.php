<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Debtor_type_model extends CI_Model
{


    function get_all_records($table, $where, $join_table, $join_criteria, $order)
    {

        $this->db->where($where);
        if ($join_table) {
            $this->db->join($join_table, $join_criteria);
        }
        $query = $this->db->order_by('$order', 'desc')->get($table);


        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }

    }
    /*
    function _get_datatables_query()
    {
    
    $this->db->select("a.*,
    CONCAT(b.acc_cd,' - ',b.acc_name) AS receivable_acc,
    CONCAT(c.acc_cd,' - ',c.acc_name) as advance_acc,
    CONCAT(d.acc_cd,' - ',d.acc_name) as deposit_acc,
    concat(e.acc_cd,' - ',e.acc_name) as rounding_acc,
    concat(f.acc_cd,' - ',f.acc_name) as adm_acc",false);
    $this->db->from('sa_debtor_type as a');
    $this->db->join('gl_coa as b', 'b.rowID = a.receiveable_coa_rowID','left');
    $this->db->join('gl_coa as c', 'c.rowID = a.advance_coa_rowID','left');
    $this->db->join('gl_coa as d', 'd.rowID = a.deposit_coa_rowID','left');
    $this->db->join('gl_coa as e', 'e.rowID = a.rounding_coa_rowID','left');
    $this->db->join('gl_coa as f', 'f.rowID = a.adm_coa_rowID','left');

    $i = 0;
    
    foreach ($this->column as $item) 
    {
    if($_POST['search']['value'])
    ($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
    $column[$i] = $item;
    $i++;
    }
    
    if(isset($_POST['order']))
    {
    $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } 
    else if(isset($this->order))
    {
    $order = $this->order;
    $this->db->order_by(key($order), $order[key($order)]);
    }
    }
    
    function get_datatables()
    {
    $this->_get_datatables_query();
    if($_POST['length'] != -1)
    $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result();
    }
    
    function count_filtered()
    {
    $this->_get_datatables_query();
    $query = $this->db->get();
    return $query->num_rows();
    }
    
    function count_all()
    {
    $this->db->from($this->table);
    return $this->db->count_all_results();
    }
    */
    function get_all_record_data()
    {

        $this->db->select("a.*,
                CONCAT(b.acc_cd,' - ',b.acc_name) AS receivable_acc,
                CONCAT(c.acc_cd,' - ',c.acc_name) as advance_acc,
                CONCAT(d.acc_cd,' - ',d.acc_name) as deposit_acc,
                concat(e.acc_cd,' - ',e.acc_name) as rounding_acc,
                concat(f.acc_cd,' - ',f.acc_name) as adm_acc,
                concat(g.acc_cd,' - ',g.acc_name) as payable_acc,
                concat(h.acc_cd,' - ',h.acc_name) as commission_acc", false);
        $this->db->from('sa_debtor_type as a');
        $this->db->join('gl_coa as b', 'b.rowID = a.receiveable_coa_rowID', 'left');
        $this->db->join('gl_coa as c', 'c.rowID = a.advance_coa_rowID', 'left');
        $this->db->join('gl_coa as d', 'd.rowID = a.deposit_coa_rowID', 'left');
        $this->db->join('gl_coa as e', 'e.rowID = a.rounding_coa_rowID', 'left');
        $this->db->join('gl_coa as f', 'f.rowID = a.adm_coa_rowID', 'left');
        $this->db->join('gl_coa as g', 'g.rowID = a.payable_coa_rowID', 'left');
        $this->db->join('gl_coa as h', 'h.rowID = a.commission_coa_rowID', 'left');
        $this->db->where('a.deleted', 0);
        $this->db->order_by('a.rowID', 'desc');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }

    }

    function get_account()
    {
        $this->db->select('g.*');
        $this->db->from('gl_coa as g ');
        $this->db->where('g.deleted', 0);
        //$this->db->where('g.acc_transition', 'Y');
        $this->db->order_by('g.acc_cd', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }

    }

    function save($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
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
        $result = $this->db->update('sa_debtor_type');

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

    function debtor_type_details($debtor_type)
    {
        $query = $this->db->where('rowID', $debtor_type)->get('sa_debtor_type');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_pdf()
    {
        # get data
        
        $this->db->select("a.*,
                CONCAT(b.acc_cd,' - ',b.acc_name) AS receivable_acc,
                CONCAT(c.acc_cd,' - ',c.acc_name) as advance_acc,
                CONCAT(d.acc_cd,' - ',d.acc_name) as deposit_acc,
                concat(e.acc_cd,' - ',e.acc_name) as rounding_acc,
                concat(f.acc_cd,' - ',f.acc_name) as adm_acc,
                concat(g.acc_cd,' - ',g.acc_name) as payable_acc,
                concat(h.acc_cd,' - ',h.acc_name) as commission_acc", false);
        $this->db->from('sa_debtor_type as a');
        $this->db->join('gl_coa as b', 'b.rowID = a.receiveable_coa_rowID', 'left');
        $this->db->join('gl_coa as c', 'c.rowID = a.advance_coa_rowID', 'left');
        $this->db->join('gl_coa as d', 'd.rowID = a.deposit_coa_rowID', 'left');
        $this->db->join('gl_coa as e', 'e.rowID = a.rounding_coa_rowID', 'left');
        $this->db->join('gl_coa as f', 'f.rowID = a.adm_coa_rowID', 'left');
        $this->db->join('gl_coa as g', 'g.rowID = a.payable_coa_rowID', 'left');
        $this->db->join('gl_coa as h', 'h.rowID = a.commission_coa_rowID', 'left');
        $this->db->where('a.deleted', 0);
        $this->db->order_by('a.rowID', 'desc');

        
        $hasil = $this->db->get();

        //echo $this->db->last_query();exit();
        $data = array();
        if ($hasil->num_rows() > 0) {
            $data = $hasil->result();
        }

        $hasil->free_result();

        return $data;


    }


}

/* End of file model.php */
