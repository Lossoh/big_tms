<html>
<head>
<link rel="stylesheet" href="<?=base_url()?>resource/css/app.v2.css" type="text/css" />
 

<link rel="stylesheet" href="<?=base_url()?>resource/js/datatables/datatables.css" type="text/css" cache="false" />
<link href="<?=base_url()?>resource/css/navbar.css" rel="stylesheet">

<script src="<?=base_url()?>resource/js/jquery-2.1.1.min.js"></script>
<script src="<?=base_url()?>resource/js/app.v2.js"></script>
<script src="<?=base_url()?>resource/js/slider/bootstrap-slider.js" cache="false"></script>
<script src="<?=base_url()?>resource/js/datepicker/bootstrap-datepicker.js" cache="false"></script>

<script src="<?=base_url()?>resource/js/select2/select2.min.js" cache="false"></script>
<script src="<?=base_url()?>resource/js/file-input/bootstrap-filestyle.min.js" cache="false"></script>
<script src="<?=base_url()?>resource/js/wysiwyg/jquery.hotkeys.js" cache="false"></script>
<script src="<?=base_url()?>resource/js/wysiwyg/bootstrap-wysiwyg.js" cache="false"></script>
<script src="<?=base_url()?>resource/js/wysiwyg/demo.js" cache="false"></script>
<script src="<?=base_url()?>resource/js/parsley/parsley.min.js" cache="false"></script>
<script src="<?=base_url()?>resource/js/parsley/parsley.extend.js" cache="false"></script>
<script src="<?=base_url()?>resource/js/datatables/jquery.dataTables.min.js"></script>
</head>

<script type="text/javascript">

$(function() {

	var oTable1 = $('#tbl-projects').dataTable({"aaSorting": [[0, 'asc']],
		"bProcessing": true,
      "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
      "sPaginationType": "full_numbers",
	});
	
})

	function insert_jo_no(jo_no) {
		
		opener.document.forms['myform'].site_cash_advance_jo.value  =jo_no;
	}

	function kosongkan_entitas_jo() 
	{
		
		opener.document.forms['myform'].site_cash_advance_jo.value ="";
	}
	
</script>	

<html>
<head>
<link rel="stylesheet" href="<?=base_url()?>resource/css/app.v2.css" type="text/css" />
 

<link rel="stylesheet" href="<?=base_url()?>resource/js/datatables/datatables.css" type="text/css" cache="false" />
<link href="<?=base_url()?>resource/css/navbar.css" rel="stylesheet">

<script src="<?=base_url()?>resource/js/jquery-2.1.1.min.js"></script>
<script src="<?=base_url()?>resource/js/app.v2.js"></script>
<script src="<?=base_url()?>resource/js/slider/bootstrap-slider.js" cache="false"></script>
<script src="<?=base_url()?>resource/js/datepicker/bootstrap-datepicker.js" cache="false"></script>

<script src="<?=base_url()?>resource/js/select2/select2.min.js" cache="false"></script>
<script src="<?=base_url()?>resource/js/file-input/bootstrap-filestyle.min.js" cache="false"></script>
<script src="<?=base_url()?>resource/js/wysiwyg/jquery.hotkeys.js" cache="false"></script>
<script src="<?=base_url()?>resource/js/wysiwyg/bootstrap-wysiwyg.js" cache="false"></script>
<script src="<?=base_url()?>resource/js/wysiwyg/demo.js" cache="false"></script>
<script src="<?=base_url()?>resource/js/parsley/parsley.min.js" cache="false"></script>
<script src="<?=base_url()?>resource/js/parsley/parsley.extend.js" cache="false"></script>
<script src="<?=base_url()?>resource/js/datatables/jquery.dataTables.min.js"></script>
</head>

<script type="text/javascript">

$(function() {

	var oTable1 = $('#tbl-projects').dataTable({"aaSorting": [[0, 'asc']],
		"bProcessing": true,
      "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
      "sPaginationType": "full_numbers",
	});
	
})

	function insert_jo_no(jo_no) {
		opener.document.forms['myform'].site_cash_advance_jo.value  =jo_no;
	}
	
	function insert_wo_no(wo_no) {
		opener.document.forms['myform'].site_cash_advance_wo.value  =wo_no;
	}
	
	
	function insert_debtor_id(debtor_id) {
		opener.document.forms['myform'].site_cash_advance_debtor_id.value  = debtor_id;
	}
	
	function insert_debtor_code(debtor_code) {
		opener.document.forms['myform'].site_cash_advance_debtor.value  = debtor_code;
	}
	
	function insert_vessel(vessel) {
		opener.document.forms['myform'].site_cash_advance_vessel.value  = vessel;
	}
	
	function insert_item_id(item_id) {
		opener.document.forms['myform'].site_cash_advance_item_id.value  = item_id;
	}
	
	function insert_item(item) {
		opener.document.forms['myform'].site_cash_advance_item.value  = item;
	}
	
	function insert_from_id(from_id) {
		opener.document.forms['myform'].site_cash_advance_from_id.value  = from_id;
	}
	
	function insert_from(from_code){
		opener.document.forms['myform'].site_cash_advance_from.value  = from_code;
	}
	
	function insert_to_id(to_id) {
		opener.document.forms['myform'].site_cash_advance_to_id.value  = to_id;
	}
	
	function insert_to(to_code){
		opener.document.forms['myform'].site_cash_advance_to.value  = to_code;
	}
	
	function insert_jo_year(year){
		opener.document.forms['myform'].site_cash_advance_jo_year.value  = year;
	}
	
	function insert_jo_month(month){
		opener.document.forms['myform'].site_cash_advance_jo_month.value  = month;
	}
	
	function insert_jo_code(code){
		opener.document.forms['myform'].site_cash_advance_jo_code.value  = code;
	}

	function kosongkan_entitas_jo() 
	{
		
		opener.document.forms['myform'].site_cash_advance_jo.value ="";
		opener.document.forms['myform'].site_cash_advance_wo.value  ="";
		opener.document.forms['myform'].site_cash_advance_debtor_id  ="";
		opener.document.forms['myform'].site_cash_advance_debtor.value  ="";
		opener.document.forms['myform'].site_cash_advance_vessel.value  ="";
		opener.document.forms['myform'].site_cash_advance_item_id.value  ="";
		opener.document.forms['myform'].site_cash_advance_item.value   ="";
		opener.document.forms['myform'].site_cash_advance_from_id.value  ="";
		opener.document.forms['myform'].site_cash_advance_from.value  ="";
		opener.document.forms['myform'].site_cash_advance_to_id.value  ="";
		opener.document.forms['myform'].site_cash_advance_to.value  ="";
		opener.document.forms['myform'].site_cash_advance_jo_year.value  ="";
		opener.document.forms['myform'].site_cash_advance_jo_month.value  ="";
		opener.document.forms['myform'].site_cash_advance_jo_code.value  ="";
	}
	

	
</script>	

<div class="row"> 
	<div class="col-xs-12">
		<div class="group">
			<section class="panel panel-default">

			<table id="myTable" class="table table-striped table-hover b-t b-light text-sm" cellspacing="0"> 
                      <?php 
                      $per_page = abs($this->input->get('per_page'));
                      $no = $per_page + 1;
                      if(count($job_orders->result()) > 0) {
                      ?> 
					  <thead> 
                      <form name="cari" action="<?php echo site_url() ?>site_cash_advance/add_job_order" method="GET">
                          <tr>
							<th>
								 <select name="tahun" class="form-control">
								  <?php 
										$year='2050';
										$year1=date('Y');
										 if (!empty($years)) {
											foreach ($years as $year) { ?>
											<option value="<?php echo $year['year'];?>" <?php if($year['year']==$year1){echo"selected";}?>><?php echo $year['year']; ?></option>
										 <?php }} ?>
								 </select>
							</th>
							<th>
								<input type="text" class="form-control" name="no_jo" placeholder="Enter No Jo">
							</th> 
							<th width="160" colspan="2">
								<div class="btn-group">
									<button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-search"></span></button>
								</div>
							</th> 
            
                           
                          </tr>
                      </form> 
                      </thead>
					  <thead> 
							<tr>
								<th width="5"><div align="center">No</div></th> 
								<th><div align="center">No. JO</div></th> 
								<th><div align="left">Date</div></th> 
								<th><div align="left">Debtor </div></th> 
							</tr>
					</thead> 
					<tbody> 
                           <?php
								  if (!empty($job_orders)) {
								  foreach ($job_orders->result() as $job_order) { ?>
                          <tr>
								<td align="center" width="5">
									<?php echo $no; ?>
								</td> 
								
								<td>
									<a href="javascript:kosongkan_entitas_jo();insert_jo_no('<?= addslashes($job_order->jo_no)?>');insert_wo_no('<?= addslashes($job_order->tr_wo_trx_hdr_wo_no)?>');insert_debtor_id('<?= addslashes($job_order->debtor_rowID)?>');insert_debtor_code('<?= addslashes($job_order->debtor_code)?>&nbsp;-&nbsp;<?=addslashes($job_order->debtor_name)?>');insert_vessel('<?= addslashes($job_order->vessel_no)?>&nbsp;-&nbsp;<?=addslashes($job_order->vessel_name)?>');insert_item_id('<?= addslashes($job_order->item_rowID)?>');insert_item('<?= addslashes($job_order->item_code)?>&nbsp;-&nbsp;<?=addslashes($job_order->item_name)?>');insert_from_id('<?= addslashes($job_order->destination_from_rowID)?>');insert_from('<?= addslashes($job_order->from_code)?>&nbsp;-&nbsp;<?=addslashes($job_order->from_name)?>');insert_to_id('<?= addslashes($job_order->destination_to_rowID)?>');insert_to('<?= addslashes($job_order->to_code)?>&nbsp;-&nbsp;<?=addslashes($job_order->to_name)?>');insert_jo_year('<?= addslashes($job_order->year)?>');insert_jo_month('<?= addslashes($job_order->month)?>');insert_jo_code('<?= addslashes($job_order->code)?>');window.close();">
									<?php echo $job_order->jo_no;?>
									</a>
								</td> 
								
								<td>
									<?php echo $job_order->jo_date;?>
								</td>
								<td>
									<?=$job_order->debtor_code?>&nbsp;-&nbsp;<?=$job_order->debtor_name?>
								</td>
                          </tr> 
                          <?php
                          $no++;
								  }}
                          ?>
						
                      </tbody> 
					   <tfoot>
                          <tr>
                              <td colspan="6">
                              <div class="pagination"><?php echo $this->pagination->create_links(); ?></div>
                              </td>
                              <?php
					  }else {
                        ?>
						<table id="myTable" class="table table-striped table-hover b-t b-light text-sm" cellspacing="0"> 
						  <thead> 
						  <form name="cari" action="<?php echo site_url() ?>site_cash_advance/add_job_order" method="GET">
                          <tr>
							<th>
								 <select name="tahun" class="form-control">
								  <?php 
										$year='2050';
										$year1=date('Y');
										 if (!empty($years)) {
											foreach ($years as $year) { ?>
											<option value="<?php echo $year['year'];?>" <?php if($year['year']==$year1){echo"selected";}?>><?php echo $year['year']; ?></option>
								 <?php }} ?>
								 </select>
							</th>
							<th>
								<input type="text" class="form-control" name="no_jo" placeholder="Enter No Jo">
							</th>
							<th width="160" colspan="2">
								<div class="btn-group">
									<button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-search"></span></button>
								</div>
							</th> 
            
                           
                          </tr>
                      </form> 
                      </thead>
					  <thead> 
							<tr>
								<th width="5"><div align="center">No</div></th> 
								<th><div align="center">No. JO</div></th> 
								<th><div align="left">Date</div></th> 
								<th><div align="left">Debtor </div></th> 
							</tr>
					</thead> 
					<tbody>
							<tr>
                              <td colspan="4" align="center">
                                Data Tidak Tersedia
                              </td>    
                              </tbody>
                              </table>   
						  <?php
                              }
                              ?>
                           </tr>
                      </tfoot>
                    
			</table>
			</section>
		</div>
	</div>
</div>     
</html>

   


   
