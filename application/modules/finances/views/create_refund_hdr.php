<section id="content">
	<section class="hbox stretch">		
		<aside>
			<section class="vbox">
				<header class="header bg-white b-b b-light">
                    <div class="pull-right" style="margin-top: 10px;">
                      <button type="button" class="btn btn-sm btn-dark btn_cleartable" onclick="history.back();"><i class="fa fa-arrow-left"></i> <?=lang('back')?></button>
                    </div>
					<p class="pull-left"><strong><?=lang('new')?> <?=lang('refund')?></strong></p>
				</header>
				<section class="scrollable wrapper">
				<?php
								
					$attributes = array('class' => 'bs-example form-horizontal',  'autocomplete' => 'off', 'onsubmit'=>'return refund_onsubmit()');
					echo form_open(base_url().'finances/create_refund_hdr',$attributes); 			
                     
				?>
				<div class="row" style="overflow: scroll;"> 
					<div class="col-xs-4">
						<legend><?=lang('refund')?></legend>
						<div class="group">	
							<div class="row form-group form-md-line-input">
								<div class="col-md-4"><?=lang('date')?><span class="text-danger">*</span></div>
								<div class="col-md-5"><p>										
									<input class="input-sm input-s form-control" size="10" type="text" value="<?=date('d-m-Y')?>" id="date" name="date" readonly="" required="" />
								</p></div>
							</div>	
							<div class="row form-group form-md-line-input">
								<div class="col-md-4"><?=lang('employee')?>/<?=lang('driver')?><span class="text-danger">*</span></div>
								<div class="col-md-8"><p>								
									<select  class="form-control" id="driver_refund" name="driver_refund" required>
									<option value =""><?=lang('select')?><?=lang('employee')?>/<?=lang('driver')?></option>
									<?php
										if (!empty($drivers)) {
											foreach ($drivers as $driver) { ?>
											<option value="<?php echo $driver->rowID;?>"><?php echo $driver->type.$driver->debtor_cd;?> - <?php echo $driver->debtor_name;?> (<?php if($driver->type == 'E') echo 'EMPLOYEE'; else if($driver->type == 'D') echo 'DRIVER'; else echo 'MECHANIC'; ?>)</option>
									<?php }}?>
									</select>							
								</p></div>
							</div>	
							<div class="row form-group form-md-line-input">
								<div class="col-md-4"><?=lang('paid')?>  <?=lang('amount')?><span class="text-danger">*</span></div>
								<div class="col-md-8"><p>
									<input  type="text" class="paid_amount form-control currency" id="paid_amount" name="paid_amount" maxlength="11" style="font-size:22px;font-weight:900;color: black;text-align: right;" value="0" autocomplete="off" onblur="calculation_refund_ca()" readonly="" required>
								</p></div>
																
							</div>	
							<div class="row form-group form-md-line-input">
								<div class="col-md-4"><?=lang('description')?></div>
								<div class="col-md-8">
								   <textarea class="form-control" id="refund_desc" name="refund_desc" maxlength="255" rows="2" readonly="" onkeyup="replaceQuotes(this)"></textarea>
                                </div>
							</div>			
							
						</div>
					</div>
					<div class="col-xs-8">
                        <legend>Cash Advance Details</legend>
						<div id="ca_lists"><?=lang('choose_driver')?></div> 
					</div>

				</div>	
					
				<div class="line"></div>				
				<div>
					<button type="submit" class="btn btn-sm green" tabindex=-1><i class="fa fa-plus"></i> <?=lang('save')?></button> &nbsp;
                    <button type="button" class="btn btn-sm red" onclick="history.go(0);"><i class="fa fa-refresh"></i> <?=lang('refresh')?></button>
				</div>
				</form>					
				</section>  
			</section> 
		</aside>
	</section> 
</section>