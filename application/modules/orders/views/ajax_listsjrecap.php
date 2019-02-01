
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-2"><?=lang('total_item_unload')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-2 text-right" ><p class="h5"><strong><?=number_format($qty_bulk_delivery_netto,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?>  Kgs</strong></p></div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-2"><?=lang('total_receipts')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-2 text-right"><p class="h5"><strong><?=number_format($qty_bulk_receipt_netto,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?>  Kgs</strong></p></div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-2"><?=lang('total_difference')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-2 text-right"><p class="h5"><strong><?=number_format($qty_bulk_delivery_netto-$qty_bulk_receipt_netto,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?>  Kgs</strong></p></div>
									</div>

<section class="panel panel-default">
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
