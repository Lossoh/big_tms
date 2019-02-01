<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Finances_model extends CI_Model
{
    var $table = 'persons';
    var $column = array(
        'firstName',
        'lastName',
        'gender',
        'address',
        'dob');
    var $order = array('id' => 'desc');

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    function simpanCashAdvance($cash_out_prefix_cd, $new_cash_advance_code, $cash_advance_no,
        $dataPost)
    {
        $total_amount = str_replace('.', '', $dataPost['amount']) + str_replace('.', '',$dataPost['extra_amount']);

        $cash_advance_data = array(
            'prefix' => $cash_out_prefix_cd,
            'year' => date('Y', strtotime($dataPost['date_ca'])),
            'month' => date('m', strtotime($dataPost['date_ca'])),
            'code' => $new_cash_advance_code,
            'advance_no' => $cash_advance_no,
            'advance_date' => date('Y-m-d', strtotime($dataPost['date_ca'])),
            'advance_type_rowID' => $dataPost['cash_advance_type2'],
            'employee_driver_rowID' => $dataPost['driver2'],
            'vehicle_rowID' => empty($dataPost['vehicle']) ? 0 : $dataPost['vehicle'],
            'vehicle_type_rowID' => $dataPost['vehicle_category'],
            'fare_trip_rowID' => $dataPost['fare_trip'],
            'dep_rowID' => $this->session->userdata('dep_rowID'),
            'barcode_no' => strtoupper($dataPost['barcode_no']),
            'advance_amount' => str_replace('.', '', $dataPost['amount']),
            'advance_extra_amount' => str_replace('.', '', $dataPost['extra_amount']),
            'advance_allocation' => 0,
            'advance_balance' => $total_amount,
            'description' => strtoupper($dataPost['cash_advance_desc']),
            'user_created' => $this->session->userdata('user_rowID'),
            'date_created' => date('Y-m-d', strtotime($dataPost['date_ca'])),
            'time_created' => date('H:i:s'));

        $result = $this->db->insert('cb_cash_adv', $cash_advance_data);
        if ($result)
        {
            return true;
        } else
        {
            return false;
        }

    }

    function simpanCashBankHeader($sa_spec_prefix_cb, $alloc_code_cb, $cash_advance_no,
        $cash_gl_rowID, $advance_name, $debtor_name, $trx_no_cb, $dataPost)
    {
        $total_amount = str_replace('.', '', $dataPost['amount']) + str_replace('.', '',$dataPost['extra_amount']);
        $cb_trx_data = array(
            'prefix' => $sa_spec_prefix_cb,
            'year' => date('Y', strtotime($dataPost['date_ca'])),
            'month' => date('m', strtotime($dataPost['date_ca'])),
            'code' => $alloc_code_cb,
            //'trx_no' => $cash_advance_no,
            'trx_no' => $trx_no_cb,
            'advance_invoice_trx_no' => $cash_advance_no,
            'trx_date' => date('Y-m-d', strtotime($dataPost['date_ca'])),
            'payment_type' => 'P',
            'transaction_type' => 'cash_advance',
            'debtor_creditor_type' => 'D',
            'coa_rowID' => $cash_gl_rowID,
            'descs' => ($dataPost['cash_advance_desc'] == "") ? strtoupper($advance_name .
                ' A/N ' . $debtor_name) : strtoupper($advance_name . ' A/N ' . $debtor_name .
                ', ' . $dataPost['cash_advance_desc']),
            'trx_amt' => $total_amount * -1,
            'debtor_creditor_rowID' => $dataPost['driver2'],
            'recon_status' => 'N',
            'recon_date' => '1901-01-01',
            'cg_void_status' => 'A',
            'user_created' => $this->session->userdata('user_rowID'),
            'date_created' => date('Y-m-d', strtotime($dataPost['date_ca'])),
            'time_created' => date('H:i:s'));
        $result = $this->db->insert('cb_trx_hdr', $cb_trx_data);
        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }

    function save_cancel_load($sa_spec_prefix, $alloc_code, $alloc_no, $dataCA)
    {
        $cancel_load_data = array(
            'prefix' => $sa_spec_prefix,
            'year' => date('Y'),
            'month' => date('m'),
            'code' => $alloc_code,
            'row_no' => 1,
            'alloc_no' => $alloc_no,
            'alloc_date' => date('Y-m-d'),
            'descs' => 'BATAL MUAT NO ' . $dataCA->advance_no,
            'alloc_amt' => $dataCA->advance_balance,
            'alloc_mode' => 'L',
            'cb_cash_adv_no' => $dataCA->advance_no,
            'cb_cash_adv_prefix' => $dataCA->prefix,
            'cb_cash_adv_year' => $dataCA->year,
            'cb_cash_adv_month' => $dataCA->month,
            'cb_cash_adv_code' => $dataCA->code,
            'doc_sj' => 'No',
            'doc_st' => 'No',
            'doc_sm' => 'No',
            'doc_sr' => 'No',
            'user_created' => $this->session->userdata('user_rowID'),
            'date_created' => date('Y-m-d'),
            'time_created' => date('H:i:s')
        );
        $result = $this->db->insert('cb_cash_adv_alloc', $cancel_load_data);
        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }
    
    function simpan_realization_hdr($sa_spec_prefix, $alloc_code, $alloc_no, $dataPost)
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
            'user_created' => $this->session->userdata('user_rowID'),
            'date_created' => date('Y-m-d'),
            'time_created' => date('H:i:s'));
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
        $dataPost, $detailCost = array())
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
            'trx_amt' => str_replace('.', '', (!empty($detailCost['amountCost'])) ? $detailCost['amountCost'] :
                0),
            'descs' => $detailCost['descs'],
            'user_created' => $this->session->userdata('user_rowID'),
            'date_created' => date('Y-m-d'),
            'time_created' => date('H:i:s'));
        $result = $this->db->insert_batch('tr_cost_trx', $cost_data);
        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }

    function simpan_gl_header_doc($sa_spec_prefix, $new_gl_coa_code, $gl_coa_no, $cash_out_prefix_cd, $cash_advance_no, $advance_name, 
        $debtor_name, $new_cash_advance_code, $dataPost)
    {
        
        $total_amount = str_replace('.', '', $dataPost['amount']) + str_replace('.', '',
            $dataPost['extra_amount']);
        $gl_trx_hdr_data = array(
            'prefix' => $sa_spec_prefix,
            'year' => date('Y', strtotime($dataPost['date_ca'])),
            'month' => date('m', strtotime($dataPost['date_ca'])),
            'code' => $new_gl_coa_code,
            'journal_no' => $gl_coa_no,
            'journal_date' => date('Y-m-d', strtotime($dataPost['date_ca'])),
            'journal_type' => 'cash advance',
            'descs' => ($dataPost['cash_advance_desc'] == "") ? strtoupper($advance_name .
                ' A/N ' . $debtor_name) : strtoupper($advance_name . ' A/N ' . $debtor_name .
                ', ' . $dataPost['cash_advance_desc']),
            'trx_amt' => $total_amount,
            'ref_prefix' => $cash_out_prefix_cd,
            'ref_year' => date('Y', strtotime($dataPost['date_ca'])),
            'ref_month' => date('m', strtotime($dataPost['date_ca'])),
            'ref_code' => $new_cash_advance_code,
            'ref_no' => $cash_advance_no,
            'ref_date' => date('Y-m-d', strtotime($dataPost['date_ca'])),
            'user_created' => $this->session->userdata('user_rowID'),
            'date_created' => date('Y-m-d', strtotime($dataPost['date_ca'])),
            'time_created' => date('H:i:s')
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

    function simpan_gl_header_doc_realization($sa_spec_prefix, $new_gl_coa_code, $gl_coa_no, $cash_out_prefix_cd, $cash_advance_no, $advance_name, 
            $debtor_name, $new_cash_advance_code, $dataPost)
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
            'user_created' => $this->session->userdata('user_rowID'),
            'date_created' => date('Y-m-d'),
            'time_created' => date('H:i:s')
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
    
    function simpan_gl_detail_doc_debet($sa_spec_prefix, $new_gl_coa_code, $gl_coa_no, $cash_out_prefix_cd, $receiveable_rowID, $advance_name,
        $debtor_name, $new_cash_advance_code, $cash_advance_no, $dataPost)
    {   
        $total_amount = str_replace('.', '', $dataPost['amount']) + str_replace('.', '',
            $dataPost['extra_amount']);
        $gl_trx_dtl_d_data = array(
            'gl_trx_hdr_prefix' => $sa_spec_prefix,
            'gl_trx_hdr_year' => date('Y', strtotime($dataPost['date_ca'])),
            'gl_trx_hdr_month' => date('m', strtotime($dataPost['date_ca'])),
            'gl_trx_hdr_code' => $new_gl_coa_code,
            'row_no' => 1,
            'gl_trx_hdr_journal_no' => $gl_coa_no,
            'gl_trx_hdr_journal_date' => date('Y-m-d', strtotime($dataPost['date_ca'])),
            'coa_rowID' => $receiveable_rowID,
            'descs' => ($dataPost['cash_advance_desc'] == "") ? strtoupper($advance_name .
                ' A/N ' . $debtor_name) : strtoupper($advance_name . ' A/N ' . $debtor_name .
                ', ' . $dataPost['cash_advance_desc']),
            'trx_amt' => $total_amount,
            'dep_rowID' => $this->session->userdata('dep_rowID'),
            'debtor_creditor_rowID' => $dataPost['driver2'],
            'gl_trx_hdr_ref_prefix' => $cash_out_prefix_cd,
            'gl_trx_hdr_ref_year' => date('Y', strtotime($dataPost['date_ca'])),
            'gl_trx_hdr_ref_month' => date('m', strtotime($dataPost['date_ca'])),
            'gl_trx_hdr_ref_code' => $new_cash_advance_code,
            'gl_trx_hdr_ref_no' => $cash_advance_no,
            'gl_trx_hdr_ref_date' => date('Y-m-d', strtotime($dataPost['date_ca'])),
            'modul' => 'CB',
            'cash_flow' => 'Y',
            'base_amt' => 0,
            'tax_no' => '',
            'user_created' => $this->session->userdata('user_rowID'),
            'date_created' => date('Y-m-d', strtotime($dataPost['date_ca'])),
            'time_created' => date('H:i:s')
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

    function simpan_gl_detail_doc_debet_realization($sa_spec_prefix, $new_gl_coa_code, $gl_coa_no, $cash_out_prefix_cd, $coaRowIDDebet, $advance_name,
        $debtor_name, $new_cash_advance_code, $cash_advance_no, $detailDebet, $dataPost)
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
            'user_created' => $this->session->userdata('user_rowID'),
            'date_created' => date('Y-m-d'),
            'time_created' => date('H:i:s')
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

    function simpan_gl_detail_doc_kredit($sa_spec_prefix, $new_gl_coa_code, $gl_coa_no, $cash_gl_rowID, $advance_name, $debtor_name,
        $cash_out_prefix_cd, $new_cash_advance_code, $cash_advance_no, $dataPost)
    {
        $total_amount = str_replace('.', '', $dataPost['amount']) + str_replace('.', '',
            $dataPost['extra_amount']);
            
        $gl_trx_dtl_k_data = array(
            'gl_trx_hdr_prefix' => $sa_spec_prefix,
            'gl_trx_hdr_year' => date('Y', strtotime($dataPost['date_ca'])),
            'gl_trx_hdr_month' => date('m', strtotime($dataPost['date_ca'])),
            'gl_trx_hdr_code' => $new_gl_coa_code,
            'row_no' => 2,
            'gl_trx_hdr_journal_no' => $gl_coa_no,
            'gl_trx_hdr_journal_date' => date('Y-m-d', strtotime($dataPost['date_ca'])),
            'coa_rowID' => $cash_gl_rowID,
            'descs' => ($dataPost['cash_advance_desc'] == "") ? strtoupper($advance_name .
                ' A/N ' . $debtor_name) : strtoupper($advance_name . ' A/N ' . $debtor_name .
                ', ' . $dataPost['cash_advance_desc']),
            'trx_amt' => $total_amount * -1,
            'dep_rowID' => $this->session->userdata('dep_rowID'),
            'debtor_creditor_rowID' => $dataPost['driver2'],
            'gl_trx_hdr_ref_prefix' => $cash_out_prefix_cd,
            'gl_trx_hdr_ref_year' => date('Y', strtotime($dataPost['date_ca'])),
            'gl_trx_hdr_ref_month' => date('m', strtotime($dataPost['date_ca'])),
            'gl_trx_hdr_ref_code' => $new_cash_advance_code,
            'gl_trx_hdr_ref_no' => $cash_advance_no,
            'gl_trx_hdr_ref_date' => date('Y-m-d', strtotime($dataPost['date_ca'])),
            'modul' => 'CB',
            'cash_flow' => 'Y',
            'base_amt' => 0,
            'tax_no' => '',
            'user_created' => $this->session->userdata('user_rowID'),
            'date_created' => date('Y-m-d', strtotime($dataPost['date_ca'])),
            'time_created' => date('H:i:s')
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
    
    function simpan_gl_detail_doc_kredit_realization($sa_spec_prefix, $new_gl_coa_code, $gl_coa_no, $receiveable_rowID, $advance_name, $debtor_name,
        $cash_out_prefix_cd, $new_cash_advance_code, $cash_advance_no, $dataPost)
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
            'user_created' => $this->session->userdata('user_rowID'),
            'date_created' => date('Y-m-d'),
            'time_created' => date('H:i:s')
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
        $cash_out_prefix_cd, $new_cash_advance_code, $cash_advance_no, $total_amount, $dataPost)
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
            'user_created' => $this->session->userdata('user_rowID'),
            'date_created' => date('Y-m-d'),
            'time_created' => date('H:i:s')
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
    
    function simpan_data_order($cash_advance_no, $dataPost)
    {


        $data = array(
            'vehicle_id' => empty($dataPost['vehicle']) ? 0 : $dataPost['vehicle'],
            'order_number' => $cash_advance_no,
            'status_order' => 'book',
            'user_created' => $this->session->userdata('user_rowID'),
            'date_created' => date('Y-m-d', strtotime($dataPost['date_ca'])),
            );
        $result = $this->db->insert('mo_vehicle_order', $data);
        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }

    function simpan_data_do($sa_spec_prefix, $alloc_code, $alloc_no, $dataPost, $detDO =
        array())
    {

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
            'komisi_supir' => $detDO['komisi_supir'],
            'komisi_kernet' => $detDO['komisi_kernet'],
            'deposit' => $detDO['deposit'],
            'count_container' => empty($detDO['ContType']) ? 0 : 1,
            'container_size' => empty($detDO['ContType']) ? '' : $detDO['ContType'],
            'container_no' => empty($detDO['container_no']) ? '' : $detDO['container_no'],
            'do_date' => date('Y-m-d', strtotime($detDO['do_date'])),
            'deliver_date' => date('Y-m-d', strtotime($detDO['do_date'])),
            'deliver_weight' => $detDO['do_weight'],
            'received_date' => date('Y-m-d', strtotime($detDO['received_date'])),
            'received_weight' => $detDO['received_weight'],
            'status' => 0,
            'user_created' => $this->session->userdata('user_rowID'),
            'date_created' => date('Y-m-d'),
            'time_created' => date('H:i:s'));
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
    
    function update_cash_advance_printed($row_id)
    {
        $sql = "UPDATE cb_cash_adv SET printed = (printed + 1),  user_printed = ".$this->session->userdata('user_rowID').",
                date_printed = '".date('Y-m-d')."', time_printed = '".date('H:i:s')."'
                WHERE rowID = ".$row_id;
                
        $result = $this->db->query($sql);

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
        /*
        if ($partial_data)
        {
            $str_partial_data = ' AND i.dep_rowID = '.$dep_rowID;
        }
        
        $sql = "SELECT `a`.*, `b`.`by_jo` as by_jo, `b`.`only_driver` as only_driver, `b`.`fare_trip` as fare_trip, `b`.`advance_name`, `c`.`debtor_cd` as debtor_code, 
                    `c`.`debtor_name` as debtor_name, `d`.`police_no` as police_no, `d`.`vehicle_photo` as vehicle_photo, `e`.`type_cd` as type_code, `e`.`type_name` as type_name, 
                    `f`.`fare_trip_cd` as fare_trip_no, `g`.`destination_no` as destination_from_no, `g`.`destination_name` as destination_from_name, 
                    `h`.`destination_no` as destination_to_no, `h`.`destination_name` as destination_to_name, 
                    CONCAT(j.latitude,',',j.longitude) as origin, CONCAT(k.latitude,',',k.longitude) as destination
                FROM (`cb_cash_adv` AS a) LEFT JOIN `sa_advance_type` AS b ON `b`.`rowID`=`a`.`advance_type_rowID` 
                                        LEFT JOIN `sa_debtor` AS c ON `c`.`rowID`=`a`.`employee_driver_rowID` 
                                        LEFT JOIN `sa_vehicle` AS d ON `d`.`rowID`=`a`.`vehicle_rowID` 
                                        LEFT JOIN `sa_vehicle_type` AS e ON `e`.`rowID`=`a`.`vehicle_type_rowID` 
                                        LEFT JOIN `sa_fare_trip_hdr` AS f ON `f`.`rowID` = `a`.`fare_trip_rowID` 
                                        LEFT JOIN `sa_destination` AS g ON `g`.`rowID`=`f`.`destination_from_rowID` 
                                        LEFT JOIN `sa_destination` AS h ON `h`.`rowID`=`f`.`destination_to_rowID` 
                                        LEFT JOIN `sa_users` AS i ON `i`.`rowID`=`a`.`user_created` 
                                        LEFT JOIN `sa_koordinat_poi` AS j ON `j`.`rowID`=`g`.`coordinate_rowID` 
                                        LEFT JOIN `sa_koordinat_poi` AS k ON `k`.`rowID`=`h`.`coordinate_rowID` 
                WHERE `a`.`deleted` = 0 AND `a`.`advance_balance` != 0 AND `a`.`advance_date` BETWEEN '".$start_date."' AND '".$end_date."' ".$str_partial_data."
                ORDER BY `a`.`advance_date` desc";
        
        $query = $this->db->query($sql);
        
        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }
        */
        
        $this->db->select("a.*,
							b.by_jo as by_jo,
							b.only_driver as only_driver,
							b.fare_trip as fare_trip,
							b.advance_name,
							c.debtor_cd as debtor_code,
							c.debtor_name as debtor_name,
							d.police_no as police_no,
							d.vehicle_photo as vehicle_photo,
							e.type_cd as type_code,
							e.type_name as type_name,
							f.fare_trip_cd as fare_trip_no,
							g.destination_no as destination_from_no,
							g.destination_name as destination_from_name,
							h.destination_no as destination_to_no,
							h.destination_name as destination_to_name");
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
        $this->db->where('a.advance_balance !=', 0);
        $this->db->where("a.advance_date BETWEEN '".$start_date."' AND '".$end_date."'");
        if ($partial_data)
        {
            $this->db->where('i.dep_rowID =', $dep_rowID);
        }
        $this->db->order_by('a.advance_date', 'desc');
        //echo $this->db->last_query();exit();
        return $this->db->get()->result();
        //return $this->db->get()->result_array(); //if($partial_data>0){$this->db->where('i.dep_rowID =',$dep_rowID)};
        
    }
    
    function get_all_records_list_bonus_nol($partial_data, $dep_rowID, $start_date, $end_date)
    {
        $this->db->select('a.*,
							b.by_jo as by_jo,
							b.only_driver as only_driver,
							b.fare_trip as fare_trip,
							b.advance_name,
							c.debtor_cd as debtor_code,
							c.debtor_name as debtor_name,
							d.police_no as police_no,
							d.vehicle_photo as vehicle_photo,
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
        $this->db->where('a.advance_balance =', 0);
        $this->db->where("a.advance_date BETWEEN '".$start_date."' AND '".$end_date."'");
        if ($partial_data)
        {
            $this->db->where('i.dep_rowID =', $dep_rowID);
        }
        $this->db->order_by('a.advance_date', 'desc');
        //echo $this->db->last_query();exit();
        return $this->db->get()->result();
        //return $this->db->get()->result_array(); //if($partial_data>0){$this->db->where('i.dep_rowID =',$dep_rowID)};

    }
    
    function get_all_records_list_by_id($row_id)
    {
        $this->db->select('a.*,
							b.by_jo as by_jo,
							b.only_driver as only_driver,
							b.fare_trip as fare_trip,
							b.advance_name,
							c.type as debtor_type,
							c.debtor_cd as debtor_code,
							c.debtor_name as debtor_name,
							c.no_ktp as no_ktp,
							d.police_no as police_no,
							e.type_cd as type_code,
							e.type_name as type_name,
							f.fare_trip_cd as fare_trip_no,
							g.destination_no as destination_from_no,
							g.destination_name as destination_from_name,
							h.destination_no as destination_to_no,
							h.destination_name as destination_to_name,
                            j.dep_name');
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
        $this->db->join('sa_dep AS j', 'j.rowID=i.dep_rowID', 'LEFT');
        $this->db->where('a.deleted =', 0);
        $this->db->where('a.rowID =', $row_id);

        $this->db->order_by('a.advance_no', 'asc');
        //echo $this->db->last_query();exit();
        return $this->db->get()->row();
        //return $this->db->get()->result_array(); //if($partial_data>0){$this->db->where('i.dep_rowID =',$dep_rowID)};

    }
    
    function get_position_vehicle_by_row_id($row_id)
	{
	    $sql = "SELECT a.vehicle_id, `b`.`police_no`, a.speed, SUBSTRING(TRIM(CONV(a.status,16,2)),-2) as status, (a.latitude*0.000001) as latitude, 
                    (a.longitude*0.000001) as longitude, a.gps_time, DATE_FORMAT(DATE_ADD(DATE_ADD('2008-08-08 08:08:08', INTERVAL a.gps_time SECOND),
                    INTERVAL 7 hour),'%d %b %Y %T') as time_gps, DATE_FORMAT(DATE_ADD(DATE_ADD('2008-08-08 08:08:08', INTERVAL a.gps_time SECOND),
                    INTERVAL 7 hour),'%Y-%m-%d %T') as datetime_gps
                FROM (`tr_monitoring_trx_last_position` as a) JOIN `sa_vehicle` as b ON `a`.`vehicle_id` = `b`.`rowID` 
                WHERE a.vehicle_id = ".$row_id."
                ORDER BY datetime_gps DESC";

        $query = $this->db->query($sql);

		return $query->row();
		
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
                            j.dep_name, alloc.alloc_date');
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
        $this->db->where('a.trx_no', $trx_no);
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
    
    function get_ca_by_advance_no($advance_no)
    {
        $this->db->select('*');
        $this->db->from('cb_cash_adv');
        $this->db->where('advance_no', $advance_no);
        return $this->db->get()->row();
    }

    function get_memo_by_advance_no($advance_no)
    {
        $this->db->select('*');
        $this->db->from('cb_memo');
        $this->db->where('advance_no', $advance_no);
        $this->db->order_by('date_created', 'DESC');
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

    function get_addendum_by_advance_no($advance_no)
    {
        $sql = 'SELECT cb_cash_adv_no, alloc_mode, SUM(alloc_amt) as jumlah_addendum 
                FROM cb_cash_adv_alloc 
                GROUP BY cb_cash_adv_no, alloc_mode 
                HAVING cb_cash_adv_no = "'.$advance_no.'" AND alloc_mode = "A"';
        return $this->db->query($sql)->row();
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
    
    function get_row_ca_by_no($ca_prefix, $ca_year, $ca_month, $ca_code)
    {
        $this->db->select('*');
        $this->db->from('cb_cash_adv');
        $this->db->where('prefix =', $ca_prefix);
        $this->db->where('year =', $ca_year);
        $this->db->where('month =', $ca_month);
        $this->db->where('code =', $ca_code);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->row();
        } else
        {
            return null;
        }
	}
    
    function get_all_records_ca_details_row($ca_prefix, $ca_year, $ca_month, $ca_code)
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
                            f.fare_trip_cd as fare_trip_code,
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
        $this->db->where('a.deleted =', 0);
        $this->db->where('a.prefix =', $ca_prefix);
        $this->db->where('a.year =', $ca_year);
        $this->db->where('a.month =', $ca_month);
        $this->db->where('a.code =', $ca_code);
        $this->db->order_by('a.advance_no', 'asc');
        return $this->db->get()->row();
    }

    function get_all_antrian_today()
    {
        $this->db->select('a.*,b.rowID as queue_id,b.date_modified as already');
        $this->db->from('sa_debtor as a');
        $this->db->join('tr_queue as b', 'a.rowID=b.debtor_id');
        //$this->db->where('DATE(b.date_created)', date("Y-m-d"));
        $this->db->where('a.deleted', 0);
        $this->db->order_by('a.debtor_name', 'asc');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }
    }

    function updateQueue($queue_id, $date, $user_id)
    {
        $this->db->set('date_modified', $date);
        $this->db->set('user_modified', $user_id);
        $this->db->where('rowID', $queue_id);
        $result = $this->db->update('tr_queue');
    }

    function get_all_records_alloc_details($alloc_prefix, $alloc_year, $alloc_month,
        $alloc_code)
    {
        $this->db->select('a.*,
							b.advance_no,
							b.advance_type_rowID,
							b.advance_amount,
                            b.advance_extra_amount,
							b.advance_allocation,
							b.advance_balance,
							b.dep_rowID,
							b.description as bdescription,
							c.by_jo as by_jo,
							c.only_driver as only_driver,
							c.fare_trip as fare_trip,
							c.advance_name,							
							d.debtor_cd as debtor_code,
							d.debtor_name as debtor_name,
							d.id_no as id_no,
							d.type as debtor_type,
							e.police_no as police_no,
							f.type_cd as type_code,
							f.type_name as type_name,
							g.fare_trip_cd as fare_trip_no,
							h.destination_no as destination_from_no,
							h.destination_name as destination_from_name,
							i.destination_no as destination_to_no,
							i.destination_name as destination_to_name,
							k.dep_name');
        $this->db->from('cb_cash_adv_alloc AS a');
        $this->db->join('cb_cash_adv AS b',
            'b.prefix=a.cb_cash_adv_prefix AND b.year=a.cb_cash_adv_year AND b.month=a.cb_cash_adv_month AND b.code=a.cb_cash_adv_code',
            'LEFT');
        $this->db->join('sa_advance_type AS c', 'c.rowID=b.advance_type_rowID', 'LEFT');
        $this->db->join('sa_debtor AS d', 'd.rowID=b.employee_driver_rowID', 'LEFT');
        $this->db->join('sa_vehicle AS e', 'e.rowID=b.vehicle_rowID', 'LEFT');
        $this->db->join('sa_vehicle_type AS f', 'f.rowID=b.vehicle_type_rowID', 'LEFT');
        $this->db->join('sa_fare_trip_hdr AS g', 'g.rowID = b.fare_trip_rowID', 'LEFT');
        $this->db->join('sa_destination AS h', 'h.rowID=g.destination_from_rowID',
            'LEFT');
        $this->db->join('sa_destination AS i', 'i.rowID=g.destination_to_rowID', 'LEFT');
        $this->db->join('sa_users AS j', 'j.rowID=a.user_created', 'LEFT');
        $this->db->join('sa_dep AS k', 'k.rowID=b.dep_rowID', 'LEFT');
        $this->db->where('a.deleted =', 0);
        $this->db->where('a.prefix =', $alloc_prefix);
        $this->db->where('a.year =', $alloc_year);
        $this->db->where('a.month =', $alloc_month);
        $this->db->where('a.code =', $alloc_code);
        $this->db->order_by('a.alloc_no', 'asc');
        return $this->db->get()->result_array();
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
    
    function get_verify_user()
    {
        $this->db->select('a.user_rowID, b.password');
        $this->db->from('sa_usermenu as a');
        $this->db->join('sa_users as b', 'a.user_rowID = b.rowID');
        $this->db->where('a.StatusUsermenu', '1');
        $this->db->where('a.verified', 1);
        $this->db->where('a.kd_menu', 52); // 52 => Menu Cash Advance List
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


    function get_data_job_order($where)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'a.jo_no';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';

        $offset = ($page - 1) * $rows;
        $danex = $rows * ($page);
        $result = array();
        $rs = $this->db->query('select a.year,a.month,a.code,a.jo_no,a.jo_date,concat(b.debtor_cd,' -
            ',b.debtor_name) as debtor
        ,a.po_spk_no,a.so_no,a.vessel_no,a.vessel_name,c.port_name,d.fare_trip_cd from tr_jo_trx_hdr as a
        left join  sa_debtor as b on a.debtor_rowID=b.rowID
        left join  sa_port as c on a.port_rowID=c.rowID
        left join  sa_fare_trip_hdr as d on a.fare_trip_rowID=d.rowID where a.deleted = 0 and ' .
            $where);

        $result["total"] = $rs->num_rows();

        $CSQL = $this->db->query("select * from (
        SET @row = 0; 
        select @row := @row + 1 AS row a.year,a.month,a.code,a.jo_no,a.jo_date,concat(b.debtor_cd,'-',b.debtor_name) as debtor
        ,a.po_spk_no,a.so_no,a.vessel_no,a.vessel_name,c.port_name,d.fare_trip_cd from tr_jo_trx_hdr as a
        left join  sa_debtor as b on a.debtor_rowID=b.rowID
        left join  sa_port as c on a.port_rowID=c.rowID
        left join  sa_fare_trip_hdr as d on a.fare_trip_rowID=d.rowID where a.deleted = 0 " .
            $where . " ) a
        where row > $offset and row <= $danex order by $sort $order ");


        $items = array();

        foreach ($CSQL->result_array() as $row)
        {
            array_push($items, $row);
        }

        $result["rows"] = $items;
        header('Content-Type: application/json');
        echo json_encode($result);
        exit();

    }


    function getCostCode($term, $column = '*')
    {
        $this->db->select($column);
        $this->db->like('cost_cd', $term);
        $this->db->or_like('descs', $term);
        $data = $this->db->from('sa_cost')->get();
        return $data->result_array();
    }
    private function _get_datatables_query()
    {

        $this->db->from($this->table);

        $i = 0;

        foreach ($this->column as $item)
        {
            if ($_POST['search']['value'])
                ($i === 0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->
                    or_like($item, $_POST['search']['value']);
            $column[$i] = $item;
            $i++;
        }

        if (isset($_POST['order']))
        {
            $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else
            if (isset($this->order))
            {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }
    }
    
    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
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
