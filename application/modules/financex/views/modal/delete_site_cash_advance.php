<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('delete_site_cash_advance')?></h4>
		</div><?php
			echo form_open(base_url().'site_cash_advance/delete'); ?>
		<div class="modal-body">
		<?php
			if (!empty($site_cash_advance_details)) {
				foreach ($site_cash_advance_details as $key => $site_cash_advance_detail) { ?>
					<input type="hidden" name="year" value="<?=$site_cash_advance_detail['year']?>">
					<input type="hidden" name="month" value="<?=$site_cash_advance_detail['month']?>">
					<input type="hidden" name="code" value="<?=$site_cash_advance_detail['code']?>">
					<p><?=lang('site_cash_advance_no')?><span class="tab"> :</span><b>&nbsp;<?=$site_cash_advance_detail['advance_no']?></b></p>
					<p><?=lang('site_cash_advance_date')?><span class="tab"> :</span><b>&nbsp;<?=$site_cash_advance_detail['advance_date']?></p>
					<p><?=lang('delete_site_cash_advance_warning')?> </p>
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