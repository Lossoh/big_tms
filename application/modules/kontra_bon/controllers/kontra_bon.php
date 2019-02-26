<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Kontra_bon extends MX_Controller
{

    function __construct(){
        parent::__construct();
        
        $this->load->model('kontra_bon_model');
        $this->load->model('appmodel');
        $this->load->model('creditor/creditor_model');
        $this->load->library('pdf_generator');
        $this->load->library('MoneyFormat');
    }
    
    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('kontra_bons') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('kontra_bons');
        $this->session->set_userdata('page_header', 'transaction');
        $this->session->set_userdata('page_detail', 'kontra_bon');
        $data['datatables'] = true;
        $data['form'] = true;
        
        if($this->session->userdata('start_date_ap') == '' ){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_ap')));
        }

        if($this->session->userdata('end_date_ap') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_ap')));
        }

        // if($this->session->userdata('start_date') == '' && $this->session->userdata('end_date') == ''){
        //     $start_date = date("Y-m-d",strtotime("yesterday"));
        //     $end_date = date("Y-m-d");
        // }
        // else{
        //     $start_date = $this->session->userdata('start_date');
        //     $end_date = $this->session->userdata('end_date');
        // }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        
        // $data['aps'] = $this->kontra_bon_model->get_all_record_data($start_date,$end_date);
        $data['cash_advance_jo'] =$this->kontra_bon_model->get_data_cash_advance_jo();
        $data['creditor_types'] = $this->creditor_model->get_all_records($table =
            'sa_creditor_type', $array = array('rowID >' => '0', 'deleted' => '0'), $join_table =
            '', $join_criteria = '', 'type_cd', 'asc');
        $data['references'] = $this->creditor_model->get_all_records($table =
            'sa_reference', $array = array('type_ref' => 'top_kb'), $join_table =
            '', $join_criteria = '', 'type_no', 'asc');
            
        $this->template->set_layout('users')->build('kontra_bons', isset($data) ? $data : null);
    }
    
    function set_filter(){
       $this->session->set_userdata('start_date_ap',date("Y-m-d",strtotime($this->input->post('start_date'))));
       $this->session->set_userdata('end_date_ap',date("Y-m-d",strtotime($this->input->post('end_date'))));    
       
       redirect(base_url().'kontra_bon');
    }

    function get_data_header(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $trx_no = $this->input->post('trx_no');
        $data = $this->kontra_bon_model->get_data_header($trx_no);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($data);
        exit;
        
    }

    function get_data_detail(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $trx_no = $this->input->get('trx_no');
        $data = $this->kontra_bon_model->get_data_detail($trx_no);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($data);
        exit;
        
    }
    
    function get_data_jo(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $jo_no = $this->input->post('jo_no');
        $data = $this->kontra_bon_model->get_data_jo($jo_no);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($data);
        exit;
        
    }
    
    function check_data_do(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $do_no = $this->input->post('do_no');
        $data = $this->kontra_bon_model->get_data_do($do_no);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($data);
        exit;
        
    }
    
    function get_data_supplier(){
        $ap_type = $this->input->post('ap_type');

        $creditor = $this->kontra_bon_model->get_all_records('sa_creditor', $array =
            array('rowID >' => 0, 'deleted' => 0, 'creditor_type_rowID' => $ap_type), $join_table = '', $join_criteria = '', 'creditor_name', 'asc');
        
        echo '<option value="">- Select Supplier -</option>';
        if (!empty($creditor)) {
            foreach ($creditor as $rs) {
		      echo '<option value="'.$rs->rowID.'">'.$rs->creditor_name.' - '.$rs->creditor_cd.'</option>';
            }
        }
        
        exit;
    }
    
    function get_data_due_date(){
        $top = $this->input->post('top');
        
        if($top == "")
            echo date('d-m-Y');
        else
            echo date('d-m-Y', strtotime('+'.$top.' days'));
        
        exit;
    }
    
    function print_ap($trx_no){
        $get_data = $this->kontra_bon_model->get_detail_header($trx_no);
        $data['get_data'] = $get_data;
         
        $sql_update = "UPDATE ap_trx_hdr 
                        SET printed = printed + 1, user_printed = ".$this->session->userdata('user_rowID').",
                            date_printed = '".date('Y-m-d')."', time_printed = '".date('H:i:s')."'
                        WHERE trx_no = '".$trx_no."' AND deleted = 0";
        
        $this->db->query($sql_update);
        
        $params['user_rowID'] = $this->tank_auth->get_user_id();
		$params['module'] = 'Kontra Bon';
		$params['module_field_id'] = $get_data->rowID;
		$params['activity'] = ucfirst('Print a Kontra Bon No. '.$trx_no);
		$params['icon'] = 'fa-print';
		modules::run('activitylog/log',$params); //log activity	
        
        $html = $this->load->view('kontra_bon_pdf', $data, true);
        
        $this->pdf_generator->generate($html, 'Kontra Bon pdf',$orientation='Portrait');    
    }
    
    function save_ap(){
        $dataPost = $this->input->post();
        //echo "<pre>";print_r($dataPost);echo "</pre>";exit();
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $error = false;
        $this->db->trans_begin();
        $trx_no = $this->input->post('ap_no');
        $row_id = $this->input->post('row_id');
        $code = $this->input->post('code'); 
        /*
        if(date('Y-m-d',strtotime($dataPost['ap_date'])) != date('Y-m-d')){
            $alloc_date = date('Y-m-d');
        }
        else{
            $alloc_date = date('Y-m-d',strtotime($dataPost['ap_date']));
        }
        */
        $alloc_date = date('Y-m-d',strtotime($dataPost['ap_date']));
        
        $alloc_date_year = date('Y',strtotime($alloc_date));
        $alloc_date_month = date('m',strtotime($alloc_date));

        $sa_spec = $this->db->get_where('sa_spec', array('deleted' => 0, 'rowID' => 1))->
            row_array();
        $sa_spec_prefix = $sa_spec['kontra_bon'];
        
        if($trx_no != '' || $row_id != '' || $code != ''){
            $this->kontra_bon_model->delete_ap_hdr($trx_no); 
            $this->kontra_bon_model->delete_ap_trx_dtl_do($trx_no); 
            $this->kontra_bon_model->delete_gl_header($trx_no); 
            $this->kontra_bon_model->delete_gl_detail($trx_no); 
            
            $alloc_code = $code;
            $alloc_no = $trx_no;
            
        }
        else{
            $alloc_code = ((int)$this->appmodel->select_max_id('ap_trx_hdr', $array =
                array(
                'prefix' => $sa_spec_prefix,
                'year' => $alloc_date_year,
                'month' => $alloc_date_month,
                'deleted' => 0), 'code')) + 1;
            $alloc_no = $sa_spec_prefix . sprintf("%04s", $alloc_date_year) . sprintf("%02s",
                $alloc_date_month) . sprintf("%05s", $alloc_code);
        }
        
        $sa_spec_prefix_gl = $sa_spec['general_jrn'];
                    
        $new_gl_coa_code = ((int)$this->appmodel->select_max_id('gl_trx_hdr', $array =
            array(
            'prefix' => $sa_spec_prefix_gl,
            'year' => $alloc_date_year,
            'month' => $alloc_date_month,
            'deleted' => 0), 'code')) + 1;
        $gl_coa_no = $sa_spec_prefix_gl . sprintf("%04s", $alloc_date_year) . sprintf("%02s",
            $alloc_date_month) . sprintf("%05s", $new_gl_coa_code);

        $creditor_type_rowID = $this->appmodel->get_id($table = 'sa_creditor', $array =
            array('deleted' => 0, 'rowID' => $dataPost['creditor_id']), 'creditor_type_rowID');
        $payable_rowID = $this->appmodel->get_id($table = 'sa_creditor_type', $array =
            array('deleted' => 0, 'rowID' => $creditor_type_rowID), 'payable_coa_rowID');
        $advance_coa_rowID = $this->appmodel->get_id($table = 'sa_creditor_type', $array =
            array('deleted' => 0, 'rowID' => $creditor_type_rowID), 'advance_coa_rowID');
            
        //$cash_advance_rowID = $dataPost['cash_advance_type_id'];
        //$cash_advance_rowID = substr($cash_advance_rowID, 0, strlen($cash_advance_rowID) - 1);
        //$advance_name = $this->appmodel->get_id($table = 'sa_advance_type', $array = array('deleted' => 0, 'rowID' => $cash_advance_rowID), 'advance_name');

        $cash_out_prefix_cd = $this->appmodel->get_id($table = 'sa_dep', $array = array
            ('deleted' => 0, 'rowID' => $this->session->userdata('dep_rowID')),
            'cash_out_prefix');
        $cash_out_year = date('Y',strtotime($alloc_date));
        $cash_out_month = date('m',strtotime($alloc_date));
        $creditor_name = $this->appmodel->get_id($table = 'sa_creditor', $array = array('deleted' =>
                0, 'rowID' => $dataPost['creditor_id']), 'creditor_name');
        
        $new_cash_advance_code = ((int)$this->appmodel->select_max_id('cb_cash_adv', $array =
            array(
            'prefix' => $cash_out_prefix_cd,
            'year' => $cash_out_year,
            'month' => $cash_out_month), 'code')) + 1;

        $cash_advance_no = $cash_out_prefix_cd . sprintf("%04s", $cash_out_year) .
            sprintf("%02s", $cash_out_month) . sprintf("%05s", $new_cash_advance_code);
        

        // simpan data header ap
        $result = $this->kontra_bon_model->simpan_ap_hdr($sa_spec_prefix, $alloc_code, $alloc_no, $dataPost); 

        if ($error == false)
        {    
            /*
            $result = $this->kontra_bon_model->save_gl_header($sa_spec_prefix_gl, $new_gl_coa_code, $gl_coa_no, $alloc_no, $alloc_date, $dataPost);          
            if ($result){
                
                $get_creditor = $this->kontra_bon_model->get_by_id('sa_creditor', $dataPost['creditor_id']);
                if($get_creditor->supplier_type == 'E'){
                    $coa_rowID = 83; // 2.01.01.02.01 - HUTANG SUPPLIER (EXT)
                }
                else{
                    $coa_rowID = 84; // 2.01.01.02.02 - HUTANG SUPPLIER (INT)
                }
                
                $coa_ppn_rowID = 46; // 1.01.04.05 - PPN MASUKAN
                
                $total_dc = str_replace('.','',$dataPost['base_amt']);
                $amount_dc = str_replace(',','.',$total_dc);
                
                $total_amt =  str_replace(',','.',str_replace('.','',$dataPost['total_amt']));
                
                $result = $this->kontra_bon_model->save_gl_detail_debit($sa_spec_prefix_gl, $new_gl_coa_code, $gl_coa_no, 0, $dataPost['remark'], $amount_dc, 'C', $dataPost['creditor_id'], $alloc_no, 
                                                                            $alloc_date, $dataPost);         
                $tax_amt = str_replace('.','',$dataPost['tax_amt']);
                if($tax_amt > 0){
                    $result = $this->kontra_bon_model->save_gl_detail_debit($sa_spec_prefix_gl, $new_gl_coa_code, $gl_coa_no, $coa_ppn_rowID, $dataPost['remark'], $tax_amt, 'C', $dataPost['creditor_id'], $alloc_no, 
                                                                            $alloc_date, $dataPost);
                }
                
                if ($result){
                    $result = $this->kontra_bon_model->save_gl_detail_credit($sa_spec_prefix_gl, $new_gl_coa_code, $gl_coa_no, $coa_rowID, $dataPost['remark'], $total_amt, 'C', $dataPost['creditor_id'], $alloc_no, 
                                                                            $alloc_date, $dataPost);          
                    if ($result){
                        if (!empty($dataPost['detailDO']))
                        {
                            foreach ($dataPost['detailDO'] as $detDO)
                            {
                                $result = $this->kontra_bon_model->simpan_data_detail_do($sa_spec_prefix, $alloc_code, $alloc_no,
                                    $dataPost, $detDO);
                                if (!$result)
                                {
                                    $error = true;
                                    break;
                                } else
                                {
                                    $error = false;
                                }
                            }
                        }
                    }
                    else{
                        $error = true;
                    }                    
                }
                else{
                    $error = true;
                }
            }
            else{
                $error = true;
            }
            */
        } else
        {
            $error = true;
        }

        
        Header('Content-Type: application/json; charset=UTF8');
        $status = $this->db->trans_status();
        if ($status === false || $error == true)
        {
            $this->db->trans_rollback();
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'ERROR ROLLBACK Kontra Bon';
            $params['module_field_id'] = $alloc_code;
            $params['activity'] = ucfirst('Deleted a Kontra Bon No. ' . $alloc_no);
            $params['icon'] = 'fa-exclamation-triangle';
            modules::run('activitylog/log', $params);
            echo json_encode(array('success' => false, 'msg' => " Failed"));
            exit();
        } else
        {
            $this->db->trans_commit();
            if($trx_no != '' || $row_id != '' || $code != ''){
                $params['user_rowID'] = $this->tank_auth->get_user_id();
				$params['module'] = 'Kontra Bon';
				$params['module_field_id'] = $code;
				$params['activity'] = ucfirst('Update a Kontra Bon No. '.$trx_no);
				$params['icon'] = 'fa-pencil';
				modules::run('activitylog/log',$params); //log activity	
                
            }
            else{
                $params['user_rowID'] = $this->tank_auth->get_user_id();
				$params['module'] = 'Kontra Bon';
				$params['module_field_id'] = $alloc_code;
				$params['activity'] = ucfirst('Add a new Kontra Bon No. '.$alloc_no);
				$params['icon'] = 'fa-plus';
				modules::run('activitylog/log',$params); //log activity	
                
            }        
            $info = lang('kontra_bon_registered_successfully');
            echo json_encode(array('success' => true, 'msg' => $info));
            exit();
        }
        return $status;

    }
    
    function delete_ap(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $error = false;
        $this->db->trans_begin();
        $trx_no = $this->input->post('trx_no');
        
        $this->kontra_bon_model->delete_ap_hdr($trx_no); 
        $this->kontra_bon_model->delete_ap_trx_dtl_do($trx_no); 
        
        Header('Content-Type: application/json; charset=UTF8');
        $status = $this->db->trans_status();
        if ($status === false || $error == true)
        {
            $this->db->trans_rollback();
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'ERROR ROLLBACK Kontra Bon';
            $params['module_field_id'] = $trx_no;
            $params['activity'] = ucfirst('Deleted a Kontra Bon No. ' . $trx_no);
            $params['icon'] = 'fa-exclamation-triangle';
            modules::run('activitylog/log', $params);
            echo json_encode(array('success' => false, 'msg' => " Failed"));
            exit();
        } else
        {
            $this->db->trans_commit();
            $params['user_rowID'] = $this->tank_auth->get_user_id();
			$params['module'] = 'Kontra Bon';
			$params['module_field_id'] = $trx_no;
			$params['activity'] = ucfirst('Delete a Kontra Bon No. '.$trx_no);
			$params['icon'] = 'fa-times';
			modules::run('activitylog/log',$params); //log activity	
            
            $info = lang('kontra_bon_registered_successfully');
            echo json_encode(array('success' => true, 'msg' => $info));
            exit();
        }
        return $status;
    }

    function fetch_data() { 
        if ($this->input->is_ajax_request()) {
            $dt = $_POST;

            if($this->session->userdata('start_date_ap') == '' ){
                $start_date = date("Y-m-d", strtotime('-6 day'));
            }else{
                $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_ap')));
            }

            if($this->session->userdata('end_date_ap') == ''){
                $end_date = date("Y-m-d");
            }else{
                $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_ap')));
            }
            $str_between = " AND ap_trx_hdr.trx_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";
        
            $dt['table'] = 'ap_trx_hdr';
            $dt['id'] = 'rowID';

            $aColumnTable = array(
                'ap_trx_hdr.rowID', 'ap_trx_hdr.trx_no', 'ap_trx_hdr.trx_date', 'ap_trx_hdr.po_no', 'ap_trx_hdr.descs', 'ap_trx_hdr.ref_no', 'ap_trx_hdr.base_amt', 'ap_trx_hdr.tax_amt', 'ap_trx_hdr.total_amt'
            );

            $aColumns = array(
                'ap_trx_hdr.rowID', 'ap_trx_hdr.trx_no', 'ap_trx_hdr.trx_date', 'ap_trx_hdr.po_no', 'ap_trx_hdr.descs', 'ap_trx_hdr.ref_no', 'ap_trx_hdr.base_amt', 'ap_trx_hdr.tax_amt', 'ap_trx_hdr.total_amt'
            );

            $groupBy = '';

            /** Paging * */
            $sLimit = "";
            if (isset($dt['start']) && $dt['length'] != '-1') {
                $sLimit = " LIMIT " . intval($dt['start']) . ", " . intval($dt['length']);
            }

            /** Ordering * */
            $sOrder = " ORDER BY ";
            $sOrderIndex = $dt['order'][0]['column'];
            $sOrderDir = $dt['order'][0]['dir'];
            $bSortable_ = $dt['columns'][$sOrderIndex]['orderable'];
            if ($bSortable_ == "true") {
                $sOrder .= $aColumnTable[$sOrderIndex] . ($sOrderDir === 'asc' ? ' asc' : ' desc');
            } else {
                $sOrder .= " ap_trx_hdr.trx_no DESC";
            }

            /* Individual column filtering */
            $sSearchReg = $dt['search']['regex'];
            for ($i = 0; $i < count($aColumns); $i++) {
                $bSearchable_ = $dt['columns'][$i]['searchable'];
                if (isset($bSearchable_) && $bSearchable_ == "true" && $sSearchReg != 'false') {
                    $search_val = $dt['columns'][$i]['search']['value'];
                    if ($sWhere == "") {
                        $sWhere = " WHERE ";
                    } else {
                        $sWhere .= " AND ";
                    }
                    $sWhere .= $aColumns[$i] . " LIKE '%" . $this->db->escape_like_str($search_val) . "%' ";
                }
            }

            if (!empty($dt['columns'][9]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $start_date = date('Y-m-d', strtotime($dt['columns'][9]['search']['value']));
                $this->session->set_userdata('start_date_ap',date("Y-m-d",strtotime($start_date)));

                if($this->session->userdata('end_date_ap') == ''){
                    $end_date = date("Y-m-d");
                }else{
                    $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_ap')));
                }
                $str_between = " AND ap_trx_hdr.trx_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";

                $sWhere.= ' ap_trx_hdr.deleted = 0 AND ap_trx_hdr.ap_kb_type = "kb" ' . $str_between; 
            }

            if (!empty($dt['columns'][10]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $end_date = date('Y-m-d', strtotime($dt['columns'][10]['search']['value']));
                $this->session->set_userdata('end_date_ap', date("Y-m-d",strtotime($end_date)));

                if($this->session->userdata('start_date_ap') == ''){
                    $start_date = date("Y-m-d", strtotime('-6 day'));
                }else{
                    $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_ap')));
                }
                $str_between = " AND ap_trx_hdr.trx_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";
                
                $sWhere.= ' ap_trx_hdr.deleted = 0 AND ap_trx_hdr.ap_kb_type = "kb" ' . $str_between; 
            }

            /** Filtering * */
            $sWhere = "";
            $sSearchVal = $dt['search']['value'];
            if (isset($sSearchVal) && $sSearchVal != '') {
                $sWhere = " WHERE (";
                for ($i = 0; $i < count($aColumns); $i++) {
                    $sWhere .= $aColumns[$i] . " LIKE '%" . $this->db->escape_like_str($sSearchVal) . "%' OR ";

                }

                $sWhere = substr_replace($sWhere, "", -3);
                $sWhere .= ') AND ap_trx_hdr.deleted = 0 AND ap_trx_hdr.ap_kb_type = "kb" ' . $str_between;
            } 

            /** Total Data Set Length * */
            $sQuery = 'SELECT * FROM ' . $dt['table'] . ' LEFT JOIN sa_creditor ON sa_creditor.rowID = ap_trx_hdr.creditor_rowID LEFT JOIN sa_creditor_type ON sa_creditor_type.rowID = ap_trx_hdr.ap_type WHERE ap_trx_hdr.deleted = 0 AND ap_trx_hdr.ap_kb_type = "kb" ' . $str_between;
            $rResultTotal = $this->db->query($sQuery);
            $aResultTotal = $rResultTotal->num_rows();
            $iTotal = $aResultTotal;
            
            /* Get Data To Display */
            if ($sWhere != "") {
                $where = $sWhere;
            } else {
                $where = " WHERE ap_trx_hdr.deleted = 0 AND ap_trx_hdr.ap_kb_type = 'kb' " . $str_between;
            }

            $join_table = ' LEFT JOIN sa_creditor ON sa_creditor.rowID = ap_trx_hdr.creditor_rowID LEFT JOIN sa_creditor_type ON sa_creditor_type.rowID = ap_trx_hdr.ap_type ';

            $sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) .
                    " FROM " . $dt['table'] . $join_table . $where . $groupBy . $sOrder . $sLimit;
            $rResult = $this->db->query($sQuery);

            /* Data set length after filtering */
            $sQuery = "SELECT FOUND_ROWS() AS length_count";
            $rResultFilterTotal = $this->db->query($sQuery);
            $aResultFilterTotal = $rResultFilterTotal->row();
            $iFilteredTotal = $aResultFilterTotal->length_count;

            /** Output */
            $draw = $dt['draw'];
            $data = array();
            if (!empty($rResult)) {
                foreach ($rResult->result_array() as $aRow) {
                    $dt['start'] ++;
                    $row = array();

                    $dropdown_option = "";
                    $dropdown_option .= '<div class="btn-group">';
                    $dropdown_option .= '<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">';
                    $dropdown_option .= lang('options');
                    $dropdown_option .= '<span class="caret"></span>';
                    $dropdown_option .= '</button>';
                    $dropdown_option .= '<ul class="dropdown-menu">';
                    if($this->get_user_access('PrintLimited') == 1 || $this->get_user_access('PrintUnlimited') == 1 || $this->get_user_access('PrintOne') == 1 || $this->get_user_access('PrintTwo') == 1){
                        if($this->get_user_access('PrintLimited') == 1){
                            if($this->get_log_limited_printed($aRow['trx_no'],'Kontra Bon') == 0){
                                $dropdown_option .= '<li><a href="javascript:void()" title="' . lang('print_option') . '" onclick="print_ap(\'' . $aRow['trx_no'] . '\')"><i class="fa fa-print"></i> ' . lang('print_option') . '</a></li>';
                            }
                        }else{
                            $dropdown_option .= '<li><a href="javascript:void()" title="' . lang('print_option') . '" onclick="print_ap(\'' . $aRow['trx_no'] . '\')"><i class="fa fa-print"></i> ' . lang('print_option') . '</a></li>';
                        }
                    }
                    
                    $check_invoice = $this->kontra_bon_model->check_invoice($aRow['trx_no']);
                    if(count($check_invoice) == 0){
                        if($this->get_user_access('Updated') == 1){
                            $dropdown_option .= '<li><a href="javascript:void()" title="' . lang('update_option') . '" onclick="edit_ap(\'' . $aRow['trx_no'] . '\')"><i class="fa fa-pencil"></i> ' . lang('update_option') . '</a></li>';
                        }
                        if($this->get_user_access('Deleted') == 1){
                            $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('delete_option') . '" onclick="delete_ap(\'' . $aRow['trx_no'] . '\')"><i class="fa fa-trash-o"></i> ' . lang('delete_option') . '</a></li>';
                        }
                    }
                    $dropdown_option .= '</ul></div>';
              
                    $row['dropdown_option'] = $dropdown_option;
                    $row['trx_no'] = $aRow['trx_no'];
                    $row['trx_date'] = date("d F Y",strtotime($aRow['trx_date']));
                    $row['po_no'] = strtoupper($aRow['po_no']);
                    $row['ref_no'] = strtoupper($aRow['ref_no']);
                    $row['descs'] = strtoupper($aRow['descs']);
                    $row['base_amt'] = number_format($aRow['base_amt'],2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));
                    $row['tax_amt'] = number_format($aRow['tax_amt'],2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));
                    $row['total_amt'] = number_format($aRow['total_amt'],2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));
                    
                    $row['start_date'] = $aRow['trx_date'];
                    $row['end_date'] = $aRow['trx_date'];
                    $data[] = $row;
                }
            }

            $output = array(
                "draw" => intval($draw),
                "recordsTotal" => $iTotal,
                "recordsFiltered" => $iFilteredTotal,
                "data" => $data
            );
            echo json_encode($output);
        } else {
            show_404();
        }
    }

    function get_user_access($field){
        $this->db->where('status','1');
        $this->db->where('Link_Menu', 'kontra_bon');
        $query_menu = $this->db->get('sa_menu');        
        $get_menu = $query_menu->row();
        $menu_id = $get_menu->Seq_Menu;

        if($menu_id > 0){
            $this->db->where('user_rowID',$this->session->userdata('user_id'));
            $this->db->where('StatusUsermenu','1');
            $this->db->where('Kd_Menu',$menu_id);
            $query = $this->db->get('sa_usermenu');
            if ($query->num_rows() > 0){
                $row = $query->row();
                return $row->$field;
            } else{
                return 0;
            }
        } else{
           return 0;
        }
        
    }
       
    function get_log_limited_printed($trx_no,$module)
	{
        $sql = "SELECT * FROM activities 
                WHERE user_rowID = ".$this->session->userdata('user_id')." AND activity LIKE '%".$trx_no."%' AND module = '".$module."' 
                        AND icon = 'fa-print' AND deleted = 0";
        $query = $this->db->query($sql);
		if ($query->num_rows() > 0){
            return $query->num_rows();
		} else{
			return 0;
		}	   
    }
    
}

/* End of file contacts.php */
