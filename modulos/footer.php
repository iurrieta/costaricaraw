  <?php
  $counter=1;
 $sqlFooterLink = $db->consulta("SELECT * FROM `pages` WHERE `seccion`='3' Order by `order` ASC");
 $linsActivos = $db->num_rows($sqlFooterLink);
 while($FooterLink =$db->fetch_array($sqlFooterLink)){

if($Idioma==$DEFAULT_LANGUAGE){
$FooterLinkTranslate = $FooterLink['name'];	
}else{
	$FooterLinkTranslate = Translate($Idioma,$FooterLink['name']);
}
 ?>
 <a href="?cmd=travel&pag=<?php echo $FooterLink ['id']; ?>" style="color:#FFF; text-decoration:none;"><?php echo $FooterLinkTranslate;?></a>
 <?php 
 if($counter==$linsActivos){
	 
 }else{
	 echo "<span style=\"color:#FFF; text-decoration:none;\">&nbsp;&nbsp;|&nbsp;&nbsp;</span>";
 }
 $counter++;
 } 
 
 ?>

<br /> 
<br />
<br />
<br />
 <b><?php $FechaPie = fecha_texto(); ?><?php echo Translate($Idioma,$FechaPie);?></b>
 <br />
 <b><?php echo date('Y'); ?> Copyright Costa Rica Raw Adventures</b>
