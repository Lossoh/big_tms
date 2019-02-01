<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Vehicle_monitor extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('vehicle_monitor_model');
        $this->load->library('googlemaps');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('vehicle_monitor') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('vehicle_monitor');
        $this->session->set_userdata('page_header', 'monitoring');
        $this->session->set_userdata('page_detail', 'vehicle_monitor');
        $data['datatables'] = true;
        $data['form'] = true;
                        
        // Initialize
        $config['center'] = "";
        $config['zoom'] = 'auto';
        $this->googlemaps->initialize($config);
        
        // Koordinat Vehicle
        $get_coordinat_vehicle = $this->vehicle_monitor_model->get_position_vehicle();
        foreach($get_coordinat_vehicle as $row_vehicle){
            $status = '';
            if($row_vehicle->status == '11' && $row_vehicle->speed > 0 ){
                $status = 'Jalan';
                $color = "5CB85C";
            }
            else if($row_vehicle->status == '11' && $row_vehicle->speed <= 0 ){
                $status = 'Macet/Antri/Parkir';
                $color = "EAC545";
            }
            else if($row_vehicle->status == '01' && $row_vehicle->speed <= 0 ){
                $status = 'Makan AKI';
                $color = "57B9F8";
            }
            else if($row_vehicle->status == '00' && $row_vehicle->speed <= 0 ){
                $status = 'Berhenti';
                $color = "F94C4C";
            }
            else if($row_vehicle->status == '10' && $row_vehicle->speed > 0 ){
                $status = 'Check Instalasi ACC & Engine';
                $color = "000000";
            }
            else if($row_vehicle->status == '10' && $row_vehicle->speed <= 0 ){
                $status = 'Mohon diperiksa';
                $color = "1BDAC5";
            }
            else{
                $status = 'Data Tidak Tersedia';
                $color = "B0B0B0";
            }
            
            if($status != 'Data Tidak Tersedia'){
                if(date('Y-m-d',strtotime($row_vehicle->datetime_gps)) != date('Y-m-d')){
                    $status = 'Out Of The Date';
                    $color = "B0B0B0";
                }
            }
            
            $police_no = $row_vehicle->police_no;
            $speed = empty($row_vehicle->speed) ? 0 : $row_vehicle->speed;
            
            $get_destination = $this->vehicle_monitor_model->get_destination_data($row_vehicle->vehicle_id);
            $destination = $get_destination->fare_trip_cd == '' ? '-' : $get_destination->fare_trip_cd.' ('.date('d-m-Y',strtotime($get_destination->advance_date)).')';
            
            $marker = array();
            $marker['position'] = $row_vehicle->latitude.','.$row_vehicle->longitude;
            $marker['infowindow_content'] = "<a href='javascript:void()' onclick='showImageVehicle(\"".$row_vehicle->vehicle_photo."\")'>".$police_no.'</a><br />'.$destination.'<br />'.$status.' ('.$speed.' km/h) <br />'.$row_vehicle->time_gps;
            $marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld='.str_replace(' ','',$police_no).'|'.$color.'|000000';
            $this->googlemaps->add_marker($marker);
        }
        
        // Coordinat POI
        $get_coordinat = $this->vehicle_monitor_model->get_coordinates();
        foreach($get_coordinat as $row_poi){
            $marker = array();
            $marker['position'] = $row_poi->latitude.','.$row_poi->longitude;
            $marker['infowindow_content'] = $row_poi->location_name."<br /> <a href='javascript:void()' onclick='showImagePOI(\"".$row_poi->image_url."\")'>- Show Image -</a>";
            if($row_poi->icon_url == ''){
                $marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_icon&chld=home|990000|000000';                
            }
            else{
                $marker['icon'] = $row_poi->icon_url; 
            }

            $this->googlemaps->add_marker($marker);            
        }
        
        $data['map'] = $this->googlemaps->create_map();
        
        $this->template->set_layout('users')->build('view_map', isset($data) ? $data : null);
    }
    
    function view_interval_map()
    {
                        
        // Initialize
        $config['center'] = "";
        $config['zoom'] = 'auto';
        $this->googlemaps->initialize($config);
        
        // Koordinat Vehicle
        $get_coordinat_vehicle = $this->vehicle_monitor_model->get_position_vehicle();
        foreach($get_coordinat_vehicle as $row_vehicle){
            $status = '';
            if($row_vehicle->status == '11' && $row_vehicle->speed > 0 ){
                $status = 'Jalan';
                $color = "5CB85C";
            }
            else if($row_vehicle->status == '11' && $row_vehicle->speed <= 0 ){
                $status = 'Macet/Antri/Parkir';
                $color = "EAC545";
            }
            else if($row_vehicle->status == '01' && $row_vehicle->speed <= 0 ){
                $status = 'Makan AKI';
                $color = "57B9F8";
            }
            else if($row_vehicle->status == '00' && $row_vehicle->speed <= 0 ){
                $status = 'Berhenti';
                $color = "F94C4C";
            }
            else if($row_vehicle->status == '10' && $row_vehicle->speed > 0 ){
                $status = 'Check Instalasi ACC & Engine';
                $color = "000000";
            }
            else if($row_vehicle->status == '10' && $row_vehicle->speed <= 0 ){
                $status = 'Mohon diperiksa';
                $color = "1BDAC5";
            }
            else{
                $status = 'Data Tidak Tersedia';
                $color = "B0B0B0";
            }
            
            if($status != 'Data Tidak Tersedia'){
                if(date('Y-m-d',strtotime($row_vehicle->datetime_gps)) != date('Y-m-d')){
                    $status = 'Out Of The Date';
                    $color = "B0B0B0";
                }
            }
            
            $police_no = $row_vehicle->police_no;
            $speed = empty($row_vehicle->speed) ? 0 : $row_vehicle->speed;
            
            $marker = array();
            $marker['position'] = $row_vehicle->latitude.','.$row_vehicle->longitude;
            $marker['infowindow_content'] = $police_no.'<br />'.$status.' ('.$speed.' km/h)';
            $marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld='.str_replace(' ','',$police_no).'|'.$color.'|000000';
            $this->googlemaps->add_marker($marker);
        }
           
        // Coordinat POI
        $get_coordinat = $this->vehicle_monitor_model->get_coordinates();
        foreach($get_coordinat as $row_poi){
            $marker = array();
            $marker['position'] = $row_poi->latitude.','.$row_poi->longitude;
            $marker['infowindow_content'] = $row_poi->location_name;
            //$marker['draggable'] = TRUE;
            //$marker['animation'] = 'DROP';
            $marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_icon&chld=home|990000|000000';
            $this->googlemaps->add_marker($marker);            
        }
        
        $data['map'] = $this->googlemaps->create_map();
        
        $this->load->view('view_interval_map', $data);
    }
    
}

/* End of file contacts.php */
