<?php
$loc = $_REQUEST['loc'];


$sqlLocPrint = $db->consulta("SELECT * FROM `locations` WHERE `id`='".$loc."'");
$Location = $db->fetch_array($sqlLocPrint);

$country = "Country";
$province = "Province";
$canton = "Canton";
$district = "District";
$information = $Location['information'];
$TopFeatured = "Top Adventures";

if($Idioma==$DEFAULT_LANGUAGE){
	
}else{


	$TopFeatured = Translate($Idioma,$TopFeatured);
	$country = Translate($Idioma,$country);
	$province = Translate($Idioma,$province);
	$canton = Translate($Idioma,$canton);
	$district = Translate($Idioma,$district);
	$information = Translate($Idioma,$information);
}
?>
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
if($Location['pic1']){ ?>
  <script type="text/javascript">

var mygallery=new fadeSlideShow({
	wrapperid: "fadeshow1", //ID of blank DIV on page to house Slideshow
	dimensions: [540, 350], //width/height of gallery in pixels. Should reflect dimensions of largest image
	imagearray: [

["images/locations/medium_<?php echo $Location['pic1'];?>", "", "vidbox <?=$width?> <?=$height?>", "<?php echo $Location['name'];?> "]

<?php
if($Location['pic2']){ 
?>
,["images/locations/medium_<?php echo $Location['pic2'];?>", "", "vidbox <?=$width?> <?=$height?>", "<?php echo $Location['name'];?> "]
<? } ?>
<?php
if($Location['pic3']){ 
?>
,["images/locations/medium_<?php echo $Location['pic3'];?>", "", "vidbox <?=$width?> <?=$height?>", "<?php echo $Location['name'];?> "]
<? } ?>
<?php
if($Location['pic4']){ 
?>
,["images/locations/medium_<?php echo $Location['pic4'];?>", "", "vidbox <?=$width?> <?=$height?>", "<?php echo $Location['name'];?> "]
<? } ?>
<?php
if($Location['pic5']){ 
?>
,["images/locations/medium_<?php echo $Location['pic5'];?>", "", "vidbox <?=$width?> <?=$height?>", "<?php echo $Location['name'];?> "]
<? } ?>
<?php
if($Location['pic6']){ 
?>
,["images/locations/medium_<?php echo $Location['pic6'];?>", "", "vidbox <?=$width?> <?=$height?>", "<?php echo $Location['name'];?> "]
<? } ?>
<?php
if($Location['pic7']){ 
?>
,["images/locations/medium_<?php echo $Location['pic7'];?>", "", "vidbox <?=$width?> <?=$height?>", "<?php echo $Location['name'];?> "]
<? } ?>
<?php
if($Location['pic8']){ 
?>
,["images/locations/medium_<?php echo $Location['pic8'];?>", "", "vidbox <?=$width?> <?=$height?>", "<?php echo $Location['name'];?> "]
<? } ?>
<?php
if($Location['pic9']){ 
?>
,["images/locations/medium_<?php echo $Location['pic9'];?>", "", "vidbox <?=$width?> <?=$height?>", "<?php echo $Location['name'];?> "]
<? } ?>
<?php
if($Location['pic10']){ 
?>
,["images/locations/medium_<?php echo $Location['pic10'];?>", "", "vidbox <?=$width?> <?=$height?>", "<?php echo $Location['name'];?> "]
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
  </table>

<table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><h2><?php echo $Location['name']; ?></h2></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top"><?php echo $information; ?><br />
      <?php
		$sqlTopAdventure = $db->consulta("SELECT * FROM `adventures` WHERE `locations_id`='".$loc."' AND `status`='1' AND `section`='1' Order by `order` ASC");
		$contador = 1;
		while($TopAdventure=$db->fetch_array($sqlTopAdventure)){
		$Texto=$TopAdventure['information'];
		$MaxLENGTH=220;
		$TextoPlano = clean_html_code($Texto);
		$TextoResumen = substr($TextoPlano,0,strrpos(substr($TextoPlano,0,$MaxLENGTH)," "));		 
		   ?>
      <div class="">&nbsp;&nbsp;<img src="images/adventure.gif" align="absmiddle" border="0" height="20" />&nbsp;&nbsp;<a href="?cmd=adventures&adv=<?=$TopAdventure['id']?>"><?=$TopAdventure['name']?></a>
       <blockquote><span style="font-size:11px;"><?php echo $TextoResumen; ?>...</span>
        </blockquote>
      </div >
      <?php 
		
		} 
		?>
      <?php
		$sqlTopAdventure = $db->consulta("SELECT * FROM `adventures` WHERE `locations_id`='".$loc."' AND `status`='1' AND `section`='2' Order by `order` ASC");
		$contador = 1;
		while($TopAdventure=$db->fetch_array($sqlTopAdventure)){
		$Texto=$TopAdventure['information'];
		$MaxLENGTH=220;
		$TextoPlano = clean_html_code($Texto);
		$TextoResumen = substr($TextoPlano,0,strrpos(substr($TextoPlano,0,$MaxLENGTH)," "));	 
		   ?>
      <div class="">
        
          &nbsp;&nbsp;<img src="images/adventure.gif" align="absmiddle" border="0" height="20" />&nbsp;&nbsp;<a href="?cmd=adventures&adv=<?=$TopAdventure['id']?>"><?=$TopAdventure['name']?></a><br />
            <blockquote><span style="font-size:11px;"><?php echo $TextoResumen; ?>...</span>
        </blockquote>
      </div >
      <?php 
		
		} 
		?></td>
  </tr>
  <tr>
  <td>&nbsp;</td>
</tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script> 
<script type="text/javascript">
function initialize() {
    var myLatlng = new google.maps.LatLng(<?php echo $Location['latitude']; ?>,<?php echo $Location['longitude']; ?>);
    var myOptions = {
      zoom: 14,
      center: myLatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
 
    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
 
    var contentString = '';
        
    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });
 	var image = 'images/adventure.gif';
	var myLatLng = new google.maps.LatLng(<?php echo $Location['latitude']; ?>,<?php echo $Location['longitude']; ?>);
    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: '<?php echo $Location['name']; ?>',
		//icon: image
    });
   /* google.maps.event.addListener(marker, 'click', function() {
      infowindow.open(map,marker);
    });*/
  }


window.onload=initialize;
    </script>
 
    <div id="map_canvas" style="width:600px; height: 550px"></div></td>
  </tr>
   <tr>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td>&nbsp;</td>
  </tr>
</table>
