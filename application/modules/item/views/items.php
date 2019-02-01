<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <aside>
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">
              <a  class="btn btn-sm green" onclick="add_item()"><i class="fa fa-plus"></i> <?=lang('new_item')?></a>
              <a  class="btn btn-sm red" onclick="item_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
              <a  class="btn btn-sm btn-success" onclick="item_excel()"><i class="fa fa-file-excel-o"></i> Print Excel</a>
            </div>
            <p class="pull-left"><?=lang('item_details')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive"><?php echo validation_errors(); ?>
                  <table id="tbl-projects" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th><?=lang('options')?></th>
                        <th><?=lang('item_code')?> </th>
						<th><?=lang('item_name')?> </th>
						<th><?=lang('minimum')?> </th>
						<th><?=lang('maximum')?> </th>
						<th><?=lang('uom_name')?> </th>
						<!--<th><?=lang('actions')?> </th>-->
                      </tr> </thead> <tbody>
                      <?php
                      if (!empty($items)) {
                      foreach ($items as $item) { ?>
                      <tr>
                            <td>
							  <div class="btn-group">
								<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
								 <?=lang('options')?>
								<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a  href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_item(<?=$item->rowID ?>)"><i class="fa fa-pencil"></i> <?=lang('update_option')?></a></li>
                                    <li><a  href="javascript:void()" title="<?=lang('delete_option')?>" onclick="delete_item(<?=$item->rowID ?>)"><i class="fa fa-trash-o"></i> <?=lang('delete_option')?></a></li>
								</ul>
                                
							  </div>
							</td>
						<td><?=$item->item_cd?></td>
						<td><?=$item->item_name?></td>
						<td><?=number_format($item->minimum,0,',','.')?></td>
						<td><?=number_format($item->maximum,0,',','.')?></td>
						<td><?=$item->descs?></td>
                        <!--<td>
					  	<a href="<?=base_url()?>item/view/update/<?=$item->rowID?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('edit')?>"><i class="fa fa-edit"></i> </a>
                        <a href="<?=base_url()?>item/view/delete/<?=$item->rowID?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('delete')?>"><i class="fa fa-trash-o"></i></a>
                      </td>-->
                    </tr>
                    <?php } } ?>
                  </tbody>
                </table>
              </div>
            </section>            
          </div>
        </div>
      </section>

    </section>
  </aside>
  <!-- /.aside -->
  </section> 
  <!-- .aside -->
  <!--
<aside class="aside-xxl bg-white b-l hide" id="aside">
    <section class="vbox">
		<section class="scrollable wrapper"> 
			<?php
			echo form_open(base_url().'item/create'); ?>
			<?php echo validation_errors(); ?>
	
		<div class="form-group form-md-line-input">
			<label><?=lang('item_code')?> <span class="text-danger">*</span></label>
			<input type="text" name="item_code" placeholder="Input Item Code"  maxlength="10"  autocomplete="off" class="input-sm form-control" required>
		</div>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('item_name')?> <span class="text-danger">*</span></label>
			<input type="text" name="item_name" placeholder="Input Item Name" autocomplete="off" class="input-sm form-control" required>
		</div>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('item_uom')?> <span class="text-danger">*</span></label>
			<select name="uom_id" class="form-control" id="uom_id">
				<option value="">Select</option>
					<?php
					if (!empty($uoms)) {
							  foreach ($uoms as $uom) { ?>
							  <option value="<?=$uom->rowID?>"><?=$uom->uom_cd?>&nbsp;-&nbsp<?=$uom->descs?></option>
					<?php }}?>
			</select>
		</div>
		
		<button type="submit" class="btn btn-sm btn-success"><?=lang('add_item')?></button>
		<hr>
		</form>
   
		</section>
	</section>   
</aside>
-->
<!-- /.aside -->


  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog" style="width:600px;height:200px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?=lang('new_debtor_type')?></h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>

        <input type="hidden" name="rowID" value="">
        	
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('item_code')?> <span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" class="form-control"  name="item_code" placeholder="Input Item Code"  maxlength="10"  autocomplete="off"  required>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('item_name')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" class="form-control" name="item_name" placeholder="Input Item Name" autocomplete="off" required>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('minimum')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" class="form-control angka_ribuan" name="minimum" placeholder="Input Minimum" autocomplete="off" required>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('maximum')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" class="form-control angka_ribuan" name="maximum" placeholder="Input Maximum" autocomplete="off" required>
            </div>
        </div>
        
  		<div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('item_uom')?><span class="text-danger">*</span></label>
            <div class="col-md-8">
			<select name="uom_id" id="uom_id" class="form-control" required>
				   <?php
                      if (!empty($uoms)) {
                      foreach ($uoms as $uom) { ?>
					  <option value="<?=$uom->rowID?>"><?=$uom->uom_cd?>&nbsp;-&nbsp<?=$uom->descs?></option>
					  
			<?php }}?>
			</select>
            </div>
		</div>
        
              
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_item()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
