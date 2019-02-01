<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Order_type extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('order_type_model');
	}

	function index()
	{
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('order_types').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('order_types');
		$this->session->set_userdata('page_header', 'master');		
		$this->session->set_userdata('page_detail', 'order_types');
		$data['datatables'] = TRUE;
		$data['form'] = TRUE;
		$data['order_types'] = $this->order_type_model->get_all_records($table = 'sa_order_type', $array = array(
			'rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '','type_cd','asc');
		$this->template
		->set_layout('users')
		->build('order_types',isset($data) ? $data : NULL);
	}
	
    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->order_type_model->get_by_id($tabel = 'sa_order_type', $id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
	function delete_data($id)
    {
        header('Content-Type: application/json');
        $data = $this->order_type_model->delete_data($id);
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
        $order_type_code = $this->db->get_where('sa_order_type', array('type_cd' =>$dataPost['order_type_code']))->row_array();
        
        if (empty($dataPost['rowID'])) {// add new
            if (!empty($order_type_code['type_cd'])) {
                echo json_encode(array("success" => false, 'msg' => lang('already_exist')));
                exit();
            } else {
				$data_order_type = array(
						'type'=>$this->input->post('order_type_type'),
						'type_cd'=>$this->input->post('order_type_code'),
						'descs'=>strtoupper($this->input->post('order_type_name')),
						'user_created'=>$this->session->userdata('user_id'),
						'date_created'=>date('Y-m-d'),
						'time_created'=>date('H:i:s')							
		         );
				$this->db->insert('sa_order_type', $data_order_type); 
				$order_type_id = $this->db->insert_id();

				$params['user_rowID'] = $this->tank_auth->get_user_id();
				$params['module'] = 'order_types';
				$params['module_field_id'] = $order_type_id;
				$params['activity'] = ucfirst('Added a Order Type '.$this->input->post('order_type_name'));
				$params['icon'] = 'fa-user';
				modules::run('activitylog/log',$params); //log activity

				echo json_encode(array("success" => true, 'msg' => lang('order_type_registered_successfully')));
                exit;
            }
        }
        else{
            $data_order_type = array(
                'type'=>$this->input->post('order_type_type'),
				'type_cd'=>$this->input->post('order_type_code'),
				'descs'=>strtoupper($this->input->post('order_type_name')),
				'user_created'=>$this->session->userdata('user_id'),
				'date_created'=>date('Y-m-d'),
				'time_created'=>date('H:i:s'));
            $this->db->where('rowID', $dataPost['rowID']);
            $this->db->update('sa_order_type', $data_order_type);
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('order_type_edited_successfully')));
            exit();
                    
        }
	}

}

/* End of file contacts.php */