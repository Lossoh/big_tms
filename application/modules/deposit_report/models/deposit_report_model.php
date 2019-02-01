<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Deposit_report_model extends CI_Model
{
    
    function get_all_records_list($start_period,$end_period,$year)
    {
        $sql = "SELECT a.year, `a`.`period`, b.debtor_rowID, `c`.`debtor_name`, `a`.`deleted`, `b`.`deleted`, 
            			SUM(`b`.`driver_commission`) as driver_commission, SUM(`b`.`co_driver_commission`) as co_driver_commission, SUM(`b`.`amount_deposit`) as amount_deposit, 
            			SUM(`b`.`max_saldo_loan`) as max_saldo_loan, SUM(`b`.`amount_loan`) as amount_loan
                FROM (`tr_commission_trx` as a) JOIN `tr_commission_trx_dtl` as b ON `a`.`rowID` = `b`.`commission_rowID` JOIN `sa_debtor` as c ON `b`.`debtor_rowID` = `c`.`rowID` 
                GROUP BY a.year, b.debtor_rowID, `c`.`debtor_name`, `a`.`deleted`, `b`.`deleted`
                HAVING (`a`.`period` BETWEEN ".$start_period." AND ".$end_period.") AND `a`.`deleted` = 0 AND `b`.`deleted` = 0 AND a.year = '".$year."'
                ORDER BY `c`.`debtor_name` asc";
        $query=$this->db->query($sql);
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
        
    }
    
    function get_all_records_list_same_period($start_period,$year)
    {
        $sql = "SELECT a.year, `a`.`period`, b.debtor_rowID, `c`.`debtor_name`, `a`.`deleted`, `b`.`deleted`, 
            			`b`.`driver_commission`, `b`.`co_driver_commission`, `b`.`amount_deposit`, 
            			`b`.`max_saldo_loan`, `b`.`amount_loan`
                FROM (`tr_commission_trx` as a) JOIN `tr_commission_trx_dtl` as b ON `a`.`rowID` = `b`.`commission_rowID` JOIN `sa_debtor` as c ON `b`.`debtor_rowID` = `c`.`rowID` 
                WHERE `a`.`period` = ".$start_period." AND `a`.`deleted` = 0 AND `b`.`deleted` = 0 AND a.year = '".$year."'
                ORDER BY `c`.`debtor_name` asc";
        $query=$this->db->query($sql);
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
        
    }
}

/* End of file model.php */