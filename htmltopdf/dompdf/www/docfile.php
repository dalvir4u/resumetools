
<?php
$doc = new DOMDocument();
$doc->loadHTMLFile("resume.html");
$doc->save("resume.doc");
?>
