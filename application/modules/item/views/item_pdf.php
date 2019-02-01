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
    <h2><?php echo lang('items'); ?></h2>
</div>

<div id="content" style="text-align:center;">
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">
	<tr >
    
		<td  align="center" height="30px">No</td>
		<td  align="center"><?php echo lang('item_code'); ?></td>
        <td  align="center"><?php echo lang('item_name'); ?></td>
        <td  align="center"><?php echo lang('minimum'); ?></td>
        <td  align="center"><?php echo lang('maximum'); ?></td>
        <td  align="center"><?php echo lang('item_uom'); ?></td>
	</tr>
	<?php 
				 $i=0;
				foreach($item as $val){
				$i++;
                    $item_cd = $val->item_cd;
					$item_name=$val->item_name;
					$minimum=number_format($val->minimum);
					$maximum=number_format($val->maximum);
                    $uom=$val->uom;
					?>
	<tr style="font-size:9px">
		<td><?php echo $i;?></td>
		<td align="left"><?php echo $item_cd;?></td>
		<td align="left"><?php echo $item_name;?></td>
		<td align="left"><?php echo $minimum;?></td>
		<td align="left"><?php echo $maximum;?></td>
        <td align="left"><?php echo $uom;?></td>
	</tr>
	<?php }?>
</table>
</div>
</body>
</html>
