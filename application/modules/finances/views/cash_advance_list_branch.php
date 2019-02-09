<style type="text/css">
    td.highlight {
        color:#ceb813;
        font-weight:bold;
    }
</style>
<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="row" style="padding-top: 10px;">
                <div class="col-md-5" style="padding-top: 5px;">
                    <p>Cash Advance (CA) List - Branch</p>                
                </div>     
                <div class="col-md-7 text-right">
                    <!-- <a href="#aside" data-toggle="class:show" id="btnFilter" onclick="showFilterText()" style="color: #46b8da;">Show Filter</a> &nbsp; -->
                    <?php
                    if($this->user_profile->get_user_access('Created') == 1){
                    ?>
                        <a class="btn btn-sm green" onclick="add_cash_advance()"><i class="fa fa-plus"></i> <?=lang('new')?>  <?=lang('cash_advance')?></a>
                        <a class="btn btn-sm btn-warning" href="<?=base_url()?>finances/create_refund_hdr"><i class="fa fa-money"></i> <?=lang('new')?> <?=lang('refund_option')?></a>
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
                <?php
                if(count($realisasi_has_not_cb) > 0){
                ?>
                    <div class="alert alert-info alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <strong>The realization that has not made cash bank :</strong><br /> 
                      <?php
                      $data_has_not_cb = '';
                      $no_has_not_cb = 1;
                      foreach($realisasi_has_not_cb as $row_cb){
                        $data_has_not_cb .= $no_has_not_cb.'. '.$row_cb->advance_no.'</br>';
                        $no_has_not_cb++;
                      }
                      
                      echo $data_has_not_cb;
                      ?>
                    </div>
                <?php
                }
                ?>
                <ul class="nav nav-tabs" role="tablist">
                   <li role="presentation" class="active"><a href="#pending" aria-controls="pending" role="tab" data-toggle="tab">PENDING <span class="badge" id="badge-pending"></span></a></li>
                    <li role="presentation"><a href="#loan" aria-controls="loan" role="tab" data-toggle="tab">LOAN <span class="badge" id="badge-loan"></span></a></li>
                    <li role="presentation"><a href="#done" aria-controls="done" role="tab" data-toggle="tab">DONE <span class="badge" id="badge-done"></span></a></li>

                    <div class="input-group input-daterange pull-right" style="position: relative;top:0px;right: 14px; display: inline-flex;">
                        <font style="margin: 5px 10px 0px 0px">Filter:</font>
                        <input type="text" name="start_date" id="start_date" class="form-control input-sm start_date" placeholder="<?=lang('start_date')?>" value="<?=date('d-m-Y', strtotime($start_date))?>" style="text-align: center;">
                        <span class="input-group-addon" style="width: 50px;">to</span>
                        <input type="text" name="end_date" id="end_date" class="form-control input-sm end_date" placeholder="<?=lang('end_date')?>" value="<?=date('d-m-Y', strtotime($end_date))?>" style="text-align: center;">
                    </div>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="pending">
                        <section class="panel panel-default">
                            <div class="table-responsive"><?php echo validation_errors(); ?>

                            <table id="tbl-ca-pending-new" class="table table-striped table-hover b-t b-light text-sm">
                                <thead>
                                  <tr>
                                    <th><?=lang('options')?></th>
                                    <th><?=lang('cash_advance_no')?></th>
                                    <th>CA <?=lang('date')?></th>
                                    <th>End date</th>
                                    <th><?=lang('driver')?>/<?=lang('employee')?> Name</th>
                                    <th width="8%"><?=lang('fare_trip_code')?></th>
                                    <th width="10%">Police No</th>
                                    <th><?=lang('cash_advance_amt')?></th>
                                    <th><?=lang('extra_amount')?></th>
                                    <th>Addendum</th>
                                    <th><?=lang('cash_advance_alloc')?></th>
                                    <th><?=lang('balance')?></th>
                                    <th>total_memo</th>
                                    <th>Container No</th>
                                  </tr> 
                                </thead>
                            </table>

                            <script type="text/javascript">
                                function GetDrivingDistance(origin_coordinate,destination_coordinate){
                                    //alert(origin_coordinate);
                                    var url_api = "https://maps.googleapis.com/maps/api/distancematrix/json?origins="+origin_coordinate+"&destinations="+destination_coordinate+"&mode=driving&key=AIzaSyAGqAXbPVg8hBkOqq5aX3tvh5Doryc-AnY"; 
                                    
                                    $.ajax({
                                        type: "POST",
                                        url : url_api,
                                    	data: '<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
                                        cache:false,
                                        async:true,
                                        dataType : 'jsonp',   //you may use jsonp for cross origin request
                                        jsonpCallback: 'callback',                                        
                                        crossDomain:true,
                                        contentType: "application/json; charset=utf-8",
                                        headers: {
                                                'Access-Control-Allow-Origin':  '*'
                                        },
                                        success: function(data_distancematrix){
                                            alert(data_distancematrix.rows.elements.distance.text);
                                        },
                                    	error: function(xhr, status, error) {
                                    		document.write(xhr.responseText);
                                    	}
                                    });
                                    
                                }
                            </script>
                          </div>
                        </section>  
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="loan">
                        <section class="panel panel-default">
                            <div class="table-responsive"><?php echo validation_errors(); ?>

                                <table id="tbl-ca-loan-new" class="table table-striped table-hover b-t b-light text-sm" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="5%"><?=lang('options')?></th>
                                            <th width="8%"><?=lang('cash_advance_no')?></th>
                                            <th width="8%">CA <?=lang('date')?></th>
                                            <th>End date</th>
                                            <th width="15%"><?=lang('driver')?>/<?=lang('employee')?> Name</th>
                                            <th width="10%">Police No</th>
                                            <th><?=lang('cash_advance_amt')?></th>
                                            <th><?=lang('extra_amount')?></th>
                                            <th>Addendum</th>
                                            <th><?=lang('cash_advance_alloc')?></th>
                                            <th><?=lang('balance')?></th>
                                            <th>total_memo</th>
                                            <th>Container No</th>
                                      </tr> 
                                    </thead>
                                </table>
                          </div>
                        </section>  
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="done">
                        <section class="panel panel-default">
                           <div class="table-responsive"><?php echo validation_errors(); ?>
                                <table id="tbl-ca-done-new" class="table table-striped table-hover b-t b-light text-sm" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th><?=lang('options')?></th>
                                            <th><?=lang('cash_advance_no')?></th>
                                            <th><?=lang('date')?></th>
                                            <th>End date</th>
                                            <th><?=lang('driver')?>/<?=lang('employee')?> Name</th>
                                            <th><?=lang('fare_trip_code')?></th>
                                            <th width="10%">Police No</th>
                                            <th><?=lang('cash_advance_amt')?></th>
                                            <th><?=lang('extra_amount')?></th>
                                            <th>Addendum</th>
                                            <th><?=lang('cash_advance_alloc')?></th>
                                            <th><?=lang('balance')?></th>
                                            <th>total_memo</th>
                                            <th>Container No</th>
                                        </tr> 
                                    </thead>
                                </table>
                          </div>
                        </section> 
                    </div>
                </div>
                
                        
          </div>
        </div>
        
      </section>

    </section>
 <!-- </aside>-->

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
    									<input  type="checkbox" id="doc_sj" name="doc_sj"  value="Yes" style="width: 15px;" checked="" readonly > SJ &nbsp; &nbsp;
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
                                            <input id="tamdet" title="Tambah Baris" type="button" onclick="addRow_DeliveryOrder()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
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
                                            <input id="tamdetcost" title="Tambah Baris" type="button" onclick="addRow_Cost(false)" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
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
            <button type="button" id="btnSave" onclick="save_cash_advance_realization()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
  
  <!-- Modal JO-->
  <div class="modal fade" id="joModal" role="dialog">
    <div class="modal-dialog" style="width:75%;height:30px;">
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

<!-- Bootstrap modal Cash Advance Create-->
  <div class="modal fade" id="modal_create_ca" role="dialog">
  <div class="modal-dialog" style="width:80%;height:200px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title modal-job-ca"><?=lang('new')?> <?=lang('cash_advance')?></h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form_create_ca" class="form-horizontal"')?>
    				<div class="row"> 
					<div class="col-xs-6">
						<div class="group">	
							<div class="form-group form-md-line-input">
								<div class="col-md-4"><?=lang('date')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-4">										
									<input type="text" class="form-control" id="date_ca" name="date_ca" value="<?=date('d-m-Y')?>" readonly="" required="" />
                                    <input type="hidden" id="advance_no" name="advance_no"/>
								</div>
							</div>	
                            <div class="form-group form-md-line-input">
								<div class="col-md-4"><?=lang('cash_advance_type')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-5" style="padding-right: 10px;">
                                    <select class="form-control" id="cash_advance_type2" name="cash_advance_type2" required>
                                        <option value=""><?=lang('select').' '.lang('cash_advance_type');?></option>
									<?php
										if (!empty($cash_advance_types)) {
											foreach ($cash_advance_types as $cash_advance_type) { ?>
											<option value="<?php echo $cash_advance_type->rowID; ?>"><?php echo $cash_advance_type->advance_cd;?> - <?php echo $cash_advance_type->advance_name;?></option>
									<?php }}?>
									</select>
								</div>
								<div class="col-md-2" style="padding-left: 0px;">
								    <a class="btn btn-sm btn-info" id="btn_search_fare_trip" style="display: none;" onclick="search_fare_trip()" title="Search <?=lang('fare_trip')?>"><i class="fa fa-search"></i></a>
                                </div>			
							</div>
                            <div class="form-group form-md-line-input">
								<div class="col-md-4"><?=lang('employee')?>/<?=lang('driver')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-5" style="padding-right: 10px;">
                                    <input type="hidden" class="form-control" id="queue_id" name="queue_id" required >
                                    <input type="hidden" class="form-control" id="driver2" name="driver2" required >
                                    <input type="text" class="form-control" id="driver2_tmp" name="driver2_tmp" placeholder="<?=lang('select').' '.lang('employee').'/'.lang('driver');?>" readonly="" required >
								</div>		
                                <div class="col-md-2" style="padding-left: 0px;">
								    <a class="btn btn-sm btn-info" id="btn_search_driver" onclick="search_driver()" title="Search <?=lang('employee')?>/<?=lang('driver')?>"><i class="fa fa-search"></i></a>
                                </div>															
							</div>
                            <div class="form-group form-md-line-input" id="co_driver_field" style="display: none;">
								<div class="col-md-4">Co <?=lang('driver')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-7" style="padding-right: 10px;">
                                    <select class="form-control" id="co_driver_rowID" name="co_driver_rowID">
                                        <option value=""><?=lang('select').' '.lang('driver');?></option>
									<?php
										if (!empty($debtors)) {
											foreach($debtors as $debtor) { ?>
											<option value="<?php echo $debtor->rowID; ?>"><?php echo $debtor->type.$debtor->debtor_cd;?> - <?php echo $debtor->debtor_name;?></option>
									<?php }}?>
									</select>
								</div>			
							</div>
							<div class="form-group form-md-line-input">
								<div class="col-md-4"><?=lang('vehicle')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-7">
                                    <select class="form-control" id="vehicle" name="vehicle" disabled="" required>
                                        <option value=""><?=lang('select').' '.lang('vehicle');?></option>
									</select>
								</div>
							</div>
                            <div class="form-group form-md-line-input">
								<div class="col-md-4"><?=lang('vehicle_category')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-7">
                                    <input type="hidden" class="form-control" id="vehicle_category" name="vehicle_category" required readonly>
                                    <input type="text" class="form-control" id="vehicle_category_tmp" name="vehicle_category_tmp" required readonly>
								</div>
							</div>	
							<div class="form-group form-md-line-input">
								<div class="col-md-4"><?=lang('fare_trip')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-7">
                                    <input type="hidden" class="form-control" id="fare_trip" name="fare_trip" required="" readonly="" />
                                    <input type="hidden" class="form-control" id="split_status" name="split_status" required="" readonly="" />
                                    <input type="text" class="form-control" id="fare_trip_tmp" name="fare_trip_tmp" required="" readonly="" />
                                </div>
							</div>	
							<div class="form-group form-md-line-input">
								<div class="col-md-4"></div>
								<div class="col-md-1"></div>
								<div class="col-md-7">
									<textarea class="form-control" id="fare_trip_dtl" name="fare_trip_dtl" maxlength="60" rows="2" readonly></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-6">
						<div class="group">	
							<div class="form-group form-md-line-input">
								<div class="col-md-4"><?=lang('amount')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-7"><p>
									<input  type="text" class="form-control currency" id="amount" name="amount" readonly="" style="font-size:22px;font-weight:900;color: black;text-align: right;" value="0" autocomplete="off" required>
								</p></div>																
							</div>
                            <div class="form-group form-md-line-input">
								<div class="col-md-4"><?=lang('extra_amount')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-7"><p>
									<input  type="text" class="form-control currency" id="extra_amount" name="extra_amount" style="font-size:22px;font-weight:900;color: black;text-align: right;" value="0" autocomplete="off" required>
								</p></div>																
							</div>
                            <!--
                            <div class="form-group form-md-line-input">
								<div class="col-md-4"><?=lang('barcode')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-7"><p>
									<input type="text" class="form-control" id="barcode_no" name="barcode_no" maxlength="6" autocomplete="off" required>
								</p></div>																
							</div>
                            -->
                            <input type="hidden" class="form-control" id="barcode_no" name="barcode_no" maxlength="6" autocomplete="off" required>
                            <div class="form-group form-md-line-input">
								<div class="col-md-4"><?=lang('item')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-7"><p>
									<select class="form-control all_select2" id="spk_item_rowID" name="spk_item_rowID">
                                        <option value=""><?=lang('select').' '.lang('item');?></option>
									<?php
										if (!empty($items)) {
											foreach($items as $item) { ?>
											<option value="<?php echo $item->rowID; ?>"><?php echo $item->item_name;?></option>
									<?php }}?>
									</select>
								</p></div>																
							</div>
                            <div class="form-group form-md-line-input">
								<div class="col-md-4">Container No</div>
								<div class="col-md-1">:</div>
								<div class="col-md-7"><p>
									<input type="text" class="form-control" id="spk_container_no" name="spk_container_no" maxlength="50" />
								</p></div>																
							</div>
							<div class="form-group form-md-line-input">
								<div class="col-md-4"><?=lang('description')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-7"><p>
									<textarea class="form-control" id="cash_advance_desc" name="cash_advance_desc" maxlength="255" rows="2"></textarea>
								</p></div>																
							</div>										
						</div>	
					</div>		
				</div>

                        
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnVerifyCashAdvance" onclick="show_modal_verify()" class="btn green" style="display: none;"><?=lang('verify')?></button>
            <button type="button" id="btnSaveCashAdvance" onclick="save_cash_advance()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    <!-- Modal List Fare Trip -->
    <div class="modal fade" id="modal_fare_trip" role="dialog">
      <div class="modal-dialog" style="width:85%;height:200px;">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title modal-title-faretrip"><?=lang('select').' '.lang('fare_trip')?></h3>
          </div>
          <div class="modal-body form">
            <table id="tbl-fare_trip" class="table table-responsive table-striped table-condensed table-hover" style="width: 100%;"></table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    <!-- Modal List Employee/Driver Queue -->
    <div class="modal fade" id="modal_driver" role="dialog">
      <div class="modal-dialog" style="width:75%;height:200px;">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title modal-title-queue"><?=lang('queue').' '.lang('driver')?></h3>
          </div>
          <div class="modal-body form">
            <table id="tbl-driver" class="table table-responsive table-striped table-condensed table-hover" style="width: 100%;">
                <thead>
                    <th>No</th>
                    <th><?=lang('debtor_cd')?></th>
                    <th><?=lang('debtor_name')?> </th>
					<th><?=lang('debtor_pob')?> </th>
					<th><?=lang('debtor_dob')?> </th>
                    <th><?=lang('debtor_id_type')?></th>
                    <th><?=lang('debtor_id_number')?> </th>
                    <th><?=lang('absent_status')?> </th>
                    <th>Photo</th>
                </thead>
                <tbody>
                <?php
                if(count($drivers) > 0){
                    $no = 1;
                    foreach($drivers as $driver){
                        $class_id = '';
                        
                        if ($driver->id_type == 'S'){
                            $class_id = 'SIM';
                        }
                        else if ($driver->id_type == 'K'){
                            $class_id = 'KTP';
                        }else if ($driver->id_type == 'P'){
                            $class_id = 'Passport';
                        } 
                        
                        if($driver->already == ''){
                            $already = '<span class="label label-success">'.lang('not_yet').'</span>';
                        }
                        else{
                            $already = '<span class="label label-warning">'.lang('already').'</span>';
                        }
                                
                        $get_vehicle = $this->vehicle_model->get_by_id_debtor($driver->rowID);	 
                        
                        if ($driver->type == 'D'){
                ?>
                        <tr style="cursor:pointer">
                            <td onclick="get_driver('<?=$driver->queue_id?>','<?=$driver->rowID?>','<?=$driver->debtor_name?>','<?=$get_vehicle->rowID?>','<?=$driver->already?>')"><?=$no++?>.</td>
                            <td onclick="get_driver('<?=$driver->queue_id?>','<?=$driver->rowID?>','<?=$driver->debtor_name?>','<?=$get_vehicle->rowID?>','<?=$driver->already?>')"><?=$driver->type.$driver->debtor_cd?></td>
                            <td onclick="get_driver('<?=$driver->queue_id?>','<?=$driver->rowID?>','<?=$driver->debtor_name?>','<?=$get_vehicle->rowID?>','<?=$driver->already?>')"><?=$driver->debtor_name?></td>
    						<td onclick="get_driver('<?=$driver->queue_id?>','<?=$driver->rowID?>','<?=$driver->debtor_name?>','<?=$get_vehicle->rowID?>','<?=$driver->already?>')"><?=$driver->pob == '' ? '-' : strtoupper($driver->pob)?></td>
    						<td onclick="get_driver('<?=$driver->queue_id?>','<?=$driver->rowID?>','<?=$driver->debtor_name?>','<?=$get_vehicle->rowID?>','<?=$driver->already?>')"><?=date("d F Y",strtotime($driver->dob))?></td>
                            <td onclick="get_driver('<?=$driver->queue_id?>','<?=$driver->rowID?>','<?=$driver->debtor_name?>','<?=$get_vehicle->rowID?>','<?=$driver->already?>')"><?=$class_id?></td>
                            <td onclick="get_driver('<?=$driver->queue_id?>','<?=$driver->rowID?>','<?=$driver->debtor_name?>','<?=$get_vehicle->rowID?>','<?=$driver->already?>')"><?=$driver->id_no?></td>
                            <td onclick="get_driver('<?=$driver->queue_id?>','<?=$driver->rowID?>','<?=$driver->debtor_name?>','<?=$get_vehicle->rowID?>','<?=$driver->already?>')" class="text-center"><?=$already?></td>
                            <td>
                                <?php
                                if($driver->debtor_photo != '')
                                    echo '<button class="btn btn-sm btn-success" onclick="show_photo_ca(\''.$driver->debtor_photo.'\',\''.$driver->debtor_name.'\')"><i class="fa fa-image"></i> View Photo</button>';
                                else
                                    echo 'No Photo';
                                ?>
                            </td>
                        </tr>
                <?php   
                        }
                    }
                }                
                ?>
                </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    <!-- Modal List Employee/Driver -->
    <div class="modal fade" id="modal_employee_driver" role="dialog">
      <div class="modal-dialog" style="width:75%;height:200px;">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title modal-title-employee"><?=lang('select').' '.lang('employee').'/'.lang('driver')?></h3>
          </div>
          <div class="modal-body form">
            <table id="tbl-employee-driver" class="table table-responsive table-striped table-condensed table-hover" style="width: 100%;">
                <thead>
                    <th>No</th>
                    <th><?=lang('debtor_cd')?></th>
                    <th><?=lang('debtor_name')?> </th>
                    <th><?=lang('employee').'/'.lang('driver')?></th>
					<th><?=lang('debtor_pob')?> </th>
					<th><?=lang('debtor_dob')?> </th>
                    <th><?=lang('debtor_id_type')?></th>
                    <th><?=lang('debtor_id_number')?></th>
                    <th>Photo</th>
                </thead>
                <tbody>
                <?php
                if(count($debtors) > 0){
                    $no = 1;
                    foreach($debtors as $debtor){
                        $class_debtor = '';
                        $class_id = '';
                        
                        if ($debtor->type == 'D'){
                            $class_debtor = 'Driver';
                        }
                        else if ($debtor->type == 'C'){
                            $class_debtor = 'Company';
                        }else if ($debtor->type == 'E'){
                            $class_debtor = 'Employee';
                        }
                        
                        if ($debtor->id_type == 'S'){
                            $class_id = 'SIM';
                        }
                        else if ($debtor->id_type == 'K'){
                            $class_id = 'KTP';
                        }else if ($debtor->id_type == 'P'){
                            $class_id = 'Passport';
                        } 
                                
                        $get_vehicle = $this->vehicle_model->get_by_id_debtor($debtor->rowID);	 
                        
                        if ($debtor->type != 'C'){
                ?>
                        <tr style="cursor:pointer">
                            <td onclick="get_driver('','<?=$debtor->rowID?>','<?=$debtor->debtor_name?>','<?=$get_vehicle->rowID?>','')" ><?=$no++?>.</td>
                            <td onclick="get_driver('','<?=$debtor->rowID?>','<?=$debtor->debtor_name?>','<?=$get_vehicle->rowID?>','')" ><?=$debtor->type.$debtor->debtor_cd?></td>
                            <td onclick="get_driver('','<?=$debtor->rowID?>','<?=$debtor->debtor_name?>','<?=$get_vehicle->rowID?>','')" ><?=$debtor->debtor_name?></td>
                            <td onclick="get_driver('','<?=$debtor->rowID?>','<?=$debtor->debtor_name?>','<?=$get_vehicle->rowID?>','')" ><?=$class_debtor?></td>
    						<td onclick="get_driver('','<?=$debtor->rowID?>','<?=$debtor->debtor_name?>','<?=$get_vehicle->rowID?>','')" ><?=strtoupper($debtor->pob)?></td>
    						<td onclick="get_driver('','<?=$debtor->rowID?>','<?=$debtor->debtor_name?>','<?=$get_vehicle->rowID?>','')" ><?=date("d F Y",strtotime($debtor->dob))?></td>
                            <td onclick="get_driver('','<?=$debtor->rowID?>','<?=$debtor->debtor_name?>','<?=$get_vehicle->rowID?>','')" ><?=$class_id?></td>
                            <td onclick="get_driver('','<?=$debtor->rowID?>','<?=$debtor->debtor_name?>','<?=$get_vehicle->rowID?>','')" ><?=$debtor->id_no?></td>
                            <td>
                                <?php
                                if($debtor->debtor_photo != '')
                                    echo '<button class="btn btn-sm btn-success" onclick="show_photo_ca(\''.$debtor->debtor_photo.'\',\''.$debtor->debtor_name.'\')"><i class="fa fa-image"></i> View Photo</button>';
                                else
                                    echo 'No Photo';
                                ?>
                            </td>
                        </tr>
                <?php   
                        }
                    }
                }                
                ?>
                </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
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
                                <input type="hidden" class="form-control" id="queue_id_verify" name="queue_id_verify" required >										
								<input type="password" class="form-control" id="password" name="password" required="" />
							</div>
                        </div>
                    </div>
                </div>
            <?=form_close()?>
          </div>
          <div class="modal-footer">
            <button type="button" onclick="verify_password()" class="btn green"><?=lang('verify')?></button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    <!-- Modal Memo -->
    <div class="modal fade" id="modal_memo" role="dialog">
      <div class="modal-dialog" style="width:50%;height:200px;">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title modal-title-memo">Memo <span id="memo_ca_no"></span></h3>
          </div>
          <div class="modal-body form">
            <?php
            if($this->user_profile->get_user_access('Created') == 1){
            ?>
                <?=form_open('','autocomplete="off" id="form_memo" class="form-horizontal"')?>
      				<div class="row"> 
    					<div class="col-md-12">
    						<div class="form-group form-md-line-input">
    							<div class="col-md-4"><b>Description<span class="text-danger">*</span></b></div>
                            </div>
                        </div>
                    </div>
      				<div class="row"> 
    					<div class="col-md-12">
    						<div class="form-group form-md-line-input">
    							<div class="col-md-12">
                                    <input type="hidden" class="form-control" id="memo_advance_no" name="memo_advance_no" required >										
    								<textarea class="form-control" name="memo_description" id="memo_description" maxlength="255" rows="3"></textarea>
    							</div>
                            </div>
                        </div>
                    </div>
      				<div class="row"> 
    					<div class="col-md-12 text-right">
                            <button type="button" onclick="create_memo()" class="btn green">Create Memo</button>
                        </div>
                    </div>
                <?=form_close()?>
                
                <hr />
            <?php
            }
            ?>
            <table id="tbl-memo" class="table table-responsive table-striped table-condensed table-hover" style="width: 100%;"></table>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn red" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    <div class="modal fade" id="modal_view_photo" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title-view-photo">View Photo</h3>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="text-center" id="driver_name_photo" style="font-weight: bold;"></div>
                    <br />
                    <div class="text-center">
                        <img id="personal_photo" class="img-responsive img-thumbnail" width="80%" alt="<?=lang('personal_photo')?>" />
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
    
<div class="modal fade" id="modal_show_detail_position" role="dialog">
  <div class="modal-dialog" style="width:50%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title-show-position">Detail Position</h3>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <p id="detail_position"></p>            
                <div id="map" style="width: 100%;height: 400px;background-color: grey;"></div>
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

    var table_ca_pending = $('#tbl-ca-pending-new').DataTable({
        processing: true,
        serverSide: true,
        sDom: "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        sPaginationType: "full_numbers",
        ajax: {
            url: "<?= base_url() ?>finances/fetch_data_branch/pending",
            type: 'POST',
            data: {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
        },
        columns: [
            {
                "data": "options"
            },
            {
                "data": "advance_no"
            },
            {
                "data": "advance_date"
            },
            {
                "data": "end_date", "bVisible" : false
            },
            {
                "data": "debtor"
            },
            {
                "data": "fare_trip_cd"
            },
            {
                "data": "police_no"
            },
            {
                "data": "advance_amount", "className": "text-right"
            },
            {
                "data": "advance_extra_amount", "className": "text-right"
            },
            {
                "data": "pay_over_allocation", "className": "text-right"
            },
            {
                "data": "advance_allocation", "className": "text-right"
            },
            {
                "data": "total_balance", "className": "text-right"
            },
            {
                "data": "total_memo", "bVisible" : false
            },
            {
                "data": "container_no", "bVisible" : false
            }
        ],
        order: [0, "DESC"],
        iDisplayLength: 25,
        createdRow: function ( row, data, index ) {
            if ( data["total_memo"] > 0) {
                $('td', row).addClass('highlight');
            }
        },
        infoCallback: function(settings, start, end, max, total, pre) {
            $('#badge-pending').empty().append(total);
             return "Showing " + start + " to " + end + " of " + total + " entries" + ((total !== max) ? " (filtered from " + max + " total entries)" : "");
        }
        
    }); 

    $('#tbl-ca-pending-new_filter input').unbind().keyup(function() {
        var value = $(this).val();
        if (value.length > 2) {
            table_ca_pending.search(value).draw();
        } 
        if (value.length == 0) {
            table_ca_pending.search(value).draw();
        } 
    });
    $(".start_date").on("dp.change", function (e) {
        var start_date = $("#start_date").val();
        table_ca_pending.columns(2).search(start_date).draw();
        $("#start_date").blur();

    });
    $(".end_date").on("dp.change", function (e) {
        var end_date = $("#end_date").val();
        table_ca_pending.columns(3).search(end_date).draw();
        $("#end_date").blur();
    });

    var table_ca_loan = $('#tbl-ca-loan-new').DataTable({
        processing: true,
        serverSide: true,
        sDom: "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        sPaginationType: "full_numbers",
        ajax: {
            url: "<?= base_url() ?>finances/fetch_data_branch/loan",
            type: 'POST',
            data: {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
        },
        columns: [
            {
                "data": "options"
            },
            {
                "data": "advance_no"
            },
            {
                "data": "advance_date"
            },
            {
                "data": "end_date", "bVisible" : false
            },
            {
                "data": "debtor"
            },
            {
                "data": "police_no", "bVisible" : false
            },
            {
                "data": "advance_amount", "className": "text-right"
            },
            {
                "data": "advance_extra_amount", "className": "text-right"
            },
            {
                "data": "pay_over_allocation", "className": "text-right"
            },
            {
                "data": "advance_allocation", "className": "text-right"
            },
            {
                "data": "total_balance", "className": "text-right"
            },
            {
                "data": "total_memo", "bVisible" : false
            },
            {
                "data": "container_no", "bVisible" : false
            }
        ],
        order: [0, "DESC"],
        iDisplayLength: 25,
        createdRow: function(row, data, index) {
            if (data["total_memo"] > 0) {
                $('td', row).addClass('highlight');
            }
        },
        "infoCallback": function( settings, start, end, max, total, pre ) {
            $('#badge-loan').empty().append(total);
            return "Showing " + start + " to " + end + " of " + total + " entries" + ((total !== max) ? " (filtered from " + max + " total entries)" : "");
        }
    }); 

    var table_ca_done = $('#tbl-ca-done-new').DataTable({
        processing: true,
        serverSide: true,
        sDom: "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        sPaginationType: "full_numbers",
        ajax: {
            url: "<?= base_url() ?>finances/fetch_data_branch/done",
            type: 'POST',
            data: {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
        },
        columns: [
            {
                "data": "options"
            },
            {
                "data": "advance_no"
            },
            {
                "data": "advance_date"
            },
            {
                "data": "end_date", "bVisible" : false
            },
            {
                "data": "debtor"
            },
            {
                "data": "fare_trip_cd"
            },
            {
                "data": "police_no"
            },
            {
                "data": "advance_amount", "className": "text-right"
            },
            {
                "data": "advance_extra_amount", "className": "text-right"
            },
            {
                "data": "pay_over_allocation", "className": "text-right"
            },
            {
                "data": "advance_allocation", "className": "text-right"
            },
            {
                "data": "total_balance", "className": "text-right"
            },
            {
                "data": "total_memo", "bVisible" : false
            },
            {
                "data": "container_no", "bVisible" : false
            }
        ],
        order: [0, "DESC"],
        iDisplayLength: 25,
        createdRow: function ( row, data, index ) {
            if ( data["total_memo"] > 0) {
                $('td', row).addClass('highlight');
            }
        },
        "infoCallback": function( settings, start, end, max, total, pre ) {
            $('#badge-done').empty().append(total);
            return "Showing " + start + " to " + end + " of " + total + " entries" + ((total !== max) ? " (filtered from " + max + " total entries)" : "");
        }
    });
    $('#tbl-ca-done-new_filter input').unbind().keyup(function() {
        var value = $(this).val();
        if (value.length > 2) {
            table_ca_done.search(value).draw();
        } 
        if (value.length == 0) {
            table_ca_done.search(value).draw();
        } 
    });
    $(".start_date").on("dp.change", function (e) {
        var start_date = $("#start_date").val();
        table_ca_done.columns(2).search(start_date).draw();
        $("#start_date").blur();
    });
    $(".end_date").on("dp.change", function (e) {
        var end_date = $("#end_date").val();
        table_ca_done.columns(3).search(end_date).draw();
        $("#end_date").blur();
    });

    $('#tbl-ca-loan-new_filter input').unbind().keyup(function() {
        var value = $(this).val();
        if (value.length > 2) {
            table_ca_loan.search(value).draw();
        } 
        if (value.length == 0) {
            table_ca_loan.search(value).draw();
        } 
    });
    $(".start_date").on("dp.change", function (e) {
        var start_date = $("#start_date").val();
        table_ca_loan.columns(2).search(start_date).draw();
        $("#start_date").blur();
    });
    $(".end_date").on("dp.change", function (e) {
        var end_date = $("#end_date").val();
        table_ca_loan.columns(3).search(end_date).draw();
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

<script language="javascript">
$(document).ready(function(){
   $.getScript("https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyAGqAXbPVg8hBkOqq5aX3tvh5Doryc-AnY&callback=loadMap", function() {
        // No code here
   });  
});

function showDetailPositionVehicle(vehicle_id)
{   
    var police_no = '';
    var status = '';
    var position = '';
    var gpstime = '';
    var latitude = '';
    var longitude = '';
    var url = '';
    
    $.ajax({
        url:'<?php echo base_url(); ?>finances/get_data_vehicle_position',
		type: "POST",
        data: 'vehicle_id='+vehicle_id+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        dataType:"JSON",
		success: function(data_vehicle){
            police_no = data_vehicle.police_no;
            status = data_vehicle.status;
            position = data_vehicle.position;
            gpstime = data_vehicle.time_gps;
            latitude = data_vehicle.latitude;
            longitude = data_vehicle.longitude;
            
            url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=" + position + "&sensor=false";
            
            var adress = '';
            $.getJSON(url, function (data) {
                if(data.results[0] != null){
                    adress = data.results[0].formatted_address;
                    $('#detail_position').html("<b>Police No</b> : " + police_no + "<br><b>Status</b> : " + status + "<br><b>Time</b> : " + gpstime + "<br><b>Position</b> : " + adress);
                    
                    $('#modal_show_detail_position').modal('show');    
                    loadMap(latitude,longitude);
                }
                else{
                    sweetAlert('<?=lang('information')?>','No Data Detail');   
                }    
            });
        }
    });

    
    return true;   
}

function showPositionVehicle(police_no,status,position,gpstime,latitude,longitude)
{    
    var url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=" + position + "&sensor=false";
    var adress = '';
    $.getJSON(url, function (data) {
        if(data.results[0] != null){
            adress = data.results[0].formatted_address;
            $('#detail_position').html("<b>Police No</b> : " + police_no + "<br><b>Status</b> : " + status + "<br><b>Time</b> : " + gpstime + "<br><b>Position</b> : " + adress);
            
            $('#modal_show_detail_position').modal('show');    
            loadMap(latitude,longitude);
        }
        else{
            sweetAlert('<?=lang('information')?>','No Data Detail');   
        }    
    });
    
    return true;   
}

function loadMap(lati,longi) {
  
    if(typeof(lati) == 'undefined' && typeof(longi) == 'undefined'){
        var latitude = parseFloat(0);
        var longitude = parseFloat(0);
    }
    else{
        var latitude = parseFloat(lati);
        var longitude = parseFloat(longi);
    }
     
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: {lat: latitude, lng: longitude},
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var myLatlng = new google.maps.LatLng(latitude, longitude);
    
    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title: 'Vehicle Position'
    });

    $('#modal_show_detail_position').on('shown.bs.modal', function () {
        var center = map.getCenter();
        google.maps.event.trigger(map, "resize");
        map.setCenter(center);
    });
}
</script>

    
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>

<!-- /.aside -->
<aside class="aside-xxl bg-white b-l hide" id="aside">
    <section class="vbox">
		<section class="scrollable wrapper">
            <?=form_open(base_url().'finances/set_filter','autocomplete="off" id="form_period" class="form-horizontal"')?>                    
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
