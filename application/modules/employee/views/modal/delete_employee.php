<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('employee_delete')?></h4>
		</div><?php
			echo form_open(base_url().'employee/view/delete'); ?>
		<div class="modal-body">
<?php
			if (!empty($employee_details)) {
				foreach ($employee_details as $key => $employee_detail) { ?>

					<input type="hidden" name="row_id" value="<?=$employee_detail->rowID?>">				 
					
					<p><?=lang('employee_code')?><span class="tab"> :</span><b><?=$employee_detail->debtor_cd?></b></p>
					<p><?=lang('employe_name')?><span class="tab"> :</span><b><?=$employee_detail->debtor_name?></b></p>
					<p><?=lang('delete_employee_warning')?> </p>
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