<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <aside>
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <p class="pull-left"><?=lang('verification_documents')?></p>
            <div class="pull-right" style="margin-top: 10px;">
            </div>
            <div class="clearfix"></div>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <?=form_open(base_url().'verification_document/set_filter','autocomplete="off" id="form_period" class="form-horizontal"')?>
                        <div class="col-lg-4">&nbsp;</div>
                        <label class="col-lg-2 control-label"><?=lang('filter')?> : </label>
                        <div class="col-lg-3">
                            <div class="input-group input-daterange">
                                <input type="text" name="start_date" id="start_date" class="form-control input-sm tanggal_datetimepicker" placeholder="<?=lang('start_date')?>" value="<?=date('d-m-Y', strtotime($start_date))?>">
                                <span class="input-group-addon">to</span>
                                <input type="text" name="end_date" id="end_date" class="form-control input-sm tanggal_datetimepicker" placeholder="<?=lang('end_date')?>" value="<?=date('d-m-Y', strtotime($end_date))?>">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <button type="submit" class="btn btn-sm green"><i class="glyphicon glyphicon-filter"></i> <?=lang('filter')?></button>
                            <button type="button" class="btn btn-sm red" onclick="verification_document_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</button>
                        </div>
                        <?=form_close()?>
                    </div>                
                </div>
                <div class="table-responsive"><?php echo validation_errors(); ?>
                  <table class="table tbl-data_verification table-striped b-t b-light text-sm">
                    <thead>            
                      <tr>
                        <th><?=lang('no')?></th>
                        <th><?=lang('cash_advance_no')?></th>
                        <th><?=lang('date')?> </th>
						<th><?=lang('driver')?>/<?=lang('employee')?> Name</th>
						<th><?=lang('vehicle_police_no')?> </th>
						<th><?=lang('delivery_order_no')?> </th>
						<th>Tonase Deliver </th>
						<th>Tonase Receive </th>
						<th>Deliver Date</th>
						<th>Receive Date</th>
						<th>Realization Date </th>
						<th><?=lang('realization_value')?> (Rp) </th>
						<th><?=lang('verify')?> </th>
                      </tr> 
                    </thead> 
                    <tbody>
                      <?php
                      $no = 1;
                      if (!empty($verification_documents)) {
                        foreach ($verification_documents as $doc) { 
                      ?>
                      <tr>
                        <td><?=number_format($no++,0,',','.')?></td>
						<td align="left"><?= $doc->advance_no;?></td>
                        <td align="left"><?= date("d-m-Y",strtotime($doc->advance_date));?></td>
                		<td align="left"><?= $doc->debtor_name;?></td>
                		<td align="left"><?= $doc->police_no;?></td>
                		<td align="left"><?= $doc->do_no == '' ? '-' : $doc->do_no;?></td>
                		<td align="left"><?= number_format($doc->deliver_weight,0,',','.');?></td>
                		<td align="left"><?= number_format($doc->received_weight,0,',','.');?></td>
                        <td align="left"><?= date("d-m-Y",strtotime($doc->deliver_date));?></td>
                        <td align="left"><?= date("d-m-Y",strtotime($doc->received_date));?></td>
                        <td align="left"><?= date("d-m-Y",strtotime($doc->alloc_date));?></td>
                		<td align="right"><?= number_format($doc->advance_allocation,0,',','.');?></td>
                		<td align="left">
                            <?php
                            if($doc->status == 0){
                                echo '<a  href="javascript:void()" title="'.lang('verify').'" onclick="verify_document(\''.$doc->trx_no.'\')">
                                        <button class="btn btn-sm btn-success"><i class="fa fa-check"></i> '.lang('verify').'</button></a>';
                            }
                            else{
                                if($doc->invoice_no == ''){
                                    echo '<button class="btn btn-sm red" title="'.lang('unverify').'" onclick="show_modal_verify_document(\''.$doc->trx_no.'\')"><i class="fa fa-times"></i> '.lang('unverify').'</button>';
                                }      
                            }
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
  </aside>
  <!-- /.aside -->
  </section> 
  <!-- .aside -->
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
    
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
