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
    <h2><?php echo lang('vehicle_positions'); ?></h2>
</div>

<div id="content" style="text-align:center;">
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">
	<tr >
    
		<td  align="center" height="30px">No</td>
        
		<td  align="center"><?php echo lang('vehicle_police_no'); ?></td>
		<td  align="center"><?php echo lang('position'); ?></td>
		<td  align="center"><?php echo lang('note'); ?></td>
		<td  align="center"><?php echo lang('no_stnk'); ?></td>
        <td  align="center"><?php echo lang('no_kir'); ?></td>
		<td  align="center"><?php echo lang('no_bpkb'); ?></td>
        <td  align="center"><?php echo lang('no_insurance'); ?></td>
        <td  align="center"><?php echo lang('no_kiu'); ?></td>
	</tr>
	<?php 
			 $i=0;
            
				foreach($vehicle_positions as $val){
				$i++;
				    $police_no=$val->police_no;
					$position=$val->position;
                    $note=$val->note == '' ? '-' : $val->note;
                    $no_stnk=strtoupper($val->no_stnk);
                    $no_kir=strtoupper($val->no_kir);
                    $no_bpkb=strtoupper($val->no_bpkb);
                    $no_insurance=strtoupper($val->no_insurance);
                    $no_kiu=strtoupper($val->no_kiu);
					?>
	<tr style="font-size:9px">
		<td align="center"><?php echo $i;?></td>
		<td align="left"><?php echo $police_no;?></td>
		<td align="left"><?php echo $position;?></td>
		<td align="left"><?php echo $note;?></td>
        <td align="left"><?php echo $no_stnk;?></td>
        <td align="left"><?php echo $no_kir;?></td>
        <td align="left"><?php echo $no_bpkb;?></td>
        <td align="left"><?php echo $no_insurance;?></td>
        <td align="left"><?php echo $no_kiu;?></td>
		
	</tr>
	<?php 
                }
            
    ?>
</table>
</div>

</body>
</html>
