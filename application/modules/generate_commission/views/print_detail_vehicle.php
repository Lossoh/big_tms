<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Detail Commission by Police No</title>
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
	 @page { margin: 10px 75px; }
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
    <b>Detail Commission by Police No</b>
</div>

<div id="content">
    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
    	<tr>
            <td width="12%"><b>Comm No</b></td>
            <td width="2%">:</td>
    		<td width="20%"><?=$commission->commission_no.'['.$commission->period.']'?></td>
            <td>&nbsp;</td>
    	</tr>
    	<tr>
            <td><b>Comm Date</b></td>
            <td>:</td>
    		<td><?=date("d F Y",strtotime($commission->until_date))?></td>
            <td>&nbsp;</td>
    	</tr>     
    </table>  
    <?php
    $total_ritase = 0;
    $total_amount = 0;
        
    if (!empty($vehicles)) {
    ?>
    <table width="85%" border="0" cellpadding="2" cellspacing="0">
    	<tr style="background-color:#fff;color:#000;">
            <th width="5%" style="border:#000 solid 1px;"><div style="margin:5px;">No</div></th>
            <th width="20%" style="border:#000 solid 1px;"><?=lang('police_no')?></th>
            <th width="40%" style="border:#000 solid 1px;"><?=lang('type')?></th>
            <th width="15%" style="border:#000 solid 1px;"><?=lang('ritase')?></th>
            <th width="20%" style="border:#000 solid 1px;"><?=lang('amount')?> (Rp)</th>
        </tr> 
      <?php
        $i = 1;    
        $jumlah_data = count($vehicles);
        
        foreach($vehicles as $row_dtl){
            if($i == $jumlah_data){
    	       $border_bottom = 'border-bottom:#000 solid 1px;';
    	    }
            else{
               $border_bottom = '';
            }
                        
            $total_ritase += $row_dtl->ritase;
            $total_amount += $row_dtl->amount;
            
      ?>
      <tr>
        <td align="center" style="border-left:#000 solid 1px;border-right:#000 solid 1px;<?=$border_bottom?>"><?=$i++?></td>			
    	<td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=strtoupper($row_dtl->police_no)?></td>
    	<td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=strtoupper($row_dtl->vehicle_type)?></td>
    	<td align="center" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=number_format($row_dtl->ritase,0)?></td>
    	<td align="right" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=number_format($row_dtl->amount,0)?></td>
      </tr>
    <?php 
        }
    ?>
   	    <tr style="background-color:#fff;color:#000;">
            <td align="right" colspan="3" style="border:#000 solid 1px;font-weight: bold;">Total &nbsp; </td>
            <td align="center" style="border:#000 solid 1px;font-weight: bold;"><?=number_format($total_ritase,0)?></td>
            <td align="right" style="border:#000 solid 1px;font-weight: bold;"><?=number_format($total_amount,0)?></td>
        </tr> 
    </table>
    <br />
    <?php
    }
    else{
    ?>
    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
    	<tr style="background-color:#fff;color:#000;">
            <th width="5%" style="border:#000 solid 1px;"><div style="margin:5px;">No</div></th>
            <th width="20%" style="border:#000 solid 1px;"><?=lang('police_no')?></th>
            <th width="40%" style="border:#000 solid 1px;"><?=lang('type')?></th>
            <th width="15%" style="border:#000 solid 1px;"><?=lang('ritase')?></th>
            <th width="20%" style="border:#000 solid 1px;"><?=lang('amount')?> (Rp)</th>
        </tr>
        <tr>
            <td align="center" colspan="5" style="border-left:#000 solid 1px;border-right:#000 solid 1px;border-bottom:#000 solid 1px;">Data not available</td>						
        </tr>
    </table>
    <?php
    } 
    ?>
    
</div>
</body>
</html>
