<script>

$(document).ready(function() {
    
    $("#edit_modal").modal({backdrop: false}).modal("show");
    $("#item_id").select2();


});
</script>

<div class="modal-dialog" id="edit_modal">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('edit_palka')?></h4>
		</div>
		
						
		<?php
			$attributes = array('class' => 'bs-example form-horizontal');
			echo form_open(base_url().'vessels/manage/edit_palka',$attributes); ?>
			<?php
			if (!empty($palka_details)) {
				foreach ($palka_details as $key => $palka) { ?>
				<div class="modal-body">
					
					
				 
					<div class="form-group form-md-line-input">
					
					<label class="col-lg-4 control-label"><?=lang('palka_name')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="hidden" name="palka_id" value="<?=$palka->palka_id?>">
						<input type="text" class="form-control" value="<?=lang($palka->Nm_Ref)?>" name="palka_name" readonly>
					</div>
					</div>
					<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('vessel_name')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="hidden" name="vessel_id" value="<?=$palka->vessel_id?>">
						<input type="text" class="form-control" value="<?=$palka->vessel_name?>" name="vessel_name" readonly>
					</div>
					</div>
				
				<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('item_name')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<?php if($palka->ttl_unload_item>0){ ?>
							<input type="hidden" name="item_id" value="<?=$palka->item_id?>">
							<input type="text" class="form-control" value="<?=$palka->item_name?>" name="item_name" readonly>
						<?php }else{?>
						  <select id="item_id" style="width:260px" name="item_id" required> 			          
						  <optgroup label="Items"> 
						  <option value="<?=$palka->item_id?>" ><?=$palka->item_name?></option>				
						  <?php foreach ($items as $item): ?>
							<option value="<?=$item->item_id?>"><?=$item->item_name?></option>
						  <?php endforeach; ?>
						  </select> 
						  <?php }?>
					</div>
					</div>	
				<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('total_item_palka')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?=$palka->ttl_item?>" name="ttl_item">
					</div>
					</div>		
								
				</div>
				<div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a> 
				<button type="submit" class="btn green"><?=lang('save_changes')?></button>
				</form>
				<?php }} ?>
				</div>
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->