<section id="content">
	<section class="hbox stretch">

		<!-- .aside -->
		<aside>
			<section class="vbox">
				<header class="header bg-white b-b b-light">
					<p>Document Monitoring</p>
				</header>
						<section class="scrollable wrapper w-f">
					<section class="scrollable wrapper">
						<div class="row"> 
						<div class="col-lg-12">

						<div class="panel-body">
							<!-- Client Contacts -->
							<div class="col-md-6">
							<section class="panel panel-default">
							<header class="panel-heading">
							

							 <?=lang('unload_receipt_lists')?></header>
							<table id="tbl-unloadreceipt" class="table table-striped table-hover b-t b-light text-sm">
								<thead>
									<tr>
										<th><?=lang('unload_receipt_ref')?></th>
										<th><?=lang('date')?> <?=lang('time')?></th>	
										<th><?=lang('driver_name')?> </th>
										<th><?=lang('truck_ref')?> </th>
										<th><?=lang('transporter_name')?> </th>
										
									</tr> 
								</thead> 
								<tbody>
								<?php
								if (!empty($unload_receipt_lists)) {
									foreach ($unload_receipt_lists as $key => $unload_receipt) { ?>
									<tr>
										<td><?=$unload_receipt->unload_receipt_ref?></td>
										<td><?=$unload_receipt->unload_receipt_date?> <?=$unload_receipt->unload_receipt_time?></td>							
										<td><?=$unload_receipt->driver_name?> </td>
										<td><?=$unload_receipt->truck_ref?> </td>
										<td><?=$unload_receipt->transporter_name?> </td>

									</tr>
									<?php  }} else{ ?>
									<tr>
										<td><?=lang('nothing_to_display')?></td><td></td><td></td><td></td>
									</tr>
									<?php } ?>								
									
								</tbody>
							</table>
							
							<header class="panel-heading">
					
							 <?=lang('barcode_lists')?></header>
							<table id="tbl-barcode" class="table table-striped table-hover b-t b-light text-sm">
								<thead>
									<tr>
										<th><?=lang('barcode')?></th>
										<th><?=lang('date')?> <?=lang('time')?></th>	
										<th><?=lang('driver_name')?> </th>
										<th><?=lang('truck_ref')?> </th>
										<th><?=lang('transporter_name')?> </th>
										
									</tr> 
								</thead> 
								<tbody>
								<?php
								if (!empty($unload_receipt_lists)) {
									foreach ($unload_receipt_lists as $key => $unload_receipt) { ?>
									<tr>
										<td><?=$unload_receipt->unload_receipt_ref?></td>
										<td><?=$unload_receipt->unload_receipt_date?> <?=$unload_receipt->unload_receipt_time?></td>							
										<td><?=$unload_receipt->driver_name?> </td>
										<td><?=$unload_receipt->truck_ref?> </td>
										<td><?=$unload_receipt->transporter_name?> </td>

									</tr>
									<?php  }} else{ ?>
									<tr>
										<td><?=lang('nothing_to_display')?></td><td></td><td></td><td></td>
									</tr>
									<?php } ?>								
									
								</tbody>
							</table>
							</section>
							</div>
							<div class="col-md-6">
							<section class="panel panel-default">
							<header class="panel-heading">
							<?=lang('sj_lists')?>
							</header>
							<table id="tbl-sjlist" class="table table-striped table-hover b-t b-light text-sm">
								<thead>
									<tr>
										<th><?=lang('sj_ref')?></th>
										<th><?=lang('date')?><?=lang('time')?></th>
										<th><?=lang('driver_name')?> </th>
										<th><?=lang('qty_delivery')?> </th>
										<th><?=lang('destination_from')?> </th>
										<th><?=lang('destination_to')?> </th>
									</tr> 
								</thead> 
								<tbody>
								
								
								<?php
								if (!empty($sj_lists)) {
									foreach ($sj_lists as $key => $sj_list) { ?>
									<tr>
										<td><?=$sj_list->sj_ref?></td>
										<td><?=$sj_list->sj_date?> <?=$sj_list->sj_time?></td>							
										<td><?=$sj_list->driver_name?> </td>
										<td><?=$sj_list->tonase_kirim?> </td>
										<td><?=$sj_list->Dari?> </td>
										<td><?=$sj_list->Ke?> </td>
									</tr>
									<?php  }} else{ ?>
									<tr>
										<td><?=lang('nothing_to_display')?></td><td></td><td></td><td></td>
									</tr>
									<?php } ?>	
																
									
								</tbody>
							</table>
							<header class="panel-heading">
					
							 <?=lang('verify_lists')?></header>
							<table id="tbl-verify" class="table table-striped table-hover b-t b-light text-sm">
								<thead>
									<tr>
										<th><?=lang('barcode')?></th>
										<th><?=lang('date')?> <?=lang('time')?></th>	
										<th><?=lang('driver_name')?> </th>
										<th><?=lang('truck_ref')?> </th>
										<th><?=lang('transporter_name')?> </th>
										
									</tr> 
								</thead> 
								<tbody>
								<?php
								if (!empty($unload_receipt_lists)) {
									foreach ($unload_receipt_lists as $key => $unload_receipt) { ?>
									<tr>
										<td><?=$unload_receipt->unload_receipt_ref?></td>
										<td><?=$unload_receipt->unload_receipt_date?> <?=$unload_receipt->unload_receipt_time?></td>							
										<td><?=$unload_receipt->driver_name?> </td>
										<td><?=$unload_receipt->truck_ref?> </td>
										<td><?=$unload_receipt->transporter_name?> </td>

									</tr>
									<?php  }} else{ ?>
									<tr>
										<td><?=lang('nothing_to_display')?></td><td></td><td></td><td></td>
									</tr>
									<?php } ?>								
									
								</tbody>
							</table>
							</section>
							</div>
						</div>
						<!-- End -->
							</div>
							
						</div>
				

					

					</section> 
										
				</section>  

			</section>
		</aside>

	</section>
	<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>