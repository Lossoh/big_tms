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
                <a class="btn btn-sm green" onclick="add_koordinat_poi()"><i class="fa fa-plus"></i> <?=lang('new_koordinat_poi')?></a>
              <?php
              }
              if($this->user_profile->get_user_access('PrintLimited') == 1 || $this->user_profile->get_user_access('PrintUnlimited') == 1 || 
                 $this->user_profile->get_user_access('PrintOne') == 1 || $this->user_profile->get_user_access('PrintTwo') == 1){
              ?>                              
                <a class="btn btn-sm red" onclick="koordinat_poi_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
                <a class="btn btn-sm btn-success" onclick="koordinat_poi_excel()"><i class="fa fa-file-excel-o"></i> Print Excel</a>
              <?php
              }
              ?>
            </div>
            <p class="pull-left"><?=lang('koordinat_poi')?></p>
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
                        <th width="10%"><?=lang('options')?></th>
                        <th>Location Name</th>
						<th>Latitude</th>
						<th>Longitude</th>
                      </tr> 
                    </thead> 
                    <tbody>
                      <?php
                      if (!empty($koordinat_pois)) {
                      foreach ($koordinat_pois as $koordinat_poi) { ?>
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
                                        <li><a  href="javascript:void()" title="View POI Image" onclick="view_poi_image(<?=$koordinat_poi->rowID?>,'<?=$koordinat_poi->image_url?>')"><i class="fa fa-image"></i> View POI Image</a></li>
									    <li><a  href="javascript:void()" title="<?=lang('update_option')?>" onclick="edit_koordinat_poi(<?=$koordinat_poi->rowID ?>)"><i class="fa fa-pencil"></i> <?=lang('update_option')?></a></li>
                                    <?php
                                    }
                                    if($this->user_profile->get_user_access('Deleted') == 1){
                                    ?>
                                        <li><a  href="javascript:void()" title="<?=lang('delete_option')?>" onclick="delete_koordinat_poi(<?=$koordinat_poi->rowID ?>)"><i class="fa fa-trash-o"></i> <?=lang('delete_option')?></a></li>
                                    <?php
                                    }
                                    ?>
								</ul>
							  </div>
						</td>
						<td><?=$koordinat_poi->location_name?></td>
						<td><?=$koordinat_poi->latitude?></td>
						<td><?=$koordinat_poi->longitude?></td>
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
        <h3 class="modal-title"><?=lang('new_koordinat_poi')?></h3>
      </div>
      <div class="modal-body form">
        <?=form_open('','autocomplete="off" id="form" class="form-horizontal"')?>

        <input type="hidden" name="rowID" value="">
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">Location Name<span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" class="form-control input-sm" name="location_name" id="location_name" placeholder="Location Name" maxlength="150" />
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">Latitude</label>
            <div class="col-lg-8">
                <input type="text" class="form-control input-sm" name="latitude" id="latitude" placeholder="Ex : -6.215527" onkeyup="IsNumericOnly(this)" />
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">Longitude</label>
            <div class="col-lg-8">
                <input type="text" class="form-control input-sm" name="longitude" id="longitude" placeholder="Ex : 106.40832" onkeyup="IsNumericOnly(this)" />
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">Icon Map</label>
            <div class="col-lg-8">
                <select class="form-control input-sm" name="icon_url" id="icon_url">
                    <option value="http://chart.apis.google.com/chart?chst=d_map_pin_icon&chld=home|990000|000000">Pull</option>
                    <option value="http://maps.google.com/mapfiles/kml/pal3/icon21.png">Customer</option>
                    <option value="http://maps.google.com/mapfiles/ms/micons/ferry.png">Port</option>
                </select>
            </div>
        </div>
        <?=form_close()?>
        </div>
        <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_koordinat_poi()" class="btn green">Save</button>
            <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
        </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modal_form_upload" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <?= form_open(base_url().'koordinat_poi/upload_image','autocomplete="off" id="form" class="form-horizontal" enctype="multipart/form-data"')?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title-upload">View POI Image</span></h3>
      </div>
      <div class="modal-body form">
        <input type="hidden" name="upload_rowid" value="" />
        <div class="form-group form-md-line-input">
            <div class="col-lg-12">
                <label class="control-label">Upload POI Image</label>
                <br /><br />
                <input type="file" name="userfile[]" id="userfile" class="form-control input-sm" placeholder="Image" required="" />
                <span style="font-size: 10px;color: #C00">*) File max 5 MB and must be gif, jpg, jpeg, and png formats.</span>
            </div>
        </div>
        <div class="form-group form-md-line-input">
            <div class="col-lg-12">
                <label class="control-label">Preview POI Image</label>
                <br /><br />
                <div class="text-center">
                    <img id="poi_image" class="img-responsive img-thumbnail" alt="POI Image" />
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

</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>