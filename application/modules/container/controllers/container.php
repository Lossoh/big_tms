<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Container extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('container_model');
        $this->load->model('appmodel');
        $this->load->library('pdf_generator');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('containers') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('containers');
        $this->session->set_userdata('page_header', 'transaction');
        $this->session->set_userdata('page_detail', 'container');
        $data['datatables'] = true;
        $data['form'] = true;
        
        if($this->session->userdata('start_date_container') == '' ){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_container')));
        }

        if($this->session->userdata('end_date_container') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_container')));
        }

        // if($this->session->userdata('start_date') == '' && $this->session->userdata('end_date') == ''){
        //     $start_date = date("Y-m-d",strtotime("yesterday"));
        //     $end_date = date("Y-m-d");
        // }
        // else{
        //     $start_date = $this->session->userdata('start_date');
        //     $end_date = $this->session->userdata('end_date');
        // }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['vehicles'] = $this->container_model->get_data_vehicle();
        // $data['job_orders'] = $this->container_model->get_all_records_list($start_date,$end_date);
        
        $this->template->set_layout('users')->build('containers', isset($data) ? $data : null);
    }    
    
    function set_filter(){
       $this->session->set_userdata('start_date',date("Y-m-d",strtotime($this->input->post('start_date'))));
       $this->session->set_userdata('end_date',date("Y-m-d",strtotime($this->input->post('end_date'))));    
       
       redirect(base_url().'container');
    }

    function get_data($row_id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        
        $hasil = $this->container_model->get_data_detail_by_rowID($row_id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function get_data_cargo($jo_no)
    {
        error_reporting(E_ALL);        
        $get_data = $this->container_model->get_cargo_by_jo($jo_no);
        $result = '<option value="">'.lang('select_your_option').'</option>';
        foreach($get_data as $row){
            $result .= '<option value="'.$row->rowID.'">'.$row->item_name.'</option>';
        }
        
        echo $result;
        exit;
    }
    
    function get_data_destination($row_id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        
        $hasil = $this->container_model->get_destination_by_container_rowID($row_id);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }

    function print_do($do_no)
    {
        
        $get_data = $this->container_model->get_data_do_by_do_no($do_no);
        $get_address = $this->container_model->get_by_id('sa_destination',$get_data->to_rowID);
        $address = '-';
        if(count($get_address) > 0){
            $address = $get_address->address1 == '' ? '-' : $get_address->address1; 
            if($address != '-'){
                $address .= '<br><br>'.$get_address->address2.'<br><br>'.$get_address->address3;
            }           
        }
        
        $get_detail_container = $this->container_model->get_by_id('tr_jo_emkl_trx_dtl',$get_data->jo_detail_rowID);
        $get_cargo = $this->container_model->get_by_id('sa_item',$get_detail_container->item_rowID);
        $get_container = $this->container_model->get_by_id('tr_container_trx',$get_data->container_rowID);
        
        $data['get_data'] = $get_data; 
        $data['address'] = $address; 
        $data['cargo'] = $get_cargo->item_name; 
        $data['container_type'] = $get_container->container_type; 
                
        // Log Printed
        $sql_printed = "UPDATE tr_jo_emkl_trx_do SET printed = printed+1, user_printed = ".$this->session->userdata('user_id').", date_printed = '".date('Y-m-d')."',
                        time_printed = '".date('H:i:s')."' WHERE do_no = '".$get_data->do_no."' AND deleted = 0";
        $this->db->query($sql_printed);

        $params['user_rowID'] = $this->tank_auth->get_user_id();
		$params['module'] = 'Container';
		$params['module_field_id'] = $get_data->rowID;
		$params['activity'] = ucfirst('Print a Delivery Order No. '.$get_data->do_no);
		$params['icon'] = 'fa-print';
		modules::run('activitylog/log',$params); //log activity	
        
        $this->load->view('do_print_pdf', $data);
        
        /*
        $html = $this->load->view('do_print_pdf', $data, true);

        $this->pdf_generator->generate($html, 'delivery order', $orientation = 'Portrait'); //Portrait
        */
    }

    function create()
    {
        $dataPost = $this->input->post();
        //echo "<pre>"; print_r($dataPost); echo "</pre>"; exit();
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $error = false;
        $result = true;
        $this->db->trans_begin();
        
        if (empty($dataPost['do_no'])) {
            $alloc_date = date('Y-m-d');
            
            $alloc_date_year = date('Y',strtotime($alloc_date));
            $alloc_date_month = date('m',strtotime($alloc_date));

            $sa_spec_prefix = 'SJ';
            $code_max = ((int)$this->appmodel->select_max_id('tr_jo_emkl_trx_do',$array = array('prefix'=>$sa_spec_prefix,'year' =>$alloc_date_year,
                                                    'month' =>$alloc_date_month, 'deleted' => 0),'code'))+1;
            $do_no = $sa_spec_prefix.sprintf("%04s",$alloc_date_year).sprintf("%02s",$alloc_date_month).sprintf("%05s",$code_max);
            
            $data_container = array(
                'prefix' => $sa_spec_prefix,
                'year' => $alloc_date_year,
                'month' => $alloc_date_month,
                'code' => $code_max,
                'revisi' => $dataPost['revisi'],
                'do_no' => $do_no,
                'jo_no' => $dataPost['jo_no'],
                'jo_detail_rowID' => $dataPost['jo_detail_rowID'],
                'container_rowID' => $dataPost['container_rowID'],
                'vehicle_rowID' => $dataPost['vehicle_rowID'],
                'from_rowID' => $dataPost['from_rowID'],
                'to_rowID' => $dataPost['to_rowID'],
                'container_no' => $dataPost['container_no'],
                'port_warehouse' => $dataPost['port_warehouse'],
                'vessel_name' => $dataPost['vessel_name'],
                'po_spk_no' => $dataPost['po_spk_no'],
                'sent_to' => $dataPost['sent_to'],
                'user_created' => $this->session->userdata('user_id'),
                'date_created' => date('Y-m-d'),
                'time_created' => date('H:i:s')
            );
            
            $result = $this->db->insert('tr_jo_emkl_trx_do', $data_container);
            if (!$result){
                $error = true;
            }
                
            Header('Content-Type: application/json; charset=UTF8');
            $status = $this->db->trans_status();
            if ($status === false || $error == true){
                $this->db->trans_rollback();
                
                $params['user_rowID'] = $this->tank_auth->get_user_id();
				$params['module'] = 'ERROR ROLLBACK Invoice';
				$params['module_field_id'] = 0;
				$params['activity'] = ucfirst('Deleted a Delivery Order with DO No '.$do_no);
				$params['icon'] = 'fa-exclamation-triangle';
				modules::run('activitylog/log',$params);
                
                echo json_encode(array('success' => false, 'msg' => "Failed Data RollBack"));
                exit();
            }
            else{
                $this->db->trans_commit();
                
                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'Container';
                $params['module_field_id'] = 0;
                $params['activity'] = ucfirst('Added a Print Delivery Order with DO No ' . $do_no);
                $params['icon'] = 'fa-plus';
                modules::run('activitylog/log', $params); //log activity

                echo json_encode(array("success" => true, 'do_no' => $do_no, 'msg' => lang('created_succesfully')));
                exit();
            }
        } 
        else {
            $get_data = $this->container_model->get_data_do_by_do_no($dataPost['do_no']);
            
            $this->db->set('deleted',1);
            $this->db->set('user_deleted',$this->session->userdata('user_id'));
            $this->db->set('date_deleted',date('Y-m-d'));
            $this->db->set('time_deleted',date('H:i:s'));
            $this->db->where('deleted', 0);
            $this->db->where('do_no', $dataPost['do_no']);
            $result = $this->db->update('tr_jo_emkl_trx_do');
            if ($result){
                $data_container = array(
                    'prefix' => $get_data->prefix,
                    'year' => $get_data->year,
                    'month' => $get_data->month,
                    'code' => $get_data->code,
                    'revisi' => $dataPost['revisi'],
                    'do_no' => $dataPost['do_no'],
                    'jo_no' => $dataPost['jo_no'],
                    'jo_detail_rowID' => $dataPost['jo_detail_rowID'],
                    'container_rowID' => $dataPost['container_rowID'],
                    'vehicle_rowID' => $dataPost['vehicle_rowID'],
                    'from_rowID' => $dataPost['from_rowID'],
                    'to_rowID' => $dataPost['to_rowID'],
                    'container_no' => $dataPost['container_no'],
                    'port_warehouse' => $dataPost['port_warehouse'],
                    'vessel_name' => $dataPost['vessel_name'],
                    'po_spk_no' => $dataPost['po_spk_no'],
                    'sent_to' => $dataPost['sent_to'],
                    'user_created' => $dataPost['user_created'],
                    'date_created' => $dataPost['date_created'],
                    'time_created' => $dataPost['time_created'],
                    'user_modified' => $this->session->userdata('user_id'),
                    'date_modified' => date('Y-m-d'),
                    'time_modified' => date('H:i:s')
                );
                
                $result = $this->db->insert('tr_jo_emkl_trx_do', $data_container);
                if (!$result){
                    $error = true;
                }
            }
            else{
                $error = true;
            }
                        
            Header('Content-Type: application/json; charset=UTF8');
            $status = $this->db->trans_status();
            if ($status === false || $error == true){
                $this->db->trans_rollback();
                
                $params['user_rowID'] = $this->tank_auth->get_user_id();
				$params['module'] = 'ERROR ROLLBACK Invoice';
				$params['module_field_id'] = 0;
				$params['activity'] = ucfirst('Deleted a Delivery Order with DO No '.$dataPost['do_no']);
				$params['icon'] = 'fa-exclamation-triangle';
				modules::run('activitylog/log',$params);
                
                echo json_encode(array('success' => false, 'msg' => "Failed Data RollBack"));
                exit();
            }
            else{
                $this->db->trans_commit();
                
                $params['user_rowID'] = $this->tank_auth->get_user_id();
                $params['module'] = 'Container';
                $params['module_field_id'] = 0;
                $params['activity'] = ucfirst('Updated a Delivery Order with DO No ' . $dataPost['do_no']);
                $params['icon'] = 'fa-edit';
                modules::run('activitylog/log', $params); //log activity

                echo json_encode(array("success" => true, 'do_no' => $dataPost['do_no'], 'msg' => lang('updated_succesfully')));
                exit();
            }
                    
        }

    }

    function fetch_data() { 
        if ($this->input->is_ajax_request()) {
            $dt = $_POST;

            if($this->session->userdata('start_date_container') == '' ){
                $start_date = date("Y-m-d", strtotime('-6 day'));
            }else{
                $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_container')));
            }

            if($this->session->userdata('end_date_container') == ''){
                $end_date = date("Y-m-d");
            }else{
                $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_container')));
            }
            $str_between = " AND tr_jo_emkl_trx_hdr.jo_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";
        
            $dt['table'] = 'tr_container_trx';
            $dt['id'] = 'rowID';
            $aColumnTable = array(
                'tr_container_trx.rowID',  'tr_jo_emkl_trx_hdr.jo_no', 'tr_jo_emkl_trx_hdr.jo_date', 'sa_debtor.debtor_cd', 'tr_container_trx.container_no', 'tr_container_trx.container_type', 'tr_container_trx.seal_no', 'tr_container_trx.replacement_seal_no', 'tr_container_trx.weight', 'sa_debtor.debtor_name'
            );

            $aColumns = array(
                'tr_container_trx.rowID',  'tr_jo_emkl_trx_hdr.jo_no', 'tr_jo_emkl_trx_hdr.jo_date', 'sa_debtor.debtor_cd', 'tr_container_trx.container_no', 'tr_container_trx.container_type', 'tr_container_trx.seal_no', 'tr_container_trx.replacement_seal_no', 'tr_container_trx.weight', 'sa_debtor.debtor_name'
            );

            $groupBy = '';

            /** Paging * */
            $sLimit = "";
            if (isset($dt['start']) && $dt['length'] != '-1') {
                $sLimit = " LIMIT " . intval($dt['start']) . ", " . intval($dt['length']);
            }

            /** Ordering * */
            $sOrder = " ORDER BY ";
            $sOrderIndex = $dt['order'][0]['column'];
            $sOrderDir = $dt['order'][0]['dir'];
            $bSortable_ = $dt['columns'][$sOrderIndex]['orderable'];
            if ($bSortable_ == "true") {
                $sOrder .= $aColumnTable[$sOrderIndex] . ($sOrderDir === 'asc' ? ' asc' : ' desc');
            } else {
                $sOrder .= "tr_container_trx.jo_no DESC, tr_container_trx.container_no ASC, tr_container_trx.container_type ASC";
            }

            /* Individual column filtering */
            $sSearchReg = $dt['search']['regex'];
            for ($i = 0; $i < count($aColumns); $i++) {
                $bSearchable_ = $dt['columns'][$i]['searchable'];
                if (isset($bSearchable_) && $bSearchable_ == "true" && $sSearchReg != 'false') {
                    $search_val = $dt['columns'][$i]['search']['value'];
                    if ($sWhere == "") {
                        $sWhere = " WHERE ";
                    } else {
                        $sWhere .= " AND ";
                    }
                    $sWhere .= $aColumns[$i] . " LIKE '%" . $this->db->escape_like_str($search_val) . "%' ";
                }
            }

            if (!empty($dt['columns'][9]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $start_date = date('Y-m-d', strtotime($dt['columns'][9]['search']['value']));
                $this->session->set_userdata('start_date_container',date("Y-m-d",strtotime($start_date)));

                if($this->session->userdata('end_date_container') == ''){
                    $end_date = date("Y-m-d");
                }else{
                    $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_container')));
                }
                $str_between = " AND tr_jo_emkl_trx_hdr.jo_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";

                $sWhere.= ' tr_container_trx.deleted = 0 AND tr_jo_emkl_trx_hdr.deleted = 0 ' . $str_between; 
            }

            if (!empty($dt['columns'][10]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $end_date = date('Y-m-d', strtotime($dt['columns'][10]['search']['value']));
                $this->session->set_userdata('end_date_container', date("Y-m-d",strtotime($end_date)));

                if($this->session->userdata('start_date_container') == ''){
                    $start_date = date("Y-m-d", strtotime('-6 day'));
                }else{
                    $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_container')));
                }
                $str_between = " AND tr_jo_emkl_trx_hdr.jo_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";
                
                $sWhere.= ' tr_container_trx.deleted = 0 AND tr_jo_emkl_trx_hdr.deleted = 0 ' . $str_between; 
            }

            /** Filtering * */
            $sWhere = "";
            $sSearchVal = $dt['search']['value'];
            if (isset($sSearchVal) && $sSearchVal != '') {
                $sWhere = " WHERE (";
                for ($i = 0; $i < count($aColumns); $i++) {
                    $sWhere .= $aColumns[$i] . " LIKE '%" . $this->db->escape_like_str($sSearchVal) . "%' OR ";

                }

                $mystring = '20 Feet, 20 feet';
                $pos = strpos($mystring, $sSearchVal);
                if ($pos !== false) {
                    $sWhere .= $aColumns[5] . " LIKE '%" . $this->db->escape_like_str('20ft') . "%' OR ";
                }

                $mystring_2 = '40 Feet, 40 feet';
                $pos_2 = strpos($mystring_2, $sSearchVal);
                if ($pos_2 !== false) {
                    $sWhere .= $aColumns[5] . " LIKE '%" . $this->db->escape_like_str('40ft') . "%' OR ";
                }

                $mystring_3 = '45 Feet, 45 feet';
                $pos_3 = strpos($mystring_3, $sSearchVal);
                if ($pos_3 !== false) {
                    $sWhere .= $aColumns[5] . " LIKE '%" . $this->db->escape_like_str('45ft') . "%' OR ";
                }

                $sWhere = substr_replace($sWhere, "", -3);
                $sWhere .= ') AND tr_container_trx.deleted = 0 AND tr_jo_emkl_trx_hdr.deleted = 0 ' . $str_between;
            }


            /** Total Data Set Length * */
            $sQuery = "SELECT * FROM " . $dt['table'] . " LEFT JOIN tr_jo_emkl_trx_hdr ON tr_jo_emkl_trx_hdr.jo_no = tr_container_trx.jo_no LEFT JOIN sa_debtor ON sa_debtor.rowID = tr_jo_emkl_trx_hdr.debtor_rowID WHERE tr_container_trx.deleted = 0 AND tr_jo_emkl_trx_hdr.deleted = 0 " . $str_between;
            $rResultTotal = $this->db->query($sQuery);
            $aResultTotal = $rResultTotal->num_rows();
            $iTotal = $aResultTotal;
            
            /* Get Data To Display */
            if ($sWhere != "") {
                $where = $sWhere;
            } else {
                $where = " WHERE tr_container_trx.deleted = 0 AND tr_jo_emkl_trx_hdr.deleted = 0 " . $str_between;
            }

            $join_table = " LEFT JOIN tr_jo_emkl_trx_hdr ON tr_jo_emkl_trx_hdr.jo_no = tr_container_trx.jo_no LEFT JOIN sa_debtor ON sa_debtor.rowID = tr_jo_emkl_trx_hdr.debtor_rowID ";

            $sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) .
                    " FROM " . $dt['table'] . $join_table . $where . $groupBy . $sOrder . $sLimit;
            $rResult = $this->db->query($sQuery);

            /* Data set length after filtering */
            $sQuery = "SELECT FOUND_ROWS() AS length_count";
            $rResultFilterTotal = $this->db->query($sQuery);
            $aResultFilterTotal = $rResultFilterTotal->row();
            $iFilteredTotal = $aResultFilterTotal->length_count;

            /** Output */
            $draw = $dt['draw'];
            $data = array();
            if (!empty($rResult)) {
                foreach ($rResult->result_array() as $aRow) {
                    $dt['start'] ++;
                    $row = array();

                    $dropdown_option = "";
                    $dropdown_option .= '<div class="btn-group">';
                    $dropdown_option .= '<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">';
                    $dropdown_option .= lang('options');
                    $dropdown_option .= '<span class="caret"></span>';
                    $dropdown_option .= '</button>';
                    $dropdown_option .= '<ul class="dropdown-menu">';
                    if($this->get_user_access('PrintLimited') == 1 || $this->get_user_access('PrintUnlimited') == 1 || $this->get_user_access('PrintOne') == 1 || $this->get_user_access('PrintTwo') == 1){
                        if($this->get_user_access('PrintLimited') == 1){
                            if($this->get_log_limited_printed($aRow['container_no'] ,'Container') == 0){
                                $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('print_option') . '" onclick="print_do_container(\'' . $aRow['rowID'] . '\')"><i class="fa fa-print"></i> ' . lang('print_option') . ' Delivery Order</a></li>';
                            }
                        } else{
                            $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('print_option') . '" onclick="print_do_container(\'' . $aRow['rowID'] . '\')"><i class="fa fa-print"></i> ' . lang('print_option') . ' Delivery Order</a></li>';
                        }
                    }
                    $dropdown_option .= '</ul></div>';
              
                    $row['dropdown_option'] = $dropdown_option;
                    $row['jo_no'] = $aRow['jo_no'];
                    $row['jo_date'] = date("d F Y",strtotime($aRow['jo_date']));
                    $row['debtor'] = $aRow['debtor_cd'] . ' - ' . $aRow['debtor_name'];
                    $row['container_no'] = $aRow['container_no'];
                    
                    $container_type = '-';
                    if($aRow['container_type'] == '20ft'){
                        $container_type = '20 Feet';
                    }elseif($aRow['container_type'] == '40ft'){
                        $container_type = '40 Feet';
                    }elseif($aRow['container_type'] == '45ft'){
                        $container_type = '45 Feet';
                    }
                    $row['container_type'] = $container_type;

                    $row['seal_no'] = $aRow['seal_no'];
                    $row['replacement_seal_no'] = $aRow['replacement_seal_no'];
                    $row['weight'] = number_format($aRow['weight'],0,',','.');

                    $row['start_date'] = $aRow['jo_date'];
                    $row['end_date'] = $aRow['jo_date'];
                    $data[] = $row;
                }
            }

            $output = array(
                "draw" => intval($draw),
                "recordsTotal" => $iTotal,
                "recordsFiltered" => $iFilteredTotal,
                "data" => $data
            );
            echo json_encode($output);
        } else {
            show_404();
        }
    }

    function get_user_access($field){
        $this->db->where('status','1');
        $this->db->where('Link_Menu', 'container');
        $query_menu = $this->db->get('sa_menu');        
        $get_menu = $query_menu->row();
        $menu_id = $get_menu->Seq_Menu;

        if($menu_id > 0){
            $this->db->where('user_rowID',$this->session->userdata('user_id'));
            $this->db->where('StatusUsermenu','1');
            $this->db->where('Kd_Menu',$menu_id);
            $query = $this->db->get('sa_usermenu');
            if ($query->num_rows() > 0){
                $row = $query->row();
                return $row->$field;
            } else{
                return 0;
            }
        } else{
           return 0;
        }
    }
    
    function get_log_limited_printed($trx_no,$module)
	{
        $sql = "SELECT * FROM activities 
                WHERE user_rowID = ".$this->session->userdata('user_id')." AND activity LIKE '%".$trx_no."%' AND module = '".$module."' 
                        AND icon = 'fa-print' AND deleted = 0";
        $query = $this->db->query($sql);
		if ($query->num_rows() > 0){
            return $query->num_rows();
		} else{
			return 0;
		}	   
    }
    
}

/* End of file contacts.php */
