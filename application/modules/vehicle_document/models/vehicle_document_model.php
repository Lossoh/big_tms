<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Vehicle_document_model extends CI_Model
{
	function get_all_records_list($select,$where,$join_table1,$join_table2,$join_criteria1,$join_criteria2,$order,$sort)
	{
		$this->db->select($select.'.*,'.$join_table1.'.type_cd AS vehicle_code,'.$join_table1.'.type_name AS vehicle_name,'.$join_table2.'.debtor_cd AS driver_code,'.$join_table2.'.debtor_name AS driver_name');
		$this->db->from($select);
		$this->db->where($where);
		if($join_table1){
			$this->db->join($join_table1,$join_criteria1,'LEFT');
		}
		if($join_table2){
			$this->db->join($join_table2,$join_criteria2,'LEFT');
		}
		$query = $this->db->order_by($order,$sort)->get();
		if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
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
    
   	function get_by_id($tabel,$id)
	{  

		$this->db->from($tabel);
		$this->db->where('rowID',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
      function delete_data($id){
        
        $this->db->set('deleted',1);
        $this->db->where('rowID',$id);
        $result = $this->db->update('sa_vehicle');
	
    }
	
	function vehicle_details($vehicle)
	{
		$query = $this->db->where('rowID',$vehicle)->get('sa_vehicle');
		if ($query->num_rows() > 0){
			return $query->result();
		} 
	}
	
    
    function get_pdf()
    {
        # get data
        $hasil=$this->db->query("select a.police_no,case when a.head_truck='Y' then 'Yes' else 'No' end as head_truck, a.gps_no, 
                            a.no_stnk, a.expired_stnk, a.status_stnk, a.no_kir, a.expired_kir, a.status_kir, a.no_bpkb, a.status_bpkb,
                            CONCAT(b.type_cd,' - ',b.type_name) as vehicle_type,
                            Concat(c.debtor_cd,' - ',c.debtor_name) as Driver
                            from sa_vehicle a
                            inner join sa_vehicle_type b on b.rowID = a.vehicle_type_rowID
                            left  join sa_debtor c on c.rowID = a.debtor_rowID where a.deleted =0");
        
        //echo $this->db->last_query();exit();  
        $data = array();
        if ($hasil->num_rows() > 0)
        {
            $data = $hasil->result();
        }

        $hasil->free_result();

        return $data;
        

    }

}

/* End of file model.php */