<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title"><?=lang('inactivated')?></h4>
		</div>
		<?php
			$attributes = array('class' => 'bs-example form-horizontal');
			echo form_open(base_url().'comments/view/inactivated',$attributes); ?>
			<div class="modal-body">
				<div class="form-group form-md-line-input">
					<label class="col-lg-4 control-label"><?=lang('inactivated')?> Case</label>
					<input type="hidden" name="rowID" value="<?=$rowID?>">

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