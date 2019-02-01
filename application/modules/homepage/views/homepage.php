<section id="content" style="background-color: #fff;"> 
	<section class="vbox"> 
		<section class="scrollable padder">
		<div class="m-b-md"> 
			<h3 class="m-b-none"><?=lang('dashboard')?>
				<small>
        			<?=lang('welcome_back')?>, 
                    <?=$this->user_profile->get_profile_details($this->tank_auth->get_user_id(),'fullname') ? $this->user_profile->get_profile_details($this->tank_auth->get_user_id(),'fullname') : $this->tank_auth->get_username(); ?>.
                </small>
			</h3>
            <br />
			<h4>
            </h4>

			<!-- BEGIN DASHBOARD STATS 1-->
            <div class="row">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<a class="dashboard-stat dashboard-stat-v2 blue" href="#">
						<div class="visual">
							<i class="fa fa-comments"></i>
						</div>
						<div class="details">
							<div class="number">
								<span data-counter="counterup" data-value="<?=$jo_total?>"><?=$jo_total?></span>
							</div>
							<div class="desc"> Job Order </div>
						</div>
					</a>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<a class="dashboard-stat dashboard-stat-v2 red" href="#">
						<div class="visual">
							<i class="fa fa-dollar"></i>
						</div>
						<div class="details">
							<div class="number">
								<span data-counter="counterup" data-value="<?=$ca_total?>"><?=$ca_total?></span>
							</div>
							<div class="desc"> Cash Advance </div>
						</div>
					</a>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<a class="dashboard-stat dashboard-stat-v2 green" href="#">
						<div class="visual">
							<i class="fa fa-money"></i>
						</div>
						<div class="details">
							<div class="number">
								<span data-counter="counterup" data-value="<?=$realization_total?>"><?=$realization_total?></span>
							</div>
							<div class="desc"> Realization </div>
						</div>
					</a>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<a class="dashboard-stat dashboard-stat-v2 purple" href="#">
						<div class="visual">
							<i class="fa fa-book"></i>
						</div>
						<div class="details">
							<div class="number">
								<span data-counter="counterup" data-value="<?=$unverified_total?>"><?=$unverified_total?></span>
							</div>
							<div class="desc"> Document Unverified </div>
						</div>
					</a>
				</div>
			</div>
			<div class="clearfix"></div>
			<!-- END DASHBOARD STATS 1-->   
		</div>	
		</section>
	</section>
</section>