<section id="content">
	<section class="hbox stretch">
		
		<aside class="aside-md bg-white b-r" id="subNav">
			<div class="wrapper b-b header"><?=lang('all_messages')?>
			</div>
			<section class="vbox">
				<section class="scrollable w-f">
					<div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
						<ul class="nav">
							<?php
							if (!empty($users)) {
							foreach ($users as $key => $user) { ?>
							<li class="b-b b-light">
								<a href="<?=base_url()?>messages/conversation/view/<?=$user->id*1200?>">
							<i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i><?=ucfirst($this->user_profile->get_profile_details($user->user_from,'fullname')?$this->user_profile->get_profile_details($user->user_from,'fullname'): $user->username)?></a></li>
							<?php }} ?>
						</ul>
					</div></section>
				</section>
			</aside>
			<!-- .aside -->
			<aside class="bg-light lter b-l" id="email-list">
				<section class="vbox">
					<header class="header bg-white b-b clearfix">
						<div class="row m-t-sm">
							<div class="col-sm-8 m-b-xs">
								<a href="#subNav" data-toggle="class:hide" class="btn btn-sm btn-default active">
								<i class="fa fa-caret-right text fa-lg"></i><i class="fa fa-caret-left text-active fa-lg"></i></a>
								
							</div>
							<div class="col-sm-4 m-b-xs">
							<?php echo form_open(base_url().'messages/search/'); ?>
								<div class="input-group">
									<input type="text" class="input-sm form-control" name="keyword" placeholder="<?=lang('keyword')?>">
									<span class="input-group-btn"> <button class="btn btn-sm btn-default" type="submit">Go!</button>
									</span>
								</div>
								</form>
							</div>
						</div> </header>
						<section class="scrollable hover w-f">
						<div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
								
	<section class="panel panel-default">
	<header class="panel-heading font-bold"><i class="fa fa-envelope"></i> <?=lang('message_notification')?></header>
	<div class="panel-body">
	  <?php

			$attributes = array('class' => 'bs-example form-horizontal');
          echo form_open(base_url().'messages/conversation/send',$attributes); ?>

          <input type="hidden" name="r_url" value="<?=base_url()?>messages">

          <div class="form-group form-md-line-input">
				<label class="col-lg-3 control-label"><?=lang('username')?> <span class="text-danger">*</span> </label>
				<div class="col-lg-9">
					<div class="m-b"> 
					<select id="select2-option" style="width:260px" name="user_to" > 
					<optgroup label="Clients"> 
					<?php foreach ($clients as $client): ?>
					<option value="<?=$client->id?>"><?=ucfirst($client->username)?></option>
					<?php endforeach; ?>
					</optgroup> 
					<optgroup label="Admins"> 
						<?php foreach ($admins as $admin): ?>
						<option value="<?=$admin->id?>"><?=ucfirst($admin->username)?></option>
						<?php endforeach; ?>
					</optgroup> 
					</select> 
					</div> 
				</div>
			</div>

			<div class="form-group form-md-line-input">
				<label class="col-lg-3 control-label"><?=lang('message')?> <span class="text-danger">*</span></label> 
				<div class="col-lg-9">
					<textarea name="message" class="form-control" ></textarea>
				</div>
			</div>
			
			
			<div class="form-group form-md-line-input">
				<div class="col-lg-offset-2 col-lg-10">
				<button type="submit" class="btn btn-sm btn-success pull-right"><i class="fa fa-check"></i> <?=lang('send_message')?></button>
				</div>
			</div>
			
		</form>
	</div> </section>
	</div>




</section>
			<footer class="footer b-t bg-white-only">
				<form class="m-t-sm">
					<div class="input-group">
						<input class="input-sm form-control input-s-sm" placeholder="<?=lang('search')?>" type="text">
							<div class="input-group-btn"> <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
								</div>
					</div>
				</form> 
			</footer> </section></aside>
		</section> 
		</aside> 
		</section> 
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> 
</section>