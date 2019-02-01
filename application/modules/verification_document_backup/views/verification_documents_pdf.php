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
    <h2><?php echo lang('verification_documents'); ?></h2>
    <?=lang('periode')." : <b>".$periode."</b>"?>
</div>

<div id="content" style="text-align:center;">
<table width="100%">
    <tr>
        <td width="50%" align="left">
            &nbsp; 
        </td>
        <td width="50%" align="right" style="font-size: 10px;">
            Print Date Time : <?=date('d-m-Y H:i:s')?> 
        </td>
    </tr>
</table>

<table width="100%" border="1" align="center" cellpadding="3" cellspacing="0">
	<tr >
		<td  align="center"><?php echo lang('no'); ?></td>
        <td  align="center"><?php echo lang('cash_advance_no'); ?></td>
		<td  align="center"><?php echo lang('date'); ?></td>
		<td  align="center"><?php echo lang('driver')?>/<?php echo lang('employee')?> Name</td>
		<td  align="center"><?php echo lang('vehicle_police_no'); ?></td>
		<td  align="center"><?php echo lang('delivery_order_no'); ?></td>
		<td  align="center">Tonase Deliver </td>
		<td  align="center">Tonase Receive </td>
		<td  align="center">Deliver Date</td>
		<td  align="center">Receive Date</td>
		<td  align="center">Realization Date </td>
		<td  align="center"><?php echo lang('realization_value'); ?></td>
	</tr>
	<?php 
    $no=1;
    $total_realization = 0;
    foreach($verification_documents as $doc){
				    
	?>
	<tr style="font-size:9px">
		<td align="center"><?=number_format($no++,0,',','.')?></td>
		<td align="left"><?= $doc->advance_no;?></td>
        <td align="left"><?= date("d-m-Y",strtotime($doc->advance_date));?></td>
		<td align="left"><?= $doc->debtor_name;?></td>
		<td align="left"><?= $doc->police_no;?></td>
		<td align="left"><?= $doc->do_no == '' ? '-' : $doc->do_no;?></td>
		<td align="left"><?= number_format($doc->deliver_weight,0,',','.');?></td>
		<td align="left"><?= number_format($doc->received_weight,0,',','.');?></td>
        <td align="left"><?= date("d-m-Y",strtotime($doc->deliver_date));?></td>
        <td align="left"><?= date("d-m-Y",strtotime($doc->received_date));?></td>
        <td align="left"><?= date("d-m-Y",strtotime($doc->alloc_date));?></td>
		<td align="right"><?= number_format($doc->advance_allocation,0,',','.');?></td>
	</tr>
	<?php 
        $total_realization += $doc->advance_allocation;
    }            
    ?>
    <tr>
        <td colspan="11" align="right">Total Realization (Rp)</td>
		<td align="right"><?= number_format($total_realization,0,',','.');?></td>
    </tr>
</table>
</div>

</body>
</html>
