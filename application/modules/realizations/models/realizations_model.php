<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Realizations_model extends CI_Model
{
   
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function simpan_realization_hdr($sa_spec_prefix, $alloc_code, $alloc_no, $dataPost, $get_data_header)
    {
        $realization_hdr_data = array(
            'prefix' => $sa_spec_prefix,
            'year' => date('Y', strtotime($dataPost['date'])),
            'month' => date('m', strtotime($dataPost['date'])),
            'code' => $alloc_code,
            'row_no' => 1,
            'alloc_no' => $alloc_no,
            'alloc_date' => date('Y-m-d', strtotime($dataPost['date'])),
            'descs' => 'REALISASI ATAS ' . $dataPost['cash_advance_type'] . ' NO. ' . $dataPost['cash_advance_no'],
            'alloc_amt' => str_replace('.', '', $dataPost['cash_advance_alloc']),
            'alloc_mode' => 'R',
            'cb_cash_adv_no' => $dataPost['cash_advance_no'],
            'cb_cash_adv_prefix' => $dataPost['prefix'],
            'cb_cash_adv_year' => $dataPost['year'],
            'cb_cash_adv_month' => $dataPost['month'],
            'cb_cash_adv_code' => $dataPost['code'],
            'doc_sj' => empty($dataPost['doc_sj']) ? 'No' : 'Yes',
            'doc_st' => empty($dataPost['doc_st']) ? 'No' : 'Yes',
            'doc_sm' => empty($dataPost['doc_sm']) ? 'No' : 'Yes',
            'doc_sr' => empty($dataPost['doc_sr']) ? 'No' : 'Yes',
            'status' => empty($dataPost['cancel_load']) ? 0 : $dataPost['cancel_load'],
            'status_external' => $dataPost['status_external'],
            'reference_pok_no_1' => $dataPost['reference_pok_no_1'],
            'reference_pok_no_2' => $dataPost['reference_pok_no_2'],
            'user_created'=>$get_data_header->user_created,
            'date_created'=>$get_data_header->date_created,
            'time_created'=>$get_data_header->time_created,
			'user_modified'=>$this->session->userdata('user_rowID'),
			'date_modified'=>date('Y-m-d'),
			'time_modified'=>date('H:i:s')
        );
        $result = $this->db->insert('cb_cash_adv_alloc', $realization_hdr_data);
        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }

    function simpan_realization_detail_cost($sa_spec_prefix, $alloc_code, $x, $alloc_no,
        $dataPost, $detailCost = array(), $get_data_header)
    {
        $cost_data[] = array(
            'prefix' => $sa_spec_prefix,
            'year' => date('Y', strtotime($dataPost['date'])),
            'month' => date('m', strtotime($dataPost['date'])),
            'code' => $alloc_code,
            'row_no' => $x,
            'trx_no' => $alloc_no,
            'trx_date' => date('Y-m-d', strtotime($dataPost['date'])),
            'cost_rowID' => $detailCost['cost_rowID'],
            'trx_amt' => str_replace('.', '', (!empty($detailCost['amountCost'])) ? $detailCost['amountCost'] : 0),
            'descs' => $detailCost['descs'],
            'user_created'=>$get_data_header->user_created,
            'date_created'=>$get_data_header->date_created,
            'time_created'=>$get_data_header->time_created,
			'user_modified'=>$this->session->userdata('user_rowID'),
			'date_modified'=>date('Y-m-d'),
			'time_modified'=>date('H:i:s')
        );
        $result = $this->db->insert_batch('tr_cost_trx', $cost_data);
        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }

    function simpan_gl_header_doc_realization($sa_spec_prefix, $new_gl_coa_code, $gl_coa_no, $cash_out_prefix_cd, $cash_advance_no, $advance_name, 
            $debtor_name, $new_cash_advance_code, $dataPost, $get_data_header)
    {
        
        $total_amount = str_replace('.', '', $dataPost['cash_advance_alloc']);
        $gl_trx_hdr_data = array(
            'prefix' => $sa_spec_prefix,
            'year' => date('Y', strtotime($dataPost['date'])),
            'month' => date('m', strtotime($dataPost['date'])),
            'code' => $new_gl_coa_code,
            'journal_no' => $gl_coa_no,
            'journal_date' => date('Y-m-d', strtotime($dataPost['date'])),
            'journal_type' => 'realization',
            'descs' => 'REALISASI ATAS ' . $dataPost['cash_advance_type'] . ' NO. ' . $dataPost['cash_advance_no'],
            'trx_amt' => $total_amount,
            'ref_prefix' => $cash_out_prefix_cd,
            'ref_year' => date('Y', strtotime($dataPost['date'])),
            'ref_month' => date('m', strtotime($dataPost['date'])),
            'ref_code' => $new_cash_advance_code,
            'ref_no' => $cash_advance_no,
            'ref_date' => date('Y-m-d', strtotime($dataPost['date'])),
            'user_created'=>$get_data_header->user_created,
            'date_created'=>$get_data_header->date_created,
            'time_created'=>$get_data_header->time_created,
			'user_modified'=>$this->session->userdata('user_rowID'),
			'date_modified'=>date('Y-m-d'),
			'time_modified'=>date('H:i:s')
        );
            
        $result = $this->db->insert('gl_trx_hdr', $gl_trx_hdr_data);
        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }

    function simpan_gl_detail_doc_debet_realization($sa_spec_prefix, $new_gl_coa_code, $gl_coa_no, $cash_out_prefix_cd, $coaRowIDDebet, $advance_name,
        $debtor_name, $new_cash_advance_code, $cash_advance_no, $detailDebet, $dataPost, $get_data_header)
    {   
        $gl_trx_dtl_d_data = array(
            'gl_trx_hdr_prefix' => $sa_spec_prefix,
            'gl_trx_hdr_year' => date('Y', strtotime($dataPost['date'])),
            'gl_trx_hdr_month' => date('m', strtotime($dataPost['date'])),
            'gl_trx_hdr_code' => $new_gl_coa_code,
            'row_no' => 1,
            'gl_trx_hdr_journal_no' => $gl_coa_no,
            'gl_trx_hdr_journal_date' => date('Y-m-d', strtotime($dataPost['date'])),
            'coa_rowID' => $coaRowIDDebet,
            'descs' => 'REALISASI ATAS ' . $dataPost['cash_advance_type'] . ' NO. ' . $dataPost['cash_advance_no'],
            'trx_amt' => str_replace('.', '', $detailDebet['amountCost']),
            'dep_rowID' => $this->session->userdata('dep_rowID'),
            'debtor_creditor_rowID' => $dataPost['driver'],
            'gl_trx_hdr_ref_prefix' => $cash_out_prefix_cd,
            'gl_trx_hdr_ref_year' => date('Y', strtotime($dataPost['date'])),
            'gl_trx_hdr_ref_month' => date('m', strtotime($dataPost['date'])),
            'gl_trx_hdr_ref_code' => $new_cash_advance_code,
            'gl_trx_hdr_ref_no' => $cash_advance_no,
            'gl_trx_hdr_ref_date' => date('Y-m-d', strtotime($dataPost['date'])),
            'modul' => 'CB',
            'cash_flow' => 'Y',
            'base_amt' => 0,
            'tax_no' => '',
            'user_created'=>$get_data_header->user_created,
            'date_created'=>$get_data_header->date_created,
            'time_created'=>$get_data_header->time_created,
			'user_modified'=>$this->session->userdata('user_rowID'),
			'date_modified'=>date('Y-m-d'),
			'time_modified'=>date('H:i:s')
        );
        
        $result = $this->db->insert('gl_trx_dtl', $gl_trx_dtl_d_data);
        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
        
    }
    
    function simpan_gl_detail_doc_kredit_realization($sa_spec_prefix, $new_gl_coa_code, $gl_coa_no, $receiveable_rowID, $advance_name, $debtor_name,
        $cash_out_prefix_cd, $new_cash_advance_code, $cash_advance_no, $dataPost, $get_data_header)
    {
        $total_amount = str_replace('.', '', $dataPost['cash_advance_alloc']);
            
        $gl_trx_dtl_k_data = array(
            'gl_trx_hdr_prefix' => $sa_spec_prefix,
            'gl_trx_hdr_year' => date('Y', strtotime($dataPost['date'])),
            'gl_trx_hdr_month' => date('m', strtotime($dataPost['date'])),
            'gl_trx_hdr_code' => $new_gl_coa_code,
            'row_no' => 2,
            'gl_trx_hdr_journal_no' => $gl_coa_no,
            'gl_trx_hdr_journal_date' => date('Y-m-d', strtotime($dataPost['date'])),
            'coa_rowID' => $receiveable_rowID,
            'descs' => 'REALISASI ATAS ' . $dataPost['cash_advance_type'] . ' NO. ' . $dataPost['cash_advance_no'],
            'trx_amt' => $total_amount * -1,
            'dep_rowID' => $this->session->userdata('dep_rowID'),
            'debtor_creditor_rowID' => $dataPost['driver'],
            'gl_trx_hdr_ref_prefix' => $cash_out_prefix_cd,
            'gl_trx_hdr_ref_year' => date('Y', strtotime($dataPost['date'])),
            'gl_trx_hdr_ref_month' => date('m', strtotime($dataPost['date'])),
            'gl_trx_hdr_ref_code' => $new_cash_advance_code,
            'gl_trx_hdr_ref_no' => $cash_advance_no,
            'gl_trx_hdr_ref_date' => date('Y-m-d', strtotime($dataPost['date'])),
            'modul' => 'CB',
            'cash_flow' => 'Y',
            'base_amt' => 0,
            'tax_no' => '',
            'user_created'=>$get_data_header->user_created,
            'date_created'=>$get_data_header->date_created,
            'time_created'=>$get_data_header->time_created,
			'user_modified'=>$this->session->userdata('user_rowID'),
			'date_modified'=>date('Y-m-d'),
			'time_modified'=>date('H:i:s')
        );
        
        $result = $this->db->insert('gl_trx_dtl', $gl_trx_dtl_k_data);
        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }
    
    function simpan_gl_detail_doc_kredit_sisa_realization($sa_spec_prefix, $new_gl_coa_code, $gl_coa_no, $receiveable_rowID, $advance_name, $debtor_name,
        $cash_out_prefix_cd, $new_cash_advance_code, $cash_advance_no, $total_amount, $dataPost, $get_data_header)
    {     
        $gl_trx_dtl_k_data = array(
            'gl_trx_hdr_prefix' => $sa_spec_prefix,
            'gl_trx_hdr_year' => date('Y', strtotime($dataPost['date'])),
            'gl_trx_hdr_month' => date('m', strtotime($dataPost['date'])),
            'gl_trx_hdr_code' => $new_gl_coa_code,
            'row_no' => 2,
            'gl_trx_hdr_journal_no' => $gl_coa_no,
            'gl_trx_hdr_journal_date' => date('Y-m-d', strtotime($dataPost['date'])),
            'coa_rowID' => $receiveable_rowID,
            'descs' => 'REALISASI ATAS ' . $dataPost['cash_advance_type'] . ' NO. ' . $dataPost['cash_advance_no'],
            'trx_amt' => $total_amount * -1,
            'dep_rowID' => $this->session->userdata('dep_rowID'),
            'debtor_creditor_rowID' => $dataPost['driver'],
            'gl_trx_hdr_ref_prefix' => $cash_out_prefix_cd,
            'gl_trx_hdr_ref_year' => date('Y', strtotime($dataPost['date'])),
            'gl_trx_hdr_ref_month' => date('m', strtotime($dataPost['date'])),
            'gl_trx_hdr_ref_code' => $new_cash_advance_code,
            'gl_trx_hdr_ref_no' => $cash_advance_no,
            'gl_trx_hdr_ref_date' => date('Y-m-d', strtotime($dataPost['date'])),
            'modul' => 'CB',
            'cash_flow' => 'Y',
            'base_amt' => 0,
            'tax_no' => '',
            'user_created'=>$get_data_header->user_created,
            'date_created'=>$get_data_header->date_created,
            'time_created'=>$get_data_header->time_created,
			'user_modified'=>$this->session->userdata('user_rowID'),
			'date_modified'=>date('Y-m-d'),
			'time_modified'=>date('H:i:s')
        );
        
        $result = $this->db->insert('gl_trx_dtl', $gl_trx_dtl_k_data);
        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }
    
    function simpan_data_do($sa_spec_prefix, $alloc_code, $alloc_no, $dataPost, $detDO = array(), $get_data_header, $condition_commission)
    {
        $count_container = 0;
        $container_size = '';
		if(!empty($detDO['ContType'])){
			if($detDO['ContType'] == '20' || $detDO['ContType'] == '40' || $detDO['ContType'] == '45'){
				$count_container = 1;
				$container_size = $detDO['ContType'];
			}
			else if($detDO['ContType'] == '220'){
				$count_container = 2;
				$container_size = 20;
			}
        }
        
		$komisi_supir = $detDO['komisi_supir'];
        $komisi_kernet = $detDO['komisi_kernet'];
        if($condition_commission >= 2){
            $komisi_supir = $komisi_supir / 2;
            $komisi_kernet = $komisi_kernet / 2;
        }
        
        $data = array(
            'prefix' => $sa_spec_prefix,
            'year' => date('Y', strtotime($dataPost['date'])),
            'month' => date('m', strtotime($dataPost['date'])),
            'code' => $alloc_code,
            'trx_no' => $alloc_no,
            'jo_no' => $detDO['do_jo_no'],
            'tr_jo_trx_hdr_year' => $detDO['jo_year'],
            'tr_jo_trx_hdr_month' => $detDO['jo_month'],
            'tr_jo_trx_hdr_code' => $detDO['jo_code'],
            'do_no' => $detDO['do_no'],
            'komisi_supir' => $komisi_supir,
            'komisi_kernet' => $komisi_kernet,
            'deposit' => $detDO['deposit'],
            'count_container' => $count_container,
            'container_size' => $container_size,
            'container_no' => empty($detDO['container_no']) ? '' : $detDO['container_no'],
            'do_date' => date('Y-m-d', strtotime($detDO['do_date'])),
            'deliver_date' => date('Y-m-d', strtotime($detDO['do_date'])),
            'deliver_weight' => $detDO['do_weight'],
            'received_date' => date('Y-m-d', strtotime($detDO['received_date'])),
            'received_weight' => $detDO['received_weight'],
            'status' => 0,
            'user_created'=>$get_data_header->user_created,
            'date_created'=>$get_data_header->date_created,
            'time_created'=>$get_data_header->time_created,
			'user_modified'=>$this->session->userdata('user_rowID'),
			'date_modified'=>date('Y-m-d'),
			'time_modified'=>date('H:i:s')
        );
        $result = $this->db->insert('tr_do_trx', $data);
        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }

    function update_cash_advance($alloc_no,$dataPost)
    {
        $this->db->set('advance_allocation', str_replace('.', '', $dataPost['cash_advance_alloc']));
        $this->db->set('advance_balance', str_replace('.', '', $dataPost['cash_advance_amt']) - str_replace('.', '', $dataPost['cash_advance_alloc']));
        $this->db->set('trx_no', $alloc_no);
        $this->db->set('user_modified', $this->session->userdata('user_rowID'), false);
        $this->db->set('date_modified', date('Y-m-d'));
        $this->db->set('time_modified', date('H:i:s'));
        $this->db->where('deleted', 0);
        $this->db->where('prefix', $dataPost['prefix']);
        $this->db->where('year', $dataPost['year']);
        $this->db->where('month', $dataPost['month']);
        $this->db->where('code', $dataPost['code']);
        $result = $this->db->update('cb_cash_adv');

        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }
    
    function update_cash_advance_delete($advance_no,$advance_allocation)
    {
        $sql = "UPDATE cb_cash_adv 
                SET trx_no = '', advance_allocation = advance_allocation - ".$advance_allocation.", advance_balance = advance_balance + ".$advance_allocation.",
                    user_modified = '".$this->session->userdata('user_rowID')."', date_modified = '".date('Y-m-d')."', time_modified = '".date('H:i:s')."'
                WHERE deleted = 0 AND advance_no = '".$advance_no."'";
        
        $result = $this->db->query($sql);

        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }
    
    function update_cash_advance_refund_delete($advance_no,$advance_allocation)
    {
        $sql = "UPDATE cb_cash_adv 
                SET trx_no = '', advance_allocation = advance_allocation + ".$advance_allocation.", advance_balance = advance_balance - ".$advance_allocation.",
                    user_modified = '".$this->session->userdata('user_rowID')."', date_modified = '".date('Y-m-d')."', time_modified = '".date('H:i:s')."'
                WHERE deleted = 0 AND advance_no = '".$advance_no."'";
        
        $result = $this->db->query($sql);

        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }
    
    function delete_cash_advance_alloc($alloc_no)
    {
        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_rowID'), false);
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));
        $this->db->where('deleted', 0);
        $this->db->where('alloc_no', $alloc_no);
        $result = $this->db->update('cb_cash_adv_alloc');

        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }
    
    function delete_cost($alloc_no)
    {
        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_rowID'), false);
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));
        $this->db->where('deleted', 0);
        $this->db->where('trx_no', $alloc_no);
        $result = $this->db->update('tr_cost_trx');

        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }
    
    function delete_do($alloc_no)
    {
        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_rowID'), false);
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));
        $this->db->where('deleted', 0);
        $this->db->where('trx_no', $alloc_no);
        $result = $this->db->update('tr_do_trx');

        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }
    
    
    function delete_gl_hdr($alloc_no)
    {
        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_rowID'), false);
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));
        $this->db->where('deleted', 0);
        $this->db->where('journal_no', $alloc_no);
        $result = $this->db->update('gl_trx_hdr');

        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    
    }
    
    function delete_gl_dtl($alloc_no)
    {
        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_rowID'), false);
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));
        $this->db->where('deleted', 0);
        $this->db->where('gl_trx_hdr_journal_no', $alloc_no);
        $result = $this->db->update('gl_trx_dtl');

        if ($result)
        {
            return true;
        } else
        {
            return false;
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
 
    function get_all_records($table, $where, $join_table, $join_criteria, $order, $sort)
    {
        $this->db->where($where);
        if ($join_table) {
            $this->db->join($join_table, $join_criteria);
        }
        $query = $this->db->order_by($order, $sort)->get($table);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
        
    }
    
    function get_all_records_list($partial_data, $dep_rowID, $start_date, $end_date)
    {
        $this->db->select('a.alloc_no, a.alloc_date, a.descs, a.alloc_amt, a.date_created, a.time_created,
                            b.prefix, b.year, b.month, b.code, b.advance_no, b.advance_amount, b.advance_extra_amount, b.pay_over_allocation,
                            c.debtor_cd, c.debtor_name, d.police_no');
        $this->db->from('cb_cash_adv_alloc as a');
        $this->db->join('cb_cash_adv AS b', 'b.advance_no=a.cb_cash_adv_no', 'LEFT');
        $this->db->join('sa_debtor AS c', 'c.rowID=b.employee_driver_rowID', 'LEFT');
        $this->db->join('sa_vehicle AS d', 'd.rowID=b.vehicle_rowID', 'LEFT');
        $this->db->where('a.deleted', 0);
        $this->db->where('b.deleted', 0);
        $this->db->where('a.alloc_mode', 'R');
        $this->db->where("a.alloc_date BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->db->order_by('a.alloc_no', 'desc');
        
        return $this->db->get()->result();
    }
    
    function get_all_ca_pok($dep_rowID)
    {        
        $sql = "SELECT `a`.*, `b`.`by_jo` as by_jo, `b`.`only_driver` as only_driver, `b`.`fare_trip` as fare_trip, `b`.`advance_name`, `c`.`debtor_cd` as debtor_code, 
                        `c`.`debtor_name` as debtor_name, `d`.`police_no` as police_no, `d`.`vehicle_photo` as vehicle_photo, `d`.`vehicle_type`, `e`.`type_cd` as type_code, `e`.`type_name` as type_name, 
                        `f`.`fare_trip_cd` as fare_trip_no, `g`.`destination_no` as destination_from_no, `g`.`destination_name` as destination_from_name, 
                        `h`.`destination_no` as destination_to_no, `h`.`destination_name` as destination_to_name, 
                        CONCAT(j.latitude, ',', j.longitude) as origin_coordinate, 
                        CONCAT(k.latitude, ',', k.longitude) as destination_coordinate 
                FROM (`cb_cash_adv_alloc` AS alloc) LEFT JOIN `cb_cash_adv` AS a ON `alloc`.`alloc_no` = `a`.`trx_no`
                                            LEFT JOIN `sa_advance_type` AS b ON `b`.`rowID`=`a`.`advance_type_rowID` 
											LEFT JOIN `sa_debtor` AS c ON `c`.`rowID`=`a`.`employee_driver_rowID` 
											LEFT JOIN `sa_vehicle` AS d ON `d`.`rowID`=`a`.`vehicle_rowID` LEFT JOIN `sa_vehicle_type` AS e ON `e`.`rowID`=`a`.`vehicle_type_rowID` 
											LEFT JOIN `sa_fare_trip_hdr` AS f ON `f`.`rowID` = `a`.`fare_trip_rowID` 
											LEFT JOIN `sa_destination` AS g ON `g`.`rowID`=`f`.`destination_from_rowID` 
											LEFT JOIN `sa_destination` AS h ON `h`.`rowID`=`f`.`destination_to_rowID` 
											LEFT JOIN `sa_users` AS i ON `i`.`rowID`=`a`.`user_created` 
											LEFT JOIN `sa_koordinat_poi` AS j ON `j`.`rowID`=`g`.`coordinate_rowID` 
											LEFT JOIN `sa_koordinat_poi` AS k ON `k`.`rowID`=`h`.`coordinate_rowID`                 
                WHERE alloc.status = 2 AND `a`.`deleted` = 0 AND `a`.`advance_balance` = 0 AND i.dep_rowID = ".$dep_rowID."
                ORDER BY `a`.`advance_date` desc";
        
        $query = $this->db->query($sql);
        
        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }
    }
    
    function get_cash_advance_by_trx_no($trx_no)
    {
        $this->db->select('a.*,
							b.by_jo as by_jo,
							b.only_driver as only_driver,
							b.fare_trip as fare_trip,
							b.advance_name,
							c.debtor_cd as debtor_code,
							c.debtor_name as debtor_name,
                            c.type,
							d.police_no as police_no,
							e.type_cd as type_code,
							e.type_name as type_name,
							f.fare_trip_cd as fare_trip_no,
							g.destination_no as destination_from_no,
							g.destination_name as destination_from_name,
							h.destination_no as destination_to_no,
							h.destination_name as destination_to_name,
                            j.dep_name, alloc.alloc_amt, alloc.alloc_no, alloc.alloc_date, alloc.status, alloc.status_external, alloc.reference_pok_no_1, alloc.reference_pok_no_2');
        $this->db->from('cb_cash_adv AS a');
        $this->db->join('sa_advance_type AS b', 'b.rowID=a.advance_type_rowID', 'LEFT');
        $this->db->join('sa_debtor AS c', 'c.rowID=a.employee_driver_rowID', 'LEFT');
        $this->db->join('sa_vehicle AS d', 'd.rowID=a.vehicle_rowID', 'LEFT');
        $this->db->join('sa_vehicle_type AS e', 'e.rowID=a.vehicle_type_rowID', 'LEFT');
        $this->db->join('sa_fare_trip_hdr AS f', 'f.rowID = a.fare_trip_rowID', 'LEFT');
        $this->db->join('sa_destination AS g', 'g.rowID=f.destination_from_rowID', 'LEFT');
        $this->db->join('sa_destination AS h', 'h.rowID=f.destination_to_rowID', 'LEFT');
        $this->db->join('sa_users AS i', 'i.rowID=a.user_created', 'LEFT');
        $this->db->join('sa_dep AS j', 'j.rowID=i.dep_rowID', 'LEFT');
        $this->db->join('cb_cash_adv_alloc AS alloc', 'alloc.cb_cash_adv_no=a.advance_no', 'LEFT');
        $this->db->where('a.deleted =', 0);
        $this->db->where('alloc.alloc_mode', 'R');
        $this->db->where('alloc.deleted =', 0);
        $this->db->where('a.trx_no', $trx_no);
        return $this->db->get()->row();
    }
    
    function get_cash_advance_refund_by_trx_no($trx_no)
    {
        $this->db->select('a.*,
							b.by_jo as by_jo,
							b.only_driver as only_driver,
							b.fare_trip as fare_trip,
							b.advance_name,
							c.debtor_cd as debtor_code,
							c.debtor_name as debtor_name,
                            c.type,
							d.police_no as police_no,
							e.type_cd as type_code,
							e.type_name as type_name,
							f.fare_trip_cd as fare_trip_no,
							g.destination_no as destination_from_no,
							g.destination_name as destination_from_name,
							h.destination_no as destination_to_no,
							h.destination_name as destination_to_name,
                            j.dep_name, alloc.alloc_amt, alloc.alloc_no, alloc.alloc_date, alloc.status, alloc.status_external, alloc.reference_pok_no_1, alloc.reference_pok_no_2');
        $this->db->from('cb_cash_adv AS a');
        $this->db->join('sa_advance_type AS b', 'b.rowID=a.advance_type_rowID', 'LEFT');
        $this->db->join('sa_debtor AS c', 'c.rowID=a.employee_driver_rowID', 'LEFT');
        $this->db->join('sa_vehicle AS d', 'd.rowID=a.vehicle_rowID', 'LEFT');
        $this->db->join('sa_vehicle_type AS e', 'e.rowID=a.vehicle_type_rowID', 'LEFT');
        $this->db->join('sa_fare_trip_hdr AS f', 'f.rowID = a.fare_trip_rowID', 'LEFT');
        $this->db->join('sa_destination AS g', 'g.rowID=f.destination_from_rowID', 'LEFT');
        $this->db->join('sa_destination AS h', 'h.rowID=f.destination_to_rowID', 'LEFT');
        $this->db->join('sa_users AS i', 'i.rowID=a.user_created', 'LEFT');
        $this->db->join('sa_dep AS j', 'j.rowID=i.dep_rowID', 'LEFT');
        $this->db->join('cb_cash_adv_alloc AS alloc', 'alloc.cb_cash_adv_no=a.advance_no', 'LEFT');
        $this->db->where('a.deleted =', 0);
        $this->db->where('alloc.alloc_mode', 'F');
        $this->db->where('alloc.deleted =', 0);
        $this->db->where('a.trx_no', $trx_no);
        return $this->db->get()->row();
    }
    
    function get_cash_advance_by_advance_no($advance_no)
    {
        $this->db->select('*');
        $this->db->from('cb_cash_adv');
        $this->db->where('deleted', 0);
        $this->db->where('advance_no', $advance_no);
        return $this->db->get()->row();
    }
    
    function get_cash_advance_by_alloc_no($alloc_no)
    {
        $this->db->select('*');
        $this->db->from('cb_cash_adv');
        $this->db->where('deleted', 0);
        $this->db->where('trx_no', $alloc_no);
        return $this->db->get()->row();
    }
    
    function get_total_refund_by_advance_no($advance_no)
    {
        $this->db->select('cb_cash_adv_no, alloc_mode, deleted, SUM(alloc_amt) as total_refund');
        $this->db->from('cb_cash_adv_alloc');
        $this->db->group_by('cb_cash_adv_no, alloc_mode, deleted');
        $this->db->having('deleted', 0);
        $this->db->having('alloc_mode', 'F');
        $this->db->having('cb_cash_adv_no', $advance_no);
        return $this->db->get()->row();
    }
    
    function get_data_realization_by_alloc_no($alloc_no)
    {
        $this->db->select('*');
        $this->db->from('cb_cash_adv_alloc');
        $this->db->where('deleted', 0);
        $this->db->where('alloc_no', $alloc_no);
        return $this->db->get()->row();
    }
    
    function get_data_gl_by_trx_no($trx_no)
    {
        $this->db->select('*');
        $this->db->from('gl_trx_hdr');
        $this->db->where('deleted', 0);
        $this->db->where('journal_no', $trx_no);
        return $this->db->get()->row();
    }
    
    function get_document_by_trx_no($trx_no)
    {
        $this->db->select('*');
        $this->db->from('tr_do_trx');
        $this->db->where('deleted', 0);
        $this->db->where('trx_no', $trx_no);
        $this->db->order_by('jo_no', 'ASC');
        return $this->db->get()->result();
    }
    
    function get_jo_by_jo_no($jo_no)
    {
        $this->db->select('*');
        $this->db->from('tr_jo_trx_hdr');
        $this->db->where('deleted', 0);
        $this->db->where('jo_no', $jo_no);
        return $this->db->get()->row();
    }
    
    function get_document_by_trx_do_no($trx_no,$do_no)
    {
        $this->db->select('*');
        $this->db->from('tr_do_trx');
        $this->db->where('deleted', 0);
        $this->db->where('trx_no !=', $trx_no);
        $this->db->where('do_no', $do_no);
        return $this->db->get()->result();
    }
    
    function get_cost_by_trx_no($trx_no)
    {
        $this->db->select('a.*,b.descs as cost_name');
        $this->db->from('tr_cost_trx as a');
        $this->db->join('sa_cost as b', 'b.rowID=a.cost_rowID');
        $this->db->where('a.deleted', 0);
        $this->db->where('a.trx_no', $trx_no);
        $this->db->order_by('a.row_no', 'ASC');
        return $this->db->get()->result();
    }

    function get_all_records_ca_details($ca_prefix, $ca_year, $ca_month, $ca_code)
    {
        $this->db->select('a.*,
							b.by_jo as by_jo,
							b.only_driver as only_driver,
							b.fare_trip as fare_trip,
							b.advance_name,
							c.debtor_cd as debtor_code,
							c.debtor_name as debtor_name,
							c.id_no as id_no,
							c.type as debtor_type,
							d.police_no as police_no,
							e.type_cd as type_code,
							e.type_name as type_name,
							f.fare_trip_cd as fare_trip_no,
							g.destination_no as destination_from_no,
							g.destination_name as destination_from_name,
							h.destination_no as destination_to_no,
							h.destination_name as destination_to_name');
        $this->db->from('cb_cash_adv AS a');
        $this->db->join('sa_advance_type AS b', 'b.rowID=a.advance_type_rowID', 'LEFT');
        $this->db->join('sa_debtor AS c', 'c.rowID=a.employee_driver_rowID', 'LEFT');
        $this->db->join('sa_vehicle AS d', 'd.rowID=a.vehicle_rowID', 'LEFT');
        $this->db->join('sa_vehicle_type AS e', 'e.rowID=a.vehicle_type_rowID', 'LEFT');
        $this->db->join('sa_fare_trip_hdr AS f', 'f.rowID = a.fare_trip_rowID', 'LEFT');
        $this->db->join('sa_destination AS g', 'g.rowID=f.destination_from_rowID',
            'LEFT');
        $this->db->join('sa_destination AS h', 'h.rowID=f.destination_to_rowID', 'LEFT');
        $this->db->join('sa_users AS i', 'i.rowID=a.user_created', 'LEFT');
        $this->db->where('a.deleted =', 0);
        $this->db->where('a.prefix =', $ca_prefix);
        $this->db->where('a.year =', $ca_year);
        $this->db->where('a.month =', $ca_month);
        $this->db->where('a.code =', $ca_code);
        $this->db->order_by('a.advance_no', 'asc');
        return $this->db->get()->result_array();

    }

    function getAmountCost($from_id, $to_id, $jo_type, $vehicle_type){
        $this->db->select('*');
        $this->db->from('sa_fare_trip_hdr');
        $this->db->where('deleted =', 0);
        $this->db->where('destination_from_rowID =', $from_id);
        $this->db->where('destination_to_rowID =', $to_id);
        $this->db->where('trip_type =', $jo_type);
        $this->db->where('vehicle_id =', $vehicle_type);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0)
        {
            return $query->row();
        } else
        {
            return null;
        }
    }

    function get_all_records_ca_details_row($alloc_no,$advance_no)
    {
        $this->db->select('a.*, alloc.alloc_no, alloc.doc_sj, alloc.doc_st, alloc.doc_sm, alloc.doc_sr, alloc.status, alloc.status_external, alloc.reference_pok_no_1, alloc.reference_pok_no_2,
							b.by_jo as by_jo,
							b.only_driver as only_driver,
							b.fare_trip as fare_trip,
							b.advance_name,
							c.debtor_cd as debtor_code,
							c.debtor_name as debtor_name,
							c.id_no as id_no,
							c.type as debtor_type,
							d.police_no as police_no,
							e.type_cd as type_code,
							e.type_name as type_name,
							f.fare_trip_cd as fare_trip_no,
                            f.fare_trip_cd as fare_trip_code,
                            f.trip_type as trip_type,
                            f.destination_from_rowID as from_id,
                            f.destination_to_rowID as to_id,
							g.destination_no as destination_from_no,
							g.destination_name as destination_from_name,
							h.destination_no as destination_to_no,
							h.destination_name as destination_to_name,
                            case when c.type="E" then "EMPLOYEE" else "DRIVER" end as employee ', false);
        $this->db->from('cb_cash_adv AS a');
        $this->db->join('sa_advance_type AS b', 'b.rowID=a.advance_type_rowID', 'LEFT');
        $this->db->join('sa_debtor AS c', 'c.rowID=a.employee_driver_rowID', 'LEFT');
        $this->db->join('sa_vehicle AS d', 'd.rowID=a.vehicle_rowID', 'LEFT');
        $this->db->join('sa_vehicle_type AS e', 'e.rowID=a.vehicle_type_rowID', 'LEFT');
        $this->db->join('sa_fare_trip_hdr AS f', 'f.rowID = a.fare_trip_rowID', 'LEFT');
        $this->db->join('sa_destination AS g', 'g.rowID=f.destination_from_rowID',
            'LEFT');
        $this->db->join('sa_destination AS h', 'h.rowID=f.destination_to_rowID', 'LEFT');
        $this->db->join('sa_users AS i', 'i.rowID=a.user_created', 'LEFT');
        $this->db->join('cb_cash_adv_alloc AS alloc', 'alloc.cb_cash_adv_no=a.advance_no', 'LEFT');
        $this->db->where('a.deleted =', 0);
        $this->db->where('alloc.deleted =', 0);
        $this->db->where('a.advance_no =', $advance_no);
        $this->db->where('alloc.alloc_no =', $alloc_no);
        $this->db->order_by('a.advance_no', 'asc');
        return $this->db->get()->row();
    }

    function get_data_cash_advance_jo()
    {

        $this->db->select('a.year,a.month,a.code,a.jo_no,a.jo_date,b.debtor_name as debtor,a.po_spk_no,a.so_no,a.vessel_no,a.jo_type,
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
    
    function get_data_cash_advance_jo_by_jo_no($jo_no)
    {

        $this->db->select('a.year,a.month,a.code,a.jo_no,a.jo_date,b.debtor_name as debtor,a.po_spk_no,a.so_no,a.vessel_no,a.jo_type,
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
        $this->db->where('a.status <>', 1);
        $this->db->where('a.jo_no', $jo_no);
        $this->db->order_by('a.jo_no', 'desc');

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->row();
        } else
        {
            return null;
        }

    }
    
    function check_invoice($trx_no){
        $this->db->select('*');
        $this->db->from('tr_do_trx');
        $this->db->where('trx_no', $trx_no);
        $this->db->where('deleted', 0);
        $this->db->where('invoice_no !=', '');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }
    }
    
    function check_cash_bank($trx_no){
        $this->db->select('*');
        $this->db->from('cb_trx_dtl');
        $this->db->where('advance_invoice_no', $trx_no);
        $this->db->where('deleted', 0);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }
    }

    // Queue
    
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

/* End of file model.php */
