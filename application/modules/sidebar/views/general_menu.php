<!-- .aside -->
<aside class="bg-<?=$this->config->item('sidebar_theme')?> b-r aside-md hidden-print" id="nav">
	<section class="vbox">
		<header class="header bg-primary lter text-center clearfix">
		  <div class="btn-group">
			<button type="button" class="btn btn-sm btn-dark btn-icon" title="Links"><i class="fa fa-link"></i></button>
			<div class="btn-group hidden-nav-xs">
			  <button type="button" class="btn btn-sm green dropdown-toggle" data-toggle="dropdown"> <?=lang('quick_links')?>
			  <span class="caret">
			  </span> </button>
			  <ul class="dropdown-menu text-left">
				<li><a href="<?=base_url()?>home/conversation/send"><?=lang('send_message')?></a></li>
				<li><a href="<?=base_url()?>home/bug_view/add" data-toggle="ajaxModal"><?=lang('new_ticket')?></a></li>
				<li><a href="<?=base_url()?>profile/settings"><?=lang('my_profile')?></a></li>
			  </ul>
			</div>
		  </div> 
		</header>
		<section class="w-f scrollable">
			<div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
				<nav class="nav-primary hidden-xs">
				<ul class="nav">
					<li class="<?php if($page == lang('home')){echo  "active"; }?>">
						<a href="<?=base_url()?>home"> <i class="fa fa-home icon"> <b class="bg-success"></b> </i>
						<span><?=lang('home')?></span> </a> 
					</li>  
					<li class="<?php if($page == lang('comments')){echo  "active"; }?>"> 
						<a href="<?=base_url()?>comments" ><i class="fa fa-comments icon"> <b class="bg-success"></b> </i>
						<span><?=lang('comments')?> </span> </a> 
					</li>				
					<li class="<?php if($page == lang('tickets')){echo  "active"; }?>"> 
						<a href="<?=base_url()?>tickets" > 
							<i class="fa fa-ticket icon"><b class="bg-success"></b></i><span><?=lang('tickets')?> </span> 
						</a> 
					</li>                
				</ul> 
				</nav>              
			</div>
		</section> 
	</section>
</aside>
<!-- /.aside -->