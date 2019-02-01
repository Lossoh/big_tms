<section id="content">
	<section class="hbox stretch">		
		<aside>
			<section class="vbox">

				<header class="header bg-white b-b b-light">
					<p><strong><?=lang('new')?>  <?=lang('realization_detail')?></strong></p>
				</header>
				<section class="scrollable wrapper">
				<?php			
                    if (!empty($realization_details)) {
                    foreach ($realization_details as $realization_detail) { 
				?>
				<div class="row"> 
					<div class="col-xs-6">
						<div class="group">	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('cash')?>/<?=lang('site')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">									
									<input  type="text" class="form-control" id="settlement_no" name="settlement_no" value="<?=$realization_detail['alloc_no']?>" readonly style="font-size:22px;font-weight:900;color: black;">
								</div>
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('realization_no')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6">
									<input  type="hidden" class="form-control" id="prefix" name="prefix"  value="<?=$realization_detail['prefix']?>">
									<input  type="hidden" class="form-control" id="year" name="year" value="<?=$realization_detail['year']?>">
									<input  type="hidden" class="form-control" id="month" name="month" value="<?=$realization_detail['month']?>">
									<input  type="hidden" class="form-control" id="code" name="code"  value="<?=$realization_detail['code']?>">
									<input  type="text" class="form-control" id="settlement_no" name="settlement_no" value="<?=$realization_detail['alloc_no']?>" readonly style="font-size:22px;font-weight:900;color: black;">
								</div>																
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('date')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p class="h3">										
									<input class="input-sm input-s datepicker-input form-control" size="10" type="text" value="<?=date('d-m-Y')?>" id="date" name="date" data-date-format="dd-mm-yyyy" required>
								</p></div>
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('cash_advance_no')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p class="h1">
									<input  type="text" class="form-control" id="cash_advance_no" name="cash_advance_no" value="<?=$realization_detail['advance_no']?>" readonly style="font-size:22px;font-weight:900;color: black;">
								</p></div>																
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('cash_advance_type')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p class="h3">
									<select  class="form-control" id="cash_advance_type" name="cash_advance_type"  required disabled>
									<option value ="<?=$realization_detail['advance_type_rowID']?>"><?=$realization_detail['advance_name']?></option>									
									</select>
								</p></div>
							</div>	
						</div>	
					</div>
					<div class="col-xs-6">
						<div class="group">
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('cash_advance')?> <?=lang('amount')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p class="h1">
									<input  type="text" class="form-control" id="cash_advance_amt" name="cash_advance_amt" maxlength="9" style="font-size:22px;font-weight:900;color: black;text-align: right;" value="<?=$realization_detail['advance_amount']?>" readonly>
								</p></div>																
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('cash_advance')?> <?=lang('allocation')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p class="h1">
									<input  type="text" class="form-control" id="cash_advance_alloc" name="cash_advance_alloc" maxlength="9" style="font-size:22px;font-weight:900;color: black;text-align: right;" value="<?=$realization_detail['advance_allocation']?>" readonly>
								</p></div>																
							</div>
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('cash_advance')?> <?=lang('balance')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p class="h1">
									<input  type="text" class="form-control" id="cash_advance_amt" name="cash_advance_amt" maxlength="9" style="font-size:22px;font-weight:900;color: black;text-align: right;" value="<?=$realization_detail['advance_balance']?>" readonly>
								</p></div>																
							</div>							
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('fare_trip')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p class="h3">
									<textarea class="form-control"  maxlength="60" rows="2"  readonly><?=$realization_detail['fare_trip_no']?> (<?=$realization_detail['destination_from_name']?> KE <?=$realization_detail['destination_to_name']?>)</textarea>
								</p></div>
							</div>	
							<div class="row inline-fields form-group form-md-line-input">
								<div class="col-md-4"><?=lang('employee')?>/<?=lang('driver')?><span class="text-danger">*</span></div>
								<div class="col-md-1">:</div>
								<div class="col-md-6"><p class="h3">								
									<select  class="form-control" id="driver" name="driver"  disabled>
									<option value ="<?=$realization_detail['employee_driver_rowID']?>"><?=$realization_detail['debtor_name']?>/<?=$realization_detail['debtor_type']?>/<?=$cash_advance_detail['id_no']?></option>
									</select>									
								</p></div>
							</div>								
					
						</div>
					</div>					
				</div>	
				<?php }}?>
				<div class="line"></div><br>
				<button class="btn btn-success" id="button" name="button"><i class="glyphicon glyphicon-plus"></i> Add Cost</button>
				<div class="table-responsive">
					  <table id="tbl-cost" class="table table-striped table-bordered" cellspacing="0" width="100%">
					  <thead>
						<tr>
						  <th>Cost Code</th>
						  <th>Cost Name</th>
						  <th>Amount</th>						  
						</tr>
					  </thead>
					  <tbody>
					  </tbody>

					  <tfoot>
						<tr>
						  <th>Cost Code</th>
						  <th>Cost Name</th>
						  <th>Amount</th>
						</tr>
					  </tfoot>
					</table>	
				</div>
				<div class="line"></div><br>
				<button class="btn btn-success" onclick="add_personx()"><i class="glyphicon glyphicon-plus"></i> Add Job Order</button>
				<div class="table-responsive">
					  <table id="tbl-jo" class="table table-striped table-bordered" cellspacing="0" width="100%">
					  <thead>
						<tr>
						  <th>JO No</th>
						  <th>DR</th>
						  <th>DR Date</th>
						  <th>DR Netto</th>
						  <th>Date of Birth</th>
						  
						</tr>
					  </thead>
					  <tbody>
					  </tbody>

					  <tfoot>
						<tr>
						  <th>First Name</th>
						  <th>Last Name</th>
						  <th>Gender</th>
						  <th>Address</th>
						  <th>Date of Birth</th>

						</tr>
					  </tfoot>
					</table>	
				</div>	

				<legend>Passenger Details</legend>
				<p> 
					<input type="button" value="Add Passenger" onClick="addRow('tbl-orders')" /> 
					<input type="button" value="Remove Passenger" onClick="deleteRow('tbl-orders')"  /> 
					<p>(All acions apply only to entries with check marked check boxes only.)</p>
				</p>
               <table id="tbl-orders" class="table table-striped table-bordered" cellspacing="0" width="100%">
			   	<thead>
						<tr>
						  <th>JO No</th>
						  <th>DR</th>
						  <th>DR Date</th>
						  <th>DR Netto</th>
						  <th>Date of Birth</th>						  
						</tr>
					  </thead>
                  <tbody>
                    <tr>
                      <p>
						<td><input type="checkbox" required="required" name="chk[]" checked="checked" /></td>
						<td>
							<label>Name</label>
							<input type="text" required="required" name="BX_NAME[]">
						 </td>
						 <td>
							<label for="BX_age">Age</label>
							<input type="text" required="required" class="small"  name="BX_age[]">
					     </td>
						 <td>
							<label for="BX_gender">Gender</label>
							<select id="BX_gender" name="BX_gender" required="required">
								<option>....</option>
								<option>Male</option>
								<option>Female</option>
							</select>
						 </td>
						 <td>
							<label for="BX_birth">Berth Pre</label>
							<select id="BX_birth" name="BX_birth" required="required">
								<option>....</option>
								<option>Window</option>
								<option>No Choice</option>
							</select>
						 </td>
							</p>
                    </tr>
                    </tbody>
                </table>				
				</section>  
			</section> 
		</aside>
	</section> 
</section>