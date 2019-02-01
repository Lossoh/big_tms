<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Port extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('port_model');
        $this->load->library('pdf_generator');
    }
    
    function pdf()
    {
        $data['port'] = $this->port_model->get_pdf();
        $html = $this->load->view('port_pdf', $data, true);
        $this->pdf_generator->generate($html, 'port pdf',$orientation='Portrait');//Portrait
    }
    
    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=port_data.xls");

        $data['port'] = $this->port_model->get_pdf();
        $this->load->view("port_pdf", $data);

    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('ports') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('ports');
        $this->session->set_userdata('page_header', 'master');
        $this->session->set_userdata('page_detail', 'ports');
        $data['datatables'] = true;
        $data['form'] = true;
        $data['ports'] = $this->port_model->get_all_records($table = 'sa_port', $array =
            array('rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '',
            'rowID', 'desc');
        $this->template->set_layout('users')->build('ports', isset($data) ? $data : null);
    }

    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->port_model->get_by_id($tabel = 'sa_port', $id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }

    function delete_data($id)
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $data = $this->port_model->delete_data($tabel = 'sa_port', $id);
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
        $port_code = $this->db->get_where('sa_port', array('port_cd' => $dataPost['port_code']))->
            row_array();
        if (empty($dataPost['rowID'])) {
            if (!empty($port_code['port_cd'])) {
                echo json_encode(array("success" => false, 'msg' => lang('already_exist')));
                exit();
            } else {
                $data_port = array(
                    'port_cd' => strtoupper($dataPost['port_code']),
                    'port_name' => strtoupper($dataPost['port_name']),
                    'port_type' => $dataPost['port_type'],
                    'user_created' => $this->session->userdata('user_id'),
                    'date_created' => date('Y-m-d'),
                    'time_created' => date('H:i:s')
                );
                $this->db->insert('sa_port', $data_port);
                $port_id = $this->db->insert_id();

                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'ports';
                $params['module_field_id'] = $port_id;
                $params['activity'] = ucfirst('Added a new Port ' . strtoupper($dataPost['port_name']));
                $params['icon'] = 'fa-plus';
                modules::run('activitylog/log', $params); //log activity
                
                Header('Content-Type: application/json; charset=UTF8');
                echo json_encode(array("success" => true, 'msg' => lang('port_registered_successfully')));
                exit();
            }
        } else {
            $data_port = array(
                'port_cd' => strtoupper($dataPost['port_code']),
                'port_name' => strtoupper($dataPost['port_name']),
                'port_type' => $dataPost['port_type'],
                'user_modified' => $this->session->userdata('user_id'),
                'date_modified' => date('Y-m-d'),
                'time_modified' => date('H:i:s')
            );
            $this->db->where('rowID', $dataPost['rowID']);
            $this->db->update('sa_port', $data_port);
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'ports';
            $params['module_field_id'] = $dataPost['rowID'];
            $params['activity'] = ucfirst('Update a port ' . strtoupper($dataPost['port_name']));
            $params['icon'] = 'fa-edit';
            modules::run('activitylog/log', $params); //log activity
                
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('port_edited_successfully')));
            exit();

        }
    }
    
    /*
    function create2()
    {
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<span style="color:red">',
                '</span><br>');
            $this->form_validation->set_rules('port_code', 'Port Code',
                'required|xss_clean|is_unique[sa_port.port_cd]');
            $this->form_validation->set_rules('port_name', 'Port Name', 'required|xss_clean');

            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('response_status', 'error');
                $this->session->set_flashdata('message', lang('error_in_form'));
                $_POST = '';
                $this->index();
            } else {
                $data_port = array(
                    'port_cd' => strtoupper($this->input->post('port_code')),
                    'descs' => strtoupper($this->input->post('port_name')),
                    'user_created' => $this->session->userdata('user_id'),
                    'date_created' => date('Y-m-d'),
                    'time_created' => date('H:i:s'));
                $this->db->insert('sa_port', $data_port);
                $port_id = $this->db->insert_id();

                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'ports';
                $params['module_field_id'] = $port_id;
                $params['activity'] = ucfirst('Added a new Port ' . $this->input->post('port_name'));
                $params['icon'] = 'fa-user';
                modules::run('activitylog/log', $params); //log activity

                $this->session->set_flashdata('response_status', 'success');
                $this->session->set_flashdata('message', lang('port_registered_successfully'));
                redirect('port');
            }
        } else {
            $this->session->set_flashdata('response_status', 'error');
            $this->session->set_flashdata('message', lang('error_in_form'));
            redirect('port');
        }
    }
    */
}

/* End of file contacts.php */
