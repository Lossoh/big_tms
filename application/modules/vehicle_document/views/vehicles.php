<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">
              <a  class="btn btn-sm btn-info" onclick="vehicle_document_filter()" href="#" data-toggle="modal" data-target="#modalFilter" ><i class="glyphicon glyphicon-filter"></i> <?=lang('filter_by')?></a>
              <?php
              if($this->user_profile->get_user_access('PrintLimited') == 1 || $this->user_profile->get_user_access('PrintUnlimited') == 1 || 
                 $this->user_profile->get_user_access('PrintOne') == 1 || $this->user_profile->get_user_access('PrintTwo') == 1){
              ?>
                  <a  class="btn btn-sm red" onclick="vehicle_document_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
                  <a  class="btn btn-sm btn-success" onclick="vehicle_document_excel()"><i class="fa fa-file-excel-o"></i> Print Excel</a>
              <?php
              }
              ?>
            </div>
            <p class="pull-left"><?=lang('vehicle_documents')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title pull-left"><?=lang('stnk')?></div>
                    <div class="pull-right"><?=lang('periode_expired')." : <b>".$periode."</b>"?></div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive"><?php echo validation_errors(); ?>
                      <table id="tbl-projects" class="table table-striped table-hover b-t b-light text-sm">
                        <thead>
                          <tr>
                            <th><?=lang('vehicle_police_no')?> </th>
    						<th><?=lang('vehicle_type')?> </th>
    						<th><?=lang('vehicle_gps')?> </th>
    						<th><?=lang('vehicle_driver')?> </th>
                		    <th><?=lang('no_stnk')?></th>
                		    <th><?=lang('expired_stnk')?></th>
                		    <th><?=lang('status_stnk')?></th>
                		    <th><?=lang('no_bpkb')?></th>
                		    <th><?=lang('status_bpkb')?></th>
                		    <th><?=lang('no_insurance')?></th>
                		    <th><?=lang('expired_insurance')?></th>
                		    <th><?=lang('status_insurance')?></th>
                		    <th><?=lang('no_kiu')?></th>
                		    <th><?=lang('expired_kiu')?></th>
                		    <th><?=lang('status_kiu')?></th>
                          </tr> 
                        </thead> 
                        <tbody>
                          <?php
                          if (!empty($vehicles_stnk)) {
                          foreach ($vehicles_stnk as $vehicle) { ?>
                          <tr>
    						<td><?=$vehicle->police_no?></td>
    						<td><?=$vehicle->vehicle_type?></td>
    						<td><?=$vehicle->gps_no?></td>
    						<td><?=$vehicle->driver_code?>&nbsp;-&nbsp;<?=$vehicle->driver_name?></td>
    						<td><?=strtoupper($vehicle->no_stnk)?></td>
    						<td><?=date("d F Y",strtotime($vehicle->expired_stnk))?></td>
    						<td><?=ucfirst($vehicle->status_stnk)?></td>
    						<td><?=$vehicle->no_bpkb?></td>
    						<td><?=ucfirst($vehicle->status_bpkb)?></td>
    						<td><?=strtoupper($vehicle->no_insurance)?></td>
    						<td><?=date("d F Y",strtotime($vehicle->expired_insurance))?></td>
    						<td><?=ucfirst($vehicle->status_insurance)?></td>
    						<td><?=strtoupper($vehicle->no_kiu)?></td>
    						<td><?=date("d F Y",strtotime($vehicle->expired_kiu))?></td>
    						<td><?=ucfirst($vehicle->status_kiu)?></td>
                        </tr>
                        <?php } } ?>
                        
                        
                      </tbody>
                    </table>
    
                  </div>
               </div>
            </div> 
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="panel-title pull-left"><?=lang('kir')?></div>
                    <div class="pull-right"><?=lang('periode_expired')." : <b>".$periode."</b>"?></div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive"><?php echo validation_errors(); ?>
                      <table id="items" class="table table-striped b-t b-light text-sm">
                        <thead>
                          <tr>
                            <th><?=lang('vehicle_police_no')?> </th>
    						<th><?=lang('vehicle_type')?> </th>
    						<th><?=lang('vehicle_gps')?> </th>
    						<th><?=lang('vehicle_driver')?> </th>
                		    <th><?=lang('no_kir')?></th>
                		    <th><?=lang('expired_kir')?></th>
                		    <th><?=lang('status_kir')?></th>
                		    <th><?=lang('no_bpkb')?></th>
                		    <th><?=lang('status_bpkb')?></th>
                		    <th><?=lang('no_insurance')?></th>
                		    <th><?=lang('expired_insurance')?></th>
                		    <th><?=lang('status_insurance')?></th>
                		    <th><?=lang('no_kiu')?></th>
                		    <th><?=lang('expired_kiu')?></th>
                		    <th><?=lang('status_kiu')?></th>
                          </tr> 
                        </thead> 
                        <tbody>
                          <?php
                          if (!empty($vehicles_kir)) {
                          foreach ($vehicles_kir as $kir) { ?>
                          <tr>
    						<td><?=$kir->police_no?></td>
    						<td><?=$kir->vehicle_type?></td>
    						<td><?=$kir->gps_no?></td>
    						<td><?=$kir->driver_code?>&nbsp;-&nbsp;<?=$kir->driver_name?></td>
    						<td><?=strtoupper($kir->no_kir)?></td>
    						<td><?=date("d F Y",strtotime($kir->expired_kir))?></td>
    						<td><?=ucfirst($kir->status_kir)?></td>
    						<td><?=$kir->no_bpkb?></td>
    						<td><?=ucfirst($kir->status_bpkb)?></td>
    						<td><?=strtoupper($kir->no_insurance)?></td>
    						<td><?=date("d F Y",strtotime($kir->expired_insurance))?></td>
    						<td><?=ucfirst($kir->status_insurance)?></td>
    						<td><?=strtoupper($kir->no_kiu)?></td>
    						<td><?=date("d F Y",strtotime($kir->expired_kiu))?></td>
    						<td><?=ucfirst($kir->status_kiu)?></td>
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

    <!-- Modal -->
    <div class="modal fade" id="modalFilter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?=form_open(base_url().'vehicle_document/set_filter','autocomplete="off" id="form" class="form-horizontal"')?>
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?=lang('filter_by')?></h4>
          </div>
          <div class="modal-body">
                <div class="form-group form-md-line-input row">
                    <label class="col-lg-4 control-label"><?=lang('filter_option')?> </label>
                    <div class="col-lg-8">
                        <select name="filter_type" id="filter_type" class="form-control">
                            <option value="All">All</option>
                            <option value="Periode">Periode</option>
                        </select>
                    </div>
                </div>
                <div class="form-group form-md-line-input row" id="periode_filter">
                    <label class="col-lg-4 control-label"><?=lang('periode_expired')?> </label>
                    <div class="col-lg-8">
                        <div class="input-group input-daterange">
                            <input type="text" name="start_date" id="start_date" class="form-control tanggal_datetimepicker" placeholder="<?=lang('start_date')?>" value="<?=date('d-m-Y', strtotime($start_date))?>">
                            <span class="input-group-addon">to</span>
                            <input type="text" name="end_date" id="end_date" class="form-control tanggal_datetimepicker" placeholder="<?=lang('end_date')?>" value="<?=date('d-m-Y', strtotime($end_date))?>">
                        </div>
                    </div>
                </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Close</button>
          </div>
          </form>
        </div>
      </div>
    </div>
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>