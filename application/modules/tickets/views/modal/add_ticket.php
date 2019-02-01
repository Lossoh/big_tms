<script>

$(document).ready(function() {
    

    $("#category_id").select2();
	$("#priority_id").select2();

});
</script>

<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title"><?=lang('new_ticket')?></h4>
		</div>		
		<?php
			$attributes = array('class' => 'bs-example form-horizontal');
			echo form_open_multipart(base_url().'tickets/add',$attributes); 
		?>
			

		<div class="modal-body">
			<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('category')?><span class="text-danger">*</span></label>
				<div class="col-lg-8">
				<select id="category_id" style="width:150px" style="height:250px" name="category_id" required>		       
				<option value=""></option>								
				<optgroup label="Categories"> 
												
				<?php foreach ($categories as $category): ?>
				<option value="<?=$category->type_no?>"><?=$category->type_name?></option>
				<?php endforeach; ?>
				</select> 			
				</div>
			</div>
			
			<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('priority')?><span class="text-danger">*</span></label>
				<div class="col-lg-8">
				<select id="priority_id" style="width:150px" style="height:250px" name="priority_id" required>		       
				<option value=""></option>								
				<optgroup label="Priorities"> 
												
				<?php foreach ($priorities as $priority): ?>
				<option value="<?=$priority->type_no?>"><?=$priority->type_name?></option>
				<?php endforeach; ?>
				</select> 			
				</div>
			</div>			
			<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('subject')?><span class="text-danger">*</span></label>
				<div class="col-lg-8">
					<input type="text" name="subject"  class="form-control" maxlength="30">
				</div>			
			</div>
			
			<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('description')?><span class="text-danger">*</span></label>
				<div class="col-lg-8">
				<textarea name="description" class="form-control"></textarea>
				</div>
			</div>		
				
          	<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('attachment')?></label>
				<div class="col-lg-8">
					<input type="file" name="userfile">
				</div>
			</div>

			
		</div>
		<div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a> 
		<button type="submit" class="btn btn-success"><?=lang('upload_file')?></button>
		</form>
		</div>
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->