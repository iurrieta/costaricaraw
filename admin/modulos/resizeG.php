<center><img src="../../images/loading_ani2.gif" alt="Loading..." /></center>
<?php
include('../images.php');
$image = new SimpleImage();


if ( file_exists("../../images/gallery/".$_GET['picture'])){
		$image->load('../../images/gallery/'.$_GET['picture']);
		$image->resize(540,350);
		$image->save('../../images/gallery/medium_'.$_GET['picture']);
		$image->resizeToHeight(200);
		$image->save('../../images/gallery/small_'.$_GET['picture']);
}else{
?>
<script>
alert('Picture Not Found');
</script>
<?php } ?>
<script>
window.close();
</script>