<section id="content">
	<section class="hbox stretch">	
		
			
		<aside>
			<section class="vbox">
				<header class="header bg-white b-b clearfix hidden-print">
					<a href="#subNav" data-toggle="class:show" class="btn btn-sm green pull-right" id="vessel_active"><i class="fa fa-spinner fa-spin"></i> <?=lang('choose_vessel_active')?></a>					
				
					<div class="row m-t-sm">
						<?php 
						if (!empty($vessel_details)) {
						foreach ($vessel_details as $key => $vessel) { ?>	
						<div class="col-sm-8 m-b-xs">						
						
							<div class="btn-group">
							<button class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
							<?=lang('more_actions')?>
							<span class="caret"></span></button>
							<ul class="dropdown-menu">
							<li><a href="<?=base_url()?>vessels/manage/edit/<?=$vessel->vessel_id?>"><?=lang('edit_vessel')?></a></li>
							<li><a href="<?=base_url()?>vessels/manage/delete/<?=$vessel->vessel_id?>" data-toggle="ajaxModal"><?=lang('delete_vessel')?></a></li>
							<li><a href="<?=base_url()?>vessels/manage/details/<?=$vessel->vessel_id?>"><?=lang('palka_list')?></a></li>								
							<li><a href="<?=base_url()?>vessels/manage/unload_receipt_list/<?=$vessel->vessel_id?>"><?=lang('unload_receipt_list')?></a></li>											
							<li><a href="<?=base_url()?>vessels/manage/document_vessel/<?=$vessel->vessel_id?>"><?=lang('document_vessel')?></a></li>							
							<li><a href="<?=base_url()?>vessels/manage/document_vessel_list/<?=$vessel->vessel_id?>"><?=lang('list_document_vessel')?></a></li>			
							<li><a href="<?=base_url()?>vessels/manage/memo_list/<?=$vessel->vessel_id?>"><?=lang('memo_list')?></a></li>								
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
							<center><p class="h3"><strong><?=$vessel->vessel_ref?> - <?=$vessel->vessel_name?></strong></p></center>
							<center><p class="h5"><strong>NEW DOCUMENT VESSEL</strong></p></center>						
						</div>
				
					<div class="line"></div>					
					<div class="col-sm-12">
					<?php
						$attributes = array('class' => 'bs-example form-horizontal');
						echo form_open(base_url().'vessels/manage/document_vessel',$attributes); ?>
						<?php echo validation_errors(); ?>
						<div class="form-group form-md-line-input">
						<label class="col-lg-2 control-label"><?=lang('party_name')?> <span class="text-danger">*</span></label>
						<div class="col-lg-2">
							<input type="hidden" name="vessel_id" value="<?=$vessel->vessel_id?> ">
							<select class="form-control"  name="party_id" required> 		 							
							<?php foreach ($parties as $party): ?>
							<option value="<?=$party->No_Urut_Ref?>"><?=$party->Nm_Ref?></option>
							<?php endforeach; ?>						
							</select>						
						</div>

						</div>
						
						<div class="form-group form-md-line-input">
						<label class="col-lg-2 control-label"><?=lang('po_ref')?><span class="text-danger">*</span></label> 
						<div class="col-lg-4">
						<input style="height:30px" type="text" name="po_ref" placeholder="Input PO Reference" class="form-control" autocomplete="off" required>
						</div> 
						<label class="col-lg-3 control-label"><?=lang('po_date')?></label> 
						<div class="col-lg-3">
						<input class="input-sm input-s datepicker-input form-control" size="16" type="text" value="<?=date('d-m-Y')?>" name="po_date" data-date-format="dd-mm-yyyy" >
						</div> 
						
						
						</div> 
						
						<div class="form-group form-md-line-input">
						<label class="col-lg-2 control-label"><?=lang('item_type')?><span class="text-danger">*</span></label> 

						<div class="col-lg-4">
						
							<select class="form-control"  name="item_type_id" requried> 		 							
							
							<option value="C">BULK</option>
							<option value="B">BAG</option>
							<option value="O">OTHER</option>
					
							</select>						

						</div> 
						<label class="col-lg-3 control-label"><?=lang('qty_po')?><span class="text-danger">*</span></label> 
						<div class="col-lg-2">
						<input class="form-control" autocomplete="off" type="text" name="qty_po" required >
						</div>
						<label class="col-lg-1 control-label">Kgs</label> 				
						
						</div>					
						<div class="form-group form-md-line-input">
						<label class="col-lg-2 control-label"><?=lang('item_name')?> <span class="text-danger">*</span></label>
						<div class="col-lg-4">
							<select id="select2-item" style="width:300px" style="height:250px" name="item_id" required>
								<option value=""></option>
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
							<option value=""></option>
							<?php foreach ($clients as $client): ?>
							<option value="<?=$client->client_id?>"><?=$client->client_name?></option>
							<?php endforeach; ?>						
							</select>
						</div> 
						<label class="col-lg-3 control-label"><?=lang('tolerence')?></label> 
						<div class="col-lg-2">
						<input class="form-control" type="text"  value="0" name="tolerence" >
						</div> 
						<label class="col-lg-1 control-label">%</label> 
						</div>
						
						<div class="line"></div>	
						
						<div class="form-group form-md-line-input">
						<label class="col-lg-2 control-label"><?=lang('port_name')?></label> 
						<div class="col-lg-4">
							<input class="form-control" type="hidden"  name="port_id" value="<?=$port_id?>">
							<input class="form-control" type="text"  name="port_name" value="<?=$port_name?>" readonly>
						</div>
						
						<label class="col-lg-3 control-label"><?=lang('shipping_name')?></label> 
						<div class="col-lg-3">
						<input class="form-control" type="text"  name="shipping_name" autocomplete="off">
						</div>
						</div>
						
 						<div class="form-group form-md-line-input">
						<label class="col-lg-2 control-label"><?=lang('steve_name')?></label> 
						<div class="col-lg-4">
							<input class="form-control" type="text"  name="stevedore_name" autocomplete="off">
						</div> 
						<label class="col-lg-3 control-label"><?=lang('bl/awb')?></label> 
						<div class="col-lg-3">
						<input class="form-control" type="text"  name="bl_doc" autocomplete="off">
						</div>
						</div>					
						
						<hr>

				



						
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
		<aside class="aside-xl bg-white b-l hide" id="subNav">

			<header class="dk header b-b">

			<div class="btn-group pull-right">


			</div>

			<p class="h4"><?=lang('vessel_actived')?></p>
			</header>
			
			<section class="vbox">
			<section class="scrollable w-f">
			<div id="vessel_active_list" ></div>
			</section>
			</section>
		</aside> 
	</section> 
		<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> 
</section>

<!-- end -->