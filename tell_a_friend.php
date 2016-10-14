<?php
session_start();
include('includes/sesiones.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Costa Rica Raw :: Tell a Friend</title>
<style>
body
{
font-family: Arial, Helvetica, Sans-Serif;
  font-style: normal;
  font-weight: normal;
  font-size: 12px;
  color: #23250E;
 
 
 
  margin:0 0 0 0;

}

h1 a:hover
{
  text-decoration: none;
  font-family: Arial, Helvetica, Sans-Serif;
  font-style: normal;
  font-weight: bold;
  font-size: 28px;
  text-align: left;
}

a
{
	text-decoration: underline;
	color: #177D02;
	font-weight: bold;
}

a:link,
{
  text-decoration: underline;
  color: #666D27;
}

a:visited
{
	color: #177D02;
}

a:hover
{
	text-decoration: none;
	color: #688532;
}



h2, h2 a, h2 a:link, h2 a:visited, h2 a:hover
{
	margin: 0.8em 0;
	font-size: 20px;
	color: #666D27;
}



.TitulosBox
{
	
	font-size: 12px;
	color: #000;
	text-decoration: none;
}



.cleared
{
  float: none;
  clear: both;
  margin: 0;
  padding: 0;
  border: none;
  font-size: 1px;
}



.boton {

display:block;
color:#555555;
font-weight:bold;
height:30px;
text-decoration:none;
width:170px;
}



</style>

  <script type="text/javascript"> 
   <!-- 

function popUp(URL) {

day = new Date();

id = day.getTime();

eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=450');");

}
// -->
  </script> 
 
</head>

<body>
<?php

$Accion = $_REQUEST['accion'];

if($Accion==""){
?>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="35" align="center"><h2>Tell a Friend</h2></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="20"><h3>Step 1. Click Like Costa Rica Raw on Facebook</h3></td>
  </tr>
  <tr>
    <td align="center"><iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FCosta-Rica-Raw-Adventures%2F211720398846679&amp;send=false&amp;layout=button_count&amp;width=155&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=tahoma&amp;height=21&amp;appId=291291050931345" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:155px; height:21px;" allowTransparency="true"></iframe></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="20"><h3>Step 2. Complete this form</h3></td>
  </tr>
  <tr>
    <td><form action="tell_a_friend.php" method="post" enctype="multipart/form-data" id="tellafriend">
    <input type="hidden" name="accion" value="register" />
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
        <td>&nbsp;</td>
        <td width="3">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><p class="TitulosBox">Enter Your Facebook name:</p></td>
        <td>&nbsp;</td>
        <td><label for="name"></label>
          <input type="text" name="name" id="name" /></td>
      </tr>
      <tr>
        <td class="TitulosBox"><p>Enter Your Email:</p></td>
        <td>&nbsp;</td>
        <td><label for="email"></label>
          <input type="text" name="email" id="email" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center"><input name="continue" type="submit" class="boton" id="continue" value="Continue" /></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></form></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<?php
}
if($Accion=="register"){
include("includes/configuracion.php");
$db = new MySQL();


$insert = $db->consulta("INSERT INTO `affiliates` (`name`,`email`,`referral`,`top`,`counter`) VALUES('".$_POST['name']."','".$_POST['email']."','1','0','0')");

$kid = $db->getLastID();

$_SESSION['kid'] = $kid;
?>
<br><br><h3>Step 3. Share this Link</h3><br><br><center><h3>http://www.costaricaraw.com/dev/?kid=<?=$kid?></h3></center>

<center><input type="button" name="cerrar" value="Share" onclick="popUp('http://www.facebook.com/sharer/sharer.php?u=http://www.costaricaraw.com/dev/?kid=<?=$kid?>');" class="boton" /></center>
<script>


//window.open('http://www.facebook.com/sharer/sharer.php?u=http://www.costaricaraw.com/dev/?kid=<?=$kid?>');
</script>
<?
//http://www.facebook.com/sharer/sharer.php?u=

}
?>
</body>
</html>