<section id="content"> <section class="vbox"> <section class="scrollable padder">
	<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
		<li><a href="<?=base_url()?>"><i class="fa fa-home"></i> <?=lang('home')?></a></li>
		<li><a href="<?=base_url()?>settings/system"><?=lang('settings')?></a></li>
		<li class="active"><?=lang('system_settings')?></li>
	</ul>
	<?php  echo modules::run('sidebar/flash_msg');?>
	<!-- Start Form -->
	<div class="col-sm-12"> <section class="panel panel-default">
	<header class="panel-heading font-bold"><i class="fa fa-cogs"></i> <?=lang('system_settings')?></header>
	<div class="panel-body">
		<?php
		$attributes = array('class' => 'bs-example form-horizontal','data-validate'=>'parsley');
		echo form_open_multipart(uri_string(), $attributes); ?>
		 <?php echo validation_errors(); ?>
		<input type="hidden" name="r_url" value="<?=uri_string()?>">
		<div class="form-group form-md-line-input">
			<label class="col-lg-2 control-label"><?=lang('base_url')?> <span class="text-danger">*</span></label>
			<div class="col-lg-10">
				<input type="text" name="base_url" class="form-control" value="<?=$this->config->item('base_url')?>" data-required="true">
				<span class="help-block m-b-none"><strong><?=lang('change_if_necessary')?></strong>.</span>
			</div>
		</div>		

		<div class="form-group form-md-line-input">
			<label class="col-lg-2 control-label"><?=lang('default_language')?> <span class="text-danger">*</span></label>
			<div class="col-lg-4">
				<select name="language" class="form-control" required>
				<option value="<?=$this->config->item('language')?>"><?=lang('use_current')?> - <?=ucfirst($this->config->item('language'))?></option>
				<option value="english">English</option>
				<option value="spanish">Spanish</option>
				<option value="french">French</option>
				<option value="portuguese">Portuguese</option>
				<option value="italian">Italian</option>
				<option value="german">German</option>
				<option value="dutch">Dutch</option>
				<option value="norwegian">Norwegian</option>
				<option value="serbian">Serbia</option>
				</select>
			</div>
		</div>
		
		
		<div class="form-group form-md-line-input">
			<label class="col-lg-2 control-label"><?=lang('file_max_size')?> <span class="text-danger">*</span> </label>
			<div class="col-lg-3">
				<input type="text" class="form-control" value="<?=$this->config->item('file_max_size')?>" name="file_max_size" data-type="digits" data-required="true">
			</div>
		</div>
		<div class="form-group form-md-line-input">
			<label class="col-lg-2 control-label"><?=lang('allowed_files')?></label>
			<div class="col-lg-10">
				<input type="text" class="form-control" value="<?=$this->config->item('allowed_files')?>" name="allowed_files">
			</div>
		</div>
		
		<div class="form-group form-md-line-input">
			<label class="col-lg-2 control-label"><?=lang('demo_mode')?></label>
			<div class="col-lg-4">
				<select name="demo_mode" class="form-control">
					<option value="<?=$this->config->item('demo_mode')?>"><?=lang('use_current')?></option>
					<option value="FALSE"><?=lang('false')?></option>
					<option value="TRUE"><?=lang('true')?></option>
				</select>
			</div>
		</div>
		<div class="form-group form-md-line-input">
			<label class="col-lg-2 control-label"><?=lang('sidebar_theme')?> <span class="text-danger">*</span></label>
			<div class="col-lg-4">
				<select name="sidebar_theme" class="form-control" required>
				<option value="<?=$this->config->item('sidebar_theme')?>"><?=lang('use_current')?> - <?=ucfirst($this->config->item('sidebar_theme'))?></option>
				<option value="light lter">Light</option>
				<option value="dark">Dark</option>
				<option value="black">Black</option>
				</select>
			</div>
		</div>
		<div class="form-group form-md-line-input">
			<label class="col-lg-2 control-label"><?=lang('default_terms')?> <span class="text-danger">*</span></label>
			<div class="col-lg-10">				
			<textarea class="form-control" name="default_terms"><?=$this->config->item('default_terms')?></textarea>
		</div>
	</div>
	
	
	<div class="form-group form-md-line-input">
		<div class="col-lg-offset-2 col-lg-10"> 
		<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> <?=lang('save_changes')?></button>
		</div>
	</div>
</form>

<h4 class="page-header"><?=lang('database_backup')?></h4> 

      <a href="<?=base_url()?>settings/database" class="btn red"><i class="fa fa-cloud-download text"></i>
		                  <span class="text"><?=lang('database_backup')?></span>
		                </a>
</div> </section>
</div>
<!-- End Form -->
</section>
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>