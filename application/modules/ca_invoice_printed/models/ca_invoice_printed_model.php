<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Ca_invoice_printed_model extends CI_Model
{
	function get_all_records_list($start_date, $end_date)
    {
        $sql = "SELECT a.*, b.username, b.email FROM activities as a LEFT JOIN sa_users as b ON a.user_rowID = b.rowID
                WHERE (module = 'Print Cash Advance' OR module = 'Finances->Print Realization' OR module = 'realizations->Print Realization' OR module = 'invoice'
                        OR module = 'Account Payable' OR module = 'Advance' OR module = 'Reimburse' OR module = 'Generate Commission' OR module = 'Cash Bank Payment'
                        OR module = 'Cash Bank Payment (Branch)' OR module = 'realizations_branch->Print Realization')
                        AND icon = 'fa-print' AND a.deleted = 0 
                        AND DATE(activity_date) BETWEEN '".$start_date."' AND '".$end_date."'
                ORDER BY a.activity_id desc";
        
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
        
    }

}

/* End of file model.php */