<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Report All Cash Bank and Payment</title>
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

<table width="100%">
    <tr>
        <td width="50%" align="left">
            <?=$this->config->item('comp_name')?>
        </td>
        <td width="50%" align="right">
            Print Date Time : <?=date('d F Y H:i:s')?> 
        </td>
    </tr>
</table>
<br />
<div id="header">
    <span style="font-size: 16px;">CASH BANK PAYMENT AND RECEIVE REPORT</span><br />
    Period : <?=$str_start_date.' '.$start_time;?> to <?=$str_end_date.' '.$end_time;?>
</div>
<div id="content">
    <?php
    if(count($coas) > 0){
        $no = 1;
        foreach($coas as $row_coa){
    ?>
            <table width="100%">
                <tr>
                    <td width="50%" align="left">
                        <?php
                        $get_data_coa = $this->cb_payment_receive_model->get_data_by_row_id('gl_coa',$row_coa->rowID);
                        ?>
                        <b><?=number_format($no++)?>. COA Code : <?=$get_data_coa->acc_name?></b>
                    </td>
                    <td width="50%" align="right">
                        &nbsp;
                    </td>
                </tr>
            </table>
            <table width="100%" cellpadding="1" cellspacing="0">
            	<tr>    
                    <th width="3%" rowspan="2" style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;border-left: #000000 solid 1px;">No</th>
            		<th width="12%" rowspan="2" style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;">Cash Bank No</th>
            		<th width="10%" rowspan="2" style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;">Reference No</th>
            		<th width="10%" rowspan="2" style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;">Cheque/Giro No</th>
                    <th rowspan="2" style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;">Description</th>
            		<th width="15%" rowspan="2" style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;">Payment To / Receive From</th>
            		<th colspan="2" style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;border-left: #000000 solid 1px;border-right: #000000 solid 1px;">Debit</th>
            		<th colspan="2" style="border-top: #000000 double 5px;border-bottom: #000000 solid 1px;border-right: #000000 solid 1px;">Kredit</th>
            	</tr>
            	<tr>    
            		<th style="border-bottom: #000000 solid 1px;border-left: #000000 solid 1px;">Tunai</th>
            		<th style="border-bottom: #000000 solid 1px;">C & G</th>
            		<th style="border-bottom: #000000 solid 1px;border-left: #000000 solid 1px;">Tunai</th>
            		<th style="border-bottom: #000000 solid 1px;border-right: #000000 solid 1px;">C & G</th>
            	</tr>
            	<?php 
                $i=0;
                
                // Starting Balance
                $year1 = date('Y',strtotime($start_date));
                $first_date = $year1.'-01-01';
                $last_date = date('Y-m-d',strtotime($start_date.' yesterday'));
                $year2 = date('Y',strtotime($last_date));
                if($year1 > $year2){
                    $last_date = $first_date;
                }
                
                $data_cb_trx_balance = $this->cb_payment_receive_model->get_data_cb_trx_hdr_by_date($row_coa->rowID,$first_date,$last_date,'00:00:00','23:59:59');
                $data_cb_trx2_balance = $this->cb_payment_receive_model->get_data_cb_trx_hdr_by_date2($row_coa->rowID,$first_date,$last_date,'00:00:00','23:59:59');
                
                $total_debit_tunai = 0;
                $total_debit_cg = 0;
                $total_kredit_tunai = 0;
                $total_kredit_cg = 0;
                
                if(count($data_cb_trx_balance) > 0){
                    foreach($data_cb_trx_balance as $row){
                        if(($row->status == 1 && $row->reference_release_no == '') || $row->status == null){
                           $amount_kredit_tunai = 0;
                    	   $amount_kredit_cg = 0;
                    	   $amount_debit_tunai = 0;
                    	   $amount_debit_cg = 0;
                            
                           if($row->payment_type == 'P'){
                	           if($row->payment_method != ""){
                            	   if($row->payment_method == 'cash'){
                            	        if($row->cg_amt > 0){
                         	                $amount_kredit_tunai = $row->cg_amt;
                            	        }
                                        else{
                                            $amount_kredit_tunai = $row->cg_amt * -1;
                                        }
                                        $total_kredit_tunai += $amount_kredit_tunai;
                            	   }
                                   else{
                                        if($row->cg_amt > 0)
                                            $amount_kredit_cg = $row->cg_amt;
                                        else
                                            $amount_kredit_cg = $row->cg_amt * -1;
                                            
                                        $total_kredit_cg += $amount_kredit_cg;
                                   }
                               }
                               else{
                                    if($row->cg_amt > 0){
                     	                $amount_kredit_tunai = $row->cg_amt;
                        	        }
                                    else{
                                        if($row->cg_amt != ''){
                                            $amount_kredit_tunai = $row->cg_amt * -1;
                                        }
                                        else{
                                            if($row->trx_amt > 0){
                             	                $amount_kredit_tunai = $row->trx_amt;
                                	        }
                                            else{
                                                $amount_kredit_tunai = $row->trx_amt * -1;
                                            }
                                        }
                                    }
                                    
                                    $total_kredit_tunai += $amount_kredit_tunai;
                               }
                    	   }
                           else{
                                if($row->payment_method == 'cash'){
                        	        if($row->cg_amt > 0){
                                        $amount_debit_tunai = $row->cg_amt;
                                    }
                                    else{
                                        if($row->cg_amt != ''){
                                            $amount_debit_tunai = $row->cg_amt * -1;
                                        }
                                        else{
                                            if($row->trx_amt > 0){
                             	                $amount_debit_tunai = $row->trx_amt;
                                	        }
                                            else{
                                                $amount_debit_tunai = $row->trx_amt * -1;
                                            }
                                        }
                                        
                                    }
                                                            
                                    $total_debit_tunai += $amount_debit_tunai;        	       
                                    
                        	    }
                                else{
                                    if($row->cg_amt > 0)
                                        $amount_debit_cg = $row->cg_amt;
                                    else
                                        $amount_debit_cg = $row->cg_amt * -1;
                                        
                                    $total_debit_cg += $amount_debit_cg;
                                }
                                                       
                           }
                           
                        }
                    }
                }
                if(count($data_cb_trx2_balance) > 0){
                    foreach($data_cb_trx2_balance as $row){
                        $show = true;
                        
                        foreach($data_cb_trx_balance as $row_hdr){
                            if($row->trx_no == $row_hdr->trx_no){
                                $show = false;
                                break;
                            }
                        }
                        
                        if($show == true){
                        
                            if(($row->status == 1 && $row->reference_release_no == '') || $row->status == null){
                               $amount_kredit_tunai = 0;
                        	   $amount_kredit_cg = 0;
                        	   $amount_debit_tunai = 0;
                        	   $amount_debit_cg = 0;
                               
                               if($row->payment_type == 'P'){
                    	           if($row->payment_method != ""){
                                	   if($row->payment_method == 'cash'){
                                	        if($row->trx_amt > 0){
                             	                $amount_kredit_tunai = $row->trx_amt;
                                	        }
                                            else{
                                                $amount_kredit_tunai = $row->trx_amt * -1;
                                            }
                                            $total_kredit_tunai += $amount_kredit_tunai;
                                	   }
                                       else{
                                            if($row->trx_amt > 0)
                                                $amount_kredit_cg = $row->trx_amt;
                                            else
                                                $amount_kredit_cg = $row->trx_amt * -1;
                                                
                                            $total_kredit_cg += $amount_kredit_cg;
                                       }
                                   }
                                   else{
                                        if($row->trx_amt > 0){
                         	                $amount_kredit_tunai = $row->trx_amt;
                            	        }
                                        else{
                                            if($row->trx_amt != ''){
                                                $amount_kredit_tunai = $row->trx_amt * -1;
                                            }
                                            else{
                                                if($row->trx_amt > 0){
                                 	                $amount_kredit_tunai = $row->trx_amt;
                                    	        }
                                                else{
                                                    $amount_kredit_tunai = $row->trx_amt * -1;
                                                }
                                            }
                                        }
                                        
                                        $total_kredit_tunai += $amount_kredit_tunai;
                                   }
                        	   }
                               else{
                                    if($row->payment_method == 'cash'){
                            	        if($row->trx_amt > 0){
                                            $amount_debit_tunai = $row->trx_amt;
                                        }
                                        else{
                                            if($row->trx_amt != ''){
                                                $amount_debit_tunai = $row->trx_amt * -1;
                                            }
                                            else{
                                                if($row->trx_amt > 0){
                                 	                $amount_debit_tunai = $row->trx_amt;
                                    	        }
                                                else{
                                                    $amount_debit_tunai = $row->trx_amt * -1;
                                                }
                                            }
                                            
                                        }
                                                                
                                        $total_debit_tunai += $amount_debit_tunai;        	       
                                        
                            	    }
                                    else{
                                        if($row->trx_amt > 0)
                                            $amount_debit_cg = $row->trx_amt;
                                        else
                                            $amount_debit_cg = $row->trx_amt * -1;
                                            
                                        $total_debit_cg += $amount_debit_cg;
                                    }
                                                           
                               }
                               
                            }
                        }
                    }
                }
                
                $starting_balance = ($total_debit_tunai + $total_debit_cg) - ($total_kredit_tunai + $total_kredit_cg);
                
                // END Starting Balance
                
                $total_debit_tunai = 0;
                $total_debit_cg = 0;
                $total_kredit_tunai = 0;
                $total_kredit_cg = 0;
                
                $data_cb_trx = $this->cb_payment_receive_model->get_data_cb_trx_hdr_by_date($row_coa->rowID,$start_date,$end_date,$start_time,$end_time);
                $data_cb_trx2 = $this->cb_payment_receive_model->get_data_cb_trx_hdr_by_date2($row_coa->rowID,$start_date,$end_date,$start_time,$end_time);
                
                if(count($data_cb_trx) > 0){
                	foreach($data_cb_trx as $row){
                	   if(($row->status == 1 && $row->reference_release_no == '') || $row->status == null){
                	   	   $amount_kredit_tunai = 0;
                    	   $amount_kredit_cg = 0;
                    	   $amount_debit_tunai = 0;
                    	   $amount_debit_cg = 0;
                           /*
                           $coa_rowID = 0;
                           if($row->coa_rowID == 0){
                                $coa_rowID = $row->cg_coa_rowID;
                           }
                           else{
                                $coa_rowID = $row->coa_rowID;
                           }
                           */
                           $coa_rowID = $row->cg_coa_rowID;
                           
                           //if($coa_rowID == $row_coa->rowID){           
                               $i++;
                        	   
                               if($row->payment_type == 'P'){
                    	           if($row->payment_method != ""){
                                	   if($row->payment_method == 'cash'){
                                            if($row->cg_amt > 0){
                             	                $amount_kredit_tunai = $row->cg_amt;
                                	        }
                                            else{
                                                $amount_kredit_tunai = $row->cg_amt * -1;
                                            }
                                            $total_kredit_tunai += $amount_kredit_tunai;
                                	   }
                                       else{
                                            if($row->cg_amt > 0)
                                                $amount_kredit_cg = $row->cg_amt;
                                            else
                                                $amount_kredit_cg = $row->cg_amt * -1;
                                                
                                            $total_kredit_cg += $amount_kredit_cg;
                                       }    	       
                                   }
                                   else{
                                        if($row->cg_amt > 0){
                         	                $amount_kredit_tunai = $row->cg_amt;
                            	        }
                                        else{
                                            if($row->cg_amt != ''){
                                                $amount_kredit_tunai = $row->cg_amt * -1;
                                            }
                                            else{
                                                if($row->trx_amt > 0){
                                 	                $amount_kredit_tunai = $row->trx_amt;
                                    	        }
                                                else{
                                                    $amount_kredit_tunai = $row->trx_amt * -1;
                                                }
                                            }
                                        }
                                        
                                        $total_kredit_tunai += $amount_kredit_tunai;
                                   }
                        	   }
                               else{
                                    if($row->payment_method == 'cash'){
                            	        if($row->cg_amt > 0){
                                            $amount_debit_tunai = $row->cg_amt;
                                        }
                                        else{
                                            if($row->cg_amt != ''){
                                                $amount_debit_tunai = $row->cg_amt * -1;
                                            }
                                            else{
                                                if($row->trx_amt > 0){
                                 	                $amount_debit_tunai = $row->trx_amt;
                                    	        }
                                                else{
                                                    $amount_debit_tunai = $row->trx_amt * -1;
                                                }
                                            }
                                            
                                        }
                                                                
                                        $total_debit_tunai += $amount_debit_tunai;        	       
                                        
                            	    }
                                    else{
                                        if($row->cg_amt > 0)
                                            $amount_debit_cg = $row->cg_amt;
                                        else
                                            $amount_debit_cg = $row->cg_amt * -1;
                                            
                                        $total_debit_cg += $amount_debit_cg;
                                    }                                
                                    
                               }
                               
                               if($row->debtor_creditor_type == 'D'){
                                    $get_data_deb_cre = $this->cb_payment_receive_model->get_data_by_row_id('sa_debtor',$row->debtor_creditor_rowID);
                                    $payment_to = $get_data_deb_cre->debtor_name;
                               }
                               elseif($row->debtor_creditor_type == 'C'){
                                    $get_data_deb_cre = $this->cb_payment_receive_model->get_data_by_row_id('sa_creditor',$row->debtor_creditor_rowID);
                                    $payment_to = $get_data_deb_cre->creditor_name;
                               }
                               else{
                                    if($row->debtor_creditor_rowID > 0){
                                        $get_data_deb_cre = $this->cb_payment_receive_model->get_data_by_row_id('sa_debtor',$row->debtor_creditor_rowID);
                                        $payment_to = $get_data_deb_cre->debtor_name;
                                    }
                                    else{
                                        $payment_to = $row->manual_debtor_creditor;
                                    }
                               }
                               
                                $get_data_cheque = $this->cb_payment_receive_model->get_data_cheque($row->trx_no);
                                $data_cheque = '';
                                if(count($get_data_cheque) > 0){
                                    $i_cheque = 1;
                                    foreach($get_data_cheque as $row_cheque){
                                        $data_cheque .= $i_cheque.'. '.strtoupper($row_cheque->cg_no).'<br>';
                                        $i_cheque++;
                                    }
                                }   
                                else{
                                    $data_cheque = '-';
                                }
                ?>
                            	<tr>
                            		<td style="border-bottom: #000000 solid 1px;border-left: #000000 solid 1px;" align="center"><?php echo number_format($i);?></td>
                            		<td style="border-bottom: #000000 solid 1px;"><?=$row->trx_no?><br /><span style="font-size: 10px;"><?=date('d-m-Y H:i:s',strtotime($row->trx_date.' '.$row->time_created))?></span></td>
                            		<td style="border-bottom: #000000 solid 1px;"><?=$row->advance_invoice_trx_no?></td>
              		                <td style="border-bottom: #000000 solid 1px;"><?=$data_cheque?></td>
              		                <td style="border-bottom: #000000 solid 1px;"><?=$row->descs?></td>
                            		<td style="border-bottom: #000000 solid 1px;"><?=$payment_to == '' ? '-' : $payment_to?></td>
                                    <td style="border-bottom: #000000 solid 1px;border-left: #000000 solid 1px;" align="right"><?=number_format($amount_debit_tunai,2)?></td>
                                    <td style="border-bottom: #000000 solid 1px;" align="right"><?=number_format($amount_debit_cg,2)?></td>
                                    <td style="border-bottom: #000000 solid 1px;border-left: #000000 solid 1px;" align="right"><?=number_format($amount_kredit_tunai,2)?></td>
                                    <td style="border-bottom: #000000 solid 1px;border-right: #000000 solid 1px;" align="right"><?=number_format($amount_kredit_cg,2)?></td>
                            	</tr>
            	<?php 
                            //}
                        }
                    }
                }
                
                if(count($data_cb_trx2) > 0){
                    foreach($data_cb_trx2 as $row){
                        $show = true;
                        
                        foreach($data_cb_trx as $row_hdr){
                            if($row->trx_no == $row_hdr->trx_no){
                                $show = false;
                                break;
                            }
                        }
                        
                        if($show == true){
                        
                            if(($row->status == 1 && $row->reference_release_no == '') || $row->status == null){
                               $amount_kredit_tunai = 0;
                        	   $amount_kredit_cg = 0;
                        	   $amount_debit_tunai = 0;
                        	   $amount_debit_cg = 0;
                               /*
                               $coa_rowID = 0;
                               if($row->coa_rowID == 0){
                                    $coa_rowID = $row->cg_coa_rowID;
                               }
                               else{
                                    $coa_rowID = $row->coa_rowID;
                               }
                               */
                               $coa_rowID = $row->cg_coa_rowID;
                               
                               //if($coa_rowID == $coa_id){           
                            	   $i++;
                        	       if($row->payment_type == 'P'){
                        	           if($row->payment_method != ""){
                                    	   if($row->payment_method == 'cash'){
                                    	        if($row->trx_amt > 0){
                                 	                $amount_kredit_tunai = $row->trx_amt;
                                    	        }
                                                else{
                                                    $amount_kredit_tunai = $row->trx_amt * -1;
                                                }
                                                $total_kredit_tunai += $amount_kredit_tunai;
                                    	   }
                                           else{
                                                if($row->trx_amt > 0)
                                                    $amount_kredit_cg = $row->trx_amt;
                                                else
                                                    $amount_kredit_cg = $row->trx_amt * -1;
                                                    
                                                $total_kredit_cg += $amount_kredit_cg;
                                           }
                                       }
                                       else{
                                            if($row->trx_amt > 0){
                             	                $amount_kredit_tunai = $row->trx_amt;
                                	        }
                                            else{
                                                if($row->trx_amt != ''){
                                                    $amount_kredit_tunai = $row->trx_amt * -1;
                                                }
                                                else{
                                                    if($row->trx_amt > 0){
                                     	                $amount_kredit_tunai = $row->trx_amt;
                                        	        }
                                                    else{
                                                        $amount_kredit_tunai = $row->trx_amt * -1;
                                                    }
                                                }
                                            }
                                            
                                            $total_kredit_tunai += $amount_kredit_tunai;
                                       }
                            	   }
                                   else{
                                        if($row->payment_method == 'cash'){
                                	        if($row->trx_amt > 0){
                                                $amount_debit_tunai = $row->trx_amt;
                                            }
                                            else{
                                                if($row->trx_amt != ''){
                                                    $amount_debit_tunai = $row->trx_amt * -1;
                                                }
                                                else{
                                                    if($row->trx_amt > 0){
                                     	                $amount_debit_tunai = $row->trx_amt;
                                        	        }
                                                    else{
                                                        $amount_debit_tunai = $row->trx_amt * -1;
                                                    }
                                                }
                                                
                                            }
                                                                    
                                            $total_debit_tunai += $amount_debit_tunai;        	       
                                            
                                	    }
                                        else{
                                            if($row->trx_amt > 0)
                                                $amount_debit_cg = $row->trx_amt;
                                            else
                                                $amount_debit_cg = $row->trx_amt * -1;
                                                
                                            $total_debit_cg += $amount_debit_cg;
                                        }
                                                               
                                   }
                                   
                                   if($row->debtor_creditor_type == 'D'){
                                        $get_data_deb_cre = $this->cb_payment_receive_model->get_data_by_row_id('sa_debtor',$row->debtor_creditor_rowID);
                                        $payment_to = $get_data_deb_cre->debtor_name;
                                   }
                                   elseif($row->debtor_creditor_type == 'C'){
                                        $get_data_deb_cre = $this->cb_payment_receive_model->get_data_by_row_id('sa_creditor',$row->debtor_creditor_rowID);
                                        $payment_to = $get_data_deb_cre->creditor_name;
                                   }
                                   else{
                                        if($row->debtor_creditor_rowID > 0){
                                            $get_data_deb_cre = $this->cb_payment_receive_model->get_data_by_row_id('sa_debtor',$row->debtor_creditor_rowID);
                                            $payment_to = $get_data_deb_cre->debtor_name;
                                        }
                                        else{
                                            $payment_to = $row->manual_debtor_creditor;
                                        }
                                   }
                                   
                                    $get_data_cheque = $this->cb_payment_receive_model->get_data_cheque($row->trx_no);
                                    $data_cheque = '';
                                    if(count($get_data_cheque) > 0){
                                        $i_cheque = 1;
                                        foreach($get_data_cheque as $row_cheque){
                                            $data_cheque .= $i_cheque.'. '.strtoupper($row_cheque->cg_no).'<br>';
                                            $i_cheque++;
                                        }
                                    }   
                                    else{
                                        $data_cheque = '-';
                                    }
                                
                    ?>
                                	<tr>
                                		<td style="border-bottom: #000000 solid 1px;border-left: #000000 solid 1px;" align="center"><?php echo number_format($i);?></td>
                                		<td style="border-bottom: #000000 solid 1px;"><?=$row->trx_no?><br /><span style="font-size: 10px;"><?=date('d-m-Y H:i:s',strtotime($row->trx_date.' '.$row->time_created))?></span></td>
                                		<td style="border-bottom: #000000 solid 1px;"><?=$row->advance_invoice_trx_no?></td>
                                		<td style="border-bottom: #000000 solid 1px;"><?=$data_cheque?></td>
                                		<td style="border-bottom: #000000 solid 1px;"><?=$row->descs?></td>
                                		<td style="border-bottom: #000000 solid 1px;"><?=$payment_to == '' ? '-' : $payment_to?></td>
                                        <td style="border-bottom: #000000 solid 1px;border-left: #000000 solid 1px;" align="right"><?=number_format($amount_debit_tunai,2)?></td>
                                        <td style="border-bottom: #000000 solid 1px;" align="right"><?=number_format($amount_debit_cg,2)?></td>
                                        <td style="border-bottom: #000000 solid 1px;border-left: #000000 solid 1px;" align="right"><?=number_format($amount_kredit_tunai,2)?></td>
                                        <td style="border-bottom: #000000 solid 1px;border-right: #000000 solid 1px;" align="right"><?=number_format($amount_kredit_cg,2)?></td>
                                	</tr>
                	<?php 
                                //}
                            }
                        }
                    }
                }
                
                if($i == 0){
                ?>
                    <tr>
                        <td colspan="10" align="center" style="border: #000000 solid 1px;">Data not available.</td>
                    </tr>
                <?php
                }
                else{
                ?>
                    <tr>
                        <td colspan="6" align="right" style="border-top: #000000 solid 1px;border-left: #000000 solid 1px;">Total (Rp) &nbsp; </td>
                        <td align="right" style="border-top: #000000 solid 1px;border-left: #000000 solid 1px;"><?=number_format($total_debit_tunai,2)?></td>
                        <td align="right" style="border-top: #000000 solid 1px;"></td>
                        <td align="right" style="border-top: #000000 solid 1px;border-left: #000000 solid 1px;"><?=number_format($total_kredit_tunai,2)?></td>
                        <td align="right" style="border-top: #000000 solid 1px;border-right: #000000 solid 1px;"></td>
                    </tr>
                    <tr>
                        <td colspan="6" align="right" style="border-top: #ffffff solid 1px;border-left: #000000 solid 1px;"> &nbsp; </td>
                        <td align="right" style="border-top: #000000 solid 1px;border-left: #000000 solid 1px;"></td>
                        <td align="right" style="border-top: #000000 solid 1px;"><?=number_format($total_debit_cg,2)?></td>
                        <td align="right" style="border-top: #000000 solid 1px;border-left: #000000 solid 1px;"></td>
                        <td align="right" style="border-top: #000000 solid 1px;border-right: #000000 solid 1px;"><?=number_format($total_kredit_cg,2)?></td>
                    </tr>
                    <tr>
                        <td colspan="6" align="right" style="border-top: #000000 solid 1px;border-left: #000000 solid 1px;">Starting Balance (Rp)&nbsp; <br /><i>Per <?=date('d-m-Y',strtotime($last_date))?></i> &nbsp; </td>
                        <td colspan="4" align="right" style="border-top: #000000 solid 1px;border-left: #000000 solid 1px;border-right: #000000 solid 1px;">
                            <?php
                                if($starting_balance != 0){
                                    echo number_format($starting_balance,2);
                                }
                                else{
                                    echo '0';
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" align="right" style="border-top: #000000 solid 1px;border-left: #000000 solid 1px;">Grand Total (Rp) &nbsp; </td>
                        <td colspan="4" align="right" style="border-top: #000000 solid 1px;border-left: #000000 solid 1px;border-right: #000000 solid 1px;">
                            <?php
                                $grand_total = ($total_debit_tunai + $total_debit_cg) - ($total_kredit_tunai + $total_kredit_cg);
                                echo number_format($grand_total,2);
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" align="right" style="border-top: #000000 solid 1px;border-bottom: #000000 double 5px;border-left: #000000 solid 1px;">Remaining Balance (Rp) &nbsp; </td>
                        <td colspan="4" align="right" style="border-top: #000000 solid 1px;border-bottom: #000000 double 5px;border-left: #000000 solid 1px;border-right: #000000 solid 1px;">
                            <?php
                                if($starting_balance != 0){
                                    $sisa_saldo = $starting_balance + $grand_total;
                                }
                                else{
                                    $sisa_saldo = $grand_total;
                                }
                                
                                echo number_format($sisa_saldo,2);
                            ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
            <p>&nbsp;</p>
    <?php
        }
    }
    ?>
</div>

</body>
</html>
