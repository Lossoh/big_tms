<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Creditor_type extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('creditor_type_model');
        $this->load->library('pdf_generator');
		
	}
    
    function pdf()
    {
        $data['creditor_type'] = $this->creditor_type_model->get_pdf();
        $html = $this->load->view('creditor_type_pdf', $data, true);
        $this->pdf_generator->generate($html, 'Creditor Type pdf',$orientation='Portrait');//Portrait
    }

	function index()
	{
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('debtor_types').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('creditor_types');
		$this->session->set_userdata('page_header', 'master');		
		$this->session->set_userdata('page_detail', 'creditor_types');
		$data['datatables'] = TRUE;
		$data['form'] = TRUE;
		//$data['debtor_types'] = $this->debtor_type_model->get_all_records($table = 'sa_debtor_type', $array = array(
		//	'sa_debtor_type.rowID >' => '0', 'sa_debtor_type.deleted'=>'0'), $join_table = 'gl_coa', $join_criteria = 'sa_debtor_type.receiveable_coa_rowID = gl_coa.rowID,sa_debtor_type.','sa_debtor_type.rowID');
		
        $data['creditor_types'] = $this->creditor_type_model->get_all_record_data();
        $data['coas'] = $this->creditor_type_model->get_account();
        
//		$data['coas'] = $this->debtor_type_model->get_coa($table = 'gl_coa', $array = array(
//			'rowID >' => '0', 'deleted'=>'0', 'acc_transition'=>'Y'), $join_table = '', $join_criteria = '','acc_cd');	

		$this->template
        ->set_layout('users')
		->build('creditor_types',isset($data) ? $data : NULL);
	}
      
   	function get_data_edit($id)
	{
	    error_reporting(E_ALL);
        header('Content-Type: application/json');
		$hasil = $this->creditor_type_model->get_by_id($tabel='sa_creditor_type',$id);
        header('Content-type: application/json');
        echo json_encode($hasil);
		exit;
	}
    
    function delete_data($id){
        header('Content-Type: application/json');
	    $data = $this->creditor_type_model->delete_data($tabel = 'sa_creditor_type',$id);
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
       $creditor_type_code = $this->db->get_where('sa_creditor_type', array('type_cd' =>
                $dataPost['creditor_type_cd']))->row_array();
       if (empty($dataPost['rowID'])){ //
            if (!empty($creditor_type_code['type_cd'])) {
                echo json_encode(array("success" => false, 'msg' => lang('already_exist')));
                exit();
            } else {
                $data = array(
    			'type_cd'=>strtoupper($dataPost['creditor_type_cd']),
    			'descs'=>strtoupper($dataPost['creditor_type_name']),
    			'advance_coa_rowID'=>strtoupper($dataPost['creditortype_advance_acc']),
    			'deposit_coa_rowID'=>strtoupper($dataPost['creditortype_deposit_acc']),
    			'rounding_coa_rowID'=>strtoupper($dataPost['creditortype_rounding_acc']),
    			'adm_coa_rowID'=>strtoupper($dataPost['creditortype_adm_acc']),
                'payable_coa_rowID'=>strtoupper($dataPost['creditortype_pay_acc']),
    			'user_created'=>$this->session->userdata('user_id'),
    			'date_created'=>date('Y-m-d'),
    			'time_created'=>date('H:i:s')							
            );
    		$this->db->insert('sa_creditor_type', $data);
            $creditor_type_id = $this->db->insert_id();
                $params['user_rowID'] = $this->tank_auth->get_user_id();
    			$params['module'] = 'Creditor_types';
    			$params['module_field_id'] = $creditor_type_id;
    			$params['activity'] = ucfirst('Added a new item '.strtoupper($dataPost['creditor_type_name']));
    			$params['icon'] = 'fa-user';
    			modules::run('activitylog/log',$params); //log activity
            echo json_encode(array("success" => true, 'msg' => lang('creditortype_registered_successfully')));
            exit;
                
            }
      		
       }else{
          $data = array(
    			'type_cd'=>strtoupper($dataPost['creditor_type_cd']),
    			'descs'=>strtoupper($dataPost['creditor_type_name']),
    			'advance_coa_rowID'=>strtoupper($dataPost['creditortype_advance_acc']),
    			'deposit_coa_rowID'=>strtoupper($dataPost['creditortype_deposit_acc']),
    			'rounding_coa_rowID'=>strtoupper($dataPost['creditortype_rounding_acc']),
    			'adm_coa_rowID'=>strtoupper($dataPost['creditortype_adm_acc']),
                'payable_coa_rowID'=>strtoupper($dataPost['creditortype_pay_acc']),
    			'user_created'=>$this->session->userdata('user_id'),
    			'date_created'=>date('Y-m-d'),
    			'time_created'=>date('H:i:s')							
            );
            
            $this->db->where('rowID',$this->input->post('rowID'));
            $this->db->update('sa_creditor_type', $data);
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('creditortype_edited_successfully')));
            exit();
        
       }


	}


}

/* End of file contacts.php */