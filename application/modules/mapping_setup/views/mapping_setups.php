<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <aside>
      <section class="vbox">
        <header class="header bg-white b-b b-light">
          <p><?=lang('mapping_setup_details')?></p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-default">
                <div class="table-responsive">
				<?php
					if (!empty($mapping_setups)) {
						foreach ($mapping_setups as $mapping_setup) { ?>
					<table class="table">
					<tr>
						<td>
							<b>Default Setting</b>
						</td>
						<td>
						</td>
						<td>
						</td>
					</tr>
					<tr>
						<td>
							Transitory Cash/bank Account
						</td>
						<td>
							: 
						</td>
						<td>
							<?=$mapping_setup['trans_acc_code']?>&nbsp;-&nbsp;<?=$mapping_setup['trans_acc_name']?>
						</td>
					</tr>
					<tr>
						<td>
							Cash for Operational 
						</td>
						<td>
							: 
						</td>
						<td>
							<?=$mapping_setup['cash_opr_acc_code']?>&nbsp;-&nbsp;<?=$mapping_setup['cash_opr_acc_name']?>
						</td>
					</tr>
					<tr>
						<td>
							Default Bank Receipt 
						<td>
							: 
						</td>
						<td>
							<?=$mapping_setup['bank_receipt_acc_code']?>&nbsp;-&nbsp;<?=$mapping_setup['bank_receipt_acc_name']?>
						</td>
					</tr>
					<tr>
						<td>
							Default Bank Payment
						<td>
							: 
						</td>
						<td>
							<?=$mapping_setup['bank_payment_acc_code']?>&nbsp;-&nbsp;<?=$mapping_setup['bank_payment_acc_name']?>
						</td>
					</tr>
					<tr>
						<td>
							Debtor for Cash Advance
						<td>
							: 
						</td>
						<td>
							<?=$mapping_setup['employee_code']?>&nbsp;-&nbsp;<?=$mapping_setup['employee_name']?>
						</td>
					</tr>
					<tr>
						<td>
							Default UOM
						<td>
							: 
						</td>
						<td>
							<?=$mapping_setup['uom_code']?>&nbsp;-&nbsp;<?=$mapping_setup['uom_name']?>
						</td>
					</tr>
					<tr>
						<td>
							Cogs Journal To
						<td>
							: 
						</td>
						<td>
							<?=$mapping_setup['cogs_journal_to']?>
						</td>
					</tr>
					<tr>
						<td>
							<b>Prefix Number Setup</b>
						</td>
						<td>
						</td>
						<td>
						</td>
					</tr>
					<tr>
						<td>
							General Journal
						<td>
							: 
						</td>
						<td>
							<?=$mapping_setup['general_jrn']?>
						</td>
					</tr>
					<tr>
						<td>
							Memorial Journal
						<td>
							: 
						</td>
						<td>
							<?=$mapping_setup['memorial_jrn']?>
						</td>
					</tr>
					<tr>
						<td>
							Bank Receipt
						<td>
							: 
						</td>
						<td>
							<?=$mapping_setup['bank_rcp']?>
						</td>
					</tr>
					<tr>
						<td>
							Bank Payment
						<td>
							: 
						</td>
						<td>
							<?=$mapping_setup['bank_pay']?>
						</td>
					</tr>
					<tr>
						<td>
							Cash Receipt
						<td>
							: 
						</td>
						<td>
							<?=$mapping_setup['cash_rcp']?>
						</td>
					</tr>
					<tr>
						<td>
							Cash Payment
						<td>
							: 
						</td>
						<td>
							<?=$mapping_setup['cash_pay']?>
						</td>
					</tr>
					<tr>
						<td>
							Work Order
						<td>
							: 
						</td>
						<td>
							<?=$mapping_setup['wo']?>
						</td>
					</tr>
					<tr>
						<td>
							Purchase Order
						<td>
							: 
						</td>
						<td>
							<?=$mapping_setup['po']?>
						</td>
					</tr>
					<tr>
						<td>
							Confirmation Order
						<td>
							: 
						</td>
						<td>
							<?=$mapping_setup['co']?>
						</td>
					</tr>
					<tr>
						<td>
							Job Order
						<td>
							: 
						</td>
						<td>
							<?=$mapping_setup['jo']?>
						</td>
					</tr>
					<tr>
						<td>
							Delivery Order
						<td>
							: 
						</td>
						<td>
							<?=$mapping_setup['do']?>
						</td>
					</tr>
					<tr>
						<td>
							Prove of Delivery
						<td>
							: 
						</td>
						<td>
							<?=$mapping_setup['pod']?>
						</td>
					</tr>
					<tr>
						<td>
							Cash Advance Budget
						<td>
							: 
						</td>
						<td>
							<?=$mapping_setup['cash_adv_bgt']?>
						</td>
					</tr>
					<tr>
						<td>
							Cash Advance Approval
						<td>
							: 
						</td>
						<td>
							<?=$mapping_setup['cash_adv_apv']?>
						</td>
					</tr>
					<tr>
						<td>
							Cash Advance Seattlement
						<td>
							: 
						</td>
						<td>
							<?=$mapping_setup['cash_adv_stl']?>
						</td>
					</tr>
					<tr>
						<td>
							Closing JO
						<td>
							: 
						</td>
						<td>
							<?=$mapping_setup['closing_jo']?>
						</td>
					</tr>
					<tr>
						<td>
							Customer advance
						<td>
							: 
						</td>
						<td>
							<?=$mapping_setup['cst_adv']?>
						</td>
					</tr>
					<tr>
						<td>
							AR Invoice
						<td>
							: 
						</td>
						<td>
							<?=$mapping_setup['ar_inv']?>
						</td>
					</tr>
					<tr>
						<td>
							AP Invoice
				 		<td>
							: 
						</td>
						<td>
							<?=$mapping_setup['ap_inv']?>
						</td>
					</tr>
					<tr>
						<td>
							<a href="<?=base_url()?>mapping_setup/update/<?=$mapping_setup['rowID']?>" class="btn btn-sm green pull-right" title="<?=lang('edit')?>"><?=lang('edit_mapping_setup')?></a>
						<td>
							 
						</td>
						<td>
						
						</td>
					</tr>
					</table>
					<?php }} ?>
              </div>
            </section>            
          </div>
        </div>
      </section>

    </section>
  </aside>
  <!-- .end aside -->
  </section>
  </section>
   
