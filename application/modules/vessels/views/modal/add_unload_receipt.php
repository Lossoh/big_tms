<script>
$(document).ready(function() {
    
    $("#add_modal").modal({backdrop: false}).modal("show");
    $("#select2-option").select2();

    $("#select2-option").change(function(){
        var truck_id = $("#select2-option").val();  
        $.ajax({
            type: "POST",
            url : "<?php echo base_url('vessels/manage/get_truck_detail'); ?>",
			data: "truckid="+truck_id,
            cache:false,
            success: function(data){				
                $('#truck_detail').html(data);
            },
			error: function(xhr, status, error) {				  
				document.write(xhr.responseText);
				alert(xhr.responseText);
			}
        });
    });	

});
</script>

<div class="modal-dialog" id="add_modal">
	<div class="modal-content">

		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title"><?=lang('add_unload_receipt')?></h4>
		</div>
					
		<?php 

		$attributes = array('class' => 'bs-example form-horizontal');
        echo form_open(base_url().'vessels/manage/add_unload_receipt',$attributes); ?>          

		<div class="modal-body">

					<?php
			if (!empty($vessel)) {
				foreach ($vessel as $key => $vesselz) { ?>
			<input type="text" name="vessel_id" value="<?=$vesselz->vessel_id?>">
			<input type="hidden" name="vessel_init" value="<?=$vesselz->vessel_init?>">
			<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('truck_name')?> <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<select id="select2-option" style="width:150px" style="height:250px" name="truck_id" required>	       
						<option value=""></option>								
						<optgroup label="Trucks">										
						<?php foreach ($trucks as $truck): ?>
						<option value="<?=$truck->truck_id?>"><?=$truck->truck_ref?></option>
						<?php endforeach; ?>
						</select>
					</div>
			</div>
			<div id="truck_detail"></div>
			
			<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('no_bon_muat')?></label>
				<div class="col-lg-6">
					<input type="text" class="form-control" value="<?=set_value('no_bon_muat')?>" placeholder="Input No Bon Muat Manual" name="no_bon_muat" required autocomplete="off" maxlength="8">
			</div>
			</div>	
			<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('driver_name')?> <span class="text-danger">*</span></label>
				<div class="col-lg-8">
					<input type="text" class="form-control" value="<?=set_value('driver_name')?>" placeholder="Input Driver Name" name="driver_name" required autocomplete="off">
				</div>
			</div>	
			<div class="form-group form-md-line-input">
			<label class="col-lg-4 control-label"><?=lang('description')?></label>
				<div class="col-lg-8">
					<textarea name="description" placeholder="Input Description" class="form-control" maxlength="255" rows="8"></textarea>
				</div>
			</div>				
		</div>
		<div class="modal-footer"><a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a> 
		<button type="submit" class="btn green"><?=lang('add_unload_receipt')?></button>
		</form>
<?php }}?>
		</div>
	</div>
</div>

