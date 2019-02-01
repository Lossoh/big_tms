<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class AppLib {

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
	public function total_tax($client = NULL)
   	 {
   	 	$avg_tax = $this->average_tax($client);
		$invoice_amount = $this->get_sum('items','total_cost',array('total_cost >'=>0));
		$tax = ($avg_tax/100) * $invoice_amount;
		return $tax;
	}
	function client_tax($client)
   	 {
   	 	$avg_tax = $this->average_tax($client);
		$invoice_amount = $this->client_payable($client);
		$tax = ($avg_tax/100) * $invoice_amount;
		return $tax;
	}
	function average_tax($client)
   	 {
   	 	$this->ci->db->select_avg('tax');
   	 	if($client != NULL){ $this->ci->db->where('client',$client); }   	 	
		$query = $this->ci->db->get('invoices')->row();
		return $query->tax;
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
	function company_details($company,$field) {
	$this->ci->db->where('co_id',$company);
	$this->ci->db->select($field);
	$query = $this->ci->db->get('companies');
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
  
  /*  public  function safe_b64encode($string) {
	
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }

	public function safe_b64decode($string) {
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }
	
    public  function encode($value){ 
		var $skey 	= "SuPerEncKey2010"; 
	    if(!$value){return false;}
        $text = $value;
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->skey, $text, MCRYPT_MODE_ECB, $iv);
        return trim($this->safe_b64encode($crypttext)); 
    }
    
    public function decode($value){
		var $skey 	= "SuPerEncKey2010"; 
        if(!$value){return false;}
        $crypttext = $this->safe_b64decode($value); 
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->skey, $crypttext, MCRYPT_MODE_ECB, $iv);
        return trim($decrypttext);
    } */
}

/* End of file User_prof.php */