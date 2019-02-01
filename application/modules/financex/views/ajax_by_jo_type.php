		
	<div class="row inline-fields form-group form-md-line-input">
		<div class="col-md-4"></div>
		<div class="col-md-1"></div>
		<div class="col-md-6"><p class="h3">
					<?php 
						$atribut_popup=array('width'=>'800',
											'height'=>'400',
											'scrollbars'=>'yes',
											'status' =>'no',
											'resizable' =>'no',
											'screenx'=>'100',
											'screeny'=>'30'
											);
					
						echo anchor_popup(base_url().'site_cash_advance/add_job_order','<span class="btn btn-sm green pull-left">Add Job Order </span>',$atribut_popup); 
					?>
		</div>
		
	
	



