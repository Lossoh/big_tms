<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Realizations_branch extends MX_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('realizations_branch_model');
        $this->load->model('appmodel');
        $this->load->model('fare_trip/fare_trip_model');
        $this->load->model('vehicle/vehicle_model');
        $this->load->model('vehicle_category/vehicle_category_model');
        $this->load->model('cost_code/cost_code_model');
        $this->load->model('debtor/debtor_model');
        
        $this->load->library('pdf_generator');
         
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('realization_list_branch') . ' - ' . $this->config->item('website_name') .
            ' - ' . $this->config->item('comp_name') . ' ' . $this->config->item('version'));
        $data['page'] = lang('realization_list_branch');
        $this->session->set_userdata('page_header', 'transaction');
        $this->session->set_userdata('page_detail', 'realizations_branch');
        $data['datatables'] = true;
        $data['form'] = true;
        
        if($this->session->userdata('start_date_real') == '' ){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_real')));
        }

        if($this->session->userdata('end_date_real') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_real')));
        }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        
        // $data['realization_list_branchs'] = $this->realizations_branch_model->get_all_records_list($this->
        //     session->userdata('partial_data'), $this->session->userdata('dep_rowID'),$start_date,$end_date);
            
        $data['ca_poks'] = $this->realizations_branch_model->get_all_ca_pok($this->session->userdata('dep_rowID'));
        
        $dept = $this->db->get_where('sa_dep', array('deleted' => 0, 'rowID' => $this->
                session->userdata('dep_rowID')))->row_array();

        $data['cost'] = $this->fare_trip_model->get_all_records($table = 'sa_cost', $array =
            array(
            'rowID >' => 0,
            'deleted' => 0,
            'fare_trip_comp' => 'Y',
            'site_flag' => $dept['site_flag']), $join_table = '', $join_criteria = '',
            'rowID', 'asc');


        $this->template->set_layout('users')->build('realization_list_branch', isset($data) ?
            $data : null);
    }
    
    function set_filter(){
       $this->session->set_userdata('start_date',date("Y-m-d",strtotime($this->input->post('start_date'))));
       $this->session->set_userdata('end_date',date("Y-m-d",strtotime($this->input->post('end_date'))));    
       
       redirect(base_url().'realizations_branch');
    }
    
    function view_realization($value)
    {
        $trx_no = $this->encrypt->decode($value);
        $data['cash_advance'] = $this->realizations_branch_model->get_cash_advance_by_trx_no($trx_no);
        $data['cash_advance_refund'] = $this->realizations_branch_model->get_cash_advance_refund_by_trx_no($trx_no);
        $data['documents'] = $this->realizations_branch_model->get_document_by_trx_no($trx_no);
        $data['costs'] = $this->realizations_branch_model->get_cost_by_trx_no($trx_no);
        
        $jo_type = "-";
        
        foreach($data['documents'] as $row_do){
            $get_data = $this->realizations_branch_model->get_jo_by_jo_no($row_do->jo_no);
            if($get_data->jo_type == 1){                
                $jo_type = "Bulk";
            }
            else if($get_data->jo_type == 2){                
                $jo_type = "Container";
            }
            else{
                $jo_type = "Other";
            }
        }
        
        $data['jo_type'] = $jo_type;
        
        if($data['cash_advance']->advance_type_rowID == '1'){
            $html = $this->load->view('realization_pdf', $data, true);
        }
        else{
            $html = $this->load->view('realization_others_pdf', $data, true);
        }

        $params['user_rowID'] = $this->tank_auth->get_user_id();
        $params['module'] = 'realizations_branch->Print Realization';
        $params['module_field_id'] = $trx_no;
        $params['activity'] = ucfirst('Print realization trx no. ' . $trx_no.' with Cash Advance No '.$data['cash_advance']->advance_no);
        $params['icon'] = 'fa-print';
        modules::run('activitylog/log', $params); //log activity

        $this->pdf_generator->generate($html, 'realization pdf',$orientation='Portrait');
    }

    function get_data_realization()
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $alloc_no = $_GET['alloc_no'];
        $advance_no = $_GET['advance_no'];
        
        $sql = "SELECT UNIX_TIMESTAMP() as unix_time";
        $unix_time = $this->db->query($sql)->row();
        
        $this->db->set('on_process',$unix_time->unix_time);
        $this->db->where('advance_no',$advance_no);
        $this->db->update('cb_cash_adv');
        
        $hasil = $this->realizations_branch_model->get_all_records_ca_details_row($alloc_no, $advance_no);
        
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function showDetailDO()
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $trx_no = $_GET['alloc_no'];
        
        $get_data = $this->realizations_branch_model->get_document_by_trx_no($trx_no);
        
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($get_data);
        exit;
    }
    
    function showDetailCost()
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $trx_no = $_GET['alloc_no'];
        
        $get_data = $this->realizations_branch_model->get_cost_by_trx_no($trx_no);
        
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($get_data);
        exit;
    }
        
    function getAmountCost()
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $jo_no = $_GET['jo_no'];
        $vehicle_type = $_GET['vehicle_type'];
        
        $get_data_jo = $this->realizations_branch_model->get_data_cash_advance_jo_by_jo_no($jo_no);
        
        $from_id = $get_data_jo->destination_from_rowID;
        $to_id = $get_data_jo->destination_to_rowID;
        $jo_type = $get_data_jo->jo_type;
        
        $hasil = $this->realizations_branch_model->getAmountCost($from_id, $to_id, $jo_type, $vehicle_type);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function check_data_do(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $trx_no = $this->input->post('trx_no');
        $do_no = $this->input->post('do_no');
        
        $get_data = $this->realizations_branch_model->get_document_by_trx_do_no($trx_no,$do_no);
        $hasil = array('total' => count($get_data));
        
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }

    function fetch_data() { 
        if ($this->input->is_ajax_request()) {
            $dt = $_POST;

            if($this->session->userdata('start_date_real') == '' ){
                $start_date = date("Y-m-d", strtotime('-6 day'));
            }else{
                $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_real')));
            }

            if($this->session->userdata('end_date_real') == ''){
                $end_date = date("Y-m-d");
            }else{
                $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_real')));
            }
            $str_between = " AND cb_cash_adv_alloc.alloc_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";

            $dt['table'] = 'cb_cash_adv_alloc';
            $dt['id'] = 'rowID';
            $aColumnTable = array(
                'cb_cash_adv_alloc.rowID', 'cb_cash_adv_alloc.alloc_no', 'cb_cash_adv.advance_no', 'cb_cash_adv_alloc.alloc_date', 'sa_debtor.debtor_cd', 'sa_vehicle.police_no', 'cb_cash_adv_alloc.descs', 'cb_cash_adv.advance_amount', 'cb_cash_adv_alloc.alloc_amt','cb_cash_adv_alloc.time_created', 'sa_debtor.debtor_name', 'cb_cash_adv.advance_extra_amount'
            );

            $aColumns = array(
              'cb_cash_adv_alloc.rowID', 'cb_cash_adv_alloc.alloc_no', 'cb_cash_adv.advance_no', 'cb_cash_adv_alloc.alloc_date', 'sa_debtor.debtor_cd', 'sa_vehicle.police_no', 'cb_cash_adv_alloc.descs', 'cb_cash_adv.advance_amount', 'cb_cash_adv_alloc.alloc_amt','cb_cash_adv_alloc.time_created', 'sa_debtor.debtor_name', 'cb_cash_adv.advance_extra_amount'
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
                $sOrder .= "cb_cash_adv_alloc.alloc_no DESC";
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
                $this->session->set_userdata('start_date_real',date("Y-m-d",strtotime($start_date)));

                if($this->session->userdata('end_date_real') == ''){
                    $end_date = date("Y-m-d");
                }else{
                    $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_real')));
                }
                $str_between = " AND cb_cash_adv_alloc.alloc_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";

                $sWhere.= 'cb_cash_adv_alloc.deleted = 0 AND cb_cash_adv.deleted = 0 AND sa_users.dep_rowID = ' . $this->session->userdata('dep_rowID') . ' AND cb_cash_adv_alloc.alloc_mode = "R" ' . $str_between; 
            }

            if (!empty($dt['columns'][10]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $end_date = date('Y-m-d', strtotime($dt['columns'][10]['search']['value']));
                $this->session->set_userdata('end_date_real', date("Y-m-d",strtotime($end_date)));

                if($this->session->userdata('start_date_real') == ''){
                    $start_date = date("Y-m-d", strtotime('-6 day'));
                }else{
                    $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_real')));
                }
                $str_between = " AND cb_cash_adv_alloc.alloc_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";
                
                $sWhere.= ' cb_cash_adv_alloc.deleted = 0 AND cb_cash_adv.deleted = 0 AND sa_users.dep_rowID = ' . $this->session->userdata('dep_rowID') . ' AND cb_cash_adv_alloc.alloc_mode = "R" ' . $str_between; 
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
                $sWhere .= ') AND cb_cash_adv_alloc.deleted = 0 AND cb_cash_adv.deleted = 0 AND sa_users.dep_rowID = ' . $this->session->userdata('dep_rowID') . ' AND cb_cash_adv_alloc.alloc_mode = "R" ' . $str_between;
            }

            /** Total Data Set Length * */
            $sQuery = "SELECT * FROM " . $dt['table'] . " LEFT JOIN cb_cash_adv ON cb_cash_adv.advance_no = cb_cash_adv_alloc.cb_cash_adv_no LEFT JOIN sa_debtor ON sa_debtor.rowID = cb_cash_adv.employee_driver_rowID LEFT JOIN sa_vehicle ON sa_vehicle.rowID = cb_cash_adv.vehicle_rowID LEFT JOIN sa_users ON sa_users.rowID = cb_cash_adv_alloc.user_created WHERE cb_cash_adv_alloc.deleted = 0 AND cb_cash_adv.deleted = 0 AND sa_users.dep_rowID = " . $this->session->userdata('dep_rowID') . " AND cb_cash_adv_alloc.alloc_mode = 'R' " . $str_between;
            $rResultTotal = $this->db->query($sQuery);
            $aResultTotal = $rResultTotal->num_rows();
            $iTotal = $aResultTotal;
            
            /* Get Data To Display */
            if ($sWhere != "") {
                $where = $sWhere;
            } else {
                $where = " WHERE cb_cash_adv_alloc.deleted = 0 AND cb_cash_adv.deleted = 0 AND sa_users.dep_rowID = " . $this->session->userdata('dep_rowID') . " AND cb_cash_adv_alloc.alloc_mode = 'R' " . $str_between;
            }

            $join_table = " LEFT JOIN cb_cash_adv ON cb_cash_adv.advance_no = cb_cash_adv_alloc.cb_cash_adv_no LEFT JOIN sa_debtor ON sa_debtor.rowID = cb_cash_adv.employee_driver_rowID LEFT JOIN sa_vehicle ON sa_vehicle.rowID = cb_cash_adv.vehicle_rowID LEFT JOIN sa_users ON sa_users.rowID = cb_cash_adv_alloc.user_created ";

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

                    $shift = '';
                    $data_shift = '-';
                    $date_created_tmp = '';

                    $date_created = date('Y-m-d H:i:s',strtotime($aRow['date_created'] .' '.$aRow['time_created']));
                    if(strtotime($date_created) >= strtotime(date('Y-m-d 08:00:00')) && strtotime($date_created) <= strtotime(date('Y-m-d 19:59:59'))){
                        $data_shift = 'Shift 1';
                    }else if(strtotime($date_created) <= strtotime(date('Y-m-d 07:59:59',strtotime($date_created.' +1 days')))){
                        $data_shift = 'Shift 2';
                    }
                    $date_created_tmp = $date_created;

                    $date_created = date('Y-m-d H:i:s');
                    if(strtotime($date_created) >= strtotime(date('Y-m-d 08:00:00')) && strtotime($date_created) <= strtotime(date('Y-m-d 19:59:59'))){
                        $shift = 'Shift 1';
                    }else if(strtotime($date_created) <= strtotime(date('Y-m-d 07:59:59',strtotime($date_created_tmp.' +1 days')))){
                        $shift = 'Shift 2';
                    }    
                    $total_cash_advance = $aRow['advance_amount'] + $aRow['advance_extra_amount'];

                    $dropdown_option = "";
                    $dropdown_option .= '<div class="btn-group">';
                    $dropdown_option .= '<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">';
                    $dropdown_option .= lang('options');
                    $dropdown_option .= '<span class="caret"></span>';
                    $dropdown_option .= '</button>';
                    $dropdown_option .= '<ul class="dropdown-menu">';
                    if($this->get_user_access('PrintLimited') == 1 || $this->get_user_access('PrintUnlimited') == 1 || 
                        $this->get_user_access('PrintOne') == 1 || $this->get_user_access('PrintTwo') == 1){
                        if($this->get_user_access('PrintLimited') == 1){
                            if($this->user_profile->get_log_limited_printed($aRow['alloc_no'],'realizations_branch->Print Realization') == 0){
                                $dropdown_option .= '<li><a title="' . lang('view_realization_option') . '" href="' . base_url() . 'realizations_branch/view_realization/' . $this->encrypt->encode($aRow['alloc_no']) . '" target="_blank"><i class="fa fa-eye"></i>  ' . lang('view_realization_option') . '</a></li>';
                            }
                        }else{
                            $dropdown_option .= '<li><a title="' . lang('view_realization_option') . '" href="' . base_url() . 'realizations_branch/view_realization/' . $this->encrypt->encode($aRow['alloc_no']) . '" target="_blank"><i class="fa fa-eye"></i>  ' . lang('view_realization_option') . '</a></li>';
                        }
                     }
                                        
                    if($shift == $data_shift){
                        $check_invoice = $this->realizations_branch_model->check_invoice($aRow['alloc_no']);
                        if(count($check_invoice) == 0){
                            if($row->pay_over_allocation == 0){                                            
                                if($this->get_user_access('Updated') == 1){
                                    $dropdown_option .= '<li><a href="javascript:void()" title="Edit ' . lang('realization_option') . '" onclick="edit_realization_list(\'' . $aRow['alloc_no'] . '\',\'' . $aRow['advance_no'] . '\',\'' . $aRow['alloc_date'] . '\')"><i class="fa fa-edit"></i> Edit ' . lang('realization_option') . '</a></li>';
                                }
                                
                                if($this->get_user_access('Deleted') == 1){
                                     $dropdown_option .= '<li><a href="javascript:void()" title="' . lang('delete_realization') . '" onclick="delete_realization(\'' . $aRow['alloc_no'] . '\')"><i class="fa fa-trash-o"></i> ' . lang('delete_realization') . '</a></li>';
                                }
                            }
                        }
                    }
                    $dropdown_option .= '</ul></div>';
              
                    $row['dropdown_option'] = $dropdown_option;
                    $row['alloc_no'] = $aRow['alloc_no'];
                    $row['advance_no'] = $aRow['advance_no'];
                    $row['alloc_date'] = date("d-m-Y H:i:s", strtotime($aRow['alloc_date'] .' '. $aRow['time_created']));
                    $row['debtor_cd'] = $aRow['debtor_cd'] . ' - ' . $aRow['debtor_name'];
                    $row['police_no'] = $aRow['police_no'];
                    $row['descs'] = $aRow['descs'];
                    $row['total_cash_advance'] = number_format($total_cash_advance,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));
                    $row['alloc_amt'] = number_format($aRow['alloc_amt'],0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));

                    // For Filter
                    $row['start_date'] = $aRow['alloc_date'];
                    $row['end_date'] = $aRow['alloc_date'];
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
        $this->db->where('Link_Menu', 'realizations_branch');
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

}
