<section id="content">
	<section class="hbox stretch">		
		<aside>
			<section class="vbox">

				<header class="header bg-white b-b b-light">
					<p class="h4"><?=lang('new')?>  <?=lang('refund')?></p>
				</header>
				<section class="scrollable wrapper">
				<?php
								
					$attributes = array('class' => 'bs-example form-horizontal', 'onsubmit'=>'return refund_onsubmit()');
					echo form_open(base_url().'finances/create_refund_hdr',$attributes); 			
                     
				?>
				<div class="row"> 
					<div class="col-xs-4">
						<legend><?=lang('refund')?></legend>
						<div class="group">	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-3"><?=lang('date')?><span class="text-danger">*</span></div>
								<div class="col-md-7"><p>										
									<input class="input-sm input-s datepicker-input form-control" size="10" type="text" value="<?=date('d-m-Y')?>" id="date" name="date" data-date-format="dd-mm-yyyy" required>
								</p></div>
							</div>	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-3"><?=lang('employee')?>/<?=lang('driver')?><span class="text-danger">*</span></div>
								<div class="col-md-10"><p>								
									<select  class="form-control" id="driver_refund" name="driver_refund"  required>
									<option value ="0"><?=lang('select')?><?=lang('employee')?>/<?=lang('driver')?></option>
									<?php
										if (!empty($drivers)) {
											foreach ($drivers as $driver) { ?>
											<option value="<?php echo $driver->rowID;?>"><?php echo $driver->debtor_cd;?>(<?php echo $driver->debtor_name;?>-<?php echo ($driver->type == 'E') ? 'EMPLOYEE' : 'DRIVER';?>)</option>
									<?php }}?>
									</select>							
								</p></div>
							</div>	
								<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('paid')?>  <?=lang('amount')?><span class="text-danger">*</span></div>
								<div class="col-md-9"><p>
									<input  type="text" class="paid_amount form-control" id="paid_amount" name="paid_amount" maxlength="9" style="font-size:22px;font-weight:900;color: black;text-align: right;" value="0" autocomplete="off" onblur="calculation_refund_ca()" required>
								</p></div>
																
							</div>	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-3"><?=lang('description')?></div>
								<div class="col-md-10"><p class="h3">
									<textarea class="form-control"  id="refund_desc" name="refund_desc" maxlength="255" rows="5"></textarea>									
								</p></div>
							</div>			
							
						</div>
					</div>
					<div class="col-xs-8">
						<legend>Cash Advance Details</legend>
						<div id="ca_lists"></div> 
					</div>

				</div>	
					
			


				<div class="line"></div>				
				<div>
					<button type="submit" class="btn_cleartable green  btn-sm" tabindex=-1><i class="fa fa-plus"></i>   <?=lang('save')?></button><button type="button" class="btn_cleartable red btn-sm pull-right" onclick="history.go(0);"><i class="fa fa-refresh"></i>   <?=lang('refresh')?></button><button type="button" class="btn_cleartable  yellow btn-sm pull-right" onclick="history.back();"><i class="fa fa-undo"></i>   <?=lang('back')?></button>
				</div>
				</form>					
				</section>  
			</section> 
		</aside>
	</section> 
</section>