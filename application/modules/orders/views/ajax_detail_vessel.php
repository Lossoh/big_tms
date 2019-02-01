<script src="<?=base_url()?>resource/js/app.v2.js"></script>
<script src="<?=base_url()?>resource/js/charts/sparkline/jquery.sparkline.min.js" cache="false"></script>

<div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
	<div class="wrapper">
	<?php if(!empty($vessels)){
			foreach($vessels as $key => $vessel){?>
	<section class="panel panel-default">
	<header class="panel-heading"><?=lang('vessel_name')?>&ensp; : &ensp; <?=$vessel->vessel_name?> &ensp; Status &ensp; : &ensp; <?=$vessel->Nm_Ref?> </header>
		<div class="panel-body text-center">
		<?php

			if ($total_do_vessel > 0) {
				$perc_do_vessel = $total_do_vessel;
				$perc_difference_vessel = ($total_document_vessel-$total_do_vessel);
			}else{
				$perc_do_vessel = 0;
				$perc_difference_vessel = 0;
			}
		?>
		<div class="sparkline inline" data-type="pie" data-height="150" data-slice-colors="['#FB6B5B','#8EC165']"><?=$perc_difference_vessel?>,<?=$perc_do_vessel?></div>

		<div class="line pull-in"></div>
		<div class="text-xs"> <i class="fa fa-circle text-danger"></i><?=number_format($perc_difference_vessel,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?>% <?=lang('open')?> <i class="fa fa-circle text-success"></i> <?=number_format($perc_do_vessel,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?>%<?=lang('closed')?></div>
		<div class="line pull-in"></div>
		<table class="table" width="100%">
			<thead>
				<tr>
					<th style="text-align:center" width="2%"><?=lang('party_name')?> </th>
					<th style="text-align:center" width="38%"><?=lang('client_name')?> </th>					
					<th style="text-align:center" width="10%"><?=lang('qty_po')?> </th>
					<th style="text-align:center" width="10%"><?=lang('qty_delivery')?> </th>	
					<th style="text-align:center" width="10%"><?=lang('qty_receipt')?> </th>
					<th style="text-align:center" width="10%"><?=lang('qty_difference')?> </th>					
				</tr> 
			</thead>
			<tbody>
				<tr>
				<td>A</td>
				<td>PT. TIRTA INDRA KENCANA</td>
				<td>199.000.000</td>
				<td>199.000.000</td>
				<td>171.000.000</td>
				<td>119.281.710</td>
				</tr>
				<tr>
				<td></td>
				<td colspan="4">	
				<div>
							
		<div class="progress progress-xs progress-striped active">								
		<div class="progress-bar progress-bar-info" data-toggle="tooltip" data-original-title="75%" style="width: 10%">
		</div>
		</div>
	</div>
	</td>
				
				</tr>
			</tbody>
		</table>
		<div class="line pull-in"></div>

		<div class="col-xs-6 text-left" >
			<div class="group">
			<h5>Delivery Order Document</h5>
				<div class="row inline-fields form-group form-md-line-input">
				<div class="col-md-3">Released</div>
				<div class="col-md-1">:</div>
				<div class="col-md-4 text-right">1928 pieces</div>
				</div>
				<div class="row inline-fields form-group form-md-line-input">
				<div class="col-md-3">Void</div>
				<div class="col-md-1">:</div>
				<div class="col-md-4 text-right">28 pieces</div>
				</div>
				<div class="line pull-in"></div>
				<div class="row inline-fields form-group form-md-line-input">
				<div class="col-md-3">Total</div>
				<div class="col-md-1">:</div>
				<div class="col-md-4 text-right">1956 pieces</div>
				</div>
			</div>
		
		</div>
		<div class="col-xs-6 text-left">
			<div class="group">
			<h5>Truck Utilities</h5>
				<div class="row inline-fields form-group form-md-line-input">
				<div class="col-md-3">Released</div>
				<div class="col-md-1">:</div>
				<div class="col-md-4 text-right">1928 trucks</div>
				</div>
				<div class="row inline-fields form-group form-md-line-input">
				<div class="col-md-3">Void</div>
				<div class="col-md-1">:</div>
				<div class="col-md-4 text-right">28 trucks</div>				
				</div>
				<div class="line pull-in"></div>
				<div class="row inline-fields form-group form-md-line-input">
				<div class="col-md-3">Total</div>
				<div class="col-md-1">:</div>
				<div class="col-md-4 text-right">1956 pieces</div>
				</div>
			</div>
		</div>
	
		</div>
		</div>
	</section>
	<?php }}?>
	

	
	</div>
</div>

												
							
