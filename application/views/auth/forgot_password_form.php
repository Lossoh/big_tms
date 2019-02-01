<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'class'	=> 'form-control input-lg',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
    'placeholder' => 'Email/Username'
);
if ($this->config->item('use_username', 'tank_auth')) {
	$login_label = 'Email or login';
} else {
	$login_label = 'Email';
}
?>

<div class="logo">
	<a href="<?=base_url()?>">
		<img src="<?=base_url()?>resource/images/logo-big.jpg" alt="logo-big" />
	</a>
</div>

<div id="content" class="content m-t-lg wrapper-md animated fadeInUp">
	<?php 
	$attributes = array('class' => 'panel-body wrapper-lg login-form');
	echo form_open($this->uri->uri_string(),$attributes); ?>
		<h3 class="form-title text-center font-green"><?=lang('forgot_password')?></h3>
		<?php  echo modules::run('sidebar/flash_msg');?>  

		<div class="form-group">
			<label class="control-label"><?=lang('email')?>/<?=lang('username')?></label>
			<?php echo form_input($login); ?>
			<span style="color: red;">
			<?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?></span>
		</div>

		<a href="<?=base_url()?>auth/login" class="pull-right m-t-xs"><small><?=lang('remember_password')?></small></a> 
		<button type="submit" class="btn red uppercase"><?=lang('get_new_password')?></button>
	<?php echo form_close(); ?>
</div>