<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>

<style>
    table th,td{
        font-size: 12px;
    }
	
	 @page { margin: 60px 10px; }
     #header { position: fixed; left: 0px; top: -60px; right: 0px; height: 50px;  text-align: center;  }
     #footer { position: fixed; left: 0px; bottom: -60px; right: 0px; height: 50px; text-align:right; }
	 #content{
	 border-bottom:0px solid #000000;
	 }
     #footer .page:after { content: counter(page, upper-roman); }
	#content{
	background-color:#FFFFFF;
	} 
</style>

<div id="header">
    <h2><?php echo lang('expenses'); ?></h2>
</div>

<div id="content" style="text-align:center;">
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">
	<tr >
    
		<td  align="center" height="30px">No</td>
		<td  align="center"><?php echo lang('expenses_code'); ?></td>
        <td  align="center"><?php echo lang('expenses_name'); ?></td>
        <td  align="center"><?php echo lang('type'); ?></td>
		<td  align="center"><?php echo lang('expenses_account'); ?></td>
		<td  align="center"><?php echo lang('ap_account'); ?></td>
		<td  align="center"><?php echo lang('reimburse_account'); ?></td>
		<td  align="center"><?php echo lang('advance_account'); ?></td>
	</tr>
	<?php 
    $i=0;
    foreach($expense as $val){
	   $i++;
	   $expense_cd=$val->expense_cd;
	   $descs=$val->descs;
       $type=$val->advance_name;
       $expense_acc=$val->expense_acc;
       $ap_acc=$val->ap_acc;
       $reimburse_acc=$val->reimburse_acc;
       $advance_acc=$val->advance_acc;
	?>
	<tr style="font-size:9px">
		<td><?php echo $i;?></td>
		<td align="left"><?php echo $expense_cd;?></td>
		<td align="left"><?php echo $descs;?></td>
		<td align="left"><?php echo $type;?></td>
		<td align="left"><?php echo $expense_acc;?></td>
		<td align="left"><?php echo $ap_acc;?></td>
		<td align="left"><?php echo $reimburse_acc;?></td>
		<td align="left"><?php echo $advance_acc;?></td>
	</tr>
	<?php }?>
</table>
</div>
</body>
</html>
