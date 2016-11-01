<?php
ini_set("session.cookie_lifetime","3600");
header("Expires: Sun 25 Jul 1994 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
session_start();
//if($_SESSION["time"]){
include('includes/sesiones.php');
//}
include("includes/configuracion.php");
$language = new Language();
$lang = $language->getLanguage(@$_POST['lang']);
$Idioma = $_SESSION['LANGUAGE'];
$db = new MySQL();
$cmd = $_REQUEST['cmd'];
$carro=$_SESSION['carro'];
$permalinks = explode("/",$_SERVER['REQUEST_URI']);
if($_REQUEST['kid']){
    $_SESSION['kid']=$_REQUEST['kid'];
    $ip   = $_SERVER["REMOTE_ADDR"];
    $refiere = $_SERVER['HTTP_REFERER'];
    $fecha_hora = gmdate("Y-m-d, g:i:s", time() + $zone);
    $navegador = $_SERVER["HTTP_USER_AGENT"];
    $kid = $_REQUEST['kid'];
    $CuentaAfiliado = $db->consulta("SELECT * FROM `affiliates` WHERE `id`='".$kid."'");
    $Visitas=$db->fetch_array($CuentaAfiliado);
    $Contador = $Visitas['counter'] + 1;
    $ActualizarAfiliado = $db->consulta("UPDATE `affiliates` SET `counter`='".$Contador."' WHERE `id`='".$Visitas['id']."'");
    $Log = $db->consulta("INSERT INTO `affiliates_log` (`ip`,`link`,`browser`,`dateTime`,`affiliates_id`) VALUES ('".$ip."','".$refiere."','".$navegador."','".$fecha_hora."','".$Visitas['id']."')");
}
//Este es el index.php donde se manerajá el Request
$permalinks = explode("/",$_SERVER['REQUEST_URI']);
if($permalinks[1]=="home"){
    $ip   = $_SERVER["REMOTE_ADDR"];
    $refiere = $_SERVER['HTTP_REFERER'];
    $fecha_hora = gmdate("Y-m-d, g:i:s", time() + $zone);
    $navegador = $_SERVER["HTTP_USER_AGENT"];
    $Afiliado = $_REQUEST['afid'];
    $CuentaAfiliado = $db->consulta("SELECT * FROM `affiliates` WHERE `contact`='".$permalinks[2]."'");
    $Visitas=$db->fetch_array($CuentaAfiliado);
    $Contador = $Visitas['counter'] + 1;
    $ActualizarAfiliado = $db->consulta("UPDATE `affiliates` SET `counter`='".$Contador."' WHERE `id`='".$Visitas['id']."'");
    $Log = $db->consulta("INSERT INTO `affiliates_log` (`ip`,`link`,`browser`,`dateTime`,`affiliates_id`) VALUES ('".$ip."','".$refiere."','".$navegador."','".$fecha_hora."','".$Visitas['id']."')");
    $_SESSION['affiliateID'] = $Visitas['id'];
    $_SESSION['affiliateName'] = $Visitas['name'];
    $_SESSION['topAdventure'] = $Visitas['top'];
    $_SESSION['time'] = time();
    $_SESSION['affiliateHome'] = $Visitas['url'];
    $_SESSION['affiliateLogo'] = $Visitas['logo'];
}
// Función para obtener la ip real del usuario
// Verifica si está en un proxy, ip compartido, etc
$idaff = $_REQUEST['idadffi'];
$idbanner = $_REQUEST['idbanner'];
$Url = $_REQUEST['url'];

if($idaff != "")
{
    $resp = $db->consulta("SELECT * FROM `affiliate_banner_counter` WHERE `idaffiliates` = '".$idaff."' and `idbanner` = '".$idbanner."'" );
    $Page = $db->fetch_array($resp);

    $resp1 = $db->consulta("SELECT `link` FROM `banner` WHERE `id` = '".$idbanner."'" );
    $Page1 = $db->fetch_array($resp1);
    if(!empty($Page))
    {
        $update = $db->consulta( "UPDATE `affiliate_banner_counter` SET `count` = (`count` + 1) WHERE `idaffiliates` = '".$idaff."' and `idbanner` = '".$idbanner."'");
    }
    else
    {
        $update = $db->consulta( "insert into `affiliate_banner_counter` (`idaffiliates`,`idbanner`,`count`) values ('".$idaff."', '".$idbanner."', 1)");

    }
    ?>
    <script> location.replace("<?php echo $Page1['link']?>"); </script>
    <?php
}
?>
<!DOCTYPE html>
<html lang="en"><!-- InstanceBegin template="/Templates/crraw.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="google-translate-customization" content="a519e97f3465566b-05182cbb86aa22ce-g1b10ff64d7660cc9-14"></meta>

    <?php include('includes/metas.php'); ?>
    <!-- InstanceBeginEditable name="doctitle" -->

    <meta name="viewport" content="width=device-width, height=device-height" />
    <meta name="viewport" content="user-scalable=yes" />
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="apple-mobile-web-app-capable" content="no">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>Costa Rica Raw Adventures</title>
    <link rel="icon" href="favicon.png" type="image/png" />
    <link rel="bookmark" href="favicon.ico" />
    <link rel="shortcut icon" href="favicon.ico" />

    <meta property="og:title" content="Costa Rica Raw Adventures" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://www.costaricaraw.com/dev/images/facebook_share_100.jpg" />
    <meta property="og:url" content="https://www.costaricaraw.com/dev/" />
    <meta property="og:description" content="Costa Rica Raw | Our trekking adventures are done with the bare essentials, just as the natives would have.. Two feet on the ground, and sometimes your hands & more in the dirt! Raw Adventures are designed for you to challenge yourself and allows you to choose when you have reached your limit. " />


    <?php

    $puerto = $_SERVER['SERVER_PORT'];
    if($puerto=="443"){
        ?>
        <base href="https://www.costaricaraw.com/dev/" />
        <?php
    } else {
        ?>
        <base href="http://www.costaricaraw.com/dev/" />
        <?
    }
    ?>
    <!-- InstanceEndEditable -->
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
    <script type="text/javascript" src="lib/jquery.js"></script>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <script  src="../js/jquery.min.js" type="text/javascript"></script>
    <script src="../js/jquery.bpopup.min.js" type="text/javascript"></script>


</head>

<body>
<div id="Principal">

    <div class="mainWrap">
        <div class="leftWrap">

            <table width="880" border="0" align="center" cellpadding="0" cellspacing="0" >
                <tr>
                    <td>

                        <table width="880" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td height="150" style="background-image: url('images/crra-header.jpg'); background-repeat: no-repeat; ">
                                    <div id="Content" style="position: absolute;">
                                        <div id="Compas"><div id="MapaLink" onClick="location.href='index.php?cmd=crmap'"></div></div>
                                        <div id="Slogan"><img src="images/slogan.png" border="0" alt="THE PATHS-PRESERVING THE FUTURE" title="THE PATHS-PRESERVING THE FUTURE" /></div>
                                    </div>
                                </td>
                                <td width="30">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td width="10">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="86%" height="50" align="right" valign="bottom" style="background:url(images/bgTop.png) no-repeat bottom left;"><form name="language" id="language" method="post">
                                                    <input type="hidden" name="lang" id="lang" />
                                                    <table border="0" cellspacing="2" cellpadding="2" style="margin-right:45px;">
                                                        <tr>
                                                            <td align="center"><strong><a href="https://www.costaricaraw.com/dev/index.php?cmd=cart" title="View Shopping Cart">Shopping Cart</a></strong> <a href="https://www.costaricaraw.com/dev/index.php?cmd=cart"><img src="images/cart.png" alt="View Shopping Cart" width="24" height="24" border="0" align="absmiddle" title="View Shopping Cart" /></a></td>
                                                            <td width="10">&nbsp;</td>
                                                            <td><!-- InstanceBeginEditable name="Traductor" -->&nbsp;
                                                                <!-- InstanceEndEditable --></td>
                                                        </tr>
                                                    </table>
                                                </form></td>
                                        </tr>
                                        <tr >
                                            <td height="400" style="background:url(images/bgBody.png) repeat-y left; height:100%">
                                                <table width="99%" border="0" align="right" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td width="505"><table width="98%" border="0" cellpadding="0" cellspacing="0" style="margin-left:10px;">
                                                                <tr>
                                                                    <td width="198" valign="top" class="MenuDiv"><div id="MenuDiv">
                                                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                <tr>
                                                                                    <td>&nbsp;</td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td>&nbsp;</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?php
                                                                                        include(_HTML_MENU);
                                                                                        ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>&nbsp;</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>&nbsp;</td>
                                                                                </tr>
                                                                            </table>


                                                                            <?php
                                                                            $puerto = $_SERVER['SERVER_PORT'];
                                                                            if($puerto=="443"){

                                                                            } else {
                                                                            ?>
                                                                        </div>
                                                                        <br />
                                                                        <!--div><strong><?php echo Translate($Idioma,"Weather");?></strong></div>
                          <iframe src="modulos/weather/index.php" width="150" height="100" scrolling="no" frameborder="0"></iframe-->
                                                                        <?
                                                                        }
                                                                        ?>

                                                                    </td>
                                                                    <!-- contenido derecho -->
                                                                    <td width="550" valign="top">
                                                                        <table width="98%" border="0" cellpadding="0" cellspacing="0">
                                                                            <tr><td><!-- InstanceBeginEditable name="WebContent" -->

                                                                                    <!-- mapa -->
                                                                                    <div id="custom-content" class="white-popup-block" style="max-width:600px; margin: 20px auto;">
                                                                                        <h2><?php echo $_REQUEST['name']; ?></h2>
                                                                                        <iframe src="map.php?lat=<?php echo $_GET['lat']; ?>&long=<?php echo $_GET['long']; ?>&name=<?php echo $_GET['name']; ?>&icon=<?php echo $_GET['icon'];?>&isbus=<?php echo $_GET['isbus'];?>" frameborder="0" scrolling="no" width="600" height="550"></iframe>
                                                                                    </div>
                                                                                    ​
                                                                                    <!-- InstanceEndEditable --></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table></td>
                                                    </tr>
                                                </table>              </td>
                                        </tr>
                                        <tr >
                                            <td width="850" height="72" valign="top" style="background:url(images/bgFooter.png) no-repeat left top;"><table width="92%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td>&nbsp;</td>

                                                    </tr>
                                                    <tr>
                                                        <td align="center"><?php include(_HTML_FOOTER); ?></td>
                                                    </tr>
                                                </table></td>
                                        </tr>
                                    </table></td>
                                <td width="10" valign="top">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td width="10">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td width="10">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td width="10">&nbsp;</td>
                            </tr>
                        </table></td></tr>
            </table>
        </div>

        <div class="rightWrap"><div class="smartBannerIdentifier"></div>
            <div class="banner">

                <?php include('modulos/banner.php'); ?>

            </div>
        </div>

    </div>


</div>

</body>
<!-- InstanceEnd --></html>
