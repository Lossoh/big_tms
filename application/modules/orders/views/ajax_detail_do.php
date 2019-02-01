<?php 
if($detail_sj != NULL){
    
        ?>
<section class="panel panel-default">
							<div class="table-responsive">

<table id="tbl-orders" class="table table-striped table-hover b-t b-light text-sm">

<table class="table" width="100%">
					<thead>
					<tr>
					<th width="15%"><?=lang('delivery_order_no')?> </th>
					<th width="10%"><?=lang('date')?> </th>
					<th width="10%"><?=lang('time')?> </th>						
					<th width="17%"><?=lang('destination_from')?> </th>
					<th width="17%"><?=lang('destination_to')?> </th>
					<th width="17%"><?=lang('qty_delivery')?> </th>
					<th width="17%"><?=lang('qty_receipt')?> </th>
					<th width="17%"><?=lang('qty_difference')?> </th>
					<th></th>
					</tr> 
					</thead>
					<tbody>
					<tr>


<?php 
if(isset($detail_sj)){
    foreach($detail_sj as $row){
        ?>
		<td width="15%">
		<input type="hidden" name="sj_id" id="sj_id" value="<?=$row->sj_id?> ">
			<?=$row->sj_ref?>
		</td> 
		<td width="10%">
			<?=$row->sj_date?>
		</td> 	
		<td width="10%">
			<?=$row->sj_time?>					
		</td> 							
		<td width="17%">
			<?=$row->destination_from?>					
		</td> 
				<td width="17%">
			<?=$row->destination_to?>					
		</td> 
				<td width="17%">
			<?=$row->qty_bulk_delivery_netto?>					
		</td> 
				<td width="17%">
			<?=$row->qty_bulk_receipt_netto?>					
		</td> 
				<td width="17%">
			<?=$row->qty_difference?>					
		</td> 	 

</tr></tbody></table>							
    <?php
}}
}else{echo "Data tidak ditemukan / telah terhapus";}

?>
