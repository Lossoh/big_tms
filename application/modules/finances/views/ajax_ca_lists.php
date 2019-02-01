<table class="table" width="100%">
    <thead>
    			<th style="text-align: center;" width="22%">CA No</th>
    			<th style="text-align: center;" width="14%">CA Date</th>
    			<th style="text-align: center;" width="16%">Amount (Rp)</th>
    			<th style="text-align: center;" width="17%">Allocation (Rp)</th>
    			<th style="text-align: center;" width="15%">Balance (Rp)</th>
    			<th style="text-align: center;">Refund Amount (Rp)</th>
    </thead>
    <tbody>
        <?php
        $i=0;$refund_remain_amount=$refund_amount;$balance=0;$balance=0; $outstanding_amount=0;
        if(isset($ca_lists)){
            foreach($ca_lists as $ca_list){
        		$outstanding_amount+=$ca_list->advance_balance;
                $advance_amount = $ca_list->advance_amount + $ca_list->advance_extra_amount;
        
        ?>
        		<tr data-rowid="<?php echo $i; ?>">								
        			<td style="text-align: left;">
        				<input type="hidden" data-rowid="<?php echo $i; ?>" id="prefix_<?php echo $i; ?>" name="prefix[]"  value="<?=$ca_list->prefix?>"/>
        				<input type="hidden" data-rowid="<?php echo $i; ?>" id="year_<?php echo $i; ?>" name="year[]" value="<?=$ca_list->year?>"/>
        				<input type="hidden" data-rowid="<?php echo $i; ?>" id="month_<?php echo $i; ?>" name="month[]" value="<?=$ca_list->month?>"/>
        				<input type="hidden" data-rowid="<?php echo $i; ?>" id="code_<?php echo $i; ?>" name="code[]"  value="<?=$ca_list->code?>"/>
        				<input type="hidden" data-rowid="<?php echo $i; ?>" class="advance_no" id="advance_no_<?php echo $i; ?>" name="advance_no[]"  value="<?=$ca_list->advance_no?>"/>
        				<input type="hidden" data-rowid="<?php echo $i; ?>" id="advance_date_<?php echo $i; ?>" name="advance_date[]"  value="<?=$ca_list->advance_date?>"/>
        				<input type="hidden" data-rowid="<?php echo $i; ?>" id="advance_amount_<?php echo $i; ?>" name="advance_amount[]"  value="<?=$advance_amount?>"/>
        			<?php echo $i+1; ?>. <?=$ca_list->advance_no?>
        			</td>
        			<td style="text-align: center;"><?= date("d-m-Y",strtotime($ca_list->advance_date))?></td>
        			<td style="text-align: right;"><?= number_format($advance_amount,0,',','.')?></td>
        			<td style="text-align: right;"><?= number_format($ca_list->advance_allocation,0,',','.')?></td>
        			<td style="text-align: right;"><?= number_format($ca_list->advance_balance,0,',','.')?><input  type="hidden" id="ca_balance_<?php echo $i; ?>" name="ca_balance[]"  value="<?=$ca_list->advance_balance?>"/></td>	
        			<td style="text-align: right;"><input type="text" data-rowid="<?php echo $i; ?>" class="refund_amount input-sm form-control currency" id="refund_amount_<?php echo $i; ?>" name="refund_amount[]" style="font-size:15px;font-weight:600;color: black;text-align: right;" value="<?=number_format($balance,0,',','.')?>" /></td>
        		</tr>
        <?php $i++;
            }
        }
        ?>
    </tbody>
</table>
<hr />
<h4>
    <?=lang('outstanding')?>  <?=lang('amount')?>
    <span style="font-size:18px;font-weight:600;color: black;text-align: right;">Rp <?= number_format($outstanding_amount,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></span>
    <input type="hidden" class="form-control" id="total_refund_amount" name="total_refund_amount"  style="font-size:18px;font-weight:600;color: black;text-align: right;" value="<?=number_format($outstanding_amount,0,',','.')?>"  />
</h4>
