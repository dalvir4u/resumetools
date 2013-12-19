<?php
include('../config/config.inc.php');
include('../config/Database.class.php');
include('../classes/common.class.php');
$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
$co->connect();
require_once("dompdf/dompdf_config.inc.php");

// We check wether the user is accessing the demo locally
if ( isset( $_GET['id'] ) ) {
  
  ob_start();
    include('displayresume.php');
    $file = ob_get_clean();
  $dompdf = new DOMPDF();
  $dompdf->load_html_file($file);
  $dompdf->set_paper('A4', 'portrait');
  $dompdf->render();
  
  $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));

  exit(0);
}

?>
?>