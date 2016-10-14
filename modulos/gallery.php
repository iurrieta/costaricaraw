<?php
$accion = $_REQUEST['action'];
if($accion=="share"){
	
$description = str_replace("'", "&acute;", $_POST['description']);
$video = $_POST['youtube'];
$type=$_POST['type'];

include('includes/images.php');
$image = new SimpleImage();

      $ejecutar =  $db->consulta("INSERT INTO `gallery` (`description`,`video`,`type`,`status`) VALUES ('".$description."','".$video."','".$type."','1')");
	  $adventureID = $db->getLastID($ejecutar);
	  
if($_FILES['picture']==""){
	
}else{
	$extension = encontrar_extension($_FILES['picture']['name']);
	if (move_uploaded_file($_FILES['picture']['tmp_name'], "images/gallery/pic_".$adventureID."_adventure.".$extension))
	{
		
		$foto1 = "pic_".$adventureID."_adventure.".$extension;
		$update = $db->consulta("UPDATE `gallery` SET `img`='".$foto1."' WHERE `id`='".$adventureID."'");
		$image->load('images/gallery/'.$foto1);
		$image->resizeToWidth(600);
		$image->save('images/gallery/medium_'.$foto1);
		$image->resizeToHeight(200);
		$image->save('images/gallery/small_'.$foto1);
	} 
}	

$information = "<b>Name ".$_POST['name']."</b><br>
<b>Email:</b><em> ".$_POST['email']."</em><br>
<b>Email:</b><em> ".$_POST['email']."</em><br>
<b>Picture:</b><em> http://www.costaricaraw.com/dev/images/gallery/".$foto1."</em><br>
<b>Video:</b><em> ".$_POST['youtube']."</em><br>
<b>Description:</b><em> ".$_POST['description']."</em><br>
<br><br>";
	
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=UTF-8\r\n"; 
$headers .= "From: costaricaraw.com/dev<adventures@costaricaraw.com/dev>\n";
	
@mail("adventures@costaricaraw.com/dev","New Share Adventure Media",$information,$headers);
$ThanksForShare = "alert('Thanks for Share your Raw Adventure.');";
}
?>
<script type="text/javascript" src="js/mootools.js"></script>
<script type="text/javascript" src="js/swfobject.js"></script>
<script type="text/javascript" src="js/videobox.js"></script>
<link rel="stylesheet" href="css/videobox.css" type="text/css" media="screen" />
<script type="text/javascript" src="js/jcarousel.js"></script>

<link rel="stylesheet" type="text/css" href="css/tango.css" />

<script type="text/javascript">

<?=$ThanksForShare;?>

function mycarousel_initCallback(carousel) {
    jQuery('.jcarousel-control a').bind('click', function() {
        carousel.scroll(jQuery.jcarousel.intval(jQuery(this).text()));
        return false;
    });
	carousel.buttonNext.bind('click', function() {
        carousel.startAuto(0);
    });

    carousel.buttonPrev.bind('click', function() {
        carousel.startAuto(0);
    });

    // Pause autoscrolling if the user moves with the cursor over the clip.
    carousel.clip.hover(function() {
        carousel.stopAuto();
    }, function() {
        carousel.startAuto();
    });

    
};

// Ride the carousel...
jQuery(document).ready(function() {
    jQuery("#mycarousel").jcarousel({
        scroll: 1,
		auto: 4,
        wrap: 'last',
        initCallback: mycarousel_initCallback,
        // This tells jCarousel NOT to autobuild prev/next buttons
       // buttonNextHTML: null,
       // buttonPrevHTML: null
    });
});

function Video(){
div = document.getElementById('PictureLabel');
div.style.display = 'none';
div2 = document.getElementById('PictureInput');
div2.style.display = 'none';
div3 = document.getElementById('VideoLabel');
div3.style.display = 'block';
div4 = document.getElementById('VideoInput');
div4.style.display = 'block';
div4 = document.getElementById('VideoHelp');
div4.style.display = 'block';	
}
function Picture(){
div = document.getElementById('PictureLabel');
div.style.display = 'block';
div2 = document.getElementById('PictureInput');
div2.style.display = 'block';
div3 = document.getElementById('VideoLabel');
div3.style.display = 'none';
div4 = document.getElementById('VideoInput');
div4.style.display = 'none';
div4 = document.getElementById('VideoHelp');
div4.style.display = 'none';	
}

</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><h1>Raw Adventure Gallery</h1></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
<?php
$LI = "";
$Navegador = "";
$Contador = 1;
$Items = 1;
$sqlGallery = $db->consulta("SELECT * FROM `gallery` WHERE `status`='2' Order by `id` DESC");
while($Gallery = $db->fetch_array($sqlGallery)){

  if ($Items > 24) { 
  $Navegador .='<a href="#">'.$Contador.'</a>&nbsp;<br>';
  $Items = 1;
  }else{
$Navegador .='<a href="#">'.$Contador.'</a>&nbsp;';
 
  }
 
  		  
		
     
	if($Gallery['type']==1){
list($Link, $codigo)=explode('=',$Gallery['video']);	
list($ID,$extras)=explode('&',$codigo);

$LI .= '<li><a href="http://www.youtube.com/watch?v='.$ID.'" rel="vidbox 600 500" title="'.$Gallery['description'].'"><img src="http://img.youtube.com/vi/'.$ID.'/0.jpg" alt="Click to Open Video" width="250" border="0" /><br><center><img src="images/Video_32.png" alt="Video" border="0" /><br><strong>Click to Open</strong></center></a></li>';

	}else{
$LI .= '<li><a href="images/gallery/'.$Gallery['img'].'" rel="vidbox 800 600" title="'.$Gallery['description'].'"><img src="images/gallery/small_'.$Gallery['img'].'" alt="Click to Open Picture" width="250" border="0" /><br><center><img src="images/Pictures-32.png" alt="Picture" border="0" /><br><strong>Click to Open</strong></center></a></li>';
	}
	$Contador++;
	$Items++;
}
?>
 <div class="jcarousel-control">
    <?php echo $Navegador; ?>
    </div>
<ul id="mycarousel" class="jcarousel-skin-tango">
<?php echo $LI; ?>
</ul></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><h3>Share your Pictures or Videos in Costa Rica Raw Adventures</h3></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><form action="index.php?cmd=gallery" method="post" enctype="multipart/form-data" id="shareGallery">
    <input type="hidden" name="action" value="share">
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="2">
      <tr>
        <td width="160" align="right"><strong>Name:</strong></td>
        <td width="10">&nbsp;</td>
        <td><label for="name">
          <input name="name" type="text" id="name" size="35" maxlength="100" class="cajas">
        </label></td>
        </tr>
      <tr>
        <td align="right"><strong>Email:</strong></td>
        <td>&nbsp;</td>
        <td><label for="email"></label>
          <input name="email" type="text" id="email" size="35" maxlength="130" class="cajas"></td>
        </tr>
      <tr>
        <td align="right"><strong>Description:</strong></td>
        <td>&nbsp;</td>
        <td><input name="description" type="text" id="description" size="35" maxlength="130" class="cajas"></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td>&nbsp;</td>
        <td><input type="radio" name="type" value="2" id="type_0" onClick="Picture()">Picture&nbsp;&nbsp;<input type="radio" name="type" value="1" id="type_1" onClick="Video()">Video</td>
      </tr>
      <tr>
        <td align="right"><div id="PictureLabel" style="display:none;"><strong>Picture:</strong></div></td>
        <td></td>
        <td><div id="PictureInput" style="display:none;"><label for="picture"></label>
          <input type="file" name="picture" id="picture" class="cajas"></div></td>
        </tr>
      <tr>
        <td align="right"><div id="VideoLabel" style="display:none;"><strong>Video Youtube Link:</strong></div></td>
        <td></td>
        <td><div id="VideoInput" style="display:none;"><label for="youtube"></label>
          <input name="youtube" type="text" class="cajas" id="youtube" maxlength="200"></div></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><span style="font-size:9px; display:none;" id="VideoHelp">Example: http://www.youtube.com/watch?v=hJHCDN-bkuc</span></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><input type="submit" name="share" id="share" value="Share Now!" class="boton"></td>
      </tr>
    </table>
    </form></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>

