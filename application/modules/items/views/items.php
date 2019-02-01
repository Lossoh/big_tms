<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <aside>
      <section class="vbox">
        <header class="header bg-white b-b b-light">
          <a href="#aside" data-toggle="class:show" class="btn btn-sm green pull-right"><i class="fa fa-plus"></i> <?=lang('new_item')?></a>
          <p><?=lang('registered_items')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive"><?php echo validation_errors(); ?>
                  <table id="tbl-projects" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th><?=lang('item_ref')?></th>
                        <th><?=lang('item_name')?> </th>
                        <th><?=lang('tolerance')?></th>
						<th><?=lang('options')?></th>
                      </tr> </thead> <tbody>
                      <?php
                      if (!empty($items)) {
                      foreach ($items as $item) { ?>
                      <tr>
                        <td><?=$item->item_ref?></a></td>
                      <td><?=$item->item_name?></td>
                      <td><?=$item->tolerance?></td>
                      <td>
					  	<a href="<?=base_url()?>items/view/update/<?=$item->item_id?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('edit')?>"><i class="fa fa-edit"></i> </a>
                        <a href="<?=base_url()?>items/view/delete/<?=$item->item_id?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('delete')?>"><i class="fa fa-trash-o"></i></a>
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
		echo form_open(base_url().'items/create'); ?>
		<?php echo validation_errors(); ?>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('item_ref')?> <span class="text-danger">*</span></label>
			<input type="text" name="item_ref" placeholder="Input Item Reference" value="<?=set_value('item_ref')?>" class="input-sm form-control">
		</div>
		<div class="form-group form-md-line-input">
			<label><?=lang('item_name')?> <span class="text-danger">*</span></label>
			<input type="text" placeholder="Input Item Name" name="item_name" value="<?=set_value('item_name')?>" class="input-sm form-control">
		</div>
		<div class="form-group form-md-line-input">
			<label><?=lang('tolerance')?> </label>
			<input type="text" placeholder="<?=lang('tolerance')?> " value="<?=set_value('tolerance')?>" name="tolerance"  class="input-sm form-control">
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