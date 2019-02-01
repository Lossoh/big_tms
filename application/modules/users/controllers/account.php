<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
**********************************************************************************
* Copyright: gitbench 2014
* Licence: Please check CodeCanyon.net for licence details. 
* More licence clarification available here: htttp://codecanyon.net/wiki/support/legal-terms/licensing-terms/ 
* CodeCanyon User: http://codecanyon.net/user/gitbench
* CodeCanyon Project: http://codecanyon.net/item/freelancer-office/8870728
* Package Date: 2014-09-24 09:33:11 
***********************************************************************************
*/

require_once('phpass-0.1/PasswordHash.php');

class Account extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('user_model');
	}
	function index(){
		$this->active();
	}

	function active()
	{
    	$this->load->module('layouts');
    	$this->load->library('template');
    	$this->template->title(lang('users').' - '.$this->config->item('company_name'). ' '. $this->config->item('version'));
    	$data['page'] = lang('users');        
        $this->session->set_userdata('page_header', 'master');
        $this->session->set_userdata('page_detail', 'users');
        
    	$data['datatables'] = TRUE;
    	$data['form'] = TRUE;
    	$data['users'] = $this->user_model->users();
    	$data['roles'] = $this->user_model->roles();
    	$data['companies'] = array();//$this->AppModel->get_all_records($table = 'sa_comp',$array = array('co_id >' => '0'),$join_table = '',$join_criteria = '','date_added');
    	$data['departements'] = $this->AppModel->get_all_records($table = 'sa_dep',$array = array('deleted' => 0),$join_table = '',$join_criteria = '','dep_name');
   		$this->template
    	->set_layout('users')
    	->build('users',isset($data) ? $data : NULL);
	}
    
	function delete()
	{
		if ($this->input->post()) {

			if ($this->config->item('demo_mode') == 'TRUE') {
    			$this->session->set_flashdata('response_status', 'error');
    			$this->session->set_flashdata('message', lang('demo_warning'));
    			redirect($this->input->post('r_url'));
    		}
    		
    		$this->load->library('form_validation');
    		$this->form_validation->set_rules('user_id', 'User ID', 'required');
    		if ($this->form_validation->run() == FALSE)
    		{
    				$this->session->set_flashdata('response_status', 'error');
    				$this->session->set_flashdata('message', lang('delete_failed'));
    				$this->input->post('r_url');
    		}else{	
    			$user = $this->input->post('user_id');
                
    			//$this->db->delete('comments', array('posted_by' => $user)); 
    			//$this->db->delete('activities', array('user_rowID' => $user));  
    			//$this->db->delete('bugs', array('reporter' => $user)); 
    			// Delete bug files
    			/*$bug_files = $this->user_model->user_bug_files($user);
    			foreach ($bug_files as $key => $f) {
    				unlink('./resource/bug-files/'.$f->file_name);
    			}
                */
                /*
                // Hapus Foto Avatar
    			if ($this->user_profile->get_profile_details($user,'avatar') != 'default_avatar.jpg') {
    				unlink('./resource/avatar/'.$this->user_profile->get_profile_details($user,'avatar'));
    			}			
                */
    			//$this->db->delete('files', array('uploaded_by' => $user)); 
    			//$this->db->delete('bug_files', array('uploaded_by' => $user)); 
    			//$this->db->delete('sa_user_details', array('user_rowID' => $user)); 
    			//$this->db->delete('sa_users', array('rowID' => $user)); 
                $this->db->set('activated',0);
                $this->db->where('rowID',$user);
                $this->db->update('sa_users');
    			// Log Activity
				$params['user_rowID'] = $this->tank_auth->get_user_id();
				$params['module'] = 'Users';
				$params['module_field_id'] = $user;
				$params['activity'] = ucfirst('Deleted User');
				$params['icon'] = 'fa-trash-o';
				modules::run('activitylog/log',$params); //log activity

    			$this->session->set_flashdata('response_status', 'success');
    			$this->session->set_flashdata('message', lang('user_deleted_successfully'));
    			redirect($this->input->post('r_url'));
    		}
		}else{
			$data['user_id'] = $this->uri->segment(4);
			$this->load->view('modal/delete_user',$data);
		}
	}
    
    function reset_password(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');

        $user_id = $this->input->post('user_id');
        $new_password = $this->config->item('password_default');
        $hasher = new PasswordHash(
					$this->config->item('phpass_hash_strength', 'tank_auth'),
					$this->config->item('phpass_hash_portable', 'tank_auth'));
        $hashed_password = $hasher->HashPassword($new_password);

        $sql = "UPDATE sa_users SET password = '".$hashed_password."' WHERE rowID = ".$user_id;
        
        if($this->db->query($sql)){
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'User->Reset Password';
            $params['module_field_id'] = $user_id;
            $params['activity'] = ucfirst('Reset password with user id = ' . $user_id);
            $params['icon'] = 'fa-user';
            modules::run('activitylog/log', $params); //log activity
            Header('Content-Type: application/json; charset=UTF8');
    
            echo json_encode(array("success" => true));
            exit();
            
        }
        else{
            echo json_encode(array("success" => false));
            exit();
        }
        
    }   
     
}

/* End of file account.php */