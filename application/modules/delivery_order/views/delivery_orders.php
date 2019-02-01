<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <aside>
      <section class="vbox">
        <header class="header bg-white b-b b-light">
          <a href="<?php echo base_url().'delivery_order/create'; ?>"  class="btn btn-sm green pull-right"><i class="fa fa-plus"></i> <?=lang('new_delivery_order')?></a>
          <p><?=lang('delivery_order_details')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive"><?php echo validation_errors(); ?>
                  <table id="tbl-projects" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th><?=lang('delivery_order_no.')?> </th>
						<th><?=lang('delivery_order_reg_no')?> </th>
						<th><?=lang('delivery_order_date')?> </th>
						<th><?=lang('delivery_order_debtor')?> </th>
						<th><?=lang('delivery_order_jo_no')?> </th>
						<th><?=lang('delivery_order_wo_no')?> </th>
						<th><?=lang('delivery_order_driver')?> </th>
						<th><?=lang('actions')?></th>
                      </tr> 
					</thead>
					<tbody>
                      <?php
                      if (!empty($delivery_orders)) {
                      foreach ($delivery_orders as $delivery_order) { ?>
                      <tr>
						<td><?=$delivery_order['do_no']?></td>
						<td><?=$delivery_order['reg_no']?></td>
						<td><?=$delivery_order['deliver_date']?></td>
						<td><?=$delivery_order['debtor_code']?>&nbsp;-&nbsp;<?=$delivery_order['debtor_name']?></td>
						<td><?=$delivery_order['jo_no']?></td>
						<td><?=$delivery_order['wo_no']?></td>
						<td><?=$delivery_order['driver_code']?>&nbsp;-&nbsp;<?=$delivery_order['driver_name']?></td>
                        <td>
					  	<a href="<?=base_url()?>delivery_order/update/<?=$delivery_order['year']?>/<?=$delivery_order['month']?>/<?=$delivery_order['code']?>" class="btn btn-default btn-xs" title="<?=lang('edit')?>"><i class="fa fa-edit"></i> </a>
                        <a href="<?=base_url()?>delivery_order/view/delete/<?=$delivery_order['year']?>/<?=$delivery_order['month']?>/<?=$delivery_order['code']?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('delete')?>"><i class="fa fa-trash-o"></i></a>
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
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>