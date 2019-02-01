<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Koordinat_poi extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('koordinat_poi_model');
        $this->load->library('pdf_generator');
        $this->load->library("image_lib");
    }
 
    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('koordinat_poi') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('koordinat_poi');
        $this->session->set_userdata('page_header', 'master');
        $this->session->set_userdata('page_detail', 'koordinat_poi');
        $data['datatables'] = true;
        $data['form'] = true;

        $data['koordinat_pois'] = $this->koordinat_poi_model->get_all_records();
        
        $this->template->set_layout('users')->build('koordinat_pois', isset($data) ? $data : null);
    }

    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->koordinat_poi_model->get_by_id($tabel = 'sa_koordinat_poi', $id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function delete_data($id)
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $data = $this->koordinat_poi_model->delete_data($tabel = 'sa_koordinat_poi', $id);
        
        $params['user_rowID'] = $this->tank_auth->get_user_id();
        $params['module'] = 'Koordinat POI';
        $params['module_field_id'] = $id;
        $params['activity'] = ucfirst('Deleted a Koordinat POI with ID = ' . $id);
        $params['icon'] = 'fa-times';
        modules::run('activitylog/log', $params); //log activity

        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }

    function pdf()
    {
        $data['koordinat_pois'] = $this->koordinat_poi_model->get_all_records();
        $html = $this->load->view('koordinat_poi_pdf', $data, true);
        $this->pdf_generator->generate($html, 'koordinat_poi pdf',$orientation='Portrait');
    }
    
    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=koordinat_poi.xls");

        $data['koordinat_pois'] = $this->koordinat_poi_model->get_all_records();
        $this->load->view("koordinat_poi_pdf", $data);

    }

    function create()
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $dataPost = $this->input->post();            

        $dataPost = $this->input->post();
        if (empty($dataPost['rowID'])) {
            $data_koordinat_poi = array(
                'location_name' => ucwords($dataPost['location_name']),
                'latitude' => $dataPost['latitude'],
                'longitude' => $dataPost['longitude'],
                'icon_url' => $dataPost['icon_url'],
                'user_created' => $this->session->userdata('user_id'),
                'date_created' => date('Y-m-d'),
                'time_created' => date('H:i:s')
            );
            
            $this->db->insert('sa_koordinat_poi', $data_koordinat_poi);
            $koordinat_poi_id = $this->db->insert_id();

            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Koordinat POI';
            $params['module_field_id'] = $koordinat_poi_id;
            $params['activity'] = ucfirst('Added a new Koordinat POI with Location Name = ' . ucwords($dataPost['location_name']));
            $params['icon'] = 'fa-plus';
            modules::run('activitylog/log', $params); //log activity

            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('koordinat_poi_registered_successfully')));
            exit();
        } 
        else {
            $data_koordinat_poi = array(
                'location_name' => ucwords($dataPost['location_name']),
                'latitude' => $dataPost['latitude'],
                'longitude' => $dataPost['longitude'],
                'icon_url' => $dataPost['icon_url'],
                'user_modified' => $this->session->userdata('user_id'),
                'date_modified' => date('Y-m-d'),
                'time_modified' => date('H:i:s'),
            );
            $this->db->where('rowID', $dataPost['rowID']);
            $this->db->update('sa_koordinat_poi', $data_koordinat_poi);
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Koordinat POI';
            $params['module_field_id'] = $dataPost['rowID'];
            $params['activity'] = ucfirst('Update a Koordinat POI with ID = '.$dataPost['rowID'].' and Location Name = ' . ucwords($dataPost['location_name']));
            $params['icon'] = 'fa-edit';
            modules::run('activitylog/log', $params); //log activity
            
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('koordinat_poi_edited_successfully')));
            exit();

        }
    }
    
    function upload_image(){
        $dataPost = $this->input->post();
        //echo "<pre>"; print_r($dataPost); echo "</pre>"; exit();
        error_reporting(E_ALL);
        $get_data = $this->koordinat_poi_model->get_by_id($tabel = 'sa_koordinat_poi', $dataPost['upload_rowid']);
        
       	$image_url = "";
        
        $count_image = count($_FILES["userfile"]["name"]);
        $file_name = date('YmdHis').'_'.uniqid().".jpg";

        foreach($_FILES as $key=>$value){
            for($i=0;$i<$count_image;$i++){
                
                $_FILES['userfile']['name'] = $value['name'][$i];
                $_FILES['userfile']['type'] = $value['type'][$i];
                $_FILES['userfile']['tmp_name'] = $value['tmp_name'][$i];
                $_FILES['userfile']['error'] = $value['error'][$i];
                $_FILES['userfile']['size'] = $value['size'][$i];
                
                $config['upload_path'] = './resource/images/poi';
        		$config['allowed_types'] = 'gif|jpg|jpeg|png';
        		$config['max_size'] = '5120';	// 5 MB
                $config['file_name'] = $file_name;
                
        		$this->load->library("upload", $config);
        		
                if($value['name'][$i] != '') {
                    
        			if($this->upload->do_upload()){
        				$file = $this->upload->data();
                        $image_url = $file["file_name"];
                        
                        $config['image_library'] = 'gd2';
    					$config['source_image'] = './resource/images/poi/'.$image_url;
    					$config['new_image'] = './resource/images/poi/'.$image_url;
                        $config['create_thumb'] = FALSE;
    					$config['maintain_ratio'] = FALSE;
    					$config['width'] = 500;
    					$config['height'] = 350;
    					
    					//$this->load->library("image_lib", $config);
                        $this->image_lib->clear();
                        $this->image_lib->initialize($config);
    					
    					if (!$this->image_lib->resize()){
    						$this->session->set_flashdata('error',$this->image_lib->display_errors());
                            redirect(base_url().'koordinat_poi');
    					}
                        else{
                            //unlink('resource/images/debtor_photo/temp/'.$image_url);
                        }
                        
                    }
        			else{
                        $this->session->set_flashdata('error',$this->upload->display_errors());
                        redirect(base_url().'koordinat_poi');
        			}
        		}
                
            }
        }
        
        if($image_url != ''){
            if($get_data->image_url != ''){
                unlink('resource/images/poi/'.$get_data->image_url);
            }
            
            $koordinat_poi_data = array(
                'image_url' => $image_url,
                'user_modified' => $this->session->userdata('user_id'),
                'date_modified' => date('Y-m-d'),
                'time_modified' => date('H:i:s')
            );
                    
            $this->db->where('rowID', $dataPost['upload_rowid']);
            $this->db->update('sa_koordinat_poi', $koordinat_poi_data);
        }
        
        if($image_url != ''){        
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = 'Koordinat POI';
            $params['module_field_id'] = $dataPost['upload_rowid'];
            $params['activity'] = ucfirst('Upload POI image with ID ' . $dataPost['upload_rowid']);
            $params['icon'] = 'fa-upload';
            modules::run('activitylog/log', $params); //log activity
        }
                
        $this->session->set_flashdata('success','Upload POI image success.');
        redirect(base_url().'koordinat_poi');
        
    }
    
}

/* End of file contacts.php */
