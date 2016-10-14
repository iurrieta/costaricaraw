<?php
$db = new MySQL();
$query = $db->consulta("SELECT * FROM `administrator` WHERE `id`='".$_SESSION['CRR_AUserID']."'");
$sql = $db->fetch_array($query);

if($sql['m2'] == '1'):




$act = $_REQUEST['act'];
$id = $_REQUEST['id'];
$db = new MySQL();

if ($act=="") {



?>
<form action="index.php?cmd=categorie&act=" method="post" name="categorie">
<br><table   border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
  <tr><td width="239" align="center" valign="top"><br />
<input name="act" type="submit" value="Add" class="boton"><br /><br /><input name="act" type="submit" value="Edit" class="boton"><br /><br /><input  name="act" type="submit" value="Remove" class="boton"><!--br /><br /><input  name="act" type="submit" value="Activate" class="boton"--></td>
  <td width="281" align="center" valign="top">
    <select name="id" size="10" multiple style="width:320px;">
<option disabled="disabled">--- Categories ---</option>	
<?               
$sql = $db->consulta("SELECT * FROM `categories` ORDER By `order` ASC");
while($Pages=$db->fetch_array($sql)){
	
	
?>
		  
 <option value="<?=$Pages['id']?>">
              <?=$Pages['name']?> 
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

$query = $db->consulta("SELECT * FROM `categories` WHERE `id`='".$id."'");
$Page = $db->fetch_array($query);

?>

<form action="index.php?cmd=categorie" method="post" enctype="multipart/form-data">
<input type="hidden" value="<?=$Page['id']?>" name="id">
<input type="hidden" value="update" name="act">
<table width="550"  border="0" align="center" cellpadding="1" cellspacing="0" class="main">
<tr>
<td height="35" colspan="2" align="center" ><h2>Edit Categorie</h2></td>
</tr><tr>
<td colspan="2" class="text"><strong>Categorie Name:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><input name="name" type="text" id="name" value="<?=$Page['name']?>" size="40" /></td>
  </tr>
   
  <tr>
    <td colspan="2" class="text"><strong>Order display:</strong></td>
  </tr>
  <tr>
    <td colspan="2" class="text"><label for="order"></label>
    <select name="order" id="order">
    <?php
	$query = $db->consulta("SELECT * FROM `categories`");
	$num = $db->num_rows($query);
	 $order = $num+1;
	 for ($j=1; $j < $order; $j++) {
	?>
      <option value="<?php echo $j; ?>" <?php if($Page['order']==$j){ echo "selected"; }?>>-- <?php echo $j; ?> --</option>
    <?php } ?>
    </select></td>
  </tr>
  <tr>
    <td colspan="2" class="text">Section</td>
  </tr>
  <tr>
    <td colspan="2" class="text"> <label>
      <input type="radio" name="section" value="1" id="section_0" <?php if($Page['section']==1) { echo "checked"; }?> />
      Adventure</label>
&nbsp;&nbsp;&nbsp;    <label>
      <input type="radio" name="section" value="2" id="section_1" <?php if($Page['section']==2) { echo "checked"; }?>/>
      Places to Stay</label>
       &nbsp;&nbsp;<label>
      <input type="radio" name="section" value="3" id="section_3" <?php if($Page['section']==3) { echo "checked"; }?>/>
      Affiliates Specials</label>
       &nbsp;&nbsp;
      </td>
  </tr>
  <tr>
    <td colspan="2" class="text">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="text">&nbsp;</td>
  </tr>

<tr align="center">
  <td height="35" class="standard"><input name="submit" type="submit" class="boton" value="Update">&nbsp;&nbsp;</td>
  <td class="standard"><input name="Cancelar" type="button" id="Cancelar" value="Cancel" onClick="self.location='index.php?cmd=categorie'" class="boton"/></td>
  </tr>
</table>

</form>
<?
}
//////////////UPDATE USUARIO/////////////////////////////////////////////////////////////////////////////
if ($act=="update"){


$name = $_POST['name'];
$order = $_POST['order'];
$section = $_POST['section'];
	 
	 
        $update = $db->consulta("UPDATE `categories` SET `name`='".$name."',`order`='".$order."',`section`='".$section."' WHERE `id`='".$id."'");
	 
	

?>

<script language="javascript">
<!--
       document.location='index.php?cmd=categorie';
//-->
</script>
<?
}

/////////////////Nuevo Usuario//////////////////////////////////////////////////////

if($act=="Add"){
	
?>


<form action="index.php?cmd=categorie&act=save" method="post" enctype="multipart/form-data">
<input name="act" value="save" type="hidden">
<input type="hidden" name="type" value="2" />
<table width="95%" border="0" align="center" cellpadding="1" cellspacing="0" class="main">
<tr>
          <td height="35" colspan="2" align="center" ><h2>New Categories</h2></td>
</tr>
<tr>
          <td colspan="2" class="text"><strong>Categorie Name:</strong></td>
    </tr>
<tr>
  <td colspan="2" class="text"><input type="text" class="cajas" size="40" name="name" id="name" /></td>
  </tr>
 <tr>
    <td colspan="2" class="text"><strong>Order display:</strong></td>
  </tr>
  <tr>
    <td colspan="2" class="text"><label for="order"></label>
    <select name="order" id="order">
    <?php
	$query = $db->consulta("SELECT * FROM `categories`");
	$num = $db->num_rows($query);
	 $order = $num+2;
	 for ($j=1; $j < $order; $j++) {
	?>
      <option value="<?php echo $j; ?>">-- <?php echo $j; ?> --</option>
    <?php } ?>
    </select></td>
  </tr>
     <td colspan="2" class="text">Section</td>
  </tr>
  <tr>
    <td colspan="2" class="text"> <label>
      <input name="section" type="radio" id="section_0" value="1" checked="checked"  />
      Adventure</label>
&nbsp;&nbsp;&nbsp;    <label>
      <input type="radio" name="section" value="2" id="section_1" />
      Places to Stay</label>
       &nbsp;&nbsp;
      <input type="radio" name="section" value="3" id="section_2" />
      Affiliates Specials
      </label>
       &nbsp;&nbsp;
      </td>
  </tr>
     <tr>
       <td colspan="2" valign="top" class="text">&nbsp;</td>
     </tr>
     <tr>
       <td colspan="2" valign="top" class="text">&nbsp;</td>
     </tr>

    <tr align="center">
      <td height="35" align="center" class="standard"><input type="submit" value=" Save" class="boton"></td>
      <td height="35" align="center" class="standard"><input name="Cancelar2" type="button" id="Cancelar2" value="Cancel" onClick="self.location='index.php?cmd=categorie'" class="boton"/></td>
    </tr>
</table>

</form>
<?
}
///////////////CHECK Contacto/////////////////////////////////////
if($act=="save"){


$name = $_POST['name'];
$order = $_POST['order'];
$section = $_POST['section'];

      $ejecutar =  $db->consulta("INSERT INTO `categories` (`name`,`order`,`section`) VALUES ('".$name."','".$order."','".$section."')");
	 
		
	
        ?>
<script language="javascript">
                <!--
				   document.location='index.php?cmd=categorie';
                //-->
                </script>
        <?
}



//////////////////BORRAR USUARIO/////////////////////
if($act=="Remove"){


$resp = $db->consulta("SELECT * FROM `categories` WHERE `id`='".$id."'");
$Page = $db->fetch_array($resp);

if (!IsSet($page)) {
        $page = "confirm";
}

if ($page == "confirm") {

?>
<center>
        <br><br>
<span class="titulos">This action remove Categorie <em><strong><? echo $Page['name']; ?></strong></em>.</span><br><font color="#FF0000"><em>You sure?</em></font><br>

<br>
<input name="SI" type="button" id="YES" value="  Yes  " onClick="self.location='index.php?cmd=categorie&act=Remove&page=Remove&id=<? echo $Page['id']; ?>'" class="boton"/>
&nbsp;&nbsp;&nbsp;
<input name="NO" type="button" id="NO" value="  No  " onClick="self.location='index.php?cmd=categorie'" class="boton"/></center>
<?


}
if ($page == "Remove") {

       
		$delete = $db->consulta("DELETE FROM `categories` WHERE `id`='".$id."'");
		
		
		
		
        ?>
<script language="javascript">
                <!--
                        document.location='index.php?cmd=categorie';
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
