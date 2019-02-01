<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <aside>
      <section class="vbox">
        <header class="header bg-white b-b b-light">
          <a href="<?php echo base_url().'finance/create_cash_advance'; ?>"  class="btn btn-sm green pull-right"><i class="fa fa-plus"></i>  <?=lang('new')?> <?=lang('cash_advance')?></a>
          <p><?=lang('cash_advance_list')?></p>
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
                        <th><?=lang('cash_advance_no')?></th>
						<th><?=lang('date')?></th>
						<th><?=lang('driver')?>/<?=lang('employee')?> Name</th>
						<th><?=lang('fare_trip_no')?></th>
						<th><?=lang('cash_advance_amt')?></th>
						<th><?=lang('cash_advance_alloc')?></th>
						<th><?=lang('balance')?></th>
                      </tr> 
					</thead>
					<tbody>
                      <?php
                      if (!empty($cash_advance_lists)) {
                      foreach ($cash_advance_lists as $cash_advance_list) { ?>
                      <tr>
						  <td>
							  <div class="btn-group">
								<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
								 <?=lang('options')?>
								<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="<?=base_url()?>finance/view_cash_advance/<?=$cash_advance_list['year']?>/<?=$cash_advance_list['month']?>/<?=$cash_advance_list['code']?>"><i class="fa fa-copy"></i>  <?=lang('copy_option')?></a></li>
									<li><a href="<?=base_url()?>finance/update_cash_advance/<?=$cash_advance_list['year']?>/<?=$cash_advance_list['month']?>/<?=$cash_advance_list['code']?>"><i class="fa fa-pencil"></i>  <?=lang('update_option')?></a></li>
									<li><a href="<?=base_url()?>finance/delete_cash_advance/<?=$cash_advance_list['year']?>/<?=$cash_advance_list['month']?>/<?=$cash_advance_list['code']?>" data-toggle="ajaxModal"><i class="fa fa-trash-o"></i>  <?=lang('delete_option')?></a></li>
								</ul>
							  </div>
							</td>					  
							<td><?=$cash_advance_list['advance_no']?></td>
							<td style="width:10%"><?=$cash_advance_list['advance_date']?></td>
							<td><?=$cash_advance_list['debtor_code']?> - <?=$cash_advance_list['debtor_name']?></td>
							<td><?=$cash_advance_list['fare_trip_no']?></td>
							<td style="text-align: right;"><?= number_format($cash_advance_list['advance_amount'],2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
							<td style="text-align: right;"><?= number_format($cash_advance_list['advance_allocation'],2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
							<td style="text-align: right;"><?= number_format($cash_advance_list['advance_balance'],2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
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