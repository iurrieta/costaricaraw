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

<?php
$db = new MySQL();


	$CatID = $_REQUEST['adv'];
	
	$CatSQL= $db->consulta("SELECT * FROM `categories` WHERE `id`='".$CatID."'");
	$Categoria = $db->fetch_array($CatSQL);
	$ExtraerFotos = $db->consulta("SELECT `pic1`,`pic2`,`pic3`,`pic4`,`pic5`,`name` FROM `adventures` WHERE `categorie`='".$CatID."' AND `section`='2' AND `status`='1' AND `status`='8' ORDER BY rand()");
	$CuentaFotos = $db->num_rows($ExtraerFotos);
	$conta= 1;
	while($Gallery = $db->fetch_array($ExtraerFotos)){
	
	if($CuentaFotos==$conta){
		$coma = "";
	}else{
		$coma = ",";
	}
	if($conta > 1){
	$comaPrimero = ",";	
	}
	if($Gallery['pic1']){
	$contenido .=$comaPrimero;	
	$contenido .= '["images/adventures/medium_'.$Gallery['pic1'].'", "", "", "'.$Gallery['name'].'"]';
	//$contenido .= $coma;
	}
	if($Gallery['pic2']){
	$contenido .=',["images/adventures/medium_'.$Gallery['pic2'].'", "", "", "'.$Gallery['name'].'"]';
	//$contenido .= $coma;
	}
		if($Gallery['pic3']){
	$contenido .= ',["images/adventures/medium_'.$Gallery['pic3'].'", "", "", "'.$Gallery['name'].'"]';
	//$contenido .= $coma;
	}
		if($Gallery['pic4']){
	$contenido .= ',["images/adventures/medium_'.$Gallery['pic4'].'", "", "", "'.$Gallery['name'].'"]';
	//$contenido .= $coma;
	}
	if($Gallery['pic5']){
	$contenido .= ',["images/adventures/medium_'.$Gallery['pic5'].'", "", "", "'.$Gallery['name'].'"]';
	}
		
	$conta++;
	} 
	
	
	?>
 <?php	
if($CuentaFotos > 0){ ?>
<script type="text/javascript">

var mygallery=new fadeSlideShow({
	wrapperid: "fadeshow1", //ID of blank DIV on page to house Slideshow
	dimensions: [540, 350], //width/height of gallery in pixels. Should reflect dimensions of largest image
	imagearray: [			
		
		<?php echo $contenido; ?>
					
	//<--no trailing comma after very last image element!
	],
	displaymode: {type:'auto', pause:2000, cycles:0, wraparound:false},
	persist: false, //remember last viewed slide and recall within same session?
	fadeduration: 500, //transition duration (milliseconds)
	descreveal: "always",
	togglerid: ""
})
</script>
<? } ?>		

<table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
   
   
  <tr>
    <td valign="top" align="center">
   
	
<div id="fadeshow1"></div>


</td>
  </tr>
  
  <tr>
    <td align="center"><h2><?=$Categoria['name']?></h2></td>
  </tr>
 
   <tr>
     <td>&nbsp;</td>
   </tr>
   <tr>
    <td>


    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  
  <tr>
    <td>
     <table border="0" cellpadding="0" cellspacing="0">
	<?php
		$sqlTopRated = $db->consulta("SELECT * FROM `adventures` WHERE `categorie`='".$CatID."' AND `section` IN ('2','8') AND `status`='1'  Order by `order` ASC");
		$contador = 1;
		while($TopRated=$db->fetch_array($sqlTopRated)){
			
		$sqlLocAdvTop = $db->consulta("SELECT * FROM `locations` WHERE `id`='".$TopRated['locations_id']."'");	 
		$LocationAdventure = $db->fetch_array($sqlLocAdvTop);
		$Texto=$TopRated['information'];
		$MaxLENGTH=280;
		$TextoPlano = clean_html_code($Texto);
		$TextoResumen = substr($TextoPlano,0,strrpos(substr($TextoPlano,0,$MaxLENGTH)," "));
		   ?>
<tr>
  <td width="32">&nbsp;</td>
    <td width="32" height="32" valign="bottom"><img src="images/adventure.gif" align="absmiddle" border="0" height="20" /></td>
    <td width="300" valign="bottom" class="top10"><a href="?cmd=adventures&adv=<?=$TopRated['id']?>"><?=$TopRated['name']?></a>&nbsp;&nbsp;(<?=$LocationAdventure['name']?>)</td>
    <td height="35" valign="bottom"><a href="index.php?cmd=book&adventure=<?=$TopRated['id']?>" rel=""><img src="images/book-now.png" border="0" /></a></td>
  </tr>
<tr>
  <td>&nbsp;</td>
  <td colspan="3" valign="top"><span style="font-size:11px;"><?php echo $TextoResumen; ?>...</span></td>
  </tr>
<tr>
  <td>&nbsp;</td>
  <td colspan="3" valign="top">&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td colspan="3" valign="top">&nbsp;</td>
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

    
    </td>
  </tr>
</table>
