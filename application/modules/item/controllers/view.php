<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('item_model','item');
	}
	
	function update()
	{
		if ($this->input->post()) {
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('item_name', 'Item Name', 'required|xss_clean');
		$this->form_validation->set_rules('uom_id', 'Unit of Mesure', 'required|xss_clean');
			
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('error_in_form'));
				redirect('item');
		}else{	
			$item_id =  $this->input->post('row_id');
			$data_item = array(
							'uom_id'=>$this->input->post('uom_id'),
							'descs'=>strtoupper($this->input->post('item_name')),
							'user_modified'=>$this->session->userdata('user_id'),
							'date_modified'=>date('Y-m-d'),
							'time_modified'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$item_id)->update('sa_item', $data_item); 

					$params['user_rowID'] = $this->tank_auth->get_user_id();
					$params['module'] = 'Uom';
					$params['module_field_id'] = $item_id;
					$params['activity'] = ucfirst('Updated System Item : '.$this->input->post('item_name'));
					$params['icon'] = 'fa-edit';
					modules::run('activitylog/log',$params); //log activity

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('item_edited_successfully'));
			redirect('item');
		}
		}else{

		$data['item_details'] = $this->item->item_details($this->uri->segment(4));
		$data['uoms'] = $this->item->get_all_records_item($table = 'sa_uom', $array = array(
			'rowID >' => 0, 'deleted' => 0), $join_table = '', $join_criteria = '','uom_cd','asc');	
		$this->load->view('modal/edit_item',$data);
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

			$item_id = $this->input->post('row_id', TRUE);
			$item_data = array(
							'deleted'=>1,
							'user_deleted'=>$this->session->userdata('user_id'),
							'date_deleted'=>date('Y-m-d'),
							'time_deleted'=>date('H:i:s')							
			            );

			$this->db->where('rowID',$item_id)->update('sa_item',$item_data); 

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', lang('item_deleted_successfully'));
			redirect('item');
		}else{
			$data['item_id'] = $this->uri->segment(4);
			$data['item_details'] = $this->item->item_details($this->uri->segment(4));
			$this->load->view('modal/delete_item',$data);

		}
	}
}

/* End of file view.php */