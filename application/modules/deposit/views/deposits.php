<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="row" style="padding-top: 10px;">
                <div class="col-md-4" style="padding-top: 5px;">
                    <p><?=lang('deposits')?></p>              
                </div>     
                <div class="col-md-8 text-right">
                    <!-- <a href="#aside" data-toggle="class:show" id="btnFilter" onclick="showFilterText()" style="color: #46b8da;">Show Filter</a> &nbsp; -->
                    <?php
                    if($this->user_profile->get_user_access('Created') == 1){
                    ?>
                        <a  class="btn btn-sm green" onclick="add_deposit()"><i class="fa fa-plus"></i> <?=lang('new_deposit')?></a>
                    <?php
                    }
                    if($this->user_profile->get_user_access('PrintLimited') == 1 || $this->user_profile->get_user_access('PrintUnlimited') == 1 || 
                        $this->user_profile->get_user_access('PrintOne') == 1 || $this->user_profile->get_user_access('PrintTwo') == 1){
                    ?>
                        <a  class="btn btn-sm red" onclick="deposit_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
                        <a  class="btn btn-sm btn-success" onclick="deposit_excel()"><i class="fa fa-file-excel-o"></i> Print Excel</a>
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
                    
                  <table id="tbl-deposits" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th><?=lang('options')?></th>
                        <th><?=lang('deposit_number')?> </th>
                        <th><?=lang('date')?> </th>
                        <th><?=lang('debtor_name')?> </th>
                        <th><?=lang('debtor_types')?> </th>
                        <th><?=lang('remark')?> </th>
                        <th><?=lang('amount')?> (Rp)</th>

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
        <h3 class="modal-title"><?=lang('new_deposit')?></h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>
        <input type="hidden" name="rowID" value="">
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('date')?> <span class="text-danger">*</span></label>
            <div class="col-lg-3">
                <input type="text" class="form-control input-sm" value="<?=date('d-m-Y')?>" name="date" id="date" style="text-align: center;" placeholder="dd-mm-YYYY" readonly="" required="" />
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('driver_name')?> <span class="text-danger">*</span></label>
            <div class="col-md-8">
                 <select class="form-control all_select2" name="debtor_rowID" id="debtor_rowID" >	
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
            <label class="col-lg-4 control-label"><?=lang('amount')?> <span class="text-danger">*</span></label>
            <div class="col-lg-4">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Rp</span>
                    <input type="text" class="form-control input-sm currency" value="0" name="amount" id="amount_deposit" style="text-align: right;" placeholder="Amount" required>
                </div>
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('remark')?> <span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <textarea class="form-control" name="remark" id="remark" rows="2" placeholder="Remark" required="" onkeyup="replaceQuotes(this)"></textarea>
            </div>
        </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_deposit()" class="btn green">Save</button>
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
            <?=form_open(base_url().'deposit/set_filter','autocomplete="off" id="form_period" class="form-horizontal"')?>                    
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
        
        var table_deposits = $('#tbl-deposits').DataTable({
            processing: true,
            serverSide: true,
            sDom: "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            sPaginationType: "full_numbers",
            ajax: {
                url: "<?= base_url() ?>deposit/fetch_data",
                type: 'POST',
                data: {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
            },
            columns: [
                {
                    "data": "dropdown_option", "orderable": false, "searchable": false, "className" : "text-center"
                },
                {
                    "data": "deposit_number"
                },
                {
                    "data": "date"
                },
                {
                    "data": "debtor"
                },
                {
                    "data": "type"
                },
                {
                    "data": "remark"
                },
                {
                    "data": "amount", "className" : "text-right"
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
                table_deposits.search(value).draw();
            } 
            if (value.length == 0) {
                table_deposits.search(value).draw();
            } 
        });
        $(".start_date").on("dp.change", function (e) {
            var start_date = $("#start_date").val();
            table_deposits.columns(7).search(start_date).draw();
            $("#start_date").blur();
        });
        $(".end_date").on("dp.change", function (e) {
            var end_date = $("#end_date").val();
            table_deposits.columns(8).search(end_date).draw();
            $("#end_date").blur();
        });
    });
</script>