<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Print Advance</title>
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
        <td width="50%" align="right">Created : <b><?=ucwords($this->session->userdata('username'))?></b> | Print Date Time : <b><?=date('d F Y H:i:s')?></b></td>
    </tr>
</table>

<div id="header">
    <h2><?php echo lang('advance_details'); ?></h2>
    <?=lang('periode')." : <b>".$periode."</b>"?>
</div>
<br />

<div id="content" style="text-align:center;">
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">
	<tr >
		<th width="3%">No</th>
		<th width="12%"><?php echo lang('advance_number'); ?></th>
        <th width="12%"><?=lang('reimburse_number')?> </th>
        <th width="7%"><?php echo lang('date'); ?></th>
        <th width="10%"><?php echo lang('advance_type'); ?></th>
		<th width="12%"><?php echo lang('debtor_name'); ?></th>
		<th width="12%"><?php echo lang('dp_for_creditor'); ?></th>
		<th><?php echo lang('remark'); ?></th>
		<th width="8%"><?php echo lang('amount'); ?> (Rp)</th>
	</tr>
	<?php 
	$i=0;
    if(!empty($advances)){	
        foreach($advances as $val){
            $i++;
            $get_data_reimburse = $this->advance_model->get_data_reimburse_by_advance_number($val->advance_number);
            $reimburse_no = '-';
            if(count($get_data_reimburse) > 0){
                $reimburse_no = '';
                foreach($get_data_reimburse as $row_reimburse){
                    $reimburse_no .= $row_reimburse->reimburse_number.', ';
                }
                $reimburse_no = substr($reimburse_no,0,-2);
            }
	?>
	<tr style="font-size:9px">
		<td align="center"><?php echo $i;?></td>
		<td><?=$val->advance_number?></td>
        <td><?=$reimburse_no?></td>
		<td><?=date("d-m-Y",strtotime($val->advance_date))?></td>
		<td><?=ucwords(strtolower($val->advance_name))?></td>
		<td><?=$val->debtor_cd.' - '.$val->debtor_name?></td>
		<td><?=$val->creditor_name == '' ? '-' : $val->creditor_name?></td>
		<td><?=$val->remark?></td>
        <td align="right"><?=number_format($val->advance_total,0)?></td>
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
</div>
</body>
</html>
