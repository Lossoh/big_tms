<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <aside>
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="row" style="padding-top: 10px;">
                <div class="col-md-6" style="padding-top: 5px;">
                    <p><?=lang('job_order_list')?></p>              
                </div>     
                <div class="col-md-6 text-right">
                    <!-- <a href="#aside" data-toggle="class:show" id="btnFilter" onclick="showFilterText()" style="color: #46b8da;">Show Filter</a> &nbsp; -->
                    <?php
                    if($this->user_profile->get_user_access('Created') == 1){
                    ?>
                        <a href="<?php echo base_url().'job_order/create_job_order'; ?>"  class="btn btn-sm green"><i class="fa fa-plus"></i> <?=lang('new_job_order')?></a>
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

                    <table id="tbl-job-order" class="table table-striped table-hover b-t b-light text-sm">
                        <thead>
                            <tr>
                                <th><?=lang('options')?></th>
                                <th><?=lang('job_order_no')?> </th>
                                <th><?=lang('job_order_date')?> </th>
                                <th><?=lang('debtor')?> </th>
                                <th><?=lang('job_order_po_spk_no')?> </th>
                                <th><?=lang('job_order_so_no')?> </th>
                                <th><?=lang('vessel_name')?> </th>
                                <th><?=lang('port_name')?> </th>
                                <th><?=lang('fare_trip')?> </th>
                                <th><?=lang('price')?> </th>
                                <th><?=lang('item')?> </th>
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
  </aside>
  <!-- /.aside -->

</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>

<!-- /.aside -->
<aside class="aside-xxl bg-white b-l hide" id="aside">
    <section class="vbox">
		<section class="scrollable wrapper">
            <?=form_open(base_url().'job_order/set_filter','autocomplete="off" id="form_period" class="form-horizontal"')?>                    
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
        
        var table_job_order = $('#tbl-job-order').DataTable({
            processing: true,
            serverSide: true,
            sDom: "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            sPaginationType: "full_numbers",
            ajax: {
                url: "<?= base_url() ?>job_order/fetch_data",
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
                    "data": "po_spk_no"
                },
                {
                    "data": "so_no"
                },
                {
                    "data": "vessel"
                },
                {
                    "data": "port"
                },
                {
                    "data": "fare_trip_cd"
                },
                {
                    "data": "price_amount"
                },
                {
                    "data": "item_name"
                },
                {
                    "data": "dropdown_status"
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
                table_job_order.search(value).draw();
            } 
            if (value.length == 0) {
                table_job_order.search(value).draw();
            } 
        });
        $(".start_date").on("dp.change", function (e) {
            var start_date = $("#start_date").val();
            table_job_order.columns(12).search(start_date).draw();
            $("#start_date").blur();
        });
        $(".end_date").on("dp.change", function (e) {
            var end_date = $("#end_date").val();
            table_job_order.columns(13).search(end_date).draw();
            $("#end_date").blur();
        });
    });
</script>