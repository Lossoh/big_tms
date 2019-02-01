<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Cb_payment_receive_model extends CI_Model
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
    
    function get_account()
    {
        $this->db->select('g.*');
        $this->db->from('gl_coa as g ');
        $this->db->where('g.deleted', 0);
        $this->db->where('g.is_cash =', 'Y');
        $this->db->or_where('g.is_bank =', 'Y');
        $this->db->order_by('g.acc_cd', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    
    function get_data_cb_trx_hdr_by_date($coa_id,$start_date,$end_date,$start_time,$end_time)
    {
        $sql = "SELECT `a`.*, `b`.`payment_method`, `b`.`cash_bank` as cg_coa_rowID, `b`.`cg_amt`, `b`.`deleted` as delete_cg, b.status, b.reference_release_no
                    FROM (`cb_trx_hdr` as a) LEFT JOIN `cb_trx_cg` as b ON `a`.`trx_no` = `b`.`trx_no` AND `b`.`deleted` = 0
                    WHERE `a`.`deleted` = 0 AND `b`.`cash_bank` = ".$coa_id."
                            AND CONCAT(`a`.`date_created`,' ',`a`.`time_created`) BETWEEN '".$start_date." ".$start_time."' and '".$end_date." ".$end_time."'
                    ORDER BY `a`.`date_created` asc, `a`.`time_created` asc";
                    
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            $sql = "SELECT `a`.*, `b`.`payment_method`, `b`.`cash_bank` as cg_coa_rowID, `b`.`cg_amt`, `b`.`deleted` as delete_cg, b.status, b.reference_release_no
                FROM (`cb_trx_hdr` as a) LEFT JOIN `cb_trx_cg` as b ON `a`.`trx_no` = `b`.`trx_no` AND `b`.`deleted` = 0
                WHERE `a`.`deleted` = 0 AND `a`.`coa_rowID` = ".$coa_id."
                        AND CONCAT(`a`.`date_created`,' ',`a`.`time_created`) BETWEEN '".$start_date." ".$start_time."' and '".$end_date." ".$end_time."'
                ORDER BY `a`.`date_created` asc, `a`.`time_created` asc";
                
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return null;
            }
        }
    }
    
    function get_data_cb_trx_hdr_by_date2($coa_id,$start_date,$end_date,$start_time,$end_time)
    {
        $sql = "SELECT `a`.*, `b`.`payment_method`, `b`.`cash_bank` as cg_coa_rowID, `b`.`cg_amt`, `b`.`deleted` as delete_cg, b.status, b.reference_release_no
            FROM (`cb_trx_hdr` as a) LEFT JOIN `cb_trx_cg` as b ON `a`.`trx_no` = `b`.`trx_no` AND `b`.`deleted` = 0
            WHERE `a`.`deleted` = 0 AND `a`.`coa_rowID` = ".$coa_id."
                    AND CONCAT(`a`.`date_created`,' ',`a`.`time_created`) BETWEEN '".$start_date." ".$start_time."' and '".$end_date." ".$end_time."'
            ORDER BY `a`.`date_created` asc, `a`.`time_created` asc";
            
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    
    function get_data_cheque($trx_no)
    {
        $sql = "SELECT * FROM cb_trx_cg
                WHERE deleted = 0 AND (payment_method = 'cheque' OR payment_method = 'giro') AND trx_no = '$trx_no'
                ORDER BY rowID";
        
        $query = $this->db->query($sql);
        return $query->result();
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
    
}

/* End of file model.php */