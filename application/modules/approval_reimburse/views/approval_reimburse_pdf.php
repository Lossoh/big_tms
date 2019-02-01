<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo lang('approval_reimburse'); ?></title>
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
	 @page { margin: 15px 30px 15px 20px; }
     
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
    <h2><?php echo lang('approval_reimburse'); ?></h2>
    <?=lang('periode')." : <b>".$periode."</b>"?>
</div>

<div id="content" style="text-align:center;">
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">
	<tr>
		<th>No</th>
        <th><?=lang('reimburse_number')?></th>
		<th>Reimburse Date</th>
		<th>User Approved</th>
		<th>Reimburse Total</th>
	</tr>
    <?php
    if (!empty($approvals)) {
        $no = 1;
        $reimburse_total = 0;
        foreach ($approvals as $row) { 
            $reimburse_total += $row->reimburse_total;
    ?>
        <tr>
            <td align="center"><?=number_format($no++)?></td>	
            <td><?=$row->reimburse_no?></td>
            <td><?=date('d F Y',strtotime($row->reimburse_date))?></td>
            <td><?=ucwords($row->username)?></td>
        	<td style="text-align: right;"><?= number_format($row->reimburse_total);?></td>
        </tr>
    <?php 
        } 
    ?>
        <tr>
            <th colspan="4" align="right">Total (Rp) &nbsp; </th>
            <th align="right"><?=number_format($reimburse_total)?></th>
        </tr>
    <?php
    } 
    else{
    ?>
        <tr style="font-size:9px">
		  <td align="center" colspan="5">No Data Available</td>
        </tr>
    <?php
    }
    ?>
</table>
</div>

</body>
</html>
