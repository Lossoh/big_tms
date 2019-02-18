<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Advance extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('advance_model');
        $this->load->model('appmodel');
        $this->load->library('pdf_generator');
        $this->load->library('MoneyFormat');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('advances') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('advances');
        $this->session->set_userdata('page_header', 'transaction');
        $this->session->set_userdata('page_detail', 'advance');
        $data['datatables'] = true;
        $data['form'] = true;
        
        if($this->session->userdata('start_date_ad') == '' ){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_ad')));
        }

        if($this->session->userdata('end_date_ad') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_ad')));
        }

        // if($this->session->userdata('start_date_ad') == '' && $this->session->userdata('end_date_ad') == ''){
        //     $start_date = date("Y-m-d",strtotime("yesterday"));
        //     $end_date = date("Y-m-d");
        // }
        // else{
        //     $start_date = $this->session->userdata('start_date_ad');
        //     $end_date = $this->session->userdata('end_date_ad');
        // }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        
        // $data['advances'] = $this->advance_model->get_all_record_data($start_date,$end_date);
        
        $data['advance_types'] = $this->advance_model->get_all_advance_type_data();
        $data['debtors'] = $this->advance_model->get_all_debtor_data();
        $data['creditors'] = $this->advance_model->get_all_creditor_data();
        $data['cash_advance_jo'] =$this->advance_model->get_data_cash_advance_jo();
		$data['job_order_emkls'] = $this->advance_model->get_data_cash_advance_jo_emkl($start_date,$end_date);

        $this->template->set_layout('users')->build('advances', isset($data) ? $data : null);
    }
    
    function set_filter(){
       $this->session->set_userdata('start_date_ad',date("Y-m-d",strtotime($this->input->post('start_date'))));
       $this->session->set_userdata('end_date_ad',date("Y-m-d",strtotime($this->input->post('end_date'))));    
       
       redirect(base_url().'advance');
    }

    function get_data_expenses(){
        $advance_category_rowID = $this->input->post('advance_category_rowID');
        
        $expenses = $this->advance_model->get_all_records('sa_expense', $array =
            array('rowID >' => 0, 'deleted' => 0, 'advance_category_rowID' => $advance_category_rowID), $join_table = '', $join_criteria = '', 'rowID', 'desc');
        
        if (count($expenses) > 0) {
            foreach ($expenses as $rs) {
		      echo '<option value="'.$rs->rowID.'">'.$rs->expense_cd.' - '.$rs->descs.'</option>';
            }
        }
        else{
            echo '<option value="">No expense data</option>';
        }
        
        exit;
    }
    
    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $get_data = $this->advance_model->get_by_id($id);

        if($get_data->jo_type_advance == 'jo_emkl'){
            $get_data = $this->advance_model->get_data_emkl_by_id($id);
        }
        
        $hasil = $get_data;
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function show_detail_advance()
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $advance_number = $this->input->get('advance_number');
        
        $hasil = $this->advance_model->get_detail_by_advance_number($advance_number);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function print_advance($row_id){
        $get_data = $this->advance_model->get_by_id($row_id);
        $get_data_detail = $this->advance_model->get_detail_by_advance_number($get_data->advance_number);
        $data['get_data'] = $get_data;
        $data['get_data_detail'] = $get_data_detail;
         
        $sql_update = "UPDATE tr_advance_trx_hdr 
                        SET printed = printed + 1, user_printed = ".$this->session->userdata('user_rowID').",
                            date_printed = '".date('Y-m-d')."', time_printed = '".date('H:i:s')."'
                        WHERE advance_number = '".$get_data->advance_number."'";
        
        $this->db->query($sql_update);
        
        $params['user_rowID'] = $this->tank_auth->get_user_id();
		$params['module'] = 'Advance';
		$params['module_field_id'] = $get_data->rowID;
		$params['activity'] = ucfirst('Print a Advance No. '.$get_data->advance_number);
		$params['icon'] = 'fa-print';
		modules::run('activitylog/log',$params); //log activity	
        
        $html = $this->load->view('print_advance_pdf', $data, true);
        
        $this->pdf_generator->generate($html, 'Advance Pdf',$orientation='Portrait');    
    }
    
    function delete_data($id)
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $data = $this->advance_model->delete_data($tabel = 'tr_advance_trx_hdr', $id);
        header('Content-Type: application/json');
        
        $get_data = $this->advance_model->get_by_id($id);
        
        $params['user_rowID'] = $this->tank_auth->get_user_id();
        $params['module'] = 'advance';
        $params['module_field_id'] = $id;
        $params['activity'] = ucfirst('Deleted an Advance No. ' . $get_data->advance_number);
        $params['icon'] = 'fa-trash-o';
        modules::run('activitylog/log', $params); //log activity
        
        echo json_encode($data);
        exit();
    }


    function create()
    {
        $dataPost = $this->input->post();
        //echo "<pre>";print_r($dataPost);echo "</pre>";exit();
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $error = false;
        $this->db->trans_begin();
        
        $expense_id = $dataPost['expense_id'];
        $advance_desc = $dataPost['advance_desc'];
        $amount = $dataPost['amount'];
        
        if (empty($dataPost['rowID'])) {
            /*
            if(date('Y-m-d',strtotime($dataPost['date'])) != date('Y-m-d')){
                $alloc_date = date('Y-m-d');
            }
            else{
                $alloc_date = date('Y-m-d',strtotime($dataPost['date']));
            }
            */
            $alloc_date = date('Y-m-d',strtotime($dataPost['date']));
            
            $alloc_date_year = date('Y',strtotime($alloc_date));
            $alloc_date_month = date('m',strtotime($alloc_date));

            //$max_advance_id  = ((int)$this->advance_model->select_max_by_field('rowID'))+1;
            $get_advance_type = $this->advance_model->get_all_advance_type_by_rowID($dataPost['advance_type_rowID']);
            $advance_code = strtoupper($get_advance_type->advance_cd);
            
            $sa_spec= $this->db->get_where('sa_spec', array('deleted' => 0,'rowID' => 1))->row_array();
            $sa_spec_prefix = $sa_spec['advance_prefix'];
            $max_advance_id = ((int)$this->appmodel->select_max_id('tr_advance_trx_hdr',$array = array('prefix'=>$sa_spec_prefix,'year' =>$alloc_date_year,
                                                    'month' =>$alloc_date_month,'advance_code' =>$advance_code, 'deleted' =>0),'code'))+1;
            $advance_number=$sa_spec_prefix.sprintf("%04s",$alloc_date_year).sprintf("%02s",$alloc_date_month).sprintf("%05s",$max_advance_id).$advance_code;
            
            $data_advance = array(
                'prefix' =>$sa_spec_prefix,
                'year'   =>$alloc_date_year,
                'month'  =>$alloc_date_month,
                'code'   =>$max_advance_id,
                'advance_code' => $advance_code,
                'advance_number' => $advance_number,
                'advance_date' => $alloc_date,
                'jo_type_advance' => $dataPost['jo_type_advance'],
                'jo_no' => $dataPost['jo_no'],
                'advance_type_rowID' => $dataPost['advance_type_rowID'],
                'debtor_rowID' => $dataPost['debtor_rowID'],
                'dp_creditor_rowID' => $dataPost['dp_creditor_rowID'],
                'advance_total' => str_replace('.','',$dataPost['advance_total']),
                'remark' => $dataPost['remark'],
                'user_created' => $this->session->userdata('user_id'),
                'date_created' => $alloc_date.' '.date('H:i:s')
            );
            
            $result = $this->db->insert('tr_advance_trx_hdr', $data_advance);
            if($result){
                if(count($expense_id) > 0){
                    for($i=0;$i<count($expense_id);$i++){
                        $data_advance_detail = array(
                            'advance_number' => $advance_number,
                            'expense_rowID' => $expense_id[$i],
                            'descs' => $advance_desc[$i],
                            'amount' => str_replace('.','',$amount[$i]),
                            'user_created' => $this->session->userdata('user_id'),
                            'date_created' => $alloc_date.' '.date('H:i:s')
                        );
                        
                        $result_dtl = $this->db->insert('tr_advance_trx_dtl', $data_advance_detail);
                        
                        if(!$result_dtl){                            
                            $error = true;
                            break;
                        }
                        
                    }
                }
            }
            else{
                $error = true;
            }            
            
            Header('Content-Type: application/json; charset=UTF8');
            $status = $this->db->trans_status();
            if ($status === false || $error == true)
            {
                $this->db->trans_rollback();
                $params['user_rowID'] = $this->tank_auth->get_user_id();
				$params['module'] = 'ERROR ROLLBACK Advance';
				$params['module_field_id'] = $max_advance_id;
				$params['activity'] = ucfirst('Deleted an Advance No '.$advance_number);
				$params['icon'] = 'fa-exclamation-triangle';
				modules::run('activitylog/log',$params);
                echo json_encode(array('success' => false, 'msg' => " Failed Data RollBack"));
                exit();
            } 
            else
            {
                $this->db->trans_commit();
                $params['user_rowID'] = $this->tank_auth->get_user_id();
				$params['module'] = 'advance';
				$params['module_field_id'] = $max_advance_id;
				$params['activity'] = ucfirst('Add a New Advance No '.$advance_number);
				$params['icon'] = 'fa-plus';
				modules::run('activitylog/log',$params); //log activity	
                
                $info = lang('created_succesfully').' No '.$advance_number;
                echo json_encode(array('success' => true, 'msg' => $info));
                exit();
            }
            
        } 
         
        else {
            $get_data = $this->advance_model->get_by_id($dataPost['rowID']);
            
            $advance_number = $get_data->advance_number;

            $alloc_date = date('Y-m-d',strtotime($dataPost['date']));            
            $alloc_date_year = date('Y',strtotime($alloc_date));
            $alloc_date_month = date('m',strtotime($alloc_date));

            $data_advance = array(
                'advance_number' => $advance_number,
                'advance_date' => $alloc_date,
                'jo_type_advance' => $dataPost['jo_type_advance'],
                'jo_no' => $dataPost['jo_no'],
                'advance_type_rowID' => $dataPost['advance_type_rowID'],
                'debtor_rowID' => $dataPost['debtor_rowID'],
                'dp_creditor_rowID' => $dataPost['dp_creditor_rowID'],
                'advance_total' => str_replace('.','',$dataPost['advance_total']),
                'remark' => $dataPost['remark'],
                'user_modified' => $this->session->userdata('user_id'),
                'date_modified' => date('Y-m-d H:i:s'),
            );
           
            $this->db->where('rowID', $dataPost['rowID']);
            $result = $this->db->update('tr_advance_trx_hdr', $data_advance);
            if($result){
                if(count($expense_id) > 0){
                    // Update delete advance detail
                    $this->db->set('deleted', 1);
                    $this->db->set('user_deleted', $this->session->userdata('user_id'));
                    $this->db->set('date_deleted', date('Y-m-d H:i:s'));
                    $this->db->where('deleted', 0);
                    $this->db->where('advance_number', $advance_number);
                    $this->db->update('tr_advance_trx_dtl');
                    
                    for($i=0;$i<count($expense_id);$i++){
                        $data_advance_detail = array(
                            'advance_number' => $advance_number,
                            'expense_rowID' => $expense_id[$i],
                            'descs' => $advance_desc[$i],
                            'amount' => str_replace('.','',$amount[$i]),
                            'user_created' => $this->session->userdata('user_id'),
                            'date_created' => date('Y-m-d H:i:s'),
                        );
                        
                        $result_dtl = $this->db->insert('tr_advance_trx_dtl', $data_advance_detail);
                        
                        if(!$result_dtl){                            
                            $error = true;
                            break;
                        }
                        
                    }
                }
            }
            else{
                $error = true;
            }            
            
            Header('Content-Type: application/json; charset=UTF8');
            $status = $this->db->trans_status();
            if ($status === false || $error == true)
            {
                $this->db->trans_rollback();
                $params['user_rowID'] = $this->tank_auth->get_user_id();
				$params['module'] = 'ERROR ROLLBACK Advance';
				$params['module_field_id'] = $dataPost['rowID'];
				$params['activity'] = ucfirst('Deleted an Advance No '.$advance_number);
				$params['icon'] = 'fa-exclamation-triangle';
				modules::run('activitylog/log',$params);
                echo json_encode(array('success' => false, 'msg' => " Failed Data RollBack"));
                exit();
            } 
            else
            {
                $this->db->trans_commit();
                $params['user_rowID'] = $this->tank_auth->get_user_id();
				$params['module'] = 'advance';
				$params['module_field_id'] = $dataPost['rowID'];
				$params['activity'] = ucfirst('Updated an Advance No '.$advance_number);
				$params['icon'] = 'fa-edit';
				modules::run('activitylog/log',$params); //log activity	
                
                $info = lang('updated_succesfully').' No '.$advance_number;
                echo json_encode(array('success' => true, 'msg' => $info));
                exit();
            }            
            
        }
        
        return $status;
            
    }
    
    function pdf()
    {
        if($this->session->userdata('start_date_ad') == '' ){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_ad')));
        }

        if($this->session->userdata('end_date_ad') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_ad')));
        }

        // if($this->session->userdata('start_date_ad') == '' && $this->session->userdata('end_date_ad') == ''){
        //     $start_date = date("Y-m-d",strtotime("yesterday"));
        //     $end_date = date("Y-m-d");
        // }
        // else{
        //     $start_date = $this->session->userdata('start_date_ad');
        //     $end_date = $this->session->userdata('end_date_ad');
        // }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['periode'] = date("d F Y",strtotime($start_date)).' - '.date("d F Y",strtotime($end_date));
        
        $data['advances'] = $this->advance_model->get_all_record_data($start_date,$end_date);
        
        $html = $this->load->view('advance_pdf', $data, true);
        $this->pdf_generator->generate($html, 'advance pdf',$orientation='Landscape');
    }
    
    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=advance.xls");
        
        if($this->session->userdata('start_date_ad') == '' ){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_ad')));
        }

        if($this->session->userdata('end_date_ad') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_ad')));
        }

        // if($this->session->userdata('start_date_ad') == '' && $this->session->userdata('end_date_ad') == ''){
        //     $start_date = date("Y-m-d",strtotime("yesterday"));
        //     $end_date = date("Y-m-d");
        // }
        // else{
        //     $start_date = $this->session->userdata('start_date_ad');
        //     $end_date = $this->session->userdata('end_date_ad');
        // }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['periode'] = date("d F Y",strtotime($start_date)).' - '.date("d F Y",strtotime($end_date));
        
        $data['advances'] = $this->advance_model->get_all_record_data($start_date,$end_date);
        
        $this->load->view("advance_pdf", $data);

    }

    function fetch_data() { 
        if ($this->input->is_ajax_request()) {
            $dt = $_POST;

            if($this->session->userdata('start_date_ad') == '' ){
                $start_date = date("Y-m-d", strtotime('-6 day'));
            }else{
                $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_ad')));
            }

            if($this->session->userdata('end_date_ad') == ''){
                $end_date = date("Y-m-d");
            }else{
                $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_ad')));
            }
            $str_between = " AND tr_advance_trx_hdr.advance_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";
        
            $dt['table'] = 'tr_advance_trx_hdr';
            $dt['id'] = 'rowID';

            $aColumnTable = array(
                'tr_advance_trx_hdr.rowID', 'tr_advance_trx_hdr.advance_number', 'tr_advance_trx_hdr.advance_number', 'tr_advance_trx_hdr.advance_date', 'sa_advance_category.advance_name', 'sa_debtor.debtor_cd', 'sa_creditor.creditor_name', 'tr_advance_trx_hdr.remark', 'tr_advance_trx_hdr.advance_total', 'sa_debtor.debtor_name'
            );

            $aColumns = array(
                'tr_advance_trx_hdr.rowID', 'tr_advance_trx_hdr.advance_number', 'tr_advance_trx_hdr.advance_number', 'tr_advance_trx_hdr.advance_date', 'sa_advance_category.advance_name', 'sa_debtor.debtor_cd', 'sa_creditor.creditor_name', 'tr_advance_trx_hdr.remark', 'tr_advance_trx_hdr.advance_total', 'sa_debtor.debtor_name'
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
                $sOrder .= "tr_advance_trx_hdr.rowID DESC";
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
                $this->session->set_userdata('start_date_ad',date("Y-m-d",strtotime($start_date)));

                if($this->session->userdata('end_date_ad') == ''){
                    $end_date = date("Y-m-d");
                }else{
                    $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_ad')));
                }
                $str_between = " AND tr_advance_trx_hdr.advance_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";

                $sWhere.= ' tr_advance_trx_hdr.deleted = 0 ' . $str_between; 
            }

            if (!empty($dt['columns'][10]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $end_date = date('Y-m-d', strtotime($dt['columns'][10]['search']['value']));
                $this->session->set_userdata('end_date_ad', date("Y-m-d",strtotime($end_date)));

                if($this->session->userdata('start_date_ad') == ''){
                    $start_date = date("Y-01-01");
                }else{
                    $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_ad')));
                }
                $str_between = " AND tr_advance_trx_hdr.advance_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";
                
                $sWhere.= ' tr_advance_trx_hdr.deleted = 0 ' . $str_between; 
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
                $sWhere .= ') AND tr_advance_trx_hdr.deleted = 0 ' . $str_between;
            } 


            /** Total Data Set Length * */
            $sQuery = 'SELECT * FROM ' . $dt['table'] . ' LEFT JOIN sa_debtor ON sa_debtor.rowID = tr_advance_trx_hdr.debtor_rowID LEFT JOIN sa_advance_category ON sa_advance_category.rowID = tr_advance_trx_hdr.advance_type_rowID LEFT JOIN sa_creditor ON sa_creditor.rowID = tr_advance_trx_hdr.dp_creditor_rowID WHERE tr_advance_trx_hdr.deleted = 0 ' . $str_between;
            $rResultTotal = $this->db->query($sQuery);
            $aResultTotal = $rResultTotal->num_rows();
            $iTotal = $aResultTotal;
            
            /* Get Data To Display */
            if ($sWhere != "") {
                $where = $sWhere;
            } else {
                $where = " WHERE tr_advance_trx_hdr.deleted = 0 " . $str_between;
            }

            $join_table = ' LEFT JOIN sa_debtor ON sa_debtor.rowID = tr_advance_trx_hdr.debtor_rowID LEFT JOIN sa_advance_category ON sa_advance_category.rowID = tr_advance_trx_hdr.advance_type_rowID LEFT JOIN sa_creditor ON sa_creditor.rowID = tr_advance_trx_hdr.dp_creditor_rowID ';

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

                    $get_data_reimburse = $this->advance_model->get_data_reimburse_by_advance_number($aRow['advance_number']);
                    $reimburse_no = '-';
                    if(count($get_data_reimburse) > 0){
                        $reimburse_no = '';
                        foreach($get_data_reimburse as $row_reimburse){
                            $reimburse_no .= $row_reimburse->reimburse_number.', ';
                        }
                        $reimburse_no = substr($reimburse_no,0,-2);
                    }
                    
                    $dropdown_option = "";
                    $dropdown_option .= '<div class="btn-group">';
                    $dropdown_option .= '<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">';
                    $dropdown_option .= lang('options');
                    $dropdown_option .= '<span class="caret"></span>';
                    $dropdown_option .= '</button>';
                    $dropdown_option .= '<ul class="dropdown-menu">';
                    if($this->get_user_access('PrintLimited') == 1 || $this->get_user_access('PrintUnlimited') == 1 || $this->get_user_access('PrintOne') == 1 || $this->get_user_access('PrintTwo') == 1){
                        if($this->get_user_access('PrintLimited') == 1){
                            if($this->get_log_limited_printed($aRow['advance_number'],'Advance') == 0){
                                $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('print_option') .'" onclick="print_advance(\'' . $aRow['rowID'] . '\')"><i class="fa fa-print"></i> ' . lang('print_option') . '</a></li>';
                            }
                        }else{
                            $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('print_option') . '" onclick="print_advance(\'' . $aRow['rowID'] . '\')"><i class="fa fa-print"></i> ' . lang('print_option') . '</a></li>';
                        }
                    }
                                
                    if(count($get_data_reimburse) == 0){
                        if($this->get_user_access('Updated') == 1){
                            $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('update_option') . '" onclick="edit_advance(\'' . $aRow['rowID'] . '\')"><i class="fa fa-pencil"></i> '. lang('update_option') . '</a></li>';
                        }
                        if($this->get_user_access('Deleted') == 1){
                            $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('delete_option') . '" onclick="delete_advance(\'' . $aRow['rowID'] . '\')"><i class="fa fa-trash-o"></i> ' . lang('delete_option') . '</a></li>';
                        }
                    }
                    $dropdown_option .= '</ul></div>';
              
                    $row['dropdown_option'] = $dropdown_option;
                    $row['advance_number'] = $aRow['advance_number'];
                    $row['data_reimburse'] = $reimburse_no;
                    $row['advance_date'] = date("d F Y",strtotime($aRow['advance_date']));
                    $row['advance_name'] = ucwords(strtolower($aRow['advance_name']));
                    $row['debtor'] = $aRow['debtor_cd'] . ' - ' . $aRow['debtor_name'];
                    $row['creditor_name'] = ($aRow['creditor_name'] == '' ) ? '-' : $aRow['creditor_name'];
                    $row['remark'] = $aRow['remark'];
                    $row['advance_total'] = number_format($aRow['advance_total'],0,',','.');

                    $row['start_date'] = $aRow['advance_date'];
                    $row['end_date'] = $aRow['advance_date'];
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
        $this->db->where('Link_Menu', 'advance');
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
