<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
    <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="row" style="padding-top: 10px;">
                <div class="col-md-6" style="padding-top: 5px;">
                    <p><?=lang('realization_list_branch')?></p>              
                </div>     
                <div class="col-md-6 text-right">
                    <!-- <a href="#aside" data-toggle="class:show" id="btnFilter" onclick="showFilterText()" style="color: #46b8da;">Show Filter</a> -->
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


                      <table id="tbl-realization" class="table table-striped table-hover b-t b-light text-sm">
                        <thead>
                          <tr>
                            <th><?=lang('options')?></th>
                            <th><?=lang('realization_no')?></th>
                            <th><?=lang('cash_advance_no')?></th>
                            <th>Realization <?=lang('date')?></th>
                            <th><?=lang('driver')?>/<?=lang('employee')?> Name</th>
                            <th>Police No</th>
                            <th><?=lang('description')?></th>
                            <th><?=lang('cash_advance_total')?></th>
                            <th><?=lang('realization_total')?></th>

                            <!-- For filter by Ajax Server Side -->
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
 <!-- </aside>-->
  <!-- /.aside -->
 
 <select id="cost_code" panelHeight="auto" style="display:none;">
     <option value=" " disabled selected><?=lang('select_your_option')?></option>
	 <?php if (!empty($cost)) {
	  foreach ($cost as $rs) { ?>
	  <option value="<?php echo $rs->rowID;?>"><?php echo $rs->cost_cd.' - '.$rs->descs;?></option>
	 <?php }} ?>
 </select>
 
 <select id="ContType" panelHeight="auto" style="display:none;">
     <option value="">Select container size</option>
     <option value="20">1 x 20 Feet</option>
     <option value="220">2 x 20 Feet</option>
     <option value="40">1 x 40 Feet</option>
     <option value="45">1 x 45 Feet</option>
 </select>
  
 <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_realization" role="dialog" style="overflow: scroll;">
  <div class="modal-dialog" style="width:1200px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title modal-title-realization"></h3>
      </div>
      <!--<section class="scrollable wrapper">-->
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>

          <div class="form-body">
                <div class="row"> 
					<div class="col-xs-6">
						<div class="group">	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('date')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>										
									<input  class="input-sm input-s form-control" size="10" type="text" value="<?=date('d-m-Y')?>" id="date" name="date" readonly="" required="" />
								</p></div>
							</div>	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('cash_advance_no')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
									<input  type="text" class="form-control" id="cash_advance_no" name="cash_advance_no" value="" readonly style="font-size:22px;font-weight:900;color: black;">
								</p></div>								
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('cash_advance_type')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
									<input  type="text" class="form-control" id="cash_advance_type" name="cash_advance_type"  value="" readonly="">
							</p></div>
							</div>
                            <div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('employee')?>/<?=lang('driver')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">
                                <p>
									<input  type="text" class="form-control" id="driver_name" name="driver_name"  value="" readonly >
								</p>
                                </div>
							</div>	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('fare_trip')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>                                    
									<textarea class="form-control" id="remark" name="remark" maxlength="60" rows="2"  readonly></textarea>
								</p></div>
							</div>			
							
						</div>
					</div>
					<div class="col-xs-6">
						<div class="group">	
                            <div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('vehicle')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">
                                <p>
									<input type="text" class="form-control" id="vehicle_no_type" name="vehicle_no_type" value="" readonly>
                                </p>
                                </div>																
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('cash_advance')?> <?=lang('amount')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
									<input  type="text" class="form-control currency" id="cash_advance_amt" name="cash_advance_amt" style="font-size:22px;font-weight:900;color: black;text-align: right;" value="" readonly>
								</p></div>																
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('cash_advance')?> <?=lang('settlement')?> <?=lang('amount')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
									<input  type="text" class="form-control currency" id="cash_advance_alloc" name="cash_advance_alloc" style="font-size:22px;font-weight:900;color: black;text-align: right;" value="" readonly>
								</p></div>																
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('cash_advance')?> <?=lang('balance')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
									<input  type="text" class="form-control currency" id="cash_advance_balance" name="cash_advance_balance" style="font-size:22px;font-weight:900;color: black;text-align: right;" value="" readonly>
								</p></div>																
							</div>	
                            <div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4">Document</div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">
                                <p>
									<input  type="checkbox" id="doc_sj" name="doc_sj"  value="Yes" style="width: 15px;" readonly > SJ &nbsp; &nbsp;
									<input  type="checkbox" id="doc_st" name="doc_st"  value="Yes" style="width: 15px;" readonly > ST &nbsp; &nbsp;
									<input  type="checkbox" id="doc_sm" name="doc_sm"  value="Yes" style="width: 15px;" readonly > SM &nbsp; &nbsp;
									<input  type="checkbox" id="doc_sr" name="doc_sr"  value="Yes" style="width: 15px;" readonly > SR
								</p>
                                
							    <input  type="hidden" class="form-control" id="driver" name="driver"  value="">
								
                                <input  type="hidden" class="form-control" id="prefix" name="prefix"  value="">
								<input  type="hidden" class="form-control" id="year" name="year" value="">
								<input  type="hidden" class="form-control" id="month" name="month" value="">
								<input  type="hidden" class="form-control" id="code" name="code"  value="">
								<input  type="hidden" class="form-control" id="counter_costcode" name="counter_costcode"  value="4">
                                <input  type="hidden" class="form-control" id="cash_advance_date" name="cash_advance_date"  value="">

                                <input  type="hidden" class="form-control" id="fare_trip_code" name="fare_trip_code"  value="">
                                <input  type="hidden" class="form-control" id="fare_trip_id" name="fare_trip_id"  value="">
                                <input  type="hidden" class="form-control" id="vehicle_type_id" name="vehicle_type_id"  value="">

								<input  type="hidden" class="form-control currency" id="cash_advance_alloc_" name="cash_advance_alloc_" style="font-size:22px;font-weight:900;color: black;text-align: right;" value="" readonly>
                                <input  type="hidden" class="form-control" id="cash_advance_type_id" name="cash_advance_type_id"  value="">
                                <input  type="hidden" class="form-control" id="advance_amount" name="advance_amount"  value="">
                                
								<input  type="hidden" class="form-control" id="on_process" name="on_process" readonly>
                                <input type="hidden" name="row_id" id="row_id" value="1" />
                                <input type="hidden" name="row_job_id" id="row_job_id" value="0" />
                                <input type="hidden" name="row_job_id_tmp" id="row_job_id_tmp" value="0" />
                                <input type="hidden" name="row_cost_id_tmp" id="row_cost_id_tmp" />
								
                            	<input  type="hidden" class="form-control" id="vehicle_type" name="vehicle_type"  value="">
								<input  type="hidden" class="form-control" id="jo_type" name="jo_type"  value="">
								<input  type="hidden" class="form-control" id="from_id" name="from_id"  value="">
								<input  type="hidden" class="form-control" id="to_id" name="to_id"  value="">
								<input  type="hidden" class="form-control" id="alloc_no" name="alloc_no"  value="">

                                </div>
							</div>	
                            <div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('status')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p>
                                    <input type="hidden" class="form-control" id="status_external" name="status_external" value="0" />
									<input type="checkbox" id="cancel_load" name="cancel_load" onclick="chk_cancel_load()" value="1" style="width: 15px;"> <?=lang('cancel_load')?> <br />
                                    <input type="checkbox" id="pok" name="cancel_load" onclick="chk_cancel_load()" value="2" style="width: 15px;"> POK <br />
                                    <input type="checkbox" id="pok_external" name="cancel_load" onclick="chk_pok_external()" value="3" style="width: 15px;"> POK Vehicle External <br />
                                    <input type="checkbox" id="ca_pok" name="cancel_load" onclick="chk_pok_external()" value="4" style="width: 15px;"> POK Vehicle Internal <br />
                                    <div id="reference_pok_no_field" style="display: none;">
                                        <div class="input-group">
                                            <input class="form-control input-sm" id="reference_pok_no_1" name="reference_pok_no_1" readonly="readonly" type="text" placeholder="Select CA No (POK)" />
                                            <span class="input-group-addon btn btn-sm" id="basic-addon1" onclick="show_ca_pok(1)"><i class="fa fa-search"></i></span>
                                        </div>
                                        <div class="input-group">
                                            <input class="form-control input-sm" id="reference_pok_no_2" name="reference_pok_no_2" readonly="readonly" type="text" placeholder="Select CA No (POK)" />
                                            <span class="input-group-addon btn btn-sm" id="basic-addon1" onclick="show_ca_pok(2)"><i class="fa fa-search"></i></span>
                                        </div>
                                    </div>
								</p></div>
							</div>									
						</div>	
					</div>		

				</div>
                <br />
            </div>
               <div class="bs-example">
                    <ul class="nav nav-tabs">
                        <li id="choose_delivery" class="active"><a data-toggle="tab" href="#delivery_order"><?=lang('delivery_order') ?></a></li>
                        <li id="choose_cost" ><a data-toggle="tab" href="#cost"><?=lang('cost_code_details') ?></a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="delivery_order" class="tab-pane active">
                        <br />
                          
                            <div class="table-responsive"> 
                                <table class="table table-responsive table-striped table-condensed" id="detail_DO">
                                    <tr>
                                        <th style="width: 5%;">
                                            <input id="tamdet" title="Tambah Baris" type="button" onclick="addRow_DeliveryOrderRealization()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
                                        </th>
                                        <th><?=lang('job_order_no')?></th>
                                        <th>Container</th>
                                        <th>Container No</th>
                                        <th><?=lang('delivery_order_no')?></th>
                                        <th><?=lang('delivery_order_date')?></th>
                                        <th><?=lang('qty_delivery')?></th>
                                        <th><?=lang('receipt_date')?></th>
                                        <th><?=lang('qty_receipt')?></th>
                                    </tr>
                                </table>
                            </div>
                          
                        </div>
                        <div id="cost" class="tab-pane">
                            <br />
                              <div class="table-responsive">  
                                <table class="table table-responsive table-striped table-condensed" id="detail_cost">
                                    <tr>
                                        <th style="width: 3%;">
                                            <input id="tamdetcost" title="Tambah Baris" type="button" onclick="addRow_Cost_Realization(false)" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
                                        </th>
                                        <th class="ganjil"><?=lang('cost')?></th>
                                        <th class="genap"><?=lang('description')?></th>
                                        <th class="ganjil"><?=lang('amount')?></th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
            <p>&nbsp;</p>
          </div>
          <!--</section>-->  
          <div class="modal-footer">
            <!--<input type="hidden" id="tag" value="">-->
            <button type="button" id="btnSave" onclick="save_edit_cash_advance_realization()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
  
  <!-- Modal JO-->
  <div class="modal fade" id="joModal" role="dialog">
    <div class="modal-dialog" style="width:1000px;height:30px;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title modal-job-title">Job Order List</h4>
        </div>
        <div class="modal-body">
          <!--<section class="scrollable wrapper">-->
          <div class="row">
           <input type="hidden" id="tag" value="">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive">
                  <table id="tbl-joborder" class="table table-responsive table-striped"></table>
              </div>
            </section>            
          </div>
        </div>
      <!--</section>-->
    </div>
</div>
</div>
</div>

    <!-- Modal List Realisasi CA POK  -->
    <div class="modal fade" id="modal_select_ca_pok" role="dialog">
      <div class="modal-dialog" style="width:75%;height:200px;">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title modal-title-pok"><?=lang('select').' CA Realization POK'?></h3>
          </div>
          <div class="modal-body form">
            <input type="hidden" id="row_no_reference" name="row_no_reference" />
            <table id="tbl-ca-pok" class="table table-responsive table-striped table-condensed table-hover" style="width: 100%;">
                <thead>
                    <th width="5%">No</th>
                    <th><?=lang('cash_advance_no')?></th>
					<th>CA <?=lang('date')?></th>
					<th><?=lang('driver')?>/<?=lang('employee')?> Name</th>
					<th><?=lang('fare_trip_code')?></th>
                    <th width="10%">Police No</th>
                </thead>
                <tbody>
                <?php
                if(count($ca_poks) > 0){
                    $no = 1;
                    foreach($ca_poks as $ca_pok){
                ?>
                        <tr style="cursor:pointer" onclick="get_ca_pok('<?=$ca_pok->advance_no?>')">
                            <td><?=number_format($no,0,',','.')?></td>
                            <td><?=$ca_pok->advance_no?></td>
							<td style="width:10%"><?=date("d-m-Y H:i:s",strtotime($ca_pok->advance_date.' '.$ca_pok->time_created))?></td>
							<td><?=$ca_pok->debtor_code?> - <?=$ca_pok->debtor_name?></td>
							<td><?=$ca_pok->fare_trip_no == '' ? '-' : str_replace('-',' - ',$ca_pok->fare_trip_no)?></td>
                            <td><?=$ca_pok->police_no?></td>
                        </tr>
                <?php   
                        $no++;
                    }
                }                
                ?>
                </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn red" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
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
                <input type="hidden" name="row_do_api" id="row_do_api" value="" />
                <!--<div id="view_data_do">&nbsp;</div>-->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <div class="row">
                                <div class="col-md-2">
                                    <input class="form-control input-sm tanggal_datetimepicker" value="<?=date('d-m-Y')?>" name="do_date_api" id="do_date_api" placeholder="dd-mm-yyyy" style="text-align:center;" required="" type="text">
                                </div>
                                <div class="col-md-1" style="padding-left: 0px;">
                                    <button type="button" class="btn btn-sm btn-info" onclick="filterDO()"><i class="fa fa-search"></i> Search</button>
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
    
    var table_realization = $('#tbl-realization').DataTable({
        processing: true,
        serverSide: true,
        sDom: "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        sPaginationType: "full_numbers",
        ajax: {
            url: "<?= base_url() ?>realizations_branch/fetch_data",
            type: 'POST',
            data: {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
        },
        columns: [
            {
                "data": "dropdown_option", "orderable": false, "searchable": false
            },
            {
                "data": "alloc_no"
            },
            {
                "data": "advance_no"
            },
            {
                "data": "alloc_date"
            },
            {
                "data": "debtor_cd"
            },
            {
                "data": "police_no"
            },
            {
                "data": "descs"
            },
            {
                "data": "total_cash_advance", "className": "text-right"
            },
            {
                "data": "alloc_amt", "className": "text-right"
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
            table_realization.search(value).draw();
        } 
        if (value.length == 0) {
            table_realization.search(value).draw();
        } 
    });
    $(".start_date").on("dp.change", function (e) {
        var start_date = $("#start_date").val();
        table_realization.columns(9).search(start_date).draw();
        $("#start_date").blur();
    });
    $(".end_date").on("dp.change", function (e) {
        var end_date = $("#end_date").val();
        table_realization.columns(10).search(end_date).draw();
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
    //                             '<th><?=lang('no')?></th>' +
    //             				'<th><?=lang('delivery_order_no')?></th>' +
    //             				'<th><?=lang('no_barcode')?></th>' +
    //             				'<th><?=lang('driver_name')?></th>' +
    //             				'<th><?=lang('vehicle_police_no')?></th>' +
    //             				'<th><?=lang('vessel_name')?></th>' +
    //             				'<th><?=lang('delivery_order_date')?> </th>' +
    //             				'<th><?=lang('qty_delivery')?> </th>' +
    //             				'<th><?=lang('receipt_date')?> </th>' +
    //             				'<th><?=lang('qty_receipt')?> </th>' +
    //                         '</thead>';
                
    //         var no = 1;
    //         $.each(result, function(key, data) {	
                
	// 			isi_table += '<tr onclick="get_data_do(\''+data.do_no+'\',\''+data.str_do_date+'\',\''+
    //                                                         data.qty_deliver+'\',\''+data.str_receipt_date+'\',\''+
    //                                                         data.qty_receipt+'\')" style="cursor:pointer">'+
    //                             '<td>'+no+'</td>' +
    //                             '<td>'+data.do_no+'</td>' +
    //                             '<td>'+data.barcode_no+'</td>' +
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
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>

<!-- /.aside -->
<aside class="aside-xxl bg-white b-l hide" id="aside">
    <section class="vbox">
		<section class="scrollable wrapper">
            <?=form_open(base_url().'realizations_branch/set_filter','autocomplete="off" id="form_period" class="form-horizontal"')?>                    
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
