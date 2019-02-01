
<!-- Start -->


<section id="content">
	<section class="hbox stretch">
	
		
	
		<aside class="aside-md bg-white b-r" id="subNav">

			<header class="dk header b-b">
		<a href="<?=base_url()?>estimates/manage/add" data-original-title="<?=lang('create_estimate')?>" data-toggle="tooltip" data-placement="bottom" class="btn btn-icon btn-default btn-sm pull-right"><i class="fa fa-plus"></i></a>
		<p class="h4"><?=lang('all_estimates')?></p>
		</header>


			<section class="vbox">
			 <section class="scrollable w-f">
			   <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
			<ul class="nav">
			<?php
			if (!empty($estimates)) {
			foreach ($estimates as $key => $estimate) { 
				if ($estimate->invoiced == 'Yes') {	$invoice_status = 'INVOICED'; $label = 'success'; }elseif ($estimate->emailed == 'Yes') {
					$invoice_status = 'SENT'; $label = 'info';	}else{	$invoice_status = 'DRAFT'; $label = 'default';	}
				?>
				<li class="b-b b-light"><a href="<?=base_url()?>estimates/manage/details/<?=$estimate->est_id?>">
				<?php
				if ($estimate->client == '0') { ?>
					<span class="label label-success">General Estimate</span>
				<?php }else{ ?>
				<?=ucfirst($this->applib->company_details($estimate->client,'company_name'))?>
				<?php } ?>
				<div class="pull-right">
				<?=$this->config->item('default_currency')?> <?=number_format($this->user_profile->estimate_payable($estimate->est_id),2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?></div> <br>
				<small class="block small text-muted"><?=$estimate->reference_no?> | <?=strftime("%b %d, %Y", strtotime($estimate->date_saved));?> <span class="label label-<?=$label?>"><?=$invoice_status?></span></small>

				</a> </li>
				<?php } } ?>
			</ul> 
			</div></section>
			</section>
			</aside> 
			
			<aside>
			<section class="vbox">
				<header class="header bg-white b-b clearfix">
					<div class="row m-t-sm">
						<div class="col-sm-8 m-b-xs">
							
						<div class="btn-group">
						<a  data-original-title="<?=lang('refresh')?>" data-toggle="tooltip" data-placement="right"  class="btn btn-sm btn-default" href="<?=current_url()?>" title="<?=lang('refresh')?>"><i class="fa fa-refresh"></i></a>
						</div>
						</div>
						<div class="col-sm-4 m-b-xs">
						<?php  echo form_open(base_url().'estimates/search'); ?>
							<div class="input-group">
								<input type="text" class="input-sm form-control" name="keyword" placeholder="<?=lang('search')?>">
								<span class="input-group-btn"> <button class="btn btn-sm btn-default" type="submit"><?=lang('go')?>!</button>
								</span>
							</div>
							</form>
						</div>
					</div> </header>
					<section class="scrollable wrapper w-f">



					<!-- Start create estimate -->
<div class="col-sm-12">
	<section class="panel panel-default">
	<header class="panel-heading font-bold"><i class="fa fa-info-circle"></i> <?=lang('estimate_details')?></header>
	<div class="panel-body">

<?php
			 $attributes = array('class' => 'bs-example form-horizontal');
          echo form_open(base_url().'estimates/manage/add',$attributes); ?>
			 
          		<div class="form-group form-md-line-input">
				<label class="col-lg-2 control-label"><?=lang('reference_no')?> <span class="text-danger">*</span></label>
				<div class="col-lg-3">
				<?php $this->load->helper('string'); ?>
					<input type="text" class="form-control" value="EST<?=random_string('nozero', 5);?>" name="reference_no">
				</div>
				</div>

				<div class="form-group form-md-line-input">
				<label class="col-lg-2 control-label"><?=lang('client')?> <span class="text-danger">*</span> </label>
				<div class="col-lg-6">
					<div class="m-b"> 
					<select id="select2-option" style="width:260px" name="client" >
					<optgroup label="Clients"> 
					<?php 
					if (!empty($clients)) {
						foreach ($clients as $client): ?>
					<option value="<?=$client->co_id?>"><?=strtoupper($client->company_name)?></option>
					<?php endforeach; } ?>
					</optgroup> 
					</select> 
					</div> 
				</div>
			</div>

				<div class="form-group form-md-line-input">
				<label class="col-lg-2 control-label"><?=lang('due_date')?></label> 
				<div class="col-lg-8">
				<input class="input-sm input-s datepicker-input form-control" size="16" type="text" value="<?=date('d-m-Y')?>" name="due_date" data-date-format="dd-mm-yyyy" >
				</div> 
				</div>	

				<div class="form-group form-md-line-input">
			<label class="col-lg-2 control-label"><?=lang('default_tax')?> </label>
			<div class="col-lg-4">
				<div class="input-group m-b">
					<span class="input-group-addon">%</span>
					<input class="form-control " type="text" value="<?=$this->config->item('default_tax')?>" name="tax">
				</div>
				<span class="help-block m-b-none"><?=lang('This_tax_will')?></span>
			</div>
		</div>	
				
				<div class="form-group form-md-line-input">
				<label class="col-lg-2 control-label"><?=lang('notes')?> </label>
				<div class="col-lg-8">
				<textarea name="notes" class="form-control">Looking forward to doing business with you.</textarea>
				</div>
				</div>
				<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> <?=lang('create_estimate')?></button>


				
		</form>
</div>
</section>
</div>


<!-- End create estimate -->






					</section>  




		</section> </aside> </section> <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> </section>



<!-- end -->