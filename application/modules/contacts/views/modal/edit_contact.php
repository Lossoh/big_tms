<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('edit')?> <?=lang('user')?></h4>
		</div><?php
			 $attributes = array('class' => 'bs-example form-horizontal');
          echo form_open(base_url().'contacts/view/update',$attributes); ?>
          <?php
								if (!empty($user_details)) {
				foreach ($user_details as $key => $user) { ?>
		<div class="modal-body">
			 <input type="hidden" name="user_id" value="<?=$user->user_id?>">
			 <input type="hidden" name="company" value="<?=$user->company?>">
			 
			 <div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('full_name')?> <span class="text-danger">*</span></label>
				<div class="col-lg-8">
					<input type="text" class="form-control" value="<?=$user->fullname?>" name="fullname">
				</div>
				</div>
          		<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('email')?> <span class="text-danger">*</span></label>
				<div class="col-lg-8">
					<input type="email" class="form-control" value="<?=$user->email?>" name="email" required>
				</div>
				</div>
				<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('phone')?> </label>
				<div class="col-lg-8">
					<input type="text" class="form-control" value="<?=$user->phone?>" name="phone">
				</div>
				</div>
				
				<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('city')?> </label>
				<div class="col-lg-8">
					<input type="text" class="form-control" value="<?=$user->city?>" name="city">
				</div>
				</div>
				<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('vat')?> </label>
				<div class="col-lg-8">
					<input type="text" class="form-control" value="<?=$user->vat?>" name="vat">
				</div>
				</div>
				<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('address')?> </label>
				<div class="col-lg-8">
				<textarea name="address" class="form-control"><?=$user->address?></textarea>
				</div>
				</div>
			
		</div>
		<div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a> 
		<button type="submit" class="btn btn-info"><?=lang('save_changes')?></button>
		</form>
		<?php }} ?>
		</div>
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->