<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Print Progress SPK Service</title>
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
    <h2>PROGRESS SURAT PERINTAH KERJA (SPK)</h2>
</div>
<br />

<div id="content" style="text-align:center;">
    <table width="100%" cellpadding="1" cellspacing="0">
    	<tr>
    		<td width="13%"><?=lang('spk_no')?></td>
            <td width="45%">: &nbsp; <b><?=$get_data->spk_no?></b></td>
            <td width="13%"><?=lang('last_km')?></td>
            <td>: &nbsp; <b><?=number_format($get_data->last_km,0,',','.')?></b></td>        
        </tr>
        <tr>
            <td><?=lang('complaint').' '.lang('date')?></td>
            <td>: &nbsp; <b><?=date("d F Y",strtotime($get_data->trx_date))?></b></td>
            <td><?=lang('type')?></td>
            <td>: &nbsp; <b><?=$get_data->type?></b></td>
        </tr>
        <tr>
            <td><?=lang('police_no')?></td>
            <td>: &nbsp; <b><?=$get_data->police_no?></b></td>
            <td><?=lang('type_work_list')?></td>
            <td>:&nbsp; 
                <b>
                    <?php
                    
                    if($get_data->type_work_list == "Template"){
                        $get_data_template = $this->service_history_model->get_data_service_by_code($get_data->template_service_code);
                        echo $get_data->type_work_list.' ('.$get_data_template->name.')';
                    }
                    else{
                        echo $get_data->type_work_list;
                    }
                    
                    ?>
                </b>
            </td>
        </tr>
    </table>
    <br />
    <p align="left"><big><b><?=lang('complaint')?></b></big></p>
    <table width="100%" border="1" cellpadding="1" cellspacing="0">
    	<tr>
    		<th height="30px" width="5%">No</th>
            <th><?=lang('complaint')?> </th>
    	</tr>
    	<?php 
    	$i=1;
        if(!empty($get_data_complaint)){
            foreach($get_data_complaint as $row_complaint){
                
    	?>
    	<tr style="font-size:9px" valign="top">
    		<td align="center"><?php echo $i++;?></td>
    		<td><?=$row_complaint->complaint_note?></td>
    	</tr>
    	<?php 
            }
        }
        else{
        ?>
            <tr style="font-size:9px">
    		  <td align="center" colspan="2">No Data Available</td>
            </tr>
        <?php
        }
        ?>
    </table>
    <br />
    <p align="left"><big><b><?=lang('job_description')?></b></big></p>
    <table width="100%" border="1" cellpadding="1" cellspacing="0">
    	<tr>
    		<th height="30px" width="5%">No</th>
            <th><?=lang('job_description')?> </th>
         	<th width="10%"><?=lang('date')?> </th>
    		<th width="10%"><?=lang('start_hours')?> </th>
    		<th width="10%"><?=lang('end_hours')?> </th>
    		<th width="11%"><?=lang('status')?> </th>
    	</tr>
    	<?php 
    	$i=1;
        if(!empty($get_data_work_list)){
            foreach($get_data_work_list as $row_wl){
                
    	?>
            	<tr style="font-size:9px" valign="top">
            		<td align="center"><?php echo $i++;?></td>
            		<td><?=$row_wl->service_name?></td>
            		<td align="center"><?=$row_wl->progress_date == '0000-00-00' ? '-' : date("d-m-Y",strtotime($row_wl->progress_date))?></td>
            		<td align="center"><?=$row_wl->start_hours == '00:00:00' ? '' : $row_wl->start_hours?></td>
            		<td align="center"><?=$row_wl->start_hours == '00:00:00' ? '' : $row_wl->end_hours?></td>
            		<td align="center">
                        <?php
                        if($row_wl->status == 'Progress'){
                            echo "&nbsp; P &nbsp; | &nbsp; F &nbsp; | &nbsp; C &nbsp;";
                        }
                        else{
                            echo $row_wl->status;                    
                        }
                        ?>
                    </td>
            	</tr>
    	<?php 
            }
            
            for($x=$i;$x<=10;$x++){
                
    	?>
            	<tr style="font-size:9px" valign="top">
            		<td align="center"><?php echo $x;?></td>
            		<td>&nbsp;</td>
            		<td>&nbsp;</td>
            		<td>&nbsp;</td>
            		<td>&nbsp;</td>
            		<td>&nbsp;</td>
            	</tr>
    	<?php 
            }
            
        }
        else{
        ?>
            <tr style="font-size:9px">
    		  <td align="center" colspan="6">No Data Available</td>
            </tr>
        <?php
        }
        ?>
    </table>
    <br />
    <p align="left"><big><b>The Replacement Part/Material</b></big></p>
    <table width="100%" border="1" cellpadding="1" cellspacing="0">
    	<tr>
    		<th height="30px" width="5%">No</th>
            <th><?=lang('part_material')?> Name</th>
         	<th width="7%"><?=lang('qty')?> </th>
    		<th width="7%"><?=lang('unit')?> </th>
    		<th width="15%"><?=lang('tire_accu_no')?> </th>
    	</tr>
    	<?php 
    	$i=1;
        if(!empty($get_data_part_material)){
            foreach($get_data_part_material as $row_pm){
                
    	?>
    	<tr style="font-size:9px" valign="top">
    		<td align="center"><?php echo $i++;?></td>
    		<td><?=$row_pm->part_material_name?></td>
    		<td><?=number_format($row_pm->qty,0,',','.')?></td>
    		<td align="center"><?=$row_pm->unit?></td>
    		<td>&nbsp;</td>
    	</tr>
    	<?php 
            }
            
            for($x=$i;$x<=10;$x++){
                
    	?>
    	<tr style="font-size:9px" valign="top">
    		<td align="center"><?php echo $x;?></td>
    		<td>&nbsp;</td>
    		<td>&nbsp;</td>
    		<td>&nbsp;</td>
    		<td>&nbsp;</td>
    	</tr>
    	<?php 
            }
            
        }
        else{
        ?>
            <tr style="font-size:9px">
    		  <td align="center" colspan="6">No Data Available</td>
            </tr>
        <?php
        }
        ?>
    </table>
    <br />
    <table width="100%" cellpadding="1" cellspacing="0">
    	<tr valign="top">
    		<td width="50%" >
                <p align="left"><big><b>Mechanic List</b></big></p>
                <table width="100%" border="1" cellpadding="1" cellspacing="0">
                	<tr>
                		<th height="30px" width="10%">No</th>
                        <th><?=lang('mechanic_name')?></th>
                     	<th width="25%"><?=lang('signature')?> </th>
                	</tr>
                	<?php 
                	$i=1;
                    if(!empty($get_data_mechanic)){
                        foreach($get_data_mechanic as $row_mc){      
                	?>
                	<tr style="font-size:9px;" valign="middle">
                		<td align="center"><?php echo $i++;?></td>
                		<td><?=$row_mc->debtor_cd.' - '.$row_mc->debtor_name?></td>
                		<td><p>&nbsp;</p></td>
                	</tr>
                	<?php 
                        }
                    }
                    else{
                    ?>
                        <tr style="font-size:9px">
                		  <td align="center" colspan="3">No Data Available</td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </td>
            <td>
                <p align="left" style="margin-left: 25px;"><b>Note :</b></p>
                <ul type="disc" style="margin-left: 25px;">
                    <li style="text-align:left">Penggantian sparepart/material harus disertakan fotokopi Bukti Pengeluaran Barang dari gudang.</li>
                    <li style="text-align:left">Untuk Ban dan Aki (Tire/Accu) harap diisi nomornya.</li>
                    <li><?=lang('status')?> : <br />
                        <ul type="circle"> 
                            <li>P = Pending</li>
                            <li>F = Finish</li>
                            <li>C = Cancel</li>
                        </ul>
                    </li>
                </ul>
            </td>
        </tr>
    </table>
    
    <p>&nbsp;</p>
    <table width="100%" cellpadding="1" cellspacing="0">
    	<tr>
    		<th colspan="2"><big><u>Close Jobs</u></big></th>
    	</tr>
        <tr>
    		<th width="50%">Driver</th>
    		<th width="50%">Service Advisor</th>
    	</tr>
        <tr>
    		<th>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <u><b><?=$get_data->debtor_name?></b></u>
            </th>
    		<th>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <u><b><?=ucwords($this->session->userdata('username'))?></b></u>
            </th>
    	</tr>
    </table>
</div>

</body>
</html>
