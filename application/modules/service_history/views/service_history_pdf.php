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

<p align="right">Print Date Time : <?=date('d F Y H:i:s')?> </p>

<div id="header">
    <h2><?php echo strtoupper(lang('service_history')); ?></h2>
</div>
<p><?=lang('police_no')?> : <b><?=$police_no?></b></p>

<div id="content" style="text-align:center;">
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">
	<tr >
    
		<th><?=lang('no')?> </th>
		<th><?=lang('complaint_no')?> </th>
		<th><?=lang('complaint').' '.lang('date')?> </th>
		<th><?=lang('type')?> </th>
		<th><?=lang('last_km')?> </th>
		<th><?=lang('driver_name')?> </th>
		<th><?=lang('complaint')?></th>
		<th><?=lang('next_service_date')?></th>
	</tr>
	<?php 
    $i=1;
    if (!empty($service_historys)) {
        foreach ($service_historys as $service_history) { 
    	    
    ?>
	<tr style="font-size:9px">
		<td align="center"><?= $i++;?></td>
		<td><?=$service_history->trx_no?></td>
		<td><?=date("d F Y",strtotime($service_history->trx_date))?></td>
		<td><?=$service_history->type?></td>
		<td><?=number_format($service_history->last_km)?></td>
		<td><?=$service_history->debtor_name?></td>
		<td>
            <?php
            $get_data_complaint = $this->service_history_model->get_data_detail_by_trx_no($service_history->trx_no);
            if(count($get_data_complaint) > 0){
                $no = 1;
                foreach($get_data_complaint as $row){
                    echo $no++.'. '.$row->complaint_note.'<br>';
                }
            }
            else{
                echo '-';
            }
            ?>
        </td>
		<td>
            <?php
            $check_data_spk = $this->service_history_model->get_data_spk_by_complaint_no($service_history->trx_no);
                        
            $next_service = "-"; 
            if($check_data_spk->change_oil == 1){
                $get_data_service_not_finish = $this->service_history_model->get_data_service_not_finish_by_code($check_data_spk->trx_no);
                $next_service_date = "";
                if(count($get_data_service_not_finish) == 0){
                    $get_data_service_finish = $this->service_history_model->get_data_service_finish_by_code($check_data_spk->trx_no);
                    
                    $progress_date = new DateTime($get_data_service_finish->progress_date);
                    $progress_date->modify('next year');
                    $next_service_date = " / ".$progress_date->format('d F Y'); 
                    $next_service = number_format($service_history->last_km + 10000).' KM' . $next_service_date;
                }
            }
            else{
                if(count($check_data_spk) > 0){
                    $get_data_service_not_finish = $this->service_history_model->get_data_service_not_finish_by_code($check_data_spk->trx_no);
                    $next_service_date = "";
                    if(count($get_data_service_not_finish) == 0){
                        $get_data_service_finish = $this->service_history_model->get_data_service_finish_by_code($check_data_spk->trx_no);
                    
                        $progress_date = new DateTime($get_data_service_finish->progress_date);
                        $progress_date->modify('next year');
                        $next_service_date = $progress_date->format('d F Y');
                        $next_service = $next_service_date;
                    }
                }
            }
            
            echo $next_service;
            ?>
        </td>
	</tr>
	<?php 
        }
    }
    else{
    ?>
        <tr style="font-size:9px">
		  <td align="center" colspan="8">No Data Available</td>
        </tr>
    <?php
    }
    ?>
</table>
</div>
</body>
</html>
