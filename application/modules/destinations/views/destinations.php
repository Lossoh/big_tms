<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <aside>
      <section class="vbox">
        <header class="header bg-white b-b b-light">
          <a href="#aside" data-toggle="class:show" class="btn btn-sm green pull-right"><i class="fa fa-plus"></i> <?=lang('new_destination')?></a>
          <p><?=lang('registered_destination')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive"><?php echo validation_errors(); ?>
                  <table id="tbl-projects" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th><?=lang('destination_ref')?></th>
                        <th><?=lang('destination_name')?> </th>
                        <th><?=lang('address_1')?></th>
						<th><?=lang('address_2')?></th>
						<th><?=lang('address_3')?></th>
						<th><?=lang('city')?></th>
						<th><?=lang('destination_flag')?></th>
						<th><?=lang('options')?></th>
                      </tr> </thead> <tbody>
                      <?php
                      if (!empty($destinations)) {
                      foreach ($destinations as $destination) { ?>
						<tr>
						  <td><?=$destination->destination_ref?></a></td>
						  <td><?=$destination->destination_name?></td>
						  <td><?=$destination->address_1?></td>
						  <td><?=$destination->address_2?></td>
						  <td><?=$destination->address_3?></td>
						  <td><?=$destination->city?></td>
						  <td><?=$destination->Nm_Ref?></td>
						  <td>
							<a href="<?=base_url()?>destinations/view/update/<?=$destination->destination_id?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('edit')?>"><i class="fa fa-edit"></i> </a>
							<a href="<?=base_url()?>destinations/view/delete/<?=$destination->destination_id?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('delete')?>"><i class="fa fa-trash-o"></i></a>
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
<aside class="aside-lg bg-white b-l hide" id="aside">
    <section class="vbox">
		<section class="scrollable wrapper">
		<?php
		echo form_open(base_url().'destinations/create'); ?>
		<?php echo validation_errors(); ?>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('destination_ref')?> <span class="text-danger">*</span></label>
			<input type="text" name="destination_ref" placeholder="Input Destination Reference" value="<?=set_value('destination_ref')?>" class="input-sm form-control">
		</div>
		<div class="form-group form-md-line-input">
			<label><?=lang('destination_name')?> <span class="text-danger">*</span></label>
			<input type="text" placeholder="Input Destination Name" name="destination_name" value="<?=set_value('destination_name')?>" class="input-sm form-control">
		</div>
		<div class="form-group form-md-line-input">
			<label><?=lang('address_1')?> <span class="text-danger">*</span></label>
			<input type="text" placeholder="Input Address Line One Name" name="address_1" value="<?=set_value('address_1')?>" class="input-sm form-control">
		</div>
		<div class="form-group form-md-line-input">
			<label><?=lang('address_2')?></label>
			<input type="text" placeholder="Input Address Line Two Name" name="address_2" value="<?=set_value('address_2')?>" class="input-sm form-control">
		</div>
		<div class="form-group form-md-line-input">
			<label><?=lang('address_3')?> </label>
			<input type="text" placeholder="Input Address Line Three Name" name="address_3" value="<?=set_value('address_3')?>" class="input-sm form-control">
		</div>
		<div class="form-group form-md-line-input">
			<label><?=lang('city')?></label>
			<input type="text" placeholder="Input City Name" name="city" value="<?=set_value('city')?>" class="input-sm form-control">
		</div>
		<div class="form-group form-md-line-input">
			<label><?=lang('destination_flag')?> <span class="text-danger">*</span></label>
			<select name="destination_flag" class="form-control"> 
				<option value="1">Sumber</option>
				<option value="2">Client</option>
				<option value="3">POK</option>
			</select>
		</div>
 
		<button type="submit" class="btn btn-sm btn-success"><?=lang('add_item')?></button>
		<hr>
		</form>
   
		</section>
	</section>   
</aside>
<!-- /.aside -->
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>