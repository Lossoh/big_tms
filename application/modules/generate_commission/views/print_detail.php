<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Driver Commission (Comm and Loan)</title>
</head>

<body>

<style>
    table th,td{
        font-size: 12px;
    }
	body{
	   font-size: 12px;
       font-family: "Times New Roman", Georgia, Serif;
	}
	 @page { margin: 10px 10px; }
     #header { left: 0px;right: 0px; text-align: center;  }
     #footer { position: fixed; left: 0px; bottom: 100px; right: 0px; font-size: 12px; font-family: "Times New Roman", Georgia, Serif; text-align:right; }
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
$id_no = $driver->id_no == '' ? '-' : $driver->id_no; 
$driver_name = ucwords($driver->debtor_name).' / '.$id_no.' ('.$type.') / '.$place.', '.date('d F Y',strtotime($driver->dob));
$driver_code = $driver->type.$driver->debtor_cd;

?>
<div id="content" style="text-align:center;">
    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
    	<tr>
            <td width="10%"><b>Driver Code</b></td>
            <td width="2%">:</td>
            <td width="61%"><?=$driver_code?></td>
            <td width="10%"><b>Comm No</b></td>
            <td width="2%">:</td>
    		<td width="15%"><?=$commission->commission_no.'['.$commission->period.']'?></td>
    	</tr>
    	<tr>
            <td><b>Driver Name</b></td>
            <td>:</td>
            <td><?=$driver_name?></td>
            <td><b>Comm Date</b></td>
            <td>:</td>
    		<td><?=date("d F Y",strtotime($commission->until_date))?></td>
    	</tr>     
    </table>  
    <?php
    $total_komisi_supir = 0;
    $total_komisi_kernet = 0;
    
    if (!empty($deliveries)) {
    ?>
    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
    	<tr style="background-color:#fff;color:#000;">
            <th width="3%" style="border:#000 solid 1px;"><div style="margin:5px;">No</div></th>
            <th width="8%" style="border:#000 solid 1px;">DO Date</th>
            <th style="border:#000 solid 1px;">DO No</th>
            <th width="8%" style="border:#000 solid 1px;">Container Type</th>
            <th width="10%" style="border:#000 solid 1px;">Police No</th>
            <th width="14%" style="border:#000 solid 1px;">Item Name</th>
            <th width="14%" style="border:#000 solid 1px;">From</th>
            <th width="14%" style="border:#000 solid 1px;">Destination</th>
            <th width="8%" style="border:#000 solid 1px;">Driver Comm</th>
            <th width="8%" style="border:#000 solid 1px;">Co Driver Comm</th>
        </tr> 
      <?php
        $i = 1;    
        $jumlah_data = count($deliveries);
        
        foreach($deliveries as $row_dtl){
            if($i == $jumlah_data){
    	       $border_bottom = 'border-bottom:#000 solid 1px;';
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
        <td align="center" style="border-left:#000 solid 1px;border-right:#000 solid 1px;<?=$border_bottom?>"><?=$i++?></td>						
    	<td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=date('d/m/Y',strtotime($row_dtl->do_date))?></td>
    	<td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=$row_dtl->do_no == '' ? '-' : strtoupper($row_dtl->do_no)?></td>
    	<td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=$row_dtl->container_size == 0 ? '-' : $row_dtl->count_container.' x '.$row_dtl->container_size.' Ft'?></td>
    	<td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=strtoupper($row_dtl->police_no)?></td>
    	<td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=ucwords(strtolower($row_dtl->item_name))?></td>
    	<td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=ucwords(strtolower($row_dtl->dari))?></td>
    	<td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=ucwords(strtolower($row_dtl->tujuan))?></td>
    	<td align="right" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=number_format($komisi_supir,0)?></td>
    	<td align="right" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=number_format($komisi_kernet,0)?></td>
      </tr>
    <?php 
        }
    ?>
   	    <tr style="background-color:#fff;color:#000;">
            <td align="right" colspan="8" style="border:#000 solid 1px;font-weight: bold;">Total (Rp) &nbsp; </td>
            <td align="right" style="border:#000 solid 1px;font-weight: bold;"><?=number_format($total_komisi_supir,0)?></td>
            <td align="right" style="border:#000 solid 1px;font-weight: bold;"><?=number_format($total_komisi_kernet,0)?></td>
        </tr> 
    </table>
    <br />
    <?php
    
    }
    else{
    
    ?>
    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
    	<tr style="background-color:#fff;color:#000;">
            <th width="3%" style="border:#000 solid 1px;"><div style="margin:5px;">No</div></th>
            <th width="8%" style="border:#000 solid 1px;">DO Date</th>
            <th style="border:#000 solid 1px;">DO No</th>
            <th width="8%" style="border:#000 solid 1px;">Container Type</th>
            <th width="10%" style="border:#000 solid 1px;">Police No</th>
            <th width="14%" style="border:#000 solid 1px;">Item Name</th>
            <th width="14%" style="border:#000 solid 1px;">From</th>
            <th width="14%" style="border:#000 solid 1px;">Destination</th>
            <th width="8%" style="border:#000 solid 1px;">Driver Comm</th>
            <th width="8%" style="border:#000 solid 1px;">Co Driver Comm</th>
      </tr> 
      <tr>
            <td align="center" colspan="10" style="border-left:#000 solid 1px;border-right:#000 solid 1px;border-bottom:#000 solid 1px;">Data not available</td>						
      </tr>
    </table>
    <?php
    } 
    ?>
    <br />
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr valign="top">
            <td width="67%">
                <table width="100%" align="center" cellpadding="2" cellspacing="0">
                	<tr style="background-color:#fff;color:#000;">
                        <th colspan="7"><u>Loan Detail</u></th>
                    </tr>
                    <tr style="background-color:#fff;color:#000;">
                        <th width="5%">No</th>
                        <th width="21%">Cash Advance No</th>
                        <th width="12%">CA Date</th>
                        <th>Description</th>
                        <th width="14%">Loan Amount</th>
                        <th width="14%">Loan Deduction Amount</th>
                        <th width="14%">Remaining Loan</th>
                    </tr>
                    <?php
                    $total_loan = 0;
                    $total_amount = 0;
                    $total_remaining = 0;
                    if(count($cash_advances) > 0 || count($cash_advance_loans) > 0){
                        $i = 1;    
                        
                        foreach($cash_advances as $row_cash){
                            //$total_advance = $row_cash->advance_amount + $row_cash->advance_extra_amount;
                            $total_advance = ($row_cash->advance_amount + $row_cash->advance_extra_amount) - ($row_cash->advance_allocation - $row_cash->alloc_amt);
                            $total_loan += $total_advance;
                            $total_amount += $row_cash->alloc_amt;
                            $remaining_loan = $row_cash->advance_balance;
                            $total_remaining += $remaining_loan;
                            
                            $style = "";
                            if(date('Y',strtotime($row_cash->advance_date)) < date('Y')){
                                $style = "font-weight: bold;font-style: italic;";
                            }
                    ?>
                            <tr>
                                <td align="center" style="<?=$style?>"><?=$i++?></td>						
                            	<td align="left" style="<?=$style?>"><?=$row_cash->cb_cash_adv_no?></td>
                                <td align="left" style="<?=$style?>"><?=date('d/m/Y',strtotime($row_cash->advance_date))?></td>	
                            	<td align="left" style="<?=$style?>"><?=$row_cash->description == '' ? '-' : ucfirst(strtolower($row_cash->description))?></td>
                                <td align="right" style="<?=$style?>"><?=number_format($total_advance,2)?></td>
                                <td align="right" style="<?=$style?>"><?=number_format($row_cash->alloc_amt,2)?></td>
                                <td align="right" style="<?=$style?>"><?=number_format($remaining_loan,2)?></td>
                            </tr>
                    <?php
                        }
                        
                        foreach($cash_advance_loans as $row_cash){
                            $check_data = $this->generate_commission_model->get_cash_advance_by_comm_debtor_id_advance_no($commission->commission_no,$driver->rowID,$row_cash->advance_no);
                            if(count($check_data) == 0){
                                $total_advance = $row_cash->advance_amount + $row_cash->advance_extra_amount;
                                $total_loan += $total_advance;
                                $remaining_loan = $row_cash->advance_balance;
                                $total_remaining += $remaining_loan;
                                
                                $style = "";
                                if(date('Y',strtotime($row_cash->advance_date)) < date('Y')){
                                    $style = "font-weight: bold;font-style: italic;";
                                }
                    ?>
                                <tr>
                                    <td align="center" style="<?=$style?>"><?=$i++?></td>						
                                	<td align="left" style="<?=$style?>"><?=$row_cash->advance_no?></td>
                                    <td align="left" style="<?=$style?>"><?=date('d/m/Y',strtotime($row_cash->advance_date))?></td>	
                                	<td align="left" style="<?=$style?>"><?=$row_cash->description == '' ? '-' : ucfirst(strtolower($row_cash->description))?></td>
                                    <td align="right" style="<?=$style?>"><?=number_format($total_advance,2)?></td>
                                    <td align="right" style="<?=$style?>"><?=number_format(0,2)?></td>
                                    <td align="right" style="<?=$style?>"><?=number_format($remaining_loan,2)?></td>
                                </tr>
                            
                    <?php
                            }
                        }
                    ?>
                        <tr style="background-color:#fff;color:#000;">
                            <td align="right" colspan="4" style="font-weight: bold;">Total (Rp) &nbsp; </td>
                            <td align="right" style="font-weight: bold;"><?=number_format($total_loan,2)?></td>
                            <td align="right" style="font-weight: bold;"><?=number_format($total_amount,2)?></td>
                            <td align="right" style="font-weight: bold;"><?=number_format($total_remaining,2)?></td>
                        </tr> 
                    <?php
                    }
                    else{
                    ?>
                        <tr>
                            <td align="center" colspan="7">Data not available</td>						
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </td>
            <td width="3%">&nbsp;</td>
            <td>
                <?php
                
                $total_deposit = 0;
                $get_deposit = $this->generate_commission_model->get_all_commission_detail_by_comm_debtor_id($get_comm->rowID,$driver->rowID);
                if(count($get_deposit) > 0){
                    $total_deposit = $get_deposit->amount_deposit;
                }
                else{
                    $total_deposit = $commission->total_deposit; 
                }
                
                $net = $total_komisi_supir - $total_deposit - $total_amount;
                
                ?>
                <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
                	<tr>
                        <th colspan="3" style="background-color:#fff;color:#000;border:#000 solid 1px;">Total Comm and Loan</th>
                    </tr>
                	<tr>
                        <td width="60%" align="left" style="border:#000 solid 1px;background-color:#fff;color:#000;">Driver Comm</td>
                        <td width="5%" style="align:center;border-top:#000 solid 1px;border-bottom:#000 solid 1px;">Rp</td>
                        <td width="35%" align="right" style="border-top:#000 solid 1px;border-right:#000 solid 1px;border-bottom:#000 solid 1px;"><?=number_format($total_komisi_supir,2)?></td>
                    </tr>
                    <tr>
                        <td align="left" style="border:#000 solid 1px;background-color:#fff;color:#000;">Deposit (-)</td>
                        <td style="align:center;border-top:#000 solid 1px;border-bottom:#000 solid 1px;">Rp</td>
                        <td align="right" style="border-top:#000 solid 1px;border-right:#000 solid 1px;border-bottom:#000 solid 1px;"><?=number_format($total_deposit,2)?></td>
                    </tr>
                    <tr>
                        <td align="left" style="border:#000 solid 1px;background-color:#fff;color:#000;">Loan Deduction Total (-)</td>
                        <td style="align:center;border-top:#000 solid 1px;border-bottom:#000 solid 1px;">Rp</td>
                        <td align="right" style="border-top:#000 solid 1px;border-right:#000 solid 1px;border-bottom:#000 solid 1px;"><?=number_format($total_amount,2)?></td>
                    </tr>
                    <tr>
                        <td align="left" style="border:#000 solid 1px;background-color:#fff;color:#000;font-weight: bold;">Nett Comm</td>
                        <td style="align:center;border-top:#000 solid 1px;border-bottom:#000 solid 1px;font-weight: bold;">Rp</td>
                        <td align="right" style="border-top:#000 solid 1px;border-right:#000 solid 1px;border-bottom:#000 solid 1px;font-weight: bold;"><?=number_format($net,2)?></td>
                    </tr>
                    <tr>
                        <th align="center" valign="top" colspan="3">&nbsp;</th> 
                    </tr>
                    <tr>
                        <td align="left" style="border:#000 solid 1px;background-color:#fff;color:#000;font-weight: bold;">Co Driver Comm</td>
                        <td style="align:center;border-top:#000 solid 1px;border-bottom:#000 solid 1px;font-weight: bold;">Rp</td>
                        <td align="right" style="border-top:#000 solid 1px;border-right:#000 solid 1px;border-bottom:#000 solid 1px;font-weight: bold;"><?=number_format($total_komisi_kernet,2)?></td>
                    </tr>
                    <tr>
                        <th align="center" valign="top" colspan="3"><br /><br />Driver's Signature,</th> 
                    </tr> 
                    <tr>
                        <th align="center" valign="top" colspan="3"><p>&nbsp;</p></th> 
                    </tr> 
                    <tr>
                        <td width="30%" colspan="3" align="center"><u> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?=ucwords($driver->debtor_name)?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </u></td>
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
