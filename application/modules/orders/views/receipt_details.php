 <script type="text/javascript">
$(document).ready(function($) {

			
	/* $('#qty_bulk_receipt_bruto').keyup(function(){

        var bruto=parseInt($('#qty_bulk_receipt_bruto').val());
        var tarra=parseInt($('#qty_bulk_receipt_tarra').val());
 
            
        var netto=bruto-tarra;
        $('#qty_bulk_receipt_netto').val(netto);
    }); */

/* 	$('#qty_bulk_receipt_tarra').keyup(function(){

        var bruto=parseInt($('#qty_bulk_receipt_bruto').val());
        var tarra=parseInt($('#qty_bulk_receipt_tarra').val());
 
            
        var netto=bruto-tarra;
		if(netto<=0){alert('Netto must be great than 0(zero)');  $('#qty_bulk_receipt_netto').val(netto);return false;}
		
        $('#qty_bulk_receipt_netto').val(netto);
    }); */
	
	 $('#qty_bulk_receipt_netto').keyup(function(){

        var netto=parseInt($('#qty_bulk_receipt_netto').val());
      
            
       
		if(netto<=0){alert('Netto must be great than 0(zero)'); $('#qty_bulk_receipt_netto').val(0);return false;}
		
       
    }); 
	

});
</script>

<?php 
	if (!empty($barcode_details)) {
		foreach ($barcode_details  as $sjk_detail) { ?>		

<?php     
	$attributes = array('class' => 'bs-example form-horizontal');
	echo form_open(base_url().'orders/receipt_document', $attributes); ?>

<div class="row">						
	<div class="col-xs-6">
		<div class="group">
		<div class="row inline-fields form-group form-md-line-input">
		<p class="text-danger"> <strong>The page will be refresh left at  <span id="countdown">120</span> seconds.</strong></p>
		<div class="col-md-4"><p class="h5"><strong><?=lang('barcode_id')?></strong></p></div>
		<div class="col-md-1"><p class="h5"><strong>:</strong></p></div>
		<div class="col-md-7"><p class="h5"><strong><?=$sjk_detail->barcode_id?> - <?=$sjk_detail->barcode_date?> - <?=$sjk_detail->barcode_time?></strong></p></div>
		</div>
		<div class="row inline-fields form-group form-md-line-input">
		<div class="col-md-4"><?=lang('sj_ref')?></div>
		<div class="col-md-1">:</div>
		<div class="col-md-7"> <?=$sjk_detail->sj_ref?> - <?=$sjk_detail->sj_date?> - <?=$sjk_detail->sj_time?></div>
		</div>		
		<div class="row inline-fields form-group form-md-line-input">
		<input type="hidden" name="document_separate_id" value="<?=$sjk_detail->document_separate_id?>">
		<input type="hidden" name="sj_id" value="<?=$sjk_detail->sj_id?>">
		<input type="hidden" name="barcode_id_receipt" value="<?=$sjk_detail->barcode_id?>">
		<input type="hidden" name="sj_ref" value="<?=$sjk_detail->sj_ref?>">									
		<div class="col-md-4"><?=lang('vessel_name')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h5"><strong><?=$sjk_detail->vessel_init?> - <?=$sjk_detail->vessel_name?></strong></p></div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">
									<input type="hidden" name="party_id" value="<?=$sjk_detail->party_id?> ">
									<input type="hidden" name="party_ref" value="<?=$sjk_detail->party_name?> ">
										<div class="col-md-4"><?=lang('party_name')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h5"><strong><?=$sjk_detail->party_name?></strong></p></div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('po_ref')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h5"><strong><?=$sjk_detail->po_ref?></strong></p></div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('destination_description')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h5"><strong><?=$sjk_detail->destination_description?></strong></p></div>
									</div>									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('client_name')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-7"><p class="h5"><strong><?=$sjk_detail->client_name?></strong></p></div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('item_name')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-7"><p class="h5"><strong><?=$sjk_detail->item_name?></strong></p></div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('item_type')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-7"><p class="h5"><strong><?=$sjk_detail->item_type?></strong></p></div>
									</div>									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('shipping_name')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-7"><p class="h5"><strong><?=$sjk_detail->shipping_name?></strong></p></div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('steve_name')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-2"><p class="h5"><strong><?=$sjk_detail->stevedore_name?></strong></p></div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('truck_ref')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-7">
										<p class="h5"><strong><?=$sjk_detail->truck_name?></strong></p>
										<p class="h5"><strong><?=$sjk_detail->transporter_name?></strong></p>
										<p class="h5"><strong><?=$sjk_detail->truck_type?></strong></p>
										</div>
									</div>
									<br>
									<div id="detail_pelanggan"></div>
									
								</div>							
							</div>
							
							
							<div class="col-xs-6 text-left">
								<div class="group">
									<div class="row inline-fields form-group form-md-line-input">
									<div class="col-md-4"><?=lang('vessel_status')?></div>
									<div class="col-md-1">:</div>
									<div class="col-md-2"><p class="h5"><strong><span class="label label-<?=$sjk_detail->vessel_color?>"><?=$sjk_detail->vessel_status?></span></strong></p></div>
								</div>
								<div class="row inline-fields form-group form-md-line-input">
									<div class="col-md-4"><?=lang('port_name')?></div>
									<div class="col-md-1">:</div>
									<div class="col-md-7"><p class="h5"><strong><?=$sjk_detail->port_name?></strong></p></div>
								</div>
								<div class="row inline-fields form-group form-md-line-input">
									<div class="col-md-4"><?=lang('po_date')?></div>
									<div class="col-md-1">:</div>
									<div class="col-md-4"><p class="h5"><strong><?=strftime("%b %d, %Y", strtotime($sjk_detail->po_date));?></strong></p></div>
								</div>									
								<div class="row inline-fields form-group form-md-line-input">
									<div class="col-md-4"><?=lang('bl/awb')?></div>
									<div class="col-md-1">:</div>
									<div class="col-md-2"><p class="h5"><strong><?=$sjk_detail->bl_doc?></strong></p></div>
								</div>	
								<div class="row inline-fields form-group form-md-line-input">
									<div class="col-md-4"><?=lang('total_item_po')?></div>
									<div class="col-md-1">:</div>
									<div class="col-md-2"><p class="h5"><strong><?=number_format($sjk_detail->qty_destination,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?>/<?=number_format($sjk_detail->qty_po,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?></strong></p></div>
								</div>
								<div class="row inline-fields form-group form-md-line-input">

									<div class="col-md-4"><?=lang('destination_from')?></div>
									<div class="col-md-1">:</div>
									<div class="col-md-7"><p class="h5"><strong><?=$sjk_detail->destination_ref_from?>-/-<?=$sjk_detail->destination_name_from?></strong></p></div>

								</div>								
								<div class="row inline-fields form-group form-md-line-input">

									<div class="col-md-4"><?=lang('destination_to')?></div>
									<div class="col-md-1">:</div>
									<div class="col-md-7"><p class="h5"><strong><?=$sjk_detail->destination_ref_to?>-<?=$sjk_detail->destination_name_to?></strong></p></div>
								</div>
								<div class="row inline-fields form-group form-md-line-input">
									<div class="col-md-4"><?=lang('remarks')?></div>
									<div class="col-md-1">:</div>
									<div class="col-md-7"><p class="h5"><strong><?=$sjk_detail->remarks?></strong></p></div>
								</div>
								<div class="row inline-fields form-group form-md-line-input">
									<div class="col-md-4"><?=lang('bruto')?></div>
									<div class="col-md-1">:</div>
									<div class="col-md-6"><p class="h5"><strong><?=number_format($sjk_detail->qty_bulk_delivery_bruto,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?></strong></p></div>
									<div class="col-md-1">Kgs</div>
								</div>
								<div class="row inline-fields form-group form-md-line-input">
									<div class="col-md-4"><?=lang('tarra')?></div>
									<div class="col-md-1">:</div>
									<div class="col-md-6"><p class="h5"><strong><?=number_format($sjk_detail->qty_bulk_delivery_tarra,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?></strong></p></div>
									<div class="col-md-1">Kgs</div>
								</div>
								<div class="row inline-fields form-group form-md-line-input">
									<div class="col-md-4"><?=lang('netto')?></div>
									<div class="col-md-1">:</div>
									<div class="col-md-6"><p class="h5"><strong><?=number_format($sjk_detail->qty_bulk_delivery_netto,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?></strong></p></div>
									<div class="col-md-1">Kgs</div>
								</div>	
								<div class="row inline-fields form-group form-md-line-input">
									<div class="col-md-4"><?=lang('driver_name')?></div>
									<div class="col-md-1">:</div>
									<div class="col-md-7"><p class="h5"><strong><?=$sjk_detail->driver_name?></strong></p></div>
								</div>	
								<div class="row inline-fields form-group form-md-line-input">
									<div class="col-md-4"><?=lang('bruto_receipt')?><span class="text-danger">*</span></div>
									<div class="col-md-1">:</div>
									<div class="col-md-6"><input  type="text" name="qty_bulk_receipt_bruto" id="qty_bulk_receipt_bruto" placeholder="Input Bruto" class="form-control" value="0" autocomplete="off" disabled></div>
									<div class="col-md-1">Kgs</div>
								</div>
								<div class="row inline-fields form-group form-md-line-input">
									<div class="col-md-4"><?=lang('tarra_receipt')?><span class="text-danger">*</span></div>
									<div class="col-md-1">:</div>
									<div class="col-md-6"><input type="text" name="qty_bulk_receipt_tarra" id="qty_bulk_receipt_tarra" placeholder="Input Tarra" class="form-control" value="0" autocomplete="off" disabled></div>
									<div class="col-md-1">Kgs</div>
								</div>
								<div class="row inline-fields form-group form-md-line-input">
									<div class="col-md-4"><?=lang('netto_receipt')?><span class="text-danger">**</span></div>
									<div class="col-md-1">:</div>
									<div class="col-md-6"><input type="text" name="qty_bulk_receipt_netto" id="qty_bulk_receipt_netto" placeholder="Input Netto" class="form-control" value="0" autocomplete="off"></div>
									<div class="col-md-1">Kgs</div>
								</div>								
								</div>
								
							</div>
							
						</div>
				
					<div class="line"></div>
					
					<div><?php if(!$sjk_detail->user_receipt > 0){?><button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> <?=lang('save')?></button><?php } ?><input class="btn btn-sm yellow" type="button" onclick="window.location.replace('<?=base_url()?>orders/receipt_document')" value="Back To Receipt Document" /> </div>
							</form>
					<div></div>
					
					<?php }} else {?>
							<div class="row inline-fields form-group form-md-line-input">
		<p class="text-danger"> <strong>The page will be refresh left at  <span id="countdown">30</span> seconds.</strong></p>
		<div class="col-md-4"><p class="h5"><strong><?=lang('data_not_found')?></strong></p><input class="btn btn-sm yellow" type="button" onclick="window.location.replace('<?=base_url()?>orders/receipt_document')" value="Back To Receipt Document" /> </div>
		
		</div>

					<?php }?>
				