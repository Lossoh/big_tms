<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Delivery Order</title>
</head>

<body>

<style>
    body,table th,td{
        font-size: 14px;
        font-family: serif;
    }
	 @page { margin: 10px 30px 10px 20px; }
     
     #header { left: 0px; top: 0px; right: 0px; text-align: center;  }
     #footer { left: 0px; bottom: 30px; right: 0px; font-size: 14px; font-family: serif; text-align:right; }	
	 #content{
	 border-bottom:0px solid #000000;
	 }
     #footer .page:after { content: counter(page, upper-roman); }
	#content{
	   background-color:#FFFFFF;
	} 
    
</style>

<div id="content">
    <span style="font-size: 16px;"><?='RV'.$get_data->revisi?></span>
    <br /><br /><br />
    <table width="100%" border="0" cellpadding="0" cellspacing="0" valign="top">
    	<tr valign="top">
            <td align="left" width="76%"></td>
            <td align="left"><b style="font-size: 18px;"><?=$get_data->do_no?></b></td>
        </tr>
    </table>
    <br />
    <table width="100%" border="0" cellpadding="0" cellspacing="0" valign="top">
    	<tr valign="top">
            <td align="left" width="61%">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" valign="top" style="padding-top: 10px;">
                	<tr valign="top">
                        <td align="left" width="40%"></td>
                        <td align="left"><?=$get_data->port_warehouse?></td>
                    </tr>
                	<tr valign="top">
                        <td align="left"></td>
                        <td align="left"><?=$get_data->vessel_name?></td>
                    </tr>
                	<tr valign="top">
                        <td align="left"></td>
                        <td align="left" valign="top"><?=$get_data->po_spk_no?></td>
                    </tr>
                    <tr valign="top">
                        <td align="left"></td>
                        <td align="left" valign="top"><?=$get_data->police_no?></td>
                    </tr>
                    <tr valign="top">
                        <td align="left"></td>
                        <td align="left" valign="top"><?=$get_data->vehicle_type?></td>
                    </tr>
                    <tr valign="top">
                        <td align="left"></td>
                        <td align="left" valign="top"><?=$get_data->debtor_name.' / '.strtoupper($this->config->item('comp_cd'))?></td>
                    </tr>
                </table>                
            </td>
            <td align="left">
                <br />
                <div style="padding-top: 5px;margin-left:20px;">
                    <?=strtoupper($address)?>
                </div>
            </td>
        </tr>
    </table>
    <br /><br /><br />
    <div style="padding-top: 13px;font-size: 16px;">
    &nbsp; <?=$cargo?>
    <br />
    &nbsp; 
    <?php
        $detail_container = '';
        if($container_type == '20ft')
            $detail_container = '1 x 20 Feet';
        else if($container_type == '40ft')
            $detail_container = '1 x 40 Feet';
        else if($container_type == '45ft')
            $detail_container = '1 x 45 Feet';
        
        echo $detail_container;    
    ?>
    </div>
</div>
</body>
</html>

<script src="<?=base_url()?>resource/js/jquery-2.1.4.min.js"></script>

<script>
</script>
