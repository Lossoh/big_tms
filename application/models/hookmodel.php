<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Author Message
|--------------------------------------------------------------------------
|
| Fetch the config variables from DB
| 
*/
class HookModel extends CI_Model {

    public function __construct()
    {
		parent::__construct();
    }

    public function get_config()
    {
		return $this->db->get('sa_config');
    }

	public function get_company()
    {
		return $this->db->get('sa_comp');
    }
	
	
    public function get_lang()
    {
		$query = $this->db->select('value')->where('config_key','language')->get('sa_config');
        
		if ($query->num_rows() > 0)
          {
           $row = $query->row();
           return $row->value;
          }
    }
    
    // Delete Queue Hook
    function get_all_queue(){
        $this->db->select('*');
        $this->db->from('tr_queue');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }
    }
    
    function get_cash_advance_by_debtor_rowID($debtor_rowID)
    {
        $this->db->select('*');
        $this->db->from('cb_cash_adv');
        $this->db->where('advance_balance > ',0);
        $this->db->where('advance_type_rowID',1);
        $this->db->where('deleted',0);
        $this->db->where('employee_driver_rowID',$debtor_rowID);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }
	}
    
    function get_queue($debtor_rowID){
        $this->db->select('*');
        $this->db->from('tr_queue');
        $this->db->where('debtor_id',$debtor_rowID);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }
    }
    
    function get_spare_driver(){
        $this->db->select('*');
        $this->db->from('sa_debtor');
        $this->db->where('type','D');
        $this->db->where('spare_driver',1);
        $this->db->where('deleted',0);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }
    }
    
    function get_attendance_daily_by_debtor($debtor_id){
		$this->db->select("*");
		$this->db->from('tr_log_attendance');
        $this->db->where('DATE(date_created)', date('Y-m-d'));
        $this->db->where('debtor_id', $debtor_id);

        $query=$this->db->get();
        
        if ($query->num_rows() > 0){
			return $query->row();
		} else{
			return NULL;
		}

    }
    
    function insert_log($data){
        $result = $this->db->insert('tr_log_attendance', $data);
        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }
    
	function delete_queue($debtor_rowID){
        $this->db->where('debtor_id',$debtor_rowID);
        $result = $this->db->delete('tr_queue');
        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }
	
}