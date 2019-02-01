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
							foreach ($invoices as $key => $invoice) {
							if ($this->invoice->payment_status($invoice->inv_id) == lang('fully_paid')){ $invoice_status = lang('fully_paid'); $label = "success"; }
								elseif($invoice->emailed == 'Yes') { $invoice_status = lang('sent'); $label = "info";	}
							else{ $invoice_status = lang('draft'); $label = "default"; }
							?>
							<li class="b-b b-light <?php if($invoice->inv_id == $this->uri->segment(4)){ echo "bg-light dk"; } ?>">
								<a href="<?=base_url()?>invoices/manage/details/<?=$invoice->inv_id?>">
									<?=ucfirst($this->applib->company_details($invoice->client,'company_name'))?>
									<div class="pull-right">
										<?=$invoice->currency?> <?=number_format($this->user_profile->invoice_payable($invoice->inv_id),2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?>
									</div> <br>
									<small class="block small text-muted"><?=$invoice->reference_no?> | <?=strftime("%b %d, %Y", strtotime($invoice->date_saved));?> <span class="label label-<?=$label?>"><?=$invoice_status?></span></small>
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
									<a href="#" class="btn btn-sm btn-default" onClick="window.print();"><i class="fa fa-print"></i></a>
									<a href="<?=base_url()?>invoices/manage/quickadd/<?=$inv->inv_id?>" title="<?=lang('item_quick_add')?>" class="btn btn-sm red" data-toggle="ajaxModal">
									<i class="fa fa-list-alt text-white"></i> <?=lang('items')?></a>
									
									<?php
									if ($this->user_profile->invoice_payable($inv->inv_id) > 0) { ?>
									<a class="btn btn-sm btn-success" href="<?=base_url()?>invoices/manage/pay/<?=$inv->inv_id?>/<?=$inv->reference_no?>" data-toggle="ajaxModal"
										title="<?=lang('add_payment')?>"><i class="fa fa-credit-card"></i> <?=lang('pay_invoice')?>
									</a>
									<?php } ?>
									
									
									<div class="btn-group">
										<button class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
										<?=lang('more_actions')?>
										<span class="caret"></span></button>
										<ul class="dropdown-menu">
											<?php
											if ($this->user_profile->invoice_payable($inv->inv_id) > 0) { ?>
											<li>
												<a href="<?=base_url()?>invoices/manage/emailinvoice/<?=$inv->inv_id?>/<?=$inv->reference_no?>" data-toggle="ajaxModal" title="<?=lang('email_invoice')?>"><?=lang('email_invoice')?></a>
											</li>
											<li>
												<a href="<?=base_url()?>invoices/manage/reminder/<?=$inv->inv_id?>/<?=$inv->reference_no?>" data-toggle="ajaxModal" title="<?=lang('send_reminder')?>"><?=lang('send_reminder')?></a>
											</li>
											<?php } ?>
											<li><a href="<?=base_url()?>invoices/manage/timeline/<?=$inv->inv_id?>"><?=lang('invoice_history')?></a></li>
											<li class="divider"></li>
											<li><a href="<?=base_url()?>invoices/manage/edit/<?=$inv->inv_id?>"><?=lang('edit_invoice')?></a></li>
											<li><a href="<?=base_url()?>invoices/manage/delete/<?=$inv->inv_id?>" data-toggle="ajaxModal"><?=lang('delete_invoice')?></a></li>
										</ul>
									</div>
									
								</div>
								<div class="col-sm-4 m-b-xs pull-right">
									<a href="<?=base_url()?>fopdf/invoice/<?=$inv->inv_id?>/<?=$inv->reference_no?>" class="btn btn-sm btn-dark pull-right">
									<i class="fa fa-file-pdf-o"></i> <?=lang('pdf')?></a>
								</div>
							</div> </header>
							
							<section class="scrollable wrapper w-f">
								<!-- Start Display Details -->
								<?php
								if(!$this->session->flashdata('message')){
								if(strtotime($inv->due_date) < time()){ ?>
								<div class="alert alert-info hidden-print">
									<button type="button" class="close" data-dismiss="alert">×</button> <i class="fa fa-warning"></i>
									<?=lang('invoice_overdue')?>
								</div>
								<?php } } ?>
								
								<section class="scrollable wrapper">
									<div class="row">
										<div class="col-xs-6">
											<p class="h4"><strong><?=$this->config->item('company_name')?></strong></p>
											
											<?=$this->config->item('company_address')?><br>
											<?=$this->config->item('company_city')?><br>
											<?=$this->config->item('company_country')?><br>
											<?=lang('phone')?>: <?=$this->config->item('company_phone')?> <br>
											<p class="h4"><strong><?=lang('bill_to')?>:</strong></p>
											
											<?=ucfirst($this->applib->company_details($inv->client,'company_name'))?> <br>
											<?=ucfirst($this->applib->company_details($inv->client,'company_address'))?> <br>
											<?=ucfirst($this->applib->company_details($inv->client,'city'))?> ,
											<?=ucfirst($this->applib->company_details($inv->client,'country'))?> <br>
											<?=lang('vat')?> : <?=ucfirst($this->applib->company_details($inv->client,'VAT'))?> <br>
										</div>
										<div class="col-xs-6 text-right">
											<p class="h4"><?=$inv->reference_no?></p>
											<p class="m-t m-b">
											<?=lang('invoice_date')?>: <strong><?=strftime("%b %d, %Y", strtotime($inv->date_saved));?></strong><br>
											<?=lang('due_date')?>: <strong><?=strftime("%b %d, %Y", strtotime($inv->due_date));?></strong><br>
										
											<?=lang('payment_status')?>: <span class="label bg-dark"><?=$payment_status?> </span><br>
											</p>
										</div>
									</div>
									
									<div class="line"></div>
									<table class="table"><thead>
										<tr>
											<th width="50%"><?=lang('description')?> </th>
											<th width="10%"><?=lang('qty')?> </th>
											<th width="20%"><?=lang('unit_price')?> </th>
											<th width="30%"><?=lang('total')?> </th>
										</tr> </thead> <tbody>
										<?php
										if (!empty($invoice_items)) {
										foreach ($invoice_items as $key => $item) { ?>
										<tr>
											<td><?=$item->item_desc?> </td>
											<td><?=$item->quantity?></td>
											<td><?=number_format($item->unit_cost,2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?></td>
											<td><?=number_format($item->total_cost,2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?>
												<a class="hidden-print" href="<?=base_url()?>invoices/manage/delete_item/<?=$item->item_id?>/<?=$item->invoice_id?>" data-toggle="ajaxModal"><i class="fa fa-trash-o text-danger"></i></a></td>
											</tr>
											<?php } } ?>
											<tr class="hidden-print">
												<?php
												$attributes = array('class' => 'bs-example form-horizontal');
												echo form_open(base_url().'invoices/manage/item', $attributes); ?>
												<input type="hidden" name="invoice_id" value="<?=$inv->inv_id?>">
												<td> <input type="text" name="item_desc" placeholder="Item Description" class="form-control"></td>
												<td><input type="text" name="quantity" placeholder="1" class="form-control"></td>
												<td><input type="text" name="unit_cost" placeholder="50" class="form-control"></td>
												<td><button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> <?=lang('save')?></button></td>
											</form>
										</tr>
										<?php
										$inv_tax = $inv->tax;
										$invoice_cost = $this->user_profile->invoice_payable($inv->inv_id);
										$payment_made = $this->user_profile->invoice_payment($inv->inv_id);
										$tax = ($inv_tax/100) * $invoice_cost;
										?>
										<tr>
											<td colspan="3" class="text-right no-border"><strong><?=lang('sub_total')?></strong></td>
											<td> <?=number_format($invoice_cost,2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?></td>
										</tr>
										<tr>
											<td colspan="3" class="text-right no-border"><strong><?=lang('tax')?> - <?php echo $inv->tax?$inv->tax:$this->config->item('default_tax');?>%</strong></td>
											<td><?=number_format($tax,2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?> </td>
										</tr>
										<tr>
											<td colspan="3" class="text-right no-border"><strong><?=lang('payment_made')?></strong></td>
											<td><?=number_format($payment_made,2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?> </td>
										</tr>
										<tr>
											<td colspan="3" class="text-right no-border"><strong><?=lang('total')?></strong></td>
											<td><?=$inv->currency?> <?=number_format(($invoice_cost + $tax) - $payment_made,2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?></td>
										</tr>
									</tbody>
								</table>
							</section>
							<p><?=$inv->notes?></p>
							<?php } } ?>
							<!-- End display details -->
						</section>
						</section> </aside> </section> <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> </section>
						<!-- end -->