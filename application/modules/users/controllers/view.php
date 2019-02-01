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


class View extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('user_model','user');
	}
	
	function update()
	{
		if ($this->input->post()) {
			if ($this->config->item('demo_mode') == 'TRUE') {
    			$this->session->set_flashdata('response_status', 'error');
    			$this->session->set_flashdata('message', lang('demo_warning'));
    			redirect('users/account');
		    }
            
    		$this->load->library('form_validation');
    		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
    		$this->form_validation->set_rules('email', 'Email', 'required');
    		$this->form_validation->set_rules('fullname', 'Full Name', 'required');
    		$this->form_validation->set_rules('role_id', 'Role', 'required');
            //print_r($this->input->post('role_id'));exit;
    		if ($this->form_validation->run() == false)
    		{
    				$this->session->set_flashdata('response_status', 'error');
    				$this->session->set_flashdata('message', lang('operation_failed'));
    				redirect('users/account');
    		}
            else{	
    		    $user_id =  $this->input->post('user_id');
    			$profile_data = array(
    			                'fullname' => $this->input->post('fullname'),
    			                'city' => $this->input->post('city'),
    			                'company' => $this->input->post('company'),	
    			                'vat' => $this->input->post('vat'),
    			                'phone' => $this->input->post('phone'),		
    			                'address' => $this->input->post('address')		               
    			            );
    
    			$this->db->where('user_rowID',$user_id)->update('sa_user_details', $profile_data); 
    			$user_data = array(
    			                'dep_rowID' => $this->input->post('departement'),
    			                'email' => $this->input->post('email'),
    			                'role_rowid' => $this->input->post('role_id'),
    			                'modified' => date("Y-m-d H:i:s")
    			                );
    			$this->db->where('rowID',$user_id)->update('sa_users', $user_data); 
    					$params['user_rowID'] = $this->tank_auth->get_user_id();
    					$params['module'] = 'Users';
    					$params['module_field_id'] = $user_id;
    					$params['activity'] = ucfirst('Updated System User : '.$this->input->post('fullname'));
    					$params['icon'] = 'fa-edit';
    					modules::run('activitylog/log',$params); //log activity
                
                if($this->tank_auth->get_user_id() == $user_id){
                    $this->session->set_userdata('role_rowID',$this->input->post('role_id'));
                }
                
    			$this->session->set_flashdata('response_status', 'success');
    			$this->session->set_flashdata('message', lang('user_edited_successfully'));
    			redirect('users/account');
    		}
		}
        else{
    		$data['user_details'] = $this->user->user_details($this->uri->segment(4));
    		$data['roles'] = $this->user->roles();
    		$data['companies'] = array();//$this->AppModel->get_all_records($table = 'companies',$array = array('co_id >' => '0'),$join_table = '',$join_criteria = '','date_added');
    		$data['departements'] = $this->AppModel->get_all_records($table = 'sa_dep',$array = array('deleted' => 0),$join_table = '',$join_criteria = '','dep_name');
    		$this->load->view('modal/edit_user',$data);
		}
	}
    
	function _log_user_activity($activity,$icon){
			$this->db->set('module', 'users');
			$this->db->set('module_field_id', $this->tank_auth->get_user_id());
			$this->db->set('user', $this->tank_auth->get_user_id());
			$this->db->set('activity', $activity);
			$this->db->set('icon', $icon);
			$this->db->insert('activities'); 
	}
}

/* End of file view.php */