<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Print Reimburse</title>
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
    <h2><?php echo lang('reimburse_details'); ?></h2>
    <?=lang('periode')." : <b>".$periode."</b>"?>
</div>
<br />

<div id="content" style="text-align:center;">
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">
	<tr >
    
		<td  align="center" height="30px">No</td>
		<td  align="center"><?php echo lang('reimburse_number'); ?></td>
        <td  align="center"><?php echo lang('date'); ?></td>
        <td  align="center"><?php echo lang('advance_type'); ?></td>
		<td  align="center"><?php echo lang('remark'); ?></td>
		<td  align="center"><?php echo lang('amount'); ?> (Rp)</td>
	</tr>
	<?php 
    $i=0;
	if(!empty($reimburses)){	
    	foreach($reimburses as $val){
            $i++;
	?>
	<tr style="font-size:9px">
		<td align="center"><?php echo $i;?></td>
		<td><?=$val->reimburse_number?></td>
		<td><?=date("d F Y",strtotime($val->reimburse_date))?></td>
		<td><?=ucwords(strtolower($val->advance_name))?></td>
		<td><?=$val->remark?></td>
        <td align="right"><?=number_format($val->reimburse_total,0)?></td>
	</tr>
	<?php 
        }
    }
    else{
    ?>
        <tr style="font-size:9px">
		  <td align="center" colspan="6">No Data Available</td>
        </tr>
    <?php
    }
    ?>
</table>
</div>
</body>
</html>
