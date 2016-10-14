<?php
$db = new MySQL();
$query = $db->consulta("SELECT * FROM `administrator` WHERE `id`='".$_SESSION['CRR_AUserID']."'");
$sql = $db->fetch_array($query);

if($sql['m3'] == '1'):




$act = $_REQUEST['act'];
$id = $_REQUEST['id'];
$db = new MySQL();
include("fckeditor/fckeditor.php") ;
?>
<link rel="stylesheet" type="text/css" media="screen" href="../css/datePicker.css">
<!-- required plugins -->
<script type="text/javascript" src="../js/date.js"></script>
<!--[if IE]><script type="text/javascript" src="../js/jquery.bgiframe.js"></script><![endif]-->
<!-- jquery.datePicker.js -->
<script type="text/javascript" src="../lib/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.datePicker.js"></script>
<script type="text/javascript" charset="utf-8">

$(function()

{

	$('.date-pick')

		.datePicker()

		.bind(

			'focus',

			function()

			{

				$(this).dpDisplay();

			}

		).bind(

			'blur',

			function(event)

			{

				// works good in Firefox... But how to get it to work in IE?

				if ($.browser.mozilla) {



					var el = event.explicitOriginalTarget

					

					var cal = $('#dp-popup')[0];

				

					while (true){

						if (el == cal) {

							return false;

						} else if (el == document) {

							$(this).dpClose();

							return true;

						} else {

							el = $(el).parent()[0];

						}

					}

				}

			}

		);

});


function popUp(URL) {

day = new Date();

id = day.getTime();

eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=910,height=350');");

}

		</script>

<?php
        
if ($act=="") {



?>
<form action="index.php?cmd=adventures&act=" method="post" name="categoria">
<br><table   border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
  <tr><td width="239" align="center" valign="top"><br />
<input name="act" type="submit" value="Add" class="boton"><br /><br /><input name="act" type="submit" value="Edit" class="boton"><br /><br /><input  name="act" type="submit" value="Remove" class="boton"></td>
  <td width="281" align="center" valign="top">
    <select name="id" size="10" multiple style="width:280px;">
<option disabled="disabled">------ RAW Adventures ------</option>	
<?               
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `section`='1' ORDER By `name`");
while($Pages=$db->fetch_array($sql)){
?>
		  
 <option value="<?=$Pages['id']?>">
                <?=$Pages['name']?>
          </option>
<? 
}  
?>
<option disabled="disabled">------ Affiliate Adventures ------</option>	
<?               
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `section`='5' ORDER By `name`");
while($Pages=$db->fetch_array($sql)){
?>
		  
 <option value="<?=$Pages['id']?>">
                <?=$Pages['name']?>
          </option>
<? 
}  
?>
<option disabled="disabled">------ Places to Stay ------</option>	
<?               
$sqlCategorie = $db->consulta("SELECT * FROM `categories` WHERE `section`='2'  Order by `name` ASC");
while($Categorie=$db->fetch_array($sqlCategorie)){
?>		  
<option disabled="disabled">------- <?=$Categorie['name']?> -------</option>	
<?php		              
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `section`='8' AND `categorie`='".$Categorie['id']."' ORDER By `count` DESC");
while($Pages=$db->fetch_array($sql)){
?>
		  
 <option value="<?=$Pages['id']?>">
                <?=$Pages['name']?> [<?=$Pages['count']?>]
          </option>
<?php
}  
}
$sqlCategorie = $db->consulta("SELECT * FROM `categories` WHERE `section`='1' Order by `name` ASC");
while($Categorie=$db->fetch_array($sqlCategorie)){
?>		  
<option disabled="disabled">------- <?=$Categorie['name']?> -------</option>	
<?php		              
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `section`='2' AND `categorie`='".$Categorie['id']."' ORDER By `count` DESC");
while($Pages=$db->fetch_array($sql)){
?>
		  
 <option value="<?=$Pages['id']?>">
                <?=$Pages['name']?> [<?=$Pages['count']?>]
          </option>
<?php
}  
}
?>    

<option disabled="disabled">------ Special ------</option>	
<?               
$sqlCategorie = $db->consulta("SELECT * FROM `categories` WHERE `section`='3'  Order by `name` ASC");
while($Categorie=$db->fetch_array($sqlCategorie)){
?>		  
<option disabled="disabled">------- <?=$Categorie['name']?> -------</option>	
<?php		              
	$sql = $db->consulta("SELECT * FROM `adventures` WHERE `categorie`='".$Categorie['id']."' ORDER By `count` DESC");
	while($Pages=$db->fetch_array($sql)){
	?>
			  
	 <option value="<?=$Pages['id']?>">
					<?=$Pages['name']?> [<?=$Pages['count']?>]
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

$query = $db->consulta("SELECT * FROM `adventures` WHERE `id`='".$id."'");
$Page = $db->fetch_array($query);

?>

<form action="index.php?cmd=adventures" method="post" enctype="multipart/form-data">
<input type="hidden" value="<?=$Page['id']?>" name="id">
<input type="hidden" value="update" name="act">
<table width="95%"  border="0" align="center" cellpadding="1" cellspacing="0" class="main">
<tr>
<td height="35" colspan="2" align="center" ><h2>Edit Adventure</h2></td>
</tr><tr>
<td colspan="2" class="text"><strong>Name:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><input name="name" type="text" id="name" value="<?=$Page['name']?>" size="40" /></td>
  </tr>
<tr>
  <td colspan="2" class="text"><strong>Email Notification:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><label for="emailnot"></label>
    <input name="emailnot" type="text" id="emailnot" size="40" value="<?=$Page['emailnot']?>"/></td>
</tr>
<tr>
  <td colspan="2" class="text"><strong>Location:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><label for="location"></label>
    <select name="location" id="location">
      <option value="0" disabled>Select Location</option>
      <?php
	  $sqlLocation = $db->consulta("SELECT * FROM `locations` Order by `name` ASC");
	  while($Location=$db->fetch_array($sqlLocation)){
		  ?> 
       <option value="<?php echo $Location['id']; ?>" <?php if($Location['id']==$Page['locations_id']){ echo "selected"; } ?>><?php echo $Location['name']; ?></option>
       <?php } ?>
    </select></td>
</tr>
<tr>
  <td colspan="2" class="text"><strong>Categorie:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><label for="categorie"></label>
    <select name="categorie" id="categorie">
      <option value="0" disabled>Select Categorie</option>
      <?php
	  $sqlCategorie = $db->consulta("SELECT * FROM `categories` Order by `name` ASC");
	  while($Categorie=$db->fetch_array($sqlCategorie)){
		  ?> 
       <option value="<?php echo $Categorie['id']; ?>" <?php if($Categorie['id']==$Page['categorie']){ echo "selected"; } ?>><?php echo $Categorie['name']; ?></option>
       <?php } ?>
    </select></td>
</tr>
<tr>
  <td colspan="2" class="text"><strong>Adventure Section:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text">
    <label>
      <input type="radio" name="section" value="1" id="section_0" <?php if($Page['section']==1) { echo "checked"; }?> />
      Raw Adventure</label>
&nbsp;&nbsp;&nbsp;    <label>
      <input type="radio" name="section" value="2" id="section_1" <?php if($Page['section']==2) { echo "checked"; }?>/>
      Adventure</label>
       &nbsp;&nbsp;
        <input type="radio" name="section" value="8" id="section_3" <?php if($Page['section']==8) { echo "checked"; }?>/>
      Places to Stay</label>
       &nbsp;&nbsp;
        
           <input type="radio" name="section" value="5" id="section_2" <?php if($Page['section']=="5"){ echo "checked"; } ?>>
           Affiliates Adventure
        
  </td>
</tr>
 <tr>
       <td colspan="2" valign="top" class="text"><strong>Adventure Status:</strong></td>
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
  <td colspan="2" class="text"><strong>Order:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><label for="order"></label>
    <select name="order" id="order">
    <?php
	$query = $db->consulta("SELECT * FROM `adventures`");
	$Order = $db->num_rows($query);
	 
	 for ($j=1; $j < $Order; $j++) {
	?>
      <option value="<?php echo $j; ?>" <?php if($Page['order']==$j){ echo "selected"; }?>>-- <?php echo $j; ?> --</option>
    <?php } ?>
    </select></td>
</tr>
<tr>
  <td colspan="2" class="text"><strong>Top Adventure</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><b>
    <label>
      <input type="radio" name="topad" value="1" id="topad_0" <?php if($Page['topad']==1){ echo "checked"; }?>/>
      Yes</label>
  &nbsp;&nbsp;
    <label>
      <input type="radio" name="topad" value="0" id="topad_1" <?php if($Page['topad']==0){ echo "checked"; }?>/>
      No</label>
    
    </b></td>
</tr>
      <tr>
        <td colspan="2" class="text"><strong>Specials</strong></td>
      </tr>
      <tr>
        <td colspan="2" class="text"><b>
          <label>
            <input type="radio" name="special" value="1" id="topad_2" <?php if($Page['special']==1){ echo "checked"; }?>/>
            Yes</label>
          &nbsp;&nbsp;
          <label>
            <input type="radio" name="special" value="0" id="topad_3" <?php if($Page['special']==0){ echo "checked"; }?>/>
            No</label>
        </b></td>
      </tr>
      <tr>
        <td colspan="2" valign="top" class="text"><strong>Price Specials</strong> </td>
      </tr>
      <tr>
        <td colspan="2" valign="top" class="text">
        <input name="special_price" type="text" id="special_price" value="<?=$Page['special_price']?>" size="12" /></td>
      </tr>
      <tr>
       <td colspan="2" valign="top" class="text"><strong>Adventure Times</strong></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text"><strong><a href="javascript:popUp('modulos/special.time.php?adventure=<?=$Page['id']?>');">Click Here for Add/Edit Adventure Times</a></strong></td>
     </tr>
     
    
     <tr>
       <td colspan="2" valign="top" class="text"><strong>Specials Dates:</strong></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text"><strong><a href="javascript:popUp('modulos/special.date.php?adventure=<?=$Page['id']?>');">Click Here for Add Date</a></strong></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text"><strong>Deposit amount$:</strong></td>
     </tr>
     <tr>
       <td colspan="2" valign="top" class="text"><label for="deposit"></label>
       <input type="text" name="deposit" id="deposit" class="cajas" value="<?=$Page['deposit']?>" /></td>
     </tr>
      <tr>
      <td colspan="2"><strong>Days Enabled:</strong></td>
    </tr>
      <tr>
      <td colspan="2">
          <?
      $dias = unserialize($Page['days']);
	
        for ($i = 0; $i < count($dias); $i++)
 {
	
if($dias[$i]=="Monday"){
$lunes = "checked";
}
if($dias[$i]=="Tuesday"){
$martes = "checked";
}
if($dias[$i]=="Wednesday"){
$miercoles = "checked";
}
if($dias[$i]=="Thursday"){
$jueves = "checked";
}
if($dias[$i]=="Friday"){
$viernes = "checked";
}
if($dias[$i]=="Saturday"){
$sabado = "checked";
}
if($dias[$i]=="Sunday"){
$domingo = "checked";
}

	 
 }
 
 ?>
          <input type="checkbox" name="dias[]" id="dias" value="Monday" <?=$lunes?> >Monday &nbsp;
          <input type="checkbox" name="dias[]"  id="dias" value="Tuesday" <?=$martes?>>Tuesday &nbsp;
          <input type="checkbox" name="dias[]"  id="dias" value="Wednesday" <?=$miercoles?> >Wednesday &nbsp;
          <input type="checkbox" name="dias[]"  id="dias" value="Thursday" <?=$jueves?> >Thursday &nbsp;
          <input type="checkbox" name="dias[]"  id="dias" value="Friday" <?=$viernes?> >Friday &nbsp;
          <input type="checkbox" name="dias[]"  id="dias" value="Saturday" <?=$sabado?> >Saturday &nbsp;
          <input type="checkbox" name="dias[]"  id="dias" value="Sunday" <?=$domingo?> >Sunday &nbsp;</td>
    </tr>
      <tr>
        <td colspan="2" class="text"><strong>Pick-up Option:</strong></td>
      </tr>
      <tr>
        <td colspan="2" class="text">
          <label>
            <input type="radio" name="pickup" value="0" id="pickup_0" <?php if($Page['pickup']==0) { echo "checked"; } ?> />
            No</label>
         &nbsp;&nbsp;
          <label>
            <input type="radio" name="pickup" value="1" id="pickup_1" <?php if($Page['pickup']==1) { echo "checked"; } ?>/>
            Yes</label>
       </td>
      </tr>
      <tr>
        <td colspan="2" class="text"><strong>Pick-up Note:</strong></td>
      </tr>
      <tr>
        <td colspan="2" class="text"><label for="pickupnote">
        <textarea name="pickupnote" id="pickupnote" cols="30" rows="3"><?=$Page['note']?></textarea></label></td>
      </tr>
      <tr>
        <td colspan="2" class="text"><strong>Special note:</strong></td>
      </tr>
      <tr>
        <td colspan="2" class="text"><label for="specialnote"></label>
        <textarea name="specialnote" id="specialnote" cols="30" rows="3"><?=$Page['specialnote']?></textarea></td>
      </tr>
      
		<tr>
        <td colspan="2" class="text"><strong>Widget Chat:</strong></td>
      </tr>
      <tr>
        <td colspan="2" class="text"><label for="chat"></label>
        <textarea name="chat" id="chat" cols="70" rows="4"><?=$Page['chat']?></textarea></td>
      </tr>
      <tr>
        <td colspan="2" class="text"><strong>Confirmation Code:</strong></td>
      </tr>
      <tr>
        <td colspan="2" class="text"><label for="code"></label>
        
              <input type="radio" name="code" value="" id="code_0" <?php if($Page['code']==""){ echo "checked"; } ?> />No &nbsp;&nbsp;<input type="radio" name="code" value="1" id="code_1" <?php if($Page['code']=="1"){ echo "checked"; } ?> />Yes</td>
      </tr>
            <tr>
        <td colspan="2" class="text"><strong>Confirmation Code Note:</strong></td>
      </tr>
      <tr>
        <td colspan="2" class="text"><label for="notecode"></label>
         <textarea name="notecode" id="notecode" cols="30" rows="3"><?=$Page['notecode']?></textarea></td>
      </tr>
      <tr>
        <td colspan="2" class="text">&nbsp;</td>
      </tr>
      
      <tr>
  <td colspan="2" class="text"><strong>Information:</strong></td>
  </tr>
<tr>
  <td colspan="2" class="text">
  <?php
$oFCKeditor = new FCKeditor('information') ;
$oFCKeditor->BasePath = 'fckeditor/' ;
$oFCKeditor->Value = $Page['information'] ;
$oFCKeditor->Width = '100%' ;
$oFCKeditor->Height = '300' ;
$oFCKeditor->Create() ;
?></td>
  </tr>
<tr>
  <td colspan="2" class="text"><strong>Brochure:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"> <input type="file" name="flyer" id="flyer" size="1">&nbsp;&nbsp;<?php if($Page['flyer']){ ?>&nbsp;&nbsp;<a href="modulos/removeBrochure.php?adv=<?=$Page['id']?>&flyer=<?=$Page['flyer']?>" target="_new">Remove Brochure</a><?php } ?></td>
</tr>
<tr>
  <td colspan="2" class="text">Brochure Text:</td>
</tr>
<tr>
  <td colspan="2" class="text"><input name="flyertext" type="text" value="<?=$Page['flyertext']?>" size="35" maxlength="90" /><span style="font-size:9px">90 characters max.</span></td>
</tr>
<tr>
  <td colspan="2" class="text">Brochure Type:</td>
</tr>
<tr>
  <td colspan="2" class="text">
      <label>
        <input type="radio" name="flyertype" value="doc" id="flyertype_0" <?php if($Page['flyertype']=="doc"){ echo "checked"; } ?>/>
        Document</label>
    
      <label>
        <input type="radio" name="flyertype" value="img" id="flyertype_1" <?php if($Page['flyertype']=="img"){ echo "checked"; } ?>/>
        Image</label>
    </td>
</tr>
<tr>
  <td colspan="2" class="text">Image for Doc:</td>
</tr>
<tr>
  <td colspan="2" class="text"> <input type="file" name="flyerimg" id="flyerimg" size="1">&nbsp;&nbsp;<?php if($Page['flyerimg']){ ?>&nbsp;&nbsp;<a href="modulos/removeBrochure.php?adv=<?=$Page['id']?>&flyer=<?=$Page['flyerimg']?>&cc=img" target="_new">Remove Brochure</a><?php } ?></td>
</tr>


    <tr>
       <td colspan="2" valign="top" class="text"><strong>Pictures:</strong></td>
     </tr>
     <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto1" id="foto1" size="1">&nbsp;&nbsp;<?php if($Page['pic1']){ ?><img src="../images/adventures/small_<?=$Page['pic1']?>" height="50" align="absmiddle" alt="<?=$Page['pic1']?>" title="<?=$Page['pic1']?>" />&nbsp;&nbsp;<a href="modulos/resize.php?picture=<?=$Page['pic1']?>" target="_new">Resize Picture</a>&nbsp;&nbsp;<a href="modulos/removePicture.php?picture=<?=$Page['pic1']?>&adv=<?=$Page['id']?>&picID=1" target="_new">Remove Picture 1</a><?php } ?></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto2" id="foto2" size="1">&nbsp;&nbsp;<?php if($Page['pic2']){ ?><img src="../images/adventures/small_<?=$Page['pic2']?>" height="50" align="absmiddle" alt="<?=$Page['pic2']?>" title="<?=$Page['pic2']?>" />&nbsp;&nbsp;<a href="modulos/resize.php?picture=<?=$Page['pic2']?>" target="_new">Resize Picture</a>&nbsp;&nbsp;<a href="modulos/removePicture.php?picture=<?=$Page['pic2']?>&adv=<?=$Page['id']?>&picID=2" target="_new">Remove Picture 2</a><?php } ?></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto3" id="foto3" size="1">&nbsp;&nbsp;<?php if($Page['pic3']){ ?><img src="../images/adventures/small_<?=$Page['pic3']?>" height="50" align="absmiddle" alt="<?=$Page['pic3']?>" title="<?=$Page['pic3']?>" />&nbsp;&nbsp;<a href="modulos/resize.php?picture=<?=$Page['pic3']?>" target="_new">Resize Picture</a>&nbsp;&nbsp;<a href="modulos/removePicture.php?picture=<?=$Page['pic3']?>&adv=<?=$Page['id']?>&picID=3" target="_new">Remove Picture 3</a><?php } ?></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto4" id="foto4" size="1">&nbsp;&nbsp;<?php if($Page['pic4']){ ?><img src="../images/adventures/small_<?=$Page['pic4']?>" height="50" align="absmiddle" alt="<?=$Page['pic4']?>" title="<?=$Page['pic4']?>" />&nbsp;&nbsp;<a href="modulos/resize.php?picture=<?=$Page['pic4']?>" target="_new">Resize Picture</a>&nbsp;&nbsp;<a href="modulos/removePicture.php?picture=<?=$Page['pic4']?>&adv=<?=$Page['id']?>&picID=4" target="_new">Remove Picture 4</a><?php } ?></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto5" id="foto5" size="1">&nbsp;&nbsp;<?php if($Page['pic5']){ ?><img src="../images/adventures/small_<?=$Page['pic5']?>" height="50" align="absmiddle" alt="<?=$Page['pic5']?>" title="<?=$Page['pic5']?>" />&nbsp;&nbsp;<a href="modulos/resize.php?picture=<?=$Page['pic5']?>" target="_new">Resize Picture</a>&nbsp;&nbsp;<a href="modulos/removePicture.php?picture=<?=$Page['pic5']?>&adv=<?=$Page['id']?>&picID=5" target="_new">Remove Picture 5</a><?php } ?></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto6" id="foto6" size="1">&nbsp;&nbsp;<?php if($Page['pic6']){ ?><img src="../images/adventures/small_<?=$Page['pic6']?>" height="50" align="absmiddle" alt="<?=$Page['pic6']?>" title="<?=$Page['pic6']?>" />&nbsp;&nbsp;<a href="modulos/resize.php?picture=<?=$Page['pic6']?>" target="_new">Resize Picture</a>&nbsp;&nbsp;<a href="modulos/removePicture.php?picture=<?=$Page['pic6']?>&adv=<?=$Page['id']?>&picID=6" target="_new">Remove Picture 6</a><?php } ?></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto7" id="foto7" size="1">&nbsp;&nbsp;<?php if($Page['pic7']){ ?><img src="../images/adventures/small_<?=$Page['pic7']?>" height="50" align="absmiddle" alt="<?=$Page['pic7']?>" title="<?=$Page['pic7']?>" />&nbsp;&nbsp;<a href="modulos/resize.php?picture=<?=$Page['pic7']?>" target="_new">Resize Picture</a>&nbsp;&nbsp;<a href="modulos/removePicture.php?picture=<?=$Page['pic7']?>&adv=<?=$Page['id']?>&picID=7" target="_new">Remove Picture 7</a><?php } ?></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto8" id="foto8" size="1">&nbsp;&nbsp;<?php if($Page['pic8']){ ?><img src="../images/adventures/small_<?=$Page['pic8']?>" height="50" align="absmiddle" alt="<?=$Page['pic8']?>" title="<?=$Page['pic8']?>" />&nbsp;&nbsp;<a href="modulos/resize.php?picture=<?=$Page['pic8']?>" target="_new">Resize Picture</a>&nbsp;&nbsp;<a href="modulos/removePicture.php?picture=<?=$Page['pic8']?>&adv=<?=$Page['id']?>&picID=8" target="_new">Remove Picture 8</a><?php } ?></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto9" id="foto9" size="1">&nbsp;&nbsp;<?php if($Page['pic9']){ ?><img src="../images/adventures/small_<?=$Page['pic9']?>" height="50" align="absmiddle" alt="<?=$Page['pic9']?>" title="<?=$Page['pic9']?>" />&nbsp;&nbsp;<a href="modulos/resize.php?picture=<?=$Page['pic9']?>" target="_new">Resize Picture</a>&nbsp;&nbsp;<a href="modulos/removePicture.php?picture=<?=$Page['pic9']?>&adv=<?=$Page['id']?>&picID=9" target="_new">Remove Picture 9</a><?php } ?></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto10" id="foto10" size="1">&nbsp;&nbsp;<?php if($Page['pic10']){ ?><img src="../images/adventures/small_<?=$Page['pic10']?>" height="50" align="absmiddle" alt="<?=$Page['pic10']?>" title="<?=$Page['pic10']?>" />&nbsp;&nbsp;<a href="modulos/resize.php?picture=<?=$Page['pic10']?>" target="_new">Resize Picture</a>&nbsp;&nbsp;<a href="modulos/removePicture.php?picture=<?=$Page['pic10']?>&adv=<?=$Page['id']?>&picID=10" target="_new">Remove Picture 10</a><?php } ?></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto11" id="foto11" size="1">&nbsp;&nbsp;<?php if($Page['pic11']){ ?><img src="../images/adventures/small_<?=$Page['pic11']?>" height="50" align="absmiddle" alt="<?=$Page['pic11']?>" title="<?=$Page['pic11']?>" />&nbsp;&nbsp;<a href="modulos/resize.php?picture=<?=$Page['pic11']?>" target="_new">Resize Picture</a>&nbsp;&nbsp;<a href="modulos/removePicture.php?picture=<?=$Page['pic11']?>&adv=<?=$Page['id']?>&picID=11" target="_new">Remove Picture 11</a><?php } ?></td>
    </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto12" id="foto12" size="1">&nbsp;&nbsp;<?php if($Page['pic12']){ ?><img src="../images/adventures/small_<?=$Page['pic12']?>" height="50" align="absmiddle" alt="<?=$Page['pic12']?>" title="<?=$Page['pic12']?>" />&nbsp;&nbsp;<a href="modulos/resize.php?picture=<?=$Page['pic12']?>" target="_new">Resize Picture</a>&nbsp;&nbsp;<a href="modulos/removePicture.php?picture=<?=$Page['pic12']?>&adv=<?=$Page['id']?>&picID=12" target="_new">Remove Picture 12</a><?php } ?></td>
    </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto13" id="foto13" size="1">&nbsp;&nbsp;<?php if($Page['pic13']){ ?><img src="../images/adventures/small_<?=$Page['pic13']?>" height="50" align="absmiddle" alt="<?=$Page['pic13']?>" title="<?=$Page['pic13']?>" />&nbsp;&nbsp;<a href="modulos/resize.php?picture=<?=$Page['pic13']?>" target="_new">Resize Picture</a>&nbsp;&nbsp;<a href="modulos/removePicture.php?picture=<?=$Page['pic13']?>&adv=<?=$Page['id']?>&picID=13" target="_new">Remove Picture 13</a><?php } ?></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto14" id="foto14" size="1">&nbsp;&nbsp;<?php if($Page['pic14']){ ?><img src="../images/adventures/small_<?=$Page['pic14']?>" height="50" align="absmiddle" alt="<?=$Page['pic14']?>" title="<?=$Page['pic14']?>" />&nbsp;&nbsp;<a href="modulos/resize.php?picture=<?=$Page['pic14']?>" target="_new">Resize Picture</a>&nbsp;&nbsp;<a href="modulos/removePicture.php?picture=<?=$Page['pic14']?>&adv=<?=$Page['id']?>&picID=14" target="_new">Remove Picture 14</a><?php } ?></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto15" id="foto15" size="1">&nbsp;&nbsp;<?php if($Page['pic15']){ ?><img src="../images/adventures/small_<?=$Page['pic15']?>" height="50" align="absmiddle" alt="<?=$Page['pic15']?>" title="<?=$Page['pic15']?>" />&nbsp;&nbsp;<a href="modulos/resize.php?picture=<?=$Page['pic15']?>" target="_new">Resize Picture</a>&nbsp;&nbsp;<a href="modulos/removePicture.php?picture=<?=$Page['pic15']?>&adv=<?=$Page['id']?>&picID=15" target="_new">Remove Picture 15</a><?php } ?></td>
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
        <td colspan="2" valign="top" class="text"><strong>Facilities:</strong></td>
      </tr>
      <tr>
        <td colspan="2" valign="top" class="text"><?php
		$sqlFacilities = $db->consulta("SELECT * FROM `accommodation` Order by `name` ASC");
		$contador = 1;
		while($Facilities=$db->fetch_array($sqlFacilities)){
		
		$selx = mysql_query("SELECT `accommodation_id` FROM `adventures_accommodation` WHERE `adventures_id`='".$Page['id']."' AND `accommodation_id`='".$Facilities['id']."'");
		list($Finded)=mysql_fetch_array($selx);
		
		   if ($contador > 10) { 
		   echo "<br>";
		   $contador = 1; 
		   }
		   ?>
            <input type="checkbox" name="facilities[]" value="<?=$Facilities['id']?>" id="facilities_<?=$Facilities['id']?>" <? if($Facilities['id']==$Finded){ echo "checked"; }?>><img src="../images/icons/<?=$Facilities['icon']?>" alt="<?=$Facilities['name']?>" border="0" align="absmiddle" title="<?=$Facilities['name']?>">
          
        <?php 
		$contador++;
		} 
		?> 
         </td>
      </tr>
    
  <tr>
    <td colspan="2" class="text">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="text">&nbsp;</td>
  </tr>

<tr align="center">
  <td height="35" class="standard"><input name="submit" type="submit" class="boton" value="Update"></td>
  <td class="standard"><input name="Cancelar" type="button" id="Cancelar" value="Cancel" onClick="self.location='index.php?cmd=adventures'" class="boton"/></td>
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

$name = $_POST['name'];
$information = str_replace("'", "&acute;", $_POST['information']);
$location = $_POST['location'];
$status = $_POST['status'];
$spaces = $_POST['spaces'];
$section = $_POST['section'];
$order = $_POST['order'];
$deposit = $_POST['deposit'];
$day = $_POST['date1'];
$newprice = $_POST['priceoffer'];
$required = $_POST['required'];
$return = $_POST['return'];
$arrival = $_POST['arrival'];
$departure = $_POST['departureH'].":".$_POST['departureM']." ".$_POST['departureTime'];
$ending = $_POST['endingH'].":".$_POST['endingM']." ".$_POST['endingTime'];
$newspace = $_POST['newspace'];
$categorie = $_POST['categorie'];
$emailnot = $_POST['emailnot'];
$latitude = $_POST['latitude'];
$longitut = $_POST['longitut'];
$topad = $_POST['topad'];
$special = $_POST['special'];
$special_price = $_POST['special_price'];

$pickup = $_POST['pickup'];
$pickupnote = $_POST['pickupnote'];
$specialnote = $_POST['specialnote'];

include('images.php');
$image = new SimpleImage();
 
if($_FILES['flyer']==""){
	
}else{
	$FlyerName = str_replace(" ","_",$_FILES['flyer']['name']);
	if (move_uploaded_file($_FILES['flyer']['tmp_name'], "../flyer/".$FlyerName))
	{
		
		
		$update = $db->consulta("UPDATE `adventures` SET `flyer`='".$FlyerName."',`flyertype`='".$_POST['flyertype']."',`flyertext`='".$_POST['flyertext']."' WHERE `id`='".$id."'");
		
	}
}

if($_FILES['flyerimg']==""){ }else{

		$FlyerIMGName = str_replace(" ","_",$_FILES['flyerimg']['name']);
		if (move_uploaded_file($_FILES['flyerimg']['tmp_name'],"../flyer/".$FlyerIMGName)){
			$update = $db->consulta("UPDATE `adventures` SET `flyerimg`='".$FlyerIMGName."' WHERE `id`='".$id."'");
		}
}


if($_FILES['foto1']==""){
	
}else{
	$extension = encontrar_extension($_FILES['foto1']['name']);
	if (move_uploaded_file($_FILES['foto1']['tmp_name'], "../images/adventures/1_".$id."_adventure.".$extension))
	{
		
		$foto1 = "1_".$id."_adventure.".$extension;
		$update = $db->consulta("UPDATE `adventures` SET `pic1`='".$foto1."' WHERE `id`='".$id."'");
		$image->load('../images/adventures/'.$foto1);
		$image->resize(540,350);
		$image->save('../images/adventures/medium_'.$foto1);
		$image->resizeToHeight(200);
		$image->save('../images/adventures/small_'.$foto1);
	} 
}
if($_FILES['foto2']==""){
	
}else{
	$extension2 = encontrar_extension($_FILES['foto2']['name']);
	if (move_uploaded_file($_FILES['foto2']['tmp_name'], "../images/adventures/2_".$id."_adventure.".$extension2))
	{
		$foto2 = "2_".$id."_adventure.".$extension2;
		$update = $db->consulta("UPDATE `adventures` SET `pic2`='".$foto2."' WHERE `id`='".$id."'");
		$image->load('../images/adventures/'.$foto2);
		$image->resize(540,350);
		$image->save('../images/adventures/medium_'.$foto2);
		$image->resizeToHeight(200);
		$image->save('../images/adventures/small_'.$foto2);

	} 
}
if($_FILES['foto3']==""){
	
}else{
	$extension3 = encontrar_extension($_FILES['foto3']['name']);
	if (move_uploaded_file($_FILES['foto3']['tmp_name'], "../images/adventures/3_".$id."_adventure.".$extension3))
	{
		$foto3 = "3_".$id."_adventure.".$extension3;
		$update = $db->consulta("UPDATE `adventures` SET `pic3`='".$foto3."' WHERE `id`='".$id."'");
		$image->load('../images/adventures/'.$foto3);
		$image->resize(540,350);
		$image->save('../images/adventures/medium_'.$foto3);
		$image->resizeToHeight(200);
		$image->save('../images/adventures/small_'.$foto3);
	} 
}
if($_FILES['foto4']==""){
	
}else{
	$extension4 = encontrar_extension($_FILES['foto4']['name']);
	if (move_uploaded_file($_FILES['foto4']['tmp_name'], "../images/adventures/4_".$id."_adventure.".$extension4))
	{
		$foto4 = "4_".$id."_adventure.".$extension4;
		$update = $db->consulta("UPDATE `adventures` SET `pic4`='".$foto4."' WHERE `id`='".$id."'");
		$image->load('../images/adventures/'.$foto4);
		$image->resize(540,350);
		$image->save('../images/adventures/medium_'.$foto4);
		$image->resizeToHeight(200);
		$image->save('../images/adventures/small_'.$foto4);
	} 
}
if($_FILES['foto5']==""){
	
}else{
	$extension5 = encontrar_extension($_FILES['foto5']['name']);
	if (move_uploaded_file($_FILES['foto5']['tmp_name'], "../images/adventures/5_".$id."_adventure.".$extension5))
	{
		$foto5 = "5_".$id."_adventure.".$extension5;
		$update = $db->consulta("UPDATE `adventures` SET `pic5`='".$foto5."' WHERE `id`='".$id."'");
		$image->load('../images/adventures/'.$foto5);
		$image->resize(540,350);
		$image->save('../images/adventures/medium_'.$foto5);
		$image->resizeToHeight(200);
		$image->save('../images/adventures/small_'.$foto5);
	} 
}
if($_FILES['foto6']==""){
	
}else{
	$extension6 = encontrar_extension($_FILES['foto6']['name']);
	if (move_uploaded_file($_FILES['foto6']['tmp_name'], "../images/adventures/6_".$id."_adventure.".$extension6))
	{
		$foto6 = "6_".$id."_adventure.".$extension6;
		$update = $db->consulta("UPDATE `adventures` SET `pic6`='".$foto6."' WHERE `id`='".$id."'");
		$image->load('../images/adventures/'.$foto6);
		$image->resize(540,350);
		$image->save('../images/adventures/medium_'.$foto6);
		$image->resizeToHeight(200);
		$image->save('../images/adventures/small_'.$foto6);
	} 
}
if($_FILES['foto7']==""){
	
}else{
	$extension7 = encontrar_extension($_FILES['foto7']['name']);
	if (move_uploaded_file($_FILES['foto7']['tmp_name'], "../images/adventures/7_".$id."_adventure.".$extension7))
	{
		$foto7 = "7_".$id."_adventure.".$extension7;
		$update = $db->consulta("UPDATE `adventures` SET `pic7`='".$foto7."' WHERE `id`='".$id."'");
		$image->load('../images/adventures/'.$foto7);
		$image->resize(540,350);
		$image->save('../images/adventures/medium_'.$foto7);
		$image->resizeToHeight(200);
		$image->save('../images/adventures/small_'.$foto7);
	} 
}
if($_FILES['foto8']==""){
	
}else{
	$extension8 = encontrar_extension($_FILES['foto8']['name']);
	if (move_uploaded_file($_FILES['foto8']['tmp_name'], "../images/adventures/8_".$id."_adventure.".$extension8))
	{
		$foto8 = "8_".$id."_adventure.".$extension8;
		$update = $db->consulta("UPDATE `adventures` SET `pic8`='".$foto8."' WHERE `id`='".$id."'");
		$image->load('../images/adventures/'.$foto8);
		$image->resize(540,350);
		$image->save('../images/adventures/medium_'.$foto8);
		$image->resizeToHeight(200);
		$image->save('../images/adventures/small_'.$foto8);
	} 
}
if($_FILES['foto9']==""){
	
}else{
	$extension9 = encontrar_extension($_FILES['foto9']['name']);
	if (move_uploaded_file($_FILES['foto9']['tmp_name'], "../images/adventures/9_".$id."_adventure.".$extension9))
	{
		$foto9 = "9_".$id."_adventure.".$extension9;
		$update = $db->consulta("UPDATE `adventures` SET `pic9`='".$foto9."' WHERE `id`='".$id."'");
		$image->load('../images/adventures/'.$foto9);
		$image->resize(540,350);
		$image->save('../images/adventures/medium_'.$foto9);
		$image->resizeToHeight(200);
		$image->save('../images/adventures/small_'.$foto9);
	} 
}
if($_FILES['foto10']==""){
	
}else{
	$extension10 = encontrar_extension($_FILES['foto10']['name']);
	if (move_uploaded_file($_FILES['foto10']['tmp_name'], "../images/adventures/10_".$id."_adventure.".$extension10))
	{
		$foto10 = "10_".$id."_adventure.".$extension10;
		$update = $db->consulta("UPDATE `adventures` SET `pic10`='".$foto10."' WHERE `id`='".$id."'");
		$image->load('../images/adventures/'.$foto10);
		$image->resize(540,350);
		$image->save('../images/adventures/medium_'.$foto10);
		$image->resizeToHeight(200);
		$image->save('../images/adventures/small_'.$foto10);
	} 
}
if($_FILES['foto11']==""){
	
}else{
	$extension11 = encontrar_extension($_FILES['foto11']['name']);
	if (move_uploaded_file($_FILES['foto11']['tmp_name'], "../images/adventures/11_".$id."_adventure.".$extension11))
	{
		$foto11 = "11_".$id."_adventure.".$extension11;
		$update = $db->consulta("UPDATE `adventures` SET `pic11`='".$foto11."' WHERE `id`='".$id."'");
		$image->load('../images/adventures/'.$foto11);
		$image->resize(540,350);
		$image->save('../images/adventures/medium_'.$foto11);
		$image->resizeToHeight(200);
		$image->save('../images/adventures/small_'.$foto11);
	} 
}
if($_FILES['foto12']==""){
	
}else{
	$extension12 = encontrar_extension($_FILES['foto12']['name']);
	if (move_uploaded_file($_FILES['foto12']['tmp_name'], "../images/adventures/12_".$id."_adventure.".$extension12))
	{
		$foto12 = "12_".$id."_adventure.".$extension12;
		$update = $db->consulta("UPDATE `adventures` SET `pic12`='".$foto12."' WHERE `id`='".$id."'");
		$image->load('../images/adventures/'.$foto12);
		$image->resize(540,350);
		$image->save('../images/adventures/medium_'.$foto12);
		$image->resizeToHeight(200);
		$image->save('../images/adventures/small_'.$foto12);
	} 
}
if($_FILES['foto13']==""){
	
}else{
	$extension13 = encontrar_extension($_FILES['foto13']['name']);
	if (move_uploaded_file($_FILES['foto13']['tmp_name'], "../images/adventures/13_".$id."_adventure.".$extension13))
	{
		$foto13 = "13_".$id."_adventure.".$extension13;
		$update = $db->consulta("UPDATE `adventures` SET `pic13`='".$foto13."' WHERE `id`='".$id."'");
		$image->load('../images/adventures/'.$foto13);
		$image->resize(540,350);
		$image->save('../images/adventures/medium_'.$foto13);
		$image->resizeToHeight(200);
		$image->save('../images/adventures/small_'.$foto13);
	} 
}	
if($_FILES['foto14']==""){
	
}else{
	$extension14 = encontrar_extension($_FILES['foto14']['name']);
	if (move_uploaded_file($_FILES['foto14']['tmp_name'], "../images/adventures/14_".$id."_adventure.".$extension14))
	{
		$foto14 = "14_".$id."_adventure.".$extension14;
		$update = $db->consulta("UPDATE `adventures` SET `pic14`='".$foto14."' WHERE `id`='".$id."'");
		$image->load('../images/adventures/'.$foto14);
		$image->resize(540,350);
		$image->save('../images/adventures/medium_'.$foto14);
		$image->resizeToHeight(200);
		$image->save('../images/adventures/small_'.$foto14);
	} 
}
if($_FILES['foto15']==""){
	
}else{
	$extension15 = encontrar_extension($_FILES['foto15']['name']);
	if (move_uploaded_file($_FILES['foto15']['tmp_name'], "../images/adventures/15_".$id."_adventure.".$extension15))
	{
		$foto15 = "15_".$id."_adventure.".$extension15;
		$update = $db->consulta("UPDATE `adventures` SET `pic15`='".$foto15."' WHERE `id`='".$id."'");
		$image->load('../images/adventures/'.$foto15);
		$image->resize(540,350);
		$image->save('../images/adventures/medium_'.$foto15);
		$image->resizeToHeight(200);
		$image->save('../images/adventures/small_'.$foto15);
	} 
}

$dias = serialize($_POST['dias']);	 //special

$notecode = $_POST['notecode'];
$code = $_POST['code'];
$chat = $_POST['chat']; 

$update = $db->consulta("UPDATE `adventures` SET `name`='".$name."',`information`='".$information."',`locations_id`='".$location."',`status`='".$status."',`spaces`='".$spaces."',`section`='".$section."',`order`='".$order."',`deposit`='".$deposit."',`day`='".$day."',`newprice`='".$newprice."',`required`='".$required."',`departure`='".$departure."',`ending`='".$ending."',`newspace`='".$newspace."',`categorie`='".$categorie."',`days`='".$dias."',`emailnot`='".$emailnot."',`latitude`='".$latitude."',`longitude`='".$longitut."',`topad`='".$topad."',`special`='".$special."',`special_price`='".$special_price."',`note`='".$pickupnote."',`pickup`='".$pickup."',`specialnote`='".$specialnote."',`chat`='".$chat."',`code`='".$code."',`notecode`='".$notecode."' WHERE `id`='".$id."'"); 
		
	 
	 
$delete = $db->consulta("DELETE FROM `adventures_accommodation` WHERE `adventures_id` = '".$id."'"); 	  
$facilities = $_REQUEST['facilities'];	
for ($i = 0; $i < count($facilities); $i++)
  {

$Facilidades = $facilities[$i];
if($Facilidades==""){
	
}else{

$sqlFacilidades = mysql_query("INSERT INTO `adventures_accommodation`(`adventures_id`,`accommodation_id`)VALUES('".$id."','".$Facilidades."')");

}
}

?>

<script language="javascript">
<!--
      document.location='index.php?cmd=adventures';
//-->
</script>
<?
}

/////////////////Nuevo Usuario//////////////////////////////////////////////////////

if($act=="Add"){
$idNew = (int)(microtime()*1000000);		
?>


<form action="index.php?cmd=adventures&act=save" method="post" enctype="multipart/form-data">
<input name="act" value="save" type="hidden">
<input name="idNew" value="<?=$idNew?>" type="hidden">
<table width="95%" border="0" align="center" cellpadding="1" cellspacing="0" class="main">
<tr>
          <td height="35" colspan="2" align="center" ><h2>New Adventure</h2></td>
</tr>
<tr>
          <td colspan="2" class="text"><strong>Name:</strong></td>
    </tr>
<tr>
  <td colspan="2" class="text"><input type="text" class="cajas" size="40" name="name" id="name" /></td>
  </tr>
<tr>
  <td colspan="2" class="text"><strong>Email Notification:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><label for="emailnot"></label>
    <input name="emailnot" type="text" id="emailnot" size="40" /></td>
</tr>
<tr>
  <td colspan="2" class="text"><strong>Location:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><label for="location"></label>
    <select name="location" id="location">
      <option value="0" selected disabled>Select Location</option>
      <?php
	  $sqlLocation = $db->consulta("SELECT * FROM `locations` Order by `name` ASC");
	  while($Location=$db->fetch_array($sqlLocation)){
		  ?> 
       <option value="<?php echo $Location['id']; ?>"><?php echo $Location['name']; ?></option>
       <?php } ?>
    </select></td>
</tr>
<tr>
  <td colspan="2" class="text"><strong>Categorie:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><label for="categorie"></label>
    <select name="categorie" id="categorie">
      <option value="0" disabled selected="selected">Select Categorie</option>
      <?php
	  $sqlCategorie = $db->consulta("SELECT * FROM `categories` Order by `name` ASC");
	  while($Categorie=$db->fetch_array($sqlCategorie)){
		  ?> 
       <option value="<?php echo $Categorie['id']; ?>"><?php echo $Categorie['name']; ?></option>
       <?php } ?>
    </select></td>
</tr>
<tr>
  <td colspan="2" class="text"><strong>Adventure Section:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text">
    <label>
      <input type="radio" name="section" value="1" id="section_0" checked="checked" />
      Raw Adventure</label>
&nbsp;&nbsp;&nbsp;    <label>
      <input type="radio" name="section" value="2" id="section_1" />
      Adventure</label>
        &nbsp;&nbsp;
         <input type="radio" name="section" value="8" id="section_1" />
      Places to Stay</label>
        &nbsp;&nbsp;
        
           <input type="radio" name="section" value="5" id="section_2" >
           Affiliates Adventure
  </td>
</tr>
 <tr>
       <td colspan="2" valign="top" class="text"><strong>Adventure Status:</strong></td>
     </tr>
     <tr>
       <td colspan="2" valign="top" class="text">         <strong>
        
           <input type="radio" name="status" value="1" id="status_0" checked>
           Enabled
         &nbsp;&nbsp;
        
           <input type="radio" name="status" value="0" id="status_1">
           Disabled
       
       </strong></td>
     </tr>
<tr>
  <td colspan="2" class="text"><strong>Order:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><label for="order"></label>
    <select name="order" id="order">
    <?php
	$query = $db->consulta("SELECT * FROM `adventures`");
	$Order = $db->num_rows($query);
	 $COrder = $Order+1;
	 for ($j=1; $j < $COrder; $j++) {
	?>
      <option value="<?php echo $j; ?>" <?php if($COrder==$j){ echo "selected"; }?>>-- <?php echo $j; ?> --</option>
    <?php } ?>
    </select></td>
</tr>
<tr>
  <td colspan="2" class="text"><strong>Top Adventure</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><b>
    <label>
      <input type="radio" name="topad" value="1" id="topad_0"/>
      Yes</label>
  &nbsp;&nbsp;
    <label>
      <input type="radio" name="topad" value="0" id="topad_1" checked="checked"/>
      No</label>
    
    </b></td>
</tr>
     <tr>
       <td colspan="2" class="text"><strong>Specials</strong></td>
     </tr>
     <tr>
       <td colspan="2" class="text"><b>
         <label>
           <input type="radio" name="special" value="1" id="topad_4"/>
           Yes</label>
         &nbsp;&nbsp;
         <label>
           <input type="radio" name="special" value="0" id="topad_5" checked="checked"/>
           No</label>
       </b></td>
     </tr>
     <tr>
       <td colspan="2" valign="top" class="text"><strong>Price Specials</strong></td>
     </tr>
     <tr>
       <td colspan="2" valign="top" class="text"><input name="special_price" type="text" id="special_price" size="12" /></td>
     </tr>
     <tr>
       <td colspan="2" valign="top" class="text"><strong>Adventure Times</strong></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text"><strong><a href="javascript:popUp('modulos/special.time.php?adventure=<?=$idNew?>');">Click Here for Add/Edit Adventure Times</a></strong></td>
     </tr>
       <tr>
       <td colspan="2" valign="top" class="text"><strong>Specials Dates:</strong></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text"><strong><a href="javascript:popUp('modulos/special.date.php?adventure=<?=$idNew?>');">Click Here for Add Date</a></strong></td>
     </tr>
       <tr>
       <td colspan="2" valign="top" class="text"><strong>Deposit amount$:</strong></td>
     </tr>
     <tr>
       <td colspan="2" valign="top" class="text"><label for="deposit"></label>
       <input type="text" name="deposit" id="deposit" class="cajas" value="<?=$Page['deposit']?>" /></td>
     </tr>
      <tr>
      <td colspan="2"><strong>Days Enabled:</strong></td>
      </tr>
      <tr>
      <td colspan="2"> 	
  
      
       <input type="checkbox" name="dias[]" id="dias" value="Monday">Monday &nbsp;
<input type="checkbox" name="dias[]"  id="dias" value="Tuesday">Tuesday &nbsp;
<input type="checkbox" name="dias[]"  id="dias" value="Wednesday">Wednesday &nbsp;
<input type="checkbox" name="dias[]"  id="dias" value="Thursday">Thursday &nbsp;
<input type="checkbox" name="dias[]"  id="dias" value="Friday">Friday &nbsp;
<input type="checkbox" name="dias[]"  id="dias" value="Saturday">Saturday &nbsp;
<input type="checkbox" name="dias[]"  id="dias" value="Sunday">Sunday &nbsp;
         </td>
    </tr>
    
      <tr>
        <td colspan="2" class="text"><strong>Pick-up Option:</strong></td>
      </tr>
      <tr>
        <td colspan="2" class="text">
          <label>
            <input type="radio" name="pickup" value="0" id="pickup_0" checked="checked" />
            No</label>
         &nbsp;&nbsp;
          <label>
            <input type="radio" name="pickup" value="1" id="pickup_1"/>
            Yes</label>
       </td>
      </tr>
      <tr>
        <td colspan="2" class="text"><strong>Pick-up Note:</strong></td>
      </tr>
      <tr>
        <td colspan="2" class="text"><label for="pickupnote">
        <textarea name="pickupnote" id="pickupnote" cols="30" rows="3"></textarea></label></td>
      </tr>
      <tr>
        <td colspan="2" class="text"><strong>Special note:</strong></td>
      </tr>
      <tr>
        <td colspan="2" class="text"><label for="specialnote"></label>
        <textarea name="specialnote" id="specialnote" cols="30" rows="3"></textarea></td>
      </tr>
    <tr>
        <td colspan="2" class="text"><strong>Widget Chat:</strong></td>
      </tr>
      <tr>
        <td colspan="2" class="text"><label for="chat"></label>
        <textarea name="chat" id="chat" cols="70" rows="4"></textarea></td>
      </tr>
      <tr>
        <td colspan="2" class="text"><strong>Confirmation Code:</strong></td>
      </tr>
      <tr>
        <td colspan="2" class="text"><label for="code"></label>
        <input type="text" name="code" id="code" maxlength="6" value="" /></td>
      </tr>
            <tr>
        <td colspan="2" class="text"><strong>Confirmation Code Note:</strong></td>
      </tr>
      <tr>
        <td colspan="2" class="text"><label for="notecode"></label>
         <textarea name="notecode" id="notecode" cols="30" rows="3"></textarea></td>
      </tr>
      <tr>
        <td colspan="2" class="text">&nbsp;</td>
      </tr>
    
        <tr>
  <td colspan="2" valign="top" class="text"><strong>Information:</strong></td>
  </tr>
  
     <tr>
       <td colspan="2" valign="top" class="text">
	  <?php
$oFCKeditor = new FCKeditor('information') ;
$oFCKeditor->BasePath = 'fckeditor/' ;
$oFCKeditor->Value = '' ;
$oFCKeditor->Width = '100%' ;
$oFCKeditor->Height = '300' ;
$oFCKeditor->Create() ;
?>
       </td>
     </tr>
     
<tr>
  <td colspan="2" class="text"><strong>Brochure:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"> <input type="file" name="flyer" id="flyer" size="1"></td>
</tr>
<tr>
  <td colspan="2" class="text">Brochure Text:</td>
</tr>
<tr>
  <td colspan="2" class="text"><input name="flyertext" type="text" value="" size="35" maxlength="90" /><span style="font-size:9px">90 characters max.</span></td>
</tr>
<tr>
  <td colspan="2" class="text">Brochure Type:</td>
</tr>
<tr>
  <td colspan="2" class="text">
      <label>
        <input type="radio" name="flyertype" value="doc" id="flyertype_0"/>
        Document</label>
    
      <label>
        <input type="radio" name="flyertype" value="img" id="flyertype_1" checked="checked"/>
        Image</label>
    </td>
</tr>
<tr>
  <td colspan="2" class="text">Image for Doc:</td>
</tr>
<tr>
  <td colspan="2" class="text"> <input type="file" name="flyerimg" id="flyerimg" size="1"></td>
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
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto11" id="foto11"></td>
    </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto12" id="foto12"></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto13" id="foto13"></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto14" id="foto14"></td>
     </tr>
      <tr>
       <td colspan="2" valign="top" class="text">
       <input type="file" name="foto15" id="foto15"></td>
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
        <td colspan="2" valign="top" class="text"><strong>Facilities:</strong></td>
      </tr>
      <tr>
        <td colspan="2" valign="top" class="text"><?php
		$sqlFacilities = $db->consulta("SELECT * FROM `accommodation` Order by `name` ASC");
		$contador = 1;
		while($Facilities=$db->fetch_array($sqlFacilities)){
		?>	
           <?php
		   if ($contador > 10) { 
		   echo "<br>";
		   $contador = 1; 
		   }
		   ?>
            <input type="checkbox" name="facilities[]" value="<?=$Facilities['id']?>" id="facilities_<?=$Facilities['id']?>"><img src="../images/icons/<?=$Facilities['icon']?>" alt="<?=$Facilities['name']?>" border="0" align="absmiddle" title="<?=$Facilities['name']?>">
          
        <?php 
		$contador++;
		} 
		?> 
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
      <td height="35" align="center" class="standard"><input name="Cancelar2" type="button" id="Cancelar2" value="Cancel" onClick="self.location='index.php?cmd=adventures'" class="boton"/></td>
    </tr>
    <tr align="center">
      <td height="35" align="center" class="standard">&nbsp;</td>
      <td height="35" align="center" class="standard">&nbsp;</td>
    </tr>
</table>

</form>
<?
}
///////////////CHECK Contacto/////////////////////////////////////
if($act=="save"){


$name = $_POST['name'];
$information = str_replace("'", "&acute;", $_POST['information']);
$location = $_POST['location'];
$status = $_POST['status'];
$spaces = $_POST['spaces'];
$section = $_POST['section'];
$order = $_POST['order'];
$deposit = $_POST['deposit'];
$day = $_POST['date1'];
$newprice = $_POST['priceoffer'];
$required = $_POST['required'];
$return = $_POST['returnH'].":".$_POST['returnM'];
$arrival = $_POST['arrivalH'].":".$_POST['arrivalM'];
$departure = $_POST['departureH'].":".$_POST['departureM']." ".$_POST['departureTime'];
$ending = $_POST['endingH'].":".$_POST['endingM']." ".$_POST['endingTime'];
$newspace = $_POST['newspace'];
$categorie = $_POST['categorie'];
$emailnot = $_POST['emailnot'];
$latitude = $_POST['latitude'];
$longitut = $_POST['longitut'];
$topad = $_POST['topad'];
$special = $_POST['special']; 
$special_price = $_POST['special_price']; //special_price
$idNew = $_POST['idNew'];

$pickup = $_POST['pickup'];
$pickupnote = $_POST['pickupnote'];
$specialnote = $_POST['specialnote'];

include('images.php');
$image = new SimpleImage();
$dias = serialize($_POST['dias']);

$notecode = $_POST['notecode'];
$code = $_POST['code'];
$chat = $_POST['chat']; 

$ejecutar =  $db->consulta("INSERT INTO `adventures` (`name`,`information`,`locations_id`,`status`,`spaces`,`section`,`order`,`deposit`,`day`,`newprice`,`required`,`departure`,`ending`,`newspace`,`categorie`,`days`,`emailnot`,`latitude`,`longitude`,`topad`,`special`,`special_price`,`id`,`pickup`,`note`,`specialnote`,`chat`,`code`,`notecode`) VALUES ('".$name."','".$information."','".$location."','".$status."','".$spaces."','".$section."','".$order."','".$deposit."','".$day."','".$newprice."','".$required."','".$departure."','".$ending."','".$newspace."','".$categorie."','".$dias."','".$emailnot."','".$latitude."','".$longitut."','".$topad."','".$special."','".$special_price."','".$idNew."','".$pickup."','".$pickupnote."','".$specialnote."','".$chat."','".$code."','".$notecode."')");
	  $adventureID = $db->getLastID($ejecutar);


if($_FILES['flyer']==""){
	
}else{
	$FlyerName = str_replace(" ","_",$_FILES['flyer']['name']);
	if (move_uploaded_file($_FILES['flyer']['tmp_name'], "../flyer/".$FlyerName))
	{
	
		
		$update = $db->consulta("UPDATE `adventures` SET `flyer`='".$FlyerName."',`flyertype`='".$_POST['flyertype']."',`flyertext`='".$_POST['flyertext']."' WHERE `id`='".$adventureID."'");
		
	}
}
if($_FILES['flyerimg']==""){ }else{

		$FlyerIMGName = str_replace(" ","_",$_FILES['flyerimg']['name']);
		if (move_uploaded_file($_FILES['flyerimg']['tmp_name'],"../flyer/".$FlyerIMGName)){
			$update = $db->consulta("UPDATE `adventures` SET `flyerimg`='".$FlyerIMGName."' WHERE `id`='".$adventureID."'");
		}
}

	  
if($_FILES['foto1']==""){
	
}else{
	$extension = encontrar_extension($_FILES['foto1']['name']);
	if (move_uploaded_file($_FILES['foto1']['tmp_name'], "../images/adventures/1_".$adventureID."_adventure.".$extension))
	{
		
		$foto1 = "1_".$adventureID."_adventure.".$extension;
		$update = $db->consulta("UPDATE `adventures` SET `pic1`='".$foto1."' WHERE `id`='".$adventureID."'");
		$image->load('../images/adventures/'.$foto1);
		$image->resize(540,350);
		$image->save('../images/adventures/medium_'.$foto1);
		$image->resizeToHeight(200);
		$image->save('../images/adventures/small_'.$foto1);
	} 
}
if($_FILES['foto2']==""){
	
}else{
	$extension2 = encontrar_extension($_FILES['foto2']['name']);
	if (move_uploaded_file($_FILES['foto2']['tmp_name'], "../images/adventures/2_".$adventureID."_adventure.".$extension2))
	{
		$foto2 = "2_".$adventureID."_adventure.".$extension2;
		$update = $db->consulta("UPDATE `adventures` SET `pic2`='".$foto2."' WHERE `id`='".$adventureID."'");
		$image->load('../images/adventures/'.$foto2);
		$image->resize(540,350);
		$image->save('../images/adventures/medium_'.$foto2);
		$image->resizeToHeight(200);
		$image->save('../images/adventures/small_'.$foto2);

	} 
}
if($_FILES['foto3']==""){
	
}else{
	$extension3 = encontrar_extension($_FILES['foto3']['name']);
	if (move_uploaded_file($_FILES['foto3']['tmp_name'], "../images/adventures/3_".$adventureID."_adventure.".$extension3))
	{
		$foto3 = "3_".$adventureID."_adventure.".$extension3;
		$update = $db->consulta("UPDATE `adventures` SET `pic3`='".$foto3."' WHERE `id`='".$adventureID."'");
		$image->load('../images/adventures/'.$foto3);
		$image->resize(540,350);
		$image->save('../images/adventures/medium_'.$foto3);
		$image->resizeToHeight(200);
		$image->save('../images/adventures/small_'.$foto3);
	} 
}
if($_FILES['foto4']==""){
	
}else{
	$extension4 = encontrar_extension($_FILES['foto4']['name']);
	if (move_uploaded_file($_FILES['foto4']['tmp_name'], "../images/adventures/4_".$adventureID."_adventure.".$extension4))
	{
		$foto4 = "4_".$adventureID."_adventure.".$extension4;
		$update = $db->consulta("UPDATE `adventures` SET `pic4`='".$foto4."' WHERE `id`='".$adventureID."'");
		$image->load('../images/adventures/'.$foto4);
		$image->resize(540,350);
		$image->save('../images/adventures/medium_'.$foto4);
		$image->resizeToHeight(200);
		$image->save('../images/adventures/small_'.$foto4);
	} 
}
if($_FILES['foto5']==""){
	
}else{
	$extension5 = encontrar_extension($_FILES['foto5']['name']);
	if (move_uploaded_file($_FILES['foto5']['tmp_name'], "../images/adventures/5_".$adventureID."_adventure.".$extension5))
	{
		$foto5 = "5_".$adventureID."_adventure.".$extension5;
		$update = $db->consulta("UPDATE `adventures` SET `pic5`='".$foto5."' WHERE `id`='".$adventureID."'");
		$image->load('../images/adventures/'.$foto5);
		$image->resize(540,350);
		$image->save('../images/adventures/medium_'.$foto5);
		$image->resizeToHeight(200);
		$image->save('../images/adventures/small_'.$foto5);
	} 
}
if($_FILES['foto6']==""){
	
}else{
	$extension6 = encontrar_extension($_FILES['foto6']['name']);
	if (move_uploaded_file($_FILES['foto6']['tmp_name'], "../images/adventures/6_".$adventureID."_adventure.".$extension6))
	{
		$foto6 = "6_".$adventureID."_adventure.".$extension6;
		$update = $db->consulta("UPDATE `adventures` SET `pic6`='".$foto6."' WHERE `id`='".$adventureID."'");
		$image->load('../images/adventures/'.$foto6);
		$image->resize(540,350);
		$image->save('../images/adventures/medium_'.$foto6);
		$image->resizeToHeight(200);
		$image->save('../images/adventures/small_'.$foto6);
	} 
}
if($_FILES['foto7']==""){
	
}else{
	$extension7 = encontrar_extension($_FILES['foto7']['name']);
	if (move_uploaded_file($_FILES['foto7']['tmp_name'], "../images/adventures/7_".$adventureID."_adventure.".$extension7))
	{
		$foto7 = "7_".$adventureID."_adventure.".$extension7;
		$update = $db->consulta("UPDATE `adventures` SET `pic7`='".$foto7."' WHERE `id`='".$adventureID."'");
		$image->load('../images/adventures/'.$foto7);
		$image->resize(540,350);
		$image->save('../images/adventures/medium_'.$foto7);
		$image->resizeToHeight(200);
		$image->save('../images/adventures/small_'.$foto7);
	} 
}
if($_FILES['foto8']==""){
	
}else{
	$extension8 = encontrar_extension($_FILES['foto8']['name']);
	if (move_uploaded_file($_FILES['foto8']['tmp_name'], "../images/adventures/8_".$adventureID."_adventure.".$extension8))
	{
		$foto8 = "8_".$adventureID."_adventure.".$extension8;
		$update = $db->consulta("UPDATE `adventures` SET `pic8`='".$foto8."' WHERE `id`='".$adventureID."'");
		$image->load('../images/adventures/'.$foto8);
		$image->resize(540,350);
		$image->save('../images/adventures/medium_'.$foto8);
		$image->resizeToHeight(200);
		$image->save('../images/adventures/small_'.$foto8);
	} 
}
if($_FILES['foto9']==""){
	
}else{
	$extension9 = encontrar_extension($_FILES['foto9']['name']);
	if (move_uploaded_file($_FILES['foto9']['tmp_name'], "../images/adventures/9_".$adventureID."_adventure.".$extension9))
	{
		$foto9 = "9_".$adventureID."_adventure.".$extension9;
		$update = $db->consulta("UPDATE `adventures` SET `pic9`='".$foto9."' WHERE `id`='".$adventureID."'");
		$image->load('../images/adventures/'.$foto9);
		$image->resize(540,350);
		$image->save('../images/adventures/medium_'.$foto9);
		$image->resizeToHeight(200);
		$image->save('../images/adventures/small_'.$foto9);
	} 
}
if($_FILES['foto10']==""){
	
}else{
	$extension10 = encontrar_extension($_FILES['foto10']['name']);
	if (move_uploaded_file($_FILES['foto10']['tmp_name'], "../images/adventures/10_".$adventureID."_adventure.".$extension10))
	{
		$foto10 = "10_".$adventureID."_adventure.".$extension10;
		$update = $db->consulta("UPDATE `adventures` SET `pic10`='".$foto10."' WHERE `id`='".$adventureID."'");
		$image->load('../images/adventures/'.$foto10);
		$image->resize(540,350);
		$image->save('../images/adventures/medium_'.$foto10);
		$image->resizeToHeight(200);
		$image->save('../images/adventures/small_'.$foto10);
	} 
}
if($_FILES['foto11']==""){
	
}else{
	$extension11 = encontrar_extension($_FILES['foto11']['name']);
	if (move_uploaded_file($_FILES['foto11']['tmp_name'], "../images/adventures/11_".$adventureID."_adventure.".$extension11))
	{
		$foto11 = "11_".$adventureID."_adventure.".$extension11;
		$update = $db->consulta("UPDATE `adventures` SET `pic11`='".$foto11."' WHERE `id`='".$adventureID."'");
		$image->load('../images/adventures/'.$foto11);
		$image->resize(540,350);
		$image->save('../images/adventures/medium_'.$foto11);
		$image->resizeToHeight(200);
		$image->save('../images/adventures/small_'.$foto11);
	} 
}
if($_FILES['foto12']==""){
	
}else{
	$extension12 = encontrar_extension($_FILES['foto12']['name']);
	if (move_uploaded_file($_FILES['foto12']['tmp_name'], "../images/adventures/12_".$adventureID."_adventure.".$extension12))
	{
		$foto12 = "12_".$adventureID."_adventure.".$extension12;
		$update = $db->consulta("UPDATE `adventures` SET `pic12`='".$foto12."' WHERE `id`='".$adventureID."'");
		$image->load('../images/adventures/'.$foto12);
		$image->resize(540,350);
		$image->save('../images/adventures/medium_'.$foto12);
		$image->resizeToHeight(200);
		$image->save('../images/adventures/small_'.$foto12);
	} 
}
if($_FILES['foto13']==""){
	
}else{
	$extension13 = encontrar_extension($_FILES['foto13']['name']);
	if (move_uploaded_file($_FILES['foto13']['tmp_name'], "../images/adventures/13_".$adventureID."_adventure.".$extension13))
	{
		$foto13 = "13_".$adventureID."_adventure.".$extension13;
		$update = $db->consulta("UPDATE `adventures` SET `pic13`='".$foto13."' WHERE `id`='".$adventureID."'");
		$image->load('../images/adventures/'.$foto13);
		$image->resize(540,350);
		$image->save('../images/adventures/medium_'.$foto13);
		$image->resizeToHeight(200);
		$image->save('../images/adventures/small_'.$foto13);
	} 
}	
if($_FILES['foto14']==""){
	
}else{
	$extension14 = encontrar_extension($_FILES['foto14']['name']);
	if (move_uploaded_file($_FILES['foto14']['tmp_name'], "../images/adventures/14_".$adventureID."_adventure.".$extension14))
	{
		$foto14 = "14_".$adventureID."_adventure.".$extension14;
		$update = $db->consulta("UPDATE `adventures` SET `pic14`='".$foto14."' WHERE `id`='".$adventureID."'");
		$image->load('../images/adventures/'.$foto14);
		$image->resize(540,350);
		$image->save('../images/adventures/medium_'.$foto14);
		$image->resizeToHeight(200);
		$image->save('../images/adventures/small_'.$foto14);
	} 
}
if($_FILES['foto15']==""){
	
}else{
	$extension15 = encontrar_extension($_FILES['foto15']['name']);
	if (move_uploaded_file($_FILES['foto15']['tmp_name'], "../images/adventures/15_".$adventureID."_adventure.".$extension15))
	{
		$foto15 = "15_".$adventureID."_adventure.".$extension15;
		$update = $db->consulta("UPDATE `adventures` SET `pic15`='".$foto15."' WHERE `id`='".$adventureID."'");
		$image->load('../images/adventures/'.$foto15);
		$image->resize(540,350);
		$image->save('../images/adventures/medium_'.$foto15);
		$image->resizeToHeight(200);
		$image->save('../images/adventures/small_'.$foto15);
	} 
}
	
	
	  
$facilities = $_REQUEST['facilities'];	
for ($i = 0; $i < count($facilities); $i++)
  {

$Facilidades = $facilities[$i];
if($Facilidades==""){
	
}else{

$sqlFacilidades = mysql_query("INSERT INTO `adventures_accommodation`(`adventures_id`,`accommodation_id`)VALUES('".$adventureID."','".$Facilidades."')");

}
}


		
	
        ?>
<script language="javascript">
                <!--
				   document.location='index.php?cmd=adventures';
                //-->
                </script>
        <?
}



//////////////////BORRAR USUARIO/////////////////////
if($act=="Remove"){


$resp = $db->consulta("SELECT * FROM `adventures` WHERE `id`='".$id."'");
$Page = $db->fetch_array($resp);

if (!IsSet($page)) {
        $page = "confirm";
}

if ($page == "confirm") {

?>
<center>
        <br><br>
<span class="titulos">This action remove Adventure <em><strong><? echo $Page['name']; ?></strong></em>.</span><br><font color="#FF0000"><em>You sure?</em></font><br>

<br>
<input name="SI" type="button" id="YES" value="  Yes  " onClick="self.location='index.php?cmd=adventures&act=Remove&page=Remove&id=<? echo $Page['id']; ?>'" class="boton"/>
&nbsp;&nbsp;&nbsp;
<input name="NO" type="button" id="NO" value="  No  " onClick="self.location='index.php?cmd=adventures'" class="boton"/></center>
<?


}
if ($page == "Remove") {

        $resp = $db->consulta("SELECT * FROM `adventures` WHERE `id`='".$id."'");
		$Pictures = $db->fetch_array($resp);
		@unlink('../images/adventures/'.$Pictures['pic1']);
		@unlink('../images/adventures/medium_'.$Pictures['pic1']);
		@unlink('../images/adventures/small_'.$Pictures['pic1']);
		
		@unlink('../images/adventures/'.$Pictures['pic2']);
		@unlink('../images/adventures/medium_'.$Pictures['pic2']);
		@unlink('../images/adventures/small_'.$Pictures['pic2']);

		@unlink('../images/adventures/'.$Pictures['pic3']);
		@unlink('../images/adventures/medium_'.$Pictures['pic3']);
		@unlink('../images/adventures/small_'.$Pictures['pic3']);

		@unlink('../images/adventures/'.$Pictures['pic4']);
		@unlink('../images/adventures/medium_'.$Pictures['pic4']);
		@unlink('../images/adventures/small_'.$Pictures['pic4']);
		
		@unlink('../images/adventures/'.$Pictures['pic5']);
		@unlink('../images/adventures/medium_'.$Pictures['pic5']);
		@unlink('../images/adventures/small_'.$Pictures['pic5']);
		
		@unlink('../images/adventures/'.$Pictures['pic6']);
		@unlink('../images/adventures/medium_'.$Pictures['pic6']);
		@unlink('../images/adventures/small_'.$Pictures['pic6']);
		
		@unlink('../images/adventures/'.$Pictures['pic7']);
		@unlink('../images/adventures/medium_'.$Pictures['pic7']);
		@unlink('../images/adventures/small_'.$Pictures['pic7']);
		
		@unlink('../images/adventures/'.$Pictures['pic8']);
		@unlink('../images/adventures/medium_'.$Pictures['pic8']);
		@unlink('../images/adventures/small_'.$Pictures['pic8']);
		
		@unlink('../images/adventures/'.$Pictures['pic9']);
		@unlink('../images/adventures/medium_'.$Pictures['pic9']);
		@unlink('../images/adventures/small_'.$Pictures['pic9']);
		
		@unlink('../images/adventures/'.$Pictures['pic10']);
		@unlink('../images/adventures/medium_'.$Pictures['pic10']);
		@unlink('../images/adventures/small_'.$Pictures['pic10']);	
		
		@unlink('../images/adventures/'.$Pictures['pic11']);
		@unlink('../images/adventures/medium_'.$Pictures['pic11']);
		@unlink('../images/adventures/small_'.$Pictures['pic11']);	
		
		@unlink('../images/adventures/'.$Pictures['pic12']);
		@unlink('../images/adventures/medium_'.$Pictures['pic12']);
		@unlink('../images/adventures/small_'.$Pictures['pic12']);	
		
		@unlink('../images/adventures/'.$Pictures['pic13']);
		@unlink('../images/adventures/medium_'.$Pictures['pic13']);
		@unlink('../images/adventures/small_'.$Pictures['pic13']);	
		
		@unlink('../images/adventures/'.$Pictures['pic14']);
		@unlink('../images/adventures/medium_'.$Pictures['pic14']);
		@unlink('../images/adventures/small_'.$Pictures['pic14']);	
		
		@unlink('../images/adventures/'.$Pictures['pic15']);
		@unlink('../images/adventures/medium_'.$Pictures['pic15']);
		@unlink('../images/adventures/small_'.$Pictures['pic15']);	
		
		$delete = $db->consulta("DELETE FROM `adventures` WHERE `id`='".$id."'");
		
        ?>
<script language="javascript">
                <!--
                        document.location='index.php?cmd=adventures';
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