      <script src="<?=base_url()?>resource/js/app.v2.js"></script>

<table id="tbl-orders" class="table table-striped table-hover b-t b-light text-sm">
	<thead>
		<tr>
			<th class="col-md-2" style="text-align: right;">Cash Advance</th>
			<th class="col-md-2" style="text-align: right;">Date</th>
			<th class="col-md-2" style="text-align: right;">Amount</th>
			<th class="col-md-2" style="text-align: right;">Allocation</th>
			<th class="col-md-2" style="text-align: right;">Balance</th>
			<th class="col-md-2" style="text-align: right;">Refund Amount</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$i=0;$refund_remain_amount=$refund_amount;$balance=0;$balance=0;
	if(isset($ca_lists)){
		foreach($ca_lists as $ca_list){
			
/* 			if($ca_list['advance_balance']<=$refund_remain_amount){
				$balance=$ca_list['advance_balance'];
				$refund_remain_amount-=$balance;
			}else{
				$balance=$refund_remain_amount;
			} */

	?>
		<tr data-rowid="<?php echo $i; ?>">								
			<td>
				<input  type="hidden" class="form-control" id="prefix_<?php echo $i; ?>" name="prefix[]"  value="<?=$ca_list->prefix?>">
				<input  type="hidden" class="form-control" id="year_<?php echo $i; ?>" name="year[]" value="<?=$ca_list['year']?>">
				<input  type="hidden" class="form-control" id="month_<?php echo $i; ?>" name="month[]" value="<?=$ca_list['month']?>">
				<input  type="hidden" class="form-control" id="code_<?php echo $i; ?>" name="code[]"  value="<?=$ca_list['code']?>">
			<?php echo $i+1; ?>-<?=$ca_list['advance_no']?>
			</td>
			<td><?php echo $i+1; ?>-<?=$ca_list->advance_date?></td>
			<td><p class="form-control"><?=$ca_list['advance_amount']?></p></td>
			<td><p class="form-control"><?=$ca_list['advance_allocation']?></p></td>
			<td><p class="form-control"><?=$ca_list['advance_balance']?><?=$ca_list['refund_amount']?></p></td>	
			<td><input type="text" data-rowid="<?php echo $i; ?>" class="form-control" id="refund_amount_<?php echo $i; ?>" name="refund_amount[]"  maxlength="7" style="font-size:15px;font-weight:600;color: black;text-align: right;" value=<?=$balance?> /></td>
		</tr>
	<?php 
		$i++;
	}} 
	?>
	</tbody>
	</table>