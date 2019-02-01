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

<table width="100%" cellpadding="2" cellspacing="0">
    <tr>
        <td width="50%" align="left"><?=$this->config->item('comp_name')?></td>
        <td width="50%" align="right">Print Date Time : <?=date('d F Y H:i:s')?> </td>
    </tr>
</table>

<div id="header">
    <h2><?php echo lang('vessels'); ?></h2>
    <?=lang('periode')." : <b>".$periode."</b>"?>
</div>
<br />

<div id="content" style="text-align:center;">
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">
	<tr >
    
		<th height="30px">No</td>
		<th><?=lang('vessel_no')?> </th>
		<th>ETA <?=lang('date')?> </th>
		<th><?=lang('vessel_name')?> </th>
		<th><?=lang('port_warehouse')?> </th>
		<th><?=lang('agent')?> </th>
		<th><?=lang('original_copy')?></th>
		<th><?=lang('status')?></th>
	</tr>
	<?php 
	$i=1;
    if(!empty($vessels)){
        foreach($vessels as $vessel){
            $original_copy = '-';
            if($vessel->original == 1 && $vessel->copy == 1)
                $original_copy = 'Original & Copy';
            else if($vessel->original == 1)
                $original_copy = 'Original';
            else if($vessel->copy == 1)
                $original_copy = 'Copy';
          
	?>
	<tr style="font-size:9px">
		<td align="center"><?php echo $i++;?></td>
		<td><?=$vessel->trx_no?></td>
		<td><?=date("d F Y",strtotime($vessel->eta_date))?></td>
		<td><?=$vessel->vessel_name?></td>
		<td><?=$vessel->port_name?></td>
		<td><?=$vessel->agent?></td>
		<td><?=$original_copy?></td>
		<td><?=$vessel->status == 0 ? 'Unfinished' : 'Finished'?></td>
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
