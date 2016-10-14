!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
$FlyeTitulo = urldecode(str_replace("%20"," ",$_REQUEST['text'])); 
$FlyeTitulo = preg_replace('/\s{3,}/',' ', $FlyeTitulo);
$FlyeTitulo = str_replace("-","::", $FlyeTitulo);
$FlyeTitulo = str_replace(" ","_", $FlyeTitulo);
?>
<title>Costa Rica Raw | <?php echo $FlyeTitulo; ?></title>
<meta name="DC.Title" content="Costa Rica Raw :: <?php echo $FlyeTitulo; ?>">
<script type="text/javascript">
function popup(url,ancho,alto) {
var posicion_x; 
var posicion_y; 
posicion_x=(screen.width/2)-(ancho/2); 
posicion_y=(screen.height/2)-(alto/2); 
window.open(url, "costaricaraw.com/dev", "width="+ancho+",height="+alto+",menubar=0,toolbar=0,directories=0,scrollbars=no,resizable=no,left="+posicion_x+",top="+posicion_y+"");
}
</script> 
<meta property="og:title" content="Costa Rica Raw :: <?php echo $FlyeTitulo; ?>" />
<meta property="og:url" content="https://www.costaricaraw.com/dev/share.php?flyer=<?php echo $_REQUEST['flyer'];?>&type=<?=$_REQUEST['type']?>&flyerimg=<?php echo $_REQUEST['flyerimg']; ?>&text=<?php echo $FlyeTitulo; ?>" />
<meta property="og:description" content="Costa Rica Raw :: <?php echo $FlyeTitulo; ?>" />  


</head>

<body>
<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51106bbc75b90833"></script>
<!-- AddThis Button END -->

</body>
</html>