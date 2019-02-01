<section id="content">
	<section class="hbox stretch">	

		<aside>
			<section class="vbox">
				<header class="header bg-white b-b clearfix hidden-print">
							
			<a href="#subNav" data-toggle="class:show" class="btn btn-sm green pull-right" id="vessel_active"><i class="fa fa-spinner fa-spin"></i> <?=lang('choose_vessel_active')?></a>
					<div class="row m-t-sm">
						<div class="col-sm-8 m-b-xs">					
					<?php 
						if (!empty($vessel_details)) {
						foreach ($vessel_details as $key => $vessel_detail) { ?>		
						
						
						<div class="btn-group">
						<button class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
						<?=lang('more_actions')?>
						<span class="caret"></span></button>
						<ul class="dropdown-menu">
	
							<li><a href="<?=base_url()?>vessels/manage/edit/<?=$vessel_detail->vessel_id?>"><?=lang('edit_vessel')?></a></li>
							<li><a href="<?=base_url()?>vessels/manage/delete/<?=$vessel_detail->vessel_id?>" data-toggle="ajaxModal"><?=lang('delete_vessel')?></a></li>
							<li><a href="<?=base_url()?>vessels/manage/details/<?=$vessel_detail->vessel_id?>"><?=lang('palka_list')?></a></li>	
							<li><a href="<?=base_url()?>vessels/manage/unload_receipt_list/<?=$vessel_detail->vessel_id?>"><?=lang('unload_receipt_list')?></a></li>											
							<li><a href="<?=base_url()?>vessels/manage/document_vessel/<?=$vessel_detail->vessel_id?>"><?=lang('document_vessel')?></a></li>							
							<li><a href="<?=base_url()?>vessels/manage/document_vessel_list/<?=$vessel_detail->vessel_id?>"><?=lang('list_document_vessel')?></a></li>			
							<li><a href="<?=base_url()?>vessels/manage/memo_list/<?=$vessel_detail->vessel_id?>"><?=lang('memo_list')?></a></li>	

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
							<div class="col-lg-12">
							<a href="<?=base_url()?>vessels/manage/add_unload_receipt/<?=$vessel_detail->vessel_id?>" class="btn btn-xs btn-info pull-right" data-toggle="ajaxModal"><i class="fa fa-plus"></i> <?=lang('add_unload_receipt')?></a>
							<p class="h4"><strong><?=lang('unload_receipt_list')?> - <?=$vessel_detail->vessel_init?> - <?=$vessel_detail->vessel_name?></strong></p>

							<section class="panel panel-default">
							
							<div class="table-responsive"><?php echo validation_errors(); ?>
							<table id="tbl-projects" class="table table-striped table-hover b-t b-light text-sm">
							<thead>
							  <tr>
								<th><?=lang('unload_receipt_ref')?></th>
								<th><?=lang('date_time')?></th>
								<th><?=lang('truck_name')?></th>
								<th><?=lang('truck_type')?></th>
								<th><?=lang('transporter_name')?></th>
								<th><?=lang('driver_name')?></th>
								<th><?=lang('expired_date')?></th>
								<th><?=lang('username')?></th>
								<th><?=lang('sj_ref')?></th>
								<th><?=lang('options')?></th>
							  </tr> </thead> 
							  <tbody>
								  <?php
								  if (!empty($unload_receipt_lists)) {
								  foreach ($unload_receipt_lists as $unload_receipt_list) { ?>
								  <tr>									
									<td><?=$unload_receipt_list->unload_receipt_ref?></a></td>
									<td><?=strftime("%d %b %Y", strtotime($unload_receipt_list->unload_receipt_date))?> <?=$unload_receipt_list->unload_receipt_time?></td>
									<td><?=$unload_receipt_list->truck_name?></td>
									<td><?=$unload_receipt_list->Nm_Ref?></td>
									<td><?=$unload_receipt_list->transporter_name?></td>
									<td><?=$unload_receipt_list->driver_name?></td>
									<td><?=strftime("%d %b %Y", strtotime($unload_receipt_list->expired_date))?></td>
									<td><?=$unload_receipt_list->username?></td>
									<td><?=$unload_receipt_list->sj_ref?></td>
									<td>
									<a href="<?=base_url()?>vessels/manage/edit_unload_receipt/<?=$unload_receipt_list->unload_receipt_id?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('edit')?>"><i class="fa fa-edit"></i></a>
									<a href="<?=base_url()?>vessels/manage/delete_unload_receipt/<?=$unload_receipt_list->unload_receipt_id?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('delete')?>"><i class="fa fa-trash-o"></i></a>
									<a href="<?=base_url()?>vessels/manage/reprint_unload_receipt/<?=$unload_receipt_list->unload_receipt_id?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('reprint')?>"><i class="fa fa-print"></i></a>
									 </td>
								</tr>
								<?php } } ?>
                    
                    
								</tbody>
							</table>

							</div>
							</section>            
							</div>
							
						</div>
				

					

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