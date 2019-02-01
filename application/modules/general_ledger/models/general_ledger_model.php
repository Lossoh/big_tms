<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class general_ledger_model extends CI_Model
{
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
    
    function get_all_record_data($start_date,$end_date)
    {
        $this->db->select('*');
        $this->db->from('gl_trx_hdr');
        $this->db->where('deleted', 0);
        $this->db->where("journal_date BETWEEN '".$start_date."' AND '".$end_date."'");
        $this->db->order_by('journal_date', 'DESC');
        $this->db->order_by('journal_no', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }

    }
    
    function get_data_header_by_trx_no($trx_no)
    {
        $this->db->select('*');
        $this->db->from('gl_trx_hdr');
        $this->db->where('deleted', 0);
        $this->db->where('journal_no', $trx_no);
        $query = $this->db->get();
        return $query->row();
    }
    
    function get_data_header_by_type_ref_no($type,$ref_no)
    {
        $this->db->select('*');
        $this->db->from('gl_trx_hdr');
        $this->db->where('deleted', 0);
        $this->db->where('journal_type', $type);
        $this->db->where('ref_no', $ref_no);
        $query = $this->db->get();
        return $query->row();
    }
    
    function get_data_advance_by_trx_no($trx_no)
    {
        $this->db->select('*');
        $this->db->from('tr_reimburse_trx_adv_dtl');
        $this->db->where('deleted', 0);
        $this->db->where('reimburse_number', $trx_no);
        $this->db->order_by('advance_number','asc');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }
    }
    
    function get_data_header_kb($trx_no){
        $this->db->select('*');
        $this->db->from('ap_trx_hdr');
        $this->db->where('trx_no', $trx_no);
        $this->db->where('deleted', 0);

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->row();
        } else
        {
            return null;
        }
    }
    
    function get_data_detail_by_trx_no($trx_no)
    {
        $this->db->select('*');
        $this->db->from('gl_trx_dtl');
        $this->db->where('deleted', 0);
        $this->db->where('gl_trx_hdr_journal_no', $trx_no);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }
    }
    
    function get_data_reference_by_ref_no($trx_no)
    {
        $this->db->select('*');
        $this->db->from('gl_trx_dtl');
        $this->db->where('deleted', 0);
        $this->db->where('gl_trx_hdr_ref_no', $trx_no);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }
    }
    
    function get_data_detail_by_journal_no($trx_no)
    {
        $this->db->select('a.*, b.acc_name');
        $this->db->from('gl_trx_dtl as a');
        $this->db->join('gl_coa as b','b.rowID = a.coa_rowID');
        $this->db->where('a.deleted', 0);
        $this->db->where('a.gl_trx_hdr_journal_no', $trx_no);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }
    }
    
    function get_data_cash_bank_by_trx_no($trx_no)
    {
        $this->db->select('*');
        $this->db->from('cb_trx_cg');
        $this->db->where('deleted', 0);
        $this->db->where('trx_no', $trx_no);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }
    }
    
    function get_data_cash_bank_detail_by_trx_no($trx_no)
    {
        $this->db->select('*');
        $this->db->from('cb_trx_dtl');
        $this->db->where('deleted', 0);
        $this->db->where('trx_no', $trx_no);
        $this->db->order_by('advance_invoice_no','asc');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else
        {
            return null;
        }
    }
    
    function get_data_cash_bank_advance_by_trx_no($trx_no)
    {
        $this->db->select("a.trx_no, a.advance_invoice_no, b.cg_amt");
        $this->db->from('cb_trx_dtl as a');
        $this->db->join('cb_trx_cg as b', 'a.trx_no = b.trx_no');
        $this->db->where('a.advance_invoice_type', 'advance');
        $this->db->where('b.payment_method', 'cash');
        $this->db->where('a.advance_invoice_no', $trx_no);
        $this->db->where('a.deleted', 0);
        $this->db->where('b.deleted', 0);
        $this->db->order_by('a.trx_no', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }

    }    

    function get_account()
    {
        $this->db->select('g.*');
        $this->db->from('gl_coa as g ');
        $this->db->where('g.deleted', 0);
        //$this->db->where('g.is_cash =', 'Y');
        //$this->db->or_where('g.is_bank =', 'Y');
        $this->db->order_by('g.rowID', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    
    function get_debtors()
    {
        $this->db->select('*');
        $this->db->from('sa_debtor');
        $this->db->where('deleted', 0);
        $this->db->order_by('type, debtor_cd', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    
    function get_creditors()
    {
        $this->db->select('*');
        $this->db->from('sa_creditor');
        $this->db->where('deleted', 0);
        $this->db->order_by('creditor_name', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    
    function get_all_cash_advance_list()
    {
        $this->db->select('a.*,
							b.by_jo as by_jo,
							b.only_driver as only_driver,
							b.fare_trip as fare_trip,
							b.advance_name,
							c.debtor_cd as debtor_code,
							c.debtor_name as debtor_name,
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
        $this->db->order_by('a.advance_no', 'desc');

        return $this->db->get()->result();

    }
    
    function get_all_realization_list()
    {
        $this->db->select('a.alloc_no, a.alloc_date, a.descs, a.alloc_amt,
                            b.prefix, b.year, b.month, b.code, b.advance_no, b.advance_amount, b.advance_extra_amount, b.employee_driver_rowID,
                            c.debtor_cd, c.debtor_name, d.police_no');
        $this->db->from('cb_cash_adv_alloc as a');
        $this->db->join('cb_cash_adv AS b', 'b.advance_no=a.cb_cash_adv_no', 'LEFT');
        $this->db->join('sa_debtor AS c', 'c.rowID=b.employee_driver_rowID', 'LEFT');
        $this->db->join('sa_vehicle AS d', 'd.rowID=b.vehicle_rowID', 'LEFT');
        $this->db->where('a.deleted', 0);
        $this->db->where('a.alloc_mode', 'R');
        $this->db->order_by('a.alloc_no', 'desc');

        return $this->db->get()->result();

    }
    
    function get_all_refund_list()
    {
        $this->db->select('a.alloc_no, a.alloc_date, a.descs, a.alloc_amt,  
                            b.prefix, b.year, b.month, b.code, b.advance_no, b.advance_amount, b.advance_extra_amount, b.employee_driver_rowID,
                            c.debtor_cd, c.debtor_name, d.police_no');
        $this->db->from('cb_cash_adv_alloc as a');
        $this->db->join('cb_cash_adv AS b', 'b.advance_no=a.cb_cash_adv_no', 'LEFT');
        $this->db->join('sa_debtor AS c', 'c.rowID=b.employee_driver_rowID', 'LEFT');
        $this->db->join('sa_vehicle AS d', 'd.rowID=b.vehicle_rowID', 'LEFT');
        $this->db->where('a.deleted', 0);
        $this->db->where('a.alloc_mode', 'F');
        $this->db->order_by('a.alloc_no', 'desc');

        return $this->db->get()->result();

    }
    
    function get_all_invoice_list()
    {
        $this->db->select("a.*,
                CONCAT(b.debtor_cd,' - ',b.debtor_name) AS debtor_name", false);
        $this->db->from('ar_trx_hdr as a');
        $this->db->join('sa_debtor as b', 'b.rowID = a.debtor_rowID',
            'left');
        $this->db->where('a.deleted', 0);
        $this->db->order_by('a.trx_no', 'desc');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }

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
        $this->db->where('a.status <>', 1);
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
    
    function get_all_ar_list()
    {
        $this->db->select("*", false);
        $this->db->from('cb_trx_hdr');
        $this->db->where('transaction_type', 'ar');
        $this->db->where('deleted', 0);
        $this->db->order_by('trx_no', 'desc');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }

    }
    
    function get_all_ap_list()
    {
        $this->db->select("a.*,
                CONCAT(b.creditor_cd,' - ',b.creditor_name) AS creditor_name, c.descs as creditor_type", false);
        $this->db->from('ap_trx_hdr as a');
        $this->db->join('sa_creditor as b', 'b.rowID = a.creditor_rowID',
            'left');
        $this->db->join('sa_creditor_type as c', 'c.rowID = a.ap_type',
            'left');
        $this->db->where('a.ap_kb_type', 'ap');
        $this->db->where('a.deleted', 0);
        $this->db->order_by('a.trx_no', 'desc');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }

    }
    
    function get_all_kb_list()
    {
        $this->db->select("a.*,
                CONCAT(b.creditor_cd,' - ',b.creditor_name) AS creditor_name, c.descs as creditor_type", false);
        $this->db->from('ap_trx_hdr as a');
        $this->db->join('sa_creditor as b', 'b.rowID = a.creditor_rowID',
            'left');
        $this->db->join('sa_creditor_type as c', 'c.rowID = a.ap_type',
            'left');
        $this->db->where('a.ap_kb_type', 'kb');
        $this->db->where('a.deleted', 0);
        $this->db->order_by('a.trx_no', 'desc');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }

    }
    
    function get_all_advance_list()
    {
        $this->db->select("a.*, b.debtor_cd, b.debtor_name, c.advance_name, d.creditor_cd, d.creditor_name",false);
		$this->db->from('tr_advance_trx_hdr as a');
		$this->db->join('sa_debtor as b', 'b.rowID = a.debtor_rowID');
		$this->db->join('sa_advance_category as c', 'c.rowID = a.advance_type_rowID');
		$this->db->join('sa_creditor as d', 'd.rowID = a.dp_creditor_rowID','left');
        $this->db->where('a.deleted', 0);
        $this->db->order_by('a.rowID','desc');

        $query=$this->db->get();
        
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}

    }
    
    function get_all_reimburse_list()
    {
        $this->db->select("a.*, b.advance_name",false);
		$this->db->from('tr_reimburse_trx_hdr as a');
		$this->db->join('sa_advance_category as b', 'b.rowID = a.advance_type_rowID');
        $this->db->where('a.deleted', 0);
        $this->db->order_by('a.rowID','desc');

        $query=$this->db->get();
        
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}

    }
    
    function get_all_deposit_list()
    {
        $this->db->select("a.*,
                CONCAT(b.debtor_cd,' - ',b.debtor_name) AS debtor_name, b.type", false);
        $this->db->from('tr_deposit_trx as a');
        $this->db->join('sa_debtor as b', 'b.rowID = a.debtor_rowID',
            'left');
        $this->db->where('a.deleted', 0);
        $this->db->order_by('a.deposit_number', 'desc');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }

    }
    
    function get_all_commission_list()
    {
        $this->db->select('*');
        $this->db->from('tr_commission_trx');
        $this->db->where('deleted', 0);
        $this->db->order_by('rowID','desc');
        $query=$this->db->get();
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}

    }
    
    function get_all_cash_in_list()
    {
        $this->db->select('a.*, b.trx_no, b.trx_date, b.descs, c.acc_name');
        $this->db->from('cb_trx_cg as a');
        $this->db->join('cb_trx_hdr as b','a.trx_no = b.trx_no','left');
        $this->db->join('gl_coa as c','a.cash_bank = c.rowID','left');
        $this->db->where('a.payment_method','cash');
        $this->db->where('a.deleted',0);
        $this->db->where('b.deleted',0);
        $this->db->where('b.payment_type','R');
        $this->db->where('c.is_cb','N');
        $this->db->where('c.cash_branch',0);        
        $this->db->order_by('a.rowID','desc');
        $query=$this->db->get();
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_all_cash_out_list()
    {
        $this->db->select('a.*, b.trx_no, b.trx_date, b.descs, c.acc_name');
        $this->db->from('cb_trx_cg as a');
        $this->db->join('cb_trx_hdr as b','a.trx_no = b.trx_no','left');
        $this->db->join('gl_coa as c','a.cash_bank = c.rowID','left');
        $this->db->where('a.payment_method','cash');
        $this->db->where('a.deleted',0);
        $this->db->where('b.deleted',0);
        $this->db->where('b.payment_type','P');
        $this->db->where('c.cash_branch',0);        
        $this->db->order_by('a.rowID','desc');
        $query=$this->db->get();
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_all_bank_in_list()
    {
        $sql = "SELECT a.*, b.trx_no, b.trx_date, b.descs, c.acc_name, c.is_cb
                FROM cb_trx_cg as a LEFT JOIN cb_trx_hdr as b ON a.trx_no = b.trx_no
                                    LEFT JOIN gl_coa as c ON a.cash_bank = c.rowID 
                WHERE a.deleted = 0 AND b.deleted = 0 AND b.payment_type = 'R' AND (a.payment_method = 'cash' OR a.payment_method = 'cheque' OR a.payment_method = 'transfer' 
                                OR a.payment_method = 'credit' OR a.payment_method = 'giro') AND a.status = 1 AND a.reference_release_no = ''
                ORDER BY a.rowID DESC
            ";
        $query=$this->db->query($sql);
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_all_bank_out_list()
    {
        $sql = "SELECT a.*, b.trx_no, b.trx_date, b.descs, c.acc_name 
                FROM cb_trx_cg as a LEFT JOIN cb_trx_hdr as b ON a.trx_no = b.trx_no
                                    LEFT JOIN gl_coa as c ON a.cash_bank = c.rowID
                WHERE a.deleted = 0 AND b.deleted = 0 AND b.payment_type = 'P' AND (a.payment_method = 'cheque' OR a.payment_method = 'transfer' 
                                OR a.payment_method = 'credit' OR a.payment_method = 'giro') AND a.status = 1 AND a.reference_release_no = ''
                ORDER BY a.rowID DESC
            ";
        $query=$this->db->query($sql);
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_all_outstanding_bank_in_list()
    {
        $sql = "SELECT a.*, b.trx_no, b.trx_date, b.descs, c.acc_name, c.is_cb
                FROM cb_trx_cg as a LEFT JOIN cb_trx_hdr as b ON a.trx_no = b.trx_no
                                    LEFT JOIN gl_coa as c ON a.cash_bank = c.rowID
                WHERE a.deleted = 0 AND b.deleted = 0 AND b.payment_type = 'R' AND (a.payment_method = 'cash' OR a.payment_method = 'cheque' OR a.payment_method = 'transfer' 
                                OR a.payment_method = 'credit' OR a.payment_method = 'giro') AND a.status = 0 AND a.reference_release_no = ''
                ORDER BY a.rowID DESC
            ";
        $query=$this->db->query($sql);
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_all_outstanding_bank_out_list()
    {
        $sql = "SELECT a.*, b.trx_no, b.trx_date, b.descs, c.acc_name 
                FROM cb_trx_cg as a LEFT JOIN cb_trx_hdr as b ON a.trx_no = b.trx_no
                                    LEFT JOIN gl_coa as c ON a.cash_bank = c.rowID
                WHERE a.deleted = 0 AND b.deleted = 0 AND b.payment_type = 'P' AND (a.payment_method = 'cheque' OR a.payment_method = 'transfer' 
                                OR a.payment_method = 'credit' OR a.payment_method = 'giro') AND a.status = 0 AND a.reference_release_no = ''
                ORDER BY a.rowID DESC
            ";
        $query=$this->db->query($sql);
        if ($query->num_rows() > 0){
			return $query->result();
		} else{
			return NULL;
		}
    }
    
    function get_by_id_table($table,$id)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('rowID =', $id);
        $query = $this->db->get();
        return $query->row();
    }
    
    function save_gl_header($sa_spec_prefix, $new_gl_coa_code, $gl_coa_no, $reference_no, $reference_date, $dataPost)
    {
        
        $trx_amt = str_replace('.','',$dataPost['trx_amt']);
        $amount = str_replace(',','.',$trx_amt);
        
        if($dataPost['user_created'] == '' && $dataPost['date_created'] == ''){
            /*
            if(date('Y-m-d',strtotime($dataPost['gl_date'])) != date('Y-m-d')){
                $gl_date = date('Y-m-d');
            }
            else{
                $gl_date = date('Y-m-d',strtotime($dataPost['gl_date']));
            }
            */
            
            $gl_date = date('Y-m-d',strtotime($dataPost['gl_date']));
            
            $year = date('Y',strtotime($gl_date));
            $month = date('m',strtotime($gl_date));
           
            $gl_trx_hdr_data = array(
                'prefix' => $sa_spec_prefix,
                'year' => $year,
                'month' => $month,
                'code' => $new_gl_coa_code,
                'journal_no' => $gl_coa_no,
                'journal_date' => $gl_date,
                'journal_type' => $dataPost['gl_type'],
                'creditor_type_rowID' => $dataPost['ap_type'],
                'descs' => $dataPost['gl_remark'],
                'trx_amt' => $amount,
                'ref_no' => $reference_no,
                'ref_date' => $reference_date,
                'user_created' => $this->session->userdata('user_rowID'),
                'date_created' => $gl_date,
                'time_created' => date('H:i:s')
            );
                
            $result = $this->db->insert('gl_trx_hdr', $gl_trx_hdr_data);
        }
        else{
            $gl_date = date('Y-m-d',strtotime($dataPost['gl_date']));
            $year = date('Y',strtotime($gl_date));
            $month = date('m',strtotime($gl_date));
            
            if($dataPost['verified_status'] == 1){
                if(!empty($dataPost['verified'])){
                    $verified = 2;   
                    $user_verified = $this->session->userdata('user_rowID');
    				$date_verified = date('Y-m-d');
    				$time_verified = date('H:i:s');                                 
                }
                else{
                    $verified = $dataPost['verified_status'];                                    
                    $user_verified = $dataPost['user_verified'];
    				$date_verified = $dataPost['date_verified'];
    				$time_verified = $dataPost['time_verified'];                                 
                }
            }
            else{
                if(!empty($dataPost['verified'])){
                    $verified = 1;                                    
                    $user_verified = $this->session->userdata('user_rowID');
    				$date_verified = date('Y-m-d');
    				$time_verified = date('H:i:s');                                 
                }
                else{
                    $verified = $dataPost['verified_status'];                                    
                    $user_verified = $dataPost['user_verified'];
    				$date_verified = $dataPost['date_verified'];
    				$time_verified = $dataPost['time_verified'];                                 
                }
            }
                    
            $gl_trx_hdr_data = array(
                'prefix' => $sa_spec_prefix,
                'year' => $year,
                'month' => $month,
                'code' => $new_gl_coa_code,
                'journal_no' => $gl_coa_no,
                'journal_date' => $gl_date,
                'journal_type' => $dataPost['gl_type'],
                'creditor_type_rowID' => $dataPost['ap_type'],
                'descs' => $dataPost['gl_remark'],
                'trx_amt' => $amount,
                'ref_no' => $reference_no,
                'ref_date' => $reference_date,
				'verified' => $verified,
                'user_verified'     =>$user_verified,
				'date_verified'     =>$date_verified,
				'time_verified'     =>$time_verified,
                'user_created'      =>$dataPost['user_created'],
                'date_created'      =>$dataPost['date_created'],
                'time_created'      =>$dataPost['time_created'],
				'user_modified'     =>$this->session->userdata('user_rowID'),
				'date_modified'     =>date('Y-m-d'),
				'time_modified'     =>date('H:i:s')
            );
                    
            $result = $this->db->insert('gl_trx_hdr', $gl_trx_hdr_data);
        }
        
        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }
    
    function save_gl_detail_debit($sa_spec_prefix, $new_gl_coa_code, $gl_coa_no, $cash_bank, $descs, $trx_amt, $debtor_creditor_type, $reference_debtor_creditor_id, $reference_no, 
            $reference_date, $dataPost)
    {   
        
        $trx_amt_tmp = str_replace('.','',$trx_amt);
        $amount = str_replace(',','.',$trx_amt_tmp);
        
        if($dataPost['user_created'] == '' && $dataPost['date_created'] == ''){
            /*
            if(date('Y-m-d',strtotime($dataPost['gl_date'])) != date('Y-m-d')){
                $gl_date = date('Y-m-d');
            }
            else{
                $gl_date = date('Y-m-d',strtotime($dataPost['gl_date']));
            }
            */
            
            $gl_date = date('Y-m-d',strtotime($dataPost['gl_date']));
            
            $year = date('Y',strtotime($gl_date));
            $month = date('m',strtotime($gl_date));
            
            $gl_trx_dtl_d_data = array(
                'gl_trx_hdr_prefix' => $sa_spec_prefix,
                'gl_trx_hdr_year' => $year,
                'gl_trx_hdr_month' => $month,
                'gl_trx_hdr_code' => $new_gl_coa_code,
                'row_no' => 1,
                'gl_trx_hdr_journal_no' => $gl_coa_no,
                'gl_trx_hdr_journal_date' => $gl_date,
                'coa_rowID' => $cash_bank,
                'descs' => $descs,
                'trx_amt' => $amount,
                'dep_rowID' => $this->session->userdata('dep_rowID'),
                'debtor_creditor_type' => $debtor_creditor_type,
                'debtor_creditor_rowID' => $reference_debtor_creditor_id,
                'gl_trx_hdr_ref_no' => $reference_no,
                'gl_trx_hdr_ref_date' => $reference_date,
                'modul' => 'CB',
                'cash_flow' => 'Y',
                'base_amt' => 0,
                'tax_no' => '',
                'user_created' => $this->session->userdata('user_rowID'),
                'date_created' => $gl_date,
                'time_created' => date('H:i:s')
            );
            
            $result = $this->db->insert('gl_trx_dtl', $gl_trx_dtl_d_data);
        }
        else{
            $gl_date = date('Y-m-d',strtotime($dataPost['gl_date']));
            $year = date('Y',strtotime($gl_date));
            $month = date('m',strtotime($gl_date));
            
            $gl_trx_dtl_d_data = array(
                'gl_trx_hdr_prefix' => $sa_spec_prefix,
                'gl_trx_hdr_year' => $year,
                'gl_trx_hdr_month' => $month,
                'gl_trx_hdr_code' => $new_gl_coa_code,
                'row_no' => 1,
                'gl_trx_hdr_journal_no' => $gl_coa_no,
                'gl_trx_hdr_journal_date' => $gl_date,
                'coa_rowID' => $cash_bank,
                'descs' => $descs,
                'trx_amt' => $amount,
                'dep_rowID' => $this->session->userdata('dep_rowID'),
                'debtor_creditor_type' => $debtor_creditor_type,
                'debtor_creditor_rowID' => $reference_debtor_creditor_id,
                'gl_trx_hdr_ref_no' => $reference_no,
                'gl_trx_hdr_ref_date' => $reference_date,
                'modul' => 'CB',
                'cash_flow' => 'Y',
                'base_amt' => 0,
                'tax_no' => '',
                'user_created'      =>$dataPost['user_created'],
                'date_created'      =>$dataPost['date_created'],
                'time_created'      =>$dataPost['time_created'],
				'user_modified'     =>$this->session->userdata('user_rowID'),
				'date_modified'     =>date('Y-m-d'),
				'time_modified'     =>date('H:i:s')
            );
            
            $result = $this->db->insert('gl_trx_dtl', $gl_trx_dtl_d_data);
        }
        
        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
        
    }
    
    function save_gl_detail_credit($sa_spec_prefix, $new_gl_coa_code, $gl_coa_no, $cash_bank, $descs, $trx_amt, $debtor_creditor_type, $reference_debtor_creditor_id, $reference_no, 
            $reference_date, $dataPost)
    {   
        $trx_amt_tmp = str_replace('.','',$trx_amt);
        $amount = str_replace(',','.',$trx_amt_tmp);
        
        if($dataPost['user_created'] == '' && $dataPost['date_created'] == ''){
            /*
            if(date('Y-m-d',strtotime($dataPost['gl_date'])) != date('Y-m-d')){
                $gl_date = date('Y-m-d');
            }
            else{
                $gl_date = date('Y-m-d',strtotime($dataPost['gl_date']));
            }
            */
            
            $gl_date = date('Y-m-d',strtotime($dataPost['gl_date']));
            
            $year = date('Y',strtotime($gl_date));
            $month = date('m',strtotime($gl_date));
            
            $gl_trx_dtl_d_data = array(
                'gl_trx_hdr_prefix' => $sa_spec_prefix,
                'gl_trx_hdr_year' => $year,
                'gl_trx_hdr_month' => $month,
                'gl_trx_hdr_code' => $new_gl_coa_code,
                'row_no' => 2,
                'gl_trx_hdr_journal_no' => $gl_coa_no,
                'gl_trx_hdr_journal_date' => $gl_date,
                'coa_rowID' => $cash_bank,
                'descs' => $descs,
                'trx_amt' => $amount * -1,
                'dep_rowID' => $this->session->userdata('dep_rowID'),
                'debtor_creditor_type' => $debtor_creditor_type,
                'debtor_creditor_rowID' => $reference_debtor_creditor_id,
                'gl_trx_hdr_ref_no' => $reference_no,
                'gl_trx_hdr_ref_date' => $reference_date,
                'modul' => 'CB',
                'cash_flow' => 'Y',
                'base_amt' => 0,
                'tax_no' => '',
                'user_created' => $this->session->userdata('user_rowID'),
                'date_created' => $gl_date,
                'time_created' => date('H:i:s')
            );
            
            $result = $this->db->insert('gl_trx_dtl', $gl_trx_dtl_d_data);
        }
        else{
            $gl_date = date('Y-m-d',strtotime($dataPost['gl_date']));
            $year = date('Y',strtotime($gl_date));
            $month = date('m',strtotime($gl_date));
    
            $gl_trx_dtl_d_data = array(
                'gl_trx_hdr_prefix' => $sa_spec_prefix,
                'gl_trx_hdr_year' => $year,
                'gl_trx_hdr_month' => $month,
                'gl_trx_hdr_code' => $new_gl_coa_code,
                'row_no' => 2,
                'gl_trx_hdr_journal_no' => $gl_coa_no,
                'gl_trx_hdr_journal_date' => $gl_date,
                'coa_rowID' => $cash_bank,
                'descs' => $descs,
                'trx_amt' => $amount * -1,
                'dep_rowID' => $this->session->userdata('dep_rowID'),
                'debtor_creditor_type' => $debtor_creditor_type,
                'debtor_creditor_rowID' => $reference_debtor_creditor_id,
                'gl_trx_hdr_ref_no' => $reference_no,
                'gl_trx_hdr_ref_date' => $reference_date,
                'modul' => 'CB',
                'cash_flow' => 'Y',
                'base_amt' => 0,
                'tax_no' => '',
                'user_created'      =>$dataPost['user_created'],
                'date_created'      =>$dataPost['date_created'],
                'time_created'      =>$dataPost['time_created'],
				'user_modified'     =>$this->session->userdata('user_rowID'),
				'date_modified'     =>date('Y-m-d'),
				'time_modified'     =>date('H:i:s')
            );
            
            $result = $this->db->insert('gl_trx_dtl', $gl_trx_dtl_d_data);
        }
        
        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
        
    }
    
    function simpan_data_detail_do($sa_spec_prefix, $alloc_code, $alloc_no, $dataPost, $detDO = array())
    {
        if($dataPost['user_created'] == '' && $dataPost['date_created'] == ''){
            /*
            if(date('Y-m-d',strtotime($dataPost['ap_date'])) != date('Y-m-d')){
                $ap_date = date('Y-m-d');
            }
            else{
                $ap_date = date('Y-m-d',strtotime($dataPost['ap_date']));
            }
            */
            $ap_date = date('Y-m-d',strtotime($dataPost['gl_date']));
            
            $year = date('Y',strtotime($ap_date));
            $month = date('m',strtotime($ap_date));
            
            $data = array(
                'prefix' => $sa_spec_prefix,
                'year' => $year,
                'month' => $month,
                'code' => $alloc_code,
                'trx_no' => $alloc_no,
                'jo_no' => $detDO['do_jo_no'],
                'tr_jo_trx_hdr_year' => $detDO['jo_year'],
                'tr_jo_trx_hdr_month' => $detDO['jo_month'],
                'tr_jo_trx_hdr_code' => $detDO['jo_code'],
                'do_no' => $detDO['do_no'],
                'count_container' => empty($detDO['ContType']) ? 0 : 1,
                'container_size' => empty($detDO['ContType']) ? '' : $detDO['ContType'],
                'container_no' => empty($detDO['container_no']) ? '' : $detDO['container_no'],
                'police_no' => strtoupper($detDO['police_no']),
                'do_date' => date('Y-m-d', strtotime($detDO['do_date'])),
                'deliver_date' => date('Y-m-d', strtotime($detDO['do_date'])),
                'deliver_weight' => $detDO['do_weight'],
                'received_date' => date('Y-m-d', strtotime($detDO['received_date'])),
                'received_weight' => $detDO['received_weight'],
                'amount_ap'   =>str_replace('.','',$detDO['amount_ap']),
                'status' => 0,
                'user_created' => $this->session->userdata('user_rowID'),
                'date_created' => $ap_date,
                'time_created' => date('H:i:s'));
            $result = $this->db->insert('ap_trx_dtl_do', $data);
        }
        else{
            $ap_date = date('Y-m-d',strtotime($dataPost['gl_date']));
            $year = date('Y',strtotime($ap_date));
            $month = date('m',strtotime($ap_date));
            
            $data = array(
                'prefix' => $sa_spec_prefix,
                'year' => $year,
                'month' => $month,
                'code' => $alloc_code,
                'trx_no' => $alloc_no,
                'jo_no' => $detDO['do_jo_no'],
                'tr_jo_trx_hdr_year' => $detDO['jo_year'],
                'tr_jo_trx_hdr_month' => $detDO['jo_month'],
                'tr_jo_trx_hdr_code' => $detDO['jo_code'],
                'do_no' => $detDO['do_no'],
                'count_container' => empty($detDO['ContType']) ? 0 : 1,
                'container_size' => empty($detDO['ContType']) ? '' : $detDO['ContType'],
                'container_no' => empty($detDO['container_no']) ? '' : $detDO['container_no'],
                'police_no' => strtoupper($detDO['police_no']),
                'do_date' => date('Y-m-d', strtotime($detDO['do_date'])),
                'deliver_date' => date('Y-m-d', strtotime($detDO['do_date'])),
                'deliver_weight' => $detDO['do_weight'],
                'received_date' => date('Y-m-d', strtotime($detDO['received_date'])),
                'received_weight' => $detDO['received_weight'],
                'amount_ap'   =>str_replace('.','',$detDO['amount_ap']),
                'status' => 0,
                'user_created'      =>$dataPost['user_created'],
                'date_created'      =>$dataPost['date_created'],
                'time_created'      =>$dataPost['time_created'],
				'user_modified'     =>$this->session->userdata('user_rowID'),
				'date_modified'     =>date('Y-m-d'),
				'time_modified'     =>date('H:i:s')
            );
            $result = $this->db->insert('ap_trx_dtl_do', $data);
        }
        if ($result)
        {
            return true;
        } else
        {
            return false;
        }
    }
    
    function delete_data_header($gl_no)
    {

        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));
        $this->db->where('deleted', 0);
        $this->db->where('journal_no', $gl_no);
        return $this->db->update('gl_trx_hdr');

    }
    
    function get_verify_user_by_status($verified_status)
    {
        $this->db->select('a.user_rowID, b.password');
        $this->db->from('sa_usermenu as a');
        $this->db->join('sa_users as b', 'a.user_rowID = b.rowID');
        $this->db->where('a.StatusUsermenu', '1');
        if($verified_status == 0){
            $this->db->where('a.verified', 1);
        }
        else{
            $this->db->where('a.verified_second', 1);
        }
        $this->db->where('a.kd_menu', 101); // 101 => Menu Journal
        $this->db->where('b.activated', 1);
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

    function verify_data($gl_no)
    {

        $this->db->set('verified', 1);
        $this->db->set('user_verified', $this->session->userdata('user_id'));
        $this->db->set('date_verified', date('Y-m-d'));
        $this->db->set('time_verified', date('H:i:s'));
        $this->db->where('deleted', 0);
        $this->db->where('journal_no', $gl_no);
        return $this->db->update('gl_trx_hdr');

    }
    
    function delete_data_detail($gl_no)
    {

        $this->db->set('deleted', 1);
        $this->db->set('user_deleted', $this->session->userdata('user_id'));
        $this->db->set('date_deleted', date('Y-m-d'));
        $this->db->set('time_deleted', date('H:i:s'));
        $this->db->where('deleted', 0);
        $this->db->where('gl_trx_hdr_journal_no', $gl_no);
        return $this->db->update('gl_trx_dtl');

    }

    function delete_ap_trx_dtl_do($trx_no){
        $this->db->set('deleted',1);
        $this->db->set('user_deleted',$this->session->userdata('user_rowID'));
        $this->db->set('date_deleted',date('Y-m-d'));
        $this->db->set('time_deleted',date('H:i:s'));
        $this->db->where('deleted',0);
        $this->db->where('trx_no',$trx_no);
        $result=$this->db->update('ap_trx_dtl_do');
        if ($result){
            return true;
        }else{
            return false;
        } 
        
    }
    
}

/* End of file model.php */
