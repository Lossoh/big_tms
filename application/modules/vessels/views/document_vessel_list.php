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
							<section class="panel panel-default">
							<div class="table-responsive"><?php echo validation_errors(); ?>
							<table id="tbl-projects" class="table table-striped table-hover b-t b-light text-sm">
							<thead>
							  <tr>
								<th><?=lang('party_name')?></th>
								<th><?=lang('po_ref')?></th>
								<th><?=lang('client_name')?></th>
								<th><?=lang('item_type')?></th>
								<th><?=lang('qty_document')?></th>
								<th><?=lang('qty_unload')?></th>
								<th><?=lang('options')?></th>
							  </tr> </thead> 
							  <tbody>
								  <?php
								  if (!empty($document_details)) {
								  foreach ($document_details as $document_detail) { ?>
								  <tr>									
									<td><?=$document_detail->party_name?></a></td>
									<td><?=$document_detail->po_ref?></td>
									<td><?=$document_detail->client_name?></td>								  
									<td><?=$document_detail->item_type?></td>
									<td class="text-right"><?=number_format($document_detail->qty_po,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?> Kgs</td>							  
									<td class="text-right"><?php echo number_format($this->AppModel->sum_item('trx_sj',$array=array('deleted' => 0, 'document_id' => $document_detail->document_id), 'qty_bulk_delivery_netto'),0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?>Kgs
									</td>
									<td>
										<?php if (!$this->vessel->check_key($table='trx_document_separate',$array = array('document_id' => $document_detail->document_id))){?>
										
										<a href="<?=base_url()?>vessels/manage/document_vessel_edit/<?=$document_detail->document_id?>" class="btn btn-default btn-xs" title="<?=lang('edit')?>"><i class="fa fa-edit"></i> </a>
										<a href="<?=base_url()?>vessels/manage/delete_party/<?=$document_detail->document_id?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('delete')?>"><i class="fa fa-trash-o"></i></a>									

										<?php }?>
										<a href="<?=base_url()?>vessels/manage/document_vessel_separate/<?=$document_detail->document_id?>" class="btn btn-default btn-xs" title="<?=lang('destinations')?>"><i class="fa fa-road fa-lg"></i></a>
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


<!-- end -->