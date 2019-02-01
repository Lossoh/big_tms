<?php

$type = $_POST['type'];

if($type == 'get_data_do'){
    $dbhost = '200.10.10.3:34123';
    $dbuser = 'german';
    $dbpass = '71KJ1171r74';
    $dbname = 'dev_ilms_db';
    
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    mysql_select_db($dbname);
    
    if(!$conn) {
      die('Could not connect: ' . mysql_error());
    }
    
    //$get_days_ago = date('Y-m-d', strtotime('-14 days', strtotime(date('Y-m-d'))));
    $date = date('Y-m-d', strtotime($_POST['do_date']));
    
    $sql = "SELECT a.driver_name, b.truck_name as police_no, c.vessel_name, a.sj_ref as do_no, a.reg_no_sj as barcode_no, concat(a.sj_date,' ',a.sj_time) as do_date, a.qty_bulk_delivery_netto as qty_deliver, a.qty_bulk_receipt_netto as qty_receipt, 
                        a.receipt_datetime as receipt_date
            FROM (fx_trx_sj as a LEFT JOIN fx_mst_trucks as b ON a.truck_id = b.truck_id)
										LEFT JOIN fx_mst_vessels as c ON a.vessel_id = c.vessel_id
            WHERE a.deleted = 0 AND a.sj_date = '".$date."' ORDER BY a.sj_ref ASC";
    
    $retval = mysql_query( $sql, $conn );
    
    if(! $retval ) {
      die('Could not get data: ' . mysql_error());
    }
    
    $data = array();
    $get_data = array();
    
    if(mysql_num_rows($retval) > 0){
        $no = 1;
        while($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
            $data = array(
                'do_no' => substr($row['do_no'],2),
                'barcode_no' => strtoupper($row['barcode_no']),
                'driver_name' => $row['driver_name'],
                'police_no' => $row['police_no'],
                'vessel_name' => $row['vessel_name'],
                'do_date' => $row['do_date'],
                'qty_deliver' => (int) $row['qty_deliver'],
                'receipt_date' => $row['receipt_date'],
                'qty_receipt' => (int) $row['qty_receipt'],
                'str_do_date' => date('d-m-Y',strtotime($row['do_date'])),
                'str_receipt_date' => date('d-m-Y',strtotime($row['receipt_date'])),
            );
            
            array_push($get_data,$data);

        }
    }
    
    echo json_encode($get_data);
    
    mysql_close($conn);
    
}
else if($type == 'get_data_reimburse'){
    $dbhost = '200.10.10.3:34123';
    $dbuser = 'german';
    $dbpass = '71KJ1171r74';
    $dbname = 'tas_prod';
    
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    mysql_select_db($dbname);
    
    if(!$conn ) {
      die('Could not connect: ' . mysql_error());
    }
    
    $start_date = date('Y-m-d', strtotime($_POST['start_date']));
    $end_date = date('Y-m-d', strtotime($_POST['end_date']));
    
    $sql = "SELECT Kd_Perusahaan,Kd_Cab_Perusahaan, No_Reimburst,Tgl_Reimburst,Type_Adv,Grand_Total_ADVANCE,Grand_Total_REIMBURST
            FROM reimburse_h
            WHERE Tgl_Reimburst BETWEEN '".$start_date."' AND '".$end_date."'
            ORDER BY Tgl_Reimburst, No_Reimburst";
    
    $retval = mysql_query( $sql, $conn );
    
    if(! $retval ) {
      die('Could not get data: ' . mysql_error());
    }
    
    $data = array();
    $get_data = array();
    
    if(mysql_num_rows($retval) > 0){
        $no = 1;
        while($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
            $data = array(
                'company_code' => $row['Kd_Perusahaan'],
                'branch_company_code' => $row['Kd_Cab_Perusahaan'],
                'reimburse_no' => $row['No_Reimburst'],
                'reimburse_date' => date('d F Y',strtotime($row['Tgl_Reimburst'])),
                'advance_type' => $row['Type_Adv'],
                'grand_total_advance' => $row['Grand_Total_ADVANCE'],
                'grand_total_reimburse' => $row['Grand_Total_REIMBURST']
            );
            
            array_push($get_data,$data);

        }
    }
    
    echo json_encode($get_data);
    
    mysql_close($conn);
}
else if($type == 'get_data_detail_reimburse'){
    $dbhost = '200.10.10.3:34123';
    $dbuser = 'german';
    $dbpass = '71KJ1171r74';
    $dbname = 'tas_prod';
    
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    mysql_select_db($dbname);
    
    if(!$conn ) {
      die('Could not connect: ' . mysql_error());
    }
    
    $reimburse_no = $_POST['reimburse_no'];
    
    $sql = "SELECT Kd_Perusahaan,Kd_Cab_Perusahaan,No_Reimburst,Type_Adv,No_Adv,Tgl_Adv,Nilai_Adv,Nilai_Reimburst
            FROM reimburse_d
            WHERE No_Reimburst = '".$reimburse_no."'
            ORDER BY Tgl_Adv,No_Adv";
    
    $retval = mysql_query( $sql, $conn );
    
    if(! $retval ) {
      die('Could not get data: ' . mysql_error());
    }
    
    $data = array();
    $get_data = array();
    
    if(mysql_num_rows($retval) > 0){
        $no = 1;
        while($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
            $data = array(
                'company_code' => $row['Kd_Perusahaan'],
                'branch_company_code' => $row['Kd_Cab_Perusahaan'],
                'reimburse_no' => $row['No_Reimburst'],
                'advance_no' => $row['No_Adv'],
                'advance_date' => date('d F Y',strtotime($row['Tgl_Adv'])),
                'advance_type' => $row['Type_Adv'],
                'total_advance' => $row['Nilai_Adv'],
                'total_reimburse' => $row['Nilai_Reimburst']
            );
            
            array_push($get_data,$data);

        }
    }
    
    echo json_encode($get_data);
    
    mysql_close($conn);
}
   
?> 