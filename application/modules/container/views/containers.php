<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
  <section class="vbox">
    <header class="header bg-white b-b b-light">
        <div class="row" style="padding-top: 10px;">
            <div class="col-md-6" style="padding-top: 5px;">
                <p><?=lang('containers')?></p>              
            </div>     
            <!-- <div class="col-md-6 text-right">
                <a href="#aside" data-toggle="class:show" id="btnFilter" onclick="showFilterText()" style="color: #46b8da;">Show Filter</a> &nbsp;
            </div> -->
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

                        <table id="tbl-container" class="table table-striped table-hover b-t b-light text-sm">
                            <thead>
                              <tr>
                                <th width="10%"><?=lang('options')?></th>
                                <th><?=lang('job_order_emkl_no')?></th>
                                <th><?=lang('job_order_date')?></th>
                                <th><?=lang('debtor')?></th>
                                <th>Container No</th>
                                <th>Container Type</th>
                                <th>Seal No</th>
                                <th>Replacement Seal No</th>
                                <th>Weight</th>

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
        <h3 class="modal-title">Delivery Order</h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>
        <input type="hidden" name="revisi" id="revisi" />
        <input type="hidden" name="container_rowID" id="container_rowID" />
        <input type="hidden" name="do_no" id="do_no" />
        <input type="hidden" name="from_rowID" id="from_rowID" />
        <input type="hidden" name="to_rowID" id="to_rowID" />
        <input type="hidden" name="user_created" id="user_created" />
        <input type="hidden" name="date_created" id="date_created" />
        <input type="hidden" name="time_created" id="time_created" />
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('job_order_emkl_no')?><span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <input type="text" class="form-control input-sm" name="jo_no" id="jo_no" readonly="" required="" />
            </div>
        </div>        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">Container No<span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <input type="text" class="form-control input-sm" name="container_no" id="container_no" readonly="" required="" />
            </div>
        </div>        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('police_no')?><span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <select class="form-control input-sm all_select2" name="vehicle_rowID" id="vehicle_rowID">
                    <option value=""><?=lang('select_your_option')?></option>
                    <?php
                    foreach($vehicles as $row_v){
                        echo '<option value="'.$row_v->rowID.'">'.$row_v->police_no.'</option>';
                    }
                    ?>
                </select>
            </div>
        </div>        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">Cargo Type<span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <select class="form-control input-sm all_select2" name="jo_detail_rowID" id="jo_detail_rowID" onchange="get_container_destination()"></select>
            </div>
        </div>        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('port_warehouse')?><span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <input type="text" class="form-control input-sm" name="port_warehouse" id="port_warehouse" readonly="" required="" />
            </div>
        </div>        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('vessel_name')?><span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <input type="text" class="form-control input-sm" name="vessel_name" id="vessel_name" readonly="" required="" />
            </div>
        </div>        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('job_order_po_spk_no')?><span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <input type="text" class="form-control input-sm" name="po_spk_no" id="po_spk_no" readonly="" required="" />
            </div>
        </div>        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">Sent To<span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <textarea class="form-control input-sm" name="sent_to" id="sent_to" readonly="" required="" rows="2"></textarea>
            </div>
        </div>        
              
        <?=form_close()?>
      </div>
      <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_do_container()" class="btn green">Save</button>
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
            <?=form_open(base_url().'container/set_filter','autocomplete="off" id="form_period" class="form-horizontal"')?>                    
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
<script type="text/javascript">
    $(function() {
        $('.start_date, .end_date').datetimepicker({
            format: 'DD-MM-YYYY',
            showTodayButton:true
        }); 
        
        var table_container = $('#tbl-container').DataTable({
            processing: true,
            serverSide: true,
            sDom: "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            sPaginationType: "full_numbers",
            ajax: {
                url: "<?= base_url() ?>container/fetch_data",
                type: 'POST',
                data: {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
            },
            columns: [
                {
                    "data": "dropdown_option", "orderable": false, "searchable": false
                },
                {
                    "data": "jo_no"
                },
                {
                    "data": "jo_date"
                },
                {
                    "data": "debtor"
                },
                {
                    "data": "container_no"
                },
                {
                    "data": "container_type"
                },
                {
                    "data": "seal_no"
                },
                {
                    "data": "replacement_seal_no"
                },
                {
                    "data": "weight"
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
                table_container.search(value).draw();
            } 
            if (value.length == 0) {
                table_container.search(value).draw();
            } 
        });
        $(".start_date").on("dp.change", function (e) {
            var start_date = $("#start_date").val();
            table_container.columns(9).search(start_date).draw();
            $("#start_date").blur();
        });
        $(".end_date").on("dp.change", function (e) {
            var end_date = $("#end_date").val();
            table_container.columns(10).search(end_date).draw();
            $("#end_date").blur();
        });
    });
</script>