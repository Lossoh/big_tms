<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Container_model extends CI_Model
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
		return $this->db->get()->result(); 
	}
    
    function get_detail_data_by_jo($jo_no){

		$this->db->select("*",false);
		$this->db->from('tr_container_trx');
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
    
    function get_all_detail_data($start_date,$end_date){

		$this->db->select("a.*",false);
		$this->db->from('tr_container_trx as a');
		$this->db->join('tr_jo_emkl_trx_hdr as b','a.jo_no = b.jo_no','left');
        $this->db->where('a.deleted', 0);
        $this->db->where('b.deleted', 0);
        $this->db->where("b.jo_date BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->db->order_by('a.jo_no, a.container_type, a.container_no, a.seal_no','asc');

        $query=$this->db->get();
        
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}

    }
    
    function get_data_detail_by_jo_no_type($jo_no,$type){

		$this->db->select("*",false);
		$this->db->from('tr_container_trx');
        $this->db->where('deleted', 0);
        $this->db->where('jo_no', $jo_no);
        $this->db->where('container_type', $type);
        $this->db->order_by('rowID','asc');

        $query=$this->db->get();
        
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}

    }
	
    function get_by_id($tabel, $id)
    {

        $this->db->from($tabel);
        $this->db->where('rowID', $id);
        $query = $this->db->get();
        return $query->row();
    }
    
    function delete_data($tabel,$id)
    {

        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));
        $this->db->where('rowID', $id);
        return $this->db->update($tabel);

    }
    
}

/* End of file model.php */