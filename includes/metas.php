<?php
$sqlSiteMeta = $db->consulta("SELECT * FROM `configure` WHERE `id`='1'");
$SiteTags = $db->fetch_array($sqlSiteMeta);	

if($cmd=="travel"){ 
$sqlPageMeta = $db->consulta("SELECT * FROM `pages` WHERE `id`='".$_REQUEST['pag']."'");
$MetaTags = $db->fetch_array($sqlPageMeta);
?> 
    <title><?php echo $SiteTags['title'];  ?> | <?php echo $MetaTags['name']; ?></title> 
    <meta name="keywords" content="<?php echo $MetaTags['metas']; ?>">
	<meta name="description" content="<?php echo $MetaTags['description']; ?>" /> 
	<meta name="robots" content="index, follow" />
	<meta name="GOOGLEBOT" content="INDEX, FOLLOW" />
    <?php

$Descripcion = $MetaTags['content'];

if($Idioma==$DEFAULT_LANGUAGE){
	
}else{
	
	$Descripcion = Translate($Idioma,$Descripcion);
}
?>
<? } else{ ?> 
    <title><?php echo $SiteTags['title']; ?></title> 
    <meta name="keywords" content="<?php echo $SiteTags['metas']; ?>">
	<meta name="description" content="<?php echo $SiteTags['description']; ?>" /> 
	<meta name="robots" content="index, follow" />
	<meta name="GOOGLEBOT" content="INDEX, FOLLOW" />

<? } ?>
