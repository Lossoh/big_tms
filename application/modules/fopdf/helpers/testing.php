<?php
require_once('req/autoload.php');


class FPDF_AutoWrapTable extends FPDF {
var $total_krm;
var $total_trm;
var $total_diff;

  	private $data = array();
  	private $options = array(
  		'filename' => '',
  		'destinationfile' => '',
  		'paper_size'=>'F4',
  		'orientation'=>'P'
  	);
  	
  	function __construct($data = array(), $options = array()) {
    	parent::__construct();
    	$this->data = $data;
    	$this->options = $options;
	}
	
	public function rptDetailData () {
	for ($x = 0; $x <= 2; $x++) {
		$border = 0;
		$this->AddPage();
		$this->SetAutoPageBreak(true,60);
		$this->AliasNbPages();
		$left = 25;
		$this->SetFillColor(255);
		//header
			//header
			$this->SetFont("", "B", 9);
			$this->Cell(0, 12, 'TIRTA INDRA KENCANA');$this->SetX(-100);
			$this->Cell(0, 12, 'Tanggal',0,0,'',true);$this->SetX(-60);
			$this->Cell(5, 12, ':',0,0,'',true);$this->SetX(-50);
			$this->Cell(10, 12, '11/02/2015',0,1,'',true);
			$this->SetFont("", "B", 9);
			$this->Cell(0, 12, 'JAKARTA');$this->SetX(-100);
			$this->Cell(0, 12, 'Jam',0,0,'',true);$this->SetX(-60);
			$this->Cell(5, 12, ':',0,0,'',true);$this->SetX(-50);
			$this->Cell(10, 12, '16:45:23',0,1,'',true);$this->SetX(-100);
			$this->Cell(0, 12, 'Halaman',0,0,'',true);$this->SetX(-60);
			$this->Cell(5, 12, ':',0,0,'',true);$this->SetX(-50);
			$this->Cell(10, 12, $this->PageNo(),0,1,'',true);

			$this->Cell(0, 1, " ", "B");
			$this->Ln(10);
			$this->SetFont("", "B", 9);
			$this->SetX($left); $this->Cell(0, 10, 'TAGIHAN UNTUK TANDA TERIMA No : 1501177', 0, 1,'C');
			$this->Ln(5);
			$this->SetX($left); $this->Cell(0, 10, 'Nama Barang', 0, 0,'L');
			$this->SetX($left+65); $this->Cell(5, 10, ':', 0, 0,'L');
			$this->SetX($left+80); $this->Cell(30, 10, 'JAGUNG LOUIS DREYFUS', 0, 1,'L');
			$this->SetX($left); $this->Cell(0, 10, 'No P/O', 0, 0,'L');
			$this->SetX($left+65); $this->Cell(5, 10, ':', 0, 0,'L');
			$this->SetX($left+80); $this->Cell(30, 10, '1711060051', 0, 1,'L');
			$this->SetX($left); $this->Cell(0, 10, 'EX Kapal', 0, 0,'L');
			$this->SetX($left+65); $this->Cell(5, 10, ':', 0, 0,'L');
			$this->SetX($left+80); $this->Cell(30, 10, 'GALAXY(PANAMAX)', 0, 1,'L');
			$this->SetX($left); $this->Cell(0, 10, 'Dari', 0, 0,'L');
			$this->SetX($left+65); $this->Cell(5, 10, ':', 0, 0,'L');
			$this->SetX($left+80); $this->Cell(30, 10, 'KAPAL DICIGADING', 0, 1,'L');
			$this->SetX($left); $this->Cell(0, 10, 'Tujuan', 0, 0,'L');
			$this->SetX($left+65); $this->Cell(5, 10, ':', 0, 0,'L');
			$this->SetX($left+80); $this->Cell(30, 10, 'PT. CPI BALARAJA - SHIPMENT(1)', 0, 1,'L');
			$this->SetX($left); $this->Cell(0, 10, 'Angkutan', 0, 0,'L');
			$this->SetX($left+65); $this->Cell(5, 10, ':', 0, 0,'L');
			$this->SetX($left+80); $this->Cell(30, 10, 'PJP', 0, 1,'L');

			$this->Ln(10);
		
		
		$h = 13;
		$left = 40;
		$top = 80;	
		#tableheader
		//$this->SetFillColor(200,200,200);	
		$this->SetFillColor(255);
		$left = $this->GetX();
		$this->Cell(30,$h+23,'NO',1,0,'L',true);
		$this->SetX($left += 20); $this->Cell(75, $h+23, 'No S.J.', 1, 0, 'C',true);
		$this->SetX($left += 75); $this->Cell(50, $h+23, 'Tanggal', 1, 0, 'C',true);
		$this->SetX($left += 50); $this->Cell(50, $h+23, 'No Polisi', 1, 0, 'C',true);
		$this->SetX($left += 50); $this->Cell(100, $h+23, 'Nama Sopir', 1, 0, 'C',true);
		$this->SetX($left += 100); $this->Cell(80, $h+10, 'PENGIRIMAN', 1, 0, 'C',true);
		$this->SetX($left += 80); $this->Cell(80, $h+10, 'PENERIMAAN', 1, 0, 'C',true);
		$this->SetX($left += 80); $this->Cell(80, $h+10, 'SELISIH', 1, 1, 'C',true);

		$h = 13;
		$left = 40;

		#tableheader
		$this->SetFillColor(255);
		//$this->SetFillColor(200,200,200);	
		$left = $this->GetX();
		//$this->Cell(20,$h,'NO',1,0,'L',true);
		$this->SetX($left += 20);// $this->Cell(75, $h, '', 1, 0, 'C',true);
		$this->SetX($left += 75); //$this->Cell(100, $h, 'NAMA', 1, 0, 'C',true);
		$this->SetX($left += 50); //$this->Cell(150, $h, 'ALAMAT', 1, 0, 'C',true);
		$this->SetX($left += 50); //$this->Cell(100, $h, 'EMAIL', 1, 0, 'C',true);
		$this->SetX($left += 100); $this->Cell(30, $h, 'Bag', 1, 0, 'C',true);
		$this->SetX($left += 30); $this->Cell(50, $h, 'Quantity', 1, 0, 'C',true);
		$this->SetX($left += 50); $this->Cell(30, $h, 'Bag', 1, 0, 'C',true);
		$this->SetX($left += 30); $this->Cell(50, $h, 'Quantity', 1, 0, 'C',true);
		$this->SetX($left += 50); $this->Cell(30, $h, 'Bag', 1, 0, 'C',true);
		$this->SetX($left += 30); $this->Cell(50, $h, 'Quantity', 1, 1, 'C',true);
		
		
		
		$this->SetFont('Arial','',8);
		$this->SetWidths(array(20,75,50,50,100,30,50,30,50,30,50));
		$this->SetAligns(array('C','C','C','L','L','C','R','C','R','C','R'));
		$no = 1; $this->SetFillColor(255);
		$total_krm=0;
		$total_trm=0;
		$total_diff=0;
		foreach ($this->data as $baris) {
			$this->Row(
				array($no++, 
				$baris['nosj'], 
				$baris['tgl'], 
				$baris['nopol'], 
				$baris['supir'], 0,
				$baris['QTYKRM'],0,
				$baris['QTYTRM'], 0,
				$baris['QTYDIFF']
			));
			$total_krm+=$baris['QTYKRM'];
			$total_trm+=$baris['QTYTRM'];
			$total_diff+=$baris['QTYDIFF'];
			
		}
		$this->Cell(10, 12, $total_krm,0,1,'',true);
		$this->Cell(10, 12, $total_trm,0,1,'',true);
		$this->Cell(10, 12, $total_diff,0,1,'',true);		
	}
	}

	public function printPDF () {
				
		if ($this->options['paper_size'] == "F4") {
			$a = 8.3 * 72; //1 inch = 72 pt
			$b = 13.0 * 72;
			$this->FPDF($this->options['orientation'], "pt", array($a,$b));
		} else {
			$this->FPDF($this->options['orientation'], "pt", $this->options['paper_size']);
		}
		
	    $this->SetAutoPageBreak(false);
	    $this->AliasNbPages();
	    $this->SetFont("arial", "B", 10);
	    //$this->AddPage();
	
	    $this->rptDetailData();
			    
	    $this->Output($this->options['filename'],$this->options['destinationfile']);
  	}
  	
  	
  	
  	private $widths;
	private $aligns;

	function SetWidths($w)
	{
		//Set the array of column widths
		$this->widths=$w;
	}

	function SetAligns($a)
	{
		//Set the array of column alignments
		$this->aligns=$a;
	}

	function Row($data)
	{
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		$h=15*$nb;
		
		//Issue a page break first if needed
		$this->CheckPageBreak($h);

		//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			//Draw the border
			$this->Rect($x,$y,$w,$h);
			//Print the text
			$this->MultiCell($w,15,$data[$i],0,$a);
			//Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
		}
		//Go to the next line
		$this->Ln($h);
	}

	function CheckPageBreak($h)
	{	
		
		//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger){
			$this->AddPage($this->CurOrientation);
			$this->SetAutoPageBreak(true,60);
			$this->AliasNbPages();
			$left = 25;
			
			//header

			$this->SetFont("", "B", 9);
			$this->Cell(0, 12, 'TIRTA INDRA KENCANA');$this->SetX(-100);
			$this->Cell(0, 12, 'Tanggal',0,0,'',true);$this->SetX(-60);
			$this->Cell(5, 12, ':',0,0,'',true);$this->SetX(-50);
			$this->Cell(10, 12, '11/02/2015',0,1,'',true);
			$this->SetFont("", "B", 9);
			$this->Cell(0, 12, 'JAKARTA');$this->SetX(-100);
			$this->Cell(0, 12, 'Jam',0,0,'',true);$this->SetX(-60);
			$this->Cell(5, 12, ':',0,0,'',true);$this->SetX(-50);
			$this->Cell(10, 12, '16:45:23',0,1,'',true);$this->SetX(-100);
			$this->Cell(0, 12, 'Halaman',0,0,'',true);$this->SetX(-60);
			$this->Cell(5, 12, ':',0,0,'',true);$this->SetX(-50);
			$this->Cell(10, 12, $this->PageNo(),0,1,'',true);
			$this->Cell(10, 12, $this->total,0,1,'',true);
			$this->Cell(0, 1, " ", "B");
			$this->Ln(10);
			$this->SetFont("", "B", 9);
			$this->SetX($left); $this->Cell(0, 10, 'TAGIHAN UNTUK TANDA TERIMA No : 1501177', 0, 1,'C');
			$this->Ln(5);
			$this->SetX($left); $this->Cell(0, 10, 'Nama Barang', 0, 0,'L');
			$this->SetX($left+65); $this->Cell(5, 10, ':', 0, 0,'L');
			$this->SetX($left+80); $this->Cell(30, 10, 'JAGUNG LOUIS DREYFUS', 0, 1,'L');
			$this->SetX($left); $this->Cell(0, 10, 'No P/O', 0, 0,'L');
			$this->SetX($left+65); $this->Cell(5, 10, ':', 0, 0,'L');
			$this->SetX($left+80); $this->Cell(30, 10, '1711060051', 0, 1,'L');
			$this->SetX($left); $this->Cell(0, 10, 'EX Kapal', 0, 0,'L');
			$this->SetX($left+65); $this->Cell(5, 10, ':', 0, 0,'L');
			$this->SetX($left+80); $this->Cell(30, 10, 'GALAXY(PANAMAX)', 0, 1,'L');
			$this->SetX($left); $this->Cell(0, 10, 'Dari', 0, 0,'L');
			$this->SetX($left+65); $this->Cell(5, 10, ':', 0, 0,'L');
			$this->SetX($left+80); $this->Cell(30, 10, 'KAPAL DICIGADING', 0, 1,'L');
			$this->SetX($left); $this->Cell(0, 10, 'Tujuan', 0, 0,'L');
			$this->SetX($left+65); $this->Cell(5, 10, ':', 0, 0,'L');
			$this->SetX($left+80); $this->Cell(30, 10, 'PT. CPI BALARAJA - SHIPMENT(1)', 0, 1,'L');
			$this->SetX($left); $this->Cell(0, 10, 'Angkutan', 0, 0,'L');
			$this->SetX($left+65); $this->Cell(5, 10, ':', 0, 0,'L');
			$this->SetX($left+80); $this->Cell(30, 10, 'PJP', 0, 1,'L');			$this->Ln(10);
		$h = 13;
		$left = 40;
		$top = 80;	
		#tableheader
		//$this->SetFillColor(200,200,200);	
		$this->SetFillColor(255);
		$left = $this->GetX();
		$this->Cell(30,$h+23,'NO',1,0,'L',true);
		$this->SetX($left += 20); $this->Cell(75, $h+23, 'No S.J.', 1, 0, 'C',true);
		$this->SetX($left += 75); $this->Cell(50, $h+23, 'Tanggal', 1, 0, 'C',true);
		$this->SetX($left += 50); $this->Cell(50, $h+23, 'No Polisi', 1, 0, 'C',true);
		$this->SetX($left += 50); $this->Cell(100, $h+23, 'Nama Sopir', 1, 0, 'C',true);
		$this->SetX($left += 100); $this->Cell(80, $h+10, 'PENGIRIMAN', 1, 0, 'C',true);
		$this->SetX($left += 80); $this->Cell(80, $h+10, 'PENERIMAAN', 1, 0, 'C',true);
		$this->SetX($left += 80); $this->Cell(80, $h+10, 'SELISIH', 1, 1, 'C',true);

		$h = 13;
		$left = 40;

		#tableheader
		$this->SetFillColor(255);
		//$this->SetFillColor(200,200,200);	
		$left = $this->GetX();
		//$this->Cell(20,$h,'NO',1,0,'L',true);
		$this->SetX($left += 20);// $this->Cell(75, $h, '', 1, 0, 'C',true);
		$this->SetX($left += 75); //$this->Cell(100, $h, 'NAMA', 1, 0, 'C',true);
		$this->SetX($left += 50); //$this->Cell(150, $h, 'ALAMAT', 1, 0, 'C',true);
		$this->SetX($left += 50); //$this->Cell(100, $h, 'EMAIL', 1, 0, 'C',true);
		$this->SetX($left += 100); $this->Cell(30, $h, 'Bag', 1, 0, 'C',true);
		$this->SetX($left += 30); $this->Cell(50, $h, 'Quantity', 1, 0, 'C',true);
		$this->SetX($left += 50); $this->Cell(30, $h, 'Bag', 1, 0, 'C',true);
		$this->SetX($left += 30); $this->Cell(50, $h, 'Quantity', 1, 0, 'C',true);
		$this->SetX($left += 50); $this->Cell(30, $h, 'Bag', 1, 0, 'C',true);
		$this->SetX($left += 30); $this->Cell(50, $h, 'Quantity', 1, 1, 'C',true);
		$this->SetFont('Arial','',8);
		$this->SetWidths(array(20,75,50,50,100,30,50,30,50,30,50));
		$this->SetAligns(array('C','C','C','L','L','C','R','C','R','C','R'));
		$no = 1; $this->SetFillColor(255);			
		}
	}

	function NbLines($w,$txt)
	{
		//Computes the number of lines a MultiCell of width w will take
		$cw=&$this->CurrentFont['cw'];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		$s=str_replace("\r",'',$txt);
		$nb=strlen($s);
		if($nb>0 and $s[$nb-1]=="\n")
			$nb--;
		$sep=-1;
		$i=0;
		$j=0;
		$l=0;
		$nl=1;
		while($i<$nb)
		{
			$c=$s[$i];
			if($c=="\n")
			{
				$i++;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
				continue;
			}
			if($c==' ')
				$sep=$i;
			$l+=$cw[$c];
			if($l>$wmax)
			{
				if($sep==-1)
				{
					if($i==$j)
						$i++;
				}
				else
					$i=$sep+1;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
			}
			else
				$i++;
		}
		return $nl;
	}
} //end of class


?>