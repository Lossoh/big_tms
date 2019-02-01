<section id="content"> <section class="vbox"> <section class="scrollable padder">
	<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
		<li><a href="<?=site_url()?>"><i class="fa fa-home"></i> <?=lang('home')?></a></li>
		<li class="active"><?=lang('dashboard')?></li>
	</ul>
	<div class="m-b-md"> <h3 class="m-b-none"><?=lang('dashboard')?></h3>
		<small><?=lang('welcome_back')?> , <?php
		echo $this->user_profile->get_profile_details($this->tank_auth->get_user_id(),'fullname')  ? $this->user_profile->get_profile_details($this->tank_auth->get_user_id(),'fullname') : $this->tank_auth->get_username()?> </small>
	</div>
	<section class="panel panel-default">
		<div class="row m-l-none m-r-none bg-light lter">
			<div class="col-sm-6 col-md-3 padder-v b-r b-light">
				<span class="fa-stack fa-2x pull-left m-r-sm"> <i class="fa fa-circle fa-stack-2x text-dark"></i> <i class="fa fa-coffee fa-stack-1x text-white"></i>
				</span> <a class="clear" href="<?=base_url()?>projects/view_projects/all">
				<span class="h3 block m-t-xs"><strong><?=$this->user_profile->count_table_rows('projects')?> </strong>
				</span> <small class="text-muted text-uc"><?=lang('projects')?> </small> </a>
			</div>
			<div class="col-sm-6 col-md-3 padder-v b-r b-light">
				<span class="fa-stack fa-2x pull-left m-r-sm"> <i class="fa fa-circle fa-stack-2x text-info"></i> <i class="fa fa-tasks fa-stack-1x text-white"></i>
				</span> <a class="clear" href="<?=base_url()?>projects/view_projects/all">
				<span class="h3 block m-t-xs"><strong><?=$this->user_profile->count_table_rows('tasks')?></strong>
				</span> <small class="text-muted text-uc"><?=lang('tasks')?>  </small> </a>
			</div>
			<div class="col-sm-6 col-md-3 padder-v b-r b-light">
				<span class="fa-stack fa-2x pull-left m-r-sm"> <i class="fa fa-circle fa-stack-2x text-danger"></i> <i class="fa fa-suitcase fa-stack-1x text-white"></i>
				</span> <a class="clear" href="<?=base_url()?>invoices/manage/view/all">
				<span class="h3 block m-t-xs"><strong><?=$this->user_profile->count_table_rows('invoices')?> </strong></span>
				<small class="text-muted text-uc"><?=lang('invoices')?>  </small> </a>
			</div>
			<div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
				<span class="fa-stack fa-2x pull-left m-r-sm"> <i class="fa fa-circle fa-stack-2x text-success"></i> <i class="fa fa-user fa-stack-1x text-white"></i>
				</span> <a class="clear" href="<?=base_url()?>users/account/active">
				<span class="h3 block m-t-xs"><strong><?=$this->user_profile->count_table_rows('sa_users')?></strong>
				</span> <small class="text-muted text-uc"><?=lang('users')?>  </small> </a>
			</div>
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
								<th><?=lang('options')?></th>
							</tr> </thead>
							<tbody>
								
								<?php
								if (!empty($projects)) {
								foreach ($projects as $key => $project) { ?>								
								<tr>
								<?php
							if ($project->auto_progress == 'FALSE') {
								$progress = $project->progress;
							}else{
								$progress = round((($project->time_logged/3600)/$project->estimate_hours)*100,2);
							} ?>
									<td>									
							<?php if ($progress >= 100) { $bg = 'success'; }else{ $bg = 'danger'; } ?>
										<div class="progress progress-xs progress-striped active">
											<div class="progress-bar progress-bar-<?=$bg?>" data-toggle="tooltip" data-original-title="<?=$progress?>%" style="width: <?=$progress?>%">
											</div>
										</div>
									</td>
									<td><?=$project->project_title?> </td>
									<td>
										<a class="btn  btn-dark btn-xs" href="<?=base_url()?>projects/view/details/<?=$project->project_id?>">
										<i class="fa fa-suitcase text"></i> <?=lang('project')?></a>
									</td>
								</tr>
								<?php }
								}else{ ?>
								<tr>
									<td><?=lang('nothing_to_display')?></td><td></td><td></td>
								</tr>
								<?php } ?>
								
								
							</tbody>
						</table>
					</div> <footer class="panel-footer bg-white no-padder">
					<div class="row text-center no-gutter">
						<div class="col-xs-3 b-r b-light">
							<span class="h4 font-bold m-t block"><?=$this->user_profile->count_table_rows('sa_bugs')?>
							</span> <small class="text-muted m-b block"><?=lang('bugs')?></small>
						</div>
						<div class="col-xs-3 b-r b-light">
							<span class="h4 font-bold m-t block"><?=$this->user_profile->count_rows('projects',array('progress >='=>'100'))?>
							</span> <small class="text-muted m-b block"><?=lang('complete_projects')?></small>
						</div>
						<div class="col-xs-3 b-r b-light">
							<span class="h4 font-bold m-t block"><?=$this->user_profile->count_rows('messages',array('user_to'=>$this->tank_auth->get_user_id(),'deleted'=>'No'))?>
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
			<header class="panel-heading"><?=lang('paid_this_month')?> </header>
			<div class="panel-body text-center"> <h4><small> <?=lang('paid_amount')?> : </small>
				<?=$this->config->item('default_currency')?> <?=number_format($this->applib->monthly_payment(date('m')),2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?> </strong> </h4>
				<small class="text-muted block"><?=date('M')?> <?=date('Y')?></small>
				<div class="inline">
					<div class="easypiechart" data-percent="<?=$this->applib->average_monthly_paid(date('m'))?>" data-line-width="16" data-loop="false" data-size="188">
						<span class="h2 step"><?=$this->applib->average_monthly_paid(date('m'))?></span>%
						<div class="easypie-text"><?=lang('paid')?>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-footer"><small><?=lang('average_this_month')?></small>
			</div> </section>
		</div>
	</div>
	<div class="row">
	<?php
      $total_receipts = $this->applib->get_sum('payments','amount',$array = array('inv_deleted' => 'No'));
      $invoice_amount = $this->applib->get_sum('items','total_cost',$array = array('total_cost >' => '0'));
       $total_sales = $invoice_amount + $this->applib->total_tax();
      $outstanding = $total_sales - $total_receipts;
      if ($outstanding < 0) {
       $outstanding = 0;
      }
      if ($total_sales > 0) {
            $perc_paid = ($total_receipts/$total_sales)*100;
            if ($perc_paid > 100) {
              $perc_paid = '100';
            }else{
              $perc_paid = round($perc_paid,1);
            }
            $perc_outstanding = round(100 - $perc_paid,1);
          }else{ $perc_paid = 0; $perc_outstanding = 0;}         
          ?>

		<div class="col-md-8">
			<div class="row">
			<!-- Revenue Collection -->
                  <div class="col-lg-6">
                  <section class="panel panel-default">
                    <header class="panel-heading"><?=lang('revenue_collection')?></header>
                    <div class="panel-body text-center"> 
                    <h4><?=lang('received_amount')?></h4>  
                     <small class="text-muted block"><?=lang('percentage_collection')?></small> 

                <div class="sparkline inline" data-type="pie" data-height="150" data-slice-colors="['#65BD77','#FFC333']">
                <?=$perc_paid?>,<?=$perc_outstanding?></div>
                      <div class="line pull-in"></div>
                      <div class="text-xs">
                        <i class="fa fa-circle text-warning"></i> <?=lang('outstanding')?> - <?=$perc_outstanding?>%
                        <i class="fa fa-circle text-primary"></i> <?=lang('paid')?> - <?=$perc_paid?>%
                      </div>
                    </div>
                     <div class="panel-footer"><small><?=lang('total')?> <?=lang('outstanding')?> : <strong>
                     <?=$this->config->item('default_currency')?> <?=number_format($outstanding,2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?></strong></small></div>
                  </section>
                </div>
                <!-- Percentage Received -->
                <div class="col-lg-6">
                  <section class="panel panel-default">
                    <header class="panel-heading">
                     <?=lang('percentage_received')?>
                    </header>
                    <div class="panel-body text-center">
                    <h4><?=lang('received_amount')?></h4>  
                     <small class="text-muted block"><?=lang('percentage_received')?></small> 

                      <div class="inline">
                        <div class="easypiechart" data-percent="<?=$perc_paid?>" data-line-width="6" data-loop="false" data-size="188">
                          <span class="h2 step"><?=$perc_paid?></span>%
                          <div class="easypie-text"><?=lang('received')?></div>
                        </div>
                      </div>
                    </div>
                    <div class="panel-footer">
                    <small><?=lang('total_receipts')?> + <?=lang('tax')?>: <strong><?=$this->config->item('default_currency')?> 
                    <?=number_format($total_receipts,2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?></strong></small></div>
                  </section>
                </div>
                
              </div>
		</div>
		<div class="col-md-4"> <section class="panel panel-default b-light">
<div class="panel-body">
			<section class="comment-list block"> 
			<?php
								if (!empty($activities)) {
								foreach ($activities as $key => $activity) { ?>
			<article id="comment-id-1" class="comment-item">
				<span class="fa-stack pull-left m-l-xs"><a class="pull-left thumb-sm"><img src="<?=base_url()?>resource/avatar/<?=$this->user_profile->get_profile_details($activity->user_rowID,'avatar')?>" class="img-circle"></a>
				</span> <section class="comment-body m-b-lg">
					<header> <a href="#"><strong><?=$this->user_profile->get_profile_details($activity->user_rowID,'fullname')?$this->user_profile->get_profile_details($activity->user_rowID,'fullname'):$this->user_profile->get_user_details($activity->user_rowID,'username')?></strong></a>					
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