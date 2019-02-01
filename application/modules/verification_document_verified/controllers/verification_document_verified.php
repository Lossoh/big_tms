<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Verification_document_verified extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('verification_document_verified_model');
        $this->load->library('pdf_generator');
    }
    
    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('verification_documents_verified') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('verification_documents_verified');
        $this->session->set_userdata('page_header', 'transaction');
        $this->session->set_userdata('page_detail', 'verification_document_verified');
        $data['datatables'] = true;
        $data['form'] = true;
        
        // if($this->session->userdata('start_date_vd') == '' && $this->session->userdata('end_date_vd') == ''){
        //     $str_between = "AND `a`.`date_created` BETWEEN '".date('Y-m-d',strtotime("-1 days"))."' and '".date("Y-m-d")."'";
        //     $start_date = date("d-m-Y",strtotime("-1 days"));
        //     $end_date = date("d-m-Y");
        // }
        // else{
        //     $str_between = "AND `a`.`date_created` BETWEEN '".$this->session->userdata('start_date_vd')."' and '".$this->session->userdata('end_date_vd')."'";
        //     $start_date = date("d-m-Y",strtotime($this->session->userdata('start_date_vd')));
        //     $end_date = date("d-m-Y",strtotime($this->session->userdata('end_date_vd')));
        // }

        if($this->session->userdata('start_date_vd') == ''){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = date("d-m-Y",strtotime($this->session->userdata('start_date_vd')));
        }

        if($this->session->userdata('end_date_vd') == ''){
            $end_date = date("d-m-Y");
        }else{
            $end_date = date("d-m-Y",strtotime($this->session->userdata('end_date_vd')));
        }
        $str_between = " AND `a`.`date_created` BETWEEN '" . $start_date . "' and '" . $end_date ."'";
        
        // $sql = "SELECT `a`.`rowID`, `a`.`trx_no`, `a`.`jo_no`, `a`.`do_no`, a.deliver_weight, a.received_weight, a.deliver_date, a.received_date, `a`.`status`, `a`.`deleted`, `a`.`invoice_no`, `a`.`commission_no`, `a`.`komisi_supir`, `a`.`komisi_kernet`, `a`.`date_verified`,
        //                 `b`.`advance_no`, `b`.`advance_date`, `b`.`advance_allocation`, `c`.`debtor_name`, `d`.`police_no`, e.alloc_date, e.doc_sj, e.doc_st, e.doc_sm, e.doc_sr, 
        //                 `f`.`vessel_name`, g.destination_name as from_name, h.destination_name as to_name, i.item_name
        //         FROM (`tr_do_trx` as a) 
        //             LEFT JOIN `cb_cash_adv` as b ON `a`.`trx_no` = `b`.`trx_no` 
        //             LEFT JOIN `sa_debtor` as c ON `b`.`employee_driver_rowID` = `c`.`rowID` 
        //             LEFT JOIN `sa_vehicle` as d ON `b`.`vehicle_rowID` = `d`.`rowID` 
        //             LEFT JOIN `cb_cash_adv_alloc` as e ON `a`.`trx_no` = `e`.`alloc_no` 
        //             LEFT JOIN `tr_jo_trx_hdr` as f ON `a`.`jo_no` = `f`.`jo_no`
        //             LEFT JOIN `sa_destination` as g ON `f`.`destination_from_rowID` = `g`.`rowID`
        //             LEFT JOIN `sa_destination` as h ON `f`.`destination_to_rowID` = `h`.`rowID`
        //             LEFT JOIN `sa_item` as i ON `f`.`item_rowID` = `i`.`rowID`
        //         WHERE `a`.`deleted` = 0 AND `b`.`deleted` = 0 AND `e`.`deleted` = 0 AND `f`.`deleted` = 0 AND `a`.`status` = 1 ".$str_between." 
        //         ORDER BY `a`.`trx_no`, `b`.`advance_date` desc, `a`.`received_date` desc, `c`.`debtor_name` asc, `a`.`do_no` asc";
        
        // $data['verification_documents_verified'] = $this->db->query($sql)->result();
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        
        $this->template->set_layout('users')->build('verification_documents_verified', isset($data) ? $data : null);
    }
    
    function set_filter(){
       $this->session->set_userdata('start_date_vd',date("Y-m-d",strtotime($this->input->post('start_date'))));
       $this->session->set_userdata('end_date_vd',date("Y-m-d",strtotime($this->input->post('end_date'))));    
       
       redirect(base_url().'verification_document_verified');
    }
    
    function get_data_detail(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $row_id = $_POST['row_id'];
        
        $hasil = $this->verification_document_verified_model->get_data_do_by_id($row_id);
        
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }

    function get_data_jo(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $jo_type = $_POST['jo_type'];
        $from_id = $_POST['from_id'];
        $to_id = $_POST['to_id'];
        
        $hasil = $this->verification_document_verified_model->get_data_jo_by_filter($jo_type,$from_id,$to_id);
        
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function verify_password()
    {

        $this->load->model('tank_auth/users');
        $user_id = $this->session->userdata('user_id');

        Header('Content-Type: application/json; charset=UTF8');
        $trx_no = $this->input->post('trx_no');
        $row_id = $this->input->post('row_id');

        if (!is_null($user = $this->users->get_user_by_id($user_id, true)))
        {
            // Cek usermenu by user
            $get_user = $this->verification_document_verified_model->get_verify_user();
            $status_password = false;
            
            foreach($get_user as $row_user){
                // Check if password correct
                $password = $this->input->post('password');
                $hasher = new PasswordHash($this->config->item('phpass_hash_strength',
                    'tank_auth'), $this->config->item('phpass_hash_portable', 'tank_auth'));
                if ($hasher->CheckPassword($password, $user->password))
                {   
                    // success
                    $check_verification_document = $this->db->get_where('tr_do_trx', array('rowID' =>$row_id))->row_array();
                                    
                    if (empty($check_verification_document['rowID'])) {
                        echo json_encode(array("success" => false, 'msg' => lang('no_data_transaction')));
                        exit();
                    } 
                    else { 
                        // edit Data
                        if($check_verification_document['status'] == 0){
                            $status = 1;
                        }
                        else{
                            $status = 0;
                        }
                        
                        $this->verification_document_verified_model->update_data_by_row_id($row_id,$status);
                        
                    }
                    
                    $status_password = true;
                    break;
                } 
                else{ 
                    // fail
                    $status_password = false;
                }
            }
            
            if($status_password){
                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'Unverify Document';
                $params['module_field_id'] = $row_id;
                $params['activity'] = ucfirst('Unverify document with id : ' . $row_id. ' and realization no : '.$trx_no);
                $params['icon'] = 'fa-check';
                modules::run('activitylog/log', $params); //log activity

                echo json_encode(array("success" => true, 'msg' => lang('your_password_correct').' and '.lang('status_changed')));
                exit();    
            }
            else{
                echo json_encode(array('success' => false, 'msg' => lang('your_password_incorrect')));
                exit();
            }

        } 
        else{
            echo json_encode(array('success' => false, 'msg' => "Failed"));
            exit();
        }
    }
    
    function unverify($row_id){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $check_verification_document = $this->db->get_where('tr_do_trx', array('rowID' =>$row_id))->row_array();
        
        if (empty($check_verification_document['rowID'])) {
            echo json_encode(array("success" => false, 'msg' => lang('no_data_transaction')));
            exit();
        } 
        else { 
            // edit Data
            if($check_verification_document['status'] == 0){
                $status = 1;
            }
            else{
                $status = 0;
            }
            $this->verification_document_verified_model->update_data_by_row_id($row_id,$status);

            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Unverify Document';
            $params['module_field_id'] = $row_id;
            $params['activity'] = ucfirst('Unverify Document with ID : ' . $row_id. ' and Realization No : '.$check_verification_document['trx_no']);
            $params['icon'] = 'fa-check';
            modules::run('activitylog/log', $params); //log activity

            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('status_changed')));
            exit();

        }
    }
    
    function update($row_id)
    {
        
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $check_verification_document = $this->db->get_where('tr_do_trx', array('rowID' =>$row_id))->row_array();
                        
        if (empty($check_verification_document['rowID'])) {
            echo json_encode(array("success" => false, 'msg' => lang('no_data_transaction')));
            exit();
        } 
        else { 
            // edit Data
            if($check_verification_document['status'] == 0){
                $status = 1;
            }
            else{
                $status = 0;
            }
            $this->verification_document_verified_model->update_data_by_row_id($row_id,$status);

            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Verify Document';
            $params['module_field_id'] = $row_id;
            $params['activity'] = ucfirst('Verify document with id : ' . $row_id);
            $params['icon'] = 'fa-check';
            modules::run('activitylog/log', $params); //log activity

            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('status_changed')));
            exit();

        }

    }
    
    function update_document()
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $dataPost = $this->input->post();
        $row_id = $dataPost['row_id_edit'];
        
        $check_verification_document = $this->db->get_where('tr_do_trx', array('rowID' =>$row_id))->row_array();
                        
        if (empty($check_verification_document['rowID'])) {
            echo json_encode(array("success" => false, 'msg' => lang('no_data_transaction')));
            exit();
        } 
        else { 
            // edit Data
            
            $this->verification_document_verified_model->update_document($dataPost);

            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Update DO in Verify Document';
            $params['module_field_id'] = $row_id;
            $params['activity'] = ucfirst('Update document with id : ' . $row_id);
            $params['icon'] = 'fa-edit';
            modules::run('activitylog/log', $params); //log activity

            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => 'Update successfully.'));
            exit();

        }

    }
    
    function pdf()
    {
        if($this->session->userdata('start_date_vd') == ''){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_vd')));
        }

        if($this->session->userdata('end_date_vd') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_vd')));
        }
         $str_between = "AND `b`.`advance_date` BETWEEN '". $start_date ."' and '". $end_date ."'";

        // if($this->session->userdata('start_date_vd') == '' && $this->session->userdata('end_date_vd') == ''){
        //     $str_between = "AND `b`.`advance_date` BETWEEN '".date('Y-m-d',strtotime("-1 days"))."' and '".date("Y-m-d")."'";
        //     $start_date = date("d-m-Y",strtotime("-1 days"));
        //     $end_date = date("d-m-Y");
        // }
        // else{
        //     $str_between = "AND `b`.`advance_date` BETWEEN '".$this->session->userdata('start_date_vd')."' and '".$this->session->userdata('end_date_vd')."'";
        //     $start_date = date("d-m-Y",strtotime($this->session->userdata('start_date_vd')));
        //     $end_date = date("d-m-Y",strtotime($this->session->userdata('end_date_vd')));
        // }
        
        $sql = "SELECT `a`.`rowID`, `a`.`trx_no`, `a`.`jo_no`, `a`.`do_no`, a.deliver_weight, a.received_weight, a.deliver_date, a.received_date, `a`.`status`, `a`.`deleted`, `a`.`invoice_no`, `a`.`commission_no`,
                        `b`.`advance_no`, `b`.`advance_date`, `b`.`advance_allocation`, `c`.`debtor_name`, `d`.`police_no`, e.alloc_date, e.doc_sj, e.doc_st, e.doc_sm, e.doc_sr, 
                        `f`.`vessel_name`, g.destination_name as from_name, h.destination_name as to_name, i.item_name
                FROM (`tr_do_trx` as a) 
                    LEFT JOIN `cb_cash_adv` as b ON `a`.`trx_no` = `b`.`trx_no` 
                    LEFT JOIN `sa_debtor` as c ON `b`.`employee_driver_rowID` = `c`.`rowID` 
                    LEFT JOIN `sa_vehicle` as d ON `b`.`vehicle_rowID` = `d`.`rowID` 
                    LEFT JOIN `cb_cash_adv_alloc` as e ON `a`.`trx_no` = `e`.`alloc_no` 
                    LEFT JOIN `tr_jo_trx_hdr` as f ON `a`.`jo_no` = `f`.`jo_no`
                    LEFT JOIN `sa_destination` as g ON `f`.`destination_from_rowID` = `g`.`rowID`
                    LEFT JOIN `sa_destination` as h ON `f`.`destination_to_rowID` = `h`.`rowID`
                    LEFT JOIN `sa_item` as i ON `f`.`item_rowID` = `i`.`rowID`
                WHERE `a`.`deleted` = 0 AND `b`.`deleted` = 0 AND `e`.`deleted` = 0 AND `a`.`status` = 1 ".$str_between." 
                ORDER BY `a`.`received_date`, `c`.`debtor_name`, `a`.`do_no` asc";
                
        $data['verification_documents_verified'] = $this->db->query($sql)->result();
        $data['periode'] = date("d F Y",strtotime($start_date)).' - '.date("d F Y",strtotime($end_date));
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        
        $html = $this->load->view('verification_documents_verified_pdf', $data, true);
        $this->pdf_generator->generate($html, 'Verification Document',$orientation='Landscape'); // Portrait
    }
    
    function detail_do(){
        error_reporting(E_ALL);
        $do_no = $this->input->post('do_no');
        
        $get_data_ca = $this->verification_document_verified_model->get_ca_by_do_no($do_no);
        
        $data['get_data_ca'] = $get_data_ca;
        
        $this->load->view('detail_data_do', $data);
        
    }
    
    function detail_jo(){
        error_reporting(E_ALL);
        $jo_no = $this->input->post('jo_no');
        
        $get_data_jo = $this->verification_document_verified_model->get_jo_by_jo_no($jo_no);
        
        $data['get_data_jo'] = $get_data_jo;
        
        $this->load->view('detail_data_jo', $data);
        
    }

    function get_user_access($field){
        $this->db->where('status','1');
        $this->db->where('Link_Menu', 'verification_document_verified');
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

    function fetch_data() { 
        if ($this->input->is_ajax_request()) {
            $dt = $_POST;

            if($this->session->userdata('start_date_vd') == ''){
                $start_date = date("Y-m-d", strtotime('-6 day'));
            }else{
                $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_vd')));
            }

            if($this->session->userdata('end_date_vd') == ''){
                $end_date = date("Y-m-d");
            }else{
                $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_vd')));
            }
            $str_between = " AND tr_do_trx.date_created BETWEEN '".$start_date."' and '".$end_date."'";
           
            $dt['table'] = 'tr_do_trx';
            $dt['id'] = 'rowID';
            $aColumnTable = array(
                'tr_do_trx.rowID', 'sa_debtor.debtor_name', 'tr_do_trx.komisi_supir', 'tr_do_trx.komisi_kernet', 'cb_cash_adv_alloc.doc_sj', 'cb_cash_adv_alloc.doc_st', 'cb_cash_adv_alloc.doc_sm', 'cb_cash_adv_alloc.doc_sr', 'tr_do_trx.do_no', 'tr_do_trx.container_no', 'tr_do_trx.received_date', 'tr_do_trx.received_weight', 'tr_do_trx.jo_no', 'tr_jo_trx_hdr.vessel_name', 'destination_from.destination_name', 'destination_to.destination_name', 'sa_item.item_name', 'tr_do_trx.status', 'tr_do_trx.trx_no', 'sa_users.username', 'tr_do_trx.invoice_no', 'tr_do_trx.commission_no'
            );

            $aColumns = array(
              'tr_do_trx.rowID', 'sa_debtor.debtor_name', 'tr_do_trx.komisi_supir', 'tr_do_trx.komisi_kernet', 'cb_cash_adv_alloc.doc_sj', 'cb_cash_adv_alloc.doc_st', 'cb_cash_adv_alloc.doc_sm', 'cb_cash_adv_alloc.doc_sr', 'tr_do_trx.do_no', 'tr_do_trx.container_no', 'tr_do_trx.received_date', 'tr_do_trx.received_weight', 'tr_do_trx.jo_no', 'tr_jo_trx_hdr.vessel_name', 'destination_from.destination_name as from_name', 'destination_to.destination_name as to_name', 'sa_item.item_name', 'tr_do_trx.status', 'tr_do_trx.trx_no', 'sa_users.username', 'tr_do_trx.invoice_no', 'tr_do_trx.commission_no', 'tr_do_trx.date_created', 'tr_do_trx.date_created'          
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
                $sOrder .= " tr_do_trx.trx_no, cb_cash_adv.advance_date DESC, tr_do_trx.received_date DESC, sa_debtor.debtor_name ASC, tr_do_trx.do_no ASC ";
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
            
            if (!empty($dt['columns'][14]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $start_date = date('Y-m-d', strtotime($dt['columns'][14]['search']['value']));
                $this->session->set_userdata('start_date_vd',date("Y-m-d",strtotime($start_date)));

                if($this->session->userdata('end_date_vd') == ''){
                    $end_date = date("Y-m-d");
                }else{
                    $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_vd')));
                }
                $this->session->set_userdata('end_date_vd', date("Y-m-d",strtotime($end_date)));
                $str_between = " AND tr_do_trx.date_created BETWEEN '". $start_date ."' AND '". $end_date ."'";
                
                $sWhere.= ' tr_do_trx.deleted = 0 AND cb_cash_adv.deleted = 0 AND cb_cash_adv_alloc.deleted = 0 AND tr_jo_trx_hdr.deleted = 0 AND tr_do_trx.status = 1 ' . $str_between; 
            }

            if (!empty($dt['columns'][15]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $end_date = date('Y-m-d', strtotime($dt['columns'][15]['search']['value']));
                $this->session->set_userdata('end_date_vd', date("Y-m-d",strtotime($end_date)));

                if($this->session->userdata('start_date_vd') == ''){
                    $start_date = date("Y-m-d", strtotime('-6 day'));
                }else{
                    $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_vd')));
                }
                $this->session->set_userdata('start_date_vd',date("Y-m-d",strtotime($start_date)));
                $str_between = " AND tr_do_trx.date_created BETWEEN '". $start_date ."' AND '". $end_date ."'";
                
                $sWhere.= ' tr_do_trx.deleted = 0 AND cb_cash_adv.deleted = 0 AND cb_cash_adv_alloc.deleted = 0 AND tr_jo_trx_hdr.deleted = 0 AND tr_do_trx.status = 1 ' . $str_between; 
            }

             /** Filtering * */
            $sWhere = "";
            $sSearchVal = $dt['search']['value'];
            if (isset($sSearchVal) && $sSearchVal != '') {
                $sWhere = " WHERE (";
                for ($i = 0; $i < count($aColumnTable); $i++) {
                    $sWhere .= $aColumnTable[$i] . " LIKE '%" . $this->db->escape_like_str($sSearchVal) . "%' OR ";
                }
                $sWhere = substr_replace($sWhere, "", -3);
                $sWhere .= ') AND tr_do_trx.deleted = 0 AND cb_cash_adv.deleted = 0 AND cb_cash_adv_alloc.deleted = 0 AND tr_jo_trx_hdr.deleted = 0 AND tr_do_trx.status = 1 ' . $str_between;
            }

        
            /** Total Data Set Length * */
            $sQuery = "SELECT * FROM " . $dt['table'] . " 
            LEFT JOIN cb_cash_adv ON tr_do_trx.trx_no = cb_cash_adv.trx_no 
            LEFT JOIN sa_debtor ON cb_cash_adv.employee_driver_rowID = sa_debtor.rowID 
            LEFT JOIN sa_vehicle ON cb_cash_adv.vehicle_rowID = sa_vehicle.rowID 
            LEFT JOIN cb_cash_adv_alloc ON tr_do_trx.trx_no = cb_cash_adv_alloc.alloc_no 
            LEFT JOIN tr_jo_trx_hdr ON tr_do_trx.jo_no = tr_jo_trx_hdr.jo_no 
            LEFT JOIN sa_destination as destination_from ON tr_jo_trx_hdr.destination_from_rowID = destination_from.rowID 
            LEFT JOIN sa_destination as destination_to ON tr_jo_trx_hdr.destination_to_rowID = destination_to.rowID 
            LEFT JOIN sa_item ON tr_jo_trx_hdr.item_rowID = sa_item.rowID 
            LEFT JOIN sa_users ON tr_do_trx.user_created = sa_users.rowID WHERE tr_do_trx.deleted = 0 AND cb_cash_adv.deleted = 0 AND cb_cash_adv_alloc.deleted = 0 AND tr_jo_trx_hdr.deleted = 0 AND tr_do_trx.status = 1 ". $str_between;
            $rResultTotal = $this->db->query($sQuery);
            $aResultTotal = $rResultTotal->num_rows();
            $iTotal = $aResultTotal;
            
            /* Get Data To Display */
            if ($sWhere != "") {
                $where = $sWhere;
            } else {
                $where = " WHERE tr_do_trx.deleted = 0 AND cb_cash_adv.deleted = 0 AND cb_cash_adv_alloc.deleted = 0 AND tr_jo_trx_hdr.deleted = 0 AND tr_do_trx.status = 1 " . $str_between;
            }

            $join_table = " LEFT JOIN cb_cash_adv ON tr_do_trx.trx_no = cb_cash_adv.trx_no LEFT JOIN sa_debtor ON cb_cash_adv.employee_driver_rowID = sa_debtor.rowID LEFT JOIN sa_vehicle ON cb_cash_adv.vehicle_rowID = sa_vehicle.rowID LEFT JOIN cb_cash_adv_alloc ON tr_do_trx.trx_no = cb_cash_adv_alloc.alloc_no LEFT JOIN tr_jo_trx_hdr ON tr_do_trx.jo_no = tr_jo_trx_hdr.jo_no LEFT JOIN sa_destination as destination_from ON tr_jo_trx_hdr.destination_from_rowID = destination_from.rowID LEFT JOIN sa_destination as destination_to ON tr_jo_trx_hdr.destination_to_rowID = destination_to.rowID LEFT JOIN sa_item ON tr_jo_trx_hdr.item_rowID = sa_item.rowID LEFT JOIN sa_users ON tr_do_trx.user_created = sa_users.rowID ";

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

                    $document = '';
                    if($aRow['doc_sj'] == 'Yes'){
                        $document .= 'SJ, ';
                    }
                    if($aRow['doc_st'] == 'Yes'){
                        $document .= 'ST, ';
                    }
                    if($aRow['doc_sm'] == 'Yes'){
                        $document .= 'SM, ';
                    }
                    if($aRow['doc_sr'] == 'Yes'){
                        $document .= 'SR, ';
                    }
                    
                    if($document != ''){
                        $document = substr($document,0,-2);
                    }
                    
                    $star_invoiced = '';
                    $star_commission = '';
                    if($aRow['invoice_no'] != ''){
                        $star_invoiced = '<span style="color:#08d24f">*</span>';
                    }
                    if($aRow['commission_no'] != ''){
                        $star_commission = '<span style="color:#F00">*</span>';
                    }                    

                    $row['no'] = $dt['start'];                    
                    $row['debtor_name'] = $aRow['debtor_name'];
                    $row['komisi_supir'] = number_format($aRow['komisi_supir'],0,',','.');
                    $row['komisi_kernet'] = number_format($aRow['komisi_kernet'],0,',','.');
                    $row['document'] = $document;
                    $row['do_no'] = ($aRow['do_no'] == '') ? '-' : '<a href="javascript:void()" onclick="showDetailDO(\''.$aRow['do_no'].'\')">'. $aRow['do_no'].$star_commission.$star_invoiced.'</a>';
                    $row['container_no'] = ($aRow['container_no'] == '') ? '-' : $aRow['container_no'];
                    $row['received_date'] = date("d-m-Y",strtotime($aRow['received_date']));
                    $row['received_weight'] = number_format($aRow['received_weight'],0,',','.');
                    $row['jo_no'] = '<a href="javascript:void()" onclick="showDetailJO(\''. $aRow['jo_no'] . '\')">' .$aRow['jo_no']. '</a>';
                    $row['vessel_name'] = $aRow['vessel_name'];
                    $row['from_name'] = $aRow['from_name'] . ' - ' . $aRow['to_name'];
                    $row['item_name'] = $aRow['item_name'];
                    $row['trx_no'] = $aRow['trx_no'];
                    $row['username'] = ucfirst($aRow['username']);

                    $button_verification = '';
                    $button_edit = '';

                    if($aRow['status'] == 0){
                        if($this->get_user_access('Verified') == 1){
                            $button_verification = '<button class="btn btn-sm btn-success" title="'.lang('verify').'" onclick="verification_document(\''. $aRow['trx_no'] .'\',\''. $aRow['rowID'] .'\',\''. $aRow['vessel_name'] .'\',\''. $aRow['from_name'] .' - '. $aRow['to_name'] .'\',\''. $aRow['item_name'] .'\')"><i class="fa fa-check"></i></button>';
                        }
                        if($this->get_user_access('Updated') == 1){
                            $button_edit = '<button class="btn btn-sm yellow" title="Edit" onclick="edit_document(' . $aRow['rowID'] . ')"><i class="fa fa-edit"></i></button>';
                        }                                
                    }else{
                        if($this->get_user_access('Verified') == 1){
                            if($aRow['invoice_no'] == ''){
                                $button_verification = '<button class="btn btn-sm red" title="' . lang('unverify') . '" onclick="unverify_document(\''. $aRow['trx_no'] .'\',\''. $aRow['rowID'] .'\')"><i class="fa fa-times"></i></button>';
                            } 
                        }
                        if($this->get_user_access('Updated') == 1){
                            if($aRow['invoice_no'] == ''){
                                $button_edit = '<button class="btn btn-sm yellow" title="JO Verification" id="btn_jo_verification_'. $aRow['rowID'] .'" onclick="jo_verification(\''.$aRow['rowID'].'\')"><i class="fa fa-edit"></i></button>';
                            } 
                        }   
                    }

                    $row['action'] = $button_verification . ' ' . $button_edit;

                    $row['start_date'] = $aRow['date_created'];
                    $row['end_date'] = $aRow['date_created'];

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

/* End of file contacts.php */
