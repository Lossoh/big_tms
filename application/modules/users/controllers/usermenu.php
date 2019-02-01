<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Usermenu extends MX_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('usermenu_model');
        $this->load->model('user_model');
        $this->load->model('menu/menu_model');
        
    }
    
    function setting($user_id)
    {
        if(empty($user_id)){
            redirect(base_url().'users/account');
        }
        else{
            $cek_user = $this->user_model->users_by_id($user_id);
            if(count($cek_user) == 0){
                redirect(base_url().'users/account');
            }
        }
        
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('usermenus') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('usermenus');
        $this->session->set_userdata('page_header', 'master');
        $this->session->set_userdata('page_detail', 'users');
        $data['datatables'] = true;
        $data['form'] = true;
        
        $data['fullname'] = $cek_user->fullname;
        $data['user_id'] = $user_id;
        $data['usermenus'] = $this->usermenu_model->get_all_usermenu_by_user($user_id);
        $data['menus'] = $this->usermenu_model->get_all_menu();
        
        $this->template->set_layout('users')->build('usermenus', isset($data) ? $data : null);
    }

    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->usermenu_model->get_by_id($tabel = 'sa_usermenu', $id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }

    function delete_data($id)
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $get_usermenu = $this->db->get_where('sa_usermenu', array('rowID' =>$id))->row_array();
        $data = $this->usermenu_model->delete_data($id);
        header('Content-Type: application/json');
        echo json_encode(array('user_id' => $get_usermenu['user_rowID']));
        exit();
    }


    function create()
    {
        $dataPost = $this->input->post();
        //echo "<pre>"; print_r($dataPost); echo "</pre>"; exit();
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $usermenu_code = $this->db->get_where('sa_usermenu', array('user_rowid' =>$dataPost['user_id'], 'kd_menu' =>$dataPost['kd_menu']))->row_array();
                        
        if (empty($dataPost['rowID'])) {// add new
            if (!empty($usermenu_code['Kd_Menu'])) {
                echo json_encode(array("success" => false, 'msg' => lang('already_menu_exist')));
                exit();
            } else {
                if(empty($dataPost['status']))
                    $status = '0';
                else
                    $status = '1';
                    
               $usermenu = array(
                    'company_rowID' => $this->session->userdata('company_rowID'),
                    'dep_rowID' => $this->session->userdata('dep_rowID'),
                    'user_rowID' => $dataPost['user_id'],
                    'kd_menu' => $dataPost['kd_menu'],
                    'availabled' => $dataPost['availabled'],
                    'created' => $dataPost['created'],
                    'viewed' => $dataPost['viewed'],
                    'updated' => $dataPost['updated'],
                    'deleted' => $dataPost['deleted'],
                    'approved' => $dataPost['approved'],
                    'verified' => $dataPost['verified'],
                    'verified_second' => $dataPost['verified_second'],
                    'fullaccess' => $dataPost['fullaccess'],
                    'printlimited' => $dataPost['printlimited'],
                    'printunlimited' => $dataPost['printunlimited'],
                    'statususermenu' => $status
               );

                $this->db->insert('sa_usermenu', $usermenu);
                $usermenu_id = $this->db->insert_id();
                
                // Logs
                $get_menu = $this->db->get_where('sa_menu', array('seq_menu' =>$dataPost['kd_menu']))->row_array();
                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'users';
                $params['module_field_id'] = $usermenu_id;
                $params['activity'] = ucfirst('Added a new User Menu ' . ucwords($get_menu['Nm_Menu']));
                $params['icon'] = 'fa-user';
                modules::run('activitylog/log', $params); //log activity
                echo json_encode(array("success" => true, 'msg' => lang('usermenu_registered_successfully'), 'user_id' => $dataPost['user_id']));
                exit;
            }
        } else { // edit Data
            if (!empty($usermenu_code['Kd_Menu'])) {
                if($dataPost['kd_menu_tmp'] != $dataPost['kd_menu']){
                    echo json_encode(array("success" => false, 'msg' => lang('already_menu_exist')));
                    exit();
                }
            } 
            
            if(empty($dataPost['status']))
                $status = '0';
            else
                $status = '1';
                
            $usermenu = array(
                    'kd_menu' => $dataPost['kd_menu'],
                    'availabled' => $dataPost['availabled'],
                    'created' => $dataPost['created'],
                    'viewed' => $dataPost['viewed'],
                    'updated' => $dataPost['updated'],
                    'deleted' => $dataPost['deleted'],
                    'approved' => $dataPost['approved'],
                    'verified' => $dataPost['verified'],
                    'verified_second' => $dataPost['verified_second'],
                    'fullaccess' => $dataPost['fullaccess'],
                    'printlimited' => $dataPost['printlimited'],
                    'printunlimited' => $dataPost['printunlimited'],
                    'statususermenu' => $status
               );
            $this->db->where('rowID', $dataPost['rowID']);
            $this->db->update('sa_usermenu', $usermenu);
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('usermenu_edited_successfully'), 'user_id' => $dataPost['user_id']));
            exit();
            
        }

    }

}

/* End of file menu.php */
