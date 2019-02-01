<section id="content">
	<section class="hbox stretch">			
		<aside>
			<section class="vbox">
			<header class="header bg-white b-b clearfix">
				<div class="row m-t-sm">
					<div class="col-sm-8 m-b-xs">							
					<div class="btn-group">
						<?php if($ticket_created){?>
						<a href="<?=base_url()?>tickets/add" data-toggle="ajaxModal" title="<?=lang('new_ticket')?>" class="btn btn-sm btn-dark"><i class="fa fa-plus"></i> <?=lang('new_ticket')?></a>
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
						<table id="ticket-list" class="display" cellspacing="0" width="100%">
							<thead>
								<tr>
								<th></th>
								<th style="width: 170px;"><?=lang('sent')?> <?=lang('datetime')?></th>
								<th style="width: 100px;"><?=lang('category')?></th>
								<th style="width: 20px;"><?=lang('priority')?></th>
								<th style="width: 400px;"><?=lang('subject')?></th>
								<th style="width: 100px;"><?=lang('status')?></th>
								<th style="width: 30px;"><i class="fa fa-file-archive-o"></i></th>
								<th style="width: 150px;"><?=lang('options')?></th>
								</tr>
							</thead> 
							<tfoot>
								<?php
								  if (!empty($all_event_lists)) {
								  foreach ($all_event_lists as $all_event_list) { 
								?>
								<tr>	
								<th></th>
								<td><?=$all_event_list->datetime?></td>
								<td><?=$all_event_list->category?></td>
								<td><?=$all_event_list->priority?></td>
								<td><?=$all_event_list->subject?></td>
								<td><?=$all_event_list->status?></td>
								<td><?php if(!empty($all_event_list->attachment)){?>
								<a href="<?=base_url()?>tickets/download/<?=$all_event_list->rowID?>" class="btn btn-info btn-xs" title="<?=lang('download')?>"><i class="fa fa-download"></i></a>
								<?}?>
								</td>
								<td>
									<?php if($ticket_viewed){?>
									    <a href="#aside" value="<?=$all_event_list->datetime?>" data-toggle="class:show" class="btn green btn-xs" id="comment_lists"><i class="fa fa-comments" title="<?=lang('comments')?>"></i></a>
									<?php }?>
									<?php if($ticket_updated){?>	
									<a href="<?=base_url()?>tickets/view/edit/<?=$all_event_list->rowID?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('edit')?>"><i class="fa fa-pencil-square-o"></i></a>	
									<?php }?>									
									<?php if($ticket_deleted){?>
									<a href="<?=base_url()?>tickets/view/delete/<?=$all_event_list->rowID?>" class="btn btn-default btn-xs" data-toggle="ajaxModal" title="<?=lang('delete')?>"><i class="fa fa-trash-o"></i></a>
									<?php }?>
								</td>
								</tr>
								<?php } } ?>
                    
                    
							</tfoot>
						</table>
						</div>						
						</section>            
						</div>							
					</div>					
				</section> 									
			</section> 
			</section> 
		</aside>
		<aside class="aside-xxl bg-white b-l hide" id="aside">
			<section class="vbox">
				<section class="scrollable wrapper">
				<article class="comment-item media" id="comment-form">
												<a class="pull-left thumb-sm avatar">
												<img src="<?=base_url()?>resource/avatar/<?=$this->user_profile->get_profile_details($this->tank_auth->get_user_id(),'avatar')?>" class="img-circle"></a>
												<section class="media-body">
													<?php
													$attributes = array('class' => 'class="m-b-none"');
													echo form_open(base_url().'projects/comment?project='.$project->project_id, $attributes); ?>
													<input type="hidden" name="project_id" value="<?=$project->project_id?>">
													<input type="hidden" name="project_code" value="<?=$project->project_code?>">
													<div class="input-group">
														<input type="text" name="comment" class="form-control" required placeholder="<?=lang('type_comment_here')?>">
														<span class="input-group-btn">
														<button class="btn green" type="submit"><?=lang('post')?></button>
														</span>
													</div>
												</form>
											</section>
										</article>
		   
				</section>
			</section>   
		</aside>		
	</section> 
	<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>



