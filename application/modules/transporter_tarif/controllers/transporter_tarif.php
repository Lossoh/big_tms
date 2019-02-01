<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transporter_tarif extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('transporter_tarif_model');
        $this->load->model('appmodel');
        $this->load->library('pdf_generator');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('transporter_tarif') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('transporter_tarif');
        $this->session->set_userdata('page_header', 'master');
        $this->session->set_userdata('page_detail', 'transporter_tarif');
        $data['datatables'] = true;
        $data['form'] = true;
        
        $data['transporter_tarifs'] = $this->transporter_tarif_model->get_all_record_data();
        
        $data['creditors'] = $this->transporter_tarif_model->get_all_records('sa_creditor', $array =
            array('rowID >' => 0, 'deleted' => 0, 'category' => 'C'), $join_table = '', $join_criteria = '', 'creditor_name', 'asc');
        $data['destinations'] = $this->transporter_tarif_model->get_all_records('sa_destination', $array =
            array('rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '', 'destination_name', 'asc');
        $data['cargos'] = $this->transporter_tarif_model->get_all_records('sa_item', $array =
            array('rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '', 'item_name', 'asc');
        $data['vehicle_categories'] = $this->transporter_tarif_model->get_data_vehicle_category();			

        $this->template->set_layout('users')->build('transporter_tarifs', isset($data) ? $data : null);
    }
    
    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $get_data = $this->transporter_tarif_model->get_by_id('sa_transporter_tarif_hdr',$id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($get_data);
        exit;
    }
    
    function get_data_detail()
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $rowID = $this->input->post('rowID');
        
        $get_data = $this->transporter_tarif_model->get_data_detail_by_hdr_id($rowID);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($get_data);
        exit;
    }

    function delete_data($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $error = false;
        $this->db->trans_begin();
        
        $result = $this->transporter_tarif_model->delete_data('sa_transporter_tarif_hdr', $id);
        if($result){
            $result = $this->transporter_tarif_model->delete_detail_data($id);
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
			$params['module'] = 'ERROR ROLLBACK Invoice';
			$params['module_field_id'] = $id;
			$params['activity'] = ucfirst('Deleted a Transporter Tarif ID '.$id);
			$params['icon'] = 'fa-exclamation-triangle';
			modules::run('activitylog/log',$params);
            
            echo json_encode(array('success' => false, 'msg' => "Failed Data RollBack"));
            exit();
        }
        else{
            $this->db->trans_commit();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'transporter_tarif';
            $params['module_field_id'] = $id;
            $params['activity'] = ucfirst('Deleted a Transporter Tarif ID ' . $id);
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
        
        $result = $this->transporter_tarif_model->delete_data('sa_transporter_tarif_dtl', $id);
        if(!$result){
            $error = true;
        }
        
        Header('Content-Type: application/json; charset=UTF8');
        $status = $this->db->trans_status();
        if ($status === false || $error == true){
            $this->db->trans_rollback();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
			$params['module'] = 'ERROR ROLLBACK Invoice';
			$params['module_field_id'] = $id;
			$params['activity'] = ucfirst('Deleted a Detail Transporter Tarif ID '.$id);
			$params['icon'] = 'fa-exclamation-triangle';
			modules::run('activitylog/log',$params);
            
            echo json_encode(array('success' => false, 'msg' => "Failed Data RollBack"));
            exit();
        }
        else{
            $this->db->trans_commit();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Transporter Tarif';
            $params['module_field_id'] = $id;
            $params['activity'] = ucfirst('Deleted a Detail Transporter Tarif ID ' . $id);
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
            
            $check_data = $this->transporter_tarif_model->get_all_records('sa_transporter_tarif_hdr', $array =
                array('deleted' => 0, 'creditor_rowID' => $dataPost['creditor_rowID'],'jo_type' => $dataPost['jo_type'],'cargo_rowID' => $dataPost['cargo_rowID'],
                'from_rowID' => $dataPost['from_rowID']), $join_table = '', $join_criteria = '', 'creditor_rowID', 'asc');
            if(count($check_data) > 0){
                echo json_encode(array('success' => false, 'msg' => "Data already exist."));
                exit();
            }
            else{
                $data_transporter_tarif = array(
                    'creditor_rowID' => $dataPost['creditor_rowID'],
                    'jo_type' => $dataPost['jo_type'],
                    'cargo_rowID' => $dataPost['cargo_rowID'],
                    'from_rowID' => $dataPost['from_rowID'],
                    'user_created' => $this->session->userdata('user_id'),
                    'date_created' => date('Y-m-d'),
                    'time_created' => date('H:i:s')
                );
                
                $result = $this->db->insert('sa_transporter_tarif_hdr', $data_transporter_tarif);
                $transporter_tarif_id = 0;
                if($result){
                    $transporter_tarif_id = $this->db->insert_id();
                    
                    if(!empty($dataPost['to_row_id'])){
                        $countDetail = count($dataPost['to_row_id']);
                        $to_row_id = $dataPost['to_row_id'];
                        $vehicle_type_rowID = $dataPost['vehicle_type_rowID'];
                        $price = $dataPost['price'];
                        
                        for($i=0;$i<$countDetail;$i++){
                            $data_detail_transporter_tarif = array(
                                'transporter_tarif_rowID' => $transporter_tarif_id,
                                'to_rowID' => $to_row_id[$i],
                                'vehicle_type_rowID' => $vehicle_type_rowID[$i],
                                'price' => str_replace('.','',$price[$i]),
                                'user_created' => $this->session->userdata('user_id'),
                                'date_created' => date('Y-m-d'),
                                'time_created' => date('H:i:s')
                            );
                            
                            $result = $this->db->insert('sa_transporter_tarif_dtl', $data_detail_transporter_tarif);
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
            
            Header('Content-Type: application/json; charset=UTF8');
            $status = $this->db->trans_status();
            if ($status === false || $error == true){
                $this->db->trans_rollback();
                
                $params['user_rowID'] = $this->tank_auth->get_user_id();
				$params['module'] = 'ERROR ROLLBACK Invoice';
				$params['module_field_id'] = $transporter_tarif_id;
				$params['activity'] = ucfirst('Deleted a Transporter Tarif ID '.$transporter_tarif_id);
				$params['icon'] = 'fa-exclamation-triangle';
				modules::run('activitylog/log',$params);
                
                echo json_encode(array('success' => false, 'msg' => "Failed Data RollBack"));
                exit();
            }
            else{
                $this->db->trans_commit();
                
                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'Transporter Tarif';
                $params['module_field_id'] = $transporter_tarif_id;
                $params['activity'] = ucfirst('Added a new Transporter Tarif ID ' . $transporter_tarif_id);
                $params['icon'] = 'fa-plus';
                modules::run('activitylog/log', $params); //log activity

                echo json_encode(array("success" => true, 'msg' => lang('created_succesfully')));
                exit();
            }
        } 
        else {
            $check_data = $this->transporter_tarif_model->get_all_records('sa_transporter_tarif_hdr', $array =
                array('rowID !=' => $dataPost['rowID'], 'deleted' => 0, 'creditor_rowID' => $dataPost['creditor_rowID'],'jo_type' => $dataPost['jo_type'],'cargo_rowID' => $dataPost['cargo_rowID'],
                'from_rowID' => $dataPost['from_rowID']), $join_table = '', $join_criteria = '', 'creditor_rowID', 'asc');
            if(count($check_data) > 0){
                echo json_encode(array('success' => false, 'msg' => "Data already exist."));
                exit();
            }
            else{
            
                $get_data = $this->transporter_tarif_model->get_by_id('sa_transporter_tarif_hdr', $dataPost['rowID']);
                    
                $data_transporter_tarif = array(
                    'creditor_rowID' => $dataPost['creditor_rowID'],
                    'jo_type' => $dataPost['jo_type'],
                    'cargo_rowID' => $dataPost['cargo_rowID'],
                    'from_rowID' => $dataPost['from_rowID'],
                    'user_modified' => $this->session->userdata('user_id'),
                    'date_modified' => date('Y-m-d'),
                    'time_modified' => date('H:i:s')
                );
                $this->db->where('rowID', $dataPost['rowID']);            
                $result = $this->db->update('sa_transporter_tarif_hdr', $data_transporter_tarif);
                if($result){
                    if(!empty($dataPost['to_row_id'])){
                        $countDetail = count($dataPost['to_row_id']);
                        $to_row_id = $dataPost['to_row_id'];
                        $vehicle_type_rowID = $dataPost['vehicle_type_rowID'];
                        $price = $dataPost['price'];
                        $row_id_tarif = $dataPost['row_id_tarif'];
                        
                        for($i=0;$i<$countDetail;$i++){
                            if(empty($row_id_tarif[$i])){
                                $data_detail_transporter_tarif = array(
                                    'transporter_tarif_rowID' => $get_data->rowID,
                                    'to_rowID' => $to_row_id[$i],
                                    'vehicle_type_rowID' => $vehicle_type_rowID[$i],
                                    'price' => str_replace('.','',$price[$i]),
                                    'user_created' => $this->session->userdata('user_id'),
                                    'date_created' => date('Y-m-d'),
                                    'time_created' => date('H:i:s')
                                );
                                
                                $result = $this->db->insert('sa_transporter_tarif_dtl', $data_detail_transporter_tarif);
                                
                            }
                            else{
                                $data_detail_transporter_tarif = array(
                                    'transporter_tarif_rowID' => $get_data->rowID,
                                    'to_rowID' => $to_row_id[$i],
                                    'vehicle_type_rowID' => $vehicle_type_rowID[$i],
                                    'price' => str_replace('.','',$price[$i]),
                                    'user_modified' => $this->session->userdata('user_id'),
                                    'date_modified' => date('Y-m-d'),
                                    'time_modified' => date('H:i:s')
                                );
                                $this->db->where('rowID', $row_id_tarif[$i]);
                                
                                $result = $this->db->update('sa_transporter_tarif_dtl', $data_detail_transporter_tarif);
                                
                            }
                            
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
        				$params['module_field_id'] = $dataPost['rowID'];
        				$params['activity'] = ucfirst('Deleted a Transporter Tarif ID '.$get_data->rowID);
        				$params['icon'] = 'fa-exclamation-triangle';
        				modules::run('activitylog/log',$params);
                        
                        echo json_encode(array('success' => false, 'msg' => "Failed Data RollBack"));
                        exit();
                    }
                    else{
                        $this->db->trans_commit();
                        
                        $params['user_rowID'] = $this->tank_auth->get_user_id();
                        $params['module'] = 'Transporter Tarif';
                        $params['module_field_id'] = $dataPost['rowID'];
                        $params['activity'] = ucfirst('Updated a Transporter Tarif ID '.$get_data->rowID);
                        $params['icon'] = 'fa-edit';
                        modules::run('activitylog/log', $params); //log activity
        
                        echo json_encode(array("success" => true, 'msg' => lang('updated_succesfully')));
                        exit();
                    }
                }          
            }
        }

    }
    
    function pdf()
    {        
        $data['transporter_tarifs'] = $this->transporter_tarif_model->get_all_record_detail_data();
        
        $html = $this->load->view('transporter_tarif_pdf', $data, true);
        $this->pdf_generator->generate($html, 'transporter_tarif pdf',$orientation='Portrait');
    }
    
    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=transporter_tarif.xls");
        
        $data['transporter_tarifs'] = $this->transporter_tarif_model->get_all_record_detail_data();
        
        $this->load->view("transporter_tarif_pdf", $data);

    }

}

/* End of file contacts.php */
