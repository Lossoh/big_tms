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
							<center><p class="h3"><strong><?=$vessel_detail->vessel_ref?> - <?=$vessel_detail->vessel_name?></strong></p></center>
							<center><p class="h5"><strong>EDIT DOCUMENT VESSEL</strong></p></center>						
						</div>
			
					<div class="line"></div>					
					<div class="col-sm-12">
					<?php if (!empty($document_details)) {
						foreach ($document_details as $key => $document_detail) {
						$attributes = array('class' => 'bs-example form-horizontal');
						echo form_open(base_url().'vessels/manage/document_vessel_edit',$attributes); ?>
						<?php echo validation_errors(); ?>
						<div class="form-group form-md-line-input">
						<label class="col-lg-2 control-label"><?=lang('party_name')?></label>
						<div class="col-lg-2">
							<input type="hidden" name="document_id" value="<?=$document_detail->document_id?>">
							<input type="hidden" name="vessel_id" value="<?=$document_detail->vessel_id?>">
							<input type="hidden" name="party_id" value="<?=$document_detail->party_id?>">
							<input type="text" class="form-control" name="party_name" value="<?=$document_detail->party_name?>" disabled>
												
						</div>

						</div>
						
						<div class="form-group form-md-line-input">
						<label class="col-lg-2 control-label"><?=lang('po_ref')?><span class="text-danger">*</span></label> 
						<div class="col-lg-4">
						<input style="height:30px" type="text" name="po_ref" placeholder="Input PO Reference" class="form-control" autocomplete="off" value="<?=$document_detail->po_ref?>" required>
						</div> 
						<label class="col-lg-3 control-label"><?=lang('po_date')?></label> 
						<div class="col-lg-3">
						<input class="input-sm input-s datepicker-input form-control" size="16" type="text" value="<?=$document_detail->po_date?>" name="po_date" data-date-format="dd-mm-yyyy" >
						</div> 
						
						
						</div> 
						
						<div class="form-group form-md-line-input">
						<label class="col-lg-2 control-label"><?=lang('item_type')?><span class="text-danger">*</span></label> 

						<div class="col-lg-4">

							<select class="form-control"  name="item_type_id" requried> 		 							
							<option value="<?=$document_detail->item_type?>"><?=$document_detail->Kondisi_Ref_Char_01?></option>	
							<optgroup label="Item Type">							
							<option value="C">BULK</option>
							<option value="B">BAG</option>
							<option value="O">OTHER</option>
					
							</select>						

						</div> 
						<label class="col-lg-3 control-label"><?=lang('qty_po')?><span class="text-danger">*</span></label> 
						<div class="col-lg-2">
						<input class="form-control" type="text" name="qty_po" value="<?=$document_detail->qty_po?>" required >
						</div>
						<label class="col-lg-1 control-label">Kgs</label> 				
						
						</div>					
						<div class="form-group form-md-line-input">
						<label class="col-lg-2 control-label"><?=lang('item_name')?> <span class="text-danger">*</span></label>
						<div class="col-lg-4">
							
							<select id="select2-item" style="width:300px" style="height:250px" name="item_id" required>
								<option value="<?=$document_detail->item_id?>"><?=$document_detail->item_name?>
								<optgroup label="Items">
								<?php foreach ($items as $item): ?>
								<option value="<?=$item->item_id?>"><?=$item->item_name?></option>
								<?php endforeach; ?>
							</select> 					
						</div>

						</div>
						
						<div class="form-group form-md-line-input">
						<label class="col-lg-2 control-label"><?=lang('client')?><span class="text-danger">*</span></label> 
						<div class="col-lg-4">
							
							<select  id="select2-client" style="height:30px"  name="client_id" class="form-control" required>
							<option value="<?=$document_detail->client_id?>"><?=$document_detail->client_name?>
							<optgroup label="Clients">
							<?php foreach ($clients as $client): ?>
							<option value="<?=$client->client_id?>"><?=$client->client_name?></option>
							<?php endforeach; ?>						
							</select>
						</div> 
						<label class="col-lg-3 control-label"><?=lang('tolerence')?></label> 
						<div class="col-lg-2">
						<input class="form-control" type="text"  value="0" name="tolerence" value="<?=$document_detail->tolerence?>">
						</div> 
						<label class="col-lg-1 control-label">%</label> 
						</div>
						
						<div class="line"></div>	
						
						<div class="form-group form-md-line-input">
						<label class="col-lg-2 control-label"><?=lang('port_name')?></label> 
						<div class="col-lg-4">
							<input class="form-control" type="hidden"  name="port_id" value="<?=$document_detail->port_id?>">
							<input class="form-control" type="text"  name="port_name" value="<?=$document_detail->port_name?>" readonly>
						</div>
						
						<label class="col-lg-3 control-label"><?=lang('shipping_name')?></label> 
						<div class="col-lg-3">
						<input class="form-control" type="text"  name="shipping_name" value="<?=$document_detail->shipping_name?>">
						</div>
						</div>
						
 						<div class="form-group form-md-line-input">
						<label class="col-lg-2 control-label"><?=lang('steve_name')?></label> 
						<div class="col-lg-4">
							<input class="form-control" type="text"  name="stevedore_name" value="<?=$document_detail->stevedore_name?>">
						</div> 
						<label class="col-lg-3 control-label"><?=lang('bl/awb')?></label> 
						<div class="col-lg-3">
						<input class="form-control" type="text"  name="bl_doc" value="<?=$document_detail->bl_doc?>">
						</div>
						</div>					
						
						<hr>

				

						<?php } } ?>

						
						<div class="col-lg-12">
							<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> <?=lang('save_document')?></button>
						</div> 
						</form>
						
						
					</div>
					
					</section> 					
					<?php } } ?>

					</section>  
			</section> 
		</aside> 

	</section> 
		<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> 
</section>

<!-- end -->