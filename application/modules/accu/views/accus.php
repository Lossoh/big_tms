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
                <a class="btn btn-sm green" onclick="add_accu()"><i class="fa fa-plus"></i> <?=lang('new_accu')?></a>
              <?php
              }
              if($this->user_profile->get_user_access('PrintLimited') == 1 || $this->user_profile->get_user_access('PrintUnlimited') == 1 || 
                 $this->user_profile->get_user_access('PrintOne') == 1 || $this->user_profile->get_user_access('PrintTwo') == 1){
              ?>                              
                <a class="btn btn-sm red" onclick="accu_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
                <a class="btn btn-sm btn-success" onclick="accu_excel()"><i class="fa fa-file-excel-o"></i> Print Excel</a>
              <?php
              }
              ?>
            </div>
            <p class="pull-left"><?=lang('accu_details')?></p>
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
                        <th><?=lang('vehicle_police_no')?> </th>
						<th><?=lang('driver_name')?> </th>
						<th>Date</th>
						<th width="15%">Action</th>
                      </tr> </thead> <tbody>
                      <?php
                      if (!empty($accus)) {
                      foreach ($accus as $accu) { ?>
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
    									<li><a  href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_accu(<?=$accu->rowID ?>)"><i class="fa fa-pencil"></i> <?=lang('update_option')?></a></li>
                                    <?php
                                    }
                                    if($this->user_profile->get_user_access('Deleted') == 1){
                                    ?>
                                        <li><a  href="javascript:void()" title="<?=lang('delete_option')?>" onclick="delete_accu(<?=$accu->rowID ?>)"><i class="fa fa-trash-o"></i> <?=lang('delete_option')?></a></li>
                                    <?php
                                    }
                                    ?>
								</ul>
                                
							  </div>
						</td>
						<td><?=$accu->police_no?></td>
						<td><?=$accu->debtor_name?></td>
						<td><?=date('d F Y',strtotime($accu->date))?></td>
						<td>
                            <?php
                            if($this->user_profile->get_user_access('Created') == 1){
                            ?>
                                <button class="btn btn-sm btn-success" onclick="change_accu(<?=$accu->rowID?>,'<?=$accu->dtl_rowID?>')"><i class="fa fa-refresh"></i> Change</button>
                            <?php
                            }
                            ?>
                        </td>
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
        <h3 class="modal-title"><?=lang('new_accu')?></h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>

        <input type="hidden" name="rowID" value="">
       	
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">Date <span class="text-danger">*</span></label>
            <div class="col-lg-3">
                <input type="text" class="form-control input-sm tanggal_datetimepicker" value="<?=date('d-m-Y')?>" name="date" id="date" style="text-align: center;" placeholder="dd-mm-YYYY" required> 
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('vehicle_police_no')?> <span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <select class="form-control all_select2" name="vehicle_id" id="vehicle_id" >	
					 <?php 
                     if (!empty($vehicles)) {
                        foreach ($vehicles as $vehicle) { 
                     ?>
                            <option value="<?=$vehicle->rowID;?>"><?=$vehicle->police_no?></option>
					 <?php 
                        }
                     } 
                     ?>
			    </select> 
            </div>
        </div>        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('driver_name')?> <span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <select class="form-control" name="debtor_id" id="debtor_id" >	
					 <?php 
                     if (!empty($debtors)) {
                        foreach ($debtors as $debtor) { 
                     ?>
                            <option value="<?=$debtor->rowID;?>"><?=$debtor->debtor_cd?> - <?=$debtor->debtor_name?></option>
					 <?php 
                        }
                     } 
                     ?>
			    </select> 
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">Photo URL</label>
            <div class="col-lg-8">
                <input type="text" class="form-control input-sm" name="photo_url" id="photo_url" placeholder="Photo URL" />
            </div>
        </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_accu()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    <div class="modal fade" id="modal_form_detail" role="dialog">
    <div class="modal-dialog" style="width:600px;height:200px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title-detail">Accu Detail</h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form_detail" class="form-horizontal"')?>

        <input type="hidden" name="rowID" value="">
        <input type="hidden" name="accu_rowID" value="">
       	
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">Accu No <span class="text-danger">*</span></label>
            <div class="col-lg-3">
                <input type="text" class="form-control input-sm" name="accu_no" id="accu_no" placeholder="Accu No" /> 
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">Accu Condition <span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <select class="form-control" name="accu_condition" id="accu_condition" >	
					 <option value="New">New</option>
					 <option value="Vulkanisir Panas">Vulkanisir Panas</option>
					 <option value="Vulkanisir Dingin">Vulkanisir Dingin</option>
			    </select> 
            </div>
        </div>        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">Accu Brand <span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" class="form-control input-sm" name="accu_brand" id="accu_brand" placeholder="Accu Brand" /> 
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">Accu Tipe <span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" class="form-control input-sm" name="accu_type" id="accu_type" placeholder="Accu Tipe" />
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">Accu Size <span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" class="form-control input-sm" name="accu_size" id="accu_size" placeholder="Accu Size" />
            </div>
        </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_accu_detail()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>