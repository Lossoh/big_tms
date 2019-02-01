<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Apis extends MX_Controller {

    function __construct(){
        parent::__construct();
        
     
    }

	function fetch_data_do() { 
        if ($this->input->is_ajax_request()) {

            /* Database connection information */
            $gaSql['user']       = "german";
            $gaSql['password']   = "71KJ1171r74";
            $gaSql['db']         = "dev_ilms_db";
            $gaSql['server']     = "200.10.10.3:34123";

            if (!$gaSql['link'] = mysql_pconnect( $gaSql['server'], $gaSql['user'], $gaSql['password'] )) {
                fatal_error( 'Could not open connection to server' );
            }
         
            if (!mysql_select_db( $gaSql['db'], $gaSql['link'])){
                fatal_error('Could not select database');
            }

            $dt = $_POST;
            if (empty($dt['columns'][5]['search']['value'])) {
                $sj_date = date('Y-m-d');
            }else{
                $sj_date = date('Y-m-d', strtotime($dt['columns'][5]['search']['value']));
            }

            $dt['table'] = 'fx_trx_sj';
            $dt['id'] = 'sj_id';

            $aColumnTable = array(
               'fx_trx_sj.sj_id', 'fx_trx_sj.sj_ref', 'fx_trx_sj.driver_name', 'fx_mst_trucks.truck_name', 'fx_mst_vessels.vessel_name', 'fx_trx_sj.sj_date', 'fx_trx_sj.sj_time', 'fx_trx_sj.qty_bulk_delivery_netto', 'fx_trx_sj.receipt_datetime', 'fx_trx_sj.qty_bulk_receipt_netto', 'fx_trx_sj.reg_no_sj'
            );

            $aColumns = array(
               'fx_trx_sj.sj_id', 'fx_trx_sj.sj_ref', 'fx_trx_sj.driver_name', 'fx_mst_trucks.truck_name', 'fx_mst_vessels.vessel_name', 'fx_trx_sj.sj_date', 'fx_trx_sj.sj_time', 'fx_trx_sj.qty_bulk_delivery_netto', 'fx_trx_sj.receipt_datetime', 'fx_trx_sj.qty_bulk_receipt_netto', 'fx_trx_sj.reg_no_sj'
            );

            $groupBy = '';
            /** Total Data Set Length * */
            $sQuery = "SELECT * FROM " . $dt['table'] . " LEFT JOIN fx_mst_trucks ON fx_trx_sj.truck_id = fx_mst_trucks.truck_id LEFT JOIN fx_mst_vessels ON fx_trx_sj.vessel_id = fx_mst_vessels.vessel_id WHERE fx_trx_sj.deleted = 0 AND fx_trx_sj.sj_date = '".$sj_date."'";
            $rResultTotal = mysql_query($sQuery, $gaSql['link']) or fatal_error( 'MySQL Error: ' . mysql_errno() );
            $aResultTotal = mysql_num_rows($rResultTotal);
            $iTotal = $aResultTotal;

            /** Paging * */
            $sLimit = "";
            if (isset($dt['start']) && $dt['length'] != '-1') {
                $sLimit = " LIMIT " . intval($dt['start']) . ", " . intval($dt['length']);
            }

            $sOrder = " ORDER BY ";
            $sOrderIndex = $dt['order'][0]['column'];
            $sOrderDir = $dt['order'][0]['dir'];
            $bSortable_ = $dt['columns'][$sOrderIndex]['orderable'];
            if ($bSortable_ == "true") {
                $sOrder .= $aColumnTable[$sOrderIndex] . ($sOrderDir === 'asc' ? ' asc' : ' desc');
            } else {
                $sOrder .= "fx_trx_sj.sj_ref ASC";
            }
           
            $sWhere = "";
            $sSearchVal = $dt['search']['value'];
            if (isset($sSearchVal) && $sSearchVal != '') {
                $sWhere = " WHERE (";
                for ($i = 0; $i < count($aColumns); $i++) {
                    $sWhere .= $aColumnTable [$i] . " LIKE '%" . mysql_real_escape_string($sSearchVal) . "%' OR ";
                }
                $sWhere = substr_replace($sWhere, "", -3);
                $sWhere .= ') AND fx_trx_sj.deleted = 0 AND fx_trx_sj.sj_date = "' .  $sj_date . '"';
            }
           
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
                    $sWhere .= $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($search_val) . "%' ";
                }
            }

            if (!empty($dt['columns'][5]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }
                $sj_date = date('Y-m-d', strtotime($dt['columns'][5]['search']['value']));
                $sWhere.= " fx_trx_sj.deleted = 0 AND DATE(fx_trx_sj.sj_date) = '" . $sj_date . "' ";
            }
            
            /* Get Data To Display */
            if ($sWhere != "") {
                $where = $sWhere;
            } else {
                $where = " WHERE fx_trx_sj.deleted = 0 AND fx_trx_sj.sj_date = '". $sj_date ."'";
            }

            $join_table = ' LEFT JOIN fx_mst_trucks ON fx_trx_sj.truck_id = fx_mst_trucks.truck_id LEFT JOIN fx_mst_vessels ON fx_trx_sj.vessel_id = fx_mst_vessels.vessel_id ';

            $sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) .
                    " FROM " . $dt['table'] . $join_table .  $where . $groupBy . $sOrder . $sLimit;
            $rResult = mysql_query($sQuery, $gaSql['link']) or fatal_error( 'MySQL Error: ' . mysql_errno());

            /* Data set length after filtering */
            $sQuery = "SELECT FOUND_ROWS()";
            $rResultFilterTotal = mysql_query( $sQuery, $gaSql['link'] ) or fatal_error( 'MySQL Error: ' . mysql_errno() );
            $aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
            $iFilteredTotal = $aResultFilterTotal[0];

            /** Output */
            $draw = $dt['draw'];
            $data = array();
            if (!empty($rResult)) {
                while($aRow = mysql_fetch_array($rResult, MYSQL_ASSOC)) {
                    $dt['start'] ++;
                    $row = array(); 
                    $row['no'] = $dt['start'];
                    $row['do_no'] = substr($aRow['sj_ref'], 2);
                    $row['driver_name'] = $aRow['driver_name'];
                    $row['police_no'] = $aRow['truck_name'];
                    $row['vessel_name'] = $aRow['vessel_name'];
                    $row['do_date'] = $aRow['sj_date'] . ' ' . $aRow['sj_time'];
                    $row['qty_deliver'] =  (int) $aRow['qty_bulk_delivery_netto'];
                    $row['receipt_date'] = $aRow['receipt_date'];
                    $row['qty_receipt'] = (int) $aRow['qty_bulk_receipt_netto'];
                    $row['str_do_date'] = (date('d-m-Y',strtotime($row['do_date'])) == '01-01-1970') ? '-' : date('d-m-Y',strtotime($row['do_date']));
                    $row['str_receipt_date'] = (date('d-m-Y',strtotime($aRow['receipt_date'])) == '01-01-1970') ? '-' : date('d-m-Y',strtotime($aRow['receipt_date']));
                    $row['barcode_no'] = strtoupper($aRow['reg_no_sj']);

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

    function fetch_data_reimburse() { 
        if ($this->input->is_ajax_request()) {

            /* Database connection information */
            $gaSql['user']       = "german";
            $gaSql['password']   = "71KJ1171r74";
            $gaSql['db']         = "tas_prod";
            $gaSql['server']     = "200.10.10.3:34123";

            if (!$gaSql['link'] = mysql_pconnect( $gaSql['server'], $gaSql['user'], $gaSql['password'] )) {
                fatal_error( 'Could not open connection to server' );
            }
         
            if (!mysql_select_db( $gaSql['db'], $gaSql['link'])){
                fatal_error('Could not select database');
            }

            $dt = $_POST;
            if($this->session->userdata('start_date_ar') == '' ){
                $start_date = date("Y-m-d", strtotime('-6 day'));
            }else{
                $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_ar')));
            }

            if($this->session->userdata('end_date_ar') == ''){
                $end_date = date("Y-m-d");
            }else{
                $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_ar')));
            }
            $str_between = " Tgl_Reimburst BETWEEN '" . $start_date . "' and '" . $end_date ."'";

            $dt['table'] = 'reimburse_h';
            $dt['id'] = 'Kd_Perusahaan';

            $aColumnTable = array(
               'Kd_Perusahaan', 'No_Reimburst', 'Tgl_Reimburst', 'Type_Adv', 'Kd_Perusahaan', 'Kd_Cab_Perusahaan', 'Grand_Total_REIMBURST'
            );

            $aColumns = array(
               'Kd_Perusahaan', 'No_Reimburst', 'Tgl_Reimburst', 'Type_Adv', 'Kd_Perusahaan', 'Kd_Cab_Perusahaan', 'Grand_Total_REIMBURST'
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
                $sOrder .= " Tgl_Reimburst ASC, No_Reimburst ASC";
            }

            if (!empty($dt['columns'][7]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $start_date = date('Y-m-d', strtotime($dt['columns'][7]['search']['value']));
                $this->session->set_userdata('start_date_ar',date("Y-m-d",strtotime($start_date)));

                if($this->session->userdata('end_date_ar') == ''){
                    $end_date = date("Y-m-d");
                }else{
                    $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_ar')));
                }
                $str_between = " Tgl_Reimburst BETWEEN '" . $start_date . "' and '" . $end_date ."'";

                $sWhere.= $str_between; 
            }

            if (!empty($dt['columns'][8]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $end_date = date('Y-m-d', strtotime($dt['columns'][8]['search']['value']));
                $this->session->set_userdata('end_date_ar', date("Y-m-d",strtotime($end_date)));

                if($this->session->userdata('start_date_ar') == ''){
                    $start_date = date("Y-m-d", strtotime('-6 day'));
                }else{
                    $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_ar')));
                }
                $str_between = " Tgl_Reimburst BETWEEN '" . $start_date . "' and '" . $end_date ."'";
                
                $sWhere.=  $str_between; 
            }
           
            /** Filtering * */
            $sWhere = "";
            $sSearchVal = $dt['search']['value'];
            if (isset($sSearchVal) && $sSearchVal != '') {
                $sWhere = " WHERE (";
                for ($i = 0; $i < count($aColumns); $i++) {
                    $sWhere .= $aColumnTable [$i] . " LIKE '%" . mysql_real_escape_string($sSearchVal) . "%' OR ";
                }
                $sWhere = substr_replace($sWhere, "", -3);
                $sWhere .= ') AND ' .  $str_between;
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
                    $sWhere .= $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($search_val) . "%' ";
                }
            }
           
            /** Total Data Set Length * */
            $sQuery = "SELECT * FROM " . $dt['table'] . ' WHERE ' . $str_between;
            $rResultTotal = mysql_query($sQuery, $gaSql['link']) or fatal_error( 'MySQL Error: ' . mysql_errno() );
            $aResultTotal = mysql_num_rows($rResultTotal);
            $iTotal = $aResultTotal;

            /* Get Data To Display */
            if ($sWhere != "") {
                $where = $sWhere;
            } else {
                $where = " WHERE " . $str_between;
            }

            $join_table = '';

            $sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) .
                    " FROM " . $dt['table'] . $join_table .  $where . $groupBy . $sOrder . $sLimit;
            $rResult = mysql_query($sQuery, $gaSql['link']) or fatal_error( 'MySQL Error: ' . mysql_errno());

            /* Data set length after filtering */
            $sQuery = "SELECT FOUND_ROWS()";
            $rResultFilterTotal = mysql_query( $sQuery, $gaSql['link'] ) or fatal_error( 'MySQL Error: ' . mysql_errno() );
            $aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
            $iFilteredTotal = $aResultFilterTotal[0];

            /** Output */
            $draw = $dt['draw'];
            $data = array();
            if (!empty($rResult)) {
                while($aRow = mysql_fetch_array($rResult, MYSQL_ASSOC)) {
                    $dt['start'] ++;
                    $row = array(); 
                    $row['no'] = $dt['start'];
                    $row['reimburse_no'] = $aRow['No_Reimburst'];
                    $row['reimburse_date'] = date('d F Y',strtotime($aRow['Tgl_Reimburst']));
                    $row['advance_type'] = $aRow['Type_Adv'];
                    $row['company_code'] = $aRow['Kd_Perusahaan'];
                    $row['branch_company_code'] = $aRow['Kd_Cab_Perusahaan'];

                    $btn_action = '<button type="button" class="btn btn-sm btn-info" onclick="ApproveReimburse(\''.$aRow['No_Reimburst'].'\',\''.$row['reimburse_date'].'\',\''.$aRow['Grand_Total_REIMBURST'].'\')"><i class="fa fa-list-alt"></i> Detail</button></td>';
                    $row['action'] = $btn_action;

                    $row['start_date'] = $aRow['Tgl_Reimburst'];
                    $row['end_date'] = $aRow['Tgl_Reimburst'];
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
}