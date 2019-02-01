<section id="content">
	<section class="hbox stretch">	
		<aside class="aside-md bg-white b-r hidden-print" id="subNav">

			<header class="dk header b-b">
			
			<div class="btn-group pull-right">
				<button class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"><?=lang('filter')?>
				<span class="caret"></span>
				</button>
				<ul class="dropdown-menu">	
				<li><a href="<?=base_url()?>vessels/view_by_status/">ALL</a></li>
				<?php foreach ($vessel_status as $status): ?>
					<li><a href="<?=base_url()?><?=$status->Kondisi_Ref_Char_02?><?=$status->No_Urut_Ref?>"><?=lang($status->Kondisi_Ref_Char_03)?></a></li>
				<?php endforeach; ?>
				
				</ul>
			</div>
			
			<a href="<?=base_url()?>vessels/manage/add" data-original-title="<?=lang('create_vessel')?>" data-toggle="tooltip" data-placement="bottom" class="btn btn-icon btn-default btn-sm pull-right"><i class="fa fa-plus"></i></a>
			<p class="h4"><?=lang('all_vessels')?></p>
			</header>
			
			<section class="vbox">
			 <section class="scrollable w-f">
			   <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
				<ul class="nav">
				<?php 
				if (!empty($vessels)) {
				foreach ($vessels as $key => $vessel) { ?>		
					<li class="b-b b-light <?php if($vessel->vessel_id == $this->uri->segment(4)){ echo "bg-light dk"; } ?>"><a href="<?=base_url()?>vessels/manage/details/<?=$vessel->vessel_id?>">
					<?=$vessel->vessel_ref?> - <?=$vessel->vessel_name?>
					<div class="pull-right">
					<span class="label label-<?=$vessel->Kondisi_Ref_Char_01?>"><?=$vessel->Nm_Ref?></span>
					</div> <br>
					<small class="block small text-muted"><?=$vessel->vessel_init?> | <?=strftime("%b %d, %Y", strtotime($vessel->date_created));?></small>

				</a> </li>
				<?php } } ?>
				</ul> 
				</div>
			</section>
			</section>
		</aside> 
			
		<aside>
			<section class="vbox">
				<header class="header bg-white b-b clearfix hidden-print">
					<div class="row m-t-sm">
						<?php 
						if (!empty($vessel_details)) {
						foreach ($vessel_details as $key => $vessel) { ?>	
						<div class="col-sm-8 m-b-xs">
						
						
						
						<div class="btn-group">
						<button class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"><?=lang('set_status')?>
						<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
						
						<?php foreach ($vessel_status as $status): ?>
							<li><a href="<?=base_url()?><?=$status->Kondisi_Ref_Char_04?><?=$status->No_Urut_Ref?>/<?=$vessel->vessel_id?>"><?=lang($status->Kondisi_Ref_Char_03)?></a></li>
						<?php endforeach; ?>						
						</ul>
						</div>					
						
						
						<div class="btn-group">
						<button class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
						<?=lang('more_actions')?>
						<span class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="<?=base_url()?>vessels/manage/edit/<?=$vessel->vessel_id?>"><?=lang('edit_vessel')?></a></li>
							<li><a href="<?=base_url()?>vessels/manage/delete/<?=$vessel->vessel_id?>" data-toggle="ajaxModal"><?=lang('delete_vessel')?></a></li>
											
							<li><a href="<?=base_url()?>vessels/manage/document_vessel/<?=$vessel->vessel_id?>"><?=lang('document_vessel')?></a></li>
								
						</ul>
						</div>
						
						
						</div>
						<div class="col-sm-4 m-b-xs">
printing 
					
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
					<th width="15%"><?=lang('total_item_palka')?> </th>
					<th width="15%"><?=lang('total_item_unload')?> </th>
					<th width="10%"><?=lang('total_difference')?> </th>
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
						<td width="15%"><?=$vessel_item->ttl_item?></td>
						<td width="15%"><?=$vessel_item->ttl_unload_item?></td>
						<td width="10%"><?=$vessel_item->ttl_item-$vessel_item->ttl_unload_item?>
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
					
						<tr><td></td><td></td><td></td><td></td><td><?=$item_sum-$unload_item_sum?></td></tr>
						<tr>
						
						<?php     
							$attributes = array('class' => 'bs-example form-horizontal');
							echo form_open(base_url().'vessels/manage/item', $attributes); ?>
							<input type="hidden" name="vessel_id" value="<?=$vessel->vessel_id?> ">
							<td width="20%">
								<select style="height:30px"  name="palka_id" class="form-control"> 
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
								<select id="select2-option" style="width:300px" style="height:250px" name="item_id" required>		          
								<optgroup label="Items"> 
								<?php foreach ($items as $item): ?>
								<option value="<?=$item->item_id?>"><?=$item->item_name?></option>
								<?php endforeach; ?>
								</select> 
							</td>
							<td width="15%">
								<input style="height:30px" type="text" name="ttl_item" placeholder="Input total of item on palka" class="form-control">
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
	</section> 
		<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> 
</section>


<!-- end -->