<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Destination extends MX_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('destination_model');
        $this->load->library('pdf_generator');
    }
    
    function pdf()
    {
        $data['destination'] = $this->destination_model->get_pdf();
        $html = $this->load->view('destination_pdf', $data, true);
        $this->pdf_generator->generate($html, 'Destination pdf');
    }
    
    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=destination.xls");

        $data['destination'] = $this->destination_model->get_pdf();
        $this->load->view("destination_pdf", $data);

    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('destinations') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('destinations');
        $this->session->set_userdata('page_header', 'master');
        $this->session->set_userdata('page_detail', 'destination');
        $data['datatables'] = true;
        $data['form'] = true;
        /*
        $data['destination'] = $this->destination_model->get_all_records($table = 'mst_destinations', $array = array(
        'destination_id >' => '0', 'deleted' => 0), $join_table = 'mst_reference', $join_criteria = 'mst_reference.No_Urut_Ref = mst_destinations.destination_flag AND fx_mst_reference.Type_Ref = "destination_flag"','destination_name');				
        */
        $data['destinations'] = $this->destination_model->get_all_records($table =
            'sa_destination', $array = array('rowID >' => 0, 'deleted' => 0), $join_table =
            '', $join_criteria = '', 'rowID', 'asc');
        
        $data['coordinates'] = $this->destination_model->get_all_records($table =
            'sa_koordinat_poi', $array = array('rowID >' => 0, 'deleted' => 0), $join_table =
            '', $join_criteria = '', 'location_name', 'asc');


        $this->template->set_layout('users')->build('destination', isset($data) ? $data : null);
    }

    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->destination_model->get_by_id($tabel = 'sa_destination', $id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }

    function delete_data($id)
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $data = $this->destination_model->delete_data($tabel = 'sa_destination', $id);
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
        $destination_code = $this->db->get_where('sa_destination', array('destination_no' =>
                $dataPost['destination_code'], 'destination_name' =>
                $dataPost['destination_name'], 'deleted' => 0))->row_array();
        if (empty($dataPost['rowID'])) {
            if (!empty($destination_code['destination_no'])) {
                echo json_encode(array("success" => false, 'msg' => lang('already_exist')));
                exit();
            } else {
                $destination_data = array(
                    'destination_no' => strtoupper($dataPost['destination_code']),
                    'destination_name' => strtoupper($dataPost['destination_name']),
                    'coordinate_rowID'  => $dataPost['coordinate_rowID'],
                    'address1' => strtoupper($dataPost['destination_address1']),
                    'address2' => strtoupper($dataPost['destination_address2']),
                    'address3' => strtoupper($dataPost['destination_address3']),
                    'post_cd'  => $dataPost['destination_postal_code'],
                    'telp_no'  => $dataPost['destination_phone'],
                    'contact_prs' => $dataPost['destination_contact_person'],
                    'user_created' => $this->session->userdata('user_id'),
                    'date_created' => date('Y-m-d'),
                    'time_created' => date('H:i:s'));
                $this->db->insert('sa_destination', $destination_data);
                $destination_id = $this->db->insert_id();

                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'Destinations';
                $params['module_field_id'] = $destination_id;
                $params['activity'] = ucfirst('Added a new destination ' . strtoupper($dataPost['destination_name']));
                $params['icon'] = 'fa-plus';
                modules::run('activitylog/log', $params); //log activity
                
                Header('Content-Type: application/json; charset=UTF8');
                echo json_encode(array("success" => true, 'msg' => lang('destination_registered_successfully')));
                exit();

            }

        } else {
            $destination_data = array(
                    'destination_no' => strtoupper($dataPost['destination_code']),
                    'destination_name' => strtoupper($dataPost['destination_name']),
                    'coordinate_rowID'  => $dataPost['coordinate_rowID'],
                    'address1' => strtoupper($dataPost['destination_address1']),
                    'address2' => strtoupper($dataPost['destination_address2']),
                    'address3' => strtoupper($dataPost['destination_address3']),
                    'post_cd'  => $dataPost['destination_postal_code'],
                    'telp_no'  => $dataPost['destination_phone'],
                    'contact_prs' => $dataPost['destination_contact_person'],
                    'user_modified' => $this->session->userdata('user_id'),
                    'date_modified' => date('Y-m-d'),
                    'time_modified' => date('H:i:s'));
            $this->db->where('rowID', $dataPost['rowID']);
            $this->db->update('sa_destination', $destination_data);
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Destinations';
            $params['module_field_id'] = $dataPost['rowID'];
            $params['activity'] = ucfirst('Update a destination ' . strtoupper($dataPost['destination_name']));
            $params['icon'] = 'fa-edit';
            modules::run('activitylog/log', $params); //log activity
            
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('destination_edited_successfully')));
            exit();

        }

    }

    function copy_to_port(){
        $get_data = $this->destination_model->get_by_id($tabel = 'sa_destination', $this->input->post('destination_rowID'));
        
        $port_code = $this->db->get_where('sa_port', array('port_cd' => $get_data->destination_no))->
            row_array();
        if (!empty($port_code['port_cd'])) {
            echo json_encode(array("success" => false, 'msg' => lang('already_exist')));
            exit();
        } 
        else {
            $data_port = array(
                'port_cd' => strtoupper($get_data->destination_no),
                'port_name' => strtoupper($get_data->destination_name),
                'port_type' => $this->input->post('port_type'),
                'user_created' => $this->session->userdata('user_id'),
                'date_created' => date('Y-m-d'),
                'time_created' => date('H:i:s')
            );
            $this->db->insert('sa_port', $data_port);
            $port_id = $this->db->insert_id();
    
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'ports';
            $params['module_field_id'] = $port_id;
            $params['activity'] = ucfirst('Added a new Port ' . strtoupper($get_data->destination_name));
            $params['icon'] = 'fa-plus';
            modules::run('activitylog/log', $params); //log activity
            
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('port_registered_successfully')));
            exit();
        }
    }


}

/* End of file contacts.php */
