<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Delivery Order</title>
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
    <b><u>Delivery Order</u></b><br />
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
    <?php
    $total_tonase = 0;
    $total_ritase = 0;
    $total_pok = 0;
    $total_point = 0;
    $total_ca_amount = 0;
    $total_komisi_supir = 0;
    $total_komisi_kernet = 0;
    $total_bag = 0;
    $total_tariff = 0;
    $grand_total = 0;
    
    ?>
    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
    	<tr style="background-color:#fff;color:#000;">
            <th width="4%" style="border:#000 solid 1px;">No</th>
            <th width="9%" style="border:#000 solid 1px;">Police No</th>
            <th style="border:#000 solid 1px;">Vehicle Type</th>
            <th width="7%" style="border:#000 solid 1px;">Ton</th>
            <th width="5%" style="border:#000 solid 1px;">Ritase</th>
            <th width="5%" style="border:#000 solid 1px;">POK</th>
            <th width="5%" style="border:#000 solid 1px;">Point</th>
            <th width="12%" style="border:#000 solid 1px;">CA Amount (Rp)</th>
            <th width="11%" style="border:#000 solid 1px;">Driver Comm (Rp)</th>
            <th width="11%" style="border:#000 solid 1px;">Co Driver Comm (Rp)</th>
            <th width="11%" style="border:#000 solid 1px;">Tariff (Rp)</th>
            <th width="12%" style="border:#000 solid 1px;">Total (Rp)</th>
        </tr>
      <?php
      $jumlah_data = count($deliveries);
        
      if ($jumlah_data > 0) {
        $i = 1;    
        
        foreach($deliveries as $row_dtl){
            if($i == $jumlah_data){
    	       $border_bottom = 'border-bottom:#000 solid 1px;';
    	    }
            else{
               $border_bottom = '';
            }
            
            $get_pok = $this->generate_commission_model->get_do_pok_by_police_no_comm($row_dtl->police_no,$comm_no,$until_date);
            $get_point = $this->generate_commission_model->get_do_point_by_police_no_comm($row_dtl->police_no,$comm_no,$until_date);
            
            $get_tariff = $this->generate_commission_model->get_do_jo_by_comm($row_dtl->police_no,$comm_no,$until_date);
            $tariff = 0;
            foreach($get_tariff as $row_tarif){
                if($row_tarif->wholesale == 0){
                    $tariff += $row_tarif->received_weight * $row_tarif->price_amount;
                }
                else{
                    $tariff += $row_tarif->price_amount;
                }
            }
            
            if(count($get_departement) == 0){
                $get_ca_amount = $this->generate_commission_model->get_realization_amount_by_comm($comm_no,$until_date,$row_dtl->police_no);
            }
            else{
                $get_ca_amount = $this->generate_commission_model->get_realization_amount_by_comm_departement($comm_no,$until_date,$row_dtl->police_no,$get_departement->rowID);                
            }
            
            $ca_amount = 0;
            if(count($get_ca_amount) > 0){
                foreach($get_ca_amount as $row_alloc){
                    $ca_amount += $row_alloc->alloc_amt;
                }
            }
            
            $tonase = $row_dtl->tonase / 1000;
            $ritase = $row_dtl->ritase;
            $komisi_supir = $row_dtl->komisi_supir;
            $komisi_kernet = $row_dtl->komisi_kernet;
            $pok = $get_pok->pok;
            $point = $get_point->point;
            
            $total = $tariff - $ca_amount - $komisi_supir - $komisi_kernet;
            
            $total_tonase += $tonase;
            $total_ritase += $ritase;
            $total_pok += $pok;
            $total_point += $point;
            $total_ca_amount += $ca_amount;
            $total_komisi_supir += $komisi_supir;
            $total_komisi_kernet += $komisi_kernet;
            $total_tariff += $tariff;
            $grand_total += $total;
            
      ?>
        <tr>
            <td align="center" style="border-left:#000 solid 1px;border-right:#000 solid 1px;<?=$border_bottom?>"><?=$i++?></td>						
            <td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=$row_dtl->police_no?></td>
            <td align="left" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=$row_dtl->vehicle_type?></td>
            <td align="center" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=number_format($tonase,2)?></td>
            <td align="center" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=number_format($ritase,0)?></td>
            <td align="center" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=number_format($pok,0)?></td>
            <td align="center" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=number_format($point,0)?></td>
            <td align="right" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=number_format($ca_amount,2)?></td>
            <td align="right" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=number_format($komisi_supir,0)?></td>
            <td align="right" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=number_format($komisi_kernet,0)?></td>
            <td align="right" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=number_format($tariff,2)?></td>            
            <td align="right" style="border-right:#000 solid 1px;<?=$border_bottom?>"><?=number_format($total,2)?></td>            
        </tr>
    <?php 
        }
    ?>
   	    <tr style="background-color:#fff;color:#000;">
            <td align="right" colspan="3" style="border:#000 solid 1px;font-weight: bold;">Total &nbsp; </td>
            <td align="center" style="border:#000 solid 1px;font-weight: bold;"><?=number_format($total_tonase,2)?></td>
            <td align="center" style="border:#000 solid 1px;font-weight: bold;"><?=number_format($total_ritase,0)?></td>
            <td align="center" style="border:#000 solid 1px;font-weight: bold;"><?=number_format($total_pok,0)?></td>
            <td align="center" style="border:#000 solid 1px;font-weight: bold;"><?=number_format($total_point,0)?></td>
            <td align="right" style="border:#000 solid 1px;font-weight: bold;"><?=number_format($total_ca_amount,2)?></td>
            <td align="right" style="border:#000 solid 1px;font-weight: bold;"><?=number_format($total_komisi_supir,0)?></td>
            <td align="right" style="border:#000 solid 1px;font-weight: bold;"><?=number_format($total_komisi_kernet,0)?></td>
            <td align="right" style="border:#000 solid 1px;font-weight: bold;"><?=number_format($total_tariff,2)?></td>
            <td align="right" style="border:#000 solid 1px;font-weight: bold;"><?=number_format($grand_total,2)?></td>
        </tr>
    <?php
    }
    else{
    ?>
        <tr>
            <td align="center" colspan="12" style="border-left:#000 solid 1px;border-right:#000 solid 1px;border-bottom:#000 solid 1px;">Data not available</td>						
        </tr>
    <?php
    } 
    ?>
    </table>
</div>

<br /><br />
<div id="header">
    <u><b>Field Cost</b></u>
</div>
<ul type="disc" style="padding-left: 10px;">
    <li>Cash Bank Payment (Driver) : <b>Rp <?=number_format($field_cost_cb_driver,2)?></b></li>
    <li>Cash Bank Payment (Other) &nbsp;: <b>Rp <?=number_format($field_cost_cb_other,2)?></b></li>
    <li>
        Cost Realization : <br /><br />
        <table width="50%" border="0" cellpadding="2" cellspacing="0">
            <tr>
                <th width="10%" style="border:#000 solid 1px;">
                    No
                </th>
                <th width="50%" style="border:#000 solid 1px;">
                    Cost Name
                </th>
                <th width="40%" style="border:#000 solid 1px;">
                    Amount (Rp)
                </th>
            </tr>
            <?php
            if(count($field_cost_do) > 0){
                $no = 1;
                $total_field_cost = 0;
                foreach($field_cost_do as $row){
            ?>
                    <tr>
                        <td align="center" style="border:#000 solid 1px;"><?=$no++?></td>
                        <td style="border:#000 solid 1px;"><?=$row->descs?></td>
                        <td align="right" style="border:#000 solid 1px;"><?=number_format($row->field_cost,2)?></td>
                    </tr>
            <?php
                    $total_field_cost += $row->field_cost;
                }
            ?>
                <tr>
                    <th align="right" colspan="2" style="border:#000 solid 1px;">Total &nbsp; </th>
                    <th align="right" style="border:#000 solid 1px;"><?=number_format($total_field_cost,2)?></th>						
                </tr>
            <?php 
            }
            else{
            ?>
                <tr>
                    <td align="center" colspan="3" style="border:#000 solid 1px;">Data not available</td>						
                </tr>
            <?php   
            }
            ?>
        </table>
    
    </li>
</ul>
</body>
</html>
