<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title"><?=lang('new_ticket')?></h4>
		</div>
		<?php
			$attributes = array('class' => 'bs-example form-horizontal');
			echo form_open(base_url().'tickets/view/add',$attributes); ?>
			<div class="modal-body">
				<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('subject')?> <span class="text-danger">*</span></label>
				<div class="col-lg-8">
					<input type="text" name="subject"  class="form-control" maxlength="255">
				</div>
				</div>
				<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('description')?> <span class="text-danger">*</span></label>
				<div class="col-lg-8">
					<textarea name="description" class="form-control"></textarea>
				</div>
				</div>
				<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('attachemnt')?> <span class="text-danger">*</span></label>
				<div class="col-lg-8">
					<textarea name="description" class="form-control"></textarea>
				</div>
				</div>					
			</div>
		<div class="modal-footer"><a href="#" class="btn btn-default" data-dismiss="modal">Close</a> 
		<button type="submit" class="btn btn-info"><?=lang('save')?></button>
		</form>
		</div>
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->