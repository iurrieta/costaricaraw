
<?php
if($Idioma==$DEFAULT_LANGUAGE){
	$HomeLinkTrans ="Home";
	$SearchTrans = "Search";
	$SearchLocationTrans = "Search by Location";
	$SearchAdventureTrans = "Search by Adventure";
	$AdventureTrans = "Adventures";
	$TravelInfoTrans = "Travel Infoxx";
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
if($_SESSION['affiliateHome']){
?>
<a href="<?=$_SESSION['affiliateHome']?>"><?php echo $HomeLinkTrans;?></a><br />
<?php
}else{
?>	
<a href="index.php"><?php echo $HomeLinkTrans;?></a><br />
<?php
}
?>
<?php
 $sqlLocationsLink = $db->consulta("SELECT * FROM `locations` Order by `name` ASC");
 while($LocationLink=$db->fetch_array($sqlLocationsLink)){

 $menuLinkLocation .= "<a href=\"?cmd=location&loc=".$LocationLink['id']."\">".$LocationLink['name']."</a><br />";
 $selectLocation .=  "<option value=\"".$LocationLink['id']."\">".$LocationLink['name']."</option>";
 } 
 $sqlCategoriaS = $db->consulta("SELECT * FROM `categories` Order by `order` ASC");
  $existen = 0;
  while($CategoriaS=$db->fetch_array($sqlCategoriaS)){
	  
	
		 $sqlOption = "='1'";	
		
	  
	  $sqlExiste = $db->consulta("SELECT * FROM `adventures` WHERE `categorie`='".$CategoriaS['id']."' AND `section`='2' AND `status` $sqlOption Order by `order` ASC");
	  $existen = $db->num_rows($sqlExiste);
	  if($existen==0){
		  
	  }else{
	$selectCategories .=  "<option value=\"".$CategoriaS['id']."\">".$CategoriaS['name']."</option>";
	  }
  }
  $existen = 0;
  
 $sqlAdventureRaw = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' AND `section`='1' Order by `order` ASC");
 while($AdventureRAW=$db->fetch_array($sqlAdventureRaw)){
$selectRAW .=  "<option value=\"".$AdventureRAW['id']."\">".$AdventureRAW['name']."</option>"; 
 } 
 
 
 ?>


<br />
 <form action="index.php?cmd=adventures" method="get" enctype="multipart/form-data" name="searchRaw" id="searchRaw">
 <input type="hidden" name="cmd" value="adventures" />
 <select name="adv" onchange="javascript:document.searchRaw.submit();" style="border: solid 1px #030; font-weight:bold; font-size:11px; color:#FFF; background-color:#960;width:170px;margin-left:-5px">
   <option value="0"><?php echo $SearchTrans;?> Raw Adventures</option>
   <?php echo $selectRAW; ?>
  
 </select>
 </form>
<br /><br />
 <form action="index.php?cmd=location" method="get" enctype="multipart/form-data" name="search" id="search">
 <input type="hidden" name="cmd" value="location" />
 <select name="loc" onchange="javascript:document.search.submit();" style="border: solid 1px #030; font-weight:bold; font-size:11px; color:#FFF; background-color:#960;width:170px;margin-left:-5px">
   <option value="0"><?php echo $SearchLocationTrans;?></option>
   <?php echo $selectLocation; ?>
  
 </select>
 </form>
<br /><br />

  <form action="index.php?cmd=categories" method="get" enctype="multipart/form-data" name="searchCat" id="searchCat">
 <input type="hidden" name="cmd" value="categories" />
 <select name="adv" onchange="javascript:document.searchCat.submit();" style="border: solid 1px #030; font-weight:bold; font-size:11px; color:#FFF; background-color:#960;width:170px; margin-left:-5px">
   <option value="0"><?php echo $SearchAdventureTrans;?></option>
   <?php echo $selectCategories; ?>
  
 </select>
 </form>
 
<span class="menu">

  <h4>RAW <?php echo $AdventureTrans;?></h4>
 
  <?php
 $sqlAdventureLink = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' AND `section`='1' Order by `order` ASC");
 while($AdventureLink=$db->fetch_array($sqlAdventureLink)){
 ?>
<a href="?cmd=adventures&adv=<?php echo $AdventureLink['id']; ?>" class="menu"><?php echo $AdventureLink['name']; ?></a><br>
 <?php 
 } 
 ?>


   <h4><?php echo $AdventureTrans;?></h4>
   <?php 
  $sqlCategoria = $db->consulta("SELECT * FROM `categories` WHERE `section`='1' Order by `order` ASC");
  while($Categoria=$db->fetch_array($sqlCategoria)){
	  
	  $sqlOption = "='1'";
	
	$sqlExiste = $db->consulta("SELECT * FROM `adventures` WHERE `categorie`='".$Categoria['id']."' AND `section`='2' AND `status` $sqlOption Order by `order` ASC");
	  $existen = $db->num_rows($sqlExiste);
	if($existen==0){
		
	}else{
	  ?>
<a href="?cmd=categories&adv=<?=$Categoria['id']?>" class="menu"><?=$Categoria['name']?></a>  <br />

  <?php
	}
	
  /*
 $sqlAdventureLink = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' AND `section`='2' AND `categorie`='".$Categoria['id']."' Order by `order` ASC");
 while($AdventureLink=$db->fetch_array($sqlAdventureLink)){
 ?>
 <li> <a href="?cmd=adventures&adv=<?php echo $AdventureLink['id']; ?>"><?php echo $AdventureLink['name']; ?></a></li>
 <?php } ?>
  </ul>
 </div>
 <?php
 */
  }
  $existen = 0;
 ?>
    <h4>Places to Stay</h4>
 <?php 
  $sqlCategoria = $db->consulta("SELECT * FROM `categories` WHERE `section`='2' Order by `order` ASC");
  while($Categoria=$db->fetch_array($sqlCategoria)){
	  
	  $sqlOption = "='1'";
	
	$sqlExiste = $db->consulta("SELECT * FROM `adventures` WHERE `categorie`='".$Categoria['id']."' AND `section`='8' AND `status` $sqlOption Order by `order` ASC");
	  $existen = $db->num_rows($sqlExiste);
	if($existen==0){
		
	}else{
	  ?>
<a href="?cmd=categories&adv=<?=$Categoria['id']?>" class="menu"><?=$Categoria['name']?></a>  <br />

  <?php
	}
	
  /*
 $sqlAdventureLink = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' AND `section`='2' AND `categorie`='".$Categoria['id']."' Order by `order` ASC");
 while($AdventureLink=$db->fetch_array($sqlAdventureLink)){
 ?>
 <li> <a href="?cmd=adventures&adv=<?php echo $AdventureLink['id']; ?>"><?php echo $AdventureLink['name']; ?></a></li>
 <?php } ?>
  </ul>
 </div>
 <?php
 */
  }
  $existen = 0;
  
   $sqlAdventureLink = $db->consulta("SELECT * FROM `adventures` WHERE `special`= '1'  Order by `order` ASC");
	  $existen = $db->num_rows($sqlAdventureLink);
	if($existen==0){
		
		
	}else{
		?>
         <h4>Special</h4>
        <?php
	}
 ?>
 

   <?php
 $sqlAdventureLink = $db->consulta("SELECT * FROM `adventures` WHERE `special`= '1'  Order by `order` ASC");
 while($AdventureLink=$db->fetch_array($sqlAdventureLink)){
 ?>
<a href="?cmd=adventures&adv=<?php echo $AdventureLink['id']; ?>" class="menu"><?php echo $AdventureLink['name']; ?></a><br>
 <?php 
 } 
 ?>


  <h4><?php echo $TravelInfoTrans;?></h4>
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
   <h4><?php echo $CostaLivingTrans;?></h4>
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
     if($Idioma==$DEFAULT_LANGUAGE){
	$ShoppingText = "Shopping Cart";
	$ViewShopping = "View Shopping Cart";
}else{
	Translate($Idioma,"Shopping Cart");
	Translate($Idioma,"View Shopping Cart");
}
?>
    <strong><a href="https://www.costaricaraw.com/dev/index.php?cmd=cart" title="<?php echo $ViewShopping;?>"><?php echo $ShoppingText;?></a></strong> <a href="https://www.costaricaraw.com/dev/index.php?cmd=cart"><img src="images/cart.png" alt="<?php echo  $ViewShopping;?>" width="24" height="24" border="0" align="absmiddle" title="<?php echo  $ViewShopping;?>" /></a></td>
  </tr>

  <tr>
    <td align="center"><a href="https://www.costaricaraw.com/dev/index.php?cmd=cart" title="<?php echo  $ViewShopping;?>"><?
if($carro){
$contador=0;
$suma=0;
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

 
 
