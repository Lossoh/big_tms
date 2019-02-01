<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Part_service extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('part_service_model');
        $this->load->library('pdf_generator');
    }
 
    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('part_service') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('part_service');
        $this->session->set_userdata('page_header', 'master');
        $this->session->set_userdata('page_detail', 'part_service');
        $data['datatables'] = true;
        $data['form'] = true;

        $data['services'] = $this->part_service_model->get_all_records_by_type('service');
        $data['materials'] = $this->part_service_model->get_all_records_by_type('material');
        $data['parts'] = $this->part_service_model->get_all_records_by_type('part');
        $data['templates'] = $this->part_service_model->get_all_records_by_type('template');
        $data['brands'] = $this->part_service_model->get_data_table('sa_brand','brand_name','asc');
        $data['uoms'] = $this->part_service_model->get_data_table('sa_uom','uom_cd','asc');
        
        $this->template->set_layout('users')->build('part_services', isset($data) ? $data : null);
    }

    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->part_service_model->get_by_id($tabel = 'sa_part_service_hdr', $id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function get_data_template()
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->part_service_model->get_data_template($this->input->post('code'));
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function get_data_service(){
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $hasil = $this->part_service_model->get_data_service_by_code($this->input->post('service_code'));
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function delete_data($id)
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $get_data = $this->part_service_model->get_by_id('sa_part_service_hdr', $id);
        
        $data = $this->part_service_model->delete_data($tabel = 'sa_part_service_hdr', $id);
        
        $get_data_template = $this->part_service_model->get_data_template($get_data->code);
        if(count($get_data_template) > 0){
            $this->part_service_model->delete_data_template($get_data->code);
        }
        
        $params['user_rowID'] = $this->tank_auth->get_user_id();
        $params['module'] = lang('part_service');
        $params['module_field_id'] = $id;
        $params['activity'] = ucfirst('Delete a '.lang('part_service').' with ID = ' . $id);
        $params['icon'] = 'fa-times';
        modules::run('activitylog/log', $params); //log activity

        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }

    function pdf()
    {
        $data['services'] = $this->part_service_model->get_all_records_by_type('service');
        $data['materials'] = $this->part_service_model->get_all_records_by_type('material');
        $data['parts'] = $this->part_service_model->get_all_records_by_type('part');
        $data['templates'] = $this->part_service_model->get_all_records_by_type('template');

        $html = $this->load->view('part_service_pdf', $data, true);
        $this->pdf_generator->generate($html, 'part_service pdf',$orientation='Portrait');
    }
    
    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=part_service.xls");

        $data['services'] = $this->part_service_model->get_all_records_by_type('service');
        $data['materials'] = $this->part_service_model->get_all_records_by_type('material');
        $data['parts'] = $this->part_service_model->get_all_records_by_type('part');
        $data['templates'] = $this->part_service_model->get_all_records_by_type('template');

        $this->load->view("part_service_pdf", $data);

    }

    function create()
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $dataPost = $this->input->post();            

        $dataPost = $this->input->post();
        if (empty($dataPost['rowID'])) {
            $sa_spec_prefix = '';
            if($dataPost['type'] == 'part')
                $sa_spec_prefix = 'PRT';
            elseif($dataPost['type'] == 'material')
                $sa_spec_prefix = 'MTR';
            elseif($dataPost['type'] == 'service')
                $sa_spec_prefix = 'SVS';
            elseif($dataPost['type'] == 'template')
                $sa_spec_prefix = 'TMP';
            
            $max_row_no = ((int)$this->AppModel->select_max_id('sa_part_service_hdr',$array = array('type'=>$dataPost['type'], 'deleted' =>0),'row_no'))+1;
            $code = $sa_spec_prefix.sprintf("%06s",$max_row_no);

            $data_part_service = array(
                'type' => $dataPost['type'],
                'row_no' => $max_row_no,
                'code' => $code,
                'name' => ucwords($dataPost['name']),
                'work_hours' => $dataPost['work_hours'],
                'flat_rate' => str_replace('.','',$dataPost['flat_rate']),
                'moving_type' => $dataPost['moving_type'],
                'variant' => $dataPost['variant'],
                'brand_rowID' => empty($dataPost['brand_rowID']) ? '0' : $dataPost['brand_rowID'],
                'uom_rowID' => empty($dataPost['uom_rowID']) ? '0' : $dataPost['uom_rowID'],
                'discount_type' => $dataPost['discount_type'],
                'discount' => str_replace('.','',$dataPost['discount']),
                'sale_price' => str_replace('.','',$dataPost['sale_price']),
                'hpp' => str_replace('.','',$dataPost['hpp']),
                'reorder' => str_replace('.','',$dataPost['reorder']),
                'last_stock' => str_replace('.','',$dataPost['last_stock']),
                'user_created' => $this->session->userdata('user_id'),
                'date_created' => date('Y-m-d'),
                'time_created' => date('H:i:s')
            );
            
            $this->db->insert('sa_part_service_hdr', $data_part_service);
            $part_service_id = $this->db->insert_id();
            
            if(!empty($dataPost['service_code'])){
                $countTemplate = count($dataPost['service_code']);
                $service_code = $dataPost['service_code'];
                $work_hours_template = $dataPost['work_hours_template'];
                $flat_rate_template = $dataPost['flat_rate_template'];
                
                for($i=0;$i<$countTemplate;$i++){
                    $data_template_service = array(
                        'code' => $code,
                        'service_code' => $service_code[$i],
                        'work_hours_template' => $work_hours_template[$i],
                        'flat_rate_template' => str_replace('.','',$flat_rate_template[$i]),
                        'user_created' => $this->session->userdata('user_id'),
                        'date_created' => date('Y-m-d'),
                        'time_created' => date('H:i:s')
                    );
            
                    $this->db->insert('sa_template_service', $data_template_service);
                }
                
            }

            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = lang('part_service');
            $params['module_field_id'] = $part_service_id;
            $params['activity'] = ucfirst('Added a new '.lang('part_service').' with '.ucfirst($dataPost['type']).' Name = ' . ucwords($dataPost['name']));
            $params['icon'] = 'fa-plus';
            modules::run('activitylog/log', $params); //log activity

            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('saving_part_service_successfully')));
            exit();
        } 
        else {
            $get_data = $this->part_service_model->get_by_id('sa_part_service_hdr', $dataPost['rowID']);
            
            $data_part_service = array(
                'name' => ucwords($dataPost['name']),
                'work_hours' => $dataPost['work_hours'],
                'flat_rate' => str_replace('.','',$dataPost['flat_rate']),
                'moving_type' => $dataPost['moving_type'],
                'variant' => $dataPost['variant'],
                'brand_rowID' => empty($dataPost['brand_rowID']) ? '0' : $dataPost['brand_rowID'],
                'uom_rowID' => empty($dataPost['uom_rowID']) ? '0' : $dataPost['uom_rowID'],
                'discount_type' => $dataPost['discount_type'],
                'discount' => str_replace('.','',$dataPost['discount']),
                'sale_price' => str_replace('.','',$dataPost['sale_price']),
                'hpp' => str_replace('.','',$dataPost['hpp']),
                'reorder' => str_replace('.','',$dataPost['reorder']),
                'last_stock' => str_replace('.','',$dataPost['last_stock']),
                'user_modified' => $this->session->userdata('user_id'),
                'date_modified' => date('Y-m-d'),
                'time_modified' => date('H:i:s'),
            );
            $this->db->where('rowID', $dataPost['rowID']);
            $this->db->update('sa_part_service_hdr', $data_part_service);
            
            $data_deleted_template_service = array(
                'deleted' => 1,
                'user_deleted' => $this->session->userdata('user_id'),
                'date_deleted' => date('Y-m-d'),
                'time_deleted' => date('H:i:s')
            );
            $this->db->where('deleted', 0);
            $this->db->where('code', $get_data->code);
            $this->db->update('sa_template_service', $data_deleted_template_service);
            
            if(!empty($dataPost['service_code'])){
                $countTemplate = count($dataPost['service_code']);
                $template_rowID = $dataPost['template_rowID'];
                $service_code = $dataPost['service_code'];
                $work_hours_template = $dataPost['work_hours_template'];
                $flat_rate_template = $dataPost['flat_rate_template'];
                
                for($i=0;$i<$countTemplate;$i++){
                    if(empty($template_rowID[$i])){
                        $data_template_service = array(
                            'code' => $get_data->code,
                            'service_code' => $service_code[$i],
                            'work_hours_template' => $work_hours_template[$i],
                            'flat_rate_template' => str_replace('.','',$flat_rate_template[$i]),
                            'user_created' => $this->session->userdata('user_id'),
                            'date_created' => date('Y-m-d'),
                            'time_created' => date('H:i:s')
                        );
                
                        $this->db->insert('sa_template_service', $data_template_service);
                        
                    }
                    else{
                        $data_template_service = array(
                            'service_code' => $service_code[$i],
                            'work_hours_template' => $work_hours_template[$i],
                            'flat_rate_template' => str_replace('.','',$flat_rate_template[$i]),
                            'user_modified' => $this->session->userdata('user_id'),
                            'date_modified' => date('Y-m-d'),
                            'time_modified' => date('H:i:s'),
                            'deleted' => 0,
                            'user_deleted' => 0,
                            'date_deleted' => '0000-00-00',
                            'time_deleted' => '0000-00-00'
                        );
                        $this->db->where('rowID', $template_rowID[$i]);
                        $this->db->update('sa_template_service', $data_template_service);
                        
                    }
                }
                
            }
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = lang('part_service');
            $params['module_field_id'] = $dataPost['rowID'];
            $params['activity'] = ucfirst('Update a '.lang('part_service').' with ID = '.$dataPost['rowID'].' and '.ucfirst($dataPost['type']).' Name = ' . ucwords($dataPost['name']));
            $params['icon'] = 'fa-edit';
            modules::run('activitylog/log', $params); //log activity
            
            Header('Content-Type: application/json; charset=UTF8');
            echo json_encode(array("success" => true, 'msg' => lang('saving_part_service_successfully')));
            exit();

        }
    }
    
    function create_template()
    {
        $dataPost = $this->input->post();
        //echo "<pre>"; print_r($dataPost); echo "</pre>"; exit();
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $error = false;
        $result = true;
        $this->db->trans_begin();
        
        $code = $dataPost['code_template'];
        $get_data = $this->part_service_model->get_data_template($code);
        if(count($get_data) > 0){
            $result = $this->part_service_model->delete_data_template($code);
            if (!$result){
                $error = true;
            }
        }
        
        if(empty($dataPost['job_description'])){
            $countDetail = 0;                
        }
        else{
            $countDetail = count($dataPost['job_description']);
            $job_description = $dataPost['job_description'];
            $long_work = $dataPost['long_work'];
        }
        
        if ($result){
            for($i=0;$i<$countDetail;$i++){
                $data_template = array(
                    'code' => $code,
                    'job_description' => ucfirst($job_description[$i]),
                    'long_work' => $long_work[$i],
                    'user_created' => $this->session->userdata('user_id'),
                    'date_created' => date('Y-m-d'),
                    'time_created' => date('H:i:s')
                );
                
                $result = $this->db->insert('sa_template_service', $data_template);
                if (!$result){
                    $error = true;
                    break;
                }
                               
            }
        }
        
        Header('Content-Type: application/json; charset=UTF8');
        $status = $this->db->trans_status();
        if ($status === false || $error == true){
            $this->db->trans_rollback();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
			$params['module'] = 'ERROR ROLLBACK Invoice';
			$params['module_field_id'] = 0;
			$params['activity'] = ucfirst('Deleted a Template Service with Code No '.$code);
			$params['icon'] = 'fa-exclamation-triangle';
			modules::run('activitylog/log',$params);
            
            echo json_encode(array('success' => false, 'msg' => "Failed Data RollBack"));
            exit();
        }
        else{
            $this->db->trans_commit();
            
            $params['user_rowID'] = $this->tank_auth->get_user_id();
            $params['module'] = lang('part_service');
            $params['module_field_id'] = 0;
            $params['activity'] = ucfirst('Added a Template Service with Code No ' . $code);
            $params['icon'] = 'fa-plus';
            modules::run('activitylog/log', $params); //log activity

            echo json_encode(array("success" => true, 'msg' => lang('created_succesfully')));
            exit();
        }
    

    }
    
}

/* End of file contacts.php */
