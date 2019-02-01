<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link rel="shortcut icon" href="<?=base_url()?>resource/images/favicon.ico" />
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
    <h2><?php echo lang('vehicle_category'); ?></h2>
</div>

<div id="content" style="text-align:center;">
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">
	<tr >
		<td  align="center" height="30px">No</td>
		<td  align="center"><?php echo lang('vehicle_category_code'); ?></td>
		<td  align="center"><?php echo lang('vehicle_category_name'); ?></td>
		<td  align="center"><?php echo lang('vehicle_type'); ?></td>
		<td  align="center"><?php echo lang('vehicle_category_weight'); ?></td>
		<td  align="center"><?php echo lang('vehicle_category_max_weight'); ?></td>
		<td  align="center"><?php echo lang('vehicle_category_min_weight'); ?></td>
	</tr>
	<?php 
				 $i=0;
				foreach($vehicle_type as $val){
				    $i++;
				    $type_cd=$val->type_cd;
					$type_name=$val->type_name;
                    $vehicle_type=$val->vehicle_type;
					$weight=$val->weight;
                    $max_weight=$val->max_weight;
                    $min_weight=$val->min_weight;
    ?>
	<tr style="font-size:9px">
		<td><?php echo $i;?></td>
		<td align="left"><?php echo $type_cd;?></td>
		<td align="left"><?php echo $type_name;?></td>
		<td align="left"><?php echo $vehicle_type;?></td>
		<td align="right"><?php echo number_format($weight);?></td>
		<td align="right"><?php echo number_format($max_weight,0);?></td>
        <td align="right"><?php echo number_format($min_weight,0);?></td>
		
	</tr>
	<?php }?>
</table>
</div>
</body>
</html>
