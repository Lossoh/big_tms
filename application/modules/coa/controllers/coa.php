<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Coa extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('tank_auth');
        
        $this->load->model('coa_model');
        $this->load->library('pdf_generator');
    }
    
    function pdf()
    {
        //$data['coa'] = $this->coa_model->get_all_records($table = 'gl_coa', $array =
//            array('rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '',
//            'acc_cd', 'asc');
        $data['coa'] = $this->coa_model->get_all_record_data();
            
        $html = $this->load->view('coa_pdf', $data, true);
        $this->pdf_generator->generate($html, 'Coa pdf',$orientation='Portrait');
    }
    
    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=COA.xls");

//        $data['coa'] =  $this->coa_model->get_all_records($table = 'gl_coa', $array =
//            array('rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '',
//            'acc_cd', 'asc');
        $data['coa'] = $this->coa_model->get_all_record_data();
            
        $this->load->view("coa_pdf", $data);

    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('coas') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('coas');
        $this->session->set_userdata('page_header', 'master');
        $this->session->set_userdata('page_detail', 'coas');
        $data['datatables'] = true;
        $data['form'] = true;
        //$data['coas'] = $this->coa_model->get_all_records($table = 'gl_coa', $array =
        //    array('rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '',
        //    'acc_cd', 'asc');
        $data['coas'] = $this->coa_model->get_all_record_data();

        //$data['coa_sub_account'] = $this->get_coa_sub();
        $this->template->set_layout('users')->build('coas', isset($data) ? $data : null);
    }

    function get_coa_level_before()
    {
        $coa_level = $this->input->post('coa_level');
        $data = array('coa_lists' => $this->coa_model->get_all_record_coa($coa_level), );
        //echo"<pre/>";print_r($data);die();
        //$this->load->view('ajax_coa_sub',isset($data) ? $data : NULL);
        $this->load->view('ajax_coa_sub', $data);
    }


    function get_coa_sub2()
    {

        $coa_level = $this->input->post('coa_level');
        $coa_class = $this->input->post('coa_class');
        $coa_type = $this->input->post('coa_type');

        $data = array();
        $hasil = $this->db->query("SELECT rowID,acc_cd,acc_name FROM gl_coa  WHERE  acc_level = '$level_coa' and acc_class='$coa_class' and acc_type='$coa_type'  AND deleted=0");

        if ($hasil->num_rows() > 0) {
            $data = $hasil->result();
        }

        $hasil->free_result();

        return $data;
    }

    function get_coa_sub()
    {
        error_reporting(E_ALL);
        $coa_level = $this->input->post('coa_level');
        $coa_class = $this->input->post('coa_class');
        $coa_type = $this->input->post('coa_type');



        $coa_data = $this->db->query("SELECT rowID,acc_cd,acc_name FROM gl_coa
           WHERE  acc_level = '$coa_level' and acc_class='$coa_class' and acc_type='H'  AND deleted=0");

        if (!empty($coa_data)) {
            header('Content-Type: application/json');
            $arr = array();
            foreach ($coa_data->result_array() as $rs) {

                $arr[] = array(
                    'rowID' => $rs['rowID'],
                    'acc_cd' => $rs['acc_cd'],
                    'acc_name' => $rs['acc_name']);
            }
            header('Content-type: application/json');
            echo json_encode($arr);
        }

        exit;

    }
    
   	function get_data_edit($id)
	{
	    error_reporting(E_ALL);
        header('Content-Type: application/json');
		$hasil = $this->coa_model->get_by_id($tabel='gl_coa',$id);
        header('Content-type: application/json');
        echo json_encode($hasil);
		exit;
	}
    
    function delete_data($id){
        header('Content-Type: application/json');
	    $data = $this->coa_model->delete_data($tabel = 'gl_coa',$id);
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
        $coa_code = $this->db->get_where('gl_coa', array('acc_cd' => $dataPost['coa_code'], 'deleted' => 0))->
            row_array();
        if (empty($dataPost['rowID'])) {
            if (!empty($coa_code['acc_cd'])) {
                echo json_encode(array("success" => false, 'msg' => lang('already_exist')));
                exit();
            } else {
                $coa_data = array(
                'acc_cd' => strtoupper($dataPost['coa_code']),
                'acc_name' => strtoupper($dataPost['coa_name']),
                'acc_type' => strtoupper($dataPost['coa_type']),
                'acc_debit_credit' => $dataPost['acc_debit_credit'],
                'acc_level' => $dataPost['coa_level'],
                'acc_sub_of_rowID' => $dataPost['coa_subof_account'],
                'acc_class' => $dataPost['coa_class'],
                'cash_branch' => $dataPost['cash_branch'],
                'is_cash' => $dataPost['coa_c'],
                'is_bank' => $dataPost['coa_b'],
                'is_vat_in' => $dataPost['coa_vatin'],
                'is_vat_out' => strtoupper($dataPost['coa_vatout']),
                'active' => strtoupper($dataPost['coa_active']),
                'user_created' => $this->session->userdata('user_id'),
                'date_created' => date('Y-m-d'),
                'time_created' => date('H:i:s'));
                $this->db->insert('gl_coa', $coa_data);
                $coa_id = $this->db->insert_id();

                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'coas';
                $params['module_field_id'] = $coa_id;
                $params['activity'] = ucfirst('Added a new Chart of Account ' . $this->input->
                    post('coa_name'));
                $params['icon'] = 'fa-user';
                modules::run('activitylog/log', $params); //log activity
                echo json_encode(array("success" => true, 'msg' => lang('coa_registered_successfully')));
                exit;
                
            }
            
        } else {
            $coa_data = array(
                'acc_cd' => strtoupper($dataPost['coa_code']),
                'acc_name' => strtoupper($dataPost['coa_name']),
                'acc_type' => strtoupper($dataPost['coa_type']),
                'acc_debit_credit' => $dataPost['acc_debit_credit'],
                'acc_level' => $dataPost['coa_level'],
                'acc_sub_of_rowID' => $dataPost['coa_subof_account'],
                'acc_class' => $dataPost['coa_class'],
                'cash_branch' => $dataPost['cash_branch'],
                'is_cash' => $dataPost['coa_c'],
                'is_bank' => $dataPost['coa_b'],
                'is_vat_in' => $dataPost['coa_vatin'],
                'is_vat_out' => strtoupper($dataPost['coa_vatout']),
                'active' => strtoupper($dataPost['coa_active']),
                'user_modified' => $this->session->userdata('user_id'),
                'date_modified' => date('Y-m-d'),
                'time_modified' => date('H:i:s'));
            $this->db->where('rowID',$dataPost['rowID']);
            $this->db->update('gl_coa', $coa_data);
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('coa_edited_successfully')));
            exit();

        }
    }


    function create2()
    {
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<span style="color:red">',
                '</span><br>');
            $this->form_validation->set_rules('coa_type', 'Coa Type', 'required|xss_clean');
            $this->form_validation->set_rules('coa_code', 'Coa Code',
                'required|xss_clean|is_unique[gl_coa.acc_cd]');
            $this->form_validation->set_rules('coa_name', 'Coa Name',
                'required|xss_clean|max_length[40]');
            $this->form_validation->set_rules('coa_class', 'Coa Class', 'required|xss_clean');
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('response_status', 'error');
                $this->session->set_flashdata('message', lang('error_in_form'));
                $_POST = '';
                $this->index();
            } else {
                $coa_data = array(
                    'acc_type' => strtoupper($this->input->post('coa_type')),
                    'acc_cd' => strtoupper($this->input->post('coa_code')),
                    'acc_name' => strtoupper($this->input->post('coa_name')),
                    'acc_level' => $this->input->post('coa_level'),
                    'acc_transition' => $this->input->post('coa_transition'),
                    'acc_sub_of_rowID' => $this->input->post('coa_subof_account'),
                    'acc_class' => $this->input->post('coa_class'),
                    'cash_branch' => $dataPost['cash_branch'],
                    'is_cash' => $this->input->post('coa_c'),
                    'is_bank' => $this->input->post('coa_b'),
                    'is_vat_in' => $this->input->post('coa_vatin'),
                    'is_vat_out' => strtoupper($this->input->post('coa_vatout')),
                    'active' => strtoupper($this->input->post('coa_active')),
                    'user_created' => $this->session->userdata('user_id'),
                    'date_created' => date('Y-m-d'),
                    'time_created' => date('H:i:s'));
                // $this->coa_model->save($tabel='',$coa_data);
                $this->db->insert('gl_coa', $coa_data);
                $coa_id = $this->db->insert_id();

                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'coas';
                $params['module_field_id'] = $coa_id;
                $params['activity'] = ucfirst('Added a new Chart of Account ' . $this->input->
                    post('coa_name'));
                $params['icon'] = 'fa-user';
                modules::run('activitylog/log', $params); //log activity

                $this->session->set_flashdata('response_status', 'success');
                $this->session->set_flashdata('message', lang('coa_registered_successfully'));
                redirect('coa');
            }
        } else {
            $this->session->set_flashdata('response_status', 'error');
            $this->session->set_flashdata('message', lang('error_in_form'));
            redirect('coa');
        }
    }


}

/* End of file contacts.php */
