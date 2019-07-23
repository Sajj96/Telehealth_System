<?php
if(!defined('BASEPATH')) exit('No direct script access allowed_types');



use Dompdf\Dompdf;

//$doccument=new Dompdf();

class Pdf
{

     public function __construct()
     {
          //parent::__construct();
          require_once __DIR__ .'/dompdf/dompdf/autoload.inc.php';
          $pdf=new DOMPDF();
          $CI =& get_instance();
          $CI ->dompdf =$pdf;
     }

}

 ?>
