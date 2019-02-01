<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Orders_model extends CI_Model
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

	function unload_receipt()
	{
		
		$query = $this->db->query("select a.unload_receipt_ref, a.unload_receipt_date, a.unload_receipt_time , a.driver_name, c.truck_ref, d.transporter_name
		FROM fx_trx_unload_receipt a 
		LEFT JOIN fx_trx_sj b ON a.unload_receipt_id=b.unload_receipt_id AND b.deleted=0 
		LEFT JOIN fx_mst_trucks c ON a.truck_id=c.truck_id
		LEFT JOIN fx_mst_transporters d ON a.transporter_id = d.transporter_id
		WHERE a.deleted=0 AND b.sj_ref is NULL")->result();
		
		return $query;
	
	}
	
	function unload_receipt_list($vessel_id)
	{
		
		$query = $this->db->query("SELECT a.unload_receipt_id, unload_receipt_date, unload_receipt_time, unload_receipt_ref,  truck_name, c.transporter_name, Nm_Ref, c.transporter_ref,  a.driver_name, expired_date,  username, sj_ref, a.barcode_id
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
	
	function sj()
	{
		
		$query = $this->db->query("select a.sj_ref, a.sj_date, a.sj_time, a.driver_name, a.qty_bulk_delivery_netto as tonase_kirim , b.destination_ref as Dari, c.destination_ref as Ke
		FROM fx_trx_sj a 
		LEFT JOIN  fx_mst_destinations b ON a.destination_from = b.destination_id AND b.deleted=0 
		LEFT JOIN  fx_mst_destinations c ON a.destination_to = c.destination_id AND c.deleted=0 
		where a.deleted=0 AND a.barcode_id = 0")->result();
		
		return $query;
	
	}
	
	function barcode()
	{
		
		$query = $this->db->query("select a.sj_ref, a.barcode_id, a.sj_date, a.sj_time, a.driver_name, b.destination_ref as Dari, c.destination_ref as Ke
		FROM fx_trx_sj a 
		LEFT JOIN  fx_mst_destinations b ON a.destination_from = b.destination_id AND b.deleted=0 
		LEFT JOIN  fx_mst_destinations c ON a.destination_to = c.destination_id AND c.deleted=0 
		where a.deleted=0 AND a.user_gateout = 0 AND a.gateout_date ='1900-01-01'")->result();
		
		return $query;
	
	}	
	
	function verify()
	{
		
		$query = $this->db->query("select a.sj_ref, a.barcode_id, a.sj_date, a.sj_time, a.driver_name, b.destination_ref as Dari, c.destination_ref as Ke
		FROM fx_trx_sj a 
		LEFT JOIN  fx_mst_destinations b ON a.destination_from = b.destination_id AND b.deleted=0 
		LEFT JOIN  fx_mst_destinations c ON a.destination_to = c.destination_id AND c.deleted=0 
		where a.deleted=0 AND a.user_receipt = 0 AND a.receipt_date ='1900-01-01' AND a.qty_bulk_receipt_netto=0")->result();
		
		return $query;
	
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

	function check_print($where)
    {
		
        $this->db->where($where);
        $query=$this->db->get("trx_sj");
        if($query->num_rows()>0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }	
	
	function check_barcode($where)
    {
		
        $this->db->where($where);
        $query=$this->db->get("trx_sj");
        if($query->num_rows()>0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

	function check_barcode_list($where)
    {
		
        $this->db->where($where);
        $query=$this->db->get("trx_barcode");
        if($query->num_rows()>0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
	function check_barcode_verify($where,$join_table,$join_criteria)
    {
		
		$this->db->where($where);
		if($join_table){
		$this->db->join($join_table,$join_criteria);
		}
        $query=$this->db->get("trx_sj");
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

	function document_destination_vessel($vessel_active,$client_id)
	{
		if($client_id==0){
		
		
		$query = $this->db->query("SELECT a.vessel_id, a.company_id, a.site_id, a.vessel_ref, a.vessel_init, a.vessel_name, b.document_id, e.Nm_Ref as eNm_Ref, b.party_id, b.po_ref, b.po_date, b.client_id, b.item_id, f.item_name, b.item_type, b.qty_po,
		c.destination_id, g.destination_name, c.destination_description, c.qty_destination, c.remarks, d.client_ref, d.client_name, a.vessel_status, h.Nm_Ref as hNm_Ref, h.Kondisi_Ref_Char_01, a.date_created, c.document_separate_id
		FROM fx_mst_vessels a LEFT JOIN fx_trx_vessel_document b ON b.vessel_id = a.vessel_id LEFT JOIN fx_trx_document_separate c ON c.document_id=b.document_id AND c.document_separate_status =1
		LEFT JOIN fx_mst_clients d ON d.client_id=b.client_id 
		LEFT JOIN fx_mst_reference e ON e.No_Urut_Ref=b.party_id AND e.Type_Ref='party'
		LEFT JOIN fx_mst_items f ON f.item_id=b.item_id
		LEFT JOIN fx_mst_destinations g ON g.destination_id=c.destination_id
		LEFT JOIN fx_mst_reference h ON h.No_Urut_Ref = a.vessel_status AND h.Type_Ref='vessel_status'
		WHERE a.deleted=0 AND a.vessel_id = $vessel_active AND a.vessel_status<2 AND b.document_id is not null AND c.destination_id is not null")->result();
		}else{
		
		$query = $this->db->query("SELECT a.vessel_id, a.company_id, a.site_id, a.vessel_ref, a.vessel_init, a.vessel_name, b.document_id, e.Nm_Ref as eNm_Ref, b.party_id, b.po_ref, b.po_date, b.client_id, b.item_id, f.item_name, b.item_type, b.qty_po,
		c.destination_id, g.destination_name, c.destination_description, c.qty_destination, c.remarks, d.client_ref, d.client_name, a.vessel_status, h.Nm_Ref as hNm_Ref, h.Kondisi_Ref_Char_01, a.date_created, c.document_separate_id
		FROM fx_mst_vessels a LEFT JOIN fx_trx_vessel_document b ON b.vessel_id = a.vessel_id LEFT JOIN fx_trx_document_separate c ON c.document_id=b.document_id AND c.document_separate_status =1
		LEFT JOIN fx_mst_clients d ON d.client_id=b.client_id 
		LEFT JOIN fx_mst_reference e ON e.No_Urut_Ref=b.party_id AND e.Type_Ref='party'
		LEFT JOIN fx_mst_items f ON f.item_id=b.item_id
		LEFT JOIN fx_mst_destinations g ON g.destination_id=c.destination_id
		LEFT JOIN fx_mst_reference h ON h.No_Urut_Ref = a.vessel_status AND h.Type_Ref='vessel_status'
		WHERE a.deleted=0 AND a.vessel_id = $vessel_active AND a.vessel_status<2 AND b.client_id =$client_id AND b.document_id is not null AND c.destination_id is not null")->result();
		}
		return $query;
	
	}
	
	function filter_by_client($vessel_active){
	
		$query = $this->db->query("SELECT b.client_id, c.client_name
				FROM fx_mst_vessels a
				LEFT JOIN fx_trx_vessel_document b ON b.vessel_id=a.vessel_id
				LEFT JOIN fx_mst_clients c ON c.client_id=b.client_id
				WHERE a.vessel_id = $vessel_active AND vessel_status<2 AND a.deleted=0")->result();
		return $query;
		
	}
	
	function filter_by_vessel(){
	
		$query = $this->db->query("SELECT a.vessel_id, a.vessel_init, a.vessel_name
				FROM fx_mst_vessels a
				WHERE vessel_status<2 AND a.deleted=0")->result();
		return $query;
		
	}
	function document_destination_details($document_separate_id)
	{
		
		$query = $this->db->query("SELECT a.vessel_id, a.company_id, a.site_id, a.vessel_ref, a.vessel_init, a.vessel_name, b.document_id, e.Nm_Ref as party_name, b.party_id, b.po_ref, b.po_date, b.client_id, b.shipping_name, b.stevedore_name, b.bl_doc, b.item_id, f.item_name, b.item_type,i.Kondisi_Ref_Char_01 as iItem_type, b.qty_po, c.remarks,
		c.destination_id, g.destination_ref, g.destination_name, c.destination_description, c.qty_destination, c.remarks, d.client_ref, d.client_name, a.vessel_status, h.Nm_Ref as hNm_Ref, h.Kondisi_Ref_Char_01 as hvessel_status, a.date_created, c.document_separate_id, j.Kondisi_Ref_Char_01 as port_name
		FROM fx_mst_vessels a LEFT JOIN fx_trx_vessel_document b ON b.vessel_id = a.vessel_id LEFT JOIN fx_trx_document_separate c ON c.document_id=b.document_id
		LEFT JOIN fx_mst_clients d ON d.client_id=b.client_id  
		LEFT JOIN fx_mst_reference e ON e.No_Urut_Ref=b.party_id AND e.Type_Ref='party'
		LEFT JOIN fx_mst_items f ON f.item_id=b.item_id
		LEFT JOIN fx_mst_destinations g ON g.destination_id=c.destination_id
		LEFT JOIN fx_mst_reference h ON h.No_Urut_Ref = a.vessel_status AND h.Type_Ref='vessel_status'
		LEFT JOIN fx_mst_reference i ON i.Nm_Ref = b.item_type AND i.Type_Ref='item_type'
		LEFT JOIN fx_mst_reference j ON j.No_Urut_Ref = b.port_id AND j.Type_Ref='sites'
		WHERE a.deleted=0 AND a.vessel_status<2 AND b.document_id is not null AND c.destination_id is not null AND c.document_separate_id = $document_separate_id ")->result();
		
		return $query;
	
	}
	
	function document_detail($document_id)
	{
		
		$query = $this->db->query("SELECT b.vessel_id, b.vessel_ref, b.vessel_name, f.Nm_Ref as vessel_status, f.Kondisi_Ref_Char_01, c.Nm_Ref as party_name, d.client_ref, d.client_name, e.item_ref, e.item_name,a.document_id, a.po_ref, a.po_date, g.destination_name,  CASE WHEN a.item_type = 'C' THEN 'CURAH' WHEN a.item_type='B' THEN 'BAG' ELSE 'OTHER' END as item_type, a.qty_po, a.tolerence, a.shipping_name, a.stevedore_name, a.bl_doc FROM fx_trx_vessel_document a LEFT JOIN fx_mst_vessels b ON b.vessel_id=a.vessel_id LEFT JOIN fx_mst_reference c ON c.No_Urut_Ref = a.party_id AND c.Type_Ref='party' LEFT JOIN fx_mst_clients d ON d.client_id = a.client_id LEFT JOIN fx_mst_items e ON e.item_id = a.item_id LEFT JOIN fx_mst_reference f ON f.No_Urut_Ref = b.vessel_status AND f.Type_Ref='vessel_status' LEFT JOIN fx_mst_destinations g ON g.destination_id=a.port_id   WHERE a.document_id = $document_id AND a.deleted=0")->result();
		
		return $query;
	
	}
	
	function sjk_details($sj_id){
		$query = $this->db->query("SELECT a.sj_id, a.sj_ref, a.sj_date, a.sj_time, a.document_separate_id, b.vessel_init, b.vessel_name, c.destination_ref as destination_ref_from, c.destination_name as destination_name_from, d.destination_ref as destination_ref_to, d.destination_name as destination_name_to, e.item_name, f.Nm_Ref as item_type, f.Kondisi_Ref_Char_01 as item_type_name, g.Nm_Ref as palka_name
		,h.truck_name, h.truck_id, h.truck_ref, i.Nm_Ref as truck_type, j.transporter_name , a.driver_name, a.po_ref, a.po_date, a.qty_po, a.shipping_name, a.stevedore_name, a.bl_doc,  a.destination_description, a.remarks, a.qty_bulk_delivery_bruto,
		a.qty_bulk_delivery_tarra, a.qty_bulk_delivery_netto, k.client_name, l.Nm_Ref as vessel_status, l.Kondisi_Ref_Char_01 as vessel_color, m.Kondisi_Ref_Char_01 as port_name, n.Nm_Ref as party_name, o.qty_destination, p.username, d.address_1,
		d.address_2,d.address_3, a.sj_date, a.sj_time, a.printed
		FROM fx_trx_sj a 
		LEFT JOIN fx_mst_vessels b ON b.vessel_id = a.vessel_id
		LEFT JOIN fx_mst_destinations c ON c.destination_id = a.destination_from
		LEFT JOIN fx_mst_destinations d ON d.destination_id = a.destination_to
		LEFT JOIN fx_mst_items e ON e.item_id = a.item_id
		LEFT JOIN fx_mst_reference f ON f.Nm_Ref = a.item_type AND f.Type_Ref='item_type'
		LEFT JOIN fx_mst_reference g ON g.No_Urut_Ref = a.palka_id AND g.Type_Ref='vessel_palka'
		LEFT JOIN fx_mst_trucks h ON h.truck_id = a.truck_id
		LEFT JOIN fx_mst_reference i ON i.No_Urut_Ref = a.truck_type_id AND i.Type_Ref='truck_type'
		LEFT JOIN fx_mst_transporters j ON j.transporter_id = a.transporter_id
		LEFT JOIN fx_mst_clients k ON k.client_id = a.client_id
		LEFT JOIN fx_mst_reference l ON l.No_Urut_Ref = b.vessel_status AND l.Type_Ref='vessel_status'	
		LEFT JOIN fx_mst_reference m ON m.No_Urut_Ref = a.site_id AND m.Type_Ref='sites'
		LEFT JOIN fx_mst_reference n ON n.No_Urut_Ref = a.party_id AND n.Type_Ref='party'
		LEFT JOIN fx_trx_document_separate o ON o.document_separate_id = a.document_separate_id
		LEFT JOIN fx_users p ON p.id = a.user_created		
		WHERE a.sj_id = $sj_id AND a.deleted=0")->result();
		return $query;
	
	}
	
	function recap_document_h($recap_document_id){
		$query=$this->db->query("SELECT a.recap_id, a.recap_no, a.recap_receipt_date, a.recap_due_date, b.transporter_name, a.recap_payable, c.vessel_init, c.vessel_name
		FROM fx_trx_recap_document_h a 
		LEFT JOIN fx_mst_transporters b ON b.transporter_id = a.transporter_id
		LEFT JOIN fx_mst_vessels c ON c.vessel_id = a.vessel_id
		WHERE a.recap_id = $recap_document_id AND a.deleted=0")->result();
	
		return $query;
	}
	

	function barcode_details($barcode_id){
		$query = $this->db->query("SELECT a.sj_id, a.sj_ref, a.sj_date, a.sj_time, a.document_separate_id, b.vessel_init, b.vessel_name, c.destination_ref as destination_ref_from, c.destination_name as destination_name_from, d.destination_ref as destination_ref_to, d.destination_name as destination_name_to, e.item_name, f.Nm_Ref as item_type, f.Kondisi_Ref_Char_01 as item_type_name, g.Nm_Ref as palka_name
		,h.truck_name, h.truck_id, h.truck_ref, i.Nm_Ref as truck_type, j.transporter_name , a.driver_name, a.po_ref, a.po_date, a.qty_po, a.shipping_name, a.stevedore_name, a.bl_doc,  a.destination_description, a.remarks, a.qty_bulk_delivery_bruto,
		a.qty_bulk_delivery_tarra, a.qty_bulk_delivery_netto, k.client_name, l.Nm_Ref as vessel_status, l.Kondisi_Ref_Char_01 as vessel_color, m.Kondisi_Ref_Char_01 as port_name, n.Nm_Ref as party_name, o.qty_destination, p.username, d.address_1,
		d.address_2,d.address_3, a.sj_date, a.sj_time, a.printed, barcode_id, barcode_date, barcode_time, user_gateout, user_receipt
		FROM fx_trx_sj a 
		LEFT JOIN fx_mst_vessels b ON b.vessel_id = a.vessel_id
		LEFT JOIN fx_mst_destinations c ON c.destination_id = a.destination_from
		LEFT JOIN fx_mst_destinations d ON d.destination_id = a.destination_to
		LEFT JOIN fx_mst_items e ON e.item_id = a.item_id
		LEFT JOIN fx_mst_reference f ON f.Nm_Ref = a.item_type AND f.Type_Ref='item_type'
		LEFT JOIN fx_mst_reference g ON g.No_Urut_Ref = a.palka_id AND g.Type_Ref='vessel_palka'
		LEFT JOIN fx_mst_trucks h ON h.truck_id = a.truck_id
		LEFT JOIN fx_mst_reference i ON i.No_Urut_Ref = a.truck_type_id AND i.Type_Ref='truck_type'
		LEFT JOIN fx_mst_transporters j ON j.transporter_id = a.transporter_id
		LEFT JOIN fx_mst_clients k ON k.client_id = a.client_id
		LEFT JOIN fx_mst_reference l ON l.No_Urut_Ref = b.vessel_status AND l.Type_Ref='vessel_status'	
		LEFT JOIN fx_mst_reference m ON m.No_Urut_Ref = a.site_id AND m.Type_Ref='sites'
		LEFT JOIN fx_mst_reference n ON n.No_Urut_Ref = a.party_id AND n.Type_Ref='party'
		LEFT JOIN fx_trx_document_separate o ON o.document_separate_id = a.document_separate_id
		LEFT JOIN fx_users p ON p.id = a.user_created		
		WHERE a.barcode_id = $barcode_id AND d.destination_flag=2 AND a.deleted=0")->result();
		return $query;
	
	}
	function barcode_details_receipt($barcode_id){
		$query = $this->db->query("SELECT a.sj_id, a.sj_ref, a.sj_date, a.sj_time, a.document_separate_id, b.vessel_init, b.vessel_name, c.destination_ref as destination_ref_from, c.destination_name as destination_name_from, d.destination_ref as destination_ref_to, d.destination_name as destination_name_to, e.item_name, f.Nm_Ref as item_type, f.Kondisi_Ref_Char_01 as item_type_name, g.Nm_Ref as palka_name
		,h.truck_name, h.truck_id, h.truck_ref, i.Nm_Ref as truck_type, j.transporter_name , a.driver_name, a.po_ref, a.po_date, a.qty_po, a.shipping_name, a.stevedore_name, a.bl_doc,  a.destination_description, a.remarks, a.qty_bulk_delivery_bruto,
		a.qty_bulk_delivery_tarra, a.qty_bulk_delivery_netto, k.client_name, l.Nm_Ref as vessel_status, l.Kondisi_Ref_Char_01 as vessel_color, m.Kondisi_Ref_Char_01 as port_name, n.Nm_Ref as party_name, o.qty_destination, p.username, d.address_1,
		d.address_2,d.address_3, a.sj_date, a.sj_time, a.printed, barcode_id, barcode_date, barcode_time, user_gateout, user_receipt
		FROM fx_trx_sj a 
		LEFT JOIN fx_mst_vessels b ON b.vessel_id = a.vessel_id
		LEFT JOIN fx_mst_destinations c ON c.destination_id = a.destination_from
		LEFT JOIN fx_mst_destinations d ON d.destination_id = a.destination_to
		LEFT JOIN fx_mst_items e ON e.item_id = a.item_id
		LEFT JOIN fx_mst_reference f ON f.Nm_Ref = a.item_type AND f.Type_Ref='item_type'
		LEFT JOIN fx_mst_reference g ON g.No_Urut_Ref = a.palka_id AND g.Type_Ref='vessel_palka'
		LEFT JOIN fx_mst_trucks h ON h.truck_id = a.truck_id
		LEFT JOIN fx_mst_reference i ON i.No_Urut_Ref = a.truck_type_id AND i.Type_Ref='truck_type'
		LEFT JOIN fx_mst_transporters j ON j.transporter_id = a.transporter_id
		LEFT JOIN fx_mst_clients k ON k.client_id = a.client_id
		LEFT JOIN fx_mst_reference l ON l.No_Urut_Ref = b.vessel_status AND l.Type_Ref='vessel_status'	
		LEFT JOIN fx_mst_reference m ON m.No_Urut_Ref = a.site_id AND m.Type_Ref='sites'
		LEFT JOIN fx_mst_reference n ON n.No_Urut_Ref = a.party_id AND n.Type_Ref='party'
		LEFT JOIN fx_trx_document_separate o ON o.document_separate_id = a.document_separate_id
		LEFT JOIN fx_users p ON p.id = a.user_created		
		WHERE a.barcode_id = $barcode_id AND a.user_receipt=0 AND a.deleted=0")->result();
		return $query;
	
	}	
	
	
	function sjk_order_list($document_separate_id){
		$query = $this->db->query("SELECT a.sj_id, a.sj_ref, a.sj_date, a.sj_time, a.document_separate_id,b.truck_name,  a.driver_name, a.qty_bulk_delivery_netto, a.qty_bulk_receipt_netto, c.username, a.barcode_id
		FROM fx_trx_sj a 
		LEFT JOIN fx_mst_trucks b ON b.truck_id = a.truck_id
		LEFT JOIN fx_users c ON c.id = a.user_created		
		WHERE a.document_separate_id = $document_separate_id AND a.deleted=0")->result();
		return $query;
	}
	
/* 	function delete_sjk_order_list($document_separate_id){
		$query = $this->db->query("SELECT a.sj_id, a.sj_ref, a.sj_date, a.sj_time, a.document_separate_id,b.truck_name,  a.driver_name, a.qty_bulk_delivery_netto, a.qty_bulk_receipt_netto, c.username, a.barcode_id
		FROM fx_trx_sj a 
		LEFT JOIN fx_mst_trucks b ON b.truck_id = a.truck_id
		LEFT JOIN fx_users c ON c.id = a.user_created		
		WHERE a.document_separate_id = $document_separate_id AND a.deleted=1")->result();
		return $query;
	} */	
	
	function get_all_delivery_order(){
		$query = $this->db->query("SELECT a.sj_id, a.sj_ref, a.sj_date, a.sj_time, a.document_separate_id,b.truck_name,  a.driver_name, a.qty_bulk_delivery_netto, a.qty_bulk_receipt_netto, c.username, a.barcode_id
		FROM fx_trx_sj a 
		LEFT JOIN fx_mst_trucks b ON b.truck_id = a.truck_id
		LEFT JOIN fx_users c ON c.id = a.user_created
		LEFT JOIN fx_mst_destinations d ON a.destination_to = d.destination_id		
		WHERE a.deleted=0 AND trim(a.barcode_id)<=0 AND d.destination_flag <3 Order By a.sj_id asc")->result();
		return $query;
	}
	
	function get_all_barcode(){
		$query = $this->db->query("SELECT a.sj_id, a.sj_ref, a.sj_date, a.sj_time, a.barcode_id, d.username as barcode_user, a.barcode_date, barcode_time, b.truck_name,  a.driver_name, a.qty_bulk_delivery_netto, a.qty_bulk_receipt_netto, c.username as user_created
		FROM fx_trx_sj a 
		LEFT JOIN fx_mst_trucks b ON b.truck_id = a.truck_id
		LEFT JOIN fx_users c ON c.id = a.user_created	
		LEFT JOIN fx_users d ON d.id = a.user_barcode	
		WHERE a.deleted=0 AND a.barcode_id>0 AND a.user_gate_out<=0 Order By a.sj_id asc")->result();
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