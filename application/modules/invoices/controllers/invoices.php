<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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


class Invoices extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('invoices/invoice_model');
	}

	function index()
	{
	$data['page'] = lang('chart');
	$data['chart'] = TRUE;
	$this->load->view('invoices/invoice_chart',isset($data) ? $data : NULL);
	}
	function _monthly_data($month)
	{
		$this->db->select_sum('amount');
		$this->db->where('month_paid', $month); 
		$this->db->where('year_paid', date('Y')); 
		$query = $this->db->get('payments');
		foreach ($query->result() as $row)
			{
				$amount = $row->amount ? $row->amount : 0;
   				return round($amount);
			}
	}
}

/* End of file invoices.php */