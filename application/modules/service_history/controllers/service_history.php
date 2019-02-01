<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Service_history extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('service_history_model');
        $this->load->model('appmodel');
        $this->load->library('pdf_generator');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('service_history') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('service_history');
        $this->session->set_userdata('page_header', 'workshop');
        $this->session->set_userdata('page_detail', 'service_history');
        $data['datatables'] = true;
        $data['form'] = true;
        
        if($this->session->userdata('vehicle_id') == ''){
            $vehicle_id = '';
        }
        else{
            $vehicle_id = $this->session->userdata('vehicle_id');
        }
        
        $data['vehicle_id'] = $vehicle_id;

        $data['all_service_historys'] = $this->service_history_model->get_data_vehicle_service_history();
        $data['service_historys'] = $this->service_history_model->get_all_record_data($vehicle_id);
        
        $data['services'] = $this->service_history_model->get_data_services();
        $data['part_materials'] = $this->service_history_model->get_data_part_materials();
        $data['vehicles'] = $this->service_history_model->get_all_records('sa_vehicle', $array =
            array('rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '', 'police_no', 'asc');
        $data['drivers'] = $this->service_history_model->get_all_records('sa_debtor', $array =
            array('rowID >' => 0, 'deleted' => 0, 'type' => 'D'), $join_table = '', $join_criteria = '', 'debtor_name', 'asc');
        $data['mechanics'] = $this->service_history_model->get_all_records('sa_debtor', $array =
            array('rowID >' => 0, 'deleted' => 0, 'type' => 'M'), $join_table = '', $join_criteria = '', 'debtor_name', 'asc');
        $data['templates'] = $this->service_history_model->get_all_records('sa_part_service_hdr', $array =
            array('rowID >' => 0, 'deleted' => 0, 'type' => 'template'), $join_table = '', $join_criteria = '', 'name', 'asc');
        
        
        $this->template->set_layout('users')->build('service_historys', isset($data) ? $data : null);
    }
    
    function set_filter(){
       $this->session->set_userdata('vehicle_id',$this->input->post('vehicle_id'));
       
       redirect(base_url().'service_history');
    }

    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->service_history_model->get_by_id('tr_service_history_hdr',$id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function get_data_spk($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->service_history_model->get_data_spk_by_id($id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function get_data_complaint()
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $trx_no = $this->input->post('trx_no');
        
        $hasil = $this->service_history_model->get_data_detail_by_trx_no($trx_no);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function get_data_template()
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->service_history_model->get_data_template_by_code($this->input->post('code'));
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function get_data_service(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->service_history_model->get_data_service_by_code($this->input->post('service_code'));
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function get_data_part_material_master(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->service_history_model->get_data_service_by_code($this->input->post('part_material_code'));
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }

    function get_data_template_spk(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->service_history_model->get_data_template_spk_by_code($this->input->post('code'));
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function get_data_part_material(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->service_history_model->get_data_part_material_by_code($this->input->post('code'));
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function get_data_mechanic(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->service_history_model->get_data_mechanic_by_code($this->input->post('code'));
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function delete_data($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $error = false;
        $this->db->trans_begin();
        
        $get_data = $this->service_history_model->get_by_id('tr_service_history_hdr', $id);
        
        $result = $this->service_history_model->delete_data('tr_service_history_hdr', $id);
        if($result){
            $result = $this->service_history_model->delete_detail_data($get_data->trx_no);
            if($result){
                $get_data_spk = $this->service_history_model->get_data_spk_by_complaint_no($get_data->trx_no);
                
                // Delete SPK Detail
                $result = $this->service_history_model->delete_spk_data($get_data_spk->trx_no);
                if($result){
                    $result = $this->service_history_model->delete_detail_data_spk('tr_spk_service_history_work_list',$get_data_spk->trx_no);
                    if($result){
                        $result = $this->service_history_model->delete_detail_data_spk('tr_spk_service_history_part_material',$get_data_spk->trx_no);
                        if($result){
                            $result = $this->service_history_model->delete_detail_data_spk('tr_spk_service_history_mechanic',$get_data_spk->trx_no);
                            if(!$result){
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
        
        Header('Content-Type: application/json; charset=UTF8');
        $status = $this->db->trans_status();
        if ($status === false || $error == true){
            $this->db->trans_rollback();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
			$params['module'] = 'ERROR ROLLBACK Invoice';
			$params['module_field_id'] = $id;
			$params['activity'] = ucfirst('Deleted a Service History No '.$get_data->trx_no);
			$params['icon'] = 'fa-exclamation-triangle';
			modules::run('activitylog/log',$params);
            
            echo json_encode(array('success' => false, 'msg' => "Failed Data RollBack"));
            exit();
        }
        else{
            $this->db->trans_commit();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Service History';
            $params['module_field_id'] = $id;
            $params['activity'] = ucfirst('Deleted a Service History No ' . $get_data->trx_no);
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
            $date= date('Y-m-d',strtotime($dataPost['trx_date']));
            $year= date('Y',strtotime($dataPost['trx_date']));
            $month= date('m',strtotime($dataPost['trx_date']));

            $sa_spec= $this->db->get_where('sa_spec', array('deleted' => 0,'rowID' => 1))->row_array();
            $sa_spec_prefix = $sa_spec['service_history'];
            $code = ((int)$this->appmodel->select_max_id('tr_service_history_hdr',$array = array('prefix'=>$sa_spec_prefix,'year' =>$year,'month' =>$month,'deleted' =>0),'code'))+1;
            $trx_no=$sa_spec_prefix.sprintf("%04s",$year).sprintf("%02s",$month).sprintf("%05s",$code);
           
            $data_service_history = array(
                'prefix' => $sa_spec_prefix,
                'year' => $year,
                'month' => $month,
                'code'  => $code,
                'trx_no' => $trx_no,
                'trx_date' => $date,
                'vehicle_rowID' => $dataPost['vehicle_rowID'],
                'type' => $dataPost['type'],
                'last_km' => str_replace('.','',$dataPost['last_km']),
                'debtor_rowID' => $dataPost['debtor_rowID'],
                'user_created' => $this->session->userdata('user_id'),
                'date_created' => date('Y-m-d'),
                'time_created' => date('H:i:s')
            );
            
            $result = $this->db->insert('tr_service_history_hdr', $data_service_history);
            if($result){
                $service_history_id = $this->db->insert_id();
                
                if(!empty($dataPost['complaint_note'])){
                    $countDetail = count($dataPost['complaint_note']);
                    $complaint_note = $dataPost['complaint_note'];
                    
                    for($i=0;$i<$countDetail;$i++){
                        $data_detail_service_history = array(
                            'trx_no' => $trx_no,
                            'complaint_note' => ucfirst($complaint_note[$i]),
                            'user_created' => $this->session->userdata('user_id'),
                            'date_created' => date('Y-m-d'),
                            'time_created' => date('H:i:s')
                        );
                        
                        $result = $this->db->insert('tr_service_history_dtl', $data_detail_service_history);
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
				$params['module'] = 'ERROR ROLLBACK Invoice';
				$params['module_field_id'] = $code;
				$params['activity'] = ucfirst('Deleted a Service History No '.$trx_no);
				$params['icon'] = 'fa-exclamation-triangle';
				modules::run('activitylog/log',$params);
                
                echo json_encode(array('success' => false, 'msg' => "Failed Data RollBack"));
                exit();
            }
            else{
                $this->db->trans_commit();
                
                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'Service History';
                $params['module_field_id'] = $service_history_id;
                $params['activity'] = ucfirst('Added a new Service History No ' . $trx_no);
                $params['icon'] = 'fa-plus';
                modules::run('activitylog/log', $params); //log activity

                echo json_encode(array("success" => true, 'msg' => lang('created_succesfully')));
                exit();
            }
        } 
        else {
            $get_data = $this->service_history_model->get_by_id('tr_service_history_hdr', $dataPost['rowID']);

            $data_service_history = array(
                'trx_date' => date('Y-m-d',strtotime($dataPost['trx_date'])),
                'vehicle_rowID' => $dataPost['vehicle_rowID'],
                'type' => $dataPost['type'],
                'last_km' => str_replace('.','',$dataPost['last_km']),
                'debtor_rowID' => $dataPost['debtor_rowID'],
                'user_modified' => $this->session->userdata('user_id'),
                'date_modified' => date('Y-m-d'),
                'time_modified' => date('H:i:s')
            );
            $this->db->where('rowID', $dataPost['rowID']);            
            $result = $this->db->update('tr_service_history_hdr', $data_service_history);
            if($result){
                // Delete Complaint Detail
                $result = $this->service_history_model->delete_detail_data($get_data->trx_no);
                if($result){
                    if(!empty($dataPost['complaint_note'])){
                        $countDetail = count($dataPost['complaint_note']);
                        $complaint_note = $dataPost['complaint_note'];
                        
                        for($i=0;$i<$countDetail;$i++){
                            $data_detail_service_history = array(
                                'trx_no' => $get_data->trx_no,
                                'complaint_note' => ucfirst($complaint_note[$i]),
                                'user_created'      =>$dataPost['user_created'],
                                'date_created'      =>$dataPost['date_created'],
                                'time_created'      =>$dataPost['time_created'],
                				'user_modified'     =>$this->session->userdata('user_rowID'),
                				'date_modified'     =>date('Y-m-d'),
                				'time_modified'     =>date('H:i:s')
                            );
                            
                            $result = $this->db->insert('tr_service_history_dtl', $data_detail_service_history);
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
            }
            else{
                $error = true;
            }
            
            Header('Content-Type: application/json; charset=UTF8');
            $status = $this->db->trans_status();
            if ($status === false || $error == true){
                $this->db->trans_rollback();
                
                $params['user_rowID'] = $this->tank_auth->get_user_id();
				$params['module'] = 'ERROR ROLLBACK Invoice';
				$params['module_field_id'] = $dataPost['rowID'];
				$params['activity'] = ucfirst('Deleted a Service History No '.$get_data->trx_no);
				$params['icon'] = 'fa-exclamation-triangle';
				modules::run('activitylog/log',$params);
                
                echo json_encode(array('success' => false, 'msg' => "Failed Data RollBack"));
                exit();
            }
            else{
                $this->db->trans_commit();
                
                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'Service History';
                $params['module_field_id'] = $dataPost['rowID'];
                $params['activity'] = ucfirst('Updated a Service History No ' . $get_data->trx_no);
                $params['icon'] = 'fa-edit';
                modules::run('activitylog/log', $params); //log activity

                echo json_encode(array("success" => true, 'msg' => lang('updated_succesfully')));
                exit();
            }          
            
        }

    }
    
    function create_spk()
    {
        $dataPost = $this->input->post();
        //echo "<pre>"; print_r($dataPost); echo "</pre>"; exit();
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $error = false;
        $this->db->trans_begin();

        if (empty($dataPost['trx_no'])) {
            $date= date('Y-m-d');
            $code = ((int)$this->appmodel->select_max_id('tr_spk_service_history', $array = array
                (
                'complaint_no' => $dataPost['complaint_no_spk'],
                'deleted' => 0), 'code')) + 1;
                            
            $trx_no = $dataPost['complaint_no_spk'].sprintf("%02s", $code);
           
            $data_spk_service_history = array(
                'code' => $code,
                'trx_no' => $trx_no,
                'trx_date' => $date,
                'complaint_no' => $dataPost['complaint_no_spk'],
                'type_work_list' => $dataPost['type_work_list'],
                'template_service_code' => $dataPost['template_service_code'],
                'change_oil' => empty($dataPost['change_oil']) ? 0 : $dataPost['change_oil'],
                'cost_service' => str_replace('.','',$dataPost['cost_service']),
                'cost_part' => str_replace('.','',$dataPost['cost_part']),
                'cost_labour' => str_replace('.','',$dataPost['cost_labour']),
                'cost_other' => str_replace('.','',$dataPost['cost_other']),
                'cost_total' => str_replace('.','',$dataPost['cost_total']),
                'user_created' => $this->session->userdata('user_id'),
                'date_created' => date('Y-m-d'),
                'time_created' => date('H:i:s')
            );
            
            $result = $this->db->insert('tr_spk_service_history', $data_spk_service_history);
            if($result){
                $spk_service_history_id = $this->db->insert_id();
                
                if(!empty($dataPost['service_code'])){
                    $countDetail = count($dataPost['service_code']);
                    $service_code = $dataPost['service_code'];
                    $work_hours_template = $dataPost['work_hours_template'];
                    $flat_rate_template = $dataPost['flat_rate_template'];
                    
                    for($i=0;$i<$countDetail;$i++){
                        $data_detail_work_list = array(
                            'code' => $trx_no,
                            'service_code' => $service_code[$i],
                            'work_hours_spk' => $work_hours_template[$i],
                            'flat_rate_spk' => str_replace('.','',$flat_rate_template[$i]),
                            'user_created' => $this->session->userdata('user_id'),
                            'date_created' => date('Y-m-d'),
                            'time_created' => date('H:i:s')
                        );
                        
                        $result = $this->db->insert('tr_spk_service_history_work_list', $data_detail_work_list);
                        if (!$result){
                            $error = true;
                            break;
                        }
                    }
                }
                
                if(!empty($dataPost['part_material_code'])){
                    $countDetail = count($dataPost['part_material_code']);
                    $part_material_code = $dataPost['part_material_code'];
                    $qty = $dataPost['qty'];
                    $price = $dataPost['price'];
                    
                    for($i=0;$i<$countDetail;$i++){
                        $data_detail_part_material = array(
                            'code' => $trx_no,
                            'part_material_code' => $part_material_code[$i],
                            'qty' => $qty[$i],
                            'price' => str_replace('.','',$price[$i]),
                            'user_created' => $this->session->userdata('user_id'),
                            'date_created' => date('Y-m-d'),
                            'time_created' => date('H:i:s')
                        );
                        
                        $result = $this->db->insert('tr_spk_service_history_part_material', $data_detail_part_material);
                        if (!$result){
                            $error = true;
                            break;
                        }
                    }
                }
                
                if(!empty($dataPost['debtor_rowID'])){
                    $countDetail = count($dataPost['debtor_rowID']);
                    $debtor_rowID = $dataPost['debtor_rowID'];
                    
                    for($i=0;$i<$countDetail;$i++){
                        $data_detail_mechanic = array(
                            'code' => $trx_no,
                            'debtor_rowID' => $debtor_rowID[$i],
                            'user_created' => $this->session->userdata('user_id'),
                            'date_created' => date('Y-m-d'),
                            'time_created' => date('H:i:s')
                        );
                        
                        $result = $this->db->insert('tr_spk_service_history_mechanic', $data_detail_mechanic);
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
				$params['module'] = 'ERROR ROLLBACK Invoice';
				$params['module_field_id'] = $spk_service_history_id;
				$params['activity'] = ucfirst('Deleted a SPK Service No '.$trx_no);
				$params['icon'] = 'fa-exclamation-triangle';
				modules::run('activitylog/log',$params);
                
                echo json_encode(array('success' => false, 'msg' => "Failed Data RollBack"));
                exit();
            }
            else{
                $this->db->trans_commit();
                
                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'Service History';
                $params['module_field_id'] = $spk_service_history_id;
                $params['activity'] = ucfirst('Added a new SPK Service No ' . $trx_no);
                $params['icon'] = 'fa-plus';
                modules::run('activitylog/log', $params); //log activity

                echo json_encode(array("success" => true, 'msg' => lang('created_succesfully')));
                exit();
            }
        } 
        else {
            $get_data = $this->service_history_model->get_data_spk_by_trx_no($dataPost['trx_no']);
            $trx_no = $get_data->trx_no;
            
            $data_spk_service_history = array(
                'type_work_list' => $dataPost['type_work_list'],
                'template_service_code' => $dataPost['template_service_code'],
                'change_oil' => empty($dataPost['change_oil']) ? 0 : $dataPost['change_oil'],
                'cost_service' => str_replace('.','',$dataPost['cost_service']),
                'cost_part' => str_replace('.','',$dataPost['cost_part']),
                'cost_labour' => str_replace('.','',$dataPost['cost_labour']),
                'cost_other' => str_replace('.','',$dataPost['cost_other']),
                'cost_total' => str_replace('.','',$dataPost['cost_total']),
                'user_modified' => $this->session->userdata('user_id'),
                'date_modified' => date('Y-m-d'),
                'time_modified' => date('H:i:s')
            );
            $this->db->where('deleted', 0);
            $this->db->where('trx_no', $dataPost['trx_no']);            
            $result = $this->db->update('tr_spk_service_history', $data_spk_service_history);
            if($result){
                // Delete SPK Detail
                $result = $this->service_history_model->delete_detail_data_spk('tr_spk_service_history_work_list',$trx_no);
                if($result){
                    $result = $this->service_history_model->delete_detail_data_spk('tr_spk_service_history_part_material',$trx_no);
                    if($result){
                        $result = $this->service_history_model->delete_detail_data_spk('tr_spk_service_history_mechanic',$trx_no);
                        if(!$result){
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
                
                if($result){
                    if(!empty($dataPost['service_code'])){
                        $countDetail = count($dataPost['service_code']);
                        $service_code = $dataPost['service_code'];
                        $work_hours_template = $dataPost['work_hours_template'];
                        $flat_rate_template = $dataPost['flat_rate_template'];
                        
                        for($i=0;$i<$countDetail;$i++){
                            $data_detail_work_list = array(
                                'code' => $trx_no,
                                'service_code' => $service_code[$i],
                                'work_hours_spk' => $work_hours_template[$i],
                                'flat_rate_spk' => str_replace('.','',$flat_rate_template[$i]),
                                'user_created'  =>$dataPost['spk_user_created'],
                                'date_created'  =>$dataPost['spk_date_created'],
                                'time_created'  =>$dataPost['spk_time_created'],
                                'user_modified' => $this->session->userdata('user_id'),
                                'date_modified' => date('Y-m-d'),
                                'time_modified' => date('H:i:s')
                            );
                            
                            $result = $this->db->insert('tr_spk_service_history_work_list', $data_detail_work_list);
                            if (!$result){
                                $error = true;
                                break;
                            }
                        }
                    }
                    
                    if(!empty($dataPost['part_material_code'])){
                        $countDetail = count($dataPost['part_material_code']);
                        $part_material_code = $dataPost['part_material_code'];
                        $qty = $dataPost['qty'];
                        $price = $dataPost['price'];
                        
                        for($i=0;$i<$countDetail;$i++){
                            $data_detail_part_material = array(
                                'code' => $trx_no,
                                'part_material_code' => $part_material_code[$i],
                                'qty' => $qty[$i],
                                'price' => str_replace('.','',$price[$i]),
                                'user_created'  =>$dataPost['spk_user_created'],
                                'date_created'  =>$dataPost['spk_date_created'],
                                'time_created'  =>$dataPost['spk_time_created'],
                                'user_modified' => $this->session->userdata('user_id'),
                                'date_modified' => date('Y-m-d'),
                                'time_modified' => date('H:i:s')
                            );
                            
                            $result = $this->db->insert('tr_spk_service_history_part_material', $data_detail_part_material);
                            if (!$result){
                                $error = true;
                                break;
                            }
                        }
                    }
                    
                    if(!empty($dataPost['debtor_rowID'])){
                        $countDetail = count($dataPost['debtor_rowID']);
                        $debtor_rowID = $dataPost['debtor_rowID'];
                        
                        for($i=0;$i<$countDetail;$i++){
                            $data_detail_mechanic = array(
                                'code' => $trx_no,
                                'debtor_rowID' => $debtor_rowID[$i],
                                'user_created'  =>$dataPost['spk_user_created'],
                                'date_created'  =>$dataPost['spk_date_created'],
                                'time_created'  =>$dataPost['spk_time_created'],
                                'user_modified' => $this->session->userdata('user_id'),
                                'date_modified' => date('Y-m-d'),
                                'time_modified' => date('H:i:s')
                            );
                            
                            $result = $this->db->insert('tr_spk_service_history_mechanic', $data_detail_mechanic);
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
            }
            else{
                $error = true;
            }
            
            Header('Content-Type: application/json; charset=UTF8');
            $status = $this->db->trans_status();
            if ($status === false || $error == true){
                $this->db->trans_rollback();
                
                $params['user_rowID'] = $this->tank_auth->get_user_id();
				$params['module'] = 'ERROR ROLLBACK Invoice';
				$params['module_field_id'] = $get_data->rowID;
				$params['activity'] = ucfirst('Deleted a SPK Service No '.$trx_no);
				$params['icon'] = 'fa-exclamation-triangle';
				modules::run('activitylog/log',$params);
                
                echo json_encode(array('success' => false, 'msg' => "Failed Data RollBack"));
                exit();
            }
            else{
                $this->db->trans_commit();
                
                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'Service History';
                $params['module_field_id'] = $get_data->rowID;
                $params['activity'] = ucfirst('Updated a SPK Service No ' . $trx_no);
                $params['icon'] = 'fa-edit';
                modules::run('activitylog/log', $params); //log activity

                echo json_encode(array("success" => true, 'msg' => lang('updated_succesfully')));
                exit();
            }          
            
        }

    }
    
    function create_progress_spk()
    {
        $dataPost = $this->input->post();
        //echo "<pre>"; print_r($dataPost); echo "</pre>"; exit();
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $error = false;
        $this->db->trans_begin();

        $spk_no = $dataPost['spk_no'];
        
        $get_data = $this->service_history_model->get_data_spk_by_trx_no($spk_no);
        
        if(!empty($dataPost['rowIDProgress'])){
            $countDetail = count($dataPost['rowIDProgress']);
            $rowIDProgress = $dataPost['rowIDProgress'];
            $progress_date = $dataPost['progress_date'];
            $start_hours = $dataPost['start_hours'];
            $end_hours = $dataPost['end_hours'];
            $status = $dataPost['status'];
            
            for($i=0;$i<$countDetail;$i++){
                $data_detail_work_list = array(
                    'progress_date' => date('Y-m-d',strtotime($progress_date[$i])),
                    'start_hours' => $start_hours[$i],
                    'end_hours' => $end_hours[$i],
                    'status' => $status[$i],
                    'user_modified' => $this->session->userdata('user_id'),
                    'date_modified' => date('Y-m-d'),
                    'time_modified' => date('H:i:s')
                );
                $this->db->where('rowID',$rowIDProgress[$i]);
                $result = $this->db->update('tr_spk_service_history_work_list', $data_detail_work_list);
                if (!$result){
                    $error = true;
                    break;
                }
            }
        }
        
    
        Header('Content-Type: application/json; charset=UTF8');
        $status = $this->db->trans_status();
        if ($status === false || $error == true){
            $this->db->trans_rollback();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
			$params['module'] = 'ERROR ROLLBACK Invoice';
			$params['module_field_id'] = $get_data->rowID;
			$params['activity'] = ucfirst('Deleted a Progress SPK Service No '.$spk_no);
			$params['icon'] = 'fa-exclamation-triangle';
			modules::run('activitylog/log',$params);
            
            echo json_encode(array('success' => false, 'msg' => "Failed Data RollBack"));
            exit();
        }
        else{
            $this->db->trans_commit();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Service History';
            $params['module_field_id'] = $get_data->rowID;
            $params['activity'] = ucfirst('Added a Progress SPK Service No ' . $spk_no);
            $params['icon'] = 'fa-plus';
            modules::run('activitylog/log', $params); //log activity

            echo json_encode(array("success" => true, 'msg' => lang('created_succesfully')));
            exit();
        }          

    }
    
    function print_service_invoice($spk_no){
        $get_data = $this->service_history_model->get_data_spk_by_spk_no($spk_no);
        $data['get_data'] = $get_data; 
        $data['get_data_work_list'] = $this->service_history_model->get_data_template_spk_by_code($spk_no);
        $data['get_data_part_material'] = $this->service_history_model->get_data_part_material_by_code($spk_no);
        
        $sql_update = "UPDATE tr_spk_service_history 
                        SET printed = printed + 1, user_printed = ".$this->session->userdata('user_rowID').",
                            date_printed = '".date('Y-m-d')."', time_printed = '".date('H:i:s')."'
                        WHERE trx_no = '".$spk_no."'";
        
        $this->db->query($sql_update);
        
        $get_data = $this->service_history_model->get_data_spk_by_trx_no($spk_no);
        if($get_data->rowID == null){
            $rowID = 0;
        }
        else{
            $rowID = $get_data->rowID;
        }
        
        $params['user_rowID'] = $this->tank_auth->get_user_id();
		$params['module'] = 'Service History';
		$params['module_field_id'] = $rowID;
		$params['activity'] = ucfirst('Print a Service Invoice No. '.$spk_no);
		$params['icon'] = 'fa-print';
		modules::run('activitylog/log',$params); //log activity	
        
        $html = $this->load->view('service_invoice_pdf', $data, true);            
        
        $this->pdf_generator->generate($html, 'Service Invoice pdf',$orientation='Portrait');
    }
    
    function print_progress_spk($spk_no){
        $get_data = $this->service_history_model->get_data_spk_by_spk_no($spk_no);
        $data['get_data'] = $get_data; 
        $data['get_data_complaint'] = $this->service_history_model->get_data_detail_by_trx_no($get_data->trx_no);
        $data['get_data_work_list'] = $this->service_history_model->get_data_template_spk_by_code($spk_no);
        $data['get_data_part_material'] = $this->service_history_model->get_data_part_material_by_code($spk_no);
        $data['get_data_mechanic'] = $this->service_history_model->get_data_mechanic_by_code($spk_no);
        
        $sql_update = "UPDATE tr_spk_service_history 
                        SET printed = printed + 1, user_printed = ".$this->session->userdata('user_rowID').",
                            date_printed = '".date('Y-m-d')."', time_printed = '".date('H:i:s')."'
                        WHERE trx_no = '".$spk_no."'";
        
        $this->db->query($sql_update);
        
        $get_data = $this->service_history_model->get_data_spk_by_trx_no($spk_no);
        if($get_data->rowID == null){
            $rowID = 0;
        }
        else{
            $rowID = $get_data->rowID;
        }
        
        $params['user_rowID'] = $this->tank_auth->get_user_id();
		$params['module'] = 'Service History';
		$params['module_field_id'] = $rowID;
		$params['activity'] = ucfirst('Print a Progress SPK Service No. '.$spk_no);
		$params['icon'] = 'fa-print';
		modules::run('activitylog/log',$params); //log activity	
        
        $html = $this->load->view('progress_service_pdf', $data, true);            
        
        $this->pdf_generator->generate($html, 'Progress SPK Service pdf',$orientation='Portrait');
    }
    
    function pdf()
    {
        if($this->session->userdata('vehicle_id') == ''){
            $vehicle_id = '';
        }
        else{
            $vehicle_id = $this->session->userdata('vehicle_id');
        }
        
        $get_vehilce = $this->service_history_model->get_by_id('sa_vehicle',$vehicle_id);
        $data['police_no'] = $get_vehilce->police_no;
        $data['service_historys'] = $this->service_history_model->get_all_record_data($vehicle_id);        
        
        $html = $this->load->view('service_history_pdf', $data, true);
        $this->pdf_generator->generate($html, 'service_history pdf',$orientation='Portrait');
    }
    
    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=service_history.xls");

        if($this->session->userdata('vehicle_id') == ''){
            $vehicle_id = '';
        }
        else{
            $vehicle_id = $this->session->userdata('vehicle_id');
        }
        
        $get_vehilce = $this->service_history_model->get_by_id('sa_vehicle',$vehicle_id);
        $data['police_no'] = $get_vehilce->police_no;
        $data['service_historys'] = $this->service_history_model->get_all_record_data($vehicle_id);        
        
        $this->load->view("service_history_pdf", $data);

    }

}

/* End of file contacts.php */
