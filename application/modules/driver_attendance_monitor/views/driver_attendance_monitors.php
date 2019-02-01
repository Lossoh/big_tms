<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">
              <a href="#aside" data-toggle="class:show" id="btnFilter" onclick="showFilterText()" style="color: #46b8da;">Show Filter</a> &nbsp;
            </div>
            <p class="pull-left"><?=lang('driver_attendance_monitor')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Attendance Data (08.00 - 10.00)</div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive"><?php echo validation_errors(); ?>
                      <table id="tbl_part" class="table table-striped table-hover b-t b-light text-sm">
                        <thead>
                          <tr>
                            <th width="7%"><?=lang('no')?></th>
    						<th width="20%"><?=lang('debtor_name')?></th>
    						<th>Date Time</th>
    						<th width="25%"><?=lang('actions')?></th>
                          </tr> 
                        </thead> 
                        <tbody>
                        <?php
                        if (!empty($driver_attendance_monitors_1)) {
                            $no_1 = 1;
                            foreach ($driver_attendance_monitors_1 as $row_1) { 
                        ?>
                              <tr>
        						<td><?=$no_1?></td>
        						<td><?=$row_1->debtor_name == '' ? '-' : $row_1->debtor_name?></td>
        						<td><?=date("d F Y H:i:s", strtotime($row_1->attendance_time))?></td>
                                <td>
                                    <?php
                                    $debtor_id = $row_1->debtor_id == '' ? 0 : $row_1->debtor_id;
                                    if($debtor_id > 0){
                                        $check_data_ca = $this->driver_attendance_monitor_model->get_data_ca_by_debtor($debtor_id,date("Y-m-d", strtotime($row_1->attendance_time)));
                                        if(count($check_data_ca) == 0){
                                            if($row_1->uang_makan == 0){
                                    ?>
                                                <a href="javascript:void()" title="" class="btn btn-sm btn-success" onclick="uang_makan_supir(<?=$row_1->rowID?>)" data-original-title="Uang Makan"><i class="fa fa-plus"></i> Uang Makan</a>
                                    <?php
                                            }
                                            if($row_1->stand_by == 0){
                                    ?>
                                                <a href="javascript:void()" title="" class="btn btn-sm btn-info" onclick="stand_by_supir(<?=$row_1->rowID?>)" data-original-title="Stand By"><i class="fa fa-plus"></i> Stand By</a>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php 
                            $no_1++;
                            } 
                        } 
                        ?>
                        
                      </tbody>
                    </table>
    
                  </div>
               </div>
            </div> 
                       
          </div>
        </div>
        <br />
        <div class="row">
            <div class="col-lg-12">
              <div class="panel panel-warning">
                <div class="panel-heading">
                    <div class="panel-title">Attendance Data (10.01 - 13.00)</div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive"><?php echo validation_errors(); ?>
                      <table id="tbl_material" class="table table-striped table-hover b-t b-light text-sm">
                        <thead>
                          <tr>
                            <th width="7%"><?=lang('no')?></th>
    						<th width="20%"><?=lang('debtor_name')?></th>
    						<th width="18%">Date Time</th>
    						<th>Note</th>
    						<th width="25%"><?=lang('actions')?></th>
                          </tr> 
                        </thead> 
                        <tbody>
                        <?php
                        if (!empty($driver_attendance_monitor_2)) {
                            $no_1 = 1;
                            foreach ($driver_attendance_monitor_2 as $row_1) { 
                        ?>
                              <tr>
        						<td><?=$no_1?></td>
        						<td><?=$row_1->debtor_name == '' ? '-' : $row_1->debtor_name?></td>
        						<td><?=date("d F Y H:i:s", strtotime($row_1->attendance_time))?></td>
                                <td>
                                    <div class="pull-left">
                                        <input type="text" class="form-control input-xs" style="text-align:left" name="note_<?=$row_1->rowID?>" id="note_<?=$row_1->rowID?>" value="<?=$row_1->note == '' ? '-' : $row_1->note?>" readonly="" />
                                    </div>
                                    <div class="pull-right">
                                        <div>
                                            <a href="#" onclick="editNoteAttendance(<?=$row_1->rowID?>)" id="edit_<?=$row_1->rowID?>"><i class="fa fa-edit"></i> Change</a>
                                            <a href="#" onclick="saveNoteAttendance(<?=$row_1->rowID?>)" id="save_<?=$row_1->rowID?>" style="display: none;"><i class="fa fa-save"></i> Save</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <?php
                                    $debtor_id = $row_1->debtor_id == '' ? 0 : $row_1->debtor_id;
                                    if($debtor_id > 0){
                                        $check_data_ca = $this->driver_attendance_monitor_model->get_data_ca_by_debtor($debtor_id,date("Y-m-d", strtotime($row_1->attendance_time)));
                                        if(count($check_data_ca) == 0){
                                            if($row_1->uang_makan == 0){
                                    ?>
                                                <a href="javascript:void()" title="" class="btn btn-sm btn-success" onclick="uang_makan_supir(<?=$row_1->rowID?>)" data-original-title="Uang Makan"><i class="fa fa-plus"></i> Uang Makan</a>
                                    <?php
                                            }
                                            if($row_1->stand_by == 0){
                                    ?>
                                                <a href="javascript:void()" title="" class="btn btn-sm btn-info" onclick="stand_by_supir(<?=$row_1->rowID?>)" data-original-title="Stand By"><i class="fa fa-plus"></i> Stand By</a>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php 
                            $no_1++;
                            } 
                        } 
                        ?>
                        
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

<!-- /.aside -->
<aside class="aside-xxl bg-white b-l hide" id="aside">
    <section class="vbox">
		<section class="scrollable wrapper">
            
            <?=form_open(base_url().'driver_attendance_monitor/set_filter','autocomplete="off" id="form_period" class="form-horizontal"')?>                    
            <div class="row">
                <div class="col-md-9">
                    <div class="input-group input-daterange" style="position: relative;display: inline-flex;">
                        <input type="text" name="start_date" id="start_date" class="form-control input-sm tanggal_datetimepicker" placeholder="<?=lang('start_date')?>" value="<?=date('d-m-Y', strtotime($start_date))?>">
                        <span class="input-group-addon" style="width: 50px;">to</span>
                        <input type="text" name="end_date" id="end_date" class="form-control input-sm tanggal_datetimepicker" placeholder="<?=lang('end_date')?>" value="<?=date('d-m-Y', strtotime($end_date))?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-filter"></i> Filter</button>
                </div>
            </div>
            <?=form_close()?>
        </section>
	</section>   
</aside>
<!-- /.aside -->
