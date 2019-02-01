<section id="content">
	<section class="hbox stretch">			
		<aside>
			<section class="vbox">
				<header class="header bg-white b-b clearfix hidden-print">
					<div class="row m-t-sm">
						<div class="col-sm-8 m-b-xs">	
						<div class="btn-group">
						</div>
						</div>
						<div class="col-sm-4 m-b-xs pull-right">
						</div>
					</div> 
				</header>
									
				<section class="scrollable wrapper w-f">
					<section class="scrollable wrapper">
						<div class="row"> 
							<div class="col-lg-12">
							<p class="text-danger"> <strong>The page will be refresh left at  <span id="countdown">30</span> seconds.</strong></p>
							<section class="panel panel-default">
							<div class="table-responsive"><?php echo validation_errors(); ?>
							<table id="tbl-projects" class="table table-striped table-hover b-t b-light text-sm">
							<thead>
							  <tr>
								<th><?=lang('sj_ref')?></th>
								<th><?=lang('sj_date')?></th>
								<th><?=lang('sj_time')?></th>
								<th><?=lang('delivery_netto')?></th>
								<th><?=lang('receipt_netto')?></th>
								<th><?=lang('driver_name')?></th>
								<th><?=lang('truck_name')?></th>
								<th><?=lang('username')?></th>
								<th><?=lang('options')?></th>
							  </tr> </thead> 
							  <tbody>
								  <?php
								  if (!empty($delivery_order_barcodes)) {
								  foreach ($delivery_order_barcodes as $delivery_order_barcode) { ?>
								  <tr>									
									<td><?=$delivery_order_barcode->sj_ref?></a></td>
									<td><?=$delivery_order_barcode->sj_date?></td>
									<td><?=$delivery_order_barcode->sj_time?></td>								  
									<td><?=number_format($delivery_order_barcode->qty_bulk_delivery_netto,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?></td>				
									<td><?=number_format($delivery_order_barcode->qty_bulk_receipt_netto,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?></td>
									<td><?=$delivery_order_barcode->driver_name?></td>							  
									<td><?=$delivery_order_barcode->truck_name?></td>
									<td><?=$delivery_order_barcode->username?></td>										
									<td>
										<a href="<?=base_url()?>orders/addbarcode/<?=$delivery_order_barcode->sj_id?>" class="btn btn-default btn-xs" title="<?=lang('add_barcode')?>"><i class="fa fa-barcode fa-lg"></i></a>
										<a href="<?=base_url()?>orders/manage/verifybarcode/<?=$delivery_order_barcode->sj_id?>" class="btn btn-default btn-xs" title="<?=lang('verify_barcode')?>"><i class="fa fa-flag-checkered fa-lg"></i></a>

										
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
			




		
	</section> 
		<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> 
</section>


<!-- end -->