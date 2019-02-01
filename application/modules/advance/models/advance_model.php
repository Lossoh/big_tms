<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Advance_model extends CI_Model
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
    
    function get_all_record_data($start_date,$end_date){
		$this->db->select("a.*, b.debtor_cd, b.debtor_name, c.advance_name, d.creditor_cd, d.creditor_name",false);
		$this->db->from('tr_advance_trx_hdr as a');
		$this->db->join('sa_debtor as b', 'b.rowID = a.debtor_rowID');
		$this->db->join('sa_advance_category as c', 'c.rowID = a.advance_type_rowID');
		$this->db->join('sa_creditor as d', 'd.rowID = a.dp_creditor_rowID','left');
        $this->db->where('a.deleted', 0);
        $this->db->where("a.advance_date BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->db->order_by('a.rowID','desc');

        $query=$this->db->get();
        
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}

    }
    
    function get_all_debtor_data(){
        $sql = "SELECT * FROM sa_debtor WHERE deleted = 0 AND type = 'E' ORDER BY type, debtor_name";
        $query=$this->db->query($sql);
        
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_all_creditor_data(){
        $sql = "SELECT * FROM sa_creditor WHERE deleted = 0 AND creditor_type_rowID = 1 ORDER BY creditor_name";
        $query=$this->db->query($sql);
        
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_creditor_by_row_id($row_id){
        $sql = "SELECT * FROM sa_creditor WHERE rowID = ".$row_id;
        $query=$this->db->query($sql);
        
        if ($query->num_rows() > 0){
			return $query->row();
		} else{
			return NULL;
		}
    }
    
    function get_all_advance_type_data(){
        $sql = "SELECT * FROM sa_advance_category WHERE deleted = 0 ORDER BY advance_name";
        $query=$this->db->query($sql);
        
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
        
    }
    
    function get_all_advance_type_by_rowID($rowID){
        $sql = "SELECT * FROM sa_advance_category WHERE deleted = 0 AND rowID = ".$rowID." ORDER BY advance_name";
        $query=$this->db->query($sql);
        
        if ($query->num_rows() > 0){
			return $query->row();
		} else{
			return NULL;
		}
        
    }
    
    function get_data_cash_advance_jo()
    {

        $this->db->select('a.year,a.month,a.code,a.jo_no,a.jo_date,b.debtor_name as debtor,a.po_spk_no,a.so_no,a.vessel_no,a.jo_type,a.weight,
                a.price_20ft,a.price_40ft,a.price_45ft,a.wholesale,a.price_amount,a.vessel_name,c.port_name,a.fare_trip_rowID,
                d.destination_from_rowID,d.destination_to_rowID,e.destination_name as from_name, f.destination_name as to_name, g.item_name', false);
        $this->db->from('tr_jo_trx_hdr as a');
        $this->db->join('sa_debtor as b', 'a.debtor_rowID=b.rowID', 'left');
        $this->db->join('sa_port as c', 'a.port_rowID=c.rowID', 'left');
        $this->db->join('sa_fare_trip_hdr as d', 'a.fare_trip_rowID=d.rowID', 'left');
        $this->db->join('sa_destination as e', 'd.destination_from_rowID=e.rowID', 'left');
        $this->db->join('sa_destination as f', 'd.destination_to_rowID=f.rowID', 'left');
        $this->db->join('sa_item as g', 'a.item_rowID=g.rowID', 'left');
        $this->db->where('a.deleted =', 0);
        $this->db->where('a.status =', 0);
        $this->db->order_by('a.jo_no', 'desc');

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }

    }
    
    function get_data_cash_advance_jo_emkl()
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
		$this->db->where('a.deleted',0);
        $this->db->where('a.status', 0);
        $this->db->order_by('a.jo_no','DESC');

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }

    }
    
    public function select_max_by_field($field)
	{
		$this->db->select_max($field);
		$query = $this->db->get('tr_advance_trx_hdr');
		if($query->num_rows()>0){
            foreach($query->result() as $q){
				return ((int)$q->$field);
			}
		}

	}
    
    function get_by_id($id)
    {
        $this->db->select('a.*,b.po_spk_no,b.vessel_name,b.weight,c.port_name,d.item_name,e.advance_name,f.destination_name as to_destination,
                            g.destination_name as from_destination,h.debtor_name');
        $this->db->from('tr_advance_trx_hdr as a');
        $this->db->join('tr_jo_trx_hdr as b','b.jo_no = a.jo_no','left');
        $this->db->join('sa_port as c','c.rowID = b.port_rowID','left');
        $this->db->join('sa_item as d','d.rowID = b.item_rowID','left');
        $this->db->join('sa_advance_category as e', 'e.rowID = a.advance_type_rowID','left');
        $this->db->join('sa_destination as f', 'f.rowID = b.destination_to_rowID','left');
        $this->db->join('sa_destination as g', 'g.rowID = b.destination_from_rowID','left');
        $this->db->join('sa_debtor as h', 'h.rowID = a.debtor_rowID','left');
        $this->db->where('a.rowID', $id);
        $query = $this->db->get();
        return $query->row();
    }
	
    function get_data_emkl_by_id($id)
    {
        $this->db->select('a.*,b.po_spk_no,b.vessel_name,c.port_name,d.debtor_name,e.advance_name');
        $this->db->from('tr_advance_trx_hdr as a');
        $this->db->join('tr_jo_emkl_trx_hdr as b','b.jo_no = a.jo_no','left');
        $this->db->join('sa_port as c','c.rowID = b.port_rowID','left');
        $this->db->join('sa_debtor as d', 'd.rowID = a.debtor_rowID','left');
        $this->db->join('sa_advance_category as e', 'e.rowID = a.advance_type_rowID','left');
        $this->db->where('a.rowID', $id);
        $query = $this->db->get();
        return $query->row();
    }
    
    function get_detail_by_advance_number($advance_number)
    {
        $this->db->select('a.*,b.descs as expense_name');
        $this->db->from('tr_advance_trx_dtl as a');
        $this->db->join('sa_expense as b', 'b.rowID = a.expense_rowID','left');
        $this->db->where('a.deleted', 0);
        $this->db->where('a.advance_number', $advance_number);
        $query = $this->db->get();
        return $query->result();
    }
    
    function get_data_reimburse_by_advance_number($advance_number)
    {
        $this->db->select('*');
        $this->db->from('tr_reimburse_trx_adv_dtl');
        $this->db->where('deleted', 0);
        $this->db->where('advance_number', $advance_number);
        $query = $this->db->get();
        return $query->result();
    }
    
    function delete_data($tabel,$id)
    {
        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d H:i:s'));
        $this->db->where('rowID', $id);
        $this->db->update($tabel);
        
        // Update delete advance detail
        $get_data = $this->get_by_id($id);
        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d H:i:s'));
        $this->db->where('deleted', 0);
        $this->db->where('advance_number', $get_data->advance_number);
        $this->db->update('tr_advance_trx_dtl');
        
    }
    
}

/* End of file model.php */