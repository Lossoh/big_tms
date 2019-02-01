<section id="content">
  <section class="hbox stretch">

      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="row" style="padding-top: 10px;">
                <div class="col-md-6" style="padding-top: 5px;">
                    <p><?=lang('kontra_bon_details')?></p>              
                </div>     
                <div class="col-md-6 text-right">
                    <!-- <a href="#aside" data-toggle="class:show" id="btnFilter" onclick="showFilterText()" style="color: #46b8da;">Show Filter</a> &nbsp; -->
                    <?php
                    if($this->user_profile->get_user_access('Created') == 1){
                    ?>
                        <a  class="btn btn-sm green" onclick="add_ap()"><i class="fa fa-plus"></i> <?=lang('new')?> <?=lang('kontra_bons')?></a>
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

                  <table id="tbl-account-payable" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th><?=lang('options')?></th>
                        <th>KB No</th>
                        <th>KB Date</th>
                        <th>PO No</th>
                        <th>Reference No</th>
                        <th>Description</th>
                        <th>Base Amount (Rp)</th>
                        <th>VAT 10% (Rp)</th>
                        <th>Total Amount (Rp)</th>

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

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog" style="overflow: scroll;">
  <div class="modal-dialog" style="width:1200px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Add Kontra Bon (KB)</h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>
        <input type="hidden" name="rowID" value="">
        <div class="form-body">
            <div class="row">  
                <div class="col-xs-6">
					<div class="group">	
						<div class="row inline-fields form-group form-md-line-input">
							<div class="col-md-4">KB Date<span class="text-danger">*</span></div>
							<div class="col-md-1">:</div>
							<div class="col-md-6"><p>
								<input type="text" class="form-control" name="ap_date" id="ap_date" onblur="setComeBack()" value="<?=date('d-m-Y')?>" required="" readonly="" />
                                <input type="hidden" class="input-sm form-control" name="ap_no" id="ap_no" readonly="" required>
                                <input type="hidden" id="row_id" name="row_id"/>
                                <input type="hidden" id="code" name="code"/>
                                <input type="hidden" id="user_created" name="user_created"/>
                                <input type="hidden" id="date_created" name="date_created"/>
                                <input type="hidden" id="time_created" name="time_created"/>
							</p></div>								
						</div>
                        <div class="row inline-fields form-group form-md-line-input">
							<div class="col-md-4">PO No</div>
							<div class="col-md-1">:</div>
							<div class="col-md-6"><p>										
                                <input type="text" class="form-control" id="po_no" name="po_no" maxlength="35" />
							</p></div>
						</div>
                        <div class="row inline-fields form-group form-md-line-input">
							<div class="col-md-4">TOP<span class="text-danger">*</span></div>
							<div class="col-md-1">:</div>
							<div class="col-md-6"><p>
								<select class="form-control" name="top" id="top" onchange="set_due_date_kb()">
                                    <?php 
                                    if (!empty($references)) {
                                        foreach ($references as $reference) { 
                                    ?>
    								        <option value="<?php echo $reference->type_no;?>"><?php echo $reference->type_name;?></option>
                                    <?php 
                                        }
                                    }
                                    ?>
                                </select> 
							</p></div>								
						</div>
                        <div class="row inline-fields form-group form-md-line-input">
							<div class="col-md-4">Due Date<span class="text-danger">*</span></div>
							<div class="col-md-1">:</div>
							<div class="col-md-6"><p>
								<input type="text" class="form-control"  name="come_back" id="come_back" value="<?=date('d-m-Y');?>" required="" readonly="" />
							</p></div>								
						</div>
                        <div class="row inline-fields form-group form-md-line-input">
							<div class="col-md-4">Reference No/ReceiptNo/Invoice No<span class="text-danger">*</span></div>
							<div class="col-md-1">:</div>
							<div class="col-md-6"><p>										
                                <input type="text" class="form-control" id="ref_no" name="ref_no" maxlength="35" />
							</p></div>
						</div>
                        <div class="row inline-fields form-group form-md-line-input" style="display: none;">
							<div class="col-md-4">KB Type<span class="text-danger">*</span></div>
							<div class="col-md-1">:</div>
							<div class="col-md-6"><p>
								<select class="form-control" name="ap_type" id="ap_type" placeholder="<?=lang('select')?>" >
                                  <option value="">- Select Type -</option>
                                  <?php if (!empty($creditor_types)) {
								  foreach ($creditor_types as $creditor_type) { ?>
								  <option value="<?php echo $creditor_type->rowID;?>"><?php echo $creditor_type->type_cd.' - '.$creditor_type->descs;?></option>
								  <?php }} ?>
			                    </select> 
							</p></div>
						</div>
						<div class="row inline-fields form-group form-md-line-input" style="display: none;">
							<div class="col-md-4">Supplier Name<span class="text-danger">*</span></div>
							<div class="col-md-1">:</div>
							<div class="col-md-6"><p>
                                <select class="form-control" name="creditor_id" id="creditor_id" placeholder="<?=lang('select')?>" >
                                    <option value="">- Select Supplier -</option>
                                </select> 
						     </p></div>
						</div>				
                        <div class="row inline-fields form-group form-md-line-input">
							<div class="col-md-4">Remark</div>
							<div class="col-md-1">:</div>
							<div class="col-md-6"><p>										
                                <textarea class="form-control" id="remark" name="remark" rows="2" placeholder="Optional" onkeyup="replaceQuotes(this)"></textarea>
							</p></div>
					    </div>
					</div>
				</div>  
            
                <div class="col-xs-6">
					<div class="group">	
                       <div class="row inline-fields form-group form-md-line-input" id="job_order_field">
							<div class="col-md-4">Job Order<span class="text-danger">*</span></div>
							<div class="col-md-1">:</div>
							<div class="col-md-6"><p>
                                <input type="text" class="form-control" id="do_jo_no" name="do_jo_no" onclick="selectJO_AP()" placeholder="Select Job Order No" readonly="" required="" style="cursor: pointer;background-color:#fff;" />
							</p></div>
					   </div> 
                      <div class="row inline-fields form-group form-md-line-input">
							<div class="col-md-4">Base Amount<span class="text-danger">*</span></div>
							<div class="col-md-1">:</div>
							<div class="col-md-6"><p>										
                                <input type="text" class="form-control" id="base_amt" name="base_amt" value="0" readonly="" style="text-align: right;" required="" />
							</p></div>
					   </div>
                       <div class="row inline-fields form-group form-md-line-input">
							<div class="col-md-4">VAT 10%<span class="text-danger">*</span></div>
							<div class="col-md-1">:</div>
							<div class="col-md-6"><p>										
                                <input type="text" class="form-control" id="tax_amt" name="tax_amt" value="0" readonly="" style="text-align: right;" required="" />
							</p></div>
					   </div>
                        <div class="row inline-fields form-group form-md-line-input">
							<div class="col-md-4">Total Amount<span class="text-danger">*</span></div>
							<div class="col-md-1">:</div>
							<div class="col-md-6"><p>										
                                <input type="text" class="form-control" id="total_amt" name="total_amt" value="0" onclick="clearTextTotal();" onkeyup="setBaseAmount()" style="text-align: right;" required="" />
							</p></div>
					   </div>
                       <div class="row inline-fields form-group form-md-line-input" style="display: none;">
							<div class="col-md-4">Total KB JO<span class="text-danger">*</span></div>
							<div class="col-md-1">:</div>
							<div class="col-md-6"><p>										
                                <input type="text" class="form-control" id="total_ap" name="total_ap" value="0" readonly="" style="text-align: right;" required="" />
							</p></div>
					   </div>
                       <div class="row inline-fields form-group form-md-line-input" style="display: none;">
							<div class="col-md-4">Total Difference<span class="text-danger">*</span></div>
							<div class="col-md-1">:</div>
							<div class="col-md-6"><p>										
                                <input type="text" class="form-control" id="total_diff" name="total_diff" value="0" readonly="" style="text-align: right;" required="" />
							</p></div>
					   </div>
                       <div class="row inline-fields form-group form-md-line-input">
							<div class="col-md-4"></div>
							<div class="col-md-1"></div>
							<div class="col-md-6"><p>										
                                <input type="checkbox" name="cekDa" id="cekDa" value="1" onclick="taxTrue()" /> &nbsp;Without VAT 10%
							</p></div>
						</div>
						<input  type="hidden" class="form-control" id="jo_year" name="jo_year"  value="">
						<input  type="hidden" class="form-control" id="jo_month" name="jo_month"  value="">
						<input  type="hidden" class="form-control" id="jo_code" name="jo_code"  value="">
						<input  type="hidden" class="form-control" id="jo_fare_trip_id" name="jo_fare_trip_id"  value="">
						<input  type="hidden" class="form-control" id="jo_type" name="jo_type"  value="">
						<input  type="hidden" class="form-control" id="price_amount" name="price_amount"  value="">
						<input  type="hidden" class="form-control" id="wholesale" name="wholesale"  value="">
						<input  type="hidden" class="form-control" id="price_20ft" name="price_20ft"  value="">
						<input  type="hidden" class="form-control" id="price_40ft" name="price_40ft"  value="">
						<input  type="hidden" class="form-control" id="price_45ft" name="price_45ft"  value="">
					</div>
				</div>
            </div> 
            <p>&nbsp;</p> 
             <ul class="nav nav-tabs" style="display: none;">
                <li id="choose_delivery" class="active"><a data-toggle="tab" href="#delivery_order"><?=lang('delivery_order') ?></a></li>
             </ul>
             <div class="tab-content" style="display: none;">
                <div id="delivery_order" class="tab-pane active">
                <br />
                    <div class="table-responsive"> 
                        <table class="table table-responsive table-striped table-condensed" id="detail_DO">
                            <tr>
                                <th style="width: 5%;">
                                    <input id="tamdet" title="Tambah Baris" type="button" onclick="addNewRow_DeliveryOrder_AP()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
                                </th>
                                <th><?=lang('job_order_no')?></th>
                                <th>Container Size</th>
                                <th>Container No</th>
                                <th>Police No</th>
                                <th style="width: 15%;">DO No</th>
                                <th>DO Date</th>
                                <th><?=lang('qty_delivery')?></th>
                                <th><?=lang('receipt_date')?></th>
                                <th><?=lang('qty_receipt')?></th>
                                <th>Amount KB</th>
                            </tr>
                        </table>
                    </div>
                  
                </div>
            </div>
        </div>
        </form>
        <p>&nbsp;</p>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnCancel" class="btn red" data-dismiss="modal">Cancel</button>
            <button type="button" id="btnSave" onclick="save_ap()" class="btn green">Save</button>

          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
 <select id="ContType" panelHeight="auto" style="display:none;">
     <option value="" disabled="">Select container size</option>
     <option value="20">20 Fit</option>
     <option value="40">40 Fit</option>
     <option value="45">45 Fit</option>
 </select>

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
                  <table id="tbl-joborder" class="table table-responsive table-striped">
                    <thead>
                      <tr>
                        <th><?=lang('job_order_no')?></th>
						<th><?=lang('job_order_debtor')?></th>
                        <th><?=lang('job_order_po_spk_no')?></th>
                        <th>From - To</th>
                        <th>JO Type</th>
                        <th>Price Type</th>
                        <th>Item</th>
                        <th><?=lang('port')?></th>
                        <th><?=lang('vessel_name')?> </th>
						<th><?=lang('job_order_date')?></th>
                        <th><?=lang('job_order_so_no')?></th>
                        <th><?=lang('vessel_no')?> </th>
                        <th>Year</th>
                        <th>month</th>
                        <th>code</th>
                        <th>fare trip id</th>
                        <th>from id</th>
                        <th>to id</th>
                        <th>Jo Type</th>
                        <th>Price Amount</th>
                        <th>Price Type</th>
                        <th>Price 20 Feet</th>
                        <th>Price 40 Feet</th>
                        <th>Price 45 Feet</th>
                      </tr> 
					</thead>
					<tbody>
                      <?php
                      if (!empty($cash_advance_jo)) {
                      foreach ($cash_advance_jo as $rs) { 
                        if($rs->jo_type == '1')
                            $jo_type = "BULK";
                        else if($rs->jo_type == '2')
                            $jo_type = "CONTAINER";
                        else
                            $jo_type = "OTHERS";  
                            
                      ?>
                      <tr style="cursor: pointer;">
						<td><?=$rs->jo_no?></td>
						<td><?=$rs->debtor?></td>
                        <td><?=$rs->po_spk_no?></td>
                        <td><?=ucwords(strtolower($rs->from_name)).' - '.ucwords(strtolower($rs->to_name))?></td>
                        <td><?=ucwords(strtolower($jo_type))?></td>
                        <td><?=$rs->wholesale == 1 ? 'All In' : 'Pcs'?></td>
                        <td><?=ucwords(strtolower($rs->item_name))?></td>
                        <td><?=ucwords(strtolower($rs->port_name))?></td>
                        <td><?=ucwords(strtolower($rs->vessel_name))?></td>
						<td><?=date("d F Y",strtotime($rs->jo_date))?></td>
                        <td><?=$rs->so_no?></td>
                        <td><?=$rs->vessel_no?></td>
                        <td><?=$rs->year?></td>
                        <td><?=$rs->month?></td>
                        <td><?=$rs->code?></td>
                        <td><?=$rs->fare_trip_rowID?></td>
                        <td><?=$rs->destination_from_rowID?></td>
                        <td><?=$rs->destination_to_rowID?></td>
                        <td><?=$rs->jo_type?></td>
                        <td><?=$rs->price_amount?></td>
                        <td><?=$rs->wholesale?></td>
                        <td><?=$rs->price_20ft?></td>
                        <td><?=$rs->price_40ft?></td>
                        <td><?=$rs->price_45ft?></td>
                    </tr>
                    <?php } } ?>
                  </tbody>
                </table>
              </div>
            </section>            
          </div>
        </div>
      <!--</section>-->
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
                
	// 			isi_table += '<tr onclick="get_data_do(\''+data.do_no+'\',\''+data.str_do_date+'\',\''+
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
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>

<!-- /.aside -->
<aside class="aside-xxl bg-white b-l hide" id="aside">
    <section class="vbox">
		<section class="scrollable wrapper">
            <?=form_open(base_url().'kontra_bon/set_filter','autocomplete="off" id="form_period" class="form-horizontal"')?>                    
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
        
        var table_kontra_bon = $('#tbl-account-payable').DataTable({
            processing: true,
            serverSide: true,
            sDom: "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            sPaginationType: "full_numbers",
            ajax: {
                url: "<?= base_url() ?>kontra_bon/fetch_data",
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
                    "data": "trx_date"
                },
                {
                    "data": "po_no"
                },
                {
                    "data": "ref_no"
                },
                {
                    "data": "descs"
                },
                {
                    "data": "base_amt", "className": "text-right"
                },
                {
                    "data": "tax_amt", "className": "text-right"
                },
                {
                    "data": "total_amt", "className": "text-right"
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
                table_kontra_bon.search(value).draw();
            } 
            if (value.length == 0) {
                table_kontra_bon.search(value).draw();
            } 
        });
        $(".start_date").on("dp.change", function (e) {
            var start_date = $("#start_date").val();
            table_kontra_bon.columns(9).search(start_date).draw();
            $("#start_date").blur();
        });
        $(".end_date").on("dp.change", function (e) {
            var end_date = $("#end_date").val();
            table_kontra_bon.columns(10).search(end_date).draw();
            $("#end_date").blur();
        });
    });
</script>