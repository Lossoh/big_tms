<section id="content">
  <section class="hbox stretch">
 
<!-- .aside -->
<!--<aside>-->
<section class="vbox">
    <header class="header bg-white b-b b-light">
        <div class="pull-right" style="margin-top: 10px;">&nbsp;</div>
        <p class="pull-left"><?=lang('upload_driver_attendance')?></p>
    </header>
    <section class="scrollable wrapper">
      <div class="row">
        <div class="col-lg-12">
          <?php
          if($this->session->flashdata('success') != ''){
          ?>
          <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong><?=$this->session->flashdata('success')?></strong><br /> 
          </div>
          <?php
          }
          
          if($this->session->flashdata('error') != ''){
          ?>
          <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong><?=$this->session->flashdata('error')?></strong><br /> 
          </div>
          <?php
          }
          
          ?>
          <div class="panel panel-primary">
            <div class="panel-body">
                <?=form_open(base_url('upload_driver_attendance/upload_attendance'),'autocomplete="off" id="form" name="form" class="form-horizontal" enctype="multipart/form-data"')?>
                <div class="form-group form-md-line-input row" id="departement">
					<label class="col-md-3 control-label">Departement Name</label>
                    <div class="col-md-3">
                        <select class="form-control input-sm all_select2" name="terminal_id" id="terminal_id">
                            <?php
                            if(count($departements) > 0){
                                foreach($departements as $row_dep){
                                    echo '<option value="'.$row_dep->rowID.'">'.$row_dep->dep_name.'</option>';
                                }
                            }
                            ?>
                        </select>
    				</div>
                </div>
                <div class="form-group form-md-line-input row">
                    <label class="col-md-3 control-label">Upload File</label>
                    <div class="col-md-3">
                        <input type="file" name="file" id="file" class="form-horizontal" />                    
                    </div>
                </div>
                <br />
                <div class="form-group form-md-line-input row">
                    <label class="col-md-3 control-label">&nbsp;</label>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-sm green" form="form"><i class="fa fa-upload"></i> Upload</button>
                    </div>
                </div>                
                <p>&nbsp;</p>
                
                <?=form_close()?>
            </div>
          </div>            
        </div>
      </div>
    </section>

</section>
  <!--</aside>-->
  
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>