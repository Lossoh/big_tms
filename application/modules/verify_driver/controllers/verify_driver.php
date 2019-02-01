<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Verify_driver extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('verify_driver_model');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('verify_drivers') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('verify_drivers');
        $this->session->set_userdata('page_header', 'transaction');
        $this->session->set_userdata('page_detail', 'verify_driver');
        $data['datatables'] = true;
        $data['form'] = true;
        
        // $data['verify_drivers'] = $this->verify_driver_model->get_all_record_data_debtor();

        $this->template->set_layout('users')->build('verify_drivers', isset($data) ? $data : null);
    }

    function update_queue(){
        $rowID = $this->input->post('rowID');
        $debtor_name = $this->input->post('debtor_name');
        $remark = ucfirst($this->input->post('remark'));
        
        $data_queue = array(
            'date_modified' => null,
            'user_modified' => 0
        );
        
        $this->db->where('rowID',$this->input->post('rowID'));
        $this->db->update('tr_queue', $data_queue);

        $params['user_rowID'] = $this->tank_auth->get_user_id();
        $params['module'] = 'verify_driver';
        $params['module_field_id'] = $rowID;
        $params['activity'] = ucfirst('Update queue with id = "' . $rowID . '", debtor = "'.$debtor_name.'", because "'.$remark.'".');
        $params['icon'] = 'fa-edit';
        modules::run('activitylog/log', $params); //log activity
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode(array("success" => true, 'msg' => lang('verify_succesfully')));
        exit();
    }

    function insert_queue(){
        $debtor_id = $this->input->post('debtor_id');
        
        $data_queue = array(
            'debtor_id' => $debtor_id,
            'type_finger' => 0,
            'date_modified' => null,
            'user_modified' => 0
        );
        
        $this->db->insert('tr_queue', $data_queue);
        
        $data_attendance = array(
            'debtor_id' => $debtor_id,
            'absent_code' => 'R',
            'note'  => 'Register from Verify Driver',
            'type_finger' => '',
            'user_modified' => '',
            'date_modified' => '',
            'user_created' => $this->session->userdata('user_rowID'),
            'date_created' => date('Y-m-d H:i:s'),
            'date_transfer' => ''
        );
        
        $this->db->insert('tr_log_attendance', $data_attendance);

        $params['user_rowID'] = $this->tank_auth->get_user_id();
        $params['module'] = 'verify_driver';
        $params['module_field_id'] = $debtor_id;
        $params['activity'] = ucfirst('Insert queue with id = "' . $debtor_id);
        $params['icon'] = 'fa-plus';
        modules::run('activitylog/log', $params); //log activity
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode(array("success" => true, 'msg' => 'register succesfully'));
        exit();
    }
    
    function save_attendance(){
        $debtor_id = $this->input->post('debtor_id');
        $absent_code = $this->input->post('absent_code');
        $note = ucfirst($this->input->post('note'));
        
        $cek_data = $this->verify_driver_model->get_attendance_daily_by_debtor($debtor_id);
        if(count($cek_data) == 0){
            $data_attendance = array(
                'debtor_id' => $debtor_id,
                'absent_code' => $absent_code,
                'note'  => $note,
                'type_finger' => '',
                'user_modified' => '',
                'date_modified' => '',
                'user_created' => $this->session->userdata('user_rowID'),
                'date_created' => date('Y-m-d H:i:s'),
                'date_transfer' => ''
            );
            
            $this->db->insert('tr_log_attendance', $data_attendance);
            
            if($absent_code == 'B'){
                $this->db->where('debtor_id',$debtor_id);
                $this->db->delete('tr_queue');
            }
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Verify Driver';
            $params['module_field_id'] = $debtor_id;
            $params['activity'] = ucfirst('Insert attendance with debtor_id = "' . $debtor_id . '", absent_code = "'.$absent_code.'", because "'.$note.'".');
            $params['icon'] = 'fa-plus';
            modules::run('activitylog/log', $params); //log activity
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => 'Attendance succesfully'));
            exit();
        }
        else{
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => false, 'msg' => 'Attendance already exists in database today.'));
            exit();
        }
    }
    
    function api_insert_attendance_queue(){
        error_reporting(E_ALL);
        //Header('Content-Type: application/json;');
        
        $debtor_id 		= $this->input->post('debtor_id');
        $type_finger 	= $this->input->post('type_finger');
        $absent_code 	= $this->input->post('absent_code');
        $note 			= $this->input->post('note');
        $user_created 	= $this->input->post('user_created');
        $username_api 	= $this->input->post('username_api');
        $password_api 	= $this->input->post('password_api');
        
        $username_api_config = $this->config->item('username_api');
        $password_api_config = $this->config->item('password_api');
        
		echo $debtor_id.' | '.$username_api.' | '.$password_api.' | '.$username_api_config.' | '.$password_api_config;
		
        if($username_api == $username_api_config && $password_api == $password_api_config){        
            $data_queue = array(
                'debtor_id' => $debtor_id,
                'type_finger' => $type_finger,
                'date_modified' => null, // first time must be null
                'user_modified' => 0 // first time must be 0
            );
            
            $this->db->insert('tr_queue', $data_queue);
            
            $data_attendance = array(
                'debtor_id' => $debtor_id,
                'absent_code' => strtoupper($absent_code),
                'note'  => ucfirst($note),
                'type_finger' => $type_finger,
                'user_modified' => '',
                'date_modified' => '',
                'user_created' => $user_created,
                'date_created' => date('Y-m-d H:i:s'),
                'date_transfer' => ''
            );
            
            $this->db->insert('tr_log_attendance', $data_attendance);
    
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Verify Driver';
            $params['module_field_id'] = $debtor_id;
            $params['activity'] = ucfirst('Insert queue from API with id = "' . $debtor_id);
            $params['icon'] = 'fa-plus';
            modules::run('activitylog/log', $params); //log activity
            
            //Header('Content-Type: application/json; charset=UTF8');
            //json_encode(array("success" => true, 'msg' => 'register succesfully'));
            //echo $debtor_id.' | '.$username_api.' | '.$password_api.' => register succesfully.';
			exit();
        }
        else{
            //Header('Content-Type: application/json; charset=UTF8');
            //json_encode(array("success" => false, 'msg' => 'username and password API not valid.'));
            //echo $debtor_id.' | '.$username_api.' | '.$password_api.' => username and password API not valid.';
			exit();
        }
    }
    
	function api_get_data_queue(){
		$this->db->select("*");
		$this->db->from('sa_debtor');
        $query=$this->db->get();
        
        if ($query->num_rows() > 0){
			echo json_encode($query->result());
		} else{
			echo 'NULL';
		}
        
        exit;
	}
    
    function fetch_data() { 
        if ($this->input->is_ajax_request()) {
            $dt = $_POST;

            $dt['table'] = 'sa_debtor';
            $dt['id'] = 'rowID';

            $aColumnTable = array(
                'sa_debtor.rowID', 'sa_debtor.debtor_cd', 'sa_debtor.rowID', 'sa_debtor.rowID', 'sa_debtor.rowID', 'sa_debtor.rowID', 'sa_debtor.debtor_name', 'sa_debtor.type'
            );

            $aColumns = array(
                'sa_debtor.rowID', 'sa_debtor.debtor_cd', 'sa_debtor.rowID', 'sa_debtor.rowID', 'sa_debtor.rowID', 'sa_debtor.rowID', 'sa_debtor.debtor_name', 'sa_debtor.type'
            );

            $groupBy = '';
            
            /** Total Data Set Length * */
            $sQuery = 'SELECT * FROM ' . $dt['table'] . ' WHERE sa_debtor.deleted = 0 AND sa_debtor.type = "D" ';
            $rResultTotal = $this->db->query($sQuery);
            $aResultTotal = $rResultTotal->num_rows();
            $iTotal = $aResultTotal;

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
                $sOrder .= "sa_debtor.debtor_name ASC";
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

            /** Filtering * */
            $sWhere = "";
            $sSearchVal = $dt['search']['value'];
            if (isset($sSearchVal) && $sSearchVal != '') {
                $sWhere = " WHERE (";
                for ($i = 0; $i < count($aColumns); $i++) {
                    $sWhere .= $aColumns[$i] . " LIKE '%" . $this->db->escape_like_str($sSearchVal) . "%' OR ";

                }

                $mystring = 'SAKIT, Sakit, sakit';
                $pos = strpos($mystring, $sSearchVal);
                if ($pos !== false) {
                    $get_attendances = $this->verify_driver_model->get_attendance_by_absen('S');
                    foreach ($get_attendances as $get_attendance_status) {
                        $cek_last_satatus = $this->verify_driver_model->get_attendance_by_debtor($get_attendance_status->debtor_id);
                        if($cek_last_satatus->absent_code == 'S'){
                            $sWhere .= $aColumns[0] . " LIKE '%" . $this->db->escape_like_str($get_attendance_status->debtor_id) . "%' OR ";
                        }
                    }
                }

                $mystring_2 = 'IZIN, Izin, izin';
                $pos_2 = strpos($mystring_2, $sSearchVal);
                if ($pos_2 !== false) {
                    $get_attendances = $this->verify_driver_model->get_attendance_by_absen('I');
                    foreach ($get_attendances as $get_attendance_status) {
                        $cek_last_satatus = $this->verify_driver_model->get_attendance_by_debtor($get_attendance_status->debtor_id);
                        if($cek_last_satatus->absent_code == 'I'){
                            $sWhere .= $aColumns[0] . " LIKE '%" . $this->db->escape_like_str($get_attendance_status->debtor_id) . "%' OR ";
                        }
                    }
                }

                $mystring_3 = 'HADIR, Hadir, hadir';
                $pos_3 = strpos($mystring_3, $sSearchVal);
                if ($pos_3 !== false) {
                    $get_attendances = $this->verify_driver_model->get_attendance_by_absen('H');
                    foreach ($get_attendances as $get_attendance_status) {
                        $cek_last_satatus = $this->verify_driver_model->get_attendance_by_debtor($get_attendance_status->debtor_id);
                        if($cek_last_satatus->absent_code == 'H'){
                            $sWhere .= $aColumns[0] . " LIKE '%" . $this->db->escape_like_str($get_attendance_status->debtor_id) . "%' OR ";
                        }
                    }
                }

                $mystring_4 = 'ALFA, Alfa, alfa';
                $pos_4 = strpos($mystring_4, $sSearchVal);
                if ($pos_4 !== false) {
                    $get_attendances = $this->verify_driver_model->get_attendance_by_absen('A');
                    foreach ($get_attendances as $get_attendance_status) {
                        $cek_last_satatus = $this->verify_driver_model->get_attendance_by_debtor($get_attendance_status->debtor_id);
                        if($cek_last_satatus->absent_code == 'A'){
                            $sWhere .= $aColumns[0] . " LIKE '%" . $this->db->escape_like_str($get_attendance_status->debtor_id) . "%' OR ";
                        }
                    }
                }

                $mystring_5 = 'TERLAMABAT, Terlambat, terlambat';
                $pos_5 = strpos($mystring_5, $sSearchVal);
                if ($pos_5 !== false) {
                    $get_attendances = $this->verify_driver_model->get_attendance_by_absen('T');
                    foreach ($get_attendances as $get_attendance_status) {
                        $cek_last_satatus = $this->verify_driver_model->get_attendance_by_debtor($get_attendance_status->debtor_id);
                        if($cek_last_satatus->absent_code == 'T'){
                            $sWhere .= $aColumns[0] . " LIKE '%" . $this->db->escape_like_str($get_attendance_status->debtor_id) . "%' OR ";
                        }
                    }
                }

                $mystring_6 = 'BANNED, Banned, banned';
                $pos_6 = strpos($mystring_6, $sSearchVal);
                if ($pos_6 !== false) {
                    $get_attendances = $this->verify_driver_model->get_attendance_by_absen('B');
                    foreach ($get_attendances as $get_attendance_status) {
                        $cek_last_satatus = $this->verify_driver_model->get_attendance_by_debtor($get_attendance_status->debtor_id);
                        if($cek_last_satatus->absent_code == 'B'){
                            $sWhere .= $aColumns[0] . " LIKE '%" . $this->db->escape_like_str($get_attendance_status->debtor_id) . "%' OR ";
                        }
                    }
                }

                $mystring_7 = 'GANTI SUPIR, Ganti Supir, ganti supir';
                $pos_7 = strpos($mystring_7, $sSearchVal);
                if ($pos_7 !== false) {
                    $get_attendances = $this->verify_driver_model->get_attendance_by_absen('G');
                    foreach ($get_attendances as $get_attendance_status) {
                        $cek_last_satatus = $this->verify_driver_model->get_attendance_by_debtor($get_attendance_status->debtor_id);
                        if($cek_last_satatus->absent_code == 'G'){
                            $sWhere .= $aColumns[0] . " LIKE '%" . $this->db->escape_like_str($get_attendance_status->debtor_id) . "%' OR ";
                        }
                    }
                }

                $mystring_8 = 'REGISTERED, Registered, registered';
                $pos_8 = strpos($mystring_8, $sSearchVal);
                if ($pos_8 !== false) {
                    $get_attendances = $this->verify_driver_model->get_attendance_by_absen('R');
                    foreach ($get_attendances as $get_attendance_status) {
                        $cek_last_satatus = $this->verify_driver_model->get_attendance_by_debtor($get_attendance_status->debtor_id);
                        if($cek_last_satatus->absent_code == 'R'){
                            $sWhere .= $aColumns[0] . " LIKE '%" . $this->db->escape_like_str($get_attendance_status->debtor_id) . "%' OR ";
                        }
                    }
                }

                $mystring_9 = 'PENDING, Pending, pending';
                $pos_9 = strpos($mystring_9, $sSearchVal);
                if ($pos_9 !== false) {
                    $get_attendances = $this->verify_driver_model->get_attendance_by_absen('P');
                    foreach ($get_attendances as $get_attendance_status) {
                        $cek_last_satatus = $this->verify_driver_model->get_attendance_by_debtor($get_attendance_status->debtor_id);
                        if($cek_last_satatus->absent_code == 'P'){
                            $sWhere .= $aColumns[0] . " LIKE '%" . $this->db->escape_like_str($get_attendance_status->debtor_id) . "%' OR ";
                        }
                    }
                }


                $sWhere = substr_replace($sWhere, "", -3);
                $sWhere .= ') AND sa_debtor.deleted = 0 AND sa_debtor.type = "D" ';
            } 

            /* Get Data To Display */
            if ($sWhere != "") {
                $where = $sWhere;
            } else {
                $where = " WHERE sa_debtor.deleted = 0 AND sa_debtor.type = 'D' " ;
            }

            $join_table = '';

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

                    $type = '-';
                    if($aRow['type'] == 'C'){
                        $type = 'Company';
                    }else if($aRow['type'] == 'E'){
                        $type = 'Employee';
                    }else if($aRow['type'] == 'D'){
                        $type = 'Driver';
                    }

                    $get_queue = $this->verify_driver_model->get_queue_by_debtor($aRow['rowID']);
                    if(count($get_queue) > 0){
                        $date_modified = $get_queue->date_modified == '' ? '-' : date("d F Y H:i:s",strtotime($get_queue->date_modified));
                        if($get_queue->user_modified > 0){
                            $get_verify_user = $this->verify_driver_model->get_queue_by_verify_user($get_queue->user_modified);
                            $verify_fullname = ucwords(strtolower($get_verify_user->fullname));
                            $register = '<a href="javascript:void()" title="'.lang('verify').'" class="btn btn-sm yellow" onclick="verify_driver('. $get_queue->rowID . ',\'' . $aRow['debtor_cd'] . '\' - \''. $aRow['debtor_name'] .'\' - \''. $type .'\')" ><i class="fa fa-check"></i> '. lang('verify') .'</a>';
                        }
                        else{
                            $verify_fullname = '-';
                            $register = '<span class="badge" style="background-color:#5cb85c;">Ready</span>';
                        }
                    
                    }else{
                        $date_modified = '-';
                        $verify_fullname = '-';
                        $register = '<a href="javascript:void()" title="Register" class="btn btn-sm green" onclick="register_driver('. $aRow['rowID'] .')" ><i class="fa fa-plus"></i> Register</a>';
                    }

                    $status = '';
                    $get_attendance = $this->verify_driver_model->get_attendance_by_debtor($aRow['rowID']);
                    if($get_attendance->absent_code == 'S'){
                        $status = '<span class="badge" style="background-color:#5cb85c;">Sakit</span>';
                    }
                    else if($get_attendance->absent_code == 'I'){
                        $status = '<span class="badge" style="background-color:#5cb85c;">Izin</span>';
                    }
                    else if($get_attendance->absent_code == 'H'){
                        $status = '<span class="badge" style="background-color:#5cb85c;">Hadir</span>';
                    }
                    else if($get_attendance->absent_code == 'A'){
                        $status = '<span class="badge" style="background-color:#d9534f;">Alfa</span>';
                    }
                    else if($get_attendance->absent_code == 'T'){
                        $status = '<span class="badge" style="background-color:#ddd;">Terlambat</span>';
                    }
                    else if($get_attendance->absent_code == 'B'){
                        $status = '<span class="badge" style="background-color:#000;">Banned</span>';
                    }
                    else if($get_attendance->absent_code == 'G'){
                        $status = '<span class="badge" style="background-color:#5bc0de;">Ganti Supir</span>';
                    }
                    else if($get_attendance->absent_code == 'R'){
                        $status = '<span class="badge" style="background-color:#337ab7;">Registered</span>';
                    }
                    else if($get_attendance->absent_code == 'P'){
                        $status = '<span class="badge" style="background-color:#ec971f;">Pending</span>';
                    }
                    else{
                        $status = '-';
                    }
              
                    $btn_action = '';
                    if($this->get_user_access('Created') == 1){
                        $btn_action .= '<a href="javascript:void()" title="Hadir" class="btn btn-sm btn-success" onclick="set_attendance(\'' . $aRow['rowID'] . '\',\'' . 'H' . '\')" >H</a>';
                        $btn_action .= ' <a href="javascript:void()" title="Alfa" class="btn btn-sm red" onclick="set_attendance(\'' . $aRow['rowID'] . '\',\'' . 'A' . '\')" >A</a>';
                        $btn_action .= ' <a href="javascript:void()" title="Terlambat" class="btn btn-sm" style="background-color: #ddd; color: #fff" onclick="set_attendance(\'' . $aRow['rowID'] . '\',\'' . 'T' . '\')" >T</a>';
                        $btn_action .= ' <a href="javascript:void()" title="Ganti Supir" class="btn btn-sm btn-info" onclick="set_attendance(\'' . $aRow['rowID'] . '\',\'' . 'G' . '\')" >G</a>';
                        $btn_action .= ' <a href="javascript:void()" title="Banned" class="btn btn-sm" style="background-color: #000; color: #fff" onclick="set_attendance(\'' . $aRow['rowID'] . '\',\'' . 'B' . '\')" >B</a> ';
                        $btn_action .= $register;
                    }


                    $row['no'] = $dt['start'];
                    $row['debtor'] = $aRow['debtor_cd'] . ' - ' . $aRow['debtor_name'];
                    $row['date_modified'] = $date_modified;
                    $row['verify_fullname'] = $verify_fullname;
                    $row['status'] = $status;
                    $row['btn_action'] = $btn_action;

                    $row['start_date'] = $aRow['date'];
                    $row['end_date'] = $aRow['date'];
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
        $this->db->where('Link_Menu', 'verify_driver');
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

/* End of file contacts.php */
