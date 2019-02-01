<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
    <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="row" style="padding-top: 10px;">
                <div class="col-md-6" style="padding-top: 5px;">
                    <p><?=lang('refund_list')?></p>              
                </div>     
                <div class="col-md-6 text-right">
                    <a href="#aside" data-toggle="class:show" id="btnFilter" onclick="showFilterText()" style="color: #46b8da;">Show Filter</a>
                </div>
            </div>
        </header>
        <div class="clearfix"></div> 
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
                <section class="panel panel-default">
                    <div class="table-responsive"><?php echo validation_errors(); ?>
                      <table id="tbl-orders" class="table table-striped table-hover b-t b-light text-sm">
                        <thead>
                          <tr>
    						<th>No</th>
                            <th>Refund No</th>
                            <th><?=lang('cash_advance_no')?></th>
    						<th>Refund <?=lang('date')?></th>
    						<th><?=lang('driver')?>/<?=lang('employee')?> Name</th>
                            <th>Police No</th>
    						<th><?=lang('description')?></th>
    						<th>Created By</th>
    						<th><?=lang('cash_advance_total')?></th>
    						<th>Refund Total</th>
                          </tr> 
    					</thead>
    					<tbody>
                          <?php
                          if (!empty($refund_lists)) {
                            $i = 1;
                            foreach ($refund_lists as $row) { 
                                $total_cash_advance = $row->advance_amount + $row->advance_extra_amount;
                          ?>
                          <tr>					  
    							<td><?=$i++?></td>
                                <td><?=$row->alloc_no?></td>
    							<td><?=$row->advance_no?></td>
    							<td style="width:10%"><?=date("d-m-Y",strtotime($row->alloc_date))?></td>
    							<td><?=$row->debtor_cd?> - <?=$row->debtor_name?></td>
                                <td><?=$row->police_no?></td>
    							<td><?=$row->descs?></td>
    							<td><?=ucwords($row->username)?></td>
    							<td style="text-align: right;"><?= number_format($total_cash_advance,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
    					  		<td style="text-align: right;"><?= number_format($row->alloc_amt,0,$this->config->item('decimal_separator'),$this->config->item('thousand_separator'));?></td>
                          </tr>
                        <?php } } ?>
                      </tbody>
                    </table>
    
                  </div>
                </section>  
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
            <?=form_open(base_url().'refunds/set_filter','autocomplete="off" id="form_period" class="form-horizontal"')?>                    
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
