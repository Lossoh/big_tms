<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <aside>
      <section class="vbox">
        <header class="header bg-white b-b b-light">
          <a href="#aside" data-toggle="class:show" class="btn btn-sm green pull-right"><i class="fa fa-plus"></i> <?=lang('new_work_order')?></a>
          <p><?=lang('work_order_details')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive"><?php echo validation_errors(); ?>
                  <table id="tbl-projects" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th><?=lang('work_order_no')?> </th>
						<th><?=lang('work_order_date')?> </th>
						<th><?=lang('work_order_ref_no')?> </th>
						<th><?=lang('work_order_debtor')?> </th>
						<th><?=lang('work_order_vessel_no')?> </th>
						<th><?=lang('work_order_ex_vessel')?> </th>
						<th><?=lang('work_order_port')?> </th>
						<th><?=lang('actions')?></th>
                      </tr> 
					</thead>
					<tbody>
                      <?php
                      if (!empty($work_orders)) {
                      foreach ($work_orders as $work_order) { ?>
                      <tr>
						<td><?=$work_order['wo_no']?></td>
						<td><?=$work_order['wo_date']?></td>
						<td><?=$work_order['ref_no']?></td>
						<td><?=$work_order['debtor_code']?>&nbsp;-&nbsp;<?=$work_order['debtor_name']?></td>
						<td><?=$work_order['vessel_no']?></td>
						<td><?=$work_order['vessel_name']?></td>
						<td><?=$work_order['port_code']?>&nbsp;-&nbsp;<?=$work_order['port_code']?></td>
                        <td>
					  	<a href="<?=base_url()?>work_order/view/update/<?=$work_order['wo_no']?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('edit')?>"><i class="fa fa-edit"></i> </a>
                        <a href="<?=base_url()?>work_order/view/delete/<?=$work_order['wo_no']?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('delete')?>"><i class="fa fa-trash-o"></i></a>
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
			echo form_open(base_url().'work_order/create'); ?>
			<?php echo validation_errors(); ?>
			
		<div class="form-group form-md-line-input">
			<label><?=lang('work_order_date')?> <span class="text-danger">*</span></label>
			<input type="text" name="work_order_date" placeholder="yyyy-mm-dd" autocomplete="off" class="input-sm form-control" required>
		</div>
	
		<div class="form-group form-md-line-input">
			<label><?=lang('work_order_ref_no')?> <span class="text-danger">*</span></label>
			<input type="text" name="work_order_ref_no" placeholder="Input Ref No" autocomplete="off" class="input-sm form-control" required>
		</div>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('work_order_debtor')?> <span class="text-danger">*</span></label>
			<select name="work_order_debtor" class="form-control" required>
			<option value ="0">Select</option>
				   <?php
                      if (!empty($debtors)) {
                      foreach ($debtors as $debtor) { ?>
					  <option value="<?php echo $debtor->rowID; ?>"><?php echo $debtor->debtor_cd; ?>&nbsp;-&nbsp;<?php echo $debtor->debtor_name; ?></option>
					<?php }}?>
			</select>
		</div>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('work_order_vessel_no')?></label>
			<input type="text" name="work_order_vessel_no" placeholder="Input Vessel No" autocomplete="off" class="input-sm form-control" required>
		</div>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('work_order_ex_vessel')?> <span class="text-danger">*</span></label>
			<input type="text" name="work_order_ex_vessel" placeholder="Input Ex. Vessel" autocomplete="off" class="input-sm form-control" required>
		</div>
		
		<div class="form-group form-md-line-input">
			<label><?=lang('work_order_port')?><span class="text-danger">*</span></label>
			<select name="work_order_port" class="form-control" required>
			<option value ="0">Select</option>
				   <?php
                      if (!empty($ports)) {
                      foreach ($ports as $port) { ?>
					  <option value="<?php echo $port->rowID; ?>"><?php echo $port->port_cd; ?>&nbsp;-&nbsp;<?php echo $port->descs; ?></option>
					<?php }}?>
			</select>
		</div>
			
		<button type="submit" class="btn btn-sm btn-success"><?=lang('add_work_order')?></button>
		<hr>
		</form>
   
		</section>
	</section>   
</aside> 
<!-- /.aside -->
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>