<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Print Account Payable</title>
</head>

<body>

<style>
    table th,td{
        font-size: 12px;
    }
	body{
	   font-size: 12px;
       font-family: sans-serif;
	}
	 @page { margin: 10px 15px; }
     @page deliveryOrder {
      size: A4 portrait;
      margin: 10px 15px;
     }
    
     .deliveryOrder {
       page: deliveryOrder;
       page-break-after: always;
     }
     
     #header { position: fixed; left: 0px; top: 0px; right: 0px; text-align: center;  }
     #footer { position: fixed; left: 0px; bottom: 0px; right: 0px; font-size: 12px; font-family: sans-serif; text-align:right; }
	 #content{
	   border-bottom:0px solid #000000;
	 }
     #footer .page:after { content: counter(page, upper-roman); }
	#content{
	background-color:#FFFFFF;
	} 
</style>

<table width="100%" cellpadding="2" cellspacing="0">
    <tr>
        <td width="50%">
            <big><?=strtoupper($this->config->item('comp_name'))?></big>
        </td>
        <td width="50%" align="right">
            <big>No : <?=$get_data->trx_no?></big>
        </td>    
    </tr>
</table>
<br />
<div style="text-align:center;font-size: 24px;">
    <b><u>TANDA TERIMA</u></b>
</div>
<br /><br />
<table width="100%" cellpadding="2" cellspacing="0">
    <tr>
        <td width="18%">
            Sudah terima dari
        </td>
        <td width="2%">:</td>
        <td width="80%">
             <?=strtoupper($get_data->creditor_name)?>
        </td>    
    </tr>
    <tr>
        <td>
            Berupa
        </td>
        <td>:</td>
        <td>
             <?=strtoupper($get_data->ref_no)?>
        </td>    
    </tr>
    <tr>
        <td>
            Sebesar
        </td>
        <td>:</td>
        <td>
             <big>Rp <?=number_format($get_data->total_amt,0,',','.')?></big>
        </td>    
    </tr>
    <tr>
        <td>
            Terbilang
        </td>
        <td>:</td>
        <td>
             <i># <?=ucwords(strtolower($this->moneyformat->terbilang($get_data->total_amt)))?> Rupiah #</i>
        </td>    
    </tr>
    <tr>
        <td>
            Harap Kembali Tanggal
        </td>
        <td>:</td>
        <td>
             <?=date('d F Y',strtotime($get_data->come_back))?>
        </td>    
    </tr>
</table>
<br />
<table width="100%" cellpadding="2" cellspacing="0">
    <tr>
        <td width="70%">&nbsp;</td>
        <td width="30%" align="center">
             Jakarta, <?=date('d F Y')?> &nbsp; &nbsp; &nbsp;  
             <p>&nbsp;</p>
             <p>&nbsp;</p>
             <u><?=ucwords($this->user_profile->get_profile_details($this->tank_auth->get_user_id(),'fullname'))?></u><br />
             Kasir
        </td>    
    </tr>
</table>
</body>
</html>
