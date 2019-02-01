<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">
              <!--<a href="#aside" data-toggle="class:show" class="btn btn-sm green pull-right"><i class="fa fa-plus"></i> <?=lang('new_vehicle_category')?></a>-->
              <a  class="btn btn-sm green" onclick="add_vehicle_type()"><i class="fa fa-plus"></i> <?=lang('new_vehicle_category')?></a>
              <a  class="btn btn-sm red" onclick="vehicle_category_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
              <a  class="btn btn-sm btn-success" onclick="vehicle_category_excel()"><i class="fa fa-file-excel-o"></i> Print Excel</a>
            </div>
            <p class="pull-left"><?=lang('vehicle_category_details')?></p>
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
                        <th><?=lang('vehicle_category_code')?> </th>
						<th><?=lang('vehicle_category_name')?> </th>
						<th><?=lang('vehicle_type')?> </th>
						<th><?=lang('vehicle_category_weight')?> </th>
						<th><?=lang('vehicle_category_max_weight')?> </th>
						<th><?=lang('vehicle_category_min_weight')?> </th>
						<!--<th><?=lang('actions')?> </th>-->
                      </tr> </thead> <tbody>
                      <?php
                      if (!empty($vehicle_types)) {
                      foreach ($vehicle_types as $vehicle_type) { ?>
                      <tr>
                       <td>
							  <div class="btn-group">
								<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
								 <?=lang('options')?>
								<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a  href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_vehicle_type(<?=$vehicle_type->rowID ?>)"><i class="fa fa-pencil"></i> <?=lang('update_option')?></a></li>
                                    <li><a  href="javascript:void()" title="<?=lang('delete_option')?>" onclick="delete_vehicle_type(<?=$vehicle_type->rowID ?>)"><i class="fa fa-trash-o"></i> <?=lang('delete_option')?></a></li>
								</ul>
                                
							  </div>
						</td>
						<td><?=$vehicle_type->type_cd?></td>
						<td><?=$vehicle_type->type_name?></td>
						<td><?=$vehicle_type->vehicle_type?></td>
						<td><?=number_format($vehicle_type->weight,0,',','.')?></td>
						<td><?=number_format($vehicle_type->max_weight,0,',','.')?></td>
						<td><?=number_format($vehicle_type->min_weight,0,',','.')?></td>
                        <!--<td>
					  	<a href="<?=base_url()?>vehicle_category/view/update/<?=$vehicle_category->rowID?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('edit')?>"><i class="fa fa-edit"></i> </a>
                        <a href="<?=base_url()?>vehicle_category/view/delete/<?=$vehicle_category->rowID?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('delete')?>"><i class="fa fa-trash-o"></i></a>
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
  <!--</aside>-->
  <!-- /.aside -->

  <!-- .aside -->
<!--  
<aside class="aside-xxl bg-white b-l hide" id="aside">
    <section class="vbox">
		<section class="scrollable wrapper">
			<?php
			echo form_open(base_url().'vehicle_category/create'); ?>
			<?php echo validation_errors(); ?>
	
		<div class="form-group form-md-line-input">
			<label><?=lang('vehicle_category_code')?> <span class="text-danger">*</span></label>
			<input type="text" name="vehicle_category_code" placeholder="Input Vehicle Category Code"  maxlength="20"  autocomplete="off" class="input-sm form-control" required>
		</div>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('vehicle_category_name')?> <span class="text-danger">*</span></label>
			<input type="text" name="vehicle_category_name" placeholder="Input Vehicle Category Name" autocomplete="off" class="input-sm form-control" required>
		</div>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('vehicle_category_weight')?></label>
			<input type="text" name="vehicle_category_weight" placeholder="Input Vehicle Category Weight" autocomplete="off" class="input-sm form-control">
		</div>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('vehicle_category_max_weight')?></label>
			<input type="text" name="vehicle_category_max_weight" placeholder="Input Vehicle Category Max Weight" autocomplete="off" class="input-sm form-control">
		</div>
		<div class="form-group form-md-line-input">
			<label><?=lang('vehicle_category_min_weight')?></label>
			<input type="text" name="vehicle_category_min_weight" placeholder="Input Vehicle Category Min Weight" autocomplete="off" class="input-sm form-control">
		</div>
		<button type="submit" class="btn btn-sm btn-success"><?=lang('add_vehicle_category')?></button>
		<hr>
		</form>
   
		</section>
	</section>   
</aside>
-->

<!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog" style="width:600px;height:200px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?=lang('new_income')?></h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>
        <input type="hidden" name="rowID" value="">
        

        	
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('vehicle_category_code')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" class="input-sm form-control" value="" name="vehicle_type_code"  placeholder="Input <?=lang('vehicle_category_code')?>" maxlength="6" required>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('vehicle_category_name')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text"  value="" name="vehicle_type_name" placeholder="Input <?=lang('vehicle_category_name')?>" autocomplete="off" class="input-sm form-control" required>
            </div>
        </div>

  		<div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('vehicle_type')?></label>
            <div class="col-md-8">
			<select name="vehicle_type" id="vehicle_type_id" class="form-control" required>
			  <option value="<?=lang('head_truck')?>"><?=lang('head_truck')?></option>
			  <option value="<?=lang('dump_truck')?>"><?=lang('dump_truck')?></option>
			  <option value="<?=lang('dump_truck_special')?>"><?=lang('dump_truck_special')?></option>
			  <option value="<?=lang('box')?>"><?=lang('box')?></option>
			  <option value="<?=lang('bak_terbuka')?>"><?=lang('bak_terbuka')?></option>
			  <option value="<?=lang('trailer')?>"><?=lang('trailer')?></option>
			  <option value="<?=lang('light_truck')?>"><?=lang('light_truck')?></option>
			  <option value="<?=lang('a2b')?>"><?=lang('a2b')?></option>
			</select>
            </div>
		</div>
                
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('vehicle_category_weight')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text"  value="" name="vehicle_type_weight" id="vehicle_type_weight" placeholder="Input <?=lang('vehicle_category_weight')?>" autocomplete="off" class="input-sm form-control" required>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('vehicle_category_max_weight')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text"  value="" name="vehicle_type_max_weight" id="vehicle_type_max_weight" placeholder="Input <?=lang('vehicle_category_max_weight')?>" autocomplete="off" class="input-sm form-control" required>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('vehicle_category_min_weight')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text"  value="" name="vehicle_type_min_weight" id="vehicle_type_min_weight" placeholder="Input <?=lang('vehicle_category_min_weight')?>" autocomplete="off" class="input-sm form-control" required>
            </div>
        </div>


        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_vehicle_type()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

<!-- /.aside -->
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>