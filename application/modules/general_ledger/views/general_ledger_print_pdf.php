<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Print General Ledger</title>
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
<table width="100%">
    <tr>
        <td width="50%" align="left">
            &nbsp; 
        </td>
        <td width="50%" align="right" style="font-size: 10px;">
            Print Date Time : <?=date('d F Y H:i:s')?> 
        </td>
    </tr>
</table>

<div id="header">
    <h2>Print General Ledger</h2>
</div>

<div id="content" style="text-align:center;">
    <table width="100%" border="0" cellpadding="3" cellspacing="0">
    	<tr valign="top">
            <th align="left" width="13%">Journal No</th>
            <th align="left" width="1%">:</th>
            <td align="left"><?= $get_data->journal_no;?></td>
            <th align="left" width="13%">Journal Type</th>
            <th align="left" width="1%">:</th>
            <td align="left" width="27%"><?= ucwords($get_data->journal_type);?></td>
        </tr>
    	<tr valign="top">
    		<th align="left">Journal Date</th>
            <th align="left">:</th>
            <td align="left"><?= date("d F Y",strtotime($get_data->journal_date));?></td>
    		<th align="left">Reference No</th>
            <th align="left">:</th>
            <td align="left"><?= $get_data->ref_no;?></td>
        </tr>
        <tr valign="top">
            <th align="left">Description</th>
            <th align="left">:</th>
            <td align="left"><?= $get_data->descs;?></td>
            <th align="left">Amount (Rp)</th>
            <th align="left">:</th>
            <td align="left"><?= number_format($get_data->trx_amt,0,',','.');?></td>
        </tr>
    </table>
       
    <br />
    <b>Journal Details</b>
    <br />
    <br />
    <table width="100%" border="1" align="center" cellpadding="2" cellspacing="0">
    	<tr>
    		<th height="20px" width="5%">No</th>
    		<th width="20%">Cash Bank</th>
            <th width="8%">D/C Type</th>
    		<th width="23%">D/C Name</th>
    		<th>Description</th>
    		<th width="11%">Debit</th>
    		<th width="11%">Crebit</th>
    	</tr>
    	<?php 
    		$i=1;
            $total_debit = 0;
            $total_credit = 0;
            
            foreach($get_data_detail as $row){
                $acc_name = "-";
                if($row->coa_rowID > 0){
                    $get_data_coa = $this->general_ledger_model->get_by_id_table('gl_coa',$row->coa_rowID);
                    $acc_name = $get_data_coa->acc_name;
                }
                
                $debtor_creditor_type = "-";
                $debtor_creditor_name = "-";
                
                if($row->debtor_creditor_type == 'D'){
                    $debtor_creditor_type = "Debitor";
                    $get_data_debtor = $this->general_ledger_model->get_by_id_table('sa_debtor',$row->debtor_creditor_rowID);
                    $debtor_creditor_name = $get_data_debtor->debtor_name;
                }
                else if($row->debtor_creditor_type == 'C'){
                    $debtor_creditor_type = "Creditor";
                    $get_data_creditor = $this->general_ledger_model->get_by_id_table('sa_creditor',$row->debtor_creditor_rowID);
                    $debtor_creditor_name = $get_data_creditor->creditor_name;
                }
                else{
                    $debtor_creditor_type = "Others";
                    $debtor_creditor_name = "Other";
                }
                
                $debit = 0;
                $credit = 0;
                if($row->row_no == 1){
                    $debit = $row->trx_amt;
                }
                else{
                    $credit =  $row->trx_amt * -1;
                }
                
                $total_debit += $debit;
                $total_credit += $credit;
              
    	?>
        	<tr style="font-size:9px">
        		<td align="center"><?= $i++?></td>
        		<td align="left"><?= $acc_name;?></td>
        		<td align="left"><?= $debtor_creditor_type?></td>
                <td align="left"><?= $debtor_creditor_name?></td>
        		<td align="left"><?= $row->descs?></td>
        		<td align="right"><?= number_format($debit,0,',','.');?></td>
        		<td align="right"><?= number_format($credit,0,',','.');?></td>
        	</tr>
    	<?php 
            }
        ?>
        <tr style="font-size:9px">
      		<td align="right" colspan="5">Total (Rp) &nbsp; </td>
      		<td align="right"><?= number_format($total_debit,0,',','.');?></td>
      		<td align="right"><?= number_format($total_credit,0,',','.');?></td>
        </tr>
    </table>
    
</div>
</body>
</html>
