<section id="content">
	<section class="hbox stretch">	
		<aside>
			<section class="vbox">
				<header class="header bg-white b-b clearfix">
					<div class="row m-t-sm">
					

						<div class="col-sm-4 m-b-xs"><?php 
						if (!empty($recap_document_headers)) {
						foreach ($recap_document_headers  as $recap_document_header) { ?>							
							<div class="btn-group">
							<button class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
							<?=lang('more_actions')?>
							<span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="<?=base_url()?>orders/manage/editrecapdocument/<?=$recap_document_header->recap_id?>"><?=lang('edit_recap_document')?></a></li>
								<li><a href="<?=base_url()?>orders/manage/deleterecapdocument/<?=$recap_document_header->recap_id?>" data-toggle="ajaxModal"><?=lang('delete_recap_document')?></a></li>			
							</ul>
							</div>

						</div>
					</div> 
				</header>
				<section class="scrollable padder w-f">
					<section class="scrollable padder bg-white">
						<div class="row m-t-sm"> 
							<h5><strong><?=lang('recap_document_details')?></strong></h5>
							<div class="line"></div>
							<div class="col-xs-6">
								<div class="group">									
									<div class="row inline-fields form-group form-md-line-input">
										<input type="hidden" name="recap_id" id="recap_id" value="<?=$recap_document_header->recap_id?> ">
										<input type="hidden" name="recap_no" id="recap_no" value="<?=$recap_document_header->recap_no?> ">

										<div class="col-md-4"><?=lang('recap_document_no')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h5"><strong><?=$recap_document_header->recap_no?></strong></p></div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('receipt_date')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-7"><p class="h5"><strong><?=strftime("%d %b %Y", strtotime($recap_document_header->recap_receipt_date))?></strong></p></div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('due_date')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-7"><p class="h5"><strong><?=strftime("%d %b %Y", strtotime($recap_document_header->recap_due_date))?></strong></p></div>
									</div>
									<br>
									
								</div>							
							</div>
									<div class="col-xs-6">
								<div class="group">									
									<div class="row inline-fields form-group form-md-line-input">
										<input type="hidden" name="recap_id" id="recap_id" value="<?=$recap_document_header->recap_id?> ">
										<input type="hidden" name="recap_no" id="recap_no" value="<?=$recap_document_header->recap_no?> ">

										<div class="col-md-4"><?=lang('vessel_name')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h5"><strong><?=$recap_document_header->vessel_init?> - <?=$recap_document_header->vessel_name?></strong></p></div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('transporter_name')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-7"><p class="h5"><strong><?=$recap_document_header->transporter_name?></strong></p></div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('currency')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-7"><p class="h5"><strong><?=$this->config->item('default_currency')?> <?=number_format($recap_document_header->recap_payable,2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?></strong></p></div>
									</div>
									<br>
									
								</div>							
							</div>				
							

							
						</div>
						<input class="btn btn-sm btn-success" type="button" id="showhidescanbarcode" name = "showhidescanbarcode" value="show scan barcode" >

					<div id="scanbarcode" ><input type="text" name="barcode_id_recap" id="barcode_id_recap" placeholder="Input Barcode ID" class="form-control" autocomplete="off" autofocus >
					
					<div id="detail_sj"></div>
					
					
					<input class="btn btn-sm btn-success" type="button" id="sj_submit" name = "sj_submit" value="Save" disabled>	
					<input class="btn btn-sm btn-success" type="button" id="sj_reset" name = "sj_reset" value="Reset" disabled>
					
					</div>
									<div class="line"></div>	
									<div id="total_item_unload" class="row inline-fields form-group form-md-line-input">
										<div class="col-md-2"><?=lang('total_item_unload')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-2 text-right" ><p class="h5"><strong><?=number_format($qty_bulk_delivery_netto,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?>  Kgs</strong></p></div>
									</div>
									<div id ="total_receipts" class="row inline-fields form-group form-md-line-input">
										<div class="col-md-2"><?=lang('total_receipts')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-2 text-right"><p class="h5"><strong><?=number_format($qty_bulk_receipt_netto,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?>  Kgs</strong></p></div>
									</div>
									
									<div id="total_difference" class="row inline-fields form-group form-md-line-input">
										<div class="col-md-2"><?=lang('total_difference')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-2 text-right"><p class="h5"><strong><?=number_format($qty_bulk_delivery_netto-$qty_bulk_receipt_netto,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?>  Kgs</strong></p></div>
									</div>					
<div id="list_sj"><section class="panel panel-default">
							<div class="table-responsive">

<table id="tbl-recap-orders" class="table table-striped table-hover b-t b-light text-sm">
					<thead>
					<tr>
					<th ><?=lang('delivery_order_no')?> </th>
					<th ><?=lang('date')?> </th>
					<th ><?=lang('time')?> </th>						
					<th ><?=lang('destination_from')?> </th>
					<th ><?=lang('destination_to')?> </th>
					<th ><?=lang('qty_delivery')?> </th>
					<th ><?=lang('qty_receipt')?> </th>
<th><?=lang('qty_difference')?> </th>

					</tr> 
					</thead>
					<tbody>
					

<?php
if(isset($listsjrecap)){
    foreach($listsjrecap as $row){
        ?><tr>
		<td >
			<?=$row->sj_ref?>
		</td> 
		<td >
			<?=$row->sj_date?>
		</td> 	
		<td >
			<?=$row->sj_time?>					
		</td> 							
		<td>
			<?=$row->destination_from?>					
		</td> 
				<td>
			<?=$row->destination_to?>					
		</td> 
				<td>
			<?=$row->qty_bulk_delivery_netto?>					
		</td> 
				<td>
			<?=$row->qty_bulk_receipt_netto?>					
		</td> 
						<td width="17%">
			<?=$row->qty_difference?>					
		</td>

</tr>
						
    <?php
    }
}
?></tbody></table>	
</div>
</section>
</div>

						

				
					
					 

							
				
							

									
					
					</section> 
										
				</section>  
<?php } } ?>	

			</section> 

		</aside>
			




		
	</section> 
		<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> 
</section>

<!-- end -->