<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Expense extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('expense_model');
        $this->load->library('pdf_generator');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('expenses') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('expenses');
        $this->session->set_userdata('page_header', 'master');
        $this->session->set_userdata('page_detail', 'expenses');
        $data['datatables'] = true;
        $data['form'] = true;
        /*
        $data['expenses'] = $this->expense_model->get_all_records($table = 'sa_expense',
        $array = array('rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria =
        '', 'expense_cd', 'asc');
        */
        $data['expenses'] = $this->expense_model->get_all_record_data();

        $data['expenses_accounts'] = $this->expense_model->get_all_records($table =
            'gl_coa', $array = array(
            'rowID >' => 0,
            'acc_type' => 'D',
            'deleted' => 0), $join_table = '', $join_criteria = '', 'acc_cd', 'asc');
        
        $data['types'] = $this->expense_model->get_all_records($table =
            'sa_advance_category', $array = array(
            'rowID >' => 0,
            'deleted' => 0), $join_table = '', $join_criteria = '', 'advance_name', 'asc');

        $this->template->set_layout('users')->build('expenses', isset($data) ? $data : null);
    }

    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->expense_model->get_by_id($tabel = 'sa_expense', $id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }

    function delete_data($id)
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $data = $this->expense_model->delete_data($tabel = 'sa_expense', $id);
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
        $expense_cd = $this->db->get_where('sa_expense', array('expense_cd' => $dataPost['expenses_code']))->
                row_array();
                
        if (empty($dataPost['rowID'])) {
            if (!empty($expense_cd['expense_cd'])) {
                echo json_encode(array("success" => false, 'msg' => lang('already_exist')));
                exit();
            } else {

                $data_expense = array(
                    'expense_cd' => strtoupper($dataPost['expenses_code']),
                    'descs' => strtoupper($dataPost['expenses_name']),
                    'advance_category_rowID' => $dataPost['advance_category'],
                    'expense_acc_rowID' => $dataPost['expenses_account'],
                    'ap_acc_rowID' => $dataPost['ap_account'],
                    'reimburse_acc_rowID' => $dataPost['reimburse_account'],
                    'advance_acc_rowID' => $dataPost['advance_account'],
                    'user_created' => $this->session->userdata('user_id'),
                    'date_created' => date('Y-m-d'),
                    'time_created' => date('H:i:s'));
                $this->db->insert('sa_expense', $data_expense);
                $expense_id = $this->db->insert_id();

                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'coas';
                $params['module_field_id'] = $expense_id;
                $params['activity'] = ucfirst('Added a new Chart of Account ' . $this->input->
                    post('expenses_name'));
                $params['icon'] = 'fa-user';
                modules::run('activitylog/log', $params); //log activity
                Header('Content-Type: application/json; charset=UTF8');
                echo json_encode(array("success" => true, 'msg' => lang('created_succesfully')));
                exit();
            }

        } else {

                $data_expense = array(
                    'expense_cd' => strtoupper($dataPost['expenses_code']),
                    'descs' => strtoupper($dataPost['expenses_name']),
                    'advance_category_rowID' => $dataPost['advance_category'],
                    'expense_acc_rowID' => $dataPost['expenses_account'],
                    'ap_acc_rowID' => $dataPost['ap_account'],
                    'reimburse_acc_rowID' => $dataPost['reimburse_account'],
                    'advance_acc_rowID' => $dataPost['advance_account'],
                    'user_modified' => $this->session->userdata('user_id'),
                    'date_modified' => date('Y-m-d'),
                    'time_modified' => date('H:i:s'));

                $this->db->where('rowID', $dataPost['rowID']);
                $this->db->update('sa_expense', $data_expense);
                Header('Content-Type: application/json; charset=UTF8');
                echo json_encode(array("success" => true,  'msg' => lang('updated_succesfully')));
                exit();
            
        }

    }
    
    function pdf()
    {

        $data['expense'] = $this->expense_model->get_pdf();
        $html = $this->load->view('expense_pdf', $data, true);
        $this->pdf_generator->generate($html, 'expense pdf',$orientation='Portrait');
    }
    
    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=expense.xls");

        $data['expense'] = $this->expense_model->get_pdf();
        $this->load->view("expense_pdf", $data);

    }

}

/* End of file contacts.php */
