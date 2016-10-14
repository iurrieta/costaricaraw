<?php
$db = new MySQL();
$query = $db->consulta("SELECT * FROM `administrator` WHERE `id`='".$_SESSION['CRR_AUserID']."'");
$sql = $db->fetch_array($query);

if($sql['m1'] == '1'):




$act = $_REQUEST['act'];
$id = $_REQUEST['id'];
$db = new MySQL();
?>
  <SCRIPT LANGUAGE="JavaScript">
<!-- 

function popUp(URL) {

day = new Date();

id = day.getTime();

eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=660,height=350');");

}
// -->
</script>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
function CambiarPass(){
		div = document.getElementById('ClaveNuevaTxt');
		div.style.display = 'block';
		div2 = document.getElementById('ClaveNueva');
		div2.style.display = 'block';	
}
function NoCambiar(){
		div = document.getElementById('ClaveNuevaTxt');
		div.style.display = 'none';
		div2 = document.getElementById('ClaveNueva');
		div2.style.display = 'none';	
}

</script>
<script type="text/javascript" src="funciones.js"></script>
<?php
        
if ($act=="") {



?>
<form action="index.php?cmd=usuarios&act=" method="post" name="categoria">
<br><table   border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
  <tr><td width="119" align="right" valign="top">
<input name="act" type="submit" value="Add" class="boton" style="width:180px;"><br /><br /><input name="act" type="submit" value="Edit" class="boton" style="width:180px;"> <br /><br /><input style="width:180px;"  name="act" type="submit" value="Remove" class="boton"></td>
    <td width="15" align="right" valign="top">&nbsp;</td>
  <td width="281" align="center" valign="top">
    <select name="id" size="10" multiple style="width:280px;">
<?php		              
$sql = $db->consulta("SELECT * FROM `administrator` ORDER By `id` ASC");
while($Pages=$db->fetch_array($sql)){
	
	if( $_SESSION['CRR_AUserID']=="1"){
	
	
?>
 <option value="<?=$Pages['id']?>">
               <?=$Pages['user']?> [<?=$Pages['email']?>]
          </option>

<?php	
	}else{
		?>
        
 <option value="<?=$Pages['id']?>" <?php if($Pages['id']==1){ echo "disabled"; } ?>>
               <?=$Pages['user']?> [<?=$Pages['email']?>]
          </option>        
        
        <?php
		
		
}

}  

?>    
    
	
 

</select></td>
  </tr>
</table></form>
<?

}

///////////////////////EDITAR USUARIOS///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($act=="Edit") {

$query = $db->consulta("SELECT * FROM `administrator` WHERE `id`='".$id."'");
$Page = $db->fetch_array($query);

?>

<form action="index.php?cmd=usuarios" method="post" enctype="multipart/form-data">
<input type="hidden" value="<?=$Page['id']?>" name="userID">
<input type="hidden" value="update" name="act">
<table width="550"  border="0" align="center" cellpadding="1" cellspacing="0" class="main">
<tr>
<td height="35" colspan="2" align="center" ><h2>Edit Administrator User</h2></td>
</tr>
<tr>
<td colspan="2" class="text"><strong>User:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><input name="usuario" type="text" id="usuario" value="<?=$Page['user']?>" size="40" disabled /></td>
  </tr>
 <tr>
      <td><div id="ClaveNuevaTxt" style="display:none;"><strong>New Password:</strong></div></td>
   </tr>
   <tr>
      <td><div id="ClaveNueva" style="display:none;">
      <input type="password" name="clave" id="clave" /></div></td>
    </tr>
    <tr>
      <td><strong>Change Password:</strong></td>
      </tr><tr>
      <td><input type="radio" name="ccambiar" value="1" id="ccambiar_0" onClick="CambiarPass();">Sí &nbsp;&nbsp;<input type="radio" name="ccambiar" id="ccambiar_1" value="0" checked onClick="NoCambiar();">No</td>
    </tr>



    <tr>
<td colspan="2" class="text"><strong>Email:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><input name="email" type="text" id="email" value="<?=$Page['email']?>" size="40" /></td>
  </tr>

    <!--    checkbox-->
    <tr>
        <td><input name="m1" type="checkbox" id="m1" value="1" <?php if($Page['m1']=="1"){ echo "checked"; } ?> /><strong>Administrators</strong></td>
    </tr>
    <tr>
        <td><input name="m2" type="checkbox" id="m2" value="1" <?php if($Page['m2']=="1"){ echo "checked"; } ?> /><strong>Categories</strong></td>
    </tr>
    <tr>
        <td><input name="m3" type="checkbox" id="m3" value="1" <?php if($Page['m3']=="1"){ echo "checked"; } ?> /><strong>Adventures</strong></td>
    </tr>
    <tr>
        <td><input name="m4" type="checkbox" id="m4" value="1" <?php if($Page['m4']=="1"){ echo "checked"; } ?> /><strong>Banner</strong></td>
    </tr>
    <tr>
        <td><input name="m5" type="checkbox" id="m5" value="1" <?php if($Page['m5']=="1"){ echo "checked"; } ?> /><strong>Gallery</strong></td>
    </tr>
    <tr>
        <td><input name="m6" type="checkbox" id="m6" value="1" <?php if($Page['m6']=="1"){ echo "checked"; } ?> /><strong>Facilities</strong></td>
    </tr>
    <tr>
        <td><input name="m7" type="checkbox" id="m7" value="1" <?php if($Page['m7']=="1"){ echo "checked"; } ?> /><strong>Locations</strong></td>
    </tr>
    <tr>
        <td><input name="m8" type="checkbox" id="m8" value="1" <?php if($Page['m8']=="1"){ echo "checked"; } ?> /><strong>Affiliates</strong></td>
    </tr>
    <tr>
        <td><input name="m9" type="checkbox" id="m9" value="1" <?php if($Page['m9']=="1"){ echo "checked"; } ?> /><strong>Reservations</strong></td>
    </tr>
    <tr>
        <td><input name="m10" type="checkbox" id="m10" value="1" <?php if($Page['m10']=="1"){ echo "checked"; } ?> /><strong>Sales Report</strong></td>
    </tr>
    <tr>
        <td><input name="m11" type="checkbox" id="m11" value="1" <?php if($Page['m11']=="1"){ echo "checked"; } ?> /><strong>Pages</strong></td>
    </tr>
    <tr>
        <td><input name="m12" type="checkbox" id="m12" value="1" <?php if($Page['m12']=="1"){ echo "checked"; } ?> /><strong>Bus Schedules</strong></td>
    </tr>
    <tr>
        <td><input name="m13" type="checkbox" id="m13" value="1" <?php if($Page['m13']=="1"){ echo "checked"; } ?> /><strong>Configure Site</strong></td>
    </tr>
    <!--    /checkbox-->



<!--  Status-->
 <tr>
       <td colspan="2" valign="top" class="text"><strong>Status:</strong></td>
     </tr>
     <tr>
       <td colspan="2" valign="top" class="text">         <strong>
        
           <input type="radio" name="status" value="1" id="status_0" <?php if($Page['status']=="1"){ echo "checked"; } ?> >
           Enabled
         &nbsp;&nbsp;
        
           <input type="radio" name="status" value="0" id="status_1" <?php if($Page['status']=="0"){ echo "checked"; } ?>>
           Disabled
           &nbsp;&nbsp;</strong></td>
     </tr>




 
  <tr>
    <td colspan="2" class="text">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="text">&nbsp;</td>
  </tr>

<tr align="center">
  <td height="35" class="standard"><input name="submit" type="submit" class="boton" value="Update"></td>
  <td class="standard"><input name="Cancelar" type="button" id="Cancelar" value="Cancel" onClick="self.location='index.php?cmd=usuarios'" class="boton"/></td>
  </tr>
<tr align="center">
  <td height="35" class="standard">&nbsp;</td>
  <td class="standard">&nbsp;</td>
</tr>
</table>

</form>
<?
}
//////////////UPDATE USUARIO/////////////////////////////////////////////////////////////////////////////
if ($act=="update"){

if($_POST['ccambiar']=="1"){
	
	$password = md5($_POST['clave']);
	$ExtraSQL  = ",`pass`='".$password."'";
	
}

    $m1 = (isset($_POST['m1']) && $_POST['m1'] == '1') ? $_POST['m1'] : '0';
    $m2 = (isset($_POST['m2']) && $_POST['m2'] == '1') ? $_POST['m2'] : '0';
    $m3 = (isset($_POST['m3']) && $_POST['m3'] == '1') ? $_POST['m3'] : '0';
    $m4 = (isset($_POST['m4']) && $_POST['m4'] == '1') ? $_POST['m4'] : '0';
    $m5 = (isset($_POST['m5']) && $_POST['m5'] == '1') ? $_POST['m5'] : '0';
    $m6 = (isset($_POST['m6']) && $_POST['m6'] == '1') ? $_POST['m6'] : '0';
    $m7 = (isset($_POST['m7']) && $_POST['m7'] == '1') ? $_POST['m7'] : '0';
    $m8 = (isset($_POST['m8']) && $_POST['m8'] == '1') ? $_POST['m8'] : '0';
    $m9 = (isset($_POST['m9']) && $_POST['m9'] == '1') ? $_POST['m9'] : '0';
    $m10 = (isset($_POST['m10']) && $_POST['m10'] == '1') ? $_POST['m10'] : '0';
    $m11 = (isset($_POST['m11']) && $_POST['m11'] == '1') ? $_POST['m11'] : '0';
    $m12 = (isset($_POST['m12']) && $_POST['m12'] == '1') ? $_POST['m12'] : '0';
    $m13 = (isset($_POST['m13']) && $_POST['m13'] == '1') ? $_POST['m13'] : '0';

    $sqlUpdate = "UPDATE `administrator` SET `email`='".$_POST['email']."',`status`='".$_POST['status']."',`m1`='".$m1."',`m2`='".$m2."',`m3`='".$m3."',`m4`='".$m4."',`m5`='".$m5."',`m6`='".$m6."',`m7`='".$m7."',`m8`='".$m8."',`m9`='".$m9."',`m10`='".$m10."',`m11`='".$m11."',`m12`='".$m12."',`m13`='".$m13."' $ExtraSQL WHERE `id`='".$_POST['userID']."'";
		
		$run = $db->consulta($sqlUpdate);
	 
?>

<script language="javascript">
<!--
       document.location='index.php?cmd=usuarios';
//-->
</script>
<?
}

/////////////////Nuevo Usuario//////////////////////////////////////////////////////

if($act=="Add"){
	

?>
<form action="index.php?cmd=usuarios&act=save" method="post" enctype="multipart/form-data">
<input name="act" value="save" type="hidden">
<table width="550"  border="0" align="center" cellpadding="1" cellspacing="0" class="main">
<tr>
<td height="35" colspan="2" align="center" ><h2>Add Administrator User</h2></td>
</tr>
<tr>
<td colspan="2" class="text"><strong>User:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><input name="usuario" type="text" id="usuario" size="40" /></td>
  </tr>
 <tr>
      <td><strong>Password:</strong></td>
   </tr>
   <tr>
      <td>
      <input type="password" name="clave" id="clave" size="40" /></td>
    </tr>
   


    <tr>
<td colspan="2" class="text"><strong>Email:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><input name="email" type="text" id="email" size="40" /></td>
  </tr>

<!--    checkbox-->
    <tr>
        <td><input name="m1" type="checkbox" id="m1" value="1" /><strong>Administrators</strong></td>
    </tr>
    <tr>
        <td><input name="m2" type="checkbox" id="m2" value="1" /><strong>Categories</strong></td>
    </tr>
    <tr>
        <td><input name="m3" type="checkbox" id="m3" value="1" /><strong>Adventures</strong></td>
    </tr>
    <tr>
        <td><input name="m4" type="checkbox" id="m4" value="1" /><strong>Banner</strong></td>
    </tr>
    <tr>
        <td><input name="m5" type="checkbox" id="m5" value="1" /><strong>Gallery</strong></td>
    </tr>
    <tr>
        <td><input name="m6" type="checkbox" id="m6" value="1" /><strong>Facilities</strong></td>
    </tr>
    <tr>
        <td><input name="m7" type="checkbox" id="m7" value="1" /><strong>Locations</strong></td>
    </tr>
    <tr>
        <td><input name="m8" type="checkbox" id="m8" value="1" /><strong>Affiliates</strong></td>
    </tr>
    <tr>
        <td><input name="m9" type="checkbox" id="m9" value="1" /><strong>Reservations</strong></td>
    </tr>
    <tr>
        <td><input name="m10" type="checkbox" id="m10" value="1" /><strong>Sales Report</strong></td>
    </tr>
    <tr>
        <td><input name="m11" type="checkbox" id="m11" value="1" /><strong>Pages</strong></td>
    </tr>
    <tr>
        <td><input name="m12" type="checkbox" id="m12" value="1" /><strong>Bus Schedules</strong></td>
    </tr>
    <tr>
        <td><input name="m13" type="checkbox" id="m13" value="1" /><strong>Configure Site</strong></td>
    </tr>
    <!--    /checkbox-->


 
  <tr>
    <td colspan="2" class="text">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="text">&nbsp;</td>
  </tr>

<tr align="center">
  <td height="35" class=""><input name="submit" type="submit" class="boton" value="Add"></td>
  <td class="standard"><input name="Cancelar" type="button" id="Cancelar" value="Cancel" onClick="self.location='index.php?cmd=usuarios'" class="boton"/></td>
  </tr>
<tr align="center">
  <td height="35" class="">&nbsp;</td>
  <td class="standard">&nbsp;</td>
</tr>
</table>

</form>
<?
}
///////////////CHECK Contacto/////////////////////////////////////
if($act=="save"){


    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    $email = $_POST['email'];
    $m1 = (isset($_POST['m1']) && $_POST['m1'] == '1') ? $_POST['m1'] : '0';
    $m2 = (isset($_POST['m2']) && $_POST['m2'] == '1') ? $_POST['m2'] : '0';
    $m3 = (isset($_POST['m3']) && $_POST['m3'] == '1') ? $_POST['m3'] : '0';
    $m4 = (isset($_POST['m4']) && $_POST['m4'] == '1') ? $_POST['m4'] : '0';
    $m5 = (isset($_POST['m5']) && $_POST['m5'] == '1') ? $_POST['m5'] : '0';
    $m6 = (isset($_POST['m6']) && $_POST['m6'] == '1') ? $_POST['m6'] : '0';
    $m7 = (isset($_POST['m7']) && $_POST['m7'] == '1') ? $_POST['m7'] : '0';
    $m8 = (isset($_POST['m8']) && $_POST['m8'] == '1') ? $_POST['m8'] : '0';
    $m9 = (isset($_POST['m9']) && $_POST['m9'] == '1') ? $_POST['m9'] : '0';
    $m10 = (isset($_POST['m10']) && $_POST['m10'] == '1') ? $_POST['m10'] : '0';
    $m11 = (isset($_POST['m11']) && $_POST['m11'] == '1') ? $_POST['m11'] : '0';
    $m12 = (isset($_POST['m12']) && $_POST['m12'] == '1') ? $_POST['m12'] : '0';
    $m13 = (isset($_POST['m13']) && $_POST['m13'] == '1') ? $_POST['m13'] : '0';


    $sqlReg = $db->consulta("INSERT INTO `administrator` (`user`,`pass`,`email`,`status`,`m1`,`m2`,`m3`,`m4`,`m5`,`m6`,`m7`,`m8`,`m9`,`m10`,`m11`,`m12`,`m13`) VALUES ('".$usuario."','".md5($clave)."','".$email."','1','".$m1."','".$m2."','".$m3."','".$m4."','".$m5."','".$m6."','".$m7."','".$m8."','".$m9."','".$m10."','".$m11."','".$m12."','".$m13."')");
	  
	
        ?>
<script language="javascript">
                <!--
				   document.location='index.php?cmd=usuarios';
                //-->
                </script>
        <?
}



//////////////////BORRAR USUARIO/////////////////////
if($act=="Remove"){

if($id==1){

echo "<script>alert('Can`t remove Primary Administrador user.');document.location='index.php';</script>";
	
}
$resp = $db->consulta("SELECT * FROM `administrator` WHERE `id`='".$id."'");
$Page = $db->fetch_array($resp);

if (!IsSet($page)) {
        $page = "confirm";
}

if ($page == "confirm") {

?>
<center>
        <br><br>
<span class="titulos">You are sure remove the user <em><strong><? echo $Page['user']; ?> [<? echo $Page['email']; ?>]</strong></em>?</span><br><br>

<br>
<input name="SI" type="button" id="YES" value="  Yes  " onClick="self.location='index.php?cmd=usuarios&act=Remove&page=Remove&id=<? echo $Page['id']; ?>'" class="boton"/>
&nbsp;&nbsp;&nbsp;
<input name="NO" type="button" id="NO" value="  No  " onClick="self.location='index.php?cmd=usuarios'" class="boton"/></center>
<?


}
if ($_REQUEST['page'] == "Remove") {

      
		$delete = $db->consulta("DELETE FROM `administrator` WHERE `id`='".$_REQUEST['id']."'");
		
        ?>
<script language="javascript">
                <!--
                        document.location='index.php?cmd=usuarios';
                //-->
                </script>
<?
}
}
?>
<?php endif;
$db = new MySQL();
$query = $db->consulta("SELECT * FROM `administrator` WHERE `id`='".$_SESSION['CRR_AUserID']."'");
$sql = $db->fetch_array($query);

?>
