<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Finance_model extends CI_Model
{
	function get_all_records_list($partial_data, $dep_rowID)
	{
		$this->db->select('a.*,
							b.by_jo as by_jo,
							b.only_driver as only_driver,
							b.fare_trip as fare_trip,
							c.debtor_cd as debtor_code,
							c.debtor_name as debtor_name,
							d.police_no as police_no,
							e.type_cd as type_code,
							e.type_name as type_name,
							f.fare_trip_no as fare_trip_no,
							g.destination_no as destination_from_no,
							g.destination_name as destination_from_name,
							h.destination_no as destination_to_no,
							h.destination_name as destination_to_name');
		$this->db->from('cb_cash_adv AS a');
		$this->db->join('sa_advance_type AS b','b.rowID=a.advance_type_rowID', 'LEFT');
		$this->db->join('sa_debtor AS c','c.rowID=a.employee_driver_rowID', 'LEFT');
		$this->db->join('sa_vehicle AS d','d.rowID=a.vehicle_rowID', 'LEFT');
		$this->db->join('sa_vehicle_type AS e','e.rowID=a.vehicle_type_rowID', 'LEFT');
		$this->db->join('sa_fare_trip_hdr AS f','f.rowID = a.fare_trip_rowID', 'LEFT');
		$this->db->join('sa_destination AS g','g.rowID=f.destination_from_rowID', 'LEFT');
		$this->db->join('sa_destination AS h','h.rowID=f.destination_to_rowID', 'LEFT');
		$this->db->join('sa_users AS i','i.rowID=a.user_created', 'LEFT');
		$this->db->where('a.deleted =','0');
		if($partial_data){$this->db->where('i.dep_rowID =',$dep_rowID);}	
		$this->db->order_by('a.advance_no','asc');
		return $this->db->get()->result_array(); //if($partial_data>0){$this->db->where('i.dep_rowID =',$dep_rowID)};
	}

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
	
	function get_all_records_list_jo()
	{
		$this->db->select('a.*,
							b.debtor_cd as debtor_code, 
							b.debtor_name as debtor_name, 
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
		$this->db->where('a.jo_no !=','0');
		$this->db->where('a.deleted =','0');
		$this->db->order_by('a.jo_no','asc');
		return $this->db->get()->result_array(); 
	}
	
	function get_all_records_cash_adv($year,$month,$code)
	{
		$this->db->select('a.*,
							b.by_jo as by_jo,
							b.advance_cd as advance_code,
							b.advance_name as advance_name,
							c.jo_no as jo_no,
							c.tr_wo_trx_hdr_wo_no as wo_no,
							d.debtor_cd as debtor_code,
							d.debtor_name as debtor_name,
							e.police_no as police_no,
							f.type_cd as vehicle_code,
							f.type_name as vehicle_name,
							g.from_cd as from_code,
							g.decs as from_name,
							h.to_cd as to_code,
							h.descs as to_name,
							i.debtor_cd as employee_driver_code,
							i.debtor_name as employee_driver_name,
							j.vessel_no as vessel_no,
							j.vessel_name as vessel_name,
							k.item_cd as item_code,
							k.descs as item_name');
		$this->db->from('cb_cash_adv AS a');
		$this->db->join('sa_advance_type AS b','a.advance_type_rowID = b.rowID', 'LEFT');
		$this->db->join('tr_jo_trx_hdr AS c','a.tr_jo_trx_hdr_year = c.year AND a.tr_jo_trx_hdr_month = c.month AND a.tr_jo_trx_hdr_code = c.code', 'LEFT');
		$this->db->join('sa_debtor AS d','a.debtor_rowID = d.rowID', 'LEFT');
		$this->db->join('sa_vehicle AS e','a.vehicle_rowID = e.rowID', 'LEFT');
		$this->db->join('sa_vehicle_type AS f','a.vehicle_type_rowID = f.rowID', 'LEFT');
		$this->db->join('sa_destination_from AS g','a.destination_from_rowID = g.rowID', 'LEFT');
		$this->db->join('sa_destination_to AS h','a.destination_to_rowID = h.rowID', 'LEFT');
		$this->db->join('sa_debtor AS i','a.employee_driver_rowID = i.rowID', 'LEFT');
		$this->db->join('tr_wo_trx_hdr AS j','c.tr_wo_trx_hdr_wo_no = j.wo_no', 'LEFT');
		$this->db->join('sa_item AS k','a.item_rowID = k.rowID', 'LEFT');
		$this->db->where('a.year',$year);
		$this->db->where('a.month',$month);
		$this->db->where('a.code',$code);
		return $this->db->get()->result_array(); 
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
	
	function all_jo($tahun,$no_jo) {
		$this->db->select('a.*,
							b.rowID as debtor_id, 
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
		
		if($tahun!=""){
			$this->db->where('a.year',$tahun);    
		} 
		
		if($no_jo!=""){
            $this->db->where('jo_no',$no_jo);
            }  
		
			return  $this->db->get(); 
    }

	function limit_jo($tahun,$no_jo,$limit,$per_page){
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
		
	
		if($tahun!=""){
			$this->db->where('a.year',$tahun);    
		}
		
		if($no_jo!=""){
            $this->db->where('jo_no',$no_jo);
            }  
		
	
		$this->db->limit($limit,$per_page);
		return  $this->db->get();
    }
	
	function jo_group() {
            $this->db->select('*');
            $this->db->from('tr_jo_trx_hdr');
            return  $this->db->get();
            }

	function get_year(){
			$this->db->select('year');
            $this->db->from('tr_jo_trx_hdr');
			$this->db->group_by('year');
            return  $this->db->get()->result_array();
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
	
	function get_all_records_driveremployee()
	{
		$where = "type = 'E' or type = 'D' AND deleted = '0' AND rowID != '0'";
		$this->db->select('*');
		$this->db->from('sa_debtor');
		$this->db->where($where);
		
		return  $this->db->get()->result();
	}
	
	function get_cash_pay()
	{
		$this->db->select('gl_coaID_trans_acc,gl_coaID_cash_opr_acc,cash_pay');
		$this->db->from('sa_spec');
		return $this->db->get()->result_array(); 
	}
	
	function get_gl_balance($year,$month,$hasil_gl_row_id){
		$this->db->select('year,month,gl_coa_rowID');
		$this->db->from('gl_balance');
		$this->db->where('year',$year);
		$this->db->where('month',$month);
		$this->db->where('gl_coa_rowID',$hasil_gl_row_id);
		return $this->db->get()->num_rows(); 
	}
	
	function get_journal_header()
	{
		$this->db->select('general_jrn');
		$this->db->from('sa_spec');
		return $this->db->get()->result_array(); 
	}
	
	function get_rowID_gl($debtor_id)
	{
		$this->db->select('c.rowID as gl_coa_id');
		$this->db->from('sa_debtor as a');
		$this->db->join('sa_debtor_type AS b','a.debtor_type_rowID = b.rowID', 'LEFT');
		$this->db->join('gl_coa AS c','b.advance_acc = c.acc_cd', 'LEFT');
		$this->db->where('a.rowID',$debtor_id);
		return $this->db->get()->result_array(); 
	}
	
	function get_rowID_gl_advance_acc($debtor_id)
	{
		$this->db->select('c.rowID as gl_coa_id');
		$this->db->from('sa_debtor as a');
		$this->db->join('sa_debtor_type AS b','a.debtor_type_rowID = b.rowID', 'LEFT');
		$this->db->join('gl_coa AS c','b.advance_acc = c.acc_cd', 'LEFT');
		$this->db->where('a.rowID',$debtor_id);
		return $this->db->get()->result_array(); 
	}
	
	function get_amount($vehicle_type_id,$from,$to)
	{
		$this->db->select('*');
		$this->db->from('sa_fare_trip');
		$this->db->where('vehicle_type_rowID',$vehicle_type_id);
		$this->db->where('destination_from_rowID',$from);
		$this->db->where('destination_to_rowID',$to);
		return $this->db->get()->result_array(); 
	}
	
	function get_all_record_wo($wo_no)
	{
		$query = $this->db->query("SELECT a.*, b.port_cd as port_code, b.descs as port_name FROM tr_wo_trx_hdr a, sa_port b WHERE  a.port_rowID=b.rowID and a.wo_no = '$wo_no' AND a.deleted=0")->result();
		return $query;	
	}
	
	function get_all_record_jo($jo_no)
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
										d.descs as to_name,
										e.debtor_cd as debtor_code,
										e.debtor_name as debtor_name
									FROM tr_jo_trx_hdr a 
									LEFT JOIN sa_item b ON a.item_rowID = b.rowID
									LEFT JOIN sa_destination_from c ON a.destination_from_rowID = c.rowID
									LEFT JOIN sa_destination_to d ON a.destination_to_rowID = d.rowID
									LEFT JOIN sa_debtor e ON a.debtor_rowID = e.rowID
									WHERE a.jo_no = '$jo_no' AND a.deleted=0")->result();
		return $query;	
	}
	
	function get_advance_type_by_jo($advance_type_rowID)
	{
		
		$this->db->select('by_jo');
		$this->db->from('sa_advance_type');
		$this->db->where('rowID = ',$advance_type_rowID);
		$this->db->where('deleted = ','0');
		$query=$this->db->get();
		if ($query->num_rows() > 0)
		{
  		 $row = $query->row();
  		 return $row->by_jo;
  		}
	}
	
	function get_all_job_order()
	{
		$query = $this->db->query("SELECT * FROM tr_jo_trx_hdr WHERE  deleted=0")->result();
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
							b.by_jo as by_jo,
							c.jo_no as jo_no,
							c.tr_wo_trx_hdr_wo_no as wo_no,
							d.debtor_cd as debtor_code,
							d.debtor_name as debtor_name,
							e.police_no as police_no,
							g.from_cd as from_code,
							g.decs as from_name,
							h.to_cd as to_code,
							h.descs as to_name,
							i.debtor_cd as employee_driver_code,
							i.debtor_name as employee_driver_name,');
		$this->db->from('cb_cash_adv AS a');
		$this->db->join('sa_advance_type AS b','a.advance_type_rowID = b.rowID', 'LEFT');
		$this->db->join('tr_jo_trx_hdr AS c','a.tr_jo_trx_hdr_year = c.year AND a.tr_jo_trx_hdr_month = c.month AND a.tr_jo_trx_hdr_code = c.code', 'LEFT');
		$this->db->join('sa_debtor AS d','a.debtor_rowID = d.rowID', 'LEFT');
		$this->db->join('sa_vehicle AS e','a.vehicle_rowID = e.rowID', 'LEFT');
		$this->db->join('sa_vehicle_type AS f','a.vehicle_type_rowID = f.rowID', 'LEFT');
		$this->db->join('sa_destination_from AS g','a.destination_from_rowID = g.rowID', 'LEFT');
		$this->db->join('sa_destination_to AS h','a.destination_to_rowID = h.rowID', 'LEFT');
		$this->db->join('sa_debtor AS i','a.employee_driver_rowID = i.rowID', 'LEFT');
		$this->db->where('a.year = ',$year);
		$this->db->where('a.month = ',$month);
		$this->db->where('a.code = ',$code);
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