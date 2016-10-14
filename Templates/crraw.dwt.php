<?php
session_start();
if($_SESSION["time"]){
include('includes/sesiones.php');
}
include("includes/configuracion.php");
$language = new Language();
$lang = $language->getLanguage(@$_POST['lang']);
$Idioma = $_SESSION['LANGUAGE'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, height=device-height" />
<meta name="viewport" content="user-scalable=yes" />
<meta name="viewport" content="width=480, height=800" />
<meta name="viewport" content="initial-scale=0.7, width=device-width, target-densitydpi=device-dpi" />
<?php include('includes/metas.php'); ?>
<!-- TemplateBeginEditable name="doctitle" -->
<title><?php echo _APP_NAME; ?></title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
<script type="text/javascript" src="../lib/jquery.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#apDiv1 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:10001;
	left: 1386px;
	top: 231px;
}
</style>
</head>

<body>
<div id="Principal">
  <table width="850" border="0" align="center" cellpadding="0" cellspacing="0" >
    <tr>
    <td>
  
      <table width="850" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="150" style="background-image: url('../images/crra-header.jpg'); background-repeat: no-repeat; ">
           <div id="Content" style="position: absolute;">
          <div id="Compas"><div id="MapaLink" onclick="location.href='index.php?cmd=crmap'"></div></div>
          <div id="Slogan"><img src="../images/slogan.png" border="0" alt="THE PATHS-PRESERVING THE FUTURE" title="THE PATHS-PRESERVING THE FUTURE" /></div>
          </div>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="86%" height="50" align="right" valign="bottom" style="background:url(../images/bgTop.png) no-repeat bottom left;"><form name="language" id="language" method="post">
                <input type="hidden" name="lang" id="lang" />
                <table border="0" cellspacing="2" cellpadding="2" style="margin-right:45px;">
                  <tr>
                    <td align="center"><strong><a href="index.php?cmd=cart" title="View Shopping Cart">Shopping Cart</a></strong> <a href="index.php?cmd=cart"><img src="images/cart.png" alt="View Shopping Cart" width="24" height="24" border="0" align="absmiddle" title="View Shopping Cart" /></a></td>
                    <td width="10">&nbsp;</td>
                    <td><a href="#" onclick="javascript:document.language.lang.value='ENGLISH';document.language.submit();" ><img src="../images/flags/ENGLISH.png" alt="English" width="24" height="24" border="0" title="English" /></a></td>
                    <td><a href="#" onclick="javascript:document.language.lang.value='SPANISH';document.language.submit();" ><img src="../images/flags/SPANISH.png" alt="Espa&ntilde;ol" width="24" height="24" border="0" title="Espa&ntilde;ol" /></a></td>
                    <td><a href="#" onclick="javascript:document.language.lang.value='FRENCH';document.language.submit();" ><img src="../images/flags/FRENCH.png" alt="Fran&ccedil;ais" width="24" height="24" border="0" title="Fran&ccedil;ais" /></a></td>
                    <td><a href="#" onclick="javascript:document.language.lang.value='PORTUGUESE';document.language.submit();" ><img src="../images/flags/PORTUGUESE.png" alt="Portugu&ecirc;s" width="24" height="24" border="0" title="Portugu&ecirc;s" /></a></td>
                    <td><a href="#" onclick="javascript:document.language.lang.value='GERMAN';document.language.submit();" ><img src="../images/flags/GERMAN.png" alt="Deutsche" width="24" height="24" border="0" title="Deutsche" /></a></td>
                    <td><a href="#" onclick="javascript:document.language.lang.value='DUTCH';document.language.submit();" ><img src="../images/flags/DUTCH.png" alt="Dutch" width="24" height="24" border="0" title="Dutch" /></a></td>
                    <td><a href="#" onclick="javascript:document.language.lang.value='CHINESE';document.language.submit();" ><img src="../images/flags/CHINESE.png" alt="Chinese" width="24" height="24" border="0" title="Chinese" /></a></td>
                    </tr>
                  </table>
              </form></td>
              </tr>
            <tr >
              <td height="400" style="background:url(../images/bgBody.png) repeat-y left; height:100%">
                <table width="99%" border="0" align="right" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="500"><table width="98%" border="0" cellpadding="0" cellspacing="0" style="margin-left:10px;">
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
                              <td><?php include(_HTML_MENU); ?></td>
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
                          <div><strong><?php echo Translate($Idioma,"Weather");?></strong></div>
  <iframe src="modulos/weather/index.php" width="150" height="100" scrolling="no" frameborder="0"></iframe>
  <?
} 
?>
                          
  </td>
                        <td width="550" valign="top">
                          <table width="98%" border="0" cellpadding="0" cellspacing="0">
                            <tr><td><!-- TemplateBeginEditable name="WebContent" -->WebContent<!-- TemplateEndEditable --></td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table></td>
                    </tr>
                </table>              </td>
              </tr>
            <tr >
              <td width="740" height="72" valign="top" style="background:url(../images/bgFooter.png) no-repeat left top;"><table width="92%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td>&nbsp;</td>
                  </tr>
                <tr>
                  <td align="center"><?php include(_HTML_FOOTER); ?></td>
                  </tr>
              </table></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
    </table></td></tr>
  </table>
  
</div>
</body>
</html>
