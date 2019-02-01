<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Delivery_order_model extends CI_Model
{
	function get_all_records_list()
	{
		$this->db->select('a.*,
							b.debtor_cd as debtor_code, 
							b.debtor_name as debtor_name, 
							c.jo_no as jo_no,
							c.tr_wo_trx_hdr_wo_no as wo_no,
							e.debtor_cd as driver_code,
							e.debtor_name as driver_name,
							f.police_no as police_no,
							f.head_truck as head_truck,
							g.type_cd as vehicle_type_code,
							g.type_name as vehicle_type_name,
							h.from_cd as from_code,
							h.decs as from_name,
							i.to_cd as to_code,
							i.descs as to_name');
		$this->db->from('tr_do_trx AS a');
		$this->db->join('sa_debtor AS b','a.debtor_rowID = b.rowID', 'LEFT');
		$this->db->join('tr_jo_trx_hdr AS c','a.tr_jo_trx_hdr_jo_no = c.jo_no', 'LEFT');
		$this->db->join('tr_wo_trx_hdr AS d','c.wo_trx_hdr_wo_code = d.code AND c.wo_trx_hdr_wo_year = d.year ', 'LEFT');
		$this->db->join('sa_debtor AS e','a.driver_rowID = e.rowID', 'LEFT');
		$this->db->join('sa_vehicle AS f','a.vehicle_rowID = f.rowID', 'LEFT');
		$this->db->join('sa_vehicle_type AS g','f.vehicle_type_rowID = g.rowID', 'LEFT');
		$this->db->join('sa_destination_from AS h','a.destination_from_rowID = h.rowID', 'LEFT');
		$this->db->join('sa_destination_to AS i','a.destination_to_rowID = i.rowID', 'LEFT');
		$this->db->join('tr_jo_trx_cnt AS j','a.tr_jo_trx_cnt_rowID = j.rowID', 'LEFT');
		$this->db->where('a.do_no !=','0');
		$this->db->where('a.deleted =','0');
		$this->db->order_by('a.do_no','asc');
		return $this->db->get()->result_array(); 
	}
	
	function get_all_records($table,$where,$join_table,$join_criteria,$order, $sort)
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
	
	function get_do()
	{
		$this->db->select('do');
		$this->db->from('sa_spec');
		return $this->db->get()->result_array(); 
	}
	
	function get_all_record_wo($jo_no)
	{
		$query = $this->db->query("SELECT 
										a.year as jo_year,
										a.month as jo_month,
										a.code as jo_code,
										a.tr_wo_trx_hdr_wo_no,
										a.destination_from_rowID as from_rowID,
										a.item_rowID as item_rowID,
										b.item_cd as item_code,
										b.descs as item_name,
										a.destination_to_rowID as to_rowID,
										c.from_cd as from_code,
										c.decs as from_name,
										d.to_cd as to_code,
										d.descs as to_name
									FROM tr_jo_trx_hdr a 
									LEFT JOIN sa_item b ON a.item_rowID = b.rowID
									LEFT JOIN sa_destination_from c ON a.destination_from_rowID = c.rowID
									LEFT JOIN sa_destination_to d ON a.destination_to_rowID = d.rowID
									WHERE a.jo_no = '$jo_no' AND a.deleted=0")->result();
		return $query;	
	}
	
	function get_all_record_debtor_jo($debtor_rowID)
	{
		$query = $this->db->query("SELECT year,month,code,jo_no FROM tr_jo_trx_hdr WHERE debtor_rowID='$debtor_rowID' and deleted=0 ")->result();
		return $query;	
	}
	
	function get_all_record_driver_truck($debtor_rowID)
	{
		$query = $this->db->query("SELECT 
										a.rowID as vehicle_rowID,
										a.vehicle_type_rowID as vehicle_type_rowID,
										a.police_no,
										b.type_cd as vehicle_type_code,
										b.type_name as vehicle_type_name
									FROM sa_vehicle a 
									LEFT JOIN sa_vehicle_type b ON a.vehicle_type_rowID = b.rowID
									WHERE a.debtor_rowID = '$debtor_rowID' AND a.deleted=0")->result();
		return $query;	
	}
	
	function get_all_records_container($year,$month,$code)
	{
		$this->db->select('*');					
		$this->db->from('tr_jo_trx_cnt');
		$this->db->where('jo_trx_hdr_year =',$year);
		$this->db->where('jo_trx_hdr_month =',$month);
		$this->db->where('jo_trx_hdr_code =',$code);
		$this->db->where('deleted =','0');
		$this->db->order_by('container_no','asc');
		return $this->db->get()->result_array(); 
	}
	
	function get_all_records_containerID($rowID)
	{
		$this->db->select('*');					
		$this->db->from('tr_jo_trx_cnt');
		$this->db->where('rowID',$rowID);
		return $this->db->get()->result_array(); 
	}
	
	
	function get_all_records_update($year,$month,$code)
	{

		$this->db->select('a.*,
							b.debtor_cd as debtor_code, 
							b.debtor_name as debtor_name, 
							c.jo_no as jo_no,
							c.tr_wo_trx_hdr_wo_no as wo_no,
							e.debtor_cd as driver_code,
							e.debtor_name as driver_name,
							f.police_no as police_no,
							f.head_truck as head_truck,
							g.type_cd as vehicle_type_code,
							g.type_name as vehicle_type_name,
							h.from_cd as from_code,
							h.decs as from_name,
							i.to_cd as to_code,
							i.descs as to_name,
							j.container_no as container_no,
							k.item_cd as item_code,
							k.descs as item_name');
		$this->db->from('tr_do_trx AS a');
		$this->db->join('sa_debtor AS b','a.debtor_rowID = b.rowID', 'LEFT');
		$this->db->join('tr_jo_trx_hdr AS c','a.tr_jo_trx_hdr_jo_no = c.jo_no', 'LEFT');
		$this->db->join('tr_wo_trx_hdr AS d','c.wo_trx_hdr_wo_code = d.code AND c.wo_trx_hdr_wo_year = d.year ', 'LEFT');
		$this->db->join('sa_debtor AS e','a.driver_rowID = e.rowID', 'LEFT');
		$this->db->join('sa_vehicle AS f','a.vehicle_rowID = f.rowID', 'LEFT');
		$this->db->join('sa_vehicle_type AS g','f.vehicle_type_rowID = g.rowID', 'LEFT');
		$this->db->join('sa_destination_from AS h','a.destination_from_rowID = h.rowID', 'LEFT');
		$this->db->join('sa_destination_to AS i','a.destination_to_rowID = i.rowID', 'LEFT');
		$this->db->join('tr_jo_trx_cnt AS j','a.tr_jo_trx_cnt_rowID = j.rowID', 'LEFT');
		$this->db->join('sa_item AS k','a.item_rowID = k.rowID', 'LEFT');
		$this->db->where('a.year = ',$year);
		$this->db->where('a.month = ',$month);
		$this->db->where('a.code = ',$code);
		return $this->db->get()->result_array(); 
	}
	
	function get_job_order_count_20ft($year,$month,$code)
	{
		$this->db->select('weight_20ft');
		$this->db->from('tr_jo_trx_hdr');
		$this->db->where('year = ',$year);
		$this->db->where('month = ',$month);
		$this->db->where('code = ',$code);
		return $this->db->get()->result_array(); 
	}
	
	function get_job_order_count_40ft($year,$month,$code)
	{
		$this->db->select('weight_40ft');
		$this->db->from('tr_jo_trx_hdr');
		$this->db->where('year = ',$year);
		$this->db->where('month = ',$month);
		$this->db->where('code = ',$code);
		return $this->db->get()->result_array(); 
	}
	
	function get_job_order_count_45ft($year,$month,$code)
	{
		$this->db->select('weight_45ft');
		$this->db->from('tr_jo_trx_hdr');
		$this->db->where('year = ',$year);
		$this->db->where('month = ',$month);
		$this->db->where('code = ',$code);
		return $this->db->get()->result_array(); 
	}
	
	function job_order_details($job_order)
	{
		$this->db->select('a.*,
							b.debtor_cd as debtor_code, 
							b.debtor_name as debtor_name, 
							c.port_cd as port_code,
							c.descs as port_name');
		$this->db->from('tr_wo_trx_hdr AS a');
		$this->db->join('sa_debtor AS b','a.debtor_rowID = b.rowID', 'LEFT');
		$this->db->join('sa_port AS c','a.port_rowID = c.rowID', 'LEFT');
		$this->db->where('a.wo_no',$job_order);
		return $this->db->get()->result_array(); 
	}
	

}

/* End of file model.php */