<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Costa Rica Raw</title>
<?php
if($_GET['type']=="img"){
	list($width, $height, $type, $attr) = getimagesize("flyer/".$_GET['flyer']);

	$aspect = $width / $height;
	if($height >= 600){
		$newWidth = 400;
	}else{
		$newWidth = 900;
	}
	$newHeight = $newWidth / $aspect;
	$ancho = number_format($newHeight,0);
}else{
	$ancho = 550;
}
?>

</head>

<body>
<iframe src="share.php?flyer=<?php echo $_GET['flyer']; ?>&amp;text=<?php echo $_GET['text']; ?>&amp;type=<?=$_GET['type']?>" id="flyer" name="flyer" width="650"  height="<?=$ancho?>" frameborder="0" target="Iframe" scrolling="no"></iframe>
</body>
</html>