<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('delete_expenses')?></h4>
		</div><?php
			echo form_open(base_url().'expense/view/delete'); ?>
		<div class="modal-body">
		<?php
			if (!empty($expense_details)) {
				foreach ($expense_details as $key => $expense_detail) { ?>

					<input type="hidden" name="row_id" value="<?=$expense_detail->rowID?>">				 
					
					<p><?=lang('expenses_code')?><span class="tab"> :</span><b><?=$expense_detail->expense_cd?></b></p>
					<p><?=lang('expenses_name')?><span class="tab"> :</span><b><?=$expense_detail->descs?></b></p>
					<p><?=lang('delete_expenses_warning')?> </p>
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