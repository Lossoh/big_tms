<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">
              <?php
              if($this->user_profile->get_user_access('Created') == 1){
              ?>
                <a class="btn btn-sm green" onclick="add_brand()"><i class="fa fa-plus"></i> <?=lang('new_brand')?></a>
              <?php
              }
              if($this->user_profile->get_user_access('PrintLimited') == 1 || $this->user_profile->get_user_access('PrintUnlimited') == 1 || 
                 $this->user_profile->get_user_access('PrintOne') == 1 || $this->user_profile->get_user_access('PrintTwo') == 1){
              ?>                              
                <a class="btn btn-sm red" onclick="brand_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
                <a class="btn btn-sm btn-success" onclick="brand_excel()"><i class="fa fa-file-excel-o"></i> Print Excel</a>
              <?php
              }
              ?>
            </div>
            <p class="pull-left"><?=lang('brand')?></p>
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
                        <th><?=lang('brand_name')?></th>
                      </tr> 
                    </thead> 
                    <tbody>
                      <?php
                      if (!empty($brands)) {
                      foreach ($brands as $brand) { ?>
                      <tr>
                        <td>
							  <div class="btn-group">
								<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
								 <?=lang('options')?>
								<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
                                    <?php
                                    if($this->user_profile->get_user_access('Updated') == 1){
                                    ?>
									    <li><a  href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_brand(<?=$brand->rowID ?>)"><i class="fa fa-pencil"></i> <?=lang('update_option')?></a></li>
                                    <?php
                                    }
                                    if($this->user_profile->get_user_access('Deleted') == 1){
                                    ?>
                                        <li><a  href="javascript:void()" title="<?=lang('delete_option')?>" onclick="delete_brand(<?=$brand->rowID ?>)"><i class="fa fa-trash-o"></i> <?=lang('delete_option')?></a></li>
                                    <?php
                                    }
                                    ?>
								</ul>
							  </div>
						</td>
						<td><?=$brand->brand_name?></td>
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
        <h3 class="modal-title"><?=lang('new_brand')?></h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>
        <input type="hidden" name="rowID" value="">
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('brand_name')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" class="form-control input-sm" name="brand_name" id="brand_name" placeholder="<?=lang('brand_name')?>" maxlength="150" />
            </div>
        </div>
        <?=form_close()?>
        </div>
        <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_brand()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
        </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>