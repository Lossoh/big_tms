<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=lang('invoice_report')?> Report</title>
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
<br />
<div id="header">
    <span style="font-size: 16px;"><?=strtoupper(lang('invoice_report').' Report')?></span><br />
    Period : <?=$str_start_date.' to '.$str_end_date;?>
</div>
<div id="content">
<?php
if(count($debtor) > 0){
?>
<table width="100%">
    <tr>
        <td width="50%" align="left">
            <?php
                echo 'Debitor Name : <b>'.$debtor->debtor_name.'</b>';
            ?>
        </td>
        <td width="50%" align="right">
            &nbsp; 
        </td>
    </tr>
</table>
<?php
}
?>
<table width="100%" cellpadding="3" cellspacing="0">
	<tr>
        <th style="border: #000000 solid 1px;" width="3%" rowspan="2">No</th>
        <th style="border: #000000 solid 1px;" width="9%" rowspan="2">Invoice No</th>
        <th style="border: #000000 solid 1px;" width="8%" rowspan="2"><?=lang('invoice_date')?></th>
        <th style="border: #000000 solid 1px;" width="8%" rowspan="2">Tonage Total (TON)</th>
        <th style="border: #000000 solid 1px;" width="10%" rowspan="2">Invoice Total (Rp)</th>
        <th style="border: #000000 solid 1px;" colspan="3">Payment</th>
        <th style="border: #000000 solid 1px;" width="11%" rowspan="2">Reference No</th>
        <th style="border: #000000 solid 1px;" width="10%" rowspan="2">Difference Amount (Rp)</th>
    </tr> 
    <tr>
        <th style="border: #000000 solid 1px;" width="9%">Payment Date</th>
        <th style="border: #000000 solid 1px;">Cheque/Bank</th>
        <th style="border: #000000 solid 1px;" width="10%">Amount (Rp)</th>
    </tr> 
	<?php 
    $i=0;
    $total_ton = 0;
    $total_invoice = 0;
    $total_payment = 0;
    $total_difference_amt = 0;
    
    if (!empty($invoices)) {
        foreach ($invoices as $invoice) { 
            $i++;
            if($invoice->weight > 0){
                $weight = $invoice->weight / 1000;
            }
            else{
                $weight = 0;
            }
            $total_ton += $weight; 
            $total_invoice += $invoice->total_amt;
            
            $get_data_cash_bank = $this->invoice_report_model->get_data_cash_bank_by_invoice_no($invoice->trx_no);
            $cb_trx_no = '';
            $cb_trx_amt = 0;
            $difference_amt = 0;
    ?>
        	<tr>
        		<td style="border: #000000 solid 1px;" align="center"><?=number_format($i)?></td>
				<td style="border: #000000 solid 1px;"><?=$invoice->trx_no?></td>
				<td style="border: #000000 solid 1px;" align="left"><?=date("d-m-Y",strtotime($invoice->trx_date))?></td>
				<td style="border: #000000 solid 1px;" align="right"><?=number_format($weight,2)?></td>
				<td style="border: #000000 solid 1px;" align="right"><?=number_format($invoice->total_amt,2)?></td>
				<td style="border: #000000 solid 1px;" align="left">
                    <?php
                    if(count($get_data_cash_bank) == 1){
                        foreach($get_data_cash_bank as $row){
                            echo date("d-m-Y",strtotime($row->trx_date));
                            $cb_trx_no .= $row->trx_no.', ';
                            $cb_trx_amt += $row->advance_invoice_amount;
                        }
                    }
                    else if(count($get_data_cash_bank) > 1){
                        $n = 1;
                        echo "<table width='100%' cellpadding='0' cellspacing='0'>";
                        foreach($get_data_cash_bank as $row){
                            echo '
                                <tr>
                                    <td width="15%" align="left">'.number_format($n).'.</td>
                                    <td width="85%" align="left">'.date("d-m-Y",strtotime($row->trx_date)).'</td>
                                </tr>
                            ';   
                            
                            $cb_trx_no .= $row->trx_no.', ';                             
                            $cb_trx_amt += $row->advance_invoice_amount;

                            $n++;
                        }       
                        echo "</table>";                                                
                    }
                    else{
                        echo '<div style="text-align:center">-</div>';
                    }
                    ?>
                </td>
				<td style="border: #000000 solid 1px;">
                    <?php
                    if(count($get_data_cash_bank) == 1){
                        foreach($get_data_cash_bank as $row){
                            echo $row->acc_name.'<br />';    
                        }                                                   
                    }
                    else if(count($get_data_cash_bank) > 1){
                        $n = 1;
                        echo "<table width='100%' cellpadding='0' cellspacing='0'>";
                        foreach($get_data_cash_bank as $row){
                            echo '
                                <tr>
                                    <td width="15%" align="left">'.number_format($n).'.</td>
                                    <td width="85%" align="left">'.$row->acc_name.'</td>
                                </tr>
                            ';
                            
                            $n++;
                        }                                                   
                        echo "</table>";                                                  
                    }
                    else{
                        echo '<div style="text-align:center">-</div>';
                    }
                    ?>
                </td>
				<td style="border: #000000 solid 1px;" align="right">
                    <?php
                    if(count($get_data_cash_bank) == 1){
                        foreach($get_data_cash_bank as $row){
                            echo number_format($row->advance_invoice_amount,2);
                            $total_payment += $row->advance_invoice_amount;  
                        }                                                   
                    }
                    else if(count($get_data_cash_bank) > 1){
                        $n = 1;
                        echo "<table width='100%' cellpadding='0' cellspacing='0'>";
                        foreach($get_data_cash_bank as $row){    
                            echo '
                                <tr>
                                    <td width="20%" align="left">'.number_format($n).'.</td>
                                    <td width="80%" align="right">'.number_format($row->advance_invoice_amount,2).'</td>
                                </tr>
                            ';  
                            $total_payment += $row->advance_invoice_amount;
                            $n++;
                        }                                                   
                        echo "</table>";
                    }
                    else{
                        echo number_format(0,2);
                        $total_payment += 0;
                    }
                    ?>
                </td>
                <td style="border: #000000 solid 1px;"><?=$cb_trx_no == '' ? '<div style="text-align:center">-</div>' : substr($cb_trx_no,0,-2);?></td>
				<td style="border: #000000 solid 1px;" align="right">
                    <?php
                        $difference_amt = $invoice->total_amt - $cb_trx_amt;
                        $total_difference_amt += $difference_amt;
                        
                        echo number_format($difference_amt,2);
                    ?>
                </td>
        	</tr>
	<?php 
        }
        
    }
    
    if($i == 0){
    ?>
        <tr>
            <td colspan="10" align="center" style="border: #000000 solid 1px;">Data not available.</td>
        </tr>
    <?php
    }
    else{
    ?>
        <tr>
            <td colspan="3" align="right" style="border: #000000 solid 1px;">Total &nbsp; </td>
            <td align="right" style="border: #000000 solid 1px;"><?=number_format($total_ton,2)?></td>
            <td align="right" style="border: #000000 solid 1px;"><?=number_format($total_invoice,2)?></td>
            <td colspan="2" align="right" style="border: #000000 solid 1px;">Total &nbsp; </td>
            <td align="right" style="border: #000000 solid 1px;"><?=number_format($total_payment,2)?></td>
            <td align="right" style="border: #000000 solid 1px;">Total &nbsp; </td>
            <td align="right" style="border: #000000 solid 1px;"><?=number_format($total_difference_amt,2)?></td>
        </tr>        
    <?php
    }
    ?>
</table>
</div>

</body>
</html>
