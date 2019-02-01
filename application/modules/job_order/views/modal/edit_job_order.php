<section id="content">
	<section class="hbox stretch">		
		<aside>
			<section class="vbox">
				<header class="header bg-white b-b b-light">
					<p><?=lang('edit_job_order')?></p>
				</header>
				<section class="scrollable wrapper">
				<?php
					$attributes = array('class' => 'bs-example form-horizontal');
					echo form_open(base_url().'job_order/view/update',$attributes);
					if (!empty($job_orders)) {
						foreach ($job_orders as $job_order) {
				?>

						<div class="row"> 
							<div class="col-xs-6">
								<div class="group">	
								
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('job_order_no')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="hidden"  name="year" value="<?=$job_order['year']?>" class="input-sm form-control">
											<input type="hidden"  name="month" value="<?=$job_order['month']?>" class="input-sm form-control">
											<input type="hidden"  name="code" value="<?=$job_order['code']?>" class="input-sm form-control">
											<input type="text"  name="job_order_no"  class="input-sm form-control" value="<?=$job_order['jo_no']?>" readonly="true">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('job_order_date')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="job_order_date"  class="input-sm form-control" value="<?=$job_order['jo_date']?>" readonly="true">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('job_order_debtor')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
										<input type="text"  name="job_order_debtor"  class="input-sm form-control" value="<?=$job_order['debtor_code']?>&nbsp;-&nbsp;<?=$job_order['debtor_name']?>" readonly="true">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('job_order_wo_code')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="job_order_wo_code"  class="input-sm form-control" value="<?=$job_order['wo_no']?>" readonly="true">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('job_order_wo_no_ref')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="job_order_wo_no_ref"  class="input-sm form-control" value="<?=$job_order['ref_no']?>" readonly="true">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('job_order_wo_vessel_no')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="job_order_wo_vessel_no"  class="input-sm form-control" value="<?=$job_order['vessel_no']?>" readonly="true">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('job_order_wo_vessel_name')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="job_order_wo_vessel_name"  class="input-sm form-control" value="<?=$job_order['vessel_name']?>" readonly="true">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('job_order_port_name')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="job_order_port_name"  class="input-sm form-control" value="<?=$job_order['port_code']?>&nbsp;-&nbsp;<?=$job_order['debtor_name']?>" readonly="true">
										</div>
									</div>
									
								</div>							
							</div>
								
								<div class="col-xs-6 text-left">
									<div class="group">
									
									<div>
										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('job_order_from')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<select name="job_order_from" class="form-control" required>
											<option value ="0">Select</option>
												   <?php
													  if (!empty($destination_froms)) {
													  foreach ($destination_froms as $destination_from) { ?>
													  <option value="<?php echo $destination_from->rowID; ?>"  <?php if ($job_order['destination_from_rowID'] == $destination_from->rowID){echo"selected";}?>><?php echo $destination_from->from_cd; ?>&nbsp;-&nbsp;<?php echo $destination_from->decs; ?></option>
													<?php }}?>
											</select>
										</div>
										</div>
									</div>
									
									<div>
										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('job_order_to')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<select name="job_order_to" class="form-control" required>
											<option value ="0">Select</option>
												   <?php
													  if (!empty($destination_tos)) {
													  foreach ($destination_tos as $destination_to) { ?>
													  <option value="<?php echo $destination_to->rowID; ?>"  <?php if ($job_order['destination_to_rowID'] == $destination_to->rowID){echo"selected";}?>><?php echo $destination_to->to_cd; ?>&nbsp;-&nbsp;<?php echo $destination_to->descs; ?></option>
													<?php }}?>
											</select>
										</div>
										</div>
									</div>
																		
									<div>
										<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('job_order_item')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<select name="job_order_item" class="form-control" required>
											<option value ="0">Select</option>
												   <?php
													  if (!empty($items)) {
													  foreach ($items as $item) { ?>
													  <option value="<?php echo $item->rowID; ?>"  <?php if ($job_order['item_rowID'] == $item->rowID){echo"selected";}?>><?php echo $item->item_cd; ?>&nbsp;-&nbsp;<?php echo $item->descs; ?></option>
													<?php }}?>
											</select>
										</div>
										</div>
									</div>
									
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('job_order_wholesale')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<select id="job_order_wholesale" class="form-control" name="job_order_wholesale" >	
												<option value="0" >Select</option>
												<option value="Y" <?php if ($job_order['wholesale'] == "Y"){echo"selected";}?>>Yes</option>
												<option value="N" <?php if ($job_order['wholesale'] == "N"){echo"selected";}?>>No</option>
											</select> 										
										</div>
									</div>

									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('job_order_price_amount')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="job_order_price_amount"   value="<?=$job_order['price_amount']?>"  class="input-sm form-control">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('job_order_weight')?></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="job_order_weight"   value="<?=$job_order['weight']?>"  class="input-sm form-control">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('job_order_desc')?><span class="text-danger">*</span></div>
										<div class="col-md-1">:</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="job_order_desc"   value="<?=$job_order['descs']?>"  class="input-sm form-control">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4">
											<b><?=lang('job_order_container_size')?></b>
										</div>
										<div class="col-md-1">
										</div>
										<div class="col-md-6">
											<b><?=lang('job_order_container_price')?></b>
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4">
											<b><?=lang('job_order_container_size_20ft')?></b>
										</div>
										<div class="col-md-1">
											:
										</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="job_order_container_size_20ft"   value="<?=$job_order['price_20ft']?>"  class="input-sm form-control">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4">
											<b><?=lang('job_order_container_size_40ft')?></b>
										</div>
										<div class="col-md-1">
											:
										</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="job_order_container_size_40ft"   value="<?=$job_order['price_40ft']?>"  class="input-sm form-control">
										</div>
									</div>
									
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4">
											<b><?=lang('job_order_container_size_45ft')?></b>
										</div>
										<div class="col-md-1">
											:
										</div>
										<div class="col-md-6"><p class="h3">
											<input type="text"  name="job_order_container_size_45ft"   value="<?=$job_order['price_45ftde']?>"  class="input-sm form-control" >
										</div>
									</div>
									
								</div>
							</div>
						</div>
						
					<div class="line"></div>
					<div>
						<button type="submit" class="btn btn-sm btn-success" value="Save"><i class="fa fa-plus"></i> <?=lang('debtor_save')?></button>
					</div>
					</form>
				<?php }} ?>
				
					
				</section>  
			</section> 
		</aside>
	</section> 
</section>



<!-- end -->
