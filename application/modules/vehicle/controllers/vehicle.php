<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Vehicle extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('vehicle_model');
        $this->load->model('appmodel');
        $this->load->model('fare_trip/fare_trip_model');
        $this->load->library('pdf_generator');
        $this->load->library("image_lib");
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('vehicles') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('vehicles');
        $this->session->set_userdata('page_header', 'master');
        $this->session->set_userdata('page_detail', 'vehicles');
        $data['datatables'] = true;
        $data['form'] = true;
        $data['vehicles'] = $this->vehicle_model->get_all_records_list($table =
            'sa_vehicle', $array = array('sa_vehicle.rowID >' => 0, 'sa_vehicle.deleted' =>
                0), $join_table1 = 'sa_debtor', $join_criteria1 =
            'sa_vehicle.debtor_rowID=sa_debtor.rowID', 'sa_vehicle.rowID', 'asc');

        $data['vehicle_types'] = $this->vehicle_model->get_all_records($table =
            'sa_vehicle_type', $array = array('rowID >' => 0, 'deleted' => 0), $join_table =
            '', $join_criteria = '', 'type_cd', 'asc');
        
        $data['departments'] = $this->vehicle_model->get_all_records($table =
            'sa_dep', $array = array('rowID >' => 0, 'deleted' => 0), $join_table =
            '', $join_criteria = '', 'dep_name', 'asc');

        $data['drivers'] = $this->vehicle_model->get_all_records($table = 'sa_debtor', $array =
            array(
            'type =' => 'D',
            'rowID >' => 0,
            'deleted' => 0), $join_table = '', $join_criteria = '', 'debtor_cd', 'asc');

        $this->template->set_layout('users')->build('vehicles', isset($data) ? $data : null);
    }

    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $hasil = $this->vehicle_model->get_by_id($tabel = 'sa_vehicle', $id);
        header('Content-type: application/json');
        echo json_encode($hasil);
        exit;
    }


    function delete_data($id)
    {
        header('Content-Type: application/json');
        $data = $this->vehicle_model->delete_data($id);
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
        $vehicle_police_no = $this->db->get_where('sa_vehicle', array('deleted' => 0, 'police_no' =>
                $dataPost['vehicle_police_no'], 'dep_rowID' => $dataPost['dep_id']))->row_array();
                
        if (empty($dataPost['rowID'])) {
            if (!empty($vehicle_police_no['police_no'])) {
                echo json_encode(array("success" => false, 'msg' => lang('already_exist')));
                exit();
            } else {
                
                if($this->input->post('status_stnk') == '')
                    $status_stnk = 'fotocopy';
                else
                    $status_stnk = 'asli';

                if($this->input->post('status_kir') == '')
                    $status_kir = 'fotocopy';
                else
                    $status_kir = 'asli';

                if($this->input->post('status_bpkb') == '')
                    $status_bpkb = 'fotocopy';
                else
                    $status_bpkb = 'asli';
                    
                if($this->input->post('status_insurance') == '')
                    $status_insurance = 'fotocopy';
                else
                    $status_insurance = 'asli';
                    
                if($this->input->post('status_kiu') == '')
                    $status_kiu = 'fotocopy';
                else
                    $status_kiu = 'asli';
                
                $data_vehicle = array(
                    'dep_rowID' => $this->input->post('dep_id'),
                    'police_no' => strtoupper($this->input->post('vehicle_police_no')),
                    'vehicle_type' => $this->input->post('vehicle_type'),
                    'gps_no' => $this->input->post('vehicle_gps'),
                    'debtor_rowID' => $this->input->post('vehicle_driver'),
                    'no_stnk' => strtoupper($this->input->post('no_stnk')),
                    'status_stnk' => $status_stnk,
                    'expired_stnk' => date('Y-m-d',strtotime($this->input->post('expired_stnk'))),
                    'no_kir' => strtoupper($this->input->post('no_kir')),
                    'status_kir' => $status_kir,
                    'expired_kir' => date('Y-m-d',strtotime($this->input->post('expired_kir'))),
                    'no_bpkb' => strtoupper($this->input->post('no_bpkb')),
                    'status_bpkb' => $status_bpkb,
                    'no_insurance' => strtoupper($this->input->post('no_insurance')),
                    'status_insurance' => $status_insurance,
                    'expired_insurance' => date('Y-m-d',strtotime($this->input->post('expired_insurance'))),
                    'no_kiu' => strtoupper($this->input->post('no_kiu')),
                    'status_kiu' => $status_kiu,
                    'expired_kiu' => date('Y-m-d',strtotime($this->input->post('expired_kiu'))),
                    'user_created' => $this->session->userdata('user_id'),
                    'date_created' => date('Y-m-d'),
                    'time_created' => date('H:i:s'));
                $this->db->insert('sa_vehicle', $data_vehicle);
                $vehicle_id = $this->db->insert_id();
    
                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'vehicles';
                $params['module_field_id'] = $vehicle_id;
                $params['activity'] = ucfirst('Added a new Vehicle ' . $this->input->post('vehicle_police_no'));
                $params['icon'] = 'fa-user';
                modules::run('activitylog/log', $params); //log activity
                
                echo json_encode(array("success" => true, 'msg' => lang('vehicle_registered_successfully')));
                exit;
            }
        } else { // edit Data
            if($this->input->post('status_stnk') == '')
                $status_stnk = 'fotocopy';
            else
                $status_stnk = 'asli';

            if($this->input->post('status_kir') == '')
                $status_kir = 'fotocopy';
            else
                $status_kir = 'asli';

            if($this->input->post('status_bpkb') == '')
                $status_bpkb = 'fotocopy';
            else
                $status_bpkb = 'asli';
            
            if($this->input->post('status_insurance') == '')
                $status_insurance = 'fotocopy';
            else
                $status_insurance = 'asli';
                
            if($this->input->post('status_kiu') == '')
                $status_kiu = 'fotocopy';
            else
                $status_kiu = 'asli';

            $data_vehicle = array(
                'dep_rowID' => $this->input->post('dep_id'),
                'police_no' => strtoupper($this->input->post('vehicle_police_no')),
                'vehicle_type' => $this->input->post('vehicle_type'),
                'gps_no' => $this->input->post('vehicle_gps'),
                'debtor_rowID' => $this->input->post('vehicle_driver'),
                'no_stnk' => strtoupper($this->input->post('no_stnk')),
                'status_stnk' => $status_stnk,
                'expired_stnk' => date('Y-m-d',strtotime($this->input->post('expired_stnk'))),
                'no_kir' => strtoupper($this->input->post('no_kir')),
                'status_kir' => $status_kir,
                'expired_kir' => date('Y-m-d',strtotime($this->input->post('expired_kir'))),
                'no_bpkb' => strtoupper($this->input->post('no_bpkb')),
                'status_bpkb' => $status_bpkb,
                'no_insurance' => strtoupper($this->input->post('no_insurance')),
                'status_insurance' => $status_insurance,
                'expired_insurance' => date('Y-m-d',strtotime($this->input->post('expired_insurance'))),
                'no_kiu' => strtoupper($this->input->post('no_kiu')),
                'status_kiu' => $status_kiu,
                'expired_kiu' => date('Y-m-d',strtotime($this->input->post('expired_kiu'))),
                'user_created' => $this->session->userdata('user_id'),
                'date_created' => date('Y-m-d'),
                'time_created' => date('H:i:s'));
            $this->db->where('rowID', $dataPost['rowID']);
            $this->db->update('sa_vehicle', $data_vehicle);
            
            Header('Content-Type: application/json; charset=UTF8');
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'vehicles';
            $params['module_field_id'] = $dataPost['rowID'];
            $params['activity'] = ucfirst('Updated a Vehicle ' . $this->input->post('vehicle_police_no'));
            $params['icon'] = 'fa-edit';
            modules::run('activitylog/log', $params); //log activity
            
            echo json_encode(array("success" => true, 'msg' => lang('vehicle_edited_successfully')));
            exit();
        }

    }

    function upload_photo(){
        $dataPost = $this->input->post();
        //echo "<pre>"; print_r($dataPost); echo "</pre>"; exit();
        error_reporting(E_ALL);
        
        $get_data = $this->vehicle_model->get_by_id('sa_vehicle',$dataPost['upload_rowid']);

       	$vehicle_photo = "";
        
        $count_image = count($_FILES["userfile"]["name"]);
        $file_name = date('YmdHis').'_'.uniqid().".jpg";

        foreach($_FILES as $key=>$value){
            for($i=0;$i<$count_image;$i++){
                
                $_FILES['userfile']['name'] = $value['name'][$i];
                $_FILES['userfile']['type'] = $value['type'][$i];
                $_FILES['userfile']['tmp_name'] = $value['tmp_name'][$i];
                $_FILES['userfile']['error'] = $value['error'][$i];
                $_FILES['userfile']['size'] = $value['size'][$i];
                
                $config['upload_path'] = './resource/images/vehicle';
        		$config['allowed_types'] = 'gif|jpg|jpeg|png';
        		$config['max_size'] = '5120';	// 5 MB
                $config['file_name'] = $file_name;
                
        		$this->load->library("upload", $config);
        		
                if($value['name'][$i] != '') {
                    
        			if($this->upload->do_upload()){
        				$file = $this->upload->data();
                        $vehicle_photo = $file["file_name"];
                        
                        $config['image_library'] = 'gd2';
    					$config['source_image'] = './resource/images/vehicle/'.$vehicle_photo;
    					$config['new_image'] = './resource/images/vehicle/'.$vehicle_photo;
                        $config['create_thumb'] = FALSE;
    					$config['maintain_ratio'] = FALSE;
    					$config['width'] = 500;
    					$config['height'] = 350;
    					
    					//$this->load->library("image_lib", $config);
                        $this->image_lib->clear();
                        $this->image_lib->initialize($config);
    					
    					if (!$this->image_lib->resize()){
    						$this->session->set_flashdata('error',$this->image_lib->display_errors());
                            redirect(base_url().'vehicle');
    					}
                        else{
                            //unlink('resource/images/debtor_photo/temp/'.$vehicle_photo);
                        }
                        
                    }
        			else{
                        $this->session->set_flashdata('error',$this->upload->display_errors());
                        redirect(base_url().'vehicle');
        			}
        		}
                
            }
        }
        
        if($vehicle_photo != ''){
            if($get_data->vehicle_photo != ''){
                unlink('resource/images/vehicle/'.$get_data->vehicle_photo);
            }
            
            $vehicle_data = array(
                'vehicle_photo' => $vehicle_photo,
                'user_modified' => $this->session->userdata('user_id'),
                'date_modified' => date('Y-m-d'),
                'time_modified' => date('H:i:s')
            );
                    
            $this->db->where('rowID', $dataPost['upload_rowid']);
            $this->db->update('sa_vehicle', $vehicle_data);
        }
        
        if($vehicle_photo != ''){        
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Vehicle';
            $params['module_field_id'] = $dataPost['upload_rowid'];
            $params['activity'] = ucfirst('Upload vehicle photo with id ' . $dataPost['upload_rowid']);
            $params['icon'] = 'fa-upload';
            modules::run('activitylog/log', $params); //log activity
        }
                
        $this->session->set_flashdata('success','Upload vehicle photo success.');
        redirect(base_url().'vehicle');
        
    }
    
    function get_vehicle_details()
    {
        error_reporting(E_ALL);
        $vehicles = $this->appmodel->get_all_records($table = 'sa_vehicle', $array =
            array(
            'rowID' => $this->input->post('rowID'),
            'deleted' => 0,
            'status' => 0), $join_table = '', $join_criteria = '', 'police_no', 'ASC');


        if (!empty($vehicles)) {
            header('Content-Type: application/json');
            foreach ($vehicles as $vehicle) {
                $fare_trip_amounts = $this->fare_trip_model->get_fare_trip_amount($this->input->
                    post('fare_trip_rowID'), $vehicle->vehicle_type);
                //$fare_trip_amounts=number_format($fare_trip_amounts,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));
                $arr[] = array(
                    'vehicle_type_rowID' => $vehicle->vehicle_type,
                    'debtor_rowID' => $vehicle->debtor_rowID,
                    'fare_trip_amounts' => $fare_trip_amounts);
            }
        } else {
            $arr[] = '';
        }
        header('Content-type: application/json');
        echo json_encode($arr);
        exit; // no need to render the template
    }

    function get_vehicle_type_details()
    {
        error_reporting(E_ALL);
        $vehicles = $this->appmodel->get_all_records($table = 'sa_vehicle', $array =
            array(
            'rowID' => $this->input->post('rowID'),
            'deleted' => 0,
            'status' => 0), $join_table = '', $join_criteria = '', 'police_no', 'ASC');


        if (!empty($vehicles)) {
            header('Content-Type: application/json');
            foreach ($vehicles as $vehicle) {
                $fare_trip_amounts = $this->fare_trip_model->get_fare_trip_amount($this->input->
                    post('fare_trip_rowID'), $this->input->post('vehicle_type_rowID'));
                //$fare_trip_amounts=number_format($fare_trip_amounts,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));
                $arr[] = array(
                    'vehicle_type_rowID' => $this->input->post('vehicle_type_rowID'),
                    'debtor_rowID' => $vehicle->debtor_rowID,
                    'fare_trip_amounts' => $fare_trip_amounts);
            }
        } else {
            $arr[] = '';
        }
        header('Content-type: application/json');
        echo json_encode($arr);
        exit; // no need to render the template
    }

    function pdf()
    {
        $data['vehicle'] = $this->vehicle_model->get_pdf();
        $html = $this->load->view('vehicle_pdf', $data, true);
        $this->pdf_generator->generate($html, 'Vehicle',$orientation='Landscape');
    }
    
    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=vehicle.xls");

        $data['vehicle'] = $this->vehicle_model->get_pdf();
        $this->load->view("vehicle_pdf", $data);

    }
}

/* End of file contacts.php */
