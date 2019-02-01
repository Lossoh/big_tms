<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">
              <a  class="btn btn-sm green" onclick="add_expense()"><i class="fa fa-plus"></i> <?=lang('new_expenses')?></a>
              <a  class="btn btn-sm red" onclick="expense_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
              <a  class="btn btn-sm btn-success" onclick="expense_excel()"><i class="fa fa-file-excel-o"></i> Print Excel</a>
            </div>
          <p class="pull-left"><?=lang('expenses_details')?></p>
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
                        <th><?=lang('expenses_code')?> </th>
						<th><?=lang('expenses_name')?> </th>
						<th><?=lang('type')?> </th>
						<th><?=lang('expenses_account')?> </th>
						<th>AP Account </th>
						<th>Reimburse Account </th>
						<th>Advance Account </th>
                      </tr> </thead> <tbody>
                      <?php
                      if (!empty($expenses)) {
                      foreach ($expenses as $expense) { ?>
                      <tr>
                            <td>
							  <div class="btn-group">
								<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
								 <?=lang('options')?>
								<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a  href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_expense(<?=$expense->rowID ?>)"><i class="fa fa-pencil"></i> <?=lang('update_option')?></a></li>
                                    <li><a  href="javascript:void()" title="<?=lang('delete_option')?>" onclick="delete_expense(<?=$expense->rowID ?>)"><i class="fa fa-trash-o"></i> <?=lang('delete_option')?></a></li>
								</ul>
                                
							  </div>
							</td>
						<td><?=$expense->expense_cd?></td>
						<td><?=$expense->descs?></td>
						<td><?=$expense->advance_name?></td>
						<td><?=$expense->expense_acc?></td>
						<td><?=$expense->ap_acc?></td>
						<td><?=$expense->reimburse_acc?></td>
						<td><?=$expense->advance_acc?></td>
                        <!--<td>
					  	<a href="<?=base_url()?>expense/view/update/<?=$expense->rowID?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('edit')?>"><i class="fa fa-edit"></i> </a>
                        <a href="<?=base_url()?>expense/view/delete/<?=$expense->rowID?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('delete')?>"><i class="fa fa-trash-o"></i></a>
                      </td>-->
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
            <label class="col-lg-4 control-label"><?=lang('expenses_code')?> <span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" class="input-sm form-control" value="" name="expenses_code"  placeholder="Input <?=lang('expenses_code')?>" required>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('expenses_name')?> <span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text"  value="" name="expenses_name" placeholder="Input <?=lang('expenses_name')?>" autocomplete="off" class="input-sm form-control" required>
            </div>
        </div>
        <div class="form-group form-md-line-input">
                <label class="col-lg-4 control-label"><?=lang('type')?> <span class="text-danger">*</span></label>
                <div class="col-md-8">
                     <select class="form-control" name="advance_category" id="advance_category" placeholder="<?=lang('select')?>" >	
                          <?php if (!empty($types)) {
						  foreach ($types as $type) { ?>
						  <option value="<?php echo $type->rowID;?>"><?=$type->advance_cd?>&nbsp;-&nbsp<?=$type->advance_name?></option>
						 <?php }} ?>
				    </select> 
                </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('expenses_account')?> <span class="text-danger">*</span></label>
            <div class="col-md-8">
                 <select class="form-control" name="expenses_account" id="expenses_account" placeholder="<?=lang('select')?>" >	
                     <option value=" " disabled selected><?=lang('select_your_option')?></option>
					 <?php if (!empty($expenses_accounts)) {
					  foreach ($expenses_accounts as $expenses_account) { ?>
					  <option value="<?php echo $expenses_account->rowID;?>"><?=$expenses_account->acc_cd?>&nbsp;-&nbsp<?=$expenses_account->acc_name?></option>
					 <?php }} ?>
			    </select> 
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('ap_account')?> <span class="text-danger">*</span></label>
            <div class="col-md-8">
                 <select class="form-control all_select2" name="ap_account" id="ap_account" placeholder="<?=lang('select')?>" >	
                     <option value=" " disabled selected><?=lang('select_your_option')?></option>
					 <?php if (!empty($expenses_accounts)) {
					  foreach ($expenses_accounts as $expenses_account) { ?>
					  <option value="<?php echo $expenses_account->rowID;?>"><?=$expenses_account->acc_cd?>&nbsp;-&nbsp<?=$expenses_account->acc_name?></option>
					 <?php }} ?>
			    </select> 
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('reimburse_account')?> <span class="text-danger">*</span></label>
            <div class="col-md-8">
                 <select class="form-control all_select2" name="reimburse_account" id="reimburse_account" placeholder="<?=lang('select')?>" >	
                     <option value=" " disabled selected><?=lang('select_your_option')?></option>
					 <?php if (!empty($expenses_accounts)) {
					  foreach ($expenses_accounts as $expenses_account) { ?>
					  <option value="<?php echo $expenses_account->rowID;?>"><?=$expenses_account->acc_cd?>&nbsp;-&nbsp<?=$expenses_account->acc_name?></option>
					 <?php }} ?>
			    </select> 
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('advance_account')?> <span class="text-danger">*</span></label>
            <div class="col-md-8">
                 <select class="form-control all_select2" name="advance_account" id="advance_account" placeholder="<?=lang('select')?>" >	
                     <option value=" " disabled selected><?=lang('select_your_option')?></option>
					 <?php if (!empty($expenses_accounts)) {
					  foreach ($expenses_accounts as $expenses_account) { ?>
					  <option value="<?php echo $expenses_account->rowID;?>"><?=$expenses_account->acc_cd?>&nbsp;-&nbsp<?=$expenses_account->acc_name?></option>
					 <?php }} ?>
			    </select> 
            </div>
        </div>

        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_expense()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>