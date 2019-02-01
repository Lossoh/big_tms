					<?php
							if (!empty($case_comments_more)) {
							foreach ($case_comments_more as $key => $case_comment_more) { 
						?>
						<div class="baris" rowID="<?=$case_comment_more->rowID?>" comment_rowID="<?=$case_comment_more->comment_rowID?>">
						<article id="comment-id-1" class="comment-item">
							<a class="pull-left thumb-sm avatar">
							<img src="<?=base_url()?>resource/avatar/<?=$this->user_profile->get_profile_details($case_comment_more->user_created,'avatar')?>" class="img-circle"> </a>
							<span class="arrow left"></span>
								<section class="comment-body panel panel-default">
								<header class="panel-heading bg-white">
								<a href="<?=base_url()?>clients/view/details/<?=$case_comment_more->user_created*1200?>"><?=ucfirst($this->user_profile->get_profile_details($case_comment_more->user_created,'fullname')?$this->user_profile->get_profile_details($case_comment_more->comment_by,'fullname'):$this->user_profile->get_user_details($case_comment_more->user_created,'username'))?></a>
								<?php if($case_comment_more->user_created == $this->tank_auth->get_user_id()){ ?><label class="label bg-danger m-l-xs"><?=lang('you')?></label> <?php } ?>
								<span class="text-muted m-l-sm pull-right"> <i class="fa fa-clock-o"></i> <?php
																					$today = time();
																			
																					$comment_day = strtotime($case_comment_more->datetime_created) ;
																					echo $this->user_profile->get_time_diff($today,$comment_day);
															?> ago </span> 
								</header>
								<div class="panel-body">
									<div><small><?=$case_comment_more->reply_message?></small></div>
									<div class="comment-action m-t-sm"></div>
								</div>

															

								</section>
						</article>
					</div>					
						<?php } }else{ ?>
							<p><?=lang('no_comment_found')?></p>
						<?php } ?>
									
