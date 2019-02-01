<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class advance_type extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('tank_auth');
       
        $this->load->model('advance_type_model');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('advance_types') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('advance_types');
        $this->session->set_userdata('page_header', 'master');
        $this->session->set_userdata('page_detail', 'advance_type');
        $data['datatables'] = true;
        $data['form'] = true;
        $data['advance_types'] = $this->advance_type_model->get_all_records($table =
            'sa_advance_category', $array = array('rowID >' => 0, 'deleted' => 0), $join_table =
            '', $join_criteria = '', 'advance_cd', 'asc');

        $this->template->set_layout('users')->build('advance_types', isset($data) ? $data : null);
    }


    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->advance_type_model->get_by_id($tabel = 'sa_advance_category', $id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }

    function delete_data($id)
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $data = $this->advance_type_model->delete_data($tabel = 'sa_advance_category', $id);
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
        $advance_type_code = $this->db->get_where('sa_advance_category', array('advance_cd' =>
                $dataPost['advance_type_code']))->row_array();

        if (empty($dataPost['rowID'])) {
            if (!empty($advance_type_code['advance_cd'])) {
                echo json_encode(array("success" => false, 'msg' => lang('already_exist')));
                exit();
            } else {
                $data_advance_type = array(
                    'advance_cd' => strtoupper($dataPost['advance_type_code']),
                    'advance_name' => strtoupper($dataPost['advance_type_name']),
                    'user_created' => $this->session->userdata('user_id'),
                    'date_created' => date('Y-m-d'),
                    'time_created' => date('H:i:s'));
                $this->db->insert('sa_advance_category', $data_advance_type);
                $advance_type_id = $this->db->insert_id();

                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'advance_types';
                $params['module_field_id'] = $advance_type_id;
                $params['activity'] = ucfirst('Added a new Advance Type ' . strtoupper($dataPost['advance_type_name']));
                $params['icon'] = 'fa-user';
                modules::run('activitylog/log', $params); //log activity
                Header('Content-Type: application/json; charset=UTF8');
                echo json_encode(array("success" => true, 'msg' => lang('advance_type_registered_successfully')));
                exit();
            }
        } else {
               $data_advance_type = array(
                    'advance_cd' => strtoupper($dataPost['advance_type_code']),
                    'advance_name' => strtoupper($dataPost['advance_type_name']),
                    'user_modified' => $this->session->userdata('user_id'),
                    'date_modified' => date('Y-m-d'),
                    'time_modified' => date('H:i:s'));
            $this->db->where('rowID', $dataPost['rowID']);
            $this->db->update('sa_advance_category', $data_advance_type);
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('advance_type_edited_successfully')));
            exit();
        }
    }

    function create2()
    {
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<span style="color:red">',
                '</span><br>');
            $this->form_validation->set_rules('advance_type_code', 'Code',
                'required|xss_clean|is_unique[sa_advance_category.advance_cd]');
            $this->form_validation->set_rules('advance_type_name', 'Name',
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
                $data_advance_type = array(
                    'advance_cd' => strtoupper($dataPost['advance_type_code']),
                    'advance_name' => strtoupper($this->input->post('advance_type_name')),
                    'user_created' => $this->session->userdata('user_id'),
                    'date_created' => date('Y-m-d'),
                    'time_created' => date('H:i:s'));
                $this->db->insert('sa_advance_category', $data_advance_type);
                $advance_type_id = $this->db->insert_id();

                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'advance_types';
                $params['module_field_id'] = $advance_type_id;
                $params['activity'] = ucfirst('Added a new Advance Type ' . $this->input->post('advance_type_name'));
                $params['icon'] = 'fa-user';
                modules::run('activitylog/log', $params); //log activity

                $this->session->set_flashdata('response_status', 'success');
                $this->session->set_flashdata('message', lang('advance_type_registered_successfully'));
                redirect('advance_type');
            }
        } else {
            $this->session->set_flashdata('response_status', 'error');
            $this->session->set_flashdata('message', lang('error_in_form'));
            redirect('advance_type');
        }
    }

}

/* End of file contacts.php */
