<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <aside>
      <section class="vbox">
        <header class="header bg-white b-b b-light">
          <a href="#aside" data-toggle="class:show" class="btn btn-sm green pull-right"><i class="fa fa-plus"></i> <?=lang('new_destination_from')?></a>
          <p><?=lang('destination_from_details')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive"><?php echo validation_errors(); ?>
                  <table id="tbl-projects" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th><?=lang('destination_from_code')?> </th>
						<th><?=lang('destination_from_name')?> </th>
						<th><?=lang('destination_from_address')?> </th>
						<th><?=lang('destination_from_postal_code')?> </th>
						<th><?=lang('destination_from_contact_person')?> </th>
						<th><?=lang('destination_from_tlp')?> </th>
						<th><?=lang('actions')?> </th>
                      </tr> </thead> <tbody>
                      <?php
                      if (!empty($destination_froms)) {
                      foreach ($destination_froms as $destination_from) { ?>
                      <tr>
						<td><?=$destination_from->from_cd?></td>
						<td><?=$destination_from->decs?></td>
						<td><?=$destination_from->address1?></td>
						<td><?=$destination_from->post_cd?></td>
						<td><?=$destination_from->contact_prs?></td>
						<td><?=$destination_from->telp_no?></td>
                        <td>
					  	<a href="<?=base_url()?>destination_from/view/update/<?=$destination_from->rowID?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('edit')?>"><i class="fa fa-edit"></i> </a>
                        <a href="<?=base_url()?>destination_from/view/delete/<?=$destination_from->rowID?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('delete')?>"><i class="fa fa-trash-o"></i></a>
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
			echo form_open(base_url().'destination_from/create'); ?>
			<?php echo validation_errors(); ?>
	
		<div class="form-group form-md-line-input">
			<label><?=lang('destination_from_code')?> <span class="text-danger">*</span></label>
			<input type="text" name="destination_from_code" placeholder="Input Destination From Code"  maxlength="20"  autocomplete="off" class="input-sm form-control" required>
		</div>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('destination_from_name')?> <span class="text-danger">*</span></label>
			<input type="text" name="destination_from_name" placeholder="Input Destination From Name" autocomplete="off" class="input-sm form-control" required>
		</div>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('destination_from_address')?></label>
			<input type="text" name="destination_from_address1" placeholder="Input Destination From Address " autocomplete="off" class="input-sm form-control"><br/>
			<input type="text" name="destination_from_address2" placeholder="Input Destination From Address " autocomplete="off" class="input-sm form-control"><br/>
			<input type="text" name="destination_from_address3" placeholder="Input Destination From Address " autocomplete="off" class="input-sm form-control">
		</div>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('destination_from_contact_person')?></label>
			<input type="text" name="destination_from_contact_person" placeholder="Input Destination From Contact Person" autocomplete="off" class="input-sm form-control">
		</div>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('destination_from_tlp')?></label>
			<input type="text" name="destination_from_tlp" placeholder="Input Destination From Telephone No" autocomplete="off" class="input-sm form-control">
		</div>
		
		<button type="submit" class="btn btn-sm btn-success"><?=lang('add_destination_from')?></button>
		<hr>
		</form>
   
		</section>
	</section>   
</aside>
<!-- /.aside -->
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>