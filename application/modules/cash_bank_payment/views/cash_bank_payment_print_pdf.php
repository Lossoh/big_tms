<?php
$payment_type = '';
if($cash_bank->payment_type == 'P'){
    $payment_type = 'Payment';
    $from_to = 'To';
    $from_to_cash_bank = 'From';
}
else{
    $payment_type = 'Receive';
    $from_to = 'From';
    $from_to_cash_bank = 'To';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Print Cash Bank <?=$payment_type?></title>
</head>

<body>

<style>
    body,table th,td{
        font-size: 11px;
        font-family: sans-serif;
    }
	 @page { margin: 10px 30px 10px 20px; }
     
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
        <td width="50%" align="right">Created : <b><?=ucwords($this->session->userdata('username'))?></b> | Print Time : <b><?=date('d F Y H:i:s')?></b></td>
    </tr>
</table>

<div id="header">
    <h2>Cash and Bank <?=$payment_type?></h2>
</div>
<div id="content" style="text-align:center;">
    <table width="100%" border="0" cellpadding="3" cellspacing="0">
    	<tr valign="top">
            <th align="left" width="18%"><?=$payment_type?> No / Date</th>
            <th align="left" width="1%">:</th>
            <td align="left" width="40%"><?= $cash_bank->trx_no.' / '.date("d F Y",strtotime($cash_bank->trx_date));?></td>
            <!--
            <th align="left" width="11%">Cash / Bank</th>
            <th align="left" width="1%">:</th>
            <td align="left" width="29%"><?= $cash_bank->acc_cd.' - '.strtoupper($cash_bank->acc_name);?></td>
            -->
            <th align="left" width="11%"><?=$payment_type?> <?=$from_to?></th>
            <th align="left" width="1%">:</th>
            <td align="left" width="29%">
                <?php
                    if($cash_bank->debtor_creditor_type == 'C'){
                        echo strtoupper($cash_bank->creditor_name);
                    }
                    else{
                        $type = '-';
                        if($cash_bank->type == 'C'){
                            $type = 'Company';
                        }
                        else if($cash_bank->type == 'D'){
                            $type = 'Driver';                                
                        }
                        else if($cash_bank->type == 'E'){
                            $type = 'Employee';                                
                        }
                        
                        if($cash_bank->debtor_cd != ''){
                            echo $cash_bank->type.$cash_bank->debtor_cd.' - '.strtoupper($cash_bank->debtor_name).' ['.$type.']';
                        }
                        else{
                            echo strtoupper($cash_bank->manual_debtor_creditor);
                        }
                    }
                ?>
            </td>
        </tr>
    	<tr valign="top">
    		<!--
            <th align="left">Cash & Bank Account</th>
            <th align="left">:</th>
            <td align="left"><?= $cash_bank->acc_cd.' - '.strtoupper($cash_bank->acc_name);?></td>
            -->
            <th align="left">Remark</th>
            <th align="left">:</th>
            <td align="left"><?= $cash_bank->descs;?></td>
            <th align="left">Amount (Rp)</th>
            <th align="left">:</th>
            <td align="right">
            <?php
                if($cash_bank->trx_amt > 0)
                    echo number_format($cash_bank->trx_amt,2,',','.');
                else
                    echo number_format($cash_bank->trx_amt * -1,2,',','.');
            ?>
            </td>
        </tr>
    </table>
       
    <br />
    <table width="100%" border="1" align="center" cellpadding="2" cellspacing="0">
    	<tr>
    		<td  align="center" height="20px" width="5%">No</td>
    		<td  align="center" width="13%">Reference No</td>
            <td  align="center">Description</td>
    		<td  align="center" width="13%">Amount</td>
    	</tr>
    	<?php 
    		$i=1;
            $total_cost = 0;
    		foreach($payment_detail as $payment){
                if($payment->trx_amt > 0)
                    $trx_amt = $payment->trx_amt;
                else
                    $trx_amt = $payment->trx_amt * -1;

    		  $total_payment += $trx_amt;
    	?>
        	<tr style="font-size:9px">
        		<td align="center"><?= $i++?></td>
        		<td align="left"><?= $payment->advance_invoice_no == '' ? '-' : strtoupper($payment->advance_invoice_no);?></td>
        		<td align="left"><?= strtoupper($payment->descs);?></td>
        		<td align="right"><?= number_format($trx_amt,2,',','.');?></td>
        	</tr>
    	<?php 
            }
        ?>
        <tr style="font-size:9px">
      		<td align="right" colspan="3">Total (Rp) &nbsp; </td>
      		<td align="right"><?= number_format($total_payment,2,',','.');?></td>
        </tr>
    </table>
    
    <br />
    <b>Cash & Bank Details</b>
    <br />
    <br />
    <table width="100%" border="1" align="center" cellpadding="2" cellspacing="0">
    	<tr>
    		<td  align="center" height="20px" width="5%">No</td>
    		<td  align="center" width="13%"><?=$payment_type?> Method</td>
            <td  align="center"><?=$from_to_cash_bank?> Cash Bank</td>
    		<td  align="center" width="13%">Cheque/Giro No</td>
    		<td  align="center" width="9%">Date</td>
    		<td  align="center" width="13%">Amount</td>
    	</tr>
    	<?php 
    		$i=1;
            $total_cost = 0;
    		foreach($giro_detail as $giro){
    		  $total_giro += $giro->cg_amt;
              $get_coa = $this->db->get_where('gl_coa', array('rowID' => $giro->cash_bank))->row();
    	?>
        	<tr style="font-size:9px">
        		<td align="center"><?= $i++?></td>
        		<td align="left"><?= strtoupper($giro->payment_method);?></td>
        		<td align="left"><?= $get_coa->acc_cd.' - '.strtoupper($get_coa->acc_name);?></td>
        		<td align="left"><?= $giro->cg_no;?></td>
        		<td align="left"><?= date('d/m/Y',strtotime($giro->cg_date));?></td>
        		<td align="right"><?= number_format($giro->cg_amt,2,',','.');?></td>
        	</tr>
    	<?php 
            }
        ?>
        <tr style="font-size:9px">
            <td align="right" colspan="5">Total (Rp) &nbsp; </td>
      		<td align="right"><?= number_format($total_giro,2,',','.');?></td>
        </tr>
    </table>
    <br />
    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
    	<tr>
    		<th width="25%" style="border: #000 solid 1px;">Director</th>
    		<th width="20%" style="border: #000 solid 1px;">Cashier</th>
    		<th width="5%"></th>
    		<th width="25%" style="border: #000 solid 1px;">Accounting</th>
    		<th width="25%" style="border: #000 solid 1px;">Head Of Finance</th>
    		<th width="25%" style="border: #000 solid 1px;">Received</th>
   	    </tr>
        <tr>
    		<td style="border: #000 solid 1px;"><br /><br /><br /><br /><br /></td>
    		<td style="border: #000 solid 1px;">&nbsp;</td>
    		<td>&nbsp;</td>
    		<td style="border: #000 solid 1px;">&nbsp;</td>
    		<td style="border: #000 solid 1px;">&nbsp;</td>
    		<td style="border: #000 solid 1px;">&nbsp;</td>
   	    </tr>
    </table>
</div>
</body>
</html>
