

<section id="content">
	<section class="hbox stretch">		
		<aside>
			<section class="vbox">
				<header class="header bg-white b-b clearfix hidden-print">

					<div class="row m-t-sm">
						<div class="col-sm-8 m-b-xs">
					
						<?php 
						if (!empty($document_destination_details)) {
						foreach ($document_destination_details as $key => $doc_des_detail) { ?>						
						
						<div class="btn-group">
						<button class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
						<?=lang('more_actions')?>
						<span class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="<?=base_url()?>orders/manage/delivery_order_list/<?=$doc_des_detail->document_separate_id?>"><?=lang('sjk_list')?></a></li>

								
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
					<?php     
							$attributes = array('class' => 'bs-example form-horizontal');
							echo form_open(base_url().'orders/manage/addsjk', $attributes); ?>
						<div class="row"> 
							<h4 class="subheader text-muted"><?=lang('vessel_delivery_document')?>&ensp; Total Weight by Order : <?=number_format($total_sjkorder,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?> Kgs&ensp; &ensp; Total of Difference : <?=number_format($difference_destination,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?> Kgs</h4>
							<br>
							<div class="col-xs-6">
								<div class="group">									
									<div class="row inline-fields form-group form-md-line-input">
										<input type="hidden" name="vessel_id" value="<?=$doc_des_detail->vessel_id?>">
										<input type="hidden" name="document_id" value="<?=$doc_des_detail->document_id?>">
										<input type="hidden" name="vessel_ref" value="<?=$doc_des_detail->vessel_ref?>">
										<input type="hidden" name="document_separate_id" value="<?=$doc_des_detail->document_separate_id?>">
										<div class="col-md-4"><?=lang('vessel_name')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h5"><strong><?=$doc_des_detail->vessel_ref?> - <?=$doc_des_detail->vessel_name?></strong></p></div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">
									<input type="hidden" name="party_id" value="<?=$doc_des_detail->party_id?>">
									<input type="hidden" name="party_ref" value="<?=$doc_des_detail->party_name?>">
										<div class="col-md-4"><?=lang('party_name')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h4"><strong><?=$doc_des_detail->party_name?></strong></p></div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">
										<input type="hidden" name="po_ref" value="<?=$doc_des_detail->po_ref?>">
										<div class="col-md-4"><?=lang('po_ref')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h4"><strong><?=$doc_des_detail->po_ref?></strong></p></div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">
										<input type="hidden" name="destination_description" value="<?=$doc_des_detail->destination_description?>">
										<div class="col-md-4"><?=lang('destination_description')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h5"><strong><?=$doc_des_detail->destination_description?></strong></p></div>
									</div>									
									<div class="row inline-fields form-group form-md-line-input">
										<input type="hidden" name="client_id" value="<?=$doc_des_detail->client_id?>">
										<div class="col-md-4"><?=lang('client_name')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-7"><p class="h5"><strong><?=$doc_des_detail->client_name?></strong></p></div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">
										<input type="hidden" name="item_id" value="<?=$doc_des_detail->item_id?>">
										<div class="col-md-4"><?=lang('item_name')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-7"><p class="h5"><strong><?=$doc_des_detail->item_name?></strong></p></div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">
										<input type="hidden" name="item_type" value="<?=$doc_des_detail->item_type?>">
										<div class="col-md-4"><?=lang('item_type')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-7"><p class="h5"><strong><?=$doc_des_detail->iItem_type?></strong></p></div>
									</div>									
									<div class="row inline-fields form-group form-md-line-input">
										<input type="hidden" name="shipping_name" value="<?=$doc_des_detail->shipping_name?>">
										<div class="col-md-4"><?=lang('shipping_name')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-7"><p class="h5"><strong><?=$doc_des_detail->shipping_name?></strong></p></div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">
									<input type="hidden" name="stevedore_name" value="<?=$doc_des_detail->stevedore_name?>">
										<div class="col-md-4"><?=lang('steve_name')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-2"><p class="h5"><strong><?=$doc_des_detail->stevedore_name?></strong></p></div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('unload_receipt_ref')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-2">
											<select id="select2-bonmuat" style="width:150px" style="height:250px" name="unload_receipt_id" required>		       
											<option value=""></option>								
											<optgroup label="Unload Receipt/Bon Muat Manual"> 
											
											<?php foreach ($unload_receipts as $unload_receipt): ?>
											<option value="<?=$unload_receipt->unload_receipt_id?>"><?=$unload_receipt->unload_receipt_ref?></option>
											<?php endforeach; ?>
											</select> 										
										</div>
									</div>							
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('truck_ref')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-2">
											<select id="select2-option" style="width:150px" style="height:250px" name="truck_id" required>		       
											<option value=""></option>								
											<optgroup label="Trucks"> 
											
											<?php foreach ($trucks as $truck): ?>
											<option value="<?=$truck->truck_id?>"><?=$truck->truck_ref?></option>
											<?php endforeach; ?>
											</select> 										
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
									<div class="col-md-2"><p class="h4"><strong><span class="label label-<?=$doc_des_detail->hvessel_status?>"><?=$doc_des_detail->hNm_Ref?></span></strong></p></div>
								</div>
								<div class="row inline-fields form-group form-md-line-input">
									<div class="col-md-4"><?=lang('port_name')?></div>
									<div class="col-md-1">:</div>
									<div class="col-md-7"><p class="h5"><strong><?=$doc_des_detail->port_name?></strong></p></div>
								</div>
								<div class="row inline-fields form-group form-md-line-input">
									<input type="hidden" name="po_date" value="<?=$doc_des_detail->po_date?>">
									<div class="col-md-4"><?=lang('po_date')?></div>
									<div class="col-md-1">:</div>
									<div class="col-md-4"><p class="h4"><strong><?=strftime("%b %d, %Y", strtotime($doc_des_detail->po_date));?></strong></p></div>
								</div>									
								<div class="row inline-fields form-group form-md-line-input">
									<input type="hidden" name="bl_doc" value="<?=$doc_des_detail->bl_doc?>">
									<div class="col-md-4"><?=lang('bl/awb')?></div>
									<div class="col-md-1">:</div>
									<div class="col-md-2"><p class="h4"><strong><?=$doc_des_detail->bl_doc?></strong></p></div>
								</div>	
								<div class="row inline-fields form-group form-md-line-input">
									<input type="hidden" name="qty_po" value="<?=$doc_des_detail->qty_po?>">
									<div class="col-md-4"><?=lang('total_item_po')?></div>
									<div class="col-md-1">:</div>
									<div class="col-md-7"><p class="h5"><strong><?=number_format($doc_des_detail->qty_destination,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?>/<?=number_format($doc_des_detail->qty_po,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?> Kgs</strong></p></div>
								</div>
								<div class="row inline-fields form-group form-md-line-input">
									<?php 
										if (!empty($destinantion_sources)) {
										foreach ($destinantion_sources as $key => $destinantion_source) { ?>		
									<input type="hidden" name="destination_from" value="<?=$destinantion_source->destination_id?>">
									<input type="hidden" name="destination_from_ref" value="<?=$destinantion_source->destination_ref?>">
									<div class="col-md-4"><?=lang('destination_from')?><span class="text-danger">**</span></div>
									<div class="col-md-1">:</div>
									<div class="col-md-7"><p class="h5"><strong><span class="label label-warning"><?=$destinantion_source->destination_ref?>-<?=$destinantion_source->destination_name?></span></strong></p></div>
									<?php }}?>
								</div>								
								<div class="row inline-fields form-group form-md-line-input">
									<input type="hidden" name="destination_to" value="<?=$doc_des_detail->destination_id?>">
									<input type="hidden" name="destination_ref" value="<?=$doc_des_detail->destination_ref?>">
									<div class="col-md-4"><?=lang('destination_to')?><span class="text-danger">**</span></div>
									<div class="col-md-1">:</div>
									<div class="col-md-7"><p class="h5"><strong><span class="label label-danger"><?=$doc_des_detail->destination_ref?>-<?=$doc_des_detail->destination_name?></span></strong></p></div>
								</div>
								<div class="row inline-fields form-group form-md-line-input">
									<input type="hidden" name="remarks" value="<?=$doc_des_detail->remarks?>">
									<div class="col-md-4"><?=lang('remarks')?></div>
									<div class="col-md-1">:</div>
									<div class="col-md-7"><p class="h5"><strong><?=$doc_des_detail->remarks?></strong></p></div>
								</div>
								<div class="row inline-fields form-group form-md-line-input">
									<div class="col-md-4"><?=lang('bruto')?><span class="text-danger">*</span></div>
									<div class="col-md-1">:</div>
									<div class="col-md-6"><input  type="text" name="qty_bulk_delivery_bruto" id="qty_bulk_delivery_bruto" placeholder="Input Bruto" class="form-control" value="0" autocomplete="off"></div>
									<div class="col-md-1">Kgs</div>
								</div>
								<div class="row inline-fields form-group form-md-line-input">
									<div class="col-md-4"><?=lang('tarra')?><span class="text-danger">*</span></div>
									<div class="col-md-1">:</div>
									<div class="col-md-6"><input type="text" name="qty_bulk_delivery_tarra" id="qty_bulk_delivery_tarra" placeholder="Input Tarra" class="form-control" value="0" autocomplete="off"></div>
									<div class="col-md-1">Kgs</div>
								</div>
								<div class="row inline-fields form-group form-md-line-input">
									<div class="col-md-4"><?=lang('netto')?><span class="text-danger">**</span></div>
									<div class="col-md-1">:</div>
									<div class="col-md-6"><input type="text" name="qty_bulk_delivery_netto" id="qty_bulk_delivery_netto" placeholder="Input Netto" class="form-control" value="0" readonly></div>
									<div class="col-md-1">Kgs</div>
								</div>	
								<div class="row inline-fields form-group form-md-line-input">
									<div class="col-md-4"><?=lang('driver_name')?></div>
									<div class="col-md-1">:</div>
									<div class="col-md-7"><input style="height:30px" type="text" name="driver_name" id="driver_name" placeholder="Input Driver" class="form-control" autocomplete="off"></div>
								</div>
								<div class="row inline-fields form-group form-md-line-input">
									<div class="col-md-4"><?=lang('palka_name')?></div>
									<div class="col-md-1">:</div>
									<div class="col-md-7">
										<select id="select2-palka" style="width:150px" name="palka_id" required>	
										<?php foreach ($palkas as $palka): ?>
										<option value="<?=$palka->No_Urut_Ref?>"><?=$palka->Nm_Ref?></option>
										<?php endforeach; ?>
										</select> 										
									</div>
								</div>									
								</div>
								
							</div>
							
						</div>
				
					<div class="line"></div>
					
					<div><button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> <?=lang('save')?></button></div>
							</form>

					</section> 
										
				</section>  
<?php } } ?>	

			</section> 

		</aside>
		<aside class="aside-xxlg bg-white b-l hide" id="subNav">

		<header class="dk header b-b">

		<p class="h4">
		<?php echo  $this->AppModel->get_id('fx_mst_vessels',$array=array('vessel_id' => $this->session->userdata('vessel_active')),'vessel_name');?>
		</p>

		</header>
		
		<section class="vbox">
			<section class="scrollable wrapper">
			   <div id="detail_client_order_list" >
				
			</div></section>
			</section>
			</aside> 	




		
	</section> 
		<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>



<!-- end -->