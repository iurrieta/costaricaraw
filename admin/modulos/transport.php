<?php
$db = new MySQL();
$query = $db->consulta("SELECT * FROM `administrator` WHERE `id`='".$_SESSION['CRR_AUserID']."'");
$sql = $db->fetch_array($query);

if($sql['m12'] == '1'):




$act = $_REQUEST['act'];
$id = $_REQUEST['id'];
$db = new MySQL();
if ($act=="") {



?>
<form action="index.php?cmd=transport&act=" method="post" name="categoria">
<br><table   border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
  <tr><td width="239" align="center" valign="top"><br />
<input name="act" type="submit" value="Add" class="boton"><br /><br /><input name="act" type="submit" value="Edit" class="boton"><br /><br /><input  name="act" type="submit" value="Remove" class="boton"></td>
  <td width="281" align="center" valign="top">
    <select name="id" size="10" multiple style="width:280px;">
<option selected disabled="disabled">--- Bus Schedules ---</option>	
<?               
$sql = $db->consulta("SELECT * FROM `transport` ORDER By `name`");
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

///////////////////////EDITAR TRANSPORTE///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($act=="Edit") {

$query = $db->consulta("SELECT * FROM `transport` WHERE `id`='".$id."'");
$Page = $db->fetch_array($query);

?>

<form action="index.php?cmd=transport" method="post" enctype="multipart/form-data">
<input type="hidden" value="<?=$Page['id']?>" name="id">
<input type="hidden" value="<?=$Page['icon']?>" name="actual">
<input type="hidden" value="update" name="act">
<table width="550"  border="0" align="center" cellpadding="1" cellspacing="0" class="main">
<tr>
<td height="35" colspan="2" align="center" ><h2>Edit Location</h2></td>
</tr><tr>
<td colspan="2" class="text"><strong>Bus Name:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><input name="name" type="text" id="name" value="<?=$Page['name']?>" size="40" /></td>
  </tr>
 <tr>
  <td  class="text"><strong>Location:</strong></td>
  <td colspan="2" class="text"><strong>Bus Type:</strong></td>
</tr>
<tr>
  <td  class="text"><label for="location"></label>
    <select name="location" id="location">
      <option value="0" disabled>Select Location</option>
      <?php
	  $sqlLocation = $db->consulta("SELECT * FROM `locations` Order by `name` ASC");
	  while($Location=$db->fetch_array($sqlLocation)){
		  ?> 
       <option value="<?php echo $Location['id']; ?>" <?php if($Location['id']==$Page['locations_id']){ echo "selected"; } ?>><?php echo $Location['name']; ?></option>
       <?php } ?>
    </select></td>
    
    <td colspan="2">
          <input type="radio" name="typebus" value="1" <?php if($Page['busType']==1) { echo "checked"; }?>/>Local
        <input type="radio" name="typebus" value="2"<?php if($Page['busType']==2) { echo "checked"; }?>/>Border
        <input type="radio" name="typebus" value="3"<?php if($Page['busType']==3) { echo "checked"; }?>/>National
  </td>
</tr>
  
        <tr>
        <td  class="text"><strong>Load Document:</strong></td>
         <td  class="text"><strong>Load QR Code:</strong></td>
      </tr>
      <tr>
        <td  class="text"><input type="file" name="documentpdf" /></td>
		<td  class="text"><input type="file" name="qrcode" /></td> 
          <tr>
          	<tr>
          	<td>
          		<a href=<? echo ("\"../doc/transp/".$Page['documentpdf']."\"") ?>target="new">View PDF</a>
          	</td>	
          	<td><a href=<? echo ("\"../doc/transp/".$Page['qrcode']."\"") ?>target="new">View QRCode</a></td>
          	</tr>
    <td colspan="2" class="text"><strong>Google Map</strong></td>
  </tr>           
          </tr>
          <tr>
          <td  class="text"><strong>Latitude:</strong><input type="text" readonly="readonly" id="lati" onclick="this.focus(); this.select();" name="latitude" class="inlinefloat" value="<?php echo $Page['latitude']; ?>" /></td>
           
          <td  class="text"><strong>Longitude:</strong>     <input type="text" readonly="readonly" id="longi" onclick="this.focus(); this.select();" name="longitut" class="inlinefloat" value="<?php echo $Page['longitude']; ?>" /></td>
          </tr>
    
  <tr>
    <td colspan="2" class="text"><div id="map" style="width: 570px; height: 400px;"></div></td>
  </tr>
    <td colspan="2" class="text">&nbsp;</td>
  </tr>

<tr align="center">
  <td height="35" class="standard"><input name="submit" type="submit" class="boton" value="Update">&nbsp;&nbsp;</td>
  <td class="standard"><input name="Cancelar" type="button" id="Cancelar" value="Cancel" onClick="self.location='index.php?cmd=transport'" class="boton"/></td>
  </tr>
</table>

</form>
<?
}
//////////////UPDATE TRANSPORT/////////////////////////////////////////////////////////////////////////////
if ($act=="update"){

$name = $_POST['name'];
$information = str_replace("'", "&acute;", $_POST['information']);
$itinerary = $_POST['itinerary'];
$latitude = $_POST['latitude'];
$longitut = $_POST['longitut'];

  

if($_FILES['qrcode']==""){
	
}else{
	$extension = encontrar_extension($_FILES['icono']['name']);
	if (move_uploaded_file($_FILES['icono']['tmp_name'], "../images/icons/trasn_".$id."_map.".$extension))
	{
		
		$foto1 = "trasn_".$id."_map.".$extension;
		$update = $db->consulta("UPDATE `transport` SET `icon`='".$foto1."' WHERE `id`='".$id."'");
	
	} 
}


$update = $db->consulta("UPDATE `transport` SET `name`='".$name."',`information`='".$information."',`latitude`='".$latitude."',`longitude`='".$longitut."',`itinerary`='".$itinerary."' WHERE `id`='".$id."'");



?>

<script language="javascript">
<!--
       document.location='index.php?cmd=transport';
//-->
</script>
<?
}

/////////////////New transport//////////////////////////////////////////////////////

if($act=="Add"){
	
?>


<form action="index.php?cmd=transport&act=save" method="post" enctype="multipart/form-data">
<input name="act" value="save" type="hidden">
<table width="95%" border="0" align="center" cellpadding="1" cellspacing="0" class="main">
<tr>
          <td height="35" colspan="2" align="center" ><h2>New Location</h2></td>
</tr>
<tr>
          <td colspan="2" class="text"><strong>Bus Name:</strong></td>
    </tr>
<tr>
  <td colspan="2" class="text"><input type="text" class="cajas" size="40" name="name" id="name" /></td>
  </tr>
  <tr>
  <td  class="text"><strong>Location:</strong></td>
  <td colspan="2" class="text"><strong>Bus Type:</strong></td>
</tr>
<tr>
  <td  class="text"><label for="location"></label>
    <select name="location" id="location">
      <option value="0" disabled>Select Location</option>
      <?php
	  $sqlLocation = $db->consulta("SELECT * FROM `locations` Order by `name` ASC");
	  while($Location=$db->fetch_array($sqlLocation)){
		  ?> 
       <option value="<?php echo $Location['id']; ?>" <?php if($Location['id']==$Page['locations_id']){ echo "selected"; } ?>><?php echo $Location['name']; ?></option>
       <?php } ?>
    </select></td>
    
    <td colspan="2">
          <input type="radio" name="typebus" value="1" id="typebus_1">Local
        <input type="radio" name="typebus" value="2" id="typebus_2">Border
        <input type="radio" name="typebus" value="3" id="typebus_3">National
  </td>
</tr>
  
        <tr>
        <td  class="text"><strong>Load Document:</strong></td>
         <td  class="text"><strong>Load QR Code:</strong></td>
      </tr>
      <tr>
        <td  class="text"><input type="file" name="documentpdf" /></td>
		<td  class="text"><input type="file" name="qrcode" /></td> 
          <tr>
    <td colspan="2" class="text"><strong>Google Map</strong></td>
  </tr>           
          </tr>
          <tr>
          <td  class="text"><strong>Latitude:</strong><input type="text" readonly="readonly" id="lati" onclick="this.focus(); this.select();" name="latitude" class="inlinefloat" value="<?php echo $Page['latitude']; ?>" /></td>
           
          <td  class="text"><strong>Longitude:</strong>     <input type="text" readonly="readonly" id="longi" onclick="this.focus(); this.select();" name="longitut" class="inlinefloat" value="<?php echo $Page['longitut']; ?>" /></td>
          </tr>
    
  <tr>
    <td colspan="2" class="text"><div id="map" style="width: 570px; height: 400px;"></div></td>
  </tr>
  
 <!--  <tr>
  <td colspan="2" class="text"><div style="clear: left;"></div>
    <div id="hgenau" class="hinweis"></div>
    &nbsp;</td>
  </tr>
 
       <tr>
       <td colspan="2" valign="top" class="text">&nbsp;</td>
     </tr>-->
     <tr>
       <td colspan="2" valign="top" class="text">&nbsp;</td>
     </tr>

    <tr align="center">
      <td height="35" align="center" class="standard"><input type="submit" value="Save" class="boton"></td>
      <td height="35" align="center" class="standard"><input name="Cancelar2" type="button" id="Cancelar2" value="Cancel" onClick="self.location='index.php?cmd=transport'" class="boton"/></td>
    </tr>
</table>

</form>
<?
}
///////////////CHECK Contacto/////////////////////////////////////
if($act=="save"){


$name = $_POST['name'];
$typebus = $_POST['typebus'];

 $sqlSequence = $db->consulta("SELECT IFNULL(Max(`sequence`),0) as `sequenceMax` FROM `transport`");
	 $Sequence = $db->fetch_array($sqlSequence);

$sequence = $Sequence['sequenceMax']+1;
$location = $_POST['location'];
$latitude = $_POST['latitude'];
$longitut = $_POST['longitut'];




      $ejecutar =  $db->consulta("INSERT INTO `transport` (`name`,`sequence`,`busType`,`latitude`,`longitude`,locations_id) VALUES ('".$name."','".$sequence."','".$typebus."','".$latitude."','".$longitut."','".$location."')");

$id =  $db->getLastID($ejecutar);
	  
if($_FILES['qrcode']!=""){

	$extension = encontrar_extension($_FILES['qrcode']['name']);
	if (move_uploaded_file($_FILES['qrcode']['tmp_name'], "../doc/transp/trasn_".$id."_qrcode.".$extension))
	{
		$foto1 = "trasn_".$id."_qrcode.".$extension;
		$update = $db->consulta("UPDATE `transport` SET `qrcode`='".$foto1."' WHERE `id`='".$id."'");
	} 
  
}
if($_FILES['documentpdf']!=""){
	$extension = encontrar_extension($_FILES['documentpdf']['name']);
	if (move_uploaded_file($_FILES['documentpdf']['tmp_name'], "../doc/transp/trasn_".$id."_document.".$extension))
	{
		$foto2 = "trasn_".$id."_document.".$extension;
		$update = $db->consulta("UPDATE `transport` SET `documentpdf`='".$foto2."' WHERE `id`='".$id."'");
	} 
}	 
		
	
        ?>
	<script language="javascript">
                <!--	       
 	document.location='index.php?cmd=transport';
                //-->
                </script>
        <?
}



//////////////////BORRAR USUARIO/////////////////////
if($act=="Remove"){

$page = $_REQUEST['page'];
$resp = $db->consulta("SELECT * FROM `transport` WHERE `id`='".$id."'");
$Page = $db->fetch_array($resp);



if ($page == "") {

?>
<center>
        <br><br>
<span class="titulos">This action remove Bus Schedule <em><strong><? echo $Page['name']; ?></strong></em>.</span><br><font color="#FF0000"><em>You sure?</em></font><br>

<br>
<input name="SI" type="button" id="YES" value="  Yes  " onClick="self.location='index.php?cmd=transport&act=Remove&page=confirm&id=<? echo $Page['id']; ?>'" class="boton"/>
&nbsp;&nbsp;&nbsp;
<input name="NO" type="button" id="NO" value="  No  " onClick="self.location='index.php?cmd=transport'" class="boton"/></center>
<?


}
if ($page == "confirm") {
        $delete = $db->consulta("DELETE FROM `transport` WHERE `id`='".$id."'");
        ?>
<script language="javascript">
                <!--
                        document.location='index.php?cmd=transport';
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