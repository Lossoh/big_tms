<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('edit')?> <?=lang('user')?></h4>
	</div>
          <?php
			 $attributes = array('class' => 'bs-example form-horizontal', 'autocomplete' => 'off');
          echo form_open(base_url().'users/view/update',$attributes); ?>
          <?php
								if (!empty($user_details)) {
				foreach ($user_details as $key => $user) { ?>
		<div class="modal-body">
			 <input type="hidden" name="user_id" value="<?=$user->user_rowID?>">
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
			        <label class="col-lg-4 control-label"><?=lang('company')?> </label>
			        <div class="col-lg-8">
			        <select class="form-control" name="company" > 
                      <optgroup label="Default Company"> 
			          <option value="<?=$user->company?>"><?=lang('use_current')?></option>
			          </optgroup> 
                      <optgroup label="Other Companies"> 
			          <?php if (!empty($companies)) {
			            foreach ($companies as $company){ ?>
			            <option value="<?=$company->co_id?>"><?=$company->company_name?></option>
			            <?php }} ?>
			            <option value="<?=$this->config->item('comp_name')?>"><?=$this->config->item('comp_name')?></option>
                      </optgroup>
			        </select> 
	               </div>
                </div>
                <div class="form-group form-md-line-input">
			        <label class="col-lg-4 control-label"><?=lang('departement')?> </label>
			        <div class="col-lg-8">
                    <input type="hidden" name="departement" value="<?=$user->dep_rowID?>" />
                    <?php
                    $get_dep = $this->user->get_departement($user->dep_rowID);
                    echo $get_dep->dep_name;
                    ?>
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
				<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('role')?> <span class="text-danger">*</span></label>
				<div class="col-lg-8">
				<select name="role_id" class="form-control">
                    <optgroup label="Default Role"> 
				        <option value="<?=$user->role_rowID?>"><?=lang('use_current')?></option>
                    </optgroup> 
                    <optgroup label="Other Roles"> 
    					<?php
    					if (!empty($roles)) {
    					foreach ($roles as $row) { ?>
    						<option value="<?=$row->rowID?>"><?=ucfirst($row->role)?></option>
    					<?php } } ?>			
   		            </optgroup>
				</select>
				</div>
				</div>
			
		</div>
		<div class="modal-footer"> 
    		<button type="submit" class="btn green"><?=lang('save')?></button>
            <a href="#" class="btn red" data-dismiss="modal"><?=lang('close')?></a> 		
		<?php }} ?>
		</div>
        </form>
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->