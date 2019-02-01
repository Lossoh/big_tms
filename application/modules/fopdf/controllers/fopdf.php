<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
**********************************************************************************
* Copyright: gitbench 2014
* Licence: Please check CodeCanyon.net for licence details. 
* More licence clarification available here: htttp://codecanyon.net/wiki/support/legal-terms/licensing-terms/ 
* CodeCanyon User: http://codecanyon.net/user/gitbench
* CodeCanyon Project: http://codecanyon.net/item/freelancer-office/8870728
* Package Date: 2014-09-24 09:33:11 
***********************************************************************************
*/

class Fopdf extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->helper('tes');
		$this->load->helper('testing');
	}
	function invoice(){			
			$data['invoice_details'] = $this->invoice->invoice_details($this->uri->segment(3));
			$data['payment_status'] = $this->invoice->payment_status($this->uri->segment(3));
			$data['invoice_items'] = $this->invoice->invoice_items($this->uri->segment(3));
			$this->load->view('invoice',isset($data) ? $data : NULL);				
	}
	function buatpdf()
    {	require('helpers/req/fpdf/fpdf.php');
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','',12);
        $teks = "Cara Gampang Integrasi FPDF dengan Codeigniter";
        // mencetak 10 baris kalimat dalam variable "teks".
        for( $i=0; $i < 10; $i++ ) {
            $pdf->Cell(0, 5, $teks, 1, 1, 'L'); 
        }
        $pdf->Output();
    }

	function contoh(){			
		//$data['sites']='dsa';	
		//$data['sites'] = $this->AppModel->get_all_record_reference($table = 'mst_reference',
		//$array = array('Type_Ref' => 'sites'),'No_Urut_Ref');
		$this->load->view('testing');				
	}


}

/* End of file Invoicr.php */