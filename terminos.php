<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Terms and Conditions</title>
</head>

<body>
<?php
include("includes/configuracion.php");
$language = new Language();
$lang = $language->getLanguage(@$_POST['lang']);
$Idioma = $_SESSION['LANGUAGE'];
$db = new MySQL();
$sqlPageMeta = $db->consulta("SELECT * FROM `pages` WHERE `id`='9'");
$MetaTags = $db->fetch_array($sqlPageMeta);
$Terminos = $MetaTags['content'];
?>

<table border="0" width="350" bgcolor="#FFFFFF"><tr><td>
<div style="height:650px; overflow:auto;">
<?php echo $Terminos; ?>
</div>
</td></tr></table>

</body>
</html>
