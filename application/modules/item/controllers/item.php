<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Item extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('item_model');
        $this->load->library('pdf_generator');
    }
    
    function pdf()
    {
        $data['item'] = $this->item_model->get_pdf();
        $html = $this->load->view('item_pdf', $data, true);
        $this->pdf_generator->generate($html, 'item pdf',$orientation='Portrait');
    }
    
    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=cargo.xls");

        $data['item'] = $this->item_model->get_pdf();
        $this->load->view("item_pdf", $data);

    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('items') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('items');
        $this->session->set_userdata('page_header', 'master');
        $this->session->set_userdata('page_detail', 'items');
        $data['datatables'] = true;
        $data['form'] = true;
        //$data['items'] = $this->item_model->get_all_records($table = 'sa_item', $array = array(
        //	'sa_item.rowID >' => 0, 'sa_item.deleted' => 0), $join_table = 'sa_uom', $join_criteria = 'sa_item.uom_rowID=sa_uom.rowID','sa_item.rowID','asc');

        $data['items'] = $this->item_model->get_all_records();

        $data['uoms'] = $this->item_model->get_all_records_item($table = 'sa_uom', $array =
            array('rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '',
            'uom_cd', 'asc');
        $this->template->set_layout('users')->build('items', isset($data) ? $data : null);
    }

    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->item_model->get_by_id($tabel = 'sa_item', $id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }

    function delete_data($id)
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $data = $this->item_model->delete_data($id);
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
        $item_code = $this->db->get_where('sa_item', array('item_cd' =>$dataPost['item_code']))->row_array();
                        
        if (empty($dataPost['rowID'])) {// add new
            if (!empty($item_code['item_cd'])) {
                echo json_encode(array("success" => false, 'msg' => lang('already_exist')));
                exit();
            } else {
               $item = array(
                    'uom_rowID' => $dataPost['uom_id'],
                    'item_cd' => $dataPost['item_code'],
                    'item_name' => strtoupper($dataPost['item_name']),
                    'minimum' => str_replace('.','',$dataPost['minimum']),
                    'maximum' => str_replace('.','',$dataPost['maximum']),
                    'user_created' => $this->session->userdata('user_id'),
                    'date_created' => date('Y-m-d'),
                    'time_created' => date('H:i:s'));

                $this->db->insert('sa_item', $item);
                $item_id = $this->db->insert_id();
    
                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'items';
                $params['module_field_id'] = $item_id;
                $params['activity'] = ucfirst('Added a new Item ' . $this->input->post('item_name'));
                $params['icon'] = 'fa-user';
                modules::run('activitylog/log', $params); //log activity
                echo json_encode(array("success" => true, 'msg' => lang('item_registered_successfully')));
                exit;
            }
        } else { // edit Data
            $item = array(
                'uom_rowID' => $dataPost['uom_id'],
                'item_cd' => $dataPost['item_code'],
                'item_name' => strtoupper($dataPost['item_name']),
                'minimum' => str_replace('.','',$dataPost['minimum']),
                'maximum' => str_replace('.','',$dataPost['maximum']),
                'user_created' => $this->session->userdata('user_id'),
                'date_created' => date('Y-m-d'),
                'time_created' => date('H:i:s'));
            $this->db->where('rowID', $dataPost['rowID']);
            $this->db->update('sa_item', $item);
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('item_edited_successfully')));
            exit();

        }

    }

    function delete()
    {
        if ($this->input->post()) {

            $year = $this->input->post('year');
            $month = $this->input->post('month');
            $code = $this->input->post('code');
            $job_order_data = array(
                'deleted' => 1,
                'user_deleted' => $this->session->userdata('user_id'),
                'date_deleted' => date('Y-m-d'),
                'time_deleted' => date('H:i:s'));

            $this->db->where('year', $year);
            $this->db->where('month', $month);
            $this->db->where('code', $code);
            $this->db->update('tr_jo_trx_hdr', $job_order_data);

            $this->session->set_flashdata('response_status', 'success');
            $this->session->set_flashdata('message', lang('job_order_deleted_successfully'));
            redirect('job_order');
        } else {

            $data['job_order_details'] = $this->job_order->get_all_records_update($this->
                uri->segment(4), $this->uri->segment(5), $this->uri->segment(6));

            $this->load->view('modal/delete_container', $data);

        }
    }

}

/* End of file contacts.php */
