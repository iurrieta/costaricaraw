<?php
$db = new MySQL();
$query = $db->consulta("SELECT * FROM `administrator` WHERE `id`='".$_SESSION['CRR_AUserID']."'");
$sql = $db->fetch_array($query);

if($sql['m4'] == '1'):




$act = $_REQUEST['act'];
$id = $_REQUEST['id'];
$db = new MySQL();

if ($act=="") {



?>
<form action="index.php?cmd=banner&act=" method="post" name="banner">
<br><table   border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
  <tr><td width="239" align="center" valign="top"><br />
<input name="act" type="submit" value="Add" class="boton"><br /><br /><input  name="act" type="submit" value="Edit" class="boton"> <br /><br /><input  name="act" type="submit" value="Remove" class="boton"><!--br /><br /><input  name="act" type="submit" value="Activate" class="boton"--></td>
  <td width="281" align="center" valign="top">
    <select name="id" size="10" multiple style="width:320px;">
<option disabled="disabled">--- Banners 1---</option>	
<?               
$sql = $db->consulta("SELECT * FROM `banner` WHERE `pos`='1' ORDER By `order` ASC");
while($Pages=$db->fetch_array($sql)){
	
	
?>
		  
<option value="<?=$Pages['id']?>">
              <?=$Pages['name']?> <?php if($Pages['type']=="1"){ echo "[Image]"; } else{ echo "[Text]"; } ?> <?php if($Pages['status']=="1"){ echo "&radic;";}else{ echo "&chi;"; }  ?>
</option>
<?
$pendiente = ""; 
$Tipo="";
}  
?> 

<option disabled="disabled">--- Banners 2---</option>	
<?               
$sql = $db->consulta("SELECT * FROM `banner` WHERE `pos`='2' ORDER By `order` ASC");
while($Pages=$db->fetch_array($sql)){
	
	
?>
		  
<option value="<?=$Pages['id']?>">
              <?=$Pages['name']?> <?php if($Pages['type']=="1"){ echo "[Image]"; } else{ echo "[Text]"; } ?> <?php if($Pages['status']=="1"){ echo "&radic;";}else{ echo "&chi;"; }  ?>
</option>
<?
$pendiente = ""; 
$Tipo="";
}  
?> 
  
    
	
 

</select></td>
  </tr>
  <tr>
  <td>&nbsp;
  
  </td>
  <td>&nbsp;
  
  </td>
  </tr>
  <tr>
  <td>
  <strong>Title Banners</strong>
  </td>
  </tr>
  
  <?               
$sql = $db->consulta("SELECT * FROM `banner_title`");
$Count = 1;
while($BannerTitle=$db->fetch_array($sql)){
?>
	 <tr>
  <td style="text-align:right; padding-right:30px;">	
  Banner <? echo $Count?>:
  </td>
  <td>
   <input type="text" class="cajas" size="40" name="namebanner<? echo $Count ?>" id="namebanner<? echo $Count ?>" value="<?=$BannerTitle['title']?>" />  

 </td>
  </tr>
  <? $Count = $Count + 1; ?>
<?
}
?>
  <tr>
  <td>&nbsp;
  
  </td>
  <td>
  <input  name="act" type="submit" value="Change" class="boton">
  </td>
  </tr>
   <!-- Charlie -->
  <tr>
  <td>
  <strong>Banners's Selection</strong>
  </td>
  </tr>
  <tr>
 
  	<td>
    <div style="float:left">
    Banner:
    </div>
   
    <?
	$query = $db->consulta("SELECT `title` FROM `banner_title` WHERE `id`='1'");
	$Title1 = $db->fetch_array($query);
	
	$query1 = $db->consulta("SELECT `title` FROM `banner_title` WHERE `id`='2'");
	$Title2 = $db->fetch_array($query1);
	?>
     <div style="float:left">
    <select onchange="Bannerchange(this.selectedIndex);">
     	<option value="1"  >
        <? echo $Title1['title']?>
        </option>
        <option value="2"  >
        <? echo $Title2['title']?>
        </option>
        </select>
        </div>
    </td>
 
  <td>
  <div id="divbanner1">
  <select multiple="multiple" id="chkmulBanner1">
  
  <? $sqlbanner1 = $db->consulta("Select B.`id`, B.`name` , IFNULL(AC.`count`, 0)  as count, B.`order` from `banner` B 
									left join  `affiliate_banner_counter` AC on B.`id` = AC.`idbanner` 
									where B.`pos` = 1 and B.`status` = 1 and AC.`idaffiliates` = -1
									Union
									
									Select `id`, `name` , 0, `order` from `banner` where `pos` = 1 and `status` = 1 and id not in (Select B.`id` from `banner` B 
									left join  `affiliate_banner_counter` AC on B.`id` = AC.`idbanner` 
									where B.`pos` = 1 and B.`status` = 1 and AC.`idaffiliates` = -1)
									
											Order by `order` ASC");
  	
		while($Banner1=$db->fetch_array($sqlbanner1)){
		?>	
     	<option value=" <? echo $Banner1['id'] ?> " <? 
		$sqlselebanner1 = $db->consulta("SELECT `idbanner` FROM `affiliates_banner` where `idaffiliate` = '-1'");
		while($SeleBanner1=$db->fetch_array($sqlselebanner1)){
		
				if( $Banner1['id'] == $SeleBanner1['idbanner'])
				{
					echo('selected'); 
					if ($SelectBanner1 == "")
					{
					$SelectBanner1 .= $SeleBanner1['idbanner'];
					}
					else
					{
						$SelectBanner1 .= ";".$SeleBanner1['idbanner'];
						}
					}
		}
		
		?>  >
        <? echo $Banner1['name'] ?> Clicks[<? echo $Banner1['count'] ?>]
        </option>
        <? } ?>
        </select>
  </div>
  <div id="divbanner2" >
  <select multiple="multiple" id="chkmulBanner2">
     	  <? $sqlbanner2 = $db->consulta("Select B.`id`, B.`name` , IFNULL(AC.`count`, 0)  as count, B.`order` from `banner` B 
									left join  `affiliate_banner_counter` AC on B.`id` = AC.`idbanner` 
									where B.`pos` = 2 and B.`status` = 1 and AC.`idaffiliates` = -1
									Union
									
									Select `id`, `name` , 0, `order` from `banner` where `pos` = 2 and `status` = 1 and id not in (Select B.`id` from `banner` B 
									left join  `affiliate_banner_counter` AC on B.`id` = AC.`idbanner` 
									where B.`pos` = 2 and B.`status` = 1 and AC.`idaffiliates` = -1)
									
											Order by `order` ASC");
		 
		while($Banner2=$db->fetch_array($sqlbanner2)){
		?>	
     	<option value=" <? echo $Banner2['id'] ?> "<?
		 $sqlselebanner2 = $db->consulta("SELECT `idbanner` FROM `affiliates_banner` where `idaffiliate` = '-1'");
        	while($SeleBanner2=$db->fetch_array($sqlselebanner2)){
				if($Banner2['id'] == $SeleBanner2['idbanner'])
				{
					
					echo 'selected'; 
					if ($SelectBanner2 == "")
					{
					$SelectBanner2 .= $SeleBanner2['idbanner'];
					}
					else
					{
						$SelectBanner2 .= ";".$SeleBanner2['idbanner'];
						}
					}
		}
		?>
         >
        <? echo $Banner2['name'] ?> <strong>Clicks[<? echo $Banner2['count'] ?>]</strong>
        </option>
        <? } ?>
        </select>
  </div>
  
  </td>
  <td>
 <input type="text" name="Banner1" id="Banner1" style="display:none" value="<? echo $SelectBanner1 ?>"  />
  <input type="text" name="Banner2" id="Banner2" style="display:none"  value="<? echo $SelectBanner2 ?>" />
  </td>
  </tr>
  <tr>
  <td>
   
  </td>
  <td>
   <input  name="act" type="submit" value="Modify"  class="boton">
  </td>	
  </tr>
</table></form>
 <script language="javascript">

 
	function Bannerchange(dato)
	{
		if (dato === 0)
		{
			var el = document.getElementById("divbanner2");
			el.style.display = "none";
			var el = document.getElementById("divbanner1");
			el.style.display = "";
			
			}
		if (dato === 1)
		{
			var el = document.getElementById("divbanner1");
			el.style.display = "none";
			var el = document.getElementById("divbanner2");
			el.style.display = "";
			
			}
	}
	
        $(document).ready(function () {
                     $("#chkmulBanner1").dropdownchecklist({ width: 200, maxDropHeight:150,
                         onComplete: function (selector) {
                             var values = "";
                             for (i = 0; i < selector.options.length; i++) {
                                 if (selector.options[i].selected && (selector.options[i].value != "")) {
                                     if (values != "") values += ";";
                                     values += selector.options[i].value;
                                 }
                             }
                             document.getElementById("Banner1").value = values;
                         }, textFormatFunction: function (options) {
                             var selectedOptions = options.filter(":selected");
                             var countOfSelected = selectedOptions.length;
                             var size = options.length;
                             switch (countOfSelected) {
                                 case 0: return "<i>None<i>";
                                 case 1: return selectedOptions.text();
                                 case options.length: return "<b>All</b>";
                                 default: return countOfSelected + " Banners";
                             }
                         }

                     });
                 });
				 
				 
				 $(document).ready(function () {
                     $("#chkmulBanner2").dropdownchecklist({ width: 200, maxDropHeight:150,
                         onComplete: function (selector) {
                             var values = "";
                             for (i = 0; i < selector.options.length; i++) {
                                 if (selector.options[i].selected && (selector.options[i].value != "")) {
                                     if (values != "") values += ";";
                                     values += selector.options[i].value;
                                 }
                             }
                             document.getElementById("Banner2").value = values;
                         }, textFormatFunction: function (options) {
                             var selectedOptions = options.filter(":selected");
                             var countOfSelected = selectedOptions.length;
                             var size = options.length;
                             switch (countOfSelected) {
                                 case 0: return "<i>None<i>";
                                 case 1: return selectedOptions.text();
                                 case options.length: return "<b>All</b>";
                                 default: return countOfSelected + " Banners";
                             }
                         }

                     });
                 });
				 
				 $(document).ready(function () {
	 var el = document.getElementById("divbanner2");
			el.style.display = "none";
 });

</script>

<?
}
if($act == "Modify")
{
	//Banners's Selection


$Value1 = explode(';',$_POST['Banner1']);
$Value2 = explode(';',$_POST['Banner2']);

$delete1 = $db->consulta("DELETE FROM `affiliates_banner` WHERE `idaffiliate` = '-1'");

if(count($Value1) > 0)
{
foreach( $Value1 as $i => $banners){
	
 $ejecutar =  $db->consulta("INSERT INTO `affiliates_banner` (`idaffiliate`,`idbanner`) values ('-1','".$Value1[$i]."')");

}
}

	  
if(count($Value2) > 0)
{
foreach( $Value2 as $y => $banners2){
	
 $ejecutar =  $db->consulta("INSERT INTO `affiliates_banner` (`idaffiliate`,`idbanner`) values ('-1','".$Value2[$y]."')");

}
?>
 <script language="javascript">
<!--

       document.location='index.php?cmd=banner&act='; 
	  
//-->
</script>
<?
} 
	}
if ($act == "Change")
{

	$namebanner1 = $_POST['namebanner1'];
	$namebanner2 = $_POST['namebanner2'];
	
	
	 $update = $db->consulta("UPDATE `banner_title` SET `title`='".$namebanner1."' WHERE `id`='1'");

	 $update1  = $db->consulta("UPDATE `banner_title` SET `title`='".$namebanner2."' WHERE `id`='2'");
	 
	 ?>
    
	 
	 <script language="javascript">
<!--

       document.location='index.php?cmd=banner&act='; 
	  
//-->
</script>

<?

}

///////////////////////EDITAR ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($act=="Edit") {

$query = $db->consulta("SELECT * FROM `banner` WHERE `id`='".$id."'");
$Page = $db->fetch_array($query);

?>

<form action="index.php?cmd=banner" method="post" enctype="multipart/form-data">
<input type="hidden" value="<?=$Page['id']?>" name="id">
<input type="hidden" value="update" name="act">
<input type="hidden" value="1" name="type">
<table width="550"  border="0" align="center" cellpadding="1" cellspacing="0" class="main">
<tr>
<td height="35" colspan="2" align="center" ><h2>Edit Banner</h2></td>
</tr>
<tr>
<td colspan="2" class="text"><strong>Banner Name:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><input name="name" type="text" id="name" value="<?=$Page['name']?>" size="40" /></td>
  </tr>
  
  <tr>
<td colspan="2" class="text"><strong>Banner Title:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><input name="title" type="text" id="title" value="<?=$Page['title']?>" size="40" /></td>
  </tr>
  
    <tr>
    <td colspan="2" class="text"><strong>Location</strong></td>
  </tr>
   <tr>
    <td colspan="2" class="text"><select name="location">
   <option value="">No Location</option>
  <?php
	  $sqlLocation = $db->consulta("SELECT * FROM `locations` Order by `name` ASC");
	  while($Location=$db->fetch_array($sqlLocation)){
		  ?> 
       <option value="<?php echo $Location['id']; ?>" <?php if($Location['id']==$Page['location']){ echo "selected"; } ?>><?php echo $Location['name']; ?></option>
       <?php } ?>
    
    </select></td>
  </tr>
  
  <tr>
    <td colspan="2" class="text"><strong>Position</strong></td>
  </tr>
  <tr>
    <td colspan="2" class="text"><input type="radio" name="pos" value="1" id="pos_0" <?php if($Page['pos']==1) { echo "checked"; }?>/>Top &nbsp;&nbsp;<input type="radio" name="pos" value="2" id="pos_1" <?php if($Page['pos']==2) { echo "checked"; }?>/>Bottom</td>
  </tr>
  <tr>
    <td colspan="2" class="text"><strong>Order</strong></td>
  </tr>
  <tr>
    <td colspan="2" class="text"><select name="order" >
    <!--Esto lo esta haciendo Charlie-->
     <?php
	  $sqlOrder = $db->consulta("SELECT Max(`order`) as `CantidadMax` FROM `banner` WHERE `status`='1' and `pos` ='".$Page['pos']."'");
	 $Order = $db->fetch_array($sqlOrder);
		  for ($i= 1; $i <= $Order['CantidadMax']; $i ++)
		  {
		  
		  ?> 
       <option value="<?php echo $i?>" <?php if($i==$Page['order']){ echo "selected"; } ?>><?php echo $i; ?></option>
       <?php } ?> 
    </select>
    </td>
  </tr>
 <tr>
    <td colspan="2" class="text"><strong>Banner Imagen:</strong></td>
  </tr>
  <tr>
    <td colspan="2" class="text"><input type="file" name="banner" id="banner" /></td>
  </tr>
 
  <tr>
    <td colspan="2" class="text"><strong>Banner Link:</strong></td>
  </tr>
  <tr>
    <td colspan="2" class="text"><input name="link" type="text" id="link" value="<?=$Page['link']?>" size="35" /></td>
  </tr>
  
  
  <tr>
     <td colspan="2" class="text"><strong>Enable</strong></td>																																																																																																																																																																																																																																																																																														
  </tr>
  <tr>
    <td colspan="2" class="text"> <label>
      <input name="status" type="radio" id="section_0" value="1" <?php if($Page['status']==1) { echo "checked"; }?> />
      Yes</label>
&nbsp;&nbsp;&nbsp;    <label>
      <input type="radio" name="status" value="2" id="section_1" <?php if($Page['status']==2) { echo "checked"; }?>/>
      No</label>
       &nbsp;&nbsp;
      </td>
  </tr>
  
  <tr>
    <td colspan="2" class="text"><?php if($Page['image']){  ?><img src="../banner/<?=$Page['image']?>" alt="" /><?php } ?></td>
  </tr>
  <tr>
    <td colspan="2" class="text">&nbsp;</td>
  </tr>

<tr align="center">
  <td height="35" class="standard"><input name="submit" type="submit" class="boton" value="Update">&nbsp;&nbsp;</td>
  <td class="standard"><input name="Cancelar" type="button" id="Cancelar" value="Cancel" onClick="self.location='index.php?cmd=banner'" class="boton"/></td>
  </tr>
</table>

</form>
<?
}
//////////////UPDATE USUARIO/////////////////////////////////////////////////////////////////////////////
if ($act=="update"){
	
$query2 = $db->consulta("SELECT * FROM `banner` WHERE `id`='".$id."'");
$Page2 = $db->fetch_array($query2);

$name = $_POST['name'];
$status = $_POST['status'];
$type = $_POST['type'];
$content = $_POST['text'];
$link = $_POST['link'];
$pos = $_POST['pos'];
$location =$_POST['location'];
$title = $_POST['title'];
 $order = $_POST['order'];


if($Page2['status']== 1 && $_POST['status'] == 2)
{
	 $update = $db->consulta("Update `banner` set `order` = (`order`-1) where `status` = '1' and `pos` = '".$Page2['pos']."' and `order` > '".$Page2['order']."'");
	 
	 $order = $_POST['order'];
	}
else if( $Page2['status']== 2 && $_POST['status'] == 1 )
{
	 $sqlOrder = $db->consulta("SELECT Max(`order`) as `CantidadMax` FROM `banner` WHERE `status`='1' and `pos` ='".$Page2['pos']."'");
	 $Order = $db->fetch_array($sqlOrder);
	$order = ($Order['CantidadMax']+1);
	
	}
else if($Page2['order'] != $_POST['order'])
{	 
 
	  $sqlIDPChange = $db->consulta("SELECT `id`  FROM `banner` WHERE `status`='1' and `pos` ='".$Page2['pos']."' and `order` ='".$_POST['order']."'");
	
	   
	 $PostOrder = $db->fetch_array($sqlIDPChange);
	 echo  $PostOrder['id'];
	 $update = $db->consulta("Update `banner` set `order` = '".$Page2['order']."' where `id` = '".$PostOrder['id']."'");
	 
	 $order = $_POST['order'];
	}



if($_FILES['banner']==""){
	
}else{
	
	if (move_uploaded_file($_FILES['banner']['tmp_name'], "../banner/".$_FILES['banner']['name']))
	{
		$image = $_FILES['banner']['name'];
		$update = $db->consulta("UPDATE `banner` SET `image`='".$image."' WHERE `id`='".$id."'");
	}
}
	
	 
        $update = $db->consulta("UPDATE `banner` SET `name`='".$name."',`status`='".$status."',`type`='".$type."',`content`='".$content."',`link`='".$link."',`order`='".$order."',`pos`='".$pos."',`location`='".$location."',`title`='".$title."' WHERE `id`='".$id."'");

	 
	

?>

<script language="javascript">
<!--
       document.location='index.php?cmd=banner';
//-->
</script>
<?
}

/////////////////Nuevo Usuario//////////////////////////////////////////////////////

if($act=="Add"){
	
?>


<form action="index.php?cmd=banner&act=save" method="post" enctype="multipart/form-data">
<input name="act" value="save" type="hidden">
<input name="type" value="1" type="hidden">
<table width="95%" border="0" align="center" cellpadding="1" cellspacing="0" class="main">
<tr>
          <td height="35" colspan="2" align="center" ><h2>New Banner</h2></td>
</tr>
<tr>
          <td colspan="2" class="text"><strong>Banner Name:</strong></td>
    </tr>
    
    
<tr>
  <td colspan="2" class="text"><input type="text" class="cajas" size="40" name="name" id="name" /></td>
  </tr>
  
    <tr>
<td colspan="2" class="text"><strong>Banner Title:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><input name="title" type="text" id="title" value="<?=$Page['title']?>" size="40" /></td>
  </tr>
  
  
  <tr>
    <td colspan="2" class="text"><strong>Location</strong></td>
  </tr>
    <tr>
    <td colspan="2" class="text"> <select name="location" id="location">  
    <option value="0" selected disabled>Select Location</option>
    <option value="">No Location</option>
      <?php
	  $sqlLocation = $db->consulta("SELECT * FROM `locations` Order by `name` ASC");
	  while($Location=$db->fetch_array($sqlLocation)){
		  ?> 
       <option value="<?php echo $Location['id']; ?>"><?php echo $Location['name']; ?></option>
       <?php } ?></select></td>
  </tr>

  <tr>
    <td colspan="2" class="text"><strong>Position</strong></td>
  </tr>
  <tr>
    <td colspan="2" class="text"><input type="radio" name="pos" value="1" id="pos_0" checked="checked"/>Top &nbsp;&nbsp;<input type="radio" name="pos" value="2" id="pos_1"/>Bottom</td>
  </tr>

  
  
 <tr>
    <td colspan="2" class="text"><strong>Banner Imagen:</strong></td>
  </tr>
  <tr>
    <td colspan="2" class="text"><input type="file" name="banner" id="banner" /></td>
  </tr>
 
  <tr>
    <td colspan="2" class="text"><strong>Banner Link:</strong></td>
  </tr>
  <tr>
    <td colspan="2" class="text"><input name="link" type="text" id="link" value="" size="35" /></td>
  </tr>
  
  
  <tr>
     <td colspan="2" class="text"><strong>Enable</strong></td>
  </tr>
  <tr>
    <td colspan="2" class="text"> <label>
      <input name="status" type="radio" id="section_0" value="1" checked="checked"  />
      Yes</label>
&nbsp;&nbsp;&nbsp;    <label>
      <input type="radio" name="status" value="2" id="section_1" />
      No</label>
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
      <td height="35" align="center" class="standard"><input name="Cancelar2" type="button" id="Cancelar2" value="Cancel" onClick="self.location='index.php?cmd=banner'" class="boton"/></td>
    </tr>
</table>

</form>
<?
}
///////////////CHECK Contacto/////////////////////////////////////
if($act=="save"){


$name = $_POST['name'];
$status = $_POST['status'];
$type = $_POST['type'];
$content = $_POST['text'];
$link = $_POST['link'];

$pos = $_POST['pos'];

 $sqlOrder = $db->consulta("SELECT Max(`order`) as `CantidadMax` FROM `banner` WHERE `status`='1' and `pos` ='".$_POST['pos']."'");
	 $Order = $db->fetch_array($sqlOrder);
	 
$order = $Order['CantidadMax']+1;
$location = $_POST['location'];
$title = $_POST['title'];


if($_FILES['banner']==""){
	
}else{
	
	if (move_uploaded_file($_FILES['banner']['tmp_name'], "../banner/".$_FILES['banner']['name']))
	{
		$image = $_FILES['banner']['name'];
		
	}
}

      $ejecutar =  $db->consulta("INSERT INTO `banner` (`name`,`status`,`image`,`content`,`link`,`type`,`order`,`pos`,`location`,`title`) VALUES ('".$name."','".$status."','".$image."','".$content."','".$link."','".$type."','".$order."','".$pos."','".$location."','".$title."')");
	 
		
	
        ?>
<script language="javascript">
                <!--
				   document.location='index.php?cmd=banner';
                //-->
                </script>
        <?
}



//////////////////BORRAR USUARIO/////////////////////
if($act=="Remove"){

$page = $_REQUEST['page']; 
$resp = $db->consulta("SELECT * FROM `banner` WHERE `id`='".$id."'");
$Page = $db->fetch_array($resp);

	if ($page == "") {
	
	?>
	<center>
			<br><br>
	<span class="titulos">This action remove Banner <em><strong><? echo $Page['name']; ?></strong></em>.</span><br><font color="#FF0000"><em>You sure?</em></font><br>
	
	<br>
	<input name="SI" type="button" id="YES" value="  Yes  " onClick="self.location='index.php?cmd=banner&act=Remove&page=confirm&id=<? echo $Page['id']; ?>&banner=<?=$Page['image']?>'" class="boton"/>
	&nbsp;&nbsp;&nbsp;
	<input name="NO" type="button" id="NO" value="  No  " onClick="self.location='index.php?cmd=banner'" class="boton"/></center>
	<?
	
	
	}
	if ($page == "confirm") {
	
			@unlink('../banner/'.$_REQUEST['banner']);
			
			 $update = $db->consulta( "Update `banner` set `order` = (`order`-1) where `status` = '1' and `pos` = '".$Page['pos']."' and `order` > '".$Page['order']."';");
	
			$delete = $db->consulta("DELETE FROM `banner` WHERE `id`='".$id."'");
		   ?>
	<script language="javascript">
					<!--
							document.location='index.php?cmd=banner';
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
