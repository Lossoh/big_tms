<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <aside>
      <section class="vbox">
        <header class="header bg-white b-b b-light">
          <a href="#aside" data-toggle="class:show" class="btn btn-sm green pull-right"><i class="fa fa-plus"></i> <?=lang('new_ap_type')?></a>
          <p><?=lang('ap_type_details')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive"><?php echo validation_errors(); ?>
                  <table id="tbl-projects" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th><?=lang('ap_type_code')?> </th>
						<th><?=lang('ap_type_name')?> </th>
						<th><?=lang('actions')?> </th>
                      </tr> </thead> <tbody>
                      <?php
                      if (!empty($ap_types)) {
                      foreach ($ap_types as $ap_type) { ?>
                      <tr>
						<td><?=$ap_type->ap_type_cd?></td>
						<td><?=$ap_type->ap_type_name?></td>
                        <td>
					  	<a href="<?=base_url()?>ap_type/view/update/<?=$ap_type->rowID?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('edit')?>"><i class="fa fa-edit"></i> </a>
                        <a href="<?=base_url()?>ap_type/view/delete/<?=$ap_type->rowID?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('delete')?>"><i class="fa fa-trash-o"></i></a>
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
			echo form_open(base_url().'ap_type/create'); ?>
			<?php echo validation_errors(); ?>
	
		<div class="form-group form-md-line-input">
			<label><?=lang('ap_type_code')?> <span class="text-danger">*</span></label>
			<input type="text" name="ap_type_code" placeholder="Input Code"  maxlength="6"  autocomplete="off" class="input-sm form-control" required>
		</div>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('invoice_type_name')?> <span class="text-danger">*</span></label>
			<input type="text" name="ap_type_name" placeholder="Input Name"  maxlength="50"  autocomplete="off" class="input-sm form-control" required>
		</div>
		
		<button type="submit" class="btn btn-sm btn-success"><?=lang('add_ap_type')?></button>
		<hr>
		</form>
   
		</section>
	</section>   
</aside>
<!-- /.aside -->
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>