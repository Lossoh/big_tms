<section id="content">
  <section class="hbox stretch">

      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">
              <a  class="btn btn-sm green" onclick="add_coa()"><i class="fa fa-plus"></i> <?=lang('new_coa')?></a>
              <a  class="btn btn-sm red" onclick="coa_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
              <a  class="btn btn-sm btn-success" onclick="coa_excel()"><i class="fa fa-file-excel-o"></i> Print Excel</a>
            </div>
            <p class="pull-left"><?=lang('coa_details')?></p>
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
                        <th><?=lang('coa_code')?> </th>
						<th><?=lang('coa_name')?> </th>
                        <th><?=lang('coa_type')?></th>
                        <th>Debit/Credit Type</th>
						<th><?=lang('coa_level')?> </th>
						<!--<th><?=lang('coa_sub')?> </th>-->
						<th><?=lang('coa_class')?> </th>
						<th><?=lang('coa_c')?> </th>
                        <th><?=lang('coa_b')?> </th>
						<th><?=lang('coa_vat_in')?> </th>
						<th><?=lang('coa_vat_out')?> </th>
						<th><?=lang('coa_active')?> </th>
                      </tr> </thead> <tbody>
                      <?php
                      if (!empty($coas)) {
                      foreach ($coas as $coa) { ?>
                      <tr>
                            <td>
							  <div class="btn-group">
								<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
								 <?=lang('options')?>
								<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a  href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_coa(<?=$coa->rowID ?>)"><i class="fa fa-pencil"></i> <?=lang('update_option')?></a></li>
                                    <li><a  href="javascript:void()" title="<?=lang('delete_option')?>" onclick="delete_coa(<?=$coa->rowID ?>)"><i class="fa fa-trash-o"></i> <?=lang('delete_option')?></a></li>
								</ul>
                                
							  </div>
							</td>
						<td><?=$coa->acc_cd?></td>
						<td><?=$coa->acc_name?></td>
                        <td><?=$coa->acc_type?></td>
						<td><?=$coa->acc_debit_credit == '' ? '-' : ucfirst($coa->acc_debit_credit)?></td>
						<td><?=$coa->acc_level?></td>
						<!--<td><?=$coa->acc_sub_of_rowID?></td>-->
						<td><?=$coa->acc_class?></td>
						<td><?=$coa->is_cash?></td>
                        <td><?=$coa->is_bank?></td>
						<td><?=$coa->is_vat_in?></td>
						<td><?=$coa->is_vat_out?></td>
						<td><?=$coa->active?></td>

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
  

<!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog" style="width:600px;height:200px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"></h3>
      </div>
      <div class="modal-body form">
        <?=form_open(''.'/update','autocomplete="off" id="form" class="form-horizontal"')?>
        <input type="hidden" name="rowID" value="">
        
  		<div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('coa_type')?><span class="text-danger">*</span></label>
            <div class="col-md-4">
 			<select name="coa_type" id="coa_type" class="form-control"   required>
                <option value=" " disabled selected><?=lang('select_your_option')?></option>
				<option value="H">Header</option>
				<option value="D">Detail</option>
			</select>
            </div>
		</div>
        	
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('coa_cd')?> <span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" name="coa_code" id="coa_code" maxlength="20" placeholder="Input Account Code" value="<?=set_value('coa_code')?>" maxlength="20"  autocomplete="off" class="input-sm form-control" required>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('coa_name')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" placeholder="Input Account Name" maxlength="60" name="coa_name" value="<?=set_value('coa_name')?>" class="input-sm form-control" required>
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">Debit/Credit Type<span class="text-danger">*</span></label>
            <div class="col-md-4">
 			<select name="acc_debit_credit" id="acc_debit_credit" class="form-control">
				<option value=""><?=lang('select_your_option')?></option>
                <option value="debit">Debit</option>
				<option value="credit">Credit</option>
			</select>
            </div>
		</div>
		<div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('coa_class')?><span class="text-danger">*</span></label>
            <div class="col-md-8">
			<select name="coa_class" id="coa_class"   class="form-control" required>
                <option value=" " disabled selected><?=lang('select_your_option')?></option>
                <option value="A">Assets</option>
				<option value="L">Liabilities</option>
				<option value="C">Capital</option>
				<option value="I">Income</option>
				<option value="E">Expenses</option>
			</select>
            </div>
		</div>
        
		<div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('coa_level')?><span class="text-danger">*</span></label>
            <div class="col-md-8">
			<select name="coa_level" id="coa_level" class="form-control"  required>
                <option value="0" disabled selected><?=lang('select_your_option')?></option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
                <option value="5">5</option>
				<option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
			</select>
            </div>

		</div>
        
		<div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('coa_sub_of_account')?></label>
              <div class="col-md-8">
				<select name="coa_subof_account" id="coa_subof_account" class="form-control"  required>
         			<option value="0" disabled selected><?=lang('select_your_option')?></option>
                     <!--?php foreach($coa_sub_account as $rs):?-->
                    	<!--	<option  value='<?php echo $rs->rowID ?>'><?php echo $rs->acc_cd .'-'.$rs->acc_name;?> </option>-->
          		    <!--?php endforeach ?-->
                </select>
                </div>
		</div>
        
		<div id="coa_lists">
			<!--<input type="hidden"  name="coa_xx" id="coa_xx" class="input-sm form-control" required>-->
		</div>
		<div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('coa_c')?><span class="text-danger">*</span></label>
            <div class="col-md-8">
             <select name="coa_c" id='coa_c' class="form-control" required>
                <option value=" " disabled selected><?=lang('select_your_option')?></option>
				<option value="Y">Yes</option>
				<option value="N">No</option>
			</select>
            </div>
		</div>
		<div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('coa_b')?><span class="text-danger">*</span></label>
            <div class="col-md-8">
             <select name="coa_b" id='coa_b' class="form-control" required>
                <option value=" " disabled selected><?=lang('select_your_option')?></option>
				<option value="Y">Yes</option>
				<option value="N">No</option>
			</select>
            </div>
		</div>
        
		<div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('coa_vatin')?><span class="text-danger">*</span></label>
            <div class="col-md-8">
            <select name="coa_vatin" id="coa_vatin" class="form-control" required>
                <option value=" " disabled selected><?=lang('select_your_option')?></option>
				<option value="Y">Yes</option>
				<option value="N">No</option>
			</select>
            </div>
		</div>
		<div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('coa_vatout')?><span class="text-danger">*</span></label>
            <div class="col-md-8">
            <select name="coa_vatout" id="coa_vatout" class="form-control" required>
                <option value=" " disabled selected><?=lang('select_your_option')?></option>
				<option value="Y">Yes</option>
				<option value="N">No</option>
			</select>
            </div>
		</div>
		<div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('coa_active')?><span class="text-danger">*</span></label>
            <div class="col-md-8">
			<select name="coa_active" id="coa_active" class="form-control" required>
                <option value=" " disabled selected><?=lang('select_your_option')?></option>
				<option value="Y">Yes</option>
				<option value="N">No</option>
			</select>
            </div>
		</div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">Cash Branch</label>
            <div class="col-md-8">
			<select name="cash_branch" id="cash_branch" class="form-control" required>
				<option value="0">No</option>
				<option value="1">Yes</option>
			</select>
            </div>
		</div>
             
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_coa()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>