<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webcam extends MX_Controller {

public function __construct() {
    parent::__construct();

/* $this->con = new Db_handler();
$this->data['view'] = $this->data['controller'] . '/';
$this->data['MX_BREADCUMB'] = 'AMBIL GAMBAR MELALUI WEBCAM'; */
}

public function index() {
	$this->load->model('welcome','home_model');
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title('Welcome - '.$this->config->item('website_name'));
	$data['page'] = lang('home');
	$data['projects'] = $this->home_model->recent_projects($this->tank_auth->get_user_id(),$limit = 5);
	$data['activities'] = $this->home_model->recent_activities($this->tank_auth->get_user_id(),$limit = 6);
	$this->template
	->set_layout('users')
	->build('index',isset($data) ? $data : NULL);
	
	
/* $this->data['view'] .= $this->data['method'];
$this->parser->parse('templates/default', $this->data); */
}

// fungsi saat pengambilan gambar dan langsung melakukan proses upload
public function upload() {
//$jpg = file_get_contents('php://input');
$jpeg_data = file_get_contents('php://input');

$filename = "./assets/media/uploads/mx_" . mktime() . ".jpg";

$result = file_put_contents($filename, $jpeg_data);
//$r = file_put_contents($filename, $jpg);
echo $filename;
}

}