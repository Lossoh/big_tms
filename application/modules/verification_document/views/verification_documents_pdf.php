<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo lang('verification_documents'); ?></title>
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
    <h2><?php echo lang('verification_documents'); ?></h2>
    <?=lang('periode')." : <b>".$periode."</b>"?>
</div>

<div id="content" style="text-align:center;">
<br />
<table width="100%" border="1" align="center" cellpadding="3" cellspacing="0">
	<tr >
		<th><?=lang('no')?></th>
		<th><?=lang('driver')?>/<?=lang('employee')?> Name</th>
        <th>Document</th>
		<th><?=lang('delivery_order_no')?> </th>
		<th>Receive Date</th>
		<th>Tonase Receive </th>
		<th>JO No </th>
		<th>Vessel Name </th>
		<th>From - To </th>
		<th>Cargo</th>
	</tr>
	<?php 
    $no=1;
    $total_realization = 0;
    if(!empty($verification_documents)){	
        foreach($verification_documents as $doc){
            $document = '';
                                
            if($doc->doc_sj == 'Yes'){
                $document .= 'SJ, ';
            }
            if($doc->doc_st == 'Yes'){
                $document .= 'ST, ';
            }
            if($doc->doc_sm == 'Yes'){
                $document .= 'SM, ';
            }
            if($doc->doc_sr == 'Yes'){
                $document .= 'SR, ';
            }
            
            if($document != ''){
                $document = substr($document,0,-2);
            }
	?>
	<tr style="font-size:9px">
		<td align="center"><?=number_format($no++,0,',','.')?></td>
		<td align="left"><?= $doc->debtor_name;?></td>
		<td align="left"><?= $document;?></td>
		<td align="left"><?= $doc->do_no == '' ? '-' : $doc->do_no;?></td>
        <td align="left"><?= date("d-m-Y",strtotime($doc->received_date));?></td>
		<td align="left"><?= number_format($doc->received_weight,0,',','.');?></td>
		<td align="left"><?= $doc->jo_no;?></td>
		<td align="left"><?= $doc->vessel_name;?></td>
		<td align="left"><?= $doc->from_name.' - '.$doc->to_name;?></td>
		<td align="left"><?= $doc->item_name;?></td>                        
	</tr>
	<?php 
        }
    }
    else{
    ?>
        <tr style="font-size:9px">
		  <td align="center" colspan="10">No Data Available</td>
        </tr>
    <?php
    }
    ?>
</table>
</div>

</body>
</html>
