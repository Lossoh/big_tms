<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">
              <a  class="btn btn-sm green" onclick="add_vehicle()"><i class="fa fa-plus"></i> <?=lang('new_vehicle')?></a>
              <a  class="btn btn-sm red" onclick="vehicle_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
              <a  class="btn btn-sm btn-success" onclick="vehicle_excel()"><i class="fa fa-file-excel-o"></i> Print Excel</a>
            </div>
            <p class="pull-left"><?=lang('vehicle_details')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <?php
              if($this->session->flashdata('success') != ''){
              ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Success!</strong> <br /> <?=$this->session->flashdata('success')?>
                </div>
              <?php
              }
              else if($this->session->flashdata('error') != ''){
              ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Error!</strong> <?=$this->session->flashdata('error')?>
                </div>
              <?php
              }
              ?>
              <section class="panel panel-default">
                <div class="table-responsive"><?php echo validation_errors(); ?>
                  <table id="tbl-projects" class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th><?=lang('options')?></th>
                        <th><?=lang('vehicle_police_no')?> </th>
                        <th><?=lang('vehicle_code')?> </th>
						<th><?=lang('vehicle_gps')?> </th>
                        <th><?=lang('dep_name')?> </th>
						<th><?=lang('vehicle_driver')?> </th>
            		    <th><?=lang('no_stnk')?></th>
            		    <th><?=lang('no_kir')?></th>
            		    <th><?=lang('no_bpkb')?></th>
            		    <th><?=lang('no_insurance')?></th>
            		    <th><?=lang('no_kiu')?></th>
                      </tr> 
                    </thead> 
                    <tbody>
                      <?php
                      if (!empty($vehicles)) {
                      foreach ($vehicles as $vehicle) { 
                        $vehicle_position = $this->vehicle_model->get_position_vehicle_by_row_id($vehicle->rowID);
                        $status = '';
                        $color = '';
                        if($vehicle_position->status == '11' && $vehicle_position->speed > 0 ){
                            $status = 'Jalan';
                            $color = "background-color:#5cb85c;";
                        }
                        else if($vehicle_position->status == '11' && $vehicle_position->speed <= 0 ){
                            $status = 'Macet/Antri/Parkir';
                            $color = "background-color:#eac545;";
                        }
                        else if($vehicle_position->status == '01' && $vehicle_position->speed <= 0 ){
                            $status = 'Makan AKI';
                            $color = "background-color:#57b9f8;";
                        }
                        else if($vehicle_position->status == '00' && $vehicle_position->speed <= 0 ){
                            $status = 'Berhenti';
                            $color = "background-color:#f94c4c;";
                        }
                        else if($vehicle_position->status == '10' && $vehicle_position->speed > 0 ){
                            $status = 'Check Instalasi ACC & Engine';
                            $color = "background-color:#000;";
                        }
                        else if($vehicle_position->status == '10' && $vehicle_position->speed <= 0 ){
                            $status = 'Mohon diperiksa';
                            $color = "background-color:#1BDAC5;";
                        }
                        else{
                            $status = 'Data Tidak Tersedia';
                            $color = "background-color:#B0B0B0;";
                        }
                        
                        if($status != 'Data Tidak Tersedia'){
                            if(date('Y-m-d',strtotime($vehicle_position->datetime_gps)) != date('Y-m-d')){
                                $status = 'Out Of The Date';
                                $color = "background-color:#B0B0B0;";
                            }
                        }
                      ?>
                      <tr>
                        <td>
						  <div class="btn-group">
							<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
							 <?=lang('options')?>
							<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
                                <li><a  href="javascript:void()" title="View Vehicle Photo" onclick="view_vehicle_photo(<?=$vehicle->rowID?>,'<?=$vehicle->police_no?>','<?=$vehicle->vehicle_photo?>')"><i class="fa fa-image"></i> View Vehicle Photo</a></li>
								<li><a  href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_vehicle(<?=$vehicle->rowID?>)"><i class="fa fa-pencil"></i> <?=lang('update_option')?></a></li>
                                <li><a  href="javascript:void()" title="<?=lang('delete_option')?>" onclick="delete_vehicle(<?=$vehicle->rowID?>)"><i class="fa fa-trash-o"></i> <?=lang('delete_option')?></a></li>
							</ul>
						  </div>
						</td>
						<td align="center">
                            <?php
                            $star = '';
                            if($vehicle->vehicle_photo == ''){
                                $star = '*';
                            }
                            
                            $speed = empty($vehicle_position->speed) ? 0 : $vehicle_position->speed;
                            
                            echo "<a href='javascript:void()' title='".$status."' onclick=\"showDetailPositionVehicle('".$vehicle->rowID."')\">
                                    <span class='badge' style='".$color."'>".$vehicle->police_no.' '.$star."</span></a>
                                <br>".$speed.' km/h';    
                            ?>
                        </td>
						<td><?=$vehicle->vehicle_type?></td>
						<td><?=$vehicle->gps_no?></td>
						<td><?=$vehicle->dep_name?></td>
						<td><?=$vehicle->driver_code?>&nbsp;-&nbsp;<?=$vehicle->driver_name?></td>
                        <td><?=$vehicle->no_stnk?></td>
						<td><?=$vehicle->no_kir?></td>
						<td><?=$vehicle->no_bpkb?></td>
						<td><?=$vehicle->no_insurance?></td>
						<td><?=$vehicle->no_kiu?></td>
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
 <!-- </aside>-->
  <!-- /.aside -->


<!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog" style="width:600px;height:200px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?=lang('new_debtor_type')?></h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>

        <input type="hidden" name="rowID" value="">
        	
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('vehicle_police_no')?> <span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" class="form-control"  placeholder="XX 1234 XXX" value="" name="vehicle_police_no" id="vehicle_police_no" maxlength="12" required>
            </div>
        </div>
      
        
  		<div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('vehicle_type')?></label>
            <div class="col-md-8">
			<select name="vehicle_type" id="vehicle_type_id" class="form-control" required>
			  <option value="<?=lang('head_truck')?>"><?=lang('head_truck')?></option>
			  <option value="<?=lang('dump_truck')?>"><?=lang('dump_truck')?></option>
			  <option value="<?=lang('dump_truck_special')?>"><?=lang('dump_truck_special')?></option>
			  <option value="<?=lang('box')?>"><?=lang('box')?></option>
			  <option value="<?=lang('bak_terbuka')?>"><?=lang('bak_terbuka')?></option>
			  <option value="<?=lang('trailer')?>"><?=lang('trailer')?></option>
			  <option value="<?=lang('light_truck')?>"><?=lang('light_truck')?></option>
			  <option value="<?=lang('a2b')?>"><?=lang('a2b')?></option>
			</select>
            </div>
		</div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('vehicle_gps')?></label>
            <div class="col-lg-8">
                <input type="text" class="form-control" value="" name="vehicle_gps" placeholder="GPS ID" onkeyup="angka(this);" required>
            </div>
        </div>
        <div class="form-group form-md-line-input">
			
            <label class="col-lg-4 control-label"><?=lang('dep_name')?></label>
            <div class="col-md-8">
			<select name="dep_id" id="dep_id" class="form-control all_select2" required>
				   <?php
                      if (!empty($departments)) {
                      foreach ($departments as $department) { ?>
					  <option value="<?php echo $department->rowID; ?>"><?php echo $department->dep_name; ?></option>
					  
					<?php }}?>
			</select>
            </div>

		</div>
		<div class="form-group form-md-line-input">
			
            <label class="col-lg-4 control-label"><?=lang('vehicle_driver')?></label>
            <div class="col-md-8">
			<select name="vehicle_driver" id="vehicle_driver" class="form-control" required>
			<option value ="0">Select</option>
				   <?php
                      if (!empty($drivers)) {
                      foreach ($drivers as $driver) { ?>
					  <option value="<?php echo $driver->rowID; ?>"><?php echo $driver->debtor_cd; ?>&nbsp;-&nbsp;<?php echo $driver->debtor_name; ?></option>
					  
					<?php }}?>
			</select>
            </div>

		</div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('stnk')?></label>
            <div class="col-md-5">
                <input type="text" name="no_stnk" class="form-control" maxlength="20" placeholder="<?=lang('no_stnk')?>" style="margin-bottom:5px;" required>
                <input type="checkbox" name="status_stnk" id="status_stnk" class="form-control chk_vehicle" checked>
            </div>
            <div class="col-md-3">
                <input type="text" name="expired_stnk" class="form-control expired_vehicle" placeholder="<?=lang('expired_stnk')?>" required>
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('kir')?></label>
            <div class="col-md-5">
                <input type="text" name="no_kir" class="form-control" maxlength="20" placeholder="<?=lang('no_kir')?>" style="margin-bottom:5px" required>
                <input type="checkbox" name="status_kir" id="status_kir" class="form-control chk_vehicle" checked>
            </div>
            <div class="col-md-3">
                <input type="text" name="expired_kir" class="form-control expired_vehicle" placeholder="<?=lang('expired_kir')?>" required>
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('bpkb')?></label>
            <div class="col-md-5">
                <input type="text" name="no_bpkb" class="form-control" maxlength="20" placeholder="<?=lang('no_bpkb')?>" style="margin-bottom:5px" required>
                <input type="checkbox" name="status_bpkb" id="status_bpkb" class="form-control chk_vehicle" checked>
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('insurance')?></label>
            <div class="col-md-5">
                <input type="text" name="no_insurance" class="form-control" maxlength="20" placeholder="<?=lang('no_insurance')?>" style="margin-bottom:5px" required>
                <input type="checkbox" name="status_insurance" id="status_insurance" class="form-control chk_vehicle" checked>
            </div>
            <div class="col-md-3">
                <input type="text" name="expired_insurance" class="form-control expired_vehicle" placeholder="<?=lang('expired_insurance')?>" required>
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('kiu')?></label>
            <div class="col-md-5">
                <input type="text" name="no_kiu" class="form-control" maxlength="20" placeholder="<?=lang('no_kiu')?>" style="margin-bottom:5px" required>
                <input type="checkbox" name="status_kiu" id="status_kiu" class="form-control chk_vehicle" checked>
            </div>
            <div class="col-md-3">
                <input type="text" name="expired_kiu" class="form-control expired_vehicle" placeholder="<?=lang('expired_kiu')?>" required>
            </div>
        </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_vehicle()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

<div class="modal fade" id="modal_form_upload" role="dialog">
  <div class="modal-dialog" style="width:650px;height:200px;">
    <div class="modal-content">
      <?= form_open(base_url().'vehicle/upload_photo','autocomplete="off" id="form" class="form-horizontal" enctype="multipart/form-data"')?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title-upload">Upload Vehicle Photo - <span id="police_no_photo"></span></h3>
      </div>
      <div class="modal-body form">
        <input type="hidden" name="upload_rowid" value="" />
        <div class="form-group form-md-line-input">
            <div class="col-lg-12">
                <label class="control-label">Upload Vehicle Photo</label>
                <br /><br />
                <input type="file" name="userfile[]" id="userfile" class="form-control input-sm" placeholder="Photo" required="" />
                <span style="font-size: 10px;color: #C00">*) File max 5 MB and must be gif, jpg, jpeg, and png formats.</span>
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <div class="col-lg-12">
                <label class="control-label">Preview Vehicle Photo</label>
                <br /><br />
                <div class="text-center">
                    <img id="vehicle_photo" class="img-responsive img-thumbnail" width="500" height="150" alt="Vehicle Photo" />
                </div>
            </div>
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="submit" id="btnUpload" class="btn green">Upload</button>
        <button type="button" class="btn red" data-dismiss="modal">Close</button>
      </div>
      <?=form_close()?>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_show_detail_position" role="dialog">
  <div class="modal-dialog" style="width:50%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title-show-position">Detail Position</h3>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <p id="detail_position"></p>            
                <div id="map" style="width: 100%;height: 400px;background-color: grey;"></div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn red" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script language="javascript">
$(document).ready(function(){
   $.getScript("https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyAGqAXbPVg8hBkOqq5aX3tvh5Doryc-AnY&callback=loadMap", function() {
        // No code here
   });  
});

function showDetailPositionVehicle(vehicle_id)
{   
    var police_no = '';
    var status = '';
    var position = '';
    var gpstime = '';
    var latitude = '';
    var longitude = '';
    var url = '';
    
    $.ajax({
        url:'<?php echo base_url(); ?>finances/get_data_vehicle_position',
		type: "POST",
        data: 'vehicle_id='+vehicle_id+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        dataType:"JSON",
		success: function(data_vehicle){
            police_no = data_vehicle.police_no;
            status = data_vehicle.status;
            position = data_vehicle.position;
            gpstime = data_vehicle.time_gps;
            latitude = data_vehicle.latitude;
            longitude = data_vehicle.longitude;
            
            url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=" + position + "&sensor=false";
            
            var adress = '';
            $.getJSON(url, function (data) {
                if(data.results[0] != null){
                    adress = data.results[0].formatted_address;
                    $('#detail_position').html("<b>Police No</b> : " + police_no + "<br><b>Status</b> : " + status + "<br><b>Time</b> : " + gpstime + "<br><b>Position</b> : " + adress);
                    
                    $('#modal_show_detail_position').modal('show');    
                    loadMap(latitude,longitude);
                }
                else{
                    sweetAlert('<?=lang('information')?>','No Data Detail');   
                }    
            });
        }
    });

    
    return true;   
}

function showPositionVehicle(police_no,status,position,gpstime,latitude,longitude)
{    
    var url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=" + position + "&sensor=false";
    var adress = '';
    $.getJSON(url, function (data) {
        if(data.results[0] != null){
            adress = data.results[0].formatted_address;
            $('#detail_position').html("<b>Police No</b> : " + police_no + "<br><b>Status</b> : " + status + "<br><b>Time</b> : " + gpstime + "<br><b>Position</b> : " + adress);
            
            $('#modal_show_detail_position').modal('show');    
            loadMap(latitude,longitude);
        }
        else{
            sweetAlert('<?=lang('information')?>','No Data Detail');   
        }    
    });
    
    return true;   
}

function loadMap(lati,longi) {
  
    if(typeof(lati) == 'undefined' && typeof(longi) == 'undefined'){
        var latitude = parseFloat(0);
        var longitude = parseFloat(0);
    }
    else{
        var latitude = parseFloat(lati);
        var longitude = parseFloat(longi);
    }
     
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: {lat: latitude, lng: longitude},
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var myLatlng = new google.maps.LatLng(latitude, longitude);
    
    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title: 'Vehicle Position'
    });

    $('#modal_show_detail_position').on('shown.bs.modal', function () {
        var center = map.getCenter();
        google.maps.event.trigger(map, "resize");
        map.setCenter(center);
    });
}
</script>

</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>