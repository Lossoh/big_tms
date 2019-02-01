<section id="content">
	<section class="hbox stretch">		
		<aside>
			<section class="vbox">
				<header class="header bg-white b-b b-light">
                    <div class="pull-right" style="margin-top: 10px;">
                      <button type="button" class="btn btn-sm btn-dark btn_cleartable" onclick="history.back();"><i class="fa fa-arrow-left"></i> <?=lang('back')?></button>
                    </div>
					<p class="pull-left"><strong><?=lang('copy_option')?> <?=lang('job_order')?></strong></p>
				</header>
			
				<section class="scrollable wrapper">
				<?php
					$attributes = array('class' => 'bs-example form-horizontal', 'autocomplete' => 'off');
					echo form_open(base_url().'job_order/copy_job_order',$attributes); 
					if (!empty($job_orders)) {
						foreach ($job_orders as $job_order) {
					
				?>
				<div class="row"> 
					<div class="col-xs-6">
						<div class="group">	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('job_order_date')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p class="h3">										
									<input type="text" class="datepicker-input form-control" id="job_order_date" name="job_order_date" value="<?=date('d-m-Y')?>"  data-date-format="dd-mm-yyyy" required readonly>
								</p></div>
							</div>						
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('job_order_type')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p class="h3">
									
									<select class="form-control" id="job_order_type" name="job_order_type" required>
    									<option value="1" <?= $job_order['jo_type'] == '1' ? 'selected' : '' ?>>BULK</option>
    									<option value="2" <?= $job_order['jo_type'] == '2' ? 'selected' : '' ?>>CONTAINER</option>
    									<option value="3" <?= $job_order['jo_type'] == '3' ? 'selected' : '' ?>>OTHERS</option>
									</select> 
								</p></div>
							</div>	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('debtor')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p class="h3">								
									<select  class="form-control" id="debtor" name="debtor"  required>
									<?php
										if (!empty($debtors)) {
											foreach ($debtors as $debtor) { ?>
											<option value="<?php echo $debtor->rowID; ?>" <?= $job_order['debtor_rowID'] == $debtor->rowID ? 'selected' : '' ?>>
                                                <?php echo $debtor->debtor_cd;?> - <?php echo $debtor->debtor_name;?>
                                            </option>
									<?php }}?>
									</select>
									<textarea class="form-control"  id="debtor_dtl" name="debtor_dtl" maxlength="60" rows="2" readonly><?=$job_order['debtor_name']?></textarea>
								</p></div>
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('job_order_po_spk_no')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p class="h3">
									<input  type="text" class="form-control" id="po_spk_no" name="po_spk_no" maxlength="30" value="<?=$job_order['po_spk_no']?>" autocomplete="off" required>
								</p></div>
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('job_order_so_no')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p class="h3">
									<input  type="text" class="form-control" id="so_no" name="so_no" maxlength="30" value="<?=$job_order['so_no']?>" autocomplete="off">
								</p></div>
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('port')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p class="h3">								
									<select  class="form-control" id="port" name="port"  required>
									<?php
										if (!empty($ports)) {
											foreach ($ports as $port) { ?>
											<option value="<?php echo $port->rowID;?>" <?= $job_order['port_rowID'] == $port->rowID ? 'selected' : '' ?>>
                                                <?php echo $port->port_cd;?> - <?php echo $port->port_name;?>
                                            </option>
									<?php }}?>
									</select>									
								</p></div>
							</div>							
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('vessel_no')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p class="h3">
									<input  type="text" class="form-control" id="vessel_no" name="vessel_no" maxlength="15" value="<?=$job_order['vessel_no']?>" autocomplete="off">
								</p></div>
							</div>								
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('vessel_name')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p class="h3">
									<input  type="text" class="form-control" id="vessel_name" name="vessel_name" maxlength="40" value="<?=$job_order['vessel_name']?>" autocomplete="off">
								</p></div>
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('item')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p class="h3">
									<select  class="form-control" id="item" name="item"  required>
									<?php
										if (!empty($items)) {
											foreach ($items as $item) { ?>
											<option value="<?php echo $item->rowID;?>" <?= $job_order['item_rowID'] == $item->rowID ? 'selected' : '' ?>>
                                                <?php echo $item->item_cd;?> - <?php echo $item->item_name;?>
                                            </option>
									<?php }}?>
									</select>									
								</p></div>
							</div>							
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('weight')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-5"><p class="h3">
									<input  type="text" class="form-control" id="weight_item" name="weight_item" maxlength="9" value="<?=$job_order['weight']?>" style="text-align: right;" onkeyup="angka(this)" value="0" autocomplete="off" required>
								</p></div>
								<div class="col-md-1"><p class="h3">Kgs</p></div>								
							</div>						
						</div>	
					</div>		
					<div class="col-xs-6">
						<div class="group">
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('fare_trip')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p class="h3">								
									<select  class="form-control" id="fare_trip" name="fare_trip"  required>
									<?php
										if (!empty($fare_trips)) {
											foreach ($fare_trips as $fare_trip) { ?>
											<option value="<?php echo $fare_trip->rowID;?>" <?= $job_order['fare_trip_rowID'] == $fare_trip->rowID ? 'selected' : '' ?>>
                                                <?php echo $fare_trip->fare_trip_cd;?>
                                            </option>
									<?php }}?>
									</select>
									<textarea class="form-control"  id="fare_trip_dtl" name="fare_trip_dtl" maxlength="60" rows="2" readonly><?=$job_order['destination_from_no']?> - <?=$job_order['destination_from_name']?> TO <?=$job_order['destination_to_no']?> - <?=$job_order['destination_to_name']?> Distance : <?=$job_order['distance']?> km</textarea>
								    <input type="hidden" name="destination_from_id" id="destination_from_id" value="<?=$job_order['destination_from_rowID']?>" />
								    <input type="hidden" name="destination_to_id" id="destination_to_id" value="<?=$job_order['destination_to_rowID']?>" />
                                </p></div>
							</div>							
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('job_order_wholesale')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p class="h3">
		                        	<label class="switch">								
									<input type="checkbox" class="form-control" id="job_order_wholesale_yes_no" name="job_order_wholesale_yes_no" <?php if($job_order['wholesale']){ echo "checked=\"checked\""; }?>>
									<span></span>
		                        	</label>
								</p></div>
							</div>							
 							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('price')?> <span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-5"><p class="h3">
									<input  type="text" class="form-control" id="job_order_price" name="job_order_price" onkeyup="angka(this)" maxlength="9" value="<?=$job_order['price_amount']?>" style="text-align: right;" value="0" autocomplete="off">
								</p></div>
								<div class="col-md-1"><p class="h3">Kgs</p></div>			
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('description')?></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p class="h3">
									<textarea class="form-control"  id="job_order_desc" name="job_order_desc" maxlength="50" rows="2"><?=$job_order['description']?></textarea>									
								</p></div>
							</div>
							<div class="line"></div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-12" align="center"><p class="h3"><?=lang('container')?></p></div>								
							</div>								
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-3"><p class="h3"><?=lang('size')?></p></div>
								<div class="col-md-3"><p class="h3"><?=lang('total')?></p></div>
								<div class="col-md-3"><p class="h3"><?=lang('release')?></p></div>
								<div class="col-md-3"><p class="h3"><?=lang('price')?></p></div>
							</div>									
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-3"><p class="h3"><?=lang('20ft')?></p></div>
								<div class="col-md-3"><p class="h3"><input type="text" class="form-control" id="job_order_total_20ft" name="job_order_total_20ft" onkeyup="angka(this)" value="<?=$job_order['container_20ft']?>" maxlength="9" style="text-align: right;" autocomplete="off"></p></div>
								<div class="col-md-3"><p class="h3"><input type="text" class="form-control" id="job_order_release_20ft" name="job_order_release_20ft" onkeyup="angka(this)" value="0" maxlength="9" style="text-align: right;" autocomplete="off"></p></div>
								<div class="col-md-3"><p class="h3"><input type="text" class="form-control" id="job_order_price_20ft" name="job_order_price_20ft" onkeyup="angka(this)" value="<?=$job_order['price_20ft']?>" maxlength="9" style="text-align: right;" autocomplete="off"></p></div>
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-3"><p class="h3"><?=lang('40ft')?></p></div>
								<div class="col-md-3"><p class="h3"><input type="text" class="form-control" id="job_order_total_40ft" name="job_order_total_40ft" onkeyup="angka(this)" value="<?=$job_order['container_40ft']?>" maxlength="9" style="text-align: right;" autocomplete="off"></p></div>
								<div class="col-md-3"><p class="h3"><input type="text" class="form-control" id="job_order_release_40ft" name="job_order_release_40ft" onkeyup="angka(this)" value="0" maxlength="9" style="text-align: right;" autocomplete="off"></p></div>
								<div class="col-md-3"><p class="h3"><input type="text" class="form-control" id="job_order_price_40ft" name="job_order_price_40ft" onkeyup="angka(this)" value="<?=$job_order['price_40ft']?>" maxlength="9" style="text-align: right;" autocomplete="off"></p></div>
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-3"><p class="h3"><?=lang('45ft')?></p></div>
								<div class="col-md-3"><p class="h3"><input type="text" class="form-control" id="job_order_total_45ft" name="job_order_total_45ft" onkeyup="angka(this)" value="<?=$job_order['container_45ft']?>" maxlength="9" style="text-align: right;" autocomplete="off"></p></div>
								<div class="col-md-3"><p class="h3"><input type="text" class="form-control" id="job_order_release_45ft" name="job_order_release_45ft" onkeyup="angka(this)" value="0" maxlength="9" style="text-align: right;" autocomplete="off"></p></div>
								<div class="col-md-3"><p class="h3"><input type="text" class="form-control" id="job_order_price_45ft" name="job_order_price_45ft" onkeyup="angka(this)" value="<?=$job_order['price_45ft']?>" maxlength="9" style="text-align: right;" autocomplete="off"></p></div>
							</div>				
	
									
						</div>
					</div>
				</div>					
				<div class="line"></div>
				<div>
					<button type="submit" class="btn_cleartable green  btn-sm"><i class="fa fa-plus"></i> <?=lang('save')?></button> &nbsp;
                    <button type="button" class="btn_cleartable red btn-sm " onclick="history.go(0);"><i class="fa fa-refresh"></i> <?=lang('refresh')?></button>
				</div>
                <p>&nbsp;</p>
				</form>	
				<?php }} ?>		
				</section>  
			</section> 
		</aside>
	</section> 
</section>