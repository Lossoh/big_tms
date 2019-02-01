<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="row" style="padding-top: 10px;">
                <div class="col-md-6" style="padding-top: 5px;">
                    <p><?=lang('containers')?></p>              
                </div>     
                <div class="col-md-6 text-right">
                    <a href="#aside" data-toggle="class:show" id="btnFilter" onclick="showFilterText()" style="color: #46b8da;">Show Filter</a> &nbsp;
                    <?php
                    if($this->user_profile->get_user_access('PrintLimited') == 1 || $this->user_profile->get_user_access('PrintUnlimited') == 1 || 
                        $this->user_profile->get_user_access('PrintOne') == 1 || $this->user_profile->get_user_access('PrintTwo') == 1){
                    ?>
                        <a  class="btn btn-sm red" onclick="container_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
                        <a  class="btn btn-sm btn-success" onclick="container_excel()"><i class="fa fa-file-excel-o"></i> Print Excel</a>
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
                  <table id="tbl-orders" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th width="10%"><?=lang('options')?></th>
                        <th><?=lang('job_order_emkl_no')?> </th>
						<th><?=lang('job_order_date')?> </th>
						<th><?=lang('debtor')?> </th>
						<th><?=lang('job_order_po_spk_no')?> </th>
						<th><?=lang('job_order_so_no')?> </th>
						<th><?=lang('vessel_name')?> </th>
						<th><?=lang('port_name')?> </th>
                        <th><?=lang('status')?></th>
                      </tr> 
                    </thead> 
                    <tbody>
                    <?php
                    if (!empty($job_orders)) {
                        foreach ($job_orders as $job_order) { 
                    ?>
                    <tr>
                        <td align="center">
						  <div class="btn-group">
							<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
							 <?=lang('options')?>
							<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
                                <?php
                                $get_detail_data = $this->container_model->get_detail_data_by_jo($job_order->jo_no);
                                if(count($get_detail_data) == 0){
                                    if($this->user_profile->get_user_access('Created') == 1){
                                ?>
                                        <li><a  href="javascript:void()" title="Add Container" onclick="add_container('<?=$job_order->jo_no?>')"><i class="fa fa-plus"></i> Add Container</a></li>
                                <?php
                                    }
                                }
                                else{
                                    if($this->user_profile->get_user_access('Updated') == 1){
                                ?>
                                        <li><a  href="javascript:void()" title="Edit Container" onclick="edit_container('<?=$job_order->jo_no?>')"><i class="fa fa-edit"></i> Edit Container</a></li>
                                <?php
                                    }
                                }
                                ?>
							</ul>                            
						  </div>
						</td>
						<td><?=$job_order->jo_no?></td>
						<td><?=date("d F Y",strtotime($job_order->jo_date))?></td>
						<td><?=$job_order->debtor_code?> - <?=$job_order->debtor_name?></td>
						<td><?=$job_order->po_spk_no?></td>
						<td><?=$job_order->so_no?></td>
						<td><?=$job_order->vessel_no?> - <?=$job_order->vessel_name?></td>
						<td><?=$job_order->port_code?> - <?=$job_order->port_name?></td>
                        <td>
                            <?php
                                if($job_order->status == 0)
                                    $status = 'Open';
                                else if($job_order->status == 1)
                                    $status = 'Admin';
                                else
                                    $status = 'Close';
                                
                                echo $status;
                            ?>
                        </td>
                    </tr>
                    <?php 
                        } 
                    } 
                    ?>
                    
                  </tbody>
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
        <h3 class="modal-title"><?=lang('new_container')?></h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>
        <input type="hidden" name="edit" id="edit" />
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('job_order_no')?><span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <input type="text" class="form-control input-sm" name="jo_no" id="jo_no" placeholder="<?=lang('job_order_no')?>" readonly="" required="" />
            </div>
        </div>        
        <p>&nbsp;</p>
        <div class="bs-example"> 
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#container_20ft">Container <?=lang('20ft')?></a></li>
                <li><a data-toggle="tab" href="#container_40ft">Container <?=lang('40ft')?></a></li>
                <li><a data-toggle="tab" href="#container_45ft">Container <?=lang('45ft')?></a></li>
            </ul>
            <div class="tab-content">
                <div id="container_20ft" class="tab-pane active">
                    <br />
                    <div class="table-responsive"> 
                        <table class="table table-responsive" cellspacing="0" cellpadding="3" id="detail_20ft">
                            <tr valign="middle">
                                <th width="5%">
                                    <input id="tamdet" title="Tambah Baris" type="button" onclick="add_20ft()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
                                </th>
                                <th width="30%">Container No</th>
                                <th width="30%">Seal No</th>
                                <th width="35%">Replacement Seal No</th>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="container_40ft" class="tab-pane">
                    <br />
                    <div class="table-responsive">  
                        <table class="table table-responsive" cellspacing="0" cellpadding="3" id="detail_40ft">
                            <tr valign="middle">
                                <th width="5%">
                                    <input id="tamdet" title="Tambah Baris" type="button" onclick="add_40ft()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
                                </th>
                                <th width="30%">Container No</th>
                                <th width="30%">Seal No</th>
                                <th width="35%">Replacement Seal No</th>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="container_45ft" class="tab-pane">
                    <br />
                    <div class="table-responsive">  
                        <table class="table table-responsive" cellspacing="0" cellpadding="3" id="detail_45ft">
                            <tr valign="middle">
                                <th width="5%">
                                    <input id="tamdet" title="Tambah Baris" type="button" onclick="add_45ft()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
                                </th>
                                <th width="30%">Container No</th>
                                <th width="30%">Seal No</th>
                                <th width="35%">Replacement Seal No</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
          </div>         
              
          <?=form_close()?>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_container()" class="btn green">Save</button>
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
            <?=form_open(base_url().'container/set_filter','autocomplete="off" id="form_period" class="form-horizontal"')?>                    
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
