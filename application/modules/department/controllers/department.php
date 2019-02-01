<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Department extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('department_model');
        $this->load->library('pdf_generator');


    }

    function pdf()
    {
        $data['dept'] = $this->department_model->get_all_records($table = 'sa_dep', $array =
            array('rowID >' => '0', 'deleted' => '0'), $join_table = '', $join_criteria = '',
            'dep_name');

        $html = $this->load->view('departement_pdf', $data, true);
        $this->pdf_generator->generate($html, 'departement pdf',$orientation='Portrait');
    }

    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=departement.xls");

        $data['dept'] = $this->department_model->get_all_records($table = 'sa_dep', $array =
            array('rowID >' => '0', 'deleted' => '0'), $join_table = '', $join_criteria = '',
            'dep_name');
            
        $this->load->view("departement_pdf", $data);

    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('departments') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('departments');
        $this->session->set_userdata('page_header', 'master');
        $this->session->set_userdata('page_detail', 'departments');
        $data['datatables'] = true;
        $data['form'] = true;
//        $data['departments'] = $this->department_model->get_all_records($table =
//            'sa_dep', $array = array('rowID >' => '0', 'deleted' => '0'), $join_table = '',
//            $join_criteria = '', 'dep_name');

        $data['departments'] = $this->department_model->get_all_record_data();
        //$data['cash_gl_coa'] = $this->department_model->get_all_records($table = 'gl_coa', $array =
        //    array('deleted' => 0, 'is_cash' => 'Y'), $join_table = '', $join_criteria = '',
        //    'acc_cd', 'asc');
        $data['cash_gl_coa'] = $this->department_model->get_account();

        $this->template->set_layout('users')->build('departments', isset($data) ? $data : null);
    }

    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $hasil = $this->department_model->get_by_id($tabel = 'sa_dep', $id);
        header('Content-type: application/json');
        echo json_encode($hasil);
        exit;
    }

    function delete_data($id)
    {
        header('Content-Type: application/json');
        $data = $this->department_model->delete_data($id);
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
        $dept = $this->db->get_where('sa_dep', array('dep_cd' => $dataPost['department_code']))->row_array();
        
        if (empty($dataPost['rowID'])) { // new Add

            if (!empty($dept['dep_cd'])) {
                echo json_encode(array("success" => false, 'msg' => lang('already_exist')));
                exit();
            } else {
                $department_data = array(
                    'dep_cd' => strtoupper($dataPost['department_code']),
                    'dep_name' => strtoupper($dataPost['department_name']),
                    'pool'      => $dataPost['pool'],
                    'cash_gl_rowID' =>$dataPost['departments_cash_gl_coa'],
                    'cash_in_prefix' =>strtoupper($dataPost['departments_cash_in_prefix']),
                    'cash_out_prefix' =>strtoupper($dataPost['departments_cash_out_prefix']),
                    'user_created' => $this->session->userdata('user_id'),
                    'date_created' => date('Y-m-d'),
                    'time_created' => date('H:i:s'));
                $this->db->insert('sa_dep', $department_data);
                $department_id = $this->db->insert_id();

                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'Departments';
                $params['module_field_id'] = $department_id;
                $params['activity'] = ucfirst('Added a new item ' . $dataPost['department_name']);
                $params['icon'] = 'fa-user';
                modules::run('activitylog/log', $params); //log activity
                echo json_encode(array("success" => true, 'msg' => lang('department_registered_successfully')));
                exit;

            }

        } else { //edit data
            $department_data = array(
                'dep_cd' => strtoupper($dataPost['department_code']),
                'dep_name' => strtoupper($dataPost['department_name']),
                'pool'      => $dataPost['pool'],
                'cash_gl_rowID' =>$dataPost['departments_cash_gl_coa'],
                'cash_in_prefix' =>strtoupper($dataPost['departments_cash_in_prefix']),
                'cash_out_prefix' =>strtoupper($dataPost['departments_cash_out_prefix']),
                'user_modified' => $this->session->userdata('user_id'),
                'date_modified' => date('Y-m-d'),
                'time_modified' => date('H:i:s'));
            $this->db->where('rowID', $dataPost['rowID']);
            $this->db->update('sa_dep', $department_data);
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('department_edited_successfully')));
            exit();
        }


    }


}

/* End of file contacts.php */
