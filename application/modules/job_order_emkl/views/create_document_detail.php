<section id="content">
	<section class="hbox stretch">		
		<aside>
			<section class="vbox">
				<header class="header bg-white b-b b-light">
                    <div class="pull-right" style="margin-top: 10px;">
                      <button type="button" class="btn btn-sm btn-dark btn_cleartable" onclick="location.replace('<?php echo base_url('job_order_emkl')?>');//history.back();"><i class="fa fa-arrow-left"></i> <?=lang('back')?></button>
                    </div>
					<p class="pull-left"><strong><?=lang('document_detail')?></strong>
				</header>
				<section class="scrollable wrapper">
				<?php
					$attributes = array('class' => 'bs-example form-horizontal', 'autocomplete' => 'off');
					echo form_open(base_url().'job_order_emkl/document_detail',$attributes); 
				?>
				<div class="row"> 
					<div class="col-xs-12">
						<div class="group">	
							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-2"><?=lang('job_order_emkl_no')?></div>
								<div class="col-md-2" style="padding-left: 0px">			
                                    <input type="hidden"  id="user_created" name="user_created" value="<?=$document_detail->user_created?>">
                                    <input type="hidden"  id="date_created" name="date_created" value="<?=$document_detail->date_created?>">
                                    <input type="hidden"  id="time_created" name="time_created" value="<?=$document_detail->time_created?>">							
                                    <input type="hidden" class="form-control input-sm" id="rowID" name="rowID" value="<?=$document_detail->rowID?>" readonly />
									<input type="text" class="form-control input-sm" id="jo_no" name="jo_no" maxlength="25" autocomplete="off" value="<?=$job_order_emkl->jo_no?>" required readonly />
								</div>
							</div>			
                            <div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-2"><?=lang('job_order_po_spk_no')?> <span class="text-danger">*</span></div>
								<div class="col-md-2" style="padding-left: 0px">
									<input type="text" class="form-control input-sm" id="po_spk_no" name="po_spk_no" maxlength="25" autocomplete="off" value="<?=$job_order_emkl->po_spk_no?>" required readonly />
								</div>
							</div>
                            <div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-2"><?=lang('bl_no')?> <span class="text-danger">*</span></div>
								<div class="col-md-2" style="padding-left: 0px">
									<input type="text" class="form-control input-sm" id="bl_no" name="bl_no" maxlength="25" autocomplete="off" value="<?=$job_order_emkl->bl_no?>" required readonly />
								</div>
							</div>			
                            <div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-2">ETA <?=lang('date')?> <span class="text-danger">*</span></div>
								<div class="col-md-2" style="padding-left: 0px">
									<input type="text" class="form-control input-sm" id="eta_date" name="eta_date" autocomplete="off" value="<?=date('d-m-Y',strtotime($job_order_emkl->eta_date))?>" required readonly />
								</div>
                                <div class="col-md-2">Start Demurage <?=lang('date')?> <span class="text-danger">*</span></div>
								<div class="col-md-2" style="padding: 0px 10px 0px 0px">
									<input type="text" class="form-control input-sm tanggal_datetimepicker" id="start_demurage" name="start_demurage" autocomplete="off" value="<?=$document_detail->start_demurage == '1970-01-01' || $document_detail->start_demurage == '' ? '' : date('d-m-Y',strtotime($document_detail->start_demurage))?>" required />
								</div>
                                <div class="col-md-1" style="padding-right: 0px;">Free Time <span class="text-danger">*</span></div>
								<div class="col-md-2">
                                    <div class="input-group">
                                        <input type="text" class="form-control input-sm" id="free_time" name="free_time" autocomplete="off" onkeyup="angka(this);" value="<?=$document_detail->free_time?>" style="text-align: center;" readonly="" required />
                                        <span class="input-group-addon" id="basic-addon2">day(s)</span>
                                    </div>
								</div>
							</div>
                            <div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
								<div class="col-md-2">SPPB <?=lang('date')?> <span class="text-danger">*</span></div>
								<div class="col-md-2" style="padding: 0px 10px 0px 0px">
									<input type="text" class="form-control input-sm tanggal_datetimepicker" id="sppb_date" name="sppb_date" autocomplete="off" value="<?=$document_detail->sppb_date == '1970-01-01' || $document_detail->sppb_date == '' ? date('d-m-Y') : date('d-m-Y',strtotime($document_detail->sppb_date))?>" required />
								</div>
							</div>
						</div>	
					</div>		
					
				</div>					
				<p>&nbsp;</p>
                <div class="bs-example">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#bl_po_document"><?=lang('bl_po_document') ?></a></li>
                        <li><a data-toggle="tab" href="#quarantine"><?=lang('quarantine')?></a></li>
                        <li><a data-toggle="tab" href="#do_process"><?=lang('do_process')?></a></li>
                        <li><a data-toggle="tab" href="#tila"><?=lang('tila')?></a></li>
                        <li><a data-toggle="tab" href="#survey_of_guarantee"><?=lang('survey_of_guarantee')?></a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="bl_po_document" class="tab-pane active">
                            <br />
                            <div class="row">
                                <div class="col-md-1">
                                    <input class="form-control input-sm" name="po_check" id="po_check" value="1" style="display: inline !important;width: 15px;" type="checkbox" <?=$document_detail->po_check == 1 ? 'checked=""' : ''?> /> PO
                                </div>
                                <div class="col-md-1">
                                    PO Date
                                </div>
                                <div class="col-md-2" style="padding: 0px 10px 0px 0px">
									<input type="text" class="form-control input-sm tanggal_datetimepicker" id="po_date" name="po_date" autocomplete="off" value="<?=$document_detail->po_date == '1970-01-01' || $document_detail->po_date == '' ? date('d-m-Y') : date('d-m-Y',strtotime($document_detail->po_date))?>" />                                    
                                </div>
                                <div class="col-md-1" style="padding: 0px 0px 0px 5px">
                                    <input class="form-control input-sm" name="po_original" id="po_original" value="1" style="display: inline !important;width: 15px;" type="checkbox" <?=$document_detail->po_original == 1 ? 'checked=""' : ''?> /> Original                                    
                                </div>
                                <div class="col-md-1" style="padding: 0px">
                                    <input class="form-control input-sm" name="po_copy" id="po_copy" value="1" style="display: inline !important;width: 15px;" type="checkbox" <?=$document_detail->po_copy == 1 ? 'checked=""' : ''?> /> Copy                                    
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-1">
                                    <input class="form-control input-sm" name="bl_check" id="bl_check" value="1" style="display: inline !important;width: 15px;" type="checkbox" <?=$document_detail->bl_check == 1 ? 'checked=""' : ''?> /> BL
                                </div>
                                <div class="col-md-1">
                                    BL Date
                                </div>
                                <div class="col-md-2" style="padding: 0px 10px 0px 0px">
									<input type="text" class="form-control input-sm tanggal_datetimepicker" id="bl_date" name="bl_date" autocomplete="off" value="<?=$document_detail->bl_date == '1970-01-01' || $document_detail->bl_date == '' ? date('d-m-Y') : date('d-m-Y',strtotime($document_detail->bl_date))?>" />                                    
                                </div>
                                <div class="col-md-1" style="padding: 0px 0px 0px 5px">
                                    <input class="form-control input-sm" name="bl_original" id="bl_original" value="1" style="display: inline !important;width: 15px;" type="checkbox" <?=$document_detail->bl_original == 1 ? 'checked=""' : ''?> /> Original                                    
                                </div>
                                <div class="col-md-1" style="padding: 0px">
                                    <input class="form-control input-sm" name="bl_copy" id="bl_copy" value="1" style="display: inline !important;width: 15px;" type="checkbox" <?=$document_detail->bl_copy == 1 ? 'checked=""' : ''?> /> Copy                                    
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-2">
                                    Complete Date
                                </div>
                                <div class="col-md-2" style="padding: 0px 10px 0px 0px">
									<input type="text" class="form-control input-sm tanggal_datetimepicker" id="complete_date" name="complete_date" autocomplete="off" value="<?=$document_detail->complete_date == '1970-01-01' || $document_detail->complete_date == '' ? date('d-m-Y') : date('d-m-Y',strtotime($document_detail->complete_date))?>" />
                                </div>
                            </div>
                        </div>
                        <div id="quarantine" class="tab-pane">
                            <br />
                            <div class="row">
                                <div class="col-md-2">
                                    Officer Name
                                </div>
                                <div class="col-md-2" style="padding: 0px 10px 0px 0px">
									<input type="text" class="form-control input-sm" id="quarantine_officer_name" name="quarantine_officer_name" maxlength="30" autocomplete="off" value="<?=$document_detail->quarantine_officer_name?>" />
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-2">
                                    Process Date
                                </div>
                                <div class="col-md-2" style="padding: 0px 10px 0px 0px">
									<input type="text" class="form-control input-sm tanggal_datetimepicker" id="quarantine_process_date" name="quarantine_process_date" autocomplete="off" value="<?=$document_detail->quarantine_process_date == '1970-01-01' || $document_detail->quarantine_process_date == '' ? date('d-m-Y') : date('d-m-Y',strtotime($document_detail->quarantine_process_date))?>" />
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-2">
                                    Finish Date
                                </div>
                                <div class="col-md-2" style="padding: 0px 10px 0px 0px">
									<input type="text" class="form-control input-sm tanggal_datetimepicker" id="quarantine_finish_date" name="quarantine_finish_date" autocomplete="off" value="<?=$document_detail->quarantine_finish_date == '1970-01-01' || $document_detail->quarantine_finish_date == '' ? date('d-m-Y') : date('d-m-Y',strtotime($document_detail->quarantine_finish_date))?>" />
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-2">
                                    <?=lang('quarantine_type')?>
                                </div>
                                <div class="col-md-2" style="padding: 0px 10px 0px 0px">
									<input type="text" class="form-control input-sm" id="quarantine_type" name="quarantine_type" autocomplete="off" maxlength="50" value="<?=$document_detail->quarantine_type?>" />
                                </div>
                            </div>
                        </div>
                        <div id="do_process" class="tab-pane">
                            <br />
                            <div class="table-responsive"> 
                                <table class="table table-responsive table-striped table-condensed" id="detail_do_process">
                                    <tr>
                                        <th style="width: 5%;">
                                            <input id="tamdet" title="Add Row" type="button" onclick="addRow_do_process()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url('<?= base_url();?>resource/images/plus.png');background-repeat:no-repeat;" />
                                        </th>
                                        <th width="20%">Officer Name</th>
                                        <th width="13%">Collection Date</th>
                                        <th>Remark</th>
                                    </tr>
                                    <?php
                                    if($count_data_detail_do_process > 0){
                                        $totrowDO = 1;
                                        foreach($document_process_data as $row){
                                            echo "
                                                <tr id='rowDO_".$totrowDO."'>
                                                    <td>
                                                        <input type='button' style='height:30px;width:30px;border:0px;background-image:url(\"".base_url()."resource/images/delete.png\");background-repeat:no-repeat;' title='Hapus Baris' value='&nbsp;' onclick='deleteDoProcess(".$totrowDO.")' />
                                                    </td>
                                                    <td>
                                                        <input type='hidden' name='rowdo_ID[]' value='".$row->rowID."' /><input class='form-control input-sm' id='officer_name_".$totrowDO."' name='officer_name[]' type='text' maxlength='30' value='".$row->officer_name."' autocomplete='off' />
                                                    </td>
                                                    <td>
                                                        <input class='form-control input-sm text-center' id='collection_date_".$totrowDO."' name='collection_date[]' type='text' maxlength='10' value='".date('d-m-Y',strtotime($row->collection_date))."' autocomplete='off' />
                                                    </td>
                                                    <td>
                                                        <textarea class='form-control input-sm' id='remark_".$totrowDO."' name='remark[]' maxlength='150' autocomplete='off' rows='2'>".$row->remark."</textarea>
                                                    </td>
                                                </tr>
                                            ";
                                            
                                            echo "
                                            <script>
                                                $('#collection_date_".$totrowDO."').datepicker({
                                                    format: 'dd-mm-yyyy',
                                                    todayBtn: 'linked',
                                                }).on('changeDate',function(ev){
                                                    $('#collection_date_".$totrowDO."').datepicker('hide');
                                            	});
                                            </script>
                                            ";
                                            
                                            $totrowDO++;
                                        }
                                    }
                                    ?>
                                </table>
                                <br /><br /><br />
                            </div>
                        </div>
                        <div id="tila" class="tab-pane">
                            <br />
                            <div class="row">
                                <div class="col-md-2">
                                    Officer Name
                                </div>
                                <div class="col-md-2" style="padding: 0px 10px 0px 0px">
									<input type="text" class="form-control input-sm" id="tila_officer_name" name="tila_officer_name" maxlength="30" autocomplete="off" value="<?=$document_detail->tila_officer_name?>" />
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-2">
                                    TILA Date
                                </div>
                                <div class="col-md-2" style="padding: 0px 10px 0px 0px">
									<input type="text" class="form-control input-sm tanggal_datetimepicker" id="tila_date" name="tila_date" autocomplete="off" value="<?=$document_detail->tila_date == '1970-01-01' || $document_detail->tila_date == '' ? date('d-m-Y') : date('d-m-Y',strtotime($document_detail->tila_date))?>" />
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-2">
                                    Reimburse Date
                                </div>
                                <div class="col-md-2" style="padding: 0px 10px 0px 0px">
									<input type="text" class="form-control input-sm tanggal_datetimepicker" id="reimburse_date" name="reimburse_date" autocomplete="off" value="<?=$document_detail->reimburse_date == '1970-01-01' || $document_detail->reimburse_date == '' ? date('d-m-Y') : date('d-m-Y',strtotime($document_detail->reimburse_date))?>" />
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-2">
                                    Survey Date
                                </div>
                                <div class="col-md-2" style="padding: 0px 10px 0px 0px">
									<input type="text" class="form-control input-sm tanggal_datetimepicker" id="survey_date" name="survey_date" autocomplete="off" value="<?=$document_detail->survey_date == '1970-01-01' || $document_detail->survey_date == '' ? date('d-m-Y') : date('d-m-Y',strtotime($document_detail->survey_date))?>" />
                                </div>
                            </div>
                        </div>
                        <div id="survey_of_guarantee" class="tab-pane">
                            <br />
                            <div class="row">
                                <div class="col-md-2">
                                    Officer Name
                                </div>
                                <div class="col-md-2" style="padding: 0px 10px 0px 0px">
									<input type="text" class="form-control input-sm" id="guarantee_officer_name" name="guarantee_officer_name" maxlength="30" autocomplete="off" value="<?=$document_detail->guarantee_officer_name?>" />
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-2">
                                    Guarantee Date
                                </div>
                                <div class="col-md-2" style="padding: 0px 10px 0px 0px">
									<input type="text" class="form-control input-sm tanggal_datetimepicker" id="guarantee_date" name="guarantee_date" autocomplete="off" value="<?=$document_detail->guarantee_date == '1970-01-01' || $document_detail->guarantee_date == '' ? date('d-m-Y') : date('d-m-Y',strtotime($document_detail->guarantee_date))?>" />
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-2">
                                    Back Guarantee Date
                                </div>
                                <div class="col-md-2" style="padding: 0px 10px 0px 0px">
									<input type="text" class="form-control input-sm tanggal_datetimepicker" id="back_guarantee_date" name="back_guarantee_date" autocomplete="off" value="<?=$document_detail->back_guarantee_date == '1970-01-01' || $document_detail->back_guarantee_date == '' ? date('d-m-Y') : date('d-m-Y',strtotime($document_detail->back_guarantee_date))?>" />
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-2">
                                    Finish Guarantee Date
                                </div>
                                <div class="col-md-2" style="padding: 0px 10px 0px 0px">
									<input type="text" class="form-control input-sm tanggal_datetimepicker" id="finish_guarantee_date" name="finish_guarantee_date" autocomplete="off" value="<?=$document_detail->finish_guarantee_date == '1970-01-01' || $document_detail->finish_guarantee_date == '' ? date('d-m-Y') : date('d-m-Y',strtotime($document_detail->finish_guarantee_date))?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br />
				<div class="line"></div>
                <br />
                <div>
					<button type="submit" class="btn green"><i class="fa fa-plus"></i> <?=lang('save')?></button> &nbsp;
                    <button type="button" class="btn red" onclick="history.go(0);"><i class="fa fa-refresh"></i> <?=lang('refresh')?></button>
				</div>
                <p>&nbsp;</p>
				</form>					
				</section>  
			</section> 
		</aside>

    </section> 
</section>