<?php
$db = new MySQL();
$query = $db->consulta("SELECT * FROM `administrator` WHERE `id`='".$_SESSION['CRR_AUserID']."'");
$sql = $db->fetch_array($query);

if($sql['m5'] == '1'):




$act = $_REQUEST['act'];
$id = $_REQUEST['id'];
$db = new MySQL();

if ($act=="") {



?>
<form action="index.php?cmd=gallery&act=" method="post" name="categoria">
<br><table   border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
  <tr><td width="239" align="center" valign="top"><br />
<input name="act" type="submit" value="Add" class="boton"><br /><br /><input name="act" type="submit" value="Edit" class="boton"><br /><br /><input  name="act" type="submit" value="Remove" class="boton"><!--br /><br /><input  name="act" type="submit" value="Activate" class="boton"--></td>
  <td width="281" align="center" valign="top">
    <select name="id" size="10" multiple style="width:320px;">
<option disabled="disabled">--- Media ---</option>	
<?               
$sql = $db->consulta("SELECT * FROM `gallery` ORDER By `status`,`description` ASC");
while($Pages=$db->fetch_array($sql)){
	
	if($Pages['type']=="1"){
		$Tipo = "Video";
	}
	if($Pages['type']=="2"){
		$Tipo = "Picture";
	}
	if($Pages['status']=="1"){
		$pendiente = "[PENDING]";
	}
?>
		  
 <option value="<?=$Pages['id']?>">
              <?=$Pages['description']?> 
          </option>
<?
$pendiente = ""; 
$Tipo="";
}  
?> 
  
    
	
 

</select></td>
  </tr>
</table></form>
<?

}

///////////////////////EDITAR ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($act=="Edit") {

$query = $db->consulta("SELECT * FROM `gallery` WHERE `id`='".$id."'");
$Page = $db->fetch_array($query);

?>

<form action="index.php?cmd=gallery" method="post" enctype="multipart/form-data">
<input type="hidden" value="<?=$Page['id']?>" name="id">
<input type="hidden" value="update" name="act">
<table width="550"  border="0" align="center" cellpadding="1" cellspacing="0" class="main">
<tr>
<td height="35" colspan="2" align="center" ><h2>Edit Media</h2></td>
</tr><tr>
<td colspan="2" class="text"><strong>Description:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><input name="description" type="text" id="description" value="<?=$Page['description']?>" size="40" /></td>
  </tr>
<!--tr>
  <td colspan="2" class="text">
    <label>
      <input type="radio" name="type" value="1" id="type_0" <?php if($Page['type']==1) { echo "checked"; }?> />
      Video</label>
&nbsp;&nbsp;&nbsp;    <label>
      <input type="radio" name="type" value="2" id="type_1" <?php if($Page['type']==2) { echo "checked"; }?>/>
      Picture</label>
  </td>
</tr>
<tr>
  <td colspan="2" class="text"><strong>Youtube Link:</strong></td>
  </tr>
<tr>
  <td colspan="2" class="text"><input name="video" type="text" id="video" value="<?=$Page['video']?>" size="40"></td>
  </tr-->

    <tr>
       <td colspan="2" valign="top" class="text"><strong>Picture:</strong></td>
     </tr>
     <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto1" id="foto1"></td>
     </tr>
     <tr>
       <td colspan="2" valign="top" class="text"><strong>Order Show:</strong></td>
     </tr>
     <tr>
       <td colspan="2" valign="top" class="text"><input name="order" type="text" id="order" value="<?=$Page['order']?>" size="5" /></td>
     </tr>
  <tr>
    <td colspan="2" class="text"><img src="../images/gallery/small_<?=$Page['img']?>" height="150" /></td>
  </tr>  
    <tr>
    <td colspan="2" class="text"><a href="modulos/resizeG.php?picture=<?=$Page['img']?>" target="_new">Resize Picture</a></td>
  </tr>     
   
  <tr>
    <td colspan="2" class="text">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="text">&nbsp;</td>
  </tr>

<tr align="center">
  <td height="35" class="standard"><input name="submit" type="submit" class="boton" value="Update">&nbsp;&nbsp;</td>
  <td class="standard"><input name="Cancelar" type="button" id="Cancelar" value="Cancel" onClick="self.location='index.php?cmd=gallery'" class="boton"/></td>
  </tr>
</table>

</form>
<?
}
//////////////UPDATE USUARIO/////////////////////////////////////////////////////////////////////////////
if ($act=="update"){

$description = str_replace("'", "&acute;", $_POST['description']);
$type = $_POST['type'];
$video = $_POST['video'];
$order = $_POST['order'];

include('images.php');
$image = new SimpleImage();
  

if($_FILES['foto1']==""){
	
}else{
	$extension = encontrar_extension($_FILES['foto1']['name']);
	if (move_uploaded_file($_FILES['foto1']['tmp_name'], "../images/gallery/pic_".$id."_gallery.".$extension))
	{
		
		$foto1 = "pic_".$id."_gallery.".$extension;
		$update = $db->consulta("UPDATE `gallery` SET `img`='".$foto1."' WHERE `id`='".$id."'");
		$image->load('../images/gallery/'.$foto1);
		$image->resize(540,350);
		$image->save('../images/gallery/medium_'.$foto1);
		$image->resizeToHeight(200);
		$image->save('../images/gallery/small_'.$foto1);
	} 
}
	 
	 
        $update = $db->consulta("UPDATE `gallery` SET `description`='".$description."',`type`='".$type."',`video`='".$video."',`status`='2',`order`='".$order."' WHERE `id`='".$id."'");
	 
	

?>

<script language="javascript">
<!--
       document.location='index.php?cmd=gallery';
//-->
</script>
<?
}

/////////////////Nuevo Usuario//////////////////////////////////////////////////////

if($act=="Add"){
	
?>


<form action="index.php?cmd=gallery&act=save" method="post" enctype="multipart/form-data">
<input name="act" value="save" type="hidden">
<input type="hidden" name="type" value="2" />
<table width="95%" border="0" align="center" cellpadding="1" cellspacing="0" class="main">
<tr>
          <td height="35" colspan="2" align="center" ><h2>New Media</h2></td>
</tr>
<tr>
          <td colspan="2" class="text"><strong>Description:</strong></td>
    </tr>
<tr>
  <td colspan="2" class="text"><input type="text" class="cajas" size="40" name="description" id="description" /></td>
  </tr>
<!--tr>
  <td colspan="2" class="text">
    <label>
      <input type="radio" name="type" value="1" id="type_0" />
      Video</label>
&nbsp;&nbsp;&nbsp;    <label>
      <input name="type" type="radio" id="type_1" value="2" checked="checked" />
      Picture</label>
  </td>
</tr>
<tr>
  <td colspan="2" class="text"><strong>Youtube Link:</strong></td>
  </tr>
<tr>
  <td colspan="2" class="text"><input name="video" type="text" id="video" value="" size="40"></td>
  </tr-->

    <tr>
       <td colspan="2" valign="top" class="text"><strong>Picture:</strong></td>
     </tr>
     <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto1" id="foto1"></td>
     </tr>
     <tr>
       <td colspan="2" valign="top" class="text"><strong>Order Show:</strong></td>
     </tr>
     <tr>
       <td colspan="2" valign="top" class="text"><input name="order" type="text" id="order" value="1" size="5" /></td>
     </tr>
     <tr>
       <td colspan="2" valign="top" class="text">&nbsp;</td>
     </tr>
     <tr>
       <td colspan="2" valign="top" class="text">&nbsp;</td>
     </tr>

    <tr align="center">
      <td height="35" align="center" class="standard"><input type="submit" value=" Save" class="boton"></td>
      <td height="35" align="center" class="standard"><input name="Cancelar2" type="button" id="Cancelar2" value="Cancel" onClick="self.location='index.php?cmd=gallery'" class="boton"/></td>
    </tr>
</table>

</form>
<?
}
///////////////CHECK Contacto/////////////////////////////////////
if($act=="save"){


$description = str_replace("'", "&acute;", $_POST['description']);
$video = $_POST['video'];
$type = $_POST['type'];
$order = $_POST['order'];

include('images.php');
$image = new SimpleImage();

      $ejecutar =  $db->consulta("INSERT INTO `gallery` (`description`,`video`,`type`,`status`,`order`) VALUES ('".$description."','".$video."','".$type."','2','".$order."')");
	  $adventureID = $db->getLastID($ejecutar);
	  
if($_FILES['foto1']==""){
	
}else{
	$extension = encontrar_extension($_FILES['foto1']['name']);
	if (move_uploaded_file($_FILES['foto1']['tmp_name'], "../images/gallery/pic_".$adventureID."_adventure.".$extension))
	{
		
		$foto1 = "pic_".$adventureID."_adventure.".$extension;
		$update = $db->consulta("UPDATE `gallery` SET `img`='".$foto1."' WHERE `id`='".$adventureID."'");
		$image->load('../images/gallery/'.$foto1);
		$image->resize(600,354);
		$image->save('../images/gallery/medium_'.$foto1);
		$image->resizeToHeight(200);
		$image->save('../images/gallery/small_'.$foto1);
	} 
}
		
	
        ?>
<script language="javascript">
                <!--
				   document.location='index.php?cmd=gallery';
                //-->
                </script>
        <?
}



//////////////////BORRAR USUARIO/////////////////////
if($act=="Remove"){


$resp = $db->consulta("SELECT * FROM `gallery` WHERE `id`='".$id."'");
$Page = $db->fetch_array($resp);

if (!IsSet($page)) {
        $page = "confirm";
}

if ($page == "confirm") {

?>
<center>
        <br><br>
<span class="titulos">This action remove Media <em><strong><? echo $Page['description']; ?></strong></em>.</span><br><font color="#FF0000"><em>You sure?</em></font><br>

<br>
<input name="SI" type="button" id="YES" value="  Yes  " onClick="self.location='index.php?cmd=gallery&act=Remove&page=Remove&id=<? echo $Page['id']; ?>'" class="boton"/>
&nbsp;&nbsp;&nbsp;
<input name="NO" type="button" id="NO" value="  No  " onClick="self.location='index.php?cmd=gallery'" class="boton"/></center>
<?


}
if ($page == "Remove") {

        $resp = $db->consulta("SELECT * FROM `gallery` WHERE `id`='".$id."'");
		$Pictures = $db->fetch_array($resp);
		@unlink('../images/gallery/'.$Pictures['img']);
		@unlink('../images/gallery/medium_'.$Pictures['img']);
		@unlink('../images/gallery/small_'.$Pictures['img']);
	
		$delete = $db->consulta("DELETE FROM `gallery` WHERE `id`='".$id."'");
		
		
		
		
        ?>
<script language="javascript">
                <!--
                        document.location='index.php?cmd=gallery';
                //-->
                </script>
<?
}
}
if($act=="Activate"){
	
	$update = $db->consulta("UPDATE `gallery` SET `status`='2' WHERE `id`='".$id."'");
?>
<script language="javascript">
<!--
           document.location='index.php?cmd=gallery';
//-->
</script>	
<?php	
}
?>
<?php endif;
$db = new MySQL();
$query = $db->consulta("SELECT * FROM `administrator` WHERE `id`='".$_SESSION['CRR_AUserID']."'");
$sql = $db->fetch_array($query);

?>