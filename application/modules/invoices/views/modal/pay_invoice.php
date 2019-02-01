<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title"><?=lang('new_payment')?></h4>
		</div><?php
			 $attributes = array('class' => 'bs-example form-horizontal');
          echo form_open(base_url().'invoices/manage/pay',$attributes); ?>
		<div class="modal-body">
			<p><?=lang('payment_for_invoice')?> #<?=$reference?></p>
			<input type="hidden" name="invoice_id" value="<?=$invoice_id?>">
			<input type="hidden" name="invoice_ref" value="<?=$reference?>">
			 
          				<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('trans_id')?> <span class="text-danger">*</span></label>
				<div class="col-lg-8">
				<?php $this->load->helper('string'); ?>
					<input type="text" class="form-control" value="<?=random_string('nozero', 6);?>" name="trans_id" readonly>
				</div>
				</div>
				<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('amount')?> (<?=$this->config->item('default_currency_symbol')?>) <span class="text-danger">*</span></label>
				<div class="col-lg-8">
				<?php
				$tax_inv = $this->user_profile->get_invoice_details($invoice_id,'tax');
					$inv_tax = $tax_inv?$tax_inv:$this->config->item('default_tax');
					$invoice_cost = $this->user_profile->invoice_payable($invoice_id);
					$payment_made = $this->user_profile->invoice_payment($invoice_id);
					$tax = ($inv_tax/100) * $invoice_cost;
					$invoice_due = ($invoice_cost + $tax) - $payment_made;
				?>
					<input type="text" class="form-control" value="<?=round($invoice_due,2)?>" name="amount">
				</div>
				</div>
				<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('payment_method')?> <span class="text-danger">*</span></label>
				<div class="col-lg-8">
				<select name="payment_method" class="form-control">
					<?php
					if (!empty($payment_methods)) {
					foreach ($payment_methods as $key => $p_method) { ?>
						<option value="<?=$p_method->method_id?>"><?=$p_method->method_name?></option>
					<?php } } ?>					
				</select>
				</div>
				</div>
				<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('notes')?></label>
				<div class="col-lg-8">
				<textarea name="notes" class="form-control"></textarea>
				</div>
				</div>
			
		</div>
		<div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a> 
		<button type="submit" class="btn btn-success"><?=lang('add_payment')?></button>
		</form>
		</div>
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->