<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class User_profile {

	function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->database();
	}
	public function count_table_rows($table)
    	{
	$query = $this->ci->db->get($table);
		if ($query->num_rows() > 0)
			{
  		 return $query->num_rows();
  		}else{
  			return 0;
  		}
	}
	public function task_by_status($progress)
    	{
    	$this->ci->db->where('progress <',$progress);
	$query = $this->ci->db->get('tasks');
		if ($query->num_rows() > 0)
			{
  		 return $query->num_rows();
  		}else{
  			return 0;
  		}
	}
	public function invoice_perc($invoice)
   	 {
   	 $invoice_payment = $this->invoice_payment($invoice);
   	 $invoice_payable = $this->invoice_payable($invoice);
   	 if ($invoice_payable < 1 OR $invoice_payment < 1) {
   	 	$perc_paid = 0;
   	 }else{
   	 	$perc_paid = ($invoice_payment/$invoice_payable)*100;
   	 }
		return round($perc_paid);
	}
	public function invoice_payment($invoice)
   	 {
	$this->ci->db->where('invoice',$invoice);
	$this->ci->db->select_sum('amount');
	$query = $this->ci->db->get('payments');
		if ($query->num_rows() > 0)
			{
  		 $row = $query->row();
  		 return $row->amount;
  		}
	}
	public function client_paid($client)
   	 {
	$query = $this->ci->db->where('paid_by',$client)->select_sum('amount')->get('payments')->row();
		
  		 return $query->amount;
	}
	public function invoice_payable($invoice)
   	 {
	$this->ci->db->select_sum('total_cost');
	$query = $this->ci->db->where('invoice_id',$invoice)->get('items');
		if ($query->num_rows() > 0)
			{
  		 $row = $query->row();
  		 return $row->total_cost;
  		}
	}

	public function client_invoices($client)
   	 {
	return $this->ci->db->get_where('invoices',array('client' => $client))->result_array();
	}
	public function client_payable($client)
   	 {
   	 	$this->ci->db->join('invoices','invoices.inv_id = items.invoice_id');
		$this->ci->db->select_sum('total_cost');
		$this->ci->db->where('client', $client);
		$query = $this->ci->db->get('items');
		if ($query->num_rows() > 0)
			{
  		 	$row = $query->row();
  		 	$sum_total = $row->total_cost;
  		 	return $sum_total;
  		}else{
  			return 0;
  		}
	}

	public function estimate_payable($estimate)
   	 {
	$query = $this->ci->db->where('estimate_id',$estimate)->select_sum('total_cost')->get('estimate_items');
  	$row = $query->row();
  	return $row->total_cost;
	}
	public function average_monthly_paid($month)
   	 {
   	 $month_paid = $this->monthly_payment($month);
   	 $amount_paid = $this->total_payments();
   	 if ($amount_paid == 0 OR $month_paid == 0) {
   	 	$perc_paid = 0;	
  		 return $perc_paid;
   	 }else{
   	 $perc_paid = ($month_paid/$amount_paid)*100;	
  		 return round($perc_paid);
  		}
	}
	public function monthly_payment($month)
   	 {
	$this->ci->db->where('month_paid',$month);
	$this->ci->db->where('year_paid',date('Y'));
	$this->ci->db->select_sum('amount');
	$query = $this->ci->db->get('payments');
		if ($query->num_rows() > 0)
			{
  		 $row = $query->row();
  		 return $row->amount;
  		}
	}
	function project_hours($project){
		$task_time = $this->get_sum('tasks','logged_time',array('project'=>$project));
		$project_time = $this->get_sum('projects','time_logged',array('project_id'=>$project));
		$logged_time = ($task_time + $project_time)/3600;
		return $logged_time;
	}
	public function total_payments()
   	 {
	$this->ci->db->select_sum('amount');
	$query = $this->ci->db->get('payments');
		if ($query->num_rows() > 0)
			{
  		 $row = $query->row();
  		 return $row->amount;
  		}
	}
	public function generate_string()
   	 {
   	 $this->ci->load->helper('string');
   	 return random_string('nozero', 7);
	}
	
	function role_by_id($role_id) {
	$query = $this->ci->db->where('rowID',$role_id)->select('role')->get('sa_roles');
		if ($query->num_rows() > 0)
			{
  		 $row = $query->row();
  		 return $row->role;
  		}
	}	

	function get_user_details($user,$field) {
	$this->ci->db->where('rowID',$user);
	$this->ci->db->select($field);
	$query = $this->ci->db->get('sa_users');
		if ($query->num_rows() > 0)
			{
  		 $row = $query->row();
  		 return $row->$field;
  		}
	}
	function get_profile_details($user,$field) {
	$this->ci->db->where('user_rowID',$user);
	$this->ci->db->select($field);
	$query = $this->ci->db->get('sa_user_details');
		if ($query->num_rows() > 0)
			{
  		 $row = $query->row();
  		 return $row->$field;
  		}
	}

	function get_invoice_details($invoice,$field) {
	$this->ci->db->where('inv_id',$invoice);
	$this->ci->db->select($field);
	$query = $this->ci->db->get('invoices');
		if ($query->num_rows() > 0)
			{
  		 $row = $query->row();
  		 return $row->$field;
  		}
	}

	function get_project_details($project,$field) {
	$this->ci->db->where('project_id',$project);
	$this->ci->db->select($field);
	$query = $this->ci->db->get('projects');
		if ($query->num_rows() > 0)
			{
  		 $row = $query->row();
  		 return $row->$field;
  		}
	}

	function estimate_details($estimate,$field) {
	$this->ci->db->where('est_id',$estimate);
	$this->ci->db->select($field);
	$query = $this->ci->db->get('estimates');
		if ($query->num_rows() > 0)
			{
  		 $row = $query->row();
  		 return $row->$field;
  		}
	}
	function payment_details($pid,$field) {
	$this->ci->db->where('p_id',$pid);
	$this->ci->db->select($field);
	$query = $this->ci->db->get('payments');
		if ($query->num_rows() > 0)
			{
  		 $row = $query->row();
  		 return $row->$field;
  		}
	}
	function count_rows($table,$where)
	{
		$this->ci->db->where($where);
		$query = $this->ci->db->get($table);
		if ($query->num_rows() > 0){
			return $query->num_rows();
		} else{
			return 0;
		}
	}
	function get_sum($table,$field,$where)
	{
		$this->ci->db->where($where);
		$this->ci->db->select_sum($field);
		$query = $this->ci->db->get($table);
		if ($query->num_rows() > 0){
		$row = $query->row();
  		 return $row->$field;
		} else{
			return 0;
		}
	}

    function get_access($menu_id,$field)
	{
		$this->ci->db->where('user_rowID',$this->ci->session->userdata('user_id'));
		$this->ci->db->where('StatusUsermenu','1');
		$this->ci->db->where('Kd_Menu',$menu_id);
        $query = $this->ci->db->get('sa_usermenu');
		if ($query->num_rows() > 0){
            $row = $query->row();
            return $row->$field;
		} else{
			return 0;
		}
	}

    function get_user_access($field)
	{
	    if($this->ci->uri->segment(2) == '')
            $link_menu = $this->ci->uri->segment(1);
        else{
            $link_menu = $this->ci->uri->segment(1).'/'.$this->ci->uri->segment(2);
        }

		$this->ci->db->where('status','1');
		$this->ci->db->where('Link_Menu',$link_menu);
        $query_menu = $this->ci->db->get('sa_menu');        
        $get_menu = $query_menu->row();
        $menu_id = $get_menu->Seq_Menu;

        if($menu_id > 0){
    		$this->ci->db->where('user_rowID',$this->ci->session->userdata('user_id'));
    		$this->ci->db->where('StatusUsermenu','1');
    		$this->ci->db->where('Kd_Menu',$menu_id);
            $query = $this->ci->db->get('sa_usermenu');
    		if ($query->num_rows() > 0){
                $row = $query->row();
                return $row->$field;
    		} else{
    			return 0;
    		}
        } 
        else{
    	   return 0;
    	}
        
	}
    
    function get_user_access_alternative($link_menu,$field)
	{
		$this->ci->db->where('status','1');
		$this->ci->db->where('Link_Menu',$link_menu);
        $query_menu = $this->ci->db->get('sa_menu');        
        $get_menu = $query_menu->row();
        $menu_id = $get_menu->Seq_Menu;

        if($menu_id > 0){
    		$this->ci->db->where('user_rowID',$this->ci->session->userdata('user_id'));
    		$this->ci->db->where('StatusUsermenu','1');
    		$this->ci->db->where('Kd_Menu',$menu_id);
            $query = $this->ci->db->get('sa_usermenu');
    		if ($query->num_rows() > 0){
                $row = $query->row();
                return $row->$field;
    		} else{
    			return 0;
    		}
        } 
        else{
    	   return 0;
    	}
        
	}
    
    function get_log_limited_printed($trx_no,$module)
	{
        $sql = "SELECT * FROM activities 
                WHERE user_rowID = ".$this->ci->session->userdata('user_id')." AND activity LIKE '%".$trx_no."%' AND module = '".$module."' 
                        AND icon = 'fa-print' AND deleted = 0";
        $query = $this->ci->db->query($sql);
		if ($query->num_rows() > 0){
            return $query->num_rows();
		} else{
			return 0;
		}	   
    }
    
	function get_time_diff($from , $to){
    	$diff = abs ( $from - $to );
    	$years = $diff/31557600;
    	$months = $diff/2635200;
    	$weeks = $diff/604800;
    	$days = $diff/86400;
    	$hours = $diff/3600;
    	$minutes = $diff/60;
    	if ($years > 1) {
    		$duration = round($years) .' years';
    	}elseif ($months > 1) {
    		$duration = round($months) .' months';
    	}elseif ($weeks > 1) {
    		$duration = round($weeks) .' weeks';
    	}elseif ($days > 1) {
    		$duration = round($days).' days';
    	}elseif ($hours > 1) {
    		$duration = round($hours) .' hours';
    	} else {
    		$duration = round($minutes) .' minutes';
    	}
    	
    	return $duration;
	}

	function addOrdinalNumberSuffix($num) {
      switch ($num) {
        // Handle 1st, 2nd, 3rd
        case 1:  return $num.'st';
        case 2:  return $num.'nd';
        case 3:  return $num.'rd';
      }
    return $num.'th';
  }
  
}

/* End of file User_prof.php */