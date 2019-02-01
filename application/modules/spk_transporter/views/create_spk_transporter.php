<section id="content">
	<section class="hbox stretch">		
		<aside>
			<section class="vbox">
				<header class="header bg-white b-b b-light">
                    <div class="pull-right" style="margin-top: 10px;">
                      <button type="button" class="btn btn-sm btn-dark btn_cleartable" onclick="location.replace('<?php echo base_url('spk_transporter')?>');//history.back();"><i class="fa fa-arrow-left"></i> <?=lang('back')?></button>
                    </div>
					<p class="pull-left"><strong><?=lang('new_spk_transporter')?></strong>
				</header>
				<section class="scrollable wrapper">
				<?php
					$attributes = array('class' => 'bs-example form-horizontal', 'autocomplete' => 'off');
					echo form_open(base_url().'spk_transporter/create_spk_transporter',$attributes); 
				?>
    				<div class="row"> 
                        <?php echo validation_errors(); ?>
    					<div class="col-xs-6">
    						<div class="group">	
    							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
    								<div class="col-md-4"><?=lang('spk_date')?> <span class="text-danger">*</span></div>
    								<div class="col-md-1">:</div>
    								<div class="col-md-6">										
    									<input type="text" class="form-control input-sm" id="spk_date" name="spk_date" value="<?=date('d-m-Y')?>" required readonly>
    								</div>
    							</div>				
                                <div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
    								<div class="col-md-4"><?=lang('creditor_name')?> <span class="text-danger">*</span></div>
    								<div class="col-md-1">:</div>
    								<div class="col-md-6">								
    									<select class="form-control input-sm all_select2" id="creditor_rowID" name="creditor_rowID"  required>
    									   <option value =""><?=lang('select')?><?=lang('creditor_name')?></option>
    									<?php
    										if (!empty($creditors)) {
    											foreach ($creditors as $creditor) { ?>
    											<option value="<?php echo $creditor->rowID; ?>"><?php echo $creditor->creditor_name;?></option>
    									<?php }}?>
    									</select>
    								</div>
    							</div>		
    							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
    								<div class="col-md-4"><?=lang('jo_type')?> <span class="text-danger">*</span></div>
    								<div class="col-md-1">:</div>
    								<div class="col-md-6">
    									<select class="form-control input-sm" id="jo_type" name="jo_type" required>	
        									<option value="">Select Job Order Type</option>
        									<option value="1">BULK</option>
        									<option value="2">CONTAINER</option>
        									<option value="3">OTHERS</option>
    									</select> 
    								</div>
    							</div>	
    							<div class="row inline-fields form-group form-md-line-input" style="padding-bottom: 10px;">
    								<div class="col-md-4"><?=lang('job_order_emkl_no')?> <span class="text-danger">*</span></div>
    								<div class="col-md-1">:</div>
    								<div class="col-md-6">										
    									<input type="text" class="form-control input-sm" id="jo_no" name="jo_no" value="" required readonly>
    								</div>
                                    <div class="col-md-1" style="padding-left: 0px;"><button type="button" class="btn btn-sm btn-info" onclick="search_jo_emkl()"><i class="fa fa-search"></i></button></div>
    							</div>	
    						</div>	
    					</div>		
    					<div class="col-xs-6"></div>
    				</div>					
    				<p>&nbsp;</p>
                    <table id="tbl-data-detail-jo-emkl" class="table table-responsive table-striped" width="100%"></table>
    				<p>&nbsp;</p>
                    <div>
    					<button type="submit" class="btn green"><i class="fa fa-plus"></i> <?=lang('save')?></button> &nbsp;
                        <button type="button" class="btn red" onclick="history.go(0);"><i class="fa fa-refresh"></i> <?=lang('refresh')?></button>
    				</div>
                    <p>&nbsp;</p>
				    <?=form_close()?>					
				</section>  
			</section> 
		
            <div class="modal fade" id="modal_search_jo_emkl" role="dialog">
              <div class="modal-dialog" style="width:90%;">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title-search-jo-emkl">Select Job Order EMKL</h3>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="input-group input-daterange">
                                                    <input type="text" name="start_date" id="start_date" class="form-control input-sm tanggal_datetimepicker" placeholder="<?=lang('start_date')?>" value="<?=date('d-m-Y')?>">
                                                    <span class="input-group-addon">to</span>
                                                    <input type="text" name="end_date" id="end_date" class="form-control input-sm tanggal_datetimepicker" placeholder="<?=lang('end_date')?>" value="<?=date('d-m-Y')?>">
                                                </div>
                                            </div>
                                            <div class="col-md-1" style="padding-left: 0px;">
                                                <button type="button" class="btn btn-sm btn-info" onclick="searchJOEMKL()"><i class="fa fa-search"></i> Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                      <table id="tbl-search-data-jo-emkl" class="table table-responsive table-striped" width="100%"></table>
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
        </aside>
        
    </section> 
</section>
