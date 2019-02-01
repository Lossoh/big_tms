<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Job_order_model extends CI_Model
{
	function get_all_records_list()
	{
		$this->db->select('a.*,
							b.type_no as type_no,
							b.type_name as type_name,
							c.debtor_cd as debtor_code, 
							c.debtor_name as debtor_name, 
							d.port_cd as port_code,
							d.port_name as port_name,						
							e.fare_trip_no as fare_trip_no,
							f.destination_name as destination_from_name,
							g.destination_name as destination_to_name,
							h.item_cd as item_code,
							h.item_name as item_name');
		$this->db->from('tr_jo_trx_hdr AS a');
		$this->db->join('sa_reference AS b','b.type_no=a.jo_type AND b.type_ref="jo_type"', 'LEFT');
		$this->db->join('sa_debtor AS c','c.rowID=a.debtor_rowID', 'LEFT');
		$this->db->join('sa_port AS d','d.rowID=a.port_rowID', 'LEFT');
		$this->db->join('sa_fare_trip_hdr AS e','e.rowID = a.fare_trip_rowID', 'LEFT');
		$this->db->join('sa_destination AS f','f.rowID=e.destination_from_rowID', 'LEFT');
		$this->db->join('sa_destination AS g','g.rowID=e.destination_to_rowID', 'LEFT');
		$this->db->join('sa_item AS h','h.rowID=a.item_rowID', 'LEFT');
		$this->db->where('a.deleted','0');
		$this->db->order_by('a.jo_no','DESC');
		return $this->db->get()->result_array(); 
	}

	function get_records_details($year,$month,$code)
	{
		$this->db->select('a.*,
							b.type_no as type_no,
							b.type_name as type_name,
							c.debtor_cd as debtor_code, 
							c.debtor_name as debtor_name, 
							d.port_cd as port_code,
							d.port_name as port_name,						
							e.fare_trip_no as fare_trip_no,
							e.distance as distance,
							f.destination_no as destination_from_no,
							f.destination_name as destination_from_name,
							g.destination_no as destination_to_no,
							g.destination_name as destination_to_name,
							h.item_cd as item_code,
							h.item_name as item_name');
		$this->db->from('tr_jo_trx_hdr AS a');
		$this->db->join('sa_reference AS b','b.type_no=a.jo_type AND b.type_ref="jo_type"', 'LEFT');
		$this->db->join('sa_debtor AS c','c.rowID=a.debtor_rowID', 'LEFT');
		$this->db->join('sa_port AS d','d.rowID=a.port_rowID', 'LEFT');
		$this->db->join('sa_fare_trip_hdr AS e','e.rowID = a.fare_trip_rowID', 'LEFT');
		$this->db->join('sa_destination AS f','f.rowID=e.destination_from_rowID', 'LEFT');
		$this->db->join('sa_destination AS g','g.rowID=e.destination_to_rowID', 'LEFT');
		$this->db->join('sa_item AS h','h.rowID=a.item_rowID', 'LEFT');
		$this->db->where('a.deleted','0');
		$this->db->where('a.year',$year);
		$this->db->where('a.month',$month);
		$this->db->where('a.code',$code);
		$this->db->order_by('a.jo_no','DESC');
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

	function get_all_fare_trip()
	{
		$this->db->select('a.*,		
							b.destination_no as destination_from_no,
							b.destination_name as destination_from_name,
							c.destination_no as destination_to_no,
							c.destination_name as destination_to_name');
		$this->db->from('sa_fare_trip_hdr AS a');
		$this->db->join('sa_destination AS b','b.rowID=a.destination_from_rowID', 'LEFT');
		$this->db->join('sa_destination AS c','c.rowID=a.destination_to_rowID', 'LEFT');
		$this->db->where('a.deleted','0');
		$this->db->order_by('a.rowID','ASC');
		return $this->db->get()->result(); 
	}

	function getClients($term){
		return $this->db->query("SELECT  rowID as id, debtor_cd as code, debtor_name as text FROM sa_debtor WHERE debtor_name like '%$term%'")->result_array();
	}

	function get_fair_trip_by($term) {
		
		$this->db->select('a.*,		
							b.destination_no as destination_from_no,
							b.destination_name as destination_from_name,
							c.destination_no as destination_to_no,
							c.destination_name as destination_to_name');
		$this->db->from('sa_fare_trip_hdr AS a');
		$this->db->join('sa_destination AS b','b.rowID=a.destination_from_rowID', 'LEFT');
		$this->db->join('sa_destination AS c','c.rowID=a.destination_to_rowID', 'LEFT');
		$this->db->like('a.fair_trip_no',$term);
		$this->db->or_like('b.destination_name',$term);
		$this->db->where('a.deleted','0');
		$this->db->order_by('a.code','ASC');
		return $this->db->get()->result_array(); 
		

	}
	
	function get_jo()
	{
		$this->db->select('jo');
		$this->db->from('sa_spec');
		return $this->db->get()->result_array(); 
	}
	
	function get_all_record_wo($wo_no)
	{
		$query = $this->db->query("SELECT a.*, b.port_cd as port_code, b.descs as port_name FROM tr_wo_trx_hdr a, sa_port b WHERE  a.port_rowID=b.rowID and a.wo_no = '$wo_no' AND a.deleted=0")->result();
		return $query;	
	}
	
	function get_all_record_debtor_wo($debtor_rowID)
	{
		$query = $this->db->query("SELECT wo_no FROM tr_wo_trx_hdr WHERE debtor_rowID='$debtor_rowID' and deleted=0 ")->result();
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
							c.wo_no as wo_no,
							c.ref_no as ref_no,
							c.vessel_no as vessel_no,
							c.vessel_name as vessel_name,
							d.port_cd as port_code,
							d.descs as port_name,
							e.from_cd as from_code,
							e.decs as from_name,
							f.to_cd as to_code,
							f.descs as to_name,
							g.item_cd as item_code,
							g.descs as item_name');
		$this->db->from('tr_jo_trx_hdr AS a');
		$this->db->join('sa_debtor AS b','a.debtor_rowID = b.rowID', 'LEFT');
		$this->db->join('tr_wo_trx_hdr AS c','a.wo_trx_hdr_wo_code = c.code AND a.wo_trx_hdr_wo_year = c.year', 'LEFT');
		$this->db->join('sa_port AS d','c.port_rowID = d.rowID', 'LEFT');
		$this->db->join('sa_destination_from AS e','a.destination_from_rowID = e.rowID', 'LEFT');
		$this->db->join('sa_destination_to AS f','a.destination_to_rowID = f.rowID', 'LEFT');
		$this->db->join('sa_item AS g','a.item_rowID = g.rowID', 'LEFT');
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