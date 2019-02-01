<!DOCTYPE html>
<html lang="en" class="app">
  <head>
    <meta charset="utf-8" />
    <meta name="description" content="">
    <meta name="author" content="<?=$this->config->item('site_author')?>">
    <meta name="keyword" content="<?=$this->config->item('site_desc')?>">
    <link rel="shortcut icon" href="<?=base_url()?>resource/images/favicon.ico">
    <title><?php
                //echo $template['title']);
                echo $this->config->item('comp_cd').' - '.$page; 
            ?></title>
    <!-- Bootstrap core CSS -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!--<link rel="stylesheet" href="<?=base_url()?>resource/css/detail.css" type="text/css" />-->
    <link rel="stylesheet" href="<?=base_url()?>resource/css/app.v2.css" type="text/css" />
    <link rel="stylesheet" href="<?=base_url()?>resource/js/toastr/toastr.css" type="text/css" />
    <link rel="stylesheet" href="<?=base_url()?>resource/css/font.css" type="text/css" cache="false" />
    <link rel="stylesheet" href="<?=base_url()?>resource/plugin/bootstrap-switch/bootstrap-switch.min.css" type="text/css"/>
    <link rel="stylesheet" href="<?=base_url()?>resource/plugin/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" />
    <!--<link rel="stylesheet" href="<?=base_url()?>resource/themes/default/easyui1.css" type="text/css" cache="false" />-->
    <?php 
	//if ($page == lang('projects') OR $page == lang('add_invoice') OR $this->uri->segment(3) == 'edit' OR $this->uri->segment(3) == 'add') { ?>
    <link rel="stylesheet" href="<?=base_url()?>resource/js/slider/slider.css" type="text/css" cache="false" />
    <link rel="stylesheet" href="<?=base_url()?>resource/plugin/bootstrap-datepicker/bootstrap-datepicker.min.css" type="text/css" cache="false" />
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
    <link rel="stylesheet" href="<?=base_url()?>resource/js/datatables/DataTables.css" type="text/css" cache="false" />
    <link rel="stylesheet" href="<?=base_url()?>resource/js/datatables/datatables.css" type="text/css" cache="false" />
	<link rel="stylesheet" href="<?=base_url()?>resource/css/dataTables.bootstrap.css" type="text/css" cache="false" />
	<link rel="stylesheet" href="<?=base_url()?>resource/css/bootstrap.min.css" type="text/css" cache="false" />
    <link rel="stylesheet" href="<?=base_url()?>resource/css/sweet-alert.css" >
    <?php }  ?>
    
    <link rel="stylesheet" href="<?=base_url()?>resource/plugin/font-awesome/css/font-awesome.min.css" type="text/css" cache="false" />

    <script src="<?=base_url()?>resource/js/jquery-2.1.4.min.js"></script>
    <script src="<?=base_url()?>resource/js/function.js"></script>
    <script src="<?=base_url()?>resource/js/sweet-alert.js"></script>
    <script src="<?=base_url()?>resource/js/app.v2.js"></script>
    <script src="<?=base_url()?>resource/js/charts/easypiechart/jquery.easy-pie-chart.js" cache="false"></script>
    <script src="<?=base_url()?>resource/js/charts/sparkline/jquery.sparkline.min.js" cache="false"></script>
    <script src="<?=base_url()?>resource/js/toastr/toastr.js"></script>
    <script src="<?=base_url()?>resource/js/datatables/DataTable.js"></script>
    <script src="<?=base_url()?>resource/js/select2/select2.min.js"></script>
    <script src="<?=base_url()?>resource/js/currency/currency.js"></script>
    <script src="<?=base_url()?>resource/js/input-mask/jquery.mask.js"></script>
    <script src="<?=base_url()?>resource/plugin/bootstrap-switch/bootstrap-switch.min.js"></script>
    <script src="<?=base_url()?>resource/plugin/bootstrap-datetimepicker/moment.js"></script>
    <script src="<?=base_url()?>resource/plugin/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script>
    <script src="<?=base_url()?>resource/plugin/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>resource/js/webcam/webcam.js" ></script>
    <script type="text/javascript" src="<?php echo base_url() ?>resource/rcswitcher-master/js/rcswitcher.js" ></script>
    
    <script src="<?=base_url()?>resource/plugin/highcharts/highcharts.js"></script>
    <script src="<?=base_url()?>resource/plugin/highcharts/exporting.js"></script>

    <!-- Wait Me -->
    <script src="<?=base_url()?>resource/plugin/waitme/waitMe.js"></script>
    <link href="<?=base_url()?>resource/plugin/waitme/waitMe.css" rel="stylesheet">

    <style>
    .header p{
        font-weight: bold;
        font-size: 18px !important;
        text-transform: uppercase;
    }
    
    .ganjil{
    border:0px;
    border-top:solid 0px white;
    border-bottom:solid 0px white;
    background:url('<?= base_url();?>resource/images/ganjil.png');
    font-weight:bold;
	font-size:12px;
	color:#555;
	text-align:center;
    }
    
    .genap{
        border:0px;
        border-top:solid 0px white;
        border-bottom:solid 0px white;
        background:url('<?= base_url();?>resource/images/genap.png');
        font-weight:bold;
    		font-size:12px;
    	color:#555;
    	text-align:center;
    }
    
    body.modal-open .datepicker {
        z-index: 1050 !important;
    }
    
    .spasigreat{
        padding:0px;
        margin-left:5px;
        margin-right:5px;
        width:12px;
        height:20px;
        background-color:#FF0000;
        height:30px;
    }
    
    #menu_bar{
    	display: none;
    }
    @media(min-width:768px){
        #menu_bar{
            display: inline-block;
        }
    }
     
    </style>
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
      <?php  echo  modules::run('sidebar/top_header');?>
      <!--header end-->
      <section>
        <section class="hbox stretch">
          <?php
          if ($this->tank_auth->user_role($this->tank_auth->get_role_id()) == 'admin') {
            echo modules::run('sidebar/client_menu');
            //echo modules::run('sidebar/admin_menu');
          }
          elseif ($this->tank_auth->user_role($this->tank_auth->get_role_id()) == 'collaborator') {
            echo modules::run('sidebar/client_menu');
            //echo modules::run('sidebar/collaborator_menu');
          }
          elseif ($this->tank_auth->user_role($this->tank_auth->get_role_id()) == 'client') {
            echo modules::run('sidebar/client_menu');
          }
          else{
            echo modules::run('sidebar/client_menu');
            //echo modules::run('sidebar/general_menu');
          }
          
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
    function menuBar(opsi){
        if(opsi == 1){
            $('#btnTrue').hide();
            $('#btnFalse').show();
            $('#nav').hide();
        }
        else{
            $('#btnTrue').show();            
            $('#btnFalse').hide();
            $('#nav').show();
        }
    }

  $(function() {
    
    $('#tbl-ca-loan').DataTable({
        "aaSorting": [[1, 'desc']],
        "bProcessing": true,
        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "sPaginationType": "full_numbers",
	});
    
    $('#tbl-ca-bonus').DataTable({
        "aaSorting": [[1, 'desc']],
        "bProcessing": true,
        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "sPaginationType": "full_numbers",
	});
    
    $('#tbl_part').DataTable({
        "aaSorting": [[0, 'asc']],
        "bProcessing": true,
        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "sPaginationType": "full_numbers",
	});

    $('#tbl_material').DataTable({
        "aaSorting": [[0, 'asc']],
        "bProcessing": true,
        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "sPaginationType": "full_numbers",
	});

    $('#tbl_service').DataTable({
        "aaSorting": [[0, 'asc']],
        "bProcessing": true,
        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "sPaginationType": "full_numbers",
	});
    
    $('#tbl_template_service').DataTable({
        "aaSorting": [[0, 'asc']],
        "bProcessing": true,
        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "sPaginationType": "full_numbers",
	});
    
    $('#debtor_npwp_registered').datepicker({
        format: 'dd-mm-yyyy',
    }).on('changeDate',function(ev){
        $("#debtor_npwp_registered").datepicker('hide');
	});

    $('#debtor_dob').datepicker({
        format: 'dd-mm-yyyy',
    }).on('changeDate',function(ev){
        $("#debtor_dob").datepicker('hide');
	});
    
    $('#effective_date').datepicker({
        format: 'dd-mm-yyyy',
    }).on('changeDate',function(ev){
        $("#effective_date").datepicker('hide');
	});

    $('.expired_vehicle').datetimepicker({
		format: 'DD-MM-YYYY',
        showTodayButton:true
	});
    
    $('.tanggal_datetimepicker').datetimepicker({
		format: 'DD-MM-YYYY',
        showTodayButton:true
	});    
    
    $('.tanggal_jam_datetimepicker').datetimepicker({
		format: 'DD-MM-YYYY HH:mm:ss',
        //showTodayButton:true
	});
    
    $('.tanggal_datepicker').datepicker({
        format: 'dd-mm-yyyy',
        todayBtn: "linked",
    }).on('changeDate',function(ev){
        $(".tanggal_datepicker").datepicker('hide');
	});
        
    // START. Datetimepicker range
    $('#start_date').datetimepicker({
		format: 'DD-MM-YYYY',
        defaultDate:'<?=date('d/m/Y', strtotime($start_date))?>'
	});

	$('#end_date').datetimepicker({
		format: 'DD-MM-YYYY',
        defaultDate:'<?=date('d/m/Y', strtotime($end_date))?>',
		useCurrent: false //Important! See issue #1075
	});
    
    $("#start_date").on("dp.change", function (e) {
		$('#end_date').data("DateTimePicker").minDate(e.date);
	});
	
	$("#end_date").on("dp.change", function (e) {
		$('#start_date').data("DateTimePicker").maxDate(e.date);
	});
    
    $('#month_year').datetimepicker({
		format: 'MM-YYYY'
	});
    
    $('#start_month').datetimepicker({
		format: 'MM-YYYY'
	});

	$('#end_month').datetimepicker({
		format: 'MM-YYYY'
	});
    
    $("#start_month").on("dp.change", function (e) {
		$('#end_month').data("DateTimePicker").minDate(e.date);
	});
	
	$("#end_month").on("dp.change", function (e) {
		$('#start_month').data("DateTimePicker").maxDate(e.date);
	});
    
    // Date and Time
    $('#start_date_time').datetimepicker({
		format: 'DD-MM-YYYY HH:mm:ss'
    });

	$('#end_date_time').datetimepicker({
		format: 'DD-MM-YYYY HH:mm:ss',
		useCurrent: false //Important! See issue #1075
	});
    
    $("#start_date_time").on("dp.change", function (e) {
		$('#end_date_time').data("DateTimePicker").minDate(e.date);
	});
	
	$("#end_date_time").on("dp.change", function (e) {
		$('#start_date_time').data("DateTimePicker").maxDate(e.date);
	});
    // END. Datetimepicker range
    
    $('#vehicle_type_weight').mask('000.000.000', {reverse: true});
    $('#vehicle_type_max_weight').mask('000.000.000', {reverse: true});
    $('#vehicle_type_min_weight').mask('000.000.000', {reverse: true});
    $('#fare_trip_distance').mask('000.000', {reverse: true});
    $('.currency').mask('000.000.000.000', {reverse: true});
    $('.currency_decimal').mask('000.000.000.000,00', {reverse: true});
    $('.angka_ribuan').mask('000.000', {reverse: true});
    $('.angka_jutaan').mask('000.000.000', {reverse: true});
    
    $('#btnFalse').css('display','none');
    
    // Switch Button
    $("#chk_status").bootstrapSwitch({
        'onText' : 'Active',
        'offText' : 'Not Active',
    });
    
    $(".chk_vehicle").bootstrapSwitch({
        'onText' : '<?=lang('asli')?>',
        'offText' : '<?=lang('fotocopy')?>',
        'labelText' : '<?=lang('document')?>'
    });
        
	$("#filter_type").on("change", function (e) {
        if($("#filter_type").val() == "All")
    	   $('#periode_filter').hide();
        else
           $('#periode_filter').show();
	});

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
	  
	  location.reload();
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

 /*    var save_method; //for save method string
    var table;
    $(document).ready(function() {


	  
    function add_person()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }
	  function add_personx()
    {
			table.row('.selected').remove().draw( false );
    }

    function edit_person(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('person/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
           
            $('[name="id"]').val(data.id);
            $('[name="firstName"]').val(data.firstName);
            $('[name="lastName"]').val(data.lastName);
            $('[name="gender"]').val(data.gender);
            $('[name="address"]').val(data.address);
            $('[name="dob"]').val(data.dob);
            
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }

    function reload_table()
    {
      table.ajax.reload(null,false); //reload datatable ajax 
    }

    function save()
    {
      var url;
      if(save_method == 'add') 
      {
          url = "<?php echo site_url('person/ajax_add')?>";
      }
      else
      {
        url = "<?php echo site_url('person/ajax_update')?>";
      }

       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#modal_form').modal('hide');
               reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }

    function delete_person(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data to database
          $.ajax({
            url : "<?php echo site_url('person/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               //if success reload ajax table
               $('#modal_form').modal('hide');
               reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
         
      }
    } */

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
		

		
	function cash_advance_onsubmit() {
		var x=document.getElementById("amount").value;
		
		if (confirm("Apakah Nomimal sudah benar? " + Number(x).toFixed(0).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + " . Jika OK PASTIKAN printer keadaan MENYALA kemudian tekan OK untuk melanjutkannya!!!") == true){
		
			return true;
		}else{
			return false;
		}
	}

	function realization_onsubmit() {
		var x=document.getElementById("cash_advance_no").value;
		var y=document.getElementById("cash_advance_amt").value;
		//alert(Number(x).toFixed(0).replace(",", ".").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));
		
		if (confirm("Apakah Cash Advance No : " + x +" Nomimal sudah benar? " + Number(y).toFixed(0).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + " . Jika OK PASTIKAN NOMOR dan NOMINAL Cash Advance sudah benar kemudian tekan OK untuk melanjutkannya!!!") == true){
		
			return true;
		}else{
			return false;
		}
	}
	function myFunction() {
		var sum = 0; var i=0;
	
		//iterate through each textboxes and add the values
		$(".cost_code_amount").each(function () {

			//add only if the value is number
			if (!isNaN($("#cost_code_amount_"+i).val()) && $("#cost_code_amount_"+i).val().length != 0) {
				sum += parseFloat(this.value);
			}
			i++;
		});
		//.toFixed() method will roundoff the final sum to 2 decimal places
		$("#cash_advance_alloc").val(sum+parseFloat($("#cash_advance_alloc_").val()));
		$("#cash_advance_balance").val(parseFloat($("#cash_advance_amt").val())-parseFloat($("#cash_advance_alloc").val()));
	}	
	
	function refund_onsubmit() {
        var paid_amount_tmp = $("#paid_amount").val().replace('.','');
        var paid_amount_tmp2 = paid_amount_tmp.replace('.','');
        var paid_amount_val = paid_amount_tmp2.replace('.','');
    
        var total_refund_amount_tmp = $("#total_refund_amount").val().replace('.','');
        var total_refund_amount_tmp2 = total_refund_amount_tmp.replace('.','');
        var total_refund_amount_val = total_refund_amount_tmp2.replace('.','');
        
		var paid_amount=paid_amount_val;
		var refund_desc=$("#refund_desc").val();
		var total_outstanding_amount=parseFloat(total_refund_amount_val);
			//alert(paid_amount);alert(total_outstanding_amount);
		if(paid_amount > total_outstanding_amount){
			swal("Oops!", "Paid Amount must less then Outstanding Amount.", "error");
            $("#paid_amount").val(0);
            $("#paid_amount").focus();
            return false;
        }		
        
		if($('#total_refund_amount').val() == undefined){
		  	swal("Oops!", "<?=lang('choose_driver')?>", "error");            
            return false;
        }
                
        if(refund_desc==""){
		  	swal("Oops!", "Description is required.", "error");                        
            $("#refund_desc").focus();
            return false;
        }
        
		if (confirm("Are you sure to refund ? \nPlease check again CA No and Refund Amount!") == true){
			return true;
		}else{
			return false;
		}
                
	}	
    	
	function calculation_refund_ca() {
		var sum = 0; var i=0;var balance=0;var paid_amount=0;
		var paid_amount_tmp = $("#paid_amount").val().replace('.','');
        var paid_amount_tmp2 = paid_amount_tmp.replace('.','');
        var paid_amount_val = paid_amount_tmp2.replace('.','');
    
        var total_refund_amount_tmp = $("#total_refund_amount").val().replace('.','');
        var total_refund_amount_tmp2 = total_refund_amount_tmp.replace('.','');
        var total_refund_amount_val = total_refund_amount_tmp2.replace('.','');
        
        var paid_amount=paid_amount_val;
		var total_outstanding_amount=parseFloat(total_refund_amount_val);
			//alert(paid_amount);alert(total_outstanding_amount);
		if(paid_amount <= total_outstanding_amount){
    		//iterate through each textboxes and add the values
    		/*
            $(".refund_amount").each(function () {
    			if(paid_amount>0){
    				if(parseFloat($("#ca_balance_"+i).val()) <= paid_amount){
    					balance=parseFloat($("#ca_balance_"+i).val());
    					$("#refund_amount_"+i).val(tandaPemisahTitik(balance));
    					paid_amount=paid_amount-balance;
    					
    				}else{
    					balance=paid_amount;
    					$("#refund_amount_"+i).val(tandaPemisahTitik(balance));
    					paid_amount=paid_amount-balance;
    			
    				}
    			
    			
    			}else{balance=0;$("#refund_amount_"+i).val(tandaPemisahTitik(balance));}	
    			
    			i++;
    		});
            */	
		}
        else{
			swal("Oops!", "Paid Amount must less then Outstanding Amount.", "error");
            $("#paid_amount").val(0);
            $("#paid_amount").focus();
            return false;
        }
	}
			//$("#total_refund_amount").val(sum);
			//add only if the value is number
/* 			if (!isNaN($("#refund_amount_"+i).val()) && $("#refund_amount_"+i).val().length != 0) {
				sum += parseFloat(this.value);
			}
			i++; */
			//if(paid_amount>0){
			//	if($("#refund_amount_"+i).val()<=paid_amount && !isNaN($("#refund_amount_"+i).val())){
					//$balance=$ca_list->advance_balance;
					//$refund_remain_amount-=$balance;
			//	}else{
					//$balance=$refund_remain_amount;
					//$refund_remain_amount-=$balance;
			//	} 
			//}else{//$balance=$refund_remain_amount;}			
			
			
		//});
		//.toFixed() method will roundoff the final sum to 2 decimal places
		//$("#total_refund_amount").val(sum);
		//$("#cash_advance_alloc").val(sum+parseFloat($("#cash_advance_alloc_").val()));
		//$("#cash_advance_balance").val(parseFloat($("#cash_advance_amt").val())-parseFloat($("#cash_advance_alloc").val()));
			
		
/* 		var cost_amount = document.getElementById("table-cost");
		var rowCount = cost_amount.rows.length;

		var cash_advance_alloc = document.getElementById("cash_advance_alloc");
		var cash_advance_balance = document.getElementById("cash_advance_balance");
		//cash_advance_alloc.value=0;
		
		var cash_advance_alloc_awal=cash_advance_alloc.value;
		var cost_code_amount=document.getElementById("cost_code_amount_"+i).value;
		var subtotal_cost_amount=0;
		for(var i=0; i<rowCount; i++) {
			
			if(isNaN(document.getElementById("cost_code_amount_"+i).value) || $("#cost_code_amount_"+i).val()==""){cost_code_amount=0;document.getElementById("cost_code_amount_"+i).value=0;}
			var subtotal_cost_amount=subtotal_cost_amount+$("#cost_code_amount_"+i).val();
			$("#cash_advance_alloc").val(subtotal_cost_amount);
			
		}
		$("#cash_advance_alloc").val(subtotal_cost_amount); *///cash_advance_alloc.value=parseFloat(subtotal_cost_amount);
		//	cash_advance_alloc.value=parseFloat(subtotal_cost_amount)+parseFloat(cash_advance_alloc.value);
		//	cash_advance_balance.value=parseFloat($("#cash_advance_amt").val())-parseFloat(cash_advance_alloc.value);		
	
	// function addRow(tableID) {
		// var table = document.getElementById(tableID);
		// var rowCount = table.rows.length;
		// if(rowCount <= 5){							// limit the user from creating fields more than your limits
			// var row = table.insertRow(rowCount);
			// var colCount = table.rows[0].cells.length;
			// for(var i=0; i<colCount; i++) {
				// var newcell = row.insertCell(i);
				// newcell.innerHTML = table.rows[1].cells[i].innerHTML;

			// }
			
		// }else{
			 // alert("Maximum Passenger per ticket is 5.");
				   
		// }
	// }

	// function deleteRow(tableID) {
		// var table = document.getElementById(tableID);
		// var rowCount = table.rows.length;
		
		// for(var i=1; i<rowCount; i++) {
			// var row = table.rows[i];
			// var chkbox = row.cells[0].childNodes[i];
			// if(null != chkbox && true == chkbox.checked) {
				// if(rowCount <= 2) { 						// limit the user from removing all the fields
					// alert("Cannot Remove all the Passenger.");
					// break;
				// }
				// table.deleteRow(i);
				// rowCount--;
				// i--;
			// }
		// }
	// }	
	
/* 	$(document).on("select2-selecting","#e10", function(e) { 
		console.log('select2-selecting event');
		console.log(e);
		alert(e.choice.code);
		 $('#debtor_name').val(e.choice.text);

	});		
 */	


 
$(document).ready(function($) {

	var first_click= true;	var i=5;
    	
    /*$('#date').datepicker().on('changeDate', function(ev){                 
		$('#date').datepicker('hide');
	});
	*/
    
	$("#table-cost").on('click','.deleteRow',function(event){ 
		//alert($("#counter_costcode").val());
		$("#counter_costcode").val($("#counter_costcode").val()-1);
		//alert($("#counter_costcode").val());
		$(this).closest('tr').remove();
	});

	 $(document).on("select2-selecting",".cost_code", function(e) { 
		console.log('select2-selecting event');
		console.log(e);
		var rowid = e.choice.rowid; 
		var cost_code_id = e.choice.id;
		var cost_code = e.choice.cost_cd; 
		var cost_code_desc = e.choice.cost_code_desc;  
	   
		$('#cost_code_id_'+rowid).val(cost_code_id);	
		$('#cost_code_'+rowid).val(cost_code);		
		$('#cost_code_desc_'+rowid).val(cost_code_desc);

		$( '#cost_code_amount_'+rowid ).prop( "disabled", false );
    }); 
	 
	$(".addmore").on('click',function(){
		var data="<tr data-rowid='"+i+"'>";
		data +="<td><input type='hidden' data-rowid='"+i+"' class='cost_code form-control' id='cost_code_"+i+"' name='cost_code[]'/><input type='hidden' data-rowid='"+i+"' class='cost_code_id' id='cost_code_id_"+i+"' name='cost_code_id[]'/></td>";
		data +="<td><input type='text' data-rowid='"+i+"' class='cost_code_desc form-control' id='cost_code_desc_"+i+"' name='cost_code_desc[]'/></td>";
		data +="<td><input type='text' data-rowid='"+i+"' class='cost_code_amount form-control' id='cost_code_amount_"+i+"' name='cost_code_amount[]' onblur='myFunction()' maxlength='9' style='font-size:22px;font-weight:900;color: black;text-align: right;' value=0 disabled /></td><td><a class='deleteRow'>delete</a></td></tr>";

		$("#table-cost").append(data);
		$("#counter_costcode").val(i);
		//alert($("#counter_costcode").val());
		var rowid = $("#cost_code_"+i).data('rowid');

		$("#cost_code_"+i).select2({
			dropdownAutoWidth: true,
			width: 'resolve',
			placeholder: 'Search Cost Code',
			minimumInputLength: 5,
			allowClear: true,
			delay: 2000,
			ajax: {
				dataType: "json",
				url: "<?php echo base_url('finances/returnCostCodesAjax'); ?>",
				data: function (term, page) {
					return {
						term: term
					};
				},
				results: function (data) {
					var results = [];

					$.each(data, function(index, item){
						results.push({

							id: item.rowID,
							text: item.cost_cd +' '+item.descs,   
							code: item.cost_cd, 						
							rowid: rowid,
							cost_code_desc: item.descs,
                            cost_code_id: item.rowID,
							cost_code: item.cost_cd
						});
					});
					
					return { results: results };
				},
				cache: true
			} 
				
		});

		i++;
		$("#table-cost input:last").focus();
	});
	
	$(".cost_code").each(function(){
		var rowid = $(this).data('rowid');
		
		$(this).select2({
			dropdownAutoWidth: true,
			width: 'resolve',
			placeholder: 'Search Cost Code',
			minimumInputLength: 5,
			allowClear: true,
			delay: 2000,
			ajax: {
				dataType: "json",
				url: "<?php echo base_url('finances/returnCostCodesAjax'); ?>",
				data: function (term, page) {
					return {
						term: term
					};
				},
				results: function (data) {
					var results = [];

					$.each(data, function(index, item){
						results.push({

							id: item.rowID,
							text: item.cost_cd +' '+item.descs,   
							code: item.cost_cd, 						
							rowid: rowid,
							cost_code_desc: item.descs,
                            cost_code_id: item.rowID,
							cost_code: item.cost_cd
						});
					});
					
					return { results: results };
				},
				cache: true
			} 
				
		});
	});	
	
	$('.cost_code').click(function(){
		var rowid = $(this).data('rowid');		
		$('#cost_code_amount_'+rowid).focus();
	});
	
    $(".all_select2").select2();

	$("#driver_refund").select2();

	$("#debtortype_receivable_acc").select2();
	$("#debtortype_advance_acc").select2();
	$("#debtortype_deposit_acc").select2();
	$("#debtortype_rounding_acc").select2();
	$("#debtortype_adm_acc").select2();
	$("#debtortype_pay_acc").select2();
	$("#expenses_account").select2();
	$("#cost_code_wip").select2();
	$("#cost_code_cogs").select2();
	$("#vehicle_code").select2();
	$("#vehicle_id").select2();
	$("#vehicle_driver").select2();
	$("#uom_id").select2();
	$("#fare_trip_destination_from").select2();
	$("#fare_trip_destination_to").select2();
	$("#departments_cash_gl_coa").select2();
	$("#debtor_code").select2();
    $("#parentid").select2();
    $("#cmb_kd_menu").select2();
    $("#cash_advance_type2").select2();
    $("#vehicle_type").select2();
    $("#cost_code").select2();

	$("#driver_refund").click(function(){
		var driver=$("#driver_refund").val();
        //var refund_amount = $("#refund_amount").val();
		
		if (driver<=0){
			swal("Oops!", "<?=lang('choose_driver')?>", "error");
			$("#driver_refund").focus();            
			$("#paid_amount").prop('readonly',true);
			$("#refund_desc").prop('readonly',true);
            $('#ca_lists').html('<?=lang('choose_driver')?>');
			return false;
		}
        $.ajax({
            type: "POST",
            url : "<?php echo base_url('finances/get_ca_lists'); ?>",
			data: "driver="+driver+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
            cache:false,
            success: function(data){				
                    $('#ca_lists').html(data);
					$("#refund_amount").focus();
					$("#paid_amount").prop('readonly',false);
					$("#refund_desc").prop('readonly',false);
                    
					//document.getElementById('ca_refund_row_1').focus()=true; 
            },
			error: function(xhr, status, error) {
				  
				document.write(xhr.responseText);
				alert(xhr.responseText);
			}
        });
		
	});	

	$("#paid_amount").keydown(function(event){ 
		if (event.keyCode == 13)  {
            var paid_amount_tmp = $("#paid_amount").val().replace('.','');
            var paid_amount_tmp2 = paid_amount_tmp.replace('.','');
            var paid_amount_val = paid_amount_tmp2.replace('.','');
        
            var total_refund_amount_tmp = $("#total_refund_amount").val().replace('.','');
            var total_refund_amount_tmp2 = total_refund_amount_tmp.replace('.','');
            var total_refund_amount_val = total_refund_amount_tmp2.replace('.','');
        
			var paid_amount=parseFloat(paid_amount_val);
			var total_outstanding_amount=parseFloat(total_refund_amount_val);
			//alert(paid_amount);alert(total_outstanding_amount);
			if(paid_amount <= total_outstanding_amount){
			     alert(total_outstanding_amount);
                 alert('d'+paid_amount);
			     calculation_refund_ca();
			}
            else{
                swal("Oops!", "Paid Amount must less then Outstanding Amount", "error");
			
                $("#paid_amount").val(0);
                return false;
            }

		}
	});
    
    $("#category").change(function (){
       var nilai= $('#category').val(); 
        if (nilai == "C"){
            $('#debtortype_pay_acc').prop("disabled", true);
        }else{
            $('#debtortype_pay_acc').prop("disabled", false);
            
        }
    });
    
    
	
	$("#coa_type").change(function (){
				var nilai= $('#coa_type').val();
				var no = 1;
                //alert('aaaaas');
				
				$("#coa_level").children().remove();
				var i;
				for (i=2;i<=9;i++){
					var number=i;
				}
				
				if (nilai == "H"){
				      $('#coa_c').prop("disabled", true);
                      $('#coa_b').prop("disabled", true);
                      $('#coa_vatin').prop("disabled", true);
                      $('#coa_vatout').prop("disabled", true);
                      $('#coa_active').prop("disabled", true);
                       
                      $('[name="coa_c"]').val("N");
                      $('[name="coa_b"]').val("N");
                      $('[name="coa_vatin"]').val("N");  
                      $('[name="coa_vatout"]').val("N");  
                      $('[name="coa_active"]').val("N");
                      
					  
					  $("#coa_lists").children().remove();
                      
    				var i;
    				for (i=1;i<=9;i++){
    					var number=i;
    					$('#coa_level').append("<option value="+number+">"+number+"</option>");
    				}
                    $('#coa_level').val("1");
                      
				}else{
                      $('#coa_c').prop("disabled", false);
                      $('#coa_b').prop("disabled", false);
                      $('#coa_vatin').prop("disabled", false);
                      $('#coa_vatout').prop("disabled", false);
                      $('#coa_active').prop("disabled", false);
                      
                      $('[name="coa_c"]').val("N");
                      $('[name="coa_b"]').val("N");
                      $('[name="coa_vatin"]').val("N");  
                      $('[name="coa_vatout"]').val("N");  
                      $('[name="coa_active"]').val("Y");
					var i;
					for (i=2;i<=9;i++){
						var number=i;
						$('#coa_level').append("<option value="+number+">"+number+"</option>");
					}
					$('#coa_level').val("2");
					

				}	
				
		    });
	
    /*
		$('#coa_level').change(function(){
		//alert("salah");
		var coa_level=parseInt($('#coa_level').val())-1;
        
 		$.ajax({
			//alert("salah");
            type: "POST",
            url : "<?php echo base_url('coa/get_coa_level_before'); ?>",
			data: "coa_level="+coa_level,
            cache:false,
			dataType: 'json',
            success: function(data){	
                     alert(data);			
                    $('#coa_lists').html(data);
            },
			error: function(xhr, status, error) {
				document.write(xhr.responseText);
				//alert(xhr.responseText);
			}
        }); 
	});
    */
	
	$("#expenses_type").change(function (){
			
				var nilai= $('#expenses_type').val();
				if (nilai == "H"){
					document.getElementById("expenses_from_code").disabled  = true;
					$("#expenses_from_code").val("0");
				}else{
					document.getElementById("expenses_from_code").disabled = false;
				}	
				
		    });
			
	$("#job_order_type").select2();	
	$("#job_order_type").change(function (){
				
				var nilai= $('#job_order_type').val();
				//alert(nilai);
				if (nilai == "C"){
					document.getElementById("job_order_wholesale").disabled  = false;
					
					document.getElementById("job_order_weight_20ft").disabled  = false;
					document.getElementById("job_order_weight_40ft").disabled  = false;
					document.getElementById("job_order_weight_45ft").disabled  = false;
					
					document.getElementById("job_order_price_20ft").disabled  = false;
					document.getElementById("job_order_price_40ft").disabled  = false;
					document.getElementById("job_order_price_45ft").disabled  = false;
					
					document.getElementById("job_order_container_20ft").disabled  = false;
					document.getElementById("job_order_container_40ft").disabled  = false;
					document.getElementById("job_order_container_45ft").disabled  = false;
				}
				else if (nilai == "B"){
					
					document.getElementById("job_order_weight_20ft").disabled  = true;
					document.getElementById("job_order_weight_40ft").disabled  = true;
					document.getElementById("job_order_weight_45ft").disabled  = true;
					
					
					document.getElementById("job_order_price_20ft").disabled  = true;
					document.getElementById("job_order_price_40ft").disabled  = true;
					document.getElementById("job_order_price_45ft").disabled  = true;
					
					document.getElementById("job_order_container_20ft").disabled  = true;
					document.getElementById("job_order_container_40ft").disabled  = true;
					document.getElementById("job_order_container_45ft").disabled  = true;
				}
				else if (nilai == "O"){
					
					document.getElementById("job_order_weight_20ft").disabled  = false;
					document.getElementById("job_order_weight_40ft").disabled  = false;
					document.getElementById("job_order_weight_45ft").disabled  = false;
					
					document.getElementById("job_order_price_20ft").disabled  = false;
					document.getElementById("job_order_price_40ft").disabled  = false;
					document.getElementById("job_order_price_45ft").disabled  = false;
					
					document.getElementById("job_order_container_20ft").disabled  = false;
					document.getElementById("job_order_container_40ft").disabled  = false;
					document.getElementById("job_order_container_45ft").disabled  = false;
				} 					
				
		    });

		
		$("#debtor").select2();
		$("#debtor").change(function(){
			
			$('#debtor_dtl').empty();
			var debtor_rowID = $(this).val();            
			if(debtor_rowID!=0){ 		
				$.ajax({
					type: "POST",
					url : "<?php echo base_url('debtor/get_debtor_dtl'); ?>",
					data: "debtor_rowID="+debtor_rowID+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
					cache:false,
					dataType: 'json',
					success: function(msg){	
						$('#debtor_dtl').text(msg.debtor_name);
						$('#debtor_rowID').val(msg.debtor_rowID);
					},
					error: function(xhr, status, error) {				  
						document.write(xhr.responseText);
						//alert(xhr.responseText);
					}
				});       
			}
		});		

	
		$("#port").select2();		
		$("#item").select2();
		$("#fare_trip").select2();
		$("#fare_trip").change(function(){
			$('#fare_trip_dtl').empty();
			var fare_trip_rowID = $(this).val(); 
	
			if(fare_trip_rowID!=0){ 		
				$.ajax({
					type: "POST",
					url : "<?php echo base_url('fare_trip/get_fare_trip_dtl'); ?>",
					data: "fare_trip_rowID="+fare_trip_rowID+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
					cache:false,
					dataType: 'json',
					success: function(msg){	
                        $('#fare_trip_dtl').text('Destination : '+msg.destination_from_no+'-'+msg.destination_from_name+' to '+ msg.destination_to_no +'-'+msg.destination_to_name+',\nTrip Type : '+msg.trip_type+',\nVehicle : '+msg.vehicle_type+',\nTotal : Rp '+number_format(msg.total,0,',','.','format')+',\nDistance : '+msg.distance+' km');
				        $('#destination_from_id').val(msg.destination_from_id);
                        $('#destination_to_id').val(msg.destination_to_id);
                    },
					error: function(xhr, status, error) {				  
						document.write(xhr.responseText);
						//alert(xhr.responseText);
					}
				});       
			}
		});
		

		
		$("#amount").keyup(function (event) {	
			var x=$('#amount').val();
			     
			if(isNaN(x)){$('#amount').val('');}
		});

	$("#cash_advance_type").select2();
	$("#vehicle").select2();
	$("#vehicle_category").select2();	
	$("#driver").select2();	

	$("#cash_advance_type").change(function(){
		$('#fare_trip').empty();
		$('#fare_trip').append('<option value="0">Select Fare Trip</option>');
		$('#fare_trip').val('0');		
		$('#fare_trip').prop("disabled", true);
		$("#fare_trip").select2();
		
		$('#fare_trip_dtl').empty();
		
		$('#vehicle').empty();
		$('#vehicle').append('<option value="0">Select Vehicle</option>');
		$('#vehicle').val('0');
		$('#vehicle').prop("disabled", true);		
		$("#vehicle").select2();
		
		$('#vehicle_category').empty();
		$('#vehicle_category').append('<option value="0">Select Vehicle Category</option>');
		$('#vehicle_category').val('0');
		$('#vehicle_category').prop("disabled", true);		
		$("#vehicle_category").select2();
		
		$('#driver').empty();
		$('#driver').append('<option value="0">Select Employee/Driver</option>');
		$('#driver').val('0');
		$('#driver').prop("disabled", true);
		$("#driver").select2();		
		
		var text_orginal=$(this).val();
		var text_length=text_orginal.length;
		var cash_advance_type = text_orginal.substr(0,text_length-1);
		var fare_trip_status = text_orginal.slice(-1);
        
        //alert(fare_trip_status);
		
		if(cash_advance_type!=0){
			if(fare_trip_status!='N'){
			     $.ajax({
						type: "POST",
						url : "<?php echo base_url('finances/get_detail_faretrip'); ?>",
						cache:false,
						dataType: 'json',
						success: function(msg){	
								obj = msg;
								if (obj.length > 0) {

									//Append the 'Select an ---' option
									//The option will be selected once all values are added
									//$('#fare_trip').append('<option value="0">Select Fare Trip</option>');

									//Add returned options
									$.each(obj, function (index, msg) {                
										valor = msg.rowID;
										texto = msg.fare_trip_no;
										$('#fare_trip').append('<option value=' + valor + '>' + texto + '</option>');
										$('#fare_trip').prop("readonly", false); 
									});   
								 
									//Remove disabled attribute
									$('#fare_trip').prop("disabled", false);
									
									//Re-initalise select2 - without this it doesn't accept the changed values
									$('#fare_trip').select2();
									
									//Select the option with value x
									//Include .trigger("change") to trigger change even if necessary
									$('#fare_trip').val(0).trigger("change"); //.trigger("change"); 
									
								}else{
									$('#fare_trip').empty();
									$('#fare_trip').append('<option value="0">Select Fare Trip</option>');
									$('#fare_trip').val(0).trigger("change");
									$('#fare_trip').prop("disabled", false);
								} 

						},
						error: function(xhr, status, error) {
							  
							document.write(xhr.responseText);
							alert(xhr.responseText);
						}
					});	
					
					//vehicle
					$.ajax({
						type: "POST",
						url : "<?php echo base_url('finances/get_detail_vehicle'); ?>",
						cache:false,
						dataType: 'json',
						success: function(msg){	
								obj = msg;
								
								if (obj.length > 1) {

									//Append the 'Select an ---' option
									//The option will be selected once all values are added
									//$('#vehicle').append('<option value="0">Select Vehicle</option>');

									//Add returned options
									$.each(obj, function (index, msg) {                
										valor = msg.rowID;
										texto = msg.police_no;
										$('#vehicle').append('<option value=' + valor + '>' + texto + '</option>');
										$('#vehicle').prop("readonly", false); 
									});   
								 
									//Remove disabled attribute
									$('#vehicle').prop("disabled", false);
									
									//Re-initalise select2 - without this it doesn't accept the changed values
									$('#vehicle').select2();
									
									//Select the option with value x
									//Include .trigger("change") to trigger change even if necessary
									$('#vehicle').val(0).trigger("change"); //.trigger("change"); 
									
								}else{
									$('#vehicle').empty();
									$('#vehicle').append('<option value="0">Select Vehicle</option>');
									$('#vehicle').val(0).trigger("change");
									$('#vehicle').prop("disabled", false);
								} 

						},
						error: function(xhr, status, error) {
							  
							document.write(xhr.responseText);
							alert(xhr.responseText);
						}
					});
					
					//vehicle catagories
					$.ajax({
						type: "POST",
						url : "<?php echo base_url('finances/get_detail_vehicle_category'); ?>",
						cache:false,
						dataType: 'json',
						success: function(msg){	
								obj = msg;
								
								if (obj.length > 1) {

									//Append the 'Select an ---' option
									//The option will be selected once all values are added
									//$('#vehicle').append('<option value="0">Select Vehicle</option>');

									//Add returned options
									$.each(obj, function (index, msg) {                
										valor = msg.rowID;
										texto = msg.type_cd;
										texto_1 = msg.type_name;
										$('#vehicle_category').append('<option value=' + valor + '>' + texto + '-' + texto_1 + '</option>');
										$('#vehicle_category').prop("readonly", false); 
									});   
								 
									//Remove disabled attribute
									$('#vehicle_category').prop("disabled", false);
									
									//Re-initalise select2 - without this it doesn't accept the changed values
									$('#vehicle_category').select2();
									
									//Select the option with value x
									//Include .trigger("change") to trigger change even if necessary
									$('#vehicle_category').val(0).trigger("change"); //.trigger("change"); 
									
								}else{
									$('#vehicle_category').empty();
									$('#vehicle_category').append('<option value="0">Select Vehicle Category</option>');
									$('#vehicle_category').val(0).trigger("change");
									$('#vehicle_category').prop("disabled", false);
								} 

						},
						error: function(xhr, status, error) {
							  
							document.write(xhr.responseText);
							alert(xhr.responseText);
						}
					});
					//get driver
					$.ajax({
						type: "POST",
						url : "<?php echo base_url('finances/get_detail_driver'); ?>",
						cache:false,
						dataType: 'json',
						success: function(msg){	
								obj = msg;
								
								if (obj.length > 1) {

									//Append the 'Select an ---' option
									//The option will be selected once all values are added
									//$('#vehicle').append('<option value="0">Select Vehicle</option>');

									//Add returned options
									$.each(obj, function (index, msg) {                
										valor = msg.rowID;
										texto = msg.name;
										$('#driver').append('<option value=' + valor + '>' + texto + '</option>');
										$('#driver').prop("readonly", false); 
									});   
								 
									//Remove disabled attribute
									$('#driver').prop("disabled", false);
									
									//Re-initalise select2 - without this it doesn't accept the changed values
									$('#driver').select2();
									
									//Select the option with value x
									//Include .trigger("change") to trigger change even if necessary
									$('#driver').val(0).trigger("change"); //.trigger("change"); 
									
								}else{
									$('#driver').empty();
									$('#driver').append('<option value="0">Select Employee/Driver</option>');
									$('#driver').val(0).trigger("change");
									$('#driver').prop("disabled", false);
								} 

						},
						error: function(xhr, status, error) {
							  
							document.write(xhr.responseText);
							alert(xhr.responseText);
						}
					});	
			}else{
					//get Employee
					$.ajax({
						type: "POST",
						url : "<?php echo base_url('finances/get_detail_employee'); ?>",
						cache:false,
						dataType: 'json',
						success: function(msg){	
								obj = msg;
								
								if (obj.length > 1) {

									//Append the 'Select an ---' option
									//The option will be selected once all values are added
									//$('#vehicle').append('<option value="0">Select Vehicle</option>');

									//Add returned options
									$.each(obj, function (index, msg) {                
										valor = msg.rowID;
										texto = msg.name;
										$('#driver').append('<option value=' + valor + '>' + texto + '</option>');
										$('#driver').prop("readonly", false); 
									});   
								 
									//Remove disabled attribute
									$('#driver').prop("disabled", false);
									
									//Re-initalise select2 - without this it doesn't accept the changed values
									$('#driver').select2();
									
									//Select the option with value x
									//Include .trigger("change") to trigger change even if necessary
									$('#driver').val(0).trigger("change"); //.trigger("change"); 
									
								}else{
									$('#driver').empty();
									$('#driver').append('<option value="0">Select Employee/Driver</option>');
									$('#driver').val(0).trigger("change");
									$('#driver').prop("disabled", false);
								} 

						},
						error: function(xhr, status, error) {
							  
							document.write(xhr.responseText);
							alert(xhr.responseText);
						}
					});
			}
					
		}
		
		
	$("#vehicle").click(function(){
		
		var fare_trip_rowID=$('#fare_trip').val();	
        alert (fare_trip_rowID);	
		var rowID=$('#vehicle').val();

		if (fare_trip_rowID!=0){					
			
					$.ajax({
						type: "POST",
						url : "<?php echo base_url('vehicle/get_vehicle_details'); ?>",
						data: "rowID="+rowID+"&fare_trip_rowID="+fare_trip_rowID+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
						cache:false,
						dataType: 'json',
						success: function(msg){	
								obj = msg;

								if (obj.length > 0) {
									$.each(obj, function (index, msg) { 
											
											
											$('#driver').prop("disabled", false);
											$('#vehicle_category').select2();
											$('#vehicle_category').select2('val',msg.vehicle_type_rowID).trigger("change");//.trigger("change"); 
		
											$('#driver').select2();
											$('#driver').val(msg.debtor_rowID).trigger("change"); //.trigger("change");
											$('#amount').val(msg.fare_trip_amounts);
											$('#amount').select();
											$('#amount').focus();	
								
										
									}); 
									
								}else{
											$('#vehicle_category').select2();
											$('#vehicle_category').select2('val',0).trigger("change");//.trigger("change"); 
											$('#driver').select2();
											$('#driver').select2('val',0).trigger("change"); //.trigger("change"); 
								} 

						},
						error: function(xhr, status, error) {
							  
							document.write(xhr.responseText);
							alert(xhr.responseText);
						}
					});

					

		}else{
			alert('Choose Fare Trip First');
            $('#fare_trip').select2();
											$('#fare_trip').val(0).trigger("change");//.trigger("change"); 
											$('#fare_trip').focus(); $('#vehicle').select2();
											$('#vehicle').val(0).trigger("change");//.trigger("change"); 
			
		}
	});

	$("#vehicle_category").click(function(){
		
		var fare_trip_rowID=$('#fare_trip').val();		
		var rowID=$('#vehicle').val();
		var vehicle_type_rowID=$('#vehicle_category').val();

		if (fare_trip_rowID!=0 && rowID!=0){					
			
					$.ajax({
						type: "POST",
						url : "<?php echo base_url('vehicle/get_vehicle_type_details'); ?>",
						data: "rowID="+rowID+"&fare_trip_rowID="+fare_trip_rowID+"&vehicle_type_rowID="+vehicle_type_rowID+
                                '&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
						cache:false,
						dataType: 'json',
						success: function(msg){	
								obj = msg;

								if (obj.length > 0) {
									$.each(obj, function (index, msg) { 
											
											
											$('#driver').prop("disabled", false);
											$('#vehicle_category').select2();
											$('#vehicle_category').val(msg.vehicle_type_rowID).trigger("change");//.trigger("change"); 
		
											$('#driver').select2();
											$('#driver').val(msg.debtor_rowID).trigger("change"); //.trigger("change");
											$('#amount').val(msg.fare_trip_amounts);
											$('#amount').select();
											$('#amount').focus();	
								
										
									}); 
									
								}else{
											$('#vehicle_category').select2();
											$('#vehicle_category').val(0).trigger("change");//.trigger("change"); 
											$('#driver').select2();
											$('#driver').val(0).trigger("change"); //.trigger("change"); 
								} 

						},
						error: function(xhr, status, error) {
							  
							document.write(xhr.responseText);
							//alert(xhr.responseText);
						}
					});

					

		}else{
			alert('Choose Fare Trip & Vehicle First');
			$('#fare_trip').select2();
			$('#fare_trip').val(0).trigger("change");//.trigger("change"); 
			$('#fare_trip').focus(); 
			$('#vehicle').select2();
			$('#vehicle').val(0).trigger("change");//.trigger("change"); 
			
		}
	});
	


	
    });
			
	/* $("#debtor_company").click(function (){
		//alert(document.getElementById("debtor_company").checked)
		if (document.getElementById("debtor_company").checked)
			{
				document.getElementById("debtor_id_type").disabled  = true;
				document.getElementById("debtor_id_number").disabled  = true;
				document.getElementById("debtor_hp1").disabled  = true;
				document.getElementById("debtor_hp2").disabled  = true;
				document.getElementById("debtor_pob").disabled  = true;
				document.getElementById("debtor_dob").disabled  = true;
			}
		else{
				document.getElementById("debtor_id_type").disabled  = false;
				document.getElementById("debtor_id_number").disabled  = false;
				document.getElementById("debtor_hp1").disabled  = false;
				document.getElementById("debtor_hp2").disabled  = false;
				document.getElementById("debtor_pob").disabled  = false;
				document.getElementById("debtor_dob").disabled  = false;
				
				
			}
		}); */
	/* $("#job_order_debtor").each(function(){
			var rowid = $(this).data('rowid');
			var data = [{ id: 0, text: 'enhancement' }, { id: 1, text: 'bug' }, { id: 2, text: 'duplicate' }, { id: 3, text: 'invalid' }, { id: 4, text: 'wontfix' }];
			$(this).select2({

  dropdownAutoWidth: true,
        width: 'resolve',
        placeholder: 'Search',
        minimumInputLength: 1,
        allowClear: true,
        delay: 2000,
        ajax: {
            dataType: "json",
            url: data,
            data: function (term, page) {
                return {
                    term: term
                };
            },
            results: function (data) {
                var results = [];

                $.each(data, function(index, item){
                    results.push({
                        id: item.debtor_code,
                        text: item.debtor_code + ' - ' + item.debtor_name,
                        rowid: rowid,
                        debtor_name: item.debtor_name
  
                    });
                });
                return { results: results };
            },
            cache: true
        }
			});
		});	 */
			
	
	
	$("#job_order_wo_no").change(function(){
		var wo_no=$('#job_order_wo_no').val();
		$.ajax({
					type: "POST",
					url: "<?php echo base_url('job_order/get_wo'); ?>",
					data: "wo_no="+wo_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
					cache:false,
					success: function(data){
						$('#trx_wo_code').html(data);
					}
				});
		});
		
	$("#job_order_debtor").change(function(){
		var debtor_rowID=$('#job_order_debtor').val();
		$.ajax({
				
					type: "POST",
					url: "<?php echo base_url('job_order/get_wo_debtor'); ?>",
					data: "debtor_rowID="+debtor_rowID+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
					cache:false,
					success: function(data){
						$('#job_order_wo_no').html(data);
					}
				});
		});
		
	$("#delivery_order_debtor").change(function(){
		var debtor_rowID=$('#delivery_order_debtor').val();
		$.ajax({
					type: "POST",
					url: "<?php echo base_url('delivery_order/get_jo_debtor'); ?>",
					data: "debtor_rowID="+debtor_rowID+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
					cache:false,
					success: function(data){
						$('#delivery_order_jo_no').html(data);
					}
				});
		});
		
	$("#delivery_order_jo_no").change(function(){
		var jo_no=$('#delivery_order_jo_no').val();
		$.ajax({
					type: "POST",
					url: "<?php echo base_url('delivery_order/get_wo'); ?>",
					data: "jo_no="+jo_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
					cache:false,
					success: function(data){
						$('#delivery_order_wo_no').html(data);
					}
				});
		});
		
		$("#site_cash_advance_driveremployee").change(function(){
		var debtor_rowID=$('#site_cash_advance_driveremployee').val();
		$.ajax({
					type: "POST",
					url: "<?php echo base_url('site_cash_advance/get_driver_vehicle'); ?>",
					data: "debtor_rowID="+debtor_rowID+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
					cache:false,
					success: function(data){//alert(data);
						$('#site_cash_advance_vehicle_type').html(data);
					}
				});
		});
		
		$("#site_cash_advance_driver").change(function(){
		var debtor_rowID=$('#delivery_order_driver').val();
		$.ajax({
					type: "POST",
					url: "<?php echo base_url('delivery_order/get_driver_vehicle'); ?>",
					data: "debtor_rowID="+debtor_rowID+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
					cache:false,
					success: function(data){
						$('#delivery_order_vehicle_type').html(data);
					}
				});
		});
		
		
	$("#debtor_code").change(function(){
		var debtor_cd= $('#debtor_code').val();
		
		$.ajax({
					type: "POST",
					
                    url: "<?php echo base_url('debtor/get_debtor_type2'); ?>",
					data: "debtor_cd="+debtor_cd+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
					cache:false,
                    dataType: "JSON",
					success: function(data){
						// $('[name="debtor_type_cd"]').val(data.type_cd);
                         if (data.category == 'C'){
                            $('[name="debtor_category_type"').val('C');
                         }else if (data.category == 'E'){
                            $('[name="debtor_category_type"').val('E'); 
                         }else if (data.category == 'D'){
                            $('[name="debtor_category_type"').val('D');
                         }
                         else if (data.category == 'M'){
                            $('[name="debtor_category_type"').val('M');
                         }
					}
				});
		});
		
	/* $("#site_cash_advance_cat").change(function(){
		var advance_type_rowID= $('#site_cash_advance_cat').val();
		$.ajax({
					type: "POST",
					url: "<?php echo base_url('site_cash_advance/get_by_jo'); ?>",
					data: "advance_type_rowID="+advance_type_rowID,
					cache:false,
					success: function(data){
						 $('#site_cash_advance_by_jo').html(data);
					},
				});
		});
		 */
	$("#site_cash_advance_cat").change(function(){
		var advance_type_rowID= $('#site_cash_advance_cat').val();
		$.ajax({
					type: "POST",
					url: "<?php echo base_url('site_cash_advance/get_by_jo'); ?>",
					data: "advance_type_rowID="+advance_type_rowID+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
					cache:false,
					success: function(data){ 
						if(data=="Y"){
							$("#tombol_add_jo").show();
							$("#site_cash_advance_amount1").hide();
						}else{
							$("#tombol_add_jo").hide();
							$("#site_cash_advance_amount1").show();
						}
					},
				});
		});
		
	$("#site_cash_advance_jo").click(function(){
		var jo_no=$('#site_cash_advance_jo').val();
		$.ajax({
					type: "POST",
					url: "<?php echo base_url('site_cash_advance/get_wo'); ?>",
					data: "jo_no="+jo_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
					cache:false,
					success: function(data){
						$('#site_cash_advance_by_jo').html(data);
					}
				});
		});
													
	
	$("#lihat").click(function (){
		    	$('#lihat').html('<center><img src="<?php echo base_url('resource/images/loading.gif')?>" /></center>');
				var comment_rowID= $(".baris:last").attr("comment_rowID");
				var rowID=$(".baris:last").attr("rowID")
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('comments/view/get_comments_more'); ?>",
					data: "comment_rowID="+comment_rowID+"&rowID="+rowID+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
					cache:false,
					success: function(html){
						if(html){
							$("#contentx").append(html);
							$('#lihat').html('<center>Lihat Berita Terdahulu</center>');
						}else{
							
							$('#lihat').replaceWith('<div id="lihat"><center>Tidak Ada Berita</center></div>');
						
						}
					}
				});
		    });

			
	$('#filter_vessel_id').change(function(){
		var vessel_id=parseInt($('#filter_vessel_id').val());
        
		$.ajax({
            type: "POST",
            url : "<?php echo base_url('orders/get_vessel_details'); ?>",
			data: "vesselid="+vessel_id+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
            cache:false,
            success: function(data){				
                    $('#detail_vessel').html(data);
            },
			error: function(xhr, status, error) {
				  
				document.write(xhr.responseText);
				alert(xhr.responseText);
			}
        });
	});
	
	$('#filter_client_id').change(function(){
		var client_id=parseInt($('#filter_client_id').val());
        var pathArray = window.location.pathname.split( '/' );
	
		$.ajax({
            type: "POST",
            url : "<?php echo base_url('orders/manage/get_client_order_list'); ?>",
			data: "clientid="+client_id+"&linkdata="+pathArray[4]+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
            cache:false,
            success: function(data){				
                    $('#detail_client_order_list').html(data);
            },
			error: function(xhr, status, error) {
				  
				document.write(xhr.responseText);
				alert(xhr.responseText);
			}
        });
	});

	$('#barcode_id').keydown(function(){
		if (event.keyCode == 13)  {
			var barcode_id=parseInt($('#barcode_id').val());
			$.ajax({
				type: "POST",
				url : "<?php echo base_url('orders/get_barcode_details'); ?>",
				data: "barcode_id="+barcode_id+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
				cache:false,
				success: function(data){				
						$('#barcode_details').html(data);
				},
				error: function(xhr, status, error) {
					  
					document.write(xhr.responseText);
					alert(xhr.responseText);
				}
			});

		}
	});

	$('#barcode_id_receipt').keydown(function(){
		if (event.keyCode == 13)  {
			var barcode_id=parseInt($('#barcode_id_receipt').val());
			//$('#barcode_id_receipt').disable();
			document.getElementById("barcode_id_receipt").disabled  = true;
			$.ajax({
				type: "POST",
				url : "<?php echo base_url('orders/get_barcode_receipt_details'); ?>",
				data: "barcode_id="+barcode_id+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
				cache:false,
				success: function(data){				
						$('#document_details').html(data);
				},
				error: function(xhr, status, error) {
					  
					document.write(xhr.responseText);
					alert(xhr.responseText);
				}
			});

		}
	});	

	$('#barcode_id_recap').keydown(function(){
		if (event.keyCode == 13)  {
		
			
/* 			if(!isFinite($("#barcode_id_recap").val())){
			alert("Harus diisi dengan angka");
			$("#barcode_id_recap").val("");
			return false;
			}else{
				
			} */
			var barcode_id_recap=$('#barcode_id_recap').val();
			//$('#barcode_id_receipt').disable();
			document.getElementById("barcode_id_recap").disabled  = true;
				
			$.ajax({
				type: "POST",
				url : "<?php echo base_url('orders/manage/get_detail_sj'); ?>",
				data: "sj_ref="+barcode_id_recap+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
				cache:false,
				success: function(data){ 
					if (data == "Data tidak ditemukan / telah terhapus") {	
					alert("Data tidak ditemukan / telah terhapus");
					$("#barcode_id_recap").val("");
		
					document.getElementById("barcode_id_recap").disabled  = false;
					document.getElementById("barcode_id_recap").focus()  = true; 
					document.getElementById("sj_submit").disabled  = true;	
						document.getElementById("sj_reset").disabled  = true;		
					}else{
						document.getElementById("sj_submit").disabled  = false;	
						document.getElementById("sj_reset").disabled  = false;							
						$('#detail_sj').html(data);
				}
				},
				error: function(xhr, status, error) {
					  
					document.write(xhr.responseText);
					alert(xhr.responseText);
				}
			});

		}
	});	

	$('#sj_submit').click(function(){
		var sj_id=parseInt($('#sj_id').val());
		var recap_id=parseInt($('#recap_id').val());	
		var recap_no=parseInt($('#recap_no').val());
		$.ajax({
            type: "POST",
            url : "<?php echo base_url('orders/manage/list_sj_recap'); ?>",
			data: "sj_id="+sj_id+"&recap_id="+recap_id+"&recap_no="+recap_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
            cache:false,
            success: function(data){
				

					$("#total_difference").val(data.qty_difference);$('#total_item_unload').hide();$('#total_receipts').hide();$('#total_difference').hide();
					document.getElementById("sj_submit").disabled  = true;
					document.getElementById("sj_reset").disabled  = true;	
					$("#detail_sj").children().remove();
					$("#list_sj").children().remove();
					//$("#tes").children().remove();
					//$('#tbl-orders').dataTable().fnDestroy();
					//$('#tbl-recap-orders').dataTable().fnDestroy();					
                    $('#list_sj').html(data);
					$('#tbl-recap-orders').dataTable({
		"bProcessing": true,
      "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
      "sPaginationType": "full_numbers",
	});
					$("#barcode_id_recap").val("");
		
		document.getElementById("barcode_id_recap").disabled  = false;
        document.getElementById("barcode_id_recap").focus()  = true;  
				
				//document.getElementById("total_item_unload").hide(true);	
            },
			error: function(xhr, status, error) {
				  
				document.write(xhr.responseText);
				alert(xhr.responseText);
			}
        });

	});
	$('#sj_reset').click(function(){
		//document.getElementById("barcode_id_recap").reload(true);
		//document.getElementById("barcode_id_recap").focus()  = false;
		//var newhtml="<input type='text' name='barcode_id_recap' id='barcode_id_recap' placeholder='Input te' class='form-control' autocomplete='off' autofocus >";
		//document.getElementById("barcode_id_recap").innerHTML=newhtml;
		$("#barcode_id_recap").val("");					document.getElementById("sj_submit").disabled  = true;
					document.getElementById("sj_reset").disabled  = true;
		$("#detail_sj").children().remove();
		document.getElementById("barcode_id_recap").disabled  = false;
        document.getElementById("barcode_id_recap").focus()  = true; 
		//document.getElementById("detail_sj").innerHTML = "";


	});

	$('#showhidedetails').click(function(){

		var recap_id=parseInt($('#recap_id').val());	

		$.ajax({
            type: "POST",
            url : "<?php echo base_url('orders/manage/view_recaplistsj'); ?>",
			data: "recap_id="+recap_id+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
            cache:false,
            success: function(data){
						
                   $("#list_sj").children().remove();					
                    $('#list_sj').html(data);
					$('#tbl-recap-orders').dataTable({
		"bProcessing": true,
      "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
      "sPaginationType": "full_numbers",
	});
            },
			error: function(xhr, status, error) {
				  
				document.write(xhr.responseText);
				alert(xhr.responseText);
			}
        });


	});
	
	$('#showhidescanbarcode').click(function(){
		if ( $(scanbarcode).css('display') == 'none' ){
				
			$("#scanbarcode").show();document.getElementById("barcode_id_recap").focus()  = true; 
		}else{
				$("#scanbarcode").hide();
		}
		 


	});	
	
	
	$('#order_list').click(function(){
	var client_id=parseInt($('#filter_client_id').val());
	var pathArray = window.location.pathname.split( '/' );
	
		$.ajax({
            type: "POST",
            url : "<?php echo base_url('orders/manage/get_client_order_list'); ?>",
			data: "clientid="+client_id+"&linkdata="+pathArray[4]+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
            cache:false,
            success: function(data){				
                    $('#detail_client_order_list').html(data);
            },
			error: function(xhr, status, error) {
				  
				document.write(xhr.responseText);
				alert(xhr.responseText);
			}
        });

	});	
	
	$('#vessel_active').click(function(){
	var pathArray = window.location.pathname.split( '/' );

		$.ajax({
            type: "POST",
            url : "<?php echo base_url('vessels/manage/get_vessel_active_list'); ?>",
			data: "pathArray="+pathArray[4]+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
            cache:false,
            success: function(data){				
                    $('#vessel_active_list').html(data);
            },
			error: function(xhr, status, error) {
				  
				document.write(xhr.responseText);
				alert(xhr.responseText);
			}
        });

	});
	$('#comment_lists').click(function(){
		var pathArray =parseInt($('#comment_lists').val());
		//$("#aside").show();
		alert(pathArray);
		

	});
	$('#qty_bulk_delivery_bruto').keyup(function(){

        var bruto=parseInt($('#qty_bulk_delivery_bruto').val());
        var tarra=parseInt($('#qty_bulk_delivery_tarra').val());
 
            
        var netto=bruto-tarra;
        $('#qty_bulk_delivery_netto').val(netto);
    });

	$('#qty_bulk_delivery_tarra').keyup(function(){

        var bruto=parseInt($('#qty_bulk_delivery_bruto').val());
        var tarra=parseInt($('#qty_bulk_delivery_tarra').val());
 
            
        var netto=bruto-tarra;
		if(netto<=0){alert('Netto must be great than 0(zero)');  $('#qty_bulk_delivery_netto').val(netto);return false;}
		
        $('#qty_bulk_delivery_netto').val(netto);
    });	
			
	$('#qty_bulk_delivery_bruto_receipt').keyup(function(){

        var bruto=parseInt($('#qty_bulk_delivery_bruto_receipt').val());
        var tarra=parseInt($('#qty_bulk_delivery_tarra_receipt').val());
 
            
        var netto=bruto-tarra;
        $('#qty_bulk_delivery_netto_receipt').val(netto);
    });

	$('#qty_bulk_delivery_tarra_receipt').keyup(function(){

        var bruto=parseInt($('#qty_bulk_delivery_bruto_receipt').val());
        var tarra=parseInt($('#qty_bulk_delivery_tarra_receipt').val());
 
            
        var netto=bruto-tarra;
		if(netto<=0){alert('Netto must be great than 0(zero)');  $('#qty_bulk_delivery_netto_receipt').val(netto);return false;}
		
        $('#qty_bulk_delivery_netto_receipt').val(netto);
    });

    $("#select2-option").change(function(){
        var truck_id = $("#select2-option").val();
            //query = {"truckid": $("#select2-option").val()}

        $.ajax({
            type: "POST",
            url : "<?php echo base_url('orders/manage/get_detail_pelanggan'); ?>",
			data: "truckid="+truck_id+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
            cache:false,
            success: function(data){				
                    $('#detail_pelanggan').html(data);
            },
			error: function(xhr, status, error) {
				  
				document.write(xhr.responseText);
				alert(xhr.responseText);
			}
        });
    });

	$("#select2-bonmuat").change(function(){
        var truck_id = $("#select2-bonmuat").val();


        $.ajax({
            type: "POST",
            url : "<?php echo base_url('orders/manage/get_detail_unloadreceipt'); ?>",
			data:  "truckid="+truck_id+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
            cache:false,
			dataType: 'json',
            success: function(val){
					
					$('#driver_name').val(val.driver_name);
					$('#select2-option').val(val.unload_receipt_id);
            },
			error: function(xhr, status, error) {
				  
				document.write(xhr.responseText);
				alert(xhr.responseText);
			}
        });
    });





});
function currencyFormatDE(num) {
    return num
       .toFixed(3) // always two decimal digits
       .replace(".", ",") // replace decimal point character with ,
       .replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") // use . as a separator
}


// deptor type 
    function add_debtor_type()
    {
        $('#form')[0].reset(); 
        $('#modal_form').modal('show'); 
        $('.modal-title').text('<?=lang('new_debtor_type')?>'); 
        $('[name="rowID"]').val('');
        $('[name="debtortype_type_cd"]').prop('readonly',false);
        $('[name="debtortype_receivable_acc"]').select2('val','');
        $('[name="debtortype_advance_acc"]').select2('val','');
        $('[name="debtortype_deposit_acc"]').select2('val','');
        $('[name="debtortype_rounding_acc"]').select2('val','');
        $('[name="debtortype_adm_acc"]').select2('val','');
        $('[name="debtortype_pay_acc"]').select2('val','');
        $('[name="debtortype_commission_acc"]').select2('val','');
    }
    
    function debtor_type_pdf(){
        window.open('<?php echo base_url('debtor_type/pdf')?>');
    }
    
    function debtor_type_excel(){
        window.open('<?php echo base_url('debtor_type/excel')?>');
    }
    
    function edit_debtor_type(id)
    {
      $('#form')[0].reset();
      $.ajax({
        url : "<?php echo base_url('debtor_type/get_data_edit/')?>/" + id,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {
            $('[name="rowID"]').val(data.rowID);
            $('[name="debtortype_type_cd"]').val(data.type_cd);
            $('[name="debtortype_name"]').val(data.name);
            $('[name="category"]').val(data.category);
            $('[name="debtortype_receivable_acc"]').select2('val',data.receiveable_coa_rowID);
            $('[name="debtortype_advance_acc"]').select2('val',data.advance_coa_rowID);
            $('[name="debtortype_deposit_acc"]').select2('val',data.deposit_coa_rowID);
            $('[name="debtortype_rounding_acc"]').select2('val',data.rounding_coa_rowID);
            $('[name="debtortype_adm_acc"]').select2('val',data.adm_coa_rowID);
            $('[name="debtortype_pay_acc"]').select2('val',data.payable_coa_rowID);
            $('[name="debtortype_commission_acc"]').select2('val',data.commission_coa_rowID);
            
            $('[name="debtortype_type_cd"]').prop('readonly',true);
            $('#modal_form').modal('show');
            $('.modal-title').text('Edit'); 
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

    }


    function delete_debtor_type(id)
    {
        swal({
          title: "Are you sure?",
          text: "delete this data!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#f0ad4e",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: false
        },
        function(){
          
              $.ajax({
                url : "<?php echo base_url('debtor_type/delete_data/')?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {

                    swal("Deleted!", "<?=lang('debtortype_deleted_successfully') ?>.", "success");
                    $('#modal_form').modal('hide');
                    location.replace("<?php echo base_url('debtor_type')?>");
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    swal("Oops!", "Error delete data", "error");
                }
            });
        });

    }

function save_deptor_type(){
    var rowID = $('[name="rowID"]').val();
    var debtortype_type_cd = $('[name="debtortype_type_cd"]').val();
    var debtortype_name    = $('[name="debtortype_name"]').val();
    var category = $('#category').val();
    var debtortype_receivable_acc = $('#debtortype_receivable_acc').val();
    var debtortype_advance_acc = $('#debtortype_advance_acc option:selected').val();
    var debtortype_deposit_acc = $('#debtortype_deposit_acc option:selected').val();
    var debtortype_rounding_acc = $('#debtortype_rounding_acc option:selected').val();
    var debtortype_adm_acc = $('#debtortype_adm_acc option:selected').val();
    var debtortype_pay_acc = $('#debtortype_pay_acc option:selected').val();
    var debtortype_commission_acc = $('#debtortype_commission_acc option:selected').val();
    
    var validasi="";
    
    var data1=cekValidasi(debtortype_type_cd,'<?=lang('debtortype_type_cd')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(debtortype_name,'<?=lang('debtortype_name')?>','<?=lang('not_empty')?>');
    var data3=cekValidasi(category,'<?=lang('debtortype_category')?>','<?=lang('not_empty')?>');
    var data4=cekValidasi(debtortype_receivable_acc,'<?=lang('debtortype_receivable_acc')?>','<?=lang('not_empty')?>');
    //var data5=cekValidasi(debtortype_advance_acc,'<?=lang('debtortype_advance_acc')?>','<?=lang('not_empty')?>');
    //var data6=cekValidasi(debtortype_deposit_acc,'<?=lang('debtortype_deposit_acc')?>','<?=lang('not_empty')?>');
    
    validasi=data1+data2+data3+data4;
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{ 
      			sweetAlert({
                          title: "Are you sure?",
                          text: "Are you want to Save?",
                          type: "warning",
                          showCancelButton: true,
                          confirmButtonColor: "#286090",
                          confirmButtonText: "Yes, Save !",
                          closeOnConfirm: true,
                          html: false
                        },function(r){ 
                            if (r){
                                  var dataString = "rowID="+rowID+"&debtortype_type_cd="+debtortype_type_cd+"&debtortype_name="+debtortype_name+"&category="+category+
                                  "&debtortype_receivable_acc="+debtortype_receivable_acc+"&debtortype_advance_acc="+debtortype_advance_acc+
                                  "&debtortype_deposit_acc="+debtortype_deposit_acc+"&debtortype_rounding_acc="+debtortype_rounding_acc+
                                  "&debtortype_adm_acc="+debtortype_adm_acc+"&debtortype_pay_acc="+debtortype_pay_acc+"&debtortype_commission_acc="+debtortype_commission_acc+
                                  '&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>';
                                  
                                  $.ajax({
                                    url : "<?php echo base_url('debtor_type/create')?>",
                                    type: "POST",
                                    data: dataString,//$('#form').serialize(),
                                    dataType: "JSON",
                                    success: function(result)
                                    {
                                        if (result.success){ 
                                            $('#modal_form').modal('hide');
                                            //swal("Save!", "Data has been Saved.", "success");
                                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                                            location.replace("<?php echo base_url('debtor_type')?>");
                                        }else{
                                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                                        }
                                    },
                                    error: function (jqXHR, textStatus, errorThrown)
                                    {
                                        swal("Oops!", "Error adding / update data", "error");
                                    }
                                });  
                            }
                        });
    }
}

// end deptor type

// Vehicle

function add_vehicle()
{
  save_method = 'add';
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text('<?=lang('new_vehicle')?>'); 
  
  $('[name="rowID"]').val('');
  $('[name="vehicle_driver"]').select2('val','');
  $('#vehicle_police_no').prop('readonly', false);

  setTimeout(function() { $('input[name="vehicle_police_no"]').focus() }, 800);
  $(".chk_vehicle").bootstrapSwitch('state',true);

}
   
function vehicle_pdf(){
    window.open('<?php echo base_url('vehicle/pdf')?>');
} 

function vehicle_excel(){
    window.open('<?php echo base_url('vehicle/excel')?>');
}

function vehicle_document_pdf(){
    window.open('<?php echo base_url('vehicle_document/pdf')?>');
} 

function vehicle_document_excel(){
    window.open('<?php echo base_url('vehicle_document/excel')?>');
}      
 
function vehicle_document_filter(){
    $('#start_date').datetimepicker({
		format: 'DD-MM-YYYY',
        defaultDate:'<?=date('d/m/Y', strtotime($start_date))?>'
	});

	$('#end_date').datetimepicker({
		format: 'DD-MM-YYYY',
        defaultDate:'<?=date('d/m/Y', strtotime($end_date))?>',
		useCurrent: false //Important! See issue #1075
	});
    
    $("#start_date").on("dp.change", function (e) {
		$('#end_date').data("DateTimePicker").minDate(e.date);
	});
	
	$("#end_date").on("dp.change", function (e) {
		$('#start_date').data("DateTimePicker").maxDate(e.date);
	});

    <?php
    if($this->session->userdata('expired_start_date') == '' && $this->session->userdata('expired_end_date') == ''){
	   echo "$('#filter_type').val('All');";
	   echo "$('#periode_filter').hide();";
    }
    else{
	   echo "$('#filter_type').val('Periode');";
       echo "$('#periode_filter').show();";
    }
    ?>
}    

function view_vehicle_photo(id,police_no,vehicle_photo){
  $('[name="upload_rowid"]').val(id);  
  $('#police_no_photo').html(police_no);
  $('#modal_form_upload').modal('show'); 
  
  if(vehicle_photo == ''){
      $('#vehicle_photo').attr('src','<?=base_url()?>resource/images/truck.png');
  }
  else{
      $('#vehicle_photo').attr('src','<?=base_url()?>resource/images/vehicle/' + vehicle_photo);
      $('#vehicle_photo').attr('style','width:80%;height:350px;');
  }  
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
        var toMmDdYy = function(input) {
            var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
            if(!input || !input.match(ptrn)) {
                return null;
            }
            return input.replace(ptrn, '$3-$2-$1');
        };

        $('[name="rowID"]').val(data.rowID);
        $('[name="dep_id"]').select2('val',data.dep_rowID);
        $('[name="vehicle_police_no"]').val(data.police_no);
        $('[name="vehicle_type"]').val(data.vehicle_type);
        $('[name="vehicle_gps"]').val(data.gps_no);
        $('[name="vehicle_driver"]').select2('val',data.debtor_rowID);
        $('#vehicle_police_no').prop('readonly', true);
        
        var status_stnk = true;            
        if(data.status_stnk == 'fotocopy')
            status_stnk = false;
        
        $('[name="no_stnk"]').val(data.no_stnk);
        $('[name="expired_stnk"]').val(toMmDdYy(data.expired_stnk));
        $("#status_stnk").bootstrapSwitch('state',status_stnk);

        var status_kir = true;            
        if(data.status_kir == 'fotocopy')
            status_kir = false;
        
        $('[name="no_kir"]').val(data.no_kir);
        $('[name="expired_kir"]').val(toMmDdYy(data.expired_kir));
        $("#status_kir").bootstrapSwitch('state',status_kir);

        var status_bpkb = true;            
        if(data.status_bpkb == 'fotocopy')
            status_bpkb = false;
        
        $('[name="no_bpkb"]').val(data.no_bpkb);
        $("#status_bpkb").bootstrapSwitch('state',status_bpkb);

        var status_insurance = true;            
        if(data.status_insurance == 'fotocopy')
            status_insurance = false;

        $('[name="no_insurance"]').val(data.no_insurance);
        $('[name="expired_insurance"]').val(toMmDdYy(data.expired_insurance));
        $("#status_insurance").bootstrapSwitch('state',status_insurance);
        
        var status_kiu = true;            
        if(data.status_kiu == 'fotocopy')
            status_kiu = false;
        
        $('[name="no_kiu"]').val(data.no_kiu);
        $('[name="expired_kiu"]').val(toMmDdYy(data.expired_kiu));
        $("#status_kiu").bootstrapSwitch('state',status_kiu);
        
        $('#modal_form').modal('show');
        $('.modal-title').text('Edit'); 
        
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
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
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('vehicle/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               
               swal("Deleted!", "Data has been deleted.", "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('vehicle')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}



function save_vehicle(){
    var vehicle_police_no = $('[name="vehicle_police_no"]').val();
    var validasi="";
    
    var data1=cekValidasi(vehicle_police_no,'<?=lang('vehicle_police_no')?>','<?=lang('not_empty')?>');
    validasi=data1;
    
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){

                  $.ajax({
                    url : "<?php echo base_url('vehicle/create')?>",
                    type: "POST",
                    data: $('#form').serializeArray(),
                    dataType: "JSON",
                    success: function(data)
                    {
                        if (data.success){ 
                            $('#modal_form').modal('hide');
                            //swal("Save!", "Data has been Saved.", "success");
                            sweetAlert('<?=lang('information')?>',''+data.msg);   
                            location.replace("<?php echo base_url('vehicle')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+data.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / update data", "error");
                    }
                });  
            }
        });
    }
}


// end Vehicle 

// Vehicle Position 
function add_vehicle_position()
{
  save_method = 'add';
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text('<?=lang('new_vehicle_position')?>'); 
  
  $('[name="rowID"]').val('');
  $('[name="vehicle_id"]').select2('val','');

}
   
function vehicle_position_pdf(){
    window.open('<?php echo base_url('vehicle_position/pdf')?>');
} 

function vehicle_position_excel(){
    window.open('<?php echo base_url('vehicle_position/excel')?>');
}

function edit_vehicle_position(id)
{
  save_method = 'update';
  $('#form')[0].reset();
  $.ajax({
    url : "<?php echo base_url('vehicle_position/get_data_edit/')?>/" + id,
    type: "GET",
    dataType: 'json',
    success: function(data)
    {
        $('[name="rowID"]').val(data.rowID);
        $('[name="position"]').val(data.position);
        $('[name="note"]').val(data.note);
        $('[name="vehicle_id"]').select2('val',data.vehicle_id);
        
        $('#modal_form').modal('show');
        $('.modal-title').text('Edit'); 
        
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        swal("Oops!", "Error adding / update data", "error");
    }
});

}

function delete_vehicle_position(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('vehicle_position/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               
               swal("Deleted!", "Data has been deleted.", "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('vehicle_position')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}

function save_vehicle_position(){
    var vehicle_id = $('[name="vehicle_id"]').val();
    var validasi="";
    
    var data1=cekValidasi(vehicle_id,'<?=lang('vehicle_police_no')?>','<?=lang('not_empty')?>');
    validasi=data1;
    
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){

                  $.ajax({
                    url : "<?php echo base_url('vehicle_position/create')?>",
                    type: "POST",
                    data: $('#form').serializeArray(),
                    dataType: "JSON",
                    success: function(data)
                    {
                        if (data.success){ 
                            $('#modal_form').modal('hide');
                            //swal("Save!", "Data has been Saved.", "success");
                            sweetAlert('<?=lang('information')?>',''+data.msg);   
                            location.replace("<?php echo base_url('vehicle_position')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+data.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / update data", "error");
                    }
                });  
            }
        });
    }
}

// end Vehicle Position 

// Vehicle Condition 
function add_vehicle_condition()
{
  save_method = 'add';
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text('<?=lang('new_vehicle_condition')?>'); 
  
  $('[name="rowID"]').val('');
  $('[name="vehicle_id"]').select2('val','');

}

function history_vehicle_condition(vehicle_id, police_no)
{
  $.ajax({
        type: "POST",
        url : "<?php echo base_url(); ?>vehicle_condition/get_history_condition",
    	data: 'vehicle_id='+vehicle_id+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        dataType:"JSON",
        cache:false,
        success: function(result){
            
            $('#tbl_history').html('');

            var isi_table = '<thead>'+
                                '<th>No</th>' +
                				'<th><?=lang('vehicle_police_no')?></th>' +
                				'<th><?=lang('condition')?> </th>' +
                				'<th><?=lang('estimasi')?> </th>' +
                				'<th><?=lang('note')?> </th>' +
                				'<th><?=lang('date_created')?> </th>' +
                            '</thead>';
                
            var no = 1;
            var toDdMmYy = function(input) {
                var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
                if(!input || !input.match(ptrn)) {
                    return null;
                }
                return input.replace(ptrn, '$3-$2-$1');
            };
            
            $.each(result, function(key, data) {	
                var note = '-';
                if(data.note != '')
                    note = data.note;
                
                var estimasi = '-';
                if(data.estimasi == '1970-01-01' || data.estimasi == '0000-00-00')
                    estimasi = '-';
                else
                    estimasi = toDdMmYy(data.estimasi);
                    
				isi_table += '<tr>'+
                                '<td>'+no+'</td>' +
                                '<td>'+data.police_no+'</td>' +
                                '<td>'+data.condition+'</td>' +
                                '<td>'+estimasi+'</td>' +
                                '<td>'+note+'</td>' +
        						'<td>'+toDdMmYy(data.date_created)+'</td>' +  
                             '</tr>';
			     no++;
            });  
            
                      
            $('#tbl_history').append(isi_table);   
               
            $('#tbl_history').DataTable().destroy();
            $('#tbl_history').dataTable({
        		"bProcessing": true,
                "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
                "sPaginationType": "full_numbers",
        	});
            
        },
    	error: function(xhr, status, error) {
    		document.write(xhr.responseText);
    	}
    }); 
    
    $('#modal_history').modal('show'); 
    $('#police_no_history').text(police_no); 
  
}
   
function vehicle_condition_pdf(){
    window.open('<?php echo base_url('vehicle_condition/pdf')?>');
} 

function vehicle_condition_excel(){
    window.open('<?php echo base_url('vehicle_condition/excel')?>');
}

function edit_vehicle_condition(id)
{
  save_method = 'update';
  $('#form')[0].reset();
  $.ajax({
    url : "<?php echo base_url('vehicle_condition/get_data_edit/')?>/" + id,
    type: "GET",
    dataType: 'json',
    success: function(data)
    {
        var toMmDdYy = function(input) {
            var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
            if(!input || !input.match(ptrn)) {
                return null;
            }
            return input.replace(ptrn, '$3-$2-$1');
        };

        $('[name="rowID"]').val(data.rowID);
        $('[name="date_created"]').val(toMmDdYy(data.date_created));
        $('[name="condition"]').val(data.condition);
        $('[name="estimasi"]').val(toMmDdYy(data.estimasi));
        $('[name="note"]').val(data.note);
        $('[name="vehicle_id"]').select2('val',data.vehicle_id);
        
        $('#modal_form').modal('show');
        $('.modal-title').text('Edit <?=lang('vehicle_condition')?>'); 
        
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        swal("Oops!", "Error update data", "error");
    }
});

}

function delete_vehicle_condition(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('vehicle_condition/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               
               swal("Deleted!", "Data has been deleted.", "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('vehicle_condition')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}

function save_vehicle_condition(){
    var date_created = $('[name="date_created"]').val();
    var vehicle_id = $('[name="vehicle_id"]').val();
    var validasi="";
    
    var data1=cekValidasi(date_created,'<?=lang('date')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(vehicle_id,'<?=lang('vehicle_police_no')?>','<?=lang('not_empty')?>');
    validasi=data1+data2;
    
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){

                  $.ajax({
                    url : "<?php echo base_url('vehicle_condition/create')?>",
                    type: "POST",
                    data: $('#form').serializeArray(),
                    dataType: "JSON",
                    success: function(data)
                    {
                        if (data.success){ 
                            $('#modal_form').modal('hide');
                            //swal("Save!", "Data has been Saved.", "success");
                            sweetAlert('<?=lang('information')?>',''+data.msg);   
                            location.replace("<?php echo base_url('vehicle_condition')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+data.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / update data", "error");
                    }
                });  
            }
        });
    }
}

// end Vehicle Condition 

// Vehicle Order 

function vehicle_order_pdf(){
    window.open('<?php echo base_url('vehicle_order/pdf')?>');
} 

function vehicle_order_excel(){
    window.open('<?php echo base_url('vehicle_order/excel')?>');
}

// end Vehicle Order 

// order Type
function add_order_type()
{

  save_method = 'add';
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text('<?=lang('new_order_type')?>'); 
  
  $('[name="rowID"]').val('');
  $('[name="order_type_code"]').prop("readonly", false); 
}
function save_order_type(){
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('order_type/create')?>",
                    type: "POST",
                    data: $('#form').serialize(),
                    dataType: "JSON",
                    success: function(data)
                    {
                        if (data.success){ 
                            $('#modal_form').modal('hide');
                            //swal("Save!", "Data has been Saved.", "success");
                            sweetAlert('<?=lang('information')?>',''+data.msg);   
                            location.replace("<?php echo base_url('order_type')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+data.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / update data", "error");
                    }
                });  
            }
        });
}

function delete_order_type(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
          $.ajax({
            url : "<?php echo base_url('order_type/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               swal("Deleted!", "Data has been deleted.", "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('order_type')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });
}
function edit_order_type(id)
{
      $('#form')[0].reset();
      $.ajax({
        url : "<?php echo base_url('order_type/get_data_edit/')?>/" + id,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {
            $('[name="rowID"]').val(data.rowID);
            $('[name="order_type_type"]').val(data.type);
            $('[name="order_type_code"]').val(data.type_cd);
            $('[name="order_type_name"]').val(data.descs);
            
            $('[name="order_type_code"]').prop("readonly", true); 
            
            $('#modal_form').modal('show');
            $('.modal-title').text('Edit'); 
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error adding / update data", "error");
        }
    });
}

// end order Type
// Uom
function add_uom()
{
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text('<?=lang('new_uom')?>'); 
  
  $('[name="rowID"]').val('');
  $('[name="uom_code"]').prop("readonly", false); 
}

function uom_pdf(){
    window.open('<?php echo base_url('uom/pdf')?>');
} 

function uom_excel(){
    window.open('<?php echo base_url('uom/excel')?>');
}

function save_uom(){
    var uom_code = $('[name="uom_code"]').val();
    var uom_name = $('[name="uom_name"]').val();
    var validasi="";
    
    var data1=cekValidasi(uom_code,'<?=lang('uom_code')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(uom_name,'<?=lang('uom_name')?>','<?=lang('not_empty')?>');
    
    validasi=data1+data2;
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('uom/create')?>",
                    type: "POST",
                    data:  $('#form').serializeArray(), 
                    dataType: "JSON",
                    success: function(data)
                    {
                        if (data.success){ 
                            $('#modal_form').modal('hide');
                            //swal("Save!", "Data has been Saved.", "success");
                            sweetAlert('<?=lang('information')?>',''+data.msg);   
                            location.replace("<?php echo base_url('uom')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+data.msg); 
                        }   
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / update data", "error");
                    }
                });  
            }
        });
    }
}

function delete_uom(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
          $.ajax({
            url : "<?php echo base_url('uom/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               swal("Deleted!", "Data has been deleted.", "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('uom')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });
}

function edit_uom(id)
{
      $('#form')[0].reset();
      $.ajax({
        url : "<?php echo base_url('uom/get_data_edit/')?>/" + id,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {
            $('[name="rowID"]').val(data.rowID);
            $('[name="uom_code"]').val(data.uom_cd);
            $('[name="uom_name"]').val(data.descs);
            
            $('[name="uom_code"]').prop("readonly", true); 
            
            $('#modal_form').modal('show');
            $('.modal-title').text('Edit'); 
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error adding / update data", "error");
        }
    });
}

// end Uom

// Item
function add_item()
{
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text('<?=lang('new_item')?>'); 
  
  $('[name="rowID"]').val('');
  $('[name="uom_id"]').select2('val','');
  $('[name="item_code"]').prop("readonly", false); 
}


function item_pdf(){
        window.open('<?php echo base_url('item/pdf')?>');
}
function item_excel(){
        window.open('<?php echo base_url('item/excel')?>');
}

function save_item(){
    //alert ('tes');
    var item_code = $('[name="item_code"]').val();
    var item_name = $('[name="item_name"]').val();
    var uom_id    = $('[name="uom_id"]').val();
    var validasi="";
    
    var data1=cekValidasi(item_code,'<?=lang('item_code')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(item_name,'<?=lang('item_name')?>','<?=lang('not_empty')?>');
    var data3=cekValidasi(uom_id,'<?=lang('item_uom')?>','<?=lang('not_empty')?>');
    validasi=data1+data2+data3;
    
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('item/create')?>",
                    type: "POST",
                    data:  $('#form').serializeArray(), 
                    dataType: "JSON",
                    success: function(data)
                    {
                        if (data.success){ 
                            $('#modal_form').modal('hide');
                            //swal("Save!", "Data has been Saved.", "success");
                            sweetAlert('<?=lang('information')?>',''+data.msg);   
                            location.replace("<?php echo base_url('item')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+data.msg); 
                        }    
                        
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / update data", "error");
                    }
                });  
            }
        });
    }
}

function edit_item(id)
{
      $('#form')[0].reset();
      $.ajax({
        url : "<?php echo base_url('item/get_data_edit/')?>/" + id,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {
            $('[name="rowID"]').val(data.rowID);
            $('[name="item_code"]').val(data.item_cd);
            $('[name="item_name"]').val(data.item_name);
            $('[name="minimum"]').val(tandaPemisahTitik(data.minimum));
            $('[name="maximum"]').val(tandaPemisahTitik(data.maximum));
            $('[name="uom_id"]').select2('val',data.uom_rowID);
            
            $('[name="item_code"]').prop("readonly", true); 
            
            $('#modal_form').modal('show');
            $('.modal-title').text('Edit'); 
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error adding / update data", "error");
        }
    });
}

function delete_item(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
          $.ajax({
            url : "<?php echo base_url('item/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               swal("Deleted!", "Data has been deleted.", "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('item')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });
}

// end Item

// Reference
function add_reference()
{
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text('<?=lang('new_reference')?>'); 
  
  $('[name="rowID"]').val('');
}

function save_reference(){
    var reference = $('[name="reference"]').val();
    var validasi="";
    
    var data1=cekValidasi(reference,'<?=lang('reference')?>','<?=lang('not_empty')?>');
    validasi=data1;
    
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('vehicle_reference/create')?>",
                    type: "POST",
                    data:  $('#form').serializeArray(), 
                    dataType: "JSON",
                    success: function(data)
                    {
                        if (data.success){ 
                            $('#modal_form').modal('hide');
                            //swal("Save!", "Data has been Saved.", "success");
                            sweetAlert('<?=lang('information')?>',''+data.msg);   
                            location.replace("<?php echo base_url('vehicle_reference')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+data.msg); 
                        }    
                        
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / update data", "error");
                    }
                });  
            }
        });
    }
}

function edit_reference(id)
{
      $('#form')[0].reset();
      $.ajax({
        url : "<?php echo base_url('vehicle_reference/get_data_edit/')?>/" + id,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {
            $('[name="rowID"]').val(data.rowID);
            $('[name="reference"]').val(data.reference);
            
            $('#modal_form').modal('show');
            $('.modal-title').text('Edit Reference'); 
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error adding / update data", "error");
        }
    });
}

function delete_reference(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
          $.ajax({
            url : "<?php echo base_url('vehicle_reference/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               swal("Deleted!", "Data has been deleted.", "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('vehicle_reference')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });
}

// end Reference 

// Menu 
function add_menu()
{
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text('<?=lang('new_menu')?>'); 
  
  $('[name="seq_menu"]').val('');
  $('[name="parentid"]').select2('val','');
  
  $("#chk_status").bootstrapSwitch('state',true);
}

function changeOrderMenu(id){
    $('#view_'+id).hide();
    $('#input_'+id).show();
    $('#link_'+id).hide();
    $('#save_'+id).show();
    
}

function saveOrderMenu(id){
    $('#view_'+id).show();
    $('#input_'+id).hide();
    $('#link_'+id).show();
    $('#save_'+id).hide();
    
    sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('menu/update_data/')?>",
                    type: "POST",
                    dataType: 'json',
                    data:{
                        'seq_menu' : id,
                        'kd_menu' : $('#kode_menu_'+id).val(),
                        '<?=$this->security->get_csrf_token_name()?>' : '<?=$this->security->get_csrf_hash()?>'
                    },
                    success: function(data)
                    {
                        sweetAlert('<?=lang('information')?>',''+data.msg); 
                        location.replace("<?php echo base_url('menu')?>");
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error update data", "error");
                        changeOrderMenu(id);
                    }
                });
            }
        });
}

function save_menu(){
    var kd_menu = $('[name="kd_menu"]').val();
    var nm_menu = $('[name="nm_menu"]').val();
    var link_menu = $('[name="link_menu"]').val();
    var lang = $('[name="lang"]').val();
    var parentid = $('[name="parentid"]').val();
    
    var validasi="";
    
    var data1=cekValidasi(kd_menu,'<?=lang('menu_code')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(nm_menu,'<?=lang('menu_name')?>','<?=lang('not_empty')?>');
    var data3=cekValidasi(link_menu,'<?=lang('menu_link')?>','<?=lang('not_empty')?>');
    var data4=cekValidasi(lang,'<?=lang('menu_language')?>','<?=lang('not_empty')?>');
    var data5=cekValidasi(parentid,'<?=lang('menu_parent')?>','<?=lang('not_empty')?>');
    validasi=data1+data2+data3+data4+data5;
    
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('menu/create')?>",
                    type: "POST",
                    data:  $('#form').serializeArray(), 
                    dataType: "JSON",
                    success: function(data)
                    {
                        if (data.success){ 
                            $('#modal_form').modal('hide');
                            //swal("Save!", "Data has been Saved.", "success");
                            sweetAlert('<?=lang('information')?>',''+data.msg);   
                            location.replace("<?php echo base_url('menu')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+data.msg); 
                        }    
                        
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / update data", "error");
                    }
                });  
            }
        });
    }
}

function edit_menu(id)
{
      $('#form')[0].reset();
      $.ajax({
        url : "<?php echo base_url('menu/get_data_edit/')?>/" + id,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {
            $('[name="seq_menu"]').val(data.Seq_Menu);
            $('[name="kd_menu"]').val(data.Kd_Menu);
            $('[name="nm_menu"]').val(data.Nm_Menu);
            $('[name="link_menu"]').val(data.Link_Menu);
            $('[name="lang"]').val(data.Lang);
            $('[name="parentid"]').select2('val',data.ParentID);
            
            var status_value = true;
            
            if(data.status == '0')
                status_value = false;
            
            $("#chk_status").bootstrapSwitch('state',status_value);
            
            $('#modal_form').modal('show');
            $('.modal-title').text('Edit'); 
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error adding / update data", "error");
        }
    });
}

function delete_menu(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
          $.ajax({
            url : "<?php echo base_url('menu/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               swal("Deleted!", "Data has been deleted.", "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('menu')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });
}

// end Menu

// User Menu 
function add_usermenu()
{
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text('<?=lang('new_usermenu')?>'); 
  
  $('[name="rowID"]').val('');
  $('[name="kd_menu"]').select2('val','');
  $('[name="kd_menu_tmp"]').val('');
  
  $("#chk_status").bootstrapSwitch('state',true);
}

function save_usermenu(){
    var kd_menu = $('[name="kd_menu"]').val();
    
    var validasi="";
    
    var data1=cekValidasi(kd_menu,'<?=lang('menu_name')?>','<?=lang('not_empty')?>');
    validasi=data1;
    
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('users/usermenu/create')?>",
                    type: "POST",
                    data:  $('#form').serializeArray(), 
                    dataType: "JSON",
                    success: function(data)
                    {
                        if (data.success){ 
                            $('#modal_form').modal('hide');
                            //swal("Save!", "Data has been Saved.", "success");
                            sweetAlert('<?=lang('information')?>',''+data.msg);   
                            location.replace("<?php echo base_url('users/usermenu/setting/')?>/" + data.user_id);
                        }else{
                            sweetAlert('<?=lang('information')?>',''+data.msg); 
                        }    
                        
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / update data", "error");
                    }
                });  
            }
        });
    }
}

function edit_usermenu(id)
{
      $('#form')[0].reset();
      $.ajax({
        url : "<?php echo base_url('users/usermenu/get_data_edit/')?>/" + id,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {
            $('[name="rowID"]').val(data.rowID);
            $('[name="kd_menu_tmp"]').val(data.Kd_Menu);
            $('[name="kd_menu"]').select2('val',data.Kd_Menu);
            $('[name="availabled"]').val(data.Availabled);
            $('[name="created"]').val(data.Created);
            $('[name="viewed"]').val(data.Viewed);
            $('[name="updated"]').val(data.Updated);
            $('[name="deleted"]').val(data.Deleted);
            $('[name="approved"]').val(data.Approved);
            $('[name="verified"]').val(data.Verified);
            $('[name="fullaccess"]').val(data.FullAccess);
            $('[name="printlimited"]').val(data.PrintLimited);
            $('[name="printunlimited"]').val(data.PrintUnlimited);
            
            var status_value = true;
            
            if(data.StatusUsermenu == '0')
                status_value = false;
            
            $("#chk_status").bootstrapSwitch('state',status_value);
            
            $('#modal_form').modal('show');
            $('.modal-title').text('Edit'); 
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error adding / update data", "error");
        }
    });
}

function delete_usermenu(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
          $.ajax({
            url : "<?php echo base_url('users/usermenu/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               swal("Deleted!", "Data has been deleted.", "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('users/usermenu/setting/')?>/" + data.user_id);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });
}

// end Menu

// departemen 


function add_dept()
{
  save_method = 'add';
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text('<?=lang('new_department')?>'); 
  
    $('[name="rowID"]').val('');
    $('[name="department_code"]').prop('readonly',false);
    $('[name="departments_cash_gl_coa"]').select2('val','');
}

function dept_pdf(){
    window.open('<?php echo base_url('department/pdf')?>');
} 

function dept_excel(){
    window.open('<?php echo base_url('department/excel')?>');
}
    
function edit_dept(id)
{
  $('#form')[0].reset();
      $.ajax({
        url : "<?php echo base_url('department/get_data_edit/')?>/" + id,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {
            $('[name="rowID"]').val(data.rowID);
            $('[name="department_code"]').val(data.dep_cd);
            $('[name="department_name"]').val(data.dep_name);
            $('[name="pool"]').val(data.pool);
            $('[name="departments_cash_gl_coa"]').select2('val',data.cash_gl_rowID);
            $('[name="departments_cash_in_prefix"]').val(data.cash_in_prefix);
            $('[name="departments_cash_out_prefix"]').val(data.cash_out_prefix);
            
            $('[name="department_code"]').prop('readonly',true);
            $('#modal_form').modal('show');
            $('.modal-title').text('Edit'); 
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error adding / update data", "error");
        }
    });
}


function delete_dept(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('department/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               
               swal("Deleted!", "Data has been deleted.", "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('department')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}
    
    
function save_dept(){
    var department_code = $('[name="department_code"]').val();
    var department_name = $('[name="department_name"]').val();
    var departments_cash_gl_coa = $('#departments_cash_gl_coa option:selected').val();
    var departments_cash_in_prefix = $('[name="departments_cash_in_prefix"]').val();
    var departments_cash_out_prefix = $('[name="departments_cash_out_prefix"]').val();
    var validasi="";
    
    var data1=cekValidasi(department_code,'<?=lang('department_cd')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(department_name,'<?=lang('department_name')?>','<?=lang('not_empty')?>');
    var data3=cekValidasi(departments_cash_gl_coa,'<?=lang('departments_cash_gl_coa')?>','<?=lang('not_empty')?>');
    var data4=cekValidasi(departments_cash_in_prefix,'<?=lang('departments_cash_in_prefix')?>','<?=lang('not_empty')?>');
    var data5=cekValidasi(departments_cash_out_prefix,'<?=lang('departments_cash_out_prefix')?>','<?=lang('not_empty')?>');
    validasi=data1+data2+data3+data4+data5;
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('department/create')?>",
                    type: "POST",
                    data: $('#form').serialize(),
                    dataType: "JSON",
                    success: function(result)
                    {                 	            
                        if (result.success){ 
                            $('#modal_form').modal('hide');
                            //swal("Save!", "Data has been Saved.", "success");
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            location.replace("<?php echo base_url('department')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / update data", "error");
                    }
                    
                });  
            }
        });
    }
}
//end Departemen
//deptor -------

function add_debtor(){
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title-debtor').text('<?=lang('new_debtor_type')?>'); 
  $('[name="rowID"]').val('');
  
  $('#field_spare_driver').hide(); 
  $('#spare_driver').attr('checked',false);
  $('#finger_rowID').val('');
  $('#active_period').val('');
  $('#active_period').hide();
    
  $('[name="debtor_code"]').select2(); 
  $('[name="debtor_code"]').select2('val','');
  $('[name="debtor_code"]').attr('disabled',false);
}

function debtor_code_type(){
    if($('#debtor_code').val() == '2'){
        $('#field_spare_driver').show();
    }
    else{
        $('#field_spare_driver').hide();        
    }
    $('#spare_driver').attr('checked',false);
    $('#finger_rowID').val('');
    $('#active_period').val('');
    $('#active_period').hide();
}

function spare_driver_date(){
    if($('#spare_driver').is(':checked',true)) {
        $('#active_period').show();
    }
    else{
        $('#active_period').hide();        
    }
    $('#active_period').val('');
}

function upload_photo_debtor(id,personal_photo,ktp_photos,sim_photos){
  $('[name="upload_rowid"]').val(id);  
  $('#modal_form_upload').modal('show'); 
  
  if(personal_photo == ''){
      $('#personal_photo').attr('src','<?=base_url()?>resource/images/user.png');
  }
  else{
      $('#personal_photo').attr('src','<?=base_url()?>resource/images/debtor_photo/' + personal_photo);
  }

  if(ktp_photos == ''){
      $('#ktp_photos').attr('src','<?=base_url()?>resource/images/user.png');
  }
  else{
      $('#ktp_photos').attr('src','<?=base_url()?>resource/images/debtor_photo/' + ktp_photos);
  }

  if(sim_photos == ''){
      $('#sim_photos').attr('src','<?=base_url()?>resource/images/user.png');
  }
  else{
      $('#sim_photos').attr('src','<?=base_url()?>resource/images/debtor_photo/' + sim_photos);
  }
  
}

function debtor_pdf(){
    window.open('<?php echo base_url('debtor/pdf')?>');
} 

function debtor_excel(){
    window.open('<?php echo base_url('debtor/excel')?>');
}

function save_debtor(){
    
    var debtor_code     = $('[name="debtor_category_type"]').val();//$('[name="debtor_code"]').val();
    var debtor_category = $('#debtor_category').val();//$('[name="debtor_category"]').val();
    var debtor_name     = $('[name="debtor_name"]').val();        
    var validasi="";
    
    var data1=cekValidasi(debtor_code,'<?=lang('debtor_code_type')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(debtor_category,'<?=lang('debtortype_category')?>','<?=lang('not_empty')?>');
    var data3=cekValidasi(debtor_name,'<?=lang('debtor_name')?>','<?=lang('not_empty')?>');
    
    var data4='';
    var data5='';
    if(debtor_category == 'I'){
        data4=cekValidasi($('#debtor_no_ktp').val(),'<?=lang('debtor_no_ktp')?>','<?=lang('not_empty')?>');        
        data5=cekValidasi($('#debtor_expired_date_ktp').val(),'<?=lang('debtor_expired_date_ktp')?>','<?=lang('not_empty')?>');        
    }
    
    var data6='';
    if($('#spare_driver').is(':checked',true)) {
        data6=cekValidasi($('#active_period').val(),'Active Period','<?=lang('not_empty')?>'); 
    }
    
    validasi=data1+data2+data3+data4+data5+data6;  
     
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('debtor/create')?>",
                    type: "POST",
                    data: $('#form').serializeArray(),
                    dataType: "JSON",
                    success: function(data)
                    {                 	            
                        if(data.success){
                            $('#modal_form').modal('hide');
                            swal("Save!", data.msg, "success");
                            location.replace("<?php echo base_url('debtor')?>");
                        }
                        else{
                            swal("Oops!", data.msg, "error");
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / update data", "error");
                    }
                    
                });  
            }
        });
    } 
}

function edit_debtor(id)
{
  $('#form')[0].reset();
      $.ajax({
        url : "<?php echo base_url('debtor/get_data_edit/')?>/" + id,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {
            var toMmDdYy = function(input) {
                var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
                if(!input || !input.match(ptrn)) {
                    return null;
                }
                return input.replace(ptrn, '$3-$2-$1');
            };

            $('[name="rowID"]').val(data.rowID);
            $('[name="debtor_code"]').select2('destroy'); 
            $('[name="debtor_code"]').val(data.debtor_type_rowID);
            $('[name="debtor_code"]').attr('disabled',true);
            $('[name="debtor_category_type"]').val(data.type);
            $('[name="debtor_category"]').val(data.category);
            $('[name="debtor_type"]').val(data.debtor_type);
            $('[name="finger_rowID"]').val(data.finger_rowID);
            $('[name="debtor_no_ktp"]').val(data.no_ktp);
            $('[name="debtor_expired_date_ktp"]').val(toMmDdYy(data.expired_date_ktp));
            $('[name="debtor_id_type"]').val(data.id_type);
            $('[name="debtor_id_number"]').val(data.id_no);
            $('[name="debtor_expired_date_id"]').val(toMmDdYy(data.expired_date_id));
            $('[name="debtor_name"]').val(data.debtor_name);
            $('[name="debtor_address1"]').val(data.address1);
            $('[name="debtor_address2"]').val(data.address2);
            $('[name="debtor_address3"]').val(data.address3);
            $('[name="debtor_postal_code"]').val(data.post_cd);
            $('[name="debtor_phone1"]').val(data.telp_no1);
            $('[name="debtor_phone2"]').val(data.telp_no2);
            $('[name="debtor_fax1"]').val(data.fax_no1);
            $('[name="debtor_fax2"]').val(data.fax_no2);
            $('[name="debtor_contact"]').val(data.contact_prs);
            $('[name="debtor_website"]').val(data.website);
            $('[name="debtor_email"]').val(data.email);
            $('[name="debtor_hp1"]').val(data.hp_no1);
            $('[name="debtor_hp2"]').val(data.hp_no2);
            $('[name="debtor_gender"]').val(data.sex);
            $('[name="debtor_pob"]').val(data.pob);
            $('[name="debtor_dob"]').val(toMmDdYy(data.dob));
            $('[name="debtor_bank_account_no1"]').val(data.bank_acc1);
            $('[name="debtor_bank_account_name1"]').val(data.bank_acc_name1);
            $('[name="debtor_bank_account_no2"]').val(data.bank_acc2);
            $('[name="debtor_bank_account_name2"]').val(data.bank_acc_name2);
            $('[name="debtor_npwp"]').val(data.npwp_no);
            $('[name="debtor_npwp_registered"]').val(toMmDdYy(data.reg_date));
            $('[name="debtor_npwp_name"]').val(data.npwp_name);
            $('[name="debtor_npwp_address1"]').val(data.npwp_address1);
            $('[name="debtor_npwp_address2"]').val(data.npwp_address2);
            $('[name="debtor_npwp_address3"]').val(data.npwp_address3);
            
            if (data.category == 'C'){
                document.getElementById("D1").style.display = "none";
                document.getElementById("D2").style.display = "none";
            }else{
                document.getElementById("D1").style.display = "block";
                document.getElementById("D2").style.display = "block";
            }	
            
            if(data.type == 'D'){
                $('#field_spare_driver').show(); 
                if(data.spare_driver == 1){
                    $('#spare_driver').attr('checked',true);
                    $('#active_period').val(toMmDdYy(data.active_period));
                    $('#active_period').show();                                         
                }
                else{
                    $('#spare_driver').attr('checked',false);
                    $('#active_period').val('');
                    $('#active_period').hide();                                    
                }
            }
            else{
                $('#field_spare_driver').hide(); 
                $('#spare_driver').attr('checked',false);
                $('#active_period').val('');
                $('#active_period').hide();                
            }
          
            $('#modal_form').modal('show');
            $('.modal-title-debtor').text('Edit'); 
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error adding / update data", "error");
        }
    });
}

function delete_debtor(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('debtor/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               
               swal("Deleted!", "Data has been deleted.", "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('debtor')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}

// end deptor ---

// Deposit 
function add_deposit(){
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text('<?=lang('new_deposit')?>'); 
  
  $('[name="rowID"]').val('');
  $('[name="debtor_rowID"]').select2('val','');
}

function deposit_pdf(){
    window.open('<?php echo base_url('deposit/pdf')?>');
}

function deposit_excel(){
    window.open('<?php echo base_url('deposit/excel')?>');
}

function save_deposit(){
    
    var date       = $('[name="date"]').val();
    var debtor_rowID  = $('[name="debtor_rowID"]').val();        
    var amount     = $('[name="amount"]').val();        
    var remark     = $('[name="remark"]').val();  
    var validasi="";
    
    var data1=cekValidasi(date,'<?=lang('date')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(debtor_rowID,'<?=lang('debtor_name')?>','<?=lang('not_empty')?>');
    var data3=cekValidasi(amount,'<?=lang('amount')?>','<?=lang('not_empty')?>');
    var data4=cekValidasi(remark,'<?=lang('remark')?>','<?=lang('not_empty')?>');
    validasi=data1+data2+data3+data4;  
     
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                if(clickSave == 0){
                    clickSave++;
                
                    $.ajax({
                        url : "<?php echo base_url('deposit/create')?>",
                        type: "POST",
                        data: $('#form').serializeArray(),
                        dataType: "JSON",
                        success: function(result)
                        {  
                            if (result.success){ 
                                $('#modal_form').modal('hide');
                                sweetAlert('<?=lang('information')?>',''+result.msg);   
                                location.replace("<?php echo base_url('deposit')?>");
                            }else{
                                sweetAlert('<?=lang('information')?>',''+result.msg); 
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal("Oops!", "Error saving data", "error");
                            clickSave = 0;
                        }
                        
                    });  
                }
                else{
                    alert('<?=lang('data_in_process')?>');
                }
            }
        });
    } 
}

function delete_deposit(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('deposit/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               
               swal("Deleted!", "Data has been deleted.", "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('deposit')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}

function edit_deposit(id)
{
  $('#form')[0].reset();
      $.ajax({
        url : "<?php echo base_url('deposit/get_data_edit')?>/" + id,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {
            var toDdMmYy = function(input) {
                var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
                if(!input || !input.match(ptrn)) {
                    return null;
                }
                return input.replace(ptrn, '$3-$2-$1');
            };

            $('[name="rowID"]').val(data.rowID);
            $('[name="date"]').val(toDdMmYy(data.date));
            $('[name="debtor_rowID"]').select2('val',data.debtor_rowID);
            $('[name="amount"]').val(tandaPemisahTitik(data.amount));
            $('[name="remark"]').val(data.remark);
            
            $('#modal_form').modal('show');
            $('.modal-title').text('Edit'); 
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error getting data", "error");
        }
    });
}

//  End Deposit 

// Vessel 
function add_vessel(){
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text('<?=lang('new_vessel')?>'); 
  
  $('[name="rowID"]').val('');
  $('[name="row_no"]').val('');
  $('#edit').val(''); 
  $('[name="original"]').attr('checked',false);
  $('[name="copy"]').attr('checked',false);
    
  clearAllDetailEta();
  
  // Sub Vessel
  $('[name="vessel_name"]').attr('readonly',false);
  $('[name="sub"]').val('');
  $('.sub').html('');
  // End Sub Vessel

  $('[name="trx_no"]').attr('readonly',false);

  $.ajax({
    type: "POST",
    url : "<?php echo base_url('vessel/get_data_port_warehouse'); ?>",
	data: 'port_warehouse=Port&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
    cache:false,
    success: function(result){
        $('#port_rowID').html(result);
        $('#port_rowID').select2('val','');
    },
	error: function(xhr, status, error) {
		document.write(xhr.responseText);
		alert(xhr.responseText);
	}
  }); 
  
  $.ajax({
    type: "POST",
    url : "<?php echo base_url('vessel/get_vessel_no'); ?>",
	data: '<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
    cache:false,
    success: function(data){
        $('#trx_no').val(data.trx_no);
    },
	error: function(xhr, status, error) {
		document.write(xhr.responseText);
		alert(xhr.responseText);
	}
  }); 

}

function vessel_pdf(){
    window.open('<?php echo base_url('vessel/pdf')?>');
}

function vessel_excel(){
    window.open('<?php echo base_url('vessel/excel')?>');
}

function save_vessel(){
    var date        = $('[name="date"]').val(); 
    var vessel_name = $('[name="vessel_name"]').val();      
    var port_rowID  = $('[name="port_rowID"]').val();         
    var validasi    ="";
    
    var data1=cekValidasi(date,'ETA <?=lang('date')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(vessel_name,'<?=lang('vessel_name')?>','<?=lang('not_empty')?>');
    var data3=cekValidasi(port_rowID,'<?=lang('port_warehouse')?>','<?=lang('not_empty')?>');
    var data_detail = '';

    /*
    if(totrowEta <= 0)
        data_detail = cekValidasi('','Detail ETA','<?=lang('not_empty')?>');            
    */
    
    validasi=data1+data2+data3+data_detail;  
     
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                if(clickSave == 0){
                    clickSave++;
                
                    $.ajax({
                        url : "<?php echo base_url('vessel/create')?>",
                        type: "POST",
                        data: $('#form').serializeArray(),
                        dataType: "JSON",
                        success: function(result)
                        {  
                            if (result.success){ 
                                $('#modal_form').modal('hide');
                                sweetAlert('<?=lang('information')?>',''+result.msg);   
                                location.replace("<?php echo base_url('vessel')?>");
                            }else{
                                sweetAlert('<?=lang('information')?>',''+result.msg); 
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal("Oops!", "Error saving data", "error");
                            clickSave = 0;
                        }
                        
                    });  
                }
                else{
                    alert('<?=lang('data_in_process')?>');
                }
            }
        });
    } 
}

function sub_vessel(id)
{
  $('#form')[0].reset();
  
  var y=totrowEta;
  for(x=1;x<=y;x++){
    if(document.getElementById("rowEta_"+x)){
        if(document.getElementById('rowEta_'+x)!=null){
            $('#rowEta_'+x).remove(); 
        }
    }
  }
  totrowEta=0;
  
  $.ajax({
    url : "<?php echo base_url('vessel/get_data_edit')?>/" + id,
    type: "GET",
    dataType: 'json',
    success: function(data)
    {
        var toDdMmYy = function(input) {
            var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
            if(!input || !input.match(ptrn)) {
                return null;
            }
            return input.replace(ptrn, '$3-$2-$1');
        };
        
        $('[name="rowID"]').val(data.rowID);
        $('[name="row_no"]').val(data.row_no);
        $('[name="date"]').val(toDdMmYy(data.eta_date));
        $('[name="vessel_name"]').val(data.vessel_name);
        $('[name="port_warehouse"]').val(data.port_type);
        $('[name="port_rowID"]').select2('val',data.port_rowID);
        $('[name="agent"]').val(data.agent);
        $('[name="status"]').val(data.status);
        $('[name="remark"]').val(data.remark);

        if(data.original == 1){
            $('[name="original"]').attr('checked',true);
        }
        else{
            $('[name="original"]').attr('checked',false);
        }
        if(data.copy == 1){
            $('[name="copy"]').attr('checked',true);
        }
        else{
            $('[name="copy"]').attr('checked',false);
        }            
        
        $.ajax({
            type: "POST",
            url : "<?php echo base_url('vessel/get_data_port_warehouse'); ?>",
        	data: "port_warehouse="+data.port_type+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
            cache:false,
            success: function(result){
                $('#port_rowID').html(result);
                $('#port_rowID').select2('val',data.port_rowID);
            },
        	error: function(xhr, status, error) {
        		document.write(xhr.responseText);
        		alert(xhr.responseText);
        	}
        }); 
        
        $.ajax({
            type: "POST",
            url : "<?php echo base_url('vessel/get_sub_vessel_no'); ?>",
        	data: 'id='+id+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
            cache:false,
            success: function(data_trx){
                $('#trx_no').val(data_trx.trx_no);
            },
        	error: function(xhr, status, error) {
        		document.write(xhr.responseText);
        		alert(xhr.responseText);
        	}
        }); 

        $('[name="trx_no"]').attr('readonly',false);
        
        // Sub Vessel
        $('[name="vessel_name"]').attr('readonly',true);
        $('[name="sub"]').val('Sub');
        $('.sub').html('Ex');
        // End Sub Vessel
        
        showDetailEta(data.trx_no);    
        
        $('#modal_form').modal('show');
        $('.modal-title').text('Sub <?=lang('vessel')?>'); 
        
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        swal("Oops!", "Error getting data", "error");
    }
  });
}

function edit_vessel(id)
{
  $('#form')[0].reset();
  $('#edit').val('edit');
  
  var y=totrowEta;
  for(x=1;x<=y;x++){
    if(document.getElementById("rowEta_"+x)){
        if(document.getElementById('rowEta_'+x)!=null){
            $('#rowEta_'+x).remove(); 
        }
    }
  }
  totrowEta=0;
  
  $.ajax({
    url : "<?php echo base_url('vessel/get_data_edit')?>/" + id,
    type: "GET",
    dataType: 'json',
    success: function(data)
    {
        var toDdMmYy = function(input) {
            var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
            if(!input || !input.match(ptrn)) {
                return null;
            }
            return input.replace(ptrn, '$3-$2-$1');
        };
         
        $('[name="rowID"]').val(data.rowID);
        $('[name="row_no"]').val(data.row_no);
        $('[name="trx_no"]').val(data.trx_no);
        $('[name="date"]').val(toDdMmYy(data.eta_date));
        $('[name="vessel_name"]').val(data.vessel_name);
        $('[name="port_warehouse"]').val(data.port_type);
        $('[name="port_rowID"]').select2('val',data.port_rowID);
        $('[name="agent"]').val(data.agent);
        $('[name="status"]').val(data.status);
        $('[name="remark"]').val(data.remark);
        
        $('[name="trx_no"]').attr('readonly',true);
        
        if(data.original == 1){
            $('[name="original"]').attr('checked',true);
        }
        else{
            $('[name="original"]').attr('checked',false);
        }
        if(data.copy == 1){
            $('[name="copy"]').attr('checked',true);
        }
        else{
            $('[name="copy"]').attr('checked',false);
        }            
        
        $.ajax({
            type: "POST",
            url : "<?php echo base_url('vessel/get_data_port_warehouse'); ?>",
        	data: "port_warehouse="+data.port_type+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
            cache:false,
            success: function(result){
                $('#port_rowID').html(result);
                $('#port_rowID').select2('val',data.port_rowID);
            },
        	error: function(xhr, status, error) {
        		document.write(xhr.responseText);
        		alert(xhr.responseText);
        	}
        }); 
        
        // Sub Vessel
        if(data.row_no == 0){
            $('[name="vessel_name"]').attr('readonly',false);                        
            $('.sub').html('');
        }
        else{
            $('[name="vessel_name"]').attr('readonly',true);            
            $('.sub').html('Ex');
        }
        $('[name="sub"]').val('');
        // End Sub Vessel
        
        showDetailEta(data.trx_no);    
        
        $('#modal_form').modal('show');
        $('.modal-title').text('Edit <?=lang('vessel')?>'); 
        
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        swal("Oops!", "Error getting data", "error");
    }
  });
}

function delete_vessel(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('vessel/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               
               swal("Deleted!", data.msg, "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('vessel')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}

function show_port_warehouse(){
    var port_warehouse = $('#port_warehouse').val();
    $.ajax({
        type: "POST",
        url : "<?php echo base_url('vessel/get_data_port_warehouse'); ?>",
    	data: "port_warehouse="+port_warehouse+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        cache:false,
        success: function(data){
            $('#port_rowID').html(data);
            $('#port_rowID').select2('val','');
        },
    	error: function(xhr, status, error) {
    		document.write(xhr.responseText);
    		alert(xhr.responseText);
    	}
    });      
}

var totrowEta = 0;

function add_eta(){
    var date        = $('[name="date"]').val(); 
    var vessel_name = $('[name="vessel_name"]').val();      
    var port_rowID  = $('[name="port_rowID"]').val();         
    var agent       = $('[name="agent"]').val();        
    var validasi    ="";
    
    var data1=cekValidasi(date,'ETA <?=lang('date')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(vessel_name,'<?=lang('vessel_name')?>','<?=lang('not_empty')?>');
    var data3=cekValidasi(port_rowID,'<?=lang('port_warehouse')?>','<?=lang('not_empty')?>');
    var data4=cekValidasi(agent,'<?=lang('agent')?>','<?=lang('not_empty')?>');
    validasi=data1+data2+data3+data4;  
    
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        totrowEta++;
        
        var detailrow="";
        detailrow=detailrow+"<tr id='rowEta_"+totrowEta+"'>";
        
        detailrow=detailrow+"<td>";
        var tombolhapus="<input type='button' style='height:30px;width:30px;border:0px;background-image:url(\"<?= base_url();?>resource/images/delete.png\");background-repeat:no-repeat;' id='hapdetReimburse"+totrowEta+"'   title='Hapus Baris' value='&nbsp;' onclick='deleteDetailEta("+totrowEta+")' />";
        detailrow=detailrow+tombolhapus;    
        detailrow=detailrow+"</td>";
                                                
        detailrow=detailrow+"<td>";
        var eta_date="<input id='row_id_etb_"+totrowEta+"' name='row_id_etb[]' type='hidden' /><input class='form-control' id='etb_date_"+totrowEta+"' name='etb_date_vessel[]' type='text' style='text-align:center;height:30px;border:solid 1px #ccc;' />";
        detailrow=detailrow+eta_date;
        detailrow=detailrow+"</td>";
               
        detailrow=detailrow+"<td>";
        var remark="<textarea class='form-control' id='remark_"+totrowEta+"' name='remark_vessel[]' rows='1' maxlength='150'></textarea>";
        detailrow=detailrow+remark;
        detailrow=detailrow+"</td>";
               
        detailrow=detailrow+"</tr>";

        $('#detail_eta tr:last').after(detailrow);

        $('#etb_date_'+totrowEta).datepicker({
            format: 'dd-mm-yyyy',
            todayBtn: "linked",
        }).on('changeDate',function(ev){
            $('#etb_date_'+totrowEta).datepicker('hide');
    	});

    }
    
}

function deleteDetailEta(x){
    if($('#edit').val() == 'edit'){
        if(document.getElementById('rowEta_'+x)!=null){
            if($('#row_id_etb_'+x).val() != ''){
                swal({
                    title: "Are you sure?",
                    text: "delete this data!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#f0ad4e",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                },
                function(){
                  
                    $.ajax({
                        url : "<?php echo base_url('vessel/delete_detail_data')?>/" + $('#row_id_etb_'+x).val(),
                        type: "GET",
                        dataType: "JSON",
                        success: function(data)
                        {
                           
                           swal("Deleted!", data.msg, "success");
                           
                           $('#rowEta_'+x).remove(); 
                           
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal("Oops!", "Error delete data", "error");
                        }
                    });
                });
            }
            else{
                $('#rowEta_'+x).remove(); 
            }
        }
    }
    else{
        if(document.getElementById('rowEta_'+x)!=null){
            $('#rowEta_'+x).remove(); 
        }
    }
    
}

function clearAllDetailEta(){
    var y=totrowEta;
    for(x=1;x<=y;x++){
        if(document.getElementById("rowEta_"+x)){
		     deleteDetailEta(x);
       }
    }
    totrowEta=0;
}

function showDetailEta(trx_no){
    
    $.ajax({
        url:'<?php echo base_url(); ?>vessel/get_data_detail',
		type: "POST",
        data: "trx_no="+trx_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        dataType:"JSON",
		success: function(result){
    		var x=1;
            var toDdMmYy = function(input) {
                var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
                if(!input || !input.match(ptrn)) {
                    return null;
                }
                return input.replace(ptrn, '$3-$2-$1');
            };
            
    		$.each(result, function(key, val) {	
                add_eta();
                
                $('#row_id_etb_'+x).val(val.rowID);
                $('#etb_date_'+x).val(toDdMmYy(val.etb_date_vessel));
                $('#remark_'+x).val(val.remark_vessel);
                
        		x++;

      	    });
            
            totrowEta = x-1;
        }
        
   });

}

// End Vessel

//  Expense 
function add_expense(){
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text('<?=lang('expenses_details')?>'); 
  
  $('[name="rowID"]').val('');
  $('[name="expenses_account"]').select2('val','');
  $('[name="expenses_code"]').prop('readonly',false);
}

function expense_pdf(){
    window.open('<?php echo base_url('expense/pdf')?>');
}

function expense_excel(){
    window.open('<?php echo base_url('expense/excel')?>');
}

function save_expense(){
    
    var expenses_code     = $('[name="expenses_code"]').val();//$('[name="debtor_code"]').val();
    var expenses_name     = $('[name="expenses_name"]').val();//$('[name="debtor_category"]').val();        
    var expenses_account     = $('[name="expenses_account"]').val();//$('[name="debtor_category"]').val();        
    var ap_account     = $('[name="ap_account"]').val();//$('[name="debtor_category"]').val();        
    var reimburse_account     = $('[name="reimburse_account"]').val();//$('[name="debtor_category"]').val();        
    var advance_account     = $('[name="advance_account"]').val();//$('[name="debtor_category"]').val();        
    var validasi="";
    
    var data1=cekValidasi(expenses_code,'<?=lang('expenses_code')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(expenses_name,'<?=lang('expenses_name')?>','<?=lang('not_empty')?>');
    var data3=cekValidasi(expenses_account,'<?=lang('expenses_account')?>','<?=lang('not_empty')?>');
    var data4=cekValidasi(ap_account,'<?=lang('ap_account')?>','<?=lang('not_empty')?>');
    var data5=cekValidasi(reimburse_account,'<?=lang('reimburse_account')?>','<?=lang('not_empty')?>');
    var data6=cekValidasi(advance_account,'<?=lang('advance_account')?>','<?=lang('not_empty')?>');
    
    validasi=data1+data2+data3+data4+data5+data6;  
     
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('expense/create')?>",
                    type: "POST",
                    data: $('#form').serializeArray(),
                    dataType: "JSON",
                    success: function(result)
                    {  
                        if (result.success){ 
                            $('#modal_form').modal('hide');
                            //swal("Save!", "Data has been Saved.", "success");
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            location.replace("<?php echo base_url('expense')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / update data", "error");
                    }
                    
                });  
            }
        });
    } 
}

function delete_expense(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('expense/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               
               swal("Deleted!", "Data has been deleted.", "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('expense')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}


function edit_expense(id)
{
  $('#form')[0].reset();
      $.ajax({
        url : "<?php echo base_url('expense/get_data_edit/')?>/" + id,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {
            $('[name="rowID"]').val(data.rowID);
            $('[name="expenses_code"]').val(data.expense_cd);
            $('[name="expenses_name"]').val(data.descs);
            $('[name="advance_category"]').val(data.advance_category_rowID);
            $('[name="expenses_account"]').select2('val',data.expense_acc_rowID);
            $('[name="ap_account"]').select2('val',data.ap_acc_rowID);
            $('[name="reimburse_account"]').select2('val',data.reimburse_acc_rowID);
            $('[name="advance_account"]').select2('val',data.advance_acc_rowID);
            
            $('[name="expenses_code"]').prop('readonly',true);
            $('#modal_form').modal('show');
            $('.modal-title').text('Edit'); 
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error getting data", "error");
        }
    });
}

// end expense 

// cost code   
function add_cost_code(){
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text('<?=lang('cost_code_details')?>'); 
  
  $('[name="rowID"]').val('');
  $('[name="cost_code_wip"]').select2('val','');
  $('[name="cost_code_cogs"]').select2('val','');
  $('[name="cost_code_code"]').prop('readonly',false);
}

    function cost_pdf(){
        window.open('<?php echo base_url('cost_code/pdf')?>');
    }
    function cost_excel(){
        window.open('<?php echo base_url('cost_code/excel')?>');
    }

function save_cost_code(){
    
    var cost_code_code     = $('[name="cost_code_code"]').val();//$('[name="debtor_code"]').val();
    var cost_code_name     = $('[name="cost_code_name"]').val();//$('[name="debtor_category"]').val();        
    var validasi="";
    
    var data1=cekValidasi(cost_code_code,'<?=lang('cost_code_code')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(cost_code_name,'<?=lang('cost_code_name')?>','<?=lang('not_empty')?>');

    
    validasi=data1+data2;  
     
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('cost_code/create')?>",
                    type: "POST",
                    data: $('#form').serializeArray(),
                    dataType: "JSON",
                    success: function(result)
                    {  
                        if (result.success){ 
                            $('#modal_form').modal('hide');
                            //swal("Save!", "Data has been Saved.", "success");
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            location.replace("<?php echo base_url('cost_code')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / update data", "error");
                    }
                    
                });  
            }
        });
    } 
}

function edit_cost_code(id)
{
  $('#form')[0].reset();
      $.ajax({
        url : "<?php echo base_url('cost_code/get_data_edit/')?>/" + id,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {
            $('[name="rowID"]').val(data.rowID);
            $('[name="cost_code_type"]').val(data.type);
            $('[name="cost_code_code"]').val(data.cost_cd);
            $('[name="cost_code_name"]').val(data.descs);
            $('[name="cost_code_wip"]').select2('val',data.wip_acc_rowID);
            $('[name="cost_code_cogs"]').select2('val',data.cogs_acc_rowID);
            $('[name="cost_code_site"]').val(data.site_flag);
            $('[name="cost_code_fare_trip_comp"]').val(data.fare_trip_comp);
            
            $('[name="cost_code_code"]').prop('readonly',true);
            $('#modal_form').modal('show');
            $('.modal-title').text('Edit'); 
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error adding / update data", "error");
        }
    });
}

function delete_cost_code(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('cost_code/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               
               swal("Deleted!", "Data has been deleted.", "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('cost_code')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}


	$("#cost_code_type").change(function (){
			var nilai= $('#cost_code_type').val();
			if (nilai == "H"){
			     $('#cost_code_wip').prop('readOnly',true);
                 $('[name="cost_code_wip"]').val(0);
                 $('#cost_code_cogs').prop('readOnly',true);
                 $('[name="cost_code_cogs"]').val(0);

			}else{
                 $('#cost_code_wip').prop('readOnly',false);
                 $('#cost_code_cogs').prop('readOnly',false);
			}	
		});
// end code 


// -income -
function add_income(){
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text('<?=lang('income_Detail')?>'); 
}

    function income_pdf(){
        window.open('<?php echo base_url('income/pdf')?>');
    }

function save_income(){
    
    //var income_type  = $('#income_type').combobox('select');//$('[name="debtor_code"]').val();
    var income_code  = $('[name="income_code"]').val();//$('[name="debtor_category"]').val();     
    var income_name  = $('[name="income_name"]').val();   
    var validasi="";
    
    //var data1=cekValidasi(income_type,'<?=lang('income_type')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(income_code,'<?=lang('income_code')?>','<?=lang('not_empty')?>');
    var data3=cekValidasi(income_name,'<?=lang('income_name')?>','<?=lang('not_empty')?>');
    
    validasi=data2+data3;  
     
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('income/create')?>",
                    type: "POST",
                    data: $('#form').serializeArray(),
                    dataType: "JSON",
                    success: function(result)
                    {  
                        if (result.success){ 
                            $('#modal_form').modal('hide');
                            //swal("Save!", "Data has been Saved.", "success");
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            location.replace("<?php echo base_url('income')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / update data", "error");
                    }
                    
                });  
            }
        });
    } 
}

function edit_income(id)
{
  $('#form')[0].reset();
      $.ajax({
        url : "<?php echo base_url('income/get_data_edit/')?>/" + id,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {
            $('[name="rowID"]').val(data.rowID);
            $('[name="income_type"]').val(data.type);
            $('[name="income_code"]').val(data.income_cd);
            $('[name="income_name"]').val(data.descs);
            $('[name="income_accrued"]').val(data.accrued_coa_rowID);
            $('[name="income_account"]').val(data.income_coa_rowID);
            
            $('[name="income_code"]').prop('readonly',true);
            $('#modal_form').modal('show');
            $('.modal-title').text('Edit'); 
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error adding / update data", "error");
        }
    });
}


function delete_income(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('income/delete_data/')?>/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               
               swal("Deleted!", "Data has been deleted.", "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('income')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}

// -end income 
// -vehicle type -
function add_vehicle_type(){
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text('<?=lang('add_vehicle_type')?>'); 
  
  $('[name="rowID"]').val('');    
  $('[name="vehicle_type_code"]').prop('readonly',false);
}

function vehicle_category_pdf(){
    window.open('<?php echo base_url('vehicle_category/pdf')?>');
}
function vehicle_category_excel(){
    //alert('tes');
    window.open('<?php echo base_url('vehicle_category/excel')?>');
}

function save_vehicle_type(){
    
    var vehicle_type_code  = $('[name="vehicle_type_code"]').val();
    var vehicle_type_code  = $('[name="vehicle_type_code"]').val();   
    var vehicle_type_name  = $('[name="vehicle_type_name"]').val();
    var vehicle_type        = $('[name="vehicle_type"]').val();
    var vehicle_type_weight  = $('[name="vehicle_type_weight"]').val();
    var vehicle_type_max_weight  = $('[name="vehicle_type_max_weight"]').val();
    var vehicle_type_min_weight  = $('[name="vehicle_type_min_weight"]').val();   
    var validasi="";
    
    var data1=cekValidasi(vehicle_type_code,'<?=lang('vehicle_type_code')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(vehicle_type_code,'<?=lang('vehicle_type_code')?>','<?=lang('not_empty')?>');
    var data3=cekValidasi(vehicle_type_name,'<?=lang('vehicle_type_name')?>','<?=lang('not_empty')?>');
    var data4=cekValidasi(vehicle_type_weight,'<?=lang('vehicle_type_weight')?>','<?=lang('not_empty')?>');
    var data5=cekValidasi(vehicle_type_max_weight,'<?=lang('vehicle_type_max_weight')?>','<?=lang('not_empty')?>');
    var data6=cekValidasi(vehicle_type_min_weight,'<?=lang('vehicle_type_min_weight')?>','<?=lang('not_empty')?>');
    var data7=cekValidasi(vehicle_type,'<?=lang('vehicle_type')?>','<?=lang('not_empty')?>');
    
    validasi=data1+data2+data3+data4+data5+data6+data7;  
     
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('vehicle_category/create')?>",
                    type: "POST",
                    data: $('#form').serializeArray(),
                    dataType: "JSON",
                    success: function(result)
                    {  
                        if (result.success){ 
                            $('#modal_form').modal('hide');
                            //swal("Save!", "Data has been Saved.", "success");
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            location.replace("<?php echo base_url('vehicle_category')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / update data", "error");
                    }
                    
                });  
            }
        });
    } 
}

function edit_vehicle_type(id)
{
  $('#form')[0].reset();
      $.ajax({
        url : "<?php echo base_url('vehicle_category/get_data_edit/')?>/" + id,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {
            $('[name="rowID"]').val(data.rowID);
            $('[name="vehicle_type_code"]').val(data.type_cd);
            $('[name="vehicle_type_name"]').val(data.type_name);
            $('[name="vehicle_type"]').val(data.vehicle_type);
            $('[name="vehicle_type_weight"]').val(tandaPemisahTitik(data.weight));
            $('[name="vehicle_type_max_weight"]').val(tandaPemisahTitik(data.max_weight));
            $('[name="vehicle_type_min_weight"]').val(tandaPemisahTitik(data.min_weight));
            
            $('[name="vehicle_type_code"]').prop('readonly',true);
            $('#modal_form').modal('show');
            $('.modal-title').text('Edit'); 
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error adding / update data", "error");
        }
    });
}

function delete_vehicle_type(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('vehicle_category/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               
               swal("Deleted!", "Data has been deleted.", "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('vehicle_category')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}

// -end vehicle type 

// -destination -
function add_destination(){
  //$('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text('<?=lang('add_destination')?>'); 
  
  $('[name="rowID"]').val('');
  $('[name="destination_code"]').prop('readonly',false);
  
  setTimeout(function() { $('input[name="destination_code"]').focus() }, 500);
  
}

function destination_pdf(){
    window.open('<?php echo base_url('destination/pdf')?>');
} 

function destination_excel(){
    window.open('<?php echo base_url('destination/excel')?>');
}

function save_destination(){
    
    var destination_code  = $('[name="destination_code"]').val();
    var destination_name  = $('[name="destination_name"]').val();    
    var validasi="";
    
    var data1=cekValidasi(destination_code,'<?=lang('destination_code')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(destination_name,'<?=lang('destination_name')?>','<?=lang('not_empty')?>');
    var data3 = '';
    
    if(destination_code != ''){
        if(destination_code.length == 3){
            data3 = '';
        }
        else{
            data3 = '<?=lang('destination_code')?> must 3 characters.';
        }
    }
    
    validasi=data1+data2+data3;  
     
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }
    else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('destination/create')?>",
                    type: "POST",
                    data: $('#form').serializeArray(),
                    dataType: "JSON",
                    success: function(result)
                    {  
                        if (result.success){ 
                            $('#modal_form').modal('hide');
                            //swal("Save!", "Data has been Saved.", "success");
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            location.replace("<?php echo base_url('destination')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / update data", "error");
                    }
                    
                });  
            }
        });
    } 
}

function copy_to_port(id){
    $('[name="destination_rowID"]').val(id);
    $('#modal_form_copy').modal('show');
}

function save_copy_to_port(){
    
    var port_type  = $('[name="port_type"]').val();    
    var validasi="";
    
    var data1=cekValidasi(port_type,'<?=lang('port_type')?>','<?=lang('not_empty')?>');
    
    validasi=data1;  
     
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('destination/copy_to_port')?>",
                    type: "POST",
                    data: $('#form_copy').serializeArray(),
                    dataType: "JSON",
                    success: function(result)
                    {  
                        if (result.success){ 
                            $('#modal_form_copy').modal('hide');
                            //swal("Save!", "Data has been Saved.", "success");
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            location.replace("<?php echo base_url('destination')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding data", "error");
                    }
                    
                });  
            }
        });
    } 
}

function edit_destination(id)
{
  $('#form')[0].reset();
      $.ajax({
        url : "<?php echo base_url('destination/get_data_edit/')?>/" + id,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {
            $('[name="rowID"]').val(data.rowID);
            $('[name="destination_code"]').val(data.destination_no);
            $('[name="destination_name"]').val(data.destination_name);
            $('[name="coordinate_rowID"]').select2('val',data.coordinate_rowID);
            $('[name="destination_address1"]').val(data.address1);
            $('[name="destination_address2"]').val(data.address2);
            $('[name="destination_address3"]').val(data.address3);
            $('[name="destination_postal_code"]').val(data.post_cd);
            $('[name="destination_phone"]').val(data.telp_no);
            $('[name="destination_contact_person"]').val(data.contact_prs);
            
            $('[name="destination_code"]').prop('readonly',true);
            $('#modal_form').modal('show');
            $('.modal-title').text('Edit'); 
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error adding / update data", "error");
        }
    });
}

function delete_destination(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('destination/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               
               swal("Deleted!", "Data has been deleted.", "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('destination')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}
// end destination 
// port 
function add_port(){
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text('<?=lang('add_port')?>'); 
  
  $('[name="rowID"]').val('');    
    
  $('[name="port_code"]').prop('readonly',false);
}

function port_pdf(){
        window.open('<?php echo base_url('port/pdf')?>');
}

function port_excel(){
        window.open('<?php echo base_url('port/excel')?>');
}
function save_port(){
    
    var port_code  = $('[name="port_code"]').val();
    var port_name  = $('[name="port_name"]').val();    
    var port_type  = $('[name="port_type"]').val();    
    var validasi="";
    
    var data1=cekValidasi(port_code,'<?=lang('port_code')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(port_name,'<?=lang('port_name')?>','<?=lang('not_empty')?>');
    var data3=cekValidasi(port_type,'<?=lang('port_type')?>','<?=lang('not_empty')?>');
    
    validasi=data1+data2+data3;  
     
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('port/create')?>",
                    type: "POST",
                    data: $('#form').serializeArray(),
                    dataType: "JSON",
                    success: function(result)
                    {  
                        if (result.success){ 
                            $('#modal_form').modal('hide');
                            //swal("Save!", "Data has been Saved.", "success");
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            location.replace("<?php echo base_url('port')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / update data", "error");
                    }
                    
                });  
            }
        });
    } 
}


function edit_port(id)
{
  $('#form')[0].reset();
      $.ajax({
        url : "<?php echo base_url('port/get_data_edit/')?>/" + id,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {
            $('[name="rowID"]').val(data.rowID);
            $('[name="port_code"]').val(data.port_cd);
            $('[name="port_name"]').val(data.port_name);
            $('[name="port_type"]').val(data.port_type);            
            
            $('[name="port_code"]').prop('readonly',true);
            $('#modal_form').modal('show');
            $('.modal-title').text('Edit'); 
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error adding / update data", "error");
        }
    });
}


function delete_port(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('port/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               
               swal("Deleted!", "<?=lang('port_deleted_successfully') ?>.", "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('port')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}
// end port 

// advance type --
function add_advance_type(){
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text('<?=lang('add_advance_type')?>'); 
  
    $('[name="rowID"]').val('');
    
    $('[name="advance_type_code"]').prop('readonly',false);
}


function save_advance_type(){
    
    var advance_type_code  = $('[name="advance_type_code"]').val();
    var advance_type_name  = $('[name="advance_type_name"]').val();    
    var validasi="";
    
    var data1=cekValidasi(advance_type_code,'<?=lang('advance_type_code')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(advance_type_name,'<?=lang('advance_type_name')?>','<?=lang('not_empty')?>');
    
    validasi=data1+data2;  
     
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('advance_type/create')?>",
                    type: "POST",
                    data: $('#form').serializeArray(),
                    dataType: "JSON",
                    success: function(result)
                    {  
                        if (result.success){ 
                            $('#modal_form').modal('hide');
                            //swal("Save!", "Data has been Saved.", "success");
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            location.replace("<?php echo base_url('advance_type')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / update data", "error");
                    }
                    
                });  
            }
        });
    } 
}

function edit_advance_type(id)
{
  $('#form')[0].reset();
      $.ajax({
        url : "<?php echo base_url('advance_type/get_data_edit/')?>/" + id,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {
            $('[name="rowID"]').val(data.rowID);
            $('[name="advance_type_code"]').val(data.advance_cd);
            $('[name="advance_type_name"]').val(data.advance_name);

            $('[name="advance_type_code"]').prop('readonly',true);
            $('#modal_form').modal('show');
            $('.modal-title').text('Edit'); 
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error adding / update data", "error");
        }
    });
}

function delete_advance_type(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('advance_type/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               
               swal("Deleted!", "<?=lang('advance_type_deleted_successfully') ?>.", "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('advance_type')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}
// end advance type 

// cash advance type --
function add_cash_advance_type(){
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text('<?=lang('add_cash_advance_type')?>'); 
  
    $('[name="rowID"]').val('');
    
    $('[name="cash_advance_type_code"]').prop('readonly',false);
}


function save_cash_advance_type(){
    
    var advance_type_code  = $('[name="cash_advance_type_code"]').val();
    var advance_type_name  = $('[name="cash_advance_type_name"]').val();    
    var validasi="";
    
    var data1=cekValidasi(advance_type_code,'<?=lang('cash_advance_type_code')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(advance_type_name,'<?=lang('cash_advance_type_name')?>','<?=lang('not_empty')?>');
    
    validasi=data1+data2;  
     
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('cash_advance_type/create')?>",
                    type: "POST",
                    data: $('#form').serializeArray(),
                    dataType: "JSON",
                    success: function(result)
                    {  
                        if (result.success){ 
                            $('#modal_form').modal('hide');
                            //swal("Save!", "Data has been Saved.", "success");
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            location.replace("<?php echo base_url('cash_advance_type')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / update data", "error");
                    }
                    
                });  
            }
        });
    } 
}

function edit_cash_advance_type(id)
{
  $('#form')[0].reset();
      $.ajax({
        url : "<?php echo base_url('cash_advance_type/get_data_edit/')?>/" + id,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {
            $('[name="rowID"]').val(data.rowID);
            $('[name="cash_advance_type_code"]').val(data.advance_cd);
            $('[name="cash_advance_type_name"]').val(data.advance_name);
            $('[name="advance_by_jo"]').val(data.by_jo);
            $('[name="advance_only_driver"]').val(data.only_driver);
            $('[name="advance_fare_trip"]').val(data.fare_trip);
            
            $('[name="cash_advance_type_code"]').prop('readonly',true);
            $('#modal_form').modal('show');
            $('.modal-title').text('Edit'); 
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error adding / update data", "error");
        }
    });
}


function delete_cash_advance_type(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
          $.ajax({
            url : "<?php echo base_url('cash_advance_type/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               swal("Deleted!", "<?=lang('cash_advance_type_deleted_successfully') ?>.", "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('cash_advance_type')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}
// end cash advance type 

// creditor type -
function add_creditor_type(){
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text('<?=lang('add_creditor_type')?>'); 
}

function creditor_type_pdf(){
    window.open('<?php echo base_url('creditor_type/pdf')?>');
}

function save_creditor_type(){
    
    var creditor_type_cd  = $('[name="creditor_type_cd"]').val();
    var creditor_type_name  = $('[name="creditor_type_name"]').val();    
    var validasi="";
    
    var data1=cekValidasi(creditor_type_cd,'<?=lang('creditor_type_cd')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(creditor_type_name,'<?=lang('creditor_type_name')?>','<?=lang('not_empty')?>');
    
    validasi=data1+data2;  
     
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('creditor_type/create')?>",
                    type: "POST",
                    data: $('#form').serializeArray(),
                    dataType: "JSON",
                    success: function(result)
                    {  
                        if (result.success){ 
                            $('#modal_form').modal('hide');
                            //swal("Save!", "Data has been Saved.", "success");
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            location.replace("<?php echo base_url('creditor_type')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / update data", "error");
                    }
                    
                });  
            }
        });
    } 
}

function edit_creditor_type(id)
{
  $('#form')[0].reset();
      $.ajax({
        url : "<?php echo base_url('creditor_type/get_data_edit/')?>/" + id,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {
            $('[name="rowID"]').val(data.rowID);
            $('[name="creditor_type_cd"]').val(data.type_cd);
            $('[name="creditor_type_name"]').val(data.descs);
            $('[name="creditortype_advance_acc"]').val(data.advance_coa_rowID);
            $('[name="creditortype_deposit_acc"]').val(data.deposit_coa_rowID);
            $('[name="creditortype_rounding_acc"]').val(data.rounding_coa_rowID);
            $('[name="creditortype_adm_acc"]').val(data.adm_coa_rowID);
            $('[name="creditortype_pay_acc"]').val(data.payable_coa_rowID);
            
            $('[name="creditor_type_cd"]').prop('readonly',true);
            $('#modal_form').modal('show');
            $('.modal-title').text('Edit'); 
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error adding / update data", "error");
        }
    });
}


function delete_creditor_type(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('creditor_type/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               
               swal("Deleted!", "<?=lang('creditortype_deleted_successfully') ?>.", "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('creditor_type')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}
// end creditor type -
// creditor 

function add_creditor(){
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text('<?=lang('creditor_add')?>'); 
  $('#C1').hide();
  $('#C2').hide();  
}

function creditor_pdf(){
    window.open('<?php echo base_url('creditor/pdf')?>');
} 

function creditor_excel(){
    window.open('<?php echo base_url('creditor/excel')?>');
}

function save_creditor(){
    
    //var creditor_name     = $('#creditor_name').val();//$('[name="debtor_code"]').val();
    //var debtor_category = $('#debtor_category').val();//$('[name="debtor_category"]').val();
    var creditor_name     = $('[name="creditor_name"]').val();        
    var validasi="";
    
    var data1=cekValidasi(creditor_name,'<?=lang('creditor_name')?>','<?=lang('not_empty')?>');
    //var data2=cekValidasi(debtor_category,'<?=lang('debtortype_category')?>','<?=lang('not_empty')?>');
    //var data3=cekValidasi(debtor_name,'<?=lang('debtor_name')?>','<?=lang('not_empty')?>');
    
    validasi=data1; //+data2+data3;  
     
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('creditor/create')?>",
                    type: "POST",
                    data: $('#form').serializeArray(),
                    dataType: "JSON",
                    success: function(result)
                    {                 	            

                        if (result.success){ 
                            $('#modal_form').modal('hide');
                            //swal("Save!", "Data has been Saved.", "success");
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            location.replace("<?php echo base_url('creditor')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / update data", "error");
                    }
                    
                });  
            }
        });
    } 
}

function edit_creditor(id)
{
  $('#form')[0].reset();
      $.ajax({
        url : "<?php echo base_url('creditor/get_data_edit/')?>/" + id,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {
            var toDdMmYy = function(input) {
                var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
                if(!input || !input.match(ptrn)) {
                    return null;
                }
                return input.replace(ptrn, '$3-$2-$1');
            };
            
            if(data.category == 'I'){
                $('#C1').show();
                $('#C2').show();
            }
            else{
                $('#C1').hide();
                $('#C2').hide();                
            }
        
            $('[name="rowID"]').val(data.rowID);
            $('[name="creditor_type"]').val(data.creditor_type_rowID);
            $('[name="creditor_category"]').val(data.category);
            $('[name="supplier_type"]').val(data.supplier_type);
            $('[name="creditor_id_type"]').val(data.id_type);
            $('[name="creditor_id_number"]').val(data.id_no);
            $('[name="creditor_name"]').val(data.creditor_name);
            $('[name="creditor_address1"]').val(data.address1);
            $('[name="creditor_address2"]').val(data.address2);
            $('[name="creditor_address3"]').val(data.address3);
            $('[name="creditor_postal_code"]').val(data.post_cd);
            $('[name="creditor_phone1"]').val(data.telp_no1);
            $('[name="creditor_phone2"]').val(data.telp_no2);
            $('[name="creditor_fax1"]').val(data.fax_no1);
            $('[name="creditor_fax2"]').val(data.fax_no2);
            $('[name="creditor_contact"]').val(data.contact_prs);
            $('[name="creditor_website"]').val(data.website);
            $('[name="creditor_email"]').val(data.email);
            $('[name="creditor_hp1"]').val(data.hp_no1);
            $('[name="creditor_hp2"]').val(data.hp_no2);
            $('[name="creditor_gender"]').val(data.sex);
            $('[name="creditor_pob"]').val(data.pob);
            $('[name="creditor_dob"]').val(toDdMmYy(data.dob));
            $('[name="creditor_bank_account_no1"]').val(data.bank_acc1);
            $('[name="creditor_bank_account_name1"]').val(data.bank_acc_name1);
            $('[name="creditor_bank_account_no2"]').val(data.bank_acc2);
            $('[name="creditor_bank_account_name2"]').val(data.bank_acc_name2);
            $('[name="creditor_npwp"]').val(data.npwp_no);
            $('[name="creditor_npwp_registered"]').val(toDdMmYy(data.reg_date));
            $('[name="creditor_name_npwp"]').val(data.npwp_name);
            $('[name="creditor_npwp_address1"]').val(data.npwp_address1);
            $('[name="creditor_npwp_address2"]').val(data.npwp_address2);
            $('[name="creditor_npwp_address3"]').val(data.npwp_address3);
            
            $('#modal_form').modal('show');
            $('.modal-title').text('Edit'); 
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error adding / update data", "error");
        }
    });
}

function delete_creditor(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('creditor/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               
               swal("Deleted!", "<?=lang('creditor_deleted_successfully') ?>.", "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('creditor')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}
$(document).ready(function($) {
    $("#creditor_category").change(function (){
        var category= $('#creditor_category').val();
        
        if (category == 'C'){
            document.getElementById("C1").style.display = "none";
            document.getElementById("C2").style.display = "none";
        }else{
            document.getElementById("C1").style.display = "block";
            document.getElementById("C2").style.display = "block";
        }				
    });  
    
    $("#debtor_category").change(function (){
        var category= $('#debtor_category').val();
        
        if (category == 'C'){
            document.getElementById("D1").style.display = "none";
            document.getElementById("D2").style.display = "none";
        }else{
            document.getElementById("D1").style.display = "block";
            document.getElementById("D2").style.display = "block";
        }				
    });
    
    
   	$('#coa_level').change(function(){
		var coa_level = parseInt($('#coa_level').val())-1;
        //var coa_level = $('#coa_level').val();
        var coa_class = $('[name="coa_class"]').val();
        var coa_type  = $('[name="coa_type"]').val();
 		$.ajax({
            type: "POST",
            url : "<?php echo base_url('coa/get_coa_sub'); ?>",
			data: "coa_level="+coa_level+'&coa_class='+coa_class+'&coa_type='+coa_type+
                    '&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
            cache:false,
			dataType: 'json',
            success: function(msg){	
                obj = msg;
                console.log(obj);
                if (obj.length > 0) {
			             $.each(obj, function (index, msg) {                
							valor = msg.rowID;
							texto = msg.acc_cd+'-'+msg.acc_name;
                            
							$('#coa_subof_account').append('<option value=' + valor + '>' + texto + '</option>');
							$('#coa_subof_account').prop("readonly", false); 
                            
						}); 
                        $('#coa_subof_account').select2();
                        $('#coa_subof_account').val(0).trigger("change");
                    
                }else{
			         $('#coa_subof_account').empty();
			         $('#coa_subof_account').append('<option value="0">Select</option>');
			         $('#coa_subof_account').val(0).trigger("change");
                     $('#coa_subof_account').prop("readonly", true); 
  
                }
                
                    
            },
			error: function(xhr, status, error) {
				document.write(xhr.responseText);
				//alert(xhr.responseText);
			}
        }); 
	});
      


});

// end creditor --
// coa
function add_coa(){
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text('<?=lang('add_coa')?>'); 
  $('[name="rowID"]').val('');
  $('[name="coa_code"]').prop('readOnly',false);
}

function coa_pdf(){
    window.open('<?php echo base_url('coa/pdf')?>');
} 

function coa_excel(){
    window.open('<?php echo base_url('coa/excel')?>');
}

function save_coa(){
    var rowID      = $('[name="rowID"]').val();
    var coa_code      = $('[name="coa_code"]').val(); 
    var coa_name      = $('[name="coa_name"]').val();     
    var coa_type      = $('#coa_type option:selected').val();
    var acc_debit_credit      = $('#acc_debit_credit option:selected').val();
    var coa_class     = $('#coa_class option:selected').val();
    var coa_level     = $('#coa_level option:selected').val(); 
    var coa_subof_account     = $('#coa_subof_account option:selected').val();
    var coa_c         = $('#coa_c option:selected').val();
    var coa_b         = $('#coa_b option:selected').val();
    var coa_vatin     = $('#coa_vatin option:selected').val();
    var coa_vatout     = $('#coa_vatout option:selected').val();
    var coa_active     = $('#coa_active option:selected').val();
    var cash_branch     = $('#cash_branch').val();
    
    var validasi="";
    
    var data1=cekValidasi(coa_type,'<?=lang('coa_type')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(coa_code,'<?=lang('coa_cd')?>','<?=lang('not_empty')?>');
    var data3=cekValidasi(coa_name,'<?=lang('coa_name')?>','<?=lang('not_empty')?>');
    var data4=cekValidasi(coa_class,'<?=lang('coa_class')?>','<?=lang('not_empty')?>');
    var data5=cekValidasi(coa_level,'<?=lang('coa_level')?>','<?=lang('not_empty')?>');
    var data6=cekValidasi(coa_subof_account,'<?=lang('coa_sub_of_account')?>','<?=lang('not_empty')?>');
    var data7=cekValidasi(acc_debit_credit,'Debit/Credit Type','<?=lang('not_empty')?>');
    
    if (coa_level == '1'){
       validasi=data1+data2+data3+data4+data5+data7;
    }else{
       validasi=data1+data2+data3+data4+data5+data6+data7;  
    }
    
    
     
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                 var  dataPost = "rowID="+rowID+"&coa_type="+coa_type+"&coa_code="+coa_code+
                    "&coa_name="+coa_name+"&acc_debit_credit="+acc_debit_credit+
                    "&coa_class="+coa_class+"&coa_level="+coa_level+
                    "&coa_subof_account="+coa_subof_account+"&coa_c="+coa_c+
                    "&coa_b="+coa_b+"&coa_vatin="+coa_vatin+
                    "&coa_vatout="+coa_vatout+"&coa_active="+coa_active+"&cash_branch="+cash_branch+
                    '&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>';
                    
                  $.ajax({
                    url : "<?php echo base_url('coa/create')?>",
                    type: "POST",
                    data: dataPost,//$('#form').serialize(),
                    dataType: "JSON",
                    success: function(result)
                    {                 	            

                        if (result.success){ 
                            $('#modal_form').modal('hide');
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            location.replace("<?php echo base_url('coa')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / update data", "error");
                    }
                    
                });  
            }
        });
    } 
}

function edit_coa(id)
{
  $('#form')[0].reset();
      $.ajax({
        url : "<?php echo base_url('coa/get_data_edit/')?>/" + id,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {
            //alert(data.acc_level);
            $('[name="rowID"]').val(data.rowID);
            $('[name="coa_code"]').val(data.acc_cd);
            $('[name="coa_name"]').val(data.acc_name);
            $('[name="coa_type"]').val(data.acc_type);
            $('[name="acc_debit_credit"]').val(data.acc_debit_credit);
            $('[name="coa_class"]').val(data.acc_class);
            $('[name="coa_level"]').val(data.acc_level);
            $('[name="coa_subof_account"]').val(data.acc_sub_of_rowID);
            $('#coa_subof_account').append("<option value="+data.acc_sub_of_rowID+">"+data.sub_acc+"</option>");
            $('[name="coa_c"]').val(data.is_cash);
            $('[name="coa_b"]').val(data.is_bank);
            $('[name="coa_vatin"]').val(data.is_vat_in);
            $('[name="coa_vatout"]').val(data.is_vat_out);
            $('[name="coa_active"]').val(data.active);
            $('[name="cash_branch"]').val(data.cash_branch);
          
            $('[name="coa_code"]').prop('readOnly',true);
            
            if (data.acc_type == "H"){
		      $('#coa_c').prop("disabled", true);
              $('#coa_b').prop("disabled", true);
              $('#coa_vatin').prop("disabled", true);
              $('#coa_vatout').prop("disabled", true);
              $('#coa_active').prop("disabled", true);
			}
                
            $('#modal_form').modal('show');
            $('.modal-title').text('Edit'); 
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error adding / update data", "error");
        }
    });
}

function delete_coa(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('coa/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               
               swal("Deleted!", "<?=lang('coa_delete_successfully') ?>.", "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('coa')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}
// end coa -
// fare trip -----
function add_fare_trip(){
  bersih();
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text('<?=lang('add_fare_trip')?>'); 
  
  $('[name="rowID"]').val('');
  $('[name="fare_trip_destination_from"]').select2('val','');
  $('[name="fare_trip_destination_to"]').select2('val','');
  $('[name="vehicle_type"]').select2('val','');
  $('[name="cost_code"]').select2('val','');
  $('.reference_cost').select2('val','');

  $('#fare_trip_destination_from').attr('disabled',false);
  $('#fare_trip_destination_to').attr('disabled',false);
  $('#trip_type').attr('disabled',false);
  $('#trip_condition').attr('disabled',false);
  $('#vehicle_type').attr('disabled',false);
  $('#cost_code').attr('disabled',false);

}

function ambil_data(){
  $('#myModal').modal('show'); 
  $('.modal-title').text('<?=lang('add_fare_trip')?>'); 
}

$(document).ready(function() {
    $('#tbl-projects-kir').DataTable();
    $('.tbl-data').DataTable({"aaSorting": [[0, 'asc']],
        "bProcessing": true,
        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "sPaginationType": "full_numbers",
	});
    $('#tbl-data').dataTable({"aaSorting": [[0, 'desc']],
		"bProcessing": true,
        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
      "sPaginationType": "full_numbers",
	});	
    $('#tbl-data-faretrip').DataTable({"aaSorting": [[0, 'asc']],
        "bProcessing": true,
        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "sPaginationType": "full_numbers",
	});
    $('.tbl-data_verification').DataTable({"aaSorting": [[0, 'asc']],
        "bProcessing": true,
        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "sPaginationType": "full_numbers",
	});
    $('#tbl-data_invoice').DataTable({"aaSorting": [[1, 'desc']],
        "bProcessing": true,
        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "sPaginationType": "full_numbers",
	});
    $('#tbl-driver').dataTable({
		"bProcessing": true,
        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "sPaginationType": "full_numbers",
	});	
    $('#tbl-employee-driver').dataTable({
		"bProcessing": true,
        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "sPaginationType": "full_numbers",
	});	
    $('#tbl-ca-pok').dataTable({
		"bProcessing": true,
        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "sPaginationType": "full_numbers",
	});	
    
    var table = $('#tbl-projects2').DataTable();
   // var tabel = $('#tbl-projects2').dataTable({"aaSorting": [[1, 'desc']],
//		"bProcessing": true,
//        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
//        "sPaginationType": "full_numbers",
//	});
     
    $('#tbl-projects2 tbody').on('click', 'tr', function () {
        var data = table.row( this ).data();
        alert( 'You clicked on '+data[0]+'\'s row' );
        //$('#fare_trip_distance').val(data[0])
        //$('#myModal').modal('hide');
    } );
    

    
});

    function fare_trip_pdf(){
        window.open('<?php echo base_url('fare_trip/pdf')?>');
    }
    
    function fare_trip_excel(){
        window.open('<?php echo base_url('fare_trip/excel')?>');
    }

    var totalrow=0;
    
    function addRow(){
         totalrow++;
            var detailrow="";
            detailrow=detailrow+"<tr id='row"+totalrow+"'>";

            detailrow=detailrow+"<td>";
            var tombolhapus="<input type='button' style='height:30px;width:30px;border:0px;background-image:url(\"<?= base_url();?>resource/images/delete.png\");background-repeat:no-repeat;' id='hapdet"+totalrow+"'   title='Hapus Baris' value='&nbsp;' onclick='hapusBaris(\"row"+totalrow+"\")' />";
            detailrow=detailrow+tombolhapus;
            detailrow=detailrow+"</td>";
                
            var reference="<select  class='yellowtext reference_cost'  id='reference_rowID"+totalrow+"' name='detail["+totalrow+"][reference_rowID]'   type='text'  style='height:30px;width:90%;background-color:white;border:solid 1px #ccc;' /></select>";
    		detailrow=detailrow+"<td>"+reference+"</td>";
            
            detailrow=detailrow+"<td >";
            var text1="<input class='form-control' onkeyup='sumDetail(\""+totalrow+"\");'   id='fare_trip_amt"+totalrow+"' name='detail["+totalrow+"][fare_trip_amt]'  type='text' onKeyPress='return isNumberKey(event)' onclick=\"if(this.value!='0'&&this.value!=''){this.value=number_format(this.value,0,'','','deformat');}else{if(this.value==''){this.value='';}}\" onblur=\"if(this.value!='0'&&this.value!=''&&this.value.indexOf('.') ==-1){this.value=number_format(this.value,0,',','.','format');}else{if(this.value.indexOf('.')>0){}else{}}\" style='text-align:right;height:30px;background-color:white;border:solid 1px #ccc;'  value=''  /><input class='form-control'   id='fare_trip_hdr_rowID"+totalrow+"' name='detail["+totalrow+"][fare_trip_hdr_rowID]' readonly='readonly' type='hidden'   value=''  />";
            detailrow=detailrow+text1;
            detailrow=detailrow+"</td>";
                        
            detailrow=detailrow+"</tr>";
            
            $('#detail tr:last').after(detailrow);
           
            $("#reference_rowID"+totalrow).select2();	
            document.getElementById("reference_rowID"+totalrow).innerHTML=document.getElementById("reference").innerHTML;
    }
    
function hapusBaris(x){
    if(document.getElementById(x)!=null){
        $('#'+x).remove(); 
        sumDetail(x);
     }
}
    
function bersih(){
    var y=totalrow+1;
        for(x=0;x<y;x++){
            if(document.getElementById("row"+x)){
			     hapusBaris("row"+x);
           }
       }
     totalrow=0;
}

function sumDetail(x){
    var looprows=totalrow+1;
    var totNil=0;

     for(z=1;z<looprows; z++){  
        if(document.getElementById('fare_trip_amt'+z)!=null  ){
            if(document.getElementById('fare_trip_amt'+z).value!="" ){
                var nilai=number_format(document.getElementById('fare_trip_amt'+z).value,0,',','.','deformat');
                totNil +=parseInt(nilai);

            }
        }
    }
    document.getElementById('Total').value=number_format(totNil,0,',','.','format');

} 



$(document).ready(function($) {
    	
   $('#fare_trip_destination_from').change(function(){
		var from = $('#fare_trip_destination_from').val();

 		$.ajax({
            type: "POST",
            url : "<?php echo base_url('fare_trip/get_destination'); ?>",
			data: "destination="+from+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
            cache:false,
			dataType: 'json',
            success: function(data){	
                $('[name="destination_from_code"]').val(data.destination_no);
            },
			error: function(xhr, status, error) {
				document.write(xhr.responseText);
				alert(xhr.responseText);
			}
        }); 
	}); 
    
    $('#fare_trip_destination_to').change(function(){
		var from = $('#fare_trip_destination_to').val();

 		$.ajax({
            type: "POST",
            url : "<?php echo base_url('fare_trip/get_destination'); ?>",
			data: "destination="+from+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
            cache:false,
			dataType: 'json',
            success: function(data){	
                $('[name="destination_to_code"]').val(data.destination_no);
            },
			error: function(xhr, status, error) {
				document.write(xhr.responseText);
				alert(xhr.responseText);
			}
        }); 
	});  
    

    
});

function showDetail(id){

    $.ajax({
        url : "<?php echo base_url('fare_trip/showDetail')?>/"+id,
	    type: "GET",
		dataType:"JSON",
		success: function(result){
    		var x=0;
            var total   = 0;
    		$.each(result, function(key, val) {	
        		x++;
        		addRow();
                
                $('#fare_trip_hdr_rowID'+x).val(val.fare_trip_hdr_rowID)
                $('#reference_rowID'+x).select2('val',val.reference_id);
                $('#fare_trip_amt'+x).val(number_format(val.fare_trip_amt,0,',','.','format'));
                var nilai=number_format(document.getElementById('fare_trip_amt'+x).value,0,',','.','deformat');
                total +=parseInt(nilai);
    	
            });
            $('#Total').val(number_format(total,0,',','.','format'));
        }
        
   });

}

function copy_fare_trip(id){
    bersih();
    $('#form')[0].reset();
    $.ajax({
        url : "<?php echo base_url('fare_trip/get_data_edit/')?>/" + id,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {
            var toMmDdYy = function(input) {
                var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
                if(!input || !input.match(ptrn)) {
                    return null;
                }
                return input.replace(ptrn, '$3-$2-$1');
            };

            $('[name="rowID"]').val('');
            $('[name="fare_trip_destination_from"]').select2('val',data.destination_from_rowID);
            $('[name="fare_trip_destination_to"]').select2('val',data.destination_to_rowID);
            $('[name="destination_from_code"]').val(data.destination_from_code);
            $('[name="destination_to_code"]').val(data.destination_to_code);
            $('[name="fare_trip_distance"]').val(tandaPemisahTitik(data.distance));
            $('[name="fare_trip_no"]').val(data.fare_trip_no);
            $('[name="trip_condition"]').val(data.trip_condition);
            $('[name="poin"]').val(data.poin);
            if(data.split == 1){
                $('#split').attr('checked',true);
            }
            else{
                $('#split').attr('checked',false);                
            }
            $('[name="trip_type"]').val(data.trip_type);
            $('[name="komisi_supir"]').val(tandaPemisahTitik(data.komisi_supir));
            $('[name="komisi_kernet"]').val(tandaPemisahTitik(data.komisi_kernet));
            $('[name="deposit"]').val(tandaPemisahTitik(data.deposit));
            $('[name="min_amount"]').val(tandaPemisahTitik(data.min_amount));
            $('[name="os_amount"]').val(tandaPemisahTitik(data.os_amount));
            $('[name="note"]').val(data.note);
            $('[name="vehicle_type"]').select2('val',data.vehicle_id);
            $('[name="cost_code"]').select2('val',data.cost_id);
            $('[name="estimated_time_receipt"]').val(tandaPemisahTitik(data.estimated_time_receipt));
            $('[name="effective_date"]').val(toMmDdYy(data.effective_date));
            
            $('#fare_trip_destination_from').attr('disabled',false);
            $('#fare_trip_destination_to').attr('disabled',false);
            $('#trip_type').attr('disabled',false);
            $('#trip_condition').attr('disabled',false);
            $('#vehicle_type').attr('disabled',false);
            $('#cost_code').attr('disabled',false);

            $('#modal_form').modal('show');
            $('.modal-title').text('<?=lang('add_fare_trip')?>'); 
            showDetail(id);
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error getting data", "error");
        }
    });
}

function edit_fare_trip(id)
{
    bersih();
    //$('#form')[0].reset();
    $.ajax({
        url : "<?php echo base_url('fare_trip/get_data_edit/')?>/" + id,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {
            var toMmDdYy = function(input) {
                var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
                if(!input || !input.match(ptrn)) {
                    return null;
                }
                return input.replace(ptrn, '$3-$2-$1');
            };

            $('[name="rowID"]').val(id);
            $('[name="fare_trip_destination_from"]').select2('val',data.destination_from_rowID);
            $('[name="fare_trip_destination_to"]').select2('val',data.destination_to_rowID);
            $('[name="destination_from_code"]').val(data.destination_from_code);
            $('[name="destination_to_code"]').val(data.destination_to_code);
            $('[name="fare_trip_distance"]').val(tandaPemisahTitik(data.distance));
            $('[name="fare_trip_no"]').val(data.fare_trip_no);
            $('[name="trip_condition"]').val(data.trip_condition);
            $('[name="poin"]').val(data.poin);
            if(data.split == 1){
                $('#split').attr('checked',true);
            }
            else{
                $('#split').attr('checked',false);                
            }
            $('[name="trip_type"]').val(data.trip_type);
            $('[name="komisi_supir"]').val(tandaPemisahTitik(data.komisi_supir));
            $('[name="komisi_kernet"]').val(tandaPemisahTitik(data.komisi_kernet));
            $('[name="deposit"]').val(tandaPemisahTitik(data.deposit));
            $('[name="min_amount"]').val(tandaPemisahTitik(data.min_amount));
            $('[name="os_amount"]').val(tandaPemisahTitik(data.os_amount));
            $('[name="note"]').val(data.note);
            $('[name="vehicle_type"]').select2('val',data.vehicle_id);
            $('[name="cost_code"]').select2('val',data.cost_id);
            $('[name="estimated_time_receipt"]').val(tandaPemisahTitik(data.estimated_time_receipt));
            $('[name="effective_date"]').val(toMmDdYy(data.effective_date));
            
            $('#fare_trip_destination_from').attr('disabled',true);
            $('#fare_trip_destination_to').attr('disabled',true);
            $('#trip_type').attr('disabled',true);
            $('#trip_condition').attr('disabled',true);
            $('#vehicle_type').attr('disabled',true);
            $('#cost_code').attr('disabled',true);            
            
            $('#modal_form').modal('show');
            $('.modal-title').text('Edit'); 
            showDetail(id);
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error getting data", "error");
        }
    });
}

function save_fare_trip(){
    var fare_trip_destination_from = $('#fare_trip_destination_from option:selected').val();
    var fare_trip_destination_to = $('#fare_trip_destination_to option:selected').val();
    var vehicle_type = $('#vehicle_type option:selected').val();
    var cost_code = $('#cost_code option:selected').val();
    var poin = $('#poin').val();
    //var fare_trip_distance         = $('[name="fare_trip_distance"]').val();  
    
    var validasi="";
    
    var data1=cekValidasi(fare_trip_destination_from,'<?=lang('fare_trip_destination_from')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(fare_trip_destination_to,'<?=lang('fare_trip_destination_to')?>','<?=lang('not_empty')?>');
    var data3=cekValidasi(vehicle_type,'<?=lang('vehicle')?>','<?=lang('not_empty')?>');
    var data4=cekValidasi(cost_code,'<?=lang('cost')?>','<?=lang('not_empty')?>');
    var data5=cekValidasi(poin,'<?=lang('points')?>','<?=lang('not_empty')?>');
    //var data3=cekValidasi(fare_trip_distance,'<?=lang('fare_trip_distance')?>','<?=lang('not_empty')?>');
    /*
    var detail_cost = '';
    if($('#Total').val() == 0){
        detail_cost = cekValidasi('','Detail <?=lang('cost')?>','<?=lang('not_empty')?>');
    }
    
    var y=totalrow;
    if(totalrow == 0){
        detail_cost = cekValidasi('','Detail <?=lang('cost')?>','<?=lang('not_empty')?>');
    }
    else{
        for(x=1;x<=y;x++){
            if(document.getElementById("reference_rowID"+x) != null){
                if($('#reference_rowID'+x).val() == ''){
                    detail_cost = cekValidasi('','Detail <?=lang('cost')?>','<?=lang('not_empty')?>');
                    break;
                }
            }
        }
    }
     */
    
    var data6 = "";
    if($('#split').is(':checked',true)) {
        var total_tmp = parseFloat(number_format(document.getElementById('min_amount').value,0,',','.','deformat')) + parseFloat(number_format(document.getElementById('os_amount').value,0,',','.','deformat')); 
        var total = parseFloat(number_format(document.getElementById('Total').value,0,',','.','deformat'));
        if(parseFloat(total) != parseFloat(total_tmp)){
            data6 = "Total is not equal with sum Min and OS Amount";
        }
    }
    
    validasi=data1+data2+data3+data4+data5+data6;//+detail_cost;//+data3;  
     
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('fare_trip/create')?>",
                    type: "POST",
                    data: $('#form').serializeArray(),
                    dataType: "JSON",
                    success: function(result)
                    {                 	            

                        if (result.success){ 
                            $('#modal_form').modal('hide');
                            //swal("Save!", "Data has been Saved.", "success");
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            location.replace("<?php echo base_url('fare_trip')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / update data", "error");
                    }
                    
                });  
            }
        });
    } 
}

function delete_fare_trip(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('fare_trip/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               
               swal("Deleted!", "Data has been deleted.", "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('fare_trip')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}

function activate_fare_trip(id)
{
    swal({
      title: "Are you sure activate?",
      text: "activate this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#286090",
      confirmButtonText: "Yes, activate it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('fare_trip/activate_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               
                swal("Active!", "Data has been active.", "success");
               location.replace("<?php echo base_url('fare_trip')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error activate data", "error");
            }
        });
    });

}

function disactivate_fare_trip(id)
{
    swal({
      title: "Are you sure disactivate?",
      text: "disactivate this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, disactivate it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('fare_trip/disactivate_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               
               swal("Not Active!", "Data has been not active.", "success");
               location.replace("<?php echo base_url('fare_trip')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error disactivate data", "error");
            }
        });
    });

}

//  end fare trip -----

// --------Realization Cash Advance --

function edit_realization(prefix,year,month,code){
    bersihDO();
    bersihCost();
    //addRow_Cost(false);
    $.ajax({
        url:'<?php echo base_url(); ?>finances/get_data_realization?prefix='+prefix+'&year='+year+'&month='+month+'&code='+code,
        data: '<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        type: "POST",
        dataType: 'json',
        success: function(data)
        {
              $('#prefix').val(data.prefix);
              $('#year').val(data.year);  
              $('#month').val(data.month);  
              $('#code').val(data.code);
              
              var remark = '-';
              if(data.fare_trip_no == null || data.destination_from_name == null || data.destination_to_name == null){
                remark = '-';                
              }
              else{
                remark = data.fare_trip_no +' ('+data.destination_from_name+' ke '+data.destination_to_name+')';
              }              
              
              var v_type_name = '';
              if(data.type_name == null){
                v_type_name = '';
              }
              else{
                v_type_name = ' [' + data.type_name + ']';
              }
              
              var v_police_no = '';
              if(data.police_no == null){
                v_police_no = '-';
              }
              else{
                v_police_no = data.police_no;
              }
              
              $('#cash_advance_no').val(data.advance_no);
              $('#cash_advance_date').val(data.advance_date);
              $('#cash_advance_type_id').val(data.advance_type_rowID);
              $('#cash_advance_type').val(data.advance_name);
              $('#remark').val(remark);
              $('#fare_trip_code').val(data.fare_trip_code);
              $('#fare_trip_id').val(data.fare_trip_rowID);
              $('#vehicle_type_id').val(data.vehicle_type_rowID);
              $('#advance_amount').val(data.advance_amount);
              $('#cash_advance_amt').val(number_format(parseInt(data.advance_amount) + parseInt(data.advance_extra_amount),0,',','.','format'));
              $('#cash_advance_alloc_').val(number_format(data.advance_allocation,0,',','.','format'));
              $('#cash_advance_alloc').val(number_format(data.advance_allocation,0,',','.','format'));
              $('#cash_advance_balance').val(number_format(parseInt(data.advance_amount) + parseInt(data.advance_extra_amount) - parseInt(data.advance_allocation),0,',','.','format'));
              $('#driver').val(data.employee_driver_rowID);
              $('#driver_name').val(data.debtor_name+'-'+data.employee+'-'+data.id_no);
              $('#vehicle_no_type').val(v_police_no+v_type_name);
              $('#vehicle_type').val(data.vehicle_type_rowID);
              $('#on_process').val(data.on_process);
              
              if(data.advance_type_rowID == 1){
                addRow_DeliveryOrder();
                
                $('#delivery_order').show();
                $('#delivery_order').prop('class','tab-pane active');    
                $('#choose_delivery').show();

                $('#cost').hide();
                $('#cost').prop('class','tab-pane'); 
                $('#choose_cost').prop('class',''); 
                            
              }
              else{
                $('#delivery_order').hide();
                $('#delivery_order').prop('class','tab-pane');                                
                $('#choose_delivery').hide();

                $('#cost').show();
                $('#cost').prop('class','tab-pane active');                
                $('#choose_cost').prop('class','active');
              }
              
              show_modal_jo(data.from_id,data.to_id,data.trip_type);
              
              $('#modal_realization').modal('show'); 
              //coba();
              $('.modal-title-realization').text('<?=lang('new')?>  <?=lang('realization')?>');  
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error getting data", "error");
        }
    });

}

function second_payment(advance_no)
{
    swal({
      title: "Are you sure ?",
      text: "Create Second Payment!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, second payment it!",
      closeOnConfirm: false
    },
    function(){
      
        $.ajax({
            url : "<?php echo base_url('finances/second_payment')?>/" + advance_no,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                if (data.success){ 
                    sweetAlert('<?=lang('information')?>',''+data.msg);   
                    location.replace("<?php echo base_url('finances/'.$this->session->userdata('page_detail'))?>");
                }else{
                    sweetAlert('<?=lang('information')?>',''+data.msg); 
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error saving data", "error");
            }
        });
    });

}

function show_modal_jo(from_id,to_id,type){
    $.ajax({
        type: "POST",
        url : "<?php echo base_url(); ?>finances/get_data_jo_by_type",
    	data: 'from_id='+from_id+'&to_id='+to_id+'&type='+type+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        dataType:"JSON",
        cache:false,
        success: function(result){
            var isi_table = '';
                            
            var no = 1;
            var toDdMmYy = function(input) {
                var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
                if(!input || !input.match(ptrn)) {
                    return null;
                }
                return input.replace(ptrn, '$3-$2-$1');
            };
            
            if(result == null){
                $('#tbl-joborder').html('');
                
                isi_table += '<thead>' +
                                  '<tr>' +
                                    '<th><?=lang('job_order_no')?></th>' +
            						'<th><?=lang('job_order_debtor')?></th>' +
                                    '<th><?=lang('job_order_po_spk_no')?></th>' +
                                    '<th><?=lang('job_order_so_no')?></th>' +
                                    '<th>From - To</th>' +
                                    '<th>JO Type</th>' +
                                    '<th>Price Type</th>' +
                                    '<th>Item</th>' +
                                    '<th><?=lang('port')?></th>' +
                                    '<th><?=lang('vessel_name')?> </th>' +
            						'<th><?=lang('job_order_date')?></th>' +
                                    '<th><?=lang('vessel_no')?> </th>' +
                                    '<th>Year</th>' +
                                    '<th>month</th>' +
                                    '<th>code</th>' +
                                    '<th>fare trip id</th>' +
                                    '<th>from id</th>' +
                                    '<th>to id</th>' +
                                    '<th>Jo Type</th>' +
                                    '<th>Price Amount</th>' +
                                    '<th>Price Type</th>' +
                                    '<th>Price 20 Feet</th>' +
                                    '<th>Price 40 Feet</th>' +
                                    '<th>Price 45 Feet</th>' +
                                  '</tr> ' +
            				  '</thead>';
                              
                $('#tbl-joborder').append(isi_table);   
               
                $('#tbl-joborder').DataTable().destroy();
                $('#tbl-joborder').DataTable({
                    "bProcessing": true,
                    "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
                    "sPaginationType": "full_numbers",
            	});
            }
            else{
                $('#tbl-joborder').html('');
                
                isi_table += '<thead>' +
                                  '<tr>' +
                                    '<th><?=lang('job_order_no')?></th>' +
            						'<th><?=lang('job_order_debtor')?></th>' +
                                    '<th><?=lang('job_order_po_spk_no')?></th>' +
                                    '<th><?=lang('job_order_so_no')?></th>' +
                                    '<th>From - To</th>' +
                                    '<th>JO Type</th>' +
                                    '<th>Price Type</th>' +
                                    '<th>Item</th>' +
                                    '<th><?=lang('port')?></th>' +
                                    '<th><?=lang('vessel_name')?> </th>' +
            						'<th><?=lang('job_order_date')?></th>' +
                                    '<th><?=lang('vessel_no')?> </th>' +
                                    '<th>Year</th>' +
                                    '<th>month</th>' +
                                    '<th>code</th>' +
                                    '<th>fare trip id</th>' +
                                    '<th>from id</th>' +
                                    '<th>to id</th>' +
                                    '<th>Jo Type</th>' +
                                    '<th>Price Amount</th>' +
                                    '<th>Price Type</th>' +
                                    '<th>Price 20 Feet</th>' +
                                    '<th>Price 40 Feet</th>' +
                                    '<th>Price 45 Feet</th>' +
                                  '</tr> ' +
            				  '</thead>';
                              
                $.each(result, function(key, data) {	
                    var jo_type = '';
                    if(data.jo_type == '1')
                        jo_type = "BULK";
                    else if(data.jo_type == '2')
                        jo_type = "CONTAINER";
                    else
                        jo_type = "OTHERS";
                    
                    var wholesale = '';
                    if(data.wholesale == 1){
                        wholesale = 'All In';
                    }
                    else{
                        wholesale = 'Pcs';
                    }
                    
    				isi_table += '<tr style="cursor: pointer;">' +
            						'<td>'+data.jo_no+'</td>' +
            						'<td>'+data.debtor+'</td>' +
                                    '<td>'+data.po_spk_no+'</td>' +
                                    '<td>'+data.so_no+'</td>' +
                                    '<td>'+data.from_name+' - '+data.to_name+'</td>' +
                                    '<td>'+jo_type+'</td>' +
                                    '<td>'+wholesale+'</td>' +
                                    '<td>'+data.item_name+'</td>' +
                                    '<td>'+data.port_name+'</td>' +
                                    '<td>'+data.vessel_name+'</td>' +
            						'<td>'+toDdMmYy(data.jo_date)+'</td>' +
                                    '<td>'+data.vessel_no+'</td>' +
                                    '<td>'+data.year+'</td>' +
                                    '<td>'+data.month+'</td>' +
                                    '<td>'+data.code+'</td>' +
                                    '<td>'+data.fare_trip_rowID+'</td>' +
                                    '<td>'+data.destination_from_rowID+'</td>' +
                                    '<td>'+data.destination_to_rowID+'</td>' +
                                    '<td>'+data.jo_type+'</td>' +
                                    '<td>'+data.price_amount+'</td>' +
                                    '<td>'+data.wholesale+'</td>' +
                                    '<td>'+data.price_20ft+'</td>' +
                                    '<td>'+data.price_40ft+'</td>' +
                                    '<td>'+data.price_45ft+'</td>' +  
                                 '</tr>';
    			     no++;
                });  
                
                $('#tbl-joborder').append(isi_table);   
               
                $('#tbl-joborder').DataTable().destroy();
                $('#tbl-joborder').DataTable({
                    "bProcessing": true,
                    "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
                    "sPaginationType": "full_numbers",
            	});
            }        
            
        },
    	error: function(xhr, status, error) {
    		document.write(xhr.responseText);
    	}
    });
    
}

function delete_realization(alloc_no)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
        $.ajax({
            url : "<?php echo base_url('realizations/delete_realization/')?>/" + alloc_no,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                if (data.success){ 
                    sweetAlert('Deleted!',''+data.msg);   
                    location.replace("<?php echo base_url($this->session->userdata('page_detail'))?>");
                }else{
                    swal("Oops!", data.msg, "error");
                }
                
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}

$('#choose_delivery').click(function(){
    $('#delivery_order').show();
    $('#delivery_order').prop('class','tab-pane active');
    $('#cost').hide();
    $('#cost').prop('class','tab-pane');
});

$('#choose_cost').click(function(){
    $('#cost').show();
    $('#cost').prop('class','tab-pane active');
    $('#delivery_order').hide();
    $('#delivery_order').prop('class','tab-pane');
});

function cariJO(row){
    document.getElementById("tag").value=row;
        
    if($('#do_jo_no'+ row).val() == ''){
        $('#joModal').modal('show');
        
        $('#tbl-joborder').DataTable().destroy();
        var table = $('#tbl-joborder').DataTable({
            "aaSorting": [[0, 'desc']],
    		"bProcessing": true,
            "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            "sPaginationType": "full_numbers",
            "columnDefs": [
                {
                    "targets": [ 11 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 12 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 13 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 14 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 15 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 16 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 17 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 18 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 19 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 20 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 21 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 22 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 23 ],
                    "visible": false,
                    "searchable": false
                }
            ]
    	});
        
         x=document.getElementById("tag").value;
         $('#tbl-joborder tbody').on('click', 'tr', function () {
            var data = table.row( this ).data();
            $('#do_jo_no'+x).val(data[0]);
            $('#jo_year'+x).val(data[12]);
            $('#jo_month'+x).val(data[13]);
            $('#jo_code'+x).val(data[14]);
            $('#jo_fare_trip_id'+x).val(data[15]);
            $('#from_id').val(data[16]);
            $('#to_id').val(data[17]);
            $('#jo_type').val(data[18]);
            
            if($('#jo_type').val() == '1'){
                $('#ContType'+x).val('');    
                $('#container_no'+x).val('');                                    
    
                $('#ContType'+x).prop('disabled',true);    
                $('#container_no'+x).prop('disabled',true);                                    
            }
            else{
                $('#ContType'+x).val('');    
                $('#container_no'+x).val('');                                    
    
                $('#ContType'+x).prop('disabled',false);    
                $('#container_no'+x).prop('disabled',false);        
            }
                        
            var alloc_ = number_format($('#cash_advance_alloc_').val(),0,',','.','deformat');
            var alloc = number_format($('#cash_advance_alloc').val(),0,',','.','deformat');
            
            $.ajax({
                type: "POST",
                url : "<?php echo base_url('finances/getAmountCost'); ?>",
    			data: "from_id="+$('#from_id').val()+'&to_id='+$('#to_id').val()+'&jo_type='+$('#jo_type').val()+
                    '&vehicle_type='+$('#vehicle_type').val()+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
                cache:false,
                dataType:"JSON",
                success: function(data){
                    if(data == null){
                        $('#do_jo_no'+ x).val('');
                        swal("Oops!", "Data mismatch, please select other job order.", "error");
                    }
                    else{
                        if(parseInt(data.total) > parseInt(alloc)){
                            var total_alloc = parseInt(data.total) + parseInt(alloc_);
                            if($('#pok_external').is(':checked',true) || $('#ca_pok').is(':checked',true)) {
                                $('#cash_advance_alloc').val(tandaPemisahTitik($('#advance_amount').val()));
                            }
                            else{
                                $('#cash_advance_alloc').val(tandaPemisahTitik(total_alloc));
                            }
                            
                            var row_id = parseInt($('#row_id').val());
                            var row_job_id = $('#row_job_id').val();
                            var row_job_id_tmp = $('#row_job_id_tmp').val();
                            
                            if(row_job_id_tmp == "0"){
                                addRow_Cost(true);
                                $('#cost_rowID'+ row_id).select2('val','2');
                                $('#descs'+ row_id).val($('#cash_advance_no').val());
                                if($('#pok_external').is(':checked',true) || $('#ca_pok').is(':checked',true)) {
                                    $('#amountCost'+ row_id).val(tandaPemisahTitik($('#advance_amount').val()));
                                }
                                else{
                                    $('#amountCost'+ row_id).val(tandaPemisahTitik(data.total));
                                }
                                
                                sumDetailCost(row_id);
                                
                                $('#row_job_id_tmp').val(1);
                                $('#row_cost_id_tmp').val('rowCost'+row_id);
                                
                            }
                            else{
                                if($('#pok_external').is(':checked',true) || $('#ca_pok').is(':checked',true)) {
                                    $('#amountCost'+ row_id).val(tandaPemisahTitik($('#advance_amount').val()));
                                }
                                else{
                                    $('#amountCost'+ row_job_id).val(tandaPemisahTitik(data.total));
                                }
                            }
                        }
                        
                        $('#amount_'+ x).val(data.total);
                        $('#komisi_supir_'+ x).val(data.komisi_supir);
                        $('#komisi_kernet_'+ x).val(data.komisi_kernet);
                        $('#komisi_supir_tmp_'+ x).val(data.komisi_supir);
                        $('#komisi_kernet_tmp_'+ x).val(data.komisi_kernet);
                        $('#deposit_'+ x).val(data.deposit);
                    }                      
                },
    			error: function(xhr, status, error) {
    				document.write(xhr.responseText);
    			}
            });
           
           // var jo_fare_trip_id = $('#jo_fare_trip_id'+x).val();
           // var vehicle_type_id = $('#vehicle_type_id').val()
           // var advance_type_rowID = $('#cash_advance_type_id').val();
            
            //if ( advance_type_rowID == 1 ){// UANG JALAN
             //   cariCost(jo_fare_trip_id,vehicle_type_id,x);
           // } 
            //tes();
            $('#joModal').modal('hide');
            document.getElementById("tag").value='';
        });
      $('.modal-job-title').text('Job Order List'); 
    }
}


function cariCost(jo_fare_trip_id,vehicle_type_id,i){
     
       $.ajax({
            type: "GET",
            url : "<?php echo base_url('finances/getAmountCost2'); ?>",
			data: "jo_fare_trip_id="+jo_fare_trip_id+'&vehicle_type_id='+vehicle_type_id+
                '&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
            cache:false,
            dataType:"JSON",
            success: function(result){
         		var x=0;
        		$.each(result, function(key, val) {	
        		x++;

        		addRow_Cost(false);
                $('#cost_rowID'+x).val(val.cost_rowID);
                $('#amountCost'+x).val(number_format(val.fare_trip_amt,0,',','.','format'));

            });
					
            },
			error: function(xhr, status, error) {
				document.write(xhr.responseText);
				alert(xhr.responseText);
			}
        });
}

function edit_realization_list(alloc_no,advance_no,alloc_date){
    
    $.ajax({
        url:'<?php echo base_url(); ?>realizations/get_data_realization?alloc_no='+alloc_no+'&advance_no='+advance_no,
        data: '<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        type: "POST",
        dataType: 'json',
        success: function(data)
        {
              var toDdMmYy = function(input) {
                    var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
                    if(!input || !input.match(ptrn)) {
                        return null;
                    }
                    return input.replace(ptrn, '$3-$2-$1');
              };

              $('#prefix').val(data.prefix);
              $('#year').val(data.year);  
              $('#month').val(data.month);  
              $('#code').val(data.code);
              
              var remark = '-';
              if(data.fare_trip_no == null || data.destination_from_name == null || data.destination_to_name == null){
                remark = '-';                
              }
              else{
                remark = data.fare_trip_no +' ('+data.destination_from_name+' ke '+data.destination_to_name+')';
              }              
              
              var v_type_name = '';
              if(data.type_name == null){
                v_type_name = '';
              }
              else{
                v_type_name = ' [' + data.type_name + ']';
              }
              
              var v_police_no = '';
              if(data.police_no == null){
                v_police_no = '-';
              }
              else{
                v_police_no = data.police_no;
              }
              
              $('#alloc_no').val(alloc_no);
              $('#date').val(toDdMmYy(alloc_date));
              $('#cash_advance_no').val(data.advance_no);
              $('#cash_advance_date').val(data.advance_date);
              $('#cash_advance_type_id').val(data.advance_type_rowID);
              $('#cash_advance_type').val(data.advance_name);
              $('#remark').val(remark);
              $('#fare_trip_code').val(data.fare_trip_code);
              $('#fare_trip_id').val(data.fare_trip_rowID);
              $('#vehicle_type_id').val(data.vehicle_type_rowID);
              $('#advance_amount').val(data.advance_amount);
              $('#cash_advance_amt').val(number_format(parseInt(data.advance_amount) + parseInt(data.advance_extra_amount),0,',','.','format'));
              $('#cash_advance_alloc_').val(0);
              $('#cash_advance_alloc').val(number_format(data.advance_allocation,0,',','.','format'));
              $('#cash_advance_balance').val(number_format(parseInt(data.advance_amount) + parseInt(data.advance_extra_amount) - parseInt(data.advance_allocation),0,',','.','format'));
              $('#driver').val(data.employee_driver_rowID);
              $('#driver_name').val(data.debtor_name+'-'+data.employee+'-'+data.id_no);
              $('#vehicle_no_type').val(v_police_no+v_type_name);
              $('#vehicle_type').val(data.vehicle_type_rowID);
              $('#on_process').val(data.on_process);
              $('#reference_pok_no_1').val(data.reference_pok_no_1);
              $('#reference_pok_no_2').val(data.reference_pok_no_2);

              if(data.doc_sj == 'Yes'){
                document.getElementById('doc_sj').checked = true;              
              }
              else{
                document.getElementById('doc_sj').checked = false;                              
              }

              if(data.doc_st == 'Yes'){
                document.getElementById('doc_st').checked = true;              
              }
              else{
                document.getElementById('doc_st').checked = false;                              
              }

              if(data.doc_sm == 'Yes'){
                document.getElementById('doc_sm').checked = true;              
              }
              else{
                document.getElementById('doc_sm').checked = false;                              
              }

              if(data.doc_sr == 'Yes'){
                document.getElementById('doc_sr').checked = true;              
              }
              else{
                document.getElementById('doc_sr').checked = false;                              
              }
              
              if(data.status == 0 || data.status == 1){
                document.getElementById('pok').checked = false;                              
                document.getElementById('pok_external').checked = false;                              
                document.getElementById('ca_pok').checked = false;                              
                $('#reference_pok_no_field').hide();
              }

              if(data.status == 2){
                document.getElementById('cancel_load').checked = false;                              
                document.getElementById('ca_pok').checked = false;
                document.getElementById('pok').checked = true;                              
                document.getElementById('pok_external').checked = false;
                $('#reference_pok_no_field').hide();
              }
              
              if(data.status == 3 || data.status_external == 1){
                document.getElementById('cancel_load').checked = false;                              
                document.getElementById('ca_pok').checked = false;
                document.getElementById('pok').checked = false;                              
                document.getElementById('pok_external').checked = true;
                $('#reference_pok_no_field').hide();
              }
              
              if(data.status == 4){
                document.getElementById('cancel_load').checked = false;                              
                document.getElementById('ca_pok').checked = true;
                document.getElementById('pok').checked = false;     
                if(data.status == 3 || data.status_external == 1){
                    document.getElementById('pok_external').checked = true;
                }
                else{
                    document.getElementById('pok_external').checked = false;
                }
                $('#reference_pok_no_field').show();
              }
                            
              if(data.advance_type_rowID == 1){
                $('#delivery_order').show();
                $('#delivery_order').prop('class','tab-pane active');    
                $('#choose_delivery').show();

                $('#cost').hide();
                $('#cost').prop('class','tab-pane'); 
                $('#choose_cost').prop('class',''); 
                            
              }
              else{
                $('#delivery_order').hide();
                $('#delivery_order').prop('class','tab-pane');                                
                $('#choose_delivery').hide();

                $('#cost').show();
                $('#cost').prop('class','tab-pane active');                
                $('#choose_cost').prop('class','active');
              }

              showDetailRealizationDO(alloc_no);
              showDetailRealizationCost(alloc_no);
              
              show_modal_jo(data.from_id,data.to_id,data.trip_type);
              
              $('#modal_realization').modal('show'); 
              //coba();
              $('.modal-title-realization').text('Edit <?=lang('realization')?>');  
              
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error update data", "error");
        }
    });
    
}

function showDetailRealizationDO(alloc_no){
    bersihDORealization();
    
    $.ajax({
        type: "GET",
        url:'<?php echo base_url(); ?>realizations/showDetailDO?alloc_no='+alloc_no,
		dataType:"JSON",
		success: function(result){
    		var x=0;
            var toDdMmYy = function(input) {
                var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
                if(!input || !input.match(ptrn)) {
                    return null;
                }
                return input.replace(ptrn, '$3-$2-$1');
            };

    		$.each(result, function(key, val) {	
        		x++;
        		addRow_DeliveryOrderRealization();
                
                $.ajax({
                    type: "GET",
                    url:'<?php echo base_url(); ?>realizations/getAmountCost?jo_no='+val.jo_no+'&vehicle_type='+$('#vehicle_type').val(),
            		dataType:"JSON",
            		success: function(data_do){
                        $('#amount_'+x).val(data_do.total);
                    }
                });
                
                $('#do_jo_no'+x).val(val.jo_no);
                $('#do_jo_no'+x).attr('onclick','');
                $('#jo_year'+x).val(val.tr_jo_trx_hdr_year);
                $('#jo_month'+x).val(val.tr_jo_trx_hdr_month);
                $('#jo_code'+x).val(val.tr_jo_trx_hdr_code);
                $('#jo_fare_trip_id'+x).val(val.jo_no);
                $('#komisi_supir_'+x).val(val.komisi_supir);
                $('#komisi_kernet_'+x).val(val.komisi_kernet);
                $('#deposit_'+x).val(val.deposit);
                
                if(val.count_container == '2'){
                    $('#ContType'+x).val('220');
                    $('#komisi_supir_tmp_'+x).val(val.komisi_supir / 1);
                    $('#komisi_kernet_tmp_'+x).val(val.komisi_kernet / 1);
                }
                else{
                    $('#ContType'+x).val(val.container_size);
                    $('#komisi_supir_tmp_'+x).val(val.komisi_supir);
                    $('#komisi_kernet_tmp_'+x).val(val.komisi_kernet);
                }
                
                $('#container_no'+x).val(val.container_no);
                if(val.container_size == 0){
                    $('#ContType'+x).prop('disabled',true);
                    $('#container_no'+x).prop('disabled',true);         
                }    
                else{
                    $('#ContType'+x).prop('disabled',false);
                    $('#container_no'+x).prop('disabled',false);
                }
                         
                $('#do_no'+x).val(val.do_no);
                $('#do_date'+x).val(toDdMmYy(val.do_date));
                $('#do_weight'+x).val(val.deliver_weight);
                $('#received_weight'+x).val(val.received_weight);
                $('#received_date'+x).val(toDdMmYy(val.received_date));
                
      	    });

            if(x == 0){
                $('#choose_delivery').hide();
                $('#choose_cost').click();
                $('#choose_cost').attr('class','active');
                $('#choose_delivery').attr('class','');
                $('#cancel_load').attr('checked',true);
            }
            else{
                $('#choose_delivery').show();
                $('#choose_delivery').click();
                $('#choose_delivery').attr('class','active');
                $('#choose_cost').attr('class','');
                $('#cancel_load').attr('checked',false);
            }
             
        }
            
   });
               
}

function showDetailRealizationCost(alloc_no){
    bersihCostRealization();
    
    $.ajax({
        type: "GET",
        url:'<?php echo base_url(); ?>realizations/showDetailCost?alloc_no='+alloc_no,
		dataType:"JSON",
		success: function(result){
    		var x=0;
            var toDdMmYy = function(input) {
                var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
                if(!input || !input.match(ptrn)) {
                    return null;
                }
                return input.replace(ptrn, '$3-$2-$1');
            };

    		$.each(result, function(key, val) {	
        		x++;
                
                if(x == 1){
        		  addRow_Cost_Realization(true);                      
                }
                else{
        		  addRow_Cost_Realization(false);  
                }
                
                $('#cost_rowID'+x).select2('val',val.cost_rowID);
                $('#descs'+x).val(val.descs);
                $('#amountCost'+x).val(number_format(val.trx_amt,0,',','.','format'));
                
                sumDetailCostRealization(x);    
                
      	    });
           
        }
            
   });
               
}

var totrowDO=0;
function addRow_DeliveryOrder(){
    totrowDO++;
    var detailrow="";
    detailrow=detailrow+"<tr id='rowDo"+totrowDO+"'>";
    //onclick='cariJO(\""+totrowDO+"\");'
    detailrow=detailrow+"<td>";
    var tombolhapus="<input type='button' style='height:30px;width:30px;border:0px;background-image:url(\"<?= base_url();?>resource/images/delete.png\");background-repeat:no-repeat;' id='hapdet"+totrowDO+"'   title='Hapus Baris' value='&nbsp;' onclick='deleteDo(\"rowDo"+totrowDO+"\")' />";
    detailrow=detailrow+tombolhapus;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"<td >";
    var text1="<input class='form-control' onclick='cariJO(\""+totrowDO+"\")' id='do_jo_no"+totrowDO+"' name='detailDO["+totrowDO+"][do_jo_no]'  type='text' style='text-align:center;height:30px;width:130px;background-color:white;border:solid 1px #ccc;cursor:pointer' readonly='' value=''  /><input id='jo_year"+totrowDO+"' name='detailDO["+totrowDO+"][jo_year]' type='hidden' value=''  /><input id='jo_month"+totrowDO+"' name='detailDO["+totrowDO+"][jo_month]' type='hidden' value=''  /><input id='jo_code"+totrowDO+"' name='detailDO["+totrowDO+"][jo_code]' type='hidden' value=''  /><input id='jo_fare_trip_id"+totrowDO+"' name='detailDO["+totrowDO+"][jo_fare_trip_id]' type='hidden' value=''  />";
    detailrow=detailrow+text1;
    detailrow=detailrow+"<input type='hidden' class='form-control' name='detailDO["+totrowDO+"][komisi_supir]' id='komisi_supir_"+totrowDO+"' ><input type='hidden' class='form-control' name='detailDO["+totrowDO+"][komisi_kernet]' id='komisi_kernet_"+totrowDO+"' ><input type='hidden' class='form-control' name='detailDO["+totrowDO+"][deposit]' id='deposit_"+totrowDO+"' ><input type='hidden' class='form-control' name='detailDO["+totrowDO+"][amount]' id='amount_"+totrowDO+"' ></td>";
    
    var ContainerType="<select class='form-control' id='ContType"+totrowDO+"' name='detailDO["+totrowDO+"][ContType]' style='height:30px;width:130px;background-color:white;border:solid 1px #ccc;' /></select>";
	detailrow=detailrow+"<td><input type='hidden' class='form-control' name='detailDO["+totrowDO+"][komisi_supir_tmp]' id='komisi_supir_tmp_"+totrowDO+"' ><input type='hidden' class='form-control' name='detailDO["+totrowDO+"][komisi_kernet_tmp]' id='komisi_kernet_tmp_"+totrowDO+"' >"+
                    ContainerType+"</td>";
    
    detailrow=detailrow+"<td >";
    var text20="<input class='form-control' id='container_no"+totrowDO+"' name='detailDO["+totrowDO+"][container_no]'  type='text' style='text-align:left;height:30px;width:170px;background-color:white;border:solid 1px #ccc;'  value=''  />";
    detailrow=detailrow+text20;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"<td><div class='col-md-9' style='padding:0px'>";
    var text2="<input class='form-control' id='do_no"+totrowDO+"' name='detailDO["+totrowDO+"][do_no]'  type='text' style='text-align:left;height:30px;width:170px;background-color:white;border:solid 1px #ccc;'  value=''  /></div>";
    detailrow=detailrow+text2;
    var button_search="<div class='col-md-3' style='padding:0px 0px 0px 5px'><button type='button' class='btn btn-sm btn-info' id='button_search"+totrowDO+"' onclick='showModalDO("+totrowDO+");' title='Search DO' ><i class='fa fa-search'></i></button></div>";
    detailrow=detailrow+button_search;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"<td >";
    var text3="<input  class='form-control' id='do_date"+totrowDO+"' name='detailDO["+totrowDO+"][do_date]'  type='text' style='text-align:center;height:30px;width:120px;background-color:white;border:solid 1px #ccc;'  value='<?=date('d-m-Y')?>'  />";
    detailrow=detailrow+text3;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"<td >";
    var text4="<input class='form-control' id='do_weight"+totrowDO+"' name='detailDO["+totrowDO+"][do_weight]' onkeyup='IsNumericOnly(this);' type='text' style='text-align:left;height:30px;width:80px;background-color:white;border:solid 1px #ccc;'  value='0' maxlength='10' />";
    detailrow=detailrow+text4;
    detailrow=detailrow+"</td>";

    detailrow=detailrow+"<td >";
    var text4="<input  class='form-control' id='received_date"+totrowDO+"' name='detailDO["+totrowDO+"][received_date]'  type='text' style='text-align:center;height:30px;width:120px;background-color:white;border:solid 1px #ccc;'  value='<?=date('d-m-Y')?>'  />";
    detailrow=detailrow+text4;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"<td >";
    var text4="<input class='form-control' id='received_weight"+totrowDO+"' name='detailDO["+totrowDO+"][received_weight]' onkeyup='IsNumericOnly(this);' type='text' style='text-align:left;height:30px;width:80px;background-color:white;border:solid 1px #ccc;'  value='0' maxlength='10' />";
    detailrow=detailrow+text4;
    detailrow=detailrow+"</td>";
                    
    detailrow=detailrow+"</tr>";
            $('#detail_DO tr:last').after(
            detailrow
    );

    $("#do_date"+totrowDO).datepicker({
		format: 'dd-mm-yyyy'
	}).on('changeDate',function(ev){
        $("#do_date"+totrowDO).datepicker('hide');
        $("#received_date"+totrowDO).val($("#do_date"+totrowDO).val());
	});

    $("#received_date"+totrowDO).datepicker({
		format: 'dd-mm-yyyy'
	}).on('changeDate',function(ev){
        $("#received_date"+totrowDO).datepicker('hide');
	});

    $("#row_job_id").val(parseInt($("#row_job_id").val()) + 1);

    document.getElementById("ContType"+totrowDO).innerHTML=document.getElementById("ContType").innerHTML;

}

function addRow_DeliveryOrderRealization(){
    totrowDO++;
    var detailrow="";
    detailrow=detailrow+"<tr id='rowDo"+totrowDO+"'>";
    //onclick='cariJO(\""+totrowDO+"\");'
    detailrow=detailrow+"<td>";
    var tombolhapus="<input type='button' style='height:30px;width:30px;border:0px;background-image:url(\"<?= base_url();?>resource/images/delete.png\");background-repeat:no-repeat;' id='hapdet"+totrowDO+"'   title='Hapus Baris' value='&nbsp;' onclick='deleteDoRealization(\"rowDo"+totrowDO+"\")' />";
    detailrow=detailrow+tombolhapus;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"<td >";
    var text1="<input class='form-control' onclick='cariJO(\""+totrowDO+"\")' id='do_jo_no"+totrowDO+"' name='detailDO["+totrowDO+"][do_jo_no]'  type='text' style='text-align:center;height:30px;width:130px;background-color:white;border:solid 1px #ccc;cursor:pointer' readonly='' value=''  /><input id='jo_year"+totrowDO+"' name='detailDO["+totrowDO+"][jo_year]' type='hidden' value=''  /><input id='jo_month"+totrowDO+"' name='detailDO["+totrowDO+"][jo_month]' type='hidden' value=''  /><input id='jo_code"+totrowDO+"' name='detailDO["+totrowDO+"][jo_code]' type='hidden' value=''  /><input id='jo_fare_trip_id"+totrowDO+"' name='detailDO["+totrowDO+"][jo_fare_trip_id]' type='hidden' value=''  />";
    detailrow=detailrow+text1;
    detailrow=detailrow+"<input type='hidden' class='form-control' name='detailDO["+totrowDO+"][komisi_supir]' id='komisi_supir_"+totrowDO+"' ><input type='hidden' class='form-control' name='detailDO["+totrowDO+"][komisi_kernet]' id='komisi_kernet_"+totrowDO+"' ><input type='hidden' class='form-control' name='detailDO["+totrowDO+"][deposit]' id='deposit_"+totrowDO+"' ><input type='hidden' class='form-control' name='detailDO["+totrowDO+"][amount]' id='amount_"+totrowDO+"' ></td>";
    
    var ContainerType="<select class='form-control' id='ContType"+totrowDO+"' name='detailDO["+totrowDO+"][ContType]' style='height:30px;width:130px;background-color:white;border:solid 1px #ccc;' /></select>";
	detailrow=detailrow+"<td><input type='hidden' class='form-control' name='detailDO["+totrowDO+"][komisi_supir_tmp]' id='komisi_supir_tmp_"+totrowDO+"' ><input type='hidden' class='form-control' name='detailDO["+totrowDO+"][komisi_kernet_tmp]' id='komisi_kernet_tmp_"+totrowDO+"' >"+
                        ContainerType+"</td>";
    
    detailrow=detailrow+"<td >";
    var text20="<input class='form-control' id='container_no"+totrowDO+"' name='detailDO["+totrowDO+"][container_no]'  type='text' style='text-align:left;height:30px;width:130px;background-color:white;border:solid 1px #ccc;'  value=''  />";
    detailrow=detailrow+text20;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"<td><div class='col-md-9' style='padding:0px'>";
    var text2="<input class='form-control' id='do_no"+totrowDO+"' name='detailDO["+totrowDO+"][do_no]' type='text' style='text-align:left;height:30px;width:100%;background-color:white;border:solid 1px #ccc;'  value=''  /></div>";
    detailrow=detailrow+text2;
    var button_search="<div class='col-md-3' style='padding:0px 0px 0px 5px'><button type='button' class='btn btn-sm btn-info' id='button_search"+totrowDO+"' onclick='showModalDO("+totrowDO+");' title='Search DO' ><i class='fa fa-search'></i></button></div>";
    detailrow=detailrow+button_search;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"<td >";
    var text3="<input class='form-control'  id='do_date"+totrowDO+"' name='detailDO["+totrowDO+"][do_date]'  type='text' style='text-align:center;height:30px;width:100px;background-color:white;border:solid 1px #ccc;'  value='<?=date('d-m-Y')?>'  />";
    detailrow=detailrow+text3;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"<td >";
    var text4="<input class='form-control' id='do_weight"+totrowDO+"' name='detailDO["+totrowDO+"][do_weight]' onkeyup='IsNumericOnly(this);' type='text' style='text-align:left;height:30px;width:80px;background-color:white;border:solid 1px #ccc;'  value='0' maxlength='10' />";
    detailrow=detailrow+text4;
    detailrow=detailrow+"</td>";
        
    detailrow=detailrow+"<td >";
    var text4="<input class='form-control' id='received_date"+totrowDO+"' name='detailDO["+totrowDO+"][received_date]'  type='text' style='text-align:center;height:30px;width:100px;background-color:white;border:solid 1px #ccc;'  value='<?=date('d-m-Y')?>'  />";
    detailrow=detailrow+text4;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"<td>";
    var text4="<input class='form-control' id='received_weight"+totrowDO+"' name='detailDO["+totrowDO+"][received_weight]' onkeyup='IsNumericOnly(this);' type='text' style='text-align:left;height:30px;width:80px;background-color:white;border:solid 1px #ccc;'  value='0' maxlength='10' />";
    detailrow=detailrow+text4;
    detailrow=detailrow+"</td>";
                
    detailrow=detailrow+"</tr>";
    
    $('#detail_DO tr:last').after(
            detailrow
    );

    $("#do_date"+totrowDO).datepicker({
		format: 'dd-mm-yyyy'
	}).on('changeDate',function(ev){
        $("#do_date"+totrowDO).datepicker('hide');
        $("#received_date"+totrowDO).val($("#do_date"+totrowDO).val());
	});

    $("#received_date"+totrowDO).datepicker({
		format: 'dd-mm-yyyy'
	}).on('changeDate',function(ev){
        $("#received_date"+totrowDO).datepicker('hide');
	});

    $("#row_job_id").val(parseInt($("#row_job_id").val()) + 1);

    document.getElementById("ContType"+totrowDO).innerHTML=document.getElementById("ContType").innerHTML;

}

function change_commission(x){
    if($('#ContType'+x).val() == '220'){
        var komisi_supir    = $('#komisi_supir_'+x).val();
        var komisi_kernet   = $('#komisi_kernet_'+x).val();
        
        $('#komisi_supir_'+x).val(komisi_supir * 1);
        $('#komisi_kernet_'+x).val(komisi_kernet * 1);
    }
    else{
        $('#komisi_supir_'+x).val($('#komisi_supir_tmp_'+x).val());
        $('#komisi_kernet_'+x).val($('#komisi_kernet_tmp_'+x).val());
    }
}

function setReceiveDate(x){
    $("#received_date"+x).val($("#do_date"+x).val());
}

function deleteDo(x){
    if(document.getElementById(x)!=null){
        $('#'+x).remove(); 
    }

    var awal = 1;
    var amount = 0;
    var y=totrowDO+1;
    
    for(x=1;x<=y;x++){
        if($("#amount_"+x).val()){
    	     if(awal == 1){
                 amount = parseInt($("#amount_"+x).val());
                 ++awal;
             }
             else{
                if(amount < parseInt($("#amount_"+x).val())){
                    amount = parseInt($("#amount_"+x).val());
                }
             }
        }

    }

    $("#cash_advance_alloc").val(tandaPemisahTitik(amount));
    var cash_advance_amt = parseInt(number_format($("#cash_advance_amt").val(),0,',','.','deformat'));
    $("#cash_advance_balance").val(tandaPemisahTitik(cash_advance_amt - amount));
    
    $("#row_job_id").val(parseInt($("#row_job_id").val()) - 1);
    if(parseInt($("#row_job_id").val()) == 0){
        $('#row_job_id_tmp').val(0);    
    }
    
    if(amount == 0){
        deleteCost($('#row_cost_id_tmp').val());
    }
    sumDetailCost(1);
    
}

function deleteDoRealization(x){
    if(document.getElementById(x)!=null){
        $('#'+x).remove(); 
    }

    var awal = 1;
    var amount = 0;
    var y=totrowDO+1;
    
    for(x=1;x<=y;x++){
        if($("#amount_"+x).val()){
    	     if(awal == 1){
                 amount = parseInt($("#amount_"+x).val());
                 ++awal;
             }
             else{
                if(amount < parseInt($("#amount_"+x).val())){
                    amount = parseInt($("#amount_"+x).val());
                }
             }
        }

    }
    
    $("#cash_advance_alloc").val(tandaPemisahTitik(amount));
    var cash_advance_amt = parseInt(number_format($("#cash_advance_amt").val(),0,',','.','deformat'));
    $("#cash_advance_balance").val(tandaPemisahTitik(cash_advance_amt - amount));
    
    $("#row_job_id").val(parseInt($("#row_job_id").val()) - 1);
    if(parseInt($("#row_job_id").val()) == 0){
        $('#row_job_id_tmp').val(0);    
    }
    
    if(amount == 0){
        bersihCostRealization();
    }
    sumDetailCostRealization(1);
    
}

function bersihDO(){
   var y=totrowDO+1;
   for(x=0;x<y;x++){
        if(document.getElementById("rowDo"+x)){
		     deleteDo("rowDo"+x);
       }
   }
   totrowDO=0;
}

function bersihDORealization(){
   var y=totrowDO+1;
   for(x=0;x<y;x++){
        if(document.getElementById("rowDo"+x)){
		     deleteDoRealization("rowDo"+x);
       }
   }
   totrowDO=0;
}

var totrowCost=0;
function addRow_Cost(lock){
    var readonly = "";
    var row_id = parseInt($('#row_id').val());    

    if(lock == true){
        readonly = "readonly='readonly'";
    }

    totrowCost = row_id;
    var detailrow="";
    detailrow=detailrow+"<tr id='rowCost"+totrowCost+"'>";
    
    detailrow=detailrow+"<td>";

    var tombolhapus="";
    if(lock == false){
        tombolhapus="<input type='button' style='height:30px;width:30px;border:0px;background-image:url(\"<?= base_url();?>resource/images/delete.png\");background-repeat:no-repeat;' id='hapdet"+totrowCost+"'   title='Hapus Baris' value='&nbsp;' onclick='deleteCost(\"rowCost"+totrowCost+"\")' />";
    }

    detailrow=detailrow+tombolhapus;
    detailrow=detailrow+"</td>";

    var cost_code="<select  class='yellowtext all_select2'  id='cost_rowID"+totrowCost+"' name='detailCost["+totrowCost+"][cost_rowID]'   type='text'  style='height:30px;width:250px;background-color:white;border:solid 1px #ccc;' /></select>";
	detailrow=detailrow+"<td>"+cost_code+"</td>";
    
    detailrow=detailrow+"<td >";
    var text2="<input class='form-control' id='descs"+totrowCost+"' name='detailCost["+totrowCost+"][descs]'  type='text' style='text-align:left;height:30px;width:650px;background-color:white;border:solid 1px #ccc;'  value='' "+readonly+" /><input class='form-control'  id='itemNo"+totrowCost+"' name='detailCost["+totrowCost+"][itemNo]'  type='hidden'  value='"+totrowCost+"'  />";
    detailrow=detailrow+text2;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"<td >";
    var text1="<div class='input-group'><span class='input-group-addon' id='basic-addon1'>Rp</span><input class='form-control currency' onkeyup='sumDetailCost(\""+totrowCost+"\");' id='amountCost"+totrowCost+"' name='detailCost["+totrowCost+"][amountCost]'  type='text' style='text-align:right;font-size:15px;font-weight:600;color: black;height:30px;width:140px;background-color:white;border:solid 1px #ccc;'  value='0' "+readonly+" /></div>";
    detailrow=detailrow+text1;
    detailrow=detailrow+"</td>";
                
    detailrow=detailrow+"</tr>";
            $('#detail_cost tr:last').after(
                detailrow
    );
    
    
    $("#cost_rowID"+totrowCost).select2();
    if(lock == true){
        $("#cost_rowID"+totrowCost).prop("readonly", true);
        $("#cost_rowID"+totrowCost).prop("class", "yellowtext");
    }

    $('#row_id').val(parseInt(row_id + 1)); 
    
    //$("#cost_rowID"+totrowCost).select2();
    document.getElementById("cost_rowID"+totrowCost).innerHTML=document.getElementById("cost_code").innerHTML;
    
    //cariCost(totrowCost);
      
}

function addRow_Cost_Realization(lock){
    var readonly = "";
    var row_id = parseInt($('#row_id').val());    

    if(lock == true){
        readonly = "readonly='readonly'";
    }

    totrowCost = row_id;
    var detailrow="";
    detailrow=detailrow+"<tr id='rowCost"+totrowCost+"'>";
    
    detailrow=detailrow+"<td>";

    var tombolhapus="";
    if(lock == false){
        tombolhapus="<input type='button' style='height:30px;width:30px;border:0px;background-image:url(\"<?= base_url();?>resource/images/delete.png\");background-repeat:no-repeat;' id='hapdet"+totrowCost+"'   title='Hapus Baris' value='&nbsp;' onclick='deleteCostRealization(\"rowCost"+totrowCost+"\")' />";
    }

    detailrow=detailrow+tombolhapus;
    detailrow=detailrow+"</td>";

    var cost_code="<select  class='yellowtext all_select2'  id='cost_rowID"+totrowCost+"' name='detailCost["+totrowCost+"][cost_rowID]'   type='text'  style='height:30px;width:250px;background-color:white;border:solid 1px #ccc;' /></select>";
	detailrow=detailrow+"<td>"+cost_code+"</td>";
    
    detailrow=detailrow+"<td >";
    var text2="<input class='form-control' id='descs"+totrowCost+"' name='detailCost["+totrowCost+"][descs]'  type='text' style='text-align:left;height:30px;width:650px;background-color:white;border:solid 1px #ccc;'  value='' "+readonly+" /><input class='form-control'  id='itemNo"+totrowCost+"' name='detailCost["+totrowCost+"][itemNo]'  type='hidden'  value='"+totrowCost+"'  />";
    detailrow=detailrow+text2;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"<td >";
    var text1="<div class='input-group'><span class='input-group-addon' id='basic-addon1'>Rp</span><input class='form-control currency' onkeyup='sumDetailCostRealization(\""+totrowCost+"\");' id='amountCost"+totrowCost+"' name='detailCost["+totrowCost+"][amountCost]'  type='text' style='text-align:right;font-size:15px;font-weight:600;color: black;height:30px;width:140px;background-color:white;border:solid 1px #ccc;'  value='0' "+readonly+" /></div>";
    detailrow=detailrow+text1;
    detailrow=detailrow+"</td>";
                
    detailrow=detailrow+"</tr>";
            $('#detail_cost tr:last').after(
                detailrow
    );
    
    
    $("#cost_rowID"+totrowCost).select2();
    if(lock == true){
        $("#cost_rowID"+totrowCost).prop("readonly", true);
        $("#cost_rowID"+totrowCost).prop("class", "yellowtext");
    }

    $('#row_id').val(parseInt(row_id + 1)); 
    
    //$("#cost_rowID"+totrowCost).select2();
    document.getElementById("cost_rowID"+totrowCost).innerHTML=document.getElementById("cost_code").innerHTML;
    
    //cariCost(totrowCost);
      
}

function deleteCost(x){
    if(document.getElementById(x)!=null){
       $('#'+x).remove(); 
       sumDetailCost(1);
    }
}

function deleteCostRealization(x){
    if(document.getElementById(x)!=null){
       $('#'+x).remove(); 
       sumDetailCostRealization(1);
    }
}
 
function bersihCost(){
    var y=totrowCost+1;
        for(x=0;x<y;x++){
            if(document.getElementById("rowCost"+x)){
			     deleteCost("rowCost"+x);
           }
       }
     totrowCost=0;
     $('#row_id').val(1);
}

function bersihCostRealization(){
    var y=totrowCost+1;
        for(x=0;x<y;x++){
            if(document.getElementById("rowCost"+x)){
			     deleteCostRealization("rowCost"+x);
           }
       }
     totrowCost=0;
     $('#row_id').val(1);
}
 
function sumDetailCost(x){
    var looprows=totrowCost+1;
    var totNil=0;

    var alloc_ = number_format($('#cash_advance_alloc_').val(),0,',','.','deformat');

    for(z=1;z<looprows; z++){  
        if(document.getElementById('amountCost'+z)!=null  ){
            if(document.getElementById('amountCost'+z).value!="" ){
                var nilai=number_format(document.getElementById('amountCost'+z).value,0,',','.','deformat');
                totNil += parseInt(nilai);
            }
        }
    }
    
    var amount_ca = parseInt(number_format(document.getElementById('cash_advance_amt').value,0,',','.','deformat'));
    var balanced = parseInt(amount_ca - (totNil + alloc_)) ; 
    
    document.getElementById('cash_advance_alloc').value=number_format(totNil + alloc_,0,',','.','format');
    document.getElementById('cash_advance_balance').value=number_format(balanced,0,',','.','format');
} 

function sumDetailCostRealization(x){
    var looprows=totrowCost+1;
    var totNil=0;

    for(z=1;z<looprows; z++){  
        if(document.getElementById('amountCost'+z)!=null  ){
            if(document.getElementById('amountCost'+z).value!="" ){
                var nilai=number_format(document.getElementById('amountCost'+z).value,0,',','.','deformat');
                totNil += parseInt(nilai);
            }
        }
    }
    
    var amount_ca = parseInt(number_format(document.getElementById('cash_advance_amt').value,0,',','.','deformat'));
    var balanced = parseInt(amount_ca - totNil) ; 
    
    document.getElementById('cash_advance_alloc').value=number_format(totNil,0,',','.','format');
    document.getElementById('cash_advance_balance').value=number_format(balanced,0,',','.','format');
} 

function chk_pok_external(){
    if ($('#pok_external').is(':checked',true)) {
        if($('#cancel_load').is(':checked',true) || $('#pok').is(':checked',true)) {
            if($('#cash_advance_type_id').val() == '1'){
                $('#choose_delivery').show();
                $('#choose_delivery').click();
                $('#choose_delivery').attr('class','active');
                $('#choose_cost').attr('class','');
                bersihDO();
                bersihCost();
                addRow_DeliveryOrder();
            }
            $('#cancel_load').attr('checked',false);
            $('#pok').attr('checked',false);
        }

        $('#status_external').val('1');

        if($('#ca_pok').is(':checked',true)){
            $('#reference_pok_no_field').show();
        }
        else{
            $('#reference_pok_no_1').val('');
            $('#reference_pok_no_2').val('');
            $('#reference_pok_no_field').hide();
        }
    }
    else if($('#ca_pok').is(':checked',true)){
        if($('#cancel_load').is(':checked',true) || $('#pok').is(':checked',true)) {
            if($('#cash_advance_type_id').val() == '1'){
                $('#choose_delivery').show();
                $('#choose_delivery').click();
                $('#choose_delivery').attr('class','active');
                $('#choose_cost').attr('class','');
                bersihDO();
                bersihCost();
                addRow_DeliveryOrder();
            }
            $('#cancel_load').attr('checked',false);
            $('#pok').attr('checked',false);
        }
        
        $('#reference_pok_no_field').show();
        
        if($('#pok_external').is(':checked',true)){
            $('#status_external').val('1');
        }
        else{
            $('#status_external').val('0');
        }
    }
    else{       
        $('#status_external').val('0');
        $('#reference_pok_no_1').val('');
        $('#reference_pok_no_2').val('');
        $('#reference_pok_no_field').hide();
    }
    
    bersihDO();
    bersihCost();
    addRow_DeliveryOrder();
}

function chk_cancel_load(){
    if($('#cancel_load').is(':checked',true)) {
        if($('#cash_advance_type_id').val() == '1'){
            bersihDO();
            bersihCost();
            $('#choose_delivery').hide();
            $('#choose_cost').click();
            $('#choose_cost').attr('class','active');
            $('#choose_delivery').attr('class','');
            if(totrowCost == 0){
                addRow_Cost(false);
            }
        }
        $('#pok').attr('checked',false);
        $('#pok_external').attr('checked',false);
        $('#ca_pok').attr('checked',false);
        $('#reference_pok_no_field').hide();
    }
    else if($('#pok').is(':checked',true)){
        if($('#cash_advance_type_id').val() == '1'){
            bersihDO();
            bersihCost();
            $('#choose_delivery').hide();
            $('#choose_cost').click();
            $('#choose_cost').attr('class','active');
            $('#choose_delivery').attr('class','');
            if(totrowCost == 0){
                addRow_Cost(false);
            }
        }
        $('#cancel_load').attr('checked',false);
        $('#pok_external').attr('checked',false);
        $('#ca_pok').attr('checked',false);
        $('#reference_pok_no_field').hide();
    }
    else{
        if($('#cash_advance_type_id').val() == '1'){
            $('#choose_delivery').show();
            $('#choose_delivery').click();
            $('#choose_delivery').attr('class','active');
            $('#choose_cost').attr('class','');
            bersihDO();
            bersihCost();
            addRow_DeliveryOrder();
        }
        
    }
    $('#status_external').val('0');
    $('#reference_pok_no_1').val('');
    $('#reference_pok_no_2').val('');
}

function show_ca_pok(no){
    $('#row_no_reference').val(no);
    $('#modal_select_ca_pok').modal('show');
}

function get_ca_pok(ca_no){
    $('#reference_pok_no_'+$('#row_no_reference').val()).val(ca_no);
    $('#modal_select_ca_pok').modal('hide');
}

function save_cash_advance_realization(){
    var validasi="";
    var x=1;
    var totalrowx=parseInt($('#row_id').val());
    
    for(x=1;x<totalrowx;x++){
        if(document.getElementById('descs'+x)!=null){
            if(document.getElementById('descs'+x).value!=""){
                var descs      =  $('#descs'+x).val();
                var amountCost =  $('#amountCost'+x).val();
                var data1=cekValidasiDetail(descs,'Description',x)
                var data2=cekValidasiDetailangka(amountCost,'Amount',x)

                validasi = validasi+data1+data2;
                
            }else{
                sweetAlert('<?=lang('information')?>','Column contents Incomplete in Cost Details !');
                return false;
            }
        }
    }
    
    var cek_jo = '';
    if($('#cash_advance_type_id').val() == '1'){
        for(x=1;x<=totrowDO;x++){
            if(document.getElementById('do_jo_no'+x)!=null){
                if(document.getElementById('do_jo_no'+x).value==""){
                    cek_jo = 'empty';
                }                
            }
            
            if(document.getElementById('ContType'+x)!=null){
                if ($('#jo_type').val() == '2') {
                    var container_size = $('#ContType'+x).val();
                    var container_no = $('#container_no'+x).val();
                    var data3 = cekValidasiDetail(container_size,'Container',x)
                    var data4 = cekValidasiDetail(container_no,'Container No',x)
                    validasi = validasi+data3+data4;
                }
            }
        }
    }
    
    var cek_do = '';
    if($('#cash_advance_type_id').val() == '1'){
        for(x=1;x<=totrowDO;x++){
            if(document.getElementById('do_no'+x)!=null){
                if(document.getElementById('do_no'+x).value==""){
                    cek_do = 'empty';
                }
                else{
                    $.ajax({
                        url:'<?php echo base_url(); ?>finances/check_data_do',
                		type: "POST",
                        data: "x="+x+"&do_no="+$('#do_no'+x).val()+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
                        dataType:"JSON",
                		success: function(data_do){
                            if(data_do.total > 0){
                                $('#do_no'+data_do.x).val('');
                                $('#do_no'+data_do.x).focus();
                                sweetAlert('<?=lang('information')?>','DO No '+data_do.do_no+' already exists, please select other DO!');
                                return false;
                            }
                        }
                        
                    });
                }
            }
        }
    }
    
    if(cek_jo != ''){
        sweetAlert('<?=lang('information')?>','Column contents Incomplete, please select JO Number !');
        return false;
    }
    else if(cek_do != ''){
        sweetAlert('<?=lang('information')?>','Column contents Incomplete, please select DO Number !');
        return false;
    }
    else if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                if(clickSave == 0){
                    clickSave++;
                    
                    $.ajax({
                        url : "<?php echo base_url('finances/simpan_ca_realization')?>",
                        type: "POST",
                        data: $('#form').serializeArray(),
                        dataType: "JSON",
                        success: function(result)
                        {                 	            
                            if (result.success){ 
                                $('#modal_form').modal('hide');
                                
                                sweetAlert('<?=lang('information')?>',''+result.msg);   
                                location.replace("<?php echo base_url('finances/'.$this->session->userdata('page_detail'))?>");
                            }else{
                                swal("Oops!", result.msg, "error");
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal("Oops!", "Error saving data", "error");
                            clickSave = 0;
                        }
                        
                    });
                }
                else{
                    alert('<?=lang('data_in_process')?>');
                }  
            }
        });
    } 
}

function save_edit_cash_advance_realization(){
    var validasi="";
    var x=1;
    var totalrowx=parseInt($('#row_id').val());
    for(x=1;x<totalrowx;x++){
        if(document.getElementById('descs'+x)!=null){
            if(document.getElementById('descs'+x).value!=""){
                var descs      =  $('#descs'+x).val();
                var amountCost =  $('#amountCost'+x).val();
                var data1=cekValidasiDetail(descs,'Description',x)
                var data2=cekValidasiDetailangka(amountCost,'Amount',x)
                
                validasi=validasi+data1+data2;
            }else{
                sweetAlert('<?=lang('information')?>','Column contents Incomplete in Cost Details !');
                return false;
            }
            
        }
    }
     
    var cek_jo = '';
    if($('#cash_advance_type_id').val() == '1'){
        for(x=1;x<=totrowDO;x++){
            if(document.getElementById('do_jo_no'+x)!=null){
                if(document.getElementById('do_jo_no'+x).value==""){
                    cek_jo = 'empty';
                }
            }
        }
    }
    
    var cek_do = '';
    if($('#cash_advance_type_id').val() == '1'){
        for(x=1;x<=totrowDO;x++){
            if(document.getElementById('do_no'+x)!=null){
                if(document.getElementById('do_no'+x).value==""){
                    cek_do = 'empty';
                }
                else{
                    $.ajax({
                        url:'<?php echo base_url(); ?>realizations/check_data_do',
                		type: "POST",
                        data: "x="+x+"&do_no="+$('#do_no'+x).val()+'&trx_no='+$('#alloc_no').val()+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
                        dataType:"JSON",
                		success: function(data_do){
                            if(data_do.total > 0){
                                $('#do_no'+data_do.x).val('');
                                $('#do_no'+data_do.x).focus();
                                sweetAlert('<?=lang('information')?>','DO No '+data_do.do_no+' already exists, please select other DO!');
                                return false;
                            }
                        }
                        
                    });
                }
            }
        }
    }
    
    if(cek_jo != ''){
        sweetAlert('<?=lang('information')?>','Column contents Incomplete, please select JO Number !');
        return false;
    }
    else if(cek_do != ''){
        sweetAlert('<?=lang('information')?>','Column contents Incomplete, please select DO Number !');
        return false;
    }
    else if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                if(clickSave == 0){
                    clickSave++;
                    
                    $.ajax({
                        url : "<?php echo base_url('realizations/simpan_ca_realization')?>",
                        type: "POST",
                        data: $('#form').serializeArray(),
                        dataType: "JSON",
                        success: function(result)
                        {                 	            
                            if (result.success){ 
                                $('#modal_form').modal('hide');
                                
                                sweetAlert('<?=lang('information')?>',''+result.msg);   
                                location.replace("<?php echo base_url($this->session->userdata('page_detail'))?>");
                            }else{
                                swal("Oops!", result.msg, "error");
                                clickSave = 0;
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal("Oops!", "Error update data", "error");
                            clickSave = 0;
                        }
                        
                    });  
                }
                else{
                    alert('<?=lang('data_in_process')?>');
                }
            }
        });
    } 
}

/* end Realization Cash Advance */


// Verification Document 

function verification_document_pdf(){
    window.open('<?php echo base_url('verification_document/pdf')?>');
}

function verification_document_verified_pdf(){
    window.open('<?php echo base_url('verification_document_verified/pdf')?>');
}

function verify_document(trx_no,row_id){
    swal({
      title: "Are you sure to verify "+trx_no+" ?",
      //text: "verify this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, verify it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('verification_document/update')?>/" + row_id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                if (data.success){ 
                    sweetAlert('<?=lang('information')?>',''+data.msg);
                    $('#btn_verify_'+row_id).hide();
                    $('#btn_edit_'+row_id).hide();

                    $('#modal_verification_document').modal('hide');
                }else{
                    swal("Oops!", data.msg, "error");
                }

                //location.replace("<?php echo base_url('verification_document')?>");
                
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error verify data", "error");
            }
        });
    });    
}

function unverify_document(trx_no,row_id){
    swal({
      title: "Are you sure to unverify "+trx_no+" ?",
      text: "Please Check JO No, and CO/Driver Commission",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, unverify it!",
      closeOnConfirm: false
    },
    function(){
          $.ajax({
            url : "<?php echo base_url('verification_document/unverify')?>/" + row_id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                if (data.success){ 
                    sweetAlert('<?=lang('information')?>',''+data.msg);   
                }else{
                    swal("Oops!", data.msg, "error");
                }

                location.replace("<?php echo base_url('verification_document_verified')?>");
                
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error verify data", "error");
            }
        });
    });    
}

function show_modal_verify_document(trx_no,row_id){
    $('#modal_verifikasi').modal('show');
    $('#trx_no').val(trx_no);
    $('#row_id').val(row_id);
}

function verify_password_document(){
    $.ajax({
        url : "<?php echo base_url('verification_document/verify_password')?>",
        type: "POST",
        data: $('#form_verify').serializeArray(),
        dataType: "JSON",
        success: function(result)
        {                 	            
            if (result.success){ 
                $('#modal_verifikasi').modal('hide');
        
                sweetAlert('<?=lang('information')?>',''+result.msg);   
                location.replace("<?php echo base_url('verification_document')?>");
                
            }else{
                $('#password').val('');
                $('#password').focus();
                
                swal("Oops!", result.msg, "error");
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error adding / update data", "error");
        }
        
    });  

}

function showDetailDO(do_no){
    $('#modal_detail_do').modal('show');
    
    $.ajax({
        type: "POST",
        url : "<?php echo base_url(); ?>verification_document/detail_do",
    	data: 'do_no='+do_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        cache:false,
        success: function(result){
            
            $('#view_detail_do').html(result);

        },
    	error: function(xhr, status, error) {
    		document.write(xhr.responseText);
    	}
    }); 
}


function showDetailJO(jo_no){
    $('#modal_detail_jo').modal('show');
    
    $.ajax({
        type: "POST",
        url : "<?php echo base_url(); ?>verification_document/detail_jo",
    	data: 'jo_no='+jo_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        cache:false,
        success: function(result){
            
            $('#view_detail_jo').html(result);

        },
    	error: function(xhr, status, error) {
    		document.write(xhr.responseText);
    	}
    }); 
}

function verification_document(trx_no,row_id,vessel_name,destination,item_name){
    $('#modal_verification_document').modal('show');
    $('#btnVerification').attr("onclick","verify_document('"+trx_no+"','"+row_id+"')");
    
    $('#doc_realization_no').html(trx_no);
    $('#doc_realization_amount').html('-');
    $('#doc_nama_supir').html('-');
    $('#doc_police_no').html('-');
    $('#doc_komisi_supir').html('-');
    $('#doc_komisi_kernet').html('-');        
    $('#doc_jo_no').html('-');
    $('#doc_vessel_name').html('-');
    $('#doc_destination').html('-');
    $('#doc_item_name').html('-');
    $('#doc_do_no').html('-');
    $('#doc_qty_container').html('-');
    $('#doc_container_no').html('-');
    $('#doc_container_size').html('-');
    $('#doc_deliver_date').html('-');  
    $('#doc_deliver_weight').html('-');  
    $('#doc_received_date').html('-');
    $('#doc_received_weight').html('-');
    
    $.ajax({
        url:'<?php echo base_url(); ?>verification_document/get_data_detail',
        data: 'row_id='+row_id+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        type: "POST",
        dataType: 'json',
        success: function(data)
        {
            var toDdMmYy = function(input) {
                var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
                if(!input || !input.match(ptrn)) {
                    return null;
                }
                return input.replace(ptrn, '$3-$2-$1');
            };

            $('#doc_realization_no').html(trx_no);
            $('#doc_realization_amount').html('Rp ' + number_format(data.alloc_amt,0,',','.','format'));
            $('#doc_nama_supir').html(data.debtor_name);
            $('#doc_police_no').html(data.police_no);
            $('#doc_komisi_supir').html('Rp ' + number_format(data.komisi_supir,0,',','.','format'));
            $('#doc_komisi_kernet').html('Rp ' + number_format(data.komisi_kernet,0,',','.','format'));
            $('#doc_jo_no').html(data.jo_no);
            if(vessel_name != ''){
                $('#doc_vessel_name').html(vessel_name);
            }
            else{
                $('#doc_vessel_name').html('-');
            }
            
            $('#doc_destination').html(destination);
            $('#doc_item_name').html(item_name);
            $('#doc_do_no').html(data.do_no);
            if(data.container_row_no != 0){
                $('#doc_qty_container').html(data.container_row_no);
            }
            else{
                $('#doc_qty_container').html('-');
            }
            
            if(data.container_no != ''){
                $('#doc_container_no').html(data.container_no);
            }
            else{
                $('#doc_container_no').html('-');
            }
            
            if(data.container_size > 0){
                if(data.container_size == '220')
                    $('#doc_container_size').html(data.count_container + ' x 20 Feet');
                else
                    $('#doc_container_size').html(data.count_container + ' x ' + data.container_size + ' Feet');
            }
            else{
                $('#doc_container_size').html('-');
            }
            
            $('#doc_deliver_date').html(toDdMmYy(data.deliver_date));  
            $('#doc_deliver_weight').html(number_format(data.deliver_weight,0,',','.','format'));  
            $('#doc_received_date').html(toDdMmYy(data.received_date));
            $('#doc_received_weight').html(number_format(data.received_weight,0,',','.','format'));
        }
     });
}

function edit_document(row_id){
    $('#form_edit')[0].reset();
    $('#modal_edit_document').modal('show');
    $('.modal-title-edit').html('Edit Document');
    $('#row_id_edit').val(row_id);
    $('#jo_verify').val('0');

    $.ajax({
        url:'<?php echo base_url(); ?>verification_document/get_data_detail',
        data: 'row_id='+row_id+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        type: "POST",
        dataType: 'json',
        success: function(data)
        {
            var toDdMmYy = function(input) {
                var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
                if(!input || !input.match(ptrn)) {
                    return null;
                }
                return input.replace(ptrn, '$3-$2-$1');
            };
            
            if(data.jo_type == '2'){
                $('.container_field').show();
            }
            else{
                $('.container_field').hide();                
            }
            
            if(data.count_container == '2')
                $('#container_size').val('220');
            else
                $('#container_size').val(data.container_size);
             
            $('#jo_type').val(data.jo_type);
            $('#from_id').val(data.destination_from_rowID);
            $('#to_id').val(data.destination_to_rowID);
            $('#komisi_supir').val(number_format(data.komisi_supir,0,',','.','format'));
            $('#komisi_kernet').val(number_format(data.komisi_kernet,0,',','.','format'));
            $('#jo_no').val(data.jo_no);
            $('#do_no').val(data.do_no);
            $('#container_row_no').val(data.container_row_no);
            $('#container_no').val(data.container_no);
            $('#deliver_date').val(toDdMmYy(data.deliver_date));  
            $('#deliver_weight').val(number_format(data.deliver_weight,0,',','.','format'));  
            $('#received_date').val(toDdMmYy(data.received_date));
            $('#received_weight').val(number_format(data.received_weight,0,',','.','format'));
            
            $('#komisi_supir').attr('readonly',false);
            $('#komisi_kernet').attr('readonly',false);
            $('#do_no').attr('readonly',false);
            $('#container_no').attr('readonly',false);
            $('#container_size').attr('readonly',false);
            $('#button_search').show();
            /*
            $('#deliver_date').attr('readonly',false);
            $('#deliver_weight').attr('readonly',false);
            $('#received_date').attr('readonly',false);
            $('#received_weight').attr('readonly',false);
            */
        }
     });
}

function jo_verification(row_id){
    $('#form_edit')[0].reset();
    $('#modal_edit_document').modal('show');
    $('.modal-title-edit').html('JO Verification');
    $('#row_id_edit').val(row_id);
    $('#jo_verify').val('1');
    
    $.ajax({
        url:'<?php echo base_url(); ?>verification_document_verified/get_data_detail',
        data: 'row_id='+row_id+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        type: "POST",
        dataType: 'json',
        success: function(data)
        {
            var toDdMmYy = function(input) {
                var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
                if(!input || !input.match(ptrn)) {
                    return null;
                }
                return input.replace(ptrn, '$3-$2-$1');
            };
            
            if(data.jo_type == '2'){
                $('.container_field').show();
            }
            else{
                $('.container_field').hide();                
            }
            
            if(data.count_container == '2')
                $('#container_size').val('220');
            else
                $('#container_size').val(data.container_size);
                     
            $('#jo_type').val(data.jo_type);
            $('#from_id').val(data.destination_from_rowID);
            $('#to_id').val(data.destination_to_rowID);
            $('#komisi_supir').val(number_format(data.komisi_supir,0,',','.','format'));
            $('#komisi_kernet').val(number_format(data.komisi_kernet,0,',','.','format'));
            $('#jo_no').val(data.jo_no);
            $('#do_no').val(data.do_no);
            $('#container_row_no').val(data.container_row_no);
            $('#container_no').val(data.container_no);
            $('#deliver_date').val(toDdMmYy(data.deliver_date));  
            $('#deliver_weight').val(number_format(data.deliver_weight,0,',','.','format'));  
            $('#received_date').val(toDdMmYy(data.received_date));
            $('#received_weight').val(number_format(data.received_weight,0,',','.','format'));
            
            $('#komisi_supir').attr('readonly',true);
            $('#komisi_kernet').attr('readonly',true);
            $('#do_no').attr('readonly',true);
            $('#container_no').attr('readonly',true);
            $('#container_size').attr('readonly',true);
            $('#button_search').hide();
            /*
            $('#deliver_date').attr('readonly',true);
            $('#deliver_weight').attr('readonly',true);
            $('#received_date').attr('readonly',true);
            $('#received_weight').attr('readonly',true);
            */
        }
     });
}

function save_update_document(){
    var do_no  = $('#do_no').val();
    var deliver_date = $('#deliver_date').val();
    var deliver_weight = $('#deliver_weight').val();
    var received_date = $('#received_date').val();
    var received_weight = $('#received_weight').val();
    
    var validasi="";
    
    var data1=cekValidasi(do_no,'<?=lang('delivery_order_no')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(deliver_date,'<?=lang('delivery_order_date')?>','<?=lang('not_empty')?>');
    var data3=cekValidasi(deliver_weight,'<?=lang('qty_delivery')?>','<?=lang('not_empty')?>');
    var data4=cekValidasi(received_date,'<?=lang('receipt_date')?>','<?=lang('not_empty')?>');
    var data5=cekValidasi(received_weight,'<?=lang('qty_receipt')?>','<?=lang('not_empty')?>');
    
    validasi=data1+data2+data3+data4+data5;    
    
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                $.ajax({
                    url : "<?php echo base_url('verification_document/update_document')?>",
                    type: "POST",
                    data: $('#form_edit').serializeArray(),
                    dataType: "JSON",
                    success: function(result)
                    {                 	            
                        if (result.success){ 
                            $('#modal_edit_document').modal('hide');
                    
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            location.replace("<?php echo base_url($this->session->userdata('page_detail'))?>");                
                        }
                        else{
                            swal("Oops!", result.msg, "error");
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / update data", "error");
                    }
                    
                });  
            }
        });
    } 
}

function showModalDOVerification(){
    
    $('#modal_select_do_api').modal('show');
        
}

function showModalJOVerification(){
    
    $('#modal_select_jo').modal('show');
    $.ajax({
        type: "POST",
        url : "<?php echo base_url(); ?>verification_document/get_data_jo",
    	data: 'jo_type='+$('#jo_type').val()+'&from_id='+$('#from_id').val()+'&to_id='+$('#to_id').val()+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        dataType:"JSON",
        cache:false,
        success: function(result){
            
            $('#tbl-data-jo').html('');

            var isi_table = '<thead>'+
                                '<th>No</th>' +
                                '<th><?=lang('job_order_no')?></th>' +
        						'<th><?=lang('job_order_debtor')?></th>' +
                                '<th><?=lang('job_order_po_spk_no')?></th>' +
                                '<th><?=lang('job_order_so_no')?></th>' +
                                '<th>From - To</th>' +
                                '<th>JO Type</th>' +
                                '<th>Price Type</th>' +
                                '<th>Item</th>' +
                                '<th><?=lang('port')?></th>' +
                                '<th><?=lang('vessel_name')?> </th>' +
        						'<th><?=lang('job_order_date')?></th>' +
                            '</thead>';
                
            var no = 1;
            $.each(result, function(key, data) {	
                var jo_type = '';
                if(data.jo_type == '1')
                    jo_type = "BULK";
                else if(data.jo_type == '2')
                    jo_type = "CONTAINER";
                else
                    jo_type = "OTHERS";  
                
                var price_type = '';
                if(data.wholesale == 1)
                    price_type = 'All In';
                else 
                    price_type = 'Pcs';
                
                var toDdMmYy = function(input) {
                    var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
                    if(!input || !input.match(ptrn)) {
                        return null;
                    }
                    return input.replace(ptrn, '$3-$2-$1');
                };
                
				isi_table += '<tr onclick="get_data_jo_verification(\''+data.jo_no+'\',\''+data.jo_type+'\')" style="cursor:pointer">'+
                                '<td>'+no+'</td>' +
                                '<td>'+data.jo_no+'</td>' +
                                '<td>'+data.debtor_name+'</td>' +
                                '<td>'+data.po_spk_no+'</td>' +
                                '<td>'+data.so_no+'</td>' +
        						'<td>'+data.destination_from_name+' - '+data.destination_to_name+'</td>' +
        						'<td>'+jo_type+'</td>' +
        						'<td>'+price_type+'</td>' +  
        						'<td>'+data.item_name+'</td>' +  
        						'<td>'+data.port_name+'</td>' +
        						'<td>'+data.vessel_name+'</td>' +  
        						'<td>'+toDdMmYy(data.jo_date)+'</td>' +  
                             '</tr>';
			     no++;
            });  
            
                      
            $('#tbl-data-jo').append(isi_table);   
               
            $('#tbl-data-jo').DataTable().destroy();
            $('#tbl-data-jo').dataTable({
        		"bProcessing": true,
                "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
                "sPaginationType": "full_numbers",
        	});
            
        },
    	error: function(xhr, status, error) {
    		document.write(xhr.responseText);
    	}
    }); 
    
}

function get_data_do_verification(do_no,do_date,qty_deliver,receipt_date,qty_receipt){
        
    $('#do_no').val(do_no);
    $('#deliver_date').val(do_date);
    $('#deliver_weight').val(qty_deliver);
    $('#received_date').val(receipt_date);
    $('#received_weight').val(qty_receipt);
    
    $('#modal_select_do_api').modal('hide');
    
}

function get_data_jo_verification(jo_no,jo_type){
    
    $('#jo_no').val(jo_no);
    
    if(jo_type == '2'){
        $('.container_field').show();
    }
    else{
        $('.container_field').hide();                
    }
    
    $('#modal_select_jo').modal('hide');
    
}

function filterDOVerification(){
    // $.ajax({
    //     type: "POST",
    //     url : "<?php echo base_url(); ?>api.php",
    // 	data: 'type=get_data_do&do_date='+$('#do_date_api').val()+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
    //     dataType:"JSON",
    //     cache:false,
    //     success: function(result){
            
    //         $('#tbl-data-do').html('');

    //         var isi_table = '<thead>'+
    //                             '<th>No</th>' +
    //             				'<th><?=lang('delivery_order_no')?></th>' +
    //             				'<th>Driver Name</th>' +
    //             				'<th>Police No</th>' +
    //             				'<th>Vessel Name</th>' +
    //             				'<th><?=lang('delivery_order_date')?> </th>' +
    //             				'<th><?=lang('qty_delivery')?> </th>' +
    //             				'<th><?=lang('receipt_date')?> </th>' +
    //             				'<th><?=lang('qty_receipt')?> </th>' +
    //                         '</thead>';
                
    //         var no = 1;
    //         $.each(result, function(key, data) {	
                
	// 			isi_table += '<tr onclick="get_data_do_verification(\''+data.do_no+'\',\''+data.str_do_date+'\',\''+
    //                                                         data.qty_deliver+'\',\''+data.str_receipt_date+'\',\''+
    //                                                         data.qty_receipt+'\')" style="cursor:pointer">'+
    //                             '<td>'+no+'</td>' +
    //                             '<td>'+data.do_no+'</td>' +
    //                             '<td>'+data.driver_name+'</td>' +
    //                             '<td>'+data.police_no+'</td>' +
    //                             '<td>'+data.vessel_name+'</td>' +
    //     						'<td>'+data.str_do_date+'</td>' +
    //     						'<td>'+data.qty_deliver+'</td>' +
    //     						'<td>'+data.str_receipt_date+'</td>' +  
    //     						'<td>'+data.qty_receipt+'</td>' +  
    //                          '</tr>';
	// 		     no++;
    //         });  
            
                      
    //         $('#tbl-data-do').append(isi_table);   
               
    //         $('#tbl-data-do').DataTable().destroy();
    //         $('#tbl-data-do').dataTable({
    //     		"bProcessing": true,
    //             "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
    //             "sPaginationType": "full_numbers",
    //     	});
            
    //     },
    // 	error: function(xhr, status, error) {
    // 		document.write(xhr.responseText);
    // 	}
    // }); 
}

// end Verification Document 


// cash_bank_payment 

function add_cash_bank_payment(){
  $('#form')[0].reset(); 
  $('#rowID').val('');
  $('#cb_payment_no').val('');
  $('#prefix').val('');
  $('#year').val('');
  $('#month').val('');
  $('#code').val('');
  $('#advance_invoice_type').val('');
  $('#user_created').val('');
  $('#date_created').val('');
  $('#time_created').val('');
  
  $('#choose_payment').show();
  $('#choose_payment').attr('class','active');
  $('#choose_detail').attr('class','');
  $('#payment_detail').attr('class','tab-pane fade in active');
  $('#cb_detail').attr('class','tab-pane fade');
  
  $('#tamdet').attr('onclick','addRow_cb_detail_payment()');
  
  <?php
    if($this->uri->segment(1) == 'cash_bank_payment'){
        echo "$('#cb_acc').select2();";
    }
  ?>
  
  $('#cb_payment_date_tmp').hide();
  $('#cb_payment_date').show();

  $('#debtor_creditor').show();
  $('#debtor_creditor').select2();
  $('#debtor_creditor_note').hide();
  $('#field_employee_type').hide();
  
  $('.type').html('Payment');
  $('#cash_bank_account').hide();
  $('#choose_cb_detail').show();
  $('#cb_detail').show();
  
  bersihPayment();
  bersihGiro();
  
  $('.modal-title').html('New Cash and Bank (C & B) <span class="type">Payment</span>');
  $('#modal_form').modal('show'); 
}

function cash_bank_payment_pdf(){
    window.open('<?php echo base_url('cash_bank_payment/pdf')?>');
}

function cash_bank_payment_pdf_branch(){
    window.open('<?php echo base_url('cash_bank_payment_branch/pdf')?>');
}

function cash_bank_payment_excel(){
    window.open('<?php echo base_url('cash_bank_payment/excel')?>');
}

function cash_bank_payment_excel_branch(){
    window.open('<?php echo base_url('cash_bank_payment_branch/excel')?>');
}

$('#cb_trx_type').change(function(){
    bersihPayment();
    bersihGiro();  
      
	var trx_type = $('#cb_trx_type').val();
    $('#debtor_creditor').select2('val','');
    
    if(trx_type == 'cash_advance' || trx_type == 'ar' || trx_type == 'ap' || trx_type == 'commission' || trx_type == 'deposit' || trx_type == 'advance' || trx_type == 'reimburse'){
    	$.ajax({
            type: "POST",
            url : "<?php echo base_url('cash_bank_payment/get_debtor'); ?>",
    		data: "trx_type="+trx_type+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
            cache:false,
            success: function(data){
                $('[name="debtor_creditor"]').html(data);
            },
    		error: function(xhr, status, error) {
    			document.write(xhr.responseText);
    			alert(xhr.responseText);
    		}
        }); 
        
        $('#debtor_creditor').show();
        $('#debtor_creditor').select2();
        $('#debtor_creditor').select2('val','');
        $('#debtor_creditor_note').hide();
        $('#debtor_creditor_note').val('');

        $('#employee_type_cb').val('O');
        $('#field_employee_type').hide();
        <?php
            if($this->uri->segment(1) == 'cash_bank_payment'){
                echo "$('#tamdet').attr('onclick','showModalAdvanceInvoiceMultiple()');";
            }
            else{
                echo "$('#tamdet').attr('onclick','addRow_cb_detail_payment()');";
            }
        ?>
        
        
    }
    else if(trx_type == 'general'){
        $('#debtor_creditor').select2('destroy');
        $('#debtor_creditor').hide();
        $('#debtor_creditor').val('');
        $('#debtor_creditor_note').show();
        $('#debtor_creditor_note').val('');
        
        $('#employee_type_cb').val('O');
        $('#field_employee_type').show();        
        $('#tamdet').attr('onclick','addRow_cb_detail_payment()');
    }
    else{
        $('#debtor_creditor').show();
        $('#debtor_creditor').html('<option value=""><?=lang('select_your_option')?></option>');
        $('#debtor_creditor_note').hide();
        $('#debtor_creditor_note').val('');
        $('#debtor_creditor').select2();

        $('#employee_type_cb').val('O');
        $('#field_employee_type').hide();
        $('#tamdet').attr('onclick','addRow_cb_detail_payment()');
    }
    
    if(trx_type == 'cash_advance'){
        $('#advance_invoice_type').val('cash_advance');
    }
    else if(trx_type == 'ar'){
        $('#advance_invoice_type').val('invoice');
    }
    else if(trx_type == 'ap'){
        $('#advance_invoice_type').val('ap');
    }
    else if(trx_type == 'deposit'){
        $('#advance_invoice_type').val('deposit');
    }
    else if(trx_type == 'commission'){
        $('#advance_invoice_type').val('commission');
    }
    else if(trx_type == 'general'){
        $('#advance_invoice_type').val('general');
    }
    else if(trx_type == 'advance'){
        $('#advance_invoice_type').val('advance');
    }
    else if(trx_type == 'reimburse'){
        $('#advance_invoice_type').val('reimburse');
    }
    
}); 	

function showModalAdvanceInvoice(row){
    
    if($('#debtor_creditor').val() != ''){
        $('#row_payment').val(row);
        $('#modalAdvanceInvoice').modal('show'); 
   
        $.ajax({
            type: "POST",
            url : "<?php echo base_url('cash_bank_payment/get_data_advance_invoice'); ?>",
    		data: "id="+$('#debtor_creditor').val()+'&tipe='+$('#advance_invoice_type').val()+'&payment_type='+$('#payment_type').val()+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
            cache:false,
            success: function(data){
                $('#data_advance_invoice').html(data);
                $('#tbl_advance_invoice').DataTable().destroy();
                $('#tbl_advance_invoice').DataTable({
            		"bProcessing": true,
                    "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
                    "sPaginationType": "full_numbers",
            	});
         
            },
    		error: function(xhr, status, error) {
    			document.write(xhr.responseText);
    			alert(xhr.responseText);
    		}
        }); 
    }
    else{
        if($('#advance_invoice_type').val() == 'general'){
            sweetAlert('<?=lang('information')?>','Reference number and amount does not need to be filled');
        }
        else{
            sweetAlert('<?=lang('information')?>','Payment/Receive To Not Empty');
        }
        
    }    
}

function showModalAdvanceInvoiceMultiple(){
    
    if($('#debtor_creditor').val() != ''){
        bersihPayment();
        bersihGiro();
  
        $('#modalAdvanceInvoiceMultiple').modal('show'); 
   
        $.ajax({
            type: "POST",
            url : "<?php echo base_url('cash_bank_payment/get_data_advance_invoice_multiple'); ?>",
    		data: "id="+$('#debtor_creditor').val()+'&tipe='+$('#advance_invoice_type').val()+'&payment_type='+$('#payment_type').val()+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
            cache:false,
            success: function(data){
                $('#data_advance_invoice_multiple').html(data);
                $('#tbl_advance_invoice_multiple').DataTable().destroy();
                $('#tbl_advance_invoice_multiple').DataTable({
            		"bProcessing": true,
                    "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
                    "sPaginationType": "full_numbers",
            	});
         
            },
    		error: function(xhr, status, error) {
    			document.write(xhr.responseText);
    			alert(xhr.responseText);
    		}
        }); 
    }
    else{
        if($('#advance_invoice_type').val() == 'general'){
            sweetAlert('<?=lang('information')?>','Reference number and amount does not need to be filled');
        }
        else{
            sweetAlert('<?=lang('information')?>','Payment/Receive To Not Empty');
        }
        
    }    
}

function get_data_invoice(no,amount){
    var row_payment = $('#row_payment').val();
    var payment_type = $('#payment_type').val();
    
    var amount_tmp = 0;
    if(parseInt(amount) < 0){
        amount_tmp = parseInt(amount) * -1;
    }
    else{
        amount_tmp = parseInt(amount);        
    }
        
    $('#advance_invoice_no'+row_payment).val(no);
    $('#advance_invoice_amount'+row_payment).val(tandaPemisahTitik(amount));
    
    if($('#cb_trx_type').val() == 'reimburse'){
        $('#cb_pay_amount'+row_payment).val(tandaPemisahTitik(amount));
    }
    else{
        $('#cb_pay_amount'+row_payment).val(tandaPemisahTitik(amount_tmp));
    }
    
    
    sumDetailPay(row_payment);
    
    $('#modalAdvanceInvoice').modal('hide'); 
}

function get_data_invoice_chk(no,amount){
    if ($('#chk_cb_'+no).is(':checked',true)) {
        addRow_cb_detail_payment();
                
        var amount_tmp = 0;
        if(parseInt(amount) < 0){
            amount_tmp = parseInt(amount) * -1;
        }
        else{
            amount_tmp = parseInt(amount);        
        }
            
        $('#advance_invoice_no'+totrowPay).val(no);
        $('#advance_invoice_amount'+totrowPay).val(tandaPemisahTitik(amount));
        
        if($('#cb_trx_type').val() == 'reimburse'){
            $('#cb_pay_amount'+totrowPay).val(tandaPemisahTitik(amount));
        }
        else{
            $('#cb_pay_amount'+totrowPay).val(tandaPemisahTitik(amount_tmp));
        }
        
        sumDetailPay(totrowPay);
        
    }
    else{
        hapusBarisPay("rowPay"+totrowPay);
    }
}

function get_data_invoice_ca(no,amount,description){
    var row_payment = $('#row_payment').val();
    var payment_type = $('#payment_type').val();
    
    var amount_tmp = 0;
    if(parseInt(amount) < 0){
        amount_tmp = parseInt(amount) * -1;
    }
    else{
        amount_tmp = parseInt(amount);        
    }
        
    $('#advance_invoice_no'+row_payment).val(no);
    $('#cb_pay_remark'+row_payment).val(description);
    $('#advance_invoice_amount'+row_payment).val(tandaPemisahTitik(amount));
    $('#cb_pay_amount'+row_payment).val(tandaPemisahTitik(amount_tmp));
    
    $('#cb_remark').val(description);
    
    sumDetailPay(row_payment);
    
    $('#modalAdvanceInvoice').modal('hide'); 
}

function get_data_invoice_ca_chk(no,amount,description){
    if ($('#chk_cb_'+no).is(':checked',true)) {
        addRow_cb_detail_payment();
        
        var amount_tmp = 0;
        if(parseInt(amount) < 0){
            amount_tmp = parseInt(amount) * -1;
        }
        else{
            amount_tmp = parseInt(amount);        
        }
            
        $('#advance_invoice_no'+totrowPay).val(no);
        $('#cb_pay_remark'+totrowPay).val(description);
        $('#advance_invoice_amount'+totrowPay).val(tandaPemisahTitik(amount));
        $('#cb_pay_amount'+totrowPay).val(tandaPemisahTitik(amount_tmp));
        
        $('#cb_remark').val(description);
        
        sumDetailPay(totrowPay);
        
    }
    else{
        hapusBarisPay("rowPay"+totrowPay);
    }
}

var totrowGiro=0;
    function addRow_cb_detail_giro(){
        var cb_acc = $('#cb_acc option:selected').val();
        var cb_trx_type = $('#cb_trx_type option:selected').val();
        var cb_amount = $('#cb_amount').val();
        var payment_type = $('#payment_type').val();
        var cb_remark = $('#cb_remark').val();
        var employee_type = $('#employee_type_cb').val();
        var debtor_creditor_note = $('#debtor_creditor_note').val();
        var debtor_creditor = $('#debtor_creditor').val();
        var reference_detail = "";
        var cursor_detail = "";
        var readonly_detail = "";
        var currency_detail = "";
        
        var validasi = "";
        var data1="";
        var payment_type_tmp = '';
        var to_from = '';
        
        if(payment_type == 'P'){
            payment_type_tmp = 'Payment';
            to_from = 'To';
        }
        else{
            payment_type_tmp = 'Receive';          
            //data1=cekValidasi(cb_acc,'Cash & Bank Account','<?=lang('not_empty')?>');
            to_from = 'From';
        }
                
        if(cb_trx_type == 'general'){
            if(employee_type == 'O'){
                payment_to = cekValidasi(debtor_creditor_note,payment_type_tmp+' '+to_from,'<?=lang('not_empty')?>');
            }
            else{
                payment_to = cekValidasi(debtor_creditor,payment_type_tmp+' '+to_from,'<?=lang('not_empty')?>');
            }            
        }
        else{
            payment_to = cekValidasi(debtor_creditor,payment_type_tmp+' '+to_from,'<?=lang('not_empty')?>');
        }
        
        var data2=cekValidasi(cb_trx_type,payment_type_tmp+' Type','<?=lang('not_empty')?>');
        var data3=cekValidasi(cb_amount,'Amount','<?=lang('not_empty')?>'); 
        //var data4=cekValidasi(cb_remark,'Remark','<?=lang('not_empty')?>'); 
        
        validasi=data1+data2+payment_to+data3;//+data4;
        
        if(validasi!=""){
            sweetAlert('<?=lang('information')?>',''+validasi);
            return false;
        }
        else{
            totrowGiro++;
            var detailrow="";
            detailrow=detailrow+"<tr id='rowGiro"+totrowGiro+"'>";

            detailrow=detailrow+"<td>";
            var tombolhapus="<input type='button' style='height:30px;width:30px;border:0px;background-image:url(\"<?= base_url();?>resource/images/delete.png\");background-repeat:no-repeat;' id='hapdet"+totrowGiro+"'   title='Hapus Baris' value='&nbsp;' onclick='hapusBarisGiro(\"rowGiro"+totrowGiro+"\")' />";
            detailrow=detailrow+tombolhapus;
            detailrow=detailrow+"</td>";

            var PaymentMethod="<select class='form-control'  id='payment_method_"+totrowGiro+"' name='detailgiro["+totrowGiro+"][payment_method]' style='height:30px;' /></select>";
    		detailrow=detailrow+"<td>"+PaymentMethod+"</td>";

            var CashBank="<select class='form-control' id='cash_bank_"+totrowGiro+"' name='detailgiro["+totrowGiro+"][cash_bank]' style='height:30px;width:200px;background-color:white;border:solid 1px #ccc;' /></select>";
    		detailrow=detailrow+"<td>"+CashBank+"</td>";
                        
            detailrow=detailrow+"<td >";
            var text1="<input class='form-control'  id='cb_giro_no"+totrowGiro+"' name='detailgiro["+totrowGiro+"][cb_giro_no]'  type='text'  style='text-align:left;background-color:white;border:solid 1px #ccc;'  value=''  />";
            detailrow=detailrow+text1;
            detailrow=detailrow+"</td>";
            
            detailrow=detailrow+"<td >";
            var text2="<input class='form-control' id='cb_giro_date"+totrowGiro+"' name='detailgiro["+totrowGiro+"][cb_giro_date]'  type='text' style='text-align:center;background-color:white;border:solid 1px #ccc;'  value='<?=date('d-m-Y')?>'  />";
            detailrow=detailrow+text2;
            detailrow=detailrow+"</td>";
            
            detailrow=detailrow+"<td >";
            var text3="<input class='form-control' onKeyPress='IsNumeric(this)' onclick=\"sumDetailPay("+totrowPay+");if(this.value!='0'&&this.value!=''){var nilai_tmp1=this.value.replace('.','');var nilai_tmp2=nilai_tmp1.replace('.','');var nilai_tmp=nilai_tmp2.replace('.','');var nilai=nilai_tmp.replace(',','.');this.value=number_format(nilai,2,',','','format');}else{if(this.value==''){this.value='';}}\" onblur=\"if(this.value!='0'&&this.value!=''){var nilai_tmp1=this.value.replace('.','');var nilai_tmp2=nilai_tmp1.replace('.','');var nilai_tmp=nilai_tmp2.replace('.','');var nilai=nilai_tmp.replace(',','.');this.value=number_format(nilai,2,',','.','format');}else{if(this.value.indexOf(',')>0){}else{}}\" onkeyup='sumDetailGiro(\""+totrowGiro+"\");' id='cb_giro_amount"+totrowGiro+"' name='detailgiro["+totrowGiro+"][cb_giro_amount]' type='text' style='text-align:right;background-color:white;border:solid 1px #ccc;'  value=''  />";
            detailrow=detailrow+text3;
            detailrow=detailrow+"</td>";
                        
            detailrow=detailrow+"</tr>";
                    $('#detail_cb_giro tr:last').after(
                        detailrow
            );
            
            $('#cb_giro_date'+totrowGiro).datepicker({
                format: 'dd-mm-yyyy'
            }).on('changeDate',function(ev){
                $('#cb_giro_date'+totrowGiro).datepicker('hide');
        	});
            
            <?php
                if($this->uri->segment(1) == 'cash_bank_payment'){
                    echo "$('#cash_bank_'+totrowGiro).select2();";
                }
            ?>
            
            document.getElementById("payment_method_"+totrowGiro).innerHTML=document.getElementById("cb_payment").innerHTML;
            document.getElementById("cash_bank_"+totrowGiro).innerHTML=document.getElementById("cb_pay_to").innerHTML;
        }
    }
    
    var totrowGiro=0;
    function addRow_cb_detail_giro_release(){
        totrowGiro++;
        var detailrow="";
        detailrow=detailrow+"<tr id='rowGiroRelease"+totrowGiro+"'>";

        detailrow=detailrow+"<td>";
        var nomor_baris=totrowGiro+".";
        detailrow=detailrow+nomor_baris;
        detailrow=detailrow+"</td>";

        var PaymentMethod="<span id='payment_method_release_"+totrowGiro+"'></span>";
		detailrow=detailrow+"<td>"+PaymentMethod+"</td>";

        var CashBank="<span id='cash_bank_release_"+totrowGiro+"'></span>";
		detailrow=detailrow+"<td>"+CashBank+"</td>";
                    
        detailrow=detailrow+"<td>";
        var text1="<span id='cb_giro_no_release_"+totrowGiro+"'></span>";
        detailrow=detailrow+text1;
        detailrow=detailrow+"</td>";
        
        detailrow=detailrow+"<td>";
        var text2="<span id='cb_giro_date_release_"+totrowGiro+"'></span>";
        detailrow=detailrow+text2;
        detailrow=detailrow+"</td>";
        
        detailrow=detailrow+"<td align='right'>";
        var text3="<span id='cb_giro_amount_release_"+totrowGiro+"'></span>";
        detailrow=detailrow+text3;
        detailrow=detailrow+"</td>";
        
        detailrow=detailrow+"<td>";
        var text4="<input type='hidden' id='rowID_release_"+totrowGiro+"' name='detailgirorelease["+totrowGiro+"][rowID_release]' /><select class='form-control' id='cb_release_status_"+totrowGiro+"' name='detailgirorelease["+totrowGiro+"][release_status]' /></select>";
        detailrow=detailrow+text4;
        detailrow=detailrow+"</td>";

        detailrow=detailrow+"<td>";
        var text5="<input type='text' class='form-control input-sm text-center' id='cb_release_date_"+totrowGiro+"' name='detailgirorelease["+totrowGiro+"][cb_release_date]' />";
        detailrow=detailrow+text5;
        detailrow=detailrow+"</td>";
                    
        detailrow=detailrow+"</tr>";
                $('#detail_cb_giro_release tr:last').after(
                    detailrow
        );
        
        $('#cb_release_date_'+totrowGiro).datepicker({
            format: 'dd-mm-yyyy'
        }).on('changeDate',function(ev){
            $('#cb_release_date_'+totrowGiro).datepicker('hide');
    	});
        
        document.getElementById("cb_release_status_"+totrowGiro).innerHTML=document.getElementById("cb_release_status").innerHTML;
    
    }
    
    function hapusBarisGiro(x){
    if(document.getElementById(x)!=null){
        $('#'+x).remove(); 
        //sumDetailGiro(x);
        document.getElementById('TotalGiro').value = 0;
     }
    }
    
    function bersihGiro(){
        var y=totrowGiro+1;
        for(x=0;x<y;x++){
            if(document.getElementById("rowGiro"+x)){
			     hapusBarisGiro("rowGiro"+x);
           }
        }
        totrowGiro=0;
    }
    
    function bersihGiroRelease(){
        var y=totrowGiro+1;
        for(x=0;x<y;x++){
            if(document.getElementById("rowGiroRelease"+x)){
			     hapusBarisGiro("rowGiroRelease"+x);
           }
        }
        totrowGiro=0;
    }
    
    function sumDetailGiro(x){
        var looprows=totrowGiro+1;
        var totNil=0;
        //var cb_amount = parseInt(number_format(document.getElementById('cb_amount').value,0,',','.','deformat'));
        var cb_amount_tmp1 = document.getElementById('cb_amount').value.replace('.','');
        var cb_amount_tmp2 = cb_amount_tmp1.replace('.','');
        var cb_amount_tmp = cb_amount_tmp2.replace('.','');
        var cb_amount = parseFloat(cb_amount_tmp.replace(',','.'));
                    
        for(z=1;z<looprows; z++){  
            if(document.getElementById('cb_giro_amount'+z)!=null  ){
                if(document.getElementById('cb_giro_amount'+z).value!="" ){
                    //var nilai=number_format(document.getElementById('cb_giro_amount'+z).value,0,',','.','deformat');
                    var nilai_tmp1 = document.getElementById('cb_giro_amount'+z).value.replace('.','');
                    var nilai_tmp2 = nilai_tmp1.replace('.','');
                    var nilai_tmp = nilai_tmp2.replace('.','');
                    var nilai =nilai_tmp.replace(',','.');
             
                    totNil += parseFloat(nilai);
                   
                }
            }
        }
        
        if (totNil > cb_amount){
             sweetAlert('<?=lang('information')?>','Total transaction details should not be more than amount!');
             //var amount_tmp = parseInt(number_format(document.getElementById("cb_giro_amount"+x).value,0,',','.','deformat'));
             var amount_tmp21 = document.getElementById("cb_giro_amount"+x).value.replace('.','');
             var amount_tmp22 = amount_tmp21.replace('.','');
             var amount_tmp2 = amount_tmp22.replace('.','');
             var amount_tmp=parseFloat(amount_tmp2.replace(',','.'));
             $("#cb_giro_amount"+x).val('');
             $("#cb_giro_amount"+x).focus();
             
             totNil = totNil - amount_tmp;
        }


        var totalGiro = parseInt(number_format(document.getElementById('TotalGiro').value,2,',','.','deformat'));
        document.getElementById('TotalGiro').value=number_format(totNil,2,',','.','format');
        

    } 
    
    
    var totrowPay=0;
    
    function addRow_cb_detail_payment(){
        var cb_acc = $('#cb_acc option:selected').val();
        var cb_trx_type = $('#cb_trx_type option:selected').val();
        var cb_amount = $('#cb_amount').val();
        var payment_type = $('#payment_type').val();
        var cb_remark = $('#cb_remark').val();
        var employee_type = $('#employee_type_cb').val();
        var debtor_creditor_note = $('#debtor_creditor_note').val();
        var debtor_creditor = $('#debtor_creditor').val();
        var reference_detail = "";
        var cursor_detail = "";
        var readonly_detail = "";
        var currency_detail = "";
        
        var validasi = "";
        var data1="";
        var payment_type_tmp = '';
        var to_from = '';
        
        if(payment_type == 'P'){
            payment_type_tmp = 'Payment';
            to_from = 'To';
        }
        else{
            payment_type_tmp = 'Receive';          
            //data1=cekValidasi(cb_acc,'Cash & Bank Account','<?=lang('not_empty')?>');
            to_from = 'From';
        }
                
        if(cb_trx_type == 'general'){
            if(employee_type == 'O'){
                payment_to = cekValidasi(debtor_creditor_note,payment_type_tmp+' '+to_from,'<?=lang('not_empty')?>');
            }
            else{
                payment_to = cekValidasi(debtor_creditor,payment_type_tmp+' '+to_from,'<?=lang('not_empty')?>');
            }            
        }
        else{
            payment_to = cekValidasi(debtor_creditor,payment_type_tmp+' '+to_from,'<?=lang('not_empty')?>');
        }
        
        var data2=cekValidasi(cb_trx_type,payment_type_tmp+' Type','<?=lang('not_empty')?>');
        var data3=cekValidasi(cb_amount,'Amount','<?=lang('not_empty')?>'); 
        //var data4=cekValidasi(cb_remark,'Remark','<?=lang('not_empty')?>'); 
        
        validasi=data1+data2+payment_to+data3;//+data4;
        
        if(validasi!=""){
            sweetAlert('<?=lang('information')?>',''+validasi);
            return false;
        }
        else{
            totrowPay++;

            if(cb_trx_type == 'general'){
                reference_detail = "";
                cursor_detail = "";
                readonly_detail = "";
                currency_detail = "";//"currency_decimal";
            }
            else{
                reference_detail = "onclick='showModalAdvanceInvoice("+totrowPay+")' readonly";                                
                cursor_detail = "cursor:pointer;";
                readonly_detail = "readonly";                
                currency_detail = "";
            }

            var detailrow="";
            detailrow=detailrow+"<tr id='rowPay"+totrowPay+"'>";

            detailrow=detailrow+"<td>";
            var tombolhapus="<input type='button' style='height:30px;width:30px;border:0px;background-image:url(\"<?= base_url();?>resource/images/delete.png\");background-repeat:no-repeat;' id='hapdet"+totrowPay+"'   title='Hapus Baris' value='&nbsp;' onclick='hapusBarisPay(\"rowPay"+totrowPay+"\")' />";
            detailrow=detailrow+tombolhapus;
            detailrow=detailrow+"</td>";
            
            detailrow=detailrow+"<td >";
            var text1="<input class='form-control'  id='no"+totrowPay+"' name='detailPay["+totrowPay+"][no]'  type='text'  style='text-align:center;background-color:white;border:solid 1px #ccc;'  value='"+totrowPay+"'  />";
            detailrow=detailrow+text1;
            detailrow=detailrow+"</td>";
            
            detailrow=detailrow+"<td >";
            var advance_invoice_no="<input class='form-control' id='advance_invoice_no"+totrowPay+"' name='detailPay["+totrowPay+"][advance_invoice_no]'  type='text' style='text-align:left;background-color:white;border:solid 1px #ccc;"+cursor_detail+"' value='' placeholder='Select reference no' "+reference_detail+" />";
            detailrow=detailrow+advance_invoice_no;
            detailrow=detailrow+"</td>";
            
            detailrow=detailrow+"<td >";
            var text2="<textarea class='form-control' id='cb_pay_remark"+totrowPay+"' name='detailPay["+totrowPay+"][cb_pay_remark]' style='text-align:left;background-color:white;border:solid 1px #ccc;' rows='2' ></textarea>";
            detailrow=detailrow+text2;
            detailrow=detailrow+"</td>";
            
            detailrow=detailrow+"<td >";
            var advance_invoice_amount="<input class='form-control "+currency_detail+"' onKeyPress='IsNumeric(this)' onclick=\"sumDetailPay("+totrowPay+");if(this.value!='0'&&this.value!=''){var nilai_tmp1=this.value.replace('.','');var nilai_tmp2=nilai_tmp1.replace('.','');var nilai_tmp=nilai_tmp2.replace('.','');var nilai=nilai_tmp.replace(',','.');this.value=number_format(nilai,2,',','','format');}else{if(this.value==''){this.value='';}}\" onblur=\"if(this.value!='0'&&this.value!=''){var nilai_tmp1=this.value.replace('.','');var nilai_tmp2=nilai_tmp1.replace('.','');var nilai_tmp=nilai_tmp2.replace('.','');var nilai=nilai_tmp.replace(',','.');this.value=number_format(nilai,2,',','.','format');}else{if(this.value.indexOf(',')>0){}else{}}\" id='advance_invoice_amount"+totrowPay+"' name='detailPay["+totrowPay+"][advance_invoice_amount]'  type='text' style='text-align:right;background-color:white;border:solid 1px #ccc;'  value='' "+readonly_detail+" />";
            detailrow=detailrow+advance_invoice_amount;
            detailrow=detailrow+"</td>";
            
            detailrow=detailrow+"<td >";
            var text3="<input class='form-control' onKeyPress='IsNumeric(this)' onclick=\"sumDetailPay("+totrowPay+");if(this.value!='0'&&this.value!=''){var nilai_tmp1=this.value.replace('.','');var nilai_tmp2=nilai_tmp1.replace('.','');var nilai_tmp=nilai_tmp2.replace('.','');var nilai=nilai_tmp.replace(',','.');this.value=number_format(nilai,2,',','','format');}else{if(this.value==''){this.value='';}}\" onblur=\"if(this.value!='0'&&this.value!=''){var nilai_tmp1=this.value.replace('.','');var nilai_tmp2=nilai_tmp1.replace('.','');var nilai_tmp=nilai_tmp2.replace('.','');var nilai=nilai_tmp.replace(',','.');this.value=number_format(nilai,2,',','.','format');}else{if(this.value.indexOf(',')>0){}else{}}\" onkeyup='sumDetailPay(\""+totrowPay+"\");' id='cb_pay_amount"+totrowPay+"' name='detailPay["+totrowPay+"][cb_pay_amount]'  type='text' style='text-align:right;background-color:white;border:solid 1px #ccc;'  value=''  />";
            detailrow=detailrow+text3;                                            
            var text4="<input class='form-control' onKeyPress='IsNumeric(this)' onclick=\"sumDetailPay("+totrowPay+");if(this.value!='0'&&this.value!=''){var nilai_tmp1=this.value.replace('.','');var nilai_tmp2=nilai_tmp1.replace('.','');var nilai_tmp=nilai_tmp2.replace('.','');var nilai=nilai_tmp.replace(',','.');this.value=number_format(nilai,2,',','','format');}else{if(this.value==''){this.value='';}}\" onblur=\"if(this.value!='0'&&this.value!=''){var nilai_tmp1=this.value.replace('.','');var nilai_tmp2=nilai_tmp1.replace('.','');var nilai_tmp=nilai_tmp2.replace('.','');var nilai=nilai_tmp.replace(',','.');this.value=number_format(nilai,2,',','.','format');}else{if(this.value.indexOf(',')>0){}else{}}\" onkeyup='sumDetailPay(\""+totrowPay+"\");' id='cb_pay_amount_tmp"+totrowPay+"' name='detailPay["+totrowPay+"][cb_pay_amount_tmp]'  type='hidden' style='text-align:right;background-color:white;border:solid 1px #ccc;'  value=''  />";
            detailrow=detailrow+text4;
            detailrow=detailrow+"</td>";
                        
            detailrow=detailrow+"</tr>";
                    $('#detail_cb_payment tr:last').after(
                        detailrow
            );
        }  
    }
    
    function hapusBarisPay(x){
        if(document.getElementById(x)!=null){
            $('#'+x).remove(); 
            sumDetailPay(x);
        }
    }
    
    
    function bersihPayment(){
        var y=totrowPay+1;
        for(x=0;x<y;x++){
            if(document.getElementById("rowPay"+x)){
			     hapusBarisPay("rowPay"+x);
           }
        }
        totrowPay=0;
    }
    
    function sumDetailPay(x){
        var looprows=totrowPay+1;
        var totNil=0;

        for(z=1;z<looprows; z++){  
            if(document.getElementById('cb_pay_amount'+z)!=null  ){
                if(document.getElementById('cb_pay_amount'+z).value!="" ){
                    //var nilai=number_format(document.getElementById('cb_pay_amount'+z).value,2,',','.','deformat');
                    var nilai_tmp1=document.getElementById('cb_pay_amount'+z).value.replace('.','');
                    var nilai_tmp2=nilai_tmp1.replace('.','');
                    var nilai_tmp=nilai_tmp2.replace('.','');
                    var nilai=nilai_tmp.replace(',','.');
                    totNil +=parseFloat(nilai);
                }
            }
        }
        document.getElementById('TotalPayment').value=number_format(totNil,2,',','.','format');
        document.getElementById('cb_amount').value=number_format(totNil,2,',','.','format');
    } 
    
function simpan_cash_bank_payment(){
    var cb_acc = $('#cb_acc option:selected').val();
    var cb_trx_type = $('#cb_trx_type option:selected').val();
    var cb_amount = $('#cb_amount').val();
    var TotalGiro = $('#TotalGiro').val();
    var payment_type = $('#payment_type').val();
    var cb_remark = $('#cb_remark').val();
    var employee_type = $('#employee_type_cb').val();
    var debtor_creditor_note = $('#debtor_creditor_note').val();
    var debtor_creditor = $('#debtor_creditor').val();
    
    var status_total_ca = "";
    if(cb_trx_type == "cash_advance"){
        var cb_amount_tmp = number_format(cb_amount,0,',','.','deformat');
        var TotalGiro_tmp = number_format(TotalGiro,0,',','.','deformat');
        if(cb_amount_tmp != TotalGiro_tmp){
            status_total_ca = cekValidasi("","Total transaction must be same",'');
        }
    }
    
    var validasi = "";
    var data1 = "";
    var payment_type_tmp = "";
    var to_form = "";
    var payment_to = "";
    var payment_detail = "";
    var cash_detail = "";
    var payment_detail_val = "";
    var cash_detail_val = "";
    
    if(payment_type == 'P'){
        payment_type_tmp = 'Payment';
        to_form = 'To';
    }
    else if(payment_type == 'R'){
        payment_type_tmp = 'Receive';  
        to_form = 'From';
        //data1=cekValidasi(cb_acc,'Cash & Bank Account','<?=lang('not_empty')?>');
    }
    
    if(cb_trx_type == 'general'){
        if(employee_type == 'O'){
            payment_to = cekValidasi(debtor_creditor_note,payment_type_tmp+' '+to_form,'<?=lang('not_empty')?>');
        }
        else{
            payment_to = cekValidasi(debtor_creditor,payment_type_tmp+' '+to_form,'<?=lang('not_empty')?>');
        }
    }
    else{
        payment_to = cekValidasi(debtor_creditor,payment_type_tmp+' '+to_form,'<?=lang('not_empty')?>');
    }
    
    var looprows=totrowPay+1;
    var looprows_cash=totrowGiro+1;
    
    for(z=1;z<looprows; z++){  
        if(document.getElementById('cb_pay_amount'+z)!=null  ){
            if(document.getElementById('cb_pay_amount'+z).value!="" ){
                payment_detail_val = "ada";
            }
            else{
                payment_detail_val = "";
                break;
            }
        }
    }
    
    for(z=1;z<looprows_cash; z++){  
        if(document.getElementById('cb_giro_amount'+z)!=null  ){
            if(document.getElementById('cb_giro_amount'+z).value!="" ){
                cash_detail_val = "ada";
            }
            else{
                cash_detail_val = "";
                break;
            }
        }
    }
      
    payment_detail=cekValidasi(payment_detail_val,payment_type_tmp+' Detail','Not complete');   
    cash_detail=cekValidasi(cash_detail_val,'Cash & Bank Detail','Not complete');   
     
    var data2=cekValidasi(cb_trx_type,payment_type_tmp+' Type','<?=lang('not_empty')?>');
    var data3=cekValidasi(cb_amount,'Amount','<?=lang('not_empty')?>'); 
    var data4=cekValidasi(cb_remark,'Remark','<?=lang('not_empty')?>'); 
    
    validasi = data1+data2+payment_to+data3+data4+payment_detail+cash_detail+status_total_ca;
    
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                if(clickSave == 0){
                    clickSave++;
                    
                    $.ajax({
                        <?php
                            if($this->uri->segment(1) == 'cash_bank_payment'){
                                echo 'url : "'.base_url('cash_bank_payment/simpan_cash_bank_payment').'",';
                            }
                            else{
                                echo 'url : "'.base_url('cash_bank_payment_branch/simpan_cash_bank_payment').'",';
                            }
                        ?>
                        type: "POST",
                        data: $('#form').serializeArray(),
                        dataType: "JSON",
                        success: function(result)
                        {
                            if (result.success){ 
                                $('#modal_form').modal('hide');
                                
                                sweetAlert('<?=lang('information')?>',''+result.msg);   
                                <?php
                                    if($this->uri->segment(1) == 'cash_bank_payment'){
                                        echo 'location.replace("'.base_url('cash_bank_payment').'");';
                                    }
                                    else{
                                        echo 'location.replace("'.base_url('cash_bank_payment_branch').'");';                                    
                                    }
                                ?>
    
                            }else{
                                swal("Oops!", result.msg, "error"); 
                                clickSave = 0;
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal("Oops!", "Error adding / update data", "error");
                            clickSave = 0;
                        }
                        
                    });  
                }
                else{
                    alert('<?=lang('data_in_process')?>');
                }
            }
        });
    } 
}   

function simpan_cash_bank_payment_release(){
    sweetAlert({
      title: "Are you sure?",
      text: "Are you want to Save?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#286090",
      confirmButtonText: "Yes, Save !",
      closeOnConfirm: true,
      html: false
    },function(r){ 
        if (r){
            if(clickSave == 0){
                clickSave++;
                
                $.ajax({
                    url : "<?php echo base_url('cash_bank_payment/simpan_cash_bank_payment_release')?>",
                    type: "POST",
                    data: $('#form_release').serializeArray(),
                    dataType: "JSON",
                    success: function(result)
                    {
                        if (result.success){ 
                            $('#modal_form_release').modal('hide');
                            
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            <?php
                                if($this->uri->segment(1) == 'cash_bank_payment'){
                                    echo 'location.replace("'.base_url('cash_bank_payment').'");';
                                }
                                else{
                                    echo 'location.replace("'.base_url('cash_bank_payment_branch').'");';                                    
                                }
                            ?>

                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error saving data", "error");
                        clickSave = 0;
                    }
                    
                });  
            }
            else{
                alert('<?=lang('data_in_process')?>');
            }
        }
    });
}

function edit_cash_bank_payment(prefix,year,month,code){
    bersihPayment();
    bersihGiro();
    $('#cb_acc').select2(); 
    $('#tamdet').attr('onclick','addRow_cb_detail_payment()');
    
    $.ajax({
        url:'<?php echo base_url(); ?>cash_bank_payment/get_data_cash_bank?prefix='+prefix+'&year='+year+'&month='+month+'&code='+code,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {
              var toMmDdYy = function(input) {
                var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
                if(!input || !input.match(ptrn)) {
                    return null;
                }
                return input.replace(ptrn, '$3-$2-$1');
              };
              
              if(data.transaction_type == 'cash_advance' || data.transaction_type == 'ar' || data.transaction_type == 'ap' || data.transaction_type == 'commission'
              || data.transaction_type == 'deposit' || data.transaction_type == 'advance' || data.transaction_type == 'reimburse'){
                
                $('#debtor_creditor').show();
                $('#debtor_creditor').select2();
                $('#debtor_creditor_note').hide();
                $('#field_employee_type').hide();
              }
              else{
                $('#debtor_creditor').select2('destroy');
                $('#debtor_creditor').hide();
                $('#debtor_creditor_note').show();
                $('#field_employee_type').show();
              }
              
              $('#rowID').val(data.rowID);
              $('#prefix').val(data.prefix);
              $('#year').val(data.year);  
              $('#month').val(data.month);  
              $('#code').val(data.code);
              $('#user_created').val(data.user_created);
              $('#date_created').val(data.date_created);
              $('#time_created').val(data.time_created);
            
              $('#cb_payment_no').val(data.trx_no);
              $('#cb_payment_date').val(toMmDdYy(data.trx_date));
              $('#cb_payment_date_tmp').val(toMmDdYy(data.trx_date));
              $('#payment_type').val(data.payment_type);
              $('#cb_trx_type').val(data.transaction_type);
              $('#cb_acc').select2('val',data.coa_rowID);
              $('#cb_remark').val(data.descs);
              
              var trx_amt = 0;
              if(data.trx_amt > 0){
                trx_amt = data.trx_amt;
              }
              else{
                trx_amt = data.trx_amt * -1;
              }
              
              $('#cb_amount').val(number_format(trx_amt,2,',','.','format'));
              //$('[name="cb_pay_to"]').val(data.fund_trf_coa_rowID);
              
              $('#employee_type_cb').val(data.manual_debtor_creditor_type);            
              $('#debtor_creditor_note').val(data.manual_debtor_creditor);
             
              
              if(data.transaction_type == 'general'){
                  if(data.manual_debtor_creditor_type == 'D' || data.manual_debtor_creditor_type == 'E'){  
                    $.ajax({
                        type: "POST",
                        url : "<?php echo base_url('cash_bank_payment/get_data_debtor'); ?>",
                		data: "employee_type="+data.manual_debtor_creditor_type+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
                        cache:false,
                        success: function(result){
                            $('#debtor_creditor').html(result);
                            $('#debtor_creditor').select2('val',data.debtor_creditor_rowID);
                        },
                		error: function(xhr, status, error) {
                			document.write(xhr.responseText);
                			alert(xhr.responseText);
                		}
                    }); 
                    $('#debtor_creditor').show();
                    $('#debtor_creditor').select2();
                    $('#debtor_creditor_note').hide();
                  }
                  else{
                    $('#debtor_creditor').select2('destroy');
                    $('#debtor_creditor').hide();
                    $('#debtor_creditor_note').show();
                  }
              }   
              else{
                $.ajax({
                    type: "POST",
                    url : "<?php echo base_url('cash_bank_payment/get_debtor'); ?>",
            		data: "trx_type="+data.transaction_type+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
                    cache:false,
                    success: function(result){
                        $('#debtor_creditor').html(result);
                        $('#debtor_creditor').select2('val',data.debtor_creditor_rowID);
                    },
            		error: function(xhr, status, error) {
            			document.write(xhr.responseText);
            			alert(xhr.responseText);
            		}
                });
                
              }           

              if(data.transaction_type == 'cash_advance'){
                $('#advance_invoice_type').val('cash_advance');
              }
              else if(data.transaction_type == 'ar'){
                $('#advance_invoice_type').val('invoice');
              }
              else if(data.transaction_type == 'ap'){
                $('#advance_invoice_type').val('ap');
              }
              else if(data.transaction_type == 'deposit'){
                $('#advance_invoice_type').val('deposit');
              }
              else if(data.transaction_type == 'commission'){
                $('#advance_invoice_type').val('commission');
              }
              else if(data.transaction_type == 'advance'){
                $('#advance_invoice_type').val('advance');
              }
              else if(data.transaction_type == 'reimburse'){
                $('#advance_invoice_type').val('reimburse');
              }
              else{
                $('#advance_invoice_type').val('general');
              }
    
              $('.modal-title').html('Edit Cash and Bank (C & B) <span class="type">Payment</span>');   
              
              if(data.payment_type == 'P'){
                    $('#cash_bank_account').hide();
                    $('.type').html('Payment');
                    $('.to_from').html('To');
                    $('.to_from_cash_bank').html('From');
              }
              else{
                    $('#cash_bank_account').hide();
                    $('.type').html('Receive');        
                    $('.to_from').html('From');
                    $('.to_from_cash_bank').html('To');
              }
              
              $('#cb_payment_date_tmp').show();
              $('#cb_payment_date').hide();
              /*
              $('#choose_payment').show();
              $('#choose_payment').attr('class','active');
              $('#payment_detail').show();              
              $('#payment_detail').attr('class','tab-pane fade in active');
              $('#choose_detail').attr('class','');
              $('#cb_detail').attr('class','tab-pane fade in');
              $('#choose_deduction').attr('class','');
              $('#deduction_detail').attr('class','tab-pane fade in');              
              */
              showDetailPayment(data.prefix,data.year,data.month,data.code);
              showDetailGiro(data.prefix,data.year,data.month,data.code);
                
              $('#modal_form').modal('show'); 
              
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error adding / update data", "error");
        }
    });
} 

function release_cash_bank_payment(prefix,year,month,code){
    bersihGiroRelease();
    
    $.ajax({
        url:'<?php echo base_url(); ?>cash_bank_payment/get_data_cash_bank?prefix='+prefix+'&year='+year+'&month='+month+'&code='+code,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {     
              var toMmDdYy = function(input) {
                var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
                if(!input || !input.match(ptrn)) {
                    return null;
                }
                return input.replace(ptrn, '$3-$2-$1');
              };
              
              var payment_type = "";
              if(data.payment_type == 'P'){
                $('.type').html('Payment');
                payment_type = 'Payment';
              }
              else{
                $('.type').html('Receive');  
                payment_type = 'Receive';
              }
              
              var advance_invoice_type = '';
              if(data.transaction_type == 'cash_advance'){
                advance_invoice_type = 'Cash Advance';
              }
              else if(data.transaction_type == 'ar'){
                advance_invoice_type = 'Invoice';
              }
              else if(data.transaction_type == 'ap'){
                advance_invoice_type = 'Account Payable';
              }
              else if(data.transaction_type == 'deposit'){
                advance_invoice_type = 'Deposit';
              }
              else if(data.transaction_type == 'commission'){
                advance_invoice_type = 'Commission';
              }
              else{
                advance_invoice_type = 'General';
              }
              
              $('#val_cb_payment_no_release').val(data.trx_no);
              $('#val_cb_payment_id_release').val(data.rowID);
              $('#val_cb_payment_type').val(data.payment_type);
              
              $('#cb_payment_no_release').html(data.trx_no);
              $('#cb_payment_date_release').html(toMmDdYy(data.trx_date));
              $('#payment_type_release').html(payment_type);
              $('#cb_trx_type_release').html(advance_invoice_type);              
                
              showDetailGiroRelease(data.prefix,data.year,data.month,data.code);
                
              $('#modal_form_release').modal('show'); 
              
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error getting data", "error");
        }
    });
} 

function showDetailGiro(prefix,year,month,code){
bersihGiro();
    $.ajax({
	type: "GET",
		
        url:'<?php echo base_url(); ?>cash_bank_payment/showDetailGiro?prefix='+prefix+'&year='+year+'&month='+month+'&code='+code,
		dataType:"JSON",
		success: function(result){
		var x=0;
        var total   = 0;
		$.each(result, function(key, val) {	
		x++;
		addRow_cb_detail_giro();            
            $('#payment_method_'+x).val(val.payment_method);
            $('#cash_bank_'+x).select2('val',val.cash_bank);
            $('#cb_giro_no'+x).val(val.cg_no);
            $('#cb_giro_date'+x).val(val.cg_date);
            $('#cb_giro_amount'+x).val(number_format(val.cg_amt,2,',','.','format'));
            if(document.getElementById('cb_giro_amount'+x)!=null  ){
                if(document.getElementById('cb_giro_amount'+x).value!="" ){
                    //var nilai=number_format(document.getElementById('cb_giro_amount'+x).value,0,',','.','deformat');
                    var nilai_tmp1=document.getElementById('cb_giro_amount'+x).value.replace('.','');
                    var nilai_tmp2=nilai_tmp1.replace('.','');
                    var nilai_tmp=nilai_tmp2.replace('.','');
                    var nilai = nilai_tmp.replace(',','.');
                    total +=parseFloat(nilai);
	            }
            }
            $('#cash_bank_'+x).select2();
  	     });
         $('#TotalGiro').val(number_format(total,2,',','.','format'));
        }
        
   });

}

function showDetailGiroRelease(prefix,year,month,code){
bersihGiroRelease();
    $.ajax({
	    type: "GET",
        url:'<?php echo base_url(); ?>cash_bank_payment/showDetailGiroRelease?prefix='+prefix+'&year='+year+'&month='+month+'&code='+code,
		dataType:"JSON",
		success: function(result){
		  var x=0;
          
          $.each(result, function(key, val) {	
		    x++;
            addRow_cb_detail_giro_release();            
            $('#payment_method_release_'+x).html(val.payment_method);
            $('#cash_bank_release_'+x).html(val.acc_name);
            $('#cb_giro_no_release_'+x).html(val.cg_no);
            $('#cb_giro_date_release_'+x).html(val.cg_date);
            $('#cb_giro_amount_release_'+x).html(number_format(val.cg_amt,2,',','.','format'));
            $('#cb_release_status_'+x).val(val.status);
            $('#cb_release_date_'+x).val('<?=date('d-m-Y')?>');
            $('#rowID_release_'+x).val(val.rowID);
  	     });
        }
        
   });

}

function showDetailPayment(prefix,year,month,code){
    
$.ajax({
	type: "GET",
        url:'<?php echo base_url(); ?>cash_bank_payment/showDetailPayment?prefix='+prefix+'&year='+year+'&month='+month+'&code='+code,
		dataType:"JSON",
		success: function(result){
		var x=0;
        var total   = 0;
		$.each(result, function(key, val) {	
    		x++;
    		addRow_cb_detail_payment();
            $('#no'+x).val(val.row_no);
            $('#advance_invoice_no'+x).val(val.advance_invoice_no);
            $('#advance_invoice_type'+x).val(val.advance_invoice_type);
            $('#advance_invoice_amount'+x).val(number_format(val.advance_invoice_amount,2,',','.','format'));
            $('#cb_pay_remark'+x).val(val.descs);
            
            var trx_amount = 0;
            if(parseInt(val.trx_amt) < 0){
                if($('#cb_trx_type').val() == 'reimburse'){
                    trx_amount = parseFloat(val.trx_amt);
                }
                else{                    
                    trx_amount = parseFloat(val.trx_amt) * -1;
                }
            }
            else{
                trx_amount = parseFloat(val.trx_amt);
            }
            
            $('#cb_pay_amount'+x).val(number_format(trx_amount,2,',','.','format'));
            $('#cb_pay_amount_tmp'+x).val(number_format(trx_amount,2,',','.','format'));
            
            if(document.getElementById('cb_pay_amount'+x)!=null  ){
                if(document.getElementById('cb_pay_amount'+x).value!="" ){                    
                    //var nilai=number_format(document.getElementById('cb_pay_amount'+x).value,2,',','.','deformat');
                    var nilai_tmp1 = document.getElementById('cb_pay_amount'+x).value.replace('.','');
                    var nilai_tmp2 = nilai_tmp1.replace('.','');
                    var nilai_tmp = nilai_tmp2.replace('.','');
                    var nilai = nilai_tmp.replace(',','.');
                    total +=parseFloat(nilai);
        	    }
            }
  	     });
         
         if(x == 0){
            $('#choose_payment').hide();
            $('#choose_payment').attr('class','');
            $('#choose_detail').attr('class','active');
            $('#payment_detail').attr('class','tab-pane fade');
            $('#cb_detail').attr('class','tab-pane fade in active');
         }
         else{
            $('#choose_payment').show();
            $('#choose_payment').attr('class','active');
            $('#choose_detail').attr('class','');
            $('#payment_detail').attr('class','tab-pane fade in active');
            $('#cb_detail').attr('class','tab-pane fade');
         }
         
         $('#TotalPayment').val(number_format(total,2,',','.','format'));
        }
        
   });

}


function delete_cash_bank_payment(prefix,year,month,code){
     swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url:'<?php echo base_url(); ?>cash_bank_payment/delete_data?prefix='+prefix+'&year='+year+'&month='+month+'&code='+code,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               if(data.success){
                   swal("Deleted!", data.msg, "success");
                   $('#modal_form').modal('hide');
                   <?php
                        if($this->uri->segment(1) == 'cash_bank_payment'){
                            echo 'location.replace("'.base_url('cash_bank_payment').'");';
                        }
                        else{
                            echo 'location.replace("'.base_url('cash_bank_payment_branch').'");';                                    
                        }
                   ?>                
               }
               else{
                    swal("Oops!", data.msg, "error");
               }               
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });   
}

function print_cash_bank_payment_branch(prefix,year,month,code){
    window.open('<?php echo base_url()?>cash_bank_payment_branch/print_cash_bank_payment_branch?prefix='+prefix+'&year='+year+'&month='+month+'&code='+code);
}

function print_cash_bank_payment(prefix,year,month,code){
    window.open('<?php echo base_url()?>cash_bank_payment/print_cash_bank_payment?prefix='+prefix+'&year='+year+'&month='+month+'&code='+code);
}

function print_release_bank_payment(prefix,year,month,code){
    window.open('<?php echo base_url()?>cash_bank_payment/print_release_bank_payment?prefix='+prefix+'&year='+year+'&month='+month+'&code='+code);
}

$('#payment_type').change(function(){
    var type = $('#payment_type').val();
    if(type == 'P'){
        $('.type').html('Payment');
        $('#cash_bank_account').hide();
        $('.to_from').html('To');
        $('.to_from_cash_bank').html('From');
    }
    else{
        $('.type').html('Receive');        
        $('#cash_bank_account').hide();
        $('.to_from').html('From');
        $('.to_from_cash_bank').html('To');
    }

    bersihPayment();
    bersihGiro();

});

function change_employee_type_cb(){
    var type = $('#employee_type_cb').val();
    if(type == 'D' || type == 'E'){        
        $.ajax({
            type: "POST",
            url : "<?php echo base_url('cash_bank_payment/get_data_debtor'); ?>",
    		data: "employee_type="+type+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
            cache:false,
            success: function(data){
                $('#debtor_creditor').html(data);
            },
    		error: function(xhr, status, error) {
    			document.write(xhr.responseText);
    			alert(xhr.responseText);
    		}
        });  

        $('#debtor_creditor').show();
        $('#debtor_creditor').select2();
        $('#debtor_creditor').select2('val','');
        $('#debtor_creditor_note').hide();
        $('#debtor_creditor_note').val('');
    }
    else{
        $('#debtor_creditor').select2('destroy');
        $('#debtor_creditor').hide();
        $('#debtor_creditor').val('');
        $('#debtor_creditor_note').show();
        $('#debtor_creditor_note').val('');
    }   
}


// -------end cash Bank payment--

// -------cash Advance -
function add_cash_advance(){
  //cash_advance_type_change();  
  $('#form_create_ca')[0].reset(); 
  $('#modal_create_ca').modal('show');   
  $('.modal-job-ca').html('<?=lang('new')?> <?=lang('cash_advance')?>');
  
  $('#btnVerifyCashAdvance').hide();
  $('#btnSaveCashAdvance').show();
  $('#driver2').val('');
  $('#queue_id').val('');
  $('#vehicle').select2();   
  $('#vehicle').select2('val','');   
  $('#cash_advance_type2').select2('val','');   
  
}

function save_cash_advance(){
    var cash_advance_type2 =$('#cash_advance_type2 option:selected').val();
    var driver2           =$('#driver2').val();
    var amount            =$('#amount').val();
    var vehicle           =$('#vehicle option:selected').val(); 
    var fare_trip         =$('#fare_trip').val();
    var barcode_no        =$('#barcode_no').val(); 
    
    var validasi = "";
    
    if(cash_advance_type2 == '1'){
        var data1=cekValidasi(cash_advance_type2,'<?=lang('cash_advance_type')?>','<?=lang('not_empty')?>');
        var data2=cekValidasi(vehicle,'<?=lang('vehicle')?>','<?=lang('not_empty')?>'); 
        var data3=cekValidasi(driver2,'<?=lang('employee')?>/<?=lang('driver')?>','<?=lang('not_empty')?>'); 
        var data4=cekValidasi(amount,'<?=lang('amount')?>','<?=lang('not_empty')?>');
        var data5=cekValidasi(fare_trip,'<?=lang('fare_trip')?>','<?=lang('not_empty')?>');
        validasi=data1+data2+data3+data4+data5;
    }
    else{
        var data1=cekValidasi(cash_advance_type2,'<?=lang('cash_advance_type')?>','<?=lang('not_empty')?>');
        var data2=cekValidasi(driver2,'<?=lang('employee')?>/<?=lang('driver')?>','<?=lang('not_empty')?>'); 
        var data3=cekValidasi(amount,'<?=lang('amount')?>','<?=lang('not_empty')?>');
        //var data4=cekValidasi(barcode_no,'<?=lang('barcode')?>','<?=lang('not_empty')?>');
        validasi=data1+data2+data3;//+data4;
    }
      
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                if(clickSave == 0){
                    clickSave++;
                    
                    $.ajax({
                        url : "<?php echo base_url('finances/simpan_cash_advance')?>",
                        type: "POST",
                        data: $('#form_create_ca').serializeArray(),
                        dataType: "JSON",
                        success: function(result)
                        {                 	            
                            if (result.success){ 
                                $('#modal_form').modal('hide');
                                
                                sweetAlert('<?=lang('information')?>',''+result.msg);   
                                location.replace("<?php echo base_url('finances/'.$this->session->userdata('page_detail'))?>");
                            }else{
                                sweetAlert('<?=lang('information')?>',''+result.msg); 
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal("Oops!", "Error saving data", "error");
                            clickSave = 0;
                        }
                        
                    });
                    
                }
                else{
                    alert('<?=lang('data_in_process')?>');
                }
            }
        });
    } 
}

function cash_advance_type_change(){
    $("#cash_advance_type2").change(function(){
  	/*
      	$('#fare_trip').empty();
		$('#fare_trip').append('<option value="0">Select Fare Trip</option>');
		$('#fare_trip').val('0');		
		$('#fare_trip').prop("disabled", true);
		$("#fare_trip").select2();
		$('#fare_trip_dtl').empty();
		$('#vehicle').empty();
		$('#vehicle').append('<option value="0">Select Vehicle</option>');
		$('#vehicle').val('0');
		$('#vehicle').prop("disabled", true);		
		$("#vehicle").select2();
		$('#vehicle_category').empty();
		$('#vehicle_category').append('<option value="0">Select Vehicle Category</option>');
		$('#vehicle_category').val('0');
		$('#vehicle_category').prop("disabled", true);		
		$("#vehicle_category").select2();
		$('#driver').empty();
		$('#driver').append('<option value="0">Select Employee/Driver</option>');
		$('#driver').val('0');
		$('#driver').prop("disabled", true);
		$("#driver").select2();		
		*/
		var text_orginal=$(this).val();
		var text_length=text_orginal.length;
		var cash_advance_type = text_orginal.substr(0,text_length-1);
		var fare_trip_status = text_orginal.slice(-1);
       
        if(cash_advance_type!=0){
            if(fare_trip_status!='N'){
                getDetaFareTrip();
                getDataVehicle();
                getDataVehicleCategory();
                getDataDriver();
            }else{
                getDataEmployee();
            }
            
        }
        vehicle_click();
        vehicle_category_click();
        $('#split_status').val('0');
    });
}

$("#cash_advance_type2").change(function(){
    if($("#cash_advance_type2").val() == '1'){
        $('#amount').attr('readonly',true);
        $('#btn_search_fare_trip').show();        
    }
    else{
        $('#amount').attr('readonly',false);        
        $('#btn_search_fare_trip').hide();

        $('#cash_advance_desc').val('');        
        $('#cash_advance_desc').attr('readonly',false);
        
        $('#fare_trip').val('');
        $('#fare_trip_tmp').val('');
        $('#fare_trip_dtl').val('');
        $('#vehicle_category').val('');
        $('#vehicle_category_tmp').val('');
        $('#amount').val(0);
    
    }
    $('#split_status').val('0');
    $('#co_driver_field').hide();
    $('#co_driver_rowID').select2('val','');
});

function CancelLoad(advance_no)
{
    swal({
      title: "Are you sure?",
      text: "Cancel Load this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, Cancel Load it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('finances/cancel_load/')?>/" + advance_no,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               
               swal("cancel loaded!", "Data has been cancel load.", "success");
               location.replace("<?php echo base_url('finances/cash_advance_list')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error cancel load data", "error");
            }
        });
    });

}

function memo_ca(advance_no){
    $('#modal_memo').modal('show');
    $('#memo_advance_no').val(advance_no);
    $('#memo_ca_no').html(advance_no);
    
    $.ajax({
        
		type: "GET",
		url : "<?php echo base_url(''); ?>/finances/get_memo/"+advance_no,
		dataType: 'json',
		success: function(data){
            obj = data;
            
            $('#tbl-memo').html('');

            var isi_table = '<thead>'+
                                '<th width="10%">No</th>' +
                				'<th width="30%">Date</th>' +
                				'<th width="60%">Description</th>' +
                            '</thead>';
            var no = 1;
			if (obj.length > 0) {          
                $.each(obj, function (index, data) {
    				isi_table += '<tr>'+
                                    '<td>'+ (no++) +'</td>' +
            						'<td>'+data.memo_date+'</td>' +
            						'<td>'+data.memo_description+'</td>' +
                                 '</tr>';
    			});  
            }
                        
            $('#tbl-memo').append(isi_table);
            
            $('#tbl-memo').DataTable().destroy();
            $('#tbl-memo').dataTable({"aaSorting": [[0, 'asc']],
        		"bProcessing": true,
                "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
                "sPaginationType": "full_numbers",
        	});
		},
		error: function(xhr, status, error) {
			  
			document.write(xhr.responseText);
			//alert(xhr.responseText);
		}
	});
}

function create_memo(){
    var memo_description = $('#memo_description').val();
    
    var validasi = "";
    
    var data1=cekValidasi(memo_description,'Description','<?=lang('not_empty')?>');
    validasi=data1;
      
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to save Memo ?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('finances/save_memo')?>",
                    type: "POST",
                    data: $('#form_memo').serializeArray(),
                    dataType: "JSON",
                    success: function(result)
                    {                 	            
                        if (result.success){ 
                            $('#modal_memo').modal('hide');
                            
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            location.replace("<?php echo base_url('finances/'.$this->session->userdata('page_detail'))?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / update data", "error");
                    }
                    
                });  
            }
        });
    } 
}

function show_photo_ca(file_name,debtor_name){
    $('#modal_view_photo').modal('show');  
    
    $('#driver_name_photo').html(debtor_name);  
    $('#personal_photo').attr('src','<?=base_url()?>/resource/images/debtor_photo/'+file_name);
}

function search_fare_trip(){
    var date_ca = $('#date_ca').val();
    $('#form_create_ca')[0].reset(); 
    
    $('#date_ca').val(date_ca);
    
    $('#btnVerifyCashAdvance').hide();
    $('#btnSaveCashAdvance').show();
    $('#driver2').val('');
    $('#queue_id').val('');
    $('#split_status').val('0');
    $('#vehicle').select2();   
    $('#vehicle').select2('val','');   
    $('#cash_advance_type2').select2('val','1');   

    $.ajax({
		type: "POST",
		url : "<?php echo base_url('finances/get_detail_all_faretrip'); ?>",
		data: '<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        cache:false,
		dataType: 'json',
		success: function(data){
            obj = data;
            
            $('#tbl-fare_trip').html('');

            var isi_table = '<thead>'+
                                '<th><?=lang('fare_trip_code')?> </th>' +
                				'<th><?=lang('fare_trip_destination_from')?> </th>' +
                				'<th><?=lang('fare_trip_destination_to')?> </th>' +
                				'<th><?=lang('trip_condition')?> </th>' +
                				'<th><?=lang('fare_trip_distance')?> </th>' +
                				'<th><?=lang('trip_type')?> </th>' +
                				'<th><?=lang('vehicle')?> </th>' +
                				'<th><?=lang('cost')?> </th>' +
                				'<th>Split </th>' +
                				'<th><?=lang('total')?> (Rp)</th>' +
                            '</thead>';
                            
			if (obj.length > 0) {          
                $.each(obj, function (index, data) {
                    var split = '-';
                    if(data.split == 1){
                        split = 'Yes';
                    }
                    else{
                        split = 'No';
                    }
                    
    				isi_table += '<tr onclick="get_fare_trip(\''+data.fare_trip_id+'\',\''+data.fare_trip_cd+'\',\''+
                                                                data.fare_trip_desc+'\',\''+data.vehicle_type_id+'\',\''+
                                                                data.type_name+'\',\''+data.vehicle_type+'\',\''+
                                                                data.trip_condition+'\',\''+data.total+'\',\''+data.split+'\',\''+
                                                                data.min_amount+'\',\''+data.os_amount+'\')" style="cursor:pointer">'+
                                    '<td>'+data.fare_trip_cd+'</td>' +
            						'<td>'+data.destination_from+'</td>' +
            						'<td>'+data.destination_to+'</td>' +
            						'<td>'+data.trip_condition+'</td>' +  
            						'<td>'+data.distance+'</td>' +  
                                    '<td>'+data.trip_type+'</td>' +
            						'<td>'+data.type_name+'</td>' +  
                                    '<td>'+data.descs+'</td>' +
            						'<td>'+split+'</td>' +  
            						'<td align="right">'+data.total+'</td>' +  
                                 '</tr>';
    			});  
            }
                        
            $('#tbl-fare_trip').append(isi_table);
            $('#modal_fare_trip').modal('show');  
            $('.modal-title-faretrip').text('<?=lang('select').' '.lang('fare_trip')?>');
            
            $('#tbl-fare_trip').DataTable().destroy();
            $('#tbl-fare_trip').dataTable({"aaSorting": [[0, 'asc']],
        		"bProcessing": true,
                "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
                "sPaginationType": "full_numbers",
        	});
		},
		error: function(xhr, status, error) {
			  
			document.write(xhr.responseText);
			//alert(xhr.responseText);
		}
	});
    
}

function search_driver(){
    if($("#cash_advance_type2").val() == '1'){
        $('#modal_driver').modal('show');
        $('.modal-title-queue').text('<?=lang('queue').' '.lang('driver')?>');

        $('#tbl-driver').DataTable().destroy();
            
        $('#tbl-driver').dataTable({
    		"bProcessing": true,
            "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            "sPaginationType": "full_numbers",
    	});	
    }
    else{
        $('#modal_employee_driver').modal('show');
        $('.modal-title-employee').text('<?=lang('select').' '.lang('employee').'/'.lang('driver')?>');

        $('#tbl-employee-driver').DataTable().destroy();
            
        $('#tbl-employee-driver').dataTable({
    		"bProcessing": true,
            "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            "sPaginationType": "full_numbers",
    	});	
    }    
    
}

function get_fare_trip(fare_trip_id,fare_trip_name,fare_trip_desc,vehicle_type_id,vehicle_type_name,vehicle_type,trip_condition,amount,split,min_amount,os_amount){
    $('#fare_trip').val(fare_trip_id);
    $('#fare_trip_tmp').val(fare_trip_name);
    $('#fare_trip_dtl').val(fare_trip_desc);
    $('#vehicle_category').val(vehicle_type_id);
    $('#vehicle_category_tmp').val(vehicle_type_name);
    $('#split_status').val(split);
    if(split == 1){
        $('#amount').val(min_amount);   
    }
    else{
        $('#amount').val(amount);        
    }
    
    if(trip_condition == 'LONG DISTANCE'){
        $('#cash_advance_desc').val('Pemberian uang di muka sebesar Rp '+ min_amount +', sisa pelunasan sebesar Rp '+ os_amount +' dilakukan di tujuan.');
        //$('#cash_advance_desc').attr('readonly',true);
        $('#co_driver_field').show();
        $('#co_driver_rowID').select2();
        $('#co_driver_rowID').select2('val','');
    }
    else{
        $('#cash_advance_desc').val('');        
        //$('#cash_advance_desc').attr('readonly',false);
        $('#co_driver_field').hide();
        $('#co_driver_rowID').select2('val','');
    }
        
    $.ajax({
        type: "POST",
        url : "<?php echo base_url('finances/get_data_vehicle'); ?>",
		data: "vehicle_type="+vehicle_type+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        cache:false,
        success: function(data){
            $('#vehicle').html(data);
        },
		error: function(xhr, status, error) {
			document.write(xhr.responseText);
			alert(xhr.responseText);
		}
    });
    
    $('#modal_fare_trip').modal('hide');  
}

function get_driver(queue_id,driver_id,driver_name,vehicle_id,already){
    if(already != ''){
        $('#btnSaveCashAdvance').hide();
        $('#btnVerifyCashAdvance').show();
        $('#queue_id_verify').val(queue_id);
        alert('<?=lang('already_absent')?>');    
    }
    else{
        $('#btnSaveCashAdvance').show();
        $('#btnVerifyCashAdvance').hide();
    }
    
    $('#queue_id').val(queue_id);
    $('#driver2').val(driver_id);
    $('#driver2_tmp').val(driver_name);
    $('#vehicle').select2('val',vehicle_id);
    
    $('#vehicle').attr('disabled',false); 
    
    $('#modal_driver').modal('hide');
    $('#modal_employee_driver').modal('hide');
}

function show_modal_verify(){
    $('#modal_verifikasi').modal('show');
}

function verify_password(){
    $.ajax({
        url : "<?php echo base_url('finances/verify_password')?>",
        type: "POST",
        data: $('#form_verify').serializeArray(),
        dataType: "JSON",
        success: function(result)
        {                 	            
            if (result.success){ 
                $('#modal_verifikasi').modal('hide');
                $('#btnSaveCashAdvance').show();
                $('#btnVerifyCashAdvance').hide();
        
                sweetAlert('<?=lang('information')?>',''+result.msg);   
                
            }else{
                $('#password').val('');
                $('#password').focus();
                
                sweetAlert('<?=lang('information')?>',''+result.msg); 
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error adding / update data", "error");
        }
        
    });  

}

function getDetaFareTrip(){
	     $.ajax({
			type: "POST",
			url : "<?php echo base_url('finances/get_detail_faretrip'); ?>",
			data: '<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
            cache:false,
			dataType: 'json',
			success: function(msg){	
					obj = msg;
					if (obj.length > 0) {
						$.each(obj, function (index, msg) {                
							valor = msg.rowID;
							texto = msg.fare_trip_no;
							$('#fare_trip').append('<option value=' + valor + '>' + texto + '</option>');
							$('#fare_trip').prop("readonly", false); 
						});   
						$('#fare_trip').prop("disabled", false);
						$('#fare_trip').select2();
						$('#fare_trip').val(0).trigger("change"); //.trigger("change"); 
						
					}else{
						$('#fare_trip').empty();
						$('#fare_trip').append('<option value="0">Select Fare Trip</option>');
						$('#fare_trip').val(0).trigger("change");
						$('#fare_trip').prop("disabled", false);
					} 

			},
			error: function(xhr, status, error) {
				  
				document.write(xhr.responseText);
				//alert(xhr.responseText);
			}
		});

}


function getDataVehicle(){
        //vehicle
        $.ajax({
        type: "POST",
        url : "<?php echo base_url('finances/get_detail_vehicle'); ?>",
        data: '<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        cache:false,
        dataType: 'json',
        success: function(msg){	
        		obj = msg;
        		if (obj.length > 1) {
        			$.each(obj, function (index, msg) {                
        				valor = msg.rowID;
        				texto = msg.police_no;
        				$('#vehicle').append('<option value=' + valor + '>' + texto + '</option>');
        				$('#vehicle').prop("readonly", false); 
        			});   
        			$('#vehicle').prop("disabled", false);
        			$('#vehicle').select2();
        			$('#vehicle').select2('val',0).trigger("change"); //.trigger("change"); 
        			
        		}else{
        			$('#vehicle').select2();
        			$('#vehicle').empty();
        			$('#vehicle').append('<option value="0">Select Vehicle</option>');
        			$('#vehicle').select2('val',0).trigger("change");
        			$('#vehicle').prop("disabled", false);
        		} 
        
        },
        error: function(xhr, status, error) {
        	  
        	document.write(xhr.responseText);
        	//alert(xhr.responseText);
        }
        });

}

function getDataVehicleCategory(){
    //vehicle catagories
	$.ajax({
		type: "POST",
		url : "<?php echo base_url('finances/get_detail_vehicle_category'); ?>",
		data: '<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        cache:false,
		dataType: 'json',
		success: function(msg){	
				obj = msg;
				if (obj.length > 1) {
					$.each(obj, function (index, msg) {                
						valor = msg.rowID;
						texto = msg.type_cd;
						texto_1 = msg.type_name;
						$('#vehicle_category').append('<option value=' + valor + '>' + texto + '-' + texto_1 + '</option>');
						$('#vehicle_category').prop("readonly", false); 
					});   
					$('#vehicle_category').prop("disabled", false);
					$('#vehicle_category').select2();
                    $('#vehicle_category').val(0).trigger("change"); //.trigger("change"); 
					
				}else{
					$('#vehicle_category').empty();
					$('#vehicle_category').append('<option value="0">Select Vehicle Category</option>');
					$('#vehicle_category').val(0).trigger("change");
					$('#vehicle_category').prop("disabled", false);
				} 

		},
		error: function(xhr, status, error) {
			  
			document.write(xhr.responseText);
			//alert(xhr.responseText);
		}
	});
}

function getDataDriver(){
    $.ajax({
    	type: "POST",
    	url : "<?php echo base_url('finances/get_detail_driver'); ?>",
    	data: '<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        cache:false,
    	dataType: 'json',
    	success: function(msg){	
    			obj = msg;
    			if (obj.length > 1) {
                    var option_value = '';						
    				$.each(obj, function (index, msg) {                
    					valor = msg.rowID;
    					texto = msg.name;
    					option_value += '<option value=' + valor + '>' + texto + '</option>';
    					$('#driver2').prop("readonly", false); 
    				});   
                    $('#driver2').html(option_value);
    				$('#driver2').prop("disabled", false);
    				$('#driver2').select2();
    				$('#driver2').val(0).trigger("change"); //.trigger("change"); 
    				
    			}else{
    				$('#driver2').empty();
    				$('#driver2').append('<option value="0">Select Employee/Driver</option>');
    				$('#driver2').val(0).trigger("change");
    				$('#driver2').prop("disabled", false);
    			} 
    
    	},
    	error: function(xhr, status, error) {
    		  
    		document.write(xhr.responseText);
    		//alert(xhr.responseText);
    	}
    });	

}

function getDataEmployee(){
//get Employee
		$.ajax({
			type: "POST",
			url : "<?php echo base_url('finances/get_detail_employee'); ?>",
			data: '<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
            cache:false,
			dataType: 'json',
			success: function(msg){	
					obj = msg;
					
					if (obj.length > 1) {
                        var option_value = '';
						$.each(obj, function (index, msg) {                
							valor = msg.rowID;
							texto = msg.name;
							option_value += '<option value=' + valor + '>' + texto + '</option>';
							$('#driver2').prop("readonly", false); 
						});
                        $('#driver2').html(option_value);
                        $('#driver2').prop("disabled", false);
						$('#driver2').select2();
						$('#driver2').val(0).trigger("change"); //.trigger("change"); 
						
					}else{
						$('#driver2').empty();
						$('#driver2').html('<option value="0">Select Employee/Driver</option>');
						$('#driver2').val(0).trigger("change");
						$('#driver2').prop("disabled", false);
					} 

			},
			error: function(xhr, status, error) {
				  
				document.write(xhr.responseText);
				//alert(xhr.responseText);
			}
		});
	
}

function vehicle_click(){
    $("#vehicle").click(function(){
		var fare_trip_rowID=$('#fare_trip').val();		
		var rowID=$('#vehicle').val();
		if (fare_trip_rowID!=0){					
					$.ajax({
						type: "POST",
						url : "<?php echo base_url('vehicle/get_vehicle_details'); ?>",
						data: "rowID="+rowID+"&fare_trip_rowID="+fare_trip_rowID+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
						cache:false,
						dataType: 'json',
						success: function(msg){	
								obj = msg;
								if (obj.length > 0) {
									$.each(obj, function (index, msg) { 
											$('#driver2').prop("disabled", false);
											$('#vehicle_category').select2();
											$('#vehicle_category').val(msg.vehicle_type_rowID).trigger("change");//.trigger("change"); 
											$('#driver2').select2();
											$('#driver2').val(msg.debtor_rowID).trigger("change"); //.trigger("change");
											$('#amount').val(number_format(msg.fare_trip_amounts,0,',','.','format'));
											$('#amount').select();
											$('#amount').focus();	
									}); 
									
								}else{
											$('#vehicle_category').select2();
											$('#vehicle_category').val(0).trigger("change");//.trigger("change"); 
											$('#driver2').select2();
											$('#driver2').val(0).trigger("change"); //.trigger("change"); 
								} 

						},
						error: function(xhr, status, error) {
							  
							document.write(xhr.responseText);
							alert(xhr.responseText);
						}
					});
		}else{
			//alert('Choose Fare Trip First');
            swal("Oops!", "Choose Fare Trip First", "error");
            $('#fare_trip').select2();
			$('#fare_trip').val(0).trigger("change");//.trigger("change"); 
			$('#fare_trip').focus(); $('#vehicle').select2();
			$('#vehicle').val(0).trigger("change");//.trigger("change"); 
			
		}
	});


}


function vehicle_category_click(){
   
   $("#vehicle_category").click(function(){
		var fare_trip_rowID=$('#fare_trip').val();		
		var rowID=$('#vehicle').val();
		var vehicle_type_rowID=$('#vehicle_category').val();
		if (fare_trip_rowID!=0 && rowID!=0){					
			$.ajax({
				type: "POST",
				url : "<?php echo base_url('vehicle/get_vehicle_type_details'); ?>",
				data: "rowID="+rowID+"&fare_trip_rowID="+fare_trip_rowID+"&vehicle_type_rowID="+vehicle_type_rowID+
                        '&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
				cache:false,
				dataType: 'json',
				success: function(msg){	
						obj = msg;
						if (obj.length > 0) {
							$.each(obj, function (index, msg) { 
								$('#driver2').prop("disabled", false);
								$('#vehicle_category').select2();
								$('#vehicle_category').val(msg.vehicle_type_rowID).trigger("change");//.trigger("change"); 
								$('#driver2').select2();
								$('#driver2').val(msg.debtor_rowID).trigger("change"); //.trigger("change");
								$('#amount').val(number_format(msg.fare_trip_amounts,0,',','.','format'));
								$('#amount').select();
								$('#amount').focus();	
							}); 
						}else{
									$('#vehicle_category').select2();
									$('#vehicle_category').val(0).trigger("change");//.trigger("change"); 
									$('#driver').select2();
									$('#driver').val(0).trigger("change"); //.trigger("change"); 
						} 

				},
				error: function(xhr, status, error) {
					document.write(xhr.responseText);
					alert(xhr.responseText);
				}
			});
		}else{
			//alert('Choose Fare Trip & Vehicle First');
            swal("Oops!", "Choose Fare Trip First", "error");
			$('#fare_trip').select2();
			$('#fare_trip').val(0).trigger("change");//.trigger("change"); 
			$('#fare_trip').focus(); 
			$('#vehicle').select2();
			$('#vehicle').val(0).trigger("change");//.trigger("change"); 
			
		}
	});

}


// ------- End Cash Advance -----


// ------- Invoices -----

function add_invoice(){
  $('#form')[0].reset();   
  $('#modal_form').modal('show');  
  $('.modal-title').text('New Invoice');  
  $('#debtor_id').select2();
  
  document.getElementById("btnCancel").style.cssFloat="right";
  document.getElementById("btnSave").style.display="block";
  document.getElementById("btnSave").style.cssFloat="right";
  document.getElementById("btnUpdate").style.display="none";
  document.getElementById("btnDelete").style.display="none";
  document.getElementById("btnCancel").style.margin="0px 3px 3px 3px";
  document.getElementById("btnSave").style.margin="0px 3px 3px 3px";
  document.getElementById("btnUpdate").style.margin="0px 3px 3px 3px";
  document.getElementById("btnDelete").style.margin="0px 3px 3px 3px";
  bersihDetailInvo();
  addRowDetailInvoice();
  $('#job_order').hide();
  $('#choose_delivery').hide();  
  $('#delivery_order').hide();  
  $('#choose_invoice').prop("class","active");  
  $('#invoice_detail').show();  
  $('#cekDa').prop('disabled',false);
  $('#tamdetInvoice').show();  
  $('#invoice_type').attr('readonly',false);
  $('#debtor_id').attr('readonly',false);
  $('#invoice_type').attr('disabled',false);
  $('#debtor_id').attr('disabled',false);
  $('#invoice_date').attr('readonly',false);
  $('#invoice_date').show();
  $('#invoice_date_tmp').hide();
  $('#invoice_remark_header').prop("readOnly",false);
 
  $('#tamdetInvoice').prop('disabled',false);

  $('#row_id').val('');
  $('#user_created').val('');
  $('#date_created').val('');
  $('#time_created').val('');

  bersihDO_AP();
  $('#tamdet').show();
  $('#data_do').show();
  $('#data_do_manual').hide();
  $('#btnEmptyDO').hide();

}

function reprint_invoice(trx_no){
    window.open('<?php echo base_url('invoice/print_invoice')?>/'+trx_no);
}

$("#choose_delivery").click(function(){
    $('#delivery_order').show();  
    $('#invoice_detail').hide();      
    $('#choose_invoice').prop("class","");  
});

$("#choose_invoice").click(function(){
    $('#delivery_order').hide();  
    $('#invoice_detail').show();      
    $('#choose_delivery').prop("class","");  
});

$("#invoice_type").change(function(){
  var invoice_type = $('#invoice_type').val();
  bersihDetailInvo();
  addRowDetailInvoice();
      
  if (invoice_type == 'J'){
      $('#job_order').show();
      $('#amount_invo1').prop('readonly',true);
      $('#hapdetInvoice1').hide();
      $('#jo_no').attr('onclick','ambil_job_order()');
    
    
      $('#data_do').html('');
      $('#data_do').show();
      $('#data_do_manual').hide();
      $('#jo_no').val('');
      $('#jo_year').val('');
      $('#jo_month').val('');
      $('#jo_code').val('');
      bersihDO_AP();
      
      //$('#choose_delivery').show();  
      //$('#delivery_order').show();  
      //$('#invoice_detail').hide();  
  }  
  else if (invoice_type == 'A'){
      $('#amount_invo1').prop('readonly',true);
      $('#hapdetInvoice1').hide();
      $('#job_order').show();
      $('#jo_no').attr('onclick','ambil_ap()');
      
      $('#choose_delivery').hide();  
      $('#delivery_order').hide();  
      $('#invoice_detail').show();  
      $('#choose_delivery').prop("class",""); 
      $('#choose_invoice').prop("class","active"); 
      
      $('#data_do').html('');
      $('#data_do').show();
      $('#data_do_manual').hide();
      $('#jo_no').val('');
      $('#jo_year').val('');
      $('#jo_month').val('');
      $('#jo_code').val('');
      
  }
  else{
      
      if($('#invoice_type').val() != 'M'){
        $('#amount_invo1').prop('readonly',true);          
      }
      else{
        $('#amount_invo1').prop('readonly',false);
      }
      
      $('#hapdetInvoice1').hide();
      $('#job_order').show();
      $('#jo_no').attr('onclick','selectJO_AP_For_Invoice()');

      $('#choose_delivery').show();  
      $('#choose_delivery').prop("class","active"); 
      $('#choose_invoice').prop("class",""); 
      $('#delivery_order').show();  
      $('#invoice_detail').hide();  
      
      $('#data_do').html('');
      $('#data_do').hide();
      $('#data_do_manual').show();
      $('#jo_no').val('');
      $('#jo_year').val('');
      $('#jo_month').val('');
      $('#jo_code').val('');
      //$('#amount_invo1').val(0);   
      
      $('#tamdet').hide();
      bersihDO_AP();
            
      autoTax("1");
  }
    
});

function empty_do_invoice(){
    sweetAlert({
      title: "Are you sure?",
      text: "Are you want to empty data DO ?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#286090",
      confirmButtonText: "Yes, Save !",
      closeOnConfirm: true,
      html: false
    },function(r){ 
        if (r){
              $.ajax({
                url : "<?php echo base_url('invoice/empty_do')?>",
                type: "POST",
                dataType: 'json',
                data:{
                    'invoice_no' : $('#invoice_no').val(),
                    'jo_no' : $('#jo_no').val(),
                    '<?=$this->security->get_csrf_token_name()?>' : '<?=$this->security->get_csrf_hash()?>'
                },
                success: function(data)
                {
                    sweetAlert('<?=lang('information')?>',''+data.msg); 
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    swal("Oops!", "Error empty data do", "error");
                }
            });
        }
    });
}

function verify_invoice(trx_no,row_id){
    swal({
      title: "Are you sure to verify "+trx_no+" ?",
      //text: "verify this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, verify it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('invoice/verify_invoice')?>/" + row_id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                if (data.success){ 
                    sweetAlert('<?=lang('information')?>',''+data.msg);   
                }else{
                    swal("Oops!", data.msg, "error");
                }

                location.replace("<?php echo base_url('invoice')?>");
                
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error verify data", "error");
            }
        });
    });    
}

function unverify_invoice(trx_no,row_id){
    swal({
      title: "Are you sure to unverify "+trx_no+" ?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, unverify it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('invoice/unverify_invoice')?>/" + row_id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                if (data.success){ 
                    sweetAlert('<?=lang('information')?>',''+data.msg);   
                }else{
                    swal("Oops!", data.msg, "error");
                }

                location.replace("<?php echo base_url('invoice')?>");
                
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error unverify data", "error");
            }
        });
    });    
}

function receipt_invoice(prefix,year,month,code){
    $.ajax({
        url:'<?php echo base_url(); ?>invoice/get_data_invoice?prefix='+prefix+'&year='+year+'&month='+month+'&code='+code,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {
              var toMmDdYy = function(input) {
                var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
                if(!input || !input.match(ptrn)) {
                    return null;
                }
                return input.replace(ptrn, '$3-$2-$1');
              }; 
              
              $('#invoice_receipt_no').val(data.trx_no);
              $('#received_date').val(toMmDdYy(data.received_date)); 
              $('#received_no').val(data.received_no);
              $('#due_date').val(toMmDdYy(data.due_date)); 
              
              $('#modal_receipt').modal('show');               
               
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error getting data", "error");
        }
    }); 
}

function edit_invoice(prefix,year,month,code){
    $('#tamdet').show();
    $('#btnEmptyDO').show();

    $('#data_do').html('');
        
    $.ajax({
        url:'<?php echo base_url(); ?>invoice/get_data_invoice?prefix='+prefix+'&year='+year+'&month='+month+'&code='+code,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {
              var toMmDdYy = function(input) {
                var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
                if(!input || !input.match(ptrn)) {
                    return null;
                }
                return input.replace(ptrn, '$3-$2-$1');
              }; 
              
              $('#row_id').val(data.rowID);
              $('#prefix').val(data.prefix);
              $('#year').val(data.year);  
              $('#month').val(data.month);  
              $('#code').val(data.code);
              
              $('#invoice_date').val(toMmDdYy(data.trx_date)); 
              $('#invoice_date_tmp').val(toMmDdYy(data.trx_date)); 
              $('#invoice_no').val(data.trx_no);
              $('#debtor_id').val(data.debtor_rowID);
              $('#debtor_id_tmp').val(data.debtor_rowID);
              $('#invoice_type').val(data.invoice_type);
              $('#invoice_remark_header').val(data.descs);
              $('#jo_year').val(data.tr_jo_trx_hdr_year);
              $('#jo_month').val(data.tr_jo_trx_hdr_month);
              $('#jo_code').val(data.tr_jo_trx_hdr_code);
              $('#jo_no').val(data.jo_no);
              $('#gl_trx_hdr_prefix').val(data.gl_trx_hdr_prefix);
              $('#gl_trx_hdr_year').val(data.gl_trx_hdr_year);
              $('#gl_trx_hdr_month').val(data.gl_trx_hdr_month);
              $('#gl_trx_hdr_code').val(data.gl_trx_hdr_code);
              $('#gl_trx_hdr_trx_no').val(data.gl_trx_hdr_trx_no);
              $('#user_created').val(data.user_created);
              $('#date_created').val(data.date_created);
              $('#time_created').val(data.time_created);
              $('#invoice_receipt_no').val(data.trx_no);
              $('#received_date_val').val(toMmDdYy(data.received_date)); 
              $('#received_no_val').val(data.received_no);
              $('#due_date_val').val(toMmDdYy(data.due_date)); 
              
              $('#invoice_remark_header').prop("readOnly",false);
              $("#invoice_date").prop("readOnly",true);
                
              if(data.tax == 1){
                document.getElementById('cekDa').checked = true;
              }
              else{
                document.getElementById('cekDa').checked = false;                
              }
              
              showDetailInvoice(data.prefix,data.year,data.month,data.code,'edit');    
              
              
              if (data.invoice_type == 'A'){
                $('#choose_delivery').show();  
                $('#delivery_order').show();
                $('#choose_delivery').click();
                $('#choose_delivery').prop("class","active");  
                $('#job_order').show();
                $('#jo_no').attr('onclick','ambil_ap()');

                $('#data_do').show();      
                $('#data_do_manual').hide();      
                
                $.ajax({
                    type: "POST",
                    url : "<?php echo base_url('invoice/get_data_use_jo_ap_no'); ?>",
        			data: "trx_no="+data.trx_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
                    cache:false,
                    success: function(data){				
                        $('#data_do').html(data);      
                        set_amount_inv();
                        autoTax("1");
                    },
        			error: function(xhr, status, error) {
        				document.write(xhr.responseText);
        			}
                });
              }
              else if(data.invoice_type == 'M'){ 
                $('#choose_delivery').show();  
                $('#delivery_order').show();
                $('#choose_delivery').click();
                $('#choose_delivery').prop("class","active");  
                $('#job_order').show();
                $('#jo_no').attr('onclick','selectJO_AP_For_Invoice()');

                $('#data_do').hide();      
                $('#data_do_manual').show();      
                
                $.ajax({
                    type: "POST",
                    url : "<?php echo base_url('invoice/get_data_jo'); ?>",
            		data: "jo_no="+data.jo_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
                    cache:false,
                    dataType: 'json',
                    success: function(data_jo){
                        $('#jo_year').val(data_jo.year);   // JO Year
                        $('#jo_month').val(data_jo.month);  // JO Month
                        $('#jo_code').val(data_jo.code);
                        $('#jo_fare_trip_id').val(data_jo.fare_trip_rowID);
                        $('#jo_type').val(data_jo.jo_type);
                        $('#price_amount').val(data_jo.price_amount);
                        $('#wholesale').val(data_jo.wholesale);
                        $('#price_20ft').val(data_jo.price_20ft);
                        $('#price_40ft').val(data_jo.price_40ft);
                        $('#price_45ft').val(data_jo.price_45ft);
                        
                    },
            		error: function(xhr, status, error) {
            			document.write(xhr.responseText);
            			alert(xhr.responseText);
            		}
                });     
                
                showDetailDeliveryOrder_For_Invoice(data.trx_no,'edit');    
                
              }
              else{ // By Job Order
                $('#choose_delivery').show();  
                $('#delivery_order').show();
                $('#choose_delivery').click();
                $('#choose_delivery').prop("class","active");  
                $('#job_order').show();
                $('#jo_no').attr("onclick","ambil_job_order()");

                $('#data_do').show();      
                $('#data_do_manual').hide();      
                
                $.ajax({
                    type: "POST",
                    url : "<?php echo base_url('invoice/get_data_use_do'); ?>",
                    data: "trx_no="+data.trx_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
                    cache:false,
                    success: function(data){				
                        $('#data_do').html(data);   
                        set_amount_inv();
                        autoTax("1");
                    },
                    error: function(xhr, status, error) {
                    	document.write(xhr.responseText);
                    }
                });
              
              }
                            
              $('#modal_form').modal('show');               
              
              $('#invoice_type').attr('disabled',false);
              $('#debtor_id').attr('disabled',false);
              $('#invoice_date').show();
              $('#invoice_date_tmp').hide();
              
              $('#tamdetInvoice').prop('disabled',false);
              $('#tamdetInvoice').show();  
              $('#cekDa').prop('disabled',false);                        
                            
              $('#debtor_id').select2();
              
              document.getElementById("btnSave").style.display="none";
			  document.getElementById("btnUpdate").style.display="block";
			  document.getElementById("btnUpdate").style.cssFloat="right";
              document.getElementById("btnDelete").style.display="none";
              $('.modal-title').text('Update Invoice');  
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error update data", "error");
        }
    }); 
}

function delete_invoice(prefix,year,month,code){
    $('#tamdet').hide();
    $('#btnEmptyDO').hide();

    $('#data_do').html('');
    
    $.ajax({
        url:'<?php echo base_url(); ?>invoice/get_data_invoice?prefix='+prefix+'&year='+year+'&month='+month+'&code='+code,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {
              var toMmDdYy = function(input) {
                var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
                if(!input || !input.match(ptrn)) {
                    return null;
                }
                return input.replace(ptrn, '$3-$2-$1');
              };            
              
              $('#row_id').val(data.rowID);
              $('#prefix').val(data.prefix);
              $('#year').val(data.year);  
              $('#month').val(data.month);  
              $('#code').val(data.code);
              
              $('#invoice_date').val(toMmDdYy(data.trx_date)); 
              $('#invoice_date_tmp').val(toMmDdYy(data.trx_date)); 
              $('#invoice_no').val(data.trx_no);
              $('#debtor_id').val(data.debtor_rowID);
              $('#debtor_id_tmp').val(data.debtor_rowID);
              $('#invoice_type').val(data.invoice_type);
              $('#invoice_remark_header').val(data.descs);
              $('#jo_year').val(data.tr_jo_trx_hdr_year);
              $('#jo_month').val(data.tr_jo_trx_hdr_month);
              $('#jo_code').val(data.tr_jo_trx_hdr_code);
              $('#jo_no').val(data.jo_no);
              $('#gl_trx_hdr_prefix').val(data.gl_trx_hdr_prefix);
              $('#gl_trx_hdr_year').val(data.gl_trx_hdr_year);
              $('#gl_trx_hdr_month').val(data.gl_trx_hdr_month);
              $('#gl_trx_hdr_code').val(data.gl_trx_hdr_code);
              $('#gl_trx_hdr_trx_no').val(data.gl_trx_hdr_trx_no);
             
              $('#invoice_remark_header').prop("readOnly",true);
              $('#invoice_date').prop("readOnly",true);
              
              if(data.tax == 1){
                document.getElementById('cekDa').checked = true;
              }
              else{
                document.getElementById('cekDa').checked = false;                
              }
              
              showDetailInvoice(data.prefix,data.year,data.month,data.code,'delete');                                              
              
              if (data.invoice_type == 'A'){
                    $('#choose_delivery').show();  
                    $('#delivery_order').show();
                    $('#choose_delivery').click();
                    $('#choose_delivery').prop("class","active");  
                    $('#job_order').show();
                    $('#jo_no').attr('onclick','');
                    
                    $.ajax({
                        type: "POST",
                        url : "<?php echo base_url('invoice/get_data_use_jo_ap_no'); ?>",
            			data: "trx_no="+data.trx_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
                        cache:false,
                        success: function(data){				
                            $('#data_do').html(data);      
                            set_amount_inv();
                            btn_delete_do();
                            autoTax("1");
                        },
            			error: function(xhr, status, error) {
            				document.write(xhr.responseText);
            			}
                    });
              }
              else if(data.invoice_type == 'M'){ 
                $('#choose_delivery').show();  
                $('#delivery_order').show();
                $('#choose_delivery').click();
                $('#choose_delivery').prop("class","active");  
                $('#job_order').show();
                $('#jo_no').attr('onclick','');

                $('#data_do').hide();      
                $('#data_do_manual').show();      
                
                $.ajax({
                    type: "POST",
                    url : "<?php echo base_url('invoice/get_data_jo'); ?>",
            		data: "jo_no="+data.jo_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
                    cache:false,
                    dataType: 'json',
                    success: function(data_jo){
                        $('#jo_year').val(data_jo.year);   // JO Year
                        $('#jo_month').val(data_jo.month);  // JO Month
                        $('#jo_code').val(data_jo.code);
                        $('#jo_fare_trip_id').val(data_jo.fare_trip_rowID);
                        $('#jo_type').val(data_jo.jo_type);
                        $('#price_amount').val(data_jo.price_amount);
                        $('#wholesale').val(data_jo.wholesale);
                        $('#price_20ft').val(data_jo.price_20ft);
                        $('#price_40ft').val(data_jo.price_40ft);
                        $('#price_45ft').val(data_jo.price_45ft);
                        
                    },
            		error: function(xhr, status, error) {
            			document.write(xhr.responseText);
            			alert(xhr.responseText);
            		}
                });     
                
                showDetailDeliveryOrder_For_Invoice(data.trx_no,'delete');    
                
              }
              else{ // By JO
                $('#choose_delivery').show();  
                $('#delivery_order').show();
                $('#choose_delivery').click();
                $('#choose_delivery').prop("class","active");  
                $('#job_order').show();
                $('#jo_no').attr("onclick","");
                
                $.ajax({
                    type: "POST",
                    url : "<?php echo base_url('invoice/get_data_use_do'); ?>",
                    data: "trx_no="+data.trx_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
                    cache:false,
                    success: function(data){				
                        $('#data_do').html(data);   
                        set_amount_inv();
                        btn_delete_do();
                        autoTax("1");
                    },
                    error: function(xhr, status, error) {
                    	document.write(xhr.responseText);
                    }
                });
                
              }
              
              $('#modal_form').modal('show');               
              
              $('#invoice_type').attr('disabled',true);
              $('#debtor_id').attr('disabled',true);
              $('#invoice_date').hide();
              $('#invoice_date_tmp').show();
              
              $('#tamdetInvoice').prop('disabled',true);
              $('#tamdetInvoice').hide();  
              $('#cekDa').prop('disabled',true);                        
                            
              $('#debtor_id').select2();
              
              document.getElementById("btnSave").style.display="none";
			  document.getElementById("btnUpdate").style.display="none";
              document.getElementById("btnDelete").style.display="block";
              document.getElementById("btnDelete").style.cssFloat="right";
              $('.modal-title').text('Delete Invoice'); 
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error delete data", "error");
        }
    }); 
}

function showDetailInvoice(prefix,year,month,code,status){
bersihDetailInvo();
$.ajax({
	type: "GET",
        url:'<?php echo base_url(); ?>invoice/showDetailInvoice?prefix='+prefix+'&year='+year+'&month='+month+'&code='+code,
		dataType:"JSON",
		success: function(result){
    		var x=0;
            var totBase   = 0;
            var totVat    = 0;
            var totWth    = 0;
            var totTal    = 0;
    		$.each(result, function(key, val) {	
        		x++;
        		addRowDetailInvoice();
                
                $('#income_rowId'+x).select2('val',val.income_rowID);
                $('#income_tmp'+x).val(val.income_name);
                $('#invoice_remark'+x).val(val.descs);
                $('#amount_invo'+x).val(tandaPemisahTitik(val.input_amt));
                $('#amount_base'+x).val(tandaPemisahTitik(val.base_amt));
                $('#amount_vat'+x).val(tandaPemisahTitik(val.tax_amt));
                //$('#amountWth'+x).val(number_format(val.wth_amt,0,',','.','format'));
                $('#SubTotal'+x).val(tandaPemisahTitik(val.total_amt));
                //$('#cmbWth'+x).val(val.wth_rate_rowID);
              
                if (val.include_vat == '0'){
                    document.getElementById('cekTax'+x).checked=false;
                }else{
                    document.getElementById('cekTax'+x).checked=true;
                }
                
                if(status == 'delete'){
                    $('#invoice_remark'+x).attr('readonly',true);
                    $('#amount_invo'+x).attr('readonly',true);
                    $('#amount_invo'+x).attr('onfocus','');
                    $('#cekTax'+x).attr('disabled',true);
                    $('#hapdetInvoice'+x).hide();       
                    $('#income_rowId'+x).select2('destroy');
                    $('#income_rowId'+x).hide();
                    $('#income_tmp'+x).show();
                }
                
                var nilaiBase=number_format(document.getElementById('amount_base'+x).value,0,',','.','deformat');
                totBase +=parseInt(nilaiBase);
                var nilaiVat=number_format(document.getElementById('amount_vat'+x).value,0,',','.','deformat');
                totVat +=parseInt(nilaiVat);
                //var nilaiWth=number_format(document.getElementById('amountWth'+x).value,0,',','.','deformat');
                //totWth +=parseInt(nilaiWth);
                var nilaiTotal=number_format(document.getElementById('SubTotal'+x).value,0,',','.','deformat');
                totTal +=parseInt(nilaiTotal);
    	
      	     });
             $('#TotalBase').val(number_format(totBase,0,',','.','format'));
             $('#TotalVat').val(number_format(totVat,0,',','.','format'));
             //$('#TotalWth').val(number_format(totWth,0,',','.','format'));
             $('#GrandTotal').val(number_format(totTal,0,',','.','format'));
             
        }
            
   });
    
            
}

function ambil_job_order(){
    $('#joModal').modal('show');
    $('.modal-job-title').html('Job Order List');
    $('#tbl-joborder').DataTable().destroy();
    $('#data_do').html('');
        
    var table = $('#tbl-joborder').DataTable({"aaSorting": [[0, 'desc']],
        "bProcessing": true,
        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "sPaginationType": "full_numbers",
        "columnDefs": [
                {
                    "targets": [ 10 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 11 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 12 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 13 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 14 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 15 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 16 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 17 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 18 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 19 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 20 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 21 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 22 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 23 ],
                    "visible": false,
                    "searchable": false
                }
            ]
	});
    
    $('#tbl-joborder tbody').on('click', 'tr', function () {
        var data = table.row( this ).data();
        $('#jo_no').val(data[0]);
        $('#jo_year').val(data[12]);
        $('#jo_month').val(data[13]);
        $('#jo_code').val(data[14]);            
        $('#joModal').modal('hide');
        var jo_no = data[0];
         
        $.ajax({
            type: "POST",
            url : "<?php echo base_url('invoice/get_data_do'); ?>",
			data: "jo_no="+jo_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
            cache:false,
            success: function(data){				
                $('#data_do').html(data);      
                set_amount_inv();
                autoTax("1");
            },
			error: function(xhr, status, error) {
				document.write(xhr.responseText);
			}
        });
        
        $('#choose_delivery').show();  
        $('#delivery_order').show();
        $('#choose_delivery').click();
        $('#choose_delivery').prop("class","active");  
        //$('#invoice_detail').hide();
        
    });  
}

function ambil_ap(){
    $('#joModal').modal('show');
    $('.modal-job-title').html('Job Order List');
    $('#tbl-joborder').DataTable().destroy();
    $('#data_do').html('');
        
    var table = $('#tbl-joborder').DataTable({"aaSorting": [[0, 'desc']],
        "bProcessing": true,
        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "sPaginationType": "full_numbers",
        "columnDefs": [
                {
                    "targets": [ 10 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 11 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 12 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 13 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 14 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 15 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 16 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 17 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 18 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 19 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 20 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 21 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 22 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 23 ],
                    "visible": false,
                    "searchable": false
                }
            ]
	});
    
    $('#tbl-joborder tbody').on('click', 'tr', function () {
        var data = table.row( this ).data();
        $('#jo_no').val(data[0]);          
        $('#joModal').modal('hide');
        var jo_ap_no = data[0];
         
        $.ajax({
            type: "POST",
            url : "<?php echo base_url('invoice/get_data_jo_ap_no'); ?>",
			data: "jo_ap_no="+jo_ap_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
            cache:false,
            success: function(data){				
                $('#data_do').html(data);      
                set_amount_inv();
                autoTax("1");
            },
			error: function(xhr, status, error) {
				document.write(xhr.responseText);
			}
        });
        
        $('#choose_delivery').show();  
        $('#delivery_order').show();
        $('#choose_delivery').click();
        $('#choose_delivery').prop("class","active");  
        //$('#invoice_detail').hide();
        
    });  
}

function ambil_ap_old(){
    $('#apModal').modal('show');
    $('.modal-title-ap').html('Account Payable (AP) List');
    $('#tbl-ap').DataTable().destroy();
        
    var table = $('#tbl-ap').DataTable({"aaSorting": [[0, 'desc']],
        "bProcessing": true,
        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "sPaginationType": "full_numbers"
	});
    
    $('#tbl-ap tbody').on('click', 'tr', function () {
        var data = table.row( this ).data();
        $('#ap_no').val(data[0]);
        $('#apModal').modal('hide');
        var ap_no = data[0];
         
        $.ajax({
            type: "POST",
            url : "<?php echo base_url('invoice/get_data_ap'); ?>",
			data: "ap_no="+ap_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
            cache:false,
            success: function(data){		   
                $('#amount_invo1').prop('readonly',true);   
                $('#hapdetInvoice1').hide();   
                $('#amount_invo1').val(tandaPemisahTitik(data.total_ap));   
                
                autoTax("1");
            },
			error: function(xhr, status, error) {
				document.write(xhr.responseText);
			}
        });
                
    });  
}

var totrowInvo= 0;
function addRowDetailInvoice(){
        totrowInvo++;
        
        var readonly = '';
        if($('#invoice_type').val() != 'M'){
            readonly = 'readonly="readonly"';            
        }
        
        var detailrow="";
        detailrow=detailrow+"<tr id='rowInvo"+totrowInvo+"'>";
        
        detailrow=detailrow+"<td>";
        var tombolhapus="<input type='button' style='height:30px;width:30px;border:0px;background-image:url(\"<?= base_url();?>resource/images/delete.png\");background-repeat:no-repeat;' id='hapdetInvoice"+totrowInvo+"'   title='Hapus Baris' value='&nbsp;' onclick='hapusBarisInvo(\"rowInvo"+totrowInvo+"\")' />";
        detailrow=detailrow+tombolhapus;    
        detailrow=detailrow+"</td>";
                
        var income="<select class='yellowtext' id='income_rowId"+totrowInvo+"' name='detailInvoice["+totrowInvo+"][income_rowId]' type='text'  style='height:30px;width:170px;background-color:white;border:solid 1px #ccc;' /></select>";
        var income_tmp="<input class='form-control' id='income_tmp"+totrowInvo+"' name='detailInvoice["+totrowInvo+"][income_tmp]' type='text' value='' style='display:none;height:30px;background-color:white;border:solid 1px #ccc;' readonly />";
		detailrow=detailrow+"<td>"+income+income_tmp+"</td>";
        
        detailrow=detailrow+"<td >";
        var text2="<textarea class='form-control' id='invoice_remark"+totrowInvo+"' name='detailInvoice["+totrowInvo+"][invoice_remark]' style='text-align:left;background-color:white;border:solid 1px #ccc;' rows='2' maxlength='300' ></textarea>";
        detailrow=detailrow+text2;
        detailrow=detailrow+"</td>";
        
        detailrow=detailrow+"<td >";
        var text3="<input class='form-control currency' " + readonly + " onfocus='autoTax(\""+totrowInvo+"\");' onkeyup='autoTax(\""+totrowInvo+"\");sumDetailInvoice(\""+totrowInvo+"\");' id='amount_invo"+totrowInvo+"' name='detailInvoice["+totrowInvo+"][amount_invo]' value='0' type='text' style='text-align:right;height:30px;width:120px;background-color:white;border:solid 1px #ccc;'  value=''  />";
        detailrow=detailrow+text3;
        detailrow=detailrow+"</td>";
        
        detailrow=detailrow+"<td >";
        var text4="<input class='form-control' onclick='ceklist(\""+totrowInvo+"\")' id='cekTax"+totrowInvo+"'  name='detailInvoice["+totrowInvo+"][cekTax]'  type='checkbox' style='height:22px;width:60px;text-align:left;float:left;'  value='1'  />";
        detailrow=detailrow+text4;
        detailrow=detailrow+"</td>";
        
        detailrow=detailrow+"<td >";
        var text5="<input class='form-control currency' id='amount_base"+totrowInvo+"' readOnly='readOnly'  name='detailInvoice["+totrowInvo+"][amount_base]' value='0' type='text' style='text-align:right;height:30px;width:120px;background-color:white;border:solid 1px #ccc;' />";
        detailrow=detailrow+text5;
        detailrow=detailrow+"</td>";
        
        detailrow=detailrow+"<td >";
        var text6="<input class='form-control currency' id='amount_vat"+totrowInvo+"' readOnly='readOnly' name='detailInvoice["+totrowInvo+"][amount_vat]' value='0' type='text' style='text-align:right;height:30px;width:100px;background-color:white;border:solid 1px #ccc;' />";
        detailrow=detailrow+text6;
        detailrow=detailrow+"</td>";
        
        //var wthHolding="<select  class='yellowtext'  id='cmbWth"+totrowInvo+"'  name='detailInvoice["+totrowInvo+"][cmbWth]'   type='text'  style='height:30px;background-color:white;border:solid 1px #ccc;' /></select>";
		//detailrow=detailrow+"<td>"+wthHolding+"</td>";
        
        detailrow=detailrow+"<td >";
        //var text6="<input class='form-control currency' id='amountWth"+totrowInvo+"' readOnly='readOnly' name='detailInvoice["+totrowInvo+"][amountWth]'  type='text' style='text-align:right;height:30px;background-color:white;border:solid 1px #ccc;'  value='' placeholder='Amount' />";
        //detailrow=detailrow+text6;

        var text6="<div class='input-group'><span class='input-group-addon' id='basic-addon1'>Rp</span><input class='form-control currency' id='SubTotal"+totrowInvo+"' readOnly='readOnly'  name='detailInvoice["+totrowInvo+"][SubTotal]' value='0' type='text' style='text-align:right;height:30px;background-color:white;border:solid 1px #ccc;'  value='' placeholder='Subtotal' /></div>";
        detailrow=detailrow+text6;
        detailrow=detailrow+"</td>";
                    
        detailrow=detailrow+"</tr>";
                $('#detail_invoice tr:last').after(
                    detailrow
        );
        //document.getElementById('cekTax'+x).checked;
        document.getElementById("income_rowId"+totrowInvo).innerHTML=document.getElementById("income").innerHTML;
        //document.getElementById("cmbWth"+totrowInvo).innerHTML=document.getElementById("cmbWth").innerHTML;
        
        //ambilWth(totrowInvo);
        
        if ($('#cekDa').is(':checked',true)) {
            $("#cekTax"+totrowInvo).prop("disabled",true);
        }
        
        $('#income_rowId'+totrowInvo).select2();
        
        ambilCekHeader(totrowInvo);
}

function hapusBarisInvo(x){
    if(document.getElementById(x)!=null){
        $('#'+x).remove(); 
         
     }
}

function delete_do(x){
    if(document.getElementById(x)!=null){
        $('#'+x).remove(); 
         
    }
    
    var n = parseInt($('#count_data_do').val());
    var total_do = 0;
    for(var i=1;i<=n;i++){  
        if(document.getElementById('qty_'+i)!=null  ){
            if(document.getElementById('qty_'+i).value!="" ){
                total_do++;
            }
        }
    }
    $('#total_do').val(total_do);
    
    recalculationDO();
}

function recalculationDO(){
    var n = parseInt($('#count_data_do').val());
    var total_qty = 0;
    var total_price = 0;
    var total_price_amount = 0;
    
    for(x=1;x<=n; x++){  
        if(document.getElementById('qty_'+x)!=null  ){
            if(document.getElementById('qty_'+x).value!="" ){
                var qty=document.getElementById('qty_'+x).value;
                total_qty +=parseInt(qty);

            }
        }
    }
    
    for(x=1;x<=n; x++){  
        if(document.getElementById('price_'+x)!=null  ){
            if(document.getElementById('price_'+x).value!="" ){
                var price=document.getElementById('price_'+x).value;
                total_price = parseInt(price);
            }
        }
    }
    
    for(x=1;x<=n; x++){  
        if(document.getElementById('price_amount_'+x)!=null  ){
            if(document.getElementById('price_amount_'+x).value!="" ){
                var price_amount=document.getElementById('price_amount_'+x).value;
                total_price_amount += parseInt(price_amount);
            }
        }
    }
    
    $('#amount_invo1').val(tandaPemisahTitik(total_price_amount));      
    $('#amount_invo1').prop('readonly',true);   
    $('#hapdetInvoice1').hide();         
    autoTax("1");
                
    $('#total_qty').val(number_format(total_qty,0,',','.','format'));
    $('#total_price').val(number_format(total_price,0,',','.','format'));
    $('#total_price_amount').val(number_format(total_price_amount,0,',','.','format'));
    
    
}

function set_amount_inv(){
    //$('#amount_invo1').val(number_format($('#total_price_amount').val(),2,',','.','deformat'));    
    var total_price = number_format($('#total_price_amount').val(),2,',','.','deformat');  
    $('#amount_invo1').val(number_format(total_price,0,',','.','format'));      
    $('#amount_invo1').prop('readonly',true);   
    $('#hapdetInvoice1').hide(); 
}

function btn_delete_do(){
    var n = parseInt($('#count_data_do').val());
    
    for(x=1;x<=n; x++){  
        if(document.getElementById('delete_do_'+x)!=null  ){
            if(document.getElementById('delete_do_'+x).value!="" ){
                $('#delete_do_'+x).hide();
            }
        }
    }
    
}

function bersihDetailInvo(){
    var y=totrowInvo+1;
        for(x=0;x<y;x++){
            if(document.getElementById("rowInvo"+x)){
			     hapusBarisInvo("rowInvo"+x);
           }
       }
     totrowInvo=0;
}

function ambilCekHeader(x){
    var cekDa = document.getElementById('cekDa').checked;

    $('#cekDa').click(function() {
          if (!$(this).is(':checked',true)) {
             $('#cekTax'+x).prop("disabled", false);
             $('#amount_invo'+x).focus();
          }else{
             if ($('#cekTax'+x).is(':checked',true)) {
                $('#cekTax'+x).click();
             }
             $('#cekTax'+x).prop("disabled", true);
             $('#amount_vat'+x).val(0);
             $('#amount_invo'+x).focus();
            
          }
     });
     
//     if (cekDa == true){
//        var amount      = parseInt(number_format(document.getElementById('amount_invo'+x).value,0,',','.','deformat'));
//        document.getElementById('amount_base'+x).value=number_format(amount,0,',','.','format');
//        document.getElementById('amount_vat'+x).value=0;
//        document.getElementById('SubTotal'+x).value=number_format(amount,0,',','.','format');
//        document.getElementById('amountWth'+x).value=0;
//        
//     }
    
}

function ambilWth(x){
    $('#cmbWth'+x).change(function(){
        var cmbWth = $('#cmbWth'+x).val();
        var amount_base = parseInt(number_format(document.getElementById('amount_base'+x).value,0,',','.','deformat'));
        var amount_vat  = parseInt(number_format(document.getElementById('amount_vat'+x).value,0,',','.','deformat')); 
        
        $.ajax({
				type: "POST",
				url : "<?php echo base_url('invoice/get_wth'); ?>",
				data: "rowID="+cmbWth+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
				cache:false,
				dataType: 'json',
				success: function(msg){	
					var wth_rate= parseInt(msg.wth_rate)
                    var amountHolding = Math.round(amount_base * wth_rate )/100;
                    document.getElementById('amountWth'+x).value=number_format(amountHolding,0,',','.','format');
                    
                    var looprows=totrowInvo+1;
                    var totNil=0;
                    for(z=1;z<looprows; z++){  
                        if(document.getElementById('amountWth'+z)!=null  ){
                            if(document.getElementById('amountWth'+z).value!="" ){
                                var nilai=number_format(document.getElementById('amountWth'+z).value,0,',','.','deformat');
                                totNil +=parseInt(nilai);
            
                            }
                        }
                    }
                    
                    document.getElementById('TotalWth').value=number_format(totNil,0,',','.','format');
                    var SubTotal = (amount_base + amount_vat) -  amountHolding;
                    document.getElementById('SubTotal'+x).value=number_format(SubTotal,0,',','.','format');
                    
                    JumlahTotalGrand(x);
				},
				error: function(xhr, status, error) {
					document.write(xhr.responseText);
					alert(xhr.responseText);
				}
			});
       
        
    });
}

function JumlahTotalGrand(x){
    var looprows=totrowInvo+1;
        var totNil=0;
        for(z=1;z<looprows; z++){  
            if(document.getElementById('SubTotal'+z)!=null  ){
                if(document.getElementById('SubTotal'+z).value!="" ){
                    var nilai=number_format(document.getElementById('SubTotal'+z).value,0,',','.','deformat');
                    totNil +=parseInt(nilai);

                }
            }
        }
        
        document.getElementById('GrandTotal').value=number_format(totNil,0,',','.','format');
}


function ceklist(x){
    
     var cekda = document.getElementById('cekTax'+x).checked;
    if ( cekda == true){
        var amount      = parseInt(number_format(document.getElementById('amount_invo'+x).value,0,',','.','deformat'));
        var amount_base =  Math.round(amount / 1.1);;
        //alert(amount_base);
        var amount_vat  = amount - amount_base;
        var subTot = amount_base + amount_vat;
        document.getElementById('amount_base'+x).value=number_format(amount_base,0,',','.','format');
        document.getElementById('amount_vat'+x).value=number_format(amount_vat,0,',','.','format');
        document.getElementById('SubTotal'+x).value=number_format(subTot,0,',','.','format');
        //document.getElementById('amountWth'+x).value=0;
        
        var looprows=totrowInvo+1;
        var totNil=0;
        for(z=1;z<looprows; z++){  
            if(document.getElementById('amount_base'+z)!=null  ){
                if(document.getElementById('amount_base'+z).value!="" ){
                    var nilai=number_format(document.getElementById('amount_base'+z).value,0,',','.','deformat');
                    totNil +=parseInt(nilai);

                }
            }
        }
        var totVat=0;
        for(z=1;z<looprows; z++){  
            if(document.getElementById('amount_vat'+z)!=null  ){
                if(document.getElementById('amount_vat'+z).value!="" ){
                    var nilaiVat=number_format(document.getElementById('amount_vat'+z).value,0,',','.','deformat');
                    totVat +=parseInt(nilaiVat);

                }
            }
        }
        
        var totSub=0;
        for(z=1;z<looprows; z++){  
            if(document.getElementById('SubTotal'+z)!=null  ){
                if(document.getElementById('SubTotal'+z).value!="" ){
                    var nilaiTotSub=number_format(document.getElementById('SubTotal'+z).value,0,',','.','deformat');
                    totSub +=parseInt(nilaiTotSub);

                }
            }
        }
        document.getElementById('TotalBase').value=number_format(totNil,0,',','.','format');
        document.getElementById('TotalVat').value=number_format(totVat,0,',','.','format');
        document.getElementById('GrandTotal').value=number_format(totSub,0,',','.','format');
        
    }else{
        var amount      = parseInt(number_format(document.getElementById('amount_invo'+x).value,0,',','.','deformat'));
        var amount_vat  = Math.round(amount * 0.1);;
        var subTot      = amount + amount_vat
        document.getElementById('amount_base'+x).value=number_format(amount,0,',','.','format');
        document.getElementById('amount_vat'+x).value=number_format(amount_vat,0,',','.','format');
        document.getElementById('SubTotal'+x).value=number_format(subTot,0,',','.','format');
        //document.getElementById('amountWth'+x).value=0;
        var looprows=totrowInvo+1;
        var totNil=0;
        for(z=1;z<looprows; z++){  
            if(document.getElementById('amount_base'+z)!=null  ){
                if(document.getElementById('amount_base'+z).value!="" ){
                    var nilai=number_format(document.getElementById('amount_base'+z).value,0,',','.','deformat');
                    totNil +=parseInt(nilai);

                }
            }
        }
        var totVat=0;
        for(z=1;z<looprows; z++){  
            if(document.getElementById('amount_vat'+z)!=null  ){
                if(document.getElementById('amount_vat'+z).value!="" ){
                    var nilaiVat=number_format(document.getElementById('amount_vat'+z).value,0,',','.','deformat');
                    totVat +=parseInt(nilaiVat);

                }
            }
        }
        
        var totSub=0;
        for(z=1;z<looprows; z++){  
            if(document.getElementById('SubTotal'+z)!=null  ){
                if(document.getElementById('SubTotal'+z).value!="" ){
                    var nilaiTotSub=number_format(document.getElementById('SubTotal'+z).value,0,',','.','deformat');
                    totSub +=parseInt(nilaiTotSub);

                }
            }
        }
        
        document.getElementById('TotalBase').value=number_format(totNil,0,',','.','format');
        document.getElementById('TotalVat').value=number_format(totVat,0,',','.','format');
        document.getElementById('GrandTotal').value=number_format(totSub,0,',','.','format');
    }
}

function autoTax(x){
    var cekda = document.getElementById('cekTax'+x).checked;
    var cekHeader = document.getElementById('cekDa').checked;
    
    if (cekda == true){
        
        var amount      = parseInt(number_format(document.getElementById('amount_invo'+x).value,0,',','.','deformat'));
        var amount_base =  Math.round(amount / 1.1);;
        //alert(amount_base);
        var amount_vat  = amount - amount_base;
        var subTot = amount_base + amount_vat;
        document.getElementById('amount_base'+x).value=number_format(amount_base,0,',','.','format');
        document.getElementById('amount_vat'+x).value=number_format(amount_vat,0,',','.','format');
        document.getElementById('SubTotal'+x).value=number_format(subTot,0,',','.','format');
        //document.getElementById('amountWth'+x).value=0;
        
        
        var looprows=totrowInvo+1;
        var totNil=0;
        for(z=1;z<looprows; z++){  
            if(document.getElementById('amount_base'+z)!=null  ){
                if(document.getElementById('amount_base'+z).value!="" ){
                    var nilai=number_format(document.getElementById('amount_base'+z).value,0,',','.','deformat');
                    totNil +=parseInt(nilai);

                }
            }
        }
        var totVat=0;
        for(z=1;z<looprows; z++){  
            if(document.getElementById('amount_vat'+z)!=null  ){
                if(document.getElementById('amount_vat'+z).value!="" ){
                    var nilaiVat=number_format(document.getElementById('amount_vat'+z).value,0,',','.','deformat');
                    totVat +=parseInt(nilaiVat);

                }
            }
        }
        
        var totSub=0;
        for(z=1;z<looprows; z++){  
            if(document.getElementById('SubTotal'+z)!=null  ){
                if(document.getElementById('SubTotal'+z).value!="" ){
                    var nilaiTotSub=number_format(document.getElementById('SubTotal'+z).value,0,',','.','deformat');
                    totSub +=parseInt(nilaiTotSub);

                }
            }
        }
        document.getElementById('TotalBase').value=number_format(totNil,0,',','.','format');
        document.getElementById('TotalVat').value=number_format(totVat,0,',','.','format');
        document.getElementById('GrandTotal').value=number_format(totSub,0,',','.','format');
        
    }else{
        if (cekHeader == true ){
            var amount      = parseInt(number_format(document.getElementById('amount_invo'+x).value,0,',','.','deformat'));
           
            document.getElementById('amount_base'+x).value=number_format(amount,0,',','.','format');
            document.getElementById('amount_vat'+x).value=0;
            document.getElementById('SubTotal'+x).value=number_format(amount,0,',','.','format');
            //document.getElementById('amountWth'+x).value=0;
           // $('#cmbWth option:selected').val(0);
            var looprows=totrowInvo+1;
            var totNil=0;
            for(i=1;i<looprows; i++){  
                if(document.getElementById('amount_base'+i)!=null  ){
                    if(document.getElementById('amount_base'+i).value!="" ){
                        var nilai=number_format(document.getElementById('amount_base'+i).value,0,',','.','deformat');
                        totNil +=parseInt(nilai);
    
                    }
                }
            }
            var totVat=0;
            for(z=1;z<looprows; z++){  
                if(document.getElementById('amount_vat'+z)!=null  ){
                    if(document.getElementById('amount_vat'+z).value!="" ){
                        var nilaiVat=number_format(document.getElementById('amount_vat'+z).value,0,',','.','deformat');
                        totVat +=parseInt(nilaiVat);
    
                    }
                }
            }
            
            var totSub=0;
            for(z=1;z<looprows; z++){  
                if(document.getElementById('SubTotal'+z)!=null  ){
                    if(document.getElementById('SubTotal'+z).value!="" ){
                        var nilaiTotSub=number_format(document.getElementById('SubTotal'+z).value,0,',','.','deformat');
                        totSub +=parseInt(nilaiTotSub);
    
                    }
                }
            }
            
            var totWth=0;
            /*for(z=1;z<looprows; z++){  
                if(document.getElementById('amountWth'+z)!=null  ){
                    if(document.getElementById('amountWth'+z).value!="" ){
                        var nilaiTotSub=number_format(document.getElementById('amountWth'+z).value,0,',','.','deformat');
                        totWth +=parseInt(nilaiTotSub);
    
                    }
                }
            }
            */
            
            document.getElementById('TotalBase').value=number_format(totNil,0,',','.','format');
            document.getElementById('TotalVat').value=number_format(totVat,0,',','.','format');
            //document.getElementById('TotalWth').value=number_format(totWth,0,',','.','format');
            document.getElementById('GrandTotal').value=number_format(totSub,0,',','.','format');
            
        }else{
            var amount      = parseInt(number_format(document.getElementById('amount_invo'+x).value,0,',','.','deformat'));
            var amount_vat  = Math.round(amount * 0.1);;
            var subTot      = amount + amount_vat;
            document.getElementById('amount_base'+x).value=number_format(amount,0,',','.','format');
            document.getElementById('amount_vat'+x).value=number_format(amount_vat,0,',','.','format');
            document.getElementById('SubTotal'+x).value=number_format(subTot,0,',','.','format');
            //document.getElementById('amountWth'+x).value=0;
            var looprows=totrowInvo+1;
            var totNil=0;
            for(z=1;z<looprows; z++){  
                if(document.getElementById('amount_base'+z)!=null  ){
                    if(document.getElementById('amount_base'+z).value!="" ){
                        var nilai=number_format(document.getElementById('amount_base'+z).value,0,',','.','deformat');
                        totNil +=parseInt(nilai);
    
                    }
                }
            }
            var totVat=0;
            for(z=1;z<looprows; z++){  
                if(document.getElementById('amount_vat'+z)!=null  ){
                    if(document.getElementById('amount_vat'+z).value!="" ){
                        var nilaiVat=number_format(document.getElementById('amount_vat'+z).value,0,',','.','deformat');
                        totVat +=parseInt(nilaiVat);
    
                    }
                }
            }
            
            var totSub=0;
            for(z=1;z<looprows; z++){  
                if(document.getElementById('SubTotal'+z)!=null  ){
                    if(document.getElementById('SubTotal'+z).value!="" ){
                        var nilaiTotSub=number_format(document.getElementById('SubTotal'+z).value,0,',','.','deformat');
                        totSub +=parseInt(nilaiTotSub);
    
                    }
                }
            }
            
            var totWth=0;
            /*for(z=1;z<looprows; z++){  
                if(document.getElementById('amountWth'+z)!=null  ){
                    if(document.getElementById('amountWth'+z).value!="" ){
                        var nilaiTotSub=number_format(document.getElementById('amountWth'+z).value,0,',','.','deformat');
                        totWth +=parseInt(nilaiTotSub);
    
                    }
                }
            }
            */
            document.getElementById('TotalBase').value=number_format(totNil,0,',','.','format');
            document.getElementById('TotalVat').value=number_format(totVat,0,',','.','format');
            document.getElementById('GrandTotal').value=number_format(totSub,0,',','.','format');
            //document.getElementById('TotalWth').value=number_format(totWth,0,',','.','format');
        }
        
    }
}

function sumDetailInvoice(x){
        var looprows=totrowInvo+1;
        var totNil=0;

         for(z=1;z<looprows; z++){  
            if(document.getElementById('amount_invo'+z)!=null  ){
                if(document.getElementById('amount_invo'+z).value!="" ){
                    var nilai=number_format(document.getElementById('amount_invo'+z).value,0,',','.','deformat');
                    totNil +=parseInt(nilai);

                }
            }
        }
}

function save_invoice(){
    var debtor_id  = $('#debtor_id option:selected').val();
    var JobOrderNo = $('#jo_no').val();
    var invoice_type = $('#invoice_type option:selected').val();
    
    var validasi="";
    
    var data1=cekValidasi(debtor_id,'Debtor Name','<?=lang('not_empty')?>');
    var data2="";
    if (invoice_type != 'M'){
        data2=cekValidasi(JobOrderNo,'Job Order No','<?=lang('not_empty')?>');
    }
    var data3=cekValidasi(invoice_type,'Invoice Type','<?=lang('not_empty')?>');

    var data_detail = '';
    /*
    if (invoice_type == 'M'){
        if(totrowDO == 0)
            data_detail = cekValidasi('','Delivery Order','<?=lang('not_empty')?>');            
    }
    */
    validasi=data1+data3+data2+data_detail;
    
    var do_exist = 'ada';
    /*  
    var do_exist = '';    
    if (invoice_type == 'M'){
        var x=1;
        var baris=1;
        var totalrowx=totrowDO+1;
        for(x=1;x<totalrowx;x++){
            if(document.getElementById('do_no'+x)!=null){
                if(document.getElementById('do_no'+x).value!=""){
                    do_exist = 'ada';
                }
                else{
                    var do_no      =  $('#do_no'+x).val();                
                    var data_do_no = cekValidasiDetail(do_no,'DO No',baris)
                    
                    validasi=validasi+data_do_no;
                }
                baris++;
            }
        }
        
    }
    */
    
    var x=1;
    var totalrowx=totrowInvo+1;
    for(x=1;x<totalrowx;x++){
        if(document.getElementById('amount_invo'+x)!=null){
            if(document.getElementById('amount_invo'+x).value!=""){
                //var income      =  $('#income_rowId option:selected'+x).val();
                var Remark      =  $('#invoice_remark'+x).val();
                
                //var data3=cekValidasiDetail(income,' Income Name',x)
                var data4=cekValidasiDetail(Remark,'Description ',x)
                
                validasi=validasi+data4;
            }else{
                sweetAlert('Column contents Incomplete!');
                return false;
            }
            
        }
    }
    
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        if(do_exist != ''){
            var x=1;
            var totalrowx=totrowDO+1;
            for(x=1;x<totalrowx;x++){
                if(document.getElementById('do_no'+x)!=null){
                    if(document.getElementById('do_no'+x).value!=""){
                        var do_no = $('#do_no'+x).val();      
                        var do_no_tmp = $('#do_no_tmp'+x).val();      
                        var row_id = $('#row_id').val();      
                        
                        if(row_id == ''){
                            $.ajax({
                                type: "POST",
                                url : "<?php echo base_url('invoice/check_data_do'); ?>",
                        		data: "do_no="+do_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
                                cache:false,
                                dataType: "JSON",
                                success: function(result){
                                    if(typeof(result.do_no) != 'undefined'){
                                        do_exist = 'ada';
                                        $('#do_no'+x).val('');   
                                        
                                        sweetAlert('<?=lang('information')?>','DO No '+result.do_no+' sudah pernah ditambahkan.');
                                    }
                                    else{
                                        do_exist = '';
                                    }
                                },
                        		error: function(xhr, status, error) {
                        			document.write(xhr.responseText);
                        			alert(xhr.responseText);
                        		}
                            });    
                        }
                        else{
                            if(do_no != do_no_tmp){
                                $.ajax({
                                    type: "POST",
                                    url : "<?php echo base_url('invoice/check_data_do'); ?>",
                            		data: "do_no="+do_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
                                    cache:false,
                                    dataType: "JSON",
                                    success: function(result){
                                        if(typeof(result.do_no) != 'undefined'){
                                            do_exist = 'ada';
                                            $('#do_no'+x).val('');   
                                            
                                            sweetAlert('<?=lang('information')?>','DO No '+result.do_no+' sudah pernah ditambahkan.');
                                        }
                                        else{
                                            do_exist = '';
                                        }
                                    },
                            		error: function(xhr, status, error) {
                            			document.write(xhr.responseText);
                            			alert(xhr.responseText);
                            		}
                                });
                            }
                        }
                    }
                    
                }
            }
            
            sweetAlert({
              title: "Are you sure?",
              text: "Are you want to Save?",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#286090",
              confirmButtonText: "Yes, Save !",
              closeOnConfirm: true,
              html: false
            },function(r){ 
                if (r){
                    if(clickSave == 0){
                        clickSave++;
                        
                        $.ajax({
                            url : "<?php echo base_url('invoice/save_invoice')?>",
                            type: "POST",
                            data: $('#form').serializeArray(),
                            dataType: "JSON",
                            success: function(result)
                            {                 	            
        
                                if (result.success){ 
                                    $('#modal_form').modal('hide');
                                    //swal("Save!", "Data has been Saved.", "success");
                                    sweetAlert('<?=lang('information')?>',''+result.msg);
                                    var url = "<?php echo base_url('invoice')?>/print_invoice/"+result.trx_no;
                                
                                    try {
                                        window.open(url, "_blank","width=1002,height=700,location=0,menubar=0,scrollbars=1,status=1,resizable=0")
                                    } catch(e) {
                                        location.target = "_blank";
                                        location.href = url;
                                    }
                                    
                                    location.replace("<?php echo base_url('invoice')?>");
                                }else{
                                    sweetAlert('<?=lang('information')?>',''+result.msg); 
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                swal("Oops!", "Error add data", "error");
                                clickSave = 0;
                            }
                            
                        });  
                    }
                    else{
                        alert('<?=lang('data_in_process')?>');
                    }
                }
            });
        }
        else{
            sweetAlert({
              title: "Are you sure?",
              text: "Are you want to Save?",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#286090",
              confirmButtonText: "Yes, Save !",
              closeOnConfirm: true,
              html: false
            },function(r){ 
                if (r){
                      $.ajax({
                        url : "<?php echo base_url('invoice/save_invoice')?>",
                        type: "POST",
                        data: $('#form').serializeArray(),
                        dataType: "JSON",
                        success: function(result)
                        {                 	            
    
                            if (result.success){ 
                                $('#modal_form').modal('hide');
                                //swal("Save!", "Data has been Saved.", "success");
                                sweetAlert('<?=lang('information')?>',''+result.msg);
                                var url = "<?php echo base_url('invoice')?>/print_invoice/"+result.trx_no;
                                
                                try {
                                    window.open(url, "_blank","width=1002,height=700,location=0,menubar=0,scrollbars=1,status=1,resizable=0")
                                } catch(e) {
                                    location.target = "_blank";
                                    location.href = url;
                                }
                                
                                location.replace("<?php echo base_url('invoice')?>");
                            }else{
                                sweetAlert('<?=lang('information')?>',''+result.msg); 
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal("Oops!", "Error add data", "error");
                        }
                        
                    });  
                }
            });
        }
    } 
} 

function update_invoice(){
    var debtor_id  = $('#debtor_id option:selected').val();
    var JobOrderNo = $('#jo_no').val();
    var invoice_type = $('#invoice_type option:selected').val();

    
    var validasi="";
    
    var data1=cekValidasi(debtor_id,'Debtor Name','<?=lang('not_empty')?>');
    var data2="";
    if (invoice_type != 'M'){
        data2=cekValidasi(JobOrderNo,'Job Order No','<?=lang('not_empty')?>');
    }
    var data3=cekValidasi(invoice_type,'Invoice Type','<?=lang('not_empty')?>');
        
    var data_detail = '';
    /*
    if (invoice_type == 'M'){
        if(totrowDO == 0)
            data_detail = cekValidasi('','Delivery Order','<?=lang('not_empty')?>');            
    }
    */
    validasi=data1+data3+data2+data_detail;
    
    var do_exist = 'ada';
    /*
    var do_exist = '';    
    if (invoice_type == 'M'){
        var x=1;
        var baris=1;
        var totalrowx=totrowDO+1;
        for(x=1;x<totalrowx;x++){
            if(document.getElementById('do_no'+x)!=null){
                if(document.getElementById('do_no'+x).value!=""){
                    do_exist = 'ada';
                }
                else{
                    var do_no      =  $('#do_no'+x).val();                
                    var data_do_no = cekValidasiDetail(do_no,'DO No',baris)
                    
                    validasi=validasi+data_do_no;
                }
                baris++;
            }
        }
        
    }
    */
    
    var x=1;
    var totalrowx=totrowInvo+1;
    for(x=1;x<totalrowx;x++){
        if(document.getElementById('amount_invo'+x)!=null){
            if(document.getElementById('amount_invo'+x).value!=""){
                //var income      =  $('#income_rowId option:selected'+x).val();
                var Remark      =  $('#invoice_remark'+x).val();
                
                //var data3=cekValidasiDetail(income,' Income Name',x)
                var data4=cekValidasiDetail(Remark,'Description ',x)
                
                validasi=validasi+data4;
            }else{
                sweetAlert('Column contents Incomplete!');
                return false;
            }
            
        }
    }
    
     
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        if(do_exist != ''){
            var x=1;
            var totalrowx=totrowDO+1;
            for(x=1;x<totalrowx;x++){
                if(document.getElementById('do_no'+x)!=null){
                    if(document.getElementById('do_no'+x).value!=""){
                        var do_no = $('#do_no'+x).val();      
                        var do_no_tmp = $('#do_no_tmp'+x).val();      
                        var row_id = $('#row_id').val();      
                        
                        if(row_id == ''){
                            $.ajax({
                                type: "POST",
                                url : "<?php echo base_url('invoice/check_data_do'); ?>",
                        		data: "do_no="+do_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
                                cache:false,
                                dataType: "JSON",
                                success: function(result){
                                    if(typeof(result.do_no) != 'undefined'){
                                        do_exist = 'ada';
                                        $('#do_no'+x).val('');   
                                        
                                        sweetAlert('<?=lang('information')?>','DO No '+result.do_no+' sudah pernah ditambahkan.');
                                    }
                                    else{
                                        do_exist = '';
                                    }
                                },
                        		error: function(xhr, status, error) {
                        			document.write(xhr.responseText);
                        			alert(xhr.responseText);
                        		}
                            });    
                        }
                        else{
                            if(do_no != do_no_tmp){
                                $.ajax({
                                    type: "POST",
                                    url : "<?php echo base_url('invoice/check_data_do'); ?>",
                            		data: "do_no="+do_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
                                    cache:false,
                                    dataType: "JSON",
                                    success: function(result){
                                        if(typeof(result.do_no) != 'undefined'){
                                            do_exist = 'ada';
                                            $('#do_no'+x).val('');   
                                            
                                            sweetAlert('<?=lang('information')?>','DO No '+result.do_no+' sudah pernah ditambahkan.');
                                        }
                                        else{
                                            do_exist = '';
                                        }
                                    },
                            		error: function(xhr, status, error) {
                            			document.write(xhr.responseText);
                            			alert(xhr.responseText);
                            		}
                                });
                            }
                        }
                    }
                    
                }
            }
            
            sweetAlert({
              title: "Are you sure?",
              text: "Are you want to Save?",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#286090",
              confirmButtonText: "Yes, Save !",
              closeOnConfirm: true,
              html: false
            },function(r){ 
                if (r){
                    if(clickSave == 0){
                        clickSave++;
                        
                        $.ajax({
                            url : "<?php echo base_url('invoice/update_invoice')?>",
                            type: "POST",
                            data: $('#form').serializeArray(),
                            dataType: "JSON",
                            success: function(result)
                            {                 	            
                    
                                if (result.success){ 
                                    $('#modal_form').modal('hide');
                                    //swal("Save!", "Data has been Saved.", "success");
                                    sweetAlert('<?=lang('information')?>',''+result.msg);
                                    var url = "<?php echo base_url('invoice')?>/print_invoice/"+result.trx_no;
                                    
                                    try {
                                        window.open(url, "_blank","width=1002,height=700,location=0,menubar=0,scrollbars=1,status=1,resizable=0")
                                    } catch(e) {
                                        location.target = "_blank";
                                        location.href = url;
                                    }
                                    
                                    location.replace("<?php echo base_url('invoice')?>");
                                    
                                }else{
                                    sweetAlert('<?=lang('information')?>',''+result.msg); 
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                swal("Oops!", "Error update data", "error");
                                clickSave = 0;
                            }
                            
                        });  
                    }
                    else{
                        alert('<?=lang('data_in_process')?>');
                    }
                }
            });
        }
        else{
            sweetAlert({
              title: "Are you sure?",
              text: "Are you want to Save?",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#286090",
              confirmButtonText: "Yes, Save !",
              closeOnConfirm: true,
              html: false
            },function(r){ 
                if (r){
                      $.ajax({
                        url : "<?php echo base_url('invoice/update_invoice')?>",
                        type: "POST",
                        data: $('#form').serializeArray(),
                        dataType: "JSON",
                        success: function(result)
                        {                 	            
                
                            if (result.success){ 
                                $('#modal_form').modal('hide');
                                //swal("Save!", "Data has been Saved.", "success");
                                sweetAlert('<?=lang('information')?>',''+result.msg);
                                var url = "<?php echo base_url('invoice')?>/print_invoice/"+result.trx_no;
                                
                                try {
                                    window.open(url, "_blank","width=1002,height=700,location=0,menubar=0,scrollbars=1,status=1,resizable=0")
                                } catch(e) {
                                    location.target = "_blank";
                                    location.href = url;
                                }
                                
                                location.replace("<?php echo base_url('invoice')?>");
                                
                            }else{
                                sweetAlert('<?=lang('information')?>',''+result.msg); 
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal("Oops!", "Error add / update data", "error");
                        }
                        
                    });  
                }
            });
        }
    } 
} 

function save_invoice_receipt(){
    var received_date = $('#received_date').val();
    var received_no = $('#received_no').val();
    var due_date = $('#due_date').val();
    
    var validasi="";
    
    var data1=cekValidasi(received_date,'Received Date','<?=lang('not_empty')?>');
    var data2=cekValidasi(received_no,'Nomor','<?=lang('not_empty')?>');
    var data3=cekValidasi(due_date,'Due Date','<?=lang('not_empty')?>');
        
    validasi=data1+data2+data3;
    
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('invoice/save_invoice_receipt')?>",
                    type: "POST",
                    data: $('#form_invoice_receipt').serializeArray(),
                    dataType: "JSON",
                    success: function(result)
                    {                 	            
                        if (result.success){ 
                           sweetAlert('<?=lang('information')?>',''+result.msg);
                           $('#modal_receipt').modal('hide');
                           location.replace("<?php echo base_url('invoice')?>");
                            
                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error saving data", "error");
                    }
                    
                });  
            }
        });
    }   
}

function del_invoice(){
     swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url:'<?php echo base_url(); ?>invoice/delete_invoice',
            type: "POST",
            data: $('#form').serializeArray(),
            dataType: "JSON",
            success: function(data)
            {
               
               swal("Deleted!", " Delete successfully", "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('invoice')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    }); 
}

// end invoices 

// Account Payable
function add_ap(){
    $('#form')[0].reset();
    $('#ap_no').val('');   
    $('#row_id').val('');   
    $('#code').val('');   
    $('#user_created').val('');
    $('#date_created').val('');
    $('#time_created').val('');
    
    bersihDO_AP();
    $('#modal_form').modal('show');
    $('.modal-title').text('Add Account Payable (AP)');
    $('#ap_type').select2();
    $('#creditor_id').select2();
    $('#total_amt').mask('000.000.000', {reverse: true});

    $('#tamdet').hide();
    $('#job_order_field').hide();
}

function save_ap(){
    var ref_no = $('#ref_no').val();
    var ap_type = $('#ap_type').val();
    var creditor_id = $('#creditor_id').val();
    var do_jo_no = $('#do_jo_no').val();
    var value = $('#total_amt').val();
    var total_amt = number_format(value,0,',','.','deformat');
        
    if(value == '' || value == null)
        total_amt = 0;
        
    var validasi="";
    
    var data1=cekValidasi(ref_no,'Reff No / Receipt No / Invoice No','<?=lang('not_empty')?>');
    var data2=cekValidasi(value,'Total','<?=lang('not_empty')?>');
    var data3='';    
    var data4=cekValidasi(ap_type,'AP Type','<?=lang('not_empty')?>');
    var data5=cekValidasi(creditor_id,'Supplier Name','<?=lang('not_empty')?>');
    var data6 = '';
    
    if(total_amt == 0)
        data3 = cekValidasi('','Total','must be more than 0');
    
    var data_detail = '';
    if(ap_type == '1'){
        if(totrowDO == 0)
            data_detail = cekValidasi('','Delivery Order','<?=lang('not_empty')?>');
        
        data6=cekValidasi(do_jo_no,'Job Order','<?=lang('not_empty')?>');
    }
        
    validasi=data1+data4+data5+data2+data6+data3+data_detail;  
    
    var do_exist = '';    
    if(ap_type == '1'){    
        var x=1;
        var baris=1;
        var totalrowx=totrowDO+1;
        for(x=1;x<totalrowx;x++){
            if(document.getElementById('do_no'+x)!=null){
                if(document.getElementById('do_no'+x).value!=""){
                    do_exist = 'ada';
                }
                else{
                    var do_no      =  $('#do_no'+x).val();                
                    var data_do_no = cekValidasiDetail(do_no,'DO No',baris)
                    
                    validasi=validasi+data_do_no;
                }
                baris++;
            }
        }
        
    }
        
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{        
        if(do_exist != ''){
            var x=1;
            var totalrowx=totrowDO+1;
            for(x=1;x<totalrowx;x++){
                if(document.getElementById('do_no'+x)!=null){
                    if(document.getElementById('do_no'+x).value!=""){
                        var do_no = $('#do_no'+x).val();      
                        var do_no_tmp = $('#do_no_tmp'+x).val();      
                        var row_id = $('#row_id').val();      
                        
                        if(row_id == ''){
                            $.ajax({
                                type: "POST",
                                url : "<?php echo base_url('account_payable/check_data_do'); ?>",
                        		data: "do_no="+do_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
                                cache:false,
                                dataType: "JSON",
                                success: function(result){
                                    if(typeof(result.do_no) != 'undefined'){
                                        do_exist = 'ada';
                                        $('#do_no'+x).val('');   
                                        
                                        sweetAlert('<?=lang('information')?>','DO No '+result.do_no+' sudah pernah ditambahkan.');
                                    }
                                    else{
                                        do_exist = '';
                                    }
                                },
                        		error: function(xhr, status, error) {
                        			document.write(xhr.responseText);
                        			alert(xhr.responseText);
                        		}
                            });    
                        }
                        else{
                            if(do_no != do_no_tmp){
                                $.ajax({
                                    type: "POST",
                                    url : "<?php echo base_url('account_payable/check_data_do'); ?>",
                            		data: "do_no="+do_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
                                    cache:false,
                                    dataType: "JSON",
                                    success: function(result){
                                        if(typeof(result.do_no) != 'undefined'){
                                            do_exist = 'ada';
                                            $('#do_no'+x).val('');   
                                            
                                            sweetAlert('<?=lang('information')?>','DO No '+result.do_no+' sudah pernah ditambahkan.');
                                        }
                                        else{
                                            do_exist = '';
                                        }
                                    },
                            		error: function(xhr, status, error) {
                            			document.write(xhr.responseText);
                            			alert(xhr.responseText);
                            		}
                                });
                            }
                        }
                    }
                    
                }
            }
            
            sweetAlert({
              title: "Are you sure?",
              text: "Are you want to save?",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#286090",
              confirmButtonText: "Yes, Save !",
              closeOnConfirm: true,
              html: false
            },function(r){ 
                if (r){
                    if(clickSave == 0){
                        clickSave++;
                        
                        $.ajax({
                            url : "<?php echo base_url('account_payable/save_ap')?>",
                            type: "POST",
                            data: $('#form').serializeArray(),
                            dataType: "JSON",
                            success: function(result)
                            {                 	            
                                if (result.success){ 
                                    $('#modal_form').modal('hide');
                                    //swal("Save!", "Data has been Saved.", "success");
                                    sweetAlert('<?=lang('information')?>',''+result.msg);   
                                    location.replace("<?php echo base_url('account_payable')?>");
                                }else{
                                    sweetAlert('<?=lang('information')?>',''+result.msg); 
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                swal("Oops!", "Error saving data", "error");
                                clickSave = 0;
                            }
                            
                        }); 
                    }
                    else{
                        alert('<?=lang('data_in_process')?>');
                    } 
                }
            });
        }
        else{
            sweetAlert({
              title: "Are you sure?",
              text: "Are you want to save?",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#286090",
              confirmButtonText: "Yes, Save !",
              closeOnConfirm: true,
              html: false
            },function(r){ 
                if (r){
                      $.ajax({
                        url : "<?php echo base_url('account_payable/save_ap')?>",
                        type: "POST",
                        data: $('#form').serializeArray(),
                        dataType: "JSON",
                        success: function(result)
                        {                 	            
                            if (result.success){ 
                                $('#modal_form').modal('hide');
                                //swal("Save!", "Data has been Saved.", "success");
                                sweetAlert('<?=lang('information')?>',''+result.msg);   
                                location.replace("<?php echo base_url('account_payable')?>");
                            }else{
                                sweetAlert('<?=lang('information')?>',''+result.msg); 
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal("Oops!", "Error saving data", "error");
                        }
                        
                    });  
                }
            });
        }
    } 
}

function print_ap(trx_no){
    window.open('<?php echo base_url()?>account_payable/print_ap/'+trx_no);
}

function edit_ap(trx_no){
    
    $.ajax({
        type: "POST",
        url:'<?php echo base_url(); ?>account_payable/get_data_header',
        data: "trx_no="+trx_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        dataType: 'json',
        success: function(data)
        {
            var toMmDdYy = function(input) {
                var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
                if(!input || !input.match(ptrn)) {
                    return null;
                }
                return input.replace(ptrn, '$3-$2-$1');
            }; 
            
            $.ajax({
                type: "POST",
                url : "<?php echo base_url('account_payable/get_data_supplier'); ?>",
        		data: "ap_type="+data.ap_type+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
                cache:false,
                success: function(result){
                    $('#creditor_id').html(result);
                    $('#creditor_id').select2('val',data.creditor_rowID);
                },
        		error: function(xhr, status, error) {
        			document.write(xhr.responseText);
        			alert(xhr.responseText);
        		}
            }); 
            
            $.ajax({
                type: "POST",
                url : "<?php echo base_url('account_payable/get_data_jo'); ?>",
        		data: "jo_no="+data.jo_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
                cache:false,
                dataType: 'json',
                success: function(data_jo){
                    $('#jo_year').val(data_jo.year);   // JO Year
                    $('#jo_month').val(data_jo.month);  // JO Month
                    $('#jo_code').val(data_jo.code);
                    $('#jo_fare_trip_id').val(data_jo.fare_trip_rowID);
                    $('#jo_type').val(data_jo.jo_type);
                    $('#price_amount').val(data_jo.price_amount);
                    $('#wholesale').val(data_jo.wholesale);
                    $('#price_20ft').val(data_jo.price_20ft);
                    $('#price_40ft').val(data_jo.price_40ft);
                    $('#price_45ft').val(data_jo.price_45ft);
                },
        		error: function(xhr, status, error) {
        			document.write(xhr.responseText);
        			alert(xhr.responseText);
        		}
            });     
            
            showDetailDeliveryOrder(data.trx_no);    
            
            
            $('#ap_type').select2();
            $('#creditor_id').select2();              
            $('#total_amt').mask('000.000.000', {reverse: true});
             
            $('#row_id').val(data.rowID);
            $('#ap_no').val(data.trx_no);
            $('#code').val(data.code);
            $('#ap_date').val(toMmDdYy(data.trx_date));
            $('#come_back').val(toMmDdYy(data.come_back));
            $('#ref_no').val(data.ref_no);
            $('#remark').val(data.descs);
            $('#do_jo_no').val(data.jo_no);
            $('#ap_type').select2('val',data.ap_type);
            $('#total_amt').val(tandaPemisahTitik(data.total_amt));
            $('#total_ap').val(tandaPemisahTitik(data.total_ap));            
            $('#total_diff').val(tandaPemisahTitik(data.total_diff));
            $('#user_created').val(data.user_created);
            $('#date_created').val(data.date_created);
            $('#time_created').val(data.time_created);
            
            if(data.without_tax == 1){
                document.getElementById('cekDa').checked = true;              
                $('#base_amt').val(tandaPemisahTitik(data.total_amt));
                $('#tax_amt').val(0);
            }
            else{
                document.getElementById('cekDa').checked = false;
                $('#base_amt').val(tandaPemisahTitik(data.base_amt));
                $('#tax_amt').val(tandaPemisahTitik(data.tax_amt));
            }
            
            if(data.ap_type == 1){
                $('#tamdet').show();
                $('#job_order_field').show();
            }
            else{
                $('#tamdet').hide();
                $('#job_order_field').hide();
            }
            
            $('#modal_form').modal('show');               
            $('.modal-title').text('Update Account Payable (AP)');  
  
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error update data", "error");
        }
    }); 
   
}

function delete_ap(trx_no){
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            type: "POST",
            url : "<?php echo base_url('account_payable/delete_ap/')?>",
            data: "trx_no="+trx_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
            cache:false,
            success: function(data)
            {
               
               swal("Deleted!", "Data has been deleted.", "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('account_payable')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });
   
}

$('#ap_type').change(function(){
    var ap_type = $('#ap_type').val();
    
    if(ap_type == '1'){
        $('#job_order_field').show();
    }
    else{
        $('#tamdet').hide();
        $('#job_order_field').hide();
        $('#do_jo_no').val('');
        bersihDO_AP();
    }
    
    $.ajax({
        type: "POST",
        url : "<?php echo base_url('account_payable/get_data_supplier'); ?>",
		data: "ap_type="+ap_type+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        cache:false,
        success: function(data){
            $('#creditor_id').html(data);
            $('#creditor_id').select2('val','');
        },
		error: function(xhr, status, error) {
			document.write(xhr.responseText);
			alert(xhr.responseText);
		}
    });  
});

function addRow_DeliveryOrder_AP(){
    totrowDO++;
    var detailrow="";
    detailrow=detailrow+"<tr id='rowDo"+totrowDO+"'>";
    //onclick='cariJO(\""+totrowDO+"\");'
    detailrow=detailrow+"<td>";
    var tombolhapus="<input type='button' style='height:30px;width:30px;border:0px;background-image:url(\"<?= base_url();?>resource/images/delete.png\");background-repeat:no-repeat;' id='hapdet"+totrowDO+"'   title='Hapus Baris' value='&nbsp;' onclick='deleteDo(\"rowDo"+totrowDO+"\")' />";
    detailrow=detailrow+tombolhapus;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"<td >";
    var text1="<input class='form-control' onclick='cariJO_AP(\""+totrowDO+"\")' id='do_jo_no"+totrowDO+"' name='detailDO["+totrowDO+"][do_jo_no]'  type='text' style='text-align:right;height:30px;width:130px;background-color:white;border:solid 1px #ccc;cursor:pointer' readonly='' value=''  /><input id='jo_year"+totrowDO+"' name='detailDO["+totrowDO+"][jo_year]' type='hidden' value=''  /><input id='jo_month"+totrowDO+"' name='detailDO["+totrowDO+"][jo_month]' type='hidden' value=''  /><input id='jo_code"+totrowDO+"' name='detailDO["+totrowDO+"][jo_code]' type='hidden' value=''  /><input id='jo_fare_trip_id"+totrowDO+"' name='detailDO["+totrowDO+"][jo_fare_trip_id]' type='hidden' value=''  />";
    detailrow=detailrow+text1;
    detailrow=detailrow+"<input type='hidden' class='form-control' name='detailDO["+totrowDO+"][komisi_supir]' id='komisi_supir_"+totrowDO+"' ><input type='hidden' class='form-control' name='detailDO["+totrowDO+"][komisi_kernet]' id='komisi_kernet_"+totrowDO+"' ><input type='hidden' class='form-control' name='detailDO["+totrowDO+"][deposit]' id='deposit_"+totrowDO+"' ><input type='hidden' class='form-control' name='detailDO["+totrowDO+"][amount]' id='amount_"+totrowDO+"' ></td>";
    
    var ContainerType="<select class='form-control'  id='ContType"+totrowDO+"' name='detailDO["+totrowDO+"][ContType]' style='height:30px;width:100px;background-color:white;border:solid 1px #ccc;' /></select>";
    detailrow=detailrow+"<td>"+ContainerType+"</td>";
    
    detailrow=detailrow+"<td >";
    var text20="<input class='form-control' id='container_no"+totrowDO+"' name='detailDO["+totrowDO+"][container_no]'  type='text' style='text-align:left;height:30px;width:100px;background-color:white;border:solid 1px #ccc;'  value=''  />";
    detailrow=detailrow+text20;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"<td >";
    var text2="<input class='form-control' id='do_no"+totrowDO+"' name='detailDO["+totrowDO+"][do_no]'  type='text' style='text-align:left;height:30px;width:100px;background-color:white;border:solid 1px #ccc;'  value='' title='Use semicolon (,) for more DO No'  />";
    detailrow=detailrow+text2;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"<td >";
    var text3="<input  class='form-control' id='do_date"+totrowDO+"' name='detailDO["+totrowDO+"][do_date]'  type='text' style='text-align:left;height:30px;width:100px;background-color:white;border:solid 1px #ccc;'  value=''  />";
    detailrow=detailrow+text3;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"<td >";
    var text4="<input class='form-control' id='do_weight"+totrowDO+"' name='detailDO["+totrowDO+"][do_weight]' type='text' style='text-align:right;height:30px;width:80px;background-color:white;border:solid 1px #ccc;'  value='0' maxlength='6' />";
    detailrow=detailrow+text4;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"<td >";
    var text4="<input class='form-control' id='received_weight"+totrowDO+"' name='detailDO["+totrowDO+"][received_weight]' type='text' style='text-align:right;height:30px;width:80px;background-color:white;border:solid 1px #ccc;'  value='0' maxlength='6' />";
    detailrow=detailrow+text4;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"<td >";
    var text4="<input  class='form-control' id='received_date"+totrowDO+"' name='detailDO["+totrowDO+"][received_date]'  type='text' style='text-align:right;height:30px;width:100px;background-color:white;border:solid 1px #ccc;'  value=''  />";
    detailrow=detailrow+text4;
    detailrow=detailrow+"</td>";

    detailrow=detailrow+"<td >";
    var text4="<input class='form-control' id='amount_ap"+totrowDO+"' name='detailDO["+totrowDO+"][amount_ap]'  type='text' style='text-align:right;height:30px;width:120px;background-color:white;border:solid 1px #ccc;'  value='' onkeyup='sumAmountAP()' readonly /> <input type='hidden' id='wholesale"+totrowDO+"' name='detailDO["+totrowDO+"][wholesale]' /> <input type='hidden' id='price_amount"+totrowDO+"' name='detailDO["+totrowDO+"][price_amount]' />  <input type='hidden' id='price_20ft"+totrowDO+"' name='detailDO["+totrowDO+"][price_20ft]' />  <input type='hidden' id='price_40ft"+totrowDO+"' name='detailDO["+totrowDO+"][price_40ft]' />  <input type='hidden' id='price_45ft"+totrowDO+"' name='detailDO["+totrowDO+"][price_45ft]' />";
    detailrow=detailrow+text4;
    detailrow=detailrow+"</td>";
                
    detailrow=detailrow+"</tr>";
    $('#detail_DO tr:last').after(
        detailrow
    );
    
    $("#do_date"+totrowDO).datepicker({
    	format: 'dd-mm-yyyy'
    }).on('changeDate',function(ev){
        $("#do_date"+totrowDO).datepicker('hide');
	});
    
    $("#received_date"+totrowDO).datepicker({
    	format: 'dd-mm-yyyy'
    }).on('changeDate',function(ev){
        $("#received_date"+totrowDO).datepicker('hide');
	});
    
    $('#amount_ap'+totrowDO).mask('000.000.000', {reverse: true});
    $('#do_weight'+totrowDO).mask('000.000.000', {reverse: true});
    $('#received_weight'+totrowDO).mask('000.000.000', {reverse: true});
    
    document.getElementById("ContType"+totrowDO).innerHTML=document.getElementById("ContType").innerHTML;

}

function addNewRow_DeliveryOrder_AP(){
    totrowDO++;
    var detailrow="";
    detailrow=detailrow+"<tr id='rowDo"+totrowDO+"'>";
    //onclick='cariJO(\""+totrowDO+"\");'
    detailrow=detailrow+"<td>";
    var tombolhapus="<input type='button' style='height:30px;width:30px;border:0px;background-image:url(\"<?= base_url();?>resource/images/delete.png\");background-repeat:no-repeat;' id='hapdet"+totrowDO+"'   title='Hapus Baris' value='&nbsp;' onclick='deleteDo(\"rowDo"+totrowDO+"\")' />";
    detailrow=detailrow+tombolhapus;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"<td >";
    var text1="<input class='form-control' id='do_jo_no"+totrowDO+"' name='detailDO["+totrowDO+"][do_jo_no]' type='text' style='text-align:right;height:30px;width:130px;background-color:#fff;' readonly='' value='' /><input id='jo_year"+totrowDO+"' name='detailDO["+totrowDO+"][jo_year]' type='hidden' value=''  /><input id='jo_month"+totrowDO+"' name='detailDO["+totrowDO+"][jo_month]' type='hidden' value=''  /><input id='jo_code"+totrowDO+"' name='detailDO["+totrowDO+"][jo_code]' type='hidden' value=''  /><input id='jo_fare_trip_id"+totrowDO+"' name='detailDO["+totrowDO+"][jo_fare_trip_id]' type='hidden' value=''  />";
    detailrow=detailrow+text1;
    detailrow=detailrow+"<input type='hidden' class='form-control' name='detailDO["+totrowDO+"][komisi_supir]' id='komisi_supir_"+totrowDO+"' ><input type='hidden' class='form-control' name='detailDO["+totrowDO+"][komisi_kernet]' id='komisi_kernet_"+totrowDO+"' ><input type='hidden' class='form-control' name='detailDO["+totrowDO+"][deposit]' id='deposit_"+totrowDO+"' ><input type='hidden' class='form-control' name='detailDO["+totrowDO+"][amount]' id='amount_"+totrowDO+"' ></td>";
    
    var ContainerType="<select class='form-control'  id='ContType"+totrowDO+"' name='detailDO["+totrowDO+"][ContType]' style='height:30px;width:100px;background-color:white;border:solid 1px #ccc;' /></select>";
    detailrow=detailrow+"<td>"+ContainerType+"</td>";
    
    detailrow=detailrow+"<td >";
    var text20="<input class='form-control' id='container_no"+totrowDO+"' name='detailDO["+totrowDO+"][container_no]'  type='text' style='text-align:left;height:30px;width:100px;background-color:white;border:solid 1px #ccc;'  value=''  />";
    detailrow=detailrow+text20;
    detailrow=detailrow+"</td>";

    detailrow=detailrow+"<td >";
    var text3="<input  class='form-control'  id='police_no"+totrowDO+"' name='detailDO["+totrowDO+"][police_no]'  type='text' style='text-align:left;height:30px;width:100px;background-color:white;border:solid 1px #ccc;'  value='' maxlength='15' />";
    detailrow=detailrow+text3;
    detailrow=detailrow+"</td>";

    detailrow=detailrow+"<td><div class='col-md-9' style='padding:0px 15px 0px 0px'>";
    var text2="<input class='form-control' id='do_no"+totrowDO+"' name='detailDO["+totrowDO+"][do_no]'  type='text' style='text-align:left;height:30px;width:150px;background-color:white;border:solid 1px #ccc;'  value='' title='Use semicolon (,) for more DO No'  /></div>";
    detailrow=detailrow+text2;
    var do_no_tmp="<input class='form-control' id='do_no_tmp"+totrowDO+"' name='detailDO["+totrowDO+"][do_no_tmp]'  type='hidden' value='' />";
    detailrow=detailrow+do_no_tmp;
    var button_search="<div class='col-md-3' style='padding-left:15px'><button type='button' class='btn btn-sm btn-info' id='button_search"+totrowDO+"' onclick='showModalDO("+totrowDO+");' title='Search DO' ><i class='fa fa-search'></i></button></div>";
    detailrow=detailrow+button_search;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"<td >";
    var text3="<input  class='form-control'  id='do_date"+totrowDO+"' name='detailDO["+totrowDO+"][do_date]'  type='text' style='text-align:left;height:30px;width:100px;background-color:white;border:solid 1px #ccc;'  value=''  />";
    detailrow=detailrow+text3;
    detailrow=detailrow+"</td>";
        
    detailrow=detailrow+"<td >";
    var text4="<input class='form-control' id='do_weight"+totrowDO+"' name='detailDO["+totrowDO+"][do_weight]' onkeyup='IsNumericOnly(this);' type='text' style='text-align:right;height:30px;width:80px;background-color:white;border:solid 1px #ccc;'  value='0' maxlength='10' />";
    detailrow=detailrow+text4;
    detailrow=detailrow+"</td>";

    detailrow=detailrow+"<td >";
    var text4="<input  class='form-control' id='received_date"+totrowDO+"' name='detailDO["+totrowDO+"][received_date]'  type='text' style='text-align:right;height:30px;width:100px;background-color:white;border:solid 1px #ccc;'  value=''  />";
    detailrow=detailrow+text4;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"<td >";
    var text4="<input class='form-control' id='received_weight"+totrowDO+"' name='detailDO["+totrowDO+"][received_weight]' onkeyup='IsNumericOnly(this);' type='text' style='text-align:right;height:30px;width:80px;background-color:white;border:solid 1px #ccc;'  value='0' maxlength='10' />";
    detailrow=detailrow+text4;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"<td >";
    var text4="<input class='form-control' id='amount_ap"+totrowDO+"' name='detailDO["+totrowDO+"][amount_ap]'  type='text' style='text-align:right;height:30px;width:120px;background-color:white;border:solid 1px #ccc;'  value='' onkeyup='sumAmountAP()' readonly /> <input type='hidden' id='wholesale"+totrowDO+"' name='detailDO["+totrowDO+"][wholesale]' /> <input type='hidden' id='price_amount"+totrowDO+"' name='detailDO["+totrowDO+"][price_amount]' />  <input type='hidden' id='price_20ft"+totrowDO+"' name='detailDO["+totrowDO+"][price_20ft]' />  <input type='hidden' id='price_40ft"+totrowDO+"' name='detailDO["+totrowDO+"][price_40ft]' />  <input type='hidden' id='price_45ft"+totrowDO+"' name='detailDO["+totrowDO+"][price_45ft]' />";
    detailrow=detailrow+text4;
    detailrow=detailrow+"</td>";
                
    detailrow=detailrow+"</tr>";
    $('#detail_DO tr:last').after(
        detailrow
    );
    
    $("#do_date"+totrowDO).datepicker({
    	format: 'dd-mm-yyyy'
    }).on('changeDate',function(ev){
        $("#do_date"+totrowDO).datepicker('hide');
	});
    
    $("#received_date"+totrowDO).datepicker({
    	format: 'dd-mm-yyyy'
    }).on('changeDate',function(ev){
        $("#received_date"+totrowDO).datepicker('hide');
	});
    
    $('#amount_ap'+totrowDO).mask('000.000.000', {reverse: true});
     
    document.getElementById("ContType"+totrowDO).innerHTML=document.getElementById("ContType").innerHTML;
    
    $('#do_jo_no'+totrowDO).val($('#do_jo_no').val());  // No JO
    $('#jo_year'+totrowDO).val($('#jo_year').val());   // JO Year
    $('#jo_month'+totrowDO).val($('#jo_month').val());  // JO Month
    $('#jo_code'+totrowDO).val($('#jo_code').val());
    $('#jo_fare_trip_id'+totrowDO).val($('#jo_fare_trip_id').val());
    $('#price_amount'+totrowDO).val($('#price_amount').val());
    $('#wholesale'+totrowDO).val($('#wholesale').val());
    $('#price_20ft'+totrowDO).val($('#price_20ft').val());
    $('#price_40ft'+totrowDO).val($('#price_40ft').val());
    $('#price_45ft'+totrowDO).val($('#price_45ft').val());
    
    if($('#jo_type').val() == '1'){
        $('#ContType'+totrowDO).val('');    
        $('#container_no'+totrowDO).val('');                                    

        $('#ContType'+totrowDO).prop('disabled',true);    
        $('#container_no'+totrowDO).prop('disabled',true);                                    
    }
    else{
        $('#ContType'+totrowDO).val('');    
        $('#container_no'+totrowDO).val('');                                    

        $('#ContType'+totrowDO).prop('disabled',false);    
        $('#container_no'+totrowDO).prop('disabled',false);        
    }
    
    if($('#jo_type').val() == '1' || $('#jo_type').val() == '3'){
        if($('#wholesale'+totrowDO).val() == '1'){
            $('#amount_ap'+totrowDO).val(tandaPemisahTitik($('#price_amount'+totrowDO).val()));
        }
        else{
            $('#received_weight'+totrowDO).attr('onkeyup','IsNumericOnly(this);setPriceAmount('+totrowDO+')');
            $('#received_weight'+totrowDO).attr('onfocus','setPriceAmount('+totrowDO+')');
            $('#amount_ap'+totrowDO).val(tandaPemisahTitik($('#price_amount'+totrowDO).val()));
        }
    }
    else{ // Container
        if($('#wholesale'+totrowDO).val() == '1'){
            $('#amount_ap'+totrowDO).val(tandaPemisahTitik($('#price_amount'+totrowDO).val()));
        }
        else{
            $('#received_weight'+totrowDO).attr('onkeyup','IsNumericOnly(this);');
            $('#received_weight'+totrowDO).attr('onfocus','');
            $('#amount_ap'+totrowDO).val(tandaPemisahTitik($('#price_20ft'+totrowDO).val()));
            $('#ContType'+totrowDO).val('20');
            $('#ContType'+totrowDO).attr('onchange','setContainerPriceAmount('+totrowDO+')');
            
        }
    }
    
    $('#received_weight'+totrowDO).focus();

    sumAmountAP();
}

function addNewRow_DeliveryOrder_AP_For_Invoice(){
    totrowDO++;
    var detailrow="";
    detailrow=detailrow+"<tr id='rowDo"+totrowDO+"'>";
    //onclick='cariJO(\""+totrowDO+"\");'
    detailrow=detailrow+"<td>";
    var tombolhapus="<input type='button' style='height:30px;width:30px;border:0px;background-image:url(\"<?= base_url();?>resource/images/delete.png\");background-repeat:no-repeat;' id='hapdet"+totrowDO+"'   title='Hapus Baris' value='&nbsp;' onclick='deleteDo(\"rowDo"+totrowDO+"\")' />";
    detailrow=detailrow+tombolhapus;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"<td >";
    var text1="<input class='form-control' id='do_jo_no"+totrowDO+"' name='detailDO["+totrowDO+"][do_jo_no]' type='text' style='text-align:right;height:30px;width:130px;background-color:#fff;' readonly='' value='' /><input id='jo_year"+totrowDO+"' name='detailDO["+totrowDO+"][jo_year]' type='hidden' value=''  /><input id='jo_month"+totrowDO+"' name='detailDO["+totrowDO+"][jo_month]' type='hidden' value=''  /><input id='jo_code"+totrowDO+"' name='detailDO["+totrowDO+"][jo_code]' type='hidden' value=''  /><input id='jo_fare_trip_id"+totrowDO+"' name='detailDO["+totrowDO+"][jo_fare_trip_id]' type='hidden' value=''  />";
    detailrow=detailrow+text1;
    detailrow=detailrow+"<input type='hidden' class='form-control' name='detailDO["+totrowDO+"][komisi_supir]' id='komisi_supir_"+totrowDO+"' ><input type='hidden' class='form-control' name='detailDO["+totrowDO+"][komisi_kernet]' id='komisi_kernet_"+totrowDO+"' ><input type='hidden' class='form-control' name='detailDO["+totrowDO+"][deposit]' id='deposit_"+totrowDO+"' ><input type='hidden' class='form-control' name='detailDO["+totrowDO+"][amount]' id='amount_"+totrowDO+"' ></td>";
    
    var ContainerType="<select class='form-control'  id='ContType"+totrowDO+"' name='detailDO["+totrowDO+"][ContType]' style='height:30px;width:100px;background-color:white;border:solid 1px #ccc;' /></select>";
    detailrow=detailrow+"<td>"+ContainerType+"</td>";
    
    detailrow=detailrow+"<td >";
    var text20="<input class='form-control' id='container_no"+totrowDO+"' name='detailDO["+totrowDO+"][container_no]'  type='text' style='text-align:left;height:30px;width:100px;background-color:white;border:solid 1px #ccc;'  value=''  />";
    detailrow=detailrow+text20;
    detailrow=detailrow+"</td>";

    detailrow=detailrow+"<td >";
    var text3="<input  class='form-control'  id='police_no"+totrowDO+"' name='detailDO["+totrowDO+"][police_no]'  type='text' style='text-align:left;height:30px;width:100px;background-color:white;border:solid 1px #ccc;'  value='' maxlength='15' />";
    detailrow=detailrow+text3;
    detailrow=detailrow+"</td>";

    detailrow=detailrow+"<td><div class='col-md-9' style='padding:0px 15px 0px 0px'>";
    var text2="<input class='form-control' id='do_no"+totrowDO+"' name='detailDO["+totrowDO+"][do_no]'  type='text' style='text-align:left;height:30px;width:150px;background-color:white;border:solid 1px #ccc;'  value='' title='Use semicolon (,) for more DO No'  /></div>";
    detailrow=detailrow+text2;
    var do_no_tmp="<input class='form-control' id='do_no_tmp"+totrowDO+"' name='detailDO["+totrowDO+"][do_no_tmp]'  type='hidden' value='' />";
    detailrow=detailrow+do_no_tmp;
    var button_search="<div class='col-md-3' style='padding-left:15px'><button type='button' class='btn btn-sm btn-info' id='button_search"+totrowDO+"' onclick='showModalDO("+totrowDO+");' title='Search DO' ><i class='fa fa-search'></i></button></div>";
    detailrow=detailrow+button_search;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"<td >";
    var text3="<input  class='form-control'  id='do_date"+totrowDO+"' name='detailDO["+totrowDO+"][do_date]'  type='text' style='text-align:left;height:30px;width:100px;background-color:white;border:solid 1px #ccc;'  value=''  />";
    detailrow=detailrow+text3;
    detailrow=detailrow+"</td>";
        
    detailrow=detailrow+"<td >";
    var text4="<input class='form-control' id='do_weight"+totrowDO+"' name='detailDO["+totrowDO+"][do_weight]' onkeyup='IsNumericOnly(this);' type='text' style='text-align:right;height:30px;width:80px;background-color:white;border:solid 1px #ccc;'  value='0' maxlength='10' />";
    detailrow=detailrow+text4;
    detailrow=detailrow+"</td>";

    detailrow=detailrow+"<td >";
    var text4="<input  class='form-control' id='received_date"+totrowDO+"' name='detailDO["+totrowDO+"][received_date]' type='text' style='text-align:right;height:30px;width:100px;background-color:white;border:solid 1px #ccc;'  value=''  />";
    detailrow=detailrow+text4;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"<td >";
    var text4="<input class='form-control' id='received_weight"+totrowDO+"' name='detailDO["+totrowDO+"][received_weight]' onkeyup='IsNumericOnly(this);' type='text' style='text-align:right;height:30px;width:80px;background-color:white;border:solid 1px #ccc;'  value='0' maxlength='10' />";
    detailrow=detailrow+text4;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"<td >";
    var text4="<input class='form-control' id='amount_ap"+totrowDO+"' name='detailDO["+totrowDO+"][amount]'  type='text' style='text-align:right;height:30px;width:120px;background-color:white;border:solid 1px #ccc;'  value='' onkeyup='sumAmountAP()' readonly /> <input type='hidden' id='wholesale"+totrowDO+"' name='detailDO["+totrowDO+"][wholesale]' /> <input type='hidden' id='price_amount"+totrowDO+"' name='detailDO["+totrowDO+"][price_amount]' />  <input type='hidden' id='price_20ft"+totrowDO+"' name='detailDO["+totrowDO+"][price_20ft]' />  <input type='hidden' id='price_40ft"+totrowDO+"' name='detailDO["+totrowDO+"][price_40ft]' />  <input type='hidden' id='price_45ft"+totrowDO+"' name='detailDO["+totrowDO+"][price_45ft]' />";
    detailrow=detailrow+text4;
    detailrow=detailrow+"</td>";
                
    detailrow=detailrow+"</tr>";
    $('#detail_DO tr:last').after(
        detailrow
    );
    
    $("#do_date"+totrowDO).datepicker({
    	format: 'dd-mm-yyyy'
    }).on('changeDate',function(ev){
        $("#do_date"+totrowDO).datepicker('hide');
	});
    
    $("#received_date"+totrowDO).datepicker({
    	format: 'dd-mm-yyyy'
    }).on('changeDate',function(ev){
        $("#received_date"+totrowDO).datepicker('hide');
	});
    
    $('#amount_ap'+totrowDO).mask('000.000.000', {reverse: true});
    
    document.getElementById("ContType"+totrowDO).innerHTML=document.getElementById("ContType").innerHTML;
    
    $('#do_jo_no'+totrowDO).val($('#jo_no').val());  // No JO
    $('#jo_year'+totrowDO).val($('#jo_year').val());   // JO Year
    $('#jo_month'+totrowDO).val($('#jo_month').val());  // JO Month
    $('#jo_code'+totrowDO).val($('#jo_code').val());
    $('#jo_fare_trip_id'+totrowDO).val($('#jo_fare_trip_id').val());
    $('#price_amount'+totrowDO).val($('#price_amount').val());
    $('#wholesale'+totrowDO).val($('#wholesale').val());
    $('#price_20ft'+totrowDO).val($('#price_20ft').val());
    $('#price_40ft'+totrowDO).val($('#price_40ft').val());
    $('#price_45ft'+totrowDO).val($('#price_45ft').val());
    
    if($('#jo_type').val() == '1'){
        $('#ContType'+totrowDO).val('');    
        $('#container_no'+totrowDO).val('');                                    

        $('#ContType'+totrowDO).prop('disabled',true);    
        $('#container_no'+totrowDO).prop('disabled',true);                                    
    }
    else{
        $('#ContType'+totrowDO).val('');    
        $('#container_no'+totrowDO).val('');                                    

        $('#ContType'+totrowDO).prop('disabled',false);    
        $('#container_no'+totrowDO).prop('disabled',false);        
    }
    
    if($('#jo_type').val() == '1' || $('#jo_type').val() == '3'){
        if($('#wholesale'+totrowDO).val() == '1'){
            $('#amount_ap'+totrowDO).val(tandaPemisahTitik($('#price_amount'+totrowDO).val()));
        }
        else{
            $('#received_weight'+totrowDO).attr('onkeyup','IsNumericOnly(this);setPriceAmount_For_Invoice('+totrowDO+')');
            $('#received_weight'+totrowDO).attr('onfocus','setPriceAmount_For_Invoice('+totrowDO+')');
            $('#amount_ap'+totrowDO).val(tandaPemisahTitik($('#price_amount'+totrowDO).val()));
        }
    }
    else{ // Container
        if($('#wholesale'+totrowDO).val() == '1'){
            $('#amount_ap'+totrowDO).val(tandaPemisahTitik($('#price_amount'+totrowDO).val()));
        }
        else{
            $('#received_weight'+totrowDO).attr('onkeyup','IsNumericOnly(this);');
            $('#received_weight'+totrowDO).attr('onfocus','');
            $('#amount_ap'+totrowDO).val(tandaPemisahTitik($('#price_20ft'+totrowDO).val()));
            $('#ContType'+totrowDO).val('20');
            $('#ContType'+totrowDO).attr('onchange','setContainerPriceAmount_For_Invoice('+totrowDO+')');
            
        }
    }
    
    $('#received_weight'+totrowDO).focus();
    
    sumAmountAP_For_Invoice();

}

function showDetailDeliveryOrder(trx_no){
bersihDO_AP();

$.ajax({
	type: "GET",
        url:'<?php echo base_url(); ?>account_payable/get_data_detail?trx_no='+trx_no,
		dataType:"JSON",
		success: function(result){
    		var x=0;
            var toDdMmYy = function(input) {
                var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
                if(!input || !input.match(ptrn)) {
                    return null;
                }
                return input.replace(ptrn, '$3-$2-$1');
            }; 
    		$.each(result, function(key, val) {	
        		x++;
                //addRow_DeliveryOrder_AP();
                addNewRow_DeliveryOrder_AP();
                
                $('#do_jo_no'+x).val(val.jo_no);
                $('#jo_year'+x).val(val.tr_jo_trx_hdr_year);
                $('#jo_month'+x).val(val.tr_jo_trx_hdr_month);
                $('#jo_code'+x).val(val.tr_jo_trx_hdr_code);
                $('#police_no'+x).val(val.police_no);
                $('#do_no'+x).val(val.do_no);
                $('#do_no_tmp'+x).val(val.do_no);
                $('#do_date'+x).val(toDdMmYy(val.do_date));                
                $('#do_weight'+x).val(val.deliver_weight);
                $('#received_weight'+x).val(val.received_weight);
                $('#received_date'+x).val(toDdMmYy(val.received_date));
                $('#amount_ap'+x).val(number_format(val.amount_ap,0,',','.','format'));                
                
                $('#price_amount'+x).val(val.price_amount);
                $('#wholesale'+x).val(val.wholesale);
                $('#price_20ft'+x).val(val.price_20ft);
                $('#price_40ft'+x).val(val.price_40ft);
                $('#price_45ft'+x).val(val.price_45ft);
                
                sumAmountAP();
            
                if(val.jo_type == '1'){
                    $('#ContType'+x).val('');    
                    $('#container_no'+x).val('');    
        
                    $('#ContType'+x).prop('disabled',true);    
                    $('#container_no'+x).prop('disabled',true);                                    
                }
                else{
                    $('#ContType'+x).val(val.container_size);
                    $('#container_no'+x).val(val.container_no);
        
                    $('#ContType'+x).prop('disabled',false);    
                    $('#container_no'+x).prop('disabled',false);    
                    $('#ContType'+x).attr('onchange','setContainerPriceAmount('+x+')');    
                }
                
      	     });

        }
        
   });

}

function showDetailDeliveryOrder_For_Invoice(trx_no,status){
bersihDO_AP();

$.ajax({
	type: "GET",
        url:'<?php echo base_url(); ?>invoice/get_data_detail_do_manual?trx_no='+trx_no,
		dataType:"JSON",
		success: function(result){
    		var x=0;
            
            var toDdMmYy = function(input) {
                var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
                if(!input || !input.match(ptrn)) {
                    return null;
                }
                return input.replace(ptrn, '$3-$2-$1');
            }; 
            
    		$.each(result, function(key, val) {	
        		x++;

                addNewRow_DeliveryOrder_AP_For_Invoice();
                
                $('#do_jo_no'+x).val(val.jo_no);
                $('#jo_year'+x).val(val.tr_jo_trx_hdr_year);
                $('#jo_month'+x).val(val.tr_jo_trx_hdr_month);
                $('#jo_code'+x).val(val.tr_jo_trx_hdr_code);
                $('#police_no'+x).val(val.police_no);
                $('#do_no'+x).val(val.do_no);
                $('#do_no_tmp'+x).val(val.do_no);
                $('#do_date'+x).val(toDdMmYy(val.do_date));                
                $('#do_weight'+x).val(number_format(val.deliver_weight,0,',','.','format'));
                $('#received_weight'+x).val(number_format(val.received_weight,0,',','.','format'));
                $('#received_date'+x).val(toDdMmYy(val.received_date));
                
                $('#price_amount'+x).val(val.price_amount);
                $('#wholesale'+x).val(val.wholesale);
                $('#price_20ft'+x).val(val.price_20ft);
                $('#price_40ft'+x).val(val.price_40ft);
                $('#price_45ft'+x).val(val.price_45ft);
                
                var amount_ap_dtl = 0;
                if(val.jo_type == '1'){
                    $('#ContType'+x).val('');    
                    $('#container_no'+x).val('');    
                    
                    amount_ap_dtl = parseFloat(val.received_weight * val.price_amount)
                    
                    $('#ContType'+x).prop('disabled',true);    
                    $('#container_no'+x).prop('disabled',true);                                    
                }
                else{
                    $('#ContType'+x).val(val.container_size);
                    $('#container_no'+x).val(val.container_no);
                    
                    amount_ap_dtl = val.amount;
                    
                    $('#ContType'+x).prop('disabled',false);    
                    $('#container_no'+x).prop('disabled',false);    
                    $('#ContType'+x).attr('onchange','setContainerPriceAmount_For_Invoice('+x+')');    
                }
                
                $('#amount_ap'+x).val(number_format(amount_ap_dtl,0,',','.','format'));                
                                
                sumAmountAP_For_Invoice();
                
                if(status == 'delete'){
                    $('#hapdet'+x).hide();       
                    $('#do_jo_no'+x).attr('readonly',true);
                    $('#jo_year'+x).attr('readonly',true);
                    $('#jo_month'+x).attr('readonly',true);
                    $('#jo_code'+x).attr('readonly',true);
                    $('#ContType'+x).prop('disabled',true);
                    $('#police_no'+x).attr('readonly',true);
                    $('#do_no'+x).attr('readonly',true);
                    $('#do_date'+x).attr('readonly',true);
                    $('#do_weight'+x).attr('readonly',true);
                    $('#received_weight'+x).attr('readonly',true);
                    $('#received_date'+x).attr('readonly',true);
                    $('#amount_ap'+x).attr('readonly',true);
                    $('#price_amount'+x).attr('readonly',true);
                    $('#wholesale'+x).attr('readonly',true);
                    $('#price_20ft'+x).attr('readonly',true);
                    $('#price_40ft'+x).attr('readonly',true);
                    $('#price_45ft'+x).attr('readonly',true);
                
                }
                                
      	     });

        }
        
   });

}

function cariJO_AP(row){
    document.getElementById("tag").value=row;
        
    if($('#do_jo_no'+ row).val() == ''){
        $('#joModal').modal('show');
        
        $('#tbl-joborder').DataTable().destroy();
        var table = $('#tbl-joborder').DataTable({
            "aaSorting": [[0, 'desc']],
    		"bProcessing": true,
            "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            "sPaginationType": "full_numbers",
            "columnDefs": [
                {
                    "targets": [ 10 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 11 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 12 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 13 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 14 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 15 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 16 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 17 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 18 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 19 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 20 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 21 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 22 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 23 ],
                    "visible": false,
                    "searchable": false
                }
            ]
            
    	});
        
         x=document.getElementById("tag").value;
         $('#tbl-joborder tbody').on('click', 'tr', function () {
            var data = table.row( this ).data();
            $('#do_jo_no'+x).val(data[0]);  // No JO
            $('#jo_year'+x).val(data[12]);   // JO Year
            $('#jo_month'+x).val(data[13]);  // JO Month
            $('#jo_code'+x).val(data[14]);
            $('#jo_fare_trip_id'+x).val(data[15]);
            $('#jo_type').val(data[18]);
            $('#price_amount'+x).val(data[19]);
            $('#wholesale'+x).val(data[20]);
            $('#price_20ft'+x).val(data[21]);
            $('#price_40ft'+x).val(data[22]);
            $('#price_45ft'+x).val(data[23]);
            
            if($('#jo_type').val() == '1'){
                $('#ContType'+x).val('');    
                $('#container_no'+x).val('');                                    
    
                $('#ContType'+x).prop('disabled',true);    
                $('#container_no'+x).prop('disabled',true);                                    
            }
            else{
                $('#ContType'+x).val('');    
                $('#container_no'+x).val('');                                    
    
                $('#ContType'+x).prop('disabled',false);    
                $('#container_no'+x).prop('disabled',false);        
            }
            
            if($('#jo_type').val() == '1' || $('#jo_type').val() == '3'){
                if($('#wholesale'+x).val() == '1'){
                    $('#amount_ap'+x).val(tandaPemisahTitik($('#price_amount'+x).val()));
                }
                else{
                    $('#received_weight'+x).attr('onkeyup','setPriceAmount('+x+')');
                    $('#amount_ap'+x).val(tandaPemisahTitik($('#price_amount'+x).val()));
                }
            }
            else{ // Container
                if($('#wholesale'+x).val() == '1'){
                    $('#amount_ap'+x).val(tandaPemisahTitik($('#price_amount'+x).val()));
                }
                else{
                    $('#received_weight'+x).attr('onkeyup','');
                    $('#amount_ap'+x).val(tandaPemisahTitik($('#price_20ft'+x).val()));
                    $('#ContType'+x).val('20');
                    $('#ContType'+x).attr('onchange','setContainerPriceAmount('+x+')');
                    
                }
            }
            
            $('#joModal').modal('hide');
            document.getElementById("tag").value='';
        });
      $('.modal-title').text('<?=lang('job_orders')?>'); 
    }
}

function selectJO_AP(){
    if($('#row_id').val() == '')
        bersihDO_AP();

    $('#joModal').modal('show');
    
    $('#tbl-joborder').DataTable().destroy();
    var table = $('#tbl-joborder').DataTable({
        "aaSorting": [[0, 'desc']],
		"bProcessing": true,
        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "sPaginationType": "full_numbers",
        "columnDefs": [
            {
                "targets": [ 10 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 11 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 12 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 13 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 14 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 15 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 16 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 17 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 18 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 19 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 20 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 21 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 22 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 23 ],
                "visible": false,
                "searchable": false
            }
        ]
        
	});
    
     x=document.getElementById("tag").value;
     $('#tbl-joborder tbody').on('click', 'tr', function () {
        var data = table.row( this ).data();
        $('#do_jo_no').val(data[0]);  // No JO
        $('#jo_year').val(data[12]);   // JO Year
        $('#jo_month').val(data[13]);  // JO Month
        $('#jo_code').val(data[14]);
        $('#jo_fare_trip_id').val(data[15]);
        $('#jo_type').val(data[18]);
        $('#price_amount').val(data[19]);
        $('#wholesale').val(data[20]);
        $('#price_20ft').val(data[21]);
        $('#price_40ft').val(data[22]);
        $('#price_45ft').val(data[23]);
        
        $('#tamdet').show();
        
        $('#joModal').modal('hide');
        document.getElementById("tag").value='';
    });
    $('.modal-job-title').text('Job Order List'); 

}

function selectJO_AP_For_Invoice(){
    if($('#row_id').val() == '')
        bersihDO_AP();
    
    $('#joModal').modal('show');
    
    $('#tbl-joborder').DataTable().destroy();
    var table = $('#tbl-joborder').DataTable({
        "aaSorting": [[0, 'desc']],
		"bProcessing": true,
        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "sPaginationType": "full_numbers",
        "columnDefs": [
            {
                "targets": [ 10 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 11 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 12 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 13 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 14 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 15 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 16 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 17 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 18 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 19 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 20 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 21 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 22 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 23 ],
                "visible": false,
                "searchable": false
            }
        ]
        
	});
    
     x=document.getElementById("tag").value;
     $('#tbl-joborder tbody').on('click', 'tr', function () {
        var data = table.row( this ).data();
        $('#jo_no').val(data[0]);  // No JO
        $('#jo_year').val(data[12]);   // JO Year
        $('#jo_month').val(data[13]);  // JO Month
        $('#jo_code').val(data[14]);
        $('#jo_fare_trip_id').val(data[15]);
        $('#jo_type').val(data[18]);
        $('#price_amount').val(data[19]);
        $('#wholesale').val(data[20]);
        $('#price_20ft').val(data[21]);
        $('#price_40ft').val(data[22]);
        $('#price_45ft').val(data[23]);
        
        $('#tamdet').show();
        
        $('#joModal').modal('hide');
        document.getElementById("tag").value='';
    });
    $('.modal-job-title').text('Job Order List'); 

}

function setPriceAmount(x){
    
    var qty = number_format($('#received_weight'+x).val(),0,',','.','deformat');
    if($('#received_weight'+x).val() == '')
        qty = 1;
        
    var amount = $('#price_amount'+x).val();
    var amount_ap = parseFloat(qty) * parseFloat(amount);
    
    $('#amount_ap'+x).val(number_format(amount_ap,0,',','.','format'));
    
    sumAmountAP();
}

function setPriceAmount_For_Invoice(x){
    
    var qty = number_format($('#received_weight'+x).val(),0,',','.','deformat');
    if($('#received_weight'+x).val() == '')
        qty = 1;
        
    var amount = $('#price_amount'+x).val();
    var amount_ap = parseFloat(qty) * parseFloat(amount);
    
    $('#amount_ap'+x).val(number_format(amount_ap,0,',','.','format'));
    
    sumAmountAP_For_Invoice();
}

function setContainerPriceAmount(x){
    if($('#ContType'+x).val() == '20')
        $('#amount_ap'+x).val(tandaPemisahTitik($('#price_20ft'+x).val()));    
    else if($('#ContType'+x).val() == '40')
        $('#amount_ap'+x).val(tandaPemisahTitik($('#price_40ft'+x).val()));    
    else if($('#ContType'+x).val() == '45')
        $('#amount_ap'+x).val(tandaPemisahTitik($('#price_45ft'+x).val()));    
    
    sumAmountAP();
    
}

function setContainerPriceAmount_For_Invoice(x){
    if($('#ContType'+x).val() == '20')
        $('#amount_ap'+x).val(tandaPemisahTitik($('#price_20ft'+x).val()));    
    else if($('#ContType'+x).val() == '40')
        $('#amount_ap'+x).val(tandaPemisahTitik($('#price_40ft'+x).val()));    
    else if($('#ContType'+x).val() == '45')
        $('#amount_ap'+x).val(tandaPemisahTitik($('#price_45ft'+x).val()));    
    
    sumAmountAP_For_Invoice();
    $('#amount_invo1').prop('readonly',true);   
    $('#hapdetInvoice1').hide();
}

function clearTextTotal(){
    var value = $('#total_amt').val();
    var total_amt = number_format(value,0,',','.','deformat');
    
    if(total_amt == 0){
        $('#total_amt').val('');    
    }
    
    sumAmountAP();
}

function setBaseAmount(){
    var value = $('#total_amt').val();
    var total_amt = number_format(value,0,',','.','deformat');
    
    if(value == '' || value == null)
        total_amt = 0;
    
    var base_amt = parseInt(total_amt) / 1.1;        
    var tax_amt = total_amt - base_amt;        
        
    $('#base_amt').val(number_format(base_amt,0,',','.','format'));
    $('#tax_amt').val(number_format(tax_amt,0,',','.','format'));
    
    $('#cekDa').attr('checked',false);
    
    sumAmountAP();
}

function taxTrue(){
    var value = $('#total_amt').val();
    var total_amt = number_format(value,0,',','.','deformat');
    
    if(value == '' || value == null)
        total_amt = 0;
    
    if (!$('#cekDa').is(':checked',true)) {
        var base_amt = total_amt / 1.1;
        var tax_amt = total_amt - base_amt;        
        
        $('#base_amt').val(number_format(base_amt,0,',','.','format'));
        $('#tax_amt').val(number_format(tax_amt,0,',','.','format'));
    }
    else{
        $('#base_amt').val(number_format(total_amt,0,',','.','format'));
        $('#tax_amt').val(0);
    }

    sumAmountAP();
}

function sumAmountAP(){
    var looprows=totrowDO+1;
    var totNil=0;
    
    for(z=1;z<looprows; z++){  
        if(document.getElementById('amount_ap'+z)!=null  ){
            if(document.getElementById('amount_ap'+z).value!="" ){
                var nilai=number_format(document.getElementById('amount_ap'+z).value,0,',','.','deformat');
                totNil +=parseInt(nilai);

            }
        }
    }
    
    $('#total_ap').val(tandaPemisahTitik(totNil));   
    
    var base_amt = number_format($('#base_amt').val(),0,',','.','deformat');
    
    if($('#base_amt').val() == '' || $('#base_amt').val() == null)
        base_amt = 0;
        
    var total_diff = base_amt - totNil;
    
    $('#total_diff').val(tandaPemisahTitik(total_diff));   
    
}

function sumAmountAP_For_Invoice(){
    var looprows=totrowDO+1;
    var totNil=0;
    
    for(z=1;z<looprows; z++){  
        if(document.getElementById('amount_ap'+z)!=null){
            if(document.getElementById('amount_ap'+z).value!=""){
                var nilai=number_format(document.getElementById('amount_ap'+z).value,0,',','.','deformat');
                totNil +=parseInt(nilai);

            }
        }
    }
    
    $('#amount_invo1').val(tandaPemisahTitik(totNil));   
    autoTax("1");
    
}

function setComeBack(){
    var ap_date = $("#ap_date").val().split("-");
    var result = new Date(ap_date[2], ap_date[1] - 1, ap_date[0]);
    result.setDate(result.getDate() + 30);
    
    var year=result.getYear();
        if (year < 1000) year+=1900;
    var month=result.getMonth();
        month += 1;
        if (month<10) month='0'+month;
    var day=result.getDate();
        if (day<10) day='0'+day;
    
    $('#come_back').val(day+'-'+month+'-'+year);
    
}

function bersihDO_AP(){
   var y=totrowDO+1;
   for(x=0;x<y;x++){
        if(document.getElementById("rowDo"+x)){
		     $("#rowDo"+x).remove(); 
       }
   }
   totrowDO=0;
}


// END Account Payable


// Generate Commission 
function view_generate_commission(){
    location.replace("<?php echo base_url('generate_commission')?>/view_generate");
}

function view_commission(comm_id){
    location.replace("<?php echo base_url('generate_commission')?>/view_commission/"+comm_id);
}

function download_detail_do(comm_no){
    location.replace("<?php echo base_url('generate_commission')?>/download_detail_do/"+comm_no);
}

function print_commission(comm_no){
    location.replace("<?php echo base_url('generate_commission')?>/print_commission/"+comm_no);
}

function delete_commission(comm_no)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
        $.ajax({
            url : "<?php echo base_url('generate_commission')?>/delete_commission/" + comm_no,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                if(data.success == true){
                    swal("Deleted!", data.msg, "success");
                    location.replace("<?php echo base_url('generate_commission')?>");
                }
                else{
                    swal("Oops!", data.msg, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}

function generate_commission(){
    var until_date = $('#until_date').val();
    
    $.ajax({
        url:'<?php echo base_url(); ?>generate_commission/generate',
        type: "POST",
        data: 'until_date='+until_date+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        //dataType: "JSON",
        success: function(data)
        {
            $('#data_commission').html(data);
            $('#save_cancel_loan').show();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error generate data", "error");
        }
    });
}

function cancel_loan(){
    location.replace("<?php echo base_url('generate_commission')?>/cancel_loan");
}

function save_loan(){
    $.ajax({
        url : "<?php echo base_url('generate_commission/save_loan')?>",
        type: "POST",
        data: $('#form').serializeArray(),
        dataType: "JSON",
        success: function(result)
        {                 	            
            if (result.success){ 
                sweetAlert('<?=lang('information')?>',''+result.msg);   
                location.replace("<?php echo base_url('generate_commission')?>");
            }else{
                sweetAlert('<?=lang('information')?>',''+result.msg); 
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error add data", "error");
        }
        
    }); 
    
}

function select_loan(i,debtor_id,max_loan){
    $('#modal_select_loan').modal('show');
    $.ajax({
        url:'<?php echo base_url(); ?>generate_commission/get_data_cash_advance/' + debtor_id,
        type: "POST",
        data: '<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        //dataType: "JSON",
        success: function(data)
        {            
            $('#row').val(i);
            $('#loan_debtorID').val(debtor_id);
            $('#max_loan_debtor').val(max_loan);
            $('#nilai_max_loan').html(tandaPemisahTitik(max_loan));
            $('#nilai_loan').html(0);
            
            $('#data_loan').html(data);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error getting data", "error");
        }
    });
}

function get_loan(){
    $.ajax({
        url:'<?php echo base_url(); ?>generate_commission/save_advance_loan',
        type: "POST",
        data: $('#form_loan').serializeArray(),
        dataType: "JSON",
        success: function(data)
        {
           $('#amount_loan_'+data.row).val(tandaPemisahTitik(data.total_loan));
           
           calculation_total_loan();
           
           $('#modal_select_loan').modal('hide');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error select loan", "error");
        }
    });
    
}

function showDetailCommission(id){
    
    $.ajax({
        type: "POST",
        url : "<?php echo base_url(); ?>generate_commission/get_detail_commission",
    	data: 'debtor_id='+id+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        dataType:"JSON",
        cache:false,
        success: function(result){
            
            $('#tbl-detail-commission').html('');

            var isi_table = '<thead>'+
                                '<th width="5%"><?=lang('no')?></th>' +
                				'<th width="10%"><?=lang('driver')?>/<?=lang('employee')?> Name</th>' +
                				'<th width="12%"><?=lang('cash_advance_no')?></th>' +
                				'<th width="13%">Cash Advance Type</th>' +
                				'<th width="15%"><?=lang('destination')?></th>' +
                				'<th width="12%"><?=lang('job_order_no')?></th>' +
                				'<th width="13%"><?=lang('delivery_order_no')?> </th>' +
                				'<th width="10%"><?=lang('komisi_supir')?></th>' +
                				'<th width="10%"><?=lang('komisi_kernet')?></th>' +
                            '</thead>';
                
            var no = 1;
            $.each(result, function(key, data) {	
                
				isi_table += '<tr>'+
                                '<td>'+no+'</td>' +
                                '<td>'+data.debtor_name+'</td>' +
                                '<td>'+data.advance_no+'</td>' +
                                '<td>'+data.advance_name+'</td>' +
                                '<td>'+data.from_name+' - '+data.to_name+'</td>' +
        						'<td>'+data.jo_no+'</td>' +
        						'<td>'+data.do_no+'</td>' +
                                '<td align="right">'+number_format(data.komisi_supir,0,',','.','format')+'</td>' +
                                '<td align="right">'+number_format(data.komisi_kernet,0,',','.','format')+'</td>' +
                             '</tr>';
			     no++;
            });  
            
                      
            $('#tbl-detail-commission').append(isi_table);   
               
            $('#tbl-detail-commission').DataTable().destroy();
            $('#tbl-detail-commission').dataTable({
        		"bProcessing": true,
                "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
                "sPaginationType": "full_numbers",
        	});
            
        },
    	error: function(xhr, status, error) {
    		document.write(xhr.responseText);
    	}
    }); 
    
    $('#modal_detail_commission').modal('show');
    
}

function check_loan(id){
    if ($('#chk_loan_'+id).is(':checked',true)) {
        $('#jumlah_loan_'+id).val(tandaPemisahTitik($('#advance_balance_'+id).val()));
    }
    else{
        $('#jumlah_loan_'+id).val(0);         
    }
    
    calculation_loan(id);
    
}

function calculation_total_loan(){
    var total_loan = 0;
    var n = parseInt($('#jumlah_data_commission').val());
    
    for(var i=1;i<=n;i++){
        var jumlah_loan = number_format($('#amount_loan_'+i).val(),0,',','.','deformat');
        total_loan += parseInt(jumlah_loan);
    }
    
    $('#total_loan').val(tandaPemisahTitik(total_loan));
   
}

function calculation_loan(x){
    var total_loan = 0;
    var n = parseInt($('#jumlah_advance').val());
    
    for(var i=1;i<=n;i++){
        var jumlah_loan = number_format($('#jumlah_loan_'+i).val(),0,',','.','deformat');
        total_loan += parseInt(jumlah_loan);
    }

    if(total_loan > parseInt($('#max_loan_debtor').val())){
        //swal("Oops!", 'Exceeds the maximum limit, the maximum loan is Rp ' + tandaPemisahTitik($('#max_loan_debtor').val()), "error");
        
        var max_loan = number_format($('#nilai_max_loan').html(),0,',','.','deformat');
        var nilai_loan = number_format($('#nilai_loan').html(),0,',','.','deformat');
        
        $('#jumlah_loan_'+x).val(tandaPemisahTitik(parseInt(max_loan) - parseInt(nilai_loan)));

        calculation_loan(x);
        
    }
    else{
        if(isNaN(total_loan)){
            total_loan = 0;
        }
        
        $('#nilai_loan').html(tandaPemisahTitik(total_loan));
    }    
}

function print_type_commission(){
    $('#departement_id').select2('val','');
    $('#driver_id').select2('val','');
    $('#part').val('1');
    
    if($('#type').val() == 'summary' || $('#type').val() == 'detail_vehicle'){
        $('#departement').hide();
        $('#driver').hide();
        $('.part').hide();
    }
    else if($('#type').val() == 'detail_do' || $('#type').val() == 'detail_field_cost'){
        $('#departement').show(); 
        $('#departement_id').select2('val','all');       
        $('#driver').hide();
        $('.part').hide();
    }
    else if($('#type').val() == 'detail_driver'){
        $('#departement').hide();
        $('#driver').show();     
        $('#driver_id').select2('val','all');     
        $('.part').show();
    }
}

function show_part_commission(){
    if($('#driver_id').val() == 'all'){
        $('.part').show();
    }
    else{
        $('.part').hide();        
    }

    $('#part').val('1');
}

// END Generate Commission 

// Verify Driver
function verify_driver(rowid,debtor_name){
    $('#modal_form').modal('show');
    $('#rowID').val(rowid);
    $('#debtor_name').val(debtor_name);
    
}

function update_queue(){
    var remark = $('#remark').val();

    var validasi="";
    
    var data1=cekValidasi(remark,'<?=lang('remark')?>','<?=lang('not_empty')?>');
    
    validasi=data1;
    
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }
    else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('verify_driver/update_queue')?>",
                    type: "POST",
                    data: $('#form').serializeArray(),
                    dataType: "JSON",
                    success: function(result)
                    {                 	            

                        if (result.success){ 
                            $('#modal_form').modal('hide');
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            location.replace("<?php echo base_url('verify_driver')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error verify data", "error");
                    }
                    
                });  
            }
        });
    }
}

function register_driver(debtor_id){    
    sweetAlert({
      title: "Are you sure?",
      text: "Are you want to register?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#286090",
      confirmButtonText: "Yes, Save !",
      closeOnConfirm: true,
      html: false
    },function(r){ 
        if (r){
              $.ajax({
                url : "<?php echo base_url('verify_driver/insert_queue')?>",
                type: "POST",
                dataType: 'json',
                data:{
                    'debtor_id' : debtor_id,
                    '<?=$this->security->get_csrf_token_name()?>' : '<?=$this->security->get_csrf_hash()?>'
                },
                success: function(data)
                {
                    sweetAlert('<?=lang('information')?>',''+data.msg); 
                    location.replace("<?php echo base_url('verify_driver')?>");
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    swal("Oops!", "Error update data", "error");
                }
            });
        }
    });
}


function set_attendance(debtor_id,absent_code){
    $('#modal_sia').modal('show');
    $('#debtor_id').val(debtor_id);
    $('#absent_code').val(absent_code);    
}

function save_attendance(){
    var note = $('#note').val();

    var validasi="";
    
    var data1=cekValidasi(note,'Note','<?=lang('not_empty')?>');
    
    validasi=data1;
    
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }
    else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('verify_driver/save_attendance')?>",
                    type: "POST",
                    data: $('#form_sia').serializeArray(),
                    dataType: "JSON",
                    success: function(result)
                    {                 	        
                        if (result.success){ 
                            $('#modal_sia').modal('hide');
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            location.replace("<?php echo base_url('verify_driver')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error verify data", "error");
                    }
                    
                });  
            }
        });
    }
}

// END Verify Driver

// AR Employee and Driver

$('#employee_type').change(function(){
    var employee_type = $('#employee_type').val();
      
    $.ajax({
        type: "POST",
        url : "<?php echo base_url('receivable_employee/get_data_debtor'); ?>",
		data: "employee_type="+employee_type+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        cache:false,
        success: function(data){
            $('#debtor_id').html(data);
            $('#debtor_id').select2('val','');
        },
		error: function(xhr, status, error) {
			document.write(xhr.responseText);
			alert(xhr.responseText);
		}
    });  
});


// END AR Employee and Driver

// User
function reset_password(user_id){
    sweetAlert({
      title: "Are you sure?",
      text: "Are you sure to reset password this user?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#286090",
      confirmButtonText: "Yes, Reset Password !",
      closeOnConfirm: true,
      html: false
    },function(r){ 
        if (r){
              $.ajax({
                url : "<?php echo base_url()?>users/account/reset_password",
                type: "POST",
                dataType: 'json',
                data:{
                    'user_id' : user_id,
                    '<?=$this->security->get_csrf_token_name()?>' : '<?=$this->security->get_csrf_hash()?>'
                },
                success: function(data)
                {
                    if(data.success == true){
                        sweetAlert('<?=lang('information')?>','Reset password successfull'); 
                        location.replace("<?php echo base_url('users/account')?>");
                    }
                    else{
                        swal("Oops!", "Reset password failed", "error");
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    swal("Oops!", "Error update data", "error");
                }
            });
        }
    });
}
// END User

// Advance
function add_advance(){
    $('#form_advance')[0].reset(); 
    $('#modal_form_advance').modal('show'); 
    $('.modal-title-advance').text('<?=lang('add_advance')?>'); 

    $('[name="rowID"]').val('');
    $('[name="advance_type_rowID"]').val('');
    $('[name="debtor_rowID"]').select2('val','');
    
    $('#dp_field').hide();
    $('#advance_type_field').show();
    $('#text_advance_type').hide();
    $('#text_advance_type').html('');
    
    document.getElementById('chk_dp').checked = false;

    $('.creditor_row').hide();
    $('[name="dp_creditor_rowID"]').select2('val','');
    
    bersih_advance();
}

function advance_pdf(){
    window.open('<?php echo base_url('advance/pdf')?>');
}

function advance_excel(){
    window.open('<?php echo base_url('advance/excel')?>');
}

function save_advance(){
    
    var date  = $('[name="date"]').val();
    var jo_no  = $('[name="jo_no"]').val();    
    var remark  = $('[name="remark"]').val();    
    var advance_type_rowID  = $('[name="advance_type_rowID"]').val();    
    
    var validasi="";
    
    var data1=cekValidasi(date,'<?=lang('date')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(advance_type_rowID,'<?=lang('advance_type')?>','<?=lang('not_empty')?>');
    var data3=cekValidasi(jo_no,'JO No / Sub JO','<?=lang('not_empty')?>');
    var data4=cekValidasi(remark,'<?=lang('remark')?>','<?=lang('not_empty')?>');
    
    validasi=data1+data2+data4;
    
    /*
    if(advance_type_rowID == '1'){
        validasi=data1+data2+data4;
    }
    else{
        validasi=data1+data2+data3+data4;  
    }
    */
     
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                if(clickSave == 0){
                    clickSave++;
                    
                    $.ajax({
                        url : "<?php echo base_url('advance/create')?>",
                        type: "POST",
                        data: $('#form_advance').serializeArray(),
                        dataType: "JSON",
                        success: function(result)
                        {  
                            if (result.success){ 
                                $('#modal_form_advance').modal('hide');
                                //swal("Save!", "Data has been Saved.", "success");
                                sweetAlert('<?=lang('information')?>',''+result.msg);   
                                location.replace("<?php echo base_url('advance')?>");
                            }else{
                                sweetAlert('<?=lang('information')?>',''+result.msg); 
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal("Oops!", "Error adding / update data", "error");
                            clickSave = 0;
                        }
                        
                    });  
                }
                else{
                    alert('<?=lang('data_in_process')?>');
                }
            }
        });
    } 
}

function print_advance(id){
    window.open('<?php echo base_url()?>advance/print_advance/'+id);
}

function edit_advance(id)
{
  $('#form_advance')[0].reset();
      $.ajax({
        url : "<?php echo base_url('advance/get_data_edit/')?>/" + id,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {
            var toDdMmYy = function(input) {
                var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
                if(!input || !input.match(ptrn)) {
                    return null;
                }
                return input.replace(ptrn, '$3-$2-$1');
            };

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('advance/get_data_expenses'); ?>",
        		data: "advance_category_rowID="+data.advance_type_rowID+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
                cache: false,
                success: function(data){
                    $('#all_expense').html(data);
                    $('.all_expense').html(data);                    
                },
        		error: function(xhr, status, error) {
        			document.write(xhr.responseText);
        			alert(xhr.responseText);
        		}
            }); 
                        
            $('[name="rowID"]').val(data.rowID);
            $('[name="date"]').val(toDdMmYy(data.advance_date));
            $('[name="jo_type_advance"]').val(data.jo_type_advance);
            $('[name="jo_no"]').val(data.jo_no);
            $('[name="ex_kapal"]').val(data.vessel_name);
            $('[name="po_no"]').val(data.po_spk_no);
            $('[name="port"]').val(data.port_name);
            $('[name="tonase"]').val(number_format(data.weight,0,',','.','format'));
            $('[name="cargo"]').val(data.item_name);
            $('[name="advance_type_rowID"]').val(data.advance_type_rowID);
            $('[name="debtor_rowID"]').select2('val',data.debtor_rowID);
            $('[name="advance_total"]').val(number_format(data.advance_total,0,',','.','format'));
            $('[name="remark"]').val(data.remark);
            
            if (data.advance_type_rowID == "3"){
                $('#dp_field').show();
            }else{
                $('#dp_field').hide();        
            }
            
            if(data.advance_type_rowID == '1'){
                $('#jo_no_star').html('');
            }
            else{
                $('#jo_no_star').html('*');        
            }
            
            if(data.dp_creditor_rowID == 0 || data.dp_creditor_rowID == ''){
                document.getElementById('chk_dp').checked = false;
                $('.creditor_row').hide();
                $('[name="dp_creditor_rowID"]').select2('val','');
            }
            else{
                document.getElementById('chk_dp').checked = true;
                $('.creditor_row').show();
                $('[name="dp_creditor_rowID"]').select2('val',data.dp_creditor_rowID);
            }
            
            if(data.jo_type_advance == '' || data.jo_type_advance == 'jo'){
                $('#jo_no').attr('onclick','ambil_job_order_advance()');
            }
            else if(data.jo_type_advance == 'jo_emkl'){                
                $('#jo_no').attr('onclick','ambil_job_order_emkl_advance()');
            }
            
            showDetailAdvance(data.advance_number);
            
            $('#advance_type_field').hide();
            $('#text_advance_type').show();
            $('#text_advance_type').html(data.advance_name);

            $('#modal_form_advance').modal('show');
            $('.modal-title-advance').text('Edit Advance'); 
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error adding / update data", "error");
        }
    });
}

function delete_advance(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
        $.ajax({
            url : "<?php echo base_url('advance/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               swal("Deleted!", "<?=lang('deleted_succesfully') ?>.", "success");
               location.replace("<?php echo base_url('advance')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}

$('#chk_dp').click(function() {
    if (!$(this).is(':checked',true)) {
        $('.creditor_row').hide();
    }
    else{
        $('.creditor_row').show();
    }
    
    $('#dp_creditor_rowID').select2('val','');

});

function change_advance_type(){
    var type= $('#advance_type_rowID').val(); 
    if (type == "3"){
        $('#dp_field').show();
    }else{
        $('#dp_field').hide();        
    }
    
    if(type == '1'){
        $('#jo_no_star').html('');
    }
    else{
        //$('#jo_no_star').html('*'); 
        $('#jo_no_star').html('');       
    }
    
    document.getElementById('chk_dp').checked = false;
    $('.creditor_row').hide();
    $('#dp_creditor_rowID').select2('val','');
    
    $.ajax({
        type: "POST",
        url : "<?php echo base_url('advance/get_data_expenses'); ?>",
		data: "advance_category_rowID="+type+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        cache:false,
        success: function(data){
            $('#all_expense').html(data);
            $('.all_expense').html(data);
        },
		error: function(xhr, status, error) {
			document.write(xhr.responseText);
			alert(xhr.responseText);
		}
    }); 
}

function ch_jo_type_advance(){
    if($('#jo_type_advance').val() == '' || $('#jo_type_advance').val() == 'jo'){
        $('#jo_no').attr('onclick','ambil_job_order_advance()');
        $('#jo_no').val('');
        $('#ex_kapal').val('');
        $('#port').val('');
        $('#cargo').val('');
        $('#tonase').val('');
        $('#po_no').val('');
    }
    else if($('#jo_type_advance').val() == 'jo_emkl'){
        $('#jo_no').attr('onclick','ambil_job_order_emkl_advance()');        
        $('#jo_no').val('');
        $('#ex_kapal').val('');
        $('#port').val('');
        $('#cargo').val('');
        $('#tonase').val('');
        $('#po_no').val('');
    }
}

function ambil_job_order_advance(){
    $('#joModal').modal('show');
    $('.modal-job-title').html('Job Order List');
    $('#tbl-joborder').DataTable().destroy();
        
    var table = $('#tbl-joborder').DataTable({"aaSorting": [[0, 'desc']],
        "bProcessing": true,
        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "sPaginationType": "full_numbers",
        "columnDefs": [
                {
                    "targets": [ 10 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 11 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 12 ],
                    "visible": false,
                    "searchable": false
                }
            ]
	});
    
    $('#tbl-joborder tbody').on('click', 'tr', function () {
        var data = table.row( this ).data();
        $('#jo_no').val(data[0]);
        $('#ex_kapal').val(data[8]);
        $('#port').val(data[7]);
        $('#cargo').val(data[6]);
        $('#tonase').val(data[12]);
        $('#po_no').val(data[2]);
        $('#joModal').modal('hide');
        
    });  
}

function ambil_job_order_emkl_advance(){
    $('#joEmklModal').modal('show');
    $('#tbl-joborder-emkl').DataTable().destroy();
        
    var table = $('#tbl-joborder-emkl').DataTable({"aaSorting": [[0, 'desc']],
        "bProcessing": true,
        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "sPaginationType": "full_numbers"
	});
    
    $('#tbl-joborder-emkl tbody').on('click', 'tr', function () {
        var data = table.row( this ).data();
        $('#jo_no').val(data[0]);
        $('#ex_kapal').val(data[6]);
        $('#port').val(data[7]);
        $('#cargo').val('-');
        $('#tonase').val('-');
        $('#po_no').val(data[4]);
        $('#joEmklModal').modal('hide');
    });  
}

var totrowAdvance= 0;
function addRowDetailAdvance(){
    totrowAdvance++;
            
    var detailrow="";
    detailrow=detailrow+"<tr id='rowAdv"+totrowAdvance+"'>";
    
    detailrow=detailrow+"<td>";
    var tombolhapus="<input type='button' style='height:30px;width:30px;border:0px;background-image:url(\"<?= base_url();?>resource/images/delete.png\");background-repeat:no-repeat;' id='hapdetAdvance"+totrowAdvance+"'   title='Hapus Baris' value='&nbsp;' onclick='hapusBarisAdvance(\"rowAdv"+totrowAdvance+"\")' />";
    detailrow=detailrow+tombolhapus;    
    detailrow=detailrow+"</td>";
            
    var expense_id="<select class='yellowtext all_expense' id='expense_id_"+totrowAdvance+"' name='expense_id[]' type='text'  style='height:30px;width:100%;background-color:white;border:solid 1px #ccc;' /></select>";
	detailrow=detailrow+"<td>"+expense_id+"</td>";
    
    detailrow=detailrow+"<td>";
    var text2="<textarea class='form-control' id='advance_desc_"+totrowAdvance+"' name='advance_desc[]' style='text-align:left;width:100%;background-color:white;border:solid 1px #ccc;' rows='2' placeholder='Description' ></textarea>";
    detailrow=detailrow+text2;
    detailrow=detailrow+"</td>";
                            
    detailrow=detailrow+"<td>";
    var txt_amount="<input class='form-control currency' id='amount_"+totrowAdvance+"' name='amount[]' value='0' type='text' onkeyup='sumAmountAdvance();' style='text-align:right;height:30px;background-color:white;border:solid 1px #ccc;' />";
    detailrow=detailrow+txt_amount;
    detailrow=detailrow+"</td>";
                  
    detailrow=detailrow+"</tr>";
            $('#detail_advance tr:last').after(
                detailrow
    );
    
    document.getElementById("expense_id_"+totrowAdvance).innerHTML=document.getElementById("all_expense").innerHTML;
            
}

function hapusBarisAdvance(x){
    if(document.getElementById(x)!=null){
        $('#'+x).remove(); 
         
    }
}

function sumAmountAdvance(){
    var looprows=totrowAdvance+1;
    var totAmount=0;

    for(z=1;z<looprows;z++){  
        if(document.getElementById('amount_'+z) != null  ){
            if(document.getElementById('amount_'+z).value != "" ){
                var nilai = number_format(document.getElementById('amount_'+z).value,0,',','.','deformat');
                totAmount += parseInt(nilai);

            }
        }
    }
    
    document.getElementById('advance_total').value=number_format(totAmount,0,',','.','format');

}

function bersih_advance(){
    var y=totrowAdvance+1;
    for(x=0;x<y;x++){
        if(document.getElementById("rowAdv"+x)){
		     hapusBarisAdvance("rowAdv"+x);
       }
    }
    totrowAdvance=0;
}

function showDetailAdvance(advance_number){
    bersih_advance();

    $.ajax({
	    type: "GET",
        url:'<?php echo base_url(); ?>advance/show_detail_advance?advance_number='+advance_number,
		dataType:"JSON",
		success: function(result){
    		var x=0;
            var total   = 0;
    		$.each(result, function(key, val) {	
        		x++;
        		addRowDetailAdvance();    
                        
                $('#expense_id_'+x).val(val.expense_rowID);
                $('#advance_desc_'+x).val(val.descs);
                $('#amount_'+x).val(number_format(val.amount,0,',','.','format'));
                
            });
            
            sumAmountAdvance();
        }
        
   });

}

// end advance 

// Reimburse
function add_reimburse(){
    $('#form_reimburse')[0].reset(); 
    $('#modal_form_reimburse').modal('show'); 
    $('.modal-title-reimburse').text('<?=lang('add_reimburse')?>'); 

    $('[name="rowID"]').val('');

    bersih_reimburse();
    $('#detail_advance').html('<tr><th width="20%">Advance Number</th><th width="30%">Code Description</th><th>Description</th><th width="25%">Amount (Rp)</th></tr>');
    
}

function reimburse_pdf(){
    window.open('<?php echo base_url('reimburse/pdf')?>');
}

function reimburse_excel(){
    window.open('<?php echo base_url('reimburse/excel')?>');
}

function save_reimburse(){
    
    var date  = $('[name="date"]').val();
    var jo_no  = $('[name="jo_no"]').val();    
    var remark  = $('[name="remark"]').val();    
    var advance_type_rowID  = $('[name="advance_type_rowID"]').val();    
    
    var validasi="";
        
    var data1=cekValidasi(date,'<?=lang('date')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(advance_type_rowID,'<?=lang('advance_type')?>','<?=lang('not_empty')?>');
    var data3=cekValidasi(jo_no,'JO No / Sub JO','<?=lang('not_empty')?>');
    var data4=cekValidasi(remark,'<?=lang('remark')?>','<?=lang('not_empty')?>');
    
    /*
    if(advance_type_rowID == '1'){
        validasi=data1+data2+data4;
    }
    else{
        validasi=data1+data2+data3+data4;  
    } 
    */         
    
    validasi=data1+data2+data4;
     
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                if(clickSave == 0){
                    clickSave++;
                    
                    $.ajax({
                        url : "<?php echo base_url('reimburse/create')?>",
                        type: "POST",
                        data: $('#form_reimburse').serializeArray(),
                        dataType: "JSON",
                        success: function(result)
                        {  
                            if (result.success){ 
                                $('#modal_form_reimburse').modal('hide');
                                //swal("Save!", "Data has been Saved.", "success");
                                sweetAlert('<?=lang('information')?>',''+result.msg);   
                                location.replace("<?php echo base_url('reimburse')?>");
                            }else{
                                sweetAlert('<?=lang('information')?>',''+result.msg); 
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal("Oops!", "Error adding / update data", "error");
                            clickSave = 0;
                        }
                        
                    });  
                }
                else{
                    alert('<?=lang('data_in_process')?>');
                }
            }
        });
    } 
}

function print_reimburse(id){
    window.open('<?php echo base_url()?>reimburse/print_reimburse/'+id);
}

function edit_reimburse(id)
{
  $('#form_reimburse')[0].reset();
      $.ajax({
        url : "<?php echo base_url('reimburse/get_data_edit/')?>/" + id,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {
            var toDdMmYy = function(input) {
                var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
                if(!input || !input.match(ptrn)) {
                    return null;
                }
                return input.replace(ptrn, '$3-$2-$1');
            };

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('reimburse/get_data_expenses'); ?>",
        		data: "advance_category_rowID="+data.advance_type_rowID+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
                cache: false,
                success: function(data){
                    $('#all_expense').html(data);
                    $('.all_expense').html(data);                    
                },
        		error: function(xhr, status, error) {
        			document.write(xhr.responseText);
        			alert(xhr.responseText);
        		}
            }); 
            
            $.ajax({
                type: "POST",
                url : "<?php echo base_url('reimburse/get_data_advance_by_category'); ?>",
        		data: "advance_category_rowID="+data.advance_type_rowID+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
                cache:false,
                success: function(data_html){
                    $('#data_advances').html(data_html);
                },
        		error: function(xhr, status, error) {
        			document.write(xhr.responseText);
        			alert(xhr.responseText);
        		}
            }); 
            
            $('[name="rowID"]').val(data.rowID);
            $('[name="date"]').val(toDdMmYy(data.reimburse_date));
            $('[name="jo_type_advance"]').val(data.jo_type_advance);
            $('[name="jo_no"]').val(data.jo_no);
            $('[name="ex_kapal"]').val(data.vessel_name);
            $('[name="po_no"]').val(data.po_spk_no);
            $('[name="port"]').val(data.port_name);
            $('[name="tonase"]').val(number_format(data.weight,0,',','.','format'));
            $('[name="cargo"]').val(data.item_name);
            $('[name="advance_type_rowID"]').val(data.advance_type_rowID);
            $('[name="advance_total"]').val(number_format(data.advance_total,0,',','.','format'));
            $('[name="reimburse_total"]').val(number_format(data.reimburse_total,0,',','.','format'));
            $('[name="paid_total"]').val(number_format(data.paid_total,0,',','.','format'));
            $('[name="remark"]').val(data.remark);
            
            if(data.jo_type_advance == '' || data.jo_type_advance == 'jo'){
                $('#jo_no').attr('onclick','ambil_job_order_advance()');
            }
            else if(data.jo_type_advance == 'jo_emkl'){                
                $('#jo_no').attr('onclick','ambil_job_order_emkl_advance()');
            }
            
            showDetailReimburse(data.reimburse_number);
            showDetailReimburseAdvance(data.reimburse_number);
            
            $('#btnShowAdvance').show();     
            
            $('#modal_form_reimburse').modal('show');
            $('.modal-title-reimburse').text('Edit Reimburse'); 
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error adding / update data", "error");
        }
    });
}

function delete_reimburse(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
        $.ajax({
            url : "<?php echo base_url('reimburse/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               swal("Deleted!", "<?=lang('deleted_succesfully') ?>.", "success");
               location.replace("<?php echo base_url('reimburse')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}

function showAdvanceModal(){
    $('#advanceModal').modal('show'); 
    $('#tbl-advance').DataTable().destroy();
    $('#tbl-advance').DataTable({"aaSorting": [[1, 'desc']],
        "bProcessing": true,
        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "sPaginationType": "full_numbers",
	});
}

function selectReimburseAdvance(advance_number, chk_id){
    if ($('#'+chk_id).is(':checked',true)) {
        $.ajax({
            type: "POST",
            url : "<?php echo base_url('reimburse/get_data_advance_detail'); ?>",
    		data: "advance_number="+advance_number+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
            cache:false,
            dataType: 'json',
            success: function(data){
                $('#totRowDetailAdvance').val(data.row);
                $('#detail_advance tr:last').after(data.html);
                
                sumAmountReimburseAdvance();
            },
    		error: function(xhr, status, error) {
    			document.write(xhr.responseText);
    			alert(xhr.responseText);
    		}
        }); 
    }
    else{
        hapusBarisReimburseAdvanceDetail('rowAdv_'+advance_number);
        
        sumAmountReimburseAdvance();
    }
    
}

function change_advance_type_reimburse(){
    var type = $('#advance_type_rowID').val(); 
    /*
    if(type == '1'){
        $('#jo_no_star').html('');
    }
    else{
        $('#jo_no_star').html('*');        
    }
    */
    $('#detail_advance').html('<tr><th width="20%">Advance Number</th><th width="30%">Code Description</th><th>Description</th><th width="25%">Amount (Rp)</th></tr>');
    $('#advance_total').val(0);
    sumAmountReimburseAdvance();
    
    if(type == ''){
        $('#btnShowAdvance').hide();
    }
    else{
        $('#btnShowAdvance').show();
        
        $.ajax({
            type: "POST",
            url : "<?php echo base_url('reimburse/get_data_expenses'); ?>",
    		data: "advance_category_rowID="+type+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
            cache:false,
            success: function(data){
                $('#all_expense').html(data);
                $('.all_expense').html(data);
            },
    		error: function(xhr, status, error) {
    			document.write(xhr.responseText);
    			alert(xhr.responseText);
    		}
        }); 
        
        $.ajax({
            type: "POST",
            url : "<?php echo base_url('reimburse/get_data_advance_by_category'); ?>",
    		data: "advance_category_rowID="+type+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
            cache:false,
            success: function(data_html){
                $('#data_advances').html(data_html);
            },
    		error: function(xhr, status, error) {
    			document.write(xhr.responseText);
    			alert(xhr.responseText);
    		}
        }); 
        
    }
}

var totrowReimburse= 0;
function addRowDetailReimburse(){
    totrowReimburse++;
            
    var detailrow="";
    detailrow=detailrow+"<tr id='rowRem_"+totrowReimburse+"'>";
    
    detailrow=detailrow+"<td>";
    var tombolhapus="<input type='button' style='height:30px;width:30px;border:0px;background-image:url(\"<?= base_url();?>resource/images/delete.png\");background-repeat:no-repeat;' id='hapdetReimburse"+totrowReimburse+"'   title='Hapus Baris' value='&nbsp;' onclick='hapusBarisReimburse(\"rowRem_"+totrowReimburse+"\")' />";
    detailrow=detailrow+tombolhapus;    
    detailrow=detailrow+"</td>";
            
    var expense_id="<select class='yellowtext all_expense' id='expense_id_"+totrowReimburse+"' name='expense_id[]' type='text'  style='height:30px;width:100%;background-color:white;border:solid 1px #ccc;' /></select>";
	detailrow=detailrow+"<td>"+expense_id+"</td>";
    
    detailrow=detailrow+"<td>";
    var text2="<textarea class='form-control' id='reimburse_desc_"+totrowReimburse+"' name='reimburse_desc[]' style='text-align:left;width:100%;background-color:white;border:solid 1px #ccc;' rows='2' placeholder='Description' ></textarea>";
    detailrow=detailrow+text2;
    detailrow=detailrow+"</td>";
                            
    detailrow=detailrow+"<td>";
    var txt_amount="<input class='form-control currency' id='amount_"+totrowReimburse+"' name='amount[]' value='0' type='text' onkeyup='sumAmountReimburse();' style='text-align:right;height:30px;background-color:white;border:solid 1px #ccc;' />";
    detailrow=detailrow+txt_amount;
    detailrow=detailrow+"</td>";
                  
    detailrow=detailrow+"</tr>";
    
    $('#detail_reimburse tr:last').after(detailrow);
    
    document.getElementById("expense_id_"+totrowReimburse).innerHTML=document.getElementById("all_expense").innerHTML;
            
}

function hapusBarisReimburse(x){
    if(document.getElementById(x)!=null){
        $('#'+x).remove(); 
    }
    
    sumAmountReimburse();
}

function hapusBarisReimburseAdvanceDetail(x){
    if($('.'+x)!=null){
        $('.'+x).remove();          
    }
}

function sumAmountReimburseAdvance(){
    var looprows = $('#totRowDetailAdvance').val();
    var totAmount = 0;
    var reimburse_total = number_format($('#reimburse_total').val(),0,',','.','deformat');
       
    for(z=0;z<=looprows;z++){  
        if(document.getElementById('amount_adv_detail_'+z) != null  ){
            if(document.getElementById('amount_adv_detail_'+z).value != "" ){
                var nilai = number_format(document.getElementById('amount_adv_detail_'+z).value,0,',','.','deformat');
                totAmount += parseInt(nilai);
            }
        }
    }
    
    document.getElementById('advance_total').value=number_format(totAmount,0,',','.','format');
    
    var paid_total = parseInt(totAmount - reimburse_total);
    $('#paid_total').val(number_format(paid_total,0,',','.','format'));

}

function sumAmountReimburse(){
    var looprows=totrowReimburse+1;
    var totAmount=0;
    var advance_total = number_format($('#advance_total').val(),0,',','.','deformat');

    for(z=1;z<looprows;z++){  
        if(document.getElementById('amount_'+z) != null  ){
            if(document.getElementById('amount_'+z).value != "" ){
                var nilai = number_format(document.getElementById('amount_'+z).value,0,',','.','deformat');
                totAmount += parseInt(nilai);

            }
        }
    }
    
    document.getElementById('reimburse_total').value=number_format(totAmount,0,',','.','format');
    
    var paid_total = parseInt(advance_total - totAmount);
    $('#paid_total').val(number_format(paid_total,0,',','.','format'));

}

function bersih_reimburse(){
    var y=totrowReimburse+1;
    for(x=0;x<y;x++){
        if(document.getElementById("rowRem_"+x)){
		     hapusBarisReimburse("rowRem_"+x);
       }
    }
    totrowReimburse=0;
}

function showDetailReimburse(reimburse_number){
    bersih_reimburse();

    $.ajax({
	    type: "GET",
        url:'<?php echo base_url(); ?>reimburse/show_detail_reimburse?reimburse_number='+reimburse_number,
		dataType:"JSON",
		success: function(result){
    		var x=0;
            var total   = 0;
    		$.each(result, function(key, val) {	
        		x++;
        		addRowDetailReimburse();    
                        
                $('#expense_id_'+x).val(val.expense_rowID);
                $('#reimburse_desc_'+x).val(val.descs);
                $('#amount_'+x).val(number_format(val.amount,0,',','.','format'));
                
            });
            
            sumAmountReimburse();
        }
        
   });

}

function showDetailReimburseAdvance(reimburse_number){
    $('#detail_advance').html('<tr><th width="20%">Advance Number</th><th width="30%">Code Description</th><th>Description</th><th width="25%">Amount (Rp)</th></tr>');
    
    $.ajax({
        type: "GET",
        url:'<?php echo base_url(); ?>reimburse/show_detail_reimburse_advance?reimburse_number='+reimburse_number,
        dataType: 'json',
        success: function(results){

            var x = 0;
            $.each(results, function(key, val) {	
                x++;
                document.getElementById('chk_adv_' + val.advance_number).checked = true;
                     
                $.ajax({
                    type: "POST",
                    url : "<?php echo base_url('reimburse/get_data_reimburse_advance_detail'); ?>",
            		data: "advance_number="+val.advance_number+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
                    cache:false,
                    dataType: 'json',
                    success: function(data){
                        $('#totRowDetailAdvance').val(x);
                        $('#detail_advance tr:last').after(data.html);
                        
                    },
            		error: function(xhr, status, error) {
            			document.write(xhr.responseText);
            			alert(xhr.responseText);
            		}
                }); 
                
            });
            
        },
		error: function(xhr, status, error) {
			document.write(xhr.responseText);
			alert(xhr.responseText);
		}
    });     
}


// end reimburse

// Tire
function add_tire(){
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text('<?=lang('add_tire')?>'); 
  $('#debtor_id').select2(); 
  
  $('[name="rowID"]').val('');    
}

function tire_pdf(){
    window.open('<?php echo base_url('tire/pdf')?>');
}

function tire_excel(){
    window.open('<?php echo base_url('tire/excel')?>');
}

function save_tire(){
    var vehicle_id  = $('[name="vehicle_id"]').val();
    var debtor_id  = $('[name="debtor_id"]').val();    
    var tire_position = $('[name="tire_position"]').val();
    var validasi="";
    
    var data1=cekValidasi(vehicle_id,'<?=lang('vehicle_police_no')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(debtor_id,'<?=lang('debtor_name')?>','<?=lang('not_empty')?>');
    var data3=cekValidasi(tire_position,'Tire Position','<?=lang('not_empty')?>');
    
    validasi=data1+data2+data3;  
     
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('tire/create')?>",
                    type: "POST",
                    data: $('#form').serializeArray(),
                    dataType: "JSON",
                    success: function(result)
                    {  
                        if (result.success){ 
                            $('#modal_form').modal('hide');
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            location.replace("<?php echo base_url('tire')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / update data", "error");
                    }
                    
                });  
            }
        });
    } 
}

function save_tire_detail(){
          
    var tire_no  = $('[name="tire_no"]').val();
    var tire_condition  = $('[name="tire_condition"]').val();    
    var tire_brand = $('[name="tire_brand"]').val();
    var tire_type  = $('[name="tire_type"]').val();    
    var tire_size = $('[name="tire_size"]').val();
    var validasi="";
    
    var data1=cekValidasi(tire_no,'<?=lang('vehicle_police_no')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(tire_condition,'Tire Condition','<?=lang('not_empty')?>');
    var data3=cekValidasi(tire_brand,'Tire Brand','<?=lang('not_empty')?>');
    var data4=cekValidasi(tire_type,'Tire Type','<?=lang('not_empty')?>');
    var data5=cekValidasi(tire_size,'Tire Size','<?=lang('not_empty')?>');
    
    validasi=data1+data2+data3+data4+data5;  
     
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('tire/create_detail')?>",
                    type: "POST",
                    data: $('#form_detail').serializeArray(),
                    dataType: "JSON",
                    success: function(result)
                    {  
                        if (result.success){ 
                            $('#modal_form_detail').modal('hide');
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            location.replace("<?php echo base_url('tire')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / update data", "error");
                    }
                    
                });  
            }
        });
    } 
}

function edit_tire(id)
{
  $('#form')[0].reset();
  $.ajax({
    url : "<?php echo base_url('tire/get_data_edit/')?>/" + id,
    type: "GET",
    dataType: 'json',
    success: function(data)
    {
        var toDdMmYy = function(input) {
            var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
            if(!input || !input.match(ptrn)) {
                return null;
            }
            return input.replace(ptrn, '$3-$2-$1');
        };

        $('#debtor_id').select2(); 

        $('[name="rowID"]').val(data.rowID);
        $('[name="date"]').val(toDdMmYy(data.date));
        $('[name="vehicle_id"]').select2('val',data.vehicle_rowID);
        $('[name="debtor_id"]').select2('val',data.debtor_rowID);
        $('[name="tire_position"]').val(data.tire_position);
        $('[name="photo_url"]').val(data.photo_url);
        
        $('#modal_form').modal('show');
        $('.modal-title').text('Edit'); 
        
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        swal("Oops!", "Error adding / update data", "error");
    }
});
}

function delete_tire(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('tire/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               
               swal("Deleted!", "<?=lang('tire_deleted_successfully') ?>.", "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('tire')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}

function change_tire(id,dtl_id){
     $('#form_detail')[0].reset();
  
     if(dtl_id == ''){
        $('[name="tire_rowID"]').val(id);
        
        $('#modal_form_detail').modal('show'); 
     }
     else{
         $.ajax({
            url : "<?php echo base_url('tire/get_data_detail/')?>/" + id,
            type: "GET",
            dataType: 'json',
            success: function(data)
            {
                $('[name="tire_rowID"]').val(id);
                $('[name="rowID"]').val(data.rowID);
                $('[name="tire_no"]').val(data.tire_no);
                $('[name="tire_condition"]').val(data.tire_condition);
                $('[name="tire_brand"]').val(data.tire_brand);
                $('[name="tire_type"]').val(data.tire_type);
                $('[name="tire_size"]').val(data.tire_size);
                
                $('#modal_form_detail').modal('show');
                
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error adding / update data", "error");
            }
        });
    }
}

// END Tire

// Accu
function add_accu(){
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text('<?=lang('add_accu')?>'); 
  $('#debtor_id').select2(); 
  
  $('[name="rowID"]').val('');    
}

function accu_pdf(){
    window.open('<?php echo base_url('accu/pdf')?>');
}

function accu_excel(){
    window.open('<?php echo base_url('accu/excel')?>');
}

function save_accu(){
    var vehicle_id  = $('[name="vehicle_id"]').val();
    var debtor_id  = $('[name="debtor_id"]').val();    
    var validasi="";
    
    var data1=cekValidasi(vehicle_id,'<?=lang('vehicle_police_no')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(debtor_id,'<?=lang('debtor_name')?>','<?=lang('not_empty')?>');
    
    validasi=data1+data2;  
     
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('accu/create')?>",
                    type: "POST",
                    data: $('#form').serializeArray(),
                    dataType: "JSON",
                    success: function(result)
                    {  
                        if (result.success){ 
                            $('#modal_form').modal('hide');
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            location.replace("<?php echo base_url('accu')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / update data", "error");
                    }
                    
                });  
            }
        });
    } 
}

function save_accu_detail(){
          
    var accu_no  = $('[name="accu_no"]').val();
    var accu_condition  = $('[name="accu_condition"]').val();    
    var accu_brand = $('[name="accu_brand"]').val();
    var accu_type  = $('[name="accu_type"]').val();    
    var accu_size = $('[name="accu_size"]').val();
    var validasi="";
    
    var data1=cekValidasi(accu_no,'<?=lang('vehicle_police_no')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(accu_condition,'Accu Condition','<?=lang('not_empty')?>');
    var data3=cekValidasi(accu_brand,'Accu Brand','<?=lang('not_empty')?>');
    var data4=cekValidasi(accu_type,'Accu Type','<?=lang('not_empty')?>');
    var data5=cekValidasi(accu_size,'Accu Size','<?=lang('not_empty')?>');
    
    validasi=data1+data2+data3+data4+data5;  
     
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('accu/create_detail')?>",
                    type: "POST",
                    data: $('#form_detail').serializeArray(),
                    dataType: "JSON",
                    success: function(result)
                    {  
                        if (result.success){ 
                            $('#modal_form_detail').modal('hide');
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            location.replace("<?php echo base_url('accu')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / update data", "error");
                    }
                    
                });  
            }
        });
    } 
}

function edit_accu(id)
{
  $('#form')[0].reset();
  $.ajax({
    url : "<?php echo base_url('accu/get_data_edit/')?>/" + id,
    type: "GET",
    dataType: 'json',
    success: function(data)
    {
        var toDdMmYy = function(input) {
            var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
            if(!input || !input.match(ptrn)) {
                return null;
            }
            return input.replace(ptrn, '$3-$2-$1');
        };

        $('#debtor_id').select2(); 

        $('[name="rowID"]').val(data.rowID);
        $('[name="date"]').val(toDdMmYy(data.date));
        $('[name="vehicle_id"]').select2('val',data.vehicle_rowID);
        $('[name="debtor_id"]').select2('val',data.debtor_rowID);
        $('[name="accu_position"]').val(data.accu_position);
        $('[name="photo_url"]').val(data.photo_url);
        
        $('#modal_form').modal('show');
        $('.modal-title').text('Edit'); 
        
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        swal("Oops!", "Error adding / update data", "error");
    }
});
}

function delete_accu(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('accu/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               
               swal("Deleted!", "<?=lang('accu_deleted_successfully') ?>.", "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('accu')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}

function change_accu(id,dtl_id){
     $('#form_detail')[0].reset();
  
     if(dtl_id == ''){
        $('[name="accu_rowID"]').val(id);
        
        $('#modal_form_detail').modal('show'); 
     }
     else{
         $.ajax({
            url : "<?php echo base_url('accu/get_data_detail/')?>/" + id,
            type: "GET",
            dataType: 'json',
            success: function(data)
            {
                $('[name="accu_rowID"]').val(id);
                $('[name="rowID"]').val(data.rowID);
                $('[name="accu_no"]').val(data.accu_no);
                $('[name="accu_condition"]').val(data.accu_condition);
                $('[name="accu_brand"]').val(data.accu_brand);
                $('[name="accu_type"]').val(data.accu_type);
                $('[name="accu_size"]').val(data.accu_size);
                
                $('#modal_form_detail').modal('show');
                
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error adding / update data", "error");
            }
        });
    }
}

// END Accu

// Tire Brand
function add_tire_brand(){
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text('<?=lang('add_tire_brand')?>'); 
  $('#debtor_id').select2(); 
  
  $('[name="rowID"]').val('');    
}

function save_tire(){
    var vehicle_id  = $('[name="vehicle_id"]').val();
    var debtor_id  = $('[name="debtor_id"]').val();    
    var tire_position = $('[name="tire_position"]').val();
    var validasi="";
    
    var data1=cekValidasi(vehicle_id,'<?=lang('vehicle_police_no')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(debtor_id,'<?=lang('debtor_name')?>','<?=lang('not_empty')?>');
    var data3=cekValidasi(tire_position,'Tire Position','<?=lang('not_empty')?>');
    
    validasi=data1+data2+data3;  
     
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('tire/create')?>",
                    type: "POST",
                    data: $('#form').serializeArray(),
                    dataType: "JSON",
                    success: function(result)
                    {  
                        if (result.success){ 
                            $('#modal_form').modal('hide');
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            location.replace("<?php echo base_url('tire')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / update data", "error");
                    }
                    
                });  
            }
        });
    } 
}

function save_tire_detail(){
          
    var tire_no  = $('[name="tire_no"]').val();
    var tire_condition  = $('[name="tire_condition"]').val();    
    var tire_brand = $('[name="tire_brand"]').val();
    var tire_type  = $('[name="tire_type"]').val();    
    var tire_size = $('[name="tire_size"]').val();
    var validasi="";
    
    var data1=cekValidasi(tire_no,'<?=lang('vehicle_police_no')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(tire_condition,'Tire Condition','<?=lang('not_empty')?>');
    var data3=cekValidasi(tire_brand,'Tire Brand','<?=lang('not_empty')?>');
    var data4=cekValidasi(tire_type,'Tire Type','<?=lang('not_empty')?>');
    var data5=cekValidasi(tire_size,'Tire Size','<?=lang('not_empty')?>');
    
    validasi=data1+data2+data3+data4+data5;  
     
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('tire/create_detail')?>",
                    type: "POST",
                    data: $('#form_detail').serializeArray(),
                    dataType: "JSON",
                    success: function(result)
                    {  
                        if (result.success){ 
                            $('#modal_form_detail').modal('hide');
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            location.replace("<?php echo base_url('tire')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / update data", "error");
                    }
                    
                });  
            }
        });
    } 
}

function edit_tire(id)
{
  $('#form')[0].reset();
  $.ajax({
    url : "<?php echo base_url('tire/get_data_edit/')?>/" + id,
    type: "GET",
    dataType: 'json',
    success: function(data)
    {
        var toDdMmYy = function(input) {
            var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
            if(!input || !input.match(ptrn)) {
                return null;
            }
            return input.replace(ptrn, '$3-$2-$1');
        };

        $('#debtor_id').select2(); 

        $('[name="rowID"]').val(data.rowID);
        $('[name="date"]').val(toDdMmYy(data.date));
        $('[name="vehicle_id"]').select2('val',data.vehicle_rowID);
        $('[name="debtor_id"]').select2('val',data.debtor_rowID);
        $('[name="tire_position"]').val(data.tire_position);
        $('[name="photo_url"]').val(data.photo_url);
        
        $('#modal_form').modal('show');
        $('.modal-title').text('Edit'); 
        
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        swal("Oops!", "Error adding / update data", "error");
    }
});
}

function delete_tire(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('tire/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               
               swal("Deleted!", "<?=lang('tire_deleted_successfully') ?>.", "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('tire')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}

// END Tire Brand

// General Ledger
function add_general_ledger(){
    $('#form')[0].reset(); 
    $('#modal_form').modal('show'); 
    $('.modal-title').text('<?=lang('new_general_ledger')?>'); 
    
    $('#gl_date').attr('readonly',false);
    
    $('#rowID').val('');
    $('#journal_no').val('');
    $('#user_created').val('');
    $('#date_created').val('');
    $('#time_created').val('');
    
    clearAllDetailGL();
}

function search_reference(){
    $('#reference_no').val('');
    $('#reference_date').val('');
    $('#reference_debtor_creditor_id').val('');
    $('.gl_remark').val('');
    clearAllDetailGL();
    
    var gl_type = $('#gl_type option:selected').val();
    var validasi = "";
    
    var data1=cekValidasi(gl_type,'GL Type','<?=lang('not_empty')?>');
    validasi=data1;
    
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }
    else{
        $('#modalReference').modal('show'); 
   
        $.ajax({
            type: "POST",
            url : "<?php echo base_url('general_ledger/get_data_reference'); ?>",
    		data: 'gl_type='+gl_type+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
            cache:false,
            success: function(data){
                $('#data_advance_invoice').html(data);
                $('#tbl_data_reference').dataTable({
            		"bProcessing": true,
                    "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
                    "sPaginationType": "full_numbers",
            	});
         
            },
    		error: function(xhr, status, error) {
    			document.write(xhr.responseText);
    			alert(xhr.responseText);
    		}
        }); 
    }
    
}

function change_gl_type(){
    $('#reference_no').val('');
    $('#reference_date').val('');
    $('#reference_debtor_creditor_id').val('');
    $('.gl_remark').val('');
    clearAllDetailGL();
}

function get_data_reference(reference_no,reference_date,reference_debtor_creditor_id,reference_desc,gl_type,amount){
    $('#reference_no').val(reference_no);
    $('#reference_date').val(reference_date);
    $('#reference_debtor_creditor_id').val(reference_debtor_creditor_id);
    $('.gl_remark').val(reference_desc);
    
    $.ajax({
        type: "POST",
        url : "<?php echo base_url('general_ledger/get_data_detail_journal'); ?>",
		data: 'gl_type='+gl_type+'&reference_no='+reference_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        cache:false,
        success: function(data){
            if(data.count_detail > 0){
                showDetailGL(data.journal_no);
            }
            else{
                var totalDebit = 0;
                var totalCredit = 0;
                
                // Debit
                add_gl_detail();
                
                $('#cash_bank_'+totrowGl).select2('val','');
                $('#descs_'+totrowGl).val($('#gl_remark').val());
                totalDebit += parseFloat(amount);
                $('#amount_debit_'+totrowGl).val(number_format(amount,2,',','.','format'));                    

                if(amount > 0){
                    $('#amount_credit_'+totrowGl).val('0');
                    $('#amount_credit_'+totrowGl).attr('readonly',true);
                }
                else{
                    $('#amount_credit_'+totrowGl).val('0');
                    $('#amount_credit_'+totrowGl).attr('readonly',false);        
                }
                
                // Credit
                add_gl_detail(); 
                var credit_amt = amount;
                totalCredit += parseFloat(credit_amt);
                $('#amount_credit_'+totrowGl).val(number_format(credit_amt,2,',','.','format'));                                
                
                if(credit_amt > 0){
                    $('#amount_debit_'+totrowGl).val('0');
                    $('#amount_debit_'+totrowGl).attr('readonly',true);
                }
                else{
                    $('#amount_debit_'+totrowGl).val('0');
                    $('#amount_debit_'+totrowGl).attr('readonly',false);        
                }
                
                $('#total_debit').val(number_format(totalDebit,2,',','.','format'));
                $('#total_credit').val(number_format(totalCredit,2,',','.','format'));

            }
            
        },
		error: function(xhr, status, error) {
			document.write(xhr.responseText);
			alert(xhr.responseText);
		}
    }); 
        
    $('#modalReference').modal('hide'); 
}

function get_data_reference_reimburse(reference_no,reference_date,reference_debtor_creditor_id,reference_desc,gl_type,amount,paid_total){
    $('#reference_no').val(reference_no);
    $('#reference_date').val(reference_date);
    $('#reference_debtor_creditor_id').val(reference_debtor_creditor_id);
    $('.gl_remark').val(reference_desc);
    
    $.ajax({
        type: "POST",
        url : "<?php echo base_url('general_ledger/get_data_detail_journal'); ?>",
		data: 'gl_type='+gl_type+'&reference_no='+reference_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        cache:false,
        success: function(data){
            if(data.count_detail > 0){
                showDetailGL(data.journal_no);
            }
            else{
                var totalDebit = 0;
                var totalCredit = 0;
                
                // Debit
                add_gl_detail();
                
                $('#cash_bank_'+totrowGl).select2('val','');
                $('#descs_'+totrowGl).val($('#gl_remark').val());
                totalDebit += parseFloat(amount);
                $('#amount_debit_'+totrowGl).val(number_format(amount,2,',','.','format'));                    

                if(amount > 0){
                    $('#amount_credit_'+totrowGl).val('0');
                    $('#amount_credit_'+totrowGl).attr('readonly',true);
                }
                else{
                    $('#amount_credit_'+totrowGl).val('0');
                    $('#amount_credit_'+totrowGl).attr('readonly',false);        
                }
                
                // Overpaid atau Underpaid
                if(paid_total >= 0){
                    add_gl_detail();
                    $('#cash_bank_'+totrowGl).select2('val','');
                    $('#descs_'+totrowGl).val('Overpaid');
                    $('#amount_debit_'+totrowGl).val(number_format(paid_total,2,',','.','format'));
                    totalDebit += parseFloat(paid_total);
                }
                else{
                    add_gl_detail();
                    $('#cash_bank_'+totrowGl).select2('val','');
                    $('#descs_'+totrowGl).val('Underpaid');
                    $('#amount_credit_'+totrowGl).val(number_format(paid_total * -1,2,',','.','format'));
                    totalCredit += parseFloat(paid_total * -1);
                }
                
                $('#total_debit').val(number_format(totalDebit,2,',','.','format'));
                $('#total_credit').val(number_format(totalCredit,2,',','.','format'));

                // Credit
                $.ajax({
                    url:'<?php echo base_url(); ?>general_ledger/get_data_detail_advance',
            		type: "POST",
                    data: "trx_no="+reference_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
                    dataType:"JSON",
            		success: function(result){
      		            
                        var totalDebit = number_format($('#total_debit').val(),2,',','.','deformat');
                        var totalCredit = number_format($('#total_credit').val(),2,',','.','deformat');
                        
                		$.each(result, function(key, val) {	
                            
                            // Credit
                            add_gl_detail(); 
                            
                            $('#cash_bank_'+totrowGl).select2('val','');
                            $('#descs_'+totrowGl).val('ADVANCE NO. ' + val.advance_number);

                            var credit_amt = val.advance_total;
                            totalCredit += parseFloat(credit_amt);
                            $('#amount_credit_'+totrowGl).val(number_format(credit_amt,2,',','.','format'));                                
                            
                            if(credit_amt > 0){
                                $('#amount_debit_'+totrowGl).val('0');
                                $('#amount_debit_'+totrowGl).attr('readonly',true);
                            }
                            else{
                                $('#amount_debit_'+totrowGl).val('0');
                                $('#amount_debit_'+totrowGl).attr('readonly',false);        
                            }
                            
                  	     });
                                                 
                        $('#total_debit').val(number_format(totalDebit,2,',','.','format'));
                        $('#total_credit').val(number_format(totalCredit,2,',','.','format'));
            
                    }
                    
                });
                
            }
            
        },
		error: function(xhr, status, error) {
			document.write(xhr.responseText);
			alert(xhr.responseText);
		}
    }); 
        
    $('#modalReference').modal('hide'); 
}

function get_data_reference_bank(reference_no,reference_date,reference_debtor_creditor_id,reference_desc,gl_type,amount,out_in){
    $('#reference_no').val(reference_no);
    $('#reference_date').val(reference_date);
    $('#reference_debtor_creditor_id').val(reference_debtor_creditor_id);
    $('.gl_remark').val(reference_desc);
    
    $.ajax({
        type: "POST",
        url : "<?php echo base_url('general_ledger/get_data_detail_journal'); ?>",
		data: 'gl_type='+gl_type+'&reference_no='+reference_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        cache:false,
        success: function(data){
            if(data.count_detail > 0){
                showDetailGL(data.journal_no);
            }
            else{
                clearAllDetailGL();
                
                $.ajax({
                    url:'<?php echo base_url(); ?>general_ledger/get_data_detail_cg',
            		type: "POST",
                    data: "trx_no="+reference_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
                    dataType:"JSON",
            		success: function(result){
      		        
                        var totalDebit = 0;
                        var totalCredit = 0;
                        
                		$.each(result, function(key, val) {
                            
                            if(gl_type != "cash out" && out_in != "out" && val.transaction_type != "advance"){
                                // Debit
                                add_gl_detail();
                                
                                $('#cash_bank_'+totrowGl).select2('val','');
                                $('#descs_'+totrowGl).val($('#gl_remark').val());
                                
                                totalDebit += parseFloat(val.cg_amt);
                                
                                $('#amount_debit_'+totrowGl).val(number_format(val.cg_amt,2,',','.','format'));                    
    
                                if(val.cg_amt > 0){
                                    $('#amount_credit_'+totrowGl).val('0');
                                    $('#amount_credit_'+totrowGl).attr('readonly',true);
                                }
                                else{
                                    $('#amount_credit_'+totrowGl).val('0');
                                    $('#amount_credit_'+totrowGl).attr('readonly',false);        
                                }
                            }
                            
                            // Credit
                            add_gl_detail(); 
                            var credit_amt = val.cg_amt;
                            totalCredit += parseFloat(credit_amt);
                            $('#amount_credit_'+totrowGl).val(number_format(credit_amt,2,',','.','format'));                                
                            
                            if(credit_amt > 0){
                                $('#amount_debit_'+totrowGl).val('0');
                                $('#amount_debit_'+totrowGl).attr('readonly',true);
                            }
                            else{
                                $('#amount_debit_'+totrowGl).val('0');
                                $('#amount_debit_'+totrowGl).attr('readonly',false);        
                            }
                            
                  	     });
                                                 
                        $('#total_debit').val(number_format(totalDebit,2,',','.','format'));
                        $('#total_credit').val(number_format(totalCredit,2,',','.','format'));
            
                    }
                    
                });

                $.ajax({
                    url:'<?php echo base_url(); ?>general_ledger/get_data_detail_cb_detail',
            		type: "POST",
                    data: "trx_no="+reference_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
                    dataType:"JSON",
            		success: function(result2){
      		            
                        var totalDebit = number_format($('#total_debit').val(),2,',','.','deformat');
                        var totalCredit = number_format($('#total_credit').val(),2,',','.','deformat');
                        
                		$.each(result2, function(key, val) {	
                            
                            if(gl_type != "cash out" && out_in != "out" && val.advance_invoice_type != "advance"){
                                // Credit
                                add_gl_detail(); 
                                
                                $('#cash_bank_'+totrowGl).select2('val','');
                                $('#descs_'+totrowGl).val(val.descs + ' NO. ' + val.advance_invoice_no);
    
                                var credit_amt = val.advance_invoice_amount;
                                totalCredit += parseFloat(credit_amt);
                                $('#amount_credit_'+totrowGl).val(number_format(credit_amt,2,',','.','format'));                                
                                
                                if(credit_amt > 0){
                                    $('#amount_debit_'+totrowGl).val('0');
                                    $('#amount_debit_'+totrowGl).attr('readonly',true);
                                }
                                else{
                                    $('#amount_debit_'+totrowGl).val('0');
                                    $('#amount_debit_'+totrowGl).attr('readonly',false);        
                                }
                            }
                            else{
                                // Debit
                                add_gl_detail(); 
                                
                                $('#cash_bank_'+totrowGl).select2('val','');
                                $('#descs_'+totrowGl).val(val.descs + ' NO. ' + val.advance_invoice_no);
    
                                var debit_amt = val.advance_invoice_amount;
                                totalDebit += parseFloat(debit_amt);
                                $('#amount_debit_'+totrowGl).val(number_format(debit_amt,2,',','.','format'));                                
                                
                                if(debit_amt > 0){
                                    $('#amount_credit_'+totrowGl).val('0');
                                    $('#amount_credit_'+totrowGl).attr('readonly',true);
                                }
                                else{
                                    $('#amount_credit_'+totrowGl).val('0');
                                    $('#amount_credit_'+totrowGl).attr('readonly',false);        
                                }
                            }
                  	     });
                                                 
                        $('#total_debit').val(number_format(totalDebit,2,',','.','format'));
                        $('#total_credit').val(number_format(totalCredit,2,',','.','format'));
            
                    }
                    
               });


            }
            
        },
		error: function(xhr, status, error) {
			document.write(xhr.responseText);
			alert(xhr.responseText);
		}
    }); 
        
    $('#modalReference').modal('hide'); 
}

var totrowGl = 0;

function add_gl_detail(){
    var gl_date = $('#gl_date').val();
    var gl_type = $('#gl_type option:selected').val();
    var reference_no = $('#reference_no').val();
    var gl_remark = $('#gl_remark').val();
    
    var validasi = "";
    
    var data1=cekValidasi(gl_date,'GL Date','<?=lang('not_empty')?>');
    var data2=cekValidasi(gl_type,'GL Type','<?=lang('not_empty')?>');
    var data3=cekValidasi(reference_no,'Reference No','<?=lang('not_empty')?>');;
    var data4=cekValidasi(gl_remark,'Remark','<?=lang('not_empty')?>');

    validasi=data1+data2+data3+data4;
    
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }
    else{
        totrowGl++;
        
        var detailrow="";
        detailrow=detailrow+"<tr id='rowGL_"+totrowGl+"'>";
        
        detailrow=detailrow+"<td>";
        var tombolhapus="<input type='button' style='height:30px;width:30px;border:0px;background-image:url(\"<?= base_url();?>resource/images/delete.png\");background-repeat:no-repeat;' id='hapdetReimburse"+totrowGl+"'   title='Hapus Baris' value='&nbsp;' onclick='deleteDetailGL(\"rowGL_"+totrowGl+"\")' />";
        detailrow=detailrow+tombolhapus;    
        detailrow=detailrow+"</td>";

        var expense_id="<select class='yellowtext' id='cash_bank_"+totrowGl+"' name='cash_bank[]' type='text'  style='height:30px;width:180px;background-color:white;border:solid 1px #ccc;' /></select>";
    	detailrow=detailrow+"<td>"+expense_id+"</td>";
        
        var debtor_creditor_type="<select class='yellowtext' id='debtor_creditor_type_"+totrowGl+"' name='debtor_creditor_type[]' type='text' onchange='change_debtor_creditor_type("+totrowGl+")' style='height:30px;width:100%;background-color:white;border:solid 1px #ccc;'><option value='D'>Debitor</option><option value='C'>Creditor</option><option value='O'>Others</option></select>";
    	detailrow=detailrow+"<td>"+debtor_creditor_type+"</td>";

        var debtor_creditor_rowID="<select class='yellowtext' id='debtor_creditor_rowID_"+totrowGl+"' name='debtor_creditor_rowID[]' type='text'  style='height:30px;width:200px;background-color:white;border:solid 1px #ccc;' /></select>";
    	detailrow=detailrow+"<td>"+debtor_creditor_rowID+"</td>";
        
        detailrow=detailrow+"<td>";
        var text2="<textarea class='form-control gl_remark' id='descs_"+totrowGl+"' name='descs[]' style='text-align:left;width:100%;background-color:white;border:solid 1px #ccc;' rows='2' placeholder='Description' ></textarea>";
        detailrow=detailrow+text2;
        detailrow=detailrow+"</td>";

        detailrow=detailrow+"<td>";
        var txt_amount="<input class='form-control' id='amount_debit_"+totrowGl+"' name='amount_debit[]' value='0' type='text' onkeypress='IsNumeric(this)' onkeyup='sumAmountDebit();readonlyDebit("+totrowGl+")' onclick=\"sumAmountDebit();if(this.value!='0'&amp;&amp;this.value!=''){var nilai_tmp1=this.value.replace('.','');var nilai_tmp2=nilai_tmp1.replace('.','');var nilai_tmp=nilai_tmp2.replace('.','');var nilai=nilai_tmp.replace(',','.');this.value=number_format(nilai,2,',','','format');}else{if(this.value==''){this.value='';}}\" onblur=\"if(this.value!='0'&amp;&amp;this.value!=''){var nilai_tmp1=this.value.replace('.','');var nilai_tmp2=nilai_tmp1.replace('.','');var nilai_tmp=nilai_tmp2.replace('.','');var nilai=nilai_tmp.replace(',','.');this.value=number_format(nilai,2,',','.','format');}else{if(this.value.indexOf(',')>0){}else{}}\" style='text-align:right;height:30px;border:solid 1px #ccc;' />";
        detailrow=detailrow+txt_amount;
        detailrow=detailrow+"</td>";
               
        detailrow=detailrow+"<td>";
        var txt_amount="<input class='form-control' id='amount_credit_"+totrowGl+"' name='amount_credit[]' value='0' type='text' onkeypress='IsNumeric(this)' onkeyup='sumAmountCredit();readonlyCredit("+totrowGl+")' onclick=\"sumAmountCredit();if(this.value!='0'&amp;&amp;this.value!=''){var nilai_tmp1=this.value.replace('.','');var nilai_tmp2=nilai_tmp1.replace('.','');var nilai_tmp=nilai_tmp2.replace('.','');var nilai=nilai_tmp.replace(',','.');this.value=number_format(nilai,2,',','','format');}else{if(this.value==''){this.value='';}}\" onblur=\"if(this.value!='0'&amp;&amp;this.value!=''){var nilai_tmp1=this.value.replace('.','');var nilai_tmp2=nilai_tmp1.replace('.','');var nilai_tmp=nilai_tmp2.replace('.','');var nilai=nilai_tmp.replace(',','.');this.value=number_format(nilai,2,',','.','format');}else{if(this.value.indexOf(',')>0){}else{}}\" style='text-align:right;height:30px;border:solid 1px #ccc;' />";
        detailrow=detailrow+txt_amount;
        detailrow=detailrow+"</td>";
               
        detailrow=detailrow+"</tr>";
        
        $('#detail_gl tr:last').after(detailrow);
        
        $('#cash_bank_'+totrowGl).select2();
        $('#debtor_creditor_rowID_'+totrowGl).select2();
        
        $('#descs_'+totrowGl).val($('#gl_remark').val());
        document.getElementById("cash_bank_"+totrowGl).innerHTML=document.getElementById("cash_bank_list").innerHTML;
        document.getElementById("debtor_creditor_rowID_"+totrowGl).innerHTML=document.getElementById("debtor_list").innerHTML;
        
    }
    
}

function change_debtor_creditor_type(row){
    if($("#debtor_creditor_type_"+row).val() == 'D'){
        document.getElementById("debtor_creditor_rowID_"+row).innerHTML=document.getElementById("debtor_list").innerHTML;
    }
    else if($("#debtor_creditor_type_"+row).val() == 'C'){
        document.getElementById("debtor_creditor_rowID_"+row).innerHTML=document.getElementById("creditor_list").innerHTML;
    }
    else{
        document.getElementById("debtor_creditor_rowID_"+row).innerHTML='<option value="0">Other</option>';        
    }
    
    $('#debtor_creditor_rowID_'+row).select2('val','');
}

function change_report_debtor_creditor_type(){
    if($("#debtor_creditor_type").val() == 'D'){
        $('.debtor_creditor_list').show();
        document.getElementById("debtor_creditor_id").innerHTML=document.getElementById("debtor_list").innerHTML;
    }
    else if($("#debtor_creditor_type").val() == 'C'){
        $('.debtor_creditor_list').show();
        document.getElementById("debtor_creditor_id").innerHTML=document.getElementById("creditor_list").innerHTML;
    }
    else{
        $('.debtor_creditor_list').hide();
        document.getElementById("debtor_creditor_id").innerHTML = '';        
    }
    
    $('#debtor_creditor_id').select2('val','');    
}

function deleteDetailGL(x){
    if(document.getElementById(x)!=null){
        $('#'+x).remove(); 
    }
    
    sumAmountDebit();
    sumAmountCredit();
}

function clearAllDetailGL(){
    var y=totrowGl;
    for(x=1;x<=y;x++){
        if(document.getElementById("rowGL_"+x)){
		     deleteDetailGL("rowGL_"+x);
       }
    }
    totrowGl=0;
}

function readonlyDebit(row){
    var debit = number_format($('#amount_debit_'+row).val(),0,',','.','deformat');
    if(debit != 0){
        $('#amount_credit_'+row).val('0');
        $('#amount_credit_'+row).attr('readonly',true);
    }
    else{
        $('#amount_credit_'+row).val('0');
        $('#amount_credit_'+row).attr('readonly',false);        
    }
}

function readonlyCredit(row){
    var credit = number_format($('#amount_credit_'+row).val(),0,',','.','deformat');
    if(credit != 0){
        $('#amount_debit_'+row).val('0');
        $('#amount_debit_'+row).attr('readonly',true);
    }
    else{
        $('#amount_debit_'+row).val('0');
        $('#amount_debit_'+row).attr('readonly',false);        
    }
}

function sumAmountDebit(){
    var looprows=totrowGl;
    var totNil=0;
    
    for(z=1;z<=looprows; z++){  
        if(document.getElementById('amount_debit_'+z)!=null  ){
            if(document.getElementById('amount_debit_'+z).value!="" ){
                //var nilai=number_format(document.getElementById('cb_pay_amount'+z).value,2,',','.','deformat');
                var nilai_tmp1=document.getElementById('amount_debit_'+z).value.replace('.','');
                var nilai_tmp2=nilai_tmp1.replace('.','');
                var nilai_tmp=nilai_tmp2.replace('.','');
                var nilai=nilai_tmp.replace(',','.');
                totNil +=parseFloat(nilai);
            }
        }
    }
    
    $('#total_debit').val(number_format(totNil,2,',','.','format'));   
    
}

function sumAmountCredit(){
    var looprows=totrowGl;
    var totNil=0;
    
    for(z=1;z<=looprows; z++){  
        if(document.getElementById('amount_credit_'+z)!=null  ){
            if(document.getElementById('amount_credit_'+z).value!="" ){
                var nilai_tmp1=document.getElementById('amount_credit_'+z).value.replace('.','');
                var nilai_tmp2=nilai_tmp1.replace('.','');
                var nilai_tmp=nilai_tmp2.replace('.','');
                var nilai=nilai_tmp.replace(',','.');
                totNil +=parseFloat(nilai);
            }
        }
    }
    
    $('#total_credit').val(number_format(totNil,2,',','.','format'));   
    
}

function save_general_ledger(){
    var looprows=totrowGl+1;
    var totNil_d = 0;
    var totNil_c = 0;
    var gl_detail = "";
    var gl_detail_val = "";
    var balance = "";
    var balance_val = "";
    
    var gl_date = $('#gl_date').val();
    var gl_type = $('#gl_type option:selected').val();
    var reference_no = $('#reference_no').val();
    var gl_remark = $('#gl_remark').val();
    
    var validasi = "";
    
    var data1=cekValidasi(gl_date,'GL Date','<?=lang('not_empty')?>');
    var data2=cekValidasi(gl_type,'GL Type','<?=lang('not_empty')?>');
    var data3=cekValidasi(reference_no,'Reference No','<?=lang('not_empty')?>');;
    var data4=cekValidasi(gl_remark,'Remark','<?=lang('not_empty')?>');
    
    for(y=1;y<looprows; y++){  
        if(document.getElementById('amount_debit_'+y)!=null  ){
            if(document.getElementById('amount_debit_'+y).value!="" ){
                var nilai_tmp1=document.getElementById('amount_debit_'+y).value.replace('.','');
                var nilai_tmp2=nilai_tmp1.replace('.','');
                var nilai_tmp=nilai_tmp2.replace('.','');
                var nilai=nilai_tmp.replace(',','.');
                totNil_d +=parseFloat(nilai);
            }
        }
    }
    
    for(z=1;z<looprows; z++){  
        if(document.getElementById('amount_credit_'+z)!=null  ){
            if(document.getElementById('amount_credit_'+z).value!="" ){
                var nilai_tmp1=document.getElementById('amount_credit_'+z).value.replace('.','');
                var nilai_tmp2=nilai_tmp1.replace('.','');
                var nilai_tmp=nilai_tmp2.replace('.','');
                var nilai=nilai_tmp.replace(',','.');
                totNil_c +=parseFloat(nilai);                
            }
        }
    }
    
    if(totNil_d == 0 && totNil_c == 0){
        gl_detail = cekValidasi(gl_detail_val,'General Ledger Detail','Not complete');   
    }
    
    if(totNil_d != totNil_c){
        balance = cekValidasi(balance_val,'General Ledger','is Unbalanced');   
    }
    
    validasi = data1+data2+data3+data4+gl_detail+balance;
    
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                if(clickSave == 0){
                    clickSave++;
                
                    $.ajax({
                        url : "<?php echo base_url('general_ledger/save_general_ledger')?>",
                        type: "POST",
                        data: $('#form').serializeArray(),
                        dataType: "JSON",
                        success: function(result)
                        {
                            if (result.success){ 
                                $('body').waitMe({
                                    effect: 'ios',
                                    text: 'Please wait...',
                                    bg: 'rgba(255,255,255,0.80)',
                                    color: '#234543',
                                    sizeW: '',
                                    sizeH: '',
                                });
                                
                                $('#modal_form').modal('hide');
                                
                                //sweetAlert('<?=lang('information')?>',''+result.msg);   
                                location.replace("<?=base_url('general_ledger')?>");
                                
                            }else{
                                sweetAlert('<?=lang('information')?>',''+result.msg); 
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal("Oops!", "Error adding / update data", "error");
                            clickSave = 0;
                        }
                        
                    });  
                }
                else{
                    alert('<?=lang('data_in_process')?>');
                }
            }
        });
    } 
            
}

function edit_general_ledger(gl_no){
    $.ajax({
        type: "POST",
        url:'<?php echo base_url(); ?>general_ledger/get_data_header',
        data: "journal_no="+gl_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        dataType: 'json',
        success: function(data)
        {
            var toMmDdYy = function(input) {
                var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
                if(!input || !input.match(ptrn)) {
                    return null;
                }
                return input.replace(ptrn, '$3-$2-$1');
            }; 
            $('#ap_type').select2();
            $('#creditor_id').select2();              
            $('#total_amt').mask('000.000.000', {reverse: true});
            
            var descs = '-';
            if(data.descs != ''){
                descs = data.descs;
            }
            
            $('#rowID').val(data.rowID);
            $('#journal_no').val(data.journal_no);
            $('#gl_date').val(toMmDdYy(data.journal_date));
            $('#gl_type').val(data.journal_type);
            $('#reference_no').val(data.ref_no);
            $('#reference_date').val(data.ref_date);
            $('#gl_remark').val(descs);
            $('#user_created').val(data.user_created);
            $('#date_created').val(data.date_created);
            $('#time_created').val(data.time_created);
            
            showDetailGL(data.journal_no);    
            
            $('#gl_date').attr('readonly',true);
                 
            $('#modal_form').modal('show');               
            $('.modal-title').text('<?=lang('edit_general_ledger')?>');  
  
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error update data", "error");
        }
    }); 
}

function delete_general_ledger(gl_no){
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
        $.ajax({
            url:'<?php echo base_url(); ?>general_ledger/delete_data',
            type: "POST",
            data: "gl_no="+gl_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
            dataType: "JSON",
            success: function(data)
            {
                swal("Deleted!", "<?=lang('general_ledger_registered_successfully_deleted') ?>.", "success");
                location.replace("<?php echo base_url()?>general_ledger");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}

function showDetailGL(gl_no){
    clearAllDetailGL();

    $.ajax({
        url:'<?php echo base_url(); ?>general_ledger/get_data_detail',
		type: "POST",
        data: "journal_no="+gl_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        dataType:"JSON",
		success: function(result){
    		var x=0;
            var totalDebit = 0;
            var totalCredit = 0;
            
    		$.each(result, function(key, val) {	
        		x++;

                add_gl_detail();
                
                $('#reference_debtor_creditor_id').val(val.debtor_creditor_rowID);
                
                document.getElementById("debtor_creditor_rowID_"+x).innerHTML='';
                if(val.debtor_creditor_type == 'D'){
                    document.getElementById("debtor_creditor_rowID_"+x).innerHTML=document.getElementById("debtor_list").innerHTML;
                }
                else if(val.debtor_creditor_type == 'C'){
                    document.getElementById("debtor_creditor_rowID_"+x).innerHTML=document.getElementById("creditor_list").innerHTML;        
                }
                else{
                    document.getElementById("debtor_creditor_rowID_"+x).innerHTML='<option value="0">Other</option>';  
                }
                
                $('#debtor_creditor_rowID_'+x).select2('val',val.debtor_creditor_rowID);
                $('#debtor_creditor_type_'+x).val(val.debtor_creditor_type);
                
                $('#cash_bank_'+x).select2('val',val.coa_rowID);
                $('#descs_'+x).val(val.descs);

                if(val.row_no == 1){
                    totalDebit += parseFloat(val.trx_amt);
                    $('#amount_debit_'+x).val(number_format(val.trx_amt,2,',','.','format'));                    

                    if(val.trx_amt != 0){
                        $('#amount_credit_'+x).val('0');
                        $('#amount_credit_'+x).attr('readonly',true);
                    }
                    else{
                        $('#amount_credit_'+x).val('0');
                        $('#amount_credit_'+x).attr('readonly',false);        
                    }
                }
                else{
                    var credit_amt = val.trx_amt * -1;
                    totalCredit += parseFloat(credit_amt);
                    $('#amount_credit_'+x).val(number_format(credit_amt,2,',','.','format'));                                
                    
                    if(credit_amt != 0){
                        $('#amount_debit_'+x).val('0');
                        $('#amount_debit_'+x).attr('readonly',true);
                    }
                    else{
                        $('#amount_debit_'+x).val('0');
                        $('#amount_debit_'+x).attr('readonly',false);        
                    }
                }
                
      	     });
             
            totrowGl = x;
            
            $('#total_debit').val(number_format(totalDebit,2,',','.','format'));
            $('#total_credit').val(number_format(totalCredit,2,',','.','format'));

        }
        
   });

}

// END General Ledger

// Job Order
function edit_status_jo(year,month,code,status)
{
    swal({
      title: "Are you sure change status?",
      text: "change this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, change it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('job_order/update_status_jo/')?>/" + year + "/" + month + "/" + code + "/" + status,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               
               swal("Updated!", data.msg, "success");
               location.replace("<?php echo base_url('job_order')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}

function show_port_jo_type(){
    var port_warehouse = $('#port_jo_type').val();
    $.ajax({
        type: "POST",
        url : "<?php echo base_url('job_order/get_data_port_warehouse'); ?>",
    	data: "port_warehouse="+port_warehouse+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        cache:false,
        success: function(data){
            $('#port').html(data);
            $('#port').select2('val','');
        },
    	error: function(xhr, status, error) {
    		document.write(xhr.responseText);
    		alert(xhr.responseText);
    	}
    });      
}

function search_vessel_jo(){
    
    $('#modal_search_vessel_jo').modal('show');
    
    $('#tbl-data-vessel').DataTable().destroy();
    $('#tbl-data-vessel').dataTable({
		"bProcessing": true,
        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "sPaginationType": "full_numbers",
	});
}

function searchVesselJO(){
    $.ajax({
        type: "POST",
        url : "<?php echo base_url(); ?>job_order/get_data_vessel",
    	data: 'start_date='+$('#start_date').val()+'&end_date='+$('#end_date').val()+'&<?=$this->security->get_csrf_token_name()?>=<?=$this->security->get_csrf_hash()?>',
        dataType:"JSON",
        cache:false,
        success: function(result){
            
            $('#tbl-search-data-vessel').html('');

            var isi_table = '<thead>'+
                                '<tr>'+
                                    '<th>No</th>' +
                    				'<th><?=lang('vessel_no')?> </th>' +
            						'<th>ETA <?=lang('date')?> </th>' +
            						'<th><?=lang('vessel_name')?> </th>' +
            						'<th><?=lang('port_warehouse')?> </th>' +
            						'<th><?=lang('agent')?> </th>' +
            						'<th><?=lang('original_copy')?></th>' +
            						'<th><?=lang('status')?></th>' +
                                '</tr>'+
                            '</thead>';
                
            var no = 1;
            
            $.each(result, function(key, data) {	
				isi_table += '<tr onclick="get_data_vessel(\''+data.rowID+'\',\''+data.trx_no+'\',\''+data.vessel_name+'\')" style="cursor:pointer">'+
                                '<td>'+no+'</td>' +
                                '<td>'+data.trx_no+'</td>' +
        						'<td>'+data.eta_date+'</td>' +
        						'<td>'+data.vessel_name+'</td>' +
        						'<td>'+data.port_name+'</td>' +
        						'<td>'+data.agent+'</td>' +
        						'<td>'+data.original_copy+'</td>' +
        						'<td>'+data.status+'</td>' +  
                             '</tr>';
			     no++;
            });  
            
                      
            $('#tbl-search-data-vessel').append(isi_table);   
               
            $('#tbl-search-data-vessel').DataTable().destroy();
            $('#tbl-search-data-vessel').dataTable({
        		"aaSorting": [[0, 'asc']],
        		"bProcessing": true,
                "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
                "sPaginationType": "full_numbers",
        	});
            
        },
    	error: function(xhr, status, error) {
    		document.write(xhr.responseText);
    	}
    }); 
}

function get_data_vessel(vessel_id,vessel_no,vessel_name){
    $('#vessel_rowID').val(vessel_id);
    $('#vessel_no').val(vessel_no);
    $('#vessel_name').val(vessel_name);
    
    $('#modal_search_vessel_jo').modal('hide');
}

// END Job Order

// Job Order EMKL
<?php
if(!empty($count_data_detail_jo)){
    echo 'var totrowCD = '.($count_data_detail_jo+1).';';
}
else{
    echo 'var totrowCD = 1;';
}

if(!empty($count_data_detail_do_process)){
    echo 'var totrowDO = '.($count_data_detail_do_process+1).';';
}
else{
    echo 'var totrowDO = 1;';
}
?>

function addRow_do_process(){
    var detailrow="";
    detailrow=detailrow+"<tr id='rowDO_"+totrowDO+"'>";
    
    detailrow=detailrow+"<td>";
    var tombolhapus="<input type='button' style='height:30px;width:30px;border:0px;background-image:url(\"<?= base_url();?>resource/images/delete.png\");background-repeat:no-repeat;' title='Hapus Baris' value='&nbsp;' onclick='deleteDoProcess("+totrowDO+")' />";
    detailrow=detailrow+tombolhapus;    
    detailrow=detailrow+"</td>";
           
    detailrow=detailrow+"<td>";
    var input1="<input class='form-control input-sm' id='officer_name_"+totrowDO+"' name='officer_name[]' type='text' maxlength='30' autocomplete='off' />";
    detailrow=detailrow+input1;
    detailrow=detailrow+"</td>";

    detailrow=detailrow+"<td>";
    var input2="<input class='form-control input-sm text-center' id='collection_date_"+totrowDO+"' name='collection_date[]' type='text' maxlength='10' autocomplete='off' />";
    detailrow=detailrow+input2;
    detailrow=detailrow+"</td>";

    detailrow=detailrow+"<td>";
    var input3="<textarea class='form-control input-sm' id='remark_"+totrowDO+"' name='remark[]' maxlength='150' autocomplete='off' rows='2'></textarea>";
    detailrow=detailrow+input3;
    detailrow=detailrow+"</td>";
           
    detailrow=detailrow+"</tr>";

    $('#detail_do_process tr:last').after(detailrow);
    
    $('#collection_date_'+totrowDO).datepicker({
        format: 'dd-mm-yyyy',
        todayBtn: "linked",
    }).on('changeDate',function(ev){
        $('#collection_date_'+totrowDO).datepicker('hide');
	});
    
    totrowDO++;
    
}

function addRow_CargoDestination(){
    var detailrow="";
    detailrow=detailrow+"<tr id='rowCD_"+totrowCD+"'>";
    
    detailrow=detailrow+"<td>";
    var tombolhapus="<input type='button' style='height:30px;width:30px;border:0px;background-image:url(\"<?= base_url();?>resource/images/delete.png\");background-repeat:no-repeat;' title='Hapus Baris' value='&nbsp;' onclick='deleteCargoDestination("+totrowCD+")' />";
    detailrow=detailrow+tombolhapus;    
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"<td>";
    var party="<select class='form-control input-sm'  id='party_"+totrowCD+"' name='party[]' style='background-color:white;border:solid 1px #ccc;' /></select>";
    detailrow=detailrow+party;
    detailrow=detailrow+"</td>";
                                          
    detailrow=detailrow+"<td>";
    var cargo="<select class='form-control input-sm'  id='cargo_"+totrowCD+"' name='cargo[]' style='background-color:white;border:solid 1px #ccc;' /></select>";
    detailrow=detailrow+cargo;
    detailrow=detailrow+"</td>";

    detailrow=detailrow+"<td>";
    var destination="<select class='form-control input-sm'  id='destination_"+totrowCD+"' name='destination[]' style='background-color:white;border:solid 1px #ccc;' /></select>";
    detailrow=detailrow+destination;
    detailrow=detailrow+"</td>";
           
    detailrow=detailrow+"<td>";
    var weight="<input class='form-control input-sm angka_jutaan' id='weight_"+totrowCD+"' name='weight[]' type='text' style='text-align: left;' value='0' autocomplete='off' />";
    detailrow=detailrow+weight;
    detailrow=detailrow+"</td>";

    detailrow=detailrow+"<td>";
    var ContainerType="<select class='form-control input-sm'  id='container_type_"+totrowCD+"' name='container_type[]' style='background-color:white;border:solid 1px #ccc;' /></select>";
    detailrow=detailrow+ContainerType;
    detailrow=detailrow+"</td>";
           
    detailrow=detailrow+"</tr>";

    $('#detail_cargo_destination tr:last').after(detailrow);
    
    $('#cargo_'+totrowCD).select2();
    $('#destination_'+totrowCD).select2();
    document.getElementById("party_"+totrowCD).innerHTML=document.getElementById("party").innerHTML;
    document.getElementById("cargo_"+totrowCD).innerHTML=document.getElementById("item").innerHTML;
    document.getElementById("destination_"+totrowCD).innerHTML=document.getElementById("fare_trip").innerHTML;
    document.getElementById("container_type_"+totrowCD).innerHTML=document.getElementById("ContType").innerHTML;
    
    totrowCD++;
    
}

function edit_status_jo_emkl(year,month,code,status)
{
    swal({
      title: "Are you sure change status?",
      text: "change this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, change it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('job_order_emkl/update_status_jo_emkl/')?>/" + year + "/" + month + "/" + code + "/" + status,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               
               swal("Updated!", data.msg, "success");
               location.replace("<?php echo base_url('job_order_emkl')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}

function deleteCargoDestination(x){    
    if(document.getElementById('rowCD_'+x)!=null){
        $('#rowCD_'+x).remove(); 
    }
}


function deleteDoProcess(x){    
    if(document.getElementById('rowDO_'+x)!=null){
        $('#rowDO_'+x).remove(); 
    }
}

$('#start_demurage').blur(function(){
    var date1 = $('#eta_date').val();
    var date2 = $('#start_demurage').val();
    date1 = date1.split('-');
    date2 = date2.split('-');
    
    date1 = new Date(date1[2], date1[1], date1[0]);
    date2 = new Date(date2[2], date2[1], date2[0]);
    
    // We use the getTime() method and get the unixtime (in milliseconds, but we want seconds, therefore we divide it through 1000)
    date1_unixtime = parseInt(date1.getTime() / 1000);
    date2_unixtime = parseInt(date2.getTime() / 1000);
    
    // This is the calculated difference in seconds
    var timeDifference = date2_unixtime - date1_unixtime;
    
    // in Hours
    var timeDifferenceInHours = timeDifference / 60 / 60;
    
    // and finaly, in days :)
    var timeDifferenceInDays = timeDifferenceInHours  / 24;

    $('#free_time').val(timeDifferenceInDays);
});

// END Job Order EMKL

// Container
function add_container(jo_no){
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text('<?=lang('new_container')?>'); 
  
  $('#edit').val(''); 
  $('#jo_no').val(jo_no);

  clearAllDetailContainer();
  
}

function container_pdf(){
    window.open('<?php echo base_url('container/pdf')?>');
}

function container_excel(){
    window.open('<?php echo base_url('container/excel')?>');
}

function save_container(){
    var jo_no    = $('[name="jo_no"]').val(); 
    var validasi = "";
    
    var data1=cekValidasi(jo_no,'<?=lang('job_order_no')?>','<?=lang('not_empty')?>');
    validasi=data1;  

    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                if(clickSave == 0){
                    clickSave++;
                
                    $.ajax({
                        url : "<?php echo base_url('container/create')?>",
                        type: "POST",
                        data: $('#form').serializeArray(),
                        dataType: "JSON",
                        success: function(result)
                        {  
                            if (result.success){ 
                                $('#modal_form').modal('hide');
                                sweetAlert('<?=lang('information')?>',''+result.msg);   
                                location.replace("<?php echo base_url('container')?>");
                            }else{
                                sweetAlert('<?=lang('information')?>',''+result.msg); 
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal("Oops!", "Error saving data", "error");
                            clickSave = 0;
                        }
                        
                    }); 
                }
                else{
                    alert('<?=lang('data_in_process')?>');
                } 
            }
        });
    } 
}

function edit_container(jo_no)
{
    $('#form')[0].reset();
    $('#edit').val('edit'); 
    $('#jo_no').val(jo_no); 
    
    clearAllDetailContainer();
    
    showDetail20ft(jo_no);    
    showDetail40ft(jo_no);    
    showDetail45ft(jo_no);    
    
    $('#modal_form').modal('show');
    $('.modal-title').text('Edit <?=lang('container')?>'); 
   
}

function print_do_container(row_id)
{
    $('#form')[0].reset();
    $('[name="revisi"]').val('');
    $('[name="container_rowID"]').val('');
    $('[name="do_no"]').val('');
    $('[name="from_rowID"]').val('');
    $('[name="to_rowID"]').val('');
    $('[name="user_created"]').val('');
    $('[name="date_created"]').val('');
    $('[name="time_created"]').val('');
    
    $.ajax({
        url : "<?php echo base_url('container/get_data')?>/" + row_id,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {
            var revisi = 0;
            if(data.revisi == null || data.revisi == ''){
                revisi = 1;
            }
            else{
                revisi = parseInt(data.revisi) + 1;
            }
            
            $('[name="revisi"]').val(revisi);
            $('[name="container_rowID"]').val(data.container_rowID);
            $('[name="do_no"]').val(data.do_no);
            $('[name="jo_no"]').val(data.jo_no);
            $('[name="container_no"]').val(data.container_no);
            $('[name="vehicle_rowID"]').select2('val',data.vehicle_rowID);
            $('[name="vessel_name"]').val(data.vessel_name);
            $('[name="po_spk_no"]').val(data.po_spk_no);
            $('[name="user_created"]').val(data.created_user);
            $('[name="date_created"]').val(data.created_date);
            $('[name="time_created"]').val(data.created_time);

            $('[name="jo_detail_rowID"]').html('');            
            $.ajax({
                url : "<?php echo base_url('container/get_data_cargo')?>/" + data.jo_no,
                type: "GET",
                success: function(data_html)
                {
                    $('[name="jo_detail_rowID"]').html(data_html);
                    
                    $('[name="jo_detail_rowID"]').select2('val',data.jo_detail_rowID);
                    $('[name="from_rowID"]').val(data.from_rowID);
                    $('[name="to_rowID"]').val(data.to_rowID);
                    $('[name="port_warehouse"]').val(data.port_warehouse);
                    $('[name="sent_to"]').val(data.sent_to);
                    
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    swal("Oops!", "Error getting data", "error");
                }
            });
            
            $('#modal_form').modal('show');
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error getting data", "error");
        }
    });
}

function get_container_destination(){
    $.ajax({
        url : "<?php echo base_url('container/get_data_destination')?>/" + $('#jo_detail_rowID').val(),
        type: "GET",
        dataType: 'json',
        success: function(data)
        {
            $('[name="from_rowID"]').val(data.from_rowID);
            $('[name="to_rowID"]').val(data.to_rowID);
            $('[name="port_warehouse"]').val(data.from_name);
            $('[name="sent_to"]').val(data.address1+'\n'+data.address2+'\n'+data.address3);            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error getting data", "error");
        }
    });
}

function save_do_container(){
    var jo_no    = $('[name="jo_no"]').val(); 
    var vehicle_rowID = $('[name="vehicle_rowID"]').val();
    var jo_detail_rowID = $('[name="jo_detail_rowID"]').val();
    
    var validasi = "";
    
    var data1=cekValidasi(jo_no,'<?=lang('job_order_no')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(vehicle_rowID,'<?=lang('police_no')?>','<?=lang('not_empty')?>');
    var data3=cekValidasi(jo_detail_rowID,'Cargo Type','<?=lang('not_empty')?>');
    validasi=data1+data2+data3;  

    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                if(clickSave == 0){
                    clickSave++;
                
                    $.ajax({
                        url : "<?php echo base_url('container/create')?>",
                        type: "POST",
                        data: $('#form').serializeArray(),
                        dataType: "JSON",
                        success: function(result)
                        {  
                            if (result.success){ 
                                $('#modal_form').modal('hide');
                                sweetAlert('<?=lang('information')?>',''+result.msg);  
                                var url = "<?php echo base_url('container')?>/print_do/"+result.do_no;
                                
                                try {
                                    win = window.open(url, "_blank","width=1002,height=700,location=0,menubar=0,scrollbars=1,status=1,resizable=0");
                                    
                                    /*
                                    win = window.open();
                                    win.document.write('<html><head>blablabla.......');
                            
                                    var document_focus = false; // var we use to monitor document focused status.
                                    // Now our event handlers.
                                    $(document).ready(function() { win.window.print();document_focus = true; });
                                    setInterval(function() { if (document_focus === true) { win.window.close(); }  }, 300);
                                    */
                                    
                                    //window.open(url);
                                } catch(e) {
                                    location.target = "_blank";
                                    location.href = url;
                                }
                                
                                location.replace("<?php echo base_url('container')?>"); 
                            }else{
                                sweetAlert('<?=lang('information')?>',''+result.msg); 
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal("Oops!", "Error saving data", "error");
                            clickSave = 0;
                        }
                        
                    }); 
                }
                else{
                    alert('<?=lang('data_in_process')?>');
                } 
            }
        });
    } 
}

<?php
if(!empty($count_data_container_20ft_detail)){
    echo 'var totrow20ft = '.($count_data_container_20ft_detail+1).';';
}
else{
    echo 'var totrow20ft = 1;';
}
?>

function add_20ft(){  
    var detailrow="";
    detailrow=detailrow+"<tr id='row20ft_"+totrow20ft+"'>";
    
    detailrow=detailrow+"<td>";
    var tombolhapus="<input type='button' style='height:30px;width:30px;border:0px;background-image:url(\"<?= base_url();?>resource/images/delete.png\");background-repeat:no-repeat;' id='hapdetReimburse"+totrow20ft+"' title='Hapus Baris' value='&nbsp;' onclick='deleteDetail20ft("+totrow20ft+")' />";
    detailrow=detailrow+tombolhapus;    
    detailrow=detailrow+"</td>";
                                            
    detailrow=detailrow+"<td>";
    var container_no_20ft="<input id='row_id_20ft_"+totrow20ft+"' name='row_id_20ft[]' type='hidden' /><input class='form-control' id='container_no_20ft_"+totrow20ft+"' name='container_no_20ft[]' type='text' style='height:30px;border:solid 1px #ccc;' maxlength='50' />";
    detailrow=detailrow+container_no_20ft;
    detailrow=detailrow+"</td>";
           
    detailrow=detailrow+"<td>";
    var seal_no_20ft="<input class='form-control' id='seal_no_20ft_"+totrow20ft+"' name='seal_no_20ft[]' type='text' style='height:30px;border:solid 1px #ccc;' maxlength='50' />";
    detailrow=detailrow+seal_no_20ft;
    detailrow=detailrow+"</td>";

    detailrow=detailrow+"<td>";
    var replacement_seal_no_20ft="<input class='form-control' id='replacement_seal_no_20ft_"+totrow20ft+"' name='replacement_seal_no_20ft[]' type='text' style='height:30px;border:solid 1px #ccc;' maxlength='50' />";
    detailrow=detailrow+replacement_seal_no_20ft;
    detailrow=detailrow+"</td>";

    detailrow=detailrow+"<td>";
    var weight="<input class='form-control angka_jutaan' id='weight_20ft_"+totrow20ft+"' name='weight_20ft[]' type='text' style='height:30px;border:solid 1px #ccc;' value='0' />";
    detailrow=detailrow+weight;
    detailrow=detailrow+"</td>";
           
    detailrow=detailrow+"</tr>";

    $('#detail_20ft tr:last').after(detailrow);
    
    totrow20ft++;
   
}

function deleteDetail20ft(x){
    if($('#edit').val() == 'edit'){
        if(document.getElementById('row20ft_'+x)!=null){
            swal({
                title: "Are you sure?",
                text: "delete this data!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#f0ad4e",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function(){
              
                $.ajax({
                    url : "<?php echo base_url('container/delete_data')?>/" + $('#row_id_20ft_'+x).val(),
                    type: "GET",
                    dataType: "JSON",
                    success: function(data)
                    {
                       
                       swal("Deleted!", data.msg, "success");
                       
                       $('#row20ft_'+x).remove(); 
                       
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        //swal("Oops!", "Error delete data", "error");
                        $('#row20ft_'+x).remove(); 
                        $('.sweet-overlay').attr('style','display: none');
                        $('.sweet-alert').attr('style','display: none');
                    }
                });
            });
        }
    }
    else{
        if(document.getElementById('row20ft_'+x)!=null){
            $('#row20ft_'+x).remove(); 
        }
    }
}

<?php
if(!empty($count_data_container_40ft_detail)){
    echo 'var totrow40ft = '.($count_data_container_40ft_detail+1).';';
}
else{
    echo 'var totrow40ft = 1;';
}
?>

function add_40ft(){   
    var detailrow="";
    detailrow=detailrow+"<tr id='row40ft_"+totrow40ft+"'>";
    
    detailrow=detailrow+"<td>";
    var tombolhapus="<input type='button' style='height:30px;width:30px;border:0px;background-image:url(\"<?= base_url();?>resource/images/delete.png\");background-repeat:no-repeat;' id='hapdetReimburse"+totrow40ft+"' title='Hapus Baris' value='&nbsp;' onclick='deleteDetail40ft("+totrow40ft+")' />";
    detailrow=detailrow+tombolhapus;    
    detailrow=detailrow+"</td>";
                                            
    detailrow=detailrow+"<td>";
    var container_no_40ft="<input id='row_id_40ft_"+totrow40ft+"' name='row_id_40ft[]' type='hidden' /><input class='form-control' id='container_no_40ft_"+totrow40ft+"' name='container_no_40ft[]' type='text' style='height:30px;border:solid 1px #ccc;' maxlength='50' />";
    detailrow=detailrow+container_no_40ft;
    detailrow=detailrow+"</td>";
           
    detailrow=detailrow+"<td>";
    var seal_no_40ft="<input class='form-control' id='seal_no_40ft_"+totrow40ft+"' name='seal_no_40ft[]' type='text' style='height:30px;border:solid 1px #ccc;' maxlength='50' />";
    detailrow=detailrow+seal_no_40ft;
    detailrow=detailrow+"</td>";

    detailrow=detailrow+"<td>";
    var replacement_seal_no_40ft="<input class='form-control' id='replacement_seal_no_40ft_"+totrow40ft+"' name='replacement_seal_no_40ft[]' type='text' style='height:30px;border:solid 1px #ccc;' maxlength='50' />";
    detailrow=detailrow+replacement_seal_no_40ft;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"<td>";
    var weight="<input class='form-control angka_jutaan' id='weight_40ft_"+totrow40ft+"' name='weight_40ft[]' type='text' style='height:30px;border:solid 1px #ccc;' value='0' />";
    detailrow=detailrow+weight;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"</tr>";

    $('#detail_40ft tr:last').after(detailrow);
    
    totrow40ft++;
    
}

function deleteDetail40ft(x){
    if($('#edit').val() == 'edit'){
        if(document.getElementById('row40ft_'+x)!=null){
            swal({
                title: "Are you sure?",
                text: "delete this data!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#f0ad4e",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function(){
              
                $.ajax({
                    url : "<?php echo base_url('container/delete_data')?>/" + $('#row_id_40ft_'+x).val(),
                    type: "GET",
                    dataType: "JSON",
                    success: function(data)
                    {
                       
                       swal("Deleted!", data.msg, "success");
                       
                       $('#row40ft_'+x).remove(); 
                       
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        //swal("Oops!", "Error delete data", "error");
                        $('#row40ft_'+x).remove(); 
                        $('.sweet-overlay').attr('style','display: none');
                        $('.sweet-alert').attr('style','display: none');
                    }
                });
            });
        }
    }
    else{
        if(document.getElementById('row40ft_'+x)!=null){
            $('#row40ft_'+x).remove(); 
        }
    }
}

<?php
if(!empty($count_data_container_45ft_detail)){
    echo 'var totrow45ft = '.($count_data_container_45ft_detail+1).';';
}
else{
    echo 'var totrow45ft = 1;';
}
?>

function add_45ft(){
    var detailrow="";
    detailrow=detailrow+"<tr id='row45ft_"+totrow45ft+"'>";
    
    detailrow=detailrow+"<td>";
    var tombolhapus="<input type='button' style='height:30px;width:30px;border:0px;background-image:url(\"<?= base_url();?>resource/images/delete.png\");background-repeat:no-repeat;' title='Hapus Baris' value='&nbsp;' onclick='deleteDetail45ft("+totrow45ft+")' />";
    detailrow=detailrow+tombolhapus;    
    detailrow=detailrow+"</td>";
                                            
    detailrow=detailrow+"<td>";
    var container_no_45ft="<input id='row_id_45ft_"+totrow45ft+"' name='row_id_45ft[]' type='hidden' /><input class='form-control' id='container_no_45ft_"+totrow45ft+"' name='container_no_45ft[]' type='text' style='height:30px;border:solid 1px #ccc;' maxlength='50' />";
    detailrow=detailrow+container_no_45ft;
    detailrow=detailrow+"</td>";
           
    detailrow=detailrow+"<td>";
    var seal_no_45ft="<input class='form-control' id='seal_no_45ft_"+totrow45ft+"' name='seal_no_45ft[]' type='text' style='height:30px;border:solid 1px #ccc;' maxlength='50' />";
    detailrow=detailrow+seal_no_45ft;
    detailrow=detailrow+"</td>";

    detailrow=detailrow+"<td>";
    var replacement_seal_no_45ft="<input class='form-control' id='replacement_seal_no_45ft_"+totrow45ft+"' name='replacement_seal_no_45ft[]' type='text' style='height:30px;border:solid 1px #ccc;' maxlength='50' />";
    detailrow=detailrow+replacement_seal_no_45ft;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"<td>";
    var weight="<input class='form-control angka_jutaan' id='weight_45ft_"+totrow45ft+"' name='weight_45ft[]' type='text' style='height:30px;border:solid 1px #ccc;' value='0' />";
    detailrow=detailrow+weight;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"</tr>";

    $('#detail_45ft tr:last').after(detailrow);
    
    totrow45ft++;

}

function deleteDetail45ft(x){
    if($('#edit').val() == 'edit'){
        if(document.getElementById('row45ft_'+x)!=null){
            swal({
                title: "Are you sure?",
                text: "delete this data!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#f0ad4e",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function(){
              
                $.ajax({
                    url : "<?php echo base_url('container/delete_data')?>/" + $('#row_id_45ft_'+x).val(),
                    type: "GET",
                    dataType: "JSON",
                    success: function(data)
                    {
                       
                       swal("Deleted!", data.msg, "success");
                       
                       $('#row45ft_'+x).remove(); 
                       
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        //swal("Oops!", "Error delete data", "error");
                        $('#row45ft_'+x).remove(); 
                        $('.sweet-overlay').attr('style','display: none');
                        $('.sweet-alert').attr('style','display: none');
                    }
                });
            });
        }
    }
    else{
        if(document.getElementById('row45ft_'+x)!=null){
            $('#row45ft_'+x).remove(); 
        }
    }
}

function clearAllDetailContainer(){
    totrow20ft = 1;
    totrow40ft = 1;
    totrow45ft = 1;
    
    $('#detail_20ft').html('<tr valign="middle">'+
                                '<th width="5%">'+
                                    '<input id="tamdet" title="Tambah Baris" type="button" onclick="add_20ft()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url(\'<?= base_url();?>resource/images/plus.png\');background-repeat:no-repeat;" />'+
                                '</th>'+
                                '<th width="30%">Container No</th>'+
                                '<th width="30%">Seal No</th>'+
                                '<th width="35%">Replacement Seal No</th>'+
                            '</tr>');
    $('#detail_40ft').html('<tr valign="middle">'+
                                '<th width="5%">'+
                                    '<input id="tamdet" title="Tambah Baris" type="button" onclick="add_40ft()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url(\'<?= base_url();?>resource/images/plus.png\');background-repeat:no-repeat;" />'+
                                '</th>'+
                                '<th width="30%">Container No</th>'+
                                '<th width="30%">Seal No</th>'+
                                '<th width="35%">Replacement Seal No</th>'+
                            '</tr>');
    $('#detail_45ft').html('<tr valign="middle">'+
                                '<th width="5%">'+
                                    '<input id="tamdet" title="Tambah Baris" type="button" onclick="add_45ft()" value="&nbsp;" style="height:30px;width:30px;border;background-image:url(\'<?= base_url();?>resource/images/plus.png\');background-repeat:no-repeat;" />'+
                                '</th>'+
                                '<th width="30%">Container No</th>'+
                                '<th width="30%">Seal No</th>'+
                                '<th width="35%">Replacement Seal No</th>'+
                            '</tr>');
}

function showDetail20ft(jo_no){
    
    $.ajax({
        url:'<?php echo base_url(); ?>container/get_data_detail',
		type: "POST",
        data: 'jo_no='+jo_no+'&type=20ft&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        dataType:"JSON",
		success: function(result){
    		var x=1;
            var toDdMmYy = function(input) {
                var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
                if(!input || !input.match(ptrn)) {
                    return null;
                }
                return input.replace(ptrn, '$3-$2-$1');
            };
            
    		$.each(result, function(key, val) {	
                add_20ft();
                
                $('#row_id_20ft_'+x).val(val.rowID);
                $('#container_no_20ft_'+x).val(val.container_no);
                $('#seal_no_20ft_'+x).val(val.seal_no);
                $('#replacement_seal_no_20ft_'+x).val(val.replacement_seal_no);
                
        		x++;

      	    });
            
            totrow20ft = x;
        }
        
   });

}

function showDetail40ft(jo_no){
    
    $.ajax({
        url:'<?php echo base_url(); ?>container/get_data_detail',
		type: "POST",
        data: 'jo_no='+jo_no+'&type=40ft&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        dataType:"JSON",
		success: function(result){
    		var x=1;
            var toDdMmYy = function(input) {
                var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
                if(!input || !input.match(ptrn)) {
                    return null;
                }
                return input.replace(ptrn, '$3-$2-$1');
            };
            
    		$.each(result, function(key, val) {	
                add_40ft();
                
                $('#row_id_40ft_'+x).val(val.rowID);
                $('#container_no_40ft_'+x).val(val.container_no);
                $('#seal_no_40ft_'+x).val(val.seal_no);
                $('#replacement_seal_no_40ft_'+x).val(val.replacement_seal_no);
                
        		x++;

      	    });
            
            totrow40ft = x;
        }
        
   });

}

function showDetail45ft(jo_no){
    
    $.ajax({
        url:'<?php echo base_url(); ?>container/get_data_detail',
		type: "POST",
        data: 'jo_no='+jo_no+'&type=45ft&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        dataType:"JSON",
		success: function(result){
    		var x=1;
            var toDdMmYy = function(input) {
                var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
                if(!input || !input.match(ptrn)) {
                    return null;
                }
                return input.replace(ptrn, '$3-$2-$1');
            };
            
    		$.each(result, function(key, val) {	
                add_45ft();
                
                $('#row_id_45ft_'+x).val(val.rowID);
                $('#container_no_45ft_'+x).val(val.container_no);
                $('#seal_no_45ft_'+x).val(val.seal_no);
                $('#replacement_seal_no_45ft_'+x).val(val.replacement_seal_no);
                
        		x++;

      	    });
            
            totrow45ft = x;
        }
        
   });

}

// END Container

// Koordinat POI
function add_koordinat_poi(){
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text('<?=lang('add_koordinat_poi')?>'); 
  
  $('[name="rowID"]').val('');    
}

function koordinat_poi_pdf(){
    window.open('<?php echo base_url('koordinat_poi/pdf')?>');
}

function koordinat_poi_excel(){
    window.open('<?php echo base_url('koordinat_poi/excel')?>');
}

function save_koordinat_poi(){
    var location_name = $('[name="location_name"]').val();
    var latitude = $('[name="latitude"]').val();    
    var longitude = $('[name="longitude"]').val();
    var validasi="";
    
    var data1=cekValidasi(location_name,'Location Name','<?=lang('not_empty')?>');
    var data2=cekValidasi(latitude,'Latitude','<?=lang('not_empty')?>');
    var data3=cekValidasi(longitude,'Longitude','<?=lang('not_empty')?>');
    
    validasi=data1+data2+data3;  
     
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('koordinat_poi/create')?>",
                    type: "POST",
                    data: $('#form').serializeArray(),
                    dataType: "JSON",
                    success: function(result)
                    {  
                        if (result.success){ 
                            $('#modal_form').modal('hide');
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            location.replace("<?php echo base_url('koordinat_poi')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / updating data", "error");
                    }
                    
                });  
            }
        });
    } 
}

function edit_koordinat_poi(id)
{
  $('#form')[0].reset();
  $.ajax({
    url : "<?php echo base_url('koordinat_poi/get_data_edit/')?>/" + id,
    type: "GET",
    dataType: 'json',
    success: function(data)
    {
     
        $('[name="rowID"]').val(data.rowID);
        $('[name="location_name"]').val(data.location_name);
        $('[name="latitude"]').val(data.latitude);
        $('[name="longitude"]').val(data.longitude);
        $('[name="icon_url"]').val(data.icon_url);
        
        $('#modal_form').modal('show');
        $('.modal-title').text('<?=lang('edit_koordinat_poi')?>'); 
        
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        swal("Oops!", "Error update data", "error");
    }
  });
}

function delete_koordinat_poi(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('koordinat_poi/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               
               swal("Deleted!", "<?=lang('koordinat_poi_deleted_successfully') ?>.", "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('koordinat_poi')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}

function view_poi_image(id,image_url){
  $('[name="upload_rowid"]').val(id);  
  $('#modal_form_upload').modal('show'); 
  
  if(image_url == ''){
      $('#poi_image').attr('src','<?=base_url()?>resource/images/no_image.png');
  }
  else{
      $('#poi_image').attr('src','<?=base_url()?>resource/images/poi/' + image_url);
      $('#poi_image').attr('style','width:80%;height:350px;');
  }  
}

// END Koordinat POI

// Vehicle Monitor
function showImagePOI(image_url){
    if(image_url == ''){
        $('#poi_image').attr('src','<?=base_url()?>resource/images/no_image.png');
    }
    else{
        $('#poi_image').attr('src','<?=base_url()?>resource/images/poi/' + image_url);
    }
    
    $('#modal_image_poi').modal('show');     
}

function showImageVehicle(image_url){
    if(image_url == ''){
        $('#vehicle_image').attr('src','<?=base_url()?>resource/images/truck.png');
    }
    else{
        $('#vehicle_image').attr('src','<?=base_url()?>resource/images/vehicle/' + image_url);
    }
    
    $('#modal_image_vehicle').modal('show'); 
}

// END Vehicle Monitor

// Transporter Tarif 
function add_transporter_tarif(){
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text("<?=lang('new_transporter_tarif')?>"); 
  
  $('[name="rowID"]').val('');
  $('#edit').val(''); 
  
  $('#creditor_rowID').select2('val','');
  $('#cargo_rowID').select2('val','');
  $('#from_rowID').select2('val','');
    
  var y=totrowTarif;
  for(x=1;x<=y;x++){
    if(document.getElementById("rowTarif_"+x)){
        if(document.getElementById('rowTarif_'+x)!=null){
            $('#rowTarif_'+x).remove(); 
        }
    }
  }
  totrowTarif=0;
  
}

function transporter_tarif_pdf(){
    window.open('<?php echo base_url('transporter_tarif/pdf')?>');
}

function transporter_tarif_excel(){
    window.open('<?php echo base_url('transporter_tarif/excel')?>');
}

function save_transporter_tarif(){
    var creditor_rowID  = $('[name="creditor_rowID"]').val(); 
    var jo_type         = $('[name="jo_type"]').val();      
    var cargo_rowID      = $('[name="cargo_rowID"]').val();         
    var from_rowID           = $('[name="from_rowID"]').val();        
    var validasi        = "";
    
    var data1=cekValidasi(creditor_rowID,'<?=lang('creditor_type_name')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(jo_type,'<?=lang('jo_type')?>','<?=lang('not_empty')?>');
    var data3=cekValidasi(cargo_rowID,'<?=lang('cargo_name')?>','<?=lang('not_empty')?>');
    var data4=cekValidasi(from_rowID,'<?=lang('from')?>','<?=lang('not_empty')?>');
    var data_detail = '';
    
    validasi=data1+data2+data3+data4+data_detail;  
     
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('transporter_tarif/create')?>",
                    type: "POST",
                    data: $('#form').serializeArray(),
                    dataType: "JSON",
                    success: function(result)
                    {  
                        if (result.success){ 
                            $('#modal_form').modal('hide');
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            location.replace("<?php echo base_url('transporter_tarif')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error saving data", "error");
                    }
                    
                });  
            }
        });
    } 
}

function edit_transporter_tarif(id)
{
  $('#form')[0].reset();
  $('#edit').val('edit');
  
  var y=totrowTarif;
  for(x=1;x<=y;x++){
    if(document.getElementById("rowTarif_"+x)){
        if(document.getElementById('rowTarif_'+x)!=null){
            $('#rowTarif_'+x).remove(); 
        }
    }
  }
  totrowTarif=0;
            
  $.ajax({
    url : "<?php echo base_url('transporter_tarif/get_data_edit')?>/" + id,
    type: "GET",
    dataType: 'json',
    success: function(data)
    {
       
        $('[name="rowID"]').val(data.rowID);
        $('[name="creditor_rowID"]').select2('val',data.creditor_rowID);
        $('[name="jo_type"]').val(data.jo_type);
        $('[name="cargo_rowID"]').select2('val',data.cargo_rowID);
        $('[name="from_rowID"]').select2('val',data.from_rowID);
        
        showDetailTarif(data.rowID);    
        
        $('#modal_form').modal('show');
        $('.modal-title').text("Edit <?=lang('transporter_tarif')?>"); 
        
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        swal("Oops!", "Error getting data", "error");
    }
  });
}

function delete_transporter_tarif(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('transporter_tarif/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               
               swal("Deleted!", data.msg, "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('transporter_tarif')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}

var totrowTarif = 0;

function add_tarif(){
    var creditor_rowID  = $('[name="creditor_rowID"]').val(); 
    var jo_type         = $('[name="jo_type"]').val();      
    var cargo_rowID      = $('[name="cargo_rowID"]').val();         
    var from_rowID           = $('[name="from_rowID"]').val();        
    var validasi        = "";
    
    var data1=cekValidasi(creditor_rowID,'<?=lang('creditor_type_name')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(jo_type,'<?=lang('jo_type')?>','<?=lang('not_empty')?>');
    var data3=cekValidasi(cargo_rowID,'<?=lang('cargo_name')?>','<?=lang('not_empty')?>');
    var data4=cekValidasi(from_rowID,'<?=lang('from')?>','<?=lang('not_empty')?>');
    
    validasi=data1+data2+data3+data4;  
         
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        totrowTarif++;
        
        var detailrow="";
        detailrow=detailrow+"<tr id='rowTarif_"+totrowTarif+"'>";
        
        detailrow=detailrow+"<td>";
        var tombolhapus="<input type='button' style='height:30px;width:30px;border:0px;background-image:url(\"<?= base_url();?>resource/images/delete.png\");background-repeat:no-repeat;' id='hapdetReimburse"+totrowTarif+"'   title='Hapus Baris' value='&nbsp;' onclick='deleteDetailTarif("+totrowTarif+")' />";
        detailrow=detailrow+tombolhapus;    
        detailrow=detailrow+"</td>";
                                                
        detailrow=detailrow+"<td>";
        var eta_date="<input id='row_id_tarif_"+totrowTarif+"' name='row_id_tarif[]' type='hidden' /><select class='form-control' id='to_row_id_"+totrowTarif+"' name='to_row_id[]'></select>";
        detailrow=detailrow+eta_date;
        detailrow=detailrow+"</td>";

        detailrow=detailrow+"<td>";
        var vehicle="<select class='form-control' id='vehicle_type_rowID_"+totrowTarif+"' name='vehicle_type_rowID[]'></select>";
        detailrow=detailrow+vehicle;
        detailrow=detailrow+"</td>";
               
        detailrow=detailrow+"<td>";
        var remark="<input class='form-control' id='price_"+totrowTarif+"' name='price[]' style='text-align:right' />";
        detailrow=detailrow+remark;
        detailrow=detailrow+"</td>";
               
        detailrow=detailrow+"</tr>";

        $('#detail_tarif tr:last').after(detailrow);
        
        $('#to_row_id_'+totrowTarif).select2();
        $('#vehicle_type_rowID_'+totrowTarif).select2();
        $('#price_'+totrowTarif).mask('000.000.000', {reverse: true});
        document.getElementById("to_row_id_"+totrowTarif).innerHTML=document.getElementById("from_rowID").innerHTML;
        document.getElementById("vehicle_type_rowID_"+totrowTarif).innerHTML=document.getElementById("vehicle_type").innerHTML;
        
    }
    
}

function deleteDetailTarif(x){
    if($('#edit').val() == 'edit'){
        if(document.getElementById('rowTarif_'+x)!=null){
            if($('#row_id_tarif_'+x).val() != ''){
                swal({
                    title: "Are you sure?",
                    text: "delete this data!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#f0ad4e",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                },
                function(){
                  
                    $.ajax({
                        url : "<?php echo base_url('transporter_tarif/delete_detail_data')?>/" + $('#row_id_tarif_'+x).val(),
                        type: "GET",
                        dataType: "JSON",
                        success: function(data)
                        {
                           
                           swal("Deleted!", data.msg, "success");
                           
                           $('#rowTarif_'+x).remove(); 
                           
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal("Oops!", "Error delete data", "error");
                        }
                    });
                });
            }
            else{
                $('#rowTarif_'+x).remove(); 
                
            }
        }
    }
    else{
        if(document.getElementById('rowTarif_'+x)!=null){
            $('#rowTarif_'+x).remove(); 
        }
    }
    
}

function clearAllTarif(){
    var y=totrowTarif;
    for(x=1;x<=y;x++){
        if(document.getElementById("rowTarif_"+x)){
		     deleteDetailTarif(x);
       }
    }
    totrowTarif=0;
}

function showDetailTarif(rowID){

    $.ajax({
        url:'<?php echo base_url(); ?>transporter_tarif/get_data_detail',
		type: "POST",
        data: "rowID="+rowID+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        dataType:"JSON",
		success: function(result){
    		var x=1;
            
    		$.each(result, function(key, val) {	
                add_tarif();
                
                $('#row_id_tarif_'+x).val(val.rowID);
                $('#to_row_id_'+x).select2('val',val.to_rowID);
                $('#vehicle_type_rowID_'+x).select2('val',val.vehicle_type_rowID);
                $('#price_'+x).val(tandaPemisahTitik(val.price));
                
        		x++;

      	    });
            
            totrowTarif = x-1;
        }
        
   });

}

// END Transporter Tarif

// Cash Advance Deleted

function cash_advance_deleted_pdf(){
    window.open('<?php echo base_url('cash_advance_deleted/pdf')?>');
}

function cash_advance_deleted_excel(){
    window.open('<?php echo base_url('cash_advance_deleted/excel')?>');
}

// END Cash Advance Deleted

// Cancel Printed
function delete_activity2(row_id){
    swal({
      title: "Are you sure?",
      text: "Delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            type: "POST",
            url : "<?php echo base_url('ca_invoice_printed/delete_activity/')?>",
            data: "row_id="+row_id+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
            cache:false,
            success: function(data)
            {
               swal("Deleted!", "Activity has been deleted.", "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('ca_invoice_printed')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error deleting activity", "error");
            }
        });
    });
   
}

function delete_activity(row_id){
    $('#modal_form').modal('show');
    $('#rowID').val(row_id);    
}

function save_cancel_printed(){
    var remark = $('#remark').val();

    var validasi="";
    
    var data1=cekValidasi(remark,'<?=lang('remark')?>','<?=lang('not_empty')?>');
    
    validasi=data1;
    
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }
    else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('ca_invoice_printed/delete_activity')?>",
                    type: "POST",
                    data: $('#form').serializeArray(),
                    dataType: "JSON",
                    success: function(result)
                    {                 	            

                        if (result.success){ 
                            $('#modal_form').modal('hide');
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            location.replace("<?php echo base_url('ca_invoice_printed')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error verify data", "error");
                    }
                    
                });  
            }
        });
    }
}

// END Cancel Printed

// SPK Transporter
function search_jo_emkl(){
    var creditor    = $('[name="creditor_rowID"]').val();        
    var jo_type     = $('[name="jo_type"]').val();        
    var validasi    = "";
    
    var data1=cekValidasi(creditor,'<?=lang('creditor_name')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(jo_type,'<?=lang('jo_type')?>','<?=lang('not_empty')?>');
    
    validasi=data1+data2;  
         
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }
    else{
        $('#modal_search_jo_emkl').modal('show');
        
        $.ajax({
            type: "POST",
            url : "<?php echo base_url(); ?>spk_transporter/get_data_jo_emkl",
        	data: 'jo_type='+$('#jo_type').val()+'&start_date='+$('#start_date').val()+'&end_date='+$('#end_date').val()+'&<?=$this->security->get_csrf_token_name()?>=<?=$this->security->get_csrf_hash()?>',
            dataType:"JSON",
            cache:false,
            success: function(result){
                
                $('#tbl-search-data-jo-emkl').html('');
    
                var isi_table = '<thead>'+
                                    '<tr>'+
                                        '<th>No</th>' +
                        				'<th width="15%"><?=lang('job_order_emkl_no')?> </th>' +
                						'<th><?=lang('job_order_date')?> </th>' +
                						'<th><?=lang('jo_type')?> </th>' +
                						'<th><?=lang('debtor')?> </th>' +
                						'<th><?=lang('job_order_po_spk_no')?> </th>' +
                						'<th><?=lang('job_order_so_no')?> </th>' +
                						'<th><?=lang('vessel_name')?></th>' +
                						'<th><?=lang('port_name')?></th>' +
                                    '</tr>'+
                                '</thead>';
                    
                var no = 1;
                
                $.each(result, function(key, data) {	
    				isi_table += '<tr onclick="get_data_jo_emkl(\''+data.jo_no+'\')" style="cursor:pointer">'+
                                    '<td>'+no+'</td>' +
                                    '<td>'+data.jo_no+'</td>' +
            						'<td>'+data.jo_date+'</td>' +
            						'<td>'+data.jo_type+'</td>' +
            						'<td>'+data.debtor_name+'</td>' +
            						'<td>'+data.po_spk_no+'</td>' +
            						'<td>'+data.so_no+'</td>' +
            						'<td>'+data.vessel_name+'</td>' +
            						'<td>'+data.port_name+'</td>' +
                                 '</tr>';
    			     no++;
                });  
                
                          
                $('#tbl-search-data-jo-emkl').append(isi_table);   
                   
                $('#tbl-search-data-jo-emkl').DataTable().destroy();
                $('#tbl-search-data-jo-emkl').dataTable({
            		"aaSorting": [[0, 'asc']],
            		"bProcessing": true,
                    "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
                    "sPaginationType": "full_numbers",
            	});
                
            },
        	error: function(xhr, status, error) {
        		document.write(xhr.responseText);
        	}
        }); 
        
    }
    
}

function searchJOEMKL(){
    $.ajax({
        type: "POST",
        url : "<?php echo base_url(); ?>spk_transporter/get_data_jo_emkl",
    	data: 'jo_type='+$('#jo_type').val()+'&start_date='+$('#start_date').val()+'&end_date='+$('#end_date').val()+'&<?=$this->security->get_csrf_token_name()?>=<?=$this->security->get_csrf_hash()?>',
        dataType:"JSON",
        cache:false,
        success: function(result){
            
            $('#tbl-search-data-jo-emkl').html('');

            var isi_table = '<thead>'+
                                '<tr>'+
                                    '<th>No</th>' +
                    				'<th width="15%"><?=lang('job_order_emkl_no')?> </th>' +
            						'<th><?=lang('job_order_date')?> </th>' +
            						'<th><?=lang('jo_type')?> </th>' +
            						'<th><?=lang('debtor')?> </th>' +
            						'<th><?=lang('job_order_po_spk_no')?> </th>' +
            						'<th><?=lang('job_order_so_no')?> </th>' +
            						'<th><?=lang('vessel_name')?></th>' +
            						'<th><?=lang('port_name')?></th>' +
                                '</tr>'+
                            '</thead>';
                
            var no = 1;
            
            $.each(result, function(key, data) {	
				isi_table += '<tr onclick="get_data_jo_emkl(\''+data.jo_no+'\')" style="cursor:pointer">'+
                                '<td>'+no+'</td>' +
                                '<td>'+data.jo_no+'</td>' +
        						'<td>'+data.jo_date+'</td>' +
        						'<td>'+data.jo_type+'</td>' +
        						'<td>'+data.debtor_name+'</td>' +
        						'<td>'+data.po_spk_no+'</td>' +
        						'<td>'+data.so_no+'</td>' +
        						'<td>'+data.vessel_name+'</td>' +
        						'<td>'+data.port_name+'</td>' +
                             '</tr>';
			     no++;
            });  
            
                      
            $('#tbl-search-data-jo-emkl').append(isi_table);   
               
            $('#tbl-search-data-jo-emkl').DataTable().destroy();
            $('#tbl-search-data-jo-emkl').dataTable({
        		"aaSorting": [[0, 'asc']],
        		"bProcessing": true,
                "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
                "sPaginationType": "full_numbers",
        	});
            
        },
    	error: function(xhr, status, error) {
    		document.write(xhr.responseText);
    	}
    }); 
    
}

function get_data_jo_emkl(jo_no){
    $('#jo_no').val(jo_no);
    $('#modal_search_jo_emkl').modal('hide');
    
    $.ajax({
        type: "POST",
        url : "<?php echo base_url(); ?>spk_transporter/get_data_detail_jo_emkl",
    	data: 'jo_no='+$('#jo_no').val()+'&<?=$this->security->get_csrf_token_name()?>=<?=$this->security->get_csrf_hash()?>',
        dataType:"JSON",
        cache:false,
        success: function(result){
            
            $('#tbl-data-detail-jo-emkl').html('');

            var isi_table = '<thead>'+
                                '<tr>'+
                                    '<th width="5%">No</th>' +
                    				'<th width="30%"><?=lang('cargo')?> </th>' +
            						'<th width="30%"><?=lang('destination')?> </th>' +
            						'<th width="15%"><?=lang('job_order_weight')?> </th>' +
            						'<th width="20%"><?=lang('container_type')?> </th>' +
                                '</tr>'+
                            '</thead>';
                
            var no = 1;
            
            $.each(result, function(key, data) {	
				isi_table += '<tr>'+
                                '<td>'+no+'</td>' +
                                '<td>'+data.item_name+'</td>' +
        						'<td>'+data.destination+'</td>' +
        						'<td>'+data.weight+'</td>' +
        						'<td>'+data.container_type+'</td>' +        						
                             '</tr>';
			     no++;
            });  
            
                      
            $('#tbl-data-detail-jo-emkl').append(isi_table);   
               
        },
    	error: function(xhr, status, error) {
    		document.write(xhr.responseText);
    	}
    }); 
}

function setPriceSPK(item_rowID,destination_from_rowID,destination_to_rowID,rowID){
    clearAllDetailSPK();
    $('#item_rowID').val(item_rowID);  
    $('#destination_from_rowID').val(destination_from_rowID);  
    $('#destination_to_rowID').val(destination_to_rowID);  
    $('#rowID').val(rowID);  

    $.ajax({
        url:'<?php echo base_url(); ?>spk_transporter/get_data_detail_spk',
		type: "POST",
        data: 'spk_no='+$('#spk_transporter_no').val()+'&jo_emkl_detail_rowID='+rowID+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        dataType:"JSON",
		success: function(result){
    		var x=1;
            
    		$.each(result, function(key, val) {	
                add_spk_price();
                
                $('#vehicle_type_rowID_'+x).select2('val',val.vehicle_type_rowID);
                $('#price_'+x).val(tandaPemisahTitik(val.price));
                
        		x++;

      	    });
            
            totrowSPKPrice = x-1;
        }
        
    });
        
    $('#modal_form_set_price').modal('show');

}

var totrowSPKPrice = 0;

function add_spk_price(){   
    totrowSPKPrice++;
    
    var detailrow="";
    detailrow=detailrow+"<tr id='rowSPKPrice_"+totrowSPKPrice+"'>";
    
    detailrow=detailrow+"<td>";
    var tombolhapus="<input type='button' style='height:30px;width:30px;border:0px;background-image:url(\"<?= base_url();?>resource/images/delete.png\");background-repeat:no-repeat;' id='hapdetSPKPrice"+totrowSPKPrice+"' title='Delete Row' value='&nbsp;' onclick='deleteDetailSPK("+totrowSPKPrice+")' />";
    detailrow=detailrow+tombolhapus;    
    detailrow=detailrow+"</td>";
                                            
    detailrow=detailrow+"<td>";
    var destination="<select class='form-control input-sm' id='vehicle_type_rowID_"+totrowSPKPrice+"' onchange='getTarifTransporter("+totrowSPKPrice+")' name='vehicle_type_rowID[]' style='background-color:white;border:solid 1px #ccc;' /></select>";
    detailrow=detailrow+destination;
    detailrow=detailrow+"</td>";
           
    detailrow=detailrow+"<td>";
    var price="<input class='form-control input-sm' id='price_"+totrowSPKPrice+"' name='price[]' type='text' style='text-align: right;' value='0' autocomplete='off' />";
    detailrow=detailrow+price;
    detailrow=detailrow+"</td>";
           
    detailrow=detailrow+"</tr>";

    $('#detail_spk_price tr:last').after(detailrow);
    
    document.getElementById("vehicle_type_rowID_"+totrowSPKPrice).innerHTML = document.getElementById("vehicle_type").innerHTML;
    
    $('#vehicle_type_rowID_' + totrowSPKPrice).select2();
    $('#price_' + totrowSPKPrice).mask('000.000.000', {reverse: true});
    
}

function deleteDetailSPK(x){
    if(document.getElementById('rowSPKPrice_'+x)!=null){
        $('#rowSPKPrice_'+x).remove(); 
    }
}

function clearAllDetailSPK(){
    var y=totrowSPKPrice;
    for(x=1;x<=y;x++){
        if(document.getElementById("rowSPKPrice_"+x)){
		     deleteDetailSPK(x);
       }
    }
    totrowSPKPrice=0;
}

function save_spk_price(){
    var validasi = "";
    var vehicle_type_detail = "";
    var price_detail = "";
    
    if(totrowSPKPrice == 0){
        price_detail = cekValidasi('','Price Detail','<?=lang('not_empty')?>');
    }
    else{
        var y=totrowSPKPrice;
        if($('#jo_type').val() == '2'){
            for(var x=1;x<=y;x++){
                if($("#vehicle_type_rowID_"+x)){
                    if($("#vehicle_type_rowID_"+x).val() == '')
                        vehicle_type_detail = cekValidasi('','<?=lang('vehicle_category')?>','Not Complete');
                }
            }
        }
                
        for(var x=1;x<=y;x++){
            if($("#price_"+x)){
                if($("#price_"+x).val() == '')
                    price_detail = cekValidasi('','<?=lang('price')?>','Not Complete');
            }
        }
    }
    
    validasi = vehicle_type_detail+price_detail;  
     
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('spk_transporter/create_set_price')?>",
                    type: "POST",
                    data: $('#form_set_price').serializeArray(),
                    dataType: "JSON",
                    success: function(result)
                    {  
                        if (result.success){ 
                            $('#modal_form_set_price').modal('hide');
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            location.replace("<?php echo base_url('spk_transporter')?>/price_spk_transporter/" + $('#spk_transporter_year').val() + '/' + $('#spk_transporter_month').val() + '/' + $('#spk_transporter_code').val());
                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error saving data", "error");
                    }
                    
                });  
            }
        });
    } 
}

function delete_spk_transporter(spk_no)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
        $.ajax({
            url : "<?php echo base_url('spk_transporter/delete_spk_transporter/')?>/" + spk_no,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               swal("Deleted!", data.msg, "success");
               location.replace("<?php echo base_url('spk_transporter')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error deleting data", "error");
            }
        });
    });

}

function getTarifTransporter(row){
    $.ajax({
        url : "<?php echo base_url('spk_transporter/get_tarif_transporter')?>",
        type: "POST",
        data: 'creditor_rowID='+$('#creditor_rowID').val()+'&jo_type='+$('#jo_type').val()+'&item_rowID='+$('#item_rowID').val()+'&destination_from_rowID='+$('#destination_from_rowID').val()+
            '&destination_to_rowID='+$('#destination_to_rowID').val()+'&vehicle_type_rowID='+$('#vehicle_type_rowID_'+row).val()+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        dataType: "JSON",
        cache:false,
        success: function(data)
        {
            $("#price_"+row).val(tandaPemisahTitik(data.price));
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error getting data", "error");
        }
    });
}

// END SPK Transporter

// Brand
function add_brand(){
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text('<?=lang('new_brand')?>'); 
  
  $('[name="rowID"]').val('');    
}

function brand_pdf(){
    window.open('<?php echo base_url('brand/pdf')?>');
}

function brand_excel(){
    window.open('<?php echo base_url('brand/excel')?>');
}

function save_brand(){
    var brand_name = $('[name="brand_name"]').val();
    var validasi="";
    
    var data1=cekValidasi(brand_name,'<?=lang('brand_name')?>','<?=lang('not_empty')?>');
    
    validasi=data1;  
     
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('brand/create')?>",
                    type: "POST",
                    data: $('#form').serializeArray(),
                    dataType: "JSON",
                    success: function(result)
                    {  
                        if (result.success){ 
                            $('#modal_form').modal('hide');
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            location.replace("<?php echo base_url('brand')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / updating data", "error");
                    }
                    
                });  
            }
        });
    } 
}

function edit_brand(id)
{
  $('#form')[0].reset();
  $.ajax({
    url : "<?php echo base_url('brand/get_data_edit/')?>/" + id,
    type: "GET",
    dataType: 'json',
    success: function(data)
    {
     
        $('[name="rowID"]').val(data.rowID);
        $('[name="brand_name"]').val(data.brand_name);
        
        $('#modal_form').modal('show');
        $('.modal-title').text('<?=lang('edit_brand')?>'); 
        
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        swal("Oops!", "Error update data", "error");
    }
  });
}

function delete_brand(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('brand/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               swal("Deleted!", "<?=lang('deleting_brand_successfully') ?>.", "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('brand')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}
// END Brand

// Part/Service
function add_part_service(){
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text('<?=lang('new_part_service')?>'); 
  
  $('[name="rowID"]').val('');    
  $('#brand_rowID').select('val','');
  
  $('#brand_rowID').select2('val','');
  $('#discount_type').val('price');
  $('#discount').val('0');
    
  $('#type_name').html('Part');
  $('#text_type').html('');
  $('#text_type').hide();
  $('#type').show();
  
  $('.service').hide();
  $('.part').show();        
  $('.only_part').show();
  $('.discount').show();
            
  clearTemplateService();
  $('.template_service').hide();

}

function part_service_type(){
    var type_name = '';
    
    if($('#type').val() == 'service'){
        type_name = 'Service';
        $('.service').show();
        $('.part').hide();
        $('.only_part').hide();
        $('.discount').show();
        
        clearTemplateService();
        $('.template_service').hide();        
    }
    else if($('#type').val() == 'template'){
        type_name = 'Template';
        $('.service').hide();
        $('.part').hide();
        $('.only_part').hide();
        $('.discount').hide();
            
        clearTemplateService();
        $('.template_service').show();
    }
    else{
        if($('#type').val() == 'part'){
            type_name = 'Part';
            $('.only_part').show();
            
        }
        else{
            type_name = 'Material';
            $('.only_part').hide();
        }
        
        $('.service').hide();
        $('.part').show();        
        $('.discount').show();
        
        clearTemplateService();
        $('.template_service').hide();
    }
    
    $('#form')[0].reset(); 
    $('#brand_rowID').select2('val','');
    
    $('#type').val(type_name.toLowerCase());
    $('#type_name').html(type_name);
    $('#discount_type').val('price');
    $('#discount').val('0');
    
}

function part_service_pdf(){
    window.open('<?php echo base_url('part_service/pdf')?>');
}

function part_service_excel(){
    window.open('<?php echo base_url('part_service/excel')?>');
}

function save_part_service(){
    var name = $('[name="name"]').val();
    var type_name = '';
    var data_detail = ''; 
    var validasi = "";
    
    if($('#type').val() == 'service')
        type_name = 'Service';
    else if($('#type').val() == 'part')
        type_name = 'Part';
    else if($('#type').val() == 'material')
        type_name = 'Material';        
    else if($('#type').val() == 'template'){
        type_name = 'Template';        

        if(totrowTemplate == 0)
            data_detail=cekValidasi('','<?=lang('template_service')?>','<?=lang('not_empty')?>');
    }    
    
    var data1=cekValidasi(name,type_name + ' Name','<?=lang('not_empty')?>');
    
    validasi=data1+data_detail;  
     
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('part_service/create')?>",
                    type: "POST",
                    data: $('#form').serializeArray(),
                    dataType: "JSON",
                    success: function(result)
                    {  
                        if (result.success){ 
                            $('#modal_form').modal('hide');
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            location.replace("<?php echo base_url('part_service')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error adding / updating data", "error");
                    }
                    
                });  
            }
        });
    } 
}

function clearTemplateService(){
    var y=totrowTemplate;
    for(x=1;x<=y;x++){
        if(document.getElementById("rowTemplate_"+x)){
            if(document.getElementById('rowTemplate_'+x)!=null){
                $('#rowTemplate_'+x).remove(); 
            }
        }
    }
    totrowTemplate = 1;
    
}

function show_detail_template_service(code){
    
    $.ajax({
        url:'<?php echo base_url(); ?>part_service/get_data_template',
		type: "POST",
        data: "code="+code+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        dataType:"JSON",
		success: function(result){
    		var x=1;
            
    		$.each(result, function(key, val) {	
                add_template_service();
                
                $('#template_rowID_'+x).val(val.rowID);
                $('#service_code_'+x).select2('val',val.service_code);
                $('#work_hours_template_'+x).val(val.work_hours_template);
                $('#flat_rate_template_'+x).val(val.flat_rate_template);
                
        		x++;

      	    });
            
            totrowTemplate = x;
        }
        
    });

}

var totrowTemplate = 1;
function add_template_service(){  
    var detailrow="";
    detailrow=detailrow+"<tr id='rowTemplate_"+totrowTemplate+"'>";
    
    detailrow=detailrow+"<td>";
    var tombolhapus="<input type='button' style='height:30px;width:30px;border:0px;background-image:url(\"<?= base_url();?>resource/images/delete.png\");background-repeat:no-repeat;' title='Delete Row' value='&nbsp;' onclick='deleteTemplate("+totrowTemplate+")' />";
    detailrow=detailrow+tombolhapus;    
    detailrow=detailrow+"</td>";
                                            
    detailrow=detailrow+"<td>";
    var service_code="<input type='hidden' id='template_rowID_"+totrowTemplate+"' name='template_rowID[]' /><select class='form-control' id='service_code_"+totrowTemplate+"' name='service_code[]' onchange='get_long_work_service("+totrowTemplate+")' ></select>";
    detailrow=detailrow+service_code;
    detailrow=detailrow+"</td>";
           
    detailrow=detailrow+"<td>";
    var work_hours_template="<div class='input-group'><input class='form-control' id='work_hours_template_"+totrowTemplate+"' name='work_hours_template[]' type='text' style='height:30px;border:solid 1px #ccc;text-align:center' maxlength='5' value='0' onkeyup='IsNumericOnly(this);' /><span class='input-group-addon' id='basic-addon2'><?=lang('minute')?></span></div>";    
    detailrow=detailrow+work_hours_template;
    detailrow=detailrow+"</td>";

    detailrow=detailrow+"<td>";
    var flat_rate_template="<div class='input-group'><span class='input-group-addon' id='basic-addon1'>Rp</span><input class='form-control angka_jutaan' id='flat_rate_template_"+totrowTemplate+"' name='flat_rate_template[]' type='text' style='height:30px;border:solid 1px #ccc;text-align:right' value='0' /><span class='input-group-addon' id='basic-addon2'>/<?=lang('minute')?></span></div>";    
    detailrow=detailrow+flat_rate_template;
    detailrow=detailrow+"</td>";
           
    detailrow=detailrow+"</tr>";

    $('#detail_template_service tr:last').after(detailrow);
    
    document.getElementById("service_code_"+totrowTemplate).innerHTML = document.getElementById("services").innerHTML;
    $('#service_code_'+totrowTemplate).select2();
    
    totrowTemplate++;
    
}

function get_long_work_service(row){
    $.ajax({
        url:'<?php echo base_url(); ?>part_service/get_data_service',
		type: "POST",
        data: "service_code="+$('#service_code_'+row).val()+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        dataType:"JSON",
		success: function(result){
    		$('#work_hours_template_'+row).val(result.work_hours);
    		$('#flat_rate_template_'+row).val(tandaPemisahTitik(result.flat_rate));
        }
        
    });
}

function deleteTemplate(x){
    if(document.getElementById('rowTemplate_'+x)!=null){
        $('#rowTemplate_'+x).remove();
    }
}

function save_template_service(){
    var data_detail = ''; 
    var validasi = "";
    if(totrowTemplate == 0)
        data_detail=cekValidasi('','<?=lang('template_service')?>','<?=lang('not_empty')?>');
    
    validasi=data_detail;  

    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('part_service/create_template')?>",
                    type: "POST",
                    data: $('#form_template_service').serializeArray(),
                    dataType: "JSON",
                    success: function(result)
                    {  
                        if (result.success){ 
                            $('#modal_form_template_service').modal('hide');
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            location.replace("<?php echo base_url('part_service')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error saving data", "error");
                    }
                    
                });  
            }
        });
    } 

}

function edit_part_service(id)
{
  $('#form')[0].reset();
  $.ajax({
    url : "<?php echo base_url('part_service/get_data_edit/')?>/" + id,
    type: "GET",
    dataType: 'json',
    success: function(data)
    {     
        $('[name="rowID"]').val(data.rowID);
        $('#type').val(data.type);
        $('#name').val(data.name);
        $('#work_hours').val(data.work_hours);
        $('#flat_rate').val(tandaPemisahTitik(data.flat_rate));
        $('#moving_type').val(data.moving_type);
        $('#variant').val(data.variant);
        $('#brand_rowID').select2('val',data.brand_rowID);
        $('#uom_rowID').val(data.uom_rowID);
        $('#discount_type').val(data.discount_type);        
        $('#discount').val(tandaPemisahTitik(data.discount));
        $('#sale_price').val(tandaPemisahTitik(data.sale_price));
        $('#hpp').val(tandaPemisahTitik(data.hpp));
        $('#reorder').val(tandaPemisahTitik(data.reorder));
        $('#last_stock').val(tandaPemisahTitik(data.last_stock));
        
        var type_name = '';
        if(data.type == 'service'){
            type_name = 'Service';
            $('.service').show();
            $('.part').hide();
            $('.only_part').hide();
            $('.discount').show();
            
            clearTemplateService();
            $('.template_service').hide();  
        }
        else if(data.type == 'template'){
            type_name = 'Template';
            $('.service').hide();
            $('.part').hide();
            $('.only_part').hide();
            $('.discount').hide();
            
            clearTemplateService();
            show_detail_template_service(data.code);
            $('.template_service').show();
        }
        else{
            if(data.type == 'part'){
                type_name = 'Part';
                $('.only_part').show();
            }
            else{
                type_name = 'Material';
                $('.only_part').hide();
            }
            
            $('.service').hide();
            $('.part').show();        
            $('.discount').show();
            
            clearTemplateService();
            $('.template_service').hide();
        }
        
        $('#type_name').html(type_name);
        
        $('#text_type').html(type_name);
        $('#text_type').show();
        $('#type').hide();
        
        $('#modal_form').modal('show');
        $('.modal-title').text('<?=lang('edit_part_service')?>'); 
        
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        swal("Oops!", "Error update data", "error");
    }
  });
}

function delete_part_service(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('part_service/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               swal("Deleted!", "<?=lang('deleting_part_service_successfully') ?>.", "success");
               $('#modal_form').modal('hide');
               location.replace("<?php echo base_url('part_service')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}

// END Part/Service

// Service History
function add_service_history(){
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text('<?=lang('new_service_history')?>'); 
  
  $('[name="rowID"]').val('');    
  $('[name="vehicle_rowID"]').val($('#vehicle_id').val());    

  $('#debtor_rowID').select2();
  $('#debtor_rowID').select2('val','');
  $('#user_created').val('');
  $('#date_created').val('');
  $('#time_created').val('');
    
  clearComplaint();

}

function visible_add_service_history(){
    if($('#vehicle_id').val() == ''){
        $('#btnAddSH').hide();
    }
    else{
        $('#btnAddSH').show();        
    }
}

function service_history_pdf(){
    window.open('<?php echo base_url('service_history/pdf')?>');
}

function service_history_excel(){
    window.open('<?php echo base_url('service_history/excel')?>');
}

function clearComplaint(){
    var y=totrowComplaint;
    for(x=1;x<=y;x++){
        if(document.getElementById("rowComplaint_"+x)){
            if(document.getElementById('rowComplaint_'+x)!=null){
                $('#rowComplaint_'+x).remove(); 
            }
        }
    }
    totrowComplaint = 1;
    
}

function show_detail_complaint(trx_no){
    
    $.ajax({
        url:'<?php echo base_url(); ?>service_history/get_data_complaint',
		type: "POST",
        data: "trx_no="+trx_no+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        dataType:"JSON",
		success: function(result){
    		var x=1;
            
    		$.each(result, function(key, val) {	
                add_complaint();
                
                $('#complaint_note_'+x).val(val.complaint_note);
                
        		x++;

      	    });
            
            totrowComplaint = x;
        }
        
    });

}

var totrowComplaint = 1;
function add_complaint(){  
    var detailrow="";
    detailrow=detailrow+"<tr id='rowComplaint_"+totrowComplaint+"'>";
    
    detailrow=detailrow+"<td>";
    var tombolhapus="<input type='button' style='height:30px;width:30px;border:0px;background-image:url(\"<?= base_url();?>resource/images/delete.png\");background-repeat:no-repeat;' title='Delete Row' value='&nbsp;' onclick='deleteComplaint("+totrowComplaint+")' />";
    detailrow=detailrow+tombolhapus;    
    detailrow=detailrow+"</td>";
                                                   
    detailrow=detailrow+"<td>";
    var complaint_note="<textarea class='form-control' id='complaint_note_"+totrowComplaint+"' name='complaint_note[]' type='text' rows='2' maxlength='150'></textarea>";    
    detailrow=detailrow+complaint_note;
    detailrow=detailrow+"</td>";
           
    detailrow=detailrow+"</tr>";

    $('#detail_complaint tr:last').after(detailrow);
        
    totrowComplaint++;
    
}

function deleteComplaint(x){
    if(document.getElementById('rowComplaint_'+x)!=null){
        $('#rowComplaint_'+x).remove(); 
    }
}

function save_service_history(){
    var trx_date = $('#trx_date').val(); 
    var type = $('#type').val(); 
    var last_km = $('#last_km').val(); 
    var debtor_rowID = $('#debtor_rowID').val(); 
    var validasi = "";
    
    var data1=cekValidasi(trx_date,'<?=lang('complaint').' '.lang('date')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(type,'<?=lang('type')?>','<?=lang('not_empty')?>');
    var data3=cekValidasi(last_km,'<?=lang('last_km')?>','<?=lang('not_empty')?>');
    var data4=cekValidasi(debtor_rowID,'<?=lang('debtor_name')?>','<?=lang('not_empty')?>');
    
    validasi = data1+data2+data3+data4;  

    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                if(clickSave == 0){
                    clickSave++;
                
                    $.ajax({
                        url : "<?php echo base_url('service_history/create')?>",
                        type: "POST",
                        data: $('#form').serializeArray(),
                        dataType: "JSON",
                        success: function(result)
                        {  
                            if (result.success){ 
                                $('#modal_form').modal('hide');
                                sweetAlert('<?=lang('information')?>',''+result.msg);   
                                location.replace("<?php echo base_url('service_history')?>");
                            }else{
                                sweetAlert('<?=lang('information')?>',''+result.msg); 
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal("Oops!", "Error saving data", "error");
                            clickSave = 0;
                        }
                        
                    });  
                }
                else{
                    alert('<?=lang('data_in_process')?>');
                }
            }
        });
    } 

}

function edit_service_history(id)
{
  $('#form')[0].reset();
  $('#debtor_rowID').select2();
  clearComplaint();
  
  $.ajax({
    url : "<?php echo base_url('service_history/get_data_edit/')?>/" + id,
    type: "GET",
    dataType: 'json',
    success: function(data)
    {   
        var toDdMmYy = function(input) {
            var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
            if(!input || !input.match(ptrn)) {
                return null;
            }
            return input.replace(ptrn, '$3-$2-$1');
        };
        
        $('[name="rowID"]').val(data.rowID);
        $('[name="vehicle_rowID"]').val(data.vehicle_rowID);
        $('#trx_date').val(toDdMmYy(data.trx_date));
        $('#type').val(data.type);
        $('#last_km').val(tandaPemisahTitik(data.last_km));
        $('#debtor_rowID').select2('val',data.debtor_rowID);
        $('#user_created').val(data.user_created);
        $('#date_created').val(data.date_created);
        $('#time_created').val(data.time_created);
            
        show_detail_complaint(data.trx_no);
        
        $('#modal_form').modal('show');
        $('.modal-title').text('<?=lang('edit_service_history')?>'); 
        
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        swal("Oops!", "Error update data", "error");
    }
  });
}

function delete_service_history(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('service_history/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               swal("Deleted!", "<?=lang('deleting_service_history_successfully') ?>.", "success");
               location.replace("<?php echo base_url('service_history')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}

function create_spk_service(id){
    $('#form_spk')[0].reset();
    $('#template').hide();
    
    $.ajax({
        url : "<?=base_url()?>service_history/get_data_spk/" + id,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {   
            var toDdMmYy = function(input) {
                var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
                if(!input || !input.match(ptrn)) {
                    return null;
                }
                return input.replace(ptrn, '$3-$2-$1');
            };
            
            $('[name="complaint_rowID"]').val(data.rowID);
            $('#complaint_no_spk').val(data.trx_no);
            $('#trx_date_spk').val(toDdMmYy(data.trx_date));
            $('#type_spk').val(data.type);
            $('#last_km_spk').val(tandaPemisahTitik(data.last_km));
            $('#debtor_name_spk').val(data.debtor_name);
            $('#spk_user_created').val(data.usercreated);
            $('#spk_date_created').val(data.datecreated);
            $('#spk_time_created').val(data.timecreated);
            
            if(data.spk_no != null && data.deleted_spk == 0){
                $('#trx_no').val(data.spk_no);
                $('#type_work_list').val(data.type_work_list);
                $('#template_service_code').select2('val',data.template_service_code);
                if(data.change_oil == 1){
                    $('#change_oil').attr('checked',true);            
                }
                else{
                    $('#change_oil').attr('checked',false);
                }
                
                if(data.type_work_list == 'Unit'){
                    $('#template').hide();
                    $('#template_service_code').select2('val','');
                }
                else{
                    $('#template').show();
                    $('#template_service_code').select2('val',data.template_service_code);
                }
                
                $('#cost_service').val(tandaPemisahTitik(data.cost_service));
                $('#cost_part').val(tandaPemisahTitik(data.cost_part));
                $('#cost_labour').val(tandaPemisahTitik(data.cost_labour));
                $('#cost_other').val(tandaPemisahTitik(data.cost_other));
                $('#cost_total').val(tandaPemisahTitik(data.cost_total));            

                $('#spk_no_field').show();
                $('.modal-title-spk').text('<?=lang('update_spk')?>'); 
                
                show_detail_template_service_spk(data.spk_no);
                show_detail_part_material(data.spk_no);
                show_detail_mechanic(data.spk_no);
                
            }
            else{
                $('#spk_no_field').hide();
                $('#change_oil').attr('checked',false);
                $('.modal-title-spk').text('<?=lang('create_spk')?>'); 
            
                clearTemplateServiceSPK();
                clearPartMaterial();
                clearMechanic();
            }
            
            $('#modal_form_spk').modal('show');
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error loading data", "error");
        }
    });
}

function jobs_return(id){
    $('#form_spk')[0].reset();
    $('#template').hide();
    
    $.ajax({
        url : "<?=base_url()?>service_history/get_data_spk/" + id,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {   
            var toDdMmYy = function(input) {
                var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
                if(!input || !input.match(ptrn)) {
                    return null;
                }
                return input.replace(ptrn, '$3-$2-$1');
            };
            
            $('[name="complaint_rowID"]').val(data.rowID);
            $('#complaint_no_spk').val(data.trx_no);
            $('#trx_date_spk').val(toDdMmYy(data.trx_date));
            $('#type_spk').val(data.type);
            $('#last_km_spk').val(tandaPemisahTitik(data.last_km));
            $('#debtor_name_spk').val(data.debtor_name);
            $('#spk_user_created').val(data.usercreated);
            $('#spk_date_created').val(data.datecreated);
            $('#spk_time_created').val(data.timecreated);
            
            if(data.spk_no != null && data.deleted_spk == 0){
                $('#type_work_list').val(data.type_work_list);
                $('#template_service_code').select2('val',data.template_service_code);
                if(data.change_oil == 1){
                    $('#change_oil').attr('checked',true);            
                }
                else{
                    $('#change_oil').attr('checked',false);
                }
                
                if(data.type_work_list == 'Unit'){
                    $('#template').hide();
                    $('#template_service_code').select2('val','');
                }
                else{
                    $('#template').show();
                    $('#template_service_code').select2('val',data.template_service_code);
                }
                
                $('#cost_service').val(tandaPemisahTitik(data.cost_service));
                $('#cost_part').val(tandaPemisahTitik(data.cost_part));
                $('#cost_labour').val(tandaPemisahTitik(data.cost_labour));
                $('#cost_other').val(tandaPemisahTitik(data.cost_other));
                $('#cost_total').val(tandaPemisahTitik(data.cost_total));            

                $('#spk_no_field').show();
                $('.modal-title-spk').text('Jobs Return'); 
                
                show_detail_template_service_spk(data.spk_no);
                show_detail_part_material(data.spk_no);
                show_detail_mechanic(data.spk_no);
                
            }
            else{
                $('#spk_no_field').hide();
                $('#change_oil').attr('checked',false);
                $('.modal-title-spk').text('<?=lang('create_spk')?>'); 
                
                clearTemplateServiceSPK();
                clearPartMaterial();
                clearMechanic();
            }
            
            $('#modal_form_spk').modal('show');
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error loading data", "error");
        }
    });
}

function progress_spk_service(id){
    $('#form_progress_spk')[0].reset();
    
    $.ajax({
        url : "<?=base_url()?>service_history/get_data_spk/" + id,
        type: "GET",
        dataType: 'json',
        success: function(data)
        {   
            $('#spk_no').val(data.spk_no);
            $('#police_no').val(data.police_no);
            
            show_detail_progress_service_spk(data.spk_no);
                        
            $('#modal_form_progress_spk').modal('show');
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error loading data", "error");
        }
    });
}

function print_service_invoice(trx_no){
    window.open('<?php echo base_url('service_history/print_service_invoice')?>/'+trx_no);    
}

function print_progress_spk_service(trx_no){
    window.open('<?php echo base_url('service_history/print_progress_spk')?>/'+trx_no);
}

function save_spk_service_history(){
    var complaint_no_spk = $('#complaint_no_spk').val(); 
    var cost_labour = $('#cost_labour').val(); 
    var cost_other = $('#cost_other').val(); 
    var type_work_list = $('#type_work_list').val(); 
    var template_service_code = $('#template_service_code').val(); 
    
    var validasi = "";
    
    var data1=cekValidasi(complaint_no_spk,'<?=lang('complaint_no')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(cost_labour,'<?=lang('cost_of_labour')?>','<?=lang('not_empty')?>');
    var data3=cekValidasi(cost_other,'<?=lang('cost_of_others')?>','<?=lang('not_empty')?>');
    var data4=cekValidasi(type_work_list,'<?=lang('type_work_list')?>','<?=lang('not_empty')?>');
    var data5='';
    
    if(type_work_list == 'Template'){
        data5=cekValidasi(template_service_code,'<?=lang('template_service')?>','<?=lang('not_empty')?>');
    }
    
    validasi = data1+data2+data3+data4+data5;  

    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('service_history/create_spk')?>",
                    type: "POST",
                    data: $('#form_spk').serializeArray(),
                    dataType: "JSON",
                    success: function(result)
                    {  
                        if (result.success){ 
                            $('#modal_form_spk').modal('hide');
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            location.replace("<?php echo base_url('service_history')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error saving data", "error");
                    }
                    
                });  
            }
        });
    } 

}

function save_progress_spk_service_history(){
    var spk_no = $('#spk_no').val(); 
    var police_no = $('#police_no').val(); 
    
    var validasi = "";
    
    var data1=cekValidasi(spk_no,'<?=lang('spk_no')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(police_no,'<?=lang('police_no')?>','<?=lang('not_empty')?>');
    
    validasi = data1+data2;  

    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                  $.ajax({
                    url : "<?php echo base_url('service_history/create_progress_spk')?>",
                    type: "POST",
                    data: $('#form_progress_spk').serializeArray(),
                    dataType: "JSON",
                    success: function(result)
                    {  
                        if (result.success){ 
                            $('#modal_form_progress_spk').modal('hide');
                            sweetAlert('<?=lang('information')?>',''+result.msg);   
                            location.replace("<?php echo base_url('service_history')?>");
                        }else{
                            sweetAlert('<?=lang('information')?>',''+result.msg); 
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Oops!", "Error saving data", "error");
                    }
                    
                });  
            }
        });
    } 

}

$('#type_work_list').change(function(){
    if($('#type_work_list').val() == 'Unit'){
        $('#template').hide();
        $('#template_service_code').select2('val','');
    }
    else{
        $('#template').show();
    }
});

function get_long_work_service_spk(row){
    $.ajax({
        url:'<?php echo base_url(); ?>service_history/get_data_service',
		type: "POST",
        data: "service_code="+$('#service_code_'+row).val()+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        dataType:"JSON",
		success: function(result){
    		$('#work_hours_template_'+row).val(result.work_hours);
    		$('#flat_rate_template_'+row).val(tandaPemisahTitik(result.flat_rate));

            sumFlatRate();

        }
        
    });
}

function get_data_part_material(row){
    $.ajax({
        url:'<?php echo base_url(); ?>service_history/get_data_part_material_master',
		type: "POST",
        data: "part_material_code="+$('#part_material_code_'+row).val()+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        dataType:"JSON",
		success: function(result){
    		$('#qty_'+row).val(1);
    		$('#price_'+row).val(tandaPemisahTitik(result.sale_price));

            sumPartMaterial();

        }
        
    });
}

function show_data_template_service(){
    clearTemplateServiceSPK();
    
    $.ajax({
        url:'<?php echo base_url(); ?>service_history/get_data_template',
		type: "POST",
        data: "code="+$('#template_service_code').val()+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        dataType:"JSON",
		success: function(result){
    		var x=1;
            
    		$.each(result, function(key, val) {	
                add_template_service_spk();
                
                $('#template_rowID_'+x).val(val.rowID);
                $('#service_code_'+x).select2('val',val.service_code);
                $('#work_hours_template_'+x).val(val.work_hours_template);
                $('#flat_rate_template_'+x).val(tandaPemisahTitik(val.flat_rate_template));
                
        		x++;

      	    });
            
            totrowTemplate = x;
            sumFlatRate();
        
        }
        
    });
    
}

function sumTotalSPK(){
    var cost_service = 0;
    var cost_part = 0;
    var cost_labour = 0;
    var cost_other = 0;
    var cost_total = 0;
    
    if($('#cost_service').val() != ""){
        cost_service = number_format($('#cost_service').val(),0,',','.','deformat');
    }
    if($('#cost_part').val() != ""){
        cost_part = number_format($('#cost_part').val(),0,',','.','deformat');
    }
    if($('#cost_labour').val() != ""){
        cost_labour = number_format($('#cost_labour').val(),0,',','.','deformat');
    }
    if($('#cost_other').val() != ""){
        cost_other = number_format($('#cost_other').val(),0,',','.','deformat');
    }
    
    cost_total = parseFloat(cost_service + cost_part + cost_labour + cost_other);
    
    $('#cost_total').val(number_format(cost_total,0,',','.','format'));   
}

function sumFlatRate(){
    var y=totrowTemplate;
    var totNil=0;
    
    for(x=1;x<=y;x++){
        if(document.getElementById("flat_rate_template_"+x)){
            if(document.getElementById('flat_rate_template_'+x)!=null){
                if(document.getElementById('work_hours_template_'+x).value != "" && document.getElementById('flat_rate_template_'+x).value != ""){
                    var work_hours_template = number_format(document.getElementById('work_hours_template_'+x).value,0,',','.','deformat');
                    var flat_rate_template = number_format(document.getElementById('flat_rate_template_'+x).value,0,',','.','deformat');
                    var nilai = parseInt(work_hours_template * flat_rate_template);
                    totNil += parseInt(nilai);
                    
                }
            }
        }
    }
    
    $('#cost_service').val(number_format(totNil,0,',','.','format'));   
    sumTotalSPK();
}

function sumPartMaterial(){
    var y=totrowPartMaterial;
    var totNil=0;
    
    for(x=1;x<=y;x++){
        if(document.getElementById("price_"+x)){
            if(document.getElementById('price_'+x)!=null){
                if(document.getElementById('qty_'+x).value != "" && document.getElementById('price_'+x).value != ""){
                    var qty = number_format(document.getElementById('qty_'+x).value,0,',','.','deformat');
                    var price = number_format(document.getElementById('price_'+x).value,0,',','.','deformat');
                    var nilai = parseInt(qty * price);
                    totNil += parseInt(nilai);
                    
                }
            }
        }
    }
    
    $('#cost_part').val(number_format(totNil,0,',','.','format'));   
    sumTotalSPK();
}

// Work List
function clearTemplateServiceSPK(){
    var y=totrowTemplate;
    for(x=1;x<=y;x++){
        if(document.getElementById("rowTemplate_"+x)){
            if(document.getElementById('rowTemplate_'+x)!=null){
                $('#rowTemplate_'+x).remove(); 
            }
        }
    }
    totrowTemplate = 1;
    
    sumFlatRate();
}

function show_detail_template_service_spk(code){
    clearTemplateServiceSPK();
    
    $.ajax({
        url:'<?php echo base_url(); ?>service_history/get_data_template_spk',
		type: "POST",
        data: "code="+code+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        dataType:"JSON",
		success: function(result){
    		var x=1;
            
    		$.each(result, function(key, val) {	
                add_template_service_spk();
                
                $('#template_spk_rowID_'+x).val(val.rowID);
                $('#service_code_'+x).select2('val',val.service_code);
                $('#work_hours_template_'+x).val(val.work_hours_spk);
                $('#flat_rate_template_'+x).val(tandaPemisahTitik(val.flat_rate_spk));
                
        		x++;

      	    });
            
            totrowTemplate = x;
            sumFlatRate();

        }
        
    });
    
}

var totrowTemplate = 1;
function add_template_service_spk(){  
    var detailrow="";
    detailrow=detailrow+"<tr id='rowTemplate_"+totrowTemplate+"'>";
    
    detailrow=detailrow+"<td>";
    var tombolhapus="<input type='button' style='height:30px;width:30px;border:0px;background-image:url(\"<?= base_url();?>resource/images/delete.png\");background-repeat:no-repeat;' title='Delete Row' value='&nbsp;' onclick='deleteTemplateSPK("+totrowTemplate+")' />";
    detailrow=detailrow+tombolhapus;    
    detailrow=detailrow+"</td>";
                                            
    detailrow=detailrow+"<td>";
    var service_code="<input type='hidden' id='template_rowID_"+totrowTemplate+"' name='template_rowID[]' /><input type='hidden' id='template_spk_rowID_"+totrowTemplate+"' name='template_spk_rowID[]' /><select class='form-control' id='service_code_"+totrowTemplate+"' name='service_code[]' onchange='get_long_work_service_spk("+totrowTemplate+")' ></select>";
    detailrow=detailrow+service_code;
    detailrow=detailrow+"</td>";
           
    detailrow=detailrow+"<td>";
    var work_hours_template="<div class='input-group'><input class='form-control' id='work_hours_template_"+totrowTemplate+"' name='work_hours_template[]' type='text' style='height:30px;border:solid 1px #ccc;text-align:center' maxlength='5' value='0' onkeyup='IsNumericOnly(this);sumFlatRate();' /><span class='input-group-addon' id='basic-addon2'><?=lang('minute')?></span></div>";    
    detailrow=detailrow+work_hours_template;
    detailrow=detailrow+"</td>";

    detailrow=detailrow+"<td>";
    var flat_rate_template="<div class='input-group'><span class='input-group-addon' id='basic-addon1'>Rp</span><input class='form-control angka_jutaan' id='flat_rate_template_"+totrowTemplate+"' name='flat_rate_template[]' type='text' style='height:30px;border:solid 1px #ccc;text-align:right' value='0' onkeyup='sumFlatRate();' /><span class='input-group-addon' id='basic-addon2'>/<?=lang('minute')?></span></div>";    
    detailrow=detailrow+flat_rate_template;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"</tr>";

    $('#detail_template_service tr:last').after(detailrow);
    
    document.getElementById("service_code_"+totrowTemplate).innerHTML = document.getElementById("services").innerHTML;
    $('#service_code_'+totrowTemplate).select2();
    
    totrowTemplate++;
    
}

function deleteTemplateSPK(x){
    if(document.getElementById('rowTemplate_'+x)!=null){
        if($('#template_rowID_'+x).val() != ''){
            swal({
                title: "Are you sure?",
                text: "Delete this service template",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#f0ad4e",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function(){
                swal("Deleted!", "Delete success.", "success");
                $('#rowTemplate_'+x).remove();
            });
        }
        else{
            $('#rowTemplate_'+x).remove();
        }
    }
}

// Part/Material
function clearPartMaterial(){
    var y=totrowPartMaterial;
    for(x=1;x<=y;x++){
        if(document.getElementById("rowPartMaterial_"+x)){
            if(document.getElementById('rowPartMaterial_'+x)!=null){
                $('#rowPartMaterial_'+x).remove(); 
            }
        }
    }
    totrowPartMaterial = 1;
    
    sumPartMaterial();
}

function show_detail_part_material(code){
    clearPartMaterial();
    
    $.ajax({
        url:'<?php echo base_url(); ?>service_history/get_data_part_material',
		type: "POST",
        data: "code="+code+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        dataType:"JSON",
		success: function(result){
    		var x=1;
            
    		$.each(result, function(key, val) {	
                add_part_material();
                
                $('#part_material_rowID_'+x).val(val.rowID);
                $('#part_material_code_'+x).select2('val',val.part_material_code);
                $('#qty_'+x).val(val.qty);
                $('#price_'+x).val(tandaPemisahTitik(val.price));
                
        		x++;

      	    });
            
            totrowPartMaterial = x;
            sumPartMaterial();
        }
        
    });
    
}

var totrowPartMaterial = 1;
function add_part_material(){  
    var detailrow="";
    detailrow=detailrow+"<tr id='rowPartMaterial_"+totrowPartMaterial+"'>";
    
    detailrow=detailrow+"<td>";
    var tombolhapus="<input type='button' style='height:30px;width:30px;border:0px;background-image:url(\"<?= base_url();?>resource/images/delete.png\");background-repeat:no-repeat;' title='Delete Row' value='&nbsp;' onclick='deletePartMaterial("+totrowPartMaterial+")' />";
    detailrow=detailrow+tombolhapus;    
    detailrow=detailrow+"</td>";
                                            
    detailrow=detailrow+"<td>";
    var service_code="<input type='hidden' id='part_material_rowID_"+totrowPartMaterial+"' name='part_material_rowID[]' /><select class='form-control' id='part_material_code_"+totrowPartMaterial+"' name='part_material_code[]' onchange='get_data_part_material("+totrowPartMaterial+")' ></select>";
    detailrow=detailrow+service_code;
    detailrow=detailrow+"</td>";
           
    detailrow=detailrow+"<td>";
    var qty="<input class='form-control' id='qty_"+totrowPartMaterial+"' name='qty[]' type='text' style='height:30px;border:solid 1px #ccc;text-align:left' maxlength='5' value='0' onkeyup='IsNumericOnly(this);sumPartMaterial();' />";    
    detailrow=detailrow+qty;
    detailrow=detailrow+"</td>";

    detailrow=detailrow+"<td>";
    var price="<div class='input-group'><span class='input-group-addon' id='basic-addon1'>Rp</span><input class='form-control angka_jutaan' id='price_"+totrowPartMaterial+"' name='price[]' type='text' style='height:30px;border:solid 1px #ccc;text-align:right' value='0' onkeyup='sumPartMaterial();' /></div>";    
    detailrow=detailrow+price;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"</tr>";

    $('#detail_part_material tr:last').after(detailrow);
    
    document.getElementById("part_material_code_"+totrowPartMaterial).innerHTML = document.getElementById("part_materials").innerHTML;
    $('#part_material_code_'+totrowPartMaterial).select2();
    
    totrowPartMaterial++;
    
}

function deletePartMaterial(x){
    if(document.getElementById('rowPartMaterial_'+x)!=null){
        if($('#part_material_rowID_'+x).val() != ''){
            swal({
                title: "Are you sure?",
                text: "Delete this part/material data",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#f0ad4e",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function(){
                swal("Deleted!", "Delete success.", "success");
                $('#rowPartMaterial_'+x).remove();
            });
        }
        else{
            $('#rowPartMaterial_'+x).remove();
        }
    }
}

// Mechanic List
function clearMechanic(){
    var y=totrowMechanic;
    for(x=1;x<=y;x++){
        if(document.getElementById("rowMechanic_"+x)){
            if(document.getElementById('rowMechanic_'+x)!=null){
                $('#rowMechanic_'+x).remove(); 
            }
        }
    }
    totrowMechanic = 1;
    
}

function show_detail_mechanic(code){
    clearMechanic();
    
    $.ajax({
        url:'<?php echo base_url(); ?>service_history/get_data_mechanic',
		type: "POST",
        data: "code="+code+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        dataType:"JSON",
		success: function(result){
    		var x=1;
            
    		$.each(result, function(key, val) {	
                add_mechanic_list();
                
                $('#mechanic_rowID_'+x).val(val.rowID);
                $('#debtor_rowID_'+x).select2('val',val.debtor_rowID);
                
        		x++;

      	    });
            
            totrowMechanic = x;
        }
        
    });
    
}

var totrowMechanic = 1;
function add_mechanic_list(){  
    var detailrow="";
    detailrow=detailrow+"<tr id='rowMechanic_"+totrowMechanic+"'>";
    
    detailrow=detailrow+"<td>";
    var tombolhapus="<input type='button' style='height:30px;width:30px;border:0px;background-image:url(\"<?= base_url();?>resource/images/delete.png\");background-repeat:no-repeat;' title='Delete Row' value='&nbsp;' onclick='deleteMechanic("+totrowMechanic+")' />";
    detailrow=detailrow+tombolhapus;    
    detailrow=detailrow+"</td>";
                                            
    detailrow=detailrow+"<td>";
    var debtor_rowID="<input type='hidden' id='mechanic_rowID_"+totrowMechanic+"' name='mechanic_rowID[]' /><select class='form-control' id='debtor_rowID_"+totrowMechanic+"' name='debtor_rowID[]'></select>";
    detailrow=detailrow+debtor_rowID;
    detailrow=detailrow+"</td>";
           
    detailrow=detailrow+"</tr>";

    $('#detail_mechanic_list tr:last').after(detailrow);
    
    document.getElementById("debtor_rowID_"+totrowMechanic).innerHTML = document.getElementById("mechanics").innerHTML;
    $('#debtor_rowID_'+totrowMechanic).select2();
    
    totrowMechanic++;
    
}

function deleteMechanic(x){
    if(document.getElementById('rowMechanic_'+x)!=null){
        if($('#mechanic_rowID_'+x).val() != ''){
            swal({
                title: "Are you sure?",
                text: "Delete this part/material data",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#f0ad4e",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function(){
                swal("Deleted!", "Delete success.", "success");
                $('#rowMechanic_'+x).remove();
            });
        }
        else{
            $('#rowMechanic_'+x).remove();
        }
    }
}

// Progress SPK
function clearProgressServiceSPK(){
    var y=totrowProgress;
    for(x=1;x<=y;x++){
        if(document.getElementById("rowProgress_"+x)){
            if(document.getElementById('rowProgress_'+x)!=null){
                $('#rowProgress_'+x).remove(); 
            }
        }
    }
    totrowProgress = 1;
    
}

function show_detail_progress_service_spk(code){
    clearProgressServiceSPK();
    
    $.ajax({
        url:'<?php echo base_url(); ?>service_history/get_data_template_spk',
		type: "POST",
        data: "code="+code+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        dataType:"JSON",
		success: function(result){
    		var x=1;
            var toDdMmYy = function(input) {
                var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
                if(!input || !input.match(ptrn)) {
                    return null;
                }
                return input.replace(ptrn, '$3-$2-$1');
            };
            
    		$.each(result, function(key, val) {	
                add_progress_service_spk();
                
                $('#rowIDProgress_'+x).val(val.rowID);
                $('#service_name_'+x).html(val.service_name);
                $('#progress_date_'+x).val(toDdMmYy(val.progress_date));
                $('#start_hours_'+x).val(val.start_hours);
                $('#end_hours_'+x).val(val.end_hours);
                $('#status_'+x).val(val.status);
                
        		x++;

      	    });
            
            totrowProgress = x;

        }
        
    });
    
}

var totrowProgress = 1;
function add_progress_service_spk(){  
    var detailrow="";
    detailrow=detailrow+"<tr id='rowProgress_"+totrowProgress+"'>";
    
    detailrow=detailrow+"<td>";
    detailrow=detailrow+totrowProgress;    
    detailrow=detailrow+"</td>";
                                            
    detailrow=detailrow+"<td>";
    var service_code="<input type='hidden' id='rowIDProgress_"+totrowProgress+"' name='rowIDProgress[]' /><span id='service_name_"+totrowProgress+"'></span>";
    detailrow=detailrow+service_code;
    detailrow=detailrow+"</td>";
                                      
    detailrow=detailrow+"<td>";
    var progress_date="<input type='text' class='form-control' id='progress_date_"+totrowProgress+"' name='progress_date[]' />";
    detailrow=detailrow+progress_date;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"<td>";
    var start_hours="<input type='text' class='form-control' id='start_hours_"+totrowProgress+"' name='start_hours[]' />";
    detailrow=detailrow+start_hours;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"<td>";
    var end_hours="<input type='text' class='form-control' id='end_hours_"+totrowProgress+"' name='end_hours[]' />";
    detailrow=detailrow+end_hours;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"<td>";
    var end_hours="<select class='form-control' id='status_"+totrowProgress+"' name='status[]'></select>";
    detailrow=detailrow+end_hours;
    detailrow=detailrow+"</td>";
    
    detailrow=detailrow+"</tr>";

    $('#detail_work_list tr:last').after(detailrow);
    
    document.getElementById("status_"+totrowProgress).innerHTML = document.getElementById("service_status").innerHTML;
    $("#progress_date_"+totrowProgress).datetimepicker({
        format: 'DD-MM-YYYY',
        showTodayButton:true
	});
    
    $("#start_hours_"+totrowProgress).datetimepicker({
         format: 'HH:mm:ss'
    });
    
    $("#end_hours_"+totrowProgress).datetimepicker({
         format: 'HH:mm:ss'
    });
    
    totrowProgress++;
    
}

// END Service History

// Planning Order
function new_planning_order(){
    location.replace("<?php echo base_url('planning_order/new_planning_order')?>");
}

function edit_planning_order(id){
    location.replace("<?php echo base_url('planning_order/edit_planning_order')?>/" + id);
}

function show_planning_order_detail(){
    $.ajax({
        type: "POST",
        url : "<?php echo base_url('planning_order/get_detail_jo')?>",
    	data: 'jo_no='+$('#jo_no').val()+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        cache:false,
        success: function(data){
            $('#desc_vessel').html(data.vessel_no + ' - ' + data.vessel_name);
            $('#desc_po_spk_no').html(data.po_spk_no);
            $('#desc_so_no').html(data.so_no);
            $('#desc_port_name').html(data.port_name);
            $('#desc_destination').html(data.from_name + ' - ' + data.to_name);
        }
    });
    
    $.ajax({
        type: "POST",
        url : "<?php echo base_url('planning_order/show_planning_order_detail')?>",
    	data: 'jo_no='+$('#jo_no').val()+'&trx_date='+$('#trx_date').val()+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        cache:false,
        success: function(result){
            $('#planning_order_detail').html(result);
        }
    });
}

function show_edit_planning_order_detail(){
    $.ajax({
        type: "POST",
        url : "<?php echo base_url('planning_order/get_detail_jo')?>",
    	data: 'jo_no='+$('#jo_no').val()+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        cache:false,
        success: function(data){
            $('#desc_vessel').html(data.vessel_no + ' - ' + data.vessel_name);
            $('#desc_po_spk_no').html(data.po_spk_no);
            $('#desc_so_no').html(data.so_no);
            $('#desc_port_name').html(data.port_name);
            $('#desc_destination').html(data.from_name + ' - ' + data.to_name);
        }
    });
    
    $.ajax({
        type: "POST",
        url : "<?php echo base_url('planning_order/show_edit_planning_order_detail')?>",
    	data: 'trx_no='+$('#trx_no').val()+'&jo_no='+$('#jo_no').val()+'&trx_date='+$('#trx_date').val()+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        cache:false,
        success: function(result){
            $('#planning_order_detail').html(result);
        }
    });
}

function delete_planning_order(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('planning_order/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                if (data.success){ 
                    swal("Deleted!", data.msg, "success");
                    location.replace("<?php echo base_url('planning_order')?>");
                }
                else{
                    swal("Oops!", data.msg, "error");
                }                
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}

// END Planning Order

// Planning Order Monitor
function detail_job_order_monitor(jo_no, vessel_name, destination){
    $('#modal_jo_detail').modal('show');

    $('#jo_no').html(jo_no);  
    $('#vessel_name').html(vessel_name);  
    $('#destination').html(destination);  
}

// END Planning Order Monitor

// BALANCE SHEET REPORT
function report_type_balance(){
    if($('#report_type').val() == 'Neraca Scontro' || $('#report_type').val() == 'Profit and Loss'){
        $('#time_type_field').show();
    }
    else{
        $('#time_type_field').hide();        
    }
    
    $('#period_month_year').show();
    $('#period_month_year_profit').hide();
    
    $('#time_type').val('monthly');
    $('#print_type_field').show();        
    $('#print_type').val('pdf');
}

function time_type_balance(){
    if($('#time_type').val() == 'yearly'){
        $('#print_type_field').hide();
        $('#print_type').val('excel');
        $('#period_month_year_profit').show();
        $('#period_month_year').hide();
    }
    else{
        $('#print_type_field').show();        
        $('#print_type').val('pdf');
        $('#period_month_year_profit').hide();
        $('#period_month_year').show();
    }
}

// END BALANCE SHEET REPORT

// DRIVER ATTENDANCE

function editNoteAttendance(rowID){
    $('#note_'+rowID).attr('readonly',false);
    $('#edit_'+rowID).hide();
    $('#save_'+rowID).show();
}

function saveNoteAttendance(rowID){
    
    var note = $('#note_'+rowID).val();
    
    sweetAlert({
      title: "Are you sure?",
      text: "Are you want to Save?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#286090",
      confirmButtonText: "Yes, Save !",
      closeOnConfirm: true,
      html: false
    },function(r){ 
        if (r){
              $.ajax({
                url : "<?php echo base_url('driver_attendance_monitor/update_note_driver_attendance')?>",
                type: "POST",
                data: 'rowID='+rowID+'&note='+note+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
                dataType: "JSON",
                success: function(result)
                {  
                    if (result.success){ 
                        sweetAlert('<?=lang('information')?>',''+result.msg);   
                        location.replace("<?php echo base_url('driver_attendance_monitor')?>");
                    }else{
                        sweetAlert('<?=lang('information')?>',''+result.msg); 
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    swal("Oops!", "Error saving data", "error");
                }
                
            });  
        }
    });
}

function uang_makan_supir(rowID){    
    sweetAlert({
      title: "Are you sure?",
      text: "Are you want to adding data Uang Makan ?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#286090",
      confirmButtonText: "Yes, Add !",
      closeOnConfirm: true,
      html: false
    },function(r){ 
        if (r){
              $.ajax({
                url : "<?php echo base_url('driver_attendance_monitor/add_uang_makan_stand_by_supir')?>",
                type: "POST",
                data: 'rowID='+rowID+'&transaction_type=uang_makan&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
                dataType: "JSON",
                success: function(result)
                {  
                    if (result.success){ 
                        sweetAlert('<?=lang('information')?>',''+result.msg);   
                        location.replace("<?php echo base_url('driver_attendance_monitor')?>");
                    }else{
                        sweetAlert('<?=lang('information')?>',''+result.msg); 
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    swal("Oops!", "Error saving data", "error");
                }
                
            });  
        }
    });
}

function stand_by_supir(rowID){    
    sweetAlert({
      title: "Are you sure?",
      text: "Are you want to adding data Stand By ?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#286090",
      confirmButtonText: "Yes, Add !",
      closeOnConfirm: true,
      html: false
    },function(r){ 
        if (r){
              $.ajax({
                url : "<?php echo base_url('driver_attendance_monitor/add_uang_makan_stand_by_supir')?>",
                type: "POST",
                data: 'rowID='+rowID+'&transaction_type=stand_by&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
                dataType: "JSON",
                success: function(result)
                {  
                    if (result.success){ 
                        sweetAlert('<?=lang('information')?>',''+result.msg);   
                        location.replace("<?php echo base_url('driver_attendance_monitor')?>");
                    }else{
                        sweetAlert('<?=lang('information')?>',''+result.msg); 
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    swal("Oops!", "Error saving data", "error");
                }
                
            });  
        }
    });
}

// END DRIVER ATTENDANCE

// SERVICE RECEIPT 
function add_service_receipt(){
  $('#form')[0].reset(); 
  $('#modal_form').modal('show'); 
  $('.modal-title').text('<?=lang('new_service_receipt')?>'); 
  clearReceipt();
  
  $('[name="rowID"]').val('');
  $('[name="debtor_rowID"]').select2('val','');
}

function service_receipt_pdf(){
    window.open('<?php echo base_url('service_receipt/pdf')?>');
}

function service_receipt_excel(){
    window.open('<?php echo base_url('service_receipt/excel')?>');
}

function print_service_receipt(trx_no){
    window.open('<?php echo base_url('service_receipt/print_service_receipt')?>/'+trx_no);
}

function save_service_receipt(){
    
    var date            = $('[name="trx_date"]').val();
    var debtor_rowID    = $('[name="debtor_rowID"]').val();        
    var total           = $('[name="total"]').val();        
    var validasi        = "";
    
    var data1=cekValidasi(date,'<?=lang('date')?>','<?=lang('not_empty')?>');
    var data2=cekValidasi(debtor_rowID,'<?=lang('debtor_name')?>','<?=lang('not_empty')?>');
    var data3=cekValidasi(total,'<?=lang('total')?>','<?=lang('not_empty')?>');
    var data4="";
    
    var looprows=totalrow+1;
    var totNil = 0;
    for(z=1;z<looprows; z++){  
        if(document.getElementById('amount'+z)!=null  ){
            if(document.getElementById('amount'+z).value!="" ){
                var nilai=number_format(document.getElementById('amount'+z).value,0,',','.','deformat');
                totNil +=parseFloat(nilai);
            }
        }
    }
    
    if(totNil == 0){
        data4=cekValidasi('','Detail Service Receipt','<?=lang('not_empty')?>');
    }
    
    validasi=data1+data2+data3+data4;  
     
    if(validasi!=""){
        sweetAlert('<?=lang('information')?>',''+validasi);
        return false;
    }else{
        sweetAlert({
          title: "Are you sure?",
          text: "Are you want to Save?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#286090",
          confirmButtonText: "Yes, Save !",
          closeOnConfirm: true,
          html: false
        },function(r){ 
            if (r){
                if(clickSave == 0){
                    clickSave++;
                
                    $.ajax({
                        url : "<?php echo base_url('service_receipt/create')?>",
                        type: "POST",
                        data: $('#form').serializeArray(),
                        dataType: "JSON",
                        success: function(result)
                        {  
                            if (result.success){ 
                                $('#modal_form').modal('hide');
                                sweetAlert('<?=lang('information')?>',''+result.msg);   
                                location.replace("<?php echo base_url('service_receipt')?>");
                            }else{
                                sweetAlert('<?=lang('information')?>',''+result.msg); 
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal("Oops!", "Error saving data", "error");
                            clickSave = 0;
                        }
                        
                    });  
                }
                else{
                    alert('<?=lang('data_in_process')?>');
                }
            }
        });
    } 
}

function delete_service_receipt(id)
{
    swal({
      title: "Are you sure?",
      text: "delete this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f0ad4e",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      
          $.ajax({
            url : "<?php echo base_url('service_receipt/delete_data/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               swal("Deleted!", "Data has been deleted.", "success");
               location.replace("<?php echo base_url('service_receipt')?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops!", "Error delete data", "error");
            }
        });
    });

}

function edit_service_receipt(id)
{
  $('#form')[0].reset();
  clearReceipt();
  $.ajax({
    url : "<?php echo base_url('service_receipt/get_data_edit')?>/" + id,
    type: "GET",
    dataType: 'json',
    success: function(data)
    {
        var toDdMmYy = function(input) {
            var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
            if(!input || !input.match(ptrn)) {
                return null;
            }
            return input.replace(ptrn, '$3-$2-$1');
        };
        
        $('[name="rowID"]').val(data.rowID);
        $('[name="trx_date"]').val(toDdMmYy(data.trx_date));
        $('[name="debtor_rowID"]').select2('val',data.debtor_rowID);
        $('[name="total"]').val(tandaPemisahTitik(data.total));
        $('[name="remark"]').val(data.remark);
        
        $.ajax({
            url : "<?php echo base_url('service_receipt/get_data_detail')?>/"+data.trx_no,
    	    type: "GET",
    		dataType:"JSON",
    		success: function(result){
        		var x = 0;
                var total = 0;
        		
                $.each(result, function(key, val) {	
            		x++;
            		add_row_service_receipt();
                    
                    $('#spk_no'+x).select2('val',val.spk_no);
                    $('#descriptions'+x).val(val.descriptions)
                    $('#amount'+x).val(number_format(val.amount,0,',','.','format'));
                    total += parseInt(val.amount);
        	
                });
                $('#Total').val(number_format(total,0,',','.','format'));
            }
            
        });
    
        $('#modal_form').modal('show');
        $('.modal-title').text('<?=lang('update_service_receipt')?>'); 
        
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        swal("Oops!", "Error getting data", "error");
    }
  });
}

function add_row_service_receipt(){
    totalrow++;
    var detailrow="";
    detailrow=detailrow+"<tr id='row"+totalrow+"'>";

    detailrow=detailrow+"<td>";
    var tombolhapus="<input type='button' style='height:30px;width:30px;border:0px;background-image:url(\"<?= base_url();?>resource/images/delete.png\");background-repeat:no-repeat;' id='hapdet"+totalrow+"'   title='Hapus Baris' value='&nbsp;' onclick='DeleteRowReceipt("+totalrow+")' />";
    detailrow=detailrow+tombolhapus;
    detailrow=detailrow+"</td>";
        
    var reference="<select class='yellowtext' id='spk_no"+totalrow+"' name='spk_no[]' type='text' style='height:30px;width:100%;background-color:white;border:solid 1px #ccc;' onchange='getDataServiceSPK("+totalrow+")' /></select>";
	detailrow=detailrow+"<td>"+reference+"</td>";
    
    detailrow=detailrow+"<td >";
    var text1="<textarea class='form-control' id='descriptions"+totalrow+"' name='descriptions[]' maxlength='150'></textarea>";
    detailrow=detailrow+text1;
    detailrow=detailrow+"</td>";

    detailrow=detailrow+"<td >";
    var text2="<input class='form-control angka_jutaan' onkeyup='sumDetailReceipt("+totalrow+");' id='amount"+totalrow+"' name='amount[]' type='text' style='text-align:right;height:30px;background-color:white;border:solid 1px #ccc;'  value=''  />";
    detailrow=detailrow+text2;
    detailrow=detailrow+"</td>";
                
    detailrow=detailrow+"</tr>";
    
    $('#service_receipt_detail tr:last').after(detailrow);
   
    $("#spk_no"+totalrow).select2();
    	
    if($('[name="rowID"]').val() == ''){
        document.getElementById("spk_no"+totalrow).innerHTML=document.getElementById("spk_no_not_receipt").innerHTML;            
    }
    else{
        document.getElementById("spk_no"+totalrow).innerHTML=document.getElementById("spk_no").innerHTML;    
    }
}

    
function DeleteRowReceipt(x){
    if(document.getElementById("row"+x) != null){
        $('#row'+x).remove(); 
        sumDetailReceipt(x);
     }
}
     
function clearReceipt(){
    var y=totalrow+1;
    for(x=0;x<y;x++){
        if(document.getElementById("row"+x)){
		  DeleteRowReceipt(x);
        }
    }
    totalrow=0;
}

function sumDetailReceipt(x){
    var looprows=totalrow+1;
    var totNil=0;

    for(z=1;z<looprows; z++){  
        if(document.getElementById('amount'+z)!=null  ){
            if(document.getElementById('amount'+z).value!="" ){
                var nilai=number_format(document.getElementById('amount'+z).value,0,',','.','deformat');
                totNil +=parseFloat(nilai);
            }
        }
    }
    document.getElementById('total').value=number_format(totNil,0,',','.','format');

} 

function getDataServiceSPK(x){
    $.ajax({
        url : "<?php echo base_url('service_receipt/get_data_spk')?>",
        type: "POST",
        data: 'row='+x+'&spk_no='+$('#spk_no'+x).val()+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
        dataType:"JSON",
        cache:false,
        success: function(data)
        {
            $('#descriptions'+data.row).val(data.descriptions);
            $('#amount'+data.row).val(tandaPemisahTitik(data.total));
            
            if(data.total > 0){
                $('#amount'+data.row).attr('readonly',true);
            }
            else{
                $('#amount'+data.row).attr('readonly',false);
            }
            
            sumDetailReceipt(data.row);
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal("Oops!", "Error getting data", "error");
        }
    });
}

//  END SERVICE RECEIPT 

// API

function showModalDO(row){
    
    $('#modal_select_do_api').modal('show');

    $('#row_do_api').val(row);  
        
}

function get_data_do(do_no,do_date,qty_deliver,receipt_date,qty_receipt){
    var row = $('#row_do_api').val();

    if(do_date == '01-01-1901'){
        do_date = '<?=date('d-m-Y')?>';
    }
    if(receipt_date == '01-01-1901'){
        receipt_date = '<?=date('d-m-Y')?>';
    }
    
    $('#do_no'+row).val(do_no);
    $('#do_date'+row).val(do_date);
    $('#do_weight'+row).val(qty_deliver);
    $('#received_weight'+row).val(qty_receipt);
    $('#received_date'+row).val(receipt_date);

    $('#modal_select_do_api').modal('hide');
    
    <?php
    if($this->uri->segment(1) == 'invoice'){
        echo 'sumAmountAP_For_Invoice();';
        echo "$('#received_weight'+row).focus();";
    }
    else if($this->uri->segment(1) == 'account_payable'){
        echo 'sumAmountAP();';
        echo "$('#received_weight'+row).focus();";
    }
    ?>
    
}

function filterDO(){
    // $.ajax({
    //     type: "POST",
    //     url : "<?php echo base_url(); ?>api.php",
    // 	data: 'type=get_data_do&do_date='+$('#do_date_api').val()+'&<?=$this->security->get_csrf_token_name()?>='+'<?=$this->security->get_csrf_hash()?>',
    //     dataType:"JSON",
    //     cache:false,
    //     success: function(result){
            
    //         $('#tbl-data-do').html('');

    //         var isi_table = '<thead>'+
    //                             '<th><?=lang('no')?></th>' +
    //             				'<th><?=lang('delivery_order_no')?></th>' +
    //             				'<th><?=lang('no_barcode')?></th>' +
    //             				'<th><?=lang('driver_name')?></th>' +
    //             				'<th><?=lang('vehicle_police_no')?></th>' +
    //             				'<th><?=lang('vessel_name')?></th>' +
    //             				'<th><?=lang('delivery_order_date')?> </th>' +
    //             				'<th><?=lang('qty_delivery')?> </th>' +
    //             				'<th><?=lang('receipt_date')?> </th>' +
    //             				'<th><?=lang('qty_receipt')?> </th>' +
    //                         '</thead>';
                
    //         var no = 1;
    //         $.each(result, function(key, data) {	
                
	// 			isi_table += '<tr onclick="get_data_do(\''+data.do_no+'\',\''+data.str_do_date+'\',\''+
    //                                                         data.qty_deliver+'\',\''+data.str_receipt_date+'\',\''+
    //                                                         data.qty_receipt+'\')" style="cursor:pointer">'+
    //                             '<td>'+no+'</td>' +
    //                             '<td>'+data.do_no+'</td>' +
    //                             '<td>'+data.barcode_no+'</td>' +
    //                             '<td>'+data.driver_name+'</td>' +
    //                             '<td>'+data.police_no+'</td>' +
    //                             '<td>'+data.vessel_name+'</td>' +
    //     						'<td>'+data.str_do_date+'</td>' +
    //     						'<td>'+data.qty_deliver+'</td>' +
    //     						'<td>'+data.str_receipt_date+'</td>' +  
    //     						'<td>'+data.qty_receipt+'</td>' +  
    //                          '</tr>';
	// 		     no++;
    //         });  
            
                      
    //         $('#tbl-data-do').append(isi_table);   
               
    //         $('#tbl-data-do').DataTable().destroy();
    //         $('#tbl-data-do').dataTable({
    //     		"bProcessing": true,
    //             "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
    //             "sPaginationType": "full_numbers",
    //     	});
            
    //     },
    // 	error: function(xhr, status, error) {
    // 		document.write(xhr.responseText);
    // 	}
    // }); 
}

// END API

// GLOBAL
var clickSave = 0;
function showFilterText(){
    $('#btnFilter').attr('onclick','hideFilterText()');
    $('#btnFilter').html('Hide Filter');
}

function hideFilterText(){
    $('#btnFilter').attr('onclick','showFilterText()');
    $('#btnFilter').html('Show Filter');
}

function replaceQuotes(id){
    text = $(id).val().replace(/["']/g, "");
    $(id).val(text);    
}

function PopupCenter(url, w, h) {
    // Fixes dual-screen position                         Most browsers      Firefox
    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
    var top = ((height / 2) - (h / 2)) + dualScreenTop;
    var newWindow = window.open(url, '', 'scrollbars=no, toolbar=no, location=no, directories=no, status=no, menubar=yes, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

    // Puts focus on the newWindow
    if (window.focus) {
        newWindow.focus();
    }
    
    setInterval(function(){history.go(0)},3000);
}

// END GLOBAL

</script>
<style>
#C1{
display:none;
}
#C2{
display:none;
}
#D1{
display:none;
}
#D2{
display:none;
}
</style>
    </body>
  </html>

<?php

$this->session->unset_userdata('start_date');
$this->session->unset_userdata('end_date');
    
?>