<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Menu extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('menu_model');
    }
    
    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('menus') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('menus');
        $this->session->set_userdata('page_header', 'master');
        $this->session->set_userdata('page_detail', 'menus');
        $data['datatables'] = true;
        $data['form'] = true;
        //$data['items'] = $this->menu_model->get_all_records($table = 'sa_item', $array = array(
        //	'sa_item.rowID >' => 0, 'sa_item.deleted' => 0), $join_table = 'sa_uom', $join_criteria = 'sa_item.uom_rowID=sa_uom.rowID','sa_item.rowID','asc');

        $data['menus'] = $this->menu_model->get_all_records();
        $data['menu_id'] = count($this->menu_model->get_all_records()) + 1;

        $data['parent_menus'] = $this->menu_model->get_all_records_menu($table = 'sa_menu', $array =
            array('parentID =' => 0, 'status =' => '1'), $join_table = '', $join_criteria = '',
            'Nm_Menu', 'asc');
        $this->template->set_layout('users')->build('menus', isset($data) ? $data : null);
    }

    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->menu_model->get_by_id($tabel = 'sa_menu', $id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }

    function delete_data($id)
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $data = $this->menu_model->delete_data($id);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }

    function update_data()
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $menu = array(
            'kd_menu' => $this->input->post('kd_menu')
        );
        $this->db->where('seq_menu', $this->input->post('seq_menu'));
        $this->db->update('sa_menu', $menu);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode(array("success" => true, 'msg' => lang('menu_edited_successfully')));
        exit();
    }

    function create()
    {
        $dataPost = $this->input->post();
        //echo "<pre>"; print_r($dataPost); echo "</pre>"; exit();
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
       
        if (empty($dataPost['seq_menu'])) {// add new
          
           if(empty($dataPost['status']))
                $status = '0';
           else
                $status = '1';
                
           $menu = array(
                'kd_menu' => $dataPost['kd_menu'],
                'nm_menu' => ucwords($dataPost['nm_menu']),
                'link_menu' => $dataPost['link_menu'],
                'lang' => strtolower($dataPost['lang']),
                'parentid' => $dataPost['parentid'],
                'status' => $status
           );

            $this->db->insert('sa_menu', $menu);
            $menu_id = $this->db->insert_id();
            
            // Logs
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'menus';
            $params['module_field_id'] = $menu_id;
            $params['activity'] = ucfirst('Added a new Menu ' . ucwords($this->input->post('nm_menu')));
            $params['icon'] = 'fa-user';
            modules::run('activitylog/log', $params); //log activity
            echo json_encode(array("success" => true, 'msg' => lang('menu_registered_successfully')));
            exit;
            
        } else { // edit Data
             
            if(empty($dataPost['status']))
                $status = '0';
            else
                $status = '1';
                    
            $menu = array(
                    'kd_menu' => $dataPost['kd_menu'],
                    'nm_menu' => ucwords($dataPost['nm_menu']),
                    'link_menu' => $dataPost['link_menu'],
                    'lang' => strtolower($dataPost['lang']),
                    'parentid' => $dataPost['parentid'],
                    'status' => $status
               );
            $this->db->where('seq_menu', $dataPost['seq_menu']);
            $this->db->update('sa_menu', $menu);
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('menu_edited_successfully')));
            exit();

        }

    }

}

/* End of file menu.php */
