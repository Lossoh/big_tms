<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Do_commission_report_model extends CI_Model
{
    function get_all_driver()
    {
        $this->db->select('*');
        $this->db->from('sa_debtor');
        $this->db->where('type', 'D');
        $this->db->where('deleted', 0);
        $this->db->order_by('debtor_name', 'asc');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }
        
    }
    
    function get_driver_by_id($rowID)
    {
        $this->db->select('*');
        $this->db->from('sa_debtor');
        $this->db->where('rowID', $rowID);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->row();
        } else
        {
            return null;
        }
        
    }
    
    function get_all_records_list($start_date, $end_date, $debtor_id)
    {
        if($debtor_id != ''){
            $debtor_condition = "AND `b`.`employee_driver_rowID` = ".$debtor_id;
        }
        
        $sql = "SELECT `a`.`rowID`, `a`.`trx_no`, `a`.`jo_no`, `a`.`do_no`, a.deliver_weight, a.received_weight, a.deliver_date, a.received_date, `a`.`status`, `a`.`deleted`, `a`.`invoice_no`, `a`.`commission_no`, `a`.`komisi_supir`, `a`.`komisi_kernet`, `a`.`date_verified`,
                        `b`.`advance_no`, `b`.`advance_date`, `b`.`advance_allocation`, `c`.`debtor_name`, `d`.`police_no`, e.alloc_date, e.doc_sj, e.doc_st, e.doc_sm, e.doc_sr, 
                        `f`.`vessel_name`, g.destination_name as from_name, h.destination_name as to_name, i.item_name
                FROM (`tr_do_trx` as a) 
                    LEFT JOIN `cb_cash_adv` as b ON `a`.`trx_no` = `b`.`trx_no` 
                    LEFT JOIN `sa_debtor` as c ON `b`.`employee_driver_rowID` = `c`.`rowID` 
                    LEFT JOIN `sa_vehicle` as d ON `b`.`vehicle_rowID` = `d`.`rowID` 
                    LEFT JOIN `cb_cash_adv_alloc` as e ON `a`.`trx_no` = `e`.`alloc_no` 
                    LEFT JOIN `tr_jo_trx_hdr` as f ON `a`.`jo_no` = `f`.`jo_no`
                    LEFT JOIN `sa_destination` as g ON `f`.`destination_from_rowID` = `g`.`rowID`
                    LEFT JOIN `sa_destination` as h ON `f`.`destination_to_rowID` = `h`.`rowID`
                    LEFT JOIN `sa_item` as i ON `f`.`item_rowID` = `i`.`rowID`
                WHERE `a`.`deleted` = 0 AND `b`.`deleted` = 0 AND `e`.`deleted` = 0 AND `f`.`deleted` = 0 ".$debtor_condition." AND `b`.`advance_date` BETWEEN '".$start_date."' and '".$end_date."' 
                ORDER BY a.commission_no desc, `a`.`trx_no`, `a`.`do_no`, `a`.`received_date` desc";

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
        
    }

}

/* End of file model.php */