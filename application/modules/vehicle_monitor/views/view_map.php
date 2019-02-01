<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">
              &nbsp;
            </div>
            <p class="pull-left"><?=lang('vehicle_monitor')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive" id="view_map">
                    <?php echo $map['js']; ?>
                    <?php echo $map['html']; ?>
              </div>
            </section>            
          </div>
        </div>
      </section>
      
      <div class="modal fade" id="modal_image_poi" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title-poi-image">POI Image</h3>
              </div>
              <div class="modal-body text-center">
                <br />
                <img id="poi_image" class="img-responsive img-thumbnail" alt="POI Image" src="">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn red" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>  
        
      <div class="modal fade" id="modal_image_vehicle" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title-vehicle-image">Vehicle Image</h3>
              </div>
              <div class="modal-body text-center">
                <br />
                <img id="vehicle_image" class="img-responsive img-thumbnail" alt="Vehicle Image" src="">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn red" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>  
    </section>
<!-- </aside>-->
<!-- /.aside -->

</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>

<meta http-equiv="refresh" content="<?=$this->config->item('reload_url') == '' ? '300' : $this->config->item('reload_url')?>; url=<?= base_url(); ?>vehicle_monitor" />

<script>
/*
$(function(){
    setInterval(function() {
        $("#view_map").html('');
        $.ajax({
            type: "POST",
            url : "<?php echo base_url(); ?>vehicle_monitor/view_interval_map",
        	data: '<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
            cache:false,
            success: function(result){
                $("#view_map").html(result);
            }
        });
        
    }, 15000); //300000
})
*/
</script>