<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="row" style="padding-top: 10px;">
                <div class="col-md-6" style="padding-top: 5px;">
                    <p><?=lang('cash_advance_deleted')?></p>              
                </div>     
                <div class="col-md-6 text-right">
                    <a href="#aside" data-toggle="class:show" id="btnFilter" onclick="showFilterText()" style="color: #46b8da;">Show Filter</a> &nbsp;
                    <?php
                    if($this->user_profile->get_user_access('PrintLimited') == 1 || $this->user_profile->get_user_access('PrintUnlimited') == 1 || 
                        $this->user_profile->get_user_access('PrintOne') == 1 || $this->user_profile->get_user_access('PrintTwo') == 1){
                    ?>              
                        <a  class="btn btn-sm red" onclick="cash_advance_deleted_pdf()"><i class="fa fa-file-pdf-o"></i> Print PDF</a>
                        <a  class="btn btn-sm btn-success" onclick="cash_advance_deleted_excel()"><i class="fa fa-file-excel-o"></i> Print Excel</a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </header>
        <div class="clearfix"></div> 
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive"><?php echo validation_errors(); ?>
                      <table class="table table-striped table-hover b-t b-light text-sm tbl-data">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th><?=lang('cash_advance_no')?></th>
    						<th>CA <?=lang('date')?></th>
    						<th><?=lang('driver')?>/<?=lang('employee')?> Name</th>
    						<th><?=lang('fare_trip_code')?></th>
                            <th width="10%">Police No</th>
    						<th><?=lang('cash_advance_amt')?></th>
    						<th><?=lang('extra_amount')?></th>
    						<th>Addendum</th>
    						<th><?=lang('cash_advance_alloc')?></th>
    						<th><?=lang('balance')?></th>
                          </tr> 
                        </thead> 
                        <tbody>
                          <?php
                          if (!empty($cash_advance_lists)) {
                          $no = 1;
                          foreach ($cash_advance_lists as $cash_advance_list) { 
                                $total_balance = ($cash_advance_list->advance_amount + $cash_advance_list->advance_extra_amount + $cash_advance_list->pay_over_allocation) - $cash_advance_list->advance_allocation;
                          ?>
                          <tr>
                                <td align="center"><?=number_format($no++,0,',','.')?></td>	
          			            <td><?=$cash_advance_list->advance_no?></td>
    							<td style="width:10%"><?=date("d-m-Y H:i:s",strtotime($cash_advance_list->advance_date.' '.$cash_advance_list->time_created))?></td>
    							<td><?=$cash_advance_list->debtor_code?> - <?=$cash_advance_list->debtor_name?></td>
    							<td><?=$cash_advance_list->fare_trip_no == '' ? '-' : $cash_advance_list->fare_trip_no?></td>
                                <td align="center"><?=empty($cash_advance_list->police_no) ? '-' : $cash_advance_list->police_no.' '.$star?></td>
    							<td style="text-align: right;"><?= number_format($cash_advance_list->advance_amount,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
    							<td style="text-align: right;"><?= number_format($cash_advance_list->advance_extra_amount,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
    							<td style="text-align: right;"><?= number_format($cash_advance_list->pay_over_allocation,0,',','.');?></td>
    							<td style="text-align: right;"><?= number_format($cash_advance_list->advance_allocation,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
    							<td style="text-align: right;"><?= number_format($total_balance,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
                        </tr>
                        <?php } } ?>
                      </tbody>
                    </table>
    
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

<!-- /.aside -->
<aside class="aside-xxl bg-white b-l hide" id="aside">
    <section class="vbox">
		<section class="scrollable wrapper">
            <?=form_open(base_url().'cash_advance_deleted/set_filter','autocomplete="off" id="form_period" class="form-horizontal"')?>                    
            <div class="row">
                <div class="col-md-9">
                    <div class="input-group input-daterange" style="position: relative;display: inline-flex;">
                        <input type="text" name="start_date" id="start_date" class="form-control input-sm tanggal_datetimepicker" placeholder="<?=lang('start_date')?>" value="<?=date('d-m-Y', strtotime($start_date))?>">
                        <span class="input-group-addon" style="width: 50px;">to</span>
                        <input type="text" name="end_date" id="end_date" class="form-control input-sm tanggal_datetimepicker" placeholder="<?=lang('end_date')?>" value="<?=date('d-m-Y', strtotime($end_date))?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-filter"></i> Filter</button>
                </div>
            </div>
            <?=form_close()?>
        </section>
	</section>   
</aside>
<!-- /.aside -->
