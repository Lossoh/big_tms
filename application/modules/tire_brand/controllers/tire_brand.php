<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Tire_brand extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('tire_brand_model');
        $this->load->library('pdf_generator');
    }
 
    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('tire_brands') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('tire_brands');
        $this->session->set_userdata('page_header', 'master');
        $this->session->set_userdata('page_detail', 'tire_brand');
        $data['datatables'] = true;
        $data['form'] = true;

        $data['tire_brands'] = $this->tire_brand_model->get_all_records();
        
        $this->template->set_layout('users')->build('tire_brands', isset($data) ? $data : null);
    }

    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->tire_brand_model->get_by_id($tabel = 'tr_tire_brand_hdr', $id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function get_data_detail($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->tire_brand_model->get_detail_by_id($id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }

    function delete_data($id)
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $data = $this->tire_brand_model->delete_data($tabel = 'tr_tire_brand_hdr', $id);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }

    function pdf()
    {
        $data['tire_brands'] = $this->tire_brand_model->get_all_records();
        $html = $this->load->view('tire_brand_pdf', $data, true);
        $this->pdf_generator->generate($html, 'tire_brand pdf',$orientation='Portrait');
    }
    
    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=tire_brands.xls");

        $data['tire_brands'] = $this->tire_brand_model->get_all_records();
        $this->load->view("tire_brand_pdf", $data);

    }

    function create()
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $dataPost = $this->input->post();            

        $dataPost = $this->input->post();
        if (empty($dataPost['rowID'])) {
            $data_tire_brand = array(
                'date'          => date('Y-m-d',strtotime($dataPost['date'])),
                'vehicle_rowID' => $dataPost['vehicle_id'],
                'debtor_rowID' => $dataPost['debtor_id'],
                'tire_brand_position' => ucwords($dataPost['tire_brand_position']),
                'photo_url' => $dataPost['photo_url'],
                'user_created' => $this->session->userdata('user_id'),
                'datetime_created' => date('Y-m-d H:i:s')
            );
            
            $this->db->insert('tr_tire_brand_hdr', $data_tire_brand);
            $tire_brand_id = $this->db->insert_id();

            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'tire_brands';
            $params['module_field_id'] = $tire_brand_id;
            $params['activity'] = ucfirst('Added a new tire_brand with vehicle id = ' . $dataPost['vehicle_id']);
            $params['icon'] = 'fa-user';
            modules::run('activitylog/log', $params); //log activity

            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('tire_brand_registered_successfully')));
            exit();
        } 
        else {
            $data_tire_brand = array(
                'date'          => date('Y-m-d',strtotime($dataPost['date'])),
                'vehicle_rowID' => $dataPost['vehicle_id'],
                'debtor_rowID' => $dataPost['debtor_id'],
                'tire_brand_position' => ucwords($dataPost['tire_brand_position']),
                'photo_url' => $dataPost['photo_url'],
                'user_modified' => $this->session->userdata('user_id'),
                'datetime_modified' => date('Y-m-d H:i:s')
            );
            $this->db->where('rowID', $dataPost['rowID']);
            $this->db->update('tr_tire_brand_hdr', $data_tire_brand);
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'tire_brands';
            $params['module_field_id'] = $dataPost['rowID'];
            $params['activity'] = ucfirst('Update a tire_brand with id = '.$dataPost['rowID'].' and vehicle id = ' . $dataPost['vehicle_id']);
            $params['icon'] = 'fa-edit';
            modules::run('activitylog/log', $params); //log activity
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('tire_brand_edited_successfully')));
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
            $data_tire_brand = array(
                'tire_brand_rowID' => $dataPost['tire_brand_rowID'],
                'tire_brand_no' => $dataPost['tire_brand_no'],
                'tire_brand_condition' => $dataPost['tire_brand_condition'],
                'tire_brand_brand' => ucwords($dataPost['tire_brand_brand']),
                'tire_brand_type' => ucwords($dataPost['tire_brand_type']),
                'tire_brand_size' => $dataPost['tire_brand_size'],
                'user_created' => $this->session->userdata('user_id'),
                'datetime_created' => date('Y-m-d H:i:s')
            );
            
            $this->db->insert('tr_tire_brand_dtl', $data_tire_brand);
            $tire_brand_dtl_id = $this->db->insert_id();

            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'tire_brands';
            $params['module_field_id'] = $tire_brand_dtl_id;
            $params['activity'] = ucfirst('Added a new tire_brand detail with tire_brand id = ' . $dataPost['tire_brand_rowID']);
            $params['icon'] = 'fa-user';
            modules::run('activitylog/log', $params); //log activity

            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('tire_brand_registered_successfully')));
            exit();
        } 
        else {
            $data_tire_brand = array(
                'tire_brand_rowID' => $dataPost['tire_brand_rowID'],
                'tire_brand_no' => $dataPost['tire_brand_no'],
                'tire_brand_condition' => $dataPost['tire_brand_condition'],
                'tire_brand_brand' => ucwords($dataPost['tire_brand_brand']),
                'tire_brand_type' => ucwords($dataPost['tire_brand_type']),
                'tire_brand_size' => $dataPost['tire_brand_size'],
                'user_modified' => $this->session->userdata('user_id'),
                'datetime_modified' => date('Y-m-d H:i:s')
            );
            $this->db->where('rowID', $dataPost['rowID']);
            $this->db->update('tr_tire_brand_dtl', $data_tire_brand);
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'tire_brands';
            $params['module_field_id'] = $dataPost['rowID'];
            $params['activity'] = ucfirst('Update a tire_brand detail with id = '.$dataPost['rowID'].' and tire_brand id = ' . $dataPost['tire_brand_rowID']);
            $params['icon'] = 'fa-edit';
            modules::run('activitylog/log', $params); //log activity
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('tire_brand_edited_successfully')));
            exit();

        }
    }

}

/* End of file contacts.php */
