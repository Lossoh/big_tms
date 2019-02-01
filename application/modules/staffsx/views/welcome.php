<section id="content"> <section class="vbox"> <section class="scrollable padder">
	<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
		<li><a href="<?=site_url()?>"><i class="fa fa-home"></i> <?=lang('home')?></a></li>
		<li class="active"><?=lang('dashboard')?></li>
	</ul>
	
	
	<div class="m-b-md"> <h3 class="m-b-none"><?=lang('dashboard')?></h3>
		<small><?=lang('welcome_back')?> , <?php
		echo $this->user_profile->get_profile_details($this->tank_auth->get_user_id(),'fullname') ? $this->user_profile->get_profile_details($this->tank_auth->get_user_id(),'fullname') : $this->tank_auth->get_username()?> </small>
	</div>
	<section class="panel panel-default">
		<div class="row m-l-none m-r-none bg-light lter">

<div style="margin-left:35%;">
<object width="300" height="200" data="<?=base_url()?>resource/croflash.swf" type="application/x-shockwave-flash">
<param name="data" value="croflash.swf" /><param name="src" value="croflash.swf" />
<embed src="<?=base_url()?>resource/croflash.swf" type="application/x-shockwave-flash"  width="300" height="300"></embed>
</object>
</div >		
		
		
		</div> </section>
		<div class="row">
			<div class="col-md-8">
				<section class="panel panel-default">
				<header class="panel-heading font-bold"> <?=lang('recent_projects')?></header>
				<div class="panel-body">
					
					<table class="table table-striped m-b-none text-sm">
						<thead>
							<tr>
								<th><?=lang('progress')?></th>
								<th><?=lang('project_name')?> </th>
								<th class="pull-right"><?=lang('options')?></th>
							</tr> </thead>
							<tbody>
								
								
								
								
							</tbody>
						</table>
					</div> <footer class="panel-footer bg-white no-padder">
					<div class="row text-center no-gutter">
						<div class="col-xs-3 b-r b-light">
							<span class="h4 font-bold m-t block"><?=$this->user_profile->count_rows('sa_bugs',array('reporter'=>$this->tank_auth->get_user_id()))?>
							</span> <small class="text-muted m-b block"><?=lang('reported_bugs')?></small>
						</div>
						<div class="col-xs-3 b-r b-light">
							<small class="text-muted m-b block"><?=lang('complete_projects')?></small>
						</div>
						<div class="col-xs-3 b-r b-light">
							<span class="h4 font-bold m-t block"><?=$this->user_profile->count_rows('messages',array('user_to'=>$this->tank_auth->get_user_id()))?>
							</span> <small class="text-muted m-b block"><?=lang('received_messages')?></small>
						</div>
						<div class="col-xs-3">
							<span class="h4 font-bold m-t block"><?=$this->user_profile->count_rows('comments',array('posted_by'=>$this->tank_auth->get_user_id()))?>
							</span> <small class="text-muted m-b block"><?=lang('project_comments')?></small>
						</div>
					</div> </footer>
				</section>
			</div>
			<div class="col-lg-4"> <section class="panel panel-default">
			<header class="panel-heading"><?=lang('payments_sent')?> </header>
			<div class="panel-body text-center"> <h4><small> <?=lang('paid_amount')?> : </small>
				<?=$this->config->item('default_currency')?>
				</strong> </h4>
				<small class="text-muted block"><?=lang('amount_received')?></small>
				<div class="inline">

					<div class="easypiechart" data-percent="<?=$perc_paid?>" data-line-width="16" data-loop="false" data-size="188">
						
						<span class="h2 step"><?=$perc_paid?></span>%
						<div class="easypie-text"><?=lang('paid')?>
						</div>
					</div>
				</div>
			</div>
			</section>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			<!-- Start Charts -->
			<div class="row">
				<div class="col-lg-6">
					<section class="panel panel-default">
					<header class="panel-heading"><?=lang('my_projects')?></header>
					<div class="panel-body text-center">

					</div>
					<div class="panel-footer"><small><?=lang('projects_completion')?></small></div>
				</section>
			</div>
			<div class="col-lg-6">

				<section class="panel panel-default">
					<header class="panel-heading">
						<?=lang('outstanding')?> <?=lang('amount')?>
					</header>

					<div class="panel-footer"><small><?=lang('balance_due')?> : <strong><?=$this->config->item('default_currency')?> <?=number_format($due,2)?></strong></small></div>
				</section>
			</div>
		</div>
		<!-- End Charts -->
	</div>
	<div class="col-md-4"> <section class="panel panel-default b-light">
		<div class="panel-body">
			<section class="comment-list block">
				<?php
									if (!empty($activities)) {
				foreach ($activities as $key => $activity) { ?>
				<article id="comment-id-1" class="comment-item">
					<span class="fa-stack pull-left m-l-xs"><a class="pull-left thumb-sm"><img src="<?=base_url()?>resource/avatar/<?=$this->user_profile->get_profile_details($activity->user,'avatar')?>" class="img-circle"></a>
					</span> <section class="comment-body m-b-lg">
						<header> <a href="#"><strong><?=$this->user_profile->get_profile_details($activity->user,'fullname')?$this->user_profile->get_profile_details($activity->user,'fullname'):$this->user_profile->get_user_details($activity->user,'username')?></strong></a>
						<span class="text-muted text-xs"> <?php
								$today = time();
								$activity_day = strtotime($activity->activity_date) ;
								echo $this->user_profile->get_time_diff($today,$activity_day);
					?> ago</span> </header>
					<div><?=$activity->activity?></div>
				</section>
			</article>
			<?php }} ?>
			
		</section>
	</div>
	
</section>
</div>
</div>
</section>
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> </section>