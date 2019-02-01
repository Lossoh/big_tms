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
    <h2><?php echo lang('creditors'); ?></h2>
</div>

<div id="content" style="text-align:center;">
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">
	<tr >
    
		<td  align="center" height="30px">No</td>
		<td  align="center"><?php echo lang('creditor_cd'); ?></td>
        <td  align="center"><?php echo lang('creditor_name'); ?></td>
        <td  align="center"><?php echo lang('creditor_category'); ?></td>
        <td  align="center"><?php echo lang('creditor_id_number'); ?></td>
        <td  align="center"><?php echo lang('creditor_address'); ?></td>
        <td  align="center"><?php echo lang('creditor_phone1'); ?></td>
        <td  align="center"><?php echo lang('creditor_fax1'); ?></td>
        <td  align="center"><?php echo lang('creditor_contact'); ?></td>
        <td  align="center"><?php echo lang('creditor_website'); ?></td>
        <td  align="center"><?php echo lang('creditor_email'); ?></td>
        <td  align="center"><?php echo lang('creditor_hp1'); ?></td>
        <td  align="center"><?php echo lang('creditor_gender'); ?></td>
        <td  align="center"><?php echo lang('creditor_pob'); ?></td>
        <td  align="center"><?php echo lang('creditor_npwp'); ?></td>
        <td  align="center"><?php echo lang('creditor_npwp_registered'); ?></td>
        <td  align="center"><?php echo lang('creditor_name_npwp'); ?></td>
        <td  align="center"><?php echo lang('creditor_npwp_address'); ?></td>-->

        
	</tr>
	<?php 
				 $i=0;
				foreach($creditors as $val){
				$i++;
					$creditor_cd=$val->creditor_cd;
                    $creditor_name = $val->creditor_name;
                    $category    = $val->category;
                    $id_no       = $val->id_no;
                    $address     = $val->address1.' '.$val->address2.' '.$val->address3.' '.$val->post_cd;
                    $telp_no1    = $val->telp_no1.'/'.$val->telp_no2;
                    $fax_no1     = $val->fax_no1.'/'.$val->fax_no2;
                    $contact_prs = $val->contact_prs;
                    $website     = $val->website;
                    $email       = $val->email;
                    $hp_no1      = $val->hp_no1.'/'.$val->hp_no2;
                    $sex         = $val->sex;
                    $pob         = $val->pob.','.$val->dob;
                    $npwp_no     = $val->npwp_no;
                    $reg_date    = $val->reg_date;
                    $npwp_name   = $val->npwp_name;
                    $npwp_address = $val->npwp_address1.' '.$val->npwp_address2.' '.$val->npwp_address3;

                    
                    
                    
                    
                    
					?>
	<tr style="font-size:9px">
		<td><?php echo $i;?></td>
		<td align="left"><?php echo $creditor_cd;?></td>
        <td align="left"><?php echo $creditor_name;?></td>
        <td align="left"><?php echo $category;?></td>
        <td align="left"><?php echo $id_no;?></td>
        <td align="left"><?php echo $address;?></td>
        <td align="left"><?php echo $telp_no1;?></td>
        <td align="left"><?php echo $fax_no1;?></td>
        <td align="left"><?php echo $contact_prs;?></td>
        <td align="left"><?php echo $website;?></td>
        <td align="left"><?php echo $email;?></td>
        <td align="left"><?php echo $hp_no1;?></td>
        <td align="left"><?php echo $sex;?></td>
        <td align="left"><?php echo $pob;?></td>
        <td align="left"><?php echo $npwp_no;?></td>
        <td align="left"><?php echo $reg_date;?></td>
        <td align="left"><?php echo $npwp_name;?></td>
        <td align="left"><?php echo $npwp_address;?></td>
	</tr>
	<?php }?>
</table>
</div>
</body>
</html>
