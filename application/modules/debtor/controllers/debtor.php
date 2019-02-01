<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Debtor extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('debtor_model');
        
        $this->load->library('pdf_generator');
        $this->load->library("image_lib");
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('debtors') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('debtors');
        $this->session->set_userdata('page_header', 'master');
        $this->session->set_userdata('page_detail', 'debtors');
        $data['datatables'] = true;
        $data['form'] = true;
        $data['debtors'] = $this->debtor_model->get_all_records($table = 'sa_debtor', $array =
            array('rowID >' => '0', 'deleted' => '0'), $join_table = '', $join_criteria = '',
            'rowID', 'desc');
        $data['debtors_type'] = $this->debtor_model->get_all_records($table =
            'sa_debtor_type', $array = array('rowID >' => '0', 'deleted' => '0'), $join_table =
            '', $join_criteria = '', 'rowID', 'desc');
        $this->template->set_layout('users')->build('debtors', isset($data) ? $data : null);
    }
    
    function pdf()
    {
        $data['debtor'] = $this->debtor_model->get_all_records($table = 'sa_debtor', $array =
            array('rowID >' => '0', 'deleted' => '0'), $join_table = '', $join_criteria = '',
            'type,debtor_cd,debtor_name', 'asc');
            
        $html = $this->load->view('debtor_pdf', $data, true);
        $this->pdf_generator->generate($html, 'debtor pdf',$orientation='Landscape');//Portrait
    }
    
    
    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=debtor.xls");

        $data['debtor'] = $this->debtor_model->get_all_records($table = 'sa_debtor', $array =
            array('rowID >' => '0', 'deleted' => '0'), $join_table = '', $join_criteria = '',
            'type,debtor_cd,debtor_name', 'asc');
            
        $this->load->view("debtor_excel", $data);

    }
    
    
    /*
    function excel()
    {   
		$this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('All Debtor'); 

        $this->excel->getActiveSheet()->setCellValue('A1', 'All Debtor');
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

		$this->excel->getActiveSheet()->mergeCells('A1:O1');
		// set header table
		$this->excel->getActiveSheet()->setCellValue('A2', 'No');
		$this->excel->getActiveSheet()->setCellValue('B2', lang('debtor_cd'));   
		$this->excel->getActiveSheet()->setCellValue('C2', lang('debtor_name'));   
		$this->excel->getActiveSheet()->setCellValue('D2', lang('debtor_type'));   
		$this->excel->getActiveSheet()->setCellValue('E2', lang('debtor_no_ktp'));   
		$this->excel->getActiveSheet()->setCellValue('F2', lang('debtor_expired_date_ktp'));   
		$this->excel->getActiveSheet()->setCellValue('G2', 'SIM No'); 
		$this->excel->getActiveSheet()->setCellValue('H2', 'SIM Expired Date');  
		$this->excel->getActiveSheet()->setCellValue('I2', lang('debtor_address'));  
		$this->excel->getActiveSheet()->setCellValue('J2', lang('debtor_phone1'));  
		$this->excel->getActiveSheet()->setCellValue('K2', lang('debtor_contact'));  
		$this->excel->getActiveSheet()->setCellValue('L2', lang('debtor_email'));  
		$this->excel->getActiveSheet()->setCellValue('M2', lang('debtor_hp1'));  
		$this->excel->getActiveSheet()->setCellValue('N2', lang('debtor_gender'));  
		$this->excel->getActiveSheet()->setCellValue('O2', lang('debtor_pob'));  

		// set bold header label
		$this->excel->getActiveSheet()->getStyle('A2:O2')->getFont()->setBold(true);

		// set text header center
		$this->excel->getActiveSheet()->getStyle('A1:O2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
		// set auto width
		foreach(range('A','O') as $columnID)
		{
		    $this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
		}

        // Fetching the table data
        $col =3;
        $no = 1;
		
        $debtors = $this->debtor_model->get_all_records($table = 'sa_debtor', $array =
            array('rowID >' => '0', 'deleted' => '0'), $join_table = '', $join_criteria = '',
            'type,debtor_cd,debtor_name', 'desc');
        
        if(!empty($debtors)){
		    foreach($debtors as $val){
				if ($val->type == 'D'){
                    $type = 'Driver';
                }else if ($val->type == 'C'){
                    $type = 'Company';
                }else if ($val->type == 'E'){
                    $type = 'Employee';
                }
                 
    			$debtor_cd = $val->type.$val->debtor_cd;
                $debtor_name = $val->debtor_name;
                $id_no       = $val->no_ktp == '' ? '' : $val->no_ktp;
                $expired_date_id = $val->expired_date_ktp == '0000-00-00' ? '' : date("d F Y",strtotime($val->expired_date_ktp));
                $address     = $val->address1.' '.$val->address2.' '.$val->address3.' '.$val->post_cd;
                $telp_no1    = $val->telp_no1 == '' ? '' : $val->telp_no1.'/'.$val->telp_no2;
                $contact_prs = $val->contact_prs;
                $email       = $val->email;
                $hp_no1      = $val->hp_no1 == '' ? '' : $val->hp_no1.'/'.$val->hp_no2;
                $sex         = $val->sex == 'M' ? 'Male' : 'Female';
                $pob         = $val->pob == '' ? '' : ucwords(strtolower($val->pob)).','.$val->dob;
                
                $sim_no = '-';
                $sim_expired_date = '-';
                if($val->id_type == 'S'){
                    $sim_no = $val->id_no;
                    $sim_expired_date = date("d F Y",strtotime($val->expired_date_id));
                }
                
				$this->excel->getActiveSheet()->setCellValue('A'.$col, $no++); 
				$this->excel->getActiveSheet()->setCellValue('B'.$col, $debtor_cd); 
				$this->excel->getActiveSheet()->setCellValue('C'.$col, $debtor_name); 
				$this->excel->getActiveSheet()->setCellValue('D'.$col, $type); 
				$this->excel->getActiveSheet()->setCellValue('E'.$col, $id_no); 
				$this->excel->getActiveSheet()->getStyle('E'.$col)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
				$this->excel->getActiveSheet()->setCellValue('F'.$col, $expired_date_id); 
				$this->excel->getActiveSheet()->setCellValue('G'.$col, $sim_no); 
				$this->excel->getActiveSheet()->getStyle('G'.$col)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
				$this->excel->getActiveSheet()->setCellValue('H'.$col, $sim_expired_date); 
				$this->excel->getActiveSheet()->setCellValue('I'.$col, $address); 
				$this->excel->getActiveSheet()->setCellValue('J'.$col, $telp_no1); 
				$this->excel->getActiveSheet()->setCellValue('K'.$col, $contact_prs); 
				$this->excel->getActiveSheet()->setCellValue('L'.$col, $email); 
				$this->excel->getActiveSheet()->setCellValue('M'.$col, $hp_no1); 
				$this->excel->getActiveSheet()->setCellValue('N'.$col, $sex); 
				$this->excel->getActiveSheet()->setCellValue('O'.$col, $pob); 

				$col++;
				
			}
		}
    
		$styleArray = array(
		      'borders' => array(
		          'allborders' => array(
		              'style' => PHPExcel_Style_Border::BORDER_THIN
		          )
		      )
		);
		
 		// set border to all cells
		$this->excel->getActiveSheet()->getStyle('A1:' . $this->excel->getActiveSheet()->getHighestColumn() . $this->excel->getActiveSheet()->getHighestRow())->applyFromArray($styleArray);

        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
 
        // Sending headers to force the user to download the file
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="All Debtor.xlsx"');
        header('Cache-Control: max-age=0');
 
        $objWriter->save('php://output');
		
    }
    */
    
    function get_debtor_dtl()
    {
        error_reporting(E_ALL);
        $debtor_rowID = $this->input->post('debtor_rowID');
        $debtor_dtls = $this->debtor_model->get_all_records($table = 'sa_debtor', $array =
            array(
            'type =' => 'C',
            'rowID' => $debtor_rowID,
            'deleted' => '0'), $join_table = '', $join_criteria = '', 'rowID', 'ASC');

        if (!empty($debtor_dtls)) {
            header('Content-Type: application/json');
            foreach ($debtor_dtls as $debtor_dtl) {
                $arr = array('debtor_name' => $debtor_dtl->debtor_name, 'debtor_rowID' => $debtor_dtl->
                        rowID);
            }
            header('Content-type: application/json');
            echo json_encode($arr);
        }

        exit; // no need to render the template
    }

    function get_debtor_type2()
    {
        error_reporting(E_ALL);
        $debtor_cd = $this->input->post('debtor_cd');

        $debtor_type_data = $this->debtor_model->get_all_records($table =
            'sa_debtor_type', $array = array('rowID' => $debtor_cd, 'deleted' => '0'), $join_table =
            '', $join_criteria = '', 'rowID', 'ASC');

        if (!empty($debtor_type_data)) {
            header('Content-Type: application/json');
            foreach ($debtor_type_data as $debtor_type) {
                $arr = array(
                    'type_cd' => $debtor_type->type_cd,
                    'name' => $debtor_type->name,
                    'rowID' => $debtor_type->rowID,
                    'category' => $debtor_type->category);
            }
            header('Content-type: application/json');
            echo json_encode($arr);
        }

        exit;

    }

    function get_debtor_type()
    {
        $debtor_cd = $this->input->post('debtor_cd');
        $data = array('debtor_lists' => $this->debtor_model->get_all_record_debtor($debtor_cd));
        $this->load->view('ajax_debtor_type', $data);
    }

    function create_debtor()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $data['datatables'] = true;
        $data['form'] = true;

        $data['debtors'] = $this->debtor_model->get_all_records($table =
            'sa_debtor_type', $array = array('rowID >' => '0', 'deleted' => '0'), $join_table =
            '', $join_criteria = '', 'rowID', 'desc');


        $this->template->set_layout('users')->build('create_debtor', isset($data) ? $data : null);

    }
    
    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->debtor_model->get_by_id($tabel = 'sa_debtor', $id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function delete_data($id)
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $data = $this->debtor_model->delete_data($tabel='sa_debtor',$id);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
    
    function upload_photo(){
        $dataPost = $this->input->post();
        //echo "<pre>"; print_r($dataPost); echo "</pre>"; exit();
        error_reporting(E_ALL);
        
        $get_data = $this->debtor_model->get_by_id('sa_debtor',$dataPost['upload_rowid']);

		$debtor_photo = "";
		$debtor_photo_ktp = "";
        $debtor_photo_sim = "";
        
        $count_image = count($_FILES["userfile"]["name"]);
        $file_name = date('Ymd').'_'.strtolower($get_data->debtor_name).'_'.uniqid().".jpg";

        foreach($_FILES as $key=>$value){
            for($i=0;$i<$count_image;$i++){
                
                $_FILES['userfile']['name'] = $value['name'][$i];
                $_FILES['userfile']['type'] = $value['type'][$i];
                $_FILES['userfile']['tmp_name'] = $value['tmp_name'][$i];
                $_FILES['userfile']['error'] = $value['error'][$i];
                $_FILES['userfile']['size'] = $value['size'][$i];
                
                $config['upload_path'] = './resource/images/debtor_photo';
        		$config['allowed_types'] = 'gif|jpg|png';
        		$config['max_size'] = '5120';	// 5 MB
                $config['file_name'] = $file_name;
                
        		$this->load->library("upload", $config);
        		
                if($value['name'][$i] != '') {
                    
        			if($this->upload->do_upload()){
        				$file = $this->upload->data();
                        $file_name_tmp = $file["file_name"];
                        
                        $config['image_library'] = 'gd2';
    					$config['source_image'] = './resource/images/debtor_photo/'.$file["file_name"];
    					//$config['new_image'] = './resource/images/debtor_photo/'.$file_name_tmp;
    					$config['create_thumb'] = FALSE;
    					$config['maintain_ratio'] = TRUE;
                        if($i == 0){ // Debtor Photo
    					    $config['width'] = 300;
                        }
                        else{
                            $config['width'] = 700;
                        }
    					
    					//$this->load->library("image_lib", $config);
                        $this->image_lib->clear();
                        $this->image_lib->initialize($config);
    					
    					if (!$this->image_lib->resize()){
    						$this->session->set_flashdata('error',$this->image_lib->display_errors());
                            redirect(base_url().'debtor');
    					}
                        else{
                            //unlink('resource/images/debtor_photo/temp/'.$file_name_tmp);
                        }


                        if($i == 0){ // Debtor Photo
                            $debtor_photo = $file_name_tmp;
                            
                            if($get_data->debtor_photo != ''){
                                unlink('resource/images/debtor_photo/'.$get_data->debtor_photo);
                            }
                        }
                        else if($i == 1){ // Foto KTP
                            $debtor_photo_ktp = $file_name_tmp;
                            
                            if($get_data->debtor_photo_ktp != ''){
                                unlink('resource/images/debtor_photo/'.$get_data->debtor_photo_ktp);
                            }
                        }
                        else if($i == 2){ // Foto SIM
                            $debtor_photo_sim = $file_name_tmp;
                            
                            if($get_data->debtor_photo_sim != ''){
                                unlink('resource/images/debtor_photo/'.$get_data->debtor_photo_sim);
                            }
                        }
                        
                    }
        			else{
                        $this->session->set_flashdata('error',$this->upload->display_errors());
                        redirect(base_url().'debtor');
        			}
        		}
                
            }
        }
        
        if($debtor_photo != ''){
            $debtor_data = array(
                'debtor_photo' => $debtor_photo,
                'user_modified' => $this->session->userdata('user_id'),
                'date_modified' => date('Y-m-d'),
                'time_modified' => date('H:i:s')
            );
                    
            $this->db->where('rowID', $dataPost['upload_rowid']);
            $this->db->update('sa_debtor', $debtor_data);
        }
        
        if($debtor_photo_ktp != ''){
            $debtor_data = array(
                'debtor_photo_ktp' => $debtor_photo_ktp,
                'user_modified' => $this->session->userdata('user_id'),
                'date_modified' => date('Y-m-d'),
                'time_modified' => date('H:i:s')
            );
                    
            $this->db->where('rowID', $dataPost['upload_rowid']);
            $this->db->update('sa_debtor', $debtor_data);
        }
        
        if($debtor_photo_sim != ''){
            $debtor_data = array(
                'debtor_photo_sim' => $debtor_photo_sim,
                'user_modified' => $this->session->userdata('user_id'),
                'date_modified' => date('Y-m-d'),
                'time_modified' => date('H:i:s')
            );
                    
            $this->db->where('rowID', $dataPost['upload_rowid']);
            $this->db->update('sa_debtor', $debtor_data);
        }
        
        if($debtor_photo != '' || $debtor_photo_ktp != '' || $debtor_photo_sim != ''){        
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Debtor';
            $params['module_field_id'] = $dataPost['upload_rowid'];
            $params['activity'] = ucfirst('Upload photo a Debtor ' . $dataPost['upload_rowid']);
            $params['icon'] = 'fa-upload';
            modules::run('activitylog/log', $params); //log activity
        }
                
        $this->session->set_flashdata('success',lang('debtor_uploaded_successfully'));
        redirect(base_url().'debtor');
        
    }
    
    function create()
    {
        $dataPost = $this->input->post();
        //echo "<pre>"; print_r($dataPost); echo "</pre>"; exit();
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        
        if (empty($dataPost['rowID'])) {
            
            $year = date('Y');
            $hasil = ((int)$this->AppModel->select_max_id('sa_debtor', $array = array('type' => $dataPost['debtor_category_type']), 'code')) + 1;
            $code = sprintf("%04s", $hasil);
            $typeCode = $dataPost['debtor_category'];
            $debtor_code =  sprintf("%04s", $hasil);
            
            if($dataPost['finger_rowID'] > 0){
                $check_finger_id = $this->debtor_model->get_by_finger_id($dataPost['finger_rowID']);
                if(count($check_finger_id) > 0){
                    Header('Content-Type: application/json; charset=UTF8');
                    echo json_encode(array("success" => false, "msg" => "Finger ID is already exist."));
                    exit();
                }
            }
            
            $check_name = $this->debtor_model->get_by_name(strtoupper($dataPost['debtor_name']));
            if(count($check_name) > 0){
                Header('Content-Type: application/json; charset=UTF8');
                echo json_encode(array("success" => false, "msg" => "Debtor name is already exist."));
                exit();
            }
            else{
                if ($dataPost['debtor_category']=='C'){
                    $id_type = 'L';
                }else{
                    $id_type = strtoupper($dataPost['debtor_id_type']);
                }
            
                $debtor_data = array(
                    'code' => $code,
                    'year' => $year,
                    'type' => $dataPost['debtor_category_type'],
                    'debtor_type_rowID' => $dataPost['debtor_code'],
                    'debtor_cd' => $debtor_code,
                    'debtor_name' => strtoupper($dataPost['debtor_name']),
                    'category' => strtoupper($dataPost['debtor_category']),
                    'debtor_type' => $dataPost['debtor_type'],
                    'spare_driver' => empty($dataPost['spare_driver']) ? 0 : 1,
                    'active_period' => date("Y-m-d",strtotime($dataPost['active_period'])),
                    'finger_rowID' => $dataPost['finger_rowID'],
                    'no_ktp' => $dataPost['debtor_no_ktp'],
                    'expired_date_ktp' => date("Y-m-d",strtotime($dataPost['debtor_expired_date_ktp'])),
                    'id_type' => $id_type,
                    'id_no' => strtoupper($dataPost['debtor_id_number']),
                    'expired_date_id' => date("Y-m-d",strtotime($dataPost['debtor_expired_date_id'])),
                    'address1' => ucwords($dataPost['debtor_address1']),
                    'address2' => ucwords($dataPost['debtor_address2']),
                    'address3' => ucwords($dataPost['debtor_address3']),
                    'post_cd' => $dataPost['debtor_postal_code'],
                    'hp_no1' => $dataPost['debtor_hp1'],
                    'hp_no2' => $dataPost['debtor_hp2'],
                    'telp_no1' => $dataPost['debtor_phone1'],
                    'telp_no2' => $dataPost['debtor_phone2'],
                    'fax_no1' => $dataPost['debtor_fax1'],
                    'fax_no2' => $dataPost['debtor_fax2'],
                    'contact_prs' => $dataPost['debtor_contact'],
                    'website' => $dataPost['debtor_website'],
                    'email' => $dataPost['debtor_email'],
                    'sex' => $dataPost['debtor_gender'],
                    'pob' => ucwords($dataPost['debtor_pob']),
                    'dob' => date('Y-m-d',strtotime($dataPost['debtor_dob'])),
                    'npwp_no' => $dataPost['debtor_npwp'],
                    'npwp_name' => $dataPost['debtor_npwp'],
                    'reg_date' => date('Y-m-d',strtotime($dataPost['debtor_npwp_registered'])),
                    'npwp_address1' => ucwords($dataPost['debtor_npwp_address1']),
                    'npwp_address2' => ucwords($dataPost['debtor_npwp_address2']),
                    'npwp_address3' => ucwords($dataPost['debtor_npwp_address3']),
                    'bank_acc1' => $dataPost['debtor_bank_account_no1'],
                    'bank_acc_name1' => ucwords($dataPost['debtor_bank_account_name1']),
                    'bank_name1' => ucwords($dataPost['debtor_bank_account_name1']),
                    'bank_acc2' => ucwords($dataPost['debtor_bank_account_no2']),
                    'bank_acc_name2' => ucwords($dataPost['debtor_bank_account_name2']),
                    'bank_name2' => ucwords($dataPost['debtor_bank_account_name2']),
                    'user_created' => $this->session->userdata('user_id'),
                    'date_created' => date('Y-m-d'),
                    'time_created' => date('H:i:s')
                );
    
                $result=$this->db->insert('sa_debtor', $debtor_data);
                $debtor_id = $this->db->insert_id();
    
                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'Debtor';
                $params['module_field_id'] = $debtor_id;
                $params['activity'] = ucfirst('Added a new Debtor ' . $this->input->post('debtor_name'));
                $params['icon'] = 'fa-plus';
                modules::run('activitylog/log', $params); //log activity
                
                Header('Content-Type: application/json; charset=UTF8');
                echo json_encode(array("success" => true, "msg" => "Data has been Saved."));
                exit();
            }
            
        } else {
           $debtor_data = array(
                'debtor_name' => strtoupper($dataPost['debtor_name']),
                'category' => strtoupper($dataPost['debtor_category']),
                'debtor_type' => $dataPost['debtor_type'],
                'spare_driver' => empty($dataPost['spare_driver']) ? 0 : 1,
                'active_period' => date("Y-m-d",strtotime($dataPost['active_period'])),
                'finger_rowID' => $dataPost['finger_rowID'],
                'no_ktp' => $dataPost['debtor_no_ktp'],
                'expired_date_ktp' => date("Y-m-d",strtotime($dataPost['debtor_expired_date_ktp'])),
                'id_type' => strtoupper($dataPost['debtor_id_type']),
                'id_no' => strtoupper($dataPost['debtor_id_number']),
                'expired_date_id' => date("Y-m-d",strtotime($dataPost['debtor_expired_date_id'])),
                'address1' => ucwords($dataPost['debtor_address1']),
                'address2' => ucwords($dataPost['debtor_address2']),
                'address3' => ucwords($dataPost['debtor_address3']),
                'post_cd' => $dataPost['debtor_postal_code'],
                'hp_no1' => $dataPost['debtor_hp1'],
                'hp_no2' => $dataPost['debtor_hp2'],
                'telp_no1' => $dataPost['debtor_phone1'],
                'telp_no2' => $dataPost['debtor_phone2'],
                'fax_no1' => $dataPost['debtor_fax1'],
                'fax_no2' => $dataPost['debtor_fax2'],
                'contact_prs' => $dataPost['debtor_contact'],
                'website' => $dataPost['debtor_website'],
                'email' => $dataPost['debtor_email'],
                'sex' => $dataPost['debtor_gender'],
                'pob' => ucwords($dataPost['debtor_pob']),
                'dob' => date('Y-m-d',strtotime($dataPost['debtor_dob'])),
                'npwp_no' => $dataPost['debtor_npwp'],
                'npwp_name' => $dataPost['debtor_npwp'],
                'reg_date' => date('Y-m-d',strtotime($dataPost['debtor_npwp_registered'])),
                'npwp_address1' => ucwords($dataPost['debtor_npwp_address1']),
                'npwp_address2' => ucwords($dataPost['debtor_npwp_address2']),
                'npwp_address3' => ucwords($dataPost['debtor_npwp_address3']),
                'bank_acc1' => $dataPost['debtor_bank_account_no1'],
                'bank_acc_name1' => ucwords($dataPost['debtor_bank_account_name1']),
                'bank_name1' => ucwords($dataPost['debtor_bank_account_name1']),
                'bank_acc2' => ucwords($dataPost['debtor_bank_account_no2']),
                'bank_acc_name2' => ucwords($dataPost['debtor_bank_account_name2']),
                'bank_name2' => ucwords($dataPost['debtor_bank_account_name2']),
                'user_modified' => $this->session->userdata('user_id'),
                'date_modified' => date('Y-m-d'),
                'time_modified' => date('H:i:s')
            );
                
            $this->db->where('rowID', $dataPost['rowID']);
            $this->db->update('sa_debtor', $debtor_data);
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Debtor';
            $params['module_field_id'] = $dataPost['rowID'];
            $params['activity'] = ucfirst('Updated a Debtor ' . ucwords($this->input->post('debtor_name')));
            $params['icon'] = 'fa-edit';
            modules::run('activitylog/log', $params); //log activity
            
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, "msg" => "Data has been Saved."));
            exit();

        }


    }


}

/* End of file contacts.php */
