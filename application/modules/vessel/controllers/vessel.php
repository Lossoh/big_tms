<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Vessel extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('vessel_model');
        $this->load->model('appmodel');
        $this->load->library('pdf_generator');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('vessels') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('vessels');
        $this->session->set_userdata('page_header', 'transaction');
        $this->session->set_userdata('page_detail', 'vessel');
        $data['datatables'] = true;
        $data['form'] = true;
        
        if($this->session->userdata('start_date_vl') == '' ){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_vl')));
        }

        if($this->session->userdata('end_date_vl') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_vl')));
        }

        // if($this->session->userdata('start_date_vl') == '' && $this->session->userdata('end_date_vl') == ''){
        //     $start_date = date("Y-01-01");
        //     $end_date = date("Y-m-d");
        // }
        // else{
        //     $start_date = $this->session->userdata('start_date_vl');
        //     $end_date = $this->session->userdata('end_date_vl');
        // }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;

        // $data['vessels'] = $this->vessel_model->get_all_record_data($start_date,$end_date);
        $data['port_warehouse'] = $this->vessel_model->get_all_records('sa_port', $array =
            array('rowID >' => 0, 'deleted' => 0, 'port_type' => 'Port'), $join_table = '', $join_criteria = '', 'port_name', 'asc');
        
        $this->template->set_layout('users')->build('vessels', isset($data) ? $data : null);
    }
    
    function set_filter(){
       $this->session->set_userdata('start_date_vl',date("Y-m-d",strtotime($this->input->post('start_date'))));
       $this->session->set_userdata('end_date_vl',date("Y-m-d",strtotime($this->input->post('end_date'))));    
       
       redirect(base_url().'vessel');
    }

    function get_data_port_warehouse(){
        $port_warehouse = $this->input->post('port_warehouse');
        
        $port = $this->vessel_model->get_all_records('sa_port', $array =
            array('rowID >' => 0, 'deleted' => 0, 'port_type' => $port_warehouse), $join_table = '', $join_criteria = '', 'port_name', 'asc');
        
        if (!empty($port)) {
            echo "<option value=''>".lang('select_your_option')."</option>";
            foreach ($port as $rs) {
		      echo '<option value="'.$rs->rowID.'">'.$rs->port_name.'</option>';
            }
        }
        
        exit;
    }

    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->vessel_model->get_all_record_data_by_rowID($id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function get_data_detail()
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $trx_no = $this->input->post('trx_no');
        
        $hasil = $this->vessel_model->get_data_detail_by_trx_no($trx_no);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function get_vessel_no(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');

        $year = date('Y');
        $code = ((int)$this->appmodel->select_max_id('tr_vessel_trx',$array = array('year' => $year,'deleted' => 0),'code'))+1;
        $trx_no = 'R'.substr(date('Y'),-2).sprintf("%04s",$code);    

        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode(array('trx_no' => $trx_no));
        exit;
    }

    function get_sub_vessel_no(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');

        $get_data = $this->vessel_model->get_by_id('tr_vessel_trx', $this->input->post('id'));
        
        $year = $get_data->year;
        $code = $get_data->code;
        $row_no = ((int)$this->appmodel->select_max_id('tr_vessel_trx',$array = array('year' => $year,'code' => $code,'deleted' => 0),'row_no'))+1;
        $trx_no = $get_data->trx_no.'X'.$row_no;

        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode(array('trx_no' => $trx_no));
        exit;
    }
                
    function delete_data($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $error = false;
        $this->db->trans_begin();
        
        $get_data = $this->vessel_model->get_by_id('tr_vessel_trx', $id);
        
        $result = $this->vessel_model->delete_data('tr_vessel_trx', $id);
        if($result){
            $result = $this->vessel_model->delete_detail_data($get_data->trx_no);
            if(!$result){
                $error = true;                
            }
        }
        else{
            $error = true;
        }
        
        Header('Content-Type: application/json; charset=UTF8');
        $status = $this->db->trans_status();
        if ($status === false || $error == true){
            $this->db->trans_rollback();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
			$params['module'] = 'ERROR ROLLBACK VESSEL';
			$params['module_field_id'] = $id;
			$params['activity'] = ucfirst('Deleted a Vessel No '.$get_data->trx_no);
			$params['icon'] = 'fa-exclamation-triangle';
			modules::run('activitylog/log',$params);
            
            echo json_encode(array('success' => false, 'msg' => "Failed Data RollBack"));
            exit();
        }
        else{
            $this->db->trans_commit();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Vessel';
            $params['module_field_id'] = $id;
            $params['activity'] = ucfirst('Deleted a Vessel No ' . $get_data->trx_no);
            $params['icon'] = 'fa-times';
            modules::run('activitylog/log', $params); //log activity

            echo json_encode(array("success" => true, 'msg' => lang('deleted_succesfully')));
            exit();
        }
        
    }
    
    function delete_detail_data($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $error = false;
        $this->db->trans_begin();
        
        $get_data = $this->vessel_model->get_by_id('tr_vessel_trx_dtl', $id);
        
        $result = $this->vessel_model->delete_data('tr_vessel_trx_dtl', $id);
        if(!$result){
            $error = true;
        }
        
        Header('Content-Type: application/json; charset=UTF8');
        $status = $this->db->trans_status();
        if ($status === false || $error == true){
            $this->db->trans_rollback();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
			$params['module'] = 'ERROR ROLLBACK VESSEL';
			$params['module_field_id'] = $id;
			$params['activity'] = ucfirst('Deleted a Detail Vessel No '.$get_data->trx_no);
			$params['icon'] = 'fa-exclamation-triangle';
			modules::run('activitylog/log',$params);
            
            echo json_encode(array('success' => false, 'msg' => "Failed Data RollBack"));
            exit();
        }
        else{
            $this->db->trans_commit();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Vessel';
            $params['module_field_id'] = $id;
            $params['activity'] = ucfirst('Deleted a Detail Vessel No ' . $get_data->trx_no);
            $params['icon'] = 'fa-times';
            modules::run('activitylog/log', $params); //log activity

            echo json_encode(array("success" => true, 'msg' => lang('deleted_succesfully')));
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

        if (empty($dataPost['rowID'])) {
            $year = date('Y');
            $code = ((int)$this->appmodel->select_max_id('tr_vessel_trx',$array = array('year' => $year,'deleted' => 0),'code'))+1;
            //$trx_no = 'R'.substr(date('Y'),-2).sprintf("%04s",$code);
            $trx_no = $dataPost['trx_no'];
            $get_data_vessel = $this->vessel_model->get_data_by_trx_no($trx_no);
            if(count($get_data_vessel) > 0){
                echo json_encode(array("success" => false, 'msg' => 'Vessel No is already.'));
                exit();
            }
            
            $data_vessel = array(
                'year' => $year,
                'code'  => $code,
                'row_no' => 0,
                'trx_no' => $trx_no,
                'eta_date' => date('Y-m-d',strtotime($dataPost['date'])),
                'vessel_name' => strtoupper($dataPost['vessel_name']),
                'port_rowID' => $dataPost['port_rowID'],
                'agent' => strtoupper($dataPost['agent']),
                'original' => empty($dataPost['original']) ? 0 : 1,
                'copy' => empty($dataPost['copy']) ? 0 : 1,
                'status' => $dataPost['status'],
                'remark' => ucfirst($dataPost['remark']),
                'user_created' => $this->session->userdata('user_id'),
                'date_created' => date('Y-m-d'),
                'time_created' => date('H:i:s')
            );
            
            $result = $this->db->insert('tr_vessel_trx', $data_vessel);
            if($result){
                $vessel_id = $this->db->insert_id();
                
                if(!empty($dataPost['etb_date_vessel'])){
                    $countDetail = count($dataPost['etb_date_vessel']);
                    $etb_date_vessel = $dataPost['etb_date_vessel'];
                    $remark_vessel = $dataPost['remark_vessel'];
                    
                    for($i=0;$i<$countDetail;$i++){
                        $data_detail_vessel = array(
                            'trx_no' => $trx_no,
                            'etb_date_vessel' => date('Y-m-d',strtotime($etb_date_vessel[$i])),
                            'remark_vessel' => ucfirst($remark_vessel[$i]),
                            'user_created' => $this->session->userdata('user_id'),
                            'date_created' => date('Y-m-d'),
                            'time_created' => date('H:i:s')
                        );
                        
                        $result = $this->db->insert('tr_vessel_trx_dtl', $data_detail_vessel);
                        if (!$result){
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
            if ($status === false || $error == true){
                $this->db->trans_rollback();
                
                $params['user_rowID'] = $this->tank_auth->get_user_id();
				$params['module'] = 'ERROR ROLLBACK VESSEL';
				$params['module_field_id'] = $code;
				$params['activity'] = ucfirst('Deleted a Vessel No '.$trx_no);
				$params['icon'] = 'fa-exclamation-triangle';
				modules::run('activitylog/log',$params);
                
                echo json_encode(array('success' => false, 'msg' => "Failed Data RollBack"));
                exit();
            }
            else{
                $this->db->trans_commit();
                
                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'Vessel';
                $params['module_field_id'] = $vessel_id;
                $params['activity'] = ucfirst('Added a new Vessel No ' . $trx_no);
                $params['icon'] = 'fa-plus';
                modules::run('activitylog/log', $params); //log activity

                echo json_encode(array("success" => true, 'msg' => lang('created_succesfully')));
                exit();
            }
        } 
        else {
            $get_data = $this->vessel_model->get_by_id('tr_vessel_trx', $dataPost['rowID']);
            
            if($dataPost['sub'] == 'Sub'){
                $year = $get_data->year;
                $code = $get_data->code;
                $row_no = ((int)$this->appmodel->select_max_id('tr_vessel_trx',$array = array('year' => $year,'code' => $code,'deleted' => 0),'row_no'))+1;
                //$trx_no = $get_data->trx_no.'X'.$row_no;
                $trx_no = $dataPost['trx_no'];
                $get_data_vessel = $this->vessel_model->get_data_by_trx_no($trx_no);
                if(count($get_data_vessel) > 0){
                    echo json_encode(array("success" => false, 'msg' => 'Vessel No is already.'));
                    exit();
                }
                
                $data_vessel = array(
                    'year' => $year,
                    'code'  => $code,
                    'row_no' => $row_no,
                    'trx_no' => $trx_no,
                    'eta_date' => date('Y-m-d',strtotime($dataPost['date'])),
                    'vessel_name' => strtoupper($dataPost['vessel_name']),
                    'port_rowID' => $dataPost['port_rowID'],
                    'agent' => strtoupper($dataPost['agent']),
                    'original' => empty($dataPost['original']) ? 0 : 1,
                    'copy' => empty($dataPost['copy']) ? 0 : 1,
                    'status' => $dataPost['status'],
                    'remark' => ucfirst($dataPost['remark']),
                    'user_created' => $this->session->userdata('user_id'),
                    'date_created' => date('Y-m-d'),
                    'time_created' => date('H:i:s')
                );
                
                $result = $this->db->insert('tr_vessel_trx', $data_vessel);
                if($result){
                    $vessel_id = $this->db->insert_id();
                    
                    if(!empty($dataPost['etb_date_vessel'])){
                        $countDetail = count($dataPost['etb_date_vessel']);
                        $etb_date_vessel = $dataPost['etb_date_vessel'];
                        $remark_vessel = $dataPost['remark_vessel'];
                        
                        for($i=0;$i<$countDetail;$i++){
                            $data_detail_vessel = array(
                                'trx_no' => $trx_no,
                                'etb_date_vessel' => date('Y-m-d',strtotime($etb_date_vessel[$i])),
                                'remark_vessel' => ucfirst($remark_vessel[$i]),
                                'user_created' => $this->session->userdata('user_id'),
                                'date_created' => date('Y-m-d'),
                                'time_created' => date('H:i:s')
                            );
                            
                            $result = $this->db->insert('tr_vessel_trx_dtl', $data_detail_vessel);
                            if (!$result){
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
                if ($status === false || $error == true){
                    $this->db->trans_rollback();
                    
                    $params['user_rowID'] = $this->tank_auth->get_user_id();
    				$params['module'] = 'ERROR ROLLBACK VESSEL';
    				$params['module_field_id'] = $code;
    				$params['activity'] = ucfirst('Deleted a Sub Vessel No '.$trx_no);
    				$params['icon'] = 'fa-exclamation-triangle';
    				modules::run('activitylog/log',$params);
                    
                    echo json_encode(array('success' => false, 'msg' => "Failed Data RollBack"));
                    exit();
                }
                else{
                    $this->db->trans_commit();
                    
                    $params['user_rowID'] = $this->tank_auth->get_user_id();
                    $params['module'] = 'Vessel';
                    $params['module_field_id'] = $vessel_id;
                    $params['activity'] = ucfirst('Added a new Sub Vessel No ' . $trx_no);
                    $params['icon'] = 'fa-plus';
                    modules::run('activitylog/log', $params); //log activity
    
                    echo json_encode(array("success" => true, 'msg' => lang('created_succesfully')));
                    exit();
                }
            }
            else{
                
                $data_vessel = array(
                    'eta_date' => date('Y-m-d',strtotime($dataPost['date'])),
                    'vessel_name' => strtoupper($dataPost['vessel_name']),
                    'port_rowID' => $dataPost['port_rowID'],
                    'agent' => strtoupper($dataPost['agent']),
                    'original' => empty($dataPost['original']) ? 0 : 1,
                    'copy' => empty($dataPost['copy']) ? 0 : 1,
                    'status' => $dataPost['status'],
                    'remark' => ucfirst($dataPost['remark']),
                    'user_modified' => $this->session->userdata('user_id'),
                    'date_modified' => date('Y-m-d'),
                    'time_modified' => date('H:i:s')
                );
                $this->db->where('rowID', $dataPost['rowID']);            
                $result = $this->db->update('tr_vessel_trx', $data_vessel);
                if($result){
                    if(!empty($dataPost['etb_date_vessel'])){
                        $countDetail = count($dataPost['etb_date_vessel']);
                        $row_id_etb = $dataPost['row_id_etb'];
                        $etb_date_vessel = $dataPost['etb_date_vessel'];
                        $remark_vessel = $dataPost['remark_vessel'];
                        
                        for($i=0;$i<$countDetail;$i++){
                            if(empty($row_id_etb[$i])){
                                $data_detail_vessel = array(
                                    'trx_no' => $get_data->trx_no,
                                    'etb_date_vessel' => date('Y-m-d',strtotime($etb_date_vessel[$i])),
                                    'remark_vessel' => ucfirst($remark_vessel[$i]),
                                    'user_created' => $this->session->userdata('user_id'),
                                    'date_created' => date('Y-m-d'),
                                    'time_created' => date('H:i:s')
                                );
                                
                                $result = $this->db->insert('tr_vessel_trx_dtl', $data_detail_vessel);
                                
                            }
                            else{
                                $data_detail_vessel = array(
                                    'trx_no' => $get_data->trx_no,
                                    'etb_date_vessel' => date('Y-m-d',strtotime($etb_date_vessel[$i])),
                                    'remark_vessel' => ucfirst($remark_vessel[$i]),
                                    'user_modified' => $this->session->userdata('user_id'),
                                    'date_modified' => date('Y-m-d'),
                                    'time_modified' => date('H:i:s')
                                );
                                $this->db->where('rowID', $row_id_etb[$i]);
                                
                                $result = $this->db->update('tr_vessel_trx_dtl', $data_detail_vessel);
                                
                            }
                            
                            if (!$result){
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
                if ($status === false || $error == true){
                    $this->db->trans_rollback();
                    
                    $params['user_rowID'] = $this->tank_auth->get_user_id();
    				$params['module'] = 'ERROR ROLLBACK VESSEL';
    				$params['module_field_id'] = $dataPost['rowID'];
    				$params['activity'] = ucfirst('Deleted a Vessel No '.$get_data->trx_no);
    				$params['icon'] = 'fa-exclamation-triangle';
    				modules::run('activitylog/log',$params);
                    
                    echo json_encode(array('success' => false, 'msg' => "Failed Data RollBack"));
                    exit();
                }
                else{
                    $this->db->trans_commit();
                    
                    $params['user_rowID'] = $this->tank_auth->get_user_id();
                    $params['module'] = 'Vessel';
                    $params['module_field_id'] = $dataPost['rowID'];
                    $params['activity'] = ucfirst('Updated a Vessel No ' . $get_data->trx_no);
                    $params['icon'] = 'fa-edit';
                    modules::run('activitylog/log', $params); //log activity
    
                    echo json_encode(array("success" => true, 'msg' => lang('updated_succesfully')));
                    exit();
                }
            }          
        }

    }
    
    function pdf()
    {
        if($this->session->userdata('start_date_vl') == '' ){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_vl')));
        }

        if($this->session->userdata('end_date_vl') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_vl')));
        }

        // if($this->session->userdata('start_date_vl') == '' && $this->session->userdata('end_date_vl') == ''){
        //     $start_date = date("Y-01-01");
        //     $end_date = date("Y-m-d");
        // }
        // else{
        //     $start_date = $this->session->userdata('start_date_vl');
        //     $end_date = $this->session->userdata('end_date_vl');
        // }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['periode'] = date("d F Y",strtotime($start_date)).' - '.date("d F Y",strtotime($end_date));
        
        $data['vessels'] = $this->vessel_model->get_all_record_data($start_date,$end_date);
        
        $html = $this->load->view('vessel_pdf', $data, true);
        $this->pdf_generator->generate($html, 'vessel pdf',$orientation='Portrait');
    }
    
    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=vessel.xls");

        if($this->session->userdata('start_date_vl') == '' ){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_vl')));
        }

        if($this->session->userdata('end_date_vl') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_vl')));
        }

        // if($this->session->userdata('start_date_vl') == '' && $this->session->userdata('end_date_vl') == ''){
        //     $start_date = date("Y-01-01");
        //     $end_date = date("Y-m-d");
        // }
        // else{
        //     $start_date = $this->session->userdata('start_date_vl');
        //     $end_date = $this->session->userdata('end_date_vl');
        // }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['periode'] = date("d F Y",strtotime($start_date)).' - '.date("d F Y",strtotime($end_date));
        
        $data['vessels'] = $this->vessel_model->get_all_record_data($start_date,$end_date);
        
        $this->load->view("vessel_pdf", $data);
    }

    function fetch_data() { 
        if ($this->input->is_ajax_request()) {
            $dt = $_POST;

            if($this->session->userdata('start_date_vl') == '' ){
                $start_date = date("Y-m-d", strtotime('-6 day'));
            }else{
                $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_vl')));
            }

            if($this->session->userdata('end_date_vl') == ''){
                $end_date = date("Y-m-d");
            }else{
                $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_vl')));
            }
            $str_between = " AND tr_vessel_trx.eta_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";
        
            $dt['table'] = 'tr_vessel_trx';
            $dt['id'] = 'rowID';
            $aColumnTable = array(
                'tr_vessel_trx.rowID', 'tr_vessel_trx.trx_no', 'tr_vessel_trx.eta_date', 'tr_vessel_trx.vessel_name', 'sa_port.port_name', 'tr_vessel_trx.agent', 'tr_vessel_trx.original', 'tr_vessel_trx.status', 'sa_port.port_type', 'tr_vessel_trx.row_no', 'tr_vessel_trx.copy'
            );

            $aColumns = array(
                'tr_vessel_trx.rowID', 'tr_vessel_trx.trx_no', 'tr_vessel_trx.eta_date', 'tr_vessel_trx.vessel_name', 'sa_port.port_name', 'tr_vessel_trx.agent', 'tr_vessel_trx.original', 'tr_vessel_trx.status', 'sa_port.port_type', 'tr_vessel_trx.row_no', 'tr_vessel_trx.copy'
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
                $sOrder .= "tr_vessel_trx.rowID DESC";
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

            if (!empty($dt['columns'][8]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $start_date = date('Y-m-d', strtotime($dt['columns'][8]['search']['value']));
                $this->session->set_userdata('start_date_vl',date("Y-m-d",strtotime($start_date)));

                if($this->session->userdata('end_date_v1') == ''){
                    $end_date = date("Y-m-d");
                }else{
                    $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_v1')));
                }
                $str_between = " AND tr_vessel_trx.eta_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";

                $sWhere.= ' tr_vessel_trx.deleted = 0 ' . $str_between; 
            }

            if (!empty($dt['columns'][9]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $end_date = date('Y-m-d', strtotime($dt['columns'][9]['search']['value']));
                $this->session->set_userdata('end_date_vl', date("Y-m-d",strtotime($end_date)));

                if($this->session->userdata('start_date_vl') == ''){
                    $start_date = date("Y-m-d", strtotime('-6 day'));
                }else{
                    $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_vl')));
                }
                $str_between = " AND tr_vessel_trx.eta_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";
                
                $sWhere.= ' tr_vessel_trx.deleted = 0 ' . $str_between; 
            }

            /** Filtering * */
            $sWhere = "";
            $sSearchVal = $dt['search']['value'];
            if (isset($sSearchVal) && $sSearchVal != '') {
                $sWhere = " WHERE (";
                for ($i = 0; $i < count($aColumns); $i++) {
                    $sWhere .= $aColumns[$i] . " LIKE '%" . $this->db->escape_like_str($sSearchVal) . "%' OR ";

                }

                $mystring = 'Original & Copy, original & copy';
                $pos = strpos($mystring, $sSearchVal);
                if ($pos !== false) {
                    $sWhere .= $aColumns[6] . " LIKE '%" . $this->db->escape_like_str(1) . "%' AND ";
                    $sWhere .= $aColumns[10] . " LIKE '%" . $this->db->escape_like_str(1) . "%' OR ";
                }

                $mystring_2 = 'Original, original';
                $pos_2 = strpos($mystring_2, $sSearchVal);
                if ($pos_2 !== false) {
                    $sWhere .= $aColumns[6] . " LIKE '%" . $this->db->escape_like_str(1) . "%' OR ";
                }

                $mystring_3 = 'Copy, copy';
                $pos_3 = strpos($mystring_3, $sSearchVal);
                if ($pos_3 !== false) {
                    $sWhere .= $aColumns[10] . " LIKE '%" . $this->db->escape_like_str(1) . "%' OR ";
                }

                $mystring_4 = 'Unfinished, unfinished';
                $pos_4 = strpos($mystring_4, $sSearchVal);
                if ($pos_4 !== false) {
                    $sWhere .= $aColumns[7] . " LIKE '%" . $this->db->escape_like_str(0) . "%' OR ";
                }

                $mystring_5 = 'Finished, finished';
                $pos_5 = strpos($mystring_5, $sSearchVal);
                if ($pos_5 !== false) {
                    $sWhere .= $aColumns[7] . " LIKE '%" . $this->db->escape_like_str(1) . "%' OR ";
                }
                $sWhere = substr_replace($sWhere, "", -3);
                $sWhere .= ') AND tr_vessel_trx.deleted = 0 ' . $str_between;
            }

            /** Total Data Set Length * */
            $sQuery = "SELECT * FROM " . $dt['table'] . " LEFT JOIN sa_port ON sa_port.rowID = tr_vessel_trx.port_rowID WHERE tr_vessel_trx.deleted = 0 " . $str_between;
            $rResultTotal = $this->db->query($sQuery);
            $aResultTotal = $rResultTotal->num_rows();
            $iTotal = $aResultTotal;
            
            /* Get Data To Display */
            if ($sWhere != "") {
                $where = $sWhere;
            } else {
                $where = " WHERE tr_vessel_trx.deleted = 0  " . $str_between;
            }

            $join_table = " LEFT JOIN sa_port ON sa_port.rowID = tr_vessel_trx.port_rowID ";

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
                    if($aRow['row_no'] == 0){
                        if($this->get_user_access('Created') == 1){
                            $dropdown_option .= '<li><a  href="javascript:void()" title="Sub Vessel" onclick="sub_vessel(' . $aRow['rowID'] . ')"><i class="fa fa-plus"></i> Sub Vessel</a></li>';
                        }
                    }

                    if($this->get_user_access('Updated') == 1){
                        $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('update_option') . '" onclick="edit_vessel(' . $aRow['rowID'] . ')"><i class="fa fa-pencil"></i> ' . lang('update_option') . '</a></li>';
                    }
                        
                    if($this->get_user_access('Deleted') == 1){
                        $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('delete_option') . '" onclick="delete_vessel('. $aRow['rowID'] .')"><i class="fa fa-trash-o"></i> ' . lang('delete_option') . '</a></li>';
                    }
                    $dropdown_option .= '</ul></div>';

                    $original_copy = '-';
                    if($aRow['original'] == 1 && $aRow['copy'] == 1){
                        $original_copy = 'Original & Copy';
                    }else if($aRow['original'] == 1){
                        $original_copy = 'Original';
                    }else if($aRow['copy'] == 1){
                        $original_copy = 'Copy';
                    }
              
                    $row['dropdown_option'] = $dropdown_option;
                    $row['trx_no'] = $aRow['trx_no'];
                    $row['eta_date'] = date("d F Y",strtotime($aRow['eta_date']));
                    $row['vessel_name'] = $aRow['vessel_name'];
                    $row['port_name'] = $aRow['port_name'];
                    $row['agent'] = $aRow['agent'];
                    $row['original_copy'] = $original_copy;
                    $row['status'] = ($aRow['status'] == 0) ? 'Unfinished' : 'Finished';

                    $row['start_date'] = $aRow['eta_date'];
                    $row['end_date'] = $aRow['eta_date'];
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
        $this->db->where('Link_Menu', 'vessel');
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
