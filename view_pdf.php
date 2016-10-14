<div id="custom-content" class="white-popup-block" style="max-width:600px; margin: 20px auto;">
<h2><?php echo $_REQUEST['name']; ?></h2>
<iframe src="pdf.php?pdf=<?php echo $_GET['pdf']; ?>&name=<?php echo $_REQUEST['name']; ?>&image=<?php echo $_REQUEST['image']; ?>" frameborder="0" scrolling="no" width="650" height="600"></iframe>
</div>