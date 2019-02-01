<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title"><?=lang('add_contact')?></h4>
		</div><?php
			 $attributes = array('class' => 'bs-example form-horizontal');
          echo form_open(base_url().'auth/register_user',$attributes); ?>
          
							<?php echo validation_errors(); ?>
		<div class="modal-body">
			 <input type="hidden" name="r_url" value="<?=base_url()?>companies/view/details/<?=$company?>">
			 <input type="hidden" name="company" value="<?=$company?>">
			 <input type="hidden" name="role" value="2">
			 <div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('full_name')?> <span class="text-danger">*</span></label>
				<div class="col-lg-8">
					<input type="text" class="form-control" value="<?=set_value('fullname')?>" placeholder="E.g John Doe" name="fullname" required>
				</div>
				</div>
          		<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('username')?> <span class="text-danger">*</span></label>
				<div class="col-lg-8">
					<input type="text" class="form-control" value="<?=set_value('username')?>" placeholder="johndoe" name="username" required>
				</div>
				</div>
				<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('email')?> <span class="text-danger">*</span></label>
				<div class="col-lg-8">
					<input type="email" class="form-control" value="<?=set_value('email')?>" placeholder="me@domain.com" name="email" required>
				</div>
				</div>
				<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('password')?> <span class="text-danger">*</span></label>
				<div class="col-lg-8">
					<input type="password" class="form-control" value="<?=set_value('password')?>" name="password" required>
				</div>
				</div>
				<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('confirm_password')?> <span class="text-danger">*</span></label>
				<div class="col-lg-8">
					<input type="password" class="form-control" value="<?=set_value('confirm_password')?>" name="confirm_password" required>
				</div>
				</div>
				<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('phone')?> </label>
				<div class="col-lg-8">
					<input type="text" class="form-control" value="<?=set_value('phone')?>" name="phone" placeholder="+52 782 983 434">
				</div>
				</div>
				<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('address')?> </label>
				<div class="col-lg-8">
				<textarea name="address" class="form-control"></textarea>
				</div>
				</div>
			
		</div>
		<div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a> 
		<button type="submit" class="btn green"><?=lang('add_contact')?></button>
		</form>
		</div>
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->