<?php
if($tipe == 'cash_advance'){
?>
<table id="tbl_advance_invoice_multiple" class="table table-striped table-hover b-t b-light text-sm">
    <thead>
      <tr>
        <th>#</th>
        <th><?=lang('no')?></th>
        <th><?=lang('cash_advance_no')?></th>
		<th><?=lang('date')?></th>
		<th><?=lang('driver')?>/<?=lang('employee')?> Name</th>
		<th><?=lang('fare_trip_code')?></th>
		<th><?=lang('cash_advance_amt')?></th>
		<th><?=lang('extra_amount')?></th>
		<th><?=lang('cash_advance_alloc')?></th>
		<th><?=lang('balance')?></th>
      </tr> 
	</thead>
	<tbody>
      <?php
      if (!empty($get_data)) {
        $no = 1;
        foreach ($get_data as $cash_advance_list) { 
        
            //$total_balance = ($cash_advance_list->advance_amount + $cash_advance_list->advance_extra_amount) - $cash_advance_list->advance_allocation;
            $total_balance = $cash_advance_list->advance_balance;

            $get_cost = $this->cash_bank_payment_model->get_cost_by_trx_no($cash_advance_list->trx_no);
            $description = '';
            foreach ($get_cost as $row_cost) { 
                if($row_cost->descs != ''){
                    $description .= ucwords($row_cost->descs).', ';
                }
            }
            
            if($description != ''){
                $description = substr($description,0,-2);
            }
            
            if($payment_type == 'P'){
                if($total_balance < 0){
      ?>
                  <tr>
            		<td>
    			     <input type="checkbox" name="chk_cb[]" id="chk_cb_<?=$cash_advance_list->advance_no?>" onclick="get_data_invoice_ca_chk('<?=$cash_advance_list->advance_no?>','<?=$cash_advance_list->advance_balance?>','<?=$description?>')" value="1" style="width: 15px;" />
    	            </td>
                    <td><?=$no++?></td>
            		<td><?=$cash_advance_list->advance_no?></td>
            		<td style="width:10%"><?=date("d-m-Y",strtotime($cash_advance_list->advance_date))?></td>
            		<td><?=$cash_advance_list->debtor_code?> - <?=$cash_advance_list->debtor_name?></td>
            		<td><?=$cash_advance_list->fare_trip_no?></td>
            		<td style="text-align: right;"><?= number_format($cash_advance_list->advance_amount,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
            		<td style="text-align: right;"><?= number_format($cash_advance_list->advance_extra_amount,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
            		<td style="text-align: right;"><?= number_format($cash_advance_list->advance_allocation,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
            		<td style="text-align: right;"><?= number_format($total_balance,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
                  </tr>
    <?php
                } 
            }
            else{
                if($total_balance > 0){
      ?>
                  <tr>
            		<td>
    			     <input type="checkbox" name="chk_cb[]" id="chk_cb_<?=$cash_advance_list->advance_no?>" onclick="get_data_invoice_ca_chk('<?=$cash_advance_list->advance_no?>','<?=$cash_advance_list->advance_balance?>','<?=$description?>')" value="1" style="width: 15px;" />
    	            </td>
                    <td><?=$no++?></td>
            		<td><?=$cash_advance_list->advance_no?></td>
            		<td style="width:10%"><?=date("d-m-Y",strtotime($cash_advance_list->advance_date))?></td>
            		<td><?=$cash_advance_list->debtor_code?> - <?=$cash_advance_list->debtor_name?></td>
            		<td><?=$cash_advance_list->fare_trip_no?></td>
            		<td style="text-align: right;"><?= number_format($cash_advance_list->advance_amount,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
            		<td style="text-align: right;"><?= number_format($cash_advance_list->advance_extra_amount,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
            		<td style="text-align: right;"><?= number_format($cash_advance_list->advance_allocation,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
            		<td style="text-align: right;"><?= number_format($total_balance,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
                  </tr>
    <?php
                } 
            }
        } 
      }
     ?>
  </tbody>
</table>
<?php
}
else if($tipe == 'invoice'){
?>
<table id="tbl_advance_invoice_multiple" class="table table-striped table-hover b-t b-light text-sm">
    <thead>
      <tr>
        <th>#</th>
        <th><?=lang('no')?></th>
        <th>Invoice No</th>
		<th>Invoice Date</th>
		<th>Debtor Name</th>
		<th>Remark</th>
        <th>Base Amount</th>
        <th>Vat</th>
        <th>With Holding</th>
        <th>Total</th>
      </tr> 
	</thead>
	<tbody>
      <?php
      if (!empty($get_data)) {
          $no = 1;
          foreach ($get_data as $invoice) { 
            $check_data = $this->cash_bank_payment_model->get_data_detail_by_advance_invoice_no($invoice->trx_no);
            if(count($check_data) == 0){
      ?>
          <tr>
    		<td>
			 <input type="checkbox" name="chk_cb[]" id="chk_cb_<?=$invoice->trx_no?>" onclick="get_data_invoice_chk('<?=$invoice->trx_no?>','<?=$invoice->total_amt?>')" value="1" style="width: 15px;" />
			</td>
            <td><?=$no++?></td>
    		<td><?=$invoice->trx_no?></td>
            <td style="width:10%"><?=date("d-m-Y",strtotime($invoice->trx_date))?></td>
            <td><?=$invoice->debtor_name?></td>
    		<td><?=$invoice->descs?></td>
    		<td  style="text-align: right;"><?= number_format($invoice->base_amt,2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
            <td  style="text-align: right;"><?= number_format($invoice->tax_amt,2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
            <td  style="text-align: right;"><?= number_format($invoice->wth_amt,2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
            <td  style="text-align: right;"><?= number_format($invoice->total_amt,2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
          </tr>
    <?php 
            }
        } 
      }
    ?>
  </tbody>
</table>
<?php
}
else if($tipe == 'ap'){
?>
<table id="tbl_advance_invoice_multiple" class="table table-striped table-hover b-t b-light text-sm">
    <thead>
      <tr>
        <th>#</th>
        <th><?=lang('no')?></th>
        <th>AP No</th>
		<th>AP Date</th>
		<th>AP Type</th>
		<th>Supplier Name</th>
		<th>Reference No</th>
        <th>Base Total (Rp)</th>
        <th>Total AP (Rp)</th>
        <th>Total Difference (Rp)</th>
      </tr> 
	</thead>
	<tbody>
      <?php
      if (!empty($get_data)) {
          $no = 1;
          foreach ($get_data as $ap) {
            $check_data = $this->cash_bank_payment_model->get_data_detail_by_advance_invoice_no($ap->trx_no);
            if(count($check_data) == 0){
      ?>
          <tr>
    		<td>
			 <input type="checkbox" name="chk_cb[]" id="chk_cb_<?=$ap->trx_no?>" onclick="get_data_invoice_chk('<?=$ap->trx_no?>','<?=$ap->base_amt?>')" value="1" style="width: 15px;" />
			</td>
            <td><?=$no++?></td>
    		<td><?=$ap->trx_no?></td>
    		<td style="width:10%"><?=date("d-m-Y",strtotime($ap->trx_date))?></td>
            <td><?=ucwords(strtolower($ap->creditor_type))?></td>
            <td><?=strtoupper($ap->creditor_name)?></td>
    		<td><?=strtoupper($ap->ref_no)?></td>
            <td style="text-align: right;"><?= number_format($ap->base_amt,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
            <td style="text-align: right;"><?= number_format($ap->total_ap,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
            <td style="text-align: right;"><?= number_format($ap->total_diff,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
          </tr>
    <?php 
            }
        } 
      }
    ?>
  </tbody>
</table>
<?php
}
else if($tipe == 'deposit'){
?>
<table id="tbl_advance_invoice_multiple" class="table table-striped table-hover b-t b-light text-sm">
    <thead>
      <tr>
        <th>#</th>
        <th><?=lang('no')?></th>
        <th><?=lang('deposit_number')?> </th>
		<th><?=lang('date')?> </th>
		<th><?=lang('debtor_name')?> </th>
		<th><?=lang('debtor_types')?> </th>
		<th><?=lang('remark')?> </th>
		<th><?=lang('amount')?> (Rp)</th>
      </tr> 
	</thead>
	<tbody>
      <?php
      if (!empty($get_data)) {
          $no = 1;
          foreach ($get_data as $deposit) { 
            $check_data = $this->cash_bank_payment_model->get_data_detail_by_advance_invoice_no($deposit->deposit_number);
            if(count($check_data) == 0){
                $type = '-';
                if($deposit->type == 'C')
                    $type = 'Company';
                else if($deposit->type == 'E')
                    $type = 'Employee';
                else if($deposit->type == 'D')
                    $type = 'Driver';
      ?>
          <tr>
    		<td>
			 <input type="checkbox" name="chk_cb[]" id="chk_cb_<?=$deposit->deposit_number?>" onclick="get_data_invoice_chk('<?=$deposit->deposit_number?>','<?=$deposit->amount?>')" value="1" style="width: 15px;" />
			</td>
            <td><?=$no++?></td>
    		<td><?=$deposit->deposit_number?></td>
    		<td style="width:10%"><?=date("d-m-Y",strtotime($deposit->date))?></td>
    		<td><?=$deposit->debtor_name?></td>
    		<td><?=$type?></td>
    		<td><?=$deposit->remark?></td>
    		<td align="right"><?=number_format($deposit->amount,0,',','.')?></td>
          </tr>
    <?php
            }
         } 
      }
    ?>
  </tbody>
</table>
<?php
}
else if($tipe == 'commission'){
?>
<table id="tbl_advance_invoice_multiple" class="table table-striped table-hover b-t b-light text-sm">
    <thead>
      <tr>
        <th>#</th>
        <th><?=lang('no')?></th>
        <th>Commission No</th>
        <th>Commission Date</th>
        <th>Driver Comm (Rp)</th>
      </tr> 
	</thead>
	<tbody>
      <?php
      if (!empty($get_data)) {
          $no = 1;
          foreach ($get_data as $commission) { 
            $check_data = $this->cash_bank_payment_model->get_data_detail_by_advance_invoice_no($commission->commission_no);
            if(count($check_data) == 0){
      ?>
          <tr>
    		<td>
			 <input type="checkbox" name="chk_cb[]" id="chk_cb_<?=$commission->commission_no?>" onclick="get_data_invoice_chk('<?=$commission->commission_no?>','<?=$commission->driver_commission?>')" value="1" style="width: 15px;" />
			</td>
            <td><?=$no++?></td>
    		<td><?=$commission->commission_no?></td>
    		<td style="width:20%"><?=date("d-m-Y",strtotime($commission->until_date))?></td>
    		<td align="right"><?=number_format($commission->driver_commission,0,',','.')?></td>
          </tr>
    <?php 
            }
        } 
      }
    ?>
  </tbody>
</table>
<?php
}
else if($tipe == 'advance'){
?>
<table id="tbl_advance_invoice_multiple" class="table table-striped table-hover b-t b-light text-sm">
    <thead>
      <tr>
        <th>#</th>
        <th><?=lang('no')?></th>
        <th><?=lang('advance_number')?> </th>
		<th><?=lang('date')?> </th>
        <th><?=lang('advance_type')?></th>
		<th><?=lang('debtor_name')?> </th>
		<th><?=lang('dp_for_creditor')?></th>
		<th><?=lang('remark')?> </th>
		<th><?=lang('amount')?> (Rp)</th>
      </tr> 
	</thead>
	<tbody>
      <?php
      if (!empty($get_data)) {
          $no = 1;
          foreach ($get_data as $advance) { 
            $check_data = $this->cash_bank_payment_model->get_data_detail_by_advance_invoice_no($advance->advance_number);
            if(count($check_data) == 0){
      ?>
          <tr>
    		<td>
			 <input type="checkbox" name="chk_cb[]" id="chk_cb_<?=$advance->advance_number?>" onclick="get_data_invoice_chk('<?=$advance->advance_number?>','<?=$advance->advance_total?>')" value="1" style="width: 15px;" />
			</td>
            <td><?=$no++?></td>
    		<td><?=$advance->advance_number?></td>
			<td><?=date("d F Y",strtotime($advance->advance_date))?></td>
			<td><?=ucwords(strtolower($advance->advance_name))?></td>
			<td><?=$advance->debtor_cd.' - '.$advance->debtor_name?></td>
			<td><?=$advance->creditor_name == '' ? '-' : $advance->creditor_name?></td>
			<td><?=$advance->remark?></td>
			<td align="right"><?=number_format($advance->advance_total,0,',','.')?></td>
          </tr>
    <?php 
            }
        } 
      }
    ?>
  </tbody>
</table>
<?php
}
else if($tipe == 'reimburse'){
?>
<table id="tbl_advance_invoice_multiple" class="table table-striped table-hover b-t b-light text-sm">
    <thead>
      <tr>
        <th>#</th>
        <th><?=lang('no')?></th>
        <th><?=lang('reimburse_number')?> </th>
		<th><?=lang('date')?> </th>
        <th><?=lang('advance_type')?></th>
		<th><?=lang('remark')?> </th>
		<th><?=lang('amount')?> (Rp)</th>
      </tr> 
	</thead>
	<tbody>
      <?php
      if (!empty($get_data)) {
          $no = 1;
          foreach ($get_data as $reimburse) { 
            $check_data = $this->cash_bank_payment_model->get_data_detail_by_advance_invoice_no($reimburse->reimburse_number);
            if(count($check_data) == 0){
                if($payment_type == 'P'){
                    /*
                    if($reimburse->paid_total < 0){                
                        $paid = $reimburse->paid_total;
                    }
                    else{
                        $paid = $reimburse->paid_total * -1;
                    }
                    */
                    $paid = $reimburse->paid_total * -1;
      ?>
                  <tr>
            		<td>
			         <input type="checkbox" name="chk_cb[]" id="chk_cb_<?=$reimburse->reimburse_number?>" onclick="get_data_invoice_chk('<?=$reimburse->reimburse_number?>','<?=$paid?>')" value="1" style="width: 15px;" />
                    </td>
                    <td><?=$no++?></td>
            		<td><?=$reimburse->reimburse_number?></td>
        			<td><?=date("d F Y",strtotime($reimburse->reimburse_date))?></td>
        			<td><?=ucwords(strtolower($reimburse->advance_name))?></td>
        			<td><?=$reimburse->remark?></td>
        			<td align="right"><?=number_format($paid,0,',','.')?></td>
                  </tr>
    <?php 
                }
                else{
                    if($reimburse->paid_total > 0){                
                        $paid = $reimburse->paid_total;
      ?>
                  <tr>
            		<td>
			         <input type="checkbox" name="chk_cb[]" id="chk_cb_<?=$reimburse->reimburse_number?>" onclick="get_data_invoice_chk('<?=$reimburse->reimburse_number?>','<?=$paid?>')" value="1" style="width: 15px;" />
                    </td>
                    <td><?=$no++?></td>
            		<td><?=$reimburse->reimburse_number?></td>
        			<td><?=date("d F Y",strtotime($reimburse->reimburse_date))?></td>
        			<td><?=ucwords(strtolower($reimburse->advance_name))?></td>
        			<td><?=$reimburse->remark?></td>
        			<td align="right"><?=number_format($paid,0,',','.')?></td>
                  </tr>
    <?php 
                    }
                }
            }
        } 
      }
    ?>
  </tbody>
</table>
<?php
}
else{
?>
<div class="col-md-12 text-center">
    <p>&nbsp;</p>
    <br />
    <p>Data not available</p>
    <p>&nbsp;</p>
</div>
<?php
}
?>