<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>

<style>
    table th,td{
        font-size: 12px;
    }
	
	 @page { margin: 60px 10px; }
     #header { left: 0px;right: 0px; height: 100px;  text-align: center;  }
     #footer { position: fixed; left: 0px; bottom: -60px; right: 0px; height: 50px; text-align:right; }
	 #content{
    	 border-bottom:0px solid #000000;
	 }
     #footer .page:after { content: counter(page, upper-roman); }
	#content{
	background-color:#FFFFFF;
	} 
</style>

<div id="header">
    <h2><?php echo lang('vehicle_document'); ?> <?php echo lang('stnk'); ?> </h2>
    <?=lang('periode_expired')." : <b>".$periode."</b>"?>
</div>

<div id="content" style="text-align:center;">
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">
	<tr >
    
		<td  align="center" height="30px">No</td>
        
		<td  align="center"><?php echo lang('vehicle_police_no'); ?></td>
        <td  align="center"><?php echo lang('vehicle_type'); ?></td>
		<td  align="center"><?php echo lang('vehicle_gps'); ?></td>
		<td  align="center"><?php echo lang('vehicle_driver'); ?></td>
		<td  align="center"><?php echo lang('no_stnk'); ?></td>
		<td  align="center"><?php echo lang('expired_stnk'); ?></td>
		<td  align="center"><?php echo lang('status_stnk'); ?></td>
        <td  align="center"><?php echo lang('no_bpkb'); ?></td>
		<td  align="center"><?php echo lang('status_bpkb'); ?></td>		
		<td  align="center"><?php echo lang('no_insurance'); ?></td>
		<td  align="center"><?php echo lang('expired_insurance'); ?></td>
		<td  align="center"><?php echo lang('status_insurance'); ?></td>
		<td  align="center"><?php echo lang('no_kiu'); ?></td>
		<td  align="center"><?php echo lang('expired_kiu'); ?></td>
		<td  align="center"><?php echo lang('status_kiu'); ?></td>
	</tr>
	<?php 
			 $i=0;
            
				foreach($vehicles_stnk as $val){
				$i++;
				    $police_no=$val->police_no;
					$vehicle_type=$val->vehicle_type;
                    $gps_no=$val->gps_no;
                    $Driver=$val->driver_code." - ".$val->driver_name;
                    $no_stnk=strtoupper($val->no_stnk);
                    $expired_stnk=date("d F Y",strtotime($val->expired_stnk));
                    $status_stnk=ucfirst($val->status_stnk);
                    $no_bpkb=strtoupper($val->no_bpkb);
                    $status_bpkb=ucfirst($val->status_bpkb);
                    $no_insurance=strtoupper($val->no_insurance);
                    $expired_insurance=date("d F Y",strtotime($val->expired_insurance));
                    $status_insurance=ucfirst($val->status_insurance);
                    $no_kiu=strtoupper($val->no_kiu);
                    $expired_kiu=date("d F Y",strtotime($val->expired_kiu));
                    $status_kiu=ucfirst($val->status_kiu);
					?>
	<tr style="font-size:9px">
		<td align="center"><?php echo $i;?></td>
		<td align="left"><?php echo $police_no;?></td>
		<td align="left"><?php echo $vehicle_type;?></td>
		<td align="left"><?php echo $gps_no;?></td>
        <td align="left"><?php echo $Driver;?></td>
        <td align="left"><?php echo $no_stnk;?></td>
        <td align="left"><?php echo $expired_stnk;?></td>
        <td align="left"><?php echo $status_stnk;?></td>
        <td align="left"><?php echo $no_bpkb;?></td>
        <td align="left"><?php echo $status_bpkb;?></td>
        <td align="left"><?php echo $no_insurance;?></td>
        <td align="left"><?php echo $expired_insurance;?></td>
        <td align="left"><?php echo $status_insurance;?></td>
        <td align="left"><?php echo $no_kiu;?></td>
        <td align="left"><?php echo $expired_kiu;?></td>
        <td align="left"><?php echo $status_kiu;?></td>
		
	</tr>
	<?php 
                }
            
    ?>
</table>
</div>

<br />
<hr />
<br />
<div id="header">
    <h2><?php echo lang('vehicle_document'); ?> <?php echo lang('kir'); ?></h2>
    <p><?=lang('periode_expired')." : <b>".$periode."</b>"?></p>
</div>

<div id="content" style="text-align:center;">
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">
	<tr >
    
		<td  align="center" height="30px">No</td>
        
		<td  align="center"><?php echo lang('vehicle_police_no'); ?></td>
        <td  align="center"><?php echo lang('vehicle_type'); ?></td>
		<td  align="center"><?php echo lang('vehicle_gps'); ?></td>
		<td  align="center"><?php echo lang('vehicle_driver'); ?></td>
		<td  align="center"><?php echo lang('no_kir'); ?></td>
		<td  align="center"><?php echo lang('expired_kir'); ?></td>
		<td  align="center"><?php echo lang('status_kir'); ?></td>
        <td  align="center"><?php echo lang('no_bpkb'); ?></td>
		<td  align="center"><?php echo lang('status_bpkb'); ?></td>		
		<td  align="center"><?php echo lang('no_insurance'); ?></td>
		<td  align="center"><?php echo lang('expired_insurance'); ?></td>
		<td  align="center"><?php echo lang('status_insurance'); ?></td>
		<td  align="center"><?php echo lang('no_kiu'); ?></td>
		<td  align="center"><?php echo lang('expired_kiu'); ?></td>
		<td  align="center"><?php echo lang('status_kiu'); ?></td>
	</tr>
	<?php 
				 $i=0;
				foreach($vehicles_kir as $val){
				$i++;
				    $police_no=$val->police_no;
					$vehicle_type=$val->vehicle_type;
                    $gps_no=$val->gps_no;
                    $Driver=$val->driver_code." - ".$val->driver_name;
                    $no_kir=strtoupper($val->no_kir);
                    $expired_kir=date("d F Y",strtotime($val->expired_kir));
                    $status_kir=ucfirst($val->status_kir);
                    $no_bpkb=strtoupper($val->no_bpkb);
                    $status_bpkb=ucfirst($val->status_bpkb);
                    $no_insurance=strtoupper($val->no_insurance);
                    $expired_insurance=date("d F Y",strtotime($val->expired_insurance));
                    $status_insurance=ucfirst($val->status_insurance);
                    $no_kiu=strtoupper($val->no_kiu);
                    $expired_kiu=date("d F Y",strtotime($val->expired_kiu));
                    $status_kiu=ucfirst($val->status_kiu);
					?>
	<tr style="font-size:9px">
		<td align="center"><?php echo $i;?></td>
		<td align="left"><?php echo $police_no;?></td>
		<td align="left"><?php echo $vehicle_type;?></td>
		<td align="left"><?php echo $gps_no;?></td>
        <td align="left"><?php echo $Driver;?></td>
        <td align="left"><?php echo $no_kir;?></td>
        <td align="left"><?php echo $expired_kir;?></td>
        <td align="left"><?php echo $status_kir;?></td>		
        <td align="left"><?php echo $no_bpkb;?></td>
        <td align="left"><?php echo $status_bpkb;?></td>
        <td align="left"><?php echo $no_insurance;?></td>
        <td align="left"><?php echo $expired_insurance;?></td>
        <td align="left"><?php echo $status_insurance;?></td>
        <td align="left"><?php echo $no_kiu;?></td>
        <td align="left"><?php echo $expired_kiu;?></td>
        <td align="left"><?php echo $status_kiu;?></td>
	</tr>
	<?php }?>
</table>
</div>

</body>
</html>
