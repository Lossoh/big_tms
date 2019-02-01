<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo lang('coas'); ?></title>
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
    <h2><?php echo lang('coas'); ?></h2>
</div>

<div id="content" style="text-align:center;">
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">
	<tr >
    
		<td  align="center" height="30px">No</td>
        <td  align="center"><?php echo lang('coa_code'); ?></td>
        <td  align="center"><?php echo lang('coa_name'); ?></td>
		<td  align="center"><?php echo lang('coa_type'); ?></td>
        <td  align="center"><?php echo lang('coa_level'); ?></td>
        <td  align="center"><?php echo lang('coa_class'); ?></td>
        <td  align="center"><?php echo lang('coa_c'); ?></td>
        <td  align="center"><?php echo lang('coa_b'); ?></td>
        <td  align="center"><?php echo lang('coa_vatin'); ?></td>
        <td  align="center"><?php echo lang('coa_vatout'); ?></td>
        <td  align="center"><?php echo lang('coa_active'); ?></td>
	</tr>
	<?php 
				 $i=0;
				foreach($coa as $val){
				$i++;
                    $acc_type = $val->acc_type;
					$acc_cd=$val->acc_cd;
                    $acc_name=$val->acc_name;
                    $acc_level=$val->acc_level;
                    $acc_class=$val->acc_class;
                    $is_cash=$val->is_cash;
                    $is_bank=$val->is_bank;
                    $is_vat_in=$val->is_vat_in;
                    $is_vat_out=$val->is_vat_out;
                    $active=$val->active;
					?>
	<tr style="font-size:9px">
		<td align="center"><?php echo $i;?></td>
		<td align="left"><?php echo $acc_cd;?></td>
        <td align="left"><?php echo $acc_name;?></td>
		<td align="left"><?php echo $acc_type;?></td>
        <td align="center"><?php echo $acc_level;?></td>
        <td align="left"><?php echo $acc_class;?></td>
        <td align="left"><?php echo $is_cash;?></td>
        <td align="left"><?php echo $is_bank;?></td>
        <td align="left"><?php echo $is_vat_in;?></td>
        <td align="left"><?php echo $is_vat_out;?></td>
        <td align="left"><?php echo $active;?></td>
	</tr>
	<?php }?>
</table>
</div>
</body>
</html>
