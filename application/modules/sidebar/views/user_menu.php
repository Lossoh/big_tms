<!-- .aside -->
<aside class="bg-<?=$this->config->item('sidebar_theme')?> b-r aside-md hidden-print" id="nav">
  <section class="vbox">
    <section class="w-f scrollable">
        <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
          <!-- nav -->
			    <nav class="nav-primary hidden-xs">
            <ul class="nav" style="margin-right: -5px;">
              <li class="nav-item start <?php if($page == lang('home')){echo  "active"; }?>" style="height: 50px;">
                <a href="<?=base_url()?>homepage" class="nav-link nav-toggle" style="height: 50px;"> 
                  <span class="title"><?=lang('home')?></span>
                </a> 
              </li> 
              <?php   
                if (isset($_html_out)){
                  echo $_html_out;
                  }
              ?> 	                
            </ul> 
          </nav>
          <!-- /nav -->
        </div>
    </section>  
</section>
</aside>
<!-- /.aside -->