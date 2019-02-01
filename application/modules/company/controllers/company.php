<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company extends MX_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('company_model');
	}

	function index()
	{
    	$this->load->module('layouts');
    	$this->load->library('template');
    	$this->template->title(lang('companies').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
    	$data['page'] = lang('companies');
    	$this->session->set_userdata('page_header', 'master');		
    	$this->session->set_userdata('page_detail', 'companies');
    	
    	$this->template
    	->set_layout('users')
    	->build('companies',isset($data) ? $data : NULL);
	}
    
    function update(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('comp_cd', 'Company Code', 'required');
        $this->form_validation->set_rules('comp_name', 'Nama Perusahaan', 'required');
        $this->form_validation->set_rules('address1', 'Alamat', 'required');
        $this->form_validation->set_rules('address2', 'Kecamatan', 'required');
        $this->form_validation->set_rules('address3', 'Kota', 'required');
        $this->form_validation->set_rules('telp1', 'No Telepon 1', 'required');
        $this->form_validation->set_rules('telp2', 'No Telepon 2', 'required');
        $this->form_validation->set_rules('fax1', 'No Fax 1', 'required');
        $this->form_validation->set_rules('fax2', 'No Fax 2', 'required');
        $this->form_validation->set_rules('website', 'Website', 'required');
        $this->form_validation->set_rules('email1', 'Email 1', 'required');
        $this->form_validation->set_rules('email2', 'Email 2', 'required');
        $this->form_validation->set_rules('npwp_no', 'NPWP', 'required');
        $this->form_validation->set_rules('npwp_address1', 'Alamat di NPWP', 'required');
        $this->form_validation->set_rules('npwp_address2', 'Kecamatan di NPWP', 'required');
        $this->form_validation->set_rules('npwp_address3', 'Kota di NPWP', 'required');
        $this->form_validation->set_rules('npwp_post_cd', 'Kode Pos di NPWP', 'required');
        $this->form_validation->set_rules('nppkp_no', 'NPPKP', 'required');
        
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', 'Change data unsuccessful, please filling all data.');
            redirect(base_url().'company');
        } else {
            $comp_cd = $this->input->post('comp_cd'); 
            $comp_name = $this->input->post('comp_name'); 
            $address1 = $this->input->post('address1'); 
            $address2 = $this->input->post('address2'); 
            $address3 = $this->input->post('address3'); 
            $telp1 = $this->input->post('telp1'); 
            $telp2 = $this->input->post('telp2'); 
            $fax1 = $this->input->post('fax1'); 
            $fax2 = $this->input->post('fax2'); 
            $website = $this->input->post('website'); 
            $email1 = $this->input->post('email1'); 
            $email2 = $this->input->post('email2'); 
            $npwp_no = $this->input->post('npwp_no'); 
            $npwp_address1 = $this->input->post('npwp_address1'); 
            $npwp_address2 = $this->input->post('npwp_address2'); 
            $npwp_address3 = $this->input->post('npwp_address3'); 
            $npwp_post_cd = $this->input->post('npwp_post_cd'); 
            $nppkp_no = $this->input->post('nppkp_no'); 
            
            $data_comp_cd = array(
                'company_value' => $comp_cd,
            );
            $this->company_model->update($data_comp_cd, 'comp_cd');
            
            $data_comp_name = array(
                'company_value' => $comp_name,
            );
            $this->company_model->update($data_comp_name, 'comp_name');
            
            $data_address1 = array(
                'company_value' => $address1,
            );
            $this->company_model->update($data_address1, 'address1');
            
            $data_address2 = array(
                'company_value' => $address2,
            );
            $this->company_model->update($data_address2, 'address2');
            
            $data_address3 = array(
                'company_value' => $address3,
            );
            $this->company_model->update($data_address3, 'address3');
            
            $data_telp1 = array(
                'company_value' => $telp1,
            );
            $this->company_model->update($data_telp1, 'telp1');
            
            $data_telp2 = array(
                'company_value' => $telp2,
            );
            $this->company_model->update($data_telp2, 'telp2');
            
            $data_fax1 = array(
                'company_value' => $fax1,
            );
            $this->company_model->update($data_fax1, 'fax1');
            
            $data_fax2 = array(
                'company_value' => $fax2,
            );
            $this->company_model->update($data_fax2, 'fax2');
            
            $data_website = array(
                'company_value' => $website,
            );
            $this->company_model->update($data_website, 'website');
            
            $data_email1 = array(
                'company_value' => $email1,
            );
            $this->company_model->update($data_email1, 'email1');
            
            $data_email2 = array(
                'company_value' => $email2,
            );
            $this->company_model->update($data_email2, 'email2');
            
            $data_npwp_no = array(
                'company_value' => $npwp_no,
            );
            $this->company_model->update($data_npwp_no, 'npwp_no');
            
            $data_npwp_address1 = array(
                'company_value' => $npwp_address1,
            );
            $this->company_model->update($data_npwp_address1, 'npwp_address1');
            
            $data_npwp_address2 = array(
                'company_value' => $npwp_address2,
            );
            $this->company_model->update($data_npwp_address2, 'npwp_address2');
            
            $data_npwp_address3 = array(
                'company_value' => $npwp_address3,
            );
            $this->company_model->update($data_npwp_address3, 'npwp_address3');
            
            $data_npwp_post_cd = array(
                'company_value' => $npwp_post_cd,
            );
            $this->company_model->update($data_npwp_post_cd, 'npwp_post_cd');
            
            $data_nppkp_no = array(
                'company_value' => $nppkp_no,
            );
            $this->company_model->update($data_nppkp_no, 'nppkp_no');
            
            
            $this->session->set_flashdata('message', 'Change data successful.');
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Company';
            $params['module_field_id'] = $this->config->item('comp_cd');
            $params['activity'] = ucfirst('Update data company');
            $params['icon'] = 'fa-edit';
            modules::run('activitylog/log', $params); //log activity
            
            redirect(base_url().'company');
                
        }
    }
    
}

/* End of file contacts.php */