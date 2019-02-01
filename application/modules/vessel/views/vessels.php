<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="row" style="padding-top: 10px;">
                <div class="col-md-4" style="padding-top: 5px;">
                    <p><?=lang('vessels')?></p>                
                </div>     
                <div class="col-md-8 text-right">
                    <!-- <a href="#aside" data-toggle="class:show" id="btnFilter" onclick="showFilterText()" style="color: #46b8da;">Show Filter</a> &nbsp; -->
                    <?php
                    if($this->user_profile->get_user_access('Created') == 1){
                    ?>
                        <a  class="btn btn-sm green" onclick="add_vessel()"><i class="fa fa-plus"></i> <?=lang('new_vessel')?></a>
                    <?php
                    }
                    if($this->user_profile->get_user_access('PrintLimited') == 1 || $this->user_profile->get_user_access('PrintUnlimited') == 1 || 
                        $this->user_profile->get_user_access('PrintOne') == 1 || $this->user_profile->get_user_access('PrintTwo') == 1){
                    ?>
                        <a  class="btn btn-sm red" onclick="vessel_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
                        <a  class="btn btn-sm btn-success" onclick="vessel_excel()"><i class="fa fa-file-excel-o"></i> Print Excel</a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </header>
        <div class="clearfix"></div>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive"><?php echo validation_errors(); ?>

                    <div class="input-group input-daterange pull-right" style="position: relative;top:10px;right: 14px; display: inline-flex;">
                        <font style="margin: 5px 10px 0px 0px">Filter:</font>
                        <input type="text" name="start_date" id="start_date" class="form-control input-sm start_date" placeholder="<?=lang('start_date')?>" value="<?=date('d-m-Y', strtotime($start_date))?>" style="text-align: center;">
                        <span class="input-group-addon" style="width: 50px;">to</span>
                        <input type="text" name="end_date" id="end_date" class="form-control input-sm end_date" placeholder="<?=lang('end_date')?>" value="<?=date('d-m-Y', strtotime($end_date))?>" style="text-align: center;">
                    </div>
                    <br><br>
                    
                    <table id="tbl-vessel-new" class="table table-striped table-hover b-t b-light text-sm">
                        <thead>
                          <tr>
                            <th width="10%"><?=lang('options')?></th>
                            <th><?=lang('vessel_no')?> </th>
                            <th>ETA <?=lang('date')?> </th>
                            <th><?=lang('vessel_name')?> </th>
                            <th><?=lang('port_warehouse')?> </th>
                            <th><?=lang('agent')?> </th>
                            <th><?=lang('original_copy')?></th>
                            <th><?=lang('status')?></th>

                            <!-- For Filter -->
                            <th>start_date</th>
                            <th>end_date</th>
                          </tr> 
                        </thead> 
                    </table>
              </div>
            </section>            
          </div>
        </div>
      </section>

    </section>
  <!--</aside>-->
  
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?=lang('new_vessel')?></h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>
        <input type="hidden" name="rowID" value="">
        <input type="hidden" name="row_no" value="">
        <input type="hidden" name="sub" value="">
        <input type="hidden" name="edit" id="edit" />
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('vessel_no')?><span class="text-danger">*</span></label>
            <div class="col-lg-3">
                <input type="text" class="form-control input-sm" name="trx_no" id="trx_no" required>
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">ETA <?=lang('date')?><span class="text-danger">*</span></label>
            <div class="col-lg-3">
                <input type="text" class="form-control input-sm tanggal_datetimepicker" value="<?=date('d-m-Y')?>" name="date" id="date" style="text-align: center;" placeholder="dd-mm-YYYY" required>
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><span class="sub"></span> <?=lang('vessel_name')?><span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <input type="text" class="form-control input-sm" name="vessel_name" id="vessel_name" placeholder="<?=lang('vessel_name')?>" required>
            </div>
        </div>        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('port_warehouse')?><span class="text-danger">*</span></label>
            <div class="col-md-3" style="padding-right: 5px;">
                <select class="form-control input-sm" name="port_warehouse" id="port_warehouse" onchange="show_port_warehouse()" >
                    <option value="PORT">PORT</option>
                    <option value="WAREHOUSE">WAREHOUSE</option>
                </select>
            </div>
            <div class="col-md-5">
                <select class="form-control input-sm all_select2" name="port_rowID" id="port_rowID">
                    <?php
                        if (!empty($port_warehouse)) {
                            echo "<option value=''>".lang('select_your_option')."</option>";
                            foreach ($port_warehouse as $row_port) {
                		      echo '<option value="'.$row_port->rowID.'">'.$row_port->port_name.'</option>';
                            }
                        }
                    ?>
                </select> 
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('agent')?></label>
            <div class="col-lg-5">
                <input type="text" class="form-control input-sm" name="agent" id="agent" placeholder="<?=lang('agent')?>" maxlength="100" required>
            </div>
        </div>        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('original_copy')?></label>
            <div class="col-lg-3">
                <input type="checkbox" class="form-control input-sm" name="original" id="original" value="1" style="display: inline !important;width: 15px;" /> Original
            </div>
            <div class="col-lg-3">
                <input type="checkbox" class="form-control input-sm" name="copy" id="copy" value="1" style="display: inline !important;width: 15px;" /> Copy
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('status')?><span class="text-danger">*</span></label>
            <div class="col-md-4">
                <select class="form-control input-sm" name="status" id="status" >
                    <option value="1">Finished</option>
                    <option value="0">Unfinished</option>
                </select> 
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('remark')?></label>
            <div class="col-lg-8">
                <textarea class="form-control input-sm" name="remark" id="remark" rows="2" placeholder="Remark" maxlength="150" required=""></textarea>
            </div>
        </div>
        <p>&nbsp;</p>
          <div class="bs-example"> 
                <table class="table table-responsive" cellspacing="0" cellpadding="3" id="detail_eta">
                    <tr valign="middle">
                        <th width="5%">
                            <input id="tamdet" title="Tambah Baris" type="button" onclick="add_eta()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
                        </th>
                        <th width="25%">ETB Date</th>
                        <th>Remark</th>
                    </tr>
                </table>
          </div>         
              
          <?=form_close()?>
       </div>
       <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_vessel()" class="btn green">Save</button>
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
            <?=form_open(base_url().'vessel/set_filter','autocomplete="off" id="form_period" class="form-horizontal"')?>                    
            <div class="row">
                <div class="col-md-9">
                    <div class="input-group input-daterange" style="position: relative;display: inline-flex;">
                        <input type="text" name="start_date" id="start_date" class="form-control input-sm tanggal_datetimepicker" placeholder="<?=lang('start_date')?>" value="<?=date('01-01-Y', strtotime($start_date))?>">
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
<script type="text/javascript">
    $(function() {
        $('.start_date, .end_date').datetimepicker({
            format: 'DD-MM-YYYY',
            showTodayButton:true
        }); 

        var table_vessel = $('#tbl-vessel-new').DataTable({
            processing: true,
            serverSide: true,
            sDom: "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            sPaginationType: "full_numbers",
            ajax: {
                url: "<?= base_url() ?>vessel/fetch_data",
                type: 'POST',
                data: {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
            },
            columns: [
                {
                    "data": "dropdown_option", "orderable": false, "searchable": false
                },
                {
                    "data": "trx_no"
                },
                {
                    "data": "eta_date"
                },
                {
                    "data": "vessel_name"
                },
                {
                    "data": "port_name"
                },
                {
                    "data": "agent"
                },
                {
                    "data": "original_copy"
                },
                {
                    "data": "status"
                },
                {
                    "data": "start_date", "bVisible" : false
                },
                {
                    "data": "end_date", "bVisible" : false
                }
            ],
            order: [0, "DESC"],
            iDisplayLength: 25
        });

        $('.dataTables_filter input').unbind().keyup(function() {
            var value = $(this).val();
            if (value.length > 2) {
                table_vessel.search(value).draw();
            } 
            if (value.length == 0) {
                table_vessel.search(value).draw();
            } 
        });
        $(".start_date").on("dp.change", function (e) {
            var start_date = $("#start_date").val();
            table_vessel.columns(8).search(start_date).draw();
            $("#start_date").blur();
        });
        $(".end_date").on("dp.change", function (e) {
            var end_date = $("#end_date").val();
            table_vessel.columns(9).search(end_date).draw();
            $("#end_date").blur();
        });
    });
</script>