<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Approval_reimburse_model extends CI_Model
{
	function get_data_approval($start_date, $end_date)
    {
        $this->db->select('a.*,b.username');
        $this->db->from('tr_approval_reimburse AS a');
        $this->db->join('sa_users AS b', 'b.rowID=a.user_approved', 'LEFT');
        $this->db->where('a.deleted = ', 0);
        $this->db->where("a.reimburse_date BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->db->order_by('a.reimburse_date', 'desc');
        return $this->db->get()->result();

    }

	function get_data_reimburse_by_reimburse_no($reimburse_no)
    {
        $this->db->select('*');
        $this->db->from('tr_approval_reimburse');
        $this->db->where('deleted = ', 0);
        $this->db->where("reimburse_no", $reimburse_no);

        $query = $this->db->get();
        if ($query->num_rows() > 0){
			return $query->row();
		} else{
			return NULL;
		}
    }
    
}

/* End of file model.php */