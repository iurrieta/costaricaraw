<?php
$TopFeatured = "Top Featured Adventures";
$TopRated = "Top RAW Adventures";
$viewStat ="About Us- Raw, Vision, Mission";
if($Idioma==$DEFAULT_LANGUAGE){
	
}else{
	$TopFeatured = Translate($Idioma,$TopFeatured);
	$TopRated = Translate($Idioma,$TopRated);
	$viewStat =Translate($Idioma,$viewStat);

}

?>

<link rel="stylesheet" type="text/css" href="css/rank.css"/> 
<script type="text/javascript" src="js/rank.js"></script>	 
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" /> 
  <script src="src/facebox.js" type="text/javascript"></script> 
  <script type="text/javascript"> 
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage : 'src/loading.gif',
        closeImage   : 'src/closelabel.png'
		
      })
	/*  $(document).bind('loading.facebox', function() {
    $(document).unbind('keydown.facebox');
    $('#facebox_overlay').unbind('click');
});*/
    })
  </script> 
  <script type="text/javascript" src="lib/jquery.js"></script>
<script type="text/javascript" src="js/fadeslideshow.js"></script>

  

<script type="text/javascript">

var mygallery=new fadeSlideShow({
	wrapperid: "fadeshow1", //ID of blank DIV on page to house Slideshow
	dimensions: [540, 350], //width/height of gallery in pixels. Should reflect dimensions of largest image
	imagearray: [
	<?php
	$ExtraerFotos = $db->consulta("SELECT * FROM `gallery` ORDER BY `order` ASC");
	$CuentaFotos = $db->num_rows($ExtraerFotos);
	$conta= 1;
	while($Gallery = $db->fetch_array($ExtraerFotos)){
	
	if($CuentaFotos==$conta){
		$coma = "\n";
	}else{
		$coma = ",\n";
	}
	/*if($Gallery['type']==1){
		list($Link, $codigo)=explode('=',$Gallery['video']);	
		list($ID,$extras)=explode('&',$codigo);
	/*?>
		["http://img.youtube.com/vi/<?=$ID?>/0.jpg<?php echo $Gallery['img'];?>", "", "", "<?php echo $Gallery['description'];?>"]<?php echo $coma; ?>
	<?
	}else{*/
	?>
		["images/gallery/medium_<?php echo $Gallery['img'];?>", "", "", "<?php echo $Gallery['description'];?>"]<?php echo $coma; ?>
	<?php 
	//}
	$conta++;
	} 
	?>
	
	//<--no trailing comma after very last image element!
	],
	displaymode: {type:'auto', pause:2500, cycles:0, wraparound:false},
	persist: false, //remember last viewed slide and recall within same session?
	fadeduration: 600, //transition duration (milliseconds)
	descreveal: "always",
	togglerid: ""
})




</script>
<table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center">
<?php
$db = new MySQL();
?>



<div id="fadeshow1"></div>

</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
<?php
if($_SESSION['affiliateID']){
?>
 <tr>
     <td>
<table width="100%" border="0" cellpadding="0" cellspacing="3">
  <tr>
    <td>
     <?php 
	  if(($_SESSION['affiliateLogo']=="blank.gif") && ($_SESSION['affiliateLogo']=="")) {
		  ?><h2><?php echo $_SESSION['affiliateName'];?></h2><?
		  
	  }else {
		  if ( file_exists("images/affiliates/".$_SESSION['affiliateLogo']."")){ 
       ?>
       <img src="images/affiliates/<?=$_SESSION['affiliateLogo']?>" height="60" alt="<?php echo $_SESSION['affiliateName'];?>" />
	   
        <?php }else{ ?>
        <h2><?php echo $_SESSION['affiliateName'];?></h2>
         
		 <?php 
		 }
		 } 
		 ?>
    </td>
    <td width="150" align="right" valign="top"><?php
$puerto = $_SERVER['SERVER_PORT'];
if($puerto=="443"){ 
?><!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style" align="right">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript" src="https://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4df9232e7115649c"></script>
<!-- AddThis Button END -->
<br />
<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FCosta-Rica-Raw-Adventures%2F211720398846679&amp;send=false&amp;layout=button_count&amp;width=155&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=tahoma&amp;height=21&amp;appId=291291050931345" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:155px; height:21px;" allowTransparency="true"></iframe>

<?php } else{ ?><!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style" align="right">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4df9232e7115649c"></script>
<!-- AddThis Button END -->
<br />
<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FCosta-Rica-Raw-Adventures%2F211720398846679&amp;send=false&amp;layout=button_count&amp;width=155&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=tahoma&amp;height=21&amp;appId=291291050931345" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:155px; height:21px;" allowTransparency="true"></iframe>
<?php } ?></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
  
</table></td>
   </tr>
<?php 
}else{
?>
   <tr>
     <td>
<table width="100%" border="0" cellpadding="0" cellspacing="3">
  <tr>
    <td ><h5><a href="?cmd=travel&pag=8"><?php echo $viewStat;?></a></h5></td>
    <td width="150" align="right"><?php
$puerto = $_SERVER['SERVER_PORT'];
if($puerto=="443"){ 
?><!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style" align="right">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript" src="https://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4df9232e7115649c"></script>
<!-- AddThis Button END -->
<br />
<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FCosta-Rica-Raw-Adventures%2F211720398846679&amp;send=false&amp;layout=button_count&amp;width=155&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=tahoma&amp;height=21&amp;appId=291291050931345" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:155px; height:21px;" allowTransparency="true"></iframe>
<?php } else{ ?><!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style" align="right">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4df9232e7115649c"></script>
<!-- AddThis Button END -->
<br />
<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FCosta-Rica-Raw-Adventures%2F211720398846679&amp;send=false&amp;layout=button_count&amp;width=155&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=tahoma&amp;height=21&amp;appId=291291050931345" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:155px; height:21px;" allowTransparency="true"></iframe>
<?php } ?></td>
  </tr>
  
</table></td>
   </tr>
<?php
}
if($_SESSION['topAdventure']==1){
	
$topAdventureAfiliado = $db->consulta("SELECT * FROM `affiliates` WHERE `id`='".$_SESSION['affiliateID']."'");
$TopAfiliado=$db->fetch_array($topAdventureAfiliado);	
?>


<tr>
     <td>&nbsp;</td>
   </tr>
   <tr>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>
    <td><h3><?php echo $TopFeatured; ?></h3></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> 
    
 <?php if($TopAfiliado['1'] > 0){ ?>   
     <table border="0" cellpadding="0" cellspacing="2">
	<?php
	
		$sqlTopAdventure = $db->consulta("SELECT * FROM `adventures` WHERE `id`='".$TopAfiliado['1']."' AND `status`='1'");
		$contador = 1;
		$TopAdventure=$db->fetch_array($sqlTopAdventure);
			
		$sqlLocAdvTopT = $db->consulta("SELECT * FROM `locations` WHERE `id`='".$TopAdventure['locations_id']."'");	 
		$LocationAdventureTop = $db->fetch_array($sqlLocAdvTopT);
		$Texto=$TopAdventure['information'];
		$MaxLENGTH=250;
		$TextoPlano = clean_html_code($Texto);
		$TextoResumen = substr($TextoPlano,0,strrpos(substr($TextoPlano,0,$MaxLENGTH)," "));
			 
		   ?>
 <tr>
   <td width="32">&nbsp;</td>
    <td width="32" height="32" valign="bottom"><img src="images/adventure.gif" align="absmiddle" border="0" height="20" /></td>
    <td width="300" colspan="2" valign="bottom" class="top10"><a href="?cmd=adventures&adv=<?=$TopAdventure['id']?>"><?=$TopAdventure['name']?></a>&nbsp;&nbsp;(<?=$LocationAdventureTop['name']?>)</td>
    <td height="35" valign="bottom"><a href="book.php?adventure=<?=$TopAdventure['id']?>" rel="facebox"><img src="images/book-now.png" border="0" /></a></td>
  </tr>
 <tr>
   <td>&nbsp;</td>
   <td colspan="4" valign="top"><span style="font-size:11px;text-align:justify;"><?php 
  
	echo $TextoResumen;

   ?>...</span></td>
   </tr>
</table>
<?php } ?>
 <?php if($TopAfiliado['2'] > 0){ ?>   
     <table border="0" cellpadding="0" cellspacing="2">
	<?php
	
		$sqlTopAdventure = $db->consulta("SELECT * FROM `adventures` WHERE `id`='".$TopAfiliado['2']."' AND `status`='1'");
		$contador = 1;
		$TopAdventure=$db->fetch_array($sqlTopAdventure);
			
		$sqlLocAdvTopT = $db->consulta("SELECT * FROM `locations` WHERE `id`='".$TopAdventure['locations_id']."'");	 
		$LocationAdventureTop = $db->fetch_array($sqlLocAdvTopT);
		$Texto=$TopAdventure['information'];
		$MaxLENGTH=250;
		$TextoPlano = clean_html_code($Texto);
		$TextoResumen = substr($TextoPlano,0,strrpos(substr($TextoPlano,0,$MaxLENGTH)," "));
			 
		   ?>
 <tr>
   <td width="32">&nbsp;</td>
    <td width="32" height="32" valign="bottom"><img src="images/adventure.gif" align="absmiddle" border="0" height="20" /></td>
    <td width="300" colspan="2" valign="bottom" class="top10"><a href="?cmd=adventures&adv=<?=$TopAdventure['id']?>"><?=$TopAdventure['name']?></a>&nbsp;&nbsp;(<?=$LocationAdventureTop['name']?>)</td>
    <td height="35" valign="bottom"><a href="book.php?adventure=<?=$TopAdventure['id']?>" rel="facebox"><img src="images/book-now.png" border="0" /></a></td>
  </tr>
 <tr>
   <td>&nbsp;</td>
   <td colspan="4" valign="top"><span style="font-size:11px;text-align:justify;"><?php 
  
	echo $TextoResumen;

   ?>...</span></td>
   </tr>
</table>
<?php } ?>
 <?php if($TopAfiliado['3'] > 0){ ?>   
     <table border="0" cellpadding="0" cellspacing="2">
	<?php
	
		$sqlTopAdventure = $db->consulta("SELECT * FROM `adventures` WHERE `id`='".$TopAfiliado['3']."' AND `status`='1'");
		$contador = 1;
		$TopAdventure=$db->fetch_array($sqlTopAdventure);
			
		$sqlLocAdvTopT = $db->consulta("SELECT * FROM `locations` WHERE `id`='".$TopAdventure['locations_id']."'");	 
		$LocationAdventureTop = $db->fetch_array($sqlLocAdvTopT);
		$Texto=$TopAdventure['information'];
		$MaxLENGTH=250;
		$TextoPlano = clean_html_code($Texto);
		$TextoResumen = substr($TextoPlano,0,strrpos(substr($TextoPlano,0,$MaxLENGTH)," "));
			 
		   ?>
 <tr>
   <td width="32">&nbsp;</td>
    <td width="32" height="32" valign="bottom"><img src="images/adventure.gif" align="absmiddle" border="0" height="20" /></td>
    <td width="300" colspan="2" valign="bottom" class="top10"><a href="?cmd=adventures&adv=<?=$TopAdventure['id']?>"><?=$TopAdventure['name']?></a>&nbsp;&nbsp;(<?=$LocationAdventureTop['name']?>)</td>
    <td height="35" valign="bottom"><a href="book.php?adventure=<?=$TopAdventure['id']?>" rel="facebox"><img src="images/book-now.png" border="0" /></a></td>
  </tr>
 <tr>
   <td>&nbsp;</td>
   <td colspan="4" valign="top"><span style="font-size:11px;text-align:justify;"><?php 
  
	echo $TextoResumen;

   ?>...</span></td>
   </tr>
</table>
<?php } ?>
 <?php if($TopAfiliado['4'] > 0){ ?>   
     <table border="0" cellpadding="0" cellspacing="2">
	<?php
	
		$sqlTopAdventure = $db->consulta("SELECT * FROM `adventures` WHERE `id`='".$TopAfiliado['4']."' AND `status`='1'");
		$contador = 1;
		$TopAdventure=$db->fetch_array($sqlTopAdventure);
			
		$sqlLocAdvTopT = $db->consulta("SELECT * FROM `locations` WHERE `id`='".$TopAdventure['locations_id']."'");	 
		$LocationAdventureTop = $db->fetch_array($sqlLocAdvTopT);
		$Texto=$TopAdventure['information'];
		$MaxLENGTH=250;
		$TextoPlano = clean_html_code($Texto);
		$TextoResumen = substr($TextoPlano,0,strrpos(substr($TextoPlano,0,$MaxLENGTH)," "));
			 
		   ?>
 <tr>
   <td width="32">&nbsp;</td>
    <td width="32" height="32" valign="bottom"><img src="images/adventure.gif" align="absmiddle" border="0" height="20" /></td>
    <td width="300" colspan="2" valign="bottom" class="top10"><a href="?cmd=adventures&adv=<?=$TopAdventure['id']?>"><?=$TopAdventure['name']?></a>&nbsp;&nbsp;(<?=$LocationAdventureTop['name']?>)</td>
    <td height="35" valign="bottom"><a href="book.php?adventure=<?=$TopAdventure['id']?>" rel="facebox"><img src="images/book-now.png" border="0" /></a></td>
  </tr>
 <tr>
   <td>&nbsp;</td>
   <td colspan="4" valign="top"><span style="font-size:11px;text-align:justify;"><?php 
  
	echo $TextoResumen;

   ?>...</span></td>
   </tr>
</table>
<?php } ?>
 <?php if($TopAfiliado['5'] > 0){ ?>   
     <table border="0" cellpadding="0" cellspacing="2">
	<?php
	
		$sqlTopAdventure = $db->consulta("SELECT * FROM `adventures` WHERE `id`='".$TopAfiliado['5']."' AND `status`='1'");
		$contador = 1;
		$TopAdventure=$db->fetch_array($sqlTopAdventure);
			
		$sqlLocAdvTopT = $db->consulta("SELECT * FROM `locations` WHERE `id`='".$TopAdventure['locations_id']."'");	 
		$LocationAdventureTop = $db->fetch_array($sqlLocAdvTopT);
		$Texto=$TopAdventure['information'];
		$MaxLENGTH=250;
		$TextoPlano = clean_html_code($Texto);
		$TextoResumen = substr($TextoPlano,0,strrpos(substr($TextoPlano,0,$MaxLENGTH)," "));
			 
		   ?>
 <tr>
   <td width="32">&nbsp;</td>
    <td width="32" height="32" valign="bottom"><img src="images/adventure.gif" align="absmiddle" border="0" height="20" /></td>
    <td width="300" colspan="2" valign="bottom" class="top10"><a href="?cmd=adventures&adv=<?=$TopAdventure['id']?>"><?=$TopAdventure['name']?></a>&nbsp;&nbsp;(<?=$LocationAdventureTop['name']?>)</td>
    <td height="35" valign="bottom"><a href="book.php?adventure=<?=$TopAdventure['id']?>" rel="facebox"><img src="images/book-now.png" border="0" /></a></td>
  </tr>
 <tr>
   <td>&nbsp;</td>
   <td colspan="4" valign="top"><span style="font-size:11px; text-align:justify;"><?php 
   
	echo $TextoResumen;

   ?>...</span></td>
   </tr>
</table>
<?php } ?>
         </td>
    <td>&nbsp; </td>
  </tr>
  <tr>
    <td><h3><?php echo $TopRated; ?></h3></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
     <table border="0" cellpadding="0" cellspacing="0">
	<?php
	
		$sqlTopRated = $db->consulta("SELECT * FROM `adventures` WHERE `section`='1' AND `status`='1' AND `topad`='1' Order by `order` ASC Limit 0,5");
		$contador = 1;
		while($TopRated=$db->fetch_array($sqlTopRated)){
			
		$sqlLocAdvTop = $db->consulta("SELECT * FROM `locations` WHERE `id`='".$TopRated['locations_id']."'");	 
		$LocationAdventure = $db->fetch_array($sqlLocAdvTop);
		$Texto=$TopRated['information'];
		$MaxLENGTH=250;
		$TextoPlano =clean_html_code($Texto);
		$TextoResumen = substr($TextoPlano,0,strrpos(substr($TextoPlano,0,$MaxLENGTH)," "));
		   ?>
<tr>
  <td width="32">&nbsp;</td>
    <td width="32" height="32" valign="bottom"><img src="images/adventure.gif" align="absmiddle" border="0" height="20" /></td>
    <td width="300" valign="bottom" class="top10"><a href="?cmd=adventures&adv=<?=$TopRated['id']?>"><?=$TopRated['name']?></a>&nbsp;&nbsp;(<?=$LocationAdventure['name']?>)</td>
    <td height="35" valign="bottom"><a href="book.php?adventure=<?=$TopRated['id']?>" rel="facebox"><img src="images/book-now.png" border="0" /></a></td>
  </tr>
<tr>
  <td>&nbsp;</td>
  <td colspan="3" valign="top"><span style="font-size:11px; text-align:justify;"><?php echo $TextoResumen; ?>.</span></td>
  </tr>

        <?php 
		
		} 
		?>
        </table>
        </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
 
</table>
<?php
}else{
?>	
   <tr>
     <td>&nbsp;</td>
   </tr>
   <tr>
    <td>
	
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h3><?php echo $TopRated; ?></h3></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
     <table border="0" cellpadding="0" cellspacing="0">
	<?php
	
		$sqlTopRated = $db->consulta("SELECT * FROM `adventures` WHERE `section`='1' AND `status`='1' AND `topad`='1' Order by `order` ASC Limit 0,5");
		$contador = 1;
		while($TopRated=$db->fetch_array($sqlTopRated)){
			
		$sqlLocAdvTop = $db->consulta("SELECT * FROM `locations` WHERE `id`='".$TopRated['locations_id']."'");	 
		$LocationAdventure = $db->fetch_array($sqlLocAdvTop);
		$Texto=$TopRated['information'];
		$MaxLENGTH=252;
		$TextoPlano =clean_html_code($Texto);
		$TextoResumen = substr($TextoPlano,0,strrpos(substr($TextoPlano,0,$MaxLENGTH)," "));
		   ?>
<tr>
  <td width="32">&nbsp;</td>
    <td width="32" height="32" valign="bottom"><img src="images/adventure.gif" align="absmiddle" border="0" height="20" /></td>
    <td width="300" valign="bottom" class="top10"><a href="?cmd=adventures&adv=<?=$TopRated['id']?>"><?=$TopRated['name']?></a>&nbsp;&nbsp;(<?=$LocationAdventure['name']?>)</td>
    <td height="35" valign="bottom"><a href="book.php?adventure=<?=$TopRated['id']?>" rel="facebox"><img src="images/book-now.png" border="0" /></a></td>
  </tr>
<tr>
  <td>&nbsp;</td>
  <td colspan="3" valign="top"><span style="font-size:11px; text-align:justify;"><?php echo $TextoResumen;?>.</span></td>
  </tr>

        <?php 
		
		} 
		?>
        </table>
        </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><h3><?php echo $TopFeatured; ?></h3></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> 
     <table border="0" cellpadding="0" cellspacing="2">
	<?php
	$sqlCat = $db->consulta("SELECT * FROM `categories` Order by `order` ASC");
	while($Categoria=$db->fetch_array($sqlCat)){
		
		$sqlTopAdventure = $db->consulta("SELECT * FROM `adventures` WHERE `section`='2' AND `categorie`='".$Categoria['id']."' AND `status`='1' AND `topad`='1' Order by `order` ASC Limit 0,1");
		$contador = 1;
		while($TopAdventure=$db->fetch_array($sqlTopAdventure)){
			
		$sqlLocAdvTopT = $db->consulta("SELECT * FROM `locations` WHERE `id`='".$TopAdventure['locations_id']."'");	 
		$LocationAdventureTop = $db->fetch_array($sqlLocAdvTopT);
		$Texto=$TopAdventure['information'];
		$MaxLENGTH=260;
		$TextoPlano = clean_html_code($Texto);
		$TextoResumen = substr($TextoPlano,0,strrpos(substr($TextoPlano,0,$MaxLENGTH)," "));
			 
		   ?>
 <tr>
   <td width="32">&nbsp;</td>
    <td width="32" height="32" valign="bottom"><img src="images/adventure.gif" align="absmiddle" border="0" height="20" /></td>
    <td width="300" colspan="2" valign="bottom" class="top10"><a href="?cmd=adventures&adv=<?=$TopAdventure['id']?>"><?=$TopAdventure['name']?></a>&nbsp;&nbsp;(<?=$LocationAdventureTop['name']?>)</td>
    <td height="35" valign="bottom"><a href="book.php?adventure=<?=$TopAdventure['id']?>" rel="facebox"><img src="images/book-now.png" border="0" /></a></td>
  </tr>
 <tr>
   <td>&nbsp;</td>
   <td colspan="4" valign="top"><span style="font-size:11px; text-align:justify;"><?php echo $TextoResumen;?>...</span></td>
   </tr>
 
           
        <?php 
		
		} 
	}
		?>
    
</table>
         </td>
    <td>&nbsp; </td>
  </tr>
</table>

    
    </td>
  </tr>
  <? } ?>
</table>
