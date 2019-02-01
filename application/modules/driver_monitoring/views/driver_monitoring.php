<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">&nbsp;</div>
            <p class="pull-left"><?=lang('driver_monitoring')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive">
                  <table class="table table-striped table-hover b-t b-light text-sm tbl-data">
                    <thead>
                      <tr>
                        <th style="text-align:center;vertical-align: middle;" rowspan="2"><?=lang('debtor_name')?></th>
                        <th style="text-align:center" colspan="2"><?=date('d-m-Y')?></th>
                        <th style="text-align:center"><?=date('d-m-Y',strtotime('-1 days'))?></th>
                        <th style="text-align:center"><?=date('d-m-Y',strtotime('-2 days'))?></th>
                      </tr> 
                      <tr>
                        <th style="text-align:center" width="15%">CA</th>
                        <th style="text-align:center" width="15%">GPS</th>
                        <th style="text-align:center" width="15%">CA</th>
                        <th style="text-align:center" width="15%">CA</th>
                      </tr> 
                    </thead> 
                    <tbody>
                    <?php
                    if (!empty($debtors)) {
                      $day1 = date('Y-m-d');
                      $day2 = date('Y-m-d',strtotime('-1 days'));
                      $day3 = date('Y-m-d',strtotime('-2 days'));
                      
                      foreach ($debtors as $debtor) {                       
                         // Today
                         $get_monitor_day1 = $this->driver_monitoring_model->get_monitoring_data_alloc_by_date_debtor($debtor->rowID,$day1);
                         $trip_day1 = count($get_monitor_day1);
                         $date_ca1 = 0;
                         
                         foreach($get_monitor_day1 as $row1){
                            $from_time = strtotime($row1->date_ca);
                            $to_time = strtotime($row1->date_rea);
                            $minutes = round(abs($to_time - $from_time) / 60);
                            $date_ca1 += round($minutes/60, 2);
                         }
                         
                         // Yesterday
                         $get_monitor_day2 = $this->driver_monitoring_model->get_monitoring_data_alloc_by_date_debtor($debtor->rowID,$day2);
                         $trip_day2 = count($get_monitor_day2);
                         $date_ca2 = 0;
                         
                         foreach($get_monitor_day2 as $row2){
                            $from_time = strtotime($row2->date_ca);
                            $to_time = strtotime($row2->date_rea);
                            $minutes = round(abs($to_time - $from_time) / 60);
                            $date_ca2 += round($minutes/60, 2);
                         }
                         
                         // Last 3 days
                         $get_monitor_day3 = $this->driver_monitoring_model->get_monitoring_data_alloc_by_date_debtor($debtor->rowID,$day3);
                         $trip_day3 = count($get_monitor_day3);
                         $date_ca3 = 0;
                         
                         foreach($get_monitor_day3 as $row3){
                            $from_time = strtotime($row3->date_ca);
                            $to_time = strtotime($row3->date_rea);
                            $minutes = round(abs($to_time - $from_time) / 60);
                            $date_ca3 += round($minutes/60, 2);
                         }
                         
                    ?>
                          <tr>
    						<td><?=$debtor->debtor_name?></td>
                            <td><?=$trip_day1.' ('.$date_ca1.' hours)'?></td>
                            <td></td>
                            <td><?=$trip_day2.' ('.$date_ca2.' hours)'?></td>
                            <td><?=$trip_day3.' ('.$date_ca3.' hours)'?></td>
                          </tr>
                    <?php 
                        } 
                    } 
                    ?>
                    
                    
                  </tbody>
                </table>

              </div>
            </section>            
          </div>
        </div>
      </section>

    </section>
  <!--</aside>-->
  <!-- /.aside -->

</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>