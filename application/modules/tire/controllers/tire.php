<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Tire extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('tire_model');
        $this->load->library('pdf_generator');
    }
 
    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('tires') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('tires');
        $this->session->set_userdata('page_header', 'monitoring');
        $this->session->set_userdata('page_detail', 'tire');
        $data['datatables'] = true;
        $data['form'] = true;

        $data['tires'] = $this->tire_model->get_all_records();
        $data['vehicles'] = $this->tire_model->get_all_vehicle_data();
        $data['debtors'] = $this->tire_model->get_all_debtor_data();
        
        $this->template->set_layout('users')->build('tires', isset($data) ? $data : null);
    }

    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->tire_model->get_by_id($tabel = 'tr_tire_hdr', $id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function get_data_detail($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->tire_model->get_detail_by_id($id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }

    function delete_data($id)
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $data = $this->tire_model->delete_data($tabel = 'tr_tire_hdr', $id);
        
        $params['user_rowID'] = $this->tank_auth->get_user_id();
        $params['module'] = 'Tires';
        $params['module_field_id'] = $id;
        $params['activity'] = ucfirst('Deleted a Tire with ID = ' . $id);
        $params['icon'] = 'fa-times';
        modules::run('activitylog/log', $params); //log activity

        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }

    function pdf()
    {
        $data['tires'] = $this->tire_model->get_all_records();
        $html = $this->load->view('tire_pdf', $data, true);
        $this->pdf_generator->generate($html, 'tire pdf',$orientation='Portrait');
    }
    
    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=tires.xls");

        $data['tires'] = $this->tire_model->get_all_records();
        $this->load->view("tire_pdf", $data);

    }

    function create()
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $dataPost = $this->input->post();            

        $dataPost = $this->input->post();
        if (empty($dataPost['rowID'])) {
            $data_tire = array(
                'date'          => date('Y-m-d',strtotime($dataPost['date'])),
                'vehicle_rowID' => $dataPost['vehicle_id'],
                'debtor_rowID' => $dataPost['debtor_id'],
                'tire_position' => ucwords($dataPost['tire_position']),
                'photo_url' => $dataPost['photo_url'],
                'user_created' => $this->session->userdata('user_id'),
                'datetime_created' => date('Y-m-d H:i:s')
            );
            
            $this->db->insert('tr_tire_hdr', $data_tire);
            $tire_id = $this->db->insert_id();

            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'tires';
            $params['module_field_id'] = $tire_id;
            $params['activity'] = ucfirst('Added a new tire with vehicle id = ' . $dataPost['vehicle_id']);
            $params['icon'] = 'fa-plus';
            modules::run('activitylog/log', $params); //log activity

            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('tire_registered_successfully')));
            exit();
        } 
        else {
            $data_tire = array(
                'date'          => date('Y-m-d',strtotime($dataPost['date'])),
                'vehicle_rowID' => $dataPost['vehicle_id'],
                'debtor_rowID' => $dataPost['debtor_id'],
                'tire_position' => ucwords($dataPost['tire_position']),
                'photo_url' => $dataPost['photo_url'],
                'user_modified' => $this->session->userdata('user_id'),
                'datetime_modified' => date('Y-m-d H:i:s')
            );
            $this->db->where('rowID', $dataPost['rowID']);
            $this->db->update('tr_tire_hdr', $data_tire);
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'tires';
            $params['module_field_id'] = $dataPost['rowID'];
            $params['activity'] = ucfirst('Update a tire with id = '.$dataPost['rowID'].' and vehicle id = ' . $dataPost['vehicle_id']);
            $params['icon'] = 'fa-edit';
            modules::run('activitylog/log', $params); //log activity
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('tire_edited_successfully')));
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
            $data_tire = array(
                'tire_rowID' => $dataPost['tire_rowID'],
                'tire_no' => $dataPost['tire_no'],
                'tire_condition' => $dataPost['tire_condition'],
                'tire_brand' => ucwords($dataPost['tire_brand']),
                'tire_type' => ucwords($dataPost['tire_type']),
                'tire_size' => $dataPost['tire_size'],
                'user_created' => $this->session->userdata('user_id'),
                'datetime_created' => date('Y-m-d H:i:s')
            );
            
            $this->db->insert('tr_tire_dtl', $data_tire);
            $tire_dtl_id = $this->db->insert_id();

            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'tires';
            $params['module_field_id'] = $tire_dtl_id;
            $params['activity'] = ucfirst('Added a new tire detail with tire id = ' . $dataPost['tire_rowID']);
            $params['icon'] = 'fa-plus';
            modules::run('activitylog/log', $params); //log activity

            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('tire_registered_successfully')));
            exit();
        } 
        else {
            $data_tire = array(
                'tire_rowID' => $dataPost['tire_rowID'],
                'tire_no' => $dataPost['tire_no'],
                'tire_condition' => $dataPost['tire_condition'],
                'tire_brand' => ucwords($dataPost['tire_brand']),
                'tire_type' => ucwords($dataPost['tire_type']),
                'tire_size' => $dataPost['tire_size'],
                'user_modified' => $this->session->userdata('user_id'),
                'datetime_modified' => date('Y-m-d H:i:s')
            );
            $this->db->where('rowID', $dataPost['rowID']);
            $this->db->update('tr_tire_dtl', $data_tire);
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'tires';
            $params['module_field_id'] = $dataPost['rowID'];
            $params['activity'] = ucfirst('Update a tire detail with id = '.$dataPost['rowID'].' and tire id = ' . $dataPost['tire_rowID']);
            $params['icon'] = 'fa-edit';
            modules::run('activitylog/log', $params); //log activity
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('tire_edited_successfully')));
            exit();

        }
    }

}

/* End of file contacts.php */
