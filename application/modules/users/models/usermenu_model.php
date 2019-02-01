<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Usermenu_model extends CI_Model
{
	function get_all_usermenu_by_user($user_id){
        $this->db->join('sa_usermenu','sa_usermenu.user_rowID = sa_users.rowID');
        $this->db->join('sa_menu','sa_menu.seq_menu = sa_usermenu.Kd_Menu');
		return $this->db->where(array('user_rowID'=>$user_id))->order_by('sa_menu.parentid','asc')->order_by('sa_menu.nm_menu','asc')->get('sa_users')->result();  
	}
    
	function get_all_menu($select,$where,$join_table,$join_criteria,$order,$sort)
	{
        $this->db->select('*');
        $this->db->from('sa_menu');
        $this->db->where('status','1');
        $this->db->order_by('parentid','asc');
        $this->db->order_by('nm_menu','asc');
        $query=$this->db->get();
            
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
	}
    
    function get_usermenu_by_menu_id($menu_id)
	{  

		$this->db->from('sa_usermenu');
		$this->db->where('kd_menu',$menu_id);
		$query = $this->db->get();
		return $query->row();
	}
    
   	function get_by_id($tabel,$id)
	{  

		$this->db->from($tabel);
		$this->db->where('rowID',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
    function delete_data($id){
        $this->db->set('StatusUsermenu','0');
        $this->db->where('rowID',$id);
        $result = $this->db->update('sa_usermenu');
	
    }

}

/* End of file model.php */