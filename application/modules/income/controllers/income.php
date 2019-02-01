<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Income extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('income_model');
        $this->load->library('pdf_generator');
    }

    function pdf()
    {
        $data['income'] = $this->income_model->get_pdf();
        $html = $this->load->view('income_pdf', $data, true);
        $this->pdf_generator->generate($html, 'expense pdf',$orientation='Portrait');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('cost_codes') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('cost_codes');
        $this->session->set_userdata('page_header', 'master');
        $this->session->set_userdata('page_detail', 'cost_codes');
        $data['datatables'] = true;
        $data['form'] = true;
        $data['incomes'] = $this->income_model->get_all_record_data();
        $data['coas'] = $this->income_model->get_all_records($table = 'gl_coa', $array =
            array(
            'rowID >' => 0,
            'acc_type' => 'D',
            'deleted' => 0), $join_table = '', $join_criteria = '', 'acc_cd', 'asc');
        $this->template->set_layout('users')->build('income', isset($data) ? $data : null);
    }


    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->income_model->get_by_id($tabel = 'sa_income', $id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }

    function delete_data($id)
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $data = $this->income_model->delete_data($tabel = 'sa_income', $id);
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

        $income_code = $this->db->get_where('sa_income', array('income_cd' => $dataPost['income_code']))->
            row_array();
        if (empty($dataPost['rowID'])) {
            if (!empty($income_code['income_cd'])) {
                echo json_encode(array("success" => false, 'msg' => lang('already_exist')));
                exit();
            } else {
                $data = array(
                    'type' => strtoupper($dataPost['income_type']),
                    'income_cd' => strtoupper($dataPost['income_code']),
                    'descs' => strtoupper($dataPost['income_name']),
                    'accrued_coa_rowID' => $dataPost['income_accrued'],
                    'income_coa_rowID' => $dataPost['income_account'],
                    'user_created' => $this->session->userdata('user_id'),
                    'date_created' => date('Y-m-d'),
                    'time_created' => date('H:i:s'));

                $this->db->insert('sa_income', $data);
                $income_code_id = $this->db->insert_id();

                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'income';
                $params['module_field_id'] = $income_code_id;
                $params['activity'] = ucfirst('Added a new Income Code ' . strtoupper($dataPost['income_name']));
                $params['icon'] = 'fa-user';
                modules::run('activitylog/log', $params); //log activity
                Header('Content-Type: application/json; charset=UTF8');
                echo json_encode(array("success" => true, 'msg' => lang('created_succesfully')));
                exit();
            }
        } else {

            $data = array(
                'type' => strtoupper($dataPost['income_type']),
                'income_cd' => strtoupper($dataPost['income_code']),
                'descs' => strtoupper($dataPost['income_name']),
                'accrued_coa_rowID' => $dataPost['income_accrued'],
                'income_coa_rowID' => $dataPost['income_account'],
                'user_modified' => $this->session->userdata('user_id'),
                'date_modified' => date('Y-m-d'),
                'time_modified' => date('H:i:s'));
            $this->db->where('rowID', $dataPost['rowID']);
            $this->db->update('sa_income', $data);
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('updated_succesfully')));
            exit();

        }
    }

}

/* End of file contacts.php */
