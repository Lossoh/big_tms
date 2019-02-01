
<div class="modal-dialog" id="add_modal">
	<div class="modal-content">

		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title"><?=lang('delete_party')?></h4>
		</div>
					
		<?php 

		$attributes = array('class' => 'bs-example form-horizontal');
        echo form_open(base_url().'vessels/manage/delete_party',$attributes); ?>          

		<div class="modal-body">

					<?php
			if (!empty($document_details)) {
				foreach ($document_details as $key => $document_detail) { ?>
			<input type="hidden" name="vessel_id" value="<?=$document_detail->vessel_id?>">
			<input type="hidden" name="document_id" value="<?=$document_detail->document_id?>">

			<div class="form-group form-md-line-input">
				<label class="col-lg-4 control-label"><?=lang('date_time')?> </label>
					<div class="col-lg-8">
						<input type="text" class="form-control"  value="<?=$document_detail->document_id?> " disabled>
					</div>
			</div>
			
			<div class="form-group form-md-line-input">
			<label class="col-lg-4 control-label"><?=lang('description')?></label>
				<div class="col-lg-8">
					<input type="text" class="form-control"  value="<?=$document_detail->party_name?> " disabled>
				</div>
			</div>				
		</div>
		<div class="modal-footer"><a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a> 
		<button type="submit" class="btn green"><?=lang('delete_party')?></button>
		</form>
<?php }}?>
		</div>
	</div>
</div>

