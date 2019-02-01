<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Utility_vehicles extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('utility_vehicles_model');
        $this->load->library('pdf_generator');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('utility_vehicles') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('utility_vehicles');
        $this->session->set_userdata('page_header', 'reports');
        $this->session->set_userdata('page_detail', 'utility_vehicles');
        $data['datatables'] = true;
        $data['form'] = true;
        
        $data['departments'] = $this->utility_vehicles_model->get_data_department();
        
        $this->template->set_layout('users')->build('utility_vehicles', isset($data) ? $data : null);
    }
    
    function print_report(){
        $this->db->trans_begin(); # Starting

        $start_date = date('Y-m-d',strtotime($this->input->post('start_date')));
        $end_date   = date('Y-m-d',strtotime($this->input->post('end_date')));
        $department_id  = $this->input->post('department_id');
        $type       = $this->input->post('type');

        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['str_start_date'] = date('d-m-Y',strtotime($start_date));
        $data['str_end_date'] = date('d-m-Y',strtotime($end_date));
        $data['department_id'] = $department_id;
        $data['type'] = $type;
        
        if($department_id == 'All'){    
            $data['departments'] = $this->utility_vehicles_model->get_data_department();
        
            $html = $this->load->view('all_utility_vehicles_pdf', $data, true);
            $this->pdf_generator->generate($html, 'all utility vehicles pdf',$orientation='Portrait');
        }
        else if($department_id > 0){     
            $table_name = 'utility_vehicles_'.$this->tank_auth->get_username().'_'.date('YmdHis');
	        $sql = '           
                CREATE TABLE '.$table_name.' (
                    rowID INT(6) AUTO_INCREMENT PRIMARY KEY,
                    police_no VARCHAR(15) NOT NULL,
                    vehicle_type VARCHAR(20) NOT NULL,
                    weight double NOT NULL,
                    trip_condition VARCHAR(20) NOT NULL,
                    uang_jalan double NOT NULL,
                    komisi_supir double NOT NULL,
                    komisi_kernet double NOT NULL,
                    total_amt double NOT NULL,
                    trx_no VARCHAR(25) NOT NULL,
                    jo_no VARCHAR(25) NOT NULL,
                    advance_no VARCHAR(25) NOT NULL
                ) 
            ';
            $query = $this->db->query($sql);
		
            $all_data_invoice = $this->utility_vehicles_model->get_data_utility($department_id, $start_date, $end_date);
            if(count($all_data_invoice) > 0){
                foreach($all_data_invoice as $row){
                    $data_temp = array(
                        'police_no' => $row->police_no,
                        'vehicle_type' => $row->vehicle_type,
                        'weight' => $row->weight,
                        'trip_condition' => $row->trip_condition,
                        'uang_jalan' => $row->uang_jalan,
                        'komisi_supir' => $row->komisi_supir,
                        'komisi_kernet' => $row->komisi_kernet,
                        'total_amt' => $row->total_amt,
                        'trx_no' => $row->trx_no,
                        'jo_no' => $row->jo_no,
                        'advance_no' => $row->advance_no
                    );
                    
                    $this->utility_vehicles_model->insert_data($table_name,$data_temp);
                }
            }
            
            $get_data_table_temp = $this->utility_vehicles_model->get_data_police_no_table_temp($table_name);
            $data['get_data_table_temp'] = $get_data_table_temp;
            $data['table_name'] = $table_name;

            $status = $this->db->trans_status();
            if ($status === false)
            {
                $this->db->trans_rollback();
                redirect(base_url('utility_vehicles'));
            } 
            else
            {
                $this->db->trans_commit();
                $html = $this->load->view('utility_vehicles_pdf', $data, true);
                $this->pdf_generator->generate($html, 'utility vehicles pdf',$orientation='Portrait');
                
            }                        
            
        }
        else{
            redirect(base_url('utility_vehicles'));
        }
        
    }
    
}

/* End of file contacts.php */
