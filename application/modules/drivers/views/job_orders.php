<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <aside>
      <section class="vbox">
        <header class="header bg-white b-b b-light">
          <a href="<?php echo base_url().'job_order/create_job_order'; ?>"  class="btn btn-sm green pull-right"><i class="fa fa-plus"></i><?=lang('new_job_order')?></a>
          <p><?=lang('job_order_list')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive"><?php echo validation_errors(); ?>
                  <table id="tbl-orders" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
						<th><?=lang('options')?></th>
                        <th><?=lang('job_order_no')?> </th>
						<th><?=lang('job_order_date')?> </th>
						<th><?=lang('debtor')?> </th>
						<th><?=lang('job_order_po_spk_no')?> </th>
						<th><?=lang('job_order_so_no')?> </th>
						<th><?=lang('vessel_name')?> </th>
						<th><?=lang('port_name')?> </th>
						<th><?=lang('fare_trip_no')?> </th>
                      </tr> 
					</thead>
					<tbody>
                      <?php
                      if (!empty($job_orders)) {
                      foreach ($job_orders as $job_order) { ?>
                      <tr>
						  <td>
							  <div class="btn-group">
								<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
								 <?=lang('options')?>
								<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="<?=base_url()?>job_order/copy_job_order/<?=$job_order['year']?>/<?=$job_order['month']?>/<?=$job_order['code']?>"><i class="fa fa-copy"></i>  <?=lang('copy_option')?></a></li>
									<li><a href="<?=base_url()?>job_order/update_job_order/<?=$job_order['year']?>/<?=$job_order['month']?>/<?=$job_order['code']?>"><i class="fa fa-pencil"></i>  <?=lang('update_option')?></a></li>
									<li><a href="<?=base_url()?>job_order/delete_job_order/<?=$job_order['year']?>/<?=$job_order['month']?>/<?=$job_order['code']?>" data-toggle="ajaxModal"><i class="fa fa-trash-o"></i>  <?=lang('delete_option')?></a></li>
								</ul>
							  </div>
							</td>					  
							<td><?=$job_order['jo_no']?></td>
							<td><?=$job_order['jo_date']?></td>
							<td><?=$job_order['debtor_code']?> - <?=$job_order['debtor_name']?></td>
							<td><?=$job_order['po_spk_no']?></td>
							<td><?=$job_order['so_no']?></td>
							<td><?=$job_order['vessel_no']?> - <?=$job_order['vessel_name']?></td>
							<td><?=$job_order['port_code']?> - <?=$job_order['port_name']?></td>
							<td><?=$job_order['fare_trip_no']?></td>
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