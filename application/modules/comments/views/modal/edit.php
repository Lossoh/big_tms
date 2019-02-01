<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title"><?=lang('edit')?> <?=lang('case')?></h4>
		</div>

		<?php
			$attributes = array('class' => 'bs-example form-horizontal');
			echo form_open(base_url().'comments/view/edit',$attributes); ?>
		
			<div class="modal-body">
			
			<?php 
			if (!empty($case_details)) {
				foreach ($case_details as $key => $case_detail) { ?>			
				<div class="form-group form-md-line-input">	
					<label class="col-lg-4 control-label"><?=lang('edit')?> <?=lang('case')?></label>	
					<div class="col-lg-8">
						<input type="text" class="form-control" name="case_description" value="<?=$case_detail->case_description?>">
					</div>					
					
					<input type="hidden" name="rowID" value="<?=$case_detail->rowID?>">
				</div>							
			</div>
		<div class="modal-footer"><a href="#" class="btn btn-default" data-dismiss="modal">Close</a> 
		<button type="submit" class="btn btn-info"><?=lang('save')?></button>
		</form>
		<?php }}else{echo lang('data_not_found');} ?> 
		</div>
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->