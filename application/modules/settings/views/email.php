<section id="content"> <section class="vbox"> <section class="scrollable padder">
	<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
		<li><a href="<?=base_url()?>"><i class="fa fa-home"></i> <?=lang('home')?></a></li>
		<li><a href="<?=base_url()?>settings/email"><?=lang('settings')?></a></li>
		<li class="active"><?=lang('email_settings')?></li>
	</ul>
	<?php  echo modules::run('sidebar/flash_msg');?>
	 <div class="row">
	<!-- Start Form -->
	<div class="col-lg-6">
	<section class="panel panel-default">
	<header class="panel-heading font-bold"><i class="fa fa-cogs"></i> <?=lang('email_settings')?></header>
	<div class="panel-body">
	  <?php     
$attributes = array('class' => 'bs-example form-horizontal','data-validate'=>'parsley');
echo form_open(uri_string(), $attributes); ?>
 <?php echo validation_errors(); ?>
<input type="hidden" name="r_url" value="<?=uri_string()?>">

			<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('company_email')?> <span class="text-danger">*</span></label>
				<div class="col-lg-8">
					<input type="email" class="form-control" value="<?=$this->config->item('company_email')?>" name="company_email" data-type="email" data-required="true">
				</div>
			</div>
			<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('email_protocol')?> <span class="text-danger">*</span></label>
				<div class="col-lg-8">
				<select name="protocol" class="form-control">
				<option value="<?=$this->config->item('protocol')?>"><?=lang('use_current')?></option>
				<option value="mail">MAIL</option>
				<option value="smtp">SMTP</option>
				</select>
				</div>
			</div>
			<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('smtp_host')?> </label>
				<div class="col-lg-8">
					<input type="text" class="form-control"  value="<?=$this->config->item('smtp_host')?>" name="smtp_host">
					<span class="help-block m-b-none">SMTP Server Address</strong>.</span>
				</div>
			</div>
			<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('smtp_user')?></label>
				<div class="col-lg-8">
					<input type="text" class="form-control"  value="<?=$this->config->item('smtp_user')?>" name="smtp_user">
				</div>
			</div>
			<div class="form-group form-md-line-input">
			<?php $this->load->library('encrypt'); ?>
				<label class="col-lg-4 control-label"><?=lang('smtp_pass')?></label>
				<div class="col-lg-8">
					<input type="password" class="form-control" value="<?=$this->encrypt->decode($this->config->item('smtp_pass'));?>" name="smtp_pass">
				</div>
			</div>
			<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('smtp_port')?></label>
				<div class="col-lg-8">
					<input type="text" class="form-control" value="<?=$this->config->item('smtp_port')?>" name="smtp_port">
				</div>
			</div>
			
			
			<div class="form-group form-md-line-input">
				<div class="col-lg-offset-2 col-lg-10">
				<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> <?=lang('save_changes')?></button>
				</div>
			</div>
		</form>
	</div> </section>
</div>
<!-- End Form -->

<div class="col-lg-6">
      
        <!-- Account Form -->
        <section class="panel panel-default">
      <header class="panel-heading font-bold"><?=lang('email_templates')?></header>
      <div class="panel-body">

       <?php     
$attributes = array('class' => 'bs-example form-horizontal');
echo form_open(base_url().'settings/update_email_templates', $attributes); ?>
        
        <div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('email_estimate_message')?> <span class="text-danger">*</span></label>
				<div class="col-lg-8">
					<textarea class="form-control" name="email_estimate_message" required><?=$this->config->item('email_estimate_message')?></textarea>
				</div>
			</div>
			<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('email_invoice_message')?> <span class="text-danger">*</span></label>
				<div class="col-lg-8">
					<textarea class="form-control" name="email_invoice_message" required><?=$this->config->item('email_invoice_message')?></textarea>
				</div>
			</div>
			<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('reminder_message')?> <span class="text-danger">*</span></label>
				<div class="col-lg-8">
					<textarea class="form-control" name="reminder_message" required><?=$this->config->item('reminder_message')?></textarea>
				</div>
			</div>        
        
        <button type="submit" class="btn btn-sm btn-success pull-right"><?=lang('save_changes')?></button>
      </form>




    </div>
  </section>
  <!-- /Account form -->
  
    </div>



</div>
</section>
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>