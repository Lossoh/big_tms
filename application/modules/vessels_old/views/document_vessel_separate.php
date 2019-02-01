<section id="content">
	<section class="hbox stretch">	
		
		<aside>
			<section class="vbox">
				<header class="header bg-white b-b clearfix hidden-print">
					<a href="#subNav" data-toggle="class:show" class="btn btn-sm green pull-right" id="vessel_active"><i class="fa fa-spinner fa-spin"></i> <?=lang('choose_vessel_active')?></a>					
					<div class="row m-t-sm">
						<div class="col-sm-8 m-b-xs">					
						<?php 
						if (!empty($document_details)) {
						foreach ($document_details as $key => $doc_vessel) { ?>	
						
						<div class="btn-group">
						<button class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
						<?=lang('more_actions')?>
						<span class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="<?=base_url()?>vessels/manage/edit/<?=$doc_vessel->vessel_id?>"><?=lang('edit_vessel')?></a></li>
							<li><a href="<?=base_url()?>vessels/manage/delete/<?=$doc_vessel->vessel_id?>" data-toggle="ajaxModal"><?=lang('delete_vessel')?></a></li>
							<li><a href="<?=base_url()?>vessels/manage/details/<?=$doc_vessel->vessel_id?>"><?=lang('palka_list')?></a></li>								
							<li><a href="<?=base_url()?>vessels/manage/unload_receipt_list/<?=$doc_vessel->vessel_id?>"><?=lang('unload_receipt_list')?></a></li>											
							<li><a href="<?=base_url()?>vessels/manage/document_vessel/<?=$doc_vessel->vessel_id?>"><?=lang('document_vessel')?></a></li>							
							<li><a href="<?=base_url()?>vessels/manage/document_vessel_list/<?=$doc_vessel->vessel_id?>"><?=lang('list_document_vessel')?></a></li>			
							<li><a href="<?=base_url()?>vessels/manage/memo_list/<?=$doc_vessel->vessel_id?>"><?=lang('memo_list')?></a></li>	
								
						</ul>
						</div>
						
						
						</div>
						<div class="col-sm-4 m-b-xs">

					
						</div>
					</div> 
				</header>
				<section class="scrollable wrapper w-f">
					<section class="scrollable wrapper">
						<div class="row"> 
							<div class="col-xs-6">
								<div class="group">
									<h4 class="subheader text-muted"><?=lang('destination_details')?></h4>
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('vessel_name')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h5"><strong><?=$doc_vessel->vessel_ref?> - <?=$doc_vessel->vessel_name?></strong></p></div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('party_name')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h5"><strong><?=$doc_vessel->party_name?></strong></p></div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('po_ref')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h5"><strong><?=$doc_vessel->po_ref?></strong></p></div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('client_name')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-7"><p class="h5"><strong><?=$doc_vessel->client_name?></strong></p></div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('item_name')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-7"><p class="h5"><strong><?=$doc_vessel->item_name?></strong></p></div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('item_type')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-7"><p class="h5"><strong><?=$doc_vessel->item_type?></strong></p></div>
									</div>									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('shipping_name')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-7"><p class="h5"><strong><?=$doc_vessel->shipping_name?></strong></p></div>
									</div>
								</div>							
							</div>
							<div class="col-xs-6 text-left">
								<div class="group">
								<br><br>
								<div class="row inline-fields form-group form-md-line-input">
									<div class="col-md-4"><?=lang('vessel_status')?></div>
									<div class="col-md-1">:</div>
									<div class="col-md-2"><p class="h5"><strong><span class="label label-<?=$doc_vessel->vessel_color?>"><?=$doc_vessel->vessel_status?></span></strong></p></div>
								</div>
								<div class="row inline-fields form-group form-md-line-input">
									<div class="col-md-4"><?=lang('port_name')?></div>
									<div class="col-md-1">:</div>
									<div class="col-md-7"><p class="h5"><strong><?=$doc_vessel->port_name?></strong></p></div>
								</div>
								<div class="row inline-fields form-group form-md-line-input">
									<div class="col-md-4"><?=lang('po_date')?></div>
									<div class="col-md-1">:</div>
									<div class="col-md-4"><p class="h5"><strong><?=strftime("%b %d, %Y", strtotime($doc_vessel->po_date));?></strong></p></div>
								</div>									
								<div class="row inline-fields form-group form-md-line-input">
									<div class="col-md-4"><?=lang('bl/awb')?></div>
									<div class="col-md-1">:</div>
									<div class="col-md-2"><p class="h5"><strong><?=$doc_vessel->bl_doc?></strong></p></div>
								</div>	
								<div class="row inline-fields form-group form-md-line-input">
									<div class="col-md-4"><?=lang('total_item_po')?></div>
									<div class="col-md-1">:</div>
									<div class="col-md-2"><p class="h5"><strong><?=number_format($doc_vessel->qty_po,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?> Kgs</strong></p></div>
								</div><br>
								<div class="row inline-fields form-group form-md-line-input">
									<div class="col-md-4"><?=lang('steve_name')?></div>
									<div class="col-md-1">:</div>
									<div class="col-md-2"><p class="h5"><strong><?=$doc_vessel->stevedore_name?></strong></p></div>
								</div>								
								</div>
								
							</div>
						</div>
				
					<div class="line"></div>
					<table class="table" width="100%">
					<thead>
					<tr>
					<th width="14%"><?=lang('destination_name')?> </th>
					<th width="35%"><?=lang('destination_description')?> </th>					
					<th width="17%"><?=lang('qty_document')?> </th>
					<th width="17%"><?=lang('total_item_unload')?> </th>
					<th width="17%"><?=lang('remarks')?> </th>	
					<th width="17%"><?=lang('destination_status')?> </th>						
					<th></th>
					</tr> 
					</thead>
					<tbody>
					<?php
					if (!empty($destination_items)) {
					foreach ($destination_items as $key => $destination_item) { ?>
					<tr>
						<td width="14%"><b><?=$destination_item->destination_ref?></b>-/-<?=$destination_item->destination_name?> </td>
						<td width="35%"><?=$destination_item->destination_description?></td>
						<td width="17%" class="text-right"><?=number_format($destination_item->qty_destination,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?> Kgs</td>
						<td width="17%" class="text-right"><?php echo number_format($this->AppModel->sum_item('trx_sj',$array=array('deleted' => 0, 'document_separate_id' => $destination_item->document_separate_id), 'qty_bulk_delivery_netto'),0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?> Kgs</td>
						<td width="17%"><?=$destination_item->remarks?></td>
						<td width="17%"><?php if($destination_item->document_separate_status){echo "ACTIVATED";}else{echo "INACTIVATED";}?></td>						
						<td>
						<a href="<?=base_url()?>vessels/manage/edit_destination/<?=$destination_item->document_separate_id?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('edit')?>"><i class="fa fa-edit"></i> </a>
						<a href="<?=base_url()?>vessels/manage/change_status_destination/<?=$destination_item->document_separate_id?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('destination_status')?>"><i class="fa fa-tasks"></i></a>
						
						<?php if(!$this->AppModel->check_key('trx_sj',$array=array('deleted' => 0, 'document_separate_id' => $destination_item->document_separate_id))){ ?>
						<a href="<?=base_url()?>vessels/manage/delete_destination/<?=$destination_item->document_separate_id?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('delete')?>"><i class="fa fa-trash-o text-danger"></i></a>
						<?php }?>
						</td>
					</tr>
					
					
					
					<?php } } ?>
				
						<tr><td colspan="2">	
						<?php $percent_difference = ($this->AppModel->sum_item('trx_sj',$array=array('deleted' => 0, 'document_id' => $doc_vessel->document_id), 'qty_bulk_delivery_netto')/$total_item_destination)*100?>
						
						<div class="progress progress-xs progress-striped active">								
						<div class="progress-bar progress-bar-info" data-toggle="tooltip" data-original-title="<?=$percent_difference?>%" style="width:<?=$percent_difference?>%">
						</div>
						</div>
						</td><td></td><td class="text-right"><?=number_format($total_item_destination,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?> Kgs</td><td  class="text-right"><?php echo number_format($this->AppModel->sum_item('trx_sj',$array=array('deleted' => 0, 'document_id' => $doc_vessel->document_id), 'qty_bulk_delivery_netto'),0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?> Kgs</td><td class="text-right"><?php echo number_format($total_item_destination - $this->AppModel->sum_item('trx_sj',$array=array('deleted' => 0, 'document_id' => $doc_vessel->document_id), 'qty_bulk_delivery_netto'),0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?>Kgs</td></tr>
						<tr>
						
						<?php     
							$attributes = array('class' => 'bs-example form-horizontal');
							echo form_open(base_url().'vessels/manage/destination_details', $attributes); ?>
							<input type="hidden" name="document_id" value="<?=$doc_vessel->document_id?> ">

							<td width="14%" >
								<select id="select2-option" style="width:240px" style="height:250px" name="destination_id" required>		       
								<option value=""></option>								
								<optgroup label="Destinations"> 
								
								<?php foreach ($destinations as $destination): ?>
								<option value="<?=$destination->destination_id?>"><?=$destination->destination_ref?>-/-<?=$destination->destination_name?></option>
								<?php endforeach; ?>
								</select> 
							</td>
							<td width="35%">
								<textarea name="dest_desc" class="form-control" placeholder="<?=lang('destination_description')?>"required></textarea>
							</td> 
							<td width="17%">
								<input style="height:30px" type="text" name="destination_qty" placeholder="Input Quantity" class="form-control">
							</td> 	
							<td width="17%">
								<textarea name="remarks" class="form-control" placeholder="<?=lang('remarks')?>" required></textarea>
							</td> 							
							<td><button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> <?=lang('save')?></button></td>
							</form>
						</tr>


					</tbody>
					</table>
					

					</section> 
										
				</section>  
<?php } } ?>	

			</section> 
		</aside>
		<aside class="aside-xl bg-white b-l hide" id="subNav">

			<header class="dk header b-b">

			<div class="btn-group pull-right">


			</div>

			<p class="h4"><?=lang('vessel_actived')?></p>
			</header>
			
			<section class="vbox">
			<section class="scrollable w-f">
			<div id="vessel_active_list" ></div>
			</section>
			</section>
		</aside> 			




		
	</section> 
		<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> 
</section>


<!-- end -->