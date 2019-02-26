<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Reimburse extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('reimburse_model');
        $this->load->model('appmodel');
        $this->load->library('pdf_generator');
        $this->load->library('MoneyFormat');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('reimburses') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('reimburses');
        $this->session->set_userdata('page_header', 'transaction');
        $this->session->set_userdata('page_detail', 'reimburse');
        $data['datatables'] = true;
        $data['form'] = true;
        
        if($this->session->userdata('start_date_re') == '' ){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_re')));
        }

        if($this->session->userdata('end_date_re') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_re')));
        }

        // if($this->session->userdata('start_date_re') == '' && $this->session->userdata('end_date_re') == ''){
        //     $start_date = date("Y-m-d",strtotime("yesterday"));
        //     $end_date = date("Y-m-d");
        // }
        // else{
        //     $start_date = $this->session->userdata('start_date_re');
        //     $end_date = $this->session->userdata('end_date_re');
        // }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        
        $data['reimburses'] = $this->reimburse_model->get_all_record_data($start_date,$end_date);
        
        $data['advance_types'] = $this->reimburse_model->get_all_advance_type_data();
        $data['cash_advance_jo'] =$this->reimburse_model->get_data_cash_advance_jo();
        $data['job_order_emkls'] = $this->reimburse_model->get_data_cash_advance_jo_emkl($start_date,$end_date);

        $this->session->set_userdata('row','0');
        
        $this->template->set_layout('users')->build('reimburses', isset($data) ? $data : null);
    }
    
    function set_filter(){
       $this->session->set_userdata('start_date_re',date("Y-m-d",strtotime($this->input->post('start_date'))));
       $this->session->set_userdata('end_date_re',date("Y-m-d",strtotime($this->input->post('end_date'))));    
       
       redirect(base_url().'reimburse');
    }

    function get_data_expenses(){
        $advance_category_rowID = $this->input->post('advance_category_rowID');
        
        $expenses = $this->reimburse_model->get_all_records('sa_expense', $array =
            array('rowID >' => 0, 'deleted' => 0, 'advance_category_rowID' => $advance_category_rowID), $join_table = '', $join_criteria = '', 'rowID', 'desc');
        
        if (count($expenses) > 0) {
            foreach ($expenses as $rs) {
		      echo '<option value="'.$rs->rowID.'">'.$rs->expense_cd.' - '.$rs->descs.'</option>';
            }
        }
        else{
            echo '<option value="">No expense data</option>';
        }
        
        exit;
    }
    
    function get_data_advance_by_category(){
        
        $advance_category_rowID = $this->input->post('advance_category_rowID');
        
        $data_advances = $this->reimburse_model->get_all_advance_data_by_advance_category($advance_category_rowID);
        $data_html = '';

        $data_html .= '
            <table id="tbl-advance" class="table table-responsive table-striped" width="100%">
                <thead>
                  <tr>
					<th>'.lang('no').'</th>
					<th>'.lang('advance_number').'</th>
					<th>'.lang('date').'</th>
                    <th>'.lang('advance_type').'</th>
					<th>'.lang('debtor_name').'</th>
					<th>'.lang('dp_for_creditor').'</th>
					<th>'.lang('remark').'</th>
					<th>'.lang('amount').' (Rp)</th>
                    <th width="5%">#</th>
                  </tr> 
				</thead>
				<tbody>';

                    if (!empty($data_advances)) {
                        $i = 1;
                        foreach ($data_advances as $row) { 
                            $check_advance = $this->reimburse_model->get_advance_detail_by_advance_number($row->advance_number);
                            if(count($check_advance) == 0){
                                $creditor = $row->creditor_name == null ? '-' : $row->creditor_name;
                                $data_html .= '
                                    <tr>
                    					<td>'.$i++.'</td>
                    					<td>'.$row->advance_number.'</td>
                    					<td>'.date("d F Y",strtotime($row->advance_date)).'</td>
                    		            <td>'.ucwords(strtolower($row->advance_name)).'</td>
                    					<td>'.$row->debtor_cd.' - '.$row->debtor_name.'</td>
                    					<td>'.$creditor.'</td>
                    					<td><div style="width: 130px;">'.$row->remark.'</span></td>
                    					<td align="right">'.number_format($row->advance_total,0,',','.').'</td>
                                        <td>
                    					  <input type="checkbox" name="chk_adv[]" id="chk_adv_'.$row->advance_number.'" onclick="selectReimburseAdvance(\''.$row->advance_number.'\',\'chk_adv_'.$row->advance_number.'\')" value="1" style="width: 15px;" />
                    					</td>
                                    </tr>';
                            }
                        } 
                    }
                
        $data_html .= '
                </tbody>
            </table>';
        
        echo $data_html;        
        exit;
        
    }
    
    function get_data_advance_detail(){
        $advance_number = $this->input->post('advance_number');
        
        $advance_detail = $this->reimburse_model->get_all_advance_detail_by_advance_number($advance_number);
        $html = '';
        $i = 1;
        $baris = 1;
        $advance_total = 0;
         
        if (count($advance_detail) > 0) {
            foreach ($advance_detail as $row) {                
                $html .= '
                <tr class="rowAdv_'.$row->advance_number.'">';
            
                if($i == 1){
                    $baris = $this->session->userdata('row') + 1;
                    $this->session->set_userdata('row', $baris);
                    $advance_total = $row->advance_total;
                    
                    $html .= '<td>'.$row->advance_number.'</td>';
                }
                else{
                    $html .= '<td>'.$row->advance_number.'</td>';                    
                }
                
                $html .= '
                    <td>'.ucwords(strtolower($row->expense_name)).'</td>
                    <td>'.ucfirst(strtolower($row->descs)).'</td>
                    <td align="right">'.number_format($row->amount,0,',','.').'</td>
                </tr>
                ';
                
                $i++;
            }
        }
        
        $html .= '<tr class="rowAdv_'.$advance_number.'" style="border-bottom: 2px solid #aaa">
                    <td colspan="3" align="right">
                        <b>Advance Total</b>
                        <input type="hidden" name="advance_number_detail[]" id="advance_number_detail_'.$baris.'" value="'.$advance_number.'" />
                        <input type="hidden" name="amount_adv_detail[]" class="amount_adv_detail" id="amount_adv_detail_'.$baris.'" value="'.number_format($advance_total,0,',','.').'" />
                    </td>
                    <td align="right">
                        <b>'.number_format($advance_total,0,',','.').'</b>
                    </td>
                </tr>';
        
        $data['html']   = $html;
        $data['row']    = $baris;
        
        echo json_encode($data);
        
        exit;
    }        
    
    function get_data_reimburse_advance_detail(){
        $advance_number = $this->input->post('advance_number');
        $baris = $this->session->userdata('row');

        $advance_detail = $this->reimburse_model->get_all_advance_detail_by_advance_number($advance_number);
        $html = '';
        $i = 1;
        $advance_total = 0;
        
        if (count($advance_detail) > 0) {
            foreach ($advance_detail as $row) {                
                $advance_total = $row->advance_total;

                $html .= '
                <tr class="rowAdv_'.$row->advance_number.'">';            
                
                $html .= '
                    <td>'.$row->advance_number.'</td>
                    <td>'.ucwords(strtolower($row->expense_name)).'</td>
                    <td>'.ucfirst(strtolower($row->descs)).'</td>
                    <td align="right">'.number_format($row->amount,0,',','.').'</td>
                </tr>
                ';
                
                $i++;
            }
        }
        
        $html .= '<tr class="rowAdv_'.$advance_number.'" style="border-bottom: 2px solid #aaa">
                    <td colspan="3" align="right">
                        <b>Advance Total</b>
                        <input type="hidden" name="advance_number_detail[]" id="advance_number_detail_'.$baris.'" value="'.$advance_number.'" />
                        <input type="hidden" name="amount_adv_detail[]" class="amount_adv_detail" id="amount_adv_detail_'.$baris.'" value="'.number_format($advance_total,0,',','.').'" />
                    </td>
                    <td align="right">
                        <b>'.number_format($advance_total,0,',','.').'</b>
                    </td>
                </tr>';
        
        $data['html']   = $html;
        
        echo json_encode($data);
        
        exit;
    }     
    
    function get_data_edit($id)
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $get_data = $this->reimburse_model->get_by_id($id);
        
        if($get_data->jo_type_advance == 'jo_emkl'){
            $get_data = $this->reimburse_model->get_data_emkl_by_id($id);
        }
        
        $hasil = $get_data;
        
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function show_detail_reimburse()
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $reimburse_number = $this->input->get('reimburse_number');
        
        $hasil = $this->reimburse_model->get_detail_by_reimburse_number($reimburse_number);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function show_detail_reimburse_advance()
    {
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $reimburse_number = $this->input->get('reimburse_number');
        
        $hasil = $this->reimburse_model->get_advance_detail_by_reimburse_number($reimburse_number);
        Header('Content-Type: application/json; charset=UTF8');
        echo json_encode($hasil);
        exit;
    }
    
    function print_reimburse($row_id){
        $get_data = $this->reimburse_model->get_by_id($row_id);
        $get_data_detail = $this->reimburse_model->get_detail_by_reimburse_number($get_data->reimburse_number);
        $get_data_advance_detail = $this->reimburse_model->get_all_advance_detail_by_reimburse_number($get_data->reimburse_number);
        $data['get_data'] = $get_data;
        $data['get_data_detail'] = $get_data_detail;
        $data['get_data_advance_detail'] = $get_data_advance_detail;
         
        $sql_update = "UPDATE tr_reimburse_trx_hdr 
                        SET printed = printed + 1, user_printed = ".$this->session->userdata('user_rowID').",
                            date_printed = '".date('Y-m-d')."', time_printed = '".date('H:i:s')."'
                        WHERE reimburse_number = '".$get_data->reimburse_number."'";
        
        $this->db->query($sql_update);
        
        $params['user_rowID'] = $this->tank_auth->get_user_id();
		$params['module'] = 'Reimburse';
		$params['module_field_id'] = $get_data->rowID;
		$params['activity'] = ucfirst('Print a Reimburse No. '.$get_data->reimburse_number);
		$params['icon'] = 'fa-print';
		modules::run('activitylog/log',$params); //log activity	
        
        $html = $this->load->view('print_reimburse_pdf', $data, true);
        
        $this->pdf_generator->generate($html, 'Reimburse Pdf',$orientation='Portrait');    
    }
    
    function delete_data($id)
    {
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        $data = $this->reimburse_model->delete_data($tabel = 'tr_reimburse_trx_hdr', $id);
        header('Content-Type: application/json');
        
        $get_data = $this->reimburse_model->get_by_id($id);
        
        $params['user_rowID'] = $this->tank_auth->get_user_id();
        $params['module'] = 'reimburse';
        $params['module_field_id'] = $id;
        $params['activity'] = ucfirst('Deleted an reimburse No. ' . $get_data->reimburse_number);
        $params['icon'] = 'fa-trash-o';
        modules::run('activitylog/log', $params); //log activity
        
        echo json_encode($data);
        exit();
    }


    function create()
    {
        $dataPost = $this->input->post();
        //echo "<pre>";print_r($dataPost);echo "</pre>";exit();
        error_reporting(E_ALL);
        Header('Content-Type: application/json; charset=UTF8');
        $error = false;
        $this->db->trans_begin();
        
        $expense_id = $dataPost['expense_id'];
        $reimburse_desc = $dataPost['reimburse_desc'];
        $amount = $dataPost['amount'];
        $advance_number_detail = $dataPost['advance_number_detail'];
        $amount_adv_detail = $dataPost['amount_adv_detail'];
        
        if (empty($dataPost['rowID'])) {
            /*
            if(date('Y-m-d',strtotime($dataPost['date'])) != date('Y-m-d')){
                $alloc_date = date('Y-m-d');
            }
            else{
                $alloc_date = date('Y-m-d',strtotime($dataPost['date']));
            }
            */
            $alloc_date = date('Y-m-d',strtotime($dataPost['date']));
            
            $alloc_date_year = date('Y',strtotime($alloc_date));
            $alloc_date_month = date('m',strtotime($alloc_date));

            $sa_spec= $this->db->get_where('sa_spec', array('deleted' => 0,'rowID' => 1))->row_array();
            $sa_spec_prefix = $sa_spec['reimburse_prefix'];

            //$max_reimburse_id  = ((int)$this->reimburse_model->select_max_by_field('rowID'))+1;
            $max_reimburse_id = ((int)$this->appmodel->select_max_id('tr_reimburse_trx_hdr',$array = array('prefix'=>$sa_spec_prefix,'year' =>$alloc_date_year,'month' =>$alloc_date_month,'deleted' =>0),'code'))+1;
            $reimburse_number=$sa_spec_prefix.sprintf("%04s",$alloc_date_year).sprintf("%02s",$alloc_date_month).sprintf("%05s",$max_reimburse_id);
            
            $data_reimburse = array(
                'prefix' =>$sa_spec_prefix,
                'year'   =>$alloc_date_year,
                'month'  =>$alloc_date_month,
                'code'   =>$max_reimburse_id,
                'reimburse_number' => $reimburse_number,
                'reimburse_date' => $alloc_date,
                'jo_type_advance' => $dataPost['jo_type_advance'],
                'jo_no' => $dataPost['jo_no'],
                'advance_type_rowID' => $dataPost['advance_type_rowID'],
                'advance_total' => str_replace('.','',$dataPost['advance_total']),
                'reimburse_total' => str_replace('.','',$dataPost['reimburse_total']),
                'paid_total' => str_replace('.','',$dataPost['paid_total']),
                'remark' => ucfirst($dataPost['remark']),
                'user_created' => $this->session->userdata('user_id'),
                'date_created' => $alloc_date.' '.date('H:i:s')
            );
            
            $result = $this->db->insert('tr_reimburse_trx_hdr', $data_reimburse);
            if($result){
                if(count($expense_id) > 0){
                    for($i=0;$i<count($expense_id);$i++){
                        $data_reimburse_detail = array(
                            'reimburse_number' => $reimburse_number,
                            'expense_rowID' => $expense_id[$i],
                            'descs' => ucfirst(strtolower($reimburse_desc[$i])),
                            'amount' => str_replace('.','',$amount[$i]),
                            'user_created' => $this->session->userdata('user_id'),
                            'date_created' => $alloc_date.' '.date('H:i:s')
                        );
                        
                        $result_dtl = $this->db->insert('tr_reimburse_trx_dtl', $data_reimburse_detail);
                        
                    }
                }
            }
            else{
                $error = true;
            }            
            
            if($result_dtl){                            
                if(count($advance_number_detail) > 0){
                    for($i=0;$i<count($advance_number_detail);$i++){
                        $data_advance_detail = array(
                            'reimburse_number' => $reimburse_number,
                            'advance_number' => $advance_number_detail[$i],
                            'advance_total' => str_replace('.','',$amount_adv_detail[$i]),
                            'user_created' => $this->session->userdata('user_id'),
                            'date_created' => $alloc_date.' '.date('H:i:s')
                        );
                        
                        $result_adv_dtl = $this->db->insert('tr_reimburse_trx_adv_dtl', $data_advance_detail);
                        
                        if(!$result_adv_dtl){                                        
                            $error = true;
                            break;
                        }
                        
                    }
                }
            }
            else{
                $error = true;
            }
            
            Header('Content-Type: application/json; charset=UTF8');
            $status = $this->db->trans_status();
            if ($status === false || $error == true)
            {
                $this->db->trans_rollback();
                $params['user_rowID'] = $this->tank_auth->get_user_id();
				$params['module'] = 'ERROR ROLLBACK reimburse';
				$params['module_field_id'] = $max_reimburse_id;
				$params['activity'] = ucfirst('Deleted an reimburse No '.$reimburse_number);
				$params['icon'] = 'fa-exclamation-triangle';
				modules::run('activitylog/log',$params);
                echo json_encode(array('success' => false, 'msg' => " Failed Data RollBack"));
                exit();
            } 
            else
            {
                $this->db->trans_commit();
                $params['user_rowID'] = $this->tank_auth->get_user_id();
				$params['module'] = 'reimburse';
				$params['module_field_id'] = $max_reimburse_id;
				$params['activity'] = ucfirst('Add a New reimburse No '.$reimburse_number);
				$params['icon'] = 'fa-plus';
				modules::run('activitylog/log',$params); //log activity	
                
                $info = lang('created_succesfully').' No '.$reimburse_number;
                echo json_encode(array('success' => true, 'msg' => $info));
                exit();
            }
            
        } 
         
        else {
            $get_data = $this->reimburse_model->get_by_id($dataPost['rowID']);
            
            $reimburse_number = $get_data->reimburse_number;
            
            $alloc_date = date('Y-m-d',strtotime($dataPost['date']));            
            $alloc_date_year = date('Y',strtotime($alloc_date));
            $alloc_date_month = date('m',strtotime($alloc_date));

            $data_reimburse = array(
                'reimburse_number' => $reimburse_number,
                'reimburse_date' => $alloc_date,
                'jo_type_advance' => $dataPost['jo_type_advance'],
                'jo_no' => $dataPost['jo_no'],
                'advance_type_rowID' => $dataPost['advance_type_rowID'],
                'advance_total' => str_replace('.','',$dataPost['advance_total']),
                'reimburse_total' => str_replace('.','',$dataPost['reimburse_total']),
                'paid_total' => str_replace('.','',$dataPost['paid_total']),
                'remark' => ucfirst($dataPost['remark']),
                'user_modified' => $this->session->userdata('user_id'),
                'date_modified' => date('Y-m-d H:i:s'),
            );
           
            $this->db->where('rowID', $dataPost['rowID']);
            $result = $this->db->update('tr_reimburse_trx_hdr', $data_reimburse);
            if($result){
                if(count($expense_id) > 0){
                    // Update delete reimburse detail
                    $this->db->set('deleted', 1);
                    $this->db->set('user_deleted', $this->session->userdata('user_id'));
                    $this->db->set('date_deleted', date('Y-m-d H:i:s'));
                    $this->db->where('deleted', 0);
                    $this->db->where('reimburse_number', $reimburse_number);
                    $this->db->update('tr_reimburse_trx_dtl');
                    
                    for($i=0;$i<count($expense_id);$i++){
                        $data_reimburse_detail = array(
                            'reimburse_number' => $reimburse_number,
                            'expense_rowID' => $expense_id[$i],
                            'descs' => ucfirst(strtolower($reimburse_desc[$i])),
                            'amount' => str_replace('.','',$amount[$i]),
                            'user_created' => $this->session->userdata('user_id'),
                            'date_created' => date('Y-m-d H:i:s'),
                        );
                        
                        $result_dtl = $this->db->insert('tr_reimburse_trx_dtl', $data_reimburse_detail);
                                                
                    }
                }
            }
            else{
                $error = true;
            }           
            
            if($result_dtl){                            
                if(count($advance_number_detail) > 0){
                    // Update delete reimburse advance detail
                    $this->db->set('deleted', 1);
                    $this->db->set('user_deleted', $this->session->userdata('user_id'));
                    $this->db->set('date_deleted', date('Y-m-d H:i:s'));
                    $this->db->where('deleted', 0);
                    $this->db->where('reimburse_number', $reimburse_number);
                    $this->db->update('tr_reimburse_trx_adv_dtl');
                    
                    for($i=0;$i<count($advance_number_detail);$i++){
                        $data_advance_detail = array(
                            'reimburse_number' => $reimburse_number,
                            'advance_number' => $advance_number_detail[$i],
                            'advance_total' => str_replace('.','',$amount_adv_detail[$i]),
                            'user_created' => $this->session->userdata('user_id'),
                            'date_created' => date('Y-m-d H:i:s'),
                        );
                        
                        $result_adv_dtl = $this->db->insert('tr_reimburse_trx_adv_dtl', $data_advance_detail);
                        
                        if(!$result_adv_dtl){                                        
                            $error = true;
                            break;
                        }
                        
                    }
                }
            }
            else{
                $error = true;
            } 
            
            Header('Content-Type: application/json; charset=UTF8');
            $status = $this->db->trans_status();
            if ($status === false || $error == true)
            {
                $this->db->trans_rollback();
                $params['user_rowID'] = $this->tank_auth->get_user_id();
				$params['module'] = 'ERROR ROLLBACK reimburse';
				$params['module_field_id'] = $dataPost['rowID'];
				$params['activity'] = ucfirst('Deleted an reimburse No. '.$reimburse_number);
				$params['icon'] = 'fa-exclamation-triangle';
				modules::run('activitylog/log',$params);
                echo json_encode(array('success' => false, 'msg' => " Failed Data RollBack"));
                exit();
            } 
            else
            {
                $this->db->trans_commit();
                $params['user_rowID'] = $this->tank_auth->get_user_id();
				$params['module'] = 'reimburse';
				$params['module_field_id'] = $dataPost['rowID'];
				$params['activity'] = ucfirst('Updated an reimburse No. '.$reimburse_number);
				$params['icon'] = 'fa-edit';
				modules::run('activitylog/log',$params); //log activity	
                
                $info = lang('updated_succesfully').' No. '.$reimburse_number;
                echo json_encode(array('success' => true, 'msg' => $info));
                exit();
            }            
            
        }
        
        return $status;
            
    }
    
    function pdf()
    {
        if($this->session->userdata('start_date_re') == '' ){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_re')));
        }

        if($this->session->userdata('end_date_re') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_re')));
        }

        // if($this->session->userdata('start_date_re') == '' && $this->session->userdata('end_date_re') == ''){
        //     $start_date = date("Y-m-d",strtotime("yesterday"));
        //     $end_date = date("Y-m-d");
        // }
        // else{
        //     $start_date = $this->session->userdata('start_date_re');
        //     $end_date = $this->session->userdata('end_date_re');
        // }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['periode'] = date("d F Y",strtotime($start_date)).' - '.date("d F Y",strtotime($end_date));
                
        $data['reimburses'] = $this->reimburse_model->get_all_record_data($start_date,$end_date);
        
        $html = $this->load->view('reimburse_pdf', $data, true);
        $this->pdf_generator->generate($html, 'reimburse pdf',$orientation='Portrait');
    }
    
    function excel()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=reimburse.xls");
        
        if($this->session->userdata('start_date_re') == '' ){
            $start_date = date("Y-m-d", strtotime('-6 day'));
        }else{
            $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_re')));
        }

        if($this->session->userdata('end_date_re') == ''){
            $end_date = date("Y-m-d");
        }else{
            $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_re')));
        }

        // if($this->session->userdata('start_date_re') == '' && $this->session->userdata('end_date_re') == ''){
        //     $start_date = date("Y-m-d",strtotime("yesterday"));
        //     $end_date = date("Y-m-d");
        // }
        // else{
        //     $start_date = $this->session->userdata('start_date_re');
        //     $end_date = $this->session->userdata('end_date_re');
        // }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['periode'] = date("d F Y",strtotime($start_date)).' - '.date("d F Y",strtotime($end_date));
                
        $data['reimburses'] = $this->reimburse_model->get_all_record_data($start_date,$end_date);
        $this->load->view("reimburse_pdf", $data);

    }

    function fetch_data() { 
        if ($this->input->is_ajax_request()) {
            $dt = $_POST;

            if($this->session->userdata('start_date_re') == '' ){
                $start_date = date("Y-m-d", strtotime('-6 day'));
            }else{
                $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_re')));
            }

            if($this->session->userdata('end_date_re') == ''){
                $end_date = date("Y-m-d");
            }else{
                $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_re')));
            }
            $str_between = " AND tr_reimburse_trx_hdr.reimburse_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";
        
            $dt['table'] = 'tr_reimburse_trx_hdr';
            $dt['id'] = 'rowID';

            $aColumnTable = array(
                'tr_reimburse_trx_hdr.rowID', 'tr_reimburse_trx_hdr.reimburse_number', 'tr_reimburse_trx_hdr.reimburse_date', 'sa_advance_category.advance_name', 'tr_reimburse_trx_hdr.remark', 'tr_reimburse_trx_hdr.reimburse_total'
            );

            $aColumns = array(
                'tr_reimburse_trx_hdr.rowID', 'tr_reimburse_trx_hdr.reimburse_number', 'tr_reimburse_trx_hdr.reimburse_date', 'sa_advance_category.advance_name', 'tr_reimburse_trx_hdr.remark', 'tr_reimburse_trx_hdr.reimburse_total'
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
                $sOrder .= "tr_reimburse_trx_hdr.rowID DESC";
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

            if (!empty($dt['columns'][6]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $start_date = date('Y-m-d', strtotime($dt['columns'][6]['search']['value']));
                $this->session->set_userdata('start_date_re',date("Y-m-d",strtotime($start_date)));

                if($this->session->userdata('end_date_re') == ''){
                    $end_date = date("Y-m-d");
                }else{
                    $end_date = date("Y-m-d",strtotime($this->session->userdata('end_date_re')));
                }
                $str_between = " AND tr_reimburse_trx_hdr.reimburse_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";

                $sWhere.= ' tr_reimburse_trx_hdr.deleted = 0 ' . $str_between; 
            }

            if (!empty($dt['columns'][7]['search']['value'])) {
                if ($sWhere == "") {
                    $sWhere = " WHERE ";
                } else {
                    $sWhere .= " AND ";
                }

                $end_date = date('Y-m-d', strtotime($dt['columns'][7]['search']['value']));
                $this->session->set_userdata('end_date_re', date("Y-m-d",strtotime($end_date)));

                if($this->session->userdata('start_date_re') == ''){
                    $start_date = date("Y-m-d", strtotime('-6 day'));
                }else{
                    $start_date = date("Y-m-d",strtotime($this->session->userdata('start_date_re')));
                }
                $str_between = " AND tr_reimburse_trx_hdr.reimburse_date BETWEEN '" . $start_date . "' and '" . $end_date ."'";
                
                $sWhere.= ' tr_reimburse_trx_hdr.deleted = 0 ' . $str_between; 
            }

            /** Filtering * */
            $sWhere = "";
            $sSearchVal = $dt['search']['value'];
            if (isset($sSearchVal) && $sSearchVal != '') {
                $sWhere = " WHERE (";
                for ($i = 0; $i < count($aColumns); $i++) {
                    $sWhere .= $aColumns[$i] . " LIKE '%" . $this->db->escape_like_str($sSearchVal) . "%' OR ";

                }

                $sWhere = substr_replace($sWhere, "", -3);
                $sWhere .= ') AND tr_reimburse_trx_hdr.deleted = 0 ' . $str_between;
            } 

            /** Total Data Set Length * */
            $sQuery = 'SELECT * FROM ' . $dt['table'] . ' LEFT JOIN sa_advance_category ON sa_advance_category.rowID = tr_reimburse_trx_hdr.advance_type_rowID WHERE tr_reimburse_trx_hdr.deleted = 0 ' . $str_between;
            $rResultTotal = $this->db->query($sQuery);
            $aResultTotal = $rResultTotal->num_rows();
            $iTotal = $aResultTotal;
            
            /* Get Data To Display */
            if ($sWhere != "") {
                $where = $sWhere;
            } else {
                $where = " WHERE tr_reimburse_trx_hdr.deleted = 0 " . $str_between;
            }

            $join_table = ' LEFT JOIN sa_advance_category ON sa_advance_category.rowID = tr_reimburse_trx_hdr.advance_type_rowID ';

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
                            if($this->get_log_limited_printed($aRow['reimburse_number'],'Reimburse') == 0){
                                $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('print_option') .'" onclick="print_reimburse(\'' . $aRow['rowID'] . '\')"><i class="fa fa-print"></i> ' . lang('print_option') .'</a></li>';
                            }
                        }else{
                            $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('print_option') . '" onclick="print_reimburse(\'' . $aRow['rowID'] . '\')"><i class="fa fa-print"></i> ' . lang('print_option') . '</a></li>';
                        }
                     }
                            
                    if($this->get_user_access('Updated') == 1){
                        $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('update_option') . '" onclick="edit_reimburse(\'' . $aRow['rowID'] . '\')"><i class="fa fa-pencil"></i>  '. lang('update_option') . '</a></li>';
                    }
                    
                    if($this->get_user_access('Deleted') == 1){
                        $dropdown_option .= '<li><a  href="javascript:void()" title="' . lang('delete_option') . '" onclick="delete_reimburse(\'' . $aRow['rowID'] . '\')"><i class="fa fa-trash-o"></i> ' . lang('delete_option') . '</a></li>';
                    }
                    $dropdown_option .= '</ul></div>';
              
                    $row['dropdown_option'] = $dropdown_option;
                    $row['reimburse_number'] = $aRow['reimburse_number'];
                    $row['reimburse_date'] = date("d F Y",strtotime($aRow['reimburse_date']));
                    $row['advance_name'] = ucwords(strtolower($aRow['advance_name']));
                    $row['remark'] = $aRow['remark'];
                    $row['reimburse_total'] = number_format($aRow['reimburse_total'],0,',','.');

                    $row['start_date'] = $aRow['reimburse_date'];
                    $row['end_date'] = $aRow['reimburse_date'];
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
        $this->db->where('Link_Menu', 'reimburse');
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