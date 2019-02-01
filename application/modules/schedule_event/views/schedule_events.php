<!DOCTYPE html>
<html lang="en" class="app">
  <head>
    <meta charset="utf-8" />
    <meta name="description" content="">
    <meta name="author" content="<?=$this->config->item('site_author')?>">
    <meta name="keyword" content="<?=$this->config->item('site_desc')?>">
    <link rel="shortcut icon" href="<?=base_url()?>resource/images/favicon.ico">
    <title><?php  echo $this->config->item('comp_cd').' - '.lang('schedule_events');?></title>
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

    <link rel="stylesheet" href="<?=base_url()?>resource/css/components.min.css" type="text/css" cache="false" />
    <link rel="stylesheet" href="<?=base_url()?>resource/themes/darkblue.min.css" type="text/css" />
    <link rel="stylesheet" href="<?=base_url()?>resource/plugin/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?=base_url()?>resource/css/custom.css" type="text/css" cache="false" />

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
    <script src="<?=base_url()?>resource/js/dhtmlxscheduler/dhtmlxscheduler.js" charset="utf-8"></script>
    <link rel="stylesheet" href="<?=base_url()?>resource/js/dhtmlxscheduler/dhtmlxscheduler_flat.css" type="text/css" charset="utf-8" />
    <style type="text/css" media="screen">
    	html, body{
    		margin:0px;
    		padding:0px;
    		height:100%;
    		overflow-y:scroll;
    	}
        .dhx_cal_lsection, .dhx_section_time, .dhx_save_btn_set, .dhx_delete_btn_set{
            display: none;
        }
        .dhx_cal_light_wide .dhx_wrap_section{
            border-bottom: 1px solid #FFF;    
        }

    </style>

    <script type="text/javascript" charset="utf-8">
        $(function() {
            scheduler.init('scheduler_here',new Date(<?=date('Y')?>,<?=(date('n') - 1)?>,<?=date('d')?>),"month");
            var events = <?=$get_data_jo?>;
            
            scheduler.parse(events,"json");
            
        });
        
        function menuBar(opsi){
            if(opsi == 1){
                $('#btnTrue').hide();
                $('#btnFalse').show();
                $('.nav-primary').hide();
            }
            else{
                $('#btnTrue').show();            
                $('#btnFalse').hide();
                $('#nav').show();
            }
        }
        
        function showDescription(jo_no,vessel_name,eta_date,etb_date){
            $('#modal_form').modal('show');
            
            $('#jo_no').text(jo_no);
            $('#vessel_name').text(vessel_name);
            $('#eta_date').text(eta_date);
            $('#etb_date').text(etb_date);
        }
        
    </script>

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
          <section class="content">
      	  	 <div class="header bg-white b-b b-light">
                <div class="pull-right" style="margin-top: 10px;">&nbsp;</div>
                <p class="pull-left"><?=lang('schedule_event')?></p>
             </div>
             <div id="scheduler_here" class="dhx_cal_container" style='width:100%; height:92%;'>
                <div class="dhx_cal_navline">
        			<div class="dhx_cal_prev_button">&nbsp;</div>
        			<div class="dhx_cal_next_button">&nbsp;</div>
        			<div class="dhx_cal_today_button"></div>
        			<div class="dhx_cal_date"></div>
        			<div class="dhx_cal_tab" name="day_tab" style="right:204px;"></div>
        			<div class="dhx_cal_tab" name="week_tab" style="right:140px;"></div>
        			<div class="dhx_cal_tab" name="month_tab" style="right:76px;"></div>
        		</div>
        		<div class="dhx_cal_header">
        		</div>
        		<div class="dhx_cal_data">
        		</div>
        	 </div>
             
             <aside class="bg-light lter b-l aside-md hide" id="notes">
                <div class="wrapper">Notification</div> 
             </aside>
          </section>   
                 
        <!-- Bootstrap modal -->
        <div class="modal fade" id="modal_form" role="dialog">
          <div class="modal-dialog" style="width:600px;height:200px;">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"><?=lang('description')?></h3>
              </div>
              <div class="modal-body form">
                <div class="row">
                    <label class="col-lg-4 text-right"><?=lang('job_order_emkl_no')?></label>
                    <div class="col-lg-8">
                        <span id="jo_no"></span>
                    </div>
                </div>
                <div class="row">
                    <label class="col-lg-4 text-right"><?=lang('vessel_name')?></label>
                    <div class="col-lg-8">
                        <span id="vessel_name"></span>
                    </div>
                </div>
                <div class="row">
                    <label class="col-lg-4 text-right">ETA <?=lang('date')?></label>
                    <div class="col-lg-8">
                        <span id="eta_date"></span>
                    </div>
                </div>
                <div class="row">
                    <label class="col-lg-4 text-right">ETB <?=lang('date')?></label>
                    <div class="col-lg-8">
                        <span id="etb_date"></span>
                    </div>
                </div>              
              </div>
              <div class="modal-footer">
                <button type="button" class="btn red" data-dismiss="modal">Close</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        </section>
      </section>
    </section>
</body>
</html>