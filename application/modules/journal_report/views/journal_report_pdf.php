<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=lang('journal_report')?> Report</title>
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
    <span style="font-size: 16px;"><?=strtoupper(lang('journal_report').' Report')?></span><br />
</div>
<div id="content">
Period : <?=date('m-Y',strtotime($str_start_date)).' ('.$str_start_date.' to '.$str_end_date.')';?> <br />
<table width="100%" cellpadding="1" cellspacing="0">
	<tr>
        <th style="border: #000000 solid 1px;" width="15%" colspan="2"><?=lang('date')?></th>
        <th style="border: #000000 solid 1px;" width="12%">Account No</th>
        <th style="border: #000000 solid 1px;"><?=lang('description')?></th>
        <th style="border: #000000 solid 1px;" colspan="2">Reference</th>
        <th style="border: #000000 solid 1px;" width="15%">Debit</th>
        <th style="border: #000000 solid 1px;" width="15%">Credit</th>
    </tr>
	<?php 
    $i=0;    
    if (!empty($general_ledgers)) {
        $count_data = count($general_ledgers);
        foreach($general_ledgers as $general_ledger) { 
            $i++;
            $debit = 0;
            $credit = 0;
            
            $prefix_ref = preg_replace('/[0-9]+/', '', $general_ledger->gl_trx_hdr_ref_no);
            $code_ref = substr($general_ledger->gl_trx_hdr_ref_no,-5);
            
            if($general_ledger->trx_amt > 0){
                $debit = $general_ledger->trx_amt;          
            }
            else{
                $credit = $general_ledger->trx_amt * -1;                            
            }
            
            $description = $general_ledger->descs == '' ? '-' : $general_ledger->descs;
            
            if($i == 1){
    ?>
            	<tr valign="top">
    				<td rowspan="<?=$count_data?>" style="border: #000000 solid 1px;" width="10%" align="center"><?=date("M'Y",strtotime($general_ledger->gl_trx_hdr_journal_date))?></td>
    				<td style="border: #000000 solid 1px;" align="center" width="5%"><?=date('d',strtotime($general_ledger->gl_trx_hdr_journal_date))?></td>
    				<td style="border: #000000 solid 1px;"><?=$general_ledger->acc_cd?></td>
    				<td style="border: #000000 solid 1px;<?=$credit > 0 ? 'padding-left:20px;' : ''?>">
                        <?=$general_ledger->acc_name.'<br>('.$description.')'?>
                    </td>
    				<td style="border: #000000 solid 1px;"><?=$prefix_ref?></td>
    				<td style="border: #000000 solid 1px;"><?=$code_ref?></td>
    				<td style="border: #000000 solid 1px;" align="right"><?=number_format($debit,2)?></td>
    				<td style="border: #000000 solid 1px;" align="right"><?=number_format($credit,2)?></td>
            	</tr>
    <?php
            }
            else{
    ?>
            	<tr>
    				<td style="border: #000000 solid 1px;" width="5%" align="center"><?=date('d',strtotime($general_ledger->gl_trx_hdr_journal_date))?></td>
    				<td style="border: #000000 solid 1px;"><?=$general_ledger->acc_cd?></td>
    				<td style="border: #000000 solid 1px;<?=$credit > 0 ? 'padding-left:20px;' : ''?>">
                        <?=$general_ledger->acc_name.'<br>('.$description.')'?>
                    </td>
    				<td style="border: #000000 solid 1px;"><?=$prefix_ref?></td>
    				<td style="border: #000000 solid 1px;"><?=$code_ref?></td>
    				<td style="border: #000000 solid 1px;" align="right"><?=number_format($debit,2)?></td>
    				<td style="border: #000000 solid 1px;" align="right"><?=number_format($credit,2)?></td>
            	</tr>
	<?php      
            }
        }
        
    }
    
    if($i == 0){
    ?>
        <tr>
            <td colspan="8" align="center" style="border: #000000 solid 1px;">Data not available.</td>
        </tr>
    <?php
    }
    ?>
</table>
</div>

</body>
</html>
