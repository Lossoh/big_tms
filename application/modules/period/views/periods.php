<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <aside>
      <section class="vbox">
        <header class="header bg-white b-b b-light">
          <i class="fa fa-plus"></i></a>
          <p><?=lang('period_details')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive"><?php echo validation_errors(); ?>
                  <table id="tbl-projects" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th><?=lang('period_year')?></th>
                        <th><?=lang('period_month')?> </th>
						<th><?=lang('period_startdate')?> </th>
						<th><?=lang('period_enddate')?> </th>
						<th><?=lang('period_status')?> </th>
                      </tr> </thead> <tbody>
                      <?php
					  $i=0;
                      if (!empty($periods)) {
                      foreach ($periods as $period) { $i++;?>
                      <tr>
                        <td><?=$period->year?></a></td>
						<td><?=$period->month?></td>
						<td><?=$period->start_date?></td>
						<td><?=$period->end_date?></td>
						<td>
							<input type="hidden" name="periode_id" id="periode_id_<?php echo $i;?>" value="<?=$period->rowID?>">
							<input  type="checkbox" name="period_status" id="period_status_<?php echo $i;?>" onClick="saveToDatabase(this,<?=$period->rowID?>,<?php echo $i;?>)" <?php if($period->close_status=='Y'){echo "checked";} else {echo "unchecked";} ?>>
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