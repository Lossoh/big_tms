<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">
              <a href="#aside" data-toggle="class:show" id="btnFilter" onclick="showFilterText()" style="color: #46b8da;">Show Filter</a> &nbsp;
              <?php
              if($this->user_profile->get_user_access('Created') == 1){
              ?>
                <a  class="btn btn-sm green" onclick="add_vehicle_condition()" ><i class="fa fa-plus"></i> <?=lang('new_vehicle_condition')?></a>
              <?php
              }
              if($this->user_profile->get_user_access('PrintLimited') == 1 || $this->user_profile->get_user_access('PrintUnlimited') == 1 || 
                 $this->user_profile->get_user_access('PrintOne') == 1 || $this->user_profile->get_user_access('PrintTwo') == 1){
              ?>              
                <a  class="btn btn-sm red" onclick="vehicle_condition_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
                <a  class="btn btn-sm btn-success" onclick="vehicle_condition_excel()"><i class="fa fa-file-excel-o"></i> Print Excel</a>
              <?php
              }
              ?>
            </div>
            <p class="pull-left"><?=lang('vehicle_conditions')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive"><?php echo validation_errors(); ?>
                      <table id="tbl-projects" class="table table-striped table-hover b-t b-light text-sm">
                        <thead>
                          <tr>
                            <th width="10%"><?=lang('options')?></th>                        
                            <th><?=lang('vehicle_police_no')?> </th>
    						<th><?=lang('condition')?> </th>
    						<th><?=lang('estimasi')?> </th>
    						<th><?=lang('note')?> </th>
    						<th><?=lang('date_created')?> </th>
                          </tr> 
                        </thead> 
                        <tbody>
                          <?php
                          if (!empty($vehicle_conditions)) {
                          foreach ($vehicle_conditions as $vehicle) { ?>
                          <tr>
                            <td>
							  <div class="btn-group">
								<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
								 <?=lang('options')?>
								<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
                                    <li><a  href="javascript:void()" title="<?=lang('history')?>" onclick="history_vehicle_condition(<?=$vehicle->vehicle_id?>,'<?=$vehicle->police_no?>')"><i class="fa fa-history"></i> <?=lang('history')?></a></li>
                                    <?php
                                    if($this->user_profile->get_user_access('Updated') == 1){
                                    ?>
									    <li><a  href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_vehicle_condition(<?=$vehicle->rowID?>)"><i class="fa fa-pencil"></i> <?=lang('update_option')?></a></li>
                                    <?php
                                    }
                                    if($this->user_profile->get_user_access('Deleted') == 1){
                                    ?>                                    
                                        <li><a  href="javascript:void()" title="<?=lang('delete_option')?>" onclick="delete_vehicle_condition(<?=$vehicle->rowID?>)"><i class="fa fa-trash-o"></i> <?=lang('delete_option')?></a></li>
								    <?php
                                    }
                                    ?>
                                </ul>
							  </div>
							</td>
    						<td><?=$vehicle->police_no?></td>
    						<td><?=$vehicle->condition?></td>
    						<td><?=$vehicle->estimasi == '1970-01-01' || $vehicle->estimasi == '0000-00-00' ? '-' : date("d F Y",strtotime($vehicle->estimasi))?></td>
    						<td><?=$vehicle->note == '' ? '-' : $vehicle->note?></td>
    						<td><?=date("d F Y", strtotime($vehicle->date_created))?></td>
                        </tr>
                        <?php } } ?>
                        
                      </tbody>
                    </table>
    
                  </div>
               </div>
            </div> 
                       
          </div>
        </div>
      </section>

    </section>
 <!-- </aside>-->
  <!-- /.aside -->

<!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog" style="width:45%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?=lang('new_vehicle_condition')?></h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>
        <input type="hidden" name="rowID" value="">
       	<div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('date')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" class="form-control tanggal_datetimepicker" name="date_created" id="date_created" placeholder="dd-mm-YYYY" value="<?=date('d-m-Y')?>" />
            </div>
        </div> 
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('vehicle_police_no')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <select name="vehicle_id" id="vehicle_id" class="form-control" required>
				   <option value=""><?=lang('select_your_option')?></option>
                   <?php
                      if (!empty($vehicles)) {
                      foreach ($vehicles as $vehicle) { ?>
					  <option value="<?php echo $vehicle->rowID; ?>"><?php echo $vehicle->police_no; ?></option>
					<?php }}?>
    			</select>
            </div>
        </div>
              
		<div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('condition')?><span class="text-danger">*</span></label>
            <div class="col-md-8">
			<select name="condition" id="condition" class="form-control" required>
    			<option value="<?=lang('layak_jalan')?>"><?=lang('layak_jalan')?></option>
    			<option value="<?=lang('rusak_ringan')?>"><?=lang('rusak_ringan')?></option>
    			<option value="<?=lang('rusak_berat')?>"><?=lang('rusak_berat')?></option>
    			<option value="<?=lang('terjual')?>"><?=lang('terjual')?></option>
    			<option value="<?=lang('sewa')?>"><?=lang('sewa')?></option>
    			<option value="<?=lang('no_letter')?>"><?=lang('no_letter')?></option>
    			<option value="<?=lang('no_driver')?>"><?=lang('no_driver')?></option>
			<select>
            </div>
		</div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('estimasi')?></label>
            <div class="col-lg-8">
                <input type="text" class="form-control tanggal_datepicker" name="estimasi" id="estimasi" placeholder="<?=lang('estimasi')?> (Optional)"/>
            </div>
        </div>                      
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('note')?></label>
            <div class="col-lg-8">
                <textarea class="form-control" name="note" id="note" placeholder="<?=lang('note')?> (Optional)"></textarea>
            </div>
        </div>              
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_vehicle_condition()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_history" role="dialog">
  <div class="modal-dialog" style="width:50%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title-history"><?=lang('history')?> - <span id="police_no_history"></span></h3>
      </div>
      <div class="modal-body form">
        <table id="tbl_history" class="table table-striped table-hover b-t b-light text-sm"></table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn red" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>

<!-- /.aside -->
<aside class="aside-xxl bg-white b-l hide" id="aside">
    <section class="vbox">
		<section class="scrollable wrapper">
            <?=form_open(base_url().'vehicle_condition/set_filter','autocomplete="off" id="form_period" class="form-horizontal"')?>                    
            <div class="row">
                <div class="col-md-9">
                    <div class="input-group input-daterange" style="position: relative;display: inline-flex;">
                        <input type="text" name="start_date" id="start_date" class="form-control input-sm tanggal_datetimepicker" placeholder="<?=lang('start_date')?>" value="<?=date('d-m-Y', strtotime($start_date))?>">
                        <span class="input-group-addon" style="width: 50px;">to</span>
                        <input type="text" name="end_date" id="end_date" class="form-control input-sm tanggal_datetimepicker" placeholder="<?=lang('end_date')?>" value="<?=date('d-m-Y', strtotime($end_date))?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-filter"></i> Filter</button>
                </div>
            </div>
            <?=form_close()?>
        </section>
	</section>   
</aside>
<!-- /.aside -->
