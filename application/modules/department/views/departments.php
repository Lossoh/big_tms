<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <aside>
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">
              <a  class="btn btn-sm green" onclick="add_dept()"><i class="fa fa-plus"></i> <?=lang('new_department')?></a>
              <a  class="btn btn-sm red" onclick="dept_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
              <a  class="btn btn-sm btn-success" onclick="dept_excel()"><i class="fa fa-file-excel-o"></i> Print Excel</a>
            </div>
            <p class="pull-left"><?=lang('department_details')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default" style="height: 100%;">
                <div class="table-responsive">
                  <?php echo validation_errors(); ?>
                  <table id="tbl-projects" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th><?=lang('options')?></th>
                        <th><?=lang('dep_cd')?></th>
                        <th><?=lang('dep_name')?> </th>
			            <th><?=lang('departments_cash_gl_coa')?> </th>
                        <th><?=lang('departments_cash_in_prefix')?> </th>
                        <th><?=lang('departments_cash_out_prefix')?> </th>
                      </tr> </thead> <tbody>
                      <?php
                      if (!empty($departments)) {
                      foreach ($departments as $department) { ?>
                      <tr>
                        <td>
							  <div class="btn-group">
								<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
								 <?=lang('options')?>
								<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a  href="javascript:void()" title="<?=lang('edit')?>" onclick="edit_dept(<?=$department->rowID ?>)"><i class="fa fa-pencil"></i> <?=lang('update_option')?></a></li>
                                    <li><a  href="javascript:void()" title="<?=lang('delete')?>" onclick="delete_dept(<?=$department->rowID ?>)"><i class="fa fa-trash-o"></i> <?=lang('delete_option')?></a></li>
								</ul>
                                
							  </div>
							</td>
                        <td><?=$department->dep_cd?></a></td>
						<td><?=$department->dep_name?></td>
                        <td><?=$department->cash_gl_coa?></td>
                        <td><?=$department->cash_in_prefix?></td>
                        <td><?=$department->cash_out_prefix?></td>

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
  </aside>
  <!-- /.aside -->
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
            <label class="col-lg-4 control-label"><?=lang('department_cd')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" placeholder="Input Department Code" class="form-control" maxlength="6" value="" name="department_code"  required>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('department_name')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" placeholder="Input Department Name" class="form-control" autocomplete="off" value="" name="department_name" required>
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">Pool<span class="text-danger">*</span></label>
              <div class="col-md-8">
				<select name="pool" id="pool" class="form-control">
                	<option value='yes'>Yes</option>
                	<option value='no'>No</option>
  		        </select>
                </div>
		</div>
        
  		<div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('departments_cash_gl_coa')?><span class="text-danger">*</span></label>
              <div class="col-md-8">
				<select name="departments_cash_gl_coa" id="departments_cash_gl_coa" class="form-control"  required>
                    <option value=" " disabled selected><?=lang('select_your_option')?></option>
         			<?php foreach($cash_gl_coa as $rs):?>
                    	<option  value='<?php echo $rs->rowID ?>'><?php echo $rs->acc_cd .'-'.$rs->acc_name;?> </option>
          		    <?php endforeach ?>
                </select>
                </div>
		</div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('departments_cash_in_prefix')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" placeholder="Input <?=lang('departments_cash_in_prefix')?>" maxlength="4" class="form-control" value="" name="departments_cash_in_prefix" required>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('departments_cash_out_prefix')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" placeholder="Input <?=lang('departments_cash_out_prefix')?>" maxlength="4" class="form-control" value="" name="departments_cash_out_prefix" required>
            </div>
        </div>
      
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_dept()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>