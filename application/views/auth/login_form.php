<?php
$login = array(
	'name'	=> 'login',
	'class'	=> 'form-control input-lg',
	'placeholder' => 'Please Input Your Username',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'autofocus'=>'autofocus',
	'autocomplete'=>'off',
    'style' => 'font-size:14px'
);
if ($login_by_username AND $login_by_email) {
	$login_label = 'Username';
} else if ($login_by_username) {
	$login_label = 'Username';
} else {
	$login_label = 'Email';
}
$password = array(
	'name'	=> 'password',
	'id'	=> 'inputPassword',
	'placeholder' => 'Please Input Your Password',	
	'size'	=> 30,
	'class' => 'form-control input-lg',
	'autocomplete'=>'off',
    'style' => 'font-size:14px'
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);
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
		<h3 class="form-title text-center font-green"><?=lang('sign_in')?></h3>
		<?php  echo modules::run('sidebar/flash_msg');?>  

		<div class="form-group">
			<label class="control-label"><?=lang('email_user')?></label>
			<?php echo form_input($login); ?>
			<span style="color: red;">
			<?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?></span>
		</div>
		<div class="form-group">
			<label class="control-label"><?=lang('password')?></label>
			<?php echo form_password($password); ?>
			<span style="color: red;"><?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?></span>
		</div>

		<a href="<?=base_url()?>auth/forgot_password" class="pull-right m-t-xs"><small><?=lang('Forgot_password')?></small></a> 
		<button type="submit" class="btn green uppercase"><?=lang('sign_in')?></button>
	<?php echo form_close(); ?>
</div> 