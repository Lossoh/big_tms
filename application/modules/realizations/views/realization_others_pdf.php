<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo lang('realization'); ?> Receipt</title>
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

<table width="100%">
    <tr>
        <td width="50%" align="left">
            <?=$this->config->item('comp_name')?>
        </td>
        <td width="50%" align="right" style="font-size: 10px;">
            Created : <b><?=ucwords($this->session->userdata('username'))?></b> | Print Time : <b><?=date('d F Y H:i:s')?></b>
        </td>
    </tr>
</table>

<div id="header">
    <h2><?php echo lang('realization'); ?> Receipt</h2>
    <?= $cash_advance->alloc_no == '' ? '-' : $cash_advance->alloc_no;?> - <?= date("d/m/Y",strtotime($cash_advance->alloc_date));?>
</div>

<div id="content" style="text-align:center;">
    <table width="100%" border="0" cellpadding="3" cellspacing="0">
    	<tr>
            <th align="left" width="24%"><?= lang('cash_advance_no'); ?></th>
            <th align="left" width="1%">:</th>
            <td align="left" width="35%"><?= $cash_advance->advance_no;?></td>
            <th align="left" width="24%"><?= lang('cash_advance_amt'); ?> (Rp)</th>
            <th align="left" width="1%">:</th>
            <td align="right" width="15%"><?= number_format($cash_advance->advance_amount,0,',','.');?></td>
        </tr>
    	<tr>
    		<th align="left">Transaction Type</th>
            <th align="left">:</th>
            <td align="left"><?= ucwords(strtolower($cash_advance->advance_name));?></td>
    		<th align="left"><?= lang('extra_amount'); ?> (Rp)</th>
            <th align="left">:</th>
            <td align="right"><?= number_format($cash_advance->advance_extra_amount,0,',','.');?></td>
        </tr>
        <tr>
            <th align="left"><?= lang('date'); ?></th>
            <th align="left">:</th>
            <td align="left"><?= date("d F Y",strtotime($cash_advance->advance_date));?></td>
    		<th align="left">Addendum (Rp)</th>
            <td align="left">:</td>
            <td align="right">
                <?= number_format($cash_advance->pay_over_allocation,0,',','.');?>
            </td>
        </tr>
        <tr>
    		<th align="left"><?=lang('driver')?>/<?=lang('employee')?> Name</th>
            <th align="left">:</th>
            <td align="left">
                <?php
                    $type = '-';
                    if($cash_advance->type == 'C'){
                        $type = 'Company';
                    }
                    else if($cash_advance->type == 'D'){
                        $type = 'Driver';                                
                    }
                    else if($cash_advance->type == 'E'){
                        $type = 'Employee';                                
                    }
                ?>
                <?=$cash_advance->type.$cash_advance->debtor_code?> - <?=ucwords(strtolower($cash_advance->debtor_name))?> [<?=$type?>]
            </td>
    		<th align="left"><?= lang('cash_advance_alloc'); ?> (Rp)</th>
            <th align="left">:</th>
            <td align="right"><?= number_format($cash_advance->alloc_amt,0,',','.');?></td>
        </tr>
        <tr>
            <th align="left"><?= lang('status'); ?></th>
            <th align="left">:</th>
            <td align="left">
                <?php
                $status = '-';
                $status_external = '-';
                
                if($cash_advance->status == 1){
                    $status = lang('cancel_load');
                }
                if($cash_advance->status == 2){
                    $status = 'POK';
                }
                if($cash_advance->status == 3){
                    $status = 'POK Vehicle External';
                }
                if($cash_advance->status == 4){
                    if($cash_advance->status_external == 1){
                        $status_external = 'POK Vehicle External & ';
                    }
                    else{
                        $status_external = '';
                    }
                    
                    if($cash_advance->reference_pok_no_2 == ''){
                        $reference_pok_no_1 = $cash_advance->reference_pok_no_1 == "" ? "-" : $cash_advance->reference_pok_no_1;
                        $status = $status_external.'POK Vehicle Internal ['.$reference_pok_no_1.']';
                    }
                    else{
                        $status = $status_external.'POK Vehicle Internal ['.$cash_advance->reference_pok_no_1.' & '.$cash_advance->reference_pok_no_2.']';
                    }
                }
                
                echo '<b>'.$status.'</b>';
                ?>
            </td>
    		<th align="left"><?= lang('balance'); ?> (Rp)</th>
            <th align="left">:</th>
            <td align="right">
                <?php
                $total_balance = ($cash_advance->advance_amount + $cash_advance->advance_extra_amount + $cash_advance->pay_over_allocation) - $cash_advance->advance_allocation; 
                ?>
                <?= number_format($total_balance,0,',','.');?>
            </td>
    	</tr>
    </table>
       
    <br />
    <b><?=lang('cost_code_details')?></b>
    <br />
    <br />
    <table width="100%" border="1" align="center" cellpadding="2" cellspacing="0">
    	<tr>
    		<th  align="center" height="20px" width="5%">No</th>
    		<th  align="center" width="27%"><?= lang('cost'); ?> Code</th>
            <th  align="center"><?= lang('description'); ?></th>
    		<th  align="center" width="13%"><?= lang('amount'); ?></th>
    	</tr>
    	<?php 
    		$i=1;
            $total_cost = 0;
    		foreach($costs as $cost){
    		  $total_cost += $cost->trx_amt;
    	?>
        	<tr style="font-size:9px">
        		<td align="center"><?= $i++?></td>
        		<td align="left"><?= ucfirst(strtolower($cost->cost_name));?></td>
        		<td align="left"><?= $cost->descs;?></td>
        		<td align="right"><?= number_format($cost->trx_amt,0,',','.');?></td>
        	</tr>
    	<?php 
            }
        ?>
        <tr style="font-size:9px">
      		<td align="right" colspan="3"><b>Total (Rp)</b> &nbsp; </td>
            <td align="right"><b><?= number_format($total_cost,0,',','.');?></b></td>
        </tr>
    </table>
</div>

<?php
if(count($cash_advance_refund) > 0){
?>
<p>&nbsp;</p>
<hr />
<div id="header">
    <h2><?php echo lang('refund'); ?> Receipt</h2>
    <?= $cash_advance_refund->alloc_no == '' ? '-' : $cash_advance_refund->alloc_no;?> - <?= date("d/m/Y",strtotime($cash_advance_refund->alloc_date));?>
</div>

<div id="content" style="text-align:center;">

    <table width="100%" border="0" cellpadding="3" cellspacing="0">
    	<tr>
            <th align="left" width="24%"><?= lang('cash_advance_no'); ?></th>
            <th align="left" width="1%">:</th>
            <td align="left" width="35%"><?= $cash_advance_refund->advance_no;?></td>
            <th align="left" width="24%"><?= lang('cash_advance_amt'); ?> (Rp)</th>
            <th align="left" width="1%">:</th>
            <td align="right" width="15%"><?= number_format($cash_advance_refund->advance_amount,0,',','.');?></td>
        </tr>
    	<tr>
    		<th align="left">Transaction Type</th>
            <th align="left">:</th>
            <td align="left"><?= ucwords(strtolower($cash_advance_refund->advance_name));?></td>
    		<th align="left"><?= lang('extra_amount'); ?> (Rp)</th>
            <th align="left">:</th>
            <td align="right"><?= number_format($cash_advance_refund->advance_extra_amount,0,',','.');?></td>
        </tr>
        <tr>
            <th align="left"><?= lang('date'); ?></th>
            <th align="left">:</th>
            <td align="left"><?= date("d F Y",strtotime($cash_advance_refund->advance_date));?></td>
    		<th align="left"><?= lang('cash_advance_alloc'); ?> (Rp)</th>
            <td align="left">:</td>
            <td align="right">
                <?= number_format($cash_advance_refund->alloc_amt,0,',','.');?>
            </td>
        </tr>
        <tr>
    		<th align="left"><?=lang('driver')?>/<?=lang('employee')?> Name</th>
            <th align="left">:</th>
            <td align="left">
                <?php
                    $type = '-';
                    if($cash_advance_refund->type == 'C'){
                        $type = 'Company';
                    }
                    else if($cash_advance_refund->type == 'D'){
                        $type = 'Driver';                                
                    }
                    else if($cash_advance_refund->type == 'E'){
                        $type = 'Employee';                                
                    }
                ?>
                <?=$cash_advance_refund->type.$cash_advance_refund->debtor_code?> - <?=ucwords(strtolower($cash_advance_refund->debtor_name))?> [<?=$type?>]
            </td>
    		<th align="left">&nbsp;</th>
            <td align="left">&nbsp;</td>
            <td align="right">&nbsp;</td>
        </tr>
        
    </table>
</div>
<?php
}
?>
</body>
</html>
