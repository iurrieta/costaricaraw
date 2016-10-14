

<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>

    <script type="text/javascript">



 (function() {

        window.onload = function(){

        	// Creating a LatLng object containing the coordinate for the center of the map  

          var latlng = new google.maps.LatLng(9.990491, -84.078369);  

          // Creating an object literal containing the properties we want to pass to the map  

          var options = {  

          	zoom: 8,

			 mapTypeControl: true,

          	center: new google.maps.LatLng(9.990491, -84.078369),

          	mapTypeId: google.maps.MapTypeId.ROADMAP,

          };    

          // Calling the constructor, thereby initializing the map  

          var map = new google.maps.Map(document.getElementById('map'), options);  

                    

       

          // Creating an InfowWindow          

          var infowindow = new google.maps.InfoWindow({

          content: 'Costa Rica Raw',

          });

	     //var image = 'images/adventure.gif';

<?php

 $sqlLocationsLink = $db->consulta("SELECT * FROM `locations` Order by `name` ASC");
	$i=0;
 while($LocationLink=$db->fetch_array($sqlLocationsLink)){

?>	  
	
	  var point<?php echo $i; ?> = new google.maps.LatLng(<?php echo $LocationLink['latitude'];?>,<?php echo $LocationLink['longitude'];?>); 

     var marker<?php echo $i; ?> = new google.maps.Marker({draggable:false, position: point<?php echo $i; ?>,map:map,title:'<?php  echo 							$LocationLink['name'];?>'});
	 
	 var contentString<?php echo $i ?> = ('<div style="width:240px"><strong><font color="#000066" size="+2"><?php  echo 							$LocationLink['name'];?> </font></strong><br><br><a href="?cmd=location&loc=<?php echo $LocationLink['id']; ?>">View Location<\/a></div>' );
    
	google.maps.event.addListener(marker<?php echo $i; ?>, 'click', function() {

        infowindow.setContent(contentString<?php echo $i; ?>); 

        infowindow.open(map,marker<?php echo $i; ?>);

        });
	 
	 // createMarker(point,'<div style="width:240px"><strong><font color="#000066" size="+2"><?php  echo 							$LocationLink['name'];?> </font></strong><br><br><a href="?cmd=location&loc=<?php echo $LocationLink['id']; ?>">View Location<\/a></div>');

<?php
	$i++;
 }
?>
	}
    })();

    </script>

 

    

 <table width="98%" border="0" align="right" cellpadding="0" cellspacing="0">

        <tr>

          <td height="25">&nbsp;</td>

        </tr>

        <tr>

          <td>&nbsp;</td>

        </tr>

        <tr>

          <td align="center"><div id="map" style="width: 100%; height: 550px">

     

    </div></td>

        </tr>

        <tr>

          <td>&nbsp;</td>

        </tr>

        <tr>

          <td height="25">&nbsp;</td>

        </tr>

      </table>