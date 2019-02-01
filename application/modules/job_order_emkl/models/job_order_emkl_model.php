<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Job_order_emkl_model extends CI_Model
{
	function get_all_records_list($start_date,$end_date)
	{
		$this->db->select('a.*,
							b.type_no as type_no,
							b.type_name as type_name,
							c.debtor_cd as debtor_code, 
							c.debtor_name as debtor_name, 
							d.port_cd as port_code,
							d.port_name as port_name');
		$this->db->from('tr_jo_emkl_trx_hdr AS a');
		$this->db->join('sa_reference AS b','b.type_no=a.jo_type AND b.type_ref="jo_type"', 'LEFT');
		$this->db->join('sa_debtor AS c','c.rowID=a.debtor_rowID', 'LEFT');
		$this->db->join('sa_port AS d','d.rowID=a.port_rowID', 'LEFT');
		$this->db->where('a.deleted','0');
        $this->db->where("a.jo_date BETWEEN '".$start_date."' AND '".$end_date."'");
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
							d.port_name as port_name');
		$this->db->from('tr_jo_emkl_trx_hdr AS a');
		$this->db->join('sa_reference AS b','b.type_no=a.jo_type AND b.type_ref="jo_type"', 'LEFT');
		$this->db->join('sa_debtor AS c','c.rowID=a.debtor_rowID', 'LEFT');
		$this->db->join('sa_port AS d','d.rowID=a.port_rowID', 'LEFT');
		$this->db->where('a.deleted','0');
		$this->db->where('a.year',$year);
		$this->db->where('a.month',$month);
		$this->db->where('a.code',$code);
		$this->db->order_by('a.jo_no','DESC');
		return $this->db->get()->result_array(); 
	}
    
    function get_data_jo_header_by_jo($year,$month,$code)
	{
		$this->db->select('*, b.eta_date');
		$this->db->from('tr_jo_emkl_trx_hdr as a');
		$this->db->join('tr_vessel_trx as b','a.vessel_rowID = b.rowID','left');
		$this->db->where('a.deleted','0');
		$this->db->where('b.deleted','0');
		$this->db->where('a.year',$year);
		$this->db->where('a.month',$month);
		$this->db->where('a.code',$code);
		return $this->db->get()->row(); 
	}
    
    function get_data_jo_document_by_jo($jo_no)
	{
		$this->db->select('*');
		$this->db->from('tr_jo_emkl_trx_doc');
		$this->db->where('deleted','0');
		$this->db->where('jo_no',$jo_no);
		return $this->db->get()->row(); 
	}
    
    function get_data_document_process_by_jo($jo_no)
	{
		$this->db->select('*');
		$this->db->from('tr_jo_emkl_trx_do_process');
		$this->db->where('deleted','0');
		$this->db->where('jo_no',$jo_no);
		return $this->db->get()->result(); 
	}
    
    function get_all_record_data_active()
    {
        $this->db->select("a.*, c.destination_name as destination_from, d.destination_name as destination_to", false);
        $this->db->from('sa_fare_trip_hdr as a');
        $this->db->join('sa_destination as c', 'c.rowID = a.destination_from_rowID', 'left');
        $this->db->join('sa_destination as d', 'd.rowID = a.destination_to_rowID', 'left');
        $this->db->where('a.deleted', 0);
        $this->db->where('a.status', 1);
        $this->db->order_by('c.destination_name, d.destination_name', 'asc');

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }

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

    function get_data_vessel_by_date($start_date,$end_date){

		$this->db->select("a.*, b.port_type, b.port_name",false);
		$this->db->from('tr_vessel_trx as a');
		$this->db->join('sa_port as b', 'b.rowID = a.port_rowID');
        $this->db->where('a.deleted', 0);
        $this->db->where("a.eta_date BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->db->order_by('a.eta_date','asc');

        $query=$this->db->get();
        
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}

    }
    
    function get_data_jo_detail_by_jo_no($jo_no){

		$this->db->select("*",false);
		$this->db->from('tr_jo_emkl_trx_dtl');
        $this->db->where('deleted', 0);
        $this->db->where('jo_no', $jo_no);
        $this->db->order_by('rowID','asc');

        $query=$this->db->get();
        
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}

    }
    
    function get_data_container_detail_by_jo_no($type,$jo_no){

		$this->db->select("*",false);
		$this->db->from('tr_container_trx');
        $this->db->where('container_type', $type);
        $this->db->where('deleted', 0);
        $this->db->where('jo_no', $jo_no);
        $this->db->order_by('rowID','asc');

        $query=$this->db->get();
        
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}

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
		$this->db->from('tr_jo_emkl_trx_hdr AS a');
		$this->db->join('sa_debtor AS b','a.debtor_rowID = b.rowID', 'LEFT');
		$this->db->join('tr_wo_trx_hdr AS c','a.wo_trx_hdr_wo_code = c.code AND a.wo_trx_hdr_wo_year = c.year', 'LEFT');
		$this->db->join('sa_port AS d','c.port_rowID = d.rowID', 'LEFT');
		$this->db->join('sa_destination_from AS e','a.destination_from_rowID = e.rowID', 'LEFT');
		$this->db->join('sa_destination_to AS f','a.destination_to_rowID = f.rowID', 'LEFT');
		$this->db->join('sa_item AS g','a.item_rowID = g.rowID', 'LEFT');
		$this->db->where('a.deleted = ',0);
		$this->db->where('a.year = ',$year);
		$this->db->where('a.month = ',$month);
		$this->db->where('a.code = ',$code);
		return $this->db->get()->result_array(); 
	}
	
	function get_job_order_emkl_count_20ft($year,$month,$code)
	{
		$this->db->select('weight_20ft');
		$this->db->from('tr_jo_emkl_trx_hdr');
		$this->db->where('year = ',$year);
		$this->db->where('month = ',$month);
		$this->db->where('code = ',$code);
		return $this->db->get()->result_array(); 
	}
	
	function get_job_order_emkl_count_40ft($year,$month,$code)
	{
		$this->db->select('weight_40ft');
		$this->db->from('tr_jo_emkl_trx_hdr');
		$this->db->where('year = ',$year);
		$this->db->where('month = ',$month);
		$this->db->where('code = ',$code);
		return $this->db->get()->result_array(); 
	}
	
	function get_job_order_emkl_count_45ft($year,$month,$code)
	{
		$this->db->select('weight_45ft');
		$this->db->from('tr_jo_emkl_trx_hdr');
		$this->db->where('year = ',$year);
		$this->db->where('month = ',$month);
		$this->db->where('code = ',$code);
		return $this->db->get()->result_array(); 
	}
    
    function get_job_order_emkl_by_jo($year,$month,$code)
	{
		$this->db->select('*');
		$this->db->from('tr_jo_emkl_trx_hdr');
		$this->db->where('year',$year);
		$this->db->where('month',$month);
		$this->db->where('code',$code);
		$this->db->where('deleted',0);
		return $this->db->get()->row(); 
	}
	
	function job_order_emkl_details($job_order_emkl)
	{
		$this->db->select('a.*,
							b.debtor_cd as debtor_code, 
							b.debtor_name as debtor_name, 
							c.port_cd as port_code,
							c.descs as port_name');
		$this->db->from('tr_wo_trx_hdr AS a');
		$this->db->join('sa_debtor AS b','a.debtor_rowID = b.rowID', 'LEFT');
		$this->db->join('sa_port AS c','a.port_rowID = c.rowID', 'LEFT');
		$this->db->where('a.wo_no',$job_order_emkl);
		return $this->db->get()->result_array(); 
	}
	
    function delete_detail_jo($jo_no){
        $this->db->set('deleted',1);
        $this->db->set('user_deleted',$this->session->userdata('user_rowID'));
        $this->db->set('date_deleted',date('Y-m-d'));
        $this->db->set('time_deleted',date('H:i:s'));
        $this->db->where('deleted',0);
        $this->db->where('jo_no',$jo_no);
        $result=$this->db->update('tr_jo_emkl_trx_dtl');
        if ($result){
            return true;
        }
        else{
            return false;
        } 
    }
    
    function delete_document_detail_jo($jo_no){
        $this->db->set('deleted',1);
        $this->db->set('user_deleted',$this->session->userdata('user_rowID'));
        $this->db->set('date_deleted',date('Y-m-d'));
        $this->db->set('time_deleted',date('H:i:s'));
        $this->db->where('deleted',0);
        $this->db->where('jo_no',$jo_no);
        $result=$this->db->update('tr_jo_emkl_trx_doc');
        if ($result){
            return true;
        }
        else{
            return false;
        } 
    }
    
    function delete_detail_doc_jo($jo_no){
        $this->db->set('deleted',1);
        $this->db->set('user_deleted',$this->session->userdata('user_rowID'));
        $this->db->set('date_deleted',date('Y-m-d'));
        $this->db->set('time_deleted',date('H:i:s'));
        $this->db->where('deleted',0);
        $this->db->where('jo_no',$jo_no);
        $result=$this->db->update('tr_jo_emkl_trx_do_process');
        if ($result){
            return true;
        }
        else{
            return false;
        } 
    }    

    function delete_detail_container_jo($jo_no){
        $this->db->set('deleted',1);
        $this->db->set('user_deleted',$this->session->userdata('user_rowID'));
        $this->db->set('date_deleted',date('Y-m-d'));
        $this->db->set('time_deleted',date('H:i:s'));
        $this->db->where('deleted',0);
        $this->db->where('jo_no',$jo_no);
        $result=$this->db->update('tr_container_trx');
        if ($result){
            return true;
        }
        else{
            return false;
        } 
    }
    
    function delete_do_container_jo($jo_no){
        $this->db->set('deleted',1);
        $this->db->set('user_deleted',$this->session->userdata('user_rowID'));
        $this->db->set('date_deleted',date('Y-m-d'));
        $this->db->set('time_deleted',date('H:i:s'));
        $this->db->where('deleted',0);
        $this->db->where('jo_no',$jo_no);
        $result=$this->db->update('tr_jo_emkl_trx_do');
        if ($result){
            return true;
        }
        else{
            return false;
        } 
    }
    
    function delete_container_jo($jo_no){
        $this->db->set('deleted',1);
        $this->db->set('user_deleted',$this->session->userdata('user_rowID'));
        $this->db->set('date_deleted',date('Y-m-d'));
        $this->db->set('time_deleted',date('H:i:s'));
        $this->db->where('deleted',0);
        $this->db->where('jo_no',$jo_no);
        $result=$this->db->update('tr_container_trx');
        if ($result){
            return true;
        }
        else{
            return false;
        } 
    }
    
    function delete_do_process_jo($jo_no){
        $this->db->set('deleted',1);
        $this->db->set('user_deleted',$this->session->userdata('user_rowID'));
        $this->db->set('date_deleted',date('Y-m-d'));
        $this->db->set('time_deleted',date('H:i:s'));
        $this->db->where('deleted',0);
        $this->db->where('jo_no',$jo_no);
        $result=$this->db->update('tr_jo_emkl_trx_do_process');
        if ($result){
            return true;
        }
        else{
            return false;
        } 
    }
    
}

/* End of file model.php */