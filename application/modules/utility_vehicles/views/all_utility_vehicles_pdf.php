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
    <span style="font-size: 16px;">RECAP OF THE <?=strtoupper(lang('utility_vehicles'))?></span><br />
    Period : <?=$str_start_date;?> to <?=$str_end_date;?>
</div>
<div id="content">
    <table width="100%" cellpadding="1" cellspacing="0">
    	<tr>    
    		<th width="3%" rowspan="2" style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;border-left: #000000 solid 1px;">NO</th>
    		<th rowspan="2" style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;">POOL</th>
            <th rowspan="2" style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;">JUMLAH TRUK</th>
    		<th rowspan="2" style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;">TONASE</th>
    		<th colspan="5" style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;border-left: #000000 solid 1px;border-right: #000000 solid 1px;">RITASE</th>
    		<th colspan="3" style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;border-right: #000000 solid 1px;">PENGHASILAN</th>
    	</tr>
    	<tr>    
    		<th style="border-bottom: #000000 solid 1px;border-left: #000000 solid 1px;">JUMLAH</th>
    		<th style="border-bottom: #000000 solid 1px;">RATA-RATA / UNIT</th>
    		<th style="border-bottom: #000000 solid 1px;">RATA-RATA / UNIT / HARI</th>
    		<th style="border-bottom: #000000 solid 1px;">TARGET</th>
    		<th style="border-bottom: #000000 solid 1px;">REALISASI (%)</th>
    		<th style="border-bottom: #000000 solid 1px;border-left: #000000 solid 1px;">PER POOL</th>
    		<th style="border-bottom: #000000 solid 1px;">RATA-RATA / UNIT</th>
    		<th style="border-bottom: #000000 solid 1px;border-right: #000000 solid 1px;">RATA-RATA / RIT</th>
    	</tr>
        <?php
        if(count($departments) > 0){
            $i=0;
            $total_truk = 0;
            $total_tonase = 0;
            $total_jumlah = 0;
            $total_r_unit = 0;
            $total_r_unit_hari = 0;
            $total_target = 0;
            $total_realisasi = 0;
            $total_per_pool = 0;
            $total_peng_r_unit = 0;
            $total_r_rit = 0;
            $total_dep = count($departments);
            $total_day = (abs(strtotime($end_date) - strtotime($start_date)) / 86400) + 1;
            
            foreach($departments as $row_dep){
                $i++;
                $table_name = 'utility_vehicles_'.$row_dep->rowID.'_'.$this->tank_auth->get_username().'_'.date('YmdHis');
    	        $sql = '           
                    CREATE TABLE '.$table_name.' (
                        rowID INT(6) AUTO_INCREMENT PRIMARY KEY,
                        police_no VARCHAR(15) NOT NULL,
                        vehicle_type VARCHAR(20) NOT NULL,
                        weight double NOT NULL,
                        trip_condition VARCHAR(20) NOT NULL,
                        uang_jalan double NOT NULL,
                        komisi_supir double NOT NULL,
                        komisi_kernet double NOT NULL,
                        total_amt double NOT NULL,
                        trx_no VARCHAR(25) NOT NULL,
                        jo_no VARCHAR(25) NOT NULL,
                        advance_no VARCHAR(25) NOT NULL
                    ) 
                ';
                $query = $this->db->query($sql);
    		
                $all_data_invoice = $this->utility_vehicles_model->get_data_utility($row_dep->rowID, $start_date, $end_date);
                if(count($all_data_invoice) > 0){
                    foreach($all_data_invoice as $row_inv){
                        $data_temp = array(
                            'police_no' => $row_inv->police_no,
                            'vehicle_type' => $row_inv->vehicle_type,
                            'weight' => $row_inv->weight,
                            'trip_condition' => $row_inv->trip_condition,
                            'uang_jalan' => $row_inv->uang_jalan,
                            'komisi_supir' => $row_inv->komisi_supir,
                            'komisi_kernet' => $row_inv->komisi_kernet,
                            'total_amt' => $row_inv->total_amt,
                            'trx_no' => $row_inv->trx_no,
                            'jo_no' => $row_inv->jo_no,
                            'advance_no' => $row_inv->advance_no
                        );
                        
                        $this->utility_vehicles_model->insert_data($table_name,$data_temp);
                    }
                }
                
                $get_data_table_temp = $this->utility_vehicles_model->get_data_police_no_table_temp($table_name);
                $truck = count($get_data_table_temp);
                $ton = 0;
                $rit = 0;
                $pool = 0;
                if(count($get_data_table_temp) > 0){
                    foreach($get_data_table_temp as $row_tmp){
                        $get_total = $this->utility_vehicles_model->get_total_temp($row_tmp->police_no,$table_name);
                        $ton += $get_total->jumlah_ton;
                        $rit += $get_total->jumlah_rit;
                        
                        $uang_jalan = $get_total->jumlah_uang_jalan;
                        $komisi_supir = $get_total->jumlah_komisi_supir;
                        $komisi_kernet = $get_total->jumlah_komisi_kernet;
                        $bag = 0;
                        $tarif = $get_total->jumlah_tarif;
                        
                        $pool += ($uang_jalan + $komisi_supir + $komisi_kernet) - $tarif;
                    }
                }  
                
                $this->utility_vehicles_model->drop_table($table_name);
                
                $r_unit = $rit / $truck;
                $r_unit_hari = $r_unit / $total_day;
                $target = 1.50;
                $realisasi = ($r_unit_hari / $target) * 100;
                $peng_r_unit = $pool / $truck;
                $r_rit = $peng_r_unit / $r_unit;
                
                $total_truk         += $truck;
                $total_tonase       += $ton;
                $total_jumlah       += $rit;
                $total_r_unit       += $r_unit;
                $total_r_unit_hari  += $r_unit_hari;
                $total_target       += $target;
                $total_realisasi    += $realisasi;
                $total_per_pool     += $pool;
                $total_peng_r_unit  += $peng_r_unit;
                $total_r_rit        += $r_rit;
                
        ?>
            	<tr>
            		<td align="center" style="border-bottom: #000000 solid 1px;border-left: #000000 solid 1px;" align="center"><?php echo number_format($i,0,',','.');?></td>
            		<td align="left" style="border-bottom: #000000 solid 1px;"><?=ucwords(strtoupper($row_dep->dep_name))?></td>
            		<td align="center" style="border-bottom: #000000 solid 1px;"><?=number_format($truck,0,',','.')?></td>
                    <td align="center" style="border-bottom: #000000 solid 1px;"><?=number_format($ton,2,',','.')?></td>
                    <td align="center" style="border-bottom: #000000 solid 1px;border-left: #000000 solid 1px;"><?=number_format($rit,0,',','.')?></td>
                    <td align="center" style="border-bottom: #000000 solid 1px;"><?=number_format($r_unit,2,',','.')?></td>
            		<td align="center" style="border-bottom: #000000 solid 1px;"><?=number_format($r_unit_hari,2,',','.')?></td>
                    <td align="center" style="border-bottom: #000000 solid 1px;"><?=number_format($target,2,',','.')?></td>
                    <td align="center" style="border-bottom: #000000 solid 1px;"><?=number_format($realisasi,2,',','.')?></td>
                    <td align="right" style="border-bottom: #000000 solid 1px;border-left: #000000 solid 1px;"><?=number_format($pool,0,',','.')?></td>
                    <td align="right" style="border-bottom: #000000 solid 1px;"><?=number_format($peng_r_unit,0,',','.')?></td>
                    <td align="right" style="border-bottom: #000000 solid 1px;border-right: #000000 solid 1px;"><?=number_format($r_rit,0,',','.')?></td>
            	</tr>
        <?php 
                    
            }
                
            if($i == 0){
        ?>
                <tr>
                    <td colspan="11" align="center" style="border-bottom: #000000 solid 1px;">Data not available.</td>
                </tr>
        <?php
            }
            else{
        ?>
                <tr>
                    <th align="center" colspan="2" style="border-bottom: #000000 double 5px;border-top: #000000 solid 1px;border-left: #000000 solid 1px;">Total &nbsp; </td>
                    <th align="center" style="border-bottom: #000000 double 5px;border-top: #000000 solid 1px;"><?=number_format($total_truk,0,',','.')?></th>
                    <th align="center" style="border-bottom: #000000 double 5px;border-top: #000000 solid 1px;"><?=number_format($total_tonase,2,',','.')?></th>
                    <th align="center" style="border-bottom: #000000 double 5px;border-top: #000000 solid 1px;border-left: #000000 solid 1px;"><?=number_format($total_jumlah,0,',','.')?></th>
                    <th align="center" style="border-bottom: #000000 double 5px;border-top: #000000 solid 1px;"><?=number_format($total_r_unit/$total_dep,2,',','.')?></th>
                    <th align="center" style="border-bottom: #000000 double 5px;border-top: #000000 solid 1px;"><?=number_format($total_r_unit_hari/$total_dep,2,',','.')?></th>
                    <th align="center" style="border-bottom: #000000 double 5px;border-top: #000000 solid 1px;"><?=number_format($total_target/$total_dep,2,',','.')?></th>
                    <th align="center" style="border-bottom: #000000 double 5px;border-top: #000000 solid 1px;"><?=number_format($total_realisasi/$total_dep,2,',','.')?></th>
                    <th align="right" style="border-bottom: #000000 double 5px;border-top: #000000 solid 1px;border-left: #000000 solid 1px;"><?=number_format($total_per_pool,0,',','.')?></th>
                    <th align="right" style="border-bottom: #000000 double 5px;border-top: #000000 solid 1px;"><?=number_format($total_peng_r_unit/$total_dep,0,',','.')?></th>
                    <th align="right" style="border-bottom: #000000 double 5px;border-top: #000000 solid 1px;border-right: #000000 solid 1px;"><?=number_format($total_r_rit/$total_dep,0,',','.')?></th>
                </tr>
        <?php
            }
        }
        ?>
    </table>

</div>

</body>
</html>
