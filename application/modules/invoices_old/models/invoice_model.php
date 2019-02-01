<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
**********************************************************************************
* Copyright: gitbench 2014
* Licence: Please check CodeCanyon.net for licence details. 
* More licence clarification available here: htttp://codecanyon.net/wiki/support/legal-terms/licensing-terms/ 
* CodeCanyon User: http://codecanyon.net/user/gitbench
* CodeCanyon Project: http://codecanyon.net/item/freelancer-office/8870728
* Package Date: 2014-09-24 09:33:11 
***********************************************************************************
*/
class Invoice_model extends CI_Model
{
	
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
	
    function clients()
	{
		$query = $this->db->where('role_id !=',1)->get('users');
		if ($query->num_rows() > 0){
			return $query->result();
		} 
	}

    function payment_methods()
	{
			return $this->db->get('payment_methods')->result();
	}
	function saved_items()
	{
			return $this->db->get('items_saved')->result();
	}
	function invoice_details($invoice_id)
	{
		$this->db->join('companies','companies.co_id = invoices.client');
		return $this->db->where('inv_id',$invoice_id)->get('invoices')->result();
	}
	function payment_details($p_id)
	{
		$this->db->join('payment_methods','payment_methods.method_id = payments.payment_method');
		$this->db->join('companies','companies.co_id = payments.paid_by');
		return $this->db->where('p_id',$p_id)->get('payments')->result();
	}
	function invoice_activities($invoice_id)
	{
		$this->db->join('users','users.id = activities.user');
		$this->db->where('module', 'invoices');
		return $this->db->where('module_field_id',$invoice_id)->order_by('activity_date','desc')->get('activities')->result();
	}

	function search_invoice($keyword)
	{
		$this->db->join('companies','companies.co_id = invoices.client');
		return $this->db->like('reference_no', $keyword)->order_by("date_saved","desc")->get('invoices')->result();
	}

	function search_payment($keyword)
	{
		$this->db->join('companies','companies.co_id = payments.paid_by');
		return $this->db->like('trans_id',$keyword)
						->or_like('company_name',$keyword)
						->order_by('created_date','desc')
						->get('payments')->result();
	}
	function saved_item_details($item)
	{
		return $this->db->where('item_id',$item)->get('items_saved')->result();
	}
	function invoice_items($invoice_id)
	{
		$this->db->join('invoices','invoices.inv_id = items.invoice_id');
		$query = $this->db->where('invoice_id',$invoice_id)->get('items');
		if ($query->num_rows() > 0){
			return $query->result();
		} 
	}
	function payment_status($invoice) {
		$invoice_payable = $this->user_profile->invoice_payable($invoice);
		$invoice_paid = $this->user_profile->invoice_payment($invoice);
		$due = $invoice_payable - $invoice_paid;
		if($invoice_paid < 1){
			return lang('not_paid');
		}elseif ($due <= 0) {
			return lang('fully_paid');
		}else{
			return lang('partially_paid');
		}
	}
	function get_client($invoice){
	$query = $this->db->select('client')->where('inv_id',$invoice)->get('invoices');
		if ($query->num_rows() > 0)
			{
  		 $row = $query->row();
  		 return $row->client;
  		}
	}
}

/* End of file model.php */