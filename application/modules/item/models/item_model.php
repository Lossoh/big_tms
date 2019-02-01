<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Item_model extends CI_Model
{
	
	function get_all_records($select,$where,$join_table,$join_criteria,$order,$sort)
	{

        
        $this->db->select('a.rowID,a.item_cd,a.item_name,a.minimum,a.maximum,b.descs');
        $this->db->from('sa_item as a');
        $this->db->join('sa_uom as b', 'b.rowID = a.uom_rowID');
        $this->db->where('a.deleted', 0);
        $this->db->order_by('a.rowID','desc');
        $query=$this->db->get();
            
            if ($query->num_rows() > 0){
    			return $query->result();
    		} else{
    			return NULL;
    		}
        /*    
		$this->db->select($select.'.*,'.$join_table.'.descs AS item_descs');
		$this->db->from($select);
		$this->db->where($where);
		if($join_table){
		$this->db->join($join_table,$join_criteria);
		}
		$query = $this->db->order_by($order,$sort)->get();
		if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
		*/
	}
	
	function get_all_records_item($table,$where,$join_table,$join_criteria,$order, $sort)
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
	
	function item_details($item)
	{
		$query = $this->db->where('rowID',$item)->get('sa_item');
		if ($query->num_rows() > 0){
			return $query->result();
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
        $this->db->set('date_deleted',date('Y-m-d'));
        $this->db->set('time_deleted',date('H:i:s'));
        $this->db->where('rowID',$id);
        $result = $this->db->update('sa_item');
	
    }
    
    function get_pdf()
    {
        # get data
        
            $this->db->select("a.rowID,a.item_cd,a.item_name,a.minimum,a.maximum,
            CONCAT(b.uom_cd,' - ',b.descs) as uom",false);
			$this->db->from('sa_item as a');
            $this->db->join('sa_uom as b', 'b.rowID = a.uom_rowID','left');
            $this->db->where('a.deleted', 0);
            $this->db->order_by('a.rowID','desc');

        $hasil = $this->db->get();

        //echo $this->db->last_query();exit();
        $data = array();
        if ($hasil->num_rows() > 0) {
            $data = $hasil->result();
        }

        $hasil->free_result();

        return $data;


    }
	

}

/* End of file model.php */