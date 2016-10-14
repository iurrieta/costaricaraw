<?php
$language = new Language();
$lang = $language->getLanguage(@$_POST['lang']);
$Idioma = $_SESSION['LANGUAGE'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd" >
<html>
<head>
<title><?php echo _APP_NAME;  ?></title>
<meta http-equiv="content-type" content="text/html;charset=iso-8859-2" />
<?php include_once('includes/metas.php'); ?>
<meta http-equiv="X-UA-Compatible" content="IE=8">
<link href="css/pagosglobales.css" rel="stylesheet" type="text/css" />
<script src="js/pg.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/global.css" type="text/css" />
<link rel="shortcut icon" href="favicon.ico">

</head>

<body>
