<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=lang('part_service')?></title>
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
    <h2><?php echo lang('part_service'); ?></h2>
</div>

<div id="content" style="text-align:center;">
    <p style="text-align: left;font-size:14px;font-weight: bold;">Part</p>
    <table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">
    	<tr >
    		<th  align="center" width="5%" height="20px">No</th>
    		<th>Part <?=lang('code')?></th>
    		<th><?=lang('part_name')?></th>
            <th><?=lang('variant')?></th>
            <th><?=lang('brand')?></th>
            <th><?=lang('uoms')?></th>
            <th>Discount</th>
            <th><?=lang('sale_price')?> (Rp)</th>
            <th><?=lang('hpp')?> (Rp)</th>
            <th><?=lang('reorder')?></th>
    	</tr>
    	<?php 
        $i=0;
        if(!empty($parts)){	
    	   foreach($parts as $part){
    	    $i++;
            if($part->discount_type == 'price'){
                $discount = 'Rp '.number_format($part->discount,0,',','.');
            }
            else{
                $discount = number_format($part->discount,0,',','.').'%';                                        
            }
       	?>
    					
    	<tr style="font-size:9px">
    		<td align="center"><?php echo $i;?></td>
    		<td><?=$part->code?></td>
    		<td><?=$part->name?></td>
			<td><?=$part->variant?></td>
			<td><?=$part->brand_name?></td>
			<td align="center"><?=$part->uom_cd?></td>
            <td align="right"><?=$discount?></td>
			<td align="right"><?=number_format($part->sale_price)?></td>
			<td align="right"><?=number_format($part->hpp)?></td>
			<td><?=number_format($part->reorder)?></td>
    	</tr>
    	<?php 
            }
        }
        else{
        ?>
            <tr style="font-size:9px">
    		  <td align="center" colspan="9">No Data Available</td>
            </tr>
        <?php
        }
        ?>
    </table>
    <br />
    <p style="text-align: left;font-size:14px;font-weight: bold;">Material</p>
    <table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">
    	<tr >
    		<th  align="center" width="5%" height="20px">No</th>
    		<th>Material <?=lang('code')?></th>
    		<th><?=lang('material_name')?></th>
            <th><?=lang('variant')?></th>
            <th><?=lang('brand')?></th>
            <th><?=lang('uoms')?></th>
            <th>Discount</th>
            <th><?=lang('sale_price')?> (Rp)</th>
            <th><?=lang('hpp')?> (Rp)</th>
            <th><?=lang('reorder')?></th>
    	</tr>
    	<?php 
        $i=0;
        if(!empty($materials)){	
    	   foreach($materials as $material){
            $i++;
            if($material->discount_type == 'price'){
                $discount = 'Rp '.number_format($material->discount,0,',','.');
            }
            else{
                $discount = number_format($material->discount,0,',','.').'%';                                        
            }
       	?>
    					
    	<tr style="font-size:9px">
    		<td align="center"><?php echo $i;?></td>
    		<td><?=$material->code?></td>
    		<td><?=$material->name?></td>
			<td><?=$material->variant?></td>
			<td><?=$material->brand_name?></td>
			<td align="center"><?=$material->uom_cd?></td>
            <td align="right"><?=$discount?></td>
			<td align="right"><?=number_format($material->sale_price)?></td>
			<td align="right"><?=number_format($material->hpp)?></td>
			<td><?=number_format($material->reorder)?></td>
    	</tr>
    	<?php 
            }
        }
        else{
        ?>
            <tr style="font-size:9px">
    		  <td align="center" colspan="9">No Data Available</td>
            </tr>
        <?php
        }
        ?>
    </table>
    <br />
    <p style="text-align: left;font-size:14px;font-weight: bold;">Service</p>
    <table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">
    	<tr >
    		<th  align="center" width="5%" height="20px">No</th>
    		<th>Service <?=lang('code')?></th>
    		<th><?=lang('service_name')?></th>
            <th width="15%"><?=lang('work_hours')?></th>
            <th>Discount</th>
            <th width="15%"><?=lang('flat_rate')?> (Rp)</th>
    	</tr>
    	<?php 
        $i=0;
        if(!empty($services)){	
    	   foreach($services as $service){
    	    $i++;
            if($service->discount_type == 'price'){
                $discount = 'Rp '.number_format($service->discount,0,',','.');
            }
            else{
                $discount = number_format($service->discount,0,',','.').'%';                                        
            }
       	?>
    					
    	<tr style="font-size:9px">
    		<td align="center"><?php echo $i;?></td>
    		<td><?=$service->code?></td>
    		<td><?=$service->name?></td>
			<td><?=number_format($service->work_hours)?></td>
            <td align="right"><?=$discount?></td>
			<td align="right"><?=number_format($service->flat_rate)?></td>
    	</tr>
    	<?php 
            }
        }
        else{
        ?>
            <tr style="font-size:9px">
    		  <td align="center" colspan="5">No Data Available</td>
            </tr>
        <?php
        }
        ?>
    </table>
    <br />
    <p style="text-align: left;font-size:14px;font-weight: bold;">Template</p>
    <table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">
    	<tr>
    		<th align="center" width="5%" height="20px">No</th>
    		<th>Template <?=lang('code')?></th>
    		<th><?=lang('template_name')?></th>
    	</tr>
    	<?php 
        $i=0;
        if(!empty($templates)){	
    	   foreach($templates as $template){
    	   $i++;
       	?>
    					
    	<tr style="font-size:9px">
    		<td align="center"><?php echo $i;?></td>
    		<td><?=$template->code?></td>
    		<td><?=$template->name?></td>
    	</tr>
    	<?php 
            }
        }
        else{
        ?>
            <tr style="font-size:9px">
    		  <td align="center" colspan="3">No Data Available</td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>
</body>
</html>
