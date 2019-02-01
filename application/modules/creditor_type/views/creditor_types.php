<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
  <!--  <aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
          <a  class="btn btn-sm red pull-right" onclick="creditor_type_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
          <a  class="btn btn-sm green pull-right" onclick="add_creditor_type()"><i class="fa fa-plus"></i> <?=lang('new_creditor_type')?></a>
          <p><label><?=lang('creditor_type_details')?></label></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive"><?php echo validation_errors(); ?>
                  <table id="tbl-projects" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th><?=lang('options')?></th>
                        <th><?=lang('creditor_type_cd')?></th>
                        <th><?=lang('creditor_type_name')?> </th>
						<th><?=lang('creditortype_advance_acc')?> </th>
						<th><?=lang('creditortype_deposit_acc')?> </th>
						<th><?=lang('creditortype_rounding_acc')?> </th>
						<th><?=lang('creditortype_adm_acc')?> </th>
                        <th><?=lang('creditortype_pay_acc')?> </th>
						
                      </tr> 
                      </thead>
                      <tbody>
                      <?php
                      if (!empty($creditor_types)) {
                      foreach ($creditor_types as $creditor_type) { ?>
                      <tr>
                            <td>
							  <div class="btn-group">
								<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
								 <?=lang('options')?>
								<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a  href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_creditor_type(<?=$creditor_type->rowID ?>)"><i class="fa fa-pencil"></i><?=lang('update_option')?></a></li>
                                    <li><a  href="javascript:void()" title="<?=lang('delete_option')?>" onclick="delete_creditor_type(<?=$creditor_type->rowID ?>)"><i class="fa fa-trash-o"></i><?=lang('delete_option')?></a></li>
								</ul>
                                
							  </div>
							</td>
                        <td><?=$creditor_type->type_cd?></a></td>
						<td><?=$creditor_type->descs?></td>
						<td><?=$creditor_type->advance_acc?></td>
						<td><?=$creditor_type->deposit_acc?></td>
						<td><?=$creditor_type->rounding_acc?></td>
						<td><?=$creditor_type->adm_acc?></td>
                        <td><?=$creditor_type->payable_acc?></td>
                        
                    </tr>
                    <?php } } ?>
                    
                    
                  </tbody>
                </table>

              </div>
            </section>            
          </div>
        </div>
      </section>

    </section>
  <!--</aside>-->
  <!-- /.aside -->

  <!-- .aside -->
<!--
<aside class="aside-xxl bg-white b-l hide" id="aside">
    <section class="vbox">
		<section class="scrollable wrapper">
		<?php
		echo form_open(base_url().'debtor_type/create'); ?>
		<?php echo validation_errors(); ?>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('debtortype_type_cd')?> <span class="text-danger">*</span></label>
			<input type="text" name="debtortype_type_cd" placeholder="Input Type Code" value="<?=set_value('debtortype_type_cd')?>" maxlength="6"  autocomplete="off" class="input-sm form-control" required>
		</div>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('debtortype_name')?> <span class="text-danger">*</span></label>
			<input type="text" placeholder="Input Type Name" name="debtortype_name" value="<?=set_value('debtortype_name')?>" class="input-sm form-control" required>
		</div>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('debtortype_receivable_acc')?> <span class="text-danger">*</span></label>
			<select name="debtortype_receivable_acc" class="form-control" required>
				   <?php
                      if (!empty($coas)) {
                      foreach ($coas as $coa) { ?>
					  <option value="<?php echo $coa->acc_cd; ?>"><?php echo $coa->acc_cd; ?>-<?php echo $coa->acc_name; ?></option>
					  
			<?php }}?>
			</select>

		</div>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('debtortype_advance_acc')?> <span class="text-danger">*</span></label>
			<select name="debtortype_advance_acc" class="form-control" required>
				   <?php
                      if (!empty($coas)) {
                      foreach ($coas as $coa) { ?>
					  <option value="<?php echo $coa->acc_cd; ?>"><?php echo $coa->acc_cd; ?>-<?php echo $coa->acc_name; ?></option>
					  
			<?php }}?>
			<select>
		</div>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('debtortype_deposit_acc')?> <span class="text-danger">*</span></label>
			<select name="debtortype_deposit_acc" class="form-control" required>
				   <?php
                      if (!empty($coas)) {
                      foreach ($coas as $coa) { ?>
					  <option value="<?php echo $coa->acc_cd; ?>"><?php echo $coa->acc_cd; ?>-<?php echo $coa->acc_name; ?></option>
					  
			<?php }}?>
			</select>

		</div>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('debtortype_rounding_acc')?> <span class="text-danger">*</span></label>
				<select name="debtortype_rounding_acc" class="form-control" required>
				<option value ="0">Select</option>
				   <?php
                      if (!empty($coas)) {
                      foreach ($coas as $coa) { ?>
					  <option value="<?php echo $coa->acc_cd; ?>"><?php echo $coa->acc_cd; ?>-<?php echo $coa->acc_name; ?></option>
					  
					<?php }}?>
				</select>
		</div>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('debtortype_adm_acc')?> <span class="text-danger">*</span></label>
			<select name="debtortype_adm_acc" class="form-control" required>
			<option value ="0">Select</option>
				   <?php
                      if (!empty($coas)) {
                      foreach ($coas as $coa) { ?>
					  <option value="<?php echo $coa->acc_cd; ?>"><?php echo $coa->acc_cd; ?>-<?php echo $coa->acc_name; ?></option>
					  
					<?php }}?>
			</select>
		</div>
		
		<button type="submit" class="btn btn-sm btn-success"><?=lang('add_debtor_type')?></button>
		<hr>
		</form>
   
		</section>
	</section>   
</aside>
-->
<!-- /.aside -->

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog" style="width:600px;height:200px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?=lang('new_creditor_type')?></h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal"> 
        <input type="hidden" name="rowID" value="">
        	
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('creditor_type_cd')?> <span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" class="form-control" value="" name="creditor_type_cd"  required>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('creditor_type_name')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" class="form-control" value="" name="creditor_type_name" placeholder="<?=lang('creditor_type_name')?>" required>
            </div>
        </div>
        

        
		<div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('creditortype_advance_acc')?><span class="text-danger">*</span></label>
            <div class="col-md-8">
			<select name="creditortype_advance_acc" class="form-control" required>
            <option value ="0">Select</option>
				   <?php
                      if (!empty($coas)) {
                      foreach ($coas as $coa) { ?>
					  <option value="<?php echo $coa->rowID; ?>"><?php echo $coa->acc_cd; ?>-<?php echo $coa->acc_name; ?></option>
					  
			<?php }}?>
			<select>
            </div>
		</div>
        
		<div class="form-group form-md-line-input">
			
            <label class="col-lg-4 control-label"><?=lang('creditortype_deposit_acc')?><span class="text-danger">*</span></label>
            <div class="col-md-8">
			<select name="creditortype_deposit_acc" class="form-control" required>
            <option value ="0">Select</option>
				   <?php
                      if (!empty($coas)) {
                      foreach ($coas as $coa) { ?>
					  <option value="<?php echo $coa->rowID; ?>"><?php echo $coa->acc_cd; ?>-<?php echo $coa->acc_name; ?></option>
					  
			<?php }}?>
			</select>
            </div>

		</div>
        
		<div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('creditortype_rounding_acc')?><span class="text-danger">*</span></label>
              <div class="col-md-8">
				<select name="creditortype_rounding_acc" class="form-control" required>
				<option value ="0">Select</option>
				   <?php
                      if (!empty($coas)) {
                      foreach ($coas as $coa) { ?>
					  <option value="<?php echo $coa->rowID; ?>"><?php echo $coa->acc_cd; ?>-<?php echo $coa->acc_name; ?></option>
					  
					<?php }}?>
				</select>
                </div>
		</div>
        
		<div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('creditortype_adm_acc')?><span class="text-danger">*</span></label>
            <div class="col-md-8">
			<select name="creditortype_adm_acc" class="form-control" required>
			<option value ="0">Select</option>
				   <?php
                      if (!empty($coas)) {
                      foreach ($coas as $coa) { ?>
					  <option value="<?php echo $coa->rowID; ?>"><?php echo $coa->acc_cd; ?>-<?php echo $coa->acc_name; ?></option>
					  
					<?php }}?>
			</select>
            </div>
		</div>
		<div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('creditortype_pay_acc')?><span class="text-danger">*</span></label>
            <div class="col-md-8">
			<select name="creditortype_pay_acc" class="form-control" required>
			<option value ="0">Select</option>
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
            <button type="button" id="btnSave" onclick="save_creditor_type()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>