<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">
              <button type="button" class="btn btn-sm btn-dark btn_cleartable" onclick="location.replace('<?=base_url()?>planning_order');//history.back();"><i class="fa fa-arrow-left"></i> BACK</button>
            </div>
            <p class="pull-left"><?=lang('new_planning_order')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <div class="panel panel-default">
                <div class="panel-body">
                    <?=form_open(base_url().'planning_order/create','autocomplete="off" id="form" class="form-horizontal"')?>
                    <div class="form-group form-md-line-input">
                        <label class="col-lg-2 control-label"><?=lang('planning_order').' '.lang('date')?><span class="text-danger">*</span></label>
                        <div class="col-lg-2">
                            <input type="text" class="form-control tanggal_datetimepicker" name="trx_date" id="trx_date" placeholder="dd-mm-YYYY" value="<?=date('d-m-Y')?>" style="text-align: center;" required="" />
                        </div>
                        <label class="col-lg-5 control-label"><?=lang('job_order_no')?><span class="text-danger">*</span></label>
                        <div class="col-lg-3">
                            <select name="jo_no" id="jo_no" class="form-control all_select2" onchange="show_planning_order_detail()" required="">
            				    <option value=""><?=lang('select_your_option')?></option>
                                <?php
                                if (!empty($job_orders)) {
                                    foreach ($job_orders as $job_order) { 
                                ?>
            					       <option value="<?php echo $job_order->jo_no; ?>"><?php echo $job_order->jo_no; ?></option>
            					<?php 
                                    }
                                }
                                ?>
                			</select>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input row">
                        <label class="col-lg-2 control-label"><?=lang('vessel_name')?></label>
                        <div class="col-lg-2"><div id="desc_vessel" style="padding-top: 7px;">-</div></div>
                        <label class="col-lg-2 control-label"><?=lang('job_order_po_spk_no')?></label>
                        <div class="col-lg-2"><div id="desc_po_spk_no" style="padding-top: 7px;">-</div></div>
                        <label class="col-lg-2 control-label"><?=lang('job_order_so_no')?></label>
                        <div class="col-lg-2"><div id="desc_so_no" style="padding-top: 7px;">-</div></div>
                    </div>
                    <div class="form-group form-md-line-input row">
                        <label class="col-lg-2 control-label"><?=lang('port_name')?></label>
                        <div class="col-lg-2"><div id="desc_port_name" style="padding-top: 7px;">-</div></div>
                        <label class="col-lg-2 control-label"><?=lang('destination')?></label>
                        <div class="col-lg-2"><div id="desc_destination" style="padding-top: 7px;">-</div></div>
                    </div>
                    <br />
                    <div class="form-group form-md-line-input">
                        <div class="col-lg-12">
                            <div id="planning_order_detail">&nbsp;</div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <div class="col-lg-4">
                            <button type="submit" class="btn green btn-sm"><i class="fa fa-save"></i> SAVE</button> &nbsp;
                            <button type="button" class="btn red btn-sm " onclick="history.go(0);"><i class="fa fa-refresh"></i> REFRESH</button>
                        </div>
                    </div>
                    <?=form_close()?>
                  </div>
               </div>
            </div> 
                       
          </div>
        </div>
      </section>

    </section>
 <!-- </aside>-->
  <!-- /.aside -->

</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>