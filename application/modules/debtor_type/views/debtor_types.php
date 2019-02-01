<section id="content">
  <section class="hbox stretch">
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">
              <a  class="btn btn-sm green" onclick="add_debtor_type()"><i class="fa fa-plus"></i> <?=lang('new_debtor_type')?></a>
              <a  class="btn btn-sm red" onclick="debtor_type_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
              <a  class="btn btn-sm btn-success" onclick="debtor_type_excel()"><i class="fa fa-file-excel-o"></i> Print Excel</a>
            </div>
            <p class="pull-left"><?=lang('debtor_type_details')?></p>
            <div class="clearfix"></div>
        </header>
        <div class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive"><?php echo validation_errors(); ?>
                  <table id="tbl-projects" class="table table-striped">
                    <thead>
                      <tr>
                        <th><?=lang('options')?></th>
                        <th><?=lang('debtortype_type_cd')?></th>
                        <th><?=lang('debtortype_name')?> </th>
                        <th><?=lang('debtortype_category')?> </th>
						<th><?=lang('debtortype_receivable_acc')?> </th>
						<th><?=lang('debtortype_advance_acc')?> </th>
						<th><?=lang('debtortype_deposit_acc')?> </th>
						<th><?=lang('debtortype_rounding_acc')?> </th>
						<th><?=lang('debtortype_adm_acc')?> </th>
                        <th><?=lang('debtortype_pay_acc')?> </th>
                        <th><?=lang('debtortype_commission_acc')?> </th>
                      </tr> 
                      </thead>
                      <tbody>
                      <?php
                      if (!empty($debtor_types)) {
                      foreach ($debtor_types as $debtor_type) { 
                        
                        $category = '-';
                        if($debtor_type->category == 'C'){
                            $category = 'Customer';
                        }
                        else if($debtor_type->category == 'D'){
                            $category = 'Driver';
                        }
                        else if($debtor_type->category == 'E'){
                            $category = 'Employee';
                        }
                        else if($debtor_type->category == 'M'){
                            $category = 'Mechanic';
                        }
                      ?>
                      <tr>
                            <td>
							  <div class="btn-group">
								<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
								 <?=lang('options')?>
								<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a  href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_debtor_type(<?=$debtor_type->rowID ?>)"><i class="fa fa-pencil"></i> <?=lang('update_option')?></a></li>
                                    <li><a  href="javascript:void()" title="<?=lang('delete_option')?>" onclick="delete_debtor_type(<?=$debtor_type->rowID ?>)"><i class="fa fa-trash-o"></i> <?=lang('delete_option')?></a></li>
								</ul>
                                
							  </div>
							</td>
                        <td><?=$debtor_type->type_cd?></a></td>
						<td><?=$debtor_type->name?></td>
                        <td><?=strtoupper($category)?></td>
						<td><?=$debtor_type->receivable_acc?></td>
						<td><?=$debtor_type->advance_acc?></td>
						<td><?=$debtor_type->deposit_acc?></td>
						<td><?=$debtor_type->rounding_acc?></td>
						<td><?=$debtor_type->adm_acc?></td>
                        <td><?=$debtor_type->payable_acc?></td>
                        <td><?=$debtor_type->commission_acc?></td>
                        
                    </tr>
                    <?php } } ?>
                        
                        
                   </tbody>
                  </table>
    
                 </div>
               </section>
            </div>            
          </div>
        </div>
      </section>

    </section>
 
  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog" style="width:600px;height:200px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?=lang('new_debtor_type')?></h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>
        <input type="hidden" name="rowID" value="">
        	
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('debtortype_type_cd')?> <span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" class="form-control" value="" name="debtortype_type_cd"  required>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('debtortype_name')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" class="form-control" value="" name="debtortype_name" placeholder="<?=lang('debtortype_name')?>" required>
            </div>
        </div>
        
  		<div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('debtortype_category')?><span class="text-danger">*</span></label>
            <div class="col-md-8">
			<select name="category" class="form-control" id="category" required>
                <option value="" selected><?=lang('select_your_option')?></option>
				<option value="C">Customer</option>
				<option value="D">Driver</option>
                <option value="E">Employee</option>
                <option value="M">Mechanic</option>
			</select>
            </div>
		</div>
        
  		<div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('debtortype_receivable_acc')?><span class="text-danger">*</span></label>
            <div class="col-md-8">
			<select name="debtortype_receivable_acc" id="debtortype_receivable_acc" class="form-control" required>
            <option value="" selected><?=lang('select_your_option')?></option>
				   <?php
                      if (!empty($coas)) {
                      foreach ($coas as $coa) { ?>
					  <option value="<?php echo $coa->rowID; ?>"><?php echo $coa->acc_cd; ?>-<?php echo $coa->acc_name; ?></option>
					  
			<?php }}?>
			</select>
            </div>
		</div>
        
		<div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('debtortype_advance_acc')?><span class="text-danger">*</span></label>
            <div class="col-md-8">
			<select name="debtortype_advance_acc" id="debtortype_advance_acc" class="form-control" required>
            <option value="" selected><?=lang('select_your_option')?></option>
				   <?php
                      if (!empty($coas)) {
                      foreach ($coas as $coa) { ?>
					  <option value="<?php echo $coa->rowID; ?>"><?php echo $coa->acc_cd; ?>-<?php echo $coa->acc_name; ?></option>
					  
			<?php }}?>
			<select>
            </div>
		</div>
        
		<div class="form-group form-md-line-input">
			
            <label class="col-lg-4 control-label"><?=lang('debtortype_deposit_acc')?><span class="text-danger">*</span></label>
            <div class="col-md-8">
			<select name="debtortype_deposit_acc" id="debtortype_deposit_acc"  class="form-control" required>
            <option value="" selected><?=lang('select_your_option')?></option>
				   <?php
                      if (!empty($coas)) {
                      foreach ($coas as $coa) { ?>
					  <option value="<?php echo $coa->rowID; ?>"><?php echo $coa->acc_cd; ?>-<?php echo $coa->acc_name; ?></option>
					  
			<?php }}?>
			</select>
            </div>

		</div>
        
		<div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('debtortype_rounding_acc')?><span class="text-danger">*</span></label>
              <div class="col-md-8">
				<select name="debtortype_rounding_acc" id="debtortype_rounding_acc" class="form-control" required>
				<option value="" selected><?=lang('select_your_option')?></option>
				   <?php
                      if (!empty($coas)) {
                      foreach ($coas as $coa) { ?>
					  <option value="<?php echo $coa->rowID; ?>"><?php echo $coa->acc_cd; ?>-<?php echo $coa->acc_name; ?></option>
					  
					<?php }}?>
				</select>
                </div>
		</div>
        
		<div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('debtortype_adm_acc')?><span class="text-danger">*</span></label>
            <div class="col-md-8">
			<select name="debtortype_adm_acc" id="debtortype_adm_acc" class="form-control" required>
			<option value="" selected><?=lang('select_your_option')?></option>
				   <?php
                      if (!empty($coas)) {
                      foreach ($coas as $coa) { ?>
					  <option value="<?php echo $coa->rowID; ?>"><?php echo $coa->acc_cd; ?>-<?php echo $coa->acc_name; ?></option>
					  
					<?php }}?>
			</select>
            </div>
		</div>
		<div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('debtortype_pay_acc')?><span class="text-danger">*</span></label>
            <div class="col-md-8">
			<select name="debtortype_pay_acc" id="debtortype_pay_acc" class="form-control" required>
			<option value="" selected><?=lang('select_your_option')?></option>
				   <?php
                      if (!empty($coas)) {
                      foreach ($coas as $coa) { ?>
					  <option value="<?php echo $coa->rowID; ?>"><?php echo $coa->acc_cd; ?>-<?php echo $coa->acc_name; ?></option>
					  
					<?php }}?>
			</select>
            </div>
		</div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('debtortype_commission_acc')?><span class="text-danger">*</span></label>
            <div class="col-md-8">
			<select name="debtortype_commission_acc" id="debtortype_commission_acc" class="form-control all_select2" required>
			<option value="" selected><?=lang('select_your_option')?></option>
				   <?php
                      if (!empty($coas)) {
                      foreach ($coas as $coa) { ?>
					  <option value="<?php echo $coa->rowID; ?>"><?php echo $coa->acc_cd; ?>-<?php echo $coa->acc_name; ?></option>
					  
					<?php }}?>
			</select>
            </div>
		</div> 
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_deptor_type()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
