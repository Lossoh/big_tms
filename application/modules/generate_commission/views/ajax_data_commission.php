<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#driver" aria-controls="driver" role="tab" data-toggle="tab">Driver</a></li>
    <li role="presentation"><a href="#do" aria-controls="do" role="tab" data-toggle="tab">Delivery Order</a></li>
</ul>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="driver">
        <section class="panel panel-default">
            <div class="table-responsive"><?php echo validation_errors(); ?>
                <br />  
                <table class="table table-responsive table-striped table-condensed" width="100%">
                    <thead>
                		<th style="text-align: center;">No</th>
                		<th style="text-align: center;" width="13%">Debtor Name</th>
                		<th style="text-align: center;">Ritase</th>
                        <th style="text-align: center;" width="14%">Driver Comm (Rp)</th>
                		<th style="text-align: center;">Co Driver Comm (Rp)</th>
                		<th style="text-align: center;">Amount Deposit (Rp)</th>
                		<th style="text-align: center;">Max Saldo Loan (Rp)</th>
                		<th style="text-align: center;" width="14%">Amount Loan (Rp)</th>
                		<th style="text-align: center;">Action</th>
                    </thead>
                    <tbody>
                        <?php
                        $i=1;
                        $total_ritase = 0;
                        $total_driver_commission = 0;
                        $total_co_driver_commission = 0;
                        $total_deposit = 0;
                        
                        if(!empty($get_data_temp)){
                            echo '<input type="hidden" name="jumlah_data_commission" id="jumlah_data_commission" value="'.count($get_data_temp).'" />';
                            
                            foreach($get_data_temp as $row){
                                $max_loan = 0;
                                
                                if($row->komisi_supir < 200000){
                                    $deposit = 0;
                                }
                                else{
                                    $deposit = ($row->komisi_supir * 5) / 100;
                                }
                                
                                $total_ritase += $row->ritase;
                                $total_driver_commission += $row->komisi_supir;
                                $total_co_driver_commission += $row->komisi_kernet;
                                $total_deposit += $deposit;
                                
                                $max_loan = $this->generate_commission_model->get_max_loan($row->komisi_supir);
                                if($max_loan == null){
                                    $get_max_loan_amount = $this->generate_commission_model->get_max_loan_amount();
                                    $max_loan = $get_max_loan_amount;
                                }
                                
                        ?>
                        		<tr id="baris_<?=$i?>">								
                        			<td align="center">
                                        <?=number_format($i,0,',','.')?>
                                        <input type="hidden" name="debtor_rowid[]" id="debtor_rowid_<?=$i?>" value="<?=$row->debtor_rowID?>" />
                                        <input type="hidden" name="debtor_name[]" id="debtor_name_<?=$i?>" value="<?=$row->debtor_name?>" />
                                        <input type="hidden" name="komisi_supir[]" id="komisi_supir_<?=$i?>" value="<?=$row->komisi_supir?>" />
                                        <input type="hidden" name="komisi_kernet[]" id="komisi_kernet_<?=$i?>" value="<?=$row->komisi_kernet?>" />
                                        <input type="hidden" name="amount_deposit[]" id="amount_deposit_<?=$i?>" value="<?=$deposit?>" />
                                        <input type="hidden" name="max_saldo_loan[]" id="max_saldo_loan_<?=$i?>" value="<?=$max_loan?>" />
                                    </td>
                        			<td><a href="javascript:void()" title="Show Detail" onclick="showDetailCommission('<?=$row->debtor_rowID?>')"><?=strtoupper($row->debtor_name)?></a></td>
                        			<td align="center"><?= number_format($row->ritase,0,',','.')?></td>
                        			<td align="right"><?= number_format($row->komisi_supir,0,',','.')?></td>
                        			<td align="right"><?= number_format($row->komisi_kernet,0,',','.')?></td>
                        			<td align="right"><?= number_format($deposit,0,',','.')?></td>
                        			<td align="right"><?= number_format($max_loan,0,',','.')?></td>
                        			<td>
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">Rp</span>
                                            <input type="text" class="form-control input-sm text-right" name="amount_loan[]" id="amount_loan_<?=$i?>" value="<?=number_format($row->amount_loan,0,',','.')?>" readonly="" />
                                        </div>	
                                    </td>
                        			<td><button type="button" class="btn btn-sm btn-success" onclick="select_loan(<?=$i?>,<?=$row->debtor_rowID?>,<?=$max_loan?>)" title="Select Loan">Select Loan</button></td>
                        		</tr>
                        <?php 
                                $i++;
                            }
                        }
                        else{
                            echo '<tr><td align="center" colspan="9">Data not available</td></tr>';
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="text-align: center;" colspan="2">
                                Total
                            </th>
                    		<th style="text-align: center;">
                                <?=number_format($total_ritase,0,',','.')?>
                            </th>
                    		<th style="text-align: center;">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1">Rp</span>
                                  <input type="text" class="form-control input-sm text-right" name="total_driver_commission" id="total_driver_commission" value="<?=number_format($total_driver_commission,0,',','.')?>" readonly="" />
                                </div>      
                            </th>
                    		<th style="text-align: center;">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1">Rp</span>
                                  <input type="text" class="form-control input-sm text-right" name="total_co_driver_commission" id="total_co_driver_commission" value="<?=number_format($total_co_driver_commission,0,',','.')?>" readonly="" />
                                </div>      
                            </th>
                            <th style="text-align: center;">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1">Rp</span>
                                  <input type="text" class="form-control input-sm text-right" name="total_deposit" id="total_deposit" value="<?=number_format($total_deposit,0,',','.')?>" readonly="" />
                                </div>      
                            </th>
                            <th style="text-align: center;">
                                -      
                            </th>
                            <th style="text-align: center;">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1">Rp</span>
                                  <input type="text" class="form-control input-sm text-right" name="total_loan" id="total_loan" value="0" readonly="" />
                                </div>      
                            </th>
                            <th style="text-align: center;">
                                -      
                            </th>
                        </tr>
                    </tfoot>
                </table>
                <p>&nbsp;</p>
            </div>
        </section>  
    </div>
    <div role="tabpanel" class="tab-pane fade" id="do">
        <section class="panel panel-default">
            <div class="table-responsive"><?php echo validation_errors(); ?>
              <br />
              <table id="tbl_do_commission" class="table table-responsive table-striped table-condensed" width="100%">
                <thead>
                  <tr>
					<th width="2%">No</th>
                    <th><?=lang('realization_no')?></th>
					<th><?=lang('driver')?> Name</th>
                    <th width="12%">DO No</th>
					<th><?=lang('fare_trip')?></th>
                    <th>Driver Commission</th>
					<th>Co Driver Commission</th>
					<th><?=lang('deposit')?></th>
                  </tr> 
				</thead>
				<tbody>
                <?php
                    if(count($get_data_do_verified) > 0){
                        $no = 1;
                        foreach($get_data_do_verified as $row_do){
                ?>
                            <tr>
                                <td><?=number_format($no++,0,',','.')?></td>
                                <td><?=$row_do->trx_no?></td>
                                <td><?=$row_do->debtor_name?></td>
                                <td><?=$row_do->do_no?></td>
                                <td><?=$row_do->from_name.' - '.$row_do->to_name?></td>
                                <td align="right"><?=number_format($row_do->komisi_supir,0,',','.')?></td>
                                <td align="right"><?=number_format($row_do->komisi_kernet,0,',','.')?></td>
                                <td align="right"><?=number_format($row_do->deposit,0,',','.')?></td>
                            </tr>
                <?php
                        }
                    }
                ?>
                </tbody>
            </table>
            <script type="text/javascript">
                $(function() {
                    $('#tbl_do_commission').DataTable({
                        "aaSorting": [[0, 'asc']],
                        "bProcessing": true,
                        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
                        "sPaginationType": "full_numbers",
                	});
                 });
            </script>
          </div>
        </section>  
    </div>
</div>