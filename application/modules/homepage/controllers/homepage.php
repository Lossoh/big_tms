<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Homepage extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('homepage_model');
        $this->load->library('pdf_generator');        
	}

	function index()
	{
        $this->session->set_userdata(array('role_rowID'	=> $this->session->userdata('role_rowID_verify')));
        
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('welcome_to').'  '.$this->config->item('website_name'));
    	$this->session->unset_userdata('page_header');		
    	$this->session->unset_userdata('page_detail');
        $data['page'] = lang('home');
        $data['datatables'] = true;
        $data['form'] = true;

		if($this->session->userdata('start_date_daily_balance') == '' ){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_daily_balance')));
        }

        if($this->session->userdata('end_date_daily_balance') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_daily_balance')));
        }

        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;

        $data['jo_total'] = count($this->homepage_model->get_data_jo());
        $data['ca_total'] = count($this->homepage_model->get_data_ca());
        $data['realization_total'] = count($this->homepage_model->get_data_realization_ca());
        $data['unverified_total'] = count($this->homepage_model->get_data_document_unverified());
        $data['departments'] = $this->homepage_model->get_all_department();
        
        $log_balance_departments = $this->homepage_model->get_log_balance_department();
        $data_log_balance = array();
        foreach($log_balance_departments as $row){
            $use_balance_total = $this->homepage_model->get_log_use_balance_department_by_coa_id($row->gl_rowID);
            $remaining_balance_total = $row->balance_total + $use_balance_total;
            $data_log_balance_tmp = array(
                'department_name' => $row->code . ' - ' . $row->name,
                'balance_total' => $row->balance_total,
                'use_balance_total' => $use_balance_total,
                'remaining_balance_total' => $remaining_balance_total,
            );
            array_push($data_log_balance, $data_log_balance_tmp);
        }
        $data['data_log_balance'] = $data_log_balance;

        $this->template->set_layout('users')->build('homepage',isset($data) ? $data : NULL);
        
	}
	
    function pdf()
    {   
		if($this->session->userdata('start_date_daily_balance') == '' ){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_daily_balance')));
        }

        if($this->session->userdata('end_date_daily_balance') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_daily_balance')));
        }

        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;

        $data['balance'] = $this->homepage_model->get_all_records_by_period($start_date, $end_date);
        $html = $this->load->view('balance_pdf', $data, true);
        $this->pdf_generator->generate($html, 'balance pdf',$orientation='Portrait');
    }
    
    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=daily_balance.xls");
        
		if($this->session->userdata('start_date_daily_balance') == '' ){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_daily_balance')));
        }

        if($this->session->userdata('end_date_daily_balance') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_daily_balance')));
        }

        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;

        $data['balance'] = $this->homepage_model->get_all_records_by_period($start_date, $end_date);
        $this->load->view("balance_pdf", $data);

    }

    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->homepage_model->get_by_id($tabel = 'tr_log_balance', $id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }

    function create()
    {
        $dataPost = $this->input->post();
        //echo "<pre>"; print_r($dataPost); echo "</pre>"; exit();
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        
        $date = date('Y-m-d',strtotime($dataPost['date']));
        $department_id = 0;
        if(isset($dataPost['department']))
            $department_id = $dataPost['department'];

        $get_data = $this->db->get_where('tr_log_balance', array('date' => $date, 'dep_rowID' => $department_id))->row_array();
                        
        if (empty($dataPost['rowID'])) {// add new
            $balance_id = 0;
            if (!empty($get_data['date_created'])) {
                $balance_id = $get_data['rowID'];

                $balance = array(
                    'balance' => $get_data['balance'] + str_replace('.','',$dataPost['balance']),
                    'user_modified' => $this->session->userdata('user_id'),
                    'date_modified' => date('Y-m-d'),
                    'time_modified' => date('H:i:s')
                );
                $this->db->where('rowID', $balance_id);
                $this->db->update('tr_log_balance', $balance);
            } else {
               	$balance = array(
                    'date' => $date,
                    'dep_rowID' => $department_id,
                    'balance' => str_replace('.','',$dataPost['balance']),
                    'user_created' => $this->session->userdata('user_id'),
                    'date_created' => date('Y-m-d'),
					'time_created' => date('H:i:s')
				);

                $this->db->insert('tr_log_balance', $balance);
                $balance_id = $this->db->insert_id();
            }

            $get_department = $this->homepage_model->get_by_id($tabel = 'sa_dep', $department_id);

            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'balances';
            $params['module_field_id'] = $balance_id;
            $params['activity'] = ucfirst('Added a new Balance ' . $get_department->dep_name . ' on ' . date('d F Y'));
            $params['icon'] = 'fa-money';
            modules::run('activitylog/log', $params); //log activity
            echo json_encode(array("success" => true, 'msg' => lang('balance_registered_successfully')));
            exit;
        } else { // edit Data
            $balance = array(
                'balance' => str_replace('.','',$dataPost['balance']),
                'user_modified' => $this->session->userdata('user_id'),
                'date_modified' => date('Y-m-d'),
				'time_modified' => date('H:i:s')
			);
            $this->db->where('rowID', $dataPost['rowID']);
            $this->db->update('tr_log_balance', $balance);
            
            $get_log_balance = $this->homepage_model->get_by_id($tabel = 'tr_log_balance', $dataPost['rowID']);
            $get_department = $this->homepage_model->get_by_id($tabel = 'sa_dep', $get_log_balance->dep_rowID);

            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'balances';
            $params['module_field_id'] = $dataPost['rowID'];
            $params['activity'] = ucfirst('Update Balance ' . $get_department->dep_name . ' on ' . date('d F Y'));
            $params['icon'] = 'fa-money';
            modules::run('activitylog/log', $params); //log activity

            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('balance_edited_successfully')));
            exit();
        }
	}
    
    function fetch_data() { 
        if ($this->input->is_ajax_request()) {
            $dt = $_POST;

            if($this->session->userdata('start_date_daily_balance') == '' ){
                $start_date = date("Y-m-d", strtotime('-6 day'));
            }else{
                $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_daily_balance')));
            }

            if($this->session->userdata('end_date_daily_balance') == ''){
                $end_date = date("Y-m-d");
            }else{
                $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_daily_balance')));
            }
            $str_between = " AND tr_log_balance.date BETWEEN '" . $start_date . "' and '" . $end_date ."'";
        
            $dt['table'] = 'tr_log_balance';
            $dt['id'] = 'rowID';

            $aColumnTable = array(
                'tr_log_balance.rowID', 'tr_log_balance.date', 'tr_log_balance.dep_rowID', 'tr_log_balance.balance', 'tr_log_balance.remaining_balance', 'tr_log_balance.use_balance'
            );

            $aColumns = array(
                'tr_log_balance.rowID', 'tr_log_balance.date', 'tr_log_balance.dep_rowID', 'tr_log_balance.balance', 'tr_log_balance.remaining_balance', 'tr_log_balance.use_balance'
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
                $sOrder .= "tr_log_balance.rowID DESC";
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

            if (!empty($dt['columns'][6]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $start_date = date('Y-m-d', strtotime($dt['columns'][6]['search']['value']));
                $this->session->set_userdata('start_date_daily_balance',date("Y-m-d",strtotime($start_date)));

                if($this->session->userdata('end_date_daily_balance') == ''){
                    $end_date = date("Y-m-d");
                }else{
                    $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_daily_balance')));
                }
                $str_between = " AND tr_log_balance.date BETWEEN '" . $start_date . "' and '" . $end_date ."'";

                $sWhere.= ' tr_log_balance.deleted = 0 ' . $str_between; 
            }

            if (!empty($dt['columns'][7]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $end_date = date('Y-m-d', strtotime($dt['columns'][7]['search']['value']));
                $this->session->set_userdata('end_date_daily_balance', date("Y-m-d",strtotime($end_date)));

                if($this->session->userdata('start_date_daily_balance') == ''){
                    $start_date = date("Y-m-d", strtotime('-6 day'));
                }else{
                    $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_daily_balance')));
                }
                $str_between = " AND tr_log_balance.date BETWEEN '" . $start_date . "' and '" . $end_date ."'";
                
                $sWhere.= ' tr_log_balance.deleted = 0 ' . $str_between; 
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
                $sWhere .= ') AND tr_log_balance.deleted = 0 ' . $str_between;
            } 

            /** Total Data Set Length * */
            $sQuery = 'SELECT * FROM ' . $dt['table'] . ' WHERE tr_log_balance.deleted = 0 ' . $str_between;
            $rResultTotal = $this->db->query($sQuery);
            $aResultTotal = $rResultTotal->num_rows();
            $iTotal = $aResultTotal;
            
            /* Get Data To Display */
            if ($sWhere != "") {
                $where = $sWhere;
            } else {
                $where = " WHERE tr_log_balance.deleted = 0 " . $str_between;
            }

            $join_table = ' ';

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
                    // UPDATE DAILY REMAINING BALANCE
                    $get_department = $this->homepage_model->get_by_id($tabel = 'sa_dep', $aRow['dep_rowID']);

                    $use_balance = $this->homepage_model->get_use_balance($get_department->cash_gl_rowID, $aRow['date']);
                    $get_daily_balance = $this->homepage_model->get_balance_get_by_date($get_department->rowID, $aRow['date']);
                    if(count($get_daily_balance) > 0){
                        $remaining_balance = $get_daily_balance->balance + $use_balance;
                        $balance = array(
                            'use_balance' => $use_balance,
                            'remaining_balance' => $remaining_balance,
                            'user_modified' => $this->session->userdata('user_id'),
                            'date_modified' => date('Y-m-d'),
                            'time_modified' => date('H:i:s')
                        );
                        $this->db->where('rowID', $get_daily_balance->rowID);
                        $this->db->update('tr_log_balance', $balance);
                    }
                    
                    $dt['start'] ++;
                    $row = array();

                    $dropdown_option = "";
                    $dropdown_option .= '<div class="btn-group">';
                    $dropdown_option .= '<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">';
                    $dropdown_option .= lang('options');
                    $dropdown_option .= '<span class="caret"></span>';
                    $dropdown_option .= '</button>';
                    $dropdown_option .= '<ul class="dropdown-menu">';
                
                    $dropdown_option .= '<li><a href="javascript:void()" title="'.lang('update_option').'" onclick="edit_balance('.$aRow['rowID'].')"><i class="fa fa-pencil"></i>  ' . lang('update_option') . '</a></li>';
                    
                    $dropdown_option .= '</ul></div>';
              
                    $row['dropdown_option'] = $dropdown_option;
                    $row['date'] = date("d F Y",strtotime($aRow['date']));
                    $row['department'] = ucwords($get_department->dep_cd. ' - ' .$get_department->dep_name);
                    $row['balance'] = number_format($aRow['balance'],0,',','.');
                    $row['use_balance'] = number_format($aRow['use_balance'],0,',','.');
                    $row['remaining_balance'] = number_format($aRow['remaining_balance'],0,',','.');

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
}
