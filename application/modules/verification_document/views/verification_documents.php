<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <aside>
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="row" style="padding-top: 10px;">
                <div class="col-md-6" style="padding-top: 5px;">
                    <p><?=lang('verification_documents')?></p>              
                </div>     
                <div class="col-md-6 text-right">
                    <!-- <a href="#aside" data-toggle="class:show" id="btnFilter" onclick="showFilterText()" style="color: #46b8da;">Show Filter</a> &nbsp; -->
                    <?php
                    if($this->user_profile->get_user_access('PrintLimited') == 1 || $this->user_profile->get_user_access('PrintUnlimited') == 1 || 
                        $this->user_profile->get_user_access('PrintOne') == 1 || $this->user_profile->get_user_access('PrintTwo') == 1){
                    ?>
                        <button type="button" class="btn btn-sm red" onclick="verification_document_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</button>
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
                <table class="table table-striped table-hover b-t b-light text-sm" id="tbl-data-verification">
                      <thead>            
                          <tr>
                            <th><?=lang('no')?></th>
                            <th><?=lang('driver')?>/<?=lang('employee')?> Name</th>
                            <th>Comm Driver</th>
                            <th>Comm Co Driver</th>
                            <th>Document</th>
                            <th><?=lang('delivery_order_no')?> </th>
                            <th><?=lang('delivery_order_container')?> </th>
                            <th>Receive Date</th>
                            <th>Tonase Receive </th>
                            <th>JO No </th>
                            <th>Vessel Name </th>
                            <th>From - To </th>
                            <th>Cargo</th>
                            <th>Realization No</th>
                            <th>User Created</th>
                            <th>Action</th>

                            <!-- For Filter Date -->
                            <th>Start Date</th>
                            <th>End Date</th>
                          </tr> 
                      </thead> 
                  </table>
              </div>
            </section>            
          </div>
        </div>
      </section>

    </section>
  
  <!-- Modal Verifikasi -->
    <div class="modal fade" id="modal_verifikasi" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title"><?=lang('verification')?></h3>
          </div>
          <div class="modal-body form">
            <?=form_open('','autocomplete="off" id="form_verify" class="form-horizontal"')?>
  				<div class="row"> 
					<div class="col-xs-12">
						<div class="form-group form-md-line-input">
							<div class="col-md-4"><?=lang('your_password')?> <span class="text-danger">*</span></div>
							<div class="col-md-1">:</div>
							<div class="col-md-7">
                                <input type="hidden" class="form-control" id="trx_no" name="trx_no" required >										
                                <input type="hidden" class="form-control" id="row_id" name="row_id" required >										
								<input type="password" class="form-control" id="password" name="password" required="" />
							</div>
                        </div>
                    </div>
                </div>
            <?=form_close()?>
          </div>
          <div class="modal-footer">
            <button type="button" onclick="verify_password_document()" class="btn green"><?=lang('verify')?></button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

<div class="modal fade" id="modal_detail_do" role="dialog">
  <div class="modal-dialog" style="width:90%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title-select-do">Detail Delivery Order</h3>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div id="view_detail_do">&nbsp;</div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn red" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    
<div class="modal fade" id="modal_detail_jo" role="dialog">
  <div class="modal-dialog" style="width:90%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title-select-do">Detail Job Order</h3>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div id="view_detail_jo">&nbsp;</div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn red" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_edit_document" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title-edit">Edit Document</h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form_edit" class="form-horizontal"')?>
            <input type="hidden" class="form-control" id="row_id_edit" name="row_id_edit" required="" />
            <input type="hidden" class="form-control" id="jo_type" name="jo_type" required="" />
            <input type="hidden" class="form-control" id="from_id" name="from_id" required="" />
            <input type="hidden" class="form-control" id="to_id" name="to_id" required="" />
            <input type="hidden" class="form-control" id="jo_verify" name="jo_verify" required="" />
            <div class="row"> 
				<div class="form-group form-md-line-input">
                    <div class="col-md-1">&nbsp;</div>
                    <label class="col-md-4 control-label">Comm Driver <span class="text-danger">*</span></label>
					<div class="col-md-4">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1">Rp</span>
                          <input type="text" class="form-control angka_jutaan text-right" id="komisi_supir" name="komisi_supir" required="" />
                        </div>
					</div>
                </div>
            </div>
            <div class="row"> 
				<div class="form-group form-md-line-input">
                    <div class="col-md-1">&nbsp;</div>
                    <label class="col-md-4 control-label">Comm Co Driver <span class="text-danger">*</span></label>
					<div class="col-md-4">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1">Rp</span>
                          <input type="text" class="form-control angka_jutaan text-right" id="komisi_kernet" name="komisi_kernet" required="" />
                        </div>
					</div>
                </div>
            </div>
            <div class="row"> 
				<div class="form-group form-md-line-input">
                    <div class="col-md-1">&nbsp;</div>
                    <label class="col-md-4 control-label"><?=lang('job_order_no')?> <span class="text-danger">*</span></label>
					<div class="col-md-4">
                        <input type="text" class="form-control" id="jo_no" name="jo_no" required="" readonly="" style="background-color:white;border:solid 1px #ccc;cursor:pointer" />
					</div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-sm btn-info" id="button_search_jo" onclick="showModalJOVerification();" title="Search JO"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
			<div class="row"> 
				<div class="form-group form-md-line-input">
                    <div class="col-md-1">&nbsp;</div>
					<label class="col-md-4 control-label"><?=lang('delivery_order_no')?> <span class="text-danger">*</span></label>
					<div class="col-md-4">
                        <input type="text" class="form-control" id="do_no" name="do_no" required="" />
					</div>
                    <div class="col-md-1">
                        <!-- <button type="button" class="btn btn-sm btn-info" id="button_search" onclick="showModalDOVerification();" title="Search DO"><i class="fa fa-search"></i></button> -->
                    </div>
                </div>
            </div>
            <div class="row container_field"> 
				<div class="form-group form-md-line-input">
                    <div class="col-md-1">&nbsp;</div>
                    <label class="col-md-4 control-label">Container No <span class="text-danger">*</span></label>
					<div class="col-md-4">
                        <input type="text" class="form-control" id="container_no" name="container_no" required="" />
					</div>
                </div>
            </div>
            <div class="row container_field"> 
				<div class="form-group form-md-line-input">
                    <div class="col-md-1">&nbsp;</div>
                    <label class="col-md-4 control-label"><?=lang('job_order_container_size')?></label>
					<div class="col-md-3">
                        <select class="form-control" id="container_size" name="container_size" required="">
                            <option value="0"><?=lang('select_your_option')?></option>
                            <option value="20">1 x 20 Feet</option>
                            <option value="220">2 x 20 Feet</option>
                            <option value="40">1 x 40 Feet</option>
                            <option value="45">1 x 45 Feet</option>
                        </select>
					</div>
                </div>
            </div>
            <div class="row container_field"> 
				<div class="form-group form-md-line-input">
                    <div class="col-md-1">&nbsp;</div>
                    <label class="col-md-4 control-label">Qty Container</label>
					<div class="col-md-4">
                        <select class="form-control" id="container_row_no" name="container_row_no" required="">
                            <option value="0"><?=lang('select_your_option')?></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
					</div>
                </div>
            </div>
            <div class="row"> 
				<div class="form-group form-md-line-input">
                    <div class="col-md-1">&nbsp;</div>
                    <label class="col-md-4 control-label"><?=lang('delivery_order_date')?> <span class="text-danger">*</span></label>
					<div class="col-md-3">
                        <input type="text" class="form-control tanggal_datetimepicker" id="deliver_date" name="deliver_date" required="" />
					</div>
                </div>
            </div>
            <div class="row"> 
				<div class="form-group form-md-line-input">
                    <div class="col-md-1">&nbsp;</div>
                    <label class="col-md-4 control-label"><?=lang('qty_delivery')?> <span class="text-danger">*</span></label>
					<div class="col-md-3">
                        <input type="text" class="form-control angka_jutaan" id="deliver_weight" name="deliver_weight" required="" />
					</div>
                </div>
            </div>
            <div class="row"> 
				<div class="form-group form-md-line-input">
                    <div class="col-md-1">&nbsp;</div>
                    <label class="col-md-4 control-label"><?=lang('receipt_date')?> <span class="text-danger">*</span></label>
					<div class="col-md-3">
                        <input type="text" class="form-control tanggal_datetimepicker" id="received_date" name="received_date" required="" />
					</div>
                </div>
            </div>
			<div class="row"> 
				<div class="form-group form-md-line-input">
                    <div class="col-md-1">&nbsp;</div>
                    <label class="col-md-4 control-label"><?=lang('qty_receipt')?> <span class="text-danger">*</span></label>
					<div class="col-md-3">
                        <input type="text" class="form-control angka_jutaan" id="received_weight" name="received_weight" required="" />
					</div>
                </div>
            </div>
        <?=form_close()?>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="save_update_document()" class="btn green">Update</button>
        <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modal_verification_document" role="dialog">
  <div class="modal-dialog" style="width: 75%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title-verification"><?=lang('verification_documents')?></h3>
      </div>
      <div class="modal-body form">
        <div class="row">
            <div class="col-md-6">
                <div class="row"> 
    				<div class="form-group form-md-line-input">
                        <label class="col-md-4 control-label"><?=lang('realization_no')?></label>
    					<div class="col-md-8">
                            <span id="doc_realization_no"></span>
    					</div>
                    </div>
                </div>
                <br />
                <div class="row"> 
    				<div class="form-group form-md-line-input">
                        <label class="col-md-4 control-label">Realization Amount</label>
    					<div class="col-md-8">
                            <span id="doc_realization_amount"></span>
    					</div>
                    </div>
                </div>
                <br />
                <div class="row"> 
    				<div class="form-group form-md-line-input">
                        <label class="col-md-4 control-label">Driver Name</label>
    					<div class="col-md-8">
                            <span id="doc_nama_supir"></span>
    					</div>
                    </div>
                </div>
                <br />
                <div class="row"> 
    				<div class="form-group form-md-line-input">
                        <label class="col-md-4 control-label">Police No</label>
    					<div class="col-md-8">
                            <span id="doc_police_no"></span>
    					</div>
                    </div>
                </div>
                <br />
                <div class="row"> 
    				<div class="form-group form-md-line-input">
                        <label class="col-md-4 control-label">Comm Driver</label>
    					<div class="col-md-8">
                            <span id="doc_komisi_supir"></span>
    					</div>
                    </div>
                </div>
                <br />
                <div class="row"> 
    				<div class="form-group form-md-line-input">
                        <label class="col-md-4 control-label">Comm Co Driver</label>
    					<div class="col-md-8">
                            <span id="doc_komisi_kernet"></span>
    					</div>
                    </div>
                </div>
                <br />
                <div class="row"> 
    				<div class="form-group form-md-line-input">
                        <label class="col-md-4 control-label"><?=lang('job_order_no')?></label>
    					<div class="col-md-8">
                            <span id="doc_jo_no"></span>
    					</div>
                    </div>
                </div>
                <br />
    			<div class="row"> 
    				<div class="form-group form-md-line-input">
    					<label class="col-md-4 control-label"><?=lang('vessel_name')?></label>
    					<div class="col-md-8">
                            <span id="doc_vessel_name"></span>
    					</div>
                    </div>
                </div>
                <br />
    			<div class="row"> 
    				<div class="form-group form-md-line-input">
    					<label class="col-md-4 control-label"><?=lang('destination')?></label>
    					<div class="col-md-8">
                            <span id="doc_destination"></span>
    					</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
    			<div class="row"> 
    				<div class="form-group form-md-line-input">
    					<label class="col-md-5 control-label"><?=lang('cargo')?></label>
    					<div class="col-md-7">
                            <span id="doc_item_name"></span>
    					</div>
                    </div>
                </div>
                <br />
    			<div class="row"> 
    				<div class="form-group form-md-line-input">
    					<label class="col-md-5 control-label">Qty Container</label>
    					<div class="col-md-7">
                            <span id="doc_qty_container"></span>
    					</div>
                    </div>
                </div>
                <br />
                <div class="row"> 
    				<div class="form-group form-md-line-input">
    					<label class="col-md-5 control-label">Container No</label>
    					<div class="col-md-7">
                            <span id="doc_container_no"></span>
    					</div>
                    </div>
                </div>
                <br />
    			<div class="row"> 
    				<div class="form-group form-md-line-input">
    					<label class="col-md-5 control-label"><?=lang('job_order_container_size')?></label>
    					<div class="col-md-7">
                            <span id="doc_container_size"></span>
    					</div>
                    </div>
                </div>
                <br />
                <div class="row"> 
    				<div class="form-group form-md-line-input">
    					<label class="col-md-5 control-label"><?=lang('delivery_order_no')?></label>
    					<div class="col-md-7">
                            <span id="doc_do_no"></span>
    					</div>
                    </div>
                </div>
                <br />
                <div class="row"> 
    				<div class="form-group form-md-line-input">
                        <label class="col-md-5 control-label"><?=lang('delivery_order_date')?></label>
    					<div class="col-md-7">
                            <span id="doc_deliver_date"></span>
    					</div>
                    </div>
                </div>
                <br />
                <div class="row"> 
    				<div class="form-group form-md-line-input">
                        <label class="col-md-5 control-label"><?=lang('qty_delivery')?></label>
    					<div class="col-md-7">
                            <span id="doc_deliver_weight"></span>
    					</div>
                    </div>
                </div>
                <br />
                <div class="row"> 
    				<div class="form-group form-md-line-input">
                        <label class="col-md-5 control-label"><?=lang('receipt_date')?></label>
    					<div class="col-md-7">
                            <span id="doc_received_date"></span>
    					</div>
                    </div>
                </div>
                <br />
    			<div class="row"> 
    				<div class="form-group form-md-line-input">
                        <label class="col-md-5 control-label"><?=lang('qty_receipt')?></label>
    					<div class="col-md-7">
                            <span id="doc_received_weight"></span>
    					</div>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnVerification" class="btn green">Verify</button>
        <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modal_select_jo" role="dialog">
  <div class="modal-dialog" style="width:85%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title-select-do">Select Job Order</h3>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                          <table id="tbl-data-jo" class="table table-responsive table-striped" width="100%"></table>
                        </div>                            
                    </div>
                </div>            
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn red" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_select_do_api" role="dialog">
  <div class="modal-dialog" style="width:90%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title-select-do">Select DO</h3>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <div class="row">
                                <div class="col-md-2">
                                    <input class="form-control input-sm tanggal_datetimepicker" value="<?=date('d-m-Y')?>" name="do_date_api" id="do_date_api" placeholder="dd-mm-yyyy" style="text-align:center;" required="" type="text">
                                </div>
                                <div class="col-md-1" style="padding-left: 0px;">
                                    <button type="button" class="btn btn-sm btn-info" onclick="filterDOVerification()"><i class="fa fa-search"></i> Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                          <table id="tbl-data-do" class="table table-responsive table-striped" width="100%"></table>
                        </div>                            
                    </div>
                </div>            
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn red" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(function() {
   
    $('.start_date, .end_date').datetimepicker({
        format: 'DD-MM-YYYY',
        showTodayButton:true
    }); 

   var table_verification = $('#tbl-data-verification').DataTable({
        processing: true,
        serverSide: true,
        sDom: "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        sPaginationType: "full_numbers",
        ajax: {
            url: "<?= base_url() ?>verification_document/fetch_data",
            type: 'POST',
            data: {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
        },
        columns: [
            {
                "data": "no", "orderable": false, "searchable": false
            },
            {
                "data": "debtor_name"
            },
            {
                "data": "komisi_supir"
            },
            {
                "data": "komisi_kernet"
            },
            {
                "data": "document"
            },
            {
                "data": "do_no"
            },
            {
                "data": "container_no"
            },
            {
                "data": "received_date"
            },
            {
                "data": "received_weight"
            },
            {
                "data": "jo_no"
            },
            {
                "data": "vessel_name"
            },
            {
                "data": "from_name"
            },
            {
                "data": "item_name"
            },
            {
                "data": "trx_no"
            },
            {
                "data": "username"
            },
            {
                "data": "action"
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
            table_verification.search(value).draw();
        } 
        if (value.length == 0) {
            table_verification.search(value).draw();
        } 
    });
   $(".start_date").on("dp.change", function (e) {
        var start_date = $("#start_date").val();
        table_verification.columns(14).search(start_date).draw();
        $("#start_date").blur();
    });
   $(".end_date").on("dp.change", function (e) {
        var end_date = $("#end_date").val();
        table_verification.columns(15).search(end_date).draw();
        $("#end_date").blur();
    });

    // $.ajax({
    //     type: "POST",
    //     url : "<?php echo base_url(); ?>api.php",
    // 	data: 'type=get_data_do&do_date=<?=date('d-m-Y')?>&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
    //     dataType:"JSON",
    //     cache:false,
    //     success: function(result){
            
    //         $('#tbl-data-do').html('');

    //         var isi_table = '<thead>'+
    //                             '<th>No</th>' +
    //             				'<th><?=lang('delivery_order_no')?></th>' +
    //             				'<th>Driver Name</th>' +
    //             				'<th>Police No</th>' +
    //             				'<th>Vessel Name</th>' +
    //             				'<th><?=lang('delivery_order_date')?> </th>' +
    //             				'<th><?=lang('qty_delivery')?> </th>' +
    //             				'<th><?=lang('receipt_date')?> </th>' +
    //             				'<th><?=lang('qty_receipt')?> </th>' +
    //                         '</thead>';
                
    //         var no = 1;
    //         $.each(result, function(key, data) {	
                
	// 			isi_table += '<tr onclick="get_data_do_verification(\''+data.do_no+'\',\''+data.str_do_date+'\',\''+
    //                                                         data.qty_deliver+'\',\''+data.str_receipt_date+'\',\''+
    //                                                         data.qty_receipt+'\')" style="cursor:pointer">'+
    //                             '<td>'+no+'</td>' +
    //                             '<td>'+data.do_no+'</td>' +
    //                             '<td>'+data.driver_name+'</td>' +
    //                             '<td>'+data.police_no+'</td>' +
    //                             '<td>'+data.vessel_name+'</td>' +
    //     						'<td>'+data.str_do_date+'</td>' +
    //     						'<td>'+data.qty_deliver+'</td>' +
    //     						'<td>'+data.str_receipt_date+'</td>' +  
    //     						'<td>'+data.qty_receipt+'</td>' +  
    //                          '</tr>';
	// 		     no++;
    //         });  
            
                      
    //         $('#tbl-data-do').append(isi_table);   
               
    //         $('#tbl-data-do').DataTable().destroy();
    //         $('#tbl-data-do').dataTable({
    //     		"bProcessing": true,
    //             "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
    //             "sPaginationType": "full_numbers",
    //     	});
            
    //     },
    // 	error: function(xhr, status, error) {
    // 		document.write(xhr.responseText);
    // 	}
    // }); 
    
});

</script>

    </aside>
  <!-- /.aside -->
  </section> 
  <!-- .aside -->
  </section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>

<!-- /.aside -->
<aside class="aside-xxl bg-white b-l hide" id="aside">
    <section class="vbox">
		<section class="scrollable wrapper">
            <?=form_open(base_url().'verification_document/set_filter','autocomplete="off" id="form_period" class="form-horizontal"')?>                    
            <div class="row">
                <div class="col-md-9">
                    <div class="input-group input-daterange" style="position: relative;display: inline-flex;">
                        <input type="text" name="start_date" id="start_date" class="form-control input-sm tanggal_datetimepicker" placeholder="<?=lang('start_date')?>" value="<?=date('d-m-Y', strtotime($start_date))?>" style="text-align: center;">
                        <span class="input-group-addon" style="width: 50px;">to</span>
                        <input type="text" name="end_date" id="end_date" class="form-control input-sm tanggal_datetimepicker" placeholder="<?=lang('end_date')?>" value="<?=date('d-m-Y', strtotime($end_date))?>" style="text-align: center;">
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
