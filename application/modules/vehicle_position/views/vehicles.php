<script language="javascript">
$(document).ready(function(){
   $.getScript("https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyAGqAXbPVg8hBkOqq5aX3tvh5Doryc-AnY&callback=loadMap", function() {
        // No code here
   });  
});

function showPosition(police_no,status,position,gpstime,latitude,longitude)
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

<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">
              <?php
              if($this->user_profile->get_user_access('Created') == 1){
              ?>
                <a  class="btn btn-sm green" onclick="add_vehicle_position()" ><i class="fa fa-plus"></i> <?=lang('new_vehicle_position')?></a>
              <?php
              }
              if($this->user_profile->get_user_access('PrintLimited') == 1 || $this->user_profile->get_user_access('PrintUnlimited') == 1 || 
                 $this->user_profile->get_user_access('PrintOne') == 1 || $this->user_profile->get_user_access('PrintTwo') == 1){
              ?>
                  <a  class="btn btn-sm red" onclick="vehicle_position_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
                  <a  class="btn btn-sm btn-success" onclick="vehicle_position_excel()"><i class="fa fa-file-excel-o"></i> Print Excel</a>
              <?php
              }
              ?>
            </div>
            <p class="pull-left"><?=lang('vehicle_positions')?></p>
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
                            <th><?=lang('options')?></th>                        
                            <th><?=lang('vehicle_police_no')?> </th>
    						<th><?=lang('position')?> </th>
    						<th>Status</th>
    						<th><?=lang('note')?> </th>
    						<th><?=lang('date_modified')?> </th>
                          </tr> 
                        </thead> 
                        <tbody>
                          <?php
                          
                          if (!empty($vehicle_positions)) {  
                            foreach ($vehicle_positions as $vehicle) { 
                                $status = '';
                                $color = '';
                                if($vehicle->status == '11' && $vehicle->speed > 0 ){
                                    $status = 'Jalan';
                                    $color = "background-color:#5cb85c;";
                                }
                                else if($vehicle->status == '11' && $vehicle->speed <= 0 ){
                                    $status = 'Macet/Antri/Parkir';
                                    $color = "background-color:#eac545;";
                                }
                                else if($vehicle->status == '01' && $vehicle->speed <= 0 ){
                                    $status = 'Makan AKI';
                                    $color = "background-color:#57b9f8;";
                                }
                                else if($vehicle->status == '00' && $vehicle->speed <= 0 ){
                                    $status = 'Berhenti';
                                    $color = "background-color:#f94c4c;";
                                }
                                else if($vehicle->status == '10' && $vehicle->speed > 0 ){
                                    $status = 'Check Instalasi ACC & Engine';
                                    $color = "background-color:#000;";
                                }
                                else if($vehicle->status == '10' && $vehicle->speed <= 0 ){
                                    $status = 'Mohon diperiksa';
                                    $color = "background-color:#1BDAC5;";
                                }
                                else{
                                    $status = 'Data Tidak Tersedia';
                                    $color = "background-color:#B0B0B0;";
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
                                        <?php
                                        if($this->user_profile->get_user_access('Updated') == 1){
                                        ?>
    									   <li><a  href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_vehicle_position(<?=$vehicle->rowID?>)"><i class="fa fa-pencil"></i> <?=lang('update_option')?></a></li>
                                        <?php
                                        }
                                        if($this->user_profile->get_user_access('Deleted') == 1){
                                        ?>
                                            <li><a  href="javascript:void()" title="<?=lang('delete_option')?>" onclick="delete_vehicle_position(<?=$vehicle->rowID?>)"><i class="fa fa-trash-o"></i> <?=lang('delete_option')?></a></li>
                                        <?php
                                        }
                                        ?>
    								</ul>
                                    
    							  </div>
    							</td>
        						<td><?=$vehicle->police_no?></td>
        						<td>
                                <?=$vehicle->position == '' ?  "-" : ucfirst($vehicle->position)?></td>
        						<td>
                                    <?php
                                    
                                    if($vehicle->type == 'GPS'){
                                        echo "<button type='button' class='btn btn-xs btn-info' onclick=\"showPosition('".$vehicle->police_no."','".$status."','".$vehicle->latitude.",".$vehicle->longitude."','".$vehicle->time_gps."','".$vehicle->latitude."','".$vehicle->longitude."')\"><i class='fa fa-map-marker'></i></button> &nbsp; ";    
                                    }
                                    
                                    echo $status;
                                    
                                    ?>
                                </td>
        						<td><?=$vehicle->note == '' ? '-' : $vehicle->note?></td>
        						<td><?=date("d F Y H:i:s", strtotime($vehicle->date_modified))?></td>
                              </tr>
                        <?php 
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
                <select name="vehicle_id" id="vehicle_id" class="form-control" required>
				   <?php
                      if (!empty($vehicles)) {
                      foreach ($vehicles as $vehicle) { ?>
					  <option value="<?php echo $vehicle->rowID; ?>"><?php echo $vehicle->police_no; ?></option>
					<?php }}?>
    			</select>
            </div>
        </div>
              
		<div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">Status <span class="text-danger">*</span></label>
            <div class="col-md-8">
			<select name="position" id="position" class="form-control" required>
    			<option value="<?=lang('jalan')?>"><?=lang('jalan')?></option>
    			<option value="<?=lang('parkir')?>"><?=lang('parkir')?></option>
    			<option value="<?=lang('macet')?>"><?=lang('macet')?></option>
			<select>
            </div>
		</div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('note')?></label>
            <div class="col-lg-8">
                <textarea class="form-control" name="note" placeholder="<?=lang('note')?> (Optional)"></textarea>
            </div>
        </div>              
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_vehicle_position()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
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
                
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>