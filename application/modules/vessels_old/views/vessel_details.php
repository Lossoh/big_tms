<section id="content">
	<section class="hbox stretch">	
		<aside>
			<section class="vbox">
				<header class="header bg-white b-b clearfix hidden-print">
					<a href="#subNav" data-toggle="class:show" class="btn btn-sm green pull-right" id="vessel_active"><i class="fa fa-spinner fa-spin"></i> <?=lang('choose_vessel_active')?></a>
					<div class="row m-t-sm">
						<?php 
						if (!empty($vessel_details)) {
						foreach ($vessel_details as $key => $vessel) { ?>	
						<div class="col-sm-8 m-b-xs">						
						<div class="btn-group">
						
						</div>					
						
						
						<div class="btn-group">
						<button class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
						<?=lang('more_actions')?>
						<span class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="<?=base_url()?>vessels/manage/edit/<?=$vessel->vessel_id?>"><?=lang('edit_vessel')?></a></li>
							<li><a href="<?=base_url()?>vessels/manage/delete/<?=$vessel->vessel_id?>" data-toggle="ajaxModal"><?=lang('delete_vessel')?></a></li>
							<li><a href="<?=base_url()?>vessels/manage/details/<?=$vessel->vessel_id?>"><?=lang('palka_list')?></a></li>	
							<li><a href="<?=base_url()?>vessels/manage/unload_receipt_list/<?=$vessel->vessel_id?>"><?=lang('unload_receipt_list')?></a></li>											
							<li><a href="<?=base_url()?>vessels/manage/document_vessel/<?=$vessel->vessel_id?>"><?=lang('document_vessel')?></a></li>							
							<li><a href="<?=base_url()?>vessels/manage/document_vessel_list/<?=$vessel->vessel_id?>"><?=lang('list_document_vessel')?></a></li>			
							<li><a href="<?=base_url()?>vessels/manage/memo_list/<?=$vessel->vessel_id?>"><?=lang('memo_list')?></a></li>			
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
	
					<center><p class="h3"><strong><?=$vessel->vessel_ref?> - <?=$vessel->vessel_name?></strong></p></center>

				
								
								
							
								
							<center><p class="h5"><strong>PALKA DETAILS</strong></p></center>
							
							
						</div>
				
					<div class="line"></div>
					<table class="table" width="100%">
					<thead>
					<tr>
					<th width="20%"><?=lang('palka_name')?> </th>
					<th width="35%"><?=lang('item_id')?> </th>					
					<th width="15%"><?=lang('total_item_document')?> </th>
					<th width="15%"><?=lang('total_item_unload')?> </th>
					<th width="15%"><?=lang('total_difference')?> </th>
					<th><?=lang('options')?> </th>
					</tr> 
					</thead>
					<tbody>
					<?php
					if (!empty($vessel_items)) {
					foreach ($vessel_items as $key => $vessel_item) { ?>
					<tr>
						<td width="20%"><?=$vessel_item->palka_id?> </td>
						<td width="35%"><?=$vessel_item->item_name?></td>
						<td width="15%" class="text-right"><?=number_format($vessel_item->ttl_item,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?></td>
						<td width="15%" class="text-right"><?=number_format($this->vessel->sum_item($table='trx_sj',$array = array('vessel_id' => $this->uri->segment(4), 'palka_id' => $vessel_item->palka_id, 'deleted' => 0),'qty_bulk_delivery_netto'),0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?></td>
						<td width="15%" class="text-right"><?=number_format($vessel_item->ttl_item-$this->vessel->sum_item($table='trx_sj',$array = array('vessel_id' => $this->uri->segment(4), 'palka_id' => $vessel_item->palka_id, 'deleted' => 0),'qty_bulk_delivery_netto'),0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?>
						<input type="hidden" name="ttl" value="<?=$total=$total+$vessel_item->ttl_item-$vessel_item->ttl_unload_item?>">
						
						
						</td>
						<td>
						
						<a href="<?=base_url()?>vessels/manage/edit_palka/<?=$vessel_item->palka_id?>/<?=$vessel_item->vessel_id?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('edit')?>"><i class="fa fa-edit"></i> </a>
						<?php if($vessel_item->ttl_unload_item == 0){?>
						
							<a href="<?=base_url()?>vessels/manage/delete_palka/<?=$vessel_item->palka_id?>/<?=$vessel_item->vessel_id?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('delete')?>"><i class="fa fa-trash-o text-danger"></i></a>
						<?php } ?>
						
						
						
						</td>
						
					</tr>
					
					
					
					<?php } } ?>
					
						<tr><td></td><td></td><td class="text-right"><?=number_format($item_sum,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?></td><td class="text-right"><?=number_format($total_item_vessel,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?></td><td class="text-right"><?=number_format($item_sum-$total_item_vessel,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?></td></tr>
						<tr>
						
						<?php     
							$attributes = array('class' => 'bs-example form-horizontal');
							echo form_open(base_url().'vessels/manage/item', $attributes); ?>
							<input type="hidden" name="vessel_id" value="<?=$vessel->vessel_id?> ">
							<td width="30%">
								<select style="width:135px;height:32px"  name="palka_id" class="form-control"> 
									<option value="1">Palka One</option>
									<option value="2">Palka Two</option>
									<option value="3">Palka Third</option>
									<option value="4">Palka Four</option>
									<option value="5">Palka Fifth</option>
									<option value="6">Palka Six</option>
									<option value="7">Palka Seven</option>
									<option value="8">Palka Eight</option>
									<option value="9">Palka Nine</option>
									<option value="10">Palka Ten</option>
								</select>
							</td>
							<td width="35%" >
								<select id="select2-option" style="width:300px;height:32px" name="item_id" required>		          
								<optgroup label="Items"> 
								<?php foreach ($items as $item): ?>
								<option value="<?=$item->item_id?>"><?=$item->item_name?></option>
								<?php endforeach; ?>
								</select> 
							</td>
							<td width="35%">
								<input style="height:32px" type="text" name="ttl_item" placeholder="Input total of item on palka" class="form-control">
							</td> 					
							<td><button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> <?=lang('save')?></button></td>
							</form>
						</tr>


					</tbody>
					</table>
					</section> 					
					<?php } } ?>
					</section>  




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