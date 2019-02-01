<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">
              <a class="btn btn-sm green" onclick="add_tire_brand()"><i class="fa fa-plus"></i> <?=lang('new_tire_brand')?></a>
            </div>
            <p class="pull-left"><?=lang('tire_brand_details')?></p>
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
						<th>Tire Brand</th>
                      </tr> </thead> <tbody>
                      <?php
                      if (!empty($tire_brands)) {
                      foreach ($tire_brands as $tire_brand) { ?>
                      <tr>
                        <td>
							  <div class="btn-group">
								<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
								 <?=lang('options')?>
								<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a  href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_tire_brand(<?=$tire_brand->rowID ?>)"><i class="fa fa-pencil"></i> <?=lang('update_option')?></a></li>
                                    <li><a  href="javascript:void()" title="<?=lang('delete_option')?>" onclick="delete_tire_brand(<?=$tire_brand->rowID ?>)"><i class="fa fa-trash-o"></i> <?=lang('delete_option')?></a></li>
								</ul>
                                
							  </div>
						</td>
						<td><?=$tire_brand->tire_brand?></td>
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
 <!-- </aside>-->
  <!-- /.aside -->

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog" style="width:600px;height:200px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?=lang('add_tire_brand')?></h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>

        <input type="hidden" name="rowID" value="">
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">Tire Brand <span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" class="form-control input-sm" name="tire_brand" id="tire_brand" />
            </div>
        </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_tire_brand()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>