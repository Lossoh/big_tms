<section id="content"> <section class="vbox"> <section class="scrollable padder">
	<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
		<li><a href="<?=base_url()?>"><i class="fa fa-home"></i> <?=lang('home')?></a></li>
		<li><a href="<?=base_url()?>settings/general"><?=lang('settings')?></a></li>
		<li class="active"><?=lang('default_settings')?></li>
	</ul>
	<?php  echo modules::run('sidebar/flash_msg');?>
	 <div class="row">
	<!-- Start Form -->
	<div class="col-lg-6">

	<section class="panel panel-default">
	<header class="panel-heading font-bold"><i class="fa fa-cogs"></i> <?=lang('default_settings')?></header>
	<div class="panel-body">
	<?php     
			$attributes = array('class' => 'bs-example form-horizontal');
			echo form_open(uri_string(), $attributes); ?>
			<input type="hidden" name="r_url" value="<?=uri_string()?>">

			<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('destination_source')?></label>
				<div class="col-lg-8">
					<div class="m-b"> 
					<select id="select2-option" style="width:260px" name="destination_id" > 
					
						<?php foreach ($destination_defaults as $destination_default): ?>
						<option value="<?=$destination_default->destination_id?>"><?=$destination_default->destination_name?>
						</option>
						<?php endforeach; ?>?>
						<optgroup label="Destinations"> 
						<?php foreach ($destinations as $destination): ?>
						<option value="<?=$destination->destination_id?>"><?=$destination->destination_name?></option>
						<?php endforeach; ?>

					</select> 
					
					</div> 

				</div>
			</div>
			<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('vessel_name')?></label>
				<div class="col-lg-8">
					<div class="m-b"> 
					<select id="select2-palka" style="width:260px" name="vessel_id" > 
						<?php foreach ($vessel_defaults as $vessel_default): ?>
						<option value="<?=$vessel_default->vessel_id?>"><?=$vessel_default->vessel_name?>
						</option>
						<?php endforeach; ?>?>
						<optgroup label="Vessels"> 
						<?php foreach ($vessels as $vessel): ?>
						<option value="<?=$vessel->vessel_id?>"><?=$vessel->vessel_name?></option>
						<?php endforeach; ?>

					</select> 
					
					</div> 

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



</div>

</section>
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>