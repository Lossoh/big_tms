<?php
if($gl_type == 'cash advance'){
?>
<table id="tbl_data_reference" class="table table-striped table-hover b-t b-light text-sm">
    <thead>
      <tr>
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
            $check_reference = $this->general_ledger_model->get_data_reference_by_ref_no($cash_advance_list->advance_no);
            if($check_reference == 0){
                //$total_balance = ($cash_advance_list->advance_amount + $cash_advance_list->advance_extra_amount) - $cash_advance_list->advance_allocation;
                $total_balance = $cash_advance_list->advance_balance;
                //if($total_balance < 0){
      ?>
                  <tr style="cursor: pointer;" onclick="get_data_reference('<?=$cash_advance_list->advance_no?>','<?=$cash_advance_list->advance_date?>','<?=$cash_advance_list->employee_driver_rowID?>','<?=$cash_advance_list->description == '' ? '-' : $cash_advance_list->description?>','<?=$gl_type?>','<?=$total_balance?>')">
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
                //} 
            }
        } 
      }
     ?>
  </tbody>
</table>
<?php
}
else if($gl_type == 'realization'){
?>
<table id="tbl_data_reference" class="table table-striped table-hover b-t b-light text-sm">
    <thead>
      <tr>
        <th><?=lang('no')?></th>
        <th><?=lang('realization_no')?></th>
        <th><?=lang('cash_advance_no')?></th>
		<th>Realization <?=lang('date')?></th>
		<th><?=lang('driver')?>/<?=lang('employee')?> Name</th>
        <th>Police No</th>
		<th><?=lang('description')?></th>
		<th><?=lang('cash_advance_total')?></th>
		<th><?=lang('realization_total')?></th>
      </tr> 
	</thead>
	<tbody>
      <?php
      if (!empty($get_data)) {
          $no = 1;
          foreach ($get_data as $realization) { 
            $check_reference = $this->general_ledger_model->get_data_reference_by_ref_no($realization->alloc_no);
            if($check_reference == 0){
              $total_cash_advance = $realization->advance_amount + $realization->advance_extra_amount;
      ?>
              <tr style="cursor: pointer;" onclick="get_data_reference('<?=$realization->alloc_no?>','<?=$realization->alloc_date?>','<?=$realization->employee_driver_rowID?>','<?=$realization->descs == '' ? '-' : $realization->descs?>','<?=$gl_type?>','<?=$realization->alloc_amt?>')">
        		<td><?=$no++?></td>
        		<td><?=$realization->alloc_no?></td>
        		<td><?=$realization->advance_no?></td>
        		<td style="width:10%"><?=date("d-m-Y",strtotime($realization->alloc_date))?></td>
        		<td><?=$realization->debtor_cd?> - <?=$realization->debtor_name?></td>
                <td><?=$realization->police_no?></td>
        		<td><?=$realization->descs?></td>
        		<td style="text-align: right;"><?= number_format($total_cash_advance,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
          		<td style="text-align: right;"><?= number_format($realization->alloc_amt,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
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
else if($gl_type == 'refund'){
?>
<table id="tbl_data_reference" class="table table-striped table-hover b-t b-light text-sm">
    <thead>
      <tr>
        <th><?=lang('no')?></th>
        <th>Refund No</th>
        <th><?=lang('cash_advance_no')?></th>
		<th>Refund <?=lang('date')?></th>
		<th><?=lang('driver')?>/<?=lang('employee')?> Name</th>
        <th>Police No</th>
		<th><?=lang('description')?></th>
		<th><?=lang('cash_advance_total')?></th>
		<th>Refund Total</th>
      </tr> 
	</thead>
	<tbody>
      <?php
      if (!empty($get_data)) {
          $no = 1;
          foreach ($get_data as $refund) { 
            $check_reference = $this->general_ledger_model->get_data_reference_by_ref_no($refund->alloc_no);
            if($check_reference == 0){
                $total_cash_advance = $refund->advance_amount + $refund->advance_extra_amount;
      ?>
                <tr style="cursor: pointer;" onclick="get_data_reference('<?=$refund->alloc_no?>','<?=$refund->alloc_date?>','<?=$refund->employee_driver_rowID?>','<?=$refund->descs == '' ? '-' : $refund->descs?>','<?=$gl_type?>','<?=$refund->alloc_amt?>')">
            		<td><?=$no++?></td>
            		<td><?=$refund->alloc_no?></td>
            		<td><?=$refund->advance_no?></td>
            		<td style="width:10%"><?=date("d-m-Y",strtotime($refund->alloc_date))?></td>
            		<td><?=$refund->debtor_cd?> - <?=$refund->debtor_name?></td>
                    <td><?=$refund->police_no?></td>
            		<td><?=$refund->descs?></td>
            		<td style="text-align: right;"><?= number_format($total_cash_advance,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
              		<td style="text-align: right;"><?= number_format($refund->alloc_amt,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
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
else if($gl_type == 'invoice'){
?>
<table id="tbl_data_reference" class="table table-striped table-hover b-t b-light text-sm">
    <thead>
      <tr>
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
            $check_reference = $this->general_ledger_model->get_data_reference_by_ref_no($invoice->trx_no);
            if($check_reference == 0){
      ?>
              <tr style="cursor: pointer;" onclick="get_data_reference('<?=$invoice->trx_no?>','<?=$invoice->trx_date?>','<?=$invoice->debtor_rowID?>','<?=$invoice->descs == '' ? '-' : $invoice->descs?>','<?=$gl_type?>','<?=$invoice->total_amt?>')">
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
else if($gl_type == 'account receivable'){
?>
<table id="tbl_data_reference" class="table table-striped table-hover b-t b-light text-sm">
    <thead>
      <tr>
        <th><?=lang('no')?></th>
        <th>AR No</th>
		<th>AR Date</th>
		<th>Name</th>
		<th>Description</th>
        <th>Amount (Rp)</th>
      </tr> 
	</thead>
	<tbody>
      <?php
      if (!empty($get_data)) {
          $no = 1;
          foreach ($get_data as $ar) { 
            $check_reference = $this->general_ledger_model->get_data_reference_by_ref_no($ar->trx_no);
            if($check_reference == 0){
                if($ar->trx_amt > 0){
                    $trx_amt = $ar->trx_amt;
                }
                else{
                    $trx_amt = $ar->trx_amt * -1;
                }
                
                $nama_pay_to = '-';
                if($ar->debtor_creditor_type == 'D'){
                    $get_nama = $this->general_ledger_model->get_by_id_table('sa_debtor',$ar->debtor_creditor_rowID);
                    $nama_pay_to = $get_nama->debtor_name == '' ? '-' : $get_nama->debtor_name;
                }
                else if($ar->debtor_creditor_type == 'C'){
                    $get_nama = $this->general_ledger_model->get_by_id_table('sa_creditor',$ar->debtor_creditor_rowID);
                    $nama_pay_to = $get_nama->creditor_name == '' ? '-' : $get_nama->creditor_name;                            
                }
                else if($ar->debtor_creditor_type == 'G'){
                    if($ar->manual_debtor_creditor_type == 'D' || $ar->manual_debtor_creditor_type == 'E'){ 
                        $get_nama = $this->cash_bank_payment_model->get_by_id_table('sa_debtor',$ar->debtor_creditor_rowID);
                        $nama_pay_to = $get_nama->debtor_name == '' ? '-' : ucwords(strtolower($get_nama->debtor_name));
                    }
                    else{
                        $nama_pay_to = $ar->manual_debtor_creditor;                            
                    }
                }
                
      ?>
              <tr style="cursor: pointer;" onclick="get_data_reference('<?=$ar->trx_no?>','<?=$ar->trx_date?>','<?=$ar->debtor_creditor_rowID?>','<?=$ar->descs == '' ? '-' : $ar->descs?>','<?=$gl_type?>','<?=$trx_amt?>')">
        		<td><?=$no++?></td>
        		<td><?=$ar->trx_no?></td>
        		<td style="width:10%"><?=date("d-m-Y",strtotime($ar->trx_date))?></td>
                <td><?=strtoupper($nama_pay_to)?></td>
        		<td><?=strtoupper($ar->descs)?></td>
                <td style="text-align: right;"><?= number_format($trx_amt,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
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
else if($gl_type == 'account payable'){
?>
<table id="tbl_data_reference" class="table table-striped table-hover b-t b-light text-sm">
    <thead>
      <tr>
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
            $check_reference = $this->general_ledger_model->get_data_reference_by_ref_no($ap->trx_no);
            if($check_reference == 0){
                $base_amt = $ap->base_amt;
                $tax = '';
                if($ap->without_tax == 0){
                    $base_amt += $ap->tax_amt;
                    $tax = '<br><i style="color: #C00; font-size: 11px;">Tax 10% : <b>'.number_format($ap->tax_amt,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator')).'</b></i>';
                }
      ?>
              <tr style="cursor: pointer;" onclick="get_data_reference('<?=$ap->trx_no?>','<?=$ap->trx_date?>','<?=$ap->creditor_rowID?>','<?=$ap->descs == '' ? '-' : $ap->descs?>','<?=$gl_type?>','<?=$base_amt?>')">
        		<td><?=$no++?></td>
        		<td><?=$ap->trx_no?></td>
        		<td style="width:10%"><?=date("d-m-Y",strtotime($ap->trx_date))?></td>
                <td><?=ucwords(strtolower($ap->creditor_type))?></td>
                <td><?=strtoupper($ap->creditor_name)?></td>
        		<td><?=strtoupper($ap->ref_no)?></td>
                <td style="text-align: right;"><?= number_format($ap->base_amt,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator')).$tax;?></td>
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
else if($gl_type == 'kontra bon'){
?>
<table id="tbl_data_reference" class="table table-striped table-hover b-t b-light text-sm">
    <thead>
      <tr>
        <th><?=lang('no')?></th>
        <th>KB No</th>
		<th>KB Date</th>
		<th>Reference No</th>
        <th>Base Amount (Rp)</th>
        <th>VAT 10% (Rp)</th>
        <th>Total Amount (Rp)</th>
      </tr> 
	</thead>
	<tbody>
      <?php
      if (!empty($get_data)) {
          $no = 1;
          foreach ($get_data as $ap) { 
            $check_reference = $this->general_ledger_model->get_data_reference_by_ref_no($ap->trx_no);
            if($check_reference == 0){
                $base_amt = $ap->base_amt;
                $tax = '';
                if($ap->without_tax == 0){
                    $base_amt += $ap->tax_amt;
                    $tax = '<br><i style="color: #C00; font-size: 11px;">Tax 10% : <b>'.number_format($ap->tax_amt,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator')).'</b></i>';
                }
      ?>
              <tr style="cursor: pointer;" onclick="get_data_reference_kb('<?=$ap->trx_no?>','<?=$ap->trx_date?>','<?=$ap->creditor_rowID?>','<?=$ap->descs == '' ? '-' : $ap->descs?>','<?=$gl_type?>',<?=$ap->tax_amt?>,<?=$ap->base_amt?>)">
        		<td><?=$no++?></td>
        		<td><?=$ap->trx_no?></td>
        		<td style="width:10%"><?=date("d-m-Y",strtotime($ap->trx_date))?></td>
                <td><?=strtoupper($ap->ref_no)?></td>
                <td style="text-align: right;"><?= number_format($ap->base_amt,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));//.$tax;?></td>
                <td style="text-align: right;"><?= number_format($ap->tax_amt,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
                <td style="text-align: right;"><?= number_format($ap->total_amt,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
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
else if($gl_type == 'advance'){
?>
<table id="tbl_data_reference" class="table table-striped table-hover b-t b-light text-sm">
    <thead>
      <tr>
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
            $check_reference = $this->general_ledger_model->get_data_reference_by_ref_no($advance->advance_number);
            if($check_reference == 0){
                $check_advance_in_cb = $this->general_ledger_model->get_data_cash_bank_advance_by_trx_no($advance->advance_number);
                if($check_advance_in_cb == 0){
      ?>
              <tr style="cursor: pointer;" onclick="get_data_reference('<?=$advance->advance_number?>','<?=$advance->advance_date?>','<?=$advance->debtor_rowID?>','<?=$advance->remark == '' ? '-' : $advance->remark?>','<?=$gl_type?>','<?=$advance->advance_total?>')">
        		<td><?=$no++?></td>
        		<td><?=$advance->advance_number?></td>
        		<td style="width:10%"><?=date("d-m-Y",strtotime($advance->advance_date))?></td>
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
      }
    ?>
  </tbody>
</table>
<?php
}
else if($gl_type == 'reimburse'){
?>
<table id="tbl_data_reference" class="table table-striped table-hover b-t b-light text-sm">
    <thead>
      <tr>
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
            $check_reference = $this->general_ledger_model->get_data_reference_by_ref_no($reimburse->reimburse_number);
            if($check_reference == 0){
      ?>
              <tr style="cursor: pointer;" onclick="get_data_reference_reimburse('<?=$reimburse->reimburse_number?>','<?=$reimburse->reimburse_date?>','0','<?=$reimburse->remark == '' ? '-' : $reimburse->remark?>','<?=$gl_type?>','<?=$reimburse->reimburse_total?>','<?=$reimburse->paid_total?>')">
        		<td><?=$no++?></td>
        		<td><?=$reimburse->reimburse_number?></td>
        		<td style="width:10%"><?=date("d-m-Y",strtotime($reimburse->reimburse_date))?></td>
        		<td><?=ucwords(strtolower($reimburse->advance_name))?></td>
        		<td><?=$reimburse->remark?></td>
        		<td align="right"><?=number_format($reimburse->reimburse_total,0,',','.')?></td>
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
else if($gl_type == 'deposit'){
?>
<table id="tbl_data_reference" class="table table-striped table-hover b-t b-light text-sm">
    <thead>
      <tr>
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
            $check_reference = $this->general_ledger_model->get_data_reference_by_ref_no($deposit->deposit_number);
            if($check_reference == 0){
                $type = '-';
                if($deposit->type == 'C')
                    $type = 'Company';
                else if($deposit->type == 'E')
                    $type = 'Employee';
                else if($deposit->type == 'D')
                    $type = 'Driver';
      ?>
              <tr style="cursor: pointer;" onclick="get_data_reference('<?=$deposit->deposit_number?>','<?=$deposit->date?>','<?=$deposit->debtor_rowID?>','<?=$deposit->remark == '' ? '-' : $deposit->remark?>','<?=$gl_type?>','<?=$deposit->amount?>')">
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
else if($gl_type == 'commission'){
?>
<table id="tbl_data_reference" class="table table-striped table-hover b-t b-light text-sm">
    <thead>
      <tr>
        <th><?=lang('no')?></th>
        <th>Commission No</th>
        <th>Commission Date</th>
        <th>Total Driver Comm (Rp)</th>
        <th>Total Co Driver Comm (Rp)</th>
        <th>Total Deposit (Rp)</th>
        <th>Total Loan (Rp)</th>
      </tr> 
	</thead>
	<tbody>
      <?php
      if (!empty($get_data)) {
          $no = 1;
          foreach ($get_data as $commission) { 
            $check_reference = $this->general_ledger_model->get_data_reference_by_ref_no($commission->commission_no);
            if($check_reference == 0){
      ?>
              <tr style="cursor: pointer;" onclick="get_data_reference('<?=$commission->commission_no?>','<?=$commission->until_date?>','0','-','<?=$gl_type?>','<?=$commission->total_deposit?>')">
        		<td><?=$no++?></td>
        		<td><?=$commission->commission_no?></td>
        		<td style="width:10%"><?=date("d-m-Y",strtotime($commission->until_date))?></td>
        		<td align="right"><?=number_format($commission->total_driver_commission,0,',','.')?></td>
        		<td align="right"><?=number_format($commission->total_co_driver_commission,0,',','.')?></td>
        		<td align="right"><?=number_format($commission->total_deposit,0,',','.')?></td>
        		<td align="right"><?=number_format($commission->total_loan,0,',','.')?></td>
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
else if($gl_type == 'cash in' || $gl_type == 'cash out' || $gl_type == 'bank out' || $gl_type == 'outstanding bank out'){
?>
<table id="tbl_data_reference" class="table table-striped table-hover b-t b-light text-sm">
    <thead>
      <tr>
        <th><?=lang('no')?></th>
        <th>Transaction No</th>
        <th>Transaction Date</th>
        <th>Cash Bank</th>
        <th>Date</th>
        <th>Description</th>
        <th>Amount (Rp)</th>
      </tr> 
	</thead>
	<tbody>
      <?php
      if (!empty($get_data)) {
          $no = 1;
          foreach ($get_data as $cash_in) { 
            $check_reference = $this->general_ledger_model->get_data_reference_by_ref_no($cash_in->trx_no);
            if($check_reference == 0){
      ?>
              <tr style="cursor: pointer;" onclick="get_data_reference_bank('<?=$cash_in->trx_no?>','<?=$cash_in->trx_date?>','<?=$cash_in->acc_name?>','<?=$cash_in->descs == '' ? '-' : $cash_in->descs?>','<?=$gl_type?>','<?=$cash_in->cg_amt?>')">
        		<td><?=$no++?></td>
        		<td><?=$cash_in->trx_no?></td>
        		<td style="width:10%"><?=date("d-m-Y",strtotime($cash_in->trx_date))?></td>
        		<td><?=$cash_in->acc_name?></td>
        		<td style="width:10%"><?=date("d-m-Y",strtotime($cash_in->cg_date))?></td>
        		<td><?=$cash_in->descs?></td>
        		<td align="right"><?=number_format($cash_in->cg_amt,0,',','.')?></td>
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
else if($gl_type == 'bank in' || $gl_type == 'outstanding bank in'){
?>
<table id="tbl_data_reference" class="table table-striped table-hover b-t b-light text-sm">
    <thead>
      <tr>
        <th><?=lang('no')?></th>
        <th>Transaction No</th>
        <th>Transaction Date</th>
        <th>Cash Bank</th>
        <th>Date</th>
        <th>Description</th>
        <th>Amount (Rp)</th>
      </tr> 
	</thead>
	<tbody>
      <?php
      if (!empty($get_data)) {
          $no = 1;
          foreach ($get_data as $bank_in) { 
            if($bank_in->is_cb == null || $bank_in->is_cb == 'Y'){
                $check_reference = $this->general_ledger_model->get_data_reference_by_ref_no($bank_in->trx_no);
                if($check_reference == 0){
      ?>
                  <tr style="cursor: pointer;" onclick="get_data_reference_bank('<?=$bank_in->trx_no?>','<?=$bank_in->trx_date?>','<?=$bank_in->acc_name?>','<?=$bank_in->descs == '' ? '-' : $bank_in->descs?>','<?=$gl_type?>','<?=$bank_in->cg_amt?>')">
            		<td><?=$no++?></td>
            		<td><?=$bank_in->trx_no?></td>
            		<td style="width:10%"><?=date("d-m-Y",strtotime($bank_in->trx_date))?></td>
            		<td><?=$bank_in->acc_name?></td>
            		<td style="width:10%"><?=date("d-m-Y",strtotime($bank_in->cg_date))?></td>
            		<td><?=$bank_in->descs?></td>
            		<td align="right"><?=number_format($bank_in->cg_amt,0,',','.')?></td>
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