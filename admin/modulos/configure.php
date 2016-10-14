<?php
$db = new MySQL();
$query = $db->consulta("SELECT * FROM `administrator` WHERE `id`='".$_SESSION['CRR_AUserID']."'");
$sql = $db->fetch_array($query);

if($sql['m13'] == '1'):




$act = $_REQUEST['act'];
$id = $_REQUEST['id'];
$db = new MySQL();

if ($act=="") {

$query = $db->consulta("SELECT * FROM `configure` WHERE `id`='1'");
$Page = $db->fetch_array($query);

?>



<form action="index.php?cmd=configure" method="post" enctype="multipart/form-data">
<input type="hidden" value="<?=$Page['id']?>" name="id">
<input type="hidden" value="update" name="act">
<table width="550"  border="0" align="center" cellpadding="1" cellspacing="0" class="main">
<tr>
<td height="35" colspan="2" align="center" ><h2>Site Configuration</h2></td>
</tr><tr>
<td colspan="2" class="text"><strong>Page Title:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><input name="title" type="text" id="title" value="<?=$Page['title']?>" size="40" /></td>
  </tr>
 <tr>
  <td colspan="2" class="text"><strong>Keywords for Search engine robots: (170 words max.)</strong></td>
  </tr>
  <tr>
  <td colspan="2" class="text"><label for="metas"></label>
       <input name="metas" type="text" id="metas" size="80" maxlength="170" value="<?php echo $Page['metas']; ?>"></td>
  </tr>
  <tr>
  <td colspan="2" class="text"><strong>Description for Search engine robots: (120 words max.)</strong></td>
  </tr>
  <tr>
  <td colspan="2" class="text"><label for="phone"></label>
      <input name="description" type="text" id="description" size="80" maxlength="120" value="<?php echo $Page['description']; ?>"></td>
  </tr>
  <tr>
  <td colspan="2" class="text"><strong>Telephone</strong></td>
  </tr>
  <tr>
  <td colspan="2" class="text"><label for="phone"></label>
      <input name="phone" type="text" id="phone" size="80" maxlength="120" value="<?php echo $Page['phone']; ?>"></td>
  </tr>
  <tr>
  <td colspan="2" class="text"><strong>Mobile Phone</strong></td>
  </tr>
  <tr>
  <td colspan="2" class="text"><label for="cell"></label>
      <input name="cell" type="text" id="cell" size="80" maxlength="120" value="<?php echo $Page['cell']; ?>"></td>
  </tr>

<tr>
  <td colspan="2" class="text"><strong>Address:</strong></td>
  </tr>
  <tr>
  <td colspan="2" class="text"><label for="address"></label>
    <input name="address" type="text" id="address" onChange="showAddress(this.address.value); return false" value="<?php echo $Page['address']; ?>" size="80"></td>
  </tr>
 <tr>
  <td colspan="2" class="text"><strong>Facebook Share Image</strong></td>
  </tr>
  <tr>
  <td colspan="2" class="text"><label for="facebook"></label>
    <input type="file" name="facebook" id="facebook" />    
    <label for="owner"></label></td>
  </tr>
  <tr>
    <td colspan="2" class="text">Google Map</td>
  </tr>
  <tr>
    <td colspan="2" class="text"><div id="map" style="width: 570px; height: 400px;"></div></td>
  </tr>
  <tr>
  <td colspan="2" class="text"><strong>Latitude:</strong></td>
  </tr>
   <tr>
  <td colspan="2" class="text"> <input type="text" readonly="readonly" id="lati" onclick="this.focus(); this.select();" name="latitude" class="inlinefloat" style="width:80px; background-color:#c0e1f3;" value="<?php echo $Page['latitude']; ?>" /></td>
  </tr>
   <tr>
  <td colspan="2" class="text"><strong>Longitude:</strong></td>
  </tr>
   <tr>
  <td colspan="2" class="text">      <input type="text" readonly="readonly" id="longi" onclick="this.focus(); this.select();" name="longitut" class="inlinefloat" style="width:80px; background-color:#c0e1f3;" value="<?php echo $Page['longitut']; ?>" /></td>
  </tr>
   <tr>
  <td colspan="2" class="text"><div style="clear: left;"></div>
    <div id="hgenau" class="hinweis"></div>&nbsp;</td>
  </tr>

<tr align="center">
  <td height="35" class="standard"><input name="submit" type="submit" class="boton" value="Update">&nbsp;&nbsp;</td>
  <td class="standard"><input name="Cancelar" type="button" id="Cancelar" value="Cancel" onClick="self.location='index.php?cmd=pages'" class="boton"/></td>
  </tr>
</table>

</form>
<?
}
if ($act=="update"){

$title = $_POST['title'];
$email = $_POST['email'];
$metas = $_POST['metas'];
$description = $_POST['description'];
$phone = $_POST['phone'];
$cell = $_POST['cell'];
$owner = $_POST['owner'];
$address = $_POST['address'];
$latitude = $_POST['latitude'];
$longitut = $_POST['longitut'];
$id = $_POST['id'];

if($_FILES['facebook']==""){
	
}else{
	$extension = encontrar_extension($_FILES['facebook']['name']);
	if (move_uploaded_file($_FILES['facebook']['tmp_name'], "../facebook_share.jpg"))
	{
		
		
	} 
}
	 


        $update = $db->consulta("UPDATE `configure` SET `title`='".$title."',`email`='".$email."',`metas`='".$metas."',`description`='".$description."',`phone`='".$phone."',`cell`='".$cell."',`owner`='".$owner."',`address`='".$address."',`latitude`='".$latitude."',`longitut`='".$longitut."' WHERE `id`='".$id."'");


?>

<script language="javascript">
<!--
       document.location='index.php?cmd=configure';
//-->
</script>
<?
}
?>
<?php endif;
$db = new MySQL();
$query = $db->consulta("SELECT * FROM `administrator` WHERE `id`='".$_SESSION['CRR_AUserID']."'");
$sql = $db->fetch_array($query);

?>
