<?php

require_once("../dompdf_config.inc.php");

if ( isset( $_GET['id'] ) ) {


  ob_start();
    include('displayresume.php');
    $file = ob_get_clean();
  $out1 = ob_get_contents();
  $dompdf = new DOMPDF();
  $dompdf->load_html($file);
  $dompdf->set_paper('A4', 'portrait');
  $dompdf->render();
  
  $res = $co->load_single_resume($_GET['id']);
  $filename = $res['first_name'].'_'.$res['last_name'].'_resume.pdf';

  $dompdf->stream($filename, array("Attachment" => true));

  exit(0);
}

?>