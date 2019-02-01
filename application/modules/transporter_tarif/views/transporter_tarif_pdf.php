<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Print Data Vessel</title>
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
    <h2><?php echo lang('transporter_tarif'); ?></h2>
</div>
<br />

<div id="content" style="text-align:center;">
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">
	<tr >
    
		<th height="30px">No</td>
		<th><?=lang('creditor_type_name')?> </th>
		<th><?=lang('jo_type')?> </th>
		<th><?=lang('cargo_name')?> </th>
		<th><?=lang('from')?> </th>
		<th><?=lang('to')?> </th>
		<th><?=lang('price')?> (Rp/Kg)</th>
	</tr>
	<?php 
	$i=1;
    if(!empty($transporter_tarifs)){
        foreach($transporter_tarifs as $transporter_tarif){
            $jo_type = '';
            if($transporter_tarif->jo_type == 1)
                $jo_type = 'BULK';
            else if($transporter_tarif->jo_type == 2)
                $jo_type = 'CONTAINER';
            else if($transporter_tarif->jo_type == 3)
                $jo_type = 'OTHERS';
	?>
	<tr style="font-size:9px">
		<td align="center"><?php echo $i++;?></td>
		<td><?=$transporter_tarif->creditor_name?></td>
		<td><?=$jo_type?></td>
		<td><?=$transporter_tarif->item_name?></td>
		<td><?=$transporter_tarif->from_no_name.' - '.$transporter_tarif->from_name?></td>
		<td><?=$transporter_tarif->to_no_name.' - '.$transporter_tarif->to_name?></td>
		<td align="right"><?=number_format($transporter_tarif->price)?></td>
	</tr>
	<?php 
        }
    }
    else{
    ?>
        <tr style="font-size:9px">
		  <td align="center" colspan="8">No Data Available</td>
        </tr>
    <?php
    }
    ?>
</table>
</div>
</body>
</html>
