<section id="content">
	<section class="hbox stretch">
		<?php
		if (!empty($transporters)) {
		foreach ($transporters as $key => $transporter) { ?>
		<!-- .aside -->
		<aside>
			<section class="vbox">
				<header class="header bg-white b-b b-light">
					<p><?=$transporter->transporter_name?> - <?=lang('details')?> </p>
				</header>
				<section class="scrollable wrapper">
					<section class="panel panel-default">			
						
						<div class="panel-body">							

							<div class="col-md-6">
								<div class="group">
									<h4 class="subheader text-muted"><?=lang('transporter_details')?></h4>
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('transporter_name')?></div>
										<div class="col-md-6"><?=$transporter->transporter_name?></div>
									</div>
									<div class="row inline-fields form-group form-md-line-input">
										<div class="col-md-4"><?=lang('contact_person')?></div>
										<div class="col-md-6"><?=$transporter->pic_1?></div>
									</div>
								</div>								
							</div>
							
						</div>

						<div class="panel-body">
							<!-- Client Contacts -->
							<div class="col-md-6">
							<section class="panel panel-default">
							<header class="panel-heading">
							<a href="<?=base_url()?>trucks/add/<?=$transporter->transporter_id?>" class="btn btn-xs btn-info pull-right" data-toggle="ajaxModal"><i class="fa fa-plus"></i> <?=lang('add_truck')?></a>

							<i class="fa fa-truck"></i> <?=lang('trucks')?></header>
							<table id="tbl-trucks" class="table table-striped table-hover b-t b-light text-sm">
								<thead>
									<tr>
										<th><?=lang('truck_ref')?></th>
										<th><?=lang('truck_name')?></th>
										<th><?=lang('gps_id')?> </th>
										<th><?=lang('truck_type')?> </th>
										<th><?=lang('options')?></th>
									</tr> 
								</thead> 
								<tbody>
								<?php
								if (!empty($truck_details)) {
									foreach ($truck_details as $key => $truck) { ?>
									<tr>
										<td><?=$truck->truck_ref?></td>
										<td><?=$truck->truck_name?> </td>
										<td><?=$truck->gps_id?> </td>
										<td><?=$truck->Nm_Ref?> </td>
										<td>
										<a href="<?=base_url()?>trucks/edit_truck/<?=$truck->truck_id?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('edit')?>"><i class="fa fa-edit"></i></a>
										<a href="<?=base_url()?>trucks/delete_truck/<?=$truck->truck_id?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('delete')?>"><i class="fa fa-trash-o"></i></a>
										</td>
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
							<a href="<?=base_url()?>trucks/add/<?=$transporter->transporter_id?>" class="btn btn-xs btn-info pull-right" data-toggle="ajaxModal"><i class="fa fa-refresh"></i> <?=lang('refresh')?></a>			
							<i class="fa fa-truck"></i> <?=lang('list_ap')?>
							</header>
							<table id="tbl-aps" class="table table-striped table-hover b-t b-light text-sm">
								<thead>
									<tr>
										<th><?=lang('inv_trans')?></th>
										<th><?=lang('date_inv_trans')?></th>
										<th><?=lang('due_date_inv_trans')?> </th>
										<th><?=lang('amount_inv_trans')?> </th>
										<th><?=lang('ap_ref')?> </th>
										<th><?=lang('date_ap')?> </th>
									</tr> 
								</thead> 
								<tbody>
								
								
									<tr>
										<td><?=lang('nothing_to_display')?></td><td></td><td></td><td></td><td></td><td></td>
									</tr>
																
									
								</tbody>
							</table>
							</section>
							</div>
						</div>
						<!-- End -->
					</section>
				</section>
			</section>
		</aside>

		<?php }} ?>
	</section>
	<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>