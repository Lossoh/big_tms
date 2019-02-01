<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
<!--    <aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">
              <a  class="btn btn-sm green" onclick="add_cost_code()"><i class="fa fa-plus"></i> <?=lang('new_cost_code')?></a>
              <a  class="btn btn-sm red" onclick="cost_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
              <a  class="btn btn-sm btn-success" onclick="cost_excel()"><i class="fa fa-file-excel-o"></i> Print Excel</a>
            </div>
          <p class="pull-left"><?=lang('cost_code_details')?></p>
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
                        <th><?=lang('cost_code_type')?></th>
                        <th><?=lang('cost_code_code')?> </th>
						<th><?=lang('cost_code_name')?> </th>
						<th><?=lang('cost_code_wip')?> </th>
						<th><?=lang('cost_code_cogs')?> </th>
                        <th><?=lang('cost_code_site')?> </th>
                        <th><?=lang('fare_trip_component')?> </th>
						<!--<th><?=lang('actions')?> </th>-->
                      </tr> </thead> <tbody>
                      <?php
                      if (!empty($cost_codes)) {
                      foreach ($cost_codes as $cost_code) { ?>
                      <tr>
                            <td>
							  <div class="btn-group">
								<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
								 <?=lang('options')?>
								<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a  href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_cost_code(<?=$cost_code->rowID ?>)"><i class="fa fa-pencil"></i> <?=lang('update_option')?></a></li>
                                    <li><a  href="javascript:void()" title="<?=lang('delete_option')?>" onclick="delete_cost_code(<?=$cost_code->rowID ?>)"><i class="fa fa-trash-o"></i> <?=lang('delete_option')?></a></li>
								</ul>
                                
							  </div>
							</td>
                        <td><?=$cost_code->type?></a></td>
						<td><?=$cost_code->cost_cd?></td>
						<td><?=$cost_code->descs?></td>
						<td><?=$cost_code->wip_acc?></td>
						<td><?=$cost_code->cogs_acc?></td>
                        <td><?=$cost_code->site_flag?></td>
                        <td><?=$cost_code->fare_trip_comp?></td>
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
  <!-- /.aside -->

  <!-- .aside -->
  <!--
<aside class="aside-xxl bg-white b-l hide" id="aside">
    <section class="vbox">
		<section class="scrollable wrapper">
			<?php
			echo form_open(base_url().'cost_code/create'); ?>
			<?php echo validation_errors(); ?>
			
		<div class="form-group form-md-line-input">
			<label><?=lang('cost_code_type')?> <span class="text-danger">*</span></label>
			<select name="cost_code_type" class="form-control" id="cost_code_type" required>
				<option value="H">Header</option>
				<option value="D">Detail</option>
			</select>
		</div>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('cost_code_code')?> <span class="text-danger">*</span></label>
			<input type="text" name="cost_code_code" placeholder="Input Cost Code"  maxlength="20"  autocomplete="off" class="input-sm form-control" required>
		</div>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('cost_code_name')?> <span class="text-danger">*</span></label>
			<input type="text" name="cost_code_name" placeholder="Input Cost Name"  maxlength="20"  autocomplete="off" class="input-sm form-control" required>
		</div>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('cost_code_level')?></label>
			<select name="cost_code_level" class="form-control" id="cost_code_level">
			</select>
		</div>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('cost_code_subof')?></label>
			<select name="cost_code_subof" class="form-control" id="cost_code_subof">
				<?php
				if (!empty($cost_code_subs)) {
						  foreach ($cost_code_subs as $cost_code_sub) { ?>
						  <option value="<?=$cost_code_sub->cost_cd?>"><?=$cost_code_sub->cost_cd?>&nbsp;-&nbsp<?=$cost_code_sub->descs?></option>
				<?php }}?>
			</select>
		</div>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('cost_code_wip')?></label>
			<select name="cost_code_wip" class="form-control" id="cost_code_wip">
			<option value="0">Select</option>
				<?php
				if (!empty($coas)) {
						  foreach ($coas as $coa) { ?>
						  <option value="<?=$coa->acc_cd?>"><?=$coa->acc_cd?>&nbsp;-&nbsp<?=$coa->acc_name?></option>
				<?php }}?>
			</select>
		</div>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('cost_code_cogs')?></label>
			<select name="cost_code_cogs" class="form-control" id="cost_code_cogs">
			<option value="0">Select</option>
				<?php
				if (!empty($coas)) {
						  foreach ($coas as $coa) { ?>
						  <option value="<?=$coa->acc_cd?>"><?=$coa->acc_cd?>&nbsp;-&nbsp<?=$coa->acc_name?></option>
				<?php }}?>
			</select>
		</div>
		<button type="submit" class="btn btn-sm btn-success"><?=lang('add_cost_code')?></button>
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
        <h3 class="modal-title"><?=lang('new_debtor_type')?></h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>

        <input type="hidden" name="rowID" value="">
        
        <div class="form-group form-md-line-input">
                <label class="col-lg-4 control-label"><?=lang('cost_code_type')?><span class="text-danger">*</span></label>
                <div class="col-md-8">
        			<select name="cost_code_type" class="form-control" id="cost_code_type" required>
        				<option value="H">Header</option>
        				<option value="D">Detail</option>
        			</select>
                </div>
        </div>
        	
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('cost_code_code')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" class="input-sm form-control" value="" name="cost_code_code"  placeholder="Input <?=lang('cost_code_code')?>" required>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('cost_code_name')?><span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text"  value="" name="cost_code_name" placeholder="Input <?=lang('cost_code_name')?>" autocomplete="off" class="input-sm form-control" required>
            </div>
        </div>
        
       <div class="form-group form-md-line-input">
                <label class="col-lg-4 control-label"><?=lang('cost_code_wip')?><span class="text-danger">*</span></label>
                <div class="col-md-8">
                     <select class="form-control" name="cost_code_wip" id="cost_code_wip" placeholder="<?=lang('select')?>" >	
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
                <label class="col-lg-4 control-label"><?=lang('cost_code_cogs')?><span class="text-danger">*</span></label>
                <div class="col-md-8">
                     <select class="form-control" name="cost_code_cogs" id="cost_code_cogs" placeholder="<?=lang('select')?>" >	
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
                <label class="col-lg-4 control-label"><?=lang('cost_code_site')?><span class="text-danger">*</span></label>
                <div class="col-md-8">
			          <select  class="form-control" id="cost_code_site" name="cost_code_site">
                       <option value=" " disabled selected><?=lang('select_your_option')?></option>
						<option value="Y">Yes</option>
						<option value="N">No</option>
			          </select> 
                </div>

        </div>
        <div class="form-group form-md-line-input">
                <label class="col-lg-4 control-label"><?=lang('fare_trip_component')?><span class="text-danger">*</span></label>
                <div class="col-md-8">
			          <select  class="form-control" id="cost_code_fare_trip_comp" name="cost_code_fare_trip_comp">
                       <option value=" " disabled selected><?=lang('select_your_option')?></option>
						<option value="Y">Yes</option>
						<option value="N">No</option>
			          </select> 
                </div>

        </div>

        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_cost_code()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>