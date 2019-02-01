<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=lang('driver_attendance')?></title>
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
<div id="header">
    <span style="font-size: 16px;"><?=strtoupper(lang('driver_attendance'))?> REPORT</span><br />
    Period : <?=$str_start_date.' to '.$str_end_date;?>
</div>
<div id="content">
<table width="100%" cellpadding="1" cellspacing="0">
	<tr>
        <th style="border: #000000 solid 1px;" width="5%">No</th>
        <th style="border: #000000 solid 1px;" width="25%"><?=lang('driver_name')?></th>
        <th style="border: #000000 solid 1px;" width="15%"><?=lang('attendance')?></th>
        <th style="border: #000000 solid 1px;"><?=lang('note')?></th>
        <th style="border: #000000 solid 1px;" width="15%"><?=lang('time')?></th>
    </tr> 
	<?php 
    $i=0;
    if (!empty($attendances)) {
        foreach ($attendances as $attendance) { 
            $i++;
    ?>
        	<tr>
        		<td style="border: #000000 solid 1px;" align="center"><?=$i?></td>
				<td style="border: #000000 solid 1px;"><?=$attendance->debtor_cd?> - <?=$attendance->debtor_name?></td>
				<td style="border: #000000 solid 1px;">
                    <?php
                    if($attendance->absent_code == 'S'){
                        $absent_code = 'Sakit';
                    }
                    else if($attendance->absent_code == 'I'){
                        $absent_code = 'Izin';
                    }
                    else if($attendance->absent_code == 'A'){
                        $absent_code = 'Alfa';
                    }
                    else if($attendance->absent_code == 'T'){
                        $absent_code = 'Terlambat';
                    }
                    else if($attendance->absent_code == 'B'){
                        $absent_code = 'Banned';
                    }
                    else if($attendance->absent_code == 'G'){
                        $absent_code = 'Ganti Supir';
                    }
                    else if($attendance->absent_code == 'R'){
                        $absent_code = 'Registered';
                    }
                    else if($attendance->absent_code == 'P'){
                        $absent_code = 'Pending';
                    }
                    else{
                        $absent_code = '-';
                    }
                    
                    echo $absent_code;
                    ?>
                </td>
				<td style="border: #000000 solid 1px;"><?=ucfirst($attendance->note)?></td>
				<td style="border: #000000 solid 1px;width:10%"><?=date("d-m-Y H:i:s",strtotime($attendance->date_created))?></td>
        	</tr>
	<?php 
        }
        
    }
    
    if($i == 0){
    ?>
        <tr>
            <td colspan="5" align="center" style="border: #000000 solid 1px;">Data not available.</td>
        </tr>
    <?php
    }
    ?>
</table>
</div>

</body>
</html>
