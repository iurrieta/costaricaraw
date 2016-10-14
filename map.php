<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script> 
<script type="text/javascript">
function initialize() {
    var myLatlng = new google.maps.LatLng(<?php echo $_GET['lat']; ?>,<?php echo $_GET['long']; ?>);
    var myOptions = {
      zoom: 16,
      center: myLatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
 
    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
 <?php
 if($_GET['isbus']=="yes"){
	
include("includes/configuracion.php");
$db = new MySQL();
$sqlTrans = $db->consulta("SELECT * FROM `transport` WHERE `id`='".$_GET['icon']."'");
$Imagen = $db->fetch_array($sqlTrans);
	 
	$imagen = "icons/".$Imagen['icon'];
 }
 ?>
     var contentString = '<div style="width:"300px;heigth:350px;">'+
    '<div id="siteNotice">'+
    '</div>'+
    '<h3><?php echo $_GET['name']; ?></h3>'+
    '<div id="bodyContent">'+
	<?php if($_GET['isbus']){?>
    '<p><img src="images/<?php echo $imagen;?>" alt="" style="max-width:180px;"></p>'+
	<?php } ?>
    '</div>'+
    '</div>';
        
    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });
 	var image = 'images/<?php echo $_GET['icon'];?>';
	var myLatLng = new google.maps.LatLng(<?php echo $_GET['lat']; ?>,<?php echo $_GET['long']; ?>);
    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: '<?php echo $_GET['name']; ?>',
		//icon: image
    });
   google.maps.event.addListener(marker, 'click', function() {
      infowindow.open(map,marker);
    });
  }


window.onload=initialize;
    </script>
    <div id="map_canvas" style="width:600px; height: 550px; "></div>