<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Fare_trip extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('fare_trip_model');
        $this->load->model('vehicle_category/vehicle_category_model');
        $this->load->model('cost_code/cost_code_model');
        
        $this->load->library('pdf_generator');
    }
    
    function pdf()
    {
        $data['fare_trip'] = $this->fare_trip_model->get_all_record_data();
        $html = $this->load->view('fare_trip_pdf', $data, true);
        $this->pdf_generator->generate($html, 'fare trip pdf',$orientation='Landscape');//Portrait
    }
    
    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=fare_trip.xls");

        $data['fare_trip'] = $this->fare_trip_model->get_all_record_data();
        $this->load->view("fare_trip_pdf", $data);

    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('fare_trips') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('fare_trips');
        $this->session->set_userdata('page_header', 'master');
        $this->session->set_userdata('page_detail', 'fare_trips');
        $data['datatables'] = true;
        $data['form'] = true;

        $data['fare_trips_active'] = $this->fare_trip_model->get_all_record_data_active();
        $data['fare_trips_not_active'] = $this->fare_trip_model->get_all_record_data_not_active();
        
        $data['vehicle_types'] = $this->fare_trip_model->get_all_records($table =
            'sa_vehicle_type', $array = array('rowID >' => 0, 'deleted' => 0), $join_table =
            '', $join_criteria = '', 'type_cd', 'asc');

        $data['references'] = $this->fare_trip_model->get_all_records($table =
            'sa_vehicle_reference', $array = array('rowID >' => 0, 'deleted' => 0), $join_table =
            '', $join_criteria = '', 'reference', 'asc');

        $data['destination'] = $this->fare_trip_model->get_all_records($table =
            'sa_destination', $array = array('rowID >' => 0, 'deleted' => 0), $join_table =
            '', $join_criteria = '', 'rowID', 'asc');
        $data['cost'] = $this->fare_trip_model->get_all_records($table = 'sa_cost', $array =
            array('rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '',
            'rowID', 'asc');

        $this->template->set_layout('users')->build('fare_trips', isset($data) ? $data : null);
    }

    function get_fare_trip_dtl()
    {
        error_reporting(E_ALL);
        $fare_trip_rowID = $this->input->post('fare_trip_rowID');
        $fare_trip_dtls = $this->fare_trip_model->get_fare_trip_dtl($fare_trip_rowID);
        header('Content-Type: application/json');
        $arr = array();
        if (!empty($fare_trip_dtls)) {
            foreach ($fare_trip_dtls as $fare_trip_dtl) {
                if($fare_trip_dtl->trip_type == '1')
                    $trip_type = "BULK";
                else if($fare_trip_dtl->trip_type == '2')
                    $trip_type = "CONTAINER";
                else
                    $trip_type = "OTHERS";
                    
                $arr = array(
                    'fare_trip_no' => $fare_trip_dtl->fare_trip_no,
                    'destination_from_id' => $fare_trip_dtl->destination_from_rowID,
                    'destination_to_id' => $fare_trip_dtl->destination_to_rowID,
                    'destination_from_no' => $fare_trip_dtl->destination_from_no,
                    'destination_from_name' => $fare_trip_dtl->destination_from_name,
                    'destination_to_no' => $fare_trip_dtl->destination_to_no,
                    'destination_to_name' => $fare_trip_dtl->destination_to_name,
                    'distance' => number_format($fare_trip_dtl->distance/1000,1,',','.'),
                    'trip_type' => $trip_type,
                    'vehicle_type' => $fare_trip_dtl->type_name,
                    'total' => $fare_trip_dtl->total,
                );
            }
        }
        header('Content-type: application/json');
        echo json_encode($arr);

        exit; 
    }


    function get_destination()
    {
        error_reporting(E_ALL);
        $destination = $this->input->post('destination');
        $des = $this->fare_trip_model->get_all_records($table = 'sa_destination', $array =
            array(
            'rowID >' => 0,
            'deleted' => 0,
            'rowID' => $destination), $join_table = '', $join_criteria = '', 'rowID', 'asc');

        if (!empty($des)) {
            header('Content-Type: application/json');
            foreach ($des as $rs) {
                $arr = array('destination_no' => $rs->destination_no, 'destination_name' => $rs->
                        destination_name);
            }
            header('Content-type: application/json');
            echo json_encode($arr);
        }

        exit; // no need to render the template

    }


    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->fare_trip_model->get_by_id($id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }

    function delete_data($id)
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $data = $this->fare_trip_model->delete_data($tabel = 'sa_fare_trip_hdr', $id);
        $data = $this->fare_trip_model->delete_data_detail($tabel='sa_fare_trip_dtl',$id);
        
        $params['user_rowID'] = $this->tank_auth->get_user_id();
        $params['module'] = 'fare trips';
        $params['module_field_id'] = $id;
        $params['activity'] = ucfirst('Deleted a Fare Trip with ID '.$id);
        $params['icon'] = 'fa-times';
        modules::run('activitylog/log', $params); //log activity
        
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }

    function activate_data($id)
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $data = $this->fare_trip_model->activate_data($id);
        
        $params['user_rowID'] = $this->tank_auth->get_user_id();
        $params['module'] = 'fare trips';
        $params['module_field_id'] = $id;
        $params['activity'] = ucfirst('Activate a Fare Trip with ID '.$id);
        $params['icon'] = 'fa-check';
        modules::run('activitylog/log', $params); //log activity
        
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }

    function disactivate_data($id)
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $data = $this->fare_trip_model->disactivate_data($id);
        
        $params['user_rowID'] = $this->tank_auth->get_user_id();
        $params['module'] = 'fare trips';
        $params['module_field_id'] = $id;
        $params['activity'] = ucfirst('Disactivate a Fare Trip with ID '.$id);
        $params['icon'] = 'fa-times';
        modules::run('activitylog/log', $params); //log activity
        
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }

    function showDetail($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
    

        $hasil = $this->db->query("select a.* from sa_fare_trip_dtl as a
         where a.fare_trip_hdr_rowID ='$id' and deleted = 0 ");

        $arr = array();
        if (!empty($hasil)) {
            header('Content-Type: application/json');
            foreach ($hasil->result() as $rs) {

                $arr[] = array(
                    'fare_trip_hdr_rowID' => $rs->fare_trip_hdr_rowID,
                    'reference_id' => $rs->reference_id,
                    'fare_trip_amt' => $rs->fare_trip_amt);
            }
            header('Content-Type: application/json');
            echo json_encode($arr);
        }
        exit();
    }


    function create()
    {
        $dataPost = $this->input->post();
//                echo "<pre>";
//                print_r($dataPost);
//                echo "</pre>";
//                exit();
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $this->db->trans_begin();
        $id_new = '';

        if (empty($dataPost['rowID'])) {
            $destination = $this->db->get_where('sa_fare_trip_hdr', array('destination_from_rowID' =>
                $dataPost['fare_trip_destination_from'],'destination_to_rowID'=>$dataPost['fare_trip_destination_to'],
                'trip_type'=>$dataPost['trip_type'],'vehicle_id'=>$dataPost['vehicle_type'],
                'cost_id' => $dataPost['cost_code'], 'deleted' => 0))->num_rows();
                
            if ($destination > 0){
                echo json_encode(array("success" => false, 'msg' => lang('already_exist')));
                exit();
            }else{
                $id_new = $this->fare_trip_model->save_data_header($dataPost);
                
                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'fare trips';
                $params['module_field_id'] = $id_new;
                $params['activity'] = ucfirst('Added a new Fare Trip ' . $dataPost['destination_from_code'] . '-' . $dataPost['destination_to_code']);
                $params['icon'] = 'fa-plus';
                modules::run('activitylog/log', $params); //log activity
            }
            
            if (!empty($dataPost['detail'])) {
                $x = 0;
                foreach ($dataPost['detail'] as $detail) {
                    $x++;
                    $this->fare_trip_model->save_data_detail($id_new,$x,$dataPost, $detail);
                }
            }
            
        } else {
            $id_new = $dataPost['rowID'];
            $this->fare_trip_model->save_update_data_header($dataPost); // insert baru
            //$this->fare_trip_model->delete_data_header($dataPost);
            $this->fare_trip_model->delete_data_detail_fare_trip($dataPost);
            
            if (!empty($dataPost['detail'])) {
                $x = 0;
                $get_data = $this->fare_trip_model->get_table_by_id('sa_fare_trip_hdr',$id_new);
                foreach ($dataPost['detail'] as $detail) {
                    $x++;
                    $this->fare_trip_model->update_data_detail($id_new,$x,$dataPost, $detail, $get_data);
                }
            }
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'fare trips';
            $params['module_field_id'] = $id_new;
            $params['activity'] = ucfirst('Updated a Fare Trip ' . $dataPost['destination_from_code'] . '-' . $dataPost['destination_to_code']);
            $params['icon'] = 'fa-edit';
            modules::run('activitylog/log', $params); //log activity
        }


        Header('Content-Type: application/json; charset=UTF8');
        $status = $this->db->trans_status();
        if ($status === false) {
            $this->db->trans_rollback();
            echo json_encode(array('msg' => "Failed"));
            exit();
        } else {
            $this->db->trans_commit();

            echo json_encode(array('success' => true, 'msg' => 'Saving data successfully'));
            exit();
        }
        return $status;


    }

    
    function insertHistoriesHeader($dataPost){
            $data = $this->db->get_where('sa_fare_trip_hdr', array(
                'rowID' => $dataPost['rowID']));
            $items = array();
            foreach ($data->result_array() as $row)
            {
                array_push($items, $row);
            }
            $dataHistorisHeader = json_encode($items);
            $this->fare_trip_model->save_header_histories($dataHistorisHeader);
    }
    
    function insertHistoriesDetail($dataPost){
            $data = $this->db->get_where('sa_fare_trip_dtl', array(
                'fare_trip_hdr_rowID' => $dataPost['rowID']));
            
            $items = array();
            foreach ($data->result_array() as $row)
            {
                array_push($items, $row);
            }
            
            $dataHistorisDetail = json_encode($items);
            $this->fare_trip_model->save_detail_histories($dataHistorisDetail);
	
    }

    

}

/* End of file contacts.php */
