<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
   <!-- <aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">
              <!--<a href="#aside" data-toggle="class:show" class="btn btn-sm green pull-right"><i class="fa fa-plus"></i> <?=lang('new_cash_advance_type')?></a>-->
              <a  class="btn btn-sm green" onclick="add_cash_advance_type()"><i class="fa fa-plus"></i> <?=lang('new_cash_advance_type')?></a>
            </div>
            <p class="pull-left"><?=lang('cash_advance_type_details')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive"><?php echo validation_errors(); ?>
                  <table id="tbl-projects" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th width="10%"><?=lang('options')?></th>
                        <th><?=lang('cash_advance_type_code')?> </th>
						<th><?=lang('cash_advance_type_name')?> </th>
						<th><?=lang('advance_by_jo')?> </th>
						<th><?=lang('advance_only_driver')?> </th>
						<th><?=lang('advance_fare_trip')?> </th>
                      </tr> </thead> <tbody>
                      <?php
                      if (!empty($cash_advance_types)) {
                      foreach ($cash_advance_types as $cash_advance_type) { ?>
                      <tr>
                        <td>
							  <div class="btn-group">
								<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
								 <?=lang('options')?>
								<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a  href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_cash_advance_type(<?=$cash_advance_type->rowID ?>)"><i class="fa fa-pencil"></i> <?=lang('update_option')?></a></li>
                                    <li><a  href="javascript:void()" title="<?=lang('delete_option')?>" onclick="delete_cash_advance_type(<?=$cash_advance_type->rowID ?>)"><i class="fa fa-trash-o"></i> <?=lang('delete_option')?></a></li>
								</ul>
                                
							  </div>
						</td>
						<td><?=$cash_advance_type->advance_cd?></td>
						<td><?=$cash_advance_type->advance_name?></td>
						<td><?=$cash_advance_type->by_jo?></td>
						<td><?=$cash_advance_type->only_driver?></td>
						<td><?=$cash_advance_type->fare_trip?></td>

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
  <!--</aside>-->
  <!-- /.aside -->

  <!-- .aside -->
  <!--
<aside class="aside-xxl bg-white b-l hide" id="aside">
    <section class="vbox">
		<section class="scrollable wrapper">
			<?php
			echo form_open(base_url().'cash_advance_type/create'); ?>
			<?php echo validation_errors(); ?>
	
		<div class="form-group form-md-line-input">
			<label><?=lang('cash_advance_type_code')?> <span class="text-danger">*</span></label>
			<input type="text" name="cash_advance_type_code" placeholder="Input Code"  maxlength="6"  autocomplete="off" class="input-sm form-control" required>
		</div>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('cash_advance_type_name')?> <span class="text-danger">*</span></label>
			<input type="text" name="cash_advance_type_name" placeholder="Input Name"  maxlength="50"  autocomplete="off" class="input-sm form-control" required>
		</div>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('advance_by_jo')?> <span class="text-danger">*</span></label>
			<select id="advance_by_jo" class="form-control" name="advance_by_jo" >	
				<option value="0">Select</option>
				<option value="Y">Yes</option>
				<option value="N">No</option>
			</select>
		</div>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('advance_only_driver')?> <span class="text-danger">*</span></label>
			<select id="advance_only_driver" class="form-control" name="advance_only_driver" >	
				<option value="0">Select</option>
				<option value="Y">Yes</option>
				<option value="N">No</option>
			</select>
		</div>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('advance_fare_trip')?> <span class="text-danger">*</span></label>
			<select id="advance_fare_trip" class="form-control" name="advance_fare_trip" >	
				<option value="0">Select</option>
				<option value="Y">Yes</option>
				<option value="N">No</option>
			</select>
		</div>
		
		<button type="submit" class="btn btn-sm btn-success"><?=lang('add_cash_advance_type')?></button>
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
        <h3 class="modal-title"></h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>

        <input type="hidden" name="rowID" value="">
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('cash_advance_type_code')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" class="input-sm form-control" value="" name="cash_advance_type_code" maxlength="6" autocomplete="off"  placeholder="Input <?=lang('cash_advance_type_code')?>" required>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('cash_advance_type_name')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text"  value="" name="cash_advance_type_name" placeholder="Input <?=lang('cash_advance_type_name')?>" autocomplete="off" class="input-sm form-control" required>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('advance_by_jo')?><span class="text-danger">*</span></label>
            <div class="col-md-8">
			<select id="advance_by_jo" name="advance_by_jo" class="form-control" required>
                        <option value="Y">Yes</option>
						<option value="N">No</option>
			</select>
            </div>
	   </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('advance_only_driver')?><span class="text-danger">*</span></label>
            <div class="col-md-8">
			<select id="advance_only_driver" name="advance_only_driver" class="form-control" required>
                        <option value="Y">Yes</option>
						<option value="N">No</option>
			</select>
            </div>
	   </div>
       
       <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('advance_fare_trip')?><span class="text-danger">*</span></label>
            <div class="col-md-8">
			<select id="advance_fare_trip" name="advance_fare_trip" class="form-control" required>
                        <option value="Y">Yes</option>
						<option value="N">No</option>
			</select>
            </div>
	   </div>



        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_cash_advance_type()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>