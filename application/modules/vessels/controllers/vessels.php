<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Vessels extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('vessels_model','vessel');
		require_once('Classes/PHPExcel.php');
        require_once('Classes/PHPExcel/PHPExcel_IOFactory.php');
		require_once('Classes/PHPExcel/Writer/PHPExcel_Writer_Excel2007.php');
		require_once('Classes/PHPExcel/Writer/PHPExcel_Writer_Excel5.php');

	}

	function index()
	{
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title(lang('vessels').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
	$data['page'] = lang('vessels');
	$data['datatables'] = TRUE;
	$data['form'] = TRUE;
	$this->session->set_userdata('page_header', 'transaction');		
	$this->session->set_userdata('page_detail', 'vessels');
	$data['vessel_status'] = $this->AppModel->get_all_record_reference($table = 'mst_reference',
				$array = array('Type_Ref' => 'vessel_status'),'No_Urut_Ref');
				
	$data['vessels'] = $this->AppModel->get_all_records_limit($table = 'mst_vessels',
		$array = array(
			'vessel_id >' => 0, 'vessel_status <' => 2,  'deleted' => 0
			),
		$join_table = 'mst_reference',$join_criteria = 'mst_reference.No_Urut_Ref = mst_vessels.vessel_status AND fx_mst_reference.Type_Ref="vessel_status"','vessel_ref',10);

	$data['vessel_lists'] = $this->AppModel->get_all_records($table = 'mst_vessels',
		$array = array('vessel_id >' => 0,  'deleted' => 0),
		$join_table = 'mst_reference',$join_criteria = 'mst_reference.No_Urut_Ref = mst_vessels.vessel_status AND fx_mst_reference.Type_Ref="vessel_status"','vessel_ref');
		
	$data['create_vessel']=	$this->vessel->get_idbool($table = 'mst_usermenu',
			$array = array('company_code' => 1, 'site_code' => 1, 'id' => $this->session->userdata('user_id'), 'Kd_Menu' => 10,'actived' => 1),'Created');
			
	$this->template
	->set_layout('users')
	->build('vessels',isset($data) ? $data : NULL);
	}

	function search()
	{
		if ($this->input->post()) {
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title(lang('vessels').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
	$data['page'] = lang('vessels');
	$keyword = $this->input->post('keyword', TRUE);
	$data['vessels'] = $this->vessel->search_estimate($keyword);
	$this->template
	->set_layout('users')
	->build('vessels',isset($data) ? $data : NULL);
		}else{
			redirect('vessels');
		}
	}
	
	function view_by_status()
	{
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title(lang('vessels').' - '.$this->config->item('website_name'). ' '. $this->config->item('version'));
	$data['page'] = lang('vessels');
	$data['form'] = TRUE;
	$data['vessel_status'] = $this->AppModel->get_all_record_reference($table = 'mst_reference',
				$array = array('Type_Ref' => 'vessel_status'),'No_Urut_Ref');
	if($this->uri->segment(3)==''){	
		$data['vessels'] = $this->AppModel->get_all_records_limit($table = 'mst_vessels',
		$array = array(
			'vessel_id >' => 0, 'deleted' => 0
			),
		$join_table = 'mst_reference',$join_criteria = 'mst_reference.No_Urut_Ref = mst_vessels.vessel_status AND fx_mst_reference.Type_Ref="vessel_status"','vessel_ref', 10);
	}else{
	$data['vessels'] = $this->AppModel->get_all_records_limit($table = 'mst_vessels',
		$array = array(
			'vessel_id >' => 0, 'vessel_status' => $this->uri->segment(3) , 'deleted' => 0
			),
		$join_table = 'mst_reference',$join_criteria = 'mst_reference.No_Urut_Ref = mst_vessels.vessel_status AND fx_mst_reference.Type_Ref="vessel_status"','vessel_ref',10);
		}
	$this->template
	->set_layout('users')
	->build('vessels',isset($data) ? $data : NULL);
	}

 

public function exportxls(){ 
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);





// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Jhoni")
							 ->setLastModifiedBy("Jhoni")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Hello')
            ->setCellValue('B2', 'world!')
            ->setCellValue('C1', 'Hello')
            ->setCellValue('D2', 'world!');

// Miscellaneous glyphs, UTF-8
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Miscellaneous glyphs')
            ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="01simple.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

}
	function _log_bug_activity($vessel_id,$activity,$icon){
			$this->db->set('module', 'vessels');
			$this->db->set('module_field_id', $vessel_id);
			$this->db->set('user', $this->tank_auth->get_user_id());
			$this->db->set('activity', $activity);
			$this->db->set('icon', $icon);
			$this->db->insert('activities'); 
	}	
}
