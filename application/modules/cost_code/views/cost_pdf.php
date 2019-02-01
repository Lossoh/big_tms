<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo lang('cost'); ?></title>
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
    <h2><?php echo lang('cost'); ?></h2>
</div>

<div id="content" style="text-align:center;">
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">
	<tr >
    
		<td  align="center" height="30px">No</td>
		<td  align="center">Type</td>
        <td  align="center"><?php echo lang('cost_code_code'); ?></td>
		<td  align="center"><?php echo lang('cost_code_name'); ?></td>
        <td  align="center"><?php echo lang('cost_code_wip'); ?></td>
        <td  align="center"><?php echo lang('cost_code_cogs'); ?></td>
        <td  align="center"><?php echo lang('fare_trip_component'); ?></td>
        <td  align="center"><?php echo lang('cost_code_site'); ?></td>
	</tr>
	<?php 
				 $i=0;
				foreach($cost_code as $val){
				$i++;
                    $type = $val->type;
				    $cost_cd=$val->cost_cd;
					$descs=$val->descs;
                    $acc_wip=$val->acc_wip;
                    $acc_cogs=$val->acc_cogs;
                    $fare_trip_comp =$val->fare_trip_comp;
                    $site_flag =$val->site_flag;
					?>
	<tr style="font-size:9px">
		<td><?php echo $i;?></td>
		<td align="left"><?php echo $type;?></td>
		<td align="left"><?php echo $cost_cd;?></td>
		<td align="left"><?php echo $descs;?></td>
        <td align="left"><?php echo $acc_wip;?></td>
        <td align="left"><?php echo $acc_cogs;?></td>
        <td align="center"><?php echo $fare_trip_comp;?></td>
        <td align="center"><?php echo $site_flag;?></td>
	</tr>
	<?php }?>
</table>
</div>
</body>
</html>
