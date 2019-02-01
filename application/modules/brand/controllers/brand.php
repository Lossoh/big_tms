<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Brand extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('brand_model');
        $this->load->library('pdf_generator');
    }
 
    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('brand') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('brand');
        $this->session->set_userdata('page_header', 'master');
        $this->session->set_userdata('page_detail', 'brand');
        $data['datatables'] = true;
        $data['form'] = true;

        $data['brands'] = $this->brand_model->get_all_records();
        
        $this->template->set_layout('users')->build('brands', isset($data) ? $data : null);
    }

    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->brand_model->get_by_id($tabel = 'sa_brand', $id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function delete_data($id)
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $data = $this->brand_model->delete_data($tabel = 'sa_brand', $id);
        
        $params['user_rowID'] = $this->tank_auth->get_user_id();
        $params['module'] = 'Brand';
        $params['module_field_id'] = $id;
        $params['activity'] = ucfirst('Delete a Brand with ID = ' . $id);
        $params['icon'] = 'fa-times';
        modules::run('activitylog/log', $params); //log activity

        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }

    function pdf()
    {
        $data['brands'] = $this->brand_model->get_all_records();
        $html = $this->load->view('brand_pdf', $data, true);
        $this->pdf_generator->generate($html, 'brand pdf',$orientation='Portrait');
    }
    
    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=brand.xls");

        $data['brands'] = $this->brand_model->get_all_records();
        $this->load->view("brand_pdf", $data);

    }

    function create()
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $dataPost = $this->input->post();            

        $dataPost = $this->input->post();
        if (empty($dataPost['rowID'])) {
            $data_brand = array(
                'brand_name' => ucwords($dataPost['brand_name']),
                'user_created' => $this->session->userdata('user_id'),
                'date_created' => date('Y-m-d'),
                'time_created' => date('H:i:s')
            );
            
            $this->db->insert('sa_brand', $data_brand);
            $brand_id = $this->db->insert_id();

            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Brand';
            $params['module_field_id'] = $brand_id;
            $params['activity'] = ucfirst('Added a new Brand with Brand Name = ' . ucwords($dataPost['brand_name']));
            $params['icon'] = 'fa-plus';
            modules::run('activitylog/log', $params); //log activity

            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('saving_brand_successfully')));
            exit();
        } 
        else {
            $data_brand = array(
                'brand_name' => ucwords($dataPost['brand_name']),
                'user_modified' => $this->session->userdata('user_id'),
                'date_modified' => date('Y-m-d'),
                'time_modified' => date('H:i:s'),
            );
            $this->db->where('rowID', $dataPost['rowID']);
            $this->db->update('sa_brand', $data_brand);
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Brand';
            $params['module_field_id'] = $dataPost['rowID'];
            $params['activity'] = ucfirst('Update a Brand with ID = '.$dataPost['rowID'].' and Brand Name = ' . ucwords($dataPost['brand_name']));
            $params['icon'] = 'fa-edit';
            modules::run('activitylog/log', $params); //log activity
            
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('saving_brand_successfully')));
            exit();

        }
    }
    
}

/* End of file contacts.php */
