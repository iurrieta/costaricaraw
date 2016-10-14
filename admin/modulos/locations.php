<?php
$db = new MySQL();
$query = $db->consulta("SELECT * FROM `administrator` WHERE `id`='".$_SESSION['CRR_AUserID']."'");
$sql = $db->fetch_array($query);

if($sql['m7'] == '1'):




$act = $_REQUEST['act'];
$id = $_REQUEST['id'];
$db = new MySQL();
include("fckeditor/fckeditor.php") ;
if ($act=="") {



?>
<form action="index.php?cmd=locations&act=" method="post" name="categoria">
<br><table   border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
  <tr><td width="239" align="center" valign="top"><br />
<input name="act" type="submit" value="Add" class="boton"><br /><br /><input name="act" type="submit" value="Edit" class="boton"><br /><br /><input  name="act" type="submit" value="Remove" class="boton"></td>
  <td width="281" align="center" valign="top">
    <select name="id" size="10" multiple style="width:280px;">
<option selected disabled="disabled">--- Locations ---</option>	
<?               
$sql = $db->consulta("SELECT * FROM `locations` ORDER By `name`");
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

$query = $db->consulta("SELECT * FROM `locations` WHERE `id`='".$id."'");
$Page = $db->fetch_array($query);

?>

<form action="index.php?cmd=locations" method="post" enctype="multipart/form-data">
<input type="hidden" value="<?=$Page['id']?>" name="id">
<input type="hidden" value="<?=$Page['icon']?>" name="actual">
<input type="hidden" value="update" name="act">
<table width="550"  border="0" align="center" cellpadding="1" cellspacing="0" class="main">
<tr>
<td height="35" colspan="2" align="center" ><h2>Edit Location</h2></td>
</tr><tr>
<td colspan="2" class="text"><strong> Name:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><input name="name" type="text" id="name" value="<?=$Page['name']?>" size="40" /></td>
  </tr>


     <tr>
  <td colspan="2" valign="top" class="text"><strong>Information:</strong></td>
  </tr>
     <tr>
       <td colspan="2" valign="top" class="text"> <?php
$oFCKeditor = new FCKeditor('information') ;
$oFCKeditor->BasePath = 'fckeditor/' ;
$oFCKeditor->Value = $Page['information'];
$oFCKeditor->Create() ;
?></td>
     </tr>
     
 <tr>
       <td colspan="2" valign="top" class="text"><strong>Pictures:</strong></td>
     </tr>
     <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto1" id="foto1" size="1">&nbsp;&nbsp;<?php if($Page['pic1']){ ?><img src="../images/locations/small_<?=$Page['pic1']?>" height="50" align="absmiddle" alt="<?=$Page['pic1']?>" title="<?=$Page['pic1']?>" />&nbsp;&nbsp;<a href="modulos/resize.php?picture=<?=$Page['pic1']?>" target="_new">Resize Picture</a>&nbsp;&nbsp;<a href="modulos/removelPicture.php?picture=<?=$Page['pic1']?>&adv=<?=$Page['id']?>&picID=1" target="_new">Remove Picture 1</a><?php } ?></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto2" id="foto2" size="1">&nbsp;&nbsp;<?php if($Page['pic2']){ ?><img src="../images/locations/small_<?=$Page['pic2']?>" height="50" align="absmiddle" alt="<?=$Page['pic2']?>" title="<?=$Page['pic2']?>" />&nbsp;&nbsp;<a href="modulos/resize.php?picture=<?=$Page['pic2']?>" target="_new">Resize Picture</a>&nbsp;&nbsp;<a href="modulos/removelPicture.php?picture=<?=$Page['pic2']?>&adv=<?=$Page['id']?>&picID=2" target="_new">Remove Picture 2</a><?php } ?></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto3" id="foto3" size="1">&nbsp;&nbsp;<?php if($Page['pic3']){ ?><img src="../images/locations/small_<?=$Page['pic3']?>" height="50" align="absmiddle" alt="<?=$Page['pic3']?>" title="<?=$Page['pic3']?>" />&nbsp;&nbsp;<a href="modulos/resize.php?picture=<?=$Page['pic3']?>" target="_new">Resize Picture</a>&nbsp;&nbsp;<a href="modulos/removelPicture.php?picture=<?=$Page['pic3']?>&adv=<?=$Page['id']?>&picID=3" target="_new">Remove Picture 3</a><?php } ?></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto4" id="foto4" size="1">&nbsp;&nbsp;<?php if($Page['pic4']){ ?><img src="../images/locations/small_<?=$Page['pic4']?>" height="50" align="absmiddle" alt="<?=$Page['pic4']?>" title="<?=$Page['pic4']?>" />&nbsp;&nbsp;<a href="modulos/resize.php?picture=<?=$Page['pic4']?>" target="_new">Resize Picture</a>&nbsp;&nbsp;<a href="modulos/removelPicture.php?picture=<?=$Page['pic4']?>&adv=<?=$Page['id']?>&picID=4" target="_new">Remove Picture 4</a><?php } ?></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto5" id="foto5" size="1">&nbsp;&nbsp;<?php if($Page['pic5']){ ?><img src="../images/locations/small_<?=$Page['pic5']?>" height="50" align="absmiddle" alt="<?=$Page['pic5']?>" title="<?=$Page['pic5']?>" />&nbsp;&nbsp;<a href="modulos/resize.php?picture=<?=$Page['pic5']?>" target="_new">Resize Picture</a>&nbsp;&nbsp;<a href="modulos/removelPicture.php?picture=<?=$Page['pic5']?>&adv=<?=$Page['id']?>&picID=5" target="_new">Remove Picture 5</a><?php } ?></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto6" id="foto6" size="1">&nbsp;&nbsp;<?php if($Page['pic6']){ ?><img src="../images/locations/small_<?=$Page['pic6']?>" height="50" align="absmiddle" alt="<?=$Page['pic6']?>" title="<?=$Page['pic6']?>" />&nbsp;&nbsp;<a href="modulos/resize.php?picture=<?=$Page['pic6']?>" target="_new">Resize Picture</a>&nbsp;&nbsp;<a href="modulos/removelPicture.php?picture=<?=$Page['pic6']?>&adv=<?=$Page['id']?>&picID=6" target="_new">Remove Picture 6</a><?php } ?></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto7" id="foto7" size="1">&nbsp;&nbsp;<?php if($Page['pic7']){ ?><img src="../images/locations/small_<?=$Page['pic7']?>" height="50" align="absmiddle" alt="<?=$Page['pic7']?>" title="<?=$Page['pic7']?>" />&nbsp;&nbsp;<a href="modulos/resize.php?picture=<?=$Page['pic7']?>" target="_new">Resize Picture</a>&nbsp;&nbsp;<a href="modulos/removelPicture.php?picture=<?=$Page['pic7']?>&adv=<?=$Page['id']?>&picID=7" target="_new">Remove Picture 7</a><?php } ?></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto8" id="foto8" size="1">&nbsp;&nbsp;<?php if($Page['pic8']){ ?><img src="../images/locations/small_<?=$Page['pic8']?>" height="50" align="absmiddle" alt="<?=$Page['pic8']?>" title="<?=$Page['pic8']?>" />&nbsp;&nbsp;<a href="modulos/resize.php?picture=<?=$Page['pic8']?>" target="_new">Resize Picture</a>&nbsp;&nbsp;<a href="modulos/removelPicture.php?picture=<?=$Page['pic8']?>&adv=<?=$Page['id']?>&picID=8" target="_new">Remove Picture 8</a><?php } ?></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto9" id="foto9" size="1">&nbsp;&nbsp;<?php if($Page['pic9']){ ?><img src="../images/locations/small_<?=$Page['pic9']?>" height="50" align="absmiddle" alt="<?=$Page['pic9']?>" title="<?=$Page['pic9']?>" />&nbsp;&nbsp;<a href="modulos/resize.php?picture=<?=$Page['pic9']?>" target="_new">Resize Picture</a>&nbsp;&nbsp;<a href="modulos/removelPicture.php?picture=<?=$Page['pic9']?>&adv=<?=$Page['id']?>&picID=9" target="_new">Remove Picture 9</a><?php } ?></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto10" id="foto10" size="1">&nbsp;&nbsp;<?php if($Page['pic10']){ ?><img src="../images/locations/small_<?=$Page['pic10']?>" height="50" align="absmiddle" alt="<?=$Page['pic10']?>" title="<?=$Page['pic10']?>" />&nbsp;&nbsp;<a href="modulos/resize.php?picture=<?=$Page['pic10']?>" target="_new">Resize Picture</a>&nbsp;&nbsp;<a href="modulos/removelPicture.php?picture=<?=$Page['pic10']?>&adv=<?=$Page['id']?>&picID=10" target="_new">Remove Picture 10</a><?php } ?></td>
     </tr>     
     
      <tr>
    <td><strong>Province:</strong></td>
    </tr>
    <tr>
    <td><?
     echo "<font id=states><select class='input' onclick=\"dochange('states', -1);\">\n";
     echo "<option value='0' >".$Page['province']."</option> \n" ;
     echo "</select></font>\n";
	  ?></td>
  </tr>
  <tr>
    <td><strong>Canton:</strong></td>
  </tr>
  <tr>  
    <td><? echo "<font id=cities><select class='input'>\n";
     echo "<option value='0'>".$Page['canton']."</option> \n" ;
     echo "</select></font>\n";
	 ?>
            </td>
  </tr>
  <tr>
    <td><strong>District:</strong></td>
  </tr>
  <tr>  
    <td><? echo "<font id=distrito><select class='input'>\n";
     echo "<option value='0'>".$Page['district']."</option> \n" ;
     echo "</select></font>\n";
	 ?>
        <script language="JavaScript" type="text/javascript">
function Inint_AJAX() {
try { return new ActiveXObject("Msxml2.XMLHTTP");  } catch(e) {} //IE
try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} //IE
try { return new XMLHttpRequest();          } catch(e) {} //Native Javascript
alert("XMLHttpRequest not supported");
return null;
};

function dochange(src, val) {
var req = Inint_AJAX();
req.onreadystatechange = function () {
 if (req.readyState==4) {
      if (req.status==200) {
           document.getElementById(src).innerHTML=req.responseText; //retuen value
      }
 }
};
req.open("GET", "states.php?data="+src+"&val="+val); //make connection
//req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=ISO-8859-2"); // set Header
req.send(null); //send value
}

//window.onLoad=dochange('states', -1);         // value in first dropdown
        </script>
     
     </td>
    </tr>
      <tr>
    <td colspan="2" class="text"><strong>Google Map</strong></td>
  </tr>
  <tr>
    <td colspan="2" class="text"><div id="map" style="width: 570px; height: 400px;"></div></td>
  </tr>
  <tr>
  <td colspan="2" class="text"><strong>Latitude:</strong></td>
  </tr>
   <tr>
  <td colspan="2" class="text"> <input type="text" readonly="readonly" id="lati" onclick="this.focus(); this.select();" name="latitude" class="inlinefloat" value="<?php echo $Page['latitude']; ?>" /></td>
  </tr>
   <tr>
  <td colspan="2" class="text"><strong>Longitude:</strong></td>
  </tr>
   <tr>
  <td colspan="2" class="text">      <input type="text" readonly="readonly" id="longi" onclick="this.focus(); this.select();" name="longitut" class="inlinefloat" value="<?php echo $Page['longitude']; ?>" /></td>
  </tr>
   <tr>
  <td colspan="2" class="text"><div style="clear: left;"></div>
    <div id="hgenau" class="hinweis"></div>
    &nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="text">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="text">&nbsp;</td>
  </tr>

<tr align="center">
  <td height="35" class="standard"><input name="submit" type="submit" class="boton" value="Update">&nbsp;&nbsp;</td>
  <td class="standard"><input name="Cancelar" type="button" id="Cancelar" value="Cancel" onClick="self.location='index.php?cmd=locations'" class="boton"/></td>
  </tr>
</table>

</form>
<?
}
//////////////UPDATE USUARIO/////////////////////////////////////////////////////////////////////////////
if ($act=="update"){

$name = $_POST['name'];
//$information = $_POST['information'];


		$information=str_replace("'", "&acute;", $_POST['information']);
		

$latitude = $_POST['latitude'];
$longitut = $_POST['longitut'];

$provincia = $_POST['states'];
$cantonExtra = $_POST['cities'];
$distrito = $_POST['distrito'];
if(($provincia=="0") || $provincia==""){
	$update = $db->consulta("UPDATE `locations` SET `name`='".$name."',`information`='".$information."',`latitude`='".$latitude."',`longitude`='".$longitut."' WHERE `id`='".$id."'");
	
}else{

list($valornorecoge,$canton) = explode("-",$cantonExtra);	
$update = $db->consulta("UPDATE `locations` SET `name`='".$name."',`information`='".$information."',`latitude`='".$latitude."',`longitude`='".$longitut."',`province`='".$provincia."',`canton`='".$canton."',`district`='".$distrito."' WHERE `id`='".$id."'");
}

     

include('images.php');
$image = new SimpleImage();
  

if($_FILES['foto1']==""){
	
}else{
	$extension = encontrar_extension($_FILES['foto1']['name']);
	if (move_uploaded_file($_FILES['foto1']['tmp_name'], "../images/locations/1_".$id."_location.".$extension))
	{
		
		$foto1 = "1_".$id."_location.".$extension;
		$update = $db->consulta("UPDATE `locations` SET `pic1`='".$foto1."' WHERE `id`='".$id."'");
		$image->load('../images/locations/'.$foto1);
		$image->resize(540,350);
		$image->save('../images/locations/medium_'.$foto1);
		$image->resizeToHeight(200);
		$image->save('../images/locations/small_'.$foto1);
	} 
}
if($_FILES['foto2']==""){
	
}else{
	$extension2 = encontrar_extension($_FILES['foto2']['name']);
	if (move_uploaded_file($_FILES['foto2']['tmp_name'], "../images/locations/2_".$id."_location.".$extension2))
	{
		$foto2 = "2_".$id."_location.".$extension2;
		$update = $db->consulta("UPDATE `locations` SET `pic2`='".$foto2."' WHERE `id`='".$id."'");
		$image->load('../images/locations/'.$foto2);
		$image->resize(540,350);
		$image->save('../images/locations/medium_'.$foto2);
		$image->resizeToHeight(200);
		$image->save('../images/locations/small_'.$foto2);

	} 
}
if($_FILES['foto3']==""){
	
}else{
	$extension3 = encontrar_extension($_FILES['foto3']['name']);
	if (move_uploaded_file($_FILES['foto3']['tmp_name'], "../images/locations/3_".$id."_location.".$extension3))
	{
		$foto3 = "3_".$id."_location.".$extension3;
		$update = $db->consulta("UPDATE `locations` SET `pic3`='".$foto3."' WHERE `id`='".$id."'");
		$image->load('../images/locations/'.$foto3);
		$image->resize(540,350);
		$image->save('../images/locations/medium_'.$foto3);
		$image->resizeToHeight(200);
		$image->save('../images/locations/small_'.$foto3);
	} 
}
if($_FILES['foto4']==""){
	
}else{
	$extension4 = encontrar_extension($_FILES['foto4']['name']);
	if (move_uploaded_file($_FILES['foto4']['tmp_name'], "../images/locations/4_".$id."_location.".$extension4))
	{
		$foto4 = "4_".$id."_location.".$extension4;
		$update = $db->consulta("UPDATE `locations` SET `pic4`='".$foto4."' WHERE `id`='".$id."'");
		$image->load('../images/locations/'.$foto4);
		$image->resize(540,350);
		$image->save('../images/locations/medium_'.$foto4);
		$image->resizeToHeight(200);
		$image->save('../images/locations/small_'.$foto4);
	} 
}
if($_FILES['foto5']==""){
	
}else{
	$extension5 = encontrar_extension($_FILES['foto5']['name']);
	if (move_uploaded_file($_FILES['foto5']['tmp_name'], "../images/locations/5_".$id."_location.".$extension5))
	{
		$foto5 = "5_".$id."_location.".$extension5;
		$update = $db->consulta("UPDATE `locations` SET `pic5`='".$foto5."' WHERE `id`='".$id."'");
		$image->load('../images/locations/'.$foto5);
		$image->resize(540,350);
		$image->save('../images/locations/medium_'.$foto5);
		$image->resizeToHeight(200);
		$image->save('../images/locations/small_'.$foto5);
	} 
}
if($_FILES['foto6']==""){
	
}else{
	$extension6 = encontrar_extension($_FILES['foto6']['name']);
	if (move_uploaded_file($_FILES['foto6']['tmp_name'], "../images/locations/6_".$id."_location.".$extension6))
	{
		$foto6 = "6_".$id."_location.".$extension6;
		$update = $db->consulta("UPDATE `locations` SET `pic6`='".$foto6."' WHERE `id`='".$id."'");
		$image->load('../images/locations/'.$foto6);
		$image->resize(540,350);
		$image->save('../images/locations/medium_'.$foto6);
		$image->resizeToHeight(200);
		$image->save('../images/locations/small_'.$foto6);
	} 
}
if($_FILES['foto7']==""){
	
}else{
	$extension7 = encontrar_extension($_FILES['foto7']['name']);
	if (move_uploaded_file($_FILES['foto7']['tmp_name'], "../images/locations/7_".$id."_location.".$extension7))
	{
		$foto7 = "7_".$id."_location.".$extension7;
		$update = $db->consulta("UPDATE `locations` SET `pic7`='".$foto7."' WHERE `id`='".$id."'");
		$image->load('../images/locations/'.$foto7);
		$image->resize(540,350);
		$image->save('../images/locations/medium_'.$foto7);
		$image->resizeToHeight(200);
		$image->save('../images/locations/small_'.$foto7);
	} 
}
if($_FILES['foto8']==""){
	
}else{
	$extension8 = encontrar_extension($_FILES['foto8']['name']);
	if (move_uploaded_file($_FILES['foto8']['tmp_name'], "../images/locations/8_".$id."_location.".$extension8))
	{
		$foto8 = "8_".$id."_location.".$extension8;
		$update = $db->consulta("UPDATE `locations` SET `pic8`='".$foto8."' WHERE `id`='".$id."'");
		$image->load('../images/locations/'.$foto8);
		$image->resize(540,350);
		$image->save('../images/locations/medium_'.$foto8);
		$image->resizeToHeight(200);
		$image->save('../images/locations/small_'.$foto8);
	} 
}
if($_FILES['foto9']==""){
	
}else{
	$extension9 = encontrar_extension($_FILES['foto9']['name']);
	if (move_uploaded_file($_FILES['foto9']['tmp_name'], "../images/locations/9_".$id."_location.".$extension9))
	{
		$foto9 = "9_".$id."_location.".$extension9;
		$update = $db->consulta("UPDATE `locations` SET `pic9`='".$foto9."' WHERE `id`='".$id."'");
		$image->load('../images/locations/'.$foto9);
		$image->resize(540,350);
		$image->save('../images/locations/medium_'.$foto9);
		$image->resizeToHeight(200);
		$image->save('../images/locations/small_'.$foto9);
	} 
}
if($_FILES['foto10']==""){
	
}else{
	$extension10 = encontrar_extension($_FILES['foto10']['name']);
	if (move_uploaded_file($_FILES['foto10']['tmp_name'], "../images/locations/10_".$id."_location.".$extension10))
	{
		$foto10 = "10_".$id."_location.".$extension10;
		$update = $db->consulta("UPDATE `locations` SET `pic10`='".$foto10."' WHERE `id`='".$id."'");
		$image->load('../images/locations/'.$foto10);
		$image->resize(540,350);
		$image->save('../images/locations/medium_'.$foto10);
		$image->resizeToHeight(200);
		$image->save('../images/locations/small_'.$foto10);
	} 
}	    


?>

<script language="javascript">
<!--
       document.location='index.php?cmd=locations';
//-->
</script>
<?
}

/////////////////Nuevo Usuario//////////////////////////////////////////////////////

if($act=="Add"){
	
?>


<form action="index.php?cmd=locations&act=save" method="post" enctype="multipart/form-data">
<input name="act" value="save" type="hidden">
<table width="95%" border="0" align="center" cellpadding="1" cellspacing="0" class="main">
<tr>
          <td height="35" colspan="2" align="center" ><h2>New Location</h2></td>
</tr>
<tr>
          <td colspan="2" class="text"><strong>Name:</strong></td>
    </tr>
<tr>
  <td colspan="2" class="text"><input type="text" class="cajas" size="40" name="name" id="name" /></td>
  </tr>

     <tr>
  <td colspan="2" valign="top" class="text"><strong>Information:</strong></td>
  </tr>
     <tr>
       <td colspan="2" valign="top" class="text"> <?php
$oFCKeditor = new FCKeditor('information') ;
$oFCKeditor->BasePath = 'fckeditor/' ;
$oFCKeditor->Value = "";
$oFCKeditor->Create() ;
?></td>
     </tr>
     <tr>
       <td colspan="2" valign="top" class="text"><strong>Pictures:</strong></td>
     </tr>
     <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto1" id="foto1"></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto2" id="foto2"></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto3" id="foto3"></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto4" id="foto4"></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto5" id="foto5"></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto6" id="foto6"></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto7" id="foto7"></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto8" id="foto8"></td>
     </tr>
       <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto9" id="foto9"></td>
     </tr>
       <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto10" id="foto10"></td>
     </tr>
      <tr>
    <td><strong>Province:</strong></td>
    </tr>
    <tr>
    <td><?
       echo "<font id=states><select class='input'>\n";
     echo "<option value='0'>============</option> \n" ;
     echo "</select></font>\n";
	  ?></td>
  </tr>
  <tr>
    <td><strong>Canton:</strong></td>
  </tr>
  <tr>  
    <td><? echo "<font id=cities><select class='input'>\n";
     echo "<option value='0'>=== ninguno ===</option> \n" ;
     echo "</select></font>\n";
	 ?>
            </td>
  </tr>
  <tr>
    <td><strong>District:</strong></td>
  </tr>
  <tr>  
    <td><? echo "<font id=distrito><select class='input'>\n";
     echo "<option value='0'>=== ninguno ===</option> \n" ;
     echo "</select></font>\n";
	 ?>
        <script language="JavaScript" type="text/javascript">
function Inint_AJAX() {
try { return new ActiveXObject("Msxml2.XMLHTTP");  } catch(e) {} //IE
try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} //IE
try { return new XMLHttpRequest();          } catch(e) {} //Native Javascript
alert("XMLHttpRequest not supported");
return null;
};

function dochange(src, val) {
var req = Inint_AJAX();
req.onreadystatechange = function () {
 if (req.readyState==4) {
      if (req.status==200) {
           document.getElementById(src).innerHTML=req.responseText; //retuen value
      }
 }
};
req.open("GET", "states.php?data="+src+"&val="+val); //make connection
//req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=ISO-8859-2"); // set Header
req.send(null); //send value
}

window.onLoad=dochange('states', -1);         // value in first dropdown
        </script>
     
     </td>
    </tr>
      <tr>
    <td colspan="2" class="text"><strong>Google Map</strong></td>
  </tr>
  <tr>
    <td colspan="2" class="text"><div id="map" style="width: 570px; height: 400px;"></div></td>
  </tr>
  <tr>
  <td colspan="2" class="text"><strong>Latitude:</strong></td>
  </tr>
   <tr>
  <td colspan="2" class="text"> <input type="text" readonly="readonly" id="lati" onclick="this.focus(); this.select();" name="latitude" class="inlinefloat" value="<?php echo $Page['latitude']; ?>" /></td>
  </tr>
   <tr>
  <td colspan="2" class="text"><strong>Longitude:</strong></td>
  </tr>
   <tr>
  <td colspan="2" class="text">      <input type="text" readonly="readonly" id="longi" onclick="this.focus(); this.select();" name="longitut" class="inlinefloat" value="<?php echo $Page['longitut']; ?>" /></td>
  </tr>
   <tr>
  <td colspan="2" class="text"><div style="clear: left;"></div>
    <div id="hgenau" class="hinweis"></div>
    &nbsp;</td>
  </tr>
 
       <tr>
       <td colspan="2" valign="top" class="text">&nbsp;</td>
     </tr>
     <tr>
       <td colspan="2" valign="top" class="text">&nbsp;</td>
     </tr>

    <tr align="center">
      <td height="35" align="center" class="standard"><input type="submit" value="Save" class="boton"></td>
      <td height="35" align="center" class="standard"><input name="Cancelar2" type="button" id="Cancelar2" value="Cancel" onClick="self.location='index.php?cmd=locations'" class="boton"/></td>
    </tr>
</table>

</form>
<?
}
///////////////CHECK Contacto/////////////////////////////////////
if($act=="save"){


$name = $_POST['name'];
//$information = $_POST['information'];
$information=str_replace("'", "&acute;", $_POST['information']);
$latitude = $_POST['latitude'];
$longitut = $_POST['longitut'];
$provincia = $_POST['states'];
$canton_extra = $_POST['cities'];
$distrito = $_POST['distrito'];
list($valornorecoge,$canton) = explode("-",$canton_extra);	

include('images.php');
$image = new SimpleImage();


      $ejecutar =  $db->consulta("INSERT INTO `locations` (`name`,`information`,`province`,`canton`,`district`,`latitude`,`longitude`) VALUES ('".$name."','".$information."','".$provincia."','".$canton."','".$distrito."','".$latitude."','".$longitut."')");
	  
	   $locationID = $db->getLastID($ejecutar);
		
if($_FILES['foto1']==""){
	
}else{
	$extension = encontrar_extension($_FILES['foto1']['name']);
	if (move_uploaded_file($_FILES['foto1']['tmp_name'], "../images/locations/1_".$locationID."_location.".$extension))
	{
		
		$foto1 = "1_".$locationID."_location.".$extension;
		$update = $db->consulta("UPDATE `locations` SET `pic1`='".$foto1."' WHERE `id`='".$locationID."'");
		$image->load('../images/locations/'.$foto1);
		$image->resize(540,350);
		$image->save('../images/locations/medium_'.$foto1);
		$image->resizeToHeight(200);
		$image->save('../images/locations/small_'.$foto1);
	} 
}
if($_FILES['foto2']==""){
	
}else{
	$extension2 = encontrar_extension($_FILES['foto2']['name']);
	if (move_uploaded_file($_FILES['foto2']['tmp_name'], "../images/locations/2_".$locationID."_location.".$extension2))
	{
		$foto2 = "2_".$locationID."_location.".$extension2;
		$update = $db->consulta("UPDATE `locations` SET `pic2`='".$foto2."' WHERE `id`='".$locationID."'");
		$image->load('../images/locations/'.$foto2);
		$image->resize(540,350);
		$image->save('../images/locations/medium_'.$foto2);
		$image->resizeToHeight(200);
		$image->save('../images/locations/small_'.$foto2);

	} 
}
if($_FILES['foto3']==""){
	
}else{
	$extension3 = encontrar_extension($_FILES['foto3']['name']);
	if (move_uploaded_file($_FILES['foto3']['tmp_name'], "../images/locations/3_".$locationID."_location.".$extension3))
	{
		$foto3 = "3_".$locationID."_location.".$extension3;
		$update = $db->consulta("UPDATE `locations` SET `pic3`='".$foto3."' WHERE `id`='".$locationID."'");
		$image->load('../images/locations/'.$foto3);
		$image->resize(540,350);
		$image->save('../images/locations/medium_'.$foto3);
		$image->resizeToHeight(200);
		$image->save('../images/locations/small_'.$foto3);
	} 
}
if($_FILES['foto4']==""){
	
}else{
	$extension4 = encontrar_extension($_FILES['foto4']['name']);
	if (move_uploaded_file($_FILES['foto4']['tmp_name'], "../images/locations/4_".$locationID."_location.".$extension4))
	{
		$foto4 = "4_".$locationID."_location.".$extension4;
		$update = $db->consulta("UPDATE `locations` SET `pic4`='".$foto4."' WHERE `id`='".$locationID."'");
		$image->load('../images/locations/'.$foto4);
		$image->resize(540,350);
		$image->save('../images/locations/medium_'.$foto4);
		$image->resizeToHeight(200);
		$image->save('../images/locations/small_'.$foto4);
	} 
}
if($_FILES['foto5']==""){
	
}else{
	$extension5 = encontrar_extension($_FILES['foto5']['name']);
	if (move_uploaded_file($_FILES['foto5']['tmp_name'], "../images/locations/5_".$locationID."_location.".$extension5))
	{
		$foto5 = "5_".$locationID."_location.".$extension5;
		$update = $db->consulta("UPDATE `locations` SET `pic5`='".$foto5."' WHERE `id`='".$locationID."'");
		$image->load('../images/locations/'.$foto5);
		$image->resize(540,350);
		$image->save('../images/locations/medium_'.$foto5);
		$image->resizeToHeight(200);
		$image->save('../images/locations/small_'.$foto5);
	} 
}
if($_FILES['foto6']==""){
	
}else{
	$extension6 = encontrar_extension($_FILES['foto6']['name']);
	if (move_uploaded_file($_FILES['foto6']['tmp_name'], "../images/locations/6_".$locationID."_location.".$extension6))
	{
		$foto6 = "6_".$locationID."_location.".$extension6;
		$update = $db->consulta("UPDATE `locations` SET `pic6`='".$foto6."' WHERE `id`='".$locationID."'");
		$image->load('../images/locations/'.$foto6);
		$image->resize(540,350);
		$image->save('../images/locations/medium_'.$foto6);
		$image->resizeToHeight(200);
		$image->save('../images/locations/small_'.$foto6);
	} 
}
if($_FILES['foto7']==""){
	
}else{
	$extension7 = encontrar_extension($_FILES['foto7']['name']);
	if (move_uploaded_file($_FILES['foto7']['tmp_name'], "../images/locations/7_".$locationID."_location.".$extension7))
	{
		$foto7 = "7_".$locationID."_location.".$extension7;
		$update = $db->consulta("UPDATE `locations` SET `pic7`='".$foto7."' WHERE `id`='".$locationID."'");
		$image->load('../images/locations/'.$foto7);
		$image->resize(540,350);
		$image->save('../images/locations/medium_'.$foto7);
		$image->resizeToHeight(200);
		$image->save('../images/locations/small_'.$foto7);
	} 
}
if($_FILES['foto8']==""){
	
}else{
	$extension8 = encontrar_extension($_FILES['foto8']['name']);
	if (move_uploaded_file($_FILES['foto8']['tmp_name'], "../images/locations/8_".$locationID."_location.".$extension8))
	{
		$foto8 = "8_".$locationID."_location.".$extension8;
		$update = $db->consulta("UPDATE `locations` SET `pic8`='".$foto8."' WHERE `id`='".$locationID."'");
		$image->load('../images/locations/'.$foto8);
		$image->resize(540,350);
		$image->save('../images/locations/medium_'.$foto8);
		$image->resizeToHeight(200);
		$image->save('../images/locations/small_'.$foto8);
	} 
}
if($_FILES['foto9']==""){
	
}else{
	$extension9 = encontrar_extension($_FILES['foto9']['name']);
	if (move_uploaded_file($_FILES['foto9']['tmp_name'], "../images/locations/9_".$locationID."_location.".$extension9))
	{
		$foto9 = "9_".$locationID."_location.".$extension9;
		$update = $db->consulta("UPDATE `locations` SET `pic9`='".$foto9."' WHERE `id`='".$locationID."'");
		$image->load('../images/locations/'.$foto9);
		$image->resize(540,350);
		$image->save('../images/locations/medium_'.$foto9);
		$image->resizeToHeight(200);
		$image->save('../images/locations/small_'.$foto9);
	} 
}
if($_FILES['foto10']==""){
	
}else{
	$extension10 = encontrar_extension($_FILES['foto10']['name']);
	if (move_uploaded_file($_FILES['foto10']['tmp_name'], "../images/locations/10_".$locationID."_location.".$extension10))
	{
		$foto10 = "10_".$locationID."_location.".$extension10;
		$update = $db->consulta("UPDATE `locations` SET `pic10`='".$foto10."' WHERE `id`='".$locationID."'");
		$image->load('../images/locations/'.$foto10);
		$image->resize(540,350);
		$image->save('../images/locations/medium_'.$foto10);
		$image->resizeToHeight(200);
		$image->save('../images/locations/small_'.$foto10);
	} 
}		
	
        ?>
<script language="javascript">
                <!--
				       
                        document.location='index.php?cmd=locations';
                //-->
                </script>
        <?
}



//////////////////BORRAR USUARIO/////////////////////
if($act=="Remove"){


$resp = $db->consulta("SELECT * FROM `locations` WHERE `id`='".$id."'");
$Page = $db->fetch_array($resp);

if (!IsSet($page)) {
        $page = "confirm";
}

if ($page == "confirm") {

?>
<center>
        <br><br>
<span class="titulos">This action remove Location <em><strong><? echo $Page['name']; ?></strong></em>.</span><br><font color="#FF0000"><em>You sure?</em></font><br>

<br>
<input name="SI" type="button" id="YES" value="  Yes  " onClick="self.location='index.php?cmd=locations&act=Remove&page=Remove&id=<? echo $Page['id']; ?>'" class="boton"/>
&nbsp;&nbsp;&nbsp;
<input name="NO" type="button" id="NO" value="  No  " onClick="self.location='index.php?cmd=locations'" class="boton"/></center>
<?


}
if ($page == "Remove") {

 $resp = $db->consulta("SELECT * FROM `locations` WHERE `id`='".$id."'");
		$Pictures = $db->fetch_array($resp);
		@unlink('../images/locations/'.$Pictures['pic1']);
		@unlink('../images/locations/medium_'.$Pictures['pic1']);
		@unlink('../images/locations/small_'.$Pictures['pic1']);
		
		@unlink('../images/locations/'.$Pictures['pic2']);
		@unlink('../images/locations/medium_'.$Pictures['pic2']);
		@unlink('../images/locations/small_'.$Pictures['pic2']);

		@unlink('../images/locations/'.$Pictures['pic3']);
		@unlink('../images/locations/medium_'.$Pictures['pic3']);
		@unlink('../images/locations/small_'.$Pictures['pic3']);

		@unlink('../images/locations/'.$Pictures['pic4']);
		@unlink('../images/locations/medium_'.$Pictures['pic4']);
		@unlink('../images/locations/small_'.$Pictures['pic4']);
		
		@unlink('../images/locations/'.$Pictures['pic5']);
		@unlink('../images/locations/medium_'.$Pictures['pic5']);
		@unlink('../images/locations/small_'.$Pictures['pic5']);
		
		@unlink('../images/locations/'.$Pictures['pic6']);
		@unlink('../images/locations/medium_'.$Pictures['pic6']);
		@unlink('../images/locations/small_'.$Pictures['pic6']);
		
		@unlink('../images/locations/'.$Pictures['pic7']);
		@unlink('../images/locations/medium_'.$Pictures['pic7']);
		@unlink('../images/locations/small_'.$Pictures['pic7']);
		
		@unlink('../images/locations/'.$Pictures['pic8']);
		@unlink('../images/locations/medium_'.$Pictures['pic8']);
		@unlink('../images/locations/small_'.$Pictures['pic8']);
		
		@unlink('../images/locations/'.$Pictures['pic9']);
		@unlink('../images/locations/medium_'.$Pictures['pic9']);
		@unlink('../images/locations/small_'.$Pictures['pic9']);
		
		@unlink('../images/locations/'.$Pictures['pic10']);
		@unlink('../images/locations/medium_'.$Pictures['pic10']);
		@unlink('../images/locations/small_'.$Pictures['pic10']);	

        $delete = $db->consulta("DELETE FROM `locations` WHERE `id`='".$id."'");
        ?>
<script language="javascript">
                <!--
                        document.location='index.php?cmd=locations';
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