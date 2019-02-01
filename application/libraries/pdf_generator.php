<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class pdf_generator {
//ini_set("memory_limit", "32M");
    function generate($html, $filenaming,$orientation, $stream = TRUE) {
		if(!defined("DOMPDF_ENABLE_REMOTE")){
            define("DOMPDF_ENABLE_REMOTE", true);
        }
        if(!defined("DOMPDF_ENABLE_AUTOLOAD")){
            define("DOMPDF_ENABLE_AUTOLOAD", false);
        }
		ini_set('memory_limit','-1');
        require_once(APPPATH . "/dompdf/dompdf_config.inc.php");
        require_once(APPPATH . "dompdf/include/dompdf.cls.php");
        require_once(APPPATH . "dompdf/include/canvas.cls.php");
        spl_autoload_register('DOMPDF_autoload'); //Autoload Resource
        $dompdf = new DOMPDF(); //Instansiasi
        $dompdf->load_html($html); //Load HTML File untuk dirender
//      
        //$dompdf->set_paper("A4", "Portrait"); //setting the paper
        $dompdf->set_paper("A4", $orientation); //setting the paper Portrait atau landscape
        $dompdf->render(); //Proses Rendering File

        //$dompdf->get_page_number();
    

		  $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));

  	exit(0);

    }

}
?>
