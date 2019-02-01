<section id="content">
	<section class="hbox stretch">		
		<aside class="aside-lg bg-white b-r" id="subNav">

		<header class="dk header b-b">
		<div class="btn-group pull-right">

		</div>
		<?php if($create_vessel){?>
		<a href="<?=base_url()?>vessels/manage/add" data-original-title="<?=lang('create_vessel')?>" data-toggle="tooltip" data-placement="bottom" class="btn btn-icon btn-default btn-sm pull-right"><i class="fa fa-plus"></i></a>

		<?php }  ?>
		<p class="h4"><?=lang('vessel_actived')?></p>
		</header>
		<section class="vbox">
			<section class="scrollable w-f">
			   <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
				<ul class="nav">
			<?php
			if (!empty($vessels)) {
			foreach ($vessels as $key => $vessel) {  //$encrypted_string = $this->encrypt->encode($vessel->vessel_id);
					?>
				<li class="b-b b-light"><a href="<?=base_url()?>vessels/manage/details/<?=$vessel->vessel_id?>">
				<?=$vessel->vessel_ref?> - <?=$vessel->vessel_name?>
				<div class="pull-right">
				<span class="label label-<?=$vessel->Kondisi_Ref_Char_01?>"><?=$vessel->Nm_Ref?></span>
				</div> <br>
				<small class="block small text-muted"><?=$vessel->vessel_init?> | <?=strftime("%b %d, %Y", strtotime($vessel->date_created));?></small>

				</a> </li>
				<?php } } ?>
			</ul> 
			</div></section>
			</section>
			</aside> 
			
			<aside>
			<section class="vbox">
				<header class="header bg-white b-b clearfix">
					<div class="row m-t-sm">
						<div class="col-sm-8 m-b-xs">
							<a href="#subNav" data-toggle="class:hide" class="btn btn-sm btn-default active">
							<i class="fa fa-caret-right text fa-lg"></i><i class="fa fa-caret-left text-active fa-lg"></i></a>
						<div class="btn-group">
						<a  data-original-title="<?=lang('refresh')?>" data-toggle="tooltip" data-placement="right"  class="btn btn-sm btn-default" href="<?=current_url()?>" title="<?=lang('refresh')?>"><i class="fa fa-refresh"></i></a>
						</div>
						</div>
						<div class="col-sm-4 m-b-xs">
							<a href="<?=base_url()?>vessels/exportxls" data-original-title="<?=lang('excel_download')?>" data-toggle="tooltip" data-placement="bottom" class="btn btn-icon btn-default btn-sm pull-right"><i class="fa fa-file-excel-o"></i></a>
						</div>
					</div> </header>
<section class="scrollable wrapper w-f">
					<section class="scrollable wrapper">
						<div class="row"> 
							<div class="col-lg-12">							
							<section class="panel panel-default">
							<div class="table-responsive"><?php echo validation_errors(); ?>
							<table id="tbl-vessel" class="table table-striped table-hover b-t b-light text-sm">
							<thead>
							  <tr>
								<th><?=lang('vessel_ref')?></th>
								<th><?=lang('vessel_init')?></th>
								<th><?=lang('vessel_name')?></th>
								<th><?=lang('vessel_status')?></th>
								<th><?=lang('options')?></th>

							  </tr> </thead> 
							  <tbody>
								  <?php
								  if (!empty($vessel_lists)) {
								  foreach ($vessel_lists as $vessel_list) { ?>
								  <tr>									
									<td><?=$vessel_list->vessel_ref?></a></td>
									<td><?=$vessel_list->vessel_init?></td>
									<td><?=$vessel_list->vessel_name?></td>
									<td><?=$vessel_list->Nm_Ref?></td>		
							
									<td>
									<?php if($this->AppModel->check_key('mst_usermenu',$array=array('actived' => 1, 'kd_menu' => 10, 'id' => $this->session->userdata('user_id') ))){ ?>
										<a href="<?=base_url()?>vessels/manage/change_status/<?=$vessel_list->vessel_id?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('vessel_status')?>"><i class="fa fa-tasks"></i></a>	
									<?php }?>										
									 </td>
								</tr>
								<?php } } ?>
                    
                    
								</tbody>
							</table>

							</div>
							</section>            
							</div>
							
						</div>
				

					

					</section> 
										
				</section>  




		</section> </aside> </section> <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> </section>



<!-- end -->