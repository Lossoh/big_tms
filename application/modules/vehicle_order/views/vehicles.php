<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">
              <?php
              if($this->user_profile->get_user_access('PrintLimited') == 1 || $this->user_profile->get_user_access('PrintUnlimited') == 1 || 
                 $this->user_profile->get_user_access('PrintOne') == 1 || $this->user_profile->get_user_access('PrintTwo') == 1){
              ?>              
                <a  class="btn btn-sm red" onclick="vehicle_order_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
                <a  class="btn btn-sm btn-success" onclick="vehicle_order_excel()"><i class="fa fa-file-excel-o"></i> Print Excel</a>
              <?php
              }
              ?>
            </div>
            <p class="pull-left"><?=lang('vehicle_orders')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive"><?php echo validation_errors(); ?>
                      <table id="tbl-projects" class="table table-striped table-hover b-t b-light text-sm">
                        <thead>
                          <tr>
                            <th><?=lang('vehicle_police_no')?> </th>
    						<th><?=lang('order_number')?></th>
    						<th><?=lang('status_order')?> </th>
    						<th><?=lang('date_modified')?> </th>
                          </tr> 
                        </thead> 
                        <tbody>
                          <?php
                          if (!empty($vehicle_orders)) {
                          foreach ($vehicle_orders as $vehicle) { 
                            $get_status = $this->vehicle_order_model->get_last_status_by_vehicle($vehicle->vehicle_id);
                          ?>
                          <tr>
    						<td><?=$vehicle->police_no?></td>
    						<td><?=strtoupper($get_status->order_number)?></td>
    						<td><?=ucwords($get_status->status_order)?></td>
    						<td><?=date("d F Y H:i:s", strtotime($get_status->date_modified))?></td>
                          </tr>
                        <?php } } ?>
                        
                      </tbody>
                    </table>
    
                  </div>
               </div>
            </div> 
                       
          </div>
        </div>
      </section>

    </section>
 <!-- </aside>-->
  <!-- /.aside -->

</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>