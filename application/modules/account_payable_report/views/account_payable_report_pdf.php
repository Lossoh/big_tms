<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=lang('account_payable_report')?> Report</title>
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
    <span style="font-size: 16px;"><?=strtoupper(lang('account_payable_report').' Report')?></span><br />
    Period : <?=$str_start_date.' to '.$str_end_date;?>
</div>
<div id="content">
<table width="100%">
    <tr>
        <td width="50%" align="left">
            <?php
            if(count($creditor) > 0){
                echo 'Creditor Name : <b>'.$creditor->creditor_name.'</b>';
            }
            ?>
        </td>
        <td width="50%" align="right">
            <?php
                echo 'Paid : <b>'.strtoupper(str_replace('_',' ',$status_paid)).'</b>';
            ?> 
        </td>
    </tr>
</table>
<table width="100%" cellpadding="3" cellspacing="0">
	<tr>
        <th style="border: #000000 solid 1px;" width="3%" rowspan="2">No</th>
        <th style="border: #000000 solid 1px;" width="9%" rowspan="2">AP No</th>
        <th style="border: #000000 solid 1px;" width="7%" rowspan="2">AP <?=lang('date')?></th>
        <th style="border: #000000 solid 1px;" rowspan="2">Creditor Name</th>
        <th style="border: #000000 solid 1px;" width="12%" rowspan="2">Invoice No</th>
        <th style="border: #000000 solid 1px;" width="11%" rowspan="2">AP Total (Rp)</th>
        <th style="border: #000000 solid 1px;" colspan="3">Payment</th>
    </tr> 
    <tr>
        <th style="border: #000000 solid 1px;" width="9%">Payment Date</th>
        <th style="border: #000000 solid 1px;" width="20%">Cheque/Bank</th>
        <th style="border: #000000 solid 1px;" width="11%">Amount (Rp)</th>
    </tr> 
	<?php
    $i=0;
    $total_account_payable = 0;
    $total_payment = 0;
    
    if (!empty($account_payables)) {
        foreach ($account_payables as $account_payable) {
            
            $get_data_cash_bank = $this->account_payable_report_model->get_data_cash_bank_by_account_payable_no($account_payable->trx_no);
            if($status_paid == 'all'){
                $show = true;
            }
            else if($status_paid == 'paid'){
                if(count($get_data_cash_bank) > 0){
                    $show = true;
                }
                else{
                    $show = false;
                }
            }
            
            if($show == true){
                $i++;
                $total_account_payable += $account_payable->total_amt;
            
    ?>
            	<tr>
            		<td style="border: #000000 solid 1px;" align="center"><?=number_format($i)?></td>
    				<td style="border: #000000 solid 1px;"><?=$account_payable->trx_no?></td>
    				<td style="border: #000000 solid 1px;" align="center"><?=date("d-m-Y",strtotime($account_payable->trx_date))?></td>
    				<td style="border: #000000 solid 1px;"><?=$account_payable->creditor_name?></td>
    				<td style="border: #000000 solid 1px;"><?=$account_payable->ref_no?></td>
    				<td style="border: #000000 solid 1px;" align="right"><?=number_format($account_payable->total_amt,2)?></td>
    				<td style="border: #000000 solid 1px;" align="center">
                        <?php
                        if(count($get_data_cash_bank) == 1){
                            foreach($get_data_cash_bank as $row){
                                if($row->cg_date != '1970-01-01')
                                    echo date("d-m-Y",strtotime($row->cg_date));
                                else
                                    echo date("d-m-Y",strtotime($row->trx_date));
                            }
                        }
                        else if(count($get_data_cash_bank) > 1){
                            $n = 1;
                            echo "<table width='100%' cellpadding='0' cellspacing='0'>";
                            foreach($get_data_cash_bank as $row){
                                if($row->cg_date != '1970-01-01'){
                                    echo '
                                        <tr>
                                            <td width="15%" align="left">'.number_format($n).'.</td>
                                            <td width="85%" align="left">'.date("d-m-Y",strtotime($row->cg_date)).'</td>
                                        </tr>
                                    ';                            
                                }    
                                else{
                                    echo '
                                        <tr>
                                            <td width="15%" align="left">'.number_format($n).'.</td>
                                            <td width="85%" align="left">'.date("d-m-Y",strtotime($row->trx_date)).'</td>
                                        </tr>
                                    ';                                
                                }                               
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
                                $check_data = $this->account_payable_report_model->get_data_cash_bank_by_trx_no($row->trx_no);
                                if(count($check_data) == 1){
                                    echo number_format($row->cg_amt,2);
                                    $total_payment += $row->cg_amt;
                                }
                                else{
                                    echo number_format($row->advance_account_payable_amount,2);
                                    $total_payment += $row->advance_account_payable_amount;
                                }  
                            }                                                   
                        }
                        else if(count($get_data_cash_bank) > 1){
                            $n = 1;
                            echo "<table width='100%' cellpadding='0' cellspacing='0'>";
                            foreach($get_data_cash_bank as $row){
                                $check_data = $this->account_payable_report_model->get_data_cash_bank_by_trx_no($row->trx_no);                            
                                if(count($check_data) == 1){
                                    echo '
                                        <tr>
                                            <td width="20%" align="left">'.number_format($n).'.</td>
                                            <td width="80%" align="right">'.number_format($row->cg_amt,2).'</td>
                                        </tr>
                                    ';                                
                                    $total_payment += $row->cg_amt;
                                }
                                else{
                                    echo '
                                        <tr>
                                            <td width="20%" align="left">'.number_format($n).'.</td>
                                            <td width="80%" align="right">'.number_format($row->advance_account_payable_amount,2).'</td>
                                        </tr>
                                    ';  
                                    $total_payment += $row->advance_account_payable_amount;
                                } 
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
            	</tr>
	<?php 
            }
        }
        
    }
    
    if($i == 0){
    ?>
        <tr>
            <td colspan="9" align="center" style="border: #000000 solid 1px;">Data not available.</td>
        </tr>
    <?php
    }
    else{
    ?>
        <tr>
            <td colspan="5" align="right" style="border: #000000 solid 1px;">Total &nbsp; </td>
            <td align="right" style="border: #000000 solid 1px;"><?=number_format($total_account_payable,2)?></td>
            <td colspan="2" align="right" style="border: #000000 solid 1px;">Total &nbsp; </td>
            <td align="right" style="border: #000000 solid 1px;"><?=number_format($total_payment,2)?></td>
        </tr>        
    <?php
    }
    ?>
</table>
</div>

</body>
</html>
