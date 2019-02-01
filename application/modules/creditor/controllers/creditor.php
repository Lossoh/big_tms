<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Creditor extends MX_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('creditor_model');
        $this->load->library('pdf_generator');

    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('creditors') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('creditors');
        $this->session->set_userdata('page_header', 'master');
        $this->session->set_userdata('page_detail', 'creditors');
        $data['datatables'] = true;
        $data['form'] = true;
        $data['creditors'] = $this->creditor_model->get_all_records($table = 'sa_creditor', $array =
            array('rowID >' => '0', 'deleted' => '0'), $join_table = '', $join_criteria = '',
            'creditor_cd,creditor_name', 'desc');
        $data['creditor_types'] = $this->creditor_model->get_all_records($table =
            'sa_creditor_type', $array = array('rowID >' => '0', 'deleted' => '0'), $join_table =
            '', $join_criteria = '', 'type_cd', 'asc');
            
        $this->template->set_layout('users')->build('creditors', isset($data) ? $data : null);
    }
    
    function pdf()
    {
        $data['creditors'] =$this->creditor_model->get_all_records($table = 'sa_creditor', $array =
            array('rowID >' => '0', 'deleted' => '0'), $join_table = '', $join_criteria = '',
            'creditor_cd,creditor_name', 'desc');
            
        $html = $this->load->view('creditor_pdf', $data, true);
        $this->pdf_generator->generate($html, 'Creditor pdf',$orientation='landscape');//Portrait
    }
    
    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=creditor.xls");

        $data['creditors'] = $this->creditor_model->get_all_records($table = 'sa_creditor', $array =
            array('rowID >' => '0', 'deleted' => '0'), $join_table = '', $join_criteria = '',
            'creditor_cd,creditor_name', 'desc');
            
        $this->load->view("creditor_excel", $data);

    }

    function create()
    {
        $dataPost = $this->input->post();
        //echo "<pre>"; print_r($dataPost); echo "</pre>"; exit();
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');

        $year = date('Y');
        $hasil = ((int)$this->AppModel->select_max_id('sa_creditor', $array = array('deleted' =>
                0), 'code')) + 1;
        $code = sprintf("%04s", $hasil);
        $creditor_code = sprintf("%04s", $hasil);
        

        if (empty($dataPost['rowID'])) {
            $creditor_data = array(
                'code' => $code,
                'year' => $year,
                'creditor_cd' => $creditor_code,
                'creditor_name' => strtoupper($dataPost['creditor_name']),
                'category' => $dataPost['creditor_category'],
                'supplier_type' => $dataPost['supplier_type'],
                'id_type' => strtoupper($dataPost['creditor_id_type']),
                'id_no' => strtoupper($dataPost['creditor_id_number']),
                'address1' => ucwords($dataPost['creditor_address1']),
                'address2' => ucwords($dataPost['creditor_address2']),
                'address3' => ucwords($dataPost['creditor_address3']),
                'post_cd' => $dataPost['creditor_postal_code'],
                'hp_no1' => $dataPost['creditor_hp1'],
                'hp_no2' => $dataPost['creditor_hp2'],
                'telp_no1' => $dataPost['creditor_phone1'],
                'telp_no2' => $dataPost['creditor_phone2'],
                'fax_no1' => $dataPost['creditor_fax1'],
                'fax_no2' => $dataPost['creditor_fax2'],
                'contact_prs' => $dataPost['creditor_contact'],
                'website' => $dataPost['creditor_website'],
                'email' => $dataPost['creditor_email'],
                'sex' => $dataPost['creditor_gender'],
                'pob' => ucwords($dataPost['creditor_pob']),
                'dob' => date('Y-m-d',strtotime($dataPost['creditor_dob'])),
                'npwp_no' => $dataPost['creditor_npwp'],
                'npwp_name' => $dataPost['creditor_name_npwp'],
                'reg_date' => date('Y-m-d',strtotime($dataPost['creditor_npwp_registered'])),
                'npwp_address1' => ucwords($dataPost['creditor_npwp_address1']),
                'npwp_address2' => ucwords($dataPost['creditor_npwp_address2']),
                'npwp_address3' => ucwords($dataPost['creditor_npwp_address3']),
                'bank_acc1' => $dataPost['creditor_bank_account_no1'],
                'bank_acc_name1' => ucwords($dataPost['creditor_bank_account_name1']),
                'bank_name1' => ucwords($dataPost['creditor_bank_account_name1']),
                'bank_acc2' => ucwords($dataPost['creditor_bank_account_no2']),
                'bank_acc_name2' => ucwords($dataPost['creditor_bank_account_name2']),
                'bank_name2' => ucwords($dataPost['creditor_bank_account_name2']),
                'creditor_type_rowID' => $dataPost['creditor_type'],
                'user_created' => $this->session->userdata('user_id'),
                'date_created' => date('Y-m-d'),
                'time_created' => date('H:i:s'));

            $result=$this->db->insert('sa_creditor', $creditor_data);
            $creditor_id = $this->db->insert_id();

            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Creditor';
            $params['module_field_id'] = $creditor_id;
            $params['activity'] = ucfirst('Added a new Creditor ' . strtoupper($dataPost['creditor_name']));
            $params['icon'] = 'fa-user';
            modules::run('activitylog/log', $params); //log activity
            Header('Content-Type: application/json; charset=UTF8');
            
            echo json_encode(array("success" => true, 'msg' => lang('creditor_registered_successfully')));
            exit();
            
            
            
        } else {
            $creditor_data = array(
                'creditor_name' => strtoupper($dataPost['creditor_name']),
                'category' => $dataPost['creditor_category'],
                'supplier_type' => $dataPost['supplier_type'],
                'id_type' => strtoupper($dataPost['creditor_id_type']),
                'id_no' => strtoupper($dataPost['creditor_id_number']),
                'address1' => ucwords($dataPost['creditor_address1']),
                'address2' => ucwords($dataPost['creditor_address2']),
                'address3' => ucwords($dataPost['creditor_address3']),
                'post_cd' => $dataPost['creditor_postal_code'],
                'hp_no1' => $dataPost['creditor_hp1'],
                'hp_no2' => $dataPost['creditor_hp2'],
                'telp_no1' => $dataPost['creditor_phone1'],
                'telp_no2' => $dataPost['creditor_phone2'],
                'fax_no1' => $dataPost['creditor_fax1'],
                'fax_no2' => $dataPost['creditor_fax2'],
                'contact_prs' => $dataPost['creditor_contact'],
                'website' => $dataPost['creditor_website'],
                'email' => $dataPost['creditor_email'],
                'sex' => $dataPost['creditor_gender'],
                'pob' => ucwords($dataPost['creditor_pob']),
                'dob' => date('Y-m-d',strtotime($dataPost['creditor_dob'])),
                'npwp_no' => $dataPost['creditor_npwp'],
                'npwp_name' => $dataPost['creditor_name_npwp'],
                'reg_date' => date('Y-m-d',strtotime($dataPost['creditor_npwp_registered'])),                
                'npwp_address1' => ucwords($dataPost['creditor_npwp_address1']),
                'npwp_address2' => ucwords($dataPost['creditor_npwp_address2']),
                'npwp_address3' => ucwords($dataPost['creditor_npwp_address3']),
                'bank_acc1' => $dataPost['creditor_bank_account_no1'],
                'bank_acc_name1' => ucwords($dataPost['creditor_bank_account_name1']),
                'bank_name1' => ucwords($dataPost['creditor_bank_account_name1']),
                'bank_acc2' => ucwords($dataPost['creditor_bank_account_no2']),
                'bank_acc_name2' => ucwords($dataPost['creditor_bank_account_name2']),
                'bank_name2' => ucwords($dataPost['creditor_bank_account_name2']),
                'creditor_type_rowID' => $dataPost['creditor_type'],
                'user_modified' => $this->session->userdata('user_id'),
                'date_modified' => date('Y-m-d'),
                'time_modified' => date('H:i:s'));
                
            $this->db->where('rowID', $dataPost['rowID']);
            $this->db->update('sa_creditor', $creditor_data);
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('creditor_edited_successfully')));
            exit();

        }


    }
    
    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->creditor_model->get_by_id($tabel = 'sa_creditor', $id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function delete_data($id)
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $data = $this->creditor_model->delete_data($tabel='sa_creditor',$id);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
    
    function get_creditor_dtl()
    {
        error_reporting(E_ALL);
        $creditor_rowID = $this->input->post('creditor_rowID');
        $creditor_dtls = $this->creditor_model->get_all_records($table = 'sa_creditor', $array =
            array(
            'type =' => 'C',
            'rowID' => $creditor_rowID,
            'deleted' => '0'), $join_table = '', $join_criteria = '', 'rowID', 'ASC');

        if (!empty($creditor_dtls)) {
            header('Content-Type: application/json');
            foreach ($creditor_dtls as $creditor_dtl) {
                $arr = array('creditor_name' => $creditor_dtl->creditor_name, 'creditor_rowID' => $creditor_dtl->
                        rowID);
            }
            header('Content-type: application/json');
            echo json_encode($arr);
        }

        exit; // no need to render the template
    }

    function get_creditor_type2()
    {
        error_reporting(E_ALL);
        $creditor_cd = $this->input->post('creditor_cd');

        $creditor_type_data = $this->creditor_model->get_all_records($table =
            'sa_creditor_type', $array = array('rowID' => $creditor_cd, 'deleted' => '0'), $join_table =
            '', $join_criteria = '', 'rowID', 'ASC');

        if (!empty($creditor_type_data)) {
            header('Content-Type: application/json');
            foreach ($creditor_type_data as $creditor_type) {
                $arr = array(
                    'type_cd' => $creditor_type->type_cd,
                    'name' => $creditor_type->descs,
                    'rowID' => $creditor_type->rowID,
                    'category' => ''//$creditor_type->category
                );
            }
            header('Content-type: application/json');
            echo json_encode($arr);
        }

        exit;

    }

    function get_creditor_type()
    {
        $creditor_cd = $this->input->post('creditor_cd');
        $data = array('creditor_lists' => $this->creditor_model->get_all_record_creditor($creditor_cd));
        $this->load->view('ajax_creditor_type', $data);
    }

    function create_creditor()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $data['datatables'] = true;
        $data['form'] = true;

        $data['creditors'] = $this->creditor_model->get_all_records($table =
            'sa_creditor_type', $array = array('rowID >' => '0', 'deleted' => '0'), $join_table =
            '', $join_criteria = '', 'rowID', 'desc');


        $this->template->set_layout('users')->build('create_creditor', isset($data) ? $data : null);

    }
    
}

/* End of file contacts.php */
