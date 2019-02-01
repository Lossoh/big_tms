<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Tes extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
    }
 
    function index()
    {
        $this->load->module('layouts');
        $this->load->library('template');
        $this->template->title(lang('tire_brands') . ' - ' . $this->config->item('website_name') .
            ' ' . $this->config->item('version'));
        $data['page'] = lang('tire_brands');
        $this->session->set_userdata('page_header', 'master');
        $this->session->set_userdata('page_detail', 'tire_brand');
        $data['datatables'] = true;
        $data['form'] = true;
        
        $this->template->set_layout('users')->build('tes', isset($data) ? $data : null);
    }

}

/* End of file contacts.php */
