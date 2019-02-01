<?php

/**
 * @author djanu
 * @copyright 2016
 */



?>

<!DOCTYPE html>
<html lang="en" class="app">
  <head>
    <meta charset="utf-8" />
    <meta name="description" content="">
    <meta name="author" content="<?=$this->config->item('site_author')?>">
    <meta name="keyword" content="<?=$this->config->item('site_desc')?>">
    <link rel="shortcut icon" href="<?=base_url()?>resource/images/favicon.ico">
    <title><?php  echo $template['title'];?></title>
    <!-- Bootstrap core CSS -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" href="<?=base_url()?>resource/css/app.v2.css" type="text/css" />
    <link rel="stylesheet" href="<?=base_url()?>resource/js/toastr/toastr.css" type="text/css" />
    <link rel="stylesheet" href="<?=base_url()?>resource/css/font.css" type="text/css" cache="false" />
    <?php 
	//if ($page == lang('projects') OR $page == lang('add_invoice') OR $this->uri->segment(3) == 'edit' OR $this->uri->segment(3) == 'add') { ?>
    <link rel="stylesheet" href="<?=base_url()?>resource/js/slider/slider.css" type="text/css" cache="false" />
    <link rel="stylesheet" href="<?=base_url()?>resource/js/datepicker/datepicker.css" type="text/css" cache="false" />
    <?php //} ?>
    <?php
    //if ($this->uri->segment(2) == 'update' OR $this->uri->segment(1) == 'messages' OR $this->uri->segment(3) == 'add' OR $this->uri->segment(3) == 'edit' OR $this->uri->segment(3) == 'send' OR $this->uri->segment(2) == 'settings') { ?>
    <?php if (isset($form)) { ?>
    <link rel="stylesheet" href="<?=base_url()?>resource/js/select2/select2.css" type="text/css" cache="false" />
    <link rel="stylesheet" href="<?=base_url()?>resource/rcswitcher-master/css/rcswitcher.css" type="text/css" cache="false" />

	<link rel="stylesheet" href="<?=base_url()?>resource/js/select2/select2-bootstrap.css">
    <?php } ?>

    <?php
    if ($this->uri->segment(2) == 'help') { ?>
    <link rel="stylesheet" href="<?=base_url()?>resource/js/intro/introjs.css" type="text/css" cache="false" />
    <?php }  ?>
    <?php
    if (isset($datatables)) { ?>
    <link rel="stylesheet" href="<?=base_url()?>resource/js/datatables/datatables.css" type="text/css" cache="false" />
	<link rel="stylesheet" href="<?=base_url()?>resource/css/dataTables.bootstrap.css" type="text/css" cache="false" />
	<link rel="stylesheet" href="<?=base_url()?>resource/css/bootstrap.min.css" type="text/css" cache="false" />
    <link rel="stylesheet" href="<?=base_url()?>resource/css/sweet-alert.css" >
    <?php }  ?>

    <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js" cache="false">
    </script>
    <script src="js/ie/respond.min.js" cache="false">
    </script>
    <script src="js/ie/excanvas.js" cache="false">
    </script> <![endif]-->
  </head>
  <body>
    <section class="vbox">
      <!--header start-->
      <?php  echo modules::run('sidebar/top_header');?>
      <!--header end-->
      <section>
        <section class="hbox stretch">
          <?php
          //if ($this->tank_auth->user_role($this->tank_auth->get_role_id()) == 'admin') {
          //echo modules::run('sidebar/admin_menu');
          //}elseif ($this->tank_auth->user_role($this->tank_auth->get_role_id()) == 'collaborator') {
         // echo modules::run('sidebar/collaborator_menu');
          //}elseif ($this->tank_auth->user_role($this->tank_auth->get_role_id()) == 'client') {
          echo modules::run('sidebar/client_menu');
          //}else{
         // echo modules::run('sidebar/general_menu');
          //}
          ?>
          <!--main content start-->
          <?php  echo $template['body'];?>
          <!--main content end-->
          <aside class="bg-light lter b-l aside-md hide" id="notes">
            <div class="wrapper">Notification
            </div> </aside>
          </section>
        </section>
      </section>
	  <script src="<?=base_url()?>resource/js/sweet-alert.js"></script>
      <script src="<?=base_url()?>resource/js/jquery-2.1.4.min.js"></script>
      <script src="<?=base_url()?>resource/js/app.v2.js"></script>
      <script src="<?=base_url()?>resource/js/charts/easypiechart/jquery.easy-pie-chart.js" cache="false"></script>
      <script src="<?=base_url()?>resource/js/charts/sparkline/jquery.sparkline.min.js" cache="false"></script>
      <script src="<?=base_url()?>resource/js/toastr/toastr.js"></script>
	  <script type="text/javascript" src="<?php echo base_url() ?>resource/js/webcam/webcam.js" ></script>
	  <script type="text/javascript" src="<?php echo base_url() ?>resource/rcswitcher-master/js/rcswitcher.js" ></script>


	  
	  
	  
      <!-- Bootstrap -->
      <!-- js placed at the end of the document so the pages load faster -->
      <?php  echo modules::run('sidebar/scripts');?>
      <?php
      if ($this->uri->segment(3) == 'details') { ?>
      <script type="text/javascript">
      $('[data-toggle="tabajax"]').click(function(e) {
      var $this = $(this),
      loadurl = $this.attr('href'),
      targ = $this.attr('data-target');
		
      $.get(loadurl, function(data) {
      $(targ).html(data);
      });
      $this.tab('show');
      return false;
      });
      </script>
      <?php } ?>
	 <?php if (isset($timer_interval)) { ?>  
	<script language="javascript">
		var max_time = <?php if (isset($set_timer)){echo $set_timer;}else{echo 30;} ?>;
		var cinterval;
 
		function countdown_timer(){
		  // decrease timer
		  max_time--;
		  document.getElementById('countdown').innerHTML = max_time;
		  if(max_time == 0){
			clearInterval(cinterval);
			
			window.location.reload();
		  }
		}
		// 1,000 means 1 second.
		cinterval = setInterval('countdown_timer()', 1000);
	</script>  
	   <?php } ?>

<script type="text/javascript">
  $(function() {		
    // rating_star
    var pathArray = window.location.pathname.split('/');
    
    var site_upload = pathArray[0] + "/tms_online/home/upload";
    //console.log (site_upload);
    var camera = $('#camera'),screen =  $('#screen');	
    webcam.set_api_url(site_upload);	
    screen.html( webcam.get_html(320, 240) );
  
    var shootEnabled = false;
	 webcam.set_hook( 'onComplete', 'my_completion_handler');
    $(".takeWebcam").click(function(){
      $(".webcam").show('blind');
      return false;
    });
    $("#closeButton").click(function(){
      $(".webcam").hide('blind');
      return false;
    });
    $('#takeButton').click(function(){
	document.getElementById('upload_results').innerHTML = '<h1>Save processing...</h1>';
      webcam.snap();
	  
	  //reload();
      //$("#retakeButton").show();
      //$(this).hide();
      return false;
    });
    $('#retakeButton').click(function(){
      webcam.reset();
      $("#takeButton").show();
      $(this).hide();
      return false;
    });	
    $('#uploadAvatar').click(function(){
      webcam.upload(site_upload, function(){});
      webcam.set_hook( 'onComplete', 'my_completion_handler');
      //togglePane()
      webcam.reset();
      return false;
    });
    webcam.set_hook('onLoad',function(){
      shootEnabled = true;
    });
    webcam.set_hook('onError',function(e){
      screen.html(e);
    });
	
  });
  
  
	function saveToDatabase(editableObj,period_id,row_id) {
		var close_status='N';
		if (editableObj.checked){
			var close_status='Y';
		}
		
		 $.ajax(
            {
                type: "POST",
                url: "<?php echo base_url('period/save_periode'); ?>",
                data: "close_status="+close_status+"&periode_id="+period_id,
                cache: false,
                success: function(message)
                {  
                  document.getElementById(row_id+1).focus(); 
                }
            }); 
					
	}

	function my_completion_handler(msg) {
			// extract URL out of PHP output
			if (msg.match(/(http\:\/\/\S+)/)) {
				var image_url = RegExp.$1;
				// show JPEG image in page
				document.getElementById('upload_results').innerHTML = 
					'<h1>Save Successful!</h1>';
				
				// reset camera for another shot
				//webcam.reset();
				window.location.reload();
			}
			else alert("PHP Error: " + msg);
		}
		
  function my_callback_function(response) {
    //alert("Success! PHP returned: " + response);
    $(".avartar > img").attr("src","/tms_online/")
    //$("input[type='file'][name='userfile']").val("/mcinew/media/"+response.split("/")[2])
	}
	//+response.split("/")[2]

</script>	  



  <script type="text/javascript">


  </script>



	  
<script type="text/javascript">
	 
	var dinterval;
	//buat object date berdasarkan waktu di server

	var serverTime = new Date(<?php print date('Y, m, d, H, i, s, 0'); ?>);
		
	//buat object date berdasarkan waktu di client
	var clientTime = new Date();
	//hitung selisih
	var Diff = serverTime.getTime() - clientTime.getTime();    
	//fungsi displayTime yang dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik
	function displayServerTime(){
			//buat object date berdasarkan waktu di client
			var clientTime = new Date();
			//buat object date dengan menghitung selisih waktu client dan server
			var time = new Date(clientTime.getTime() + Diff);
			
			//ambil nilai jam
			var sh = time.getHours().toString();
			//ambil nilai menit
			var sm = time.getMinutes().toString();
			//ambil nilai detik
			var ss = time.getSeconds().toString();
			//tampilkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
			document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
			
	}
	// 1,000 means 1 second.
	dinterval = setInterval('displayServerTime()', 1000);
    
function currencyFormatDE (num) {
    return num
       .toFixed(3) // always two decimal digits
       .replace(".", ",") // replace decimal point character with ,
       .replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") // use . as a separator
}

<!---------------Vehicle--------------->
    var save_method; //for save method string
    function add_vehicle()
    {

      save_method = 'add';
      $('#form')[0].reset(); 
      $('#modal_form').modal('show'); 
      $('.modal-title').text('<?=lang('new_vehicle')?>'); 
    }
    function edit_vehicle(id)
    {
      save_method = 'update';
      $('#form')[0].reset();
          
      $.ajax({
        url : "<?php echo base_url('vehicle/get_data_edit/')?>/" + id,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {
            $('[name="rowID"]').val(data.rowID);
            $('[name="vehicle_police_no"]').val(data.police_no);
            $('[name="vehicle_code"]').val(data.vehicle_type_rowID);
            $('[name="vehicle_head_truck"]').val(data.head_truck);
            $('[name="vehicle_gps"]').val(data.gps_no);
            $('[name="vehicle_driver"]').val(data.debtor_rowID);
            $('#modal_form').modal('show');
            $('.modal-title').text('Edit'); 
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            //alert('Error get data from ajax');
            swal("Oops!", "Error adding / update data", "error");
        }
    });

    }
    
    function delete_vehicle(id)
    {

        swal({
          title: "Are you sure?",
          text: "delete this data!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: false
        },
        function(){
          
              $.ajax({
                url : "<?php echo base_url('vehicle/delete_data/')?>/" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                   
                   swal("Deleted!", "Data has been deleted.", "success");
                   $('#modal_form').modal('hide');
                   location.replace("<?php echo base_url('vehicle')?>");
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    //alert('Error adding / update data');
                    swal("Oops!", "Error delete data", "error");
                }
            });
        });

    }
    
       
function save_vehicle(){
    //alert('tes');
          var url;
      if(save_method == 'add') 
      {
          url = "<?php echo base_url('vehicle/create')?>";
      }
      else
      {
          url = "<?php echo base_url('vehicle/edit')?>";
      }
      
      			sweetAlert({
                          title: "Are you sure?",
                          text: "Are you sure you want to Save?",
                          type: "warning",
                          showCancelButton: true,
                          confirmButtonColor: "#DD6B55",
                          confirmButtonText: "Yes, Save !",
                          closeOnConfirm: true,
                          html: false
                        },function(r){ 
                            if (r){

                                  $.ajax({
                                    url : url,
                                    type: "POST",
                                    data: $('#form').serialize(),
                                    dataType: "JSON",
                                    success: function(data)
                                    {
                                                      	            
                                            $('#modal_form').modal('hide');
                                            swal("Save!", "Data has been Saved.", "success");
                                            
                                            location.replace("<?php echo base_url('vehicle')?>");
                                            
                                            
                                                                   
                                    }
                                   ,
                                    error: function (jqXHR, textStatus, errorThrown)
                                    {
                                        //alert('Error adding / update data');
                                        swal("Oops!", "Error adding / update data", "error");
                                    }
                                    
                                });  
                                
                                        
                            }
                        });
<!--------------- end Vehicle--------------->
</script>
    </body>
  </html>