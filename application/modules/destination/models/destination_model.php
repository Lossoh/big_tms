<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * @package	Freelancer Office
 */
class Destination_model extends CI_Model
{
	function destination_details($destination_id)
	{
/* 		$this->db->select('a.*, b.*, b.Nm_Ref AS bNm_Ref');
		$this->db->from('mst_destinations AS a');	 */	
 		$this->db->join('mst_reference AS b','b.No_Urut_Ref = mst_destinations.destination_flag AND b.Type_Ref = "destination_flag"', 'LEFT'); 
		$query = $this->db->where('destination_id',$destination_id)->get('mst_destinations');
		if ($query->num_rows() > 0){
			return $query->result();
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
	
	function user_activities($user_id,$limit)
	{
		$this->db->join('users','users.id = activities.user');
		return $this->db->where('user',$user_id)
							->order_by('activity_date','DESC')
							->get('activities',$limit,$this->uri->segment(5))->result();
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
    
	
	function roles()
	{
		$query = $this->db->get('roles');
		if ($query->num_rows() > 0){
			return $query->result();
		} 
	}
    
    function get_pdf()
    {
        # get data
        
            $this->db->select("a.destination_no,a.destination_name,concat(a.address1,' ',a.address2,' ',a.address3) as address,
            a.post_cd,a.telp_no,a.contact_prs",false);
			$this->db->from('sa_destination as a');
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