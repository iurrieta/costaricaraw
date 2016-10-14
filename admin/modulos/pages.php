<?php
$db = new MySQL();
$query = $db->consulta("SELECT * FROM `administrator` WHERE `id`='".$_SESSION['CRR_AUserID']."'");
$sql = $db->fetch_array($query);

if($sql['m11'] == '1'):




$act = $_REQUEST['act'];
$id = $_REQUEST['id'];
$db = new MySQL();
include("fckeditor/fckeditor.php") ;
if ($act=="") {



?>
<form action="index.php?cmd=pages&act=" method="post" name="categoria">
<br><table   border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
  <tr><td width="239" align="center" valign="top"><br />
<input name="act" type="submit" value="Add Page" class="boton"><br /><br /><input name="act" type="submit" value="Edit Page" class="boton"><br /><br /><input  name="act" type="submit" value="Remove Page" class="boton"></td>
  <td width="281" align="center" valign="top">
    <select name="id" size="10" multiple style="width:280px;">
<option  disabled="disabled">--- Travel Info ---</option>	
<?               
$sql = $db->consulta("SELECT * FROM `pages` WHERE `seccion`='1' ORDER By `name`");
while($Pages=$db->fetch_array($sql)){
?>
		  
 <option value="<?=$Pages['id']?>">
                <?=$Pages['name']?>
          </option>
<? }  ?>   
<option  disabled="disabled">--- Costa Rica Living ---</option>	
<?               
$sql = $db->consulta("SELECT * FROM `pages` WHERE `seccion`='2' ORDER By `name`");
while($Pages=$db->fetch_array($sql)){
?>
		  
 <option value="<?=$Pages['id']?>">
                <?=$Pages['name']?>
          </option>
<? }  ?>    
 <option  disabled="disabled">--- Footer Page ---</option>	
<?               
$sql = $db->consulta("SELECT * FROM `pages` WHERE `seccion`='3' ORDER By `name`");
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
if ($act=="Edit Page") {

$query = $db->consulta("SELECT * FROM `pages` WHERE `id`='".$id."'");
$Page = $db->fetch_array($query);

?>

<form action="index.php?cmd=pages" method="post" enctype="multipart/form-data">
<input type="hidden" value="<?=$Page['id']?>" name="id">
<input type="hidden" value="update" name="act">
<table width="550"  border="0" align="center" cellpadding="1" cellspacing="0" class="main">
<tr>
<td height="35" colspan="2" align="center" ><h2>Edit Page</h2></td>
</tr><tr>
<td colspan="2" class="text"><strong>Page Name:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><input name="name" type="text" id="name" value="<?=$Page['name']?>" size="40" /></td>
  </tr>
<tr>
  <td colspan="2" class="text"><strong>Section:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><label for="section"></label>
    <select name="section" id="section">
      <option value="1" <?php if($Page['seccion']=="1") {?> selected="selected" <?php  } ?>>Travel Info</option>
      <option value="2" <?php if($Page['seccion']=="2") {?> selected="selected" <?php  } ?>>Costa Rica Living</option>
      <option value="3" <?php if($Page['seccion']=="3") {?> selected="selected" <?php  } ?>>Footer Link</option>
    </select></td>
</tr>

<tr>
  <td colspan="2" class="text"><strong>Order:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><label for="order"></label>
    <select name="order" id="order">
    <?php
	$query = $db->consulta("SELECT * FROM `pages`");
	$Order = $db->num_rows($query);
	 $COrder = $Order;
	 for ($j=1; $j < $COrder; $j++) {
	?>
      <option value="<?php echo $j; ?>" <?php if($Page['order']==$j){ echo "selected"; }?>>-- <?php echo $j; ?> --</option>
    <?php } ?>
    </select></td>
</tr>
<tr>
  <td colspan="2" class="text"><strong>Page Content:</strong></td>
  </tr>
<tr>
  <td colspan="2" class="text">
  <?php
$oFCKeditor = new FCKeditor('PageContent') ;
$oFCKeditor->BasePath = 'fckeditor/' ;
$oFCKeditor->Value = $Page['content'] ;
$oFCKeditor->Create() ;
?></td>
  </tr>
  <tr>
  <td colspan="2" class="text"><strong>Page Status:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text">
    <label>
      <input type="radio" name="status" value="1" id="status_0" <?php if($Page['status']==1) { echo "checked"; }?> />
      Enable</label>
&nbsp;&nbsp;&nbsp;    <label>
      <input type="radio" name="status" value="2" id="status_1" <?php if($Page['status']==2) { echo "checked"; }?>/>
      Disable</label>
  </td>
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
  <td colspan="2" class="text"><label for="description"></label>
       <input name="description" type="text" id="description" size="80" maxlength="120" value="<?php echo $Page['description']; ?>"></td>
  </tr>
  <tr>
    <td colspan="2" class="text">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="text">&nbsp;</td>
  </tr>

<tr align="center">
  <td height="35" class="standard"><input name="submit" type="submit" class="boton" value="Update">&nbsp;&nbsp;</td>
  <td class="standard"><input name="Cancelar" type="button" id="Cancelar" value="Cancel" onClick="self.location='index.php?cmd=pages'" class="boton"/></td>
  </tr>
</table>

</form>
<?
}
//////////////UPDATE USUARIO/////////////////////////////////////////////////////////////////////////////
if ($act=="update"){

$name = $_POST['name'];
$content = str_replace("'", "&acute;", $_POST['PageContent']);
$metas = $_POST['metas'];
$description = str_replace("'", "&acute;", $_POST['description']);
$section = $_POST['section'];
$order = $_POST['order'];
$status = $_POST['status'];

        $update = $db->consulta("UPDATE `pages` SET `name`='".$name."',`content`='".$content."',`metas`='".$metas."',`description`='".$description."',`seccion`='".$section."',`order`='".$order."',status='".$status."' WHERE `id`='".$id."'");


?>

<script language="javascript">
<!--
       document.location='index.php?cmd=pages';
//-->
</script>
<?
}

/////////////////Nuevo Usuario//////////////////////////////////////////////////////

if($act=="Add Page"){
	
?>


<form action="index.php?cmd=pages&act=save" method="post" enctype="multipart/form-data">
<input name="act" value="save" type="hidden">
<table width="95%" border="0" align="center" cellpadding="1" cellspacing="0" class="main">
<tr>
          <td height="35" colspan="2" align="center" ><h2>New Page</h2></td>
</tr>
<tr>
          <td colspan="2" class="text"><strong>Page Name:</strong></td>
    </tr>
<tr>
  <td colspan="2" class="text"><input type="text" class="cajas" size="40" name="name" id="name" /></td>
  </tr>
<tr>
  <td colspan="2" class="text"><strong>Section:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><label for="section"></label>
    <select name="section" id="section">
      <option value="1" selected="selected">Travel Info</option>
      <option value="2">Costa Rica Living</option>
      <option value="3">Footer Link</option>
    </select></td>
</tr>
<tr>
  <td colspan="2" class="text"><strong>Order:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><label for="order"></label>
    <select name="order" id="order">
    <?php
	$query = $db->consulta("SELECT * FROM `pages`");
	$Order = $db->num_rows($query);
	 $COrder = $Order+1;
	 for ($j=1; $j < $COrder; $j++) {
	?>
      <option value="<?php echo $j; ?>" <?php if($COrder==$j){ echo "selected"; }?>>-- <?php echo $j; ?> --</option>
    <?php } ?>
    </select></td>
</tr>
     <tr>
  <td colspan="2" valign="top" class="text"><strong>Page Content:</strong></td>
  </tr>
     <tr>
       <td colspan="2" valign="top" class="text">
	  <?php
$oFCKeditor = new FCKeditor('PageContent') ;
$oFCKeditor->BasePath = 'fckeditor/' ;
$oFCKeditor->Value = '' ;
$oFCKeditor->Create() ;
?>
       </td>
     </tr>
     <tr>
       <td colspan="2" valign="top" class="text"><strong>Keywords for Search engine robots: (170 words max.)</strong></td>
     </tr>
     <tr>
       <td colspan="2" valign="top" class="text"><label for="metas"></label>
       <input name="metas" type="text" id="metas" size="80" maxlength="170"></td>
     </tr>
     <tr>
       <td colspan="2" valign="top" class="text"><strong>Description for Search engine robots: (120 words max.)</strong></td>
     </tr>
     <tr>
       <td colspan="2" valign="top" class="text"><label for="description"></label>
       <input name="description" type="text" id="description" size="80" maxlength="120"></td>
     </tr>
     <tr>
       <td colspan="2" valign="top" class="text">&nbsp;</td>
     </tr>
     <tr>
       <td colspan="2" valign="top" class="text">&nbsp;</td>
     </tr>

    <tr align="center">
      <td height="35" align="center" class="standard"><input type="submit" value=" Save" class="boton"></td>
      <td height="35" align="center" class="standard"><input name="Cancelar2" type="button" id="Cancelar2" value="Cancel" onClick="self.location='index.php?cmd=pages'" class="boton"/></td>
    </tr>
</table>

</form>
<?
}
///////////////CHECK Contacto/////////////////////////////////////
if($act=="save"){


$name = $_POST['name'];
$content = str_replace("'", "&acute;", $_POST['PageContent']);
$metas = $_POST['metas'];
$description = str_replace("'", "&acute;", $_POST['description']);
$section = $_POST['section'];
$order = $_POST['order'];

      $ejecutar =  $db->consulta("INSERT INTO `pages` (`name`,`content`,`metas`,`description`,`seccion`,`order`) VALUES ('".$name."','".$content."','".$metas."','".$description."','".$section."','".$order."')");
		
	
        ?>
<script language="javascript">
                <!--
				       
                        document.location='index.php?cmd=pages';
                //-->
                </script>
        <?
}



//////////////////BORRAR USUARIO/////////////////////
if($act=="Remove Page"){


$resp = $db->consulta("SELECT * FROM `pages` WHERE `id`='".$id."'");
$Page = $db->fetch_array($resp);

if (!IsSet($page)) {
        $page = "confirm";
}

if ($page == "confirm") {

?>
<center>
        <br><br>
<span class="titulos">This action remove Page <em><strong><? echo $Page['name']; ?></strong></em>.</span><br><font color="#FF0000"><em>You sure?</em></font><br>

<br>
<input name="SI" type="button" id="YES" value="  Yes  " onClick="self.location='index.php?cmd=pages&act=Remove Page&page=Remove&id=<? echo $Page['id']; ?>'" class="boton"/>
&nbsp;&nbsp;&nbsp;
<input name="NO" type="button" id="NO" value="  No  " onClick="self.location='index.php?cmd=pages'" class="boton"/></center>
<?


}
if ($page == "Remove") {

        $delete = $db->consulta("DELETE FROM `pages` WHERE `id`='".$id."'");
        ?>
<script language="javascript">
                <!--
                        document.location='index.php?cmd=pages';
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