<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('home_model');
        $this->load->library('pdf_generator');
        
	}

	function index()
	{
        // START. Jika fungsi upload dihilangkan
		$this->session->set_userdata(array('role_rowID'	=> $this->session->userdata('role_rowID_verify')));
        // END. Hilangkan bagian ini jika fungsi upload kembali digunakan
		
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title(lang('welcome_to').'  '.$this->config->item('website_name'));
		$data['page'] = lang('home');

    	$this->session->unset_userdata('page_header');		
    	$this->session->unset_userdata('page_detail');
   		
        $sql = "SELECT * FROM (`sa_debtor`) WHERE `rowID` > 0 AND `deleted` = 0 AND (`type` = 'D' OR `type` = 'E') ORDER BY `debtor_name` asc";     
        $data_debtor = $this->db->query($sql)->result();
        
        $total_cash_adv = array();
        $total_realization = array();
        
        if(count($data_debtor) > 0){
        
            // Today
            $until_date = date('Y-m-d');
        	foreach($data_debtor as $row){
               $data_cash_adv = $this->home_model->get_sum_data_cb_adv_by_debtor($row->rowID,$until_date);
               $data_realization = $this->home_model->get_sum_data_realization_by_debtor($row->rowID,$until_date);
               
               $total_ca_tmp = $data_cash_adv->total_amount * -1;
               
               $total_ca += $total_ca_tmp;
               $total_rea += $data_realization->total_amount;
               
            }
            
            $url_ca = base_url().'home/view_detail/ca/'.$until_date;
            $url_rea = base_url().'home/view_detail/rea/'.$until_date;
            
            array_push($total_cash_adv,"{y: ".$total_ca.", color: '#d9534f', url:'".$url_ca."'}");
            array_push($total_realization,"{y: ".$total_rea.", color: '#449d44', url:'".$url_rea."'}");
            $total_ca = 0;
            $total_rea = 0;
        
            // -1 days
            $until_date = date('Y-m-d',strtotime('-1 days'));
        	foreach($data_debtor as $row){
               $data_cash_adv = $this->home_model->get_sum_data_cb_adv_by_debtor($row->rowID,$until_date);
               $data_realization = $this->home_model->get_sum_data_realization_by_debtor($row->rowID,$until_date);
               
               $total_ca_tmp = $data_cash_adv->total_amount * -1;
               
               $total_ca += $total_ca_tmp;
               $total_rea += $data_realization->total_amount;
            }
            
            $url_ca = base_url().'home/view_detail/ca/'.$until_date;
            $url_rea = base_url().'home/view_detail/rea/'.$until_date;
            
            array_push($total_cash_adv,"{y: ".$total_ca.", color: '#d9534f', url:'".$url_ca."'}");
            array_push($total_realization,"{y: ".$total_rea.", color: '#449d44', url:'".$url_rea."'}");
            $total_ca = 0;
            $total_rea = 0;
        
            // -2 days
            $until_date = date('Y-m-d',strtotime('-2 days'));
        	foreach($data_debtor as $row){
               $data_cash_adv = $this->home_model->get_sum_data_cb_adv_by_debtor($row->rowID,$until_date);
               $data_realization = $this->home_model->get_sum_data_realization_by_debtor($row->rowID,$until_date);
               
               $total_ca_tmp = $data_cash_adv->total_amount * -1;
               
               $total_ca += $total_ca_tmp;
               $total_rea += $data_realization->total_amount;
               
            }
            
            $url_ca = base_url().'home/view_detail/ca/'.$until_date;
            $url_rea = base_url().'home/view_detail/rea/'.$until_date;
            
            array_push($total_cash_adv,"{y: ".$total_ca.", color: '#d9534f', url:'".$url_ca."'}");
            array_push($total_realization,"{y: ".$total_rea.", color: '#449d44', url:'".$url_rea."'}");
            $total_ca = 0;
            $total_rea = 0;
            
            // -3 days
            $until_date = date('Y-m-d',strtotime('-3 days'));
        	foreach($data_debtor as $row){
               $data_cash_adv = $this->home_model->get_sum_data_cb_adv_by_debtor($row->rowID,$until_date);
               $data_realization = $this->home_model->get_sum_data_realization_by_debtor($row->rowID,$until_date);
               
               $total_ca_tmp = $data_cash_adv->total_amount * -1;
               
               $total_ca += $total_ca_tmp;
               $total_rea += $data_realization->total_amount;
               
            }
            
            $url_ca = base_url().'home/view_detail/ca/'.$until_date;
            $url_rea = base_url().'home/view_detail/rea/'.$until_date;
            
            array_push($total_cash_adv,"{y: ".$total_ca.", color: '#d9534f', url:'".$url_ca."'}");
            array_push($total_realization,"{y: ".$total_rea.", color: '#449d44', url:'".$url_rea."'}");
            $total_ca = 0;
            $total_rea = 0;
            
            // -4 days
            $until_date = date('Y-m-d',strtotime('-4 days'));
        	foreach($data_debtor as $row){
               $data_cash_adv = $this->home_model->get_sum_data_cb_adv_by_debtor($row->rowID,$until_date);
               $data_realization = $this->home_model->get_sum_data_realization_by_debtor($row->rowID,$until_date);
               
               $total_ca_tmp = $data_cash_adv->total_amount * -1;
               
               $total_ca += $total_ca_tmp;
               $total_rea += $data_realization->total_amount;
               
            }
            
            $url_ca = base_url().'home/view_detail/ca/'.$until_date;
            $url_rea = base_url().'home/view_detail/rea/'.$until_date;
            
            array_push($total_cash_adv,"{y: ".$total_ca.", color: '#d9534f', url:'".$url_ca."'}");
            array_push($total_realization,"{y: ".$total_rea.", color: '#449d44', url:'".$url_rea."'}");
            $total_ca = 0;
            $total_rea = 0;
            
            // -5 days
            $until_date = date('Y-m-d',strtotime('-5 days'));
        	foreach($data_debtor as $row){
               $data_cash_adv = $this->home_model->get_sum_data_cb_adv_by_debtor($row->rowID,$until_date);
               $data_realization = $this->home_model->get_sum_data_realization_by_debtor($row->rowID,$until_date);
               
               $total_ca_tmp = $data_cash_adv->total_amount * -1;
               
               $total_ca += $total_ca_tmp;
               $total_rea += $data_realization->total_amount;
               
            }
            
            $url_ca = base_url().'home/view_detail/ca/'.$until_date;
            $url_rea = base_url().'home/view_detail/rea/'.$until_date;
            
            array_push($total_cash_adv,"{y: ".$total_ca.", color: '#d9534f', url:'".$url_ca."'}");
            array_push($total_realization,"{y: ".$total_rea.", color: '#449d44', url:'".$url_rea."'}");
            $total_ca = 0;
            $total_rea = 0;
            
            // -6 days
            $until_date = date('Y-m-d',strtotime('-6 days'));
        	foreach($data_debtor as $row){
               $data_cash_adv = $this->home_model->get_sum_data_cb_adv_by_debtor($row->rowID,$until_date);
               $data_realization = $this->home_model->get_sum_data_realization_by_debtor($row->rowID,$until_date);
               
               $total_ca_tmp = $data_cash_adv->total_amount * -1;
               
               $total_ca += $total_ca_tmp;
               $total_rea += $data_realization->total_amount;
               
            }
            
            $url_ca = base_url().'home/view_detail/ca/'.$until_date;
            $url_rea = base_url().'home/view_detail/rea/'.$until_date;
            
            array_push($total_cash_adv,"{y: ".$total_ca.", color: '#d9534f', url:'".$url_ca."'}");
            array_push($total_realization,"{y: ".$total_rea.", color: '#449d44', url:'".$url_rea."'}");
            $total_ca = 0;
            $total_rea = 0;
        
        }
        
        $data['categories'] = "'".date('d-m-Y')."', '".date('d-m-Y',strtotime("-1 days"))."', '".date('d-m-Y',strtotime("-2 days"))."', 
            '".date('d-m-Y',strtotime("-3 days"))."', '".date('d-m-Y',strtotime("-4 days"))."', '".date('d-m-Y',strtotime("-5 days"))."', 
            '".date('d-m-Y',strtotime("-6 days"))."'";
        $data['total_cash_adv'] = $total_cash_adv;
        $data['total_realization'] = $total_realization;
        
        
        // Chart by Vehicle Category
        if($this->session->userdata('start_date') == '' && $this->session->userdata('end_date') == ''){
            $start_date = date("Y-m-d");
            $end_date = date("Y-m-d");
        }
        else{
            $start_date = $this->session->userdata('start_date');
            $end_date = $this->session->userdata('end_date');
        }
        
        $get_data_vehicle_category = $this->home_model->get_data_cb_adv_vehicle_by_date($start_date,$end_date);
        $value_vehicle_category = array();
        
        if(count($get_data_vehicle_category) > 0){
            $i_vc = 1;
            foreach($get_data_vehicle_category as $row_vc){
                if($i_vc == 1){
                    array_push($value_vehicle_category,"{name: '".$row_vc->type_name."', y: ".$row_vc->jumlah_vehicle.", sliced : true, selected: true}");
                    $i_vc++;
                }
                else{
                    array_push($value_vehicle_category,"{name: '".$row_vc->type_name."', y: ".$row_vc->jumlah_vehicle."}");
                }
            }
        }              
        
        
        // Top Ten Driver
        if($this->session->userdata('start_date') == '' && $this->session->userdata('end_date') == ''){
            $start_date = date("Y-m-d");
            $end_date = date("Y-m-d");
        }
        else{
            $start_date = $this->session->userdata('start_date');
            $end_date = $this->session->userdata('end_date');
        }
        
        $get_data_realization = $this->home_model->get_data_cb_adv_realization_by_date($start_date,$end_date);
        $value_achievement_driver = array();
        
        if(count($get_data_realization) > 0){
            $i_rea = 1;
            foreach($get_data_realization as $row_rea){
                $get_data_pending = $this->home_model->get_data_cb_adv_pending_by_driver_date($row_rea->employee_driver_rowID,$start_date,$end_date);
                if($i_rea == 1){
                    array_push($value_achievement_driver,"{name: '".$row_rea->debtor_name.", Total Tonase ".number_format($row_rea->total_tonase,0,',','.')." and Total CA Pending ".number_format($get_data_pending->total_pending,0,',','.')." ', y: ".$row_rea->total_tonase.", sliced : true, selected: true}");
                    $i_rea++;
                }
                else{
                    array_push($value_achievement_driver,"{name: '".$row_rea->debtor_name.", Total Tonase ".number_format($row_rea->total_tonase,0,',','.')." and Total CA Pending ".number_format($get_data_pending->total_pending,0,',','.')." ', y: ".$row_rea->total_tonase."}");
                }
            }
        }              
        
        $data['vehicle_category'] = $value_vehicle_category;
        $data['achievement_driver'] = $value_achievement_driver;
        
        $data['start_date'] = date('d-m-Y',strtotime($start_date));
        $data['end_date'] = date('d-m-Y',strtotime($end_date));
        
        $this->template
		->set_layout('users')
		->build('home',isset($data) ? $data : NULL);
        
	}
    
    function set_filter(){
       $this->session->set_userdata('start_date',date("Y-m-d",strtotime($this->input->post('start_date'))));
       $this->session->set_userdata('end_date',date("Y-m-d",strtotime($this->input->post('end_date'))));    
       
       redirect(base_url().'home');
    }
    
    function view_detail($value)
    {
        $type = $this->uri->segment(3);
        $until_date = $this->uri->segment(4);
        
        $data['title'] = '';
        $data['until_date'] = $until_date;

        if($type == 'ca'){    
            $data['title'] = 'Cash Advance (CA)';
            $data['data_cash_adv'] = $this->home_model->get_data_cb_adv_by_date($until_date);
            $html = $this->load->view('detail_pdf', $data, true);
        }
        else if($type == 'rea'){
            $data['title'] = 'Realization';
            $data['data_cash_adv'] = $this->home_model->get_data_realization_by_date($until_date);
            $html = $this->load->view('detail_realization_pdf', $data, true);
        }        
        
        $this->pdf_generator->generate($html, 'detail pdf',$orientation='Portrait');
    }
    
	function upload()
	{
		$filename = $this->session->userdata('user_rowID') . $this->session->userdata('username') . date('YmdHis') . '.jpg';
		$result = file_put_contents('./photo/'. $filename, file_get_contents('php://input') );
		if (!$result) {
			print "ERROR: Failed to write data to $filename, check permissions\n";
			exit();
		}
	
		$params['user_rowID'] = $this->session->userdata('user_rowID');
		$params['module'] = 'Capture Photo';
		$params['module_field_id'] = 0;
		$params['activity'] = 'Capture Photo '. $filename;
		$params['icon'] = 'fa-picture-o';
		modules::run('activitylog/log',$params);
		
		$this->session->set_userdata(array('role_rowID'	=> $this->session->userdata('role_rowID_verify')));
		
		//echo modules::run('sidebar/client_menu');

		//$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/' . $filename;
		$url = 'http://' . $_SERVER['HTTP_HOST'] . '/tms_online/photo/' . $filename;
		print "$url\n";
	
	}
	
	function comments()
	{

			redirect('bugs');
		
	}	
	

}
