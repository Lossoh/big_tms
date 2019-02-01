<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="row" style="padding-top: 10px;">
                <div class="col-md-6" style="padding-top: 5px;">
                    <p><?=lang('ca_invoice_printed')?></p>              
                </div>     
                <div class="col-md-6 text-right">
                    <a href="#aside" data-toggle="class:show" id="btnFilter" onclick="showFilterText()" style="color: #46b8da;">Show Filter</a>
                </div>
            </div>
        </header>
        <div class="clearfix"></div> 
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive"><?php echo validation_errors(); ?>
                      <table class="table table-striped table-hover b-t b-light text-sm tbl-data">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th><?=lang('username')?></th>
    						<th><?=lang('email')?></th>
    						<th><?=lang('module')?></th>
    						<th><?=lang('activity')?></th>
                            <th>Activity <?=lang('date')?></th>
    						<th><?=lang('action')?></th>
                          </tr> 
                        </thead> 
                        <tbody>
                          <?php
                          if (!empty($ca_invoice_printeds)) {
                          $no = 1;
                          foreach ($ca_invoice_printeds as $row) {                                 
                          ?>
                          <tr>
                                <td align="center"><?=number_format($no++,0,',','.')?></td>	
          			            <td><?=ucwords($row->username)?></td>
          			            <td><?=$row->email?></td>
          			            <td><?=ucwords($row->module)?></td>
          			            <td><?=ucwords($row->activity)?></td>
          			            <td><?=date('d F Y H:i:s',strtotime($row->activity_date))?></td>
    							<td>
                                <?php
                                    if($this->user_profile->get_user_access('Deleted') == 1){
                                ?>
                                        <button onclick="delete_activity(<?=$row->activity_id?>)" class="btn btn-sm red"><i class="fa fa-times"></i> Delete</button>
                                <?php
                                }
                                ?>
                                </td>
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
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title"><?=lang('ca_invoice_printed')?></h3>
          </div>
          <div class="modal-body form">
            <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>
            <input type="hidden" name="rowID" id="rowID" value="">
            <div class="form-group form-md-line-input">
                <label class="col-lg-3 control-label"><?=lang('remark')?> <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <textarea class="form-control" name="remark" id="remark" rows="2" placeholder="Remark" maxlength="150" required=""></textarea>
                </div>
            </div>
            <?=form_close()?>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_cancel_printed()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
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
            <?=form_open(base_url().'ca_invoice_printed/set_filter','autocomplete="off" id="form_period" class="form-horizontal"')?>                    
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
