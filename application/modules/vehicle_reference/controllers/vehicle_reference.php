<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Vehicle_reference extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('vehicle_reference_model');
    }
    
    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('references') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('references');
        $this->session->set_userdata('page_header', 'master');
        $this->session->set_userdata('page_detail', 'references');
        $data['datatables'] = true;
        $data['form'] = true;

        $data['references'] = $this->vehicle_reference_model->get_all_records();

        $this->template->set_layout('users')->build('vehicle_references', isset($data) ? $data : null);
    }

    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->vehicle_reference_model->get_by_id($tabel = 'sa_vehicle_reference', $id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }

    function delete_data($id)
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $data = $this->vehicle_reference_model->delete_data($id);
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
                        
        if (empty($dataPost['rowID'])) {// add new
            $vehicle_reference = array(
                    'reference' => strtoupper($dataPost['reference']),
                    'user_created' => $this->session->userdata('user_id'),
                    'date_created' => date('Y-m-d'),
                    'time_created' => date('H:i:s'));

            $this->db->insert('sa_vehicle_reference', $vehicle_reference);
            $vehicle_reference_id = $this->db->insert_id();

            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'vehicle_references';
            $params['module_field_id'] = $vehicle_reference_id;
            $params['activity'] = ucfirst('Added a new vehicle reference ' . $this->input->post('reference'));
            $params['icon'] = 'fa-user';
            modules::run('activitylog/log', $params); //log activity
            echo json_encode(array("success" => true, 'msg' => lang('reference_registered_successfully')));
            exit;
        } else { // edit Data
            $vehicle_reference = array(
                'reference' => strtoupper($dataPost['reference']),
                'user_created' => $this->session->userdata('user_id'),
                'date_created' => date('Y-m-d'),
                'time_created' => date('H:i:s'));
            $this->db->where('rowID', $dataPost['rowID']);
            $this->db->update('sa_vehicle_reference', $vehicle_reference);
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('reference_edited_successfully')));
            exit();

        }

    }

}

/* End of file contacts.php */
