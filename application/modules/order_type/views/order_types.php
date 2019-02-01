<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <aside>
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">
              <!--<a href="#aside" data-toggle="class:show" class="btn btn-sm green pull-right"><i class="fa fa-plus"></i> <?=lang('new_order_type')?></a>-->
              <a  class="btn btn-sm green" onclick="add_order_type()"><i class="fa fa-plus"></i> <?=lang('new_order_type')?></a>
            </div>
            <p class="pull-left"><?=lang('order_type_details')?></p>
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
                        <th><?=lang('order_type_type')?></th>
                        <th><?=lang('order_type_code')?> </th>
						<th><?=lang('order_type_name')?> </th>
						<!--<th><?=lang('actions')?> </th>-->
                      </tr> </thead> <tbody>
                      <?php
                      if (!empty($order_types)) {
                      foreach ($order_types as $order_type) { ?>
                      <tr>
                        <td>
							  <div class="btn-group">
								<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
								 <?=lang('options')?>
								<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a  href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_order_type(<?=$order_type->rowID?>)"><i class="fa fa-pencil"></i> <?=lang('update_option')?></a></li>
                                    <li><a  href="javascript:void()" title="<?=lang('delete_option')?>" onclick="delete_order_type(<?=$order_type->rowID?>)"><i class="fa fa-trash-o"></i> <?=lang('delete_option')?></a></li>
								</ul>
                                
							  </div>
							</td>
                        <td><?=$order_type->type?></a></td>
						<td><?=$order_type->type_cd?></td>
						<td><?=$order_type->descs?></td>
                        <!--<td>
					  	<a href="<?=base_url()?>order_type/view/update/<?=$order_type->rowID?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('edit')?>"><i class="fa fa-edit"></i> </a>
                        <a href="<?=base_url()?>order_type/view/delete/<?=$order_type->rowID?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('delete')?>"><i class="fa fa-trash-o"></i></a>
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

  <!-- .aside -->
<aside class="aside-xxl bg-white b-l hide" id="aside">
    <section class="vbox">
		<section class="scrollable wrapper">
			<?php
			echo form_open(base_url().'order_type/create'); ?>
			<?php echo validation_errors(); ?>
			
		<div class="form-group form-md-line-input">
			<label><?=lang('order_type_type')?> <span class="text-danger">*</span></label>
			<select name="order_type_type" class="form-control" id="order_type_type" required>
				<option value="H">Header</option>
				<option value="D">Detail</option>
			</select>
		</div>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('order_type_code')?> <span class="text-danger">*</span></label>
			<input type="text" name="order_type_code" placeholder="Input Order Type Code"  maxlength="20"  autocomplete="off" class="input-sm form-control" required>
		</div>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('order_type_name')?><span class="text-danger">*</span></label>
			<input type="text" name="order_type_name" placeholder="Input Order Type Name"  autocomplete="off" class="input-sm form-control" required>
		</div>
		
		<button type="submit" class="btn btn-sm btn-success"><?=lang('add_order_type')?></button>
		<hr>
		</form>
   
		</section>
	</section>   
</aside>
<!-- /.aside -->
  </section>
  
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
            <label class="col-lg-4 control-label"><?=lang('order_type_type')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
            <select name="order_type_type" class="input-sm form-control" id="order_type_type" required>
				<option value="H">Header</option>
				<option value="D">Detail</option>
			</select>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('order_type_code')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" name="order_type_code" placeholder="Input Order Type Code"  maxlength="6"  autocomplete="off" class="input-sm form-control" required>
            </div>
        </div>
        
  		
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('order_type_name')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" name="order_type_name" placeholder="Input Order Type Name"  maxlength="25"  autocomplete="off" class="input-sm form-control" required>
            </div>
        </div>
		
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_order_type()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
