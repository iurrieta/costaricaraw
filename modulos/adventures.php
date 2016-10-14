<?php
$adv = $_REQUEST['adv'];
$sqlAdventurePrint = $db->consulta("SELECT * FROM `adventures` WHERE `id`='".$adv."' AND `status`='1' OR `status`='5'");
$Adventure = $db->fetch_array($sqlAdventurePrint);

$Contador = $Adventure['count']+1;
$sqlContador = $db->consulta("UPDATE `adventures` SET `count`='".$Contador."' WHERE `id`='".$adv."'");

$sqlLocPrint = $db->consulta("SELECT * FROM `locations` WHERE `id`='".$Adventure['locations_id']."'");
$Location = $db->fetch_array($sqlLocPrint);

$country = "Country";
$province = "Province";
$canton = "Canton";
$district = "District";
$information = $Adventure['information'];
$locationTag = "Location";
$facilities = "Facilities";
$availability = "Availability";
$notavailable = "Not Available";
$notPossible = "Not Available";

if($Idioma==$DEFAULT_LANGUAGE){
	
}else{


	
	//$country = Translate($Idioma,$country);
	//$province = Translate($Idioma,$province);
	//$canton = Translate($Idioma,$canton);
	//$district = Translate($Idioma,$district);
	$information = Translate($Idioma,$information);
	$locationTag = Translate($Idioma,$locationTag);
	$facilities = Translate($Idioma,$facilities);
	$availability = Translate($Idioma,$availability);
	$notavailable = Translate($Idioma,$notavailable);
	$notPossible = Translate($Idioma,$notPossible);
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
	 
	 var windowHeight = $(window).height();
	 var faceboxHeight = $('#facebox').height();
	
	if(faceboxHeight < windowHeight) {
		$('#facebox').css('top', (Math.floor((windowHeight - faceboxHeight) / 2) + $(window).scrollTop()) );
	}
	 /* $(document).bind('loading.facebox', function() {
    $(document).unbind('keydown.facebox');
    $('#facebox_overlay').unbind('click');
});*/
	});
 </script> 

<table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
 
 
  <tr>
    <td valign="top" align="center"><script type="text/javascript" src="lib/jquery.js"></script>
  <script type="text/javascript" src="js/fadeslideshow.js"></script>
<!--
<script type="text/javascript" src="js/jcarousel.js"></script>
<link rel="stylesheet" type="text/css" href="css/tango2.css" />
-->
<script type="text/javascript" src="js/mootools.js"></script>
<script type="text/javascript" src="js/swfobject.js"></script>
<script type="text/javascript" src="js/videobox.js"></script>
<link rel="stylesheet" href="css/videobox.css" type="text/css" media="screen" />
   
  <?php
if($Adventure['pic1']){ ?>
  <script type="text/javascript">

var mygallery=new fadeSlideShow({
	wrapperid: "fadeshow1", //ID of blank DIV on page to house Slideshow
	dimensions: [540, 350], //width/height of gallery in pixels. Should reflect dimensions of largest image
	imagearray: [

["images/adventures/medium_<?php echo $Adventure['pic1'];?>", "", "vidbox <?=$width?> <?=$height?>", "<?php echo $Adventure['name'];?> "]

<?php
if($Adventure['pic2']){ 
?>
,["images/adventures/medium_<?php echo $Adventure['pic2'];?>", "", "vidbox <?=$width?> <?=$height?>", "<?php echo $Adventure['name'];?> "]
<? } ?>
<?php
if($Adventure['pic3']){ 
?>
,["images/adventures/medium_<?php echo $Adventure['pic3'];?>", "", "vidbox <?=$width?> <?=$height?>", "<?php echo $Adventure['name'];?> "]
<? } ?>
<?php
if($Adventure['pic4']){ 
?>
,["images/adventures/medium_<?php echo $Adventure['pic4'];?>", "", "vidbox <?=$width?> <?=$height?>", "<?php echo $Adventure['name'];?> "]
<? } ?>
<?php
if($Adventure['pic5']){ 
?>
,["images/adventures/medium_<?php echo $Adventure['pic5'];?>", "", "vidbox <?=$width?> <?=$height?>", "<?php echo $Adventure['name'];?> "]
<? } ?>
<?php
if($Adventure['pic6']){ 
?>
,["images/adventures/medium_<?php echo $Adventure['pic6'];?>", "", "vidbox <?=$width?> <?=$height?>", "<?php echo $Adventure['name'];?> "]
<? } ?>
<?php
if($Adventure['pic7']){ 
?>
,["images/adventures/medium_<?php echo $Adventure['pic7'];?>", "", "vidbox <?=$width?> <?=$height?>", "<?php echo $Adventure['name'];?> "]
<? } ?>
<?php
if($Adventure['pic8']){ 
?>
,["images/adventures/medium_<?php echo $Adventure['pic8'];?>", "", "vidbox <?=$width?> <?=$height?>", "<?php echo $Adventure['name'];?> "]
<? } ?>
<?php
if($Adventure['pic9']){ 
?>
,["images/adventures/medium_<?php echo $Adventure['pic9'];?>", "", "vidbox <?=$width?> <?=$height?>", "<?php echo $Adventure['name'];?> "]
<? } ?>
<?php
if($Adventure['pic10']){ 
?>
,["images/adventures/medium_<?php echo $Adventure['pic10'];?>", "", "vidbox <?=$width?> <?=$height?>", "<?php echo $Adventure['name'];?> "]
<? } ?>
<?php
if($Adventure['pic11']){ 
?>
,["images/adventures/medium_<?php echo $Adventure['pic11'];?>", "", "vidbox <?=$width?> <?=$height?>", "<?php echo $Adventure['name'];?> "]
<? } ?>
<?php
if($Adventure['pic12']){ 
?>
,["images/adventures/medium_<?php echo $Adventure['pic12'];?>", "", "vidbox <?=$width?> <?=$height?>", "<?php echo $Adventure['name'];?> "]
<? } ?>
<?php
if($Adventure['pic13']){ 
?>
,["images/adventures/medium_<?php echo $Adventure['pic13'];?>", "", "vidbox <?=$width?> <?=$height?>", "<?php echo $Adventure['name'];?> "]
<? } ?>
<?php
if($Adventure['pic14']){ 
?>
,["images/adventures/medium_<?php echo $Adventure['pic14'];?>", "", "vidbox <?=$width?> <?=$height?>", "<?php echo $Adventure['name'];?> "]
<? } ?>
<?php
if($Adventure['pic15']){ 
?>
,["images/adventures/medium_<?php echo $Adventure['pic15'];?>", "", "vidbox <?=$width?> <?=$height?>", "<?php echo $Adventure['name'];?> "]
<? } ?>
	
	
	//<--no trailing comma after very last image element!
	],
	displaymode: {type:'auto', pause:2500, cycles:0, wraparound:false},
	persist: false, //remember last viewed slide and recall within same session?
	fadeduration: 600, //transition duration (milliseconds)
	descreveal: "",
	togglerid: ""
})

/*
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
*/
</script>
  <? } ?>
      
  <div id="fadeshow1"></div></td>
  </tr>
 <tr>
    <td align="center">

<table width="100%" border="0" cellpadding="0" cellspacing="3">
  <tr>
    <td align="center"><h2><?php echo $Adventure['name']; ?></h2></td>
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
<!-- AddThis Button END --><br />
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
<!-- AddThis Button END --><br />
<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FCosta-Rica-Raw-Adventures%2F211720398846679&amp;send=false&amp;layout=button_count&amp;width=155&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=tahoma&amp;height=21&amp;appId=291291050931345" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:155px; height:21px;" allowTransparency="true"></iframe>

<?php } ?>
<div id="google_translate_element"></div><script type="text/javascript">

function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'es,fr,nl'}, 'google_translate_element');

}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</td>
  </tr>
  
</table> </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;
  
</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><?php echo $information; ?></td>
          <td width="120" align="center" valign="top"><a name="book" id="book"></a><a href="index.php?cmd=book&adventure=<?=$Adventure['id']?>"><img src="images/book-now.png" width="92" height="24" border="0" align="absmiddle" /></a><br /><p>&nbsp;</p><?php if($Adventure['chat']){ echo $Adventure['chat']; } ?><br />
          <?php if($Adventure['flyer']){ ?>
		  <a target="_blank" href="flyershare.php?flyer=<?=$Adventure['flyer']?>&text=<?=$Adventure['flyertext']?>&type=<?=$Adventure['flyertype']?>" rel="facebox" title="<?=$Adventure['flyertext']?>">
          <?php if($Adventure['flyertype']=="img") { ?><img src="flyer/<?=$Adventure['flyer']?>" width="120" alt="Click to Open" /><?php } ?>
           <?php if($Adventure['flyertype']=="doc") { ?><?=$Adventure['flyertext']?><?php }  ?>
          </a>
		  <?php } ?>
          <div id="dialog"></div>
          </td>
        </tr>
      
        
    </table></td>
  </tr>
   <tr>
     <td><br />
<?php

$dia_manana = date('d',time()+84600); 
$mes_manana = date('F',time()+84600); 
$ano_manana = date('Y',time()+84600); 

$sql = $db->consulta("Select  AI.`id`,(AI.`spaces` - Sum(ADT.`reserved`)) as spaces, AI.`departure`, AI.`arrival`, AI.`item` from `adventures_times` as AI 
	inner join  `adventures_inventory` as ADT on AI.`id` = ADT.`time_id` 
 where AI.`adventure` = '".$_REQUEST['adv']."' and ADT.`date` = '".$ano_manana."/".$mes_manana."/".$dia_manana."'
	union 

SELECT `id`, `spaces`, `departure`, `arrival`, `item` FROM `adventures_times` WHERE `adventure` = '".$_REQUEST['adv']."' 
and `id` 
not in (Select  AI.`id`
		from `adventures_times` as AI 
	inner join  `adventures_inventory` as ADT on AI.`id` = ADT.`time_id` 
 where AI.`adventure` = '".$_REQUEST['adv']."' and ADT.`date` = '".$ano_manana."/".$mes_manana."/".$dia_manana."');");

$resultado = $db->num_rows($sql);
if($resultado > 0) {
	?>
<table border="0" cellspacing="3" cellpadding="1" >
  <tr>
    <td width="90" ><div ><strong>Choose Date & Ck Availability</strong></div></td>
    <td width="32" ><a name="book" id="book"></a><a href="index.php?cmd=book&adventure=<?=$Adventure['id']?>" ><img src="images/oCalendar.gif" border="0" alt="Choose Date" /></a></td>
    <td width="60"  align="center"><strong>Available<br />
      Space</strong></td>
    <td align="center"><span style="display:none; width:110px;" id="Item"><strong>Item</strong></span></td>   
    <td width="110"  align="center"><strong>Check-In<br />
      Departure</strong></td>
    </tr>
<?php
 

while($Horarios=$db->fetch_array($sql)){
?>  
  <tr>
    <td><? echo $Horarios2['reserved'] ?></td>
    <td >&nbsp;</td>
    <td align="center" ><?=$Horarios['spaces']?></td>
    <td><?php if($Horarios['item']){ ?><?=$Horarios['item']?> <script>document.getElementById('Item').style.display='block';</script> <?php } ?></td>
    <td align="center" ><?=$Horarios['departure']?></td>
    </tr>
<?php } ?>

  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
     <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
</table>
<?php
}
?>
</td>
   </tr>
  
   <tr>
     <td align="left" class="valar"><?php if($Adventure['chat']){ echo $Adventure['chat']; } ?></td>
   </tr>
<?php
  if($Adventure['latitude']){
?>
   <tr>
    <td><h4>Map</h4></td>
  </tr>
  <tr>
    <td><a href="view_map.php?lat=<?=$Adventure['latitude']?>&long=<?=$Adventure['longitude']?>&name=<?=$Adventure['name']?>" rel="facebox">Click to View on Google Map</a></td>
  </tr>
<?php
  }
  
$ConsultaFa = $db->consulta("SELECT * FROM `adventures_accommodation` WHERE `adventures_id`='".$Adventure['id']."'");
$ConTFa = $db->num_rows($ConsultaFa);
if($ConTFa > 0){
?>
   <tr>
    <td><h4><?php echo $facilities; ?></h4></td>
  </tr>
   <tr>
    <td><?php
		$sqlFacilities = $db->consulta("SELECT * FROM `accommodation` Order by `name` ASC");
		$contador = 1;
		while($Facilities=$db->fetch_array($sqlFacilities)){
		
		$selx = $db->consulta("SELECT `accommodation_id` FROM `adventures_accommodation` WHERE `adventures_id`='".$Adventure['id']."' AND `accommodation_id`='".$Facilities['id']."'");
		list($Finded)=$db->fetch_array($selx);
		
		 
		   ?>
            <? if($Facilities['id']==$Finded){ ?><img src="images/icons/<?=$Facilities['icon']?>" alt="<?=$Facilities['name']?>" border="0" align="absmiddle" title="<?=$Facilities['name']?>"><?php } ?>
          
        <?php 
		$contador++;
		} 
		?> </td>
  </tr>
<?php
}
?>
   <tr>
     <td>&nbsp;</td>
   </tr>
   <!--tr>
     <td><h4><?=$availability?></h4></td>
   </tr>
  
   <tr>
    <td align="center"><iframe width="500" height="575" src="calendar.php?adv=<?php echo $Adventure['id']; ?>" frameborder="0" scrolling="no"></iframe>

</td>
  </tr-->
   <tr>
     <td>&nbsp;</td>
   </tr>
</table>
