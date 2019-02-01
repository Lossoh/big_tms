<section id="content">
	<section class="hbox stretch">	
		
		<aside>
			<section class="vbox">
				<header class="header bg-white b-b clearfix hidden-print">
					<div class="row m-t-sm">
						<div class="col-sm-8 m-b-xs">
						<h4 class="subheader text-muted"> <strong><?=lang('preview_delivery_document')?></strong></h4>
						<?php 
						if (!empty($sjk_details)) {
						foreach ($sjk_details  as $sjk_detail) { ?>							

						</div>
						<div class="col-sm-4 m-b-xs pull-right">

						</div>
					</div> 
				</header>
				<section class="scrollable wrapper w-f">
					<section class="scrollable wrapper">
					<?php     
						$attributes = array('class' => 'bs-example form-horizontal');
						echo form_open(base_url().'orders/manage/preview_sjk', $attributes); ?>
						<div class="row"> 
							
							<h4 class="subheader text-muted"> <strong><?=lang('delivery_order_no')?><?=$sjk_detail->sj_ref?>&ensp; &ensp; Date : <?=strftime("%d %b %Y", strtotime($sjk_detail->sj_date))?> &ensp; &ensp; Time : <?=$sjk_detail->sj_time?></strong></h4>
							<br>
							<div class="col-xs-6">
								<div class="group">
									
									<div class="row inline-fields form-group form-md-line-input">
										<input type="hidden" name="document_separate_id" value="<?=$sjk_detail->document_separate_id?> ">
										<input type="hidden" name="sj_id" value="<?=$sjk_detail->sj_id?> ">
										<input type="hidden" name="sj_ref" value="<?=$sjk_detail->sj_ref?> ">									
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
								</div>
								
							</div>
							
						</div>
				
					<div class="line"></div>
					
					<div><?php if(!$sjk_detail->printed){?><button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> <?=lang('print')?></button><?php } ?><input class="btn btn-sm yellow" type="button" onclick="window.location.replace('<?=base_url()?>orders/manage/addsjk/<?=$sjk_detail->document_separate_id?>')" value="Back To Delivery Order Document" /> </div>
							</form>
					<div></div>
					</section> 
										
				</section>  
<?php } } ?>	

			</section> 

		</aside>
			




		
	</section> 
		<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> 
</section>



<!-- end -->