<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('delete_option')?> <?=lang('cash_advance')?></h4>
		</div>
		<?php
			echo form_open(base_url().'finances/delete_cash_advance'); 
		?>
		<div class="modal-body">
		<?php
			if (!empty($ca_list)) {
				foreach ($ca_list as $ca) { ?>
					<input type="hidden" name="prefix" value="<?=$ca->prefix?>">
					<input type="hidden" name="year" value="<?=$ca->year?>">
					<input type="hidden" name="month" value="<?=$ca->month?>">
					<input type="hidden" name="code" value="<?=$ca->code?>">
					<input type="hidden" name="advance_no" value="<?=$ca->advance_no?>">
					<p><?=lang('cash_advance')?><span class="tab"> :</span><b> <?=$ca->advance_no?></b></p>
					<p><?=lang('cash_advance')?> <?=lang('date')?><span class="tab"> :</span><b> <?= date("d F Y",strtotime($ca->advance_date))?></b></p>
					<p>Remark <span class="text-danger">*</span><span class="tab"> :</span> <textarea class="form-control" rows="3" name="remark_deleted" id="remark_deleted" maxlength="255" required=""></textarea></p>
		<?php }}?> 
		</div>
		<div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a>
			<button type="submit" class="btn red"><?=ucwords(lang('delete'))?></button>
		</form>
	</div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->