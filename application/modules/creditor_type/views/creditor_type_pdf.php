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
    <h2><?php echo lang('creditor_types'); ?></h2>
</div>

<div id="content" style="text-align:center;">
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">
	<tr >
    
		<td  align="center" height="30px">No</td>
		<td  align="center"><?php echo lang('creditor_type_cd'); ?></td>
        <td  align="center"><?php echo lang('creditor_type_name'); ?></td>
        <td  align="center"><?php echo lang('creditortype_pay_acc'); ?></td>
        <td  align="center"><?php echo lang('creditortype_advance_acc'); ?></td>
        <td  align="center"><?php echo lang('creditortype_deposit_acc'); ?></td>
        <td  align="center"><?php echo lang('creditortype_rounding_acc'); ?></td>
        <td  align="center"><?php echo lang('creditortype_adm_acc'); ?></td>
	</tr>
	<?php 
				 $i=0;
				foreach($creditor_type as $val){
				$i++;
                    $type_cd = $val->type_cd;
					$descs=$val->descs;
                    $payable_acc=$val->payable_acc;
                    $advance_acc=$val->advance_acc;
                    $deposit_acc=$val->deposit_acc;
                    $rounding_acc=$val->rounding_acc;
                    $adm_acc=$val->adm_acc;
					?>
	<tr style="font-size:9px">
		<td><?php echo $i;?></td>
		<td align="left"><?php echo $type_cd;?></td>
		<td align="left"><?php echo $descs;?></td>
		<td align="left"><?php echo $payable_acc;?></td>
        <td align="left"><?php echo $advance_acc;?></td>
        <td align="left"><?php echo $deposit_acc;?></td>
        <td align="left"><?php echo $rounding_acc;?></td>
        <td align="left"><?php echo $adm_acc;?></td>
	</tr>
	<?php }?>
</table>
</div>
</body>
</html>
