<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class cash_advance_type extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('tank_auth');
       
        $this->load->model('cash_advance_type_model');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('cash_advance_types') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('cash_advance_types');
        $this->session->set_userdata('page_header', 'master');
        $this->session->set_userdata('page_detail', 'cash_advance_types');
        $data['datatables'] = true;
        $data['form'] = true;
        $data['cash_advance_types'] = $this->cash_advance_type_model->get_all_records($table =
            'sa_advance_type', $array = array('rowID >' => 0, 'deleted' => 0), $join_table =
            '', $join_criteria = '', 'advance_cd', 'asc');

        $this->template->set_layout('users')->build('cash_advance_types', isset($data) ? $data : null);
    }


    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->cash_advance_type_model->get_by_id($tabel = 'sa_advance_type', $id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }

    function delete_data($id)
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $data = $this->cash_advance_type_model->delete_data($tabel = 'sa_advance_type', $id);
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
        $cash_advance_type_code = $this->db->get_where('sa_advance_type', array('advance_cd' =>
                $dataPost['cash_advance_type_code']))->row_array();

        if (empty($dataPost['rowID'])) {
            if (!empty($cash_advance_type_code['advance_cd'])) {
                echo json_encode(array("success" => false, 'msg' => lang('already_exist')));
                exit();
            } else {
                $data_cash_advance_type = array(
                    'advance_cd' => $dataPost['cash_advance_type_code'],
                    'advance_name' => strtoupper($dataPost['cash_advance_type_name']),
                    'by_jo' => $dataPost['advance_by_jo'],
                    'only_driver' => $dataPost['advance_only_driver'],
                    'fare_trip' => $dataPost['advance_fare_trip'],
                    'user_created' => $this->session->userdata('user_id'),
                    'date_created' => date('Y-m-d'),
                    'time_created' => date('H:i:s'));
                $this->db->insert('sa_advance_type', $data_cash_advance_type);
                $cash_advance_type_id = $this->db->insert_id();

                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'cash_advance_types';
                $params['module_field_id'] = $cash_advance_type_id;
                $params['activity'] = ucfirst('Added a new Advance Type ' . strtoupper($dataPost['cash_advance_type_name']));
                $params['icon'] = 'fa-user';
                modules::run('activitylog/log', $params); //log activity
                Header('Content-Type: application/json; charset=UTF8');
                echo json_encode(array("success" => true, 'msg' => lang('cash_advance_type_registered_successfully')));
                exit();
            }
        } else {
               $data_cash_advance_type = array(
                    'advance_cd' => $dataPost['cash_advance_type_code'],
                    'advance_name' => strtoupper($dataPost['cash_advance_type_name']),
                    'by_jo' => $dataPost['advance_by_jo'],
                    'only_driver' => $dataPost['advance_only_driver'],
                    'fare_trip' => $dataPost['advance_fare_trip'],
                    'user_modified' => $this->session->userdata('user_id'),
                    'date_modified' => date('Y-m-d'),
                    'time_modified' => date('H:i:s'));
            $this->db->where('rowID', $dataPost['rowID']);
            $this->db->update('sa_advance_type', $data_cash_advance_type);
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('cash_advance_type_edited_successfully')));
            exit();
        }
    }

    function create2()
    {
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<span style="color:red">',
                '</span><br>');
            $this->form_validation->set_rules('cash_advance_type_code', 'Code',
                'required|xss_clean|is_unique[sa_advance_type.advance_cd]');
            $this->form_validation->set_rules('cash_advance_type_name', 'Name',
                'required|xss_clean');
            $this->form_validation->set_rules('advance_by_jo', 'Job Order',
                'required|xss_clean');
            $this->form_validation->set_rules('advance_only_driver', 'Driver',
                'required|xss_clean');
            $this->form_validation->set_rules('advance_fare_trip', 'Fare Trip',
                'required|xss_clean');


            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('response_status', 'error');
                $this->session->set_flashdata('message', lang('error_in_form'));
                $_POST = '';
                $this->index();
            } else {
                $data_cash_advance_type = array(
                    'advance_cd' => $this->input->post('cash_advance_type_code'),
                    'advance_name' => strtoupper($this->input->post('cash_advance_type_name')),
                    'by_jo' => $this->input->post('advance_by_jo'),
                    'only_driver' => $this->input->post('advance_only_driver'),
                    'fare_trip' => $this->input->post('advance_fare_trip'),
                    'user_created' => $this->session->userdata('user_id'),
                    'date_created' => date('Y-m-d'),
                    'time_created' => date('H:i:s'));
                $this->db->insert('sa_advance_type', $data_cash_advance_type);
                $cash_advance_type_id = $this->db->insert_id();

                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'cash_advance_types';
                $params['module_field_id'] = $cash_advance_type_id;
                $params['activity'] = ucfirst('Added a new Advance Type ' . $this->input->post('cash_advance_type_name'));
                $params['icon'] = 'fa-user';
                modules::run('activitylog/log', $params); //log activity

                $this->session->set_flashdata('response_status', 'success');
                $this->session->set_flashdata('message', lang('cash_advance_type_registered_successfully'));
                redirect('cash_advance_type');
            }
        } else {
            $this->session->set_flashdata('response_status', 'error');
            $this->session->set_flashdata('message', lang('error_in_form'));
            redirect('cash_advance_type');
        }
    }

}

/* End of file contacts.php */
