<div class="modal-dialog">
	<div class="modal-content">
	<?php
	foreach ($invoice_details as $key => $invoice) { ?>
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('email_invoice')?></h4>
		</div><?php
			 $attributes = array('class' => 'bs-example form-horizontal');
          echo form_open(base_url().'invoices/manage/emailinvoice',$attributes); ?>
          <?php
          			$inv_tax = $invoice->tax?$invoice->tax:$this->config->item('default_tax');
					$invoice_cost = $this->applib->invoice_payable($invoice->inv_id);
					$payment_made = $this->applib->invoice_payment($invoice->inv_id);
					$tax = ($inv_tax/100) * $invoice_cost;
          ?>
		<div class="modal-body">
			<input type="hidden" name="ref" value="<?=$invoice->reference_no?>">
			<input type="hidden" name="invoice_id" value="<?=$invoice->inv_id?>">
			<input type="hidden" name="client_name" value="<?=ucfirst($this->applib->company_details($invoice->client,'company_name'))?>">
			
			<input type="hidden" name="amount" value="<?=number_format(($invoice_cost + $tax) - $payment_made,2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?>">
			 
          				<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('subject')?> <span class="text-danger">*</span></label>
				<div class="col-lg-8">
					<input type="text" class="form-control" value="Invoice <?=$invoice->reference_no?>" name="subject">
				</div>
				</div>
				
				
				<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('message')?></label>
				<div class="col-lg-8">
			<textarea name="message" class="form-control" style="height:280px;"><?=$this->config->item('email_invoice_message')?></textarea>
				</div>
				</div>
			
		</div>
		<div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a> 
		<button type="submit" class="btn btn-info"><?=lang('email_invoice')?></button>
		</form>
		</div>
	</div>
	<?php } ?>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->