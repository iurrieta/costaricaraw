<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" /> 
  <script src="src/facebox.js" type="text/javascript"></script> 
  <script type="text/javascript"> 
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage : 'src/loading.gif',
        closeImage   : 'src/closelabel.png'
		
      })
	  $(document).bind('loading.facebox', function() {
    $(document).unbind('keydown.facebox');
    $('#facebox_overlay').unbind('click');
});
    })
  </script> 
<?php
$sqlBus = $db->consulta("SELECT * FROM `transport` Order by `name` ASC");
?><br>
<div style="width:100%; text-align:center; font:'Arial Black', Gadget, sans-serif; font-size:18px ; color:Green;" >
<strong> Bus Schedules </strong>
</div>
<br>
<br>
<br>

  <div>
  
<?php

while($Bus = $db->fetch_array($sqlBus)){

$ext = encontrar_extension($Bus['icon']);
?>
<div class="buschedule">
<table>
  <tr>
    	<td>
        <strong><b><?php echo $Bus['name']; ?></b></strong><br>
		</td>
  </tr>
  <tr>
    <td>
	<?php echo $Bus['information']; ?>
    </td>
  </tr>
  <tr>
  <td>
   <strong><a href="view_map.php?lat=<?php echo $Bus['latitude']; ?>&long=<?php echo $Bus['longitude']; ?>&name=<?php echo $Bus['name']; ?>&icon=<?php echo $Bus['id']; ?>&isbus=yes" rel="facebox">View Map</a></strong>
  </td>
  </tr>
  </table>
  </div>
<?php
}
?>
</div>


