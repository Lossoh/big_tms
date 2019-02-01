
<div class="modal-dialog" id="add_modal">
	<div class="modal-content">

		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title"><?=lang('edit_memo')?></h4>
		</div>
					
		<?php 

		$attributes = array('class' => 'bs-example form-horizontal');
        echo form_open(base_url().'vessels/manage/edit_memo',$attributes); ?>          

		<div class="modal-body">

					<?php
			if (!empty($memo_details)) {
				foreach ($memo_details as $key => $memo_detail) { ?>
			<input type="hidden" name="vessel_id" value="<?=$memo_detail->vessel_id?>">
			<input type="hidden" name="memo_id" value="<?=$memo_detail->memo_id?>">

			<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('date_time')?> </label>
					<div class="col-lg-8">
						<input type="text" class="form-control"  value="<?=$memo_detail->memo_date?> <?=$memo_detail->memo_time?>" disabled>
					</div>
			</div>
			
			<div class="form-group form-md-line-input">
			<label class="col-lg-4 control-label"><?=lang('description')?></label>
				<div class="col-lg-8">
					<textarea name="description" class="form-control" maxlength="255" rows="8"><?=$memo_detail->description?></textarea>
				</div>
			</div>				
		</div>
		<div class="modal-footer"><a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a> 
		<button type="submit" class="btn green"><?=lang('edit_memo')?></button>
		</form>
<?php }}?>
		</div>
	</div>
</div>

