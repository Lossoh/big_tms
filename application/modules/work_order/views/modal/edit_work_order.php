<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"> <?=lang('edit_work_order')?></h4>
		</div>
		<?php
			$attributes = array('class' => 'bs-example form-horizontal');
			echo form_open(base_url().'work_order/view/update',$attributes); ?>
			<?php
			if (!empty($work_order_details)) {
				foreach ($work_order_details as $work_order_detail) { ?>
				<div class="modal-body">
					<input type="hidden" name="row_id" value="<?=$work_order_detail['wo_no']?>">
					
					<div class="form-group form-md-line-input">
						<label class="col-lg-4 control-label"><?=lang('work_order_no')?></label>
						<div class="col-lg-8">
							<input type="text" name="work_order_no"  autocomplete="off" value="<?=$work_order_detail['wo_no']?>" class="input-sm form-control" readonly="true">
						</div>
					</div>
					
					<div class="form-group form-md-line-input">
						<label class="col-lg-4 control-label"><?=lang('work_order_date')?><span class="text-danger">*</span></label>
						<div class="col-lg-8">
							<input type="text" name="work_order_date" placeholder="yyyy-mm-dd" autocomplete="off" value="<?=$work_order_detail['wo_date']?>" class="input-sm form-control" required>
						</div>
					</div>
					
					<div class="form-group form-md-line-input">
						<label class="col-lg-4 control-label"><?=lang('work_order_ref_no')?><span class="text-danger">*</span></label>
						<div class="col-lg-8">
							<input type="text" name="work_order_ref_no" placeholder="Input Ref No" autocomplete="off" value="<?=$work_order_detail['ref_no']?>" class="input-sm form-control" required>
						</div>
					</div>
					
					<div class="form-group form-md-line-input">
						<label class="col-lg-4 control-label"><?=lang('work_order_debtor')?> <span class="text-danger">*</span></label>
						<div class="col-lg-8">
							<select name="work_order_debtor" class="form-control" required>
							<option value ="0">Select</option>
								   <?php
									  if (!empty($debtors)) {
									  foreach ($debtors as $debtor) { ?>
									  <option value="<?php echo $debtor->rowID; ?>" <?php if ($work_order_detail['debtor_rowID'] == $debtor->rowID){echo"selected";} ?>><?php echo $debtor->debtor_cd; ?>&nbsp;-&nbsp;<?php echo $debtor->debtor_name; ?></option>
									<?php }}?>
							</select>
						</div>
					</div>
					
					<div class="form-group form-md-line-input">
						<label class="col-lg-4 control-label"><?=lang('work_order_vessel_no')?></label>
						<div class="col-lg-8">
							<input type="text" name="work_order_vessel_no" placeholder="Input Vessel No" autocomplete="off" value="<?=$work_order_detail['vessel_no']?>" class="input-sm form-control">
						</div>
					</div>
					
					<div class="form-group form-md-line-input">
						<label class="col-lg-4 control-label"><?=lang('work_order_ex_vessel')?><span class="text-danger">*</span></label>
						<div class="col-lg-8">
							<input type="text" name="work_order_ex_vessel" placeholder="Input Vessel No" autocomplete="off" value="<?=$work_order_detail['vessel_name']?>" class="input-sm form-control" required>
						</div>
					</div>
					
					<div class="form-group form-md-line-input">
						<label class="col-lg-4 control-label"><?=lang('work_order_port')?> <span class="text-danger">*</span></label>
						<div class="col-lg-8">
							<select name="work_order_port" class="form-control" required>
							<option value ="0">Select</option>
								   <?php
									  if (!empty($ports)) {
									  foreach ($ports as $port) { ?>
									  <option value="<?php echo $port->rowID; ?>" <?php if ($work_order_detail['port_rowID'] == $port->rowID){echo"selected";} ?>><?php echo $port->port_cd; ?>&nbsp;-&nbsp;<?php echo $port->descs; ?></option>
									<?php }}?>
							</select>
						</div>
					</div>
					
					
					
				<div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a> 
				<button type="submit" class="btn green"><?=lang('save_changes')?></button>
				</form>
				<?php }} ?>
			</div>
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->