<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('delete_department')?></h4>
		</div><?php
			echo form_open(base_url().'department/view/delete'); ?>
		<div class="modal-body">
<?php
			if (!empty($department_details)) {
				foreach ($department_details as $key => $department) { ?>

					<input type="hidden" name="row_id" value="<?=$department->rowID?>">				 
					
					<p><?=lang('department_cd')?><span class="tab"> :</span><b><?=$department->dep_cd?></b></p>
					<p><?=lang('department_name')?><span class="tab"> :</span><b><?=$department->dep_name?></b></p>
					<p><?=lang('delete_department_warning')?> </p>
		<?php }}?>
		</div>
		<div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a>
			<button type="submit" class="btn red"><?=lang('delete_button')?></button>
		</form>
	</div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->