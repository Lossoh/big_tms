<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Field Cost Detail</title>
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
    <b><u>Field Cost Detail</u></b><br />
    <b><?=$departement?></b>
</div>
<div id="content" style="text-align:center;">
    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
    	<tr>
            <td width="10%"><b>Comm No</b></td>
            <td width="2%">:</td>
            <td width="61%"><?=$commission->commission_no.'['.$commission->period.']'?></td>
            <td width="10%"><b>Comm Date</b></td>
            <td width="2%">:</td>
    		<td width="15%"><?=date("d F Y",strtotime($commission->until_date))?></td>
    	</tr>   
    </table>      
</div>
<br />
<ul type="disc" style="padding-left: 10px;">
    <li><b>Cash Bank Payment (Driver)</b><br /><br />
        <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
        	<tr style="background-color:#fff;color:#000;">
                <th width="5%" style="border:#000 solid 1px;">No</th>
                <th width="13%" style="border:#000 solid 1px;">Payment No</th>
                <th width="10%" style="border:#000 solid 1px;">Date</th>
                <th width="20%" style="border:#000 solid 1px;">Driver Name</th>
                <th style="border:#000 solid 1px;">Description</th>
                <th width="15%" style="border:#000 solid 1px;">Amount (Rp)</th>
            </tr>
            <?php
            $jumlah_data = count($field_cost_cb_driver);
            $total_cb_driver = 0;
            
            if ($jumlah_data > 0) {
                $i = 1;    
            
                foreach($field_cost_cb_driver as $row_driver){
                    if($i == $jumlah_data){
            	       $border_bottom = 'border-bottom:#000 solid 1px;';
            	    }
                    else{
                       $border_bottom = '';
                    }
                    
                    $total_cb_driver += $row_driver->cg_amt;
            ?>
                    <tr>
                        <td align="center" style="border-left:#000 solid 1px;border-right:#000 solid 1px;<?=$border_bottom?>"><?=$i++?></td>						
                        <td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=$row_driver->trx_no?></td>
                        <td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=date('d-m-Y',strtotime($row_driver->trx_date))?></td>
                        <td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=$row_driver->debtor_name?></td>
                        <td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=$row_driver->descs?></td>
                        <td align="right" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=number_format($row_driver->cg_amt,2)?></td>
                    </tr>
            <?php
                }
            ?>
                <tr style="background-color:#fff;color:#000;">
                    <th align="right" colspan="5" style="border:#000 solid 1px;">Total &nbsp; </th>
                    <th align="right" style="border:#000 solid 1px;"><?=number_format($total_cb_driver,2)?></th>
                </tr>
            <?php
            }
            else{
            ?>
                <tr>
                    <td align="center" colspan="6" style="border-left:#000 solid 1px;border-right:#000 solid 1px;border-bottom:#000 solid 1px;">Data not available</td>						
                </tr>
            <?php
            }
            ?>
        </table>
        <p></p>
    </li>
    <li><b>Cash Bank Payment (Other)</b><br /><br />
        <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
        	<tr style="background-color:#fff;color:#000;">
                <th width="5%" style="border:#000 solid 1px;">No</th>
                <th width="13%" style="border:#000 solid 1px;">Payment No</th>
                <th width="10%" style="border:#000 solid 1px;">Date</th>
                <th width="20%" style="border:#000 solid 1px;">Name</th>
                <th style="border:#000 solid 1px;">Description</th>
                <th width="15%" style="border:#000 solid 1px;">Amount (Rp)</th>
            </tr>
            <?php
            $jumlah_data = count($field_cost_cb_other);
            $total_cb_other = 0;
            
            if ($jumlah_data > 0) {
                $i = 1;    
            
                foreach($field_cost_cb_other as $row_other){
                    if($i == $jumlah_data){
            	       $border_bottom = 'border-bottom:#000 solid 1px;';
            	    }
                    else{
                       $border_bottom = '';
                    }
                    
                    $total_cb_other += $row_other->cg_amt;
            ?>
                    <tr>
                        <td align="center" style="border-left:#000 solid 1px;border-right:#000 solid 1px;<?=$border_bottom?>"><?=$i++?></td>						
                        <td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=$row_other->trx_no?></td>
                        <td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=date('d-m-Y',strtotime($row_other->trx_date))?></td>
                        <td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=$row_other->manual_debtor_creditor?></td>
                        <td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=$row_other->descs?></td>
                        <td align="right" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=number_format($row_other->cg_amt,2)?></td>
                    </tr>
            <?php
                }
            ?>
                <tr style="background-color:#fff;color:#000;">
                    <th align="right" colspan="5" style="border:#000 solid 1px;">Total &nbsp; </th>
                    <th align="right" style="border:#000 solid 1px;"><?=number_format($total_cb_other,2)?></th>
                </tr>
            <?php
            }
            else{
            ?>
                <tr>
                    <td align="center" colspan="6" style="border-left:#000 solid 1px;border-right:#000 solid 1px;border-bottom:#000 solid 1px;">Data not available</td>						
                </tr>
            <?php
            }
            ?>
        </table>
        <p></p>
    </li>
    <li><b>Cost Realization</b><br /><br />
        <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
        	<tr style="background-color:#fff;color:#000;">
                <th width="5%" style="border:#000 solid 1px;">No</th>
                <th width="9%" style="border:#000 solid 1px;">Realization No</th>
                <th width="9%" style="border:#000 solid 1px;">Date</th>
                <th width="9%" style="border:#000 solid 1px;">Police No</th>
                <th width="20%" style="border:#000 solid 1px;">Cost Name</th>
                <th style="border:#000 solid 1px;">Description</th>
                <th width="15%" style="border:#000 solid 1px;">Amount (Rp)</th>
            </tr>
            <?php
            $jumlah_data = count($field_cost_do);
            $total_field_cost_do = 0;
            
            if(count($field_cost_do) > 0){
                $i = 1;
                
                foreach($field_cost_do as $row_do){
                    if($i == $jumlah_data){
            	       $border_bottom = 'border-bottom:#000 solid 1px;';
            	    }
                    else{
                       $border_bottom = '';
                    }
                    
                    $total_field_cost_do += $row_do->trx_amt;
            ?>
                    <tr>
                        <td align="center" style="border-left:#000 solid 1px;border-right:#000 solid 1px;<?=$border_bottom?>"><?=$i++?></td>
                        <td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=$row_do->trx_no?></td>
                        <td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=date('d-m-Y',strtotime($row_do->trx_date))?></td>
                        <td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=$row_do->police_no?></td>
                        <td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=$row_do->cost_name?></td>
                        <td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=$row_do->descs?></td>
                        <td align="right" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=number_format($row_do->trx_amt,2)?></td>
                    </tr>
            <?php
                }
            ?>
                <tr style="background-color:#fff;color:#000;">
                    <th align="right" colspan="6" style="border:#000 solid 1px;">Total &nbsp; </th>
                    <th align="right" style="border:#000 solid 1px;"><?=number_format($total_field_cost_do,2)?></th>
                </tr>
            <?php 
            }
            else{
            ?>
                <tr>
                    <td align="center" colspan="7" style="border:#000 solid 1px;">Data not available</td>						
                </tr>
            <?php   
            }
            ?>
        </table>
        <p></p>
    </li>
</ul>

</body>
</html>
