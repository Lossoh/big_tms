<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Vehicle_Position extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('vehicle_position_model');
        $this->load->model('vehicle/vehicle_model');
        $this->load->library('pdf_generator');
        
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('vehicle_positions') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('vehicle_positions');
        $this->session->set_userdata('page_header', 'monitoring');
        $this->session->set_userdata('page_detail', 'vehicle_positions');
        $data['datatables'] = true;
        $data['form'] = true;
        
        $data['vehicle_positions'] = $this->vehicle_position_model->get_all_records_list();
        
        $data['vehicles'] = $this->vehicle_model->get_all_records_list($table =
            'sa_vehicle', $array = array('sa_vehicle.rowID >' => 0, 'sa_vehicle.deleted' =>
                0), $join_table1 = 'sa_debtor', $join_criteria1 =
            'sa_vehicle.debtor_rowID=sa_debtor.rowID', 'sa_vehicle.rowID', 'asc');
            
        $this->template->set_layout('users')->build('vehicles', isset($data) ? $data : null);
    }
    
    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $hasil = $this->vehicle_position_model->get_by_id($tabel = 'mo_vehicle_position', $id);
        header('Content-type: application/json');
        echo json_encode($hasil);
        exit;
    }

    function delete_data($id)
    {
        header('Content-Type: application/json');
        $data = $this->vehicle_position_model->delete_data($id);
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
                
        if (empty($dataPost['rowID'])) {
            
            $data_vehicle = array(
                'vehicle_id' => $this->input->post('vehicle_id'),
                'type' => 'Manual',
                'position' => $this->input->post('position'),
                'note' => ucfirst($this->input->post('note')),
                'user_created' => $this->session->userdata('user_id'),
                'date_created' => date("Y-m-d")
            );
            $this->db->insert('mo_vehicle_position', $data_vehicle);
            $vehicle_id = $this->db->insert_id();

            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'vehicles';
            $params['module_field_id'] = $vehicle_id;
            $params['activity'] = ucfirst('Added a new Vehicle Position ' . $this->input->post('vehicle_id'));
            $params['icon'] = 'fa-user';
            modules::run('activitylog/log', $params); //log activity
            echo json_encode(array("success" => true, 'msg' => lang('vehicle_position_registered_successfully')));
            exit;
        } else { // edit Data

            $data_vehicle = array(
                'vehicle_id' => $this->input->post('vehicle_id'),
                'position' => $this->input->post('position'),
                'note' => ucfirst($this->input->post('note')),
                'user_created' => $this->session->userdata('user_id'),
                'date_modified' => date("Y-m-d H:i:s")
            );
            $this->db->where('rowID', $dataPost['rowID']);
            $this->db->update('mo_vehicle_position', $data_vehicle);
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('vehicle_position_edited_successfully')));
            exit();
        }

    }
    
    function pdf()
    {
        $data['vehicle_positions'] = $this->vehicle_position_model->get_all_records_list();
        $html = $this->load->view('vehicle_pdf', $data, true);
        $this->pdf_generator->generate($html, 'Vehicle Document',$orientation='Potrait');
    }
    
    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=vehicle_positions.xls");
        $data['vehicle_positions'] = $this->vehicle_position_model->get_all_records_list();

        $this->load->view("vehicle_pdf", $data);
    }
    
}

/* End of file contacts.php */
