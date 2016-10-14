<?php
header("Expires: Sun 25 Jul 1994 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

session_start();

$cmd = $_REQUEST['cmd'];
if($_SESSION["time"]){
//include('../includes/sesiones.php');
}
include_once('configuracion.php');
include_once('../includes/funciones.php'); 




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
$puerto = $_SERVER['SERVER_PORT'];
if($puerto=="443"){ 

} else {
$url = 'https://datahasselhoff.com/admin/';
?>
<script language="javascript">
        <!--
       	document.location='<?=$url?>';
    	//-->
	</script>
<?
} 
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Costa Rica Raw Adventures :: Administrator</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/ui.dropdownchecklist.standalone.css" rel="stylesheet" type="text/css" />
<link href="../css/ui.dropdownchecklist.themeroller.css" rel="stylesheet" type="text/css" />
<script src="https://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAGpEWenySjkI7QuRAy1fXBxQkzy4TqPh3ekkIYHXP58pNEb2j7RT_tzNjR9zvevVhiOCYBmixufU9CA" type="text/javascript"></script>
<script src="../js/texten.js" type="text/javascript"></script>
<script src="../js/geo.js" type="text/javascript"></script>
<script  src="../js/jquery.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui.min.js" type="text/javascript"></script>
<script src="../js/ui.dropdownchecklist.js" type="text/javascript"></script>
</head>

<body onload="load();" onunload="GUnload();">
  <table width="905" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="150"><img src="../images/crra-header.jpg" width="900" height="150" alt="" /></td>
        </tr>
        </table>
        <table width="905" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td width="32" valign="top"><img src="../images/corner_top_left.png" width="32" height="48" alt="" /></td>
              <td width="154"><img src="../images/bgTopMenu.png" width="154" height="48" /></td>
              <td align="right" valign="bottom" style="background:url(../images/bgTopCenter.png) repeat-x;">&nbsp;</td>
              <td width="30" valign="top"><img src="../images/corner_top_right.png" width="30" height="48" alt="" /></td>
            </tr>
            <tr>
              <td height="400" style="background:url(../images/layer_left.png) repeat-y;">&nbsp;</td>
              <td valign="top" bgcolor="#B28955" class="MenuDiv"><div id="MenuDiv" >
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                
                  <tr>
                    <td valign="top"><?php 
					if($_SESSION['CRR_Admin']){
					include('modulos/menu.php'); 
					}
					?></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table>
              </div></td>
              <td valign="top" bgcolor="#F3CD9C" >
			  <?php
if($_SESSION['CRR_Admin']){			  
include_once('modulos/modulos.php');
}else{
?>
<form action="modulos/login.php" method="post" enctype="multipart/form-data" name="login" id="login">
              <input type="hidden" name="cmd" value="login" />
              <table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
                
                <tr>
                  <td align="left" valign="top"><table width="100%" height="10" border="0" align="center" cellpadding="0" cellspacing="8">
                    <tr>
                      <td width="165"><h3>Username</h3></td>
                    </tr>
                    <tr>
                      <td><input name="usuario" type="text" style="width:250px;" id="usuario" class="input_login"></td>
                    </tr>
                    <tr>
                      <td><h3>Password</h3></td>
                    </tr>
                    <tr>
                      <td><input name="clave" type="password" style="width:250px;" id="clave" class="input_login" autocomplete="off"></td>
                    </tr>
                    <tr>
                      <td align="center"><input type="submit" name="Submit" value="Login" class="boton"></td>
                    </tr>
                    
                  </table>
                  </td>
                </tr>
</table>
</form>
<?php

	}
?>
</td>
              <td style="background:url(../images/layer_right.png) repeat-y;">&nbsp;</td>
            </tr>
            <tr>
              <td valign="top"><img src="../images/corner_footer_left.png" width="32" height="72" alt="" /></td>
              <td colspan="2" align="center" valign="top" style="background:url(../images/bgFooter.old.png) repeat-x;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td align="center"><?php echo date('Y'); ?>&copy; Costa Rica Raw Adventures. Web Design JARS Costa Rica</td>
                </tr>
                </table></td>
              <td height="72" valign="top"><img src="../images/corner_footer_right.png" width="30" height="72" alt="" /></td>
            </tr>
          </table>

</body>
</html>