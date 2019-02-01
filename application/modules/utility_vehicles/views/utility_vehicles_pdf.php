<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=lang('utility_vehicles')?></title>
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
	 @page { margin: 10px 10px; }
     
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
<div id="header">
    <span style="font-size: 16px;"><?=strtoupper(lang('utility_vehicles'))?> REPORT</span><br />
    Period : <?=$str_start_date;?> to <?=$str_end_date;?>
</div>
<div id="content">
    <table width="100%">
        <tr>
            <td width="50%" align="left">
                <?php
                $get_data_department = $this->utility_vehicles_model->get_data_by_row_id('sa_dep',$department_id);
                ?>
                <b><?=$get_data_department->dep_name?></b>
            </td>
            <td width="50%" align="right">
                &nbsp;
            </td>
        </tr>
    </table>
    <table width="100%" cellpadding="1" cellspacing="0">
    	<tr>    
    		<th width="3%" style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;border-left: #000000 solid 1px;">NO</th>
    		<th style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;">NO MOBIL</th>
            <th style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;">JENIS</th>
    		<th style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;border-left: #000000 solid 1px;">TON</th>
    		<th style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;">RIT</th>
    		<th style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;">POK</th>
    		<th style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;">UANG JALAN</th>
    		<th style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;">KOMISI SUPIR</th>
    		<th style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;">KOMISI KERNET</th>
    		<th style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;">BAG</th>
    		<th style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;">TARIF</th>
    		<th style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;border-right: #000000 solid 1px;">TOTAL</th>
    	</tr>
        
    	<?php 
        $i=0;
        $total_ton = 0;
        $total_rit = 0;
        $total_pok = 0;
        $total_uang_jalan = 0;
        $total_komisi_supir = 0;
        $total_komisi_kernet = 0;
        $total_bag = 0;
        $total_tarif = 0;
        $total = 0;
        $subtotal = 0;
        
        if(count($get_data_table_temp) > 0){
            foreach($get_data_table_temp as $row){
                $i++;
        	    
                $get_pok = $this->utility_vehicles_model->get_total_pok($row->police_no,$table_name);
                $pok = $get_pok->jumlah_pok;
                $total_pok += $pok;
                
                $get_total = $this->utility_vehicles_model->get_total_temp($row->police_no,$table_name);
                $ton = $get_total->jumlah_ton;
                $total_ton += $ton;
                $rit = $get_total->jumlah_rit;
                $total_rit += $rit;
                $uang_jalan = $get_total->jumlah_uang_jalan;
                $total_uang_jalan += $uang_jalan;
                $komisi_supir = $get_total->jumlah_komisi_supir;
                $total_komisi_supir += $komisi_supir;
                $komisi_kernet = $get_total->jumlah_komisi_kernet;
                $total_komisi_kernet += $komisi_kernet;
                $bag = 0;
                $total_bag += $bag;
                $tarif = $get_total->jumlah_tarif;
                $total_tarif += $tarif;
                
                $total = ($uang_jalan + $komisi_supir + $komisi_kernet) - $tarif;
                $subtotal += $total;
                
        ?>
            	<tr>
            		<td align="center" style="border-bottom: #000000 solid 1px;border-left: #000000 solid 1px;" align="center"><?php echo number_format($i,0,',','.');?></td>
            		<td align="left" style="border-bottom: #000000 solid 1px;"><?=$row->police_no?></td>
            		<td align="center" style="border-bottom: #000000 solid 1px;"><?=ucwords(strtolower($row->vehicle_type))?></td>
                    <td align="center" style="border-bottom: #000000 solid 1px;border-left: #000000 solid 1px;"><?=number_format($ton,2,',','.')?></td>
                    <td align="center" style="border-bottom: #000000 solid 1px;"><?=number_format($rit,0,',','.')?></td>
                    <td align="center" style="border-bottom: #000000 solid 1px;"><?=number_format($pok,0,',','.')?></td>
                    <td align="right" style="border-bottom: #000000 solid 1px;"><?=number_format($uang_jalan,0,',','.')?></td>
                    <td align="right" style="border-bottom: #000000 solid 1px;"><?=number_format($komisi_supir,0,',','.')?></td>
                    <td align="right" style="border-bottom: #000000 solid 1px;"><?=number_format($komisi_kernet,0,',','.')?></td>
                    <td align="center" style="border-bottom: #000000 solid 1px;"><?=number_format($bag,2,',','.')?></td>
                    <td align="right" style="border-bottom: #000000 solid 1px;"><?=number_format($tarif,0,',','.')?></td>
                    <td align="right" style="border-bottom: #000000 solid 1px;border-right: #000000 solid 1px;"><?=number_format($total,0,',','.')?></td>
            	</tr>
    	<?php 
                
            }
        }
        
        if($i == 0){
        ?>
            <tr>
                <td colspan="12" align="center" style="border: #000000 solid 1px;">Data not available.</td>
            </tr>
        <?php
        }
        else{
        ?>
            <tr>
                <th colspan="3" align="right" style="border-bottom: #000000 double 5px;border-top: #000000 solid 1px;border-left: #000000 solid 1px;">Total &nbsp; </th>
                <th align="center" style="border-bottom: #000000 double 5px;border-top: #000000 solid 1px;border-left: #000000 solid 1px;"><?=number_format($total_ton,2,',','.')?></th>
                <th align="center" style="border-bottom: #000000 double 5px;border-top: #000000 solid 1px;"><?=number_format($total_rit,0,',','.')?></th>
                <th align="center" style="border-bottom: #000000 double 5px;border-top: #000000 solid 1px;"><?=number_format($total_pok,0,',','.')?></th>
                <th align="right" style="border-bottom: #000000 double 5px;border-top: #000000 solid 1px;">Rp <?=number_format($total_uang_jalan,0,',','.')?></th>
                <th align="right" style="border-bottom: #000000 double 5px;border-top: #000000 solid 1px;">Rp <?=number_format($total_komisi_supir,0,',','.')?></th>
                <th align="right" style="border-bottom: #000000 double 5px;border-top: #000000 solid 1px;">Rp <?=number_format($total_komisi_kernet,0,',','.')?></th>
                <th align="center" style="border-bottom: #000000 double 5px;border-top: #000000 solid 1px;"><?=number_format($total_bag,2,',','.')?></th>
                <th align="right" style="border-bottom: #000000 double 5px;border-top: #000000 solid 1px;">Rp <?=number_format($total_tarif,0,',','.')?></th>
                <th align="right" style="border-bottom: #000000 double 5px;border-top: #000000 solid 1px;border-right: #000000 solid 1px;">Rp <?=number_format($subtotal,0,',','.')?></th>
            </tr>
        <?php
        }
        ?>
    </table>
</div>

</body>
</html>

<?php
$this->utility_vehicles_model->drop_table($table_name);
?>
