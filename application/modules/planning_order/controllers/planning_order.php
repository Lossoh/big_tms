<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Planning_order extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('planning_order_model');
        $this->load->model('appmodel');        
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('planning_orders') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('planning_orders');
        $this->session->set_userdata('page_header', 'transaction');
        $this->session->set_userdata('page_detail', 'planning_order');
        $data['datatables'] = true;
        $data['form'] = true;
        
        // if($this->session->userdata('start_date_po') == '' && $this->session->userdata('end_date_po') == ''){
        //     $start_date = date("Y-m-d",strtotime("yesterday"));
        //     $end_date = date("Y-m-d");
        // }
        // else{
        //     $start_date = $this->session->userdata('start_date_po');
        //     $end_date = $this->session->userdata('end_date_po');
        // }

        if($this->session->userdata('start_date_po') == '' ){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_po')));
        }

        if($this->session->userdata('end_date_po') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_po')));
        }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;

        // $data['planning_orders'] = $this->planning_order_model->get_all_records_list($start_date,$end_date);
        
        $this->template->set_layout('users')->build('planning_orders', isset($data) ? $data : null);
    }
        
    function set_filter(){
       $this->session->set_userdata('start_date_po',date("Y-m-d",strtotime($this->input->post('start_date'))));
       $this->session->set_userdata('end_date_po',date("Y-m-d",strtotime($this->input->post('end_date'))));    
       
       redirect(base_url().'planning_order');
    }

    function new_planning_order()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('planning_orders') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('planning_orders');
        $this->session->set_userdata('page_header', 'transaction');
        $this->session->set_userdata('page_detail', 'planning_order');
        $data['datatables'] = true;
        $data['form'] = true;
                
        $data['job_orders'] = $this->planning_order_model->get_all_records($table =
            'tr_jo_trx_hdr', $array = array('deleted' => 0, 'status !=' => 2), $join_table1 = '', $join_criteria1 = '', 'jo_no', 'desc');
                    
        $this->template->set_layout('users')->build('new_planning_order', isset($data) ? $data : null);
    }
    
    function edit_planning_order($id)
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('planning_orders') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('planning_orders');
        $this->session->set_userdata('page_header', 'transaction');
        $this->session->set_userdata('page_detail', 'planning_order');
        $data['datatables'] = true;
        $data['form'] = true;
        
        $get_data = $this->planning_order_model->get_by_id('tr_planning_order_hdr',$id);
        
        $data['get_data'] = $get_data;
        $data['vehicles'] = $this->planning_order_model->get_all_vehicle();
        $data['jo_detail'] = $this->planning_order_model->get_detail_jo($get_data->jo_no);
        $data['job_orders'] = $this->planning_order_model->get_all_records($table =
            'tr_jo_trx_hdr', $array = array('deleted' => 0), $join_table1 = '', $join_criteria1 = '', 'jo_no', 'desc');
                    
        $this->template->set_layout('users')->build('edit_planning_order', isset($data) ? $data : null);
    }
    
    function show_planning_order_detail(){
        $data['vehicles'] = $this->planning_order_model->get_all_vehicle();
        $data['jo_no'] = $this->input->post('jo_no');
        $data['trx_date'] = date('Y-m-d',strtotime($this->input->post('trx_date')));
        
        $this->load->view('planning_order_form_detail',$data);
    }
    
    function show_edit_planning_order_detail(){
        $data['vehicles'] = $this->planning_order_model->get_all_vehicle();
        $data['trx_no'] = $this->input->post('trx_no');
        $data['jo_no'] = $this->input->post('jo_no');
        $data['trx_date'] = date('Y-m-d',strtotime($this->input->post('trx_date')));
        
        $this->load->view('edit_planning_order_form_detail',$data);
    }
    
    function get_detail_jo(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->planning_order_model->get_detail_jo($this->input->post('jo_no'));
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function delete_data($id)
    {
        header('Content-Type: application/json');
        $error = false;
        $this->db->trans_begin();
        
        $get_data = $this->planning_order_model->get_by_id('tr_planning_order_hdr',$id);
        $result = $this->planning_order_model->delete_data($id);
        if($result){
            $result = $this->planning_order_model->delete_detail_data($get_data->trx_no);
            if(!$result){
                $error = true;
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
			$params['module'] = 'ERROR ROLLBACK PLANNING ORDER';
			$params['module_field_id'] = $id;
			$params['activity'] = ucfirst('Roll back a Planning Order No '.$get_data->trx_no);
			$params['icon'] = 'fa-exclamation-triangle';
			modules::run('activitylog/log',$params);
            
            echo json_encode(array('success' => false, 'msg' => "Failed, data roll back"));
            exit();
        } 
        else
        {
            $this->db->trans_commit();
            $params['user_rowID'] = $this->tank_auth->get_user_id();
			$params['module'] = 'Planning Order';
			$params['module_field_id'] = $id;
			$params['activity'] = ucfirst('Delete a Planning Order No '.$get_data->trx_no);
			$params['icon'] = 'fa-times';
			modules::run('activitylog/log',$params); //log activity	
            
            echo json_encode(array('success' => true, 'msg' => lang('deleted_succesfully').' No '.$get_data->trx_no));
            exit();
        }
        
    }

    function create()
    {
        $dataPost = $this->input->post();
        //echo "<pre>"; print_r($dataPost); echo "</pre>"; exit();
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $error = false;
        $this->db->trans_begin();
        
        $trx_date = date('Y-m-d',strtotime($dataPost['trx_date']));
        $year = date('Y',strtotime($dataPost['trx_date']));
        $month = date('m',strtotime($dataPost['trx_date']));
        
        $jo_no = $dataPost['jo_no'];
        $check_jo = $this->planning_order_model->check_po_by_jo($jo_no,$trx_date);
        
        if(count($check_jo) == 0){
            $sa_spec= $this->db->get_where('sa_spec', array('deleted' => 0,'rowID' => 1))->row_array();
            $sa_spec_prefix = $sa_spec['planning_order'];
            $max_code = ((int)$this->appmodel->select_max_id('tr_planning_order_hdr',$array = array('prefix'=>$sa_spec_prefix,'year' =>$year,
                                                    'month' =>$month, 'deleted' =>0),'code'))+1;
            $trx_no =$sa_spec_prefix.sprintf("%04s",$year).sprintf("%02s",$month).sprintf("%05s",$max_code);
            
            $data_planning_order = array(
                'prefix' =>$sa_spec_prefix,
                'year'   =>$year,
                'month'  =>$month,
                'code'   =>$max_code,
                'trx_no' => $trx_no,
                'trx_date' => $trx_date,
                'jo_no' => $jo_no,
                'user_created' => $this->session->userdata('user_id'),
                'date_created' => $trx_date,
                'time_created' => date("H:i:s")
            );
            
            $result = $this->db->insert('tr_planning_order_hdr', $data_planning_order);
            $pl_rowID = $max_code;
            if($result){
                $pl_rowID = $this->db->insert_id();
                
                $vehicle_rowID = $dataPost['vehicle_rowID'];
                $ritase = $dataPost['ritase'];
                $remark = $dataPost['remark'];
                
                if(count($vehicle_rowID) > 0){
                    for($i=0;$i<count($vehicle_rowID);$i++){
                        if($ritase[$i] != '0' && $remark[$i] != ''){
                            $data_planning_order_detail = array(
                                'trx_no' => $trx_no,
                                'vehicle_rowID' => $vehicle_rowID[$i],
                                'ritase' => $ritase[$i],
                                'remark' => ucfirst($remark[$i]),
                                'user_created' => $this->session->userdata('user_id'),
                                'date_created' => $trx_date,
                                'time_created' => date("H:i:s")
                            );
                            
                            $result_dtl = $this->db->insert('tr_planning_order_dtl', $data_planning_order_detail);
                            
                            if(!$result_dtl){                            
                                $error = true;
                                break;
                            }
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
    			$params['module'] = 'ERROR ROLLBACK PLANNING ORDER';
    			$params['module_field_id'] = $pl_rowID;
    			$params['activity'] = ucfirst('Roll back a Planning Order no. '.$trx_no);
    			$params['icon'] = 'fa-exclamation-triangle';
    			modules::run('activitylog/log',$params);
                
                $this->session->set_flashdata('response_status', 'error');
    			$this->session->set_flashdata('message', 'Failed, data roll back');
    			redirect('planning_order');
            } 
            else
            {
                $this->db->trans_commit();
                $params['user_rowID'] = $this->tank_auth->get_user_id();
    			$params['module'] = 'Planning Order';
    			$params['module_field_id'] = $pl_rowID;
    			$params['activity'] = ucfirst('Add a new Planning Order no. '.$trx_no);
    			$params['icon'] = 'fa-plus';
    			modules::run('activitylog/log',$params); //log activity	
                
                $this->session->set_flashdata('response_status', 'success');
    			$this->session->set_flashdata('message', lang('created_succesfully').' No. '.$trx_no);
    			redirect('planning_order');
            }
        }
        else{
            $trx_no = $check_jo->trx_no;
            
            $data_planning_order = array(
                'prefix' =>$check_jo->prefix,
                'year'   =>$year,
                'month'  =>$month,
                'code'   =>$check_jo->code,
                'trx_no' => $trx_no,
                'trx_date' => $trx_date,
                'jo_no' => $jo_no,
                'user_modified' => $this->session->userdata('user_id'),
                'date_modified' => date("Y-m-d"),
                'time_modified' => date("H:i:s")
            );
            $this->db->where('deleted',0);
            $this->db->where('trx_no',$trx_no);
            $result = $this->db->update('tr_planning_order_hdr', $data_planning_order);
            
            $pl_rowID = $check_jo->code;
            if($result){
                
                $vehicle_rowID = $dataPost['vehicle_rowID'];
                $ritase = $dataPost['ritase'];
                $remark = $dataPost['remark'];
                
                if(count($vehicle_rowID) > 0){
                    for($i=0;$i<count($vehicle_rowID);$i++){
                        if($ritase[$i] != '0' && $remark[$i] != ''){
                            $data_planning_order_detail = array(
                                'trx_no' => $trx_no,
                                'vehicle_rowID' => $vehicle_rowID[$i],
                                'ritase' => $ritase[$i],
                                'remark' => ucfirst($remark[$i]),
                                'user_created' => $this->session->userdata('user_id'),
                                'date_created' => date("Y-m-d"),
                                'time_created' => date("H:i:s")
                            );
                            
                            $result_dtl = $this->db->insert('tr_planning_order_dtl', $data_planning_order_detail);
                            
                            if(!$result_dtl){                            
                                $error = true;
                                break;
                            }
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
    			$params['module'] = 'ERROR ROLLBACK PLANNING ORDER';
    			$params['module_field_id'] = $pl_rowID;
    			$params['activity'] = ucfirst('Roll back a Planning Order no. '.$trx_no);
    			$params['icon'] = 'fa-exclamation-triangle';
    			modules::run('activitylog/log',$params);
                
                $this->session->set_flashdata('response_status', 'error');
    			$this->session->set_flashdata('message', 'Failed, data roll back');
    			redirect('planning_order');
            } 
            else
            {
                $this->db->trans_commit();
                $params['user_rowID'] = $this->tank_auth->get_user_id();
    			$params['module'] = 'Planning Order';
    			$params['module_field_id'] = $pl_rowID;
    			$params['activity'] = ucfirst('Update a Planning Order no. '.$trx_no);
    			$params['icon'] = 'fa-edit';
    			modules::run('activitylog/log',$params); //log activity	
                
                $this->session->set_flashdata('response_status', 'success');
    			$this->session->set_flashdata('message', lang('updated_succesfully').' No. '.$trx_no);
    			redirect('planning_order');
            }
        }
        
    }
    
    function update()
    {
        $dataPost = $this->input->post();
        //echo "<pre>"; print_r($dataPost); echo "</pre>"; exit();
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $error = false;
        $this->db->trans_begin();
        
        $trx_date = date('Y-m-d',strtotime($dataPost['trx_date']));
        $year = date('Y',strtotime($dataPost['trx_date']));
        $month = date('m',strtotime($dataPost['trx_date']));
        
        $trx_no = $dataPost['trx_no'];
        $jo_no = $dataPost['jo_no'];
        $check_po = $this->planning_order_model->check_po_by_trx_no($trx_no);
        
        $result = $this->planning_order_model->delete_data($check_po->rowID);
        if($result){
            $result = $this->planning_order_model->delete_detail_data($check_po->trx_no);
            if(!$result){
                $error = true;
            }
        }
        else{
            $error = true;
        }   
        
        if($result){
            $data_planning_order = array(
                'prefix' =>$check_po->prefix,
                'year'   =>$check_po->year,
                'month'  =>$check_po->month,
                'code'   =>$check_po->code,
                'trx_no' => $trx_no,
                'trx_date' => $trx_date,
                'jo_no' => $jo_no,
                'user_created'      =>$dataPost['user_created'],
                'date_created'      =>$dataPost['date_created'],
                'time_created'      =>$dataPost['time_created'],
				'user_modified'     =>$this->session->userdata('user_rowID'),
				'date_modified'     =>date('Y-m-d'),
				'time_modified'     =>date('H:i:s')
            );
            
            $result = $this->db->insert('tr_planning_order_hdr', $data_planning_order);
            $pl_rowID = $check_po->code;
            if($result){
                $pl_rowID = $this->db->insert_id();
                
                $vehicle_rowID = $dataPost['vehicle_rowID'];
                $ritase = $dataPost['ritase'];
                $remark = $dataPost['remark'];
                
                if(count($vehicle_rowID) > 0){
                    for($i=0;$i<count($vehicle_rowID);$i++){
                        if($ritase[$i] != '0' && $remark[$i] != ''){
                            $data_planning_order_detail = array(
                                'trx_no' => $trx_no,
                                'vehicle_rowID' => $vehicle_rowID[$i],
                                'ritase' => $ritase[$i],
                                'remark' => ucfirst($remark[$i]),
                                'user_created'      =>$dataPost['user_created'],
                                'date_created'      =>$dataPost['date_created'],
                                'time_created'      =>$dataPost['time_created'],
                				'user_modified'     =>$this->session->userdata('user_rowID'),
                				'date_modified'     =>date('Y-m-d'),
                				'time_modified'     =>date('H:i:s')
                            );
                            
                            $result_dtl = $this->db->insert('tr_planning_order_dtl', $data_planning_order_detail);
                            
                            if(!$result_dtl){                            
                                $error = true;
                                break;
                            }
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
        
        Header('Content-Type: application/json; charset=UTF8');
        $status = $this->db->trans_status();
        if ($status === false || $error == true)
        {
            $this->db->trans_rollback();
            $params['user_rowID'] = $this->tank_auth->get_user_id();
			$params['module'] = 'ERROR ROLLBACK PLANNING ORDER';
			$params['module_field_id'] = $pl_rowID;
			$params['activity'] = ucfirst('Roll back a Planning Order no. '.$trx_no);
			$params['icon'] = 'fa-exclamation-triangle';
			modules::run('activitylog/log',$params);
            
            $this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message', 'Failed, data roll back');
			redirect('planning_order');
        } 
        else
        {
            $this->db->trans_commit();
            $params['user_rowID'] = $this->tank_auth->get_user_id();
			$params['module'] = 'Planning Order';
			$params['module_field_id'] = $pl_rowID;
			$params['activity'] = ucfirst('Update a Planning Order no. '.$trx_no);
			$params['icon'] = 'fa-edit';
			modules::run('activitylog/log',$params); //log activity	
            
            $this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('updated_succesfully').' No. '.$trx_no);
			redirect('planning_order');
        }
        
    }

    function fetch_data() { 
        if ($this->input->is_ajax_request()) {
            $dt = $_POST;

            if($this->session->userdata('start_date_po') == '' ){
                $start_date = date("Y-m-d", strtotime('-6 day'));
            }else{
                $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_po')));
            }

            if($this->session->userdata('end_date_po') == ''){
                $end_date = date("Y-m-d");
            }else{
                $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_po')));
            }
            $str_between = " AND tr_planning_order_hdr.trx_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";
        
            $dt['table'] = 'tr_planning_order_hdr';
            $dt['id'] = 'rowID';

            $aColumnTable = array(
                'tr_planning_order_hdr.rowID', 'tr_planning_order_hdr.trx_no', 'tr_planning_order_hdr.trx_date', 'tr_jo_trx_hdr.jo_no'
            );

            $aColumns = array(
               'tr_planning_order_hdr.rowID', 'tr_planning_order_hdr.trx_no', 'tr_planning_order_hdr.trx_date', 'tr_jo_trx_hdr.jo_no'
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
                $sOrder .= "tr_planning_order_hdr.trx_date DESC, tr_planning_order_hdr.trx_no DESC";
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

            if (!empty($dt['columns'][4]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $start_date = date('Y-m-d', strtotime($dt['columns'][4]['search']['value']));
                $this->session->set_userdata('start_date_po',date("Y-m-d",strtotime($start_date)));

                if($this->session->userdata('end_date_po') == ''){
                    $end_date = date("Y-m-d");
                }else{
                    $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_po')));
                }
                $str_between = " AND tr_planning_order_hdr.trx_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";

                $sWhere.= ' tr_planning_order_hdr.deleted = 0 AND tr_jo_trx_hdr.deleted = 0 ' . $str_between; 
            }

            if (!empty($dt['columns'][5]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $end_date = date('Y-m-d', strtotime($dt['columns'][5]['search']['value']));
                $this->session->set_userdata('end_date_po', date("Y-m-d",strtotime($end_date)));

                if($this->session->userdata('start_date_po') == ''){
                    $start_date = date("Y-m-d", strtotime('-6 day'));
                }else{
                    $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_po')));
                }
                $str_between = " AND tr_planning_order_hdr.trx_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";
                
                $sWhere.= ' tr_planning_order_hdr.deleted = 0 AND tr_jo_trx_hdr.deleted = 0 ' . $str_between;
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
                $sWhere .= ') AND tr_planning_order_hdr.deleted = 0 AND tr_jo_trx_hdr.deleted = 0 ' . $str_between;
            } 

            /** Total Data Set Length * */
            $sQuery = 'SELECT * FROM ' . $dt['table'] . ' LEFT JOIN tr_jo_trx_hdr ON tr_jo_trx_hdr.jo_no = tr_planning_order_hdr.jo_no WHERE tr_planning_order_hdr.deleted = 0 AND tr_jo_trx_hdr.deleted = 0 ' . $str_between;
            $rResultTotal = $this->db->query($sQuery);
            $aResultTotal = $rResultTotal->num_rows();
            $iTotal = $aResultTotal;
            
            /* Get Data To Display */
            if ($sWhere != "") {
                $where = $sWhere;
            } else {
                $where = " WHERE tr_planning_order_hdr.deleted = 0 AND tr_jo_trx_hdr.deleted = 0 " . $str_between;
            }

            $join_table = ' LEFT JOIN tr_jo_trx_hdr ON tr_jo_trx_hdr.jo_no = tr_planning_order_hdr.jo_no ';

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
                    if($this->get_user_access('Updated') == 1){
                        $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('update_option') . '" onclick="edit_planning_order(' . $aRow['rowID'] . ')"><i class="fa fa-pencil"></i> ' . lang('update_option') . '</a></li>';
                    }
                    if($this->get_user_access('Deleted') == 1){                          
                        $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('delete_option') . '" onclick="delete_planning_order(' . $aRow['rowID'] . ')"><i class="fa fa-trash-o"></i> ' . lang('delete_option') . '</a></li>';
                    }
                    $dropdown_option .= '</ul></div>';
              
                    $row['dropdown_option'] = $dropdown_option;
                    $row['trx_no'] = $aRow['trx_no'];
                    $row['trx_date'] = date("d F Y",strtotime($aRow['trx_date']));
                    $row['jo_no'] = $aRow['jo_no'];

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
        $this->db->where('Link_Menu', 'planning_order');
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
