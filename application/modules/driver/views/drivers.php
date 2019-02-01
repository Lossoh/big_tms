<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <aside>
      <section class="vbox">
        <header class="header bg-white b-b b-light">
          <a href="<?php echo base_url().'driver/create'; ?>"  class="btn btn-sm green pull-right"><i class="fa fa-plus"></i> <?=lang('new_driver')?></a>
          <p><?=lang('driver_details')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive"><?php echo validation_errors(); ?>
                  <table id="tbl-projects" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th><?=lang('driver_cd')?></th>
                        <th><?=lang('driv_name')?> </th>
						<th><?=lang('driver_telp1')?> </th>
						<th><?=lang('driver_hp1')?> </th>
						 <th><?=lang('actions')?> </th>
                      </tr> </thead> <tbody>
                      <?php
                      if (!empty($drivers)) {
                      foreach ($drivers as $driver) { ?>
                      <tr>
                        <td><?=$driver->debtor_cd?></a></td>
						<td><?=$driver->debtor_name?></td>
						<td><?=$driver->telp_no1?></td>
						<td><?=$driver->hp_no1?></td>
                        <td>
					  	<a href="<?=base_url()?>driver/view/update/<?=$driver->rowID?>" class="btn btn-default btn-xs"  title="<?=lang('edit')?>"><i class="fa fa-edit"></i> </a>
                        <a href="<?=base_url()?>driver/view/delete/<?=$driver->rowID?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('delete')?>"><i class="fa fa-trash-o"></i></a>
                      </td>
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

  <!-- .aside -->
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
                      if (!empty($vehicle_types)) {
                      foreach ($vehicle_types as $vehicle_type) { ?>
					  <option value="<?php echo $vehicle_type->rowID; ?>"><?php echo $vehicle_type->type_cd; ?>-<?php echo $vehicle_type->type_name; ?></option>
					  
					<?php }}?>
			</select>
		</div>
		
		<button type="submit" class="btn btn-sm btn-success"><?=lang('add_debtor_type')?></button>
		<hr>
		</form>
   
		</section>
	</section>   
</aside>
<!-- /.aside -->
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>