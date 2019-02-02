<section id="content" style="background-color: #fff;"> 
	<section class="vbox"> 
		<section class="scrollable padder">
			<div class="m-b-md"> 
				<h3 class="m-b-none"><?=lang('dashboard')?>
					<small>
						<?=lang('welcome_back')?>, 
						<?=$this->user_profile->get_profile_details($this->tank_auth->get_user_id(),'fullname') ? $this->user_profile->get_profile_details($this->tank_auth->get_user_id(),'fullname') : $this->tank_auth->get_username(); ?>.
					</small>
				</h3>
				<br />

				<!-- BEGIN DASHBOARD STATS 1-->
				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<a class="dashboard-stat dashboard-stat-v2 blue" href="#">
							<div class="visual">
								<i class="fa fa-comments"></i>
							</div>
							<div class="details">
								<div class="number">
									<span data-counter="counterup" data-value="<?=$jo_total?>"><?=$jo_total?></span>
								</div>
								<div class="desc"> Job Order </div>
							</div>
						</a>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<a class="dashboard-stat dashboard-stat-v2 red" href="#">
							<div class="visual">
								<i class="fa fa-dollar"></i>
							</div>
							<div class="details">
								<div class="number">
									<span data-counter="counterup" data-value="<?=$ca_total?>"><?=$ca_total?></span>
								</div>
								<div class="desc"> Cash Advance </div>
							</div>
						</a>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<a class="dashboard-stat dashboard-stat-v2 green" href="#">
							<div class="visual">
								<i class="fa fa-money"></i>
							</div>
							<div class="details">
								<div class="number">
									<span data-counter="counterup" data-value="<?=$realization_total?>"><?=$realization_total?></span>
								</div>
								<div class="desc"> Realization </div>
							</div>
						</a>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<a class="dashboard-stat dashboard-stat-v2 purple" href="#">
							<div class="visual">
								<i class="fa fa-book"></i>
							</div>
							<div class="details">
								<div class="number">
									<span data-counter="counterup" data-value="<?=$unverified_total?>"><?=$unverified_total?></span>
								</div>
								<div class="desc"> Document Unverified </div>
							</div>
						</a>
					</div>
				</div>
				<div class="clearfix"></div>
				<!-- END DASHBOARD STATS 1-->   
				<br>
				<div class="row">
					<div class="col-md-12">
						<header class="header bg-white b-t b-light">
							<br>
							<div class="row" style="padding-top: 10px;">
								<div class="col-md-6" style="padding-top: 5px;">
									<p>
										<i class="fa fa-money font-blue"></i>
										<span class="caption-subject font-blue sbold uppercase"><?=lang('daily_balance')?></span>
									</p>
								</div>     
								<div class="col-md-6 text-right">
									<a class="btn btn-sm green" onclick="add_balance()"><i class="fa fa-plus"></i> Add <?=lang('balance')?></a>
									<a class="btn btn-sm red" onclick="balance_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
									<a class="btn btn-sm btn-success" onclick="balance_excel()"><i class="fa fa-file-excel-o"></i> Print Excel</a>
								</div>
							</div>
						</header>
						<div class="clearfix"></div>
						<br>
						<!-- BEGIN PORTLET-->
						<div class="panel panel-default">
							<div class="panel-body form">
								<!-- BEGIN TABLE-->
								<div class="table-responsive">
									<?php echo validation_errors(); ?>
									<div class="input-group input-daterange pull-right" style="position: relative;top:10px;right: 14px; display: inline-flex;">
										<font style="margin: 5px 10px 0px 0px">Filter:</font>
										<input type="text" name="start_date" id="start_date" class="form-control input-sm start_date" placeholder="<?=lang('start_date')?>" value="<?=date('d-m-Y', strtotime($start_date))?>" style="text-align: center;">
										<span class="input-group-addon" style="width: 50px;">to</span>
										<input type="text" name="end_date" id="end_date" class="form-control input-sm end_date" placeholder="<?=lang('end_date')?>" value="<?=date('d-m-Y', strtotime($end_date))?>" style="text-align: center;">
									</div>
									<br><br>

									<table id="tbl-daily-balance" class="table table-striped table-hover b-t b-light text-sm">
										<thead>
											<tr>
												<th><?=lang('options')?></th>
												<th><?=lang('date')?> </th>
												<th><?=lang('balance')?> </th>
												<th><?=lang('use_balance')?> </th>
												<th><?=lang('remaining_balance')?> </th>
											</tr> 
										</thead>
									</table>
								</div>
								<!-- END TABLE-->
							</div>
						</div>
						<!-- END PORTLET-->
					</div>
				</div>
			</div>	
		</section>
	</section>

	<!-- Bootstrap modal -->
	<div class="modal fade" id="modal_form" role="dialog">
		<div class="modal-dialog" style="width:600px;height:200px;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title"><?=lang('new_balance')?></h3>
				</div>
				<div class="modal-body form">
					<?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>
						<input type="hidden" name="rowID" value="">

						<div class="form-group form-md-line-input">
							<label class="col-lg-4 control-label"><?=lang('balance')?><span class="text-danger">*</span></label>
							<div class="col-lg-8">
								<input type="text" class="form-control angka_jutaan" name="balance" placeholder="Input <?=lang('balance')?>" autocomplete="off" required>
							</div>
						</div>						
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" id="btnSave" onclick="save_balance()" class="btn green">Save</button>
					<button type="button" class="btn red" data-dismiss="modal">Cancel</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>

<script type="text/javascript">
$(function() {
        $('.start_date, .end_date').datetimepicker({
            format: 'DD-MM-YYYY',
            showTodayButton:true
        }); 
        
        var table_daily_balance = $('#tbl-daily-balance').DataTable({
            processing: true,
            serverSide: true,
            sDom: "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            sPaginationType: "full_numbers",
            ajax: {
                url: "<?= base_url() ?>homepage/fetch_data",
                type: 'POST',
                data: {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
            },
            columns: [
                {
                    "data": "dropdown_option", "orderable": false, "searchable": false
                },
                {
                    "data": "date_created"
                },
                {
                    "data": "balance"
                },
                {
                    "data": "use_balance"
                },
                {
                    "data": "remaining_balance"
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
                table_daily_balance.search(value).draw();
            } 
            if (value.length == 0) {
                table_daily_balance.search(value).draw();
            } 
        });
        $(".start_date").on("dp.change", function (e) {
            var start_date = $("#start_date").val();
            table_daily_balance.columns(5).search(start_date).draw();
            $("#start_date").blur();
        });
        $(".end_date").on("dp.change", function (e) {
            var end_date = $("#end_date").val();
            table_daily_balance.columns(6).search(end_date).draw();
            $("#end_date").blur();
        });
    });
</script>
