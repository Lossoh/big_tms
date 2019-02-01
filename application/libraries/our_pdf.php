<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
include_once(APPPATH . 'libraries/fpdf/fpdf.php'); 
class our_pdf extends FPDF{
	var $widths;
	var $aligns;
	var $colMerges;//kolom" yg akan dimerge row nya utk kebutuhan rowWithMerge

	//buat html------------
	//variables of html parser
	var $B=0;
	var $I=0;
	var $U=0;
	var $HREF='';
	var $fontList=array("arial","times","courier","helvetica","symbol");
	var $issetfont=false;
	var $issetcolor=false;
	var $tableborder=0;
    var $tdbegin=false;
    var $tdwidth=0;
    var $tdheight=0;
    var $dalign="L";
    var $tdbgcolor=false;

	var $oldx=0;
    var $oldy=0;
	//end buat html------------
	
	function Header(){
		//Arial bold 15
		$this->SetFont('courier','B',14);
		//Calculate width of title and position
		$w=$this->GetStringWidth($this->title)+6;
		//$this->SetX((210-$w)/2);
		$this->SetX(5);
		//Colors of frame, background and text
		$this->SetDrawColor(0,0,0);
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0,0,0);
		//Thickness of frame (1 mm)
		$this->SetLineWidth(1);
		//Title
		$this->Cell($w,0,$this->title,0,0,'C',true);
		//Line break
		$this->Ln(50);
	}

	function Footer()  {
	    $today=date('d/m/y h:i');
		//To be implemented in your own inherited class
		//Geser posisi ke 1,5 cm dari bawah
		$this->SetY(-5);
		$this->SetX(1);
		//Pilih font Arial italic 8
		
		$this->SetFont('courier','',8);
		//Tampilkan nomor halaman rata tengah
		$this->Cell(0,1,"Dicetak : ".$today);
		//$this->Cell(0,1,'page'.$this->PageNo(),0,0,'C');
		//$this->Cell(0,1,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		$this->Cell(0,1,'Hal '.$this->PageNo().' dari '.'{nb}',0,0,'C');
    }
	
	//$actwidth  = jarak koordinal X sesudah kolum yang di multicell
	function WrapOld($w, $h=0, $txt='', $border=0, $ln=0, $align='LRB', $fill=false, $link='', $actwidth=88, & $newHeight) {
		//$x = 
		if($this->GetStringWidth($txt) > 60){
			$y1 = $this->GetY();
			$this->MultiCell($w,$h,$txt,$border,$align,$fill);
			$y2 = $this->GetY();
			$yH = $y2 - $y1;
						
			$this->SetXY($w+28, $this->GetY() - $yH);
			$newHeight = $this->GetY() - $yH;
		}else{
			$this->Cell($w,$h,$txt,$border,$ln,$align,$fill,$link);
			$newHeight = $h;
		//	var_dump("kadie");
		}
	}
	
	function Wrap($w, $h=0, $txt='', $border=0, $ln=0, $align='LRB', $fill=false, $link='', $actwidth=88, & $newHeight) {
		//$x = 
		//if($this->GetStringWidth($txt) > 60){
			$y1 = $this->GetY();
			//MultiCell2($w, $h, $txt, $border=0, $align='J', $fill=0, $maxline=0)
			//$this->MultiCell2($w,$h,$txt,$border,$align,$fill,10);
			$this->MultiCell($w,$h,$txt,$border,$align,$fill);
			$y2 = $this->GetY();
			$yH = $y2 - $y1;
						
			$this->SetXY($w+28, $this->GetY() - $yH);
			$newHeight = $this->GetY() - $yH;
		/* }else{
			$this->Cell($w,$h,$txt,$border,$ln,$align,$fill,$link);
			$newHeight = $h;
			var_dump("kadie");
		} */
	}
	
	//hitung jumlah baris yang dihasilkan
	function WordWrap(&$text, $maxwidth)
	{
	    $text = trim($text);
	    if ($text==='')
	        return 0;
	    $space = $this->GetStringWidth(' ');
	    $lines = explode("\n", $text);
	    $text = '';
	    $count = 0;
		
		
		//$this->Cell(3,$height[0],$lines,0,0,'R');
		
	    foreach ($lines as $line)
	    {
	        $words = preg_split('/ +/', $line);
	        $width = 0;

	        foreach ($words as $word)
	        {
	            $wordwidth = $this->GetStringWidth($word);
	            if ($width + $wordwidth <= $maxwidth)
	            {
	                $width += $wordwidth + $space;
	                $text .= $word.' ';
	            }
	            else
	            {
	                $width = $wordwidth + $space;
	                $text = rtrim($text)."\n".$word.' ';
	                $count++;
	            }
	        }
	        $text = rtrim($text)."\n";
	        $count++;
	    }
	    $text = rtrim($text);
	    return $count;
	}
	
	//modif word wrap
	function MultiCell2($w, $h, $txt, $border=0, $align='J', $fill=0, $maxline=0)
    {
        //Output text with automatic or explicit line breaks, maximum of $maxlines
        $cw=&$this->CurrentFont['cw'];
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
        $s=str_replace("\r", '', $txt);
        $nb=strlen($s);
        if($nb>0 and $s[$nb-1]=="\n")
            $nb--;
        $b=0;
        if($border)
        {
            if($border==1)
            {
                $border='LTRB';
                $b='LRT';
                $b2='LR';
            }
            else
            {
                $b2='';
                if(is_int(strpos($border, 'L')))
                    $b2.='L';
                if(is_int(strpos($border, 'R')))
                    $b2.='R';
                $b=is_int(strpos($border, 'T')) ? $b2.'T' : $b2;
            }
        }
        $sep=-1;
        $i=0;
        $j=0;
        $l=0;
        $ns=0;
        $nl=1;
        while($i<$nb)
        {
            //Get next character
            $c=$s[$i];
            if($c=="\n")
            {
                //Explicit line break
                if($this->ws>0)
                {
                    $this->ws=0;
                    $this->_out('0 Tw');
                }
                $this->Cell($w, $h, substr($s, $j, $i-$j), $b, 2, $align, $fill);
                $i++;
                $sep=-1;
                $j=$i;
                $l=0;
                $ns=0;
                $nl++;
                if($border and $nl==2)
                    $b=$b2;
                if ( $maxline  && $nl > $maxline ) 
                    return substr($s, $i);
                continue;
            }
            if($c==' ')
            {
                $sep=$i;
                $ls=$l;
                $ns++;
            }
            $l+=$cw[$c];
            if($l>$wmax)
            {
                //Automatic line break
                if($sep==-1)
                {
                    if($i==$j)
                        $i++;
                    if($this->ws>0)
                    {
                        $this->ws=0;
                        $this->_out('0 Tw');
                    }
                    $this->Cell($w, $h, substr($s, $j, $i-$j), $b, 2, $align, $fill);
                }
                else
                {
                    if($align=='J')
                    {
                        $this->ws=($ns>1) ? ($wmax-$ls)/1000*$this->FontSize/($ns-1) : 0;
                        $this->_out(sprintf('%.3f Tw', $this->ws*$this->k));
                    }
                    $this->Cell($w, $h, substr($s, $j, $sep-$j), $b, 2, $align, $fill);
                    $i=$sep+1;
                }
                $sep=-1;
                $j=$i;
                $l=0;
                $ns=0;
                $nl++;
                if($border and $nl==2)
                    $b=$b2;
                if ( $maxline  && $nl > $maxline ) 
                    return substr($s, $i);
            }
            else
                $i++;
        }
        //Last chunk
        if($this->ws>0)
        {
            $this->ws=0;
            $this->_out('0 Tw');
        }
        if($border and is_int(strpos($border, 'B')))
            $b.='B';
        $this->Cell($w, $h, substr($s, $j, $i-$j), $b, 2, $align, $fill);
        $this->x=$this->lMargin;
        return '';
    }
	
	function SetBreakLine($arMultiCell,$arMultiCellWidth) {
		$temp = -1;
		for($i=0; $i<count($arMultiCell); $i++){
			$tmpCount = $this->WordWrap($arMultiCell[$i],$arMultiCellWidth[$i]-2);
			//tentukan mana yang paling panjang multicell nya, kalau bukan yang akhir maka beri break line
			//if($tmpCount > 0 && $tmpCount > $temp && $i != (count($arMultiCell)-1)){
			if($tmpCount > 0 && $tmpCount > $temp){
				$temp = $tmpCount;
			}
			
			//kalau yang terakhir
			if($i == (count($arMultiCell)-1)){
				$tempCount = $this->WordWrap($arMultiCell[$i],$arMultiCellWidth[$i]);
				
				if($tempCount >= $temp){
					$temp = -1;
				}
			}
		}
		
		//kasih breakline kalau terjadi wrap
		if($temp > 1){
			for($i=0; $i<$temp-1; $i++){
				$this->Ln();
			}
		}
	}
	
	
	//----------------------------Khusus buat table didieu yeuh-0--------------------------
	
	function CheckPageBreak($h)
	{
		//If the height h would cause an overflow, add a new page immediately
		//var_dump("before ".$this->GetY());
		if($this->GetY()+$h>$this->PageBreakTrigger){
			$this->AddPage($this->CurOrientation);
			$this->setY(10);//tambahan dari chan agar di page setelah 1 posisi header kembali keatas
			//$this->setx(40);//tambahan dari chan agar di page setelah 1 posisi header kembali keatas
			//var_dump("after ".$this->GetY());
		}
	}
	
	//sekalian buat garis bawah 
	function CheckPageBreakChan($h,$w=100)
	{
		//If the height h would cause an overflow, add a new page immediately
		//var_dump("before ".$this->GetY());
		if($this->GetY()+$h>$this->PageBreakTrigger){
			$this->Line($this->GetX(),$this->GetY(),$this->GetX()+$w,$this->GetY());
			$this->AddPage($this->CurOrientation);
			$this->setY(10);//tambahan dari chan agar di page setelah 1 posisi header kembali keatas
			//$this->setx(40);//tambahan dari chan agar di page setelah 1 posisi header kembali keatas
			//var_dump("after ".$this->GetY());
		}
	}
	
		
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
	
	function getWrapRowHeight($width,$text){
		$nb=0;
		$nb=max($nb,$this->NbLines($width,$text));
		$h=5*$nb;
		return $h;
	}
	

	function Row($data,$cellColor=null)
	{
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		$h=5*$nb;
		
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
			if ($cellColor!=null){
				$this->SetDrawColor(0,0,0);
				$this->SetFillColor2($cellColor[$i]);
			}
			//Draw the border
			$this->Rect($x,$y,$w,$h);
			//Print the text
			$this->MultiCell($w,5,$data[$i],($cellColor!=null?1:0),$a,($cellColor!=null));
			//Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
		}
		//Go to the next line
		$this->Ln($h);
	}
	
	//by chan
	function HTML2RGB($c, &$r, &$g, &$b){
		static $colors = array('black'=>'#000000','silver'=>'#C0C0C0','gray'=>'#808080','white'=>'#FFFFFF',
							'maroon'=>'#800000','red'=>'#FF0000','purple'=>'#800080','fuchsia'=>'#FF00FF',
							'green'=>'#008000','lime'=>'#00FF00','olive'=>'#808000','yellow'=>'#FFFF00',
							'navy'=>'#000080','blue'=>'#0000FF','teal'=>'#008080','aqua'=>'#00FFFF');

		$c=strtolower($c);
		if(isset($colors[$c]))
			$c=$colors[$c];
		if($c[0]!='#')
			$this->Error('Incorrect color: '.$c);
		$r=hexdec(substr($c,1,2));
		$g=hexdec(substr($c,3,2));
		$b=hexdec(substr($c,5,2));
	}
	
	function SetFillColor2($r, $g=-1, $b=-1){
		if(is_string($r))
			$this->HTML2RGB($r,$r,$g,$b);
		parent::SetFillColor($r,$g,$b);
	}

	function RowWithMerge($data)
	{
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		$h=5*$nb;
		
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
			$this->MultiCell($w,5,$data[$i],0,$a);
			//Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
		}
		//Go to the next line
		$this->Ln($h);
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
	
	
	
	

	
	
	//buat html=================================
	function hex2dec($couleur = "#000000"){
		$R = substr($couleur, 1, 2);
		$rouge = hexdec($R);
		$V = substr($couleur, 3, 2);
		$vert = hexdec($V);
		$B = substr($couleur, 5, 2);
		$bleu = hexdec($B);
		$tbl_couleur = array();
		$tbl_couleur['R']=$rouge;
		$tbl_couleur['G']=$vert;
		$tbl_couleur['B']=$bleu;
		return $tbl_couleur;
	}

	//conversion pixel -> millimeter in 72 dpi
	function px2mm($px){
		return $px*25.4/72;
	}

	function txtentities($html){
		$trans = get_html_translation_table(HTML_ENTITIES);
		$trans = array_flip($trans);
		return strtr($html, $trans);
	}
	
	
	/* function WriteHTML($html)
    {
        //HTML parser
        $html=str_replace("\n",' ',$html);
        $a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
        foreach($a as $i=>$e)
        {
            if($i%2==0)
            {
                //Text
                if($this->HREF)
                    $this->PutLink($this->HREF,$e);
                elseif($this->ALIGN=='center')
                    $this->Cell(0,5,$e,0,1,'C');
                else
                    $this->Write(5,$e);
            }
            else
            {
                //Tag
                if($e[0]=='/')
                    $this->CloseTag(strtoupper(substr($e,1)));
                else
                {
                    //Extract properties
                    $a2=explode(' ',$e);
                    $tag=strtoupper(array_shift($a2));
                    $prop=array();
                    foreach($a2 as $v)
                    {
                        if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                            $prop[strtoupper($a3[1])]=$a3[2];
                    }
                    $this->OpenTag($tag,$prop);
                }
            }
        }
    } */
	
	function WriteHTML($html)
	{
		$html=strip_tags($html,"<b><u><i><a><img><p><br><strong><em><font><tr><blockquote><hr><td><tr><table><sup>"); //remove all unsupported tags
		$html=str_replace("\n",'',$html); //replace carriage returns by spaces
		$html=str_replace("\t",'',$html); //replace carriage returns by spaces
		$a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE); //explodes the string
		foreach($a as $i=>$e)
		{
			if($i%2==0)
			{
				//Text
				if($this->HREF)
					$this->PutLink($this->HREF,$e);
				elseif($this->tdbegin) {
					if(trim($e)!='' && $e!="&nbsp;") {
						$this->Cell($this->tdwidth,$this->tdheight,$e,$this->tableborder,'',$this->tdalign,$this->tdbgcolor);
					}
					elseif($e=="&nbsp;") {
						$this->Cell($this->tdwidth,$this->tdheight,'',$this->tableborder,'',$this->tdalign,$this->tdbgcolor);
					}
				}
				else
					$this->Write(5,stripslashes($this->txtentities($e)));
			}
			else
			{
				//Tag
				if($e[0]=='/')
					$this->CloseTag(strtoupper(substr($e,1)));
				else
				{
					//Extract attributes
					$a2=explode(' ',$e);
					$tag=strtoupper(array_shift($a2));
					$attr=array();
					foreach($a2 as $v)
					{
						if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
							$attr[strtoupper($a3[1])]=$a3[2];
					}
					$this->OpenTag($tag,$attr);
				}
			}
		}
	}
	
	function OpenTag($tag, $attr)
	{
		//Opening tag
		switch($tag){

			case 'SUP':
				if( !empty($attr['SUP']) ) {    
					//Set current font to 6pt     
					$this->SetFont('','',6);
					//Start 125cm plus width of cell to the right of left margin         
					//Superscript "1" 
					$this->Cell(2,2,$attr['SUP'],0,0,'L');
				}
				break;

			case 'TABLE': // TABLE-BEGIN
				if( !empty($attr['BORDER']) ) $this->tableborder=$attr['BORDER'];
				else $this->tableborder=0;
				break;
			case 'TR': //TR-BEGIN
				break;
			case 'TD': // TD-BEGIN
				if( !empty($attr['WIDTH']) ) $this->tdwidth=($attr['WIDTH']/4);
				else $this->tdwidth=40; // Set to your own width if you need bigger fixed cells
				if( !empty($attr['HEIGHT']) ) $this->tdheight=($attr['HEIGHT']/6);
				else $this->tdheight=6; // Set to your own height if you need bigger fixed cells
				if( !empty($attr['ALIGN']) ) {
					$align=$attr['ALIGN'];        
					if($align=='LEFT') $this->tdalign='L';
					if($align=='CENTER') $this->tdalign='C';
					if($align=='RIGHT') $this->tdalign='R';
				}
				else $this->tdalign='L'; // Set to your own
				if( !empty($attr['BGCOLOR']) ) {
					$coul=$this->hex2dec($attr['BGCOLOR']);
						$this->SetFillColor($coul['R'],$coul['G'],$coul['B']);
						$this->tdbgcolor=true;
					}
				$this->tdbegin=true;
				break;

			case 'HR':
				if( !empty($attr['WIDTH']) )
					$Width = $attr['WIDTH'];
				else
					$Width = $this->w - $this->lMargin-$this->rMargin;
				$x = $this->GetX();
				$y = $this->GetY();
				$this->SetLineWidth(0.2);
				$this->Line($x,$y,$x+$Width,$y);
				$this->SetLineWidth(0.2);
				$this->Ln(1);
				break;
			case 'STRONG':
				$this->SetStyle('B',true);
				break;
			case 'EM':
				$this->SetStyle('I',true);
				break;
			case 'B':
			case 'I':
			case 'U':
				$this->SetStyle($tag,true);
				break;
			case 'A':
				$this->HREF=$attr['HREF'];
				break;
			case 'IMG':
				if(isset($attr['SRC']) && (isset($attr['WIDTH']) || isset($attr['HEIGHT']))) {
					if(!isset($attr['WIDTH']))
						$attr['WIDTH'] = 0;
					if(!isset($attr['HEIGHT']))
						$attr['HEIGHT'] = 0;
					$this->Image($attr['SRC'], $this->GetX(), $this->GetY(), $this->px2mm($attr['WIDTH']), $this->px2mm($attr['HEIGHT']));
				}
				break;
			case 'BLOCKQUOTE':
			case 'BR':
				$this->Ln(5);
				break;
			case 'P':
				$this->Ln(10);
				break;
			case 'FONT':
				if (isset($attr['COLOR']) && $attr['COLOR']!='') {
					$coul=$this->hex2dec($attr['COLOR']);
					$this->SetTextColor($coul['R'],$coul['G'],$coul['B']);
					$this->issetcolor=true;
				}
				if (isset($attr['FACE']) && in_array(strtolower($attr['FACE']), $this->fontlist)) {
					$this->SetFont(strtolower($attr['FACE']));
					$this->issetfont=true;
				}
				if (isset($attr['FACE']) && in_array(strtolower($attr['FACE']), $this->fontlist) && isset($attr['SIZE']) && $attr['SIZE']!='') {
					$this->SetFont(strtolower($attr['FACE']),'',$attr['SIZE']);
					$this->issetfont=true;
				}
				break;
		}
	}

    function CloseTag($tag)
	{
		//Closing tag
		if($tag=='SUP') {
		}

		if($tag=='TD') { // TD-END
			$this->tdbegin=false;
			$this->tdwidth=0;
			$this->tdheight=0;
			$this->tdalign="L";
			$this->tdbgcolor=false;
		}
		if($tag=='TR') { // TR-END
			$this->Ln();
		}
		if($tag=='TABLE') { // TABLE-END
			//$this->Ln();
			$this->tableborder=0;
		}

		if($tag=='STRONG')
			$tag='B';
		if($tag=='EM')
			$tag='I';
		if($tag=='B' || $tag=='I' || $tag=='U')
			$this->SetStyle($tag,false);
		if($tag=='A')
			$this->HREF='';
		if($tag=='FONT'){
			if ($this->issetcolor==true) {
				$this->SetTextColor(0);
			}
			if ($this->issetfont) {
				$this->SetFont('arial');
				$this->issetfont=false;
			}
		}
	}

	function SetStyle($tag, $enable)
	{
		//Modify style and select corresponding font
		$this->$tag+=($enable ? 1 : -1);
		$style='';
		foreach(array('B','I','U') as $s) {
			if($this->$s>0)
				$style.=$s;
		}
		$this->SetFont('',$style);
	}

	function PutLink($URL, $txt)
	{
		//Put a hyperlink
		$this->SetTextColor(0,0,255);
		$this->SetStyle('U',true);
		$this->Write(5,$txt,$URL);
		$this->SetStyle('U',false);
		$this->SetTextColor(0);
	}
	//buat html=================================
	
	


}

?>