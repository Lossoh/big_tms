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
     #header { position: fixed; left: 0px; top: -60px; right: 0px; height: 50px;  text-align: center;  }
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
    <h2><?php echo lang('destination'); ?></h2>
</div>

<div id="content" style="text-align:center;">
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">
	<tr >
    
		<td  align="center" height="30px">No</td>
		<td  align="center"><?php echo lang('destination_code'); ?></td>
        <td  align="center"><?php echo lang('destination_name'); ?></td>
        <td  align="center"><?php echo lang('address'); ?></td>
        <td  align="center"><?php echo lang('destination_post_code'); ?></td>
        <td  align="center"><?php echo lang('destination_phone'); ?></td>
        <td  align="center"><?php echo lang('destination_contact_person'); ?></td>
	</tr>
	<?php 
				 $i=0;
				foreach($destination as $val){
				$i++;
                    $destination_no = $val->destination_no;
					$destination_name=$val->destination_name;
                    $address=$val->address;
                    $post_cd=$val->post_cd;
                    $telp_no=$val->telp_no;
                    $contact_prs=$val->contact_prs;
					?>
	<tr style="font-size:9px">
		<td><?php echo $i;?></td>
		<td align="left"><?php echo $destination_no;?></td>
		<td align="left"><?php echo $destination_name;?></td>
        <td align="left"><?php echo $address;?></td>
        <td align="left"><?php echo $post_cd;?></td>
        <td align="left"><?php echo $telp_no;?></td>
        <td align="left"><?php echo $contact_prs;?></td>
	</tr>
	<?php }?>
</table>
</div>
</body>
</html>
