<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('debtor_model','debtor');
	}
	
		
	function update()
	{
		if ($this->input->post()) {
			
		$debtor_id =  $this->input->post('row_id');
		$this->load->library('form_validation');

			if($this->input->post('debtor_category') == 'I'){
				$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
				$this->form_validation->set_rules('debtor_category', 'Debtor Category', 'required|xss_clean');
				$this->form_validation->set_rules('debtor_id_type', 'ID Type', 'required|xss_clean');
				$this->form_validation->set_rules('debtor_id_number', 'ID Number', 'required|xss_clean');
				$this->form_validation->set_rules('debtor_name', 'Name', 'required|xss_clean');
			} 
			else{
				$this->form_validation->set_rules('debtor_name', 'Name', 'required|xss_clean');
			} 

		
			if ($this->form_validation->run() == FALSE)
			{
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', lang('error_in_form'));
					redirect('debtor/view/update/'.$debtor_id);
			}else{	
				
				$debtor_data = array(
								'debtor_cd'=>$this->input->post('debtor_code'),
								'debtor_name'=>strtoupper($this->input->post('debtor_name')),
								'class'=>strtoupper($this->input->post('debtor_category')),
								'id_type'=>strtoupper($this->input->post('debtor_id_type')),
								'id_no'=>strtoupper($this->input->post('debtor_id_number')),
								'address1'=>ucwords($this->input->post('debtor_address1')),
								'address2'=>ucwords($this->input->post('debtor_address2')),
								'address3'=>ucwords($this->input->post('debtor_address3')),
								'post_cd'=>$this->input->post('debtor_postal_code'),
								'hp_no1'=>$this->input->post('debtor_hp1'),
								'hp_no2'=>$this->input->post('debtor_hp2'),
								'telp_no1'=>$this->input->post('debtor_phone1'),
								'telp_no2'=>$this->input->post('debtor_phone2'),
								'fax_no1'=>$this->input->post('debtor_fax1'),
								'fax_no2'=>$this->input->post('debtor_fax2'),
								'contact_prs'=>$this->input->post('debtor_contact'),
								'website'=>$this->input->post('debtor_website'),
								'email'=>$this->input->post('debtor_email'),
								'sex'=>$this->input->post('debtor_gender'),
								'pob'=>ucwords($this->input->post('debtor_pob')),
								'dob'=>$this->input->post('debtor_dob'),
								'npwp_no'=>$this->input->post('debtor_npwp'),
								'npwp_name'=>$this->input->post('debtor_npwp'),
								'reg_date'=>$this->input->post('debtor_npwp_registered'),
								'npwp_address1'=>ucwords($this->input->post('debtor_npwp_address1')),
								'npwp_address2'=>ucwords($this->input->post('debtor_npwp_address2')),
								'npwp_address3'=>ucwords($this->input->post('debtor_npwp_address3')),
								'bank_acc1'=>$this->input->post('debtor_bank_account_no1'),
								'bank_acc_name1'=>ucwords($this->input->post('debtor_bank_account_name1')),
								'bank_name1'=>ucwords($this->input->post('debtor_bank_account_bank1')),
								'bank_acc2'=>ucwords($this->input->post('debtor_bank_account_no2')),
								'bank_acc_name2'=>ucwords($this->input->post('debtor_bank_account_name2')),
								'bank_name2'=>ucwords($this->input->post('debtor_bank_account_bank2')),
								'debtor_type_rowID'=>$this->input->post('debtor_code'),
								'user_modified'=>$this->session->userdata('user_id'),
								'date_modified'=>date('Y-m-d'),
								'time_modified'=>date('H:i:s')							
							);
							
				$this->db->where('rowID',$debtor_id)->update('sa_debtor', $debtor_data); 

						$params['user_rowID'] = $this->tank_auth->get_user_id();
						$params['module'] = 'Debtor';
						$params['module_field_id'] = $debtor_id;
						$params['activity'] = ucfirst('Updated System User : '.$this->input->post('debtor_name'));
						$params['icon'] = 'fa-edit';
						modules::run('activitylog/log',$params); //log activity

				$this->session->set_flashdata('response_status', 'success');
				$this->session->set_flashdata('message', lang('debtor_edited_successfully'));
				redirect('debtor'); 
			}
		}else{

		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang(debtors).' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
		$data['page'] = lang('debtors');
		$data['datatables'] = TRUE;
		$data['form'] = TRUE;
		
		$data['debtor_details'] = $this->debtor->debtor_details($this->uri->segment(4));
		$data['debtors'] = $this->debtor->get_all_records($table = 'sa_debtor_type', $array = array(
			'rowID >' => '0', 'deleted'=>'0'), $join_table = '', $join_criteria = '','rowID','desc');
		
		$this->template
		->set_layout('users')
		->build('edit_debtor',isset($data) ? $data : NULL);	
		
		}
	}
	
	function activities()
	{		
		$data['user_activities'] = $this->user->user_activities($this->uri->segment(4),$limit = 10);
		$this->load->view('client_activities',isset($data) ? $data : NULL);
	}
	
	function delete()
	{
		if ($this->input->post()) {

			$debtor_type_id = $this->input->post('row_id', TRUE);
			$debtor_data = array(
							'deleted'=>1,
							'user_deleted'=>$this->session->userdata('user_id'),
							'date_deleted'=>date('Y-m-d'),
							'time_deleted'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$debtor_type_id)->update('sa_debtor', $debtor_data); 

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('debtor_deleted_successfully'));
			redirect('debtor');
		}else{
			$data['debtor_type_id'] = $this->uri->segment(4);
			$data['debtor_details'] = $this->debtor->debtor_details($this->uri->segment(4));
			$this->load->view('modal/delete_debtor',$data);

		}
	}
}

/* End of file view.php */