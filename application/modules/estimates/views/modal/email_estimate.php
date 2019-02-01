<div class="modal-dialog">
	<div class="modal-content">
	<?php
	foreach ($estimate_details as $key => $est) { ?>
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('email_estimate')?></h4>
		</div><?php
			 $attributes = array('class' => 'bs-example form-horizontal');
          echo form_open(base_url().'estimates/action/emailestimate',$attributes); ?>

          <?php
          			$est_tax = $est->tax?$est->tax:$this->config->item('default_tax');
					$est_cost = $this->user_profile->estimate_payable($est->est_id);
					$tax = ($est_tax/100) * $est_cost;
          ?>
		<div class="modal-body">

			<input type="hidden" name="ref" value="<?=$est->reference_no?>">
			<input type="hidden" name="est_id" value="<?=$est->est_id?>">
			<?php
			if ($est->client != '0') { ?>
			<input type="hidden" name="client_name" value="<?=ucfirst($this->user_profile->get_profile_details($est->client,'fullname')? $this->user_profile->get_profile_details($est->client,'fullname'):$this->user_profile->get_user_details($est->client,'username'))?>">
			<?php }else{ ?>
			<input type="hidden" name="client_name" value="0">
			<?php } ?>
			
			<input type="hidden" name="amount" value="<?=number_format(($est_cost + $tax),2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?>">
			<?php
			if ($est->client == '0') { ?>
			<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('recipient')?> <span class="text-danger">*</span></label>
				<div class="col-lg-8">
					<input type="email" class="form-control" placeholder="Enter Client Email" name="recipient" required>
				</div>
				</div>
				<?php } ?>
			 
          				<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('subject')?> <span class="text-danger">*</span></label>
				<div class="col-lg-8">
					<input type="text" class="form-control" value="Estimate from <?=$this->config->item('company_name')?> (EST #<?=$est->reference_no?>)" name="subject">
				</div>
				</div>
				
				
				<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('message')?></label>
				<div class="col-lg-8">
			<textarea name="message" class="form-control" style="height:250px;"><?=$this->config->item('email_estimate_message')?></textarea>
				</div>
				</div>

				<p class="text-danger">Don't edit words enclosed in braces ( {} )</p>
			
		</div>
		<div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a> 
		<button type="submit" class="btn btn-success"><?=lang('email_estimate')?></button>
		</form>
		</div>
	</div>
	<?php } ?>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->