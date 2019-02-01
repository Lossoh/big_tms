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

					if ($estimate->invoiced == 'Yes') {	$est_status = 'INVOICED'; $label = 'success'; }elseif ($estimate->emailed == 'Yes' AND $estimate->status == 'Pending') {
					$est_status = 'SENT'; $label = 'info';	}elseif ($estimate->status != 'Pending') { 
						$est_status = strtoupper($estimate->status); $label = 'primary'; } else{	$est_status = 'DRAFT'; $label = 'default';	}
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
			<a data-original-title="<?=lang('print_estimate')?>" data-toggle="tooltip" data-placement="bottom" href="#" class="btn btn-sm btn-info" onClick="window.print();">
					<i class="fa fa-print"></i> </a> 

						<a data-original-title="<?=lang('edit_estimate')?>" data-toggle="tooltip" data-placement="bottom" class="btn btn-sm btn-dark" href="<?=base_url()?>estimates/manage/edit/<?=$estimate->est_id?>/<?=$estimate->reference_no?>" title="<?=lang('edit_estimate')?>"><i class="fa fa-pencil"></i></a>

						<a data-original-title="<?=lang('convert_to_invoice')?>" data-toggle="tooltip" data-placement="bottom" class="btn btn-sm btn-success <?php if($estimate->invoiced == 'Yes' OR $estimate->client == '0'){ echo "disabled"; } ?>" href="<?=base_url()?>estimates/action/convert/<?=$estimate->est_id?>/<?=$estimate->reference_no?>" data-toggle="ajaxModal"
						 title="<?=lang('convert_to_invoice')?>">
						<?=lang('convert_to_invoice')?></a>				

						<div class="btn-group">
						<button class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
						<?=lang('more_actions')?>
						<span class="caret"></span></button>
						<ul class="dropdown-menu">
								<li><a href="<?=base_url()?>estimates/action/emailestimate/<?=$estimate->est_id?>/<?=$estimate->reference_no?>" data-toggle="ajaxModal"><?=lang('email_estimate')?></a></li>
								<li><a href="<?=base_url()?>estimates/manage/timeline/<?=$estimate->est_id?>/<?=$estimate->reference_no?>"><?=lang('estimate_history')?></a></li>
								<?php
								if ($estimate->emailed == 'Yes' AND $estimate->invoiced == 'No') { ?>
								<li><a href="<?=base_url()?>estimates/action/status/declined/<?=$estimate->est_id?>/<?=$estimate->reference_no?>"><?=lang('mark_as_declined')?></a></li>
								<li><a href="<?=base_url()?>estimates/action/status/accepted/<?=$estimate->est_id?>/<?=$estimate->reference_no?>"><?=lang('mark_as_accepted')?></a></li>
								<?php } ?>
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
					
					<section class="scrollable wrapper w-f">
					<!-- Start Display Details -->
					 <?php
				if(!$this->session->flashdata('message')){
						if(strtotime($estimate->due_date) < time() AND $estimate->invoiced == 'No'){ ?>
						<div class="alert alert-info hidden-print"> 
						<button type="button" class="close" data-dismiss="alert">×</button> <i class="fa fa-warning"></i>
						<?=lang('estimate_overdue')?>
						</div>

    <?php } } ?> 

					<section class="scrollable wrapper">

					<div class="row"> 
					<?php
					if ($estimate->invoiced == 'Yes') {	$est_status = 'INVOICED'; $label = 'success'; }elseif ($estimate->emailed == 'Yes' AND $estimate->status == 'Pending') {
					$est_status = 'SENT'; $label = 'info';	}elseif ($estimate->status != 'Pending') { 
						$est_status = strtoupper($estimate->status); $label = 'primary'; } else{	$est_status = 'DRAFT'; $label = 'dark';	}
					?>

					<div class="col-xs-6"> 
					<p class="h4"><strong><?=$this->config->item('company_name')?></strong></p>
						
						<?=$this->config->item('company_address')?><br>
						<?=$this->config->item('company_city')?><br>
						<?=$this->config->item('company_country')?><br>
						<?=lang('phone')?>: <?=$this->config->item('company_phone')?> <br>
						<p class="h4"><strong><?=lang('bill_to')?>:</strong></p>
								<?php
				if ($estimate->client != '0') { ?>			
						<?=ucfirst($this->applib->company_details($estimate->client,'company_name'))?> <br>
						<?=ucfirst($this->applib->company_details($estimate->client,'company_address'))?> <br>
						<?=ucfirst($this->applib->company_details($estimate->client,'city'))?> ,
						<?=ucfirst($this->applib->company_details($estimate->client,'country'))?> <br>
						<?=lang('vat')?> : <?=ucfirst($this->applib->company_details($estimate->client,'VAT'))?> <br>
						<?php } ?>
						</div>
						<div class="col-xs-6 text-right">
						<p class="h4"><?=$estimate->reference_no?></p> 
						<p class="m-t m-b">
					<?=lang('estimate_date')?>: <strong><?=strftime("%b %d, %Y", strtotime($estimate->date_saved));?></strong><br>
					<?=lang('expiry_date')?>: <strong><?=strftime("%b %d, %Y", strtotime($estimate->due_date));?></strong><br> 
					<?=lang('estimate_status')?>: <span class="label bg-<?=$label?>"><?=$est_status?> </span><br>
					
					</p> 
						</div>
					</div>

					
					<div class="line"></div>
					<table class="table"><thead>
					<tr>
					<th><?=lang('description')?> </th>
					<th width="60"><?=lang('qty')?> </th>					
					<th width="140"><?=lang('unit_price')?> </th>
					<th width="90"><?=lang('total')?> </th>
					</tr> </thead> <tbody>
					<?php
					if (!empty($estimate_items)) {
					foreach ($estimate_items as $key => $item) { ?>
					<tr>
						<td><?=$item->item_desc?> </td>
						<td><?=$item->quantity?></td> 						
						<td><?=$this->config->item('default_currency_symbol')?> <?=number_format($item->unit_cost,2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?></td>
						<td><?=$this->config->item('default_currency_symbol')?> <?=number_format($item->total_cost,2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?>
						<a class="hidden-print" href="<?=base_url()?>estimates/manage/delete_item/<?=$item->item_id?>/<?=$item->estimate_id?>" data-toggle="ajaxModal"><i class="fa fa-trash-o text-danger"></i></a></td>
					</tr>
					<?php } } ?>
					<tr class="hidden-print">
					<?php     
$attributes = array('class' => 'bs-example form-horizontal');
echo form_open(base_url().'estimates/manage/item', $attributes); ?>
<input type="hidden" name="estimate_id" value="<?=$estimate->est_id?>">
						<td><input type="text" name="item_desc" placeholder="Item Description" class="form-control"></td>
						<td><input type="text" name="quantity" placeholder="1" class="form-control"></td> 					
						<td><input type="text" name="unit_cost" placeholder="50" class="form-control"></td>
						<td><button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> <?=lang('save')?></button></td>
						</form>
					</tr>
					<?php
					$est_tax = $estimate->tax;
					$estimate_cost = $this->user_profile->estimate_payable($estimate->est_id);
					$tax = ($est_tax/100) * $estimate_cost;
					?>
					<tr>
						<td colspan="3" class="text-right"><strong><?=lang('sub_total')?></strong></td>
						<td><?=$this->config->item('default_currency_symbol')?> <?=number_format($estimate_cost,2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?></td>
					</tr>
					<tr>
						<td colspan="3" class="text-right no-border"><strong><?=lang('tax')?></strong></td>
						<td><?=$this->config->item('default_currency_symbol')?> <?=number_format($tax,2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?> </td>
					</tr>
					<tr>
					<td colspan="3" class="text-right no-border"><strong><?=lang('total')?></strong></td>
					<td><strong><?=$this->config->item('default_currency_symbol')?> <?=number_format($estimate_cost+$tax,2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?></strong></td>
					</tr>
					</tbody>
					</table>
					</section> 


					<p><?=$estimate->notes?></p>


					<?php } } ?>


					 <!-- End display details -->






					</section>  




		</section> </aside> </section> <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> </section>



<!-- end -->