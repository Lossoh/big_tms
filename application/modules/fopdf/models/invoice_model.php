<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * @package	Freelancer Office
 * @author	William M
 */
class Invoice_model extends CI_Model
{
	
	function invoice_details($invoice_id)
	{
		$this->db->join('companies','companies.co_id = invoices.client');
		return $this->db->where('inv_id',$invoice_id)->get('invoices')->result();
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

	function estimate_details($estimate)
	{
		$this->db->join('companies','companies.co_id = estimates.client');
		return $this->db->where('est_id',$estimate)->get('estimates')->result();
	}
	function estimate_items($estimate)
	{
		$this->db->join('estimates','estimates.est_id = estimate_items.estimate_id');
		$query = $this->db->where('estimate_id',$estimate)->get('estimate_items');
		if ($query->num_rows() > 0){
			return $query->result();
		} 
	}
	
}

/* End of file model.php */