<?php
$file = 'doc/transp/'.$_REQUEST['pdf'];
$filename = $_REQUEST['pdf'];
  header('Content-type: application/pdf');
  header('Content-Disposition: inline; filename="' . $filename . '"');
  header('Content-Transfer-Encoding: binary');
  header('Accept-Ranges: bytes');
  @readfile($file); 
?>