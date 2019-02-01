<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Accu extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('accu_model');
        $this->load->library('pdf_generator');
    }
 
    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('accus') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('accus');
        $this->session->set_userdata('page_header', 'monitoring');
        $this->session->set_userdata('page_detail', 'accu');
        $data['datatables'] = true;
        $data['form'] = true;

        $data['accus'] = $this->accu_model->get_all_records();
        $data['vehicles'] = $this->accu_model->get_all_vehicle_data();
        $data['debtors'] = $this->accu_model->get_all_debtor_data();
        
        $this->template->set_layout('users')->build('accus', isset($data) ? $data : null);
    }

    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->accu_model->get_by_id($tabel = 'tr_accu_hdr', $id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function get_data_detail($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->accu_model->get_detail_by_id($id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }

    function delete_data($id)
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $data = $this->accu_model->delete_data($tabel = 'tr_accu_hdr', $id);
        
        $params['user_rowID'] = $this->tank_auth->get_user_id();
        $params['module'] = 'Accus';
        $params['module_field_id'] = $id;
        $params['activity'] = ucfirst('Deleted a Accu with ID = ' . $id);
        $params['icon'] = 'fa-times';
        modules::run('activitylog/log', $params); //log activity

        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }

    function pdf()
    {
        $data['accus'] = $this->accu_model->get_all_records();
        $html = $this->load->view('accu_pdf', $data, true);
        $this->pdf_generator->generate($html, 'accu pdf',$orientation='Portrait');
    }
    
    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=accus.xls");

        $data['accus'] = $this->accu_model->get_all_records();
        $this->load->view("accu_pdf", $data);

    }

    function create()
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $dataPost = $this->input->post();            

        $dataPost = $this->input->post();
        if (empty($dataPost['rowID'])) {
            $data_accu = array(
                'date'          => date('Y-m-d',strtotime($dataPost['date'])),
                'vehicle_rowID' => $dataPost['vehicle_id'],
                'debtor_rowID' => $dataPost['debtor_id'],
                'photo_url' => $dataPost['photo_url'],
                'user_created' => $this->session->userdata('user_id'),
                'datetime_created' => date('Y-m-d H:i:s')
            );
            
            $this->db->insert('tr_accu_hdr', $data_accu);
            $accu_id = $this->db->insert_id();

            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'accus';
            $params['module_field_id'] = $accu_id;
            $params['activity'] = ucfirst('Added a new accu with vehicle id = ' . $dataPost['vehicle_id']);
            $params['icon'] = 'fa-plus';
            modules::run('activitylog/log', $params); //log activity

            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('accu_registered_successfully')));
            exit();
        } 
        else {
            $data_accu = array(
                'date'          => date('Y-m-d',strtotime($dataPost['date'])),
                'vehicle_rowID' => $dataPost['vehicle_id'],
                'debtor_rowID' => $dataPost['debtor_id'],
                'photo_url' => $dataPost['photo_url'],
                'user_modified' => $this->session->userdata('user_id'),
                'datetime_modified' => date('Y-m-d H:i:s')
            );
            $this->db->where('rowID', $dataPost['rowID']);
            $this->db->update('tr_accu_hdr', $data_accu);
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'accus';
            $params['module_field_id'] = $dataPost['rowID'];
            $params['activity'] = ucfirst('Update a accu with id = '.$dataPost['rowID'].' and vehicle id = ' . $dataPost['vehicle_id']);
            $params['icon'] = 'fa-edit';
            modules::run('activitylog/log', $params); //log activity
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('accu_edited_successfully')));
            exit();

        }
    }

    function create_detail()
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $dataPost = $this->input->post();            

        $dataPost = $this->input->post();
        if (empty($dataPost['rowID'])) {
            $data_accu = array(
                'accu_rowID' => $dataPost['accu_rowID'],
                'accu_no' => $dataPost['accu_no'],
                'accu_condition' => $dataPost['accu_condition'],
                'accu_brand' => ucwords($dataPost['accu_brand']),
                'accu_type' => ucwords($dataPost['accu_type']),
                'accu_size' => $dataPost['accu_size'],
                'user_created' => $this->session->userdata('user_id'),
                'datetime_created' => date('Y-m-d H:i:s')
            );
            
            $this->db->insert('tr_accu_dtl', $data_accu);
            $accu_dtl_id = $this->db->insert_id();

            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'accus';
            $params['module_field_id'] = $accu_dtl_id;
            $params['activity'] = ucfirst('Added a new accu detail with accu id = ' . $dataPost['accu_rowID']);
            $params['icon'] = 'fa-plus';
            modules::run('activitylog/log', $params); //log activity

            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('accu_registered_successfully')));
            exit();
        } 
        else {
            $data_accu = array(
                'accu_rowID' => $dataPost['accu_rowID'],
                'accu_no' => $dataPost['accu_no'],
                'accu_condition' => $dataPost['accu_condition'],
                'accu_brand' => ucwords($dataPost['accu_brand']),
                'accu_type' => ucwords($dataPost['accu_type']),
                'accu_size' => $dataPost['accu_size'],
                'user_modified' => $this->session->userdata('user_id'),
                'datetime_modified' => date('Y-m-d H:i:s')
            );
            $this->db->where('rowID', $dataPost['rowID']);
            $this->db->update('tr_accu_dtl', $data_accu);
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'accus';
            $params['module_field_id'] = $dataPost['rowID'];
            $params['activity'] = ucfirst('Update a accu detail with id = '.$dataPost['rowID'].' and accu id = ' . $dataPost['accu_rowID']);
            $params['icon'] = 'fa-edit';
            modules::run('activitylog/log', $params); //log activity
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('accu_edited_successfully')));
            exit();

        }
    }

}

/* End of file contacts.php */
