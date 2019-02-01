<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Service_history_model extends CI_Model
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
    
    function get_data_vehicle_service_history(){
		$this->db->select("a.trx_no, c.debtor_name, b.police_no, a.deleted",false);
		$this->db->from('tr_service_history_hdr as a');
		$this->db->join('sa_vehicle as b','a.vehicle_rowID = b.rowID','left');
        $this->db->join('sa_debtor as c','a.debtor_rowID = c.rowID','left');
		$this->db->where('a.deleted', 0);
        $this->db->order_by('b.police_no','asc');

        $query=$this->db->get();
        
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_all_record_data($vehicle_rowID){
		$this->db->select("a.*, b.police_no, c.debtor_name",false);
		$this->db->from('tr_service_history_hdr as a');
		$this->db->join('sa_vehicle as b','a.vehicle_rowID = b.rowID','left');
        $this->db->join('sa_debtor as c','a.debtor_rowID = c.rowID','left');
		$this->db->where('a.deleted', 0);
        $this->db->where('a.vehicle_rowID', $vehicle_rowID);
        $this->db->order_by('a.trx_no','desc');

        $query=$this->db->get();
        
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_data_spk_by_id($rowID){
		$this->db->select("a.*, b.police_no, c.debtor_name, d.trx_no as spk_no, d.type_work_list, d.template_service_code, d.change_oil, d.cost_service, d.cost_part, 
                            d.cost_labour, d.cost_other, d.cost_total, d.user_created as usercreated, d.date_created as datecreated, d.time_created as timecreated, d.deleted as deleted_spk",false);
		$this->db->from('tr_service_history_hdr as a');
		$this->db->join('sa_vehicle as b','a.vehicle_rowID = b.rowID','left');
        $this->db->join('sa_debtor as c','a.debtor_rowID = c.rowID','left');
        $this->db->join('tr_spk_service_history as d','a.trx_no = d.complaint_no','left');
		$this->db->where('a.deleted', 0);
        $this->db->where('a.rowID', $rowID);
        $this->db->order_by('d.trx_no', 'desc');
        $query=$this->db->get();
        
        if ($query->num_rows() > 0){
			return $query->row();
		} else{
			return NULL;
		}

    }
    
    function get_data_spk_by_spk_no($spk_no){
		$this->db->select("a.*, b.police_no, c.debtor_name, d.trx_no as spk_no, d.trx_date as spk_date, d.type_work_list, d.template_service_code, d.change_oil, d.cost_service,
                            d.cost_part, d.cost_labour, d.cost_other, d.cost_total",false);
		$this->db->from('tr_service_history_hdr as a');
		$this->db->join('sa_vehicle as b','a.vehicle_rowID = b.rowID','left');
        $this->db->join('sa_debtor as c','a.debtor_rowID = c.rowID','left');
        $this->db->join('tr_spk_service_history as d','a.trx_no = d.complaint_no','left');
		$this->db->where('a.deleted', 0);
        $this->db->where('d.deleted', 0);
        $this->db->where('d.trx_no', $spk_no);

        $query=$this->db->get();
        
        if ($query->num_rows() > 0){
			return $query->row();
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
    
    function get_data_by_trx_no($trx_no)
    {
        $this->db->from('tr_service_history_hdr');
        $this->db->where('deleted', 0);
        $this->db->where('trx_no', $trx_no);
        $query = $this->db->get();
        return $query->row();
    }
    
    function get_data_detail_by_trx_no($trx_no)
    {
        $this->db->from('tr_service_history_dtl');
        $this->db->where('deleted', 0);
        $this->db->where('trx_no', $trx_no);
        $query = $this->db->get();
        return $query->result();
    }
    
    function get_data_spk_by_trx_no($trx_no)
    {
        $this->db->from('tr_spk_service_history');
        $this->db->where('deleted',0);
        $this->db->where('trx_no',$trx_no);
        $query = $this->db->get();
        if ($query->num_rows() > 0){
			return $query->row();
		} else{
			return NULL;
		}
    }
    
    function get_data_spk_by_complaint_no($complaint_no)
    {
        $this->db->from('tr_spk_service_history');
        $this->db->where('deleted',0);
        $this->db->where('complaint_no',$complaint_no);
        $this->db->order_by('trx_no','desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0){
			return $query->row();
		} else{
			return NULL;
		}
    }
    
    function get_data_service_not_finish_by_code($code)
    {
        $this->db->select('a.*,b.name as service_name');
        $this->db->from('tr_spk_service_history_work_list as a');
        $this->db->join('sa_part_service_hdr as b','a.service_code = b.code','left');
        $this->db->where('a.deleted',0);
        $this->db->where('b.deleted',0);
        $this->db->where('a.code',$code);
        $this->db->where('a.status !=','Finish');
        $this->db->order_by('a.progress_date','desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0){
			return $query->row();
		} else{
			return NULL;
		}
    }
    
    function get_data_service_finish_by_code($code)
    {
        $this->db->select('a.*,b.name as service_name');
        $this->db->from('tr_spk_service_history_work_list as a');
        $this->db->join('sa_part_service_hdr as b','a.service_code = b.code','left');
        $this->db->where('a.deleted',0);
        $this->db->where('b.deleted',0);
        $this->db->where('a.code',$code);
        $this->db->where('a.status','Finish');
        $this->db->order_by('a.progress_date','desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0){
			return $query->row();
		} else{
			return NULL;
		}
    }
    
    function get_data_template_spk_by_code($code)
    {
        $this->db->select('a.*,b.name as service_name, b.discount_type, b.discount');
        $this->db->from('tr_spk_service_history_work_list as a');
        $this->db->join('sa_part_service_hdr as b','a.service_code = b.code','left');
        $this->db->where('a.deleted',0);
        $this->db->where('b.deleted',0);
        $this->db->where('a.code',$code);
        $this->db->order_by('a.rowID','asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }

    function get_data_part_material_by_code($code)
    {
        $this->db->select('a.*,b.name as part_material_name, b.discount_type, b.discount, c.uom_cd as unit');
        $this->db->from('tr_spk_service_history_part_material as a');
        $this->db->join('sa_part_service_hdr as b','a.part_material_code = b.code','left');
        $this->db->join('sa_uom as c','b.uom_rowID = c.rowID','left');
        $this->db->where('a.deleted',0);
        $this->db->where('b.deleted',0);
        $this->db->where('a.code',$code);
        $query = $this->db->get();
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }

    function get_data_mechanic_by_code($code)
    {
        $this->db->select('a.*,b.debtor_cd,b.debtor_name');
        $this->db->from('tr_spk_service_history_mechanic as a');
        $this->db->join('sa_debtor as b','a.debtor_rowID = b.rowID','left');
        $this->db->where('a.deleted',0);
        $this->db->where('a.code',$code);
        $query = $this->db->get();
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
        
    function get_data_services()
	{
        $this->db->select('a.*, b.brand_name, c.uom_cd');
		$this->db->from('sa_part_service_hdr as a');
		$this->db->join('sa_brand as b','a.brand_rowID = b.rowID','left');
		$this->db->join('sa_uom as c','a.uom_rowID = c.rowID','left');
        $this->db->where('a.type','service');
        $this->db->where('a.deleted',0);
        $this->db->order_by('a.rowID','desc');
		$query = $this->db->get();
        
		if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
	}
    
    function get_data_part_materials()
	{
        $this->db->select('a.*, b.brand_name, c.uom_cd');
		$this->db->from('sa_part_service_hdr as a');
		$this->db->join('sa_brand as b','a.brand_rowID = b.rowID','left');
		$this->db->join('sa_uom as c','a.uom_rowID = c.rowID','left');
        $this->db->where('a.type','part');
        $this->db->or_where('a.type','material');
        $this->db->where('a.deleted',0);
        $this->db->order_by('a.rowID','desc');
		$query = $this->db->get();
        
		if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
	}

    function get_data_template_by_code($code)
    {
        $this->db->from('sa_template_service');
        $this->db->where('deleted',0);
        $this->db->where('code',$code);
        $query = $this->db->get();
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
	
    function get_data_service_by_code($code)
    {
        $this->db->from('sa_part_service_hdr');
        $this->db->where('deleted',0);
        $this->db->where('code',$code);
        $query = $this->db->get();
        if ($query->num_rows() > 0){
			return $query->row();
		} else{
			return NULL;
		}
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
    
    function delete_detail_data($trx_no)
    {

        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));
        $this->db->where('deleted', 0);
        $this->db->where('trx_no', $trx_no);
        return $this->db->update('tr_service_history_dtl');

    }
    
    function delete_spk_data($trx_no)
    {

        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));
        $this->db->where('deleted', 0);
        $this->db->where('trx_no', $trx_no);
        return $this->db->update('tr_spk_service_history');

    }

    function delete_detail_data_spk($table,$code)
    {

        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));
        $this->db->where('deleted', 0);
        $this->db->where('code', $code);
        return $this->db->update($table);

    }

}

/* End of file model.php */