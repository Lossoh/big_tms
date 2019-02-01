<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
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
    <h2><?=$title?> Detail</h2>
    <?=date('d/m/Y',strtotime($until_date))?>
</div>

<div id="content" style="text-align:center;">
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
    <table width="100%" border="1" align="center" cellpadding="2" cellspacing="0">
    	<tr>
    		<td  align="center" height="20px" width="5%">No</td>
    		<td  align="center" width="10%">CA No</td>
            <td  align="center" width="10%">CA Date</td>
    		<td  align="center" width="13%">CA Type</td>
    		<td  align="center" width="13%">Driver/Employee</td>
    		<td  align="center" width="10%">Vehicle</td>
    		<td  align="center" width="10%">Realization No</td>
    		<td  align="center" width="10%">Amount</td>
    		<td  align="center" width="19%">Realization Amount</td>
    	</tr>
    	<?php 
    		$i=1;
            $total_pending = 0;
            $total_realization = 0;
            $total_amount = 0;
            
            if(count($data_cash_adv) > 0){
        		foreach($data_cash_adv as $row){
            	    $type = $row->type_name == '' ? '' : '['.ucwords(strtolower($row->type_name)).']';
                    $amount = $row->advance_amount + $row->advance_extra_amount;
                    $amount_alloc = $row->advance_allocation;
                    $trx_no = '-';
                    
                    $total_amount += $amount;
                    
                    if($row->trx_no == ''){
                        $trx_no = '-';
                    }
                    else{
                        $trx_no = $row->trx_no; 
                        $total_realization += $amount_alloc;
                    }
                    
        ?>
                	<tr style="font-size:9px">
                		<td align="center"><?= $i++?></td>
                		<td align="left"><?= $row->advance_no;?></td>
                		<td align="left"><?= date('d/m/Y',strtotime($row->advance_date));?></td>
                		<td align="left"><?= ucwords(strtolower($row->advance_name));?></td>
                		<td align="left"><?= ucwords(strtolower($row->debtor_name));?></td>
                		<td align="left"><?= $row->police_no.' '.$type;?></td>
                		<td align="left"><?= $trx_no;?></td>
                		<td align="right"><?= number_format($amount,0,',','.');?></td>
                		<td align="right"><?= number_format($amount_alloc,0,',','.');?></td>
                	</tr>
    	<?php 
                }
        ?> 
                <tr>
                    <td colspan="7" align="center">Total (Rp)</td>
                    <td align="right"><?= number_format($total_amount,0,',','.');?></td>
                    <td align="right"><?= number_format($total_realization,0,',','.');?></td>
                </tr>
        <?php      
            }
            else{
                echo '<tr><td align="center" colspan="7">Data not available</td></tr>';
            }
        ?>
    </table>
</div>
</body>
</html>
