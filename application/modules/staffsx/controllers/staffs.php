<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staffs extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		if (!$this->tank_auth->is_logged_in()) {
			$this->session->set_flashdata('message',lang('login_required'));
			redirect('auth/login');
		}
		if ($this->tank_auth->user_role($this->tank_auth->get_role_id()) == 'admin') {
			redirect('welcome');
		}
		if ($this->tank_auth->user_role($this->tank_auth->get_role_id()) == 'collaborator') {
			redirect('collaborator');
		}
	}

	function index()
	{
	$this->load->model('welcome','home_model');
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title('Welcome - '.$this->config->item('website_name'));
	$data['page'] = lang('home');
	//$data['projects'] = $this->home_model->recent_projects($this->tank_auth->get_user_id(),$limit = 5);
	//$data['activities'] = $this->home_model->recent_activities($this->tank_auth->get_user_id(),$limit = 6);
	$this->template
	->set_layout('users')
	->build('welcome',isset($data) ? $data : NULL);
	}
	function _monthly_data($month)
	{
		$this->db->select_sum('amount');
		$this->db->where('paid_by', $this->tank_auth->get_user_id());
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

/* End of file clients.php */