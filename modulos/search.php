<?php
$fechaSearch = $_REQUEST['date1'];
$locationSearch = $_REQUEST['locationSearch'];

$FechaSeleccionada =   $_REQUEST['date1'];

if($locationSearch==0){
	$TableAdventure = $db->consulta("SELECT * FROM `adventures` Order By `name`");
}else{
	$TableAdventure = $db->consulta("SELECT * FROM `adventures` WHERE `locations_id`='".$locationSearch."'");
}

$TopFeatured = "Top Featured Adventures";
$booking = "Search Adventure";
$DaySelected = "Date Selected ";
$Adventure = "Adventure";
$SpacesAvailable = "Spaces Availables";
$Reserve = "Reserve";
$NotAvailable = "Not Available";
if($Idioma==$DEFAULT_LANGUAGE){
	
}else{


	
	$booking = Translate($Idioma,$booking);
	$DaySelected = Translate($Idioma,$DaySelected);
	$FechaSeleccionada = Translate($Idioma,$FechaSeleccionada);
	$Adventure = Translate($Idioma,$Adventure);
	$SpacesAvailable = Translate($Idioma,$SpacesAvailable);
	$Reserve = Translate($Idioma,$Reserve);
	$NotAvailable = Translate($Idioma,$NotAvailable);
	$TopFeatured = Translate($Idioma,$TopFeatured);
}
?>
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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><h2><?php echo $booking; ?></td>
  </tr>
  <tr>
    <td align="center"><h4><?php echo $DaySelected;?> <?php echo $FechaSeleccionada;?></h4></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="450" align="center" cellpadding="0" cellspacing="0" style="border:solid #666 1px;">
      <tr>
        <td align="center" style="border-right:#666 solid 1px;"><strong><?php echo $Adventure; ?></strong></td>
        <td align="center" style="border-right:#666 solid 1px;"><strong><?php echo $SpacesAvailable; ?></strong></td>
        <td align="center"><strong><?php echo $Reserve; ?></strong></td>
      </tr>
       <tr>
        <td colspan="3" style="border-top:#666 solid 1px;" height="1"></td>
        </tr>
<?php
while($Adventure = $db->fetch_array($TableAdventure)){
$TableInventory = $db->consulta("SELECT * FROM `adventures_inventory` WHERE `date`='".$fechaSearch."' AND `adventures_id`=".$Adventure['id']."");
$Busqueda = $db->num_rows($TableInventory);
while($Inventory = $db->fetch_array($TableInventory)){
$Existencia = $Existencia+$Inventory['reserved'];
}

if($Busqueda > 0){
$Saldo = $Adventure['spaces']-$Existencia;	
}else{
$Saldo= $Adventure['spaces'];
}

if($Saldo==0){
$linkReserve = $NotAvailable;
}else{
$linkReserve =	'<a href="reserve.php?day='.$fechaSearch.'&adventure='.$Adventure['id'].'" rel="facebox">'.$Reserve.'</a>';
}
?>    
      <tr>
        <td style="border-right:#666 solid 1px;"><strong><?php echo $Adventure['name'];?></strong></td>
        <td align="center" style="border-right:#666 solid 1px;"><strong><?php echo $Saldo; ?></strong></td>
        <td align="center"><strong><?php echo $linkReserve;?></strong></td>
      </tr>
       <tr>
        <td colspan="3" style="border-top:#666 solid 1px;" height="1"></td>
        </tr>
        
<?php }   ?>      
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<br />
<br />
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><h3><?php echo $TopFeatured; ?></h3></td>
  </tr>
   <tr>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td><style>
	.top10 {
		font-size:18px;
		font-weight:bold;
		text-decoration:none;
		margin-left:10px;
				
	}
	.top10 a{
		text-decoration:none;
		margin-left:10px;
	}
	</style>
	  <blockquote>
	<?php
		$sqlTopAdventure = $db->consulta("SELECT * FROM `adventures` Order by `count` DESC Limit 0,10");
		$contador = 1;
		while($TopAdventure=$db->fetch_array($sqlTopAdventure)){
			 
		   ?>
           <span class="top10"><img src="images/adventure.gif" align="absmiddle" border="0" /><a href="?cmd=adventures&adv=<?=$TopAdventure['id']?>"><?=$TopAdventure['name']?></a></span>
         <p>&nbsp;</p>
        <?php 
		
		} 
		?></blockquote> </td>
  </tr>
</table>