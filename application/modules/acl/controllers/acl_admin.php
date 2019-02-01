<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Acl_admin extends MY_Controller{

    public function __construct() {
        parent::__construct();

        if( ! $this->_check_admin_credentials())
        {
            redirect('auth/login');
        }

    }

    public function _check_admin_credentials(){
        return (bool)( 
            $this->_can_read()
            AND $this->_can_edit()
            AND $this->_can_delete()
            AND $this->group === 'admin'
        );
    }