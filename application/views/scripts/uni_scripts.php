
<script src="<?=base_url()?>resource/js/slider/bootstrap-slider.js" cache="false"></script>
<script src="<?=base_url()?>resource/js/datepicker/bootstrap-datepicker.js" cache="false"></script>
<!--<script src="<?=base_url()?>resource/js/datepicker/bootstrap3-typeahead.min.js" cache="false"></script>  -->
<?php if (isset($form)) { ?>
<script src="<?=base_url()?>resource/js/select2/select2.min.js" cache="false"></script>
<script src="<?=base_url()?>resource/js/file-input/bootstrap-filestyle.min.js" cache="false"></script>
<script src="<?=base_url()?>resource/js/wysiwyg/jquery.hotkeys.js" cache="false"></script>
<script src="<?=base_url()?>resource/js/wysiwyg/bootstrap-wysiwyg.js" cache="false"></script>
<script src="<?=base_url()?>resource/js/wysiwyg/demo.js" cache="false"></script>
<script src="<?=base_url()?>resource/js/parsley/parsley.min.js" cache="false"></script>
<script src="<?=base_url()?>resource/js/parsley/parsley.extend.js" cache="false"></script>
<script src="<?=base_url()?>resource/rcswitcher-master/js/rcswitcher.js" cache="false"></script>
<?php } ?>
<?php if ($this->uri->segment(2) == 'help') { ?>
 <!-- App --> 
<script src="<?=base_url()?>resource/js/intro/intro.min.js" cache="false"> </script>
<script src="<?=base_url()?>resource/js/intro/demo.js" cache="false"> </script>
<?php }  ?>

<?php
if (isset($datatables)) { ?>
<script src="<?=base_url()?>resource/js/datatables/jquery.dataTables.min.js"></script>
<!--<script src="<?=base_url()?>resource/js/datatables/dataTables.bootstrap.js"></script>-->

<script type="text/javascript">



$(function() {
    

    
	
/*  	var oTable1 = $('#tbl-cost').dataTable({ 
         "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "bProcessing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo base_url('finances/ajax_list'); ?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ -1 ], //last column
          "orderable": false, //set not orderable
        },
        ],


    }); */ 

 	
/* 
 	var oTable1 = $('#tbl-jo').dataTable({ 
        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "bProcessing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo base_url('finances/ajax_list'); ?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ -1 ], //last column
          "orderable": false, //set not orderable
        },
        ],


    }); */
   
    

    
	var oTable1 = $('#tbl-jo').dataTable({"aaSorting": [[1, 'desc']],
		"bProcessing": true,
      "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
      "sPaginationType": "full_numbers",
	});	
	var oTable1 = $('#tbl-cost').dataTable({"aaSorting": [[1, 'desc']],
		"bProcessing": true,
      "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
      "sPaginationType": "full_numbers",
	});	
	
	var oTable1 = $('#tbl-orders').dataTable({"aaSorting": [[1, 'desc']],
		"bProcessing": true,
      "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
      "sPaginationType": "full_numbers",
	});	

	var oTable1 = $('#tbl-projects').dataTable({"aaSorting": [[0, 'desc']],
		"bProcessing": true,
      "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
      "sPaginationType": "full_numbers",
	});	
	
	
	var oTable1 = $('#comment-list').dataTable({"aaSorting": [[0, 'asc']],
		"bProcessing": true,
      "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
      "sPaginationType": "full_numbers",
	});

	var oTable1 = $('#ticket-list').dataTable({
      "aaSorting": [[1, 'desc']], "bProcessing": true,
      "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
      "sPaginationType": "full_numbers",
	});
	
	var oTable1 = $('#clients').dataTable({
		"bProcessing": true,
      "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
      "sPaginationType": "full_numbers",
	});
	var oTable1 = $('#items').dataTable({
		"bProcessing": true,
      "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
      "sPaginationType": "full_numbers",
	});
	var oTable1 = $('#tbl-contacts').dataTable({
		"bProcessing": true,
      "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
      "sPaginationType": "full_numbers",
	});
	var oTable1 = $('#tbl-invoices').dataTable({
		"bProcessing": true,
      "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
      "sPaginationType": "full_numbers",
	});

	var oTable1 = $('#tbl-recap-orders').dataTable({
		"bProcessing": true,
      "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
      "sPaginationType": "full_numbers",
	});
	var oTable1 = $('#transporters').dataTable({
		"bProcessing": true,
      "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
      "sPaginationType": "full_numbers",
	});	
	var oTable1 = $('#tbl-trucks').dataTable({
		"bProcessing": true,
      "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
      "sPaginationType": "full_numbers",
	});
	var oTable1 = $('#tbl-aps').dataTable({
		"bProcessing": true,
      "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
      "sPaginationType": "full_numbers",
	});	
	var oTable1 = $('#tbl-unloadreceipt').dataTable({
		"bProcessing": true,
      "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
      "sPaginationType": "full_numbers",
	});	
	var oTable1 = $('#tbl-sjlist').dataTable({
		"bProcessing": true,
      "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
      "sPaginationType": "full_numbers",
	});	
	var oTable1 = $('#tbl-barcode').dataTable({
		"bProcessing": true,
      "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
      "sPaginationType": "full_numbers",
	});	
	var oTable1 = $('#tbl-vessel').dataTable({"aaSorting": [[0, 'desc']],
		"bProcessing": true,
      "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
      "sPaginationType": "full_numbers",
	});		
	var oTable1 = $('#tbl-verify').dataTable({
		"bProcessing": true,
      "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
      "sPaginationType": "full_numbers",
	});		
	$('[data-rel=tooltip]').tooltip();
	
	
	
	$('#comment-list tbody').on('click', 'td.details-control', function () {
    var tr = $(this).parents('tr');
    var row = table.row( tr );
 
    if ( row.child.isShown() ) {
        // This row is already open - close it
        row.child.hide();
        tr.removeClass('shown');
    }
    else {
        // Open this row (the format() function would return the data to be shown)
        row.child( format(row.data()) ).show();
        tr.addClass('shown');
    }
} );
})

		</script>
<?php }  ?>



<?php if ($this->uri->segment(2) == 'view' AND $this->uri->segment(3) == 'add' OR $this->uri->segment(3) == 'edit') { ?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#fixed_rate").click(function(){
			//if checked
			if($("#fixed_rate").is(":checked")){
				$("#fixed_price").show("fast");
				$("#hourly_rate").hide("fast");
				}else{
					$("#fixed_price").hide("fast");
					$("#hourly_rate").show("fast");
				}
		});
	});
</script>
<?php } ?>
<?php if(isset($chart)){ ?>
<!-- App -->
<script src="<?=base_url()?>resource/js/charts/Chart.js"></script>
<?php $this->load->language('calendar');?>
<script>
		var lineChartData = {
			labels : ['<?=lang('cal_jan')?>','<?=lang('cal_feb')?>','<?=lang('cal_mar')?>','<?=lang('cal_apr')?>','<?=lang('cal_may')?>','<?=lang('cal_jun')?>','<?=lang('cal_jul')?>','<?=lang('cal_aug')?>','<?=lang('cal_sep')?>','<?=lang('cal_oct')?>','<?=lang('cal_nov')?>','<?=lang('cal_dec')?>'],
			datasets: [
        {
            label: '<?=lang('yearly_overview')?>',
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "#4acab4",
            pointColor: "#4acab4",
            pointStrokeColor: "#4acab4",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            scaleGridLineColor : "#4acab4",
            data: [<?=$this->AppModel->monthly_data('01')?>, <?=$this->AppModel->monthly_data('02')?>, <?=$this->AppModel->monthly_data('03')?>, <?=$this->AppModel->monthly_data('04')?>, <?=$this->AppModel->monthly_data('05')?>, <?=$this->AppModel->monthly_data('06')?>, <?=$this->AppModel->monthly_data('07')?>, <?=$this->AppModel->monthly_data('08')?>, <?=$this->AppModel->monthly_data('09')?>, <?=$this->AppModel->monthly_data('10')?>, <?=$this->AppModel->monthly_data('11')?>, <?=$this->AppModel->monthly_data('12')?>]
        }
			]

		}

	window.onload = function(){
		var ctx = document.getElementById("invoice_revenue").getContext("2d");
		window.myLine = new Chart(ctx).Line(lineChartData, {
			responsive: true
		});
	}


	</script>
<?php }  ?>
 <?php
if($this->session->flashdata('message')){ 
$message = $this->session->flashdata('message');
$alert = $this->session->flashdata('response_status');
	?>
<script type="text/javascript">
	$(document).ready(function(){
toastr.<?=$alert?>("<?=$message?>", "Response Status");
toastr.options = {
  "closeButton": true,
  "debug": false,
  "positionClass": "toast-bottom-right",
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
});
</script>
<?php } ?>