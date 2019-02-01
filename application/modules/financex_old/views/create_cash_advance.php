<section id="content">
	<section class="hbox stretch">		
		<aside>
			<section class="vbox">

				<header class="header bg-white b-b b-light">
					<p><strong><?=lang('new')?>  <?=lang('cash_advance')?></strong></p>
				</header>
				<section class="scrollable wrapper">
				<?php
					$attributes = array('class' => 'bs-example form-horizontal', 'onsubmit'=>'return cash_advance_onsubmit()');
					echo form_open(base_url().'finances/create_cash_advance',$attributes); 
				?>
				<div class="row"> 
					<div class="col-xs-12">
						<div class="group">	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('date')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p class="h3">										
									<input type="text" class="datepicker-input form-control" id="job_order_date" name="job_order_date" value="<?=date('d-m-Y')?>"  data-date-format="dd-mm-yyyy" required readonly>
								</p></div>
							</div>						
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('cash_advance_type')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p class="h3">
									<select  class="form-control" id="cash_advance_type" name="cash_advance_type"  required>
									<option value ="0"><?=lang('select')?><?=lang('cash_advance_type')?></option>
									<?php
										if (!empty($cash_advance_types)) {
											foreach ($cash_advance_types as $cash_advance_type) { ?>
											<option value="<?php echo $cash_advance_type->rowID; ?><?php echo $cash_advance_type->fare_trip; ?>"><?php echo $cash_advance_type->advance_cd;?> - <?php echo $cash_advance_type->advance_name;?></option>
									<?php }}?>
									</select>
								</p></div>
							</div>	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('fare_trip')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p class="h3">								
									<select  class="form-control" id="fare_trip" name="fare_trip"  required>
									<option value ="0"><?=lang('select')?><?=lang('fare_trip')?></option>
									<?php
										if (!empty($fare_trips)) {
											foreach ($fare_trips as $fare_trip) { ?>
											<option value="<?php echo $fare_trip->rowID;?>"><?php echo $fare_trip->fare_trip_no;?></option>
									<?php }}?>
									</select>
									<textarea class="form-control"  id="fare_trip_dtl" name="fare_trip_dtl" maxlength="60" rows="2" readonly></textarea>
								</p></div>
							</div>	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('vehicle')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p class="h3">								
									<select  class="form-control" id="vehicle" name="vehicle"  required>
									<option value ="0"><?=lang('select')?><?=lang('vehicle')?></option>
									<?php
										if (!empty($vehicles)) {
											foreach ($vehicles as $vehicle) { ?>
											<option value="<?php echo $vehicle->rowID;?>"><?php echo $vehicle->police_no;?></option>
									<?php }}?>
									</select>									
								</p></div>
							</div>								
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('vehicle_category')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p class="h3">
											
									<select  class="form-control" id="vehicle_category" name="vehicle_category"  required>
									<option value ="0"><?=lang('select')?><?=lang('vehicle_category')?></option>
									</select>									
								</p></div>
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('employee')?>/<?=lang('driver')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p class="h3">								
									<select  class="form-control" id="driver" name="driver"  required>
									<option value ="0"><?=lang('select')?><?=lang('employee')?>/<?=lang('driver')?></option>
									</select>									
								</p></div>
							</div>							
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('amount')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p class="h1">
									<input  type="text" class="form-control" id="amount" name="amount" maxlength="9" style="font-size:22px;font-weight:900;color: black;text-align: right;" value="0" autocomplete="off" required>
								</p></div>
																
							</div>	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('description')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p class="h3">
									<textarea class="form-control"  id="cash_advance_desc" name="cash_advance_desc" maxlength="255" rows="5"></textarea>									
								</p></div>
							</div>							
						</div>	
					</div>		

				</div>					
				<div class="line"></div>
				<div>
					<button type="submit" class="btn_cleartable green  btn-sm"><i class="fa fa-plus"></i>   <?=lang('save')?></button><button type="button" class="btn_cleartable red btn-sm pull-right" onclick="history.go(0);"><i class="fa fa-refresh"></i>   <?=lang('refresh')?></button><button type="button" class="btn_cleartable  yellow btn-sm pull-right" onclick="history.back();"><i class="fa fa-undo"></i>   <?=lang('back')?></button>
				</div>
				</form>					
				</section>  
			</section> 
		</aside>
	</section> 
</section>