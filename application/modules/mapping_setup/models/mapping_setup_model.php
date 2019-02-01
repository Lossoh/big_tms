<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mapping_setup_model extends CI_Model
{
	function get_all_records_list()
	{
		$this->db->select('a.*,
							b.acc_cd as trans_acc_code, 
							b.acc_name as trans_acc_name, 
							c.acc_cd as cash_opr_acc_code,
							c.acc_name as cash_opr_acc_name,
							d.acc_cd as bank_receipt_acc_code,
							d.acc_name as bank_receipt_acc_name,
							e.acc_cd as bank_payment_acc_code,
							e.acc_name as bank_payment_acc_name,
							e.acc_cd as bank_payment_acc_code,
							e.acc_name as bank_payment_acc_name,
							f.debtor_cd as employee_code,
							f.debtor_name as employee_name,
							g.uom_cd as uom_code,
							g.descs as uom_name');
		$this->db->from('sa_spec AS a');
		$this->db->join('gl_coa AS b','a.gl_coaID_trans_acc = b.rowID', 'LEFT');
		$this->db->join('gl_coa AS c','a.gl_coaID_cash_opr_acc = c.rowID', 'LEFT');
		$this->db->join('gl_coa AS d','a.gl_coaID_bank_receipt_acc = d.rowID', 'LEFT');
		$this->db->join('gl_coa AS e','a.gl_coaID_bank_payment_acc = e.rowID', 'LEFT');
		$this->db->join('sa_debtor AS f','a.employeeID_cash_adv=f.rowID', 'LEFT');
		$this->db->join('sa_uom AS g','a.uomID_uom=g.rowID', 'LEFT');
		$this->db->where('a.rowID >','0');
		return $this->db->get()->result_array(); 
	}
	
	function get_all_records($table,$where,$join_table,$join_criteria,$order)
	{
		$this->db->where($where);
		if($join_table){
		$this->db->join($join_table,$join_criteria);
		}
		$query = $this->db->order_by($order,'desc')->get($table);
		if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
		
	}
	
	function mapping_setup_details($mapping_setup)
	{
		$this->db->select('a.*,
							b.acc_cd as trans_acc_code, 
							b.acc_name as trans_acc_name, 
							c.acc_cd as cash_opr_acc_code,
							c.acc_name as cash_opr_acc_name,
							d.acc_cd as bank_receipt_acc_code,
							d.acc_name as bank_receipt_acc_name,
							e.acc_cd as bank_payment_acc_code,
							e.acc_name as bank_payment_acc_name,
							e.acc_cd as bank_payment_acc_code,
							e.acc_name as bank_payment_acc_name,
							f.employee_cd as employee_code,
							f.employee_name as employee_name,
							g.uom_cd as uom_code,
							g.descs as uom_name');
		$this->db->from('sa_spec AS a');
		$this->db->join('gl_coa AS b','a.gl_coaID_trans_acc = b.rowID', 'LEFT');
		$this->db->join('gl_coa AS c','a.gl_coaID_cash_opr_acc = c.rowID', 'LEFT');
		$this->db->join('gl_coa AS d','a.gl_coaID_bank_receipt_acc = d.rowID', 'LEFT');
		$this->db->join('gl_coa AS e','a.gl_coaID_bank_payment_acc = e.rowID', 'LEFT');
		$this->db->join('sa_employee AS f','a.employeeID_cash_adv=f.rowID', 'LEFT');
		$this->db->join('sa_uom AS g','a.uomID_uom=g.rowID', 'LEFT');
		$this->db->where('a.rowID',$mapping_setup);
		return $this->db->get()->result_array(); 
	}
	
	function user_activities($user_id,$limit)
	{
		$this->db->join('users','users.id = activities.user');
		return $this->db->where('user',$user_id)
							->order_by('activity_date','DESC')
							->get('activities',$limit,$this->uri->segment(5))->result();
	}
}

/* End of file model.php */