<?php
/*$pag = $_REQUEST['pag'];
$sqlPagePrint = $db->consulta("SELECT * FROM `pages` WHERE `id`='".$pag."' AND `status`='1'");
$Pages = $db->fetch_array($sqlPagePrint);

$Descripcion = $Pages['content'];

if($Idioma==$DEFAULT_LANGUAGE){
	
}else{
	
	$Descripcion = Translate($Idioma,$Descripcion);
}*/

?>
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" /> 
  <script src="src/facebox.js" type="text/javascript"></script> 
  <script type="text/javascript"> 
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage : 'src/loading.gif',
        closeImage   : 'src/closelabel.png'
		
      })
	/*  $(document).bind('loading.facebox', function() {
    $(document).unbind('keydown.facebox');
    $('#facebox_overlay').unbind('click');
});*/
    })
  </script> 
  <script type="text/javascript" src="lib/jquery.js"></script>
<script type="text/javascript" src="js/fadeslideshow.js"></script>
<table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><h2><?php echo Translate($Idioma,$MetaTags['name']);?></h2></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top"><?php echo $Descripcion; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  
</table>
