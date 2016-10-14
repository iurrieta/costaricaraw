<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>How to convert PDF to JPEG in PHP | PGPGang.com</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <style type="text/css">
    
      img {border-width: 0}
      * {font-family:'Lucida Grande', sans-serif;}
    </style>
  </head>
  <body>
    
      <h2>How to convert PDF to JPEG in PHP Example.&nbsp;&nbsp;&nbsp;=> <a href="http://www.phpgang.com/">Home</a> | <a href="http://demo.phpgang.com/">More Demos</a></h2>
<?php
$imagick = new Imagick();
$imagick->readImage('uploads/trasn_19_document-1433958483.pdf');
$imagick->writeImage('uploads/trasn_19_document-1433958483.jpg');
?>
<img src='uploads/trasn_19_document-1433958483.jpg' title='Page-i' />
</body>
</html>