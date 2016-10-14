<a href="index.php"><img src="images/title-home.png" border="0"/>
<?php //echo $HomeLinkTrans;?></a><br />

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

  <h4><img src="images/title-raw-adventures.png" border="0" class="boxLeft"/><?php //echo RAW $AdventureTrans;?></h4>
 
  <?php
 $sqlAdventureLink = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' AND `section`='1' Order by `order` ASC");
 while($AdventureLink=$db->fetch_array($sqlAdventureLink)){
 ?>
<a href="?cmd=adventures&adv=<?php echo $AdventureLink['id']; ?>" class="menu"><?php echo $AdventureLink['name']; ?></a><br>
 <?php 
 } 
 ?>


   <h4><img src="images/title-adventures.png" border="0" class="boxLeft"/><?php //echo $AdventureTrans;?></h4>
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
    <h4><img src="images/title-places-to--tay.png" border="0" class="boxLeft"/><!--Places to Stay--></h4>
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
  
   $sqlAdventureLink = $db->consulta("SELECT * FROM `adventures` WHERE `special`= '1'  AND `section` NOT IN ('5')  Order by `order` ASC");
	  $existen = $db->num_rows($sqlAdventureLink);
	if($existen==0){
		
		
	}else{
		?>
         <h4>Special</h4>
        <?php
	}

 

 $sqlCategoria = $db->consulta("SELECT * FROM `categories` WHERE `section`='3' Order by `name` ASC");
  while($Categoria=$db->fetch_array($sqlCategoria)){
	  
	  $sqlOption = "='1'";
	  
	  
	  
	
	$sqlExiste = $db->consulta("SELECT * FROM `adventures` WHERE `categorie`='".$Categoria['id']."' AND `status` $sqlOption AND `special`= '1' AND `section` NOT IN ('5') Order by `order` ASC");
	  $existen = $db->num_rows($sqlExiste);
	if($existen==0){
		
	}else{
	  ?>
<a href="?cmd=categories&adv=<?=$Categoria['id']?>" class="menu"><?=$Categoria['name']?></a>  <br />

<?php
}


 } 
 
 ?>