<div class="modal-dialog" id="add_modal">
	<div class="modal-content">

		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title"><?=lang('add_memo')?></h4>
		</div>
					
		<?php 

		$attributes = array('class' => 'bs-example form-horizontal');
        echo form_open(base_url().'vessels/manage/add_memo',$attributes); ?>          

		<div class="modal-body">

					<?php
			if (!empty($vessel)) {
				foreach ($vessel as $key => $vesselz) { ?>
			<input type="hidden" name="vessel_id" value="<?=$vesselz->vessel_id?>">
			<input type="hidden" name="vessel_init" value="<?=$vesselz->vessel_init?>">


			<div class="form-group form-md-line-input">
			<label class="col-lg-4 control-label"><?=lang('description')?></label>
				<div class="col-lg-8">
					<textarea name="description" placeholder="Input Description" class="form-control" maxlength="255" rows="8"></textarea>
				</div>
			</div>				
		</div>
		<div class="modal-footer"><a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a> 
		<button type="submit" class="btn green"><?=lang('add_memo')?></button>
		</form>
<?php }}?>
		</div>
	</div>
</div>

