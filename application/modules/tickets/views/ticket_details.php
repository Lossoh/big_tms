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
					foreach ($case_lists as $key => $case_list) { ?>				
					<?php if($comment_viewed){?>
					<li class="b-b b-light <?php if($case_list->rowID == $this->uri->segment(4)){ echo "bg-light dk"; } ?>">
						
						<a href="<?=base_url()?>comments/view/details/<?=$case_list->rowID?>"><?=ucfirst($case_list->case_description)?></a> 
						<?php }else{ ?>
						<?=ucfirst($case_list->case_description)?>
						
					</li>
					<?php }?>
				<?php } } ?>
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
						<a href="<?=base_url()?>comments/view/add" data-toggle="ajaxModal" title="<?=lang('new_case')?>" class="btn btn-sm btn-dark"><i class="fa fa-plus"></i> <?=lang('new_case')?></a>
					</div>

						
					</div>
						
				</div> 
			</header>
			
			<section class="scrollable wrapper w-f">					
			<div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
				<section class="panel ">
					<ul class="nav nav-tabs" id="stats"> 
						<li class="active"><a href="#comments" data-toggle="tab"><?=strtoupper(lang('comments'))?></a></li>
						
					</ul> 
					
					<div class="panel-body"> 
					<div class="tab-content"> 
					<div class="tab-pane active" id="comments">
					<section class="scrollable w-f">										
						<div class="col-lg-12">													
						<section class="comment-list block">
						<article class="comment-item media">
						<a class="pull-left thumb-sm avatar"><img src="<?=base_url()?>resource/avatar/<?=$this->user_profile->get_profile_details($this->tank_auth->get_user_id(),'avatar')?>" class="img-circle"></a> 
							<section class="media-body">
							<?php   
								$attributes = array('class' => 'm-b-none');
								echo form_open(base_url().'comments/comment', $attributes); 
							?>						
								<input type="hidden" name="comments_rowID" value="<?=$this->uri->segment(4)?>">
								<section class="panel panel-default"> 
										<textarea class="form-control no-border" rows="3" name="comment" placeholder="Enter your message here"></textarea>
										<footer class="panel-footer bg-light lter">
										<?php if($comment_replied){?>
										<button class="btn btn-success pull-right btn-sm" type="submit"><?=lang('post_comment')?></button> 
										<?php }?>
										<ul class="nav nav-pills nav-sm"> 
											<li><a href="<?=base_url()?>comments"><i class="fa fa-hand-o-left text-dark"></i> <?=lang('back')?></a></li> 
										</ul> 
										</footer> 
								</section>
							</form> 
							</section> 
						</article>
						<div id="contentx">
						<?php
							if (!empty($comments_messages)) {
							foreach ($comments_messages as $key => $comments_message) { 
						?>
						<div class="baris" rowID="<?=$comments_message->rowID?>" comment_rowID="<?=$comments_message->comment_rowID?>">
						<article id="comment-id-1" class="comment-item">
							<a class="pull-left thumb-sm avatar">
							<img src="<?=base_url()?>resource/avatar/<?=$this->user_profile->get_profile_details($comments_message->user_created,'avatar')?>" class="img-circle"> </a>
							<span class="arrow left"></span>
								<section class="comment-body panel panel-default">
								<header class="panel-heading bg-white">
								<a href="<?=base_url()?>clients/view/details/<?=$comments_message->user_created*1200?>"><?=ucfirst($this->user_profile->get_profile_details($comments_message->user_created,'fullname')?$this->user_profile->get_profile_details($comments_message->comment_by,'fullname'):$this->user_profile->get_user_details($comments_message->user_created,'username'))?></a>
								<?php if($comments_message->user_created == $this->tank_auth->get_user_id()){ ?><label class="label bg-danger m-l-xs"><?=lang('you')?></label> <?php } ?>
								<span class="text-muted m-l-sm pull-right"> <i class="fa fa-clock-o"></i> <?php
																					$today = time();
																			
																					$comment_day = strtotime($comments_message->datetime_created) ;
																					echo $this->user_profile->get_time_diff($today,$comment_day);
															?> ago </span> 
								</header>
								<div class="panel-body">
									<div><small><?=$comments_message->reply_message?></small></div>
									<div class="comment-action m-t-sm"></div>
								</div>

															

								</section>
								
						</article>
						</div>
					
						
										
						<?php } }?>
														
						</div>	


						
						<div style="display:none;"><center><img src="<?=base_url()?>resource/images/loading.gif" /></center></div>
						<br/>
						<div id="lihat"><center>Lihat Berita Terdahulu</center></div>						
						</section>
						</div>
					</section>
								
					</div> 
				</div> 
				</div> 
				</section>
	
			</div>
			</section>
			</section>
		</aside> 
	</section> <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>