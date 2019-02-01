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
            <li><a href="<?=base_url()?>collaborator/conversation/send"><?=lang('send_message')?></a></li>
            <li><a href="<?=base_url()?>collaborator/bug_view/add" data-toggle="ajaxModal"><?=lang('new_bug')?></a></li>
            <li><a href="<?=base_url()?>profile/settings"><?=lang('my_profile')?></a></li>
          </ul>
        </div>
      </div> </header>
      <section class="w-f scrollable">
        <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
          <!-- nav -->
          <nav class="nav-primary hidden-xs">
            <ul class="nav">
              <li class="<?php if($page == lang('home')){echo  "active"; }?>">
                <a href="<?=base_url()?>collaborator"> <i class="fa fa-dashboard icon"> <b class="bg-primary"></b> </i>
              <span><?=lang('home')?></span> </a> </li>

              
              <li class="<?php if($page == lang('projects')){echo  "active"; }?>"> <a href="<?=base_url()?>collaborator/projects" > <i class="fa fa-coffee icon"> <b class="bg-primary"></b> </i>
              <span><?=lang('projects')?> </span> </a> </li>

              <li class="<?php if($page == lang('messages')){echo  "active"; }?>"> <a href="<?=base_url()?>collaborator/messages" > <b class="badge bg-danger pull-right"><?=$this->user_profile->count_rows('messages',array('user_to'=>$this->tank_auth->get_user_id(),'status' => 'Unread'))?></b> <i class="fa fa-envelope-o icon"> <b class="bg-primary"></b> </i>
              <span><?=lang('messages')?> </span> </a> </li> 

               <li class="<?php if($page == lang('invoices') OR $page == lang('estimates') OR $page == lang('payments') OR $page == lang('chart')){echo  "active"; }?>">
                <a href="#" >
                <i class="fa fa-shopping-cart icon"> <b class="bg-primary"></b> </i>
                <span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i>
                </span>
                <span><?=lang('extras')?> </span> </a>
                <ul class="nav lt">
                  <li class="<?php if($page == lang('invoices') OR $page == lang('chart') OR $page == lang('add_invoice')){echo "active"; } ?>"> <a href="<?=base_url()?>collaborator/inv_manage" > <i class="fa fa-angle-right"></i>
                  <span><?=lang('invoices')?></span> </a> </li>

                  <li class="<?php if($page == lang('estimates')){echo "active"; } ?>">
                  <a href="<?=base_url()?>collaborator/estimates" > <i class="fa fa-angle-right"></i>
                  <span><?=lang('estimates')?> </span> </a> </li>
                  
                  <li class="<?php if($page == lang('payments')){echo "active"; } ?>">
                  <a href="<?=base_url()?>collaborator/payments" > <i class="fa fa-angle-right"></i>
                  <span><?=lang('payments_sent')?> </span> </a> </li>
                </ul> </li>
 

              <li class="<?php if($page == lang('bug_tracking')){echo  "active"; }?>"> <a href="<?=base_url()?>collaborator/bugs" > <i class="fa fa-bug icon"> <b class="bg-primary"></b> </i>
                <span><?=lang('bug_tracking')?> </span> </a> </li>   

                          

              

             
                
                
              </ul> </nav>
              <!-- / nav -->
            </div>
          </section>
            <footer class="footer lt hidden-xs b-t b-light">
              <div id="msg" class="dropup"> <section class="dropdown-menu on aside-md m-l-n"> <section class="panel bg-white">
              <header class="panel-heading b-b b-light"><?=lang('messages')?></header>
              <div class="panel-body animated fadeInRight">
                <p class="text-sm"><?=lang('get_started')?></p>
                <p><a href="<?=base_url()?>collaborator/conversation/send" class="btn btn-sm green"><?=lang('send_message')?></a></p>
              </div> </section> </section>
            </div>
            <div id="bug" class="dropup"> <section class="dropdown-menu on aside-md m-l-n"> <section class="panel bg-white">
            <header class="panel-heading b-b b-light"><?=lang('bugs')?></header>
            <div class="panel-body animated fadeInRight">
              <p class="text-sm"><?=lang('get_started')?></p>
              <p>
              <a href="<?=base_url()?>collaborator/bug_view/add" data-toggle="ajaxModal" class="btn btn-sm green">
              <?=lang('new_bug')?></a>
              </p>
            </div>
          </section>
        </section>
      </div>
      <div class="btn-group hidden-nav-xs">
      <button type="button" title="<?=lang('messages')?>" class="btn btn-icon btn-sm btn-light " data-toggle="dropdown" data-target="#msg"><i class="fa fa-envelope"></i></button>
       <button type="button" title="<?=lang('bugs')?>" class="btn btn-icon btn-sm btn-light" data-toggle="dropdown" data-target="#bug"><i class="fa fa-bug"></i></button>
      </div>
    </footer>

  
</section>
</aside>
<!-- /.aside -->