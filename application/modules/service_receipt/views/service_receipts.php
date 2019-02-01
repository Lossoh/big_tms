<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="row" style="padding-top: 10px;">
                <div class="col-md-4" style="padding-top: 5px;">
                    <p><?=lang('service_receipt')?>s</p>              
                </div>     
                <div class="col-md-8 text-right">
                    <a href="#aside" data-toggle="class:show" id="btnFilter" onclick="showFilterText()" style="color: #46b8da;">Show Filter</a> &nbsp;
                    <?php
                    if($this->user_profile->get_user_access('Created') == 1){
                    ?>
                        <a class="btn btn-sm green" onclick="add_service_receipt()"><i class="fa fa-plus"></i> <?=lang('new_service_receipt')?></a>
                    <?php
                    }
                    if($this->user_profile->get_user_access('PrintLimited') == 1 || $this->user_profile->get_user_access('PrintUnlimited') == 1 || 
                        $this->user_profile->get_user_access('PrintOne') == 1 || $this->user_profile->get_user_access('PrintTwo') == 1){
                    ?>
                        <a class="btn btn-sm red" onclick="service_receipt_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
                        <a class="btn btn-sm btn-success" onclick="service_receipt_excel()"><i class="fa fa-file-excel-o"></i> Print Excel</a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive"><?php echo validation_errors(); ?>
                  <table id="tbl-projects" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th width="10%"><?=lang('options')?></th>
                        <th width="17%"><?=lang('service_receipt_code')?></th>
                        <th width="13%"><?=lang('date')?></th>
                        <th width="20%"><?=lang('debtor_name')?></th>
                        <th><?=lang('remark')?></th>
                        <th width="15%"><?=lang('total')?> (Rp)</th>
                      </tr> 
                    </thead> 
                    <tbody>
                      <?php
                      if (!empty($service_receipts)) {
                      foreach ($service_receipts as $service_receipt) { ?>
                      <tr>
                        <td>
						  <div class="btn-group">
							<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
							 <?=lang('options')?>
							<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
                                <?php
                                if($this->user_profile->get_user_access('PrintLimited') == 1 || $this->user_profile->get_user_access('PrintUnlimited') == 1 || 
                                    $this->user_profile->get_user_access('PrintOne') == 1 || $this->user_profile->get_user_access('PrintTwo') == 1){
                                        if($this->user_profile->get_user_access('PrintLimited') == 1){
                                            if($this->user_profile->get_log_limited_printed($service_receipt->trx_no,'Service Receipt') == 0){
                                ?>
                                                <li><a  href="javascript:void()" title="<?=lang('print_option')?>" onclick="print_service_receipt('<?=$service_receipt->trx_no ?>')"><i class="fa fa-print"></i> <?=lang('print_option')?></a></li>
                                <?php
                                            }
                                        }
                                        else{
                                ?>
									       <li><a  href="javascript:void()" title="<?=lang('print_option')?>" onclick="print_service_receipt('<?=$service_receipt->trx_no ?>')"><i class="fa fa-print"></i> <?=lang('print_option')?></a></li>
                                <?php
                                        }
                                }
                                if($this->user_profile->get_user_access('Updated') == 1){
                                ?>
								    <li><a  href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_service_receipt(<?=$service_receipt->rowID ?>)"><i class="fa fa-pencil"></i> <?=lang('update_option')?></a></li>
                                <?php
                                }
                                if($this->user_profile->get_user_access('Deleted') == 1){
                                ?>
                                    <li><a  href="javascript:void()" title="<?=lang('delete_option')?>" onclick="delete_service_receipt(<?=$service_receipt->rowID ?>)"><i class="fa fa-trash-o"></i> <?=lang('delete_option')?></a></li>
                                <?php
                                }
                                ?>
							</ul>
						  </div>
						</td>
						<td><?=$service_receipt->trx_no?></td>
						<td><?=date('d-m-Y',strtotime($service_receipt->trx_date))?></td>
						<td><?=$service_receipt->debtor_name?></td>
						<td><?=$service_receipt->remark?></td>
						<td align="right"><?=number_format($service_receipt->total,0,',','.')?></td>
                      </tr>
                    <?php } } ?>
                    
                    
                  </tbody>
                </table>

              </div>
            </section>            
          </div>
        </div>
      </section>

    </section>
 <!-- </aside>-->
  <!-- /.aside -->

<select id="spk_no" class="form-control" style="display: none;">
	 <option value="" selected><?=lang('select_your_option')?></option>
	 <option value="OTHERS">OTHERS</option>
	 <?php if (!empty($spk_data)) {
	  foreach ($spk_data as $spk_row) { ?>
	  <option value="<?php echo $spk_row->trx_no;?>"><?php echo $spk_row->trx_no;?></option>
	 <?php }} ?>
</select>

<select id="spk_no_not_receipt" class="form-control" style="display: none;">
	 <option value="" selected><?=lang('select_your_option')?></option>
	 <option value="OTHERS">OTHERS</option>
	 <?php if (!empty($spk_not_receipt_data)) {
	  foreach ($spk_not_receipt_data as $spk_row) { ?>
	  <option value="<?php echo $spk_row->trx_no;?>"><?php echo $spk_row->trx_no;?></option>
	 <?php }} ?>
</select>
     
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog" style="width:55%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?=lang('new_service_receipt')?></h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>
        <input type="hidden" name="rowID" value="" />
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('date')?><span class="text-danger">*</span></label>
            <div class="col-md-3">
                <input type="text" class="form-control input-sm text-center" name="trx_date" id="trx_date" placeholder="<?=lang('date')?>" value="<?=date('d-m-Y')?>" required="" readonly="" />
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('debtor_name')?><span class="text-danger">*</span></label>
            <div class="col-md-5">
                 <select class="form-control all_select2" name="debtor_rowID" id="debtor_rowID" >	
                    <option value="" selected><?=lang('select_your_option')?></option>
					<?php 
                    if (!empty($debtors)) {
                        foreach ($debtors as $debtor) {
                    ?>
                            <option value="<?=$debtor->rowID;?>"><?=$debtor->type.$debtor->debtor_cd?> - <?=$debtor->debtor_name?></option>
					<?php 
                        }
                    } 
                    ?>
			    </select> 
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('total')?><span class="text-danger">*</span></label>
            <div class="col-lg-3">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Rp</span>
                    <input type="text" class="form-control input-sm angka_jutaan" value="0" name="total" id="total" style="text-align: right;" placeholder="Total" required="" readonly="" />
                </div>
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('remark')?></label>
            <div class="col-lg-7">
                <textarea class="form-control" name="remark" id="remark" rows="2" placeholder="Remark" required="" maxlength="150"></textarea>
            </div>
        </div>
        <div class="row">
          <div class="col-md-12">
              <table cellspacing="0" cellpadding="0" class="table table-responsive table-striped table-condensed b-t b-light text-sm" style="width:100%;" id="service_receipt_detail">
                <thead>
                    <tr valign="middle">
                        <th width="5%">
                            <input id="tamdet" title="Tambah Baris" type="button" onclick="add_row_service_receipt()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
                        </th>
                        <th width="28%">SPK No</th>
                        <th><?=lang('description')?>s</th>
                        <th width="20%"><?=lang('amount')?> (Rp)</th>
                    </tr>
                </thead>
              </table>
          </div>             
        </div>
        <?=form_close()?>
        </div>
        <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_service_receipt()" class="btn green">Save</button>
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
            <?=form_open(base_url().'service_receipt/set_filter','autocomplete="off" id="form_period" class="form-horizontal"')?>                    
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
