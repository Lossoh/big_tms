<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>

<style>
    table th,td{
        font-size: 10px;
    }
	body{
	   font-size: 10px;
       font-family: sans-serif;
	}
	 @page { margin: 10px 10px; }
     #header { left: 0px;right: 0px; text-align: center;  }
     #footer { position: fixed; left: 0px; bottom: 100px; right: 0px; font-size: 10px; font-family: sans-serif; text-align:right; }
	 #content{
    	 border-bottom:0px solid #000000;
	 }
     #footer .page:after { content: counter(page, upper-roman); }
	#content{
	   background-color:#FFFFFF;
	} 
</style>

<table width="100%" border="0" cellpadding="2" cellspacing="0">
    <tr>
        <td width="50%">
            <?=$this->config->item('comp_name')?>
        </td>
        <td width="50%" style="text-align:right">
            Print Date Time : <?=date('d F Y H:i:s')?> 
        </td>
    </tr>
</table>

<div id="header">
    <b>Driver Commission (Comm and Loan)</b>
</div>
<?php
if($driver->id_type == 'S')
    $type = 'SIM';
else if($driver->id_type == 'K')
    $type = 'KTP';
else if($driver->id_type == 'P')
    $type = 'Passport';
    
$place = $driver->pob == '' ? '-' : $driver->pob; 
$driver_name = ucwords(strtolower($driver->debtor_name)).' / '.$driver->id_no.' ('.$type.') / '.$place.', '.date('d F Y',strtotime($driver->dob));
$driver_code = $driver->debtor_cd;

?>
<div id="content" style="text-align:center;">
    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
    	<tr>
            <td width="15%"><b>Driver Code</b></td>
            <td width="2%">:</td>
            <td width="51%"><?=$driver_code?></td>
            <td width="15%"><b>Comm No</b></td>
            <td width="2%">:</td>
    		<td width="15%"><?=$commission->commission_no?></td>
    	</tr>
    	<tr>
            <td width="15%"><b>Driver Name</b></td>
            <td width="2%">:</td>
            <td width="51%"><?=$driver_name?></td>
            <td width="15%"><b>Comm Date</b></td>
            <td width="2%">:</td>
    		<td width="15%"><?=date("d F Y",strtotime($commission->until_date))?></td>
    	</tr>     
    </table>  
    <?php
    $total_komisi_supir = 0;
    $total_komisi_kernet = 0;
    
    if (!empty($deliveries)) {
    ?>
    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
    	<tr style="background-color:#2e6da4;color:#fff;">
            <th width="5%" style="border:#2e6da4 solid 1px;"><div style="margin:5px;">No</div></th>
            <th width="8%" style="border:#2e6da4 solid 1px;">DO Date</th>
            <th width="17%" style="border:#2e6da4 solid 1px;">DO No</th>
            <th width="10%" style="border:#2e6da4 solid 1px;">Police No</th>
            <th width="16%" style="border:#2e6da4 solid 1px;">Item Name</th>
            <th width="15%" style="border:#2e6da4 solid 1px;">From</th>
            <th width="15%" style="border:#2e6da4 solid 1px;">Destination</th>
            <th width="7%" style="border:#2e6da4 solid 1px;">Driver Comm</th>
            <th width="7%" style="border:#2e6da4 solid 1px;">Co Driver Comm</th>
        </tr> 
      <?php
        $i = 1;    
        $jumlah_data = count($deliveries);
        
        foreach($deliveries as $row_dtl){
            if($i == $jumlah_data){
    	       $border_bottom = 'border-bottom:#2e6da4 solid 1px;';
    	    }
            else{
               $border_bottom = '';
            }
            
            $komisi_supir = $row_dtl->komisi_supir;
            $komisi_kernet = $row_dtl->komisi_kernet;
              
            $total_komisi_supir += $komisi_supir;
            $total_komisi_kernet += $komisi_kernet;
            
      ?>
      <tr>
        <td align="center" style="border-left:#2e6da4 solid 1px;border-right:#2e6da4 solid 1px;<?=$border_bottom?>"><?=$i++?></td>						
    	<td align="left" style="border-right:#2e6da4 solid 1px;<?=$border_bottom?>"><?=date('d/m/Y',strtotime($row_dtl->do_date))?></td>
    	<td align="left" style="border-right:#2e6da4 solid 1px;<?=$border_bottom?>"><?=$row_dtl->do_no == '' ? '-' : strtoupper($row_dtl->do_no)?></td>
    	<td align="left" style="border-right:#2e6da4 solid 1px;<?=$border_bottom?>"><?=strtoupper($row_dtl->police_no)?></td>
    	<td align="left" style="border-right:#2e6da4 solid 1px;<?=$border_bottom?>"><?=ucwords(strtolower($row_dtl->item_name))?></td>
    	<td align="left" style="border-right:#2e6da4 solid 1px;<?=$border_bottom?>"><?=ucwords(strtolower($row_dtl->dari))?></td>
    	<td align="left" style="border-right:#2e6da4 solid 1px;<?=$border_bottom?>"><?=ucwords(strtolower($row_dtl->tujuan))?></td>
    	<td align="right" style="border-right:#2e6da4 solid 1px;<?=$border_bottom?>"><?=number_format($komisi_supir,0,',','.')?></td>
    	<td align="right" style="border-right:#2e6da4 solid 1px;<?=$border_bottom?>"><?=number_format($komisi_kernet,0,',','.')?></td>
      </tr>
    <?php 
        }
    ?>
    </table>
    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
    	<tr style="background-color:#2e6da4;color:#fff;">
            <td align="right" width="86%" style="border:#2e6da4 solid 1px;">Total (Rp)</td>
            <td align="right" width="7%" style="border:#2e6da4 solid 1px;"><?=number_format($total_komisi_supir,0,',','.')?></td>
            <td align="right" width="7%" style="border:#2e6da4 solid 1px;"><?=number_format($total_komisi_kernet,0,',','.')?></td>
      </tr> 
    </table>
    <?php
    }
      else{
    ?>
    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
    	<tr style="background-color:#2e6da4;color:#fff;">
            <th width="5%" style="border:#2e6da4 solid 1px;"><div style="margin:5px;">No</div></th>
            <th width="8%" style="border:#2e6da4 solid 1px;">DO Date</th>
            <th width="17%" style="border:#2e6da4 solid 1px;">DO No</th>
            <th width="10%" style="border:#2e6da4 solid 1px;">Police No</th>
            <th width="16%" style="border:#2e6da4 solid 1px;">Item Name</th>
            <th width="15%" style="border:#2e6da4 solid 1px;">From</th>
            <th width="15%" style="border:#2e6da4 solid 1px;">Destination</th>
            <th width="7%" style="border:#2e6da4 solid 1px;">Driver Comm</th>
            <th width="7%" style="border:#2e6da4 solid 1px;">Co Driver Comm</th>
      </tr> 
      <tr>
            <td align="center" colspan="9" style="border-left:#2e6da4 solid 1px;border-right:#2e6da4 solid 1px;border-bottom:#2e6da4 solid 1px;">Data not available</td>						
      </tr>
    </table>
    <?php
      } 
    ?>
    
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top: 10px;">
        <tr>
            <td width="55%">
                <table width="100%" align="center" cellpadding="2" cellspacing="0" style="margin-top: -110px;">
                	<tr style="background-color:#2e6da4;color:#fff;">
                        <th colspan="5">Loan Detail</th>
                    </tr>
                    <tr style="background-color:#2e6da4;color:#fff;">
                        <th width="5%">No</th>
                        <th width="25%">Cash Advance No</th>
                        <th width="25%">Cash Advance Date</th>
                        <th width="25%">Description</th>
                        <th width="20%">Loan Amount</th>
                    </tr>
                    <?php
                    $total_amount = 0;
                    if(count($cash_advances) > 0){
                        $i = 1;    
                        $jumlah_data = count($cash_advances);
                        
                        foreach($cash_advances as $row_cash){
                            if($i == $jumlah_data){
                    	       $border_bottom = 'border-bottom:#2e6da4 solid 1px;';
                    	    }
                            else{
                               $border_bottom = '';
                            }
                            
                            $total_amount += $row_cash->alloc_amt;
                    ?>
                    <tr>
                        <td align="center"><?=$i++?></td>						
                    	<td align="left"><?=$row_cash->cb_cash_adv_no?></td>
                        <td align="left"><?=date('d/m/Y',strtotime($row_cash->advance_date))?></td>	
                    	<td align="left"><?=$row_cash->description == '' ? '-' : ucfirst(strtolower($row_cash->description))?></td>
                        <td align="right"><?=number_format($row_cash->alloc_amt,0,',','.')?></td>
                    </tr>
                    <?php
                        }
                    }
                    else{
                    ?>
                        <tr>
                            <td align="center" colspan="5">Data not available</td>						
                        </tr>
                    <?php
                    }
                    ?>
                    
   	              <tr style="background-color:#2e6da4;color:#fff;">
                        <td align="right" colspan="4">Total (Rp)</td>
                        <td align="right"><?=number_format($total_amount,0,',','.')?></td>
                  </tr> 
                </table>
            
            </td>
            <td width="5%">&nbsp;</td>
            <td width="40%">
                <?php
                
                $total_deposit = 0;
                if(count($driver) > 0){
                    $total_deposit = $driver->amount_deposit;
                }
                else{
                    $total_deposit = $commission->total_deposit; 
                }
                
                $net = $total_komisi_supir - $total_deposit - $total_amount;
                
                ?>
                <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
                	<tr>
                        <th colspan="2" style="background-color:#2e6da4;color:#fff;border:#2e6da4 solid 1px;">Total Comm and Loan</th>
                    </tr>
                	<tr>
                        <td width="50%" align="left" style="border:#2e6da4 solid 1px;background-color:#2e6da4;color:#fff;">Driver Comm</td>
                        <td width="50%" align="right" style="border:#2e6da4 solid 1px;"><?=number_format($total_komisi_supir,0,',','.')?></td>
                    </tr>
                    <tr>
                        <td align="left" style="border:#2e6da4 solid 1px;background-color:#2e6da4;color:#fff;">Co Driver Comm</td>
                        <td align="right" style="border:#2e6da4 solid 1px;"><?=number_format($total_komisi_kernet,0,',','.')?></td>
                    </tr>
                    <tr>
                        <td align="left" style="border:#2e6da4 solid 1px;background-color:#2e6da4;color:#fff;">Deposit (-)</td>
                        <td align="right" style="border:#2e6da4 solid 1px;"><?=number_format($total_deposit,0,',','.')?></td>
                    </tr>
                    <tr>
                        <td align="left" style="border:#2e6da4 solid 1px;background-color:#2e6da4;color:#fff;">Amount Loan (-)</td>
                        <td align="right" style="border:#2e6da4 solid 1px;"><?=number_format($total_amount,0,',','.')?></td>
                    </tr>
                    <tr>
                        <td align="left" style="border:#2e6da4 solid 1px;background-color:#2e6da4;color:#fff;">Nett Comm (Rp)</td>
                        <td align="right" style="border:#2e6da4 solid 1px;"><?=number_format($net,0,',','.')?></td>
                    </tr>
                    <tr>
                        <th align="center" valign="top" colspan="2"><br /><br />Driver's Signature,</th> 
                    </tr> 
                    <tr>
                        <th align="center" valign="top" colspan="2"><p>&nbsp;</p><p>&nbsp;</p></th> 
                    </tr> 
                    <tr>
                        <td width="30%" colspan="2" align="center"><u> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?=ucwords(strtolower($driver->debtor_name))?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </u></td>
                    </tr>
                </table>
            
            </td>
        </tr>
    </table>
    
    <?php
    
    ?>
</div>
</body>
</html>
