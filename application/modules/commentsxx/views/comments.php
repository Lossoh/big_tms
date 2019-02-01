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
				?>
				<li class="b-b b-light">
					<a href="<?=base_url()?>comments/details/<?=$case_list->rowID?>">
					<?=ucfirst($this->user_profile->get_profile_details($bug->reporter,'fullname')? $this->user_profile->get_profile_details($bug->reporter,'fullname'):$this->user_profile->get_user_details($bug->reporter,'username'))?>
					<div class="pull-right">
					BUG#<?=$bug->issue_ref?>
					</div> <br>
					<small class="block small text-muted"><?=$bug->project_code?> | <i class="fa fa-circle text-<?=$priority?> pull-right m-t-xs"></i> <span class="label <?=$label?>"><?=$bug->bug_status?></span></small>

					</a> 
				</li>
				<?php } } ?>
				</ul> 
				</div>
				</section>
			</section>
		</aside> 
		<aside class="col-lg-4 b-l">
			<?php  //echo modules::run('sidebar/flash_msg');?>
			<section class="vbox">
				<section class="scrollable w-f">
				<div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
				<div class="col-lg-12">
				<h4 class="font-thin padder"><?=lang('latest_comments')?></h4>
				<!-- .comment-list -->
				<section class="comment-list block">
					<?php
						if (!empty($project_comments)) {
							foreach ($project_comments as $key => $comment) { ?>
								<article id="comment-id-1" class="comment-item">
								<a class="pull-left thumb-sm avatar">
								<img src="<?=base_url()?>resource/avatar/<?=$this->user_profile->get_profile_details($comment->posted_by,'avatar')?>" class="img-circle"> </a>
								<span class="arrow left"></span>
								<section class="comment-body panel panel-default">
								<header class="panel-heading bg-white">
								<a href="<?=base_url()?>users/view/update/<?=$comment->posted_by?>"><?=ucfirst($this->user_profile->get_profile_details($comment->posted_by,'fullname')?$this->user_profile->get_profile_details($comment->posted_by,'fullname'):$this->user_profile->get_user_details($comment->posted_by,'username'))?></a>
								<?php if($comment->posted_by == $this->tank_auth->get_user_id()){ ?><label class="label bg-default m-l-xs"><?=lang('you')?></label> <?php } ?>
								<span class="text-muted m-l-sm pull-right"> <i class="fa fa-clock-o"></i> <?php
																				$today = time();
																				$comment_day = strtotime($comment->date_posted) ;
																				echo $this->user_profile->get_time_diff($today,$comment_day);
														?> ago </span> </header>
														<div class="panel-body">
															<div><small><?=$comment->message?></small></div>
															<div class="comment-action m-t-sm">
																<?php
																if ($comment->posted_by != $this->tank_auth->get_user_id()) { ?>
																
																<a href="#comment-form" title="<?=lang('comment')?>" class="btn btn-default btn-xs">
																<i class="fa fa-comment text-muted"></i>  </a>
																<?php } ?>
																<a href="<?=base_url()?>projects/replies?c=<?=$comment->comment_id?>&p=<?=$project->project_id?>" data-toggle="ajaxModal" title="<?=lang('reply')?>"  class="btn btn-default btn-xs"> <i class="fa fa-mail-reply text-muted"></i> </a>
																<?php
																if ($comment->posted_by == $this->tank_auth->get_user_id()) { ?>
																<a href="<?=base_url()?>projects/delcomment?c=<?=$comment->comment_id?>&p=<?=$project->project_id?>" data-toggle="ajaxModal" title="<?=lang('delete')?>"  class="btn red btn-xs"> <i class="fa fa-trash-o text-white"></i> </a>
																<?php } ?>
															</div>
														</div>
														
													</section>
												</article>
												<?php
												$comment_replies = $this->project->comment_replies($comment->comment_id);
														if (!empty($comment_replies)) {
												foreach ($comment_replies as $key => $reply) { ?>
												<article id="comment-id-2" class="comment-item comment-reply"> <a class="pull-left thumb-sm avatar"> <img src="<?=base_url()?>resource/avatar/<?=$this->user_profile->get_profile_details($reply->replied_by,'avatar')?>" class="img-circle"> </a>
												<span class="arrow left"></span>
												<section class="comment-body panel panel-default text-sm">
													<div class="panel-body">
														<span class="text-muted m-l-sm pull-right">
														<i class="fa fa-clock-o"></i> <?php
																						$today = time();
																						$reply_day = strtotime($reply->date_posted) ;
																						echo $this->user_profile->get_time_diff($today,$reply_day);
														?> ago</span>
														<a href="<?=base_url()?>users/view/update/<?=$reply->replied_by?>"><?=ucfirst($this->user_profile->get_profile_details($reply->replied_by,'fullname')?$this->user_profile->get_profile_details($reply->replied_by,'fullname'):$this->user_profile->get_user_details($reply->replied_by,'username'))?></a>
													<?=$reply->reply_msg?></div>
												</section>
											</article>
											<?php } } ?>
											<?php } }else{ ?>
											<p><?=lang('no_comment_found')?></p>
											<?php } ?>
											<!-- comment form -->
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
								</div>
							</div>
							<!-- / .comment-list -->
						</section>
					</section>
				</aside> 
	</section> 
	<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> 
</section>