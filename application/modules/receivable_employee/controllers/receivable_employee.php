<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Receivable_employee extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('receivable_employee_model');
        $this->load->library('pdf_generator');
    }

    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('receivable_employees') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('receivable_employees');
        $this->session->set_userdata('page_header', 'reports');
        $this->session->set_userdata('page_detail', 'receivable_employee');
        $data['datatables'] = true;
        $data['form'] = true;
        
        $debtor = $this->receivable_employee_model->get_all_records('sa_debtor', $array =
            array('rowID >' => 0, 'deleted' => 0, 'type' => 'D'), $join_table = '', $join_criteria = '', 'debtor_name', 'asc');
        
        $data['debtor'] = $debtor;
        
        $this->template->set_layout('users')->build('receivable_employees', isset($data) ? $data : null);
    }
    
    function get_data_debtor(){
        $employee_type = $this->input->post('employee_type');
        
        $debtor = $this->receivable_employee_model->get_all_records('sa_debtor', $array =
            array('rowID >' => 0, 'deleted' => 0, 'type' => $employee_type), $join_table = '', $join_criteria = '', 'debtor_name', 'asc');
        
        echo '<option value="All">- All -</option>';
        if (!empty($debtor)) {
            foreach ($debtor as $rs) {
		      echo '<option value="'.$rs->rowID.'">'.$rs->debtor_cd.' - '.$rs->debtor_name.'</option>';
            }
        }
        
        exit;
    }
    
    function cetak_test()
    {
        error_reporting(E_ALL);
        $this->load->view('test');
    }
    
    function print_test(){

        error_reporting(E_ALL);
        require_once('system/shared/wkhtmltopdf.php');
        
        $pdf = new WkHtmlToPdf;
        $html = base_url()."receivable_employee/cetak_test";
        $pdf->addPage($html);
        
        if(!$pdf->send('./test.pdf')) 
            throw new Exception('Could not create PDF: '.$pdf->getError());
        else
            redirect(base_url().'receivable_employee');        

    }
    
    function print_report(){
        $debtor_id = $this->input->post('debtor_id');
        $employee_type = $this->input->post('employee_type');
        $until_date = date('Y-m-d',strtotime($this->input->post('until_date')));
        
        if($debtor_id == 'All'){
            $data_debtor = $this->receivable_employee_model->get_all_records('sa_debtor', $array =
                array('rowID >' => 0, 'deleted' => 0, 'type' => $employee_type), $join_table = '', $join_criteria = '', 'debtor_name', 'asc');
                    
            $data['until_date'] = $until_date;
            $data['str_until_date'] = date('d F Y',strtotime($until_date));
            $data['employee_type'] = $employee_type == 'D' ? 'Supir' : 'Karyawan';
            $data['data_debtor'] = $data_debtor;
            
            $html = $this->load->view('receivable_all_employee_pdf', $data, true);
            $this->pdf_generator->generate($html, 'all receivable pdf',$orientation='Portrait');
        }
        else if($debtor_id > 0){
            $debtor = $this->receivable_employee_model->get_debtor_by_id($debtor_id);
            
            $type = '-';
            if($debtor->type == 'C')
                $type = 'Perusahaan';
            else if($debtor->type == 'E')
                $type = 'Karyawan';
            else if($debtor->type == 'D')
                $type = 'Supir';
        
            $data['until_date'] = date('d F Y',strtotime($until_date));
            $data['debtor_cd'] = $debtor->debtor_cd;
            $data['debtor_name'] = $debtor->debtor_name;
            $data['type'] = $type;
            
            $data_cash_adv = $this->receivable_employee_model->get_data_cb_adv_by_debtor($debtor_id,$until_date);
            $data_addendum = $this->receivable_employee_model->get_data_addendum_by_debtor($debtor_id,$until_date);
            $data_realization = $this->receivable_employee_model->get_data_realization_by_debtor($debtor_id,$until_date);
            $data_refund = $this->receivable_employee_model->get_data_refund_by_debtor($debtor_id,$until_date);
            
            $table_name = 'temp_ar_report_'.$this->tank_auth->get_username().'_'.date('YmdHis');
            $sql = '
                CREATE TABLE '.$table_name.' (
                    rowID INT(6) AUTO_INCREMENT PRIMARY KEY,
                    tanggal date NOT NULL,
                    no_transaksi text NOT NULL,
                    keterangan text NOT NULL,
                    no_referensi text NOT NULL,
                    type_kas_bon text NOT NULL,
                    no_jo text NOT NULL,
                    amount double NOT NULL,
                    extra_amount double NOT NULL,
                    total_amount double NOT NULL,
                    addendum double NOT NULL,
                    realisasi double NOT NULL,
                    refund double NOT NULL
                ) 
            ';
            $query = $this->db->query($sql);
            
            if(count($data_cash_adv) > 0){
            	foreach($data_cash_adv as $row_ca){
            	   $total_amount = ($row_ca->advance_amount + $row_ca->advance_extra_amount);
                   
                   $data_tmp_ca = array(
                        'tanggal' => $row_ca->advance_date,
                        'no_transaksi' => $row_ca->advance_no,
                        'keterangan' => ucfirst(strtolower($row_ca->description)),
                        'no_referensi' => '-',
                        'type_kas_bon' => ucwords(strtolower($row_ca->advance_name)),
                        'no_jo' => '-',
                        'amount' => $row_ca->advance_amount,
                        'extra_amount' => $row_ca->advance_extra_amount,
                        'total_amount' => $total_amount,
                        'addendum'  => 0,
                        'realisasi' => 0,
                        'refund' => 0
                   );
                   
                   $this->db->insert($table_name, $data_tmp_ca);
                   
                }
            }
            
            if(count($data_realization) > 0){
            	foreach($data_realization as $row_rea){
                   $data_do_realization = $this->receivable_employee_model->get_data_do_realization_by_trx_no($row_rea->alloc_no);
                   $jo_no = "";
                   if(count($data_do_realization) > 0){
                        foreach($data_do_realization as $row_do){
                            $jo_no_tmp = $row_do->jo_no == '' ? '-' : $row_do->jo_no.', '; 
                            $jo_no .= $jo_no_tmp;
                        }
                   }
                   else{
                        $jo_no = "-";
                   }
                   
                   $data_tmp_rea = array(
                        'tanggal' => $row_rea->alloc_date,
                        'no_transaksi' => $row_rea->alloc_no,
                        'keterangan' => $row_rea->descs,
                        'no_referensi' => $row_rea->cb_cash_adv_no,
                        'type_kas_bon' => '-',
                        'no_jo' => $jo_no,
                        'amount' => 0,
                        'extra_amount' => 0,
                        'total_amount' => 0,
                        'addendum'  => 0,
                        'realisasi' => $row_rea->alloc_amt,
                        'refund' => 0
                   );
                   
                   $this->db->insert($table_name, $data_tmp_rea);
                   
               }
            }
            
            if(count($data_addendum) > 0){
            	foreach($data_addendum as $row_add){
                   
                   $data_tmp_add = array(
                        'tanggal' => $row_add->alloc_date,
                        'no_transaksi' => $row_add->alloc_no,
                        'keterangan' => $row_add->descs,
                        'no_referensi' => $row_add->cb_cash_adv_no,
                        'type_kas_bon' => '-',
                        'no_jo' => '-',
                        'amount' => 0,
                        'extra_amount' => 0,
                        'total_amount' => 0,
                        'addendum'  => $row_add->alloc_amt,
                        'realisasi' => 0,
                        'refund' => 0
                   );
                   
                   $this->db->insert($table_name, $data_tmp_add);
                   
               }
            }
            
            if(count($data_refund) > 0){
            	foreach($data_refund as $row_ref){
                   
                   $data_tmp_ref = array(
                        'tanggal' => $row_ref->alloc_date,
                        'no_transaksi' => $row_ref->alloc_no,
                        'keterangan' => $row_ref->descs,
                        'no_referensi' => $row_ref->cb_cash_adv_no,
                        'type_kas_bon' => '-',
                        'no_jo' => '-',
                        'amount' => 0,
                        'extra_amount' => 0,
                        'total_amount' => 0,
                        'addendum'  => 0,
                        'realisasi' => 0,
                        'refund' => $row_ref->alloc_amt
                   );
                   
                   $this->db->insert($table_name, $data_tmp_ref);

                }
            }
            
            $data_temp = $this->receivable_employee_model->get_all_data_temp($table_name);
            $data['data_temp'] = $data_temp;
            
            $sql_drop_table = 'DROP TABLE '.$table_name;
            $this->db->query($sql_drop_table);    

            $html = $this->load->view('receivable_employee_pdf', $data, true);
            $this->pdf_generator->generate($html, 'receivable employee/driver pdf',$orientation='Landscape');
        }
        else{
            redirect(base_url('receivable_employee'));
        }
        
    }
    
}

/* End of file contacts.php */
