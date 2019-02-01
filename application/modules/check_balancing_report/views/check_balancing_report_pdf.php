<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=lang('check_balancing_report')?></title>
</head>

<body>

<style>
    table th,td{
        font-size: 11px;
    }
	body{
	   font-size: 11px;
       font-family: sans-serif;
	}
	 @page { margin: 15px 30px 15px 20px; }
     
     #header { left: 0px; top: 0px; right: 0px; text-align: center;  }
     #footer { left: 0px; bottom: 30px; right: 0px; font-size: 11px; font-family: sans-serif; text-align:right; }
	 #content{
	   border-bottom:0px solid #000000;
       margin-top: 10px;
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
    <span style="font-size: 16px;"><?=strtoupper(lang('check_balancing_report'))?></span><br />
    <span style="font-size: 12px;"><?=$per_end_date?></span><br />
</div>
<div id="content">
<table width="100%" cellpadding="1" cellspacing="0">
	<tr>
        <th style="border: #000000 solid 1px;" width="5%">No</th>
        <th style="border: #000000 solid 1px;" width="13%">Journal No</th>
        <th style="border: #000000 solid 1px;" width="11%">Journal Date</th>
        <th style="border: #000000 solid 1px;">Description</th>
        <th style="border: #000000 solid 1px;" width="15%">Debit (Rp)</th>
        <th style="border: #000000 solid 1px;" width="15%">Credit (Rp)</th>
    </tr>
	<?php 
    $no = 1;
    $journal_no = '';
    $total_debit = 0;
    $total_credit = 0;
    
    if(count($data_gl) > 0) {
        foreach($data_gl as $row) {
            if($row->row_no == 1){
                $debit = $row->trx_amt;
                $credit = 0;
            }
            else{
                $debit = 0;
                $credit = $row->trx_amt;
            }
            
            $total_debit += $debit;
            $total_credit += $credit;
            
    ?>
        	<tr>
        		<td style="border: #000000 solid 1px;" align="center"><?=number_format($no)?></td>
				<td style="border: #000000 solid 1px;"><?=$row->gl_trx_hdr_journal_no?></td>
				<td style="border: #000000 solid 1px;"><?=date('d-m-Y',strtotime($row->gl_trx_hdr_journal_date))?></td>
				<td style="border: #000000 solid 1px;"><?=$row->descs == '' ? '-' : $row->descs;?></td>
				<td style="border: #000000 solid 1px;" align="right"><?=number_format($debit,2)?></td>
				<td style="border: #000000 solid 1px;" align="right"><?=number_format($credit * -1,2)?></td>
        	</tr>
            
	<?php 
            $no++;
        }
    ?>
        <tr>
            <th style="border: #000000 solid 1px;" colspan="4" align="right">Total &nbsp; </th>
            <th style="border: #000000 solid 1px;font-weight: bold;" align="right"><?=number_format($total_debit,2)?></th>
            <th style="border: #000000 solid 1px;" align="right"><?=number_format($total_credit * -1,2)?></th>
        </tr>
    <?php
    }
    else{
    ?>
        <tr>
            <td colspan="6" align="center" style="border: #000000 solid 1px;">Data not available.</td>
        </tr>
    <?php
    }
    ?>
</table>
<p>&nbsp;</p>
</div>

</body>
</html>
