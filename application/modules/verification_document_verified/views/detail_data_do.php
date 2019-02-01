<div class="panel panel-default">
    <div class="panel-body">
        <div class="table-responsive">
          <table id="tbl-data-do" class="table table-responsive table-striped" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>CA No</th>
                    <th>CA Date</th>
                    <th>Realization No</th>
                    <th>Realization Date</th>
                    <th>Driver Name</th>
                    <th>Police No</th>
                    <th>Fare Trip</th>
                    <th>Total Amount (Rp)</th>
                    <th>Total Realization (Rp)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(count($get_data_ca) > 0){
                    $no = 1;
                    foreach($get_data_ca as $row_ca){
                        echo '
                            <tr>
                                <td>'.$no.'</td>
                                <td>'.$row_ca->advance_no.'</td>
                                <td>'.date('d-m-Y',strtotime($row_ca->advance_date)).'</td>
                                <td>'.$row_ca->alloc_no.'</td>
                                <td>'.date('d-m-Y',strtotime($row_ca->alloc_date)).'</td>
                                <td>'.$row_ca->debtor_name.'</td>
                                <td>'.$row_ca->police_no.'</td>
                                <td>'.$row_ca->from_name.' - '.$row_ca->to_name.'</td>
                                <td align="right">'.number_format($row_ca->total_amount,0,',','.').'</td>
                                <td align="right">'.number_format($row_ca->advance_allocation,0,',','.').'</td>
                            </tr>
                        ';
                        
                        $no++;
                    }
                }
                else{
                    echo '
                        <tr>
                            <td colspan="10">No data available</td>
                        </tr>                    
                    ';
                }
                ?>
            </tbody>
          </table>
        </div>                            
    </div>
</div>  