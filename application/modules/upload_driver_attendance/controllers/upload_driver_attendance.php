<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Upload_driver_attendance extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('upload_driver_attendance_model');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('upload_driver_attendance') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('upload_driver_attendance');
        $this->session->set_userdata('page_header', 'transaction');
        $this->session->set_userdata('page_detail', 'upload_driver_attendance');
        $data['datatables'] = true;
        $data['form'] = true;
        
        $data['departements'] = $this->upload_driver_attendance_model->get_all_departement();
        
        $this->template->set_layout('users')->build('upload_driver_attendances', isset($data) ? $data : null);
    }
    
    function upload_attendance(){
        $terminal_id = $this->input->post('terminal_id');
        
        if($_FILES['file']['name'] != '')
        {
            $file = rand(1000,100000)."_".$_FILES['file']['name'];
            $file_loc = $_FILES['file']['tmp_name'];
            $file_size = $_FILES['file']['size'];
            $file_type = $_FILES['file']['type'];
            
            $handle = fopen($file_loc, "r") or die("file cannot open");
            if ($handle) {
                while (($line = fgets($handle)) !== false) 
                {
                    $lineArr = explode("\t", "$line");    

                    $result = $this->upload_driver_attendance_model->insert_file_content($lineArr,$terminal_id);    
                }
                if (fclose($handle)) {
                    $this->session->set_flashdata('success','Uploading data success');
                    redirect(base_url().'upload_driver_attendance');
                }

            } 
            else{
                $this->session->set_flashdata('error','File cannot open');
                redirect(base_url().'upload_driver_attendance');
            } 
            
            /*
            $folder = "file_attachment/driver_attendance/";
            $location = $_FILES['file'];
        
            $new_size = $file_size/1024;  
            $new_file_name = strtolower($file);
            $final_file=str_replace(' ','_',$new_file_name);
            $new_name = $folder.$final_file;
            
            if(!move_uploaded_file($final_file,$new_name)){ # Change This
                $this->session->set_flashdata('error','Error in upload');
                redirect(base_url().'upload_driver_attendance');
            }
            else{
    
                $file_uploded = base_url().'file_attachment/driver_attendance/'.$file;
    
                if (!file_exists($file_uploded)) {
                    $this->session->set_flashdata('error','File not exist');
                    redirect(base_url().'upload_driver_attendance');
                }
                else
                {
                    $handle = fopen($file_uploded, "r") or die("file cannot open");
    
                    if ($handle) {
                        while (($line = fgets($handle)) !== false) 
                        {
                            $lineArr = explode("\t", "$line");    
    
                            $result = $this->upload_driver_attendance_model->insert_file_content($lineArr,$terminal_id);    
                        }
                        if (fclose($handle)) {
                            $this->session->set_flashdata('success','Uploading data success');
                            redirect(base_url().'upload_driver_attendance');
                        }
    
                    } 
                    else{
                        $this->session->set_flashdata('error','File cannot open');
                        redirect(base_url().'upload_driver_attendance');
                    } 
                }
            }    
            */  
        }
        else
        {
            $this->session->set_flashdata('error','No file selected');
            redirect(base_url().'upload_driver_attendance');
        }
        
    }
    
}

/* End of file contacts.php */
