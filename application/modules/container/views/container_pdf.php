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
    <h2><?php echo lang('containers'); ?></h2>
    <?=lang('periode')." : <b>".$periode."</b>"?>
</div>
<br />

<div id="content" style="text-align:center;">
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">
	<tr >
    
		<th width="5%" height="30px">No</td>
		<th width="20%"><?=lang('job_order_no')?> </th>
		<th width="15%">Container Size </th>
		<th width="20%">Container No </th>
		<th width="20%">Seal No </th>
		<th width="20%">Replacement Seal No </th>
	</tr>
	<?php 
	   $i=1;
       if(!empty($containers)){
	       foreach($containers as $container){
          
	?>
	<tr style="font-size:9px">
		<td align="center"><?php echo $i++;?></td>
		<td><?=$container->jo_no?></td>
		<td><?=$container->container_type?></td>
		<td><?=$container->container_no?></td>
		<td><?=$container->seal_no?></td>
		<td><?=$container->replacement_seal_no?></td>
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
