<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| @package Freelancer Office
|--------------------------------------------------------------------------
|
| 
*/
class AppModel extends CI_Model {

     public function __construct()
     {
		parent::__construct();
     }

    // function get_all_records($table,$where,$join_table,$join_criteria,$order)
	// {
		// $this->db->where($where);
		// if($join_table){
			// $this->db->join($join_table,$join_criteria,'LEFT');
		// }
		// $query = $this->db->order_by($order,'desc')->get($table);
		// if ($query->num_rows() > 0){
			// return $query->result();
		// } else{
			// return NULL;
		// }
	// }
	function get_all_records($table, $where, $join_table, $join_criteria, $order, $sort)
	{
		$this->db->where($where);
		if($join_table){
		$this->db->join($join_table,$join_criteria);
		}
		$query = $this->db->order_by($order,$sort)->get($table);
		if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
		
	}
	
    function get_all_records_asc($table,$where,$join_table,$join_criteria,$order)
		{
			$this->db->where($where);
			if($join_table){
			$this->db->join($join_table,$join_criteria,'LEFT');
			}
			$query = $this->db->order_by($order,'asc')->get($table);
			if ($query->num_rows() > 0){
				return $query->result();
			} else{
				return NULL;
			}		
	}
		
     function get_all_records_select($select,$table,$where,$join_table,$join_criteria,$order)
		{			
			$this->db->select($select);
			$this->db->from($table);			
			if($join_table){
			$this->db->join($join_table,$join_criteria,'LEFT');
			}
			$this->db->where($where);
			$query = $this->db->order_by($order,'desc')->get();
			if ($query->num_rows() > 0){
				return $query->result();
			} else{
				return NULL;
			}
		}
		
	function get_all_record_reference($table,$where,$order)
	{
		$this->db->where($where);

		$query = $this->db->order_by($order,'asc')->get($table);
		if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
	}

	function get_all_records_limit($table,$where,$join_table,$join_criteria,$order,$limit)
	{
		$this->db->where($where);
		if($join_table){
		$this->db->join($join_table,$join_criteria);
		}
		$query = $this->db->order_by($order,'desc')->get($table,$limit);
		if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
	}
    
	public function select_max_id($table,$where,$field)
	{
		$this->db->select_max($field);
		$query = $this->db->where($where)->get($table);
		
		if($query->num_rows()>0){
            foreach($query->result() as $q){
				return ((int)$q->$field);
			}
		}

	}	

	function sum_item($table,$where,$fieldsum)
   	{
	$this->db->where($where);
	$this->db->select_sum($fieldsum);
	$query = $this->db->get($table);
		if ($query->num_rows() > 0)
		{
  		 $row = $query->row();
  		 return $row->$fieldsum;
			
  		}
	}
	
	function check_key($table,$where)
    {
		
        $this->db->where($where);
        $query=$this->db->get($table);
        if($query->num_rows()>0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }	
	
	
	function get_id($table,$where,$field)
   	{
	$this->db->where($where);
	$this->db->select($field);
	$query = $this->db->get($table);
		if ($query->num_rows() > 0)
		{
		
		 $row = $query->row();
  		 return $row->$field;
  	

			
  		}
	}	
    
	function trucking_id($month)
		{
		
			$this->db->select('truck_ref');
			$this->db->from('mst_trucks');			
			$this->db->where('truck_id', $month); 
			$query = $this->db->get();
			foreach ($query->result() as $row)
				{
					 
					return $row->$truck_ref;
				}
	}

	public function getTransporter($where)
    {
		$this->db->select('a.transporter_id, b.transporter_name, a.truck_type_id, c.Nm_Ref');
		$this->db->from('mst_trucks AS a');
		$this->db->join('mst_transporters AS b','b.transporter_id = a.transporter_id', 'LEFT');
		$this->db->join('sa_reference AS c','c.No_Urut_Ref=a.truck_type_id AND c.Type_Ref="truck_type"', 'LEFT');
		$this->db->where($where);
        return $this->db->get();
    }
	
	public function getSJDetail($where)
    {
				if (is_numeric($where)){
					$query = $this->db->query("SELECT a.sj_id, a.sj_ref, a.sj_date, a.sj_time, b.destination_name AS destination_from, c.destination_name AS destination_to, a.qty_bulk_delivery_netto, a.qty_bulk_receipt_netto, a.qty_bulk_delivery_netto - a.qty_bulk_receipt_netto AS qty_difference FROM fx_trx_sj a LEFT JOIN fx_mst_destinations b ON b.destination_id = a.destination_from LEFT JOIN fx_mst_destinations c ON c.destination_id=a.destination_to  WHERE a.deleted=0 and a.barcode_id=$where");
				}else{
									$query = $this->db->query("SELECT a.sj_id, a.sj_ref, a.sj_date, a.sj_time, b.destination_name AS destination_from, c.destination_name AS destination_to, a.qty_bulk_delivery_netto, a.qty_bulk_receipt_netto, a.qty_bulk_delivery_netto - a.qty_bulk_receipt_netto AS qty_difference FROM fx_trx_sj a LEFT JOIN fx_mst_destinations b ON b.destination_id = a.destination_from LEFT JOIN fx_mst_destinations c ON c.destination_id=a.destination_to  WHERE a.deleted=0 and a.sj_ref='$where'");
				}
		
		return $query;
		
		/* $this->db->select('a.sj_id, a.sj_ref, a.sj_date, a.sj_time, b.destination_name AS destination_from, c.destination_name AS destination_to, a.qty_bulk_delivery_netto, a.qty_bulk_receipt_netto, a.qty_bulk_delivery_netto - a.qty_bulk_receipt_netto AS qty_difference ');
		$this->db->from('trx_sj AS a');
		$this->db->join('mst_destinations AS b','b.destination_id = a.destination_from', 'LEFT');
		$this->db->join('mst_destinations AS c','c.destination_id=a.destination_to', 'LEFT');
		$this->db->where('a.barcode_id',$where);    
		$this->db->or_where_in('a.sj_ref', $where);
        return $this->db->get();
     */}
	public function addtolistrecapsj($sj_id, $company_id, $site_id, $recap_id, $recap_no)
    {

	$query="INSERT INTO fx_trx_recap_document_d(fx_trx_recap_document_d.company_id,
		fx_trx_recap_document_d.site_id,
		fx_trx_recap_document_d.recap_id,
		fx_trx_recap_document_d.recap_no,
		fx_trx_recap_document_d.sj_id,
		fx_trx_recap_document_d.sj_ref,
		fx_trx_recap_document_d.sj_date,
		fx_trx_recap_document_d.sj_time,
		fx_trx_recap_document_d.po_ref,
		fx_trx_recap_document_d.destination_from,
		fx_trx_recap_document_d.destination_to,
		fx_trx_recap_document_d.vessel_id,
		fx_trx_recap_document_d.truck_id,
		fx_trx_recap_document_d.truck_type_id,
		fx_trx_recap_document_d.transporter_id,
		fx_trx_recap_document_d.item_id,
		fx_trx_recap_document_d.qty_bulk_delivery_netto,
		fx_trx_recap_document_d.qty_bulk_receipt_netto,
		fx_trx_recap_document_d.driver_name,
		fx_trx_recap_document_d.user_created)
	SELECT 1,1,".$recap_id.",".$recap_no.", a.sj_id,
		a.sj_ref,
		a.sj_date,
		a.sj_time,
		a.po_ref,
		a.destination_from,
		a.destination_to,
		a.vessel_id,
		a.truck_id,
		a.truck_type_id,
		a.transporter_id,
		a.item_id,
		a.qty_bulk_delivery_netto,
		a.qty_bulk_receipt_netto,
		a.driver_name,
		a.user_created
	FROM fx_trx_sj a
	where a.deleted=0 and sj_id=$sj_id	
	";

		if (!$this->db->query($query)) 
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
		
    }
	public function getRecapDocumentDetails($where)
    {
		$this->db->select('a.sj_id, a.sj_ref, a.sj_date, a.sj_time, b.destination_name AS destination_from, c.destination_name AS destination_to, a.qty_bulk_delivery_netto, a.qty_bulk_receipt_netto, a.qty_bulk_delivery_netto - a.qty_bulk_receipt_netto AS qty_difference ');
		$this->db->from('fx_trx_recap_document_d AS a');
		$this->db->join('mst_destinations AS b','b.destination_id = a.destination_from', 'LEFT');
		$this->db->join('mst_destinations AS c','c.destination_id=a.destination_to', 'LEFT');
		$this->db->where($where);
        return $this->db->get();
    }	
	
	function unload_receipt_details($unload_receipt_id)
	{
		
		$query = $this->db->query("SELECT a.unload_receipt_id,a.vessel_id, b.vessel_name, b.vessel_ref, unload_receipt_date, unload_receipt_time, unload_receipt_ref,  truck_name, transporter_name, transporter_ref, Nm_Ref, a.driver_name, expired_date, description, username, sj_ref, a.date_created, a.time_created
		FROM fx_trx_unload_receipt a 
		LEFT JOIN fx_mst_vessels b ON b.vessel_id=a.vessel_id
		LEFT JOIN fx_mst_transporters c ON c.transporter_id=a.transporter_id
		LEFT JOIN fx_mst_trucks d ON d.truck_id=a.truck_id
		LEFT JOIN fx_sa_reference e ON e.No_Urut_Ref=a.truck_type_id AND e.Type_Ref='truck_type'
		LEFT JOIN fx_users f ON f.id=a.user_created
		LEFT JOIN fx_trx_sj g ON g.unload_receipt_id=a.unload_receipt_id 
		WHERE a.unload_receipt_id=$unload_receipt_id AND a.deleted=0 AND no_bon_muat>0")->result();
				
		return $query;
	
	}	
	
	
	function getHeaderUserMenu($kd_perusahaan, $kd_cabang, $kd_user, $role_id){
	

		$this->db->select('a.*, b.*, c.*, b.Kd_Menu AS bKd_Menu');
		$this->db->from('sa_users AS a');
		$this->db->join('sa_usermenu AS b','b.company_rowID = a.company_rowID AND b.user_rowID = a.rowID', 'LEFT');
		$this->db->join('sa_menu AS c','c.Seq_Menu=b.Kd_Menu', 'LEFT');
		$this->db->where('a.company_rowID = ',$kd_perusahaan);
		$this->db->where('a.dep_rowID = ',$kd_cabang);
		$this->db->where('a.rowID = ',$kd_user);
		$this->db->where('a.role_rowID = ',$role_id);
		$this->db->where('b.StatusUsermenu = ','1');
		$this->db->where('c.ParentID = ',0);
		$this->db->where('c.status = ','1');
        $this->db->order_by('c.Kd_Menu','ASC');
		return $this->db->get();
		
/* 		$q=  $this->db->query("SELECT b.Kd_Menu as bKd_Menu, c.Nm_Menu as cNm_Menu , c.Link_Menu as cLink_Menu
								, c.ParentID as cParentID
								 FROM users a 
								 LEFT JOIN mst_usermenu b ON a.company_code= b.company_code AND a.site_code=b.site_code AND a.id=b.id
        						 LEFT JOIN mst_menu c ON b.Kd_Menu=c.Kd_Menu
								 WHERE a.company_code='$kd_perusahaan' AND a.site_code='$kd_cabang' AND a.id='$kd_user' AND c.ParentID=0"); */
		
	
	}
	
	function getDetailUserMenu($kd_perusahaan, $kd_cabang, $kd_user, $role_id, $kd_menu){
	
		$this->db->select('a.*, b.*, c.*, b.Kd_Menu AS bKd_Menu, c.Nm_Menu AS cNm_Menu, c.Link_Menu AS cLink_Menu, c.lang as cLang');
		$this->db->from('sa_users AS a');
		$this->db->join('sa_usermenu AS b','b.company_rowID = a.company_rowID AND b.user_rowID = a.rowID', 'LEFT');
		$this->db->join('sa_menu AS c','c.Seq_Menu=b.Kd_Menu', 'LEFT');
		$this->db->where('a.company_rowID = ',$kd_perusahaan);
		$this->db->where('a.dep_rowID = ',$kd_cabang);
		$this->db->where('a.rowID = ',$kd_user);
		$this->db->where('a.role_rowID = ',$role_id);
		$this->db->where('b.StatusUsermenu = ','1');
		$this->db->where('c.ParentID = ',$kd_menu);
		$this->db->where('c.status = ','1');
        $this->db->order_by('c.Kd_Menu','ASC');
		return $this->db->get();	
	
/*         $q=  $this->db->query("SELECT a.Kd_Perusahaan as aKdPerusahaan, c.Collapse as cCollapse,  b.Kd_Menu as bKd_Menu,  c.Nm_Menu as cNm_Menu , c.Link_Menu as cLink_Menu, c.ParentID as cParentID, c.Collapse
								 FROM users a 
								 LEFT JOIN mst_usermenu b ON a.Kd_Perusahaan= b.Kd_Perusahaan AND a.Kd_Cabang=b.Kd_Cabang AND a.Kd_User=b.Kd_User
        						 LEFT JOIN mst_menu c ON b.Kd_Menu=c.Kd_Menu
								 WHERE a.Kd_Perusahaan='$kd_perusahaan' AND a.Kd_Cabang='$kd_cabang' AND a.Kd_User='$kd_user' AND c.ParentID=$kd_menu AND c.Kd_Menu Is Not Null Order By Collapse, c.Kd_Menu  ASC");
		return $q; */
	
	}	
	function insert($table,$data){
			$this -> db -> insert($table, $data);
			return $this -> db -> insert_id();
	}
	function update($table,$data,$where){
		$this -> db -> where($where)->update($table, $data);
		return TRUE;
	}
	function search_project($keyword,$where)
	{
		//$array = array('project_title' => $keyword, 'project_code' => $keyword);
		$this->db->like('project_title',$keyword); 
		return $this->db->order_by('date_created','desc')	
						->where($where)					
						->get('projects')->result();
	}
	function monthly_data($month)
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
	

	
	function monthly_user_data($month)
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

    function get_data_access_by_user($user_id,$menu_id,$field_name){
        $this->db->select('*');
        $this->db->from('sa_usermenu');
        $this->db->where('user_rowID',$user_id);
        $this->db->where('Kd_Menu',$menu_id);
        $this->db->where($field_name,1);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }
    }

    function get_data_activities_by_user($user_id,$module_name,$module_id){
        $this->db->select('*');
        $this->db->from('activities');
        $this->db->where('user_rowID',$user_id);
        $this->db->where('module',$module_name);
        $this->db->where('module_field_id',$module_id);
        $this->db->where('deleted',0);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }
    }

}
     
     /* End of file appmodel.php */
     /* Location: ./application/models/appmodel.php */ 