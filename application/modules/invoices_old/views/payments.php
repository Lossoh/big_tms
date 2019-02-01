<!-- Start -->

<section id="content">
  <section class="hbox stretch">
  
    <aside class="aside-md bg-white b-r" id="subNav">

      <header class="dk header b-b">
    
    <p class="h4"><?=lang('all_payments')?></p>
    </header>


      <section class="vbox">
       <section class="scrollable w-f">
         <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
      <ul class="nav">



      <?php
      if (!empty($payments)) {
      foreach ($payments as $key => $p) { ?>
        <li class="b-b b-light">
        <a href="<?=base_url()?>invoices/payments/details/<?=$p->p_id?>">
        <?=ucfirst($this->applib->company_details($p->paid_by,'company_name'))?>
        <div class="pull-right">
        <?=$this->config->item('default_currency')?> <?=number_format($p->amount,2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?>
        </div> <br>
        <small class="block small text-info"><?=$p->trans_id?> | <?=strftime("%b %d, %Y", strtotime($p->created_date));?> </small>

        </a> </li>
        <?php } } ?>
      </ul> 
      </div></section>
      </section>
      </aside> 
      
      <aside>
      <section class="vbox">
        <header class="header bg-white b-b clearfix">
          <div class="row m-t-sm">
            <div class="col-sm-8 m-b-xs">
              <a href="#subNav" data-toggle="class:hide" class="btn btn-sm btn-default active">
              <i class="fa fa-caret-right text fa-lg"></i><i class="fa fa-caret-left text-active fa-lg"></i></a>
            <div class="btn-group">
            <a class="btn btn-sm btn-default" href="<?=current_url()?>" data-original-title="<?=lang('refresh')?>" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-refresh"></i></a>
            </div>
            
            </div>
            <div class="col-sm-4 m-b-xs">
            <?php  echo form_open(base_url().'invoices/payments/search'); ?>
              <div class="input-group">
                <input type="text" class="input-sm form-control" name="keyword" placeholder="<?=lang('search')?>">
                <span class="input-group-btn"> <button class="btn btn-sm btn-default" type="submit">Go!</button>
                </span>
              </div>
              </form>
            </div>
          </div> </header>
          <section class="scrollable wrapper w-f">
          <?php  echo modules::run('sidebar/flash_msg');?>
          <!-- Start Payment -->
          

<div class="column content-column">
    <div class="details-page" style="margin:45px 25px 25px 8px">
      <div class="details-container clearfix" style="margin-bottom:20px">
          <div style="font-size:10pt; font-family: Open Sans;">
            
            <div style="padding:35px;">
              <div style="padding-bottom:35px;border-bottom:1px solid #eee;width:100%;">
                <div>
                  <div style="text-transform: uppercase;font-weight: bold;">
                    <?=$this->config->item('company_name')?>
                  </div>
                  <span style="color:#999"><?=$this->config->item('company_address')?></span>
                </div>
                <div style="clear:both;"></div>
              </div>
              <div style="padding:35px 0 50px;text-align:center">
                <span style="text-transform: uppercase; border-bottom:1px solid #eee;font-size:13pt;"><?=lang('payments_received')?></span>
              </div>

              <?php
      $total_receipts = $this->user_profile->get_sum('payments','amount',$array = array('inv_deleted' => 'No'));
      $total_sales = $this->user_profile->get_sum('items','total_cost',$array = array('total_cost >' => '0'));
      $outstanding = $total_sales - $total_receipts;
      ?>

              <div style="width: 70%;float: left;">
                <div style="width: 100%;padding: 11px 0;">
                  <div style="color:#999;width:35%;float:left;"><?=lang('invoice_amount')?></div>
                  <div style="width:65%;border-bottom:1px solid #eee;float:right;foat:right;"><?=$this->config->item('default_currency')?> <?=number_format($total_sales,2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?></div>
                  <div style="clear:both;"></div>
                </div><div style="width: 100%;padding: 10px 0;">
                <div style="color:#999;width:35%;float:left;"><?=lang('payments_received')?></div>
                <div style="width:65%;border-bottom:1px solid #eee;float:right;foat:right;min-height:22px"><?=$this->config->item('default_currency')?> <?=number_format($total_receipts,2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?></div>
                <div style="clear:both;"></div>
              </div>
            </div>
            <div style="text-align:center;color:white;float:right;background:#FC8174;width: 25%;
              padding: 20px 5px;">
              <span> <?=lang('amount_received')?></span><br>
              <span style="font-size:16pt;"><?=$this->config->item('default_currency')?> <?=number_format($total_receipts,2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?></span>
              </div><div style="clear:both;"></div>
              <div style="padding-top:10px">
                <div style="width:75%;border-bottom:1px solid #eee;float:right"><strong>
                
                <?php
                $query = $this->db->get('payments');
                if ($query->num_rows() > 0){
                  $row = $query->last_row('array'); ?>
                  <a href="<?=base_url()?>invoices/manage/details/<?=$row['invoice']?>">
                  <?php echo $this->user_profile->get_invoice_details($row['invoice'],'reference_no'); ?>
                  </a>
                  <?php }else{
                    echo 'NULL';
                  }
                  ?></strong></div>
                <div style="color:#999;width:25%"><?=lang('recent_invoice')?></div>
              </div>
              <div style="padding-top:25px">
                <div style="width:75%;border-bottom:1px solid #eee;float:right"><?=$this->config->item('default_currency')?> <?=number_format($outstanding,2,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'))?></div>
                <div style="color:#999;width:25%"><?=lang('outstanding')?></div>


              </div>
            </div>
          </div>
      </div>
      
      
    </div>
</div>





           <!-- End Payment -->






          </section>  




    </section> </aside> </section> <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> </section>



<!-- end -->
