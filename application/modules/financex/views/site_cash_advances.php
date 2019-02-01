<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <aside>
      <section class="vbox">
        <header class="header bg-white b-b b-light">
          <a href="<?php echo base_url().'site_cash_advance/create'; ?>"  class="btn btn-sm green pull-right"><i class="fa fa-plus"></i> <?=lang('new_site_cash_advance')?></a>
          <p><?=lang('site_cash_advance_details')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive"><?php echo validation_errors(); ?>
                  <table id="tbl-projects" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th><?=lang('site_cash_advance_no')?> </th>
						<th><?=lang('site_cash_advance_date')?> </th>
						<th><?=lang('site_cash_advance_amt')?> </th>
						<th><?=lang('site_cash_advance_driveremployee')?> </th>
						<th><?=lang('site_cash_advance_debtor')?> </th>
						<th><?=lang('site_cash_advance_jo')?> </th>
						<th><?=lang('site_cash_advance_wo')?> </th>
						<th><?=lang('site_cash_advance_from')?> </th>
						<th><?=lang('site_cash_advance_to')?> </th>
						<th><?=lang('actions')?></th>
                      </tr> 
					</thead>
					<tbody>
                      <?php
                      if (!empty($site_cash_advances)) {
                      foreach ($site_cash_advances as $site_cash_advance) { ?>
                      <tr>
						<td><?=$site_cash_advance['advance_no']?></td>
						<td><?=$site_cash_advance['advance_date']?></td>
						<td>
							<?php $advance_amount=$site_cash_advance['advance_amt']; 
							echo  number_format($advance_amount,0,',','.');?>
						</td>
						<td><?=$site_cash_advance['employee_driver_code']?>&nbsp;-&nbsp;<?=$site_cash_advance['employee_driver_name']?></td>
						<td><?=$site_cash_advance['debtor_code']?>&nbsp;-&nbsp;<?=$site_cash_advance['debtor_name']?></td>
						<td><?=$site_cash_advance['jo_no']?></td>
						<td><?=$site_cash_advance['wo_no']?></td>
						<td><?=$site_cash_advance['from_code']?>&nbsp;-&nbsp;<?=$site_cash_advance['from_name']?></td>
						<td><?=$site_cash_advance['to_code']?>&nbsp;-&nbsp;<?=$site_cash_advance['to_name']?></td>
                        <td>
					  	<!--<a href="<?=base_url()?>site_cash_advance/view/update/<?=$site_cash_advance['year']?>/<?=$site_cash_advance['month']?>/<?=$site_cash_advance['code']?>" class="btn btn-default btn-xs" title="<?=lang('edit')?>"><i class="fa fa-edit"></i> </a> -->
                        <a href="<?=base_url()?>site_cash_advance/delete/<?=$site_cash_advance['year']?>/<?=$site_cash_advance['month']?>/<?=$site_cash_advance['code']?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('delete')?>"><i class="fa fa-trash-o"></i></a>
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