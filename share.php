<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<meta property="og:url" content="https://www.costcostaricaraw.com/devre.php?flyer=<?php echo $_REQUEST['flyer'];?>&type=<?=$_REQUEST['type']?>&flyerimg=<?php echo $_REQUEST['flyerimg']; ?>&text=<?php echo $FlyeTitulo; ?>" />
<meta property="og:description" content="Costa Rica Raw :: <?php echo $FlyeTitulo; ?>" />  
<?php if($_REQUEST['type']=="img"){  ?>
<meta property="og:image" content="http://www.costariccostaricaraw.com/dev?php echo $_REQUEST['flyer'];?>" />
<?php 
}
if($_REQUEST['type']=="doc"){ ?>
<meta property="og:image" content="http://www.costaricarawcostaricaraw.com/dev echo $_REQUEST['flyerimg'];?>" />
<?php } ?>

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

<?php if($_REQUEST['type']=="doc"){
$FlyerFile = urlencode($_REQUEST['flyer']);	
?>
<div style="padding:5px; text-align:left; font-size:12px;">
<br />Share this &nbsp;&nbsp;|&nbsp;&nbsp;<a href="download.php?file=<?php echo $FlyerFile; ?>">Download	</a>
</div>

<br />
<iframe src="http://docs.google.com/viewer?url=http://www.costaricaraw.com/dev/flyer/<?php echo $_REQUEST['flyer']; ?>&#038;hl=es&#038;embedded=true" class="gde-frame" style="width:650px; height:400px; border: none;" scrolling="no"></iframe>


<?php } ?>
<?php if($_REQUEST['type']=="img"){ 
$FlyerFile = urlencode(str_replace(" ","%20",$_REQUEST['flyer']));	
?>
<div style="padding:5px; text-align:left;font-size:12px;">
<br />Share this &nbsp;&nbsp;|&nbsp;&nbsp;<a href="download.php?file=<?php echo $FlyerFile; ?>">Download</a>	</div>
<br />
<img src="flyer/<?php echo $_REQUEST['flyer']; ?>" alt="<?php echo $FlyeTitulo; ?>" style="max-width:650px;" />


<?php } ?>	
</body>
</html>