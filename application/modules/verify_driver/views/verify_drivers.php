<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="row" style="padding-top: 10px;">
                <div class="col-md-6" style="padding-top: 5px;">
                    <p><?=lang('verify_drivers')?></p>              
                </div>     
                <div class="col-md-6 text-right">
                    &nbsp;
                </div>
            </div>
        </header>
        <div class="clearfix"></div>         
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive"><?php echo validation_errors(); ?>

                  <table class="table table-striped table-hover b-t b-light text-sm" id="tbl-verify-driver">
                    <thead>
                      <tr>
                        <th><?=lang('no')?></th>
                        <th><?=lang('debtor_name')?> </th>
                        <th><?=lang('date')?></th>
                        <th><?=lang('verify_by')?></th>
                        <th>Status</th>
                        <th><?=lang('action')?></th>
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
            <h3 class="modal-title">Verify</h3>
          </div>
          <div class="modal-body form">
            <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>
            <input type="hidden" name="rowID" id="rowID" value="">
            <input type="hidden" name="debtor_name" id="debtor_name" value="">
            <div class="form-group form-md-line-input">
                <label class="col-lg-3 control-label"><?=lang('remark')?> <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <textarea class="form-control" name="remark" id="remark" rows="2" placeholder="Remark" required=""></textarea>
                </div>
            </div>
            <?=form_close()?>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="update_queue()" class="btn green">Verify</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modal_sia" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title">Attendance</h3>
          </div>
          <div class="modal-body form">
            <?=form_open('','autocomplete="off" id="form_sia" class="form-horizontal"')?>
            <input type="hidden" name="debtor_id" id="debtor_id" value="">
            <input type="hidden" name="absent_code" id="absent_code" value="">
            <div class="form-group form-md-line-input">
                <label class="col-lg-3 control-label">Note <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <textarea class="form-control" name="note" id="note" rows="2" placeholder="Note" required=""></textarea>
                </div>
            </div>
            <?=form_close()?>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_attendance()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>
<script type="text/javascript">
    $(function() {
        var table_verify_driver = $('#tbl-verify-driver').DataTable({
            processing: true,
            serverSide: true,
            sDom: "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            sPaginationType: "full_numbers",
            ajax: {
                url: "<?= base_url() ?>verify_driver/fetch_data",
                type: 'POST',
                data: {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
            },
            columns: [
                {
                    "data": "no", "orderable": false, "searchable": false, "className" : "text-center"
                },
                {
                    "data": "debtor"
                },
                {
                    "data": "date_modified"
                },
                {
                    "data": "verify_fullname"
                },
                {
                    "data": "status", "className" : "text-center"
                },
                {
                    "data": "btn_action", "orderable": false, "searchable": false
                }
            ],
            order: [0, "DESC"],
            iDisplayLength: 25
        });

        $('.dataTables_filter input').unbind().keyup(function() {
            var value = $(this).val();
            if (value.length > 2) {
                table_verify_driver.search(value).draw();
            } 
            if (value.length == 0) {
                table_verify_driver.search(value).draw();
            } 
        });
    });
</script>