<section id="content">
	<section class="hbox stretch">	
		<aside class="aside-lg bg-white b-r" id="subNav">

		<header class="dk header b-b">

		<p class="h4"><?=lang('all_orderofvessel')?></p>

		</header>
		<section class="vbox">
			<section class="scrollable w-f">
			   <div class="slim-scroll" id="detail_client_order_list" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
				<ul class="nav">
			<?php
			if (!empty($document_destination_vessel)) {
			foreach ($document_destination_vessel as $key => $doc_des_vessel) {  //$encrypted_string = $this->encrypt->encode($vessel->vessel_id);
					?>
				<li class="b-b b-success <?php if($doc_des_vessel->document_separate_id == $this->uri->segment(4)){ echo "bg-success dk"; } ?>"><a href="<?=base_url()?>orders/manage/addsjk/<?=$doc_des_vessel->document_separate_id?>">
				<?=$doc_des_vessel->vessel_ref?> - <?=$doc_des_vessel->vessel_name?> <br>
				PO &nbsp &nbsp &nbsp &nbsp &nbsp : <?=$doc_des_vessel->po_ref?> - <?=strftime("%b %d, %Y", strtotime($doc_des_vessel->po_date));?><br>
				<?=$doc_des_vessel->destination_description?><br>
				TO &nbsp &nbsp &nbsp &nbsp &nbsp : <?=$doc_des_vessel->destination_name?><br>
				ITEM &nbsp &nbsp &nbsp : <?=$doc_des_vessel->item_name?><br>
				CLIENT &nbsp : <?=$doc_des_vessel->client_name?>
				<div class="pull-right">
				<span class="label label-<?=$doc_des_vessel->Kondisi_Ref_Char_01?>"><?=$doc_des_vessel->hNm_Ref?></span>
				</div> <br>
				<small class="block small text-error"><?=$doc_des_vessel->vessel_init?> | <?=strftime("%b %d, %Y", strtotime($doc_des_vessel->date_created));?></small>

				</a> </li>
				<?php } } ?>
			</ul> 
			</div></section>
			</section>
			</aside> 
		<aside>
			<section class="vbox">
				<header class="header bg-white b-b clearfix hidden-print">
					<div class="row m-t-sm">
						<div class="col-sm-8 m-b-xs">
					
						<?php 
						if (!empty($sjk_details)) {
						foreach ($sjk_details as $key => $sjk_detail) { ?>						
						
						<div class="btn-group">
						<button class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
						<?=lang('more_actions')?>
						<span class="caret"></span></button>
						<ul class="dropdown-menu">
											
							<li><a href="<?=base_url()?>orders/manage/delivery_order_list/<?=$sjk_detail->document_separate_id?>"><?=lang('sjk_list')?></a></li>
								
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
							<a href="<?=base_url()?>fopdf/sjkorder/<?=$sjk_detail->sj_id?>" class="btn btn-sm btn-dark pull-right">
							<i class="fa fa-file-pdf-o"></i> <?=lang('pdf')?></a>
						</div>
					</div> 
				</header>
				<section class="scrollable wrapper w-f">
					<section class="scrollable wrapper">
					<?php     
							$attributes = array('class' => 'bs-example form-horizontal');
							echo form_open(base_url().'orders/manage/editsjk', $attributes); ?>
						<div class="row"> 
							<h4 class="subheader text-muted"><?=lang('edit_delivery_order')?><?=$sjk_detail->sj_ref?>&ensp; &ensp; Date : <?=strftime("%d %b %Y", strtotime($sjk_detail->sj_date))?> &ensp; &ensp; Time : <?=$sjk_detail->sj_time?></strong></h4>
							<br>
							<div class="col-xs-6">
								<div class="group">									
									<div class="row inline-fields form-group form-md-line-input">
										<input type="hidden" name="sj_id" value="<?=$sjk_detail->sj_id?> ">	
										<input type="hidden" name="sj_ref" value="<?=$sjk_detail->sj_ref?> ">	
										<input type="hidden" name="vessel_id" value="<?=$sjk_detail->vessel_id?> ">										
										<input type="hidden" name="document_separate_id" value="<?=$sjk_detail->document_separate_id?> ">
										<div class="col-md-4"><?=lang('vessel_name')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h5"><strong><?=$sjk_detail->vessel_init?> - <?=$sjk_detail->vessel_name?></strong></p></div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">

										<div class="col-md-4"><?=lang('party_name')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h4"><strong><?=$sjk_detail->party_name?></strong></p></div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">

										<div class="col-md-4"><?=lang('po_ref')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h4"><strong><?=$sjk_detail->po_ref?></strong></p></div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">

										<div class="col-md-4"><?=lang('destination_description')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h5"><strong><?=$sjk_detail->destination_description?></strong></p></div>
									</div>									
									<div class="row inline-fields form-group form-md-line-input">

										<div class="col-md-4"><?=lang('client_name')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-7"><p class="h5"><strong><?=$sjk_detail->client_name?></strong></p></div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">

										<div class="col-md-4"><?=lang('item_name')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-7"><p class="h5"><strong><?=$sjk_detail->item_name?></strong></p></div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">
										
										<div class="col-md-4"><?=lang('item_type')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-7"><p class="h5"><strong><?=$sjk_detail->item_type_name?></strong></p></div>
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
										<div class="col-md-4"><?=lang('load_receipt_ref')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-2">
											<select id="select2-loadreceipt" style="width:150px" style="height:250px" name="load_receipt_id" required>		       
											<option value=""></option>											
											<?php foreach ($trucks as $truck): ?>
											<option value="<?=$truck->truck_id?>"><?=$truck->truck_ref?></option>
											<?php endforeach; ?>
											</select> 										
										</div>
									</div>								
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('truck_ref')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-2">
											<select id="select2-option" style="width:150px" style="height:250px" name="truck_id" required>		       
											<option value="<?=$sjk_detail->truck_id?>"><?=$sjk_detail->truck_ref?></option>
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
									<div class="col-md-2"><p class="h4"><strong><span class="label label-<?=$sjk_detail->vessel_color?>"><?=$sjk_detail->vessel_status?></span></strong></p></div>
								</div>
								<div class="row inline-fields form-group form-md-line-input">
									<div class="col-md-4"><?=lang('port_name')?></div>
									<div class="col-md-1">:</div>
									<div class="col-md-7"><p class="h5"><strong><?=$sjk_detail->port_name?></strong></p></div>
								</div>
								<div class="row inline-fields form-group form-md-line-input">
									<input type="hidden" name="po_date" value="<?=$sjk_detail->po_date?> ">
									<div class="col-md-4"><?=lang('po_date')?></div>
									<div class="col-md-1">:</div>
									<div class="col-md-4"><p class="h4"><strong><?=strftime("%b %d, %Y", strtotime($sjk_detail->po_date));?></strong></p></div>
								</div>									
								<div class="row inline-fields form-group form-md-line-input">
									<input type="hidden" name="bl_doc" value="<?=$sjk_detail->bl_doc?> ">
									<div class="col-md-4"><?=lang('bl/awb')?></div>
									<div class="col-md-1">:</div>
									<div class="col-md-2"><p class="h4"><strong><?=$sjk_detail->bl_doc?></strong></p></div>
								</div>	
								<div class="row inline-fields form-group form-md-line-input">
									<input type="hidden" name="qty_po" value="<?=$sjk_detail->qty_po?> ">
									<div class="col-md-4"><?=lang('total_item_po')?></div>
									<div class="col-md-1">:</div>
									<div class="col-md-7"><p class="h5"><strong><?=number_format($sjk_detail->qty_destination,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?>/<?=number_format($sjk_detail->qty_po,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?> Kgs</strong></p></div>
								</div>
								<div class="row inline-fields form-group form-md-line-input">									
									<div class="col-md-4"><?=lang('destination_from')?><span class="text-danger">**</span></div>
									<div class="col-md-1">:</div>
									<div class="col-md-7"><p class="h5"><strong><span class="label label-warning"><?=$sjk_detail->destination_ref_from?>-<?=$sjk_detail->destination_name_from?></span></strong></p></div>
									
								</div>								
								<div class="row inline-fields form-group form-md-line-input">
			
									<div class="col-md-4"><?=lang('destination_to')?><span class="text-danger">**</span></div>
									<div class="col-md-1">:</div>
									<div class="col-md-7"><p class="h5"><strong><span class="label label-danger"><?=$sjk_detail->destination_ref_to?>-<?=$sjk_detail->destination_name_to?></span></strong></p></div>
								</div>
								<div class="row inline-fields form-group form-md-line-input">
									<input type="hidden" name="remarks" value="<?=$sjk_detail->remarks?> ">
									<div class="col-md-4"><?=lang('remarks')?></div>
									<div class="col-md-1">:</div>
									<div class="col-md-7"><p class="h5"><strong><?=$sjk_detail->remarks?></strong></p></div>
								</div>
								<div class="row inline-fields form-group form-md-line-input">
									<div class="col-md-4"><?=lang('bruto')?><span class="text-danger">*</span></div>
									<div class="col-md-1">:</div>
									<div class="col-md-6"><input  type="text" name="qty_bulk_delivery_bruto" id="qty_bulk_delivery_bruto" placeholder="Input Bruto" class="form-control" value="<?=$sjk_detail->qty_bulk_delivery_bruto?>" autocomplete="off"></div>
									<div class="col-md-1">Kgs</div>
								</div>
								<div class="row inline-fields form-group form-md-line-input">
									<div class="col-md-4"><?=lang('tarra')?><span class="text-danger">*</span></div>
									<div class="col-md-1">:</div>
									<div class="col-md-6"><input type="text" name="qty_bulk_delivery_tarra" id="qty_bulk_delivery_tarra" placeholder="Input Tarra" class="form-control" value="<?=$sjk_detail->qty_bulk_delivery_tarra?>" autocomplete="off"></div>
									<div class="col-md-1">Kgs</div>
								</div>
								<div class="row inline-fields form-group form-md-line-input">
									<div class="col-md-4"><?=lang('netto')?><span class="text-danger">**</span></div>
									<div class="col-md-1">:</div>
									<div class="col-md-6"><input type="text" name="qty_bulk_delivery_netto" id="qty_bulk_delivery_netto" placeholder="Input Netto" class="form-control" value="<?=$sjk_detail->qty_bulk_delivery_netto?>" readonly></div>
									<div class="col-md-1">Kgs</div>
								</div>	
								<div class="row inline-fields form-group form-md-line-input">
									<div class="col-md-4"><?=lang('driver_name')?></div>
									<div class="col-md-1">:</div>
									<div class="col-md-7"><input style="height:30px" type="text" name="driver_name" id="driver_name" placeholder="Input Driver" class="form-control" autocomplete="off" value="<?=$sjk_detail->driver_name?>"></div>
								</div>
								<div class="row inline-fields form-group form-md-line-input">
									<div class="col-md-4"><?=lang('palka_name')?></div>
									<div class="col-md-1">:</div>
									<div class="col-md-7">
										
										<select id="select2-palka" style="width:150px" name="palka_id" required>
										<option value="<?=$sjk_detail->palka_id?>"><?=$sjk_detail->palka_name?></option>
										<optgroup label="Palka"> 
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
			




		
	</section> 
		<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> 
</section>



<!-- end -->