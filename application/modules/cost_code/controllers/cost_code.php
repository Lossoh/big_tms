<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Cost_code extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('cost_code_model');
        $this->load->library('pdf_generator');
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
        $data['cost_codes'] = $this->cost_code_model->get_all_record_data();
        //$data['cost_codes'] = $this->cost_code_model->get_all_records($table = 'sa_cost', $array = array(
        //	'rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '','cost_cd','asc');
        $data['cost_code_subs'] = $this->cost_code_model->get_all_records($table =
            'sa_cost', $array = array(
            'rowID >' => 0,
            'type' => 'H',
            'deleted' => 0), $join_table = '', $join_criteria = '', 'cost_cd', 'asc');
        $data['coas'] = $this->cost_code_model->get_all_records($table = 'gl_coa', $array =
            array(
            'rowID >' => 0,
            'acc_type' => 'D',
            'deleted' => 0), $join_table = '', $join_criteria = '', 'acc_cd', 'asc');
        $this->template->set_layout('users')->build('cost_codes', isset($data) ? $data : null);
    }
    
    
    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->cost_code_model->get_by_id($tabel = 'sa_cost', $id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function delete_data($id)
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $data = $this->cost_code_model->delete_data($tabel = 'sa_cost', $id);
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

        $cost_code = $this->db->get_where('sa_cost', array('cost_cd' => $dataPost['cost_code_code']))->
            row_array();
        if (empty($dataPost['rowID'])) {
            if (!empty($cost_code['cost_cd'])) {
                echo json_encode(array("success" => false, 'msg' => lang('already_exist')));
                exit();
            } else {
                $data_cost_code = array(
                    'type' => strtoupper($dataPost['cost_code_type']),
                    'cost_cd' => strtoupper($dataPost['cost_code_code']),
                    'descs' => strtoupper($dataPost['cost_code_name']),
                    'wip_acc_rowID' => $dataPost['cost_code_wip'],
                    'cogs_acc_rowID' => $dataPost['cost_code_cogs'],
                    'site_flag' => $dataPost['cost_code_site'],
                    'fare_trip_comp' => $dataPost['cost_code_fare_trip_comp'],
                    'user_created' => $this->session->userdata('user_id'),
                    'date_created' => date('Y-m-d'),
                    'time_created' => date('H:i:s'));

                $this->db->insert('sa_cost', $data_cost_code);
                $cost_code_id = $this->db->insert_id();

                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'cost_codes';
                $params['module_field_id'] = $cost_code_id;
                $params['activity'] = ucfirst('Added a new Cost Code ' . $this->input->post('cost_code_name'));
                $params['icon'] = 'fa-user';
                modules::run('activitylog/log', $params); //log activity
                Header('Content-Type: application/json; charset=UTF8');
                echo json_encode(array("success" => true, 'msg' => lang('created_succesfully')));
                exit();
            }
        } else {

            $data_cost_code = array(
                'type' => strtoupper($dataPost['cost_code_type']),
                'cost_cd' => strtoupper($dataPost['cost_code_code']),
                'descs' => strtoupper($dataPost['cost_code_name']),
                'wip_acc_rowID' => $dataPost['cost_code_wip'],
                'cogs_acc_rowID' => $dataPost['cost_code_cogs'],
                'site_flag' => $dataPost['cost_code_site'],
                'fare_trip_comp' => $dataPost['cost_code_fare_trip_comp'],
                'user_modified' => $this->session->userdata('user_id'),
                'date_modified' => date('Y-m-d'),
                'time_modified' => date('H:i:s'));
            $this->db->where('rowID', $dataPost['rowID']);
            $this->db->update('sa_cost', $data_cost_code);
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('updated_succesfully')));
            exit();

        }
    }
    
    function pdf()
    {
        $data['cost_code'] = $this->cost_code_model->get_pdf();
        $html = $this->load->view('cost_pdf', $data, true);
        $this->pdf_generator->generate($html, 'cost code pdf',$orientation='Portrait');
    }
    
    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=cost.xls");

        $data['cost_code'] = $this->cost_code_model->get_pdf();
        $this->load->view("cost_pdf", $data);

    }

}

/* End of file contacts.php */
