
<script>
$('#test').select2({
    width: "300px"
}).one('select2-focus', select2Focus).on("select2-blur", function () {
    $(this).one('select2-focus', select2Focus)
})
//select2-option
$('#test1').select2({
    width: "300px"
}).one('select2-focus', select2Focus).on("select2-blur", function () {
    $(this).one('select2-focus', select2Focus)
})
$('#tes').select2({
    width: "300px"
}).one('select2-focus', select2Focus).on("select2-blur", function () {
    $(this).one('select2-focus', select2Focus)
})
function select2Focus() {
    var select2 = $(this).data('select2');
    setTimeout(function() {
        if (!select2.opened()) {
            select2.open();
        }
    }, 0);  
}

</script>




<section id="content">
	<section class="hbox stretch">	
		<aside class="aside-md bg-white b-r hidden-print" id="subNav">

			<header class="dk header b-b">
			
			<div class="btn-group pull-right">
				<button class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"><?=lang('filter')?>
				<span class="caret"></span>
				</button>
				<ul class="dropdown-menu">	
				<li><a href="<?=base_url()?>vessels/view_by_status/">ALL</a></li>
				<?php foreach ($vessel_status as $status): ?>
					<li><a href="<?=base_url()?><?=$status->Kondisi_Ref_Char_02?><?=$status->No_Urut_Ref?>"><?=lang($status->Kondisi_Ref_Char_03)?></a></li>
				<?php endforeach; ?>
				
				</ul>
			</div>
			
			<a href="<?=base_url()?>vessels/manage/add" data-original-title="<?=lang('create_vessel')?>" data-toggle="tooltip" data-placement="bottom" class="btn btn-icon btn-default btn-sm pull-right"><i class="fa fa-plus"></i></a>
			<p class="h4"><?=lang('all_vessels')?></p>
			</header>
			
			<section class="vbox">
			 <section class="scrollable w-f">
			   <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
				<ul class="nav">
				<?php 
				if (!empty($vessels)) {
				foreach ($vessels as $key => $vessel) { ?>		
					<li class="b-b b-light <?php if($vessel->vessel_id == $this->uri->segment(4)){ echo "bg-light dk"; } ?>"><a href="<?=base_url()?>vessels/manage/details/<?=$vessel->vessel_id?>">
					<?=$vessel->vessel_ref?> - <?=$vessel->vessel_name?>
					<div class="pull-right">
					<span class="label label-<?=$vessel->Kondisi_Ref_Char_01?>"><?=$vessel->Nm_Ref?></span>
					</div> <br>
					<small class="block small text-muted"><?=$vessel->vessel_init?> | <?=strftime("%b %d, %Y", strtotime($vessel->date_created));?></small>

				</a> </li>
				<?php } } ?>
				</ul> 
				</div>
			</section>
			</section>
		</aside> 
			
		<aside>
			<section class="vbox">
				<header class="header bg-white b-b clearfix hidden-print">
					<div class="row m-t-sm">
						<?php 
						if (!empty($vessel_details)) {
						foreach ($vessel_details as $key => $vessel) { ?>	
						<div class="col-sm-8 m-b-xs">
						
						
						
						<div class="btn-group">
						<button class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"><?=lang('set_status')?>
						<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
						
						<?php foreach ($vessel_status as $status): ?>
							<li><a href="<?=base_url()?><?=$status->Kondisi_Ref_Char_04?><?=$status->No_Urut_Ref?>/<?=$vessel->vessel_id?>"><?=lang($status->Kondisi_Ref_Char_03)?></a></li>
						<?php endforeach; ?>						
						</ul>
						</div>					
						
						
						<div class="btn-group">
						<button class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
						<?=lang('more_actions')?>
						<span class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="<?=base_url()?>vessels/manage/edit/<?=$vessel->vessel_id?>"><?=lang('edit_vessel')?></a></li>
							<li><a href="<?=base_url()?>vessels/manage/delete/<?=$vessel->vessel_id?>" data-toggle="ajaxModal"><?=lang('delete_vessel')?></a></li>
											
							<li><a href="<?=base_url()?>vessels/manage/document_vessel/<?=$vessel->vessel_id?>"><?=lang('document_vessel')?></a></li>
								
						</ul>
						</div>
						
						
						</div>
						<div class="col-sm-4 m-b-xs">
printing 
					
						</div>
					</div> 
				</header>
				<section class="scrollable wrapper w-f">
					<section class="scrollable wrapper">
						<div class="row"> 
	
					<center><p class="h3"><strong><?=$vessel->vessel_ref?> - <?=$vessel->vessel_name?></strong></p></center>

							<center><p class="h5"><strong>DOCUMENT VESSEL</strong></p></center>
							
							
						</div>
				
					<div class="line"></div>
					
					<div class="col-sm-12">
					<?php
						$attributes = array('class' => 'bs-example form-horizontal');
						echo form_open(base_url().'invoices/manage/add',$attributes); ?>
						<?php echo validation_errors(); ?>
						<div class="form-group form-md-line-input">
						<label class="col-lg-2 control-label"><?=lang('party_name')?> <span class="text-danger">*</span></label>
						<div class="select2-wrapper">
							<select id="test1" class="form-control"  name="party_id" >  
							<option value="1">1</option>
							<option value="2">2</option>	 							
							<?php foreach ($parties as $party): ?>
							<option value="<?=$party->party_id?>"><?=$party->party_name?></option>
							<?php endforeach; ?>						
							</select>						
						</div>

						</div>
						
						<div class="form-group form-md-line-input">
						<label class="col-lg-2 control-label"><?=lang('po_date')?></label> 
						<div class="col-lg-8">
						<input class="input-sm input-s datepicker-input form-control" size="16" type="text" value="<?=date('d-m-Y')?>" name="due_date" data-date-format="dd-mm-yyyy" >
						</div> 
						</div> 
						
						<div class="form-group form-md-line-input">
						<label class="col-lg-2 control-label"><?=lang('po_ref')?></label> 
						<div class="col-lg-4">
						<input style="height:30px" type="text" name="ttl_item" placeholder="Input total of item on palka" class="form-control">
						</div> 
						</div>
						
						
						<div class="form-group form-md-line-input">
						<label class="col-lg-2 control-label"><?=lang('item_name')?> <span class="text-danger">*</span></label>
						<div class="col-lg-3">
							<select id="tes" style="width:300px" style="height:250px" name="item_id" required>		          
								
								<option value="1">1</option>
							<option value="2">2</option>
								<?php foreach ($items as $item): ?>
								<option value="<?=$item->item_id?>"><?=$item->item_name?></option>
								<?php endforeach; ?>
							</select> 					
						</div>

						</div>
						
						<div class="form-group form-md-line-input">
						<label class="col-lg-2 control-label"><?=lang('client')?></label> 
						<div class="col-lg-4">
							<select  id="test" style="height:30px"  name="party_id" class="form-control">
							<option value="1">1</option>
							<option value="2">2</option>							
							<?php foreach ($clients as $client): ?>
							<option value="<?=$client->client_id?>"><?=$client->client_name?></option>
							<?php endforeach; ?>						
							</select>
						</div> 
						</div>

		

		
						
						
						
						
						
						
						
						
						
						
						
						
						
						
					</div>
					
					
					<table class="table" width="100%">
					<thead>
					<tr>
					<th width="20%"><?=lang('party')?> </th>
					<th width="35%"><?=lang('item_id')?> </th>					
					<th width="15%"><?=lang('total_item_palka')?> </th>
					<th width="15%"><?=lang('total_item_unload')?> </th>
					<th width="10%"><?=lang('total_difference')?> </th>
					<th><?=lang('options')?> </th>
					</tr> 
					</thead>
					<tbody>
					<?php
					if (!empty($vessel_items)) {
					foreach ($vessel_items as $key => $vessel_item) { ?>
					<tr>
						<td width="20%"><?=$vessel_item->palka_id?> </td>
						<td width="35%"><?=$vessel_item->item_name?></td>
						<td width="15%"><?=$vessel_item->ttl_item?></td>
						<td width="15%"><?=$vessel_item->ttl_unload_item?></td>
						<td width="10%"><?=$vessel_item->ttl_item-$vessel_item->ttl_unload_item?>
						<input type="hidden" name="ttl" value="<?=$total=$total+$vessel_item->ttl_item-$vessel_item->ttl_unload_item?>">
						
						
						</td>
						<td>
						
						<a href="<?=base_url()?>vessels/manage/edit_palka/<?=$vessel_item->palka_id?>/<?=$vessel_item->vessel_id?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('edit')?>"><i class="fa fa-edit"></i> </a>
						<?php if($vessel_item->ttl_unload_item == 0){?>
						
							<a href="<?=base_url()?>vessels/manage/delete_palka/<?=$vessel_item->palka_id?>/<?=$vessel_item->vessel_id?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('delete')?>"><i class="fa fa-trash-o text-danger"></i></a>
						<?php } ?>
						
						
						
						</td>
						
					</tr>
					
					
					
					<?php } } ?>
					
						<tr><td></td><td></td><td></td><td></td><td><?=$item_sum-$unload_item_sum?></td></tr>
						<tr>
						
						<?php     
							$attributes = array('class' => 'bs-example form-horizontal');
							echo form_open(base_url().'vessels/manage/item', $attributes); ?>
							<input type="hidden" name="vessel_id" value="<?=$vessel->vessel_id?> ">
							<td width="20%">
								<select style="height:30px"  name="party_id" class="form-control">         
								
								<?php foreach ($parties as $party): ?>
								<option value="<?=$party->party_id?>"><?=$party->party_name?></option>
								<?php endforeach; ?>
							
								</select>
							</td>
							<td width="35%" >
								<select id="e" style="width:300px" style="height:250px" name="item_id" required>		          
								<optgroup label="Items"> 
								<?php foreach ($items as $item): ?>
								<option value="<?=$item->item_id?>"><?=$item->item_name?></option>
								<?php endforeach; ?>
								</select> 
							</td>
							<td width="15%">
								<input style="height:30px" type="text" name="ttl_item" placeholder="Input total of item on palka" class="form-control">
							</td> 					
							<td><button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> <?=lang('save')?></button></td>
							</form>
						</tr>


					</tbody>
					</table>
					</section> 


					


					
					<?php } } ?>

					 <!-- End display details -->






					</section>  




			</section> 
		</aside> 
	</section> 
		<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> 
</section>
<script>
	$( ".select2" ).select2( { placeholder: "Select a State", maximumSelectionSize: 6 } );

	$( ":checkbox" ).on( "click", function() {
		$( this ).parent().nextAll( "select" ).select2( "enable", this.checked );
	});

	$( "#demonstrations" ).select2( { placeholder: "Select2 version", minimumResultsForSearch: -1 } ).on( "change", function() {
		document.location = $( this ).find( ":selected" ).val();
	} );

	$( "button[data-select2-open]" ).click( function() {
		$( "#" + $( this ).data( "select2-open" ) ).select2( "open" );
	});
</script>
<!-- end -->