<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Driver Commission (Comm) Summary</title>
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
    <b>Driver Commission (Comm) Summary</b>
</div>
<div id="content" style="text-align:center;">
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    	<tr>
            <td width="10%"><b>Comm No</b></td>
            <td width="15%">: <?=$commission->commission_no?></td>
            <td width="75%">&nbsp;</td>
        </tr>
        <tr>
    		<td><b>Comm Date</b></td>
            <td>: <?=date("d F Y",strtotime($commission->until_date))?></td>
            <td>&nbsp;</td>
    	</tr>
        <tr>
    		<td><b>Period</b></td>
            <td>: <?=$commission->period?></td>
            <td>&nbsp;</td>
    	</tr>
    </table>

    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" style="margin-top: 5px;">
    	<tr style="background-color:#fff;color:#000;">
            <th colspan="9" style="border:#000 solid 1px;">Commission Detail</th>
        </tr>
        <tr style="background-color:#fff;color:#000;">
            <th width="5%" style="border:#000 solid 1px;"><div style="margin:5px;">No</div></th>
            <th width="16%" style="border:#000 solid 1px;">Driver Name</th>
            <th width="6%" style="border:#000 solid 1px;">Ritase</th>
            <th width="10%" style="border:#000 solid 1px;">Driver Comm</th>
            <th width="13%" style="border:#000 solid 1px;">Co Driver Comm</th>
            <th width="10%" style="border:#000 solid 1px;">Deposit</th>
            <th width="10%" style="border:#000 solid 1px;">Loan Amount</th>
            <th width="15%" style="border:#000 solid 1px;">Loan Description</th>
            <th width="15%" style="border:#000 solid 1px;">Nett Comm</th>
        </tr> 
      <?php
      if (!empty($commission_details)) {
        $i = 1;    
        $jumlah_data = count($commission_details);
        $total_ritase = 0;
        $total_komisi_supir = 0;
        $total_komisi_kernet = 0;
        $total_deposit = 0;
        $total_amount = 0;
        $total_net = 0;
        
        foreach($commission_details as $row_dtl){
            if($i == $jumlah_data){
    	       $border_bottom = 'border-bottom:#000 solid 1px;';
    	    }
            else{
               $border_bottom = '';
            }    
                
            $net = $row_dtl->driver_commission - $row_dtl->amount_deposit - $row_dtl->amount_loan;
            
            $total_komisi_supir += $row_dtl->driver_commission;
            $total_komisi_kernet += $row_dtl->co_driver_commission;
            $total_deposit += $row_dtl->amount_deposit;
            $total_amount += $row_dtl->amount_loan;
            $total_net += $net;
            
            $deliveries = $this->generate_commission_model->get_all_do_by_comm_debtor_id($comm_no,$row_dtl->debtor_rowID,$get_comm->until_date);
            $jumlah_ritase = count($deliveries);
            $total_ritase += $jumlah_ritase;
            
            // Loan Descriptions
            $description = '<div style="text-align:center">-</div>';
            $data_loan = $this->generate_commission_model->get_cash_advance_by_comm_debtor_id($comm_no,$row_dtl->debtor_rowID);
            if(count($data_loan) == 1){
                $no = 1;
                $description = '';
                foreach($data_loan as $row_loan){
                    $description .= ucfirst(strtolower($row_loan->description));
                    $no++;
                }
            }
            else if(count($data_loan) > 1){
                $no = 1;
                $description = '';
                foreach($data_loan as $row_loan){
                    $description .= $no.'. '.ucfirst(strtolower($row_loan->description)).'<br />';
                    $no++;
                }
            }
      ?>
      <tr>
        <td align="center" style="border-left:#000 solid 1px;border-right:#000 solid 1px;<?=$border_bottom?>"><?=$i++?></td>						
    	<td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=ucwords(strtolower($row_dtl->debtor_name)).' - '.$row_dtl->debtor_cd?></td>
    	<td align="center" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=number_format($jumlah_ritase,0)?></td>
    	<td align="right" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=number_format($row_dtl->driver_commission,0)?></td>
    	<td align="right" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=number_format($row_dtl->co_driver_commission,0)?></td>
    	<td align="right" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=number_format($row_dtl->amount_deposit,2)?></td>
    	<td align="right" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=number_format($row_dtl->amount_loan,2)?></td>
        <td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=$description?></td>
        <td align="right" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=number_format($net,2)?></td>
      </tr>
    <?php 
        }
      } 
    ?>
    	<tr style="background-color:#fff;color:#000;">
            <td colspan="2" align="right" style="border:#000 solid 1px;font-weight: bold;">Total (Rp) &nbsp; </td>
            <td align="center" style="border:#000 solid 1px;font-weight: bold;"><?=number_format($total_ritase,0)?></td>
            <td align="right" style="border:#000 solid 1px;font-weight: bold;"><?=number_format($total_komisi_supir,0)?></td>
            <td align="right" style="border:#000 solid 1px;font-weight: bold;"><?=number_format($total_komisi_kernet,0)?></td>
            <td align="right" style="border:#000 solid 1px;font-weight: bold;"><?=number_format($total_deposit,2)?></td>
            <td align="right" style="border:#000 solid 1px;font-weight: bold;"><?=number_format($total_amount,2)?></td>
            <td align="center" style="border:#000 solid 1px;font-weight: bold;">-</td>
            <td align="right" style="border:#000 solid 1px;font-weight: bold;"><b><?=number_format($total_net,2)?></b></td>
      </tr> 
    </table>
    <table width="50%" border="0" cellpadding="2" cellspacing="0" style="margin-top: 10px;">
    	<tr>
            <td colspan="2" style="background-color:#fff;color:#000;border:#000 solid 1px;"><b>Deposit Calculation</b></td>
        </tr>
        <tr>
            <td width="50%" style="background-color:#fff;color:#000;border:#000 solid 1px;"><b>1. Pendapatan Komisi &lt; Rp 200.000</b></td>
            <td width="50%" style="border:#000 solid 1px;">Deposit = 0</td>
        </tr>
        <tr>
    		<td style="background-color:#fff;color:#000;border:#000 solid 1px;"><b>2. Pendapatan Komisi &gt;= Rp 200.000</b></td>
            <td style="border:#000 solid 1px;">Deposit = 5% from driver comm</td>
    	</tr>
    </table>
    
</div>
</body>
</html>
