<!-- Start -->
<section id="content">
	<section class="hbox stretch">
		
		<aside class="aside-md bg-white b-r hidden-print" id="subNav">
			<header class="dk header b-b">
				<a href="<?=base_url()?>invoices/manage/add" data-original-title="<?=lang('new_invoice')?>" data-toggle="tooltip" data-placement="bottom" class="btn btn-icon btn-default btn-sm pull-right"><i class="fa fa-plus"></i></a>
				<p class="h4"><?=lang('all_invoices')?></p>
			</header>
			
			<section class="vbox">
				<section class="scrollable w-f">
					<div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
						<ul class="nav"><?php
									if (!empty($invoices)) {
							foreach ($invoices as $key => $invoice) { ?>
							<li class="b-b b-light <?php if($invoice->inv_id == $this->uri->segment(4)){ echo "bg-light dk"; } ?>"><a href="<?=base_url()?>invoices/manage/details/<?=$invoice->inv_id?>">
								<?=ucfirst($this->applib->company_details($invoice->client,'company_name'))?>
								<div class="pull-right">
								<?=$invoice->currency?> <?=number_format($this->user_profile->invoice_payable($invoice->inv_id),2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?></div> <br>
								<small class="block small text-muted"><?=$invoice->reference_no?> | <?=strftime("%b %d, %Y", strtotime($invoice->date_saved));?> </small>
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
								if (!empty($invoice_details)) {
								foreach ($invoice_details as $key => $inv) { ?>
								
								
								<a href="<?=base_url()?>invoices/manage/quickadd/<?=$inv->inv_id?>" title="<?=lang('item_quick_add')?>" class="btn btn-sm red" data-toggle="ajaxModal"><i class="fa fa-list-alt text-white"></i> <?=lang('items')?></a>
								
								<?php
								if ($this->user_profile->invoice_payable($inv->inv_id) > 0) { ?>
								<a class="btn btn-sm btn-success" href="<?=base_url()?>invoices/manage/pay/<?=$inv->inv_id?>/<?=$inv->reference_no?>" data-toggle="ajaxModal"
									title="<?=lang('add_payment')?>">
								<i class="fa fa-credit-card"></i> <?=lang('pay_invoice')?></a>
								
								
								<div class="btn-group">
									<button class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
									<?=lang('more_actions')?>
									<span class="caret"></span></button>
									<ul class="dropdown-menu">
										<li>
											<a href="<?=base_url()?>invoices/manage/emailinvoice/<?=$inv->inv_id?>/<?=$inv->reference_no?>" data-toggle="ajaxModal" title="<?=lang('email_invoice')?>"><?=lang('email_invoice')?></a>
										</li>
										<li>
											<a href="<?=base_url()?>invoices/manage/reminder/<?=$inv->inv_id?>/<?=$inv->reference_no?>" data-toggle="ajaxModal" title="<?=lang('send_reminder')?>"><?=lang('send_reminder')?></a>
										</li>
										<li><a href="<?=base_url()?>invoices/manage/timeline/<?=$inv->inv_id?>"><?=lang('invoice_history')?></a></li>
										<li class="divider"></li>
										<li><a href="<?=base_url()?>invoices/manage/edit/<?=$inv->inv_id?>"><?=lang('edit_invoice')?></a></li>
										<li><a href="<?=base_url()?>invoices/manage/delete/<?=$inv->inv_id?>" data-toggle="ajaxModal"><?=lang('delete_invoice')?></a></li>
									</ul>
								</div>
								<?php } ?>
							</div>
							<div class="col-sm-4 m-b-xs pull-right">
								<a href="<?=base_url()?>fopdf/invoice/<?=$inv->inv_id?>/<?=$inv->reference_no?>" class="btn btn-sm btn-dark pull-right">
								<i class="fa fa-file-pdf-o"></i> <?=lang('pdf')?></a>
							</div>
						</div> </header>
						
						
						
						<section class="scrollable w-f">
							<div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
								
								<!-- Start Display Details -->
								<?php  echo modules::run('sidebar/flash_msg');?>
								<?php
								if(!$this->session->flashdata('message')){
								if(strtotime($inv->due_date) < time()){ ?>
								<div class="alert alert-info hidden-print">
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