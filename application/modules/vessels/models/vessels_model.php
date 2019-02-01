<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Vessels_model extends CI_Model
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

	function check_vessel($where)
    {
		
        $this->db->where($where);
        $query=$this->db->get("trx_vessel_document");
        if($query->num_rows()>0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }	
	function sum_item_palka($table,$where)
   	{
	$this->db->where($where);
	$this->db->select_sum('ttl_item');
	$query = $this->db->get($table);
		if ($query->num_rows() > 0)
		{
  		 $row = $query->row();
  		 return $row->ttl_item;
			
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
	function get_idbool($table,$where,$field)
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
	
	function parties_select($vessel_id)
	{
		
		$query = $this->db->query("SELECT a.No_Urut_Ref, a.Nm_Ref FROM fx_mst_reference a LEFT JOIN fx_trx_vessel_document b ON b.party_id = a.No_Urut_Ref AND b.vessel_id = $vessel_id AND b.deleted=0 WHERE a.Type_Ref='party'  AND b.party_id is NULL")->result();
		
		return $query;
	
	}
	function palka_details($vessel_id, $palka_id)
	{
		
		$query = $this->db->query("SELECT b.vessel_id, b.vessel_ref, b.vessel_name, c.item_id, c.item_name, a.palka_id, d.Nm_Ref, a.ttl_item, a.ttl_unload_item FROM fx_mst_vessel_palka a LEFT JOIN fx_mst_vessels b ON b.vessel_id=a.vessel_id LEFT JOIN fx_mst_items c ON c.item_id=a.item_id LEFT JOIN fx_mst_reference d ON d.No_Urut_Ref=a.palka_id AND d.Type_Ref='vessel_palka' WHERE b.vessel_id = $vessel_id AND a.palka_id = $palka_id");
		
		return $query;
	
	}

	function document_vessel($vessel_id)
	{
		
		$query = $this->db->query("SELECT b.vessel_id, b.vessel_ref, b.vessel_name, f.Nm_Ref as vessel_status, f.Kondisi_Ref_Char_01, c.Nm_Ref as party_name, d.client_ref, d.client_name, e.item_ref, e.item_name,a.document_id, a.party_id, a.po_ref, a.po_date, g.destination_name,  CASE WHEN a.item_type = 'C' THEN 'CURAH' WHEN a.item_type='B' THEN 'BAG' ELSE 'OTHER' END as item_type, a.qty_po, a.tolerence, a.shipping_name, a.stevedore_name, a.bl_doc FROM fx_trx_vessel_document a LEFT JOIN fx_mst_vessels b ON b.vessel_id=a.vessel_id LEFT JOIN fx_mst_reference c ON c.No_Urut_Ref = a.party_id AND c.Type_Ref='party' LEFT JOIN fx_mst_clients d ON d.client_id = a.client_id LEFT JOIN fx_mst_items e ON e.item_id = a.item_id LEFT JOIN fx_mst_reference f ON f.No_Urut_Ref = b.vessel_status AND f.Type_Ref='vessel_status' LEFT JOIN fx_mst_destinations g ON g.destination_id=a.port_id   WHERE a.vessel_id = $vessel_id AND a.deleted=0 Order By party_id asc")->result();
		
		return $query;
	
	}


	function unload_receipt_list($vessel_id)
	{
		
		$query = $this->db->query("SELECT a.unload_receipt_id, unload_receipt_date, unload_receipt_time, unload_receipt_ref,  truck_name, c.transporter_name, Nm_Ref, c.transporter_ref,  a.driver_name, expired_date,  username, sj_ref
		FROM fx_trx_unload_receipt a 
		LEFT JOIN fx_mst_vessels b ON b.vessel_id=a.vessel_id
		LEFT JOIN fx_mst_transporters c ON c.transporter_id=a.transporter_id
		LEFT JOIN fx_mst_trucks d ON d.truck_id=a.truck_id
		LEFT JOIN fx_mst_reference e ON e.No_Urut_Ref=a.truck_type_id AND e.Type_Ref='truck_type'
		LEFT JOIN fx_users f ON f.id=a.user_created
		LEFT JOIN fx_trx_sj g ON g.unload_receipt_id=a.unload_receipt_id 
		WHERE a.vessel_id=$vessel_id AND a.deleted=0")->result();
				
		return $query;
	
	}

	function unload_receipt_details($unload_receipt_id)
	{
		
		$query = $this->db->query("SELECT a.unload_receipt_id,a.vessel_id, b.vessel_name, b.vessel_ref, unload_receipt_date, unload_receipt_time, unload_receipt_ref,  truck_name, transporter_name, transporter_ref, Nm_Ref, a.driver_name, expired_date, description, username, sj_ref, a.date_created, a.time_created
		FROM fx_trx_unload_receipt a 
		LEFT JOIN fx_mst_vessels b ON b.vessel_id=a.vessel_id
		LEFT JOIN fx_mst_transporters c ON c.transporter_id=a.transporter_id
		LEFT JOIN fx_mst_trucks d ON d.truck_id=a.truck_id
		LEFT JOIN fx_mst_reference e ON e.No_Urut_Ref=a.truck_type_id AND e.Type_Ref='truck_type'
		LEFT JOIN fx_users f ON f.id=a.user_created
		LEFT JOIN fx_trx_sj g ON g.unload_receipt_id=a.unload_receipt_id 
		WHERE a.unload_receipt_id=$unload_receipt_id AND a.deleted=0 AND no_bon_muat>0")->result();
				
		return $query;
	
	}

	function memo_list($vessel_id)
	{
		
		$query = $this->db->query("SELECT memo_id, memo_date, memo_time, description, username
		FROM fx_trx_memo a 
		LEFT JOIN fx_users b ON b.id=a.user_created
		WHERE a.vessel_id=$vessel_id AND a.deleted=0 ORDER BY memo_id desc")->result();
				
		return $query;
	
	}
	


	function memo_details($memo_id)
	{
		
		$query = $this->db->query("SELECT memo_id, a.vessel_id, memo_date, memo_time, description
		FROM fx_trx_memo a 
		LEFT JOIN fx_mst_vessels b ON b.vessel_id=a.vessel_id
		LEFT JOIN fx_users c ON c.id=a.user_created
		WHERE a.memo_id=$memo_id AND a.deleted=0")->result();
				
		return $query;
	
	}
	
	function document_detail($document_id)
	{
		
		$query = $this->db->query("SELECT b.vessel_id, b.vessel_ref, b.vessel_name, f.Nm_Ref as vessel_status, f.Kondisi_Ref_Char_01 as vessel_color, c.Nm_Ref as party_name, d.client_ref, d.client_name,e.item_id, e.item_ref, e.item_name,a.document_id, a.party_id, a.item_type,  a.po_ref, a.po_date,a.port_id, g.Kondisi_Ref_Char_01 as port_name,  CASE WHEN a.item_type = 'C' THEN 'CURAH' WHEN a.item_type='B' THEN 'BAG' ELSE 'OTHER' END as item_type, a.qty_po, a.tolerence, a.shipping_name, a.stevedore_name, a.bl_doc, h.Kondisi_Ref_Char_01 FROM fx_trx_vessel_document a LEFT JOIN fx_mst_vessels b ON b.vessel_id=a.vessel_id LEFT JOIN fx_mst_reference c ON c.No_Urut_Ref = a.party_id AND c.Type_Ref='party' LEFT JOIN fx_mst_clients d ON d.client_id = a.client_id LEFT JOIN fx_mst_items e ON e.item_id = a.item_id LEFT JOIN fx_mst_reference f ON f.No_Urut_Ref = b.vessel_status AND f.Type_Ref='vessel_status' LEFT JOIN fx_mst_reference g ON g.No_Urut_Ref=a.port_id AND g.Type_Ref = 'sites' 
		LEFT JOIN fx_mst_reference h ON h.Nm_Ref = a.item_type AND h.Type_Ref = 'item_type' 
		WHERE a.document_id = $document_id AND a.deleted=0")->result();
		
		return $query;
	
	}
	
	function sum_unload_item_palka($table,$where)
   	{
	$this->db->where($where);
	$this->db->select_sum('ttl_unload_item');
	$query = $this->db->get($table);
		if ($query->num_rows() > 0)
		{

	  		 $row = $query->row();
			return $row->ttl_unload_item;
  		}
	}	
    function clients()
	{
		$query = $this->db->where('role_id !=',1)->get('users');
		if ($query->num_rows() > 0){
			return $query->result();
		} 
	}

	function search_estimate($keyword)
	{
		$this->db->join('companies','companies.co_id = estimates.client');
		return $this->db->like('reference_no', $keyword)->order_by("date_saved","desc")->get('estimates')->result();
	}

    function payment_methods()
	{
			return $this->db->get('payment_methods')->result();
	}
	function estimate_details($est_id)
	{
		//$this->db->join('users','users.id = estimates.client');
		$query = $this->db->where('est_id',$est_id)->get('estimates');
		if ($query->num_rows() > 0){
			return $query->result();
		} 
	}
	function estimate_activities($est_id)
	{
		$this->db->join('users','users.id = activities.user');
		$this->db->where('module', 'estimates');
		return $this->db->where('module_field_id',$est_id)->order_by('activity_date','desc')->get('activities')->result();
	}
	function estimate_items($est_id)
	{
		$this->db->join('estimates','estimates.est_id = estimate_items.estimate_id');
		$query = $this->db->where('estimate_id',$est_id)->get('estimate_items');
		if ($query->num_rows() > 0){
			return $query->result();
		} 
	}
	function get_client($estimate){
	$query = $this->db->select('client')->where('est_id',$estimate)->get('estimates');
		if ($query->num_rows() > 0)
			{
  		 $row = $query->row();
  		 return $row->client;
  		}
	}
}

/* End of file model.php */