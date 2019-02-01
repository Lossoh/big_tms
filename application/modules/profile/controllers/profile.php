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


class Profile extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('profile_model');
	}
	function index(){
		redirect('profile/settings');
	}

	function settings()
	{
		if($_POST){
			if ($this->config->item('demo_mode') == 'TRUE') {
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message', lang('demo_warning'));
			 redirect('profile/settings');
			}
			
		$this->load->library('form_validation');
		$this->form_validation->set_rules('fullname', 'Full Name', 'required');
		$this->form_validation->set_rules('country', 'Country', 'required');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');

		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		                {
		                	$this->session->set_flashdata('response_status', 'error');
							$this->session->set_flashdata('message',lang('error_in_form'));
							$_POST = '';
							$this->settings();
		                    //redirect('profile/settings');
		                }else{                	
		            $form_data = $_POST;
		    $this->db->where('user_rowID', $this->tank_auth->get_user_id());
			$this->db->update('sa_user_details', $form_data); 
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message',lang('profile_updated_successfully'));
		    $_POST = '';
			$this->settings();
		                }


		}else{
	$this->load->module('layouts');
	$this->load->library('template');
    $this->session->set_userdata('page_header', 'settings');
    $this->session->set_userdata('page_detail', 'my_profile');
	$this->template->title(lang('profile').' - '.$this->config->item('company_name'). ' '. $this->config->item('version'));
	$data['page'] = lang('settings');
	$data['form'] = TRUE;
	$data['profile'] = $this->profile_model->get_all_records($table = 'sa_user_details',
		$array = array('user_rowID' =>$this->tank_auth->get_user_id()),
				$join_table = '',$join_criteria = '');
	//$data['countries'] = $this->profile_model->get_all($table = 'countries');
	$this->template
	->set_layout('users')
	->build('edit_profile',isset($data) ? $data : NULL);
	}
	}

	function changeavatar()
	{		


		if ($this->input->post()) {
			if ($this->config->item('demo_mode') == 'TRUE') {
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message', lang('demo_warning'));
			redirect($this->input->post('r_url', TRUE));
			}
						
						if ($this->config->item('demo_mode') == 'FALSE') {
							$config['upload_path'] = './resource/avatar/';
							$config['allowed_types'] = 'gif|jpg|png';
							$config['max_size']	= '800';
							$config['max_width']  = '500';
							$config['max_height']  = '500';
							$config['file_name'] = strtoupper('USER-'.$this->tank_auth->get_username()).'-AVATAR';
							$config['overwrite'] = TRUE;

							$this->load->library('upload', $config);

							if ( ! $this->upload->do_upload())
									{
										$this->session->set_flashdata('response_status', 'error');
										$this->session->set_flashdata('message',lang('avatar_upload_error'));
										redirect($this->input->post('r_url', TRUE));
									}
									else
									{
										$data = $this->upload->data();
										$file_name = $this->profile_model->update_avatar($data['file_name']);

										$this->session->set_flashdata('response_status', 'success');
										$this->session->set_flashdata('message',lang('avatar_uploaded_successfully'));
										redirect($this->input->post('r_url', TRUE));
									}
								} else {
									$this->session->set_flashdata('response_status', 'error');
									$this->session->set_flashdata('message',lang('demo_warning'));
									redirect($this->input->post('r_url', TRUE));
								}
			}else{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('no_avatar_selected'));
				redirect('profile/settings');
		}
	}

	function activities()
	{
    	$this->load->model('profile_model');
    	$this->load->module('layouts');
    	$this->load->library('template');
    	$this->template->title(lang('all_activities').' - '.$this->config->item('company_name'). ' '. $this->config->item('version'));
        $data['datatables'] = true;
        $data['form'] = true;
    	$data['page'] = lang('all_activities');

        $this->session->set_userdata('page_header', 'settings');
        $this->session->set_userdata('page_detail', 'activities');
        
    	$data['activities'] = $this->profile_model->activities($this->tank_auth->get_user_id(),$limit = 100);
    	$this->template
    	->set_layout('users')
    	->build('activities',isset($data) ? $data : NULL);        
	}

	function help()
	{
	$this->load->model('profile_model');
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title(lang('profile').' - '.$this->config->item('company_name'). ' '. $this->config->item('version'));
	$data['page'] = lang('home');
	$this->template
	->set_layout('users')
	->build('intro',isset($data) ? $data : NULL);
	}

	function fetch_data() { 
        if ($this->input->is_ajax_request()) {
            $dt = $_POST;

            $dt['table'] = 'activities';
            $dt['id'] = 'activity_id';
            $aColumnTable = array(
                'no', 'module', 'activity', 'activity_date'
            );

            $aColumns = array(
              'activity_id', 'module', 'activity', 'activity_date'            
            );

            $groupBy = '';
            /** Total Data Set Length * */
            $sQuery = "SELECT * FROM " . $dt['table'] . " where user_rowID = " . $this->tank_auth->get_user_id();
            $rResultTotal = $this->db->query($sQuery);
            $aResultTotal = $rResultTotal->num_rows();
            $iTotal = $aResultTotal;

            /** Paging * */
            $sLimit = "";
            if (isset($dt['start']) && $dt['length'] != '-1') {
                $sLimit = " LIMIT " . intval($dt['start']) . ", " . intval($dt['length']);
            }

            /** Ordering * */
            $sOrder = " ORDER BY ";
            $sOrderIndex = $dt['order'][0]['column'];
            $sOrderDir = $dt['order'][0]['dir'];
            $bSortable_ = $dt['columns'][$sOrderIndex]['orderable'];
            if ($bSortable_ == "true") {
                $sOrder .= $aColumnTable[$sOrderIndex] . ($sOrderDir === 'asc' ? ' asc' : ' desc');
            } else {
                $sOrder .= "activity_date DESC";
            }

            /** Filtering * */
            $sWhere = "";
            $sSearchVal = $dt['search']['value'];
            if (isset($sSearchVal) && $sSearchVal != '') {
                $sWhere = " WHERE (";
                for ($i = 0; $i < count($aColumns); $i++) {
                    $sWhere .= $aColumns[$i] . " LIKE '%" . $this->db->escape_like_str($sSearchVal) . "%' OR ";
                }
                $sWhere = substr_replace($sWhere, "", -3);
                $sWhere .= ') ';
            }

            /* Individual column filtering */
            $sSearchReg = $dt['search']['regex'];
            for ($i = 0; $i < count($aColumns); $i++) {
                $bSearchable_ = $dt['columns'][$i]['searchable'];
                if (isset($bSearchable_) && $bSearchable_ == "true" && $sSearchReg != 'false') {
                    $search_val = $dt['columns'][$i]['search']['value'];
                    if ($sWhere == "") {
                        $sWhere = " WHERE ";
                    } else {
                        $sWhere .= " AND ";
                    }
                    $sWhere .= $aColumns[$i] . " LIKE '%" . $this->db->escape_like_str($search_val) . "%' ";
                }
            }
            
            /* Get Data To Display */
            if ($sWhere != "") {
                $where = $sWhere;
            } else {
                $where = " where user_rowID = " . $this->tank_auth->get_user_id();
            }
            $sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) .
                    " FROM " . $dt['table'] . $where . $groupBy . $sOrder . $sLimit;
            $rResult = $this->db->query($sQuery);

            /* Data set length after filtering */
            $sQuery = "SELECT FOUND_ROWS() AS length_count";
            $rResultFilterTotal = $this->db->query($sQuery);
            $aResultFilterTotal = $rResultFilterTotal->row();
            $iFilteredTotal = $aResultFilterTotal->length_count;

            /** Output */
            $draw = $dt['draw'];
            $data = array();
            if (!empty($rResult)) {

                foreach ($rResult->result_array() as $aRow) {
                    $dt['start'] ++;
                    $row = array();
                    // $row['id'] = $aRow['activity_id'];
                    $row['no'] = $dt['start'];                    
                    $row['module'] = strtoupper($aRow['module']);
                    $row['activity'] = $aRow['activity'];
                    $row['activity_date'] = date('d F Y H:i:s', strtotime($aRow['activity_date']));
                    $data[] = $row;
                }
            }

            $output = array(
                "draw" => intval($draw),
                "recordsTotal" => $iTotal,
                "recordsFiltered" => $iFilteredTotal,
                "data" => $data
            );
            echo json_encode($output);
        } else {
            show_404();
        }
    }
}

/* End of file profile.php */