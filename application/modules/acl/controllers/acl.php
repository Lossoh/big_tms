<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class some_module extends MY_Controller{

    public function __construct(){
           parent::__construct();
    }

    public function module_method(){
        if($this->group === 'AUTHOR' AND $this->can_edit())
        {
            // you have access to edit this modules's content
        }
    }
}