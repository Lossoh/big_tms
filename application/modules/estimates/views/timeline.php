
<!-- Start -->


<section id="content">
	<section class="hbox stretch">
	
		<aside class="aside-md bg-white b-r hidden-print" id="subNav">



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
				if ($estimate->invoiced == 'Yes') {	$est_status = 'INVOICED'; $label = 'success'; }elseif ($estimate->emailed == 'Yes') {
					$est_status = lang('sent'); $label = 'info';	}else{	$est_status = lang('sent'); $label = 'default';	}
				?>
				<li class="b-b b-light <?php if($estimate->est_id == $this->uri->segment(4)){ echo "bg-light dk"; } ?>"><a href="<?=base_url()?>estimates/manage/details/<?=$estimate->est_id?>">
				<?php
				if ($estimate->client == '0') { ?>
					<span class="label label-success">General Estimate</span>
				<?php }else{ ?>
				<?=ucfirst($this->applib->company_details($estimate->client,'company_name'))?>
				<?php } ?>
				<div class="pull-right">
				<?=$this->config->item('default_currency')?> <?=number_format($this->user_profile->estimate_payable($estimate->est_id),2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?></div> <br>
				<small class="block small text-muted"><?=$estimate->reference_no?> | <?=strftime("%b %d, %Y", strtotime($estimate->date_saved));?> <span class="label label-<?=$label?>"><?=$est_status?></span></small>

				</a> </li>
				<?php } } ?>
			</ul> 
			</div></section>
			</section>
			</aside> 
			
			<aside>
			<section class="vbox">
				<header class="header bg-white b-b clearfix hidden-print">
					<div class="row m-t-sm">
						<div class="col-sm-8 m-b-xs">
						<?php
					if (!empty($estimate_details)) {
			foreach ($estimate_details as $key => $estimate) { ?>
			


			<a href="<?=base_url()?>estimates/manage/details/<?=$estimate->est_id?>" data-original-title="<?=lang('view_details')?>" data-toggle="tooltip" data-placement="bottom" class="btn btn-dark btn-sm"><i class="fa fa-info-circle"></i> <?=lang('estimate_details')?></a>

			 
							

						<a data-original-title="<?=lang('convert_to_invoice')?>" data-toggle="tooltip" data-placement="bottom" class="btn btn-sm btn-success <?php if($estimate->invoiced == 'Yes'){ echo "disabled"; } ?>" href="<?=base_url()?>estimates/action/convert/<?=$estimate->est_id?>/<?=$estimate->reference_no?>" data-toggle="ajaxModal"
						 title="<?=lang('convert_to_invoice')?>">
						<?=lang('convert_to_invoice')?></a>				

						<div class="btn-group">
						<button class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
						<?=lang('more_actions')?>
						<span class="caret"></span></button>
						<ul class="dropdown-menu">
								<li><a href="<?=base_url()?>estimates/action/emailestimate/<?=$estimate->est_id?>/<?=$estimate->reference_no?>" data-toggle="ajaxModal"><?=lang('email_estimate')?></a></li>
								<li><a href="<?=base_url()?>estimates/manage/timeline/<?=$estimate->est_id?>/<?=$estimate->reference_no?>"><?=lang('estimate_history')?></a></li>
								<li class="divider"></li>
								<li><a href="<?=base_url()?>estimates/action/delete/<?=$estimate->est_id?>/<?=$estimate->reference_no?>" data-toggle="ajaxModal"><?=lang('delete_estimate')?></a></li>
						</ul>
						</div>

						</div>
						<div class="col-sm-4 m-b-xs">
						<?php
						if ($estimate->client != 0) { ?>
						<a href="<?=base_url()?>fopdf/estimate/<?=$estimate->est_id?>/<?=$estimate->reference_no?>" class="btn btn-sm btn-dark pull-right"><i class="fa fa-file-pdf-o"></i> <?=lang('pdf')?></a> 
						<?php } ?>
					
						</div>
					</div> </header>
					
					

					
			<section class="scrollable w-f">
				<div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
					
					<!-- Start Display Details -->
					<?php  echo modules::run('sidebar/flash_msg');?>
					 <?php
				if(!$this->session->flashdata('message')){
						if(strtotime($estimate->due_date) < time() AND $estimate->invoiced == 'No'){ ?>
						<div class="alert alert-danger hidden-print"> 
						<button type="button" class="close" data-dismiss="alert">×</button> <i class="fa fa-warning"></i>
						<?=lang('invoice_overdue')?>
						</div>

    					<?php } } ?> 


<!-- Timeline START -->
															<section class="panel panel-default">
																<div class="panel-body">
																	<div class="timeline">
														
															<?php
					if (!empty($activities)) {
					foreach ($activities as $key => $a) { ?>
					<?php
					if ($a->activity_id % 2 == 0) { ?>
		<article class="timeline-item">
		<div class="timeline-caption">
			<div class="panel panel-default">
				<div class="panel-body">
					<span class="arrow left"></span>
					<span class="timeline-icon"><i class="fa <?=$a->icon?> time-icon bg-dark"></i>
					</span>
					<span class="timeline-date"><?=strftime("%b %d, %Y %H:%M:%S", strtotime($a->activity_date)) ?></span> 
					<h5><a href="<?=base_url()?>clients/view/details/<?=$a->id*1200?>"><?=ucfirst($a->username)?></a> </h5>
					<p><?=$a->activity?></p>
				</div>
			</div>
		</div> </article>
					<?php }else{ ?>
		  <article class="timeline-item alt">
		<div class="timeline-caption">
			<div class="panel panel-default">
				<div class="panel-body">
					<span class="arrow right"></span>
					<span class="timeline-icon"><i class="fa <?=$a->icon?> time-icon bg-info"></i></span>
					<span class="timeline-date"><?=strftime("%b %d, %Y %H:%M:%S", strtotime($a->activity_date)) ?></span> 
					<h5><a href="<?=base_url()?>clients/view/details/<?=$a->id*1200?>"><?=ucfirst($a->username)?></a></h5>
					<p><?=$a->activity?></p>
				</div>
			</div>
		</div> 
		</article> 
		<?php } ?>
		<?php } } else{ echo lang('nothing_to_display'); } ?>


																	<div class="timeline-footer"><a href="#"><i class="fa fa-plus time-icon inline-block bg-dark"></i></a>
																		</div>
																	</div>
																</div>
															</section>








				</div>
			</section> 


					<?php } } ?>


					 <!-- End display details -->










		</section> </aside> </section> <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> </section>



<!-- end -->