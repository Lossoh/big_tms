<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Uom extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('uom_model');
        $this->load->library('pdf_generator');
        
    }
    
    function pdf()
    {
        $data['uom'] = $this->uom_model->get_all_records($table = 'sa_uom', $array =
            array('rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '',
            'uom_cd', 'asc');
        $html = $this->load->view('uom_pdf', $data, true);
        $this->pdf_generator->generate($html, 'UOM pdf',$orientation='Portrait');//Portrait
    }
    
    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=uom.xls");

        $data['uom'] = $this->uom_model->get_all_records($table = 'sa_uom', $array =
            array('rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '',
            'uom_cd', 'asc');
        $this->load->view("uom_pdf", $data);

    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('uoms') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('uoms');
        $this->session->set_userdata('page_header', 'master');
        $this->session->set_userdata('page_detail', 'uoms');
        $data['datatables'] = true;
        $data['form'] = true;
        $data['uoms'] = $this->uom_model->get_all_records($table = 'sa_uom', $array =
            array('rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '',
            'uom_cd', 'asc');
        $this->template->set_layout('users')->build('uoms', isset($data) ? $data : null);
    }

    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->uom_model->get_by_id($tabel = 'sa_uom', $id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }

    function delete_data($id)
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $data = $this->uom_model->delete_data($id);
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
                $uom_code = $this->db->get_where('sa_uom', array('uom_cd' =>$dataPost['uom_code']))->row_array();
                        
                if (empty($dataPost['rowID'])) {// add new
                    if (!empty($uom_code['uom_cd'])) {
                        echo json_encode(array("success" => false, 'msg' => lang('already_exist')));
                        exit();
                    } else {
                        
                        $uom = array(
                            'uom_cd' => strtoupper($dataPost['uom_code']),
                            'descs' => strtoupper($dataPost['uom_name']),
                            'user_created' => $this->session->userdata('user_id'),
                            'date_created' => date('Y-m-d'),
                            'time_created' => date('H:i:s'));
                        $this->db->insert('sa_uom', $uom);
                        $uom_id = $this->db->insert_id();
    
                        $params['user_rowID'] = $this->tank_auth->get_user_id();
                        $params['module'] = 'uoms';
                        $params['module_field_id'] = $uom_id;
                        $params['activity'] = ucfirst('Added a new Unit of Measure ' . $dataPost['uom_name']);
                        $params['icon'] = 'fa-user';
                        modules::run('activitylog/log', $params); //log activity
                        echo json_encode(array("success" => true, 'msg' => lang('uom_registered_successfully')));
                        exit;
                    }
                    
                } else { //edit Data
                    $uom = array(
                        'uom_cd' => strtoupper($dataPost['uom_code']),
                        'descs' => strtoupper($dataPost['uom_name']),
                        'user_created' => $this->session->userdata('user_id'),
                        'date_created' => date('Y-m-d'),
                        'time_created' => date('H:i:s'));
                        
                    $this->db->where('rowID', $dataPost['rowID']);
                    $this->db->update('sa_uom', $uom);
                    Header('Content-Type: application/json; charset=UTF8');
                    echo json_encode(array("success" => true, 'msg' => lang('uom_edited_successfully')));
                    exit();


                }
            
    }

}

/* End of file contacts.php */
