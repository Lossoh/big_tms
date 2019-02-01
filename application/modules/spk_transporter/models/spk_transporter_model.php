<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Spk_transporter_model extends CI_Model
{
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

	function get_all_records_list($start_date,$end_date)
	{
		$this->db->select('a.*,b.creditor_name');
		$this->db->from('tr_spk_transporter_hdr as a');
		$this->db->join('sa_creditor as b','a.creditor_rowID = b.rowID', 'LEFT');
		$this->db->where('a.deleted','0');
		$this->db->where("a.spk_date BETWEEN '".$start_date."' AND '".$end_date."'");
		$this->db->order_by('a.spk_no','DESC');
        
        $query=$this->db->get();
		if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
		 
	}
    
    function get_data_creditor(){
        $sql = "SELECT DISTINCT b.rowID, b.creditor_name FROM `sa_transporter_tarif_hdr` as a LEFT JOIN `sa_creditor` as b ON `a`.`creditor_rowID` = `b`.`rowID` 
                WHERE `a`.`deleted` = '0' ORDER BY `b`.`creditor_name` ASC";
        $query=$this->db->query($sql);
		if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
		 
    }
    
    function get_data_vehicle_category(){
        $sql = "SELECT * FROM sa_vehicle_type 
                WHERE deleted = '0' 
                ORDER BY type_cd ASC";
        $query=$this->db->query($sql);
		if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
		 
    }
    
    function get_data_jo_emkl_by_jo_type($jo_type,$start_date,$end_date){
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
		$this->db->where('a.jo_type = ',$jo_type);
		$this->db->where('a.deleted = ',0);
        $this->db->where("a.jo_date BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->db->order_by("a.jo_no","asc");
        $query=$this->db->get();
		if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
		 
    }
    
    function get_data_jo_detail_by_jo_no($jo_no){

		$this->db->select("a.*, b.item_name, c.destination_from_rowID, c.destination_to_rowID, c.fare_trip_cd as destination",false);
		$this->db->from('tr_jo_emkl_trx_dtl as a');
		$this->db->join('sa_item as b','a.item_rowID = b.rowID','left');
		$this->db->join('sa_fare_trip_hdr as c','a.fare_trip_rowID = c.rowID','left');
        $this->db->where('a.deleted', 0);
        $this->db->where('a.jo_no', $jo_no);
        $this->db->order_by('a.rowID','asc');

        $query=$this->db->get();
        
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}

    }
    
    function get_data_header_by_spk_no($year,$month,$code)
	{
		$this->db->select('a.*, b.creditor_name');
		$this->db->from('tr_spk_transporter_hdr as a');
		$this->db->join('sa_creditor as b','a.creditor_rowID = b.rowID','left');
		$this->db->where('a.deleted','0');
		$this->db->where('a.year',$year);
		$this->db->where('a.month',$month);
		$this->db->where('a.code',$code);
		return $this->db->get()->row(); 
	}
    
    
    function check_data_header_by_jo_no($jo_no)
	{
		$this->db->select('*');
		$this->db->from('tr_spk_transporter_hdr');
		$this->db->where('deleted','0');
		$this->db->where('jo_no',$jo_no);
		return $this->db->get()->row(); 
	}
    
    function get_data_header_by_spk_number($spk_no)
	{
		$this->db->select('a.*, b.creditor_name');
		$this->db->from('tr_spk_transporter_hdr as a');
		$this->db->join('sa_creditor as b','a.creditor_rowID = b.rowID','left');
		$this->db->where('a.deleted','0');
		$this->db->where('a.spk_no',$spk_no);
		return $this->db->get()->row(); 
	}
    
    function get_data_spk_detail_by_spk_no_jo_detail_id($spk_no,$jo_emkl_detail_rowID){
		$this->db->select("*",false);
		$this->db->from('tr_spk_transporter_dtl');
		$this->db->where('deleted', 0);
        $this->db->where('spk_no', $spk_no);
        $this->db->where('jo_emkl_detail_rowID', $jo_emkl_detail_rowID);
        $this->db->order_by('rowID','asc');

        $query=$this->db->get();
        
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}

    }
    
    function check_data_spk_detail_by_spk_no_jo_detail_id($spk_no,$jo_emkl_detail_rowID){
		$this->db->select("*",false);
		$this->db->from('tr_spk_transporter_dtl');
		$this->db->where('deleted', 0);
        $this->db->where('spk_no', $spk_no);
        $this->db->where('jo_emkl_detail_rowID', $jo_emkl_detail_rowID);
        $this->db->order_by('rowID','asc');

        $query=$this->db->get();
        
        if ($query->num_rows() > 0){
			return $query->row();
		} else{
			return NULL;
		}

    }
    
    function get_sum_price_by_spk_no_jo_detail_id($spk_no,$jo_emkl_detail_rowID){
        $sql = "SELECT SUM(price) as total_price, spk_no, jo_emkl_detail_rowID, deleted
                FROM tr_spk_transporter_dtl 
                GROUP BY spk_no, jo_emkl_detail_rowID, deleted
                HAVING spk_no = '".$spk_no."' AND jo_emkl_detail_rowID = ".$jo_emkl_detail_rowID." AND deleted = 0";
        
        $query=$this->db->query($sql);
        
        if ($query->num_rows() > 0){
			return $query->row();
		} else{
			return NULL;
		}
    }
    
    function get_data_tarif_transporter($creditor_rowID,$jo_type,$item_rowID,$destination_from_rowID,$destination_to_rowID,$vehicle_type_rowID){
        $sql = "SELECT b.price
                FROM sa_transporter_tarif_hdr as a LEFT JOIN sa_transporter_tarif_dtl as b ON a.rowID = b.transporter_tarif_rowID
                WHERE a.creditor_rowID = ".$creditor_rowID." AND a.jo_type = ".$jo_type." AND a.cargo_rowID = ".$item_rowID." AND a.from_rowID = ".$destination_from_rowID." 
                        AND b.to_rowID = ".$destination_to_rowID." AND b.vehicle_type_rowID = ".$vehicle_type_rowID." AND a.deleted = 0 AND b.deleted = 0";
        
        $query=$this->db->query($sql);
        
        if ($query->num_rows() > 0){
			return $query->row();
		} else{
			return NULL;
		}
    }
    
}

/* End of file model.php */