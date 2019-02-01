<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Detail Delivery Orders</title>
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
    <b><u>Detail Delivery Orders</u></b>
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
   
    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
    	<tr style="background-color:#fff;color:#000;">
            <th style="border:#000 solid 1px;">No</th>
            <th style="border:#000 solid 1px;">Cash Advance No</th>
            <th style="border:#000 solid 1px;">Cash Advance Date</th>
            <th style="border:#000 solid 1px;">Driver Name</th>
            <th style="border:#000 solid 1px;">Police No</th>
            <th style="border:#000 solid 1px;">Vehicle Type</th>
            <th style="border:#000 solid 1px;">Job Order No</th>
            <th style="border:#000 solid 1px;">Destination</th>
            <th style="border:#000 solid 1px;">Point</th>
            <th style="border:#000 solid 1px;">Delivery Order No</th>
            <th style="border:#000 solid 1px;">Tonnage</th>
        </tr>
      <?php
      $jumlah_data = count($do_details);
        
      if ($jumlah_data > 0) {
        $i = 1;    
        
        foreach($do_details as $row_dtl){
            if($i == $jumlah_data){
    	       $border_bottom = 'border-bottom:#000 solid 1px;';
    	    }
            else{
               $border_bottom = '';
            }
            
      ?>
        <tr>
            <td align="center" style="border-left:#000 solid 1px;border-right:#000 solid 1px;<?=$border_bottom?>"><?=$i++?></td>						
            <td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=$row_dtl->advance_no?></td>
            <td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=$row_dtl->advance_date?></td>
            <td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=$row_dtl->debtor_name?></td>
            <td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=$row_dtl->police_no?></td>
            <td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=$row_dtl->type_name?></td>
            <td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=$row_dtl->jo_no?></td>
            <td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=$row_dtl->fare_trip_cd?></td>
            <td align="center" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=number_format($row_dtl->poin)?></td>
            <td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=$row_dtl->do_no?></td>
            <td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=number_format($row_dtl->received_weight)?></td>                        
        </tr>
    <?php 
        }
    }
    else{
    ?>
        <tr>
            <td align="center" colspan="11" style="border-left:#000 solid 1px;border-right:#000 solid 1px;border-bottom:#000 solid 1px;">Data not available</td>						
        </tr>
    <?php
    } 
    ?>
    </table>
</div>
</body>
</html>
