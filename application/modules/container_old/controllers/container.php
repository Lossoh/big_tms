<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Container extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('container_model');
        $this->load->model('appmodel');
        $this->load->library('pdf_generator');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('containers') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('containers');
        $this->session->set_userdata('page_header', 'transaction');
        $this->session->set_userdata('page_detail', 'container');
        $data['datatables'] = true;
        $data['form'] = true;
        
        if($this->session->userdata('start_date') == '' && $this->session->userdata('end_date') == ''){
            $start_date = date("Y-m-d");
            $end_date = date("Y-m-d");
        }
        else{
            $start_date = $this->session->userdata('start_date');
            $end_date = $this->session->userdata('end_date');
        }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;

        $data['job_orders'] = $this->container_model->get_all_records_list($start_date,$end_date);
        
        $this->template->set_layout('users')->build('containers', isset($data) ? $data : null);
    }    
    
    function set_filter(){
       $this->session->set_userdata('start_date',date("Y-m-d",strtotime($this->input->post('start_date'))));
       $this->session->set_userdata('end_date',date("Y-m-d",strtotime($this->input->post('end_date'))));    
       
       redirect(base_url().'container');
    }

    function get_data_detail()
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $jo_no = $this->input->post('jo_no');
        $type = $this->input->post('type');
        
        $hasil = $this->container_model->get_data_detail_by_jo_no_type($jo_no,$type);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }

    function delete_data($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $error = false;
        $this->db->trans_begin();
        
        $get_data = $this->container_model->get_by_id('tr_container_trx', $id);
        
        $result = $this->container_model->delete_data('tr_container_trx', $id);
        if(!$result){
            $error = true;                
        }
        
        Header('Content-Type: application/json; charset=UTF8');
        $status = $this->db->trans_status();
        if ($status === false || $error == true){
            $this->db->trans_rollback();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
			$params['module'] = 'ERROR ROLLBACK Invoice';
			$params['module_field_id'] = $id;
			$params['activity'] = ucfirst('Deleted a Container No '.$get_data->container_no.' with JO No '.$get_data->jo_no);
			$params['icon'] = 'fa-exclamation-triangle';
			modules::run('activitylog/log',$params);
            
            echo json_encode(array('success' => false, 'msg' => "Failed Data RollBack"));
            exit();
        }
        else{
            $this->db->trans_commit();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Container';
            $params['module_field_id'] = $id;
            $params['activity'] = ucfirst('Deleted a Container No '.$get_data->container_no.' with JO No ' . $get_data->jo_no);
            $params['icon'] = 'fa-times';
            modules::run('activitylog/log', $params); //log activity

            echo json_encode(array("success" => true, 'msg' => lang('deleted_succesfully')));
            exit();
        }
        
    }

    function create()
    {
        $dataPost = $this->input->post();
        //echo "<pre>"; print_r($dataPost); echo "</pre>"; exit();
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $error = false;
        $result = true;
        $this->db->trans_begin();
        
        $jo_no = $dataPost['jo_no'];
        if (empty($dataPost['edit'])) {
            if(empty($dataPost['container_no_20ft'])){
                $countDetail20ft = 0;                
            }
            else{
                $countDetail20ft = count($dataPost['container_no_20ft']);
                $container_no_20ft = $dataPost['container_no_20ft'];
                $seal_no_20ft = $dataPost['seal_no_20ft'];
                $replacement_seal_no_20ft = $dataPost['replacement_seal_no_20ft'];
            }

            if(empty($dataPost['container_no_40ft'])){
                $countDetail40ft = 0;                
            }
            else{
                $countDetail40ft = count($dataPost['container_no_40ft']);
                $container_no_40ft = $dataPost['container_no_40ft'];
                $seal_no_40ft = $dataPost['seal_no_40ft'];
                $replacement_seal_no_40ft = $dataPost['replacement_seal_no_40ft'];
            }
            
            if(empty($dataPost['container_no_45ft'])){
                $countDetail45ft = 0;                
            }
            else{
                $countDetail45ft = count($dataPost['container_no_45ft']);
                $container_no_45ft = $dataPost['container_no_45ft'];
                $seal_no_45ft = $dataPost['seal_no_45ft'];
                $replacement_seal_no_45ft = $dataPost['replacement_seal_no_45ft'];
            }
            
            if ($result){
                for($i=0;$i<$countDetail20ft;$i++){
                    $data_container20ft = array(
                        'jo_no' => $jo_no,
                        'container_type' => '20ft',
                        'container_no' => $container_no_20ft[$i],
                        'seal_no' => $seal_no_20ft[$i],
                        'replacement_seal_no' => $replacement_seal_no_20ft[$i],
                        'user_created' => $this->session->userdata('user_id'),
                        'date_created' => date('Y-m-d'),
                        'time_created' => date('H:i:s')
                    );
                    
                    $result = $this->db->insert('tr_container_trx', $data_container20ft);
                    if (!$result){
                        $error = true;
                        break;
                    }
                                   
                }
            }
            
            if ($result){
                for($i=0;$i<$countDetail40ft;$i++){
                    $data_container40ft = array(
                        'jo_no' => $jo_no,
                        'container_type' => '40ft',
                        'container_no' => $container_no_40ft[$i],
                        'seal_no' => $seal_no_40ft[$i],
                        'replacement_seal_no' => $replacement_seal_no_40ft[$i],
                        'user_created' => $this->session->userdata('user_id'),
                        'date_created' => date('Y-m-d'),
                        'time_created' => date('H:i:s')
                    );
                    
                    $result = $this->db->insert('tr_container_trx', $data_container40ft);
                    if (!$result){
                        $error = true;
                        break;
                    }
                                   
                }
            }
            
            if ($result){
                for($i=0;$i<$countDetail45ft;$i++){
                    $data_container45ft = array(
                        'jo_no' => $jo_no,
                        'container_type' => '45ft',
                        'container_no' => $container_no_45ft[$i],
                        'seal_no' => $seal_no_45ft[$i],
                        'replacement_seal_no' => $replacement_seal_no_45ft[$i],
                        'user_created' => $this->session->userdata('user_id'),
                        'date_created' => date('Y-m-d'),
                        'time_created' => date('H:i:s')
                    );
                    
                    $result = $this->db->insert('tr_container_trx', $data_container45ft);
                    if (!$result){
                        $error = true;
                        break;
                    }
                                   
                }
            }
            
            Header('Content-Type: application/json; charset=UTF8');
            $status = $this->db->trans_status();
            if ($status === false || $error == true){
                $this->db->trans_rollback();
                
                $params['user_rowID'] = $this->tank_auth->get_user_id();
				$params['module'] = 'ERROR ROLLBACK Invoice';
				$params['module_field_id'] = 0;
				$params['activity'] = ucfirst('Deleted a Container No with JO No '.$jo_no);
				$params['icon'] = 'fa-exclamation-triangle';
				modules::run('activitylog/log',$params);
                
                echo json_encode(array('success' => false, 'msg' => "Failed Data RollBack"));
                exit();
            }
            else{
                $this->db->trans_commit();
                
                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'Container';
                $params['module_field_id'] = 0;
                $params['activity'] = ucfirst('Added a Container No with JO No ' . $jo_no);
                $params['icon'] = 'fa-plus';
                modules::run('activitylog/log', $params); //log activity

                echo json_encode(array("success" => true, 'msg' => lang('created_succesfully')));
                exit();
            }
        } 
        else {
            if(empty($dataPost['container_no_20ft'])){
                $countDetail20ft = 0;                
            }
            else{
                $countDetail20ft = count($dataPost['container_no_20ft']);
                $row_id_20ft = $dataPost['row_id_20ft'];
                $container_no_20ft = $dataPost['container_no_20ft'];
                $seal_no_20ft = $dataPost['seal_no_20ft'];
                $replacement_seal_no_20ft = $dataPost['replacement_seal_no_20ft'];
            }

            if(empty($dataPost['container_no_40ft'])){
                $countDetail40ft = 0;                
            }
            else{
                $countDetail40ft = count($dataPost['container_no_40ft']);
                $row_id_40ft = $dataPost['row_id_40ft'];
                $container_no_40ft = $dataPost['container_no_40ft'];
                $seal_no_40ft = $dataPost['seal_no_40ft'];
                $replacement_seal_no_40ft = $dataPost['replacement_seal_no_40ft'];
            }
            
            if(empty($dataPost['container_no_45ft'])){
                $countDetail45ft = 0;                
            }
            else{
                $countDetail45ft = count($dataPost['container_no_45ft']);
                $row_id_45ft = $dataPost['row_id_45ft'];
                $container_no_45ft = $dataPost['container_no_45ft'];
                $seal_no_45ft = $dataPost['seal_no_45ft'];
                $replacement_seal_no_45ft = $dataPost['replacement_seal_no_45ft'];
            }
            
            if ($result){
                for($i=0;$i<$countDetail20ft;$i++){
                    if(empty($row_id_20ft[$i])){
                        $data_container20ft = array(
                            'jo_no' => $jo_no,
                            'container_type' => '20ft',
                            'container_no' => $container_no_20ft[$i],
                            'seal_no' => $seal_no_20ft[$i],
                            'replacement_seal_no' => $replacement_seal_no_20ft[$i],
                            'user_created' => $this->session->userdata('user_id'),
                            'date_created' => date('Y-m-d'),
                            'time_created' => date('H:i:s')
                        );
                        
                        $result = $this->db->insert('tr_container_trx', $data_container20ft);
                        
                    }
                    else{
                        $data_container20ft = array(
                            'jo_no' => $jo_no,
                            'container_type' => '20ft',
                            'container_no' => $container_no_20ft[$i],
                            'seal_no' => $seal_no_20ft[$i],
                            'replacement_seal_no' => $replacement_seal_no_20ft[$i],
                            'user_modified' => $this->session->userdata('user_id'),
                            'date_modified' => date('Y-m-d'),
                            'time_modified' => date('H:i:s')
                        );
                        $this->db->where('rowID', $row_id_20ft[$i]);
                        
                        $result = $this->db->update('tr_container_trx', $data_container20ft);
                        
                    }   
                    
                    if (!$result){
                        $error = true;
                        break;
                    }
                    
                }
            }
            
            if ($result){
                for($i=0;$i<$countDetail40ft;$i++){
                    if(empty($row_id_40ft[$i])){
                        $data_container40ft = array(
                            'jo_no' => $jo_no,
                            'container_type' => '40ft',
                            'container_no' => $container_no_40ft[$i],
                            'seal_no' => $seal_no_40ft[$i],
                            'replacement_seal_no' => $replacement_seal_no_40ft[$i],
                            'user_created' => $this->session->userdata('user_id'),
                            'date_created' => date('Y-m-d'),
                            'time_created' => date('H:i:s')
                        );
                        
                        $result = $this->db->insert('tr_container_trx', $data_container40ft);
                        
                    }
                    else{
                        $data_container40ft = array(
                            'jo_no' => $jo_no,
                            'container_type' => '40ft',
                            'container_no' => $container_no_40ft[$i],
                            'seal_no' => $seal_no_40ft[$i],
                            'replacement_seal_no' => $replacement_seal_no_40ft[$i],
                            'user_modified' => $this->session->userdata('user_id'),
                            'date_modified' => date('Y-m-d'),
                            'time_modified' => date('H:i:s')
                        );
                        $this->db->where('rowID', $row_id_40ft[$i]);
                        
                        $result = $this->db->update('tr_container_trx', $data_container40ft);
                        
                    }   
                    
                    if (!$result){
                        $error = true;
                        break;
                    }
                    
                }
            }
            
            if ($result){
                for($i=0;$i<$countDetail45ft;$i++){
                    if(empty($row_id_45ft[$i])){
                        $data_container45ft = array(
                            'jo_no' => $jo_no,
                            'container_type' => '45ft',
                            'container_no' => $container_no_45ft[$i],
                            'seal_no' => $seal_no_45ft[$i],
                            'replacement_seal_no' => $replacement_seal_no_45ft[$i],
                            'user_created' => $this->session->userdata('user_id'),
                            'date_created' => date('Y-m-d'),
                            'time_created' => date('H:i:s')
                        );
                        
                        $result = $this->db->insert('tr_container_trx', $data_container45ft);
                        
                    }
                    else{
                        $data_container45ft = array(
                            'jo_no' => $jo_no,
                            'container_type' => '45ft',
                            'container_no' => $container_no_45ft[$i],
                            'seal_no' => $seal_no_45ft[$i],
                            'replacement_seal_no' => $replacement_seal_no_45ft[$i],
                            'user_modified' => $this->session->userdata('user_id'),
                            'date_modified' => date('Y-m-d'),
                            'time_modified' => date('H:i:s')
                        );
                        $this->db->where('rowID', $row_id_45ft[$i]);
                        
                        $result = $this->db->update('tr_container_trx', $data_container45ft);
                        
                    }   
                    
                    if (!$result){
                        $error = true;
                        break;
                    }
                    
                }
            }
            
            Header('Content-Type: application/json; charset=UTF8');
            $status = $this->db->trans_status();
            if ($status === false || $error == true){
                $this->db->trans_rollback();
                
                $params['user_rowID'] = $this->tank_auth->get_user_id();
				$params['module'] = 'ERROR ROLLBACK Invoice';
				$params['module_field_id'] = 0;
				$params['activity'] = ucfirst('Deleted a Container No with JO No '.$jo_no);
				$params['icon'] = 'fa-exclamation-triangle';
				modules::run('activitylog/log',$params);
                
                echo json_encode(array('success' => false, 'msg' => "Failed Data RollBack"));
                exit();
            }
            else{
                $this->db->trans_commit();
                
                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'container';
                $params['module_field_id'] = 0;
                $params['activity'] = ucfirst('Updated a Container No with JO No ' . $jo_no);
                $params['icon'] = 'fa-edit';
                modules::run('activitylog/log', $params); //log activity

                echo json_encode(array("success" => true, 'msg' => lang('updated_succesfully')));
                exit();
            }
                    
        }

    }
    
    function pdf()
    {
        if($this->session->userdata('start_date') == '' && $this->session->userdata('end_date') == ''){
            $start_date = date("Y-m-d");
            $end_date = date("Y-m-d");
        }
        else{
            $start_date = $this->session->userdata('start_date');
            $end_date = $this->session->userdata('end_date');
        }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['periode'] = date("d F Y",strtotime($start_date)).' - '.date("d F Y",strtotime($end_date));
        
        $data['containers'] = $this->container_model->get_all_detail_data($start_date,$end_date);
        
        $html = $this->load->view('container_pdf', $data, true);
        $this->pdf_generator->generate($html, 'container pdf',$orientation='Portrait');
    }
    
    function excel()
    {
        if($this->session->userdata('start_date') == '' && $this->session->userdata('end_date') == ''){
            $start_date = date("Y-m-d");
            $end_date = date("Y-m-d");
        }
        else{
            $start_date = $this->session->userdata('start_date');
            $end_date = $this->session->userdata('end_date');
        }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['periode'] = date("d F Y",strtotime($start_date)).' - '.date("d F Y",strtotime($end_date));
        
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=containers.xls");

        $data['containers'] = $this->container_model->get_all_detail_data($start_date,$end_date);
        
        $this->load->view("container_pdf", $data);

    }

}

/* End of file contacts.php */
