<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Generate_commission_model extends CI_Model
{
	
	function create_table($table)
	{
        $table_name = $table.'_'.$this->tank_auth->get_username().'_'.date('YmdHis');
		if($table == 'temp_commission'){
            $sql = '
                CREATE TABLE '.$table_name.' (
                    rowID INT(6) AUTO_INCREMENT PRIMARY KEY,
                    do_trx_rowID int NOT NULL,
                    debtor_rowID int NOT NULL,
                    debtor_name VARCHAR(50) NOT NULL,
                    komisi_supir double NOT NULL,
                    komisi_kernet double NOT NULL,
                    jo_no VARCHAR(25) NOT NULL,
                    do_no VARCHAR(25) NOT NULL,
                    amount_deposit double NOT NULL,
                    amount_loan double NOT NULL
                ) 
            ';
            $query = $this->db->query($sql);
		}
        else if($table == 'temp_loan'){
            $sql = '
                CREATE TABLE '.$table_name.' (
                    rowID INT(6) AUTO_INCREMENT PRIMARY KEY,
                    debtor_rowID int NOT NULL,
                    max_saldo_loan double NOT NULL,
                    advance_no VARCHAR(25) NOT NULL,
                    amount_loan double NOT NULL,
                    amount_payment double NOT NULL
                ) 
            ';
            $query = $this->db->query($sql);           
        }
        
        $this->session->set_userdata($table,$table_name);

		if ($query){
			return true;
		} else{
			return null;
		}
		
	}
    
    function get_all_commissions($start_date,$end_date){
        $this->db->select('*');
        $this->db->from('tr_commission_trx');
        $this->db->where('deleted',0);
        $this->db->where("until_date BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->db->order_by('rowID','desc');
        $query=$this->db->get();
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_all_commission_by_comm_id($comm_id){
        $this->db->select('*');
        $this->db->from('tr_commission_trx');
        $this->db->where('rowID',$comm_id);
        $this->db->where('deleted',0);
        $this->db->order_by('rowID','desc');
        $query=$this->db->get();
        if ($query->num_rows() > 0){
			return $query->row();
		} else{
			return NULL;
		}
    }
    
    function get_all_commission_by_comm_no($comm_no){
        $this->db->select('*');
        $this->db->from('tr_commission_trx');
        $this->db->where('deleted',0);
        $this->db->where('commission_no',$comm_no);
        $query=$this->db->get();
        if ($query->num_rows() > 0){
			return $query->row();
		} else{
			return NULL;
		}
    }
    
    function get_all_do_detail_by_comm_no($comm_no){
       $sql = "SELECT `b`.`advance_no`, `b`.`advance_date`, `a`.`jo_no`, `a`.`do_no`, `d`.`police_no`, a.received_weight, `c`.`debtor_name`, f.fare_trip_cd, g.type_name, f.poin 
                FROM (`tr_do_trx` as a) 
                    LEFT JOIN `cb_cash_adv` as b ON `a`.`trx_no` = `b`.`trx_no` 
                    LEFT JOIN `sa_debtor` as c ON `b`.`employee_driver_rowID` = `c`.`rowID` 
                    LEFT JOIN `sa_vehicle` as d ON `b`.`vehicle_rowID` = `d`.`rowID` 
                    LEFT JOIN `tr_jo_trx_hdr` as e ON `a`.`jo_no` = `e`.`jo_no`
                    LEFT JOIN `sa_fare_trip_hdr` as f ON `e`.`fare_trip_rowID` = `f`.`rowID`
                    LEFT JOIN `sa_vehicle_type` as g ON `f`.`vehicle_id` = `g`.`rowID`
                WHERE `a`.`deleted` = 0 AND `b`.`deleted` = 0 AND `e`.`deleted` = 0 AND a.commission_no = '".$comm_no."' 
                ORDER BY `b`.`advance_no`, `a`.`jo_no`, `a`.`do_no` asc";
                
        $query=$this->db->query($sql);
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_all_commission_detail_by_comm_id($comm_id){
        $this->db->select('*');
        $this->db->from('tr_commission_trx_dtl as a');
        $this->db->join('sa_debtor as b', 'a.debtor_rowID = b.rowID');
        $this->db->where('a.commission_rowID',$comm_id);
        $this->db->where('a.deleted',0);
        $this->db->order_by('b.debtor_name','asc');
        $query=$this->db->get();
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }

    function get_all_commission_detail_by_comm_debtor_id($comm_id,$debtor_id){
        $this->db->select('*');
        $this->db->from('tr_commission_trx_dtl as a');
        $this->db->join('sa_debtor as b', 'a.debtor_rowID = b.rowID');
        $this->db->where('a.commission_rowID',$comm_id);
        if($debtor_id != '' || $debtor_id != null){
            $this->db->where('a.debtor_rowID',$debtor_id);
        }
        $this->db->where('a.deleted',0);
        $this->db->order_by('b.debtor_name','asc');
        $query=$this->db->get();
        if ($query->num_rows() > 0){
			return $query->row();
		} else{
			return NULL;
		}
    }
    
    function get_debtor_by_debtor_id($debtor_id){
        $this->db->select('*');
        $this->db->from('sa_debtor');
        $this->db->where('rowID',$debtor_id);
        $this->db->where('deleted',0);
        $this->db->order_by('debtor_name','asc');
        $query=$this->db->get();
        if ($query->num_rows() > 0){
			return $query->row();
		} else{
			return NULL;
		}
    }
    
    function get_cash_advance_by_comm($comm_no){
        $this->db->select('*');
        $this->db->from('cb_cash_adv_alloc');
        $this->db->where('deleted',0);
        $this->db->where('commission_no',$comm_no);
        $query=$this->db->get();
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_cash_advance_by_comm_debtor_id($comm_no,$debtor_id){
        $this->db->select('*');
        $this->db->from('cb_cash_adv_alloc as a');
        $this->db->join('cb_cash_adv as b', 'a.cb_cash_adv_no = b.advance_no');
        $this->db->where('a.commission_no',$comm_no);
        if($debtor_id != '' || $debtor_id != null){
            $this->db->where('b.employee_driver_rowID',$debtor_id);
        }
        $this->db->where('a.deleted',0);
        $this->db->where('b.deleted',0);
        $this->db->order_by('a.cb_cash_adv_no','asc');
        $query=$this->db->get();
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_cash_advance_by_comm_debtor_id_advance_no($comm_no,$debtor_id,$advance_no){
        $this->db->select('*');
        $this->db->from('cb_cash_adv_alloc as a');
        $this->db->join('cb_cash_adv as b', 'a.cb_cash_adv_no = b.advance_no');
        $this->db->where('a.commission_no',$comm_no);
        if($debtor_id != '' || $debtor_id != null){
            $this->db->where('b.employee_driver_rowID',$debtor_id);
        }
        $this->db->where('a.deleted',0);
        $this->db->where('b.deleted',0);
        $this->db->where('a.cb_cash_adv_no',$advance_no);
        $this->db->order_by('a.cb_cash_adv_no','asc');
        $query=$this->db->get();
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_all_do_by_comm_debtor_id($comm_no,$debtor_id,$until_date){
		$this->db->select("a.komisi_supir,a.komisi_kernet,a.do_no,a.do_date,a.count_container,a.container_size,c.item_name,
                            d.destination_name as dari,e.destination_name as tujuan,g.police_no",false);
		$this->db->from('tr_do_trx as a');
        $this->db->join('tr_jo_trx_hdr AS b', 'b.jo_no=a.jo_no','left');
        $this->db->join('sa_item AS c', 'c.rowID=b.item_rowID','left');
        $this->db->join('sa_destination AS d', 'd.rowID=b.destination_from_rowID','left');
        $this->db->join('sa_destination AS e', 'e.rowID=b.destination_to_rowID','left');
		$this->db->join('cb_cash_adv as f', 'f.trx_no = a.trx_no','left');
        $this->db->join('sa_vehicle as g', 'g.rowID=f.vehicle_rowID','left');
        $this->db->where('a.deleted', 0);
        $this->db->where('b.deleted', 0);
        $this->db->where('f.deleted', 0);
        $this->db->where('a.status', 1);
        $this->db->where('a.commission_no',$comm_no);
        $this->db->where('a.date_verified <= ', $until_date);
        if($debtor_id != '' || $debtor_id != null){        
            $this->db->where('f.employee_driver_rowID',$debtor_id);
        }
        $this->db->order_by('a.do_no','asc');
          
        $query=$this->db->get();
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_do_by_comm($comm_no,$until_date){
		$sql = "SELECT a.deleted, b.deleted, a.status, a.commission_no, a.date_verified, c.police_no, c.vehicle_type, SUM(a.received_weight) as tonase, 
                        COUNT(a.do_no) as ritase, SUM(a.komisi_supir) as komisi_supir, SUM(a.komisi_kernet) as komisi_kernet
                FROM (`tr_do_trx` as a) LEFT JOIN `cb_cash_adv` as b ON `b`.`trx_no` = `a`.`trx_no` 
                                        LEFT JOIN `sa_vehicle` as c ON `c`.`rowID`=`b`.`vehicle_rowID` 
                GROUP BY a.deleted, b.deleted, a.status, a.commission_no, c.police_no, c.vehicle_type
                HAVING `a`.`deleted` = 0 AND `b`.`deleted` = 0 AND `a`.`status` = 1 AND `a`.`commission_no` = '".$comm_no."' AND `a`.`date_verified` <= '".$until_date."' 
                ORDER BY `c`.`police_no` asc";
          
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_do_by_comm_departement($comm_no,$until_date,$departement_id){
		$sql = "SELECT a.deleted, b.deleted, a.status, a.commission_no, a.date_verified, c.police_no, c.vehicle_type, SUM(a.received_weight) as tonase, 
                        COUNT(a.do_no) as ritase, SUM(a.komisi_supir) as komisi_supir, SUM(a.komisi_kernet) as komisi_kernet, `d`.`dep_rowID`
                FROM (`tr_do_trx` as a) LEFT JOIN `cb_cash_adv` as b ON `b`.`trx_no` = `a`.`trx_no` 
                                        LEFT JOIN `sa_vehicle` as c ON `c`.`rowID`=`b`.`vehicle_rowID` 
                                        LEFT JOIN `sa_users` as d ON `d`.`rowID`=`a`.`user_created`
                GROUP BY a.deleted, b.deleted, a.status, a.commission_no, c.police_no, c.vehicle_type, `d`.`dep_rowID`
                HAVING `a`.`deleted` = 0 AND `b`.`deleted` = 0 AND `a`.`status` = 1 AND `a`.`commission_no` = '".$comm_no."' AND `a`.`date_verified` <= '".$until_date."' AND `d`.`dep_rowID` = ".$departement_id." 
                ORDER BY `c`.`police_no` asc";
          
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_realization_amount_by_comm($comm_no,$until_date,$police_no){
		$sql = "SELECT a.deleted, b.deleted, d.deleted, a.status, a.commission_no, a.date_verified, c.rowID, c.police_no, c.vehicle_type, a.trx_no, d.alloc_amt
                FROM (`tr_do_trx` as a) LEFT JOIN `cb_cash_adv` as b ON `b`.`trx_no` = `a`.`trx_no` 
                                        LEFT JOIN `sa_vehicle` as c ON `c`.`rowID`=`b`.`vehicle_rowID` 
                                        LEFT JOIN cb_cash_adv_alloc as d ON a.trx_no = d.alloc_no
                                        LEFT JOIN `sa_users` as e ON `e`.`rowID`=`a`.`user_created`
                GROUP BY a.deleted, b.deleted, d.deleted, a.status, a.commission_no, c.rowID, c.police_no, c.vehicle_type, a.trx_no, d.alloc_amt
                HAVING `a`.`deleted` = 0 AND `b`.`deleted` = 0 AND `d`.`deleted` = 0 AND `a`.`status` = 1 AND `a`.`commission_no` = '".$comm_no."' AND `a`.`date_verified` <= '".$until_date."' 
		                  AND c.police_no = '".$police_no."'
                ORDER BY `c`.`police_no` asc";
          
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_realization_amount_by_comm_departement($comm_no,$until_date,$police_no,$departement_id){
		$sql = "SELECT a.deleted, b.deleted, d.deleted, a.status, a.commission_no, a.date_verified, c.rowID, c.police_no, c.vehicle_type, a.trx_no, d.alloc_amt, e.dep_rowID
                FROM (`tr_do_trx` as a) LEFT JOIN `cb_cash_adv` as b ON `b`.`trx_no` = `a`.`trx_no` 
                                        LEFT JOIN `sa_vehicle` as c ON `c`.`rowID`=`b`.`vehicle_rowID` 
                                        LEFT JOIN cb_cash_adv_alloc as d ON a.trx_no = d.alloc_no
                                        LEFT JOIN `sa_users` as e ON `e`.`rowID` = `a`.`user_created`
                GROUP BY a.deleted, b.deleted, d.deleted, a.status, a.commission_no, c.rowID, c.police_no, c.vehicle_type, a.trx_no, d.alloc_amt, e.dep_rowID
                HAVING `a`.`deleted` = 0 AND `b`.`deleted` = 0 AND `d`.`deleted` = 0 AND `a`.`status` = 1 AND `a`.`commission_no` = '".$comm_no."' AND `a`.`date_verified` <= '".$until_date."' 
		                  AND c.police_no = '".$police_no."' AND e.dep_rowID = ".$departement_id."
                ORDER BY `c`.`police_no` asc";
          
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_field_cost_by_comm($comm_no,$until_date){
		$sql = "SELECT a.deleted, b.deleted, a.status, a.commission_no, `c`.`dep_rowID`, b.cost_rowID, d.descs, a.date_verified, SUM(b.trx_amt) as field_cost
                FROM (`tr_do_trx` as a) LEFT JOIN `tr_cost_trx` as b ON `b`.`trx_no` = `a`.`trx_no` 
										LEFT JOIN `sa_users` as c ON `c`.`rowID` = `a`.`user_created`
										LEFT JOIN `sa_cost` as d ON `d`.`rowID` = `b`.`cost_rowID`
                GROUP BY a.deleted, b.deleted, a.status, a.commission_no, `c`.`dep_rowID`, b.cost_rowID, d.descs
                HAVING `a`.`deleted` = 0 AND `b`.`deleted` = 0 AND `a`.`status` = 1 AND `a`.`commission_no` = '".$comm_no."' AND `a`.`date_verified` <= '".$until_date."' 
      				      AND `b`.`cost_rowID` != 2
                ORDER BY d.descs";
          
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_field_cost_by_comm_detail($comm_no,$until_date){
		$sql = "SELECT b.*, d.descs as cost_name, f.police_no
                FROM (`tr_do_trx` as a) LEFT JOIN `tr_cost_trx` as b ON `b`.`trx_no` = `a`.`trx_no` 
										LEFT JOIN `sa_users` as c ON `c`.`rowID` = `a`.`user_created`
										LEFT JOIN `sa_cost` as d ON `d`.`rowID` = `b`.`cost_rowID`
										LEFT JOIN `cb_cash_adv` as e ON `e`.`trx_no` = `a`.`trx_no`
										LEFT JOIN `sa_vehicle` as f ON `f`.`rowID` = `e`.`vehicle_rowID`
                WHERE `a`.`deleted` = 0 AND `b`.`deleted` = 0 AND `e`.`deleted` = 0 AND `a`.`status` = 1 AND `a`.`commission_no` = '".$comm_no."' AND `a`.`date_verified` <= '".$until_date."' 
      				      AND `b`.`cost_rowID` != 2
                ORDER BY `b`.`trx_no`";
          
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_field_cost_by_comm_detail_departement($comm_no,$until_date,$departement_id){
		$sql = "SELECT b.*, d.descs as cost_name, f.police_no
                FROM (`tr_do_trx` as a) LEFT JOIN `tr_cost_trx` as b ON `b`.`trx_no` = `a`.`trx_no` 
										LEFT JOIN `sa_users` as c ON `c`.`rowID` = `a`.`user_created`
										LEFT JOIN `sa_cost` as d ON `d`.`rowID` = `b`.`cost_rowID`
										LEFT JOIN `cb_cash_adv` as e ON `e`.`trx_no` = `a`.`trx_no`
										LEFT JOIN `sa_vehicle` as f ON `f`.`rowID` = `e`.`vehicle_rowID`
                WHERE `a`.`deleted` = 0 AND `b`.`deleted` = 0 AND `a`.`status` = 1 AND `a`.`commission_no` = '".$comm_no."' AND `a`.`date_verified` <= '".$until_date."' 
      				      AND `b`.`cost_rowID` != 2 AND `c`.`dep_rowID` = ".$departement_id."
                ORDER BY `b`.`trx_no`";
          
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
  
    function get_field_cost_by_comm_departement($comm_no,$until_date,$departement_id){
		$sql = "SELECT a.deleted, b.deleted, a.status, a.commission_no, `c`.`dep_rowID`, b.cost_rowID, d.descs, a.date_verified, SUM(b.trx_amt) as field_cost
                FROM (`tr_do_trx` as a) LEFT JOIN `tr_cost_trx` as b ON `b`.`trx_no` = `a`.`trx_no` 
										LEFT JOIN `sa_users` as c ON `c`.`rowID` = `a`.`user_created`
										LEFT JOIN `sa_cost` as d ON `d`.`rowID` = `b`.`cost_rowID`
                GROUP BY a.deleted, b.deleted, a.status, a.commission_no, `c`.`dep_rowID`, b.cost_rowID, d.descs
                HAVING `a`.`deleted` = 0 AND `b`.`deleted` = 0 AND `a`.`status` = 1 AND `a`.`commission_no` = '".$comm_no."' AND `a`.`date_verified` <= '".$until_date."' 
      				      AND `b`.`cost_rowID` != 2 AND `c`.`dep_rowID` = ".$departement_id."
                ORDER BY d.descs";
          
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_field_cost_cb_driver($from_date,$to_date){
		$sql = "SELECT a.deleted, b.deleted, a.date_created, `c`.`dep_rowID`, SUM(b.cg_amt) as field_cost
                FROM (`cb_trx_hdr` as a) LEFT JOIN `cb_trx_cg` as b ON `b`.`trx_no` = `a`.`trx_no` 
					                       LEFT JOIN `sa_users` as c ON `c`.`rowID`=`a`.`user_created`
					                       LEFT JOIN `sa_dep` as d ON `d`.`rowID`=`c`.`dep_rowID`
                WHERE `a`.`deleted` = 0 AND `b`.`deleted` = 0 AND a.payment_type = 'P' AND a.transaction_type = 'general' AND d.pool = 'yes'
			         AND a.manual_debtor_creditor_type = 'D' AND `a`.`date_created` BETWEEN '".$from_date."' AND '".$to_date."'";
          
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
			return $query->row();
		} else{
			return NULL;
		}
    }
    
    function get_field_cost_cb_other($from_date,$to_date){
		$sql = "SELECT a.deleted, b.deleted, a.date_created, `c`.`dep_rowID`, SUM(b.cg_amt) as field_cost
                FROM (`cb_trx_hdr` as a) LEFT JOIN `cb_trx_cg` as b ON `b`.`trx_no` = `a`.`trx_no` 
					                       LEFT JOIN `sa_users` as c ON `c`.`rowID`=`a`.`user_created`
					                       LEFT JOIN `sa_dep` as d ON `d`.`rowID`=`c`.`dep_rowID`
                WHERE `a`.`deleted` = 0 AND `b`.`deleted` = 0 AND a.payment_type = 'P' AND a.transaction_type = 'general' AND d.pool = 'yes'
			         AND a.manual_debtor_creditor_type = 'O' AND `a`.`date_created` BETWEEN '".$from_date."' AND '".$to_date."'";
          
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
			return $query->row();
		} else{
			return NULL;
		}
    }
    
    function get_field_cost_cb_driver_detail($from_date,$to_date){
		$sql = "SELECT a.*, b.cg_amt, e.debtor_name
                FROM (`cb_trx_hdr` as a) LEFT JOIN `cb_trx_cg` as b ON `b`.`trx_no` = `a`.`trx_no` 
					                       LEFT JOIN `sa_users` as c ON `c`.`rowID`=`a`.`user_created`
					                       LEFT JOIN `sa_dep` as d ON `d`.`rowID`=`c`.`dep_rowID`
                                           LEFT JOIN sa_debtor as e ON e.rowID = a.debtor_creditor_rowID 
                WHERE `a`.`deleted` = 0 AND `b`.`deleted` = 0 AND a.payment_type = 'P' AND a.transaction_type = 'general' AND d.pool = 'yes'
			         AND a.manual_debtor_creditor_type = 'D' AND `a`.`date_created` BETWEEN '".$from_date."' AND '".$to_date."'
                ORDER BY a.trx_no";
          
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_field_cost_cb_driver_detail_departement($from_date,$to_date,$departement_id){
		$sql = "SELECT a.*, b.cg_amt, e.debtor_name
                FROM (`cb_trx_hdr` as a) LEFT JOIN `cb_trx_cg` as b ON `b`.`trx_no` = `a`.`trx_no` 
					                       LEFT JOIN `sa_users` as c ON `c`.`rowID`=`a`.`user_created`
					                       LEFT JOIN `sa_dep` as d ON `d`.`rowID`=`c`.`dep_rowID`
                                           LEFT JOIN sa_debtor as e ON e.rowID = a.debtor_creditor_rowID 
                WHERE `a`.`deleted` = 0 AND `b`.`deleted` = 0 AND a.payment_type = 'P' AND a.transaction_type = 'general' AND d.pool = 'yes'
			         AND a.manual_debtor_creditor_type = 'D' AND `a`.`date_created` BETWEEN '".$from_date."' AND '".$to_date."' AND `c`.`dep_rowID` = ".$departement_id."
                ORDER BY a.trx_no";
          
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_field_cost_cb_other_detail($from_date,$to_date){
		$sql = "SELECT a.*, b.cg_amt
                FROM (`cb_trx_hdr` as a) LEFT JOIN `cb_trx_cg` as b ON `b`.`trx_no` = `a`.`trx_no` 
					                       LEFT JOIN `sa_users` as c ON `c`.`rowID`=`a`.`user_created`
					                       LEFT JOIN `sa_dep` as d ON `d`.`rowID`=`c`.`dep_rowID`
                WHERE `a`.`deleted` = 0 AND `b`.`deleted` = 0 AND a.payment_type = 'P' AND a.transaction_type = 'general' AND d.pool = 'yes'
			         AND a.manual_debtor_creditor_type = 'O' AND `a`.`date_created` BETWEEN '".$from_date."' AND '".$to_date."'
                ORDER BY a.trx_no";
          
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_field_cost_cb_other_detail_departement($from_date,$to_date,$departement_id){
		$sql = "SELECT a.*, b.cg_amt
                FROM (`cb_trx_hdr` as a) LEFT JOIN `cb_trx_cg` as b ON `b`.`trx_no` = `a`.`trx_no` 
					                       LEFT JOIN `sa_users` as c ON `c`.`rowID`=`a`.`user_created`
					                       LEFT JOIN `sa_dep` as d ON `d`.`rowID`=`c`.`dep_rowID`
                WHERE `a`.`deleted` = 0 AND `b`.`deleted` = 0 AND a.payment_type = 'P' AND a.transaction_type = 'general' AND d.pool = 'yes'
			         AND a.manual_debtor_creditor_type = 'O' AND `a`.`date_created` BETWEEN '".$from_date."' AND '".$to_date."' AND `c`.`dep_rowID` = ".$departement_id."
                ORDER BY a.trx_no";
          
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_field_cost_cb_driver_departement($from_date,$to_date,$departement_id){
		$sql = "SELECT a.deleted, b.deleted, a.date_created, `c`.`dep_rowID`, SUM(b.cg_amt) as field_cost
                FROM (`cb_trx_hdr` as a) LEFT JOIN `cb_trx_cg` as b ON `b`.`trx_no` = `a`.`trx_no` 
					                       LEFT JOIN `sa_users` as c ON `c`.`rowID`=`a`.`user_created`
					                       LEFT JOIN `sa_dep` as d ON `d`.`rowID`=`c`.`dep_rowID`
                WHERE `a`.`deleted` = 0 AND `b`.`deleted` = 0 AND a.payment_type = 'P' AND a.transaction_type = 'general' AND d.pool = 'yes'
			         AND a.manual_debtor_creditor_type = 'D' AND `a`.`date_created` BETWEEN '".$from_date."' AND '".$to_date."' AND `c`.`dep_rowID` = ".$departement_id;
          
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
			return $query->row();
		} else{
			return NULL;
		}
    }
    
    function get_field_cost_cb_other_departement($from_date,$to_date,$departement_id){
		$sql = "SELECT a.deleted, b.deleted, a.date_created, `c`.`dep_rowID`, SUM(b.cg_amt) as field_cost
                FROM (`cb_trx_hdr` as a) LEFT JOIN `cb_trx_cg` as b ON `b`.`trx_no` = `a`.`trx_no` 
					                       LEFT JOIN `sa_users` as c ON `c`.`rowID`=`a`.`user_created`
					                       LEFT JOIN `sa_dep` as d ON `d`.`rowID`=`c`.`dep_rowID`
                WHERE `a`.`deleted` = 0 AND `b`.`deleted` = 0 AND a.payment_type = 'P' AND a.transaction_type = 'general' AND d.pool = 'yes'
			         AND a.manual_debtor_creditor_type = 'O' AND `a`.`date_created` BETWEEN '".$from_date."' AND '".$to_date."' AND `c`.`dep_rowID` = ".$departement_id;
          
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
			return $query->row();
		} else{
			return NULL;
		}
    }
  
    function get_do_pok_by_police_no_comm($police_no,$comm_no,$until_date){
		$sql = "SELECT a.deleted, b.deleted, d.deleted, a.status, a.commission_no, a.date_verified, c.police_no, c.vehicle_type, e.trip_condition, COUNT(e.trip_condition) as pok
                FROM (`tr_do_trx` as a) LEFT JOIN `cb_cash_adv` as b ON `b`.`trx_no` = `a`.`trx_no` 
                                        LEFT JOIN `sa_vehicle` as c ON `c`.`rowID`=`b`.`vehicle_rowID`
                                        LEFT JOIN `tr_jo_trx_hdr` as d ON `d`.`jo_no` = `a`.`jo_no` 
                                        LEFT JOIN `sa_fare_trip_hdr` as e ON `e`.`rowID` = `d`.`fare_trip_rowID`
                GROUP BY a.deleted, b.deleted, d.deleted, a.status, a.commission_no, c.police_no, c.vehicle_type, e.trip_condition
                HAVING `a`.`deleted` = 0 AND `b`.`deleted` = 0 AND `d`.`deleted` = 0 AND `a`.`status` = 1 AND e.trip_condition = 'pok' AND c.police_no = '".$police_no."' AND `a`.`commission_no` = '".$comm_no."' AND `a`.`date_verified` <= '".$until_date."' 
                ORDER BY `c`.`police_no` asc";
          
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
			return $query->row();
		} else{
			return NULL;
		}
    }
    
    function get_do_point_by_police_no_comm($police_no,$comm_no,$until_date){
		$sql = "SELECT a.deleted, b.deleted, d.deleted, a.status, a.commission_no, a.date_verified, c.police_no, c.vehicle_type, e.trip_condition, SUM(e.poin) as point
                FROM (`tr_do_trx` as a) LEFT JOIN `cb_cash_adv` as b ON `b`.`trx_no` = `a`.`trx_no` 
                                        LEFT JOIN `sa_vehicle` as c ON `c`.`rowID`=`b`.`vehicle_rowID`
                                        LEFT JOIN `tr_jo_trx_hdr` as d ON `d`.`jo_no` = `a`.`jo_no` 
                                        LEFT JOIN `sa_fare_trip_hdr` as e ON `e`.`rowID` = `d`.`fare_trip_rowID`
                GROUP BY a.deleted, b.deleted, d.deleted, a.status, a.commission_no, c.police_no, c.vehicle_type, e.trip_condition
                HAVING `a`.`deleted` = 0 AND `b`.`deleted` = 0 AND `d`.`deleted` = 0 AND `a`.`status` = 1 AND c.police_no = '".$police_no."' AND `a`.`commission_no` = '".$comm_no."' AND `a`.`date_verified` <= '".$until_date."' 
                ORDER BY `c`.`police_no` asc";
          
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
			return $query->row();
		} else{
			return NULL;
		}
    }
    
    function get_do_jo_by_comm($police_no,$comm_no,$until_date){
		$sql = "SELECT a.deleted, b.deleted, d.deleted, a.status, a.commission_no, a.date_verified, c.police_no, c.vehicle_type, a.do_no, a.jo_no, a.received_weight, d.wholesale, d.price_amount
                FROM (`tr_do_trx` as a) LEFT JOIN `cb_cash_adv` as b ON `b`.`trx_no` = `a`.`trx_no` 
                                    	LEFT JOIN `sa_vehicle` as c ON `c`.`rowID`=`b`.`vehicle_rowID`
                                    	LEFT JOIN `tr_jo_trx_hdr` as d ON `d`.`jo_no` = `a`.`jo_no` 
                WHERE `a`.`deleted` = 0 AND `b`.`deleted` = 0 AND `d`.`deleted` = 0 AND `a`.`status` = 1 AND c.police_no = '".$police_no."' AND `a`.`commission_no` = '".$comm_no."' AND `a`.`date_verified` <= '".$until_date."' 
                ORDER BY `c`.`police_no` asc";
          
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_all_commission_by_vehicle($comm_no,$until_date){
		$sql = "SELECT a.deleted, b.deleted, a.status, a.commission_no, a.date_verified, c.police_no, c.vehicle_type, SUM(a.komisi_kernet) as amount, COUNT(a.do_no) as ritase
                FROM (`tr_do_trx` as a) LEFT JOIN `cb_cash_adv` as b ON `b`.`trx_no` = `a`.`trx_no` 
                                        LEFT JOIN `sa_vehicle` as c ON `c`.`rowID`=`b`.`vehicle_rowID` 
                GROUP BY a.deleted, b.deleted, a.status, a.commission_no, c.police_no, c.vehicle_type
                HAVING `a`.`deleted` = 0 AND `b`.`deleted` = 0 AND `a`.`status` = 1 AND `a`.`commission_no` = '".$comm_no."' AND `a`.`date_verified` <= '".$until_date."' 
                ORDER BY `c`.`police_no` asc";
          
        $query=$this->db->query($sql);
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_data_table($table){
        $this->db->select('*');
        $this->db->from($table);
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
    
    function get_data_header_cb($trx_no)
    {
        $sql = "SELECT * FROM cb_trx_hdr
                WHERE deleted = 0 AND trx_no = '$trx_no'
                ORDER BY rowID";
        
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    function get_data_do_by_date($until_date){
		$this->db->select("a.rowID,a.trx_no,b.employee_driver_rowID,c.debtor_name,a.komisi_supir,a.komisi_kernet,a.deposit,a.jo_no,a.do_no",false);
		$this->db->from('tr_do_trx as a');
		$this->db->join('cb_cash_adv as b', 'b.trx_no = a.trx_no','left');
		$this->db->join('sa_debtor as c', 'c.rowID = b.employee_driver_rowID','left');
        $this->db->where('a.deleted', 0);
        $this->db->where('b.deleted', 0);
        $this->db->where('c.deleted', 0);
        $this->db->where('a.status', 1);
        $this->db->where('a.commission_no', '');
        $this->db->where('a.date_verified <= ', $until_date);
        $this->db->order_by('a.rowID','asc');

        $query=$this->db->get();
        
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
        
    }
    
    function get_group_temp_commission($table){
        $sql = 'SELECT debtor_rowID	, debtor_name, jo_no, do_no, sum(komisi_supir) as komisi_supir, 
                    sum(komisi_kernet) as komisi_kernet, sum(amount_deposit) as amount_deposit, sum(amount_loan) as amount_loan, count(do_no) as ritase
                FROM '.$table.'
                GROUP BY debtor_rowID 
                ORDER BY debtor_name asc';

        $query=$this->db->query($sql);        
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_temp_commission($table,$debtor_id){
        $sql = 'SELECT a.*, d.advance_no, f.destination_name as from_name, g.destination_name as to_name, h.advance_name 
                FROM '.$table.' as a LEFT JOIN tr_do_trx as b ON a.do_trx_rowID = b.rowID
                                     LEFT JOIN cb_cash_adv_alloc as c ON b.trx_no = c.alloc_no
                                     LEFT JOIN cb_cash_adv as d ON c.cb_cash_adv_no = d.advance_no
                                     LEFT JOIN tr_jo_trx_hdr as e ON a.jo_no = e.jo_no
                                     LEFT JOIN sa_destination as f ON e.destination_from_rowID = f.rowID
                                     LEFT JOIN sa_destination as g ON e.destination_to_rowID = g.rowID 
                                     LEFT JOIN sa_advance_type as h ON d.advance_type_rowID = h.rowID                                    
                WHERE a.debtor_rowID = '.$debtor_id.' AND b.deleted = 0 AND c.deleted = 0 AND d.deleted = 0
                ORDER BY d.advance_no asc';

        $query=$this->db->query($sql);        
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_max_loan($range){
        $sql = "SELECT loan_amount 
                FROM sa_loan_parameter 
                WHERE ".$range." BETWEEN comm_amount_from and comm_amount_to";
        
        $query = $this->db->query($sql);        
        if ($query->num_rows() > 0){
			return $query->row()->loan_amount;
		} 
        else{
			return null;
		}
        
    }
    
    function get_max_loan_amount(){
        $sql = "SELECT MAX(loan_amount) as loan_amount
                FROM sa_loan_parameter";
        
        $query = $this->db->query($sql);        
        if ($query->num_rows() > 0){
			return $query->row()->loan_amount;
		} 
        else{
			return 0;
		}
        
    }
    
    function get_data_do_verified($date_verified){
        $sql = "SELECT a.trx_no, c.debtor_name, a.komisi_supir, a.komisi_kernet, a.deposit, a.jo_no, a.do_no, `a`.`date_verified`, 
                        d.fare_trip_cd as fare_trip_code, e.destination_name as from_name, f.destination_name as to_name
                FROM (`tr_do_trx` as a) LEFT JOIN `cb_cash_adv` as b ON `b`.`trx_no` = `a`.`trx_no` 
                                        LEFT JOIN `sa_debtor` as c ON `c`.`rowID` = `b`.`employee_driver_rowID` 
                                        LEFT JOIN `tr_jo_trx_hdr` as jo ON jo.jo_no = a.jo_no
                                        LEFT JOIN `sa_fare_trip_hdr` as d ON `d`.`rowID` = jo.fare_trip_rowID
                                        LEFT JOIN `sa_destination` as e ON `e`.`rowID` = `d`.`destination_from_rowID` 
                                        LEFT JOIN `sa_destination` as f ON `f`.`rowID` = `d`.`destination_to_rowID` 
                WHERE `a`.`deleted` = 0 AND `b`.`deleted` = 0 AND `c`.`deleted` = 0 AND `a`.`status` = 1 AND `a`.`commission_no` = '' AND `a`.`date_verified` <= '".$date_verified."' 
                ORDER BY `a`.`date_verified`, c.debtor_name, a.do_no asc";
        
        $query = $this->db->query($sql);        
        if ($query->num_rows() > 0){
			return $query->result();
		} 
        else{
			return NULL;
		}
    }
    
    
    function get_data_advance_loan($debtor_id){
        $this->db->select('a.advance_no, a.advance_date, b.advance_name, a.description, a.advance_balance');
        $this->db->from('cb_cash_adv as a');
        $this->db->join('sa_advance_type as b','a.advance_type_rowID = b.rowID','left');
        $this->db->where('a.deleted',0);
        $this->db->where('a.employee_driver_rowID',$debtor_id);
        $this->db->where('a.advance_type_rowID',4);
        $this->db->where('a.advance_balance > ',0);
        $this->db->order_by('a.rowID','asc');
        
        $query = $this->db->get();        
        if ($query->num_rows() > 0){
			return $query->result();
		} 
        else{
			return NULL;
		}
        
    }
    
    function get_data_advance($debtor_id){
        $this->db->select('a.advance_no, a.advance_date, b.advance_name, a.description, a.advance_balance');
        $this->db->from('cb_cash_adv as a');
        $this->db->join('sa_advance_type as b','a.advance_type_rowID = b.rowID','left');
        $this->db->where('a.deleted',0);
        $this->db->where('a.employee_driver_rowID',$debtor_id);
        $this->db->where('a.advance_type_rowID != ',4);
        $this->db->where('a.advance_balance > ',0);
        $this->db->where('a.advance_date BETWEEN "'.date('Y-m-d',strtotime('-30 days')).'" AND "'.date('Y-m-d').'"','');
        $this->db->order_by('a.rowID','asc');
        
        $query = $this->db->get();        
        if ($query->num_rows() > 0){
			return $query->result();
		} 
        else{
			return NULL;
		}
        
    }
    
    function get_data_advance_loan_by_debtor_id($debtor_id){
        $this->db->select('*');
        $this->db->from('cb_cash_adv');
        $this->db->where('deleted',0);
        $this->db->where('employee_driver_rowID',$debtor_id);
        $this->db->where('advance_type_rowID',4);
        $this->db->where('advance_balance > ',0);
        $this->db->order_by('advance_no','asc');
        
        $query = $this->db->get();        
        if ($query->num_rows() > 0){
			return $query->result();
		} 
        else{
			return NULL;
		}
        
    }
    
    function get_data_temp_loan_by_debtor_id($table,$debtor_id){
        $this->db->select('a.*, b.advance_date, b.description, c.advance_name');
        $this->db->from($table.' as a');
        $this->db->join('cb_cash_adv as b','a.advance_no = b.advance_no');
        $this->db->join('sa_advance_type as c','b.advance_type_rowID = c.rowID');
        $this->db->where('a.debtor_rowID', $debtor_id);
        $this->db->where('b.deleted',0);
        $this->db->order_by('a.rowID','asc');
        $query = $this->db->get();        
        if ($query->num_rows() > 0){
			return $query->result();
		} 
        else{
			return NULL;
		}
    }
    
    function get_data_temp_loan($table,$debtor_id,$advance_no){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('debtor_rowID', $debtor_id);
        $this->db->where('advance_no', $advance_no);
        $query = $this->db->get();        
        if ($query->num_rows() > 0){
			return $query->result();
		} 
        else{
			return NULL;
		}
    }
    
    function get_all_driver(){
        $this->db->select('*');
        $this->db->from('sa_debtor');
        $this->db->where('type','D');
        $this->db->where('deleted',0);
        $this->db->order_by('debtor_name','asc');
        $query=$this->db->get();
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_all_driver_by_limit($limit,$start){
        $this->db->select('*');
        $this->db->from('sa_debtor');
        $this->db->where('type','D');
        $this->db->where('deleted',0);
        $this->db->order_by('debtor_name','asc');
        $this->db->limit($limit,$start);
        $query=$this->db->get();
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_all_departement(){
        $this->db->select('*');
        $this->db->from('sa_dep');
        $this->db->where('pool','yes');
        $this->db->where('deleted',0);
        $this->db->order_by('dep_name','asc');
        $query=$this->db->get();
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    public function select_max_by_field($field)
	{
		$this->db->select_max($field);
		$query = $this->db->get('tr_commission_trx');
		if($query->num_rows()>0){
            foreach($query->result() as $q){
				return ((int)$q->$field);
			}
		}

	}
    
    public function select_max_deposit_by_field($field)
	{
		$this->db->select_max($field);
		$query = $this->db->get('tr_deposit_trx');
		if($query->num_rows()>0){
            foreach($query->result() as $q){
				return ((int)$q->$field);
			}
		}

	}
    
    function insert_data($table,$data){
        $result=$this->db->insert($table, $data);
        if ($result){
            return true;
        }
        else{
            return false;
        }
    }
    
    function update_data($table,$data,$rowid){
        $this->db->where('rowID',$rowid);
        $result=$this->db->update($table, $data);
        if ($result){
            return true;
        }
        else{
            return false;
        }
    }
    
    function drop_table($table){
        $sql = 'DROP TABLE '.$table;

        $query=$this->db->query($sql);    

        return $query;
    }

}

/* End of file model.php */