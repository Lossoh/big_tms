<section id="content">
	<section class="hbox stretch">
	
		<aside class="aside-md bg-white b-r" id="subNav">

		<header class="dk header b-b">		
			<p class="h4"><?=lang('all_cases')?></p>
		</header>


		<section class="vbox">
			<section class="scrollable w-f">
				<div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
				<ul class="nav">
				<?php
				if (!empty($case_lists)) {
					foreach ($case_lists as $key => $case_list) { 
						if($comment_viewed){
				?>			
						<li class="b-b b-light">					
							<a href="<?=base_url()?>comments/view/details/<?=$case_list->rowID?>"><?=ucfirst($case_list->case_description)?></a> 
						</li>
				<?php }else{?>
						<li class="b-b b-light">					
							<a href=""><?=ucfirst($case_list->case_description)?></a> 
						</li>
				<?php }}} ?>
				</ul> 
				</div>
			</section>
		</section>
		</aside> 
			
		<aside>
			<section class="vbox">
			<header class="header bg-white b-b clearfix">
				<div class="row m-t-sm">
					<div class="col-sm-8 m-b-xs">							
					<div class="btn-group">
						<?php if($comment_created){?>
						<a href="<?=base_url()?>comments/view/add" data-toggle="ajaxModal" title="<?=lang('new_case')?>" class="btn btn-sm btn-dark"><i class="fa fa-plus"></i> <?=lang('new_case')?></a>
						<?php }?>
					</div>

						
					</div>
						
				</div> 
			</header>
			<section class="scrollable wrapper w-f">
				<section class="scrollable wrapper">
					<div class="row"> 
						<div class="col-lg-12">							
						<section class="panel panel-default">
						<div class="table-responsive"><?php echo validation_errors(); ?>
						<table id="comment-list" class="table table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
								<tr>
								<th><?=lang('case_description')?></th>								
								<th><?=lang('options')?></th>
								</tr>
							</thead> 
							<tbody>
								<?php
								  if (!empty($case_all_lists)) {
								  foreach ($case_all_lists as $case_all_list) { 
								?>
								<tr>									
								<td><?=$case_all_list->case_description?></a></td>									
								<td>
									<?php if($comment_viewed){?>
									<a href="<?=base_url()?>comments/view/details/<?=$case_all_list->rowID?>" class="btn btn-info btn-xs" title="<?=lang('view_details')?>"><i class="fa fa-list-ol"></i></a>
									<?php }?>
									<?php if($comment_updated){?>	
									<a href="<?=base_url()?>comments/view/edit/<?=$case_all_list->rowID?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('edit')?>"><i class="fa fa-pencil-square-o"></i></a>	
									<?php }?>
									<?php if($comment_activated){ if($case_all_list->activated){ ?>
										<a href="<?=base_url()?>comments/view/inactivated/<?=$case_all_list->rowID?>" class="btn red btn-xs" data-toggle="ajaxModal" title="<?=lang('inactivated')?>"><i class="fa fa-eye-slash"></i></a>	
									<?php }else{ ?>
										<a href="<?=base_url()?>comments/view/activated/<?=$case_all_list->rowID?>" class="btn btn-success btn-xs" data-toggle="ajaxModal" title="<?=lang('activated')?>"><i class="fa fa-eye"></i></a>
									<?php }}?>
									<?php if($comment_deleted){?>
									<a href="<?=base_url()?>comments/view/delete/<?=$case_all_list->rowID?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('delete')?>"><i class="fa fa-trash-o"></i></a>
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
			</section> 
		</aside> 
	</section> 
	<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>



