<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="row" style="padding-top: 10px;">
                <div class="col-md-4" style="padding-top: 5px;">
                    <p><?=lang('advance_details')?></p>              
                </div>     
                <div class="col-md-8 text-right">
                   <!--  <a href="#aside" data-toggle="class:show" id="btnFilter" onclick="showFilterText()" style="color: #46b8da;">Show Filter</a> &nbsp; -->
                    <?php
                    if($this->user_profile->get_user_access('Created') == 1){
                    ?>
                        <a  class="btn btn-sm green" onclick="add_advance()"><i class="fa fa-plus"></i> <?=lang('new_advance')?></a>
                    <?php
                    }
                    if($this->user_profile->get_user_access('PrintLimited') == 1 || $this->user_profile->get_user_access('PrintUnlimited') == 1 || 
                        $this->user_profile->get_user_access('PrintOne') == 1 || $this->user_profile->get_user_access('PrintTwo') == 1){
                    ?>
                        <a  class="btn btn-sm red" onclick="advance_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
                        <a  class="btn btn-sm btn-success" onclick="advance_excel()"><i class="fa fa-file-excel-o"></i> Print Excel</a>
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

                    <table id="tbl-advances" class="table table-striped table-hover b-t b-light text-sm">
                        <thead>
                            <tr>
                                <th width="10%"><?=lang('options')?></th>
                                <th><?=lang('advance_number')?> </th>
                                <th><?=lang('reimburse_number')?> </th>
                                <th><?=lang('date')?> </th>
                                <th><?=lang('advance_type')?></th>
                                <th><?=lang('debtor_name')?> </th>
                                <th><?=lang('dp_for_creditor')?></th>
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

        
    <select class="form-control" name="all_expense" id="all_expense" style="display: none;" ></select> 
    
    <!-- Bootstrap modal -->
      <div class="modal fade" id="modal_form_advance" role="dialog">
      <div class="modal-dialog" style="width:1200px;">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title modal-title-advance"><?=lang('new_advance')?></h3>
          </div>
          <div class="modal-body form" style="overflow: scroll;height:450px">
            <?=form_open('','autocomplete="off" id="form_advance" class="form-horizontal"')?>
            <input type="hidden" name="rowID" value="" />
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group form-md-line-input">
                        <label class="col-lg-4 control-label">Advance <?=lang('date')?> <span class="text-danger">*</span></label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control input-sm tanggal_datetimepicker" value="<?=date('d-m-Y')?>" name="date" id="date" style="text-align: center;" placeholder="dd-mm-YYYY" maxlength="10" required="" />
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-lg-4 control-label">JO Type</label>
                        <div class="col-lg-4">
                            <select class="form-control input-sm" name="jo_type_advance" id="jo_type_advance" onchange="ch_jo_type_advance()">
                                <option value="">- Select -</option>
                                <option value="jo">Job Order Regular</option>
                                <option value="jo_emkl">Job Order EMKL</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-lg-4 control-label">JO No / Sub JO <span id="jo_no_star" class="text-danger"></span></label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control input-sm" name="jo_no" id="jo_no" placeholder="Select JO No / Sub JO" onclick="ambil_job_order_advance()" required="" style="cursor: pointer;" />
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-lg-4 control-label">Ex Kapal</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control input-sm" name="ex_kapal" id="ex_kapal" placeholder="Ex Kapal" readonly="" />
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-lg-4 control-label">PO No</label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control input-sm" name="po_no" id="po_no" placeholder="PO No" readonly="" />
                        </div>
                        <label class="col-lg-2 control-label">Port</label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control input-sm" name="port" id="port" placeholder="Port" readonly="" />
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-lg-4 control-label">Tonase/Container</label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control input-sm" name="tonase" id="tonase" placeholder="Tonase/Container" readonly="" />
                        </div>
                        <label class="col-lg-2 control-label">Cargo</label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control input-sm" name="cargo" id="cargo" placeholder="Nama Cargo" readonly="" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-md-line-input"> 
                        <label class="col-lg-4 control-label"><?=lang('advance_type')?> <span class="text-danger">*</span></label>
                        <div class="col-md-5">
                            <div id="advance_type_field">
                                <select class="form-control" name="advance_type_rowID" id="advance_type_rowID" onchange="change_advance_type()">	
                					 <option value="">- Select -</option>
                                     <?php 
                                     if (!empty($advance_types)) {
                                        foreach ($advance_types as $advance_type) { 
                                     ?>
                                            <option value="<?=$advance_type->rowID;?>"><?=$advance_type->advance_cd?> - <?=$advance_type->advance_name?></option>
                					 <?php 
                                        }
                                     } 
                                     ?>
                			    </select> 
                            </div>
                            <div id="text_advance_type" style="padding-top: 7px;"></div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-lg-4 control-label">Request by <span class="text-danger">*</span></label>
                        <div class="col-md-5">
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
                    <div class="form-group form-md-line-input" id="dp_field" style="display: none;">
                        <label class="col-lg-4 control-label">DP <span class="text-danger">*</span></label>
                        <div class="col-md-2" style="padding-top: 6px;"><input type="checkbox" name="chk_dp" id="chk_dp" value="1" /> Yes</div>
                        <div class="col-md-6 creditor_row" style="display: none;">
                            <select class="form-control all_select2" name="dp_creditor_rowID" id="dp_creditor_rowID" >	
            					 <option value="">Select Creditor</option>
                                 <?php 
                                 if (!empty($creditors)) {
                                    foreach ($creditors as $creditor) { 
                                 ?>
                                        <option value="<?=$creditor->rowID;?>"><?=$creditor->creditor_cd?> - <?=$creditor->creditor_name?></option>
            					 <?php 
                                    }
                                 } 
                                 ?>
            			    </select> 
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-lg-4 control-label"><?=lang('remark')?> <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <textarea class="form-control" name="remark" id="remark" rows="2" placeholder="Remark" required="" onkeyup="replaceQuotes(this)"></textarea>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-lg-4 control-label"><?=lang('amount')?> <span class="text-danger">*</span></label>
                        <div class="col-lg-4">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">Rp</span>
                                <input type="text" class="form-control input-sm currency" value="0" name="advance_total" id="advance_total" style="text-align: right;" placeholder="Amount" readonly="" required>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              <br />
              <div class="row">
                <div class="col-md-12">
                    <table id="detail_advance" cellspacing="0" cellpadding="0" class="table table-responsive table-striped table-condensed b-t b-light text-sm" style="width:100%;">
                        <tr>
                            <th width="5%">
                                <input id="tamdetAdvance" title="Tambah Baris" type="button" onclick="addRowDetailAdvance()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
                            </th>
                            <th width="25%">Code Description</th>
                            <th>Description</th>
                            <th width="15%">Amount (Rp)</th>
                        </tr>
                    </table>
                </div>
              </div>
              <?=form_close()?>
              </div>
              <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save_advance()" class="btn green">Save</button>
                <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    
    <!-- Modal JO -->
      <div class="modal fade" id="joModal" role="dialog">
        <div class="modal-dialog" style="width:920px;height:30px;">
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
                      <table id="tbl-joborder" class="table table-responsive table-striped b-t b-light text-sm">
                        <thead>
                          <tr>
                            <th><?=lang('job_order_no')?></th>
    						<th><?=lang('job_order_debtor')?></th>
                            <th><?=lang('job_order_po_spk_no')?></th>
                            <th>From - To</th>
                            <th>JO Type</th>
                            <th>Price Type</th>
                            <th>Cargo</th>
                            <th><?=lang('port')?></th>
                            <th><?=lang('vessel_name')?> </th>
    						<th><?=lang('job_order_date')?></th>
                            <th><?=lang('job_order_so_no')?></th>
                            <th><?=lang('vessel_no')?> </th>
                            <th>Tonase/Container</th>
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
                            <td><?=number_format($rs->weight,0,',','.')?></td>
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
    
    <div class="modal fade" id="joEmklModal" role="dialog">
        <div class="modal-dialog" style="width:920px;height:30px;">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title modal-job-emkl-title">Job Order EMKL List</h4>
            </div>
            <div class="modal-body">
              <!--<section class="scrollable wrapper">-->
              <div class="row">
               <input type="hidden" id="tag" value="">
                <div class="col-lg-12">
                  <section class="panel panel-default">
                    <div class="table-responsive">
                      <table id="tbl-joborder-emkl" class="table table-responsive table-striped b-t b-light text-sm">
                        <thead>
                          <tr>
                            <th><?=lang('job_order_emkl_no')?> </th>
    						<th><?=lang('job_order_date')?> </th>
    						<th><?=lang('jo_type')?> </th>
    						<th><?=lang('debtor')?> </th>
    						<th><?=lang('job_order_po_spk_no')?> </th>
    						<th><?=lang('job_order_so_no')?> </th>
    						<th><?=lang('vessel_name')?> </th>
    						<th><?=lang('port_name')?> </th>
                          </tr> 
    					</thead>
    					<tbody>
                          <?php
                          if (!empty($job_order_emkls)) {
                          foreach ($job_order_emkls as $job_order_emkl) { 
                            $jo_type = '-';
                            if($job_order_emkl->jo_type == 1){
                                $jo_type = 'BULK';                            
                            }
                            else if($job_order_emkl->jo_type == 2){
                                $jo_type = 'CONTAINER';
                            }
                            else if($job_order_emkl->jo_type == 3){
                                $jo_type = 'OTHER';
                            }
                            
                          ?>
                          <tr style="cursor: pointer;" >
    						<td><?=$job_order_emkl->jo_no?></td>
							<td><?=date("d F Y",strtotime($job_order_emkl->jo_date))?></td>
							<td><?=$jo_type?></td>
							<td><?=$job_order_emkl->debtor_code?> - <?=$job_order_emkl->debtor_name?></td>
							<td><?=$job_order_emkl->po_spk_no?></td>
							<td><?=$job_order_emkl->so_no?></td>
							<td><?=$job_order_emkl->vessel_no?> - <?=$job_order_emkl->vessel_name?></td>
							<td><?=$job_order_emkl->port_code?> - <?=$job_order_emkl->port_name?></td>
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
    <!-- Modal JO -->
    
    </section>
  <!--</aside>-->
  
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>

<!-- /.aside -->
<aside class="aside-xxl bg-white b-l hide" id="aside">
    <section class="vbox">
		<section class="scrollable wrapper">
            <?=form_open(base_url().'advance/set_filter','autocomplete="off" id="form_period" class="form-horizontal"')?>                    
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
        
        var table_advances = $('#tbl-advances').DataTable({
            processing: true,
            serverSide: true,
            sDom: "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            sPaginationType: "full_numbers",
            ajax: {
                url: "<?= base_url() ?>advance/fetch_data",
                type: 'POST',
                data: {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
            },
            columns: [
                {
                    "data": "dropdown_option", "orderable": false, "searchable": false, "className": "text-center"
                },
                {
                    "data": "advance_number"
                },
                {
                    "data": "data_reimburse"
                },
                {
                    "data": "advance_date"
                },
                {
                    "data": "advance_name"
                },
                {
                    "data": "debtor"
                },
                {
                    "data": "creditor_name"
                },
                {
                    "data": "remark"
                },
                {
                    "data": "advance_total", "className": "text-right"
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
                table_advances.search(value).draw();
            } 
            if (value.length == 0) {
                table_advances.search(value).draw();
            } 
        });
        $(".start_date").on("dp.change", function (e) {
            var start_date = $("#start_date").val();
            table_advances.columns(9).search(start_date).draw();
            $("#start_date").blur();
        });
        $(".end_date").on("dp.change", function (e) {
            var end_date = $("#end_date").val();
            table_advances.columns(10).search(end_date).draw();
            $("#end_date").blur();
        });
    });
</script>