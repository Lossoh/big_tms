
<section id="content">
	<section class="hbox stretch">
		<aside class="aside-md bg-white b-r" id="subNav">
			<header class="dk header b-b">
			
				<div class="btn-group pull-right">
				<button class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"><?=lang('filter')?>
				<span class="caret"></span>
				</button>
				<ul class="dropdown-menu">	
				<li><a href="<?=base_url()?>vessels/view_by_status/">ALL</a></li>
				<?php foreach ($vessel_status as $status): ?>
					<li><a href="<?=base_url()?><?=$status->Kondisi_Ref_Char_02?><?=$status->No_Urut_Ref?>"><?=lang($status->Kondisi_Ref_Char_03)?></a></li>
				<?php endforeach; ?>
				
				</ul>
				</div>
			
				<a href="<?=base_url()?>vessels/manage/add" data-original-title="<?=lang('create_vessel')?>" data-toggle="tooltip" data-placement="bottom" class="btn btn-icon btn-default btn-sm pull-right"><i class="fa fa-plus"></i></a>
				<p class="h4"><?=lang('all_vessels')?></p>
			</header>
			
			<section class="vbox">
			 <section class="scrollable w-f">
			   <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
				<ul class="nav">
				<?php
				if (!empty($vessels)) {
					foreach ($vessels as $key => $vessel) { 					
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
							
						<div class="btn-group">
						<a  data-original-title="<?=lang('refresh')?>" data-toggle="tooltip" data-placement="right"  class="btn btn-sm btn-default" href="<?=current_url()?>" title="<?=lang('refresh')?>"><i class="fa fa-refresh"></i></a>
						</div>
						</div>
						<div class="col-sm-4 m-b-xs">
						<?php  echo form_open(base_url().'vessels/search'); ?>
							<div class="input-group">
								<input type="text" class="input-sm form-control" name="keyword" placeholder="<?=lang('search')?>">
								<span class="input-group-btn"> <button class="btn btn-sm btn-default" type="submit"><?=lang('go')?>!</button>
								</span>
							</div>
							</form>
						</div>
					</div> 
				</header>
			<section class="scrollable wrapper w-f">
					<!-- Start create vessel -->
			<div class="col-sm-12">
				<section class="panel panel-default">
				<header class="panel-heading font-bold"><i class="fa fa-info-circle"></i> <?=lang('vessel_details')?></header>
				<div class="panel-body">

				<?php 
				if (!empty($vessel_details)) {
				foreach ($vessel_details as $key => $vessel_detail) { 
				$attributes = array('class' => 'bs-example form-horizontal');
				echo form_open(base_url().'vessels/manage/edit',$attributes); ?>
			 
          		<div class="form-group form-md-line-input">
				<label class="col-lg-2 control-label"><?=lang('vessel_name')?> <span class="text-danger">*</span></label>
				<div class="col-lg-3">
					<input type="hidden" name="vessel_id" value="<?=$vessel_detail->vessel_id?>">
					<input type="hidden" name="vessel_ref" value="<?=$vessel_detail->vessel_ref?>">
					<input type="text" class="form-control" name="vessel_name" value="<?=$vessel_detail->vessel_name?>">
				</div>
				</div>										
						<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> <?=lang('edit_vessel')?></button>
				</form>
				<?php } } ?>
			</div>
			</section>
			</div>


<!-- End create vessel -->
			</section>  

		</section> 
		</aside> 
		</section> 
		
		
		<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> 
		
		
</section>



<!-- end -->