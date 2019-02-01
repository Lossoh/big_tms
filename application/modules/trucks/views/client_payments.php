<table class="table table-striped table-hover b-t b-light text-sm">
			<thead>
				<tr>
					<th><?=lang('date')?></th>
					<th><?=lang('invoice')?></th>
					<th><?=lang('payment_method')?> </th>
					<th><?=lang('amount')?> </th>
					<th><?=lang('trans_id')?></th>
				</tr> </thead> <tbody>
				<?php
								if (!empty($user_payments)) {
				foreach ($user_payments as $key => $p) { ?>
				<tr>
					<td><?=strftime("%B %d, %Y", strtotime($p->created_date));?></td>
					<td><a class="text-success" href="<?=base_url()?>invoices/manage/details/<?=$p->invoice?>"><?=$p->reference_no?></a></td>
					<td><?=$p->method_name;?> </td>
					<td><?=$this->config->item('default_currency')?> <?=number_format($p->amount,2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?></td>
					<td><?=$p->trans_id;?></td>
				</tr>
				<?php  }} else{ ?>
				<tr>
					<td></td><td><?=lang('nothing_to_display')?></td><td></td><td></td><td></td>
				</tr>
				<?php } ?>
				
				
				
			</tbody>
		</table>