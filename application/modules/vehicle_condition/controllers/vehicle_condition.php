<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Vehicle_Condition extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('vehicle_condition_model');
        $this->load->model('vehicle/vehicle_model');
        $this->load->library('pdf_generator');
        
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('vehicle_conditions') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('vehicle_conditions');
        $this->session->set_userdata('page_header', 'monitoring');
        $this->session->set_userdata('page_detail', 'vehicle_conditions');
        $data['datatables'] = true;
        $data['form'] = true;
        
        if($this->session->userdata('start_date_vc') == '' && $this->session->userdata('end_date_vc') == ''){
            $start_date = date("Y-m-d",strtotime("yesterday"));
            $end_date = date("Y-m-d");
        }
        else{
            $start_date = $this->session->userdata('start_date_vc');
            $end_date = $this->session->userdata('end_date_vc');
        }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;

        $data['vehicle_conditions'] = $this->vehicle_condition_model->get_all_records_list($start_date,$end_date);
        
        $data['vehicles'] = $this->vehicle_model->get_all_records_list($table =
            'sa_vehicle', $array = array('sa_vehicle.rowID >' => 0, 'sa_vehicle.deleted' =>
                0), $join_table1 = 'sa_debtor', $join_criteria1 =
            'sa_vehicle.debtor_rowID=sa_debtor.rowID', 'sa_vehicle.police_no', 'desc');

        $this->template->set_layout('users')->build('vehicles', isset($data) ? $data : null);
    }
        
    function set_filter(){
       $this->session->set_userdata('start_date_vc',date("Y-m-d",strtotime($this->input->post('start_date'))));
       $this->session->set_userdata('end_date_vc',date("Y-m-d",strtotime($this->input->post('end_date'))));    
       
       redirect(base_url().'vehicle_condition');
    }

    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $hasil = $this->vehicle_condition_model->get_by_id($tabel = 'mo_vehicle_condition', $id);
        header('Content-type: application/json');
        echo json_encode($hasil);
        exit;
    }

    function get_history_condition()
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $hasil = $this->vehicle_condition_model->get_history_condition($this->input->post('vehicle_id'));
        header('Content-type: application/json');
        echo json_encode($hasil);
        exit;
    }

    function delete_data($id)
    {
        header('Content-Type: application/json');
        
        $params['user_rowID'] = $this->tank_auth->get_user_id();
        $params['module'] = 'Vehicle Condition';
        $params['module_field_id'] = $id;
        $params['activity'] = ucfirst('Delete a Vehicle Condition with ID ' . $id);
        $params['icon'] = 'fa-times';
        modules::run('activitylog/log', $params); //log activity
        
        $data = $this->vehicle_condition_model->delete_data($id);
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
                'condition' => $this->input->post('condition'),
                'estimasi' => date("Y-m-d",strtotime($this->input->post('estimasi'))),
                'note' => $this->input->post('note'),
                'user_created' => $this->session->userdata('user_id'),
                'date_created' => date("Y-m-d",strtotime($this->input->post('date_created'))),
                //'date_created' => date("Y-m-d")
            );
            $this->db->insert('mo_vehicle_condition', $data_vehicle);
            $vehicle_id = $this->db->insert_id();

            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Vehicle Condition';
            $params['module_field_id'] = $vehicle_id;
            $params['activity'] = ucfirst('Added a new Vehicle Condition ' . $this->input->post('vehicle_id'));
            $params['icon'] = 'fa-user';
            modules::run('activitylog/log', $params); //log activity
            
            echo json_encode(array("success" => true, 'msg' => lang('vehicle_condition_registered_successfully')));
            exit;
        } else { // edit Data

            $data_vehicle = array(
                'vehicle_id' => $this->input->post('vehicle_id'),
                'date_created' => date("Y-m-d",strtotime($this->input->post('date_created'))),
                'condition' => $this->input->post('condition'),
                'estimasi' => date("Y-m-d",strtotime($this->input->post('estimasi'))),
                'note' => $this->input->post('note'),
                'user_created' => $this->session->userdata('user_id'),
            );
            $this->db->where('rowID', $dataPost['rowID']);
            $this->db->update('mo_vehicle_condition', $data_vehicle);
            Header('Content-Type: application/json; charset=UTF8');
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Vehicle Condition';
            $params['module_field_id'] = $dataPost['rowID'];
            $params['activity'] = ucfirst('Updated a Vehicle Condition ' . $this->input->post('vehicle_id'));
            $params['icon'] = 'fa-edit';
            modules::run('activitylog/log', $params); //log activity
            
            echo json_encode(array("success" => true, 'msg' => lang('vehicle_condition_edited_successfully')));
            exit();
        }

    }
    
    function pdf()
    {
        
        if($this->session->userdata('start_date_vc') == '' && $this->session->userdata('end_date_vc') == ''){
            $start_date = date("Y-m-d",strtotime("yesterday"));
            $end_date = date("Y-m-d");
        }
        else{
            $start_date = $this->session->userdata('start_date_vc');
            $end_date = $this->session->userdata('end_date_vc');
        }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['periode'] = date("d F Y",strtotime($start_date)).' - '.date("d F Y",strtotime($end_date));
        
        $data['vehicle_conditions'] = $this->vehicle_condition_model->get_all_records_list($start_date,$end_date);
        
        $html = $this->load->view('vehicle_pdf', $data, true);
        $this->pdf_generator->generate($html, 'Vehicle Document',$orientation='Potrait');
    }
    
    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=vehicle_conditions.xls");
        
        if($this->session->userdata('start_date_vc') == '' && $this->session->userdata('end_date_vc') == ''){
            $start_date = date("Y-m-d",strtotime("yesterday"));
            $end_date = date("Y-m-d");
        }
        else{
            $start_date = $this->session->userdata('start_date_vc');
            $end_date = $this->session->userdata('end_date_vc');
        }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['periode'] = date("d F Y",strtotime($start_date)).' - '.date("d F Y",strtotime($end_date));
        
        $data['vehicle_conditions'] = $this->vehicle_condition_model->get_all_records_list($start_date,$end_date);

        $this->load->view("vehicle_pdf", $data);
    }
    
}

/* End of file contacts.php */
