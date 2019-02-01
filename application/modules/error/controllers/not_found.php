<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Not_found extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
    }
    function index()
    {
        $this->load->view('not_found');
    }

}

/* End of file not_found.php */
