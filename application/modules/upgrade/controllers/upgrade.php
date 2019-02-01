<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Upgrade extends MX_Controller {
 
    function __construct()
    {
        parent::__construct();

    }
    function index(){ 
        $this->load->dbforge();
        $config_field = array(
                        'key' => array(
                                        'name' => 'config_key',
                                        'type' => 'VARCHAR',
                                        'constraint' => '255',
                                       ),
                        );
        $this->dbforge->modify_column('config', $config_field);

        $this->db->where('config_key','version')->delete('config');       

        $sql = "INSERT INTO fx_config (config_key, value) VALUES ('invoice_logo', 'invoice.png')";
        if(!$this->db->query($sql)){
            redirect('');
        }else{
            redirect('');
            }
        }
}

/* End of file upgrade.php */