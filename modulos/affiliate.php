<?php
$ip   = $_SERVER["REMOTE_ADDR"];
$refiere = $_SERVER['HTTP_REFERER'];
$fecha_hora = gmdate("Y-m-d, g:i:s", time() + $zone);
$navegador = $_SERVER["HTTP_USER_AGENT"];
$Afiliado = $_REQUEST['afid'];
$CuentaAfiliado = $db->consulta("SELECT * FROM `affiliates` WHERE `id`='".$Afiliado."'");
$Visitas=$db->fetch_array($CuentaAfiliado);
$Contador = $Visitas['counter'] + 1;
$ActualizarAfiliado = $db->consulta("UPDATE `affiliates` SET `counter`='".$Contador."' WHERE `id`='".$Afiliado."'");
$Log = $db->consulta("INSERT INTO `affiliates_log` (`ip`,`link`,`browser`,`dateTime`,`affiliates_id`) VALUES ('".$ip."','".$refiere."','".$navegador."','".$fecha_hora."','".$Afiliado."')");
$_SESSION['affiliateID'] = $Afiliado;
$_SESSION['affiliateName'] = $Visitas['name'];
$_SESSION['topAdventure'] = $Visitas['top'];
$_SESSION["time"] = time();
$_SESSION['affiliateHome'] = $Visitas['url'];

include('modulos/homes.php');
?>


