<?php
$db = new MySQL();
$query = $db->consulta("SELECT * FROM `administrator` WHERE `id`='".$_SESSION['CRR_AUserID']."'");
$sql = $db->fetch_array($query);

if($sql['m6'] == '1'):




$act = $_REQUEST['act'];
$id = $_REQUEST['id'];
$db = new MySQL();
if ($act=="") {



?>
<form action="index.php?cmd=facilities&act=" method="post" name="categoria">
<br><table   border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
  <tr><td width="239" align="center" valign="top"><br />
<input name="act" type="submit" value="Add" class="boton"><br /><br /><input name="act" type="submit" value="Edit" class="boton"><br /><br /><input  name="act" type="submit" value="Remove" class="boton"></td>
  <td width="281" align="center" valign="top">
    <select name="id" size="10" multiple style="width:280px;">
<option selected disabled="disabled">--- Facilities ---</option>	
<?               
$sql = $db->consulta("SELECT * FROM `accommodation` ORDER By `name`");
while($Pages=$db->fetch_array($sql)){
?>
		  
 <option value="<?=$Pages['id']?>">
                <?=$Pages['name']?>
          </option>
<? }  ?>    
    
	
 

</select></td>
  </tr>
</table></form>
<?

}

///////////////////////EDITAR USUARIOS///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($act=="Edit") {

$query = $db->consulta("SELECT * FROM `accommodation` WHERE `id`='".$id."'");
$Page = $db->fetch_array($query);

?>

<form action="index.php?cmd=facilities" method="post" enctype="multipart/form-data">
<input type="hidden" value="<?=$Page['id']?>" name="id">
<input type="hidden" value="<?=$Page['icon']?>" name="actual">
<input type="hidden" value="update" name="act">
<table width="550"  border="0" align="center" cellpadding="1" cellspacing="0" class="main">
<tr>
<td height="35" colspan="2" align="center" ><h2>Edit Facilities</h2></td>
</tr><tr>
<td colspan="2" class="text"><strong> Name:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><input name="name" type="text" id="name" value="<?=$Page['name']?>" size="40" /></td>
  </tr>


<tr>
  <td colspan="2" class="text"><strong>Icon:</strong></td>
  </tr>
<tr>
  <td colspan="2" class="text"><label for="icono"></label>
    <input type="file" name="icono" id="icono"></td>
  </tr>
  <tr>
  <td colspan="2" class="text"><img src="../images/icons/<?=$Page['icon']?>" border="0" alt="<?=$Page['name']?>" title="<?=$Page['name']?>"></td>
  </tr>
  <tr>
    <td colspan="2" class="text">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="text">&nbsp;</td>
  </tr>

<tr align="center">
  <td height="35" class="standard"><input name="submit" type="submit" class="boton" value="Update">&nbsp;&nbsp;</td>
  <td class="standard"><input name="Cancelar" type="button" id="Cancelar" value="Cancel" onClick="self.location='index.php?cmd=facilities'" class="boton"/></td>
  </tr>
</table>

</form>
<?
}
//////////////UPDATE USUARIO/////////////////////////////////////////////////////////////////////////////
if ($act=="update"){

$name = $_POST['name'];
$icono = $_FILES['icono'];
$actual = $_POST['actual'];

if($icono==""){
	$imagen = $actual;
}else{
	if (move_uploaded_file($_FILES['icono']['tmp_name'], "../images/icons/".$_FILES['icono']['name']))
	{
		$imagen = $_FILES['icono']['name'];
	} 
	else
	{
		$imagen = $actual;
	}
}

        $update = $db->consulta("UPDATE `accommodation` SET `name`='".$name."',`icon`='".$imagen."' WHERE `id`='".$id."'");


?>

<script language="javascript">
<!--
       document.location='index.php?cmd=facilities';
//-->
</script>
<?
}

/////////////////Nuevo Usuario//////////////////////////////////////////////////////

if($act=="Add"){
	
?>


<form action="index.php?cmd=facilities&act=save" method="post" enctype="multipart/form-data">
<input name="act" value="save" type="hidden">
<table width="95%" border="0" align="center" cellpadding="1" cellspacing="0" class="main">
<tr>
          <td height="35" colspan="2" align="center" ><h2>New Facilities</h2></td>
</tr>
<tr>
          <td colspan="2" class="text"><strong>Name:</strong></td>
    </tr>
<tr>
  <td colspan="2" class="text"><input type="text" class="cajas" size="40" name="name" id="name" /></td>
  </tr>

     <tr>
  <td colspan="2" valign="top" class="text"><strong>Icon:</strong></td>
  </tr>
     <tr>
       <td colspan="2" valign="top" class="text"><label for="icono"></label>
    <input type="file" name="icono" id="icono"></td>
     </tr>
       <tr>
       <td colspan="2" valign="top" class="text">&nbsp;</td>
     </tr>
     <tr>
       <td colspan="2" valign="top" class="text">&nbsp;</td>
     </tr>

    <tr align="center">
      <td height="35" align="center" class="standard"><input type="submit" value="Save" class="boton"></td>
      <td height="35" align="center" class="standard"><input name="Cancelar2" type="button" id="Cancelar2" value="Cancel" onClick="self.location='index.php?cmd=facilities'" class="boton"/></td>
    </tr>
</table>

</form>
<?
}
///////////////CHECK Contacto/////////////////////////////////////
if($act=="save"){


$name = $_POST['name'];
$icono = $_FILES['icono'];
$actual = $_POST['actual'];

if($icono==""){
	$imagen = "blank.gif";
}else{
	if (move_uploaded_file($_FILES['icono']['tmp_name'], "../images/icons/".$_FILES['icono']['name']))
	{
		$imagen = $_FILES['icono']['name'];
	} 
	else
	{
		$imagen = "blank.gif";
	}
}

      $ejecutar =  $db->consulta("INSERT INTO `accommodation` (`name`,`icon`) VALUES ('".$name."','".$imagen."')");
		
	
        ?>
<script language="javascript">
                <!--
				       
                        document.location='index.php?cmd=facilities';
                //-->
                </script>
        <?
}



//////////////////BORRAR USUARIO/////////////////////
if($act=="Remove"){


$resp = $db->consulta("SELECT * FROM `accommodation` WHERE `id`='".$id."'");
$Page = $db->fetch_array($resp);

if (!IsSet($page)) {
        $page = "confirm";
}

if ($page == "confirm") {

?>
<center>
        <br><br>
<span class="titulos">This action remove Facilities <em><strong><? echo $Page['name']; ?></strong></em>.</span><br><font color="#FF0000"><em>You sure?</em></font><br>

<br>
<input name="SI" type="button" id="YES" value="  Yes  " onClick="self.location='index.php?cmd=facilities&act=Remove&page=Remove&id=<? echo $Page['id']; ?>'" class="boton"/>
&nbsp;&nbsp;&nbsp;
<input name="NO" type="button" id="NO" value="  No  " onClick="self.location='index.php?cmd=facilities'" class="boton"/></center>
<?


}
if ($page == "Remove") {

        $delete = $db->consulta("DELETE FROM `accommodation` WHERE `id`='".$id."'");
        ?>
<script language="javascript">
                <!--
                        document.location='index.php?cmd=facilities';
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