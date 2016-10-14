
<?php

$cmd=$_REQUEST['cmd'];
$locationBanner = $_REQUEST['loc'];
$permalinks = explode("/",$_SERVER['REQUEST_URI']);
$kid = "";
if($_SESSION['affiliateID'] != "")
{
	$kid = $_SESSION['affiliateID'];
	}
if($permalinks[1]=="home"){
$CuentaAfiliado = $db->consulta("SELECT * FROM `affiliates` WHERE `contact`='".$permalinks[2]."'");
$Visitas=$db->fetch_array($CuentaAfiliado);
$kid = $Visitas['id'];
}
if($cmd=="location"){
	$ExtraSQLBanner = "AND b.`location`='".$locationBanner."'";
}
$affiliateID = '-1';
if( $kid != "")	
{
	$affiliateID = $kid;
	
	}
?>

<link href="css/banner.slider.css" rel="stylesheet" type="text/css" />
<script src="js/banner.slider.js" type="text/javascript"></script>
<?php
$sqlBanner = $db->consulta("SELECT * FROM `banner` as b inner join `affiliates_banner` as ab on b.`id` = ab.`idbanner`  WHERE b.`status`='1' AND b.`pos`='1' AND ab.idaffiliate ='".$affiliateID."' $ExtraSQLBanner ORDER BY b.`order` ASC");
$total = $db->num_rows($sqlBanner);

$query = $db->consulta("SELECT title FROM `banner_title` WHERE `id`='1'");
$TitleBanner1 = $db->fetch_array($query);

$query2 = $db->consulta("SELECT title FROM `banner_title` WHERE `id`='2'");
$TitleBanner2 = $db->fetch_array($query2);
if($total > 0){
?>

<div id="banner_1_top" style="text-align:center;"> 
<font size="3" color="#4A44FC" style="text-shadow: 2px 2px 2px #000,2px -2px 2px #000; text-align:center;"><strong> <? echo $TitleBanner1['title']?>  </strong> </font>
 <div id="sliderFrame" >
 <div id="slider">
<?php
$cont1 = 1;
while($Banner = $db->fetch_array($sqlBanner)){
if($Banner['link']){
$CierreLink1 = "</a>";
$Link1 = '<a href=" index.php?idadffi='.$affiliateID.'&idbanner='.$Banner['id'].'" title="'.$Banner['title'].'">'; 
}
?>   
<?=$Link1?><img src="banner/<?=$Banner['image']?>" alt="<?=$Banner['title'] ?>" width="120" height="200"><?=$CierreLink1?>
	
<?php
$cont1++;
$CierreLink1 = "";
$Link1="";
}
?>
</div>
<div id="htmlcaption" style="display: none;">
</div>

</div>
<?php } ?>
<div class="banner_separador">&nbsp;</div>
<?php
$sqlBanner = $db->consulta("SELECT * FROM `banner` as b inner join `affiliates_banner` as ab on b.`id` = ab.`idbanner` WHERE b.`status`='1' AND b.`pos`='2' AND ab.idaffiliate ='".$affiliateID."' $ExtraSQLBanner ORDER BY b.`order` ASC");
$total2 = $db->num_rows($sqlBanner);
if($total2 > 0){
?>
<div id="banner_2_bottom" style="text-align:center;">  
<font size="4" color="#F81509" style="text-shadow: 2px 2px 2px #000,2px -2px 2px #000; text-align:center;" ><strong> <? echo $TitleBanner2['title']?> </strong> </font>
<div id="sliderFrame2">
 <div id="slider2">			
<?php

while($Banner = $db->fetch_array($sqlBanner)){
if($Banner['link']){
$CierreLink2 = "</a>";
$Link2 = '<a href=" index.php?idadffi='.$affiliateID.'&idbanner='.$Banner['id'].'" title="'.$_SESSION['kid'].'">';
} ?>
<?=$Link2 ?>
<img src="banner/<?=$Banner['image']?>" alt="<?=$Banner['title']?>" width="120" height="120">
<?=$CierreLink2?>
<?php 
$CierreLink2= "";
$Link2="";
}
?>
</div>
<div id="htmlcaption" style="display: none;"></div>
</div>

</div>
<?php } ?>

