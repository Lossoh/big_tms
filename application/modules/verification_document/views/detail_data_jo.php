<div class="panel panel-default">
    <div class="panel-body">
        <div class="table-responsive">
          <table id="tbl-data-do" class="table table-responsive table-striped" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th><?=lang('job_order_no')?> </th>
					<th><?=lang('job_order_date')?> </th>
					<th><?=lang('debtor')?> </th>
					<th><?=lang('job_order_po_spk_no')?> </th>
					<th><?=lang('job_order_so_no')?> </th>
					<th><?=lang('vessel_name')?> </th>
					<th><?=lang('port_name')?> </th>
					<th><?=lang('fare_trip')?> </th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(count($get_data_jo) > 0){
                    $no = 1;
                    foreach($get_data_jo as $row_jo){
                        echo '
                            <tr>
                                <td>'.$no.'</td>
                                <td>'.$row_jo->jo_no.'</td>
                                <td>'.date('d-m-Y',strtotime($row_jo->jo_date)).'</td>
                                <td>'.$row_jo->debtor_name.'</td>
                                <td>'.$row_jo->po_spk_no.'</td>
                                <td>'.$row_jo->so_no.'</td>
                                <td>'.$row_jo->vessel_name.'</td>
                                <td>'.$row_jo->port_name.'</td>
                                <td>'.$row_jo->destination_from_name.' - '.$row_jo->destination_to_name.'</td>
                            </tr>
                        ';
                        
                        $no++;
                    }
                }
                else{
                    echo '
                        <tr>
                            <td colspan="9">No data available</td>
                        </tr>                    
                    ';
                }
                ?>
            </tbody>
          </table>
        </div>                            
    </div>
</div>  