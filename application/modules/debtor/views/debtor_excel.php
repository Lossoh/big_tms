<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo lang('debtors'); ?></title>
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
    <h2><?php echo lang('debtors'); ?></h2>
</div>

<div id="content" style="text-align:center;">
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">
	<tr >
		<th  align="center" height="30px">No</th>
        <th  align="center"><?php echo lang('debtor_cd'); ?></th>
        <th  align="center"><?php echo lang('debtor_name'); ?></th>
        <th  align="center"><?php echo lang('debtor_type'); ?></th>
        <th  align="center">Finger ID</th>
        <th  align="center"><?php echo lang('debtor_no_ktp'); ?></th>
        <th  align="center"><?php echo lang('debtor_expired_date_ktp'); ?></th>
        <th  align="center">SIM No</th>
        <th  align="center">SIM Expired Date</th>
        <th  align="center"><?php echo lang('debtor_address'); ?></th>
        <th  align="center"><?php echo lang('debtor_phone1'); ?></th>
        <th  align="center"><?php echo lang('debtor_email'); ?></th>
        <th  align="center"><?php echo lang('debtor_hp1'); ?></th>
        <th  align="center"><?php echo lang('debtor_gender'); ?></th>
        <th  align="center"><?php echo lang('debtor_pob'); ?></th>
	</tr>
	<?php 
		$i=0;
		foreach($debtor as $val){
		    $i++;
            if ($val->type == 'D'){
                if ($val->spare_driver == 0){
                    $type = 'Driver';
                }
                else{
                    $type = 'Spare Driver';
                }
            }else if ($val->type == 'C'){
                $type = 'Company';
            }else if ($val->type == 'E'){
                $type = 'Employee';
            }else if ($val->type == 'M'){
                $type = 'Mechanic';
            }
             
			$debtor_cd = $val->type.$val->debtor_cd;
            $debtor_name = $val->debtor_name;
            $finger_rowID = $val->finger_rowID;
            $id_no       = $val->no_ktp == '' ? '' : $val->no_ktp;
            $expired_date_id = $val->expired_date_ktp == '0000-00-00' ? '' : date("d F Y",strtotime($val->expired_date_ktp));
            $address     = $val->address1.' '.$val->address2.' '.$val->address3.' '.$val->post_cd;
            $telp_no1    = $val->telp_no1 == '' ? '' : $val->telp_no1.'/'.$val->telp_no2;
            $contact_prs = $val->contact_prs;
            $email       = $val->email;
            $hp_no1      = $val->hp_no1 == '' ? '' : $val->hp_no1.'/'.$val->hp_no2;
            $sex         = $val->sex == 'M' ? 'Male' : 'Female';
            $pob         = $val->pob == '' ? '' : ucwords(strtolower($val->pob)).','.date("d-m-Y",strtotime($val->dob));
            
            $sim_no = '-';
            $sim_expired_date = '-';
            if($val->id_type == 'S'){
                $sim_no = $val->id_no;
                $sim_expired_date = date("d-m-Y",strtotime($val->expired_date_id));
            }
            
	?>
	<tr style="font-size:9px">
		<td><?php echo $i;?></td>
		<td align="left"><?php echo $debtor_cd;?></td>
        <td align="left"><?php echo $debtor_name;?></td>
        <td align="left"><?php echo $type;?></td>
        <td align="left"><?php echo $finger_rowID;?></td>
        <td align="left"><?php echo $id_no;?></td>
        <td align="left"><?php echo $expired_date_id;?></td>
        <td align="left"><?php echo $sim_no;?></td>
        <td align="left"><?php echo $sim_expired_date;?></td>
        <td align="left"><?php echo $address;?></td>
        <td align="left"><?php echo $telp_no1;?></td>
        <td align="left"><?php echo $email;?></td>
        <td align="left"><?php echo $hp_no1;?></td>
        <td align="left"><?php echo $sex;?></td>
        <td align="left"><?php echo $pob;?></td>
	</tr>
	<?php }?>
</table>
</div>
</body>
</html>
