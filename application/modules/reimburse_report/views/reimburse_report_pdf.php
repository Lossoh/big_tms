<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=lang('reimburse_report')?></title>
</head>

<body>

<style>
    table th,td{
        font-size: 11px;
    }
	body{
	   font-size: 11px;
       font-family: sans-serif;
	}
	 @page { margin: 15px 30px 15px 20px; }
     
     #header { left: 0px; top: 0px; right: 0px; text-align: center;  }
     #footer { left: 0px; bottom: 30px; right: 0px; font-size: 11px; font-family: sans-serif; text-align:right; }
	 #content{
	   border-bottom:0px solid #000000;
       margin-top: 10px;
	 }
     #footer .page:after { content: counter(page, upper-roman); }
	#content{
	background-color:#FFFFFF;
	}
</style>
<table width="100%" cellpadding="2" cellspacing="0">
    <tr>
        <td width="50%" align="left"><?=$this->config->item('comp_name')?></td>
        <td width="50%" align="right">Print Date Time : <?=date('d F Y H:i:s')?> </td>
    </tr>
</table>
<br />
<div id="header">
    <span style="font-size: 16px;"><?=strtoupper(lang('reimburse_report'))?></span><br />
    Period : <?=$str_start_date.' to '.$str_end_date;?>
</div>
<div id="content">
<table width="100%" cellpadding="3" cellspacing="0">
	<tr>
        <th style="border: #000000 solid 1px;" width="3%" rowspan="2">No</th>
        <th style="border: #000000 solid 1px;" width="10%" rowspan="2">Reimburse No</th>
        <th style="border: #000000 solid 1px;" width="7%" rowspan="2">Reimburse <?=lang('date')?></th>
        <th style="border: #000000 solid 1px;" width="10%" rowspan="2">Advance Type</th>
        <th style="border: #000000 solid 1px;" rowspan="2">Remark</th>
        <th style="border: #000000 solid 1px;" width="10%" rowspan="2">Total (Rp)</th>
        <th style="border: #000000 solid 1px;" colspan="3">Advance</th>
    </tr> 
    <tr> 
        <th style="border: #000000 solid 1px;" width="14%">Advance No</th>
        <th style="border: #000000 solid 1px;" width="8%">Advance Date</th>
        <th style="border: #000000 solid 1px;" width="10%">Amount (Rp)</th>
    </tr> 
	<?php
    $i=0;
    $total_reimburse = 0;
    $total_advance = 0;
    
    if (!empty($reimburse_reports)) {
        foreach ($reimburse_reports as $reimburse_report) {
            $i++;
            $total_reimburse += $reimburse_report->reimburse_total;
            
            $get_data_advance = $this->reimburse_report_model->get_advance_detail_by_reimburse_number($reimburse_report->reimburse_number);
            
    ?>
        	<tr>
        		<td style="border-top: #000000 solid 1px;border-bottom: #000000 double 3px;border-left: #000000 solid 1px;border-right: #000000 solid 1px;" align="center" rowspan="3"><?=number_format($i)?></td>
				<td style="border-top: #000000 solid 1px;border-bottom: #000000 double 3px;border-left: #000000 solid 1px;border-right: #000000 solid 1px;" rowspan="3"><?=$reimburse_report->reimburse_number?></td>
				<td style="border-top: #000000 solid 1px;border-bottom: #000000 double 3px;border-left: #000000 solid 1px;border-right: #000000 solid 1px;" align="center" rowspan="3"><?=date("d-m-Y",strtotime($reimburse_report->reimburse_date))?></td>
				<td style="border-top: #000000 solid 1px;border-bottom: #000000 double 3px;border-left: #000000 solid 1px;border-right: #000000 solid 1px;" rowspan="3"><?=$reimburse_report->advance_name?></td>
				<td style="border-top: #000000 solid 1px;border-bottom: #000000 double 3px;border-left: #000000 solid 1px;border-right: #000000 solid 1px;" rowspan="3"><?=$reimburse_report->remark?></td>
				<td style="border-top: #000000 solid 1px;border-bottom: #000000 double 3px;border-left: #000000 solid 1px;border-right: #000000 solid 1px;" align="right" rowspan="3"><?=number_format($reimburse_report->reimburse_total,2)?></td>
				<td style="border: #000000 solid 1px;" align="left">
                    <?php
                    if(count($get_data_advance) > 0){
                        $n = 1;
                        echo "<table width='100%' cellpadding='0' cellspacing='0'>";
                        foreach($get_data_advance as $row){
                            echo '
                                <tr>
                                    <td width="10%" align="left">'.number_format($n).'.</td>
                                    <td width="90%" align="left">'.$row->advance_number.'</td>
                                </tr>
                            ';                                
                            $n++;
                        }       
                        echo "</table>";                                                
                    }
                    else{
                        echo '<div style="text-align:center">-</div>';
                    }
                    ?>
                </td>
				<td style="border: #000000 solid 1px;">
                    <?php
                    if(count($get_data_advance) > 0){
                        $n = 1;
                        echo "<table width='100%' cellpadding='0' cellspacing='0'>";
                        foreach($get_data_advance as $row){
                            echo '
                                <tr>
                                    <td width="100%" align="center">'.date("d-m-Y",strtotime($row->advance_date)).'</td>
                                </tr>
                            ';                                
                            $n++;
                        }       
                        echo "</table>";                                                
                    }
                    else{
                        echo '<div style="text-align:center">-</div>';
                    }
                    ?>
                </td>
				<td style="border: #000000 solid 1px;" align="right">
                    <?php
                    $amount_advance = 0;   
                        
                    if(count($get_data_advance) > 0){
                        $n = 1;
                        echo "<table width='100%' cellpadding='0' cellspacing='0'>";
                        foreach($get_data_advance as $row){
                            echo '
                                <tr>
                                    <td width="100%" align="right">'.number_format($row->advance_total,2).'</td>
                                </tr>
                            ';                                
                            $n++;
                            
                            $amount_advance += $row->advance_total;
                            $total_advance += $row->advance_total;
                        }                                         
                        echo "</table>";
                    }
                    else{
                        echo number_format(0,2);
                        $total_advance += 0;
                    }
                    
                    $range_amount = $amount_advance - $reimburse_report->reimburse_total;
                    if($range_amount > 0){
                        $text_paid = "Overpaid";
                    }
                    else if($range_amount < 0){
                        $text_paid = "Underpaid";
                    }
                    else{
                        $text_paid = "Balance";
                    }
                    
                    ?>
                </td>
        	</tr>
            <tr>
                <th colspan="2" align="right" style="border: #000000 solid 1px;">Total &nbsp; </th>
                <th align="right" style="border: #000000 solid 1px;"><?=number_format($amount_advance,2)?></th>
            </tr>
            <tr>
                <th colspan="2" align="right" style="border-top: #000000 solid 1px;border-bottom: #000000 double 3px;border-left: #000000 solid 1px;border-right: #000000 solid 1px;"><?=$text_paid?> &nbsp; </th>
                <th align="right" style="border-top: #000000 solid 1px;border-bottom: #000000 double 3px;border-left: #000000 solid 1px;border-right: #000000 solid 1px;"><?=number_format($range_amount,2)?></th>
            </tr>
	<?php 
        }
        
    }
    
    if($i == 0){
    ?>
        <tr>
            <td colspan="9" align="center" style="border: #000000 solid 1px;">Data not available.</td>
        </tr>
    <?php
    }
    else{
    ?>
        <tr>
            <th colspan="5" align="right" style="border-top: #000000 double 2px;border-bottom: #000000 solid 1px;border-left: #000000 solid 1px;border-right: #000000 solid 1px;">Grand Total &nbsp; </th>
            <th align="right" style="border-top: #000000 double 2px;border-bottom: #000000 solid 1px;border-left: #000000 solid 1px;border-right: #000000 solid 1px;"><?=number_format($total_reimburse,2)?></th>
            <th colspan="2" align="right" style="border-top: #000000 double 2px;border-bottom: #000000 solid 1px;border-left: #000000 solid 1px;border-right: #000000 solid 1px;">Grand Total &nbsp; </th>
            <th align="right" style="border-top: #000000 double 2px;border-bottom: #000000 solid 1px;border-left: #000000 solid 1px;border-right: #000000 solid 1px;"><?=number_format($total_advance,2)?></th>
        </tr>    
        <tr>
            <?php
            $total_paid = $total_advance - $total_reimburse;
            if($total_paid > 0){
                $text_paid = "Overpaid Grand Total (Rp) ";
            }
            else if($total_paid < 0){
                $text_paid = "Underpaid Grand Total (Rp) ";
            }
            else{
                $text_paid = "Balance Grand Total (Rp) ";
            }
            ?>
            <th align="right" colspan="8" style="border-top: #000000 solid 1px;border-bottom: #000000 double 3px;border-left: #000000 solid 1px;border-right: #000000 solid 1px;"><?=$text_paid?></th>
            <th align="right" style="border-top: #000000 solid 1px;border-bottom: #000000 double 3px;border-left: #000000 solid 1px;border-right: #000000 solid 1px;"><?=number_format($total_paid,2)?></th>
        </tr>    
    <?php
    }
    ?>
</table>
</div>

</body>
</html>
