<table class="table table-responsive table-striped table-condensed" width="100%">
    <thead>
		<th style="text-align: center;" width="3%">#</th>
		<th style="text-align: center;" width="5%">No</th>
		<th style="text-align: center;" width="13%">Advance No</th>
		<th style="text-align: center;" width="13%">Advance Date</th>
		<th style="text-align: center;" width="16%">Cash Advance Type</th>
		<th style="text-align: center;">Description</th>
		<th style="text-align: center;" width="15%">Balance (Rp)</th>
		<th style="text-align: center;" width="18%">Amount (Rp)</th>
    </thead>
    <tbody>
        <?php
        $i=1;
        
        if(!empty($get_data_advance_loan) || !empty($get_data_advance)){
            echo '<input type="hidden" name="jumlah_advance" id="jumlah_advance" value="'.$jumlah_data_advance.'" />';
            
            foreach($get_data_advance_loan as $row){
                
        ?>
        		<tr id="baris_<?=$i?>">								
        			<td align="center">
                        <input type="checkbox" name="chk_loan[]" id="chk_loan_<?=$i?>" onclick="check_loan(<?=$i?>)" />
                        <input type="hidden" name="advance_no[]" id="advance_no_<?=$i?>" value="<?=$row->advance_no?>" />
                        <input type="hidden" name="advance_balance[]" id="advance_balance_<?=$i?>" value="<?=$row->advance_balance?>" />
                    </td>
                    <td align="center"><?=number_format($i,0,',','.')?></td>
        			<td><?=strtoupper($row->advance_no)?></td>
        			<td><?=date('d-m-Y',strtotime($row->advance_date))?></td>
        			<td><?=strtoupper($row->advance_name)?></td>
        			<td><?=strtoupper($row->description)?></td>
        			<td align="right"><?= number_format($row->advance_balance,0,',','.')?></td>
        			<td>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Rp</span>
                            <input type="text" class="form-control input-sm text-right currency" name="jumlah_loan[]" id="jumlah_loan_<?=$i?>" onkeyup="calculation_loan(<?=$i?>)" value="0" readonly="" />
                        </div>	
                    </td>
        		</tr>
        <?php 
                $i++;
            }
            
            foreach($get_data_advance as $row){
                
        ?>
        		<tr id="baris_<?=$i?>">								
        			<td align="center">
                        <input type="checkbox" name="chk_loan[]" id="chk_loan_<?=$i?>" onclick="check_loan(<?=$i?>)" />
                        <input type="hidden" name="advance_no[]" id="advance_no_<?=$i?>" value="<?=$row->advance_no?>" />
                        <input type="hidden" name="advance_balance[]" id="advance_balance_<?=$i?>" value="<?=$row->advance_balance?>" />
                    </td>
                    <td align="center"><?=number_format($i,0,',','.')?></td>
        			<td><?=strtoupper($row->advance_no)?></td>
        			<td><?=date('d-m-Y',strtotime($row->advance_date))?></td>
        			<td><?=strtoupper($row->advance_name)?></td>
        			<td><?=strtoupper($row->description)?></td>
        			<td align="right"><?= number_format($row->advance_balance,0,',','.')?></td>
        			<td>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Rp</span>
                            <input type="text" class="form-control input-sm text-right currency" name="jumlah_loan[]" id="jumlah_loan_<?=$i?>" onkeyup="calculation_loan(<?=$i?>)" value="0" readonly="" />
                        </div>	
                    </td>
        		</tr>
        <?php 
                $i++;
            }
            echo '<script> $("#btnGetLoan").show(); </script>';
        }
        else{
            echo '<tr>
                    <td align="center" colspan="8">
                        Data not available
                        <script> $("#btnGetLoan").hide(); </script>
                    </td>
                </tr>';
        }
        ?>
    </tbody>
</table>
<p>&nbsp;</p>
