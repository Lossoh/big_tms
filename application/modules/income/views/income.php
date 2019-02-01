<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
<!--    <aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
         <a  class="btn btn-sm red pull-right" onclick="income_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
          <a  class="btn btn-sm green pull-right" onclick="add_income()"><i class="fa fa-plus"></i> <?=lang('new_income')?></a>
          <p><?=lang('income_Detail')?></p>
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
                        <th><?=lang('income_type')?></th>
                        <th><?=lang('income_code')?> </th>
						<th><?=lang('income_name')?> </th>
						<th><?=lang('income_accrued')?> </th>
						<th><?=lang('income_account')?> </th>
						<!--<th><?=lang('actions')?> </th>-->
                      </tr> </thead> <tbody>
                      <?php
                      if (!empty($incomes)) {
                      foreach ($incomes as $income) { ?>
                      <tr>
                            <td>
							  <div class="btn-group">
								<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
								 <?=lang('options')?>
								<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a  href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_income(<?=$income->rowID ?>)"><i class="fa fa-pencil"></i><?=lang('update_option')?></a></li>
                                    <li><a  href="javascript:void()" title="<?=lang('delete_option')?>" onclick="delete_income(<?=$income->rowID ?>)"><i class="fa fa-trash-o"></i><?=lang('delete_option')?></a></li>
								</ul>
                                
							  </div>
							</td>
                        <td><?=$income->type?></a></td>
						<td><?=$income->income_cd?></td>
						<td><?=$income->descs?></td>
						<td><?=$income->income_accrued?></td>
						<td><?=$income->income_account?></td>
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
<!--  </aside>-->



<!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog" style="width:600px;height:200px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?=lang('new_income')?></h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal"> 
        <input type="hidden" name="rowID" value="">
        
        <div class="form-group form-md-line-input">
                <label class="col-lg-4 control-label"><?=lang('income_type')?><span class="text-danger">*</span></label>
                <div class="col-md-8">
        			<select name="income_type" class="form-control" id="income_type" required>
        				<option value="H">Header</option>
        				<option value="D">Detail</option>
        			</select>
                </div>
        </div>
        	
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('income_code')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" class="input-sm form-control" value="" name="income_code"  placeholder="Input <?=lang('income_code')?>" required>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('income_name')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text"  value="" name="income_name" placeholder="Input <?=lang('income_name')?>" autocomplete="off" class="input-sm form-control" required>
            </div>
        </div>
        
       <div class="form-group form-md-line-input">
                <label class="col-lg-4 control-label"><?=lang('income_accrued')?><span class="text-danger">*</span></label>
                <div class="col-md-8">
                     <select class="form-control" name="income_accrued" id="income_accrued" placeholder="<?=lang('select')?>" >	
                        <option value=" " disabled selected><?=lang('select_your_option')?></option>
        				<?php
        				if (!empty($coas)) {
        						  foreach ($coas as $coa) { ?>
        						  <option value="<?=$coa->rowID?>"><?=$coa->acc_cd?>&nbsp;-&nbsp<?=$coa->acc_name?></option>
        				<?php }}?>
				    </select> 
                </div>
        </div>
        
        <div class="form-group form-md-line-input">
                <label class="col-lg-4 control-label"><?=lang('income_account')?><span class="text-danger">*</span></label>
                <div class="col-md-8">
                     <select class="form-control" name="income_account" id="income_account" placeholder="<?=lang('select')?>" >	
                        <option value=" " disabled selected><?=lang('select_your_option')?></option>
        				<?php
        				if (!empty($coas)) {
        						  foreach ($coas as $coa) { ?>
        						  <option value="<?=$coa->rowID?>"><?=$coa->acc_cd?>&nbsp;-&nbsp<?=$coa->acc_name?></option>
        				<?php }}?>
				    </select> 
                </div>
        </div>



        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_income()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>