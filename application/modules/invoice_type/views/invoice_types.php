<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <aside>
      <section class="vbox">
        <header class="header bg-white b-b b-light">
          <a href="#aside" data-toggle="class:show" class="btn btn-sm green pull-right"><i class="fa fa-plus"></i> <?=lang('new_invoice_type')?></a>
          <p><?=lang('invoice_type_details')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive"><?php echo validation_errors(); ?>
                  <table id="tbl-projects" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th><?=lang('invoice_type_code')?> </th>
						<th><?=lang('invoice_type_name')?> </th>
						<th><?=lang('actions')?> </th>
                      </tr> </thead> <tbody>
                      <?php
                      if (!empty($invoice_types)) {
                      foreach ($invoice_types as $invoice_type) { ?>
                      <tr>
						<td><?=$invoice_type->inv_type_cd?></td>
						<td><?=$invoice_type->inv_type_name?></td>
                        <td>
					  	<a href="<?=base_url()?>invoice_type/view/update/<?=$invoice_type->rowID?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('edit')?>"><i class="fa fa-edit"></i> </a>
                        <a href="<?=base_url()?>invoice_type/view/delete/<?=$invoice_type->rowID?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('delete')?>"><i class="fa fa-trash-o"></i></a>
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
			echo form_open(base_url().'invoice_type/create'); ?>
			<?php echo validation_errors(); ?>
	
		<div class="form-group form-md-line-input">
			<label><?=lang('invoice_type_code')?> <span class="text-danger">*</span></label>
			<input type="text" name="invoice_type_code" placeholder="Input Code"  maxlength="20"  autocomplete="off" class="input-sm form-control" required>
		</div>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('invoice_type_name')?> <span class="text-danger">*</span></label>
			<input type="text" name="invoice_type_name" placeholder="Input Name"  maxlength="20"  autocomplete="off" class="input-sm form-control" required>
		</div>
		
		<button type="submit" class="btn btn-sm btn-success"><?=lang('add_invoice_type')?></button>
		<hr>
		</form>
   
		</section>
	</section>   
</aside>
<!-- /.aside -->
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>