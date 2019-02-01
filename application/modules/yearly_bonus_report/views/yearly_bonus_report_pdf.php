<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=lang('yearly_bonus_report')?> Report</title>
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
    <span style="font-size: 16px;"><?=strtoupper(lang('yearly_bonus_report').' Report')?></span><br />
    Period : <?=$str_start_date.' to '.$str_end_date;?>
</div>
<div id="content">
<table width="100%" cellpadding="3" cellspacing="0">
	<tr>
        <th style="border: #000000 solid 1px;" width="3%">No</th>
        <th style="border: #000000 solid 1px;"><?=lang('police_no')?></th>
        <th style="border: #000000 solid 1px;" width="15%"><?=lang('tonase')?></th>
        <th style="border: #000000 solid 1px;" width="15%"><?=lang('ritase')?></th>
        <th style="border: #000000 solid 1px;" width="15%"><?=lang('points')?></th>
        <th style="border: #000000 solid 1px;" width="15%">UJ <?=lang('amount')?> (Rp)</th>
        <th style="border: #000000 solid 1px;" width="20%"><?=lang('total')?> (Rp)</th>
    </tr>  
	<?php 
    $i=0;
        
    if (!empty($vehicles)) {
        foreach ($vehicles as $row) { 
            $i++;
            $tonase = 0;
            $ritase = 0;
            $point = 0;
            $amount = 0;
            
            $get_data = $this->yearly_bonus_report_model->get_all_records_list($row->police_no,$start_date,$end_date);
            if(count($get_data) > 0){
                foreach($get_data as $row_dtl){
                    $tonase += $row_dtl->tonase;
                    $ritase += $row_dtl->ritase;
                    $point  += $row_dtl->point;
                    $amount += $row_dtl->amount;                
                }
            }
    ?>
        	<tr>
        		<td style="border: #000000 solid 1px;" align="center"><?=number_format($i)?></td>
				<td style="border: #000000 solid 1px;" align="left"><?=$row->police_no?></td>
				<td style="border: #000000 solid 1px;" align="left"><?=number_format($tonase)?></td>
				<td style="border: #000000 solid 1px;" align="center"><?=number_format($ritase)?></td>
				<td style="border: #000000 solid 1px;" align="center"><?=number_format($point)?></td>
				<td style="border: #000000 solid 1px;" align="right"><?=number_format($amount)?></td>
				<td style="border: #000000 solid 1px;" align="right"><?=number_format($point * $this->config->item('point_price'))?></td>
        	</tr>
	<?php 
        }
    }
    
    if($i == 0){
    ?>
        <tr>
            <td colspan="7" align="center" style="border: #000000 solid 1px;">Data not available.</td>
        </tr>
    <?php
    }
    ?>
</table>
</div>

</body>
</html>
