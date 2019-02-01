<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Verification_document_verified_model extends CI_Model
{
	
	function get_all_records()
	{
        $this->db->select('a.rowID,a.trx_no,a.status,b.advance_no,b.advance_date,b.advance_allocation,c.debtor_name,d.police_no');
        $this->db->from('tr_do_trx as a');
        $this->db->join('cb_cash_adv as b','a.trx_no = b.trx_no');
        $this->db->join('sa_debtor as c','b.employee_driver_rowID = c.rowID');
        $this->db->join('sa_vehicle as d', 'b.vehicle_rowID = d.rowID');
        $this->db->group_by('a.trx_no,a.status,b.advance_no,b.advance_date,b.advance_allocation,c.debtor_name,d.police_no');
        $this->db->having('a.deleted', 0);
        $this->db->having('b.deleted', 0);
        $this->db->order_by('b.advance_no','desc');
        $query=$this->db->get();
            
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
    
    function get_verify_user()
    {
        $this->db->select('a.user_rowID, b.password');
        $this->db->from('sa_usermenu as a');
        $this->db->join('sa_users as b', 'a.user_rowID = b.rowID');
        $this->db->where('a.StatusUsermenu', '1');
        $this->db->where('a.verified', 1);
        $this->db->where('a.kd_menu', 56); // 52 => Menu Cash Advance List
        $this->db->order_by('a.rowID', 'asc');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }
    }
	
    function get_count_realization($trx_no){
        $sql = "SELECT COUNT(a.trx_no) as count_realization, a.trx_no, a.deleted, b.deleted, b.alloc_amt
                FROM tr_do_trx as a INNER JOIN cb_cash_adv_alloc as b ON a.trx_no = b.alloc_no
                GROUP BY a.trx_no, a.deleted, b.deleted, b.alloc_amt
                HAVING a.deleted = 0 AND b.deleted = 0 AND a.trx_no = '".$trx_no."' 
                ORDER BY a.trx_no";    
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0)
        {
            return $query->row();
        } else
        {
            return null;
        }
    }
    
    function get_ca_by_do_no($do_no)
	{
        $this->db->select('a.rowID,a.trx_no,a.do_no,b.advance_no,b.advance_date,(b.advance_amount + b.advance_extra_amount) as total_amount,b.advance_allocation,
                            c.debtor_name,d.police_no,e.alloc_no,e.alloc_date,g.destination_name as from_name,h.destination_name as to_name');
        $this->db->from('tr_do_trx as a');
        $this->db->join('cb_cash_adv as b','a.trx_no = b.trx_no');
        $this->db->join('sa_debtor as c','b.employee_driver_rowID = c.rowID');
        $this->db->join('sa_vehicle as d', 'b.vehicle_rowID = d.rowID');
        $this->db->join('cb_cash_adv_alloc as e','a.trx_no = e.alloc_no');
        $this->db->join('tr_jo_trx_hdr as f','a.jo_no = f.jo_no');
        $this->db->join('sa_destination as g','f.destination_from_rowID = g.rowID');
        $this->db->join('sa_destination as h','f.destination_to_rowID = h.rowID');
        $this->db->where('a.deleted', 0);
        $this->db->where('b.deleted', 0);
        $this->db->where('e.deleted', 0);
        $this->db->where('f.deleted', 0);
        $this->db->where('a.do_no', $do_no);
        $this->db->order_by('b.advance_no','asc');
        $query=$this->db->get();
            
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
	}
    
    function get_jo_by_jo_no($jo_no)
	{
        $this->db->select('a.*,
							b.type_no as type_no,
							b.type_name as type_name,
							c.debtor_cd as debtor_code, 
							c.debtor_name as debtor_name, 
							d.port_cd as port_code,
							d.port_name as port_name,						
							e.fare_trip_cd as fare_trip_cd,
							f.destination_name as destination_from_name,
							g.destination_name as destination_to_name,
							h.item_cd as item_code,
							h.item_name as item_name');
		$this->db->from('tr_jo_trx_hdr AS a');
		$this->db->join('sa_reference AS b','b.type_no=a.jo_type AND b.type_ref="jo_type"', 'LEFT');
		$this->db->join('sa_debtor AS c','c.rowID=a.debtor_rowID', 'LEFT');
		$this->db->join('sa_port AS d','d.rowID=a.port_rowID', 'LEFT');
		$this->db->join('sa_fare_trip_hdr AS e','e.rowID = a.fare_trip_rowID', 'LEFT');
		$this->db->join('sa_destination AS f','f.rowID=a.destination_from_rowID', 'LEFT');
		$this->db->join('sa_destination AS g','g.rowID=a.destination_to_rowID', 'LEFT');
		$this->db->join('sa_item AS h','h.rowID=a.item_rowID', 'LEFT');
		$this->db->where('a.deleted','0');
		$this->db->where('a.jo_no',$jo_no);
		$this->db->order_by('a.jo_no','asc');        
        $query=$this->db->get();
            
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
	}
    
    function get_data_do_by_id($row_id)
	{
        $this->db->select('a.rowID,a.jo_no,a.do_no,a.komisi_supir,a.komisi_kernet,a.container_row_no,a.container_no,a.count_container,a.container_size,a.deliver_date,a.deliver_weight,
                            a.received_date,a.received_weight,b.jo_type,b.destination_from_rowID,b.destination_to_rowID, d.debtor_name, e.police_no');
        $this->db->from('tr_do_trx as a');
        $this->db->join('tr_jo_trx_hdr as b','a.jo_no = b.jo_no','left');
        $this->db->join('cb_cash_adv as c','c.trx_no = a.trx_no','left');
        $this->db->join('sa_debtor as d','d.rowID = c.employee_driver_rowID','left');
        $this->db->join('sa_vehicle as e','e.rowID = c.vehicle_rowID','left');
        $this->db->where('a.deleted', 0);
        $this->db->where('b.deleted', 0);
        $this->db->where('c.deleted', 0);
        $this->db->where('a.rowID', $row_id);
        $query=$this->db->get();
            
        if ($query->num_rows() > 0){
			return $query->row();
		} else{
			return NULL;
		}
	}

    function get_data_jo_by_filter($jo_type,$from_id,$to_id)
	{
        $this->db->select('a.*,
							b.type_no as type_no,
							b.type_name as type_name,
							c.debtor_cd as debtor_code, 
							c.debtor_name as debtor_name, 
							d.port_cd as port_code,
							d.port_name as port_name,						
							e.fare_trip_cd as fare_trip_cd,
							f.destination_name as destination_from_name,
							g.destination_name as destination_to_name,
							h.item_cd as item_code,
							h.item_name as item_name');
		$this->db->from('tr_jo_trx_hdr AS a');
		$this->db->join('sa_reference AS b','b.type_no=a.jo_type AND b.type_ref="jo_type"', 'LEFT');
		$this->db->join('sa_debtor AS c','c.rowID=a.debtor_rowID', 'LEFT');
		$this->db->join('sa_port AS d','d.rowID=a.port_rowID', 'LEFT');
		$this->db->join('sa_fare_trip_hdr AS e','e.rowID = a.fare_trip_rowID', 'LEFT');
		$this->db->join('sa_destination AS f','f.rowID=e.destination_from_rowID', 'LEFT');
		$this->db->join('sa_destination AS g','g.rowID=e.destination_to_rowID', 'LEFT');
		$this->db->join('sa_item AS h','h.rowID=a.item_rowID', 'LEFT');
		$this->db->where('a.deleted','0');
		$this->db->where('a.jo_type',$jo_type);
		$this->db->where('a.destination_from_rowID',$from_id);
		$this->db->where('a.destination_to_rowID',$to_id);
		$this->db->order_by('a.jo_no','desc');        
        $query=$this->db->get();
            
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
	}
    
    function update_data_by_row_id($row_id,$status){
        $check_verification_document = $this->db->get_where('tr_do_trx', array('rowID' =>$row_id))->row_array();

        $this->db->set('status',$status);
        if($status == 1 && $check_verification_document['verified'] == 0){
            $this->db->set('verified',1);
            $this->db->set('user_verified',$this->session->userdata('user_rowID'));
            $this->db->set('date_verified',date("Y-m-d"));
            $this->db->set('time_verified',date("H:i:s"));
        }
        $this->db->where('rowID',$row_id);
        $result = $this->db->update('tr_do_trx');
	
    }
    
    function update_document($dataPost){            
        if($dataPost['jo_type'] == 2){
            $this->db->set('container_no',$dataPost['container_no']);
            $this->db->set('container_size',$dataPost['container_size']);
        }
        $this->db->set('jo_no',$dataPost['jo_no']);
        $this->db->set('do_no',$dataPost['do_no']);
        $this->db->set('komisi_supir',str_replace('.','',$dataPost['komisi_supir']));
        $this->db->set('komisi_kernet',str_replace('.','',$dataPost['komisi_kernet']));
        $this->db->set('do_date',date('Y-m-d',strtotime($dataPost['deliver_date'])));
        $this->db->set('deliver_date',date('Y-m-d',strtotime($dataPost['deliver_date'])));
        $this->db->set('deliver_weight',str_replace('.','',$dataPost['deliver_weight']));
        $this->db->set('received_date',date('Y-m-d',strtotime($dataPost['received_date'])));
        $this->db->set('received_weight',str_replace('.','',$dataPost['received_weight']));
        $this->db->set('user_modified',$this->session->userdata('user_rowID'));
        $this->db->set('date_modified',date("Y-m-d"));
        $this->db->set('time_modified',date("H:i:s"));
        $this->db->where('rowID',$dataPost['row_id_edit']);
        $result = $this->db->update('tr_do_trx');
	
    }

}

/* End of file model.php */