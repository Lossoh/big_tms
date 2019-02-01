<section id="content">
	<section class="hbox stretch">	
		
		<aside>
			<section class="vbox">
				<header class="header bg-white b-b clearfix hidden-print">
					<div class="row m-t-sm">
						<div class="col-sm-8 m-b-xs">
						
						<div class="btn-group">
						<button class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
						<?=lang('more_actions')?>
						<span class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="<?=base_url()?>orders/manage/addsjk/<?=$this->uri->segment(4)?>"><?=lang('addsjk')?></a></li>

								
						</ul>
						</div>	
						<div class="btn-group">
			

					
							<select id="filter_client_id" name="filter_client_id" class="form-control">
							<optgroup label="Client"> 
							<option value="0">ALL CLIENTS</option>
							<?php foreach ($filter_by_clients as $filter_by_client): ?>
							<option value="<?php echo $filter_by_client->client_id?>" <?php if($this->session->userdata('filter_client_id')==$filter_by_client->client_id){echo "selected";}?>><?php echo $filter_by_client->client_name?></option>
							<?php endforeach; ?>
						
							</optgroup> 
							</select> 

						</div>
						</div>
						<div class="col-sm-4 m-b-xs pull-right">
							<a href="#subNav" data-toggle="class:show" class="btn btn-sm green pull-right" id="order_list"><i class="fa fa-plus"></i> <?=lang('choose_order_plan')?></a>
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
								<th><?=lang('sj_ref')?></th>
								<th><?=lang('delivery_netto')?></th>
								<th><?=lang('receipt_netto')?></th>
								<th><?=lang('driver_name')?></th>
								<th><?=lang('truck_name')?></th>
								<th><?=lang('username')?></th>
								<th><?=lang('options')?></th>
							  </tr> </thead> 
							  <tbody>
								  <?php
								  if (!empty($sjk_order_lists)) {
								  foreach ($sjk_order_lists as $sjk_order_list) { ?>
								  <tr>									
									<td><?=$sjk_order_list->sj_ref?></a></td>							  
									<td><?=number_format($sjk_order_list->qty_bulk_delivery_netto,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?></td>				
									<td><?=number_format($sjk_order_list->qty_bulk_receipt_netto,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?></td>
									<td><?=$sjk_order_list->driver_name?></td>							  
									<td><?=$sjk_order_list->truck_name?></td>
									<td><?=$sjk_order_list->username?></td>										
									<td>
										
										<?php if(empty($sjk_order_list->barcode_id)){?>
										<a href="<?=base_url()?>orders/manage/editsjk/<?=$sjk_order_list->sj_id?>" class="btn btn-default btn-xs" title="<?=lang('edit')?>"><i class="fa fa-edit fa-lg"></i> </a>
										<?php }?>
										<a href="<?=base_url()?>orders/manage/deletesjk/<?=$sjk_order_list->sj_id?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('delete')?>"><i class="fa fa-trash-o fa-lg"></i></a>									

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


			</section> 
		</aside>
		
		<aside class="aside-xxlg bg-white b-l hide" id="subNav">

		<header class="dk header b-b">

		<p class="h4"><?=lang('all_orderofvessel')?></p>
		
		
		</header>
		<section class="vbox">
			<section class="scrollable w-f">
			   <div id="detail_client_order_list" ></div>
			</section>
		</section>
		</aside> 		




		
	</section> 
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>


<!-- end -->