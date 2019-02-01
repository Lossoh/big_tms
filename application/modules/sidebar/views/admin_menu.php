<!-- .aside -->
<aside class="bg-<?=$this->config->item('sidebar_theme')?> b-r aside-md hidden-print" id="nav">
  <section class="vbox">
    <header class="header bg-primary lter text-center clearfix">
      <div class="btn-group">
        <button type="button" class="btn btn-sm btn-dark btn-icon" title="<?=lang('quick_links')?>"><i class="fa fa-link"></i></button>
        <div class="btn-group hidden-nav-xs">
          <button type="button" class="btn btn-sm green dropdown-toggle" data-toggle="dropdown"> <?=lang('quick_links')?>
          <span class="caret">
          </span> </button>
          <ul class="dropdown-menu text-left">
            <li><a href="<?=base_url()?>messages/conversation/send"><?=lang('send_message')?></a></li>
            <li><a href="<?=base_url()?>bugs/view/add" data-toggle="ajaxModal"><?=lang('new_bug')?></a></li>
            <li><a href="<?=base_url()?>settings/update/general"><?=lang('settings')?></a></li>
            
          </ul>
        </div>
      </div> </header>
      <section class="w-f scrollable">
        <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
          <!-- nav -->
          <nav class="nav-primary hidden-xs">
            <ul class="nav">
              <li class="<?php if($page == lang('home')){echo  "active"; }?>">
                <a href="<?=base_url()?>"> <i class="fa fa-dashboard icon"> <b class="bg-success"></b> </i>
              <span><?=lang('home')?></span> </a> </li>

              <li class="<?php if($page == lang('clients')){echo  "active"; }?>"> <a href="<?=base_url()?>companies" > <i class="fa fa-user icon"> <b class="bg-success"></b> </i>
              <span><?=lang('clients')?> </span> </a> </li>

              <li class="<?php if($page == lang('templates')){echo  "active"; }?>"> <a href="<?=base_url()?>templates"> <i class="fa fa-tasks icon"> <b class="bg-success"></b> </i>
              <span><?=lang('templates')?> </span> </a> </li>

               <li class="<?php if($page == lang('invoices') OR $page == lang('estimates') OR $page == lang('payments') OR $page == lang('chart') OR $page == lang('add_invoice')){echo  "active"; }?>">
                <a href="#" >
                <i class="fa fa-shopping-cart icon"> <b class="bg-success"></b> </i>
                <span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i>
                </span>
                <span><?=lang('sales')?> </span> </a>
                <ul class="nav lt">
                  <li class="<?php if($page == lang('invoices') OR $page == lang('chart') OR $page == lang('add_invoice')){echo "active"; } ?>">  <i class="fa fa-angle-right"></i>
                  <span><?=lang('invoices')?></span>  </li>
                <ul class="nav lt">
                  <li class="<?php if($page == lang('invoices') OR $page == lang('chart') OR $page == lang('add_invoice')){echo "active"; } ?>"> <a href="<?=base_url()?>invoices/manage/view/all" > <i class="fa fa-angle-right"></i>
                  <span><?=lang('invoices')?></span> </a> </li>
				  </ul>
                  <li class="<?php if($page == lang('estimates')){echo "active"; } ?>"> <a href="<?=base_url()?>estimates" > <i class="fa fa-angle-right"></i>
                  <span><?=lang('estimates')?> </span> </a> </li>
                  
                  <li class="<?php if($page == lang('payments')){echo "active"; } ?>"> <a href="<?=base_url()?>invoices/payments" > <i class="fa fa-angle-right"></i>
                  <span><?=lang('payments_received')?> </span> </a> </li>
                </ul> </li>

              
              <li class="<?php if($page == lang('projects')){echo  "active"; }?>"> <a href="<?=base_url()?>projects/view_projects/all" > <i class="fa fa-coffee icon"> <b class="bg-success"></b> </i>
              <span><?=lang('projects')?> </span> </a> </li>

              <li class="<?php if($page == lang('messages')){echo  "active"; }?>"> <a href="<?=base_url()?>messages" > <b class="badge bg-info pull-right"><?=$this->user_profile->count_rows('messages',array('user_to'=>$this->tank_auth->get_user_id(),'status' => 'Unread'))?></b> <i class="fa fa-envelope-o icon"> <b class="bg-success"></b> </i>
              <span><?=lang('messages')?> </span> </a> </li> 
              

              <li class="<?php if($page == lang('bug_tracking')){echo  "active"; }?>"> <a href="<?=base_url()?>bugs/view_by_status/all" > <i class="fa fa-bug icon"> <b class="bg-success"></b> </i>
                <span><?=lang('bug_tracking')?> </span> </a> </li>              

              

              <li class="<?php if($page == lang('general_settings') OR $page == lang('system_settings') OR $page == lang('email_settings')){echo  "active"; }?>">
                <a href="#" >
                <i class="fa fa-cogs icon"> <b class="bg-success"></b> </i>
                <span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i>
                </span>
                <span><?=lang('settings')?> </span> </a>
                <ul class="nav lt">
                  <li class="<?php if($page == lang('general_settings')){echo "active"; } ?>"> <a href="<?=base_url()?>settings/update/general" > <i class="fa fa-angle-right"></i>
                  <span><?=lang('general_settings')?></span> </a> </li>

                  <li class="<?php if($page == lang('system_settings')){echo "active"; } ?>"> <a href="<?=base_url()?>settings/update/system" > <i class="fa fa-angle-right"></i>
                  <span><?=lang('system_settings')?> </span> </a> </li>
                  
                  <li class="<?php if($page == lang('email_settings')){echo "active"; } ?>"> <a href="<?=base_url()?>settings/update/email" > <i class="fa fa-angle-right"></i>
                  <span><?=lang('email_settings')?> </span> </a> </li>
                </ul> </li>
                <li class="<?php if($page == lang('users')){echo  "active"; }?>"> <a href="<?=base_url()?>users/account" > <i class="fa fa-lock icon"> <b class="bg-success"></b> </i>
                <span><?=lang('system_users')?> </span> </a> </li>
                
              </ul> </nav>
              <!-- / nav -->
            </div>
          </section>
          <footer class="footer lt hidden-xs b-t b-light">
            <div id="inv" class="dropup"> <section class="dropdown-menu on aside-md m-l-n"> <section class="panel bg-white">
            <header class="panel-heading b-b b-light"><?=lang('invoice_shortcuts')?></header>
            <div class="panel-body animated fadeInRight">
              <p class="text-sm"><?=lang('create_invoice')?></p>
              <p><a href="<?=base_url()?>invoices/manage/add" class="btn btn-sm green"><?=lang('new_invoice')?></a></p>
            </div> </section> </section>
          </div>
          <div id="pro" class="dropup"> <section class="dropdown-menu on aside-md m-l-n"> <section class="panel bg-white">
          <header class="panel-heading b-b b-light"> <?=lang('project_shortcuts')?> </header>
          <div class="panel-body animated fadeInRight">
            <p class="text-sm"><?=lang('create_project')?></p>
            <p><a href="<?=base_url()?>projects/view/add" class="btn btn-sm green"><?=lang('create_project')?></a></p>
          </div>
        </section>
      </section>
    </div>
    
    <div class="btn-group hidden-nav-xs"> <button type="button" title="<?=lang('invoices')?>" class="btn btn-icon btn-sm btn-black " data-toggle="dropdown" data-target="#inv"><i class="fa fa-shopping-cart"></i></button>
    <button type="button" title="<?=lang('projects')?>" class="btn btn-icon btn-sm btn-black" data-toggle="dropdown" data-target="#pro"><i class="fa fa-coffee"></i></button>
    </div>
  </footer>

  
</section>
</aside>
<!-- /.aside -->