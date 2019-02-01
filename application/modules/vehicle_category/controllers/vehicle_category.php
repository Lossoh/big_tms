<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Vehicle_category extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('vehicle_category_model');
        $this->load->library('pdf_generator');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('vehicle_categories') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('vehicle_categories');
        $this->session->set_userdata('page_header', 'master');
        $this->session->set_userdata('page_detail', 'vehicle_categories');
        $data['datatables'] = true;
        $data['form'] = true;
        $data['vehicle_types'] = $this->vehicle_category_model->get_all_records($table =
            'sa_vehicle_type', $array = array('rowID >' => 0, 'deleted' => 0), $join_table =
            '', $join_criteria = '', 'type_cd', 'asc');
        $this->template->set_layout('users')->build('vehicle_categorys', isset($data) ?
            $data : null);
    }

    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->vehicle_category_model->get_by_id($tabel = 'sa_vehicle_type', $id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }

    function delete_data($id)
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $data = $this->vehicle_category_model->delete_data($tabel = 'sa_vehicle_type', $id);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }

    function create()
    {
        $dataPost = $this->input->post();
        //echo "<pre>"; print_r($dataPost); echo "</pre>"; exit();
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $vehicle_type_code = $this->db->get_where('sa_vehicle_type', array('type_cd' =>
                $dataPost['vehicle_type_code']))->row_array();
        if (empty($dataPost['rowID'])) {
            if (!empty($vehicle_type_code['type_cd'])) {
                echo json_encode(array("success" => false, 'msg' => lang('already_exist')));
                exit();
            } else {
                $data_vehicle_category = array(
                    'type_cd' => $dataPost['vehicle_type_code'],
                    'type_name' => strtoupper($dataPost['vehicle_type_name']),
                    'vehicle_type' => strtoupper($dataPost['vehicle_type']),
                    'weight' => str_replace('.','',$dataPost['vehicle_type_weight']),
                    'max_weight' => str_replace('.','',$dataPost['vehicle_type_max_weight']),
                    'min_weight' => str_replace('.','',$dataPost['vehicle_type_min_weight']),
                    'user_created' => $this->session->userdata('user_id'),
                    'date_created' => date('Y-m-d'),
                    'time_created' => date('H:i:s'));
                $this->db->insert('sa_vehicle_type', $data_vehicle_category);
                $vehicle_category_id = $this->db->insert_id();

                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'vehicle_categorys';
                $params['module_field_id'] = $vehicle_category_id;
                $params['activity'] = ucfirst('Added a new Vehicle Category ' . $dataPost['vehicle_type_name']);
                $params['icon'] = 'fa-user';
                modules::run('activitylog/log', $params); //log activity
                Header('Content-Type: application/json; charset=UTF8');
                echo json_encode(array("success" => true, 'msg' => lang('vehicle_type_registered_successfully')));
                exit();
            }
        } else {
            $data_vehicle_category = array(
                'type_cd' => $dataPost['vehicle_type_code'],
                'type_name' => strtoupper($dataPost['vehicle_type_name']),
                'vehicle_type' => strtoupper($dataPost['vehicle_type']),
                'weight' => str_replace('.','',$dataPost['vehicle_type_weight']),
                'max_weight' => str_replace('.','',$dataPost['vehicle_type_max_weight']),
                'min_weight' => str_replace('.','',$dataPost['vehicle_type_min_weight']),
                'user_modified' => $this->session->userdata('user_id'),
                'date_modified' => date('Y-m-d'),
                'time_modified' => date('H:i:s'));
            $this->db->where('rowID', $dataPost['rowID']);
            $this->db->update('sa_vehicle_type', $data_vehicle_category);
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('vehicle_type_edited_successfully')));
            exit();

        }
    }

    function pdf()
    {

        $data['vehicle_type'] = $this->vehicle_category_model->get_pdf();
        $html = $this->load->view('report_pdf', $data, true);
        $this->pdf_generator->generate($html, 'VehicleType',$orientation='Portrait');
    }

    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=vehicle_type.xls");
        
        $data['vehicle_type'] = $this->vehicle_category_model->get_pdf();
        $this->load->view("report_pdf", $data);

    }


}

/* End of file contacts.php */
