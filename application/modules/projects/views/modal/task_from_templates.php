<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title"><?=lang('add_task')?></h4>
		</div>
		
					<?php
			 $attributes = array('class' => 'bs-example form-horizontal');
          echo form_open(base_url().'projects/tasks/add_from_template',$attributes); ?>
          <input type="hidden" name="project" value="<?=$this->uri->segment(4)/1200?>">
		<div class="modal-body">
			<p><?=lang('email_sending_warning')?></p>
				<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('templates')?> <span class="text-danger">*</span></label>
				<div class="col-lg-8">
				<select name="template_id" class="form-control">
					<?php
					if (!empty($saved_tasks)) {
					foreach ($saved_tasks as $key => $task) { ?>
						<option value="<?=$task->template_id?>"><?=ucfirst($task->task_name)?></option>
					<?php } } ?>					
				</select>
				</div>
				</div>
			
		</div>
		<div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a> 
		<button type="submit" class="btn btn-dark"><?=lang('add_task')?></button>
		</form>
		</div>
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->