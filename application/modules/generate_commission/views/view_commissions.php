<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <!--<aside>-->
      <section class="vbox">
        <header class="header bg-white b-b b-light">
            <div class="pull-right" style="margin-top: 10px;">
                <a class="btn btn-sm btn-dark" href="<?=base_url()?>generate_commission"><i class="fa fa-arrow-left"></i> <?=lang('back')?></a>
            </div>
          <p class="pull-left">View <?=lang('generate_commissions')?> (Comm)</p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive">
                  <table class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th>Commission No</th>
                        <th>Until Date</th>
                        <th>Total Driver Comm (Rp)</th>
                        <th>Total Co Driver Comm (Rp)</th>
                        <th>Total Deposit (Rp)</th>
                        <th>Total Loan (Rp)</th>
                      </tr> 
                    </thead> 
                    <tbody>
                      <?php
                      if (!empty($commission)) {
                      ?>
                      <tr>
						<td><?=$commission->commission_no.'['.$commission->period.']'?></td>
						<td><?=date("d F Y",strtotime($commission->until_date))?></td>
						<td align="right"><?=number_format($commission->total_driver_commission,0,',','.')?></td>
						<td align="right"><?=number_format($commission->total_co_driver_commission,0,',','.')?></td>
						<td align="right"><?=number_format($commission->total_deposit,0,',','.')?></td>
						<td align="right"><?=number_format($commission->total_loan,0,',','.')?></td>
                      </tr>
                    <?php 
                         
                      } 
                    ?>
                    
                    
                  </tbody>
                </table>

              </div>
              <br />
              <hr />
              <h4> &nbsp; &nbsp;Detail Commission</h4>
              <div class="table-responsive">
                  <table class="table table-striped table-hover b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th>Driver Name</th>
                        <th>Driver Comm (Rp)</th>
                        <th>Co Driver Comm (Rp)</th>
                        <th>Deposit (Rp)</th>
                        <th>Max Saldo Loan (Rp)</th>
                        <th>Amount Loan (Rp)</th>
                      </tr> 
                    </thead> 
                    <tbody>
                      <?php
                      if (!empty($commission_details)) {
                        foreach($commission_details as $row_dtl){
                      ?>
                      <tr>
						<td><?=$row_dtl->debtor_name?></td>
						<td align="right"><?=number_format($row_dtl->driver_commission,0,',','.')?></td>
						<td align="right"><?=number_format($row_dtl->co_driver_commission,0,',','.')?></td>
						<td align="right"><?=number_format($row_dtl->amount_deposit,0,',','.')?></td>
						<td align="right"><?=number_format($row_dtl->max_saldo_loan,0,',','.')?></td>
						<td align="right"><?=number_format($row_dtl->amount_loan,0,',','.')?></td>
                      </tr>
                    <?php 
                        }
                      } 
                    ?>
                    
                    
                  </tbody>
                </table>

              </div>
            </section>            
          </div>
        </div>
      </section>

    </section>
  <!--</aside>-->
  
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>