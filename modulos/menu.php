<?php
if($Idioma==$DEFAULT_LANGUAGE){
	$HomeLinkTrans ="Home";
	$SearchTrans = "Search";
	$SearchLocationTrans = "Search by Location";
	$SearchAdventureTrans = "Search by Adventure";
	$AdventureTrans = "Adventures";
	$TravelInfoTrans = "Travel Info";
	$BusTrans = "Bus Schedules";
	$CostaLivingTrans = "Costa Rica Living";
}else{
	$HomeLinkTrans =Translate($Idioma,"Home");
	$SearchTrans = Translate($Idioma,"Search");
	$SearchLocationTrans = Translate($Idioma,"Search by Location");
	$SearchAdventureTrans = Translate($Idioma,"Search by Adventure");
	$AdventureTrans = Translate($Idioma,"Adventures");
	$TravelInfoTrans = Translate($Idioma,"Travel Info");
	$BusTrans = Translate($Idioma,"Bus Schedules");
	$CostaLivingTrans = Translate($Idioma,"Costa Rica Living");
}

?><br />
<br />
<?php


if($_SESSION['affiliateHome']==""){


include('site_menu.php');


// FIN DE MENU SITIO
	
}else{
	
function AfiliadoMenu($db,$afiliado){
	$sqlAfiliadoMenu = $db->consulta("SELECT * FROM `affiliates_menu` WHERE `affiliate`='".$afiliado."'");
	$AfiliadoMenu = $db->num_rows($sqlAfiliadoMenu);	
	return $AfiliadoMenu;
}

$MenuAfiliado = AfiliadoMenu($db,$_SESSION['affiliateID']);

if($MenuAfiliado > 0){
	
include('affiliate_menu.php');

}else{
include('site_menu.php');
}
// FIN DE MENU AFILIADO
}
?>



  <h4><img src="images/title-travel-info.png" border="0" class="boxLeft"/><?php // echo $TravelInfoTrans;?></h4>
   <a href="?cmd=bus"><?php echo $BusTrans;?></a><br />   
  <?php
 $sqlTravelInfoLink = $db->consulta("SELECT * FROM `pages` WHERE `seccion`='1' AND `status`='1' Order by `order` ASC");
 while($TravelInfoLink =$db->fetch_array($sqlTravelInfoLink)){
	 
if($Idioma==$DEFAULT_LANGUAGE){
	$TravelInfoLinkTrans =$TravelInfoLink['name'];
}else{
	$TravelInfoLinkTrans = Translate($Idioma,$TravelInfoLink['name']);
}	 
 ?>
 <a href="?cmd=travel&pag=<?php echo $TravelInfoLink ['id']; ?>" class="menu"><?php echo $TravelInfoLinkTrans;?></a><br />
 <?php } ?>

 <a href="?cmd=crmap">Costa Rica Map</a><br />
  <a href="tell_a_friend.html" rel="facebox">Tell a Friend</a><br />
   <h4><img src="images/title-Costa-Rica-Living.png" border="0" class="boxLeft"/><?php //echo $CostaLivingTrans;?></h4>
  <?php
 $sqlCostaRicaLink = $db->consulta("SELECT * FROM `pages` WHERE `seccion`='2' AND `status`='1' Order by `order` ASC");
 while($CostaRicaLink =$db->fetch_array($sqlCostaRicaLink)){
	 
if($Idioma==$DEFAULT_LANGUAGE){
	$CostaRicaLinkTrans =$CostaRicaLink['name'];
}else{
	$CostaRicaLinkTrans = Translate($Idioma,$CostaRicaLink['name']);
}
 ?>
 <a href="?cmd=travel&pag=<?php echo $CostaRicaLink ['id']; ?>" class="menu"><?php echo $CostaRicaLinkTrans;?></a><br />
 <?php } ?>
</span>
 <table width="200" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
     <!--tr>
  <td align="center">
  <object type="application/x-shockwave-flash" data="https://clients4.google.com/voice/embed/webCallButton" width="230" height="85"><param name="movie" value="https://clients4.google.com/voice/embed/webCallButton" /><param name="wmode" value="transparent" /><param name="FlashVars" value="id=33300e83c6aaf641bc8bb6716b2a18860bd04d71&style=0" /></object>
  <br />
<br />
</td>
  </tr-->
  <tr>
    <td valign="middle"><?php

	$ShoppingText = "Shopping Cart";
	$ViewShopping = "View Shopping Cart";

?>
    <strong><a href="https://www.costaricaraw.com/dev/index.php?cmd=cart" title="<?php echo $ViewShopping;?>"><?php echo $ShoppingText;?></a></strong> <a href="https://www.costaricaraw.com/dev/index.php?cmd=cart"><img src="images/cart.png" alt="<?php echo  $ViewShopping;?>" width="24" height="24" border="0" align="absmiddle" title="<?php echo  $ViewShopping;?>" /></a></td>
  </tr>

  <tr>
    <td align="center"><a href="https://www.costaricaraw.com/dev/index.php?cmd=cart" title="<?php echo  $ViewShopping;?>"><?
if($carro){
$contador=0;
$suma=0;
$cantidad=0;
foreach($carro as $k => $v){
$subto=$v['cantidad']*$v['precio'];
$suma=$suma+$subto;
$cant = $v['cantidad'];
$cantidad = $cantidad + $cant;

$contador++;
}

echo "Items: ". $cantidad;
}else{
echo "Items: 0";
}
?></a></td>
  </tr>

</table>