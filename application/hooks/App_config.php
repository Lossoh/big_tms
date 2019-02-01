<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Author Message
|--------------------------------------------------------------------------
|
| Set config variables using DB
| 
*/
  //Loads configuration from database into global CI config
  function load_config()
  {
	$CI =& get_instance();
	foreach($CI->HookModel->get_config()->result() as $site_config)
	{
		$CI->config->set_item($site_config->config_key,$site_config->value);
	}
   
	foreach($CI->HookModel->get_company()->result() as $company)
	{
		$CI->config->set_item($company->company_config,$company->company_value);
	}
   
   	if($CI->config->item('timezone'))
	{
		date_default_timezone_set($CI->config->item('timezone'));
	}
	
    // Cek ketika belum login
    if($CI->uri->segment(1) != 'auth' && $CI->uri->segment(2) != 'api_insert_attendance_queue' && $CI->uri->segment(2) != 'api_get_data_queue'){
        if (!$CI->tank_auth->is_logged_in()) {
    		$CI->session->set_flashdata('message',lang('login_required'));
    		redirect('auth/login');
    	}
    }
    
    // Delete Queue
    $queue_limit = $CI->config->item('limit_queue');
    $get_all_queue = $CI->HookModel->get_all_queue();

    foreach($get_all_queue as $row_q){
        $diff = strtotime(date('Y-m-d H:i:s')) - strtotime($row_q->date_created);
        
        if($diff > $queue_limit){
            $get_data_cash_adv = $CI->HookModel->get_cash_advance_by_debtor_rowID($row_q->debtor_id);
            $total_balance = 0;
            if(count($get_data_cash_adv) > 0){
                foreach($get_data_cash_adv as $row_cash){
                    $total_balance += $row_cash->advance_balance;
                }
            }
                    
            if($total_balance == 0){
                $get_queue = $CI->HookModel->get_queue($row_q->debtor_id);
                if(count($get_queue) > 0){
                    foreach($get_queue as $row_queue){
                        $data_log_queue = array(
                            'debtor_id' => $row_queue->debtor_id,
                            'absent_code' => 'P',
                            'note'  => 'Log from queue',
                            'type_finger' => $row_queue->type_finger,
                            'user_modified' => $row_queue->user_modified,
                            'date_modified' => $row_queue->date_modified,
                            'user_created' => $CI->session->userdata('user_rowID'),
                            'date_created' => $row_queue->date_created,
                            'date_transfer' => date('Y-m-d H:i:s')
                        );
                        
                        $CI->HookModel->insert_log($data_log_queue);
                    }
                    
                    $CI->HookModel->delete_queue($row_q->debtor_id);
                }
            }
        }
    }
    
    // Delete Spare Driver
    $get_spare_driver = $CI->HookModel->get_spare_driver();
    if(count($get_spare_driver) > 0){
        foreach($get_spare_driver as $row_driver){
            if(strtotime($row_driver->active_period) < strtotime(date('Y-m-d'))){
                
                $cek_data = $CI->HookModel->get_attendance_daily_by_debtor($row_driver->rowID);
                if(count($cek_data) == 0){
                    $data_attendance = array(
                        'debtor_id' => $row_driver->rowID,
                        'absent_code' => 'B',
                        'note'  => 'Spare driver has passed the active period',
                        'type_finger' => '',
                        'user_modified' => '',
                        'date_modified' => '',
                        'user_created' => $CI->session->userdata('user_rowID'),
                        'date_created' => date('Y-m-d H:i:s'),
                        'date_transfer' => ''
                    );
                    
                    $CI->HookModel->insert_log($data_attendance);
                    
                    // Delete Queue
                    $CI->HookModel->delete_queue($row_driver->rowID);
                }
                
            }
        }
        
    }
    
    
  }
?>