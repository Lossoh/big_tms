<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>

<style>
    body,table th,td{
        font-size: 11px;
        font-family: sans-serif;
    }
	
	 @page { margin: 10px 10px; }
     #header { left: 0px; top: 0px; right: 0px; text-align: center;  }
     #footer { left: 0px; bottom: 30px; right: 0px; font-size: 11px; font-family: sans-serif; text-align:right; }	
	  #content{
    	 border-bottom:0px solid #000000;
	 }
     #footer .page:after { content: counter(page, upper-roman); }
	#content{
	background-color:#FFFFFF;
	}
</style>

<div id="header">
    <h2><?php echo lang('tire_details'); ?></h2>
</div>

<div id="content" style="text-align:center;">
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">
	<tr >
		<th  align="center" height="20px">No</th>
		<th  align="center"><?php echo lang('vehicle_police_no'); ?></th>
        <th  align="center"><?php echo lang('driver_name'); ?></th>
        <th  align="center">Tire Position</th>
        <th  align="center">Date</th>
	</tr>
	<?php 
    $i=0;
	if(!empty($tires)){
        foreach($tires as $tire){
	    $i++;
   	?>
	<tr style="font-size:9px">
		<td align="center"><?php echo $i;?></td>
		<td><?=$tire->police_no?></td>
        <td><?=$tire->debtor_name?></td>
        <td><?=$tire->tire_position?></td>
        <td><?=date('d F Y',strtotime($tire->date))?></td>
	</tr>
	<?php 
        }
    }
    else{
    ?>
        <tr style="font-size:9px">
		  <td align="center" colspan="5">No Data Available</td>
        </tr>
    <?php
    }
    ?>
</table>
</div>
</body>
</html>
